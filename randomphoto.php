<?php
//Change these vars to affect max width & height of your photo. Aspect ratio will be maintained. Leaving
//these values blank will cause your photo to be displayed actual size.
//***To avoid having to change these values every time this script is updated, set your custom values in customconfig.php
if(!isset($rp_maxwidth)) $rp_maxwidth = "250";
if(!isset($rp_maxheight)) $rp_maxheight = "250";
if(!isset($rp_mediatypeID) || !$rp_mediatypeID) $rp_mediatypeID = "photos";

$showmedia_url = getURL( "showmedia", 1);

$query = "SELECT DISTINCT $media_table.mediaID, $media_table.description, path, alwayson, usecollfolder, mediatypeID, gedcom FROM $media_table WHERE mediatypeID = \"$rp_mediatypeID\" AND COALESCE(private,0) = 0 AND (abspath is NULL OR abspath = \"0\") ORDER BY RAND()";
$result = tng_query($query);
$usefolder = $treestr = "";
$found = false;
while( $imgrow = tng_fetch_assoc( $result ) ) {

	$usefolder = $imgrow['usecollfolder'] ? $mediatypes_assoc[$rp_mediatypeID]  : $mediapath;
	$treestr = $tngconfig['mediatrees'] && $imgrow['gedcom'] ? $imgrow['gedcom'] . "/" : "";
	if(file_exists($rootpath . $usefolder . "/$treestr" . $imgrow['path'])) {
	    // if the picture is alwayson or we are allowing living to be displayed, we don't need to bother
	    // with any further checking
		if ($imgrow['alwayson']) {
			$found = true;
			break;

		    // otherwise, let's check for living
	    } 
	    else {

			// this query will return rows of personIDs on the photo that are living
			$query = "SELECT $medialinks_table.personID FROM ($medialinks_table, $people_table) WHERE $medialinks_table.personID = $people_table.personID AND $medialinks_table.gedcom = $people_table.gedcom AND $medialinks_table.mediaID = {$imgrow['mediaID']} AND ($people_table.living = \"1\" OR $people_table.private = \"1\")";
			$presult = tng_query($query);
			$rows = tng_num_rows( $presult );
			tng_free_result( $presult );

			$query = "SELECT $medialinks_table.personID FROM ($medialinks_table, $families_table) WHERE $medialinks_table.personID = $families_table.familyID AND $medialinks_table.gedcom = $families_table.gedcom AND $medialinks_table.mediaID = {$imgrow['mediaID']} AND ($families_table.living = \"1\" OR $families_table.private = \"1\")";
			$presult = tng_query($query);
			$rows = $rows + tng_num_rows( $presult );
			tng_free_result( $presult );

			// if no rows are returned, there are no living on the photo, so let's display it
			if ($rows == 0) {
				$found = true;
			    break;
			}
	    }
	}
}
tng_free_result( $result );

if($found) {
	if(strpos($rp_maxwidth,"%") !== FALSE) {
		$dimensions = "width=\"$rp_maxwidth\"";
	}
	else {
		$usefolder = $imgrow['usecollfolder'] ? $mediatypes_assoc[$rp_mediatypeID]  : $mediapath;
		$photoinfo = @GetImageSize( "$rootpath$usefolder/" . $imgrow['path'] );
		$photowtouse = $photoinfo[0];
		$photohtouse = $photoinfo[1];

		//these lines do the resizing
		if( $rp_maxheight && $photohtouse > $rp_maxheight ) {
		    $photowtouse = intval( $rp_maxheight * $photowtouse / $photohtouse );
		    $photohtouse = $rp_maxheight;
		}
		if( $rp_maxwidth && $photowtouse > $rp_maxwidth ) {
		    $photohtouse = intval( $rp_maxwidth * $photohtouse / $photowtouse );
		    $photowtouse = $rp_maxwidth;
		}
		$dimensions = "width=\"$photowtouse\" height=\"$photohtouse\"";
	}

	echo "<div class=\"indexphototable\">\n";
	echo "<a href=\"{$showmedia_url}mediaID={$imgrow['mediaID']}\"><img class=\"indexphoto rounded4\" border=\"0\" src=\"$usefolder/$treestr".str_replace("%2F","/",rawurlencode($imgrow['path']))."\" {$dimensions} alt=\"{$imgrow['description']}\" title=\"{$imgrow['description']}\" /></a>";
	echo "<div style=\"padding: 5px\">\n";
	echo "<em><a href=\"{$showmedia_url}mediaID={$imgrow['mediaID']}\">{$imgrow['description']}</a></em>\n";
	echo "</div>\n";
	echo "</div>\n";
}
?>
