<?php
include("begin.php");
include("adminlib.php");
$textpart = "checkID";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include($cms['tngpath'] . "checklogin.php");

if( $type == "person" ) {
	$query = "SELECT personID FROM $people_table WHERE personID = \"$checkID\" AND gedcom = \"$tree\"";
	$prefix = $tngconfig['personprefix'];
	$suffix = $tngconfig['personsuffix'];
}
else if( $type == "family" ) {
	$query = "SELECT familyID FROM $families_table WHERE familyID = \"$checkID\" AND gedcom = \"$tree\"";
	$prefix = $tngconfig['familyprefix'];
	$suffix = $tngconfig['familysuffix'];
}
else if( $type == "source" ) {
	$query = "SELECT sourceID FROM $sources_table WHERE sourceID = \"$checkID\" AND gedcom = \"$tree\"";
	$prefix = $tngconfig['sourceprefix'];
	$suffix = $tngconfig['sourcesuffix'];
}
else if( $type == "repo" ) {
	$query = "SELECT repoID FROM $repositories_table WHERE repoID = \"$checkID\" AND gedcom = \"$tree\"";
	$prefix = $tngconfig['repoprefix'];
	$suffix = $tngconfig['reposuffix'];
}

$result = tng_query($query) or die ("{$admtext['cannotexecutequery']}: $query");
$prefixlen = strlen( $prefix );
$suffixlen = strlen( $suffix ) * -1;

header("Content-type:text/html; charset=" . $session_charset);
if( $result && tng_num_rows( $result ) ) {
	echo "<span class=\"msgerror\">ID $checkID {$admtext['idinuse']}</span>";
}
else if( ( $prefix && ( substr( $checkID, 0, $prefixlen ) != $prefix || !is_numeric( substr( $checkID, $prefixlen ) ) ) ) ||
	( $suffix && ( substr( $checkID, $suffixlen ) != $suffix || !is_numeric( substr( $checkID, 0, $suffixlen ) ) ) ) ) {
	echo "<span class=\"msgerror\">$checkID {$admtext['idnotvalid']} $prefix</span>";
}
else {
	echo "<span class=\"msgapproved\">ID $checkID {$admtext['idok']}</span>";
}
tng_free_result($result);
?>
