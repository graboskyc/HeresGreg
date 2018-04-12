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

    <title>User Management for <?php echo APPNAME;?></title>

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

    <div class="container" >
      <div class="header clearfix">
        <nav>
            <ul class="nav nav-pills pull-left" style="padding-left:10px;">
                <button type="button" class="btn btn-default" onclick="window.location='index.php';">
                    <span class="glyphicon glyphicon-home" aria-hidden="true" ></span>
                </button>
            </ul>
        </nav>
      </div>

      <form class="form-signin" method="post" action="c_user.php">
        <h2 class="form-signin-heading"><span class="glyphicon glyphicon-user" aria-hidden="true" ></span>Create a User</h2>

        <label for="user" class="sr-only">User</label>
        <input type="text" id="usermsg" name="user" class="form-control" placeholder="user" required autofocus>

        <label for="passcode" class="sr-only">Passcode</label>
        <input type="text" id="passcode" name="passcode" class="form-control" placeholder="passcode" equired>

        <label for="isadmin" class="sr-only">Admin?</label>
        <input type="text" id="isadmin" name="isadmin" class="form-control" value="0" equired>
        
        <button class="btn btn-lg btn-primary btn-block" type="submit">Create</button>

        <h2 class="form-signin-heading">Current Users</h2>

        <table class="table table-striped">
        <thead><tr><th>Username</th><th>Last Activity</th><th>Deactivate</th><th>QR<th></tr></thead>
        <tbody>
        <?php
        $conn = connectDB();
        $sql = "SELECT user_id, username, passcode, lastactivity, isArchived from user order by lastactivity desc";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $mediaList = array();
        foreach($result as $r)
        {
          $dString = '<button type="button" class="btn btn-success btn-sm" onclick="window.location=\'c_archiveUser.php?uid='.$r['user_id'].'\';"><span class="glyphicon glyphicon-ok" aria-hidden="true" ></span></button>';
          if($r['isArchived'] == 1) {
            $dString = '<button type="button" class="btn btn-danger btn-sm" onclick="window.location=\'c_archiveUser.php?uid='.$r['user_id'].'\';"><span class="glyphicon glyphicon-remove" aria-hidden="true" ></span></button>';
          }
          echo "<tr>";
          echo "<td class='pcpo' placement='left' data-toggle='popover' title='Passcode' data-content='".$r['passcode']."'>".$r['username']."</td>";
          echo "<td>".$r['lastactivity']."</td><td>".$dString."</td>";
          echo '<td><button type="button" class="btn btn-default btn-sm" onclick="window.open(\'c_qrMaker.php?username='.$r['username'].'&passcode='.$r['passcode'].'\');"><span class="glyphicon glyphicon-qrcode" aria-hidden="true" ></span></button></td>';
          echo "</tr>";
        }
        ?>
        </tbody></table>
      </form>

    </div> <!-- /container -->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script>
      $(document).ready(function() {
        $('[data-toggle="popover"]').popover({html : true});
      });
    </script>
  </body>
</html>
