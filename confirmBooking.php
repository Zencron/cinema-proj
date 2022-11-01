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
$fullName = $_GET['fullName'];
$cardNumber = $_GET['cardNumber'];
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

$sql = "INSERT INTO bookings (movieId, fullName, cinema, timeslot, seats, cardNumber)
VALUES ('{$movieId}', '{$fullName}', '{$selectCinema}', '{$selectTimeslot}', '{$selectQty}','{$cardNumber}')";
$result = $conn->query($sql);

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
          <div class="movieTitle">Booking Confirmed</div>
          <div>
            Thank you for making a booking with Cinema Proj!
            <br />
            Please take a screenshot of your receipt.
          </div>
          <div>
            <div class="movieSubtitle">Name</div>
            <div class="movieDescription"><?php echo $fullName?></div>
            <div class="movieSubtitle">Number of Seats</div>
            <div class="movieDescription"><?php echo $selectQty?></div>
            <div class="movieSubtitle">Movie</div>
            <div class="movieDescription"><?php echo $movieName?></div>
            <div class="movieSubtitle">Cinema</div>
            <div class="movieDescription"><?php echo $selectCinema?></div>
            <div class="movieSubtitle">Timeslot</div>
            <div class="movieDescription"><?php echo $selectTimeslot?></div>
          </div>
          <a class="makeBookingButton" href="index.php">Return to Home</a>
        </div>
      </div>
    </div>
  </body>
</html>
