<?php
session_start();
include "includes/db.php";

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$query = "SELECT * FROM hampers WHERE name LIKE '%$search%'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gift Hampers | CakeCraft</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/gift-hamper.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<div class="cakes-header">
    <h1>Luxury Gift Hampers</h1>
    <p>Handcrafted assortments for your special ones</p>
</div>

<div class="search-bar">
    <form method="get">
        <input type="text" name="search" placeholder="Search hampers..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
</div>

<section class="cakes">
    <div class="cake-container">
        <?php if($result && mysqli_num_rows($result) > 0): ?>
            <?php while($hamper = mysqli_fetch_assoc($result)): ?>
                <div class="cake-card">
                    <img src="assets/images/hampers/<?php echo $hamper['image']; ?>" onerror="this.src='https://images.unsplash.com/photo-1549465220-1a8b9238cd48?w=400';">
                    
                    <div class="cake-details-wrapper">
                        <h3><?php echo htmlspecialchars($hamper['name']); ?></h3>
                        <p class="price">
                            <span class="selling-price">₹ <?php echo $hamper['price']; ?></span>
                            <?php if($hamper['original_price'] > $hamper['price']): ?>
                                <span class="original-price" style="text-decoration: line-through; color: #888; font-size: 0.9em; margin-left: 10px;">₹ <?php echo $hamper['original_price']; ?></span>
                            <?php endif; ?>
                        </p>
                        <a href="hamper-details.php?id=<?php echo $hamper['id']; ?>" class="btn-outline">View Details</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style='text-align:center; width: 100%; font-size: 18px;'>No hampers found.</p>
        <?php endif; ?>
    </div>
</section>
<?php include "includes/footer.php"; ?>
</body>
</html>