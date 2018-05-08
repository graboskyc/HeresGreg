<?php
require('includes/util.php');
$un = strtolower($_GET['username']);
$pw = strtolower($_GET['passcode']);

$conn = connectDB();
@session_start();

$sql = "SELECT user_id, lower(passcode) as passcode, username, lastview FROM user WHERE lower(username) = '$un' and isArchived = 0";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();

if($r = $result[0])
{
	if($r['passcode'] == $pw)
	{
		$_SESSION['lv'] = $r['lastview'];
		$_SESSION['un'] = $un;
		$_SESSION['uid'] = $r['user_id'];
		updateUser($conn, -1);
		header('LOCATION: index.php');
	}
	else
	{
		$_SESSION['un'] = '';
		$_SESSION['uid'] = '';
		$_SESSION['lv'] = '';
		session_destroy();
		header('LOCATION: login.php?error=Bad Username Or Password');
	}
}
else
{
	$_SESSION['un'] = '';
		$_SESSION['uid'] = '';
		$_SESSION['lv'] = '';
        session_destroy();
        header('LOCATION: login.php?error=Bad Username Or Password');
}
closeDB();
?>
