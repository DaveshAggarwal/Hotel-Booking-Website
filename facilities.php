<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require("ims/links.php") ?>
    <title>HOTEL BOOKING_facilities</title>

    <style>
        :root {
            --teal: #008080;
        }

        .pop {
            border-top: 4px solid transparent;
            transition: border-top-color 0.3s ease;
        }

        .pop:hover {
            border-top-color: var(--teal) !important;
            transform: scale(1.03);
            transition: all 0.3s;
        }
    </style>
</head>

<body class="bg-light">
    <?php require('ims/header.php'); ?>
    <div class="my-5 px-4">
        <h2 class="fw-bold text-center" style="font-family: 'Dancing Script', cursive;">OUR FACILITIES</h2>
        <div class="h-line bg-dark mb-3"> </div>
        <p class="text-center mb-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus <br>recusandae maxime commodi
            sapiente odit, soluta facere porro! Nulla, suscipit delectus!
        </p>
    </div>
    <div class="container">
        <div class="row">
            <?php
            $res = selectAll('facilities');
            $path = FACILITIES_IMG_PATH;

            while ($row = mysqli_fetch_assoc($res)) {
                echo <<<data
            <div class="col-lg-4 col-md-6 mb-5 px-4">
              <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                <div class="d-flex align-items-center mb-2">
                  <img src="$path$row[icon]" width="40px">
                  <h5 class="m-0 ms-3">$row[name]</h5>
                </div>
                <p>$row[description]</p>
              </div>
            </div>
          data;
            }
            ?>
        </div>
    </div>


    <?php require('ims/footer.php'); ?>

</body>

</html>