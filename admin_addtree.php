<?php
include("begin.php");
include("adminlib.php");
$textpart = "trees";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( $assignedtree || !$allow_add ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");

$gedcom = preg_replace("/\s*/", "", $gedcom);
$treenamedisp = stripslashes($treename);

/*
if (get_magic_quotes_gpc() == 0) {
	$treename = addslashes($treename);
	$description = addslashes($description);
	$owner = addslashes($owner);
	$email = addslashes($email);
	$address = addslashes($address);
	$city = addslashes($city);
	$state = addslashes($state);
	$country = addslashes($country);
	$zip = addslashes($zip);
	$phone = addslashes($phone);
}
*/

if( empty($disallowgedcreate) ) $disallowgedcreate = 0;
if( empty($disallowpdf) ) $disallowpdf = 0;
if( empty($private) ) $private = 0;
$template = "ssssssssssssss";
$query = "INSERT IGNORE INTO $trees_table (gedcom,treename,description,owner,email,address,city,state,country,zip,phone,secret,disallowgedcreate,disallowpdf) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$params = array(&$template, &$gedcom, &$treename, &$description, &$owner, &$email, &$address, &$city, &$state, &$country, &$zip, &$phone, &$private, &$disallowgedcreate, &$disallowpdf);
$affected_rows = tng_execute_noerror($query,$params);
if($affected_rows == 1) {
	adminwritelog( "<a href=\"admin_edittree.php?tree=$gedcom\">{$admtext['addnewtree']}: $gedcom/$treename</a>" );

	if( $beforeimport == "yes" )
		echo "1";
	else {
		if( !empty($submitx) || !empty($message) ) {
			$message = $admtext['tree'] . " $treenamedisp {$admtext['succadded']}.";
			header( "Location: admin_trees.php?message=" . urlencode($message) );
		}
		else {
			header( "Location: admin_edittree.php?tree=$gedcom" );
		}
	}
}
else {
	$message = $admtext['treeexists'];
	if($beforeimport)
		echo $message;
	else
		header( "Location: admin_newtree.php?message=" . urlencode($message) . "&treename=$treename&description=$description&owner=$owner&email=$email&address=$address&city=$city&state=$state&country=$country&zip=$zip&phone=$phone&private=$private&disallowgedcreate=$disallowgedcreate" );
}
?>