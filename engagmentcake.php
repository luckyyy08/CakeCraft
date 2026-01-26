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

      <!-- LEFT FILTER -->
      <div class="col-lg-3">
        <div class="filter-box sticky-filter">

          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0 text-uppercase">Filter</h5>
            <span class="clear-filter" onclick="clearFilters()">Clear</span>
          </div>

          <!-- PRICE -->
          <div class="filter-section">
            <h6>Price</h6>
            <input type="range" min="300" max="2000" value="2000"
                   id="priceRange" oninput="filterCakes()">
            <p class="price-text">Up to ₹<span id="priceValue">2000</span></p>
          </div>

          <!-- CAKE TYPE -->
          <div class="filter-section">
            <h6>Type</h6>
            <label class="filter-check">
              <input type="checkbox" value="eggless" class="filter-type"> Eggless
            </label>
            <label class="filter-check">
              <input type="checkbox" value="egg" class="filter-type"> With Egg
            </label>
          </div>

          <!-- FLAVOR -->
          <div class="filter-section">
            <h6>Flavor</h6>
            <label class="filter-check">
              <input type="checkbox" value="chocolate" class="filter-flavor"> Chocolate
            </label>
            <label class="filter-check">
              <input type="checkbox" value="vanilla" class="filter-flavor"> Vanilla
            </label>
            <label class="filter-check">
              <input type="checkbox" value="butterscotch" class="filter-flavor"> Butterscotch
            </label>
          </div>

        </div>
      </div>

      <!-- CAKES -->
     <div class="col-lg-9">
  <div class="row g-4" id="cakeList">

<div class="col-md-4 cake-item" data-price="1899" data-type="eggless" data-flavor="vanilla">
  <div class="cake-card">
    <img src="img/rose-gold-yes.png" class="img-fluid" alt='The "Yes" Rose Gold Cake'>
    <div class="p-3 text-center">
      <h6 class="cake-name">The "Yes" Rose Gold Cake</h6>
      <p class="price">₹1,899</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="2100" data-type="eggless" data-flavor="chocolate">
  <div class="cake-card">
    <img src="img/marbled-romance.png" class="img-fluid" alt="Marbled Romance">
    <div class="p-3 text-center">
      <h6 class="cake-name">Marbled Romance</h6>
      <p class="price">₹2,100</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="2499" data-type="egg" data-flavor="fruit">
  <div class="cake-card">
    <img src="img/floral-blush.png" class="img-fluid" alt="Hand-Painted Floral Blush">
    <div class="p-3 text-center">
      <h6 class="cake-name">Hand-Painted Floral Blush</h6>
      <p class="price">₹2,499</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1999" data-type="eggless" data-flavor="strawberry">
  <div class="cake-card">
    <img src="img/champagne-strawberry.png" class="img-fluid" alt="Champagne & Strawberries">
    <div class="p-3 text-center">
      <h6 class="cake-name">Champagne & Strawberries</h6>
      <p class="price">₹1,999</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="2800" data-type="eggless" data-flavor="red-velvet">
  <div class="cake-card">
    <img src="img/gilded-heart.png" class="img-fluid" alt="Gilded Heart Tier">
    <div class="p-3 text-center">
      <h6 class="cake-name">Gilded Heart Tier</h6>
      <p class="price">₹2,800</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="2250" data-type="egg" data-flavor="chocolate">
  <div class="cake-card">
    <img src="img/geometric-love.png" class="img-fluid" alt="Modern Geometric Love">
    <div class="p-3 text-center">
      <h6 class="cake-name">Modern Geometric Love</h6>
      <p class="price">₹2,250</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="2600" data-type="eggless" data-flavor="vanilla">
  <div class="cake-card">
    <img src="img/pearl-lace.png" class="img-fluid" alt="Pearl & Lace Delicacy">
    <div class="p-3 text-center">
      <h6 class="cake-name">Pearl & Lace Delicacy</h6>
      <p class="price">₹2,600</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1750" data-type="eggless" data-flavor="fruit">
  <div class="cake-card">
    <img src="img/rustic-berry.png" class="img-fluid" alt="Rustic Semi-Naked Berry">
    <div class="p-3 text-center">
      <h6 class="cake-name">Rustic Semi-Naked Berry</h6>
      <p class="price">₹1,750</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="2199" data-type="eggless" data-flavor="red-velvet">
  <div class="cake-card">
    <img src="img/forever-velvet.png" class="img-fluid" alt="Forever & Always Velvet">
    <div class="p-3 text-center">
      <h6 class="cake-name">Forever & Always Velvet</h6>
      <p class="price">₹2,199</p>
    </div>
  </div>
</div>

<!-- Repeat same pattern for more cakes -->

  </div>
</div>


    </div>
  </div>
</div>


          <?php include"footer.php";?>
          <script>
function filterCakes() {

  let maxPrice = document.getElementById("priceRange").value;
  document.getElementById("priceValue").innerText = maxPrice;

  let types = Array.from(document.querySelectorAll(".filter-type:checked")).map(cb => cb.value);
  let flavors = Array.from(document.querySelectorAll(".filter-flavor:checked")).map(cb => cb.value);

  let cakes = document.querySelectorAll(".cake-item");

  cakes.forEach(cake => {

    let price = cake.dataset.price;
    let type = cake.dataset.type;
    let flavor = cake.dataset.flavor;

    let priceMatch = price <= maxPrice;
    let typeMatch = types.length === 0 || types.includes(type);
    let flavorMatch = flavors.length === 0 || flavors.includes(flavor);

    cake.style.display = (priceMatch && typeMatch && flavorMatch) ? "block" : "none";
  });
}

document.querySelectorAll("input").forEach(input => {
  input.addEventListener("change", filterCakes);
});

function clearFilters() {
  document.querySelectorAll("input[type=checkbox]").forEach(cb => cb.checked = false);
  document.getElementById("priceRange").value = 2000;
  filterCakes();
}
</script>

</body>
</html>