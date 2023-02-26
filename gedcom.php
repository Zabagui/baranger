<?php
$textpart = "gedcom";
include("tng_begin.php");

include($cms['tngpath'] . "version.php");

$gedcom_url = getURL( "gedcom", 1 );

@set_time_limit(0);
$allsources = array();
$allrepos = array();
$xnotes = array();
$citations = array();
$private = array();
$indarray = array();
$gotfamily = array();
$placelist = array();

$righttree = checktree($tree);
$ldsOK = determineLDSRights();

$query = "SELECT disallowgedcreate, email, owner FROM $trees_table WHERE gedcom = \"$tree\"";
$treeresult = tng_query($query);
$treerow = tng_fetch_assoc($treeresult);
if( $treerow['disallowgedcreate'] && (!$allow_ged || !$righttree) ) exit;
tng_free_result( $treeresult );

function getAncestor ( $person, $generation ) {
	global $tree, $maxgcgen, $indarray, $people_table, $text;

	$query = "SELECT personID, famc FROM $people_table WHERE personID = \"$person\" AND gedcom = \"$tree\"";
	$result = tng_query($query);
	if( $result ) {
		$ind = tng_fetch_assoc( $result );
		//do individual, but only do spouse if this is the first generation (all others covered as children of succeeding generations)
		if(!array_key_exists($ind['personID'],$indarray)) $indarray[$ind['personID']] = writeIndividual( $ind['personID'] );
		if( $generation == 1 ) {
			getDescendant( $ind['personID'], 0 );
		}

		if( $ind['famc'] && ( $generation <= $maxgcgen ) ) {
			getFamily( $person, $ind['famc'], $generation + 1 );
		}
		tng_free_result( $result );
	}
}

function getCitations( $persfamID ) {
	global $citations_table, $text, $tree;

	$citations = array();
	$citquery = "SELECT citationID, page, quay, citedate, citetext, note, sourceID, description, eventID FROM $citations_table WHERE persfamID = \"$persfamID\" AND gedcom = \"$tree\" ORDER BY eventID";
	$citresult = tng_query($citquery) or die ($text['cannotexecutequery'] . ": $query");

	while( $cite = tng_fetch_assoc( $citresult ) ) {
		$eventID = $cite['eventID'] ? $cite['eventID'] : "-x--general--x-";
		$citations[$eventID][] = array( "page" => $cite['page'], "quay" => $cite['quay'], "citedate" => $cite['citedate'], "citetext" => $cite['citetext'], "note" => $cite['note'], "sourceID" => $cite['sourceID'], "description" => $cite['description'] );
	}
	return $citations;
}

function writeCitation( $citelist, $level ) {
	global $allsources, $lineending;
	
	$levelplus1 = $level + 1;
	$citestr = "";
	
	if(is_array($citelist)) {
		$citecount = count( $citelist );
		if( $citecount ) {
			foreach( $citelist as $cite ) {
				if( $cite['sourceID'] ) {
					array_push( $allsources, $cite['sourceID'] );
					$citestr .= "$level SOUR @" . trim($cite['sourceID']) . "@$lineending";
					if( $cite['citedate'] || $cite['citetext'] ) {
						$levelplus2 = $level + 2;
						$citestr .= "$levelplus1 DATA$lineending";
						if( $cite['citedate'] )
							$citestr .= "$levelplus2 DATE {$cite['citedate']}$lineending";
						if( $cite['citetext'] )
							$citestr .= doNote( $levelplus2, "TEXT", $cite['citetext'] );
					}
				}
				else {
					$citestr = "$level SOUR {$cite['description']}$lineending";
					if( $cite['citetext'] )
						$citestr .= doNote( $levelplus1, "TEXT", $cite['citetext'] );
				}
				if( $cite['page'] ) $citestr .= doNote( $levelplus1, "PAGE", $cite['page'] );
				if( $cite['quay'] && $cite['quay'] != "0" ) $citestr .= "$levelplus1 QUAY {$cite['quay']}$lineending";
				if( $cite['note'] ) $citestr .= doNote( $levelplus1, "NOTE", $cite['note'] );
			}
		}
	}

	return $citestr;
}

function getFact( $row, $level ) {
	global $tree, $address_table, $text, $lineending;
	
	$fact = "";
	if( $row['age'] ) $fact .= "$level AGE {$row['age']}$lineending";
	if( $row['agency'] ) $fact .= "$level AGNC {$row['agency']}$lineending";
	if( $row['cause'] ) $fact .= "$level CAUS {$row['cause']}$lineending";
	if( $row['addressID'] ) {
		$query = "SELECT address1, address2, city, state, zip, country, phone, www, email FROM $address_table WHERE addressID = \"{$row['addressID']}\" AND gedcom = \"$tree\"";
		$addrresults = tng_query($query);
		$addr = tng_fetch_assoc( $addrresults );
		if( $row['tag'] != "ADDR" ) {
   			$fact .= "$level ADDR$lineending";
			$level++;
		}
		if( $addr['address1'] ) $fact .= "$level ADR1 {$addr['address1']}$lineending";
		if( $addr['address2'] ) $fact .= "$level ADR2 {$addr['address2']}$lineending";
		if( $addr['city'] ) $fact .= "$level CITY {$addr['city']}$lineending";
		if( $addr['state'] ) $fact .= "$level STAE {$addr['state']}$lineending";
		if( $addr['zip'] ) $fact .= "$level POST {$addr['zip']}$lineending";
		if( $addr['country'] ) $fact .= "$level CTRY {$addr['country']}$lineending";
		if( $addr['phone'] ) $fact .= "$level PHON {$addr['phone']}$lineending";
		if( $addr['email'] ) $fact .= "$level EMAIL {$addr['email']}$lineending";
		if( $addr['www'] ) $fact .= "$level WWW {$addr['www']}$lineending";
	}
	return $fact;
}

function getStdExtras( $persfamID, $level ) {
	global $tree, $events_table, $text;
	
	$stdex = array();
	$query = "SELECT age, agency, cause, addressID, parenttag FROM $events_table WHERE persfamID = \"$persfamID\" AND gedcom = \"$tree\" AND parenttag != \"\" ORDER BY parenttag";
	$stdextras = tng_query($query);
	while ( $stdextra = tng_fetch_assoc( $stdextras ) ) {
		$stdex[$stdextra['parenttag']] = getFact( $stdextra, $level );
	}
	return $stdex;
}

function doEvent( $custevent, $level ) {
	global $lineending;
	
	$infolen = strlen($custevent['info']);
	if( $custevent['tag'] != "EVEN" || $infolen < 150 )
		$info = doNote($level,$custevent['tag'],$custevent['info']);
	else
		$info = "$level " . $custevent['tag'] . $lineending;
	$nextlevel = $level + 1;
	if( $custevent['description'] ) $info .= "2 TYPE {$custevent['description']}$lineending";
	if( $custevent['eventdate'] )  $info .= "2 DATE {$custevent['eventdate']}$lineending";
	if( $custevent['eventplace'] ) {
		$info .= "2 PLAC {$custevent['eventplace']}$lineending";
		savePlace($custevent['eventplace']);
	}
	if( $custevent['tag'] == "EVEN" && $infolen >= 150 )
		$info .= doNote($nextlevel,"NOTE",$custevent['info']);

	return $info;
}

function getNotes( $id ) {
	global $notelinks_table, $xnotes_table, $tree, $eventtypes_table, $events_table, $text, $xnotes;
	
	$query = "SELECT $notelinks_table.ID as ID, secret, $xnotes_table.note as note, $xnotes_table.noteID as noteID, $notelinks_table.eventID
		FROM $notelinks_table
		LEFT JOIN  $xnotes_table on $notelinks_table.xnoteID = $xnotes_table.ID AND $notelinks_table.gedcom = $xnotes_table.gedcom
		LEFT JOIN $events_table ON $notelinks_table.eventID = $events_table.eventID
		LEFT JOIN $eventtypes_table on $eventtypes_table.eventtypeID = $events_table.eventtypeID
		WHERE $notelinks_table.persfamID=\"$id\" AND $notelinks_table.gedcom =\"$tree\"
		ORDER BY eventdatetr, $eventtypes_table.ordernum, tag, $notelinks_table.ordernum";
	$notelinks = tng_query($query);
	$notearray = array();
	while( $notelink = tng_fetch_assoc( $notelinks ) ) {
		$eventid = $notelink['eventID'] ? $notelink['eventID'] : "-x--general--x-";
		$newnote = $notelink['noteID'] ? "@{$notelink['noteID']}@" : $notelink['note'];
		if( !isset($notearray[$eventid]) || !is_array( $notearray[$eventid] ) ) $notearray[$eventid] = array();
		//array_push( $notearray[$eventid], $newnote );
		$innerarray = array();
		$innerarray['text'] = $newnote;
		$innerarray['id'] = "N" . $notelink['ID'];
		$innerarray['private'] = $notelink['secret'];
		array_push( $notearray[$eventid], $innerarray );

		if( $notelink['noteID'] && !in_array( $notelink['noteID'], $xnotes ) )
			array_push( $xnotes, $notelink['noteID'] );
	}
	tng_free_result( $notelinks );

	return $notearray;
}

function getNoteLine($level, $label, $note, $delta) {
	global $lineending, $session_charset; // added $session_charset to fix UTF-8 problem

	$noteconc = "";
	$notelen = strlen( $note );
	if( $notelen > 245 ) {
		$orgnote = trim($note);
		$offset = 245;
		if($session_charset == "UTF-8" && function_exists('mb_substr')) {
			while( mb_substr($orgnote, $offset, 1, 'UTF-8') == " " || mb_substr($orgnote, $offset - 1, 1, 'UTF-8') == " ") {
				$offset--;
			}
			$note = mb_substr( $note, 0, $offset, 'UTF-8' );
		}
		else {

		while( substr( $orgnote, $offset, 1 ) == " " || substr( $orgnote, $offset - 1, 1 ) == " " ) {
			$offset--;
		}
			$note = substr( $note, 0, $offset );   // moved line above close - Réal
		}


		$newlevel = $level + $delta;
		while( $offset < $notelen ) {
			$endnext = 245;
			if($session_charset == "UTF-8" && function_exists('mb_substr')) {
				while( mb_substr($orgnote, $offset + $endnext, 1, 'UTF-8') == " " || mb_substr($orgnote, $offset + $endnext - 1, 1, 'UTF-8') == " ") {
					$offset--;
				}
				$nextpart = trim(mb_substr( $orgnote, $offset, $endnext, 'UTF-8' ),$lineending) ;
			}
			else {
				while( substr( $orgnote, $offset + $endnext, 1 ) == " " || substr( $orgnote, $offset + $endnext - 1, 1 ) == " " ) {
					$endnext--;
				}
				$nextpart = trim(substr( $orgnote, $offset, $endnext ),$lineending);
			}
			$noteconc .= trim("$newlevel CONC $nextpart") . $lineending;
			$offset += $endnext;
		}
	}

	return trim("$level $label $note") . "$lineending$noteconc";
}

function doNote( $level, $label, $notetxt, $private = "" ) {
	$noteinfo = "";
	$notetxt = str_replace("\r","",$notetxt);
	if(!preg_match('/^@.+@$/',$notetxt))
		$notetxt = str_replace("@","@@",$notetxt);
	$notes = is_string($notetxt) ? preg_split('/\r\n|\n/', $notetxt) : array();
	//$note = trim( array_shift( $notes ) );
	if($level) {
		$note = array_shift( $notes );
		$noteinfo .= getNoteLine($level, $label, $note, 1);
	}
	$level++;
	foreach ( $notes as $note ) {
		//$note = trim($note);
		$noteinfo .= getNoteLine($level,"CONT",$note, 0);
	}
	if($private) 
		$noteinfo .= getNoteLine($level,"_PRIVATE","Y",0);

	return $noteinfo;
}

function writeNote( $level, $label, $notes ) {
	global $citations;

	$noteinfo = "";
	if( is_array( $notes ) ) {
		foreach( $notes as $notearray ) {
			$noteinfo .= doNote( $level, $label, $notearray['text'], $notearray['private'] );
		 	$id = $notearray['id'];
			if( !empty($citations[$id]) )
				$noteinfo .= writeCitation( $citations[$id], $level + 1 );
		}
	}
	elseif( $notes )
		$noteinfo .= doNote( $level, $label, $notes );
	return $noteinfo;
}

function doXNotes( ) {
	global $xnotes_table, $tree, $text, $xnotes, $lineending;
	
	if( $xnotes ) {
		$xnoteinfo = "";
		foreach ( $xnotes as $xnote ) {
			$query = "SELECT note FROM $xnotes_table WHERE gedcom =\"$tree\" AND noteID = \"$xnote\" ORDER BY noteID";
			$xnotearray = tng_query($query);
			$xnotetxt = tng_fetch_assoc( $xnotearray );
			echo "0 @$xnote@ NOTE$lineending";
			echo doNote(0,"NOTE",$xnotetxt['note']);
			
			//$notes = split ( chr(10), $xnotetxt['note'] );
			//foreach ( $notes as $note ) {
				//echo "1 CONT $note$lineending";
			//}
			tng_free_result( $xnotearray );
		}
	}
}

function getFamily ( $person, $parents, $generation ) {
	global $tree, $famarray, $indarray, $families_table, $children_table, $people_table, $text, $lineending, $gotfamily;

	$query = "SELECT *, DATE_FORMAT(changedate,\"%d %b %Y\") as changedate FROM $families_table WHERE familyID = \"$parents\" AND gedcom = \"$tree\"";
	$result = tng_query($query);
	if( $result ) {
		$family = tng_fetch_assoc( $result );
		tng_free_result( $result );

		if(empty($gotfamily[$parents])) {
			$famarray[$parents] = writeFamily( $family );
			$gotfamily[$parents] = true;

			if( $family['husband'] ) {
				getAncestor( $family['husband'], $generation );
				$query = "SELECT *, DATE_FORMAT(changedate,\"%d %b %Y\") as changedate FROM $families_table WHERE husband = \"{$family['husband']}\" AND gedcom = \"$tree\" ORDER BY husborder";
				$result = tng_query($query);
				if( $result ) {
					while( $spouse = tng_fetch_assoc( $result ) ) {
						if( $spouse['wife'] != $family['wife'] ) {
							if(!array_key_exists($spouse['wife'],$indarray)) $indarray[$spouse['wife']] = writeIndividual( $spouse['wife'] );
							if(!strstr($indarray[$spouse['wife']],"1 FAMS @{$spouse['familyID']}@")) $indarray[$spouse['wife']] .= "1 FAMS @{$spouse['familyID']}@$lineending";
							$famarray[$spouse['familyID']] = writeFamily( $spouse );
						}
						if(!strstr($indarray[$family['husband']],"1 FAMS @{$spouse['familyID']}@")) $indarray[$family['husband']] .= "1 FAMS @{$spouse['familyID']}@$lineending";
					}
					tng_free_result( $result );
				}
			}

			if( $family['wife'] ) {
				getAncestor( $family['wife'], $generation );
				$query = "SELECT *, DATE_FORMAT(changedate,\"%d %b %Y\") as changedate FROM $families_table WHERE wife = \"{$family['wife']}\" AND gedcom = \"$tree\" ORDER BY wifeorder";
				$result = tng_query($query);
				if( $result ) {
					while( $spouse = tng_fetch_assoc( $result ) ) {
						if( $spouse['husband'] != $family['husband'] ) {
							if(!array_key_exists($spouse['husband'],$indarray)) $indarray[$spouse['husband']] = writeIndividual( $spouse['husband'] );
							if(!strstr($indarray[$spouse['husband']],"1 FAMS @{$spouse['familyID']}@")) $indarray[$spouse['husband']] .= "1 FAMS @{$spouse['familyID']}@$lineending";
							$famarray[$spouse['familyID']] = writeFamily( $spouse );
						}
						if(!strstr($indarray[$family['wife']],"1 FAMS @{$spouse['familyID']}@")) $indarray[$family['wife']] .= "1 FAMS @{$spouse['familyID']}@$lineending";
					}
					tng_free_result( $result );
				}
			}
			if( $generation > 1 ) {
				$query = "SELECT familyID, $children_table.personID as personID, sealdate, sealplace, mrel, frel, living, private, $children_table.gedcom, branch, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr FROM $children_table, $people_table WHERE familyID = \"$parents\" AND $children_table.gedcom = \"$tree\" AND $children_table.personID = $people_table.personID AND $children_table.gedcom = $people_table.gedcom ORDER BY ordernum";
				$result = tng_query($query);
				if( $result ) {
					while( $child = tng_fetch_assoc( $result ) ) {
						if( $child['personID'] != $person ) {
							if(!array_key_exists($child['personID'],$indarray)) $indarray[$child['personID']] = writeIndividual( $child['personID'] );
							getDescendant( $child['personID'], 0 );
						}
						$indarray[$child['personID']] .= appendParents( $child );
						$famarray[$parents] .= "1 CHIL @{$child['personID']}@$lineending";
						if($child['frel'])
							$famarray[$family['familyID']] .= "2 _FREL " . ucfirst($child['frel']) . "$lineending";
						if($child['mrel'])
							$famarray[$family['familyID']] .= "2 _MREL " . ucfirst($child['mrel']) . "$lineending";
					}
					tng_free_result( $result );
				}
			}
		}
	}
}

function appendParents( $child ) {
	global $ldsOK, $lineending, $indarray, $righttree;

	$info = "";
	if(!strstr($indarray[$child['personID']],"1 FAMC @{$child['familyID']}@")) $info = "1 FAMC @{$child['familyID']}@$lineending";
	$crights = determineLivingPrivateRights($child, $righttree);
	$child['allow_living'] = $crights['living'];
	$child['allow_private'] = $crights['private'];
	if( $crights['both'] ) {
		//if( $child['relationship'] ) $info .= "2 PEDI {$child['relationship']}$lineending";
		if( $crights['lds'] && $ldsOK ) {
			if( $child['sealdate'] || $child['sealplace'] ) {
				$childnotes = getNotes( $child['personID'] );
				$citations = getCitations( $child['personID'] . $child['familyID'] );

				$info .= "1 SLGC$lineending";
				$info .= "2 FAMC @{$child['familyID']}@$lineending";
				if( $child['sealdate'] ) { $info .= "2 DATE {$child['sealdate']}$lineending"; }
				if( $child['sealplace'] ) { 
					$tok = strtok ($child['sealplace']," ");
					if( strlen( $tok ) == 5 ) {
						$info .= "2 TEMP $tok$lineending"; 
						$tok = strtok( " " );
						if( $tok ) {
							$info .= "2 PLAC $tok$lineending"; 
							savePlace($tok);
						}
					}
					else {
						$info .= "2 PLAC {$child['sealplace']}$lineending"; 
						savePlace($chile['sealplace']);
					}
				}
				if( !empty($childnotes['SLGC']) )
					$info .= writeNote( 2, "NOTE", $childnotes['SLGC'] );
				if( !empty($citations['SLGC']) ) {
					$info .= writeCitation( $citations['SLGC'], 2 );
				}
			}
		}
	}
	return $info;
}

function writeIndividual( $person ) {
	global $tree, $ldsOK, $people_table, $events_table, $eventtypes_table, $text, $admtext, $citations, $lnprefixes, $assoc_table, $lineending, $private, $righttree;

	$query = "SELECT lastname, lnprefix, firstname, sex, title, prefix, suffix, nameorder, nickname, birthdate, birthplace, altbirthtype, altbirthdate, altbirthplace, deathdate, deathplace, burialdate, burialplace, burialtype, baptdate, baptplace, confdate, confplace, initdate, initplace, endldate, endlplace, famc, living, private, gedcom, branch, DATE_FORMAT(changedate,\"%d %b %Y\") as changedate FROM $people_table WHERE personID = \"$person\" AND gedcom = \"$tree\"";
	$result = tng_query($query);
	$ind = tng_fetch_assoc( $result );
	$info = "";
	if( $ind ) {
		if($ind['private']) array_push($private, $person);
		if(empty($ind['altbirthtype'])) $ind['altbirthtype'] = "CHR";
		$rights = determineLivingPrivateRights($ind, $righttree);
		$ind['allow_living'] = $rights['living'];
		$ind['allow_private'] = $rights['private'];
		if( $rights['both'] )
			$indnotes = getNotes( $person );
		else
			$indnotes = array();
		
		$citations = getCitations( $person );
		$extras = getStdExtras( $person, 2 );
		
		$info = "0 @$person@ INDI$lineending";
		if( $rights['both'] ) {
   			$info .= "1 NAME {$ind['firstname']} /" . trim( $ind['lnprefix'] . " " . $ind['lastname'] ) . "/";
			$info .= $ind['suffix'] ? " {$ind['suffix']}$lineending" : $lineending;
   			if( $ind['firstname'] ) $info .= "2 GIVN {$ind['firstname']}$lineending";
			if( $lnprefixes && $ind['lnprefix'] ) $info .= "2 SPFX {$ind['lnprefix']}$lineending";
			if( $ind['lastname'] ) $info .= "2 SURN {$ind['lastname']}$lineending";

			if( !empty($indnotes['NAME']) )
				$info .= writeNote( 2, "NOTE", $indnotes['NAME'] );
			if( $ind['prefix'] ) {
				$info .= "2 NPFX {$ind['prefix']}$lineending";
				if( !empty($indnotes['NPFX']) )
					$info .= writeNote( 3, "NOTE", $indnotes['NPFX'] );
			}
			if( $ind['suffix'] ) {
				$info .= "2 NSFX {$ind['suffix']}$lineending";
				if( !empty($indnotes['NSFX']) )
					$info .= writeNote( 3, "NOTE", $indnotes['NSFX'] );
			}
			if( $ind['nickname'] ) {
				$info .= "2 NICK {$ind['nickname']}$lineending";
				if( !empty($indnotes['NICK']) )
					$info .= writeNote( 3, "NOTE", $indnotes['NICK'] );
			}
			if( !empty($citations['NAME']) )
				$info .= writeCitation( $citations['NAME'], 2 );
			if( $ind['title'] ) {
				$info .= "1 TITL {$ind['title']}$lineending";
				if( !empty($indnotes['TITL']) )
					$info .= writeNote( 2, "NOTE", $indnotes['TITL'] );
			}
			$info .= "1 SEX {$ind['sex']}$lineending";
			if($ind['living'])
				$info .= "1 _LIVING Y$lineending";
			if($ind['private'])
				$info .= "1 _PRIVATE Y$lineending";
			if( !empty($citations['-x--general--x-']) )
				$info .= writeCitation( $citations['-x--general--x-'], 1 );
		}
		elseif(showNames($ind) == 2)
			$info .= "1 NAME " . initials( $ind['firstname'] ) . " /" . trim($ind['lnprefix'] . " " . $ind['lastname']) . "/$lineending";
		elseif( $ind['private'] )
			$info .= "1 NAME {$admtext['text_private']} //$lineending";
		else
			$info .= "1 NAME {$text['living']} //$lineending";

		if( $rights['both'] ) {
			if( $ind['birthdate'] || $ind['birthplace'] || !empty($indnotes['BIRT']) || !empty($citations['BIRT']) || !empty($extras['BIRT']) ) {
				if( $ind['birthdate'] == "Y" || (!$ind['birthdate'] && !$ind['birthplace']))
					$info .= "1 BIRT Y$lineending";
				else {
					$info .= "1 BIRT$lineending";
					if( $ind['birthdate'] ) { $info .= "2 DATE {$ind['birthdate']}$lineending"; }
					if( $ind['birthplace'] ) {
						$info .= "2 PLAC {$ind['birthplace']}$lineending";
						savePlace($ind['birthplace']);
					}
				}
				if( !empty($indnotes['BIRT']) )
					$info .= writeNote( 2, "NOTE", $indnotes['BIRT'] );
				if( !empty($citations['BIRT']) )
					$info .= writeCitation( $citations['BIRT'], 2 );
				if( !empty($extras['BIRT']) )
					$info .= $extras['BIRT'];
			}
			if( $ind['altbirthdate'] || $ind['altbirthplace'] || !empty($indnotes[$ind['altbirthtype']]) || !empty($citations[$ind['altbirthtype']]) || !empty($extras[$ind['altbirthtype']]) ) {
				if( $ind['altbirthdate'] == "Y" || (!$ind['altbirthdate'] && !$ind['altbirthplace']))
					$info .= "1 {$ind['altbirthtype']} Y$lineending";
				else {
					$info .= "1 {$ind['altbirthtype']}$lineending";
					if( $ind['altbirthdate'] ) { $info .= "2 DATE {$ind['altbirthdate']}$lineending"; }
					if( $ind['altbirthplace'] ) {
						$info .= "2 PLAC {$ind['altbirthplace']}$lineending";
						savePlace($ind['altbirthplace']);
					}
				}
				if( !empty($indnotes[$ind['altbirthtype']]) )
					$info .= writeNote( 2, "NOTE", $indnotes[$ind['altbirthtype']] );
				if( !empty($citations[$ind['altbirthtype']]) )
					$info .= writeCitation( $citations[$ind['altbirthtype']], 2 );
				if( !empty($extras[$ind['altbirthtype']]) )
					$info .= $extras[$ind['altbirthtype']];
			}
			if( $ind['deathdate'] || $ind['deathplace'] || !empty($indnotes['DEAT']) || !empty($citations['DEAT']) || !empty($extras['DEAT']) ) {
				if( $ind['deathdate'] == "Y" || (!$ind['deathdate'] && !$ind['deathplace']))
					$info .= "1 DEAT Y$lineending";
				else {
					$info .= "1 DEAT$lineending";
					if( $ind['deathdate'] ) { $info .= "2 DATE {$ind['deathdate']}$lineending"; }
					if( $ind['deathplace'] ) {
						$info .= "2 PLAC {$ind['deathplace']}$lineending";
						savePlace($ind['deathplace']);
					}
				}
				if( !empty($indnotes['DEAT']) )
					$info .= writeNote( 2, "NOTE", $indnotes['DEAT'] );
				if( !empty($citations['DEAT']) )
					$info .= writeCitation( $citations['DEAT'], 2 );
				if( !empty($extras['DEAT']) )
					$info .= $extras['DEAT'];
			}
			if( $ind['burialdate'] || $ind['burialplace'] || !empty($indnotes['BURI']) || !empty($citations['BURI']) || !empty($extras['BURI']) ) {
				$btag = $ind['burialtype'] ? "CREM" : "BURI";
				if( $ind['burialdate'] == "Y" || (!$ind['burialdate'] && !$ind['burialplace']))
					$info .= "1 $btag Y$lineending";
				else {
					$info .= "1 $btag$lineending";
					if( $ind['burialdate'] ) { $info .= "2 DATE {$ind['burialdate']}$lineending"; }
					if( $ind['burialplace'] ) {
						$info .= "2 PLAC {$ind['burialplace']}$lineending";
						savePlace($ind['burialplace']);
					}
				}
				if( !empty($indnotes['BURI']) )
					$info .= writeNote( 2, "NOTE", $indnotes['BURI'] );
				if( !empty($citations['BURI']) )
					$info .= writeCitation( $citations['BURI'], 2 );
				if( !empty($extras['BURI']) )
					$info .= $extras['BURI'];
			}

			$query = "SELECT tag, description, eventdate, eventplace, age, agency, cause, addressID, info, eventID FROM $events_table, $eventtypes_table WHERE persfamID = \"$person\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID AND parenttag = \"\" AND gedcom = \"$tree\" AND keep = \"1\" ORDER BY ordernum";
			$custevents = tng_query($query);
			while ( $custevent = tng_fetch_assoc( $custevents ) ) {
				$info .= doEvent( $custevent, 1 );
				$eventID = $custevent['eventID'];
				if( !empty($indnotes[$eventID]) )
					$info .= writeNote( 2, "NOTE", $indnotes[$eventID] );
				if( !empty($citations[$eventID]) )
					$info .= writeCitation( $citations[$eventID], 2 );
				$info .= getFact( $custevent, 2 );
			}

			if( $rights['lds'] && $ldsOK ) {
				$info .= doLDSEvent("BAPL", "bapt", $indnotes['BAPL'], $citations['BAPL'], $extras['BAPL'], $ind);
				$info .= doLDSEvent("CONL", "conf", $indnotes['CONL'], $citations['CONL'], $extras['CONL'], $ind);
				$info .= doLDSEvent("_INIT", "init", $indnotes['INIT'], $citations['INIT'], $extras['INIT'], $ind);
				$info .= doLDSEvent("ENDL", "endl", $indnotes['ENDL'], $citations['ENDL'], $extras['ENDL'], $ind);
			}
			//do associations
			$query = "SELECT passocID, relationship FROM $assoc_table WHERE gedcom = \"$tree\" AND personID = \"$person\"";
			$assocresult = tng_query($query);
			while($assoc = tng_fetch_assoc( $assocresult ) ) {
				$info .= "1 ASSO @{$assoc['passocID']}@$lineending";
				if( $assoc['relationship'] ) $info .= "2 RELA {$assoc['relationship']}$lineending";
			}

			if( !empty($indnotes['-x--general--x-']) )
				$info .= writeNote( 1, "NOTE", $indnotes['-x--general--x-'] );

			if($ind['changedate']) {
				$info .= "1 CHAN$lineending";
				$info .= "2 DATE {$ind['changedate']}$lineending";
			}

		}
		tng_free_result( $result );
	}
	return $info;
}

function doLDSEvent($tag, $key, $notes, $citations, $extras, $row) {
	global $lineending;

	$event = "";
	if( $row[$key.'date'] || $row[$key.'place'] ) {
		$event .= "1 $tag$lineending";
		if( $row[$key.'date'] ) { $event .= "2 DATE {$row[$key.'date']}$lineending"; }
		if( $row[$key.'place'] ) {
			$tok = strtok ($row[$key.'place']," ");
			if( strlen( $tok ) == 5 ) {
				$event .= "2 TEMP $tok$lineending";
				$tok = strtok( " " );
				if( $tok ) {
					$event .= "2 PLAC $tok$lineending";
					savePlace($tok);
				}
			}
			else {
				$info .= "2 PLAC {$row[$key.'place']}$lineending";
				savePlace($row[$key.'place']);
			}
		}
		if( $notes )
			$event .= writeNote( 2, "NOTE", $notes );
		if( $citations )
			$event .= writeCitation( $citations, 2 );
		$event .= $extras;
	}
	return $event;
}

function writeFamily( $family ) {
	global $tree, $ldsOK, $events_table, $eventtypes_table, $text, $citations, $lineending, $famarray, $private, $righttree;

	$familyID = $family['familyID'];
	if(!empty($famarray[$familyID])) return $famarray[$familyID];

	$frights = determineLivingPrivateRights($family, $righttree);
	$family['allow_living'] = $frights['living'];
	$family['allow_private'] = $frights['private'];

	$info = "0 @$familyID@ FAM$lineending";
	if( $family['status'] ) { $info .= "1 _STAT {$family['status']}$lineending"; }
	if( $family['husband'] )
		$info .= "1 HUSB @{$family['husband']}@$lineending";
	if( $family['wife'] )
		$info .= "1 WIFE @{$family['wife']}@$lineending";

	//look up husband, look up wife, get living

	if( $frights['both'] ) {
		$famnotes = getNotes( $familyID );
		$citations = getCitations( $familyID );
		$extras = getStdExtras( $familyID, 2 );
		if(!in_array($family['husband'],$private) && !in_array($family['wife'],$private)) {
			if( $family['marrdate'] || $family['marrplace'] || !empty($famnotes['MARR']) || !empty($citations['MARR']) || !empty($extras['MARR']) || $family['marrtype'] ) {
				if( $family['marrdate'] == "Y" || (!$family['marrdate'] && !$family['marrplace']))
					$info .= "1 MARR Y$lineending";
				else {
					$info .= "1 MARR$lineending";
					if( $family['marrdate'] ) { $info .= "2 DATE {$family['marrdate']}$lineending"; }
					if( $family['marrplace'] ) {
						$info .= "2 PLAC {$family['marrplace']}$lineending";
						savePlace($family['marrplace']);
					}
				}
				if($family['marrtype']) $info .= "2 TYPE " . $family['marrtype'] . $lineending;
				if( !empty($famnotes['MARR']) )
					$info .= writeNote( 2, "NOTE", $famnotes['MARR'] );
				if( !empty($citations['MARR']) )
					$info .= writeCitation( $citations['MARR'], 2 );
				if( !empty($extras['MARR']) )
					$info .= $extras['MARR'];
			}
			if( $family['divdate'] || $family['divplace'] || !empty($famnotes['DIV']) || !empty($citations['DIV']) || !empty($extras['DIV']) ) {
				if( $family['divdate'] == "Y" || (!$family['divdate'] && !$family['divplace']))
					$info .= "1 DIV Y$lineending";
				else {
					$info .= "1 DIV$lineending";
					if( $family['divdate'] ) { $info .= "2 DATE {$family['divdate']}$lineending"; }
					if( $family['divplace'] ) {
						$info .= "2 PLAC {$family['divplace']}$lineending";
						savePlace($family['divplace']);
					}
				}
				if( !empty($famnotes['DIV']) )
					$info .= writeNote( 2, "NOTE", $famnotes['DIV'] );
				if( !empty($citations['DIV']) )
					$info .= writeCitation( $citations['DIV'], 2 );
				if( !empty($extras['DIV']) )
					$info .= $extras['DIV'];
			}

			$query = "SELECT tag, description, eventdate, eventplace, age, agency, cause, addressID, info, eventID FROM $events_table, $eventtypes_table WHERE persfamID = \"$familyID\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID AND parenttag = \"\" AND gedcom = \"$tree\" AND keep = \"1\" ORDER BY ordernum";
			$custevents = tng_query($query);
			while ( $custevent = tng_fetch_assoc( $custevents ) ) {
				$info .= doEvent( $custevent, 1 );
				$eventID = $custevent['eventID'];
				if( !empty($famnotes[$eventID]) )
					$info .= writeNote( 2, "NOTE", $famnotes[$eventID] );
				if( !empty($citations[$eventID]) )
					$info .= writeCitation( $citations[$eventID], 2 );
				$info .= getFact( $custevent, 2 );
			}

			if( $frights['lds'] && $ldsOK ) {
				if( $family['sealdate'] || $family['sealplace'] ) {
					$info .= "1 SLGS$lineending";
					if( $family['sealdate'] ) { $info .= "2 DATE {$family['sealdate']}$lineending"; }
					if( $family['sealplace'] ) {
						$tok = strtok ($family['sealplace']," ");
						if( strlen( $tok ) == 5 ) {
							$info .= "2 TEMP $tok$lineending";
							$tok = strtok( " " );
							if( $tok ) {
								$info .= "2 PLAC $tok$lineending";
								savePlace($tok);
							}
						}
						else {
							$info .= "2 PLAC {$fam['sealplace']}$lineending";
							savePlace($fam['sealplace']);
						}
					}
					if( !empty($famnotes['SLGS']) )
						$info .= writeNote( 2, "NOTE", $famnotes['SLGS'] );
					if( !empty($citations['SLGS']) )
						$info .= writeCitation( $citations['SLGS'], 2 );
					if( !empty($extras['SLGS']) )
						$info .= $extras['SLGS'];
				}
			}
			if( !empty($citations['NAME']) )
				$info .= writeCitation( $citations['NAME'], 1 );

			if( !empty($famnotes['-x--general--x-']) )
				$info .= writeNote( 1, "NOTE", $famnotes['-x--general--x-'] );
		}
		if($family['changedate']) {
			$info .= "1 CHAN$lineending";
			$info .= "2 DATE {$family['changedate']}$lineending";
		}
	}

	return $info;
}

function processEntities ( $entarray ) {
	if( is_array( $entarray ) ) {
		foreach( $entarray as $thisent ) {
			echo $thisent;
		}
	}
}

function getDescendant( $person, $generation ) {
	global $tree, $maxgcgen, $famarray, $indarray, $families_table, $children_table, $people_table, $text, $lineending;

	$result = getPersonGender($tree, $person);
	$row = tng_fetch_assoc($result);
	if($row['sex'] == "M") {
		$orderby = " ORDER BY husborder";
	}
	elseif($row['sex'] == "F") {
		$orderby = " ORDER BY wifeorder";
	}
	else {
		$orderfield = $orderby = "";
	}
	tng_free_result($result);
	$query = "(SELECT *, DATE_FORMAT(changedate,\"%d %b %Y\") as changedate FROM $families_table WHERE husband = \"$person\" AND gedcom = \"$tree\") UNION (SELECT *, DATE_FORMAT(changedate,\"%d %b %Y\") as changedate FROM $families_table WHERE wife = \"$person\" AND gedcom = \"$tree\")$orderby";
	$result = tng_query($query);
	if( $result ) {
		while( $family = tng_fetch_assoc( $result ) ) {
			if( empty($famarray[$family['familyID']]) ) {
				if( $family['husband'] == $person ) {
					$self = "husband";
					$spouse = "wife";
				}
				else {
					$self = "wife";
					$spouse = "husband";
				}
				$famarray[$family['familyID']] = writeFamily( $family );
				if(!array_key_exists($family[$spouse],$indarray)) $indarray[$family[$spouse]] = writeIndividual( $family[$spouse] );
				if(!strstr($indarray[$family[$spouse]],"1 FAMS @{$family['familyID']}@")) $indarray[$family[$spouse]] .= "1 FAMS @{$family['familyID']}@$lineending";
				if(!strstr($indarray[$person],"1 FAMS @{$family['familyID']}@")) $indarray[$person] .= "1 FAMS @{$family['familyID']}@$lineending";
				if( $generation > 0 && $generation <= $maxgcgen ) {
					$query = "SELECT $children_table.personID as personID, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr, familyID, mrel, frel, living, private, $children_table.gedcom, branch FROM $children_table, $people_table WHERE familyID = \"{$family['familyID']}\" AND $children_table.personID = $people_table.personID AND $children_table.gedcom = \"$tree\" AND $people_table.gedcom = \"$tree\" ORDER BY ordernum";
					$result2 = tng_query($query);
					if( $result2 ) {
						while( $child = tng_fetch_assoc( $result2 ) ) {
							if(!array_key_exists($child['personID'],$indarray)) $indarray[$child['personID']] = writeIndividual( $child['personID'] );
							$indarray[$child['personID']] .= appendParents( $child );
							$famarray[$family['familyID']] .= "1 CHIL @{$child['personID']}@$lineending";
							if($child['frel'])
								$famarray[$family['familyID']] .= "2 _FREL {$child['frel']}$lineending";
							if($child['mrel'])
								$famarray[$family['familyID']] .= "2 _MREL {$child['mrel']}$lineending";
							if( $generation < $maxgcgen ) {
								getDescendant( $child['personID'], $generation + 1 );
							}
						}
					}
					tng_free_result( $result2 );
				}
			}
		}
	}
	tng_free_result( $result );
}

function doSources( ) {
	global $tree, $sources_table, $events_table, $eventtypes_table, $allsources, $text, $allrepos, $lineending;
	
	$newsources = array_unique( $allsources );
	if( $newsources ) {
		foreach( $newsources as $nextsource ) {
			$srcquery = "SELECT * FROM $sources_table WHERE sourceID = \"$nextsource\" AND gedcom = \"$tree\"";
			$srcresult = tng_query($srcquery) or die ($text['cannotexecutequery'] . ": $query");
			if( $srcresult ) {
				$source = tng_fetch_assoc( $srcresult );
				echo "0 @{$source['sourceID']}@ SOUR$lineending";
				if( $source['title'] ) { echo "1 TITL {$source['title']}$lineending"; }
				if( $source['shorttitle'] ) { echo "1 ABBR {$source['shorttitle']}$lineending"; }
				if( $source['author'] ) { echo "1 AUTH {$source['author']}$lineending"; }
				if( $source['publisher'] ) { echo "1 PUBL {$source['publisher']}$lineending"; }
				if( $source['repoID'] ) {
					echo "1 REPO @{$source['repoID']}@$lineending";
					array_push( $allrepos, $source['repoID'] );
					if( $source['callnum'] ) { echo "2 CALN {$source['callnum']}$lineending"; }
				}
				else if( $source['callnum'] ) { echo "1 CALN {$source['callnum']}$lineending"; }

				$query = "SELECT tag, description, eventdate, eventplace, info FROM $events_table, $eventtypes_table WHERE persfamID = \"{$source['sourceID']}\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID AND type = \"S\" AND gedcom = \"$tree\" AND keep = \"1\" ORDER BY ordernum";
				$custevents = tng_query($query);
				while ( $custevent = tng_fetch_assoc( $custevents ) ) {
					echo doEvent( $custevent, 1 );
				}

				$srcnotes = getNotes( $nextsource );
				if( !empty($srcnotes['-x--general--x-']) )
					echo writeNote( 1, "NOTE", $srcnotes['-x--general--x-'] );
				if( $source['actualtext'] ) {
					$srcnote = writeNote( 1, "TEXT", $source['actualtext'] );
					echo $srcnote;
				}
				tng_free_result( $srcresult );
			}
		}
	}
}

function doRepositories( ) {
	global $tree, $repositories_table, $events_table, $eventtypes_table, $admtext, $savestate, $allrepos, $lineending;

	$newrepos = array_unique( $allrepos );
	if( $newrepos ) {
		foreach( $newrepos as $nextrepo ) {
			$repoquery = "SELECT * FROM $repositories_table WHERE repoID = \"$nextrepo\" AND gedcom = \"$tree\"";
			$reporesult = tng_query($repoquery) or die ($text['cannotexecutequery'] . ": $query");
			if( $reporesult ) {
				$repo = tng_fetch_assoc( $reporesult );
				echo "0 @{$repo['repoID']}@ REPO$lineending";
				if( $repo['reponame'] ) { echo "1 NAME {$repo['reponame']}$lineending"; }
				if( $repo['addressID'] ) { echo getFact( $repo, 1 ); }

				$query = "SELECT tag, description, eventdate, eventplace, info FROM $events_table, $eventtypes_table WHERE persfamID = \"{$repo['repoID']}\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID AND type = \"R\" AND gedcom = \"$tree\" AND keep = \"1\" ORDER BY ordernum";
				$custevents = tng_query($query);
				while ( $custevent = tng_fetch_assoc( $custevents ) ) {
					echo doEvent( $custevent, 1 );
				}

				$reponotes = getNotes( $repo['repoID'] );
				if( $reponotes['-x--general--x-'] )
					echo writeNote( 1, "NOTE", $reponotes['-x--general--x-'] );
				tng_free_result( $reporesult );
			}
		}
	}
}

function savePlace($place) {
	global $placelist;

	if(!in_array($place,$placelist))
		array_push($placelist, $place);
}

function doPlaces() {
    global $placelist, $tngconfig, $tree, $admtext, $places_table, $lineending;

    if($tngconfig['places1tree'])
        $treestr = "";
    else
        $treestr = "AND $places_table.gedcom = \"$tree\"";

	foreach ($placelist as $place){
		$query = "SELECT place, notes, latitude, longitude, placelevel, zoom FROM $places_table WHERE place = \"" . addslashes($place) . "\" $treestr";
		$result = @tng_query($query) or die($admtext['cannotexecutequery'] . ": $query");

		$row = tng_fetch_assoc( $result );
		if($row['latitude'] || $row['longitude'] || $row['notes']) {
	 		echo "0 _PLAC {$row['place']}$lineending";
	        if($row['latitude'] || $row['longitude']) {
	            echo "1 MAP$lineending";
	            echo "2 LATI {$row['latitude']}$lineending";
	            echo "2 LONG {$row['longitude']}$lineending";
	            echo "2 ZOOM {$row['zoom']}$lineending";
	            echo "2 PLEV {$row['placelevel']}$lineending";
	        }
	        if($row['notes'])
	            echo writeNote( 1, "NOTE", $row['notes'] );
	    }
		tng_free_result( $result );
    }
}

if( $maxgcgen >= 0 || $type == "all" ) {
	if( $maxgcgen > 999 ) {
		$maxgcgen = 999;
	}

	$query = "SELECT firstname, lnprefix, lastname, title, prefix, suffix, living, private, branch, gedcom FROM $people_table WHERE personID = \"$personID\" AND $people_table.gedcom = \"$tree\"";
	$result = tng_query($query) or die ("Cannot execute query: $query");
	if( $result ) {
		$row = tng_fetch_assoc($result);
		$rights = determineLivingPrivateRights($row, $righttree);
		$row['allow_living'] = $rights['living'];
		$row['allow_private'] = $rights['private'];
		$namestr = getName( $row );
		$filenamestr = preg_replace( "/'/", "", $namestr );
		$filenamestr = preg_replace( "/\"/", "", $filenamestr );
		$filenamestr = preg_replace( "/\s*/", "", $filenamestr );
		$filenamestr = preg_replace( "/,/", "", $filenamestr );
		if($session_charset == "UTF-8") {
		    $filenamestr = mb_convert_encoding( $filenamestr, 'ISO-8859-1', 'UTF-8' );
	  }
		tng_free_result($result);
	}
	header("Content-type: application/ged");
	header("Content-Disposition: attachment; filename=$filenamestr.ged\n\n");

	include($cms['tngpath'] . "$mylanguage/text.php");
	$logname = $tngconfig['nnpriv'] && $row['private'] ? $admtext['text_private'] : ($nonames && $row['living'] ? $text['living'] : $namestr);
	writelog( xmlcharacters("{$text['gedcreatedfrom']} $logname ($personID), $maxgcgen {$text['generations']} ($type) {$text['gedcreatedfor']} $email.") );
	preparebookmark( xmlcharacters("{$text['gedcreatedfrom']} $namestr ($personID), $maxgcgen {$text['generations']} ($type) {$text['gedcreatedfor']} $email.") );

	$owneremail = $treerow['email'] ? $treerow['email'] : $emailaddr;
	$ownername = $treerow['owner'] ? $treerow['owner'] : $dbowner;

	$firstpart = "0 HEAD$lineending"
	. "1 SOUR The Next Generation of Genealogy Sitebuilding$lineending"
	. "2 VERS $tng_version$lineending"
	. "2 NAME The Next Generation of Genealogy Sitebuilding (R)$lineending"
	. "2 CORP Next Generation Software, LLC$lineending"
	. "3 ADDR Sandy, UT$lineending"
	. "1 FILE $namestr.ged$lineending"
	. "1 GEDC$lineending"
	. "2 VERS 5.5.1$lineending"
	. "2 FORM LINEAGE-LINKED$lineending"
	. "1 CHAR " . ($session_charset == "UTF-8" ? "UTF-8" : "ANSI" ) . $lineending
	. "1 SUBM @SUB1@$lineending"
	. "0 @SUB1@ SUBM$lineending"
	. "1 NAME $ownername$lineending"
	. "1 EMAIL $owneremail$lineending"
	. "1 DEST 5.5.1$lineending";
	
	echo $firstpart;

	$generation = 1;

	if( $type == $text['ancestors'] ) {
		getAncestor( $personID, $generation );
	}
	else if( $type == $text['descendants'] ) {
		if(!array_key_exists($personID,$indarray)) $indarray[$personID] = writeIndividual( $personID );
		if(!$maxgcgen) $generation++;
		getDescendant( $personID, $generation );
	}
	else if( $type == "all" ) {
		$query = "SELECT personID, sex FROM $people_table WHERE gedcom = \"$tree\"";
		$result = tng_query($query);
		while( $ind = tng_fetch_assoc( $result ) ) {
			if(!array_key_exists($ind['personID'],$indarray)) $indarray[$ind['personID']] = writeIndividual( $ind['personID'] );
			$query = "";
			if( $ind['sex'] == "M" )
				$query = "SELECT familyID FROM $families_table WHERE husband = \"{$ind['personID']}\" AND gedcom = \"$tree\" ORDER BY wifeorder";
			else if( $ind['sex'] == "F" )
				$query = "SELECT familyID FROM $families_table WHERE wife = \"{$ind['personID']}\" AND gedcom = \"$tree\" ORDER BY husborder";
			if( $query ) {
				$result2 = tng_query($query);
				while( $spouse = tng_fetch_assoc( $result2 ) )
					$indarray[$ind['personID']] .= "1 FAMS @{$spouse['familyID']}@$lineending";
				tng_free_result( $result2 );
			}
			echo $indarray[$ind['personID']];
		}
		tng_free_result( $result );

		$query = "SELECT * FROM $families_table WHERE gedcom = \"$tree\"";
		$result = tng_query($query);
		while( $fam = tng_fetch_assoc( $result ) ) {
			$famarray[$fam['familyID']] = writeFamily( $fam );

			$query = "SELECT personID as personID, mrel, frel FROM $children_table WHERE familyID = \"{$fam['familyID']}\" AND gedcom = \"$tree\" ORDER BY ordernum";
			$result2 = tng_query($query);
			if( $result2 ) {
				while( $child = tng_fetch_assoc( $result2 ) ) {
					$famarray[$fam['familyID']] .= "1 CHIL @{$child['personID']}@$lineending";
					if($child['frel'])
						$famarray[$fam['familyID']] .= "2 _FREL {$child['frel']}$lineending";
					if($child['mrel'])
						$famarray[$fam['familyID']] .= "2 _MREL {$child['mrel']}$lineending";
				}
			}
			tng_free_result( $result2 );
			echo $famarray[$fam['familyID']];
		}
		tng_free_result( $result );
	}
	else {
		echo "error - no type.\n";
	}
	if( $type != "all" ) {
		processEntities( $indarray );
		processEntities( $famarray );
	}
	
	doSources();
	doXNotes();
	doRepositories();
	doPlaces();
	
	echo "0 TRLR$lineending";
}
else {
	tng_header( "Error", "" );
	echo "<h1>Error</h1>\n<p>maxgen = $maxgcgen. {$text['nomaxgen']}</p>\n";
	echo tng_menu( "", "", "", 1 );
	tng_footer( "" );
}
?>
