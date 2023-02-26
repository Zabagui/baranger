<?php
include("begin.php");
include("adminlib.php");
$textpart = "people";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include($cms['tngpath'] . "checklogin.php");

require("adminlog.php");

$query = "DELETE FROM $assoc_table WHERE assocID=\"$assocID\"";
$result = tng_query($query);

//delete the association going in the opposite direction
$query = "DELETE FROM $assoc_table WHERE personID=\"$passocID\" AND passocID=\"$personID\" AND gedcom=\"$tree\"";
$result = tng_query($query);

$query = "SELECT count(assocID) as acount FROM $assoc_table WHERE gedcom=\"$tree\" AND personID=\"$personID\"";
$result = tng_query($query);
$row = tng_fetch_assoc($result);
tng_free_result($result);

adminwritelog( "{$admtext['deleted']}: {$admtext['association']} $assocID" );

echo $row['acount'];
?>