<?php
include("begin.php");
include("adminlib.php");
$textpart = "events";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_add ) {
	$message = $admtext['norights'];
	exit;
}

require("datelib.php");
require("adminlog.php");

include("geocodelib.php");

$persfamID = ucfirst( $persfamID );

$orgplace = $eventplace;
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
	$phone = tng_utf8_decode($phone);
	$email = tng_utf8_decode($email);
	$www = tng_utf8_decode($www);
}

/*
if (get_magic_quotes_gpc() == 0) {
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
}
*/

$eventdatetr = convertDate( $eventdate );

if(trim($eventplace)) {
	$template = "sss";
	$placetree = $tngconfig['places1tree'] ? "" : $tree;
	$temple = strlen($eventplace) == 5 && $eventplace == strtoupper($eventplace) ? 1 : 0;
	$query = "INSERT IGNORE INTO $places_table (gedcom,place,placelevel,zoom,geoignore,temple) VALUES (?,?,\"0\",\"0\",\"0\",?)";
	$params = array(&$template,&$placetree,&$eventplace,&$temple);
	tng_execute($query,$params);
    if($tngconfig['autogeo'] && tng_affected_rows()) {
        $ID = tng_insert_id();
        $message = geocode($eventplace, 0, $ID);
    }
}

if( $address1 || $address2 || $city || $state || $zip || $country || $phone || $email || $www ) {
	$template = "ssssssssss";
	$query = "INSERT INTO $address_table (address1, address2, city, state, zip, country, gedcom, phone, email, www) 
		VALUES(?,?,?,?,?,?,?,?,?,?)";
	$params = array(&$template,&$address1, &$address2, &$city, &$state, &$zip, &$country, &$tree, &$phone, &$email, &$www);
	tng_execute($query,$params);
	$addressID = tng_insert_id();
}
else
	$addressID = "";

$template = "sssssssssss";
$query = "INSERT INTO $events_table (eventtypeID, persfamID, eventdate, eventdatetr, eventplace, age, agency, cause, addressID, info, gedcom, parenttag) 
	VALUES(?,?,?,?,?,?,?,?,?,?,?, \"\")";
$params = array(&$template,&$eventtypeID, &$persfamID, &$eventdate, &$eventdatetr, &$eventplace, &$age, &$agency, &$cause, &$addressID, &$info, &$tree);
tng_execute($query,$params);
$eventID = tng_insert_id();

if($dupIDs) {
	$ids = explode(",",$dupIDs);
	$params = array(&$template,&$eventtypeID, &$id, &$eventdate, &$eventdatetr, &$eventplace, &$age, &$agency, &$cause, &$addressID, &$info, &$tree);
	foreach($ids as $id) {
		tng_execute($query,$params);
	}
}

adminwritelog( $admtext['addnewevent'] . ": $eventtypeID/$tree/$persfamID" );

$query = "SELECT display FROM $eventtypes_table WHERE eventtypeID = \"$eventtypeID\"";
$result = tng_query($query);
$row = tng_fetch_assoc($result);

$display = htmlspecialchars(getEventDisplay( $row['display'] ), ENT_QUOTES, $session_charset);

$info = preg_replace("/\r/"," ",$info);
$info = htmlspecialchars(preg_replace("/\n/"," ",$info), ENT_QUOTES, $session_charset);
$truncated = substr($info,0,90);
$info = strlen($info) > 90 ? substr($truncated,0,strrpos($truncated,' ')) . '&hellip;' : $info;
$info = preg_replace("/\t/"," ",$info);

//echo "{'eventID':'$eventID','display':'$display','eventdate':'$eventdate','eventplace':'$eventplace','info':'$info','allow_edit':'$allow_edit','allow_delete':'$allow_delete','editmsg':'$admtext[edit]','delmsg':'$admtext[text_delete]'}";
header("Content-type:text/html; charset=" . $session_charset);
$eventplace = stripslashes($eventplace);
if($eventID)
	echo "{\"id\":\"$eventID\",\"persfamID\":\"$persfamID\",\"tree\":\"$tree\",\"display\":\"$display\",\"eventdate\":\"$eventdate\",\"eventplace\":\"$eventplace\",\"info\":\"" . stripslashes($info) . "\",\"allow_edit\":$allow_edit,\"allow_delete\":$allow_delete}";
else
	echo "{\"id\":0}";
?>