<?php
include("begin.php");
$tngconfig['maint'] = "";
include($cms['tngpath'] . "genlib.php");
include($cms['tngpath'] . "getlang.php");
include($cms['tngpath'] . "$mylanguage/text.php");
tng_db_connect($database_host,$database_name,$database_username,$database_password,$database_port,$database_socket) or exit;
include($cms['tngpath'] . "log.php" );

//if medialinkID, get caption from there
//else get caption from mediaID
if($medialinkID)
	$query = "SELECT description, notes, altdescription, altnotes
		FROM ($media_table, $medialinks_table)
		WHERE medialinkID = \"$medialinkID\" and $media_table.mediaID = $medialinks_table.mediaID";
else
	$query = "SELECT description, notes
		FROM $media_table
		WHERE mediaID = \"$mediaID\"";
$result = tng_query($query);

$imgrow = tng_fetch_assoc($result);
$title = isset($imgrow['altdescription']) && $imgrow['altdescription'] ? $imgrow['altdescription'] : $imgrow['description'];
if($title)
	$title = "<strong>$title</strong>";
$desc = truncateIt(isset($imgrow['altnotes']) && $imgrow['altnotes'] ? $imgrow['altnotes'] : $imgrow['notes'], 200);
$caption = $title && $desc ? $title . "<br/>" . $desc : $title . $desc;
tng_free_result($result);

header("Content-type:text/html; charset=" . $session_charset);

echo $caption;
?>