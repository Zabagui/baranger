<?php
include("begin.php");
include("adminlib.php");
$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_media_edit ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");

$albumname = addslashes($albumname);
$description = addslashes($description);
$keywords = addslashes($keywords);

if( empty($alwayson) ) $alwayson = 0;

$query = "UPDATE $albums_table SET albumname=\"$albumname\",description=\"$description\",keywords=\"$keywords\",active=\"$active\",alwayson=\"$alwayson\" WHERE albumID=\"$albumID\"";
$result = tng_query($query);

//cycle through all ph fields
//delete if requested
adminwritelog( $admtext['modifyalbum'] . ": $albumID" );

if( isset($_POST['savestay']) )
	header( "Location: admin_editalbum.php?albumID=$albumID&ref=1" );
else if( isset($_POST['saveclose']) ) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<body>
<script type="text/javascript">
	window.opener.location.reload(false);
	window.open('','_self').close()();
</script>
</body>
</html>
<?php
}
else {
	$message = $admtext['changestoalbum'] . " $albumID {$admtext['succsaved']}.";
	header( "Location: admin_albums.php?message=" . urlencode($message) );
}
?>