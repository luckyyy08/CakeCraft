<?php

include "includes/header.php";


if (isset($_POST['update_status'])) {
    $order_id = intval($_POST['order_id']);
    $payment_status = mysqli_real_escape_string($conn, $_POST['payment_status']);
    $order_status = mysqli_real_escape_string($conn, $_POST['order_status']);
    mysqli_query($conn, "UPDATE orders SET payment_status='$payment_status', order_status='$order_status' WHERE id=$order_id");
    echo "<script src='assets/js/orders.js'></script>";
}
?>

<h1 class="page-title">Manage Orders</h1>

<div class="card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Total Price</th>
                <th>Date</th>
                <th>Payment Status</th>
                <th>Delivery Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
// Join users to get name
$q = "SELECT o.*, u.fullname FROM orders o LEFT JOIN users u ON o.user_id=u.id ORDER BY o.id DESC";
$res = mysqli_query($conn, $q);
if (mysqli_num_rows($res) > 0) {
    while ($ord = mysqli_fetch_assoc($res)) {
        $badge_payment = strtolower($ord['payment_status']) == 'paid' ? 'badge-paid' : 'badge-pending';
        $badge_order = strtolower($ord['order_status']) == 'delivered' ? 'badge-paid' : (strtolower($ord['order_status']) == 'cancelled' ? 'badge-pending' : 'badge-pending');
?>
            <tr>
                <td><strong>#ORD-<?php echo str_pad($ord['id'], 4, '0', STR_PAD_LEFT); ?></strong></td>
                <td><?php echo htmlspecialchars($ord['fullname']); ?></td>
                <td>₹ <?php echo number_format($ord['total_price']); ?></td>
                <td><?php echo date('d M Y, h:i A', strtotime($ord['order_date'])); ?></td>
                <td>
                    <span class="badge <?php echo $badge_payment; ?>"><?php echo htmlspecialchars($ord['payment_type']); ?> - <?php echo htmlspecialchars($ord['payment_status']); ?></span>
                </td>
                <td>
                    <span class="badge <?php echo $badge_order; ?>"><?php echo htmlspecialchars($ord['order_status']); ?></span>
                </td>
                <td>
                    <a href="view_order.php?id=<?php echo $ord['id']; ?>" style="color:#3498db; text-decoration:none; font-weight:600;"><i class="fa-solid fa-eye"></i> View</a>
                </td>
            </tr>
            <?php
    }
}
else {
    echo "<tr><td colspan='7'>No orders found.</td></tr>";
}
?>
        </tbody>
    </table>
</div>

<?php include "includes/footer.php"; ?>
