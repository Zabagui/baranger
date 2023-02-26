<?php
$assignedtree = $_SESSION['assignedtree'];
$assignedbranch = $_SESSION['assignedbranch'];
$currentuser = $_SESSION['currentuser'];

if( $_SESSION['logged_in'] && $_SESSION['session_rp'] == $rootpath && $currentuser) {
	$allow_living = $_SESSION['allow_living'];
	$allow_private = $_SESSION['allow_private'];
	$allow_private_notes = $_SESSION['allow_private_notes'];
	$allow_lds = $_SESSION['allow_lds'];
}
else {
	$query = "SELECT * FROM $users_table WHERE BINARY username = \"$tngusername\"";
	$result = tng_query($query) or die ("Cannot execute query: $query");
	if( tng_num_rows( $result ) ) {
		$allow_living = $allow_private = $allow_lds = $allow_private_notes = 0;
	}
	else {
		$allow_living = $allow_private = $allow_lds = $allow_private_notes = 1;
	}
	tng_free_result($result);
}
?>