<?php 
include "includes/header.php"; 

// Dashboard Logic 
// Total Users
$q_users = mysqli_query($conn, "SELECT count(*) as total FROM users");
$r_users = mysqli_fetch_assoc($q_users)['total'];

// Total Orders
$q_orders = mysqli_query($conn, "SELECT count(*) as total FROM orders");
$r_orders = mysqli_fetch_assoc($q_orders)['total'];

// Total Revenue
$q_rev = mysqli_query($conn, "SELECT sum(total_price) as total FROM orders WHERE payment_status='Paid'");
$r_rev = mysqli_fetch_assoc($q_rev)['total'];
if(!$r_rev) $r_rev = 0;

// Total Cakes
$q_cakes = mysqli_query($conn, "SELECT count(*) as total FROM cakes");
$r_cakes = mysqli_fetch_assoc($q_cakes)['total'];

// Notifications Logic
$q_pending = mysqli_query($conn, "SELECT count(*) as count FROM orders WHERE order_status='Pending'");
$pending_orders = $q_pending ? mysqli_fetch_assoc($q_pending)['count'] : 0;

$q_today = mysqli_query($conn, "SELECT count(*) as count FROM orders WHERE order_status NOT IN ('Delivered', 'Cancelled') AND delivery_date=CURDATE()");
$today_deliveries = $q_today ? mysqli_fetch_assoc($q_today)['count'] : 0;

$q_new_users = mysqli_query($conn, "SELECT count(*) as count FROM users WHERE DATE(created_at) = CURDATE()");
$new_users = $q_new_users ? mysqli_fetch_assoc($q_new_users)['count'] : 0;

?>

<h1 class="page-title">Dashboard Overview</h1>

<link rel="stylesheet" href="assets/css/index.css">

<div class="stat-cards">
    <a href="orders.php" class="stat-card" style="text-decoration:none;">
        <div class="stat-info">
            <h3><?php echo number_format($r_orders); ?></h3>
            <p>Total Orders</p>
        </div>
        <div class="stat-icon"><i class="fa-solid fa-shopping-bag" style="color:#008542;"></i></div>
    </a>
    <a href="reports.php" class="stat-card" style="text-decoration:none;">
        <div class="stat-info">
            <h3>₹ <?php echo number_format($r_rev); ?></h3>
            <p>Total Revenue (Paid)</p>
        </div>
        <div class="stat-icon"><i class="fa-solid fa-indian-rupee-sign" style="color:#e67e22;"></i></div>
    </a>
    <a href="users.php" class="stat-card" style="text-decoration:none;">
        <div class="stat-info">
            <h3><?php echo number_format($r_users); ?></h3>
            <p>Registered Users</p>
        </div>
        <div class="stat-icon"><i class="fa-solid fa-users" style="color:#17a2b8;"></i></div>
    </a>
    <a href="cakes.php" class="stat-card" style="text-decoration:none;">
        <div class="stat-info">
            <h3><?php echo number_format($r_cakes); ?></h3>
            <p>Total Products</p>
        </div>
        <div class="stat-icon"><i class="fa-solid fa-box" style="color:#dc3545;"></i></div>
    </a>
</div>

<!-- NOTIFICATIONS & QUICK ACTIONS -->
<div style="display:grid; grid-template-columns: 2fr 1fr; gap:20px; margin-bottom:30px;">
    
    <!-- Alerts / Notifications -->
    <div class="card" style="margin-bottom:0; border-left: 5px solid #e67e22;">
        <h2 style="margin-top:0; display:flex; align-items:center; gap:10px; color:#d35400;">
            <i class="fa-solid fa-bell fa-shake"></i> Shop Owner Alerts
        </h2>
        <div style="display:flex; flex-direction:column; gap:12px; margin-top:15px;">
            <?php if($pending_orders > 0): ?>
                <div style="background:#fff3cd; padding:12px 15px; border-radius:5px; border-left:4px solid #ffc107; display:flex; justify-content:space-between; align-items:center;">
                    <span><i class="fa-solid fa-clock" style="color:#ffc107; margin-right:8px;"></i> You have <strong><?php echo $pending_orders; ?> new pending order(s)</strong> waiting to be processed!</span>
                    <a href="orders.php?status=Pending" class="btn btn-sm" style="background:#ffc107; color:#000; text-decoration:none; padding:5px 10px; border-radius:4px; font-size:12px; font-weight:bold;">Process Now</a>
                </div>
            <?php else: ?>
                <div style="background:#d4edda; padding:12px 15px; border-radius:5px; border-left:4px solid #28a745; color:#155724;">
                    <i class="fa-solid fa-check-circle" style="margin-right:8px;"></i> All caught up! No pending orders.
                </div>
            <?php endif; ?>

            <?php if($today_deliveries > 0): ?>
                <div style="background:#cce5ff; padding:12px 15px; border-radius:5px; border-left:4px solid #007bff; display:flex; justify-content:space-between; align-items:center;">
                    <span><i class="fa-solid fa-truck-fast" style="color:#007bff; margin-right:8px;"></i> There are <strong><?php echo $today_deliveries; ?> order(s) scheduled for delivery today.</strong> Make sure they are dispatched!</span>
                    <a href="orders.php?date=today" class="btn btn-sm" style="background:#007bff; color:#fff; text-decoration:none; padding:5px 10px; border-radius:4px; font-size:12px; font-weight:bold;">View Deliveries</a>
                </div>
            <?php endif; ?>

            <?php if($new_users > 0): ?>
                <div style="background:#e2e3e5; padding:12px 15px; border-radius:5px; border-left:4px solid #6c757d;">
                    <i class="fa-solid fa-user-plus" style="color:#6c757d; margin-right:8px;"></i> <strong><?php echo $new_users; ?> new customer(s)</strong> joined your shop today.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card" style="margin-bottom:0; border-left: 5px solid #3498db;">
        <h2 style="margin-top:0; display:flex; align-items:center; gap:10px; color:#2980b9;">
            <i class="fa-solid fa-bolt"></i> Quick Actions
        </h2>
        <div style="display:flex; flex-direction:column; gap:10px; margin-top:15px;">
            <a href="add_cake.php" style="background:#f8f9fa; border:1px solid #ddd; padding:12px 15px; border-radius:5px; text-decoration:none; color:#333; font-weight:500; display:flex; align-items:center; gap:10px; transition:0.2s;"><i class="fa-solid fa-plus-circle" style="color:#28a745;"></i> Add New Cake</a>
            <a href="orders.php" style="background:#f8f9fa; border:1px solid #ddd; padding:12px 15px; border-radius:5px; text-decoration:none; color:#333; font-weight:500; display:flex; align-items:center; gap:10px; transition:0.2s;"><i class="fa-solid fa-list-check" style="color:#17a2b8;"></i> Manage Orders</a>
            <a href="reports.php" style="background:#f8f9fa; border:1px solid #ddd; padding:12px 15px; border-radius:5px; text-decoration:none; color:#333; font-weight:500; display:flex; align-items:center; gap:10px; transition:0.2s;"><i class="fa-solid fa-file-invoice-dollar" style="color:#e67e22;"></i> View Sales Report</a>
        </div>
    </div>

</div>

<div class="card">
    <h2 style="margin-top:0;">Recent Orders</h2>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Amount</th>
                <th>Delivery Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $recent = mysqli_query($conn, "SELECT * FROM orders ORDER BY id DESC LIMIT 5");
            if(mysqli_num_rows($recent) > 0) {
                while($ord = mysqli_fetch_assoc($recent)){
                    $badge = strtolower($ord['order_status']) == 'delivered' ? 'badge-paid' : (strtolower($ord['order_status']) == 'cancelled' ? 'badge-pending' : 'badge-pending');
            ?>
            <tr>
                <td><strong>#ORD-<?php echo str_pad($ord['id'], 4, '0', STR_PAD_LEFT); ?></strong></td>
                <td>₹ <?php echo number_format($ord['total_price']); ?></td>
                <td><span class="badge <?php echo $badge; ?>"><?php echo htmlspecialchars($ord['order_status']); ?></span></td>
                <td><?php echo date('d M Y, h:i A', strtotime($ord['order_date'])); ?></td>
                <td><a href="view_order.php?id=<?php echo $ord['id']; ?>" style="color:#3498db; text-decoration:none; font-weight:600;"><i class="fa-solid fa-eye"></i> View</a></td>
            </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='5' style='text-align:center; padding:20px; color:#999;'>No recent orders</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div style="margin-top:20px; display:flex; gap:15px;">
        <a href="orders.php" class="btn btn-primary" style="background:#3498db;"><i class="fa-solid fa-list"></i> View All Orders</a>
        <a href="reports.php" class="btn btn-secondary" style="background:#e67e22; color:white; text-decoration:none; padding:10px 20px; border-radius:5px; font-weight:600; display:inline-block;"><i class="fa-solid fa-chart-line"></i> View Detailed Sales Reports</a>
    </div>
</div>


<?php include "includes/footer.php"; ?>
