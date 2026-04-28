<?php
session_start();
include "includes/db.php";

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$query = "SELECT * FROM decorations WHERE name LIKE '%$search%'";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Balloon Decorations | CakeCraft</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/balloon-decoration.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<div class="cakes-header">
    <h1>Balloon Decorations</h1>
    <p>Surprise your loved ones with elegant room setups</p>
</div>

<div class="search-bar">
    <form method="get">
        <input type="text" name="search" placeholder="Search decorations..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
</div>

<section class="cakes">
    <div class="cake-container">
        <?php if($result && mysqli_num_rows($result) > 0): ?>
            <?php while($decoration = mysqli_fetch_assoc($result)): ?>
                <div class="cake-card">
                    <img src="assets/images/decorations/<?php echo $decoration['image']; ?>" onerror="this.src='https://images.unsplash.com/photo-1530103862676-de8892bc952f?w=400';">
                    
                    <div class="cake-details-wrapper">
                        <h3><?php echo htmlspecialchars($decoration['name']); ?></h3>
                        <p class="price">
                            <span class="selling-price">₹ <?php echo $decoration['price']; ?></span>
                            <?php if($decoration['original_price'] > $decoration['price']): ?>
                                <span class="original-price" style="text-decoration: line-through; color: #888; font-size: 0.9em; margin-left: 10px;">₹ <?php echo $decoration['original_price']; ?></span>
                            <?php endif; ?>
                        </p>
                        <a href="decoration-details.php?id=<?php echo $decoration['id']; ?>" class="btn-outline" style="border-color:#1976d2; color:#1976d2;">View Details</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style='text-align:center; width: 100%; font-size: 18px;'>No decorations found.</p>
        <?php endif; ?>
    </div>
</section>
<?php include "includes/footer.php"; ?>
</body>
</html>