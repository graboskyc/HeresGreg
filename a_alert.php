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
    
    <link rel="icon" href="/favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon//manifest.json">
    <meta name="msapplication-TileColor" content="#<?php echo THEMECOLOR;?>">
    <meta name="msapplication-TileImage" content="/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#<?php echo THEMECOLOR;?>" />

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

    <style>
    .container {
				width:400px !important;
			}
      form {
        max-width:400px !important;
      }
    </style>
  </head>

  <body>

    <div class="container">

    <div class="header clearfix">
        <nav>
            <ul class="nav nav-pills pull-left" style="padding-left:10px;">
                <button type="button" class="btn btn-default" onclick="window.location='index.php';">
                    <span class="glyphicon glyphicon-home" aria-hidden="true" ></span>
                </button>
            </ul>
        </nav>
      </div>

      <form class="form-signin" method="post" action="c_newAlert.php">
        <h2 class="form-signin-heading"><span class="glyphicon glyphicon-envelope" aria-hidden="true" ></span>&nbsp; Create an Alert</h2>

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

        <h2 class="form-signin-heading">Current Alerts</h2>

        <table class="table table-striped">
        <thead><tr><th>Message</th><th>Start</th><th>End</th></tr></thead>
        <tbody>
        <?php
        $conn = connectDB();
        $sql = "SELECT msg, start, end from alerts order by end desc";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $mediaList = array();
        foreach($result as $r)
        {
          echo "<tr><td>".$r['msg']."</td><td>".$r['start']."</td><td>".$r['end']."</td></tr>";
        }
        ?>
        </tbody></table>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
