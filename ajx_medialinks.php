<?php
include("begin.php");
include("adminlib.php");
if(!$mediaID) die("no args");

$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

include($cms['tngpath'] . "checklogin.php");

initMediaTypes();

$query = "SELECT * FROM $media_table WHERE mediaID = \"$mediaID\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
tng_free_result($result);
$row['firstname'] = preg_replace("/\"/", "&#34;",$row['firstname']);

if( !$allow_media_edit && !$allow_media_add) {
	$message = $admtext['norights'];
	header( "Location: ajx_login.php?message=" . urlencode($message) );
	exit;
}

if( $assignedtree ) {
	$wherestr = "WHERE gedcom = \"$assignedtree\"";
	$tree = $assignedtree;
}
else
	$wherestr = "";
$treequery = "SELECT gedcom, treename FROM $trees_table $wherestr ORDER BY treename";
$treeresult = tng_query($treequery) or die ($admtext['cannotexecutequery'] . ": $treequery");
$treenum = 0;
while( $treerow = tng_fetch_assoc($treeresult) ) {
	$treenum++;
	$trees[$treenum] = $treerow['gedcom'];
	$treename[$treenum] = $treerow['treename'];
}
tng_free_result($treeresult);

$query = "SELECT $medialinks_table.medialinkID as mlinkID, $medialinks_table.personID as personID, eventID, people.lastname as lastname, people.lnprefix as lnprefix, people.firstname as firstname, people.prefix as prefix, people.suffix as suffix, people.nameorder as nameorder, altdescription, altnotes, $medialinks_table.gedcom as gedcom, people.branch as branch, treename,
	familyID, people.personID as personID2, wifepeople.personID as wpersonID, wifepeople.firstname as wfirstname, wifepeople.lnprefix as wlnprefix, wifepeople.lastname as wlastname, wifepeople.prefix as wprefix, wifepeople.suffix as wsuffix, wifepeople.nameorder as wnameorder,
	husbpeople.personID as hpersonID, husbpeople.firstname as hfirstname, husbpeople.lnprefix as hlnprefix, husbpeople.lastname as hlastname, husbpeople.prefix as hprefix, husbpeople.suffix as hsuffix, husbpeople.nameorder as hnameorder,
	sourceID, sources.title, repositories.repoID as repoID, reponame, defphoto, linktype, dontshow, people.living, people.private, $families_table.living as fliving, $families_table.private as fprivate
	FROM $medialinks_table
	LEFT JOIN $trees_table as trees ON $medialinks_table.gedcom = trees.gedcom
	LEFT JOIN $people_table AS people ON $medialinks_table.personID = people.personID AND $medialinks_table.gedcom = people.gedcom
	LEFT JOIN $families_table ON $medialinks_table.personID = $families_table.familyID AND $medialinks_table.gedcom = $families_table.gedcom
	LEFT JOIN $sources_table AS sources ON $medialinks_table.personID = sources.sourceID AND $medialinks_table.gedcom = sources.gedcom
	LEFT JOIN $repositories_table AS repositories ON $medialinks_table.personID = repositories.repoID AND $medialinks_table.gedcom = repositories.gedcom
	LEFT JOIN $people_table AS husbpeople ON $families_table.husband = husbpeople.personID AND $families_table.gedcom = husbpeople.gedcom
	LEFT JOIN $people_table AS wifepeople ON $families_table.wife = wifepeople.personID AND $families_table.gedcom = wifepeople.gedcom
	WHERE mediaID = \"$mediaID\" ORDER BY $medialinks_table.medialinkID DESC";
$result2 = tng_query($query);

header("Content-type:text/html; charset=" . $session_charset);
?>

<table width="100%" border="0" cellpadding="10" cellspacing="0">
	<tr class="databack">
		<td>
			<span class="subhead"><strong><?php echo $admtext['medialinks']; ?></strong></span><br/><br/>
			<form action="" name="form1" id="form1">
			<?php include("micro_medialinks.php"); ?>
			</form>
		</td>
	</tr>
</table>