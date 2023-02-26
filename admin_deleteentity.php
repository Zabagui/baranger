<?php
include("begin.php");
include("adminlib.php");
$textpart = "entities";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include($cms['tngpath'] . "checklogin.php");

if( !$allow_delete ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");

$original_name = $delitem;
if($session_charset != "UTF-8")
	$delitem = tng_utf8_decode($delitem);

$newname = addslashes( $delitem );
if( $entity == "state" ) {
	$query = "DELETE FROM $states_table WHERE state = \"$newname\"";
}
elseif( $entity == "country" ) {
	$query = "DELETE FROM $countries_table WHERE country = \"$newname\"";
}
$result = tng_query($query);

adminwritelog( $admtext['deleted'] . ": $entity: $original_name" );
echo "1";
?>
 