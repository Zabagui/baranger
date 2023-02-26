<?php
$textpart = "pedigree";
include("tng_begin.php");
if(!$personID) die("no args");
include($subroot . "pedconfig.php");
$getperson_url = getURL( "getperson", 1 );
$descend_url = getURL( "descend", 1 );
$descendtext_url = getURL( "descendtext", 1 );
$descendtables_url = getURL( "descendtables", 1 );
$desctracker_url = getURL( "desctracker", 1 );
$register_url = getURL( "register", 1 );
$pdfform_url = getURL( "rpt_pdfform", 1 );
$descendvert_url = getURL( "descendvert", 1 );

$divctr = 1;
if( $pedigree['stdesc'] ) {
	$display = "none";
	$excolimg = "tng_plus";
	$imgtitle = $text['expand'];
}
else {
	$display = "block";
	$excolimg = "tng_minus";
	$imgtitle = $text['collapse'];
}

$countem = array();
$rowArray = array();
$IDArray = array();

$multiTablesWanted = false;
$numberOfTableRows = 20;
$forceAllGens = true;
$children_wanted = true;
$birthdate_wanted = true;
$deathdate_wanted = true;
$parents_wanted = true;

$numberOfTableRows = intval($numberOfTableRows);

if ($numberOfTableRows < 20) {
	$numberOfTableRows = 20;
}


function getIndividual( $key, $sex, $level, $trail ) {
	global $tree, $generations, $text, $cms, $getperson_url, $righttree;
	global $desctracker_url, $divctr, $display, $excolimg, $descendtables_url, $imgtitle;
	global $countem, $currentLevel, $numkids, $IDArray, $diff, $rowArray;

	$rval = "";
	if( $sex == "M" ) {
		$self = "husband";
		$spouse = "wife";
		$spouseorder = "husborder";
	}
	else if( $sex == "F" ){
		$self = "wife";
		$spouse = "husband";
		$spouseorder = "wifeorder";
	}
	else {
		$self = $spouse = $spouseorder = "";
	}

	if( $spouse )
		$result = getSpouseFamilyMinimal($tree, $self, $key, $spouseorder);
	elseif( $key )
		$result = getSpouseFamilyMinimalUnion($tree, $key);
	$marrtot = tng_num_rows($result);
	if( !$marrtot && $key) {
		$result = getSpouseFamilyMinimalUnion($tree, $key);
		$self = $spouse = $spouseorder = "";
	}

	if( $result ) {

		while( $row = tng_fetch_assoc( $result ) ) {

			$spouserow = array();
			$spousestr = "";
			if( !$spouse )
				$spouse = $row['husband'] == $key ? "wife" : "husband";
			if( $row[$spouse] ) {
				$spouseresult = getPersonData($tree, $row[$spouse]);
				if( $spouseresult ) {
					$spouserow = tng_fetch_assoc( $spouseresult );
					$srights = determineLivingPrivateRights($spouserow, $righttree);
					$spouserow['allow_living'] = $srights['living'];
					$spouserow['allow_private'] = $srights['private'];
					$spousename = getName( $spouserow );
					$vitalinfo = getVitalDates( $spouserow );
					$spousestr = "&nbsp;<a href=\"$getperson_url" . "personID={$spouserow['personID']}&amp;tree=$tree\">$spousename</a>&nbsp; $vitalinfo<br/>";
					if(!empty($countem[$level-1]['s']))
						$countem[$level-1]['s']++;
					else
						$countem[$level-1]['s'] = 1;
				}
			}

			$result2 = getChildrenData($tree, $row['familyID']);
			$numkids = tng_num_rows( $result2 );
			if( $numkids ) {
				$divname = "fc$divctr";
				$divctr++;
				$diff= 0;
				while( $crow = tng_fetch_assoc( $result2 ) ) {

					$newtrail = "$trail,{$row['familyID']},{$crow['personID']}";
					$crights = determineLivingPrivateRights($crow, $righttree);
					$crow['allow_living'] = $crights['living'];
					$crow['allow_private'] = $crights['private'];
					$cname = getName( $crow );

					if(!in_array($crow['personID'], $IDArray)) {
						array_push($IDArray,$crow['personID']);

						$currentLevel = !empty($_GET['level']) ? $_GET['level'] : null;

						if ($currentLevel == null) {

							$chosen_level = 2;
							$currentLevel = 2;
						}
						else
							$chosen_level = $currentLevel;
						if($level == $chosen_level)
							array_push($rowArray,$crow);

						if(!empty($countem[$level]['d']))
							$countem[$level]['d']++;
						else
							$countem[$level]['d'] = 1;
						if( $level < $generations ) {
							$ind = getIndividual( $crow['personID'], $crow['sex'], $level + 1, $newtrail );
						}
						else {
							$nxtfams = getSpouseFamilyMinimalUnion($tree, $crow['personID']);
							$nxtkids = 0;
							while($nxtfam = tng_fetch_assoc($nxtfams)) {
								$result3 = countChildren($tree, $nxtfam['familyID']);
								$nxtrow = tng_fetch_assoc($result3);
								$nxtkids += $nxtrow['ccount'];
								tng_free_result($result3);
							}
						}
					}
				}
			}
			tng_free_result( $result2 );
		}
	}
	tng_free_result( $result );
	return $rval;
}

function getVitalDates( $row ) {
	global $text;

	$vitalinfo = "";

	if( $row['allow_living'] && $row['allow_private'] ) {
		if( $row['birthdate'] )
			$vitalinfo = $text['birthabbr'] . " " . displayDate( $row['birthdate'] ) . " ";
		else if( $row['altbirthdate'] )
			$vitalinfo = $text['chrabbr'] . " " . displayDate( $row['altbirthdate'] ) . " ";
		else
			$vitalinfo .= " ";
		if( $row['deathdate'] )
			$vitalinfo .= $text['deathabbr'] . " " . displayDate( $row['deathdate'] );
		else if( $row['burialdate'] )
			$vitalinfo .= $text['burialabbr'] . " " . displayDate( $row['burialdate'] );
		else
			$vitalinfo .= " ";
	}
	return $vitalinfo;
}

function getBirtDate($row) {
	global $text;

	$vitalinfo = "";
	if( $row['allow_living'] && $row['allow_private'] ) {
		if( $row['birthdate'] )
			$vitalinfo = $text['birthabbr'] . " " . displayDate( $row['birthdate'] ) . " ";
		else if( $row['altbirthdate'] )
			$vitalinfo = $text['chrabbr'] . " " . displayDate( $row['altbirthdate'] ) . " ";
		else
			$vitalinfo .= " ";
	}

	return $vitalinfo;
}


function getDeathDate($row) {
	global $text;

	$vitalinfo = "";
	if( $row['allow_living'] && $row['allow_private'] ) {
		if( $row['deathdate'] )
			$vitalinfo .= $text['deathabbr'] . " " . displayDate( $row['deathdate'] );
		else if( $row['burialdate'] )
			$vitalinfo .= $text['burialabbr'] . " " . displayDate( $row['burialdate'] );
		else
			$vitalinfo .= " ";
	}
	return $vitalinfo;
}


$level = 1;
$key = $personID;

$result = getPersonFullPlusDates($tree, $personID);
if( $result ) {
	$row = tng_fetch_assoc( $result );
	$righttree = checktree($tree);
	$rightbranch = $righttree ? checkbranch($row['branch']) : false;
	$rights = determineLivingPrivateRights($row, $righttree, $rightbranch);
	$row['allow_living'] = $rights['living'];
	$row['allow_private'] = $rights['private'];
	$namestr = getName( $row );
	$logname = $tngconfig['nnpriv'] && $row['private'] ? $admtext['text_private'] : ($nonames && $row['living'] ? $text['living'] : $namestr);
}

$treeResult = getTreeSimple($tree);
$treerow = tng_fetch_assoc($treeResult);
$disallowgedcreate = $treerow['disallowgedcreate'];
$allowpdf = !$treerow['disallowpdf'] || ($allow_pdf && $rightbranch);
tng_free_result($treeResult);

writelog( "<a href=\"$descendtables_url" . "personID=$personID&amp;tree=$tree\">{$text['descendfor']} $logname ($personID)</a>" );
preparebookmark( "<a href=\"$descendtables_url" . "personID=$personID&amp;tree=$tree\">{$text['descendfor']} $namestr ($personID)</a>" );

$flags['scripting'] = "<script type=\"text/javascript\">var tnglitbox;</script>\n";
tng_header( "Tables of Descendants for " . " $namestr", $flags );

$photostr = showSmallPhoto( $personID, $namestr, $rights['both'], 0, false, $row['sex'] );
echo tng_DrawHeading( $photostr, $namestr, getYears( $row ) );

if( !$pedigree['maxdesc'] ) $pedigree['maxdesc'] = 12;
if( !$pedigree['initdescgens'] ) $pedigree['initdescgens'] = 4;
if( !$generations )
	$generations = $pedigree['initdescgens'] > 8 ? 8 : $pedigree['initdescgens'];
else if( $generations > $pedigree['maxdesc'] )
	$generations = $pedigree['maxdesc'];
else
	$generations = intval( $generations );

if ($forceAllGens)
	$generations = $pedigree['maxdesc'];

$innermenu = $text['generations'] . ": &nbsp;";
$innermenu .= "<select name=\"generations\" class=\"verysmall\" onchange=\"window.location.href='$descendtables_url" . "personID=$personID&amp;tree=$tree&amp;display=$display&amp;generations=' + this.options[this.selectedIndex].value\">\n";
for( $gen = 1; $gen <= $pedigree['maxdesc']; $gen++ ) {
	$innermenu .= "<option value=\"$gen\"";
	if( $gen == $generations ) $innermenu .= " selected=\"selected\"";
	$innermenu .= ">$gen</option>\n";
}
$innermenu .= "</select>&nbsp;&nbsp;&nbsp;\n";
$innermenu .= "<a href=\"$descend_url" . "personID=$personID&amp;tree=$tree&amp;display=standard&amp;generations=$generations\" class=\"lightlink\">{$text['pedstandard']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
$innermenu .= "<a href=\"$descend_url" . "personID=$personID&amp;tree=$tree&amp;display=compact&amp;generations=$generations\" class=\"lightlink\">{$text['pedcompact']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
$innermenu .= "<a href=\"$descendvert_url" . "personID=$personID&amp;tree=$tree&amp;&amp;generations=$generations\" class=\"lightlink\">{$text['pedvertical']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
$innermenu .= "<a href=\"$descendtext_url" . "personID=$personID&amp;tree=$tree&amp;generations=$generations\" class=\"lightlink\">{$text['pedtextonly']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
$innermenu .= "<a href=\"$register_url" . "personID=$personID&amp;tree=$tree&amp;generations=$generations\" class=\"lightlink\">{$text['regformat']}</a>\n";
$innermenu .= "&nbsp;&nbsp; | &nbsp;&nbsp;<a href=\"$descendtables_url" . "personID=$personID&amp;tree=$tree&amp;generations=$generations\" class=\"lightlink3\">{$text['dtformat']}</a>\n";
if($generations <= 12 && $allowpdf)
	$innermenu .= " &nbsp;&nbsp; | &nbsp;&nbsp; <a href=\"#\" class=\"lightlink\" onclick=\"tnglitbox = new LITBox('$pdfform_url" . "pdftype=desc&amp;personID=$personID&amp;tree=$tree&amp;generations=$generations',{width:350,height:350});return false;\">PDF</a>\n";

echo getFORM( "descend", "get", "form1", "form1" );
echo tng_menu( "I", "descend", $personID, $innermenu );
echo "</form>\n";

$vitalinfo = getVitalDates( $row );

if( $generations > 0) {
	$ind = getIndividual( $key, $row['sex'], $level + 1, $personID );
}


echo "<div>" ;

if ($multiTablesWanted) {
	if (count($countem)>1) {

		if($templatenum == 5)
			echo "<table style='table-layout:fixed;white-space:nowrap'>";
		else
			echo "<table style='table-layout:fixed;'>";

		echo "<td style='width:460px; text-align:right;'><strong>".$text['dteachfulltable']." ".$numberOfTableRows." ".$text['dtrows']."</strong></td>";
		echo '<td><form action="" method="get">';

		if ($start > 0)
			echo '<input type="submit" value="'.$text['text_prev'].'"/>';
		else
			 echo '<button style="pointer-events:none;" type="button" disabled>'.$text['text_prev'].'</button>';

		echo '<input type="hidden" name="personID" value= "'.$personID.'"/>';
		echo '<input type="hidden" name="tree" value="'.$tree.'"/>';
		echo '<input type="hidden" name="start" value="'.($start - $numberOfTableRows).'"/>';
		echo '<input type="hidden" name="generations" value="'.$generations .'"/>';
		echo '<input type="hidden" name="level" value="'.$currentLevel.'"/>';

		echo '</form></td>';

		$tables = ceil(count($rowArray)/$numberOfTableRows);
		$table = ceil($start/$numberOfTableRows) + 1;

		echo "<td><strong>".$text['dtdisplayingtable']." ".$table." ".$text['of']." ".$tables." </strong></td>";
		echo '<td><form action="" method="get">';

		if ($start + $numberOfTableRows > (count($rowArray)-1))
			echo '<button style="pointer-events:none;" type="button" disabled>'.$text['text_next'].'</button>';
		else
			echo '<input type="submit" value="'.$text['text_next'].'">';

		echo '<input type="hidden" name="personID" value= "'.$personID.'"/>';
		echo '<input type="hidden" name="tree" value="'.$tree.'"/>';
		echo '<input type="hidden" name="start" value="'.($start + $numberOfTableRows).'"/>';
		echo '<input type="hidden" name="generations" value="'.$generations.'"/>';
		echo '<input type="hidden" name="level" value="'.$currentLevel.'"/>';

		echo"</form></td>";

		if ($tables > 1) {
			echo "<td><strong>".$text['dtgototable']."</strong></td>";

			for ($tab=0; $tab < $tables; $tab++) {
				echo '<td><form action="" method="get">';
				echo '<input type="hidden" name="personID" value= "'.$personID.'"/>';
				echo '<input type="hidden" name="tree" value="'.$tree.'"/>';
				echo '<input type="hidden" name="start" value="'.$tab*$numberOfTableRows.'"/>';
				echo '<input type="hidden" name="generations" value="'.$generations.'"/>';
				echo '<input type="hidden" name="level" value="'.$currentLevel.'"/>';

				if ($tab<=8) {
					if ($table == $tab +1)
						echo '<input type="submit" style="width:20px;background:darkgrey; color:white;" value="'.($tab + 1).'">';
					else
						echo '<input type="submit" style="width:20px;" value="'.($tab + 1).'">';
				}
				else {
					if ($table == $tab +1)
						echo '<input type="submit" style="width:25px;background:darkgrey; color:white;" value="'.($tab + 1).'">';
					else
						echo '<input type="submit" style="width:25px;" value="'.($tab + 1).'">';
				}

				echo "</form></td>";
			}
		}
	}
	else
	 	echo "<table style='table-layout:fixed;'><tr><td style='width:270px; text-align:right; color:white'></td></tr></table>";
}


echo "<div style=\"display:inline-block; float:left; margin-right:15px; margin-bottom:15px;\">";

if (count($countem) < 2)
	echo "<h3 style=\"margin-top:0px\">".$text['dtnodescendants']."</h3>";
else
	echo "<h3 style=\"margin-top:0px\">".$text['descendants']. "  (".count($countem)." ". $text['generations'].")</h3>";

echo '<form action= ""	 method="get">';
echo '<input type="hidden" name="personID" value="'.$personID.'"/>';
echo '<input type="hidden" name="tree" value="'.$tree.'"/>';
echo '<input type="hidden" name="start" value="0"/>';
echo '<input type="hidden" name="generations" value="'.$generations.'"/>';

echo "<style>th {color:white;}
tbody {color:black;}
table,th,td
{border:0px;}
</style>";

echo "<table style='float:left;' cellpadding='3' cellspacing='1' class='thfixed whiteback'>";
echo "<tr><th class='fieldnameback fieldname'>".$text['dtgen']."</th><th class='fieldnameback fieldname' style='text-align:center;'>".$text['relationship']."</th><th class='fieldnameback fieldname'>".$text['dttotal']."</th><th class='fieldnameback fieldname'>".$text['dtselect']."</th></tr>";

$maxcount = count($countem);
if ($maxcount > 21) {
	$maxcount = 21;
}
$grandtotal = 0;
for ($gen = 2; $gen <= $maxcount; $gen++) {

	$grandtotal += $countem[$gen]['d'];

	echo "<tr class='databack'><td  class='tngshadow' style='height:18px;white-space:nowrap;text-align:center;'> &nbsp;".($gen)."&nbsp;</td><td  class='tngshadow' style='white-space:nowrap;'>";

	switch ($gen) {
		case 2:
			echo $text['children'];
			echo "</td><td class='tngshadow' style='text-align:right;'>{$countem[$gen]['d']}</td>";
			echo "<td class='tngshadow'style='text-align:center;'>";
			echo "<input type=\"radio\" onChange='this.form.submit();' name=\"level\" id =generation$gen value=$gen>";
			echo "</tr>";
			break;
		case 3:
			echo $text['dtgrandchildren'];
			echo "</td><td class='tngshadow' style='text-align:right;'>{$countem[$gen]['d']}</td>";
			echo "<td class='tngshadow' style='text-align:center;'>";
			echo "<input type=\"radio\" onChange='this.form.submit();' name=\"level\" id =generation$gen value=$gen>";
			break;
		case 4:
			echo $text['dtggrandchildren'];
			echo "</td><td class='tngshadow' style='text-align:right;'>{$countem[$gen]['d']}</td>";
			echo "<td class='tngshadow' style='text-align:center;'>";
			echo "<input type=\"radio\" onChange='this.form.submit();' name=\"level\" id =generation$gen value=$gen>";
			break;
		default:
			$greatoffset = $gen - 3 - $text['greatoffset'];
			$gostr = $greatoffset > 1 ? $greatoffset . " {$text['times']} " : "";
			echo $gostr . $text['dtgggrandchildren'];
			echo "</td><td class='tngshadow' style='text-align:right;'>{$countem[$gen]['d']}</td>";
			echo "<td class='tngshadow' style='text-align:center;'>";
			echo "<input type=\"radio\" onChange='this.form.submit();' name=\"level\" id =generation$gen value=$gen>";
	}
	echo"</td></tr>";
}

echo "<tr class='databack'>";
echo "<td class='tngshadow'></td>";
echo "<td class='tngshadow'><strong>". $text['dttotal']."</strong></td>";
echo "<td class='tngshadow' style='text-align:right;'><strong>$grandtotal</strong></td>";
echo "<td class='tngshadow'></td >";
echo "</tr>";
echo "</table>";
echo "</form>";
echo "</div>";

echo "<div style=\"display:inline-block; margin-bottom:15px;\">";

if ($currentLevel > 0) {
	$check_ID;
	switch ($currentLevel) {
		case 2:
			echo "<h3 style=\"margin-top:0px\">".$text['children']." (".count($rowArray).") - ".$text['generation']." $currentLevel</h3> ";
			$check_ID = 'generation2';
			break;
			case 3:
			echo "<h3 style=\"margin-top:0px\">".$text['dtgrandchildren']." (".count($rowArray).") - ".$text['generation']." $currentLevel</h3>";
			$check_ID = 'generation3';
			break;
		case 4:
			echo "<h3 style=\"margin-top:0px\">".$text['dtggrandchildren']." (".count($rowArray).") - ".$text['generation']." $currentLevel</h3>";
			$check_ID = 'generation4';
			break;
		default:
			$actLevel = $currentLevel-3;
			echo "<h3 style=\"margin-top:0px\"> $actLevel {$text['times']} ".$text['dtggrandchildren']." (".count($rowArray).") - ".$text['generation']." $currentLevel</h3>";
			$check_ID = 'generation'.$currentLevel;
	}
	echo "<script> document.getElementById('".$check_ID."').checked = true; </script>";
	echo "<table style='float:left;'cellpadding='3' cellspacing='1' class='thfixed whiteback'>\n";
	echo "<tr><th class='fieldnameback fieldname'>#</th>";

	if ($children_wanted)
		echo"<th class='fieldnameback fieldname'>".$text['children']."</th>";

	echo"<th class='fieldnameback fieldname' style='text-align:center;'>".$text['name'];

	if ($birthdate_wanted)
		echo"</th><th class='fieldnameback fieldname' style='text-align:center;'>".$text['born'];

	if ($deathdate_wanted)
		echo "</th><th class='fieldnameback fieldname' style='text-align:center;'>".$text['died'];

	if ($parents_wanted)
		echo"</th><th class='fieldnameback fieldname' style='text-align:center;'>".$text['father']."</th ><th class='fieldnameback fieldname' style='text-align:center;'>".$text['mother'];

	echo"</th></tr>\n";

	if ($multiTablesWanted)
		$finish = $start + $numberOfTableRows -1;
	else {
		$start = 0;
		$finish = 1000;
	}

	$currentrow = -1;

	foreach ($rowArray as $current) {
		$currentrow ++;
		if ($currentrow > $finish)
			break;

		if ($currentrow >= $start) {
			$query = getChildParentsFamilyMinimal($tree,$current['personID']);
			$theFamily = tng_fetch_assoc($query);

			$result = getPersonFullPlusDates($tree, $theFamily['husband']);
			$row = tng_fetch_assoc( $result );
			$fnamestr = "";
			if( $row ) {
				$righttree = checktree($tree);
				$rightbranch = $righttree ? checkbranch($row['branch']) : false;
				$rights = determineLivingPrivateRights($row, $righttree, $rightbranch);
				$row['allow_living'] = $rights['living'];
				$row['allow_private'] = $rights['private'];

				$fnamestr = getName( $row );
			}

			$result = getPersonFullPlusDates($tree, $theFamily['wife']);
			$row = tng_fetch_assoc( $result );
			$mnamestr = "";
			if( $row ) {
				$righttree = checktree($tree);
				$rightbranch = $righttree ? checkbranch($row['branch']) : false;
				$rights = determineLivingPrivateRights($row, $righttree, $rightbranch);
				$row['allow_living'] = $rights['living'];
				$row['allow_private'] = $rights['private'];

				$mnamestr = getName( $row );
			}

			$lineNo = $currentrow + 1;

			echo "<tr class='databack'>";
			echo "<td class='tngshadow' style=\"height:16px;text-align:right;\"> $lineNo </td>";

			if ($children_wanted) {
				if($current['haskids'] > 0)
					echo "<td class='tngshadow' style='text-align:center;'>".$admtext['yes']."</td>";
				else
					echo "<td class='tngshadow'></td>";
			}

			$currentname = getName($current);

			echo"<td class='tngshadow'><table><tr><td style='text-align:left; white-space:nowrap;padding:0;'>&nbsp;<a href=\"$getperson_url" . "personID=".$current['personID']."&tree=$tree\" target=\"_parent\">$currentname</a>&nbsp;&nbsp;&nbsp;&nbsp;</td>";

			if($current['haskids'])
	 			echo"</td><td style='text-align:right; width:100%;white-space:nowrap;padding:0;'>[<a href=\"$descendtables_url" . "personID=".$current['personID']."&tree=$tree&generations=$generations\" target=\"_parent\">".$text['descendants']."</a>]</td>";
			else
				echo"</td><td></td>";

			echo"</tr></table></td>";

			if ($birthdate_wanted) {
				$birthDate = getBirtDate($current);
				echo "<td class='tngshadow'>&nbsp;".$birthDate." &nbsp;</td>";
			}

			if ($deathdate_wanted) {
				$deathDate = getDeathDate($current);
				echo "<td class='tngshadow'>&nbsp;".$deathDate." &nbsp;</td>";
			}

			if ($parents_wanted) {
				if ($fnamestr == "")
					echo "<td class='tngshadow'>&nbsp;".$text['unknown']." </td>";
				else
					echo "<td class='tngshadow'>&nbsp;<a href=\"$getperson_url" . "personID=".$theFamily['husband']."&tree=$tree\" target=\"_blank\">$fnamestr</a>&nbsp; </td>";

				if($mnamestr == "")
					echo "<td class='tngshadow'>&nbsp;".$text['unknown']." </td>";
				else
					echo "<td class='tngshadow'>&nbsp;<a href=\"$getperson_url" . "personID=".$theFamily['wife']."&tree=$tree\" target=\"_blank\">$mnamestr</a>&nbsp; </td>";
			}
			else
				echo"</tr>";
		}
	}
	echo "</table>";
}

echo "</div>\n";
echo "<br clear=\"all\" />";
echo "</div>";

tng_footer( "" );
?>
