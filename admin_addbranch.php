<?php
include("begin.php");
include("adminlib.php");
$textpart = "branches";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( $assignedbranch || !$allow_add ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");
setcookie("tng_tree", $tree, 0);

/*
if (get_magic_quotes_gpc() == 0) {
	$branch = addslashes($branch);
	$description = addslashes($description);
}
*/

if( empty($dospouses) )
	$dospouses = 0;
$template = "ssssssss";
$query = "INSERT INTO $branches_table (gedcom,branch,description,personID,agens,dgens,dagens,inclspouses,action) VALUES (?,?,?,?,?,?,?,?,'2')";
$params = array(&$template, &$tree, &$branch, &$description, &$personID, &$agens, &$dgens, &$dagens, &$dospouses);
$affected_rows = tng_execute_noerror($query,$params);
if($affected_rows == 1) {
	$message = $admtext['branch'] . " $description {$admtext['succadded']}.";

	adminwritelog( $admtext['addnewbranch'] . " : $tree/$description" );
}
else
	$message = $admtext['branch'] . " $description {$admtext['idexists']}.";


if( !empty($submitx) ) {
	header( "Location: admin_branches.php?message=" . urlencode($message) );
}
else {
	header( "Location: admin_editbranch.php?branch=$branch&tree=$tree" );
}
?>