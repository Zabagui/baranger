<?php
$orgprefixes = explode( ",", $specpfx );
$prefixcount = 0;
define('CREMATION',1);
foreach( $orgprefixes as $prefix ) {
	$newprefix = preg_replace( "/'/", "' ", stripslashes( $prefix ) );
	$newprefix = preg_replace( "/  /", " ", $newprefix );
	$newprefixes[$prefixcount] = trim(tng_strtoupper($newprefix));
	$prefixcount++;
}
$altbirthtypes = !empty($tngconfig['altbirth']) ? explode(',',$tngconfig['altbirth']) : ['CHR'];

function initIndividual() {
	$info = array();

	$info['BIRT'] = initEvent();
	$info['ALTBE'] = initEvent();
	$info['DEAT'] = initEvent();
	$info['BURI'] = initEvent();
	$info['BAPL'] = initEvent();
	$info['CONL'] = initEvent();
	$info['INIT'] = initEvent();
	$info['ENDL'] = initEvent();
	$info['SLGC'] = initEvent();

	$info['SURN'] = "";
	$info['GIVN'] = "";
	$info['SEX'] = "";
	$info['NICK'] = "";
	$info['TITL'] = "";
	$info['NPFX'] = "";
	$info['NSFX'] = "";

	return $info;
}

function getIndividualRecord( $personID, $prevlevel ) {
	global $link, $people_table, $children_table, $families_table, $tree, $admtext, $citations_table, $assoc_table, $pciteevents;
	global $savestate, $lineinfo, $custeventlist, $custnametypes, $notelinks_table, $stdnotes, $notecount, $lineending, $branchlinks_table;
	global $today, $lnprefixes, $lnpfxnum, $specpfx, $currentuser, $newprefixes, $orgprefixes, $tngimpcfg, $pciteevents, $prefix, $burialtype;
	global $altbirthtypes, $altbirthtype, $cite, $mminfo;

	$personID = adjustID( $personID, $savestate['ioffset'], "I" );

	$prefix = "I";
	$info = initIndividual();
	$prifamily = "";
	$changedate = "";
	$burialtype = $burialcount = 0;
	$spouses = array();
	$events = array();
	$stdnotes = array();
	$mminfo = array();
	$cite = array();
	$notecount = 0;
	$mmcount = 0;
	$custeventctr = 0;
	$spousecount = 0;
	$citecount = 0;
	$parentorder = 1;
	$prevlevel++;
	$assocarr = array();
	$living = $private = 0;
	$altbirthtype = "";

	static $arrayLower = array('á','à','ä','é','è','ó','ò','ö','ú','ù','ü');
	static $arrayUpper = array('Á','À','Ä','É','È','Ó','Ò','Ö','Ú','Ù','Ü');

	$lineinfo = getLine( );
	while( $lineinfo['tag'] && $lineinfo['level'] >= $prevlevel ) {
		if( $lineinfo['level'] == $prevlevel ) {
			$tag = $lineinfo['tag'];
			$altbe = in_array($tag,$altbirthtypes) && empty($altbirthtype) ? $tag : "!!!"; //intentionally won't match anything

			switch( $tag ) {
				case "NAME":
					preg_match( "/(.*)\s*\/(.*)\/\s*(.*)/", $lineinfo['rest'], $matches );
					if( !empty($info['GIVN']) || !empty($info['SURN']) ) {
						$newname = "";
						$num_matches = count($matches);
						for( $i = 1; $i < $num_matches; $i++ ) {
							if( $matches[$i] ) {
								if( $newname ) $newname .= " ";
								$newname .= addslashes( trim($matches[$i]) );
							}
						}
						if( !$newname ) $newname = addslashes(trim($lineinfo['rest']));
						$custeventctr++;
						$events[$custeventctr] = initEventHolder();
						$events[$custeventctr]['TAG'] = "NAME";
						$thisevent = $prefix . "_NAME_";
						//make sure it's a keeper before continuing by checking against type_tag_desc list
						if( in_array( $thisevent, $custeventlist ) ) {
							$events[$custeventctr]['INFO'] = getMoreInfo( $personID, $lineinfo['level'], $tag, "" );
							$events[$custeventctr]['INFO']['FACT'] = $newname;
						}
						else
							$lineinfo = getLine();
					}
					else {
						$info['SURN'] = !empty($matches[2]) ? addslashes(trim($matches[2])) : "";
						if( $savestate['ucaselast'] ) {
							$info['SURN'] = tng_strtoupper( $info['SURN'] );
							$num_arrayLower = count($arrayLower);
							for( $i=0; $i < $num_arrayLower; $i++ ) {
								$info['SURN'] = str_replace( $arrayLower[$i], $arrayUpper[$i], $info['SURN'] );
							}
						}
						if( !empty($matches[1]) ) {
							$info['GIVN'] = addslashes(trim($matches[1]));
							if( $matches[3] ) {
								$info['NSFX'] = trim($matches[3]);
								if( substr( $info['NSFX'], 0, 1 ) == "," ) $info['NSFX'] = substr( $info['NSFX'], 1 );
								$info['NSFX'] = addslashes(trim( $info['NSFX'] ));
							}
						}
						elseif( !empty($matches[3]) )
							$info['GIVN'] = addslashes(trim($matches[3]));
						elseif( empty($matches[2]) )
							$info['GIVN'] = addslashes( trim($lineinfo['rest']) );

						$info['NAME'] = getMoreInfo( $personID, $lineinfo['level'], $tag, "" );
						if( isset( $info['NAME']['NOTES'] ) ) dumpnotes( $info['NAME']['NOTES'] );
						if( !empty($info['NAME']['NICK']) ) {
							if(!isset($info['NICK'])) 
								$info['NICK'] = "";
							elseif( !empty($info['NICK']) )
								$info['NICK'] .= ", ";
							$info['NICK'] .= removeDelims( $info['NAME']['NICK'] );
						}
						if( !empty($info['NAME']['NPFX']) )
							$info['NPFX'] = $info['NAME']['NPFX'];
						if( !empty($info['NAME']['NSFX']) )
							$info['NSFX'] = $info['NAME']['NSFX'];
						if( !empty($info['NAME']['TITL']) )
							$info['TITL'] = $info['NAME']['TITL'];
						foreach($custnametypes as $cn) {
							if( !empty($info['NAME'][$cn]) ) {
								$custeventctr++;
								$events[$custeventctr] = initEventHolder();
								$events[$custeventctr]['TAG'] = $cn;
								$thisevent = $prefix . "_{$cn}_";
								//make sure it's a keeper before continuing by checking against type_tag_desc list
								if( $savestate['allevents'] || in_array( $thisevent, $custeventlist ) ) {
									$events[$custeventctr]['INFO'] = initCustomEvent();
									$events[$custeventctr]['INFO']['FACT'] = $info['NAME'][$cn];
								}
							}
						}
					}
					break;
				case "SEX":
					$lineinfo['rest'] = strtoupper(trim($lineinfo['rest']));
				case "NPFX":
				case "NSFX":
				case "TITL":
					if( !empty( $info[$tag] ) ) {
						$custeventctr++;
						$events[$custeventctr] = initEventHolder();
						$events[$custeventctr]['TAG'] = $tag;
						$thisevent = $prefix . "_" . $tag . "_";
						$events[$custeventctr]['INFO']['FACT'] = addslashes( $lineinfo['rest'] );
					}
					else
						$info[$tag] = addslashes( $lineinfo['rest'] );
					$lineinfo = getLine();
					break;
				case "NICK":
					if( $info['NICK'] ) $info['NICK'] .= ", ";
					$info['NICK'] .= addslashes( removeDelims( $lineinfo['rest'] ) );
					$lineinfo = getLine();
					break;
				case "CREM":
					if( $burialcount ) {
						$custeventctr++;
						$events[$custeventctr] = handleCustomEvent($personID,$prefix,$tag);
						break;
					}
					else {
						$tag = "BURI";
						$burialtype = CREMATION;
					}
				case "BIRT":
				case "DEAT":
				case "BURI":
				case "BAPL":
				case "CONL":
				case "INIT":
				case "_INIT":
				case "INIL":
				case "ENDL":
				case $altbe:
					if( isset( $info[$tag]['more'] ) ) {
						$custeventctr++;
						$events[$custeventctr] = initEventHolder();
						$events[$custeventctr]['TAG'] = $tag;
						$thisevent = $prefix . "_" . $tag . "_";
						//make sure it's a keeper before continuing by checking against type_tag_desc list
						//if( in_array( $thisevent, $custeventlist ) )
						//do it anyway
						$events[$custeventctr]['INFO'] = getMoreInfo( $personID, $lineinfo['level'], $tag, "" );
						//else
						//	$lineinfo = getLine();
					}
					else {
						$info[$tag] = getMoreInfo( $personID, $lineinfo['level'], $tag, "" );
						if( isset( $info[$tag]['NOTES'] ) ) dumpnotes( $info[$tag]['NOTES'] );
						if($tag == "BIRT" && $info['BIRT']['TYPE'] == "stillborn")
							$info['BIRT']['NOTES'][] = array("NOTE"=>"stillborn");
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
						if( !empty($info[$tag]['extra']) ) {
							$info[$tag]['parent'] = $tag;
							$custeventctr++;
							$events[$custeventctr] = initEventHolder();
							$events[$custeventctr]['TAG'] = $tag;
							$thisevent = $prefix . "_" . $tag . "_";
							//make sure it's a keeper before continuing by checking against type_tag_desc list
							if( $savestate['allevents'] || in_array( $thisevent, $custeventlist ) ) {
								$events[$custeventctr]['INFO'] = $info[$tag];
								$events[$custeventctr]['INFO']['NOTES'] = "";
								$events[$custeventctr]['INFO']['SOUR'] = array();
								$events[$custeventctr]['INFO']['MEDIA'] = "";
							}
						}
						foreach($info[$tag] as $item) {
							if(!empty($item) && $item != "0000-00-00") {
								$info[$tag]['more'] = 1;
								break;
							}
						}
						if($tag == $altbe) {
							$altbirthtype = $tag;
							$info['ALTBE'] = $info[$tag];
						}
					}
					if( $tag == "BURI" ) $burialcount++;
					break;
				case "CHAN":
					$changedate = addslashes( $lineinfo['rest'] );
					$lineinfo = getLine();
					if(!$changedate) {
						$changedate = addslashes( $lineinfo['rest'] );
						if( $changedate ) {
							$lineinfo = getLine();
							if( $lineinfo['tag'] == "TIME" ) {
								$changedate .= " " . preg_replace("/\./",":",$lineinfo['rest']);
								$lineinfo = getLine();
							}
						}
					}
					if($changedate)
						$changedate = date( "Y-m-d H:i:s", strtotime( $changedate ) );
					break;
				case "FAMC":
					preg_match( "/^@(\S+)@/", $lineinfo['rest'], $matches );
					$famc = adjustID( $matches[1], $savestate['foffset'], "F" );
					if( !$prifamily )
						$prifamily = $famc;
					$lineinfo = getLine();
					$relationship = $lineinfo['tag'] == "PEDI" ? strtolower($lineinfo['rest']) : "";
					$query = "INSERT IGNORE INTO $children_table (gedcom, familyID, personID, mrel, frel, parentorder) VALUES( \"$tree\", \"$famc\", \"$personID\", \"$relationship\", \"$relationship\", \"$parentorder\" )";
					$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
					$success = tng_affected_rows();
					if( $success ) $parentorder++;
					if( $relationship ) {
						if( !$success ) {
							$query = "UPDATE $children_table SET mrel = \"$relationship\", frel = \"$relationship\" WHERE gedcom = \"$tree\" AND familyID = \"$famc\" AND personID = \"$personID\"";
							$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
						}
						$lineinfo = getLine();
					}
					if( $savestate['del'] != "no" ) {
						if( empty($info['SLGC']['DATETR']) ) $info['SLGC']['DATETR'] = "0000-00-00";
						if(!isset($slgcplace)) $slgcplace = "";
						$query = "INSERT IGNORE INTO $children_table (gedcom, familyID, personID, sealdate, sealdatetr, sealplace ) VALUES( \"$tree\", \"" . $famc . "\", \"$personID\", \"" . $info['SLGC']['DATE'] . "\", \"" . $info['SLGC']['DATETR'] . "\", \"$slgcplace\" )";
						$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
						$success = tng_affected_rows();
						if( !$success && ( $info['SLGC']['DATE'] || $slgcplace || $info['SLGC']['SOUR'] ) ) {
							$query = "UPDATE $children_table SET sealdate=\"" . $info['SLGC']['DATE'] . "\", sealdatetr=\"" . $info['SLGC']['DATETR'] . "\", sealplace=\"$slgcplace\" WHERE personID = \"$personID\" AND familyID = \"" . $famc . "\" AND gedcom = \"$tree\"";
							$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
						}
						if( isset( $info['SLGC']['SOUR'] ) ) {
							$query = "DELETE from $citations_table WHERE persfamID = \"$personID" . "::" . $info['SLGC']['FAMC'] . "\" AND gedcom = \"$tree\"";
							$result = @tng_query($query);
							processCitations( $personID . "::" . $famc, "SLGC", $info['SLGC']['SOUR'] );
						}
					}
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
				case "SLGC":
					$info['SLGC'] = getMoreInfo( $personID, $lineinfo['level'], "SLGC", "" );
					if( isset( $info['SLGC']['NOTES'] ) ) dumpnotes( $info['SLGC']['NOTES'] );

					if( $savestate['del'] != "no" ) {
						$slgcplace = trim( (isset($info['SLGC']['TEMP']) ? $info['SLGC']['TEMP'] : "") . " " . (isset($info['SLGC']['PLAC']) ? $info['SLGC']['PLAC'] : "") );
						if( $info['SLGC']['FAMC'] ) {
   							if( !$info['SLGC']['DATETR'] ) $info['SLGC']['DATETR'] = "0000-00-00";
							$query = "INSERT IGNORE INTO $children_table (gedcom, familyID, personID, sealdate, sealdatetr, sealplace ) VALUES( \"$tree\", \"" . $info['SLGC']['FAMC'] . "\", \"$personID\", \"" . $info['SLGC']['DATE'] . "\", \"" . $info['SLGC']['DATETR'] . "\", \"$slgcplace\" )";
							$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
							$success = tng_affected_rows();
						}
						else
							$success = 0;
						if( !$success && ( $info['SLGC']['DATE'] || $slgcplace || $info['SLGC']['SOUR'] ) ) {
							$query = "UPDATE $children_table SET sealdate=\"" . $info['SLGC']['DATE'] . "\", sealdatetr=\"" . $info['SLGC']['DATETR'] . "\", sealplace=\"$slgcplace\" WHERE personID = \"$personID\" AND familyID = \"" . $info['SLGC']['FAMC'] . "\" AND gedcom = \"$tree\"";
							$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
						}
						if( isset( $info['SLGC']['SOUR'] ) ) {
							$query = "DELETE from $citations_table WHERE persfamID = \"$personID" . "::" . $info['SLGC']['FAMC'] . "\" AND gedcom = \"$tree\"";
							$result = @tng_query($query);
							processCitations( $personID . "::" . $info['SLGC']['FAMC'], "SLGC", $info['SLGC']['SOUR'] );
						}
					}
					break;
				case "FAMS":
					preg_match( "/^@(\S+)@/", $lineinfo['rest'], $matches );
					$spousecount++;
					$spouses[$spousecount] = adjustID( $matches[1], $savestate['foffset'], "F" );
					$lineinfo = getLine();
					break;
				case "IMAGE":
				case "OBJE":
				case "_PHOTO":
					if( $savestate['media'] ) {
						preg_match( "/^@(\S+)@/", $lineinfo['rest'], $matches );
						$mmcount++;
						$mminfo[$mmcount] = getMoreMMInfo( $lineinfo['level'], $mmcount );
						$mminfo[$mmcount]['OBJE'] = !empty($matches[1]) ? $matches[1] : $mminfo[$mmcount]['FILE'];
						$mminfo[$mmcount]['linktype'] = "I";
						if($tag == "_PHOTO")
							$mminfo[$mmcount]['defphoto'] = 1;
					}
					else
						$lineinfo = getLine();
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
					while( $lineinfo['level'] >= $prevlevel + 1 && $lineinfo['tag'] == "SOUR" ) {
						$stdnotes[$notecount]['SOUR'][$ncitecount] = handleSource( $personID, $prevlevel + 1 );
						$ncitecount++;
					}
					if(!$stdnotes[$notecount]['NOTE'] && !$stdnotes[$notecount]['XNOTE']) {
						unset($stdnotes[$notecount]);
					}
					else
						$notecount++;
					break;
				case "SOUR":
					$citecount++;
					$cite[$citecount] = handleSource( $personID, $prevlevel );
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
				case "_FLGS":
					$lineinfo = getLine();
					if($lineinfo['tag'] == "__LIVING") {
						$living = $lineinfo['rest'] == "Living" ? "1" : 0;
						$lineinfo = getLine();
					}
					elseif($lineinfo['tag'] == "__PRIVATE") {
						$private = $lineinfo['rest'] == "Private" ? "1" : 0;
						$lineinfo = getLine();
					}
					elseif(substr($lineinfo['tag'],0,6) == "__FLAG") {
						do {
							$custeventctr++;
							$events[$custeventctr] = handleCustomEvent($personID,$prefix,$lineinfo['tag']);
						} while(substr($lineinfo['tag'],0,6) == "__FLAG");
					}
					else
						$lineinfo = getLine();
					break;
				default:
					//custom event -- should be 1 TAG
					$custeventctr++;
					$events[$custeventctr] = handleCustomEvent($personID,$prefix,$tag);
					break;
			}
		}
		else
			$lineinfo = getLine();
	}
	//do TEMP + PLAC
	$meta = metaphone( $info['SURN'] );
	$baplplace = trim( $info['BAPL']['TEMP'] . " " . $info['BAPL']['PLAC'] );
	$confplace = trim( $info['CONL']['TEMP'] . " " . $info['CONL']['PLAC'] );
	$initplace = trim( $info['INIT']['TEMP'] . " " . $info['INIT']['PLAC'] );
	$endlplace = trim( $info['ENDL']['TEMP'] . " " . $info['ENDL']['PLAC'] );
	$slgcplace = trim( $info['SLGC']['TEMP'] . " " . $info['SLGC']['PLAC'] );
	if( isset($info['TITL']) && isset($info['NSFX']) && $info['TITL'] == $info['NSFX'] )
		$info['TITL'] = "";

	//determine if living
	if( !$living && empty($info['DEAT']['more']) && empty($info['BURI']['more']) && ((isset($info['BIRT']['TYPE']) ? $info['BIRT']['TYPE'] : "") != "stillborn")) {
		if( !empty($info['BIRT']['DATE']) || !empty($info['ALTBE']['DATE'])) {
			$birthyear = !empty($info['BIRT']['DATE']) ? $info['BIRT']['DATETR'] : $info['ALTBE']['DATETR'];
			$birthyear = strtok($birthyear,"-");
			if( date( "Y" ) - $birthyear < $tngimpcfg['maxlivingage'] ) $living = 1;
		}
		elseif( $tngimpcfg['livingreqbirth'] ) $living = 1;
	}
	if( !$savestate['norecalc'] )
		$livingstrupd = ", living=\"$living\"";
	else
		$livingstrupd = "";

	//determine if private or living (if we have a buried date but no death date, we'll assume it's been long enough)
	if(!empty($info['DEAT']['DATE']) && (!empty($tngimpcfg['maxprivyrs']) || !empty($tngimpcfg['maxdecdyrs']))) {
		$deathyear = strtok($info['DEAT']['DATETR'],"-");
		if($tngimpcfg['maxprivyrs'] && !$private) {
			if( strtotime( "-{$tngimpcfg['maxprivyrs']} years" ) < strtotime($info['DEAT']['DATETR']) ) $private = 1;
		}
		if($tngimpcfg['maxdecdyrs'] && !$living) {
			if( strtotime( "-{$tngimpcfg['maxdecdyrs']} years" ) < strtotime($info['DEAT']['DATETR']) ) $living = 1;
		}
	}

	//process surname prefix if necessary
	//if( $info['NAME']['SPFX'] && $lnprefixes) {
		//$info['lnprefix'] = $info['NAME']['SPFX'];
		//$gotit = 1;
	//}
	//else {
		$gotit = 0;
		if( $info['SURN'] && $lnprefixes ) {
			$lastname = preg_replace( "/'/", "' ", stripslashes( $info['SURN'] ) );
			$lastname = preg_replace( "/  /", " ", $lastname );
			if( $specpfx ) {
				$fullprefix = tng_strtoupper($lastname);
				$lastspace = strrpos( $fullprefix, " " );
				$fullsurname = "";
				while( !$gotit && $lastspace ) {
					$fullsurname = substr( $lastname, $lastspace + 1 );
					$fullprefix = substr( $fullprefix, 0, $lastspace );
					if( in_array( $fullprefix, $newprefixes ) ) {
						$gotit = 1;
						$count = 0;
						foreach( $newprefixes as $newprefix ) {
							if( $fullprefix == $newprefix ) {
								$fullprefix = $orgprefixes[$count];
								break;
							}
							else
								$count++;
						}
					}
					else
						$lastspace = strrpos( $fullprefix, " " );
				}
			}
			if( !$gotit && $lnpfxnum ) {
				$pfxcount = 0;
				$parts = explode( " ", $lastname );
				$numparts = count( $parts );
				if( $numparts >= 2 ) {
					$fullprefix = $fullsurname = "";
					foreach( $parts as $part ) {
						if( !$gotit ) {
							$fullprefix .= $fullprefix ? " $part" : $part;
							$pfxcount++;
							if( $numparts == $pfxcount + 1 || $lnpfxnum == $pfxcount ) {
								$gotit = 1;
							}
						}
						else
							$fullsurname .= $fullsurname ? " $part" : $part;
					}
				}
			}
		}
	//}
	if( $gotit ) {
		$info['lnprefix'] = addslashes( $fullprefix );
		$info['SURN'] = addslashes( trim( $fullsurname ) );
	}
	else
		$info['lnprefix'] = "";

	if( empty($info['SEX']) ) $info['SEX'] = "U";
	$inschangedt = $changedate ? $changedate : ($tngimpcfg['chdate'] == "1" ? "0000-00-00 00:00:00" : $today);
	$query = "INSERT IGNORE INTO $people_table (personID, lastname, lnprefix, firstname, living, private, sex, birthdate, birthdatetr, birthplace,
		altbirthtype, altbirthdate, altbirthdatetr, altbirthplace, deathdate, deathdatetr, deathplace, burialdate, burialdatetr, burialplace, burialtype, nickname, title, prefix, suffix,
		baptdate, baptdatetr, baptplace, confdate, confdatetr, confplace, initdate, initdatetr, initplace, endldate, endldatetr, endlplace, changedate, famc, metaphone, gedcom, branch, changedby, edituser, edittime)
		VALUES(\"$personID\", \"{$info['SURN']}\", \"{$info['lnprefix']}\", \"{$info['GIVN']}\", \"$living\", \"$private\", \"{$info['SEX']}\", \"" . $info['BIRT']['DATE'] . "\", \"" . $info['BIRT']['DATETR'] . "\",
		\"" . $info['BIRT']['PLAC'] . "\", \"" . $altbirthtype . "\", \"" . $info['ALTBE']['DATE'] . "\", \"" . $info['ALTBE']['DATETR'] . "\", \"" . $info['ALTBE']['PLAC'] . "\",
		\"" . $info['DEAT']['DATE'] . "\", \"" . $info['DEAT']['DATETR'] . "\", \"" . $info['DEAT']['PLAC'] . "\", \"" . $info['BURI']['DATE'] . "\", \"" . $info['BURI']['DATETR'] . "\", \"" . $info['BURI']['PLAC'] . "\", $burialtype,
		\"{$info['NICK']}\", \"{$info['TITL']}\", \"{$info['NPFX']}\", \"{$info['NSFX']}\", \"" . $info['BAPL']['DATE'] . "\", \"" . $info['BAPL']['DATETR'] . "\", \"$baplplace\",
		\"" . $info['CONL']['DATE'] . "\", \"" . $info['CONL']['DATETR'] . "\", \"$confplace\",\"" . $info['INIT']['DATE'] . "\", \"" . $info['INIT']['DATETR'] . "\", \"$initplace\",
		\"" . $info['ENDL']['DATE'] . "\", \"" . $info['ENDL']['DATETR'] . "\", \"$endlplace\", \"$inschangedt\", \"$prifamily\", \"$meta\", \"$tree\", \"{$savestate['branch']}\", \"$currentuser\", \"\", \"0\" )";
	$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
	$success = tng_affected_rows();
	if( !$success && $savestate['del'] != "no" ) {
		if($inschangedt == "0000-00-00 00:00:00")
			$inschangedt = "";
		if( $savestate['neweronly'] && $inschangedt ) {
			$query = "SELECT changedate FROM $people_table WHERE personID=\"$personID\" AND gedcom = \"$tree\"";
			$result = @tng_query( $query );
			$indrow = tng_fetch_assoc( $result );
			$goahead = $inschangedt  > $indrow['changedate'] ? 1 : 0;
			if( $result ) tng_free_result( $result );
		}
		else
			$goahead = 1;
		if( $goahead ) {
			$chdatestr = $inschangedt ? ", changedate=\"$inschangedt\"" : "";
			$branchstr = $savestate['branch'] ? ", branch=\"{$savestate['branch']}\"" : "";
			$query = "UPDATE $people_table SET firstname=\"{$info['GIVN']}\", lnprefix=\"{$info['lnprefix']}\", lastname=\"{$info['SURN']}\"" . $livingstrupd . ",
				nickname=\"{$info['NICK']}\", prefix=\"{$info['NPFX']}\", suffix=\"{$info['NSFX']}\", title=\"{$info['TITL']}\",
				birthdate=\"" . $info['BIRT']['DATE'] . "\", birthdatetr=\"" . $info['BIRT']['DATETR'] . "\", birthplace=\"" . $info['BIRT']['PLAC'] . "\",
				sex=\"{$info['SEX']}\", altbirthtype=\"" . $altbirthtype . "\", altbirthdate=\"" . $info['ALTBE']['DATE'] . "\", altbirthdatetr=\"" . $info['ALTBE']['DATETR'] . "\", altbirthplace=\"" . $info['ALTBE']['PLAC'] . "\",
				deathdate=\"" . $info['DEAT']['DATE'] . "\", deathdatetr=\"" . $info['DEAT']['DATETR'] . "\", deathplace=\"" . $info['DEAT']['PLAC'] . "\",
				burialdate=\"" . $info['BURI']['DATE'] . "\", burialdatetr=\"" . $info['BURI']['DATETR'] . "\", burialplace=\"" . $info['BURI']['PLAC'] . "\",
				baptdate=\"" . $info['BAPL']['DATE'] . "\", baptdatetr=\"" . $info['BAPL']['DATETR'] . "\", baptplace=\"$baplplace\",
				confdate=\"" . $info['CONL']['DATE'] . "\", confdatetr=\"" . $info['CONL']['DATETR'] . "\", confplace=\"$confplace\",
				initdate=\"" . $info['INIT']['DATE'] . "\", initdatetr=\"" . $info['INIT']['DATETR'] . "\", initplace=\"$initplace\",
				endldate=\"" . $info['ENDL']['DATE'] . "\", endldatetr=\"" . $info['ENDL']['DATETR'] . "\", endlplace=\"$endlplace\",
				changedby=\"$currentuser\" $chdatestr$branchstr";
			if( $prifamily ) $query .= ", famc=\"$prifamily\"";
			$query .= ", metaphone=\"$meta\" WHERE personID=\"$personID\" AND gedcom = \"$tree\"";
			$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
			$success = 1;
	
			if( $savestate['del'] == "match" ) {
				//delete all custom events & notelinks for this person because we didn't before
				deleteLinksOnMatch( $personID );
			}
		}
	}
	if( $success ) {
		if( $savestate['branch'] ) {
			$query = "INSERT IGNORE INTO $branchlinks_table (branch,gedcom,persfamID) VALUES(\"{$savestate['branch']}\",\"$tree\",\"$personID\")";
			$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
		}
		if( $custeventctr )
			saveCustEvents( $prefix, $personID, $events, $custeventctr );
		if( $notecount ) {
			for( $notectr = 0; $notectr < $notecount; $notectr++ ) {
				if(isset($stdnotes[$notectr]))
					saveNote( $personID, $stdnotes[$notectr]['TAG'], $stdnotes[$notectr] );
			}
		}

		//do associations
		if( count($assocarr) ) {
			foreach($assocarr as $assoc) {
				$asso = !empty($assoc['asso']) ? $assoc['asso'] : "";
				$rela = !empty($assoc['rela']) ? $assoc['rela'] : "";
				$reltype = !empty($assoc['reltype']) ? $assoc['reltype'] : "";
				$query = "INSERT INTO $assoc_table (gedcom, personID, passocID, relationship, reltype) VALUES( \"$tree\", \"$personID\", \"$asso\", \"$rela\", \"$reltype\" )";
				$result = tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
			}
		}

		//do citations
		if( isset( $cite ) )
			processCitations( $personID, "", $cite );
		foreach( $pciteevents as $citeevent ) {
			if( isset( $info[$citeevent]['SOUR'] ) ) {
				$tag = $citeevent == "ALTBE" ? $altbirthtype : $citeevent;
				processCitations( $personID, $tag, $info[$citeevent]['SOUR'] );
			}
		}

		if( $spousecount ) {
			for( $spousectr = 1; $spousectr <= $spousecount; $spousectr++ ) {
				$familyID = $spouses[$spousectr];
				if( !$living || $savestate['norecalc'] )
					$famlivingstr = "";
				else
					$famlivingstr = "living = \"1\"";
				if( $info['SEX'] == "M" ) {
					$uspousestr = "husband = \"$personID\", husborder = \"$spousectr\"";
					$query = "INSERT IGNORE INTO $families_table (familyID, husborder, living, private, gedcom, changedby) VALUES(\"$familyID\", \"$spousectr\", \"$living\", \"$private\", \"$tree\", \"$currentuser\" )";
				}
				elseif( $info['SEX'] == "F" ) {
					$uspousestr = "wife = \"$personID\", wifeorder = \"$spousectr\"";
					$query = "INSERT IGNORE INTO $families_table (familyID, wifeorder, living, private, gedcom, changedby) VALUES(\"$familyID\", \"$spousectr\", \"$living\", \"$private\", \"$tree\", \"$currentuser\" )";
				}
				else {
					$uspousestr = "";
					$query = "INSERT IGNORE INTO $families_table (familyID, gedcom, changedby) VALUES(\"$familyID\", \"$tree\", \"$currentuser\" )";
				}
				$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
				$success = tng_affected_rows();
				if( !$success && ($uspousestr || $famlivingstr ) && $savestate['del'] != "no" ) {
					if( $uspousestr && $famlivingstr ) $famlivingstr .= ",";
					$query= "UPDATE $families_table SET $famlivingstr $uspousestr, changedby=\"$currentuser\" WHERE familyID=\"$familyID\" AND gedcom = \"$tree\"";
					$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
				}
			}
		}
		if( $mmcount )
			processMedia( $mmcount, $mminfo, $personID, "" );

		//do event-based media
		foreach( $pciteevents as $stdevtype ) {
			$tag = $stdevtype == "ALTBE" ? $altbirthtype : $stdevtype;
			if( isset($info[$stdevtype]['MEDIA']) && is_array($info[$stdevtype]['MEDIA']) ) {
				$eminfo = $info[$stdevtype]['MEDIA'];
				$emcount = count($eminfo);
				processMedia( $emcount, $eminfo, $personID, $tag );
			}
		}

		incrCounter( $prefix );
	}
}
?>