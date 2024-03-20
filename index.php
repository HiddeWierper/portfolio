<?php
session_start();
if($_SERVER['SERVER_NAME'] == 'localhost') {
  $hostname = 'localhost';
  $password = 'root';
  $username = 'root';
}else if($_SERVER['SERVER_NAME'] == '192.168.1.33') {
  $hostname = '192.168.1.33';
  $password = 'root';
  $username = 'root';
}
else if($_SERVER['SERVER_NAME'] == 'thuis.wierper.net') {
  $hostname = 'thuis.wierper.net';
  $password = 'root';
  $username = 'W13rp3r1411JD';
}
    $port = 3306;
    $database = 'portfolio';
try {
    $dbh = new PDO('mysql:host=' . $hostname . ';dbname=' . $database . ';port=' . $port, $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}



?>


<?php
// Start de sessie
session_start();

try {
    // Maak verbinding met de database
    $db = new PDO('mysql:host=localhost;dbname=portfolio', 'root', 'root');

    // Zet PDO error mode naar exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Bereid de SQL-query voor
    $stmt = $db->prepare("SELECT * FROM inlog WHERE username = :username");

    // Controleer of de sessievariabele bestaat
    if (!isset($_SESSION['username'])) {
        throw new Exception('Sessievariabele username is niet ingesteld');
    }

    // Bind de parameters
    $stmt->bindParam(':username', $_SESSION['username']);

    // Voer de query uit
    $stmt->execute();

    // Controleer of de gebruikersnaam bestaat in de tabel
    if ($stmt->rowCount() > 0) {
        $_SESSION['rights'] = true;
    } else {
        $_SESSION['rights'] = false;
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="icon" href="/portfolio/img/favicon.png" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hidde Wierper</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/mobileStyle.css">  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rethink+Sans&family=Roboto:wght@300&display=swap" rel="stylesheet">
  
  
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



  if($_SERVER['SERVER_NAME'] == 'localhost') {
    $hostname = 'localhost';
    $password = 'root';
    $username = 'root';
  }else if($_SERVER['SERVER_NAME'] == 'thuis.wierper.net') {
    $hostname = 'thuis.wierper.net';
    $password = 'W13rp3r1411JD';
    $username = 'root';
  }

  $conn = new mysqli($hostname, $username, $password, $database);


  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Voer de query uit
  $sql = "SELECT skills_explanation FROM skills_explanation";
  $result = $conn->query($sql);
  if($_SESSION['rights'] == true){
    echo "<div class='edit'>
    <i class='fa-solid fa-pen-to-square' onclick></i>
    </div>";
  }
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



    $conn = new mysqli($hostname, $username, $password, $database);

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
  if($_SERVER['SERVER_NAME'] == 'localhost') {
    $hostname = 'localhost';
    $password = 'root';
    $username = 'root';
  }else if($_SERVER['SERVER_NAME'] == 'thuis.wierper.net') {
    $hostname = 'thuis.wierper.net';
    $password = 'W13rp3r1411JD';
    $username = 'root';
  } 
  $port = 3306;
  $database = 'portfolio';
  

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
<?php 
$errors = [];
$errorMessage = '';

if (!empty($_POST)) {
   $name = $_POST['name'];
   $email = $_POST['email'];
   $message = $_POST['message'];
   $phone = $_POST['phone']; 
   $subject = $_POST['subject'];

   if (empty($name)) {
       $errors[] = 'Name is empty';
   }

   if (empty($email)) {
       $errors[] = 'Email is empty';
   } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $errors[] = 'Email is invalid';
   }

   if (empty($message)) {
       $errors[] = 'Message is empty';
   }$headers = "Reply-To: $email\r\n";

   if (empty($errors)) {
      
       
       $emailMessage = '
       <!DOCTYPE html>
       <html lang="en">
       <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Document</title>
         <style>
           .information{
             display: flex;
             flex-direction: column;
             width: fit-content;
             justify-content: center;
             margin: auto;
             margin-top: 5%;
           }
           label{
             font-size: 20px;
             font-weight: bold;
             
           }
       
           input, textarea{
             width: 100%;
             height: fit-content;
             margin-bottom: 10px;
             border-radius: 5px;
         
             border: 1px solid #ccc;
             padding: 2%;
            
       
           }
       
         </style>
       </head>
       <body>
         <div class="container">
           <marquee behavior="alternate" direction="right">NEW MESSAGE!</marquee>
           <div class="information">
             <label for="">Name</label>
             <input readonly type="text" value='.$name.' name="name" id="name">
             <label for="">Email</label>
             <input readonly type="email" value='.$email.' name="email" id="email">
             <label for="">Phone</label>
             <input readonly type="text" value='.$phone.' name="phone" id="phone">
             <label for="">Subject</label>
             <input readonly type="text" value='.$subject.' name="subject" id="subject">
             <label for="">Message</label>
             <textarea readonly name="message" id="message">'.$message.'</textarea>
              
           </div>
         </div>
       </body>
       </html>
       ';
       $toEmail = 'hmrwierper@gmail.com';
       $emailSubject = 'New email: ' . $subject;
       $headers = "Reply-To: $toEmail\r\n";
       $headers .= "Content-type: text/html; charset=utf-8\r\n"; 

      mail($toEmail, $emailSubject, $emailMessage, $headers);

      sleep(3);
      $headersCustomer = "From: hmrwierper@gmail.com\r\n";
      $headersCustomer .= "Content-type: text/html; charset=utf-8\r\n";
      $emailSubjectCustomer = "Confirmation";
      $messageCustomer = '
      <!DOCTYPE html>
      <html lang="nl">
      
      <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <script src="https://kit.fontawesome.com/c6d023de9c.js" crossorigin="anonymous"></script>
          <style>
              body {
                  margin: 0;
                  padding: 0;
                  height: 100%;
                  color: #7843e9;
                  text-align: center;
                  padding: 50px;
              }
              .container{
                  margin: 0;
                  padding: 0;
                  font-family: Arial, sans-serif;
                 
                  color: #7843e9;
                  text-align: center;
              
                  width: 100%;
                  height: 100%;
              }
      
              h1 {
                  color: #7843e9;
              }
      
              p {
                  color: #7843e9;
                  margin-bottom: 20px;
              }
      
              a {
                  display: inline-block;
                  padding: 10px 20px;
                  margin-top: 20px;
                  text-decoration: none;
                  color: #fff;
                  background-color: #7843e9;
                  border-radius: 5px;
              }
      
              .links{
                  position: absolute;
                  bottom: 0;
                  left: 0;
                  right: 0;
                  top: 0;
                  width: fit-content;
                  margin: auto;
                  height: fit-content;
                  margin-bottom: 5%;
                  font-size: 40px;
                  display: grid;
                  grid-template-columns: repeat(4, 1fr);
                  gap: 2rem;
                  place-self: center;
              }
              img{
                  width: 50px;
                  height: 50px;
                  margin: 0 10px;
              }
              section{
                  height: 100%;
                  width: 100%;
                  background: repeating-conic-gradient(from 30deg, rgba(0, 0, 0, 0) 0 120deg, rgba(138, 138, 138, 0.1) 0 180deg)
                          200px 115.39999999999999px,
                      repeating-conic-gradient(from 30deg, rgba(240, 240, 240, 0.1) 0 60deg, rgba(189, 189, 189, 0.1) 0 120deg,
                          rgba(138, 138, 138, 0.1) 0 180deg);
                  background-size: 400px 231px;
                  position: absolute;
                  /* display: flex;
                  justify-content: center;
                  align-items: center;
                   */
              }
              @media screen and (max-width: 600px) {
          .links {
              grid-template-columns: repeat(2, 1fr);
              grid-template-rows: repeat(2, 1fr);
          }
      }
          </style>
      </head>
      
      <body>
          <section>
      <div class="container">
              <h1>Thanks for your message!</h1>
              <p>We\'ve received your message and we will get back to you soon.</p>
              <a href="https://localhost/portfolio">Return to the website</a>
              <br>
              <div class="links">
                  <a href="https://github.com/hiddewierper" ><img src="https://i.imgur.com/w4UNd79.png" alt=""></a>
                  <a href="https://twitter.com/hidde_wierper" ><img src="https://i.imgur.com/Xa5wrMJ.png" alt=""></a>
                  <a href="https://instagram.com/hiddewierper" ><img src="https://i.imgur.com/MN2nR26.png" alt=""></a>
                  <a href="https://open.spotify.com/user/213ang5atptpcmibq5zug3w4q?si=c9ce2137287e4ebb" ><img src="https://i.imgur.com/QX1PFcW.png" alt=""></a>
              </div>
             
              
          </div>
          </section>
      </body>
      
      </html>
      
';
     

      mail($email, $emailSubjectCustomer, $messageCustomer, $headersCustomer);
       

   } else {

       $allErrors = join('<br/>', $errors);
       $errorMessage = "<p style='color: red;'>{$allErrors}</p>";
   }
}

?>

<section class="contact" id="contact">
  <div class="contactHeader">
    <h1>𝗖𝗢𝗡𝗧𝗔𝗖𝗧</h1>
    <p>Feel free to contact me if you have any questions <br> or if you want to work together.</p>
  </div>
      <form class="contactForm" name="contact" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
      <span>
        <label for="name">name</label>
        <input type="text" name="name" id="name" placeholder="John Doe" required>
      </span>
      <span>
        <label for="email">email</label>
        <input type="email" name="email" id="email" placeholder="johndoe@example.com" required>
      </span>
      <span>
        <label for="phone">phone</label>
        <input type="tel" name="phone"  inputmode="numeric"  id="phone" placeholder="+31 123456789" onfocus="addValue(this, '+')" onblur="removeValue(this, '+')" required>
      </span>
      <span>
        <label for="subject">subject</label>
        <input type="text" name="subject" id="subject" placeholder="subject" required>
      </span>
      <span>
        <label for="message">message</label>
        <textarea name="message" id="message" cols="30" rows="10" placeholder="message" required></textarea>
        </span>
        <button type="submit" name="submit" >Send</button>
      </form>
</section>


<script src="https://kit.fontawesome.com/c6d023de9c.js" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>
<?php
// Multiple recipients