
<?php
include "includes/db.php";
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Online Cake Delivery | CakeCraft</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<!-- HERO SLIDER -->
<section class="slider-container">
    
    <!-- Slide 1: Premium Cakes -->
    <div class="slide active" style="background: linear-gradient(135deg, #f7f9f2 0%, #eef3e6 100%);">
        <div class="slide-content">
            <span class="slide-subtitle" style="color: #749343; background: rgba(116, 147, 67, 0.1);">Celebrate Every Occasion</span>
            <h1 class="slide-title" style="color: #2d3e20;">Premium Cakes & <br>Fresh Bakes</h1>
            <p class="slide-desc" style="color: #555;">#1 Gifting Central with over 2 Million Smiles Delivered.<br>Same Day & Midnight Delivery Available in Nashik.</p>
            <a href="cakes.php" class="slide-btn">ORDER CAKES NOW</a>
        </div>
        <div class="slide-img-wrapper">
            <img src="assets/images/cakes/wcake1.jpeg" class="slide-img" onerror="this.src='https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=500';">
            <div style="position: absolute; width: 300px; height: 300px; background: rgba(116,147,67,0.08); border-radius: 50%; top: -30px; right: -30px; z-index: -1;"></div>
        </div>
    </div>

    <!-- Slide 2: Event Decorations -->
    <div class="slide" style="background: linear-gradient(135deg, #fff5f8 0%, #ffe6ee 100%);">
        <div class="slide-content">
            <span class="slide-subtitle" style="color: #d81b60; background: rgba(216, 27, 96, 0.1);">Surprise Setup</span>
            <h1 class="slide-title" style="color: #880e4f;">Magical Balloon <br>Decorations</h1>
            <p class="slide-desc" style="color: #555;">Transform your room into a magical wonderland.<br>Perfect for Birthdays, Anniversaries & Proposals.</p>
            <a href="balloon-decoration.php" class="slide-btn" style="background: #d81b60; box-shadow: 0 6px 20px rgba(216, 27, 96, 0.4);">BOOK DECORATION</a>
        </div>
        <div class="slide-img-wrapper">
            <img src="assets/images/decorations/decoration3.jpg" class="slide-img" style="border-color: rgba(255,255,255,0.9);" onerror="this.src='https://images.unsplash.com/photo-1530103862676-de8892bc952f?w=500';">
            <div style="position: absolute; width: 300px; height: 300px; background: rgba(216, 27, 96, 0.08); border-radius: 50%; top: -30px; right: -30px; z-index: -1;"></div>
        </div>
    </div>

    <!-- Slide 3: Gift Hampers & Candles -->
    <div class="slide" style="background: linear-gradient(135deg, #fdfbf7 0%, #f9f0d1 100%);">
        <div class="slide-content">
            <span class="slide-subtitle" style="color: #b7860b; background: rgba(183, 134, 11, 0.1);">Curated With Love</span>
            <h1 class="slide-title" style="color: #5c4033;">Exclusive Gift <br>Hampers</h1>
            <p class="slide-desc" style="color: #555;">Handpicked goodies wrapped in luxurious baskets.<br>Pair our premium scented candles with exquisite chocolates.</p>
            <a href="gift-hamper.php" class="slide-btn" style="background: #b7860b; box-shadow: 0 6px 20px rgba(183, 134, 11, 0.4);">EXPLORE HAMPERS</a>
        </div>
        <div class="slide-img-wrapper">
            <img src="assets/images/hampers/hamper1.jpg" class="slide-img" onerror="this.src='https://images.unsplash.com/photo-1549465220-1a8b9238cd48?w=500';">
            <div style="position: absolute; width: 300px; height: 300px; background: rgba(183, 134, 11, 0.08); border-radius: 50%; top: -30px; right: -30px; z-index: -1;"></div>
        </div>
    </div>



    <!-- Controls -->
    <!-- <button class="slider-arrow arrow-left" onclick="changeSlide(-1)"><i class="fa-solid fa-chevron-left"></i></button>
    <button class="slider-arrow arrow-right" onclick="changeSlide(1)"><i class="fa-solid fa-chevron-right"></i></button>
     -->
    <div class="slider-dots">
        <div class="dot active" onclick="goToSlide(0)"></div>
        <div class="dot" onclick="goToSlide(1)"></div>
        <div class="dot" onclick="goToSlide(2)"></div>

    </div>
</section>

<script src="assets/js/index.js"></script>

<!-- CATEGORIES SETUP -->
<section style="padding: 50px 0; background: #fff;">
    <h2 class="section-title">Shop by Category</h2>
    <div class="category-container">
        
        <a href="cakes.php" class="category-card">
            <div class="category-image-wrap" onmouseover="this.style.borderColor='#e67e22';" onmouseout="this.style.borderColor='#f2edd9';">
                <img src="assets/images/cakes/cake1.png">
            </div>
            <h4>Delicious Cakes</h4>
        </a>

        <a href="balloon-decoration.php" class="category-card">
            <div class="category-image-wrap" onmouseover="this.style.borderColor='#d81b60';" onmouseout="this.style.borderColor='#f2edd9';">
                <img src="assets/images/decorations/decoration1.jpg">
            </div>
            <h4>Decorations</h4>
        </a>

        <a href="gift-hamper.php" class="category-card">
            <div class="category-image-wrap" onmouseover="this.style.borderColor='#b7860b';" onmouseout="this.style.borderColor='#f2edd9';">
                <img src="assets/images/hampers/hamper1.jpg">
            </div>
            <h4>Gift Hampers</h4>
        </a>

        <a href="candles.php" class="category-card">
            <div class="category-image-wrap" onmouseover="this.style.borderColor='#008542';" onmouseout="this.style.borderColor='#f2edd9';">
                <img src="assets/images/candles/candle1.jpg">
            </div>
            <h4>Scented Candles</h4>
        </a>

    </div>
</section>

<!-- POPULAR CAKES -->
<section class="cakes" style="background:#f9f9f9; padding-bottom: 50px;">
    <h2 class="section-title">Bestselling Cakes</h2>
    
    <div class="cake-container">
        <?php
        $query="SELECT * FROM cakes ORDER BY created_at DESC LIMIT 6";
        $result=mysqli_query($conn,$query);
        
        while($cake=mysqli_fetch_assoc($result)) {
        ?>
        <div class="cake-card">
            <div class="delivery-tag"><i class="fa-solid fa-truck-fast"></i> Today</div>
            <img src="assets/images/cakes/<?php echo $cake['image']; ?>">
            
            <div class="cake-details-wrapper">
                <h3><?php echo htmlspecialchars($cake['name']); ?></h3>
                <p class="price">
                    <span class="selling-price">₹ <?php echo $cake['price']; ?></span>
                    <?php if($cake['original_price'] > $cake['price']): ?>
                        <span class="original-price" style="text-decoration: line-through; color: #888; font-size: 0.9em; margin-left: 10px;">₹ <?php echo $cake['original_price']; ?></span>
                    <?php endif; ?>
                </p>
                <a href="cake-details.php?id=<?php echo $cake['id']; ?>" class="btn-outline">View Details</a>
            </div>
        </div>
        <?php } ?>
    </div>
</section>







<!-- TRUST MARKERS -->
<section style="background: #fff; padding: 50px 40px; margin-top: 40px; display: flex; justify-content: space-around; text-align: center; border-top: 1px solid #f0f0f0;">
    <div style="flex: 1;">
        <i class="fa-solid fa-gifts" style="font-size: 42px; color: #749343; margin-bottom: 18px;"></i>
        <h3 style="font-size: 16px; color: #333; font-weight: 500;">Unique Gifts</h3>
    </div>
    <div style="flex: 1;">
        <i class="fa-solid fa-face-smile" style="font-size: 42px; color: #749343; margin-bottom: 18px;"></i>
        <h3 style="font-size: 16px; color: #333; font-weight: 500;">2 Million+ Smiles</h3>
    </div>
    <div style="flex: 1;">
        <i class="fa-solid fa-truck-fast" style="font-size: 42px; color: #749343; margin-bottom: 18px;"></i>
        <h3 style="font-size: 16px; color: #333; font-weight: 500;">Fast & Express Delivery</h3>
    </div>
    <div style="flex: 1;">
        <i class="fa-solid fa-shield-halved" style="font-size: 42px; color: #749343; margin-bottom: 18px;"></i>
        <h3 style="font-size: 16px; color: #333; font-weight: 500;">100% Secure Payments</h3>
    </div>
</section>
<?php include "includes/footer.php"; ?>
</body>
</html>


