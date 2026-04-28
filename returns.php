<?php
session_start();
include "includes/db.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Returns & Refunds | CakeCraft</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/returns.css">
</head>
<body>
<?php include "includes/header.php"; ?>

<div class="page-header">
    <h1 style="color: #008542;">Returns & Refunds</h1>
</div>

<div class="page-content">
    <div style="background: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <p>Because our products are highly perishable, we at CakeCraft have a specific return policy regarding Cakes, Flowers, and personalized gifts.</p>

        <h3>1. Damaged or Defective Items</h3>
        <p>If you receive a product that is damaged or not as per the description, please contact us within 2 hours of delivery. Share a picture of the product at <strong>support@cakecraft.com</strong> for our reference. After 2 hours, we will be unable to accept the claim.</p>

        <h3>2. Refunds & Process</h3>
        <ul>
            <li>Once your return/complaint is verified by our team, we will either replace the product or issue a full or partial refund based on the severity.</li>
            <li>In case of a refund, the amount will be processed to the original mode of payment within <strong>5-7 working days</strong>.</li>
            <li>For Cash on Delivery (COD) orders, a store credit or UPI transfer will be provided.</li>
        </ul>

        <h3>3. Cancellations</h3>
        <p>If you wish to cancel an order, please do so at least 24 hours prior to the scheduled delivery time to receive a full refund. Last-minute cancellations (within 12 hours) will result in a 50% cancellation fee.</p>

        <h3>4. Non-Refundable Items</h3>
        <p>Personalized cakes (photo cakes) and customized gift hampers are non-refundable once preparation has started.</p>
        
        <p style="margin-top: 40px; display: flex; align-items:center; gap: 10px; background: #fff3cd; padding: 15px; border-radius: 6px; color: #856404; font-weight: 500;">
            <i class="fa-solid fa-triangle-exclamation" style="font-size: 24px;"></i> Customer satisfaction is our priority. If there's a genuine issue, we are always here to resolve it reasonably.
        </p>
    </div>
</div>

<?php include "includes/footer.php"; ?>
</body>
</html>
