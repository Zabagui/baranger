<?php
include("begin.php");
include("adminlib.php");
$textpart = "reports";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_edit && !$allow_add ) {
	exit;
}

require("adminlog.php");

if($session_charset != "UTF-8") {
	$title = tng_utf8_decode($title);
	$description = tng_utf8_decode($description);
}

$title = addslashes($title);
$description = addslashes($description);

$cleaned = stripslashes($description);
$truncated = substr($cleaned,0,90);
$truncated = strlen($cleaned) > 90 ? substr($truncated,0,strrpos($truncated,' ')) : $cleaned;
$truncated = cleanIt($truncated) . (strlen($cleaned) > 90 ?  '&hellip;' : "");
$cleantitle = cleanIt(stripslashes($title));
if($mediaID == "") $mediaID = 0;

if( $ID ) {
	$query = "UPDATE $mostwanted_table SET title=\"$title\", description=\"$description\", personID=\"$personID\", mediaID=\"$mediaID\", gedcom=\"$mwtree\" WHERE ID=\"$ID\"";
	$result = tng_query($query);
}
else {
	//get new ordernum
	$query2 = "SELECT max(ordernum) as maxordernum FROM $mostwanted_table WHERE mwtype = \"$mwtype\"";
	$result2 = tng_query($query2) or die ($admtext['cannotexecutequery'] . ": $query2");
	$row2 = tng_fetch_assoc($result2);
	$ordernum = $row2['maxordernum'] + 1;
	tng_free_result($result2);

	$query = "INSERT INTO $mostwanted_table (title,description,personID,mediaID,gedcom,mwtype,ordernum) VALUES (\"$title\",\"$description\",\"$personID\",\"$mediaID\",\"$mwtree\",\"$mwtype\",$ordernum)";
	$result = tng_query($query);
	$ID = tng_insert_id();
}

//get thumbnail path
$thumbpath = "";
$size = array(0,0);
if($mediaID && $mediaID != $orgmediaID) {
	initMediaTypes();
	$query = "SELECT * FROM $media_table WHERE mediaID = \"$mediaID\"";
	$result = tng_query($query);
	$row = tng_fetch_assoc($result);
	$mediatypeID = $row['mediatypeID'];
	$usefolder = $row['usecollfolder'] ? $mediatypes_assoc[$mediatypeID] : $mediapath;

	if( $row['thumbpath'] && file_exists( "$rootpath$usefolder/" . $row['thumbpath'] ) ) {
		$size = @GetImageSize( "$rootpath$usefolder/" . $row['thumbpath'] );
		$thumbpath = "$usefolder/" . str_replace("%2F","/",rawurlencode( $row['thumbpath'] ));
	}
	tng_free_result($result);
}

adminwritelog( $admtext['mostwanted'] . " : $title" );

$truncated = preg_replace("/\r/", "",$truncated);
$truncated = preg_replace("/\n/", "",$truncated);
header("Content-Type: application/json; charset=" . $session_charset);
//echo "{'ID':'$ID','title':'$cleantitle','description':'$truncated','mwtype':'$mwtype','mediaID':'$mediaID','thumbpath':'$thumbpath','width':'$size[0]','height':'$size[1]','edit':'$allow_edit','del':'$allow_delete'}";
echo "{\"ID\":\"$ID\",\"title\":\"$cleantitle\",\"description\":\"$truncated\",\"mwtype\":\"$mwtype\",\"mediaID\":\"$mediaID\",\"thumbpath\":\"$thumbpath\",\"width\":\"{$size[0]}\",\"height\":\"{$size[1]}\",\"edit\":\"$allow_edit\",\"del\":\"$allow_delete\"";
echo "}";
?>