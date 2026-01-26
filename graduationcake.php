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

<div class="col-md-4 cake-item" data-price="899" data-type="eggless" data-flavor="chocolate">
  <div class="cake-card">
    <img src="img/gcake1.jpeg" class="img-fluid" alt="Smarty Pants Chocolate">
    <div class="p-3 text-center">
      <h6 class="cake-name">Smarty Pants Chocolate</h6>
      <p class="price">₹899</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1250" data-type="egg" data-flavor="vanilla">
  <div class="cake-card">
    <img src="img/gcake2.jpeg" class="img-fluid" alt="Cap & Gown Glory">
    <div class="p-3 text-center">
      <h6 class="cake-name">Cap & Gown Glory</h6>
      <p class="price">₹1,250</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1100" data-type="eggless" data-flavor="fruit">
  <div class="cake-card">
    <img src="img/gcake3.jpeg" class="img-fluid" alt="Future Leader Fruit Cake">
    <div class="p-3 text-center">
      <h6 class="cake-name">Future Leader Fruit Cake</h6>
      <p class="price">₹1,100</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="950" data-type="eggless" data-flavor="butterscotch">
  <div class="cake-card">
    <img src="img/gcake4.jpeg" class="img-fluid" alt="Diploma Scroll Delight">
    <div class="p-3 text-center">
      <h6 class="cake-name">Diploma Scroll Delight</h6>
      <p class="price">₹950</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1800" data-type="eggless" data-flavor="chocolate">
  <div class="cake-card">
    <img src="img/gcake5.jpeg" class="img-fluid" alt="The World Awaits Map Cake">
    <div class="p-3 text-center">
      <h6 class="cake-name">The World Awaits Map Cake</h6>
      <p class="price">₹1,800</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="850" data-type="eggless" data-flavor="fruit">
  <div class="cake-card">
    <img src="img/gcake7.jpeg" class="img-fluid" alt="Bright Future Lemon">
    <div class="p-3 text-center">
      <h6 class="cake-name">Bright Future Lemon</h6>
      <p class="price">₹850</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="2100" data-type="eggless" data-flavor="red-velvet">
  <div class="cake-card">
    <img src="img/gcake6.jpeg" class="img-fluid" alt="Class of 2026 Masterpiece">
    <div class="p-3 text-center">
      <h6 class="cake-name">Class of 2026 Masterpiece</h6>
      <p class="price">₹2,100</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1050" data-type="egg" data-flavor="fruit">
  <div class="cake-card">
    <img src="img/gcake8.jpeg" class="img-fluid" alt="Dream Big Blueberry">
    <div class="p-3 text-center">
      <h6 class="cake-name">Dream Big Blueberry</h6>
      <p class="price">₹1,050</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1650" data-type="eggless" data-flavor="vanilla">
  <div class="cake-card">
    <img src="img/gcake9.jpeg" class="img-fluid" alt="Achievement Award Gold">
    <div class="p-3 text-center">
      <h6 class="cake-name">Achievement Award Gold</h6>
      <p class="price">₹1,650</p>
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