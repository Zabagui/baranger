<?php
$textpart = "sources";
include("tng_begin.php");

include($cms['tngpath'] . "functions.php");

$browserepos_url = getURL( "browserepos", 1 );
$showrepo_url = getURL( "showrepo", 1 );

function doRepoSearch( $instance, $pagenav ) {
	global $text, $reposearch, $tree;

	$browserepos_noargs_url = getURL( "browserepos", 0 );

	$str = "<span class=\"normal\">\n";
	$str .= getFORM( "browserepos", "get", "RepoSearch$instance", "" );
	$str .= "<input type=\"text\" name=\"reposearch\" value=\"$reposearch\" /> <input type=\"submit\" value=\"{$text['search']}\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	$str .= $pagenav;
	if( $reposearch )
		$str .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"$browserepos_noargs_url\">{$text['browseallrepos']}</a>";
	$str .= "<input type=\"hidden\" name=\"tree\" value=\"$tree\" />\n";
	$str .= "</form></span>\n";
	
	return $str;
}

$max_browserepo_pages = 5;
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

$reposearch = isset($reposearch) ? cleanIt(trim($reposearch)) : "";
if( $tree ) {
	$wherestr = "WHERE $repositories_table.gedcom = \"$tree\"";
	if( $reposearch ) $wherestr .= " AND reponame LIKE \"%$reposearch%\"";
	$join = "INNER JOIN";
}
else {
	if( $reposearch )
		$wherestr = "WHERE reponame LIKE \"%$reposearch%\"";
	else
		$wherestr = "";
	$join = "LEFT JOIN";
}

$query = "SELECT repoID, reponame, $repositories_table.gedcom as gedcom, treename FROM $repositories_table $join $trees_table on $repositories_table.gedcom = $trees_table.gedcom $wherestr ORDER BY reponame LIMIT $newoffset" . $maxsearchresults;
$result = tng_query($query);

$numrows = tng_num_rows( $result );

if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
	if( $tree )
		$query = "SELECT count(repoID) as scount FROM $repositories_table LEFT JOIN $trees_table on $repositories_table.gedcom = $trees_table.gedcom $wherestr";
	else
		$query = "SELECT count(repoID) as scount FROM $repositories_table $wherestr";
	$result2 = tng_query($query);
	$row = tng_fetch_assoc( $result2 );
	$totrows = $row['scount'];
}
else
	$totrows = $numrows;

$numrowsplus = $numrows + $offset;

$treestr = $tree ? " ({$text['tree']}: $tree)" : "";
$logstring = "<a href=\"$browserepos_url" . "tree=$tree&amp;offset=$offset&amp;reposearch=$reposearch\">" . xmlcharacters($text['repositories'].$treestr) . "</a>";
writelog($logstring);
preparebookmark($logstring);

tng_header( $text['repositories'], $flags );
?>

<h1 class="header"><span class="headericon" id="repos-hdr-icon"></span><?php echo $text['repositories']; ?></h1><br clear="left"/>
<?php
echo "<div class=\"normal\">\n";

echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'browserepos', 'method' => 'get', 'name' => 'form1', 'id' => 'form1'));

if( $totrows )
	echo "<p><span class=\"normal\">{$text['matches']} $offsetplus {$text['to']} $numrowsplus {$text['of']} $totrows</span></p>";

$pagenav = get_browseitems_nav( $totrows, $browserepos_url . "reposearch=$reposearch&amp;offset", $maxsearchresults, $max_browserepo_pages );
if( $pagenav || $reposearch ) {
	echo doRepoSearch( 1, $pagenav );
	echo "<br />\n";
}

$header = "";
$headerr = $enableminimap ? " data-tablesaw-minimap" : "";
$headerr .= $enablemodeswitch ? " data-tablesaw-mode-switch" : "";

if ($sitever != "standard") {
	if ($tabletype == "toggle") {
		$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" style=\"width:100%\" class=\"tablesaw thfixed whiteback normal\" data-tablesaw-mode=\"columntoggle\"{$headerr}>\n";
	} elseif ($tabletype == "stack") {
		$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" style=\"width:100%\" class=\"tablesaw thfixed whiteback normal\" data-tablesaw-mode=\"stack\"{$headerr}>\n";
	} elseif ($tabletype == "swipe") {
		$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" style=\"width:100%\" class=\"tablesaw thfixed whiteback normal\" data-tablesaw-mode=\"swipe\"{$headerr}>\n";
	}
} else {
	$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" class=\"thfixed whiteback normal\">";
}
echo $header;
?>
	<thead>
		<tr>
		<th data-tablesaw-priority="persist" class="fieldnameback nbrcol fieldname">&nbsp;#&nbsp;</th>
		<th data-tablesaw-priority="1" class="fieldnameback fieldname">&nbsp;<?php echo $text['repoid']; ?>&nbsp;</th>
		<th data-tablesaw-priority="2" class="fieldnameback fieldname">&nbsp;<?php echo $text['name']; ?>&nbsp;</th>
		<?php if( $numtrees > 1 ) { ?><th data-tablesaw-priority="3" class="fieldnameback fieldname">&nbsp;<?php echo $text['tree']; ?>&nbsp;</th><?php } ?>
		</tr>
	</thead>
<?php
$i = $offsetplus;
while( $row = tng_fetch_assoc( $result ) )
{
	echo "<tr><td valign=\"top\" class=\"databack\"><span class=\"normal\">$i</span></td>\n";
	echo "<td valign=\"top\" class=\"databack\"><span class=\"normal\"><a href=\"$showrepo_url" . "repoID={$row['repoID']}&amp;tree={$row['gedcom']}\">{$row['repoID']}</a>&nbsp;</span></td>";
	echo "<td valign=\"top\" class=\"databack\"><span class=\"normal\"><a href=\"$showrepo_url" . "repoID={$row['repoID']}&amp;tree={$row['gedcom']}\">{$row['reponame']}</a>&nbsp;</span></td>";
	if( $numtrees > 1 )
		echo "<td valign=\"top\" class=\"databack nw\"><span class=\"normal\">{$row['treename']}&nbsp;</span></td>";
	echo "</tr>\n";
	$i++;
}
tng_free_result($result);
?>
</table>
<br />
</div>
<?php
if( $pagenav || $reposearch )
	echo doRepoSearch( 2, $pagenav ) . "<br />\n";

tng_footer( "" );
?>
