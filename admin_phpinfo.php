<?php
include("begin.php");
include("adminlib.php");
$textpart = "setup";
//include("getlang.php");
include("$mylanguage/admintext.php");

if( $link ) {
	$admin_login = 1;
	include("checklogin.php");
	if( $assignedtree ) {
		$message = $admtext['norights'];
		header( "Location: admin_login.php?message=" . urlencode($message) );
		exit;
	}
}

echo phpinfo();
?>