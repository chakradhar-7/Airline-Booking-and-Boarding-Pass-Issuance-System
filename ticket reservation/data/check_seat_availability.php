<?php
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airline2";

// Create a MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['seat'])) {
        $seat = $_POST['seat'];

        // Prepare a query to check if the seat is already booked
        $query = "SELECT * FROM booked WHERE seat_number = '$seat'";
        $result = $conn->query($query);

        if ($result) {
            if ($result->num_rows > 0) {
                // Seat is already taken
                $response = array('available' => false);
            } else {
                // Seat is available
                $response = array('available' => true);
            }
        } else {
            // Error executing the query
            $response = array('error' => 'An error occurred while checking seat availability.');
        }
    } else {
        // Seat parameter not provided
        $response = array('error' => 'Seat parameter is missing.');
    }
} else {
    // Invalid request method
    $response = array('error' => 'Invalid request method.');
}

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$conn->close();
?>
