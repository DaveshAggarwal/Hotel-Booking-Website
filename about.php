<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require("ims/links.php") ?>
    <title>HOTEL BOOKING_about</title>

    <style>
        :root {
            --teal: #008080;
            /* Define teal color */
        }

        .box {
            border-top: 4px solid transparent;
            /* Define the initial transparent border */
            transition: border-top-color 0.3s ease;
            /* Smooth transition on hover */
        }

        .box:hover {
            border-top-color: var(--teal) !important;
            /* Change the border color on hover */
        }
    </style>
</head>

<body class="bg-light">
    <?php require('ims/header.php'); ?>
    <div class="my-5 px-4">
        <h2 class="fw-bold text-center"style="font-family: 'Dancing Script', cursive;">ABOUT US</h2>
        <div class="h-line bg-dark mb-3"> </div>
        <p class="text-center mb-3">
        Welcome to Aggarwal Hotel, your ultimate destination for a luxurious and comfortable stay.<br> Whether you’re traveling 
        for business or leisure, we are dedicated to offering you an unforgettable experience..
        </p>
    </div>
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
                <h3 class="mb-3">WELCOME</h3>
                <p>Our mission is simple: to provide you with exceptional hospitality and a seamless booking experience. From cozy accommodations to world-class dining and relaxing recreational options, 
                    everything we do revolves around creating cherished memories for you.
Experience the perfect blend of comfort, convenience, and care. Let us turn your stay into an extraordinary journey!</p>
            </div>
            <div class="col-lg-5 col-md-5 mb-4 order-1">
                <img src="images\about\about.jpg" class="w-100">
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images\about\hotel.svg" width="70px">
                    <h4 class="mt-3">100+ rooms</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images\about\customers.svg" width="70px">
                    <h4 class="mt-3">200+ customers</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images\about\rating.svg" width="70px">
                    <h4 class="mt-3">100+ reviews</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images\about\staff.svg" width="70px">
                    <h4 class="mt-3">100+ staffs</h4>
                </div>
            </div>
        </div>
    </div>

    <h3 class="my-5 fw-bold text-center">MANAGEMENT TEAM</h3>

    <div class="container px-4">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper mb-5">
                <?php
                $about_r = selectAll('team_details');
                $path = ABOUT_IMG_PATH;
                
                while($row = mysqli_fetch_assoc($about_r)){
                    echo <<<data
                    <div class="swiper-slide bg-white text-center rounded overflow-hidden">
                    <img src="$path$row[picture]" width="w-100"style="height: 500px;">
                    <h5 class="mt-2">$row[name]</h5>
                </div>
                data;
                }
                ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <?php require('ims/footer.php'); ?>

    <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".mySwiper", {
    spaceBetween:40,
    pagination: {
      el: ".swiper-pagination",
    },
    breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                }
            }
  });
</script>

</body>

</html>