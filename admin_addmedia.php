<?php
include("begin.php");
include("adminlib.php");
$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_media_add ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");
initMediaTypes();

$exptime = 0;
setcookie("lastcoll", $mediatypeID, $exptime);
setcookie("tng_tree", $tree, $exptime);

$thumbquality = 80;
if( function_exists( 'imageJpeg' ) )
	include( "imageutils.php" );

$path = stripslashes($path);
$thumbpath = stripslashes($thumbpath);
if( substr( $path, 0, 1 ) == "/" )
	$path = substr( $path, 1 );

$usefolder = $usecollfolder ? $mediatypes_assoc[$mediatypeID] : $mediapath;
$treestr = $tngconfig['mediatrees'] && $tree ? $tree . "/" : "";
$newpath = "$rootpath$usefolder/$treestr$path";

/*
if (get_magic_quotes_gpc() == 0) {
	$description = addslashes($description);
	$notes = addslashes($notes);
	$datetaken = addslashes($datetaken);
	$owner = addslashes($owner);
	$status = addslashes($status);
	$bodytext = addslashes($bodytext);
	$width = addslashes($width);
	$height = addslashes($height);
	$plot = addslashes($plot);
}
*/

if( !empty($latitude) && !empty($longitude) && empty($zoom) )
	$zoom = 13;
if( !empty($abspath) )
	$path = $mediaurl;
else
	$abspath = 0;
if( empty($showmap) ) $showmap = "0";
if( empty($usenl) ) $usenl = 0;
if( empty($alwayson) ) $alwayson = 0;
if( empty($newwindow) ) $newwindow = 0;
if( empty($private) ) $private = 0;
if( empty($usecollfolder) ) $usecollfolder = 0;
if( empty($width) ) $width = 0;
if( empty($height) ) $height = 0;
if( empty($cemeteryID) ) $cemeteryID = 0;
if( empty($linktocem) ) $linktocem = 0;
if( empty($zoom) ) $zoom = 0;

if(!empty($place)) {
	$placetree = $tngconfig['places1tree'] ? "" : $tree;
	$query = "INSERT IGNORE INTO $places_table (gedcom,place,placelevel,latitude,longitude,zoom,geoignore,temple,changedate,changedby) VALUES (\"$placetree\",\"$place\",\"0\",\"$latitude\",\"$longitude\",\"$zoom\",\"0\",\"\",\"$newdate\",\"$currentuser\")";
	$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
	if($tngconfig['autogeo'] && tng_affected_rows() && (!$latitude || !$longitude)) {
	    $ID = tng_insert_id();
	    $message = geocode($place, 0, $ID);
	}
}

try {
	$fileparts = pathinfo( $path );
	$form = strtoupper( $fileparts['extension'] );
	$newdate = date ("Y-m-d H:i:s", time() + ( 3600 * $time_offset ) );
	$mediakey = $path ? "$usefolder/$path" : time();
	$template = "sssssssssssssssssssssssssssssss";
	$query = "INSERT IGNORE INTO $media_table (mediatypeID,mediakey,gedcom,path,thumbpath,description,notes,width,height,datetaken,placetaken,owner,changedate,changedby,form,alwayson,map,abspath,status,cemeteryID,plot,showmap,linktocem,latitude,longitude,zoom,bodytext,usenl,newwindow,private,usecollfolder)
			VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	$params = array(&$template, &$mediatypeID, &$mediakey, &$tree, &$path, &$thumbpath, &$description, &$notes, &$width, &$height, &$datetaken, &$placetaken, &$owner, &$newdate, &$currentuser, &$form, &$alwayson, &$imagemap, &$abspath, &$status, &$cemeteryID, &$plot, &$showmap, &$linktocem, &$latitude, &$longitude, &$zoom, &$bodytext, &$usenl, &$newwindow, &$private, &$usecollfolder);
	$affected_rows = tng_execute_noerror($query,$params);
	if($affected_rows == 1) {
		$mediaID = tng_insert_id();

		if( $newfile && $newfile != "none" ) {
			if( @move_uploaded_file($newfile, $newpath) ) 
				@chmod( $newpath, 0644 );
			else {
			//improper permissions or folder doesn't exist (root path may be wrong)
				$message = $admtext['notcopied'] . " $newpath {$admtext['improperpermissions']}.";
				header( "Location: admin_media.php?message=" . urlencode($message) );
				exit;
			}
		}

		if($thumbpath) {
			if( substr( $thumbpath, 0, 1 ) == "/" )
				$thumbpath = substr( $thumbpath, 1 );
			$newthumbpath = "$rootpath$usefolder/$treestr$thumbpath";

			if( function_exists( 'imageJpeg' ) && $thumbcreate == "auto" ) {
				///$cleanpath = $session_charset == "UTF-8" ? utf8_decode($newpath) : $newpath;
				//$cleannewthumbpath = $session_charset == "UTF-8" ? utf8_decode($newthumbpath) : $newthumbpath;
				if( image_createThumb( $newpath, $newthumbpath, $thumbmaxw, $thumbmaxh, $thumbquality ) ) {
			        $destInfo  = pathInfo( $newthumbpath ); 
			        if( strtoupper( $destInfo['extension'] ) == "GIF" || strtoupper( $destInfo['extension'] ) == "PDF") {
			            $thumbpath = substr_replace( $thumbpath, 'jpg', -3 ); 
			            $newthumbpath = substr_replace( $newthumbpath, 'jpg', -3 ); 
					}
					@chmod( $newthumbpath, 0644 );
				}
				else {
				//could not create thumbnail (size or type problem) or permissions (root path may be wrong)
					$message = $admtext['thumbnailnotcopied'] . " $newthumbpath {$admtext['improper2']}.";
					$thumbpath = "";
				}
			}
			else {
				if( $newthumb && $newthumb != "none" ) {
					if( @move_uploaded_file($newthumb, $newthumbpath) ) 
						@chmod( $newthumbpath, 0644 );
					else {
					//improper permissions or folder doesn't exist (root path may be wrong)
						$message = $admtext['thumbnailnotcopied'] . " $newthumbpath {$admtext['improperpermissions']}.";
						$thumbpath = "";
					}
				}
			}
		}

		if($link_personID) {
			$query = "SELECT count(medialinkID) as count FROM $medialinks_table WHERE personID = \"$link_personID\" AND gedcom = \"$link_tree\"";
			$result = @tng_query($query);
			if( $result ) {
				$row = tng_fetch_assoc($result);
				$newrow = $row['count'] + 1;
				tng_free_result($result);
			}
			else
				$newrow = 1;

			$defval = "";
			/*
			if($mediatypeID == "photos" && $thumbpath) {
				$query = "SELECT medialinkID FROM $medialinks_table WHERE personID = \"$link_personID\" AND gedcom = \"$link_tree\" AND defphoto = \"1\"";
				$result = @tng_query($query);
				if( $result ) {
					$defval = 1;
					tng_free_result($result);
				}
			}
			*/

			$template = "ssssss";
			$query = "INSERT IGNORE INTO $medialinks_table (personID,mediaID,ordernum,gedcom,linktype,eventID,defphoto) VALUES (?,?,?,?,?,'',?)";
			$params = array(&$template, &$link_personID, &$mediaID, &$newrow, &$link_tree, &$link_linktype, &$defval);
			tng_execute_noerror($query,$params);
		}
		$query = "UPDATE $mediatypes_table SET disabled=\"0\" where mediatypeID=\"$mediatypeID\"";
		$result = @tng_query($query);

		adminwritelog( "<a href=\"admin_editmedia.php?mediaID=$mediaID\">{$admtext['addnewmedia']}: $mediaID</a>" );

		header( "Location: admin_editmedia.php?mediaID=$mediaID&newmedia=1&added=1" );
	}
	else {
		$message = $admtext['photonotadded'] . ".";
		header( "Location: admin_media.php?message=" . urlencode($message) );
	}
} catch (mysqli_sql_exception $e) {
	$message = $admtext['photonotuploaded'] . ".";
	header( "Location: admin_media.php?message=" . urlencode($message) );
}
?>