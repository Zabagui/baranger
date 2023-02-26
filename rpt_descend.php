<?php
// PDF Descendancy Report
// Author:  Bret Rumsey
// Thanks to J. Kraber for his original implementation of this report.
//
$textpart = "pedigree";
include("tng_begin.php");
$tngprint = 1;

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
$lineheight = $pdf->GetFontSize($rptFont, $rptFontSize) + 0.1;
//$dxgen = 0.25;	// distance between each generation number (e.g. from 1. to 2. above)
$dxtabln = 0.08; // distance from Name to vertical line (e.g. from Patriarch to | above)
$dy = $pdf->GetFontSize($rptFont, $rptFontSize) + 0.08;	// line height (note: try to have line height so a specific number of whole lines fits on page
$hangind = 0.125;    // how much to indent lines when more than one is needed

$result = getPersonData($tree, $personID);
if ($result) {
    $row = tng_fetch_assoc( $result );
	$righttree = checktree($tree);
	$rights = determineLivingPrivateRights($row, $righttree);
	$row['allow_living'] = $rights['living'];
	$row['allow_private'] = $rights['private'];
    $namestr = getName( $row );
}

$infoDescend[0]['gen'] = 1;
$infoDescend[0]['name'] = $namestr;
$infoDescend[0]['vitals'] = getVitalDates($row);
$infoDescend[0]['children'] = -1;
if ($numbering == 0) 
    $infoDescend[0]['number'] = '';
else if ($numbering == 4) 
    $infoDescend[0]['number'] = 'a';
else {
    if(!is_numeric($startnum) || $startnum < 1)
    	$startnum = 1;
    else
    	$startnum = floor($startnum);
    $infoDescend[0]['number'] = $startnum;
}

// build the descendants
if ($genperpage > 1)
    getIndividual($personID, $row['sex'], 2, $personID, $infoDescend[0]['number']);
$personcount = count($infoDescend);
$paperdim = $pdf->GetPageSize();

// set the document title
$title = $text['descendfor'] . ' '.$infoDescend[0]['name'];
$pdf->SetTitle($title, $uni);
$titleConfig = array(	'title' => $title,
			'image' => getPdfSmallPhoto($personID, $rights['living'] && $rights['private'], $row['sex']),
			'font' => $rptFont,
			'fontSize' => $hdrFontSize,
			'justification' => 'L',
			'lMargin' => $lftmrg,
			'skipFirst' => false,
			'header' => false,
			'line' => true);
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
$pdf->SetAutoPageBreak(0, $botmrg+$pdf->GetFooterHeight()+$lineheight); // set page break to manual (this is for drawing lines from page to page)
$footerheight = $pdf->GetFooterHeight();

// PDF settings
$pdf->SetAuthor($dbowner);

// let's set started
$pdf->AddPage();

// set our reporting font
$pdf->SetFont($rptFont,'',$rptFontSize);

// start looping through each individual on chart
for ($i = 0; $i < $personcount; $i++) {

    // calculate the x and y of our current individual
    $x = $lftmrg + ($infoDescend[$i]['gen'] - 1) * $lineheight;
    $y = $pdf->GetY();

    // check if at end of page
    if ($y > $paperdim['h'] - $botmrg - $footerheight - $lineheight) {

	// continue lines at the bottom of the page
	for ($j = 1; $j <= $genperpage; $j++) {
	    if (isset($genchld[$j]) && $genchld[$j] > 0) {
		$xln = $lftmrg + ($j - 1) * $lineheight + $dxtabln;
		$pdf->Line($xln, $y, $xln, $geny[$j] + $dy);

	    }
	    // reset the y position to be the top of the page
	    $geny[$j] = $topmrg + 0.1;
	}

	// create new page
	$pdf->AddPage();
	$y = $pdf->GetY();
    }

    // print main individual info
    if ($infoDescend[$i]['children'] == -1) {
	$namestring = $infoDescend[$i]['name'].' '.$infoDescend[$i]['vitals'];
	$pdf->SetX($x);
	$sep = '-';
	if ($numbering == 0) { $sep = ''; }
    	$pdf->MultiCell(0, $dy, $infoDescend[$i]['number'].$sep.$namestring, 0, 'L', 0, $hangind);

    // print spouse info
    } else {
	$namestring = '+'.$infoDescend[$i]['name'].' '.$infoDescend[$i]['vitals'];
    	$pdf->SetX($x);
	$geny[$infoDescend[$i]['gen']] = $pdf->GetY();
    	$pdf->MultiCell(0, $dy, $namestring, 0, 'L', 0, $hangind);
	$genchld[$infoDescend[$i]['gen']] = $infoDescend[$i]['children'];
    }

    // draw chart lines
    if ($infoDescend[$i]['children'] == -1) {
	// child -- horizonatal line
	if ($i <> 0) {
	    $genchld[$infoDescend[$i]['gen']-1] -= 1;
	    $pdf->Line($x - ($lineheight - $dxtabln), $y + $dy / 2, $x, $y + $dy / 2);
	    $pdf->Line($x - ($lineheight - $dxtabln), $y + $dy / 2, $x - ($lineheight - $dxtabln), $geny[$infoDescend[$i]['gen']-1] + $dy);
	}
    }
}

// write the document out
$pdf->Output();

// END PDF REPORT

function getIndividual($key, $sex, $level, $trail, $num) {
    global $j, $infoDescend, $numbering;
    global $tree, $genperpage, $text, $cms;
    global $families_table, $people_table, $children_table, $trees_table;
    global $numgen, $startnum, $righttree;

    if (is_null($j)) {
	$j = 1;
    }

    if( $sex == 'M' ) {
	$self = 'husband';
	$spouse = 'wife';
	$spouseorder = 'husborder';
    } else {
	$self = 'wife';
	$spouse = 'husband';
	$spouseorder = 'wifeorder';
    }

    $result = getSpouseFamilyMinimal($tree, $self, $key, $spouseorder);
    if ($result) {
	while ($row = tng_fetch_assoc($result)) {
	    $spousestr = $vitalinfo = "";
	    if ($row[$spouse]) {
		$spouseresult = getPersonData($tree, $row[$spouse]);
		if ($spouseresult) {
		    $spouserow = tng_fetch_assoc( $spouseresult );

			$srights = determineLivingPrivateRights($spouserow, $righttree);
			$spouserow['allow_living'] = $srights['living'];
			$spouserow['allow_private'] = $srights['private'];

		    $spousename = getName($spouserow);
		    $vitalinfo = getVitalDates($spouserow);
		    $spousestr = "&nbsp; $spousename &nbsp; $vitalinfo";
		    $infoDescend[$j]['name'] = $spousename;
		}
	    }
	    else {
		$infoDescend[$j]['name'] = $text['unknown'];
	    }
	    $infoDescend[$j]['gen'] = $level-1;
	    if ($numbering == 0) {
		$infoDescend[$j]['number'] = '';
	    } else if ($numbering == 1) {
		$infoDescend[$j]['number'] = $level-1;
	    } else if ($numbering == 2) {
		$henrynum = $num;
		if ($henrynum == 10) {
		    $henrynum = 'X';
		}
		else if ($henrynum > 10) {
		    $henrynum = chr($henrynum+55);
		}
		$infoDescend[$j]['number'] = $henrynum;
	    } else if ($numbering == 3) {
		$infoDescend[$j]['number'] = $num;
	    } else if ($numbering == 4) {
		$infoDescend[$j]['number'] = $num;
	    }
	    $infoDescend[$j]['vitals'] = $vitalinfo;

	    $result2 = getChildrenData($tree, $row['familyID']);
	    $numkids = tng_num_rows($result2);
	    if ($numkids) {
		// Note: need to also determine index of last child for the purpose of drawing a veritical line
		$k = $j; // remember index of spouse to later save index of last child
		$j++;
		$n = 1; // child number
		while( $crow = tng_fetch_assoc( $result2 ) ) {
		    $newtrail = "$trail,{$row['familyID']},{$crow['personID']}";

			$crights = determineLivingPrivateRights($crow, $righttree);
			$crow['allow_living'] = $crights['living'];
			$crow['allow_private'] = $crights['private'];

		    $childname = getName($crow);
		    $vitalinfo = getVitalDates($crow);
		    $infoDescend[$j]['gen'] = $level;
		    if ($numbering == 0) {
			$infoDescend[$j]['number'] = '';
		    } else if ($numbering == 1) {
			$infoDescend[$j]['number'] = $level + $startnum - 1;
		    } else if ($numbering == 2) {
			$henrynum = $num;
			if ($henrynum == 10) {
			    $henrynum = 'X';
			}
			else if ($henrynum > 10) {
			    $henrynum = chr($henrynum+55);
			}
			$infoDescend[$j]['number'] = $henrynum . $n;
		    } else if ($numbering == 3) {
				$infoDescend[$j]['number'] = $num . "." . $n;
		    } else if ($numbering == 4) {
				$infoDescend[$j]['number'] = $num . "." . chr(96+$level) . $n;
		    }
		    $infoDescend[$j]['name'] = $childname;
		    $infoDescend[$j]['vitals'] = $vitalinfo;
		    $infoDescend[$j]['children'] = -1;
		    $infoDescend[$j]['prnt'] = $k;
		    if ($n == $numkids) {
			$lastchildindex = $j;
		    } else {
			$n++;
		    }
		    $j++;

		    // keep track of highest number of generations for report (using $level on gives generation of last person)
		    if ($numgen < $level) {
			$numgen = $level;
		    }
		    if ($level < $genperpage) {
			getIndividual($crow['personID'], $crow['sex'], $level+1, $newtrail, $infoDescend[$j-1]['number']);
		    }	
		}
		$infoDescend[$k]['children'] = $numkids;
	    } else {
		$infoDescend[$j]['children'] = 0;
		$j++;
	    }
	    tng_free_result($result2);
	}
    }
    // if there is no spouse listed, it's unknown
    else {
	$infoDescend[$j]['name'] = $text['unknown'];
    }
    tng_free_result($result);
}

function getVitalDates($row) {
    global $getPlace, $text;

	if($getPlace == 2) return;
    $vitalinfo = "";
    if ($row['allow_living'] && $row['allow_private']) {
		if($row['birthdate']) {
		    $vitalinfo .= $text['birthabbr'] . ' '.displayDate($row['birthdate']).', ';
		    if ($row['birthplace']) {
				$vitalinfo .= $row['birthplace'].', ';
		    }
		}
		if((!$row['birthdate'] || $getPlace == 3) && $row['altbirthdate']) {
			$vitalinfo .= $text['chrabbr'] . ' '.displayDate($row['altbirthdate']).', ';
			if ($row['altbirthplace']) {
			    $vitalinfo .= $row['altbirthplace'].', ';
			}
		}

		if ($row['deathdate']) {
		    $vitalinfo .= $text['deathabbr'] . ' '.displayDate($row['deathdate']).', ';
		    if ($row['deathplace']) {
				$vitalinfo .= $row['deathplace'].', ';
		    }
		}
		if((!$row['deathdate'] || $getPlace == 3) && $row['burialdate'] ) {
			$vitalinfo .= $text['burialabbr'] . ' '.displayDate($row['burialdate']).', ';
			if ($row['burialplace']) {
			    $vitalinfo .= $row['burialplace'];
			}
		}
   }

    // get rid of trailing commas
    if(substr($vitalinfo,-2) == ", ") {
		$vitalinfo = substr_replace($vitalinfo, '', -2, 2);
    }
    return $vitalinfo;
}

?>
