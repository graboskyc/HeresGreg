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

        this.page.url = "http://grabosky.dyndns.org:9999/ChangeLog.php";  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = "CHANGELOG"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
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