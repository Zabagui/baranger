<?php
$textpart = "notes";
include("tng_begin.php");

include($cms['tngpath'] . "functions.php");

$browsenotes_url = getURL( "browsenotes", 1 );
$showsource_url = getURL( "showsource", 1 );
$getperson_url = getURL( "getperson", 1 );
$familygroup_url = getURL( "familygroup", 1 );

function doNoteSearch( $instance, $pagenav ) {
	global $text, $notesearch, $tree;

	$browsenotes_noargs_url = getURL( "browsenotes", 0 );
	
	$str = "<div class=\"normal\">\n";
	$str .= getFORM( "browsenotes", "get", "notesearch$instance", "" );
	$str .= "<input type=\"text\" name=\"notesearch\" value=\"$notesearch\" /> <input type=\"submit\" value=\"{$text['search']}\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	$str .= $pagenav;
	if( $notesearch )
		$str .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"$browsenotes_noargs_url\">{$text['browseallnotes']}</a>";
	$str .= "<input type=\"hidden\" name=\"tree\" value=\"$tree\" />\n";
	$str .= "</form></div>\n";
	
	return $str;
}

$max_browsenote_pages = 5;
if( !isset($offset) ) $offset = 0;
if( $offset ) {
	$offsetplus = $offset + 1;
	$newoffset = "$offset, ";
}
else {
	$offset = 0;
	$offsetplus = 1;
	$newoffset = "";
	$page = 1;
}

$wherestr = "WHERE $xnotes_table.ID = $notelinks_table.xnoteID";
if( $tree ) {
	$wherestr .= " AND $xnotes_table.gedcom = \"$tree\"";
}
if(!$allow_private_notes) $wherestr .= " AND $notelinks_table.secret != \"1\"";
if( !isset($notesearch) ) $notesearch = "";
if( $notesearch ) {
	$notesearch2 = addslashes($notesearch);
	$notesearch = cleanIt(stripslashes($notesearch));

	$wherestr .= " AND match($xnotes_table.note) against( \"{$notesearch2}*\" in boolean mode)";
}

$query = "SELECT $xnotes_table.ID as ID, $xnotes_table.note as note, $notelinks_table.persfamID as personID, $xnotes_table.gedcom as gedcom, secret
	FROM ($xnotes_table, $notelinks_table)
	$wherestr ORDER BY note LIMIT $newoffset" . $maxsearchresults;
$result = tng_query($query);

	//LEFT JOIN $families_table ON $notelinks_table.persfamID = $families_table.familyID AND $notelinks_table.gedcom = $families_table.gedcom
	//LEFT JOIN $sources_table ON $notelinks_table.persfamID = $sources_table.sourceID AND $notelinks_table.gedcom = $sources_table.gedcom
	//LEFT JOIN $repositories_table ON $notelinks_table.persfamID = $repositories_table.repoID AND $notelinks_table.gedcom = $repositories_table.gedcom
	//LEFT JOIN $people_table ON $notelinks_table.persfamID = $people_table.personID AND $notelinks_table.gedcom = $people_table.gedcom

$numrows = tng_num_rows( $result );

if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
	$query = "SELECT count($xnotes_table.ID) as scount FROM ($xnotes_table, $notelinks_table)
		LEFT JOIN $trees_table on $xnotes_table.gedcom = $trees_table.gedcom
		$wherestr";
	$result2 = tng_query($query);
	$row = tng_fetch_assoc( $result2 );
	$totrows = $row['scount'];
}
else
	$totrows = $numrows;

$numrowsplus = $numrows + $offset;

$treestr = $tree ? " ({$text['tree']}: $tree)" : "";
$logstring = "<a href=\"$browsenotes_url" . "tree=$tree&amp;offset=$offset&amp;notesearch=" . htmlentities(stripslashes($notesearch), ENT_QUOTES) . "\">" . xmlcharacters($text['notes'] . $treestr) . "</a>";
writelog($logstring);
preparebookmark($logstring);

tng_header( $text['notes'], $flags );
?>

<h1 class="header"><span class="headericon" id="notes-hdr-icon"></span><?php echo $text['notes']; ?></h1><br clear="left"/>
<?php
echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'browsenotes', 'method' => 'get', 'name' => 'form1', 'id' => 'form1'));

if( $totrows )
	echo "<p class=\"normal\">{$text['matches']} " . number_format($offsetplus) . " {$text['to']} " . number_format($numrowsplus) . " {$text['of']} " . number_format($totrows) . "</p>";

$pagenav = get_browseitems_nav( $totrows, $browsenotes_url . "notesearch=$notesearch&amp;offset", $maxsearchresults, $max_browsenote_pages );
echo doNoteSearch( 1, $pagenav );
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
?>
	<thead>
		<tr>
		<th data-tablesaw-priority="persist" class="fieldnameback nbrcol fieldname">&nbsp;#&nbsp;</th>
		<th data-tablesaw-priority="1" class="fieldnameback nw fieldname">&nbsp;<?php echo $text['notes']; ?>&nbsp;</th>
		<th data-tablesaw-priority="2" class="fieldnameback fieldname">&nbsp;<?php echo $text['indlinked']; ?>&nbsp;</th>
		</tr>
	</thead>
<?php
$i = $offsetplus;
while( $nrow = tng_fetch_assoc( $result ) )
{
	$notelinktext = "";
	$noneliving = $noneprivate = $noneprivatenotes = 1;
	$query2 = $query;

	if(!$notelinktext) {
		$query = "SELECT * FROM $people_table WHERE personID = \"{$nrow['personID']}\" AND gedcom = \"{$nrow['gedcom']}\"";
		$result2 = tng_query($query);
		if(tng_num_rows($result2) == 1) {
			$row2 = tng_fetch_assoc($result2);

			if( !$row2['living'] || !$row2['private'] ) {
				$query = "SELECT count(personID) as ccount FROM $citations_table, $people_table
					WHERE $citations_table.sourceID = '{$nrow['personID']}' AND $citations_table.persfamID = $people_table.personID AND $citations_table.gedcom = $people_table.gedcom
					AND (living = '1' OR private = '1')";
				$nresult2 = tng_query($query);
				$nrow2 = tng_fetch_assoc( $nresult2 );
				if( $nrow2['ccount'] ) {
					$row2['living'] = 1;
					$row2['private'] = 1;
				}
				tng_free_result( $nresult2 );
			}

			$nrights = determineLivingPrivateRights($row2);
			$row2['allow_living']  = $nrights['living'];
			$row2['allow_private'] = $nrights['private'];
			$row2['allow_private_notes'] = $nrights['private_notes'];

			if(!$row2['allow_living']) $noneliving = 0;
			if(!$row2['allow_private']) $noneprivate = 0;
			if(!$row2['allow_private_notes'] && $nrow['secret'] == 1) $noneprivatenotes = 0;

			$notelinktext .= "<a href=\"{$getperson_url}personID={$row2['personID']}&amp;tree={$row2['gedcom']}\" target='_blank'>" . getNameRev($row2) . "</a> ({$row2['personID']})\n<br/>\n";
			tng_free_result($result2);
		}
	}

	if(!$notelinktext) {
		$query = "SELECT * FROM $families_table WHERE familyID = \"{$nrow['personID']}\" AND gedcom = \"{$nrow['gedcom']}\"";
		$result2 = tng_query($query);
		if(tng_num_rows($result2) == 1) {
			$row2 = tng_fetch_assoc($result2);
			$nrights = determineLivingPrivateRights($row2);
			$row2['allow_living']  = $nrights['living'];
			$row2['allow_private'] = $nrights['private'];
			$row2['allow_private_notes'] = $nrights['private_notes'];

			if(!$row2['allow_living']) $noneliving = 0;
			if(!$row2['allow_private']) $noneprivate = 0;
			if(!$row2['allow_private_notes'] && $nrow['secret'] == 1) $noneprivatenotes = 0;

 			$notelinktext .= "<a href=\"{$familygroup_url}familyID={$row2['familyID']}&amp;tree={$row2['gedcom']}\" target='_blank'>{$text['family']}: " . getFamilyName( $row2 ) . "</a> ({$row2['familyID']})\n<br/>\n";
			tng_free_result($result2);
		}
	}

	if(!$notelinktext) {
		$query = "SELECT * FROM $sources_table WHERE sourceID = \"{$nrow['personID']}\" AND gedcom = \"{$nrow['gedcom']}\"";
		$result2 = tng_query($query);
		if(tng_num_rows($result2) == 1) {
			$row2 = tng_fetch_assoc($result2);
			$notelinktext .= "<a href=\"{$showsource_url}sourceID={$row2['sourceID']}&amp;tree={$row2['gedcom']}\" target='_blank'>{$text['source']}</a> ({$row2['sourceID']})\n<br/>\n";
			tng_free_result($result2);
		}
	}

	if(!$notelinktext) {
		$query = "SELECT * FROM $repositories_table WHERE repoID = \"{$nrow['personID']}\" AND gedcom = \"{$nrow['gedcom']}\"";
		$result2 = tng_query($query);
		if(tng_num_rows($result2) == 1) {
			$row2 = tng_fetch_assoc($result2);
			$notelinktext .= "<a href=\"showrepo.php?repoID={$row2['repoID']}&amp;tree={$row2['gedcom']}\" target='_blank'>{$text['repository']}</a> ({$row2['repoID']})\n<br/>\n";
			tng_free_result($result2);
		}
	}

	echo "<tr><td valign=\"top\" class=\"databack\">$i</td>\n";
	echo "<td valign=\"top\" class=\"databack\">";
	if( $noneliving && $noneprivate && $noneprivatenotes )
		echo nl2br($nrow['note']);
	else {
		echo $text['livingnote'];
	}
	echo "&nbsp;</td>";
	echo "<td valign=\"top\" class=\"databack\" width=\"175\">$notelinktext&nbsp;</td></tr>\n";
	$i++;
}
tng_free_result($result);
?>
</table><br />
<?php
if( $pagenav || $notesearch ) {
	echo doNoteSearch( 2, $pagenav );
	echo "<br />";
}
tng_footer( "" );
?>