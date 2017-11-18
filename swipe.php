<?php
@session_start();
if(!isset($_SESSION['un']) || !isset($_SESSION['uid'])) { header('LOCATION: login.php'); }
require_once('includes/util.php');
require_once('includes/media.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$where = " ";
$orderby = " created desc ";

if(isset($_GET['id'])) {
    if($_GET['id'] == "random") { $orderby = " RAND() "; }
    else { $where = " and id = " . $_GET['id'] . " "; }
}

if(isset($_GET['swipecontrol'])) {  
    if($_GET['swipecontrol']=="left") {
        $where = " and id < " . $_GET['id'] . " ";
        $orderby = " created desc  ";
    }
    if($_GET['swipecontrol']=="right") {
        $where = " and id > " . $_GET['id'] . " ";
        $orderby = " created asc  ";
    }
}


$conn = connectDB();
$sql = "SELECT
                m.id as id,
                m.path as path,
                u.username as username,
                m.created as created,
                m.isFavorite as isFavorite,
                m.filterName as filterName
        FROM
                media m 
        LEFT join
                user u
        ON
                m.created_by = u.user_id
        WHERE
                archived = 0
                ".$where."
        ORDER BY
                ".$orderby." 
        LIMIT 1";

$stmt = $conn->prepare($sql);
try {
    $stmt->execute();
} catch (Exception $e) {
    header("LOCATION: swipe.php?id=random");
}
$result = $stmt->fetchAll();
$mediaList = array();
foreach($result as $r)
{
        $li = new MediaLI($r['id'], $r['path'], $r['created'], $r['username'], $r['isFavorite'], $r["filterName"]);
        $mediaList[0] = $li; 
}

if(!isset($_GET['id'])) {
    header("LOCATION: swipe.php?id=".$mediaList[0]->MediaID);
} elseif ($_GET['id'] == "random") {
    header("LOCATION: swipe.php?id=".$mediaList[0]->MediaID);
}

if(isset($_GET['swipecontrol'])) {
    header("LOCATION: swipe.php?id=".$mediaList[0]->MediaID);
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="favicon.ico">
    <link rel="apple-touch-icon" href="apple.png" />
    <meta name="theme-color" content="#333333" />
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
        .newVid {
            background: rgba(48, 180, 241, 0.4);
            overflow: hidden;
            height: 100%;
            z-index: 2;
            border-radius: 50%;
        }
        #jumbomainvid {
            background-color:#000000 !important;
        }
        .footer { margin-top:30px !important;}
       .filterbtn { margin-top:15px; text-align:center; width:100%; vertical-align:middle; }
       .menubtn { margin-top:15px; text-align:center; width:100%; vertical-align:middle; }
       .well { text-align:center !important;}
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
                <button type="button" class="btn btn-default" onclick="window.location='swipe.php?id=random';">
                    <span class="glyphicon glyphicon-random" aria-hidden="true" ></span>
                </button>
            </ul>
        </nav>
        <h3 class="text-muted">Here's Swipe <?php echo APPNAME;?></h3>
      </div>

      <?php 
        $wellmessage = "Swipe Left or Right";
        if($mediaList[0]->IsFavorite) {
            $wellmessage = '<span class="glyphicon glyphicon-heart-empty" aria-hidden="true" ></span>&nbsp;'.$wellmessage.'&nbsp;<span class="glyphicon glyphicon-heart-empty" aria-hidden="true" ></span>';
        }
      ?>

      <div class="well" id="swipecntr"><?php echo $wellmessage;?></div>

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
      </div>

      <div class="row">
      <div id="disqus_thread"></div>
        <script>
        var disqus_config = function () {

        this.page.url = "http://grabosky.dyndns.org:9999/media/smaller/<?php echo $mediaList[0]->Path; ?>";  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = "<?php echo $mediaList[0]->Path; ?>"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        
        (function() { 
        var d = document, s = d.createElement('script');
        s.src = '//greg-grabosky-net.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                                        
      </div>

      <div class="modal fade" tabindex="-1" role="dialog" id="filterModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Video Settings</h4>
      </div>
      <div class="modal-body">
        <?php DrawRCMenu(); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
     
     <footer class="footer" style="margin-top: 0px auto;border-top: transparent solid 10px;">
          <p class="text-right" style="margin-top:-40px !important; border-top:solid 3px #cccccc;padding:10px;">Made with &nbsp; ❤️ &nbsp; for Greg <a href="ChangeLog.php" style="font-size:10px;margin-left:15px;">v<?php echo PRODUCTVERSION;?></a></p>
     </footer>

    </div> <!-- /container -->
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/scripts.js"></script> 
    <script src="js/touchSwipe.js"></script> 
    <script>
        $(function() {
            $("#swipecntr, #jumbomainvid, #mainvid").swipe( {
                //Generic swipe handler for all directions
                swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
                    if(direction == "left") { window.location="swipe.php?id=<?php echo $_GET['id'];?>&swipecontrol=left";}
                    if(direction == "right") { window.location="swipe.php?id=<?php echo $_GET['id'];?>&swipecontrol=right";}
                    if(direction == "up") { window.location='swipe.php?id=random';}
                    if(direction == "down") { $('#filterModal').modal('show'); }
                }
            });
        });
        function setFilterOnVid(e) {
            var id = '<?php echo $_GET['id']; ?>';
            var filterName = $(e).attr("data-filterval");
            window.location = "c_addFilter.php?id="+id+"&filter="+filterName+"&redir=<?php echo $_SERVER["REQUEST_URI"]; ?>";
        }
        function jumpToSwipeGreg(e) {
            var id = '<?php echo $_GET['id']; ?>';
            window.location = "swipe.php?id="+id;
        }
        function markFavorite(e) {
            var id = '<?php echo $_GET['id']; ?>';
            window.location = "c_markFavorite.php?id="+id+"&redir=<?php echo $_SERVER["REQUEST_URI"]; ?>";
        }
    </script>
  </body>
</html>

<?php
    closeDB();
?>