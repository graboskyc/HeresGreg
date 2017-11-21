<?php
@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    
if(!isset($_SESSION['un']) || !isset($_SESSION['uid'])) { header('LOCATION: login.php'); }
require_once('includes/util.php');

$conn = connectDB();
$sql = "INSERT INTO `alerts` (`user_id`, `start`, `end`, `msg`, `bootstraptype`) VALUES (?, ?, ?, ?, ?);";
$stmt = $conn->prepare($sql);
$stmt->bindValue(1, $_SESSION['uid']);
$stmt->bindValue(2, $_POST['start']);
$stmt->bindValue(3, $_POST['end']);
$stmt->bindValue(4, $_POST['msg']);
$stmt->bindValue(5, $_POST['type']);
$stmt->execute();
    
 
//closeDB();

header("Location: index.php");

?>