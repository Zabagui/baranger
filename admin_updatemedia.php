<?php
include("begin.php");
include("adminlib.php");
$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("geocodelib.php");

if( !$allow_media_edit && !$allow_media_add ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");
initMediaTypes();

function reorderMedia( $query, $plink, $mediatypeID ) {
	global $admtext, $medialinks_table, $media_table;

	$ptree = $plink['gedcom'];
	$eventID = $plink['eventID'];
	$result3 = tng_query($query);
	while( $personrow = tng_fetch_assoc( $result3 ) ) {
		$query = "SELECT medialinkID FROM ($medialinks_table, $media_table) WHERE personID = \"{$personrow['personID']}\" AND $medialinks_table.gedcom = \"$ptree\" AND $media_table.mediaID = $medialinks_table.mediaID AND eventID = \"$eventID\" AND mediatypeID = \"$mediatypeID\" ORDER BY ordernum";
		$result4 = tng_query($query);

		$counter = 1;
		while( $medialinkrow = tng_fetch_assoc( $result4 ) ) {
			$query = "UPDATE $medialinks_table SET ordernum = \"$counter\" WHERE medialinkID = \"{$medialinkrow['medialinkID']}\"";
			$result5 = tng_query($query);
			$counter++;
		}
		tng_free_result( $result4 );
	}
	tng_free_result( $result3 );
}

$thumbquality = 80;
if( function_exists( 'imageJpeg' ) )
	include( "imageutils.php" );

$usefolder = $usecollfolder ? $mediatypes_assoc[$mediatypeID] : $mediapath;
$treestr = $tngconfig['mediatrees'] && $tree ? $tree . "/" : "";

if( substr( $thumbpath, 0, 1 ) == "/" )
	$thumbpath = substr( $thumbpath, 1 );
$newthumbpath = "$rootpath$usefolder/$treestr$thumbpath";

$description = addslashes($description);
$notes = addslashes($notes);
$datetaken = addslashes($datetaken);
$place = addslashes($place);
$owner = addslashes($owner);
$imagemap = isset($imagemap) ? addslashes($imagemap) : "";
$bodytext = addslashes($bodytext);
$latitude = addslashes($latitude);
$longitude = addslashes($longitude);
$zoom = isset($zoom) ? addslashes($zoom) : "";
$width = addslashes($width);
$height = addslashes($height);
$plot = addslashes($plot);

$latitude = preg_replace("/,/",".",$latitude);
$longitude = preg_replace("/,/",".",$longitude);
$imagemap = trim($imagemap);
if($latitude && $longitude && !$zoom)
	$zoom = 13;
$fileparts = pathinfo( $path );
$form = isset($fileparts['extension']) ? strtoupper( $fileparts['extension'] ) : "";
$newdate = date ("Y-m-d H:i:s", time() + ( 3600 * $time_offset ) );

if( !empty($abspath) )
	$path = $mediaurl;
else
	$abspath = 0;
if( empty($showmap) ) $showmap = "0";
if( !$usenl ) $usenl = 0;
if( empty($alwayson) ) $alwayson = 0;
if( empty($newwindow) ) $newwindow = 0;
if( empty($private) ) $private = 0;
if( !$usecollfolder ) $usecollfolder = 0;
if( !$width ) $width = 0;
if( !$height ) $height = 0;
if( !$cemeteryID ) $cemeteryID = 0;
if( empty($linktocem) ) $linktocem = 0;
if( !$zoom ) $zoom = 0;

try {
	if( $usecollfolder && $mediatypeID != $mediatypeID_org ) {
		$oldmediapath = $mediatypes_assoc[$mediatypeID_org] . $treestr;
		$newmediapath = $mediatypes_assoc[$mediatypeID] . $treestr;
		if( $path_org ) {
			$oldpath = "$rootpath$oldmediapath/$path_org";
			$newpath = "$rootpath$newmediapath/$path";
			if( file_exists( $oldpath ) )
				@rename($oldpath, $newpath);
		}

		if( $thumbpath_org && $thumbpath ) {
			$oldthumbpath = "$rootpath$oldmediapath/$thumbpath_org";
			$newthumbpath = "$rootpath$newmediapath/$thumbpath";
			if( file_exists( $oldthumbpath ) )
				@rename($oldthumbpath, $newthumbpath);
		}
	}

	$mediakey = $path && $path != $path_org ? "$usefolder/$path" : $mediakey_org;
	if(!$mediakey) $mediakey = time();

	if( substr( $path, 0, 1 ) == "/" )
		$path = substr( $path, 1 );
	$newpath = "$rootpath$usefolder/$treestr$path";

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
		if( function_exists( 'imageJpeg' ) && $thumbcreate == "auto" ) {
			//$cleanpath = $session_charset == "UTF-8" ? utf8_decode($newpath) : $newpath;
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
} catch (mysqli_sql_exception $e) {
	$message = $admtext['photonotuploaded'] . ".";
	header( "Location: admin_media.php?message=" . urlencode($message) );
}

if(!empty($place)) {
	$placetree = $tngconfig['places1tree'] ? "" : $tree;
	$query = "INSERT IGNORE INTO $places_table (gedcom,place,placelevel,latitude,longitude,zoom,geoignore,temple,changedate,changedby) VALUES (\"$placetree\",\"$place\",\"0\",\"$latitude\",\"$longitude\",\"$zoom\",\"0\",\"\",\"$newdate\",\"$currentuser\")";
	$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
	if($tngconfig['autogeo'] && tng_affected_rows() && (!$latitude || !$longitude)) {
	    $ID = tng_insert_id();
	    $message = geocode($place, 0, $ID);
	}
}

$query = "UPDATE $media_table SET path=\"$path\",thumbpath=\"$thumbpath\",description=\"$description\",notes=\"$notes\",width=\"$width\",height=\"$height\",datetaken=\"$datetaken\",placetaken=\"$place\",owner=\"$owner\",changedate=\"$newdate\",changedby=\"$currentuser\",form=\"$form\",alwayson=\"$alwayson\",mediatypeID=\"$mediatypeID\",map=\"$imagemap\",abspath=\"$abspath\",gedcom=\"$tree\",status=\"$status\",cemeteryID=\"$cemeteryID\",plot=\"$plot\",showmap=\"$showmap\",linktocem=\"$linktocem\",latitude=\"$latitude\",longitude=\"$longitude\",zoom=\"$zoom\",bodytext=\"$bodytext\",usenl=\"$usenl\",newwindow=\"$newwindow\",private=\"$private\",usecollfolder=\"$usecollfolder\",mediakey=\"$mediakey\"  WHERE mediaID=\"$mediaID\"";
$result = tng_query($query);

if( $mediatypeID != $mediatypeID_org ) {
	$query = "SELECT personID, $medialinks_table.gedcom, eventID FROM ($medialinks_table, $media_table) WHERE $medialinks_table.mediaID = \"$mediaID\" AND $medialinks_table.mediaID = $media_table.mediaID";
	$result2 = tng_query($query);
	if( $result2 ) {
		while( $plink = tng_fetch_assoc( $result2 ) ) {
			$query = "SELECT personID from $people_table WHERE personID = \"{$plink['personID']}\" AND gedcom = \"{$plink['gedcom']}\"";
			reorderMedia( $query, $plink, $mediatypeID_org );
			reorderMedia( $query, $plink, $mediatypeID );

			$query = "SELECT familyID as personID from $families_table WHERE familyID = \"{$plink['personID']}\" AND gedcom = \"{$plink['gedcom']}\"";
			reorderMedia( $query, $plink, $mediatypeID_org );
			reorderMedia( $query, $plink, $mediatypeID );

			$query = "SELECT sourceID as personID from $sources_table WHERE sourceID = \"{$plink['personID']}\" AND gedcom = \"{$plink['gedcom']}\"";
			reorderMedia( $query, $plink, $mediatypeID_org );
			reorderMedia( $query, $plink, $mediatypeID );

			$query = "SELECT repoID as personID from $repositories_table WHERE repoID = \"{$plink['personID']}\" AND gedcom = \"{$plink['gedcom']}\"";
			reorderMedia( $query, $plink, $mediatypeID_org );
			reorderMedia( $query, $plink, $mediatypeID );
		}
		tng_free_result($result2);
	}
}

adminwritelog( "<a href=\"admin_editmedia.php?mediaID=$mediaID\">{$admtext['modifymedia']}: $mediaID</a>" );
$message = $admtext['changestoitem'] . " $mediaID {$admtext['succsaved']}.";

if( isset($_POST['savestay']) )
	header( "Location: admin_editmedia.php?mediaID=$mediaID&cw=$cw&ref=1" );
else if( isset($_POST['saveclose']) ) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<script type="text/javascript">
	window.opener.location.reload(false);
	window.open('','_self').close();
	window.location.href = "admin_media.php?message=<?php echo urlencode($message); ?>";
</script>
</head>
<body>
<p>A change in your browser's default behavior is preventing this window from closing.</p>
<p>To change this behavior in Firefox, type <i>about:config</i> in the browser address bar and press enter.</p>
<p>Then search for <i>dom.allow_scripts_to_close_windows</i> and change the value of that setting from False to True.</p>
<p>For all other browsers, please close this window or tab.</p>
</body>
</html>
<?php
}
else
	header( "Location: admin_media.php?message=" . urlencode($message) );
?>