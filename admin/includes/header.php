<?php
session_start();
include "../includes/db.php";
if(!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
// Get current page name for active sidebar link
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>CakeCraft Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/header.css">
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-header">
        <i class="fa-solid fa-cake-candles"></i> CakeCraft
    </div>
    <ul class="sidebar-menu">
        <li><a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>"><i class="fa-solid fa-gauge-high"></i> Dashboard</a></li>
        <li><a href="orders.php" class="<?php echo ($current_page == 'orders.php') ? 'active' : ''; ?>"><i class="fa-solid fa-cart-shopping"></i> All Orders</a></li>
        <li><a href="users.php" class="<?php echo ($current_page == 'users.php') ? 'active' : ''; ?>"><i class="fa-solid fa-users"></i> Customers</a></li>
        <li><a href="reports.php" class="<?php echo ($current_page == 'reports.php') ? 'active' : ''; ?>"><i class="fa-solid fa-chart-line"></i> Sales Reports</a></li>
        
        <li style="padding: 10px 15px 5px; font-size: 12px; font-weight: bold; text-transform: uppercase; color: #6c757d;">Products</li>
        <li><a href="cakes.php" class="<?php echo ($current_page == 'cakes.php') ? 'active' : ''; ?>"><i class="fa-solid fa-cake-candles"></i> Cakes</a></li>
        <li><a href="hampers.php" class="<?php echo ($current_page == 'hampers.php') ? 'active' : ''; ?>"><i class="fa-solid fa-gift"></i> Hampers</a></li>
        <li><a href="decorations.php" class="<?php echo ($current_page == 'decorations.php') ? 'active' : ''; ?>"><i class="fa-solid fa-wand-magic-sparkles"></i> Decorations</a></li>
        <li><a href="candles.php" class="<?php echo ($current_page == 'candles.php') ? 'active' : ''; ?>"><i class="fa-solid fa-fire-flame-simple"></i> Candles</a></li>
        

        
        <li style="padding: 10px 15px 5px; font-size: 12px; font-weight: bold; text-transform: uppercase; color: #6c757d;">Settings</li>
        <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
    </ul>
</aside>

<main class="main-content">
    <header class="topbar">
        <div>
            <span style="font-size:18px; font-weight:500; color:#555;">Welcome to Admin Panel</span>
        </div>
        <div class="topbar-right">
            <a href="../index.php" target="_blank"><i class="fa-solid fa-eye"></i> View Store</a>
            <div class="admin-profile">
                <i class="fa-solid fa-circle-user"></i>
                <?php echo htmlspecialchars($_SESSION['admin_user']); ?>
            </div>
        </div>
    </header>
    
    <div class="page-wrapper">
