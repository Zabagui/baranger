<?php
include("begin.php");
if(!empty($cms['events'])){include('cmsevents.php'); cms_logout();}

if(session_status() !== PHP_SESSION_ACTIVE) session_start();
$session_language = isset($_SESSION['session_language']) ? $_SESSION['session_language'] : $language;
$session_charset = isset($_SESSION['session_charset']) ? $_SESSION['session_charset'] : $charset;
session_unset();
session_destroy();
$newroot = preg_replace( "/\//", "", $rootpath );
$newroot = preg_replace( "/\s*/", "", $newroot );
$newroot = preg_replace( "/\./", "", $newroot );
setcookie("tnguser_$newroot", "", time()-31536000, "/");
setcookie("tngpass_$newroot", "", time()-31536000, "/");
setcookie("tngloggedin_$newroot", "", time()-31536000, "/"); 

if(session_status() !== PHP_SESSION_ACTIVE) session_start();
$_SESSION['session_language'] = $session_language;
$_SESSION['session_charset'] = $session_charset;

if(!empty($_GET['admin_login']))
	header("Location: admin_login.php");
elseif( $requirelogin || !isset($_SERVER["HTTP_REFERER"]))
	header("Location: $homepage");
else
	header( "Location: " . $_SERVER["HTTP_REFERER"] );
?>