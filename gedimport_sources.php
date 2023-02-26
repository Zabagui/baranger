<?php
function initCitation() {
	$cite = array();

	$cite['DATETR'] = "0000-00-00";
	$cite['DATE'] = "";
	$cite['TEXT'] = "";
	$cite['PAGE'] = "";
	$cite['QUAY'] = "";
	$cite['NOTE'] = "";

	return $cite;
}

function handleSource( $persfamID, $prevlevel ) {
	global $tree, $lineinfo, $admtext, $custevents, $stdevents, $citations_table, $savestate, $notecount;
	
	$cite = initCitation();
	preg_match( "/^@(\S+)@/", $lineinfo['rest'], $matches );
	if( !empty($matches[1]) ) {
		$cite['sourceID'] = adjustID( $matches[1], $savestate['soffset'], "S" );
		$cite['desc'] = "";
		$lineinfo = getLine();
	}
	else {
		$cite['sourceID'] = "";
		$cite['desc'] = addslashes( $lineinfo['rest'] );
		$cite['desc'] .= getContinued();
	}
	$prevlevel++;

	$mminfo = array();
	$mmcount = 0;

	while( $lineinfo['level'] >= $prevlevel ) {
		$tag = $lineinfo['tag'];
		switch( $tag ) {
			case "DATE":
				$cite['DATE'] = addslashes( $lineinfo['rest'] );
				if(empty($cite['DATETR'])) 
					$cite['DATETR'] = convertDate( $cite['DATE'] );
				$lineinfo = getLine();
				break;
			case "SDATE":
				if(empty($cite['DATE']))
					$cite['DATE'] = addslashes( trim($lineinfo['rest']) );
				$cite['DATETR'] = convertDate( $moreinfo['DATE'] );
				$lineinfo = getLine();
				break;
			case "PAGE":
			case "QUAY":
				$cite[$tag] = addslashes( $lineinfo['rest'] );
				$cite[$tag] .= getContinued();
				break;
			case "TEXT":
			case "SNOTE":
			case "NOTE":
			case "_TEXT":
				//$notecount++;
				preg_match( "/^@(\S+)@/", $lineinfo['rest'], $matches );
				if(empty($cite[$tag]))
					$cite[$tag] = "";
				if( !empty($matches[1]) ) {
					$cite[$tag] .= "@" . adjustID( $matches[1], $savestate['noffset'], "N" ) . "@";
					$lineinfo = getLine();
				}
				else {
					$cite[$tag] .= addslashes($lineinfo['rest']);
					$cite[$tag] .= getContinued();
				}
				break;
			case "IMAGE":
			case "OBJE":
				if( $savestate['media'] ) {
					preg_match( "/^@(\S+)@/", $lineinfo['rest'], $matches );
					$mmcount++;
					$mminfo[$mmcount] = getMoreMMInfo( $lineinfo['level'], $mmcount );
					$mminfo[$mmcount]['OBJE'] = !empty($matches[1]) ? $matches[1] : $mminfo[$mmcount]['FILE'];
					//$mminfo[$mmcount]['linktype'] = "$prefix"; not sure this matters for citations
				}
				else
					$lineinfo = getLine();
				break;
			default:
				$lineinfo = getLine();
				break;
		}
	}

	if( $mmcount ) {
		$cite['MEDIA'] = $mminfo;
	}
	
	return $cite;
	
	//save it
	//$prefix = substr( $persfamID, 0, 1 );
	//$eventtype = $prefix . "_" . $prevtag . "_" . $prevtype;
	//if( ( $custevents[$eventtype] && $custevents[$eventtype]['keep'] ) || in_array( $prevtag, $stdevents ) || !$prevtag ) {
		//$eventtypeID = $custevents[$eventtype] ? $custevents[$eventtype]['eventtypeID'] : $prevtag;
		//$query = "INSERT IGNORE INTO $citations_table (persfamID, gedcom, eventtypeID, sourceID, description, citedate, citedatetr, citetext, page, quay, note ) VALUES(\"$persfamID\", \"$tree\", \"" . $eventtypeID . "\", \"$cite['sourceID']\", \"$cite['desc']\", \"$cite['DATE']\", \"$cite['DATETR']\", \"$cite['TEXT']\", \"$cite['PAGE']\", \"$cite['QUAY']\", \"$cite['NOTE']\" )";
		//$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
	//}
}

function initSource() {
	$info = array();

	$info['CALN'] = "";
	$info['AUTH'] = "";
	$info['PUBL'] = "";
	$info['ABBR'] = "";
	$info['REPO'] = "";
	$info['TEXT'] = "";

	return $info;
}

function getSourceRecord( $sourceID, $prevlevel ) {
	global $link, $sources_table, $events_table, $notelinks_table, $tree, $admtext, $savestate, $lineinfo, $stdnotes, $notecount, $custevents;
	global $custeventlist, $lineending, $currentuser, $tngimpcfg, $today, $prefix;

	$sourceID = adjustID( $sourceID, $savestate['soffset'], "S" );
	
	$prefix = "S";
	$info = initSource(); 
	$changedate = "";
	$events = array();
	$stdnotes = array();
	$notecount = 0;
	$custeventctr = 0;
	$mminfo = array();
	$mmcount = 0;
	$prevlevel++;
	
	$lineinfo = getLine( );
	while( $lineinfo['tag'] && $lineinfo['level'] >= $prevlevel ) {
		if( $lineinfo['level'] == $prevlevel ) {
			$tag = $lineinfo['tag'];
			switch( $tag ) {
				case "ABBR":
				case "AUTH":
				case "CALN":
				case "PUBL":
				case "TITL":
				case "REFN":
					$info[$tag] = addslashes( $lineinfo['rest'] );
					$info[$tag] .= getContinued();
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
				case "DATA":
					$lineinfo = getLine(); //text should start on next line;
				case "TEXT":
					$info['TEXT'] = addslashes($lineinfo['rest']);
					$info['TEXT'] .= getContinued();
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
						$ncitecount++;
						$stdnotes[$notecount]['SOUR'][$ncitecount] = handleSource( $sourceID, $prevlevel + 1 );
					}
					$notecount++;
					break;
				case "OBJE":
					if( $savestate['media'] ) {
						preg_match( "/^@(\S+)@/", $lineinfo['rest'], $matches );
						$mmcount++;
						$mminfo[$mmcount] = getMoreMMInfo( $lineinfo['level'], $mmcount );
						$mminfo[$mmcount]['OBJE'] = !empty($matches[1]) ? $matches[1] : $mminfo[$mmcount]['FILE'];
						$mminfo[$mmcount]['linktype'] = "S";
					}
					else
						$lineinfo = getLine();
					break;
				case "REPO":
					preg_match( "/^@(\S+)@/", $lineinfo['rest'], $matches );
					if( !empty($matches[1]) )
						$info['REPO'] = $matches[1];
					$lineinfo = getLine();
					if( $lineinfo['tag'] == "CALN" ) {
						$info['CALN'] = addslashes( $lineinfo['rest'] );
						$info['CALN'] .= getContinued();
					}
					break;
				default:
					//custom event -- should be 1 TAG
					$custeventctr++;
					$events[$custeventctr] = handleCustomEvent($sourceID,$prefix,$tag);
					break;
			}
		}
		else
			$lineinfo = getLine();
	}
	$inschangedt = $changedate ? $changedate : ($tngimpcfg['chdate'] ? "" : $today);
   	if(empty($info['CALN']) && !empty($info['REFN']))
		$info['CALN'] = $info['REFN'];
	if(empty($info['TITL']))
		$info['TITL'] = "";
	$query = "INSERT IGNORE INTO $sources_table (sourceID, callnum, title, author, publisher, shorttitle, repoID, actualtext, changedate, gedcom, changedby, type, other, comments)  VALUES(\"$sourceID\", \"{$info['CALN']}\", \"{$info['TITL']}\", \"{$info['AUTH']}\", \"{$info['PUBL']}\", \"{$info['ABBR']}\", \"{$info['REPO']}\", \"" . trim($info['TEXT']) . "\", \"$changedate\", \"$tree\", \"$currentuser\", \"\",\"\",\"\")";
	$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
	$success = tng_affected_rows();
	if( !$success && $savestate['del'] != "no" ) {
		if( $savestate['neweronly'] && $inschangedt ) {
			$query = "SELECT changedate FROM $sources_table WHERE sourceID=\"$sourceID\" AND gedcom = \"$tree\"";
			$result = @tng_query( $query );
			$srcrow = tng_fetch_assoc( $result );
			$goahead = $inschangedt  > $srcrow['changedate'] ? 1 : 0;
			if( $result ) tng_free_result( $result );
		}
		else
			$goahead = 1;
		if( $goahead ) {
			$chdatestr = $inschangedt ? ", changedate=\"$inschangedt\"" : "";
			$query = "UPDATE $sources_table SET callnum=\"{$info['CALN']}\", title=\"{$info['TITL']}\", author=\"{$info['AUTH']}\", publisher=\"{$info['PUBL']}\", shorttitle=\"{$info['ABBR']}\", repoID=\"{$info['REPO']}\", actualtext=\"" . trim($info['TEXT']) . "\", changedby=\"$currentuser\" $chdatestr WHERE sourceID=\"$sourceID\" AND gedcom = \"$tree\"";
			$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
			$success = 1;

			if( $savestate['del'] == "match" ) {
				//delete all custom events & notelinks for this source because we didn't before
				deleteLinksOnMatch( $sourceID );
			}
		}
	}
	if( $success ) {
		if( $custeventctr )
			saveCustEvents( $prefix, $sourceID, $events, $custeventctr );
		if( $notecount ) {
			for( $notectr = 0; $notectr < $notecount; $notectr++ )
				saveNote( $sourceID, $stdnotes[$notectr]['TAG'], $stdnotes[$notectr] );
		}
		if( $mmcount )
			processMedia( $mmcount, $mminfo, $sourceID, "" );

		incrCounter( $prefix );
	}
}

function getRestOfSource( $sourceID, $prevlevel ) {
	global $lineinfo, $lineending;
	
	$continued = "";
	$lasttag = "";
	
	$lineinfo = getLine( );
	while( $lineinfo['level'] > $prevlevel ) {
		if( $lineinfo['rest'] ) {
			if( $lineinfo['tag'] == "CONC" ) $continued .= addslashes($lineinfo['rest']);
			elseif ( $lineinfo['tag'] == "CONT" ) { 
				if( $continued ) $lineinfo['rest'] = "\n" . $lineinfo['rest'];
				$continued .= addslashes( $lineinfo['rest'] ); 
			}
			else {
				if( $lineinfo['tag'] != $lasttag ) {
					if( $continued ) $continued .= $lineending;
					$continued .= $lineinfo['tag'] . ":";
					$lasttag = $lineinfo['tag'];
				}
				if( $continued ) $lineinfo['rest'] = "\n" . $lineinfo['rest'];
				$continued .= addslashes($lineinfo['rest']);
			}
		}
		$lineinfo = getLine( );
	}
	return $continued;
}

function getRepoRecord( $repoID, $prevlevel ) {
	global $link, $repositories_table, $events_table, $notelinks_table, $tree, $admtext, $savestate, $lineinfo, $stdnotes, $notecount, $custevents;
	global $custeventlist, $lineending, $currentuser, $tngimpcfg, $today, $address_table, $prefix;

	$repoID = adjustID( $repoID, $savestate['roffset'], "R" );
	
	$prefix = "R";
	$info = array(); 
	$changedate = "";
	$events = array();
	$stdnotes = array();
	$notecount = 0;
	$custeventctr = 0;
	$mminfo = array();
	$mmcount = 0;
	$prevlevel++;
	
	$lineinfo = getLine( );
	while( $lineinfo['tag'] && $lineinfo['level'] >= $prevlevel ) {
		if( $lineinfo['level'] == $prevlevel ) {
			$tag = $lineinfo['tag'];
			switch( $tag ) {
				case "NAME":
					$info['NAME'] = addslashes( $lineinfo['rest'] ) . getContinued();
					break;
				case "ADDR":
					$address = handleAddress($lineinfo['level'], 1);
					$info['extra'] = 1;
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
						$stdnotes[$notecount]['NOTE'] = addslashes($lineinfo['rest']);
						$stdnotes[$notecount]['NOTE'] .= getContinued();
					}
					$ncitecount = 0;
					while( $lineinfo['level'] >= $prevlevel && $lineinfo['tag'] == "SOUR" ) {
						$ncitecount++;
						$stdnotes[$notecount]['SOUR'][$ncitecount] = handleSource( $repoID, $prevlevel + 1 );
					}
					$notecount++;
					break;
				case "OBJE":
					if( $savestate['media'] ) {
						preg_match( "/^@(\S+)@/", $lineinfo['rest'], $matches );
						$mmcount++;
						$mminfo[$mmcount] = getMoreMMInfo( $lineinfo['level'], $mmcount );
						$mminfo[$mmcount]['OBJE'] = !empty($matches[1]) ? $matches[1] : $mminfo[$mmcount]['FILE'];
						$mminfo[$mmcount]['linktype'] = "R";
					}
					else
						$lineinfo = getLine();
					break;
				default:
					//custom event -- should be 1 TAG
					$custeventctr++;
					$events[$custeventctr] = handleCustomEvent($repoID,$prefix,$tag);
					break;
			}
		}
		else
			$lineinfo = getLine();
	}
	$inschangedt = $changedate ? $changedate : ($tngimpcfg['chdate'] ? "" : $today);
	$query = "INSERT IGNORE INTO $repositories_table (repoID, reponame, changedate, gedcom, changedby)  VALUES(\"$repoID\", \"{$info['NAME']}\", \"$inschangedt\", \"$tree\", \"$currentuser\")";
	$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
	$success = tng_affected_rows();
	if( !$success && $savestate['del'] != "no" ) {
		if( $savestate['neweronly'] && $inschangedt ) {
			$query = "SELECT changedate FROM $repositories_table WHERE repoID=\"$repoID\" AND gedcom = \"$tree\"";
			$result = @tng_query( $query );
			$reporow = tng_fetch_assoc( $result );
			$goahead = $inschangedt  > $reporow['changedate'] ? 1 : 0;
			if( $result ) tng_free_result( $result );
		}
		else
			$goahead = 1;
		if( $goahead ) {
			$chdatestr = $inschangedt ? ", changedate=\"$inschangedt\"" : "";
			if(!isset($info['ADDR'])) $info['ADDR'] = 0;
			$query = "UPDATE $repositories_table SET reponame=\"{$info['NAME']}\", addressID=\"{$info['ADDR']}\", changedby=\"$currentuser\" $chdatestr WHERE repoID=\"$repoID\" AND gedcom = \"$tree\"";
			$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
			$success = 1;

			if( $savestate['del'] == "match" ) {
				//delete all custom events & notelinks for this source because we didn't before
				deleteLinksOnMatch( $repoID );
			}
		}
	}
	if( $success ) {
		if( $custeventctr )
			saveCustEvents( $prefix, $repoID, $events, $custeventctr );
		if( $notecount ) {
			for( $notectr = 0; $notectr < $notecount; $notectr++ )
				saveNote( $repoID, $stdnotes[$notectr]['TAG'], $stdnotes[$notectr] );
		}
		if( $mmcount )
			processMedia( $mmcount, $mminfo, $repoID, "" );
		if( !empty( $address ) ) {
			$query = "INSERT INTO $address_table (gedcom, address1, address2, city, state, zip, country, www, email, phone) VALUES(\"$tree\", \"{$address['ADR1']}\", \"{$address['ADR2']}\", \"{$address['CITY']}\", \"{$address['STAE']}\", \"{$address['POST']}\",  \"{$address['CTRY']}\", \"{$address['WWW']}\", \"{$address['EMAIL']}\", \"{$address['PHON']}\")";
			$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
			$info['ADDR'] = tng_insert_id();
			$query = "UPDATE $repositories_table SET addressID=\"{$info['ADDR']}\" WHERE repoID=\"$repoID\" AND gedcom = \"$tree\"";
			$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
		}
	}
}
?>