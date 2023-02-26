<?php
include("begin.php");
include("adminlib.php");
$textpart = "entities";
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

$original_name = $newitem;
if($session_charset != "UTF-8")
	$newitem = tng_utf8_decode($newitem);

/*
if (get_magic_quotes_gpc() == 0)
	$newname = addslashes( $newitem );
else
*/
$newname = $newitem;

$template = "s";
if( $entity == "state" ) {
	$query = "INSERT INTO $states_table (state) VALUES (?)";
}
elseif( $entity == "country" ) {
	$query = "INSERT INTO $countries_table (country) VALUES (?)";
}
$params = array(&$template,&$newname);
$affected_rows = tng_execute_noerror($query,$params);

adminwritelog( $admtext['enternew'] . " $entity: $original_name" );

if( $affected_rows == 1 )
	echo "$original_name " . $admtext['added'];
else
	echo "$original_name " . $admtext['alreadyexists'];
?>