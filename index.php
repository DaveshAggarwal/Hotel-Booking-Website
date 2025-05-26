<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">


    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .font {
            font-family: 'Dancing Script', cursive;
        }

        .heading {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
        }

        .hero-section {
            position: relative;
            width: 100%;
            height: auto;
        }

        .hero-section img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .text-overlay {
            position: absolute;
            top: 30%;
            left: 8%;
            color: white;
            text-align: left;
            transform: translateY(-50%);
        }

        .text-overlay .subtitle {
            font-size: 1.2rem;
            font-weight: 500;
            letter-spacing: 2px;
            margin-bottom: 10px;
            color: rgba(255, 255, 255, 0.8);
            text-transform: uppercase;
            opacity: 0;

        }

        .text-overlay .title {
            font-size: 4rem;
            font-weight: bold;
            margin-bottom: 20px;
            line-height: 1.2;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.6);
            opacity: 0;

        }

        .text-overlay .btn {
            font-size: 1.2rem;
            padding: 10px 30px;
            background-color: #ffc107;
            color: #000;
            border: none;
            border-radius: 30px;
            transition: all 0.3s ease;
            opacity: 0;

        }

        .text-overlay .btn:hover {
            background-color: #e0a800;
            color: white;
            transform: scale(1.1);
        }


        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animated-fade-in {
            animation: fadeIn 1s ease forwards;
        }
    </style>
    <title>HOTEL BOOKING</title>
    <?php require("ims/links.php") ?>
</head>

<body class="bg-light">
    <?php require('ims/header.php'); ?>


    <!-- carousel -->
    <div class="container-fluid px-lg-4 mt-4">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide position-relative">
                    <img src="images/carousel/IMG_15372.png" alt="Slide 1" class="img-fluid">
                    <div class="text-overlay">
                        <p class="subtitle animated-fade-in" style="animation-delay: 0.5s;">About Us</p>
                        <h1 class="title animated-fade-in" style="animation-delay: 1s;">The Perfect Base<br> For You</h1>
                        <button class="btn btn-warning animated-fade-in" style="animation-delay: 1.5s;">Take A Tour</button>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide position-relative">
                    <img src="images/carousel/IMG_40905.png" alt="Slide 2" class="img-fluid">
                    <div class="text-overlay">
                        <p class="subtitle animated-fade-in" style="animation-delay: 0.5s;">About Us</p>
                        <h1 class="title animated-fade-in" style="animation-delay: 1s;">The Perfect Base<br> For You</h1>
                        <button class="btn btn-warning animated-fade-in" style="animation-delay: 1.5s;">Take A Tour</button>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide position-relative">
                    <img src="images/carousel/IMG_55677.png" alt="Slide 3" class="img-fluid">
                    <div class="text-overlay">
                        <p class="subtitle animated-fade-in" style="animation-delay: 0.5s;">About Us</p>
                        <h1 class="title animated-fade-in" style="animation-delay: 1s;">The Perfect Base<br> For You</h1>
                        <button class="btn btn-warning animated-fade-in" style="animation-delay: 1.5s;">Take A Tour</button>
                    </div>
                </div>
                <!-- Slide 4 -->
                <div class="swiper-slide position-relative">
                    <img src="images/carousel/IMG_62045.png" alt="Slide 4" class="img-fluid">
                    <div class="text-overlay">
                        <p class="subtitle animated-fade-in" style="animation-delay: 0.5s;">About Us</p>
                        <h1 class="title animated-fade-in" style="animation-delay: 1s;">The Perfect Base<br> For You</h1>
                        <button class="btn btn-warning animated-fade-in" style="animation-delay: 1.5s;">Take A Tour</button>
                    </div>
                </div>
            </div>f
        </div>
    </div>

    <!-- check availability form -->
   <div class="container availability-form">
    <div class="row">
      <div class="col-lg-12 bg-white shadow p-4 rounded">
        <h5 class="mb-4">Check Booking Availability</h5>
        <form action="rooms.php">
          <div class="row align-items-end">
            <div class="col-lg-3 mb-3">
              <label class="form-label" style="font-weight: 500;">Check-in</label>
              <input type="date" class="form-control shadow-none" name="checkin" required>
            </div>
            <div class="col-lg-3 mb-3">
              <label class="form-label" style="font-weight: 500;">Check-out</label>
              <input type="date" class="form-control shadow-none" name="checkout" required>
            </div>
            <div class="col-lg-3 mb-3">
              <label class="form-label" style="font-weight: 500;">Adult</label>
              <select class="form-select shadow-none" name="adult">
                <?php 
                  $guests_q = mysqli_query($con,"SELECT MAX(adult) AS `max_adult`, MAX(children) AS `max_children` 
                    FROM `rooms` WHERE `status`='1' AND `removed`='0'");  
                  $guests_res = mysqli_fetch_assoc($guests_q);
                  
                  for($i=1; $i<=$guests_res['max_adult']; $i++){
                    echo"<option value='$i'>$i</option>";
                  }
                ?>
              </select>
            </div>
            <div class="col-lg-2 mb-3">
              <label class="form-label" style="font-weight: 500;">Children</label>
              <select class="form-select shadow-none" name="children">
                <?php 
                  for($i=1; $i<=$guests_res['max_children']; $i++){
                    echo"<option value='$i'>$i</option>";
                  }
                ?>
              </select>
            </div>
            <input type="hidden" name="check_availability">
            <div class="col-lg-1 mb-lg-3 mt-2">
              <button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

    <!-- our rooms-->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold font ">OUR ROOMS</h2>

    <div class="container">
        <div class="row">
            <?php
            // Fetch rooms for the current page
            $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `id` ASC LIMIT 3", [1, 0], 'ii');


            while ($room_data = mysqli_fetch_assoc($room_res)) {
                // Get features of room
                $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN room_features rfea ON f.id = rfea.features_id WHERE rfea.room_id = '$room_data[id]'");

                $features_data = "";
                while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                    $features_data .= '<span class="badge bg-light text-dark text-wrap">' . htmlspecialchars($fea_row['name']) . '</span>';
                }

                // Facilities of room
                $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f INNER JOIN room_facilities rfac ON f.id = rfac.facilities_id WHERE rfac.room_id = '$room_data[id]'");

                $facilities_data = "";
                while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                    $facilities_data .= '<span class="badge bg-light text-dark text-wrap">' . htmlspecialchars($fac_row['name']) . '</span>';
                }

                // Get thumbnail
                $room_img = ROOMS_IMG_PATH . "thumbnail.jpg";
                $img_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]' AND thumb='1'");

                if (mysqli_num_rows($img_q) > 0) {
                    $img_res = mysqli_fetch_assoc($img_q);
                    $room_img = ROOMS_IMG_PATH . $img_res['image'];
                }

                $book_btn = "";

                if(!$setting_r['shutdown']){
                    $login=0;
                    if(isset($_SESSION['login']) && $_SESSION['login']==true){
                      $login=1;
                    }
        
                    $book_btn = "<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-sm text-white custom-bg shadow-none'>Book Now</button>";
                  }
                // Print room card
                echo <<<data
            <div class="col-lg-4 col-md-6 my-3">
              <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                <img src="$room_img" class="card-img-top">
                <div class="card-body">
                  <h5>$room_data[name]</h5>
                  <h6 class="mb-4">₹$room_data[price] per night</h6>
                  <div class="features mb-2">
                    <h6 class="mb-1">Features</h6>
                    $features_data
                  </div>
                  <div class="facilities mb-2">
                    <h6 class="mb-1">Facilities</h6>
                    $facilities_data
                  </div>
                  <div class="guests mb-2">
                    <h6 class="mb-1">Guests</h6>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                      $room_data[adult] Adults
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                      $room_data[children] Children
                    </span>
                  </div>
                <div class="rating mb-2">
                            <h6 class="mb-1 fw-bold">Rating</h6>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                  <div class="d-flex justify-content-evenly mb-2">
                            $book_btn
                            <a href="rooms_details.php?id=$room_data[id]" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
                        </div>
                </div>
              </div>
            </div>
          data;
            }
            ?>
            <div class="col-lg-12 text-center mt-5">
                <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-0 fe-bold shadow-none"> More rooms >>></a>
            </div>
        </div>
    </div>

    <!-- facilities -->

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold font ">OUR FACILITIES</h2>

    <div class="container">
        <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
            <?php
            $res = mysqli_query($con, "SELECT * FROM `facilities` ORDER BY `id` DESC LIMIT 5");
            $path = FACILITIES_IMG_PATH;

            while ($row = mysqli_fetch_assoc($res)) {
                echo <<<data
          <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
            <img src="$path$row[icon]" width="60px">
            <h5 class="mt-3">$row[name]</h5>
          </div>
        data;
            }
            ?>

            <div class="col-lg-12 text-center mt-5">
                <a href="facilities.php" class="btn btn-sm btn-outline-dark rounded-0 fe-bold shadow-none"> More Facilities >>></a>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
   <h2 class="mt-5 pt-4 mb-4 text-center fw-bold font">TESTIMONIALS</h2>
<div class="container mt-5">
    <div class="swiper swiper-test">
        <div class="swiper-wrapper mb-5">
            <div class="swiper-slide bg-white mb-3">
                <div class="profile">
                    <i class="bi bi-chat-quote-fill text-primary fs-4"></i>
                    <h6 class="m-0 ms-2">Emily Carter</h6>
                    <p>"Absolutely fantastic service! The team went above and beyond to ensure I was satisfied. Highly recommend to anyone looking for quality and professionalism!"</p>
                    <div class="rating d-flex align-items-center p-4">
                        <span class="badge rounded-pill bg-light">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="swiper-slide bg-white mb-3">
                <div class="profile">
                    <i class="bi bi-chat-quote-fill text-primary fs-4"></i>
                    <h6 class="m-0 ms-2">Jason Lee</h6>
                    <p>"I was blown away by the attention to detail and care that went into the process. The results exceeded my expectations. A big thank you to the entire team!"</p>
                    <div class="rating d-flex align-items-center p-4">
                        <span class="badge rounded-pill bg-light">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="swiper-slide bg-white p-4">
                <div class="profile">
                    <i class="bi bi-chat-quote-fill text-primary fs-4"></i>
                    <h6 class="m-0 ms-2">Sophia Williams</h6>
                    <p>"Amazing experience from start to finish! The team was responsive, skilled, and incredibly friendly. I couldn’t ask for more."</p>
                    <div class="rating d-flex align-items-center p-4">
                        <span class="badge rounded-pill bg-light">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="swiper-slide bg-white p-4">
                <div class="profile">
                    <i class="bi bi-chat-quote-fill text-primary fs-4"></i>
                    <h6 class="m-0 ms-2">Michael Brown</h6>
                    <p>"The level of support and expertise offered was outstanding. They made sure every detail was perfect and I couldn’t be happier with the result."</p>
                    <div class="rating d-flex align-items-center p-4">
                        <span class="badge rounded-pill bg-light">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="swiper-slide bg-white p-4">
                <div class="profile">
                    <i class="bi bi-chat-quote-fill text-primary fs-4"></i>
                    <h6 class="m-0 ms-2">Olivia Johnson</h6>
                    <p>"From consultation to delivery, everything was handled with professionalism and care. I am thoroughly impressed and will be returning for future projects!"</p>
                    <div class="rating d-flex align-items-center p-4">
                        <span class="badge rounded-pill bg-light">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>
<div class="col-lg-12 text-center mt-5">
    <a href="about.php" class="btn btn-sm btn-outline-dark rounded-0 fe-bold shadow-none"> Know More >>></a>
</div>


    <!-- Reach Us -->

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold font">REACH US</h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 p-4 mb-3 mb-lg-0 bg-white rounded">
                <iframe src="<?php echo $contact_r['iframe'] ?>"
                    height="320px" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" class="w-100 rounded mb-4"></iframe>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="bg-white p-4 rounded mb-4">
                    <h5>Call us</h5>
                    <a href="tel:+<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-3 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i>+<?php echo $contact_r['pn1'] ?></a>
                </div>
                <div class="bg-white p-4 rounded mb-4">
                    <h5>Follow us</h5>
                    <?php
                    if ($contact_r['tw'] != '') {
                        echo <<<data
                <a href="$contact_r[tw]" class="d-inline-block mb-3">
                  <span class="badge bg-light text-dark fs-6 p-2"> 
                  <i class="bi bi-twitter me-1"></i> Twitter
                  </span>
                </a>
                <br>
              data;
                    }
                    ?>
                    <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-facebook me-1"></i> Facebook
                        </span>
                    </a>
                    <br>
                    <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block">
                        <span class="badge bg-light text-dark fs-6 pb-2">
                            <i class="bi bi-instagram me-1"></i> Instagram</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Password reset modal and code -->

    <div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="recovery-form">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-shield-lock fs-3 me-2"></i> Set up New Password
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <label class="form-label">New Password</label>
                            <input type="password" name="pass" required class="form-control shadow-none">
                            <input type="hidden" name="email">
                            <input type="hidden" name="token">
                        </div>
                        <div class="mb-2 text-end">
                            <button type="button" class="btn shadow-none me-2" data-bs-dismiss="modal">CANCEL</button>
                            <button type="submit" class="btn btn-dark shadow-none">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require('ims/footer.php'); ?>


    <?php

    if (isset($_GET['account_recovery'])) {
        $data = filteration($_GET);

        $t_date = date("Y-m-d");

        $query = select(
            "SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? AND `t_expire`=? LIMIT 1",
            [$data['email'], $data['token'], $t_date],
            'sss'
        );

        if (mysqli_num_rows($query) == 1) {
            echo <<<showModal
        <script>
          var myModal = document.getElementById('recoveryModal');

          myModal.querySelector("input[name='email']").value = '$data[email]';
          myModal.querySelector("input[name='token']").value = '$data[token]';

          var modal = bootstrap.Modal.getOrCreateInstance(myModal);
          modal.show();
        </script>
      showModal;
        } else {
            alert("error", "Invalid or Expired Link !");
        }
    }

    ?>




    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const swiper = new Swiper(".mySwiper", {
                spaceBetween: 30,
                effect: "fade",
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                }
            });
        });

        var swiper = new Swiper(".swiper-test", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            loop: true,
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            },
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
        let recovery_form = document.getElementById('recovery-form');

        recovery_form.addEventListener('submit', (e) => {
            e.preventDefault();

            let data = new FormData();

            data.append('email', recovery_form.elements['email'].value);
            data.append('token', recovery_form.elements['token'].value);
            data.append('pass', recovery_form.elements['pass'].value);
            data.append('recover_user', '');

            var myModal = document.getElementById('recoveryModal');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "userajax/login_register.php", true);

            xhr.onload = function() {
                if (this.responseText == 'failed') {
                    alert('error', "Account reset failed!");
                } else {
                    alert('success', "Account Reset Successful !");
                    recovery_form.reset();
                }
            }

            xhr.send(data);
        });
    </script>
</body>

</html>