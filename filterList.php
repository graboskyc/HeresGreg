<?php
@session_start();
if(!isset($_SESSION['un']) || !isset($_SESSION['uid'])) { header('LOCATION: login.php'); }
require_once('includes/util.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    
    <title>Here's <?php echo APPNAME;?>!</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron-narrow.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <style>
        ul li { text-align:left; font-size:24px;padding-bottom:5px; }
        .jumbotron h1 { font-size:24px !important; padding-bottom:15px !important; font-weight:bold  !important;}
        .widelbl { min-width: 150px !important;}
        .smallvnote { font-size:10px; font-style:italic;}
    </style>
  </head>
  <body>

    <div class="container">
      <div class="header clearfix">
        <nav>
            <ul class="nav nav-pills pull-right">
                <button type="button" class="btn btn-default" onclick="window.location='index.php';">
                    <span class="glyphicon glyphicon-home" aria-hidden="true" ></span>
                </button>
            </ul>
        </nav>
        <h3 class="text-muted">Here's <?php echo APPNAME;?></h3>
      </div>

      <?php
        $conn = connectDB();
        $sql = "SELECT filter_id, filterName, visiblename, COUNT(id) as 'total' FROM media m right join filter f on m.filterName = f.filename GROUP BY filter_id ";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $mediaList = array();
        $retStr = "";

        $ctmax = 0;
        $ctmin = 999999999;
        $i = 0;

        foreach($result as $r)
        {
          $i++;
          $retStr = $retStr . '<li>
            <span class="label label-info widelbl" id="spnct_'.$r['total'].'"><span class="glyphicon glyphicon-film" aria-hidden="true"></span> 
            &nbsp;'.$r['total'].'</i></span><a href="vidList.php?view=filter_'.$r['filterName'].'"> at <b>'.strip_tags(str_replace("<br>", " ", $r['visiblename'])).'</b>
            </a></li>';

          if($r['total']>$ctmax) { $ctmax = $r['total'];}
          if(($r['total']<$ctmin) && ($i < count($result))) { $ctmin = $r['total'];}
        }
      ?>

      <div class="well" >
        <h1>Video History</h1>
        <ul>
          <?php echo $retStr; ?>
        </ul>
      </div>

      <footer class="footer" style="margin-top: 0px auto;border-top: transparent solid 10px;">
          <p class="text-right" style="margin-top:-40px !important; border-top:solid 3px #cccccc;padding:10px;">Made with &nbsp; ❤️ &nbsp; for Greg <a href="ChangeLog.php" style="font-size:10px;margin-left:15px;">v<?php echo PRODUCTVERSION;?></a></p>
     </footer>

    </div> <!-- /container -->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/scripts.js"></script>
    <script type="text/javascript">
      $(function() {
          $('#spnct_<?php echo $ctmax;?>').removeClass("label-info").addClass("label-success");
          $('#spnct_<?php echo $ctmin;?>').removeClass("label-info").addClass("label-danger");
      });
    </script>
  </body>
</html>