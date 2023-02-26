<?php
include("begin.php");
include("adminlib.php");
$textpart = "reports";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( $assignedtree ) {
	$message = $admtext['norights'];
	$color = "red";
}
else {
	$whatsnewmsg = stripslashes($whatsnewmsg);
	//if($session_charset != "UTF-8")
		//$whatsnewmsg = tng_utf8_decode($whatsnewmsg);

	$file = "$rootpath/whatsnew.txt";
	//write to file
	$fp = @fopen( $file, "w" );
	if( !$fp ) { die ( $admtext['cannotopen'] . " $file" ); }
	
	flock( $fp, LOCK_EX );
	fwrite( $fp, $whatsnewmsg );
	flock( $fp, LOCK_UN );
	fclose( $fp );
	$message = $admtext['msgsaved'];
	$color = "msgapproved";
}

if( !empty($submitx) ) {
	header( "Location: admin_misc.php?message=" . urlencode($message) );
}
else {
	header( "Location: admin_whatsnewmsg.php?color=$color&message=" . urlencode($message) );
}
?>