<?php
session_start();
include "includes/db.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Help Center | CakeCraft</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/help_layout.css">
    <link rel="stylesheet" href="assets/css/help.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<div class="help-header">
    <h1>Hello, How can we help?</h1>
    <p>Find answers to frequently asked questions and get in touch with our team.</p>
</div>

<div class="help-container">
    
    <!-- Sidebar Links to existing policies -->
    <?php include "includes/help_sidebar.php"; ?>

    <!-- Main FAQ Content -->
    <div class="help-content">
        <h2 style="color: #333; margin-bottom: 25px; font-size: 24px;">Frequently Asked Questions (FAQs)</h2>

        <div class="faq-card">
            <h4><i class="fa-regular fa-clock" style="color:#749343;"></i> Do you provide Same-Day Delivery?</h4>
            <p>Yes! We offer same-day delivery for most cakes, flowers, and hampers within Nashik if the order is placed before our daily cut-off time (typically 6:00 PM).</p>
        </div>

        <div class="faq-card">
            <h4><i class="fa-solid fa-moon" style="color:#749343;"></i> Is Midnight Delivery available for birthdays?</h4>
            <p>Absolutely. You can select the Midnight Delivery option during checkout. Our delivery executives will deliver your surprise right as the clock strikes 12!</p>
        </div>

        <div class="faq-card">
            <h4><i class="fa-solid fa-xmark" style="color:#749343;"></i> Can I cancel or modify my confirmed order?</h4>
            <p>Since our products are perishable and customized, same-day orders cannot be cancelled. For advance orders, you can request a cancellation at least 24 hours prior to the delivery slot. Please refer to our <a href="cancellations.php" style="color:#e67e22;">Cancellation Policy</a> for more details.</p>
        </div>

        <div class="faq-card">
            <h4><i class="fa-solid fa-map-location-dot" style="color:#749343;"></i> How can I track my order status?</h4>
            <p>You can easily track your order by logging into your account and visiting the <strong>User Profile</strong> -> <strong>My Orders</strong> section. Once the delivery executive is dispatched, the status will be updated to "Out for Delivery".</p>
        </div>

        <!-- Contact US Action -->
        <div class="contact-box">
            <h3>Still need help?</h3>
            <p>If you couldn't find the answer to your question, our support team is ready to assist you.</p>
            <a href="contact.php" class="btn"><i class="fa-regular fa-envelope"></i> Contact Support</a>
        </div>

    </div>

</div>

<?php include "includes/footer.php"; ?>

</body>
</html>
