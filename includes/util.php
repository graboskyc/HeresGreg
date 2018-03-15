<?php
require_once('config.php');

function CreateAlert($uid, $start, $end, $msg, $type) {
    $conn = connectDB();
    $sql = "INSERT INTO `alerts` (`user_id`, `start`, `end`, `msg`, `bootstraptype`) VALUES (?, ?, ?, ?, ?);";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $uid);
    $stmt->bindValue(2, $start);
    $stmt->bindValue(3, $end);
    $stmt->bindValue(4, $msg);
    $stmt->bindValue(5, $type);
    $stmt->execute();
}

function VisionRequest($file) {

    if(strlen(AZURECOGVISKEY) > 4) {
        $image = $file . ".jpg";

        $url = 'https://'.AZURECOGVISREG.'.api.cognitive.microsoft.com/vision/v1.0/analyze?visualFeatures=Description,Tags&language=en';
        
        // Request body
        $data = '{"url":"'.SITEURL.'/media/'.$image.'"}';
        
        //open connection
        $ch = curl_init();
        
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            'Ocp-Apim-Subscription-Key: '.AZURECOGVISKEY,
                            'Content-Length: ' . strlen($data)
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        //execute post
        $response = curl_exec($ch);
        
        //close connection
        curl_close($ch);
    }
    else {
        $response = '{"tags":[], "description":{"captions":[{"text":""}]}}';
    }
        
        $conn = connectDB();
        $sql = "UPDATE media set cvajson = '".$response."' where path = '".$file."'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
}

function NewGuid(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
}

function DrawMainMenu($hideUpload, $hidRegistration) {
    ?>
    <center>
            <div class="row">
                <div class="col-xs-12"><center><h2><span class="glyphicon glyphicon-play-circle" aria-hidden="true" ></span>&nbsp;Watch Videos</h2></center></div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <button type="button" class="btn btn-warning menubtn" onclick="window.location='vidList.php?view=fav';">
                        <span class="glyphicon glyphicon-heart-empty" aria-hidden="true" ></span>
                        Favs
                    </button>
                </div>
                <div class="col-xs-6">
                    <button type="button" class="btn btn-warning menubtn" onclick="window.location='swipe.php';">
                        <span class="glyphicon glyphicon-retweet" aria-hidden="true" ></span>
                        Swipe
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <button type="button" class="btn btn-primary menubtn" onclick="window.location='dateList.php';">
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true" ></span>
                        Date
                    </button>
                </div>
                <div class="col-xs-4">
                    <button type="button" class="btn btn-primary menubtn" onclick="window.location='filterList.php';">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true" ></span>
                        Filters
                    </button>
                </div>
                <div class="col-xs-4">
                    <button type="button" class="btn btn-primary menubtn" onclick="window.location='vidList.php?';">
                        <span class="glyphicon glyphicon-time" aria-hidden="true" ></span>
                        All
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12"><center><h2><span class="glyphicon glyphicon-user" aria-hidden="true" ></span>&nbsp;Account</h2></center></div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <button type="button" class="btn btn-default menubtn" onclick="window.location='ChangeLog.php';">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                        Changes &amp; FRs
                    </button>
                </div>
                <div class="col-xs-6">
                    <button type="button" class="btn btn-danger menubtn" onclick="window.location='c_logout.php';">
                        <span class="glyphicon glyphicon-user" aria-hidden="true" ></span>
                        Log Out (<?php echo ucfirst($_SESSION['un']);?>)
                    </button>
                </div>
            </div>
 
            <div class="row">
                <div class="col-xs-12">
                    <a class="pushbullet-subscribe-widget menubtn" data-channel="Greg" data-widget="button" data-size="small"></a>
<script type="text/javascript">(function(){var a=document.createElement('script');a.type='text/javascript';a.async=true;a.src='https://widget.pushbullet.com/embed.js';var b=document.getElementsByTagName('script')[0];b.parentNode.insertBefore(a,b);})();</script>
                </div>
            </div>

      
            <?php

                if(isAdmin($_SESSION["un"])) {
                ?>
                 <div class="row">
                    <div class="col-xs-12"><center><h2><span class="glyphicon glyphicon-lock" aria-hidden="true" ></span>&nbsp;Administration</h2></center></div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                    <button type="button" class="btn btn-danger menubtn" onclick="window.location='c_manualpush.php?redir=index.php';">
                        <span class="glyphicon glyphicon-send" aria-hidden="true" ></span>
                        Pushbullet
                    </button>
                    </div>

                    <div class="col-xs-4">
                    <button type="button" class="btn btn-danger menubtn" onclick="window.location='alert.php';">
                        <span class="glyphicon glyphicon-envelope" aria-hidden="true" ></span>
                        Alert
                    </button>
                    </div>

                    <div class="col-xs-4">
                    <button type="button" class="btn btn-danger menubtn" onclick="window.location='user.php';">
                        <span class="glyphicon glyphicon-lock" aria-hidden="true" ></span>
                        Users
                    </button>
                    </div>
                </div>

                <?php

                }
                ?>
        </center>
    <?php
}

function DrawRCMenu() {
    ?>
    <center>
    <div class="row">
            <div class="col-xs-12">
                <button type="button" class="btn btn-warning filterbtn" data-filterval="" onclick="jumpToSwipeGreg(this);">
                    <span class="glyphicon glyphicon-retweet" aria-hidden="true" ></span>
                    Swipe Greg From Here
                </button>
            </div>
        </div>
    <?php
    if(isAdmin($_SESSION['un'])) {
    ?>
        <div class="row">
            <div class="col-xs-6">
                <button type="button" class="btn btn-danger filterbtn" data-filterval="" onclick="setFilterOnVid(this);">
                    <span class="glyphicon glyphicon-eye-close" aria-hidden="true" ></span>
                    Remove Filters
                </button>
            </div>
            <div class="col-xs-6">
                <button type="button" class="btn btn-success filterbtn" data-filterval="" onclick="markFavorite(this);">
                    <span class="glyphicon glyphicon-heart-empty" aria-hidden="true" ></span>
                    Toggle Favorite
                </button>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-12"><center><h2><span class="glyphicon glyphicon-eye-open" aria-hidden="true" ></span>&nbsp;Geo Filters</h2></center></div>
        </div>
        <?php
        $geoList = array();
        array_push($geoList, array('Aquarium.png',"Aquarium<br>&nbsp;"));
        array_push($geoList, array('Bowling.png',"Bowling<br>&nbsp;"));
        array_push($geoList, array('ChuckECheese.png',"Chuck E<br>Cheese"));
        array_push($geoList, array('DM.png',"Discovery<br>Museum"));
        array_push($geoList, array('FI.png',"Franklin<br>Institute"));
        array_push($geoList, array('Funplex.png',"The<br>Funplex"));
        array_push($geoList, array('Grandparents.png',"At<br>Grandparents"));
        array_push($geoList, array('Farm.png',"Johnsons<br>Farm"));
        array_push($geoList, array('KidFit.png',"Kid<br>Fit"));
        array_push($geoList, array('Library.png',"Library<br>&nbsp;"));
        array_push($geoList, array('LS.png',"Little<br>Sport"));
        array_push($geoList, array('MLA.png',"My Little<br>Adventures"));
        //array_push($geoList, array('OCMD.png',"OC<br>MD"));
        array_push($geoList, array('Park.png',"Park<br>&nbsp;"));
        array_push($geoList, array('PawsFarm.png',"Paws<br>Farm"));
        array_push($geoList, array('Philly.png',"Philly<br>&nbsp;"));
        array_push($geoList, array('PTM.png',"Plz Touch<br>Museum"));
        array_push($geoList, array('Pool.png',"Pool<br>&nbsp;"));
        array_push($geoList, array('PIU.png',"Pump It<br>Up"));
        array_push($geoList, array('Sesame.png',"Sesame<br>Place"));
        array_push($geoList, array('SixFlags.png',"Six<br>Flags"));
        array_push($geoList, array('SkyZone.png',"Sky<br>Zone"));
        array_push($geoList, array('WRS.png',"We Rock<br>Spectrum"));
        array_push($geoList, array('Zoo.png',"Zoo<br>&nbsp;"));

        $i = 0;
        $t = 0;
        foreach ($geoList as $kvp) {
            $i++;
            $t++;
            if($i == 1) { echo "<div class='row'>";}
            echo '<div class="col-xs-4">';
            echo '<button type="button" class="btn btn-primary filterbtn" data-filterval="'.$kvp[0].'" onclick="setFilterOnVid(this);">';
            echo $kvp[1];
            echo '</button>';
            echo '</div>';
            if(($i == 3) || ($t == count($geoList)))  { echo "</div>"; $i = 0;}
            
        }
        ?>

        <div class="row">
            <div class="col-xs-12"><center><h2><span class="glyphicon glyphicon-eye-open" aria-hidden="true" ></span>&nbsp;Holiday Filters</h2></center></div>
        </div>

        <?php

        $holiList = array();
        array_push($holiList, array('BDay.png',"Birth<br>Day"));
        array_push($holiList, array('Christmas.png',"Christmas<br>&nbsp;"));
        array_push($holiList, array('Carni2017.png',"Carnival<br>&nbsp;"));
        array_push($holiList, array('Halloween.png',"Halloween<br>&nbsp;"));
        array_push($holiList, array('Easter.png',"Easter<br>&nbsp;"));
        array_push($holiList, array('JulyFourth.png',"July<br>4th"));
        array_push($holiList, array('StPatrickDay.png',"St. Paddy<br>Day"));
        array_push($holiList, array('Turkey.png',"Turkey<br>Day"));
        array_push($holiList, array('VDay.png',"Valentines<br>Day"));

        $i = 0;
        $t = 0;

        foreach ($holiList as $kvp) {
            $i++;
            $t++;
            if($i == 1) { echo "<div class='row'>";}
            echo '<div class="col-xs-4">';
            echo '<button type="button" class="btn btn-info filterbtn" data-filterval="'.$kvp[0].'" onclick="setFilterOnVid(this);">';
            echo $kvp[1];
            echo '</button>';
            echo '</div>';
            if(($i == 3) || ($t == count($holiList)))  { echo "</div>"; $i = 0;}
            
        }
        ?>

        <div class="row">
            <div class="col-xs-12"><center><h2><span class="glyphicon glyphicon-eye-open" aria-hidden="true" ></span>&nbsp;Fun Filters</h2></center></div>
        </div>

        <?php
        $funList = array();
        array_push($funList, array('Car.png',"Car"));
        array_push($funList, array('Cat1.png',"Cat Fat"));
        array_push($funList, array('Cat2.png',"Cat Corner"));
        array_push($funList, array('Cookie.png',"Cookie"));
        array_push($funList, array('MCD.png',"French Fry"));
        array_push($funList, array('GB.png',"GhostBusters"));
        array_push($funList, array('Lego.png',"Lego"));
        array_push($funList, array('Mickey.png',"Mickey"));
        array_push($funList, array('Notes01.png',"Music Notes 1"));
        array_push($funList, array('Notes02.png',"Music Notes 2"));
        array_push($funList, array('Snow.png',"Snow"));
        array_push($funList, array('Train.png',"Train"));
        array_push($funList, array('Water.png',"Water"));

        $i = 0;
        $t = 0;

        foreach ($funList as $kvp) {
            $i++;
            $t++;
            if($i == 1) { echo "<div class='row'>";}
            echo '<div class="col-xs-4">';
            echo '<button type="button" class="btn btn-warning filterbtn" data-filterval="'.$kvp[0].'" onclick="setFilterOnVid(this);">';
            echo $kvp[1];
            echo '</button>';
            echo '</div>';
            if(($i == 3) || ($t == count($funList)))  { echo "</div>"; $i = 0;}
            
        }
        ?>
        

        <div class="row"> 
            <div class="col-xs-12">
                <button type="button" class="btn btn-danger filterbtn" data-filterval="" onclick="markDelete(this);">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true" ></span>
                    Delete Video
                </button>
            </div>
        </div>

        <!--
        <div class="row">
            <div class="col-xs-4">
            </div>
            <div class="col-xs-4">
            </div>
            <div class="col-xs-4">
            </div>
        </div>
        -->
    <?php
    } 
    ?>
    </center>
    <?php
}

function getDBInfo($which='qs')
{
	// connection string: Database=frsh201A4IQco2xd;Data Source=us-cdbr-azure-east-b.cloudapp.net;User Id=bbc9aaf0c6c390;Password=b2b4dd79
	if($which=='qs')
	{
                        $DB = array(
                                "host" => "localhost",
                                "username" => "app",
                                "password" => "app_password",
                                "db" => "app"
			);
	}
	else
	{
			$DB = array(
                                "host" => "us-cdbr-azure-east-b.cloudapp.net",
                                "username" => "bbc9aaf0c6c390",
                                "password" => "b2b4dd79",
                                "db" => "frsh201A4IQco2xd;"
                        );
	}
        return $DB;
}

function connectDB()
{
        $DB = getDBInfo();
        //mysql_connect($DB['host'],$DB['username'],$DB['password']) or die(mysql_error());
	//mysql_select_db($DB['db']) or die (mysql_error());

	$conn = new PDO("mysql:host=".$DB['host'].";dbname=".$DB['db'], $DB['username'], $DB['password']);
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	return $conn;
}

function closeDB()
{
        @mysql_close();
}

function updateUser($conn, $lv) {
    if($_SESSION['lv'] < $lv) {
        $sql = "UPDATE user set lastview=?, lastactivity = NOW() where user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $lv);
        $stmt->bindValue(2, $_SESSION['uid']);
        $stmt->execute();
        
        $_SESSION['lv'] = $lv;
    }
}

function isAdmin($un)
{
    global $conn;
    $sql = "Select isAdmin from user where username = '".$un."'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    $retVal = false;

    foreach($result as $r) {
        if ($r['isAdmin'] == 1) {
            $retVal = true;
        }
    }

	return $retVal;
}

function validateToken($token) {
	return true;
}

function getStats($conn) {
    $sql = "SELECT 
        (select count(id) as totalVids from media) as totalVids,
        (select count(id) as favVids from media where isFavorite = 1) as favVids,
        (select count(id) as filterVids from media where CHAR_LENGTH(filterName) > 3) as filterVids,
        (select count(DISTINCT created_by) from media) as userVids
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $statData = array();
    foreach($result as $r)
    {
            $statData["totalVids"] = $r["totalVids"];
            $statData["favVids"] = $r["favVids"];
            $statData["filterVids"] = $r["filterVids"];
            $statData["userVids"] = $r["userVids"];
    }
    return $statData;
}

function getAlerts($conn) {
    $sql = "SELECT u.username, a.msg, a.bootstraptype FROM alerts as a left join user as u on a.user_id = u.user_id WHERE start < NOW() and end > now() order by end desc limit 1";

    $retstr = "";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $statData = array();
    foreach($result as $r)
    {
        $retstr = '<div class="alert alert-'.$r['bootstraptype'].' alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$r['msg'].'</div>';
    }

    return $retstr;    
}

?>
