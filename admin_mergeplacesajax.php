<?php
include("begin.php");
include("adminlib.php");
$textpart = "findplace";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_edit ) {
	exit;
}

require("adminlog.php");

$query = "SELECT place, latitude, longitude, placelevel, zoom, notes FROM $places_table WHERE ID = \"$keep\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
$newplace = addslashes($row['place']);
$keeplat = $row['latitude'];
$keeplong = $row['longitude'];
$keeplevel = $row['placelevel'];
$keepzoom = $row['zoom'];
$keepnotes = $row['notes'];
$latlongstr = ", latitude, longitude, placelevel, zoom";
tng_free_result($result);

$dquery = "DELETE FROM $places_table WHERE ";

$dquery .= $tngconfig['places1tree'] ? "" : " gedcom = \"$tree\" AND (";
$addtoquery = "";
$mergelist = explode(',',$places);

$treestr = $tngconfig['places1tree'] ? "" : "AND gedcom=\"$tree\"";

foreach( $mergelist as $val ) {
	if( $addtoquery ) $addtoquery .= " OR ";
	$addtoquery .= "ID=\"$val\"";

	$query = "SELECT place, notes$latlongstr FROM $places_table WHERE ID = \"$val\"";
	$result = tng_query($query);
	$row = tng_fetch_assoc( $result );
	tng_free_result($result);
	$oldplace = addslashes($row['place']);

	if( $oldplace ) {
		if($latlongstr) {
			if($row['latitude'] || $row['longitude'] || $row['placelevel'] || $row['zoom']) {
				if(!$keeplat && $row['latitude']) $keeplat = $row['latitude'];
				if(!$keeplong && $row['longitude']) $keeplong = $row['longitude'];
				if(!$keeplevel && $row['placelevel']) $keeplevel = $row['placelevel'];
				if(!$keepzoom && $row['zoom']) $keepzoom = $row['zoom'];
				$query = "UPDATE $places_table SET latitude = \"$keeplat\", longitude = \"$keeplong\", placelevel = \"$keeplevel\", zoom = \"$keepzoom\" WHERE ID = \"$keep\"";
				$result = tng_query($query);
				$latlongstr = "";  //just do the first one we get
			}
		}
		if($row['notes']) {
			$keepnotes .= $lineending . $row['notes'];
			$query = "UPDATE $places_table SET notes = \"" . addslashes($keepnotes) . "\" WHERE ID = \"$keep\"";
			$result = tng_query($query);
		}

		$query = "UPDATE $people_table SET birthplace=\"$newplace\" WHERE birthplace=\"$oldplace\" $treestr";
		$result = tng_query($query);
		$query = "UPDATE $people_table SET altbirthplace=\"$newplace\" WHERE altbirthplace=\"$oldplace\" $treestr";
		$result = tng_query($query);
		$query = "UPDATE $people_table SET deathplace=\"$newplace\" WHERE deathplace=\"$oldplace\" $treestr";
		$result = tng_query($query);
		$query = "UPDATE $people_table SET burialplace=\"$newplace\" WHERE burialplace=\"$oldplace\" $treestr";
		$result = tng_query($query);
		$query = "UPDATE $people_table SET baptplace=\"$newplace\" WHERE baptplace=\"$oldplace\" $treestr";
		$result = tng_query($query);
		$query = "UPDATE $people_table SET confplace=\"$newplace\" WHERE confplace=\"$oldplace\" $treestr";
		$result = tng_query($query);
		$query = "UPDATE $people_table SET initplace=\"$newplace\" WHERE initplace=\"$oldplace\" $treestr";
		$result = tng_query($query);
		$query = "UPDATE $people_table SET endlplace=\"$newplace\" WHERE endlplace=\"$oldplace\" $treestr";
		$result = tng_query($query);

		//families
		$query = "UPDATE $families_table SET marrplace=\"$newplace\" WHERE marrplace=\"$oldplace\" $treestr";
		$result = tng_query($query);
		$query = "UPDATE $families_table SET divplace=\"$newplace\" WHERE divplace=\"$oldplace\" $treestr";
		$result = tng_query($query);
		$query = "UPDATE $families_table SET sealplace=\"$newplace\" WHERE sealplace=\"$oldplace\" $treestr";
		$result = tng_query($query);

		//events
		$query = "UPDATE $events_table SET eventplace=\"$newplace\" WHERE eventplace=\"$oldplace\" $treestr";
		$result = tng_query($query);

		//children
		$query = "UPDATE $children_table SET sealplace=\"$newplace\" WHERE sealplace=\"$oldplace\" $treestr";
		$result = tng_query($query);

		//media (this is quick & dirty. would be better to cycle through each link and try the update, then delete the old if the update is not successful,
		//since that would indicate a key collision and the old record would remain, but it shouldn't come up very often and it wouldn't be critical in any case)
		$query = "UPDATE $medialinks_table SET personID=\"$newplace\" WHERE personID=\"$oldplace\" $treestr";
		$result = @tng_query_noerror($query);

		if(!tng_affected_rows()) {
			$query = "DELETE FROM $medialinks_table WHERE personID=\"$oldplace\" $treestr";
			$result = @tng_query($query);
		}
		$query = "UPDATE $media_table SET placetaken=\"$newplace\" WHERE placetaken=\"$oldplace\" $treestr";
		$result = tng_query($query);

		//cemeteries
		$query = "UPDATE $cemeteries_table SET place=\"$newplace\" WHERE place=\"$oldplace\"";
		$result = tng_query($query);
	}
}
if( $addtoquery ) {
	$dquery .= $addtoquery;
	if(!$tngconfig['places1tree'])
		$dquery .= ")";
	$result = tng_query($dquery) or die ($admtext['cannotexecutequery'] . ": $dquery");

	adminwritelog( $admtext['mergeplaces'] . ": $newplace" );

	$message = $admtext['pmsucc'] . ": $newplace.";
}
header("Content-Type: application/json; charset=" . $session_charset);
echo "{\"latitude\":\"$keeplat\", \"longitude\":\"$keeplong\"}";
?>