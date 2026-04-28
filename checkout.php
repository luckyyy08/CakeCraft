<?php
session_start();
include "includes/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$user_stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_data = $user_stmt->get_result()->fetch_assoc();

// Fetch cart items for summary
$items_stmt = $conn->prepare("SELECT cart.*, 
                            COALESCE(cakes.name, candles.name, hampers.name, decorations.name) AS product_name,
                            COALESCE(cakes.price, candles.price, hampers.price, decorations.price) AS product_price,
                            COALESCE(cakes.image, candles.image, hampers.image, decorations.image) AS product_image
                            FROM cart 
                            LEFT JOIN cakes ON cart.item_type = 'cake' AND cart.item_id = cakes.id
                            LEFT JOIN candles ON cart.item_type = 'candle' AND cart.item_id = candles.id
                            LEFT JOIN hampers ON cart.item_type = 'hamper' AND cart.item_id = hampers.id
                            LEFT JOIN decorations ON cart.item_type = 'decoration' AND cart.item_id = decorations.id
                            WHERE cart.user_id = ?");
$items_stmt->bind_param("i", $user_id);
$items_stmt->execute();
$cart_items = $items_stmt->get_result();

// Fetch cart total
$stmt = $conn->prepare("SELECT SUM(cart.quantity * COALESCE(cakes.price, candles.price, hampers.price, decorations.price)) AS total 
                        FROM cart 
                        LEFT JOIN cakes ON cart.item_type = 'cake' AND cart.item_id = cakes.id
                        LEFT JOIN candles ON cart.item_type = 'candle' AND cart.item_id = candles.id
                        LEFT JOIN hampers ON cart.item_type = 'hamper' AND cart.item_id = hampers.id
                        LEFT JOIN decorations ON cart.item_type = 'decoration' AND cart.item_id = decorations.id
                        WHERE cart.user_id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$total_amount = $row['total'];
$total_amount_paise = $total_amount * 100; // Razorpay needs amount in paise
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout | CakeCraft</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <link rel="stylesheet" href="assets/css/checkout.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<style>
    .checkout-container {
        max-width: 1000px !important;
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 30px;
        text-align: left !important;
        align-items: start;
    }
    .checkout-header {
        grid-column: 1 / -1;
        margin-bottom: 20px;
    }
    .checkout-header h2 {
        margin: 0;
        font-size: 28px;
        color: #2c3e50;
    }
    .section-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f1f1f1;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #333;
    }
    .user-summary {
        background: #f8fafc;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 30px;
        border-left: 4px solid #008542;
    }
    .user-summary h4 { margin: 0 0 5px 0; color: #008542; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; }
    .user-summary .user-name { font-size: 18px; font-weight: 700; color: #1e293b; }
    .user-summary .user-detail { font-size: 14px; color: #64748b; margin-top: 4px; }

    .order-summary-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 25px;
        position: sticky;
        top: 20px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    .summary-item {
        display: flex;
        gap: 12px;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f1f5f9;
        align-items: center;
    }
    .summary-item img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 8px;
    }
    .item-info { flex: 1; }
    .item-info .name { font-weight: 600; font-size: 14px; color: #1e293b; display: block; }
    .item-info .qty { font-size: 12px; color: #64748b; }
    .item-price { font-weight: 700; color: #2c3e50; font-size: 14px; }

    .address-card-list {
        display: grid;
        grid-template-columns: 1fr;
        gap: 15px;
        margin-bottom: 25px;
    }
    .address-radio {
        display: none;
    }
    .address-card {
        border: 2px solid #eee;
        border-radius: 10px;
        padding: 15px;
        cursor: pointer;
        position: relative;
        background: #fff;
        transition: all 0.2s;
    }
    .address-radio:checked + .address-card {
        border-color: #008542;
        background: #f0fdf4;
    }
    .address-card .name {
        font-weight: 700;
        font-size: 15px;
        display: block;
        margin-bottom: 5px;
        color: #333;
    }
    .address-card .addr-text {
        font-size: 13px;
        color: #666;
        line-height: 1.4;
    }
    .address-card .type {
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 10px;
        background: #e2e8f0;
        padding: 2px 8px;
        border-radius: 20px;
        text-transform: uppercase;
        font-weight: 700;
        color: #475569;
    }
    
    @media (max-width: 900px) {
        .checkout-container { grid-template-columns: 1fr; padding: 20px; margin: 10px auto; width: 95%; }
        .order-summary-card { position: static; margin-top: 20px; }
    }
</style>

<div class="checkout-container">
    <div class="checkout-header">
        <h2>Checkout Details</h2>
        <p style="color:#666; margin-top:5px;">Check your items and delivery details before paying.</p>
    </div>

    <!-- LEFT SIDE: Form & Details -->
    <div class="checkout-main-area">
        <div class="user-summary">
            <h4>Ordering as</h4>
            <div class="user-name"><?php echo htmlspecialchars($user_data['fullname']); ?></div>
            <div class="user-detail"><?php echo htmlspecialchars($user_data['email']); ?> | <?php echo htmlspecialchars($user_data['mobile']); ?></div>
        </div>

        <div class="selection-section">
            <h3 class="section-title"><i class="fa-solid fa-location-dot"></i> Select Delivery Address</h3>
            
            <form id="checkout-form" method="POST" action="place_order.php">
                <div class="address-card-list">
                    <?php
                    // Fetch saved addresses
                    $addr_query = "SELECT * FROM user_addresses WHERE user_id = '$user_id' ORDER BY is_default DESC, created_at DESC";
                    $addr_result = mysqli_query($conn, $addr_query);
                    $has_addresses = mysqli_num_rows($addr_result) > 0;
                    
                    if($has_addresses) {
                        while($addr = mysqli_fetch_assoc($addr_result)) {
                            $full_addr = $addr['house_no'] . ", " . $addr['area_street'] . ", " . $addr['landmark'] . ", " . $addr['city'] . ", " . $addr['state'];
                    ?>
                        <label>
                            <input type="radio" name="address_id" value="<?php echo $addr['id']; ?>" class="address-radio" <?php echo ($addr['is_default'] == 1) ? 'checked' : ''; ?> 
                                   data-address="<?php echo htmlspecialchars($full_addr); ?>" 
                                   data-pincode="<?php echo htmlspecialchars($addr['pincode']); ?>" 
                                   data-phone="<?php echo htmlspecialchars($addr['mobile']); ?>">
                            <div class="address-card">
                                <span class="type"><?php echo htmlspecialchars($addr['address_type']); ?></span>
                                <span class="name"><?php echo htmlspecialchars($addr['fullname']); ?></span>
                                <p class="addr-text">
                                    <?php echo htmlspecialchars($full_addr); ?><br>
                                    <strong>Pincode:</strong> <?php echo htmlspecialchars($addr['pincode']); ?><br>
                                    <strong>Mobile:</strong> <?php echo htmlspecialchars($addr['mobile']); ?>
                                </p>
                            </div>
                        </label>
                    <?php
                        }
                    }
                    ?>
                    <label style="width: 100%; display: block;">
                        <input type="radio" name="address_id" value="new" class="address-radio" <?php echo !$has_addresses ? 'checked' : ''; ?>>
                        <div class="address-card" id="new-address-trigger">
                            <span class="name"><i class="fa-solid fa-plus-circle"></i> Add New Address</span>
                            <p class="addr-text">Deliver to a different location...</p>
                        </div>
                    </label>
                </div>

                <!-- New Address Fields (Hidden unless 'new' is selected) -->
                <div id="new-address-fields" style="display: <?php echo $has_addresses ? 'none' : 'block'; ?>; border: 1px solid #eee; padding: 20px; border-radius: 8px; background: #fafafa; margin-bottom: 25px;">
                    <div style="text-align: left; margin-bottom: 15px;">
                        <label style="font-size: 14px; color: #444; font-weight: 600;">Full Address for Delivery <span style="color:red">*</span></label>
                        <textarea name="address" id="address" placeholder="House No, Area, City, State..." style="width: 100%; padding: 12px; margin-top: 5px; border: 1px solid #ddd; border-radius: 6px; resize: none; box-sizing: border-box;" rows="3"></textarea>
                    </div>
                    
                    <div style="display: flex; gap: 15px; margin-bottom: 10px; text-align: left;">
                        <div style="flex: 1;">
                            <label style="font-size: 14px; color: #444; font-weight: 600;">Pincode <span style="color:red">*</span></label>
                            <input type="text" name="pincode" id="pincode" placeholder="6-digit Pincode" style="width: 100%; padding: 12px; margin-top: 5px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box;">
                        </div>
                        <div style="flex: 1;">
                            <label style="font-size: 14px; color: #444; font-weight: 600;">Contact No. <span style="color:red">*</span></label>
                            <input type="tel" name="phone" id="phone" placeholder="10-digit mobile" style="width: 100%; padding: 12px; margin-top: 5px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box;">
                        </div>
                    </div>
                    <div style="text-align: left; font-size: 12px; color: #888;">
                        <label><input type="checkbox" name="save_address" value="1" checked> Save this address for future</label>
                    </div>
                </div>
                
                <h3 class="section-title"><i class="fa-solid fa-clock"></i> Delivery Slot</h3>
                <div style="display: flex; gap: 15px; margin-bottom: 25px; text-align: left;">
                    <div style="flex: 1;">
                        <label style="font-weight: 500; font-size: 14px; color: #444;">Delivery Date <span style="color:red">*</span></label>
                        <input type="date" name="delivery_date" id="delivery_date" min="<?php echo date('Y-m-d'); ?>" required style="width: 100%; padding: 12px; margin-top: 5px; border: 1px solid #ddd; border-radius: 6px; font-family: 'Roboto', sans-serif; box-sizing: border-box;">
                    </div>
                    <div style="flex: 1;">
                        <label style="font-weight: 500; font-size: 14px; color: #444;">Delivery Time <span style="color:red">*</span></label>
                        <select name="delivery_time" id="delivery_time" required style="width: 100%; padding: 12px; margin-top: 5px; border: 1px solid #ddd; border-radius: 6px; font-family: 'Roboto', sans-serif; box-sizing: border-box;">
                            <option value="">Select Time Slot</option>
                            <option value="Morning (9 AM - 12 PM)">Morning (9 AM - 12 PM)</option>
                            <option value="Afternoon (12 PM - 4 PM)">Afternoon (12 PM - 4 PM)</option>
                            <option value="Evening (4 PM - 8 PM)">Evening (4 PM - 8 PM)</option>
                            <option value="Midnight (11 PM - 12 AM) [+50 RS]">Midnight (11 PM - 12 AM) [+₹50]</option>
                        </select>
                    </div>
                </div>

                <div class="payment-options">
                    <input type="hidden" name="payment_type" id="payment_type" value="COD">
                    <button type="submit" onclick="document.getElementById('payment_type').value='COD'" class="btn-cod">
                        <i class="fa-solid fa-check-circle"></i> Place Order (Cash on Delivery)
                    </button>
                    <button type="button" onclick="payWithRazorpay()" class="btn-online" style="background:#2980b9;">
                        <i class="fa-solid fa-credit-card"></i> Pay Online (UPI / Card / Netbanking)
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- RIGHT SIDE: Order Summary -->
    <div class="order-summary-card">
        <h3 class="section-title"><i class="fa-solid fa-receipt"></i> Order Summary</h3>
        
        <div class="cart-items-list" style="max-height: 400px; overflow-y: auto; margin-bottom: 20px; padding-right: 5px;">
            <?php 
            mysqli_data_seek($cart_items, 0);
            while($item = $cart_items->fetch_assoc()): 
            ?>
            <div class="summary-item">
                <img src="assets/images/<?php echo $item['item_type']; ?>s/<?php echo $item['product_image']; ?>" onerror="this.src='https://via.placeholder.com/50';">
                <div class="item-info">
                    <span class="name"><?php echo htmlspecialchars($item['product_name']); ?></span>
                    <span class="qty">Qty: <?php echo $item['quantity']; ?> × ₹<?php echo number_format($item['product_price'], 2); ?></span>
                </div>
                <div class="item-price">₹<?php echo number_format($item['product_price'] * $item['quantity'], 2); ?></div>
            </div>
            <?php endwhile; ?>
        </div>

        <div style="border-top: 2px dashed #e2e8f0; padding-top: 20px;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 10px; color: #64748b; font-size: 14px;">
                <span>Subtotal</span>
                <span>₹<?php echo number_format($total_amount, 2); ?></span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 10px; color: #64748b; font-size: 14px;">
                <span>Delivery Fee</span>
                <span style="color: #008542;">FREE</span>
            </div>
            <div id="midnight-charge-row" style="display: none; justify-content: space-between; margin-bottom: 10px; color: #d946ef; font-size: 14px;">
                <span>Midnight Delivery Surcharge</span>
                <span>₹50.00</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-top: 15px; padding-top: 15px; border-top: 1px solid #f1f5f9;">
                <span style="font-weight: 700; color: #1e293b; font-size: 18px;">Total Payable</span>
                <span style="font-weight: 800; color: #e67e22; font-size: 20px;">₹ <span id="display-total"><?php echo number_format($total_amount, 2); ?></span></span>
            </div>
        </div>

        <div class="secure-badge" style="background: #f0fdf4; padding: 10px; border-radius: 8px; border: 1px solid #dcfce7; margin-top: 20px;">
            <i class="fa-solid fa-shield-halved" style="color: #008542;"></i> <span style="color: #008542; font-weight: 600; font-size: 12px;">100% Secure Checkout</span>
        </div>
    </div>
</div>

        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('input[name="address_id"]').change(function() {
        if ($(this).val() === 'new') {
            $('#new-address-fields').show();
            $('#address, #pincode, #phone').prop('required', true);
        } else {
            $('#new-address-fields').hide();
            $('#address, #pincode, #phone').prop('required', false);
        }
    });

    // Handle midnight delivery charge
    $('#delivery_time').change(function() {
        var baseTotal = <?php echo $total_amount; ?>;
        if ($(this).val().includes('Midnight')) {
            baseTotal += 50;
            $('#midnight-charge-row').css('display', 'flex');
        } else {
            $('#midnight-charge-row').hide();
        }
        $('#display-total').text(baseTotal.toLocaleString('en-IN', {minimumFractionDigits: 2}));
    });
});

function payWithRazorpay() {
    // Basic validations
    var selectedAddr = $('input[name="address_id"]:checked').val();
    if (!selectedAddr) {
        alert("Please select or add a delivery address first.");
        return;
    }
    if (selectedAddr === 'new') {
        if ($('#address').val().trim() === "" || $('#pincode').val().trim() === "" || $('#phone').val().trim() === "") {
            alert("Please fill all new address fields first.");
            return;
        }
    }
    if (!$('#delivery_date').val() || !$('#delivery_time').val()) {
        alert("Please select delivery date and time.");
        return;
    }

    var total = parseFloat($('#display-total').text().replace(/,/g, ''));
    var total_paise = Math.round(total * 100);

    var options = {
        "key": "rzp_test_ScvjCCu07OMtSB", // Razorpay Test Key
        "amount": total_paise,
        "currency": "INR",
        "name": "CakeCraft",
        "description": "Order Payment",
        "image": "assets/images/logo.png",
        "handler": function (response){
            // On success
            var form = document.getElementById('checkout-form');
            
            var paymentIdInput = document.createElement('input');
            paymentIdInput.type = 'hidden';
            paymentIdInput.name = 'razorpay_payment_id';
            paymentIdInput.value = response.razorpay_payment_id;
            form.appendChild(paymentIdInput);
            
            document.getElementById('payment_type').value = 'Online';
            form.submit();
        },
        "prefill": {
            "name": "<?php echo htmlspecialchars($user_data['fullname']); ?>",
            "email": "<?php echo htmlspecialchars($user_data['email']); ?>",
            "contact": "<?php echo htmlspecialchars($user_data['mobile']); ?>"
        },
        "theme": {
            "color": "#008542"
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.open();
}

document.getElementById('checkout-form').onsubmit = function(e) {
    var selectedAddr = $('input[name="address_id"]:checked').val();
    if (!selectedAddr) {
        alert("Please select a delivery address.");
        return false;
    }
    return true;
};
</script>

</body>
</html>