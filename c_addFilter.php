<?php
@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    
if(!isset($_SESSION['un']) || !isset($_SESSION['uid'])) { header('LOCATION: login.php'); }
require_once('includes/util.php');

$id = $_GET['id'];
$filter = $_GET['filter'];
$page = $_GET['redir'];

$conn = connectDB();
$sql = "UPDATE media set filterName = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bindValue(1, $filter);
$stmt->bindValue(2, $id);
$stmt->execute();
    
 
//closeDB();

header("Location: ".$page);

?>