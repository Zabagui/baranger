<?php
$textpart = "getperson";
$needMap = true;
include("tng_begin.php");

if(empty($personID)) pageNotFound();
if(!empty($tngprint)) {
	$tngconfig['istart'] = "";
	$tngconfig['hidemedia'] = "";
}
$defermap = $map['pstartoff'] || $tngconfig['istart'] ? 1 : 0;
include($cms['tngpath'] . "personlib.php" );

$getperson_url = getURL( "getperson", 1 );
$familygroup_url = getURL( "familygroup", 1 );
$familychart_url = getURL( "familychart", 1 );
$showsource_url = getURL( "showsource", 1 );
$showtree_url = getURL( "showtree", 1 );
$placesearch_url = getURL( "placesearch", 1 );
$tentedit_url = getURL( "ajx_tentedit", 1 );
$showalbum_url = getURL("showalbum",1);
$pdfform_url = getURL( "rpt_pdfform", 1 );
$descend_url = getURL( "descend", 1 );
$dna_test_url = getURL( "show_dna_test", 1 );

$citations = array();
$citedisplay = array();
$citestring = array();
$citationctr = 0;
$citedispctr = 0;
$firstsection = 1;
$firstsectionsave = "";
$tableid = "";
$cellnumber = 0;

$stdex = getStdExtras( $personID );

$indexlist = array( 'BIRT','CHR','BAPL','CONL','INIT','ENDL','DEAT','BURI' );
if(!empty($tngconfig['altbirth']))
	$indexlist = array_unique(array_merge($indexlist, explode(",",$tngconfig['altbirth'])));

foreach( $indexlist as $myindex )
	if( !isset( $stdex[$myindex] ) ) $stdex[$myindex] = '';

$result = getPersonFullPlusDates($tree, $personID);
if( !tng_num_rows($result) ) {
	tng_free_result($result);
	pageNotFound();
}

$flags['imgprev'] = true;

$row = tng_fetch_assoc($result);
$righttree = checktree($tree);
$rightbranch = $righttree ? checkbranch($row['branch']) : false;
$rights = determineLivingPrivateRights($row, $righttree, $rightbranch);
$row['allow_living'] = $rights['living'];
$row['allow_private'] = $rights['private'];
if( !$rightbranch ) {
	$tentative_edit = "";
}
$org_rightbranch = $rightbranch;
$namestr = getName( $row );
$nameformap = $namestr;

$indnotes = getNotes( $personID, "I" );

$treeResult = getTreeSimple($tree);
$treerow = tng_fetch_assoc($treeResult);
$disallowgedcreate = $treerow['disallowgedcreate'];
$allowpdf = !$treerow['disallowpdf'] || ($allow_pdf && $rightbranch);
tng_free_result($treeResult);

$ldjson = array();
$ldjsonparents = array();
$ldjson += ['@type' => "Person"];
$ldjson += ['@id' => $getperson_url . "personID=$personID&amp;tree=$tree"];
$ldjson += ['name' => getFirstNameOnly($row)];
$ldjson += ['familyName' => getSurnameOnly($row)];
$ldjson += ['birthPlace' => $row['birthplace']];
$ldjson += ['birthDate' => $row['birthdatetr']];
$ldjson += ['deathPlace' => $row['deathplace']];
$ldjson += ['deathDate' => $row['deathdatetr']];

$logname = !empty($tngconfig['nnpriv']) && $row['private'] ? $admtext['text_private'] : ($nonames && $row['living'] ? $text['living'] : $namestr);
$treestr = "<a href=\"$showtree_url" . "tree=$tree\">{$treerow['treename']}</a>";
if( $row['branch'] ) {
	//explode on commas
	$branches = explode(",",$row['branch']);
	$count = 0;
	$branchstr = "";
	foreach($branches as $branch) {
		$count++;
		$brresult = getBranchesSimple($tree, $branch);
		$brrow = tng_fetch_assoc($brresult);
		$branchstr .= !empty($brrow['description']) ? $brrow['description'] : $branch;
		if($count < count($branches))
			$branchstr .= ", ";
		tng_free_result($brresult);
	}
	if( $branchstr )
		$treestr = $treestr . " | $branchstr";
}
tng_free_result($result);

writelog( "<a href=\"$getperson_url" . "personID=$personID&amp;tree=$tree\">{$text['indinfofor']} $logname ($personID)</a>" );
preparebookmark( "<a href=\"$getperson_url" . "personID=$personID&amp;tree=$tree\">{$text['indinfofor']} $namestr ($personID)</a>" );

$flags['scripting'] = "<script type=\"text/javascript\">var tnglitbox;</script>\n";
$flags['scripting'] .= "<script type=\"application/ld+json\">\n" . json_encode($ldjson, JSON_UNESCAPED_SLASHES) . "\n</script>\n";
if(empty($tngconfig['hidedna'])) {
	$flags['scripting'] .= "
<script type = 'text/javascript'>
function togglednaicon() {
   if ($('.toggleicon2').attr('src').indexOf('desc') > 0) {
      $('.toggleicon2').attr('src',cmstngpath + 'img/tng_sort_asc.gif')
      $('.toggleicon2').attr('title', '{$text['collapse']}');
      $('.dnatest').show();
   }
   else {
      $('.toggleicon2').attr('src',cmstngpath + 'img/tng_sort_desc.gif')
      $('.toggleicon2').attr('title', '{$text['expand']}');
      $('.dnatest').hide();
   }
}

function show_dnatest() {
      $('.toggleicon2').attr('src',cmstngpath + 'img/tng_sort_asc.gif')
      $('.toggleicon2').attr('title', '{$text['collapse']}');
      $('.dnatest').show();
}

function hide_dnatest() {
      $('.toggleicon2').attr('src',cmstngpath + 'img/tng_sort_desc.gif')
      $('.toggleicon2').attr('title', '{$text['expand']}');
      $('.dnatest').hide();
}
</script>";
	$showdnatest = "show_dnatest(); ";
	$hidednatest = "hide_dnatest(); ";
}
else {
	$showdnatest = $hidednatest = "";
}
if( $map['key'] && $isConnected)
    $flags['scripting'] .= "<script type=\"text/javascript\" src=\"{$http}://maps.googleapis.com/maps/api/js?language={$text['glang']}$mapkeystr\"></script>\n";
$headstr = $namestr;
if($rights['both']) {
	if($row['birthdate'])
		$headstr .= " {$text['birthabbr']} " . displayDate($row['birthdate']);
	if($row['birthplace'])
		$headstr .= " " . $row['birthplace'];
	if($row['deathdate'])
		$headstr .= " {$text['deathabbr']} " . displayDate($row['deathdate']);
	if($row['deathplace'])
		$headstr .= " " . $row['deathplace'];
}
tng_header( $headstr, $flags );

if($rights['both']) {
	getCitations( $personID );
}

$indmedia = getMedia($row,"I");
$indalbums = getAlbums($row,"I");

	$photostr = showSmallPhoto( $personID, $namestr, $rights['both'], 0, false, $row['sex'] );
	if( $rights['both'] ) {
		$dnanamestr = $namestr;
		$citekey = $personID . "_";
		$cite = reorderCitation( $citekey );
		//$citekey = $personID . "_NAME";
		//$cite2 .= reorderCitation( $citekey );
		//if( $cite2 )
			//$cite .= $cite ? ", $cite2" : $cite2;
		if( $cite )
			 $namestr .= "<sup><span class=\"normal\">[$cite]</span></sup>";
	}
	echo "<div class=\"vcard\">\n";
	echo tng_DrawHeading( $photostr, $namestr, getYears( $row ) );

	$persontext = "";
	$persontext .= "<ul class=\"nopad\">\n";

	if(!empty($tng_extras)) {
		$media = doMediaSection($personID,$indmedia,$indalbums);
		if( $media ) {
			$persontext .= beginSection("media");
			$persontext .= $media . "<br/>\n";
			$persontext .= endSection("media");
		}
	}

	$persontext .= beginSection("info");
	$persontext .= "<table cellspacing=\"1\" cellpadding=\"4\" class=\"whiteback tfixed normal\">\n";
	$persontext .= "<col class=\"labelcol\"/><col style=\"width:{$datewidth}px\"/><col />\n";
	resetEvents();
	if($rights['both']) {
		$persontext .= showEvent( array( "text"=>$text['name'], "fact"=>getName($row,true), "event"=>"NAME", "entity"=>$personID, "type"=>"I" ) );
		if( $row['title'] )
			$persontext .= showEvent( array( "text"=>$text['title'], "fact"=>$row['title'], "event"=>"TITL", "entity"=>$personID, "type"=>"I" ) );
		if( $row['prefix'] )
			$persontext .= showEvent( array( "text"=>$text['prefix'], "fact"=>$row['prefix'], "event"=>"NPFX", "entity"=>$personID, "type"=>"I" ) );
		if( $row['suffix'] )
			$persontext .= showEvent( array( "text"=>$text['suffix'], "fact"=>$row['suffix'], "event"=>"NSFX", "entity"=>$personID, "type"=>"I" ) );
		if( $row['nickname'] )
			$persontext .= showEvent( array( "text"=>$text['nickname'], "fact"=>$row['nickname'], "event"=>"NICK", "entity"=>$personID, "type"=>"I" ) );
		if( $row['private'] && $allow_edit && $allow_add && $allow_delete && !$assignedtree )
			$persontext .= showEvent( array( "text"=>$admtext['text_private'], "fact"=>$admtext['yes'] ) );
		setEvent( array( "text"=>$text['birth'], "fact"=>$stdex['BIRT'], "date"=>$row['birthdate'], "place"=>$row['birthplace'], "event"=>"BIRT", "entity"=>$personID, "type"=>"I" ), $row['birthdatetr'] );

		list($altbirthtype, $altbirthlabel) = getAltBirthInfo($row);
		setEvent( array( "text"=>$altbirthlabel, "fact"=>$stdex[$altbirthtype], "date"=>$row['altbirthdate'], "place"=>$row['altbirthplace'], "event"=>$altbirthtype, "entity"=>$personID, "type"=>"I" ), $row['altbirthdatetr'] );

		if( $row['sex'] == "M" ) { 
			$sex = $text['male']; $spouse = "wife"; $self = "husband"; $spouseorder = "husborder";
		}
		elseif($row['sex'] == "F" ) { 
			$sex = $text['female']; $spouse = "husband"; $self = "wife"; $spouseorder = "wifeorder";
		}
		else {
			$spouseorder = "";
			if($row['sex'] == "U")
				$sex = $text['unknown'];
			elseif(!empty($row['sex']))
				$sex = !empty($text[$row['sex']]) ? $text[$row['sex']] : $row['sex'];
			else
				$sex = "";
		}
		if(!empty($sex))
			setEvent( array( "text"=>$text['gender'], "fact"=>$sex ), $nodate );
		doCustomEvents($personID,"I");

		if( $rights['lds'] ) {
			setEvent( array( "text"=>$text['baptizedlds'], "fact"=>$stdex['BAPL'], "date"=>$row['baptdate'], "place"=>$row['baptplace'], "event"=>"BAPL", "entity"=>$personID, "type"=>"I" ), $row['baptdatetr'] );
			setEvent( array( "text"=>$text['conflds'], "fact"=>$stdex['CONL'], "date"=>$row['confdate'], "place"=>$row['confplace'], "event"=>"CONL", "entity"=>$personID, "type"=>"I" ), $row['confdatetr'] );
			setEvent( array( "text"=>$text['initlds'], "fact"=>$stdex['INIT'], "date"=>$row['initdate'], "place"=>$row['initplace'], "event"=>"INIT", "entity"=>$personID, "type"=>"I" ), $row['initdatetr'] );
			setEvent( array( "text"=>$text['endowedlds'], "fact"=>$stdex['ENDL'], "date"=>$row['endldate'], "place"=>$row['endlplace'], "event"=>"ENDL", "entity"=>$personID, "type"=>"I" ), $row['endldatetr'] );
		}

		setEvent( array( "text"=>$text['death'], "fact"=>$stdex['DEAT'], "date"=>$row['deathdate'], "place"=>$row['deathplace'], "event"=>"DEAT", "entity"=>$personID, "type"=>"I" ), $row['deathdatetr'] );
		$burialmsg = $row['burialtype'] ? $text['cremation'] : $text['burial'];
		setEvent( array( "text"=>$burialmsg, "fact"=>$stdex['BURI'], "date"=>$row['burialdate'], "place"=>$row['burialplace'], "event"=>"BURI", "entity"=>$personID, "type"=>"I" ), $row['burialdatetr'] );
	}

	if(empty($tngconfig['sortbydate']))
		ksort( $events );
	foreach( $events as $event )
		$persontext .= showEvent( $event );

	if( $rights['both'] ) {
		$assocresult = getAssociations($tree, $personID);
		while($assoc = tng_fetch_assoc( $assocresult ) ) {
			$persontext .= showEvent( array( "text"=>$text['association'], "fact"=>formatAssoc($assoc) ) );
		}
		tng_free_result( $assocresult );
	}

	$notes = "";
	if($notestogether == 1) {
		if($rights['both'])
			$notes = buildGenNotes( $indnotes, $personID, "--x-general-x--" );
		elseif( $row['living'] )
	        $notes = $text['livingnote'];

	    if($notes) {
			$persontext .= "<tr>\n";
			$persontext .= "<td valign=\"top\" class=\"fieldnameback\" id=\"notes1\"><span class=\"fieldname\">{$text['notes']}&nbsp;</span></td>\n";
			$persontext .= "<td valign=\"top\" class=\"databack\" colspan=\"2\"><div class=\"notearea\">$notes</div></td>\n";
			$persontext .= "</tr>\n";
			$notes = ""; //wipe it out so we don't get a link at the top
		}
	}

	$persontext .= showEvent( array( "text"=>$text['personid'], "date"=>$personID, "place"=>$treestr, "np"=>1  ) );
	if( $row['changedate'] || ( $allow_edit && $rightbranch ) ) {
		$row['changedate'] = displayDate( $row['changedate'], false );
		if( $allow_edit && $rightbranch ) {
			if( $row['changedate'] ) $row['changedate'] .= " | ";
			$row['changedate'] .= "<a href=\"{$cms['tngpath']}admin_editperson.php?personID=$personID&amp;tree=$tree&amp;cw=1\" target=\"blank\">{$text['edit']}</a>";
		}
		$persontext .= showEvent( array( "text"=>$text['lastmodified'], "fact"=>$row['changedate'] ) );
	}

    $persontext .= "</table>\n";
	$persontext .= "<br/>\n";

	if(!$tngconfig['hidedna'] && $rights['both']) {
		include("dna_test_results_lib.php");
	}

	//do parents
	$parents = getChildParentsFamily($tree, $personID);
	
	if ( $parents && tng_num_rows( $parents ) ) {
		while ( $parent = tng_fetch_assoc( $parents ) )
		{
			$persontext .= "<table cellspacing=\"1\" cellpadding=\"4\" class=\"whiteback tfixed normal\">\n";
			$persontext .= "<col class=\"labelcol\"/><col style=\"width:{$datewidth}px\"/><col />\n";
			$tableid = "fam" . $parent['familyID'] . "_";
			$cellnumber = 0;
			resetEvents();
			getCitations( $personID . "::" . $parent['familyID'] );
			$gotfather = getParentData($tree, $parent['familyID'], "husband");
	
		    if( tng_num_rows($gotfather) ) {	
				$fathrow =  tng_fetch_assoc( $gotfather );
				$birthinfo = getBirthInfo( $fathrow );
				$frights = determineLivingPrivateRights($fathrow, $righttree);
				$fathrow['allow_living'] = $frights['living'];
				$fathrow['allow_private'] = $frights['private'];
				if( $fathrow['firstname'] || $fathrow['lastname'] ) {
					$fathname = getName( $fathrow );
					$fatherlink = "<a href=\"$getperson_url" . "personID={$fathrow['personID']}&amp;tree=$tree\">$fathname</a>";
				}
				else
					$fatherlink = "";
				if( $frights['both'] ) {
					$fatherlink .= $birthinfo;
					if($fatherlink) {
						$age = age($fathrow);
						$agelabel = isset($text[$fathrow['sex'].'age']) ? $text[$fathrow['sex'].'age'] : $text['age'];
						if($age) $fatherlink .= " ($agelabel $age)";
					}
				}
				$label = $fathrow['sex'] == "F" ? $text['mother'] : $text['father'];
				$persontext .= showEvent( array( "text"=>$label, "fact"=>$fatherlink ) );
				if( $rights['both'] && $parent['frel'] ) {
					$rel = $parent['frel'];
					$relstr = isset($admtext[$rel]) ? $admtext[$rel] : $rel;
					$persontext .= showEvent( array( "text"=>$text['relationship2'], "fact"=>$relstr ) );
				}
				tng_free_result( $gotfather );
			}

			$gotmother = getParentData($tree, $parent['familyID'], "wife");

			if( tng_num_rows($gotmother) ) {
				$mothrow =  tng_fetch_assoc( $gotmother );
				$birthinfo = getBirthInfo( $mothrow );
				$mrights = determineLivingPrivateRights($mothrow, $righttree);
				$mothrow['allow_living'] = $mrights['living'];
				$mothrow['allow_private'] = $mrights['private'];
				if( $mothrow['firstname'] || $mothrow['lastname'] ) {
					$mothname = getName( $mothrow );
					$motherlink = "<a href=\"$getperson_url" . "personID={$mothrow['personID']}&amp;tree=$tree\">$mothname</a>";
				}
				else
					$motherlink = "";
				if( $mrights['both'] ) {
					$motherlink .= $birthinfo;
					if($motherlink) {
						$age = age($mothrow);
						$agelabel = isset($text[$mothrow['sex'].'age']) ? $text[$mothrow['sex'].'age'] : $text['age'];
						if($age) $motherlink .= " ($agelabel $age)" ;
					}
				}
				$label = $mothrow['sex'] == "M" ? $text['father'] : $text['mother'];
				$persontext .= showEvent( array( "text"=>$label, "fact"=>$motherlink ) );
				if( $rights['both'] && $parent['mrel'] ) {
					$rel = $parent['mrel'];
					$relstr = isset($admtext[$rel]) ? $admtext[$rel] : $rel;
					$persontext .= showEvent( array( "text"=>$text['relationship2'], "fact"=>$relstr ) );
				}
				tng_free_result( $gotmother );
			}

			if( $rights['both'] && $rights['lds'] && (empty($tngconfig['pardata']) || $tngconfig['pardata'] < 2 ))
				setEvent( array( "text"=>$text['sealedplds'], "date"=>$parent['sealdate'], "place"=>$parent['sealplace'], "event"=>"SLGC", "entity"=>"$personID::{$parent['familyID']}", "type"=>"C", "nomap"=>1), $parent['sealdatetr'] );

			$gotparents = getFamilyData($tree, $parent['familyID']);
			$parentrow =  tng_fetch_assoc( $gotparents );
   			tng_free_result($gotparents);
			$parent['personID'] = "";

			if(empty($tngconfig['pardata']) || $tngconfig['pardata'] < 2) {
				$prights = determineLivingPrivateRights($parentrow, $righttree);
				$parentrow['allow_living'] = $prights['living'];
				$parentrow['allow_private'] = $prights['private'];

				if($prights['both'] && (empty($fathrow) || $frights['both']) && (empty($mothrow) || $mrights['both'])) {
					$stdexf = getStdExtras( $parent['familyID'] );
					if(!isset($stdexf['MARR'])) $stdexf['MARR'] = '';
					if(!isset($stdexf['DIV'])) $stdexf['DIV'] = '';
					if(empty($tngconfig['pardata'])) {
						$famnotes = getNotes( $parent['familyID'], "F" );
						getCitations( $parent['familyID'] );
						if( !empty($parent['marrtype']) ) {
							if( !is_array( $stdexf['MARR'] ) ) $stdexf['MARR'] = array();
							array_unshift( $stdexf['MARR'], $text['type'] . ": " . $parent['marrtype'] );
						}
					}

					setEvent( array( "text"=>$text['marriage'], "fact"=>$stdexf['MARR'], "date"=>$parentrow['marrdate'], "place"=>$parentrow['marrplace'], "event"=>"MARR", "entity"=>$parentrow['familyID'], "type"=>"F", "nomap"=>1 ), $parentrow['marrdatetr'] );
					setEvent( array( "text"=>$text['divorce'], "fact"=>$stdexf['DIV'], "date"=>$parentrow['divdate'], "place"=>$parentrow['divplace'], "event"=>"DIV", "entity"=>$parentrow['familyID'], "type"=>"F", "nomap"=>1 ), $parentrow['divdatetr'] );

					if(empty($tngconfig['pardata'])) {
						doCustomEvents($parent['familyID'],"F",1);
						$fammedia = getMedia($parentrow,"F");
						$famalbums =getAlbums($parentrow,"F");
					}

					if(empty($tngconfig['sortbydate']))
						ksort( $events );
					foreach( $events as $event )
						$persontext .= showEvent( $event );

					$assocresult = getAssociations($tree, $parent['familyID']);
					while($assoc = tng_fetch_assoc( $assocresult ) ) {
						$persontext .= showEvent( array( "text"=>$text['association'], "fact"=>formatAssoc($assoc) ) );
					}
					tng_free_result( $assocresult );

					if(empty($tngconfig['pardata'])) {
						$famnotes2 = "";
						if( !$notestogether )
							$famnotes2 = buildNotes( $famnotes, $parent['familyID'] );
						else
							$famnotes2 = buildGenNotes( $famnotes, $parent['familyID'], "--x-general-x--" );

						if( $famnotes2 ) {
							$persontext .= "<tr>\n";
							$persontext .= "<td valign=\"top\" class=\"fieldnameback\"><span class=\"fieldname\">{$text['notes']}&nbsp;</span></td>\n";
							$persontext .= "<td valign=\"top\" class=\"databack\" colspan=\"2\"><div class=\"normal notearea\">$famnotes2</div></td>\n";
							$persontext .= "</tr>\n";
						}
						
						foreach( $mediatypes as $mediatype ) {
							$mediatypeID = $mediatype['ID'];
							$persontext .= writeMedia( $fammedia, $mediatypeID, "p" . $parent['familyID'] );
						}
						$persontext .= writeAlbums($famalbums);
					}
				}
			}

			$persontext .= showEvent( array( "text"=>$text['familyid'], "date"=>$parent['familyID'], "place"=>"<a href=\"$familygroup_url" . "familyID={$parent['familyID']}&amp;tree=$tree\">{$text['groupsheet']}</a>&nbsp; | &nbsp;<a href='{$familychart_url}familyID={$parent['familyID']}&amp;tree=$tree'>{$text['familychart']}</a>", "np"=>1 ) );
			$persontext .= "</table>\n";
			$persontext .= "<br/>\n";
		}
		tng_free_result($parents);
	}

	//do marriages
	//if( $spouseorder )
        //$marriages = getSpouseFamilyFull($tree, $self, $personID, $spouseorder);
	//else
        $marriages = getSpouseFamilyFullUnion($tree, $personID);
	$marrtot = tng_num_rows($marriages);
	$marrcount = 1;

	while ( $marriagerow =  tng_fetch_assoc( $marriages ) )
	{
		$persontext .= "<table cellspacing=\"1\" cellpadding=\"4\" class=\"whiteback tfixed normal\">\n";
		$persontext .= "<col class=\"labelcol\"/><col style=\"width:{$datewidth}px\"/><col />\n";
		$tableid = "fam" . $marriagerow['familyID'] . "_";
		$cellnumber = 0;
		$famnotes = getNotes( $marriagerow['familyID'], "F" );
		getCitations( $marriagerow['familyID'] );
		$stdexf = getStdExtras( $marriagerow['familyID'] );

		if(!isset($stdexf['MARR'])) $stdexf['MARR'] = '';
		if(!isset($stdexf['DIV']))  $stdexf['DIV'] = '';
		if(!isset($stdexf['SLGS'])) $stdexf['SLGS'] = '';

		if( $marriagerow['marrtype'] ) {
			if( !is_array( $stdexf['MARR'] ) ) $stdexf['MARR'] = array();
			array_unshift( $stdexf['MARR'], $text['type'] . ": " . $marriagerow['marrtype'] );
		}

		$spouse = $marriagerow['husband'] == $personID ? 'wife' : 'husband';
		unset($spouserow);
		unset($birthinfo);
		if( $marriagerow[$spouse] ) {
			$spouseresult = getPersonData($tree, $marriagerow[$spouse]);
			$spouserow =  tng_fetch_assoc( $spouseresult );
			$birthinfo = getBirthInfo( $spouserow );
			$srights = determineLivingPrivateRights($spouserow, $righttree);
			$spouserow['allow_living'] = $srights['living'];
			$spouserow['allow_private'] = $srights['private'];
			if( $spouserow['firstname'] || $spouserow['lastname'] ) {
				$spousename = getName( $spouserow );
				$spouselink = "<a href=\"$getperson_url" . "personID={$spouserow['personID']}&amp;tree=$tree\">$spousename</a>";
			}
			if( $srights['both'] ) {
				$spouselink .= $birthinfo;
				if($spouselink) {
					$age = age($spouserow);
					$agelabel = isset($text[$spouserow['sex'].'age']) ? $text[$spouserow['sex'].'age'] : $text['age'];
					if($age) $spouselink .= " ($agelabel $age)";
				}
			}
            tng_free_result($spouseresult);
		}
		else {
			$spouselink = "";
			$srights['both'] = true;
		}
		$marrstr = $marrtot > 1 ? " $marrcount" : "";
		if( $srights['both'] )
			$persontext .= showEvent( array( "text"=>"{$text['family']}$marrstr", "fact"=>$spouselink, "entity"=>$marriagerow['familyID'], "type"=>"F" ) );
		else
			$persontext .= showEvent( array( "text"=>"{$text['family']}$marrstr", "fact"=>$spouselink ) );

		$rightfbranch = $righttree ? checkbranch($marriagerow['branch']) : false;
		$marrights = determineLivingPrivateRights($marriagerow, $righttree);
		$marriagerow['allow_living'] = $marrights['living'];
		$marriagerow['allow_private'] = $marrights['private'];
		$fammedia = getMedia($marriagerow,"F");
		$famalbums = getAlbums($marriagerow,"F");
		if( $marrights['both'] && $srights['both'] ) {
			resetEvents();

			setEvent( array( "text"=>$text['marriage'], "fact"=>$stdexf['MARR'], "date"=>$marriagerow['marrdate'], "place"=>$marriagerow['marrplace'], "event"=>"MARR", "entity"=>$marriagerow['familyID'], "type"=>"F" ), $marriagerow['marrdatetr'] );
			setEvent( array( "text"=>$text['divorce'], "fact"=>$stdexf['DIV'], "date"=>$marriagerow['divdate'], "place"=>$marriagerow['divplace'], "event"=>"DIV", "entity"=>$marriagerow['familyID'], "type"=>"F" ), $marriagerow['divdatetr'] );

			if( $marrights['lds'] ) {
				setEvent( array( "text"=>$text['sealedslds'], "fact"=>$stdexf['SLGS'], "date"=>$marriagerow['sealdate'], "place"=>$marriagerow['sealplace'], "event"=>"SLGS", "entity"=>$marriagerow['familyID'], "type"=>"F" ), $marriagerow['sealdatetr'] );
			}

			doCustomEvents($marriagerow['familyID'],"F");
			if(empty($tngconfig['sortbydate']))
				ksort( $events );
			foreach( $events as $event )
				$persontext .= showEvent( $event );

			$assocresult = getAssociations($tree, $marriagerow['familyID']);
			while($assoc = tng_fetch_assoc( $assocresult ) ) {
				$persontext .= showEvent( array( "text"=>$text['association'], "fact"=>formatAssoc($assoc) ) );
			}
			tng_free_result( $assocresult );

			$famnotes2 = "";
			if( !$notestogether )
				$famnotes2 = buildNotes( $famnotes, $marriagerow['familyID'] );
			else
				$famnotes2 = buildGenNotes( $famnotes, $marriagerow['familyID'], "--x-general-x--" );

			if( $famnotes2 ) {
				$persontext .= "<tr>\n";
				$persontext .= "<td valign=\"top\" class=\"fieldnameback\"><span class=\"fieldname\">{$text['notes']}&nbsp;</span></td>\n";
				$persontext .= "<td valign=\"top\" class=\"databack\" colspan=\"2\"><div class=\"normal notearea\">$famnotes2</div></td>\n";
				$persontext .= "</tr>\n";
			}
		}
		$marrcount++;

		//do children
		$children = getChildrenData($tree, $marriagerow['familyID']);

		if( $children && tng_num_rows( $children ) ) {
			$persontext .= "<tr>\n";
			$persontext .= "<td valign=\"top\" class=\"fieldnameback\"><span class=\"fieldname\">{$text['children']}&nbsp;</span></td>\n";
			$persontext .= "<td colspan=\"2\" class=\"databack\">\n";

			$kidcount = 1;
			$persontext .= "<table cellpadding = \"0\" cellspacing = \"0\" style=\"width: 100%\">\n";
			while ( $child =  tng_fetch_assoc( $children ) )
			{
				$childID = $child['personID'];
				$child['gedcom'] = $tree;
				$ifkids = $child['haskids'] ? "<a href=\"$descend_url" . "personID=$childID&amp;tree=$tree\" title=\"{$text['descendants']}\" class=\"descindicator\"><strong>+</strong></a>" : "&nbsp;";
				$birthinfo = getBirthInfo( $child );
				$crights = determineLivingPrivateRights($child, $righttree);
				$child['allow_living'] = $crights['living'];
				$child['allow_private'] = $crights['private'];
				if( $child['firstname'] || $child['lastname'] ) {
					$childname = getName( $child );
					$persontext .= "<tr><td valign=\"top\" width=\"10\">$ifkids</td><td onmouseover=\"highlightChild(1,'$childID');\" onmouseout=\"highlightChild(0,'$childID');\" class=\"unhighlightedchild\" id=\"child$childID\"><span class=\"normal\">$kidcount. <a href=\"$getperson_url" . "personID=$childID&amp;tree=$tree\">$childname</a>";
					if( $crights['both'] ) {
						$persontext .= $birthinfo;
						$age = age($child);
						$agelabel = isset($text[$child['sex'].'age']) ? $text[$child['sex'].'age'] : $text['age'];
						if($age) $persontext .= " ($agelabel $age)";

						$frel = strtolower($child['frel']);
						$frelstr = isset($admtext[$frel]) ? $admtext[$frel] : $child['frel'];

						$mrel = strtolower($child['mrel']);
						$mrelstr = isset($admtext[$mrel]) ? $admtext[$mrel] : $child['mrel'];

						if($child['frel']) $persontext .= " &nbsp;[$frelstr]";
						if($child['mrel'] && $child['mrel'] != $child['frel']) $persontext .= " &nbsp;[$mrelstr]";
					}
					$persontext .= "</span></td></tr>\n";
					$kidcount++;
				}
			}
			$persontext .= "</table>\n";
			$persontext .= "</td>\n";
			$persontext .= "</tr>\n";

			tng_free_result( $children );
		}

		foreach( $mediatypes as $mediatype ) {
			$mediatypeID = $mediatype['ID'];
			$persontext .= writeMedia( $fammedia, $mediatypeID, "s" . $marriagerow['familyID'] );
		}
		$persontext .= writeAlbums($famalbums);

		$persontext .= showEvent( array( "text"=>$text['familyid'], "date"=>$marriagerow['familyID'], "place"=>"<a href=\"$familygroup_url" . "familyID={$marriagerow['familyID']}&amp;tree=$tree\">{$text['groupsheet']}</a>&nbsp; | &nbsp;<a href='{$familychart_url}familyID={$marriagerow['familyID']}&amp;tree=$tree'>{$text['familychart']}</a>", "np"=>1 ) );
		if( $marriagerow['changedate'] || ( $allow_edit && $rightfbranch ) ) {
			$marriagerow['changedate'] = displayDate( $marriagerow['changedate'] );
			if( $allow_edit && $rightfbranch ) {
				if( $marriagerow['changedate'] ) $marriagerow['changedate'] .= " | ";
				$marriagerow['changedate'] .= "<a href=\"{$cms['tngpath']}admin_editfamily.php?familyID={$marriagerow['familyID']}&amp;tree=$tree&amp;cw=1\" target=\"blank\">{$text['edit']}</a>";
			}
			$persontext .= showEvent( array( "text"=>$text['lastmodified'], "fact"=>$marriagerow['changedate'] ) );
		}
		$persontext .= "</table>\n";
		$persontext .= "<br />\n";
	}
	tng_free_result($marriages);

	$persontext .= endSection("info");

	if ( $map['key'] && $locations2map ) {
		$persontext .= beginSection("eventmap");
		$persontext .= "<table cellspacing=\"1\" cellpadding=\"4\" class=\"whiteback tfixed normal\">\n";
		$persontext .= "<col class=\"labelcol\"/><col class=\"mapcol\"/><col />\n";
		$persontext .= "<tr valign=\"top\"><td class=\"fieldnameback indleftcol\" id=\"eventmap1\"><span class=\"fieldname\">{$text['gmapevent']}</span></td>\n";
		$persontext .= "<td class=\"databack\">\n";
		$persontext .= "<div id=\"map\" class=\"rounded10\" style=\"width: {$map['indw']}; height: {$map['indh']};\">";
		if($map['pstartoff']) $persontext .= "<a href=\"#\" onclick=\"ShowTheMap(); return false;\"><div class=\"loadmap\">{$text['loadmap']}<br/><img src=\"img/loadmap.gif\" width=\"150\" height=\"150\" border=\"0\"></div></a>";
		$persontext .= "</div>\n";
		$persontext .= "</td>\n";
		$mapheight = (intval($map['indh']) - 20) . "px";
		$persontext .= "<td class=\"databack\"><div style=\"height:{$mapheight};\" id=\"mapevents\"><table cellpadding=\"4\" class=\"whiteback\">\n";

		asort($locations2map);
		reset($locations2map);
		$markerIcon = 0;
		$nonzeroplaces = 0;
		$usedplaces = array();
		$savedplaces = array();
		foreach($locations2map as $key => $val)    {
		// RM these next lines are about getting different coloured pins for different levels of place
			$placelevel = $val['placelevel'];
			$pinplacelevel = $val['pinplacelevel'];
			if (!$placelevel)
				$placelevel = 0;
			else
				$nonzeroplaces++;
			if (!$pinplacelevel) $pinplacelevel = $pinplacelevel0;
			$lat = $val['lat'];
			$long = $val['long'];
			$zoom = $val['zoom'] ? $val['zoom'] : 10;
			$event = $val['event'];
			$place = $val['place'];
			$dateforremoteballoon = $dateforeventtable = displayDate($val['eventdate']);
			$dateforlocalballoon = @htmlspecialchars(tng_real_escape_string($dateforremoteballoon), ENT_QUOTES, $session_charset);
			$description = is_array($val['description']) ? implode(",",$val['description']) : $val['description'];
			$balloondesc = str_replace("\n"," ",$description);
			if ($place) {
				$persontext .= "<tr valign=\"top\"><td class=\"databack\">";
				if( $lat && $long ) {
					$directionplace = @htmlspecialchars(stri_replace($banish, $banreplace, $place), ENT_QUOTES, $session_charset);
					$directionballoontext = @htmlspecialchars(stri_replace($banish, $banreplace, $place), ENT_QUOTES, $session_charset);
					if($map['showallpins'] || !in_array($place,$usedplaces)) {
						$markerIcon++;
						$usedplaces[] = $place;
						$savedplaces[] = array("place"=>$place,"key"=>$key);
						$locations2map[$key]['htmlcontent'] = "<div class=\"mapballoon normal\" style=\"margin-top:10px\"><strong>{$val['fixedplace']}</strong><br /><br />" . addslashes($event) . ": $dateforlocalballoon";
						$locations2map[$key]['htmlcontent'] .= "<br /><br /><a href=\"{$http}://maps.google.com/maps?f=q&amp;hl={$text['glang']}&amp;daddr=$lat,$long($directionballoontext)&amp;z=$zoom&amp;om=1&amp;iwloc=addr\" target=\"_blank\">{$text['getdirections']}</a>{$text['directionsto']} $directionplace</div>";
						$thismarker = $markerIcon;
					}
					else {
						$total = count($usedplaces);
						for($i = 0; $i < $total; $i++) {
							if($savedplaces[$i]['place'] == $place) {
								$thismarker = $i + 1;
								$thiskey = $savedplaces[$i]['key'];
								$locations2map[$thiskey]['htmlcontent'] = str_replace("</div>","<br/><br/>$event: $dateforlocalballoon</div>",$locations2map[$thiskey]['htmlcontent']);
								break;
							}
						}
					}
					$persontext .= "<a href=\"{$http}://maps.google.com/maps?f=q&amp;hl={$text['glang']}&amp;daddr=$lat,$long($directionballoontext)&amp;z=$zoom&amp;om=1&amp;iwloc=addr\" target= \"_blank\"><img src=\"{$cms['tngpath']}google_marker.php?image=$pinplacelevel.png&amp;text=$thismarker\" alt=\"{$text['googlemaplink']}\" border=\"0\" width= \"20\" height=\"34\" /></a>";
					$map['pins']++;
				}
				else
					$persontext .= "&nbsp;";
				$persontext .= "</td><td class=\"databack\"><span class=\"smaller\"><strong>$event</strong>";
				if($description) $persontext .= " - $description";
				$persontext .= " - $dateforeventtable - $place</span></td>\n";
				$persontext .= "<td class=\"databack\" valign=\"middle\"><a href=\"{$cms['tngpath']}googleearthbylatlong.php?m=world&amp;n=$directionplace&amp;lon=$long&amp;lat=$lat&amp;z=$zoom\" title=\"{$text['kmlfile']}\"><img src=\"{$cms['tngpath']}img/earth.gif\" border=\"0\" alt=\"{$text['googleearthlink']}\" width=\"15\" height=\"15\" /></a></td></tr>\n";
				if($val['notes'])
					$locations2map[$key]['htmlcontent'] = str_replace("</div>","<br /><br />" . tng_real_escape_string($val['notes']) . "</div>",$locations2map[$key]['htmlcontent']);
			}
		}
		$persontext .= "</table></div>\n<table>";
		$persontext .= "<tr><td><span class=\"smaller\"><img src=\"{$cms['tngpath']}img/earth.gif\" border=\"0\" alt=\"\" width=\"15\" height=\"15\" align=\"left\" />&nbsp;= <a href=\"https://earth.google.com/\" target=\"_blank\" title=\"{$text['download']}\">{$text['googleearthlink']}</a>&nbsp;</span></td></tr></table>\n";
		$persontext .= "</td>\n</tr>\n";
		if($nonzeroplaces) {
			$persontext .= "<tr valign=\"top\"><td class=\"fieldnameback\"><span class=\"fieldname\">{$text['gmaplegend']}</span></td>\n";
			$persontext .= "<td colspan=\"2\" class=\"databack\"><span class=\"smaller\">";
			for($i = 1; $i < 7; $i++ )
				$persontext .= "<img src=\"{$cms['tngpath']}img/" . ${"pinplacelevel" .$i} . ".png\" alt=\"\" height=\"17\" width=\"10\" class=\"alignmiddle\"/>&nbsp;: " . $admtext["level$i"] . " &nbsp;&nbsp;&nbsp;&nbsp;\n";
			$persontext .= "<img src=\"{$cms['tngpath']}img/$pinplacelevel0.png\" alt=\"\" height=\"17\" width=\"10\" class=\"aligntop\"/>&nbsp;: {$admtext['level0']}</span></td>\n";
			$persontext .= "</tr>\n";
		}
		$persontext .= "</table>\n";
		$persontext .= "<br />\n";
		$persontext .= endSection("eventmap");
	}

	if( empty($tng_extras) ) {
		$media = doMediaSection($personID,$indmedia,$indalbums);
		if( $media ) {
			$persontext .= beginSection("media");
			$persontext .= $media . "<br/>\n";
			$persontext .= endSection("media");
		}
	}

	if( $notestogether != 1 ) {
		if( $rights['both']) {
			$notes = $notestogether ? buildGenNotes( $indnotes, $personID, "--x-general-x--" ) : buildNotes( $indnotes, $personID );
		}
		else
			$notes = $text['livingnote'];

		if( $notes ) {
			$persontext .= beginSection("notes");
			$persontext .= "<table cellspacing=\"1\" cellpadding=\"4\" class=\"whiteback tfixed normal\">\n";
			$persontext .= "<col class=\"labelcol\"/><col />\n";
			$persontext .= "<tr>\n";
			$persontext .= "<td valign=\"top\" class=\"fieldnameback indleftcol\" id=\"notes1\"><span class=\"fieldname\">{$text['notes']}&nbsp;</span></td>\n";
			$persontext .= "<td valign=\"top\" class=\"databack\">$notes</td>\n";
			$persontext .= "</tr>\n";
			$persontext .= "</table>\n";
			$persontext .= "<br />\n";
			$persontext .= endSection("notes");
		}
	}

	if( $citedispctr ) {
		$persontext .= beginSection("citations");
		$persontext .= "<table cellspacing=\"1\" cellpadding=\"4\" class=\"whiteback tfixed normal\">\n";
		$persontext .= "<col class=\"labelcol\"/><col />\n";
		$persontext .= "<tr>\n";
		$persontext .= "<td valign=\"top\" class=\"fieldnameback indleftcol\" id=\"citations1\"><a name=\"sources\"><span class=\"fieldname\">{$text['sources']}&nbsp;</span></a></td>\n";
		$persontext .= "<td valign=\"top\" class=\"databack\">";
		if(!empty($tngconfig['scrollcite']))
			$persontext .= "<div class=\"notearea\">";
		$persontext .= "<ol class=\"normal citeblock\">";
		$citectr = 0;
		$count = count($citestring);
		foreach( $citestring as $cite ) {
			$persontext .= "<li class=\"normal\"><a name=\"cite" . ++$citectr . "\"></a>$cite<br />";
			if( $citectr < $count )
				$persontext .= "<br />";
			$persontext .= "</li>\n";
		}
		$persontext .= "</ol>";
		if(!empty($tngconfig['scrollcite']))
			$persontext .= "</div>";
		$persontext .= "</td>\n</tr>\n</table>\n";
		$persontext .= "<br />\n";
		$persontext .= endSection("citations");
	}
	$persontext .= "</ul>\n";

	$tng_alink = $tng_plink = $tng_mlink = $tng_glink = "lightlink";
	if( !empty($media) || $notes || $citedispctr || $map['key'] ) {
		if( $tngconfig['istart'] ) {
			if( !empty($tng_extras) )
				$tng_mlink = "lightlink3";
			else
				$tng_plink = "lightlink3";
		}
		else
			$tng_alink = "lightlink3";
		$innermenu = $num_collapsed ? "<div style=\"float:right\"><a href=\"#\" onclick=\"{$showdnatest}return toggleCollapsed(0)\" class=\"lightlink\">{$text['expandall']}</a> &nbsp; | &nbsp; <a href=\"#\" onclick=\"{$hidednatest}return toggleCollapsed(1)\" class=\"lightlink\">{$text['collapseall']}</a> &nbsp;</div>" : "";
		$innermenu .= "<a href=\"#\" class=\"$tng_plink\" onclick=\"return infoToggle('info');\" id=\"tng_plink\">{$text['persinfo']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
		if( !empty($media) )
			$innermenu .= "<a href=\"#\" class=\"$tng_mlink\" onclick=\"return infoToggle('media');\" id=\"tng_mlink\">{$text['media']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
		if( $notes )
			$innermenu .= "<a href=\"#\" class=\"lightlink\" onclick=\"return infoToggle('notes');\" id=\"tng_nlink\">{$text['notes']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
		if( $citedispctr )
			$innermenu .= "<a href=\"#\" class=\"lightlink\" onclick=\"return infoToggle('citations');\" id=\"tng_clink\">{$text['sources']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
		if( $map['key'] && $locations2map)
			$innermenu .= "<a href=\"#\" class=\"lightlink\" onclick=\"return infoToggle('eventmap');\" id=\"tng_glink\">{$text['gmapevent']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
		$innermenu .= "<a href=\"#\" class=\"$tng_alink\" onclick=\"return infoToggle('all');\" id=\"tng_alink\">{$text['all']}</a>\n";
	}
	else
		$innermenu = "<span class=\"lightlink3\" id=\"tng_plink\">{$text['persinfo']}</span>\n";
   if($allowpdf)
    	$innermenu .= " &nbsp;&nbsp; | &nbsp;&nbsp; <a href=\"#\" class=\"lightlink\" onclick=\"tnglitbox = new LITBox('$pdfform_url" . "pdftype=ind&amp;personID=$personID&amp;tree=$tree',{width:350,height:350});return false;\">PDF</a>\n";

	$rightbranch = $org_rightbranch;
	echo tng_menu( "I", "person", $personID, $innermenu );
?>
<script type="text/javascript" src="<?php echo $cms['tngpath']; ?>js/getperson.js"></script>
<script type="text/javascript">
function infoToggle(part) {
	if( part == "all" ) {
		jQuery('#info').show();
<?php
	if( !empty($media) ) {
		echo "\$('#media').show();\n";
		echo "\$('#tng_mlink').attr('class','lightlink');\n";
	}
	if( $notes ) {
		echo "\$('#notes').show();\n";
		echo "\$('#tng_nlink').attr('class','lightlink');\n";
	}
	if( $citedispctr ) {
		echo "\$('#citations').show();\n";
		echo "\$('#tng_clink').attr('class','lightlink');\n";
	}
	if( $map['key'] && $locations2map) {
		echo "\$('#eventmap').show();\n";
		echo "\$('#tng_glink').attr('class','lightlink');\n";
	}
?>
		jQuery('#tng_alink').attr('class','lightlink3');
		jQuery('#tng_plink').attr('class','lightlink');
	}
	else {
		innerToggle(part,"info","tng_plink");
<?php
	if( !empty($media) )
		echo "innerToggle(part,\"media\",\"tng_mlink\");\n";
	if( $notes )
		echo "innerToggle(part,\"notes\",\"tng_nlink\");\n";
	if( $citedispctr )
		echo "innerToggle(part,\"citations\",\"tng_clink\");\n";
	if( $map['key'] && $locations2map) {
		echo "innerToggle(part,\"eventmap\",\"tng_glink\");\n";
	}
?>
		jQuery('#tng_alink').attr('class','lightlink');
	}
<?php
	if( $map['key'] && $locations2map && $tngconfig['istart']) {
		echo "if((part==\"eventmap\" || part==\"all\") && !maploaded) {\n";
		echo "ShowTheMap();\n}\n";
	}
?>
	return false;
}
</script>

<?php
	echo $persontext;
?>
</div>
<br/>

<?php
if(!isset($flags['more'])) $flags['more'] = "";
if( $map['key'] && $locations2map && $tngconfig['istart']) {
	$flags['more'] .= "\n<script type=\"text/javascript\">";
	$flags['more'] .= "window.onload = function() {\$('#eventmap').hide();};\n";
	$flags['more'] .= "</script>\n";
}

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