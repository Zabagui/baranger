<?php
include("begin.php");
include("adminlib.php");
$textpart = "checkID";
//include("getlang.php");
include("$mylanguage/admintext.php");

include($cms['tngpath'] . "checklogin.php");

$query = "SELECT username FROM $users_table WHERE username = \"$checkuser\"";
$result = tng_query($query) or die ("{$admtext['cannotexecutequery']}: $query");

if( $result && tng_num_rows( $result ) ) {
	$message = "<b>$checkuser</b> {$admtext['idinuse']}";
	$success = "false";
}
else {
	$message = "<b>$checkuser</b> {$admtext['idok']}";
	$success = "true";
}
tng_free_result($result);

header("Content-Type: application/json; charset=" . $session_charset);
echo "{\"rval\":$success,\"html\":\"$message\"}";
?>
