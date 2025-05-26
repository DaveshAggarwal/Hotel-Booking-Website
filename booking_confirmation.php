<?php
require('admin/inc/db_connect.php');
require('admin/inc/essentials.php');

session_start();

if (!isset($_SESSION['booking_confirmation'])) {
  redirect('index.php');
  exit;
}

$booking = $_SESSION['booking_confirmation'];
unset($_SESSION['booking_confirmation']); // Clear the session data after displaying
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking Confirmation</title>
  <?php require('admin/inc/links.php'); ?>
</head>
<body>
  <?php require('inc/header.php'); ?>

  <div class="container">
    <div class="alert alert-success mt-5">
      <h2 class="fw-bold">Booking Confirmed!</h2>
      <p>Thank you for your booking. Here are your details:</p>
      
      <div class="card mt-4">
        <div class="card-body">
          <h5 class="card-title">Order #<?= $booking['order_id'] ?></h5>
          <p class="card-text">
            <strong>Room:</strong> <?= $booking['room_name'] ?><br>
            <strong>Check-in:</strong> <?= date('d M Y', strtotime($booking['check_in'])) ?><br>
            <strong>Check-out:</strong> <?= date('d M Y', strtotime($booking['check_out'])) ?><br>
            <strong>Total Paid:</strong> $<?= number_format($booking['amount'], 2) ?><br>
            <strong>Booking Date:</strong> <?= date('d M Y H:i', strtotime($booking['booking_date'])) ?>
          </p>
          <p>A confirmation email has been sent to your registered email address.</p>
        </div>
      </div>
      
      <a href="index.php" class="btn btn-primary mt-3">Back to Home</a>
    </div>
  </div>

  <?php require('inc/footer.php'); ?>
</body>
</html>