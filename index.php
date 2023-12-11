<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rethink+Sans&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link rel="icon" href="img/favicon.png" type="image/x-icon">
  
</head>
<body>
<?php include 'php/header.php'; ?>

<div class="socials">
  <a href="https://github.com/HiddeWierper" class="fa-brands fa-github"></a>
  <a href="https://twitter.com/Hidde_Wierper" class="fa-brands fa-twitter"></a>
  <a href="https://instagram.com/hiddewierper" class="fa-brands fa-instagram"></a>
  <a href="https://open.spotify.com/user/213ang5atptpcmibq5zug3w4q?si=c9ce2137287e4ebb" class="fa-brands fa-spotify"></a>
</div>

<div class="greetings">
  <h1 class="text">𝗛𝗜, 𝗜'𝗠 <strong>𝗛𝗜𝗗𝗗𝗘 𝗪𝗜𝗘𝗥𝗣𝗘𝗥<strong></h1>
  <p>I'm a 16 year old student from The Netherlands. 
    I am currently studying in Almere to become a software developer</p>
</div>

<div class="skills ">
  <h1>𝗠𝗬 𝗦𝗞𝗜𝗟𝗟𝗦</h1>
  <section class="all">
  <?php
  // Maak verbinding met de database
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "portfolio";

  $conn = new mysqli($servername, $username, $password, $dbname);

  // Controleer de verbinding
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Voer de query uit
  $sql = "SELECT skills_explanation FROM skills_explanation";
  $result = $conn->query($sql);

  // Verwerk en druk de resultaten af
  if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
      echo $row["skills_explanation"];
    }
  } else {
    echo "0 results";
  }
 

  echo '<section class="languages">';
  
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "portfolio";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $kolomnaam = "skill_icon";

    $sql = "SELECT skill_icon, skill_note FROM skills ORDER BY order_number";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
  
        while ($row = $result->fetch_assoc()) {
          echo '<div class="skill ' . $row['skill_note'] . '">';
          echo $row[$kolomnaam];
          echo '</div>';
      }
  } else {
      echo "Something went wrong, please try again later";  
  }
    ?>
  </section>
 </section>
</div>


<script src="https://kit.fontawesome.com/c6d023de9c.js" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>