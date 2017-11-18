<?php
date_default_timezone_set('America/New_York');

class MediaLI {
    
    public $MediaID = "";
    public $Path = "";
    public $CreatedDTS = "";
    public $TimeSinceS = "";
    private $CreatedDT = "";
    private $TimeSince = "";
    public $CreatedBy = "";
    public $Filter = "";

    public function __construct($mid, $path, $cdt, $cb, $if, $f="")
    {
        $this->MediaID = $mid;
        $this->Path = $path;
        $this->CreatedDTS = $cdt;
        $this->CreatedBy = $cb;
        $this->IsFavorite = $if;
        $this->Filter = $f;
        
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
