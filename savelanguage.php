<?php
include("begin.php");
include($cms['tngpath'] . "genlib.php");

if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if(!isset($newlanguage)) die('Sorry!');

$newlanguage = preg_replace("/[^0-9]/", '', $newlanguage);

$query = "SELECT display, folder, charset, norels FROM $languages_table WHERE languageID = \"$newlanguage\"";
$result = tng_query($query) or die ("Cannot execute query: $query"); //message is hardcoded because we haven't included the text file yet
$row = tng_fetch_assoc($result);
tng_free_result( $result );

$session_language = $_SESSION['session_language'] = $row['folder'];
$session_charset = $_SESSION['session_charset'] = $row['charset'];
$session_norels = $_SESSION['session_norels'] = $row['norels'];

$newroot = preg_replace( "/\//", "", $rootpath );
$newroot = preg_replace( "/\s*/", "", $newroot );
$newroot = preg_replace( "/\./", "", $newroot );
setcookie("tnglang_$newroot", $row['folder'], time()+31536000, "/");
setcookie("tngchar_$newroot", $row['charset'], time()+31536000, "/");
setcookie("tngnorels_$newroot", $row['norels'], time()+31536000, "/");

header( "Location: $homepage" );
?>