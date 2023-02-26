<?php
$textpart = "trees";
include("tng_begin.php");

include($cms['tngpath'] . "functions.php");

$browsetrees_url = getURL( "browsetrees", 1 );
$browsebranches_url = getURL( "browsebranches", 1 );
$showtree_url = getURL( "showtree", 1 );
$search_url = getURL( "search", 1 );
$famsearch_url = getURL( "famsearch", 1 );
$getperson_url = getURL( "getperson", 1 );

function doBranchSearch( $instance, $pagenav ) {
	global $text, $branchsearch;

	$browsebranches_noargs_url = getURL( "browsebranches", 0 );
	
	$str = "<span class=\"normal\">\n";
	$str .= getFORM( "browsebranches", "GET", "BranchSearch$instance", "" );
	$str .= "<input type=\"text\" name=\"branchsearch\" value=\"$branchsearch\"> <input type=\"submit\" value=\"{$text['search']}\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	$str .= $pagenav;
	if( $branchsearch )
		$str .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"$browsebranches_noargs_url\">{$text['browsealltrees']}</a>";
	$str .= "</form></span>\n";
	
	return $str;
}

$max_browsebranch_pages = 5;
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

$branchsearch = isset($branchsearch) ? cleanIt(trim($branchsearch)) : "";
if( $branchsearch )
	$wherestr = " AND (branch LIKE \"%$branchsearch%\" OR b.description LIKE \"%$branchsearch%\")";
else
	$wherestr = "";
if( $tree )
	$wherestr .= " AND b.gedcom = \"$tree\"";

$query = "SELECT b.branch, b.gedcom, b.description, treename, personID
	FROM ($branches_table as b, $trees_table as t)
	WHERE b.gedcom = t.gedcom $wherestr
	ORDER BY b.description LIMIT $newoffset" . $maxsearchresults;
$result = tng_query($query);

$numrows = tng_num_rows( $result );

if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
	$query = "SELECT count(branch) as branchcount FROM $branches_table";
	$result2 = tng_query($query);
	$countrow = tng_fetch_assoc( $result2 );
	$totrows = $countrow['branchcount'];
}
else
	$totrows = $numrows;

$numrowsplus = $numrows + $offset;

$treequery = "SELECT count(gedcom) as treecount FROM $trees_table";
$treeresult = tng_query($treequery);
$treerow = tng_fetch_assoc($treeresult);
$numtrees = $treerow['treecount'];
tng_free_result($treeresult);

$logstring = "<a href=\"$browsebranches_url" . "tree=$tree&amp;offset=$offset&amp;branchsearch=$branchsearch\">" . xmlcharacters($text['branches']) . "</a>";
writelog($logstring);
preparebookmark($logstring);
tng_header( $text['branches'], $flags );
?>

<h1 class="header"><span class="headericon" id="branches-hdr-icon"></span><?php echo $text['branches']; ?></h1><br clear="left"/>
<?php 
echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'browsebranches', 'method' => 'get', 'name' => 'form1', 'id' => 'form1'));

if( $totrows )
	echo "<p><span class=\"normal\">{$text['matches']} $offsetplus {$text['to']} $numrowsplus {$text['of']} $totrows</span></p>";

$pagenav = get_browseitems_nav( $totrows, $browsebranches_url . "branchsearch=$branchsearch&amp;offset", $maxsearchresults, $max_browsebranch_pages );
if( $pagenav || $branchsearch )
	echo doBranchSearch( 1, $pagenav );

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
		<th data-tablesaw-priority="1" class="fieldnameback nw fieldname">&nbsp;<?php echo $text['description']; ?>&nbsp;</th>
<?php 
	if($numtrees > 1) {
?>
		<th data-tablesaw-priority="2" class="fieldnameback nw fieldname">&nbsp;<?php echo $text['treename']; ?>&nbsp;</th>
<?php 
	}
?>	
		<th data-tablesaw-priority="3" class="fieldnameback nw fieldname">&nbsp;<?php echo $text['startingind']; ?>&nbsp;</th>
		<th data-tablesaw-priority="4" class="fieldnameback nw fieldname">&nbsp;<?php echo $text['individuals']; ?>&nbsp;</th>
		<th data-tablesaw-priority="5" class="fieldnameback nw fieldname">&nbsp;<?php echo $text['families']; ?>&nbsp;</th>
		</tr>
	</thead>
<?php
$i = $offsetplus;
$peoplewhere = getLivingPrivateRestrictions($people_table, false, false);
if($peoplewhere) $peoplewhere = "AND " . $peoplewhere;
$familywhere = getLivingPrivateRestrictions($families_table, false, false);
if($familywhere) $familywhere = "AND " . $familywhere;

while( $row = tng_fetch_assoc( $result ) )
{
	$query = "SELECT count(familyID) as fcount FROM $families_table WHERE branch LIKE \"%{$row['branch']}%\" $familywhere";
	$famresult = tng_query($query);
	$famrow = tng_fetch_assoc($famresult);
	tng_free_result($famresult);
	
	$query = "SELECT count(personID) as pcount FROM $people_table WHERE branch LIKE \"%{$row['branch']}%\" $peoplewhere";
	$indresult = tng_query($query);
	$indrow = tng_fetch_assoc($indresult);
	tng_free_result($indresult);

 	$presult = getPersonSimple($row['gedcom'], $row['personID']);
	$prow = tng_fetch_assoc($presult);
	tng_free_result($presult);
	$namestr = "";
	if( !empty($prow) ) {
		$prights = determineLivingPrivateRights($prow);
		$prow['allow_living'] = $prights['living'];
		$prow['allow_private'] = $prights['private'];
		$namestr = getName( $prow );
	}

	echo "<tr><td valign=\"top\" class=\"databack\">$i</td>\n";
	echo "<td valign=\"top\" class=\"databack\">{$row['description']}&nbsp;</td>";
	if($numtrees > 1)
		echo "<td valign=\"top\" class=\"databack\"><a href=\"$showtree_url" . "tree={$row['gedcom']}\">{$row['treename']}</a>&nbsp;</td>";
	echo "<td valign=\"top\" class=\"databack\"><a href=\"$getperson_url" . "personID={$row['personID']}&amp;tree={$row['gedcom']}\">$namestr</a>&nbsp;</td>";
	echo "<td valign=\"top\" class=\"databack\" align=\"right\"><a href=\"$search_url" . "tree={$row['gedcom']}&amp;branch={$row['branch']}\">" . number_format($indrow['pcount']) . "</a>&nbsp;</td>";
	echo "<td valign=\"top\" class=\"databack\" align=\"right\"><a href=\"$famsearch_url" . "tree={$row['gedcom']}&amp;branch={$row['branch']}\">" . number_format($famrow['fcount']) . "</a>&nbsp;</td>";
	echo "</tr>\n";
	$i++;
}
tng_free_result($result);
?>
</table>

<?php
if( $pagenav || $branchsearch )
	echo doBranchSearch( 2, $pagenav );

tng_footer( "" );
?>