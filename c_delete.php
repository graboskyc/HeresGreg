<?php
@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    
if(!isset($_SESSION['un']) || !isset($_SESSION['uid'])) { header('LOCATION: login.php'); }
require_once('includes/util.php');

$id = $_GET['delid'];

$conn = connectDB();
$sql = "UPDATE media set archived = 1 where id = " . $id;
$stmt = $conn->prepare($sql);
$stmt->execute();

//closeDB();

$page = $_GET['redir'];
header("Location: ".$page);


?>