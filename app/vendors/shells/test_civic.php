<?php

App::import('Lib', 'CivicCalendar');

/**
 * Call this (from cron)
 * > cake update_all
 * @author rahulb
 *
 */
class TestCivicShell extends Shell {
    
    var $tasks = array('DisplayManagement');
   
    function main() {
        date_default_timezone_set('UTC');
        
        $cal = new CivicCalendar();
        $events = $cal->getUpcomingEvents('America/New_York');

        foreach($events as $info){
            $ongoinStr = ($info['ongoing']) ? "ongoing" : "one-time";
            $dateStr = date("Y-m-d H:i:s",$info['startdate']);
            $infoStr = " (".$ongoinStr.") from ".$info['src'];
            $this->out($dateStr." : ".$info['summary']);
            $this->out(" ".$infoStr);
            $this->out("  @ ".$info['location']);        
        }
        
    }
    
}

?>