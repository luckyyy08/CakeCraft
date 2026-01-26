<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CakeCraft - Cake Shop Website</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@500;600;700&family=Pacifico&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
<?php include "header.php"; ?>

    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-8 text-center text-lg-start">
                    <h1 class="font-secondary text-primary mb-4">Super Crispy</h1>
                    <h1 class="display-1 text-uppercase text-white mb-4">CakeCraft</h1>
                    <h1 class="text-uppercase text-white">The Best Cake In Nashik</h1>
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-start pt-5">
                        <a href="" class="btn btn-primary border-inner py-3 px-5 me-5">BOOK NOW...!!</a>
                        <!-- <button type="button" class="btn-play" data-bs-toggle="modal"
                            data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                            <span></span>
                        </button> -->
                        <!-- <h5 class="font-weight-normal text-white m-0 ms-4 d-none d-sm-block">Play Video</h5> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->







 

 

    <!-- Offer Start -->
    <div class="container-fluid bg-offer my-5 py-5">
        <div class="container py-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-7 text-center">
                    <div class="section-title position-relative text-center mx-auto mb-4 pb-3" style="max-width: 600px;">
                        <h2 class="text-primary font-secondary">Special Kombo Pack</h2>
                        <h1 class="display-4 text-uppercase text-white">Super Crispy Cakes</h1>
                    </div>
                    <p class="text-white mb-4">Eirmod sed tempor lorem ut dolores sit kasd ipsum. Dolor ea et dolore et at sea ea at dolor justo ipsum duo rebum sea. Eos vero eos vero ea et dolore eirmod et. Dolores diam duo lorem. Elitr ut dolores magna sit. Sea dolore sed et.</p>
                    <a href="" class="btn btn-primary border-inner py-3 px-5 me-3">Shop Now</a>
                    <a href="" class="btn btn-dark border-inner py-3 px-5">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->
<!-- Cake Categories Start -->
<div class="container py-5">
    <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
        <h2 class="text-primary font-secondary">Categories</h2>
        <h1 class="display-4 text-uppercase">Choose Your Cake</h1>
    </div>

    <div class="row justify-content-center text-center g-4">
        <div class="col-6 col-md-3">
            <a href="wedding.html" class="cake-category">
                <img src="img/logo1.png" alt="Wedding Cake">
                <h5>Wedding Cake</h5>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="birthday.html" class="cake-category">
                <img src="img/logo1.png" alt="Birthday Cake">
                <h5>Birthday Cake</h5>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="anniversary.html" class="cake-category">
                <img src="img/anniversary.jpg" alt="Anniversary Cake">
                <h5>Anniversary Cake</h5>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="custom.html" class="cake-category">
                <img src="img/custom.jpg" alt="Custom Cake">
                <h5>Custom Cake</h5>
            </a>
        </div>
    </div>
</div>
<!-- Cake Categories End -->


 <?php include "footer.php"; ?>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        function searchCakes() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let cakes = document.getElementsByClassName("cake-name");

            for (let i = 0; i < cakes.length; i++) {
                let text = cakes[i].innerText.toLowerCase();
                let card = cakes[i].closest(".col-lg-6");

                card.style.display = text.includes(input) ? "block" : "none";
            }
        }
    </script>

</body>

</html>
