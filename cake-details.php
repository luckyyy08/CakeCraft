<?php
session_start();
include "includes/db.php";


// Check if cake ID is passed
if(!isset($_GET['id'])){
    header("Location: cakes.php");
    exit();
}

$cake_id = $_GET['id'];

// Fetch cake details
$query = "SELECT cakes.*, categories.name AS category_name 
          FROM cakes 
          JOIN categories ON cakes.category_id = categories.id 
          WHERE cakes.id='$cake_id' LIMIT 1";
$result = mysqli_query($conn, $query);

if(!$cake = mysqli_fetch_assoc($result)){
    echo "Cake not found!";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $cake['name']; ?> | CakeCraft</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<section class="cake-details-container">

    <!-- LEFT: Cake Image -->
    <div class="cake-details-image">
        <div style="position: relative;">
            <div class="delivery-tag" style="top:20px; left:20px; font-size:14px; padding:6px 12px;"><i class="fa-solid fa-truck-fast"></i> Today</div>
            <img src="assets/images/cakes/<?php echo $cake['image']; ?>" alt="<?php echo $cake['name']; ?>">
        </div>
    </div>

    <!-- RIGHT: Cake Info -->
    <div class="cake-details-info">
        <h2><?php echo $cake['name']; ?></h2>
        
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
            <span style="background:#008542; color:#fff; padding:2px 8px; border-radius:4px; font-weight:700; font-size:14px;"><i class="fa-solid fa-star"></i> 4.8</span>
            <span style="color:#777; font-size:14px;">(245 Reviews)</span>
        </div>

        <p class="price">
            <span class="selling-price">₹ <?php echo $cake['price']; ?></span>
            <?php if($cake['original_price'] > $cake['price']): ?>
                <span class="original-price" style="text-decoration: line-through; color: #888; font-size: 0.7em; margin-left: 15px;">₹ <?php echo $cake['original_price']; ?></span>
            <?php endif; ?>
        </p>

        <div class="details-meta">
            <p><span>Category:</span> <strong><?php echo $cake['category_name']; ?></strong></p>
            <p><span>Type:</span> <strong><?php echo ucfirst($cake['type']); ?></strong></p>
            <p><span>Flavor:</span> <strong><?php echo $cake['flavor']; ?></strong></p>
        </div>

        <p style="color:#555; line-height: 1.6;"><?php echo $cake['description']; ?></p>

        <div style="background: #eef8f3; border-left: 4px solid #008542; padding: 15px; margin: 20px 0; border-radius: 4px;">
            <strong><i class="fa-solid fa-gift"></i> CakeCraft Promise</strong>
            <p style="margin: 5px 0 0 0; font-size:13px; color:#555;">Freshly baked and delivered safely by our own agents.</p>
        </div>

        <div class="action-buttons">
            <form method="post" action="add-to-cart.php" style="flex: 1; display:flex;">
                <input type="hidden" name="cake_id" value="<?php echo $cake['id']; ?>">
                <button type="submit" class="btn-add-cart">ADD TO CART</button>
            </form>
            
            <form method="post" action="add-to-wishlist.php">
                <input type="hidden" name="cake_id" value="<?php echo $cake['id']; ?>">
                <button type="submit" class="btn-wishlist" title="Add to Wishlist"><i class="fa-regular fa-heart"></i></button>
            </form>
        </div>

        <!-- BACK TO CATEGORY BUTTON -->
        <a href="cakes.php?category_id=<?php echo $cake['category_id']; ?>" style="display:inline-block; margin-top:25px; color:#008542; text-decoration:none; font-weight:500;">← Shop more <?php echo $cake['category_name']; ?></a>
    </div>

</section>

<!-- TRUST SECTION -->
<section style="background: #fff; padding: 30px; margin-top: 20px; border-top: 1px solid #eee; border-bottom: 1px solid #eee; text-align:center;">
    <h3 style="margin-bottom: 20px; font-size:20px; color:#333;">Why order from CakeCraft?</h3>
    <div style="display:flex; justify-content:center; gap: 50px;">
         <div><i class="fa-solid fa-seedling" style="color:#008542; font-size:30px; margin-bottom:10px;"></i><p>100% Fresh Ingredients</p></div>
         <div><i class="fa-solid fa-medal" style="color:#008542; font-size:30px; margin-bottom:10px;"></i><p>Premium Quality</p></div>
         <div><i class="fa-solid fa-truck" style="color:#008542; font-size:30px; margin-bottom:10px;"></i><p>Safe Delivery</p></div>
    </div>
</section>

<!-- RELATED PRODUCTS SECTION -->
<?php
$cat_id = $cake['category_id'];
$curr_id = $cake['id'];
$rel_query = "SELECT * FROM cakes WHERE category_id='$cat_id' AND id != '$curr_id' ORDER BY RAND() LIMIT 4";
$rel_res = mysqli_query($conn, $rel_query);

if(mysqli_num_rows($rel_res) > 0):
?>
<section style="padding: 40px 5%; background: #fdfbf7;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px;">
        <h3 style="font-size:24px; color:#333; margin:0;">Similar Cakes You Might Like</h3>
        <a href="cakes.php?category_id=<?php echo $cat_id; ?>" style="color:#008542; font-weight:600; text-decoration:none;">View All</a>
    </div>
    <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
        <?php while($rel = mysqli_fetch_assoc($rel_res)): ?>
            <div style="background:#fff; border-radius:8px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,0.05); transition:transform 0.3s; position:relative;">
                <a href="cake-details.php?id=<?php echo $rel['id']; ?>">
                    <img src="assets/images/cakes/<?php echo $rel['image']; ?>" style="width:100%; height:200px; object-fit:cover;">
                </a>
                <div style="padding:15px;">
                    <h4 style="margin:0 0 10px 0; font-size:16px; color:#333; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                        <a href="cake-details.php?id=<?php echo $rel['id']; ?>" style="text-decoration:none; color:inherit;"><?php echo htmlspecialchars($rel['name']); ?></a>
                    </h4>
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <span style="font-weight:700; color:#e67e22;">₹ <?php echo $rel['price']; ?></span>
                        <a href="cake-details.php?id=<?php echo $rel['id']; ?>" style="background:#f1f8f4; color:#008542; padding:5px 10px; border-radius:4px; text-decoration:none; font-size:13px; font-weight:600;">View</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>
<?php endif; ?>

<?php include "includes/footer.php"; ?>
</body>
</html>