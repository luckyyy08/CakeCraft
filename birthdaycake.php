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
        
        <h1 class="display-4 text-uppercase">Birthday Cake's</h1>
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

 <div class="col-md-4 cake-item" data-price="749" data-type="eggless" data-flavor="vanilla">
  <div class="cake-card">
    <img src="img/bdcake1.jpeg" class="img-fluid" alt="Funfetti Fiesta">
    <div class="p-3 text-center">
      <h6 class="cake-name">Funfetti Fiesta</h6>
      <p class="price">₹749</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="899" data-type="egg" data-flavor="chocolate">
  <div class="cake-card">
    <img src="img/bdcake2.jpeg" class="img-fluid" alt="Chocolate Overload">
    <div class="p-3 text-center">
      <h6 class="cake-name">Chocolate Overload</h6>
      <p class="price">₹899</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="799" data-type="eggless" data-flavor="vanilla">
  <div class="cake-card">
    <img src="img/bdcake3.jpeg" class="img-fluid" alt="Rainbow Sprinkle Surprise">
    <div class="p-3 text-center">
      <h6 class="cake-name">Rainbow Sprinkle Surprise</h6>
      <p class="price">₹799</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="849" data-type="eggless" data-flavor="oreo">
  <div class="cake-card">
    <img src="img/bdcake4.jpeg" class="img-fluid" alt="Cookies & Cream Dream">
    <div class="p-3 text-center">
      <h6 class="cake-name">Cookies & Cream Dream</h6>
      <p class="price">₹849</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="699" data-type="egg" data-flavor="strawberry">
  <div class="cake-card">
    <img src="img/bdcake5.jpeg" class="img-fluid" alt="Strawberry Shortcake Classic">
    <div class="p-3 text-center">
      <h6 class="cake-name">Strawberry Shortcake Classic</h6>
      <p class="price">₹699</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1099" data-type="eggless" data-flavor="chocolate">
  <div class="cake-card">
    <img src="img/bdcake6.jpeg" class="img-fluid" alt="Nutella Hazelnut Blast">
    <div class="p-3 text-center">
      <h6 class="cake-name">Nutella Hazelnut Blast</h6>
      <p class="price">₹1,099</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="949" data-type="eggless" data-flavor="caramel">
  <div class="cake-card">
    <img src="img/bdcake7.jpeg" class="img-fluid" alt="Caramel Popcorn Crunch">
    <div class="p-3 text-center">
      <h6 class="cake-name">Caramel Popcorn Crunch</h6>
      <p class="price">₹949</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1199" data-type="eggless" data-flavor="strawberry">
  <div class="cake-card">
    <img src="img/bdcake8.jpeg" class="img-fluid" alt="Magic Unicorn Swirl">
    <div class="p-3 text-center">
      <h6 class="cake-name">Magic Unicorn Swirl</h6>
      <p class="price">₹1,199</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1299" data-type="egg" data-flavor="chocolate">
  <div class="cake-card">
    <img src="img/bdcake9.jpeg" class="img-fluid" alt="Galaxy Mirror Glaze">
    <div class="p-3 text-center">
      <h6 class="cake-name">Galaxy Mirror Glaze</h6>
      <p class="price">₹1,299</p>
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