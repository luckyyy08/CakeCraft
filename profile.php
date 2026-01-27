<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT fullname, mobile FROM users WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Account - CakeCraft</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & Icons -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
       
        .account-header {
            
            color: #5A2D1D;
            padding: 30px;
        }
        .account-box {
            background: #fff;
            border-radius: 6px;
            min-height: 420px;
        }
        .sidebar {
            background: #f5f7f8;
            padding: 20px;
            height: 100%;
        }
        .sidebar a {
            display: block;
            padding: 12px 10px;
            color: #333;
            font-weight: 500;
            text-decoration: none;
            border-radius: 4px;
        }
        .sidebar a:hover,
        .sidebar a.active {
            background: #e9ecef;
        }
        .empty-box {
            text-align: center;
            padding: 80px 20px;
            color: #777;
        }
    </style>
</head>

<body>

<?php include 'header.php'; ?>

<!-- TOP USER INFO -->
<div class="account-header">
    <div class="container d-flex justify-content-between align-items-center">
        <div>
            <h3 class="mb-1"><?php echo $user['fullname']; ?></h3>
            <small><?php echo $user['mobile']; ?></small>
        </div>
        <a href="profile_edit.php" class="btn btn-outline-light btn-sm">EDIT PROFILE</a>
    </div>
</div>

<!-- ACCOUNT BODY -->
<div class="container my-4">
    <div class="row account-box shadow-sm">

        <!-- LEFT SIDEBAR -->
        <div class="col-md-3 sidebar">
            <a href="profile.php" class="active"><i class="fas fa-box me-2"></i> Orders</a>
            <a href="#"><i class="fas fa-heart me-2"></i> Favourites</a>
            <a href="#"><i class="fas fa-map-marker-alt me-2"></i> Addresses</a>
            <a href="#"><i class="fas fa-cog me-2"></i> Settings</a>
            <a href="logout.php" class="text-danger">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </a>
        </div>

        <!-- RIGHT CONTENT -->
        <div class="col-md-9">
            <div class="empty-box">
                <img src="img/no-order.png" width="120" class="mb-3">
                <h5>No Orders</h5>
                <p>You haven’t placed any order yet.</p>
                <a href="index.php" class="btn btn-primary btn-sm mt-2">
                    Order Cakes 🍰
                </a>
            </div>
        </div>

    </div>
</div>

</body>
</html>
