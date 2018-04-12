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

    <title>Create a Filter for <?php echo APPNAME;?></title>

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

      <form class="form-signin" method="post" action="c_newFilter.php"  enctype="multipart/form-data">
        <h2 class="form-signin-heading"><span class="glyphicon glyphicon-envelope" aria-hidden="true" ></span>&nbsp; Create a Filter</h2>

        <label for="vis" class="sr-only">Visible Name</label>
        <input type="text" id="vis" name="vis" class="form-control" placeholder="Visible Name" required autofocus>

        <br>

        <label for="fn" class="sr-only">File Name</label>
        <input type="text" id="fn" name="fn" class="form-control" placeholder="FileName.png" required>

        <br>

        <label for="type" class="sr-only">Type</label>
        <select class="form-control" name="type">
          <option value="geo">Geographic</option>
          <option value="event">Event</option>
          <option value="holiday1">Holiday</option>
          <option value="fun">Fun</option>
        </select>

        <br>

        <label for="arch" class="sr-only">Archived Flag</label>
        <select class="form-control" name="arch">
          <option value="0">Enabled</option>
          <option value="1">Disabled</option>
        </select>

        <br>

        <label class="btn btn-default btn-file" style="width:100%;">
				Browse For PNG To Upload. <br>Dimension should be a clear png of 580x760px.
					<input type="file" name="file_attachment" id="file_attachment" style="display: none;">
        </label>
        
        <br><br>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Create</button>

      </form>

      <h2 class="form-signin-heading">Current Filters</h2>

      <table class="table table-striped">
      <thead><tr><th>Filter</th><th>Disable</th><th>View<th></tr></thead>
      <tbody>
      <?php
      $conn = connectDB();
      $sql = "SELECT * from filter order by visiblename asc";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();
      $mediaList = array();
      foreach($result as $r)
      {
        $dString = '<button type="button" class="btn btn-success btn-sm" onclick="window.location=\'c_archiveFilter.php?fid='.$r['filter_id'].'\';"><span class="glyphicon glyphicon-ok" aria-hidden="true" ></span></button>';
        if($r['isArchived'] == 1) {
          $dString = '<button type="button" class="btn btn-danger btn-sm" onclick="window.location=\'c_archiveFilter.php?fid='.$r['filter_id'].'\';"><span class="glyphicon glyphicon-remove" aria-hidden="true" ></span></button>';
        }
        echo "<tr><td>".$r['filename']."</td><td>".$dString."</td>";
        echo '<td><button type="button" class="btn btn-default btn-sm" onclick="window.open(\'/overlays/'.$r['filename'].'\');"><span class="glyphicon glyphicon-eye-open" aria-hidden="true" ></span></button></td>';
        echo "</tr>";
      }
      ?>
      </tbody></table>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
