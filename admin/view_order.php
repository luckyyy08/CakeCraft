<?php
include "includes/header.php";

$order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($order_id <= 0) {
    echo "<div class='card'><p>Invalid Order ID.</p></div>";
    include "includes/footer.php";
    exit();
}

// Handle Status Update
if (isset($_POST['update_order_status'])) {
    $p_status = mysqli_real_escape_string($conn, $_POST['payment_status']);
    $o_status = mysqli_real_escape_string($conn, $_POST['order_status']);
    
    $update_q = "UPDATE orders SET payment_status='$p_status', order_status='$o_status' WHERE id=$order_id";
    if (mysqli_query($conn, $update_q)) {
        echo "<div class='alert-success' style='background:#d4edda; color:#155724; padding:15px; border-radius:8px; margin-bottom:20px; border-left:5px solid #28a745; box-shadow: 0 4px 12px rgba(0,0,0,0.1); font-weight:500;'><i class='fa-solid fa-circle-check'></i> Order status updated successfully!</div>";
    }
}

// Fetch order and user details
$stmt = $conn->prepare("SELECT o.*, u.fullname, u.email, u.mobile FROM orders o LEFT JOIN users u ON o.user_id = u.id WHERE o.id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

if (!$order) {
    echo "<div class='card'><p>Order not found.</p></div>";
    include "includes/footer.php";
    exit();
}

// Fetch order items
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
    LEFT JOIN cakes c ON oi.item_id = c.id AND oi.item_type = 'cake'
    LEFT JOIN candles ca ON oi.item_id = ca.id AND oi.item_type = 'candle'
    LEFT JOIN hampers h ON oi.item_id = h.id AND oi.item_type = 'hamper'
    LEFT JOIN decorations d ON oi.item_id = d.id AND oi.item_type = 'decoration'
    WHERE oi.order_id = ?
");
$stmt_items->bind_param("i", $order_id);
$stmt_items->execute();
$items_result = $stmt_items->get_result();
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <h1 class="page-title" style="margin: 0; font-size: 28px; color: #2c3e50;">Order Details: <span style="color: #e67e22;">#ORD-<?php echo str_pad($order['id'], 4, '0', STR_PAD_LEFT); ?></span></h1>
    <a href="orders.php" class="btn btn-primary" style="background: #34495e; padding: 10px 20px; border-radius: 8px; text-decoration: none; color: white; display: flex; align-items: center; gap: 8px;"><i class="fa-solid fa-arrow-left"></i> Back to List</a>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 30px;">
    <!-- Customer Info -->
    <div class="card" style="border-top: 4px solid #3498db;">
        <h3 style="margin-bottom: 15px; font-size: 18px; color: #2980b9;"><i class="fa-solid fa-user-circle"></i> Customer Info</h3>
        <p style="margin-bottom: 8px;"><strong>Name:</strong> <?php echo htmlspecialchars($order['fullname']); ?></p>
        <p style="margin-bottom: 8px;"><strong>Email:</strong> <?php echo htmlspecialchars($order['email']); ?></p>
        <p style="margin-bottom: 0;"><strong>Mobile:</strong> <?php echo htmlspecialchars($order['mobile']); ?></p>
    </div>

    <!-- Order Summary -->
    <div class="card" style="border-top: 4px solid #e67e22;">
        <h3 style="margin-bottom: 15px; font-size: 18px; color: #d35400;"><i class="fa-solid fa-info-circle"></i> Summary</h3>
        <p style="margin-bottom: 8px;"><strong>Date:</strong> <?php echo date('d M Y, h:i A', strtotime($order['order_date'])); ?></p>
        <p style="margin-bottom: 8px;"><strong>Payment:</strong> <span style="background: #eee; padding: 2px 8px; border-radius: 4px; font-size: 12px;"><?php echo htmlspecialchars($order['payment_type']); ?></span></p>
        <p style="margin-bottom: 0;"><strong>Grand Total:</strong> <span style="color: #e67e22; font-weight: 700;">₹ <?php echo number_format($order['total_price'], 2); ?></span></p>
    </div>

    <!-- Quick Actions (Update Status) -->
    <div class="card" style="border-top: 4px solid #27ae60; background: #f8fafc;">
        <h3 style="margin-bottom: 15px; font-size: 18px; color: #219150;"><i class="fa-solid fa-bolt"></i> Quick Status Update</h3>
        <form method="POST">
            <div style="margin-bottom: 10px;">
                <label style="font-size: 12px; color: #7f8c8d; display: block; margin-bottom: 4px;">Payment Status</label>
                <select name="payment_status" style="width: 100%; padding: 8px; border-radius: 6px; border: 1px solid #cbd5e1;">
                    <option value="Pending" <?php if ($order['payment_status'] == 'Pending') echo 'selected'; ?>>PENDING</option>
                    <option value="Paid" <?php if ($order['payment_status'] == 'Paid') echo 'selected'; ?>>PAID</option>
                    <option value="Refunded" <?php if ($order['payment_status'] == 'Refunded') echo 'selected'; ?>>REFUNDED</option>
                </select>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="font-size: 12px; color: #7f8c8d; display: block; margin-bottom: 4px;">Delivery Status</label>
                <select name="order_status" style="width: 100%; padding: 8px; border-radius: 6px; border: 1px solid #cbd5e1;">
                    <option value="Pending" <?php if ($order['order_status'] == 'Pending') echo 'selected'; ?>>Order Pending</option>
                    <option value="Processing" <?php if ($order['order_status'] == 'Processing') echo 'selected'; ?>>Processing</option>
                    <option value="Shipped" <?php if ($order['order_status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
                    <option value="Delivered" <?php if ($order['order_status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
                    <option value="Cancelled" <?php if ($order['order_status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                </select>
            </div>
            <button type="submit" name="update_order_status" class="btn btn-primary" style="width: 100%; background: #27ae60; border: none; padding: 10px; border-radius: 6px; font-weight: 600; cursor: pointer; transition: 0.3s;">Update Order</button>
        </form>
    </div>
</div>

<div class="card">
    <h3 style="padding-bottom: 15px; margin-bottom: 20px; border-bottom: 1px solid #f1f5f9; color: #334155;"><i class="fa-solid fa-list-check"></i> Items Ordered</h3>
    <table class="admin-table">
        <thead>
            <tr style="background: #f8fafc;">
                <th style="padding: 15px;">Product</th>
                <th>Type</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th style="text-align: right; padding-right: 15px;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($item = $items_result->fetch_assoc()): ?>
            <tr style="border-bottom: 1px solid #f1f5f9;">
                <td style="padding: 15px; display: flex; align-items: center; gap: 15px;">
                    <img src="../assets/images/<?php echo $item['item_folder']; ?>/<?php echo $item['item_image']; ?>" 
                         style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);"
                         onerror="this.src='../assets/images/default/no-image.png'">
                    <span style="font-weight: 600; color: #1e293b;"><?php echo htmlspecialchars($item['item_name']); ?></span>
                </td>
                <td><span style="text-transform: uppercase; font-size: 10px; background: #e2e8f0; padding: 4px 10px; border-radius: 20px; font-weight: 700; color: #475569;"><?php echo htmlspecialchars($item['item_type']); ?></span></td>
                <td style="color: #64748b;">₹ <?php echo number_format($item['price'], 2); ?></td>
                <td style="font-weight: 600;"><?php echo $item['quantity']; ?></td>
                <td style="text-align: right; padding-right: 15px; font-weight: 700; color: #1e293b;">₹ <?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
        <tfoot>
            <tr style="background: #fdf2f8;">
                <td colspan="4" style="text-align: right; padding: 20px; font-size: 16px; color: #9d174d; font-weight: 600;">Total Amount</td>
                <td style="text-align: right; padding-right: 15px; color: #be185d; font-size: 24px; font-weight: 800;">₹ <?php echo number_format($order['total_price'], 2); ?></td>
            </tr>
        </tfoot>
    </table>
</div>

<?php include "includes/footer.php"; ?>
