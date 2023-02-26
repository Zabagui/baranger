<?php
include("begin.php");
include("adminlib.php");
$textpart = "language";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_edit ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");

$display = addslashes($display);
$folder = addslashes($folder);

$query = "UPDATE $languages_table SET display=\"$display\",folder=\"$folder\",charset=\"$langcharset\",norels=\"$langnorels\" WHERE languageID=\"$languageID\"";
$result = tng_query($query);

adminwritelog( "<a href=\"admin_editlanguage.php?languageID=$languageID\">{$admtext['modifylanguage']}: $languageID</a>" );

if( !empty($submitx) || !empty($message) ) {
	$message = $admtext['changestolanguage'] . " $display {$admtext['succsaved']}.";
	header( "Location: admin_languages.php?message=" . urlencode($message) );
}
else {
	header( "Location: admin_editlanguage.php?languageID=$languageID" );
}
?>
