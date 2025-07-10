


<!DOCTYPE html>
<html>
<head>
	<title>Booking Details</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
		}
		h2 {
			text-align: center;
			color: #003366;
			margin-top: 30px;
			margin-bottom: 20px;
		}
		table {
			border-collapse: collapse;
			margin: auto;
			width: 80%;
			background-color: white;
			box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
			text-align: center;
		}
		th {
			background-color: #003366;
			color: white;
			font-size: 18px;
			padding: 10px;
		}
		tr:nth-child(even) {
			background-color: #f2f2f2
		}
		td {
			font-size: 16px;
			padding: 10px;
		}
		input[type=text] {
			width: 20%;
			padding: 12px 20px;
			margin: 8px 0;
			box-sizing: border-box;
			border: 2px solid #ccc;
			border-radius: 4px;
			font-size: 16px;
			background-color: #f2f2f2;
		}
		input[type=submit] {
			background-color: #003366;
			color: white;
			padding: 12px 20px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			font-size: 18px;
			float: right;
			margin-right: 10%;
			margin-top: 8px;
		}
		input[type=submit]:hover {
			background-color: #002147;
		}
	</style>
</head>
<body>
	<h2>Booking Details</h2>
	<form method="POST">
		<label for="book_tracker">Enter Booking ID:</label>
		<input type="text" id="book_tracker" name="book_tracker">
		<input type="submit" value="Submit">
	</form>
	<br>
	<?php
		if(isset($_POST['book_tracker'])) {
			$book_tracker = $_POST['book_tracker'];
			$conn = mysqli_connect("localhost", "root", "", "medallion");
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			$sql = "SELECT * FROM booked WHERE book_tracker='$book_tracker'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				echo "<table>";
				echo "<tr><th>PNR</th><th>Book ID</th><th>Booked By</th><th>Contact</th><th>Address</th><th>Name</th><th>Age</th><th>Gender</th><th>Departure Date</th><th>Dest_ID</th><th>Acc_ID</th><th>Origin_ID</th><th>Seat Number</th><th>";
				while($row = $result->fetch_assoc()) {
					echo "<tr><td>" . $row["book_tracker"]. "</td><td>" . $row["book_id"] . "</td><td>" . $row["book_by"] . "</td><td>" . $row["book_contact"] . "</td><td>" . $row["book_address"] . "</td><td>" . $row["book_name"] . "</td><td>" . $row["book_age"] . "</td><td>" . $row["book_gender"] . "</td><td>" . $row["book_departure"] . "</td><td>" . $row["dest_id"] . "</td><td>" . $row["acc_id"] . "</td><td>" . $row["origin_id"] . "</td><td>" . $row["seat_number"] . "</td><td>";
				}
				echo "</table>";
			}
			else {
				echo "0 results";
			}
			$conn->close();
		}
		?>
	</table>
</body>
</html>
