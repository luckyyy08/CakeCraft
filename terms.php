<?php
session_start();
include "includes/db.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Terms & Conditions | CakeCraft</title>
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
        <h2 class="page-title">Terms & Conditions</h2>
        
        <div class="page-text-card">
            <h3>1. General Terminology</h3>
            <p>Welcome to CakeCraft website! By continuing to use and browse our site, you agree to comply with our Terms & Conditions. The term 'CakeCraft', 'we', or 'us' refers to the owner of the website.</p>

            <h3>2. Liability</h3>
            <p>The content, products, and information shared on this website are for general use. These terms are subject to change without notice. We are not liable for any delays in delivery due to circumstances beyond our control (such as strikes, lockdowns, heavy rain, or traffic blockage).</p>

            <h3>3. Accuracy of Data</h3>
            <p>While we attempt to ensure website imagery (decorations, cake designs) is accurate, the actual final product may differ slightly due to the handcrafted nature of baked goods and decoration availability at the local level.</p>

            <h3>4. Unauthorized Use</h3>
            <p>Unauthorized use of our website, trademark, logo, and copyrighted product descriptions may give rise to a claim for damages or constitute a criminal offense.</p>

            <p style="margin-top: 40px; text-align: center; font-style: italic; color: #888; border-top: 1px dashed #ddd; padding-top: 20px;">By clicking 'Place Order' during checkout, you legally accept these terms.</p>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>
</body>
</html>
