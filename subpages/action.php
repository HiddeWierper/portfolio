<?php

if($_SERVER['SERVER_NAME'] == 'localhost') {
  $host = 'localhost';
  $pass = 'root';
  $user = 'root';
}else if($_SERVER['SERVER_NAME'] == 'thuis.wierper.net') {
  $host = 'thuis.wierper.net';
  $pass = 'NOescape!';
  $user = 'gamer';
  
}

$db = 'portfolio';
try {
  $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $db . ';port=' . $port, $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Retrieve content from the database
  $sql = "SELECT * FROM projects WHERE id = 435";
  $stmt = $dbh->query($sql);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $projectIconContentWeform = $row['IconLink'];
  $projectNameContentWeform = $row['projectName'];
  $projectInfoContentWeform = $row['projectInfo'];
  $projectLangContentWeform = $row['projectLanguages'];
  $projectWebLinkWeform = $row['projectWebsiteLink'];
  $projectImgWeform = $row['imgDir'];

  // Update content if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['weformSubmit'])) {
      $newWeformLink = $_POST['projectIconContentWeform'];
      $newWeformName = $_POST['projectNameContentWeform'];
      $newWeformInfo = $_POST['projectInfoContentWeform'];
      $newWeformLang = $_POST['projectLangContentWeform'];
      $newWeformWebLink = $_POST['projectWebLinkWeform'];
      $newWeformImgDir = $_POST['projectImgWeform'];

      $updateSql = "UPDATE projects SET IconLink = :newWeformLink, projectName = :newWeformName, projectInfo = :newWeformInfo, projectLanguages = :newWeformLang, projectWebsiteLink = :newWeformWebLink, imgDir = :newWeformImgDir WHERE id = 435";
      $updateStmt = $dbh->prepare($updateSql);
      $updateStmt->bindParam(':newWeformLink', $newWeformLink);
      $updateStmt->bindParam(':newWeformName', $newWeformName);
      $updateStmt->bindParam(':newWeformInfo', $newWeformInfo);
      $updateStmt->bindParam(':newWeformLang', $newWeformLang);
      $updateStmt->bindParam(':newWeformWebLink', $newWeformWebLink);
      $updateStmt->bindParam(':newWeformImgDir', $newWeformImgDir);
      $updateStmt->execute();

      // Update the content variable to reflect the changes
    }
  }
  } catch (PDOException $e) {
      echo "Database Connection failed: " . $e->getMessage() . "<br><br>";
}

//make connection with database projects en use all tables
?>

<!DOCTYPE html>
<html lang="en">
<div class="admin-panel-item" id="projects" >
          <div class="projectEdit">
            <form id="weformSubmit" action="<?php echo $_SERVER['PHP_SELF'];?>" class="projectInformationEdit" method="post"> 
              <span>
                <label for="edit">Icon</label>
                <textarea name="projectIconContentWeform" id="" cols="30" rows="10"><?php echo "$projectIconContentWeform"?></textarea>
              </span>
              <span>
                <label for="edit">Name</label>
                <textarea name="projectNameContentWeform" id="" cols="30" rows="10"><?php echo "$projectNameContentWeform"?></textarea>
              </span>
              <span>
                <label for="edit">Info</label>
                <textarea name="projectInfoContentWeform" id="" cols="30" rows="10"><?php echo "$projectInfoContentWeform"?></textarea>
              </span>
              <span>
                <label for="edit">Languages</label>
                <textarea name="projectLangContentWeform" id="" cols="30" rows="10"><?php echo "$projectLangContentWeform"?></textarea>
              </span>
              <span>
                <label for="edit">Website Link</label>
                <textarea name="projectWebLinkWeform" id="" cols="30" rows="10"><?php echo "$projectWebLinkWeform"?></textarea>
              </span>
              <span>
                <label for="edit">Image Path</label>
                <textarea name="projectImgWeform" id="" cols="30" rows="10"><?php echo "$projectImgWeform"?></textarea>
              </span>
              <input name="weformSubmit" type="submit">
            </form>
          </div>
        </div>