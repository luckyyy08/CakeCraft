<?php
session_start();
include "includes/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if($order_id <= 0){
    die("Invalid order ID.");
}

// Fetch order
$stmt = $conn->prepare("SELECT *, (SELECT COUNT(*) FROM orders o2 WHERE o2.user_id = orders.user_id AND o2.id <= orders.id) as personal_order_num FROM orders WHERE id=? AND user_id=?");
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();
$order_result = $stmt->get_result();

if($order_result->num_rows == 0){
    die("Order not found.");
}

$order = $order_result->fetch_assoc();

// Fetch mixed order items
$stmt_items = $conn->prepare("
    SELECT 
        oi.*,
        CASE
            WHEN oi.item_type = 'cake' THEN c.name
            WHEN oi.item_type = 'candle' THEN ca.name
            WHEN oi.item_type = 'hamper' THEN h.name
            WHEN oi.item_type = 'decoration' THEN d.name
            ELSE 'Unknown Item'
        END AS item_name,
        CASE
            WHEN oi.item_type = 'cake' THEN c.image
            WHEN oi.item_type = 'candle' THEN ca.image
            WHEN oi.item_type = 'hamper' THEN h.image
            WHEN oi.item_type = 'decoration' THEN d.image
            ELSE 'no-image.png'
        END AS item_image,
        CASE
            WHEN oi.item_type = 'cake' THEN 'cakes'
            WHEN oi.item_type = 'candle' THEN 'candles'
            WHEN oi.item_type = 'hamper' THEN 'hampers'
            WHEN oi.item_type = 'decoration' THEN 'decorations'
            ELSE 'default'
        END AS item_folder
    FROM order_items oi
    LEFT JOIN cakes c 
        ON oi.item_id = c.id AND oi.item_type = 'cake'
    LEFT JOIN candles ca 
        ON oi.item_id = ca.id AND oi.item_type = 'candle'
    LEFT JOIN hampers h 
        ON oi.item_id = h.id AND oi.item_type = 'hamper'
    LEFT JOIN decorations d 
        ON oi.item_id = d.id AND oi.item_type = 'decoration'
    WHERE oi.order_id = ?
");
$stmt_items->bind_param("i", $order_id);
$stmt_items->execute();
$items_result = $stmt_items->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order #<?php echo htmlspecialchars($order['personal_order_num']); ?> | CakeCraft</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/order_detail.css">
    <style>
        @media print {
            .no-print, header, footer, .profile-sidebar { display: none !important; }
            body { background: white !important; margin: 0; padding: 0; }
            .order-container { box-shadow: none !important; border: none !important; margin: 0 !important; width: 100% !important; max-width: 100% !important; padding: 0 !important; }
            .order-header h2 { margin-bottom: 20px !important; }
        }
        .order-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 20px; margin-bottom: 20px; }
    </style>
</head>
<body>

<?php include "includes/header.php"; ?>

<div class="order-container">
    <div class="order-header">
        <div style="display:flex; align-items:center; gap:15px;">
            <a href="profile.php?tab=orders" class="btn-back no-print">
                <i class="fa-solid fa-arrow-left"></i> Back to Orders
            </a>
            <h2 style="margin:0;">Order Details</h2>
        </div>
        <button onclick="window.print()" class="btn-primary no-print" style="background:#2c3e50; padding:10px 20px; font-size:14px; display:flex; align-items:center; gap:8px;">
            <i class="fa-solid fa-print"></i> Print Invoice
        </button>
    </div>

    <div class="order-meta">
        <div>
            <h5>Order Number</h5>
            <p>#<?php echo htmlspecialchars($order['personal_order_num']); ?></p>
            <p style="font-size:11px; color:#999; font-weight:normal; margin-top:3px;">Track: ORD-<?php echo str_pad($order['id'], 4, '0', STR_PAD_LEFT); ?></p>
        </div>
        <div>
            <h5>Date Placed</h5>
            <p>
                <?php 
                echo !empty($order['order_date']) 
                    ? date('d M Y, h:i A', strtotime($order['order_date'])) 
                    : 'N/A'; 
                ?>
            </p>
        </div>
        <div>
            <h5>Payment</h5>
            <p>
                <?php echo !empty($order['payment_type']) ? htmlspecialchars($order['payment_type']) : 'N/A'; ?>
                <br>
                <span class="order-status status-<?php echo str_replace(' ', '', htmlspecialchars($order['payment_status'] ?? 'Pending')); ?>" style="margin-top:5px; font-size:11px;">
                    <?php echo htmlspecialchars($order['payment_status'] ?? 'Pending'); ?>
                </span>
            </p>
        </div>
        <div>
            <h5>Delivery Status</h5>
            <p>
                <span class="order-status status-<?php echo str_replace(' ', '', htmlspecialchars($order['order_status'] ?? 'Pending')); ?>">
                    <?php echo htmlspecialchars($order['order_status'] ?? 'Pending'); ?>
                </span>
            </p>
        </div>
    </div>

    <h3 style="margin-bottom:20px; color:#333;">Items Ordered</h3>

    <div class="order-items">
        <?php if($items_result->num_rows > 0): ?>
            <?php while($item = $items_result->fetch_assoc()): ?>
                <?php
                    $item_name   = !empty($item['item_name']) ? $item['item_name'] : 'Unknown Item';
                    $item_image  = !empty($item['item_image']) ? $item['item_image'] : 'no-image.png';
                    $item_folder = !empty($item['item_folder']) ? $item['item_folder'] : 'default';
                    $item_type   = !empty($item['item_type']) ? $item['item_type'] : 'item';

                    $image_path = "assets/images/" . $item_folder . "/" . $item_image;
                ?>
                <div class="order-item">
                    <img src="<?php echo $image_path; ?>" 
                         alt="<?php echo htmlspecialchars($item_name); ?>"
                         onerror="this.src='assets/images/default/no-image.png'">

                    <div class="order-item-info">
                        <span class="item-type"><?php echo htmlspecialchars($item_type); ?></span>
                        <h4><?php echo htmlspecialchars($item_name); ?></h4>
                        <p style="color:#666; margin:0;">
                            ₹ <?php echo number_format((float)$item['price'], 2); ?> × <?php echo (int)$item['quantity']; ?>
                        </p>
                    </div>

                    <div class="order-item-price">
                        <div class="subtotal">
                            ₹ <?php echo number_format((float)$item['price'] * (int)$item['quantity'], 2); ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="no-items">No items found for this order.</div>
        <?php endif; ?>
    </div>

    <div class="order-total">
        Grand Total: <strong>₹ <?php echo number_format((float)($order['total_price'] ?? 0), 2); ?></strong>
    </div>
</div>

<?php include "includes/footer.php"; ?>
</body>
</html>