<?php
session_start();
include "includes/db.php";

if (isset($_POST['login'])) 
{
    $email = $_POST['email'];    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE email='$email'";    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    if ($user && password_verify($password, $user['password'])) 
{
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php");
    }    else 
{        echo "<script src='assets/js/login.js'></script>";    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Back | CakeCraft</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>

<div class="auth-wrapper">
    <!-- Close / Back Button -->
    <a href="index.php" class="back-btn"><i class="fa-solid fa-xmark"></i> Close</a>

    <!-- Left Side: Image -->
    <div class="auth-side-image">
        <img src="assets/images/cakes/wcake1.jpeg" alt="CakeCraft Login" onerror="this.src='https://images.unsplash.com/photo-1578985545062-69928b1d9587?q=80&w=1000&auto=format&fit=crop';">
        <div class="overlay">
            <h1>Create Sweet Memories</h1>
            <p>Login to explore our handcrafted desserts and personalized gifts tailored just for you.</p>
        </div>
    </div>

    <!-- Right Side: Form -->
    <div class="auth-form-container">
        <div class="auth-header">
            <h2>Welcome Back</h2>
            <p>Please enter your credentials to login</p>
        </div>

        <form method="POST">
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                <i class="fa-regular fa-envelope"></i>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <i class="fa-solid fa-lock"></i>
            </div>
            
            <button type="submit" name="login" class="btn-auth">Login to Account</button>
        </form>

        <div class="auth-footer">
            <p>New to CakeCraft? <a href="register.php">Create an account</a></p>
        </div>
    </div>
</div>

</body>
</html>