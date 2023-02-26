<?php
include("begin.php");
include("adminlib.php");
$textpart = "eventtypes";
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
	$type = addslashes($type);
	$tag2 = addslashes($tag2);
	$defdisplay = addslashes($defdisplay);
}
*/

if( $tag2 )
	$tag = $tag2;
else
	$tag = $tag1;
if(!$ordernum) $ordernum = 0;
if( !$display ) $display = $defdisplay;
$template = "ssssssss";
$query = "INSERT INTO $eventtypes_table (tag,description,display,type,keep,collapse,ordernum,ldsevent) 
	VALUES (?,?,?,?,?,?,?,?)";
$params = array(&$template,&$tag, &$description, &$display, &$type, &$keep, &$collapse, &$ordernum, &$ldsevent);
$affected_rows = tng_execute_noerror($query,$params);
if($affected_rows == 1) {
	$eventtypeID = tng_insert_id();
	$message = $admtext['eventtype'] . " $eventtypeID {$admtext['succadded']}.";

	adminwritelog( $admtext['addnewevtype'] . ": $tag $type - $display" );
}
else
	$message = $admtext['eventtype'] . " $eventtypeID {$admtext['idexists']}.";

header( "Location: admin_eventtypes.php?message=" . urlencode($message) );
?>