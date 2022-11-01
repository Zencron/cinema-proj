<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "cinema";

// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$movieId = $_GET['movieId'];
$selectCinema = $_GET['selectCinema'];
$selectTimeslot = $_GET['selectTimeslot'];
$selectQty = $_GET['selectQty'];
$movieName = "Prey For The Devil";
$synopsis = "Sister Ann (Jacqueline Byers) believes she is answering a calling
to be the first female exorcist… but who, or what, called her? In
response to a global rise in demonic possessions, Ann seeks out a
place at an exorcism school reopened by the Catholic Church.";
$runtime = "112";

$sql = "SELECT id , name , synopsis , runtime FROM movies WHERE id = ${movieId}";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $movieId = $row['id'];
        $movieName = $row['name'];
        $synopsis = $row['synopsis'];
        $runtime = $row['runtime'];
    }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Cinema Proj</title>
    <link rel="stylesheet" href="global.css" />
    <link rel="stylesheet" href="makeBooking.css" />
    <meta charset="utf-8" />
  </head>
  <body class="backgroundColour">
    <div class="mainGrid">
      <div class="header">
        <a href="index.php">Cinema Proj</a>
      </div>
      <div class="content">
        <div class="detailsCard">
          <div class="movieTitle">Make Booking</div>
          <div>
            Please check the details below and enter your payment information to
            complete your booking
          </div>
          <div>
            <div class="movieSubtitle">Movie</div>
            <div class="movieDescription"><?php echo $movieName?></div>
            <div class="movieSubtitle">Cinema</div>
            <div class="movieDescription"><?php echo $selectCinema?></div>
            <div class="movieSubtitle">Timeslot</div>
            <div class="movieDescription"><?php echo $selectTimeslot?></div>
            <div class="movieSubtitle">Number of Seats</div>
            <div class="movieDescription"><?php echo $selectQty?></div>
          </div>
          <form class="movieForm" method="get" action="confirmBooking.php">
            <div class="movieTitle">Payment Info</div>
            <?php echo "<input name=\"movieId\" value=\"${movieId}\" class=\"hiddenInput\" />";?>
            <?php echo "<input name=\"selectCinema\" value=\"${selectCinema}\" class=\"hiddenInput\" />";?>
            <?php echo "<input name=\"selectTimeslot\" value=\"${selectTimeslot}\" class=\"hiddenInput\" />";?>
            <?php echo "<input name=\"selectQty\" value=\"${selectQty}\" class=\"hiddenInput\" />";?>
            <div>
              <div class="movieSubtitle">Full Name</div>
              <input type="text" id="fullName" name="fullName" required />
              <br />
              <div class="movieSubtitle">Card Number</div>
              <input type="text" id="cardNumber" name="cardNumber" required />
              <br />
              <br />
              <input
                class="makeBookingButton"
                type="submit"
                value="Complete Payment"
              />
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
