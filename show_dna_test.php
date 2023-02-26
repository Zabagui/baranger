<?php
$textpart = "dna";
include("tng_begin.php");

if(!$testID) {header( "Location: thispagedoesnotexist.html" ); exit;}

include($cms['tngpath'] . "personlib.php" );

$getperson_url = getURL( "getperson", 1 );
$show_dna_test_url = getURL( "show_dna_test", 1 );
$placesearch_url = getURL( "placesearch", 1 );
$familygroup_url = getURL( "familygroup", 1 );

$flags['imgprev'] = true;

$firstsection = 1;
$firstsectionsave = "";
$tableid = "";
$cellnumber = 0;
$testID = !empty($testID) ? cleanIt($testID) : "";

$query = "SELECT * FROM $dna_tests_table WHERE testID = \"$testID\"";
$result = tng_query($query);
$dnarow = tng_fetch_assoc($result);
if( !tng_num_rows($result) || ($dnarow['private_test'] && !$allow_private) ) {
	header( "Location: thispagedoesnotexist.html" );
	exit;
}

$testnum = ($allow_edit || $showtestnumbers) ? htmlspecialchars($dnarow['test_number']) : "";
$headline = $text['dna_test'] . ": " . $dnarow['test_type'] . " " . $testnum;
$logstring = "<a href=\"$show_dna_test_url" . "testID=$testID\">$headline</a>";
writelog($logstring);
preparebookmark($logstring);

tng_header( $headline, $flags );
?>

<h1 class="header"><span class="headericon" id="dna-hdr-icon"></span><?php echo $headline; ?></h1><br class="clearleft" />
<?php
$datewidth = 0;
$dnatext = "";
$dnatext .= "<ul class=\"nopad\">\n";
$dnatext .= beginSection("info");
$dnatext .= "<table cellspacing=\"1\" cellpadding=\"4\" class=\"whiteback tfixed normal\">\n";
$dnatext .= "<col class=\"labelcol\"/><col style=\"width:{$datewidth}px\"/><col />\n";

if($dnarow['test_type'] == "atDNA") $test_type = "atDNA (Autosomal)";
elseif($dnarow['test_type'] == "mtDNA") $test_type = "mtDNA (Mitochondrial)";
else
	$test_type = $dnarow['test_type'];

if($dnarow['personID']) {
	$dna_pers_result = getPersonSimple($dnarow['gedcom'], $dnarow['personID']);
	$dprow = tng_fetch_assoc($dna_pers_result);
	$dna_righttree = checktree($dprow['gedcom']);
	$dna_rightbranch = $dna_righttree ? checkbranch($dprow['branch']) : false;
	$dprights = determineLivingPrivateRights($dprow, $dna_righttree, $dna_rightbranch);
	$dprow['allow_living'] = $dprights['living'];
	$dprow['allow_private'] = $dprights['private'];
	$dna_namestr = getName( $dprow );
	$dna_namestr = "<a href=\"$getperson_url" . "personID={$dnarow['personID']}&amp;tree={$dnarow['gedcom']}\">$dna_namestr</a>";
	if ($dnarow['private_dna'] && !$allow_edit) $dna_namestr = $admtext['text_private'];
	tng_free_result($dna_pers_result);
}
else {
	$person_name = htmlspecialchars($dnarow['person_name']);
	$dna_namestr = ($dnarow['private_dna'] && !$allow_edit) ? $admtext['text_private'] : $person_name;
	$dprights['both'] = false;
}

$dnatext .= showEvent( array( "text"=>$text['takenby'], "fact"=>$dna_namestr, "event"=>"", "type"=>"D", "entity"=>"" ) );

if( $dnarow['private_test'] && $allow_private )
	$dnatext .= showEvent( array( "text"=>$text['keep_test_private'], "fact"=>$admtext['yes'], "event"=>"", "type"=>"D", "entity"=>"" ) );
if($dnarow['test_date'] && $dnarow['test_date'] != "0000-00-00") {
	$test_date = formatInternalDate($dnarow['test_date']);
	if (isset($dprights['both']))
		$dnatext .= showEvent( array( "text"=>$text['test_date'], "fact"=>$test_date, "event"=>"", "type"=>"D", "entity"=>"" ) );
}
if($dnarow['match_date'] && $dnarow['match_date'] != "0000-00-00") {
	$match_date = formatInternalDate($dnarow['match_date']);
	if($dprights['both'])
		$dnatext .= showEvent( array( "text"=>$admtext['match_date'], "fact"=>$match_date, "event"=>"", "type"=>"D", "entity"=>"" ) );
}

if( $dnarow['vendor'] )
	$dnatext .= showEvent( array( "text"=>$admtext['vendor'], "fact"=>htmlspecialchars($dnarow['vendor']), "event"=>"", "type"=>"D", "entity"=>"" ) );

$dnatext .= showEvent( array( "text"=>$text['test_type'], "fact"=>$test_type, "event"=>"", "type"=>"D", "entity"=>"" ) );
if ($dnarow['test_number'] && ($allow_edit || $showtestnumbers))
	$dnatext .= showEvent( array( "text"=>$text['test_number'], "fact"=>htmlspecialchars($dnarow['test_number']), "event"=>"", "type"=>"D", "entity"=>"" ) );
$dnagroup = $dnarow['dna_group'];
$dscquery = "SELECT description FROM $dna_groups_table WHERE dna_group='$dnagroup'";
$dscresult = tng_query($dscquery);
$dscrow = tng_fetch_assoc( $dscresult );
tng_free_result($dscresult);
$group = $dnagroup ? htmlspecialchars($dscrow['description']) : $text['none'];
if( $dnarow['dna_group'] )
	$dnatext .= showEvent( array( "text"=>$text['testgroup'], "fact"=>$group, "event"=>"", "type"=>"D", "entity"=>"" ) );
if($dnarow['GEDmatchID'] ) {
	if($dprights['both']) {
		$GEDmatch_str = "<a href=\"https://www.gedmatch.com/\" target=\"_blank\">" . htmlspecialchars($dnarow['GEDmatchID']) . "</a>";
		$dnatext .= showEvent( array( "text"=>$admtext['gedmatchID'], "fact"=>$GEDmatch_str, "event"=>"", "type"=>"D", "entity"=>"" ) );
	}
}
if($dnarow['MD_ancestorID']) {
	$dna_pers_result = getPersonData($dnarow['gedcom'], $dnarow['MD_ancestorID']);
	$ancrow = tng_fetch_assoc($dna_pers_result);
	$dna_righttree = checktree($ancrow['gedcom']);
	$dna_rightbranch = $dna_righttree ? checkbranch($ancrow['branch']) : false;
	$dprights = determineLivingPrivateRights($ancrow, $dna_righttree, $dna_rightbranch);
	$ancrow['allow_living'] = $dprights['living'];
	$ancrow['allow_private'] = $dprights['private'];
	$vitalinfo = getBirthInfo($ancrow);
	$anc_namestr = getName( $ancrow );
	$anc_namestr = "<a href=\"$getperson_url" . "personID={$dnarow['MD_ancestorID']}&amp;tree={$dnarow['gedcom']}\">$anc_namestr</a>" . $vitalinfo;

	tng_free_result($dna_pers_result);

	$ancestor_str = ($dnarow['test_type'] == "atDNA") ? $admtext['mrca'] : $admtext['mda'];
	$dnatext .= showEvent( array( "text"=>$admtext['mda'], "fact"=>$anc_namestr, "event"=>"", "type"=>"D", "entity"=>"" ) );
}
if($dnarow['MRC_ancestorID']) {
	if ($dnarow['MRC_ancestorID'][0] == $tngconfig['personprefix']) {
		$dna_mrca_result = getPersonData($dnarow['gedcom'], $dnarow['MRC_ancestorID']);
		$ancrow = tng_fetch_assoc($dna_mrca_result);
		$dna_righttree = checktree($ancrow['gedcom']);
		$dna_rightbranch = $dna_righttree ? checkbranch($ancrow['branch']) : false;
		$dprights = determineLivingPrivateRights($ancrow, $dna_righttree, $dna_rightbranch);
		$ancrow['allow_living'] = $dprights['living'];
		$ancrow['allow_private'] = $dprights['private'];
		$vitalinfo = getBirthInfo($ancrow);
		$anc_namestr = getName( $ancrow );
		$anc_namestr = "<a href=\"$getperson_url" . "personID={$dnarow['MRC_ancestorID']}&amp;tree={$dnarow['gedcom']}\">$anc_namestr</a>" . $vitalinfo;

		tng_free_result($dna_mrca_result);

		$dnatext .= showEvent( array( "text"=>$admtext['mrca'], "fact"=>$anc_namestr, "event"=>"", "type"=>"D", "entity"=>"" ) );
	}
	else if ($dnarow['MRC_ancestorID'][0] == $tngconfig['familyprefix']) {
		$query = "SELECT familyID, husband, wife, living, private, marrdate, gedcom, branch FROM $families_table WHERE familyID = \"{$dnarow['MRC_ancestorID']}\" AND gedcom = \"{$dnarow['gedcom']}\"";
		$result = tng_query($query);
		$famrow = tng_fetch_assoc($result);
		tng_free_result($result);

		$righttree = checktree($dnarow['gedcom']);
		$rightbranch = checkbranch($famrow['branch']);
		$rights = determineLivingPrivateRights($famrow, $righttree, $rightbranch);
		$famrow['allow_living'] = $rights['living'];
		$famrow['allow_private'] = $rights['private'];

		$famname = getFamilyName( $famrow );
		$anc_namestr = "<a href=\"$familygroup_url" . "familyID={$dnarow['MRC_ancestorID']}&amp;tree={$dnarow['gedcom']}\">$famname</a>";
		$anc_namestr = $text['family'] . ": " . "<a href=\"$familygroup_url" . "familyID={$dnarow['MRC_ancestorID']}&amp;tree={$dnarow['gedcom']}\">$famname</a>";
		$dnatext .= showEvent( array( "text"=>$admtext['mrca'], "fact"=>$anc_namestr, "event"=>"", "type"=>"D", "entity"=>"" ) );
	}
}

if( $dnarow['markers'] )
	$dnatext .= showEvent( array( "text"=>$admtext['markers'], "fact"=>htmlspecialchars($dnarow['markers']), "event"=>"", "type"=>"D", "entity"=>"" ) );
if( $dnarow['y_results'] ) {
	$dnatext .= "<tr>\n";
	$dnatext .= "<td valign=\"top\" class=\"fieldnameback fieldname\">" . nl2br($admtext['marker_values']) . "&nbsp;</td>\n";
	$dnatext .= "<td valign=\"top\" class=\"databack resultscol\" colspan=\"2\">" . htmlspecialchars($dnarow['y_results']) . "</td>\n";
	$dnatext .= "</tr>\n";
}
if( $dnarow['ydna_haplogroup'] ) {
	if( $dnarow['ydna_confirmed'] )
		$dnarow['haplogroup'] = "<span class='confirmed_haplogroup'>" . htmlspecialchars($dnarow['ydna_haplogroup']) . " - " . $text['confirmed'] . "</span>";
	else
		$dnarow['ydna_haplogroup'] = "<span class='predicted_haplogroup'>" . htmlspecialchars($dnarow['ydna_haplogroup']) . " - " . $text['predicted'] . "</span>";
	$dnatext .= showEvent( array( "text"=>$admtext['ydna_haplogroup'] , "fact"=>$dnarow['ydna_haplogroup'], "event"=>"", "type"=>"D", "entity"=>"" ) );
}
if( $dnarow['mtdna_haplogroup'] ) {
	if( $dnarow['mtdna_confirmed'] )
		$dnarow['haplogroup'] = "<span class='confirmed_haplogroup'>" . htmlspecialchars($dnarow['mtdna_haplogroup']) . " - " . $text['confirmed'] . "</span>";
	else
		$dnarow['mtdna_haplogroup'] = "<span class='predicted_haplogroup'>" . htmlspecialchars($dnarow['mtdna_haplogroup']) . " - " . $text['predicted'] . "</span>";
	$dnatext .= showEvent( array( "text"=>$admtext['mtdna_haplogroup'], "fact"=>$dnarow['mtdna_haplogroup'], "event"=>"", "type"=>"D", "entity"=>"" ) );
}
if( $dnarow['significant_snp'] )
	$dnatext .= showEvent( array( "text"=>$admtext['signsnp'], "fact"=>htmlspecialchars($dnarow['significant_snp']), "event"=>"", "type"=>"D", "entity"=>"" ) );
if( $dnarow['terminal_snp'] )
	$dnatext .= showEvent( array( "text"=>$admtext['termsnp'], "fact"=>htmlspecialchars($dnarow['terminal_snp']), "event"=>"", "type"=>"D", "entity"=>"" ) );
if( $dnarow['ref_seq'] ){
	$fact = $dnarow['ref_seq'] == "rsrs" ? $admtext['rsrs'] : $admtext['rcrs'];
	$dnatext .= showEvent( array( "text"=>$admtext['ref_seq'], "fact"=>$fact, "event"=>"", "type"=>"D", "entity"=>"" ) );
}
if( $dnarow['hvr1_results'] )
	$dnatext .= showEvent( array( "text"=>$admtext['hvr1_values'], "fact"=>htmlspecialchars($dnarow['hvr1_results']), "event"=>"", "type"=>"D", "entity"=>"" ) );
if( $dnarow['hvr2_results'] )
	$dnatext .= showEvent( array( "text"=>$admtext['hvr2_values'], "fact"=>htmlspecialchars($dnarow['hvr2_results']), "event"=>"", "type"=>"D", "entity"=>"" ) );
if( $dnarow['xtra_mut'] )
	$dnatext .= showEvent( array( "text"=>$admtext['xtra_mut'], "fact"=>htmlspecialchars($dnarow['xtra_mut']), "event"=>"", "type"=>"D", "entity"=>"" ) );
if( $allow_admin && $dnarow['coding_reg'] )
	$dnatext .= showEvent( array( "text"=>$admtext['coding_reg'], "fact"=>htmlspecialchars($dnarow['coding_reg']), "event"=>"", "type"=>"D", "entity"=>"" ) );
if( $allow_admin ) {
	if( $dnarow['shared_cMs'] ) {
		$total_shared = $admtext['shared centimorgans'] ."  " . htmlspecialchars($dnarow['shared_cMs']);
		if ($dnarow['shared_segments'])
			$total_shared .= " | " . htmlspecialchars($dnarow['shared_segments']) . " " . $admtext['shared_segments'];
		else
			$total_shared .= "";
		$dnatext .= showEvent( array( "text"=>$admtext['shared_dna'], "fact"=>$total_shared, "event"=>"", "type"=>"D", "entity"=>"" ) );
	}
	if( $dnarow['chromosome'] && $dnarow['centiMorgans']) {
		$segment = $admtext['chromosome'] . "  " . htmlspecialchars($dnarow['chromosome']) . "  | " . htmlspecialchars($dnarow['centiMorgans']) . "  " . $admtext['centiMorgans'] . " ";
		$dnatext .= showEvent( array( "text"=>$admtext['largest_segment'], "fact"=>$segment, "event"=>"", "type"=>"D", "entity"=>"" ) );
	}
	if( $dnarow['segment_start'] )
		$dnatext .= showEvent( array( "text"=>$admtext['segment_start'], "fact"=>htmlspecialchars($dnarow['segment_start']), "event"=>"", "type"=>"D", "entity"=>"" ) );
	if( $dnarow['segment_end'] )
		$dnatext .= showEvent( array( "text"=>$admtext['segment_end'], "fact"=>htmlspecialchars($dnarow['segment_end']), "event"=>"", "type"=>"D", "entity"=>"" ) );
	if( $dnarow['matching_SNPs'] )
		$dnatext .= showEvent( array( "text"=>$admtext['matchingSNPs'], "fact"=>htmlspecialchars($dnarow['matching_SNPs']), "event"=>"", "type"=>"D", "entity"=>"" ) );
	if( $dnarow['relationship_range'] )
		$dnatext .= showEvent( array( "text"=>$admtext['relationship_range'], "fact"=>htmlspecialchars($dnarow['relationship_range']), "event"=>"", "type"=>"D", "entity"=>"" ) );
	if( $dnarow['suggested_relationship'] )
		$dnatext .= showEvent( array( "text"=>$admtext['suggested_relationship'], "fact"=>htmlspecialchars($dnarow['suggested_relationship']), "event"=>"", "type"=>"D", "entity"=>"" ) );
	if( $dnarow['actual_relationship'] )
		$dnatext .= showEvent( array( "text"=>$admtext['actual_relationship'], "fact"=>htmlspecialchars($dnarow['actual_relationship']), "event"=>"", "type"=>"D", "entity"=>"" ) );
	if( $dnarow['related_side'] )
		$dnatext .= showEvent( array( "text"=>$admtext['related_side'], "fact"=>htmlspecialchars($dnarow['related_side']), "event"=>"", "type"=>"D", "entity"=>"" ) );
	if( $dnarow['x_match'] )
		$dnatext .= showEvent( array( "text"=>$admtext['xmatch'], "fact"=>$admtext['yes'], "event"=>"", "type"=>"D", "entity"=>"" ) );
}
if( $dnarow['surnames'] ) {
	$dnarow['surnames'] = !empty($ancsurnameupper) ? strtoupper($dnarow['surnames']) : $dnarow['surnames'];
	$dnatext .= showEvent( array( "text"=>$admtext['ancestral_surnames'], "fact"=>htmlspecialchars($dnarow['surnames']), "event"=>"", "type"=>"D", "entity"=>"" ) );
}

if( $dnarow['urls'] ) {
	$urls = showLinks(htmlspecialchars($dnarow['urls']));
	if($urls) $urls = "<ul>$urls</ul>";
	$dnatext .= "<tr>\n";
	$dnatext .= "<td valign=\"top\" class=\"fieldnameback fieldname\">{$text['links']}&nbsp;</td>\n";
	$dnatext .= "<td valign=\"top\" class=\"databack\" colspan=\"2\">$urls</td>\n";
	$dnatext .= "</tr>\n";
}
//urls
if( $dnarow['medialinks'] ) {
	$medialinks = showMediaLinks(addslashes($dnarow['medialinks']));
	$dnatext .= "<tr>\n";
	$dnatext .= "<td valign=\"top\" class=\"fieldnameback fieldname\">{$admtext['medialinks']}&nbsp;</td>\n";
	$dnatext .= "<td valign=\"top\" class=\"databack\" colspan=\"2\">$medialinks</td>\n";
	$dnatext .= "</tr>\n";
}
if($dnarow['notes']) {
	$dnatext .= "<tr>\n";
	$dnatext .= "<td valign=\"top\" class=\"fieldnameback fieldname\">" . nl2br($text['notes']) . "&nbsp;</td>\n";
	$dnatext .= "<td valign=\"top\" class=\"databack\" colspan=\"2\"><div class=\"notearea\">" . htmlspecialchars($dnarow['notes']) . "</div></td>\n";
	$dnatext .= "</tr>\n";
}
if($allow_admin && $dnarow['admin_notes']) {
	$dnatext .= "<tr>\n";
	$dnatext .= "<td valign=\"top\" class=\"fieldnameback fieldname\">" . nl2br($admtext['admin_notes']) . "&nbsp;</td>\n";
	$dnatext .= "<td valign=\"top\" class=\"databack\" colspan=\"2\"><div class=\"notearea\">" . htmlspecialchars($dnarow['admin_notes']) . "</div></td>\n";
	$dnatext .= "</tr>\n";
}

if( isset( $soffset )) {
	$soffsetstr = "$soffset, ";
	$newsoffset = $soffset + 1;
}
else {
	$soffsetstr = "";
	$newsoffset = 0;
}

$query = "SELECT $dna_links_table.personID, lastname, lnprefix, firstname, birthdate, birthdatetr, birthplace, altbirthdate, altbirthdatetr, altbirthplace,
		deathdate, deathdatetr, deathplace, burialdate, burialdatetr, burialplace,
		IF(birthdatetr !='0000-00-00',birthdatetr,altbirthdatetr) as birth,
		IF(deathdatetr !='0000-00-00',deathdatetr,burialdatetr) as death,
		prefix, suffix, nameorder, title, $dna_links_table.gedcom, branch, living, private
	FROM $dna_links_table, $people_table
	WHERE testID = \"$testID\" AND $dna_links_table.personID = $people_table.personID AND $dna_links_table.gedcom = $people_table.gedcom
	ORDER BY birth DESC, lastname, firstname LIMIT $soffsetstr" . ($maxsearchresults + 1);
$presult = tng_query($query);
$numrows = tng_num_rows( $presult );
if(!$numrows) $rightbranch = true;

$dnalinktext = "";
while( $prow = tng_fetch_assoc( $presult ) ) {
	if( $dnalinktext ) $dnalinktext .= "\n";
	$righttree = checktree($prow['gedcom']);
	$rightbranch = $righttree ? checkbranch($prow['branch']) : false;
	$rights = determineLivingPrivateRights($prow, $righttree, $rightbranch);
	$prow['allow_living'] = $rights['living'];
	$prow['allow_private'] = $rights['private'];
	$vitalinfo = $rights['both'] ? getBirthInfo($prow) : "";
	$name = "<a href=\"$getperson_url" . "personID={$prow['personID']}&amp;tree={$prow['gedcom']}\">" . getName( $prow ) . "</a>" . $vitalinfo;
	if ($dnarow['private_dna'] && !$allow_edit && ($prow['personID'] == $dnarow['personID'])) $name = $admtext['text_private'];
	$dnalinktext .= $name;
}
if( $numrows >= $maxsearchresults )
	$dnalinktext .= "\n[<a href=\"$show_dna_test_url" . "testID=$testID&amp;foffset=$foffset&amp;soffset=" . ($newsoffset + $maxsearchresults) . "\">{$text['morelinks']}</a>]";
tng_free_result( $presult );

if( $dnalinktext )
	$dnatext .= showEvent( array( "text"=>$text['indlinked'], "fact"=>$dnalinktext, "event"=>"", "type"=>"D", "entity"=>"" ) );

$dnatext .= "</table>\n";
$dnatext .= "<br/>\n";
$dnatext .= endSection("info");

$dnatext .= "</ul>\n";

$innermenu = "<span class=\"lightlink3\" id=\"tng_plink\">{$text['test_info']}</span>\n";

$emailaddr = "";
echo tng_menu( "D", "dna", $testID, $innermenu );
?>

<?php
	echo $dnatext;
?>
<br />

<?php
tng_footer( $flags );
?>