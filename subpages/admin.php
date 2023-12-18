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

$specialMessage = ($_SESSION["username"] === "root")
    ? "You are logged in as root. Special actions can be performed."
    : "You are logged in as a regular user. No special actions can be performed";

// Database connection details

$port = '3306';
$db = 'portfolio';

if($_SERVER['SERVER_NAME'] == 'localhost') {
  $host = 'localhost';
  $pass = 'root';
  $user = 'root';
}else if($_SERVER['SERVER_NAME'] == 'thuis.wierper.net') {
  $host = 'thuis.wierper.net';
  $pass = 'NOescape!';
  $user = 'gamer';
}

try {
    $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $db . ';port=' . $port, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve content from the database
    $sql = "SELECT skills_explanation FROM skills_explanation WHERE id = 5";
    $stmt = $dbh->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $content = $row['skills_explanation'];

    // Update content if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newContent = $_POST['content'];
        $updateSql = "UPDATE skills_explanation SET skills_explanation = :newContent WHERE id = 5";
        $updateStmt = $dbh->prepare($updateSql);
        $updateStmt->bindParam(':newContent', $newContent);
        $updateStmt->execute();

        // Update the content variable to reflect the changes
        $content = $newContent;

        echo "Record updated successfully";
        header("location: /portfolio/subpages/admin.php#skills");
    }
} catch (PDOException $e) {
    echo "Database Connection failed: " . $e->getMessage() . "<br><br>";
}
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
<body class="admin-body">

<header class="login admin">
    <img src="/portfolio/img/me.jpeg" alt="">
    <span class="me admin">
      <h2>Welcome, <strong id="typed-username"><?php echo $_SESSION["username"]; ?>!</strong></h2>
    </span>
    <span class="nav">
      <ul>
        <a href="#skills" id="skill" onclick="active('skill')" ><li>SKILLS</li></a>
        <a href="#projects" id="project" onclick="active('project')" ><li>PROJECTS</li></a>
        <a href="#contact" id="contac" onclick="active('contac')" ><li>CONTACT</li></a>
        <a href="?logout=1"><li>LOGOUT</li></a>
      </ul>
    </span>
  </header>

  <section class="admin">
    <div class="adminPanel">
      <span><h2>Admin Panel</h2><p><?php echo"$specialMessage" ?></p></span>
      <div class="admin-panel">
        <div class="admin-panel-item" id="skills">
          <form class="skillsEdit" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <textarea name="content" id="" cols="30" rows="10"><?php echo $content; ?></textarea>
            <input type="submit">
          </form>
        </div>
        <div class="admin-panel-item" id="projects" >
          <p>checkdate</p>
        </div>
        <div class="admin-panel-item" id="contact">
         <p>df</p>
        </div>
      </div>
    </div>
  </section>

  <script src="/portfolio/script.js"></script>
</body>
</html>