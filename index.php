<?php
session_start();
?>
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
                    <!-- LOGIN GATED BUTTON -->
                    <a href="check-login.php?redirect=home.php"
                       class="btn btn-primary border-inner py-3 px-5 me-5">
                        BOOK NOW...!!
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- About Start -->
<div class="container-fluid pt-5">
    <div class="container">
        <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
            <h1 class="display-4 text-uppercase">Welcome To CakeCraft</h1>
        </div>

        <div class="row gx-5">
            <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100" src="img/about.jpg" style="object-fit: cover;">
                </div>
            </div>

            <div class="col-lg-6 pb-5">
                <h4 class="mb-4">
                    CakeCraft is trusted by hundreds of happy customers in Nashik for our consistent quality,
                    creative designs, and timely service.
                </h4>

                <p class="mb-5">
                    CakeCraft is a premium bakery dedicated to creating fresh, delicious, and beautifully crafted cakes
                    for every celebration. We focus on quality ingredients, hygienic baking, and elegant designs.
                </p>

                <div class="row g-5">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center justify-content-center bg-primary border-inner mb-4"
                             style="width: 90px; height: 90px;">
                            <i class="fa fa-heartbeat fa-2x text-white"></i>
                        </div>
                        <h4 class="text-uppercase">100% Healthy</h4>
                        <p class="mb-0">
                            We use high-quality ingredients and maintain strict hygiene standards.
                        </p>
                    </div>

                    <div class="col-sm-6">
                        <div class="d-flex align-items-center justify-content-center bg-primary border-inner mb-4"
                             style="width: 90px; height: 90px;">
                            <i class="fa fa-award fa-2x text-white"></i>
                        </div>
                        <h4 class="text-uppercase">Award Winning</h4>
                        <p class="mb-0">
                            Recognized for quality, creativity, and customer trust.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Testimonial Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
            <h2 class="text-primary font-secondary">Testimonial</h2>
            <h1 class="display-4 text-uppercase">Our Clients Say!!!</h1>
        </div>

        <div class="owl-carousel testimonial-carousel">
            <!-- same testimonial code (unchanged) -->
        </div>
    </div>
</div>
<!-- Testimonial End -->

<?php include "footer.php"; ?>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>
