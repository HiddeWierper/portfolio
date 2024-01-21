<?php
session_start();

$id = isset($_SESSION['id']) ? $_SESSION['id'] : 1; // haal de waarde van $id op uit de sessievariabele als deze is ingesteld, anders is het 1

if ($id == 0){
  $id = 1;
  $_SESSION['id'] = $id; // sla de nieuwe waarde van $id op in een sessievariabele
}

if (isset($_GET["logout"])) {
  // Unset all session variables
  $_SESSION = array();

  // Destroy the session
  session_destroy();

  // Expire the session cookie
  setcookie(session_name(), '', time() - 3600, '/');

  // Redirect to the login page
  header("location: /portfolio/");
  exit;
}

if ($_SESSION["username"] === "HiddeW2007"){
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
  $password = 'W13rp3r1411JD';
  $username = 'root';
}
   
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['up'])) {
    sleep(1);
    $id++;
    $_SESSION['id'] = $id; // sla de nieuwe waarde van $id op in een sessievariabele

    // Voer een SQL-query uit om te controleren of er een rij is met het gegeven $id
    $query = "SELECT * FROM projects WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
      // If there is no row with the given $id, display a warning
      echo "<div id='warning'>
      <h1>No more rows to edit!<br>
      </h1>
      <input type='button' value='Close' onclick='hideWarning();'>
    </div>";
    $id--;
    $_SESSION['id'] = $id;
 
    }
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['down'])) {
    sleep(1);
    if ($id > 1) {
      
      $id--;
      $_SESSION['id'] = $id; // sla de nieuwe waarde van $id op in een sessievariabele
      // header("location: /portfolio/subpages/admin.php#projects"); 
    }else{
    }
    
  }
}

try{
$mysqli = new mysqli('localhost', 'root', 'root', 'portfolio');
if ($mysqli->connect_error) {
  die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['add'])) {
    sleep(1);

    // Vind het hoogste id in de tabel
    $query = "SELECT MAX(id) AS max_id FROM projects";
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
    $max_id = $row['max_id'];

    // Voeg 1 toe aan het hoogste id om het nieuwe id te krijgen
    $id = $max_id + 1;
    $_SESSION['id'] = $id; // sla de nieuwe waarde van $id op in een sessievariabele

    $query = "SELECT * FROM projects WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
      // Als er geen rij is, voeg dan een nieuwe rij in
      echo "<div id='warning'>
      <h1>Succesfully added! <br>
      </h1>
      <input type='button' value='Close' onclick='hideWarning();'>
    </div>";
    $query = "INSERT INTO projects (id) VALUES (?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    }

    $stmt->close();
  }
}

$mysqli->close();

} catch(PDOException $e){
  echo "Database Connection failed: " . $e->getMessage() . "<br><br>";
 
}


// Check if the user is not logged in, then redirect to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: /portfolio/subpages/login.php");
    exit;
}

if ($_SESSION["username"] !== "HiddeW2007") {
    $readonly = "readonly='true'";
    $inputDisabled = "disabled='true'"; 
} else {
    $readonly = "";
    $inputDisabled = "";
}

// Logout logic


$specialMessage = ($_SESSION["username"] === "HiddeW2007")
    ? "You are logged in as root. Special actions can be performed."
    : "You are logged in as a regular user. No special actions can be performed";
// Database connection details

$port = '3306';
$database = 'portfolio';



if($_SERVER['SERVER_NAME'] == 'localhost') {
  $hostname = 'localhost';
  $password = 'root';
  $username = 'root';
}else if($_SERVER['SERVER_NAME'] == 'thuis.wierper.net') {
  $hostname = 'thuis.wierper.net';
  $password = 'Wierper1411';
  $username = 'root';
  
}

try {
  sleep(1);
    $dbh = new PDO('mysql:host=' . $hostname . ';dbname=' . $database . ';port=' . $port, $username, $password);
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

           // header("location: /portfolio/subpages/admin.php");
      }
    }
} catch (PDOException $e) {
    // echo "Database Connection failed: " . $e->getMessage() . "<br><br>";
    // header("location: /portfolio/subpages/admin.php");
}
try {
  sleep(1);
  $dbh = new PDO('mysql:host=' . $hostname . ';dbname=' . $database . ';port=' . $port, $username, $password);
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
      $specialMessage = "Record updated successfully";

      // header("location: /portfolio/subpages/admin.php");

    }
  }
} catch (PDOException $e) {
  echo "Database Connection failed: " . $e->getMessage() . "<br><br>";
  // header("location: /portfolio/subpages/admin.php");
}

try{
  $dbh = new PDO('mysql:host=' . $hostname . ';dbname=' . $database . ';port=' . $port, $username, $password);
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
  $vissibilty = $row['deleted'];
  
  if ($vissibilty == 1){
    //project = hidden
    $vissibilty = "show";
  }else{
    //project = visible
    $vissibilty = "hide";
  }

  
  // Update content if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submitProjects'])) {
        sleep(1); 

        $currentImageSql = "SELECT imgDir FROM projects WHERE id = $id";
        $currentImageStmt = $dbh->prepare($currentImageSql);
        $currentImageStmt->execute();
        $currentImageRow = $currentImageStmt->fetch(PDO::FETCH_ASSOC);
        $currentImageFromDatabase = $currentImageRow['imgDir'];
        $uploadDir = '../img/'; // specify your upload directory
        $uploadFile = $uploadDir . basename($_FILES['projectImg']['name']);

        if (isset($_FILES['projectImg']['name']) && $_FILES['projectImg']['name'] != '') {
            // A file was uploaded
            if (move_uploaded_file($_FILES['projectImg']['tmp_name'], $uploadFile)) {
                // File uploaded successfully
                $newProjectImg = basename($uploadFile);
            }
        } else {
            // No file was uploaded, use the current image from the database
            $newProjectImg = $currentImageFromDatabase;
        }


      $newProjectIconContent = $_POST['projectIconContent'];
      $newProjectNameContent = $_POST['projectNameContent'];
      $newProjectInfoContent = $_POST['projectInfoContent'];
      $newProjectLangContent = $_POST['projectLangContent'];
      $newProjectWebLink = $_POST['projectWebLink'];
      $newProjectImg = basename($newProjectImg);
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
      
      $affectedRows = $updateStmt->rowCount();
      if ($affectedRows > 0) {
        echo "<div id='warning'>
        <h1>Succesfully updated! <br>
        </h1>
        <input type='button' value='Close' onclick='hideWarning();'>
      </div>";
      }
      else if ($affectedRows == 0){
        echo "<div id='warning'>
        <h1>Nothing to update!<br>
        </h1>
        <input type='button' value='Close' onclick='hideWarning();'>
      </div>";
      }

      // header("location: /portfolio/subpages/admin.php#projects");
}
}
}
catch(PDOException $e){
  echo "Database Connection failed: " . $e->getMessage() . "<br><br>";
 
}

try {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['hide'])) {
      sleep(1);
      // Use the current $id to delete the correct row
      $deleteSql = "UPDATE projects set deleted = 1 where id = ?";
      $deleteStmt = $dbh->prepare($deleteSql);
      $deleteStmt->bindParam(1, $id, PDO::PARAM_INT);
      $deleteStmt->execute();
  
      $affectedRows = $deleteStmt->rowCount();
         if ($affectedRows > 0) {
        echo "<div id='warning'>
        <h1>Succesfully Hided! <br>
        </h1>
        <input type='button' value='Close' onclick='hideWarning();'>
      </div>";
     
        $id--;
        $_SESSION['id'] = $id;
      }elseif ($affectRows == 0){
        echo "<div id='warning'>
        <h1>Something Went Wrong!<br>
        </h1>
        <input type='button' value='Close' onclick='hideWarning();'>
        </div>";
        
        
      }
     
    }
    else if(isset($_POST['show'])){
      sleep(1);
      // Use the current $id to delete the correct row
      $deleteSql = "UPDATE projects set deleted = 0 where id = ?";
      $deleteStmt = $dbh->prepare($deleteSql);
      $deleteStmt->bindParam(1, $id, PDO::PARAM_INT);
      $deleteStmt->execute();
 
      $affectedRows = $deleteStmt->rowCount();
      if ($affectedRows > 0) {
        echo "<div id='warning'>
        <h1>Succesfully Added Back! <br>
        </h1>
        <input type='button' value='Close' onclick='hideWarning();'>
    </div>";
      }
      else if ($affectedRows == 0){
        echo "<div id='warning'>
        <h1>Already Visible On Website! <br>
        </h1>
        <input type='button' value='Close' onclick='hideWarning();'>
    </div>";
      }
    
   
  }
    
  }
} catch(PDOException $e) {
  echo "Database Connection failed: " . $e->getMessage() . "<br><br>";
}
}

?>
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
  <title>Welcome <?php echo $_SESSION["username"]; ?>!</title>
</head>
<body class="admin-body">

<header class="login admin">
    <img src="/portfolio/img/me.jpeg" id="admin" alt="">
    <span class="me admin">
      <h2>Welcome, <strong id="typed-username"><br><?php echo $_SESSION["username"]; ?>!</strong></h2>
    </span>
    <span class="nav">
    <a class="hamburger" href="?logout=1"><i style="transform: scaleX(-1); color: #7843e9" class="fa-solid fa-arrow-right-from-bracket"></i></a>
      <ul>
        <a href="admin.php" id="skill" onclick="active('skill')" ><li>SKILLS</li></a>
        <a href="#projects" id="project" onclick="active('project')" ><li>PROJECTS</li></a>
        <a href="#contact" id="contac" onclick="active('contac')" ><li>CONTACT</li></a>
        <a href="?logout=1"><li>LOGOUT</li></a> 
      </ul>
    </span>
</header>

  <section class="admin">
    <div class="adminPanel">
      <span class="header"><h2>Admin Panel</h2><p><?php echo"$specialMessage" ?></p></span>
      <div class="admin-panel">
        <div class="admin-panel-item" id="skills">
        <div class="skillsEdit">
          <form class="skillsInformationEdit" name="skillsInfo" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
            <textarea <?php echo $readonly ?> name="content" id="s" cols="30" rows="10"><?php echo $content; ?></textarea>
            <input <?php echo $inputDisabled?> onclick="showLoader();" class="left" name="skillsInfo" type="submit">
          </form>
          <form class="skillIconEdit" name="skillsIcon" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
          <?php
            for ($i = 1; $i <= 9; $i++) {
                $skillName = 'skill' . $i;
                echo '<textarea '. $readonly .' type="text" name="' . $skillName . '" id="' . $skillName . '" value="" placeholder="add fa fa link">' . $skills[$i - 1]['skill_icon'] . '</textarea>';
            }
            ?>
            <input <?php echo $inputDisabled?> class="right" onclick="showLoader();" name="skillsIcon" type="submit">
          </form>
          </div>
        </div>
          <div class="admin-panel-item" id="projects" >
            <div class="projectEdit">
            <span class="arrow">
                
                <form method="post" name="previous">
                 <input type="hidden" name="down" value="1">
                 <input <?php echo $inputDisabled?>  onclick="showLoader();" type="submit" value="<">
               </form>
         </span>
         <form id="submitProjects" action="<?php echo $_SERVER['PHP_SELF'];?>" class="projectInformationEdit" method="post" enctype="multipart/form-data">
               <span>
                 <label for="edit">Repository Website Link</label>
                 <textarea <?php echo $readonly ?> name="projectIconContent" id="" cols="30" rows="10"><?php echo "$projectIconContent"?></textarea>
               </span>
               <span>
                 <label id="labelEditName" for="edit">Name</label>
                 <textarea <?php echo $readonly ?> name="projectNameContent" id="editName" cols="30" rows="10"><?php echo "$projectNameContent"?></textarea>
               </span>
               <span>
                 <label for="edit">Info</label>
                 <textarea <?php echo $readonly ?> name="projectInfoContent" id="" cols="30" rows="10"><?php echo "$projectInfoContent"?></textarea>
               </span>
               <span>
                 <label for="edit">Languages</label>
                 <textarea <?php echo $readonly ?> name="projectLangContent" id="" cols="30" rows="10"><?php echo "$projectLangContent"?></textarea>
               </span>
               <span id="editLink" >
                 <label for="edit">Website Link</label>
                 <textarea <?php echo $readonly ?> name="projectWebLink" cols="30" rows="10"><?php echo "$projectWebLink"?></textarea>
               </span>
               <span id="imgId">
                <label for="edit">Image Path</label>
                  <label for="projectImg" class="fileUpload">
                    <i class="fa fa-cloud-upload"></i> Custom Upload
                    <input type="file" name="projectImg" id="projectImg">
                  </label>
                  <label for="">Current Image</label>
                  <textarea class="projectImg" readonly name="imgDir"><?php echo $projectImg ?></textarea>
                  <label for="edit">Order Number</label>
                  <textarea name="projectId" id="" cols="30" rows="10"><?php echo $id; ?></textarea>
               </span>
               <span id="submit">
                <input <?php echo $inputDisabled?> name="submitProjects" type="submit" value="Update">
               </span>
               <span id="add">
                <input <?php echo $inputDisabled?> class="add" name="add" type="submit" value="Add New">
               </span>
               <span id="delete">
               <input <?php echo $inputDisabled?> class="delete" name="<?php echo $vissibilty?>" type="submit" value='<?php echo $vissibilty; ?>'>
                <!-- <input type="submit" class="show" name="show" value="Bring Back"> -->
               </span>
               
              </form>
            <span class="arrow">
              <form method="post" name="next">
                <input type="hidden" name="up" value="1">
                <input <?php echo $inputDisabled?> type="submit" onclick="showLoader();" value=">">
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

</body>
</html>