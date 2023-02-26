<?php
include("begin.php");
include("adminlib.php");
$textpart = "events";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include($cms['tngpath'] . "checklogin.php");

if( !$allow_delete ) {
	exit;
}

require("adminlog.php");

$query = "SELECT addressID FROM $events_table WHERE eventID=\"$eventID\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
if($result) tng_free_result( $result );

$query = "DELETE FROM $address_table WHERE addressID=\"{$row['addressID']}\"";
$result = tng_query($query);

$query = "DELETE FROM $events_table WHERE eventID=\"$eventID\"";
$result = tng_query($query);

$query = "DELETE FROM $citations_table WHERE eventID=\"$eventID\"";
$result = tng_query($query) or die ($admtext['cannotexecutequery'] . "]: $query");

$query = "DELETE FROM $medialinks_table WHERE eventID=\"$eventID\"";
$result = tng_query($query);

$query = "SELECT xnoteID FROM $notelinks_table WHERE eventID=\"$eventID\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
if($result) tng_free_result( $result );

if(!empty($row['xnoteID'])) {
	$query = "SELECT count(ID) as xcount FROM $notelinks_table WHERE xnoteID=\"{$row['xnoteID']}\"";
	$result = tng_query($query);
	$row = tng_fetch_assoc( $result );
	if($result) tng_free_result( $result );
	if( $row['xcount'] == 1 ) {
		$query = "DELETE FROM $xnotes_table WHERE ID=\"{$row['xnoteID']}\"";
		$result = tng_query($query);
	}
}

$query = "DELETE FROM $notelinks_table WHERE eventID=\"$eventID\"";
$result = tng_query($query);

adminwritelog( "{$admtext['deleted']}: {$admtext['event']} $eventID" );
echo 1;
?>
