<?php
session_start();

include_once 'dbconnect2.php';

if (!isset($_SESSION['user'])) {
  header("Location: customersignin.html");
} else {
  $user = $_SESSION['user'];

  // Retrieve the coupon code from the form submission
  $coupon = $_POST['coupon'];

  // Query the database to check if the coupon code exists
  $couponQuery = mysqli_query($con, "SELECT * FROM coupons WHERE code = '$coupon'");
  $couponResult = mysqli_fetch_array($couponQuery);

  if ($couponResult) {
    // Coupon code exists, apply the discount to the total price
    $discount = $couponResult['discount'];

    $totalQuery = mysqli_query($con, "SELECT SUM(price) FROM book B, class C WHERE B.username = '$user' AND paid = '0' AND classtype=C.name AND flightno = C.number");
    $totalResult = mysqli_fetch_array($totalQuery);
    $totalPrice = $totalResult['SUM(price)'];

    // Calculate the discounted price
    $discountedPrice = $totalPrice - ($totalPrice * $discount);

    // Update the total price in the database
    mysqli_query($con, "UPDATE book SET price = '$discountedPrice' WHERE username = '$user' AND paid = '0'");

    // Redirect back to the bookings page
    header("Location: bookings.php");
  } else {
    // Invalid coupon code, display an error message
    echo "Invalid coupon code. Please try again.";
  }
}
?>
