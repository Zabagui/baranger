<?php
$textpart = "familygroup";
include("tng_begin.php");

include($cms['tngpath'] . "personlib.php" );

$familygroup_url = getURL( "familygroup", 1 );
$getperson_url = getURL( "getperson", 1 );
$placesearch_url = getURL( "placesearch", 1 );
$showsource_url = getURL( "showsource", 1 );
$tentedit_url = getURL( "ajx_tentedit", 1 );
$showalbum_url = getURL("showalbum",1);
$pdfform_url = getUrl( "rpt_pdfform", 1);

$placelinkbegin = $tngconfig['places1tree'] ? "<a href=\"$placesearch_url" . "psearch=" : "<a href=\"$placesearch_url" . "tree=$tree&amp;psearch=";
$placelinkend = "\" title=\"{$text['findplaces']}\"><img src=\"{$cms['tngpath']}img/tng_search_small.gif\" class=\"placeimg\" border=\"0\" alt=\"{$text['findplaces']}\" width=\"9\" height=\"9\"></a>";

$firstsection = 0;
$tableid = "";
$cellnumber = 0;
$notestogether = 0; //so they always show at the bottom
$allow_lds_this = "";

$flags['imgprev'] = true;

$citations = array();
$citedisplay = array();
$citestring = array();
$citedispctr = 0;

$ldsOK = determineLDSRights();

$totcols = $ldsOK ? 6 : 3;
$factcols = $totcols - 1;

function showFact( $text, $fact ) {
	global $factcols;
	$facttext = "<tr>\n";
	$facttext .= "<td valign=\"top\" class=\"fieldnameback\"><span class=\"fieldname\">" . $text . "&nbsp;</span></td>\n";
	$facttext .= "<td valign=\"top\" colspan=\"$factcols\" class=\"databack\"><span class=\"normal\">$fact&nbsp;</span></td>\n";
	$facttext .= "</tr>\n";
	
	return $facttext;
}

function showDatePlace( $event ) {
	global $allow_lds_this, $cellnumber, $text, $cms, $tentative_edit, $tentedit_url, $tree, $familyID;
    global $placelinkbegin, $placelinkend;
	
	$dptext = "";
	if( !$cellnumber ) {
		$cellid = " id=\"info1\"";
		$cellnumber++;
	}
	else
		$cellid = "";

	$dcitestr = $pcitestr = "";
   	if( $event['date'] || $event['place'] ) {
		$citekey = $familyID . "_" . $event['event'];
		$cite = reorderCitation( $citekey );
		if( $cite ) {
			 $dcitestr = $event['date'] ? "&nbsp; <span class=\"normal\">[$cite]</span>" : "";
			 $pcitestr = $event['place'] ? "&nbsp; <span class=\"normal\">[$cite]</span>" : "";
		}
	}

	$dptext .= "<tr>\n";
	$editicon = $tentative_edit ? "<img src=\"{$cms['tngpath']}img/tng_edit.gif\" width=\"16\" height=\"15\" border=\"0\" alt=\"{$text['editevent']}\" align=\"absmiddle\" onclick=\"tnglitbox = new LITBox('$tentedit_url" . "tree=$tree&amp;persfamID={$event['ID']}&amp;type={$event['type']}&amp;event={$event['event']}&amp;title={$event['text']}',{width:500,height:500});\" class=\"fakelink\" />" : "";
	$dptext .= "<td valign=\"top\" class=\"fieldnameback\"$cellid><span class=\"fieldname\">" . $event['text'] . "&nbsp;$editicon</span></td>\n";
	$dptext .= "<td valign=\"top\" class=\"databack\"><span class=\"normal\">" . displayDate( $event['date'] ) . "$dcitestr&nbsp;</span></td>\n";
	$dptext .= "<td valign=\"top\" class=\"databack\"";
	if( $allow_lds_this && $event['ldstext'] ) {
		//$dptext .= " " . $event['eventlds'];
		if(isset($event['eventlds']) && $event['eventlds'] == "div")
			$dptext .= " colspan=\"4\"";
	}
	$dptext .= "><span class=\"normal\">{$event['place']}$pcitestr&nbsp;";
	if( $event['place'] )
		$dptext .= $placelinkbegin . urlencode($event['place']) . $placelinkend;
	$dptext .= "</span></td>\n";
	if( $allow_lds_this && $event['ldstext']) {
		if( $event['type2'] ) {
			$event['type'] = $event['type2'];
			$event['ID'] = $event['ID2'];
		}
		$editicon = $tentative_edit && $event['eventlds'] ? "<img src=\"{$cms['tngpath']}img/tng_edit.gif\" width=\"16\" height=\"15\" border=\"0\" alt=\"{$text['editevent']}\" align=\"absmiddle\" onclick=\"tnglitbox = new LITBox('$tentedit_url" . "tree=$tree&amp;persfamID={$event['ID']}&amp;type={$event['type']}&amp;event={$event['eventlds']}&amp;title={$event['ldstext']}',{width:500,height:500});\" class=\"fakelink\" />" : "";
		$dptext .= "<td valign=\"top\" class=\"fieldnameback\"><span class=\"fieldname\">" . $event['ldstext'] . "&nbsp;$editicon</span></td>\n";
		$dptext .= "<td valign=\"top\" class=\"databack\"><span class=\"normal\">" . displayDate( $event['ldsdate'] ) . "&nbsp;</span></td>\n";
		$dptext .= "<td valign=\"top\" class=\"databack\"><span class=\"normal\">{$event['ldsplace']}&nbsp;";
		if( $event['ldsplace'] && $event['ldsplace'] != $text['place'] )
			$dptext .= $placelinkbegin . urlencode($event['ldsplace']) . $placelinkend;
		$dptext .= "</span></td>\n";
	}
	$dptext .= "</tr>\n";
	
	return $dptext;
}

function displayIndividual( $ind, $label, $familyID, $showmarriage ) {
	global $tree, $text, $photopath, $photosext, $firstsection, $children_table, $totcols, $righttree;
	global $allow_lds_this, $allow_edit, $families_table, $people_table, $cms, $getperson_url, $familygroup_url, $personID;

	$indtext = "";

	$rightbranch = $righttree ? checkbranch($ind['branch']) : false;
	$rights = determineLivingPrivateRights($ind, $righttree, $rightbranch);
	$ind['allow_living'] = $rights['living'];
	$ind['allow_private'] = $rights['private'];

	$allow_lds_this = $rights['lds'];
	$haskids = !empty($ind['haskids']) ? "X" : "&nbsp;";
	$restriction = $familyID ? "AND familyID != \"$familyID\"" : "";
	if( $ind['sex'] == "M" ) $sex = $text['male'];
	else if( $ind['sex'] == "F" ) $sex = $text['female'];
	else if( $ind['sex'] == "U" ) $sex = $text['unknown'];
	else if( !empty($ind['sex']) )
		$sex = isset($text[$ind['sex']]) ? $text[$ind['sex']] : $ind['sex'];
	else $sex = "";
	$namestr = getName( $ind );
	$personID = $ind['personID'];

	//adjust for same-sex relationships
	if( $ind['sex'] == "M" && $label == $text['wife'] )
		$label = $text['husband'];
	elseif( $ind['sex'] == "F" && $label == $text['husband'] )
		$label = $text['wife'];
	else
		$label = "";
	if($label && $sex)
		$label .= " |";

	$indtext .= "<div class=\"titlebox\">\n";
	$indtext .= "<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" style=\"width:100%\">\n";
	//show photo & name
	$indtext .= "<tr><td>";
	$indtext .= showSmallPhoto( $ind['personID'], $namestr, $rights['both'], 0, false, $ind['sex'] );
	$indtext .= "<span class=\"normal\">$label $sex</span><br/><span class=\"subhead\"><b>";
	if( !empty($ind['haskids']) )
		$indtext .= "+ ";
	$indtext .= "<a href=\"$getperson_url" . "personID={$ind['personID']}&amp;tree=$tree\">$namestr</a></b>";
	
	if( $allow_edit && $rightbranch )
		$indtext .= " | <a href=\"{$cms['tngpath']}" . "admin_editperson.php?personID={$ind['personID']}&amp;tree=$tree&amp;cw=1\" target=\"blank\">{$text['edit']}</a>";
	$indtext .= "<br/></span>\n";
	$indtext .= "</td></tr>\n</table>\n<br/>\n";

	$event = array();

	$indtext .= "<table cellspacing=\"1\" cellpadding=\"4\" class=\"whiteback tfixed\">\n";
	$indtext .= "<col class=\"labelcol\"/><col class=\"eventdatecol\"><col/>";
	$indtext .= $allow_lds_this ? "<col style=\"width:150px\"/><col class=\"eventdatecol\"/><col class=\"labelcol\"/>\n" : "\n";

	$event['text'] = $text['birth'];
	$event['event'] = "BIRT";
	$event['type'] = "I";
	$event['ID'] = $personID;
	$event['ldstext'] = $text['ldsords'];
	$event['date'] = "";
	$event['place'] = "";
	$event['type2'] = "";
	if( $rights['both'] ) {
		$event['date'] = $ind['birthdate'];
		$event['place'] = $ind['birthplace'];
		if( $allow_lds_this ) {
			$event['ldsdate'] = $text['date'];
			$event['ldsplace'] = $text['place'];
		}
	}
	$indtext .= showDatePlace( $event );

	$event = array();
	list($altbirthtype,$altbirthlabel) = getAltBirthInfo($ind);
	$event['event'] = $altbirthtype;
	$event['type'] = "I";
	$event['ID'] = $personID;
	$event['eventlds'] = "BAPL";
	$event['ldstext'] = $text['baptizedlds'];
	if( $rights['both'] ) {
		$event['date'] = $ind['altbirthdate'];
		$event['place'] = $ind['altbirthplace'];
		if( $allow_lds_this ) {
			$event['ldsdate'] = $ind['baptdate'];
			$event['ldsplace'] = $ind['baptplace'];
		}
	}
	if( (isset( $event['date']) && $event['date']) || (isset( $event['place']) && $event['place']) || isset($event['ldsdate']) || isset($event['ldsplace']) ) {
		$event['text'] = $altbirthlabel;
		if( !isset($event['date']) ) $event['date'] = "";
		if( !isset($event['place']) ) $event['place'] = "";
		if( !isset($event['type2']) ) $event['type2'] = "";
		$indtext .= showDatePlace( $event );
	}
	
	$event = array();
	$event['text'] = $text['death'];
	$event['event'] = "DEAT";
	$event['type'] = "I";
	$event['ID'] = $personID;
	$event['eventlds'] = "ENDL";
	$event['ldstext'] = $text['endowedlds'];
	$event['date'] = "";
	$event['place'] = "";
	$event['type2'] = "";
	if( $rights['both'] ) {
		$event['date'] = $ind['deathdate'];
		$event['place'] = $ind['deathplace'];
		if( $allow_lds_this ) {
			$event['ldsdate'] = $ind['endldate'];
			$event['ldsplace'] = $ind['endlplace'];
		}
	}
	$indtext .= showDatePlace( $event );
	
	$event = array();
	$event['text'] = $ind['burialtype'] ? $text['cremation'] : $text['burial'];
	$event['event'] = "BURI";
	$event['type'] = "I";
	$event['ID'] = $personID;
	$event['eventlds'] = "SLGC";
	$event['ldstext'] = $text['sealedplds'];
	$event['date'] = "";
	$event['place'] = "";
	$event['type2'] = "";
	if( $rights['both'] ) {
		$event['date'] = $ind['burialdate'];
		$event['place'] = $ind['burialplace'];
		if( $allow_lds_this ) {
			if( $familyID ) {
				$query = "SELECT sealdate, sealplace FROM $children_table WHERE familyID = \"{$ind['famc']}\" AND gedcom = \"$tree\" AND personID = \"{$ind['personID']}\"";
				$cresult = tng_query($query);
				$sealinfo = tng_fetch_assoc( $cresult );
				$ind['sealdate'] = isset($sealinfo['sealdate']) ? $sealinfo['sealdate'] : "";
				$ind['sealplace'] = isset($sealinfo['sealplace']) ? $sealinfo['sealplace'] : "";
				tng_free_result( $cresult );
			}
			$event['type2'] = "C";
			$event['ID2'] = "$personID::{$ind['famc']}";
			$event['ldsdate'] = $ind['sealdate'];
			$event['ldsplace'] = $ind['sealplace'];
		}
	}
	$indtext .= showDatePlace( $event );
	
	//show marriage & sealing if $showmarriage
	$query = "SELECT marrdate, marrplace, divdate, divplace, sealdate, sealplace, living, private, gedcom, branch, marrtype, husband, wife FROM $families_table WHERE familyID = \"$familyID\" AND gedcom = \"$tree\"";
	$result = tng_query($query);
	$fam = tng_fetch_assoc($result);
	if( $familyID || !empty($fam['marrtype']) ) {
		if( $showmarriage ) {
			$famrights = determineLivingPrivateRights($fam, $righttree);
			$fam['allow_living'] = $famrights['living'];
			$fam['allow_private'] = $famrights['private'];

			tng_free_result($result);
			
			$event = array();
			$eventd = array();
			$event['text'] = $text['marriage'];
			$event['event'] = "MARR";
			$event['type'] = "F";
			$event['ID'] = $familyID;
			$event['eventlds'] = "SLGS";
			$event['ldstext'] = $text['sealedslds'];
			$event['date'] = "";
			$event['place'] = "";
			$event['type2'] = "";
			if( $famrights['both'] && $rights['both'] ) {
				$event['date'] = $fam['marrdate'];
				$event['place'] = $fam['marrplace'];
				if( $allow_lds_this ) {
					$event['ldsdate'] = $fam['sealdate'];
					$event['ldsplace'] = $fam['sealplace'];
				}
				$eventd['event'] = "DIV";
				$eventd['text'] = $text['divorced'];
				$eventd['date'] = $fam['divdate'];
				$eventd['place'] = $fam['divplace'];
			}
			$indtext .= showDatePlace( $event );
			$eventd['ldstext'] = "";
			if( !isset($eventd['date']) ) $eventd['date'] = "";
			if( !isset($eventd['place']) ) $eventd['place'] = "";
			$eventd['type'] = "";
			$eventd['ID'] = "";
			$eventd['eventlds'] = "div";
			if( $eventd['date'] || $eventd['place'] )
				$indtext .= showDatePlace( $eventd );

			if($fam['marrtype'] && $famrights['both'] && $rights['both'])
				$indtext .= showFact( $text['type'], $fam['marrtype'] );
		}
		$spousetext = $text['otherspouse'];
	}
	else
		$spousetext = $text['spouse'];

	//show other spouses
	$query = "SELECT familyID, personID, firstname, lnprefix, lastname, title, prefix, suffix, nameorder, $families_table.living as fliving, $families_table.private as fprivate, $families_table.branch as branch, $families_table.gedcom as gedcom, birthdate, birthdatetr, altbirthdate, altbirthdatetr, $people_table.living as living, $people_table.private as private, marrdate, marrplace, sealdate, sealplace, marrtype FROM $families_table ";
	if( $ind['sex'] == "M" ) 
		$query .= "LEFT JOIN $people_table on $families_table.wife = $people_table.personID AND $families_table.gedcom = $people_table.gedcom WHERE husband = \"{$ind['personID']}\" AND $people_table.gedcom = \"$tree\" $restriction ORDER BY husborder";
	else if( $ind['sex'] = "F" )
		$query .= "LEFT JOIN $people_table on $families_table.husband = $people_table.personID AND $families_table.gedcom = $people_table.gedcom WHERE wife = \"{$ind['personID']}\" AND $people_table.gedcom = \"$tree\" $restriction ORDER BY wifeorder";
	else
		$query .= "LEFT JOIN $people_table on ($families_table.husband = $people_table.personID OR $families_table.wife = $people_table.personID) AND $families_table.gedcom = $people_table.gedcom WHERE (wife = \"{$ind['personID']}\" && husband = \"{$ind['personID']}\") AND $people_table.gedcom = \"$tree\"";
	$spresult = tng_query($query);
	
	while( $fam = tng_fetch_assoc($spresult) ) {
		$famrights = determineLivingPrivateRights($fam, $righttree);
		$fam['allow_living'] = $famrights['living'];
		$fam['allow_private'] = $famrights['private'];

		$spousename = getName( $fam );
		$spouselink = $spousename ? "<a href=\"$getperson_url" . "personID={$fam['personID']}&amp;tree=$tree\">$spousename</a> | " : "";
		$spouselink .= "<a href=\"$familygroup_url" . "familyID={$fam['familyID']}&amp;tree=$tree\">{$fam['familyID']}</a>";

		$fam['living'] = $fam['fliving'];
		$fam['private'] = $fam['fprivate'];
		$famrights = determineLivingPrivateRights($fam, $righttree);
		$fam['allow_living'] = $famrights['living'];
		$fam['allow_private'] = $famrights['private'];

		if($famrights['both'] && $rights['both'] && $fam['marrtype'])
			$spouselink .= " ({$fam['marrtype']})";
		$indtext .= showFact( $spousetext, $spouselink );
		
		$event = array();
		$event['text'] = $text['marriage'];
		$event['event'] = "MARR";
		$event['type'] = "F";
		$event['ID'] = $fam['familyID'];
		$event['eventlds'] = "SLGS";
		$event['ldstext'] = $text['sealedslds'];
		$event['date'] = "";
		$event['place'] = "";
		$event['type2'] = "";
		if( $famrights['both'] && $rights['both']) {
			$event['date'] = $fam['marrdate'];
			$event['place'] = $fam['marrplace'];
			if( $allow_lds_this ) {
				$event['ldsdate'] = $fam['sealdate'];
				$event['ldsplace'] = $fam['sealplace'];
			}
		}
		$indtext .= showDatePlace( $event );
	}

	//show parents (for hus&wif)
	if( $familyID && $ind['famc'] ) {
		$query = "SELECT familyID, personID, firstname, lnprefix, lastname, title, prefix, suffix, nameorder, $people_table.birthdate, $people_table.birthdatetr, $people_table.altbirthdate, $people_table.altbirthdatetr, $people_table.living, $people_table.private, $people_table.branch, $people_table.gedcom FROM ($families_table, $people_table) WHERE $families_table.familyID = \"{$ind['famc']}\" AND $families_table.gedcom = \"$tree\" AND $people_table.personID = $families_table.husband AND $people_table.gedcom = \"$tree\"";
		$presult = tng_query($query);
		$parent = tng_fetch_assoc($presult);

		$fathername = "";
		if($parent) {
			$prights = determineLivingPrivateRights($parent, $righttree);
			$parent['allow_living'] = $prights['living'];
			$parent['allow_private'] = $prights['private'];

			$fathername = getName( $parent );
		}
		tng_free_result($presult);
		$fatherlink = $fathername ? "<a href=\"$getperson_url" . "personID={$parent['personID']}&amp;tree=$tree\">$fathername</a> | " : "";
		$fatherlink .= $fathername ? "<a href=\"$familygroup_url" . "familyID={$parent['familyID']}&amp;tree=$tree\">{$parent['familyID']} {$text['groupsheet']}</a>" : "";
		$indtext .= showFact( $text['father'], $fatherlink );

		$query = "SELECT familyID, personID, firstname, lnprefix, lastname, title, prefix, suffix, nameorder, $people_table.birthdate, $people_table.birthdatetr, $people_table.altbirthdate, $people_table.altbirthdatetr, $people_table.living, $people_table.private, $people_table.branch, $people_table.gedcom FROM ($families_table, $people_table) WHERE $families_table.familyID = \"{$ind['famc']}\" AND $families_table.gedcom = \"$tree\" AND $people_table.personID = $families_table.wife AND $people_table.gedcom = \"$tree\"";
		$presult = tng_query($query);
		$parent = tng_fetch_assoc($presult);

		$mothername = "";
		if($parent) {
			$prights = determineLivingPrivateRights($parent, $righttree);
			$parent['allow_living'] = $prights['living'];
			$parent['allow_private'] = $prights['private'];

			$mothername = getName( $parent );
		}
		tng_free_result($presult);
		$motherlink = $mothername ? "<a href=\"$getperson_url" . "personID={$parent['personID']}&amp;tree=$tree\">$mothername</a> | " : "";
		$motherlink .= $mothername ? "<a href=\"$familygroup_url" . "familyID={$parent['familyID']}&amp;tree=$tree\">{$parent['familyID']} {$text['groupsheet']}</a>" : "";
		$indtext .= showFact( $text['mother'], $motherlink );
	} else if ( $familyID ) {
		$indtext .= showFact( $text['father'], "" );
		$indtext .= showFact( $text['mother'], "" );
	}
	$indtext .= "</table>\n</div>\n<br/>\n";

	return $indtext;
}

//get family
$query = "SELECT familyID, husband, wife, living, private, marrdate, gedcom, branch FROM $families_table WHERE familyID = \"$familyID\" AND gedcom = \"$tree\"";
$result = tng_query($query);
$famrow = tng_fetch_assoc($result);
if( !tng_num_rows($result) ) {
	tng_free_result($result);
	header( "Location: thispagedoesnotexist.html" );
	exit;
}
else
	tng_free_result($result);

$righttree = checktree($tree);
$rightbranch = checkbranch($famrow['branch']);
$rights = determineLivingPrivateRights($famrow, $righttree, $rightbranch);
$famrow['allow_living'] = $rights['living'];
$famrow['allow_private'] = $rights['private'];

$famname = getFamilyName( $famrow );

$logname = $tngconfig['nnpriv'] && $famrow['private'] ? $admtext['text_private'] : ($nonames && $famrow['living'] ? $text['living'] : $famname);
$logstring = "<a href=\"$familygroup_url" . "familyID=$familyID&amp;tree=$tree\">{$text['familygroupfor']} $logname ($familyID)</a>";
writelog($logstring);
preparebookmark($logstring);

$famname .= " ($familyID)";
$namestr = $text['family'] . ": " . $famname;
if( !$rightbranch ) {
	$tentative_edit = "";
}

$famnotes = getNotes( $familyID, "F" );


	$years = $famrow['marrdate'] && $rights['both'] ? $text['marrabbr'] . " " . displayDate( $famrow['marrdate'] ) : "";

	if($rights['both'])
		tng_header( $text['familygroupfor'] . " $famname $years ", $flags );
	else
		tng_header( $text['familygroupfor'] . " $famname", $flags );

   	if( $rights['both'] ) {
		getCitations( $familyID );
		$citekey = $familyID . "_";
		$cite = reorderCitation( $citekey );
		if( $cite )
			 $namestr .= "<sup class=\"normal\">&nbsp; [$cite]&nbsp;</sup>";
	}

	$photostr = showSmallPhoto( $familyID, $famname, $rights['both'], 0 );
	echo tng_DrawHeading( $photostr, $namestr, $years );

	$famtext = "";
	$personID = $famrow['husband'] ? $famrow['husband'] : $famrow['wife'];
	$fammedia = getMedia( $famrow, "F", true );
	$famalbums = getAlbums( $famrow, "F" );

	$famtext .= "<ul class=\"nopad\">\n";
	$famtext .= beginSection("info");
	//$famtext .= "<table border=\"0\" cellspacing=\"1\" cellpadding=\"4\" width=\"100%\">\n";

	//get husband & spouses
	if( $famrow['husband'] ) {
		$query = "SELECT * FROM $people_table WHERE personID = \"{$famrow['husband']}\" AND gedcom = \"$tree\"";
		$result = tng_query($query);
		$husbrow = tng_fetch_assoc($result);
		$label = $husbrow['sex'] != "F" ? $text['husband'] : $text['wife'];
		$famtext .= displayIndividual($husbrow, $label, $familyID, 1);
		tng_free_result($result);
	}

	//get wife & spouses
	if( $famrow['wife'] ) {
		$query = "SELECT * FROM $people_table WHERE personID = \"{$famrow['wife']}\" AND gedcom = \"$tree\"";
		$result = tng_query($query);
		$wiferow = tng_fetch_assoc($result);
		$label = $wiferow['sex'] != "M" ? $text['wife'] : $text['husband'];
		$famtext .= displayIndividual($wiferow, $label, $familyID, 0);
		tng_free_result($result);
	}

	//for each child
	$query = "SELECT $people_table.personID as personID, branch, $people_table.gedcom as gedcom, firstname, lnprefix, lastname, title, prefix, suffix, nameorder, living, private, famc, sex, birthdate, birthdatetr, birthplace, altbirthtype, altbirthdate, altbirthdatetr, altbirthplace, haskids, deathdate, deathdatetr, deathplace, burialdate, burialdatetr, burialplace, burialtype, baptdate, baptplace, endldate, endlplace, sealdate, sealplace FROM $people_table, $children_table WHERE $people_table.personID = $children_table.personID AND $children_table.familyID = \"{$famrow['familyID']}\" AND $people_table.gedcom = \"$tree\" AND $children_table.gedcom = \"$tree\" ORDER BY ordernum";
	$children= tng_query($query);
	
	
	if( $children && tng_num_rows( $children ) ) {
		//put a break here, title "Children"
		//$famtext .= showBreak('medbreak');
	
		$childcount = 0;
		while( $childrow = tng_fetch_assoc($children) ) {
			$childcount++;
			$famtext .= displayIndividual($childrow, $text['child'] . " $childcount", "", 1);
		}
	}
	tng_free_result($children);
	
	//put a break here, title "Sources"
	//$famtext .= showBreak('medbreak');
	//$famtext .= "</table>\n";
	$famtext .= endSection("info");

	$firstsection = 1;
	$firstsectionsave = "";
	
	$assoctext = "";
	if( $rights['both'] ) {
		$query = "SELECT passocID, relationship, reltype FROM $assoc_table WHERE gedcom = \"$tree\" AND personID = \"$familyID\"";
		$assocresult = tng_query($query);
		while($assoc = tng_fetch_assoc( $assocresult ) ) {
			$assoctext .= showEvent( array( "text"=>$text['association'], "fact"=>formatAssoc($assoc) ) );
		}
		tng_free_result( $assocresult );
		if($assoctext) {
			$famtext .= beginSection("assoc");
			$famtext .= "<div class=\"titlebox\">\n";
			$famtext .= "<table border=\"0\" cellspacing=\"1\" cellpadding=\"4\" style=\"width:100%\" class=\"whiteback tfixed\">\n";
			$famtext .= "$assoctext\n";
			$famtext .= "</table>\n</div>\n<br/>\n";
			$famtext .= endSection("assoc");
		}
	}
	
	$media = doMediaSection($familyID,$fammedia,$famalbums);
	if( $media ) {
		$famtext .= beginSection("media");
		$famtext .= "<div class=\"titlebox\">\n$media\n</div>\n<br/>\n";
		$famtext .= endSection("media");
	}

	if( $rights['both'] ) {
		$notes = buildNotes( $famnotes, $familyID );

		if( $notes ) {
			$famtext .= beginSection("notes");
			$famtext .= "<div class=\"titlebox\">\n";
			$famtext .= "<table border=\"0\" cellspacing=\"1\" cellpadding=\"4\" style=\"width:100%\" class=\"whiteback tfixed\">\n";
			$famtext .= "<tr>\n";
			$famtext .= "<td valign=\"top\" class=\"fieldnameback indleftcol\" id=\"notes1\" style=\"width:100px\"><span class=\"fieldname\">{$text['notes']}&nbsp;</span></td>\n";
			$famtext .= "<td valign=\"top\" class=\"databack\" colspan=\"2\">$notes</td>\n";
			$famtext .= "</tr>\n";
			$famtext .= "</table>\n</div>\n<br/>\n";
			$famtext .= endSection("notes");
		}
		if( $citedispctr ) {
			$famtext .= beginSection("citations");
			$famtext .= "<div class=\"titlebox\">\n";
			$famtext .= "<table border=\"0\" cellspacing=\"1\" cellpadding=\"4\" style=\"width:100%\" class=\"whiteback tfixed\">\n";
			$famtext .= "<tr>\n";
			$famtext .= "<td valign=\"top\" class=\"fieldnameback indleftcol\" name=\"citations1\" id=\"citations1\" style=\"width:100px\"><a name=\"sources\"><span class=\"fieldname\">{$text['sources']}&nbsp;</span></td>\n";
			$famtext .= "<td valign=\"top\" class=\"databack\" colspan=\"2\"><ol class=\"normal citeblock\">";
			$citectr = 0;
			$count = count($citestring);
			foreach( $citestring as $cite ) {
				$famtext .= "<li class=\"normal\"><a name=\"cite" . ++$citectr . "\"></a>$cite<br />";
				if( $citectr < $count )
					$famtext .= "<br />";
				$famtext .= "</li>\n";
			}
			$famtext .= "</ol></td>\n";
			$famtext .= "</tr>\n";
			$famtext .= "</table>\n</div>\n<br/>\n";
			$famtext .= endSection("citations");
		}
	}
	elseif( $rights['both'] ) {
		$famtext .= beginSection("notes");
		$famtext .= "<div class=\"titlebox\">\n";
		$famtext .= "<table border=\"0\" cellspacing=\"1\" cellpadding=\"4\" style=\"width:100%\" class=\"whiteback\">\n";
		$famtext .= "<tr>\n";
		$famtext .= "<td valign=\"top\" class=\"fieldnameback indleftcol\" id=\"notes1\" style=\"width:100px\"><span class=\"fieldname\">{$text['notes']}&nbsp;</span></td>\n";
		$famtext .= "<td valign=\"top\" class=\"databack\" colspan=\"2\"><span class=\"normal\">{$text['livingnote']}</span></td>\n";
		$famtext .= "</tr>\n";
		$famtext .= "</table>\n</div>\n<br/>\n";
		$famtext .= endSection("notes");
		$notes = true;
	}
	else
		$notes = false;
	$famtext .= "</ul>\n";

	$tng_alink = $tng_plink = $tng_mlink = "lightlink";
	if( $media || $notes || $assoctext ) {
		if( $tngconfig['istart'] )
			$tng_plink = "lightlink3";
		else
			$tng_alink = "lightlink3";
		$innermenu = "<a href=\"#\" class=\"$tng_plink\" onclick=\"return infoToggle('info');\" id=\"tng_plink\">{$text['faminfo']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
		if( $media )
			$innermenu .= "<a href=\"#\" class=\"lightlink\" onclick=\"return infoToggle('media');\" id=\"tng_mlink\">{$text['media']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
		if( $assoctext )
			$innermenu .= "<a href=\"#\" class=\"lightlink\" onclick=\"return infoToggle('assoc');\" id=\"tng_xlink\">{$text['association']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
		if( $notes )
			$innermenu .= "<a href=\"#\" class=\"lightlink\" onclick=\"return infoToggle('notes');\" id=\"tng_nlink\">{$text['notes']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
		if( $citedispctr )
			$innermenu .= "<a href=\"#\" class=\"lightlink\" onclick=\"return infoToggle('citations');\" id=\"tng_clink\">{$text['sources']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
		$innermenu .= "<a href=\"#\" class=\"$tng_alink\" onclick=\"return infoToggle('all');\" id=\"tng_alink\">{$text['all']}</a>\n";
	}
	else
		$innermenu = "<span class=\"lightlink3\" id=\"tng_plink\">{$text['faminfo']}</span>\n";

	$treeResult = getTreeSimple($tree);
	$treerow = tng_fetch_assoc($treeResult);
	$allowpdf = !$treerow['disallowpdf'] || ($allow_pdf && $rightbranch);
	tng_free_result($treeResult);

    if($allowpdf)
        $innermenu .= " &nbsp;&nbsp; | &nbsp;&nbsp; <a href=\"#\" class=\"lightlink\" onclick=\"tnglitbox = new LITBox('$pdfform_url" . "pdftype=fam&amp;familyID=$familyID&amp;tree=$tree',{width:350,height:350});return false;\">PDF</a>\n";

	echo tng_menu( "F", "family", $familyID, $innermenu );
?>
<script type="text/javascript">
function innerToggle(part,subpart,subpartlink) {
	if( part == subpart )
		turnOn(subpart,subpartlink);
	else
		turnOff(subpart,subpartlink);
}

function turnOn(subpart,subpartlink) {
	jQuery('#'+subpartlink).attr('class','lightlink3');
	jQuery('#'+subpart).show();
}

function turnOff(subpart,subpartlink) {
	jQuery('#'+subpartlink).attr('class','lightlink');
	jQuery('#'+subpart).hide();
}

function infoToggle(part) {
	if( part == "all" ) {
		jQuery('#info').show();
<?php
	if( $media ) {
		echo "\$('#media').show();\n";
		echo "\$('#tng_mlink').attr('class','lightlink');\n";
	}
	if( $assoctext ) {
		echo "\$('#assoc').show();\n";
		echo "\$('#tng_xlink').attr('class','lightlink');\n";
	}
	if( $notes ) {
		echo "\$('#notes').show();\n";
		echo "\$('#tng_nlink').attr('class','lightlink');\n";
	}
	if( $citedispctr ) {
		echo "\$('#citations').show();\n";
		echo "\$('#tng_clink').attr('class','lightlink');\n";
	}
?>
		jQuery('#tng_alink').attr('class','lightlink3');
		jQuery('#tng_plink').attr('class','lightlink');
	}
	else {	
		innerToggle(part,"info","tng_plink");
<?php
	if( $media )
		echo "innerToggle(part,\"media\",\"tng_mlink\");\n";
	if( $assoctext )
		echo "innerToggle(part,\"assoc\",\"tng_xlink\");\n";
	if( $notes )
		echo "innerToggle(part,\"notes\",\"tng_nlink\");\n";
	if( $citedispctr )
		echo "innerToggle(part,\"citations\",\"tng_clink\");\n";
?>
		jQuery('#tng_alink').attr('class','lightlink');
	}
	return false;
}
</script>

<?php
	echo $famtext;
?>
<br/>

<?php
if($tentative_edit) {
	$flags['more'] .= "<script type=\"text/javascript\">\n";
	$flags['more'] .= "var preferEuro = " . ($tngconfig['preferEuro'] ? $tngconfig['preferEuro'] : "false") . ";\n";
	$flags['more'] .= "var preferDateFormat = '$preferDateFormat';\n";
	$flags['more'] .= "</script>\n";
	$flags['more'] .= "<script type=\"text/javascript\" src=\"{$cms['tngpath']}js/tentedit.js\"></script>\n";
	$flags['more'] .= "<script type=\"text/javascript\" src=\"{$cms['tngpath']}js/datevalidation.js\"></script>\n";
}
tng_footer( $flags );
?>