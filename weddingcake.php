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

 <div class="col-md-4 cake-item" data-price="8500" data-type="eggless" data-flavor="vanilla">
  <div class="cake-card">
    <img src="img/grand-ivory.png" class="img-fluid" alt="Grand Ivory Cascade">
    <div class="p-3 text-center">
      <h6 class="cake-name">Grand Ivory Cascade</h6>
      <p class="price">₹8,500</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="9200" data-type="eggless" data-flavor="butterscotch">
  <div class="cake-card">
    <img src="img/victorian-lace.png" class="img-fluid" alt="Vintage Victorian Lace">
    <div class="p-3 text-center">
      <h6 class="cake-name">Vintage Victorian Lace</h6>
      <p class="price">₹9,200</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="7800" data-type="egg" data-flavor="chocolate">
  <div class="cake-card">
    <img src="img/white-truffle.png" class="img-fluid" alt="White Truffle Elegance">
    <div class="p-3 text-center">
      <h6 class="cake-name">White Truffle Elegance</h6>
      <p class="price">₹7,800</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="12500" data-type="eggless" data-flavor="fruit">
  <div class="cake-card">
    <img src="img/orchid-tower.png" class="img-fluid" alt="Sugar Orchid Tower">
    <div class="p-3 text-center">
      <h6 class="cake-name">Sugar Orchid Tower</h6>
      <p class="price">₹12,500</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="10500" data-type="eggless" data-flavor="vanilla">
  <div class="cake-card">
    <img src="img/silver-leaf.png" class="img-fluid" alt="Silver Leaf Majesty">
    <div class="p-3 text-center">
      <h6 class="cake-name">Silver Leaf Majesty</h6>
      <p class="price">₹10,500</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="8900" data-type="egg" data-flavor="strawberry">
  <div class="cake-card">
    <img src="img/wildflower-tier.png" class="img-fluid" alt="Pressed Wildflower Tier">
    <div class="p-3 text-center">
      <h6 class="cake-name">Pressed Wildflower Tier</h6>
      <p class="price">₹8,900</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="9800" data-type="eggless" data-flavor="chocolate">
  <div class="cake-card">
    <img src="img/gold-foil.png" class="img-fluid" alt="Classic Gold Foil Ribbon">
    <div class="p-3 text-center">
      <h6 class="cake-name">Classic Gold Foil Ribbon</h6>
      <p class="price">₹9,800</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="6500" data-type="eggless" data-flavor="vanilla">
  <div class="cake-card">
    <img src="img/satin-smooth.png" class="img-fluid" alt="Minimalist Satin Smooth">
    <div class="p-3 text-center">
      <h6 class="cake-name">Minimalist Satin Smooth</h6>
      <p class="price">₹6,500</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="15000" data-type="eggless" data-flavor="red-velvet">
  <div class="cake-card">
    <img src="img/royal-grandeur.png" class="img-fluid" alt="Royal Grandeur Multi-Tier">
    <div class="p-3 text-center">
      <h6 class="cake-name">Royal Grandeur Multi-Tier</h6>
      <p class="price">₹15,000</p>
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