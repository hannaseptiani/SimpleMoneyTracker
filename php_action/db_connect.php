<?php 	

$localhost = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "money_tracker";

$connect = new mysqli($localhost, $username, $password, $dbname);
if($connect->connect_error){
  die("Connection Failed : " . $connect->connect_error);
} else {}

?>