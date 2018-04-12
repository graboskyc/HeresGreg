<?php
@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    
if(!isset($_SESSION['un']) || !isset($_SESSION['uid'])) { header('LOCATION: login.php'); }
require_once('includes/util.php');

$id = $_GET['fid'];

$conn = connectDB();
$sql = "UPDATE filter set isArchived = !isArchived WHERE filter_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bindValue(1, $id);
$stmt->execute();

//closeDB();

header("Location: a_filter.php");


?>