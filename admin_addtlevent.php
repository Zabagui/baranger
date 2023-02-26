<?php
include("begin.php");
include("adminlib.php");
$textpart = "timeline";
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

/*
if (get_magic_quotes_gpc() == 0) {
	$evdetail = addslashes($evdetail);
    $evtitle = addslashes($evtitle);
}
*/

if( !$evday ) $evday = "0";
if( !$evmonth ) $evmonth = "0";
if( !$endday ) $endday = "0";
if( !$endmonth ) $endmonth = "0";
$template = "ssssssss";
$query = "INSERT INTO $tlevents_table (evday,evmonth,evyear,endday,endmonth,endyear,evtitle,evdetail) VALUES (?,?,?,?,?,?,?,?)";
$params = array(&$template, &$evday, &$evmonth, &$evyear, &$endday, &$endmonth, &$endyear, &$evtitle, &$evdetail);
tng_execute($query,$params);
$tleventID = tng_insert_id();

adminwritelog( $admtext['addnewtlevent'] . ": $tleventID - $evdetail" );

$message = $admtext['newtleventinfo'] . " $tleventID {$admtext['succadded']}.";
header( "Location: admin_timelineevents.php?message=" . urlencode($message) );
?>