<?php
$nologin = 1;
include("tng_begin.php");

$dataprotect_url = getURL( "data_protection_policy", 0 );

$logstring = "<a href=\"$dataprotect_url\">" . xmlcharacters($text['dataprotect']) . "</a>";
writelog($logstring);
preparebookmark($logstring);

tng_header( $text['dataprotect'], $flags ); 

$langfolder = findlangfolder("data_protection_policy.php");

include($cms['tngpath'] . "$langfolder/data_protection_policy.php");

tng_footer( "" );
?>