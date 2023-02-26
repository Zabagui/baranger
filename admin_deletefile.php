<?php
include("begin.php");
include("adminlib.php");
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_delete ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

if($upgrade) {
	$fullpath = $rootpath . $filename;
	if(!empty($dbupgrade) && file_exists($rootpath . $dbupgrade))
		unlink($rootpath . $dbupgrade);
}
else {
	include($subroot . "importconfig.php");
	$fullpath = !empty($tngimpcfg['saveconfig']) ? ($subroot . $gedpath . "/" . $filename) : ($rootpath . $gedpath . "/" . $filename);
}
$deleted = file_exists( $fullpath ) ? unlink( $fullpath ) : false;

if($upgrade)
	header("Location: admin.php");
else
	echo $deleted ? $admtext['deleted'] . "&nbsp;<img src=\"img/tng_check.gif\"/>" : $admtext['notdeleted'];
?>
