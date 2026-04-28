<?php
session_start();
include "includes/db.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$stmt = $conn->prepare("SELECT * FROM candles WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$candle = $stmt->get_result()->fetch_assoc();

if(!$candle){
    header("Location: candles.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($candle['name']); ?> | CakeCraft</title>
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
            <img src="assets/images/candles/<?php echo $candle['image']; ?>" onerror="this.src='https://images.unsplash.com/photo-1602920803507-6f8af12dd90a?w=800';" alt="<?php echo htmlspecialchars($candle['name']); ?>">
        </div>
    </div>

    <!-- RIGHT: Info -->
    <div class="cake-details-info">
        <h2><?php echo htmlspecialchars($candle['name']); ?></h2>
        
        <p class="price">
            <span class="selling-price">₹ <?php echo $candle['price']; ?></span>
            <?php if($candle['original_price'] > $candle['price']): ?>
                <span class="original-price" style="text-decoration: line-through; color: #888; font-size: 0.7em; margin-left: 15px;">₹ <?php echo $candle['original_price']; ?></span>
            <?php endif; ?>
        </p>

        <p style="color:#555; line-height: 1.6;"><?php echo nl2br(htmlspecialchars($candle['description'])); ?></p>
        
        <div style="background: #eef8f3; border-left: 4px solid #008542; padding: 15px; margin: 20px 0; border-radius: 4px;">
            <strong><i class="fa-solid fa-gift"></i> Safe Delivery</strong>
            <p style="margin: 5px 0 0 0; font-size:13px; color:#555;">Carefully packaged for a perfect delivery experience.</p>
        </div>

        <div class="action-buttons">
            <form method="post" action="add-to-cart.php" style="display:flex; flex:1; gap:15px; margin:0;">
                <input type="hidden" name="item_id" value="<?php echo $candle['id']; ?>">
                <input type="hidden" name="item_type" value="candle">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn-add-cart" style="flex:1;">Add to Cart</button>
            </form>
            <a href="candles.php" class="btn-wishlist" style="text-align:center; padding-top:14px; text-decoration:none;"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>
    </div>

</section>
<?php include "includes/footer.php"; ?>
</body>
</html>