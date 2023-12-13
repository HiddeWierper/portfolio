<?php
session_start();

// Check if the user is not logged in, then redirect to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: /portfolio/subpages/login.php");
    exit;
}

// Logout logic
if (isset($_GET["logout"])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Expire the session cookie
    setcookie(session_name(), '', time() - 3600, '/');

    // Redirect to the login page
    header("location: /portfolio/subpages/login.php");
    exit;
}

// Check if the username is "root"
// if ($_SESSION["username"] === "root") {
//     // Special actions for "root" user
//     // For example, display a special message or perform specific tasks
//     $specialMessage = "You are logged in as root. Special actions can be performed.";
// } else {
//     // Regular actions for other users
//     $specialMessage = "You are logged in as a regular user.";
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <title>Welcome <?php echo $_SESSION["username"]; ?>!</title>
</head>
<body class="login admin-body">

<header class="login admin">
    <img src="/portfolio/img/me.jpeg" alt="">
    <span class="me admin">
      <h2>Welcome, <strong id="typed-username"><?php echo $_SESSION["username"]; ?>!</strong></h2>
    </span>
    <span class="nav">
      <ul>
        <a href=""><li>SKILLS</li></a>
        <a href=""><li>PROJECTS</li></a>
        <a href=""><li>CONTACT</li></a>
        <a href="?logout=1"><li>LOGOUT</li></a>
      </ul>
    </span>
  </header>
  
  <p>This is the admin page.</p>
  <p><?php echo $specialMessage; ?></p>
  <a href="?logout=1">Logout</a>

  <script src="/portfolio/script.js"></script>
</body>
</html>