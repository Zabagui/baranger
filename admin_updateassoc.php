<?php
include("begin.php");
include("adminlib.php");
$textpart = "people";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

require("datelib.php");

if( !$allow_edit ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");

$orgrelationship = $relationship;
if($session_charset != "UTF-8") {
	$relationship = tng_utf8_decode($relationship);
	$orgrelationship = tng_utf8_decode(stripslashes($orgrelationship));
}
$relationship = addslashes($relationship);
$passocID = strtoupper($passocID);

$query = "UPDATE $assoc_table SET passocID=\"$passocID\", relationship=\"$relationship\", reltype=\"$reltype\" WHERE assocID=\"$assocID\"";
$result = tng_query($query);

if(!isset($personID)) $personID = "";

adminwritelog( $admtext['modifyassoc'] . ": $assocID/$tree/$personID::$passocID ($relationship)" );

//get name
if($reltype == "I") {
	$query = "SELECT personID, gedcom, firstname, lnprefix, lastname, prefix, suffix, title, sex, nameorder, living, private, branch, birthdate, birthdatetr, altbirthdatetr, deathdate
		FROM $people_table WHERE personID=\"$passocID\" AND gedcom=\"$tree\"";
	$result = tng_query($query);
	$row = tng_fetch_assoc( $result );
	$righttree = checktree($tree);
	$rightbranch = $righttree ? checkbranch($row['branch']) : false;
	$rights = determineLivingPrivateRights($row, $righttree, $rightbranch);
	$row['allow_living'] = $rights['living'];
	$row['allow_private'] = $rights['private'];
	$name = getName($row) . " ($passocID)";
}
else {
	$query = "SELECT husband, wife, gedcom, familyID FROM $families_table
		WHERE familyID=\"$passocID\" AND gedcom=\"$tree\"";
	$result = tng_query($query);
	$row = tng_fetch_assoc( $result );
	$name = getFamilyName($row);
}
//$name = $session_charset != "UTF-8" ? utf8_encode($name) : $name;
$namestr = cleanIt($name . ": " . $orgrelationship);

$namestr = truncateIt($namestr,75);
tng_free_result($result);
header("Content-type:text/html; charset=" . $session_charset);
echo "{\"display\":\"$namestr\"}";
?>