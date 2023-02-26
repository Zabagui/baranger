<?php
//$cms = array();  //taken out because it's unnecessary and it makes "require login" fail for historytemplate pages
if(isset($_GET['lang']) || isset($_GET['mylanguage']) || isset($_GET['language']) || isset($_GET['session_language']) || isset($_GET['rootpath'])) die("Sorry!");
$tngconfig = array();
$map = array();

if(strpos($_SERVER['SCRIPT_NAME'],"/admin_updateconfig.php") === FALSE)
	include("processvars.php");

include("subroot.php");
include_once("tngconnect.php");
include($tngconfig['subroot'] . "config.php");
$subroot = $tngconfig['subroot'] ? $tngconfig['subroot'] : $cms['tngpath'];
if( !$rootpath ) {
	$rootpath = dirname(__FILE__) . "/";
	if (preg_match("/WIN/i",PHP_OS)) {
	    $rootpath = str_replace("\\","/",$rootpath);
	}
	$saved_rootpath = "";
}
else
	$saved_rootpath = $rootpath;

$templatepfx = is_numeric($templatenum) ? "template" : "";
$templatepath = $templateswitching && $templatenum ? "templates/$templatepfx$templatenum/" : "";

if(isset($sitever))
	setcookie("tng_siteversion", $sitever, time()+31536000, "/");
else if(isset($_COOKIE['tng_siteversion']))
	$sitever = $_COOKIE['tng_siteversion'];
	
include_once("siteversion.php");
if(!isset($sitever))
	$sitever = getSiteVersion();

if(session_status() !== PHP_SESSION_ACTIVE) session_start();
$session_language = isset($_SESSION['session_language']) ? $_SESSION['session_language'] : $language;
$_SESSION['session_language'] = $session_language;
$session_charset = isset($_SESSION['session_charset']) ? $_SESSION['session_charset'] : $charset;

$endrootpath = "";

$languages_path = "languages/";
include($cms['tngpath'] . "getlang.php");
$link = tng_db_connect($database_host,$database_name,$database_username,$database_password,$database_port,$database_socket);

function getTemplateVars($templatenum) {
	global $templates_table;
	$query = "SELECT * FROM $templates_table WHERE template = \"$templatenum\"";
	$result = tng_query_noerror($query);

	$tmp = array();
	while( $row = tng_fetch_assoc( $result ) ) {
		$key = "t" . $row['template'] . "_" . $row['keyname'];
		if($row['language'])
			$key .= "_" . $row['language'];
		$tmp[$key] = $row['value'];
	}
	tng_free_result($result);
	return $tmp;
}
?>
