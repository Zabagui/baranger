<?php
include("begin.php");
include("adminlib.php");
$textpart = "templates";
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

$value = addslashes($msgvalue);

$query = "UPDATE $templates_table SET keyname=\"$keyname\",value=\"$msgvalue\",language=\"$tlanguage\" WHERE id=\"$id\"";
$result = tng_query($query);

if( !empty($submitx) || !empty($message) ) {
	$message = "change to message with id" . " $id {$admtext['succsaved']}.";
	header( "Location: admin_templatemsgs.php?message=" . urlencode($message) );
}
else {
	header( "Location: admin_edittemplatemsg.php?id=$id" );
}
?>
