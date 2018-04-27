<?php 

require_once 'php_action/common.php';

session_unset(); 
session_destroy(); 

header('location: http://localhost/Sample/index.php');

?>