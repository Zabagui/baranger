<?php
$textpart = "search";
$needMap = true;
include("tng_begin.php");

if( !$psearch ) exit;
include($cms['tngpath'] . "personlib.php" );

$searchform_url = getURL( "searchform", 1 );
$search_url = getURL( "search", 1 );
$placesearch_url = getURL( "placesearch", 1 );
$getperson_url = getURL( "getperson", 1 );
$showtree_url = getURL( "showtree", 1 );
$pedigree_url = getURL( "pedigree", 1 );
$showmedia_url = getURL( "showmedia", 1 );
$familygroup_url = getURL( "familygroup", 1 );
$showsource_url = getURL( "showsource", 1 );
$showrepo_url = getURL( "showrepo", 1 );
$showalbum_url = getURL("showalbum",1);
$showmap_url = getURL("showmap",1);

@set_time_limit(0);
$psearch = preg_replace("/[<>{};!=]/", '', $psearch);
$psearchns = $psearch;
$psearch = addslashes($psearch);

$querystring = $psearchns;
$cutoffstr = "personID = \"$psearch\"";
$whatsnew = 0;
$mcharsetstr = "&amp;oe=$session_charset";


if( !empty($order) )
	$_SESSION['tng_psearch_order'] = $order;
else
	$order = isset($_SESSION['tng_psearch_order']) ? $_SESSION['tng_psearch_order'] : "name";
	
if($order != "name" && $order != "nameup" && $order != "date" && $order != "dateup")
	$order = "";

$datesort = "dateup";
$namesort = "name";
$orderloc = strpos($_SERVER['QUERY_STRING'],"&amp;order=");
$currargs = $orderloc > 0 ? substr($_SERVER['QUERY_STRING'],0,$orderloc) : $_SERVER['QUERY_STRING'];
	
$treequery = "SELECT count(gedcom) as treecount FROM $trees_table";
$treeresult = tng_query($treequery);
$treerow = tng_fetch_assoc($treeresult);
$numtrees = $treerow['treecount'];
tng_free_result($treeresult);

if($order == "name") {
	$namesort = "<a href=\"$placesearch_url$currargs&amp;order=nameup\" class=\"lightlink\">xxx <img src=\"{$cms['tngpath']}img/tng_sort_desc.gif\" width=\"15\" height=\"8\" border=\"0\" alt=\"\" /></a>";
}
else { 
	$namesort = "<a href=\"$placesearch_url$currargs&amp;order=name\" class=\"lightlink\">xxx <img src=\"{$cms['tngpath']}img/tng_sort_asc.gif\" width=\"15\" height=\"8\" border=\"0\" alt=\"\" /></a>";
}

if($order == "date") {
	$datesort = "<a href=\"$placesearch_url$currargs&amp;order=dateup\" class=\"lightlink\">yyy <img src=\"{$cms['tngpath']}img/tng_sort_desc.gif\" width=\"15\" height=\"8\" border=\"0\" alt=\"\" /></a>";
}
else { 
	$datesort = "<a href=\"$placesearch_url$currargs&amp;order=date\" class=\"lightlink\">yyy <img src=\"{$cms['tngpath']}img/tng_sort_asc.gif\" width=\"15\" height=\"8\" border=\"0\" alt=\"\" /></a>";
}
	
function processEvents($prefix, $stdevents, $displaymsgs) {
	global $eventtypes_table, $text, $tree, $people_table, $families_table, $trees_table, $offset, $page, $psearch, $maxsearchresults, $numtrees;
	global $placesearch_url, $psearchns, $urlstring, $cms, $familygroup_url, $pedigree_url, $getperson_url, $events_table, $showtree_url, $order, $namesort, $datesort, $tngconfig;

	$successcount = 0;
	$allwhere = "";
	if($prefix == "I") {
		$table = $people_table;
		$peoplejoin1 = $peoplejoin2 = "";
		$idfield = "personID";
		$idtext = "personid";
		$namefield = "lastfirst";
	}
	elseif($prefix == "F") {
		$table = $families_table;
		$peoplejoin1 = " LEFT JOIN $people_table as p1 ON $families_table.gedcom = p1.gedcom AND p1.personID = $families_table.husband";
		$peoplejoin2 = " LEFT JOIN $people_table as p2 ON $families_table.gedcom = p2.gedcom AND p2.personID = $families_table.wife";
		$idfield = "familyID";
		$idtext = "familyid";
		$namefield = "family";
	}

	$allwhere .= "$table.gedcom = $trees_table.gedcom";
	if($tree) {
		$allwhere .= " AND $table.gedcom=\"$tree\"";
	}

	$more = getLivingPrivateRestrictions($table, false, false);
	if($more) {
		if($allwhere)
			$allwhere .= " AND ";
		$allwhere .= $more;
	}

	$max_browsesearch_pages = 5;
	if( $offset ) {
		$offsetplus = $offset + 1;
		$newoffset = "$offset, ";
	}
	else {
		$offsetplus = 1;
		$newoffset = "";
		$page = 1;
	}

	$tngevents = $stdevents;
	$custevents = array();
	$query = "SELECT tag, eventtypeID, display FROM $eventtypes_table
		WHERE keep=\"1\" AND type=\"$prefix\" ORDER BY display";
	$result = tng_query($query);
	while( $row = tng_fetch_assoc( $result ) ) {
		$eventtypeID = $row['eventtypeID'];
		array_push( $tngevents, $eventtypeID );
		array_push( $custevents, $eventtypeID );
		$displaymsgs[$eventtypeID] = getEventDisplay($row['display']);
	}
	tng_free_result($result);

	foreach( $tngevents as $tngevent ) {
		$eventsjoin = "";
		$allwhere2 = "";
		$placetxt = $displaymsgs[$tngevent];

		if(in_array($tngevent,$custevents)) {
			$eventsjoin = ", $events_table";
			//$allwhere2 .= " AND $table.$idfield = $events_table.persfamID AND $table.gedcom = $events_table.gedcom AND eventtypeID = \"$tngevent\"";
			$allwhere2 .= " AND $table.$idfield = $events_table.persfamID AND $table.gedcom = $events_table.gedcom AND eventtypeID = \"$tngevent\" AND parenttag = \"\"";
			$tngevent = "event";
		}

		$datefield = $tngevent . "date";
		$datefieldtr = $tngevent . "datetr";
		$place = $tngevent . "place";
		$allwhere2 .= " AND $place = '$psearch'";

		if($prefix == "F") {
			if($order == "name")
				$orderstr = "p1lastname, p2lastname, $datefieldtr";
			elseif($order == "nameup")
				$orderstr = "p1lastname DESC, p2lastname DESC, $datefieldtr DESC";
			elseif($order == "date")
				$orderstr = "$datefieldtr, p1lastname, p2lastname";
			else 
				$orderstr = "$datefieldtr DESC, p1lastname DESC, p2lastname DESC";
				
			$query = "SELECT $families_table.ID, $families_table.familyID, husband, wife, $families_table.living, $families_table.private, $families_table.branch, p1.lastname as p1lastname, p2.lastname as p2lastname, $place, $datefield, $families_table.gedcom, treename
				FROM ($families_table, $trees_table $eventsjoin) $peoplejoin1 $peoplejoin2
				WHERE $allwhere $allwhere2
				ORDER BY $orderstr LIMIT $newoffset" . $maxsearchresults;

		}
		elseif($prefix == "I") {
			if($order == "name")
				$orderstr = "lastname, firstname, $datefieldtr";
			elseif($order == "nameup")
				$orderstr = "lastname DESC, firstname DESC, $datefieldtr DESC";
			elseif($order == "date")
				$orderstr = "$datefieldtr, lastname, firstname";
			else 
				$orderstr = "$datefieldtr DESC, lastname DESC, firstname DESC";
				
			$query = "SELECT $people_table.ID, $people_table.personID, lastname, lnprefix, firstname, $people_table.living, $people_table.private, $people_table.branch, prefix, suffix, nameorder, title, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr, $place, $datefield, $people_table.gedcom, treename
				FROM ($people_table, $trees_table $eventsjoin)
				WHERE $allwhere $allwhere2
				ORDER BY $orderstr LIMIT $newoffset" . $maxsearchresults;
		}

		//echo $query . "<br><br>";
		$result = tng_query($query);
		$numrows = tng_num_rows( $result );

		//if results, do again w/o pagination to get total
		if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
			$query = "SELECT count($idfield) as rcount
				FROM ($table, $trees_table $eventsjoin)
				WHERE $allwhere $allwhere2";
			$result2 = tng_query($query);
			$countrow = tng_fetch_assoc($result2);
			$totrows = $countrow['rcount'];
		}
		else
			$totrows = $numrows;

		if ( $numrows ) {
			echo "<br/>\n<div class=\"titlebox\">\n";
			echo "<span class=\"subhead\"><strong>" . $placetxt . "</strong></span><br />";
			$numrowsplus = $numrows + $offset;
			$successcount++;

			echo "<p>{$text['matches']} $offsetplus {$text['to']} $numrowsplus {$text['of']} $totrows</p>";

			$pagenav = get_browseitems_nav( $totrows, "$placesearch_url" . "$urlstring&amp;psearch=" . urlencode($psearchns) . "&amp;order=$order&amp;offset", $maxsearchresults, $max_browsesearch_pages );
			if($pagenav)
				echo "<p>$pagenav</p>";
			$namestr = preg_replace( "/xxx/", $text[$namefield], $namesort );
			$datestr = preg_replace( "/yyy/", $placetxt, $datesort );
?>

	<table cellpadding="3" cellspacing="1" border="0" width="100%" class="thfixed whiteback normal">
		<tr>
			<th class="fieldnameback"><span class="fieldname">&nbsp;</span></th>
			<th class="fieldnameback"><span class="fieldname nw">&nbsp;<b><?php echo $namestr; ?></b>&nbsp;</span></th>
			<th class="fieldnameback" colspan="2"><span class="fieldname">&nbsp;<b><?php echo $datestr; ?></b>&nbsp;</span></th>
			<th class="fieldnameback"><span class="fieldname nw">&nbsp;<b><?php echo $text[$idtext]; ?></b>&nbsp;</span></th>
<?php
	if($numtrees > 1) {
?>
			<th class="fieldnameback"><span class="fieldname">&nbsp;<b><?php echo $text['tree']; ?></b>&nbsp;</span></th>
<?php
	}
?>
		</tr>

<?php
			$i = $offsetplus;
			$chartlinkimg = @GetImageSize($cms['tngpath'] . "img/Chart.gif");
			$chartlink = "<img src=\"{$cms['tngpath']}img/Chart.gif\" border=\"0\" $chartlinkimg[3] alt=\"\" />";
			while( $row = tng_fetch_assoc($result))
			{
				$rights = determineLivingPrivateRights($row);
				$row['allow_living'] = $rights['living'];
				$row['allow_private'] = $rights['private'];
				if($rights['both']) {
					$placetxt = $row[$place] ? $row[$place] : "";
					$dateval = $row[$datefield];
				}
				else
					$dateval = $placetxt = "";
				echo "<tr>";

				echo "<td class=\"databack\"><span class=\"normal\">$i</span></td>\n";
				$i++;
				echo "<td class=\"databack\"><span class=\"normal\">";
				if($prefix == "F") {
					echo "<a href=\"$familygroup_url" . "familyID={$row['familyID']}&amp;tree={$row['gedcom']}\">{$row['p1lastname']} / {$row['p2lastname']}</a>";
				}
				elseif($prefix == "I") {
					$name = getNameRev( $row );
					echo "<a href=\"$pedigree_url" . "personID={$row['personID']}&amp;tree={$row['gedcom']}\">$chartlink</a> <a href=\"$getperson_url" . "personID={$row['personID']}&amp;tree={$row['gedcom']}\">$name</a>";
				}
				echo "&nbsp;</span></td>";
				echo "<td class=\"databack\"><span class=\"normal\">&nbsp;" . displayDate($dateval) . "</span></td><td class=\"databack\"><span class=\"normal\">$placetxt&nbsp;</span></td>";
				echo "<td class=\"databack\"><span class=\"normal\">{$row[$idfield]} </span></td>";
				if($numtrees > 1)
					echo "<td class=\"databack\"><span class=\"normal\"><a href=\"$showtree_url" . "tree={$row['gedcom']}\">{$row['treename']}</a>&nbsp;</span></td>";
				echo "</tr>\n";
			}
			tng_free_result($result);
?>

	</table>

<?php
			if($pagenav)
				echo "<p>$pagenav</p><br />";
			echo "</div>\n";
		}
	}
	return $successcount;
}

//don't allow default tree here
$tree = $orgtree;
$tngconfig['istart'] = 0;

$ldsOK = determineLDSRights();

if($tree && !$tngconfig['places1tree']) {
	$urlstring = "&amp;tree=$tree";
	$logurlstring = "&amp;tree=$tree";
	$wherestr2 = " AND $places_table.gedcom = \"$tree\" ";

	$query = "SELECT treename FROM $trees_table WHERE gedcom = \"$tree\"";
	$treeresult = tng_query($query);
	$treerow = tng_fetch_assoc($treeresult);
	tng_free_result($treeresult);
}
else {
	$urlstring = $logurlstring = $wherestr2 = $treerow['treename'] = "";
}

if(!$tngconfig['places1tree']) {
	$querystring .= " {$text['and']} tree {$text['equals']} {$treerow['treename']} ";
	$treejoin = " LEFT JOIN $trees_table on $places_table.gedcom = $trees_table.gedcom";
	$treename = ", treename";
}
else
	$treejoin = $treename = "";

$logstring = "<a href=\"$placesearch_url" . "psearch=$psearchns$logurlstring\">{$text['searchresults']} $querystring</a>";
writelog($logstring);
preparebookmark($logstring);


if( $map['key'] && $isConnected) {
	if( !isset($flags['scripting']) ) $flags['scripting'] = "";
	$flags['scripting'] .= "<script type=\"text/javascript\" src=\"{$http}://maps.googleapis.com/maps/api/js?language={$text['glang']}$mapkeystr\"></script>\n";
}
tng_header( $psearchns, $flags );

$photostr = showSmallPhoto( $psearch, $psearch, 1, 0 );

echo tng_DrawHeading( $photostr, $psearchns, "" );

//show the notes and media for each tree (if none specified)

//first do media
$pquery = "SELECT placelevel,latitude,longitude,zoom,notes,$places_table.gedcom$treename FROM $places_table$treejoin WHERE place = \"$psearch\"$wherestr2";
$presult = tng_query($pquery) or die ($text['cannotexecutequery'] . ": $pquery");

if(!$tngconfig['places1tree'])
	$rightbranch = checktree($tree);
else
	$rightbranch = 1;
$innermenu = "&nbsp;\n";
echo tng_menu( "L", "place", $psearch, $innermenu );

$altstr = ", altdescription, altnotes";
$mapdrawn = false;
$foundtree = "";
while( $prow = tng_fetch_assoc( $presult ) ) {
	$foundtree = $prow['gedcom'];
	if( $prow['notes'] || $prow['latitude'] || $prow['longitude'] ) {
		if( ($prow['latitude'] || $prow['longitude']) && $map['key'] && !$mapdrawn ) {
			echo "<br /><div id=\"map\" style=\"width: {$map['indw']}; height: {$map['indh']}; margin-bottom:20px;\" class=\"rounded10\"></div>\n";
			$usedplaces = array();
			$mapdrawn = true;
		}
        if(!$tngconfig['places1tree'] && $numtrees > 1)
    		echo "<p><strong>{$text['tree']}:</strong> {$prow['treename']}</p>\n";
		if( $prow['notes'] ) {
			$notes = nl2br( getXrefNotes($prow['notes'],$prow['gedcom']) );
			echo "<p><strong>{$text['notes']}:</strong><br />\n" . nl2br(insertLinks($notes)) . "</p>";
		}
		if( $map['key'] ) {
			$lat = $prow['latitude'];
			$long = $prow['longitude'];
			$zoom = $prow['zoom'] ? $prow['zoom'] : 10;
			$placelevel = $prow['placelevel'] ? $prow['placelevel'] : "0";
			$pinplacelevel = ${"pinplacelevel" . $placelevel};
			$placeleveltext = $placelevel > 0 ? $admtext['level'.$placelevel] . "&nbsp;:&nbsp;" : "";
			$codedplace = @htmlspecialchars(str_replace($banish, $banreplace, $psearchns), ENT_QUOTES, $session_charset);
			$codednotes = $prow['notes'] ? "<br /><br />" . tng_real_escape_string($text['notes'] . ": " . $prow['notes']) : "";
				// add external link to Google Maps for Directions in the balloon
			$codednotes .= "<br /><br /><a href=\"{$http}://maps.google.com/maps?f=q&amp;hl={$text['glang']}$mcharsetstr&amp;daddr=$lat,$long($codedplace)&amp;z=$zoom&amp;om=1&amp;iwloc=addr\" target=\"_blank\">{$text['getdirections']}</a>{$text['directionsto']} $codedplace";
			if($lat && $long) {
               			$uniqueplace = $psearch . $lat . $long;
				if($map['showallpins'] || !in_array($uniqueplace,$usedplaces)) {
					$usedplaces[] = $uniqueplace;
					$locations2map[$l2mCount]= array("place"=>$codedplace,"pinplacelevel"=>$pinplacelevel,"lat"=>$lat,"long"=>$long,"zoom"=>$zoom,"htmlcontent"=>"<div class=\"mapballoon normal\">$placeleveltext<br />$codedplace$codednotes</div>");
					$l2mCount++;
				}
			}

			echo "<a href=\"{$http}://maps.google.com/maps?f=q&amp;hl={$text['glang']}$mcharsetstr&amp;daddr=$lat,$long($codedplace)&amp;z=12&amp;om=1&amp;iwloc=addr\" target=\"_blank\"><img src=\"{$cms['tngpath']}google_marker.php?image=$pinplacelevel.png&amp;text=$l2mCount\" alt=\"\" border=\"0\" /></a><strong>$placeleveltext</strong><span class=\"normal\"><strong>{$text['latitude']}:</strong> {$prow['latitude']}, <strong>{$text['longitude']}:</strong> {$prow['longitude']}</span><br /><br />";
			$map['pins']++;
		}
		elseif( $prow['latitude'] || $prow['longitude'] )
			echo "<p><strong>{$text['latitude']}:</strong> {$prow['latitude']}, <strong>{$text['longitude']}:</strong> {$prow['longitude']}</p><br />";
	}
}
if(!$tree && tng_num_rows($presult) == 1)
	$tree = $foundtree;
tng_free_result($presult);

$placemedia = getMedia( $psearch, "L" );
$placealbums = getAlbums( $psearch, "L" );
$media = doMediaSection($psearch,$placemedia,$placealbums);
if($media) {
	echo "<br/>\n<div class=\"titlebox\">\n";
	echo "<span class=\"subhead\"><strong>{$text['media']}</strong></span><br/><br/>";
	echo "$media\n";
	echo "</div>\n";
}

$pquery = "SELECT cemname, city, county, state, country, cemeteryID FROM $cemeteries_table WHERE place = \"$psearch\"";
$presult = tng_query($pquery) or die ($text['cannotexecutequery'] . ": $pquery");
$cemdata = "";
$i = 1;
while( $prow = tng_fetch_assoc( $presult ) ) {
	$country = stripslashes($prow['country']);
	$state = stripslashes($prow['state']);
	$county = stripslashes($prow['county']);
	$city = stripslashes($prow['city']);
	$location = $city;
	if( $location && $county ) $location .= ", $county"; else $location = $county;
	if( $location && $state ) $location .= ", $state"; else $location = $state;
	if( $location && $country ) $location .= ", $country"; else $location = $country;
	$cemdata .= "<tr><td class=\"databack\">$i.</td><td class=\"databack\"><a href=\"$showmap_url" . "cemeteryID={$prow['cemeteryID']}\">{$prow['cemname']}</a></td><td class=\"databack\">$location</td></tr>\n";
	$i++;
}

if($cemdata) {
	echo "<br/>\n<div class=\"titlebox\">\n";
	echo "<span class=\"subhead\"><strong>{$text['cemeteries']}</strong></span><br/><br/>";
	echo "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" width=\"100%\" class=\"whiteback\">\n";
	echo "<tr>\n";
	echo "<td class=\"fieldnameback\"><span class=\"fieldname\">&nbsp;</span></td>\n";
	echo "<td class=\"fieldnameback\"><span class=\"fieldname\"><nobr>&nbsp;<b>{$text['name']}</b>&nbsp;</nobr></span></td>\n";
	echo "<td class=\"fieldnameback\"><span class=\"fieldname\"><nobr>&nbsp;<b>{$text['location']}</b>&nbsp;</nobr></span></td>\n";
	echo "</tr>\n";
	echo "$cemdata</table>\n";
	echo "</div>\n";
}

$successcount = 0;

//then loop over events like anniversaries
$stdevents = array("birth","altbirth","death","burial");
$displaymsgs = array("birth" => $text['birth'],"altbirth"=> $admtext['CHR'],"death"=> $text['death'],"burial"=> $text['burial']);
//$dontdo = array("ADDR","BIRT","CHR","DEAT","BURI","NAME","NICK","TITL","NSFX");
if($ldsOK) {
	array_push($stdevents,"endl", "init", "conf", "bapt");
	$displaymsgs['endl'] = $text['endowedlds'];
	$displaymsgs['init'] = $text['initlds'];
	$displaymsgs['conf'] = $text['conflds'];
	$displaymsgs['bapt'] = $text['baptizedlds'];
}
$successcount += processEvents("I",$stdevents,$displaymsgs);

$stdevents = array("marr","div");
$displaymsgs = array("marr" => $text['marriage'],"div"=> $text['divorce']);
if($ldsOK) {
	array_push($stdevents,"seal");
	$displaymsgs['seal'] = $text['sealedslds'];
}
$successcount += processEvents("F",$stdevents,$displaymsgs);

if( !$successcount )
	echo "<p>{$text['noresults']}.</p>";

tng_footer( "" );
?>