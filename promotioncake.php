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
<div class="col-md-4 cake-item" data-price="1499" data-type="eggless" data-flavor="chocolate">
  <div class="cake-card">
    <img src="img/corner-office.png" class="img-fluid" alt="The Corner Office Cake">
    <div class="p-3 text-center">
      <h6 class="cake-name">The Corner Office Cake</h6>
      <p class="price">₹1,499</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1850" data-type="eggless" data-flavor="vanilla">
  <div class="cake-card">
    <img src="img/ladder-success.png" class="img-fluid" alt="Ladder to Success">
    <div class="p-3 text-center">
      <h6 class="cake-name">Ladder to Success</h6>
      <p class="price">₹1,850</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="999" data-type="egg" data-flavor="chocolate">
  <div class="cake-card">
    <img src="img/corporate-boss.png" class="img-fluid" alt="Corporate Boss Black Forest">
    <div class="p-3 text-center">
      <h6 class="cake-name">Corporate Boss Black Forest</h6>
      <p class="price">₹999</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="850" data-type="eggless" data-flavor="fruit">
  <div class="cake-card">
    <img src="img/next-level-lemon.png" class="img-fluid" alt="Next Level Lemon Tart">
    <div class="p-3 text-center">
      <h6 class="cake-name">Next Level Lemon Tart</h6>
      <p class="price">₹850</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1200" data-type="eggless" data-flavor="butterscotch">
  <div class="cake-card">
    <img src="img/hard-work.png" class="img-fluid" alt="Hard Work Pays Off">
    <div class="p-3 text-center">
      <h6 class="cake-name">Hard Work Pays Off</h6>
      <p class="price">₹1,200</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="2200" data-type="eggless" data-flavor="chocolate">
  <div class="cake-card">
    <img src="img/office-pinata.png" class="img-fluid" alt="Office Party Piñata">
    <div class="p-3 text-center">
      <h6 class="cake-name">Office Party Piñata</h6>
      <p class="price">₹2,200</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1100" data-type="egg" data-flavor="vanilla">
  <div class="cake-card">
    <img src="img/strategic-success.png" class="img-fluid" alt="Strategic Success Sponge">
    <div class="p-3 text-center">
      <h6 class="cake-name">Strategic Success Sponge</h6>
      <p class="price">₹1,100</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="2500" data-type="eggless" data-flavor="red-velvet">
  <div class="cake-card">
    <img src="img/executive-suite.png" class="img-fluid" alt="The Executive Suite">
    <div class="p-3 text-center">
      <h6 class="cake-name">The Executive Suite</h6>
      <p class="price">₹2,500</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1350" data-type="eggless" data-flavor="coffee">
  <div class="cake-card">
    <img src="img/moving-up-mocha.png" class="img-fluid" alt="Moving On Up Mocha">
    <div class="p-3 text-center">
      <h6 class="cake-name">Moving On Up Mocha</h6>
      <p class="price">₹1,350</p>
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