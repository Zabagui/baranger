<?php
function get_item_id( $result, $offset, $itemname ) {
    if( !tng_data_seek($result, $offset ) )
		return(0);
	$row = tng_fetch_assoc( $result );

	return isset($row[$itemname]) ? $row[$itemname] : "";
}

function get_item_id_pair( $result, $offset, $itemname, $needamp ) {
	$item = get_item_id($result, $offset, $itemname);
	if($item) {
		$str = $itemname . "=" . $item;
		if($needamp) $str = "&amp;" . $str;
	}
	else
		$str = "";
		
	return $str;
}

function get_media_offsets( $result, $mediaID ) {
	tng_data_seek ($result, 0);
	$found = 0;
	for( $i = 0; $i < tng_num_rows($result); $i++ ) {
		$row = tng_fetch_assoc( $result );
		if( $row['mediaID'] == $mediaID ) {
			$found = 1;
        		break;
        	}
    	}
	if(!$found && $i) $i--;
	$nexttolast = tng_num_rows( $result ) - 1;
	$prev = $i ? $i - 1 : $nexttolast;
	$next = $i < $nexttolast ? $i + 1 : 0;
	
    return array( $i, $prev, $next, $nexttolast );
}

function get_media_link( $result, $address, $page, $jumpfunc, $title, $label, $allstr, $showlinks ) {
	global $cemeteryID;
	
	$mediaID = get_item_id( $result, $page - 1, "mediaID" );
	$medialinkID = get_item_id( $result, $page - 1, "medialinkID" );
	$albumlinkID = get_item_id( $result, $page - 1, "albumlinkID" );

	if($showlinks) {
		$href = $mediaID ? "&amp;mediaID=" . $mediaID : "";
		$href .= $medialinkID ? "&amp;medialinkID=" . $medialinkID : "";
		$href .= $albumlinkID ? "&amp;albumlinkID=" . $albumlinkID : "";
		$href .= $cemeteryID ? "&amp;cemeteryID=" . get_item_id( $result, $page - 1, "cemeteryID" ) : "";
		$href .= $allstr . "&amp;tngpage=$page";
		if(substr($href,0,5) == "&amp;")
			$href = substr($href,5);
		$link = " <a href=\"$address$href\" class=\"snlink\" title=\"$title\">$label</a> ";
	}
	else {
		$link = " <a href=\"#\" class=\"snlink\" onclick=\"return $jumpfunc('$mediaID','$medialinkID','$albumlinkID')\" title=\"$title\">$label</a> ";
	}
	
	return $link;
}

function doMedia( $mediatypeID ) {
	global $media_table, $medialinks_table, $change_limit, $cutoffstr, $wherestr, $text, $admtext, $families_table, $sources_table, $repositories_table, $citations_table, $nonames;
	global $people_table, $familygroup_url, $showsource_url, $showrepo_url, $placesearch_url, $showmedia_url, $trees_table, $currentuser, $userlist;
	global $rootpath, $photopath, $documentpath, $headstonepath, $historypath, $mediapath, $header, $footer, $cemeteries_table, $mediatypes_assoc, $mediatypes_display;
	global $getperson_url, $livedefault, $whatsnew, $wherestr2, $showmap_url, $thumbmaxw, $events_table, $eventtypes_table, $altstr, $tngconfig, $maxmediafilesize, $allow_private;

	if( $mediatypeID == "headstones" ) {
		$hsfields = ", $media_table.cemeteryID, cemname, city";
		$hsjoin = "LEFT JOIN $cemeteries_table ON $media_table.cemeteryID = $cemeteries_table.cemeteryID";
	}
	else
		$hsfields = $hsjoin = "";

	$query = "SELECT distinct $media_table.mediaID as mediaID, description $altstr, $media_table.notes, thumbpath, path, form, mediatypeID, $media_table.gedcom as gedcom, alwayson, usecollfolder, private, DATE_FORMAT(changedate,'%e %b %Y') as changedatef, changedby, status, plot, abspath, newwindow $hsfields";
	if(strpos($_SERVER['SCRIPT_NAME'],"placesearch") !== FALSE)
		$query .= ", ordernum";
	else
		$query .= ", changedate";

	$query .= "	FROM $media_table $hsjoin";
	if( $wherestr2 )
		$query .= " LEFT JOIN $medialinks_table on $media_table.mediaID = $medialinks_table.mediaID";
	$query .= " WHERE $cutoffstr $wherestr mediatypeID = \"$mediatypeID\" ORDER BY ";
	if(strpos($_SERVER['SCRIPT_NAME'],"placesearch") !== FALSE)
		$query .= "ordernum";
	else
		$query .= "changedate DESC, description";
	$query .= " LIMIT $change_limit";
	$mediaresult = tng_query($query);

	$titlemsg = !empty($text[$mediatypeID]) ? $text[$mediatypeID] : $mediatypes_display[$mediatypeID];
	$mediaheader = "<div class=\"titlebox\"><span class=\"subhead\"><b>$titlemsg</b></span><br /><br />\n" . $header;

	$mediatext = "";
	$thumbcount = 0;
	$gotImageJpeg = function_exists("imageJpeg");

	while( $row = tng_fetch_assoc( $mediaresult ) ) {
		$mediatypeID = $row['mediatypeID'];
		$usefolder = $row['usecollfolder'] ? $mediatypes_assoc[$mediatypeID] : $mediapath;

	    if(!isset($row['altnotes'])) $row['altnotes'] = "";
	    if(!isset($row['altdescription'])) $row['altdescription'] = "";

		$status = $row['status'];
		if($status && $text[$status]) $row['status'] = $text[$status];

		$query = "SELECT medialinkID, $medialinks_table.personID as personID, $medialinks_table.eventID, people.personID as personID2, familyID, people.living as living, people.private as private, people.branch as branch,
			$families_table.branch as fbranch, $families_table.living as fliving, $families_table.private as fprivate, husband, wife, people.lastname as lastname, people.lnprefix as lnprefix, people.firstname as firstname,
			people.prefix as prefix, people.suffix as suffix, nameorder, people.title, $medialinks_table.gedcom as gedcom, treename, $sources_table.title AS stitle, $sources_table.sourceID, $repositories_table.repoID,reponame, linktype,
			birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr, burialdate
			FROM $medialinks_table
			LEFT JOIN $people_table AS people ON ($medialinks_table.personID = people.personID AND $medialinks_table.gedcom = people.gedcom)
			LEFT JOIN $families_table ON ($medialinks_table.personID = $families_table.familyID AND $medialinks_table.gedcom = $families_table.gedcom)
			LEFT JOIN $sources_table ON ($medialinks_table.personID = $sources_table.sourceID AND $medialinks_table.gedcom = $sources_table.gedcom)
			LEFT JOIN $repositories_table ON ($medialinks_table.personID = $repositories_table.repoID AND $medialinks_table.gedcom = $repositories_table.gedcom)
			LEFT JOIN $trees_table ON $medialinks_table.gedcom = $trees_table.gedcom
			WHERE mediaID = \"{$row['mediaID']}\"$wherestr2 ORDER BY lastname, lnprefix, firstname, $medialinks_table.personID";
		$presult = tng_query($query);
		$foundliving = 0;
		$foundprivate = $row['private'] && !$allow_private; //if the image is flagged as private, it starts off that way
		$medialinktext = "";
		while( $prow = tng_fetch_assoc( $presult ) ) {
			if( $prow['fbranch'] != NULL ) $prow['branch'] = $prow['fbranch'];
			if( $prow['fliving'] != NULL ) $prow['living'] = $prow['fliving'];
			if( $prow['fprivate'] != NULL ) $prow['private'] = $prow['fprivate'];
			if( $prow['living'] == NULL && $prow['private'] == NULL && $prow['linktype'] == 'I') {
				$query = "SELECT count(personID) as ccount FROM $citations_table, $people_table
					WHERE $citations_table.sourceID = '{$prow['personID']}' AND $citations_table.persfamID = $people_table.personID AND $citations_table.gedcom = $people_table.gedcom
					AND (living = '1' OR private = '1')";
				$presult2 = tng_query($query);
				$prow2 = tng_fetch_assoc( $presult2 );
				if( $prow2['ccount'] ) $prow['living'] = 1;
				tng_free_result( $presult2 );
			}

			$rights = determineLivingPrivateRights($prow);
			$prow['allow_living'] = $rights['living'];
			$prow['allow_private'] = $rights['private'];

			if(!$rights['living'])
				$foundliving = 1;
			if(!$rights['private'])
				$foundprivate = 1;
			
			$hstext = "";
			if( $prow['personID2'] != NULL ) {
				$medialinktext .= "<li><a href=\"$getperson_url" . "personID={$prow['personID2']}&amp;tree={$prow['gedcom']}\">";
				$medialinktext .= getName( $prow );
				if( $mediatypeID == "headstones" ) {
					$deathdate = $prow['deathdate'] ? $prow['deathdate'] : $prow['burialdate'];
					if( $prow['deathdate'] ) $abbrev = $text['deathabbr'];
					elseif( $prow['burialdate'] ) $abbrev = $text['burialabbr'];
					$hstext = $deathdate ? " ($abbrev " . displayDate( $deathdate ) . ")" : "";
				}
			}
			elseif( $prow['familyID'] != NULL ) {
				$medialinktext .= "<li><a href=\"$familygroup_url" . "familyID={$prow['familyID']}&amp;tree={$prow['gedcom']}\">{$text['family']}: " . getFamilyName( $prow );
			}
			elseif( $prow['sourceID'] != NULL ) {
				$sourcetext = $prow['stitle'] ? $text['source'] . ": " . $prow['stitle'] : $text['source'] . ": " . $prow['sourceID'];
				$medialinktext .= "<li><a href=\"$showsource_url" . "sourceID={$prow['sourceID']}&amp;tree={$prow['gedcom']}\">$sourcetext";
			}
			elseif( $prow['repoID'] != NULL ) {
				$repotext = $prow['reponame'] ? $text['repository'] . ": " . $prow['reponame'] : $text['repository'] . ": " . $prow['repoID'];
				$medialinktext .= "<li><a href=\"$showrepo_url" . "repoID={$prow['repoID']}&amp;tree={$prow['gedcom']}\">$repotext";
			}
			else{
				$medialinktext .= "<li><a href=\"$placesearch_url" . "psearch=" . urlencode($prow['personID']);
                if(!$tngconfig['places1tree'])
                    $medialinktext .= "&amp;tree={$prow['gedcom']}";
                $medialinktext .= "\">" . $prow['personID'];
            }
			if($prow['eventID']) {
				$query = "SELECT display from $events_table, $eventtypes_table WHERE eventID = \"{$prow['eventID']}\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID";
				$eresult = tng_query($query);
				$erow = tng_fetch_assoc($eresult);
				$event = !empty($erow['display']) && is_numeric($prow['eventID']) ? getEventDisplay( $erow['display'] ) : (!empty($admtext[$prow['eventID']]) ? $admtext[$prow['eventID']] : $prow['eventID']);
				tng_free_result($eresult);
				$medialinktext .= " ($event)";
			}
			$medialinktext .= "</a>$hstext\n</li>\n";
		}
		tng_free_result( $presult );
		if($medialinktext) $medialinktext = "<ul>$medialinktext</ul>\n";

		$row['allow_living'] = !$foundliving || $row['alwayson'];
		$row['allow_private'] = !$foundprivate || $row['alwayson'];
		$showPhotoInfo = $row['allow_living'] && $row['allow_private'];

		//$href = $showmedia_url . "mediaID=$row[mediaID]";
		$href = getMediaHREF($row,0);
		$notes = $wherestr && $row['altnotes'] ? $row['altnotes'] : $row['notes'];
		$notes = nl2br( truncateIt(getXrefNotes($row['notes'],$row['gedcom']),$tngconfig['maxnoteprev']) );
		$description = $wherestr && $row['altdescription'] ? $row['altdescription'] : $row['description'];

		if( $row['allow_living'] && $row['allow_private'] ) {
			$description = $showPhotoInfo ? "<a href=\"$href\" class=\"media-title\">$description</a>" : "<span class=\"media-title\">$description</span>";
		}
		else {
			$nonamesloc = $row['private'] ? $tngconfig['nnpriv'] : $nonames;
			if($nonamesloc) {
				$description = "<span class=\"media-title\">{$text['livingphoto']}</span>";
				$notes = "";
			}
			else {
				$notes = $notes ? $notes . "<br />({$text['livingphoto']})" : "({$text['livingphoto']})";
			}
			$href = "";
		}
		//if( $row[status] ) $notes = "$text[status]: $row[status]. $notes";

		$mediatext .= "<tr>";
		$row['mediatypeID'] = $mediatypeID;
		$imgsrc = getSmallPhoto($row);
		if($imgsrc) {
			$treestr = $tngconfig['mediatrees'] && $row['gedcom'] ? $row['gedcom'] . "/" : "";
			$mediatext .= "<td valign=\"top\" class=\"databack center\" style=\"width:$thumbmaxw" . "px\">";
			$mediatext .= "<div class=\"media-img\"><div class=\"media-prev\" id=\"prev{$row['mediaID']}\" style=\"display:none\"></div></div>\n";
			if($href && $row['allow_living']) {
				$mediatext .= "<a href=\"$href\"";
				if( $gotImageJpeg && isPhoto($row) && checkMediaFileSize("$rootpath$usefolder/$treestr" . $row['path']))
					$mediatext .=  " class=\"media-preview\" id=\"img-{$row['mediaID']}-0-" . urlencode("$usefolder/$treestr{$row['path']}") . "\"";	
				$mediatext .= ">$imgsrc</a>";
			}
			else
				$mediatext .= $imgsrc;
			$mediatext .= "</td><td valign=\"top\" class=\"databack\">";
			$thumbcount++;
		}
		else
			$mediatext .= "<td valign=\"top\" class=\"databack\" align=\"center\">&nbsp;</td><td valign=\"top\" class=\"databack\">";

		$mediatext .= "$description<br />$notes&nbsp;</td>";
		if($mediatypeID == "headstones") {
			if(!$row['cemname']) $row['cemname'] = $row['city'];
			$mediatext .= "<td valign=\"top\" class=\"databack\"><a href=\"$showmap_url" . "cemeteryID={$row['cemeteryID']}\">{$row['cemname']}</a>";
			if($row['plot']) $mediatext .= "<br />";
			$mediatext .= nl2br($row['plot']) . "&nbsp;</td>";
			$mediatext .= "<td valign=\"top\" class=\"databack\">{$row['status']}&nbsp;</td>";
			$mediatext .= "<td valign=\"top\" class=\"databack\">\n";
		}
		else
			$mediatext .= "<td valign=\"top\" class=\"databack\" width=\"175\">\n";
		$mediatext .= $medialinktext;
		$mediatext .= "&nbsp;</td>\n";
		if( $whatsnew ) {
			$changedby = $row['changedby'];
			$changedbydesc = isset($userlist[$changedby]) ? $userlist[$changedby] : $changedby;
			$mediatext .= "<td valign=\"top\" class=\"databack\">" . displayDate( $row['changedatef'] ) . ($currentuser ? " ({$changedbydesc})" : "") . "</td></tr>\n";
		}
		//ereg if no thumbs
	}
	if( !$thumbcount ) {
		$mediaheader = str_replace( "<td class=\"fieldnameback\"><span class=\"fieldname\">&nbsp;<strong>{$text['thumb']}</strong>&nbsp;</span></td>", "", $mediaheader );
		$mediatext = str_replace( "<td valign=\"top\" class=\"databack\" align=\"center\">&nbsp;</td><td valign=\"top\" class=\"databack\">", "<td valign=\"top\" class=\"databack\">", $mediatext );
	}
	tng_free_result($mediaresult);
	$media = $mediatext ? $mediaheader . $mediatext . $footer . "</div>\n<br />\n" : "";

	return $media;
}
?>