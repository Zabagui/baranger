<?php
include("begin.php");
include("adminlib.php");
$textpart = "branches";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

$query = "SELECT branch, description FROM $branches_table WHERE gedcom=\"$tree\"";
$result = tng_query($query);
$numrows = tng_num_rows($result);

if(!$numrows)
	echo "0";
else {
	echo "<option value=\"\"></option>\n";
	while($row = tng_fetch_assoc( $result )) {
		echo "<option value=\"{$row['branch']}\">{$row['description']}</option>\n";
	}
}
tng_free_result($result);
?>