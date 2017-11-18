<?php
require('includes/util.php');
@session_start();

$_SESSION['un'] = '';
$_SESSION['uid'] = '';
session_destroy();
header('LOCATION: login.php?error=Please Login Again');

?>
