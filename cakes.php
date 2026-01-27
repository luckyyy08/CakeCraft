<?php
session_start();
include "db.php";
include "header.php";

if (!isset($_GET['cat'])) {
    echo "<h3 class='text-center mt-5'>Category not found</h3>";
    exit;
}

$catId = (int)$_GET['cat'];

// Category fetch
$catQuery = mysqli_query($conn, "SELECT * FROM categories WHERE id=$catId");

if (mysqli_num_rows($catQuery) == 0) {
    echo "<h3 class='text-center mt-5'>Invalid Category</h3>";
    exit;
}

$catData = mysqli_fetch_assoc($catQuery);

// Cakes fetch
$cakes = mysqli_query(
    $conn,
    "SELECT * FROM cakes WHERE category_id=$catId"
);
?>

<!-- TITLE -->
<div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width:700px;">
    <h1 class="display-4 text-uppercase">
        <?= htmlspecialchars($catData['name']) ?> Cakes
    </h1>
</div>

<div class="container-fluid py-5">
  <div class="container">
    <div class="row">

      <!-- LEFT FILTER -->
      <div class="col-lg-3">
        <!-- filter box same as before -->
      </div>

      <!-- CAKES -->
      <div class="col-lg-9">
        <div class="row g-4" id="cakeList">

<?php if (mysqli_num_rows($cakes) == 0) { ?>
    <p class="text-center">No cakes found.</p>
<?php } ?>

<?php while ($cake = mysqli_fetch_assoc($cakes)) { ?>
  <div class="col-md-4 cake-item"
       data-price="<?= $cake['price'] ?>"
       data-type="<?= $cake['type'] ?>"
       data-flavor="<?= $cake['flavor'] ?>">

    <div class="cake-card">
      <img src="img/<?= $cake['image'] ?>" class="img-fluid">
      <div class="p-3 text-center">
        <h6 class="cake-name"><?= htmlspecialchars($cake['name']) ?></h6>
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
