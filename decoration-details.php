<?php
session_start();
include "includes/db.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$stmt = $conn->prepare("SELECT * FROM decorations WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$decoration = $stmt->get_result()->fetch_assoc();

if(!$decoration){
    header("Location: balloon-decoration.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($decoration['name']); ?> | CakeCraft</title>
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
            <img src="assets/images/decorations/<?php echo $decoration['image']; ?>" onerror="this.src='https://images.unsplash.com/photo-1530103862676-de8892bc952f?w=800';" alt="<?php echo htmlspecialchars($decoration['name']); ?>">
        </div>
    </div>

    <!-- RIGHT: Info -->
    <div class="cake-details-info">
        <h2><?php echo htmlspecialchars($decoration['name']); ?></h2>
        
        <p class="price">
            <span class="selling-price">₹ <?php echo $decoration['price']; ?></span>
            <?php if($decoration['original_price'] > $decoration['price']): ?>
                <span class="original-price" style="text-decoration: line-through; color: #888; font-size: 0.7em; margin-left: 15px;">₹ <?php echo $decoration['original_price']; ?></span>
            <?php endif; ?>
        </p>

        <p style="color:#555; line-height: 1.6;"><?php echo nl2br(htmlspecialchars($decoration['description'])); ?></p>
        
        <div style="background: #e3f2fd; border-left: 4px solid #1976d2; padding: 15px; margin: 20px 0; border-radius: 4px;">
            <strong style="color: #1565c0;"><i class="fa-solid fa-wand-magic-sparkles"></i> Magic Setup</strong>
            <p style="margin: 5px 0 0 0; font-size:13px; color:#555;">Our decorators will arrive at your venue and set it up seamlessly.</p>
        </div>

        <div class="action-buttons">
            <form method="post" action="add-to-cart.php" style="display:flex; flex:1; gap:15px; margin:0;">
                <input type="hidden" name="item_id" value="<?php echo $decoration['id']; ?>">
                <input type="hidden" name="item_type" value="decoration">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn-add-cart" style="flex:1;">Add to Cart</button>
            </form>
            <a href="balloon-decoration.php" class="btn-wishlist" style="text-align:center; padding-top:14px; text-decoration:none; border-color:#1976d2; color:#1976d2;"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>
    </div>

</section>
<?php include "includes/footer.php"; ?>
</body>
</html>