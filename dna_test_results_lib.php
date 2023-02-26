<?php
		//dna tests
      	$debug = isset($_GET['debug']) ? $_GET['debug'] : false;	//get URL debug parameter
		//search for dna tests, if any found do the following
		$query = "SELECT $dna_tests_table.testID, $dna_tests_table.personID as tpersonID, $dna_tests_table.gedcom as tgedcom, test_type, test_number, test_date, match_date, markers, mtdna_haplogroup, ydna_haplogroup, hvr1_results, hvr2_results, y_results, person_name, mtdna_confirmed, ydna_confirmed, notes, markeropt, notesopt, linksopt, surnamesopt, private_dna,urls, surnames, MD_ancestorID, MRC_ancestorID, admin_notes, medialinks, ref_seq, xtra_mut, coding_reg, shared_cMs, shared_segments, chromosome, segment_start, segment_end, centiMorgans, matching_SNPs, x_match, relationship_range, suggested_relationship, actual_relationship, related_side, GEDmatchID, private_test
			FROM $dna_tests_table, $dna_links_table
			WHERE $dna_links_table.personID = \"$personID\" AND $dna_links_table.gedcom = \"$tree\" AND $dna_links_table.testID = $dna_tests_table.testID
			ORDER BY match_date DESC, test_type ASC, markers * 1 ASC,  test_number * 1 ASC";
		$dna_results = tng_query($query);
		$num_tests = tng_num_rows($dna_results);
		if ($debug) {
			echo "Allow Private - $allow_private<br />";
			echo "Number of DNA Tests - $num_tests<br />";
		}

		// following query added to check if this is a Private Test
		$pquery = "SELECT $dna_tests_table.testID, $dna_tests_table.personID as tpersonID, $dna_tests_table.gedcom as tgedcom,private_test
			FROM $dna_tests_table, $dna_links_table
			WHERE $dna_links_table.personID = \"$personID\" AND $dna_links_table.gedcom = \"$tree\" AND $dna_links_table.testID = $dna_tests_table.testID AND $dna_tests_table.private_test = \"1\"
			ORDER BY test_type, markers * 1 ASC, test_date, test_number * 1 ASC";
		$priv_results = tng_query($pquery);
		$dnarow = tng_fetch_assoc($priv_results);		// added for Private Test check
		$num_private = tng_num_rows($priv_results);		// added for Private Test check
		if ($debug)
			echo "Number of Private DNA Tests - $num_private<br />";

		$totnum_tests = $num_tests;

		if ( !$allow_private)
			$totnum_tests = ($num_tests - $num_private);
		if ($debug)
			echo "Number of total DNA Tests - $totnum_tests<br />";
		if($totnum_tests) {
            $toggleicon = "<img border=\"0\" src=\"{$cms['tngpath']}img/tng_sort_desc.gif\" class=\"toggleicon2\" style=\"cursor:pointer; float:right; padding-top:4px;\" title=\"{$text['expand']}\" alt=\"\" onclick=\"togglednaicon(); \" />";
            $displaystyle = "display:none";
            $displayclass = "dnatest";

			$uquery = "SELECT $dna_tests_table.testID, $dna_tests_table.personID, $dna_tests_table.gedcom FROM $dna_tests_table, $dna_links_table
				WHERE $dna_links_table.personID = \"$personID\" AND $dna_links_table.gedcom = \"$tree\" AND $dna_links_table.testID = $dna_tests_table.testID AND $dna_tests_table.personID != \"$personID\"";
			$dna_uresults = tng_query($uquery);
			$num_utests = tng_num_rows($dna_uresults);
			tng_free_result($dna_uresults);

			if ( $allow_private) {
				$num_links = $num_tests;
				$num_tests = $num_tests + 2;
			}
			else {
				$num_links = $totnum_tests;
				$num_tests = $totnum_tests + 2;
			}
            if ($num_utests) {
				$linkedstr = ($num_links > 1 && $num_utests) ? $text['testsarelinked'] : $text['testislinked'];
				$linkedstr .= "&nbsp;" . $dnanamestr;
            }
            else
				$linkedstr = $num_links > 1 ? $admtext['dna_tests'] : $text['dna_test'];
			$persontext .= "<table cellspacing=\"1\" cellpadding=\"4\" class=\"whiteback dna-tfixed normal\">\n";
			$persontext .= "<col class=\"labelcol\"/><col style=\"width:{$datewidth}px\"/><col class=\"takenbycol\"/><col class=\"haplogroupcol\"/><col />\n";

			$persontext .= "<tr>\n";
			$persontext .= "<td valign=\"top\" class=\"fieldnameback fieldname rc-ul rc-ll\" rowspan=\"$num_tests\">{$admtext['dna_tests']}$toggleicon</td>\n";
 			$persontext .= "<td colspan=\"4\" class=\"fieldnameback fieldname rc-lr\"><strong>&nbsp;$num_links&nbsp;$linkedstr</strong>&nbsp;<a href=\"#\" title=\"{$text['dna_info_head']}\"><img border=\"0\" src=\"{$cms['tngpath']}img/info_2.png\" width=\"14\" height=\"14\" alt=\"\" onclick=\"tnglitbox = new LITBox('dna_info.php',{overlay:false,width:620,height:200}); return false\"/></a></td></tr><tr id=\"dnatest\" class=\"$displayclass\" style=\"$displaystyle\">\n";
			$persontext .= "<th valign=\"top\" class=\"fieldnameback fieldname\">{$text['test_type']}</th><th valign=\"top\" class=\"fieldnameback fieldname\">{$text['takenby']}</th><th valign=\"top\" class=\"fieldnameback fieldname\">{$text['haplogroup']}&nbsp;</th><th valign=\"top\" class=\"fieldnameback fieldname\">{$text['test_info']}</th></tr><tr class=\"$displayclass\" style=\"$displaystyle\">\n";

			//for each test, do a row
			$testnum = 0;
			while($dna_test = tng_fetch_assoc($dna_results)) {
			  if ($dna_test['private_test'] && ( $allow_private) || (!$dna_test['private_test'])) {
				$dna_pers_result = getPersonSimple($dna_test['tgedcom'], $dna_test['tpersonID']);
				$dprow = tng_fetch_assoc($dna_pers_result);
				if( $dprow ) {
					$dna_righttree = checktree($dna_test['tgedcom']);
					$dna_rightbranch = !empty($dna_righttree) ? checkbranch(isset($dprow['branch'])) : false;
					$dprights = determineLivingPrivateRights($dprow, $dna_righttree, $dna_rightbranch);
					$dprow['allow_living'] = $dprights['living'];
					$dprow['allow_private'] = $dprights['private'];
					$dbname = getName( $dprow );
					$person_name = $dna_test['person_name'];
				} else {
					$dbname = "";
					$person_name = $dna_test['person_name'];
				}
				if ($dna_test['private_test'])
					$privacy = "&nbsp;(" . $text['keep_test_private'] . ")";
				else
					$privacy = "";
				if ($dbname)
					$dna_namestr = "<a href=\"$getperson_url" . "personID={$dna_test['tpersonID']}&amp;tree={$dna_test['tgedcom']}\">" . getName( $dprow ) . "</a> $privacy";
				else
					$dna_namestr = $person_name . $privacy;
				if ($dna_test['private_dna'] && !$allow_edit) $dna_namestr = $admtext['text_private'];
				tng_free_result($dna_pers_result);

				if($testnum) {
					$persontext .= "\n<tr class=\"dnatest\" style=\"display:none\">\n";
				}
				$markercount = ($dna_test['test_type'] == "Y-DNA") ? "-{$dna_test['markers']}" : "";
				$persontext .= "<td valign=\"top\" class=\"databack\"><a href=\"$dna_test_url" . "testID={$dna_test['testID']}\">{$dna_test['test_type']}$markercount</a></td>\n";
				$persontext .= "<td valign=\"top\" class=\"databack\">$dna_namestr</td>";
				$test_type = $dna_test['test_type'];
				$haplogroup = "";
				if ($dna_test['test_type'] == "Y-DNA")
					$haplogroup = $dna_test['ydna_haplogroup'] ? $dna_test['ydna_haplogroup'] : " ";
				if ($dna_test['test_type'] == "mtDNA")
					$haplogroup = $dna_test['mtdna_haplogroup'] ? $dna_test['mtdna_haplogroup'] : " ";
				if ($dna_test['test_type'] == "atDNA") {
					if ($dna_test['ydna_haplogroup'])
						$haplogroup = "Y = " . $dna_test['ydna_haplogroup'] . "<br />";
					if ($dna_test['mtdna_haplogroup']) {
						$haplogroup .= "mt = " . $dna_test['mtdna_haplogroup'];
					}
				}
				$ref_seq = $dna_test['ref_seq'];
				$hvr1_results = $dna_test['hvr1_results'];
				$hvr2_results = $dna_test['hvr2_results'];
				$xtra_mut = $dna_test['xtra_mut'];
				$coding_reg = $dna_test['coding_reg'];
				$shared_cMs = $dna_test['shared_cMs'];
				$shared_segments = $dna_test['shared_segments'];
				$chromosome = $dna_test['chromosome'];
				$segment_start = $dna_test['segment_start'];
				$segment_end = $dna_test['segment_end'];
				$centiMorgans = $dna_test['centiMorgans'];
				$matching_SNPs = $dna_test['matching_SNPs'];
				$x_match = $dna_test['x_match'];
				$relationship_range = $dna_test['relationship_range'];
				$suggested_relationship = $dna_test['suggested_relationship'];
				$actual_relationship = $dna_test['actual_relationship'];
				$related_side = $dna_test['related_side'];
				$GEDmatchID = $dna_test['GEDmatchID'];
				$y_results = $dna_test['y_results'];
				$surnames = !empty($ancsurnameupper) ? strtoupper($dna_test['surnames']) : $dna_test['surnames'];
				$dna_notes = $dna_test['notes'];
				$admin_notes = $dna_test['admin_notes'];

				$mdanc_namestr = "";
				if($dna_test['MD_ancestorID']) {// Get Most Distant Ancestor info
					$dna_anc_result = getPersonData($dna_test['tgedcom'], $dna_test['MD_ancestorID']);
					$ancrow = tng_fetch_assoc($dna_anc_result);
					if( $ancrow ) {
						$anc_righttree = checktree($dna_test['tgedcom']);
						$anc_rightbranch = $anc_righttree ? checkbranch($ancrow['branch']) : false;
						$ancrights = determineLivingPrivateRights($ancrow, $anc_righttree, $anc_rightbranch);
						$ancrow['allow_living'] = $ancrights['living'];
						$ancrow['allow_private'] = $ancrights['private'];
						$vitalinfo = getBirthInfo($ancrow);
						$anc_namestr = getName( $ancrow );
						$mdanc_namestr = "<a href=\"$getperson_url" . "personID={$dna_test['MD_ancestorID']}&amp;tree={$dna_test['tgedcom']}\">$anc_namestr</a>" . $vitalinfo;
					}

					tng_free_result($dna_anc_result);
				}
				$mrcanc_namestr = "";
				if($dna_test['MRC_ancestorID']) {// Get MRCA Individual info
					if ($dna_test['MRC_ancestorID'][0] == "I") {
						$dna_anc_result = getPersonData($dna_test['tgedcom'], $dna_test['MRC_ancestorID']);
						$ancrow = tng_fetch_assoc($dna_anc_result);
						if( $ancrow ) {
							$anc_righttree = checktree($dna_test['tgedcom']);
							$anc_rightbranch = $anc_righttree ? checkbranch($ancrow['branch']) : false;
							$ancrights = determineLivingPrivateRights($ancrow, $anc_righttree, $anc_rightbranch);
							$ancrow['allow_living'] = $ancrights['living'];
							$ancrow['allow_private'] = $ancrights['private'];
							$vitalinfo = getBirthInfo($ancrow);
							$anc_namestr = getName( $ancrow );
							$mrcanc_namestr = "<a href=\"$getperson_url" . "personID={$dna_test['MRC_ancestorID']}&amp;tree={$dna_test['tgedcom']}\">$anc_namestr</a>" . $vitalinfo;
						}

						tng_free_result($dna_anc_result);
					}
					else if ($dna_test['MRC_ancestorID'][0] == $tngconfig['familyprefix']) {  // Get MRCA Family info
						$mrcquery = "SELECT familyID, husband, wife, living, private, marrdate, gedcom, branch FROM $families_table WHERE familyID = \"{$dna_test['MRC_ancestorID']}\" AND gedcom = \"{$dna_test['tgedcom']}\"";
						$mrcresult = tng_query($mrcquery);
						$ancrow = tng_fetch_assoc($mrcresult);
						tng_free_result($mrcresult);
						if( $ancrow ) {
							$anc_righttree = checktree($dna_test['tgedcom']);
							$anc_rightbranch = checkbranch($ancrow['branch']);
							$ancrights = determineLivingPrivateRights($ancrow, $anc_righttree, $anc_rightbranch);
							$ancrow['allow_living'] = $ancrights['living'];
							$ancrow['allow_private'] = $ancrights['private'];
							$famname = getFamilyName( $ancrow );
							$fammarried = "<br />&nbsp;&nbsp;<strong>{$text['marrabbr']}</strong>&nbsp;" . $ancrow['marrdate'];
							$mrcanc_namestr = $text['family'] . ": " . "<a href=\"$familygroup_url" . "familyID={$dna_test['MRC_ancestorID']}&amp;tree={$dna_test['tgedcom']}\">$famname</a>" . $fammarried;
						}
					}
				}
				if( $dna_test['medialinks'] ) {// Get Media Links
					$medialinks = showMediaLinks($dna_test['medialinks']);
				}
				else $medialinks = "";
				if( $dna_test['urls'] ) {// Get Relevant Links
					$urls = showLinks($dna_test['urls'],true);
					if($urls) $urls = "<ul>$urls</ul>";
				}
				else
					$urls = "";
				// Start test results
            	if(isset($ydna_haplogroup)) {
					if ($dna_test['ydna_confirmed'])
						$haplogroup = "<a class=\"fakelink confirmed_haplogroup\" title=\"{$text['confirmed']}\">" . $ydna_haplogroup . "</a>";
					else
						$haplogroup = "<a class=\"fakelink predicted_haplogroup\"  title = \"{$text['predicted']}\">" . $ydna_haplogroup . "</a>";
				}
            	if(isset($mtdna_haplogroup)) {
					if ($dna_test['mtdna_confirmed'])
						$haplogroup = "<a class=\"fakelink confirmed_haplogroup\" title=\"{$text['confirmed']}\">" . $mtdna_haplogroup . "</a>";
					else
						$haplogroup = "<a class=\"fakelink predicted_haplogroup\"  title = \"{$text['predicted']}\">" . $mtdna_haplogroup . "</a>";
				}
				$persontext .= "<td valign=\"top\" class=\"databack\">$haplogroup&nbsp;</td>\n";
				$persontext .= "<td class=\"databack resultscol\">";
				if($GEDmatchID) {
					$GEDmatch_str = "<a href=\"https://www.gedmatch.com/\" target=\"_blank\">$GEDmatchID</a>";
					$persontext .= "<strong>{$admtext['gedmatchID']}</strong> =  $GEDmatch_str <br /><br />";
					}
				if ($mdanc_namestr)
					$persontext .= "<strong>" . $admtext['mda'] . ":</strong><br />" . $mdanc_namestr . "<br /><br />";
				if ($mrcanc_namestr)
					$persontext .= "<strong>" . $admtext['mrca'] . ":</strong><br />" . $mrcanc_namestr . "<br />";
				if ($dna_test['markeropt']) {
					$persontext .= $y_results ? "<br /><strong>" . $dna_test['markers'] . "&nbsp;" . $admtext['marker_values'] . ":</strong><br />" . $y_results . "<br />" : "";
					if($test_type == "mtDNA") {
						if ($ref_seq) {
							$persontext .= "<br /><strong>" . $admtext['ref_seq'] . ":</strong><br />";
						    if ($ref_seq == "rsrs")
								$persontext .= "{$admtext['rsrs']}";
						    if ($ref_seq == "rcrs")
								$persontext .= "{$admtext['rcrs']}";
							$persontext .= "<br />";
						}
						if ($hvr1_results || $hvr2_results) {
							$persontext .= "<br /><strong>" . $admtext['hvr_values'] . ":</strong><br />";
							if($hvr1_results)
								$persontext .= "{$text['hvr1']} = $hvr1_results<br />";
							if($hvr2_results)
								$persontext .= "<div>" . nl2br($text['hvr2']) . " = $hvr2_results<br /></div>";
						}
						$persontext .= $xtra_mut ? "<div><br /><strong>" . nl2br($admtext['xtra_mut']) . ":</strong><br />$xtra_mut</div>" : "";
						$persontext .= $allow_admin && $coding_reg ? "<div><br /><strong>" . nl2br($admtext['coding_reg']) . ":</strong><br />" . $coding_reg . "</div>" : "";
					}
					if($test_type == "atDNA") {
						if($shared_cMs) {
							$persontext .= "<br /><strong>{$text['shared_dna']}:</strong><br />";
							$total_shared = $admtext['shared centimorgans'] . " " . $shared_cMs;
							if ($shared_segments)
								$total_shared .= " | $shared_segments {$admtext['shared_segments']} ";
							else
								$total_shared .= " ";
							$persontext .= $admtext['shared_dna'] ." =  $total_shared <br />";
							}
						if($chromosome && $centiMorgans) {
							$segment = "{$admtext['chromosome']} $chromosome | $centiMorgans {$admtext['centiMorgans']} ";
							$persontext .= $admtext['largest_segment'] ." =  $segment <br />";
							}
						if($segment_start)
							$persontext .= $admtext['segment_start'] ." =  $segment_start <br />";
						if($segment_end)
							$persontext .= $admtext['segment_end'] ." =  $segment_end <br />";
						if($matching_SNPs)
							$persontext .= $admtext['matchingSNPs'] ." =  $matching_SNPs <br />";
						if($x_match)
							$persontext .= $admtext['xmatch'] ." =  {$admtext['yes']} <br />";
						if($relationship_range || $suggested_relationship || $actual_relationship || $related_side)
							$persontext .= "</div><br /><strong>{$admtext['relationship_section']}:</strong><br /><div>";
						if($relationship_range)
							$persontext .= $admtext['relationship_range'] ." =  $relationship_range <br />";
						if($suggested_relationship)
							$persontext .= $admtext['suggested_relationship'] ." =  $suggested_relationship <br />";
						if($actual_relationship)
							$persontext .= $admtext['actual_relationship'] ." =  $actual_relationship <br />";
						if($related_side)
							$persontext .= $admtext['related_side'] ." =  $related_side <br />";
					}
				}
				$persontext .= $dna_test['surnamesopt'] && $surnames ? "<br /><strong>" . $admtext['ancestral_surnames'] . ":</strong><br />" . $surnames . "<br />" : "";
				$persontext .= $dna_test['linksopt'] && $urls ? "<br /><strong>" . $text['relevant_links'] . ": </strong>" . $urls : "";
				$persontext .= $medialinks ? "<br /><strong>" . $admtext['medialinks'] . ": </strong>" . $medialinks : "";
				$persontext .= $dna_test['notesopt'] && $dna_notes ? "<br /><strong>" . $text['notes'] . ":</strong><br />" . $dna_notes . "<br />" : "";
				$persontext .= $allow_admin && $dna_test['admin_notes'] ? "<br /><strong>" . $admtext['admin_notes'] . ":</strong><br />" . $admin_notes . "<br />" : "";
				$persontext .= "</td>\n";
				$persontext .= "</tr>\n";
				$testnum++;
			  }
			}

			$persontext .= "</table>\n";
			$persontext .= "<br/>\n";
		}
		tng_free_result($dna_results);
?>