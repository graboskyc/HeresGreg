<?php
require('includes/util.php');
$un = strtolower($_POST['username']);
$pw = strtolower($_POST['passcode']);

$conn = connectDB();
@session_start();

$sql = "SELECT * FROM user WHERE username = '$un'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();

if($r = $result[0])
{
	if($r['passcode'] == $pw)
	{
		$_SESSION['un'] = $un;
		$_SESSION['uid'] = $r['user_id'];
        $_SESSION['lv'] = $r['lastview'];
		header('LOCATION: index.php');
	}
	else
	{
		$_SESSION['un'] = '';
		$_SESSION['uid'] = '';
        $_SESSION['lv'] = '';
		session_destroy();
		header('LOCATION: login.php?error=Bad Username Or Password');
        //echo $un.$pw;
	}
}
else
{
	$_SESSION['un'] = '';
        $_SESSION['uid'] = '';
        session_destroy();
        header('LOCATION: login.php?error=Bad Username Or Password or DB connection');
}
closeDB();
?>
