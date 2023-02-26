<?php
global $cms, $people_table, $trees_table;

$getperson_url = getURL( "getperson", 1 );
$showmedia_url = getURL( "showmedia", 1 );
$familygroup_url = getURL( "familygroup", 1 );
$showsource_url = getURL( "showsource", 1 );
$showrepo_url = getURL( "showrepo", 1 );
$whatsnew_url = getURL( "whatsnew", 1 );
$pedigree_url = getURL( "pedigree", 1 );
$placesearch_url = getURL( "placesearch", 1 );
$showtree_url = getURL( "showtree", 1 );
$showmap_url = getURL( "showmap", 1 );

$_SESSION['tng_mediatree'] = $tree;
$_SESSION['tng_mediasearch'] = "";

$flags['imgprev'] = true;

if( $tree ) {
	$wherestr = "($media_table.gedcom = \"$tree\" || $media_table.gedcom = \"\") AND ";
	$wherestr2 = " AND $medialinks_table.gedcom = \"$tree\"";
}
else
	$wherestr = $wherestr2 = "";

$change_limit = 10;

function doMedia( $mediatypeID ) {
	global $media_table, $medialinks_table, $wherestr, $text, $admtext, $families_table, $citations_table, $nonames;
	global $people_table, $showmedia_url, $currentuser;
	global $rootpath, $photopath, $header, $footer, $mediatypes_assoc, $mediatypes_display;
	global $livedefault, $wherestr2, $thumbmaxw, $tngconfig, $maxmediafilesize, $hsfields, $cutoffstr;

	$change_limit = 5;

	$query = "SELECT distinct $media_table.mediaID as mediaID, description, $media_table.notes, thumbpath, path, form, mediatypeID, $media_table.gedcom as gedcom, alwayson, usecollfolder, DATE_FORMAT(changedate,'%e %b %Y') as changedatef, changedby, status, plot, abspath, newwindow, private $hsfields
		FROM $media_table";
	if( $wherestr2 )
		$query .= " LEFT JOIN $medialinks_table on $media_table.mediaID = $medialinks_table.mediaID";
	$query .= " WHERE $cutoffstr $wherestr mediatypeID = \"$mediatypeID\" ORDER BY ";
	if(strpos($_SERVER['SCRIPT_NAME'],"placesearch") !== FALSE)
		$query .= "ordernum";
	else
		$query .= "changedate DESC, description";
	$query .= " LIMIT $change_limit";
	$mediaresult = tng_query($query);

	$titlemsg = $text[$mediatypeID] ? $text[$mediatypeID] : $mediatypes_display[$mediatypeID];
	$mediaheader = "<div class=\"titlebox tablediv\"><span class=\"subhead\"><b>$titlemsg</b></span><br /><br /><div>\n";

	$mediatext = "";
	$thumbcount = 0;
	$gotImageJpeg = function_exists('imageJpeg');

	while( $row = tng_fetch_assoc( $mediaresult ) ) {
		$mediatypeID = $row['mediatypeID'];
		$usefolder = $row['usecollfolder'] ? $mediatypes_assoc[$mediatypeID] : $mediapath;

		$query = "SELECT medialinkID, $medialinks_table.personID as personID, familyID, people.living as living, people.private as private, people.branch as branch,
			birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr, husband, wife,
			$families_table.branch as fbranch, $families_table.living as fliving, $families_table.private as fprivate, 
			$medialinks_table.gedcom as gedcom, linktype
			FROM $medialinks_table
			LEFT JOIN $people_table AS people ON ($medialinks_table.personID = people.personID AND $medialinks_table.gedcom = people.gedcom)
			LEFT JOIN $families_table ON ($medialinks_table.personID = $families_table.familyID AND $medialinks_table.gedcom = $families_table.gedcom)
			WHERE mediaID = \"{$row['mediaID']}\"$wherestr2 ORDER BY lastname, lnprefix, firstname, $medialinks_table.personID";
		$presult = tng_query($query);
		$foundliving = 0;
		$foundprivate = $row['private'] && !$allow_private;
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
		}
		tng_free_result( $presult );

		$row['allow_living'] = !$foundliving || $row['alwayson'];
		$row['allow_private'] = !$foundprivate || $row['alwayson'];
		$showPhotoInfo = $row['allow_living'] && $row['allow_private'];

		//$href = $showmedia_url . "mediaID=$row[mediaID]";
		$href = getMediaHREF($row,0);
		$notes = nl2br( truncateIt(getXrefNotes($row['notes'],$row['gedcom']),$tngconfig['maxnoteprev']) );
		$description = $row['description'];

		if( $row['allow_living'] ) {
			$description = $showPhotoInfo ? "<a href=\"$href\">$description</a>" : $description;
		}
		else {
			$nonamesloc = $row['private'] ? $tngconfig['nnpriv'] : $nonames;
			if($nonamesloc) {
				$description = $text['livingphoto'];
				$notes = "";
			}
			else {
				$notes = $notes ? $notes . "<br />({$text['livingphoto']})" : "({$text['livingphoto']})";
			}
			$href = "";
		}
		//if( $row[status] ) $notes = "$text[status]: $row[status]. $notes";

		$mediatext .= "<div class=\"inner-block\">";
		$row['mediatypeID'] = $mediatypeID;
		$imgsrc = getSmallPhoto($row);
		if($imgsrc) {
			$mediatext .= "<div style=\"float:left;margin-right:10px;width:{$thumbmaxw}px;text-align:center\">";
			if($href && $row['allow_living']) {
				$mediatext .= "<a href=\"$href\">$imgsrc</a>";
			}
			else
				$mediatext .= $imgsrc;
			$mediatext .= "</div><div>";
			$thumbcount++;
		}
		else
			$mediatext .= "<div>";

		$mediatext .= "$description<br />$notes&nbsp;</div><div style=\"clear:both;\"></div>";
		$mediatext .= "</div><div style=\"clear:both;\"></div>";
	}
	tng_free_result($mediaresult);

	return $mediatext ? $mediaheader . $mediatext . "</div></div>\n<br />\n" : "";
}
echo "<div style=\"display:table;width:100%\">\n<div style=\"display:table-row\">";
echo doMedia( "photos" );

if( $tree )
	$allwhere = "AND p.gedcom = \"$tree\"";
else
	$allwhere = "";

$more = getLivingPrivateRestrictions("p", false, false);
if($more)
	$allwhere .= " AND " .$more;

//select from people where date later than cutoff, order by changedate descending, limit = 10
$query = "SELECT p.personID, lastname, lnprefix, firstname, birthdate, prefix, suffix, title, nameorder, living, private, branch, DATE_FORMAT(changedate,'%e %b %Y') as changedatef, changedby, LPAD(SUBSTRING_INDEX(birthdate, ' ', -1),4,'0') as birthyear, birthdate, birthdatetr, birthplace, altbirthdate, altbirthdatetr, LPAD(SUBSTRING_INDEX(altbirthdate, ' ', -1),4,'0') as altbirthyear, altbirthplace, deathdate, deathdatetr, p.gedcom as gedcom, treename
	FROM $people_table as p, $trees_table WHERE p.gedcom = $trees_table.gedcom $allwhere
	ORDER BY changedate DESC, lastname, firstname, birthyear, altbirthyear LIMIT $change_limit";
$result = tng_query($query);
if(tng_num_rows( $result )) {
?>
<div class="titlebox tablediv"><span class="subhead"><b><?php echo $text['individuals']; ?></b></span><br /><br />
<?php
	$chartlinkimg = @GetImageSize($cms['tngpath'] . "img/Chart.gif");
	$chartlink = "<img src=\"{$cms['tngpath']}img/Chart.gif\" border=\"0\" alt=\"\" $chartlinkimg[3] />";
	while( $row = tng_fetch_assoc($result))
	{
		$rights = determineLivingPrivateRights($row);
		$row['allow_living'] = $rights['living'];
		$row['allow_private'] = $rights['private'];
		$namestr = getNameRev( $row );
		if( $rights['both'] ) {
			if ( $row['birthdate'] || $row['birthplace'] ) {
				$birthdate = $text['birthabbr'] . " " . displayDate( $row['birthdate'] );
				$birthplace = $row['birthplace'];
			}
			else if ( $row['altbirthdate'] || $row['altbirthplace'] ) {
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
		echo "<div class=\"inner-block\">\n";
		echo "<a href=\"$pedigree_url" . "personID={$row['personID']}&amp;tree={$row['gedcom']}\">$chartlink</a> <a href=\"$getperson_url" . "personID={$row['personID']}&amp;tree={$row['gedcom']}\" id=\"p{$row['personID']}_t{$row['gedcom']}\">$namestr</a>";
		if($birthdate || $birthplace) {
			echo "<br/>&nbsp;&nbsp;&nbsp;";
			if($birthdate) {
				echo "$birthdate";
				if($birthplace)
					echo ", ";
			}
			if($birthplace)
				echo $birthplace;
		}
		echo "</div>\n";
	}
	tng_free_result($result);
?>
</div>
<?php
}
?>
</div>
</div>