<?php
include("begin.php");
include("adminlib.php");
$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
@set_time_limit(0);

require("adminlog.php");

if( !$allow_media_add ) {
	echo $admtext['norights'];
	exit;
}

header("Content-type:text/html; charset=" . $session_charset);

initMediaTypes();

$thumbquality = 80;
$maxsizeallowed = 5000; //KB
if( function_exists( 'imageJpeg' ) )
	include( "imageutils.php" );

$query = "SELECT mediaID, path, thumbpath, mediatypeID, usecollfolder, form, description, gedcom FROM $media_table where path != \"\"";
$result = tng_query($query);

$count = 0;
$conflicts = 0;
$conflictstr = "";
$updated = 0;

while( $row = tng_fetch_assoc( $result ) ) {
	$needsupdate = 0;
	$newthumbpath = "";
	$mediatypeID = $row['mediatypeID'];
	$treestr = $tngconfig['mediatrees'] ? $row['gedcom'] . "/" : "";
	$usefolder = $row['usecollfolder'] ? $mediatypes_assoc[$mediatypeID] : $mediapath;
	if( empty($row['form']) ) {
		$path = $row['thumbpath'] ? $row['thumbpath'] : $row['path'];
		preg_match( "/\.([^.]*?)$/", $path, $matches );
		$ext = strtoupper($matches[1]);
	}
	else
		$ext = trim($row['form']);

	if( trim($row['thumbpath']) && !$repath ) {
		if( (!$regenerate && file_exists( "$rootpath$usefolder/$treestr" . $row['thumbpath'] )) || !in_array($ext,$imagetypes) )
			$newthumbpath = "";
		else
			$newthumbpath = "$rootpath$usefolder/$treestr" . $row['thumbpath'];
	}
	elseif( $row['path'] && in_array($ext,$imagetypes) ) {
		//insert prefix in path directly before file name
		$thumbparts = pathinfo( $row['path'] );
		$thumbpath = $thumbparts['dirname'];
		if( $thumbpath == "." ) $thumbpath = "";
		if( $thumbpath ) $thumbpath .= "/";
		$lastperiod = strrpos( $thumbparts['basename'], "." );
		$base = substr( $thumbparts['basename'], 0, $lastperiod );
		$thumbpath .= $thumbprefix . $base . $thumbsuffix . "." . $thumbparts['extension'];
		$newthumbpath = "$rootpath$usefolder/$treestr$thumbpath";
		if( file_exists( $newthumbpath ) )
			$newthumbpath = "";
		$needsupdate = 1;
	}
	if( $newthumbpath ) {
		//$cleanfile = $session_charset == "UTF-8" ? utf8_decode($row['path']) : $row['path'];
		//$cleanpath = "$rootpath$usefolder/" . $cleanfile;
		$path = "$rootpath$usefolder/$treestr" . trim($row['path']);
        $destInfo  = pathinfo( $newthumbpath );
        if(strtoupper( $destInfo['extension'] ) != "PDF") {
			if( file_exists( $path ) ) {
				if( ceil( filesize( $path )/1000 ) > $maxsizeallowed ) {
					$needsupdate = 0;
					$conflicts++;
					$conflictstr .= $conflicts . ". \"" . truncateIt($row['description'],30) . "\" | " . $row['path'] . " " . $admtext['thumbsize'] . "<br />\n";  //file is too big
				}
				else {
					if( function_exists( 'imageJpeg' ) && image_createThumb( $path, $newthumbpath, $thumbmaxw, $thumbmaxh, $thumbquality ) ) {
				        if( strtoupper( $destInfo['extension'] ) == "GIF") {
				            $thumbpath = substr_replace( $thumbpath, 'jpg', -3 );
				            $newthumbpath = substr_replace( $newthumbpath, 'jpg', -3 );
						}
						@chmod( $newthumbpath, 0644 );
						$count++;
					}
					else {
						$needsupdate = 0;
						$conflicts++;
						$conflictstr .= $conflicts . ". \"" . truncateIt($row['description'],30) . "\" | " . $newthumbpath . " " . $admtext['thumbinv'] . "<br />\n";  //thumb couldn't be created
					}
				}
			}
			else {
				$needsupdate = 0;
				$conflicts++;
				$conflictstr .= $conflicts . ". \"" . truncateIt($row['description'],30) . "\" | " . $row['path'] . " " . $admtext['thumblost'] . "<br />\n";  //original doesn't exist
			}
		}
	}
	if( $needsupdate ) {
		$changedate = date ("Y-m-d H:i:s", time() + ( 3600 * $time_offset ) );
		$query = "UPDATE $media_table SET thumbpath=\"$thumbpath\", changedate=\"$changedate\", changedby=\"$currentuser\" WHERE mediaID=\"{$row['mediaID']}\"";
		$result2 = tng_query($query);
		$updated++;
	}
}
tng_free_result($result);

adminwritelog( "{$admtext['genthumbs']}: {$admtext['thumbsgenerated']}: $count; {$admtext['recsupdated']}: $updated; {$admtext['thumbconflicts']}: $conflicts" );

echo "<p><strong>{$admtext['thumbsgenerated']}:</strong> $count<br /><strong>{$admtext['recsupdated']}:</strong> $updated</p>";
if( $conflicts )
	echo "<p><strong>" . $admtext['thumbconflicts'] . ":</strong> $conflicts</p><p style=\"line-height:1.5\">$conflictstr</p>";
?>