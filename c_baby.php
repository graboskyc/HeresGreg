<?php
@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    
if(!isset($_SESSION['un']) || !isset($_SESSION['uid'])) { header('LOCATION: login.php'); }
require_once('includes/util.php');

$conn = connectDB();
$sql = "INSERT INTO `baby` (`babyname`, `babycolor`) VALUES (?, ?);";
$stmt = $conn->prepare($sql);
$stmt->bindValue(1, $_POST['baby']);
$stmt->bindValue(2, $_POST['color']);
$stmt->execute();
    
 
//closeDB();

header("Location: a_baby.php");

?>