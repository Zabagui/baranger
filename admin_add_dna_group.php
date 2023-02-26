<?php
include("begin.php");
include("adminlib.php");
$textpart = "dna";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_add ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");

$dna_group = addslashes($dna_group);
$test_type = addslashes($test_type);
$description = addslashes($description);

$query = "INSERT INTO $dna_groups_table (dna_group,test_type,gedcom,description,action) VALUES (\"$dna_group\",\"$test_type\",\"$tree\",\"$description\",\"2\")";
$result = tng_query($query);
$success = tng_affected_rows();

adminwritelog( "<a href=\"admin_dna_groups.php\">{$admtext['addgroup']}: $dna_group</a>" );

	$message = $admtext['dna_group'] . " $dna_group {$admtext['succadded']}.";
	header( "Location: admin_dna_groups.php?message=$message&amp;dna_group=$dna_group&amp;test_type=$test_type&amp;tree=$tree" );
?>