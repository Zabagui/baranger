<?php
include("begin.php");
include("adminlib.php");
$textpart = "notes";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_add || ( $assignedtree && $assignedtree != $tree ) ) {
	exit;
}

require("adminlog.php");

if($session_charset != "UTF-8")
	$note = tng_utf8_decode($note);
$orgnote = preg_replace( "/$lineending/", " ", stripslashes($note) );
/*
if (get_magic_quotes_gpc() == 0) {
	$note = addslashes($note);
}
*/

$template = "ss";
$query = "INSERT INTO $xnotes_table (noteID, gedcom, note)  VALUES(\"\", ?, ?)";
$params = array(&$template, &$tree, &$note);
tng_execute($query,$params);
$xnoteID = tng_insert_id();

if( !isset($private) ) $private = "0";
$template = "sssss";
$query = "INSERT INTO $notelinks_table (persfamID, gedcom, xnoteID, eventID, secret, ordernum) VALUES (?,?,?,?,?, 999)";
$params = array(&$template, &$persfamID, &$tree, &$xnoteID, &$eventID, &$private);
tng_execute($query,$params);
$ID = tng_insert_id();

adminwritelog( $admtext['addnewnote'] . ": $tree/$persfamID/$xnoteID/$eventID" );

$orgnote = cleanIt($orgnote);
$truncated = truncateIt($orgnote,75);
header("Content-type:text/html; charset=" . $session_charset);
echo "{\"id\":\"$ID\",\"persfamID\":\"$persfamID\",\"tree\":\"$tree\",\"eventID\":\"$eventID\",\"display\":\"$truncated\",\"allow_edit\":$allow_edit,\"allow_delete\":$allow_delete}";
?>