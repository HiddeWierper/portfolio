<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
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
  
</head>

<body class="login">
<header class="login">
  <img src="/portfolio/img/me.jpeg"  id="login"alt="">
  <span class="me"><h2>Hidde Wierper</h2></span>
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
    <a href="/portfolio/index.php"><li>HOME</li></a>
    <a href="/portfolio/index.php#skills"><li>SKILLS</li></a>
    <a href="/portfolio/index.php#projects"><li>PROJECTS</li></a>
    <a href="/portfolio/index.php#contact"><li>CONTACT</li></a>
  </ul>
  </span>
</header>
<div class="form-container">
  <h1>Login</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required placeholder="Enter your username">

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required placeholder="Enter your password">

      <input type="submit" onclick="showLoader()" value="Login">
     
 
    </form>
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
    <label for="email">Forgot password?:</label>
        <input type="email" required id="email" name="email" placeholder="Email">
        <input type="submit" name="forgotPass" value="Forgot">
        <input type="submit" name="register" value="Register">
      </form>
</div>

<?php

session_start();
if ($_SESSION["loggedin"] === true) {
    header("location: /portfolio/subpages/admin.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['email'])) {
    $_SESSION['email'] = $_POST['email'];

$_SESSION['authCode'] = rand(100000, 999999);

$emailMessage ='

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
            <h1>Password have been changed!</h1>
            <p>if you have NOT changed your password, immediately contact our customer service</p>
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
    
    </html>
    
';

$emailSubject = 'Auth Code';
$emailMessage = 'Your auth code is: ' . $_SESSION['authCode'];
$headers = 'From: hmrwierper@gmail.com;' . "\r\n" .
  'Reply-To: hmrwierper@gmail.com ' . "\r\n" .
   mail($_SESSION['email'], $emailSubject, $emailMessage, $headers);
    if (isset($_POST['forgotPass'])) {
      header("location: /portfolio/subpages/forgotPass.php");
    }
    if (isset($_POST['register'])) {
      header("location: /portfolio/subpages/register.php");
    }
  }
}

try {
include_once 'connection.php';
  $dbh = new PDO('mysql: host=' . $hostname.'; dbname='.$database
                .'; port=' . $port, $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
      echo "Database Connection failed: " . $e->getMessage() . "<br><br>";
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
sleep(0.3);
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Use prepared statements to prevent SQL injection
        $sql = ("
        (SELECT * FROM inlog WHERE username = :username AND password = :password)
        UNION
        (SELECT * FROM gast WHERE username = :username AND password = :password)
    ");
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        try {
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (count($result) > 0) {
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $username;
                header("location: /portfolio/subpages/admin.php");
                exit;
            } else {
              echo "<div id='warning'>
              <h1>Wrong Username OR Password <br>
              </h1>
              <input type='button' value='Close' onclick='hideWarning();'>
            </div>";            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Please enter a username and password";
    }
}
?>
 <div id="container" class="container">
    <div class="loader"></div>
  </div>


  <script src="/portfolio/script.js"></script>
  <script>
    window.addEventListener('resize', function() {
  var header = document.querySelector('header');
  if (window.innerWidth <= 900) {
    header.classList.remove('login');

  } else {
    header.classList.add('login');
  }
});
  </script>
  <script src="https://kit.fontawesome.com/c6d023de9c.js" crossorigin="anonymous"></script>
</body>
</html>