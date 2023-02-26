<?php
include("begin.php");
include("adminlib.php");
$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_media_delete ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");

$query = "DELETE FROM $albums_table WHERE albumID=\"$albumID\"";
$result = tng_query($query);

$query = "DELETE FROM $albumlinks_table WHERE albumID=\"$albumID\"";
$result = tng_query($query);

$_SESSION['albumcount'] = isset($_SESSION['albumcount']) ? $_SESSION['albumcount'] - 1 : 0;

adminwritelog( $admtext['deleted'] . ": {$admtext['album']} $albumID" );

$message = $admtext['album'] . " $albumID {$admtext['succdeleted']}.";
header( "Location: admin_albums.php?message=" . urlencode($message) );
?>
