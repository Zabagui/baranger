<?php
function display_size( $file_size ) {
	if( $file_size >= 1073741824 )
		$file_size = round( $file_size / 1073741824 * 100 ) / 100 ."g";
    elseif( $file_size >= 1048576 )
		$file_size = round( $file_size / 1048576 * 100 ) / 100 ."m";
    elseif( $file_size >= 1024 )
		$file_size = round( $file_size / 1024 * 100) / 100 ."k";
    else
		$file_size = $file_size." bytes";

	return $file_size;
} // function display_size()

function output_iptc_data( $info ) {
	global $text, $session_charset;

	$outputtext = "";
	if( is_array( $info ) ) {
		$iptc = isset($info['APP13']) ? iptcparse( $info['APP13'] ) : false;
		if( is_array( $iptc ) ) {
			$ucharset = strtoupper($session_charset);
			$enc = isset($iptc["1#090"]) && $iptc["1#090"][0] == "\x1B%G"  ? "UTF-8" : "ISO-8859-1";
			foreach( array_keys( $iptc ) as $key ) {
				$count = count ( $iptc[$key] );
				for ( $i=0; $i <$count; $i++) {
					$tempkey = substr( $key, 0 );
					$newkey = substr( $key, 2 );
					if(!$i)
						$iptc[$key][0] = str_replace( "\000", "", $iptc[$key][0] );
					if( $newkey != "000" ) {
						if($tempkey == "1#090")
							continue;
						$newkey = "iptc" . $newkey;
						$keytext = !empty($text[$newkey]) ? $text[$newkey] : $key;
						$fact = $iptc[$key][$i];

						if($enc == "UTF-8" && $ucharset != "UTF-8") {
							$fact = mb_convert_encoding($fact, 'ISO-8859-1', 'UTF-8');
							$str = ", decoded";
						}
						elseif($enc != "UTF-8" && $ucharset == "UTF-8") {
							$fact = mb_convert_encoding($fact, 'UTF-8', 'ISO-8859-1');
							$str = ", encoded";
						}
						else 
							$str = ", NONE";
						//echo "key=$keytext, data encoding=$enc, TNG charset=$ucharset$str<br>";
						
						$outputtext .= tableRow($keytext, $fact);
					}
				}
			}
		}
	}
	return $outputtext;
}

function getMediaInfo($mediatypeID, $mediaID, $personID, $albumID, $albumlinkID, $cemeteryID, $eventID) {
	global $wherestr, $requirelogin, $treerestrict, $assignedtree, $tnggallery, $mediasearch, $text, $tree, $all, $showall, $ordernum;
	global $media_table, $medialinks_table, $albumlinks_table, $allow_media_edit;

	$info = array();

	$wherestr3 = $requirelogin && $treerestrict && $assignedtree ? " AND ($media_table.gedcom = \"$tree\" || $media_table.gedcom = \"\")" : "";
	if( $albumlinkID ) {
		if( $tnggallery )
			$wherestr = " AND thumbpath != \"\"";
		$query = "SELECT $media_table.mediaID, albumlinkID, ordernum, path, map, description, notes, width, height, datetaken, placetaken, owner, alwayson, private, abspath, usecollfolder, status, plot, cemeteryID, showmap, bodytext, form, newwindow, usenl, latitude, longitude, mediatypeID, gedcom
			FROM ($albumlinks_table, $media_table)
		 	WHERE albumID = \"$albumID\" AND $albumlinks_table.mediaID = $media_table.mediaID $wherestr $wherestr3
			ORDER BY ordernum, description";
		$result = tng_query($query);
		$offsets = get_media_offsets( $result, $mediaID );
		$info['page'] = $offsets[0] + 1;
		tng_data_seek ( $result, $offsets[0] );

		$imgrow = tng_fetch_assoc($result);
		$info['mediaID'] = $imgrow['mediaID'];
		$info['ordernum'] = $imgrow['ordernum'];
		$info['mediadescription'] = $imgrow['description'];
		$info['medianotes'] = $imgrow['notes'];
	}
	elseif( !$personID ) {
		$mediasearch = isset($_SESSION['tng_mediasearch']) ? $_SESSION['tng_mediasearch'] : "";
		$tnggallery = isset($_SESSION['tng_gallery']) ? $_SESSION['tng_gallery'] : "";
		if( (!$requirelogin || !$treerestrict || !$assignedtree) && !empty($_SESSION['tng_mediatree']) )
			$tree = $_SESSION['tng_mediatree'];

		if( $all ) {
			$wherestr = "WHERE 1=1";
			$showall = "";
		}
		else {
			$wherestr = "WHERE mediatypeID = '$mediatypeID'";
			$showall = "mediatypeID=$mediatypeID&amp;";
		}
		//if( $tree ) {
			//$wherestr .= " AND $medialinks_table.gedcom = \"$tree\"";
			//$join = "INNER JOIN";
		//}
		//else
			$join = "LEFT JOIN";
		if($mediasearch) {
			if( empty($mediasearch2) )
				$mediasearch2 = addslashes(cleanIt($mediasearch));
			$wherestr .= " AND ($media_table.description LIKE \"%$mediasearch%\" OR $media_table.notes LIKE \"%$mediasearch%\" OR bodytext LIKE \"%$mediasearch%\" OR owner LIKE \"%$mediasearch2%\")";
		}
		if( $tnggallery )
			$wherestr .= " AND thumbpath != \"\"";
			
		$cemwhere = $cemeteryID ? " AND cemeteryID = \"$cemeteryID\"" : "";

		$query = "SELECT DISTINCT $media_table.mediaID, path, map, description, notes, width, height, datetaken, placetaken, owner, alwayson, private, abspath, usecollfolder, status, plot, cemeteryID, showmap, bodytext, form, newwindow, usenl, latitude, longitude, mediatypeID, gedcom 
		FROM $media_table";
		$query .= " $wherestr $cemwhere $wherestr3 ORDER BY description";

		$result = tng_query($query);
		$offsets = get_media_offsets( $result, $mediaID );
		$info['page'] = $offsets[0] + 1;
		tng_data_seek ( $result, $offsets[0] );

		$imgrow = tng_fetch_assoc($result);
		$info['mediadescription'] = $imgrow['description'];
		$info['medianotes'] = $imgrow['notes'];
		$info['mediaID'] = $mediaID;
		$info['ordernum'] = $ordernum;
	}
	else {
		$query = "SELECT medialinkID, path, map, description, notes, altdescription, altnotes, width, height, datetaken, placetaken, owner, ordernum, alwayson, private, abspath, $media_table.mediaID as mediaID, usecollfolder, status, plot, cemeteryID, showmap, bodytext, form, newwindow, usenl, latitude, longitude, mediatypeID, $media_table.gedcom
			FROM ($media_table, $medialinks_table)
			WHERE personID = \"$personID\" AND $medialinks_table.gedcom = \"$tree\" AND mediatypeID = \"$mediatypeID\" AND eventID = \"$eventID\" AND $media_table.mediaID = $medialinks_table.mediaID $wherestr3
			ORDER by ordernum";
		$result = tng_query($query);
		$offsets = get_media_offsets( $result, $mediaID );
		$info['page'] = $offsets[0] + 1;
		if( $result ) tng_data_seek ( $result, $offsets[0] );

		$imgrow = tng_fetch_assoc($result);
		$info['mediaID'] = $imgrow['mediaID'];
		$info['ordernum'] = $imgrow['ordernum'];
		$info['mediadescription'] = $imgrow['altdescription'] ? $imgrow['altdescription'] : $imgrow['description'];
		$info['medianotes'] = $imgrow['altnotes'] ? $imgrow['altnotes'] : $imgrow['notes'];
	}
	if($imgrow['gedcom'] && $assignedtree && $imgrow['gedcom'] != $assignedtree)
		$allow_media_edit = false;
	$info['gotmap'] = $imgrow['map'] ? 1 : 0;
	$info['result'] = $result;
	$info['imgrow'] = $imgrow;

	return $info;
}

function findLivingPrivate($mediaID, $tree) {
	global $tree, $text, $medialinks_table, $people_table, $families_table, $citations_table, $assignedtree;

	$info = array();
	//select all medialinks for this mediaID, joined with people
	//loop through looking for living
	//if any are living, don't show media
	$query = "SELECT $medialinks_table.medialinkID, $medialinks_table.personID as personID, $medialinks_table.gedcom as gedcom, linktype, people.living as living, people.private as private, people.branch as branch, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr,
		$families_table.branch as fbranch, $families_table.living as fliving, $families_table.private as fprivate, $families_table.husband, $families_table.wife, $families_table.familyID
		FROM $medialinks_table
		LEFT JOIN $people_table AS people ON $medialinks_table.personID = people.personID AND $medialinks_table.gedcom = people.gedcom
		LEFT JOIN $families_table ON $medialinks_table.personID = $families_table.familyID AND $medialinks_table.gedcom = $families_table.gedcom
		WHERE $medialinks_table.mediaID = \"$mediaID\"";
	if($tree) {
		$query .= " AND ($medialinks_table.gedcom = \"$tree\" || $medialinks_table.gedcom = \"\")";
		$wherestr2 = " AND $medialinks_table.gedcom = \"$tree\"";
	}
	else
		$wherestr2 = "";
	$presult = tng_query($query);
	$noneliving = 1;
	$noneprivate = 1;
	$info['private'] = $info['living'] = "";
	//$rightbranch = $livedefault == 2 ? 1 : 0;
	//$allrightbranch = 1;
	while( $prow = tng_fetch_assoc( $presult )) {
		if($prow['private']) $info['private'] = 1;
		if($prow['living']) $info['living'] = 1;
		if( $prow['fbranch'] ) $prow['branch'] = $prow['fbranch'];
		if( $prow['fliving'] == 1 ) $prow['living'] = $prow['fliving'];
		if( $prow['fprivate'] == 1 ) $prow['private'] = $prow['fprivate'];
		if( !$prow['living'] && !$prow['private'] && ($prow['linktype'] == '' || $prow['linktype'] == 'C')) {
			$query = "SELECT count(*) as ccount FROM $citations_table, $people_table
				WHERE $citations_table.citationID = '{$prow['personID']}' AND $citations_table.persfamID = $people_table.personID AND $citations_table.gedcom = $people_table.gedcom
				AND (living = '1' OR private = '1')";
			$presult2 = tng_query($query);
			$prow2 = tng_fetch_assoc( $presult2 );
			if( $prow2['ccount'] ) $prow['living'] = 1;
			tng_free_result( $presult2 );
		}
		$prights = determineLivingPrivateRights($prow);
		if(!$prights['both']) {
			if($prow['private']) $noneprivate = 0;
			if($prow['living']) $noneliving = 0;
			break;
		}
	}
	tng_free_result( $presult );

	$info['noneliving'] = $noneliving;
	$info['noneprivate'] = $noneprivate;
	//$info['rightbranch'] = $rightbranch;
	//$info['allrightbranch'] = $allrightbranch;

	return $info;
}

function getMediaNavigation($mediaID,$personID,$albumlinkID,$result,$showlinks = true) {
	global $allow_admin, $allow_media_edit, $noneliving, $albumname, $albumID, $offset, $tnggallery;
	global $tree, $page, $maxsearchresults, $linktype, $cms, $showall, $tnggallery, $text;
	global $showalbum_url, $browsemedia_url, $familygroup_url, $showsource_url, $showrepo_url, $placesearch_url, $showmedia_url, $tngconfig;
	global $totalpages, $all;

	$mediaperpage = 1;
	$max_showmedia_pages = 5;
	
	$pagenam = $pagenav = $prevlink = $firstlink = $lastlink = $nextlink = "";
	$maxresultsfactor = $tnggallery ? $maxsearchresults * 2 : $maxsearchresults;
	$pagenum = ceil($page/$maxresultsfactor);

	if($showlinks) {
		if( $allow_admin && $allow_media_edit )
			$pagenav .= "<a href=\"{$cms['tngpath']}admin_editmedia.php?mediaID=$mediaID&amp;cw=1\" target=\"blank\" class=\"snlink\">&raquo; {$text['editmedia']}</a> &nbsp;&nbsp;&nbsp;";

		if( $albumlinkID ) {
			$offset = floor( $page / $maxresultsfactor ) * $maxresultsfactor;
			$pagenav .= "<a href=\"$showalbum_url" . "albumID=$albumID&amp;offset=$offset&amp;tngpage=$pagenum&amp;tnggallery=$tnggallery\" class=\"snlink\">&raquo; $albumname</a>  &nbsp;&nbsp;&nbsp;";
		}
		elseif( !$personID ) {
			$offset = floor( $page / $maxresultsfactor ) * $maxresultsfactor;
			$pagenav .= "<a href=\"$browsemedia_url" . $showall . "offset=$offset&amp;tngpage=$pagenum&amp;tnggallery=$tnggallery\" class=\"snlink\">&raquo; {$text['showall']}</a>  &nbsp;&nbsp;&nbsp;";
		}
		else {
			if( $linktype == "F" ) {
				$pagenav .= "<a href=\"$familygroup_url" . "familyID=$personID&amp;tree=$tree\" class=\"snlink\">&raquo; {$text['groupsheet']}</a>  &nbsp;&nbsp;&nbsp;";
			}
			elseif( $linktype == "S" ) {
				$pagenav .= "<a href=\"$showsource_url" . "sourceID=$personID&amp;tree=$tree\" class=\"snlink\">&raquo; {$text['source']}</a>  &nbsp;&nbsp;&nbsp;";
			}
			elseif( $linktype == "R" ) {
				$pagenav .= "<a href=\"$showrepo_url" . "repoID=$personID&amp;tree=$tree\" class=\"snlink\">&raquo; {$text['repository']}</a>  &nbsp;&nbsp;&nbsp;";
			}
			elseif( $linktype == "L" ) {
				$treestr = $tngconfig['places1tree'] ? "" : "&amp;tree=$tree";
				$pagenav .= "<a href=\"$placesearch_url" . "psearch=$personID$treestr\" class=\"snlink\">&raquo; {$text['place']}: $personID</a>  &nbsp;&nbsp;&nbsp;";
			}
		}
	}

	$total = tng_num_rows($result);

	if( !$page ) $page = 1;
	if( $total > $mediaperpage ) {
		$totalpages = ceil($total/$mediaperpage);
		if ($page > $totalpages ) $page = $totalpages;
		$allstr = $all ? "&amp;all=1" : "";

		if( $page > 1 ) {
			$prevpage = $page - 1;
			$prevlink = get_media_link( $result, $showmedia_url, $prevpage, "jump", $text['text_prev'], "&laquo;" . $text['text_prev'], $allstr, $showlinks );
		}
		if( $page < $totalpages ) {
			$nextpage = $page + 1;
			$nextlink = get_media_link( $result, $showmedia_url, $nextpage, "jumpnext", $text['text_next'], $text['text_next'] . "&raquo;", $allstr, $showlinks );
		}
		$curpage = 0;
		$numlinks = "";
		while( $curpage++ < $totalpages ) {
			if( ( $curpage <= $page-$max_showmedia_pages || $curpage >= $page+$max_showmedia_pages ) && $max_showmedia_pages!=0 ) {
				if( $curpage == 1 )
					$firstlink = get_media_link( $result, $showmedia_url, $curpage, "jump", $text['firstpage'], "&laquo;1", $allstr, $showlinks ) . "...";
				if( $curpage == $totalpages )
					$lastlink = "..." . get_media_link( $result, $showmedia_url, $curpage, "jump", $text['lastpage'], "$totalpages&raquo;", $allstr, $showlinks );
			}
			else {
				if ($curpage==$page)
					$numlinks .= " <span class=\"snlink snlinkact\">$curpage</span> ";
				else
					$numlinks .= get_media_link( $result, $showmedia_url, $curpage, "jump", $curpage, $curpage, $allstr, $showlinks );
			}
		}
		$pagenav .= "<span class=\"normal\">$prevlink $firstlink $numlinks $lastlink $nextlink</span>";
	}

	return $pagenav;
}

function getAlbumLinkText($mediaID) {
	global $text, $albums_table, $albumlinks_table, $showalbum_url;

	$albumlinktext = "";
	//get all albumlink records for this mediaID, joined with album tables
	$query = "SELECT $albums_table.albumID, albumname FROM ($albumlinks_table, $albums_table) WHERE mediaID = \"$mediaID\" AND $albumlinks_table.albumID = $albums_table.albumID";
   	$result = tng_query($query);
	while( $row = tng_fetch_assoc( $result ) ) {
		if($albumlinktext) $albumlinktext .= ", ";
		$albumlinktext .= "<a href=\"$showalbum_url" . "albumID={$row['albumID']}\">" . $row['albumname'] . "</a>";
	}
	tng_free_result($result);

	return $albumlinktext;
}

function getMediaLinkText($mediaID, $ioffset) {
	global $text, $admtext, $medialinks_table, $people_table, $families_table, $sources_table, $repositories_table, $events_table, $eventtypes_table, $wherestr2, $maxsearchresults;
	global $assignedtree, $showmedia_url, $showrepo_url, $showsource_url, $getperson_url, $familygroup_url, $placesearch_url, $tngconfig, $citations_table;

	if( $ioffset ) {
		$ioffsetstr = "$ioffset, ";
		$newioffset = $ioffset + 1;
	}
	else {
		$ioffsetstr = "";
		$newioffset = 0;
	}
	$query = "SELECT $medialinks_table.medialinkID, $medialinks_table.personID as personID, people.burialtype, people.living as living, people.private as private, people.branch as branch, $medialinks_table.eventID,
		$families_table.branch as fbranch, $families_table.living as fliving, $families_table.private as fprivate, people.lastname as lastname, people.lnprefix as lnprefix, people.firstname as firstname, people.prefix as prefix, people.suffix as suffix, people.nameorder, people.title, altdescription, altnotes, $medialinks_table.gedcom,
		people.birthdate, people.birthdatetr, people.altbirthdate, people.altbirthdatetr, people.deathdate, people.deathdatetr, familyID, people.personID as personID2, wifepeople.personID as wpersonID, wifepeople.personID as wife, wifepeople.firstname as wfirstname, wifepeople.lnprefix as wlnprefix, wifepeople.lastname as wlastname,
		wifepeople.prefix as wprefix, wifepeople.suffix as wsuffix, husbpeople.personID as hpersonID, husbpeople.personID as husband, husbpeople.firstname as hfirstname, husbpeople.lnprefix as hlnprefix, husbpeople.lastname as hlastname,
		husbpeople.prefix as hprefix, husbpeople.suffix as hsuffix, $sources_table.title as stitle, $sources_table.sourceID, $repositories_table.repoID, reponame, linktype
		FROM $medialinks_table
		LEFT JOIN $people_table AS people ON $medialinks_table.personID = people.personID AND $medialinks_table.gedcom = people.gedcom
		LEFT JOIN $families_table ON $medialinks_table.personID = $families_table.familyID AND $medialinks_table.gedcom = $families_table.gedcom
		LEFT JOIN $people_table AS husbpeople ON $families_table.husband = husbpeople.personID AND $families_table.gedcom = husbpeople.gedcom
		LEFT JOIN $people_table AS wifepeople ON $families_table.wife = wifepeople.personID AND $families_table.gedcom = wifepeople.gedcom
		LEFT JOIN $sources_table ON $medialinks_table.personID = $sources_table.sourceID AND $medialinks_table.gedcom = $sources_table.gedcom
		LEFT JOIN $repositories_table ON ($medialinks_table.personID = $repositories_table.repoID AND $medialinks_table.gedcom = $repositories_table.gedcom)
		WHERE mediaID = \"$mediaID\"$wherestr2 ORDER BY people.lastname, people.lnprefix, people.firstname, hlastname, hlnprefix, hfirstname  LIMIT $ioffsetstr" . ($maxsearchresults + 1);
	$presult = tng_query($query);
	$numrows = tng_num_rows( $presult );
	$medialinktext = "";
	$count = 0;
	$citelinks = array();
	$need_semicolon = false;
	while( $count < $maxsearchresults && $prow = tng_fetch_assoc( $presult ) ) {
		if( $prow['fbranch'] != NULL ) $prow['branch'] = $prow['fbranch'];
		if( $prow['fliving'] != NULL ) $prow['living'] = $prow['fliving'];
		if( $prow['fprivate'] != NULL ) $prow['private'] = $prow['fprivate'];
		if( $need_semicolon ) $medialinktext .= "; ";
		$need_semicolon = true;

		$prights = determineLivingPrivateRights($prow);
		$prow['allow_living'] = $prights['living'];
		$prow['allow_private'] = $prights['private'];

		if( $prow['personID2'] != NULL ) {
			$medialinktext .= "<a href=\"$getperson_url" . "personID={$prow['personID2']}&amp;tree={$prow['gedcom']}\">";
			$medialinktext .= getName( $prow ) . "</a>";
		}
		elseif( $prow['sourceID'] != NULL ) {
			$sourcetext = $prow['stitle'] ? $prow['stitle'] : $text['source']. ": " . $prow['sourceID'];
			$medialinktext .= "<a href=\"$showsource_url" . "sourceID={$prow['sourceID']}&amp;tree={$prow['gedcom']}\">" . $sourcetext . "</a>";
		}
		elseif( $prow['repoID'] != NULL ) {
			$repotext = $prow['reponame'] ? $prow['reponame'] : $text['repository'] . ": " . $prow['repoID'];
			$medialinktext .= "<a href=\"$showrepo_url" . "repoID={$prow['repoID']}&amp;tree={$prow['gedcom']}\">" . $repotext . "</a>";
		}
		elseif( $prow['familyID'] != NULL ) {
			$familyname = trim($prow['hlnprefix'] . " " . $prow['hlastname']) . "/" . trim($prow['wlnprefix'] . " " . $prow['wlastname']) . " ({$prow['familyID']})";
			$medialinktext .= "<a href=\"$familygroup_url" . "familyID={$prow['familyID']}&amp;tree={$prow['gedcom']}\">{$text['family']}: $familyname</a>";
		}
		elseif( !$prow['linktype'] || $prow['linktype'] == "C") {
			$query = "SELECT persfamID, sourceID, gedcom from $citations_table WHERE citationID = \"{$prow['personID']}\"";
			$cresult = tng_query($query);
			$need_semicolon = false;
			if($cresult) {
				$crow = tng_fetch_assoc($cresult);
				if($crow) {
					$persfamID = $crow['persfamID'];
					if(!in_array($persfamID, $citelinks)) {
						$citelinks[] = $persfamID;
						if(substr($persfamID,0,1) == $tngconfig['personprefix'] || substr($persfamID,-1) == $tngconfig['personsuffix']) {
							$medialinktext .= "<a href=\"$getperson_url" . "personID=$persfamID&amp;tree={$crow['gedcom']}\">";
							$presult2 = getPersonSimple($prow['gedcom'],$persfamID);
							if($presult2) {
								$cprow = tng_fetch_assoc($presult2);
								$cprights = determineLivingPrivateRights($cprow);
								$cprow['allow_living'] = $cprights['living'];
								$cprow['allow_private'] = $cprights['private'];
								$medialinktext .= getName( $cprow ) . "</a>";
								$need_semicolon = true;
								tng_free_result($presult2);
							}
						}
						elseif(substr($persfamID,0,1) == $tngconfig['familyprefix'] || substr($persfamID,-1) == $tngconfig['familysuffix']) {
							$presult2 = getFamilyData($prow['gedcom'],$persfamID);
							if($presult2) {
								$famrow = tng_fetch_assoc($presult);
								$familyname = getFamilyName($famrow);
								$medialinktext .= "<a href=\"$familygroup_url" . "familyID=$persfamID&amp;tree={$crow['gedcom']}\">{$text['family']}: $familyname</a>";
								$need_semicolon = true;
								tng_free_result($presult2);
							}
						}
					}
				}
			}
			tng_free_result($cresult);
		}
		else {
			$treestr = $tngconfig['places1tree'] ? "" : "&amp;tree={$prow['gedcom']}";
			$medialinktext .= "<a href=\"$placesearch_url" . "psearch=" . urlencode($prow['personID']) . "$treestr\">" . $prow['personID'] . "</a>";
		}
		if($prow['eventID']) {
			$query = "SELECT display from $events_table, $eventtypes_table WHERE eventID = \"{$prow['eventID']}\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID";
			$eresult = tng_query($query);;
			$erow = tng_fetch_assoc($eresult);
			if($prow['eventID'] == "BURI" && $prow['burialtype'] == "1")
				$event = $text["cremated"];
			else
				$event = !empty($erow['display']) && is_numeric($prow['eventID']) ? getEventDisplay( $erow['display'] ) : (!empty($admtext[$prow['eventID']]) ? $admtext[$prow['eventID']] : $prow['eventID']);
			tng_free_result($eresult);
			if($event) $medialinktext .= " ($event)";
		}
		$count++;
	}
	tng_free_result( $presult );
	if( $numrows > $maxsearchresults )
		$medialinktext .= "\n['<a href=\"$showmedia_url" . "mediaID=$mediaID&amp;ioffset=" . ($newioffset + $maxsearchresults) . "\">{$text['morelinks']}</a>']";

	return $medialinktext;
}

function showMediaSource($imgrow, $ss = false) {
	global $text, $usefolder, $size, $imagetypes, $htmldocs, $histories_url, $cms, $tngconfig, $videotypes, $recordingtypes;
	global $mediatypeID, $description, $showmedia_url, $medialinkID, $albumlinkID, $mediatypes_like, $sitever, $rootpath, $charset, $tngdomain;

	if($sitever == "mobile")
		$ss = false;
	if( $imgrow['form'] )
		$imgrow['form'] = strtoupper($imgrow['form']);
	else {
		preg_match( "/\.(.+)$/", $imgrow['path'], $matches );
		$imgrow['form'] = isset($matches[1]) ? strtoupper($matches[1]) : "";
	}
	if($ss)
		echo "<div class=\"lightback slidepane rounded10\">\n";
	if( !$ss && $imgrow['map'] ) {
		echo "<map name=\"tngmap_{$imgrow['mediaID']}\" id=\"tngmap_{$imgrow['mediaID']}\">{$imgrow['map']}</map>\n";
		$mapstr = " usemap=\"#tngmap_{$imgrow['mediaID']}\"";
	}
	else
		$mapstr = "";
	if($imgrow['abspath'] || substr($imgrow['path'],0,4) == "http" || substr($imgrow['path'],0,1) == "/")
		$mediasrc = $imgrow['path'];
	else {
		if( in_array( $imgrow['form'], $htmldocs ) && $cms['support'] )
			$mediasrc = $histories_url . "inc=" . $imgrow['path'];
		else {
			$treestr = $tngconfig['mediatrees'] && $imgrow['gedcom'] ? $imgrow['gedcom'] . "/" : "";
			$mediasrc = "$usefolder/$treestr" . str_replace("%2F","/",rawurlencode( $imgrow['path'] ));
		}
	}

	$targettext = $imgrow['newwindow'] ? " target=\"_blank\"" : "";
	if( $imgrow['path'] ) {
		if( $imgrow['abspath'] ) {
			if( $imgrow['newwindow'] )
				echo "<form><input type=\"button\" value=\"{$text['viewitem']}...\" onClick=\"window.open('$mediasrc');\"/></form>\n";
			else
				echo "<form><input type=\"button\" value=\"{$text['viewitem']}...\" onClick=\"window.location.href='$mediasrc';\"/></form>\n";
		}
		else {
			if( !$imgrow['form'] ) {
				preg_match( "/\.(.+)$/", $imgrow['path'], $matches );
				$imgrow['form'] = $matches[1];
			}
			if( in_array($imgrow['form'],$imagetypes) ) {
				$width = isset($size[0]) ? $size[0] : "";
				$height = isset($size[1]) ? $size[1] : "";
				if($ss) {
					if($sitever == "standard") {
						$maxw = 860;
						$maxh = 550;
					} else {
						$maxw = 600;
						$maxh = 400;
					}
					$medialinkstr = $medialinkID ? "&amp;medialinkID=$medialinkID" : "";
					$albumlinkstr = $albumlinkID ? "&amp;albumlinkID=$albumlinkID" : "";
				}
				if( $width && $height ) {
					if($ss) {
						if($width > $height) {
							$height = floor($height * $maxw / $width);
							$width = $maxw;
						}
						else {
							$width = floor($width * $maxh / $height);
							$height = $maxh;
						}
					}
					else {
						$maxw = $tngconfig['imgmaxw'];
						$maxh = $tngconfig['imgmaxh'];
					}
					if( $maxw && ($width > $maxw) ) {
						$width = $maxw;
						$height = floor( $width * $size[1] / $size[0] ) ;
					}
					if( $maxh && ($height > $maxh) ) {
						$height = $maxh;
						$width = floor( $height * $size[0] / $size[1] ) ;
					}
				}
				elseif($ss) {
					$height = $maxh;
				}
				if( $width && $width != "0" ) $widthstr = "width=\"$width\"";
				if( $height && $height != "0" ) $heightstr = "height=\"$height\"";
				if($ss) {  //slideshow
					$img = "<img src=\"$mediasrc\" border=\"0\" $mapstr alt=\"$description\" />";
					echo "<div id=\"slidearea\"><a href=\"$showmedia_url" . "mediaID={$imgrow['mediaID']}$medialinkstr$albumlinkstr\" border=\"0\" title=\"{$text['moreinfo']}\">$img</a></div>\n";
				}
				else {
					$imgviewer = $tngconfig['imgviewer'];
					if(!$imgviewer || in_array($imgrow['mediatypeID'],$mediatypes_like[$imgviewer])) {
						$maxvh = $tngconfig['imgvheight'];
						$calcHeight = $maxvh ? ($height > $maxvh ? $maxvh : $height) : 1;
						if( !isset($imgrow['medialinkID']) ) $imgrow['medialinkID'] = "";
						echo "<div id=\"loadingdiv2\" class=\"rounded10\" style=\"position:static;\">{$text['loading']}</div><iframe name=\"iframe1\" id=\"iframe1\" src=\"" . getURL("img_viewer",1) . "mediaID={$imgrow['mediaID']}&amp;medialinkID={$imgrow['medialinkID']}\" width=\"100%\" height=\"1\" onload=\"calcHeight($calcHeight)\" frameborder=\"0\" marginheight=\"0\" marginwidth=\"0\" scrolling=\"no\"></iframe>"; 					}
					else {
						$rectangles = getRectangles($imgrow['mediaID'], false);
						echo "<div class=\"titlebox mediaalign\"";
						if($rectangles) {
							echo " style=\"overflow: auto\"";
							$inner_div_beg = "<div style=\"position:relative;margin:auto;width:{$width}px;height:{$height}\">\n";
							$inner_div_end = "</div>\n";
						}
						else {
							echo " id=\"imgdiv\"";
							$inner_div_beg = $inner_div_end = "";
						}
						echo ">\n";
						echo "{$inner_div_beg}<img src=\"$mediasrc\" id=\"theimage\" border=\"0\" $mapstr alt=\"$description\" />\n{$rectangles}{$inner_div_end}";
						echo "</div>\n";
					}
				}
			}
			elseif( in_array($imgrow['form'],$videotypes) || in_array($imgrow['form'],$recordingtypes) ) {
				$widthstr = $imgrow['width'] ? " width=\"{$imgrow['width']}\"" : "";
				$heightstr = $imgrow['height'] ? " height=\"{$imgrow['height']}\"" : "";

     			if($imgrow['form'] == 'FLV') {
					$flvheight = $imgrow['height'] ? $imgrow['height'] : 300;
					$flvwidth = $imgrow['width'] ? $imgrow['width'] : 400;
					$preview_img = str_replace('.flv','.jpg',$mediasrc);
         			echo "<script type=\"text/javascript\" src=\"flvsupport/flowplayer-3.2.8.min.js\"></script>";
         			echo "<a href=\"$mediasrc\"";
         			echo "style=\"display:block;width:{$flvwidth}px;height:{$flvheight}px;\" id=\"videoplayer\">";
         			if(file_exists(str_replace("%20"," ",$preview_img))) {
            			echo "<img src='$preview_img'style=\"display:block;width:{$flvwidth}px;height:{$flvheight}px;\" alt=\"Click here to play this video...\" />";
         			}
					elseif(file_exists("flvsupport/flvicon.png")) {
            			echo "<img src='flvsupport/flvicon.png' alt='Click here to play this video...' />";
       				}
       				echo "</a>";
       				echo "<script type=\"text/javascript\">flowplayer('videoplayer','flvsupport/flowplayer-3.2.9.swf');</script>";
       			}
				elseif(in_array($imgrow['form'],array("MOV","MP4","WEBM","OGG")))
					echo "<video $widthstr$heightstr controls>\n<source src=\"$mediasrc\">\n</video>\n";
				else
					echo "<object data=\"$mediasrc\"$widthstr$heightstr>\n";
			}
			elseif( in_array($imgrow['form'],$recordingtypes) ) {
				if(in_array($imgrow['form'],array("MP3","WAV","OGG")))
					echo "<audio $widthstr$heightstr controls>\n<source src=\"$mediasrc\">\n</audio>\n";
				else
					echo "<object data=\"$mediasrc\"$widthstr$heightstr>\n";
			}
			elseif( $imgrow['form'] == "TXT" ) {
				echo "<p><pre style=\"word-wrap: break-word; white-space: pre-wrap;\">";
				$filetext=file_get_contents($rootpath.$cms['tngpath'].urldecode($mediasrc));
				if( $charset == "UTF-8" && !mb_check_encoding($filetext, 'UTF-8') )
					echo mb_convert_encoding($filetext, 'UTF-8', 'ISO-8859-1');
				elseif( $charset == "ISO-8859-1" && mb_check_encoding($filetext, 'UTF-8') )
					echo mb_convert_encoding($filetext, 'ISO-8859-1', 'UTF-8');
				else
					echo $filetext;
				echo "</pre></p>\n";
			}
			elseif($imgrow['form'] == "PDF") {
				$widthstr = $imgrow['width'] ? $imgrow['width'] : "100%";
				$heightstr = $imgrow['height'] ? $imgrow['height'] : "700";
				echo "<object data=\"$mediasrc\" type=\"application/pdf\" width=\"100%\" height=\"$heightstr\"><p><a href=\"$mediasrc\">Download PDF</a></p></object>\n";
			}
			elseif($imgrow['form'] == "DOC" || $imgrow['form'] == "DOCX") {
				$widthstr = $imgrow['width'] ? $imgrow['width'] : "100%";
				$heightstr = $imgrow['height'] ? $imgrow['height'] : "700";
				$doc_url = substr($tngdomain,-1) == "/" ? $tngdomain . str_replace('\\', '/', $mediasrc) : $tngdomain . "/" . str_replace('\\', '/', $mediasrc);
				$doc_url = str_replace("'","&apos;",$doc_url);
				echo "<iframe src=\"https://view.officeapps.live.com/op/embed.aspx?src={$doc_url}\" align='center' width='100%' height='{$heightstr}'/>This is an embedded <a target='_blank' href='https://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='https://office.com/webapps'>Office Online</a>.</iframe>";			
			}
			else {
				if( $imgrow['newwindow'] )
					echo "<form><input type=\"button\" value=\"{$text['viewitem']}...\" onClick=\"window.open('$mediasrc');\"/></form>\n";
				else
					echo "<form><input type=\"button\" value=\"{$text['viewitem']}...\" onClick=\"window.location.href='$mediasrc';\"/></form>\n";
			}
		}
	}
	if( $imgrow['bodytext'] ) {
		echo "<div class=\"normal\">" . ($imgrow['usenl'] ? nl2br($imgrow['bodytext']) : $imgrow['bodytext']) . "</div>";
		if(!empty($imgrow['path'])) echo "<br/><br/>\n";
	}
	if($ss)
		echo "</div>\n";
}

function tableRow($label,$fact) {
	return "<tr><td style=\"width:150px\" class=\"fieldnameback fieldname\">$label</td><td class=\"databack\">" . insertLinks($fact) . "</td></tr>\n";
}

function showTable($imgrow, $medialinktext, $albumlinktext) {
	global $text, $rootpath, $usefolder, $showextended, $imagetypes, $size, $info;

	$tabletext = "";
	$filename = $imgrow['abspath'] ? $imgrow['path'] : basename( $imgrow['path'] );
	$tabletext .= "<table border=\"0\" cellspacing=\"1\" cellpadding=\"4\" width=\"100%\" class=\"tfixed whiteback\">\n";

	if( $imgrow['owner'] )
		$tabletext .= tableRow($text['photoowner'], $imgrow['owner']);
	if( $imgrow['datetaken'] )
		$tabletext .= tableRow($text['date'], displayDate($imgrow['datetaken'])) ;
	if( $imgrow['placetaken'] )
		$tabletext .= tableRow($text['place'], $imgrow['placetaken']) ;
	if( $imgrow['latitude'] )
		$tabletext .= tableRow($text['latitude'], $imgrow['latitude']);
	if( $imgrow['longitude'] )
		$tabletext .= tableRow($text['longitude'], $imgrow['longitude']);

	if( $showextended ) {
		if($filename) {
			$tabletext .= tableRow($text['filename'], $filename );
			$filesize = $imgrow['path'] && file_exists("$rootpath$usefolder/" . $imgrow['path']) ? display_size(filesize("$rootpath$usefolder/" . $imgrow['path'])) : "";
			$tabletext .= tableRow($text['filesize'], $filesize);
		}
		//$tabletext .= tableRow($text['id'], $imgrow['mediaID']);
		if( in_array($imgrow['form'],$imagetypes) && isset($size[0]) && isset($size[1]) )
			$tabletext .= tableRow($text['photosize'], "$size[0] x $size[1]" );
		if(isset($info))
			$tabletext .= output_iptc_data( $info );
	}

	if( $medialinktext )
		$tabletext .= tableRow($text['indlinked'], $medialinktext);
	if( $albumlinktext )
		$tabletext .= tableRow($text['albums'], $albumlinktext);
	$tabletext .= "</table>\n";

	return $tabletext;
}

function doCemPlusMap($imgrow, $tree) {
	global $cemeteries_table, $media_table, $text, $rootpath, $headstonepath, $mediatypes_assoc, $mediapath, $showmedia_url, $thumbmaxw;

	$showmap_url = getURL( "showmap", 1 );
	$query = "SELECT cemname, city, county, state, country, maplink, notes FROM $cemeteries_table WHERE cemeteryID = \"{$imgrow['cemeteryID']}\"";
	$cemresult = tng_query($query);
	$cemetery = tng_fetch_assoc($cemresult);
	tng_free_result($cemresult);

	echo "<p><span class=\"subhead\">\n";
	$location = $cemetery['cemname'];
	if( $cemetery['city'] ) {
		if( $location ) $location .= ", ";
		$location .= $cemetery['city'];
	}
	if( $cemetery['county'] ) {
		if( $location ) $location .= ", ";
		$location .= $cemetery['county'];
	}
	if( $cemetery['state'] ) {
		if( $location ) $location .= ", ";
		$location .= $cemetery['state'];
	}
	if( $cemetery['country'] ) {
		if( $location ) $location .= ", ";
		$location .= $cemetery['country'];
	}
	echo "<a href=\"$showmap_url" . "cemeteryID={$imgrow['cemeteryID']}&amp;tree=$tree\">$location</a>";
	echo "</span></p>\n";
	if( $cemetery['notes'] )
		echo "<p><strong>{$text['notes']}:</strong> " . nl2br($cemetery['notes']) . "</p>";

	if( $imgrow['showmap'] ) {
		if( !empty($cemetery['maplink']) && file_exists("$rootpath$headstonepath/" . $cemetery['maplink']) ) {
			$mapsize = @GetImageSize( "$rootpath$headstonepath/" . $cemetery['maplink'] );
			echo "<img src=\"$headstonepath/{$cemetery['maplink']}\" border=\"0\" $mapsize[3] alt=\"{$cemetery['cemname']}\" /><br/><br/>\n";
		}
	}

	$query = "SELECT mediaID, mediatypeID, path, thumbpath, description, notes, usecollfolder, abspath, newwindow, gedcom FROM $media_table WHERE cemeteryID = \"{$imgrow['cemeteryID']}\" AND linktocem = \"1\" ORDER BY mediatypeID, description";
	$hsresult = tng_query($query);
	if( tng_num_rows( $hsresult ) ) {
		$i = 1;
		echo "<div class=\"titlebox\">\n";
		echo "<span class=\"subhead\"><b>{$text['cemphotos']}</b></span><br /><br />";

		echo "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" class=\"whiteback\" width=\"100%\">\n";
		echo "<tr><td class=\"fieldnameback\" width=\"10\">&nbsp;</td>\n";
		echo "<td class=\"fieldnameback\" width=\"$thumbmaxw\"><span class=\"fieldname\">&nbsp;<strong>{$text['thumb']}</strong>&nbsp;</span></td>\n";
		echo "<td class=\"fieldnameback\"><span class=\"fieldname\">&nbsp;<strong>{$text['description']}</strong>&nbsp;</span></td></tr>\n";

		while( $hs = tng_fetch_assoc( $hsresult ) ) {
			$description = $hs['description'];
			$notes = nl2br($hs['notes']);
			$hsmediatypeID = $hs['mediatypeID'];
			$usehsfolder = $hs['usecollfolder'] ? $mediatypes_assoc[$hsmediatypeID] : $mediapath;
			$hs['allow_living'] = $hs['allow_private'] = 1;

			$imgsrc = getSmallPhoto($hs);
			if( $hs['abspath'] || substr($hs['path'],0,4) == "http" || substr($hs['path'],0,1) == "/")
				$href = $hs['path'];
			else
				$href = "$showmedia_url" . "mediaID=" . $hs['mediaID'];

			$targettext = $hs['newwindow'] ? " target=\"_blank\"" : "";
			echo "<tr><td valign=\"top\" class=\"databack\"><span class=\"normal\">$i</span></td>";
			echo "<td valign=\"top\" class=\"databack\" width=\"$thumbmaxw\">";
			echo $imgsrc ? "<a href=\"$href\"$targettext>$imgsrc</a>" : "&nbsp;";
			echo "</td>\n";
			echo "<td valign=\"top\" class=\"databack\"><span class=\"normal\">";
			echo "<a href=\"$href\">$description</a><br/>$notes&nbsp;</span></td></tr>\n";
			$i++;
		}
		echo "</table>\n</div>\n";
	}
	tng_free_result( $hsresult );
}

function getRectangles($mediaID, $show_at_start = true) {
	$result = getImageTags($mediaID);

	$rectangles = "";
	while( $row = tng_fetch_assoc($result) ) {
		list($label, $media_link_url) = getImageTagInfo($row);

		if($show_at_start) {
			$handlers = "";
			$more_style = "";
		}
		else {
			$more_style = "opacity:0;cursor:pointer";
			$handlers = "onmouseover=\"this.style.opacity = '1';\" onmouseout=\"this.style.opacity = toggle_off;\"";
			if($media_link_url) $handlers .= " onclick=\"window.location.href='{$media_link_url}'\"";
		}
		$rectangles .= "<div id=\"box_{$row['ID']}\" style=\"display:block; top:{$row['rtop']}px; left:{$row['rleft']}px; width:{$row['rwidth']}px; height:{$row['rheight']}px;{$more_style}\" $handlers class=\"mlbox bunselected\">\n";
		$label_top = $row['rheight'] + 1;
		$overhang = 100 - $row['rwidth'];
		if($overhang > 0) {
			$side = -1 * round($overhang/2);
			$stylestr = "left:{$side}px;right:{$side}px;"; 
		}
		else
			$stylestr = "";
		$rectangles .= "<div class=\"imagetag\" style=\"top:{$label_top}px;{$stylestr}\">{$label}</div>\n";
		$rectangles .= "</div>\n";
	}
	tng_free_result($result);

	return $rectangles;
}
?>