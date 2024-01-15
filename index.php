  <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();


    $hostname = 'thuis.wierper.net';
    $password = 'W13rp3r1411JD';
    $username = 'root';
    $port = '3306';


echo $hostname, $username, $password;

$port = 3306;
$database = 'login';

try {
    $dbh = new PDO('mysql:host=' . $hostname . ';dbname=' . $database . ';port=' . $port, $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Rest van je code hier...

} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hidde Wierper</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rethink+Sans&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link rel="icon" href="img/favicon.png" type="image/x-icon">
  
</head>
<body id="home">
<?php include 'subpages/header.php'; ?>

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
    <input data-target="projects" type="button" value="𝗣𝗿𝗼𝗷𝗲𝗰𝘁𝘀">
</div>

<div class="skills">
  <h1>𝗠𝗬 𝗦𝗞𝗜𝗟𝗟𝗦</h1>
  <section class="all">
  <?php

  echo $hostname . " . " . $username . " . " . $password . " . " . $database . " . " . $port;
  $conn = new mysqli($hostname, $username, $password, $database, $port);

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



  $conn = new mysqli($hostname, $username, $password, $database, $port);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $kolomnaam = "skill_icon";

    $sql = "SELECT skill_icon, skill_note FROM skills ORDER BY order_number";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
  
        while ($row = $result->fetch_assoc()) {
          echo '<div id="skills" class="skill ' . $row['skill_note'] . '">';
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

<div class="projects" id="projects">
  <h1>𝗠𝗬 𝗣𝗥𝗢𝗝𝗘𝗖𝗧𝗦</h1>
  <p>Explore a comprehensive overview of my diverse portfolio,
     showcasing projects <br> developed in various programming languages.</p>
<?php
try {
 


  $port = 3306;
 
  

  $dbh = new PDO('mysql:host=' . $hostname . ';dbname=' . $database . ';port=' . $port, $username, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $dbh->prepare("SELECT * FROM projects WHERE deleted = 0 ORDER BY id;");
  $stmt->execute();

  $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($projects as $project) {
    $projectIconContent = $project['IconLink'];
    $projectNameContent = $project['projectName'];
    $projectInfoContent = $project['projectInfo'];
    $projectLangContent = $project['projectLanguages'];
    $projectWebLink = $project['projectWebsiteLink'];
    $projectImg = $project['imgDir'];
    $projectId = $project['id'];

    echo '<section id="project-' . $project['id'] . '" class="project ' . $project['id'] . '">';
    echo '<div class="imgContainer">';
    echo '<img id="switch' . $projectNameContent . '" onclick="switchImage(\'switch' . $projectNameContent . '\')"  style="' . ($project['id'] % 2 == 0 ? 'transform: scaleX(-1);' : '') . '" src="img/' . $projectImg . '" alt="">';    echo '</div>';
    echo '<div class="project-info ' . ($project['id'] % 2 == 0 ? 'even' : 'odd') . '">';
    echo '<h2><a href="' . $projectIconContent . '" target="_blank" class="fa-brands fa-github gitIcon"></a>' . $projectNameContent . '</h2>';
    echo '<p>' . $projectInfoContent . '</p>';
    echo '<ul>';
    echo  $projectLangContent;
    echo '</ul>';
    echo '<a style="color: #7843e9" href="' . $projectWebLink . '" target="_blank">Visit website</a>';
    echo '</div>';
    echo '</section>';
    echo '<hr>';
}

} catch(PDOException $e) {
  echo 'ERROR: ' . $e->getMessage();
}
?>
  
  
</div>  

<script src="https://kit.fontawesome.com/c6d023de9c.js" crossorigin="anonymous"></scrip>
<script src="script.js"></script>
</body>
</html>

