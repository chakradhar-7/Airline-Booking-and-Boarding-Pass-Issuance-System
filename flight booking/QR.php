<!DOCTYPE html>
<html>
<head>
  <title>Boarding Pass Generator</title>
  <head>
	<title>Airship</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="https://lh3.googleusercontent.com/-HtZivmahJYI/VUZKoVuFx3I/AAAAAAAAAcM/thmMtUUPjbA/Blue_square_A-3.PNG" />
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="forcompany.css">
	<link rel="stylesheet" href="AdminSignin.css">
	<script  src="jquery-1.9.1.min.js"></script>
	<script src="Admin.js"></script>
	
</head>
  <style>
    body {
      background-color: #F2F5F8;
      font-family: Arial, sans-serif;
    }
    
    h1 {
      text-align: center;
      color: #333;
      margin-top: 50px;
    }
    
    form {
      width: 400px;
      margin: 50px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
    
    label {
      display: block;
      margin-bottom: 10px;
      color: #333;
      font-weight: bold;
    }
    
    input[type="text"] {
      width: 100%;
      padding: 8px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    
    button[type="submit"] {
      display: block;
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #333;
      color: #fff;
      border: none;
      font-size: 16px;
      font-weight: bold;
      border-radius: 4px;
      cursor: pointer;
    }
    
    button[type="submit"]:hover {
      background-color: #555;
    }
    
    .boarding-pass {
      width: 400px;
      margin: 50px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
    
    .boarding-pass h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }
    
    .boarding-pass p {
      margin-bottom: 10px;
      color: #333;
    }
    
    .boarding-pass img {
      display: block;
      margin: 20px auto;
      max-width: 100%;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
   





  </style>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="homepage.html"><span class="glyphicon glyphicon-home"></span> Home</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				
				<ul class="nav navbar-nav navbar-right">
					<li id = "cart">
						<a class="navbar-brand" href="QR.php"><span class="glyphicon glyphicon-shopping-cart"></span> Boarding</a>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="homepage.html"><span class="glyphicon glyphicon-user"> Sign out&nbsp;</span>						</a>
						
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="jumbotron text-center">
		<h1>Airship</h1> 
		<p>If you never go you will never know!</p> 
	</div>
  <h1>Boarding Pass Generator</h1>
  <form method="POST">
    <label for="book_id">Booking ID:</label>
    <input type="text" id="book_id" name="book_id" placeholder="Enter booking ID">
    <button type="submit">Generate Boarding Pass</button>
  </form>
  
  <?php

// Include the QR code library
include "phpqrcode/qrlib.php";

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airline2";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if book_tracker is set
if (isset($_POST['book_id'])) {
  // Get the passenger information from the database using the book_id passed through the form submission
  $book_id = $_POST['book_id'];
  $sql = "SELECT booked.book_id, booked.book_name, booked.book_departure, booked.seat_number, booked.book_tracker, origin.origin_desc AS origin_desc, destination.dest_destination AS dest_destination FROM booked INNER JOIN origin ON booked.origin_id = origin.origin_id INNER JOIN destination ON booked.dest_id = destination.dest_id WHERE booked.book_id = $book_id";
  $result = mysqli_query($conn, $sql);
  
  // Check if the query execution succeeded
  if ($result !== false && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Generate the QR code
    $qr_text = "Passenger Name: " . $row['book_name'] . "\nDeparture Date: " . $row['book_departure'] . "\nSeat Number: " . $row['seat_number'] . "\nPNR Number: " . $row['book_tracker'] . "\nOrigin: " . $row['origin_desc'] . "\nDestination: " . $row['dest_destination'];

    // Create the directory if it doesn't exist
    if (!is_dir('qr_codes')) {
      mkdir('qr_codes');
    }

    $filename = "qr_codes/" . $row['book_id'] . ".png";

    // Generate the QR code image
    QRcode::png($qr_text, $filename, QR_ECLEVEL_L, 6, 2);

    // Generate the boarding pass HTML
    $boarding_pass = "
    <div class='boarding-pass'>
      <h2>Boarding Pass</h2>
      <p><strong>Passenger Name:</strong> " . $row['book_name'] . "</p>
      <p><strong>Departure Date:</strong> " . $row['book_departure'] . "</p>
      <p><strong>Seat Number:</strong> " . $row['seat_number'] . "</p>
      <p><strong>PNR Number:</strong> " . $row['book_tracker'] . "</p>
      <p><strong>Origin:</strong> " . $row['origin_desc'] . "</p>
      <p><strong>Destination:</strong> " . $row['dest_destination'] . "</p>
      <img src='" . $filename . "' alt='QR Code'>
      <form method='POST'>
        <input type='hidden' name='book_id' value='" . $row['book_id'] . "'>
        <button type='submit' name='status' value='rejected' class='btn-reject' >Reject</button>
        <button type='submit' name='status' value='boarded' class='btn-board'>Board</button>
      </form>
    </div>
    ";

    echo $boarding_pass;

  } else {
    echo "Invalid booking ID.";
  }
}

// ...

if (isset($_POST['status'])) {
  $status = $_POST['status'];
  $book_id = $_POST['book_id'];

  // Check if boarding has been done
  $checkQuery = "SELECT status FROM boarding WHERE book_id = ?";
  $checkStmt = $conn->prepare($checkQuery);
  $checkStmt->bind_param("i", $book_id);
  $checkStmt->execute();
  $checkResult = $checkStmt->get_result();
  $row = $checkResult->fetch_assoc();

  if ($checkResult->num_rows == 0 || $row['status'] !== 'boarded') {
    // Update the status in the boarding table
    $updateQuery = "INSERT INTO boarding (book_id, status) VALUES (?, ?) ON DUPLICATE KEY UPDATE status = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("iss", $book_id, $status, $status);

    if ($updateStmt->execute()) {
      echo "<script>
                alert('Status updated successfully');
                window.location.href = 'QR.php';
              </script>";
    } else {
      echo "Error updating status: " . $updateStmt->error;
    }

    // Close the statement
    $updateStmt->close();
  } else {
    echo "<script>
                alert('Fraud alert: Boarding has already been done for this booking.');
                window.location.href = 'QR.php';
              </script>";
  }

  // Close the statement
  $checkStmt->close();
}

// Close the database connection
mysqli_close($conn);
?>

<?php
// ...


// ...
?>
<script>
  function displayMessage(message) {
    alert(message);
  }
</script>

  
  
</body>
</html>