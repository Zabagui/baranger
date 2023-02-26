<?php
include("begin.php");
include("adminlib.php");
$textpart = "eventtypes";
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

$type = addslashes($type);
$tag2 = addslashes($tag2);
$defdisplay = addslashes($defdisplay);

if( $tag2 )
	$tag = $tag2;
else
	$tag = $tag1;
if( !$display ) $display = $defdisplay;
$query = "UPDATE $eventtypes_table SET tag=\"$tag\",type=\"$type\",description=\"$description\",display=\"$display\",keep=\"$keep\",collapse=\"$collapse\",ordernum=\"$ordernum\",ldsevent=\"$ldsevent\" WHERE eventtypeID=\"$eventtypeID\"";
$result = tng_query($query);

adminwritelog( $admtext['modifyeventtype'] . ": $eventtypeID" );

if( !empty($submitx) ) {
	$message = $admtext['changestoevtype'] . " $eventtypeID {$admtext['succsaved']}.";
	header( "Location: admin_eventtypes.php?message=" . urlencode($message) );
}
else {
	header( "Location: admin_editeventtype.php?eventtypeID=$eventtypeID" );
}
?>
