<?php
 
if($_SERVER['SERVER_NAME'] == 'localhost') {
  $host = 'localhost';
  $pass = 'root';
  $user = 'root';
}else if($_SERVER['SERVER_NAME'] == 'thuis.wierper.net') {
  $host = 'thuis.wierper.net';
  $pass = 'NOescape!';
  $user = 'gamer';
  
}
    $port = 3306;
    $db = 'portfolio';
try {
    $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $db . ';port=' . $port, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

} catch(PDOException $e) {
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
  // Maak verbinding met de database

  $dbname = "portfolio";

  if($_SERVER['SERVER_NAME'] == 'localhost') {
    $servername = 'localhost';
    $password = 'root';
    $username = 'root';
  }else if($_SERVER['SERVER_NAME'] == 'thuis.wierper.net') {
    $hostname = 'thuis.wierper.net';
    $password = 'Wierper1411';
    $username = 'root';
  }

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

  <section class="project 1 "> 
    <div class="imgContainer">
      <img id="switchWeform" onclick="switchImage('switchWeform')" src='<?php echo"$weformImgDir"?>' alt="weformconsultancy">
    </div>
    <div class="project-info odd">
      <h2><a href="<?php echo"$weformLink" ?>" target="_blank" class="fa-brands fa-github gitIcon"></a><?php echo"$weformName"?></h2>
      <p><?php echo"$weformInfo" ?></p>
      <ul>
        <?php echo"$weformLang" ?>
      </ul>
      <a style="color: #7843e9" href='<?php echo"$weformWebLink"?>' target="_blank">Visit website</a>
  </section>
  <hr>
  <section class="project 2">
    <div class="imgContainer">
      <img id="switchKat" onclick="switchImage('switchKat')" style="-webkit-transform: scaleX(-1); transform: scaleX(-1);" src='<?php echo"$catImgDir"?>' alt="">
    </div>
    <div class="project-info even">
    <h2><a href="<?php echo"$catLink" ?>" target="_blank" class="fa-brands fa-github gitIcon"></a><?php echo"$catName"?></h2>
      <p><?php echo"$catInfo" ?></p>
      <ul>
        <?php echo"$catLang" ?>
      </ul>
      <a style="color: #7843e9" href='<?php echo"$catWebLink"?>' target="_blank">Visit website</a>
  </section>
<hr>
  <section class="project 1">
    <div class="imgContainer">
      <img id="no-escape" src="<?php echo"$noEscapeImgDir"?>" alt="">
    </div>    
    <div class="project-info odd">
      <h2><a href="<?php echo"$noEscapeLink" ?>" target="_blank" class="fa-brands fa-github gitIcon"></a><?php echo"$noEscapeName"?></h2>
      <p><?php echo"$noEscapeInfo" ?></p>
      <ul>
        <?php echo"$noEscapeLang" ?>
      </ul>
      <a style="color: #7843e9" href='<?php echo"$noEscapeWebLink"?>' target="_blank">Visit website</a>
  </section>
</div>  

<script src="https://kit.fontawesome.com/c6d023de9c.js" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>

