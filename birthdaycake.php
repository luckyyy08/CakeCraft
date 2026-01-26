<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php include"header.php";?>

<div class="container-fluid py-5">
  <div class="container">
    <div class="row">

      <!-- FILTER SIDEBAR -->
      <div class="col-lg-3 mb-4">
        <div class="filter-box p-4">

          <div class="d-flex justify-content-between mb-3">
            <h5 class="mb-0">Filter</h5>
            <button class="btn btn-sm btn-link" onclick="clearFilters()">Clear All</button>
          </div>

          <!-- PRICE -->
          <div class="filter-section">
            <h6>Price</h6>
            <input type="range" min="300" max="2000" value="2000" id="priceRange" oninput="filterCakes()">
            <p class="mt-2">Up to ₹<span id="priceValue">2000</span></p>
          </div>

          <!-- CAKE TYPE -->
          <div class="filter-section">
            <h6>Cake Type</h6>
            <label><input type="checkbox" value="eggless" class="filter-type"> Eggless</label><br>
            <label><input type="checkbox" value="egg" class="filter-type"> With Egg</label>
          </div>

          <!-- FLAVOR -->
          <div class="filter-section">
            <h6>Flavor</h6>
            <label><input type="checkbox" value="chocolate" class="filter-flavor"> Chocolate</label><br>
            <label><input type="checkbox" value="vanilla" class="filter-flavor"> Vanilla</label><br>
            <label><input type="checkbox" value="butterscotch" class="filter-flavor"> Butterscotch</label>
          </div>

        </div>
      </div>

      <!-- CAKE LIST -->
      <div class="col-lg-9">
        <div class="row g-4" id="cakeList">
        </div>
      </div>
    </div>
</div>
</div>
          <?php include"footer.php";?>
</body>
</html>