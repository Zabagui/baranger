<?php
include("begin.php");
include("adminlib.php");
$textpart = "checkID";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include($cms['tngpath'] . "checklogin.php");

$query = "SELECT userId FROM $users_table WHERE LOWER(email) = LOWER(\"$checkemail\")";
$result = tng_query($query) or die ("{$admtext['cannotexecutequery']}: $query");

if( $result && tng_num_rows( $result ) ) {
	$message = $admtext['isinuse'];
	$success = "msgerror";
}
else {
	$message = $admtext['isok'];
	$success = "msgapproved";
}
tng_free_result($result);

header("Content-type:text/html; charset=" . $session_charset);
echo "{\"result\":\"$success\",\"message\":\"$message\"}";
?>
