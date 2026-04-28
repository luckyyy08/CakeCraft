<?php
session_start();
include "includes/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$order_id = $_GET['order_id'];
$user_id = $_SESSION['user_id'];

// Fetch personal order number
$stmt = $conn->prepare("SELECT (SELECT COUNT(*) FROM orders o2 WHERE o2.user_id = orders.user_id AND o2.id <= orders.id) as personal_order_num FROM orders WHERE id=? AND user_id=?");
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();
$res = $stmt->get_result();
$personal_order_num = $res->num_rows > 0 ? $res->fetch_assoc()['personal_order_num'] : $order_id;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmed | CakeCraft</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/order_success.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<div class="success-container">
    <i class="fa-solid fa-circle-check success-icon"></i>
    <h2>Order Placed Successfully!</h2>
    <p>Thank you for shopping with CakeCraft. We have received your order and our team is getting your delicious treats ready.</p>
    
    <div class="order-number" style="display:flex; flex-direction:column; gap:5px;">
        <span>Order #<?php echo $personal_order_num; ?></span>
        <span style="font-size:12px; color:#999; font-weight:normal;">Tracking ID: ORD-<?php echo str_pad($order_id, 4, '0', STR_PAD_LEFT); ?></span>
    </div>
    
    <div class="btn-group">
        <a href="order_detail.php?order_id=<?php echo $order_id; ?>" class="btn-outline">View Details</a>
        <a href="index.php" class="btn-primary">Back to Home</a>
    </div>
</div>

<?php include "includes/footer.php"; ?>
</body>
</html>