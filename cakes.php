<?php
session_start();
include "includes/db.php";

$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;
// Note: cake-details might use ?category= instead of ?category_id= from the back button
if (isset($_GET['category'])) {
    $category_id = intval($_GET['category']);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Our Cakes | CakeCraft</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/cakes.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<div class="cakes-header">
    <h1>Explore Our Delicious Cakes</h1>
    <p>Find the perfect cake for every occasion</p>
</div>
<!-- CATEGORIES -->
<section class="categories">
    
    
    <div class="category-container">
        
        <?php
        $query="SELECT * FROM categories";
        $result=mysqli_query($conn,$query);
        
        while($row=mysqli_fetch_assoc($result)) {
        ?>
        <a href="cakes.php?category_id=<?php echo $row['id']; ?>" class="category-card">
            <div class="category-image-wrap">
                <img src="assets/images/cakes/<?php echo $row['image']; ?>">
            </div>
            <h3><?php echo $row['name']; ?></h3>
        </a>
        <?php } ?>
    </div>
</section>
<!-- /*he check karat  -->
 <h2 class="section-title"><?php 
            if($category_id > 0) {
                $name_q = mysqli_query($conn, "SELECT name FROM categories WHERE id = $category_id");
                $name_data = mysqli_fetch_assoc($name_q);
                echo $name_data['name'];
            } else {
                echo "All Delicious Cakes";
            }
            ?></h2>




<section class="cakes">
    <div class="cake-container">
        <?php
        $query = "SELECT * FROM cakes";
        if ($category_id > 0) {
            $query .= " WHERE category_id = " . intval($category_id);
        }
        $query .= " ORDER BY created_at DESC";
        
        $result = mysqli_query($conn, $query);

        if($result && mysqli_num_rows($result) > 0) {
            while($cake = mysqli_fetch_assoc($result)) {
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
            <?php 
            }
        } else {
            echo "<p style='text-align:center; width: 100%; font-size: 18px;'>No cakes found in this category.</p>";
        }
        ?>
    </div>
</section>
<?php include "includes/footer.php"; ?>
</body>
</html>