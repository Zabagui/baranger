<?php
//set trim_it to a non-zero value to use this feature
$trim_it = 0;
//for individuals:
$trimsize['I'] = 0;
//for families:
$trimsize['F'] = 0;
//for sources:
$trimsize['S'] = 0;

$max_note_length = 65500;

function getLine ( ) {
	global $fp, $lineending, $saveimport, $savestate;
	
	$lineinfo = array();
	if( $line = ltrim( @fgets($fp, 1024 ) ) ) {
		if( $saveimport) $savestate['len'] = strlen($line);
		$patterns = array(  "/®®.*¯¯/", "/®®.*/", "/.*¯¯/", "/@@/" );
		$replacements = array( "", "", "", "@");
		$line = preg_replace( $patterns, $replacements, $line );
		
		preg_match( "/^(\d+)\s+(\S+) ?(.*)$/", $line, $matches );

		$lineinfo['level'] = isset($matches[1]) ? trim($matches[1]) : "";
		$lineinfo['tag'] = isset($matches[2]) ? trim($matches[2]) : "";
		$lineinfo['rest'] = isset($matches[3]) ? trim($matches[3], $lineending ) : "";
		//echo "$line: -$lineinfo['long']- -$lineinfo['tag']- -$lineinfo['rest']-<br/>\n";
	}
	else {
		$lineinfo['level'] = "";
		$lineinfo['tag'] = "";
		$lineinfo['rest'] = "";
	}
	if( !$lineinfo['tag'] && !@feof( $fp ) ) $lineinfo = getLine();

	return $lineinfo;
}

function adjustID( $ID, $offset, $type ) {
	global $trim_it, $trimsize, $tngimpcfg, $tngconfig;

	preg_match( "/^(\D*)(\d*)(\D*)/", $ID, $matches );
	$prefix = $matches[1];
	$numericpart = $matches[2];
	$suffix = $matches[3];

	if(isset($tngimpcfg['coerce']) && $tngimpcfg['coerce'] ) {
		switch($type) {
			case "I":
				$prefix = $tngconfig['personprefix'];
				$suffix = $tngconfig['personsuffix'];
				break;
			case "F":
				$prefix = $tngconfig['familyprefix'];
				$suffix = $tngconfig['familysuffix'];
				break;
			case "S":
				$prefix = $tngconfig['sourceprefix'];
				$suffix = $tngconfig['sourcesuffix'];
				break;
			case "R":
				$prefix = $tngconfig['repoprefix'];
				$suffix = $tngconfig['reposuffix'];
				break;
			case "N":
				$prefix = $tngconfig['noteprefix'];
				$suffix = $tngconfig['notesuffix'];
				break;
		}
	}

	if( $offset || $trim_it ) {
		//find first numeric in ID
		//add offset, make right length + add prefix
		$thistrim = (!empty($prefix) && $trimsize[$prefix]) ? $trimsize[$prefix] : strlen( $numericpart );
		$newID = $prefix . str_pad( $numericpart + $offset, $thistrim, "0", STR_PAD_LEFT ) . $suffix;
	}
	else
		$newID = $prefix . $numericpart . $suffix;

	return $newID;
}

function getMoreInfo( $persfamID, $prevlevel, $prevtag, $prevtype ) {
	global $lineinfo, $tree, $admtext, $savestate, $address_table, $prefix, $burialtype;
	
	$moreinfo = initCustomEvent();

	if($prevtag == "ALIA" || $prevtag == "AKA" || $prevtag == "NAME")
		$moreinfo['FACT'] = addslashes(removeDelims($lineinfo['rest']));
	else
		$moreinfo['FACT'] = addslashes($lineinfo['rest']);
	if( $lineinfo['tag'] == "ADDR" ) {
		$address = handleAddress($lineinfo['level'], 0);
		$moreinfo['extra'] = 1;
	}
	elseif($prevtag == "EVEN")
		$lineinfo['level']++;
	else
		$moreinfo['FACT'] .= getContinued();

	$moreinfo['TYPE'] = "";
	$moreinfo['parent'] = "";
	$prevlevel++;
	$citecnt = 0;
	$notecnt = 0;
	$mminfo = array();
	$mmcount = 0;

	while( $lineinfo['level'] >= $prevlevel ) {
		if( $lineinfo['level'] == $prevlevel ) {
			$tag = $lineinfo['tag'];
			switch( $tag ) {
				case "STAT":
				case "_DATE":
				case "DATE":
					$moreinfo['DATE'] = addslashes( trim($lineinfo['rest']) );
					$moreinfo['DATETR'] = convertDate( $moreinfo['DATE'] );
					$lineinfo = getLine();
					break;
				case "SDATE":
					if(empty($moreinfo['DATE']))
						$moreinfo['DATE'] = addslashes( trim($lineinfo['rest']) );
					$moreinfo['DATETR'] = convertDate( $moreinfo['DATE'] );
					$lineinfo = getLine();
					break;
				case "_AKA":
				case "_ALIA":
					$tag = "ALIA";
				case "ALIA": case "_ADPN": case "_HEBN": case "_CENS": case "_MARNM": case "_FRKA": case "_RELN": case "_CALL": case "_OTHN":
				case "NPFX":
				case "TYPE":
				case "NSFX":
				case "NICK":
				case "TITL":
				case "SPFX":
					$moreinfo[$tag] = addslashes( $lineinfo['rest'] );
					$lineinfo = getLine();
					break;
				case "AGE":
				case "AGNC":
				case "CAUS":
					$moreinfo[$tag] = addslashes( $lineinfo['rest'] );
					$moreinfo['extra'] = 1;
					$lineinfo = getLine();
					break;
				case "ADDR":
					$address = handleAddress($lineinfo['level'], 1);
					$moreinfo['extra'] = 1;
					break;
				case "ADR1": case "ADR2": case "CITY": case "STAE": case "POST": case "CTRY": case "WWW": case "PHON": case "EMAIL":
					if(!isset($address))
						$address = initAddress();
					$address[$tag] = addslashes( $lineinfo['rest'] ) . getContinued();
					break;
				case "PLAC":
				case "TEMP":
					$moreinfo['PLAC'] = addslashes( $lineinfo['rest'] );
					//if your gedcom file is splitting the burial place name and putting part of it on the BURI line, uncomment the next 3 lines to fix that
					//if($prevtag == "BURI" && $moreinfo['FACT']) {
					//	$moreinfo['PLAC'] = $moreinfo['PLAC'] ? $moreinfo['FACT'] . ", " . $moreinfo['PLAC'] : $moreinfo['PLAC'];
					//}
					getPlaceRecord( $lineinfo['rest'], $lineinfo['level'] );
					//savePlace( $moreinfo['PLAC'] );
					//$lineinfo = getLine();
					break;
				case "FAMC":
					preg_match( "/^@(\S+)@/", $lineinfo['rest'], $matches );
					$moreinfo[$tag] = adjustID( $matches[1], $savestate['foffset'], "F" );
					$lineinfo = getLine();
					break;
				//case "TEXT":
				case "SNOTE":
				case "NOTE":
				case "_TEXT":
					//$notecount++;
					if( !$notecnt ) $moreinfo['NOTES'] = array();
					$notecnt++;

					$moreinfo['NOTES'][$notecnt] = array();
					preg_match( "/^@(\S+)@/", $lineinfo['rest'], $matches );
					if( !empty($matches[1]) ) {
						$moreinfo['NOTES'][$notecnt]['XNOTE'] = adjustID( $matches[1], $savestate['noffset'], "N" );
						$lineinfo = getLine();
					}
					else {
						$moreinfo['NOTES'][$notecnt]['NOTE'] = addslashes($lineinfo['rest']);
						$moreinfo['NOTES'][$notecnt]['XNOTE'] = "";
						$moreinfo['NOTES'][$notecnt]['NOTE'] .= getContinued();
					}
					$moreinfo['NOTES'][$notecnt]['TAG'] = $prevtag;
					$ncitecount = 0;
					while( $lineinfo['level'] >= $prevlevel + 1 && $lineinfo['tag'] == "SOUR" ) {
						$ncitecount++;
						$moreinfo['NOTES'][$notecnt]['SOUR'][$ncitecount] = handleSource( $persfamID, $prevlevel + 1 );
					}
					break;
				case "SOUR":
					if( !$citecnt ) $moreinfo['SOUR'] = array();
					$citecnt++;
					$moreinfo['SOUR'][$citecnt] = handleSource( $persfamID, $prevlevel );
					break;
				case "_SHAR":
					$share = new stdClass();
					if(preg_match( "/^@(\S+)@/", $lineinfo['rest'], $matches )) {
						$share->id = $matches[1];
						$lineinfo = getLine();
						while( $lineinfo['level'] >= $prevlevel + 1 ) {
							$note = array();
							switch($lineinfo['tag']) {
								case "ROLE":
									$note['NOTE'] = $admtext['role'] . ": " . addslashes($lineinfo['rest']);
									$share->notes[] = $note;
									$lineinfo = getLine();
									break;
								case "NOTE":
									$note['NOTE'] = addslashes($lineinfo['rest']);
									$note['NOTE'] .= getContinued();
									$share->notes[] = $note;
									break;
								default:
									$lineinfo = getLine();
									break;
							}
						}
						$moreinfo['SHARES'][] = $share;
					}
					else {
						$lineinfo = getLine();
					}
					break;
				case "IMAGE":
				case "OBJE":
					if( $savestate['media'] ) {
						preg_match( "/^@(\S+)@/", $lineinfo['rest'], $matches );
						$mmcount++;
						$mminfo[$mmcount] = getMoreMMInfo( $lineinfo['level'], $mmcount );
						$mminfo[$mmcount]['OBJE'] = !empty($matches[1]) ? $matches[1] : $mminfo[$mmcount]['FILE'];
						$mminfo[$mmcount]['linktype'] = $prefix;
					}
					else
						$lineinfo = getLine();
					break;
				case "CREM":
					if($lineinfo['rest'] == "Y")
						$burialtype = CREMATION;
					$lineinfo = getLine();
					break;
				default:
					//if( $moreinfo['FACT'] ) $moreinfo['FACT'] .= ", ";
					//$moreinfo['FACT'] .= addslashes( removeDelims( $lineinfo['rest'] ) );
					$lineinfo = getLine();
					break;
			}
		}
		else
			$lineinfo = getLine();
	}

	if( $mmcount ) {
		$moreinfo['MEDIA'] = $mminfo;
	}
	if( isset($address) && is_array( $address ) ) {
		$query = "INSERT INTO $address_table (gedcom, address1, address2, city, state, zip, country, www, email, phone) VALUES(\"$tree\", \"{$address['ADR1']}\", \"{$address['ADR2']}\", \"{$address['CITY']}\", \"{$address['STAE']}\", \"{$address['POST']}\",  \"{$address['CTRY']}\", \"{$address['WWW']}\", \"{$address['EMAIL']}\", \"{$address['PHON']}\")";
		$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
		$moreinfo['ADDR'] = tng_insert_id();
		if( $moreinfo['FACT'] == $address['ADR1'] ) $moreinfo['FACT'] = "";
	}
	return $moreinfo;
}

function handleCustomEvent($id,$prefix,$tag) {
	global $lineinfo, $custeventlist, $savestate;

	$event = initEventHolder();
	$event['TAG'] = $tag;
	$needmore = 1;
	$savelevel = $lineinfo['level'];
	if( $tag == "EVEN" ) {
		$fact = addslashes($lineinfo['rest'] . getContinued());
		$needfact = 1;
		//next one must be TYPE
		//$lineinfo = getLine();
		if($lineinfo['tag'] == "TYPE") {
			$event['TYPE'] = trim(addslashes( $lineinfo['rest'] ));
		}
		else {
			if($fact)
				$event['TYPE'] = $fact;
			else {
				do {
					$lineinfo = getLine();
				} while($lineinfo['tag'] != "TYPE" && $lineinfo['level'] > $savelevel);
				if($lineinfo['tag'] == "TYPE")
					$event['TYPE'] = trim(addslashes( $lineinfo['rest'] ));
				else
					$event['TYPE'] = "";
			}
		}
		if($event['TYPE'])
			$lineinfo = getLine();
		if($lineinfo['level'] <= $savelevel)
			$needmore = 0;
		else
			$lineinfo['level']--;
	}
	else {
		$fact = "";
		$needfact = 0;
	}
	$thisevent = strtoupper($prefix . "_" . $tag . "_" . (isset($event['TYPE']) ? $event['TYPE'] : ""));
	//make sure it's a keeper before continuing by checking against type_tag_desc list
	if( $savestate['allevents'] || in_array( $thisevent, $custeventlist ) ) {
		if($needmore)
			$event['INFO'] = getMoreInfo( $id, $lineinfo['level'], $tag, (isset($event['TYPE']) ? $event['TYPE'] : "") );
		if( $needfact ) $event['INFO']['FACT'] = $fact;
	}
	elseif($needmore)
		$lineinfo = getLine();

	return $event;
}

function initAddress() {
	$address = array();

	$address['ADR1'] = "";
	$address['ADR2'] = "";
	$address['CITY'] = "";
	$address['STAE'] = "";
	$address['POST'] = "";
	$address['CTRY'] = "";
	$address['WWW'] = "";
	$address['EMAIL'] = "";
	$address['PHON'] = "";

	return $address;
}

function handleAddress($prevlevel, $flag) {
	global $lineinfo;

	$address = initAddress();
	$address['ADR1'] = addslashes( $lineinfo['rest'] );
	$gotaddr = $address['ADR1'] ? 1 : 0;
	$prevlevel++;

	$notdone = 1;
	$addr[0] = "ADR1";
	$addr[1] = "CITY";
	$addr[2] = "STAE";
	$addr[3] = "POST";
	$addr[4] = "CTRY";
	$counter = 0;

	while( $notdone ) {
		$lineinfo = getLine( );
		if ( $lineinfo['tag'] == "CONC" ) {
			$addrtag = $addr[$counter];
			$address[$addrtag] = (isset($address[$addrtag]) ? $address[$addrtag] : "") . addslashes( $lineinfo['rest'] );
		}
		elseif ( $lineinfo['tag'] == "CONT" ) {
			if( $counter < 4 ) $counter++;
			$addrtag = $addr[$counter];
			$address[$addrtag] = (isset($address[$addrtag]) ? $address[$addrtag] : "") . addslashes( $lineinfo['rest'] );
		}
		else
			$notdone = 0;
	}
	if( $flag ) {
		while( $lineinfo['level'] >= $prevlevel ) {
			if( $lineinfo['level'] == $prevlevel ) {
				$tag = $lineinfo['tag'];
				switch( $tag ) {
					case "ADR1": case "ADR2": case "CITY": case "STAE": case "POST": case "CTRY": case "WWW": case "PHON": case "EMAIL":
						$address[$tag] = addslashes( $lineinfo['rest'] ) . getContinued();
						if($address[$tag]) $gotaddr = 1;
						break;
					default:
						$lineinfo = getLine();
						break;
				}
			}
			else
				$lineinfo = getLine();
		}
	}
	return $gotaddr ? $address : null;
}

function getContinued( ) {
	global $lineinfo;
	
	$continued = "";
	$notdone = 1;
	
	while( $notdone ) {
		$lineinfo = getLine( );
		if ( $lineinfo['tag'] == "CONC" ) { $continued .= addslashes($lineinfo['rest']); }
		elseif ( $lineinfo['tag'] == "CONT" ) { 
			//if( $continued ) $lineinfo['rest'] = "\n$lineinfo['rest']";
			$continued .= addslashes( "\n" . $lineinfo['rest'] );
		}
		else 
			$notdone = 0;
	}
	return $continued;
}

function deleteLinksOnMatch( $entityID ) {
	global $tree, $events_table, $notelinks_table, $citations_table, $xnotes_table, $admtext, $address_table, $medialinks_table, $assoc_table;
	
	$query = "SELECT addressID from $events_table WHERE persfamID = \"$entityID\" AND gedcom = \"$tree\"";
	$result = @tng_query($query);
	while( $row = tng_fetch_assoc( $result ) ) {
		$query = "DELETE from $address_table WHERE addressID = \"{$row['addressID']}\"";
		$result2 = @tng_query($query);
	}
	tng_free_result( $result );

	$query = "DELETE from $events_table WHERE gedcom = \"$tree\" AND persfamID = \"$entityID\"";
	$result = @tng_query($query);

	$query = "DELETE from $assoc_table WHERE personID = \"$entityID\" AND gedcom = \"$tree\"";
	$result = @tng_query($query);

	//we won't be able to match media links for custom events, since the custom event IDs will be renumbered, so delete the media links and start again
	//$query = "DELETE from $medialinks_table WHERE gedcom = \"$tree\" AND personID = \"$entityID\" AND eventID != '' AND eventID REGEXP ('['0-9']')";
	//$result = tng_query($query);

	$query = "SELECT xnoteID from $notelinks_table WHERE persfamID = \"$entityID\" AND gedcom = \"$tree\"";
	$result = @tng_query($query);
	while( $row = tng_fetch_assoc( $result ) ) {
		$query = "DELETE from $xnotes_table WHERE ID = \"{$row['xnoteID']}\"";
		$result2 = @tng_query($query);
	}
	tng_free_result( $result );
	$query = "DELETE from $notelinks_table WHERE persfamID = \"$entityID\" AND gedcom = \"$tree\"";
	$result = @tng_query($query);
	$query = "DELETE from $citations_table WHERE persfamID = \"$entityID\" AND gedcom = \"$tree\"";
	$result = @tng_query($query);
}

function getPlaceRecord($place, $prevlevel) {
	global $savestate, $tree, $admtext, $lineinfo, $places_table, $link, $tngconfig, $currentuser;

	$place = addslashes($place);
	$note = $namc = "";
	$map = array();
	$map['long'] = "";
	$map['lati'] = "";
	$map['zoom'] = $map['placelevel'] = "0";
	$mminfo = array();
	$mmcount = 0;
	$changedate = "";
	$prevlevel++;

	$lineinfo = getLine( );
	while( $lineinfo['tag'] && $lineinfo['level'] >= $prevlevel ) {
		if( $lineinfo['level'] == $prevlevel ) {
			$tag = $lineinfo['tag'];
			switch( $tag ) {
				case "PLAC":
				case "_PLAC":
				case "NAME":
					$place = addslashes($lineinfo['rest']);
					$info = getPlaceRecord( "", $lineinfo['level'] );
					if($info['NOTE']) $note .= $info['NOTE'];
					if($info['MAP']) $map = $info['MAP'];
					if($info['media']) {
						$mminfo = array_merge($mminfo,$info['media']);
						$mmcount = count($mminfo);
					}
					break;
				case "SNOTE":
				case "NOTE":
					$note .= addslashes($lineinfo['rest']);
					$note .= getContinued();
					break;
				case "NAMC":
					$namc = addslashes($lineinfo['rest']);
					$lineinfo = getLine();
					break;
				case "MAP":
				case "_MAP":
					$map = getMapCoords( $lineinfo['level']);
					break;
				case "OBJE":
					if( $savestate['media'] ) {
						preg_match( "/^@(\S+)@/", $lineinfo['rest'], $matches );
						$mmcount++;
						$mminfo[$mmcount] = getMoreMMInfo( $lineinfo['level'], $mmcount );
						$mminfo[$mmcount]['OBJE'] = $matches[1] ? $matches[1] : $mminfo[$mmcount]['FILE'];
						$mminfo[$mmcount]['linktype'] = "L";
					}
					else
						$lineinfo = getLine();
					break;
				default:
					$lineinfo = getLine();
					break;
			}
		}
		else
			$lineinfo = getLine();
	}

	if($place) {
 		if(!empty($info['NAMC']))
			$place .= $info['NAMC'];
		$temple = isTemple($place);
		if(!empty($tngconfig['places1tree']))
			$treeval = $treecriteria = "";
		else {
			$treeval = $tree;
			$treecriteria = " AND gedcom=\"$tree\"";
		}
		$changedate = !empty($changedate) ? date( "Y-m-d H:i:s", strtotime( $changedate ) ) : "";
		$query = "INSERT IGNORE INTO $places_table (place,gedcom,longitude,latitude,zoom,placelevel,temple,notes,geoignore,changedate,changedby) VALUES(\"$place\", \"$treeval\", \"{$map['long']}\", \"{$map['lati']}\", \"{$map['zoom']}\", \"{$map['placelevel']}\", \"$temple\", \"$note\", \"0\", \"$changedate\", \"$currentuser\")";
		$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");

		$success = tng_affected_rows();
		if($success)
			incrCounter( "P" );
		if( !$success && $savestate['del'] != "no" && (($savestate['latlong'] && ($map['long'] || $map['lati'])) || $note)) {
			$query = "UPDATE $places_table SET temple=\"$temple\"";
			$query1 = "";
			if($savestate['latlong']) {
				if($map['long'] || $map['lati'])
					$query1 .= ", longitude=\"{$map['long']}\", latitude=\"{$map['lati']}\"";
				if($map['zoom'])
					$query1 .= ", zoom=\"{$map['zoom']}\"";
				if($map['placelevel'])
					$query1 .= ", placelevel=\"{$map['placelevel']}\"";
			}
			if($note) {
				$query1 .= ", notes=\"$note\"";
			}
			$query = $query . $query1 . " WHERE place=\"$place\"$treecriteria";
			$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
			$success = 1;
		}
		if( $mmcount )
			processMedia( $mmcount, $mminfo, $place, "" );
	}
	else {
		$info = array();
		$info['MAP'] = $map;
		$info['NOTE'] = $note;
		$info['media'] = $mminfo;
		$info['NAMC'] = $namc;
		return $info;
	}
}

function isTemple($place) {
	global $ldsOK;

	$isTemple = ($ldsOK && strlen($place) == 5 && $place == preg_replace("/[^A-Z]/", "", $place)) ? 1 : 0;

	return $isTemple;
}

function getMapCoords($prevlevel) {
	global $lineinfo;

	$map = array();
	$map['long'] = "";
	$map['lati'] = "";
	$map['zoom'] = $map['placelevel'] = "0";
	$prevlevel++;

	$lineinfo = getLine( );
	while( $lineinfo['tag'] && $lineinfo['level'] >= $prevlevel ) {
		if( $lineinfo['level'] == $prevlevel ) {
			$tag = $lineinfo['tag'];
			switch( $tag ) {
				case "LATI":
				case "_LATI":
					$map['lati'] = getLatLong($lineinfo['rest'],"S");
					$lineinfo = getLine();
					break;
				case "LONG":
				case "_LONG":
					$map['long'] = getLatLong($lineinfo['rest'],"W");
					$lineinfo = getLine();
					break;
				case "ZOOM":
					$map['zoom'] = $lineinfo['rest'];
					$lineinfo = getLine();
					break;
				case "PLEV":
					$map['placelevel'] = $lineinfo['rest'];
					$lineinfo = getLine();
					break;
				case "CHAN":
					$lineinfo = getLine();
					$changedate = addslashes( $lineinfo['rest'] );
					if( $changedate ) {
						$changedate = date( "Y-m-d H:i:s", strtotime( $changedate ) );
						$lineinfo = getLine();
					}
					break;
				default:
					$lineinfo = getLine();
					break;
			}
		}
		else
			$lineinfo = getLine();
	}

	return $map;
}

function getLatLong($value,$negdir) {
	$value = strtoupper($value);
	$neednegative = strpos($value,$negdir) !== false ? true : false;
	$value = preg_replace('/,/','.', $value);
	$value = trim(preg_replace( '/[^0-9. \-]+/', '', $value ));

	$degs = explode(" ",$value);
	if(count($degs) == 3)
		$value = intval($degs[0])+(intval($degs[1])/60)+(intval($degs[2])/3600);
	else
		if(substr($value,0,1) == ".") $value = "0" . $value;
	if($neednegative) $value = "-" . $value;

	return $value;
}

function incrCounter( $prefix ) {
	global $savestate, $saveimport, $saveimport_table, $tree, $admtext, $fp, $allcount, $fstat, $writeinterval, $old;
	
	$allcount++;
	switch( $prefix ) {
		case "F":
			$savestate['fcount']++;
			$counter = $savestate['fcount'];
			break;
		case "I":
			$savestate['icount']++;
			$counter = $savestate['icount'];
			break;
		case "S":
			$savestate['scount']++;
			$counter = $savestate['scount'];
			break;
		case "M":
			$savestate['mcount']++;
			$counter = $savestate['mcount'];
			break;
		case "N":
			$savestate['ncount']++;
			$counter = $savestate['ncount'];
			break;
		case "P":
			$savestate['pcount']++;
			$counter = $savestate['pcount'];
			break;
	}
	$offset = ftell( $fp ) - $savestate['len']; 
	$newwidth = $fstat['size'] ? ceil(500 * $offset / $fstat['size']) : 0;
    if($old) {
		if($counter % 10 == 0 ) {
			echo "<strong>$prefix$counter</strong> ";
			if(ob_get_contents()) ob_flush();
			@flush();
		}
	}
	if( $saveimport ) {
		$query = "UPDATE $saveimport_table SET icount = {$savestate['icount']}, fcount = {$savestate['fcount']}, scount = {$savestate['scount']}, mcount = {$savestate['mcount']}, ncount = {$savestate['ncount']}, mcount = {$savestate['mcount']}, pcount = {$savestate['pcount']}, fileoffset = $offset, barwidth = $newwidth WHERE gedcom = \"$tree\"";
		$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
	}
}

//media
function adjustMediaFileName( $mm ) {
	global $assignnames, $wholepath, $imagetypes;
	
	if( !empty($mm['path']) && $assignnames ) {
		$newname = $mm['path'];
	}
	else {
		$newname = isset($mm['FILE']) ? $mm['FILE'] : "";
		if( $newname && strpos($mm['FILE'], 'http://') !== 0 && strpos($mm['FILE'], 'https://') !== 0) {
			$found = 0;
			$pathlist = getLocalPathList($mm['mediatypeID']);
			if( $pathlist )	{
				$paths = explode(",", $pathlist);
				foreach( $paths as $path ) {
					if( substr_count( $newname, $path ) ) {
						$newname = substr( $newname, strlen( $path ) );
						$found = 1;
						break;
					}
				}
			}
			$newname = str_replace( "\\", "/", $newname );
			if( !$found && !$wholepath )
				$newname = basename( $newname );
			elseif( substr( $newname, 0, 1 ) == "/" )
				$newname = substr( $newname, 1 );
		}
	}

	return addslashes($newname);
}

function getLocalPathList($mediatypeID) {
	global $locimppath, $mediatypes_locpaths;

	switch( $mediatypeID ) {
		case "photos":
			$locpath = $locimppath['photos'];
			break;
		case "histories":
			$locpath = $locimppath['histories'];
			break;
		case "documents":
       		$locpath = $locimppath['documents'];
			break;
		case "headstones":
       		$locpath = $locimppath['headstones'];
			break;
		case "recordings":
		case "videos":
			$locpath = $locimppath['other'];
			break;
		default:
			$locpath = isset($mediatypes_locpaths[$mediatypeID]) ? $mediatypes_locpaths[$mediatypeID] : "";
	}

	return $locpath;
}

function getMoreMMInfo( $prevlevel, $mmcount ) {
	global $lineinfo, $tree, $admtext;

	$moreinfo = initMultimedia();
	$origlevel = $prevlevel;
	$prevlevel++;
	$moreinfo['FORM'] = "";
	$moreinfo['defphoto'] = "";
	
	$lineinfo = getLine();
	while( $lineinfo['level'] >= $prevlevel ) {
		$tag = $lineinfo['tag'];
		switch( $tag ) {
			case "FILE":
			case "_FILE":
				$filelevel = $lineinfo['level'];
				$moreinfo['FILE'] = $lineinfo['rest'];
				$moreinfo['FILE'] .= getContinued();
				while( $lineinfo['level'] > $filelevel ) {
					if($lineinfo['tag'] == "TITL")
						$moreinfo['TITL'] = addslashes( $lineinfo['rest'] );
					elseif($lineinfo['tag'] == "FORM")
						$moreinfo['FORM'] = addslashes( strtoupper( $lineinfo['rest'] ) );
					$lineinfo = getLine();
				}
				break;
			case "TITL":
				$moreinfo[$tag] = addslashes( $lineinfo['rest'] );
				$lineinfo = getLine();
				break;
			case "FORM":
				$moreinfo[$tag] = addslashes( strtoupper( $lineinfo['rest'] ) );
				$lineinfo = getLine();
				break;
			case "SNOTE":
			case "NOTE":
			case "TEXT":
			case "_TEXT":
				$moreinfo['NOTE'] = addslashes( $lineinfo['rest'] );
				$moreinfo['NOTE'] .= getContinued();
				break;
			case "CHAN":
				$moreinfo['CHAN'] = addslashes( $lineinfo['rest'] );
				$lineinfo = getLine();
				if(!$moreinfo['CHAN']) {
					$moreinfo['CHAN'] = addslashes( $lineinfo['rest'] );
					if( $moreinfo['CHAN'] ) {
						$lineinfo = getLine();
						if( $lineinfo['tag'] == "TIME" ) {
							$moreinfo['CHAN'] .= " " . preg_replace("/\./",":",$lineinfo['rest']);
							$lineinfo = getLine();
						}
					}
				}
				if($moreinfo['CHAN'])
					$moreinfo['CHAN'] = date( "Y-m-d H:i:s", strtotime( $moreinfo['CHAN'] ) );
				break;
			case "_TYPE":
			case "TYPE":
				$moreinfo['mediatypeID'] = getMediaCollection2( $lineinfo['rest'] );
				$lineinfo = getLine();
				break;
			case "_DATE":
			case "DATE":
				$moreinfo['datetaken'] = addslashes( trim($lineinfo['rest']) );
				$lineinfo = getLine();
				break;
			case "_PLAC":
			case "PLAC":
				$moreinfo['placetaken'] = addslashes( trim($lineinfo['rest']) );
				$lineinfo = getLine();
				break;
			case "_PRIM":
				if($origlevel == 1 && $lineinfo['rest'] == "Y")
					$moreinfo['defphoto'] = 1;
				$lineinfo = getLine();
				break;
			case "_PRIV":
				$moreinfo['private'] = 1;
				break;
			default:
				$lineinfo = getLine();
				break;
		}
	}
	if( !$moreinfo['FORM'] && !empty($moreinfo['FILE']) ) {
		$lastperiod = strrpos($moreinfo['FILE'],".");
		if($lastperiod)
			$moreinfo['FORM'] = strtoupper(substr($moreinfo['FILE'],$lastperiod + 1));
	}
	$moreinfo['mediatypeID'] = getMediaCollection( $moreinfo );
	$moreinfo['FILE'] = adjustMediaFileName( $moreinfo );
	
	return $moreinfo;
}

function getMediaCollection($mediaobj) {
	global $imagetypes, $historytypes, $documenttypes, $videotypes, $recordingtypes, $locimppath;

	$mediatypeID = isset($mediaobj['mediatypeID']) ? $mediaobj['mediatypeID'] : "";
	if(!empty($mediaobj['FILE'])) {
		$found = false;
		foreach($locimppath as $locMediatypeID => $pathlist) {
			if($pathlist) {
				$paths = explode(",", $pathlist);
				foreach( $paths as $path ) {
					if( substr_count( $mediaobj['FILE'], $path ) ) {
						$mediatypeID = $locMediatypeID;
						$found = true;
						break;
					}
				}
			}
			if($found) break;
		}
	}

	if(!$mediatypeID && isset($mediaobj['FORM']) && $mediaobj['FORM']) {
		$form = $mediaobj['FORM'];
		if( in_array( $form, $historytypes ) )
			$mediatypeID = "histories";
		elseif( in_array( $form, $documenttypes ) )
			$mediatypeID = "documents";
		elseif( in_array( $form, $videotypes ) )
			$mediatypeID = "videos";
		elseif( in_array( $form, $recordingtypes ) )
			$mediatypeID = "recordings";
		else
			$mediatypeID = "photos";
	}

	return $mediatypeID;
}

function getMediaCollection2($type) {
	$newtype = substr(strtolower($type),0,5);
	$mediatypeID = "";
	switch($newtype) {
		case "photo":
			if(strtolower($type) == "photo document")
				$mediatypeID = "documents";
			else
				$mediatypeID = "photos";
			break;
		case "histo":
		case "biogr":
			$mediatypeID = "histories";
			break;
		case "pdf":
		case "doc":
		case "docum":
			$mediatypeID = "documents";
			break;
		case "video":
			$mediatypeID = "videos";
			break;
		case "heads":
			$mediatypeID = "headstones";
			break;
		default:
			$mediatypeID = strtolower($type);
			break;
	}

	return $mediatypeID;
}

function getMediaFolder($mediatypeID) {
	global $rootpath, $mediapath, $photopath, $documentpath, $historypath;

	switch( $mediatypeID ) {
		case "photos":
			$mmpath = "$rootpath$photopath";
			break;
		case "histories":
			$mmpath = "$rootpath$historypath";
			break;
		case "documents":
       		$mmpath = "$rootpath$documentpath";
			break;
		default:
			$mmpath = "$rootpath$mediapath";
			break;
	}

	return $mmpath;
}

function processMedia( $mmcount, $mminfo, $persfamID, $eventID ) {
	global $admtext, $medialinks_table, $tree, $media_table, $link, $savestate, $today, $tngimpcfg;

	for( $mmctr = 1; $mmctr <= $mmcount; $mmctr++ ) {
		$mm = $mminfo[$mmctr];
		//insert ignore into media
		if(!isset($mm['CHAN'])) $mm['CHAN'] = "";
		if(empty($mm['CHAN']) && !$tngimpcfg['chdate']) $mm['CHAN'] = $today;
		$inschangedt = $mm['CHAN'] ? $mm['CHAN'] : ($tngimpcfg['chdate'] == "1" ? "0000-00-00 00:00:00" : $today);
 		if(!$mm['TITL']) $mm['TITL'] = $mm['FILE'];
		$query = "INSERT IGNORE INTO $media_table (gedcom, mediatypeID, mediakey, path, description, notes, form, usecollfolder, datetaken, placetaken, private, changedate) VALUES(\"$tree\", \"{$mm['mediatypeID']}\", \"{$mm['OBJE']}\", \"{$mm['FILE']}\", \"{$mm['TITL']}\", \"{$mm['NOTE']}\", \"{$mm['FORM']}\", \"1\", \"{$mm['datetaken']}\", \"{$mm['placetaken']}\", \"{$mm['private']}\", \"{$mm['CHAN']}\")";
		$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");

		$success = tng_affected_rows();
		if( $success ) {
			$mediaID = tng_insert_id();
			incrCounter( "M" );
		}
		else {
			//update if necessary
			$query = "SELECT mediaID, changedate FROM $media_table WHERE gedcom = \"$tree\" AND mediakey = \"{$mm['OBJE']}\"";
			$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
			$row = tng_fetch_assoc( $result );
			$mediaID = $row['mediaID'];
			tng_free_result($result);
			if( $savestate['del'] != "no" ) {
				if( $savestate['neweronly'] && $inschangedt )
					$goahead = $inschangedt > $row['changedate'] ? 1 : 0;
				else
					$goahead = 1;
				if( $goahead ) {
					if( $mm['FILE'] || $mm['TITL'] || $mm['NOTE'] || $mm['datetaken'] || $mm['placetaken'] ) {
						$changedatestr = $mm['CHAN'] ? ", changedate=\"{$mm['CHAN']}\"" : "";
						//$query = "UPDATE $media_table SET path=\"$mm['FILE']\", description=\"$mm['TITL']\", notes=\"$mm['NOTE']\", form=\"$mm['FORM']\"$changedatestr WHERE gedcom = \"$tree\" AND mediakey = \"$mm['OBJE']\"";
						$descstr = $mm['TITL'] ? ", description=\"{$mm['TITL']}\"" : "";
						$notestr = $mm['NOTE'] ? ", notes=\"{$mm['NOTE']}\"" : "";
						$datestr = $mm['datetaken'] ? ", datetaken=\"{$mm['datetaken']}\"" : "";
						$placestr = $mm['placetaken'] ? ", placetaken=\"{$mm['placetaken']}\"" : "";
						$privstr = $mm['private'] ? ", private=\"{$mm['private']}\"" : "";
						$query = "UPDATE $media_table SET path=\"{$mm['FILE']}\"$descstr$notestr$datestr$placestr$privstr, form=\"{$mm['FORM']}\"$changedatestr WHERE gedcom = \"$tree\" AND mediakey = \"{$mm['OBJE']}\"";
					}
					elseif( $mm['CHAN'] )
						$query = "UPDATE $media_table SET changedate=\"{$mm['CHAN']}\" WHERE gedcom = \"$tree\" AND mediakey = \"{$mm['OBJE']}\"";
					$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
					incrCounter( "M" );
				}
			}
		}
		//get ordernum according to collection/mediatypeID
		$query = "SELECT count(medialinkID) as count from ($medialinks_table, $media_table) WHERE $media_table.mediaID = $medialinks_table.mediaID AND $medialinks_table.gedcom = \"$tree\" AND personID = \"$persfamID\" AND mediatypeID = \"{$mm['mediatypeID']}\"";
		$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
		$row = tng_fetch_assoc( $result );
		$orderctr = $row['count'] ? $row['count'] + 1 : 1;
		tng_free_result($result);

		//insert ignore or update medialink
		$query = "INSERT IGNORE INTO $medialinks_table (personID, mediaID, linktype, altdescription, altnotes, ordernum, dontshow, gedcom, eventID, defphoto)  VALUES(\"$persfamID\", \"$mediaID\", \"{$mm['linktype']}\", \"{$mm['TITL']}\", \"{$mm['NOTE']}\", \"$orderctr\", \"0\", \"$tree\", \"$eventID\", \"{$mm['defphoto']}\")";
		$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
		$psuccess = tng_affected_rows();
		if( !$psuccess && $savestate['del'] != "no" ) {
			$defphotostr = $mm['defphoto'] ? ", defphoto = \"1\"" : "";
			$query = "UPDATE $medialinks_table SET altdescription=\"{$mm['TITL']}\", altnotes=\"{$mm['NOTE']}\"$defphotostr WHERE gedcom = \"$tree\" AND personID = \"$persfamID\" AND mediaID = \"$mediaID\" AND eventID=\"$eventID\"";
			$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
		}
		if($mm['defphoto']) {
			$query = "UPDATE $medialinks_table SET defphoto=\"\" WHERE gedcom=\"$tree\" AND personID=\"$persfamID\" AND mediaID != \"$mediaID\"";
			$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
		}
	}
}

function getCodedMedia( ) {
	global $lineinfo;
	
	$continued = "";
	$notdone = 1;
	
	while( $notdone ) {
		$lineinfo = getLine( );
		//echo "$lineinfo['level'] $lineinfo['tag'] $lineinfo['rest']<br/>\n";
		if ( $lineinfo['tag'] == "CONT" || $lineinfo['tag'] == "CONC" ) 
			$continued .= $lineinfo['rest'];
		else 
			$notdone = 0;
	}
	return $continued;
}

function mmd( $nextchar ) {
	global $decodearr;
	
	if( ord( $nextchar ) <= 57 ) 
		$offset = 46;
	elseif( ord( $nextchar ) <= 90 )
		$offset = 53;
	elseif( ord( $nextchar ) <= 122 )
		$offset = 59;
	else
		$offset = 0;
		
	if( $offset )
		$rval = str_pad(decbin(ord( $nextchar ) - $offset),6,"0",STR_PAD_LEFT);
	else
		$rval = "";

	return $rval;
}

function initMultimedia() {
	$mminfo = array();

	$mminfo['FORM'] = "";
	$mminfo['defphoto'] = "";
	$mminfo['TITL'] = "";
	$mminfo['NOTE'] = "";
	$mminfo['datetaken'] = "";
	$mminfo['linktype'] = "";
	$mminfo['saved'] = "";
	$mminfo['path'] = "";
	$mminfo['mediatypeID'] = "";
	$mminfo['private'] = 0;
	$mminfo['placetaken'] = "";

	return $mminfo;
}

function getMultimediaRecord( $objectID, $prevlevel ) {
	global $link, $tree, $admtext, $savestate, $lineinfo, $media_table;
	global $mminfo, $today, $tngimpcfg, $mediapath, $thumbprefix, $thumbsuffix;

	$prefix = "M";
	$info = ""; 
	$changedate = "";
	$prevlevel++;
	$continued = 0;
	$gotfile = 0;
	$mmpath = "";
	$mminfo = initMultimedia();
	
	$mminfo['ID'] = $objectID;
	//echo "doing $objectID<br>\n";
	$lineinfo = getLine( );
	while( $lineinfo['tag'] && $lineinfo['level'] >= $prevlevel ) {
		if( $lineinfo['level'] == $prevlevel ) {
			$tag = $lineinfo['tag'];
			switch( $tag ) {
				case "BLOB":
					if( !isset( $mminfo[$objectID] ) ) {
						$mminfo['path'] = $tree.$mminfo['ID'] . "." . $mminfo['FORM'];
						$mmpath = getMediaFolder($mminfo['mediatypeID']) . "/" . $mminfo['path'];
						$mminfo[$objectID] = fopen( $mmpath, "wb" );
						flock( $mminfo[$objectID], 2 );
						$gotfile = 1;
					}
					$mminfo['ID'] = $mminfo['saved'];
					$encodedstr = getCodedMedia();
					$chars = preg_split('//', $encodedstr, -1, PREG_SPLIT_NO_EMPTY);
					$end = count( $chars );
					$ptr = 0;
					while( $ptr < $end ) {
						$newstr = mmd($chars[$ptr]) . mmd(isset($chars[$ptr+1]) ? $chars[$ptr+1] : "") . mmd(isset($chars[$ptr+2]) ? $chars[$ptr+2] : "") . mmd(isset($chars[$ptr+3]) ? $chars[$ptr+3] : "");
						$packed = pack( "c*", bindec(substr($newstr,16,8)), bindec(substr($newstr,8,8)), bindec(substr( $newstr,0,8)) );
						fwrite( $mminfo[$objectID], $packed );
						$ptr += 4;
					}
					break;
				case "OBJE":
					//continue a previous one
					$continued = 1;
					//echo "continuing $objectID<br>";
					$mminfo['saved'] = $objectID;
					preg_match( "/^@(\S+)@/", $lineinfo['rest'], $matches );
					$index = $matches[1];
					$mminfo[$index] = $mminfo[$objectID];
					$lineinfo = getLine();
					break;
				case "FILE":
				case "_FILE":
					$filelevel = $lineinfo['level'];
					$mminfo['FILE'] = $lineinfo['rest'];
					$mminfo['FILE'] .= getContinued();
					if( !$mminfo['mediatypeID'] ) {
						$lastperiod = strrpos($mminfo['FILE'],".");
						if($lastperiod) {
							$mminfo['FORM'] = strtoupper(substr($mminfo['FILE'],$lastperiod + 1));
						}
					}
					while( $lineinfo['level'] > $filelevel ) {
						if($lineinfo['tag'] == "TITL") {
							$mminfo['TITL'] = addslashes( $lineinfo['rest'] );
						}
						$lineinfo = getLine();
					}
					break;
				case "TITL":
					$mminfo['TITL'] = addslashes( $lineinfo['rest'] );
					$lineinfo = getLine();
					break;
				case "_TYPE":
				case "TYPE":
					$mminfo['mediatypeID'] = getMediaCollection2( $lineinfo['rest'] );
					$lineinfo = getLine();
					break;
				case "_DATE":
				case "DATE":
					$mminfo['datetaken'] = addslashes( trim($lineinfo['rest']) );
					$lineinfo = getLine();
					break;
				case "_PLAC":
				case "PLAC":
					$mminfo['placetaken'] = addslashes( trim($lineinfo['rest']) );
					$lineinfo = getLine();
					break;
				case "FORM":
					$mminfo['FORM'] = addslashes( strtoupper( $lineinfo['rest'] ) );
					$lineinfo = getLine();
					break;
				case "SNOTE":
				case "NOTE":
				case "TEXT":
				case "_TEXT":
					$mminfo['NOTE'] = addslashes( $lineinfo['rest'] );
					$mminfo['NOTE'] .= getContinued();
					break;
				case "CHAN":
					$lineinfo = getLine();
					$changedate = addslashes( $lineinfo['rest'] );
					if( $changedate ) {
						$changedate = date( "Y-m-d H:i:s", strtotime( $changedate ) );
						$lineinfo = getLine();
					}
					break;
				default:
					$lineinfo = getLine();
					break;
			}
		}
		else
			$lineinfo = getLine();
		$mminfo['mediatypeID'] = getMediaCollection($mminfo);
	}
	if( !$continued ) {
		if( $gotfile ) {
			flock( $mminfo[$objectID], 3 );
			fclose( $mminfo[$objectID] );
		}

		$inschangedt = $changedate ? $changedate : ($tngimpcfg['chdate'] ? "" : $today);
		if( $savestate['del'] != "no" ) {
			$mminfo['FILE'] = adjustMediaFileName( $mminfo );
			if( $mminfo['FILE'] != $mminfo['path'] ) {
				if( $mminfo['FILE'] && $mminfo['path'] ) {
					$mmpath = getMediaFolder($mminfo['mediatypeID']);
					rename( $mmpath . "/" . $mminfo['path'], $mmpath . "/" . $mminfo['FILE'] );
				}
			}

			//$thumbpath = ($thumbprefix || $thumbsuffix) ? $thumbprefix . $mminfo['path'] . $thumbsuffix : $mminfo['path'];
			$thumbpath = "";  //inserted in place of previous line to make sure INSERT query below doesn't break
			if( !$mminfo['mediatypeID'] ) $mminfo['mediatypeID'] = "photos";
			$mminfo['ucf'] = ($mmpath && $mmpath == $mediapath) ? 0 : 1;

			//get the mediatypeID, hs & history items, mediakey--should it always be the file?
			if(empty($mminfo['TITL'])) $mminfo['TITL'] = $mminfo['FILE'];
			$query = "INSERT IGNORE INTO $media_table (gedcom, mediakey, path, thumbpath, description, notes, form, mediatypeID, usecollfolder, datetaken, placetaken, private, changedate) VALUES(\"$tree\", \"{$mminfo['ID']}\", \"{$mminfo['FILE']}\", \"$thumbpath\", \"{$mminfo['TITL']}\", \"{$mminfo['NOTE']}\", \"{$mminfo['FORM']}\", \"{$mminfo['mediatypeID']}\", \"{$mminfo['ucf']}\", \"{$mminfo['datetaken']}\", \"{$mminfo['placetaken']}\", \"{$mminfo['private']}\", \"$inschangedt\")";
			$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");

			$success = tng_affected_rows();
			if( !$success ) {
				//$thumbstr = $thumbprefix ? "thumbpath=\"$thumbprefix$mminfo['path']" . $thumbsuffix . "\", " : "";
				$query = "SELECT mediatypeID FROM $media_table WHERE gedcom = \"$tree\" AND mediakey = \"{$mminfo['ID']}\"";
				$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
				$row = tng_fetch_assoc( $result );
				tng_free_result($result);

				$mediatypeIDstr = !$row['mediatypeID'] ? " mediatypeID=\"{$mminfo['mediatypeID']}\"," : "";
				//$mediatypeIDstr = " mediatypeID=\"{$mminfo['mediatypeID']}\",";
				$query = "UPDATE $media_table SET path=\"{$mminfo['FILE']}\", description=\"{$mminfo['TITL']}\", notes=\"{$mminfo['NOTE']}\", form=\"{$mminfo['FORM']}\", datetaken=\"{$mminfo['datetaken']}\", placetaken=\"{$mminfo['placetaken']}\", private=\"{$mminfo['private']}\",$mediatypeIDstr changedate=\"$inschangedt\" WHERE gedcom = \"$tree\" AND mediakey = \"{$mminfo['ID']}\"";
				$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
			}
		}

		unset( $mminfo );
		incrCounter( $prefix );
	}
}

//sources
function processCitations( $persfamID, $eventID, $citearray ) {
	if(is_array($citearray)) {
		foreach( $citearray as $cite )
			saveCitation( $persfamID, $eventID, $cite );
	}
}

function saveCitation( $persfamID, $eventID, $cite ) {
	global $citations_table, $admtext, $tree;
	
	$query = "INSERT INTO $citations_table (persfamID, gedcom, eventID, sourceID, description, citedate, citedatetr, citetext, page, quay, note, ordernum ) VALUES(\"$persfamID\", \"$tree\", \"$eventID\", \"{$cite['sourceID']}\", \"{$cite['desc']}\", \"{$cite['DATE']}\", \"{$cite['DATETR']}\", \"{$cite['TEXT']}\", \"{$cite['PAGE']}\", \"{$cite['QUAY']}\", \"{$cite['NOTE']}\", \"0\" )";
	$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
	$citationID = tng_insert_id();

	if( isset($cite['MEDIA']) && is_array($cite['MEDIA']) ) {
		processMedia( count($cite['MEDIA']), $cite['MEDIA'], $citationID, "" );
	}
}

//notes
function processNotes( $persfamID, $eventID, $notearray ) {
	if(is_array($notearray)) {
		foreach( $notearray as $note )
			saveNote( $persfamID, $eventID, $note );
	}
}

function saveNote( $persfamID, $eventID, $note ) {
	global $notelinks_table, $xnotes_table, $admtext, $tree, $link, $tngimpcfg, $max_note_length, $session_charset;

	$found = 0;
	if( $note['XNOTE'] ) {
		$query = "SELECT ID FROM $xnotes_table WHERE noteID = \"{$note['XNOTE']}\" AND gedcom = \"$tree\"";
		$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
		$row = tng_fetch_assoc( $result );
		if( tng_num_rows( $result ) ) {
			$xnoteID = $row['ID'];
			$found = 1;
		}
		tng_free_result( $result );
	}
	if( !$found ) {
		if(function_exists('mb_strimwidth')) {
			$note['NOTE'] = mb_strimwidth((isset($note['NOTE']) ? $note['NOTE'] : ""),0,$max_note_length,"",$session_charset);
			$note['XNOTE'] = mb_strimwidth((isset($note['XNOTE']) ? $note['XNOTE'] : ""),0,$max_note_length,"",$session_charset);
		}
		$query = "INSERT INTO $xnotes_table (noteID, gedcom, note)  VALUES(\"{$note['XNOTE']}\", \"$tree\", \"{$note['NOTE']}\")";
		$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
		$xnoteID = tng_insert_id();
		incrCounter( "N" );
	}

	$privlen = isset($tngimpcfg['privnote']) ? strlen($tngimpcfg['privnote']) : 0;
	$secret = ($privlen && substr($note['NOTE'],0,$privlen) == $tngimpcfg['privnote']) ? 1 : 0;
	$query = "INSERT IGNORE INTO $notelinks_table (persfamID, gedcom, eventID, xnoteID, secret, ordernum) VALUES(\"$persfamID\", \"$tree\", \"$eventID\", \"$xnoteID\", \"$secret\", \"0\" )";
	$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
	$ID = tng_insert_id( );
	
	if( isset( $note['SOUR'] ) )
		processCitations( $persfamID, "N$ID", $note['SOUR'] );
}

function getNoteRecord( $noteID, $prevlevel, $notelabel ) {
	global $link, $tree, $admtext, $savestate, $lineinfo, $xnotes_table, $citations_table, $tngimpcfg, $notelinks_table, $max_note_length, $session_charset;

	$noteID = adjustID( $noteID, $savestate['noffset'], "N" );

	$prefix = "N";
	$info = "";
	$prevlevel++;
	
	preg_match( "/^{$notelabel} ?(.*)$/", $lineinfo['rest'], $matches );
	if( $matches[1] )
		$note = addslashes( $matches[1] );
	else
		$note = "";
	$lineinfo = getLine( );
	if( $lineinfo['level'] && ( $lineinfo['tag'] == $notelabel || $lineinfo['tag'] == "CONT" || $lineinfo['tag'] == "CONC" ) ) {
		if( $note && $lineinfo['tag'] != "CONC" )
			$note .= "\n";
		$note .= addslashes( $lineinfo['rest'] ); 
		$note .= getContinued();
	}
	$notectr = 0;
	while( $lineinfo['level'] >= $prevlevel && $lineinfo['tag'] == "SOUR" ) {
		$notesource[$notectr] = handleSource( $noteID, $lineinfo['level'] );
		$notectr++;
	}

	$query = "SELECT ID FROM $xnotes_table WHERE noteID = \"$noteID\" AND gedcom = \"$tree\"";
	$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
	$row = tng_fetch_assoc( $result );
	if(function_exists('mb_strimwidth'))
		mb_strimwidth($note,0,$max_note_length,"",$session_charset);
	if( tng_num_rows( $result ) && $savestate['del'] != "no" ) {
		$ID = $row['ID'];
		$query = "UPDATE $xnotes_table SET note=\"$note\" WHERE noteID=\"$noteID\" AND gedcom = \"$tree\"";
		$xresult = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
	}
	else {
		$query = "INSERT INTO $xnotes_table (noteID, gedcom, note)  VALUES(\"$noteID\", \"$tree\", \"$note\")";
		$xresult = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
		$ID = tng_insert_id( );
		incrCounter( $prefix );
	}

	//see if private character exists
	$privlen = isset($tngimpcfg['privnote']) ? strlen($tngimpcfg['privnote']) : 0;
	if($privlen && substr($note,0,$privlen) == $tngimpcfg['privnote']) {
		$query = "UPDATE $notelinks_table SET secret=\"1\" WHERE xnoteID=\"$ID\"";
		$nresult = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
	}

	if( $notectr ) {
		if( $savestate['del'] == "match" ) {
			$query = "DELETE from $citations_table WHERE persfamID = \"$noteID\" and gedcom = \"$tree\"";
			$result2 = @tng_query($query);
		}
		processCitations( $noteID, "", $notesource );
	}
	tng_free_result($result);
}

function dumpnotes( $notearray ) {
	global $stdnotes, $notecount;

	foreach( $notearray as $note ) {
		$stdnotes[$notecount] = $note;
		$notecount++;
	}
}

//custom events
function saveCustEvents( $prefix, $persfamID, $events, $totevents ) {
	global $events_table, $eventtypes_table, $custevents, $admtext, $tree, $medialinks, $num_medialinks, $medialinks_table, $num_albumlinks, $album2entities_table, $albumlinks, $savestate, $cite, $mminfo;

	for( $eventnum = 1; $eventnum <= $totevents; $eventnum++ ) {
		$event = $events[$eventnum]['TAG'];
		$eventptr = $events[$eventnum]['INFO'];
		$description = $events[$eventnum]['TYPE'];
		if( $event == "EVEN" ) {
			$wherestr =  "AND description = \"$description\"";
		}
		else 
			$wherestr = "";
		if( $description ) 
			$display = $description;
		else {
			$display = isset($admtext[$event]) ? $admtext[$event] : "";
			if( !$display ) $display = $event;
		}
		$eventinfo = isset($eventptr['FACT']) ? $eventptr['FACT'] : "";
		$eventtype = strtoupper($prefix . "_" . $event . "_" . $description);

		if( empty($custevents[$eventtype]) ) {
			//if not in	custevents array, add to eventtypes_table with keep=ignore
			$keep = $savestate['allevents'];
			$query = "INSERT IGNORE INTO $eventtypes_table (tag, description, display, keep, type)  VALUES(\"$event\", \"$description\", \"$display\", \"$keep\", \"$prefix\")";
			$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
			$custevents[$eventtype]['eventtypeID'] = tng_insert_id();
			$custevents[$eventtype]['keep'] = $keep;
		}

		//save the event
		if( isset($custevents[$eventtype]) && $custevents[$eventtype]['keep'] ) {
			$eventtypeID = $custevents[$eventtype]['eventtypeID'];
			//always insert, never update in this case

			preg_match( "/^@(\S+)@/", $eventinfo, $matches );
			if(!empty($matches[1])) $eventinfo = "@" . adjustId($matches[1],$savestate['noffset'], "N") . "@";

			$nonShare = new stdClass();
			$nonShare->id = $persfamID;
			$eventptr['SHARES'][] = $nonShare;

			foreach($eventptr['SHARES'] as $share) {
				$persfamID = $share->id;
				$query = "INSERT INTO $events_table (eventtypeID, persfamID, eventdate, eventdatetr, eventplace, age, agency, cause, addressID, parenttag, info, gedcom)  VALUES(\"$eventtypeID\", \"$persfamID\", \"" . $eventptr['DATE'] . "\", \"" . $eventptr['DATETR'] . "\", \"" . $eventptr['PLAC'] . "\", \"" . $eventptr['AGE'] . "\", \"" . $eventptr['AGNC'] . "\", \"" . $eventptr['CAUS'] . "\", \"" . $eventptr['ADDR'] . "\",  \"" . $eventptr['parent'] . "\", \"$eventinfo\", \"$tree\")";
				$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
				$eventID = tng_insert_id();

				if($num_medialinks || $num_albumlinks) {
					$key = $persfamID . "::" . $eventtypeID . "::" . $eventptr['DATE'] . "::" . substr(stripslashes($eventptr['PLAC']),0,40) . "::" . substr(stripslashes($eventinfo),0,40);
					$key = preg_replace("/[^A-Za-z0-9:]/","",$key);
					if($num_medialinks) {
						if(isset($medialinks[$key])) {
							foreach($medialinks[$key] as $medialinkID) {
								//remove xxx event record
								//$value = $eventlinks[$medialinkID];
								//$query = "DELETE FROM $events_table WHERE eventID = \"$value\"";
								//$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
		
								//put new eventID in old medialink records for this event
								$query = "UPDATE $medialinks_table SET eventID = \"$eventID\" WHERE medialinkID = \"$medialinkID\"";
								$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
							}
							unset($medialinks[$key]);
						}
					}
					if($num_albumlinks) {
						if(isset($albumlinks[$key])) {
							foreach($albumlinks[$key] as $albumlinkID) {
								//put new eventID in old medialink records for this event
								$query = "UPDATE $album2entities_table SET eventID = \"$eventID\" WHERE alinkID = \"$albumlinkID\"";
								$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
							}
							unset($albumlinks[$key]);
						}
					}
				}
					
				if( isset( $eventptr['SOUR'] ) ) 
					processCitations( $persfamID, $eventID, $eventptr['SOUR'] );
				if( isset( $eventptr['NOTES'] ) ) 
					processNotes( $persfamID, $eventID, $eventptr['NOTES'] );
				if( isset( $share->notes ) )
					processNotes( $persfamID, $eventID, $share->notes );
				//save media, if any
				if( isset($eventptr['MEDIA']) && is_array($eventptr['MEDIA']) ) {
					$mminfo = $eventptr['MEDIA'];
					foreach( $mminfo as $m )
						$m['linktype'] = $prefix;
					processMedia( count($mminfo), $mminfo, $persfamID, $eventID );
				}
			}
		}
	}
}

function removeDelims( $fact ) {
	preg_match( "/(.*)\s*\/(.*)\/\s*(.*)/", $fact, $matches );
	if( count( $matches ) && substr($fact,0,1) != '<' && substr($fact,0,4) != "http")
		$fact = trim( $matches[1] . " " . $matches[2] . " " . $matches[3] );
	
	return $fact;
}
?>