<?php include_once("inc/db_connect.php"); 
require("inc/essentials.php");

session_start();

    if ((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] === true)) {
        redirect('dashboard.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        div.login-form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
        }
    </style>
    <?php require("inc/links.php"); ?>
</head>

<body class="bg-light">
    <div class="login-form text-center rounded bg-white shadow overflow-hidden">
        <form action="" method="post">
            <h4 class="bg-dark text-white py-3">ADMIN LOGIN PANEL</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="admin_name" type="text" class="form-control shadow-none text-center" placeholder="Admin name" required>
                </div>
                <div class="mb-4">
                    <input name="admin_pass" type="password" class="form-control shadow-none text-center" placeholder="Password" required>
                </div>
                <button name="login" type="submit" class="btn text-white custom-bg shadow-none">Login</button>
            </div>
        </form>
    </div>

    <?php

    if (isset($_POST['login'])) {
        $frm_data = filteration($_POST);

        $query = "SELECT * FROM `admin_cred` WHERE `admin_name` = ? AND `admin_pass` = ?";
        $values = [$frm_data['admin_name'], $frm_data['admin_pass']];
        $res = select($query, $values, "ss");
        if ($res->num_rows == 1) {
            $row = $res->fetch_assoc();
            $_SESSION['adminLogin'] = true;
            $_SESSION['adminid'] = $row['sr_no'];
            redirect('dashboard.php');
            
        } else {
            alert('error,', 'login failed');
        }
    }

    ?>

    <?php require("inc/script.php"); ?>
</body>

</html>
