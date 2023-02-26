<?php
include("begin.php");
include($cms['tngpath'] . "genlib.php");


if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if(empty($instance)) $instance = "";

$instance = preg_replace("/[^0-9]/", '', $instance);
//$newlanguage = preg_replace("/[^0-9]/", '', $newlanguage);
$newlanguage = preg_replace("/[^0-9]/", "", ${"newlanguage".$instance});

$query = "SELECT folder, charset, norels FROM $languages_table WHERE languageID = \"$newlanguage\"";
$result = tng_query($query) or die ("Cannot execute query: $query"); //message is hardcoded because we haven't included the text file yet
$row = tng_fetch_assoc($result);
tng_free_result( $result );

if(!empty($row)) {
	$session_language = $_SESSION['session_language'] = $row['folder'];
	$session_charset = $_SESSION['session_charset'] = $row['charset'];
	$session_norels = $_SESSION['session_norels'] = $row['norels'];
}
else {
	$session_language = $_SESSION['session_language'] = "";
	$session_charset = $_SESSION['session_charset'] = "";
	$session_norels = $_SESSION['session_norels'] = 0;
}

if(!empty( $row['folder']) && file_exists($languages_path . $row['folder'])) {
	$newroot = preg_replace( "/\//", "", $rootpath );
	$newroot = preg_replace( "/\s*/", "", $newroot );
	$newroot = preg_replace( "/\./", "", $newroot );
	setcookie("tnglang_$newroot", $row['folder'], time()+31536000, "/");
	setcookie("tngchar_$newroot", $row['charset'], time()+31536000, "/");
	setcookie("tngnorels_$newroot", $row['norels'], time()+31536000, "/");
}
//$textpart = "language";
//include($cms[tngpath] . "$session_language/text.php");
//include($cms[tngpath] . "checklogin.php");

if( $_SESSION['destinationpage8'] )
	header( "Location: " . $_SESSION['destinationpage8'] );
else {
	if ( empty( $_SERVER['HTTP_REFERER'] ) )
		header( "Location: " . dirname($_SERVER['REQUEST_URI'])."/" );
	else
		header( "Location: " . $_SERVER['HTTP_REFERER'] );
}
?>