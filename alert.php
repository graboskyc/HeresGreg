<?php
@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    
if(!isset($_SESSION['un']) || !isset($_SESSION['uid'])) { header('LOCATION: login.php'); }
require_once('includes/util.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="favicon.ico">
    <meta name="theme-color" content="#333333" />
    <title>Create an Alert for <?php echo APPNAME;?></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="post" action="c_newAlert.php">
        <h2 class="form-signin-heading">Create an Alert</h2>

        <label for="msg" class="sr-only">Alert Message</label>
        <input type="text" id="msg" name="msg" class="form-control" placeholder="Message" required autofocus>

        <label for="start" class="sr-only">Start</label>
        <input type="text" id="start" name="start" class="form-control" value=" 2017-11-21 00:00:00" required>

        <label for="end" class="sr-only">End</label>
        <input type="text" id="end" name="end" class="form-control" value=" 2017-11-21 00:00:00" required>

        <label for="type" class="sr-only">Type</label>
        <select class="form-control" name="type">
          <option>success</option>
          <option>info</option>
          <option>warning</option>
          <option>danger</option>
        </select>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Create</button>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
