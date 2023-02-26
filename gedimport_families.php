<?php
function initFamily() {
	$info = array();

	$info['MARR'] = initEvent();
	$info['SLGS'] = initEvent();
	$info['DIV'] = initEvent();

	$info['HUSB'] = "";
	$info['WIFE'] = "";

	return $info;
}

function getFamilyRecord( $familyID, $prevlevel ) {
	global $link, $families_table, $children_table, $events_table, $tree, $admtext, $stdevents, $citations_table, $fciteevents, $prefix, $assoc_table;
	global $savestate, $lineinfo, $custeventlist, $notelinks_table, $stdnotes, $notecount, $custevents, $lineending, $today, $currentuser, $tngimpcfg, $branchlinks_table;

	$familyID = adjustID( $familyID, $savestate['foffset'], "F" );
	
	$prefix = "F";
	$info = initFamily(); 
	$changedate = "";
	$events = array();
	$stdnotes = array();
	$notecount = 0;
	$childorder = 1;
	$custeventctr = 0;
	$cite = array();
	$mminfo = array();
	$mmcount = 0;
	$prevlevel++;
	$assocarr = array();
	$citecount = 0;
	$living = $private = 0;

	$lineinfo = getLine( );
	while( $lineinfo['tag'] && $lineinfo['level'] >= $prevlevel ) {
		if( $lineinfo['level'] == $prevlevel ) {
			$tag = $lineinfo['tag'];
			switch( $tag ) {
				case "HUSB":
				case "WIFE":
					preg_match( "/^@(\S+)@/", $lineinfo['rest'], $matches );
					$info[$tag] = adjustID( $matches[1], $savestate['ioffset'], "I" );
					$lineinfo = getLine( );
					break;
				case "MARR":
				case "DIV":
				case "SLGS":
					if( isset( $info[$tag]['more'] ) ) {
						$custeventctr++;
						$events[$custeventctr] = initEventHolder();
						$events[$custeventctr]['TAG'] = $tag;
						$thisevent = $prefix . "_" . $tag . "_";
						//make sure it's a keeper before continuing by checking against type_tag_desc list
						if( in_array( $thisevent, $custeventlist ) )
							$events[$custeventctr]['INFO'] = getMoreInfo( $familyID, $lineinfo['level'], $tag, "" );
						else
							$lineinfo = getLine();
					}
					else {
						$info[$tag] = getMoreInfo( $familyID, $lineinfo['level'], $tag, "" );
						if( isset( $info[$tag]['NOTES'] ) ) dumpnotes( $info[$tag]['NOTES'] );
						if(!empty($info[$tag]['FACT'])) {
							if(empty( $info[$tag]['DATE'] ) && empty( $info[$tag]['PLAC'] ) ) 
								$info[$tag]['DATE'] = $info[$tag]['FACT'];
							elseif($info[$tag]['FACT'] != "Y") {
								if(empty($info[$tag]['NOTES'])) {
									$info[$tag]['NOTES'] = array();
									$notectr = 0;
								}
								else
									$notectr = count($info[$tag]['NOTES']);
								$info[$tag]['NOTES'][$notectr] = array("NOTE"=>$info[$tag]['FACT'], "TAG"=>$tag, "XNOTE"=>"");
								dumpnotes( $info[$tag]['NOTES'] );
							}
						}
						if( !empty( $info[$tag]['extra'] ) ) {
							$info[$tag]['parent'] = $tag;
							$custeventctr++;
							$events[$custeventctr] = initEventHolder();
							$events[$custeventctr]['TAG'] = $tag;
							$thisevent = $prefix . "_" . $tag . "_";
							//make sure it's a keeper before continuing by checking against type_tag_desc list
							if( in_array( $thisevent, $custeventlist ) ) {
								$events[$custeventctr]['INFO'] = $info[$tag];
								$events[$custeventctr]['INFO']['NOTES'] = "";
								$events[$custeventctr]['INFO']['SOUR'] = array();
								$events[$custeventctr]['INFO']['MEDIA'] = "";
							}
						}
						$info[$tag]['more'] = 1;
					}
					break;
					break;
				case "_LIVING":
				case "_ALIV":
				case "_FLAG":
					$living = ($lineinfo['rest'] == "Y" || $lineinfo['rest'] == "J" || $lineinfo['rest'] == "LIVING") ? 1 : 0;
					$lineinfo = getLine();
					break;
				case "_PRIVATE":
				case "_PRIV":
					$private = 1;
					$lineinfo = getLine();
					break;
				case "CHAN":
					$lineinfo = getLine();
					$changedate = addslashes( $lineinfo['rest'] );
					if( $changedate ) {
						$lineinfo = getLine();
						if( $lineinfo['tag'] == "TIME" ) {
							$changedate .= " " . preg_replace("/\./",":",$lineinfo['rest']);
							$lineinfo = getLine();
						}
						$changedate = date( "Y-m-d H:i:s", strtotime( $changedate ) );
					}
					break;
				case "CHIL":
					preg_match( "/^@(\S+)@/", $lineinfo['rest'], $matches );
					$child = adjustID( $matches[1], $savestate['ioffset'], "I" );
					$frelstr = $mrelstr = "";
					$startlevel = $lineinfo['level'];
					do {
						$lineinfo = getLine( );
						if($lineinfo['tag'] == "_FREL")
							$frelstr = ", frel=\"" . strtolower($lineinfo['rest']) . "\"";
						elseif($lineinfo['tag'] == "_MREL")
							$mrelstr = ", mrel=\"" . strtolower($lineinfo['rest']) . "\"";
					} while($lineinfo['level'] > $startlevel);
					//use these lines instead for importing gedcom files from ancestry.com, as they contain no FAMS or FAMC data
					//global $people_table;
					//$query = "UPDATE $people_table SET famc=\"$familyID\" where personID = \"$child\" AND gedcom = \"$tree\"";
					//$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
					//$query = "INSERT IGNORE INTO $children_table (gedcom, familyID, personID, relationship, parentorder, ordernum) VALUES( \"$tree\", \"$familyID\", \"$child\", \"\", \"\", $childorder )";
					//$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
					$query = "UPDATE $children_table SET ordernum=$childorder$frelstr$mrelstr WHERE personID = \"$child\" AND familyID = \"$familyID\" AND gedcom = \"$tree\"";
					$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
					$childorder++;
					break;
				case "ASSO":
					preg_match( "/^@(\S+)@/", $lineinfo['rest'], $matches );
					$thisassoc = array();
					if(substr($matches[1],0,1) == "I" || substr($matches[1],-1) == "I") {
						$countertouse = $savestate['ioffset'];
						$thisassoc['reltype'] = "I";
					}
					else {
						$countertouse = $savestate['foffset'];
						$thisassoc['reltype'] = "F";
					}
					$thisassoc['asso'] = adjustID( $matches[1], $countertouse, $thisassoc['reltype'] );
					do{
						$lineinfo = getLine();
						if( $lineinfo['tag'] == "RELA" ) $thisassoc['rela'] = $lineinfo['rest'];
					} while( $lineinfo['level'] > $prevlevel );
					array_push($assocarr,$thisassoc);
					break;
				case "SNOTE":
				case "NOTE":
					$stdnotes[$notecount]['TAG'] = "";
					preg_match( "/^@(\S+)@/", $lineinfo['rest'], $matches );
					if( !empty($matches[1]) ) {
						$stdnotes[$notecount]['XNOTE'] = adjustID( $matches[1], $savestate['noffset'], "N" );
						$stdnotes[$notecount]['NOTE'] = "";
						$lineinfo = getLine();
					}
					else {
						$stdnotes[$notecount]['XNOTE'] = "";
						$stdnotes[$notecount]['NOTE'] = (isset($stdnotes[$notecount]['NOTE']) ? $stdnotes[$notecount]['NOTE'] : "") . addslashes($lineinfo['rest']);
						$stdnotes[$notecount]['NOTE'] .= getContinued();
					}
					$ncitecount = 0;
					while( $lineinfo['level'] >= $prevlevel && $lineinfo['tag'] == "SOUR" ) {
						$stdnotes[$notecount]['SOUR'][$ncitecount] = handleSource( $familyID, $prevlevel + 1 );
						$ncitecount++;
					}
					$notecount++;
					break;
				case "OBJE":
					if( $savestate['media'] ) {
						preg_match( "/^@(\S+)@/", $lineinfo['rest'], $matches );
						$mmcount++;
						$mminfo[$mmcount] = getMoreMMInfo( $lineinfo['level'], $mmcount );
						$mminfo[$mmcount]['OBJE'] = !empty($matches[1]) ? $matches[1] : $mminfo[$mmcount]['FILE'];
						$mminfo[$mmcount]['linktype'] = "F";
					}
					else
						$lineinfo = getLine();
					break;
				case "SOUR":
					$citecount++;
					$cite[$citecount] = handleSource( $familyID, $prevlevel );
					break;
				default:
					//custom event -- should be 1 TAG
					$custeventctr++;
					$events[$custeventctr] = handleCustomEvent($familyID,$prefix,$tag);
					break;
			}
		}
		else
			$lineinfo = getLine();
	}
	//do TEMP + PLAC
	$slgsplace = trim( $info['SLGS']['TEMP'] . " " . $info['SLGS']['PLAC'] );

	//determine if living
	if( !$living && !empty($info['MARR']['DATE']) && !empty($tngimpcfg['maxmarriedage'])) {
		$marryear = $info['MARR']['DATETR'];
		$marryear = strtok($marryear,"-");
		if( date( "Y" ) - $marryear < $tngimpcfg['maxmarriedage'] ) $living = 1;
	}

	$inschangedt = $changedate ? $changedate : ($tngimpcfg['chdate'] == "1" ? "0000-00-00 00:00:00" : $today);
	$query = "INSERT IGNORE INTO $families_table (familyID, marrdate, marrdatetr, marrplace, marrtype, divdate, divdatetr, divplace, husband, wife, sealdate, sealdatetr, sealplace, changedate, gedcom, branch, living, private, changedby ) VALUES(\"$familyID\", \"" . $info['MARR']['DATE'] . "\", \"" . $info['MARR']['DATETR'] . "\", \"" . $info['MARR']['PLAC'] . "\", \"" . $info['MARR']['TYPE'] . "\", \"" . $info['DIV']['DATE'] . "\", \"" . $info['DIV']['DATETR'] . "\", \"" . $info['DIV']['PLAC'] . "\", \"" . $info['HUSB'] . "\", \"" . $info['WIFE'] . "\", \"" . $info['SLGS']['DATE'] . "\", \"" . $info['SLGS']['DATETR'] . "\", \"$slgsplace\", \"$inschangedt\", \"$tree\", \"{$savestate['branch']}\", \"$living\", \"$private\", \"$currentuser\" )";
	$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
	$success = tng_affected_rows();
	if( !$success && $savestate['del'] != "no" ) {
		if( $savestate['neweronly'] && $inschangedt ) {
			$query = "SELECT changedate FROM $families_table WHERE familyID=\"$familyID\" AND gedcom = \"$tree\"";
			$result = @tng_query( $query );
			$famrow = tng_fetch_assoc( $result );
			$goahead = $inschangedt  > $famrow['changedate'] ? 1 : 0;
			if( $result ) tng_free_result( $result );
		}
		else
			$goahead = 1;
		if( $goahead ) {
			$chdatestr = $inschangedt ? ", changedate=\"$inschangedt\"" : "";
			$branchstr = $savestate['branch'] ? ", branch=\"{$savestate['branch']}\"" : "";
			$query = "UPDATE $families_table SET marrdate=\"" . $info['MARR']['DATE'] . "\", marrdatetr=\"" . $info['MARR']['DATETR'] . "\", marrplace=\"" . $info['MARR']['PLAC'] . "\", marrtype=\"" . $info['MARR']['TYPE'] . "\", divdate=\"" . $info['DIV']['DATE'] . "\", divdatetr=\"" . $info['DIV']['DATETR'] . "\", divplace=\"" . $info['DIV']['PLAC'] . "\", husband=\"" . $info['HUSB'] . "\", wife=\"" . $info['WIFE'] . "\", sealdate=\"" . $info['SLGS']['DATE'] . "\", sealdatetr=\"" . $info['SLGS']['DATETR'] . "\", sealplace=\"$slgsplace\", changedby=\"$currentuser\" $chdatestr$branchstr WHERE familyID=\"$familyID\" AND gedcom = \"$tree\"";
			$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
			$success = 1;

			if( $savestate['del'] == "match" ) {
				//delete all custom events for this family because we didn't before
				deleteLinksOnMatch( $familyID );
			}
		}
	}
	if( $success ) {
		if( $savestate['branch'] ) {
			$query = "INSERT IGNORE INTO $branchlinks_table (branch,gedcom,persfamID) VALUES(\"{$savestate['branch']}\",\"$tree\",\"$familyID\")";
			$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
		}
		if( $custeventctr )
			saveCustEvents( $prefix, $familyID, $events, $custeventctr );

		if( isset( $cite ) )
			processCitations( $familyID, "", $cite );
		foreach( $fciteevents as $citeevent ) {
			if( isset( $info[$citeevent]['SOUR'] ) )
				processCitations( $familyID, $citeevent, $info[$citeevent]['SOUR'] );
		}

		if( $notecount ) {
			for( $notectr = 0; $notectr < $notecount; $notectr++ ) {
				if(isset($stdnotes[$notectr]))
					saveNote( $familyID, $stdnotes[$notectr]['TAG'], $stdnotes[$notectr] );
			}
		}

		//do associations
		if( count($assocarr) ) {
			foreach($assocarr as $assoc) {
				$query = "INSERT INTO $assoc_table (gedcom, personID, passocID, relationship, reltype) VALUES( \"$tree\", \"$familyID\", \"{$assoc['asso']}\", \"{$assoc['rela']}\", \"{$assoc['reltype']}\" )";
				$result = tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
			}
		}

		if( $mmcount )
			processMedia( $mmcount, $mminfo, $familyID, "" );

		//do event-based media
		foreach( $fciteevents as $stdevtype ) {
			if( isset($info[$stdevtype]['MEDIA']) && is_array($info[$stdevtype]['MEDIA']) ) {
				$eminfo = $info[$stdevtype]['MEDIA'];
				$emcount = count($eminfo);
				processMedia( $emcount, $eminfo, $familyID, $stdevtype );
			}
		}

		incrCounter( $prefix );
	}
}
?>