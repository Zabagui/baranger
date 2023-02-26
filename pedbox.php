<?php
function getPhotoSrc( $persfamID, $living, $gender ) {
	global $rootpath, $photopath, $documentpath, $headstonepath, $historypath, $mediapath, $mediatypes_assoc;
	global $photosext, $tree, $medialinks_table, $media_table, $text, $tngconfig, $cms, $allow_private;

	$photo = array();
	$showmedia_url = getURL( "showmedia", 1 );

	$query = "SELECT $media_table.mediaID, medialinkID, alwayson, private, thumbpath, mediatypeID, usecollfolder FROM ($media_table, $medialinks_table)
		WHERE personID = \"$persfamID\" AND $medialinks_table.gedcom = \"$tree\" AND $media_table.mediaID = $medialinks_table.mediaID AND defphoto = '1'";
	$result = tng_query($query);
	$row = tng_fetch_assoc( $result );

	$photocheck = $photolink = "";
	if(!empty($row['thumbpath'])) {
		if( $row['alwayson'] || (checkLivingLinks($row['mediaID']) && (!$row['private'] || $allow_private))) {
			$mediatypeID = $row['mediatypeID'];
			$usefolder = $row['usecollfolder'] ? $mediatypes_assoc[$mediatypeID] : $mediapath;
			$photocheck = "$usefolder/" . $row['thumbpath'];
			$photoref = "$usefolder/" . str_replace("%2F","/",rawurlencode( $row['thumbpath'] ));
			$photolink = xmlcharacters($showmedia_url . "mediaID={$row['mediaID']}&amp;medialinkID={$row['medialinkID']}");
		}
	}
	elseif($living) {
		$photoref = $photocheck = $tree ? "$photopath/$tree.$persfamID.$photosext" : "$photopath/$persfamID.$photosext";
	}

	$gotfile = $photocheck ? file_exists( "$rootpath$photocheck" ) : false;
	if(!$gotfile) {
		if( $gender && $tngconfig['usedefthumbs'] ) {
			if($gender == "M") {
				$photocheck = "img/male.jpg";
			}
			elseif ($gender == "F") {
				$photocheck = "img/female.jpg";
			}
			$photoref = $photocheck;
			$gotfile = file_exists( "$rootpath$photocheck" );
		}
	}
	if( $gotfile ) {
		$photo['ref'] = $cms['tngpath'] . $photoref;
		$photo['link'] = $photolink;
	}
	else {
		$photo['ref'] = "";
		$photo['link'] = "";
	}

	return $photo;
}
?>