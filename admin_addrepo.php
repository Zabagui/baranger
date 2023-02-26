<?php
include("begin.php");
include("adminlib.php");
$textpart = "sources";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

$tree = $tree1;
if( !$allow_add || ( $assignedtree && $assignedtree != $tree ) ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");

$repoID = ucfirst( $repoID );
setcookie("tng_tree", $tree, 0);

/*
if (get_magic_quotes_gpc() == 0) {
	$reponame = addslashes($reponame);
	$address1 = addslashes($address1);
	$address2 = addslashes($address2);
	$city = addslashes($city);
	$state = addslashes($state);
	$zip = addslashes($zip);
	$country = addslashes($country);
	$phone = addslashes($phone);
	$email = addslashes($email);
	$www = addslashes($www);
}
*/

$newdate = date ("Y-m-d H:i:s", time() + ( 3600 * $time_offset ) );

if( $address1 || $address2 || $city || $state || $zip || $country || $phone || $email || $www ) {
	$template = "ssssssssss";
	$query = "INSERT INTO $address_table (address1, address2, city, state, zip, country, gedcom, phone, email, www) VALUES(?,?,?,?,?,?,?,?,?,?)";
	$params = array(&$template, &$address1, &$address2, &$city, &$state, &$zip, &$country, &$tree, &$phone, &$email, &$www);
	tng_execute($query,$params);
	$addressID = tng_insert_id();
}
else
	$addressID = "";

if( !$addressID ) $addressID = 0;
$template = "ssssss";
$query = "INSERT INTO $repositories_table (repoID,reponame,addressID,changedate,gedcom,changedby) VALUES (?,?,?,?,?,?)";
$params = array(&$template, &$repoID, &$reponame, &$addressID, &$newdate, &$tree1, &$currentuser);
tng_execute($query,$params);

adminwritelog( "<a href=\"admin_editrepo.php?repoID=$repoID&amp;tree=$tree\">{$admtext['addnewrepo']}: $tree/$repoID</a>" );

header( "Location: admin_editrepo.php?repoID=$repoID&tree=$tree&added=1" );
?>