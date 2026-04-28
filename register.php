<?php
include "includes/db.php";

if (isset($_POST['register'])) 
{
    $fullname = $_POST['fullname'];    $email = $_POST['email'];    $mobile = $_POST['mobile'];    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $query = "INSERT INTO users(fullname,email,mobile,password)
VALUES('$fullname','$email','$mobile','$password')";
    if (mysqli_query($conn, $query)) 
    {
        // Send Welcome Email
        $to = $email;
        $subject = "Welcome to CakeCraft!";
        $message = "
        <html>
        <head><title>Welcome to CakeCraft</title></head>
        <body>
        <h2>Hello $fullname,</h2>
        <p>Thank you for registering at CakeCraft!</p>
        <p>We are thrilled to have you. Explore our delicious cakes and sweet treats.</p>
        <br>
        <p>Best Regards,<br><b>CakeCraft Team</b></p>
        </body>
        </html>
        ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: CakeCraft <noreply@cakecraft.com>' . "\r\n";
        @mail($to, $subject, $message, $headers);

        echo "<script src='assets/js/register.js'></script>";
    }
    else
{        echo "Error";    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join the Celebration | CakeCraft</title>
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
        <img src="assets/images/cakes/pcake2.jpeg" alt="CakeCraft Register" onerror="this.src='https://images.unsplash.com/photo-1549465220-1a8b9238cd48?q=80&w=1000&auto=format&fit=crop';">
        <div class="overlay" style="background: linear-gradient(135deg, rgba(0, 133, 66, 0.7) 0%, rgba(44, 62, 80, 0.8) 100%);">
            <h1>Join CakeCraft</h1>
            <p>Become a member today and unlock exclusive rewards, faster checkout, and sweet surprises!</p>
        </div>
    </div>

    <!-- Right Side: Form -->
    <div class="auth-form-container">
        <div class="auth-header">
            <h2>Create Account</h2>
            <p>Fill in your details to get started</p>
        </div>

        <form method="POST">
            <div class="form-group">
                <input type="text" name="fullname" class="form-control" placeholder="Full Name" required>
                <i class="fa-regular fa-user"></i>
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                <i class="fa-regular fa-envelope"></i>
            </div>
            <div class="form-group">
                <input type="text" name="mobile" class="form-control" placeholder="Mobile Number" required>
                <i class="fa-solid fa-phone"></i>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <i class="fa-solid fa-lock"></i>
            </div>
            
            <button type="submit" name="register" class="btn-auth btn-register">Register Now</button>
        </form>

        <div class="auth-footer">
            <p>Already have an account? <a href="login.php">Sign In Here</a></p>
        </div>
    </div>
</div>

</body>
</html>