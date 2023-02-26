<?php
include("begin.php");
include($cms['tngpath'] . "genlib.php");
$browsemedia_url = getURL( "browsemedia", 1 );

header( "Location: $browsemedia_url" . "mediatypeID=histories" );
?>
