<?php
include("begin.php");
include("adminlib.php");
$textpart = "templates";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( $assignedtree || !$allow_add ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$query = "INSERT INTO $templates_table (keyname,value,language,template) VALUES (\"$keyname\",\"$msgvalue\",\"$tlanguage\",\"$templatenum\")";
tng_query($query,$params);
$id = tng_insert_id();

$message = "template message" . " $keyname {$admtext['succadded']}.";
header( "Location: admin_templatemsgs.php?message=" . urlencode($message) );
?>