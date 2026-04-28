<?php
session_start();
include "includes/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$tab = isset($_GET['tab']) ? $_GET['tab'] : 'profile';

// Handle Profile Update
$update_msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    
    $update_query = "UPDATE users SET fullname='$fullname', mobile='$mobile' WHERE id='$user_id'";
    if (mysqli_query($conn, $update_query)) {
        $update_msg = "<div class='alert-success'><i class='fa-solid fa-circle-check'></i> Profile updated successfully!</div>";
    } else {
        $update_msg = "<div class='alert-danger'><i class='fa-solid fa-circle-xmark'></i> Failed to update profile.</div>";
    }
}

// Handle Add Address
if (isset($_POST['add_new_address'])) {
    $fn = mysqli_real_escape_string($conn, $_POST['addr_fullname']);
    $mb = mysqli_real_escape_string($conn, $_POST['addr_mobile']);
    $pc = mysqli_real_escape_string($conn, $_POST['addr_pincode']);
    $ct = mysqli_real_escape_string($conn, $_POST['addr_city']);
    $af = mysqli_real_escape_string($conn, $_POST['addr_full']);
    $tp = $_POST['addr_type'];

    $iq = "INSERT INTO user_addresses (user_id, fullname, mobile, pincode, city, area_street, address_type) VALUES ('$user_id', '$fn', '$mb', '$pc', '$ct', '$af', '$tp')";
    if (mysqli_query($conn, $iq)) {
        $update_msg = "<div class='alert-success'><i class='fa-solid fa-circle-check'></i> Address added!</div>";
    }
}

// Handle Delete Address
if (isset($_GET['delete_addr'])) {
    $aid = intval($_GET['delete_addr']);
    mysqli_query($conn, "DELETE FROM user_addresses WHERE id='$aid' AND user_id='$user_id'");
    $update_msg = "<div class='alert-success'><i class='fa-solid fa-circle-check'></i> Address deleted!</div>";
}

// Fetch user details
$stmt = $conn->prepare("SELECT fullname, email, mobile FROM users WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Account | CakeCraft</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/profile.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<?php include "includes/header.php"; ?>

<div class="profile-container">

    <!-- SIDEBAR -->
    <aside class="profile-sidebar">
        <div class="user-greeting">
            <div class="avatar">
                <?php echo strtoupper(substr($user['fullname'] ?? 'U', 0, 1)); ?>
            </div>
            <h3><?php echo htmlspecialchars($user['fullname'] ?? 'User'); ?></h3>
        </div>
        <ul class="sidebar-menu">
            <li class="<?php echo ($tab == 'profile') ? 'active' : ''; ?>">
                <a href="profile.php?tab=profile"><i class="fa-regular fa-user"></i> My Profile</a>
            </li>
            <li class="<?php echo ($tab == 'orders') ? 'active' : ''; ?>">
                <a href="profile.php?tab=orders"><i class="fa-solid fa-box-open"></i> My Orders</a>
            </li>
            <li class="<?php echo ($tab == 'addresses') ? 'active' : ''; ?>">
                <a href="profile.php?tab=addresses"><i class="fa-solid fa-location-dot"></i> My Addresses</a>
            </li>

            <li>
                <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
            </li>
        </ul>
    </aside>

    <!-- CONTENT -->
    <main class="profile-content">
        <?php echo $update_msg; ?>

        <?php if($tab == 'profile'): ?>
            <h2>Personal Information</h2>
            <form method="post" action="profile.php?tab=profile">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="fullname" class="form-control" value="<?php echo htmlspecialchars($user['fullname'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" class="form-control" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" readonly title="Email cannot be changed">
                </div>
                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" name="mobile" class="form-control" value="<?php echo htmlspecialchars($user['mobile'] ?? ''); ?>">
                </div>
                <button type="submit" name="update_profile" class="btn-primary">Save Changes</button>
            </form>

        <?php elseif($tab == 'orders'): ?>
            <h2>My Recent Orders</h2>
            <?php
            $order_query = "SELECT *, (SELECT COUNT(*) FROM orders o2 WHERE o2.user_id = orders.user_id AND o2.id <= orders.id) as personal_order_num FROM orders WHERE user_id='$user_id' ORDER BY order_date DESC";
            $order_result = mysqli_query($conn, $order_query);
            
            if(mysqli_num_rows($order_result) > 0) {
                while($order = mysqli_fetch_assoc($order_result)) {
            ?>
               <div class="order-card" style="display:block;">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <div class="order-info">
            <h4>Order #<?php echo $order['personal_order_num']; ?></h4>
            <p style="font-size:11px; color:#aaa; margin:0 0 5px 0;">(Tracking ID: ORD-<?php echo str_pad($order['id'], 4, '0', STR_PAD_LEFT); ?>)</p>
            <p><strong>Date:</strong> <?php echo date('d M Y, h:i A', strtotime($order['order_date'])); ?></p>
            <p><strong>Delivery:</strong> <?php echo $order['delivery_date'] ? date('d M', strtotime($order['delivery_date'])) . ' (' . htmlspecialchars($order['delivery_time']) . ')' : 'Standard'; ?></p>
            <p><strong>Total Amount:</strong> ₹ <?php echo number_format($order['total_price'], 2); ?></p>
            <p><strong>Payment:</strong> <?php echo $order['payment_type'] ? htmlspecialchars($order['payment_type']) : 'N/A'; ?> 
                (<span style="font-weight:600; color:<?php echo ($order['payment_status']=='Paid') ? '#008542' : (($order['payment_status']=='Refunded') ? '#e67e22' : '#d32f2f'); ?>;">
                    <?php echo htmlspecialchars($order['payment_status'] ?? 'Pending'); ?>
                </span>)
            </p>
        </div>
        <div style="display:flex; flex-direction:column; gap:10px; align-items:flex-end;">
            <span class="order-status status-<?php echo str_replace(' ', '', htmlspecialchars($order['order_status'] ?? 'Pending')); ?>">
                <?php echo htmlspecialchars($order['order_status'] ?? 'Pending'); ?>
            </span>
            <a href="order_detail.php?order_id=<?php echo $order['id']; ?>" class="btn-primary" style="padding:8px 15px; font-size:14px;">View Details</a>
        </div>
    </div>
    
    <div style="margin-top:15px; padding-top:10px; border-top:1px solid #eee; font-weight: 600; color: #555;">
        Current Delivery Status: <span style="color: #008542;"><?php echo htmlspecialchars($order['order_status'] ?? 'Pending'); ?></span>
    </div>
</div>
            <?php
                }
            } else {
            ?>
                <div class="empty-state">
                    <i class="fa-solid fa-box-open"></i>
                    <h3>No Orders Found</h3>
                    <p>Looks like you haven't placed an order yet.</p>
                    <a href="cakes.php" class="btn-primary" style="display:inline-block; margin-top:15px; text-decoration:none;">Start Shopping</a>
                </div>
            <?php } ?>

        <?php elseif($tab == 'addresses'): ?>
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px;">
                <h2 style="margin:0;">Manage Addresses</h2>
                <button onclick="$('#add-address-form').slideToggle()" class="btn-primary" style="background:#008542;"><i class="fa-solid fa-plus"></i> Add New Address</button>
            </div>

            <!-- Add Address Form (Hidden by default) -->
            <div id="add-address-form" style="display:none; background:#f9f9f9; padding:20px; border-radius:8px; margin-bottom:30px; border:1px solid #eee;">
                <h3>Add a New Address</h3>
                <form method="POST" action="profile.php?tab=addresses">
                    <div style="display:flex; gap:15px; margin-bottom:15px;">
                        <input type="text" name="addr_fullname" class="form-control" placeholder="Full Name" required>
                        <input type="text" name="addr_mobile" class="form-control" placeholder="10-digit mobile number" required>
                    </div>
                    <div style="display:flex; gap:15px; margin-bottom:15px;">
                        <input type="text" name="addr_pincode" class="form-control" placeholder="Pincode" required>
                        <input type="text" name="addr_city" class="form-control" placeholder="City" required>
                    </div>
                    <textarea name="addr_full" class="form-control" placeholder="Detailed Address (House No, Area, Street...)" required style="margin-bottom:15px;"></textarea>
                    <div style="margin-bottom:15px;">
                        <label>Address Type: </label>
                        <input type="radio" name="addr_type" value="Home" checked> Home
                        <input type="radio" name="addr_type" value="Work"> Work
                    </div>
                    <button type="submit" name="add_new_address" class="btn-primary">Save Address</button>
                </form>
            </div>

            <div class="address-grid" style="display:grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap:20px;">
                <?php
                $addr_query = "SELECT * FROM user_addresses WHERE user_id='$user_id' ORDER BY created_at DESC";
                $addr_result = mysqli_query($conn, $addr_query);
                if(mysqli_num_rows($addr_result) > 0) {
                    while($addr = mysqli_fetch_assoc($addr_result)) {
                ?>
                    <div class="address-item" style="border:1px solid #eee; padding:15px; border-radius:8px; position:relative;">
                        <span style="font-size:10px; background:#eee; padding:2px 6px; border-radius:4px; font-weight:bold; float:right;"><?php echo $addr['address_type']; ?></span>
                        <h4 style="margin:0 0 10px 0;"><?php echo htmlspecialchars($addr['fullname']); ?></h4>
                        <p style="font-size:14px; color:#555; margin-bottom:10px;">
                            <?php echo htmlspecialchars($addr['area_street']); ?><br>
                            <?php echo htmlspecialchars($addr['city'] . " - " . $addr['pincode']); ?><br>
                            <strong>Phone:</strong> <?php echo htmlspecialchars($addr['mobile']); ?>
                        </p>
                        <div style="display:flex; gap:10px;">
                            <a href="profile.php?tab=addresses&delete_addr=<?php echo $addr['id']; ?>" onclick="return confirm('Are you sure you want to delete this address?')" style="color:#d32f2f; font-size:13px; text-decoration:none;"><i class="fa-regular fa-trash-can"></i> Delete</a>
                        </div>
                    </div>
                <?php
                    }
                } else {
                    echo "<p>No saved addresses found. Add one to speed up checkout!</p>";
                }
                ?>
            </div>
        <?php endif; ?>
        
    </main>

</div>

</body>
</html>