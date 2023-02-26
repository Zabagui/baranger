<?php
include("begin.php");
include("adminlib.php");
$textpart = "branches";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_media_add ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");

/*
if (get_magic_quotes_gpc() == 0) {
	$albumname = addslashes($albumname);
	$description = addslashes($description);
	$keywords = addslashes($keywords);
}
*/

if( empty($alwayson) ) $alwayson = 0;
$template = "sssss";
$query = "INSERT INTO $albums_table (albumname,description,keywords,active,alwayson) VALUES (?,?,?,?,?)";
$params = array(&$template,&$albumname, &$description, &$keywords, &$active, &$alwayson);
tng_execute($query,$params);
$albumID = tng_insert_id();
$_SESSION['albumcount'] = isset($_SESSION['albumcount']) ? $_SESSION['albumcount'] + 1 : 1;

adminwritelog( $admtext['addnewalbum'] . ": $albumname" );

header( "Location: admin_editalbum.php?albumID=$albumID&added=1" );
?>