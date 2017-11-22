<?php
@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    
if(!isset($_SESSION['un']) || !isset($_SESSION['uid'])) { header('LOCATION: login.php'); }
require_once('includes/util.php');

$conn = connectDB();
$sql = "INSERT INTO `user` (`username`, `passcode`, `isAdmin`) VALUES (?, ?, ?);";
$stmt = $conn->prepare($sql);
$stmt->bindValue(1, $_POST['user']);
$stmt->bindValue(2, $_POST['passcode']);
$stmt->bindValue(3, $_POST['isadmin']);
$stmt->execute();
    
 
//closeDB();

header("Location: index.php");

?>