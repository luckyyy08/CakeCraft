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
    <!-- Topbar Start -->
    <!-- <div class="container-fluid px-0 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-lg-4 text-center bg-secondary py-3">
                <div class="d-inline-flex align-items-center justify-content-center">
                    <i class="bi bi-envelope fs-1 text-primary me-3"></i>
                    <div class="text-start">
                        <h6 class="text-uppercase mb-1">Email Us</h6>
                        <span>CakeCraft@gmail.com</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center bg-primary border-inner py-3">
                <div class="d-inline-flex align-items-center justify-content-center">
                    <a href="index.html" class="navbar-brand">
                        <h1 class="m-0 text-uppercase text-white"><i
                                class="fa fa-birthday-cake fs-1 text-dark me-3"></i>CakeCraft</h1>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 text-center bg-secondary py-3">
                <div class="d-inline-flex align-items-center justify-content-center">
                    <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
                    <div class="text-start">
                        <h6 class="text-uppercase mb-1">Call Us</h6>
                        <span>+012 345 6789</span>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Topbar End -->


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
        <li class="dropdown-header text-center">
            Guest User
        </li>

        <li>
            <a class="dropdown-item" href="login_acc.php">
                <i class="fas fa-sign-in-alt me-2"></i> Login
            </a>
        </li>

        <li>
            <a class="dropdown-item" href="create_acc.php">
                <i class="fas fa-user-plus me-2"></i> Register
            </a>
        </li>

        <li><hr class="dropdown-divider"></li>

      
    </ul>
</div>


    </nav>
    <!-- Navbar End -->
</body>