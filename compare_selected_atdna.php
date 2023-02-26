<?php
$textpart = "dna";
include("tng_begin.php");
include($cms['tngpath'] . "adminlib.php" );
include($cms['tngpath'] . "personlib.php" );

if($tngconfig['hidedna'] && (!$allow_edit || !$allow_add || $assignedtree)) {
	header( "Location: thispagedoesnotexist.html" );
	exit;
}


$dnatree = isset($_SESSION["ttree"]) ? $_SESSION["ttree"] : "-x--all--x-";
$test_search = isset($_SESSION["tsearch"]) ? $_SESSION["tsearch"] : "";
$test_type = isset($_SESSION["ttype"]) ? $_SESSION["ttype"] : "";
$test_group = isset($_SESSION["tgroup"]) ? $_SESSION["tgroup"] : "";

$compare_count = 0;
if( strpos($_SESSION['tnglastpage'], "compare_selected_atdna.php") === false ) {
	unset ($_SESSION['compare_atdna']);
	$_SESSION['compare_atdna'] = array();
	foreach( array_keys($_POST) as $key ) {
		if( substr( $key, 0, 3 ) == "dna" ) {
			$_SESSION['compare_atdna'][$key] = 1;
			$compare_count++;
		}
	}
	if( $compare_count < 2 ) {
		header( "Location: browse_dna_tests.php?tree=-x--all--x-&amp;testsearch=&amp;test_type=atDNA&amp;test_group=", true );
		exit;
	}
} else {
	foreach( array_keys($_SESSION['compare_atdna']) as $key ) {
		if( substr( $key, 0, 3 ) == "dna" ) {
			if( !isset($_POST[$key]) ) $_POST[$key] = "1";
		}
	}
}

$compare_selected_atdna_url = getURL( "compare_selected_atdna", 1 );

$getperson_url = getURL( "getperson", 1 );
$familygroup_url = getURL( "familygroup", 1 );
$show_dna_test_url = getURL( "show_dna_test", 1 );
$showtree_url = getURL( "showtree", 1 );

$text['dnatestscompare_atdna'] .= $test_group ? ": " . $test_group : ": " . $text['allgroups'];

tng_header( $text['dnatestscompare_atdna'], $flags );

	// Fix the url to be correct and escaped.
	$innermenu = "<a href=\"https://tng.lythgoes.net/wiki/index.php?title=Compare_DNA_Test_Results\" target=\"_blank\" class=\"lightlink\">{$text['help']}</a>";
	// Y-DNA Tests
	$innermenu .= "&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"browse_dna_tests.php?tree=-x--all--x-&amp;testsearch=&amp;test_type=Y-DNA&amp;test_group=\" class=\"lightlink\">{$admtext['ydna_test']}</a>";
	// mtDNA Tests
	$innermenu .= "&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"browse_dna_tests.php?tree=-x--all--x-&amp;testsearch=&amp;test_type=mtDNA&amp;test_group=\" class=\"lightlink\">{$admtext['mtdna_test']}</a>";
	// atDNA Tests
	$innermenu .= "&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"browse_dna_tests.php?tree=-x--all--x-&amp;testsearch=&amp;test_type=atDNA&amp;test_group=\" class=\"lightlink\">{$admtext['atdna_test']}</a>";

	$menu = tng_menu("DCAT","compare","",$innermenu);
?>
<h1 class="header"><span class="headericon" id="dna-hdr-icon"></span><?php echo $text['dnatestscompare_atdna']; ?></h1><br />
<?php
echo $menu;

$treestr = $tree ? " ({$text['tree']}: $tree)" : "";
$logstring = "<a href=\"$compare_selected_atdna_url" . "tree=$dnatree&amp;test_group=$test_group&amp;testsearch=$test_search\">" . xmlcharacters($text['dnatestscompare_atdna'].$treestr) . "</a>";
writelog($logstring);
preparebookmark($logstring);

$header = "";
$headerr = $enableminimap ? " data-tablesaw-minimap" : "";
$headerr .= $enablemodeswitch ? " data-tablesaw-mode-switch" : "";

if ($sitever != "standard") {
	if ($tabletype == "toggle") {
		$header = "<table class=\"tablesaw whiteback normal dnacomparetable\" data-tablesaw-mode=\"columntoggle\"{$headerr}>\n";
	} elseif ($tabletype == "stack") {
		$header = "<table class=\"tablesaw whiteback normal dnacomparetable\" data-tablesaw-mode=\"stack\"{$headerr}>\n";
	} elseif ($tabletype == "swipe") {
		$header = "<table class=\"tablesaw whiteback normal dnacomparetable\" data-tablesaw-mode=\"swipe\"{$headerr}>\n";
	}
} else {
	$header = "<table class=\"whiteback normal dnacomparetable\">";
}
echo "<div class=\"overflowauto\">";
echo $header;
?>
	<thead>
		<tr>
<?php
	if( $allow_edit || $showtestnumbers ) { ?>
		<th colspan="4" class="fieldnameback fieldname center dnacomparetable" >&nbsp;<?php echo $text['dna_test']; ?>&nbsp;</th>
<?php
	} else { ?>
		<th colspan="3" class="fieldnameback fieldname center dnacomparetable" >&nbsp;<?php echo $text['dna_test']; ?>&nbsp;</th>
<?php
	}
?>
		<th colspan="5" class="fieldnameback fieldname center dnacomparetable">&nbsp;<?php echo $admtext['largest_segment']; ?>&nbsp;</th>
		<th data-tablesaw-priority="3" colspan="2" class="fieldnameback fieldname center dnacomparetable">&nbsp;<?php echo $text['haplogroup']; ?>&nbsp;</th>
		<th data-tablesaw-priority="4" colspan="4" class="fieldnameback fieldname center dnacomparetable">&nbsp;<?php echo $text['relationship']; ?>&nbsp;</th>
		<th data-tablesaw-priority="4" class="fieldnameback fieldname center dnacomparetable">&nbsp;</th>
		</tr>
		<tr>
		<th data-tablesaw-priority="persist" class="fieldnameback nbrcol fieldname dnacomparetable">&nbsp;#&nbsp;</th>

<?php
	if( $allow_edit || $showtestnumbers ) { ?>
		<th data-tablesaw-priority="2" class="fieldnameback fieldname nw dnacomparetable">&nbsp;<?php echo $text['test_number']; ?>&nbsp;</th>
<?php
	}
?>
		<th data-tablesaw-priority="1" class="fieldnameback fieldname nw dnacomparetable">&nbsp;<?php echo $text['takenby']; ?>&nbsp;</th>
		<th data-tablesaw-priority="3" class="fieldnameback fieldname nw dnacomparetable">&nbsp;<?php echo $admtext['vendor']; ?>&nbsp;</th>
		<th data-tablesaw-priority="2" class="fieldnameback fieldname nw dnacomparetable">&nbsp;<?php echo $text['chromosome'] ; ?>&nbsp;</th>
		<th data-tablesaw-priority="2" class="fieldnameback fieldname nw dnacomparetable">&nbsp;<?php echo $text['segment_start'] ; ?>&nbsp;</th>
		<th data-tablesaw-priority="2" class="fieldnameback fieldname nw dnacomparetable">&nbsp;<?php echo $text['segment_end'] ; ?>&nbsp;</th>
		<th data-tablesaw-priority="2" class="fieldnameback fieldname nw dnacomparetable">&nbsp;<?php echo $text['centiMorgans']; ?>&nbsp;</th>
		<th data-tablesaw-priority="2" class="fieldnameback fieldname nw dnacomparetable">&nbsp;<?php echo $text['snps']; ?>&nbsp;</th>
		<th data-tablesaw-priority="3" class="fieldnameback fieldname nw dnacomparetable">&nbsp;<?php echo $text['y_haplogroup']; ?>&nbsp;</th>
		<th data-tablesaw-priority="3" class="fieldnameback fieldname nw dnacomparetable">&nbsp;<?php echo $text['mt_haplogroup']; ?>&nbsp;</th>
		<th data-tablesaw-priority="4" class="fieldnameback fieldname nw dnacomparetable">&nbsp;<?php echo $text['suggested_relationship']; ?>&nbsp;</th>
		<th data-tablesaw-priority="4" class="fieldnameback fieldname nw dnacomparetable">&nbsp;<?php echo $text['actual_relationship']; ?>&nbsp;</th>
		<th data-tablesaw-priority="4" class="fieldnameback fieldname nw dnacomparetable">&nbsp;<?php echo $text['mrca']; ?>&nbsp;</th>
		<th data-tablesaw-priority="4" class="fieldnameback fieldname nw dnacomparetable">&nbsp;<?php echo $admtext['related_side']; ?>&nbsp;</th>
		<th data-tablesaw-priority="4" class="fieldnameback fieldname nw dnacomparetable">&nbsp;<?php echo $text['testgroup']; ?>&nbsp;</th>
		<?php
		global $numtrees;
		if( !$assignedtree && ($numtrees > 1 )) { ?><th data-tablesaw-priority="5" class="fieldnameback fieldname dnacomparetable">&nbsp;<?php echo $text['tree']; ?>&nbsp;</th><?php } ?>
		</tr>
	</thead>
<?php
$i=1;
foreach( array_keys($_POST) as $key ) {
	if( substr( $key, 0, 3 ) == "dna" ) {
		$testID = cleanIt(substr( $key, 3 ));
		$query = "SELECT * FROM $dna_tests_table WHERE testID=$testID ORDER BY CAST(chromosome AS UNSIGNED), CAST(segment_start AS UNSIGNED), CAST(segment_end AS UNSIGNED)";
		$result = tng_query($query);
		$row = tng_fetch_assoc( $result );
		tng_free_result($result);
		
		//	add striping every other row
		if (empty($databack) || $databack == "databack")
			$databack = "databackalt";
		else
			$databack = "databack";
		
		echo "<tr><td class=\"$databack\">$i</td>\n";
		if ($allow_edit || $showtestnumbers) {
			if ($row['private_test'] )
				$privtest = "<br />&nbsp;(" . $admtext['text_private'] . ")";
			else
				$privtest = "";
			echo "<td class=\"$databack\"><a href=\"$show_dna_test_url" . "group=$test_group&amp;testID={$row['testID']}&amp;tree={$row['gedcom']}\">{$row['test_number']}</a>&nbsp;$privtest</td>";
		}
		
		$dna_pers_result = getPersonData($row['gedcom'], $row['personID']);
		$dprow = tng_fetch_assoc($dna_pers_result);
		if( $dprow ) {
			$dna_righttree = checktree($dprow['gedcom']);
			$dna_rightbranch = $dna_righttree ? checkbranch($dprow['branch']) : false;
			$dprights = determineLivingPrivateRights($dprow, $dna_righttree, $dna_rightbranch);
			$dprow['allow_living'] = $dprights['living'];
			$dprow['allow_private'] = $dprights['private'];
			$dbname = getName( $dprow );
			$person_name = $row['person_name'];
			$dna_namestr = getName($dprow);
			$vitalinfo = getBirthInfo($dprow);
		} else {
			$dbname = "";
			$person_name = $row['person_name'];
			$dna_namestr = "";
			$vitalinfo = "";
		}
		if ($row['private_dna'] && $allow_edit)
			$privacy = "&nbsp;(" . $admtext['text_private'] . ")";
		else
			$privacy = "";
		if ($dbname) {
			$dna_namestr = "<a href=\"$getperson_url" . "personID={$row['personID']}&amp;tree={$row['gedcom']}\">$dna_namestr</a>$privacy $vitalinfo";
		} else
			$dna_namestr = $person_name . $privacy;
		if ($row['private_dna'] && !$allow_edit)
			$dna_namestr = $admtext['text_private'];
		tng_free_result($dna_pers_result);

		echo "<td class=\"$databack\">$dna_namestr&nbsp;</td>";

		echo "<td class=\"$databack\">&nbsp;{$row['vendor']}</td>";

		echo "<td class=\"$databack\">&nbsp;{$row['chromosome']}</td>";

		echo "<td class=\"$databack\">&nbsp;{$row['segment_start']}</td>";

		echo "<td class=\"$databack\">&nbsp;{$row['segment_end']}</td>";

		echo "<td class=\"$databack\">&nbsp;{$row['centiMorgans']}</td>";

		echo "<td class=\"$databack\">&nbsp;{$row['matching_SNPs']}</td>";

		if( $row['ydna_haplogroup'] ) {
			if( $row['ydna_confirmed'] )
				$ydna_haplogroup = "<span class='confirmed_haplogroup'>" . $row['ydna_haplogroup'] . "</span>";
			else
				$ydna_haplogroup = "<span class='predicted_haplogroup'>" . $row['ydna_haplogroup'] . "</span>";
		} else {
			$ydna_haplogroup = "";
		}
		echo "<td class=\"$databack\">&nbsp;$ydna_haplogroup</td>";

		if( $row['mtdna_haplogroup'] ) {
			if( $row['mtdna_confirmed'] )
				$mtdna_haplogroup = "<span class='confirmed_haplogroup'>" . $row['mtdna_haplogroup'] . "</span>";
			else
				$mtdna_haplogroup = "<span class='predicted_haplogroup'>" . $row['mtdna_haplogroup'] . "</span>";
		} else {
			$mtdna_haplogroup = "";
		}
		echo "<td class=\"$databack\">&nbsp;$mtdna_haplogroup</td>";


		$anc_namestr = "";
		$mrcanc_namestr = "";
		if($row['MRC_ancestorID']) {
			if ($row['MRC_ancestorID'][0] == "I") {
				$dna_anc_result = getPersonDataPlusDates($row['gedcom'], $row['MRC_ancestorID']);
				$ancrow = tng_fetch_assoc($dna_anc_result);
				if( $ancrow ) {
					$dna_righttree = checktree($ancrow['gedcom']);
					$dna_rightbranch = $dna_righttree ? checkbranch($ancrow['branch']) : false;
					$dprights = determineLivingPrivateRights($ancrow, $dna_righttree, $dna_rightbranch);
					$ancrow['allow_living'] = $dprights['living'];
					$ancrow['allow_private'] = $dprights['private'];
					//$vitalinfo = getBirthInfo($ancrow);
					$anc_namestr = getName( $ancrow );
					$mrcanc_namestr = "<a href=\"$getperson_url" . "personID={$row['MRC_ancestorID']}&amp;tree={$row['gedcom']}\">$anc_namestr</a>";
				}
				tng_free_result($dna_anc_result);
			}
			else if ($row['MRC_ancestorID'][0] == "F") {
				$mrcquery = "SELECT familyID, husband, wife, living, private, marrdate, gedcom, branch FROM $families_table WHERE familyID = \"{$row['MRC_ancestorID']}\" AND gedcom = \"{$row['gedcom']}\"";
				$mrcresult = tng_query($mrcquery);
				$famrow = tng_fetch_assoc($mrcresult);
				tng_free_result($mrcresult);

				if( $famrow ) {
					$righttree = checktree($row['gedcom']);
					$rightbranch = checkbranch($famrow['branch']);
					$rights = determineLivingPrivateRights($famrow, $righttree, $rightbranch);
					$famrow['allow_living'] = $rights['living'];
					$famrow['allow_private'] = $rights['private'];

					$famname = getFamilyName( $famrow );
					$mrcanc_namestr = "<a href=\"$familygroup_url" . "familyID={$row['MRC_ancestorID']}&amp;tree={$row['gedcom']}\">$famname</a>";
				}
			}
		}
		echo "<td class=\"$databack\">&nbsp;{$row['suggested_relationship']}</td>";

		echo "<td class=\"$databack\">&nbsp;{$row['actual_relationship']}</td>";

		echo "<td class=\"$databack\">&nbsp;$mrcanc_namestr</td>";

		echo "<td class=\"$databack\">&nbsp;{$row['related_side']}</td>";

		$group = $row['dna_group_desc'] ? $row['dna_group_desc'] : $text['none'];
		echo "<td class=\"$databack\">$group</td>";
		if( !$assignedtree && ($numtrees > 1 )) {
			echo "<td class=\"$databack nw\"><a href=\"$showtree_url" . "tree={$row['gedcom']}\">{$row['treename']}</a>&nbsp;</td>";
		}
		echo "</tr>\n";
		$i++;
	}

}
?>
</table>
</div>
<br />
<?php
tng_footer( "" );
?>
