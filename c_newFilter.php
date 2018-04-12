<?php
@session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('file_uploads', 'On');
ini_set('upload_max_filesize', '100M');
ini_set('post_max_size', '100M');
ini_set('max_input_time', 30000);
ini_set('max_execution_time', 30000);
ini_set('upload_tmp_dir', '/var/www/tmp');
error_reporting(E_ALL);


if(!isset($_SESSION['un']) || !isset($_SESSION['uid'])) { header('LOCATION: login.php'); }
require_once('includes/util.php');

$uploaddir = '/var/www/overlays/';
$filename = $_POST['fn'];
$uploadfile = $uploaddir .$filename;

if (move_uploaded_file($_FILES['file_attachment']['tmp_name'], $uploadfile)) {
    
    $conn = connectDB();
    $sql = "INSERT INTO filter (visiblename, filename, type, isArchived) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $_POST['vis']);
    $stmt->bindValue(2, $_POST['fn']);
    $stmt->bindValue(3, $_POST['type']);
    $stmt->bindValue(4, $_POST['arch']);
	$stmt->execute();
    
	//closeDB();
    
    header("Location: index.php");
} else {
    // fail
    echo "Failed uploading... Tell Chris.";
}

?>
