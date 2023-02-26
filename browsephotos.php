<?php
include("begin.php");
include($cms['tngpath'] . "genlib.php");
$browsemedia_url = getURL( "browsemedia", 1 );

if($_GET['showdocs'] == 1)
	header( "Location: $browsemedia_url" . "mediatypeID=documents" );
else
	header( "Location: $browsemedia_url" . "mediatypeID=photos" );
?>
