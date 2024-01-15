<?php 
$hostname = 'thuis.wierper.net';
$password = 'W13rp3r1411JD';
$username = 'root';
$database = 'portfolio';
$port = '3306';

//make database connection
$conn = new mysqli($hostname, $username, $password, $database, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
//end database connection
$sql = "SELECT skills_explanation FROM skills_explanation";
