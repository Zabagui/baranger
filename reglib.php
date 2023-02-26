<?php
function getSpouses( $personID, $sex ) {
	global $tree, $righttree;

	$spouses = array();
	if( $sex == "M" ) {
		$self = "husband";
		$spouse = "wife";
		$spouseorder = "husborder";
	}
	else if( $sex == "F" ){
		$self = "wife";
		$spouse = "husband";
		$spouseorder = "wifeorder";
	}
	else {
		$self = $spouse = $spouseorder = "";
	}

	if( $spouse )
		$result = getSpouseFamilyData($tree, $self, $personID, $spouseorder);
	else
		$result = getSpouseFamilyDataUnion($tree, $personID, $spouseorder);
	$marrtot = tng_num_rows($result);
	if( !$marrtot ) {
		$result = getSpouseFamilyDataUnion($tree, $personID, $spouseorder);
		$self = $spouse = $spouseorder = "";
	}
	while( $row = tng_fetch_assoc( $result ) ) {
		if( !$spouse )
			$spouse = $row['husband'] == $personID ? "wife" : "husband";
		$result2 = getPersonData($tree, $row[$spouse]);
		$spouserow =  tng_fetch_assoc( $result2 );
		$spouserow['gedcom'] = $row['gedcom'];
		$spouserow['husband'] = $row['husband'];
		$spouserow['wife'] = $row['wife'];
		$spouserow['familyID'] = $row['familyID'];
		$spouserow['marrdate'] = $row['marrdate'];
		$spouserow['marrdatetr'] = $row['marrdatetr'];
		$spouserow['marrplace'] = $row['marrplace'];
		$spouserow['marrtype'] = $row['marrtype'];
		$spouserow['divdate'] = $row['divdate'];
		$spouserow['divdatetr'] = $row['divdatetr'];
		$spouserow['divplace'] = $row['divplace'];
		$spouserow['living'] = $row['living'];
		$spouserow['private'] = $row['private'];
		$spouserow['branch'] = $row['branch'];

		$famrights = determineLivingPrivateRights($row, $righttree);
		$sprights = determineLivingPrivateRights($spouserow, $righttree);
		$spouserow['allow_living'] = $sprights['living'] && $famrights['living'];
		$spouserow['allow_private'] = $sprights['private'] && $famrights['private'];

		$spouserow['name'] = !empty($spouserow[$spouse]) ? getName( $spouserow ) : "";
		array_push( $spouses, $spouserow );
	}
	tng_free_result( $result );

	return $spouses;
}

function getSpouseParents( $personID, $sex) {
	global $tree, $righttree, $text, $admtext, $getperson_url;

	if( $sex == "M" ) {
		$childtext = $text['sonof'];
	}
	else if( $sex == "F" ){
		$childtext = $text['daughterof'];
	}
	else {
		$childtext = $text['childof'];
	}

	$allparents = "";
	$parents = getChildFamily($tree, $personID, "ordernum");

	if ( $parents && tng_num_rows( $parents ) ) {
		while ( $parent = tng_fetch_assoc( $parents ) )
		{
			$parentstr = "";
			$gotfather = getParentData($tree, $parent['familyID'], "husband");

			$fathrow =  tng_fetch_assoc( $gotfather );
			if( $fathrow ) {
				if( $fathrow['firstname'] || $fathrow['lastname'] ) {
					$frights = determineLivingPrivateRights($fathrow, $righttree);
					$fathrow['allow_living'] = $frights['living'];
					$fathrow['allow_private'] = $frights['private'];
					$fathname = getName( $fathrow );
					//if( $fathrow['name'] == $text['living'] ) $fathrow['firstname'] = $text['living'];
					//if( $fathrow['name'] == $admtext['text_private'] ) $fathrow['firstname'] = $admtext['text_private'];
					$parentstr .= "<a href=\"#\" onclick=\"if(jQuery('#p{$fathrow['personID']}').length) {jQuery('html, body').animate({scrollTop: jQuery('#p{$fathrow['personID']}').offset().top-10},'slow');}else{window.location.href='$getperson_url" . "personID={$fathrow['personID']}&amp;tree=$tree';} return false;\">$fathname</a>";
				}
				tng_free_result( $gotfather );
			}

			$gotmother = getParentData($tree, $parent['familyID'], "wife");

			$mothrow =  tng_fetch_assoc( $gotmother );
			if( $mothrow ) {
				if( $mothrow['firstname'] || $mothrow['lastname'] ) {
					$mrights = determineLivingPrivateRights($mothrow, $righttree);
					$mothrow['allow_living'] = $mrights['living'];
					$mothrow['allow_private'] = $mrights['private'];
					$mothname = getName( $mothrow );
					//if( $mothrow['name'] == $text['living'] ) $mothrow['firstname'] = $text['living'];
					//if( $mothrow['name'] == $admtext['text_private'] ) $mothrow['firstname'] = $admtext['text_private'];
					if( $parentstr ) $parentstr .= " {$text['text_and']} ";
					$parentstr .= "<a href=\"#\" onclick=\"if(jQuery('#p{$mothrow['personID']}').length) {jQuery('html, body').animate({scrollTop: jQuery('#p{$mothrow['personID']}').offset().top-10},'slow');}else{window.location.href='$getperson_url" . "personID={$mothrow['personID']}&amp;tree=$tree';} return false;\">$mothname</a>";
				}
				tng_free_result( $gotmother );
			}
			if( $parentstr ) {
				$parentstr = "$childtext $parentstr";
				$allparents .= $allparents ? ", $parentstr" : $parentstr;
			}
		}
		tng_free_result($parents);
	}
	if( $allparents ) $allparents = "($allparents)";

	return $allparents;
}

function getVitalDates( $row, $needparents = null ) {
	global $text;

	$vitalinfo = "";

	if( $row['allow_living'] && $row['allow_private'] ) {
		if( !empty($row['birthdate']) || !empty($row['birthplace']) ) {
			$bornmsg = ($row['sex'] == "F") ? $text['wasborn_female'] : $text['wasborn_male'];
			$vitalinfo .= " " . $bornmsg . printDate( $row['birthdatetr'], $row['birthdate'] );
			if(!empty($row['birthplace']))
				$vitalinfo .= " " . trim($text['inplace']) . " " . $row['birthplace'];
		}
		if( !empty($row['altbirthdate']) || !empty($row['altbirthplace']) ){
			if( $vitalinfo ) $vitalinfo .= ";";
			$christenedmsg = ($row['sex'] == "F") ? $text['waschristened_female'] : $text['waschristened_male'];
			$vitalinfo .= " " . $christenedmsg .  printDate( $row['altbirthdatetr'], $row['altbirthdate'] );
			if(!empty($row['altbirthplace']))
				$vitalinfo .= " " . trim($text['inplace']) . " " . $row['altbirthplace'];
		}
		if($needparents) {
			$spparents = getSpouseParents($row['personID'], $row['sex']);
			if($spparents) $vitalinfo .= " " . $spparents;
		}

		if( !empty($row['deathdate']) || !empty($row['deathplace']) ) {
			if( $vitalinfo ) $vitalinfo .= ";";
			$diedmsg = ($row['sex'] == "F") ? $text['died_female'] : $text['died_male'];
			if($row['deathdate'] == "Y")
				$vitalinfo .=  " " . $text['and'] . $diedmsg;
			else {
				$vitalinfo .= " " . $diedmsg . printDate( $row['deathdatetr'], $row['deathdate'] );
				}
			if(!empty($row['deathplace']))
				$vitalinfo .= $text['inplace'] . $row['deathplace'];
		}
		if( !empty($row['burialdate']) || !empty($row['burialplace']) ){
			if( $vitalinfo ) $vitalinfo .= ";";
			$buriedmsg = ($row['sex'] == "F") ? $text['wasburied_female'] : $text['wasburied_male'];
			$crematedmsg = ($row['sex'] == "F") ? $text['wascremated_female'] : $text['wascremated_male'];
			$burialmsg = $row['burialtype'] ? $crematedmsg : $buriedmsg;
			if (substr($row['burialdatetr'],0,10) == "0000-00-00")  // no date
				$vitalinfo .= " $burialmsg " ;
			else {
				$vitalinfo .= " " . $burialmsg . printDate( $row['burialdatetr'], $row['burialdate'] );
				}
			if(!empty($row['burialplace']))
				$vitalinfo .= $text['inplace'] . $row['burialplace'];
		}
	}
	if( $vitalinfo ) $vitalinfo .= ". ";
	return $vitalinfo;
}

function getSpouseDates( $row , $personsex) {
	global $text;

	$spouseinfo = "";

	if( $row['allow_living'] && $row['allow_private'] ) {
		if( $row['marrdate'] || $row['marrplace'] || $row['marrtype'] ) {
			$spouseinfo .= printDate( $row['marrdatetr'], $row['marrdate'] );
			if( $row['marrtype'] ) $spouseinfo .= " ({$row['marrtype']})";
			if( ( $row['marrdate'] || $row['marrtype'] ) && $row['marrplace'] )
				$spouseinfo .= $text['inplace'];
			$spouseinfo .= $row['marrplace'];
		}
		if($row['divdate'] || $row['divplace']) {
			$divorcemsg = ($personsex == "F") ? $text['wasdivorced_female'] :  $text['wasdivorced_male'];
			if($row['divdate']) {
				if($row['divdate'] == "Y")
					$spouseinfo .= ", " . $text['and'] . $divorcemsg;
				else
					$spouseinfo .= ", " . $text['and'] . $divorcemsg . "  " .  printDate($row['divdatetr'], $row['divdate']);
			}
			if($row['divplace'])
				$spouseinfo .= "  " . $text['inplace'] . $row['divplace'];
			//$spouseinfo .= ". ";
		}
	}
	if( $spouseinfo ) $spouseinfo .= ".";
	return $spouseinfo;
}

function getOtherEvents($row) {
	global $tree, $eventtypes_table, $events_table, $text, $pedigree;

	$otherEvents = "";
	if($pedigree['regnotes'] && $row['allow_living'] && $row['allow_private']) {
		$query = "SELECT display, eventdate, eventdatetr, eventplace, age, agency, cause, addressID, info, tag, description, eventID FROM ($events_table, $eventtypes_table) WHERE persfamID = \"{$row['personID']}\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID AND gedcom = \"$tree\" AND keep = \"1\" AND parenttag = \"\" ORDER BY eventdatetr, ordernum, tag, description, info, eventID";
		$custevents = tng_query($query);
		while ( $custevent = tng_fetch_assoc( $custevents ) )	{
			$displayval = getEventDisplay( $custevent['display'] );
			$fact = array();
			if( $custevent['info'] ) {
				$fact = checkXnote( $custevent['info'] );
				if(!empty($fact[1])) {
					$xnote = $fact[1];
					array_pop( $fact );
				}
			}
			$extras = getFact( $custevent );
			$fact = ( count( $fact ) && $fact[0] != "" ) ? array_merge( $fact, $extras ) : $extras;
			$thisEvent = $custevent['eventdate'] ? displayDate($custevent['eventdate']) : "";
			if($custevent['eventplace']) {
				if($thisEvent) $thisEvent .= ", ";
				$thisEvent .= $custevent['eventplace'];
			}
			if(count($fact)) {
		 		foreach($fact as $f) {
					if($thisEvent) $thisEvent .= "; ";
					$thisEvent .= $f;
				}
			}
			if($thisEvent)
				$otherEvents .= "<li>$displayval: " . $thisEvent . "</li>\n";
		}
		tng_free_result( $custevents );
	}
	if($otherEvents)
		$otherEvents = "<p>{$text['otherevents']}:\n<ul class=\"regevents\">$otherEvents</ul></p>\n";
	return $otherEvents;
}

function getRegNotes( $persfamID, $flag ) {
	global $notelinks_table, $xnotes_table, $tree, $eventtypes_table, $events_table, $text, $eventswithnotes;

	$custnotes = array();
	$gennotes = array();
	$precustnotes = array();
	$postcustnotes = array();
	$finalnotesarray = array();

	if( $flag == "I" ) {
		$precusttitles = array( "BIRT"=>$text['birth'], "CHR"=>$text['christened'], "NAME"=>$text['name'], "TITL"=>$text['title'], "NSFX"=>$text['suffix'], "NICK"=>$text['nickname'], "BAPL"=>$text['baptizedlds'], "CONL"=>$text['conflds'], "INIT"=>$text['initlds'], "ENDL"=>$text['endowedlds'] );
		$postcusttitles = array( "DEAT"=>$text['died'], "BURI"=>$text['buried'], "SLGC"=>$text['sealedplds'] );
	}
	elseif( $flag == "F" ) {
		$precusttitles = array( "MARR"=>$text['married'], "SLGS"=>$text['sealedslds'], "DIV"=>$text['divorced'] );
		$postcusttitles = array();
	}
	else {
		$precusttitles = array( "ABBR"=>$text['shorttitle'], "CALN"=>$text['callnum'], "AUTH"=>$text['author'], "PUBL"=>$text['publisher'], "TITL"=>$text['title2'] );
		$postcusttitles = array();
	}

	$query = "SELECT display, $xnotes_table.note as note, $notelinks_table.eventID as eventID, $notelinks_table.ID as ID FROM $notelinks_table
		LEFT JOIN  $xnotes_table on $notelinks_table.xnoteID = $xnotes_table.ID AND $notelinks_table.gedcom = $xnotes_table.gedcom
		LEFT JOIN $events_table ON $notelinks_table.eventID = $events_table.eventID
		LEFT JOIN $eventtypes_table on $eventtypes_table.eventtypeID = $events_table.eventtypeID
		WHERE $notelinks_table.persfamID=\"$persfamID\" AND $notelinks_table.gedcom=\"$tree\" AND secret!=\"1\"
		ORDER BY eventdatetr, $eventtypes_table.ordernum, tag, $notelinks_table.ordernum, ID";
	$notelinks = tng_query($query);

	$currevent = "";
	$type = 0;
	while( $note = tng_fetch_assoc( $notelinks ) ) {
		if( !$note['eventID'] ) $note['eventID'] = "--x-general-x--";
		if( $note['eventID'] != $currevent ) {
			$currevent = $note['eventID'];
			$currtitle = "";
		}
		if( !$currtitle ) {
			if( $note['display'] ) {
				$currtitle = getEventDisplay( $note['display'] );
				$key = "cust$currevent";
				$custnotes[$key] = array( "title"=>$currtitle, "text"=>"");
				$type = 2;
			}
			else {
				if(!empty($postcusttitles[$currevent])) {
					$currtitle = $postcusttitles[$currevent];
					$postcustnotes[$currevent] = array( "title"=>$postcusttitles[$currevent], "text"=>"");
					$type = 3;
				}
				else {
					$currtitle = !empty($precusttitles[$currevent]) ? $precusttitles[$currevent] : " ";
					if( $note['eventID'] == "--x-general-x--" ) {
						if(!empty($precusttitles[$currevent]))
							$gennotes[$currevent] = array( "title"=>$precusttitles[$currevent], "text"=>"");
						else
							$gennotes[$currevent] = array( "title"=>"", "text"=>"");
						$type = 0;
					}
					else {
						$precustnotes[$currevent] = array( "title"=>$precusttitles[$currevent], "text"=>"");
						$type = 1;
					}
				}
			}
		}
		switch( $type ) {
			case 0:
				if( $gennotes[$currevent]['text'] ) $gennotes[$currevent]['text'] .= "<br/><br/>";
				$gennotes[$currevent]['text'] .= nl2br($note['note']) . "\n";
				break;
			case 1:
				if( $precustnotes[$currevent]['text'] ) $precustnotes[$currevent]['text'] .= "<br/><br/>";
				$precustnotes[$currevent]['text'] .= nl2br($note['note']) . "\n";
				break;
			case 2:
				if( $custnotes[$key]['text'] ) $custnotes[$key]['text'] .= "<br/><br/>";
				$custnotes[$key]['text'] .= nl2br($note['note']) . "\n";
				break;
			case 3:
				if( $postcustnotes[$currevent]['text'] ) $postcustnotes[$currevent]['text'] .= "<br/><br/>";
				$postcustnotes[$currevent]['text'] .= nl2br($note['note']) . "\n";
				break;
		}
	}
	$finalnotesarray = array_merge( $gennotes, $precustnotes, $custnotes, $postcustnotes );
	tng_free_result($notelinks);

	return $finalnotesarray;
}

function buildRegNotes( $notearray ) {
	global $text;

	$notes = "";
	foreach( $notearray as $key => $note ) {
		if( $notes )
			$notes .= "<br/><br/>\n";
		if( $note['title'] )
			$notes .= $note['title'] . ":<br/>\n";
		$notes .= $note['text'] . "\n";
	}
	return $notes;
}
?>