<?php
// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "airline2");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Update user details
if (isset($_POST["update"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $birthday = $_POST["birthday"];
    $cellphone = $_POST["cellphone"];

    $sql = "UPDATE passanger SET username='$username', firstname='$firstname', lastname='$lastname', password='$password', email='$email', gender='$gender', birthday='$birthday', cellphone='$cellphone' WHERE username='$username'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('User details updated successfully!');
                window.location.href = 'userupdate.php';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('Error updating user details:');
                window.location.href = 'userupdate.php';
              </script>";
        exit;
    }
}

// Retrieve user details
if (isset($_GET["username"])) {
    $username = $_GET["username"];
    $sql = "SELECT * FROM passanger WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "No user found with the given username!";
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update details</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="https://lh3.googleusercontent.com/-HtZivmahJYI/VUZKoVuFx3I/AAAAAAAAAcM/thmMtUUPjbA/Blue_square_A-3.PNG" />
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="forcompany.css">
	<link rel="stylesheet" href="AdminSignin.css">
	<script  src="jquery-1.9.1.min.js"></script>
	<script src="Admin.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
        }
        label {
            display: inline-block;
            width: 120px;
            text-align: right;
            margin-right: 10px;
        }
        input[type=text], input[type=email], input[type=tel], select {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            width: 100%;
            margin-bottom: 10px;
        }
        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }
        input[type=submit]:hover {
            background-color: #45a049;
        }
        .container3 {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            margin-top: 10px;
            max-height: 750px;
            max-width: 500px;
            margin-bottom: 100px;
            margin-left: auto;
            margin-right: auto;
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
    <div class="container3">
        <h2>Update User Details</h2>
        <?php if (isset($user)) { ?>
            <form method="post">
                <label for="username">User Name:</label>
                <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>"><br>
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>"><br>
                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>"><br>
                <label for="password">Password</label>
                <input type="text" placeholder="No special characters, at least one letter, one capital letter, one number" id="password" name="password" value="<?php echo $user['password']; ?>"><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>"><br>
                <label for="gender">Gender:</label>
                <select id="gender" name="gender">
                    <option value="male" <?php if ($user['gender'] == 'male') echo 'selected'; ?>>Male</option>
                    <option value="female" <?php if ($user['gender'] == 'female') echo 'selected'; ?>>Female</option>
                    <option value="other" <?php if ($user['gender'] == 'other') echo 'selected'; ?>>Other</option>
                </select><br>
                <label for="birthday">Date of Birth:</label>
                <input type="date" id="birthday" name="birthday" value="<?php echo $user['birthday']; ?>"><br>
                <label for="cellphone">Phone Number:</label>
                <input type="tel" id="cellphone" name="cellphone" value="<?php echo $user['cellphone']; ?>"><br>
                <input type="submit" name="update" value="Update">
                
            </form>
        <?php } else { ?>
            <form method="get">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username"><br>
                <input type="submit" name="submit" value="Find User">
                <br>
                <br>
                
            </form>
        <?php } ?>
    </div>
</body>
</html>
