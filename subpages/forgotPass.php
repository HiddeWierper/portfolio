
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
$database = 'portfolio';
$port = '3306';

echo $_SESSION['authCode'];
$postEmail = $_POST['email']; // The email entered by the user
$sessionEmail = $_SESSION['email']; // The email stored in the session

// Check if the POST email is the same as the session email
try {
  $dbh = new PDO('mysql:host=' . $hostname . ';dbname=' . $database . ';port=' . $port, $username, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Database connection successful";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {



    // Check if the entered auth code matches the stored auth code
    if(isset($_POST['change-pass'])){
      sleep(1);

    $enteredAuthCode = $_POST['authCode'];
      if ($enteredAuthCode == $_SESSION['authCode']) {

        $checkSql = "SELECT * FROM inlog WHERE email = ?";
        $checkStmt = $dbh->prepare($checkSql);
        $checkStmt->bindParam(1, $sessionEmail, PDO::PARAM_STR);
        $checkStmt->execute();
        $row = $checkStmt->fetch(PDO::FETCH_ASSOC);
        if ($checkStmt->rowCount() == 0) {
          // No rows with the session email
          echo "<div id='warning'>
            <h1>No account exist with this Email!<br>
            </h1>
            <input type='button' value='Close' onclick='hideWarning();'>
          </div>";
        }
        
        $newPass = $_POST['newPass'];
        $confirmPass = $_POST['confirmPass'];
        $username = $_SESSION['username'];
        $postEmail = $_POST['email']; 
        $currentPassword = $row['password'];


    
        if ($newPass === $confirmPass && $checkStmt->rowCount() > 0 && $confirmPass !== $currentPassword) {
          $updateSql = "UPDATE inlog SET password = ? WHERE email = ?";
          $updateStmt = $dbh->prepare($updateSql);
          $updateStmt->bindParam(1, $newPass, PDO::PARAM_STR);
          $updateStmt->bindParam(2, $sessionEmail, PDO::PARAM_STR); // Bind de nieuwe e-mail aan de query// Dit moet 3 zijn, niet 2
          
          $updateStmt->execute();

          echo "<div id='warning'>
            <h1>Password Successfully Changed! <br>
            </h1>
            <input type='button' value='Close' onclick='hideWarning(); redirect();'>
          </div>";
          $toEmail = $postEmail;
          $emailSubject = "Password Changed";
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
                  <h1>Password have been changed!</h1>
                  <p>if you have NOT changed your password, immediately change your password</p>
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
        if($confirmPass === $currentPassword) {
          echo "<div id='warning'>
            <h1>Can't use same password Twice!<br>
            </h1>
            <input type='button' value='Close' onclick='hideWarning();'>
          </div>";
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
  echo "Database connection failed: " . $e->getMessage() . "<br><br>";
}



?>


<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password</title>
  <link rel="stylesheet" href="/portfolio/css/style.css">
  <link rel="stylesheet" href="/portfolio/css/mobileStyle.css">
  <script src="/portfolio/script.js"></script>
</head>
<body class="forgot">
<?php include 'header.php'; ?>

<div class="projectEdit" id="changePasswordPanel">
<form class="changePass" action="<?php echo $_SERVER['PHP_SELF'];?>" method='post'>
<span>
    <label for="email">Email</label>
    <input required type="email" name="email" id="email">
  </span>
  <span>
    <label for="authCode">Auth Code </label>
    <input required type="text" name="authCode" id="authCode">
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
    <input onclick="showLoader()" class="submitChangePass" type="submit" name="change-pass" value="Change Password">          
  </span>
</form>
</div>

</body>

<script>


</script>
<script src="https://kit.fontawesome.com/c6d023de9c.js" crossorigin="anonymous"></script>
</html>
