<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT fullname, email, mobile FROM users WHERE id=?";
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
        }
        .sidebar a {
            display: block;
            padding: 12px;
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

        /* ===== SLIDE PANEL ===== */
        .profile-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            display: none;
            z-index: 998;
        }

        .profile-panel {
            position: fixed;
            top: 0;
            right: -420px;
            width: 420px;
            height: 100vh;
            background: #fff;
            z-index: 999;
            transition: 0.35s ease;
            display: flex;
            flex-direction: column;
        }

        .profile-panel.active {
            right: 0;
        }

        .panel-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
        }

        .panel-header span {
            cursor: pointer;
            font-size: 20px;
        }

        .panel-body {
            padding: 25px;
            flex: 1;
        }

        .panel-body label {
            font-weight: 600;
            font-size: 14px;
        }

        .info-row input {
            border: none;
            border-bottom: 1px solid #ccc;
            border-radius: 0;
            padding: 8px 5px;
        }

        .info-row input:focus {
            outline: none;
            box-shadow: none;
            border-color: #d4a017;
        }

        .panel-footer {
            padding: 15px;
            border-top: 1px solid #eee;
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

        <!-- FIXED BUTTON -->
        <button class="btn btn-outline-dark btn-sm" onclick="openProfileEdit()">
            EDIT PROFILE
        </button>
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

<!-- OVERLAY -->
<div id="profileOverlay" class="profile-overlay" onclick="closeProfileEdit()"></div>

<!-- SLIDE PANEL -->
<div id="profilePanel" class="profile-panel">
    <div class="panel-header">
        <h5>Edit profile</h5>
        <span onclick="closeProfileEdit()">✕</span>
    </div>

    <form action="update_profile.php" method="POST">
        <div class="panel-body">

            <label>Phone number</label>
            <div class="info-row">
                <input type="text" name="mobile"
                       value="<?php echo $user['mobile']; ?>" class="form-control-1">
            </div>

            <label class="mt-4">Email id</label>
            <div class="info-row">
                <input type="email"
                       value="<?php echo $user['email']; ?>"
                       class="form-control-1" readonly>
            </div>

        </div>

        <div class="panel-footer">
            <button type="submit" class="btn btn-warning w-100">
                SAVE CHANGES
            </button>
        </div>
    </form>
</div>

<!-- JS -->
<script>
function openProfileEdit() {
    document.getElementById("profilePanel").classList.add("active");
    document.getElementById("profileOverlay").style.display = "block";
}

function closeProfileEdit() {
    document.getElementById("profilePanel").classList.remove("active");
    document.getElementById("profileOverlay").style.display = "none";
}
</script>

</body>
</html>
