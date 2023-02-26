<?php
include("begin.php");
include("adminlib.php");
$textpart = "setup";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( $assignedtree ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");

if( $table == "all" ) {
	$tablelist = array($cemeteries_table, $people_table, $families_table, $children_table, $languages_table, $places_table, $states_table, $image_tags_table,
		$countries_table, $sources_table, $repositories_table, $citations_table, $reports_table, $events_table, $eventtypes_table, $trees_table, $notelinks_table,
		$xnotes_table, $users_table, $tlevents_table, $temp_events_table, $templates_table, $branches_table, $branchlinks_table, $dna_groups_table, $dna_links_table, $dna_tests_table,
		$address_table, $albums_table, $albumlinks_table, $album2entities_table, $assoc_table, $media_table, $medialinks_table, $mediatypes_table, $mostwanted_table);
	$tablename = $admtext['alltables'];
	$message = "$tablename {$admtext['succoptimized']}.";
}
else {
	$tablelist = array("$table");
	$tablename = $table;
	$message = "{$admtext['table']} $tablename {$admtext['succoptimized']}.";
}

foreach( $tablelist as $thistable ) {
	$query = "OPTIMIZE TABLE $thistable";
	$result = tng_query($query);
}

header("Content-type:text/html; charset=" . $session_charset);
adminwritelog( $admtext['optimize'] . ": $tablename" );
if($table == "all")
	header( "Location: admin_utilities.php?message=" . urlencode($message) );
else
	echo $table . "&" . $admtext['succoptimized'];
?>