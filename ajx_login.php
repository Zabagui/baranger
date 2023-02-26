<?php
include("begin.php");
$tngconfig['maint'] = "";
include($cms['tngpath'] . "genlib.php");
$textpart = "login";
include($cms['tngpath'] . "getlang.php");
include($cms['tngpath'] . "$mylanguage/text.php");

include($cms['tngpath'] . "log.php" );

header("Content-type:text/html; charset=" . $session_charset);
?>

<div style="margin:10px 20px 0px 20px;border:0px">
<?php 
	$loginfieldclass = "loginfield";
	$loginbtnclass = "btn loginbtn";
	$pwdfieldclass = "pwdfield";
	include($cms['tngpath'] . "loginlib.php"); 
?>
</div>