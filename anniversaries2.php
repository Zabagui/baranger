<?php
include("begin.php");
include($cms['tngpath'] . "genlib.php");
$textpart = "search";
include($cms['tngpath'] . "getlang.php");

include($cms['tngpath'] . "checklogin.php");

$anniversaries_url = getURL( "anniversaries", 1 );

$tngyear = preg_replace("/[^0-9]/", "", $tngyear );
$tngkeywords = preg_replace("/[^A-Za-z0-9]/", "", $tngkeywords );

if( !isset($offset) ) $offset = "";
if( !isset($tngpage) ) $tngpage = "";

header( "Location: " . "$anniversaries_url" . "tngevent=$tngevent&tngdaymonth=$tngdaymonth&tngmonth=$tngmonth&tngyear=$tngyear&tngkeywords=$tngkeywords&tngneedresults=$tngneedresults&offset=$offset&tree=$tree&tngpage=$tngpage" );
?>