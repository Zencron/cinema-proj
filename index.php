<?php

set_error_handler(function(int $errno, string $errstr) {
    if ((strpos($errstr, 'Undefined array key') === false) && (strpos($errstr, 'Undefined variable') === false)) {
        return false;
    } else {
        return true;
    }
}, E_WARNING);


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

$justJavaPriceUpdate = $_POST['justJavaPriceUpdate'];
$justJava = $_POST['justJava'];
$justJavaPrice = $_POST['justJavaPrice'];

$sql = "SELECT name , synopsis , runtime FROM movies";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Cinema Proj</title>
    <link rel="stylesheet" href="global.css" />
    <link rel="stylesheet" href="index.css" />
    <meta charset="utf-8" />
  </head>
  <body class="backgroundColour">
    <div class="mainGrid">
      <div class="header">
        <a href="index.php">Cinema Proj</a>
      </div>
      <div class="content">
        <?php
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $movieName = $row['name'];
                    $synopsis = $row['synopsis'];
                    $runtime = $row['runtime'];
        ?>        
        <div class="movieCard">
            <?php echo "<img src=\"${movieName}.webp\" width=\"150\" />";?>
          <div>
            <div class="movieTitle"><?php echo $movieName?></div>
            <div class="movieSubtitle">Runtime</div>
            <div class="movieDescription"><?php echo $runtime?> minutes</div>
            <div class="movieSubtitle">Synopsis</div>
            <div class="movieDescription">
                <?php echo $synopsis?>
            </div>
          </div>
          <div class="buyTicketsButtonContainer">
            <a class="buyTicketsButton" href="showDetails.html">Buy Tickets</a>
          </div>
        </div>
        <?php
            }
        }
        $conn->close();
          ?>
      </div>
    </div>
  </body>
</html>
