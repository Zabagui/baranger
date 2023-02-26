<?php
$textpart = "trees";
include("tng_begin.php");

include($cms['tngpath'] . "functions.php");

$browsetrees_url = getURL( "browsetrees-old", 1 );
$showtree_url = getURL( "showtree", 1 );
$search_url = getURL( "search", 1 );

function doTreeSearch( $instance, $pagenav ) {
	global $text, $photosearch;

	$browsetrees_noargs_url = getURL( "browsetrees-old", 0 );
	
	$str = "<span class=\"normal\">\n";
	$str .= getFORM( "browsetrees", "GET", "TreeSearch$instance", "" );
	$str .= "<input type=\"text\" name=\"treesearch\" value=\"$treesearch\"> <input type=\"submit\" value=\"{$text['search']}\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	$str .= $pagenav;
	if( $docsearch )
		$str .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"$browsetrees_noargs_url\">{$text['browsealltrees']}</a>";
	$str .= "</form></span>\n";
	
	return $str;
}

$max_browsetree_pages = 5;
if( $offset ) {
	$offsetplus = $offset + 1;
	$newoffset = "$offset, ";
}
else {
	$offsetplus = 1;
	$newoffset = "";
	$page = 1;
}

if( $treesearch ) 
	$wherestr = "WHERE treename LIKE \"%$treesearch%\" OR description LIKE \"$treesearch%\"";
else
	$wherestr = "";

$query = "SELECT count(personID) as pcount, $trees_table.gedcom, treename, description FROM $trees_table LEFT JOIN $people_table on $trees_table.gedcom = $people_table.gedcom GROUP BY $trees_table.gedcom ORDER BY treename LIMIT $newoffset" . $maxsearchresults;
$result = tng_query($query);

$numrows = tng_num_rows( $result );

if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
	$query = "SELECT count(gedcom) as treecount FROM $trees_table";
	$result2 = tng_query($query);
	$countrow = tng_fetch_assoc( $result2 );
	$totrows = $countrow['treecount'];
}
else
	$totrows = $numrows;

$numrowsplus = $numrows + $offset;

tng_header( $text['browsealltrees'], $flags );
?>

<span class="header"><?php echo $text['browsealltrees']; ?></span><br clear="all" />

<?php 
if( $totrows )
	echo "<p><span class=\"normal\">{$text['matches']} $offsetplus {$text['to']} $numrowsplus {$text['of']} $totrows</span></p>";

$pagenav = get_browseitems_nav( $totrows, $browsetrees_url . "treesearch=$treesearch&amp;offset", $maxsearchresults, $max_browsetree_pages );
if( $pagenav || $treesearch )
	echo doTreeSearch( 1, $pagenav );
?>
<table cellpadding="3" cellspacing="1" border="0" class="whiteback">
	<tr>
		<td class="fieldnameback">&nbsp;</td>
		<td class="fieldnameback" nowrap><span class="fieldname">&nbsp;<strong><?php echo $text['treename']; ?></strong>&nbsp;</span></td>
		<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<strong><?php echo $text['description']; ?></strong>&nbsp;</nobr></span></td>
		<td class="fieldnameback" nowrap><span class="fieldname">&nbsp;<strong><?php echo $text['individuals']; ?></strong>&nbsp;</span></td>
	</tr>
<?php
$i = $offsetplus;
while( $row = tng_fetch_assoc( $result ) )
{
	echo "<tr><td valign=\"top\" class=\"databack\"><span class=\"normal\">$i</span></td>\n";
	echo "<td valign=\"top\" class=\"databack\"><span class=\"normal\"><a href=\"$showtree_url" . "tree={$row['gedcom']}\">{$row['treename']}</a>&nbsp;</span></td>";
	echo "<td valign=\"top\" class=\"databack\"><span class=\"normal\">{$row['description']}&nbsp;</span></td>";
	if( $row['pcount'] )
		echo "<td valign=\"top\" class=\"databack\" align=\"right\"><span class=\"normal\"><a href=\"$search_url" . "tree={$row['gedcom']}\">{$row['pcount']}</a>&nbsp;</span></td>";
	else
		echo "<td valign=\"top\" class=\"databack\" align=\"right\"><span class=\"normal\">{$row['pcount']}&nbsp;</span></td>";
	echo "</tr>\n";
	$i++;
}
tng_free_result($result);
?>
</table>
<br />
<?php
if( $pagenav || $treesearch )
	echo doTreeSearch( 2, $pagenav ) . "<br />\n";

tng_footer( "" );
?>
