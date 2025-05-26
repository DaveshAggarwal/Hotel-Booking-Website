<?php
require('admin/inc/db_connect.php');
require('admin/inc/essentials.php');
require('ims/stripe/init.php');

date_default_timezone_set("Asia/Kolkata");

session_start();

// Redirect if not logged in
if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
  redirect('index.php');
}

use Stripe\StripeClient;

// Initialize Stripe with your secret key
$stripe = new StripeClient('sk_test_51PTbQmFR1i2uVQl69TzN3RqJCcVB4ov642JR8YWws4Onwh3sb06UoJRdrU3ABRCQ0Gm9H0iUtwyN6sAkn6HTJxjn00ZZAtWPAd');

$frm_data = filteration($_GET);
$order_id = $frm_data['order'] ?? null;
$session_id = $frm_data['session_id'] ?? null;

$booking_fetch = null;
$error_msg = null;

if ($order_id || $session_id) {
  // Fetch booking details
  $booking_q = "SELECT bo.*, bd.* FROM `booking_order` bo 
                INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id 
                WHERE (bo.order_id = ? OR bo.booking_id = ?) AND bo.user_id = ? AND bo.booking_status != ?";
  $booking_res = select($booking_q, [$order_id ?: '', $session_id ?: '', $_SESSION['uId'], 'pending'], 'ssis');

  if (mysqli_num_rows($booking_res) > 0) {
    $booking_fetch = mysqli_fetch_assoc($booking_res);

    // Update transaction status to TXN_FAILURE if not already set
    if ($booking_fetch['trans_status'] == 'PENDING') {
      try {
        $resp_msg = 'Payment cancelled by user';
        if ($session_id) {
          $session = $stripe->checkout->sessions->retrieve($session_id);
          $resp_msg = $session->payment_status === 'unpaid' ? 'Payment cancelled or failed' : 'Payment status unknown';
        }

        $update_q = "UPDATE `booking_order` SET `trans_status` = ?, `trans_resp_msg` = ? WHERE `booking_id` = ? AND `user_id` = ?";
        update($update_q, ['TXN_FAILURE', $resp_msg, $booking_fetch['booking_id'], $_SESSION['uId']], 'ssii');
        $booking_fetch['trans_status'] = 'TXN_FAILURE';
        $booking_fetch['trans_resp_msg'] = $resp_msg;
      } catch (Exception $e) {
        error_log("Stripe Error on Cancel: " . $e->getMessage());
        $error_msg = "Error processing cancellation: " . htmlspecialchars($e->getMessage());
      }
    }
  } else {
    $error_msg = "Booking not found or unauthorized.";
  }
} else {
  $error_msg = "Invalid request. No order or session ID provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('ims/links.php'); ?>
  <title><?php echo isset($setting_r['site_title']) ? $setting_r['site_title'] : 'Hotel Booking'; ?> - PAYMENT CANCELLED</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="bg-light">

  <?php require('ims/header.php'); ?>

  <div class="container">
    <div class="row">
      <div class="col-12 my-5 mb-3 px-4">
        <h2 class="fw-bold">PAYMENT CANCELLED</h2>
      </div>

      <?php if ($error_msg): ?>
        <div class="col-12 px-4">
          <div class="alert alert-danger">
            <h4 class="alert-heading"><i class="bi bi-exclamation-triangle-fill"></i> Error</h4>
            <p><?php echo htmlspecialchars($error_msg); ?></p>
            <a href="bookings.php" class="btn btn-primary">Go to Bookings</a>
            <a href="index.php" class="btn btn-secondary">Return to Home</a>
          </div>
        </div>
      <?php elseif ($booking_fetch): ?>
        <div class="col-12 px-4">
          <div class="alert alert-warning">
            <h4 class="alert-heading"><i class="bi bi-exclamation-triangle-fill"></i> Payment Cancelled</h4>
            <p><?php echo htmlspecialchars($booking_fetch['trans_resp_msg'] ?? 'Your payment was cancelled. Please try again or contact support.'); ?></p>
            <hr>
            <h6>Booking Details:</h6>
            <ul>
              <li><strong>Booking ID:</strong> <?php echo htmlspecialchars($booking_fetch['booking_id']); ?></li>
              <li><strong>Room:</strong> <?php echo htmlspecialchars($booking_fetch['room_name']); ?></li>
              <li><strong>Check-in:</strong> <?php echo htmlspecialchars($booking_fetch['check_in']); ?></li>
              <li><strong>Check-out:</strong> <?php echo htmlspecialchars($booking_fetch['check_out']); ?></li>
              <li><strong>Total Amount:</strong> $<?php echo htmlspecialchars($booking_fetch['total_pay']); ?></li>
              <li><strong>Name:</strong> <?php echo htmlspecialchars($booking_fetch['user_name']); ?></li>
              <li><strong>Phone:</strong> <?php echo htmlspecialchars($booking_fetch['phonenum']); ?></li>
              <li><strong>Address:</strong> <?php echo htmlspecialchars($booking_fetch['address']); ?></li>
            </ul>
            <a href="payment_page.php?order=<?php echo htmlspecialchars($booking_fetch['order_id']); ?>" class="btn btn-primary">Retry Payment</a>
            <a href="bookings.php" class="btn btn-secondary">Go to Bookings</a>
            <a href="index.php" class="btn btn-tertiary">Return to Home</a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <?php require('ims/footer.php'); ?>

</body>
</html>