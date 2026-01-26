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
<div class="col-md-4 cake-item" data-price="2499" data-type="eggless" data-flavor="chocolate">
  <div class="cake-card">
    <img src="img/gamer-controller.png" class="img-fluid" alt="The Gamer’s Controller">
    <div class="p-3 text-center">
      <h6 class="cake-name">The Gamer’s Controller</h6>
      <p class="price">₹2,499</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="3200" data-type="egg" data-flavor="vanilla">
  <div class="cake-card">
    <img src="img/sports-arena.png" class="img-fluid" alt="Sports Fanatic Arena">
    <div class="p-3 text-center">
      <h6 class="cake-name">Sports Fanatic Arena</h6>
      <p class="price">₹3,200</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="2800" data-type="eggless" data-flavor="butterscotch">
  <div class="cake-card">
    <img src="img/traveler-suitcase.png" class="img-fluid" alt="Traveler’s Suitcase">
    <div class="p-3 text-center">
      <h6 class="cake-name">Traveler’s Suitcase</h6>
      <p class="price">₹2,800</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="2100" data-type="eggless" data-flavor="strawberry">
  <div class="cake-card">
    <img src="img/retro-disco.png" class="img-fluid" alt="Retro Disco Fever">
    <div class="p-3 text-center">
      <h6 class="cake-name">Retro Disco Fever</h6>
      <p class="price">₹2,100</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1950" data-type="eggless" data-flavor="caramel">
  <div class="cake-card">
    <img src="img/movie-popcorn.png" class="img-fluid" alt="Movie Night Popcorn">
    <div class="p-3 text-center">
      <h6 class="cake-name">Movie Night Popcorn</h6>
      <p class="price">₹1,950</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="2600" data-type="egg" data-flavor="chocolate">
  <div class="cake-card">
    <img src="img/space-explorer.png" class="img-fluid" alt="Space Explorer Mars">
    <div class="p-3 text-center">
      <h6 class="cake-name">Space Explorer Mars</h6>
      <p class="price">₹2,600</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="3500" data-type="eggless" data-flavor="fruit">
  <div class="cake-card">
    <img src="img/enchanted-forest.png" class="img-fluid" alt="Enchanted Forest Theme">
    <div class="p-3 text-center">
      <h6 class="cake-name">Enchanted Forest Theme</h6>
      <p class="price">₹3,500</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1800" data-type="eggless" data-flavor="vanilla">
  <div class="cake-card">
    <img src="img/music-symphony.png" class="img-fluid" alt="Music Note Symphony">
    <div class="p-3 text-center">
      <h6 class="cake-name">Music Note Symphony</h6>
      <p class="price">₹1,800</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="4500" data-type="eggless" data-flavor="custom">
  <div class="cake-card">
    <img src="img/sculpted-portrait.png" class="img-fluid" alt="Artisan Sculpted Portrait">
    <div class="p-3 text-center">
      <h6 class="cake-name">Artisan Sculpted Portrait</h6>
      <p class="price">₹4,500</p>
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