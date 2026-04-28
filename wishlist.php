<?php
session_start();
include "includes/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle remove item
if(isset($_POST['remove_item'])){
    $wish_id = (int)$_POST['wish_id'];
    $delete = $conn->prepare("DELETE FROM wishlist WHERE id=? AND user_id=?");
    $delete->bind_param("ii", $wish_id, $user_id);
    $delete->execute();
}

// Fetch wishlist items
$query = "SELECT 
            w.id AS wish_id,
            w.item_id,
            w.item_type,
            CASE
                WHEN w.item_type = 'cake' THEN c.name
                WHEN w.item_type = 'candle' THEN ca.name
                WHEN w.item_type = 'hamper' THEN h.name
                WHEN w.item_type = 'decoration' THEN d.name
                ELSE 'Unknown Item'
            END AS item_name,
            CASE
                WHEN w.item_type = 'cake' THEN c.price
                WHEN w.item_type = 'candle' THEN ca.price
                WHEN w.item_type = 'hamper' THEN h.price
                WHEN w.item_type = 'decoration' THEN d.price
                ELSE 0
            END AS item_price,
            CASE
                WHEN w.item_type = 'cake' THEN c.image
                WHEN w.item_type = 'candle' THEN ca.image
                WHEN w.item_type = 'hamper' THEN h.image
                WHEN w.item_type = 'decoration' THEN d.image
                ELSE 'no-image.png'
            END AS item_image,
            CASE
                WHEN w.item_type = 'cake' THEN 'cakes'
                WHEN w.item_type = 'candle' THEN 'candles'
                WHEN w.item_type = 'hamper' THEN 'hampers'
                WHEN w.item_type = 'decoration' THEN 'decorations'
                ELSE 'default'
            END AS item_folder
          FROM wishlist w
          LEFT JOIN cakes c ON w.item_id = c.id AND w.item_type = 'cake'
          LEFT JOIN candles ca ON w.item_id = ca.id AND w.item_type = 'candle'
          LEFT JOIN hampers h ON w.item_id = h.id AND w.item_type = 'hamper'
          LEFT JOIN decorations d ON w.item_id = d.id AND w.item_type = 'decoration'
          WHERE w.user_id=?
          ORDER BY w.id DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Wishlist | CakeCraft</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/wishlist.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<div class="wishlist-container">
    <h2 style="margin-top:0; color:#333;">My Wishlist <i class="fa-solid fa-heart" style="color: #e74c3c;"></i></h2>

    <?php if($result->num_rows > 0): ?>
        <div class="wishlist-grid">
            <?php while($row = $result->fetch_assoc()){ ?>
                <?php
                    $item_name   = !empty($row['item_name']) ? $row['item_name'] : 'Unknown Item';
                    $item_price  = isset($row['item_price']) ? $row['item_price'] : 0;
                    $item_image  = !empty($row['item_image']) ? $row['item_image'] : 'no-image.png';
                    $item_folder = !empty($row['item_folder']) ? $row['item_folder'] : 'default';
                    $item_type   = !empty($row['item_type']) ? $row['item_type'] : 'item';
                    $item_id     = (int)$row['item_id'];

                    $image_path = "assets/images/" . $item_folder . "/" . $item_image;

                    if($item_type == 'cake'){
                        $details_link = "cake-details.php?id=" . $item_id;
                    } elseif($item_type == 'candle'){
                        $details_link = "candle-details.php?id=" . $item_id;
                    } elseif($item_type == 'hamper'){
                        $details_link = "hamper-details.php?id=" . $item_id;
                    } elseif($item_type == 'decoration'){
                        $details_link = "decoration-details.php?id=" . $item_id;
                    } else {
                        $details_link = "#";
                    }
                ?>

                <div class="wishlist-card">
                    <form method="post" style="margin: 0;">
                        <input type="hidden" name="wish_id" value="<?php echo $row['wish_id']; ?>">
                        <button type="submit" name="remove_item" class="btn-remove" title="Remove">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </form>
                    
                    <a href="<?php echo $details_link; ?>" style="text-decoration:none;">
                        <img src="<?php echo $image_path; ?>"
                             alt="<?php echo htmlspecialchars($item_name); ?>"
                             onerror="this.src='assets/images/default/no-image.png'">
                        <h3><?php echo htmlspecialchars($item_name); ?></h3>
                        <p class="price">₹ <?php echo number_format((float)$item_price, 2); ?></p>
                        <p class="item-type"><?php echo htmlspecialchars($item_type); ?></p>
                    </a>
                    
                    <form method="post" action="add-to-cart.php" style="margin: 0;">
                        <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
                        <input type="hidden" name="item_type" value="<?php echo htmlspecialchars($item_type); ?>">
                        <button type="submit" class="btn-outline" style="width: 100%;">Add to Cart</button>
                    </form>
                </div>
            <?php } ?>
        </div>
    <?php else: ?>
        <div style="text-align:center; padding: 40px;">
            <i class="fa-regular fa-heart" style="font-size:50px; color:#ccc; margin-bottom:20px;"></i>
            <h3>Your wishlist is empty!</h3>
            <p style="color:#777;">Save items you like in your wishlist.</p>
            <a href="cakes.php" style="background:#008542; color:#fff; padding:10px 25px; border-radius:4px; text-decoration:none; display:inline-block; margin-top:15px;">Explore Items</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>