<?php
require('includes/util.php');
$un = strtolower($_GET['username']);
$pw = strtolower($_GET['passcode']);

$qs = SITEURL . "/c_qrLogin.php?username=" . $un . "&passcode=" . $pw; 

?>
<html>
    <body>
        <center>
            <h1><?php echo $un;?></h1>
            <img src="https://chart.googleapis.com/chart?cht=qr&chs=500x500&chld=L|0&chl=<?php echo urlencode($qs); ?>" />
        </center>
    </body>
</html>