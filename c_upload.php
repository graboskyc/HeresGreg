<?php
// https://stackoverflow.com/questions/834303/startswith-and-endswith-functions-in-php
function endsWith($haystack, $needle) {
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
}

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

//phpinfo();

if(!isset($_SESSION['un']) || !isset($_SESSION['uid'])) { header('LOCATION: login.php'); }
require_once('includes/util.php');
require_once('includes/push.php');
require_once('includes/ffmpeg.php');

$uploaddir = '/var/www/media/';
$guid = NewGUID();
$filename = $guid . ".mp4";
$uploadfile = $uploaddir .$filename;

var_dump($_FILES);

if (move_uploaded_file($_FILES['video']['tmp_name'], $uploadfile)) {
    // success
    PushChan();
    
    $conn = connectDB();
    $sql = "INSERT INTO media (path, archived, created_by) VALUES (?,0,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $filename);
    $stmt->bindValue(2, $_SESSION['uid']);
	$stmt->execute();
    
    //if (strtolower(strpos($_FILES['video']['name']), '.mov') !== FALSE) {
    //    rename($uploadfile, $uploaddir.$guid.".mov");
    //    ConvertVid($guid.".mov", $filename);
    //}

    if (endsWith($_FILES['video']['name'], '.gif')) {
        rename($uploadfile, $uploaddir.$guid.".gif");
        ConvertGIF($guid.".gif", $filename);
    }

    CreateThumb($filename);

    VisionRequest($filename);
    
	//closeDB();
    
    header("Location: index.php");
} else {
    // fail
    echo "Failed uploading... Tell Chris.";
}

?>
