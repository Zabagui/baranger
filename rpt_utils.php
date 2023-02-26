<?php
//
// Common functions to help out with PDF report generation
//
// generateDates
function generateDates($ind) {
    if ($ind['allow_living'] && $ind['allow_private']) {
    	if($ind['birthdate'])
    		$bdate = displayDate($ind['birthdate']);
    	elseif($ind['altbirthdate'])
    		$bdate = displayDate($ind['altbirthdate']);
    	else
    		$bdate = '    ';
    	if($ind['deathdate'])
    		$ddate = displayDate($ind['deathdate']);
    	elseif($ind['burialdate'])
    		$ddate = displayDate($ind['burialdate']);
    	else
    		$ddate = '    ';
		$result = "($bdate - $ddate)";
    } else {
		$result = '';
    }
    return $result;
}

// generateYears
function generateYears($ind) {
    if ($ind['allow_living'] && $ind['allow_private']) {
		if (!$ind['birth']) { $byear = '     '; } else { $byear = $ind['birth']; }
		if (!$ind['death']) { $dyear = '     '; } else { $dyear = $ind['death']; }
		// TODO need to print out differently if we have text in the date field (like bef, bet, aft. etc).
		if ($byear == '     ' && $dyear == '     ')
		    $result = '';
		else
		    $result = " ($byear - $dyear)";
    }
    else {
	$result = '';
    }
    return $result;
}

function getPdfSmallPhoto($persfamID, $rights, $gender = "") {
	global $rootpath, $photopath, $mediapath, $mediatypes_assoc;
	global $photosext, $tree, $medialinks_table, $media_table, $cms, $tngconfig, $allow_private;

	$query = "SELECT $media_table.mediaID, medialinkID, alwayson, private, mediatypeID, usecollfolder, thumbpath, usecollfolder FROM ($media_table, $medialinks_table)
		WHERE personID = \"$persfamID\" AND $medialinks_table.gedcom = \"$tree\" AND $media_table.mediaID = $medialinks_table.mediaID AND defphoto = '1'";
	$result = tng_query($query);
	$row = tng_fetch_assoc( $result );

	$photocheck = $photoref = "";
	if(!empty($row['thumbpath'])) {
		if( $row['alwayson'] || (($rights || checkLivingLinks($row['mediaID'])) && (!$row['private'] || $allow_private))) {
			$mediatypeID = $row['mediatypeID'];
			$usefolder = $row['usecollfolder'] ? $mediatypes_assoc[$mediatypeID] : $mediapath;
			$photocheck = "$usefolder/" . $row['thumbpath'];
			$photoref = "$usefolder/" . str_replace("%2F","/",rawurlencode( $row['thumbpath'] ));
		}
	}
	elseif($rights) {
		$photoref = $photocheck = $tree ? "$photopath/$tree.$persfamID.$photosext" : "$photopath/$persfamID.$photosext";
		$prefix = $suffix = "";
	}

	$gotfile = $photocheck ? file_exists( "$rootpath$photocheck" ) : false;
	if(!$gotfile) {
		$photoref = "";
		if( $gender && $tngconfig['usedefthumbs'] ) {
			if($gender == "M") {
				$photocheck = "img/male.jpg";
			}
			elseif ($gender == "F") {
				$photocheck = "img/female.jpg";
			}
			$photoref = $cms['tngpath'] . $photocheck;
			if(!file_exists( $photoref ))
				$photoref = "";
		}
	}
	tng_free_result( $result );

	return $photoref;
}

function numberToRoman($num) {
     $n = intval($num);
     $result = '';
 
     // Declare a lookup array that we will use to traverse the number:
     $lookup = array('m' => 1000, 'cm' => 900, 'd' => 500, 'cd' => 400,
     'c' => 100, 'xc' => 90, 'l' => 50, 'xl' => 40,
     'x' => 10, 'ix' => 9, 'v' => 5, 'iv' => 4, 'i' => 1);
 
     foreach ($lookup as $roman => $value) {
         $matches = intval($n / $value);
         $result .= str_repeat($roman, $matches);
         $n = $n % $value;
     }
 
     return $result;
}

function numberToText($num) {

    $lookup = array(1 => 'first', 2 => 'second', 3 => 'third', 4 => 'fourth', 
	5 => 'fifth', 6 => 'sixth', 7 => 'seventh', 8 => 'eighth', 
	9 => 'ninth', 10 => 'tenth', 11 => 'eleventh', 12 => 'twelfth', 
	13 => 'thirteenth', 14 => 'fourteenth', 15 => 'fifteenth', 
	16 => 'sixteenth', 17 => 'seventeenth', 18 => 'eighteenth', 
	19 => 'ninetenth', 20 => 'twentieth', 30 => 'thirtieth', 
	40 => 'fortieth', 50 => 'fiftieth', 60 => 'sixtieth');
    $name = array(20 => 'twenty', 30 => 'thirty', 40 => 'forty', 
	50 => 'fifty', 60 => 'sixty');

    if ($num >= 1 && $num <= 20) 
	return $lookup[$num];
    else {
	$q = intval($num / 10);
	$r = $num % 10;
	if ($r == 0) 
	    return $name[$q];
	else
	    return $name[$q].'-'.$lookup[$r];
    }
}

function genToRelationship($gen) {
    $lookup = array(1 => '', 2 => 'Parents', 3 => 'Grandparents', 4 => 'Great Grandparents');

    if ($gen == 1) 
	return '';
    elseif ($gen >= 2 && $gen <= 4) 
	return(' ('.$lookup[$gen].')');
}

// titleLine
function titleLine($label1) {
    global $pdf, $paperdim, $lftmrg, $rtmrg, $lineheight;
    global $rptFont, $lblFontSize;

    $pdf->SetFont($rptFont, "B", $lblFontSize);
    $pdf->Cell($paperdim['w'] - $lftmrg - $rtmrg, $lineheight, $label1, 1, 1, 'L', 1);
}

function pageBox($thisy = -1) {
    global $pdf, $lftmrg, $paperdim, $rtmrg, $botmrg, $y;

    if ($thisy == -1)
	$thisy = $pdf->GetY();
    $oldy = $y;
    $pdf->Rect($lftmrg, $thisy, $paperdim['w'] - $lftmrg - $rtmrg, $paperdim['h']-$botmrg-$thisy-$pdf->GetFooterHeight()-0.15);
    $y = $oldy;
}

function getMaxStringWidth($strings, $font, $style, $size, $append='', $oldmax=0) {
    global $pdf;

    $max = $oldmax;
    $pdf->SetFont($font, $style, $size);
    foreach($strings as $string) {
	$width = $pdf->GetStringWidth($string.$append);
	if ($width > $max)
	    $max = $width;
    }
    return $max;
}

function getMyAncestors($focalPerson, $tree, $gen) {
    global $children_table, $people_table, $families_table, $righttree;

    $ancestorInfo = array();

    //     ind --------+
    //     gen -----+  |
    //              |  |
    $ancestorInfo[0][0]['personID'] = $focalPerson; //This is an array of $personID's; dim: (gen+1,2^gen).

    // build the array of ancestors
    for ($i = 0; $i < $gen; $i++) {
	for ($j = 0; $j < pow(2,$i); $j++) {

	    if(!empty($ancestorInfo[$i][$j]['personID']) && $ancestorInfo[$i][$j]['personID'] != 'X') {
		// find the family for this person
		$personID = $ancestorInfo[$i][$j]['personID'];
		$result = getChildFamily($tree, $personID, "parentorder");
		$row = tng_fetch_assoc($result);
		if(!empty($row)) {
		    $familyID = $row['familyID'];
		    tng_free_result($result);

		    // query husband (the father of the person in question)
		    $result = getParentData($tree, $familyID, "husband");
			$row = tng_fetch_assoc($result);
			if($row) {

				$rights = determineLivingPrivateRights($row, $righttree);
				$row['allow_living'] = $rights['living'];
				$row['allow_private'] = $rights['private'];

				tng_free_result($result);
				if (empty($row['personID']))
				    $ancestorInfo[$i+1][2*$j]['personID'] = 'X';
				else {
					if(!$rights['both']) {
						$row['birthdate'] = $row['birthplace'] = $row['altbirthdate'] = $row['altbirthplace'] = $row['deathdate'] = $row['deathplace'] = $row['burialdate'] = $row['burialplace'] = $row['marrdate'] = $row['marrplace'] = "";
					}
					else {
						$row['birthdate'] = displayDate($row['birthdate']);
						$row['altbirthdate'] = displayDate($row['altbirthdate']);
						$row['deathdate'] = displayDate($row['deathdate']);
						$row['burialdate'] = displayDate($row['burialdate']);
						$row['marrdate'] = displayDate($row['marrdate']);
					}
				    $ancestorInfo[$i+1][2*$j] = $row;
				}
		    }
		    else
				$ancestorInfo[$i+1][2*$j]['personID'] = 'X';

		    // query wife (the mother of the person in question)
		    $result = getParentData($tree, $familyID, "wife");
			$row = tng_fetch_assoc($result);
			if($row) {

				$rights = determineLivingPrivateRights($row, $righttree);
				$row['allow_living'] = $rights['living'];
				$row['allow_private'] = $rights['private'];

				tng_free_result($result);
				if (empty($row['personID']))
				    $ancestorInfo[$i+1][2*$j+1]['personID'] = 'X';
				else {
					if(!$rights['both']) {
						$row['birthdate'] = $row['birthplace'] = $row['altbirthdate'] = $row['altbirthplace'] = $row['deathdate'] = $row['deathplace'] = $row['burialdate'] = $row['burialplace'] = $row['marrdate'] = $row['marrplace'] = "";
					}
					else {
						$row['birthdate'] = displayDate($row['birthdate']);
						$row['altbirthdate'] = displayDate($row['altbirthdate']);
						$row['deathdate'] = displayDate($row['deathdate']);
						$row['burialdate'] = displayDate($row['burialdate']);
					}
				    $ancestorInfo[$i+1][2*$j+1] = $row;
				}
		    }
		    else 
				$ancestorInfo[$i+1][2*$j+1]['personID'] = 'X';
		}
		else {
			$ancestorInfo[$i+1][2*$j]['personID'] = "";
			$ancestorInfo[$i+1][2*$j+1]['personID'] = "";
		}
		}
		else {
			$ancestorInfo[$i+1][2*$j]['personID'] = "";
			$ancestorInfo[$i+1][2*$j+1]['personID'] = "";
		}
	}
    }

    // QUERY FOCAL PERSON
    $result = getPersonData($tree, $focalPerson);
    if ($result) {
		$row =  tng_fetch_assoc($result);

		$rights = determineLivingPrivateRights($row, $righttree);
		$row['allow_living'] = $rights['living'];
		$row['allow_private'] = $rights['private'];

		tng_free_result($result);
		if(!$rights['both']) {
			$row['birthdate'] = $row['birthplace'] = $row['altbirthdate'] = $row['altbirthplace'] = $row['deathdate'] = $row['deathplace'] = $row['burialdate'] = $row['burialplace'] = $row['marrdate'] = $row['marrplace'] = "";
		}
		else {
			$row['birthdate'] = displayDate($row['birthdate']);
			$row['altbirthdate'] = displayDate($row['altbirthdate']);
			$row['deathdate'] = displayDate($row['deathdate']);
			$row['burialdate'] = displayDate($row['burialdate']);
		}
		$ancestorInfo[0][0] = $row;
    }

    return $ancestorInfo;
}
?>