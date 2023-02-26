<?php
@set_time_limit(0);
$textpart = "pedigree";
include("tng_begin.php");

include($subroot . "pedconfig.php");
if(!$personID) die("no args");

$getperson_url = getURL( "getperson", 1 );
$searchform_noargs_url = getURL( "searchform", 0 );
$descend_url = getURL( "descend", 1 );
$gedform_url = getURL( "gedform", 1 );
$ahnentafel_url = getURL( "ahnentafel", 1 );
$pedigree_url = getURL( "pedigree", 1 );
$pedigreetext_url = getURL( "pedigreetext", 1 );
$extrastree_url = getURL( "extrastree", 1 );
$ultraped_url = getURL( "ultraped", 1 );
$pdfform_url = getURL( "rpt_pdfform", 1 );
$vertical_url = getURL( "verticalchart", 1 );
$fan_url = getURL( "fan", 1 );

if(isset($generations)) $generations = intval($generations);
if(isset($parentset)) $parentset = intval($parentset);

function showBlank($pedborder) {
	echo "<td $pedborder><span class=\"normal\">&nbsp;</span></td>\n";
	echo "<td class=\"nw\"><span class=\"normal\">&nbsp;</span></td>\n</tr>\n";
	echo "<tr>\n<td $pedborder><span class=\"normal\">&nbsp;</span></td>\n";
	echo "<td class=\"nw\"><span class=\"normal\">&nbsp;</span></td>\n</tr>\n";
}

function displayIndividual( $key, $generation, $slot ) {
	global $tree, $generations, $marrdate, $marrplace, $pedmax, $people_table, $families_table, $children_table, $personID, $text;
	global $cms, $getperson_url, $pedigree_url, $parentset, $righttree;

	$nextslot = $slot * 2;
	$name = "";
	$row['birthdate'] = "";
	$row['birthplace'] = "";
	$row['altbirthdate'] = "";
	$row['altbirthplace'] = "";
	$row['deathdate'] = "";
	$row['deathplace'] = "";
	$row['burialdate'] = "";
	$row['burialplace'] = "";
	$row['famc'] = "";
	$rights['both'] = false;
	
	if( $key ) {
		$result = getPersonData($tree, $key);
		if( $result ) {
			$row = tng_fetch_assoc( $result );
			$rights = determineLivingPrivateRights($row, $righttree);
			$row['allow_living'] = $rights['living'];
			$row['allow_private'] = $rights['private'];
			$name = getName( $row );
			tng_free_result($result);
		}
	}

	if( $slot > 1 && $slot % 2 != 0 )
		echo "</tr>\n<tr>\n";
	
	$rowspan = pow( 2, $generations - $generation );
	if( $rowspan == 1 )
		$vertfill = 8;
	else
		$vertfill = ($rowspan - 1) * 53 + 1;
		
	if( $slot > 1 && $slot % 2 != 0 )
		echo "<td rowspan=\"$rowspan\" valign=\"top\">\n";
	elseif( $slot % 2 == 0 )
		echo "<td rowspan=\"$rowspan\" valign=\"bottom\">\n";
	else
		echo "<td rowspan=\"$rowspan\">\n";

	if( $slot > 1 && $slot % 2 != 0 ) {
		echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n<tr>\n";
		echo "<td width=\"1\"><img src=\"{$cms['tngpath']}img/black.gif\" alt=\"\" height=\"$vertfill\" width=\"1\" vspace=\"0\" hspace=\"0\" border=\"0\" /></td>\n";
		echo "<td></td>\n</tr>\n</table>\n";
	}
	else {
		echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n<tr>\n";
		echo "<td colspan=\"2\"><img src=\"{$cms['tngpath']}img/spacer.gif\" alt=\"\"  height=\"$vertfill\" width=\"1\" vspace=\"0\" hspace=\"0\" border=\"0\" /></td>\n</tr>\n</table>\n";
	}

	echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
	echo "<tr>\n";
	$pedborder = $slot % 2 && $slot != 1 ? "class=\"nw pedborderleft\"" : "";
	//if( $slot > 1 && $slot % 2 != 0 ) {
		//echo "<td><IMG SRC=\"{$cms['tngpath']}img/black.gif\" HEIGHT=15 WIDTH=1 VSPACE=0 HSPACE=0 border=\"0\"></td>\n";
	//}
    //else {
		//echo "<td><IMG SRC=\"{$cms['tngpath']}img/spacer.gif\" WIDTH=1 HEIGHT=1 border=\"0\" HSPACE=0 VSPACE=0></td>\n";
	//}
	echo "<td colspan=\"2\" $pedborder><span class=\"normal\">&nbsp;$slot. <a href=\"$getperson_url" . "personID=$key&amp;tree=$tree\">$name</a>&nbsp;</span></td>\n";

	//arrow goes here in own cell
	if( $nextslot >= $pedmax && $row['famc'] )
		echo "<td><span class=\"normal\"><a href=\"$pedigree_url" . "personID=$key&amp;tree=$tree&amp;display=textonly\" title=\"{$text['popupnote2']}\">=&gt;</a></span></td>\n";

	echo "</tr>\n";
	echo "<tr>\n<td colspan=\"2\"><img src=\"{$cms['tngpath']}img/black.gif\" alt=\"\" width=\"100%\" height=\"1\" vspace=\"0\" hspace=\"0\" border=\"0\" /></td>\n</tr>\n";
	echo "<tr>\n";

	$pedborder = $slot % 2 ? "" : "class=\"pedborderleft\"";
	//if( $slot % 2 == 0 ) {
		//echo "<td rowspan=\"6\"><IMG SRC=\"{$cms['tngpath']}img/black.gif\" HEIGHT=90 WIDTH=1 VSPACE=0 HSPACE=0 border=\"0\"></td>\n";
	//}
	//else {
		//echo "<td rowspan=\"4\"><IMG SRC=\"{$cms['tngpath']}img/spacer.gif\" WIDTH=1 HEIGHT=1 border=\"0\" HSPACE=0 VSPACE=0></td>\n";
	//}
	if( $rights['both'] ) {
		if( $row['birthdate'] || $row['altbirthdate'] || $row['altbirthplace'] || $row['deathdate'] || $row['burialdate'] || $row['burialplace'] || ( $slot % 2 == 0 && ( $marrdate[$slot] || $marrplace[$slot] ) ) )
			$dataflag = 1;
		else
			$dataflag = 0;
		if( $row['altbirthdate'] && !$row['birthdate'] ) {
			echo "<td valign=\"top\" $pedborder><span class=\"normal\">&nbsp;{$text['capaltbirthabbr']}:</span></td>\n";
			echo "<td valign=\"top\"><span class=\"normal\">" . displayDate( $row['altbirthdate'] ) . "&nbsp;</span></td>\n</tr>\n";
			echo "<tr>\n<td valign=\"top\" $pedborder><span class=\"normal\">&nbsp;{$text['capplaceabbr']}:&nbsp;</span></td>\n";
			echo "<td valign=\"top\"><span class=\"normal\">{$row['altbirthplace']}&nbsp;</span></td>\n</tr>\n";
		}
		elseif( $dataflag ) {
			echo "<td valign=\"top\" $pedborder><span class=\"normal\">&nbsp;{$text['capbirthabbr']}:</span></td>\n";
			echo "<td valign=\"top\"><span class=\"normal\">" . displayDate( $row['birthdate'] ) . "&nbsp;</span></td></tr>\n";
			echo "<tr>\n<td valign=\"top\" $pedborder><span class=\"normal\">&nbsp;{$text['capplaceabbr']}:&nbsp;</span></td>\n";
			echo "<td valign=\"top\"><span class=\"normal\">{$row['birthplace']}&nbsp;</span></td>\n</tr>\n";
		}
		else
			showBlank($pedborder);
		if( $slot % 2 == 0 ) {
			if( $dataflag ) {
				echo "<tr>\n<td valign=\"top\" class=\"pedborderleft\"><span class=\"normal\">&nbsp;{$text['capmarrabbr']}:</span></td>\n";
				echo "<td valign=\"top\"><span class=\"normal\">" . displayDate( $marrdate[$slot] ) . "&nbsp;</span></td>\n</tr>\n";
				echo "<tr>\n<td valign=\"top\" class=\"pedborderleft\"><span class=\"normal\">&nbsp;{$text['capplaceabbr']}:&nbsp;</span></td>\n";
				echo "<td valign=\"top\"><span class=\"normal\">{$marrplace[$slot]}&nbsp;</span></td>\n</tr>\n";
			}
			else {
				echo "<tr>\n";
				showBlank($pedborder);
				}
		}
		if( $row['burialdate'] && !$row['deathdate'] ) {
			echo "<tr>\n<td valign=\"top\" $pedborder><span class=\"normal\">&nbsp;{$text['capburialabbr']}:</span></td>\n";
			echo "<td valign=\"top\"><span class=\"normal\">" . displayDate( $row['burialdate'] ) . "&nbsp;</span></td>\n</tr>\n";
			echo "<tr>\n<td valign=\"top\" $pedborder><span class=\"normal\">&nbsp;{$text['capplaceabbr']}:&nbsp;</span></td>\n";
			echo "<td valign=\"top\"><span class=\"normal\">{$row['burialplace']}&nbsp;</span></td>\n</tr>\n</table>\n";
		}
		elseif( $dataflag ) {
			echo "<tr>\n<td valign=\"top\" $pedborder><span class=\"normal\">&nbsp;{$text['capdeathabbr']}:</span></td>\n";
			echo "<td valign=\"top\"><span class=\"normal\">" . displayDate( $row['deathdate'] ) . "&nbsp;</span></td></tr>\n";
			echo "<tr>\n<td valign=\"top\" $pedborder><span class=\"normal\">&nbsp;{$text['capplaceabbr']}:&nbsp;</span></td>\n";
			echo "<td valign=\"top\"><span class=\"normal\">{$row['deathplace']}&nbsp;</span></td>\n</tr>\n</table>\n";
		}
		else {
			echo "<tr>\n";
			showBlank($pedborder);
			
			echo "</table>\n";
		}
	}
	else {
		//echo "<tr>\n";
		showBlank($pedborder);
		if( $slot % 2 == 0 ) {
			echo "<tr>\n";
			showBlank($pedborder);
					}
		echo "<tr>\n";
		showBlank($pedborder);
		echo "</table>\n";
	}
	
	if( $slot % 2 == 0 ) {
		echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n<tr>\n";
		echo "<td width=\"1\"><img src=\"{$cms['tngpath']}img/black.gif\" alt=\"\"  height=\"$vertfill\" width=\"1\" vspace=\"0\" hspace=\"0\" border=\"0\" /></td>\n";
		echo "<td></td>\n</tr>\n</table>\n";
	}
	else {
		echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n<tr>\n";
		echo "<td colspan=\"2\"><img src=\"{$cms['tngpath']}img/spacer.gif\" alt=\"\" height=\"$vertfill\" width=\"1\" vspace=\"0\" hspace=\"0\" border=\"0\" /></td>\n</tr>\n</table>\n";
	}
	echo "</td>\n";
	
	$generation++;
	if( $nextslot < $pedmax ) {
		$husband = "";
		$wife = "";
		$marrdate[$nextslot] = "";
		$marrplace[$nextslot] = "";

		if( $key ) {
			$parentfamID = "";
			$locparentset = $parentset;
			$parentscount = 0;
			$parentfamIDs = array();
			$parents = getChildFamily($tree, $key, "parentorder");
			if ( $parents ) {
				$parentscount = tng_num_rows( $parents );
				if ( $parentscount > 0 ) {
					if ( $locparentset > $parentscount )
						$locparentset = $parentscount;
					$i = 0;
					while ( $parentrow = tng_fetch_assoc( $parents ) ) {
						$i++;
						if( $i == $locparentset )
							$parentfamID = $parentrow['familyID'];
						$parentfamIDs[$i] = $parentrow['familyID'];
					}
					if(!$parentfamID) $parentfamID = $row['famc'];
				}
				tng_free_result($parents);
			}

			$result2 = getFamilyData($tree, $parentfamID);
			$newrow = tng_fetch_assoc( $result2 );
			if( $newrow ) {
				$husband = $newrow['husband'];
				$wife = $newrow['wife'];
				$nrights = determineLivingPrivateRights($newrow, $righttree);
				if( $nrights['both'] ) {
					$marrdate[$nextslot] = $newrow['marrdate'];
					$marrplace[$nextslot] = $newrow['marrplace'];
				}
				else {
					$marrdate[$nextslot] = "";
					$marrplace[$nextslot] = "";
				}
			}
			tng_free_result($result2);
		}
		displayIndividual( $husband, $generation, $nextslot );
		$nextslot++;
		displayIndividual( $wife, $generation, $nextslot );
	}
}

$result = getPersonFullPlusDates($tree, $personID);
if( $result ) {
	$row = tng_fetch_assoc( $result );
	$righttree = checktree($tree);
	$rightbranch = $righttree ? checkbranch($row['branch']) : false;
	$rights = determineLivingPrivateRights($row, $righttree, $rightbranch);
	$row['allow_living'] = $rights['living'];
	$row['allow_private'] = $rights['private'];
	$pedname = getName( $row );
	$logname = $tngconfig['nnpriv'] && $row['private'] ? $admtext['text_private'] : ($nonames && $row['living'] ? $text['living'] : $pedname);
	tng_free_result($result);
}

$treeResult = getTreeSimple($tree);
$treerow = tng_fetch_assoc($treeResult);
$disallowgedcreate = $treerow['disallowgedcreate'];
$allowpdf = !$treerow['disallowpdf'] || ($allow_pdf && $rightbranch);
tng_free_result($treeResult);

if( !$pedigree['maxgen'] ) $pedigree['maxgen'] = 6;
if( $generations > $pedigree['maxgen'] ) 
    $generations = intval($pedigree['maxgen']);
elseif( !$generations )
    $generations = $pedigree['initpedgens'] >= 2 ? intval($pedigree['initpedgens']) : 2;
else
	$generations = intval( $generations );

$pedmax = pow( 2, intval($generations) );
$key = $personID;

$gentext = xmlcharacters($text['generations']);
writelog( "<a href=\"$pedigree_url" . "personID=$personID&amp;tree=$tree&amp;generations=$generations&amp;display=textonly\">" . xmlcharacters($text['pedigreefor'] . " $logname ($personID)") . "</a> $generations " . $gentext );
preparebookmark( "<a href=\"$pedigree_url" . "personID=$personID&amp;tree=$tree&amp;generations=$generations&amp;display=textonly\">" . xmlcharacters($text['pedigreefor'] . " $pedname ($personID)") . "</a> $generations " . $gentext );

//$flags['scripting'] = "<style>
//.pedborderleft {
//	border-left: solid 1.2px black;
//	}
//</style>";
$flags['scripting'] = "<script type=\"text/javascript\">var tnglitbox;</script>\n";

tng_header( $text['pedigreefor'] . " $pedname", $flags );
?>

<?php 
	$photostr = showSmallPhoto( $personID, $pedname, $rights['both'], 0, false, $row['sex'] );
	echo tng_DrawHeading( $photostr, $pedname, getYears( $row ) );

	$innermenu = $text['generations'] . ": &nbsp;";
	$innermenu .= "<select name=\"generations\" class=\"verysmall\" onchange=\"window.location.href='$pedigreetext_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;generations=' + this.options[this.selectedIndex].value\">\n";
    for( $i = 1; $i <= $pedigree['maxgen']; $i++ ) {
        $innermenu .= "<option value=\"$i\"";
        if( $i == $generations ) $innermenu .= " selected=\"selected\"";
        $innermenu .= ">$i</option>\n";
    }
	$innermenu .= "</select>&nbsp;&nbsp;&nbsp;\n";
	$innermenu .= "<a href=\"$pedigree_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;display=standard&amp;generations=$generations\" class=\"lightlink\" id=\"stdpedlnk\">{$text['pedstandard']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"$vertical_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;display=vertical&amp;generations=$generations\" class=\"lightlink\" id=\"pedchartlnk\">{$text['pedvertical']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"$pedigree_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;display=compact&amp;generations=$generations\" class=\"lightlink\" id=\"compedlnk\">{$text['pedcompact']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"$pedigree_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;display=box&amp;generations=$generations\" class=\"lightlink\" id=\"boxpedlnk\">{$text['pedbox']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"$pedigreetext_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;generations=$generations\" class=\"lightlink3\">{$text['pedtextonly']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"$ahnentafel_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;generations=$generations\" class=\"lightlink\">{$text['ahnentafel']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"$fan_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;generations=$generations\" class=\"lightlink\">{$text['fanchart']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"$extrastree_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;showall=1&amp;generations=$generations\" class=\"lightlink\">{$text['media']}</a>\n";
	if($generations <= 6 && $allowpdf)
		$innermenu .= " &nbsp;&nbsp; | &nbsp;&nbsp; <a href=\"#\" class=\"lightlink\" onclick=\"tnglitbox = new LITBox('$pdfform_url" . "pdftype=ped&amp;personID=$personID&amp;tree=$tree&amp;generations=$generations',{width:350,height:350});return false;\">PDF</a>\n";

	echo getFORM( "pedigree", "", "form1", "form1" );
	echo tng_menu( "I", "pedigree", $personID, $innermenu );
	echo "</form>\n";
?>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
<?php
$slot = 1;
displayIndividual( $personID, 1, $slot );
?>
</tr>
</table>
<?php
	tng_footer( "" ); 
?>