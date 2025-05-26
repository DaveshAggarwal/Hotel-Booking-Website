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

if (isset($_POST['pay_now'])) {
  header("Pragma: no-cache");
  header("Cache-Control: no-cache");
  header("Expires: 0");

  $ORDER_ID = 'ORD_' . $_SESSION['uId'] . random_int(11111, 9999999);
  $CUST_ID = $_SESSION['uId'];
  $TXN_AMOUNT = $_SESSION['room']['payment'];

  // Insert payment data into database
  $frm_data = filteration($_POST);

  $query1 = "INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`,`order_id`) VALUES (?,?,?,?,?)";

  insert($query1, [
    $CUST_ID,
    $_SESSION['room']['id'],
    $frm_data['checkin'],
    $frm_data['checkout'],
    $ORDER_ID
  ], 'issss');

  $booking_id = mysqli_insert_id($con);

  $query2 = "INSERT INTO `booking_details`(`booking_id`, `room_name`, `price`, `total_pay`,
      `user_name`, `phonenum`, `address`) VALUES (?,?,?,?,?,?,?)";

  insert($query2, [
    $booking_id,
    $_SESSION['room']['name'],
    $_SESSION['room']['price'],
    $TXN_AMOUNT,
    $frm_data['name'],
    $frm_data['phonenum'],
    $frm_data['address']
  ], 'issssss');

  // Create Stripe Checkout Session
  try {
    $checkout_session = $stripe->checkout->sessions->create([
      'line_items' => [[
        'price_data' => [
          'currency' => 'INR',
          'product_data' => [
            'name' => $_SESSION['room']['name'] . ' Room Booking',
          ],
          'unit_amount' => $TXN_AMOUNT * 100, // Convert to cents
        ],
        'quantity' => 1,
      ]],
      'mode' => 'payment',
      'success_url' => 'http://localhost/mca/success.php?session_id={CHECKOUT_SESSION_ID}&booking_id=' . $booking_id,
      'cancel_url' => 'http://localhost/mca/cancel.php',
    ]);

    // Redirect to Stripe Checkout
    header("HTTP/1.1 303 See Other");
    header("Location: " . $checkout_session->url);
    exit;
    
  } catch (Exception $e) {
    // Log the error and show a user-friendly message
    error_log("Stripe Error: " . $e->getMessage());
    $_SESSION['error'] = "Payment processing failed. Please try again.";
    redirect('payment_page.php'); // Redirect back to payment page
  }
}
?>