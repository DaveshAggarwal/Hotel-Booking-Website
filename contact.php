<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require("ims/links.php") ?>
    <title>HOTEL BOOKING_contact</title>

</head>

<body class="bg-light">
    <?php require('ims/header.php'); ?>
    <div class="my-5 px-4">
        <h2 class="fw-bold text-center" style="font-family: 'Dancing Script', cursive;">CONTACT US</h2>
        <div class="h-line bg-dark mb-3"> </div>
        <p class="text-center mb-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus <br>recusandae maxime commodi
            sapiente odit, soluta facere porro! Nulla, suscipit delectus!
        </p>
    </div>
   
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 ">
                    <iframe src="<?php echo $contact_r['iframe'] ?>"
                        height="320px" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" class="w-100 rounded mb-4"></iframe>
                    <h5>Address</h5>
                    <a href="<?php echo $contact_r['gmap'] ?>" target="_blank" class="d-inline-block text-decoration-none text-dark mb-1">
                        <i class="bi bi-geo-alt"></i>
                        <?php echo $contact_r['address'] ?></a>
                    <h5 class="mt-4">Call us</h5>
                    <a href="tel:+<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-1 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i>+<?php echo $contact_r['pn1'] ?></a>
                    <h5 class="mt-4">Email</h5>
                    <a href="mailto:<?php echo $contact_r['email'] ?>" class="d-inline-block mb-1 text-decoration-none text-dark">
                        <i class="bi bi-envelope"></i> <?php echo $contact_r['email'] ?></a>
                    <h5 class="mt-4">Follow us</h5>
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
            <div class="col-lg-6 col-md-6 px-4">
                <div class="bg-white rounded shadow p-4">
                    <form action="" method="post">
                        <h5>Send a message</h5>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Name</label>
                            <input name="name" required type="text" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Email</label>
                            <input type="email" class="form-control shadow-none" name="email" required>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Subject</label>
                            <input type="text" class="form-control shadow-none" name="subject" required>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Message</label>
                            <textarea class="form-control shadow-none" style="resize: none;" rows="5" name="message" required></textarea>
                        </div>
                        <button class="btn text-white custom-bg mt-3" type="submit" name="send">Send</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
    <?php 

    if(isset($_POST['send']))
    {
        $frm_data = filteration($_POST);

        $q = "INSERT INTO `user_querries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
        $values = [$frm_data['name'],$frm_data['email'],$frm_data['subject'],$frm_data['message']];

        $res = insert($q,$values,'ssss');
        if($res==1){
            alert('success','Mail sent!');
        }
        else{
            alert('error','Server Down! Try again later.');
        }
    }
    ?>
    <?php require('ims/footer.php'); ?>

</body>

</html>