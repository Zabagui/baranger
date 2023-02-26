<?php
include("begin.php");
include("adminlib.php");
$textpart = "events";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include($cms['tngpath'] . "checklogin.php");

if( !$allow_edit ) {
	exit;
}

require("datelib.php");
require("adminlog.php");

include("geocodelib.php");

if($session_charset != "UTF-8") {
	$eventplace = tng_utf8_decode($eventplace);
	$info = tng_utf8_decode($info);
	$age = tng_utf8_decode($age);
	$agency = tng_utf8_decode($agency);
	$cause = tng_utf8_decode($cause);
	$address1 = tng_utf8_decode($address1);
	$address2 = tng_utf8_decode($address2);
	$city = tng_utf8_decode($city);
	$state = tng_utf8_decode($state);
	$zip = tng_utf8_decode($zip);
	$country = tng_utf8_decode($country);
}

$eventdate = addslashes($eventdate);
$eventplace = addslashes($eventplace);
$info = addslashes($info);
$age = addslashes($age);
$agency = addslashes($agency);
$cause = addslashes($cause);
$address1 = addslashes($address1);
$address2 = addslashes($address2);
$city = addslashes($city);
$state = addslashes($state);
$zip = addslashes($zip);
$country = addslashes($country);
$phone = addslashes($phone);
$email = addslashes($email);
$www = addslashes($www);

$eventdatetr = convertDate( $eventdate );

if( $addressID ) {
	if( $address1 || $address2 || $city || $state || $zip || $country || $phone || $email || $www )
		$query = "UPDATE $address_table SET address1=\"$address1\", address2=\"$address2\", city=\"$city\", state=\"$state\", zip=\"$zip\", country=\"$country\", gedcom=\"$tree\", phone=\"$phone\", email=\"$email\", www=\"$www\" WHERE addressID = \"$addressID\"";
	else {
		$query = "DELETE FROM $address_table WHERE addressID = \"$addressID\"";
		$addressID = "";
	}
	$result = tng_query($query);
}
elseif( $address1 || $address2 || $city || $state || $zip || $country || $phone || $email || $www ) {
	$query = "INSERT INTO $address_table (address1, address2, city, state, zip, country, gedcom, phone, email, www)  VALUES(\"$address1\", \"$address2\", \"$city\", \"$state\", \"$zip\", \"$country\", \"$tree\", \"$phone\", \"$email\", \"$www\")";
	$result = tng_query($query);
	$addressID = tng_insert_id();
}

$query = "UPDATE $events_table SET eventdate=\"$eventdate\", eventdatetr=\"$eventdatetr\", eventplace=\"$eventplace\", age=\"$age\", agency=\"$agency\", cause=\"$cause\", addressID=\"$addressID\", info=\"$info\" WHERE eventID=\"$eventID\"";
$result = tng_query($query);

$query = "SELECT display, $events_table.eventtypeID as eventtypeID, addressID FROM $eventtypes_table, $events_table WHERE $eventtypes_table.eventtypeID = $events_table.eventtypeID AND eventID = \"$eventID\"";
$result = tng_query($query);
$row = tng_fetch_assoc($result);
tng_free_result($result);

$display = htmlspecialchars(getEventDisplay( $row['display'] ), ENT_QUOTES, $session_charset);

if($dupIDs) {
	$ids = explode(",",$dupIDs);
	foreach($ids as $id) {
		$query = "INSERT INTO $events_table (eventtypeID, persfamID, eventdate, eventdatetr, eventplace, age, agency, cause, addressID, info, gedcom, parenttag)  
					SELECT \"{$row['eventtypeID']}\", \"$id\", \"$eventdate\", \"$eventdatetr\", \"$eventplace\", \"$age\", \"$agency\", \"$cause\", \"{$row['addressID']}\", \"$info\", \"$tree\", \"\"
					FROM DUAL
					WHERE exists (select 'x' from $people_table where personid = \"$id\")
						OR
					exists (select 'x' from $families_table where familyid = \"$id\")
						OR
					exists (select 'x' from $sources_table where sourceid = \"$id\")	
					";	
		$result = tng_query($query);
		$newEventID = tng_insert_id();
		
		if ($newEventID ){

			//do citations
			$query = "SELECT * FROM $citations_table WHERE eventID = \"$eventID\"";
			$result = tng_query($query);
			while($crow = tng_fetch_assoc($result)) {
				$iquery = "INSERT INTO $citations_table (gedcom, persfamID, eventID, sourceID, ordernum, description, citedate, citedatetr, citetext, page, quay, note) VALUES(\"{$crow['gedcom']}\",\"$id\",\"$newEventID\",\"{$crow['sourceID']}\",\"{$crow['ordernum']}\",\"{$crow['description']}\",\"{$crow['citedate']}\",\"{$crow['citedatetr']}\",\"{$crow['citetext']}\",\"{$crow['page']}\",\"{$crow['quay']}\",\"{$crow['note']}\")";
				$iresult = tng_query($iquery);
			}
			tng_free_result($result);

			//do notes
			$query = "SELECT * FROM $notelinks_table WHERE eventID = \"$eventID\"";
			$result = tng_query($query);
			while($nrow = tng_fetch_assoc($result)) {
				$xquery = "INSERT INTO $xnotes_table (gedcom, note, noteID) SELECT gedcom, note, noteID from $xnotes_table where id =  \"{$nrow['xnoteID']}\" ";
				$xresult = tng_query($xquery);
				$newNoteID = tng_insert_id();				

				$iquery = "INSERT INTO $notelinks_table (persfamID, gedcom, xnoteID, eventID, ordernum, secret) VALUES(\"$id\",\"{$nrow['gedcom']}\",\"$newNoteID\",\"$newEventID\",\"{$nrow['ordernum']}\",\"{$nrow['secret']}\")";
				$iresult = tng_query($iquery);
				$newNoteID = tng_insert_id();

				//do citations attached to this note
				$icquery = "SELECT * FROM $citations_table WHERE gedcom = \"{$nrow['gedcom']}\" AND eventID = \"N{$nrow['ID']}\"";
				$icresult = tng_query($icquery);
				while($crow = tng_fetch_assoc($icresult)) {
					$cquery = "INSERT INTO $citations_table (gedcom, persfamID, eventID, sourceID, ordernum, description, citedate, citedatetr, citetext, page, quay, note) VALUES(\"{$crow['gedcom']}\",\"$id\",\"N$newNoteID\",\"{$crow['sourceID']}\",\"{$crow['ordernum']}\",\"{$crow['description']}\",\"{$crow['citedate']}\",\"{$crow['citedatetr']}\",\"{$crow['citetext']}\",\"{$crow['page']}\",\"{$crow['quay']}\",\"{$crow['note']}\")";
					$cresult = tng_query($cquery);
				}
				tng_free_result($icresult);
			}
			tng_free_result($result);

			//do media
			$query = "SELECT * FROM $medialinks_table WHERE eventID = \"$eventID\"";
			$result = tng_query($query);
			while($mrow = tng_fetch_assoc($result)) {
				$iquery = "INSERT INTO $medialinks_table (gedcom, linktype, personID, eventID, mediaID, altdescription, altnotes, ordernum, dontshow, defphoto) VALUES(\"{$mrow['gedcom']}\",\"{$mrow['linktype']}\",\"$id\",\"$newEventID\",\"{$mrow['mediaID']}\",\"{$mrow['altdescription']}\",\"{$mrow['altnotes']}\",\"{$mrow['ordernum']}\",\"{$mrow['dontshow']}\",\"{$mrow['defphoto']}\")";
				$iresult = tng_query($iquery);
			}
			tng_free_result($result);

			//do albums
			$query = "SELECT * FROM $album2entities_table WHERE eventID = \"$eventID\"";
			$result = tng_query($query);
			while($arow = tng_fetch_assoc($result)) {
				$iquery = "INSERT INTO $album2entities_table (gedcom, linktype, entityID, eventID, albumID, ordernum) VALUES(\"{$arow['gedcom']}\",\"{$arow['linktype']}\",\"$id\",\"$newEventID\",\"{$arow['albumID']}\",\"{$arow['ordernum']}\")";
				$iresult = tng_query($iquery);
			}
			tng_free_result($result);
		}
	}
}

if(trim($eventplace)) {
	$placetree = $tngconfig['places1tree'] ? "" : $tree;
	$query = "INSERT IGNORE INTO $places_table (gedcom,place,placelevel,zoom) VALUES (\"$placetree\",\"$eventplace\",\"0\",\"0\")";
	$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
    if($tngconfig['autogeo'] && tng_affected_rows()) {
        $ID = tng_insert_id();
        $message = geocode($eventplace, 0, $ID);
    }
}

adminwritelog( $admtext['modifyevent'] . ": $eventID" );

$info = preg_replace("/\r/"," ",$info);
$info = htmlspecialchars(preg_replace("/\n/"," ",$info), ENT_QUOTES, $session_charset);
$truncated = substr($info,0,90);
$info = strlen($info) > 90 ? substr($truncated,0,strrpos($truncated,' ')) . '&hellip;' : $info;
$info = preg_replace("/\t/"," ",$info);

//echo "{'eventID':'$eventID','display':'$display','eventdate':'$eventdate','eventplace':'$eventplace','info':'$info','allow_edit':'$allow_edit','allow_delete':'$allow_delete','editmsg':'$admtext[edit]','delmsg':'$admtext[text_delete]'}";
header("Content-type:text/html; charset=" . $session_charset);
echo "{\"display\":\"$display\",\"eventdate\":\"$eventdate\",\"eventplace\":\"" . stripslashes($eventplace) . "\",\"info\":\"" . stripslashes($info) . "\"}";
?>