<?php
include("begin.php");
include("adminlib.php");
$textpart = "setup";
//include("getlang.php");
include("$mylanguage/admintext.php");

header("Content-type:text/html; charset=" . $session_charset);
if( $link ) {
	$admin_login = 1;
	include("checklogin.php");
	if( $assignedtree ) {
		echo $admtext['norights'];
		exit;
	}
}

//if backups or gedcom and using config path, then prepend the config path to old and new
if($type == "gedcom")
	include($subroot . "importconfig.php");

$parent = ($type == "backups" && !empty($tngconfig['saveconfig'])) || ($type == "gedcom" && !empty($tngimpcfg['saveconfig'])) ? $subroot : $rootpath;

if( file_exists($parent . $newfolder) )
	echo $admtext['fexists'];
elseif( (!empty($oldfolder) && file_exists( $parent . $oldfolder ) && @rename( $parent . $oldfolder, $parent . $newfolder )) || @mkdir( $parent . $newfolder, 0755 ) )
	echo $admtext['success'];
else
	echo $admtext['fmanual'];
?>
