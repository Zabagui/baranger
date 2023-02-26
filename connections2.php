<?php
include("begin.php");
include($cms['tngpath'] . "genlib.php");
$textpart = "connections";
include($cms['tngpath'] . "getlang.php");

include($cms['tngpath'] . "checklogin.php");

$connections_url = getURL( "connections", 1 );

header( "Location: " . "$connections_url" . $_SERVER['QUERY_STRING'] );
?>