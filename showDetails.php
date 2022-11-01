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

$sql = "SELECT id , name , synopsis , runtime FROM movies WHERE id = ${movieId}";
$result = $conn->query($sql);



$movieId = "1";
$movieName = "Prey For The Devil";
$synopsis = "Sister Ann (Jacqueline Byers) believes she is answering a calling
to be the first female exorcist… but who, or what, called her? In
response to a global rise in demonic possessions, Ann seeks out a
place at an exorcism school reopened by the Catholic Church.";
$runtime = "112";


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
    <link rel="stylesheet" href="showDetails.css" />
    <meta charset="utf-8" />
  </head>
  <body class="backgroundColour">
    <div class="mainGrid">
      <div class="header">
        <a href="index.php">Cinema Proj</a>
      </div>
      <div class="content">
        <div class="detailsCard">
          <div class="movieTitle"><?php echo $movieName?></div>
          <?php echo "<img src=\"${movieName}.webp\" width=\"150\" />";?>
          <div>
            <div class="movieSubtitle">Runtime</div>
            <div class="movieDescription"><?php echo $runtime?> minutes</div>
            <div class="movieSubtitle">Synopsis</div>
            <div class="movieDescription">
                <?php echo $synopsis?>
            </div>
          </div>
          <form class="movieForm" method="get" action="makeBooking.php">
            <?php echo "<input name=\"movieId\" value=\"${movieId}\" class=\"hiddenInput\" />";?>
            <br />
            <div>
              <div class="movieSubtitle">Select Cinema</div>
              <label>
                <input
                  type="radio"
                  id="Jurong"
                  name="selectCinema"
                  value="Jurong"
                  required
                />
                Jurong
              </label>
              <label>
                <input
                  type="radio"
                  id="Sentosa"
                  name="selectCinema"
                  value="Sentosa"
                  required
                />
                Sentosa
              </label>
              <label>
                <input
                  type="radio"
                  id="Changi"
                  name="selectCinema"
                  value="Changi"
                  required
                />
                Changi
              </label>
              <label>
                <input
                  type="radio"
                  id="Bishan"
                  name="selectCinema"
                  value="Bishan"
                  required
                />
                Bishan
              </label>
              <br />
              <br />
              <div class="movieSubtitle">Select Timeslot</div>
              <label>
                <input
                  type="radio"
                  id="11am"
                  name="selectTimeslot"
                  value="11am"
                  required
                />
                11am
              </label>
              <label>
                <input
                  type="radio"
                  id="1pm"
                  name="selectTimeslot"
                  value="1pm"
                  required
                />
                1pm
              </label>
              <label>
                <input
                  type="radio"
                  id="3pm"
                  name="selectTimeslot"
                  value="3pm"
                  required
                />
                3pm
              </label>
              <label>
                <input
                  type="radio"
                  id="5pm"
                  name="selectTimeslot"
                  value="5pm"
                  required
                />
                5pm
              </label>
              <br />
              <br />
              <div class="movieSubtitle">Select Number of Seats</div>
              <input
                type="number"
                name="selectQty"
                required
                min="1"
                oninput="this.value = Math.abs(this.value)"
              />
              <br />
              <br />
              <input
                class="makeBookingButton"
                type="submit"
                value="Make Booking"
              />
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
