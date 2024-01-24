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
    <a href=""><li>ABOUT</li></a>
    <a href=""><li>PROJECTS</li></a>
    <a href=""><li>CONTACT</li></a>
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
</div>

<?php

session_start();
if ($_SESSION["loggedin"] === true) {
    header("location: /portfolio/subpages/admin.php");
    exit;
}

try {
//   when on server remove //
  // $hostname = 'thuis.wierper.net';
  // $password = 'Wierper1411';

  if($_SERVER['SERVER_NAME'] == 'localhost') {
    $hostname = 'localhost';
    $password = 'root';
    $username = 'root';
  }else if($_SERVER['SERVER_NAME'] == '192.168.1.33') {
    $hostname = '192.168.1.33';
    $password = 'root';
    $username = 'root';
    
  }
 
  $port = 3306;  
  
  $database= 'portfolio';
  $dbh = new PDO('mysql: host=' . $hostname.'; dbname='.$database
                .'; port=' . $port, $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
      echo "Database Connection failed: " . $e->getMessage() . "<br><br>";
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
sleep(1);
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Use prepared statements to prevent SQL injection
        $sql = "SELECT * FROM inlog WHERE username = :username AND password = :password";
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
                echo "<script>alert('Incorrect username or password')</script>";
            }
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
</body>
</html>