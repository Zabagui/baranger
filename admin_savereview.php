<?php
include("begin.php");
include("adminlib.php");
$textpart = "review";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = true;
include("checklogin.php");

if( !$allow_edit || ( $assignedtree && $assignedtree != $tree ) ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");
require("datelib.php");

$eventdate = addslashes($newdate);
$eventplace = addslashes($newplace);
$info = addslashes($newinfo);

$query = "SELECT * FROM $temp_events_table WHERE tempID = \"$tempID\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
tng_free_result($result);
$tree = $row['gedcom'];
$personID = $row['personID'];
$familyID = $row['familyID'];
$eventID = $row['eventID'];

$persfamID = $personID ? $admtext['person'] . " " . $personID : $admtext['family'] . " " . $familyID;

$changedate = date ("Y-m-d H:i:s", time() + ( 3600 * $time_offset ) );
$eventdatetr = convertDate( $eventdate );
//don't forget to save date

if( $choice == $admtext['savedel'] ) {
	if( is_numeric( $eventID ) ) {
		$query = "UPDATE $events_table SET eventdate=\"$eventdate\", eventdatetr=\"$eventdatetr\", eventplace=\"$eventplace\", info=\"$info\" WHERE eventID=\"$eventID\"";
		$result = tng_query($query);

		if( $row['type'] == "F" )
			$query = "UPDATE $families_table SET changedate = \"$changedate\", changedby = \"{$row['user']}\" WHERE familyID = \"$familyID\" AND gedcom = \"$tree\"";
		else
			$query = "UPDATE $people_table SET changedate = \"$changedate\", changedby = \"{$row['user']}\" WHERE personID = \"$personID\" AND gedcom = \"$tree\"";
		$result = tng_query($query);
	}
	else {
		$needfamilies = 0;
		$needchildren = 0;
		switch( $eventID ) {
			case "TITL":
				$factfield = "title = \"$info\"";
				break;
			case "NPFX":
				$factfield = "prefix = \"$info\"";
				break;
			case "NSFX":
				$factfield = "suffix = \"$info\"";
				break;
			case "NICK":
				$factfield = "nickname = \"$info\"";
				break;
			case "BIRT":
				$datefield = "birthdate = \"$eventdate\", birthdatetr = \"$eventdatetr\"";
				$placefield = "birthplace = \"$eventplace\"";
				break;
			case "CHR":
				$datefield = "altbirthdate = \"$eventdate\", altbirthdatetr = \"$eventdatetr\"";
				$placefield = "altbirthplace = \"$eventplace\"";
				break;
			case "BAPL":
				$datefield = "baptdate = \"$eventdate\", baptdatetr = \"$eventdatetr\"";
				$placefield = "baptplace = \"$eventplace\"";
				break;
			case "CONF":
				$datefield = "confdate = \"$eventdate\", confdatetr = \"$eventdatetr\"";
				$placefield = "confplace = \"$eventplace\"";
				break;
			case "INIT":
				$datefield = "initdate = \"$eventdate\", initdatetr = \"$eventdatetr\"";
				$placefield = "initplace = \"$eventplace\"";
				break;
			case "ENDL":
				$datefield = "endldate = \"$eventdate\", endldatetr = \"$eventdatetr\"";
				$placefield = "endlplace = \"$eventplace\"";
				break;
			case "DEAT":
				$datefield = "deathdate = \"$eventdate\", deathdatetr = \"$eventdatetr\"";
				$placefield = "deathplace = \"$eventplace\"";
				break;
			case "BURI":
				$datefield = "burialdate = \"$eventdate\", burialdatetr = \"$eventdatetr\"";
				$placefield = "burialplace = \"$eventplace\"";
				break;
			case "MARR":
				$datefield = "marrdate = \"$eventdate\", marrdatetr = \"$eventdatetr\"";
				$placefield = "marrplace = \"$eventplace\"";
				$factfield = "marrtype = \"$info\"";
				$needfamilies = 1;
				break;
			case "DIV":
				$datefield = "divdate = \"$eventdate\", divdatetr = \"$eventdatetr\"";
				$placefield = "divplace = \"$eventplace\"";
				$needfamilies = 1;
				break;
			case "SLGS":
				$datefield = "sealdate = \"$eventdate\", sealdatetr = \"$eventdatetr\"";
				$placefield = "sealplace = \"$eventplace\"";
				$needfamilies = 1;
				break;
			case "SLGC":
				$datefield = "sealdate = \"$eventdate\", sealdatetr = \"$eventdatetr\"";
				$placefield = "sealplace = \"$eventplace\"";
				$needchildren = 1;
				break;
		}
		$fieldstr = $needchildren ? "" : "changedate = \"$changedate\", changedby = \"{$row['user']}\"";
		if( $datefield ) $fieldstr .= $fieldstr ? ", $datefield" : $datefield;
		if( $placefield ) $fieldstr .= $fieldstr ? ", $placefield" : $placefield;
		if( $factfield ) $fieldstr .= $fieldstr ? ", $factfield" : $factfield;
		
		if( $needfamilies )
			$query = "UPDATE $families_table SET $fieldstr WHERE familyID = \"$familyID\" AND gedcom = \"$tree\"";
		elseif( $needchildren ) {
			$query = "UPDATE $people_table SET changedate = \"$changedate\", changedby=\"{$row['user']}\" WHERE personID = \"$personID\" AND gedcom = \"$tree\"";
			$result = tng_query($query);
			$query = "UPDATE $children_table SET $fieldstr WHERE familyID = \"$familyID\" AND personID = \"$personID\" AND gedcom = \"$tree\"";
		}
		else
			$query = "UPDATE $people_table SET $fieldstr WHERE personID = \"$personID\" AND gedcom = \"$tree\"";
		$result = tng_query($query);
	}

	if( $eventplace ) {
		$placetree = $tngconfig['places1tree'] ? "" : $tree;
		$query = "INSERT IGNORE INTO $places_table (gedcom,place,placelevel,zoom) VALUES (\"$placetree\",\"$eventplace\",\"0\",\"0\")";
		$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
	}

	$succmsg = $admtext['tentadd'];
}
if( $choice != $admtext['postpone'] ) {
	$query = "DELETE FROM $temp_events_table WHERE tempID=\"$tempID\"";
	$result = tng_query($query);

	if( $choice == $admtext['igndel'] )
		$succmsg = $admtext['tentdel'];
}
else {
	$succmsg = "";
	$message = "";
}

if( $succmsg ) {
	if( $row['type'] == "F" )
		adminwritelog( "<a href=\"admin_editfamily.php?familyID=$family&amp;tree=$tree\">$choice ({$admtext['family']}): $tree/{$row['familyID']}</a>" );
	else
		adminwritelog( "<a href=\"admin_editperson.php?personID=$personID&amp;tree=$tree\">$choice ({$admtext['person']}): $tree/{$row['personID']}</a>" );
	$message = $admtext['tentdata'] . " $persfamID $succmsg.";
}

header( "Location: admin_findreview.php?type=$type&message=" . urlencode($message) );
?>
