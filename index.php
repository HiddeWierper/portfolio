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
<body>
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
    <input type="button" value="𝗣𝗿𝗼𝗷𝗲𝗰𝘁𝘀" onclick="goToElement('projects')">
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

  <section class="project"> 
    <div class="imgContainer">
      <img id="switchWeform" onclick="switchImage('switchWeform')" src="img/weform-pc.png" alt="weformconsultancy">
    </div>
    <div class="project-info">
      <h2><a href="https://github.com/HiddeW2007/weform-master" target="_blank" class="fa-brands fa-github gitIcon"></a>WeFormConsultancy</h2>
      <p>Creating a website for my manager, though not purchased, became a pivotal learning curve in HTML and CSS. Despite the project not leading to a sale, the process honed my web development skills, providing hands-on experience and confidence for future endeavors in the dynamic digital landscape.</p>
      <ul>
        <li><abbr title="Hypertext Markup Language">HTML</abbr></li>
        <li><abbr title="Cascading Style Sheet">CSS</abbr></li>
        <li>Javascript</li>
      </ul>
      <a style="color: #7843e9" href="https://onzin12345.online" target="_blank">Visit website</a>
  </section>
  <hr>
  <section class="project">
    <div class="imgContainer">
      <img id="switchKat" onclick="switchImage('switchKat')" style="-webkit-transform: scaleX(-1); transform: scaleX(-1);" src="img/kat-pc.png" alt="">
    </div>
    <div class="project-info">
      <h2><a href="https://github.com/HiddeWierper/htmlroc" target="_blank" class="fa-brands fa-github gitIcon"></a>Cat Site</h2>
      <p>I've crafted a captivating cat website for my final project using HTML and CSS. This feline haven features charming cat profiles, insightful articles on cat care, and a playful design. Dive into a world of whiskers and purrs as you explore the diverse and delightful content on this unique cat-centric website.</p>
      <ul>
        <li><abbr title="Hypertext Preprocessor">PHP</abbr></li>
        <li><abbr title="Cascading Style Sheet">CSS</abbr></li>
        <li>Javascript</li>
      </ul>
      <a style="color: #7843e9; padding: 0;" href="https://katschool.netlify.app/" target="_blank">Visit website</a>
  </section>
<hr>
  <section class="project">
    <div class="imgContainer">
      <img id="no-escape" src="img/no-escape-pc.png" alt="">
    </div>    
    <div class="project-info">
      <h2><a href="https://github.com/nhuijser/no-escape" target="_blank" class="fa-brands fa-github gitIcon"></a>No-Escape</h2>
      <p>Embark on a terror-filled journey within our horror game, a result of a gripping game jam with friends. Confront hair-raising mazes, engage in heart-pounding race challenges, survive the ominous Chrome Dino game, and test your wits with a bone-chilling quiz. This collaborative creation promises a diverse blend of fear-inducing gameplay, showcasing our shared passion for horror and game development.</p>
      <ul>
        <li><abbr title="Hypertext Preprocessor">PHP</abbr></li>
        <li><abbr title="Cascading Style Sheet">CSS</abbr></li>
        <li>Javascript</li>
      </ul>
      <a style="color: #7843e9" href="http://localhost/no-escape" target="_blank">Visit website</a>
  </section>
</div>  

<script src="https://kit.fontawesome.com/c6d023de9c.js" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>

<?php
    // $dbname = "portfolio";

    // $conn = new mysqli($servername, $username, $password, $dbname);

    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }

    // ?>