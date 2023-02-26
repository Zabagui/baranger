<?php
include("begin.php");
include("adminlib.php");
$textpart = "dna";
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_edit && !$allow_add ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");

$dna_group = addslashes($dna_group);
$description = addslashes($description);

$query = "UPDATE $dna_groups_table SET description = \"$description\", test_type = \"$test_type\"  WHERE dna_group=\"$dna_group\"";
$result = tng_query($query);

$query = "UPDATE $dna_tests_table SET dna_group_desc = \"$description\"  WHERE dna_group=\"$dna_group\"";
$result = tng_query($query);

adminwritelog( "<a href=\"admin_edit_dna_group.php?dna_group=$dna_group&amp;tree=$tree&amp;test_type=$test_type\">{$admtext['modifydnagroup']}: $dna_group</a>" );

$message = $admtext['changestogroup'] . " $dna_group {$admtext['succsaved']}.";
header( "Location: admin_dna_groups.php?message=" . urlencode($message) );
?>