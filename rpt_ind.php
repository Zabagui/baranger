<?php
// PDF Individual Report
// Author: Bret Rumsey
// Thanks to J. Kraber for his original implementation of this report.
//
$textpart = "getperson";
include("tng_begin.php");
$tngprint = 1;

include($cms['tngpath'] . "personlib.php");

initMediaTypes();

define('FPDF_FONTPATH', $rootpath . $endrootpath . 'font/');
require($cms['tngpath'] . 'tngpdf.php');
require($cms['tngpath'] . 'rpt_utils.php');
$pdf = new TNGPDF($orient, 'in', $pagesize);
setcookie("tng_pagesize", $pagesize, time()+31536000, "/");

$uni = $session_charset == "UTF-8" ? true : false;

// load fonts
$pdf->AddFont($rptFont, '', '', $uni);
$pdf->AddFont($rptFont, "B", '', $uni);

// define formatting defaults
$lineheight = $pdf->GetFontSize($rptFont, $rptFontSize) + 0.1;	// height of each row on the page
$shading = 220;		// value of shaded lines (255 = white, 0 = black)
$citefontsub = 4;	// number of font pts to take off for superscript

$ldsOK = determineLDSRights(true);

// compute the label width based on the longest string that will be displayed
$labelwidth = getMaxStringWidth(array($text['name'], $text['born'], $text['christened'], $text['died'], $text['buried'], $text['cremated'], $text['spouse'], $text['married']), $rptFont, "B", $lblFontSize, ':');
if ($ldsOK)
    $labelwidth = getMaxStringWidth(array($text['baptizedlds'], $text['endowedlds'], $text['sealedslds']), $rptFont, "B", $lblFontSize, ':', $labelwidth);
$labelwidth += 0.1;

// create Header
if ( !isset($blankform) ) $blankform = 0;
if ( !isset($citesources) ) $citesources = 0;
if ($blankform == 1) 
    $title = $text['indreport'];
else {
    $result = getPersonData($tree, $personID);
    if ($result) {
        $row = tng_fetch_assoc( $result );

		$righttree = checktree($tree);
		$rights = determineLivingPrivateRights($row, $righttree);
		$row['allow_living'] = $rights['living'];
		$row['allow_private'] = $rights['private'];

        $namestr = getName($row);
    }

    $title = $text['indreportfor'] . " $namestr ($personID)";
}

$pdf->SetTitle($title, $uni);
$titleConfig = array(	'title' => $title,
			'image' => $blankform ? "" : getPdfSmallPhoto($personID, $rights['living'] && $rights['private'], $row['sex']),
			'font' => $rptFont,
			'fontSize' => $hdrFontSize,
			'justification' => 'L',
			'lMargin' => $lftmrg,
			'skipFirst' => false,
			'header' => false,
			'line' => false);
$footerConfig = array(	'font' => $rptFont,
			'fontSizeLarge' => 8,
			'fontSizeSmall' => 6,
			'printWordPage' => true,
			'bMargin' => $botmrg,
			'lMargin' => $lftmrg,
			'skipFirst' => false,
			'line' => false);

// set margins
$pdf->SetTopMargin($topmrg);
$pdf->SetLeftMargin($lftmrg);
$pdf->SetRightMargin($rtmrg);
$pdf->SetAutoPageBreak(1,$botmrg+$pdf->GetFooterHeight()+$lineheight); // this sets the bottom margin for us
$pdf->SetFillColor($shading);

// PDF settings
$pdf->SetAuthor($dbowner);

// let's get started
$pdf->AddPage();
$paperdim = $pdf->GetPageSize();

$citations = array();
$citedisplay = array();
$citestring = array();

// create a blank form if that's what they asked for
if ($blankform == 1) {

    nameLine($text['name'], '', $text['gender'], '');
    doubleLine($text['born'], '', $text['place'], '');
    if(!$tngconfig['hidechr'])
	    doubleLine($text['christened'], '', $text['place'], '');
    doubleLine($text['died'], '', $text['place'], '');
    doubleLine($text['buried'], '', $text['place'], '');
    if($ldsOK) {
		doubleLine($text['baptizedlds'], '', $text['place'], '');
		doubleLine($text['endowedlds'], '', $text['place'], '');
    }
    singleLine($text['spouse'], '', "B");
    doubleLine($text['married'], '', $text['place'], '');
    if($ldsOK) {
		doubleLine($text['sealedslds'], '', $text['place'], '');
    }
    childLine(1, '');
    childLine(2, '');
    childLine(3, '');
    childLine(4, '');
    childLine(5, '');
    $pdf->SetFont($rptFont, "B", $lblFontSize);
    pageBox();
    titleLine($text['general']);
}

// create a filled in form
else {
    if ($citesources && $rights['both'])
		getCitations($personID, 0);

    //$y = $pdf->GetY();
    $cite = reorderCitation($personID."_", 0);
    $cite2 = reorderCitation($personID."_NAME", 0);
	if( $cite2 )
		$cite .= $cite ? ", $cite2" : $cite2;
	$gender = strtoupper($row['sex']);
	if($gender == "M")
		$gender = $text['male'];
	else if($gender == "F")
		$gender = $text['female'];
	else if($gender == "U")
		$gender = $text['unknown'];
	else
		$gender = $row['sex'];
	nameLine($text['name'], $namestr, $text['gender'], $gender, $cite);
	if($row['nickname'])
		singleLine($text['nickname'], $row['nickname']);

    // birth
    if($rights['both']) {
		$cite = reorderCitation($personID."_BIRT", 0);
		doubleLine($text['born'], displayDate($row['birthdate']), $text['place'], $row['birthplace'], $cite);

		if(!$tngconfig['hidechr']) {
			$cite = reorderCitation($personID."_CHR", 0);
			doubleLine($text['christened'], displayDate($row['altbirthdate']), $text['place'], $row['altbirthplace'], $cite);
		}

		$custevents = getPersonEventData($tree, $personID);
		while ( $custevent = tng_fetch_assoc( $custevents ) )	{
		    $displayval = getEventDisplay( $custevent['display'] );
		    $fact = array();
		    if( $custevent['info'] ) {
				$fact = checkXnote( $custevent['info'] );
				if( !empty($fact[1]) ) {
				    $xnote = $fact[1];
				    array_pop( $fact );
				}
		    }
			$done = false;
		    if($custevent['eventdate'] || $custevent['eventplace']) {
				$cite = reorderCitation($personID."_".$custevent['eventID'], 0);
				doubleLine($displayval, displayDate($custevent['eventdate']), $text['place'], $custevent['eventplace'], $cite);
				$done = true;
		    }
			if($custevent['info']) {
				if($done) {
					$cite = reorderCitation($personID."_".$custevent['eventID'], 0);
					$displayval = $text['cont'];
				}
				else
					$cite = "";
				singleLine($displayval, $custevent['info'], "", $cite);
			}
		}
		tng_free_result( $custevents );
		
		$cite = reorderCitation($personID."_DEAT", 0);
		doubleLine($text['died'], displayDate($row['deathdate']), $text['place'], $row['deathplace'], $cite);

		$cite = reorderCitation($personID."_BURI", 0);
		$burialmsg = $row['burialtype'] ? $text['cremated'] : $text['buried'];
		doubleLine($burialmsg, displayDate($row['burialdate']), $text['place'], $row['burialplace'], $cite);
    }
    else {
		doubleLine($text['born'], '', $text['place'], '');
    	if(!$tngconfig['hidechr'])
			doubleLine($text['christened'], '', $text['place'], '');
		doubleLine($text['died'], '', $text['place'], '');
		doubleLine($text['buried'], '', $text['place'], '');
	}

    if($rights['lds']) {
		if($rights['both']) {
		    $cite = reorderCitation($personID."_BAPL", 0);
		    doubleLine($text['baptizedlds'], displayDate($row['baptdate']), $text['place'], $row['baptplace'], $cite);
		    $cite = reorderCitation($personID."_CONF", 0);
		    doubleLine($text['conflds'], displayDate($row['confdate']), $text['place'], $row['confplace'], $cite);
		    $cite = reorderCitation($personID."_INIT", 0);
		    doubleLine($text['initlds'], displayDate($row['initdate']), $text['place'], $row['initplace'], $cite);
		    $cite = reorderCitation($personID."_ENDL", 0);
		    doubleLine($text['endowedlds'], displayDate($row['endldate']), $text['place'], $row['endlplace'], $cite);
		}
		else {
		    doubleLine($text['baptizedlds'], '', $text['place'], '');
		    doubleLine($text['endowedlds'], '', $text['place'], '');
		}
    }

    // do parents
    $parents = getChildParentsFamily($tree, $personID);
    if ($parents && tng_num_rows($parents)) {
		$titleConfig = array(	'title' => $title,
			'font' => $rptFont,
			'fontSize' => $hdrFontSize,
			'justification' => 'L',
			'lMargin' => $lftmrg,
			'skipFirst' => false,
			'line' => false);
		while ($parent = tng_fetch_assoc($parents)) {
    		$gotfather = getParentSimplePlusDates($tree, $parent['familyID'], "husband");
			$fathrow = tng_fetch_assoc($gotfather);
    		if($fathrow) {

				$frights = determineLivingPrivateRights($fathrow, $righttree);
   				$fathrow['allow_living'] = $frights['living'];
				$fathrow['allow_private'] = $frights['private'];

				if ($fathrow['firstname'] || $fathrow['lastname']) {
		    			$fathname = getName($fathrow);
				}
				$fathtext = generateDates($fathrow);
				if ($citesources && $frights['both'])
		    			getCitations($fathrow['personID'], 0);
				$cite = reorderCitation($fathrow['personID']."_", 0);
				$cite2 = reorderCitation($fathrow['personID']."_NAME", 0);
				if( $cite2 )
					$cite .= $cite ? ", $cite2" : $cite2;
				singleLine($text['father'], "$fathname $fathtext", '', $cite);
			}
			else {
				singleLine($text['father'], '');
			}

			$gotmother = getParentSimplePlusDates($tree, $parent['familyID'], "wife");
			$mothrow = tng_fetch_assoc($gotmother);
    		if ($mothrow) {

				$mrights = determineLivingPrivateRights($mothrow, $righttree);
				$mothrow['allow_living'] = $mrights['living'];
				$mothrow['allow_private'] = $mrights['private'];

				if ($mothrow['firstname'] || $mothrow['lastname']) {
					$mothname = getName($mothrow);
				}
				$mothtext = generateDates($mothrow);
				if ($citesources && $mrights['both'])
					getCitations($mothrow['personID'], 0);
				$cite = reorderCitation($mothrow['personID']."_", 0);
				$cite2 = reorderCitation($mothrow['personID']."_NAME", 0);
				if( $cite2 )
					$cite .= $cite ? ", $cite2" : $cite2;
				singleLine($text['mother'], "$mothname $mothtext", '', $cite);
			}
			else {
				singleLine($text['mother'], '');
			}

			if($rights['lds']) {
				if($rights['both']) {
					doubleLine($text['sealedplds'], displayDate($parent['sealdate']), $text['place'], $parent['sealplace']);
				}
				else {
					doubleLine($text['sealedplds'], '', $text['place'], '');
				}
			}
		}
    }

    // print two empty fields
    else {
		singleLine($text['father'], '');
		singleLine($text['mother'], '');
    }

    if ($row['sex'] == 'M') {
		$spouse = 'wife';
		$spouseorder = 'husborder';
		$self = "husband";
    }
    else if ($row['sex'] == 'F') {
		$spouse = 'husband';
		$spouseorder = 'wifeorder';
		$self = "wife";
    }
    else {
		$spouseorder = '';
    }
    if ($spouseorder) 
		$marriages = getSpouseFamilyDataPlusDates($tree, $self, $personID, $spouseorder);
    else
		$marriages = getSpouseFamilyDataUnionPlusDates($tree, $personID);
	if( !tng_num_rows($marriages) && $spouseorder) {
    	$marriages = getSpouseFamilyDataUnionPlusDates($tree, $personID);
		$spouseorder = 0;
	}
    while ($marriagerow = tng_fetch_assoc($marriages)) {
		$mrights = determineLivingPrivateRights($marriagerow, $righttree);
   		$marriagerow['allow_living'] = $mrights['living'];
		$marriagerow['allow_private'] = $mrights['private'];

		if ($citesources && $mrights['both'])
		    getCitations($marriagerow['familyID'], 0);
		if (!$spouseorder)
		    $spouse = $marriagerow['husband'] == $personID ? 'wife' : 'husband';
		if ($marriagerow[$spouse]) {
		    $spouseresult = getPersonSimple($tree, $marriagerow[$spouse]);
		    $spouserow = tng_fetch_assoc($spouseresult);

			$srights = determineLivingPrivateRights($spouserow, $righttree);
	   		$spouserow['allow_living'] = $srights['living'];
			$spouserow['allow_private'] = $srights['private'];

		    $namestr = getName($spouserow);
		    $spousetext = generateDates($spouserow);
		    if ($citesources && $srights['both'])
				getCitations($marriagerow[$spouse], 0);
		    $cite = reorderCitation($marriagerow[$spouse]."_", 0);
		    $cite2 = reorderCitation($marriagerow[$spouse]."_NAME", 0);
			if( $cite2 )
				$cite .= $cite ? ", $cite2" : $cite2;
		    singleLine($text['spouse'], "$namestr $spousetext", '', $cite);
		}
		if($mrights['both']) {
		    $cite = reorderCitation($marriagerow['familyID']."_MARR", 0);
		    doubleLine($text['married'], displayDate($marriagerow['marrdate']), $text['place'], $marriagerow['marrplace'], $cite);
		}
		else
		    doubleLine($text['married'], '', $text['place'], '');
		if($mrights['lds']) {
		    if($mrights['both']) {
				$cite = reorderCitation($marriagerow['familyID']."_SLGS", 0);
				doubleLine($text['sealedslds'], displayDate($marriagerow['sealdate']), $text['place'], $marriagerow['sealplace'], $cite);
		    } else
				doubleLine($text['sealedslds'], '', $text['place'], '');
		}

		// get the children from this marriage
		$children = getChildrenDataPlusDates($tree, $marriagerow['familyID']);
		if ($children && tng_num_rows($children)) {
		    $childcnt = 1;
		    while ($child = tng_fetch_assoc($children)) {
				$crights = determineLivingPrivateRights($child, $righttree);
				$child['allow_living'] = $crights['living'];
				$child['allow_private'] = $crights['private'];

				$namestr = getName($child);
				$childtext = generateDates($child);
				if ($citesources && $crights['both'])
				    getCitations($child['personID'], 0);
				$cite = reorderCitation($child['personID']."_NAME", 0);
				childLine($childcnt, "$namestr $childtext", $cite);
				$childcnt++;
			    }
			}
	    }

	    // notes and such
	    // draw the box to contain the notes
	    pageBox();
	    titleLine($text['general']);
	    $titleConfig['header'] = $text['general'] . ' ' . $text['cont'];
	    $titleConfig['headerFont'] = $rptFont;
	    $titleConfig['headerFontSize'] = $lblFontSize;
	    $titleConfig['outline'] = true;

	    if($rights['both']) {
			$indnotes = getNotes($personID, 'I');
		$notes = '';
		$lasttitle = '---';
		foreach ($indnotes as $key => $note) {
		    if ($note['title'] != $lasttitle) {
				if ($notes)
				    $notes .= "\n\n";
				if ($note['title'])
				    $notes .= $note['title']."\n";
		    }
		    $notes .= $note['text'];
		}
		$notes = preg_replace("/&nbsp;/", ' ', $notes);
		$notes = preg_replace("/<li>/", '* ', $notes);
		$notes = preg_replace("/<br\s*\/?>/", "", $notes);
		//if(!isset($allowable_tags))
			//$allowable_tags = "<a>";
		$allowable_tags = "";
		$notes = strip_tags($notes, $allowable_tags);

		$pdf->Ln(0.05);
		$pdf->SetFont($rptFont, '', $rptFontSize);
		$pdf->MultiCell($paperdim['w'] - $rtmrg - $lftmrg, $pdf->GetFontSize(), $notes, 0, 'L', 0, 0);

		//media goes here
		//$pdf->Ln(0.05);
 	    //titleLine($text['photos']);
   }

    // create the citations page
    if ($citesources && $citestring) {
		$titleConfig['header'] = $text['sources'];
		$titleConfig['headerFont'] = $rptFont;
		$titleConfig['headerFontSize'] = $lblFontSize;
		$titleConfig['outline'] = true;
		$pdf->AddPage();
		$titleConfig['header'] = $text['sources'] . ' ' . $text['cont'];

		// reduce the font
		$pdf->SetFont($rptFont, '', $rptFontSize-2);

		// push in our left margin a bit
		$pdf->SetLeftMargin($lftmrg*1.5);
		$citectr = 1;
		foreach ($citestring as $cite) {
			$cite = strip_tags($cite);
			//$cite = preg_replace("/\n/", " ", $cite);
			$pdf->MultiCell($paperdim['w'] - $rtmrg - ($lftmrg*1.5), $pdf->GetFontSize(), "$citectr. $cite\n\n", 0, 'L', 0, 0);
		    //$pdf->WriteHTML("<br>$citectr. $cite<br>");
		    $citectr++;
		}
    }
}

// print it out
$pdf->Output();

// childLine
function childLine($childnum, $data, $cite = '') {
    global $pdf, $paperdim, $lftmrg, $rtmrg, $botmrg, $lineheight;
    global $rptFont, $rptFontSize, $rptFont, $lblFontSize, $citefontsub;
    global $labelwidth, $text;

    $pdf->SetFont($rptFont, "B", $lblFontSize);

    $pdf->Cell($labelwidth, $lineheight, "$childnum", 1, 0, 'R');
    if ($childnum == 1) {
	$pdf->SetX($lftmrg);
	$pdf->Cell($labelwidth, $lineheight, $text['children'] . ":", 0, 0, 'L');
    }
    $pdf->SetFont($rptFont, '', $rptFontSize);
    $pdf->Cell($paperdim['w'] - $pdf->GetX() - $rtmrg, $lineheight, $data, 1, 0, 'L');
    if ($cite != '') {
	$pdf->SetX($lftmrg + $labelwidth + $pdf->GetStringWidth($data));
	$pdf->SetFont($rptFont, '', $rptFontSize-$citefontsub);
	$pdf->Cell(0, $lineheight / 2, " $cite");
    }
    $pdf->Ln($lineheight);
}

// singleLine
function singleLine($label, $data, $datastyle = '', $cite = '') {
    global $pdf, $paperdim, $lftmrg, $rtmrg, $botmrg, $lineheight;
    global $rptFont, $rptFontSize, $rptFont, $lblFontSize, $citefontsub;
    global $labelwidth;

	$data = strip_tags($data);

    if($label)
		$label .= ":";

	$spaceWidth = $paperdim['w'] - $lftmrg - $rtmrg - $labelwidth;
    $pdf->SetFont($rptFont, $datastyle, $rptFontSize);
	$stringWidth = $pdf->GetStringWidth($data);

	$borderWidth = $stringWidth > $spaceWidth ? 0 : 1;

	$pdf->SetFont($rptFont, "B", $lblFontSize);
	$pdf->Cell($labelwidth, $lineheight, $label, $borderWidth, 0, 'L');
    $pdf->SetFont($rptFont, $datastyle, $rptFontSize);

	if($stringWidth > $spaceWidth) {
		$topY = $pdf->GetY();
		$pdf->MultiCell($paperdim['w'] - $rtmrg - $lftmrg - $labelwidth, $pdf->GetFontSize(), $data, 1, 'L', 0, 0);
		$lowerY = $pdf->GetY();
		$diff = $lowerY - $topY;
		$pdf->SetY($topY);
		if($diff > 0 )
			$pdf->Cell($labelwidth, $diff, "", 1, 0, 'L');
		$pdf->SetY($lowerY);
		$lineWidth = $spaceWidth - .2;  //for citations
	}
	else {
		$pdf->Cell($paperdim['w'] - $pdf->GetX() - $rtmrg, $lineheight, $data, 1, 0, 'L');
		$lineWidth = $pdf->GetStringWidth($data);
	}
    if ($cite != '') {
	$pdf->SetX($lftmrg + $labelwidth + $lineWidth);
	$pdf->SetFont($rptFont, $datastyle, $rptFontSize-$citefontsub);
	$pdf->Cell(0, $lineheight / 2, " $cite");
    }
    if($stringWidth <= $spaceWidth)
    	$pdf->Ln($lineheight);
}

// nameLine
function nameLine($label1, $data1, $label2, $data2, $cite = '') {
    global $textindent, $pdf, $paperdim, $lftmrg, $rtmrg, $botmrg, $lineheight;
    global $rptFont, $rptFontSize, $rptFont, $lblFontSize, $citefontsub;
    global $labelwidth;

	$data1 = strip_tags($data1);
	$data2 = strip_tags($data2);
    $genderwidth = 1.0;
    $pdf->SetFont($rptFont, "B", $lblFontSize);
    $label2width = $pdf->GetStringWidth($label2.':  ');

    $pdf->SetFont($rptFont, "B", $lblFontSize);
    $pdf->Cell($labelwidth, $lineheight, $label1 . ":", 1, 0, 'L');
    $pdf->SetFont($rptFont, "B", $rptFontSize);
    $pdf->CellFit($paperdim['w'] - $rtmrg - $lftmrg - $genderwidth - $label2width - $labelwidth, $lineheight, $data1, 1, 0, 'L', 0, '', 1, 0);
    if ($cite != '') {
	$x = $pdf->GetX();
	$pdf->SetX($lftmrg + $labelwidth + $pdf->GetStringWidth($data1));
	$pdf->SetFont($rptFont, "B", $rptFontSize-$citefontsub);
	$pdf->Cell(0, $lineheight / 2, " $cite");
	$pdf->SetX($x);
    }
    $pdf->SetFont($rptFont, "B", $lblFontSize);
    $pdf->Cell($label2width, $lineheight, $label2 . ":", 1, 0, 'L');
    $pdf->SetFont($rptFont, '', $rptFontSize);
    $pdf->CellFit($genderwidth, $lineheight, $data2, 1, 0, 'L', 0, '', 1, 0);
    $pdf->Ln($lineheight);
}

// doubleLine
function doubleLine($label1, $data1, $label2, $data2, $cite = '') {
    global $pdf, $paperdim, $lftmrg, $rtmrg, $botmrg, $lineheight;
    global $rptFont, $rptFontSize, $rptFont, $lblFontSize, $citefontsub;
    global $linehalf, $labelwidth;

	$data1 = strip_tags($data1);
	$data2 = strip_tags($data2);
    $datewidth = 2.0;	    // width of date box in inches
    $pdf->SetFont($rptFont, "B", $lblFontSize);
    $placewidth = $pdf->GetStringWidth($label2.':  ');

    $pdf->SetFont($rptFont, "B", $lblFontSize);
    $pdf->CellFit($labelwidth, $lineheight, $label1 . ":", 1, 0, 'L', 0, '', 1, 0);
    $pdf->SetFont($rptFont, '', $rptFontSize);
    $pdf->CellFit($datewidth, $lineheight, $data1, 1, 0, 'L', 0, '', 1, 0);
    $pdf->SetFont($rptFont, "B", $lblFontSize);
    $pdf->Cell($placewidth, $lineheight, $label2 . ":", 1, 0, 'L');
    $pdf->SetFont($rptFont, '', $rptFontSize);
    $pdf->CellFit($paperdim['w'] - $pdf->GetX() - $rtmrg, $lineheight, $data2, 1, 0, 'L', 0, '', 1, 0);
    if ($cite != '') {
	if ($data2 == '') 
	    $x = $labelwidth + $pdf->GetStringWidth($data1) + $lftmrg;
	else
	    $x = $labelwidth + $datewidth + $placewidth + $pdf->GetStringWidth($data2) + $lftmrg;
	$pdf->SetX($x);
	$pdf->SetFont($rptFont, '', $rptFontSize-$citefontsub);
	$pdf->Cell(0, $lineheight / 2, " $cite");
    }
    $pdf->Ln($lineheight);
}

?>