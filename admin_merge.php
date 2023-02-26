<?php
include("begin.php");
include("adminlib.php");
$textpart = "people";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = true;
include("checklogin.php");
include("version.php");

require("adminlog.php");

if( !$allow_edit || !$allow_delete ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$deleteblankfamilies = 1;

if( $assignedtree )
	$wherestr = "WHERE gedcom = \"$assignedtree\"";
else
	$wherestr = "";
$query = "SELECT gedcom, treename FROM $trees_table $wherestr ORDER BY treename";
$treeresult = tng_query($query);

if( $assignedbranch )
	$branchstr = " AND branch LIKE \"%$assignedbranch%\"";
else
	$branchstr = "";

$righttree = checktree(isset($tree) ? $tree : "");
$ldsOK = determineLDSRights();

/*
$mprefix = $tngconfig['personprefix'];
if($mprefix) {
	$len = strlen($mprefix);
	if($personID1 && substr($personID1,0,$len) != $mprefix)
		$personID1 = $mprefix . $personID1; 
	if($personID2 && substr($personID2,0,$len) != $mprefix)
		$personID2 = $mprefix . $personID2; 
}
else {
	$msuffix = $tngconfig['personsuffix'];
	$len = -1 * strlen($msuffix);
	if($personID1 && substr($personID1,$len) != $msuffix)
		$personID1 = $msuffix . $personID1; 
	if($personID2 && substr($personID2,$len) != $msuffix)
		$personID2 = $msuffix . $personID2; 
}
*/
$personID1 = isset($personID1) ? strtoupper($personID1) : "";
$personID2 = isset($personID2) ? strtoupper($personID2) : "";

function doRow( $field, $textmsg, $boxname ) {
	global $p1row, $p2row, $admtext;
	
	if( $field == "living" )  {
		$p1field = isset($p1row[$field]) && $p1row[$field] ? "Yes" : "No";
		$p2field = isset($p2row[$field]) && $p2row[$field] ? "Yes" : "No";
	}
	else {
		$p1field = isset($p1row[$field]) ? $p1row[$field] : "";
		$p2field = isset($p2row[$field]) ? $p2row[$field] : "";
	}

	if( $p1field || $p2field ) {
		echo "<tr>\n";
		echo "<td valign=\"top\" width=\"15%\" class=\"fieldnameback\" nowrap><span class=\"fieldname\"><strong>{$admtext[$textmsg]}:</strong></span></td>";
		echo "<td valign=\"top\" width=\"31%\" class=\"lightback\"><span class=\"normal\">$p1field&nbsp;</span></td>";
		if( is_array( $p2row ) ) {
			echo "<td width=\"10\">&nbsp;&nbsp;</td>";
			echo "<td valign=\"top\" width=\"15%\" class=\"fieldnameback\" nowrap><span class=\"fieldname\"><strong>{$admtext[$textmsg]}:</strong></span></td>";
			echo "<td valign=\"top\" width=\"5\" class=\"lightback\"><span class=\"normal\">";
			//if it's a spouse and they're equal, do a hidden field for p1 & p2 and don't do the checkbox
			if( $textmsg == "spouse" ) {
				if( $p1field && $p2field )
					echo "<input type=\"hidden\" name=\"xx$boxname\" value=\"$field\">";
				elseif( $p2field )
					echo "<input type=\"hidden\" name=\"yy$boxname\" value=\"$field\">";
			}
			if( $boxname ) {
				if( $p2field || $textmsg != "spouse" ) {
					echo "<input type=\"checkbox\" name=\"$boxname\" value=\"$field\"";
					if(!empty($p2row[$field]) && empty($p1row[$field])) echo " checked";
					echo ">";
				}
				elseif( $textmsg == "spouse" )
					echo "<input type=\"checkbox\" name=\"zz$boxname\" value=\"$field\">";
			}
			else
				echo "&nbsp;";
			echo "</span></td>";
			if(!$p2field)
				$p2field = "<span class=\"msgerror\">&laquo; " . $admtext['chkdel'] . "</span>";
			echo "<td valign=\"top\" width=\"31%\" class=\"lightback\"><span class=\"normal\">$p2field&nbsp;</span></td>";
		}
		else {
			echo "<td width=\"10\">&nbsp;&nbsp;</td>";
			echo "<td valign=\"top\" width=\"15%\" class=\"fieldnameback\" nowrap><span class=\"fieldname\"><strong>{$admtext[$textmsg]}:</strong></span></td>";
			echo "<td valign=\"top\" width=\"5\" class=\"lightback\"><span class=\"normal\">&nbsp;</span></td>";
			echo "<td valign=\"top\" width=\"31%\" class=\"lightback\"><span class=\"normal\">&nbsp;</span></td>";
		}
		echo "</tr>\n";
	}
}

function getEvent( $event ) {
	global $mylanguage, $languages_path;

	$dispvalues = explode( "|", $event['display'] );
	$numvalues = count( $dispvalues );
	if( $numvalues > 1 ) {
		$displayval = "";
		for( $i = 0; $i < $numvalues; $i += 2 ) {
			$lang = $dispvalues[$i];
			if( $mylanguage == $languages_path . $lang ) {
				$displayval = $dispvalues[$i+1];
				break;
			}
		}
	}
	else
		$displayval = $event['display'];

	$eventstr = "<strong>$displayval</strong>: ";
	$eventstr2 = $event['eventdate'];
	if( $eventstr2 && $event['eventplace'] )
		$eventstr2 .= ", ";
	$eventstr2 .= $event['eventplace'];
	if( $eventstr2 && $event['info'] )
		$eventstr2 .= ". ";
	$eventstr2 .= $event['info'] . "<br/>\n";
	$eventstr .= $eventstr2;

	return $eventstr;
}

function getSpouse( $marriage, $spouse ) {
	global $people_table, $admtext, $tree, $ldsOK, $righttree;
	
	$spousestr = "";
	if( $marriage[$spouse] ) {
		$query = "SELECT personID, lastname, firstname, prefix, suffix, nameorder FROM $people_table WHERE personID = \"{$marriage[$spouse]}\" AND gedcom = \"$tree\"";
		$gotspouse= tng_query($query);
		$spouserow =  tng_fetch_assoc( $gotspouse );

		$srights = determineLivingPrivateRights($spouserow, $righttree);
		$spouserow['allow_living'] = $srights['living'];
		$spouserow['allow_private'] = $srights['private'];

		$spousestr .= getName( $spouserow ) . " - " . $spouserow['personID'] . " ({$marriage['familyID']})<br/>\n";
		tng_free_result( $gotspouse );
	}
	else
		$spousestr = "({$marriage['familyID']})<br/>\n";
	if( $marriage['marrdate'] || $marriage['marrplace'] ) {
		$spousestr .= "<strong>{$admtext['MARR']}</strong>: {$marriage['marrdate']}";
		if( $marriage['marrdate'] && $marriage['marrplace'] ) $spousestr .= ", ";
		$spousestr .= "{$marriage['marrplace']}<br/>\n";
	}
	if( $ldsOK ) {
		if( $marriage['sealdate'] || $marriage['sealplace'] ) {
			$spousestr .= "<strong>{$admtext['SLGS']}:</strong> {$marriage['sealdate']}";
			if( $marriage['sealdate'] && $marriage['sealplace'] ) $spousestr .= ", ";
			$spousestr .= "{$marriage['sealplace']}<br/>\n";
		}
	}

	return $spousestr;
}

function getParents( $parent ) {
	global $people_table, $families_table, $admtext, $tree, $righttree, $ldsOK;
	
	$parentstr = "";
	$query = "SELECT personID, lastname, firstname, prefix, suffix, nameorder FROM $people_table, $families_table WHERE $people_table.personID = $families_table.husband AND $families_table.familyID = \"{$parent['familyID']}\" AND $people_table.gedcom = \"$tree\" AND $families_table.gedcom = \"$tree\"";
	$gotfather = tng_query($query);

     if( $gotfather ) { 		
		$fathrow =  tng_fetch_assoc( $gotfather );

		$frights = determineLivingPrivateRights($fathrow, $righttree);
		$fathrow['allow_living'] = $frights['living'];
		$fathrow['allow_private'] = $frights['private'];

		$parentstr .= getName( $fathrow ) . " - " . $fathrow['personID'] . "<br/>\n";
		tng_free_result( $gotfather );
	}

	$query = "SELECT personID, lastname, firstname, prefix, suffix, nameorder FROM $people_table, $families_table WHERE $people_table.personID = $families_table.wife AND $families_table.familyID = \"{$parent['familyID']}\" AND $people_table.gedcom = \"$tree\" AND $families_table.gedcom = \"$tree\"";
	$gotmother = tng_query($query);

	if( $gotmother ) {
		$mothrow =  tng_fetch_assoc( $gotmother );

		$mrights = determineLivingPrivateRights($mothrow, $righttree);
		$mothrow['allow_living'] = $mrights['living'];
		$mothrow['allow_private'] = $mrights['private'];

		$parentstr .= getName( $mothrow ) . " - " . $mothrow['personID'] . "<br/>\n";
		tng_free_result( $gotmother );
	} 
	if( $ldsOK ) {
		if( $parent['sealdate'] || $parent['sealplace'] ) {
			$parentstr .= "<strong>{$admtext['SLGC']}:</strong> " . $parent['sealdate'];
			if( $parent['sealdate'] && $parent['sealplace'] ) $parentstr .= ", ";
			$parentstr .= "{$parent['sealplace']}<br/>\n";
		}
	}

	return $parentstr;
}

function addCriteria( $row ) {
	global $cfirstname, $clastname, $cbirthdate, $cbirthplace, $cchrdate, $cchrplace, $cdeathdate, $cdeathplace, $cignoreblanks, $csoundex;
	
	$criteria = "";
	$bsx = $csoundex ? "SOUNDEX(" : "";
	$esx = $csoundex ? ")" : "";
	if( $cfirstname == "yes" && isset($row['firstname'])) {
		$criteria .= " AND $bsx" . "firstname" . "$esx = $bsx\"" . addslashes( $row['firstname'] ) . "\"$esx";
		$criteria .= $cignoreblanks == "yes" ? " AND firstname != \"\"" : "";
	}
	if( $clastname == "yes" && isset($row['lastname'])) {
		$criteria .= " AND $bsx" . "lastname" . "$esx = $bsx\"" . addslashes( $row['lastname'] ) . "\"$esx";
		$criteria .= $cignoreblanks == "yes" ? " AND lastname != \"\"" : "";
	}
	if( $cbirthdate == "yes" && isset($row['birthdate'])) {
		$criteria .= " AND birthdate = \"" . addslashes( $row['birthdate'] ) . "\"";
		$criteria .= $cignoreblanks == "yes" ? " AND birthdate != \"\"" : "";
	}
	if( $cbirthplace == "yes" && isset($row['birthplace'])) {
		$criteria .= " AND birthplace = \"" . addslashes( $row['birthplace'] ) . "\"";
		$criteria .= $cignoreblanks == "yes" ? " AND birthplace = \"\"" : "";
	}
	if( $cchrdate == "yes" && isset($row['altbirthdate'])) {
		$criteria .= " AND altbirthdate = \"" . addslashes( $row['altbirthdate'] ) . "\"";
		$criteria .= $cignoreblanks == "yes" ? " AND altbirthdate != \"\"" : "";
	}
	if( $cchrplace == "yes" && isset($row['altbirthplace'])) {
		$criteria .= " AND altbirthplace = \"" . addslashes( $row['altbirthplace'] ) . "\"";
		$criteria .= $cignoreblanks == "yes" ? " AND altbirthplace = \"\"" : "";
	}
	if( $cdeathdate == "yes" && isset($row['deathdate'])) {
		$criteria .= " AND deathdate = \"" . addslashes( $row['deathdate'] ) . "\"";
		$criteria .= $cignoreblanks == "yes" ? " AND deathdate != \"\" AND deathdate != \"Y\"" : "";
	}
	if( $cdeathplace == "yes" && isset($row['deathplace'])) {
		$criteria .= " AND deathplace = \"" . addslashes( $row['deathplace'] ) . "\"";
		$criteria .= $cignoreblanks == "yes" ? " AND deathplace = \"\"" : "";
	}
	
	return $criteria;
}

function doNotesCitations( $persfam1, $persfam2, $varname ) {
	global $ccombinenotes, $admtext, $notelinks_table, $citations_table, $tree;
	
	if( $varname ) {
		if( $varname == "general" )
			$varname = "";
		$wherestr = "AND eventID = \"$varname\"";
	}
	else $wherestr = "";
	
	if( $ccombinenotes != "yes" ) {
		$query = "SELECT xnoteID FROM $notelinks_table WHERE persfamID = \"$persfam1\" AND gedcom = \"$tree\" $wherestr";
		$noteresult = tng_query($query);
		while( $row = tng_fetch_assoc( $noteresult ) ) {
			$query = "DELETE FROM $xnotes_table WHERE ID=\"{$row['xnoteID']}\"";
			$noteresult = tng_query($query);
		}
		tng_free_result($noteresult);

		$query = "DELETE from $notelinks_table WHERE persfamID = \"$persfam1\" AND gedcom = \"$tree\" $wherestr";
		$noteresult = tng_query($query);

		$query = "DELETE from $citations_table WHERE persfamID = \"$persfam1\" AND gedcom = \"$tree\" $wherestr";
		$citeresult = tng_query($query);
	}
	$query = "UPDATE $notelinks_table set persfamID = \"$persfam1\" WHERE persfamID = \"$persfam2\" AND gedcom = \"$tree\" $wherestr";
	$noteresult = tng_query($query);

	$query = "UPDATE $citations_table set persfamID = \"$persfam1\" WHERE persfamID = \"$persfam2\" AND gedcom = \"$tree\" $wherestr";
	$citeresult = tng_query($query);
}

function doAssociations($personID1, $personID2) {
	global $tree, $admtext, $assoc_table;

	$query = "UPDATE $assoc_table set personID = \"$personID1\" WHERE personID = \"$personID2\" AND gedcom = \"$tree\"";
	$assocresult = tng_query($query);

	$query = "UPDATE $assoc_table set passocID = \"$personID1\" WHERE passocID = \"$personID2\" AND gedcom = \"$tree\"";
	$assocresult = tng_query($query);
}

function delAssociations($entity) {
	global $tree, $admtext, $assoc_table;

	$query = "DELETE FROM $assoc_table WHERE personID = \"$entity\" AND gedcom = \"$tree\"";
	$assocresult = tng_query($query);

	$query = "DELETE FROM $assoc_table WHERE passocID = \"$entity\" AND gedcom = \"$tree\"";
	$assocresult = tng_query($query);
}

function doDNAtests($personID1, $personID2) {
	global $tree, $dna_tests_table, $dna_links_table;

	$query = "UPDATE $dna_tests_table set personID = \"$personID1\" WHERE personID = \"$personID2\" AND gedcom = \"$tree\"";
	$result = tng_query($query);

	$query = "UPDATE $dna_links_table set personID = \"$personID1\" WHERE personID = \"$personID2\" AND gedcom = \"$tree\"";
	$result = tng_query($query);
}

function removeSpouse($key,$personID) {
	global $tree, $families_table;

	$varname = substr( $key, 8 );

	//blank out person1 spouse, but it could be wife or husband
	$query = "UPDATE $families_table set husband = \"\", husborder = \"\" WHERE familyID = \"$varname\" AND gedcom = \"$tree\" AND husband = \"$personID\"";
	$chilresult = tng_query_noerror($query);
	$query = "UPDATE $families_table set wife = \"\", wifeorder = \"\" WHERE familyID = \"$varname\" AND gedcom = \"$tree\" AND wife = \"$personID\"";
	$chilresult = tng_query_noerror($query);
}

function getFamilyForSpouse($personID,$otherspouse) {
	global $tree, $families_table;

	//select union where husband/wife or wife/husband
	$query = "(SELECT familyID, husband, wife, husborder, wifeorder FROM $families_table WHERE gedcom = \"$tree\" AND husband = \"$personID\" AND wife = \"" . substr($otherspouse, 6) . "\") UNION
		(SELECT familyID, husband, wife, husborder, wifeorder FROM $families_table WHERE gedcom = \"$tree\" AND wife = \"$personID\" AND husband = \"" . substr($otherspouse, 6) . "\")";
	//$query = "SELECT familyID, husband, wife, husborder, wifeorder FROM $families_table WHERE gedcom = \"$tree\" AND $p1self = \"$personID1\" AND $p1spouse = \"" . substr($value, 6) . "\"";
	$spresult = tng_query($query);
	$sprow =  tng_fetch_assoc( $spresult );
	tng_free_result($spresult);

	return $sprow;
}

$p1row = $p2row = "";
if( $personID1 ) {
	if(is_numeric($personID1)) 
		$personID1 = $tngconfig['personprefix'] . $personID1 . $tngconfig['personsuffix'];	
	$query = "SELECT *, DATE_FORMAT(changedate,\"%d %b %Y %H:%i:%s\") as changedate FROM $people_table WHERE personID = \"$personID1\" and gedcom = \"$tree\"";
	$result = tng_query($query);
	if( $result && tng_num_rows( $result ) ) {
		$p1row = tng_fetch_assoc( $result );
        $p1row['name'] = getName($p1row);
		tng_free_result($result);
	}
	else
		$personID1 = $personID2 = "";
}
if( $personID2 && is_numeric($personID2)) 
	$personID2 = $tngconfig['personprefix'] . $personID2 . $tngconfig['personsuffix'];

@set_time_limit(0);
if(!isset($mergeaction)) $mergeaction = "";
if( !$mergeaction ) {
	$cfirstname = "yes";
	$clastname = "yes";
	$ccombinenotes = "yes";
	$ccombineextras = "yes";
}
if( $mergeaction == $admtext['nextmatch'] || $mergeaction ==$admtext['nextdup'] ) {
	if( $mergeaction == $admtext['nextmatch'] ) {
		$wherestr2 = $personID2 ? " AND personID > \"$personID2\"" : "";
		$wherestr2 .= $personID1 ? " AND personID > \"$personID1\"" : "";

		$wherestr = $personID1 ? "AND personID > \"$personID1\"" : "";
		$largechunk = 1000;
		$nextchunk = -1;
		$numrows = 0;
		$still_looking = 1;
		$personID2 = "";
		
		do {
			$nextone = $nextchunk + 1;
			$nextchunk += $largechunk;
	
			$query = "SELECT * FROM $people_table WHERE gedcom = \"$tree\" $branchstr $wherestr ORDER BY LENGTH(personID), personID, lastname, firstname LIMIT $nextone, $largechunk";
			$result = tng_query($query);
			$numrows = tng_num_rows( $result );
			if( $result && $numrows ) {
				while( $still_looking && $row = tng_fetch_assoc( $result ) ) {
					//echo "compare $row['firstname'] $row['lastname']<br/>\n";
					$wherestr2 = addCriteria( $row );

					$query = "SELECT * FROM $people_table WHERE personID > \"{$row['personID']}\" AND gedcom = \"$tree\" $branchstr $wherestr2 ORDER BY LENGTH(personID), personID, lastname, firstname LIMIT 1";
					//echo "q2: $query<br/>\n";
					$result2 = tng_query($query);
					if( $result2 && tng_num_rows( $result2 ) ) {
						//set personID1, personID2
						$p1row = $row;
						$personID1 = $p1row['personID'];
						$p2row = tng_fetch_assoc( $result2 );
						//echo "found $p2row['firstname'] $p2row['lastname']<br/>\n";
						$personID2 = $p2row['personID'];
						tng_free_result( $result2 );
						$still_looking = 0;
					}
				}
				tng_free_result( $result );
			}
		} while ( $numrows && $still_looking );
		if( !$personID2 ) $personID1 = $p1row = "";
	}
	elseif(isset($p1row['personID'])) {
		//search with personID1 for next duplicate
		$wherestr2 = $personID2 ? " AND personID > \"$personID2\"" : "";
		$wherestr2 .= addCriteria( $p1row );

		$query = "SELECT * FROM $people_table WHERE personID != \"{$p1row['personID']}\" AND gedcom = \"$tree\" $branchstr $wherestr2 ORDER BY LENGTH(personID), personID, lastname, firstname LIMIT 1";
		$result2 = tng_query($query);
		if( $result2 && tng_num_rows( $result2 ) ) {
			$p2row = tng_fetch_assoc( $result2 );
			$personID2 = $p2row['personID'];
            $p2row['name'] = getName($p2row);
			tng_free_result( $result2 );
		}
		else
			$personID2 = "";
	}
}
elseif( $personID2 ) {
	$query = "SELECT *, DATE_FORMAT(changedate,\"%d %b %Y %H:%i:%s\") as changedate FROM $people_table WHERE personID = \"$personID2\" AND gedcom = \"$tree\"";
	$result2 = tng_query($query);
	if( $result2 && tng_num_rows( $result2 ) && $personID1 != $personID2 ) {
		$p2row = tng_fetch_assoc( $result2 );
		$personID2 = $p2row['personID'];
		tng_free_result($result2);
	}
	else {
		$mergeaction = $admtext['comprefresh'];
		$personID2 = "";
	}
}
if( $mergeaction == $admtext['merge'] ) {
	$updatestr = "";
	$prifamily = 0;

	if ( $p1row['sex'] == "M" ) { $p1spouse = "wife"; $p1self = "husband"; $p1spouseorder = "husborder";	}
	elseif( $p1row['sex'] == "F" ) { 	$p1spouse = "husband"; $p1self = "wife"; $p1spouseorder = "wifeorder";	}
	else {	$p1spouse = ""; $p1self = ""; $p1spouseorder = "";	}

	foreach( $_POST as $key=>$value ) {
		$prefix = substr( $key, 0, 2 );
		switch( $prefix ) {
			case "p2":
				$varname = substr( $key, 2 );
				$p1row[$varname] = $p2row[$varname];
				$updatestr .= ", $varname = \"" . addslashes($p1row[$varname]) . "\" ";
				if(strpos($varname,"date")) {
					$truevar = $varname . "tr";
					$p1row[$truevar] = $p2row[$truevar];
					$updatestr .= ", $truevar = \"{$p1row[$truevar]}\" ";
				}
				elseif( $varname == "firstname" || $varname == "lastname" )
					$varname = "NAME";
				doNotesCitations( $personID1, $personID2, $varname );
				break;
			case "ev":
				if(strpos($key,"::")) {
					$halves = explode("::",substr($key,5));
					$varname = substr(strstr($halves[1], "_"),1);
					$query = "DELETE from $events_table WHERE persfamID = \"$personID1\" AND gedcom = \"$tree\" and eventID = \"$varname\"";
					$evresult = tng_query($query);
					$varname = $halves['0'] != "event" ? substr(strstr($halves['0'], "_"),1) : "";
				}
				else {
					$varname = substr(strstr($key, "_"),1);
				}
				if($varname) {
					$query = "SELECT eventID FROM $events_table WHERE persfamID = \"$personID2\" AND  gedcom = \"$tree\" and eventID = \"$varname\"";
					$evresult = tng_query($query);
					while( $evrow = tng_fetch_assoc( $evresult ) )
						doNotesCitations( $personID1, $personID2, $evrow['eventID'] );
					tng_free_result( $evresult );

					$query = "UPDATE $events_table set persfamID = \"$personID1\" WHERE persfamID = \"$personID2\" AND gedcom = \"$tree\" AND eventID = \"$varname\"";
					$evresult = tng_query_noerror($query);
				}
				break;
			case "pa":
				$varname = substr( $key, 7 );
				$query = "DELETE from $children_table WHERE personID = \"$personID1\" AND gedcom = \"$tree\" and familyID = \"$varname\"";
				$evresult = tng_query($query);

				//if not selected, delete child record for person 2

				$query = "UPDATE $children_table set personID = \"$personID1\" WHERE personID = \"$personID2\" AND gedcom = \"$tree\" AND familyID = \"$varname\"";
				$evresult = tng_query_noerror($query);
				if( !$prifamily ) {
					$updatestr .= ", famc = \"$varname\" ";
					$prifamily = 1;
				}
				break;
			case "xx":
				$samespouse = substr( $key, 2 );
				//remove family on right, but move children to left
				if( !$_POST[$samespouse] && $p1self ) {
					$varname = substr( $key, 8 );

					//delete family on right (important to do deleting first)
					$query = "DELETE from $families_table WHERE familyID = \"$varname\" AND gedcom = \"$tree\"";
					$famresult = tng_query($query);

					//get families where left person is the husband/wife and right SPOUSE is the wife/husband
					$sp1row = getFamilyForSpouse($personID1,$value);

					delAssociations($varname);

					$updated = 0;
					if( $ccombineextras ) {
						$query = "UPDATE IGNORE $medialinks_table set personID = \"{$sp1row['familyID']}\" WHERE personID = \"$varname\" AND gedcom = \"$tree\"";
						$mediaresult = tng_query_noerror($query);
						$updated = tng_affected_rows();
					}
					if(!$updated)
						$query = "DELETE FROM $medialinks_table WHERE personID = \"$varname\" AND gedcom = \"$tree\"";
					$mediaresult = tng_query_noerror($query);

					//update all people records where FAMC = the deleted family, set FAMC = family on left
					$query = "UPDATE $people_table set famc = \"{$sp1row['familyID']}\" WHERE famc = \"$varname\" AND gedcom = \"$tree\"";
					$paresult = tng_query_noerror($query);

					//move kids from right family to left
					$query = "UPDATE $children_table set familyID = \"{$sp1row['familyID']}\" WHERE familyID = \"$varname\" AND gedcom = \"$tree\"";
					$chilresult = tng_query_noerror($query);
					if( !$chilresult ) {
						$query = "DELETE FROM $children_table WHERE familyID = \"$varname\" AND gedcom = \"$tree\"";
						$chilresult = tng_query_noerror($query);
					}

					if( $ccombinenotes && $varname)
						doNotesCitations( $sp1row['familyID'], $varname, "" );

					$query = "UPDATE $events_table set persfamID = \"{$sp1row['familyID']}\" WHERE persfamID = \"$varname\" AND gedcom = \"$tree\"";
					$evresult = tng_query_noerror($query);
				}
				break;
			case "yy":
				$samespouse = substr( $key, 2 );
				//basically, we're keeping the right family, but we're removing the right person as a spouse. Corresponding box was not checked, so it's not merging left.
				if( !$_POST[$samespouse] ) {
					removeSpouse($key, $personID1);
				}
				break;
			case "zz":
				removeSpouse($key, $personID1);
				break;
			case "sp":
				$xx = "xx$key";
				//do we need this check? It won't be true if the person is of unknown gender, but that shouldn't stop us
				if( $_POST[$xx] ) {
					$varname = substr( $key, 6 );

					//same spouse, box checked, so we're removing LEFT family, moving kids over to left family
					$sp1row = getFamilyForSpouse($personID1,$value);
					//use correct spouse
					if($personID1 == $sp1row['husband'])
						$query = "UPDATE $families_table set husband = \"$personID1\", wifeorder = \"{$sp1row['wifeorder']}\" WHERE familyID = \"$varname\" AND gedcom = \"$tree\"";
					else
						$query = "UPDATE $families_table set wife = \"$personID1\", husborder = \"{$sp1row['husborder']}\" WHERE familyID = \"$varname\" AND gedcom = \"$tree\"";

					$chilresult = tng_query_noerror($query);

					//delete family on LEFT
					$query = "DELETE from $families_table WHERE familyID = \"{$sp1row['familyID']}\" AND gedcom = \"$tree\"";
					$famresult = tng_query($query);

					doAssociations($varname, $sp1row['familyID']);

					$updated = 0;
					if( $ccombineextras ) {
						$query = "UPDATE IGNORE $medialinks_table set personID = \"$varname\" WHERE personID = \"{$sp1row['familyID']}\" AND gedcom = \"$tree\"";
						$mediaresult = tng_query_noerror($query);
						$updated = tng_affected_rows();
					}
					if(!$updated)
						$query = "DELETE FROM $medialinks_table WHERE personID = \"{$sp1row['familyID']}\" AND gedcom = \"$tree\"";
					$mediaresult = tng_query_noerror($query);

					//update all people records where FAMC = the deleted family, set FAMC = family on right
					$query = "UPDATE $people_table set famc = \"$varname\" WHERE famc = \"{$sp1row['familyID']}\" AND gedcom = \"$tree\"";
					$paresult = tng_query_noerror($query);

					//move all children from family1 to family2
					$query = "UPDATE $children_table set familyID = \"$varname\" WHERE familyID = \"{$sp1row['familyID']}\" AND gedcom = \"$tree\"";
					$chilresult = tng_query_noerror($query);
					if( !$chilresult ) {
						$query = "DELETE FROM $children_table WHERE familyID = \"{$sp1row['familyID']}\" AND gedcom = \"$tree\"";
						$chilresult = tng_query_noerror($query);
					}

					if( $ccombinenotes && $sp1row['familyID'])
						doNotesCitations( $varname, $sp1row['familyID'], "" );

					$query = "UPDATE $events_table set persfamID = \"{$sp1row['familyID']}\" WHERE persfamID = \"$varname\" AND gedcom = \"$tree\"";
					$evresult = tng_query_noerror($query);
				}
				else {
					//this means spouses are different, the box has been checked, so they want to keep the right spouse + family
					$varname = substr( $key, 6 );

					//get families where right person is married to right spouse
					//do union husband/wife and wife/husband
					$sp1row = getFamilyForSpouse($personID2,$value);

					//get spouse order for left person, add one
					//do union husband/wife and wife/husband
					$query = "(SELECT husband, wife, husborder, wifeorder FROM $families_table WHERE gedcom = \"$tree\" AND husband = \"$personID1\") UNION
						(SELECT husband, wife, husborder, wifeorder FROM $families_table WHERE gedcom = \"$tree\" AND wife = \"$personID1\") ORDER BY husborder, wifeorder DESC";
					//$query = "SELECT $p1spouseorder FROM $families_table WHERE gedcom = \"$tree\" AND $p1self = \"$personID1\" ORDER BY $p1spouseorder DESC";
					$spresult = tng_query($query);
					$sprow =  tng_fetch_assoc( $spresult );
					tng_free_result($spresult);

					//update those families to have left person married to right spouse, change spouse order
					//use queries above to determine who is who first
					if($personID2 == $sp1row['husband']) {
						$sporder = $sprow['wifeorder'] + 1;
						$query = "UPDATE $families_table set husband = \"$personID1\", wifeorder = \"$sporder\" WHERE familyID = \"$varname\" AND gedcom = \"$tree\"";
					}
					elseif($personID2 == $sp1row['wife']) {
						$sporder = $sprow['husborder'] + 1;
						$query = "UPDATE $families_table set wife = \"$personID1\", husborder = \"$sporder\" WHERE familyID = \"$varname\" AND gedcom = \"$tree\"";
					}
					//$query = "UPDATE $families_table set $p1self = \"$personID1\", $p1spouseorder = \"$sporder\" WHERE familyID = \"$varname\" AND gedcom = \"$tree\"";
					$chilresult = tng_query_noerror($query);
				}
				break;
		}
	}
	if( $ccombinenotes ) {
		doNotesCitations( $personID1, $personID2, "general" );

		//convert all remaining notes and citations
		$query = "UPDATE $notelinks_table set persfamID = \"$personID1\" WHERE persfamID = \"$personID2\" AND gedcom = \"$tree\"";
		$noteresult = tng_query($query);
	
		$query = "UPDATE $citations_table set persfamID = \"$personID1\" WHERE persfamID = \"$personID2\" AND gedcom = \"$tree\"";
		$citeresult = tng_query($query);
	}
	if( $updatestr ) {
		$updatestr = substr( $updatestr, 2 );
		$newdate = date ("Y-m-d H:i:s", time() + ( 3600 * $time_offset ) );
		$updatestr .= ", changedate = \"$newdate\"";
		$query = "UPDATE $people_table set $updatestr WHERE personID = \"$personID1\" AND gedcom = \"$tree\"";
		$combresult = tng_query($query);
	}

	$query = "DELETE from $people_table WHERE personID = \"$personID2\" AND gedcom = \"$tree\"";
	$combresult = tng_query($query);
	
	//delete remaining notes, citations & events for person 2
	$query = "DELETE from $events_table WHERE persfamID = \"$personID2\" AND gedcom = \"$tree\"";
	$combresult = tng_query($query);

	$query = "SELECT xnoteID FROM $notelinks_table WHERE persfamID = \"$persfam2\" AND gedcom = \"$tree\"";
	$noteresult = tng_query($query);
	while( $row = tng_fetch_assoc( $noteresult ) ) {
		$query = "DELETE FROM $xnotes_table WHERE ID=\"{$row['xnoteID']}\"";
		$noteresult2 = tng_query($query);
	}
	tng_free_result($noteresult);

	$query = "DELETE from $notelinks_table WHERE persfamID = \"$personID2\" AND gedcom = \"$tree\"";
	$combresult = tng_query($query);

	$query = "DELETE from $citations_table WHERE persfamID = \"$personID2\" AND gedcom = \"$tree\"";
	$combresult = tng_query($query);

	doAssociations($personID1, $personID2);
	doDNAtests($personID1, $personID2);

	//update families: remove person2 as spouse from all families
	//use an OR or two separate update queries blank out correct family
	$query = "UPDATE $families_table set husband = \"\", wifeorder = \"0\" WHERE husband = \"$personID2\" AND gedcom = \"$tree\"";
	$chilresult = tng_query($query);
	$query = "UPDATE $families_table set wife = \"\", husborder = \"0\" WHERE wife = \"$personID2\" AND gedcom = \"$tree\"";
	$chilresult = tng_query($query);
	
	//remove person2 from children table
	$query = "DELETE FROM $children_table WHERE personID = \"$personID2\" AND gedcom = \"$tree\"";
	$chilresult = tng_query($query);

	//construct name for default photo 2
	$defaultphoto2 = $tree ? "$rootpath$photopath/$tree.$personID2.$photosext" : "$rootpath$photopath/$personID2.$photosext";
	$updated = 0;
	if( $ccombineextras ) {
		$query = "UPDATE IGNORE $medialinks_table set personID = \"$personID1\", defphoto = \"\" WHERE personID = \"$personID2\" AND gedcom = \"$tree\"";
		$mediaresult = tng_query_noerror($query);
		$updated = tng_affected_rows();

		//construct name for default photo 1
		if( file_exists( $defaultphoto2 ) ) {
			$defaultphoto1 = $tree ? "$rootpath$photopath/$tree.$personID1.$photosext" : "$rootpath$photopath/$personID1.$photosext";
			if( !file_exists( $defaultphoto1 ) )
				rename( $defaultphoto2, $defaultphoto1 );
			//else
				//unlink( $defaultphoto2 );
		}
	}
	if(!$updated) {
		$query = "DELETE FROM $medialinks_table WHERE personID = \"$personID2\" AND gedcom = \"$tree\"";
		$mediaresult = tng_query($query);

		//if( file_exists( $defaultphoto2 ) )
			//unlink( $defaultphoto2 );
	}

	//clean up: remove all families with husband blank and wife blank
	//remove all children from those families
	if( $deleteblankfamilies ) {
		$query = "SELECT familyID FROM $families_table WHERE gedcom = \"$tree\" AND husband = \"\" AND wife = \"\"";
		$blankfams = tng_query($query);
		while( $blankrow = tng_fetch_assoc( $blankfams ) ) {
			$query = "DELETE FROM $children_table WHERE familyID = \"{$blankrow['familyID']}\" AND gedcom = \"$tree\"";
			$chilresult = tng_query($query);

			$query = "UPDATE $people_table SET famc=\"\" WHERE famc = \"{$blankrow['familyID']}\" AND gedcom = \"$tree\"";
			$result2 = tng_query($query);
		}
		tng_free_result( $blankfams );
		$query = "DELETE FROM $families_table WHERE gedcom = \"$tree\" AND husband = \"\" AND wife = \"\"";
		$famresult = tng_query($query);
	}
	adminwritelog( "{$admtext['merge']}: $tree/$personID2 => $personID1" );

	$personID2 = "";
	$p2row = "";
}

$helplang = findhelp("people_help.php");

$revstar = checkReview("I");

tng_adminheader( $admtext['merge'], $flags );
?>
<script type="text/javascript" src="js/selectutils.js"></script>
<script type="text/javascript">
var tree = "<?php echo $tree; ?>";
function validateForm( ) {
	var rval = true;
	
	if( document.form1.personID1.value == '' || document.form1.personID2.value == '' || document.form1.personID1.value == document.form1.personID2.value )
		rval = false;
	else
		rval = confirm( '<?php echo $admtext['confirmmerge']; ?>' );

	return rval;
}

function getTree(treefield) {
	if( treefield.options.length ) 
		return treefield.options['treefield.selectedIndex'].value;
	else {
		alert("<?php echo $admtext['selecttree']; ?>");
		return false;
	}
}

function switchpeople() {
	var formname = document.form1;
	
	if( formname.personID1.value && formname.personID2.value ) {
		var temp = formname.personID1.value;
		
		formname.personID1.value = formname.personID2.value;
		formname.personID2.value = temp;
		
		return true;
	}
	else
		return false;

}

function processEnter() {
	var keycode;
	if(event) keycode = event.keyCode;
	else if(e) keycode = e.which;
	else return true;

	if(keycode == 13) {
		event.preventDefault();
		event.stopPropagation();
		jQuery('#compref').click();
		return false;
	}
}
</script>
<script type="text/javascript" src="js/admin.js"></script>
</head>

<?php
	echo tng_adminlayout();

	$peopletabs['0'] = array(1,"admin_people.php",$admtext['search'],"findperson");
	$peopletabs['1'] = array($allow_add,"admin_newperson.php",$admtext['addnew'],"addperson");
	$peopletabs['2'] = array($allow_edit,"admin_findreview.php?type=I",$admtext['review'] . $revstar,"review");
	$peopletabs['3'] = array($allow_edit && $allow_delete,"admin_merge.php",$admtext['merge'],"merge");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/people_help.php#merge');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($peopletabs,"merge",$innermenu);
	echo displayHeadline($admtext['people'] . " &gt;&gt; " . $admtext['merge'],"img/people_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">
	<span class="subhead"><strong><?php echo $admtext['findmatches']; ?></strong></span><br/><br/>
	<div class="normal"><em><?php echo $admtext['choosemerge']; ?></em><br/><br/>
	<form action="admin_merge.php" method="post" name="form1" id="form1">
	<table>
		<tr>
			<td><span class="normal"><?php echo $admtext['tree']; ?>:</span></td>
			<td>
				<select name="tree">
<?php
$trees = "";
while( $treerow = tng_fetch_assoc($treeresult) ) {
	$trees .= "			<option value=\"{$treerow['gedcom']}\"";
	if( $treerow['gedcom'] == $tree ) $trees .= " selected";
	$trees .= ">{$treerow['treename']}</option>\n";
}
echo $trees;
$firstcols = !$tngconfig['hidechr'] ? 7 : 5;
$mergeclass = $personID1 && $personID2 ? "class=\"btn\"" : "class=\"disabled\" disabled";
?>
				</select>	
			</td>
		</tr>
		<tr><td></td></tr>
	</table><br/>
	<table class="normal">
		<tr>
			<td><div style="float:left"><?php echo $admtext['personid']; ?> 1: <input type="text" name="personID1" id="personID1" size="10" value="<?php echo $personID1; ?>"> &nbsp;<?php echo $admtext['text_or']; ?>&nbsp;</div>
			<a href="#" onclick="return findItem('I','personID1','name1',document.form1.tree.options[document.form1.tree.selectedIndex].value,'<?php echo $assignedbranch; ?>');" title="<?php echo $admtext['find']; ?>" class="smallicon admin-find-icon"></a></td>
			<td width="80">&nbsp;</td>
			<td><div style="float:left"><?php echo $admtext['personid']; ?> 2: <input type="text" name="personID2" id="personID2" size="10" value="<?php echo $personID2; ?>" onkeyup="processEnter();"> &nbsp;<?php echo $admtext['text_or']; ?>&nbsp;</div>
			<a href="#" onclick="return findItem('I','personID2','name2',document.form1.tree.options[document.form1.tree.selectedIndex].value,'<?php echo $assignedbranch; ?>');" title="<?php echo $admtext['find']; ?>" class="smallicon admin-find-icon"></a></td>
		</tr>
	    <tr>
            <td id="name1"><?php if(isset($p1row['reponame'])) echo truncateIt($r1row['reponame'],75); ?></td>
            <td width="80"></td>
            <td id="name2"><?php if(isset($p2row['reponame'])) echo truncateIt($r2row['reponame'],75); ?></td>
        </tr>
	</table><br/>
	<table>
		<tr>
			<td colspan="<?php echo $firstcols; ?>"><span class="normal"><strong><?php echo $admtext['matchthese']; ?></strong></span></td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td colspan="3"><span class="normal"><strong><?php echo $admtext['otheroptions']; ?></strong></span></td>
		</tr>
		<tr>			
			<td>
				<span class="normal">
				<input type="checkbox" name="cfirstname" value="yes"<?php if( $cfirstname ) echo " checked"; ?>> <?php echo $admtext['firstname']; ?><br/>
				<input type="checkbox" name="clastname" value="yes"<?php if( $clastname ) echo " checked"; ?>> <?php echo $admtext['lastname']; ?>
				</span>
			</td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td>
				<span class="normal">
				<input type="checkbox" name="cbirthdate" value="yes"<?php if( isset($cbirthdate) && $cbirthdate == "yes" ) echo " checked"; ?>> <?php echo $admtext['birthdate']; ?><br/>
				<input type="checkbox" name="cbirthplace" value="yes"<?php if( isset($cbirthplace) && $cbirthplace == "yes" ) echo " checked"; ?>> <?php echo $admtext['birthplace']; ?>
				</span>
			</td>
			<td>&nbsp;&nbsp;&nbsp;</td>
<?php
	if(!$tngconfig['hidechr']) {
?>
			<td>
				<span class="normal">
				<input type="checkbox" name="cchrdate" value="yes"<?php if( isset($cchrdate) && $cchrdate == "yes" ) echo " checked"; ?>> <?php echo $admtext['chrdate']; ?><br/>
				<input type="checkbox" name="cchrplace" value="yes"<?php if( isset($cchrplace) && $cchrplace == "yes" ) echo " checked"; ?>> <?php echo $admtext['chrplace']; ?>
				</span>
			</td>
			<td>&nbsp;&nbsp;&nbsp;</td>
<?php
	}
?>
			<td>
				<span class="normal">
				<input type="checkbox" name="cdeathdate" value="yes"<?php if( isset($cdeathdate) && $cdeathdate == "yes" ) echo " checked"; ?>> <?php echo $admtext['deathdate']; ?><br/>
				<input type="checkbox" name="cdeathplace" value="yes"<?php if( isset($cdeathplace) && $cdeathplace == "yes" ) echo " checked"; ?>> <?php echo $admtext['deathplace']; ?>
				</span>
			</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>
				<span class="normal">
				<input type="checkbox" name="cignoreblanks" value="yes"<?php if( isset($cignoreblanks) && $cignoreblanks == "yes" ) echo " checked"; ?>> <?php echo $admtext['ignoreblanks']; ?><br/>
				<input type="checkbox" name="csoundex" value="yes"<?php if( isset($csoundex) && $csoundex == "yes" ) echo " checked"; ?>> <?php echo $admtext['usesoundex']; ?>*
				</span>
			</td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td>
				<span class="normal">
				<input type="checkbox" name="ccombinenotes" value="yes"<?php if( $ccombinenotes == "yes" ) echo " checked"; ?>> <?php echo $admtext['combinenotes']; ?><br/>
				<input type="checkbox" name="ccombineextras" value="yes"<?php if( $ccombineextras == "yes" ) echo " checked"; ?>> <?php echo $admtext['combineextras']; ?>
				</span>
			</td>
		</tr>
	</table><br/>
	<input type="submit" class="btn" value="<?php echo $admtext['nextmatch']; ?>" name="mergeaction">
	<input type="submit" class="btn" value="<?php echo $admtext['nextdup']; ?>" name="mergeaction">
	<input type="submit" class="btn" value="<?php echo $admtext['comprefresh']; ?>" name="mergeaction" id="compref">
	<input type="submit" class="btn" value="<?php echo $admtext['mswitch']; ?>" name="mergeaction" onClick="document.form1.mergeaction.value='<?php echo $admtext['comprefresh']; ?>'; return switchpeople();">
	<input type="submit" <?php echo $mergeclass; ?> value="<?php echo $admtext['merge']; ?>" name="mergeaction" onClick="return validateForm();">
	<br/><br/>
	<table cellpadding="3" cellspacing="1" border="0"  width="100%" class="normal">
<?php
	if( is_array( $p1row ) ) {
		$parentsets = array();
		$spouses = array();
		$eventlist = array();
		echo "<tr>\n";
		echo "<td colspan=\"3\"><strong class=\"subhead\">{$admtext['person']} 1 | <a href=\"\" onclick=\"window.open('admin_editperson.php?personID={$p1row['personID']}&amp;tree=$tree&amp;cw=1');return false;\">{$admtext['edit']}</a></strong></td>\n";
		if( is_array( $p2row ) ) {
			echo "<td colspan=\"3\"><strong class=\"subhead\">{$admtext['person']} 2 | <a href=\"\" onclick=\"window.open('admin_editperson.php?personID={$p2row['personID']}&amp;tree=$tree&amp;cw=1');return false;\">{$admtext['edit']}</a></strong></td>\n";

			$query = "SELECT display, eventdate, eventplace, info, $events_table.eventtypeID as eventtypeID, $events_table.eventID as eventID FROM $events_table, $eventtypes_table WHERE persfamID = \"{$p2row['personID']}\" AND gedcom = \"$tree\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID ORDER BY ordernum";
			$evresult = tng_query($query);
			$eventcount = tng_num_rows( $evresult );
		
			if( $evresult && $eventcount ) {
				while ( $event = tng_fetch_assoc( $evresult ) ) {
					$ekey = strtoupper("{$event['eventtypeID']}_{$event['eventdate']}_{$event['eventplace']}_" . substr($event['info'],0,100));
					$ekey = preg_replace("/\"/", "", $ekey);
					$ename = "event$ekey";
					$p2row[$ename] = (isset($p2row[$ename]) ? $p2row[$ename] : "") . getEvent( $event );
					$eventlist[$ekey] = "{$event['eventtypeID']}_{$event['eventID']}";
				}
				tng_free_result($evresult);
			}

			$query = "SELECT personID, familyID, sealdate, sealplace FROM $children_table WHERE personID = \"{$p2row['personID']}\" AND gedcom = \"$tree\"";
			$parents2 = tng_query($query);

			if( $parents2 && tng_num_rows( $parents2 ) ) {
				while ( $parent = tng_fetch_assoc( $parents2 ) ) {
					$pname = "parents" . $parent['familyID'];
					$p2row[$pname] = getParents( $parent );
					if( !in_array( $parent['familyID'], $parentsets ) )
						array_push( $parentsets, $parent['familyID'] );
				}
			}

			//don't need check, then use UNION in query
			$query = "(SELECT husband, wife, familyID, marrdate, marrplace, sealdate, sealplace FROM $families_table WHERE husband = \"{$p2row['personID']}\" AND gedcom = \"$tree\") UNION
				(SELECT husband, wife, familyID, marrdate, marrplace, sealdate, sealplace FROM $families_table WHERE wife = \"{$p2row['personID']}\" AND gedcom = \"$tree\")";
			$marriages2 = tng_query($query);

			//figure out which spouse we have
			while ( $marriage = tng_fetch_assoc( $marriages2 ) ) {
				$p2spouse = $marriage['husband'] == $p2row['personID'] ? "wife" : "husband";
				$mname = "spouse$marriage[$p2spouse]";
				$p2row[$mname] = getSpouse( $marriage, $p2spouse );
				if( !in_array( $marriage[$p2spouse], $spouses ) ) {
					array_push( $spouses, $marriage[$p2spouse] );
   					$marriages[$marriage[$p2spouse]] = $marriage['familyID'];
				}
			}
		}
		echo "</tr>\n";
		doRow( "personID", "personid", "" );
		doRow( "firstname", "firstgivennames", "p2firstname" );
		if($lnprefixes)
			doRow( "lnprefix", "lnprefix", "p2lnprefix" );
		doRow( "lastname", "lastsurname", "p2lastname" );
		doRow( "nickname", "nickname", "p2nickname" );
		doRow( "prefix", "prefix", "p2prefix" );
		doRow( "suffix", "suffix", "p2suffix" );
		doRow( "title", "title", "p2title" );
		doRow( "living", "living", "p2living" );
		doRow( "birthdate", "birthdate", "p2birthdate" );
		doRow( "birthplace", "birthplace", "p2birthplace" );
		doRow( "sex", "sex", "p2sex" );
		doRow( "altbirthdate", "chrdate", "p2altbirthdate" );
		doRow( "altbirthplace", "chrplace", "p2altbirthplace" );
		doRow( "deathdate", "deathdate", "p2deathdate" );
		doRow( "deathplace", "deathplace", "p2deathplace" );
		doRow( "burialdate", "burialdate", "p2burialdate" );
		doRow( "burialplace", "burialplace", "p2burialplace" );
		if( $ldsOK ) {
			doRow( "baptdate", "bapldate", "p2baptdate" );
			doRow( "baptplace", "baplplace", "p2baptplace" );
			doRow( "confdate", "confdate", "p2confdate" );
			doRow( "confplace", "confplace", "p2confplace" );
			doRow( "initdate", "initdate", "p2initdate" );
			doRow( "initplace", "initplace", "p2initplace" );
			doRow( "endldate", "endldate", "p2endldate" );
			doRow( "endlplace", "endlplace", "p2endlplace" );
		}
		$query = "SELECT display, eventdate, eventplace, info, $events_table.eventtypeID as eventtypeID, $events_table.eventID as eventID FROM $events_table, $eventtypes_table WHERE persfamID = \"{$p1row['personID']}\" AND gedcom = \"$tree\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID ORDER BY ordernum";
		$evresult = tng_query($query);
		$eventcount = tng_num_rows( $evresult );
		
		if( $evresult && $eventcount ) {
			while ( $event = tng_fetch_assoc( $evresult ) ) {
				$ekey = strtoupper("{$event['eventtypeID']}_{$event['eventdate']}_{$event['eventplace']}_" . substr($event['info'],0,100));
				$ekey = preg_replace("/\"/", "", $ekey);
				$ename = "event$ekey";
				$p1row[$ename] = (isset($p1row[$ename]) ? $p1row[$ename] : "") . getEvent( $event );
				if(!empty($eventlist[$ekey]))
					$eventlist[$ekey] .= "::" . "{$event['eventtypeID']}_{$event['eventID']}";
				else
					$eventlist[$ekey] = "::" . "{$event['eventtypeID']}_{$event['eventID']}";
			}
			tng_free_result($evresult);
		}
		
		foreach( $eventlist as $key => $event ) {
		//need to pass the eventtype + eventID as the key, perhaps as double key separated by ::
		//key may only need to be "event" + sequence number
			$ename = "event$key";
			$inputname = "event$event";
			//echo "key:$key<br>event=$event<br>";
			doRow( $ename, "otherevents", $inputname );
		}

		$query = "SELECT personID, familyID, sealdate, sealplace FROM $children_table WHERE personID = \"{$p1row['personID']}\" AND gedcom = \"$tree\"";
		$parents1 = tng_query($query);

		if( $parents1 && tng_num_rows( $parents1 ) ) {
			while ( $parent = tng_fetch_assoc( $parents1 ) ) {
				$pname = "parents" . $parent['familyID'];
				$p1row[$pname] = getParents( $parent );
				if( !in_array( $parent['familyID'], $parentsets ) )
					array_push( $parentsets, $parent['familyID'] );
			}
		}

		foreach( $parentsets as $parentset ) {
			$pname = "parents$parentset";
			$inputname = "parents$parentset";
			doRow( $pname, "parents", $inputname );
		}

		$query = "(SELECT husband, wife, familyID, marrdate, marrplace, sealdate, sealplace FROM $families_table WHERE husband = \"{$p1row['personID']}\" AND gedcom = \"$tree\") UNION
			(SELECT husband, wife, familyID, marrdate, marrplace, sealdate, sealplace FROM $families_table WHERE wife = \"{$p1row['personID']}\" AND gedcom = \"$tree\")";
		$marriages1 = tng_query($query);

		//figure out which spouse we have
		while ( $marriage = tng_fetch_assoc( $marriages1 ) ) {
			$p1spouse = $marriage['husband'] == $p1row['personID'] ? "wife" : "husband";
			$mname = "spouse$marriage[$p1spouse]";
			$p1row[$mname] = getSpouse( $marriage, $p1spouse );
			if( !in_array( $marriage[$p1spouse], $spouses ) ) {
				array_push( $spouses, $marriage[$p1spouse] );
					$marriages[$marriage[$p1spouse]] = $marriage['familyID'];
			}
		}

		foreach( $spouses as $nextspouse ) {
			$mname = "spouse$nextspouse";
			$inputname = "spouse" . $marriages[$nextspouse];
			doRow( $mname, "spouse", $inputname );
		}
	}
	else echo "<tr><td><span class=\"normal\">{$admtext['nomatches']}</span></td></tr>";
?>
	</table><br/>
<?php
if( $personID1 || $personID2 ) {
?>	
	<input type="submit" class="btn" value="<?php echo $admtext['nextmatch']; ?>" name="mergeaction">
	<input type="submit" class="btn" value="<?php echo $admtext['nextdup']; ?>" name="mergeaction">
	<input type="submit" class="btn" value="<?php echo $admtext['comprefresh']; ?>" name="mergeaction">
	<input type="submit" class="btn" value="<?php echo $admtext['mswitch']; ?>" name="mergeaction" onClick="document.form1.mergeaction.value='<?php echo $admtext['comprefresh']; ?>'; return switchpeople();">
	<input type="submit" <?php echo $mergeclass; ?> value="<?php echo $admtext['merge']; ?>" name="mergeaction" onClick="return validateForm();">
<?php
}
?>	
	</form><br/>
	<span style="font-size: 8pt;">*<?php echo $admtext['sdxdisclaimer']; ?></span>
	</div>
</div>
<?php 
echo tng_adminfooter();
?>