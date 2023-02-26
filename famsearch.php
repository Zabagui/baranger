<?php
$textpart = "search";
$order = "";
include("tng_begin.php");
global $responsivetables, $tabletype, $enablemodeswitch, $enableminimap;  

include($cms['tngpath'] . "searchlib.php");

$searchform_url = getURL( "famsearchform", 1 );
$search_url = getURL( "famsearch", 1 );
$placesearch_url = getURL( "placesearch", 1 );
$familygroup_url = getURL( "familygroup", 1 );
$showtree_url = getURL( "showtree", 1 );
$pedigree_url = getURL( "pedigree", 1 );

@set_time_limit(0);
$maxsearchresults = !empty($nr) ? $nr : (!empty($_SESSION['tng_nr']) ? $_SESSION['tng_nr'] : $maxsearchresults);
if(!isset($mybool) || ($mybool != "AND" && $mybool != "OR"))
	$mybool = "AND";

$varlist= array('branch','dvpqualify','dvyqualify','ecount','ffnqualify','fidqualify','flnqualify','mfnqualify','mlnqualify','mpqualify','mtqualify','mydivplace','mydivyear','myfamilyid','myffirstname','myflastname','mymarrplace','mymarrtype','mymarryear','mymfirstname','mymlastname','myqualify','showdeath','showspouse','urlstring');
foreach($varlist as $var) 
	if( !isset(${$var}) ) ${$var} = "";
		
if( !isset($offset) ) $offset = 0;

$saved_cust_events = isset($_COOKIE['tng_search_families_post']['cust_events']) ? explode(",",stripslashes($_COOKIE['tng_search_families_post']['cust_events'])) : [];

$_SESSION['tng_search_ftree'] = $tree;
$_SESSION['tng_search_branch'] = $branch;
$_SESSION['tng_search_flnqualify'] = $flnqualify;
$myflastname = trim(stripslashes($myflastname));
$_SESSION['tng_search_flastname'] = cleanIt($myflastname);

$_SESSION['tng_search_ffnqualify'] = $ffnqualify;
$myffirstname = trim(stripslashes($myffirstname));
$_SESSION['tng_search_ffirstname'] = cleanIt($myffirstname);

$_SESSION['tng_search_mlnqualify'] = $mlnqualify;
$mymlastname = trim(stripslashes($mymlastname));
$_SESSION['tng_search_mlastname'] = cleanIt($mymlastname);

$_SESSION['tng_search_mfnqualify'] = $mfnqualify;
$mymfirstname = trim(stripslashes($mymfirstname));
$_SESSION['tng_search_mfirstname'] = cleanIt($mymfirstname);

$_SESSION['tng_search_fidqualify'] = $fidqualify;
$myfamilynid = trim(stripslashes($myfamilyid));
$_SESSION['tng_search_familyid'] = cleanIt($myfamilynid);

$_SESSION['tng_search_mpqualify'] = $mpqualify;
$mymarrplace = trim(stripslashes($mymarrplace));
$_SESSION['tng_search_marrplace'] = cleanIt($mymarrplace);

$_SESSION['tng_search_myqualify'] = $myqualify;
$mymarryear = trim(stripslashes($mymarryear));
$_SESSION['tng_search_marryear'] = cleanIt($mymarryear);

$_SESSION['tng_search_dvpqualify'] = $dvpqualify;
$mydivplace = trim(stripslashes($mydivplace));
$_SESSION['tng_search_divplace'] = cleanIt($mydivplace);

$_SESSION['tng_search_dvyqualify'] = $dvyqualify;
$mydivyear = trim(stripslashes($mydivyear));
$_SESSION['tng_search_divyear'] = cleanIt($mydivyear);

$_SESSION['tng_search_mtqualify'] = $mtqualify;
$mymarrtype = trim(stripslashes($mymarrtype));
$_SESSION['tng_search_marrtype'] = cleanIt($mymarrtype);

$_SESSION['tng_search_fbool'] = $mybool;
$_SESSION['tng_nr'] = isset($nr) ? $nr : $maxsearchresults;
if($order)
	$_SESSION['tng_search_forder'] = $order;
else {
	$order = isset($_SESSION['tng_search_forder']) ? $_SESSION['tng_search_forder'] : "fname";
}

$marrsort = "marr";
$divsort = "div";
$fnamesort = "fnameup";
$mnamesort = "mnameup";
$orderloc = strpos($_SERVER['QUERY_STRING'],"&amp;order=");
$currargs = $orderloc > 0 ? substr($_SERVER['QUERY_STRING'],0,$orderloc) : $_SERVER['QUERY_STRING'];
$mybooltext = $mybool == "AND" ? $text['cap_and'] : $text['cap_or'];

if($order == "marr") {
	$orderstr = "marrdatetr, marrplace, father.lastname, father.firstname";
	$marrsort = "<a href=\"$search_url$currargs&amp;order=marrup\" class=\"lightlink\">{$text['married']} <img src=\"{$cms['tngpath']}img/tng_sort_desc.gif\" class=\"sortimg\" /></a>";
}
else {
	$marrsort = "<a href=\"$search_url$currargs&amp;order=marr\" class=\"lightlink\">{$text['married']} <img src=\"{$cms['tngpath']}img/tng_sort_asc.gif\" class=\"sortimg\" /></a>";
	if($order == "marrup")
		$orderstr = "marrdatetr DESC, marrplace DESC, father.lastname, father.firstname";
}

if($order == "div") {
	$orderstr = "divdatetr, divplace, father.lastname, father.firstname, marrdatetr";
	$divsort = "<a href=\"$search_url$currargs&amp;order=divup\" class=\"lightlink\">{$text['divorced']} <img src=\"{$cms['tngpath']}img/tng_sort_desc.gif\" class=\"sortimg\" /></a>";
}
else {
	$divsort = "<a href=\"$search_url$currargs&amp;order=div\" class=\"lightlink\">{$text['divorced']} <img src=\"{$cms['tngpath']}img/tng_sort_asc.gif\" class=\"sortimg\" /></a>";
	if($order == "divup")
		$orderstr = "divdatetr DESC, divplace DESC, father.lastname, father.firstname, marrdatetr";
}

if($order == "fname") {
	$orderstr = "father.lastname, father.firstname, marrdatetr";
	$fnamesort = "<a href=\"$search_url$currargs&amp;order=fnameup\" class=\"lightlink\">{$text['fathername']} <img src=\"{$cms['tngpath']}img/tng_sort_desc.gif\" class=\"sortimg\" /></a>";
}
else {
	$fnamesort = "<a href=\"$search_url$currargs&amp;order=fname\" class=\"lightlink\">{$text['fathername']} <img src=\"{$cms['tngpath']}img/tng_sort_asc.gif\" class=\"sortimg\" /></a>";
	if($order == "fnameup")
		$orderstr = "father.lastname DESC, father.firstname DESC, marrdatetr";
}

if($order == "mname") {
	$orderstr = "mother.lastname, mother.firstname, marrdatetr";
	$mnamesort = "<a href=\"$search_url$currargs&amp;order=mnameup\" class=\"lightlink\">{$text['mothername']} <img src=\"{$cms['tngpath']}img/tng_sort_desc.gif\" class=\"sortimg\" /></a>";
}
else {
	$mnamesort = "<a href=\"$search_url$currargs&amp;order=mname\" class=\"lightlink\">{$text['mothername']} <img src=\"{$cms['tngpath']}img/tng_sort_asc.gif\" class=\"sortimg\" /></a>";
	if($order == "mnameup")
		$orderstr = "mother.lastname DESC, mother.firstname DESC, marrdatetr";
}

function buildCriteria( $column, $colvar, $qualifyvar, $qualifier, $value, $textstr ) {
	global $allwhere, $querystring, $lnprefixes, $criteria_limit, $criteria_count;

	if( $qualifier == "exists" || $qualifier == "dnexist" )
		$value = $usevalue = "";
	else {
		$value = urldecode(trim($value));
		$usevalue = addslashes( $value );
	}

	if( $column == "father.lastname" && $lnprefixes )
		$column = "TRIM(CONCAT_WS(' ',father.lnprefix,father.lastname))";
	elseif( $column == "mother.lastname" && $lnprefixes )
		$column = "TRIM(CONCAT_WS(' ',mother.lnprefix,mother.lastname))";

	$criteria_count++;
	if($criteria_count >= $criteria_limit)
		die("sorry");
	$criteria = "";
	$returnarray = buildColumn( $qualifier, $column, $usevalue );
	$criteria .= $returnarray['criteria'];
	$qualifystr = $returnarray['qualifystr'];

	addtoQuery( $textstr, $colvar, $criteria, $qualifyvar, $qualifier, $qualifystr, $value );
}

$querystring = "";
$allwhere = "";

if( $myflastname || $flnqualify == "exists" || $flnqualify == "dnexist" )  {
	if( $myflastname == $text['nosurname'] )
		addtoQuery( "lastname", "myflastname", "father.lastname = \"\"", "flnqualify", $text['equals'], $text['equals'], $myflastname );
	else {
		buildCriteria( "father.lastname", "myflastname", "flnqualify", $flnqualify, $myflastname, $text['lastname'] );
	}
}
if( $myffirstname || $ffnqualify == "exists" || $ffnqualify == "dnexist" ) {
	buildCriteria( "father.firstname", "myffirstname", "ffnqualify", $ffnqualify, $myffirstname, $text['firstname'] );
}

if( $mymlastname || $mlnqualify == "exists" || $mlnqualify == "dnexist" )  {
	if( $mymlastname == $text['nosurname'] )
		addtoQuery( "lastname", "mymlastname", "mother.lastname = \"\"", "mlnqualify", $text['equals'], $text['equals'], $mymlastname );
	else {
		buildCriteria( "mother.lastname", "mymlastname", "mlnqualify", $mlnqualify, $mymlastname, $text['lastname'] );
	}
}
if( $mymfirstname || $mfnqualify == "exists" || $mfnqualify == "dnexist" ) {
	buildCriteria( "mother.firstname", "mymfirstname", "mfnqualify", $mfnqualify, $mymfirstname, $text['firstname'] );
}

if( $myfamilyid ) {
	$myfamilyid = strtoupper($myfamilyid);
	if($fidqualify == "equals" && is_numeric($myfamilyid)) $myfamilyid = $familyprefix . $myfamilyid . $familysuffix;
	buildCriteria( "familyID", "myfamilyid", "fidqualify", $fidqualify, $myfamilyid, $text['familyid'] );
}
if( $mymarrplace || $mpqualify == "exists" || $mpqualify == "dnexist" ) {
	buildCriteria( "marrplace", "mymarrplace", "mpqualify", $mpqualify, $mymarrplace, $text['marrplace'] );
}
if( $mymarryear || $myqualify == "exists" || $myqualify == "dnexist" ) {
	buildYearCriteria( "marrdatetr", "mymarryear", "myqualify", "", $myqualify, $mymarryear, $text['marrdatetr'] );
}
if( $mydivplace || $dvpqualify == "exists" || $dvpqualify == "dnexist" ) {
	buildCriteria( "divplace", "mydivplace", "dvpqualify", $dvpqualify, $mydivplace, $text['divplace'] );
}
if( $mydivyear || $dvyqualify == "exists" || $dvyqualify == "dnexist" ) {
	buildYearCriteria( "divdatetr", "mydivyear", "dvyqualify", "", $dvyqualify, $mydivyear, $text['divdatetr'] );
}
if( $mymarrtype || $mtqualify == "exists" || $mtqualify == "dnexist" ) {
	buildCriteria( "marrtype", "mymarrtype", "mtqualify", $mtqualify, $mymarrtype, $text['marrtype'] );
}

$dontdo = array(); //array("MARR","DIV");
$cejoin = doCustomEvents("F");

if( $tree ) {
	if( $urlstring )
		$urlstring .= "&amp;";
	$urlstring .= "tree=$tree";

	if( $querystring )
		$querystring .= " AND ";

	$query = "SELECT treename FROM $trees_table WHERE gedcom = \"$tree\"";
	$treeresult = tng_query($query);
	$treerow = tng_fetch_assoc($treeresult);
	tng_free_result($treeresult);

	$querystring .= $text['tree'] . " {$text['equals']} {$treerow['treename']}";

	if( $allwhere ) $allwhere = "($allwhere) AND";
	$allwhere .= " f.gedcom=\"$tree\"";

	if($branch) {
		$urlstring .= "&amp;branch=$branch";
		$querystring .= " {$text['cap_and']} ";

		$query = "SELECT description FROM $branches_table WHERE gedcom = \"$tree\" AND branch = \"$branch\"";
		$branchresult = tng_query($query);
		$branchrow = tng_fetch_assoc($branchresult);
		tng_free_result($branchresult);

		$querystring .= $text['branch'] . " {$text['equals']} {$branchrow['description']}";

		$allwhere .= " AND f.branch like \"%$branch%\"";
	}
}

$treequery = "SELECT count(gedcom) as treecount FROM $trees_table";
$treeresult = tng_query($treequery);
$treerow = tng_fetch_assoc($treeresult);
$numtrees = $treerow['treecount'];
tng_free_result($treeresult);

$gotInput = $mymarrplace || $mydivplace || $mymarryear || $mydivyear || $ecount;
$more = getLivingPrivateRestrictions("f", false, $gotInput);

if($more) {
	if($allwhere)
		$allwhere = $tree ? "$allwhere AND " : "($allwhere) AND ";
	$allwhere .= $more;
}

if( $allwhere ) {
	$allwhere = "WHERE " . $allwhere . " AND ";;
	$querystring = "{$text['text_for']} $querystring";
}
else
	$allwhere = "WHERE ";

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

//left join to people table twice, once for husband and for wife
$query = "SELECT f.ID, familyID, husband, wife, marrdate, marrplace, divdate, divplace, f.gedcom as gedcom, f.living, f.private, f.branch, treename,
	father.personID as fpersonID, father.lastname as flastname, father.lnprefix as flnprefix, father.firstname as ffirstname, father.title as ftitle, father.prefix as fprefix, father.suffix as fsuffix, father.nameorder as fnameorder, father.birthdate as fbirthdate, father.birthdatetr as fbirthdatetr, father.altbirthdate as faltbirthdate, father.altbirthdatetr as faltbirthdatetr, father.deathdate as fdeathdate, father.living as fliving, father.private as fprivate, father.branch as fbranch,
	mother.personID as mpersonID, mother.lastname as mlastname, mother.lnprefix as mlnprefix, mother.firstname as mfirstname, mother.title as mtitle, mother.prefix as mprefix, mother.suffix as msuffix, mother.nameorder as mnameorder, mother.birthdate as mbirthdate, mother.birthdatetr as mbirthdatetr, mother.altbirthdate as maltbirthdate, mother.altbirthdatetr as maltbirthdatetr, mother.deathdate as mdeathdate, mother.living as mliving, mother.private as mprivate, mother.branch as mbranch
	FROM ($families_table as f, $trees_table) $cejoin
	LEFT JOIN $people_table AS father ON f.gedcom=father.gedcom AND husband = father.personID
	LEFT JOIN $people_table AS mother ON f.gedcom=mother.gedcom AND wife = mother.personID
	$allwhere (f.gedcom = $trees_table.gedcom)
	ORDER BY $orderstr
	LIMIT $newoffset" . $maxsearchresults;
$query2 = "SELECT count(f.ID) as fcount
	FROM ($families_table as f, $trees_table) $cejoin
	LEFT JOIN $people_table AS father ON f.gedcom=father.gedcom AND husband = father.personID
	LEFT JOIN $people_table AS mother ON f.gedcom=mother.gedcom AND wife = mother.personID
	$allwhere (f.gedcom = $trees_table.gedcom)";

//echo $query;
$result = tng_query($query);
$numrows = tng_num_rows( $result );

if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
	$result2 = tng_query($query2) or die ($text['cannotexecutequery'] . ": $query2");
	$countrow = tng_fetch_assoc($result2);
	$totrows = $countrow['fcount'];
	tng_free_result($result2);
}
else
	$totrows = $numrows;

if ( !$numrows ) {
	$msg = $text['noresults'] . " $querystring. " . $text['tryagain'] . ".";
	header( "Location: " . "$searchform_url" . "msg=" . urlencode( $msg ) );
	exit;
}

tng_header( $text['searchresults'], $flags );
?>
<?php
	if($sitever != "mobile") {
?>
<script type="text/javascript" src="<?php echo $cms['tngpath']; ?>js/search.js"></script>
<script type="text/javascript">
// <![CDATA[
var ajx_fampreview = '<?php echo getURL( "ajx_fampreview", 0 );?>';
// ]]>
</script>
<?php		
	}
?>

<h1 class="header"><span class="headericon" id="fsearch-hdr-icon"></span><?php echo $text['searchresults']; ?></h1><br clear="left"/>
<?php
$logstring = "<a href=\"$search_url" . $_SERVER['QUERY_STRING'] . "\">" . xmlcharacters($text['searchresults'] . " $querystring") . "</a>";
writelog($logstring);
preparebookmark($logstring);

$numrowsplus = $numrows + $offset;

echo "<p class=\"normal\">" . $text['matches'] . " $offsetplus " . $text['to'] . " $numrowsplus " . $text['of'] . " " . number_format($totrows) . " $querystring</p>";

$pagenav = get_browseitems_nav( $totrows, "$search_url" . "$urlstring&amp;mybool=$mybool&amp;nr=$maxsearchresults&amp;showspouse=$showspouse&amp;showdeath=$showdeath&amp;offset", $maxsearchresults, $max_browsesearch_pages );
echo "<p class=\"normal\">$pagenav</p>";

$header = $headerr = "";
if ($enablemodeswitch) {
	$headerr = "data-tablesaw-mode-switch>\n";
} else {
	$headerr = ">\n" . $header;
}

if ($enableminimap) {
	$headerr = " data-tablesaw-minimap " . $headerr;
} else {
	$headerr = $headerr;
}

if ($sitever != "standard") {
	if ($tabletype == "toggle") {
		$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" width=\"100%\" class=\"tablesaw thfixed whiteback\" data-tablesaw-mode=\"columntoggle\"" . $headerr;
	} elseif ($tabletype == "stack") {
		$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" width=\"100%\" class=\"tablesaw thfixed whiteback\" data-tablesaw-mode=\"stack\"" . $headerr;
	} elseif ($tabletype == "swipe") {
		$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" width=\"100%\" class=\"tablesaw thfixed whiteback\" data-tablesaw-mode=\"swipe\"" . $headerr;
	}
} else {
	$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" class=\"whiteback\">\n" . $header;
}
echo $header;
?>
    <thead><tr>
        <th data-tablesaw-priority="persist" class="fieldnameback nbrcol"><span class="fieldname">&nbsp;# </span></th>
		<th data-tablesaw-priority="3" class="fieldnameback fieldname nw">&nbsp;<b><?php echo $text['familyid']; ?></b>&nbsp;</th>
		<th data-tablesaw-priority="1" class="fieldnameback fieldname nw">&nbsp;<b><?php echo $fnamesort; ?></b>&nbsp;</th>
		<th data-tablesaw-priority="1" class="fieldnameback fieldname nw">&nbsp;<b><?php echo $mnamesort; ?></b>&nbsp;</th>
		<th data-tablesaw-priority="2" class="fieldnameback fieldname nw">&nbsp;<?php echo $marrsort; ?>&nbsp;</th>
		<th data-tablesaw-priority="4" class="fieldnameback fieldname">&nbsp;<?php echo $text['location']; ?>&nbsp;</th>
<?php
	if( $mydivplace || $mydivyear ) { 
?>
		<th data-tablesaw-priority="3" class="fieldnameback fieldname nw">&nbsp;<b><?php echo $divsort; ?></b>&nbsp;</th>
		<th data-tablesaw-priority="5" class="fieldnameback fieldname">&nbsp;<?php echo $text['location']; ?>&nbsp;</th>
<?php
	}
	if($numtrees > 1) {
?>
		<th data-tablesaw-priority="5" class="fieldnameback fieldname nw">&nbsp;<?php echo $text['tree']; ?>&nbsp;</th>
<?php
	}
?>
	</tr></thead>
<?php
$i = $offsetplus;
//$chartlinkimg = @GetImageSize($cms['tngpath'] . "img/Chart.gif");
$chartlink = "<img src=\"{$cms['tngpath']}img/Chart.gif\" class=\"chartimg\">";
while( $row = tng_fetch_assoc($result))
{
	//assemble frow and mrow, override family living flag if allow_living for either of these is no
	$frow = array(
		"firstname" => $row['ffirstname'],
		"lnprefix" => $row['flnprefix'],
		"lastname" => $row['flastname'],
		"title" => $row['ftitle'],
		"prefix" => $row['fprefix'],
		"suffix" => $row['fsuffix'],
		"birthdate" => $row['fbirthdate'],
		"birthdatetr" => $row['fbirthdatetr'],
		"altbirthdate" => $row['faltbirthdate'],
		"altbirthdatetr" => $row['faltbirthdatetr'],
		"deathdate" => $row['fdeathdate'],
		"living" => $row['fliving'],
		"private" => $row['fprivate'],
		"personID" => $row['fpersonID'],
		"branch" => $row['fbranch'],
		"gedcom" => $row['gedcom']
	);
	$rights = determineLivingPrivateRights($frow);
	$frow['allow_living'] = $rights['living'];
	$frow['allow_private'] = $rights['private'];

	$mrow = array(
		"firstname" => $row['mfirstname'],
		"lnprefix" => $row['mlnprefix'],
		"lastname" => $row['mlastname'],
		"title" => $row['mtitle'],
		"prefix" => $row['mprefix'],
		"suffix" => $row['msuffix'],
		"birthdate" => $row['mbirthdate'],
		"birthdatetr" => $row['mbirthdatetr'],
		"altbirthdate" => $row['maltbirthdate'],
		"altbirthdatetr" => $row['maltbirthdatetr'],
		"deathdate" => $row['mdeathdate'],
		"living" => $row['mliving'],
		"private" => $row['mprivate'],
		"branch" => $row['mbranch'],
		"personID" => $row['mpersonID'],
		"gedcom" => $row['gedcom']
	);
	$rights = determineLivingPrivateRights($mrow);
	$mrow['allow_living'] = $rights['living'];
	$mrow['allow_private'] = $rights['private'];

	$rights = determineLivingPrivateRights($row);
	if( $rights['both'] ) {
		$marrdate = $row['marrdate'] ? displayDate($row['marrdate']) : "";
		$marrplace = $row['marrplace'] ? $row['marrplace'] . " " . placeImage($row['marrplace']) : "";
		$divdate = $row['divdate'] ? displayDate($row['divdate']) : "";
		$divplace = $row['divplace'] ? $row['divplace'] . " " . placeImage($row['divplace']) : "";
	}
	else
		$marrdate = $marrplace = $divdate = $divplace = $livingOK = "";

	$fname = getNameRev( $frow );
	$mname = getNameRev( $mrow );

	$famidstr = "<a href=\"$familygroup_url" . "familyID={$row['familyID']}&amp;tree={$row['gedcom']}\" class=\"fam\" id=\"f{$row['familyID']}_t{$row['gedcom']}\">{$row['familyID']} </a>";

	echo "<tr>";
	echo "<td class=\"databack\" valign=\"top\">$i</td>\n";
	$i++;

		echo "<td class=\"databack\">$famidstr";
		if($sitever != "mobile")
			echo "<div class=\"person-img\" id=\"mi{$row['gedcom']}_{$row['familyID']}\"><div class=\"person-prev\" id=\"prev{$row['gedcom']}_{$row['familyID']}\"></div></div>\n";
		echo "&nbsp;</td>";
		echo "<td class=\"databack\">$fname&nbsp;</td><td class=\"databack\">$mname&nbsp;</td>";
		echo "<td class=\"databack\">$marrdate&nbsp;</td><td class=\"databack\">$marrplace&nbsp;</td>";
		if( $mydivyear || $mydivplace ) echo "<td class=\"databack\">$divdate </td><td class=\"databack\">$divplace&nbsp;</td>";

		if($numtrees > 1)
			echo "<td class=\"databack\"><a href=\"$showtree_url" . "tree={$row['gedcom']}\">{$row['treename']}</a>&nbsp;</td>";

	echo "</tr>\n";
}
tng_free_result($result);
?>
</table>

<?php
echo "<p>$pagenav</p><br />";
tng_footer( "" );
?>