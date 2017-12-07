<?php
@session_start();
if(!isset($_SESSION['un']) || !isset($_SESSION['uid'])) { header('LOCATION: login.php'); }
require_once('includes/util.php');
require_once('includes/media.php');

$andfav = "";
$pageName = "Old";
if(isset($_GET['view'])) { 
  if($_GET['view']=="fav") {
    $andfav = " AND isFavorite = 1 "; $pageName = "Fav";
  }
  if($_GET['view']=="month") {
    $andfav = " AND created >= (CURDATE() - INTERVAL 1 MONTH) "; $pageName = "Recent";
  }
  if($_GET['view']=="filter") {
    $andfav = " AND CHAR_LENGTH(filterName) > 3 "; $pageName = "Filter";
  }
  if(strpos($_GET['view'], "_")) {
    $d = explode("_",$_GET['view']);
    if($d[0]=="filter") {
      $andfav = " AND filterName='".$d[1]."' "; $pageName = "Filter";
    }
    else {
      $andfav = " AND MONTH(created)=".$d[1]." AND YEAR(created)=".$d[0]." "; $pageName = "Year";
    }
  }
}
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

    <script>
      function filterMenu(id) {
            $(".filterbtn").attr("data-vidid", id);
            $('#filterModal').modal('show');
        }
        function setFilterOnVid(e) {
            var id = $(e).attr("data-vidid");
            var filterName = $(e).attr("data-filterval");
            window.location = "c_addFilter.php?id="+id+"&filter="+filterName+"&redir=<?php echo $_SERVER["REQUEST_URI"]; ?>";
        }
        function jumpToSwipeGreg(e) {
            var id = $(e).attr("data-vidid");
            window.location = "swipe.php?id="+id;
        }
        function markFavorite(e) {
            var id = $(e).attr("data-vidid");
            window.location = "c_markFavorite.php?id="+id+"&redir=<?php echo $_SERVER["REQUEST_URI"]; ?>";
        }
    </script>
    <style>
        #jumbomainvid {
            background-color:#000000 !important;
        }
        body {
            background-color:#eee !important;
        }
        .footer { margin-top:30px !important;}
        .filterbtn { margin-top:15px; text-align:center; width:100%; vertical-align:middle; }
        .menubtn { margin-top:15px; text-align:center; width:100%; vertical-align:middle; }
    </style>
  </head>
  
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $wherecount = "";
    if (isset($_GET['startid']) && isset($_GET['endid'])) {
      $wherecount = "id BETWEEN " . $_GET['startid'] . " AND " . $_GET['endid'] . " AND ";
    }
    
    $conn = connectDB();
    $sql = "SELECT
                    m.id as id,
                    m.path as path,
                    u.username as username,
                    m.created as created,
                    m.isFavorite as isFavorite,
                    m.filterName as filterName,
                    m.cvajson as cva
            FROM
                    media m 
            LEFT join
                    user u
            ON
                    m.created_by = u.user_id
            WHERE
                    " . $wherecount . " 
                    archived = 0 " . $andfav . "
            ORDER BY
                    created desc";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $mediaList = array();
    foreach($result as $r)
    {
            $li = new MediaLI($r['id'], $r['path'], $r['created'], $r['username'], $r['isFavorite'], $r["filterName"], $r['cva']);
            $mediaList[] = $li;
    }
    ?>

  <body>

    <div class="container">
      <div class="header clearfix">
        <nav>
            <ul class="nav nav-pills pull-right">
                <button type="button" class="btn btn-default" onclick="window.location='index.php';">
                    <span class="glyphicon glyphicon-home" aria-hidden="true" ></span>
                </button>
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" href="#myModal">
                    <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true" ></span>
                </button>
            </ul>
        </nav>
        <h3 class="text-muted">Here's <?php echo $pageName;?> <?php echo APPNAME;?>  <span class="badge" id="txt_ct"><?php echo sizeof($mediaList); ?></span></h3>
      </div>
      
      <div class="jumbotron" id="jumbomainvid">
       <div id="vidcntr" style="position: relative;" class="rr">
            <video controls loop autoplay width="100%" height="100%" id="mainvid" onplay="responsiveVidResize()"  class="rr">
                <source src="media/smaller/<?php echo $mediaList[0]->Path; ?>" type="video/mp4">
            </video>
        </div>
        <div id="jumbooverlay" style="position: relative; display:none;"  class="rr" onclick="toggleVidPlay()">
            <?php
                $overlayImgSrc = "";
                if(strlen($mediaList[0]->Filter)>3){ $overlayImgSrc = "overlays/".$mediaList[0]->Filter;}
            ?>
            <img class="rr" id="overlayimage" src="<?php echo $overlayImgSrc ?>" />
        </div>
        <h6 style="font-size:18px;color:#fff !important;" id="jumbomainvidtitle"></h6>
      </div>

      <div class="row">
      <div id="disqus_thread"></div>
        <script>
        var disqus_config = function () {

        this.page.url = "<?php echo SITEURL; ?>media/smaller/<?php echo $mediaList[0]->Path; ?>";  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = "<?php echo $mediaList[0]->Path; ?>"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        
        (function() { 
        var d = document, s = d.createElement('script');
        s.src = '//<?php echo DISQUSURL; ?>.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                                        
      </div>
     <div class="row"></div>
      
          <?php
          $i = 0;
          foreach ($mediaList as $item) {
            
            if($i == 0) { echo '<!--BEGIN Row--><div class="row" style="margin-bottom:40px;" >'; }

                $tagList = array();
                foreach($item->CVAJSON->tags as $tag) {
                  array_push($tagList, $tag->name);
                }

                echo '<div class="col-xs-4" onclick="setMain(\''.$item->Path.'\', this);" data-filter="'.$item->Filter.'" data-cvajson=\''.implode(", ",$tagList).'\'><center>';
                    
                    if($item->IsFavorite == 1) { echo '<div class="vidThumb" data-filter="'.$item->Filter.'" style="background: url(media/'.$item->Path.'.jpg);background-size:cover;background-repeat:no-repeat;height:64px;width:64px;background-position: center center;z-index:0;margin: 0 auto; polygon(50% 0, 100% 15%, 100% 85%, 50% 100%, 0 85%, 0 15%); -webkit-clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);" oncontextmenu="filterMenu(\''.$item->MediaID.'\');return false;"></div>'; }
                    else { echo '<div class="vidThumb" data-filter="'.$item->Filter.'"  oncontextmenu="filterMenu(\''.$item->MediaID.'\');return false;" style="border-radius: 50%;background: url(media/'.$item->Path.'.jpg);background-size:cover;background-repeat:no-repeat;height:64px;width:64px;background-position: center center;z-index:0;"></div>'; }
                    echo "<br>";
                    if(strlen($item->Filter)>3) { echo '<span class="glyphicon glyphicon-eye-open" aria-hidden="true" ></span>&nbsp;';}
                    echo ucfirst($item->CreatedBy);
                    //if(strlen($item->Filter)>3) { echo "</b>";}
                    echo "<br>";
                    echo $item->TimeSinceS;
                echo '</center></div>';

            if($i == 2) { echo '</div><!--END Row-->'; }
            echo "\r\n"."\r\n";
            
            $i++;

            if($i == 3) { $i = 0; }
          }
          if($i != 0 ) { echo '</div><!--END Row-->'; }
          ?>


      <footer class="footer" style="margin-top: 0px auto;border-top: transparent solid 10px;">
          <p class="text-right" style="margin-top:-40px !important; border-top:solid 3px #cccccc;padding:10px;">Made with &nbsp; ❤️ &nbsp; for Greg <a href="ChangeLog.php" style="font-size:10px;margin-left:15px;">v<?php echo PRODUCTVERSION;?></a></p>
     </footer>

    </div> <!-- /container -->
    
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">App Menu</h4>
      </div>
      <div class="modal-body">
        <?php DrawMainMenu(true,true); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="filterModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Video Menu</h4>
      </div>
      <div class="modal-body">
        <?php DrawRCMenu(); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>

<?php
    closeDB();
?>