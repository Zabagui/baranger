<?php
@ini_set('zlib.output_compression', 0);
@ini_set('implicit_flush', 1);
@ini_set( 'memory_limit' , '200M' );
//@ob_end_clean();  // causes some servers to destroy the session
$umfs = substr(ini_get("upload_max_filesize"),0,-1);
if($umfs < 15) {
	@ini_set( "upload_max_filesize", "15M" );
	@ini_set( "post_max_size", "15M" );
}

include("begin.php");
include("adminlib.php");
$textpart = "trees";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

include($subroot . "importconfig.php");
require("adminlog.php");

if( !$allow_ged && $assignedtree ) {
	$query = "SELECT disallowgedcreate FROM $trees_table WHERE gedcom = \"$assignedtree\"";
	$result = tng_query($query);
	$row = tng_fetch_assoc( $result );
	$disallowgedcreate = $row['disallowgedcreate'];
	tng_free_result($result);

	if($disallowgedcreate) {
		$message = $admtext['norights'];
		header( "Location: admin_login.php?message=" . urlencode($message) );
		exit;
	}
}

$allsources = array();
$allrepos = array();
$xnotes = array();
$citations = array();
$placelist = array();
$branchmedia = array();
if(empty($exportmedia)) $exportmedia = 0;
if(!isset($exliving)) $exliving = 0;
if(!isset($exprivate)) $exprivate = 0;
if(!isset($exnotes)) $exnotes = 0;
if(!isset($exportmediafiles)) $exportmediafiles = 0;

tng_adminheader( $admtext['gedexport'], $flags );

if(empty($tree)) $tree = "";
$righttree = checktree($tree);

foreach( $mediatypes as $mediatype ) {
	$msgID = $mediatype['ID'];
	$incl[$msgID] = !empty(${"incl_" . $msgID});
	$exppath[$msgID] = "";
	$expdir[$msgID] = 0;
	if( isset($incl[$msgID]) ) {
		$exppath[$msgID] = ${"exp_path_" . $msgID};
		if( !empty($exppath[$msgID]) ) {
			//if (get_magic_quotes_gpc() )
			//$exppath[$msgID] = stripslashes( $exppath[$msgID] );
			if(strpos( $exppath[$msgID], "/") !== false)
				$expdir[$msgID] = 1;
			elseif(strpos( $exppath[$msgID], "\\") !== false)
				$expdir[$msgID] = -1;
			else
				$expdir[$msgID] = 0;
			//1 = do forward slashes, -1 = backslashes
			if( substr( $exppath[$msgID], -1 ) != "/" && substr( $exppath[$msgID], -1 ) != "\\" )
				$exppath[$msgID] .= "/";
		}
	}
}
?>
</head>

<?php
	echo tng_adminlayout();

	$helplang = findhelp("data_help.php");
	$datatabs[0] = array(1,"admin_dataimport.php",$admtext['import'],"import");
	$datatabs[1] = array(1,"admin_export.php",$admtext['export'],"export");
	$datatabs[2] = array(1,"admin_secondmenu.php",$admtext['secondary'],"second");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/data_help.php#export');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($datatabs,"export",$innermenu);
	if(!isset($message)) $message = "";
	echo displayHeadline($admtext['datamaint'] . " &gt;&gt; " . $admtext['gedexport'],"img/data_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">

<?php
function getCitations( $persfamID ) {
	global $citations_table, $admtext, $tree;

	$citations = array();
	$citquery = "SELECT citationID, page, quay, citedate, citetext, note, sourceID, description, eventID FROM $citations_table WHERE persfamID = \"$persfamID\" AND gedcom = \"$tree\" ORDER BY eventID";
	$citresult = tng_query($citquery) or die ($admtext['cannotexecutequery'] . ": $query");

	while( $cite = tng_fetch_assoc( $citresult ) ) {
		$eventID = $cite['eventID'] ? $cite['eventID'] : "-x--general--x-";
		$citations[$eventID][] = array( "page" => $cite['page'], "quay" => $cite['quay'], "citedate" => $cite['citedate'], "citetext" => $cite['citetext'], "note" => $cite['note'], "sourceID" => $cite['sourceID'], "description" => $cite['description'] );
	}
	return $citations;
}

function writeCitation( $citelist, $level ) {
	global $allsources, $branch, $lineending;
	
	$levelplus1 = $level + 1;
	$citestr = "";
	
	if( is_array($citelist) ) {
		foreach( $citelist as $cite ) {
			if( $cite['sourceID'] ) {
				if($branch)
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
				$citestr = doNote($level, "SOUR", $cite['description']);
				if( $cite['citetext'] )
					$citestr .= doNote( $levelplus1, "TEXT", $cite['citetext'] );
			}
			if( $cite['page'] ) $citestr .= doNote( $levelplus1, "PAGE", $cite['page'] );
			if( $cite['quay'] && $cite['quay'] != "0" ) $citestr .= "$levelplus1 QUAY {$cite['quay']}$lineending";
			if( $cite['note'] ) $citestr .= doNote( $levelplus1, "NOTE", $cite['note'] );
		}
	}
	return $citestr;
}

function getFact( $row, $level ) {
	global $tree, $address_table, $admtext, $lineending;

	$fact = "";
	if( !empty($row['age']) ) $fact .= "$level AGE {$row['age']}$lineending";
	if( !empty($row['agency']) ) $fact .= "$level AGNC {$row['agency']}$lineending";
	if( !empty($row['cause']) ) $fact .= "$level CAUS {$row['cause']}$lineending";
	if( !empty($row['addressID']) ) {
		$query = "SELECT address1, address2, city, state, zip, country, phone, email, www FROM $address_table WHERE addressID = \"{$row['addressID']}\" AND gedcom = \"$tree\"";
		$addrresults = tng_query($query);
		$addr = tng_fetch_assoc( $addrresults );
		if( !empty($row['tag']) && $row['tag'] != "ADDR" ) {
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
	global $tree, $events_table, $admtext;
	
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
	if( $custevent['eventplace'] )  $info .= writePlace($custevent['eventplace'],2);
	if( $custevent['tag'] == "EVEN" && $infolen >= 150 )
		$info .= doNote($nextlevel,"NOTE",$custevent['info']);

	return $info;
}

function getNotes( $id ) {
	global $notelinks_table, $xnotes_table, $tree, $eventtypes_table, $events_table, $admtext, $xnotes, $exprivate;

	$exprivatestr = $exprivate ? "AND secret != 1" : "";
	$query = "SELECT $notelinks_table.ID as ID, secret, $xnotes_table.note as note, $xnotes_table.noteID as noteID, $notelinks_table.eventID
		FROM $notelinks_table
		LEFT JOIN  $xnotes_table on $notelinks_table.xnoteID = $xnotes_table.ID AND $notelinks_table.gedcom = $xnotes_table.gedcom
		LEFT JOIN $events_table ON $notelinks_table.eventID = $events_table.eventID
		LEFT JOIN $eventtypes_table on $eventtypes_table.eventtypeID = $events_table.eventtypeID
		WHERE $notelinks_table.persfamID=\"$id\" AND $notelinks_table.gedcom =\"$tree\" $exprivatestr
		ORDER BY eventdatetr, $eventtypes_table.ordernum, tag, $notelinks_table.ordernum, ID";
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
	global $lineending, $session_charset;

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
			$note = substr( $note, 0, $offset );
		}
		$newlevel = $level + $delta;
		while( $offset < $notelen ) {
			$endnext = 245;
			if($session_charset == "UTF-8" && function_exists('mb_substr')) {
				while( mb_substr($orgnote, $offset + $endnext, 1, 'UTF-8') == " " || mb_substr($orgnote, $offset + $endnext - 1, 1, 'UTF-8') == " ") {
					$endnext--;
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
	global $admtext, $savestate, $fp, $saveimport, $saveimport_table, $tree, $exnotes;

	$noteinfo = "";
	if(empty($exnotes) || $label != "NOTE") {
		$notetxt = str_replace("\r","",$notetxt);
		if(!preg_match('/^@.+@$/',$notetxt))
			$notetxt = str_replace("@","@@",$notetxt);
		$notes = preg_split ( '/\r\n|\n/', $notetxt );
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

		if($label == "NOTE") {
			$savestate['ncount']++;
			if( $savestate['ncount'] % 10 == 0 ) {
				if( $saveimport ) {
					$query = "UPDATE $saveimport_table SET ncount=\"{$savestate['ncount']}\" WHERE gedcom = \"$tree\"";
					$saveresult = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
				}
				echo "<strong>N{$savestate['ncount']}</strong> ";
			}
		}
	}

	return $noteinfo;
}

function writeNote( $level, $label, $notes ) {
	global $citations, $exnotes;

	$noteinfo = "";
	if(empty($exnotes) || $label != "NOTE") {
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
	}
	return $noteinfo;
}

function doXNotes( ) {
	global $xnotes_table, $tree, $admtext, $savestate, $tngconfig, $xnotes, $exliving, $exprivate, $exnotes;

	$xnotestr = "";

	if(empty($exnotes)) {
		//if excluding private or living
			//join xnotes and notelinks
		if( !empty($branch) || $exliving || $exprivate) {
			if( $xnotes ) {
				$xnoteinfo = "";
				foreach ( $xnotes as $xnote ) {
					$query = "SELECT note, noteID FROM $xnotes_table WHERE gedcom =\"$tree\" AND noteID = \"$xnote\" ORDER BY noteID";
					$xnotearray = tng_query($query);
					$xnotetxt = tng_fetch_assoc( $xnotearray );
					$xnotestr .= writeXNote($xnotetxt);
					tng_free_result( $xnotearray );
				}
			}
		}
		else {
			$prefixlen = strlen( $tngconfig['noteprefix'] ) + 1;

			$query = "SELECT note, noteID, (0+SUBSTRING(noteID,$prefixlen)) as num FROM $xnotes_table WHERE gedcom =\"$tree\" AND noteID != \"\" {$savestate['wherestr']} ORDER BY num";
			$xnotearray = tng_query($query);
			while( $xnotetxt = tng_fetch_assoc( $xnotearray ) ) {
				$xnotestr .= writeXNote($xnotetxt);
			}
			tng_free_result( $xnotearray );
		}
	}

	return $xnotestr;
}

function writeXNote($xnotetxt) {
	global $tree, $admtext, $savestate, $lineending, $citations, $fp, $saveimport, $saveimport_table, $level;

	$xnotestr = "";

	$xnotestr .= "0 @{$xnotetxt['noteID']}@ NOTE$lineending";

	$xnotestr .= doNote( 0, "NOTE", $xnotetxt['note']);
	$citations = getCitations( $xnotetxt['noteID'] );
	if( !empty($citations['NAME']) )
		$xnotestr .= writeCitation( $citations['NAME'], $level + 2 );

	//$notes = split ( chr(10), $xnotetxt['note'] );
	//foreach ( $notes as $note )
		//$xnotestr .= "1 CONT $note$lineending";

	//ncount purposefully not incremented here
	if( $saveimport ) {
		$savestate['fileoffset'] = ftell($fp);
		$query = "UPDATE $saveimport_table SET fileoffset={$savestate['fileoffset']}, lasttype={$savestate['lasttype']}, lastid=\"{$xnotetxt['noteID']}\" WHERE gedcom = \"$tree\"";
		$saveresult = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
	}

	return $xnotestr;
}

function getMediaLinks( $id ) {
	global $tree, $admtext, $savestate, $media_table, $medialinks_table;
	global $expdir, $exppath, $lineending, $incl, $resume;

	$allmedia = array();
	if( $savestate['media'] ) {
		if($id) {
			$personstr = "AND $medialinks_table.personID=\"" . addslashes($id) . "\"";
			$orderstr = "eventID, ordernum";
		}
		else {
			$personstr = "";
			$orderstr = "$media_table.mediaID";
		}
		$query = "SELECT notes, altnotes, description, altdescription, path, $media_table.mediaID, mediatypeID, eventID, form, abspath, defphoto, usecollfolder 
			FROM ($media_table, $medialinks_table) 
			WHERE $medialinks_table.gedcom =\"$tree\" $personstr AND $media_table.mediaID = $medialinks_table.mediaID 
			ORDER BY $orderstr";
		$media = tng_query($query);

		while( $prow = tng_fetch_assoc( $media ) ) {
			$mediatypeID = $prow['mediatypeID'];
			if($incl[$mediatypeID] || $resume) {
				$eventID = $prow['eventID'] ? $prow['eventID'] : "-x--general--x-";
				if($prow['abspath']) {
					preg_match( "/\.(.+)$/", $prow['path'], $matches );
					$prow['form'] = $matches[1];
					$prow['orgpath'] = "";
				}
				else {
					$prow['orgpath'] = $prow['path'];
					$thisexppath = $exppath[$mediatypeID];
					$thisexpdir = $expdir[$mediatypeID];
					//$linktxt .= "1 OBJE$lineending";
					if( !$prow['form'] ) {
						preg_match( "/\.(.+)$/", $prow['path'], $matches );
						$prow['form'] = isset($matches[1]) ? $matches[1] : "";
					}

					//strip $prow['path'] down to just the file name
					//$filename = basename( $prow['path'] );
					if(!$thisexpdir && strpos( $prow['path'], "/" )) $thisexpdir = 1;
					$prow['path'] = $thisexpdir == 1 ? str_replace("\\","/",$thisexppath . $prow['path']) : str_replace("/","\\",$thisexppath . $prow['path']);
				}
				$prow['title'] = $prow['altdescription'] ? $prow['altdescription'] : $prow['description'];

				$prow['notes'] = $prow['altnotes'] ? $prow['altnotes'] : $prow['notes'];
				if( !isset($allmedia[$eventID]) || !is_array($allmedia[$eventID]) )
					$allmedia[$eventID] = array();
				array_push($allmedia[$eventID],$prow);
			}
		}
		tng_free_result( $media );
	}

	return $allmedia;
}

function writeMediaLinks( $media_array, $level ) {
	global $lineending, $savestate, $mediatypeObjs, $fp, $saveimport, $saveimport_table, $admtext, $branch, $branchmedia, $tree, $exportmediafiles;

	$linktxt = "";
	if(is_array($media_array)) {
		$newlevel = $level + 1;
		if($level) {
			foreach( $media_array as $media ) {
				if($media['form']) {
					$media['title'] = preg_replace("/\n/"," ",$media['title']);
					$media['title'] = preg_replace("/\r/"," ",$media['title']);
					$linktxt .= "$level OBJE @M{$media['mediaID']}@$lineending";
					if($media['defphoto'])
						$linktxt .= "$newlevel _PRIM Y$lineending";
					if($branch) {
						$type = $media['mediatypeID'];
						if(!isset($branchmedia[$type]))
							$branchmedia[$type] = array();
						if(!in_array($media,$branchmedia[$type]))
							array_push($branchmedia[$type], $media);
					}
				}
			}
		}
		else {
			$already_done = array();
			foreach($media_array as $sub_array) {
				foreach($sub_array as $media) {
					if(!in_array($media['mediaID'],$already_done)) {
						$linktxt .= "0 @M{$media['mediaID']}@ OBJE$lineending";
						$linktxt .= "$newlevel FORM {$media['form']}$lineending";
						$linktxt .= "$newlevel FILE {$media['path']}$lineending";
						if($exportmediafiles && !empty($media['orgpath']))
							writeToMediaList($media);
						$media['title'] = preg_replace("/\n/"," ",$media['title']);
						$media['title'] = preg_replace("/\r/"," ",$media['title']);
						$linktxt .= "$newlevel TITL {$media['title']}$lineending";
						$type = $media['mediatypeID'];
						$exportas = $mediatypeObjs[$type]['exportas'];
						if(!$exportas) {
							$exportas = strtoupper($media['mediatypeID']);
							if(substr($exportas,-1) == "S")
								$exportas = substr($exportas,0,-1);
							if($exportas == "HISTORIE") $exportas = "HISTORY";
						}
						$linktxt .= "$newlevel TYPE $exportas$lineending";
						$linktxt .= writeNote( $newlevel, "NOTE", $media['notes'] );
						$savestate['mcount']++;
						if( $savestate['mcount'] % 10 == 0 ) {
							if( $saveimport ) {
								$savestate['fileoffset'] = ftell($fp);
								$query = "UPDATE $saveimport_table SET fileoffset={$savestate['fileoffset']}, lasttype={$savestate['lasttype']}, lastid=\"{$media['mediaID']}\", scount=\"{$savestate['mcount']}\" WHERE gedcom = \"$tree\"";
								$saveresult = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
							}
							echo "<strong>M{$savestate['mcount']}</strong> ";
						}
						$already_done[] = $media['mediaID'];
					}
				}
			}
		}
	}
	return $linktxt;
}

function writeToMediaList( $media ) {
	global $mediafp, $rootpath, $mediapath, $mediatypes_assoc;

	//make sure full server path is included; also include full local path
	//when zipping, put in folders if needed
	$mediatype = $media['mediatypeID'];
	$mediafolder = $media['usecollfolder'] ? $mediatypes_assoc[$mediatype] : $mediapath;
	fwrite($mediafp, "{$mediafolder}/{$media['orgpath']}\n");
}

function appendParents( $child ) {
	global $lineending, $righttree;
	
	$info = "1 FAMC @{$child['familyID']}@$lineending";
	$crights = determineLivingPrivateRights($child, $righttree);
	$child['allow_living'] = $crights['living'];
	$child['allow_private'] = $crights['private'];
	if( $crights['both'] ) {
		//if( $child['relationship'] ) $info .= "2 PEDI {$child['relationship']}$lineending";
		if( $crights['lds'] ) {
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
						if( $tok )
							$info .= writePlace($tok,2);
					}
					else
						$info .= writePlace($child['sealplace'],2);
				}
				if( $childnotes['SLGC'] )
					$info .= writeNote( 2, "NOTE", $childnotes['SLGC'] );
				if( $citations['SLGC'] ) {
					$info .= writeCitation( $citations['SLGC'], 2 );
				}
			}
		}
	}
	
	return $info;
}

function getEligibility( $ind ) {
	$rval = 0;

   	$birthdate = $ind['birthdatetr'] != "0000-00-00" ? $ind['birthdatetr'] : $ind['altbirthdatetr'];
	$birthplace = $ind['birthplace'] ? $ind['birthplace'] : $ind['altbirthplace'];
	if($birthplace && $birthdate > "1500-00-00") {
   		$deathdate = $ind['deathdatetr'] != "0000-00-00" ? $ind['deathdatetr'] : $ind['burialdatetr'];
		if($deathdate != "0000-00-00") {
		   	$deathinfo = explode("-",$deathdate);
			$deathyeardiff = date("Y") - $deathinfo[0];
			if( $deathyeardiff > 1 || ($deathyeardiff && (date("m") > $deathinfo[1] || (date("m") == $deathinfo[1] && date("d") > $deathinfo[2]))))
				$rval = 1;
		}
		else {
   			$birthinfo = explode("-",$birthdate);
   			$birthyeardiff = date("Y") - $birthinfo[0];
			if( $birthyeardiff > 110 || ($birthyeardiff == 110 && (date("m") > $birthinfo[1] || (date("m") == $birthinfo[1] && date("d") > $birthinfo[2]))))
				$rval = 1;
		}
	}

	return $rval;
}

function doNotesAndMedia( $notes, $media, $tag, $level ) {
	$rval = "";
	if( !empty($notes[$tag]) )
		$rval .= writeNote( $level, "NOTE", $notes[$tag] );
	if( !empty($media[$tag]) )
		$rval .= writeMediaLinks( $media[$tag], $level );

	return $rval;
}

function doAssociations($entityID) {
	global $tree, $assoc_table, $admtext, $lineending;

	$assocstr = "";
	$query = "SELECT passocID, relationship FROM $assoc_table WHERE gedcom = \"$tree\" AND personID = \"$entityID\"";
	$assocresult = tng_query($query);
	while($assoc = tng_fetch_assoc( $assocresult ) ) {
		$assocstr .= "1 ASSO @{$assoc['passocID']}@$lineending";
		if( $assoc['relationship'] ) $assocstr .= "2 RELA {$assoc['relationship']}$lineending";
	}

	return $assocstr;
}

function writeIndividual( $ind ) {
	global $tree, $people_table, $events_table, $eventtypes_table, $admtext, $lnprefixes, $assoc_table, $branchstr;
	global $children_table, $families_table, $citations, $templeready, $savestate, $fp, $lineending, $righttree, $exprivatestr, $exlivingstr;

	$rights = determineLivingPrivateRights($ind, $righttree);
	$ind['allow_living'] = $rights['living'];
	$ind['allow_private'] = $rights['private'];
	$rights['both'] = $ind['allow_private'] && $ind['allow_living'];
	$doit = !$templeready;

	if( !$doit && ((!$ind['baptdate'] && !$ind['baptplace']) || (!$ind['confdate'] && !$ind['confplace']) || (!$ind['initdate'] && !$ind['initplace']) || (!$ind['endldate'] && !$ind['endlplace'])))
		$doit = 1;

	//check eligibility
	if( $doit && $templeready ) {
		$doit = getEligibility( $ind );
	}

	$spousedata = "";
	if($ind['sex'] == "M") {
		$orderfield = ", wifeorder";
		$orderby = " ORDER BY wifeorder";
	}
	elseif($ind['sex'] == "F") {
		$orderfield = ", husborder";
		$orderby = " ORDER BY husborder";
	}
	else {
		$orderfield = $orderby = "";
	}
    $query = "(SELECT familyID, changedate, sealdate, sealplace, marrplace, marrdatetr$orderfield FROM $families_table WHERE husband = \"{$ind['personID']}\" AND gedcom = \"$tree\"$exlivingstr$exprivatestr$branchstr) UNION (SELECT familyID, changedate, sealdate, sealplace, marrplace, marrdatetr$orderfield FROM $families_table WHERE wife = \"{$ind['personID']}\" AND gedcom = \"$tree\"$exlivingstr$exprivatestr$branchstr)$orderby";

	$result2 = tng_query($query);
	while( $spouse = tng_fetch_assoc( $result2 ) ) {
		$spousedata .= "1 FAMS @{$spouse['familyID']}@$lineending";
		if( !$doit && !$spouse['sealdate'] && !$spouse['sealplace'] && $spouse['marrplace'] && $spouse['marrdatetr'] > "1500-00-00" )
			$doit = 1;
		//if $doit still false, loop through children to see if sealing needs to be done for any of them
		if( !$doit ) {
			$query = "SELECT personID, sealdate, sealplace from $children_table WHERE gedcom = \"$tree\" AND familyID = \"{$spouse['familyID']}\"";
			$children = tng_query($query);
			if( $children ) {
				while( !$doit && $child = tng_fetch_assoc( $children ) ) {
					if( !$child['sealdate'] && !$child['sealplace'] ) {
						//make sure child is eligible
						$query = "SELECT birthdate, birthdatetr, birthplace, altbirthtype, altbirthdate, altbirthdatetr, altbirthplace, deathdatetr, burialdatetr from $people_table WHERE gedcom = \"$tree\" AND personID = \"{$child['personID']}\"$exlivingstr$exprivatestr";
						$childresult = tng_query($query);
						$childind = tng_fetch_assoc( $childresult );
						$doit = getEligibility( $childind );
  							tng_free_result( $childresult );
					}
				}
				tng_free_result( $children );
			}
		}
	}
	tng_free_result( $result2 );

	$childdata = "";
	$query = "SELECT sealdate, sealplace, $people_table.personID as personID, familyID, $people_table.gedcom as gedcom, $people_table.branch, $people_table.birthdate, $people_table.birthdatetr, $people_table.altbirthtype, $people_table.altbirthdate, $people_table.altbirthdatetr, $people_table.deathdate, $people_table.deathdatetr, $people_table.living, $people_table.private
		FROM $children_table, $people_table 
		WHERE $children_table.gedcom = \"$tree\" AND $children_table.personID = \"{$ind['personID']}\" AND $children_table.gedcom = $people_table.gedcom AND $children_table.personID = $people_table.personID$branchstr ORDER BY parentorder";
	$children = tng_query($query);
	if( $children ) {
		while( $child = tng_fetch_assoc( $children ) ) {
			$childdata .= appendParents( $child );
			if( !$doit && !$child['sealdate'] && !$child['sealplace'] )
			   $doit = 1;
		}
		tng_free_result( $children );
	}

	if( $doit ) {
		if( $rights['both'] ) {
			$indnotes = getNotes( $ind['personID'] );
			$indmedia = getMediaLinks( $ind['personID'] );
		}
		else {
			$indnotes = array();
			$indmedia = array();
		}

		$citations = getCitations( $ind['personID'] );
		$extras = getStdExtras( $ind['personID'], 2 );

		if(empty($ind['altbirthtype'])) $ind['altbirthtype'] = "CHR";

		$info = "0 @{$ind['personID']}@ INDI$lineending";
		$nonamesloc = showNames($ind);
		if( $rights['both'] || !$nonamesloc ) {
   			$info .= "1 NAME {$ind['firstname']} /" . trim( $ind['lnprefix'] . " " . $ind['lastname'] ) . "/";
			$info .= $ind['suffix'] ? " {$ind['suffix']}$lineending" : $lineending;
   			if( $ind['firstname'] ) $info .= "2 GIVN {$ind['firstname']}$lineending";
			if( $lnprefixes && $ind['lnprefix'] ) $info .= "2 SPFX {$ind['lnprefix']}$lineending";
			if( $ind['lastname'] ) $info .= "2 SURN {$ind['lastname']}$lineending";

			$info .= doNotesAndMedia($indnotes, $indmedia, "NAME", 2 );
			//if( $indnotes['NAME'] )
			//	$info .= writeNote( 2, "NOTE", $indnotes['NAME'] );
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
		elseif( $nonamesloc == 2 )
			$info .= "1 NAME " . initials( $ind['firstname'] ) . " /" . trim( $ind['lnprefix'] . " " . $ind['lastname'] ) . "/$lineending";
		else
			$info .= "1 NAME {$text['living']} //$lineending";

		if( $rights['both'] ) {
			if( $ind['birthdate'] || $ind['birthplace'] || !empty($indnotes['BIRT']) || !empty($citations['BIRT']) || !empty($extras['BIRT']) ) {
				if( $ind['birthdate'] == "Y" || (!$ind['birthdate'] && !$ind['birthplace']))
					$info .= "1 BIRT Y$lineending";
				else {
					$info .= "1 BIRT$lineending";
					if( $ind['birthdate'] ) { $info .= "2 DATE {$ind['birthdate']}$lineending"; }
					if( $ind['birthplace'] ) { $info .= writePlace($ind['birthplace'],2); }
				}
				$info .= doNotesAndMedia($indnotes, $indmedia, "BIRT", 2 );
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
					if( $ind['altbirthplace'] ) { $info .= writePlace($ind['altbirthplace'],2); }
				}
				$info .= doNotesAndMedia($indnotes, $indmedia, $ind['altbirthtype'], 2 );
				if( !empty($citations[$ind['altbirthtype']]) )
					$info .= writeCitation( $citations[$ind['altbirthtype']], 2 );
				if( !empty($extras[$ind['altbirthtype']]) )
					$info .= $extras[$ind['altbirthtype']];
			}
		}
		if( $ind['deathdate'] || $ind['deathplace'] || !empty($indnotes['DEAT']) || !empty($citations['DEAT']) || !empty($extras['DEAT']) ) {
			if( $ind['deathdate'] == "Y" || (!$ind['deathdate'] && !$ind['deathplace']))
				$info .= "1 DEAT Y$lineending";
			else {
				$info .= "1 DEAT$lineending";
				if( $ind['deathdate'] ) { $info .= "2 DATE {$ind['deathdate']}$lineending"; }
				if( $ind['deathplace'] ) { $info .= writePlace($ind['deathplace'],2); }
			}
			$info .= doNotesAndMedia($indnotes, $indmedia, "DEAT", 2 );
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
				if( $ind['burialplace'] ) { $info .= writePlace($ind['burialplace'],2); }
			}
			$info .= doNotesAndMedia($indnotes, $indmedia, "BURI", 2 );
			if( !empty($citations['BURI']) )
				$info .= writeCitation( $citations['BURI'], 2 );
			if( !empty($extras['BURI']) )
				$info .= $extras['BURI'];
		}

		if( $rights['both'] ) {
			$query = "SELECT tag, description, eventdate, eventplace, age, agency, cause, addressID, info, eventID FROM $events_table, $eventtypes_table WHERE persfamID = \"{$ind['personID']}\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID AND parenttag = \"\" AND gedcom = \"$tree\" AND keep = \"1\" ORDER BY eventdate, ordernum, tag";
			$custevents = tng_query($query);
			while ( $custevent = tng_fetch_assoc( $custevents ) ) {
				$info .= doEvent( $custevent, 1 );
				$eventID = $custevent['eventID'];
				$info .= doNotesAndMedia($indnotes, $indmedia, $eventID, 2 );
				if( !empty($citations[$eventID]) )
					$info .= writeCitation( $citations[$eventID], 2 );
				$info .= getFact( $custevent, 2 );
			}

			if( $rights['lds'] ) {
				$info .= doLDSEvent("BAPL", "bapt", $indnotes, $indmedia, $ind);
				$info .= doLDSEvent("CONL", "conf", $indnotes, $indmedia, $ind);
				$info .= doLDSEvent("INIT", "init", $indnotes, $indmedia, $ind);
				$info .= doLDSEvent("ENDL", "endl", $indnotes, $indmedia, $ind);
			}
			$info .= doAssociations($ind['personID']);

			if( !empty($indnotes['-x--general--x-']) )
				$info .= writeNote( 1, "NOTE", $indnotes['-x--general--x-'] );

			if( !empty($indmedia['-x--general--x-']) )
				$info .= writeMediaLinks( $indmedia['-x--general--x-'], 1 );
		}
		$info .= $childdata;
		$info .= $spousedata;

		if($ind['changedate']) {
			$info .= "1 CHAN$lineending";
			$info .= "2 DATE {$ind['changedate']}$lineending";
		}

		fwrite( $fp, $info );
		$savestate['icount']++;
		if( $savestate['icount'] % 10 == 0 ) {
			echo "<strong>I{$savestate['icount']}</strong> ";
		}
	}
	return $info;
}

function doLDSEvent($tag, $key, $notes, $media, $row) {
	global $lineending, $citations, $extras;

	$event = "";
	$prefix = $tag == "INIT" ? "_" : "";
	if( $row[$key.'date'] || $row[$key.'place'] ) {
		$event .= "1 $prefix$tag$lineending";
		if( $row[$key.'date'] ) { $event .= "2 DATE {$row[$key.'date']}$lineending"; }
		if( $row[$key.'place'] ) {
			$tok = strtok ($row[$key.'place']," ");
			if( strlen( $tok ) == 5 ) {
				$event .= "2 TEMP $tok$lineending";
				$tok = strtok( " " );
				if( $tok )
					$event .= writePlace($tok,2);
			}
			else
				$event .= writePlace($row[$key.'place'],2);
		}
		$event .= doNotesAndMedia($notes, $media, $tag, 2 );
		if( !empty($citations[$key]) )
			$event .= writeCitation( $citations[$key], 2 );
		if( !empty($extras[$key]) )
			$event .= $extras[$key];
	}
	return $event;
}

function writeFamily( $family ) {
	global $tree, $events_table, $eventtypes_table, $admtext, $citations, $savestate, $children_table, $people_table;
	global $templeready, $fp, $lineending, $righttree, $exlivingstr, $exprivatestr;

	$familyID = $family['familyID'];
	$doit = !$templeready;

	if( !$doit && !$family['sealdate'] && !$family['sealplace'] && $family['marrplace'] && $family['marrdatetr'] > "1500-00-00")
		$doit = 1;

	$childdata = "";
	$query = "SELECT personID, sealdate, sealplace, mrel, frel FROM $children_table WHERE familyID = \"$familyID\" AND personID != \"\" AND gedcom = \"$tree\" ORDER BY ordernum";
	$result = tng_query($query);
	if( $result ) {
		while( $child = tng_fetch_assoc( $result ) ) {
			$childdata .= "1 CHIL @{$child['personID']}@$lineending";
			if($child['frel'])
				$childdata .= "2 _FREL " . ucfirst($child['frel']) . "$lineending";
			if($child['mrel'])
				$childdata .= "2 _MREL " . ucfirst($child['mrel']) . "$lineending";
			if( !$doit && !$child['sealdate'] && !$child['sealplace'] )
				$doit = 1;
		}
	}
	tng_free_result( $result );

	if( $doit ) {
		$info = "0 @$familyID@ FAM$lineending";
		if( $family['status'] ) { $info .= "1 _STAT {$family['status']}$lineending"; }
		if( $family['husband'] )
			$info .= "1 HUSB @{$family['husband']}@$lineending";
		if( $family['wife'] )
			$info .= "1 WIFE @{$family['wife']}@$lineending";

		//look up family's rights

		$frights = determineLivingPrivateRights($family, $righttree);
		$family['allow_living'] = $frights['living'];
		$family['allow_private'] = $frights['private'];
		if( $frights['both'] ) {
			$famnotes = getNotes( $familyID );
			$citations = getCitations( $familyID );
			$fammedia = getMediaLinks( $familyID );
			$extras = getStdExtras( $familyID, 2 );
			if( $family['marrdate'] || $family['marrplace'] || !empty($famnotes['MARR']) || !empty($citations['MARR']) || !empty($extras['MARR']) || !empty($family['marrtype']) ) {
				if( $family['marrdate'] == "Y" || (!$family['marrdate'] && !$family['marrplace']))
					$info .= "1 MARR Y$lineending";
				else {
					$info .= "1 MARR$lineending";
					if( $family['marrdate'] ) { $info .= "2 DATE {$family['marrdate']}$lineending"; }
					if( $family['marrplace'] ) { $info .= writePlace($family['marrplace'],2); }
				}
				if($family['marrtype']) $info .= "2 TYPE " . $family['marrtype'] . $lineending;
				$info .= doNotesAndMedia($famnotes, $fammedia, "MARR", 2 );
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
					if( $family['divplace'] ) { $info .= writePlace($family['divplace'],2); }
				}
				$info .= doNotesAndMedia($famnotes, $fammedia, "DIV", 2 );
				if( !empty($citations['DIV']) )
					$info .= writeCitation( $citations['DIV'], 2 );
				if( !empty($extras['DIV']) )
					$info .= $extras['DIV'];
			}

			$query = "SELECT tag, description, eventdate, eventplace, age, agency, cause, addressID, info, eventID FROM $events_table, $eventtypes_table WHERE persfamID = \"$familyID\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID AND parenttag = \"\" AND gedcom = \"$tree\" AND keep = \"1\" ORDER BY eventdate, ordernum, tag";
			$custevents = tng_query($query);
			while ( $custevent = tng_fetch_assoc( $custevents ) ) {
				$info .= doEvent( $custevent, 1 );
				$eventID = $custevent['eventID'];
				$info .= doNotesAndMedia($famnotes, $fammedia, $eventID, 2 );
				if( !empty($citations[$eventID]) )
					$info .= writeCitation( $citations[$eventID], 2 );
				$info .= getFact( $custevent, 2 );
			}

			if( $frights['lds'] ) {
				if( $family['sealdate'] || $family['sealplace'] ) {
					$info .= "1 SLGS$lineending";
					if( $family['sealdate'] ) { $info .= "2 DATE {$family['sealdate']}$lineending"; }
					if( $family['sealplace'] ) {
						$tok = strtok ($family['sealplace']," ");
						if( strlen( $tok ) == 5 ) {
							$info .= "2 TEMP $tok$lineending";
							$tok = strtok( " " );
							if( $tok )
								$info .= writePlace($tok,2);
						}
						else
							$info .= writePlace($family['sealplace'],2);
					}
					$info .= doNotesAndMedia($famnotes, $fammedia, "SLGS", 2 );
					if( $citations['SLGS'] )
						$info .= writeCitation( $citations['SLGS'], 2 );
					$info .= $extras['SLGS'];
				}
			}
			$info .= doAssociations($familyID);

			if( !empty($citations['NAME']) )
				$info .= writeCitation( $citations['NAME'], 1 );

			if( !empty($famnotes['-x--general--x-']) )
				$info .= writeNote( 1, "NOTE", $famnotes['-x--general--x-'] );

			if( !empty($fammedia['-x--general--x-']) )
				$info .= writeMediaLinks( $fammedia['-x--general--x-'], 1 );
		}
		$info .= $childdata;

		if($family['changedate']) {
			$info .= "1 CHAN$lineending";
			$info .= "2 DATE {$family['changedate']}$lineending";
		}

		fwrite( $fp, $info );
		$savestate['fcount']++;
		if( $savestate['fcount'] % 10 == 0 ) {
			echo "<strong>F{$savestate['fcount']}</strong> ";
		}
	}
	return $info;
}

function doSources( ) {
	global $tree, $sources_table, $admtext, $savestate, $tngconfig, $allsources, $allrepos, $branch;

	$sourcestr = "";
	if($branch) {
		$newsources = array_unique( $allsources );
		if( count($newsources) ) {
			foreach( $newsources as $nextsource ) {
				$srcquery = "SELECT * FROM $sources_table WHERE sourceID = \"$nextsource\" AND gedcom = \"$tree\"";
				$srcresult = tng_query($srcquery) or die ($text['cannotexecutequery'] . ": $query");
				if( $srcresult ) {
					$source = tng_fetch_assoc( $srcresult );
					if($branch && trim($source['repoID']))
						array_push( $allrepos, $source['repoID'] );
					$sourcestr .= writeSource($source);
					tng_free_result( $srcresult );
				}
			}
		}
	}
	else {
		$prefixlen = strlen( $tngconfig['sourceprefix'] ) + 1;

		if( !empty($tngconfig['sourceprefix']) ) {
			$prefixlen = strlen( $tngconfig['sourceprefix'] ) + 1;
			$numstr = "(0+SUBSTRING(sourceID,$prefixlen))";
		}
		else {
			$numstr = "(0+SUBSTRING_INDEX(sourceID,\"{\$tngconfig['sourcesuffix']}\",1))";
		}

		$srcquery = "SELECT *, $numstr as num FROM $sources_table WHERE gedcom = \"$tree\" {$savestate['wherestr']} ORDER BY num";
		$srcresult = tng_query($srcquery) or die ($admtext['cannotexecutequery'] . ": $query");
		while( $source = tng_fetch_assoc( $srcresult ) ) {
			$sourcestr .= writeSource($source);
		}
		tng_free_result( $srcresult );
	}

	return $sourcestr;
}

function writeSource($source) {
	global $admtext, $tree, $saveimport_table, $events_table, $eventtypes_table, $savestate, $lineending, $saveimport, $fp;

	$sourcestr = "";
	$srcnotes = getNotes( $source['sourceID'] );
	$srcmedia = getMediaLinks( $source['sourceID'] );

	$sourcestr .= "0 @{$source['sourceID']}@ SOUR$lineending";
	if( $source['title'] ) { $sourcestr .= "1 TITL {$source['title']}$lineending"; }
	if( $source['shorttitle'] ) { $sourcestr .= "1 ABBR {$source['shorttitle']}$lineending"; }
	if( $source['author'] ) { $sourcestr .= "1 AUTH {$source['author']}$lineending"; }
	if( $source['publisher'] ) { $sourcestr .= "1 PUBL {$source['publisher']}$lineending"; }
	if( $source['repoID'] ) { 
		$sourcestr .= "1 REPO @{$source['repoID']}@$lineending"; 
		if( $source['callnum'] ) { $sourcestr .= "2 CALN {$source['callnum']}$lineending"; }
	}
	else if( $source['callnum'] ) { $sourcestr .= "1 CALN {$source['callnum']}$lineending"; }

	$query = "SELECT tag, description, eventdate, eventplace, info, eventID FROM $events_table, $eventtypes_table WHERE persfamID = \"{$source['sourceID']}\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID AND type = \"S\" AND gedcom = \"$tree\" AND keep = \"1\" ORDER BY ordernum";
	$custevents = tng_query($query);
	while ( $custevent = tng_fetch_assoc( $custevents ) ) {
		$sourcestr .= doEvent( $custevent, 1 );
		$eventID = $custevent['eventID'];
		$sourcestr .= doNotesAndMedia($srcnotes, $srcmedia, $eventID, 2 );
	}
	tng_free_result( $custevents );

	if( $source['actualtext'] )
		$sourcestr .= writeNote( 1, "TEXT", $source['actualtext'] );
	if( !empty($srcnotes['-x--general--x-']) )
		$sourcestr .= writeNote( 1, "NOTE", $srcnotes['-x--general--x-'] );

	if( !empty($srcmedia['-x--general--x-']) )
		$sourcestr .= writeMediaLinks( $srcmedia['-x--general--x-'], 1 );

	$savestate['scount']++;
	if( $saveimport ) {
		$savestate['fileoffset'] = ftell($fp);
		$query = "UPDATE $saveimport_table SET fileoffset={$savestate['fileoffset']}, lasttype={$savestate['lasttype']}, lastid=\"{$source['sourceID']}\", scount=\"{$savestate['scount']}\" WHERE gedcom = \"$tree\"";
		$saveresult = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
	}
	if( $savestate['scount'] % 10 == 0 ) {
		echo "<strong>S{$savestate['scount']}</strong> ";
	}

	return $sourcestr;
}

function doRepositories( ) {
	global $tree, $branch, $repositories_table, $admtext, $savestate, $tngconfig, $allrepos;

	$repostr = "";

	if($branch) {
		$newrepos = array_unique( $allrepos );
		if( count($newrepos) ) {
			foreach( $newrepos as $nextrepo ) {
				$repoquery = "SELECT * FROM $repositories_table WHERE repoID = \"$nextrepo\" AND gedcom = \"$tree\"";
				$reporesult = tng_query($repoquery) or die ($text['cannotexecutequery'] . ": $query");
				if( $reporesult ) {
					$repo = tng_fetch_assoc( $reporesult );
					$repostr .= writeRepository($repo);
					tng_free_result( $reporesult );
				}
			}
		}
	}
	else {
		$prefixlen = strlen( $tngconfig['repoprefix'] ) + 1;

		if($tngconfig['repoprefix']) {
			$prefixlen = strlen( $tngconfig['repoprefix'] ) + 1;
			$numstr = "(0+SUBSTRING(repoID,$prefixlen))";
		}
		else {
			$numstr = "(0+SUBSTRING_INDEX(repoID,\"{\$tngconfig['reposuffix']}\",1))";
		}

		$repoquery = "SELECT *, $numstr as num FROM $repositories_table WHERE gedcom = \"$tree\" {$savestate['wherestr']} ORDER BY num";
		$reporesult = tng_query($repoquery) or die ($admtext['cannotexecutequery'] . ": $query");

		while( $repo = tng_fetch_assoc( $reporesult ) ) {
			$repostr .= writeRepository($repo);
		}
		tng_free_result( $reporesult );
	}

	return $repostr;
}

function writeRepository($repo) {
	global $tree, $events_table, $eventtypes_table, $admtext, $savestate, $lineending, $saveimport, $saveimport_table, $fp;

	$repostr = "";
	$reponotes = getNotes( $repo['repoID'] );
	$repomedia = getMediaLinks( $repo['repoID'] );

	$repostr .= "0 @{$repo['repoID']}@ REPO$lineending";
	if( $repo['reponame'] ) { $repostr .= "1 NAME {$repo['reponame']}$lineending"; }
	if( $repo['addressID'] ) { $repostr .= getFact( $repo, 1 ); }

	$query = "SELECT tag, description, eventdate, eventplace, info FROM $events_table, $eventtypes_table WHERE persfamID = \"{$repo['repoID']}\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID AND type = \"R\" AND gedcom = \"$tree\" AND keep = \"1\" ORDER BY ordernum";
	$custevents = tng_query($query);
	while ( $custevent = tng_fetch_assoc( $custevents ) ) {
		$repostr .= doEvent( $custevent, 1 );
	}
	tng_free_result( $custevents );

	if( !empty($reponotes['-x--general--x-']) )
		$repostr .= writeNote( 1, "NOTE", $reponotes['-x--general--x-'] );

	if( !empty($repomedia['-x--general--x-']) )
		$repostr .= writeMediaLinks( $repomedia['-x--general--x-'], 1 );

	$savestate['rcount']++;
	if( $saveimport ) {
		$savestate['fileoffset'] = ftell($fp);
		$query = "UPDATE $saveimport_table SET fileoffset={$savestate['fileoffset']}, lasttype={$savestate['lasttype']}, lastid=\"{$repo['repoID']}\", rcount=\"{$savestate['rcount']}\" WHERE gedcom = \"$tree\"";
		$saveresult = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
	}
	if( $savestate['rcount'] % 10 == 0 ) {
		echo "<strong>R{$savestate['rcount']}</strong> ";
	}

	return $repostr;
}

function writePlace($place, $level) {
	global $branch, $placelist, $lineending;

	if($branch && !in_array($place,$placelist))
		array_push($placelist, $place);
	return "$level PLAC $place$lineending";
}

function doPlaces() {
    global $tngconfig, $tree, $branch, $placelist, $admtext, $places_table, $medialinks_table, $savestate, $lineending, $saveimport, $saveimport_table, $fp;

    if($tngconfig['places1tree']) {
        $treestr = $jtreestr = "";
    }
    else {
        $treestr = "AND $places_table.gedcom = \"$tree\"";
        $jtreestr = "AND $places_table.gedcom = $medialinks_table.gedcom";
    }
    $places = array();

	if($branch) {
		foreach($placelist as $place) {
		    $query = "SELECT place, notes, latitude, longitude, placelevel, zoom FROM $places_table WHERE place = \"" . addslashes($place) . "\" $treestr";
		    $result = @tng_query($query) or die($admtext['cannotexecutequery'] . ": $query");
		    $row = tng_fetch_assoc( $result );
			if($row['latitude'] || $row['longitude'] || $row['notes']){
		        $places[] = $row;
		    }
		    tng_free_result( $result );
		}
	}
	else {
	    $query = "SELECT place, notes, latitude, longitude, placelevel, zoom FROM $places_table WHERE (latitude != \"\" OR longitude != \"\" OR notes != \"\") $treestr";
	    $result = @tng_query($query) or die($admtext['cannotexecutequery'] . ": $query");
	    while( $row = tng_fetch_assoc( $result ) ) {
	        $places[] = $row;
	    }
	    tng_free_result( $result );

	    $query = "SELECT $medialinks_table.personID as place, $places_table.notes as notes, latitude, longitude, placelevel, zoom
	        FROM ($places_table, $medialinks_table)
	        WHERE linktype = \"L\" $treestr AND $places_table.place = $medialinks_table.personID $jtreestr";
	    $result = @tng_query($query) or die($admtext['cannotexecutequery'] . ": $query");
	    while( $row = tng_fetch_assoc( $result ) ) {
	        if(!in_array($row,$places))
	            $places[] = $row; //should be OK to overwrite, because it should all be the same
	    }
	    tng_free_result( $result );
	}


    $placestr = "";
    foreach($places as $place) {
        $placemedia = getMediaLinks( $place['place'] );
        //export
		$placestr .= "0 _PLAC {$place['place']}$lineending";
        if($place['latitude'] || $place['longitude']) {
            $placestr .= "1 MAP$lineending";
            $placestr .= "2 LATI {$place['latitude']}$lineending";
            $placestr .= "2 LONG {$place['longitude']}$lineending";
            $placestr .= "2 ZOOM {$place['zoom']}$lineending";
            $placestr .= "2 PLEV {$place['placelevel']}$lineending";
        }
        if($place['notes'])
            $placestr .= writeNote( 1, "NOTE", $place['notes'] );
        if($placemedia)
            $placestr .= writeMediaLinks($placemedia['-x--general--x-'], 1);

		$savestate['pcount']++;
		if( $savestate['pcount'] % 10 == 0 ) {
			if( $saveimport ) {
				$savestate['fileoffset'] = ftell($fp);
				$query = "UPDATE $saveimport_table SET fileoffset={$savestate['fileoffset']}, lasttype={$savestate['lasttype']}, lastid=\"" . addslashes($place['place']) . "\", pcount=\"{$savestate['pcount']}\" WHERE gedcom = \"$tree\"";
				$saveresult = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
			}
			echo "<strong>P{$savestate['pcount']}</strong> ";
		}
    }

    return $placestr;
}

function doMedia() {
	global $branchmedia;

	$media = count($branchmedia) ? $branchmedia : getMediaLinks("");
 	return writeMediaLinks($media,0);
}

?>
<p class="normal"><strong><?php echo $admtext['exporting']; ?></strong></p>
<?php
if( $saveimport )
	echo "<p>{$admtext['ifexportfails']} <a href=\"admin_gedcom2.php?tree=$tree&amp;exliving=$exliving&amp;exprivate=$exprivate&amp;exnotes=$exnotes&amp;exportmedia=$exportmedia&amp;exportmediafiles=$exportmediafiles&amp;resume=1\">{$admtext['clickresume']}</a>.</p>$lineending";

@set_time_limit(0);
$xnotes = array();

$largechunk = 1000;
$fullgedpath = !empty($tngimpcfg['saveconfig']) ? $subroot . $gedpath : $rootpath . $gedpath;
$filename = "$fullgedpath/$tree.ged";
$zipfilename = "$fullgedpath/$tree.zip";
$medialist = "$fullgedpath/medialist_$tree.txt";
$found = 0;

//if saving is enabled and URL flag is set, check the db table to see if a record exists
if( $saveimport ) {
	if( !empty($resume) ) {
		$checksql = "SELECT filename, fileoffset, lasttype, lastid, icount, fcount, scount, ncount, rcount, mcount, pcount, media from $saveimport_table WHERE gedcom = \"$tree\"";
		$result = @tng_query( $checksql ) or die ($admtext['cannotexecutequery'] . ": $checksql");
		$found = tng_num_rows( $result );
		if( $found ) {
			$row = tng_fetch_assoc($result);
			$filename = $row['filename'];
			$savestate['fileoffset'] = $row['fileoffset'];
			$savestate['icount'] = $row['icount'];
			$savestate['fcount'] = $row['fcount'];
			$savestate['scount'] = $row['scount'];
			$savestate['ncount'] = $row['ncount'];
			$savestate['rcount'] = $row['rcount'];
			$savestate['media'] = $row['media'];
			$savestate['mcount'] = $row['mcount'];
			$savestate['pcount'] = $row['pcount'];
			//retrieve entity type (I = 1, F = 2, S = 3, X = 4, R = 5)
			$savestate['lasttype'] = $row['lasttype'];
			$prefix = $suffix = "";
			switch( $savestate['lasttype'] ) {
				case 1:
					$prefix = $tngconfig['personprefix'];
					$suffix = $tngconfig['personsuffix'];
					$idstring = "personID";
					break;
				case 2:
					$prefix = $tngconfig['familyprefix'];
					$suffix = $tngconfig['familysuffix'];
					$idstring = "familyID";
					break;
				case 3:
					$prefix = $tngconfig['sourceprefix'];
					$suffix = $tngconfig['sourcesuffix'];
					$idstring = "sourceID";
					break;
				case 4:
					$prefix = $tngconfig['noteprefix'];
					$suffix = $tngconfig['notesuffix'];
					$idstring = "noteID";
					break;
				case 5:
					$prefix = $tngconfig['repoprefix'];
					$suffix = $tngconfig['reposuffix'];
					$idstring = "repoID";
					break;
			}
			if($prefix) {
				$prefixlen = strlen( $prefix ) + 1;
				$savestate['wherestr'] = " AND (0+SUBSTRING($idstring,$prefixlen)) > \"" . substr($row['lastid'],$prefixlen-1) . "\"";
			}
			else {
				$suffixlen = strlen( $suffix ) * -1;
				$savestate['wherestr'] = " AND (0+SUBSTRING_INDEX($idstring,'$suffix',1)) > \"" . substr($row['lastid'],0,$suffixlen) . "\"";
			}
		}
		tng_free_result($result);
	}
	else {
		$query = "DELETE from $saveimport_table WHERE gedcom = \"$tree\"";
		$result = tng_query($query);

		$sql = "INSERT INTO $saveimport_table (filename, fileoffset, gedcom, media)  VALUES(\"$filename\", 0, \"$tree\", \"$exportmedia\")";
		$result = @tng_query( $sql ) or die ($admtext['cannotexecutequery'] . ": $sql");
	}
}
if( $found ) {
	$fp = @fopen( $filename, "r+" );
	fseek( $fp, $savestate['fileoffset'] );
}
else {
	if( file_exists( $filename ) ) unlink( $filename );
	if( file_exists( $medialist ) ) unlink( $medialist );
	$fp = @fopen( $filename, "w" );
	$savestate['lasttype'] = 1;
	$savestate['icount'] = 0;
	$savestate['fcount'] = 0;
	$savestate['scount'] = 0;
	$savestate['ncount'] = 0;
	$savestate['rcount'] = 0;
	$savestate['mcount'] = 0;
	$savestate['pcount'] = 0;
	$savestate['media'] = $exportmedia;
}
if( !$fp ) { die ( $admtext['cannotopen'] . " " . $filename ); }
flock( $fp, LOCK_EX );

$mediafp = @fopen( $medialist, "a" );

//if saving is enabled, write out new information after each person/family/source/repo

$numrows = 0;

$maxgcgen = 999;

if( !$found ) {
	$query = "SELECT email, owner FROM $trees_table WHERE gedcom = \"$tree\"";
	$treeresult = tng_query($query);
	$treerow = tng_fetch_assoc($treeresult);
	tng_free_result( $treeresult );

	$owneremail = !empty($treerow['email']) ? $treerow['email'] : $emailaddr;
	$ownername = !empty($treerow['owner']) ? $treerow['owner'] : $dbowner;

	$firstpart = "0 HEAD$lineending"
	. "1 SOUR The Next Generation of Genealogy Sitebuilding$lineending"
	. "2 VERS $tng_version$lineending"
	. "2 NAME The Next Generation of Genealogy Sitebuilding (R)$lineending"
	. "2 CORP Next Generation Software, LLC$lineending"
	. "3 ADDR Sandy, UT$lineending"
	. "1 FILE $tree.ged$lineending"
	. "1 GEDC$lineending"
	. "2 VERS 5.5.1$lineending"
	. "2 FORM LINEAGE-LINKED$lineending"
	. "1 CHAR " . ($session_charset == "UTF-8" ? "UTF-8" : "ANSI" ) . $lineending
	. "1 SUBM @SUB1@$lineending"
	. "0 @SUB1@ SUBM$lineending"
	. "1 NAME $ownername$lineending"
	. "1 EMAIL $owneremail$lineending";
	//if( $templeready ) $firstpart .= "1 DEST TempleReady$lineending";

	fwrite( $fp, "$firstpart" );
}

$prefixlen = strlen( $tngconfig['personprefix'] ) + 1;
$branchstr = !empty($branch) ? " AND branch LIKE \"%$branch%\"" : "";
$exlivingstr = !empty($exliving) ? " AND living != \"1\"" : "";
$exprivatestr = !empty($exprivate) ? " AND private != \"1\"" : "";

if( $savestate['lasttype'] < 2 ) {
	$nextchunk = -1;
	do {
		$nextone = $nextchunk + 1;
		$nextchunk += $largechunk;

		if($tngconfig['personprefix']) {
			$prefixlen = strlen( $tngconfig['personprefix'] ) + 1;
			$numstr = "(0+SUBSTRING(personID,$prefixlen))";
		}
		else {
			$numstr = "(0+SUBSTRING_INDEX(personID,\"" . $tngconfig['personsuffix'] . "\",1))";
		}

		if( !isset($savestate['wherestr']) ) $savestate['wherestr'] = "";
		$query = "SELECT personID, $numstr as num, lastname, lnprefix, firstname, sex, title, prefix, suffix, nickname, birthdate, birthdatetr, birthplace, altbirthtype, altbirthdate, altbirthdatetr, altbirthplace, deathdate, deathdatetr, deathplace, burialdate, burialdatetr, burialplace, burialtype, baptdate, baptplace, confdate, confplace, initdate, initplace, endldate, endlplace, famc, living, private, branch, gedcom, DATE_FORMAT(changedate,\"%d %b %Y\") as changedate FROM $people_table
			WHERE gedcom = \"$tree\"$branchstr$exlivingstr$exprivatestr {$savestate['wherestr']} ORDER BY num LIMIT $nextone, $largechunk";
		$result = tng_query($query);
		if( $result ) {
			$numrows = tng_num_rows( $result );
			while( $ind = tng_fetch_assoc( $result ) ) {
				if( $ind['personID'] ) {
					writeIndividual( $ind );
					if( $saveimport ) {
						$savestate['fileoffset'] = ftell($fp);
						$query = "UPDATE $saveimport_table SET fileoffset={$savestate['fileoffset']}, lasttype={$savestate['lasttype']}, lastid=\"{$ind['personID']}\", icount=\"{$savestate['icount']}\" WHERE gedcom = \"$tree\"";
						$saveresult = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
					}
				}
			}
			tng_free_result( $result );
		}
	} while ( $numrows );
	$savestate['lasttype'] = 2;
	$savestate['wherestr'] = "";
}

$prefixlen = strlen( $tngconfig['familyprefix'] ) + 1;

if( $savestate['lasttype'] < 3 ) {
	$nextchunk = -1;
	do {
		$nextone = $nextchunk + 1;
		$nextchunk += $largechunk;

		if( !empty($tngconfig['familyprefix']) ) {
			$prefixlen = strlen( $tngconfig['familyprefix'] ) + 1;
			$numstr = "(0+SUBSTRING(familyID,$prefixlen))";
		}
		else {
			$numstr = "(0+SUBSTRING_INDEX(familyID,\"{\$tngconfig['familysuffix']}\",1))";
		}

		$query = "SELECT *, (0+SUBSTRING(familyID,$prefixlen)) as num, DATE_FORMAT(changedate,\"%d %b %Y\") as changedate FROM $families_table
			WHERE gedcom = \"$tree\"$branchstr {$savestate['wherestr']}$exlivingstr$exprivatestr ORDER BY num LIMIT $nextone, $largechunk";
		$result = tng_query($query);
		if( $result ) {
			$numrows = tng_num_rows( $result );
			while( $fam = tng_fetch_assoc( $result ) ) {
				if( $fam['familyID'] ) {
					$famarray[$fam['familyID']] = writeFamily( $fam );
					if( $saveimport ) {
						$savestate['fileoffset'] = ftell($fp);
						$query = "UPDATE $saveimport_table SET fileoffset={$savestate['fileoffset']}, lasttype={$savestate['lasttype']}, lastid=\"{$fam['familyID']}\", fcount=\"{$savestate['fcount']}\" WHERE gedcom = \"$tree\"";
						$saveresult = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
					}
				}
			}
			tng_free_result( $result );
		}
	} while ( $numrows );
	$savestate['lasttype'] = 3;
	$savestate['wherestr'] = "";
}

if( $savestate['lasttype'] < 4 ) {
	fwrite( $fp, doSources() );
	$savestate['lasttype'] = 4;
	$savestate['wherestr'] = "";
}
if( $savestate['lasttype'] < 5 ) {
	fwrite( $fp, doXNotes() );
	$savestate['lasttype'] = 5;
	$savestate['wherestr'] = "";
}
if( $savestate['lasttype'] < 6 ) {
	fwrite( $fp, doRepositories() );
	$savestate['lasttype'] = 6;
	$savestate['wherestr'] = "";
}
if( $savestate['lasttype'] < 7 ) {
    fwrite( $fp, doPlaces() );
	$savestate['lasttype'] = 7;
	$savestate['wherestr'] = "";
}
if( $savestate['lasttype'] < 8 ) {
    fwrite( $fp, doMedia() );
	$savestate['lasttype'] = 8;
	$savestate['wherestr'] = "";
}

fwrite( $fp, "0 TRLR$lineending" );

flock( $fp, LOCK_UN );
fclose( $fp );
@chmod( $filename, 0644 );

if( $saveimport ) {
	$sql = "DELETE from $saveimport_table WHERE gedcom = \"$tree\"";
	$result = @tng_query($sql) or die ($admtext['cannotexecutequery'] . ": $query");
}

$gotzip = false;
if($exportmediafiles) {
	$paths = file($medialist);
	if(count($paths)) {
		$zip = new ZipArchive;
		$res = $zip->open($zipfilename, ZipArchive::CREATE);
		if($res === TRUE) {
			$zip->addFile($filename, "$tree.ged");
			foreach($paths as $path) {
				$path = trim($path);
				if(file_exists($rootpath . $path))
                	$zip->addFile($rootpath . $path, $path);
				else
                	echo "<br /><strong>" . $admtext['cannotopen'] . ":&nbsp; " . $rootpath . $path . "</strong>\n";
			}
			$zip->close();
			$gotzip = true;
		}
	}
}
?>

<p class="normal">
<?php
	adminwritelog( $admtext['export'] . ": $tree" );
	echo "{$admtext['finishedexporting']} <br/>{$savestate['icount']} {$admtext['people']}, {$savestate['fcount']} {$admtext['families']}, {$savestate['scount']} {$admtext['sources']}, {$savestate['rcount']} {$admtext['repositories']}, {$savestate['ncount']} {$admtext['notes']}, {$savestate['mcount']} {$admtext['media']}, {$savestate['pcount']} {$admtext['places']}";
	if( file_exists( $medialist ) ) unlink( $medialist );
?>
</p>

<?php
	if(empty($tngimpcfg['saveconfig'])){
?>
<p class="normal">
	<a href="<?php echo "$gedpath/$tree" . ".ged" ?>" download><?php echo $admtext['downloadged']; ?></a>
<?php
	if($gotzip) {
		echo "\n<br/><a href=\"{$gedpath}/{$tree}.zip\" download>{$admtext['downloadzip']}</a>\n";
	}
?>
</p>
<?php
	}
?>

</div></div>

<?php 
echo tng_adminfooter();
?>
