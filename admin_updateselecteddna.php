<?php
include("begin.php");
include("adminlib.php");
$textpart = "dna";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_edit || !$allow_delete ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");

$count = 0;

$xdnaaction = stripslashes($xdnaaction);
if( $xdnaaction == $admtext['deleteselected'] ) {
	$query = "DELETE FROM $dna_tests_table WHERE 1=0";

	foreach( array_keys($_POST) as $key ) {
		if( substr( $key, 0, 3 ) == "dna" ) {
			$count++;
			$testID = substr( $key, 3 );
			$query .= " OR testID=\"$testID\"";

			$aquery = "DELETE FROM $dna_links_table WHERE testID=\"$testID\"";
			$aresult = tng_query($aquery) or die ($admtext['cannotexecutequery'] . ": $aquery");

		}
	}

	$result = tng_query($query);
}

adminwritelog( $admtext['modifydna'] . ": " . $admtext['all'] );

if( $count )
	$message = $admtext['changestoalldna'] . " {$admtext['succsaved']}.";
else
	$message = $admtext['nochanges'];
header( "Location: admin_dna_tests.php?message=" . urlencode($message) );
?>