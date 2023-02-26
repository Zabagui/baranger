<?php
$textpart = "headstones";
$needMap = true;
include("tng_begin.php");
global $responsivetables, $tabletype, $enablemodeswitch, $enableminimap;
include($subroot . "mapconfig.php");

if(!$cemeteryID || !is_numeric($cemeteryID)) {header( "Location: thispagedoesnotexist.html" ); exit;}
include($cms['tngpath'] . "functions.php");

$showmap_url = getURL( "showmap", 1 );
$showmedia_url = getURL( "showmedia", 1 );
$getperson_url = getURL( "getperson", 1 );
$showsource_url = getURL( "showsource", 1 );
$familygroup_url = getURL( "familygroup", 1 );
$showrepo_url = getURL( "showrepo", 1 );
$placesearch_url = getURL( "placesearch", 1 );
$showtree_url = getURL( "showtree", 1 );
$pedigree_url = getURL( "pedigree", 1 );

$flags['imgprev'] = true;

$treequery = "SELECT count(gedcom) as treecount FROM $trees_table";
$treeresult = tng_query($treequery);
$treerow = tng_fetch_assoc($treeresult);
$numtrees = $treerow['treecount'];
tng_free_result($treeresult);

if(!$thumbmaxw) $thumbmaxw = 80;

if(!empty($offset)) {
	$offsetplus = $offset + 1;
	$newoffset = "$offset, ";
}
else {
	$offsetplus = 1;
	$newoffset = "";
	$page = 1;
}

if($cemeteryID) {
	$query = "SELECT cemname, city, county, state, country, maplink, notes, latitude, longitude, zoom, place FROM $cemeteries_table WHERE cemeteryID = \"$cemeteryID\"";
	$cemresult = tng_query($query);

	if(!tng_num_rows($cemresult)) {header( "Location: thispagedoesnotexist.html" ); exit;}

	$cemetery = tng_fetch_assoc($cemresult);
	tng_free_result($cemresult);

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
}
else
	$location = $text['nocemetery'];

$logstring = "<a href=\"$showmap_url" . "cemeteryID=$cemeteryID&amp;tree=$tree\">$location</a>";
writelog($logstring);
preparebookmark($logstring);

$mcharsetstr = "&amp;oe=$session_charset";
$chartlink = "<img src=\"{$cms['tngpath']}img/Chart.gif\" class=\"chartimg\" alt=\"\" />";

if( !empty($cemetery['maplink']) && file_exists("$rootpath$headstonepath/" . $cemetery['maplink']) )
	$size = GetImageSize( "$rootpath$headstonepath/" . $cemetery['maplink'] );
else
	$size = false;

if( $map['key'] && $isConnected) {
	if( !isset($flags['scripting']) ) $flags['scripting'] = "";
	$flags['scripting'] .= "<script type=\"text/javascript\" src=\"{$http}://maps.googleapis.com/maps/api/js?language={$text['glang']}$mapkeystr\"></script>\n";
}
tng_header( $location, $flags );
?>

<h1 class="header"><span class="headericon" id="headstones-hdr-icon"></span>&nbsp;<?php echo $location; ?></h1><br clear="all" />
<?php
$hiddenfields[] = array('name' => 'cemeteryID', 'value' => $cemeteryID);
echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'showmap', 'method' => 'get', 'name' => 'form1', 'id' => 'form1', 'hidden' => $hiddenfields));

$infoblock = "";
$body = "";
if($cemeteryID) {
	if( !empty($cemetery['maplink']) && file_exists("$rootpath$headstonepath/" . $cemetery['maplink']) )
		$infoblock .= "<img src=\"$headstonepath/{$cemetery['maplink']}\" style=\"max-width: 100%; height: auto;\" alt=\"{$cemetery['cemname']}\" /><br/><br/>\n";

	if( $allow_admin && $allow_edit )
		$infoblock .= "<p><a href=\"{$cms['tngpath']}" . "admin_editcemetery.php?cemeteryID=$cemeteryID&amp;cw=1\" target=\"blank\" class=\"snlink\">{$text['editcem']}</a></p>\n";

	if( $cemetery['notes'] )
		$infoblock .= "<p><strong>{$text['notes']}:</strong><br />\n" . nl2br(insertLinks($cemetery['notes'])) . "</p>";

	if( !$map['key'] && ($cemetery['latitude'] || $cemetery['longitude']) )
		$infoblock .= "<p><strong>{$text['latitude']}:</strong> {$cemetery['latitude']}, <strong>{$text['longitude']}:</strong> {$cemetery['longitude']}</p>";

	$cemcoords = false;
	if( $map['key'] ) {
		$lat = $cemetery['latitude'];
		$long = $cemetery['longitude'];
		$zoom = $cemetery['zoom'] ? $cemetery['zoom'] : 10;
		if( !$zoom ) $zoom = 10;
		//RM - set placeleve = 2 to provide this value to the map for all cemeteries
		$pinplacelevel = $pinplacelevel2;

		// if we have one, add it
		if($lat && $long) {
		 	$cemeteryplace = "{$cemetery['city']}, {$cemetery['county']}, {$cemetery['state']}, {$cemetery['country']}";
		 	$localballooncemeteryname = @htmlspecialchars($cemetery['cemname'], ENT_QUOTES, $session_charset);
		 	$localballooncemeteryplace = @htmlspecialchars($cemeteryplace, ENT_QUOTES, $session_charset);
		 	$remoteballoontext = @htmlspecialchars(str_replace($banish, $banreplace, "{$cemetery['cemname']}, $cemeteryplace"), ENT_QUOTES, $session_charset);
            $codednotes = $cemetery['notes'] ? "<br /><br />" .  tng_real_escape_string($text['notes'] . ": " . $cemetery['notes']) : "";
			$codednotes .= "<br /><br /><a href=\"{$http}://maps.google.com/maps?f=q&amp;hl={$text['glang']}$mcharsetstr&amp;daddr=$lat,$long($remoteballoontext)\" target=\"_blank\">{$text['getdirections']}</a>{$text['directionsto']} $localballooncemeteryname";
			$cempin = array("zoom"=>$zoom,"lat"=>$lat,"long"=>$long,"pinplacelevel"=>$pinplacelevel,"htmlcontent"=>"<div class=\"mapballoon normal\">$localballooncemeteryname<br />$localballooncemeteryplace$codednotes</div>");
			$cemcoords = true;
			$body .= "<div style=\"padding-bottom:15px\"><span><strong>{$text['latitude']}:</strong> $lat, <strong>{$text['longitude']}:</strong> $long</span> | <a href=\"{$http}://maps.google.com/maps?f=q&amp;hl={$text['glang']}$mcharsetstr&amp;daddr=$lat,$long($remoteballoontext)\" target=\"_blank\">{$text['getdirections']}</a>{$text['directionsto']} $localballooncemeteryname</div>";
		}
	}
}

if($infoblock)
	$body .= "<div class=\"titlebox\">$infoblock</div>\n<br/>\n";

$index_all = 0;
$query = "SELECT mediaID, thumbpath, description, notes, usecollfolder, mediatypeID, path, form, abspath, private, newwindow from $media_table WHERE cemeteryID = \"$cemeteryID\" AND (mediatypeID != \"headstones\" OR linktocem = \"1\") ORDER BY description";
$hsresult = tng_query($query);
$gotImageJpeg = function_exists('imageJpeg');
if( tng_num_rows( $hsresult ) ) {
	$i = 1;
	$body .= "<div class=\"titlebox\">\n";
	$body .= "<p class=\"subhead\"><b>{$text['cemphotos']}</b></p>\n";

	$body .= "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" class=\"whiteback tfixed\" width=\"100%\">\n";
	$body .= "<tr><td class=\"fieldnameback\" width=\"10\">&nbsp;</td>\n";
	$body .= "<td class=\"fieldnameback fieldname\" width=\"$thumbmaxw\">&nbsp;<strong>{$text['thumb']}</strong>&nbsp;</td>\n";
	$body .= "<td class=\"fieldnameback fieldname\">&nbsp;<strong>{$text['description']}</strong>&nbsp;</td>\n";

	while( $hs = tng_fetch_assoc( $hsresult ) ) {
		$hs['allow_living'] = 1;
		$hs['allow_private'] = !$hs['private'] || $allow_private;

		$mediatypeID = $hs['mediatypeID'];
		$usefolder = $hs['usecollfolder'] ? $mediatypes_assoc[$mediatypeID] : $mediapath;
		if($hs['allow_private']) {
			$description = $hs['description'];
			$notes = nl2br($hs['notes']);
		}
		else {
			$description = $text['livingphoto'];
			$notes = "";
		}

		$imgsrc = getSmallPhoto($hs);
		$href = getMediaHREF($hs,3);

		$body .= "<tr><td valign=\"top\" class=\"databack\"><span class=\"normal\">$i</span></td>";
		$body .= "<td valign=\"top\" class=\"databack\" align=\"center\" width=\"$thumbmaxw\">";
		if($imgsrc) {
			$body .= "<div class=\"media-img\"><div class=\"media-prev\" id=\"prev{$hs['mediaID']}\" style=\"display:none\"></div></div>\n";
			$body .= "<a href=\"$href\"";
			if( $gotImageJpeg && checkMediaFileSize("$rootpath$usefolder/{$hs['path']}") )
				$body .=  " class=\"media-preview\" id=\"img-{$hs['mediaID']}-0-" . urlencode("$usefolder/{$hs['path']}") . "\"";
			$body .= ">$imgsrc</a>\n";
		}
		else {
			$body .= "&nbsp;";
		}

		$body .= "</td>\n";
		$body .= "<td valign=\"top\" class=\"databack\"><span class=\"normal\">";
		$body .= "<a href=\"$href\">$description</a><br/>$notes&nbsp;</span></td></tr>\n";
		$i++;
	}
	$body .= "</table>\n";
	$body .= "</div>\n<br/>\n";
}
tng_free_result( $hsresult );

if($tree) {
	$wherestr = " AND ($media_table.gedcom = \"$tree\" || $media_table.gedcom = \"\")";
	$wherestr2 = " AND $medialinks_table.gedcom = \"$tree\"";
}
else
	$wherestr = $wherestr2 = "";

$query = "SELECT DISTINCT $media_table.mediaID, description, notes, path, thumbpath, status, plot, showmap, usecollfolder, mediatypeID, latitude, longitude, zoom, form, abspath, newwindow
	FROM $media_table LEFT JOIN $medialinks_table on $media_table.mediaID = $medialinks_table.mediaID
	WHERE cemeteryID = \"$cemeteryID\" $wherestr AND mediatypeID = \"headstones\" AND linktocem != \"1\" ORDER BY description LIMIT $newoffset" . $maxsearchresults;
$hsresult = tng_query($query);

$numrows = tng_num_rows( $hsresult );
if($numrows) {
	$body .= "<div class=\"titlebox\">\n";
	$body .= "<span class=\"subhead\"><b>{$text['headstone']}</b></span><br /><br />\n";

	if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
		$query = "SELECT count(DISTINCT $media_table.mediaID) as hscount FROM $media_table LEFT JOIN $medialinks_table on $media_table.mediaID = $medialinks_table.mediaID WHERE cemeteryID = \"$cemeteryID\" $wherestr AND linktocem != \"1\"";
		$result2 = tng_query($query);
		$row = tng_fetch_assoc( $result2 );
		$totrows = $row['hscount'];
	}
	else
		$totrows = $numrows;

	$pagenav = get_browseitems_nav( $totrows, $showmap_url . "cemeteryID=$cemeteryID&amp;tree=$tree&amp;offset", $maxsearchresults, 5 );
	if( $pagenav ) $body .= "<p>$pagenav</p>";

	$header = $headerr = "";
	$headerr = $enablemodeswitch ? "data-tablesaw-mode-switch>\n" : ">\n" . $header;
	$headerr = $enableminimap ? " data-tablesaw-minimap " . $headerr : $headerr;
	$tabledef = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" width=\"100%\" class=\"tablesaw thfixed whiteback\" ";

	if ($tabletype == "toggle")
		$header = $tabledef . "data-tablesaw-mode=\"columntoggle\"" . $headerr;
	elseif ($tabletype == "stack")
		$header = $tabledef . "data-tablesaw-mode=\"stack\"" . $headerr;
	elseif ($tabletype == "swipe")
		$header = $tabledef . "data-tablesaw-mode=\"swipe\"" . $headerr;
	else
		$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" width=\"100%\" class=\"thfixed whiteback\">\n" . $header;

	$body .= $header;
	$body .= "<thead><tr>\n";
	$body .= "<th data-tablesaw-priority=\"persist\" class=\"fieldnameback\"><span class=\"fieldname\">&nbsp;{$text['thumb']}</span></th>";
	$body .= "<th data-tablesaw-priority=\"1\" class=\"fieldnameback\"><span class=\"fieldname\">&nbsp;{$text['description']}</span></th>";
	$body .= "<th data-tablesaw-priority=\"6\" class=\"fieldnameback\"><span class=\"fieldname\">&nbsp;{$text['status']}</span></th>";
	$body .= "<th data-tablesaw-priority=\"4\" class=\"fieldnameback\"><span class=\"fieldname\">&nbsp;{$text['location']}</span></th>";
	$body .= "<th data-tablesaw-priority=\"3\" class=\"fieldnameback\"><span class=\"fieldname\">&nbsp;{$text['name']} ({$text['diedburied']})</span></th>";
	$body .= "</tr></thead>\n";

	while( $hs = tng_fetch_assoc( $hsresult ) )
	{
		$mediatypeID = $hs['mediatypeID'];
		$hs['cemeteryID'] = $cemeteryID;
		$usefolder = $hs['usecollfolder'] ? $mediatypes_assoc[$mediatypeID] : $mediapath;

		$status = $hs['status'];
		if($status && $text[$status]) $hs['status'] = $text[$status];

		$query = "SELECT medialinkID, $medialinks_table.personID as personID, people.personID as personID2, familyID, people.living as living, people.private as private, people.branch as branch, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr,
			$families_table.branch as fbranch, $families_table.living as fliving, $families_table.private as fprivate, husband, wife, people.lastname as lastname, people.lnprefix as lnprefix, people.firstname as firstname,
			people.prefix as prefix, people.suffix as suffix, nameorder, people.title as title, $medialinks_table.gedcom as gedcom, treename, $sources_table.title as stitle, $sources_table.sourceID, $repositories_table.repoID,reponame, deathdate, burialdate, linktype
			FROM ($medialinks_table, $trees_table)
			LEFT JOIN $people_table AS people ON ($medialinks_table.personID = people.personID AND $medialinks_table.gedcom = people.gedcom)
			LEFT JOIN $families_table ON ($medialinks_table.personID = $families_table.familyID AND $medialinks_table.gedcom = $families_table.gedcom)
			LEFT JOIN $sources_table ON ($medialinks_table.personID = $sources_table.sourceID AND $medialinks_table.gedcom = $sources_table.gedcom)
			LEFT JOIN $repositories_table ON ($medialinks_table.personID = $repositories_table.repoID AND $medialinks_table.gedcom = $repositories_table.gedcom)
			WHERE mediaID = \"{$hs['mediaID']}\" AND $medialinks_table.gedcom = $trees_table.gedcom $wherestr2 ORDER BY lastname, lnprefix, firstname, $medialinks_table.personID";
		$presult = tng_query($query);
		$hslinktext = "";
		$noneliving = $noneprivate = 1;
		while( $prow = tng_fetch_assoc( $presult ) )
		{
			$hstext = "";
			if( $prow['personID2'] != NULL ) {
				$prights = determineLivingPrivateRights($prow);
				$prow['allow_living'] = $prights['living'];
				$prow['allow_private'] = $prights['private'];

				if(!$prow['allow_living']) $noneliving = 0;
				if(!$prow['allow_private']) $noneprivate = 0;

				$hslinktext .= "<a href=\"$getperson_url" . "personID={$prow['personID2']}&amp;tree={$prow['gedcom']}\">";
				$hslinktext .= getName( $prow );
				$deathdate = $prow['deathdate'] ? $prow['deathdate'] : $prow['burialdate'];
				if( $prow['deathdate'] ) $abbrev = $text['deathabbr'];
				elseif( $prow['burialdate'] ) $abbrev = $text['burialabbr'];
				$hstext = $deathdate ? " ($abbrev " . displayDate( $deathdate ) . ")" : "";
			}
			elseif( $prow['familyID'] != NULL ) {
				$prow['living'] = $prow['fliving'];
				$prow['private'] = $prow['fprivate'];

				$prights = determineLivingPrivateRights($prow);
				$prow['allow_living'] = $prights['living'];
				$prow['allow_private'] = $prights['private'];

				if(!$prow['allow_living']) $noneliving = 0;
				if(!$prow['allow_private']) $noneprivate = 0;

				$hslinktext .= "<a href=\"$familygroup_url" . "familyID={$prow['familyID']}&amp;tree={$prow['gedcom']}\">{$text['family']}: " . getFamilyName( $prow );
			}
			elseif( $prow['sourceID'] != NULL ) {
				$sourcetext = $prow['stitle'] ? "{$text['source']}: {$prow['stitle']}" : "{$text['source']}: {$prow['sourceID']}";
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
		$notes = nl2br( $hs['notes'] );

		$body .= "<tr><td valign=\"top\" class=\"databack\" align=\"center\" style=\"width:$thumbmaxw" . "px\">";
		$hs['allow_living'] = $noneliving;
		$hs['allow_private'] = $noneprivate;
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

		$body .= "<td valign=\"top\" class=\"databack\"><span class=\"normal\"><a href=\"$href\">{$hs['description']}</a><br />$notes&nbsp;</span></td>\n";
		$body .= "<td valign=\"top\" class=\"databack\"><span class=\"normal\">{$hs['status']}&nbsp;</span></td>\n";
		$body .= "<td valign=\"top\" class=\"databack\"><span class=\"normal\">" . nl2br($hs['plot']);
		if( $hs['latitude'] || $hs['longitude'] ) {
			$pin_num = $map['pins'] + 1;
			$coords = "$pin_num. {$text['latitude']}: {$hs['latitude']}, {$text['longitude']}: {$hs['longitude']}";
			if($hs['plot']) {
				$body .= "<br />";
				$hs['plot'] .= " | $coords";
			}
			else
				$hs['plot'] = $coords;
			$body .= $coords;

			$balloondesc = @htmlspecialchars($description, ENT_QUOTES, $session_charset);
			//$balloonnotes = @htmlspecialchars($notes, ENT_QUOTES, $session_charset);
			$balloonnotes = tng_real_escape_string($notes);
			$balloonloc = @htmlspecialchars($hs['plot'], ENT_QUOTES, $session_charset);
			$balloonloc = tng_real_escape_string($balloonloc);
			$escaped_imgsrc = str_replace("'","\'",$imgsrc);
			$escaped_imgsrc = str_replace("\n","",$escaped_imgsrc);
			$locations2map[$l2mCount] = array(
				"placelevel"=>2,
				"pinplacelevel"=>$pinplacelevel2,
				"event"=>$text['headstonefor'],
				"htmlcontent"=>"<div class=\"mapballoon normal\">$escaped_imgsrc<strong><p>$balloondesc</strong></p><p>$balloonnotes</p><p>$balloonloc</p></div>",
				"lat"=>$hs['latitude'],
				"long"=>$hs['longitude'],
				"zoom"=>$hs['zoom'],
				"place"=>$description,
				"notes"=>truncateIt($notes,600),
				//"eventdate"=>"date",
				"description"=>$description,
				"fixedplace"=>$balloondesc
			);
			$l2mCount++;
			$map['pins']++;
			$index_all++;
		}
		$body .= "&nbsp;</span></td>\n";
		$body .= "<td valign=\"top\" class=\"databack\"><span class=\"normal\">$hslinktext&nbsp;</span></td>\n";
		$body .= "</tr>\n";
	}
	$body .= "</table>\n";
	if( $pagenav ) $body .= "<p>$pagenav</p>";
	$body .= "</div>\n";
}
tng_free_result($hsresult);

if($cemetery['place']) {
	$treestr = $tree ? "and $people_table.gedcom = \"$tree\"" : "";
	$query = "SELECT * FROM ($people_table, $trees_table) WHERE burialplace = \"" . addslashes($cemetery['place']) . "\" and $people_table.gedcom = $trees_table.gedcom $treestr ORDER BY lastname, firstname";
	$result = tng_query($query);
	if(tng_num_rows($result)) {
		$body .= "<br/><div class=\"titlebox\">\n";
		$body .= "<span class=\"subhead\"><b>{$text['allburials']}</b></span><br /><br />\n";

		$header = $headerr = "";
		$headerr = $enablemodeswitch ? "data-tablesaw-mode-switch>\n" : ">\n" . $header;
		$headerr = $enableminimap ? " data-tablesaw-minimap " . $headerr : $headerr;
		$tabledef = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" width=\"100%\" class=\"tablesaw thfixed whiteback\" ";

		if ($tabletype == "toggle")
			$header = $tabledef . "data-tablesaw-mode=\"columntoggle\"" . $headerr;
		elseif ($tabletype == "stack")
			$header = $tabledef . "data-tablesaw-mode=\"stack\"" . $headerr;
		elseif ($tabletype == "swipe")
			$header = $tabledef . "data-tablesaw-mode=\"swipe\"" . $headerr;
		else
			$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" width=\"100%\" class=\"whiteback normal\">\n" . $header;

		$body .= $header;
		$body .= "<thead><tr>\n";
		$body .= "<th data-tablesaw-priority=\"persist\" class=\"fieldnameback nbrcol\"><span class=\"fieldname\">&nbsp;#&nbsp;</span></th>\n";
		$body .= "<th data-tablesaw-priority=\"1\" class=\"fieldnameback\"><span class=\"fieldname nw\">&nbsp;{$text['lastfirst']}&nbsp;</span></th>\n";
		$body .= "<th data-tablesaw-priority=\"2\" colspan=\"2\" class=\"fieldnameback\"><span class=\"fieldname\">&nbsp;<b>{$text['buried']}</b>&nbsp;</span></th>\n";
		$body .= "<th data-tablesaw-priority=\"3\" class=\"fieldnameback\"><span class=\"fieldname nw\">&nbsp;{$text['personid']}&nbsp;</span></th>\n";
		if($numtrees > 1) {
			$body .= "<th data-tablesaw-priority=\"3\" class=\"fieldnameback\"><span class=\"fieldname\">&nbsp;{$text['tree']}&nbsp;</span></th>\n";
		}
		$body .= "</tr></thead>\n";

		$i = 1;
		while( $row = tng_fetch_assoc( $result ) ) {
			$row['allow_living'] = 1;

			$rights = determineLivingPrivateRights($row);
			$row['allow_living'] = $rights['living'];
			$row['allow_private'] = $rights['private'];

			$name = getNameRev( $row );
			$body .= "<tr><td class=\"databack\">$i.</td>\n";
			$body .= "<td class=\"databack\"><a href=\"$pedigree_url" . "personID={$row['personID']}&amp;tree={$row['gedcom']}\">$chartlink</a> <a href=\"$getperson_url" . "personID={$row['personID']}&amp;tree={$row['gedcom']}\">$name</a>&nbsp;</td>\n";

			$placetxt = $row['burialplace'] . " <a href=\"$placesearch_url" . "tree=$tree&amp;psearch=" . urlencode( $row['burialplace'] ) . "\" title=\"{$text['findplaces']}\"><img src=\"{$cms['tngpath']}img/tng_search_small.gif\" class=\"placeimg\" border=\"0\" alt=\"{$text['findplaces']}\" width=\"9\" height=\"9\"></a>";

			$deathdate = $row['burialdate'] ? $row['burialdate'] : $row['deathdate'];
			if( $row['burialdate'] ) $abbrev = $text['burialabbr'];
			elseif( $row['deathdate'] ) $abbrev = $text['deathabbr'];
			$burialdate = $deathdate ? "$abbrev " . displayDate( $deathdate ) : "";

			$body .= "<td class=\"databack\">&nbsp;" . $burialdate . "</span></td>\n";
			$body .= "<td class=\"databack\"><span class=\"normal\">$placetxt&nbsp;</span></td>";
			$body .= "<td class=\"databack\">{$row['personID']}</td>\n";
			if($numtrees > 1)
				$body .= "<td class=\"databack\"><a href=\"$showtree_url" . "tree={$row['gedcom']}\">{$row['treename']}</a>&nbsp;</td>\n";
			$i++;
		}

		$body .= "</table>\n";
		$body .= "</div>\n";
	}
	tng_free_result($result);
}

if($map['key'] && ($cemcoords || $map['pins'])) {
	echo "<div id=\"map\" style=\"width: {$map['hstw']}; height: {$map['hsth']};\" class=\"rounded10 cemmap\"></div>\n";
	if($cemcoords && empty($map['pins'])) {
		$locations2map[$l2mCount] = $cempin;
		$map['pins'] = 1;
	}
}
echo $body;

tng_footer($flags);
?>