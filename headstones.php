<?php
$needMap = true;
$textpart = "headstones";
include("tng_begin.php");

include($subroot . "mapconfig.php");
$mapkeystr = $map['key'] && $map['key'] != "1" ? "&amp;key=" . $map['key'] . "&amp;callback=initMap" : "";
include($cms['tngpath'] . "functions.php");

$showmap_url = getURL( "showmap", 1 );
$getperson_url = getURL( "getperson", 1 );
$showmedia_url = getURL( "showmedia", 1 );
$showsource_url = getURL( "showsource", 1 );
$familygroup_url = getURL( "familygroup", 1 );
$showrepo_url = getURL( "showrepo", 1 );
$placesearch_url = getURL( "placesearch", 1 );
$headstones_url = getURL( "headstones", 1 );

$flags['imgprev'] = true;
if(!isset($flags['scripting'])) $flags['scripting'] = "";

if(!$thumbmaxw) $thumbmaxw = 80;

$max_pages = 5;
$cemnewoffset = 0;
$cemoffsetplus = 0;
if(!isset($max_cemeteries)) $max_cemeteries = 100;
$mcharsetstr = "&amp;oe=$session_charset";

$city = isset($city) ? preg_replace("/[<>{};!=]/", '', $city) : "";
$county = isset($county) ? preg_replace("/[<>{};!=]/", '', $county) : "";
$state = isset($state) ? preg_replace("/[<>{};!=]/", '', $state) : "";
$country = isset($country) ? preg_replace("/[<>{};!=]/", '', $country) : "";

$city = addslashes($city);
$county = addslashes($county);
$state = addslashes($state);
$country = addslashes($country);
if(!isset($cemeteryID)) $cemeteryID = "";

if( $cemeteryID )
	$subquery = "WHERE cemeteryID = '$cemeteryID'";
else {
	if(!empty($cemoffset)) {
		$cemoffsetplus = $cemoffset + 1;
		$cemnewoffset = "$cemoffset, ";
	}
	else {
		$cemoffsetplus = 1;
		$cemnewoffset = "";
		$page = 1;
	}
	$subquery = "";
	if( $country )
		$subquery .= "country = '$country' ";
	if( $state ) {
		if($subquery) $subquery .= "AND ";
		$subquery .= "state = '$state' ";
	}
	if( $county ) {
		if($subquery) $subquery .= "AND ";
		$subquery .= "county = '$county'";
	}
	if( $city ) {
		if($subquery) $subquery .= "AND ";
		$subquery .= "city = '$city'";
	}
	if($subquery)
		$subquery = "WHERE " . $subquery;
}

$totrows = 0;
if( $subquery ) {
	$query = "SELECT * FROM $cemeteries_table $subquery ORDER BY country, state, county, city, cemname LIMIT $cemnewoffset" . $max_cemeteries;
	$cemresult = tng_query($query);

	$numrows = tng_num_rows( $cemresult );

	if( $numrows == $max_cemeteries || $cemoffsetplus > 1 ) {
		$query = "SELECT count(cemeteryID) as ccount FROM $cemeteries_table $subquery";
		$result2 = tng_query($query);
		$row = tng_fetch_assoc( $result2 );
		tng_free_result($result2);
		$totrows = $row['ccount'];
	}
	else
		$totrows = $numrows;
}
else
	$cemresult = "";
if(!$cemeteryID) {
	$toppagenav = get_browseitems_nav( $totrows, $headstones_url . "country=$country&amp;state=$state&amp;county=$county&amp;city=$city&amp;tree=$tree&amp;cemoffset", $max_cemeteries, $max_pages );
	$tngpage = 1;
}

if(empty($tngpage) && !$cemeteryID && $cemresult && tng_num_rows($cemresult) == 1) {
	$cemetery = tng_fetch_assoc( $cemresult );
	tng_free_result($cemresult);
	header("Location:$showmap_url" . "cemeteryID={$cemetery['cemeteryID']}&tree=$tree");
	exit;
} else {
	// Initialize the cemeteryID for use in the link on line 118.
	$cemetery['cemeteryID'] = "";
}

if(!empty($offset)) {
	$offsetplus = $offset + 1;
	$newoffset = "$offset, ";
}
else {
	$offsetplus = 1;
	$newoffset = "";
	$page = 1;
}

$country = stripslashes($country);
$state = stripslashes($state);
$county = stripslashes($county);
$city = stripslashes($city);
$location = $city;
if( $location && $county ) $location .= ", $county"; else $location = $county;
if( $location && $state ) $location .= ", $state"; else $location = $state;
if( $location && $country ) $location .= ", $country"; else $location = $country;

$titlestr = $text['cemeteriesheadstones'];
if( $location ) $titlestr .= " {$text['in']} $location";
$logstring = "<a href=\"$headstones_url" . "country=$country&amp;state=$state&amp;county=$county&amp;city=$city&amp;cemeteryID=$cemeteryID&amp;tree=$tree\">$titlestr</a>";
writelog($logstring);
preparebookmark($logstring);

if( $map['key'] && $isConnected)
    $flags['scripting'] .= "<script type=\"text/javascript\" src=\"{$http}://maps.googleapis.com/maps/api/js?language={$text['glang']}$mapkeystr\"></script>\n";
tng_header( $text['cemeteriesheadstones'], $flags );
?>

<h1 class="header"><span class="headericon" id="headstones-hdr-icon"></span>&nbsp;<?php echo $text['cemeteriesheadstones'];  if( $location ) echo " {$text['in']} $location"; ?></h1><br clear="all" />
<?php
$hiddenfields[] = array('name' => 'country', 'value' => $country);
$hiddenfields[] = array('name' => 'state', 'value' => $state);
$hiddenfields[] = array('name' => 'county', 'value' => $county);
echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'headstones', 'method' => 'get', 'name' => 'form1', 'id' => 'form1', 'hidden' => $hiddenfields));

if($tree) {
	$wherestr = " AND ($media_table.gedcom = \"$tree\" || $media_table.gedcom = \"\")";
	$wherestr2 = " AND $medialinks_table.gedcom = \"$tree\"";
}
else
	$wherestr = $wherestr2 = "";

$body = "";
$cemcount = 0;
$gotImageJpeg = function_exists('imageJpeg');
while( !$subquery || $cemetery = tng_fetch_assoc( $cemresult ) )
{
	if( $cemcount )
		$body .= "<br />\n";
	$body .= "<div class=\"titlebox\">\n";
	$thiscem = $subquery ? $cemetery['cemeteryID'] : "";
	$query = "SELECT DISTINCT $media_table.mediaID, description, notes, path, thumbpath, status, plot, showmap, usecollfolder, form, mediatypeID, abspath, newwindow, latitude, longitude
		FROM $media_table LEFT JOIN $medialinks_table on $media_table.mediaID = $medialinks_table.mediaID
		WHERE mediatypeID = \"headstones\" AND cemeteryID = \"$thiscem\" $wherestr ORDER BY description LIMIT $newoffset" . $maxsearchresults;
	if( !$subquery ) {
		$cemetery = array();
		$cemetery['cemname'] = $text['nocemetery'];
		$cemetery['cemeteryID'] = "";
		$subquery = "done";
	}
	$hsresult = tng_query($query);

	$numrows = tng_num_rows( $hsresult );
	if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
		$query = "SELECT count(DISTINCT $media_table.mediaID) as hscount FROM $media_table LEFT JOIN $medialinks_table on $media_table.mediaID = $medialinks_table.mediaID WHERE mediatypeID = \"headstones\" AND cemeteryID = \"$thiscem\" $wherestr";
		$result2 = tng_query($query);
		$row = tng_fetch_assoc( $result2 );
		$totrows = $row['hscount'];
	}
	else
		$totrows = $numrows;

	$body .= "<div><p class=\"subhead\"><strong>\n";
	if($cemetery['cemname'] == $text['nocemetery'])
		$location = $cemetery['cemname'];
	else {
		$location = "<a href=\"$showmap_url" . "cemeteryID={$cemetery['cemeteryID']}&amp;tree=$tree\">" . $cemetery['cemname'];
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
		$location .= "</a>";
	}

	if( $map['key'] ) {
		$lat = isset($cemetery['latitude']) ? $cemetery['latitude'] : "";
		$long = isset($cemetery['longitude']) ? $cemetery['longitude'] : "";
		$zoom = isset($cemetery['zoom']) ? $cemetery['zoom'] : 10;
		$pinplacelevel = $pinplacelevel2;

		// if we have one, add it
		if($lat && $long) {
	 		$cemeteryplace = "{$cemetery['cemname']}, {$cemetery['city']}, {$cemetery['county']}, {$cemetery['state']}, {$cemetery['country']}";
	 		$localballooncemeteryname = @htmlspecialchars($cemetery['cemname'], ENT_QUOTES, $session_charset);
	 		$localballooncemeteryplace = @htmlspecialchars($cemeteryplace, ENT_QUOTES, $session_charset);
	 		$remoteballoontext = @htmlspecialchars(str_replace($banish, $banreplace, "{$cemetery['cemname']}, $cemeteryplace"), ENT_QUOTES, $session_charset);
            $codednotes = $cemetery['notes'] ? "<br /><br />" .  tng_real_escape_string($text['notes'] . ": " . $cemetery['notes']) : "";
			$codednotes .= "<br /><br /><a href=\"{$http}://maps.google.com/maps?f=q&amp;hl={$text['glang']}$mcharsetstr&amp;daddr=$lat,$long($remoteballoontext)\" target=\"_blank\">{$text['getdirections']}</a>{$text['directionsto']} $localballooncemeteryname";
			$locations2map[$l2mCount]= array("zoom"=>$zoom,"lat"=>$lat,"long"=>$long,"pinplacelevel"=>$pinplacelevel,"place"=>$cemeteryplace,"htmlcontent"=>"<div class=\"mapballoon normal\"><a href=\"$showmap_url" . "cemeteryID={$cemetery['cemeteryID']}\">$localballooncemeteryname</a><br />$localballooncemeteryplace$codednotes</div>");
			$l2mCount++;
			$body .= "<a href=\"{$http}://maps.google.com/maps?f=q&amp;hl={$text['glang']}$mcharsetstr&amp;daddr=$lat,$long($remoteballoontext)&amp;z=$zoom&amp;om=1&amp;iwloc=addr\" target=\"_blank\"><img src=\"{$cms['tngpath']}google_marker.php?image=$pinplacelevel2.png&amp;text=$l2mCount\" alt=\"\" border=\"0\" align=\"left\" style=\"padding-right:5px\" /></a>";
			$map['pins']++;
		}
	}

	$body .= $location;
	$body .= "</strong></p>";
	$pagenav = get_browseitems_nav( $totrows, $headstones_url . "cemeteryID={$cemetery['cemeteryID']}&amp;tree=$tree&amp;offset", $maxsearchresults, 5 );
	$body .= "<p>$pagenav</p>";
	$body .= "</div>\n";

	$header = "";
	$headerr = $enableminimap ? " data-tablesaw-minimap" : "";
	$headerr .= $enablemodeswitch ? " data-tablesaw-mode-switch" : "";

	if($sitever != "standard") {
		if($tabletype == "toggle") $tabletype = "columntoggle";
		$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" width=\"100%\" class=\"tablesaw thfixed whiteback normal\" data-tablesaw-mode=\"$tabletype\"{$headerr}>\n";
	} else {
		$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" class=\"thfixed whiteback normal\" style=\"width:100%\">";
	}
	$body .= $header;
	$body .= "<thead><tr><th data-tablesaw-priority=\"persist\" class=\"fieldnameback center fieldname\" style=\"width:{$thumbmaxw}px\">&nbsp;{$text['thumb']}</th>";
	$body .= "<th data-tablesaw-priority=\"1\" class=\"fieldnameback fieldname\">&nbsp;{$text['description']}</th>";
	$body .= "<th data-tablesaw-priority=\"6\" class=\"fieldnameback fieldname\">&nbsp;{$text['status']}</th>";
	$body .= "<th data-tablesaw-priority=\"4\" class=\"fieldnameback fieldname\">&nbsp;{$text['location']}</th>";
	$body .= "<th data-tablesaw-priority=\"3\" class=\"fieldnameback fieldname\">&nbsp;{$text['name']} ({$text['diedburied']})</th></tr></thead>";

	while( $hs = tng_fetch_assoc( $hsresult ) ) {
		$mediatypeID = $hs['mediatypeID'];
		$usefolder = $hs['usecollfolder'] ? $mediatypes_assoc[$mediatypeID] : $mediapath;

		$status = $hs['status'];
		$hs['cemeteryID'] = $cemetery['cemeteryID'];
		if($status && $text[$status]) $hs['status'] = $text[$status];

		$query = "SELECT medialinkID, $medialinks_table.personID as personID, people.personID as personID2, familyID, people.living as living, people.private as private, people.branch as branch,
			husband, wife, people.lastname as lastname, people.lnprefix as lnprefix, people.firstname as firstname,
			people.prefix as prefix, people.suffix as suffix, nameorder, $medialinks_table.gedcom as gedcom, treename, $sources_table.title, $sources_table.sourceID, $repositories_table.repoID,reponame, deathdate, burialdate, linktype
			FROM ($medialinks_table, $trees_table)
			LEFT JOIN $people_table AS people ON ($medialinks_table.personID = people.personID AND $medialinks_table.gedcom = people.gedcom)
			LEFT JOIN $families_table ON ($medialinks_table.personID = $families_table.familyID AND $medialinks_table.gedcom = $families_table.gedcom)
			LEFT JOIN $sources_table ON ($medialinks_table.personID = $sources_table.sourceID AND $medialinks_table.gedcom = $sources_table.gedcom)
			LEFT JOIN $repositories_table ON ($medialinks_table.personID = $repositories_table.repoID AND $medialinks_table.gedcom = $repositories_table.gedcom)
			WHERE mediaID = \"{$hs['mediaID']}\" AND $medialinks_table.gedcom = $trees_table.gedcom $wherestr2 ORDER BY lastname, lnprefix, firstname, $medialinks_table.personID";

		$presult = tng_query($query);
		$hslinktext = "";
		while( $prow = tng_fetch_assoc( $presult ) ) {
			$prights = determineLivingPrivateRights($prow);
			$prow['allow_living'] = $prights['living'];
			$prow['allow_private'] = $prights['private'];

			$hstext = "";
			if( $prow['personID2'] != NULL ) {
				$hslinktext .= "<a href=\"$getperson_url" . "personID={$prow['personID2']}&amp;tree={$prow['gedcom']}\">";
				$hslinktext .= getName( $prow );
				$deathdate = $prow['deathdate'] ? $prow['deathdate'] : $prow['burialdate'];
				if( $prow['deathdate'] ) $abbrev = $text['deathabbr'];
				elseif( $prow['burialdate'] ) $abbrev = $text['burialabbr'];
				$hstext = $deathdate ? " ($abbrev " . displayDate( $deathdate ) . ")" : "";
			}
			elseif( $prow['familyID'] != NULL ) {
				$hslinktext .= "<a href=\"$familygroup_url" . "familyID={$prow['familyID']}&amp;tree={$prow['gedcom']}<br />}\">{$text['family']}: " . getFamilyName( $prow );
			}
			elseif( $prow['sourceID'] != NULL ) {
				$sourcetext = $prow['title'] ? "{$text['source']}: {$prow['title']}" : "{$text['source']}: {$prow['sourceID']}";
				$hslinktext .= "<a href=\"$showsource_url" . "sourceID={$prow['sourceID']}&amp;tree={$prow['gedcom']}\">$sourcetext";
			}
			elseif( $prow['repoID'] != NULL ) {
				$repotext = $prow['reponame'] ? "{$text['repository']}: {$prow['reponame']}" : "{$text['repository']}: {$prow['repoID']}";
				$hslinktext .= "<a href=\"$showrepo_url" . "repoID={$prow['repoID']}&amp;tree={$prow['gedcom']}\">$repotext";
			}
			else {
				$treestr = $tngconfig['places1tree'] ? "" : "&amp;tree={$prow['gedcom']}";
				$hslinktext .= "<a href=\"$placesearch_url" . "psearch={$prow['personID']}$treestr\">{$prow['personID']}";
			}
			$hslinktext .= "</a>$hstext\n<br />\n";
		}
		tng_free_result( $presult );

		$description = $hs['description'];
		$notes = $hs['notes'];

		$body .= "<tr><td valign=\"top\" class=\"databack center\" style=\"width:$thumbmaxw" . "px\">";
		$hs['mediatypeID'] = "headstones";
		$hs['allow_living'] = $hs['allow_private'] = 1;
		$imgsrc = getSmallPhoto($hs);
      		$href = getMediaHREF($hs,3);

		if($imgsrc) {
			$body .= "<div class=\"media-img\"><div class=\"media-prev\" id=\"prev{$hs['mediaID']}\" style=\"display:none\"></div></div>\n";
			$body .= "<a href=\"$href\"";
			if( $gotImageJpeg && isPhoto($hs) && checkMediaFileSize("$rootpath$usefolder/{$hs['path']}") )
				$body .=  " class=\"media-preview\" id=\"img-{$hs['mediaID']}-0-" . urlencode("$usefolder/{$hs['path']}") . "\"";
			$body .= ">$imgsrc</a>\n";
		}
		else {
			$body .= "&nbsp;";
		}

		$body .= "</td>\n";

		$body .= "<td valign=\"top\" class=\"databack\"><span class=\"normal\"><a href=\"$href\">{$hs['description']}</a><br />{$hs['notes']}&nbsp;</span></td>\n";
		$body .= "<td valign=\"top\" class=\"databack\"><span class=\"normal\">{$hs['status']}&nbsp;</span></td>\n";
		$body .= "<td valign=\"top\" class=\"databack\"><span class=\"normal\">" . nl2br($hs['plot']);
		if( $hs['latitude'] || $hs['longitude'] ) {
			if($hs['plot']) $body .= "<br />";
			$body .= "{$text['latitude']}: {$hs['latitude']}, {$text['longitude']}: {$hs['longitude']}";
		}
		$body .= "&nbsp;</span></td>\n";
		$body .= "<td valign=\"top\" class=\"databack\"><span class=\"normal\">$hslinktext&nbsp;</span></td>\n";
		$body .= "</tr>\n";
	}
	$cemcount++;
	$body .= "</table>\n";
	if($pagenav) $body .= "<br/>$pagenav";
	$body .= "</div>\n<br />\n";

	if( $subquery == "done" ) break;
}

if($map['key'] && $map['pins'])
	echo "<div id=\"map\" style=\"width: {$map['hstw']}; height: {$map['hsth']};\" class=\"rounded10 cemmap\"></div>\n";

if(!empty($toppagenav))
	echo "<p>$toppagenav</p>\n$body\n<p>$toppagenav</p>";
else
	echo $body;
if($cemresult) tng_free_result($cemresult);

tng_footer($flags);
?>