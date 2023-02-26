<?php
//NOTES: "ID" is also the ID in alltext.php that holds the text to be displayed (ie, $text[photo] = "Photo"). It will exist in each language file.
//"Folder" is the location where files of this type are generally held.

global $photopath, $documentpath, $historypath, $headstonepath, $mediapath;
$mediatypes = array();
$mediatypes_assoc = array();
$mediatypes_icons = array();
$mediatypes_thumbs = array();
$mediatypes_display = array();
$mediatypes_like = array();
$mediatypeObjs = array();
$mctr = 0;
$maxmediafilesize = 5000000; //5 Mb is too large to create a thumbnail

function setMediaType($newtype) {
	global $mediatypes, $mediatypes_assoc, $mediatypes_locpaths, $mediatypes_icons, $mediatypes_thumbs, $mediatypes_display, $mediatypes_like, $mediatypeObjs, $mctr, $text;

	$ID = $newtype['mediatypeID'];
	if($newtype['type'] == 1 && (empty($newtype['icon']) || $newtype['icon'] == "img/"))
		$newtype['icon'] = "img/tng_photo.gif";
	if($newtype['type'] == 1 && (empty($newtype['thumb']) || $newtype['thumb'] == "img/"))
		$newtype['thumb'] = "img/photos_thumb.png";

    $mediatypes[$mctr] = $newtype;
    if(isset($text[$ID]))
        $mediatypes[$mctr]['display'] = $text[$ID];
    $mediatypes[$mctr]['ID'] = $ID;

    $mediatypeObjs[$ID] = $mediatypes[$mctr];

	$mediatypes_assoc[$ID] = $newtype['path'];
	$mediatypes_locpaths[$ID] = isset($newtype['localpath']) ? $newtype['localpath'] : "";
	$mediatypes_icons[$ID] = $newtype['icon'];
	$mediatypes_thumbs[$ID] = $newtype['thumb'];
	$mediatypes_display[$ID] = isset($newtype['display']) ? $newtype['display'] : "";
	$mediatypes_like[$newtype['liketype']][] = $ID;
	$mctr++;
}

//To change display order of these groups, simply move the corresponding lines below up or down.

function initMediaTypes() {
	global $photopath, $documentpath, $headstonepath, $historypath, $mediapath, $mediatypes_table, $mediatypes, $albums_table, $cms;

	if(count($mediatypes)) return;

    if(!isset($mediatypes_table)) return;	// added by Ken Roy to handle TNG v6 to v10 upgrade
	$query = "SELECT * FROM $mediatypes_table ORDER BY ordernum, display";
	$result = @tng_query($query);

	if($result) {
		while($row = tng_fetch_assoc($result)) {
			switch($row['mediatypeID']) {
				case "photos":
					setMediaType(array(
				        "mediatypeID"=>"photos",
				        "path"=>$photopath,
				        "icon"=>"",
				        "thumb"=>"photos_thumb.png",
				        "liketype"=>"photos",
				        "exportas"=>"PHOTO",
				        "type"=>0,
						"disabled"=>$row['disabled']
				    ));
					break;
				case "documents":
					setMediaType(array(
				        "mediatypeID"=>"documents",
				        "path"=>$documentpath,
				        "icon"=>"",
				        "thumb"=>"documents_thumb.png",
				        "liketype"=>"documents",
				        "exportas"=>"DOCUMENT",
				        "type"=>0,
						"disabled"=>$row['disabled']
				    ));
					break;
				case "headstones":
					setMediaType(array(
				        "mediatypeID"=>"headstones",
				        "path"=>$headstonepath,
				        "icon"=>"",
				        "thumb"=>"headstones_thumb.png",
				        "liketype"=>"headstones",
				        "exportas"=>"HEADSTONE",
				        "type"=>0,
						"disabled"=>$row['disabled']
				    ));
					break;
				case "histories":
					setMediaType(array(
				        "mediatypeID"=>"histories",
				        "path"=>$historypath,
				        "icon"=>"",
				        "thumb"=>"histories_thumb.png",
				        "liketype"=>"histories",
				        "exportas"=>"HISTORY",
				        "type"=>0,
						"disabled"=>$row['disabled']
				    ));
					break;
				case "recordings":
					setMediaType(array(
				        "mediatypeID"=>"recordings",
				        "path"=>$mediapath,
				        "icon"=>"",
				        "thumb"=>"recordings_thumb.png",
				        "liketype"=>"recordings",
				        "exportas"=>"RECORDING",
				        "type"=>0,
						"disabled"=>$row['disabled']
				    ));
					break;
				case "videos":
					setMediaType(array(
				        "mediatypeID"=>"videos",
				        "path"=>$mediapath,
				        "icon"=>"",
				        "thumb"=>"videos_thumb.png",
				        "liketype"=>"videos",
				        "exportas"=>"VIDEO",
				        "type"=>0,
						"disabled"=>$row['disabled']
				    ));
					break;
				default:
					$row['type'] = 1;
					if($cms['tngpath'] && strpos($row['path'], $cms['tngpath']) !== 0)
						$row['path'] = $cms['tngpath'] . $row['path'];
					setMediaType($row);
					break;
			}
		}
		tng_free_result($result);
	}
	if(!isset($_SESSION['albumcount'])) {
		$query = "SELECT count(*) as acount FROM $albums_table";
		$result = @tng_query($query);
		$row = tng_fetch_assoc($result);
		$_SESSION['albumcount'] = $row['acount'];
		tng_free_result($result);
	}
}
?>