

<link rel="stylesheet" href="assets/css/header.css">




<header class="header-main">
    <a href="index.php" class="brand-logo">
        <img src="assets/images/logo.png" alt="CakeCraft" onerror="this.src='https://via.placeholder.com/150x50?text=CakeCraft'">
    </a>

    <form class="search-container" action="search.php" method="GET">
        <input type="text" name="q" placeholder="Search cakes, gifts, decorations etc." value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>" required>
        <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>

    <div class="nav-icons">
        <?php 
        $header_user_name = "Login";
        $profile_link = "login.php";
        if(isset($_SESSION['user_id'])){
            $h_user_id = $_SESSION['user_id'];
            $profile_link = "profile.php";
            $h_res = mysqli_query($conn, "SELECT fullname FROM users WHERE id='$h_user_id'");
            if($h_res && mysqli_num_rows($h_res) > 0){
                $h_row = mysqli_fetch_assoc($h_res);
                $header_user_name = explode(" ", $h_row['fullname'])[0]; 
            } else {
                $header_user_name = "Profile";
            }
        }
        ?>
        <a href="<?php echo $profile_link; ?>"><i class="fa-regular fa-user"></i><span><?php echo htmlspecialchars($header_user_name); ?></span></a>
        <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i><span>Cart</span></a>
        <a href="wishlist.php"><i class="fa-regular fa-heart"></i><span>Wishlist</span></a>
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Logout</span></a>
        <?php endif; ?>
    </div>
</header>

<nav class="category-nav">
    <a href="cakes.php">Cakes</a>
    <a href="balloon-decoration.php">Decorations</a>

    <a href="gift-hamper.php">Gift Hampers</a>
    <a href="candles.php">Candles</a>

    
</nav>