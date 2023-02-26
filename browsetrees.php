<?php
$textpart = "trees";
include("tng_begin.php");

include($cms['tngpath'] . "functions.php");

$browsetrees_url = getURL( "browsetrees", 1 );
$showtree_url = getURL( "showtree", 1 );
$search_url = getURL( "search", 1 );
$famsearch_url = getURL( "famsearch", 1 );
$browsesources_url = getURL( "browsesources", 1 );
$switchtree_url = getURL( "switchtree", 1 );

function doTreeSearch( $instance, $pagenav ) {
	global $text, $photosearch, $treesearch;

	$browsetrees_noargs_url = getURL( "browsetrees", 0 );
	
	$str = "<span class=\"normal\">\n";
	$str .= getFORM( "browsetrees", "GET", "TreeSearch$instance", "" );
	$str .= "<input type=\"text\" name=\"treesearch\" value=\"$treesearch\"> <input type=\"submit\" value=\"{$text['search']}\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	$str .= $pagenav;
	if( $treesearch )
		$str .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"$browsetrees_noargs_url\">{$text['browsealltrees']}</a>";
	$str .= "</form></span>\n";
	
	return $str;
}

$max_browsetree_pages = 5;
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

if( !isset($treesearch) ) $treesearch = "";

if( $treesearch ) 
	$wherestr = "WHERE treename LIKE \"%$treesearch%\" OR description LIKE \"%$treesearch%\"";
else
	$wherestr = "";

$query = "SELECT count(personID) as pcount, $trees_table.gedcom, treename, description FROM $trees_table LEFT JOIN $people_table on $trees_table.gedcom = $people_table.gedcom $wherestr GROUP BY $trees_table.gedcom ORDER BY treename LIMIT $newoffset" . $maxsearchresults;
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

tng_header( $text['trees'], $flags );

if($totrows > 1) {
?>
<link href="css/c3.css" rel="stylesheet">
<script src="js/d3.min.js"></script>
<script src="js/c3.min.js"></script>
<?php
}
?>

<h1 class="header"><span class="headericon" id="trees-hdr-icon"></span><?php echo $text['trees']; ?></h1><br clear="left"/>

<?php 
if( $totrows )
	echo "<p><span class=\"normal\">{$text['matches']} $offsetplus {$text['to']} $numrowsplus {$text['of']} $totrows</span></p>";

$pagenav = get_browseitems_nav( $totrows, $browsetrees_url . "treesearch=$treesearch&amp;offset", $maxsearchresults, $max_browsetree_pages );
if( $pagenav || $treesearch )
	echo doTreeSearch( 1, $pagenav );

$header = "";
$headerr = $enableminimap ? " data-tablesaw-minimap" : "";
$headerr .= $enablemodeswitch ? " data-tablesaw-mode-switch" : "";

if($sitever != "standard") {
	if($tabletype == "toggle") $tabletype = "columntoggle";
	$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" style=\"width:100%\" class=\"tablesaw thfixed whiteback normal\" data-tablesaw-mode=\"$tabletype\"{$headerr}>\n";
} else {
	$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" class=\"thfixed whiteback normal\">";
}
?>
<div style="display:inline-block; margin-right:50px">
<?php
echo $header;
?>
	<thead>
		<tr>
		<th data-tablesaw-priority="persist" class="fieldnameback nbrcol fieldname">&nbsp;#&nbsp;</td>
		<th data-tablesaw-priority="1" class="fieldnameback nw fieldname">&nbsp;<?php echo $text['treename']; ?>&nbsp;</th>
		<th data-tablesaw-priority="2" class="fieldnameback nw fieldname">&nbsp;<?php echo $text['description']; ?>&nbsp;</th>
		<th data-tablesaw-priority="3" class="fieldnameback nw fieldname">&nbsp;<?php echo $text['individuals']; ?>&nbsp;</th>
		<th data-tablesaw-priority="4" class="fieldnameback nw fieldname">&nbsp;<?php echo $text['families']; ?>&nbsp;</th>
		<th data-tablesaw-priority="5" class="fieldnameback nw fieldname">&nbsp;<?php echo $text['sources']; ?>&nbsp;</th>
<?php
	$trees = isset($_SESSION['availabletrees']) ? explode(',',$_SESSION['availabletrees']) : [];
	$numtrees = count($trees);
	if($numtrees > 1) {
?>
		<th data-tablesaw-priority="5" class="fieldnameback nw fieldname">&nbsp;</th>
<?php
	}
?>
		</tr>
	</thead>
<?php
$i = $offsetplus;
$treenames = array();
while( $row = tng_fetch_assoc( $result ) )
{
	$query = "SELECT count(familyID) as fcount FROM $families_table WHERE gedcom = \"{$row['gedcom']}\"";
	$famresult = tng_query($query);
	$famrow = tng_fetch_assoc($famresult);
	tng_free_result($famresult);
	
	$treenames[$row['treename']] = $row['pcount'];

	$query = "SELECT count(sourceID) as scount FROM $sources_table WHERE gedcom = \"{$row['gedcom']}\"";
	$srcresult = tng_query($query);
	$srcrow = tng_fetch_assoc($srcresult);
	tng_free_result($srcresult);

	echo "<tr><td valign=\"top\" class=\"databack\">$i</td>\n";
	echo "<td valign=\"top\" class=\"databack\"><a href=\"$showtree_url" . "tree={$row['gedcom']}\">{$row['treename']}</a>&nbsp;</td>";
	echo "<td valign=\"top\" class=\"databack\">{$row['description']}&nbsp;</td>";
	echo "<td valign=\"top\" class=\"databack\" align=\"right\"><a href=\"$search_url" . "tree={$row['gedcom']}\">" . number_format($row['pcount']) . "</a>&nbsp;</td>";
	echo "<td valign=\"top\" class=\"databack\" align=\"right\"><a href=\"$famsearch_url" . "tree={$row['gedcom']}\">" . number_format($famrow['fcount']) . "</a>&nbsp;</td>";
	echo "<td valign=\"top\" class=\"databack\" align=\"right\"><a href=\"$browsesources_url" . "tree={$row['gedcom']}\">" . number_format($srcrow['scount']) . "</a>&nbsp;</td>";
	if($numtrees > 1) {
		echo "<td valign=\"top\" class=\"databack\" align=\"right\">";
		if($row['gedcom'] == $assignedtree)
			echo $admtext['active'];
		elseif(in_array($row['gedcom'],$trees))
			echo "<a href=\"$switchtree_url" . "newtree={$row['gedcom']}&amp;ret={$homepage}\">{$text['switch']}</a>";
		echo "</td>";
	}
	echo "</tr>\n";
	$i++;
}
tng_free_result($result);
?>
</table>
<br/><br/>
</div>
<?php
if($totrows > 1) {
?>
<div id="charts" style="display:inline-block; width:400px; vertical-align:top;text-align:center">
	<div id="trees_chart"></div>
</div>
<script type="text/javascript">
var trees_chart = c3.generate({
    bindto: '#trees_chart',
    data: {
        columns: [
<?php
	$count = 1;
	foreach($treenames as $key => $val) {
		if($count > 1) echo ",\n";
		echo "['data{$count}', {$val}]";
		if($count == 10) break;
		$count++;
	}
?>
        ],
        type : 'pie',
        names: {
<?php
	$count = 1;
	foreach($treenames as $key => $val) {
		if($count > 1) echo ",\n";
		$numnames = number_format($val);
		echo "data{$count}: '{$key} ({$numnames})'";
		if($count == 10) break;
		$count++;
	}
?>
        }
    }
});
</script>
<?php
}
?>

<br />
<?php
tng_footer( "" );
?>
