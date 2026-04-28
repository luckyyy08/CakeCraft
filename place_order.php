<?php
session_start();
include "includes/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$payment_type = isset($_POST['payment_type']) ? $_POST['payment_type'] : 'COD';

// Address Handling
$address_id = isset($_POST['address_id']) ? $_POST['address_id'] : 'new';
$address = "";
$pincode = "";
$phone = "";

if ($address_id != 'new') {
    // Fetch from saved addresses
    $stmt_addr = $conn->prepare("SELECT * FROM user_addresses WHERE id = ? AND user_id = ?");
    $stmt_addr->bind_param("ii", $address_id, $user_id);
    $stmt_addr->execute();
    $addr_row = $stmt_addr->get_result()->fetch_assoc();
    if ($addr_row) {
        $address = $addr_row['house_no'] . ", " . $addr_row['area_street'] . ", " . $addr_row['landmark'] . ", " . $addr_row['city'] . ", " . $addr_row['state'];
        $pincode = $addr_row['pincode'];
        $phone = $addr_row['mobile'];
    }
} else {
    // Use manual fields
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $pincode = isset($_POST['pincode']) ? $_POST['pincode'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';

    // Save if requested
    if (isset($_POST['save_address']) && $_POST['save_address'] == '1' && !empty($address)) {
        // Simple saving logic - splitting address into parts for the table structure
        // Since we have a single textarea, we'll store most of it in area_street for simplicity
        $stmt_save = $conn->prepare("INSERT INTO user_addresses (user_id, fullname, mobile, pincode, area_street, address_type) VALUES (?, ?, ?, ?, ?, 'Home')");
        $fullname = $_SESSION['user_user'] ?? 'User'; // Fallback
        // Fetch real fullname from DB
        $res_u = mysqli_query($conn, "SELECT fullname FROM users WHERE id=$user_id");
        if($u = mysqli_fetch_assoc($res_u)) $fullname = $u['fullname'];

        $stmt_save->bind_param("issss", $user_id, $fullname, $phone, $pincode, $address);
        $stmt_save->execute();
    }
}

$delivery_date = isset($_POST['delivery_date']) ? $_POST['delivery_date'] : NULL;
$delivery_time = isset($_POST['delivery_time']) ? $_POST['delivery_time'] : NULL;

// Fetch cart items
$stmt = $conn->prepare("SELECT cart.item_id as id, cart.item_type, COALESCE(cakes.price, candles.price, hampers.price, decorations.price) as price, cart.quantity 
                        FROM cart 
                        LEFT JOIN cakes ON cart.item_type = 'cake' AND cart.item_id = cakes.id
                        LEFT JOIN candles ON cart.item_type = 'candle' AND cart.item_id = candles.id
                        LEFT JOIN hampers ON cart.item_type = 'hamper' AND cart.item_id = hampers.id
                        LEFT JOIN decorations ON cart.item_type = 'decoration' AND cart.item_id = decorations.id
                        WHERE cart.user_id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$total_price = 0;
$cakes = [];

while($row = $result->fetch_assoc()){
    $total_price += $row['price'] * $row['quantity'];
    $cakes[] = $row;
}

// Add midnight delivery charge if selected
if (strpos($delivery_time, 'Midnight') !== false) {
    $total_price += 50;
}

// Insert order
$stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, payment_type, order_status, address, pincode, phone, delivery_date, delivery_time, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$payment_status = ($payment_type == "Online") ? "Paid" : "Pending";
$order_status = ($payment_type == "Online") ? "Processing" : "Pending";
$stmt->bind_param("iissssssss", $user_id, $total_price, $payment_type, $order_status, $address, $pincode, $phone, $delivery_date, $delivery_time, $payment_status);
$stmt->execute();
$order_id = $stmt->insert_id;

// Insert order_items
$stmt_item = $conn->prepare("INSERT INTO order_items (order_id, item_id, item_type, quantity, price) VALUES (?, ?, ?, ?, ?)");
foreach($cakes as $cake){
    $stmt_item->bind_param("iisii", $order_id, $cake['id'], $cake['item_type'], $cake['quantity'], $cake['price']);
    $stmt_item->execute();
}

// Clear user cart
$conn->query("DELETE FROM cart WHERE user_id=$user_id");

// Send Order Confirmation Email
$res_u_email = mysqli_query($conn, "SELECT email, fullname FROM users WHERE id=$user_id");
if ($row_u = mysqli_fetch_assoc($res_u_email)) {
    $user_email = $row_u['email'];
    $user_fullname = $row_u['fullname'];

    $to = $user_email;
    $subject = "Order Confirmation - CakeCraft";
    $message = "
    <html>
    <head><title>Order Confirmation</title></head>
    <body>
    <h2>Hello $user_fullname,</h2>
    <p>Your order (ID: <b>#$order_id</b>) has been successfully placed!</p>
    <p>Total Amount: <b>₹$total_price</b></p>
    <p>Payment Mode: <b>$payment_type</b></p>
    <p>Delivery Address: $address</p>
    <p>We will notify you once your order is out for delivery.</p>
    <br>
    <p>Thank you for shopping with us!</p>
    <p>Best Regards,<br><b>CakeCraft Team</b></p>
    </body>
    </html>
    ";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: CakeCraft <noreply@cakecraft.com>' . "\r\n";
    @mail($to, $subject, $message, $headers);
}

// Redirect to order success page
$_SESSION['status'] = "Order placed successfully!";
$_SESSION['status_code'] = "success";

header("Location: order_success.php?order_id=$order_id");
exit();
?>