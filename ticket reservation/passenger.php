<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start session if session not started
}

if (isset($_SESSION['accomodation'])) {
?>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Airship</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.min.css">

</head>
<body style="background-color: lightblue;">

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Airship</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active">
                <a href="#">Booking
                    <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
                </a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php"><span class="glyphicon glyphicon-backward"></span> Back To Home</a></li>
        </ul>
    </div>
</nav>


<div class="container-fluid">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">STEPS FOR BOOKING</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">1. ITINERARY
                                </h3>
                            </div>
                            <div class="panel-body">
                                SCHEDULE OF TRAVEL
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">2. CLASS
                                </h3>
                            </div>
                            <div class="panel-body">
                                CLASS TYPE
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">3. PASSENGER INFO
                                    <span class="glyphicon glyphicon-saved" aria-hidden="true"></span>
                                </h3>
                            </div>
                            <div class="panel-body">
                                PASSENGER DETAILS
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <h3 class="panel-title">4. PAYMENT INFO</h3>
                            </div>
                            <div class="panel-body">
                                TOTAL PAYMENT
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>

<div class="container-fluid">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Message!</strong> Please review your passenger information. You cannot change your reservation once you proceed.
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <h2>
                    <center>PASSENGER INFO</center>
                </h2>
                <div class="container-fluid">
                    <form class="form-horizontal" role="form" id="form-pass">
                        <div class="form-group">
                            <label for="">Booked By:</label>
                            <input type="text" pattern="[A-Za-z]+" class="form-control" id="book-by" placeholder="Enter Name" autofocus="" required="" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="">Contact:</label>
                            <input type="text" pattern="\d{6,10}" class="form-control" id="cont" placeholder="Enter Contact" required="" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="">Address:</label>
                            <input type="text" class="form-control" id="address" placeholder="Enter Address" required="" autocomplete="off">
                        </div>
                        <br />
                        <?php
                        $tb = $_SESSION['totalPass'];
                        $count = 1;
                        for ($i = 0; $i < $tb; $i++) {
                            ?>
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Passenger <?= $count; ?>:</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="container-fluid">
                                        <div class="form-group">
                                            <label for="">Full Name <?= $count; ?>:</label>
                                            <input type="text" pattern="[A-Z a-z]+" class="form-control" id="fN<?php echo $i; ?>" placeholder="Enter Fullname" required autocomplete="off">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Age: <?= $count; ?>:</label>
                                            <input type="number" min="10" max="100" class="form-control" id="age<?php echo $i; ?>" placeholder="Enter Age" required autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Gender: </label>
                                            <select class="btn btn-default" id="gender<?php echo $i; ?>">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $count++;
                        }//end for
                        ?>
						<a href="layout.html" target="_blank" class="btn btn-success" style="margin:5px;"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span> LAYOUT</a>
                        <?php
                        $tb = $_SESSION['totalPass'];
                        $count = 1;
                        for ($i = 0; $i < $tb; $i++) {
                            ?>
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Passenger <?= $count; ?>:</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="container-fluid">
                                       
                                        <div class="form-group">
                            <label for="">Seat Number:<?= $count; ?></label>
                            <input type="text" class="form-control" id="seat"<?php echo $i; ?> placeholder="Enter Seat Number" min="1" max="44" required autocomplete="off">
                           
                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $count++;
                        }//end for
                        ?>   


                        <button type="submit" class="btn btn-success" style="margin:5px;">NEXT
                            <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
                        </button>
                        <span id="seat-availability"></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>

<?php require_once('admin/modal/message.php'); ?>

<script type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

<script type="text/javascript">

    $(document).on('submit', '#form-pass', function (event) {
        event.preventDefault();
        /* Act on the event */
        var bookBy = $('#book-by').val();
        var cont = $('#cont').val();
        var address = $('#address').val();
        var seat = $('#seat').val();

        var counter = <?= $i; ?>;
        for (var i = 0; i < counter; i++) {
            var fN = $('#fN' + i).val();
            var age = $('#age' + i).val();
            var gender = $('#gender' + i).val();
            $.ajax({
                url: 'data/save_booked.php',
                type: 'post',
                dataType: 'json',
                data: {
                    bookBy: bookBy,
                    cont: cont,
                    address: address,
                    fN: fN,
                    age: age,
                    gender: gender,
                    seat: seat
                },
                success: function (data) {
                    // console.log(data);
                    if (data.valid == true) {
                        window.location = data.url;
                    }
                },
                error: function () {
                    // alert('Error: L192+');
                }
            });
        }//end for
        alert('Ticket Booked Successfully!');
        alert('Redirecting to Confirmation');
    });

    // Check seat availability
    $(document).on('keyup', '#seat', function () {
            var seat = $(this).val();
            if (seat !== '') {
                if (seat >= 1 && seat <= 50) {
                    $.ajax({
                        url: 'data/check_seat_availability.php',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            seat: seat
                        },
                        success: function (data) {
                            if (data.available) {
                                $('#seat-availability').html('<span class="text-success" >Seat is available</span>');
                            } else {
                                $('#seat-availability').html('<span class="text-danger">Seat is already taken</span>');
                            }
                        },
                        error: function () {
                            $('#seat-availability').html('');
                        }
                    });
                } else {
                    $('#seat-availability').html('<span class="text-danger">Seat number must be between 1 and 44</span>');
                }
            } else {
                $('#seat-availability').html('');
            }
        });

</script>

</body>
</html>

<?php
} else {
    echo '<strong>';
    echo 'Page Not Exist';
    echo '</strong>';
}//end if else isset
?>