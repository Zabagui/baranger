<?php
$textpart = "showphoto";
include("tng_begin.php");

include($cms['tngpath'] . "functions.php");

require_once("albumlib.php");

$showalbum_url = getURL( "showalbum", 1 );
$getperson_url = getURL( "getperson", 1 );
$showmedia_url = getURL( "showmedia", 1 );
$familygroup_url = getURL( "familygroup", 1 );
$showsource_url = getURL( "showsource", 1 );
$showrepo_url = getURL( "showrepo", 1 );
$placesearch_url = getURL( "placesearch", 1 );

$albumID = preg_replace("/[^0-9]/", '', $albumID);

$flags['imgprev'] = true;

$noneliving = $noneprivate = 1;
function getAlbumLinkText($albumID) {
	global $noneliving, $noneprivate, $text, $album2entities_table, $people_table, $families_table, $sources_table, $repositories_table, $events_table, $eventtypes_table, $wherestr2, $maxsearchresults;
	global $assignedtree, $showalbum_url, $showrepo_url, $showsource_url, $getperson_url, $familygroup_url, $placesearch_url, $tngconfig;

	$links = "";

	if( !empty($ioffset) ) {
		$ioffsetstr = "$ioffset, ";
		$newioffset = $ioffset + 1;
	}
	else {
		$ioffsetstr = "";
		$newioffset = 0;
	}
	$query = "SELECT $album2entities_table.alinkID, $album2entities_table.entityID as personID, people.living as living, people.private as private, people.branch as branch, $album2entities_table.eventID,
		$album2entities_table.linktype, people.title, people.birthdate, people.birthdatetr, people.altbirthdate, people.altbirthdatetr, people.deathdate, people.deathdatetr, husbpeople.title as htitle, wifepeople.title as wtitle,
		$families_table.branch as fbranch, $families_table.living as fliving, $families_table.private as fprivate, people.lastname as lastname, people.lnprefix as lnprefix, people.firstname as firstname, people.prefix as prefix, people.suffix as suffix, people.nameorder, $album2entities_table.gedcom,
		familyID, people.personID as personID2, wifepeople.personID as wife, wifepeople.firstname as wfirstname, wifepeople.lnprefix as wlnprefix, wifepeople.lastname as wlastname,
		wifepeople.prefix as wprefix, wifepeople.suffix as wsuffix, husbpeople.personID as husband, husbpeople.firstname as hfirstname, husbpeople.lnprefix as hlnprefix, husbpeople.lastname as hlastname,
		husbpeople.prefix as hprefix, husbpeople.suffix as hsuffix, $sources_table.title as stitle, $sources_table.sourceID, $repositories_table.repoID, reponame
		FROM $album2entities_table
		LEFT JOIN $people_table AS people ON $album2entities_table.entityID = people.personID AND $album2entities_table.gedcom = people.gedcom
		LEFT JOIN $families_table ON $album2entities_table.entityID = $families_table.familyID AND $album2entities_table.gedcom = $families_table.gedcom
		LEFT JOIN $people_table AS husbpeople ON $families_table.husband = husbpeople.personID AND $families_table.gedcom = husbpeople.gedcom
		LEFT JOIN $people_table AS wifepeople ON $families_table.wife = wifepeople.personID AND $families_table.gedcom = wifepeople.gedcom
		LEFT JOIN $sources_table ON $album2entities_table.entityID = $sources_table.sourceID AND $album2entities_table.gedcom = $sources_table.gedcom
		LEFT JOIN $repositories_table ON ($album2entities_table.entityID = $repositories_table.repoID AND $album2entities_table.gedcom = $repositories_table.gedcom)
		WHERE albumID = \"$albumID\"$wherestr2 ORDER BY people.lastname, people.lnprefix, people.firstname, hlastname, hlnprefix, hfirstname  LIMIT $ioffsetstr" . ($maxsearchresults + 1);
	$presult = tng_query($query);
	$numrows = tng_num_rows( $presult );
	$medialinktext = "";
	$count = 0;
	while( $count < $maxsearchresults && $prow = tng_fetch_assoc( $presult ) )
	{
		if( $prow['linktype'] == "F" ) {
			$prow['branch'] = $prow['fbranch'];
			$prow['living'] = $prow['fliving'];
			$prow['private'] = $prow['fprivate'];
			unset($prow['personID']);
		}
		if( $links ) $links .= ", ";

		$prights = determineLivingPrivateRights($prow);
		$prow['allow_living'] = $prights['living'];
		$prow['allow_private'] = $prights['private'];

		if(!$prights['both']) {
			if($prow['private']) $noneprivate = 0;
			if($prow['living']) $noneliving = 0;
		}

		if( $prow['personID2'] != NULL ) {
			$links .= "<a href=\"$getperson_url" . "personID={$prow['personID2']}&amp;tree={$prow['gedcom']}\">";
			$links .= getName( $prow ) . "</a>";
		}
		elseif( $prow['sourceID'] != NULL ) {
			$sourcetext = $prow['stitle'] ? $prow['stitle'] : "{$text['source']}: {$prow['sourceID']}";
			$links .= "<a href=\"$showsource_url" . "sourceID={$prow['sourceID']}&amp;tree={$prow['gedcom']}\">" . $sourcetext . "</a>";
		}
		elseif( $prow['repoID'] != NULL ) {
			$repotext = $prow['reponame'] ? $prow['reponame'] : "{$text['repository']}: {$prow['repoID']}";
			$links .= "<a href=\"$showrepo_url" . "repoID={$prow['repoID']}&amp;tree={$prow['gedcom']}\">" . $repotext . "</a>";
		}
		elseif( $prow['familyID'] != NULL ) {
			$familyname = trim("{$prow['hlnprefix']} {$prow['hlastname']}") . "/" . trim("{$prow['wlnprefix']} {$prow['wlastname']}") . " ({$prow['familyID']})";
			$links .= "<a href=\"$familygroup_url" . "familyID={$prow['familyID']}&amp;tree={$prow['gedcom']}\">{$text['family']}: $familyname</a>";
		}
		else {
			$treestr = $tngconfig['places1tree'] ? "" : "&amp;tree={$prow['gedcom']}";
			$links .= "<a href=\"$placesearch_url" . "psearch={$prow['personID']}$treestr\">" . $prow['personID'] . "</a>";
		}
		if($prow['eventID']) {
			$query = "SELECT display, tag from $events_table, $eventtypes_table WHERE eventID = \"{$prow['eventID']}\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID";
			$eresult = tng_query($query);;
			$erow = tng_fetch_assoc($eresult);
			$event = $erow['display'] ? getEventDisplay($erow['display']) : $prow['tag'];
			tng_free_result($eresult);
			$links .= " ($event)";
		}
		$count++;
	}
	tng_free_result( $presult );
	if( $numrows > $maxsearchresults )
		$links .= "\n[<a href=\"$showalbum_url" . "albumID=$albumID&amp;ioffset=" . ($newioffset + $maxsearchresults) . "\">{$text['morelinks']}</a>]";

	return $links;
}

$albumlinktext = getAlbumLinkText($albumID);
if($albumlinktext) {
	$altext = $albumlinktext;
	$albumlinktext = "<table cellpadding=\"4\" cellspacing=\"1\" border=\"0\" width=\"100%\" class=\"tfixed whiteback\">\n";
	$albumlinktext .= "<tr>\n";
	$albumlinktext .= "<td valign=\"top\" class=\"fieldnameback fieldname\" width=\"100\">{$text['indlinked']}</td>\n";
	$albumlinktext .= "<td class=\"databack\" width=\"90%\">$altext</td>\n";
	$albumlinktext .= "</tr>\n";
	$albumlinktext .= "</table>\n<br/>";
}

if(!$thumbmaxw) $thumbmaxw = 80;
if( !isset($tnggallery) ) $tnggallery = "";

if( $tnggallery ) {
	$maxsearchresults *= 2;
	if( !isset($wherestr) ) $wherestr = "";
	$wherestr .= " AND thumbpath != \"\"";
	$gallerymsg = "<a href=\"$showalbum_url" . "albumID=$albumID\" class=\"snlink\">&raquo; {$text['regphotos']}</a>&nbsp;";
}
else
	$gallerymsg = "<a href=\"$showalbum_url" . "albumID=$albumID&amp;tnggallery=1\" class=\"snlink\">&raquo; {$text['gallery']}</a>&nbsp;";

$_SESSION['tng_gallery'] = $tnggallery;

$max_browsemedia_pages = 5;
if( !isset($offset) ) $offset = 0;
if( $offset ) {
	$offsetplus = $offset + 1;
	$newoffset = "$offset, ";
}
else {
	$offsetplus = 1;
	$newoffset = 0;
	$page = 1;
}

$query = "SELECT albumname, description, active FROM $albums_table WHERE albumID = \"$albumID\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
if(!tng_num_rows($result) || (!$row['active'] && !$allow_admin)) {
	tng_free_result($result);
	header( "Location: thispagedoesnotexist.html" ); 
	exit;
}
$albumname = $row['albumname'];
$description = $row['description'];
tng_free_result( $result );

if(!$noneliving && !$noneprivate) {
	tng_header( $text['albums'] . ": " . $albumname, $flags );
	echo tng_DrawHeading( "", $text['albums'] . ": " . $albumname, $description );

	echo "<p>{$text['livingphoto']}</p>\n";

	tng_footer("");
	exit;
}

if( $tree ) {
	$wherestr = " AND ($media_table.gedcom = \"$tree\" || $media_table.gedcom = \"\")";
	$wherestr2 = " AND $medialinks_table.gedcom = \"$tree\"";
}
else
	$wherestr = $wherestr2 = "";

$query = "SELECT DISTINCT $media_table.mediaID, albumlinkID, $media_table.description, $media_table.notes, thumbpath, alwayson, usecollfolder, mediatypeID, path, form, abspath, newwindow, $media_table.gedcom, private
	FROM ($albumlinks_table, $media_table) LEFT JOIN $medialinks_table
	ON $media_table.mediaID = $medialinks_table.mediaID
	WHERE albumID = \"$albumID\" AND $albumlinks_table.mediaID = $media_table.mediaID $wherestr
	ORDER BY $albumlinks_table.ordernum, description LIMIT $newoffset" . $maxsearchresults;
$result = tng_query($query);
$numrows = tng_num_rows( $result );

if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
	$query = "SELECT count(distinct $media_table.mediaID) as mcount FROM ($albumlinks_table, $media_table) LEFT JOIN $medialinks_table
		ON $media_table.mediaID = $medialinks_table.mediaID WHERE albumID = \"$albumID\" AND $albumlinks_table.mediaID = $media_table.mediaID $wherestr";
	$result2 = tng_query($query);
	$row = tng_fetch_assoc( $result2 );
	tng_free_result($result2);
	$totrows = $row['mcount'];
}
else
	$totrows = $numrows;

$numrowsplus = $numrows + $offset;

$logstring = "<a href=\"$showalbum_url" . "albumID=$albumID\">$albumname</a>";
writelog($logstring);
preparebookmark($logstring);

tng_header( $text['albums'] . ": $albumname", $flags );

$imgsrc = getAlbumPhoto($albumID,$albumname);
if(!$imgsrc) {
?>
<h1 class="header"><span class="headericon" id="albums-hdr-icon"></span><?php echo $albumname; ?><br /><span class="normal"><?php echo $description; ?></span></h1><br clear="left"/>
<?php
}
else {
	echo tng_DrawHeading( $imgsrc, $albumname, $description );
}

$hiddenfields[0] = array('name' => 'albumID', 'value' => $albumID);
echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'showalbum', 'method' => 'get', 'name' => 'form1', 'id' => 'form1', 'hidden' => $hiddenfields));

$toplinks = "<p class=\"normal\">";
$toplinks .= $totrows ? "{$text['matches']} $offsetplus {$text['to']} $numrowsplus {$text['of']} $totrows &nbsp;&nbsp; " : "";
$toplinks .= $gallerymsg;
$toplinks .= $allow_admin && $allow_edit ? "<a href=\"{$cms['tngpath']}" . "admin_editalbum.php?albumID=$albumID&amp;cw=1\" target=\"blank\" class=\"snlink\">&raquo; {$text['editalbum']}</a> " : "";

$pagenav = get_browseitems_nav( $totrows, $showalbum_url . "albumID=$albumID&amp;tnggallery=$tnggallery&amp;offset", $maxsearchresults, $max_browsemedia_pages );
$preheader = $pagenav . "</p>\n";

if( $tnggallery ) {
	$preheader .= "<div class=\"titlebox\">\n";
	$firstrow = 1;
	$tablewidth = "";
	$header = "";
}
else {
	$header = "<tr><td class=\"fieldnameback\" style=\"width:15px\">&nbsp;</td>\n";
	$header .= "<td class=\"fieldnameback\" width=\"$thumbmaxw\"><span class=\"fieldname\">&nbsp;<strong>{$text['thumb']}</strong>&nbsp;</span></td>\n";
	$header .= "<td class=\"fieldnameback\" width=\"70%\"><span class=\"fieldname\">&nbsp;<strong>{$text['description']}</strong>&nbsp;</span></td>\n";
	$header .= "<td class=\"fieldnameback\"><span class=\"fieldname\">&nbsp;<strong>{$text['indlinked']}</strong>&nbsp;</span></td>\n";
	$header .= "</tr>\n";
	$tablewidth = " width=\"100%\"";
}

$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" $tablewidth class=\"tfixed whiteback normal\">\n" . $header;

$i = $offsetplus;
$maxplus = $maxsearchresults + 1;
$mediatext = "";
$firsthref = "";
$thumbcount = 0;
$gotImageJpeg = function_exists('imageJpeg');
while( $row = tng_fetch_assoc( $result ) ) {
	$mediatypeID = $row['mediatypeID'];
	$usefolder = $row['usecollfolder'] ? $mediatypes_assoc[$mediatypeID] : $mediapath;
	$query = "SELECT $medialinks_table.mediaID, $medialinks_table.personID as personID, people.personID as personID2, people.living as living, people.private, people.branch as branch, $families_table.branch as fbranch,
		$families_table.living as fliving, $families_table.private as fprivate, familyID, husband, wife, people.lastname as lastname, people.lnprefix as lnprefix, people.firstname as firstname, people.prefix as prefix, people.suffix as suffix, nameorder, people.title,
		$medialinks_table.gedcom, $sources_table.title as stitle, $sources_table.sourceID, $repositories_table.repoID, reponame, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr, burialdate, linktype
		FROM $medialinks_table
		LEFT JOIN $people_table AS people ON $medialinks_table.personID = people.personID AND $medialinks_table.gedcom = people.gedcom
		LEFT JOIN $families_table ON $medialinks_table.personID = $families_table.familyID AND $medialinks_table.gedcom = $families_table.gedcom
		LEFT JOIN $sources_table ON $medialinks_table.personID = $sources_table.sourceID AND $medialinks_table.gedcom = $sources_table.gedcom
		LEFT JOIN $repositories_table ON ($medialinks_table.personID = $repositories_table.repoID AND $medialinks_table.gedcom = $repositories_table.gedcom)
		WHERE mediaID = \"{$row['mediaID']}\" $wherestr2 ORDER BY lastname, lnprefix, firstname, personID LIMIT $maxplus";
	$presult = tng_query($query);
	$numrows = tng_num_rows( $presult );
	$medialinktext = "";
	$foundliving = 0;
	$foundprivate = $row['private'] && !$allow_private;
	$count = 0;
	while( $prow = tng_fetch_assoc( $presult ) )
	{
		if( $prow['fbranch'] != NULL ) $prow['branch'] = $prow['fbranch'];
		if( $prow['fliving'] != NULL ) $prow['living'] = $prow['fliving'];
		if( $prow['fprivate'] != NULL ) $prow['private'] = $prow['fprivate'];
		//if living still null, must be a source
		if( $prow['living'] == NULL && $prow['private'] == NULL && $prow['linktype'] == "I" ) {
			$query = "SELECT count(personID) as ccount FROM $citations_table, $people_table
				WHERE $citations_table.sourceID = '{$prow['personID']}' AND $citations_table.persfamID = $people_table.personID AND $citations_table.gedcom = $people_table.gedcom
				AND (living = '1' OR private = '1')";
			$presult2 = tng_query($query);
			$prow2 = tng_fetch_assoc( $presult2 );
			if( $prow2['ccount'] ) $prow['living'] = 1;
			tng_free_result( $presult2 );
		}
		if( $prow['living'] == NULL && $prow['private'] == NULL && $prow['linktype'] == "F" ) {
			$query = "SELECT count(familyID) as ccount FROM $citations_table, $families_table
				WHERE $citations_table.sourceID = '{$prow['personID']}' AND $citations_table.persfamID = $families_table.familyID AND $citations_table.gedcom = $families_table.gedcom
				AND living = '1'";
			$presult2 = tng_query($query);
			$prow2 = tng_fetch_assoc( $presult2 );
			if( $prow2['ccount'] ) $prow['living'] = 1;
			tng_free_result( $presult2 );
		}

		$prights = determineLivingPrivateRights($prow);
		$prow['allow_living'] = $prights['living'];
		$prow['allow_private'] = $prights['private'];

		if(!$prights['living'])
			$foundliving = 1;
		if(!$prights['private'])
			$foundprivate = 1;

		if( !$tnggallery ) {
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
			elseif( $prow['sourceID'] != NULL ) {
				$sourcetext = $prow['stitle'] ? $prow['stitle'] : $text['source'] . ": " . $prow['sourceID'];
				$medialinktext .= "<li><a href=\"$showsource_url" . "sourceID={$prow['sourceID']}&amp;tree={$prow['gedcom']}\">$sourcetext";
			}
			elseif( $prow['repoID'] != NULL ) {
				$repotext = $prow['reponame'] ? $prow['reponame'] : $text['repository'] . ": " . $prow['repoID'];
				$medialinktext .= "<li><a href=\"$showrepo_url" . "repoID={$prow['repoID']}&amp;tree={$prow['gedcom']}\">$repotext";
			}
			elseif( $prow['familyID'] != NULL )
				$medialinktext .= "<li><a href=\"$familygroup_url" . "familyID={$prow['personID']}&amp;tree={$prow['gedcom']}\">{$text['family']}: " . getFamilyName( $prow );
			else {
				$treestr = $tngconfig['places1tree'] ? "" : "&amp;tree={$prow['gedcom']}";
				$medialinktext .= "<li><a href=\"$placesearch_url" . "psearch={$prow['personID']}$treestr\">" . $prow['personID'];
			}
			$medialinktext .= "</a>$hstext\n</li>\n";
		}
		$count++;
	}
	tng_free_result( $presult );
	if($medialinktext) $medialinktext = "<ul>$medialinktext</ul>\n";

	if( $numrows == $maxplus )
		$medialinktext .= "\n['<a href=\"$showmedia_url" . "mediaID={$row['mediaID']}&amp;albumID=$albumID&amp;ioffset=$maxsearchresults\">{$text['morelinks']}</a>']";

	$uselink = getMediaHREF($row,2);
	if(!$noneliving && $row['alwayson']) $noneliving = 1;

	$row['allow_living'] = !$foundliving;
	$row['allow_private'] = !$foundprivate;
	$showAlbumInfo = $row['alwayson'] || (!$foundprivate && !$foundliving);
	$nonamesloc = $foundprivate ? $tngconfig['nnpriv'] : $nonames;

	$imgsrc = getSmallPhoto($row);
	if( $showAlbumInfo ) {
		$href = $uselink;
	}
	else
		$href = "";
	if($href && !$firsthref)
		$firsthref = $href;
		
	//$href = $showmedia_url . "mediaID=$row['mediaID']&amp;albumlinkID=$row['albumlinkID']";
	if( $row['allow_living'] || !$nonamesloc ) {
		$description = $showAlbumInfo ? "<a href=\"$href\" class=\"media-title\">{$row['description']}</a>" : "<span class=\"media-title\">{$row['description']}</span>";
		$notes = nl2br( truncateIt(getXrefNotes($row['notes']),$tngconfig['maxnoteprev']) );
		if( !$showAlbumInfo ) $notes .= "<br />({$text['livingphoto']})";
	}
	else {
		$description = "<span class=\"media-title\">{$text['living']}</span>";
		$notes = $text['livingphoto'];
	}
	if( !empty($row['status']) ) $notes = $text['status'] . ": " . $row['status'] . $notes;

	if(!$row['allow_living'])
		$row['description'] = $text['livingphoto'];

	if( $tnggallery ) {
		if( $imgsrc ) {
			$mediatext .= "<div class=\"databack gallery\" align=\"center\">";
			$mediatext .= $href ? "<a href=\"$href\">$imgsrc</a>\n" : "$imgsrc\n";
			$mediatext .= "</div>";
			$i++;
		}
	}
	else {
		$mediatext .= "<tr><td valign=\"top\" class=\"databack\"><span class=\"normal\">$i</span></td>";
		if($imgsrc) {
			$mediatext .= "<td valign=\"top\" class=\"databack\" align=\"center\">";
			$mediatext .= "<div class=\"media-img\"><div class=\"media-prev\" id=\"prev{$row['mediaID']}\" style=\"display:none\"></div></div>\n";
			if($href) {
				$mediatext .= "<a href=\"$href\"";
				$treestr = $tngconfig['mediatrees'] && $row['gedcom'] ? $row['gedcom'] . "/" : "";
				if( $gotImageJpeg && isPhoto($row) && checkMediaFileSize("$rootpath$usefolder/$treestr{$row['path']}") )
					$mediatext .= " class=\"media-preview\" id=\"img-{$row['mediaID']}-0-" . urlencode("$usefolder/$treestr{$row['path']}") . "\"";
				$mediatext .= ">$imgsrc</a>";
			}
			else
				$mediatext .= $imgsrc;
			$mediatext .= "</td><td valign=\"top\" class=\"databack\">";
			$thumbcount++;
		}
		else
			$mediatext .= "<td valign=\"top\" class=\"databack\" align=\"center\">&nbsp;</td><td valign=\"top\" class=\"databack\">";

		$mediatext .= "<span class=\"normal\">$description<br/>$notes&nbsp;</span></td>";
		$mediatext .= "<td valign=\"top\" class=\"databack\">\n";
		$mediatext .= $medialinktext;
		$mediatext .= "&nbsp;</td></tr>\n";
		$i++;
	}
}
tng_free_result($result);
if( $tnggallery ) {
	if( !$firstrow ) $mediatext .= "</tr>\n";
}
else {
	if( !$thumbcount ) {
		$header = str_replace( "<td class=\"fieldnameback\"><span class=\"fieldname\">&nbsp;<strong>{$text['thumb']}</strong>&nbsp;</span></td>", "", $header );
		$mediatext = str_replace( "<td valign=\"top\" class=\"databack\" align=\"center\">&nbsp;</td><td valign=\"top\" class=\"databack\">", "<td valign=\"top\" class=\"databack\">", $mediatext );
	}
}

if($firsthref && $sitever != "mobile" && !$tngconfig['ssdisabled'])
	$toplinks .= " &nbsp;&nbsp; <a href=\"$firsthref&amp;ss=1\" class=\"snlink\">&raquo; {$text['slidestart']}</a>";
$toplinks .= "</p>";
//print out the whole shootin' match right here, eh
echo $toplinks . $preheader . $header . $mediatext;
echo "</table>\n";

if($tnggallery) {
	echo "</div>\n";
}

echo "<br/>\n";
if( $pagenav ) {
	echo $pagenav;
	echo "<br />";
}
echo "<br />";
echo $albumlinktext;

tng_footer($flags);
?>