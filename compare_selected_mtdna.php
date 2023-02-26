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
if( strpos($_SESSION['tnglastpage'], "compare_selected_mtdna.php") === false ) {
	unset ($_SESSION['compare_mtdna']);
	$_SESSION['compare_mtdna'] = array();
	foreach( array_keys($_POST) as $key ) {
		if( substr( $key, 0, 3 ) == "dna" ) {
			$_SESSION['compare_mtdna'][$key] = 1;
			$compare_count++;
		}
	}
	if( $compare_count < 2 ) {
		header( "Location: browse_dna_tests.php?tree=-x--all--x-&amp;testsearch=&amp;test_type=mtDNA&amp;test_group=", true );
		exit;
	}
} else {
	foreach( array_keys($_SESSION['compare_mtdna']) as $key ) {
		if( substr( $key, 0, 3 ) == "dna" ) {
			if( !isset($_POST[$key]) ) $_POST[$key] = "1";
		}
	}
}

$compare_selected_mtdna_url = getURL( "compare_selected_mtdna", 1 );

$getperson_url = getURL( "getperson", 1 );
$familygroup_url = getURL( "familygroup", 1 );
$show_dna_test_url = getURL( "show_dna_test", 1 );
$showtree_url = getURL( "showtree", 1 );

$text['dnatestscompare_mtdna'] .= $test_group ? ": " . $test_group : ": " . $text['allgroups'];

tng_header( $text['dnatestscompare_mtdna'], $flags );

	// Fix the url to be correct and escaped.
	$innermenu = "<a href=\"https://tng.lythgoes.net/wiki/index.php?title=Compare_DNA_Test_Results\" target=\"_blank\" class=\"lightlink\">{$text['help']}</a>";
	// Y-DNA Tests
	$innermenu .= "&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"browse_dna_tests.php?tree=-x--all--x-&amp;testsearch=&amp;test_type=Y-DNA&amp;test_group=\" class=\"lightlink\">{$admtext['ydna_test']}</a>";
	// mtDNA Tests
	$innermenu .= "&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"browse_dna_tests.php?tree=-x--all--x-&amp;testsearch=&amp;test_type=mtDNA&amp;test_group=\" class=\"lightlink\">{$admtext['mtdna_test']}</a>";
	// atDNA Tests
	$innermenu .= "&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"browse_dna_tests.php?tree=-x--all--x-&amp;testsearch=&amp;test_type=atDNA&amp;test_group=\" class=\"lightlink\">{$admtext['atdna_test']}</a>";

	$menu = tng_menu("DCMT","compare","",$innermenu);
?>
<h1 class="header"><span class="headericon" id="dna-hdr-icon"></span><?php echo $text['dnatestscompare_mtdna']; ?></h1><br />
<?php
echo $menu;

$treestr = $tree ? " ({$text['tree']}: $tree)" : "";
$logstring = "<a href=\"$compare_selected_mtdna_url" . "tree=$tree&amp;test_group=$test_group&amp;testsearch=$test_search\">" . xmlcharacters($text['dnatestscompare_mtdna'].$treestr) . "</a>";
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
		<th data-tablesaw-priority="persist" class="fieldnameback nbrcol fieldname dnacomparetable">&nbsp;#&nbsp;</th>

<?php
	if( $allow_edit || $showtestnumbers ) { ?>
		<th data-tablesaw-priority="2" class="fieldnameback fieldname dnacomparetable">&nbsp;<?php echo $text['test_number']; ?>&nbsp;</th>
<?php
	}
?>
		<th data-tablesaw-priority="1" class="fieldnameback fieldname dnacomparetable">&nbsp;<?php echo $text['takenby']; ?>&nbsp;</th>
		<th data-tablesaw-priority="3" class="fieldnameback fieldname dnacomparetable">&nbsp;<?php echo $admtext['haplo']; ?>&nbsp;</th>
		<th data-tablesaw-priority="2" class="fieldnameback fieldname dnacomparetable">&nbsp;<?php echo $text['sequence']; ?>&nbsp;</th>
		<th data-tablesaw-priority="2" class="fieldnameback fieldname dnacomparetable">&nbsp;<?php echo $admtext['hvr1_values']; ?>&nbsp;</th>
		<th data-tablesaw-priority="2" class="fieldnameback fieldname dnacomparetable">&nbsp;<?php echo $admtext['hvr2_values']; ?>&nbsp;</th>
		<th data-tablesaw-priority="1" class="fieldnameback fieldname dnacomparetable">&nbsp;<?php echo $admtext['mrca']; ?>&nbsp;</th>
		<th data-tablesaw-priority="1" class="fieldnameback fieldname dnacomparetable">&nbsp;<?php echo $text['testgroup']; ?>&nbsp;</th>
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
		$query = "SELECT * FROM $dna_tests_table WHERE testID=$testID";
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

		$mtdna_haplogroup = "";
		if( $row['mtdna_haplogroup'] ) {
			if( $row['mtdna_confirmed'] )
				$mtdna_haplogroup = "<span class='confirmed_haplogroup'>" . $row['mtdna_haplogroup'] . "</span>";
			else
				$mtdna_haplogroup = "<span class='predicted_haplogroup'>" . $row['mtdna_haplogroup'] . "</span>";
		}
		echo "<td class=\"$databack\">&nbsp;$mtdna_haplogroup</td>";
		$seq = $row['ref_seq'];
		if ($seq == "rcrs") $seq = "rCRS";
		if ($seq == "rsrs") $seq = "RSRS";
		echo "<td class=\"$databack\">&nbsp;$seq</td>";

		echo "<td class=\"$databack\">&nbsp;{$row['hvr1_results']}</td>";

		echo "<td class=\"$databack\">&nbsp;{$row['hvr2_results']}</td>";


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
		echo "<td class=\"$databack\">&nbsp;$mrcanc_namestr</td>";

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
