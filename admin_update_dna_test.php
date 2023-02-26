<?php
include("begin.php");
include("adminlib.php");
include("datelib.php");
$textpart = "dna";
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_edit && !$allow_add ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");

$test_number = addslashes($test_number);
$notes = addslashes($notes);
$vendor = addslashes($vendor);
$y_results = isset($y_results) ? addslashes($y_results) : "";
$hvr1_results = isset($hvr1_results) ? addslashes($hvr1_results) : "";
$hvr2_results = isset($hvr2_results) ? addslashes($hvr2_results) : "";
$person_name = addslashes($person_name);
$dna_group = addslashes($dna_group);
//$dna_group_desc = addslashes($group);
$surnames = addslashes($surnames);
$MD_ancestorID = addslashes($MD_ancestorID);
$MRC_ancestorID = addslashes($MRC_ancestorID);
$ref_seq = isset($ref_seq) ? addslashes($ref_seq) : "";
$xtra_mut = isset($xtra_mut) ? addslashes($xtra_mut) : "";
$coding_reg = isset($coding_reg) ? str_replace(', ',',',$coding_reg) : "";
$coding_reg = str_replace(',',', ',$coding_reg);
$coding_reg = addslashes($coding_reg);
$admin_notes = addslashes($admin_notes);
$personID = addslashes($personID);
$urls = addslashes($urls);
$markers = isset($markers) ? addslashes($markers) : "";
$haplogroup = isset($haplogroup) ? addslashes($haplogroup) : "";
$signsnp = isset($signsnp) ? addslashes($signsnp) : "";
$termsnp = isset($termsnp) ? addslashes($termsnp) : "";
$medialinks = isset($medialinks) ? addslashes($medialinks) : "";

$descquery = "SELECT description FROM $dna_groups_table WHERE dna_group=\"$dna_group\"";
$descresult = tng_query($descquery);
$descrow = tng_fetch_assoc( $descresult );
tng_free_result($descresult);
$dna_group_desc = $dna_group ? addslashes($descrow['description']) : "";
$mtdna_confirmed = !empty($mtdna_confirmed) ? $mtdna_confirmed : "";
$ydna_confirmed = !empty($ydna_confirmed) ? $ydna_confirmed : "";
$markeropt = !empty($markeropt) ? $markeropt : "";
$notesopt = !empty($notesopt) ? $notesopt : "";
$linksopt = !empty($linksopt) ? $linksopt : "";
$surnamesopt = !empty($surnamesopt) ? $surnamesopt : "";
$private_dna = !empty($private_dna) ? $private_dna : "";
$mtdna_haplogroup = !empty($mtdna_haplogroup) ? addslashes($mtdna_haplogroup) : "";
$ydna_haplogroup = !empty($ydna_haplogroup) ? addslashes($ydna_haplogroup) : "";
$shared_cMs = !empty($shared_cMs) ? addslashes($shared_cMs) : "";
$shared_segments = !empty($shared_segments) ? addslashes($shared_segments) : "";
$chromosome = !empty($chromosome) ? addslashes($chromosome) : "";
$segment_start = !empty($segment_start) ? addslashes($segment_start) : "";
$segment_end = !empty($segment_end) ? addslashes($segment_end) : "";
$centiMorgans = !empty($centiMorgans) ? addslashes($centiMorgans) : "";
$matching_SNPs = !empty($matching_SNPs) ? addslashes($matching_SNPs) : "";
$x_match = !empty($x_match) ? $x_match : "";
$relationship_range = !empty($relationship_range) ? addslashes($relationship_range) : "";
$suggested_relationship = !empty($suggested_relationship) ? addslashes($suggested_relationship) : "";
$actual_relationship = !empty($actual_relationship) ? addslashes($actual_relationship) : "";
$related_side = !empty($related_side) ? addslashes($related_side) : "";
$GEDmatchID = !empty($GEDmatchID) ? addslashes($GEDmatchID) : "";

$test_date = convertDate( $test_date );
$match_date = convertDate( $match_date );
if(!$personID && !$person_name)
	$mynewgedcom = "";

$query = "UPDATE $dna_tests_table SET test_type=\"$test_type\", test_number=\"$test_number\", notes=\"$notes\", vendor=\"$vendor\", test_date=\"$test_date\", match_date=\"$match_date\",personID=\"$personID\",
	gedcom=\"$mynewgedcom\", urls=\"$urls\", markers=\"$markers\", y_results=\"$y_results\", hvr1_results=\"$hvr1_results\", hvr2_results=\"$hvr2_results\", person_name = \"$person_name\",
	mtdna_confirmed = \"$mtdna_confirmed\", ydna_confirmed = \"$ydna_confirmed\", markeropt = \"$markeropt\", notesopt = \"$notesopt\", linksopt = \"$linksopt\", surnamesopt = \"$surnamesopt\", private_dna = \"$private_dna\", private_test = \"$private_test\",
	dna_group = \"$dna_group\", dna_group_desc = \"$dna_group_desc\", surnames = \"$surnames\", MD_ancestorID = \"$MD_ancestorID\", MRC_ancestorID = \"$MRC_ancestorID\",
	admin_notes = \"$admin_notes\", medialinks = \"$medialinks\", ref_seq = \"$ref_seq\", xtra_mut = \"$xtra_mut\", coding_reg = \"$coding_reg\", mtdna_haplogroup=\"$mtdna_haplogroup\", ydna_haplogroup=\"$ydna_haplogroup\", significant_snp=\"$signsnp\", terminal_snp=\"$termsnp\", shared_cMs = \"$shared_cMs\", shared_segments = \"$shared_segments\", chromosome = \"$chromosome\", segment_start = \"$segment_start\", segment_end = \"$segment_end\", centiMorgans = \"$centiMorgans\", matching_SNPs = \"$matching_SNPs\", x_match = \"$x_match\", relationship_range = \"$relationship_range\", suggested_relationship = \"$suggested_relationship\", actual_relationship = \"$actual_relationship\", related_side = \"$related_side\", GEDmatchID = \"$GEDmatchID\"

	WHERE testID=\"$testID\"";
$result = tng_query($query);

$query = "UPDATE $dna_links_table SET dna_group=\"$dna_group\"  WHERE testID=\"$testID\"";
$result = tng_query($query);

if( $personID && $personID != $personID_org ) {
	$query = "INSERT IGNORE INTO $dna_links_table (testID,personID,gedcom,dna_group) VALUES (\"$testID\",\"$personID\",\"$mynewgedcom\",\"$dna_group\")";
	$result = @tng_query($query);
}

adminwritelog( "<a href=\"admin_edit_dna_test.php?testID=$testID\">{$admtext['modifydna']}: $testID</a>" );

if( isset($_POST['savestay']) )
	header( "Location: admin_edit_dna_test.php?testID=$testID&cw=$cw" );
else if( isset($_POST['saveclose']) ) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<body>
<script type="text/javascript">
	top.close();
</script>
</body>
</html>
<?php
}
else  {
	$message = $admtext['changestotest'] . " $test_number {$admtext['succsaved']}.";
	header( "Location: admin_dna_tests.php?message=" . urlencode($message) );
}
?>