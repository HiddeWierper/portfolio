<?php
session_start();

$id = isset($_SESSION['id']) ? $_SESSION['id'] : 1; // haal de waarde van $id op uit de sessievariabele als deze is ingesteld, anders is het 1

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['up'])) {
    sleep(1);
    $id++;
    $_SESSION['id'] = $id; // sla de nieuwe waarde van $id op in een sessievariabele
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['down'])) {
    sleep(1);
    if ($id > 1) {
      
      $id--;
      $_SESSION['id'] = $id; // sla de nieuwe waarde van $id op in een sessievariabele
      header("location: /portfolio/subpages/admin.php#projects"); 
    }else{
    }
    
  }
}
$mysqli = new mysqli('localhost', 'root', 'root', 'portfolio');

if ($mysqli->connect_error) {
  die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Controleer of er een rij bestaat met de gegeven $id
$query = "SELECT * FROM projects WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  // Als er geen rij is, voeg dan een nieuwe rij in
  
  echo "<div id='warning'>
  <h1>No more projects found! <br>
  new project added!</h1>
  <input type='button' value='Close' onclick='hideWarning();'>
</div>";
$query = "INSERT INTO projects (id) VALUES (?)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();

}

$stmt->close();
$mysqli->close();


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
      if (isset($_POST['skillsInfo'])) {
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
    }
} catch (PDOException $e) {
    // echo "Database Connection failed: " . $e->getMessage() . "<br><br>";
    header("location: /portfolio/subpages/admin.php#skills");
}
try {
  $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $db . ';port=' . $port, $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Retrieve content from the database
  $sql = "SELECT skill_icon FROM skills ORDER BY order_number";
  $stmt = $dbh->query($sql);
  $skills = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  // Update content if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['skillsIcon'])) {
      for ($i = 1; $i <= 9; $i++) {
          $skillName = 'skill' . $i;
          $newSkill = $_POST[$skillName];

          $updateSql = "UPDATE skills SET skill_icon = :newSkill WHERE order_number = :orderNumber";
          $updateStmt = $dbh->prepare($updateSql);
          $updateStmt->bindParam(':newSkill', $newSkill);
          $updateStmt->bindParam(':orderNumber', $i);
          $updateStmt->execute();

          // Update the content variable to reflect the changes
          $skills[$i - 1]['skill_icon'] = $newSkill;
        
      }
      $specialMessage = "Records updated successfully";
      sleep(1);
      header("location: /portfolio/subpages/admin.php#skills");

    }
  }
} catch (PDOException $e) {
  echo "Database Connection failed: " . $e->getMessage() . "<br><br>";
  header("location: /portfolio/subpages/admin.php#skills");
}
try{
  $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $db . ';port=' . $port, $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  // Retrieve content from the database
  $sql = "SELECT * FROM projects WHERE id = $id";
  $stmt = $dbh->query($sql);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $projectIconContent = $row['IconLink'];
  $projectNameContent = $row['projectName'];
  $projectInfoContent = $row['projectInfo'];
  $projectLangContent = $row['projectLanguages'];
  $projectWebLink = $row['projectWebsiteLink'];
  $projectImg = $row['imgDir'];

  
  // Update content if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submitProjects'])) {
      $newProjectIconContent = $_POST['projectIconContent'];
      $newProjectNameContent = $_POST['projectNameContent'];
      $newProjectInfoContent = $_POST['projectInfoContent'];
      $newProjectLangContent = $_POST['projectLangContent'];
      $newProjectWebLink = $_POST['projectWebLink'];
      $newProjectImg = $_POST['projectImg'];
      $updateSql = "UPDATE projects SET IconLink = :newProjectIconContent, projectName = :newProjectNameContent, projectInfo = :newProjectInfoContent, projectLanguages = :newProjectLangContent, projectWebsiteLink = :newProjectWebLink, imgDir = :newProjectImg WHERE id = $id";
      $updateStmt = $dbh->prepare($updateSql);
      $updateStmt->bindParam(':newProjectIconContent', $newProjectIconContent);
      $updateStmt->bindParam(':newProjectNameContent', $newProjectNameContent);
      $updateStmt->bindParam(':newProjectInfoContent', $newProjectInfoContent);
      $updateStmt->bindParam(':newProjectLangContent', $newProjectLangContent);
      $updateStmt->bindParam(':newProjectWebLink', $newProjectWebLink);
      $updateStmt->bindParam(':newProjectImg', $newProjectImg);
      $updateStmt->execute();

      // Update the content variable to reflect the changes
      $projectIconContent = $newProjectIconContent;
      $projectNameContent = $newProjectNameContent;
      $projectInfoContent = $newProjectInfoContent;
      $projectLangContent = $newProjectLangContent;
      $projectWebLink = $newProjectWebLink;
      $projectImg = $newProjectImg;
      
      header("location: /portfolio/subpages/admin.php#projects");
}
}
}
catch(PDOException $e){
  echo "Database Connection failed: " . $e->getMessage() . "<br><br>";
 
}

try {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {
      // Use the current $id to delete the correct row
      $deleteSql = "DELETE FROM projects WHERE id = ?";
      $deleteStmt = $dbh->prepare($deleteSql);
      $deleteStmt->bindParam(1, $id, PDO::PARAM_INT);
      $deleteStmt->execute();

      // Reset $id to 1 after deletion
      $id--;
      $_SESSION['id'] = $id;

      header("location: /portfolio/subpages/admin.php#projects");
      exit;
    }
  }
} catch(PDOException $e) {
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
        <div class="skillsEdit">
          <form class="skillsInformationEdit" name="skillsInfo" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
            <textarea name="content" id="s" cols="30" rows="10"><?php echo $content; ?></textarea>
            <input class="left" name="skillsInfo" type="submit">
          </form>
          <form class="skillIconEdit" name="skillsIcon" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
          <?php
            for ($i = 1; $i <= 9; $i++) {
                $skillName = 'skill' . $i;
                echo '<textarea type="text" name="' . $skillName . '" id="' . $skillName . '" value="" placeholder="add fa fa link">' . $skills[$i - 1]['skill_icon'] . '</textarea>';
            }
            ?>
            <input class="right" name="skillsIcon" type="submit">
          </form>
          </div>
        </div>
          <div class="admin-panel-item" id="projects" >
            <div class="projectEdit">
            <span class="arrow">
                
                <form method="post" name="previous">
                 <input type="hidden" name="down" value="1">
                 <input onclick="showLoader();" type="submit" value="<">
               </form>
         </span>
            <form id="submitProjects" action="<?php echo $_SERVER['PHP_SELF'];?>" class="projectInformationEdit" method="post">
               <span>
                 <label for="edit">Repository Website Link</label>
                 <textarea name="projectIconContent" id="" cols="30" rows="10"><?php echo "$projectIconContent"?></textarea>
               </span>
               <span>
                 <label id="labelEditName" for="edit">Name</label>
                 <textarea name="projectNameContent" id="editName" cols="30" rows="10"><?php echo "$projectNameContent"?></textarea>
               </span>
               <span>
                 <label for="edit">Info</label>
                 <textarea name="projectInfoContent" id="" cols="30" rows="10"><?php echo "$projectInfoContent"?></textarea>
               </span>
               <span>
                 <label for="edit">Languages</label>
                 <textarea name="projectLangContent" id="" cols="30" rows="10"><?php echo "$projectLangContent"?></textarea>
               </span>
               <span>
                 <label for="edit">Website Link</label>
                 <textarea name="projectWebLink" id="" cols="30" rows="10"><?php echo "$projectWebLink"?></textarea>
               </span>
               <span>
                 <label for="edit">Image Path</label>
                 <textarea name="projectImg" id="" cols="30" rows="10"><?php echo "$projectImg"?></textarea>
               </span>
               <span>
                <input name="submitProjects" type="submit">
               </span>
               <span id="delete">
                <input class="delete" name="delete" type="submit" value="Delete">
               </span>
               <span id="add">
                <input class="add" name="add" type="submit" value="Add">
               </span>
              </form>
            <span class="arrow">
              <form method="post" name="next">
                <input type="hidden" name="up" value="1">
                <input type="submit" onclick="showLoader();" value=">">
              </form> 
            </span>

            </div>
          </div>
        <div class="admin-panel-item" id="contact">
         <p>df</p>
        </div>
      </div>
    </div>
  </section>
  <script src="https://kit.fontawesome.com/c6d023de9c.js" crossorigin="anonymous"></script>
  <script src="/portfolio/script.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <div id="container" class="container">
    <div class="loader"></div>
  </div>
  
    
<script>
function changeId() {
  $.ajax({
    url: "admin.php", 
    type: "POST",
    data: { action: "changeId" }, // vervang "nieuwe waarde" met de daadwerkelijke nieuwe waarde voor $id
    success: function(result){
      // Doe iets met het resultaat indien nodig
    }
  });
}
</script>
</script>
</body>
</html>