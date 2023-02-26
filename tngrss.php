<?php
$textpart = "whatsnew";

include("tng_begin.php");
if($requirelogin && !$_SESSION['currentuser']) {
	header("Location:$homepage");
	exit;
}

$langstr = isset($_GET['lang']) ? "&amp;lang=$languages_path" . $_GET['lang'] : "";

@ini_set( "session.bug_compat_warn", "0" );

include($cms['tngpath'] . "version.php");

$getperson_url = getURL( "getperson", 1 );
$showmedia_url = getURL( "showmedia", 1 );
$familygroup_url = getURL( "familygroup", 1 );

$date = date("r");
$timezone = date("O");

function doMedia( $mediatypeID ) {
	global $tngdomain, $langstr, $mediatypes_display, $timezone, $session_charset;

	global $media_table, $medialinks_table, $change_limit, $cutoffstr, $text, $families_table, $sources_table, $repositories_table, $citations_table, $nonames;
	global $people_table, $familygroup_url, $showsource_url, $showrepo_url, $placesearch_url, $showmedia_url, $trees_table, $assignedtree;
	global $rootpath, $photopath, $documentpath, $headstonepath, $historypath, $mediapath, $header, $footer, $cemeteries_table;
	global $getperson_url, $livedefault, $whatsnew, $wherestr, $wherestr2, $showmap_url, $thumbmaxw, $events_table, $eventtypes_table, $tngconfig;
	
	if( $mediatypeID == "headstones" ) {
		$hsfields = ", $media_table.cemeteryID, cemname";
		$hsjoin = "LEFT JOIN $cemeteries_table ON $media_table.cemeteryID = $cemeteries_table.cemeteryID";
	}
	else
		$hsfields = $hsjoin = "";
	if(empty($wherestr)) $wherestr = "";
	if(empty($wherestr2)) $wherestr2 = "";

	$query = "SELECT distinct $media_table.mediaID as mediaID, description, $media_table.notes, thumbpath, path, form, mediatypeID, $media_table.gedcom as gedcom, alwayson, usecollfolder, DATE_FORMAT(changedate,'%a, %d %b %Y %T') as changedatef, status, abspath, newwindow $hsfields
		FROM $media_table $hsjoin";
	$query .= " WHERE $cutoffstr $wherestr AND mediatypeID = \"$mediatypeID\" ORDER BY changedate DESC, description LIMIT $change_limit";
	$mediaresult = tng_query($query);

	while( $row = tng_fetch_assoc( $mediaresult ) ) {
		$query = "SELECT medialinkID, $medialinks_table.personID as personID, $medialinks_table.eventID, people.personID as personID2, familyID, people.living as living, people.private as private, people.branch as branch,
			$families_table.branch as fbranch, $families_table.living as fliving, $families_table.private as fprivate, husband, wife, people.lastname as lastname, people.lnprefix as lnprefix, people.firstname as firstname,
			people.suffix as suffix, nameorder, $medialinks_table.gedcom as gedcom, treename, $sources_table.title, $sources_table.sourceID, $repositories_table.repoID,reponame, deathdate, burialdate, linktype
			FROM ($medialinks_table, $trees_table)
			LEFT JOIN $people_table AS people ON ($medialinks_table.personID = people.personID AND $medialinks_table.gedcom = people.gedcom)
			LEFT JOIN $families_table ON ($medialinks_table.personID = $families_table.familyID AND $medialinks_table.gedcom = $families_table.gedcom)
			LEFT JOIN $sources_table ON ($medialinks_table.personID = $sources_table.sourceID AND $medialinks_table.gedcom = $sources_table.gedcom)
			LEFT JOIN $repositories_table ON ($medialinks_table.personID = $repositories_table.repoID AND $medialinks_table.gedcom = $repositories_table.gedcom)
			WHERE mediaID = \"{$row['mediaID']}\" AND $medialinks_table.gedcom = $trees_table.gedcom$wherestr2 ORDER BY lastname, lnprefix, firstname, $medialinks_table.personID";
		$presult = tng_query($query);
		$foundliving = 0;
		$foundprivate = 0;
		$hstext = "";
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

			$prow['allow_living'] = !$prow['living'] || $livedefault == 2;
			$prow['allow_private'] = !$prow['private'];

			if($prow['living'] && $livedefault != 2)
				$foundliving = 1;
			if($prow['private'])
				$foundprivate = 1;

			if( $prow['personID2'] != NULL ) {
				$medialink = $getperson_url . "personID={$prow['personID2']}&amp;tree={$prow['gedcom']}";
				$mediatext = getName( $prow );
				if( $mediatypeID == "headstones" ) {
					$deathdate = $prow['deathdate'] ? $prow['deathdate'] : $prow['burialdate'];
					if( $prow['deathdate'] ) $abbrev = $text['deathabbr'];
					elseif( $prow['burialdate'] ) $abbrev = $text['burialabbr'];
					$hstext = $deathdate ? " ($abbrev " . displayDate( $deathdate ) . ")" : "";
				}
			}
			elseif( $prow['familyID'] != NULL ) {
				$medialink = $familygroup_url . "familyID={$prow['familyID']}&amp;tree={$prow['gedcom']}";
				$mediatext = "{$text['family']}: " . getFamilyName( $prow );
			}
			elseif( $prow['sourceID'] != NULL ) {
				$mediatext = $prow['title'] ? "{$text['source']}: {$prow['title']}" : "{$text['source']}: {$prow['sourceID']}";
				$medialink = $showsource_url . "sourceID={$prow['sourceID']}&amp;tree={$prow['gedcom']}";
			}
			elseif( $prow['repoID'] != NULL ) {
				$mediatext = $prow['reponame'] ? $text['repository'] . ": " . $prow['reponame'] : $text['repository'] . ": " . $prow['repoID'];
				$medialink = $showrepo_url . "repoID={$prow['repoID']}&amp;tree={$prow['gedcom']}";
			}
			else {
				$medialink = $placesearch_url . "psearch={$prow['personID']}&amp;tree={$prow['gedcom']}";
				$mediatext = $prow['personID'];
			}
			if($prow['eventID']) {
				$query = "SELECT description from $events_table, $eventtypes_table WHERE eventID = \"{$prow['eventID']}\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID";
				$eresult = tng_query($query) or die ("{$text['cannotexecutequery']}: $query");
				$erow = tng_fetch_assoc($eresult);
				$event = $erow['description'] ? $erow['description'] : $prow['eventID'];
				tng_free_result($eresult);
				$mediatext .= " ($event)";
			}
		}
		tng_free_result( $presult );

		$href = getMediaHREF($row,0);
		$href = str_replace("\" target=\"_blank","",$href);  // fix the string in case someone might have used the "open in a new window" option on the media
		if( (!$foundliving && !$foundprivate) || !$nonames || $row['alwayson'] ) {
			$description = strip_tags($row['description']);
			$notes = nl2br( strip_tags(getXrefNotes($row['notes'],$row['gedcom'])) );
			if( ($foundliving || $foundprivate) && !$row['alwayson'] ) $notes .= " ({$text['livingphoto']})";
		}
		else {
			$description = $text['living'];
			$notes = "({$text['livingphoto']})";
		}

		//$description = strip_tags($description); // clean the text of HTML tags
		//$notes = strip_tags($notes);

		if( $row['status'] ) $notes = "{$text['status']}: {$row['status']}. $notes";

		$item  =  "\n<item>\n"; // build the $item string so that you can apply string functions more globally instead of piece meal, as required

		$typestr = $text[$mediatypeID] ? $text[$mediatypeID] : $mediatypes_display[$mediatypeID];
		$item .=  "<title>" . xmlcharacters($typestr) . ": " . xmlcharacters($description) . "</title>\n";
		$item .=  "<link>" . "<![CDATA[" . ($row['abspath'] ? "" : "$tngdomain/") . "$href$langstr" . "]]>" . "</link>\n"; // use CDATA to deal with odd links that include special characters

		if( $mediatypeID == "headstones" ) {
			$deathdate = $row['deathdate'] ? $row['deathdate'] : $row['burialdate'];
			$item .= "<description>" . xmlcharacters($hstext . " " . htmlspecialchars($notes,ENT_NOQUOTES, $session_charset) ) . "</description>\n";
			$item .= "<category>{$text['tree']}: " . xmlcharacters($trow['treename']) . "</category>\n";
		}
		else {
			$item .= "<description>" . xmlcharacters(htmlspecialchars($notes,ENT_NOQUOTES, $session_charset)) . "</description>\n";
			//$item .=  "<category></category>\n"; // the RSS validator recognises an empty tag as an error, commented it out
		}
		$changedate = date_format(date_create($row['changedatef']), "D, d M Y H:i:s");
		$item .=  "<pubDate>$changedate $timezone</pubDate>\n"; 

		$item .=   "<guid isPermaLink=\"false\">$tngdomain/{$row['mediaID']}-$changedate $timezone</guid>\n"; // using a guid improves the granularity of changes one ca monitor (ie: it allows for a changes minitus appart to be captures by the RSS feed)
		$item .=  "</item>\n";
    	echo $item;
	}
	tng_free_result($mediaresult);
}

header("Content-type: application/rss+xml; charset=\"$charset\"");

$item =  "<rss version=\"2.0\" xmlns:atom=\"{$http}://www.w3.org/2005/Atom\">\n";
$item .=  "<channel>\n";
$item .=  "<atom:link href=\"" . $tngdomain . "/tngrss.php\" rel=\"self\" type=\"application/rss+xml\" />\n";
if( !$cms['support'] )
    $tngscript = basename( $_SERVER['SCRIPT_NAME'], ".php" );
else
    $tngscript = $file;
$item .=  "<copyright>$tng_title, v.$tng_version ($tng_date), Written by Darrin Lythgoe, $tng_copyright</copyright>\n";
$item .=  "<lastBuildDate>$date</lastBuildDate>\n";

//you will need to define $site_desc and $sitename in your customconfig.php file
//as of 6.0, these will come from config.php, but anything defined in customconfig.php will take precedence
$item .= "<description>" . xmlcharacters($site_desc) . "</description>\n";
if(!empty($personID)) {
	$item .= "<title>" . trim($sitename . " " . $text['indinfo']) . ": $personID</title>\n";
}
elseif(!empty($familyID)) {
	$item .= "<title>" . trim($sitename . " " . $text['family']) . ": $familyID</title>\n";
}
else{
	$item .= "<title>$sitename</title>\n";
}
$item .= "<link>$tngdomain</link>\n";
$item .= "<managingEditor>$emailaddr ($dbowner)</managingEditor>\n";
$item .= "<webMaster>$emailaddr ($dbowner)</webMaster>\n";
if(!empty($rssimage)) {                            // define $rssimage in your customconfig.php file this will allow you to put a logo on your feed once you have subscribed
	$item .= "<image>\n";
	$item .= "<url>" . $tngdomain . $rssimage . "</url>\n";     // path for the logo
	if($personID) {
		$item .= "<title>" . trim($sitename . " " . $text['indinfo']) . ": $personID</title>\n";  // images require a title (match it with either the personID)
	}
	elseif($familyID) {
		$item .= "<title>" . trim($sitename . " " . $text['family']) . ": $familyID</title>\n";    // the familyID
	}
	else{
		$item .= "<title>$sitename</title>\n";                      // or just the site name
	}
	$item .= "<link>" . $tngdomain . "</link>\n";                  // images also require the site link so that if you click on the image you go to the site
	$item .= "</image>\n";
}
echo $item;

//you will need to define $rsslang in your customconfig.php file before you can use this
//echo "<language>$rsslang</language>\n";

$text['pastxdays'] = preg_replace( "/xx/", "$change_cutoff", $text['pastxdays'] );
if( !$change_cutoff ) $change_cutoff = 0;
if( !$change_limit ) $change_limit = 10;
$cutoffstr = $change_cutoff ? "TO_DAYS(NOW()) - TO_DAYS(changedate) <= $change_cutoff" : "1=1";

if(empty($personID) && empty($familyID)) {             // only feed the changes when not monitoring an person or a family
	initMediaTypes();
	foreach( $mediatypes as $mediatype ) {
		$mediatypeID = $mediatype['ID'];
		echo doMedia( $mediatypeID );
	}
}
$cutoffstr .= " AND";

if( $tree )
	$allwhere = "AND p.gedcom = \"$tree\"";
else
	$allwhere = "";

$more = getLivingPrivateRestrictions("p", false, false);
if($more)
	$allwhere .= " AND " .$more;

if(empty($familyID)) {    // if a family is NOT specified (ie: we are looking for a personID or the What's New
//select from people where date later than cutoff, order by changedate descending, limit = 10
$query = "SELECT p.personID, lastname, lnprefix, firstname, birthdate, prefix, suffix, nameorder, living, private, branch, DATE_FORMAT(changedate,'%e %b %Y') as changedatef, changedby, LPAD(SUBSTRING_INDEX(birthdate, ' ', -1),4,'0') as birthyear, birthplace, altbirthdate, LPAD(SUBSTRING_INDEX(altbirthdate, ' ', -1),4,'0') as altbirthyear, altbirthplace, p.gedcom as gedcom, treename
	FROM $people_table as p, $trees_table WHERE $cutoffstr p.gedcom = $trees_table.gedcom $allwhere
	ORDER BY changedate DESC, lastname, firstname, birthyear, altbirthyear LIMIT $change_limit";
	$result = tng_query($query);
	$numrows = tng_num_rows( $result );
	if( $numrows ) {
		while( $row = tng_fetch_assoc($result))
		{
			$rights = determineLivingPrivateRights($row);
			$row['allow_living'] = $rights['living'];
			$row['allow_private'] = $rights['private'];
			$namestr = getNameRev( $row );
			$birthplacestr = "";
			if( $rights['both'] ) {
				if ( $row['birthdate'] ) {
					$birthdate = $text['birthabbr'] . " " . displayDate( $row['birthdate'] );
					$birthplace = $row['birthplace'];
				}
				else if ( $row['altbirthdate'] ) {
					$birthdate = $text['chrabbr'] . " " . displayDate( $row['altbirthdate'] );
					$birthplace = $row['altbirthplace'];
				}
				else {
					$birthdate = "";
					$birthplace = "";
				}
			}
			else
				$birthdate = $birthplace = "";

			$query = "SELECT gedcom, treename FROM $trees_table WHERE gedcom = \"{$row['gedcom']}\"";
			$treeresult = tng_query($query);
			$treerow = tng_fetch_assoc( $treeresult );

			$item  =  "\n<item>\n";
			$item .= "<title>";
			$item .= xmlcharacters($text['indinfo'] . ": " . $namestr . " (" . $row['personID'] . ")");
			$item .= "</title>\n";
			$item .= "<link>" . "$tngdomain/$getperson_url" . "personID=" . $row['personID'] . "&amp;tree=" . $row['gedcom'] . $langstr . "</link>\n";
			$item .= "<description>";
			if( $birthdate || $birthplace )
				$item .= xmlcharacters("$birthdate, $birthplace") . "</description>\n";
			else
				$item .= xmlcharacters($text['birthabbr']) . "</description>\n";
			$item .=   "<category>{$text['tree']}: " . xmlcharacters($treerow['treename']) . "</category>\n";
			$changedate = date_format(date_create($row['changedatef']), "D, d M Y H:i:s");
			$item .=   "<pubDate>$changedate $timezone </pubDate>\n";
			//$item .=   "<guid isPermaLink=\"false\">>$tngdomain/$row[personID]-".date_format(date_create($row[changedatef]), DATE_ATOM)."</guid>\n";

			$item .=   "</item>\n";
			echo $item;
		}
		tng_free_result($result);
	}
}

//$allwhere = " AND $people_table.gedcom = $families_table.gedcom";
if(!empty($familyID)) {
	$whereclause = "WHERE $families_table.familyID = \"$familyID\" ORDER BY changedate LIMIT $change_limit";
}
else {
	$whereclause = $change_cutoff ? "WHERE TO_DAYS(NOW()) - TO_DAYS($families_table.changedate) <= $change_cutoff" : "WHERE 1=1";
	$whereclause .= " ORDER BY changedate DESC LIMIT $change_limit";
}

if (empty($personID)) {
//select husband, wife from families where date later than cutoff, order by changedate descending, limit = 10
	$query = "SELECT familyID, husband, wife, marrdate, marrplace, gedcom, branch, living, private, DATE_FORMAT(changedate,'%a, %d %b %Y %T') as changedatef FROM $families_table $whereclause";
	//$query = "SELECT familyID, husband, wife, marrdate, marrplace, $families_table.gedcom as gedcom, firstname, lnprefix, lastname, suffix, nameorder, $families_table.branch as fbranch, $people_table.branch as branch, $families_table.living as fliving, $families_table.private as fprivate, $people_table.living as living, $people_table.private as private, DATE_FORMAT($families_table.changedate,'%a, %d %b %Y %T') as changedatef FROM $families_table, $people_table $whereclause";
	$famresult = tng_query($query);
	$numrows = tng_num_rows( $famresult );
	if( $numrows ) {
		while( $row = tng_fetch_assoc($famresult))
		{
			$row['allow_living'] = $nonames == 2 && $row['living'] ? 0 : 1;
			$row['allow_private'] = $tngconfig['nnpriv'] == 2 && $row['private'] ? 0 : 1;
			$query = "SELECT gedcom, treename FROM $trees_table WHERE gedcom = \"{$row['gedcom']}\"";
			$treeresult = tng_query($query);
			$treerow = tng_fetch_assoc( $treeresult );

			$item  =  "\n<item>\n";
			$item .=  "<title>" . xmlcharacters($text['family'] . ": " . getFamilyName( $row )) . "</title>\n";
			$item .= "<link>" . "$tngdomain/$familygroup_url" . "familyID={$row['familyID']}&amp;tree={$row['gedcom']}$langstr" . "</link>\n";
			$item .= "<description>";

			$item .= displayDate( $row['marrdate'] );
			if($row['marrdate'] && $row['marrplace']) $item .= ", ";
			$item .= xmlcharacters($row['marrplace']);

			$item .= "</description>\n";
			$item .= "<category>{$text['tree']}: " . xmlcharacters($treerow['treename']) . "</category>\n";
			$item .= "<pubDate>" . displayDate( $row['changedatef'] ) . " $timezone </pubDate>\n";
			//$item .= "<guid isPermaLink=\"false\">$tngdomain/$row[familyID]-".date_format(date_create($row[changedatef]), DATE_ATOM)."</guid>\n";

			$item .= "</item>\n";
			echo $item;
		 }
		tng_free_result($famresult);
	}
}

echo "</channel>\n";
echo "</rss>\n";
?>