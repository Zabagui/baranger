<?php
include("begin.php");
include("adminlib.php");
$textpart = "timeline";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_edit ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");

$evdetail = addslashes($evdetail);
$evtitle = addslashes($evtitle);

if( !$evday ) $evday = "0";
if( !$evmonth ) $evmonth = "0";
if( !$endday ) $endday = "0";
if( !$endmonth ) $endmonth = "0";
$query = "UPDATE $tlevents_table SET evday=\"$evday\", evmonth=\"$evmonth\", evyear=\"$evyear\",endday=\"$endday\", endmonth=\"$endmonth\", endyear=\"$endyear\",evtitle=\"$evtitle\",evdetail=\"$evdetail\" WHERE tleventID=\"$tleventID\"";
$result = tng_query($query);

adminwritelog( $admtext['modifytlevent'] . ": $tleventID" );

if( isset($_POST['savestay']) )
	header( "Location: admin_edittlevent.php?tleventID=$tleventID" );
else {
	$message = $admtext['changestotlevent'] . " $tleventID {$admtext['succsaved']}.";
	header( "Location: admin_timelineevents.php?message=" . urlencode($message) );
}
?>
