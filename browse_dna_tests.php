<?php
$textpart = "dna";
include("tng_begin.php");

if($tngconfig['hidedna'] && (!$allow_edit || !$allow_add || $assignedtree)) {
	header( "Location: thispagedoesnotexist.html" );
	exit;
}
include($cms['tngpath'] . "functions.php");
include($cms['tngpath'] . "personlib.php" );

$browse_dna_tests_url = getURL( "browse_dna_tests", 1 );
$show_dna_test_url = getURL( "show_dna_test", 1 );
$showtree_url = getURL( "showtree", 1 );
$getperson_url = getURL( "getperson", 1 );
$placesearch_url = getURL( "placesearch", 1 );
$familygroup_url = getURL( "familygroup", 1 );

if( empty($_SESSION['tnglastpage']) || strpos($_SESSION['tnglastpage'], "browse_dna_tests.php") === false ) {
	unset ($_SESSION['browse_dna']);
} else {
	if( empty($_SESSION['browse_dna']) || !empty($_POST['reset']) ) $_SESSION['browse_dna'] = array();
	if( isset($_POST['tree']) ) $_SESSION['browse_dna']['tree'] = $_POST['tree'] == "-x--all--x-" ? "" : $_POST['tree'];
	if( isset($_POST['test_type']) ) $_SESSION['browse_dna']['test_type'] = $_POST['test_type'];
	if( isset($_POST['test_group']) ) $_SESSION['browse_dna']['test_group'] = $_POST['test_group'];
	if( empty($tree) && isset($_SESSION['browse_dna']['tree']) ) $tree = $_SESSION['browse_dna']['tree'];
	if( !isset($test_type) && isset($_SESSION['browse_dna']['test_type']) ) $test_type = $_SESSION['browse_dna']['test_type'];
	if( !isset($test_group) && isset($_SESSION['browse_dna']['test_group']) ) $test_group = $_SESSION['browse_dna']['test_group'];
}

if( !empty($test_type) && $test_type != "atDNA" && $test_type != "mtDNA" && $test_type != "X-DNA" && $test_type != "Y-DNA" ) $test_type = "";
if( !empty($test_group) ) $test_group = cleanIt($test_group);
if( !empty($tree) ) $tree = cleanIt($tree);

$maxsearchresults = $maxdnasearchresults ? $maxdnasearchresults : $maxsearchresults;

function get_test_groups($test_type, $test_group) {
	global $text, $dna_groups_table;
	$wherestr2 = $test_type ? " AND test_type = \"$test_type\"" : "";
	$groupquery = "SELECT dna_group, description, test_type, gedcom FROM $dna_groups_table WHERE description IS NOT NULL $wherestr2 ORDER BY description";
	$groupsel = "	<option value=\"\">{$text['allgroups']}</option>\n";
	$groupresult = tng_query($groupquery);
	while( $grouprow = tng_fetch_assoc($groupresult) ) {
		$groupsel .= "	<option value=\"{$grouprow['dna_group']}\"";
		if( $grouprow['dna_group'] == $test_group ) $groupsel .= " selected";
		$groupsel .= ">{$grouprow['description']}</option>\n";
	}
	tng_free_result($groupresult);
	return $groupsel;
}

function doTestSearch( $instance, $pagenav ) {
	global $text, $testsearch, $tree, $test_type;

	$browse_dna_tests_noargs_url = getURL( "browse_dna_tests", 0 );

	$str = getFORM( "browse_dna_tests", "get", "TestSearch$instance", "" );
	$str .= "<input type=\"text\" name=\"testsearch\" value=\"" . htmlspecialchars($testsearch) . "\" /> <input type=\"submit\" value=\"{$text['search']}\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	$str .= $pagenav;
	if( $testsearch )
		$str .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"$browse_dna_tests_noargs_url\">{$text['browsealltests']}</a>";
	$str .= "<input type=\"hidden\" name=\"tree\" value=\"$tree\" />\n";
	$str .= "</form>\n";

	return $str;
}

$max_browse_test_pages = 5;
if(!empty($offset)) {
	$offsetplus = $offset + 1;
	$newoffset = "$offset, ";
}
else {
	$offsetplus = 1;
	$newoffset = "";
	$page = 1;
}

$testsearch = isset($testsearch) ? trim($testsearch) : '';
$sqltestsearch = cleanIt($testsearch);
if( $tree ) {
	$wherestr = "WHERE $dna_tests_table.gedcom = \"$tree\"";
	if( $sqltestsearch ) $wherestr .= " AND (test_type LIKE \"%$sqltestsearch%\" OR test_number LIKE \"%$sqltestsearch%\" OR vendor LIKE \"%$sqltestsearch%\" OR notes LIKE \"%$sqltestsearch%\" OR dna_group LIKE \"%$sqltestsearch%\" OR dna_group_desc LIKE \"%$sqltestsearch%\" OR surnames LIKE \"%$sqltestsearch%\")";
	$join = "INNER JOIN";
}
else {
	if( $sqltestsearch )
		$wherestr = "WHERE test_type LIKE \"%$sqltestsearch%\" OR test_number LIKE \"%$sqltestsearch%\" OR vendor LIKE \"%$sqltestsearch%\" OR notes LIKE \"%$sqltestsearch%\" OR dna_group LIKE \"%$sqltestsearch%\" OR dna_group_desc LIKE \"%$sqltestsearch%\" OR surnames LIKE \"%$sqltestsearch%\"";
	else
		$wherestr = "";
	$join = "LEFT JOIN";
}

//	only return tests not marked "keep test private" if user does not have "Allow Private" privilege
if (!$allow_private) {
	if ($wherestr)
		$wherestr .= " AND $dna_tests_table.private_test != \"1\" ";
	else
		$wherestr .= " WHERE $dna_tests_table.private_test != \"1\" ";
}
else
	$wherestr .= "";

$test_hdr = $admtext['dna_tests'];

if(!isset( $test_type )) $test_type = '';
if($test_type) {
	switch ($test_type) {
		case "Y-DNA":
			$test_hdr = $text['ydna_test'];
			break;
		case "mtDNA":
			$test_hdr = $text['mtdna_test'];
			break;
		case "atDNA":
			$test_hdr = $text['atdna_test'];
			break;
	}
	if($wherestr)
		$wherestr .= " AND $dna_tests_table.test_type = \"$test_type\"";
	else
		$wherestr = "WHERE $dna_tests_table.test_type = \"$test_type\"";
}
if(!isset($test_group)) $test_group = '';
if($test_group) {
	$admtext['dna_tests'] .= ": " . $test_group;
	if($wherestr)
		$wherestr .= " AND $dna_tests_table.dna_group = \"$test_group\"";
	else
		$wherestr = "WHERE $dna_tests_table.dna_group = \"$test_group\"";
}

$query = "SELECT testID, test_type, test_number, vendor, $dna_tests_table.gedcom, $dna_tests_table.personID, treename, ydna_haplogroup, mtdna_haplogroup, markers, ydna_confirmed, mtdna_confirmed, person_name, private_dna, private_test, dna_group, dna_group_desc, surnames, MD_ancestorID, MRC_ancestorID
	FROM $dna_tests_table $join $trees_table on $dna_tests_table.gedcom = $trees_table.gedcom $wherestr
	ORDER BY test_type, CAST(chromosome AS UNSIGNED), CAST(segment_start AS UNSIGNED), CAST(segment_end AS UNSIGNED), dna_group_desc, personID, vendor, test_date  LIMIT $newoffset" . $maxsearchresults;
$result = tng_query($query);

$numrows = tng_num_rows( $result );

if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
	if( $tree )
		$query = "SELECT count(testID) as tcount FROM $dna_tests_table LEFT JOIN $trees_table on $dna_tests_table.gedcom = $trees_table.gedcom $wherestr";
	else
		$query = "SELECT count(testID) as tcount FROM $dna_tests_table $wherestr";
	$result2 = tng_query($query);
	$row = tng_fetch_assoc( $result2 );
	$totrows = $row['tcount'];
}
else
	$totrows = $numrows;

if(!isset( $offset )) $offset = 0;
$numrowsplus = $numrows + $offset;

$treestr = $tree ? " ({$text['tree']}: $tree)" : "";
$logstring = "<a href=\"$browse_dna_tests_url" . "tree=$tree&amp;offset=$offset&amp;testsearch=$testsearch\">" . xmlcharacters($admtext['dna_tests'].$treestr) . "</a>";
writelog($logstring);
preparebookmark($logstring);
$flags['scripting'] = "<script type=\"text/javascript\">
//<![CDATA[
function resetForm() {
	if(document.form1.tree) {
		document.form1.tree.selectedIndex=0;
	}
	document.form1.test_type.selectedIndex=0;
	document.form1.test_group.selectedIndex=0;
}
//]]>
</script>";
tng_header( $admtext['dna_tests'], $flags );
?>

<h1 class="header"><span class="headericon" id="dna-hdr-icon"></span><?php echo $test_hdr; ?></h1><br />
<?php
echo "<div class=\"normal\">\n";
?>

	<form action="browse_dna_tests.php" method="post" name="form1" id="form1">
	<table class="normal">
		<tr>
			<td>
<?php
	$numtrees = 1;
	if(!$requirelogin || !$treerestrict || !$assignedtree) {
		$wherestr = $allow_admin ? "" : "WHERE secret != 2";
		$query = "SELECT gedcom, treename FROM $trees_table $wherestr ORDER BY treename";
		$treeresult = tng_query($query);
		$numtrees = tng_num_rows($treeresult);
		if( $numtrees > 1 ) {
			$ret = "";
			$ret .= "<span class=\"normal\">{$text['tree']}: </span>";
			$ret .= "<select name=\"tree\" id=\"treeselect\" onchange=\"jQuery('#treespinner').show();document.form1.submit();\">\n";
			$ret .= "<option value=\"-x--all--x-\" ";
			if( !$tree ) $ret .= "selected=\"selected\"";
			$ret .= ">{$text['alltrees']}</option>\n";

			while( $row = tng_fetch_assoc($treeresult) ) {
				$ret .= "<option value=\"{$row['gedcom']}\"";
				if( $tree && $row['gedcom'] == $tree ) $ret .= " selected=\"selected\"";
				$ret .= ">{$row['treename']}</option>\n";
			}
			$ret .= "</select>\n";
			tng_free_result($treeresult);
			$ret .= "&nbsp; <img src=\"{$cms['tngpath']}img/spinner.gif\" style=\"display:none;\" id=\"treespinner\" alt=\"\" class=\"spinner\"/>\n";
			echo $ret;
		}
	}
?>
			</td>
			<td>
				<?php echo $text['test_type']; ?>:
				<select name="test_type" id="test_type" onchange="jQuery('#treespinner2').show();document.form1.test_group.selectedIndex = 0;document.form1.submit();">
				<option value=""><?php echo $text['alltypes']; ?></option>
				<option value="atDNA"<?php if($test_type == "atDNA") echo " selected"; ?>><?php echo $admtext['atdna_test']; ?></option>
				<option value="Y-DNA"<?php if($test_type == "Y-DNA") echo " selected"; ?>><?php echo $admtext['ydna_test']; ?></option>
				<option value="mtDNA"<?php if($test_type == "mtDNA") echo " selected"; ?>><?php echo $admtext['mtdna_test']; ?></option>
				<option value="X-DNA"<?php if($test_type == "X-DNA") echo " selected"; ?>><?php echo $admtext['xdna_test']; ?></option>
				</select>&nbsp;<img src=<?php echo"{$cms['tngpath']}img/spinner.gif"; ?> style="display:none;" id="treespinner2" alt="" class="spinner">&nbsp;&nbsp;&nbsp;
			</td>
			<td>
				<?php echo $text['testgroup']; ?>:
				<select name="test_group" id="test_group" onchange="jQuery('#treespinner3').show();document.form1.submit();">
<?php
echo get_test_groups($test_type, $test_group);
?>
				</select>&nbsp;<img src=<?php echo"{$cms['tngpath']}img/spinner.gif"; ?> style="display:none;" id="treespinner3" alt="" class="spinner">&nbsp;&nbsp;&nbsp;
				<input type="submit" name="reset" value="<?php echo $text['tng_reset']; ?>" onclick="resetForm();">
			<br/>
			</td>
		</tr>
	</table>
	</form>
<?php
$_SESSION["ttree"] = $tree;
$_SESSION["ttype"] = $test_type;
$_SESSION["tgroup"] = $test_group;
$_SESSION["tsearch"] = $testsearch;

if( $totrows )
	echo "<p><span class=\"normal\">{$text['matches']} $offsetplus {$text['to']} $numrowsplus {$text['of']} $totrows</span></p>";

$pagenav = get_browseitems_nav( $totrows, $browse_dna_tests_url . "testsearch=$testsearch&amp;offset", $maxsearchresults, $max_browse_test_pages );
if( $pagenav || $testsearch ) {
	echo doTestSearch( 1, $pagenav );
	echo "<br />\n";
}

$header = "";
$headerr = $enableminimap ? " data-tablesaw-minimap" : "";
$headerr .= $enablemodeswitch ? " data-tablesaw-mode-switch" : "";

?>
<script type="text/javascript">
//<![CDATA[
function toggleAll( flag ) {
	for( var i = 0; i < document.form2.elements.length; i++ ) {
		if( document.form2.elements[i].type == "checkbox" ) {
			if( flag )
				document.form2.elements[i].checked = true;
			else
				document.form2.elements[i].checked = false;
		}
	}
}

function validateCompare( ) {
	var count = 0;
	for( var i = 0; i < document.form2.elements.length; i++ ) {
		if( document.form2.elements[i].type == "checkbox" ) {
			if( document.form2.elements[i].checked )
				count++;
		}
	}
	if( count < 2) {
		alert("<?php echo $text['comparemore']; ?>");
		return false;
	}
	return true;
}
//]]>
</script>
<?php if ($test_type && $test_type != "X-DNA") {
if ($test_type == "Y-DNA") $compare_url = "compare_selected_ydna.php";
if ($test_type == "atDNA") $compare_url = "compare_selected_atdna.php";
if ($test_type == "mtDNA") $compare_url = "compare_selected_mtdna.php";
?>
	<form action="<?php echo $compare_url;?>" method="post" onsubmit="return validateCompare();" name="form2">
		<p class="nw">
		<input type="button" name="selectall" value="<?php echo $admtext['selectall']; ?>" onClick="toggleAll(1);">
		<input type="button" name="clearall" value="<?php echo $admtext['clearall']; ?>" onClick="toggleAll(0);">&nbsp;&nbsp;
		<input type="submit" name="cdnaaction" value="<?php echo $text['compareselected']; ?>">&nbsp;&nbsp;
		</p>
<?php
	}

if ($sitever != "standard") {
	if ($tabletype == "toggle") {
		$header = "<table class=\"tablesaw thfixed whiteback normal resultstable\" data-tablesaw-mode=\"columntoggle\"{$headerr}>\n";
	} elseif ($tabletype == "stack") {
		$header = "<table class=\"tablesaw thfixed whiteback normal resultstable\" data-tablesaw-mode=\"stack\"{$headerr}>\n";
	} elseif ($tabletype == "swipe") {
		$header = "<table class=\"tablesaw thfixed whiteback normal resultstable\" data-tablesaw-mode=\"swipe\"{$headerr}>\n";
	}
} else {
	$header = "<table class=\"thfixed whiteback normal resultstable\">";
}
echo $header;
?>
	<thead>
		<tr>
		<th data-tablesaw-priority="persist" class="fieldnameback nbrcol fieldname resultstable">&nbsp;#&nbsp;</th>
<?php if ($test_type && $test_type != "X-DNA") { ?>
		<th data-tablesaw-priority="1" class="fieldnameback fieldname resultstable">&nbsp;<?php echo $admtext['select']; ?>&nbsp;</th>
<?php
	}
?>
		<th data-tablesaw-priority="1" class="fieldnameback fieldname resultstable">&nbsp;<?php echo $text['test_type']; ?>&nbsp;</th>
<?php
	if( $allow_edit || $showtestnumbers ) { ?>
		<th data-tablesaw-priority="2" class="fieldnameback fieldname resultstable">&nbsp;<?php echo $text['test_number']; ?>&nbsp;</th>
<?php
	}
?>
		<th data-tablesaw-priority="1" class="fieldnameback fieldname resultstable">&nbsp;<?php echo $text['haplogroup']; ?>&nbsp;</th>
		<th data-tablesaw-priority="4" class="fieldnameback fieldname resultstable">&nbsp;<?php echo $text['takenby']; ?>&nbsp;</th>
		<th data-tablesaw-priority="2" class="fieldnameback fieldname resultstable">&nbsp;<?php echo $admtext['mda']; ?>&nbsp;</th>
		<th data-tablesaw-priority="3" class="fieldnameback fieldname resultstable">&nbsp;<?php echo $admtext['mrca']; ?>&nbsp;</th>
		<th data-tablesaw-priority="5" class="fieldnameback fieldname resultstable">&nbsp;<?php echo $text['testgroup']; ?>&nbsp;</th>
		<?php if( $numtrees > 1 ) { ?><th data-tablesaw-priority="5" class="fieldnameback fieldname resultstable">&nbsp;<?php echo $text['tree']; ?>&nbsp;</th><?php } ?>
		</tr>
	</thead>
<?php
$i = $offsetplus;
while( $row = tng_fetch_assoc( $result ) )
{
	if ($row['private_test'] && ( $allow_private) || (!$row['private_test'])) {
		//	$group = $row['dna_group_desc'] ? $row['dna_group_desc'] : $text['none'];
		$query = "SELECT description FROM $dna_groups_table WHERE dna_group=\"{$row['dna_group']}\"";
		$descresult = tng_query($query);
		$descrow = tng_fetch_assoc( $descresult );
		tng_free_result($descresult);
		$group = $row['dna_group'] ? $descrow['description'] : $text['none'];

		echo "<tr><td style=\"vertical-align: top;\" class=\"databack\">$i</td>\n";
		if ($test_type && $test_type != "X-DNA")
			echo "<td class=\"databack\" style=\"vertical-align: top; text-align: center;\"><input type=\"checkbox\" name=\"dna{$row['testID']}\" value=\"1\"></td>";
		$dash = ($row['test_type'] == "Y-DNA") ? "-" : "";
		echo "<td style=\"vertical-align: top;\" class=\"databack\"><a href=\"$show_dna_test_url" . "group=" . urlencode($group) . "&amp;testID={$row['testID']}&amp;tree={$row['gedcom']}\">{$row['test_type']}$dash" . htmlspecialchars($row['markers']) . "</a>&nbsp;</td>";
		if ($allow_edit || $showtestnumbers) {
			if ($row['private_test'] )
				$privtest = "<br />&nbsp;(" . $admtext['text_private'] . ")";
			else
				$privtest = "";
			echo "<td style=\"vertical-align: top;\" class=\"databack\"><a href=\"$show_dna_test_url" . "group=" . urlencode($group) . "&amp;testID={$row['testID']}&amp;tree={$row['gedcom']}\">" . htmlspecialchars($row['test_number']) . "</a>&nbsp;$privtest</td>";
		}
		$haplogroup = "&nbsp;";
		if( $row['ydna_haplogroup'] && $row['test_type'] == "Y-DNA") {
			if( $row['ydna_confirmed'] )
				$haplogroup = "<span class='confirmed_haplogroup'>" . htmlspecialchars($row['ydna_haplogroup']) . "</span>";
			else
				$haplogroup = "<span class='predicted_haplogroup'>" . htmlspecialchars($row['ydna_haplogroup']) . "</span>";
		}
		if( $row['mtdna_haplogroup'] && $row['test_type'] == "mtDNA") {
			if( $row['mtdna_confirmed'] )
				$haplogroup = "<span class='confirmed_haplogroup'>" . htmlspecialchars($row['mtdna_haplogroup']) . "</span>";
			else
				$haplogroup = "<span class='predicted_haplogroup'>" . htmlspecialchars($row['mtdna_haplogroup']) . "</span>";
		}
		if ($row['test_type'] == "atDNA") {
			if ($row['ydna_haplogroup'])
				$haplogroup = "Y = " . htmlspecialchars($row['ydna_haplogroup']) . "<br />";
			if ($row['mtdna_haplogroup']) {
				$haplogroup .= "mt = " . htmlspecialchars($row['mtdna_haplogroup']);
			}
		}
		echo "<td style=\"vertical-align: top;\" class=\"databack nw\">&nbsp;$haplogroup</td>";

		$dna_pers_result = getPersonDataPlusDates($row['gedcom'], $row['personID']);
		$dprow = tng_fetch_assoc($dna_pers_result);
		if($dprow) {
			$dna_righttree = checktree($dprow['gedcom']);
			$dna_rightbranch = $dna_righttree ? checkbranch($dprow['branch']) : false;
			$dprights = determineLivingPrivateRights($dprow, $dna_righttree, $dna_rightbranch);
			$dprow['allow_living'] = $dprights['living'];
			$dprow['allow_private'] = $dprights['private'];
			$dbname = getName( $dprow );
			$person_name = htmlspecialchars($row['person_name']);
			$dna_namestr = getName($dprow);
		} else {
			$dbname = "";
			$person_name = $row['person_name'];
			$dna_namestr = "";
		}
		if ($row['private_dna'] && $allow_edit)
			$privacy = "&nbsp;(" . $admtext['text_private'] . ")";
		else
			$privacy = "";
		if ($dbname) {
			//$dna_namestr .= " ({$row['personID']})";
			if( empty($tree) ) $tree = $dprow['gedcom'];
			$placesearch_url = getURL( "placesearch", 1 );
			$dprow['birthplace'] = "";
			$dprow['altbirthplace'] = "";
			$dprow['deathplace'] = "";
			$dprow['burialplace'] = "";
			$vitalinfo = $dprights['both'] ? getBirthInfo($dprow) : "";
			$dna_namestr = "<a href=\"$getperson_url" . "personID={$row['personID']}&tree={$row['gedcom']}\">$dna_namestr</a>$privacy<br />" . str_replace( ', ', '  -', trim(ltrim($vitalinfo,",  ")));
		} else
			$dna_namestr = $person_name . $privacy;
		if ($row['private_dna'] && !$allow_edit) $dna_namestr = $admtext['text_private'];
		tng_free_result($dna_pers_result);

		//query the links table
		$query = "SELECT $dna_links_table.personID, lastname, lnprefix, firstname, birthdate, birthdatetr, altbirthdate, altbirthdatetr, altbirthplace,
			deathdate, deathdatetr, burialdate, burialplace,
			IF(birthdatetr !='0000-00-00',birthdatetr,altbirthdatetr) as birth,
			IF(deathdatetr !='0000-00-00',deathdatetr,burialdatetr) as death,
			prefix, suffix, nameorder, title, $dna_links_table.gedcom, branch, living, private
			FROM $dna_links_table, $people_table
			WHERE testID = \"{$row['testID']}\" AND $dna_links_table.personID = $people_table.personID AND $dna_links_table.gedcom = $people_table.gedcom
			ORDER BY birth DESC, lastname, firstname LIMIT $maxsearchresults";
		$presult = tng_query($query);
		$numrows = tng_num_rows( $presult );
		$dnalinktext = "";
		$counter = 1;
		while( $prow = tng_fetch_assoc( $presult ) ) {
			if($prow['personID'] != $row['personID'] || $prow['gedcom'] != $row['gedcom']) {
				if( $dnalinktext ) $dnalinktext .= "<br/>\n";
				$righttree = checktree($prow['gedcom']);
				$rightbranch = $righttree ? checkbranch($prow['branch']) : false;
				$rights = determineLivingPrivateRights($prow, $righttree, $rightbranch);
				$name = "$counter. ";
				if(!$rights['living'])
					$name .= $text['living'];
				elseif(!$rights['private'])
					$name .= $admtext['text_private'];
				else {
					$prow['allow_living'] = $rights['living'];
					$prow['allow_private'] = $rights['private'];
					if( empty($tree) ) $tree = $prow['gedcom'];
					$placesearch_url = getURL( "placesearch", 1 );
					$prow['birthplace'] = "";
					$prow['altbirthplace'] = "";
					$prow['deathplace'] = "";
					$prow['burialplace'] = "";
					$vitalinfo = $rights['both'] ? getBirthInfo($prow) : "";
					$name .= "<a href=\"$getperson_url" . "personID={$prow['personID']}&amp;tree={$prow['gedcom']}\">" . getName( $prow ) . "</a><br />" . str_replace( ', ', '  -', trim(ltrim($vitalinfo,",  ")));
				}
				$counter++;
				$dnalinktext .= $name;
			}
		}
		tng_free_result($presult);

		if($dnalinktext) {
			$more = "<a href=\"#\" onclick=\"\$('#more_{$row['testID']}').slideToggle();return false;\" title=\"{$text['moreind']}\"><img src=\"{$cms['tngpath']}img/ArrowDown.gif\" alt=\"{$text['more']}\" /></a> ";
			$morediv = "<div style=\"display:none\" id=\"more_{$row['testID']}\"><hr class=\"mtitlehr\"/><strong>{$text['indlinked']}:</strong><br/>$dnalinktext</div>";
		}
		else
			$more = $morediv = "";

		echo "<td style=\"vertical-align: top;\" class=\"databack\">$more$dna_namestr&nbsp;$morediv</td>";
		$mdanc_namestr = "";
		if($row['MD_ancestorID']) {
			$dna_anc_result = getPersonDataPlusDates($row['gedcom'], $row['MD_ancestorID']);
			$ancrow = tng_fetch_assoc($dna_anc_result);
			if( $ancrow ) {
				if( empty($tree) ) $tree = $ancrow['gedcom'];
				$placesearch_url = getURL( "placesearch", 1 );
				$ancrow['birthplace'] = "";
				$ancrow['altbirthplace'] = "";
				$ancrow['deathplace'] = "";
				$ancrow['burialplace'] = "";
				$dna_righttree = checktree($ancrow['gedcom']);
				$dna_rightbranch = $dna_righttree ? checkbranch($ancrow['branch']) : false;
				$dprights = determineLivingPrivateRights($ancrow, $dna_righttree, $dna_rightbranch);
				$ancrow['allow_living'] = $dprights['living'];
				$ancrow['allow_private'] = $dprights['private'];
				$vitalinfo = getBirthInfo($ancrow);
				$anc_namestr = getName( $ancrow );
				$mdanc_namestr = "<a href=\"$getperson_url" . "personID={$row['MD_ancestorID']}&tree={$row['gedcom']}\">$anc_namestr</a>" . "<br />" . str_replace( ', ', '  -', trim(ltrim($vitalinfo,",  ")));
			}

			tng_free_result($dna_anc_result);
		}
		$mrcanc_namestr = "";
		if($row['MRC_ancestorID']) {
			if ($row['MRC_ancestorID'][0] == "I") {
				$dna_anc_result = getPersonDataPlusDates($row['gedcom'], $row['MRC_ancestorID']);
				$ancrow = tng_fetch_assoc($dna_anc_result);
				if( $ancrow ) {
					if( empty($tree) ) $tree = $ancrow['gedcom'];
					$placesearch_url = getURL( "placesearch", 1 );
					$ancrow['birthplace'] = "";
					$ancrow['altbirthplace'] = "";
					$ancrow['deathplace'] = "";
					$ancrow['burialplace'] = "";
					$dna_righttree = checktree($ancrow['gedcom']);
					$dna_rightbranch = $dna_righttree ? checkbranch($ancrow['branch']) : false;
					$dprights = determineLivingPrivateRights($ancrow, $dna_righttree, $dna_rightbranch);
					$ancrow['allow_living'] = $dprights['living'];
					$ancrow['allow_private'] = $dprights['private'];
					$vitalinfo = getBirthInfo($ancrow);
					$anc_namestr = getName( $ancrow );
					$mrcanc_namestr = "<a href=\"$getperson_url" . "personID={$row['MRC_ancestorID']}&tree={$row['gedcom']}\">$anc_namestr</a>" . "<br />" . str_replace( ', ', '  -', trim(ltrim($vitalinfo,",  ")));
				}
				tng_free_result($dna_anc_result);
			}
			else if ($row['MRC_ancestorID'][0] == "F") {
				$mrcquery = "SELECT familyID, husband, wife, living, private, marrdate, gedcom, branch FROM $families_table WHERE familyID = \"{$row['MRC_ancestorID']}\" AND gedcom = \"{$row['gedcom']}\"";
				$mrcresult = tng_query($mrcquery);
				$famrow = tng_fetch_assoc($mrcresult);
				tng_free_result($mrcresult);

				if( $famrow ) {
					$righttree = checktree($famrow['gedcom']);
					$rightbranch = checkbranch($famrow['branch']);
					$rights = determineLivingPrivateRights($famrow, $righttree, $rightbranch);
					$famrow['allow_living'] = $rights['living'];
					$famrow['allow_private'] = $rights['private'];

					$famname = getFamilyName( $famrow );
					$fammarried = "<br />&nbsp;&nbsp;<strong>{$text['marrabbr']}</strong>&nbsp;" . $famrow['marrdate'];
					$mrcanc_namestr = "<a href=\"$familygroup_url" . "familyID={$row['MRC_ancestorID']}&tree={$row['gedcom']}\">$famname</a>" .$fammarried ;
				}
			}
		}
		echo "<td style=\"vertical-align: top;\" class=\"databack\">&nbsp;$mdanc_namestr</td>";
		echo "<td style=\"vertical-align: top;\" class=\"databack\">&nbsp;$mrcanc_namestr</td>";
		echo "<td style=\"vertical-align: top;\" class=\"databack\">$group</td>";
		if( $numtrees > 1 )
			echo "<td style=\"vertical-align: top;\" class=\"databack nw\"><a href=\"$showtree_url" . "tree={$row['gedcom']}\">{$row['treename']}</a>&nbsp;</td>";
		echo "</tr>\n";
		$i++;
	}
}
tng_free_result($result);
?>
	</table>
<?php
if ($test_type && $test_type != "X-DNA") {
?>
</form>
<?php }?>
<br />
</div>
<?php
if( $pagenav || $testsearch )
	echo doTestSearch( 2, $pagenav ) . "<br />\n";

tng_footer( "" );
?>
