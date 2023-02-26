<?php
include("begin.php");
include("adminlib.php");
$textpart = "people";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

require("adminlog.php");

if( !$allow_add ) {
	$message = $admtext['norights'];
	exit;
}

if($session_charset != "UTF-8")
	$relationship = tng_utf8_decode($relationship);

/*
if (get_magic_quotes_gpc() == 0) {
	$relationship = addslashes($relationship);
}
*/

$template = "sssss";
$passocID = strtoupper($passocID);
$query = "INSERT INTO $assoc_table (gedcom, personID, passocID, relationship, reltype)  VALUES(?,?,?,?,?)";
$params = array(&$template, &$tree, &$personID, &$passocID, &$relationship, &$reltype);
tng_execute($query,$params);
$assocID = tng_insert_id();

if(!empty($revassoc)) {
	$params = array(&$template, &$tree, &$passocID, &$personID, &$relationship, &$orgreltype);
	tng_execute($query,$params);
}

adminwritelog( $admtext['addnewassoc'] . ": $assocID/$tree/$personID::$passocID ($relationship)" );

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
$namestr = cleanIt($name . ": " . stripslashes($relationship));
$namestr = truncateIt($namestr,75);
tng_free_result($result);
header("Content-type:text/html; charset=" . $session_charset);
echo "{\"id\":\"$assocID\",\"persfamID\":\"$personID\",\"tree\":\"$tree\",\"display\":\"$namestr\",\"allow_edit\":$allow_edit,\"allow_delete\":$allow_delete}";
?>