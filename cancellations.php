<?php
session_start();
include "includes/db.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cancellation & Refunds | CakeCraft</title>
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
        <h2 class="page-title">Cancellation & Refund Policy</h2>
        
        <div class="page-text-card">
            <p style="margin-bottom:20px; font-weight: 500;">Because our products (Cakes, Flowers, and Personalized Gifts) are highly perishable and custom-made according to your order, <strong>we do not accept any Returns.</strong></p>

            <h3><i class="fa-solid fa-ban" style="color: #d32f2f; margin-right: 8px;"></i> 1. No Return Policy</h3>
            <p>Once a cake or perishable product is delivered and accepted by the customer, it cannot be returned or exchanged under any circumstances. We ensure absolute hygiene and strict quality checks before dispatching any order.</p>

            <h3><i class="fa-solid fa-heart-crack" style="color: #749343; margin-right: 8px;"></i> 2. Damaged or Defective Items</h3>
            <p>If you receive a product that is severely damaged during transit, please contact us immediately (within 1 hour of delivery). Please share a clear picture of the damaged product at <strong>support@cakecraft.com</strong> or our WhatsApp number. After verification, we will provide a replacement or a partial/full refund depending on the issue.</p>

            <h3><i class="fa-solid fa-xmark" style="color: #749343; margin-right: 8px;"></i> 3. Cancellations by Customer</h3>
            <ul>
                <li><strong>Advance Orders:</strong> Orders must be cancelled at least 24 hours prior to the scheduled delivery time to receive a full refund.</li>
                <li><strong>Same-Day Orders:</strong> Same-day delivery orders cannot be cancelled once the preparation has begun (usually within 30 minutes of placing the order).</li>

            </ul>

            <h3><i class="fa-solid fa-money-bill-transfer" style="color: #749343; margin-right: 8px;"></i> 4. Refund Process</h3>
            <p>Any approved refunds will be initiated to your original payment method (Online Payment) within 5-7 business days. For Cash on Delivery (COD) scenarios where payment was done via UPI upon delivery, it will be refunded back to the same UPI ID.</p>
            
            <p style="margin-top: 40px; display: flex; align-items:center; gap: 15px; background: #fff3cd; padding: 20px; border-radius: 8px; color: #856404; font-weight: 500; border-left: 4px solid #856404;">
                <i class="fa-solid fa-triangle-exclamation" style="font-size: 28px;"></i> Quality and hygiene are our utmost priority. We appreciate your understanding of our no-return policy.
            </p>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>
</body>
</html>
