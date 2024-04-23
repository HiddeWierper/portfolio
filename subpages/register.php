

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/portfolio/css/style.css">
  <link rel="stylesheet" href="/portfolio/css/mobileStyle.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rethink+Sans&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Afacad&display=swap" rel="stylesheet">
  <link rel="icon" href="/portfolio/img/favicon.png" type="image/x-icon">
  <script src="https://kit.fontawesome.com/c6d023de9c.js" crossorigin="anonymous"></script>
  <script src="/portfolio/script.js"></script>
  <title>Register</title>
</head>
<body class="register">
<header>
  <span class="me"><img class="me" src="/portfolio/img/me.jpeg" alt=""><h2>Hidde Wierper</h2></span>
  <span class="nav">
  <svg class="ham hamRotate ham1 hamburger " viewBox="0 0 100 100" width="80" onclick="this.classList.toggle('active');openMenu();">
  <path
        class="line top"
        d="m 30,33 h 40 c 0,0 9.044436,-0.654587 9.044436,-8.508902 0,-7.854315 -8.024349,-11.958003 -14.89975,-10.85914 -6.875401,1.098863 -13.637059,4.171617 -13.637059,16.368042 v 40" />
  <path
        class="line middle"
        d="m 30,50 h 40" />
  <path
        class="line bottom"
        d="m 30,67 h 40 c 12.796276,0 15.357889,-11.717785 15.357889,-26.851538 0,-15.133752 -4.786586,-27.274118 -16.667516,-27.274118 -11.88093,0 -18.499247,6.994427 -18.435284,17.125656 l 0.252538,40" />
</svg>

  <ul class="">
    <a href="/portfolio/index.php#home"><li>HOME</li></a>
    <a href="/portfolio/index.php#skills"><li>SKILLS</li></a>
    <a href="/portfolio/index.php#projects"><li>PROJECTS</li></a>
    <a href="/portfolio/index.php#contact"><li>CONTACT</li></a>
    <a href="/portfolio/subpages/login.php" ><li><?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : "LOGIN"; ?></li></a>
  </ul>
  </span>
</header>
<div class="projectEdit" id="registerPanel">
<form class="changePass" action="<?php echo $_SERVER['PHP_SELF'];?>" method='post'>
  <span>
    <label for="email">Email</label>
    <input required type="email" name="email" id="email">
  </span>
  <span>
    <label for="username">Username</label>
    <input required type="text" name="username" id="username">
  </span>
  <span>
    <label for="newPass">New Password</label>
    <label class="eye-toggle">
      <input type="checkbox" onclick="togglePass('newPass', 'eyeIcon2')">
      <i id="eyeIcon2" class="fa-regular fa-eye"></i>
    </label>
    <input required type="password" name="newPass" id="newPass">
  </span>
  <span>
    <label for="confirmPass">Confirm Password</label>
    <label class="eye-toggle">
      <input type="checkbox" onclick="togglePass('confirmPass', 'eyeIcon3')">
      <i id="eyeIcon3" class="fa-regular fa-eye"></i>
    </label>
    <input required type="password" name="confirmPass" id="confirmPass">
  </span>
  <span>
    <label for="authCode">Auth Code </label>
    <input required type="text" name="authCode" id="authCode">
  </span>
 
  <span>
    <input onclick="showLoader()" class="submitChangePass" type="submit" name="register" value="Register">          
  </span>
</form>
</div>
  
</body>
</html>
<?php
session_start();

include_once 'connection.php';

$postEmail = $_POST['email']; // The email entered by the user
$sessionEmail = $_SESSION['email']; // The email stored in the session

// Check if the POST email is the same as the session email
try {
  $dbh = new PDO('mysql:host=' . $hostname . ';dbname=' . $database . ';port=' . $port, $username, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if ($_SERVER["REQUEST_METHOD"] == "POST") {



    // Check if the entered auth code matches the stored auth code
    if(isset($_POST['register'])){
      sleep(1);

    $enteredAuthCode = $_POST['authCode'];
      if ($enteredAuthCode == $_SESSION['authCode']) {

        $checkSql =  "SELECT * FROM inlog AS a
        INNER JOIN gast AS g ON a.email = g.email
        WHERE a.email = ?";
        $checkStmt = $dbh->prepare($checkSql);
        $checkStmt->bindParam(1, $sessionEmail, PDO::PARAM_STR);
        $checkStmt->execute();
        $row = $checkStmt->fetch(PDO::FETCH_ASSOC);
        if ($checkStmt->rowCount() > 0) {
          // No rows with the session email
          echo "<div id='warning'>
            <h1>Already account registerd with this Email!<br>
            </h1>
            <input type='button' value='Close' onclick='hideWarning();'>
          </div>";
        }
        
        $newPass = $_POST['newPass'];
        $confirmPass = $_POST['confirmPass'];
        $username = $_POST['username'];
        $postEmail = $_POST['email']; 
        $currentPassword = $row['password'];
      

        $usernameCheckSql = "SELECT * FROM inlog AS a
        INNER JOIN gast AS g ON a.username = g.email
        WHERE a.email = ?";
        $usernameCheckStmt = $dbh->prepare($usernameCheckSql);
        $usernameCheckStmt->bindParam(1, $username, PDO::PARAM_STR);
        $usernameCheckStmt->execute();
        
        if ($usernameCheckStmt->rowCount() > 0) {
          // Username already exists
          echo "<div id='warning'>
            <h1>Username already taken!<br>
            </h1>
            <input type='button' value='Close' onclick='hideWarning();'>
          </div>";
        } 
    
        if ($newPass === $confirmPass && $checkStmt->rowCount() == 0) {
          $updateSql = "INSERT INTO gast SET password = ?, username = ?, email = ?";
          $updateStmt = $dbh->prepare($updateSql);
          $updateStmt->bindParam(1, $newPass, PDO::PARAM_STR);
          $updateStmt->bindParam(2, $username, PDO::PARAM_STR);
          $updateStmt->bindParam(3, $sessionEmail, PDO::PARAM_STR); 
           // Bind de nieuwe e-mail aan de query// Dit moet 3 zijn, niet 2
          
          $updateStmt->execute();

          echo "<div id='warning'>
            <h1>Welcome to our website!<br>
            </h1>
            <input type='button' value='Close' onclick='hideWarning(); redirect();'>
          </div>";

          $toEmail = $postEmail;
          $emailSubject = "Welcome!";
          $headers = "Reply-To: $toEmail\r\n";
          $headers .= "Content-type: text/html; charset=utf-8\r\n"; 
          $emailMessage = '<!DOCTYPE html>
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
                  <h1>Welcome!</h1>
                  <p>We extend a warm welcome to you on our website.</p>
                  <a href="https://localhost/portfolio/admin.php">change password</a>
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
          
          </html>';
          mail($toEmail, $emailSubject, $emailMessage, $headers);
          
        } 
        if ($newPass !== $confirmPass) {
          echo "<div id='warning'>
            <h1>Passwords do not match!<br>
            // </h1>
            <input type='button' value='Close' onclick='hideWarning();'>
          </div>";
        }
      }
      if ($enteredAuthCode != $_SESSION['authCode']) {
        echo "<div id='warning'>
                <h1>Wrong Auth Code!<br>
                </h1>
                <input type='button' value='Close' onclick='hideWarning();'>
              </div>";
      }
    } 
  }
} catch (PDOException $e) {
  echo "something went wrong  : " . $e->getMessage() . "<br><br>";
}


?>