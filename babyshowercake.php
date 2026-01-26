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
        
        <h1 class="display-4 text-uppercase">Baby-Shower Cake's</h1>
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
<div class="col-md-4 cake-item" data-price="1450" data-type="eggless" data-flavor="vanilla">
  <div class="cake-card">
    <img src="img/bcake1.jpeg" class="img-fluid" alt="Little Dreamer Clouds">
    <div class="p-3 text-center">
      <h6 class="cake-name">Little Dreamer Clouds</h6>
      <p class="price">₹1,450</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1899" data-type="eggless" data-flavor="chocolate">
  <div class="cake-card">
    <img src="img/bcake2.jpeg" class="img-fluid" alt="Teddy Bear Picnic">
    <div class="p-3 text-center">
      <h6 class="cake-name">Teddy Bear Picnic</h6>
      <p class="price">₹1,899</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1600" data-type="egg" data-flavor="custom">
  <div class="cake-card">
    <img src="img/bcake3.jpeg" class="img-fluid" alt="Gender Reveal Mystery">
    <div class="p-3 text-center">
      <h6 class="cake-name">Gender Reveal Mystery</h6>
      <p class="price">₹1,600</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1299" data-type="eggless" data-flavor="strawberry">
  <div class="cake-card">
    <img src="img/bcake4.jpeg" class="img-fluid" alt="Oh Baby! Pastel Ombre">
    <div class="p-3 text-center">
      <h6 class="cake-name">Oh Baby! Pastel Ombre</h6>
      <p class="price">₹1,299</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1550" data-type="eggless" data-flavor="vanilla">
  <div class="cake-card">
    <img src="img/bcake5.jpeg" class="img-fluid" alt="Twinkle Twinkle Little Star">
    <div class="p-3 text-center">
      <h6 class="cake-name">Twinkle Twinkle Little Star</h6>
      <p class="price">₹1,550</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="2200" data-type="eggless" data-flavor="butterscotch">
  <div class="cake-card">
    <img src="img/bcake6.jpeg" class="img-fluid" alt="Boho Safari Adventure">
    <div class="p-3 text-center">
      <h6 class="cake-name">Boho Safari Adventure</h6>
      <p class="price">₹2,200</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1750" data-type="egg" data-flavor="chocolate">
  <div class="cake-card">
    <img src="img/bcake7.jpeg" class="img-fluid" alt="Sleeping Elephant Cute">
    <div class="p-3 text-center">
      <h6 class="cake-name">Sleeping Elephant Cute</h6>
      <p class="price">₹1,750</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1400" data-type="eggless" data-flavor="fruit">
  <div class="cake-card">
    <img src="img/bcake8.jpeg" class="img-fluid" alt="Peach & Cream Ruffles">
    <div class="p-3 text-center">
      <h6 class="cake-name">Peach & Cream Ruffles</h6>
      <p class="price">₹1,400</p>
    </div>
  </div>
</div>

<div class="col-md-4 cake-item" data-price="1150" data-type="eggless" data-flavor="blueberry">
  <div class="cake-card">
    <img src="img/bcake9.jpeg" class="img-fluid" alt="Blueberry Sky Delight">
    <div class="p-3 text-center">
      <h6 class="cake-name">Blueberry Sky Delight</h6>
      <p class="price">₹1,150</p>
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