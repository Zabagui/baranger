<?php
$nodate = $nodate_all = "0000-00-00";
$eventctr = $eventctr_all = 1;
$fullevents = isset($full) ? 1 : 0;

function setMinEvent( $data, $datetr ) {
	global $eventctr, $events, $nodate, $eventctr_all, $nodate_all;

	if(trim($data['date']) || trim($data['place'])) {
		//make a copy of datetr
		$datetr_all = $datetr;
		if( $datetr_all == "0000-00-00" )
			$datetr_all = $nodate_all;
		elseif( $datetr_all > $nodate_all )
			$nodate_all = $datetr_all;
		$index_all = $datetr_all . sprintf( "%03d", $eventctr_all );
		$eventctr_all++;

		if( $datetr == "0000-00-00" )
			$datetr = $nodate;
		elseif( $datetr > $nodate )
			$nodate = $datetr;
		$index = $datetr . sprintf( "%03d", $eventctr );
		$events[$index] = $data;
		$eventctr++;
	}
}

function api_person($row, $fullevents = false) {
    global $lnprefixes, $text, $rights, $events;

    $person = "\"id\":\"{$row['personID']}\",\"tree\":\"{$row['gedcom']}\",";
    if($row['allow_living'] ) {
        $firstname = $row['firstname'];
        $lnprefix = $lnprefixes ? $row['lnprefix'] : "";
        $lastname = $row['lastname'];
        $title = $row['title'];
        $prefix = $row['prefix'];
        $suffix = $row['suffix'];
        $nickname = $row['nickname'];
    }
    else {
        $firstname = $text['living'];
        $lnprefix = $lastname = $title = $prefix = $suffix = $nickname = "";
    }
    $person .= "\"firstname\":\"$firstname\",\"lnprefix\":\"$lnprefix\",\"lastname\":\"$lastname\",";
    $person .= "\"title\":\"$title\",\"prefix\":\"$prefix\",\"suffix\":\"$suffix\",\"nickname\":\"$nickname\",\"gender\":\"{$row['sex']}\",\"changedate\":\"" . displayDate($row['changedate'], false) . "\"";

    if($row['allow_living'] && $row['allow_private'] ) {
        setMinEvent( array( "date"=>$row['birthdate'], "place"=>$row['birthplace'], "event"=>"BIRT" ), $row['birthdatetr'] );
        setMinEvent( array( "date"=>$row['altbirthdate'], "place"=>$row['altbirthplace'], "event"=>"CHR" ), $row['altbirthdatetr'] );

        if( $fullevents && $rights['lds'] ) {
            setMinEvent( array( "date"=>$row['baptdate'], "place"=>$row['baptplace'], "event"=>"BAPL" ), $row['baptdatetr'] );
            setMinEvent( array( "date"=>$row['confdate'], "place"=>$row['confplace'], "event"=>"CONL" ), $row['confdatetr'] );
            setMinEvent( array( "date"=>$row['initdate'], "place"=>$row['initplace'], "event"=>"INIT" ), $row['initdatetr'] );
            setMinEvent( array( "date"=>$row['endldate'], "place"=>$row['endlplace'], "event"=>"ENDL" ), $row['endldatetr'] );
        }

        if($fullevents)
            doCustomEvents($personID,"I");

        setMinEvent( array( "date"=>$row['deathdate'], "place"=>$row['deathplace'], "event"=>"DEAT" ), $row['deathdatetr'] );
        setMinEvent( array( "date"=>$row['burialdate'], "place"=>$row['burialplace'], "event"=>"BURI" ), $row['burialdatetr'] );
    }

    $eventstr = processEvents($events);
    if($eventstr)
        $person .= "," . $eventstr;

    return $person;
}

function processEvents($events) {
    $output = "";
    if(count($events)) {
        ksort( $events );
        $output .= "\"events\":[";
        $counter = 0;
        foreach( $events as $event ) {
            if($counter) $output .= ",";
            $output .= "{\"tag\":\"{$event['event']}\",\"type\":\"{$event['type']}\",\"date\":\"{$event['date']}\",\"place\":\"{$event['place']}\",\"fact\":\"{$event['fact']}\"}";
            $counter++;
        }
        $output .= "]";
    }
    return $output;
}
?>