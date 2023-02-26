<?php
// PDF Pedigree Report
// Author: Bret Rumsey
// Thanks to J. Kraber for his original implementation of this report.
//
$textpart = "pedigree";
include("tng_begin.php");
$tngprint = 1;

initMediaTypes();

define('FPDF_FONTPATH', $rootpath . $endrootpath . 'font/');
require($cms['tngpath'] .'tngpdf.php');
require($cms['tngpath'] .'rpt_utils.php');
$pdf = new TNGPDF($orient, 'in', $pagesize);
setcookie("tng_pagesize", $pagesize, time()+31536000, "/");

// define formatting defaults
$textindent = 0.16;	// amount to move text in from the line prefix

$uni = $session_charset == "UTF-8" ? true : false;

// load fonts
$pdf->AddFont($rptFont, '', '', $uni);
$pdf->AddFont($rptFont, "B", '', $uni);

// build up the ancestors
if ( !isset($blankform) ) $blankform = 0;
if ($blankform)
    $title = $text['pedigreech'];
else {
	$righttree = checktree($tree);
    $infoAncestors = getMyAncestors($personID, $tree, $genperpage);
    $row = $infoAncestors[0][0];
    $title = $text['pedigreefor']." " .getName($row);
	$rights = determineLivingPrivateRights($row, $righttree);
	$row['allow_living'] = $rights['living'];
	$row['allow_private'] = $rights['private'];
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
$pdf->SetAutoPageBreak(0, $botmrg); // turn off auto page break

// PDF settings
$pdf->SetAuthor($dbowner);

// let's get started
$pdf->AddPage();
$paperdim = $pdf->GetPageSize();

// where are we after printing the header?
$topy = $pdf->GetY();

// this creates a blank chart, which we will fill in later
$yvals = createBlankChart($genperpage, $topy);

// if we are only creating a blank form, we're done
if ($blankform) {
    $pdf->Output();
    exit;
}

fillChart($genperpage, $infoAncestors, $topy, $yvals);

// create the document
$pdf->Output();

function drawIndInfo($ind, $x, $y, $w, $listwhat, $xh = 0) {
    global $pdf, $lineheight, $textindent;
    global $rptFont, $rptFontSize;

    $w -= $textindent; // account for the indent
    $pdf->SetXY($x + $textindent, $y + ($lineheight / 2));
    $pdf->SetFont($rptFont, "B", $rptFontSize);
    $pdf->CellFit($w, $lineheight+$xh, (!empty($ind['firstname']) || !empty($ind['lastname']) ? getName($ind) : ''), 0, 1, 'L', 0, '', 1, 0);
    $pdf->SetFont($rptFont, '', $rptFontSize);
    if ($listwhat == 0) 
	$list = array('birthdate', 'birthplace', 'marrdate', 'marrplace', 'deathdate', 'deathplace');
    else if ($listwhat == 1) 
	$list = array('birthdate', 'birthplace', 'deathdate', 'deathplace');
    else if ($listwhat == 2) 
	$list = array('birthdate', 'deathdate');
    else if ($listwhat == 3) 
	$list = array('birthdate');
    foreach ($list as $data) {
 	$pdf->SetX($x + $textindent);
	if (!isset($ind[$data])) $ind[$data] = "";
	$pdf->CellFit($w, $lineheight, $ind[$data], 0, 1, 'L', 0, '', 1, 0);
	//$pdf->Cell($w,$lineheight,$ind[$data],0,1,'L',0,'');
    }
}

function fillChart($gens, $ancestors, $topy, $yvals) {
    global $pdf, $paperdim, $topmrg, $botmrg, $lftmrg, $rtmrg;
    global $lineheight, $rptFont, $rptFontSize;

    $lineheight = 0.1;

    // set our font
    $pdf->SetFont($rptFont, '', $rptFontSize);
    if ($gens <= 4) {
	$boxspacing = 0.15;
	$fathboxheight = 0.8;
	$mothboxheight = 0.6;
	$moretopmrg = 0.2;

	// some values that we'll need later
	$yarea = $paperdim['h'] - $botmrg - $topy - $moretopmrg;	// amount of y dimension we have to work with
	$xwid = ($paperdim['w'] - $lftmrg - $rtmrg - ($boxspacing * 3)) / 3;

	// generation 4
	$spacer = ($yarea - (($fathboxheight + $mothboxheight + $boxspacing) * 4)) / 3;
	$x = $paperdim['w'] - $rtmrg - $xwid;
	$y = $topmrg + $moretopmrg;
	if($gens > 3) {
	    // generation 4
	    for ($i = 0; $i < 8; $i += 2) {
		drawIndInfo($ancestors[3][$i], $x, $y, $xwid, 0);
		$y += $fathboxheight + $boxspacing;
		drawIndInfo($ancestors[3][$i+1], $x, $y, $xwid, 1);
		$y += $mothboxheight + $spacer;
	    }
	}

	$x -= $xwid + $boxspacing;
	if($gens > 2) {
	// generation 3
	    for ($i = 0; $i < 4; $i += 2) {
		drawIndInfo($ancestors[2][$i], $x, $yvals[4][$i] - ($fathboxheight / 2), $xwid, 0);
		drawIndInfo($ancestors[2][$i+1], $x, $yvals[4][$i+1] - ($mothboxheight / 2), $xwid, 1);
	    }
	}

	$x -= $xwid + $boxspacing;
	if($gens > 1) {
	    //generation 2
	    drawIndInfo($ancestors[1][0], $x, $yvals[3][0] - ($fathboxheight / 2), $xwid, 0);
	    drawIndInfo($ancestors[1][1], $x, $yvals[3][1] - ($mothboxheight / 2), $xwid, 1);
	}

	// generation 1
	$x -= $boxspacing;
	drawIndInfo($ancestors[0][0], $x, $yvals[2][0] - ($mothboxheight / 2), $xwid, 1);
    }
    else if ($gens == 5) {
	$boxspacing = 0.15;
	$fathboxheight = 0.8;
	$mothboxheight = 0.6;
	$smallboxheight = 0.4;
	$leftindent = 0.5;
	$moretopmrg = 0.2;

	// some values that we'll need later
	$yarea = $paperdim['h'] - $botmrg - $topy - $moretopmrg;	// amount of y dimension we have to work with
	$xwid = ($paperdim['w'] - $lftmrg - $rtmrg - $leftindent - ($boxspacing * 2)) / 3;

	// generation 5
	$spacer = ($yarea - (($smallboxheight * 2 + $boxspacing) * 8)) / 7;
	$x = $paperdim['w'] - $rtmrg - $xwid;
	$y = $topmrg + $moretopmrg;
	for ($i = 0; $i < 16; $i += 2) {
	    drawIndInfo($ancestors[4][$i], $x, $y, $xwid, 2);
	    $y += $smallboxheight + $boxspacing;
	    drawIndInfo($ancestors[4][$i+1], $x, $y, $xwid, 2);
	    $y += $smallboxheight + $spacer;
	}

	// generation 4
	$x -= $xwid + $boxspacing;
	for ($i = 0; $i < 8; $i += 2) {
	    drawIndInfo($ancestors[3][$i], $x, $yvals[5][$i] - ($fathboxheight / 2), $xwid, 0);
	    drawIndInfo($ancestors[3][$i+1], $x, $yvals[5][$i+1] - ($mothboxheight / 2), $xwid, 1);
	}

	// generation 3
	$x -= $xwid + $boxspacing;
	for ($i = 0; $i < 4; $i += 2) {
	    drawIndInfo($ancestors[2][$i], $x, $yvals[4][$i] - ($fathboxheight / 2), $xwid, 0);
	    drawIndInfo($ancestors[2][$i+1], $x, $yvals[4][$i+1] - ($mothboxheight / 2), $xwid, 1);
	}

	// generation 2
	$x = $lftmrg + $boxspacing;
	$xwid = $xwid + $leftindent - $boxspacing;
	drawIndInfo($ancestors[1][0], $x, $yvals[3][0] - ($fathboxheight / 2), $xwid, 0);
	drawIndInfo($ancestors[1][1], $x, $yvals[3][1] - ($mothboxheight / 2), $xwid, 1);

	//generation 1
	drawIndInfo($ancestors[0][0], $lftmrg, $yvals[2][0] - ($mothboxheight / 2), $xwid, 1);
    }
    else if ($gens == 6) {
	$gen6sp = 0.1;
	$boxspacing = 0.15;
	$fathboxheight = 0.8;
	$mothboxheight = 0.6;
	$smallboxheight = 0.2;
	$midboxheight = 0.4;
	$leftindent = 0.5;
	$moretopmrg = 0.2;

	// some values that we'll need later
	$yarea = $paperdim['h'] - $botmrg - $topy - $moretopmrg;	// amount of y dimension we have to work with
	$xwid = ($paperdim['w'] - $lftmrg - $rtmrg - $leftindent - ($boxspacing * 3)) / 4;

	// generation 6
	$spacer = ($yarea - (($smallboxheight * 2 + $gen6sp) * 16)) / 15;
	$x = $paperdim['w'] - $rtmrg - $xwid;
	$y = $topmrg + $moretopmrg;
	for ($i = 0; $i < 32; $i += 2) {
	    drawIndInfo($ancestors[5][$i], $x, $y - ($lineheight / 2), $xwid, 3, 0.02);
	    $y += $smallboxheight + $gen6sp;
	    drawIndInfo($ancestors[5][$i+1], $x, $y - ($lineheight / 2), $xwid, 3, 0.02);
	    $y += $smallboxheight + $spacer;
	}

	// generation 5
	$x -= $xwid + $boxspacing;
	for ($i = 0; $i < 16; $i++) {
	    drawIndInfo($ancestors[4][$i], $x, $yvals[6][$i] - ($lineheight / 2), $xwid, 2, 0.02);
	}

	// generation 4
	$x -= $xwid + $boxspacing;
	for ($i = 0; $i < 8; $i += 2) {
	    drawIndInfo($ancestors[3][$i], $x, $yvals[5][$i] - ($lineheight / 2), $xwid, 0, 0.02);
	    drawIndInfo($ancestors[3][$i+1], $x, $yvals[5][$i+1] - ($lineheight / 2), $xwid, 1, 0.02);
	}

	// generation 3
	$x -= $xwid + $boxspacing;
	for ($i = 0; $i < 4; $i += 2) {
	    drawIndInfo($ancestors[2][$i], $x, $yvals[4][$i] - ($lineheight / 2), $xwid, 0, 0.02);
	    drawIndInfo($ancestors[2][$i+1], $x, $yvals[4][$i+1] - ($lineheight / 2), $xwid, 1, 0.02);
	}

	// generation 2
	$x = $lftmrg + $boxspacing;
	$xwid = $xwid + $leftindent - $boxspacing;
	drawIndInfo($ancestors[1][0], $x, $yvals[3][0] - ($lineheight / 2), $xwid, 0, 0.02);
	drawIndInfo($ancestors[1][1], $x, $yvals[3][1] - ($lineheight / 2), $xwid, 1, 0.02);

	//generation 1
	drawIndInfo($ancestors[0][0], $lftmrg, $yvals[2][0] - ($lineheight / 2), $xwid, 1, 0.02);
    }

}
function createBlankChart($gens, $topy) {
    global $pdf, $paperdim, $topmrg, $botmrg, $lftmrg, $rtmrg;
    global $lineheight, $rptFont, $rptFontSize, $text, $startnum;

    $lineheight = 0.1;

    $yval = array();
    if(!is_numeric($startnum) || $startnum < 1)
    	$startnum = 1;
    else
    	$startnum = floor($startnum);

    // set our font
    $pdf->SetFont($rptFont, '', $rptFontSize);
    $boxspacing = 0.15;
    $boxhalf = $boxspacing / 2;
    $fathboxheight = 0.8;
    $mothboxheight = 0.6;
    $mfhalf = ($mothboxheight + $fathboxheight) / 2;
    $mhalf = $mothboxheight / 2;
    $fhalf = $fathboxheight / 2;
	$abbrevs = array($text['capbirthabbr'], $text['capplaceabbr'], $text['capdeathabbr'], $text['capplaceabbr']);
    if ($gens <= 4) {
	$moretopmrg = 0.2;

	// some values that we'll need later
	$yarea = $paperdim['h'] - $botmrg - $topy - $moretopmrg;	// amount of y dimension we have to work with
	$xwid = ($paperdim['w'] - $lftmrg - $rtmrg - ($boxspacing * 3)) / 3;

	$spacer = ($yarea - (($fathboxheight + $mothboxheight + $boxspacing) * 4)) / 3;
	$x = $paperdim['w'] - $rtmrg - $xwid;
	$y = $topmrg + $moretopmrg;
	$pdf->SetXY($x, $y);
	// generation 4
	$y1 = drawHusbWifeCombo($xwid, $startnum + 7, $fathboxheight, $mothboxheight, $boxspacing, $boxspacing, $spacer);
	$yval[4][0] = $y1;
	$y2 = drawHusbWifeCombo($xwid, $startnum + 9, $fathboxheight, $mothboxheight, $boxspacing, $boxspacing, $spacer);
	$yval[4][1] = $y2;
	$y3 = drawHusbWifeCombo($xwid, $startnum + 11, $fathboxheight, $mothboxheight, $boxspacing, $boxspacing, $spacer);
	$yval[4][2] = $y3;
	$y4 = drawHusbWifeCombo($xwid, $startnum + 13, $fathboxheight, $mothboxheight, $boxspacing, $boxspacing, $spacer);
	$yval[4][3] = $y4;

	// generation 3
	$x -= $xwid + $boxspacing;
	$pdf->SetXY($x, $y1 - $fhalf);
	$y1 = drawHusbWifeCombo($xwid, $startnum + 3, $fathboxheight, $mothboxheight, $boxspacing, $y2 - $y1 - $mfhalf);
	$yval[3][0] = $y1;
	$pdf->SetXY($x, $y3 - $fhalf);
	$y2 = drawHusbWifeCombo($xwid, $startnum + 5, $fathboxheight, $mothboxheight, $boxspacing, $y4 - $y3 - $mfhalf);
	$yval[3][1] = $y2;

	//generation 2
	$x -= $xwid + $boxspacing;
	$pdf->SetXY($x, $y1 - $fhalf);
	$y = drawHusbWifeCombo($xwid, $startnum + 1, $fathboxheight, $mothboxheight, $boxspacing, $y2 - $y1 - $mfhalf, 0, 0);
	$yval[2][0] = $y;

	// generation 1
	$pdf->Line($x - $boxhalf, $y - $mhalf, $x - $boxhalf, $yval[3][0]);
	$pdf->Line($x - $boxhalf, $yval[3][0], $x, $yval[3][0]);

	$pdf->Line($x - $boxhalf, $y + ($mothboxheight / 2) + $lineheight, $x - $boxhalf, $yval[3][1]);
	$pdf->Line($x - $boxhalf, $yval[3][1], $x, $yval[3][1]);
	$x -= $boxspacing;
	drawBox($x, $y - $mhalf, $xwid, $mothboxheight + 0.1, $startnum, $abbrevs);
    }
    else if ($gens == 5) {
	$smallboxheight = 0.4;
	$leftindent = 0.5;
	$moretopmrg = 0.2;

	// some values that we'll need later
	$yarea = $paperdim['h'] - $botmrg - $topy - $moretopmrg;	// amount of y dimension we have to work with
	$xwid = ($paperdim['w'] - $lftmrg - $rtmrg - $leftindent - ($boxspacing * 2)) / 3;

	// generation 5
	$spacer = ($yarea - (($smallboxheight * 2 + $boxspacing) * 8)) / 7;
	$x = $paperdim['w'] - $rtmrg - $xwid;
	$y = $topmrg + $moretopmrg;
	$pdf->SetXY($x, $y);
	$y1 = drawHusbWifeCombo($xwid, $startnum + 15, $smallboxheight, $smallboxheight, $boxspacing, $boxspacing, $spacer, 1, 1);
	$yval[5][0] = $y1;
	$y2 = drawHusbWifeCombo($xwid, $startnum + 17, $smallboxheight, $smallboxheight, $boxspacing, $boxspacing, $spacer, 1, 1);
	$yval[5][1] = $y2;
	$y3 = drawHusbWifeCombo($xwid, $startnum + 19, $smallboxheight, $smallboxheight, $boxspacing, $boxspacing, $spacer, 1, 1);
	$yval[5][2] = $y3;
	$y4 = drawHusbWifeCombo($xwid, $startnum + 21, $smallboxheight, $smallboxheight, $boxspacing, $boxspacing, $spacer, 1, 1);
	$yval[5][3] = $y4;
	$y5 = drawHusbWifeCombo($xwid, $startnum + 23, $smallboxheight, $smallboxheight, $boxspacing, $boxspacing, $spacer, 1, 1);
	$yval[5][4] = $y5;
	$y6 = drawHusbWifeCombo($xwid, $startnum + 25, $smallboxheight, $smallboxheight, $boxspacing, $boxspacing, $spacer, 1, 1);
	$yval[5][5] = $y6;
	$y7 = drawHusbWifeCombo($xwid, $startnum + 27, $smallboxheight, $smallboxheight, $boxspacing, $boxspacing, $spacer, 1, 1);
	$yval[5][6] = $y7;
	$y8 = drawHusbWifeCombo($xwid, $startnum + 29, $smallboxheight, $smallboxheight, $boxspacing, $boxspacing, $spacer, 1, 1);
	$yval[5][7] = $y8;

	// generation 4
	$x -= $xwid + $boxspacing;
	$pdf->SetXY($x, $y1 - $fhalf);
	$y1 = drawHusbWifeCombo($xwid, $startnum + 7, $fathboxheight, $mothboxheight, $boxspacing, $y2 - $y1 - $mfhalf);
	$yval[4][0] = $y1;
	$pdf->SetXY($x, $y3 - $fhalf);
	$y2 = drawHusbWifeCombo($xwid, $startnum + 9, $fathboxheight, $mothboxheight, $boxspacing, $y4 - $y3 - $mfhalf);
	$yval[4][1] = $y2;
	$pdf->SetXY($x, $y5 - $fhalf);
	$y3 = drawHusbWifeCombo($xwid, $startnum + 11, $fathboxheight, $mothboxheight, $boxspacing, $y6 - $y5 - $mfhalf);
	$yval[4][2] = $y3;
	$pdf->SetXY($x, $y7 - $fhalf);
	$y4 = drawHusbWifeCombo($xwid, $startnum + 13, $fathboxheight, $mothboxheight, $boxspacing, $y8 - $y7 - $mfhalf);
	$yval[4][3] = $y4;

	// generation 3
	$x -= $xwid + $boxspacing;
	$pdf->SetXY($x, $y1 - $fhalf);
	$y1 = drawHusbWifeCombo($xwid, $startnum + 3, $fathboxheight, $mothboxheight, $boxspacing, $y2 - $y1 - $mfhalf, 0, 0);
	$yval[3][0] = $y1;
	$pdf->SetXY($x, $y3 - $fhalf);
	$y2 = drawHusbWifeCombo($xwid, $startnum + 5, $fathboxheight, $mothboxheight, $boxspacing, $y4 - $y3 - $mfhalf, 0, 0);
	$yval[3][1] = $y2;

	// generation 2
	$pdf->Line($x - $boxhalf, $y1 - $fhalf, $x - $boxhalf, $yval[4][0]);
	$pdf->Line($x - $boxhalf, $yval[4][0], $x, $yval[4][0]);

	$pdf->Line($x - $boxhalf, $y1 + $fhalf, $x - $boxhalf, $yval[4][1]);
	$pdf->Line($x - $boxhalf, $yval[4][1], $x, $yval[4][1]);

	$pdf->Line($x - $boxhalf, $y2 - $mhalf, $x - $boxhalf, $yval[4][2]);
	$pdf->Line($x - $boxhalf, $yval[4][2], $x, $yval[4][2]);

	$pdf->Line($x - $boxhalf, $y2 + $mhalf, $x - $boxhalf, $yval[4][3]);
	$pdf->Line($x - $boxhalf, $yval[4][3], $x, $yval[4][3]);
	$x = $lftmrg + $boxspacing;
	$xwid = $xwid + $leftindent - $boxspacing;
	$pdf->SetXY($x, $y1 - ($fathboxheight / 2));
	$y = drawHusbWifeCombo($xwid, $startnum + 1, $fathboxheight, $mothboxheight, $boxspacing, $y2 - $y1 - $mfhalf, 0, 0);
	$yval[2][0] = $y;

	//generation 1
	$pdf->Line($x - $boxhalf, $y - $mhalf, $x - ($boxspacing / 2), $yval[3][0]);
	$pdf->Line($x - $boxhalf, $yval[3][0], $x, $yval[3][0]);

	$pdf->Line($x - $boxhalf, $y + $mhalf + $lineheight, $x - $boxhalf, $yval[3][1]);
	$pdf->Line($x - $boxhalf, $yval[3][1], $x, $yval[3][1]);
	drawBox($lftmrg, $y - $mhalf, $xwid, $mothboxheight + 0.1, $startnum, $abbrevs);
    }
    else if ($gens == 6) {
	$gen6sp = 0.1;
	$smallboxheight = 0.2;
	$midboxheight = 0.4;
	$leftindent = 0.5;
	$moretopmrg = 0.2;

	// some values that we'll need later
	$yarea = $paperdim['h'] - $botmrg - $topy - $moretopmrg;	// amount of y dimension we have to work with
	$xwid = ($paperdim['w'] - $lftmrg - $rtmrg - $leftindent - ($boxspacing * 3)) / 4;

	// generation 6
	$spacer = ($yarea - (($smallboxheight * 2 + $gen6sp) * 16)) / 15;
	$x = $paperdim['w'] - $rtmrg - $xwid;
	$y = $topmrg + $moretopmrg;
	$pdf->SetXY($x, $y);
	$y1 = drawHusbWifeCombo($xwid, $startnum + 31, $smallboxheight, $smallboxheight, $boxspacing, $gen6sp, $spacer, 1, 2, 1);
	$yval[6][0] = $y1;
	$y2 = drawHusbWifeCombo($xwid, $startnum + 33, $smallboxheight, $smallboxheight, $boxspacing, $gen6sp, $spacer, 1, 2, 1);
	$yval[6][1] = $y2;
	$y3 = drawHusbWifeCombo($xwid, $startnum + 35, $smallboxheight, $smallboxheight, $boxspacing, $gen6sp, $spacer, 1, 2, 1);
	$yval[6][2] = $y3;
	$y4 = drawHusbWifeCombo($xwid, $startnum + 37, $smallboxheight, $smallboxheight, $boxspacing, $gen6sp, $spacer, 1, 2, 1);
	$yval[6][3] = $y4;
	$y5 = drawHusbWifeCombo($xwid, $startnum + 39, $smallboxheight, $smallboxheight, $boxspacing, $gen6sp, $spacer, 1, 2, 1);
	$yval[6][4] = $y5;
	$y6 = drawHusbWifeCombo($xwid, $startnum + 41, $smallboxheight, $smallboxheight, $boxspacing, $gen6sp, $spacer, 1, 2, 1);
	$yval[6][5] = $y6;
	$y7 = drawHusbWifeCombo($xwid, $startnum + 43, $smallboxheight, $smallboxheight, $boxspacing, $gen6sp, $spacer, 1, 2, 1);
	$yval[6][6] = $y7;
	$y8 = drawHusbWifeCombo($xwid, $startnum + 45, $smallboxheight, $smallboxheight, $boxspacing, $gen6sp, $spacer, 1, 2, 1);
	$yval[6][7] = $y8;
	$y9 = drawHusbWifeCombo($xwid, $startnum + 47, $smallboxheight, $smallboxheight, $boxspacing, $gen6sp, $spacer, 1, 2, 1);
	$yval[6][8] = $y9;
	$y10 = drawHusbWifeCombo($xwid, $startnum + 49, $smallboxheight, $smallboxheight, $boxspacing, $gen6sp, $spacer, 1, 2, 1);
	$yval[6][9] = $y10;
	$y11 = drawHusbWifeCombo($xwid, $startnum + 51, $smallboxheight, $smallboxheight, $boxspacing, $gen6sp, $spacer, 1, 2, 1);
	$yval[6][10] = $y11;
	$y12 = drawHusbWifeCombo($xwid, $startnum + 53, $smallboxheight, $smallboxheight, $boxspacing, $gen6sp, $spacer, 1, 2, 1);
	$yval[6][11] = $y12;
	$y13 = drawHusbWifeCombo($xwid, $startnum + 55, $smallboxheight, $smallboxheight, $boxspacing, $gen6sp, $spacer, 1, 2, 1);
	$yval[6][12] = $y13;
	$y14 = drawHusbWifeCombo($xwid, $startnum + 57, $smallboxheight, $smallboxheight, $boxspacing, $gen6sp, $spacer, 1, 2, 1);
	$yval[6][13] = $y14;
	$y15 = drawHusbWifeCombo($xwid, $startnum + 59, $smallboxheight, $smallboxheight, $boxspacing, $gen6sp, $spacer, 1, 2, 1);
	$yval[6][14] = $y15;
	$y16 = drawHusbWifeCombo($xwid, $startnum + 61, $smallboxheight, $smallboxheight, $boxspacing, $gen6sp, $spacer, 1, 2, 1);
	$yval[6][15] = $y16;

	// generation 5
	$x -= $xwid + $boxspacing;
	$pdf->SetXY($x, $y1);
	$y1 = drawHusbWifeCombo($xwid, $startnum + 15, $midboxheight, $midboxheight, $boxspacing, $y2 - $y1 - $midboxheight, 0, 1, 1, 1);
	$yval[5][0] = $y1;
	$pdf->SetXY($x, $y3);
	$y2 = drawHusbWifeCombo($xwid, $startnum + 17, $midboxheight, $midboxheight, $boxspacing, $y4 - $y3 - $midboxheight, 0, 1, 1, 1);
	$yval[5][1] = $y2;
	$pdf->SetXY($x, $y5);
	$y3 = drawHusbWifeCombo($xwid, $startnum + 19, $midboxheight, $midboxheight, $boxspacing, $y6 - $y5 - $midboxheight, 0, 1, 1, 1);
	$yval[5][2] = $y3;
	$pdf->SetXY($x, $y7);
	$y4 = drawHusbWifeCombo($xwid, $startnum + 21, $midboxheight, $midboxheight, $boxspacing, $y8 - $y7 - $midboxheight, 0, 1, 1, 1);
	$yval[5][3] = $y4;
	$pdf->SetXY($x, $y9);
	$y5 = drawHusbWifeCombo($xwid, $startnum + 23, $midboxheight, $midboxheight, $boxspacing, $y10 - $y9 - $midboxheight, 0, 1, 1, 1);
	$yval[5][4] = $y5;
	$pdf->SetXY($x, $y11);
	$y6 = drawHusbWifeCombo($xwid, $startnum + 25, $midboxheight, $midboxheight, $boxspacing, $y12 - $y11 - $midboxheight, 0, 1, 1, 1);
	$yval[5][5] = $y6;
	$pdf->SetXY($x, $y13);
	$y7 = drawHusbWifeCombo($xwid, $startnum + 27, $midboxheight, $midboxheight, $boxspacing, $y14 - $y13 - $midboxheight, 0, 1, 1, 1);
	$yval[5][6] = $y7;
	$pdf->SetXY($x, $y15);
	$y8 = drawHusbWifeCombo($xwid, $startnum + 29, $midboxheight, $midboxheight, $boxspacing, $y16 - $y15 - $midboxheight, 0, 1, 1, 1);
	$yval[5][7] = $y8;

	// generation 4
	$x -= $xwid + $boxspacing;
	$pdf->SetXY($x, $y1);
	$y1 = drawHusbWifeCombo($xwid, $startnum + 7, $fathboxheight, $mothboxheight, $boxspacing, $y2 - $y1 - (($mothboxheight + $fathboxheight) / 2) - $lineheight, 0, 1, 0, 1);
	$yval[4][0] = $y1;
	$pdf->SetXY($x, $y3);
	$y2 = drawHusbWifeCombo($xwid, $startnum + 9, $fathboxheight, $mothboxheight, $boxspacing, $y4 - $y3 - (($mothboxheight + $fathboxheight) / 2) - $lineheight, 0, 1, 0, 1);
	$yval[4][1] = $y2;
	$pdf->SetXY($x, $y5);
	$y3 = drawHusbWifeCombo($xwid, $startnum + 11, $fathboxheight, $mothboxheight, $boxspacing, $y6 - $y5 - (($mothboxheight + $fathboxheight) / 2) - $lineheight, 0, 1, 0, 1);
	$yval[4][2] = $y3;
	$pdf->SetXY($x, $y7);
	$y4 = drawHusbWifeCombo($xwid, $startnum + 13, $fathboxheight, $mothboxheight, $boxspacing, $y8 - $y7 - (($mothboxheight + $fathboxheight) / 2) - $lineheight, 0, 1, 0, 1);
	$yval[4][3] = $y4;

	// generation 3
	$x -= $xwid + $boxspacing;
	$pdf->SetXY($x, $y1);
	$y1 = drawHusbWifeCombo($xwid, $startnum + 3, $fathboxheight, $mothboxheight, $boxspacing, $y2 - $y1 - (($mothboxheight + $fathboxheight) / 2) - $lineheight, 0, 0, 0, 1);
	$yval[3][0] = $y1;
	$pdf->SetXY($x, $y3);
	$y2 = drawHusbWifeCombo($xwid, $startnum + 5, $fathboxheight, $mothboxheight, $boxspacing, $y4 - $y3 - (($mothboxheight + $fathboxheight) / 2) - $lineheight, 0, 0, 0, 1);
	$yval[3][1] = $y2;

	// generation 2
	$pdf->Line($x, $y1 - ($lineheight / 2), $x, $yval[4][0] + $lineheight);
	$pdf->Line($x, $y1 + $fathboxheight - ($lineheight / 2), $x, $yval[4][1] + $lineheight);
	$pdf->Line($x, $y2 - ($lineheight / 2), $x, $yval[4][2] + $lineheight);
	$pdf->Line($x, $y2 + $mothboxheight - ($lineheight / 2), $x, $yval[4][3] + $lineheight);
	$x = $lftmrg + $boxspacing;
	$xwid = $xwid + $leftindent - $boxspacing;
	$pdf->SetXY($x, $y1);
	$y = drawHusbWifeCombo($xwid, $startnum + 1, $fathboxheight, $mothboxheight, $boxspacing, $y2 - $y1 - (($mothboxheight + $fathboxheight) / 2) - $lineheight, 0, 0, 0, 1);
	$yval[2][0] = $y;

	//generation 1
	$pdf->Line($x, $y - ($lineheight / 2), $x, $yval[3][0] + $lineheight);
	$pdf->Line($x, $y + $mothboxheight + ($lineheight / 2), $x, $yval[3][1] + $lineheight);
	drawBoxLine($lftmrg, $y, $xwid, $startnum, $abbrevs);
    }
    return $yval;
}

function drawBox($x, $y, $w, $h, $num, $list) {
    global $pdf, $lineheight;
    $textin = 0.02;

    $boxtop = $y;
	$pdf->RoundedRect($x, $boxtop, $w, $h, .1, '1234', '');
    $pdf->SetXY($x + $textin, $boxtop + ($lineheight / 2));
    $pdf->Cell(0, $lineheight, "$num", 0, 1, 'L');
    foreach ($list as $letter) {
	$pdf->SetX($x + $textin);
	$pdf->Cell(0, $lineheight, $letter . ":", 0, 1, 'L');
    }
}

function drawBoxLine($x, $y, $w, $num, $list) {
    global $pdf, $lineheight;
    $textin = 0.02;

    $pdf->Line($x, $y + $lineheight, $x + $w, $y + $lineheight);
    $pdf->SetXY($x + $textin, $y);
    $pdf->Cell(0, $lineheight+0.02, "$num", 0, 1, 'L');
    foreach ($list as $letter) {
	$pdf->SetX($x + $textin);
	$pdf->Cell(0, $lineheight, $letter . ":", 0, 1, 'L');
    }
    return ($y + $lineheight);
}

// returns the location of the horizontal line for prev gen
function drawHusbWifeCombo($w, $num, $fh, $mh, $hsp, $vsp, $endspace = 0, $drawlines = 1, $listmode = 0, $boxmode = 0) {
    global $pdf, $lineheight, $text;

    // set the coords
    $x = $pdf->GetX();
    $y = $pdf->GetY();

    // what characters are we going to display?
    if ($listmode == 0) {
	$charlisth = array($text['capbirthabbr'], $text['capplaceabbr'], $text['capmarrabbr'], $text['capplaceabbr'], $text['capdeathabbr'], $text['capplaceabbr']);
	$charlistw = array($text['capbirthabbr'], $text['capplaceabbr'], $text['capdeathabbr'], $text['capplaceabbr']);
    }
    else if ($listmode == 1) {
	$charlisth = array($text['capbirthabbr'], $text['capdeathabbr']);
	$charlistw = array($text['capbirthabbr'], $text['capdeathabbr']);
    }
    else if ($listmode == 2) {
	$charlisth = array($text['capbirthabbr']);
	$charlistw = array($text['capbirthabbr']);
    }

    // how are we drawing boxes?
    if ($boxmode == 0) {
	drawBox($x, $y, $w, $fh, $num, $charlisth);
	$y1 = $y + ($fh / 2);										// save the location of the first horiz line
    }
    else if ($boxmode == 1) {
	$y1 = drawBoxLine($x, $y, $w, $num, $charlisth);
    }

    if ($drawlines) { $pdf->Line($x - ($hsp / 2), $y1, $x, $y1); }					// put a short line in the middle of the box
    $ytmp = $y + ($fh / 2);
    $y += $fh + $vsp;
    if ($boxmode == 0) {
	drawBox($x, $y, $w, $mh, $num + 1, $charlistw);
	$y2 = $y + ($mh / 2);
    }
    else if ($boxmode == 1) {
	$y2 = drawBoxLine($x, $y, $w, $num + 1, $charlistw);
    }
    if ($drawlines) { $pdf->Line($x - ($hsp / 2), $y2, $x, $y2); }					// put a short line in the middle of the box
    if ($drawlines) { $pdf->Line($x - ($hsp / 2), $y1, $x - ($hsp / 2), $y2); }				// draw the vertical line between them
    if ($drawlines) { $pdf->Line($x - $hsp, ($y1 + $y2) / 2, $x - ($hsp / 2), ($y1 + $y2) / 2); }	// put a short line which will hook to the prev gen
    $y += $mh + $endspace;
    $pdf->SetY($y);
    $pdf->SetX($x);

    if ($boxmode == 0) {
	return (($y1 + $y2) / 2);
    }
    else {
	return ((($y1 + $y2) / 2) - $lineheight);
    }
}

?>