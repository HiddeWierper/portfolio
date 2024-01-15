<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$hostname = 'thuis.wierper.net';
$username = 'root';
$password = 'W13rp3r1411JD';
$port = '3306';
$database = 'login';

try {
    $dbh = new PDO('mysql:host=' . $hostname . ';dbname=' . $database . ';port=' . $port, $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Rest of your code here...

    echo $hostname . " . " . $username . " . " . $password . " . " . $database . " . " . $port;

    // Proceed with the rest of your code...
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... Your existing HTML head content ... -->
</head>
<body id="home">
    <!-- ... Your existing HTML body content ... -->
</body>
</html>
