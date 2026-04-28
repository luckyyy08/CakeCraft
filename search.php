<?php
session_start();
include "includes/db.php";

$q = isset($_GET['q']) ? mysqli_real_escape_string($conn, trim($_GET['q'])) : '';

$results = [];
if($q != '') {
    // Search Cakes
    $res = $conn->query("SELECT id, name, price, original_price, image, 'cake' as type FROM cakes WHERE name LIKE '%$q%' OR description LIKE '%$q%'");
    if($res) while($r = $res->fetch_assoc()) $results[] = $r;

    // Search Decorations
    $res = $conn->query("SELECT id, name, price, original_price, image, 'decoration' as type FROM decorations WHERE name LIKE '%$q%'");
    if($res) while($r = $res->fetch_assoc()) $results[] = $r;

    // Search Hampers
    $res = $conn->query("SELECT id, name, price, original_price, image, 'hamper' as type FROM hampers WHERE name LIKE '%$q%'");
    if($res) while($r = $res->fetch_assoc()) $results[] = $r;

    // Search Candles
    $res = $conn->query("SELECT id, name, price, original_price, image, 'candle' as type FROM candles WHERE name LIKE '%$q%'");
    if($res) while($r = $res->fetch_assoc()) $results[] = $r;


}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Results for "<?php echo htmlspecialchars($q); ?>" | CakeCraft</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/search.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<div class="search-header">
    <?php if($q == ''): ?>
        <h1 style="color:#749343;">Search the store</h1>
        <p>Type what you are looking for in the search bar above.</p>
    <?php else: ?>
        <h1 style="color:#749343;">Search Results</h1>
        <p>Found <?php echo count($results); ?> results for "<strong><?php echo htmlspecialchars($q); ?></strong>"</p>
    <?php endif; ?>
</div>

<section class="cakes" style="padding-top: 40px; min-height: 40vh; background:#fdfbf7;">
    <div class="cake-container">
        <?php if(!empty($results)): ?>
            <?php foreach($results as $item): ?>
                <?php 
                    $dir = "cakes";
                    $link = "cake-details.php?id=".$item['id'];
                    $type_label = "Cake";
                    $type_color = "#e67e22";
                    
                    if($item['type'] == 'decoration'){ 
                        $dir = "decorations"; $link = "decoration-details.php?id=".$item['id']; $type_label = "Decorations"; $type_color = "#d81b60"; 
                    }
                    if($item['type'] == 'hamper'){ 
                        $dir = "hampers"; $link = "hamper-details.php?id=".$item['id']; $type_label = "Hampers"; $type_color = "#b7860b"; 
                    }
                    if($item['type'] == 'candle'){ 
                        $dir = "candles"; $link = "candle-details.php?id=".$item['id']; $type_label = "Candles"; $type_color = "#008542"; 
                    }

                ?>
                <div class="cake-card" style="position: relative; overflow:hidden;">
                    <div class="item-type-badge" style="background: <?php echo $type_color; ?>;"><?php echo $type_label; ?></div>
                    <img src="assets/images/<?php echo $dir; ?>/<?php echo $item['image']; ?>" onerror="this.src='https://via.placeholder.com/400x400?text=No+Image';">
                    
                    <div class="cake-details-wrapper">
                        <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                        <p class="price">
                            <span class="selling-price">₹ <?php echo number_format($item['price'], 2); ?></span>
                            <?php if(isset($item['original_price']) && $item['original_price'] > $item['price']): ?>
                                <span class="original-price" style="text-decoration: line-through; color: #888; font-size: 0.8em; margin-left: 10px;">₹ <?php echo number_format($item['original_price'], 2); ?></span>
                            <?php endif; ?>
                        </p>
                        <a href="<?php echo $link; ?>" class="btn-outline" style="border-color: <?php echo $type_color; ?>; color: <?php echo $type_color; ?>;" onmouseover="this.style.background='<?php echo $type_color; ?>'; this.style.color='#fff';" onmouseout="this.style.background='transparent'; this.style.color='<?php echo $type_color; ?>';">View Details</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php elseif($q != ''): ?>
            <div style="text-align: center; width: 100%; padding: 40px 0;">
                <i class="fa-solid fa-face-frown" style="font-size: 50px; color: #ddd; margin-bottom: 20px;"></i>
                <h3 style="color: #666;">We couldn't find any matches for "<?php echo htmlspecialchars($q); ?>"</h3>
                <p style="color: #888; margin-top: 10px;">Try checking your spelling or use more general terms like "Chocolate" or "Birthday".</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include "includes/footer.php"; ?>
</body>
</html>
