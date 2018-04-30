<?php
date_default_timezone_set('America/New_York');
require_once('util.php');

class MediaLI {
    
    public $MediaID = "";
    public $Path = "";
    public $CreatedDTS = "";
    public $TimeSinceS = "";
    private $CreatedDT = "";
    private $TimeSince = "";
    public $CreatedBy = "";
    public $Filter = "";
    public $CVAJSON = "";
    public $BabyColor = "";

    public function __construct($mid, $path, $cdt, $cb, $if, $f="", $cva="{}", $babycolor="000000")
    {
        $this->MediaID = $mid;
        $this->Path = $path;
        $this->CreatedDTS = $cdt;
        $this->CreatedBy = $cb;
        $this->IsFavorite = $if;
        $this->Filter = $f;
        $this->BabyColor = $babycolor;

        if(strpos($cva, "invalid subscription key") > -1) {
            $now = date("Y-m-d H:i:s");
            $tomorrow = date("Y-m-d H:i:s", strtotime("+1 day"));
            CreateAlert("99", $now, $tomorrow, "Azure subscription is expired!", "danger" );
            $cva = '{"tags":[{"name":"Invalid Azure Key!","confidence":1}],"description":{"tags":["Invalid Azure Key!"],"captions":[{"text":"Invalid Azure Key!","confidence":1}]},"requestId":"","metadata":{"height":1080,"width":1920,"format":"Jpeg"}}';
        } 

        if(strlen($cva) < 10) {
            $now = date("Y-m-d H:i:s");
            $tomorrow = date("Y-m-d H:i:s", strtotime("+1 day"));
            CreateAlert("99", $now, $tomorrow, "Media ID ".$this->MediaID." missing CVA", "warning" );
            $cva = '{"tags":[{"name":"MISSING CVA JSON!","confidence":1}],"description":{"tags":["MISSING CVA JSON!"],"captions":[{"text":"MISSING CVA JSON!","confidence":1}]},"requestId":"","metadata":{"height":1080,"width":1920,"format":"Jpeg"}}';
        }

        $this->CVAJSON = json_decode($cva);
        
        $this->CreatedDT = strtotime($cdt);
        $now = strtotime("now");
        $delta = $now - $this->CreatedDT;

        $today = new DateTime(); // This object represents current date/time
        $today->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison
        $match_date = new DateTime( $cdt );
        $match_date->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison
        $diff = $today->diff( $match_date );
        $diffDays = (integer)$diff->format( "%R%a" ); // Extract days count in interval

        if ($delta < 60) { $msg = "Now";}
        elseif (($delta/60) < 61) { $msg = "Minutes ago";}
        elseif (($delta/60) < 121) { $msg = "Recently";}
        elseif ($diffDays == 0) { $msg = "Today";}
        elseif ($diffDays == -1) { $msg = "Yesterday";}
        else { $msg = date("n/j", $this->CreatedDT);}
        $this->TimeSinceS = $msg ;
    }
}

?>
