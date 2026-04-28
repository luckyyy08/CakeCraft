<?php
session_start();
include "includes/db.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$stmt = $conn->prepare("SELECT * FROM hampers WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$hamper = $stmt->get_result()->fetch_assoc();

if(!$hamper){
    header("Location: gift-hamper.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($hamper['name']); ?> | CakeCraft</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<section class="cake-details-container">

    <!-- LEFT: Image -->
    <div class="cake-details-image">
        <div>
            <img src="assets/images/hampers/<?php echo $hamper['image']; ?>" onerror="this.src='https://images.unsplash.com/photo-1549465220-1a8b9238cd48?w=800';" alt="<?php echo htmlspecialchars($hamper['name']); ?>">
        </div>
    </div>

    <!-- RIGHT: Info -->
    <div class="cake-details-info">
        <h2><?php echo htmlspecialchars($hamper['name']); ?></h2>
        
        <p class="price">
            <span class="selling-price">₹ <?php echo $hamper['price']; ?></span>
            <?php if($hamper['original_price'] > $hamper['price']): ?>
                <span class="original-price" style="text-decoration: line-through; color: #888; font-size: 0.7em; margin-left: 15px;">₹ <?php echo $hamper['original_price']; ?></span>
            <?php endif; ?>
        </p>

        <p style="color:#555; line-height: 1.6;"><?php echo nl2br(htmlspecialchars($hamper['description'])); ?></p>
        
        <div style="background: #eef8f3; border-left: 4px solid #008542; padding: 15px; margin: 20px 0; border-radius: 4px;">
            <strong><i class="fa-solid fa-gift"></i> CakeCraft Promise</strong>
            <p style="margin: 5px 0 0 0; font-size:13px; color:#555;">Hand-picked selections carefully wrapped for you.</p>
        </div>

        <div class="action-buttons">
            <form method="post" action="add-to-cart.php" style="display:flex; flex:1; gap:15px; margin:0;">
                <input type="hidden" name="item_id" value="<?php echo $hamper['id']; ?>">
                <input type="hidden" name="item_type" value="hamper">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn-add-cart" style="flex:1;">Add to Cart</button>
            </form>
            <a href="gift-hamper.php" class="btn-wishlist" style="text-align:center; padding-top:14px; text-decoration:none;"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>
    </div>

</section>
<?php include "includes/footer.php"; ?>
</body>
</html>