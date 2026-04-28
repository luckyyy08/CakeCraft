<?php
session_start();
include "includes/db.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Shipping Policy | CakeCraft</title>
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
        <h2 class="page-title">Shipping Policy</h2>
        
        <div class="page-text-card">
            <p style="margin-bottom:20px; font-weight: 500;">At CakeCraft, we strive to deliver your sweet surprises and gifts on time, every time. Please read our shipping policy to understand our delivery process clearly.</p>

            <h3><i class="fa-solid fa-map-location-dot" style="color: #749343; margin-right: 8px;"></i> 1. Delivery Locations</h3>
            <p>Currently, we exclusively deliver across <strong>Nashik and its surrounding regions</strong>. Hall decorations and bookings are executed at the customer's selected venue within Nashik limits.</p>

            <h3><i class="fa-regular fa-clock" style="color: #749343; margin-right: 8px;"></i> 2. Delivery Timings</h3>
            <ul>
                <li><strong>Standard Delivery:</strong> Deliveries are generally made between 9:00 AM to 9:00 PM.</li>
                <li><strong>Midnight Delivery:</strong> Surprise deliveries are made between 11:30 PM to 12:15 AM (Applicable for advance orders only).</li>
                <li><strong>Fixed Time Delivery:</strong> You can choose a specific 2-hour slot for your delivery with an additional fee.</li>
            </ul>

            <h3><i class="fa-solid fa-calendar-check" style="color: #749343; margin-right: 8px;"></i> 3. Same Day Delivery</h3>
            <p>Orders must be placed before 5:00 PM for same-day delivery. If an order is placed after the cutoff time, it will automatically be scheduled for the next day, unless discussed and approved by our support team.</p>

            <h3><i class="fa-solid fa-file-invoice-dollar" style="color: #749343; margin-right: 8px;"></i> 4. Delivery Charges</h3>
            <p>Shipping charges are calculated based on the delivery distance from our central bakery. Standard shipping within a 5km radius is free of charge.</p>
            
            <p style="margin-top: 40px; display: flex; align-items:center; gap: 15px; background: #eef8f3; padding: 20px; border-radius: 8px; color: #008542; font-weight: 500; border-left: 4px solid #008542;">
                <i class="fa-solid fa-truck-fast" style="font-size: 28px;"></i> We handle our cakes with care so they reach you fresh and beautiful.
            </p>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>
</body>
</html>
