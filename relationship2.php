<?php
include("begin.php");
include($cms['tngpath'] . "genlib.php");
$textpart = "search";
include($cms['tngpath'] . "getlang.php");

include($cms['tngpath'] . "checklogin.php");

$relationship_url = getURL( "relationship", 1 );

header( "Location: " . "$relationship_url" . $_SERVER['QUERY_STRING'] );
?>