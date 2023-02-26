<?php
include("begin.php");
include("adminlib.php");
$textpart = "dna";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( !$allow_edit ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

if( $assignedtree ) {
	$wherestr = "WHERE gedcom = \"$assignedtree\"";
	$tree = $assignedtree;
}
else
	$wherestr = "";

$treequery = "SELECT gedcom, treename FROM $trees_table $wherestr ORDER BY treename";
$treeresult = tng_query($treequery) or die ($admtext['cannotexecutequery'] . ": $treequery");
$treenum = 0;
while( $treerow = tng_fetch_assoc($treeresult) ) {
	$treenum++;
	$trees[$treenum] = $treerow['gedcom'];
	$treename[$treenum] = $treerow['treename'];
}
tng_free_result($treeresult);
$testID = !empty($testID) ? cleanIt($testID) : "";

$query = "SELECT * FROM $dna_tests_table WHERE testID = \"$testID\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
tng_free_result($result);
if( !isset($row['personID']) ) {
	header( "Location: admin_dna_tests.php" );
	exit;
}

if($row['personID']) {
	$query = "SELECT personID, gedcom, firstname, lnprefix, lastname, prefix, suffix, nameorder, title, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr, living, private, branch
		FROM $people_table
		WHERE personID = \"{$row['personID']}\" AND gedcom = \"{$row['gedcom']}\"";
	$result = tng_query($query);
	$row2 = tng_fetch_assoc( $result );
	if( $row2 ) {
		$row2['allow_living'] = $row2['allow_private'] = 1;
		$takername = "(" . getName($row2) . ")";
	} else {
		$takername = "()";
	}
	tng_free_result($result);
}
else
	$takername = "";

if($row['MD_ancestorID']) {
	$query = "SELECT personID, gedcom, firstname, lnprefix, lastname, prefix, suffix, nameorder, title, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr, living, private, branch
		FROM $people_table
		WHERE personID = \"{$row['MD_ancestorID']}\" AND gedcom = \"{$row['gedcom']}\"";
	$result = tng_query($query);
	$row3 = tng_fetch_assoc( $result );
	$row3['allow_living'] = $row3['allow_private'] = 1;
	$mdancestorname = "(" . getName($row3) . ")";
	tng_free_result($result);
}
else
	$mdancestorname = "";
if($row['MRC_ancestorID']) {
	if ($row['MRC_ancestorID'][0] == $tngconfig['personprefix']) {
		$query = "SELECT personID, gedcom, firstname, lnprefix, lastname, prefix, suffix, nameorder, living, private, branch
			FROM $people_table
			WHERE personID = \"{$row['MRC_ancestorID']}\" AND gedcom = \"{$row['gedcom']}\"";
		$result = tng_query($query);
		$row3 = tng_fetch_assoc( $result );
		$row3['allow_living'] = $row3['allow_private'] = 1;
		$mrcancestorname = "(" . getName($row3) . ")";
		tng_free_result($result);
	}
	else if ($row['MRC_ancestorID'][0] == $tngconfig['familyprefix']) {
	    $query = "SELECT familyID, husband, wife, living, private, marrdate, gedcom, branch FROM $families_table WHERE familyID = \"{$row['MRC_ancestorID']}\" AND gedcom = \"{$row['gedcom']}\"";
	    $result = tng_query($query);
	    $row3 = tng_fetch_assoc($result);
		tng_free_result($result);

	    $row3['allow_living'] = $row3['allow_private'] = 1;

	    $mrcancestorname = "(" . getFamilyName( $row3 ) . ")";
	}
}
else
	$mrcancestorname = $admtext['mrcaiorf'];

$query = "SELECT $dna_links_table.ID as mlinkID, $dna_links_table.personID as personID, lastname, lnprefix, firstname, prefix, suffix, nameorder, title, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr, $dna_links_table.gedcom as gedcom, branch, treename, living, private
	FROM $dna_links_table
	LEFT JOIN $trees_table as trees ON $dna_links_table.gedcom = trees.gedcom
	LEFT JOIN $people_table AS people ON $dna_links_table.personID = people.personID AND $dna_links_table.gedcom = people.gedcom
	WHERE testID = \"$testID\" ORDER BY $dna_links_table.ID DESC";
$result2 = tng_query($query);
$numlinks = tng_num_rows( $result2 );

$helplang = findhelp("dna_help.php");

tng_adminheader( $admtext['modifydna'], $flags );
?>
</head>

<?php
echo tng_adminlayout();

$dnatabs[0] = array(1,"admin_dna_tests.php",$admtext['search'],"findtest");
$dnatabs[1] = array($allow_add,"admin_new_dna_test.php",$admtext['addnew'],"addtest");
$dnatabs[2] = array($allow_edit,"#",$admtext['edit'],"edit");
$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/dna_help.php#add');\" class=\"lightlink\">{$admtext['help']}</a> ";
$innermenu .= "&nbsp;|&nbsp;<a href=\"#\" class=\"lightlink\" onClick=\"return toggleAll('on');\">{$text['expandall']}</a> &nbsp;|&nbsp; <a href=\"#\" class=\"lightlink\" onClick=\"return toggleAll('off');\">{$text['collapseall']}</a>";
$menu = doMenu($dnatabs,"edit",$innermenu);
echo displayHeadline($admtext['dna_tests'] . " &gt;&gt; " . $admtext['modifydna'], "img/dna_icon.gif",$menu,"");

$surnamesarr = array();
$surnamesexc = array();
$surnamesexc = explode(',', $surnameexcl);
$pass1 = true;

function get_ancestor_surnames($personID, $tree, $type) {
   global $surnamesarr, $surnamesexc, $pass1;

   $select = "SELECT p.lastname, p.famc, f.husband, f.wife FROM tng_people AS p LEFT JOIN tng_families AS f ON (p.famc = f.familyID AND p.gedcom = f.gedcom) WHERE p.personID = '" . $personID . "' AND p.gedcom = '" . $tree . "'";
   $result = tng_query($select);
    while( $surrow = tng_fetch_assoc($result) ) {
      $father = ($type != "mtDNA") ? $surrow['husband'] : "";
      $mother = ($type != "Y-DNA") ? $surrow['wife'] : "";
    if (!in_array($surrow['lastname'], $surnamesarr) && !in_array($surrow['lastname'], $surnamesexc) && !$pass1)
     array_push($surnamesarr, $surrow['lastname']);
     $pass1 = false;
      if ($father) get_ancestor_surnames($father, $tree, $type);
      if ($mother) get_ancestor_surnames($mother, $tree, $type);
   }
tng_free_result($result);
if ($type == "atDNA") sort($surnamesarr);
$ancestorstr = implode(', ', $surnamesarr);

return $ancestorstr;
}
$atsurnamesarr = array();
$atsurnamesexc = array();
$atsurnamesexc = explode(',', $surnameexcl);
$perID=array();
include("tngdblib.php");

function get_atdna_ancestor_surnames($personID, $tree, $type) {
   global $atsurnamesarr, $atsurnamesexc, $perID, $numgens;

$perID[0]=$personID;

for ($a=0; $a <= $numgens; $a++) {
	for($b=0; $b < pow(2,$a); $b++) {
		if(isset($perID[pow(2,$a)+$b-1])) {
			$tID = pow(2,$a)+$b-1;
			$result = getPersonFullPlusDates($tree, $perID[$tID]);
			$row = tng_fetch_assoc( $result );
			$perName[$tID]= $row['lastname'];
             if (!in_array($perName[$tID], $atsurnamesarr) && !in_array($perName[$tID], $atsurnamesexc)) array_push($atsurnamesarr, $perName[$tID]);
			$result = getFamilyData($tree,$row['famc']);
			$rowM = tng_fetch_assoc( $result );
			$h = 2*($tID)+1;
			$w = 2*($tID)+2;
			$perID[$h] = $rowM['husband'];
			$perID[$w] = $rowM['wife'];
		}
	}
}
tng_free_result($result);
$atancestorstr = implode(', ', $atsurnamesarr);

return $atancestorstr;
}
?>

<div class="admin-main">
<form action="admin_update_dna_test.php" method="post" name="form1" id="form1" onsubmit="return validateForm();">
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="adm-rounded-table">
<tr>
<td class="tngshadow databack">
	<?php echo displayToggle("plus0",1,"testinfo",$admtext['testinfo'],""); ?>

	<div id="testinfo">
	<br/>
	<table class="normal">
		<tr>
			<td><?php echo $admtext['test_type']; ?>:</td>
			<td>
				<select name="test_type" id="test_type">
					<option value="">&nbsp;</option>
					<option value="atDNA"<?php if($row['test_type'] == "atDNA") echo " selected"; ?>><?php echo $admtext['atdna_test']; ?></option>
					<option value="Y-DNA"<?php if($row['test_type'] == "Y-DNA") echo " selected"; ?>><?php echo $admtext['ydna_test']; ?></option>
					<option value="mtDNA"<?php if($row['test_type'] == "mtDNA") echo " selected"; ?>><?php echo $admtext['mtdna_test']; ?></option>
					<option value="X-DNA"<?php if($row['test_type'] == "X-DNA") echo " selected"; ?>><?php echo $admtext['xdna_test']; ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo $admtext['test_number']; ?>:</td>
			<td><input type="text" name="test_number" value="<?php echo htmlspecialchars($row['test_number']); ?>" class="medfield"></td>
		</tr>
		<tr>
			<td><?php echo $admtext['vendor']; ?>:</td>
			<td><input type="text" name="vendor" value="<?php echo htmlspecialchars($row['vendor']); ?>" class="medfield"></td>
		</tr>
		<tr>
			<td><?php echo $admtext['test_date']; ?>:</td>
			<td><input type="text" name="test_date" value="<?php echo formatInternalDate($row['test_date']); ?>" class="medfield" onblur="checkDate(this);"></td>
		</tr>
		<tr>
			<td><?php echo $admtext['match_date']; ?>:</td>
			<td><input type="text" name="match_date" value="<?php echo formatInternalDate($row['match_date']); ?>" class="medfield" onblur="checkDate(this);"></td>
		</tr>
		<?php if($row['test_type'] == "atDNA") { ?>
		<tr>
			<td><?php echo $admtext['gedmatchID']; ?>:</td>
			<td><input type="text" name="GEDmatchID" value="<?php echo htmlspecialchars($row['GEDmatchID']); ?>" id="GEDmatchID" class="medfield"></td>
		</tr>
		<?php }; ?>
		<tr>
			<td><strong><?php echo $admtext['privatetest']; ?>:</strong>&nbsp;</td>
			<td>
				<select name="private_test">
				<option value="0"<?php if( !$row['private_test'] ) echo " selected"; ?>><?php echo $admtext['no']; ?></option>
				<option value="1"<?php if( $row['private_test'] ) echo " selected"; ?>><?php echo $admtext['yes']; ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2"><br/><strong><?php echo $admtext['test_taker']; ?></strong></td>
		</tr>
		<tr>
			<td>
				<?php echo $admtext['tree']; ?>:
			</td>
			<td>
				<select name="mynewgedcom">
				<option value="">&nbsp;</option>
<?php
		for( $j = 1; $j <= $treenum; $j++ ) {
			echo "	<option value=\"{$trees[$j]}\"";
			if($trees[$j] == $row['gedcom']) echo " selected";
			echo ">$treename[$j]</option>\n";
		}
?>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo "{$admtext['text_and']} {$admtext['personid']} "; ?>:</td>
			<td>
				<input type="text" name="personID" value="<?php echo $row['personID']; ?>" id="personID" size="20" maxlength="22"> &nbsp;<span><?php echo $takername; ?></span>&nbsp;<?php echo $admtext['text_or']; ?>&nbsp;
				<a href="#" onclick="return findItem('I','personID','',document.form1.mynewgedcom.options[document.form1.mynewgedcom.selectedIndex].value,'<?php echo $assignedbranch; ?>');" title="<?php echo $admtext['find']; ?>">
					<img src="img/tng_find.gif" title="<?php echo $admtext['find']; ?>" alt="<?php echo $admtext['find']; ?>" class="alignmiddle" width="20" height="20" style="border: 0px; margin: 0px 2px;">
				</a>
				<!--<span id="deststrfield"><?php echo $takername; ?></span>-->
			</td>
		</tr>
		<tr>
			<td><?php echo "{$admtext['text_or']} {$admtext['person_name']} "; ?></td>
			<td>
			<input type="text" name="person_name" value="<?php echo htmlspecialchars($row['person_name']); ?>" id="person_name" size="40" maxlength="100"></td>
		</tr>
		<tr>
			<td colspan="2"><strong><?php echo $text['keep_name_private']; ?>:</strong>&nbsp;<input type="checkbox" name="private_dna" value="1"<?php if( $row['private_dna'] ) echo " checked=\"checked\""; ?>></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td><strong><?php echo $admtext['addtotestgroup']; ?>:</strong>&nbsp;</td>
			<td>
				<select name="dna_group">
				<option value=""><?php echo $text['none']; ?></option>
<?php
		$groupsquery = "SELECT * FROM $dna_groups_table WHERE `test_type` = \"{$row['test_type']}\" ORDER BY description";
		$groupsresult = tng_query($groupsquery);
		$numgrouprows = tng_num_rows( $groupsresult );
		while( $groupsrow = tng_fetch_assoc($groupsresult) ) {
		if($row['dna_group'] == $groupsrow['dna_group']) $selectgrp = "selected";
                 else $selectgrp = "";
		echo "	<option value=\"{$groupsrow['dna_group']}\" $selectgrp>{$groupsrow['description']} </option>\n";
		}
		tng_free_result($groupsresult);
?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<?php if($row['test_type'] == "Y-DNA") { ?>
		<tr>
			<td><?php echo $admtext['markers']; ?>:</td>
			<td><input type="text" name="markers" value="<?php echo htmlspecialchars($row['markers']); ?>" class="medfield"></td>
		</tr>
		<tr>
			<td><?php echo $admtext['marker_values']; ?>:<br /><?php echo $admtext['separate']; ?>:<br /><?php echo $admtext['multivalues']; ?></td>
			<td><textarea cols="90" rows="3" name="y_results"><?php echo htmlspecialchars($row['y_results']); ?></textarea></td>
		</tr>
		<?php }; ?>
		<?php if( $row['test_type'] == "mtDNA" || $row['test_type'] == "atDNA" ) {
			$mt_checkedstr = ($row['mtdna_confirmed']) ? "checked" : ""; ?>
		<tr>
			<td><?php echo $admtext['mtdna_haplogroup']; ?>:</td>
			<td><input type="text" name="mtdna_haplogroup" value="<?php echo htmlspecialchars($row['mtdna_haplogroup']); ?>" class="medfield">&nbsp;&nbsp;<?php echo $text['confirmed']; ?>:&nbsp;<input type="checkbox" name="mtdna_confirmed" value="1" <?php echo $mt_checkedstr; ?>>
			</td>
		</tr>
		<?php };
		if( $row['test_type'] == "Y-DNA"  || $row['test_type'] == "atDNA") {
			$y_checkedstr = ($row['ydna_confirmed']) ? "checked" : ""; ?>
		<tr>
			<td><?php echo $admtext['ydna_haplogroup']; ?>:</td>
			<td><input type="text" name="ydna_haplogroup" value="<?php echo htmlspecialchars($row['ydna_haplogroup']); ?>" class="medfield">&nbsp;&nbsp;<?php echo $text['confirmed']; ?>:&nbsp;<input type="checkbox" name="ydna_confirmed" value="1" <?php echo $y_checkedstr; ?>>
			</td>
		</tr>
		<?php };  ?>

		<?php if($row['test_type'] == "mtDNA") { ?>
                <tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
                        <td><strong><?php echo $admtext['ref_seq']; ?>:</strong>&nbsp;</td>
			<td>
				<select name="ref_seq">
					<option value=""<?php if( $row['ref_seq'] == "" ) echo " selected"; ?>></option>
					<option value="rsrs"<?php if( $row['ref_seq'] == "rsrs" ) echo " selected"; ?>><?php echo $admtext['rsrs']; ?></option>
					<option value="rcrs"<?php if( $row['ref_seq'] == "rcrs" ) echo " selected"; ?>><?php echo $admtext['rcrs']; ?></option>
				</select></td>
		</tr>
		<tr>
			<td><?php echo $admtext['hvr1_values']; ?>:</td>
			<td><input type="text" name="hvr1_results" value="<?php echo htmlspecialchars($row['hvr1_results']); ?>" style="width:700px;">&nbsp;<?php echo $admtext['separate']; ?></td>
		</tr>
		<tr>
			<td><?php echo $admtext['hvr2_values']; ?>:</td>
			<td><input type="text" name="hvr2_results" value="<?php echo htmlspecialchars($row['hvr2_results']); ?>" style="width:700px;">&nbsp;<?php echo $admtext['separate']; ?></td>
		</tr>
		<tr>
			<td><?php echo $admtext['xtra_mut']; ?>:</td>
			<td><input type="text" name="xtra_mut" value="<?php echo htmlspecialchars($row['xtra_mut']); ?>" style="width:700px;">&nbsp;<?php echo $admtext['separate']; ?></td>
		</tr>
		<tr>
			<td><?php echo $admtext['coding_reg']; ?>:</td>
			<td><textarea cols="69" rows="2" name="coding_reg"><?php echo htmlspecialchars($row['coding_reg']); ?></textarea>&nbsp;<?php echo $admtext['separate']; ?>
                       </td>
		</tr>
		<?php }; ?>
		<?php if($row['test_type'] == "Y-DNA") { ?>
		<tr>
			<td><?php echo $admtext['signsnp']; ?>:</td>
			<td><input type="text" name="signsnp" value="<?php echo htmlspecialchars($row['significant_snp']); ?>" class="verylongfield"></td>
		</tr>
		<tr>
			<td><?php echo $admtext['termsnp']; ?>:</td>
			<td><input type="text" name="termsnp" value="<?php echo htmlspecialchars($row['terminal_snp']); ?>" class="verylongfield"></td>
		</tr>
		<?php }; ?>
		<?php if($row['test_type'] == "atDNA") { ?>
        <tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2"><br/><strong><?php echo $admtext['shared_dna']; ?></strong></td>
		</tr>
		<tr>
			<td><?php echo $admtext['shared centimorgans']; ?>:</td>
			<td><input type="text" name="shared_cMs" value="<?php echo htmlspecialchars($row['shared_cMs']); ?>" id="shared_cMs" size="20" maxlength="22"></td>
		</tr>
		<tr>
			<td><?php echo $admtext['shared_segments']; ?>:</td>
			<td><input type="text" name="shared_segments" value="<?php echo htmlspecialchars($row['shared_segments']); ?>" id="shared_segments" size="20" maxlength="22"></td>
		</tr>

		<tr>
			<td colspan="2"><br/><strong><?php echo $admtext['largest_segment']; ?></strong></td>
		</tr>
		<tr>
			<td><?php echo $admtext['chromosome']; ?>:</td>
			<td><input type="text" name="chromosome" value="<?php echo htmlspecialchars($row['chromosome']); ?>" id="chromosome" size="20" maxlength="22"></td>
		</tr>
		<tr>
			<td><?php echo $admtext['segment_start']; ?>:</td>
			<td><input type="text" name="segment_start" value="<?php echo htmlspecialchars($row['segment_start']); ?>" id="segment_start" size="20" maxlength="22"></td>
		</tr>
		<tr>
			<td><?php echo $admtext['segment_end']; ?>:</td>
			<td><input type="text" name="segment_end" value="<?php echo htmlspecialchars($row['segment_end']); ?>" id="segment_end" size="20" maxlength="22"></td>
		</tr>
		<tr>
			<td><?php echo $admtext['centiMorgans']; ?>:</td>
			<td><input type="text" name="centiMorgans" value="<?php echo htmlspecialchars($row['centiMorgans']); ?>" id="centiMorgans" size="20" maxlength="22"></td>
		</tr>
		<tr>
			<td><?php echo $admtext['matchingSNPs']; ?>:</td>
			<td><input type="text" name="matching_SNPs" value="<?php echo htmlspecialchars($row['matching_SNPs']); ?>" id="matching_SNPs" size="20" maxlength="22"></td>
		</tr>
        <tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2"><br/><strong><?php echo $admtext['relationship_section']; ?></strong></td>
		</tr>
		<tr>
			<td><?php echo $admtext['relationship_range']; ?>:</td>
			<td><input type="text" name="relationship_range" value="<?php echo htmlspecialchars($row['relationship_range']); ?>" id="relationship_range" size="80" maxlength="80"></td>
		</tr>
		<tr>
			<td><?php echo $admtext['suggested_relationship']; ?>:</td>
			<td><input type="text" name="suggested_relationship" value="<?php echo htmlspecialchars($row['suggested_relationship']); ?>" id="suggested_relationship" size="80" maxlength="80"></td>
		</tr>
		<tr>
			<td><?php echo $admtext['actual_relationship']; ?>:</td>
			<td><input type="text" name="actual_relationship" value="<?php echo htmlspecialchars($row['actual_relationship']); ?>" id="actual_relationship" size="40" maxlength="40"></td>
		</tr>
		<tr>
			<td><?php echo $admtext['related_side']; ?>:</td>
			<td><input type="text" name="related_side" value="<?php echo htmlspecialchars($row['related_side']); ?>" id="related_side" size="40" maxlength="40"></td>
		</tr>
        <tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td><strong><?php echo $admtext['xmatch']; ?>:</strong>&nbsp;</td>
			<td>
				<select name="x_match">
				<option value="0"<?php if( !$row['x_match'] ) echo " selected"; ?>><?php echo $admtext['no']; ?></option>
				<option value="1"<?php if( $row['x_match'] ) echo " selected"; ?>><?php echo $admtext['yes']; ?></option>
				</select>
			</td>
		</tr>
        <tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<?php }; ?>
		<tr>
			<td colspan="2"><br/><strong><?php echo $admtext['mdaID']; ?></strong></td>
		</tr>
		<tr>
			<td><?php echo $admtext['personid']; ?>:</td>
			<td><input type="text" name="MD_ancestorID" value="<?php echo $row['MD_ancestorID']; ?>" id="MD_ancestorID" size="20" maxlength="22"><span>&nbsp;<?php echo $mdancestorname; ?></span>&nbsp;&nbsp;<?php echo $admtext['text_or']; ?>&nbsp;
				<a href="#" onclick="return findItem('I','MD_ancestorID','',document.form1.mynewgedcom.options[document.form1.mynewgedcom.selectedIndex].value,'<?php echo $assignedbranch; ?>');" title="<?php echo $admtext['find']; ?>">
					<img src="img/tng_find.gif" title="<?php echo $admtext['find']; ?>" alt="<?php echo $admtext['find']; ?>" class="alignmiddle" width="20" height="20" style="border: 0px; margin: 0px 2px;">
				</a>
			</td>
		</tr>

		<tr>
			<td colspan="2"><br/><strong><?php echo $admtext['mrcaID']; ?></strong></td>
		</tr>
		<tr>
			<td><?php echo $admtext['searchfor'] ; ?></td>
			<td><input type="radio" name="mrcatype" value="I" checked="checked" onclick="activateMrcaType('I');"/> <?php echo $admtext['person']; ?> &nbsp;&nbsp;
			<input type="radio" name="mrcatype" value="F" onclick="activateMrcaType('F');"/> <?php echo $admtext['family']; ?>
			</td>
		</tr>

		<tr>
			<td><span id="person_label"><?php echo $admtext['personid']; ?></span><span id="family_label" style="display:none"><?php echo $admtext['familyid']; ?></span>:</td>
			<td valign="top"><input type="text" name="MRC_ancestorID"  value="<?php echo $row['MRC_ancestorID']; ?>" id="MRC_ancestorID"> &nbsp;<?php echo $mrcancestorname; ?>&nbsp;&nbsp;<?php echo $admtext['text_or']; ?>&nbsp;
			<a href="#" onclick="return findItem(mrcaType,'MRC_ancestorID','',document.form1.mynewgedcom.options[document.form1.mynewgedcom.selectedIndex].value,'<?php echo $assignedbranch; ?>');" title="<?php echo $admtext['find']; ?>"><img src="img/tng_find.gif" title="<?php echo $admtext['find']; ?>" alt="<?php echo $admtext['find']; ?>" class="alignmiddle" width="20" height="20" style="border: 0px; margin: 0px 2px;"></a>
			</td>
		</tr>

		<?php
			if ((!$row['surnames'] && $row['test_type'] != "atDNA") && $autofillancsurnames && $row['personID'])
				$ancestorstr = get_ancestor_surnames($row['personID'], $row['gedcom'], $row['test_type']);
			else if ((!$row['surnames'] && $row['test_type'] == "atDNA") && $autofillancsurnames && $row['personID'])
				$ancestorstr = get_atdna_ancestor_surnames($row['personID'], $row['gedcom'], $row['test_type']);
            else
            	$ancestorstr = $row['surnames'];
			if ($ancsurnameupper)
				$ancestorstr = strtoupper($ancestorstr);
		?>
		<tr>
			<td valign="top"><?php echo $admtext['ancestral_surnames']; ?>:</td>
			<td><textarea cols="90" rows="10" name="surnames"><?php echo $ancestorstr; ?></textarea></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td valign="top"><?php echo $admtext['notes']; ?>:</td>
			<td><textarea cols="90" rows="10" name="notes"><?php echo $row['notes']; ?></textarea></td>
		</tr>
		<tr>
			<td valign="top"><?php echo $admtext['admin_notes']; ?>:</td>
			<td><textarea cols="90" rows="10" name="admin_notes"><?php echo $row['admin_notes']; ?></textarea></td>
		</tr>
		<tr>
			<td valign="top"><?php echo $admtext['urls']; ?>:</td>
			<td><textarea cols="90" rows="3" name="urls"><?php echo $row['urls']; ?></textarea></td>
		</tr>
		<tr>
			<td valign="top"><?php echo $admtext['medialinks']; ?>:</td>
			<td><textarea cols="90" rows="3" name="medialinks"><?php echo $row['medialinks']; ?></textarea></td>
		</tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
			<td><strong><?php echo $text['test_info_display']; ?>:</strong>&nbsp;</td><td>
                   <?php if($row['test_type'] != "X-DNA" ) { ?>
			<input type="checkbox" name="markeropt" value="1"<?php if( $row['markeropt'] ) echo " checked=\"checked\""; ?>>&nbsp;<?php echo $text['test_results']; ?>&nbsp;&nbsp;
                    <?php }; ?>
            <input type="checkbox" name="notesopt" value="1"<?php if( $row['notesopt'] ) echo " checked=\"checked\""; ?>>&nbsp;<?php echo $admtext['notes']; ?>&nbsp;&nbsp;
            <input type="checkbox" name="linksopt" value="1"<?php if( $row['linksopt'] ) echo " checked=\"checked\""; ?>>&nbsp;<?php echo $admtext['urls']; ?>&nbsp;&nbsp;
            <input type="checkbox" name="surnamesopt" value="1"<?php if( $row['surnamesopt'] ) echo " checked=\"checked\""; ?>>&nbsp;<?php echo $admtext['ancestral_surnames']; ?></td>
		</tr>
		<tr><td colspan="2">&nbsp;</td></tr>
	</table>
	</div>
</td>
</tr>

<tr>
<td class="tngshadow databack" id="linkstd">
	<?php $admtext['dnalinkssubt'] = "Link this DNA test to a person";
	echo displayToggle("plus2",1,"links",$admtext['test_links'] . " (<span id=\"linkcount\">$numlinks</span>)",$admtext['dnalinkssubt']); ?>

	<?php include("micro_dnalinks.php"); ?>
</td>
</tr>

<tr>
<td class="tngshadow databack">
	<input type="hidden" value="<?php if(isset($cw)) echo $cw; /*stands for "close window" */ ?>" name="cw">
	<input type="hidden" value="<?php echo $row['testID']; ?>" name="testID">
	<input type="hidden" value="<?php echo $row['personID']; ?>" name="personID_org">
<?php
	if(!empty($cw)) {
?>
	<input type="submit" name="saveclose" id="saveclose" class="btn" accesskey="s" value="<?php echo $admtext['saveback']; ?>" />
	<input type="submit" name="saveclose" id="saveret2" class="btn saveret" accesskey="s" value="<?php echo $admtext['saveback']; ?>" />
<?php
	} else {
?>
	<input type="submit" name="saveret" id="saveret" class="btn" accesskey="s" value="<?php echo $admtext['saveback']; ?>" />
	<input type="submit" name="saveret" id="saveret2" class="btn saveret" accesskey="s" value="<?php echo $admtext['saveback']; ?>" />
<?php
	}
?>
	<input type="submit" name="savestay" id="savestay" class="btn" value="<?php echo $admtext['savereturn']; ?>" />
	<input type="submit" name="savestay" id="savestay2" class="btn savestay" value="<?php echo $admtext['savereturn']; ?>" />
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="window.location.href='admin_dna_tests.php';">
</td>
</tr>

</table>
</form>
</div>
<?php echo "<div align=\"right\"><span class=\"normal\">$tng_title, v.$tng_version</span></div>"; ?>
<script type="text/javascript">
//<![CDATA[
var tree = "<?php echo !empty($tree) ? $tree : ""; ?>";
var tnglitbox;
<?php
	echo "var linkcount = $numlinks;\n";
	echo "var confdellink = \"{$admtext['confdellink']}\";\n";
	echo "var remove_text = \"{$admtext['removelink']}\";\n";
?>

function validateForm( ) {
	var rval = true;

//req: test number, test type
	var frm = document.form1;
	if(!frm.test_type.selectedIndex) {
		alert("<?php echo $admtext['selecttype']; ?>");
		rval = false;
	}
//removed test_number alert
	return rval;
}

function toggleAll(display) {
	toggleSection('testinfo','plus0',display);
	return false;
}
//]]>
</script>
<script type="text/javascript" src="<?php echo $cms['tngpath'] ;?>js/datevalidation.js?v=<?php echo filemtime($cms['tngpath']."js/datevalidation.js"); ?>"></script>
<script type="text/javascript" src="<?php echo $cms['tngpath'] ;?>js/selectutils.js?v=<?php echo filemtime($cms['tngpath']."js/selectutils.js"); ?>"></script>
<script type="text/javascript" src="<?php echo $cms['tngpath'] ;?>js/dna_tests.js?v=<?php echo filemtime($cms['tngpath']."js/dna_tests.js"); ?>"></script>
<script type="text/javascript">
//<![CDATA[
	var preferEuro = <?php echo (isset($tngconfig['preferEuro']) ? $tngconfig['preferEuro'] : "false"); ?>;
	var preferDateFormat = '<?php if( isset($preferDateFormat) ) echo $preferDateFormat; ?>';
	var findform = document.form1;
//]]>
</script>
<?php 
echo tng_adminfooter();
?>