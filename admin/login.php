<?php
session_start();
include "../includes/db.php";

if(isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

$error = '';
if(isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if($result && mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);
        if(password_verify($password, $admin['password']) || $password == $admin['password']) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_user'] = $admin['username'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid Username or Password";
        }
    } else {
        // Auto-create default admin (admin / admin123) if no users exist
        $check_empty = mysqli_query($conn, "SELECT count(*) as count FROM admin");
        $row = mysqli_fetch_assoc($check_empty);
        if($row['count'] == 0 && $username == 'admin' && $password == 'admin123') {
            $hash = password_hash('admin123', PASSWORD_DEFAULT);
            mysqli_query($conn, "INSERT INTO admin (username, password) VALUES ('admin', '$hash')");
            $_SESSION['admin_id'] = 1;
            $_SESSION['admin_user'] = 'admin';
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid Username or Password";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login | CakeCraft</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

<div class="login-box">
    <i class="fa-solid fa-user-shield" style="font-size: 50px; color: #008542; margin-bottom: 15px;"></i>
    <h2>Secure Admin Panel</h2>
    <p>Sign in to manage your e-commerce store</p>
    
    <?php if($error != ''): ?>
        <div class="error-msg"><i class="fa-solid fa-circle-exclamation"></i> <?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Admin Username" required>
            <i class="fa-solid fa-user"></i>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Admin Password" required>
            <i class="fa-solid fa-lock"></i>
        </div>
        <p style="font-size: 12px; color: #888; text-align: left;"><i class="fa-solid fa-circle-info"></i> Default login: admin / admin123</p>
        <button type="submit" name="login" class="btn-login">Login to Dashboard</button>
    </form>
    <a href="../index.php" style="display:inline-block; margin-top: 20px; color: #666; text-decoration: none; font-size: 14px;"><i class="fa-solid fa-arrow-left"></i> Back to Storefront</a>
</div>

</body>
</html>
