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
        ul li { text-align:left; font-size:16px; }
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
        <h3 class="text-muted">Here's What's Changed</h3>
      </div>

      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
              <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                V1.0 <span class="smallvnote">(click to expand)</span>
              </a>
            </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
             <ul><li>Basic functionality of upload and show last few videos</li></ul>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingTwo">
            <h4 class="panel-title">
              <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                V1.1 <span class="smallvnote">(click to expand)</span>
              </a>
            </h4>
          </div>
          <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
             <ul><li>Added ffmpeg support to batch resize videos to better streaming quality</li></ul>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingThree">
            <h4 class="panel-title">
              <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                V1.5 <span class="smallvnote">(click to expand)</span>
              </a>
            </h4>
          </div>
          <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
            <div class="panel-body">
              <ul><li>Made circles for previous videos</li>
              <li>Added "Old Videos" page</li>
              <li>Added blue overlay for new (unwatched) videos</li></ul>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingFour">
            <h4 class="panel-title">
              <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                V2.0 <span class="smallvnote">(click to expand)</span>
              </a>
            </h4>
          </div>
          <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
            <div class="panel-body">
              <ul><li>Can delete (archive) videos</li>
              <li>Can favorite videos and view just favorites</li>
              <li>Cleaned up UI a bit with colored buttons in menus and black bg</li></ul>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingFive">
            <h4 class="panel-title">
              <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                V2.1 <span class="smallvnote">(click to expand)</span>
              </a>
            </h4>
          </div>
          <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
            <div class="panel-body">
              <ul><li>Comments!</li></ul>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingSix">
            <h4 class="panel-title">
              <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                V2.2 <span class="smallvnote">(click to expand)</span>
              </a>
            </h4>
          </div>
          <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
            <div class="panel-body">
              <ul><li>Cleaning up UI/UI refinement</li>
              <li>Filter overlays!</li></ul>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingSeven">
            <h4 class="panel-title">
              <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                V2.3 <span class="smallvnote">(click to expand)</span>
              </a>
            </h4>
          </div>
          <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
            <div class="panel-body">
              <ul><li>Cleaning up menus</li>
              <li>Permissions for setting favorites and filters</li>
              <li>More views for older videos</li></ul>
            </div>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingEight">
            <h4 class="panel-title">
              <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
                V2.4 and 2.4.1 and 2.4.2 <span class="smallvnote">(click to expand)</span>
              </a>
            </h4>
          </div>
          <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
            <div class="panel-body">
              <ul><li>Swipe thru page and random vid page</li>
              <li>More overlay filters</li>
              <li>Jump to Swipe Greg from RCMenu</li>
              <li>Added ability to set filters (swipe down) and random swipe (swipe up) on Swipe Greg</li></ul>
            </div>
          </div>
        </div>

        <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingNine">
          <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
              V2.5 <span class="smallvnote">(click to expand)</span>
            </a>
          </h4>
        </div>
        <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">
          <div class="panel-body">
            <ul><li>New <a href="dateList.php">Date List</a> page</li></ul>
          </div>
        </div>
        </div>

          <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingTen">
            <h4 class="panel-title">
              <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="true" aria-controls="collapseTen">
                V2.6 <span class="smallvnote">(click to expand)</span>
              </a>
            </h4>
          </div>
          <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen">
            <div class="panel-body">
              <ul><li>Gif support</li></ul>
            </div>
          </div>
          </div>

          <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingEleven">
            <h4 class="panel-title">
              <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven" aria-expanded="true" aria-controls="collapseEleven">
                V2.7 <span class="smallvnote">(click to expand)</span>
              </a>
            </h4>
          </div>
          <div id="collapseEleven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEleven">
            <div class="panel-body">
              <ul><li>Every week says "This Week In Greg" as a throwback</li>
              <li>Chuck E Cheese and OC MD Filters</li></ul>
            </div>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingTwelve">
            <h4 class="panel-title">
              <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwelve" aria-expanded="true" aria-controls="collapseTwelve">
                V2.8 <span class="smallvnote">(click to expand)</span>
              </a>
            </h4>
          </div>
          <div id="collapseTwelve" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwelve">
            <div class="panel-body">
              <ul><li>Code cleanup for reuse and moved into docker container on top of Linux</li></ul>
            </div>
          </div>
        </div>

        <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingThirteen">
          <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThirteen" aria-expanded="true" aria-controls="collapseThirteen">
              V2.9 <span class="smallvnote">(click to expand)</span>
            </a>
          </h4>
        </div>
        <div id="collapseThirteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThirteen">
          <div class="panel-body">
            <ul><li>Added utility to put on alert messages on home page</li>
            <li>New favicons</li>
            <li>More clean support for multiple installs</li>
            <li>Simplified menus since no one records live anymore</li>
            <li>Added admin tools for creating alerts and users</li>
            <li>New Filter page since quantity of videos is huge</li></ul>
          </div>
        </div>
      </div>

      <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="heading14">
            <h4 class="panel-title">
              <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse14" aria-expanded="true" aria-controls="collapse14">
                V2.10 <span class="smallvnote">(click to expand)</span>
              </a>
            </h4>
          </div>
          <div id="collapse14" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading14">
            <div class="panel-body">
              <ul><li>New birthday overlay</li>
              <li>Implemented azure cognitive vision API</li></ul>
            </div>
          </div>
      </div>

      <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="heading15">
        <h4 class="panel-title">
          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse15" aria-expanded="true" aria-controls="collapse15">
            V2.20 &amp; V2.21<span class="smallvnote">(click to expand)</span>
          </a>
        </h4>
      </div>
      <div id="collapse15" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading15">
        <div class="panel-body">
          <ul><li>New overlays for bowling, kidfit, buildabear, paws farm, autoshow, church, 4th of july, pool, wizard world, library, snow, and others</li>
          <li>Better handling of vision api errors</li>
          <li>Can control swipe page with keyboard arrow keys</li>
          <li>Fixed last activity bug</li></ul>
        </div>
      </div>
      </div>

      <!-- I always mess up this changelog so this is good. copy paste here -->

      <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="heading16">
            <h4 class="panel-title">
              <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse16" aria-expanded="true" aria-controls="collapse16">
                V2.30 &amp; v2.40<span class="smallvnote">(click to expand)</span>
              </a>
            </h4>
          </div>
          <div id="collapse16" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading16">
            <div class="panel-body">
              <ul><li>renamed all admin pages with a_ prefix for easier management</li>
              <li>Moved db connection details to config.php rather than hard coded</li>
              <li>Can delete users</li>
              <li>Put QR code generator on users page</li>
              <li>Filters are now stored in db rather than hard coded</li>
              <li>Added admin page to upload new filters</li>
              <li>Filters can be viewed by admin and disabled.</li>
              <li>Search box to search through old videos</li></ul>
            </div>
          </div>
      </div>


      <!-- do not copy/paste below -->

      </div>

      <?php
         $conn = connectDB();
         $statData = getStats($conn);
      ?>

      <div class="well" >
        <h1>Fun Stuff</h1>
        <ul>
            <li><span class="label label-success widelbl"><span class="glyphicon glyphicon-film" aria-hidden="true"></span>&nbsp;<?php echo $statData["totalVids"];?></i></span> <b>Total Videos</b></li>
            <li><span class="label label-warning widelbl"><span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span>&nbsp;<?php echo $statData["favVids"];?></i></span> <b>Favorite Videos</b></li>
            <li><span class="label label-primary widelbl"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp;<?php echo $statData["filterVids"];?></i></span> <b>Videos With Filters</b></li>
            <li><span class="label label-danger widelbl"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;<?php echo $statData["userVids"];?></i></span> <b> People Have Uploaded Videos</b></li>
        </ul>
      </div>

      <div class="well">
      <h1>Feature Request List</h1>
      <div id="disqus_thread"></div>
        <script>
        var disqus_config = function () {

        this.page.url = "<?php echo SITEURL; ?>/ChangeLog.php";  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = "CHANGELOG"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
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

      <footer class="footer" style="margin-top: 0px auto;border-top: transparent solid 10px;">
          <p class="text-right" style="margin-top:-40px !important; border-top:solid 3px #cccccc;padding:10px;">Made with &nbsp; ❤️ &nbsp; for Greg <a href="ChangeLog.php" style="font-size:10px;margin-left:15px;">v<?php echo PRODUCTVERSION;?></a></p>
     </footer>

    </div> <!-- /container -->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>