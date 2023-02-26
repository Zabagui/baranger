<?php
$textpart = "pedigree";
include("tng_begin.php");

if(!$personID) die("no args");
include($subroot . "pedconfig.php");
include($cms['tngpath'] . "personlib.php" );
include($cms['tngpath'] . "reglib.php" );

$getperson_url = getURL( "getperson", 1 );
$descend_url = getURL( "descend", 1 );
$familygroup_url = getURL( "familygroup", 1 );
$familychart_url = getURL( "familychart", 1 );
$ahnentafel_url = getURL( "ahnentafel", 1 );
$pedigree_url = getURL( "pedigree", 1 );
$pedigreetext_url = getURL( "pedigreetext", 1 );
$extrastree_url = getURL( "extrastree", 1 );
$pdfform_url = getURL( "rpt_pdfform", 1 );
$vertical_url = getURL( "verticalchart", 1 );
$fan_url = getURL( "fan", 1 );

if(!empty($tngmore))
	$pedigree['regnotes'] = 1;
elseif(!empty($tngless))
	$pedigree['regnotes'] = 0;

$detail_link = "{$ahnentafel_url}personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;generations=$generations";
if($pedigree['regnotes'])
	$detail_link = "<a href=\"{$detail_link}&amp;tngless=1\">{$text['lessdetail']}</a>";
else
	$detail_link = "<a href=\"{$detail_link}&amp;tngmore=1\">{$text['moredetail']}</a>";

$generation = 1;
$personcount = 1;

$currgen = array();
$nextgen = array();
$numbers = array();
$lastgen = array();
$lastlastgen = array();

$result = getPersonFullPlusDates($tree, $personID);
if( !tng_num_rows($result) ) {
	tng_free_result($result);
	header( "Location: thispagedoesnotexist.html" );
	exit;
}

$row = tng_fetch_assoc( $result );
tng_free_result($result);
$righttree = checktree($tree);
$rightbranch = $righttree ? checkbranch($row['branch']) : false;
$rights = determineLivingPrivateRights($row, $righttree, $rightbranch);
$row['allow_living'] = $rights['living'];
$row['allow_private'] = $rights['private'];
$row['name'] = getName( $row );
//if( $row['name'] == $text['living'] ) $row['firstname'] = $text['living'];
$firstfirstname = getFirstNameOnly( $row );
$personsex = $row['sex'];

$logname = $tngconfig['nnpriv'] && $row['private'] ? $admtext['text_private'] : ($nonames && $row['living'] ? $text['living'] : $row['name']);
$row['genlist'] = "";
$row['number'] = 1;
$row['spouses'] = getSpouses( $personID, $row['sex'] );
$lastlastgen[$personID] = 1;

$treeResult = getTreeSimple($tree);
$treerow = tng_fetch_assoc($treeResult);
$disallowgedcreate = $treerow['disallowgedcreate'];
$allowpdf = !$treerow['disallowpdf'] || ($allow_pdf && $rightbranch);
tng_free_result($treeResult);

writelog( "<a href=\"$ahnentafel_url" . "personID=$personID&amp;tree=$tree\">" . xmlcharacters($text['ahnentafel'] . ": $logname ($personID)") . "</a>" );
preparebookmark( "<a href=\"$ahnentafel_url" . "personID=$personID&amp;tree=$tree\">" . xmlcharacters($text['ahnentafel'] . ": " . $row['name'] . " ($personID)") . "</a>" );

$flags['scripting'] = "<script type=\"text/javascript\">var tnglitbox;</script>\n";
tng_header( $row['name'], $flags );

	$photostr = showSmallPhoto( $personID, $row['name'], $rights['both'], 0, false, $row['sex'] );
	echo tng_DrawHeading( $photostr, $row['name'], getYears( $row ) );

	if( !$pedigree['maxgen'] ) $pedigree['maxgen'] = 6;
	if( $generations > $pedigree['maxgen'] )
	    $generations = intval($pedigree['maxgen']);
    elseif( !$generations )
	    $generations = $pedigree['initpedgens'] >= 2 ? intval($pedigree['initpedgens']) : 2;
	else
		$generations = intval( $generations );

	$innermenu = $text['generations'] . ": &nbsp;";
	$innermenu .= "<select name=\"generations\" class=\"verysmall\" onchange=\"window.location.href='$ahnentafel_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;generations=' + this.options[this.selectedIndex].value\">\n";
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
	$innermenu .= "<a href=\"$pedigreetext_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;generations=$generations\" class=\"lightlink\">{$text['pedtextonly']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"$ahnentafel_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;generations=$generations\" class=\"lightlink3\">{$text['ahnentafel']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"$fan_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;generations=$generations\" class=\"lightlink\">{$text['fanchart']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"$extrastree_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;showall=1&amp;generations=$generations\" class=\"lightlink\">{$text['media']}</a>\n";
	if($generations <= 6 && $allowpdf)
		$innermenu .= " &nbsp;&nbsp; | &nbsp;&nbsp; <a href=\"#\" class=\"lightlink\" onclick=\"tnglitbox = new LITBox('$pdfform_url" . "pdftype=ped&amp;personID=$personID&amp;tree=$tree&amp;generations=$generations',{width:350,height:350});return false;\">PDF</a>\n";

	echo getFORM( "pedigree", "", "form1", "form1" );
	echo tng_menu( "I", "pedigree", $personID, $innermenu );
	echo "</form>\n";
?>

<div class="titleboxmedium">
	<div class="float-right"><?php echo $detail_link; ?></div>
<?php
//do self
echo "<span class=\"subhead\"><strong>{$text['generation']}: 1</strong></span><br/><br />\n";
echo "<ol style=\"list-style-type:none; padding:0px; margin:0px;\">";
echo "<li>";
echo "<table cellpadding=\"0\" cellspacing=\"0\" class=\"aligntop\" ><tr><td width=\"40\" class=\"aligntop\" align=\"right\">";
echo "$personcount.&nbsp;&nbsp;</td><td>";
echo showSmallPhoto( $row['personID'], $row['name'], $rights['both'], 0 );
echo "<a href=\"$getperson_url" . "personID={$row['personID']}&amp;tree=$tree\" name=\"p{$row['personID']}\" id=\"p{$row['personID']}\">{$row['name']}</a>";
echo getVitalDates( $row, 1 );
echo getOtherEvents($row);
if( $rights['both'] && $pedigree['regnotes'] ) {
	$notes = buildRegNotes(getRegNotes( $row['personID'], "I" ));
	if( $notes ) {
		echo "<p>{$text['notes']}:<br/>";
		echo "<blockquote class=\"blocknote\">\n$notes</blockquote>\n</p>\n";
	}
}
else
	$notes = "";

//do spouse
while( $spouserow = array_shift( $row['spouses'] ) ) {

	$marriagemsg = ($personsex == "F") ? $text['wasmarried_female'] :  $text['wasmarried_male'];
	if($spouserow['marrdate'] || $spouserow['marrplace']) {
		echo "<p>$firstfirstname " . $marriagemsg . " <a href=\"$getperson_url" . "personID={$spouserow['personID']}&amp;tree=$tree\">{$spouserow['name']}</a>";
		echo getSpouseDates( $spouserow, $personsex );
	}
	else {
		$spousename = $spouserow['name'] ? $spouserow['name'] : $text['unknown'];
		if(!empty($spouserow['personID']))
			echo "<p>{$text['family']}/{$text['spouse']}: <a href=\"$getperson_url" . "personID={$spouserow['personID']}&amp;tree=$tree\">$spousename</a>.";
		else
			echo "<p>{$text['family']}/{$text['spouse']}: $spousename.";
	}
	$spouseinfo = getVitalDates( $spouserow );
	if( $spouseinfo ) {
		$spfirstfirstname = getFirstNameOnly( $spouserow );
		$spparents = getSpouseParents( $spouserow['personID'], $spouserow['sex'] );
		echo " $spfirstfirstname $spparents $spouseinfo";
	}
	echo " [<a href=\"$familygroup_url" . "familyID={$spouserow['familyID']}&amp;tree=$tree\">{$text['groupsheet']}</a>]";
	echo " [<a href=\"$familychart_url" . "familyID={$spouserow['familyID']}&amp;tree=$tree\">{$text['familychart']}</a>]";
	echo "</p>\n";

	if($pedigree['regnotes']) {
		$famrights = determineLivingPrivateRights($spouserow, $righttree);
		if($famrights['both']) {
			$notes = buildRegNotes(getRegNotes( $spouserow['familyID'], "F" ));
			if( $notes ) {
				echo "<p>{$text['notes']}:<br/>";
				echo "<blockquote class=\"blocknote\">\n$notes</blockquote>\n</p>\n";
			}
		}
	}

	$result2 = getChildrenData($tree, $spouserow['familyID']);
	if( $result2 && tng_num_rows( $result2 ) ) {
		echo "{$text['children']}:\n<ol class=\"ahnblock\">\n";
		while( $childrow = tng_fetch_assoc( $result2 ) ) {
			//$childrow['genlist'] = $newlist;
			$crights = determineLivingPrivateRights($childrow, $righttree);
			$childrow['allow_living'] = $crights['living'];
			$childrow['allow_private'] = $crights['private'];
			$childrow['name'] = getName( $childrow );
			if( $childrow['name'] == $text['living'] ) $childrow['firstname'] = $text['living'];

			echo "<li style=\"list-style-type:lower-roman\"><a href=\"$getperson_url" . "personID={$childrow['personID']}&amp;tree=$tree\">{$childrow['name']}</a>";
			echo getVitalDates( $childrow );
			echo "</li>\n";
		}
		echo "</ol>\n";
		tng_free_result( $result2 );
	}
}
//if(!$is_mozilla)
	echo "</td></tr></table>";
echo "<br clear=\"all\" /></li>\n</ol>\n";


//push famc (family of parents) to nextgen
$parentfamID = "";
$locparentset = $parentset;
$parentscount = 0;
$parentfamIDs = array();
$parents = getChildFamily($tree, $personID, "parentorder");
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

array_push( $currgen, $parentfamID );
$generation++;
$personcount = 1;
$numbers[$parentfamID] = 1;

//loop through nextgen
//while there's one to pop and we're less than maxgen
while( count( $currgen ) && $generation <= $generations ) {
	//echo "<span class=\"subhead\"><strong>{$text['generation']}: $generation</strong></span><br />\n";
	echo "<span class=\"subhead\"><strong>{$text['generation']}: $generation</strong></span><br /><br />\n";
	//echo "<ol class=\"ahnblock normal\">\n";
	echo "<ol style=\"list-style-type:none; padding:0px; margin:0px;\">";
	while( $nextfamily = array_shift( $currgen ) ) {
		$parents = getFamilyData($tree, $nextfamily);
		if( $parents ) {
			$parentrow = tng_fetch_assoc( $parents );

			$famrights = determineLivingPrivateRights($parentrow, $righttree);
			$parentrow['allow_living'] = $famrights['living'];
			$parentrow['allow_private'] = $famrights['private'];
			$parentrow['both'] = $famrights['both'];

			if( $parentrow['husband'] ) {
				$gotfather = getPersonData($tree, $parentrow['husband']);

				$fathrow =  tng_fetch_assoc( $gotfather );
				if( $fathrow ) {
					if( $fathrow['firstname'] || $fathrow['lastname'] ) {
						$personcount = $numbers[$nextfamily] * 2;
						$lastgen[$fathrow['personID']] = $personcount;
						$frights = determineLivingPrivateRights($fathrow, $righttree);
						$fathrow['allow_living'] = $frights['living'];
						$fathrow['allow_private'] = $frights['private'];
						$fathrow['name'] = getName( $fathrow );
						if( $fathrow['name'] == $text['living'] ) $fathrow['firstname'] = $text['living'];

						//echo "<li value=\"$personcount\" class=\"aligntop\">";
						echo "<li>";
//						if(!$is_mozilla)
							//echo "<table cellpadding=\"0\" cellspacing=\"0\"><tr><td>";
							echo "<table cellpadding=\"0\" cellspacing=\"0\" class=\"aligntop\"><tr><td width=\"40\" class=\"aligntop\" align=\"right\">";
							echo "$personcount.&nbsp;&nbsp;</td><td>";
						echo showSmallPhoto( $fathrow['personID'], $fathrow['name'], $frights['both'], 0 );
						echo "<a href=\"$getperson_url" . "personID={$fathrow['personID']}&amp;tree=$tree\" name=\"p{$fathrow['personID']}\" id=\"p{$fathrow['personID']}\">{$fathrow['name']}</a>";
						echo getVitalDates( $fathrow, 1 );
						echo getOtherEvents($fathrow);
						if( $frights['both'] && $pedigree['regnotes'] ) {
							$notes = buildRegNotes(getRegNotes( $fathrow['personID'], "I" ));
							if( $notes ) {
								echo "<p>{$text['notes']}:<br />";
								echo "<blockquote class=\"blocknote\">\n$notes</blockquote>\n</p>\n";
							}
						}
						else $notes = "";
						if( $fathrow['famc'] ) {
							if( !in_array( $fathrow['famc'], $nextgen ) )
								array_push( $nextgen, $fathrow['famc'] );
							if(empty($numbers[$fathrow['famc']]))
								$numbers[$fathrow['famc']] = $personcount;
						}
					}
				}
				tng_free_result( $gotfather );
			}

			if( $parentrow['wife'] ) {
				$gotmother = getPersonData($tree, $parentrow['wife']);

				$mothrow =  tng_fetch_assoc( $gotmother );
				if( $gotmother ) {
					if( $mothrow['firstname'] || $mothrow['lastname'] ) {
						$personcount = $numbers[$nextfamily] * 2 + 1;
						$lastgen[$mothrow['personID']] = $personcount;
						$mrights = determineLivingPrivateRights($mothrow, $righttree);
						$mothrow['allow_living'] = $mrights['living'];
						$mothrow['allow_private'] = $mrights['private'];
						$mothrow['name'] = getName( $mothrow );
						if( $mothrow['name'] == $text['living'] ) $mothrow['firstname'] = $text['living'];

						if( $parentrow['husband'] ) {
							$firstfirstname = getFirstNameOnly( $fathrow );
							$marriagemsg = ($personsex == "F") ? $text['wasmarried_female'] :  $text['wasmarried_male'];
							if($parentrow['marrdate'] || $parentrow['marrplace']) {
								echo "<p>$firstfirstname " . $marriagemsg . " <a href=\"#\" onclick=\"jQuery('html, body').animate({scrollTop: jQuery('#p{$parentrow['wife']}').offset().top-50},'slow'); return false;\">{$mothrow['name']}</a>";
								echo getSpouseDates( $parentrow, $personsex );
 							}
							else
								echo "<p>$firstfirstname " . $marriagemsg . " <a href=\"#\" onclick=\"jQuery('html, body').animate({scrollTop: jQuery('#p{$parentrow['wife']}').offset().top-50},'slow'); return false;\">{$mothrow['name']}</a>.";
							$spouseinfo = getVitalDates( $mothrow );
							if( $spouseinfo ) {
								$spfirstfirstname = getFirstNameOnly( $mothrow );
								$spparents = getSpouseParents( $mothrow['personID'], $mothrow['sex'] );
								echo " $spfirstfirstname $spparents $spouseinfo";
							}
							echo " [<a href=\"$familygroup_url" . "familyID=$nextfamily&amp;tree=$tree\">{$text['groupsheet']}</a>] [<a href=\"$familychart_url" . "familyID=$nextfamily&amp;tree=$tree\">{$text['familychart']}</a>]</p>\n";
//							if(!$is_mozilla)
								echo "</td></tr></table>";
							echo "<br clear=\"all\" /></li>\n";
						}

						//echo "<li value=\"$personcount\" class=\"aligntop\">";
						echo "<li>";
//						if(!$is_mozilla)
							//echo "<table cellpadding=\"0\" cellspacing=\"0\"><tr><td>";
							echo "<table cellpadding=\"0\" cellspacing=\"0\" class=\"aligntop\"><tr><td width=\"40\" class=\"aligntop\" align=\"right\">";
							echo "$personcount.&nbsp;&nbsp;</td><td>";
						echo showSmallPhoto( $mothrow['personID'], $mothrow['name'], $mrights['both'], 0 );
						echo "<a href=\"$getperson_url" . "personID={$mothrow['personID']}&amp;tree=$tree\" name=\"p{$mothrow['personID']}\" id=\"p{$mothrow['personID']}\">{$mothrow['name']}</a>";
						echo getVitalDates( $mothrow, 1 );
						echo getOtherEvents($mothrow);
						if( $mrights['both'] && $pedigree['regnotes'] ) {
							$notes = buildRegNotes(getRegNotes( $mothrow['personID'], "I" ));
							if( $notes ) {
								echo "<p>{$text['notes']}:<br />";
								echo "<blockquote class=\"blocknote\">\n$notes</blockquote>\n</p>\n";
							}
						}
						else $notes = "";
						//echo "</li>\n";
						if( $mothrow['famc'] ) {
							if( !in_array( $mothrow['famc'], $nextgen ) )
   								array_push( $nextgen, $mothrow['famc'] );
							if(empty($numbers[$mothrow['famc']]))
								$numbers[$mothrow['famc']] = $personcount;
						}
					}
				}
				tng_free_result( $gotmother );

				if($pedigree['regnotes']) {
					$prights = determineLivingPrivateRights($parentrow, $righttree);
					if($prights['both']) {
						$notes = buildRegNotes(getRegNotes( $nextfamily, "F" ));
						if( $notes ) {
							echo "<p>{$text['notes']}:<br />";
							echo "<blockquote class=\"blocknote\">\n$notes</blockquote>\n</p>\n";
						}
					}
				}
			}

			//get children
			$result2 = getChildrenData($tree, $nextfamily);
			if( $result2 && tng_num_rows( $result2 ) ) {
				echo "<table cellpadding=\"0\" cellspacing=\"0\"><tr><td>{$text['children']}:<br />\n<ol class=\"ahnblock\">\n";
				while( $childrow = tng_fetch_assoc( $result2 ) ) {
					$crights = determineLivingPrivateRights($childrow, $righttree);
					$childrow['allow_living'] = $crights['living'];
					$childrow['allow_private'] = $crights['private'];
					$childrow['name'] = getName( $childrow );
					//if( $childrow['name'] == $text['living'] ) $childrow['firstname'] = $text['living'];

					echo "<li style=\"list-style-type:lower-roman\">";
					if(!empty($lastlastgen[$childrow['personID']])) {
						echo $lastlastgen[$childrow['personID']] . ". ";
						echo "<a href=\"#\" onclick=\"jQuery('html, body').animate({scrollTop: jQuery('#p{$childrow['personID']}').offset().top-50},'slow'); return false;\">{$childrow['name']}</a>";
					}
					else
						echo "<a href=\"$getperson_url" . "personID={$childrow['personID']}&amp;tree=$tree\">{$childrow['name']}</a>";
					echo getVitalDates( $childrow );
					echo "</li>\n";
				}
				echo "</ol>\n</td></tr></table>\n";
				tng_free_result( $result2 );
			}
//			if(!$is_mozilla)
				echo "</td></tr></table>";
			echo "<br clear=\"all\" /></li>\n";
		}
	}

	$currgen = $nextgen;
	$lastlastgen = $lastgen;
	unset( $nextgen );
	unset( $lastgen );
	$nextgen = array();
	$lastgen = array();
	$generation++;
	echo "</ol>\n<br />\n";
}
?>
</div>

<?php
	tng_footer( "" );
?>