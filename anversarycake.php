<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php include"header.php";?>
  <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 700px;">
        
        <h1 class="display-4 text-uppercase">Anniversary Cake's</h1>
    </div>

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

 <div class="col-md-4 cake-item" data-price="1249" data-type="eggless" data-flavor="red-velvet">
  <div class="cake-card">
    <img src="img/acake1.jpeg" class="img-fluid" alt="Ruby Red Anniversary">
    <div class="p-3 text-center">
      <h6 class="cake-name">Ruby Red Anniversary</h6>
      <p class="price">₹1,249</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="2499" data-type="eggless" data-flavor="vanilla">
  <div class="cake-card">
    <img src="img/acake2.jpeg" class="img-fluid" alt="Silver Jubilee Sparkle">
    <div class="p-3 text-center">
      <h6 class="cake-name">Silver Jubilee Sparkle</h6>
      <p class="price">₹2,499</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="2999" data-type="eggless" data-flavor="vanilla">
  <div class="cake-card">
    <img src="img/acake3.jpeg" class="img-fluid" alt="Golden Years Vanilla">
    <div class="p-3 text-center">
      <h6 class="cake-name">Golden Years Vanilla</h6>
      <p class="price">₹2,999</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1100" data-type="egg" data-flavor="chocolate">
  <div class="cake-card">
    <img src="img/acake4.jpeg" class="img-fluid" alt="Eternal Love Chocolate">
    <div class="p-3 text-center">
      <h6 class="cake-name">Eternal Love Chocolate</h6>
      <p class="price">₹1,100</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1599" data-type="eggless" data-flavor="custom">
  <div class="cake-card">
    <img src="img/acake5.jpeg" class="img-fluid" alt="Sweet Memories Photo Cake">
    <div class="p-3 text-center">
      <h6 class="cake-name">Sweet Memories Photo Cake</h6>
      <p class="price">₹1,599</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="999" data-type="eggless" data-flavor="strawberry">
  <div class="cake-card">
    <img src="img/acake6.jpeg" class="img-fluid" alt="First Year Bloom">
    <div class="p-3 text-center">
      <h6 class="cake-name">First Year Bloom</h6>
      <p class="price">₹999</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="3500" data-type="eggless" data-flavor="vanilla">
  <div class="cake-card">
    <img src="img/acake7.jpeg" class="img-fluid" alt="Diamond Jubilee White">
    <div class="p-3 text-center">
      <h6 class="cake-name">Diamond Jubilee White</h6>
      <p class="price">₹3,500</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1050" data-type="egg" data-flavor="butterscotch">
  <div class="cake-card">
    <img src="img/acake8.jpeg" class="img-fluid" alt="Timeless Toffee Crunch">
    <div class="p-3 text-center">
      <h6 class="cake-name">Timeless Toffee Crunch</h6>
      <p class="price">₹1,050</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1350" data-type="eggless" data-flavor="red-velvet">
  <div class="cake-card">
    <img src="img/acake9.jpeg" class="img-fluid" alt="Heart-to-Heart Velvet">
    <div class="p-3 text-center">
      <h6 class="cake-name">Heart-to-Heart Velvet</h6>
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