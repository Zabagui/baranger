<?php
include("begin.php");
include("adminlib.php");
$textpart = "sources";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include($cms['tngpath'] . "checklogin.php");

require("adminlog.php");

$query = "DELETE FROM $citations_table WHERE citationID=\"$citationID\"";
$result = @tng_query($query);

$query = "SELECT count(citationID) as ccount FROM $citations_table WHERE gedcom=\"$tree\" AND persfamID=\"$personID\" AND eventID=\"$eventID\"";
$result = tng_query($query);
$row = tng_fetch_assoc($result);
tng_free_result($result);

if($_SESSION['lastcite'] == $tree . "|" . $citationID)
	unset($_SESSION['lastcite']);

adminwritelog( "{$admtext['deleted']}: {$admtext['citation']} $citationID" );

echo $row['ccount'];
?>
