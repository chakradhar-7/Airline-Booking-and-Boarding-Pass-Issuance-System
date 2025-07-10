<?php
session_start();
if (isset($_POST['submi'])) {
    include_once 'dbconnect2.php';

    // Retrieve the form data
    $coupon = $_POST['coupon'];

    // Check if the coupon is 'NEW' and if the user is eligible to use it
    if ($coupon == 'summer') {
      echo "<script>
      alert('Coupon applied');
      window.location.href = 'cartshow.php';
  </script>";
  $disc = 25;
  $_SESSION['disc'] = $disc;
    } elseif ($coupon == 'FESTIVAL') {
        // Apply the 'FESTIVAL' coupon and set the discount
        echo "<script>
            alert('Coupon applied');
            window.location.href = 'cartshow.php';
        </script>";
        $disc = 50;
        $_SESSION['disc'] = $disc;
    } else{
      echo "<script>
            alert('Invalid coupon');
            window.location.href = 'cartshow.php';
        </script>";
    }
}

// Make sure 'disc' key is set in the session
if (!isset($_SESSION['disc'])) {
    $_SESSION['disc'] = 0;
}
?>



