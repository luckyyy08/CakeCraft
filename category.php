<?php
session_start();
include "db.php";
include "header.php";

if (!isset($_GET['cat'])) {
    echo "<h3 class='text-center mt-5'>Category not found</h3>";
    exit;
}

$cat = $_GET['cat'];

$catQuery = mysqli_query($conn, "SELECT * FROM categories WHERE name='$cat'");
if (mysqli_num_rows($catQuery) == 0) {
    echo "<h3 class='text-center mt-5'>Invalid Category</h3>";
    exit;
}

$catData = mysqli_fetch_assoc($catQuery);
$catId = $catData['id'];

$cakes = mysqli_query($conn, "SELECT * FROM cakes WHERE category_id = $catId");
?>

<div class="container-fluid py-5 cakes-section">
    <div class="container">

        <!-- TITLE -->
        <div class="section-title text-center mb-5">
            <h1 class="display-4 text-uppercase">
                <?= ucfirst($catData['name']); ?> Cake's
            </h1>
        </div>

        <div class="row">

            <!-- FILTER -->
            <div class="col-lg-3">
                <div class="filter-box sticky-filter">
                    <h5 class="mb-3">Filter</h5>

                    <h6>Price</h6>
                    <input type="range" min="300" max="2000" value="2000"
                           id="priceRange" oninput="filterCakes()">
                    <p>Up to ₹<span id="priceValue">2000</span></p>

                    <h6>Type</h6>
                    <label><input type="checkbox" value="eggless" class="filter-type"> Eggless</label><br>
                    <label><input type="checkbox" value="egg" class="filter-type"> With Egg</label>

                    <h6 class="mt-3">Flavor</h6>
                    <label><input type="checkbox" value="chocolate" class="filter-flavor"> Chocolate</label><br>
                    <label><input type="checkbox" value="vanilla" class="filter-flavor"> Vanilla</label><br>
                    <label><input type="checkbox" value="butterscotch" class="filter-flavor"> Butterscotch</label>
                </div>
            </div>

            <!-- CAKES -->
            <div class="col-lg-9">
                <div class="row g-4" id="cakeList">

                    <?php while ($cake = mysqli_fetch_assoc($cakes)) { ?>
                        <div class="col-md-4 cake-item"
                             data-price="<?= $cake['price'] ?>"
                             data-type="<?= $cake['type'] ?>"
                             data-flavor="<?= $cake['flavor'] ?>">

                            <div class="cake-card">
                                <img src="img/<?= $cake['image'] ?>" class="img-fluid">
                                <div class="p-3 text-center">
                                    <h6 class="cake-name"><?= $cake['name'] ?></h6>
                                    <p class="price">₹<?= $cake['price'] ?></p>
                                </div>
                            </div>

                        </div>
                    <?php } ?>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include "footer.php"; ?>
