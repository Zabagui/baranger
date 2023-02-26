<?php
$textpart = "showphoto";
include("tng_begin.php");

include($cms['tngpath'] . "functions.php");
include($cms['tngpath'] . "personlib.php" );

$browsealbums_url = getURL( "browsealbums", 1 );
$browsealbums_noargs_url = getURL( "browsealbums", 0 );
$showalbum_url = getURL( "showalbum", 1 );
$getperson_url = getURL( "getperson", 1 );
$familygroup_url = getURL( "familygroup", 1 );
$showsource_url = getURL( "showsource", 1 );
$showrepo_url = getURL( "showrepo", 1 );
$placesearch_url = getURL( "placesearch", 1 );

function doMediaSearch( $instance, $pagenav ) {
	global $text, $mediasearch, $browsealbums_noargs_url, $tree;

	$str = getFORM( "browsealbums", "get", "MediaSearch$instance", "" );
	$str .= "<input type=\"text\" name=\"mediasearch\" value=\"$mediasearch\" />\n";
	$str .= "<input type=\"hidden\" name=\"tree\" value=\"$tree\" />\n";
	$str .= "<input type=\"submit\" value=\"{$text['search']}\" />\n";
	$str .= "<input type=\"button\" value=\"{$text['tng_reset']}\" onclick=\"window.location.href='$browsealbums_noargs_url';\" />&nbsp;&nbsp;&nbsp;";
	$str .= $pagenav;
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

if( $tree )
	$wherestr2 = " AND $album2entities_table.gedcom = \"$tree\"";
else
	$wherestr2 = "";

$wherestr = "WHERE active = \"1\"";
if( !isset($mediasearch) ) $mediasearch = "";
	$wherestr .= " AND ($albums_table.albumname LIKE \"%$mediasearch%\" OR $albums_table.description LIKE \"%$mediasearch%\" OR $albums_table.keywords LIKE \"%$mediasearch%\")";

$query = "SELECT albumID, albumname, description, alwayson FROM $albums_table $wherestr ORDER BY albumname LIMIT $newoffset" . $maxsearchresults;
$result = tng_query($query);
$numrows = tng_num_rows( $result );

if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
	$query = "SELECT count($albums_table.albumID) as acount FROM $albums_table";
	$result2 = tng_query($query);
	$row = tng_fetch_assoc( $result2 );
	tng_free_result($result2);
	$totrows = $row['acount'];
}
else
	$totrows = $numrows;

$numrowsplus = $numrows + $offset;

$treestr = $tree ? " {$text['tree']}: $tree" : "";
$treestr = trim("$mediasearch $treestr");
$treestr = $treestr ? " ($treestr)" : "";

$logstring = "<a href=\"$browsealbums_url" . "tree=$tree&amp;offset=$offset&amp;mediasearch=$mediasearch\">{$text['allalbums']}$treestr</a>";
writelog($logstring);
preparebookmark($logstring);

tng_header( $text['albums'], $flags );
?>

<h1 class="header"><span class="headericon" id="albums-hdr-icon"></span><?php echo $text['albums']; ?></h1><br clear="all" />
<?php
echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'browsealbums', 'method' => 'get', 'name' => 'form1', 'id' => 'form1'));

if( $totrows )
	echo "<p class=\"normal\">{$text['matches']} $offsetplus {$text['to']} $numrowsplus {$text['of']} $totrows</p>";

$pagenav = get_browseitems_nav( $totrows, $browsealbums_url . "mediasearch=$mediasearch&amp;offset", $maxsearchresults, $max_browsemedia_pages );
echo doMediaSearch( 1, $pagenav );
echo "<br />\n";

$header = "";
$headerr = $enableminimap ? " data-tablesaw-minimap" : "";
$headerr .= $enablemodeswitch ? " data-tablesaw-mode-switch" : "";

if($sitever != "standard") {
	if($tabletype == "toggle") $tabletype = "columntoggle";
	$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" width=\"100%\" class=\"tablesaw thfixed whiteback normal\" data-tablesaw-mode=\"$tabletype\"{$headerr}>\n";
} else {
	$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" class=\"thfixed whiteback normal\">";
}
echo $header;

$albumtext = $header = "";
$header .= "<thead><tr><th data-tablesaw-priority=\"persist\" class=\"fieldnameback fieldname nbrcol\">&nbsp;#&nbsp;</th>\n";
$header .= "<th data-tablesaw-priority=\"1\" class=\"fieldnameback fieldname\">&nbsp;{$text['thumb']}&nbsp;</th>\n";
$header .= "<th data-tablesaw-priority=\"2\" class=\"fieldnameback fieldname\">&nbsp;{$text['description']}&nbsp;</th>\n";
$header .= "<th data-tablesaw-priority=\"3\" class=\"fieldnameback fieldname\">&nbsp;{$text['numitems']}&nbsp;</th>\n";
$header .= "<th data-tablesaw-priority=\"4\" class=\"fieldnameback fieldname\">&nbsp;{$text['indlinked']}&nbsp;</th>\n";
$header .= "</tr></thead>\n";

$i = $offsetplus;
$maxplus = $maxsearchresults + 1;
$thumbcount = 0;
while( $row = tng_fetch_assoc( $result ) ) {
	if($tree)
		$query2 = "SELECT count($albumlinks_table.albumlinkID) as acount FROM $albumlinks_table, $media_table WHERE albumID = \"{$row['albumID']}\" AND $albumlinks_table.mediaID = $media_table.mediaID AND ($media_table.gedcom = \"$tree\" OR $media_table.gedcom = \"\")";
	else
		$query2 = "SELECT count($albumlinks_table.albumlinkID) as acount FROM $albumlinks_table WHERE albumID = \"{$row['albumID']}\"";
	$result2 = tng_query($query2) or die ($text['cannotexecutequery'] . ": $query2");
	$arow = tng_fetch_assoc( $result2 );
	tng_free_result($result2);

	$query = "SELECT $album2entities_table.entityID as personID, people.personID as personID2, people.living as living, people.private as private, people.branch as branch, $families_table.branch as fbranch,
		$families_table.living as fliving, $families_table.private as fprivate, familyID, husband, wife, people.lastname as lastname, people.lnprefix as lnprefix, people.firstname as firstname, people.prefix as prefix, people.suffix as suffix, nameorder, people.title,
		$album2entities_table.gedcom, $sources_table.title, $sources_table.sourceID, $repositories_table.repoID, reponame, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr, burialdate, linktype
		FROM $album2entities_table
		LEFT JOIN $people_table AS people ON $album2entities_table.entityID = people.personID AND $album2entities_table.gedcom = people.gedcom
		LEFT JOIN $families_table ON $album2entities_table.entityID = $families_table.familyID AND $album2entities_table.gedcom = $families_table.gedcom
		LEFT JOIN $sources_table ON $album2entities_table.entityID = $sources_table.sourceID AND $album2entities_table.gedcom = $sources_table.gedcom
		LEFT JOIN $repositories_table ON ($album2entities_table.entityID = $repositories_table.repoID AND $album2entities_table.gedcom = $repositories_table.gedcom)
		WHERE albumID = \"{$row['albumID']}\"$wherestr2 ORDER BY lastname, lnprefix, firstname, personID LIMIT $maxplus";
	$presult = tng_query($query);
	$numrows = tng_num_rows( $presult );
	$medialinktext = "";
	$foundliving = 0;
	$foundprivate = 0;
	$count = 0;
	while( $prow = tng_fetch_assoc( $presult ) )
	{
		if( $prow['fbranch'] != NULL ) $prow['branch'] = $prow['fbranch'];
		if( $prow['fliving'] != NULL ) $prow['living'] = $prow['fliving'];
		if( $prow['fprivate'] != NULL ) $prow['private'] = $prow['fprivate'];
		//if living still null, must be a source
		if( $prow['living'] == NULL && $prow['private'] == NULL && $prow['linktype'] == 'I') {
			$query = "SELECT count(personID) as ccount FROM $citations_table, $people_table
				WHERE $citations_table.sourceID = '{$prow['personID']}' AND $citations_table.persfamID = $people_table.personID AND $citations_table.gedcom = $people_table.gedcom
				AND (living = '1' OR private = '1')";
			$presult2 = tng_query($query);
			$prow2 = tng_fetch_assoc( $presult2 );
			if( $prow2['ccount'] ) $prow['living'] = 1;
			tng_free_result( $presult2 );
		}
		if( $prow['living'] == NULL && $prow['private'] == NULL && $prow['linktype'] == 'F') {
			$query = "SELECT count(familyID) as ccount FROM $citations_table, $families_table
				WHERE $citations_table.sourceID = '{$prow['personID']}' AND $citations_table.persfamID = $families_table.familyID AND $citations_table.gedcom = $families_table.gedcom
				AND living = '1'";
			$presult2 = tng_query($query);
			$prow2 = tng_fetch_assoc( $presult2 );
			if( $prow2['ccount'] ) $prow['living'] = 1;
			tng_free_result( $presult2 );
		}

		$rights = determineLivingPrivateRights($prow);
		$prow['allow_living'] = $rights['living'];
		$prow['allow_private'] = $rights['private'];
		
		//echo "al={$prow['allow_living']}, ap={$prow['allow_private']}<br>";

		if(!$rights['living'])
			$foundliving = 1;
		if(!$rights['private'])
			$foundprivate = 1;

		if( $prow['personID2'] != NULL ) {
			$medialinktext .= "<li><a href=\"$getperson_url" . "personID={$prow['personID2']}&amp;tree={$prow['gedcom']}\">";
			$medialinktext .= getName( $prow ) . "</a></li>\n";
		}
		elseif( $prow['sourceID'] != NULL ) {
			$sourcetext = $prow['title'] ? "{$text['source']}: {$prow['title']}" : "{$text['source']}: {$prow['sourceID']}";
			$medialinktext .= "<li><a href=\"$showsource_url" . "sourceID={$prow['personID']}&amp;tree={$prow['gedcom']}\">$sourcetext</a></li>\n";
		}
		elseif( $prow['repoID'] != NULL ) {
			$repotext = $prow['reponame'] ? "{$text['repository']}: {$prow['reponame']}" : "{$text['repository']}: {$prow['repoID']}";
			$medialinktext .= "<li><a href=\"$showrepo_url" . "repoID={$prow['personID']}&amp;tree={$prow['gedcom']}\">$repotext</a></li>\n";
		}
		elseif( $prow['familyID'] != NULL )
			$medialinktext .= "<li><a href=\"$familygroup_url" . "familyID={$prow['personID']}&amp;tree={$prow['gedcom']}\">{$text['family']}: " . getFamilyName( $prow ) . "</a></li>\n";
		else {
			$treestr = $tngconfig['places1tree'] ? "" : "&amp;tree={$prow['gedcom']}";
			$medialinktext .= "<li><a href=\"$placesearch_url" . "psearch={$prow['personID']}$treestr\">{$prow['personID']}</a></li>\n";
		}
		$count++;
	}
	if($medialinktext) $medialinktext = "<ul>$medialinktext</ul>\n";
	tng_free_result( $presult );

	$showAlbumInfo = $row['allow_living'] = $row['alwayson'] || (!$foundprivate && !$foundliving);

	$albumtext .= "<tr><td valign=\"top\" class=\"databack\"><span class=\"normal\">$i</span></td>";

	$description = $row['description'];
	if($showAlbumInfo) {
		$imgsrc = getAlbumPhoto($row['albumID'],$row['albumname']);
		$alblink = "<a href=\"$showalbum_url" . "albumID={$row['albumID']}\" class=\"media-title\">{$row['albumname']}</a>";
	}
	else {
		$imgsrc = "";
		$alblink = "<span class=\"media-title\">{$text['living']}</span>";
	 	$nonamesloc = $foundprivate ? $tngconfig['nnpriv'] : $nonames;
		if($nonamesloc) {
			$description = $text['livingphoto'];
		}
		else {
			$description .= "({$text['livingphoto']})";
		}
	}

	if($imgsrc) {
		$albumtext .= "<td valign=\"top\" class=\"databack\" align=\"center\" style=\"width:{$thumbmaxw}px\">$imgsrc</td>";
		$thumbcount++;
	}
	else
		$albumtext .= "<td valign=\"top\" class=\"databack\" align=\"center\">&nbsp;</td>";

	$albumtext .= "<td class=\"databack\" valign=\"top\"><span class=\"normal\">$alblink<br />$description&nbsp;</span></td>\n";
	$albumtext .= "<td class=\"databack\" valign=\"top\" align=\"center\"><span class=\"normal\">{$arow['acount']}&nbsp;</span></td>\n";
	$albumtext .= "<td valign=\"top\" class=\"databack\" width=\"200\"><span class=\"normal\">\n$medialinktext&nbsp;</span></td>\n";
	$albumtext .= "</tr>\n";
	$i++;
}
tng_free_result($result);

if( !$thumbcount ) {
	$header = str_replace( "<td class=\"fieldnameback\"><span class=\"fieldname\">&nbsp;<strong>{$text['thumb']}</strong>&nbsp;</span></td>", "", $header );
	$albumtext = str_replace( "<td valign=\"top\" class=\"databack\" align=\"center\">&nbsp;</td><td valign=\"top\" class=\"databack\">", "<td valign=\"top\" class=\"databack\">", $albumtext );
}
echo $header . $albumtext;
?>
</table><br/>
<?php
if( $totrows && ($pagenav || $mediasearch) ) {
	echo doMediaSearch( 2, $pagenav );
	echo "<br />";
}
tng_footer( "" );
?>