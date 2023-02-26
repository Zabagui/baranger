<?php
include("begin.php");
include($cms['tngpath'] . "genlib.php");
$textpart = "getperson";
include($cms['tngpath'] . "getlang.php");
include($cms['tngpath'] . "$mylanguage/text.php");

include($cms['tngpath'] . "checklogin.php");

$newroot = preg_replace( "/\//", "", $rootpath );
$newroot = preg_replace( "/\s*/", "", $newroot );
$newroot = preg_replace( "/\./", "", $newroot );
$ref = "tngbookmarks_$newroot";
$bookmarks = $_COOKIE[$ref];
$found = 0;

$bookmarks = explode("|", $_COOKIE[$ref]);
$bookmarkstr = "";
$bcount = 0;
foreach( $bookmarks as $bookmark ) {
	if(trim($bookmark) ) {
		if( $idx != $bcount )
			$bookmarkstr = $bookmarkstr ? $bookmarkstr . "|" . $bookmark : $bookmark;
		$bcount++;
	}
}

//echo $bookmarkstr; exit;
setcookie($ref, stripslashes($bookmarkstr), time()+31536000, "/");
//setcookie($ref, "", time()+31536000, "/");

$bookmarks_url = getURL( "bookmarks", 0 );
header( "Location: $bookmarks_url" );
?>

