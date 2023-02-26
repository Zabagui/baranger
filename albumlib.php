<?php
function getAlbumPhoto($albumID,$albumname) {
	global $assignedtree, $rootpath, $media_table, $albumlinks_table, $people_table, $families_table, $citations_table, $text, $medialinks_table;
	global $mediatypes_assoc, $mediapath, $showalbum_url, $tngconfig, $sitever, $tree, $livedefault, $allow_private;

	$wherestr2 = !empty($tree) ? " AND $medialinks_table.gedcom = \"$tree\"" : "";

	$query2 = "SELECT gedcom, path, thumbpath, usecollfolder, mediatypeID, $albumlinks_table.mediaID as mediaID, alwayson, $media_table.gedcom, private FROM ($media_table, $albumlinks_table)
		WHERE albumID = \"$albumID\" AND $media_table.mediaID = $albumlinks_table.mediaID AND defphoto=\"1\"";
	$result2 = tng_query($query2) or die ($text['cannotexecutequery'] . ": $query2");
	$trow = tng_fetch_assoc( $result2 );
	$mediaID = !empty($trow['mediaID']) ? $trow['mediaID'] : "";
	$tmediatypeID = !empty($trow['mediatypeID']) ? $trow['mediatypeID'] : "";
	$tusefolder = !empty($trow['usecollfolder']) ? $mediatypes_assoc[$tmediatypeID] : $mediapath;
	tng_free_result($result2);

	$imgsrc = "";
	$treestr = $tngconfig['mediatrees'] && $trow['gedcom'] ? $trow['gedcom'] . "/" : "";
	if( !empty($trow['thumbpath']) && file_exists( "$rootpath$tusefolder/$treestr" . $trow['thumbpath'] ) ) {
		$foundliving = 0;
		$foundprivate = $trow['private'] && !$allow_private;
		if(!$trow['alwayson'] && $livedefault != 2) {
			$query = "SELECT people.living as living, people.private as private, people.branch as branch, $families_table.branch as fbranch, $families_table.living as fliving, $families_table.private as fprivate, linktype, $medialinks_table.gedcom as gedcom
				FROM $medialinks_table
				LEFT JOIN $people_table AS people ON $medialinks_table.personID = people.personID AND $medialinks_table.gedcom = people.gedcom
				LEFT JOIN $families_table ON $medialinks_table.personID = $families_table.familyID AND $medialinks_table.gedcom = $families_table.gedcom
				WHERE mediaID = \"$mediaID\"$wherestr2";
			$presult = tng_query($query);
			while( $prow = tng_fetch_assoc( $presult ) )
			{
				if( $prow['fbranch'] != NULL ) $prow['branch'] = $prow['fbranch'];
				if( $prow['fliving'] != NULL ) $prow['living'] = $prow['fliving'];
				if( $prow['fprivate'] != NULL ) $prow['private'] = $prow['fprivate'];
				//if living still null, must be a source

				$rights = determineLivingPrivateRights($prow);
				$prow['allow_living'] = $rights['living'];
				$prow['allow_private'] = $rights['private'];

				if( $prow['living'] == NULL && $prow['private'] == NULL && $prow['linktype'] == 'I') {
					$query = "SELECT count(personID) as ccount FROM $citations_table, $people_table
						WHERE $citations_table.sourceID = '{$prow['personID']}' AND $citations_table.persfamID = $people_table.personID AND $citations_table.gedcom = $people_table.gedcom
						AND living = '1'";
					$presult2 = tng_query($query);
					$prow2 = tng_fetch_assoc( $presult2 );
					if( $prow2['ccount'] ) $prow['living'] = 1;
					tng_free_result( $presult2 );
				}
				elseif( $prow['living'] == NULL && $prow['private'] == NULL && $prow['linktype'] == 'F') {
					$query = "SELECT count(familyID) as ccount FROM $citations_table, $families_table
						WHERE $citations_table.sourceID = '{$prow['personID']}' AND $citations_table.persfamID = $families_table.familyID AND $citations_table.gedcom = $families_table.gedcom
						AND living = '1'";
					$presult2 = tng_query($query);
					$prow2 = tng_fetch_assoc( $presult2 );
					if( $prow2['ccount'] ) $prow['living'] = 1;
					tng_free_result( $presult2 );
				}
				if($prow['living'] && !$rights['living'])
					$foundliving = 1;
				if($prow['private'] && !$rights['private'])
					$foundprivate = 1;
			}
		}
		if( !$foundliving && !$foundprivate ) {
			$size = @GetImageSize( "$rootpath$tusefolder/$treestr{$trow['thumbpath']}" );
			$imgsrc = "<div class=\"media-img\"><div class=\"media-prev\" id=\"prev$albumID\" style=\"display:none\"></div></div>\n";
			$imgsrc .= "<a href=\"$showalbum_url" . "albumID=$albumID\" title=\"{$text['albclicksee']}\"";
			if(function_exists( 'imageJpeg' ))
				$imgsrc .= " onmouseover=\"showPreview('{$trow['mediaID']}','','" . urlencode("$tusefolder/$treestr{$trow['path']}") . "','');\" onmouseout=\"closePreview('$albumID','','$sitever');\" onclick=\"closePreview('$albumID','');\"";
			$imgsrc .= "><img src=\"$tusefolder/$treestr" . str_replace("%2F","/",rawurlencode( $trow['thumbpath'] )) . "\" border=\"0\" class=\"thumb\" $size[3] alt=\"$albumname\" /></a>";
		}
	}
	return $imgsrc;
}
?>
