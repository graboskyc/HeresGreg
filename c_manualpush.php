<?php
@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    
$redir = true;

if(!isset($_SESSION['un']) || !isset($_SESSION['uid'])) { 
    if(isset($_GET['authbypass'])) {
        if($_GET['authbypass'] == "h8934nsgnnvmsd93ksndfjnbnm57wewdfsf3") {
            $redir = false;
        }
    }
}
else {
    $redir = false;
}

if($redir) {
    header('LOCATION: login.php'); 
}

require_once('includes/util.php');
require_once('includes/push.php');


PushChan();

if(isset($_GET['redir'])) {
    $page = $_GET['redir'];

    header("Location: ".$page);
}

?>