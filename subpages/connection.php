<?php

if($_SERVER['SERVER_NAME'] == 'localhost') {
  $hostname = 'localhost';
  $password = 'root';
  $username = 'root';
}else if($_SERVER['SERVER_NAME'] == '192.168.1.33') {
  $hostname = '192.168.1.33';
  $password = 'root';
  $username = 'root';
  
}  
$database = 'portfolio';
$port = '3306';

?>