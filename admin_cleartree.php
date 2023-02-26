<?php
include("begin.php");
include("adminlib.php");
$textpart = "trees";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_delete ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");

include("treelib.php");

if(!isset($gedcom)) $gedcom = "";
$message = $admtext['tree'] . " $gedcom {$admtext['succcleared']}.";

adminwritelog( $admtext['deleted'] . ": {$admtext['tree']} $tree" );

header( "Location: admin_trees.php?message=" . urlencode($message) );
?>
