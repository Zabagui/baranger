<?php
$textpart = "sources";
include("tng_begin.php");

if(!$sourceID) {header( "Location: thispagedoesnotexist.html" ); exit;}

include($cms['tngpath'] . "personlib.php" );

$showsource_url = getURL( "showsource", 1 );
$showrepo_url = getURL( "showrepo", 1 );
$getperson_url = getURL( "getperson", 1 );
$familygroup_url = getURL( "familygroup", 1 );
$placesearch_url = getURL( "placesearch", 1 );
$showalbum_url = getURL("showalbum",1);

$flags['imgprev'] = true;

$firstsection = 1;
$firstsectionsave = "";
$tableid = "";
$cellnumber = 0;

$query = "SELECT sourceID, title, shorttitle, author, publisher, actualtext, reponame, $sources_table.repoID as repoID, callnum, other FROM $sources_table LEFT JOIN $repositories_table on $sources_table.repoID = $repositories_table.repoID AND $sources_table.gedcom = $repositories_table.gedcom WHERE $sources_table.sourceID = \"$sourceID\" AND $sources_table.gedcom = \"$tree\"";
$result = tng_query($query);
$srcrow = tng_fetch_assoc($result);
if( !tng_num_rows($result) ) {
	tng_free_result($result);
	header( "Location: thispagedoesnotexist.html" );
	exit;
}
tng_free_result($result);

$query = "SELECT count(personID) as ccount FROM $citations_table, $people_table
	WHERE $citations_table.sourceID = '$sourceID' AND $citations_table.gedcom = \"$tree\" AND $citations_table.persfamID = $people_table.personID AND $citations_table.gedcom = $people_table.gedcom
	AND (living = '1' OR private = '1')";
$sresult = tng_query($query);
$srow = tng_fetch_assoc( $sresult );
$srcrow['living'] = $srcrow['private'] = $srow['ccount'] ? 1 : 0;

$righttree = checktree($tree);
$rightbranch = $righttree ? true : false;
$srcrow['allow_living'] = $allow_living;
$srcrow['allow_private'] = $allow_private;
$rights['both'] = $allow_living && $allow_private;

tng_free_result( $sresult );

$srcnotes = getNotes( $sourceID, "S" );
getCitations( $sourceID );

$logstring = "<a href=\"$showsource_url" . "sourceID=$sourceID&amp;tree=$tree\">" . xmlcharacters($text['source'] . " {$srcrow['title']} ($sourceID)") . "</a>";
writelog($logstring);
preparebookmark($logstring);

$headtext = $srcrow['title'] ? $srcrow['title'] : $srcrow['shorttitle'];
tng_header( $headtext, $flags );

$srcmedia = getMedia( $srcrow, "S" );
$srcalbums = getAlbums( $srcrow, "S" );
$photostr = showSmallPhoto( $sourceID, $headtext, $rights['both'], 0 );
echo tng_DrawHeading( $photostr, $headtext, "" );

$sourcetext = "";
$sourcetext .= "<ul class=\"nopad\">\n";
$sourcetext .= beginSection("info");
$sourcetext .= "<table cellspacing=\"1\" cellpadding=\"4\" class=\"whiteback tfixed\">\n";
$sourcetext .= "<col class=\"labelcol\"/><col style=\"width:{$datewidth}px\"/><col/>\n";
if( $srcrow['title'] )
	$sourcetext .= showEvent( array( "text"=>$text['title2'], "fact"=>insertLinks($srcrow['title']) ) );
if( $srcrow['shorttitle'] )
	$sourcetext .= showEvent( array( "text"=>$text['shorttitle'], "fact"=>insertLinks($srcrow['shorttitle']) ) );
//if( $srcrow[type] ) $sourcetext .= showEvent( array( "text"=>$text['type'], "fact"=>$srcrow['type'] ) );
if( $srcrow['author'] )
	$sourcetext .= showEvent( array( "text"=>$text['author'], "fact"=>$srcrow['author'] ) );
if( $srcrow['publisher'] )
	$sourcetext .= showEvent( array( "text"=>$text['publisher'], "fact"=>$srcrow['publisher'] ) );
if( $srcrow['callnum'] )
	$sourcetext .= showEvent( array( "text"=>$text['callnum'], "fact"=>$srcrow['callnum'] ) );
if( $srcrow['reponame'] )
	$sourcetext .= showEvent( array( "text"=>$text['repository'], "fact"=>"<a href=\"$showrepo_url" . "repoID={$srcrow['repoID']}&amp;tree=$tree\">{$srcrow['reponame']}</a>" ) );
if( $srcrow['other'] )
	$sourcetext .= showEvent( array( "text"=>$text['other'], "fact"=>$srcrow['other'] ) );

//do custom events
resetEvents();
doCustomEvents($sourceID,"S");

if(!$tngconfig['sortbydate'])
	ksort( $events );
foreach( $events as $event )
	$sourcetext .= showEvent( $event );
if( $allow_admin && $allow_edit && $righttree )
	$sourcetext .= showEvent( array( "text"=>$text['sourceid'], "date"=>$sourceID, "place"=>"<a href=\"{$cms['tngpath']}admin_editsource.php?sourceID=$sourceID&amp;tree=$tree&amp;cw=1\" target=\"blank\">{$text['edit']}</a>", "np"=>1  ) );
else
	$sourcetext .= showEvent( array( "text"=>$text['sourceid'], "date"=>$sourceID  ) );

if( empty($ioffset) ) $ioffset = 0;
if( $ioffset ) {
	$ioffsetstr = "$ioffset, ";
	$newioffset = $ioffset + 1;
}
else {
	$ioffsetstr = "";
	$newioffset = 0;
}
if( empty($foffset) ) $foffset = 0;
if( !empty($foffset) ) {
	$foffsetstr = "$foffset, ";
	$newfoffset = $foffset + 1;
}
else {
	$foffsetstr = "";
	$newfoffset = 0;
}

$query = "SELECT DISTINCT $citations_table.persfamID, $citations_table.gedcom, personID, firstname, lnprefix, lastname, prefix, suffix, nameorder, title, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr, living, private, branch FROM $citations_table, $people_table WHERE $citations_table.persfamID = $people_table.personID AND $citations_table.gedcom = $people_table.gedcom AND $citations_table.gedcom = \"$tree\" AND $citations_table.sourceID = '$sourceID' ORDER BY lastname, firstname LIMIT $ioffsetstr" . ($maxsearchresults + 1);
$sresult = tng_query($query);
$numrows = tng_num_rows( $sresult );
$total_citations = $numrows;
$sourcelinktext = "";
$noneliving = $noneprivate = 1;
while( $srow = tng_fetch_assoc( $sresult ) ) {
	if( $sourcelinktext ) $sourcelinktext .= "\n";

	$srights = determineLivingPrivateRights($srow, $righttree);
	$srow['allow_living'] = $srights['living'];
	$srow['allow_private'] = $srights['private'];

	if(!$srow['allow_living']) $noneliving = 0;
	if(!$srow['allow_private']) $noneprivate = 0;

	$sourcelinktext .= "<a href=\"$getperson_url" . "personID={$srow['persfamID']}&amp;tree={$srow['gedcom']}\">";
	$sourcelinktext .= getName( $srow );
	$sourcelinktext .= "</a>";
}

if( $srcrow['actualtext'] ) {
	if( (!$noneliving && !$srcrow['allow_living']) || (!$noneprivate && !$srcrow['allow_private'])) $srcrow['actualtext'] = $text['livingphoto'];
	$sourcetext .= showEvent( array( "text"=>$text['text'], "fact"=>$srcrow['actualtext'] ) );
}

if( $numrows > $maxsearchresults )
	$sourcelinktext .= "\n[<a href=\"$showsource_url" . "sourceID=$sourceID&amp;tree=$tree&amp;foffset=$foffset&amp;ioffset=" . ($newioffset + $maxsearchresults) . "\">{$text['moreind']}</a>]";
tng_free_result( $sresult );

$query = "SELECT DISTINCT $citations_table.persfamID, $citations_table.gedcom, familyID, husband, wife, living, private, branch FROM $citations_table, $families_table WHERE $citations_table.persfamID = $families_table.familyID AND $citations_table.gedcom = $families_table.gedcom AND $citations_table.gedcom = \"$tree\" AND $citations_table.sourceID = '$sourceID' ORDER BY familyID LIMIT $foffsetstr" . ($maxsearchresults + 1);
$sresult = tng_query($query);
$numrows = tng_num_rows( $sresult );
$total_citations += $numrows;
$noneliving = $noneprivate = 1;
while( $srow = tng_fetch_assoc( $sresult ) ) {
	if( $sourcelinktext ) $sourcelinktext .= "\n";

	$srights = determineLivingPrivateRights($srow, $righttree);
	$srow['allow_living'] = $srights['living'];
	$srow['allow_private'] = $srights['private'];

	if(!$srow['allow_living']) $noneliving = 0;
	if(!$srow['allow_private']) $noneprivate = 0;

	$sourcelinktext .= "<a href=\"$familygroup_url" . "familyID={$srow['familyID']}&amp;tree={$srow['gedcom']}\">{$text['family']}: " . getFamilyName( $srow ) . "</a>";
}
if( $numrows >= $maxsearchresults ) 
	$sourcelinktext .= "\n[<a href=\"$showsource_url" . "sourceID=$sourceID&amp;tree=$tree&amp;ioffset=$ioffset&amp;foffset=" . ($newfoffset + $maxsearchresults) . "\">{$text['morefam']}</a>]";
tng_free_result( $sresult );

if( $sourcelinktext )
	$sourcetext .= showEvent( array( "text"=>$text['indlinked'] . " ($total_citations)", "fact"=>$sourcelinktext ) );

$sourcetext .= "</table>\n";
$sourcetext .= "<br/>\n";
$sourcetext .= endSection("info");

$media = doMediaSection($sourceID,$srcmedia,$srcalbums);
if($media) {
	$sourcetext .= beginSection("media");
	$sourcetext .= $media . "<br/>\n";
	$sourcetext .= endSection("media");
}

$notes = buildNotes( $srcnotes, "" );
if( $notes ) { 
	$sourcetext .= beginSection("notes");
	$sourcetext .= "<table cellspacing=\"1\" cellpadding=\"4\"  class=\"whiteback tfixed\">\n";
	$sourcetext .= "<col class=\"labelcol\"/><col/>\n";
	$sourcetext .= "<tr>\n";
	$sourcetext .= "<td valign=\"top\" class=\"fieldnameback indleftcol\" id=\"notes1\"><span class=\"fieldname\">&nbsp;{$text['notes']}&nbsp;</span></td>\n";
	$sourcetext .= "<td valign=\"top\" class=\"databack\">$notes</td>\n";
	$sourcetext .= "</tr>\n";
	$sourcetext .= "</table>\n";
	$sourcetext .= "<br/>\n";
	$sourcetext .= endSection("notes");
}
$sourcetext .= "</ul>\n";

$tng_alink = $tng_plink = "lightlink";
$innermenu = $num_collapsed ? "<div style=\"float:right\"><a href=\"#\" onclick=\"return toggleCollapsed(0)\" class=\"lightlink\">Expand all</a> &nbsp; | &nbsp; <a href=\"#\" onclick=\"return toggleCollapsed(1)\" class=\"lightlink\">Collapse all</a> &nbsp;</div>" : "";
if( $notes || $media ) {
	if( $tngconfig['istart'] )
		$tng_plink = "lightlink3";
	else
		$tng_alink = "lightlink3";
	$innermenu .= "<a href=\"#\" class=\"$tng_plink\" onclick=\"return infoToggle('info');\" id=\"tng_plink\">{$text['srcinfo']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	if( $media )
		$innermenu .= "<a href=\"#\" class=\"lightlink\" onclick=\"return infoToggle('media');\" id=\"tng_mlink\">{$text['media']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	if( $notes )
		$innermenu .= "<a href=\"#\" class=\"lightlink\" onclick=\"return infoToggle('notes');\" id=\"tng_nlink\">{$text['notes']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"#\" class=\"$tng_alink\" onclick=\"return infoToggle('all');\" id=\"tng_alink\">{$text['all']}</a>\n";
}
else
	$innermenu .= "<span class=\"lightlink3\" id=\"tng_plink\">{$text['srcinfo']}</span>\n";

echo tng_menu( "S", "source", $sourceID, $innermenu );
?>	
<script type="text/javascript">
function innerToggle(part,subpart,subpartlink) {
	if( part == subpart )
		turnOn(subpart,subpartlink);
	else
		turnOff(subpart,subpartlink);
}

function turnOn(subpart,subpartlink) {
	jQuery('#'+subpartlink).attr('class','lightlink3');
	jQuery('#'+subpart).show();
}

function turnOff(subpart,subpartlink) {
	jQuery('#'+subpartlink).attr('class','lightlink');
	jQuery('#'+subpart).hide();
}

function infoToggle(part) {
	if( part == "all" ) {
		jQuery('#info').show();
<?php
	if( $media ) {
		echo "\$('#media').show();\n";
		echo "\$('#tng_mlink').attr('class','lightlink');\n";
	}
	if( $notes ) {
		echo "\$('#notes').show();\n";
		echo "\$('#tng_nlink').attr('class','lightlink');\n";
	}
?>
		jQuery('#tng_alink').attr('class','lightlink3');
		jQuery('#tng_plink').attr('class','lightlink');
	}
	else {	
		innerToggle(part,"info","tng_plink");
<?php
	if( $media )
		echo "innerToggle(part,\"media\",\"tng_mlink\");\n";
	if( $notes )
		echo "innerToggle(part,\"notes\",\"tng_nlink\");\n";
?>
		jQuery('#tng_alink').attr('class','lightlink');
	}
	return false;
}
</script>

<?php
	echo $sourcetext;
?>
<br />

<?php
tng_footer( $flags );
?>