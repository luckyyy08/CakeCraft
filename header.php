<?php
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CakeCraft - Online Bakery & Custom Cake</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@500;600;700&family=Pacifico&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center">
            <img src="img/logo1.png" alt="CakeCraft Logo" class="logo-img">
        </a>

        <!-- Search Box (After Logo) -->

        <form class="cake-search d-flex align-items-center ms-3" role="search">

            <input type="search" placeholder="Search & Book Your Celebration Cake Now........" class="font-secondary text-primary mb-4"
        id=" searchInput" onkeyup="searchCakes()">

        </form>
        <!-- RIGHT: User Section -->
        <div class="user-section d-flex align-items-center ms-auto">

            <!-- Wishlist -->
            <!-- <a href="#" class="user-icon" title="Wishlist">
                <i class="fas fa-heart"></i>
            </a> -->

            <!-- Cart -->
            <!-- <a href="#" class="user-icon position-relative" title="Cart">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count">2</span>
            </a> -->

 <!-- User Dropdown -->
<div class="dropdown user-dropdown">
    <a href="#" class="user-avatar dropdown-toggle" data-bs-toggle="dropdown">
        <i class="fas fa-user-circle"></i>
    </a>

    <ul class="dropdown-menu dropdown-menu-end user-menu">

        <?php if (isset($_SESSION['user_id'])): ?>

            <!-- Logged In User -->
            <li class="dropdown-header text-center fw-bold">
                👋 Hi, <?php echo $_SESSION['user_name']; ?>
            </li>

            <li>
                <a class="dropdown-item" href="profile.php">
                    <i class="fas fa-user me-2"></i> My Profile
                </a>
            </li>

            <li>
                <a class="dropdown-item" href="orders.php">
                    <i class="fas fa-box me-2"></i> My Orders
                </a>
            </li>

            <li>
                <a class="dropdown-item" href="favorites.php">
                    <i class="fas fa-heart me-2"></i> Favorites
                </a>
            </li>

            <li><hr class="dropdown-divider"></li>

            <li>
                <a class="dropdown-item text-danger" href="logout.php">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </a>
            </li>

        <?php else: ?>

            <!-- Guest User -->
            <li class="dropdown-header text-center">
                Guest User
            </li>

            <li>
                <a class="dropdown-item" href="login.php">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </a>
            </li>

            <li>
                <a class="dropdown-item" href="create.php">
                    <i class="fas fa-user-plus me-2"></i> Register
                </a>
            </li>

        <?php endif; ?>

    </ul>
</div>


    </nav>
    <!-- Navbar End -->
</body>