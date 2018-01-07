<?php
@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    
if(!isset($_SESSION['un']) || !isset($_SESSION['uid'])) { header('LOCATION: login.php'); }
require_once('includes/util.php');

CreateAlert($_SESSION['uid'], $_POST['start'], $_POST['end'],  $_POST['msg'], $_POST['type']);  
 
//closeDB();

header("Location: index.php");

?>