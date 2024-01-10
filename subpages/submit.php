<?php

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

$dsn = "mysql:host=$host;dbname=$db;port=$port";
$dbh = new PDO($dsn, $user, $pass);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST['action'] == 'newId') {
    $id = 
  
  }
}




function lo() {
//make 0function that changes al the variables to the new ones the new ones are the ones that are in the form
global $dbh;
  $newWeformLink = $_POST['projectIconContentCat'];
  $newWeformName = $_POST['projectNameContentCat'];
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
  echo "Records updated successfully";
  sleep(1);
  header("location: /portfolio/subpages/admin.php#projects");
}


