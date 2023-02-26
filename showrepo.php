<?php
$textpart = "sources";
include("tng_begin.php");

if(!$repoID) {header( "Location: thispagedoesnotexist.html" ); exit;}

include($cms['tngpath'] . "personlib.php" );

$showrepo_url = getURL( "showrepo", 1 );
$showsource_url = getURL( "showsource", 1 );
$getperson_url = getURL( "getperson", 1 );
$showalbum_url = getURL("showalbum",1);

$flags['imgprev'] = true;

$firstsection = 1;
$firstsectionsave = "";
$tableid = "";
$cellnumber = 0;

$query = "SELECT * FROM $repositories_table WHERE repoID = \"$repoID\" AND gedcom = \"$tree\"";
$result = tng_query($query);
$reporow = tng_fetch_assoc($result);
if( !tng_num_rows($result) ) {
	tng_free_result($result);
	header( "Location: thispagedoesnotexist.html" );
	exit;
}
tng_free_result($result);

$righttree = checktree($tree);
$rightbranch = $righttree ? true : false;

$reporow['living'] = 0;
$reporow['allow_living'] = 1;

$reponotes = getNotes( $repoID, "R" );

$logstring = "<a href=\"$showrepo_url" . "repoID=$repoID&amp;tree=$tree\">{$text['repository']} {$reporow['reponame']} ($repoID)</a>";
writelog($logstring);
preparebookmark($logstring);

tng_header( $reporow['reponame'], $flags );

$repomedia = getMedia( $reporow, "R" );
$repoalbums = getAlbums( $reporow, "R" );
$photostr = showSmallPhoto( $repoID, $reporow['reponame'], $reporow['allow_living'], 0 );
echo tng_DrawHeading( $photostr, $reporow['reponame'], "" );

$repotext = "";
$repotext .= "<ul class=\"nopad\">\n";
$repotext .= beginSection("info");
$repotext .= "<table cellspacing=\"1\" cellpadding=\"4\" class=\"whiteback tfixed\">\n";
$repotext .= "<col class=\"labelcol\"/><col style=\"width:{$datewidth}px\"/><col/>\n";
if( $reporow['reponame'] )
	$repotext .= showEvent( array( "text"=>$text['name'], "fact"=>$reporow['reponame'] ) );
if( $reporow['addressID'] ) {
	$reporow['isrepo'] = true;
	$reporow['age'] = $reporow['agency'] = $reporow['cause'] = "";
	$extras = getFact( $reporow );
	$repotext .= showEvent( array( "text"=>$text['address'], "fact"=>$extras ) );
}

//do custom events
resetEvents();
doCustomEvents($repoID,"R");

if(!$tngconfig['sortbydate'])
	ksort( $events );
foreach( $events as $event )
	$repotext .= showEvent( $event );
if( $allow_admin && $allow_edit && $righttree)
	$repotext .= showEvent( array( "text"=>$text['repoid'], "date"=>$repoID, "place"=>"<a href=\"{$cms['tngpath']}" . "admin_editrepo.php?repoID=$repoID&amp;tree=$tree&amp;cw=1\" target=\"blank\">{$text['edit']}</a>", "np"=>1 ) );
else
	$repotext .= showEvent( array( "text"=>$text['repoid'], "date"=>$repoID ) );

if( !empty($soffset) ) {
	$soffsetstr = "$soffset, ";
	$newsoffset = $soffset + 1;
}
else {
	$soffsetstr = "";
	$newsoffset = 0;
}

$query = "SELECT sourceID, title, shorttitle FROM $sources_table WHERE gedcom = \"$tree\" AND repoID = '$repoID' ORDER BY title LIMIT $soffsetstr" . ($maxsearchresults + 1);
$sresult = tng_query($query);
$numrows = tng_num_rows( $sresult );
$repolinktext = "";
while( $srow = tng_fetch_assoc( $sresult ) ) {
	if( $repolinktext ) $repolinktext .= "\n";
	$title = $srow['shorttitle'] ? $srow['shorttitle'] : $srow['title'];
	$repolinktext .= "<a href=\"$showsource_url" . "sourceID={$srow['sourceID']}&amp;tree=$tree\">$title</a>";
}

if( $numrows >= $maxsearchresults ) 
	$repolinktext .= "\n[<a href=\"$showrepo_url" . "repoID=$repoID&amp;tree=$tree&amp;soffset=" . ($newsoffset + $maxsearchresults) . "\">{$text['moresrc']}</a>]";
tng_free_result( $sresult );

if( $repolinktext )
	$repotext .= showEvent( array( "text"=>$text['indlinked'], "fact"=>$repolinktext ) );

$repotext .= "</table>\n";
$repotext .= "<br/>\n";
$repotext .= endSection("info");

$media = doMediaSection($repoID,$repomedia,$repoalbums);
if($media) {
	$repotext .= beginSection("media");
	$repotext .= $media;
	$repotext .= endSection("media");
}

$notes = buildNotes( $reponotes, "" );
if( $notes ) {
	$repotext .= beginSection("notes");
	$repotext .= "<table cellspacing=\"1\" cellpadding=\"4\" class=\"whiteback tfixed\">\n";
	$repotext .= "<col class=\"labelcol\"/><col/>\n";
	$repotext .= "<tr>\n";
	$repotext .= "<td valign=\"top\" class=\"fieldnameback indleftcol\" id=\"notes1\"><span class=\"fieldname\">&nbsp;{$text['notes']}&nbsp;</span></td>\n";
	$repotext .= "<td valign=\"top\" class=\"databack\">$notes</td>\n";
	$repotext .= "</tr>\n";
	$repotext .= "</table>\n";
	$repotext .= "<br/>\n";
	$repotext .= endSection("notes");
}
$repotext .= "</ul>\n";

$tng_alink = $tng_plink = "lightlink";
$innermenu = $num_collapsed ? "<div style=\"float:right\"><a href=\"#\" onclick=\"return toggleCollapsed(0)\" class=\"lightlink\">Expand all</a> &nbsp; | &nbsp; <a href=\"#\" onclick=\"return toggleCollapsed(1)\" class=\"lightlink\">Collapse all</a> &nbsp;</div>" : "";
if( $media || $notes ) {
	if( $tngconfig['istart'] )
		$tng_plink = "lightlink3";
	else
		$tng_alink = "lightlink3";
	$innermenu .= "<a href=\"#\" class=\"$tng_plink\" onclick=\"return infoToggle('info');\" id=\"tng_plink\">{$text['repoinfo']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	if( $media )
		$innermenu .= "<a href=\"#\" class=\"lightlink\" onclick=\"return infoToggle('media');\" id=\"tng_mlink\">{$text['media']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	if( $notes )
		$innermenu .= "<a href=\"#\" class=\"lightlink\" onclick=\"return infoToggle('notes');\" id=\"tng_nlink\">{$text['notes']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"#\" class=\"$tng_alink\" onclick=\"return infoToggle('all');\" id=\"tng_alink\">{$text['all']}</a>\n";
}
else
	$innermenu .= "<span class=\"lightlink3\" id=\"tng_plink\">{$text['repoinfo']}</span>\n";

$rightbranch = 1;
echo tng_menu( "R", "repo", $repoID, $innermenu );
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
	echo $repotext;
?>
<br />

<?php
tng_footer( $flags );
?>