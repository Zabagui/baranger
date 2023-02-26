<?php
include_once("begin.php");

global $tmp;
$tmp = getTemplateVars($templatenum);

include($cms['tngpath'] . "genlib.php");
//include($cms['tngpath'] . "getlang.php");
include($cms['tngpath'] . "$mylanguage/text.php");

include($cms['tngpath'] . "tngdblib.php");

if((strpos($_SERVER['SCRIPT_NAME'],"/changelanguage.php") === FALSE && strpos($_SERVER['SCRIPT_NAME'],"/newacctform.php") === FALSE && strpos($_SERVER['SCRIPT_NAME'],"/addnewacct.php") === FALSE &&
	strpos($_SERVER['SCRIPT_NAME'],"/login.php") === FALSE && (!isset($nologin) || !$nologin) && (strpos($_SERVER['SCRIPT_NAME'],"/suggest.php") === FALSE || !empty($enttype))) || !empty($_SESSION['currentuser']))
	include($cms['tngpath'] . "checklogin.php");
else {
	$currentuser = isset($_SESSION['currentuser']) ? $_SESSION['currentuser'] : "";
	$currentuserdesc = isset($_SESSION['currentuserdesc']) ? $_SESSION['currentuserdesc'] : "";
}
include($cms['tngpath'] . "log.php");
?>