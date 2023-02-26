<?php
include("begin.php");
include("adminlib.php");
$textpart = "findplace";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_add ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");
include("geocodelib.php");

/*
if (get_magic_quotes_gpc() == 0) {
	$place = addslashes($place);
	$placelevel = addslashes($placelevel);
	$latitude = addslashes($latitude);
	$longitude = addslashes($longitude);
	$zoom = addslashes($zoom);
	$notes = addslashes($notes);
}
*/

$latitude = preg_replace("/,/",".",$latitude);
$longitude = preg_replace("/,/",".",$longitude);
if($latitude && $longitude && $placelevel && !$zoom)
	$zoom = 13;
if( !$zoom ) $zoom = 0;
if( !$placelevel ) $placelevel = 0;
if( empty($temple) ) $temple = 0;
if( $tngconfig['places1tree'] ) 
	$tree = "";
else
	setcookie("tng_tree", $tree, 0);

$newdate = date ("Y-m-d H:i:s", time() + ( 3600 * $time_offset ) );

$template = "ssssssssss";
$query = "INSERT IGNORE INTO $places_table (gedcom,place,placelevel,temple,latitude,longitude,zoom,notes,geoignore,changedate,changedby) VALUES (?,?,?,?,?,?,?,?,'0',?,?)";
$params = array(&$template, &$tree, &$place, &$placelevel, &$temple, &$latitude, &$longitude, &$zoom, &$notes, &$newdate, &$currentuser);
$affected_rows = tng_execute_noerror($query,$params);
if($affected_rows) {
	$placeID = tng_insert_id();
    if($tngconfig['autogeo']) {
        $message = geocode($place, 0, $placeID);
    }
	adminwritelog( "<a href=\"admin_editplace.php?ID=$placeID\">{$admtext['addnewplace']}: $placeID - " . stripslashes($place) . "</a>" );

	$message = $admtext['place'] . " " . stripslashes($place) . " {$admtext['succadded']}.";
}
else {
	$message = $admtext['place'] . " " . stripslashes($place) . " {$admtext['idexists']}";
}

if( !empty($submitx) ) {
	header( "Location: admin_places.php?message=" . urlencode($message) );
}
else {
	header( "Location: admin_editplace.php?ID=$placeID&message=" . urlencode($message) );
}
?>