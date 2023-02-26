<?php
include("begin.php");
include("adminlib.php");
$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_add ) {
	exit;
}

require("adminlog.php");

$display_org = stripslashes($display);

if($session_charset != "UTF-8") {
	$display = tng_utf8_decode($display);
}

/*
if (get_magic_quotes_gpc() == 0)
	$display = addslashes( $display );
*/

$stdcolls = array("photos", "histories", "headstones", "documents", "recordings", "videos");
$collid = cleanID($collid);
$newcollid = 0;
if(!in_array($collid, $stdcolls)) {
	$template = "sssssssss";
	$query = "INSERT IGNORE INTO $mediatypes_table (mediatypeID,display,path,liketype,icon,thumb,exportas,ordernum,localpath) VALUES (?,?,?,?,?,?,?,?,?)";
	$params = array(&$template,&$collid, &$display, &$path, &$liketype, &$icon, &$thumb, &$exportas, &$ordernum, &$localpath);
	$affected_rows = tng_execute($query,$params);

	if( $affected_rows > 0 ) {
		adminwritelog( $admtext['addnewcoll'] . ": $display_org" );
		$newcollid = $collid;
	}
}
echo $newcollid;
?>