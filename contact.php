<?php
session_start();
include "includes/db.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact Us | CakeCraft</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/help_layout.css">
</head>
<body style="background: #fdfbf7;">
<?php include "includes/header.php"; ?>

<div class="help-container">
    
    <!-- Sidebar Links to existing policies -->
    <?php include "includes/help_sidebar.php"; ?>

    <!-- Main Content -->
    <div class="help-content">
        <h2 class="page-title">Contact Us</h2>
        
        <div class="page-text-card" style="text-align: center;">
            <i class="fa-solid fa-headset" style="font-size: 50px; color: #749343; margin-bottom: 20px;"></i>
            <h3 style="margin-top: 0; font-size: 24px; text-align: center;">We're Here to Help!</h3>
            <p style="font-size: 16px;">If you have any questions, concerns, or need assistance with your order, please do not hesitate to reach out to our support team.</p>
            
            <div style="margin-top: 40px; display: flex; justify-content: center; gap: 20px; text-align: left; flex-wrap: wrap;">
                <div style="background: #fdfbf7; padding: 20px; border-radius: 8px; flex: 1; min-width: 200px; text-align: center; border: 1px solid #eef3e6;">
                    <i class="fa-solid fa-phone" style="color:#e67e22; font-size: 28px; margin-bottom: 15px;"></i><br>
                    <strong style="color: #333; display: block; margin-bottom: 5px; font-size: 16px;">Call Us</strong>
                    <a href="tel:+919876543210" style="color: #666; text-decoration: none; font-size: 15px;">+91 98765 43210</a>
                </div>
                <div style="background: #fdfbf7; padding: 20px; border-radius: 8px; flex: 1; min-width: 200px; text-align: center; border: 1px solid #eef3e6;">
                    <i class="fa-solid fa-envelope" style="color:#e67e22; font-size: 28px; margin-bottom: 15px;"></i><br>
                    <strong style="color: #333; display: block; margin-bottom: 5px; font-size: 16px;">Email Us</strong>
                    <a href="mailto:support@cakecraft.com" style="color: #666; text-decoration: none; font-size: 15px;">support@cakecraft.com</a>
                </div>
                <div style="background: #fdfbf7; padding: 20px; border-radius: 8px; flex: 1; min-width: 200px; text-align: center; border: 1px solid #eef3e6;">
                    <i class="fa-brands fa-whatsapp" style="color:#25D366; font-size: 28px; margin-bottom: 15px;"></i><br>
                    <strong style="color: #333; display: block; margin-bottom: 5px; font-size: 16px;">WhatsApp</strong>
                    <a href="https://wa.me/919876543210" style="color: #666; text-decoration: none; font-size: 15px;">+91 98765 43210</a>
                </div>
            </div>
            
            <div style="margin-top: 50px; padding-top: 30px; border-top: 1px dashed #ddd; text-align: center;">
                <i class="fa-solid fa-location-dot" style="color:#749343; font-size: 28px; margin-bottom: 15px;"></i>
                <h3 style="margin: 0 0 10px 0; text-align: center;">Our Store Address</h3>
                <p style="margin: 0; font-size: 16px;">123 Bakery Lane, College Road, Nashik, Maharashtra 422005</p>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>
</body>
</html>
