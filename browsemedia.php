<?php
$textpart = "showphoto";
include("tng_begin.php");

include($cms['tngpath'] . "functions.php");

$browsemedia_url = getURL( "browsemedia", 1 );
$getperson_url = getURL( "getperson", 1 );
$showmedia_url = getURL( "showmedia", 1 );
$familygroup_url = getURL( "familygroup", 1 );
$showsource_url = getURL( "showsource", 1 );
$showrepo_url = getURL( "showrepo", 1 );
$placesearch_url = getURL( "placesearch", 1 );
$showmap_url = getURL( "showmap", 1 );

if(isset($mediatypeID)) 
	$mediatypeID = cleanIt(preg_replace("/[<>{};!=]/", '', $mediatypeID));

$flags['imgprev'] = true;

$query = "SET SQL_BIG_SELECTS=1";
$result = tng_query($query);

if( !isset($mediatypeID) ) $mediatypeID = "";
initMediaTypes();
if(array_search($mediatypeID, array_column($mediatypes, 'mediatypeID')) === false)
	$mediatypeID = '';
$orgmediatypeID = $mediatypeID;

if(!in_array($mediatypeID,$mediatypes_like['photos']) && !in_array($mediatypeID,$mediatypes_like['headstones']))
	$tngconfig['ssdisabled'] = 1;

if( $orgmediatypeID ) {
	$wherestr = "WHERE mediatypeID = \"$mediatypeID\"";
	$titlestr = !empty($text[$mediatypeID]) ? $text[$mediatypeID] : $mediatypes_display[$mediatypeID];
	if( $orgmediatypeID == "headstones" ) {
		$hsfields = ", $media_table.cemeteryID, cemname, city";
		$hsjoin = "LEFT JOIN $cemeteries_table ON $media_table.cemeteryID = $cemeteries_table.cemeteryID";
	}
	else
		$hsfields = $hsjoin = "";
}
else {
	$wherestr = "WHERE 1 = 1";
	$hsfields = $hsjoin = "";
	$titlestr = $text['allmedia'];
}

if( !empty($mediasearch) ) {
	$mediasearch = trim($mediasearch);
	$_SESSION['tng_mediasearch'] = $mediasearch;
	$mediasearch2 = addslashes(cleanIt($mediasearch));
	$mediasearch = cleanIt(stripslashes($mediasearch));
}
else {
	$_SESSION['tng_mediasearch'] = "";
	$mediasearch = "";
}

if( !isset($tnggallery) ) $tnggallery = 0;
if( $tnggallery ) {
	$tnggallery = 1;
	$maxsearchresults *= 2;
	$wherestr .= " AND thumbpath != \"\"";
	$gallerymsg = "<a href=\"$browsemedia_url" . "tree=$tree&amp;mediatypeID=$orgmediatypeID&amp;mediasearch=$mediasearch\" class=\"snlink\">&raquo; {$text['regphotos']}</a>";
}
else
	$gallerymsg = "<a href=\"$browsemedia_url" . "tnggallery=1&amp;tree=$tree&amp;mediatypeID=$orgmediatypeID&amp;mediasearch=$mediasearch\" class=\"snlink\">&raquo; {$text['gallery']}</a>";

$_SESSION['tng_gallery'] = $tnggallery;
$_SESSION['tng_mediatree'] = $tree;

function doMediaSearch( $instance, $pagenav ) {
	global $text, $mediasearch, $orgmediatypeID, $browsemedia_url, $tree, $tnggallery;

	$str = getFORM( "browsemedia", "get", "MediaSearch$instance", "" );
	$str .= "<input type=\"text\" name=\"mediasearch\" value=\"$mediasearch\" /> <input type=\"submit\" value=\"{$text['search']}\" /> <input type=\"button\" value=\"{$text['tng_reset']}\" onclick=\"window.location.href='$browsemedia_url" . "mediatypeID=$orgmediatypeID&amp;tree=$tree&amp;tnggallery=$tnggallery';\" />&nbsp;&nbsp;&nbsp;";
	$str .= "<input type=\"hidden\" name=\"mediatypeID\" value=\"$orgmediatypeID\" />\n";
	$str .= $pagenav;
	$str .= "<input type=\"hidden\" name=\"tree\" value=\"$tree\" />\n";
	$str .= "<input type=\"hidden\" name=\"tnggallery\" value=\"$tnggallery\" />\n";
	$str .= "</form>\n";

	return $str;
}

$max_browsemedia_pages = 5;
if( !isset($offset) ) $offset = 0;
if( $offset ) {
	$offsetplus = $offset + 1;
	$newoffset = "$offset, ";
}
else {
	$offsetplus = 1;
	$newoffset = "";
	$page = 1;
}

if( $tree ) {
	$wherestr .= " AND ($media_table.gedcom = \"$tree\" || $media_table.gedcom = \"\")";
	$wherestr2 = " AND $medialinks_table.gedcom = \"$tree\"";
}
else
	$wherestr2 = "";

if( $mediasearch )
	$wherestr .= " AND ($media_table.description LIKE \"%$mediasearch2%\" OR $media_table.notes LIKE \"%$mediasearch2%\" OR bodytext LIKE \"%$mediasearch2%\" OR owner LIKE \"%$mediasearch2%\")";

$query = "SELECT $media_table.mediaID, $media_table.description, $media_table.notes, path, thumbpath, alwayson, usecollfolder, form, mediatypeID, status, plot, newwindow, private, abspath, owner, datetaken, placetaken, $media_table.latitude as mlat, $media_table.longitude as mlong, $media_table.gedcom $hsfields FROM $media_table";
$query .= " $hsjoin $wherestr ORDER BY description LIMIT $newoffset" . $maxsearchresults;
$result = tng_query($query);
$numrows = tng_num_rows( $result );

if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
	if( $tree ) {
		$query = "SELECT count($media_table.mediaID) as mcount FROM $media_table";
		$query .= " $hsjoin $wherestr";
	}
	else
		$query = "SELECT count($media_table.mediaID) as mcount FROM $media_table $wherestr";
	$result2 = tng_query($query);
	$row = tng_fetch_assoc( $result2 );
	tng_free_result($result2);
	$totrows = $row['mcount'];
}
else
	$totrows = $numrows;

$numrowsplus = $numrows + $offset;

$treestr = $tree ? " " . $text['tree'] . ": $tree" : "";
$treestr = trim("$mediasearch $treestr");
$treestr = $treestr ? " ($treestr)" : "";
$logstring = "<a href=\"$browsemedia_url" . "tree=$tree&amp;offset=$offset&amp;mediasearch=$mediasearch&amp;mediatypeID=$mediatypeID\">$titlestr$treestr</a>";
writelog($logstring);
preparebookmark($logstring);

tng_header( $titlestr, $flags );
if($orgmediatypeID) {
	if($mediatypes_icons[$mediatypeID])
		$icon = "<img src=\"{$cms['tngpath']}{$mediatypes_icons[$mediatypeID]}\" width=\"20\" height=\"20\" alt=\"\" class=\"headericon\"/>";
	else
		$icon = "<span class=\"headericon\" id=\"{$mediatypeID}-hdr-icon\"></span>";
}
else
	$icon = "<span class=\"headericon\" id=\"media-hdr-icon\"></span>";
?>

<h1 class="header"><?php echo $icon . $titlestr; ?></h1><br clear="all" />
<?php
$hiddenfields[0] = array('name' => 'mediatypeID', 'value' => $orgmediatypeID);
$hiddenfields[1] = array('name' => 'tnggallery', 'value' => $tnggallery);
echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'browsemedia', 'method' => 'get', 'name' => 'form1', 'id' => 'form1', 'hidden' => $hiddenfields));

$toplinks = "<p class=\"normal\">";
if( $totrows )
	$toplinks .= $text['matches'] . " " . number_format($offsetplus) . " {$text['to']} " . number_format($numrowsplus) . " {$text['of']} " . number_format($totrows) . " &nbsp;&nbsp;&nbsp; ";
$toplinks .= "$gallerymsg";

$pagenav = get_browseitems_nav( $totrows, $browsemedia_url . "mediasearch=$mediasearch&amp;tnggallery=$tnggallery&amp;mediatypeID=$orgmediatypeID&amp;offset", $maxsearchresults, $max_browsemedia_pages );
$preheader = doMediaSearch( 1, $pagenav );
$preheader .= "<br />\n";

if( $tnggallery ) {
	$preheader .= "<div class=\"titlebox\">\n";
	$firstrow = 1;
	$tablewidth = "";
	$header = "";
}
else {
	$header = "<thead><tr><th data-tablesaw-priority=\"persist\" class=\"fieldnameback fieldname nbrcol\">&nbsp;#&nbsp;</td>\n";
	$header .= "<th data-tablesaw-priority=\"1\" class=\"fieldnameback fieldname center\" width=\"$thumbmaxw\">&nbsp;{$text['thumb']}&nbsp;</th>\n";
	$width = $mediatypeID == "headstones" ? "50%" : "75%";
	$header .= "<th data-tablesaw-priority=\"1\" class=\"fieldnameback fieldname\">&nbsp;{$text['description']}&nbsp;</th>\n";
	if( $mediatypeID == "headstones" ) {
		$header .= "<th data-tablesaw-priority=\"2\" class=\"fieldnameback fieldname\">&nbsp;{$text['cemetery']}&nbsp;</th>\n";
		$header .= "<th data-tablesaw-priority=\"3\" class=\"fieldnameback fieldname\">&nbsp;{$text['status']}&nbsp;</th>\n";
	}
	else {
		$header .= "<th data-tablesaw-priority=\"3\" class=\"fieldnameback fieldname\">&nbsp;{$text['info']}&nbsp;</th>\n";
	}
	$header .= "<th data-tablesaw-priority=\"3\" class=\"fieldnameback fieldname\" style=\"min-width:240px\">&nbsp;{$text['indlinked']}&nbsp;</th>\n";
	$header .= "</tr></thead>\n";
	$tablewidth = " style=\"width:100%\"";
}

$headerr = $enableminimap ? " data-tablesaw-minimap" : "";
$headerr .= $enablemodeswitch ? " data-tablesaw-mode-switch" : "";

if($tabletype) {
	if($tabletype == "toggle") $tabletype = "columntoggle";
	$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" $tablewidth class=\"tablesaw whiteback thfixed normal\" data-tablesaw-mode=\"$tabletype\"{$headerr}>\n" . $header;
} else {
	$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" $tablewidth class=\"whiteback thfixed normal\">\n" . $header;
}

$i = $offsetplus;
$maxplus = $maxsearchresults + 1;
$mediatext = "";
$firsthref = "";
$thumbcount = 0;
$gotImageJpeg = function_exists('imageJpeg');
while( $row = tng_fetch_assoc( $result ) ) {
	$mediatypeID = $row['mediatypeID'];
	$usefolder = $row['usecollfolder'] ? $mediatypes_assoc[$mediatypeID] : $mediapath;

	$status = $row['status'];
	if($status && $text[$status]) $row['status'] = $text[$status];

	$query = "SELECT $medialinks_table.mediaID, $medialinks_table.personID as personID, people.personID as personID2, people.living as living, people.private as private, people.branch as branch, $medialinks_table.eventID, $families_table.branch as fbranch,
		$families_table.living as fliving, $families_table.private as fprivate, familyID, husband, wife, people.lastname as lastname, people.lnprefix as lnprefix, people.firstname as firstname, people.prefix as prefix, people.suffix as suffix, nameorder, people.title as title,
		$medialinks_table.gedcom, $sources_table.title as stitle, $sources_table.sourceID, $repositories_table.repoID, reponame, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr, burialdate, linktype
		FROM $medialinks_table
		LEFT JOIN $people_table AS people ON $medialinks_table.personID = people.personID AND $medialinks_table.gedcom = people.gedcom
		LEFT JOIN $families_table ON $medialinks_table.personID = $families_table.familyID AND $medialinks_table.gedcom = $families_table.gedcom
		LEFT JOIN $sources_table ON $medialinks_table.personID = $sources_table.sourceID AND $medialinks_table.gedcom = $sources_table.gedcom
		LEFT JOIN $repositories_table ON ($medialinks_table.personID = $repositories_table.repoID AND $medialinks_table.gedcom = $repositories_table.gedcom)
		WHERE mediaID = \"{$row['mediaID']}\"$wherestr2 ORDER BY lastname, lnprefix, firstname, personID LIMIT $maxplus";
	$presult = tng_query($query);
	$numrows = tng_num_rows( $presult );
	$medialinktext = "";
	$foundliving = 0;
	$foundprivate = $row['private'] && !$allow_private; //if the image is flagged as private, it starts off that way
	$count = 0;
	$citelinks = array();
	while( $prow = tng_fetch_assoc( $presult ) ) {
		if( $prow['fbranch'] != NULL ) $prow['branch'] = $prow['fbranch'];
		if( $prow['fliving'] != NULL ) $prow['living'] = $prow['fliving'];
		if( $prow['fprivate'] != NULL ) $prow['private'] = $prow['fprivate'];
		//if living still null, must be a source
		if( $prow['living'] == NULL && $prow['private'] == NULL && $prow['linktype'] == 'I') {
			$query = "SELECT count(personID) as ccount FROM $citations_table, $people_table
				WHERE $citations_table.sourceID = '{$prow['personID']}' AND $citations_table.persfamID = $people_table.personID AND $citations_table.gedcom = $people_table.gedcom
				AND (living = '1' OR private = '1')";
			$presult2 = tng_query($query);
			if($presult2) {
				$prow2 = tng_fetch_assoc( $presult2 );
				if( $prow2['ccount'] ) $prow['living'] = 1;
				tng_free_result( $presult2 );
			}
		}
		if( $prow['living'] == NULL && $prow['private'] == NULL && $prow['linktype'] == 'F') {
			$query = "SELECT count(familyID) as ccount FROM $citations_table, $families_table
				WHERE $citations_table.sourceID = '{$prow['personID']}' AND $citations_table.persfamID = $families_table.familyID AND $citations_table.gedcom = $families_table.gedcom
				AND living = '1'";
			$presult2 = tng_query($query);
			if($presult2) {
				$prow2 = tng_fetch_assoc( $presult2 );
				if( $prow2['ccount'] ) $prow['living'] = 1;
				tng_free_result( $presult2 );
			}
		}

		$rights = determineLivingPrivateRights($prow);
		$prow['allow_living'] = $rights['living'];
		$prow['allow_private'] = $rights['private'];
			
		if(!$rights['living'])
			$foundliving = 1;
		if(!$rights['private'])
			$foundprivate = 1;

		if( !$tnggallery ) {
			$hstext = "";
			if( $prow['personID2'] != NULL ) {
				$medialinktext .= "<li><a href=\"$getperson_url" . "personID={$prow['personID2']}&amp;tree={$prow['gedcom']}\">";
				$medialinktext .= getName( $prow );
				if( $orgmediatypeID == "headstones" ) {
					$deathdate = $prow['deathdate'] ? $prow['deathdate'] : $prow['burialdate'];
					if( $prow['deathdate'] ) $abbrev = $text['deathabbr'];
					elseif( $prow['burialdate'] ) $abbrev = $text['burialabbr'];
					$hstext = $deathdate ? " ($abbrev " . displayDate( $deathdate ) . ")" : "";
				}
			}
			elseif( $prow['sourceID'] != NULL ) {
				$sourcetext = $prow['stitle'] ? $text['source'] . ": " . $prow['stitle'] : $text['source'] . ": " . $prow['sourceID'];
				$medialinktext .= "<li><a href=\"$showsource_url" . "sourceID={$prow['personID']}&amp;tree={$prow['gedcom']}\">$sourcetext\n";
			}
			elseif( $prow['repoID'] != NULL ) {
				$repotext = $prow['reponame'] ? $text['repository'] . ": " . $prow['reponame'] : $text['repository'] . ": " . $prow['repoID'];
				$medialinktext .= "<li><a href=\"$showrepo_url" . "repoID={$prow['personID']}&amp;tree={$prow['gedcom']}\">$repotext";
			}
			elseif( $prow['familyID'] != NULL )
				$medialinktext .= "<li><a href=\"$familygroup_url" . "familyID={$prow['personID']}&amp;tree={$prow['gedcom']}\">{$text['family']}: " . getFamilyName( $prow );
			elseif( !$prow['linktype'] || $prow['linktype'] == "C") {
				$query = "SELECT persfamID, sourceID, gedcom from $citations_table WHERE citationID = \"{$prow['personID']}\"";
				$cresult = tng_query($query);
				if($cresult) {
					$crow = tng_fetch_assoc($cresult);
					if($crow) {
						$persfamID = $crow['persfamID'];
						if(!in_array($persfamID, $citelinks)) {
							$citelinks[] = $persfamID;
							if(substr($persfamID,0,1) == $tngconfig['personprefix'] || substr($persfamID,-1) == $tngconfig['personsuffix']) {
								$medialinktext .= "<li><a href=\"$getperson_url" . "personID=$persfamID&amp;tree={$crow['gedcom']}\">";
								$presult2 = getPersonSimple($prow['gedcom'],$persfamID);
								if($presult2) {
									$cprow = tng_fetch_assoc($presult2);
									$cprights = determineLivingPrivateRights($cprow);
									$cprow['allow_living'] = $cprights['living'];
									$cprow['allow_private'] = $cprights['private'];
									$medialinktext .= getName( $cprow );
									tng_free_result($presult2);
								}
							}
							elseif(substr($persfamID,0,1) == $tngconfig['familyprefix'] || substr($persfamID,-1) == $tngconfig['familysuffix']) {
								$presult2 = getFamilyData($prow['gedcom'],$persfamID);
								if($presult2) {
									$famrow = tng_fetch_assoc($presult2);
									$familyname = getFamilyName($famrow);
									$medialinktext .= "<li><a href=\"$familygroup_url" . "familyID=$persfamID&amp;tree={$crow['gedcom']}\">{$text['family']}: $familyname";
									tng_free_result($presult2);
								}
							}
						}
					}
					tng_free_result($cresult);
				}
			}
			else {
				$treestr = $tngconfig['places1tree'] ? "" : "&amp;tree={$prow['gedcom']}";
				$medialinktext .= "<li><a href=\"$placesearch_url" . "psearch={$prow['personID']}$treestr\">" . $prow['personID'];
			}
			if($prow['eventID']) {
				$query = "SELECT display from $events_table, $eventtypes_table WHERE eventID = \"{$prow['eventID']}\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID";
				$eresult = tng_query($query);
				$erow = tng_fetch_assoc($eresult);
				$event = !empty($erow['display']) && is_numeric($prow['eventID']) ? getEventDisplay( $erow['display'] ) : (!empty($admtext[$prow['eventID']]) ? $admtext[$prow['eventID']] : $prow['eventID']);
				tng_free_result($eresult);
				$medialinktext .= " ($event)";
			}
			if($medialinktext) $medialinktext .= "</a>$hstext\n</li>\n";
		}
		$count++;
	}

	$row['allow_living'] = !$foundliving || $row['alwayson'];
	$row['allow_private'] = !$foundprivate || $row['alwayson'];
	$showPhotoInfo = $row['allow_living'] && $row['allow_private'];

		//if extension is in "showdirect" then link = folder (depends on usecollfolder) + / + path
	//else showmedia
	tng_free_result( $presult );
	if($medialinktext) $medialinktext = "<ul>$medialinktext</ul>\n";

	$row['all'] = $orgmediatypeID ? 0 : 1;
	$uselink = getMediaHREF($row,0);

	if( $numrows == $maxplus )
		$medialinktext .= "\n['<a href=\"$showmedia_url" . "mediaID={$row['mediaID']}&amp;ioffset=$maxsearchresults\">{$text['morelinks']}</a>']";

	//if(!$noneliving)
		//$row['description'] = $text['livingphoto'];
	$imgsrc = getSmallPhoto($row);
	if( $showPhotoInfo ) {
		$href = $uselink;
	}
	else
		$href = "";
	if($href && strpos($href,"showmedia.php") !== false && !$firsthref)
		$firsthref = $href;
	$notes = nl2br( truncateIt(getXrefNotes($row['notes'],$row['gedcom']),$tngconfig['maxnoteprev']) );
	if( $row['allow_living'] && $row['allow_private'] ) {
		$description = $showPhotoInfo ? "<a href=\"$href\" class=\"media-title\">{$row['description']}</a>" : "<span class=\"media-title\">{$row['description']}</span>";
	}
	else {
		$nonamesloc = $row['private'] ? $tngconfig['nnpriv'] : $nonames;
		if($nonamesloc) {
			$description = $text['livingphoto'];
			$notes = "";
		}
		else {
			$description = $row['description'];
			$notes = $notes ? $notes . "<br />({$text['livingphoto']})" : "({$text['livingphoto']})";
		}
	}

	if( $row['status'] && ($orgmediatypeID != "headstones") ) $notes = $text['status'] . ": " . $row['status'] . "; " . $notes;

	if( $tnggallery ) {
		if( $imgsrc ) {
			$mediatext .= "<div class=\"databack gallery\" align=\"center\">";
			$mediatext .= $href ? "<a href=\"$href\">$imgsrc</a>\n" : "$imgsrc\n";
			$mediatext .= "</div>";
			$i++;
		}
	}
	else {
		$mediatext .= "<tr class=\"media-row\"><td valign=\"top\" class=\"databack\">$i</td>";
		if($imgsrc) {
			$mediatext .= "<td valign=\"top\" class=\"databack\" align=\"center\">";
			$mediatext .= "<div class=\"media-img\" id=\"mi{$row['mediaID']}\"><div class=\"media-prev\" id=\"prev{$row['mediaID']}\" style=\"display:none\"></div></div>\n";
			if($href && $row['allow_living'] && $row['allow_private']) {
				$mediatext .= "<a href=\"$href\"";
				$treestr2 = $tngconfig['mediatrees'] && $row['gedcom'] ? $row['gedcom'] . "/" : "";
				if( $gotImageJpeg && isPhoto($row) && checkMediaFileSize("$rootpath$usefolder/$treestr2{$row['path']}"))
					$mediatext .=  " class=\"media-preview\" id=\"img-{$row['mediaID']}-0-" . urlencode("$usefolder/$treestr2{$row['path']}") . "\"";
				$mediatext .= ">$imgsrc</a>";
			}
			else
				$mediatext .= $imgsrc;
			$mediatext .= "</td><td valign=\"top\" class=\"databack\" style=\"position:relative\">";
			$thumbcount++;
		}
		else 
			$mediatext .= "<td valign=\"top\" class=\"databack\" align=\"center\" style=\"position:relative\">&nbsp;</td><td valign=\"top\" class=\"databack\">";

		$mediatext .= "$description<br/>$notes\n";
		if( $allow_admin && $allow_media_edit )
			$mediatext .= "<div class=\"media-edit\"><a href=\"admin_editmedia.php?mediaID={$row['mediaID']}&amp;cw=1\" target=\"blank\"><img src=\"img/tng_edit2.gif\"/></a></div></div></td>";
		if($orgmediatypeID == "headstones") {
			if(!$row['cemname']) $row['cemname'] = $row['city'];
			$plotstr = $row['plot'] ? "<br />" . nl2br($row['plot']) : "";
			$mediatext .= "<td valign=\"top\" class=\"databack\"><a href=\"$showmap_url" . "cemeteryID={$row['cemeteryID']}\">{$row['cemname']}</a>$plotstr&nbsp;<br/>\n";
			if(!empty($row['mlat']) || !empty($row['mlong'])) $mediatext .= "{$row['mlat']}, {$row['mlong']}<br/>\n";
			$mediatext .= "</td>";
			$mediatext .= "<td valign=\"top\" class=\"databack nw\">{$row['status']}&nbsp;</td>";
			$mediatext .= "<td valign=\"top\" class=\"databack\">\n";
		}
		else {
			$mediatext .= "<td valign=\"top\" class=\"databack\" style=\"width:250px\">\n";
			if(!empty($row['owner'])) $mediatext .= "{$text['photoowner']}: {$row['owner']}<br/>\n";
			if(!empty($row['datetaken'])) $mediatext .= "{$text['date']}: {$row['datetaken']}<br/>\n";
			if(!empty($row['placetaken'])) $mediatext .= "{$text['place']}: {$row['placetaken']}<br/>\n";
			if(!empty($row['mlat']) || !empty($row['mlong'])) $mediatext .= "{$row['mlat']}, {$row['mlong']}<br/>\n";
			$mediatext .= "</td>\n";
			$mediatext .= "<td valign=\"top\" class=\"databack\" style=\"width:175px\">\n";
		}
		$mediatext .= $medialinktext;
		$mediatext .= "&nbsp;</td></tr>\n";
		$i++;
	}
}
tng_free_result($result);
if( !$tnggallery ) {
	if( !$thumbcount ) {
		$header = str_replace( "<td class=\"fieldnameback fieldname\">&nbsp;<strong>{$text['thumb']}</strong>&nbsp;</td>", "", $header );
		$mediatext = str_replace( "<td valign=\"top\" class=\"databack\" align=\"center\">&nbsp;</td><td valign=\"top\" class=\"databack\">", "<td valign=\"top\" class=\"databack\">", $mediatext );
	}
}

if(!$tngconfig['ssdisabled'] && $firsthref && $totrows > 1) {
	$ss = strpos($firsthref, "?") ? "&amp;ss=1" : "?ss=1";
	$toplinks .= " &nbsp;&nbsp; <a href=\"$firsthref$ss\" class=\"snlink\">&raquo; {$text['slidestart']}</a>";
}
$toplinks .= "</p>";
//print out the whole shootin' match right here, eh
echo $toplinks . $preheader . $header . $mediatext;
echo "</table>\n";

if($tnggallery)
	echo "</div>\n";

echo "<br/>\n";

if( $totrows && ($pagenav || $mediasearch) ) {
	echo doMediaSearch( 2, $pagenav );
	echo "<br />";
}
?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('.media-row').on('mouseover',function(e) {
			jQuery(this).find('.media-edit').show();
		});
		jQuery('.media-row').on('mouseout',function(e) {
			jQuery(this).find('.media-edit').hide();
		});
	});
</script>
<?php
tng_footer($flags);
?>