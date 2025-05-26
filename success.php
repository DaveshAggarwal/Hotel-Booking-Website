<?php
require('admin/inc/db_connect.php');
require('admin/inc/essentials.php');
require('ims/stripe/init.php');

date_default_timezone_set("Asia/Kolkata");

session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
  redirect('index.php');
}

use Stripe\StripeClient;

// Initialize Stripe with your secret key
$stripe = new StripeClient('sk_test_51PTbQmFR1i2uVQl69TzN3RqJCcVB4ov642JR8YWws4Onwh3sb06UoJRdrU3ABRCQ0Gm9H0iUtwyN6sAkn6HTJxjn00ZZAtWPAd');

try {
  // Retrieve session_id and booking_id from URL
  $session_id = $_GET['session_id'] ?? null;
  $booking_id = $_GET['booking_id'] ?? null;

  if (!$session_id || !$booking_id) {
    throw new Exception("Invalid session or booking ID.");
  }

  // Verify Stripe checkout session
  $session = $stripe->checkout->sessions->retrieve($session_id);

  // Check if payment was successful
  if ($session->payment_status === 'paid') {
    // Get the amount paid (convert from cents to dollars)
    $amount_paid = $session->amount_total / 100;
    
    // Update booking_order with payment status, booking status, and transaction amount
    $query = "UPDATE `booking_order` 
              SET `trans_status` = ?, 
                  `booking_status` = 'booked', 
                  `trans_amt` = ?
              WHERE `booking_id` = ? AND `user_id` = ?";
    $values = ['TXN_SUCCESS', $amount_paid, $booking_id, $_SESSION['uId']];
    update($query, $values, 'sdis');

    // Fetch booking details for display
    $booking_query = "SELECT bo.*, bd.* FROM `booking_order` bo 
                     INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id 
                     WHERE bo.booking_id = ? AND bo.user_id = ?";
    $booking = select($booking_query, [$booking_id, $_SESSION['uId']], 'ii');

    if (mysqli_num_rows($booking) == 0) {
      throw new Exception("Booking not found.");
    }

    $booking_data = mysqli_fetch_assoc($booking);
  } else {
    throw new Exception("Payment not completed.");
  }
} catch (Exception $e) {
  // Log error and redirect with error message
  error_log("Success Page Error: " . $e->getMessage());
  $_SESSION['error'] = "Error processing payment: " . $e->getMessage();
  redirect('payment_failed.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Success</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header bg-success text-white">
        <h3 class="mb-0">Payment Successful!</h3>
      </div>
      <div class="card-body">
        <h5>Booking Confirmation</h5>
        <p><strong>Booking ID:</strong> <?php echo htmlspecialchars($booking_data['booking_id']); ?></p>
        <p><strong>Order ID:</strong> <?php echo htmlspecialchars($booking_data['order_id']); ?></p>
        <p><strong>Room:</strong> <?php echo htmlspecialchars($booking_data['room_name']); ?></p>
        <p><strong>Check-in:</strong> <?php echo date('d-m-Y', strtotime($booking_data['check_in'])); ?></p>
        <p><strong>Check-out:</strong> <?php echo date('d-m-Y', strtotime($booking_data['check_out'])); ?></p>
        <p><strong>Total Amount Paid:</strong> ₹<?php echo number_format($booking_data['trans_amt'], 2); ?></p>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($booking_data['user_name']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($booking_data['phonenum']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($booking_data['address']); ?></p>
        <p class="text-success">Your booking has been confirmed. Thank you!</p>
        <a href="index.php" class="btn btn-primary">Return to Home</a>
        <button onclick="window.print()" class="btn btn-secondary">Print Confirmation</button>
      </div>
    </div>
  </div>
</body>
</html>