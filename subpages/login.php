<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="/portfolio/css/style.css">
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
<header class="login">
  <img src="/portfolio/img/me.jpeg" alt="">
  <span class="me"><h2>Hidde Wierper</h2></span>
  <span class="nav">
  <ul>
    <a href="/portfolio/index.php"><li>HOME</li></a>
    <a href=""><li>ABOUT</li></a>
    <a href=""><li>PROJECTS</li></a>
    <a href=""><li>CONTACT</li></a>
  </ul>
  </span>
</header>
<body class="login">

<div class="form-container">
  <h1>Login</h1>
    <form class="skillsEdit" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required placeholder="Enter your username">

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required placeholder="Enter your password">

      <input type="submit" value="Login">
    </form>
</div>

<?php

session_start();
if ($_SESSION["loggedin"] === true) {
    header("location: /portfolio/subpages/admin.php#skills");
    exit;
}


  try {   
    $port='3306';
  
    if($_SERVER['SERVER_NAME'] == 'localhost') {
      $host = 'localhost';
      $pass = 'root';
      $user = 'root';
    }else if($_SERVER['SERVER_NAME'] == 'thuis.wierper.net') {
      $host = 'thuis.wierper.net';
      $pass = 'Wierper1411';
      $user = 'root';
    }
  
  $db= 'login';
  $dbh = new PDO('mysql: host=' . $host.'; dbname='.$db
                .'; port=' . $port, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
      echo "Database Connection failed: " . $e->getMessage() . "<br><br>";
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
                header("location: /portfolio/subpages/admin.php#skills");
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


  <script src="/portfolio/script.js"></script>
</body>
</html>