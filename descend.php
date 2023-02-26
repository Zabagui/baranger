<?php
$textpart = "pedigree";
include("tng_begin.php");

include($subroot . "pedconfig.php");
if(!$personID) die("no args");

$descendtext_url = getURL( "descendtext", 1 );
$descendvert_url = getURL( "descendvert", 1 );
$register_url = getURL( "register", 1 );
$descendtables_url = getURL( "descendtables", 1 );
if(empty($generations))
    $generations = $pedigree['initdescgens'] > 8 ? 8 : $pedigree['initdescgens'];
if(!$generations) $generations = 6;
if( $generations > $pedigree['maxdesc'] )
	$generations = $pedigree['maxdesc'];
else
	$generations = intval( $generations );

if( (isset($display) && $display == "textonly") || ( !isset($display) && !$pedigree['defdesc'] ) ) {
	header( "Location: $descendtext_url" . "personID=$personID&tree=$tree&generations=$generations");
	exit;
}
elseif( (isset($display) && $display == "register") || ( !isset($display) && $pedigree['defdesc'] == 1 ) ) {
	header( "Location: $register_url" . "personID=$personID&tree=$tree&generations=$generations");
	exit;
}
elseif( (isset($display) && $display == "vertical") || ( !isset($display) && $pedigree['defdesc'] == 4 ) ) {
	header( "Location: $descendvert_url" . "personID=$personID&tree=$tree&generations=$generations");
	exit;
}
elseif( (isset($display) && $display == "tables") || ( !isset($display) && $pedigree['defdesc'] == 5 ) ) {
	header( "Location: $descendtables_url" . "personID=$personID&tree=$tree&generations=$generations");
	exit;
}

include($cms['tngpath'] . "pedbox.php" );

if($pedigree['defdesc'] == "") $pedigree['defdesc'] = 2;
if(empty($display)) {
	if( $pedigree['defdesc'] == 2)
		$display = "standard";
	else
		$display = "compact";
}

$rounded = $display == "compact" ? "rounded4" : "rounded10";
$slot = 0;

function setTopMarker($level,$value,$debug) {
	global $topmarker;

	//echo "level=$level, old=" . $topmarker[$level] . ", new=$value ($debug)<br>";
	$topmarker[$level] = $value;
}

$getperson_url = getURL( "getperson", 1 );
$descend_url = getURL( "descend", 1 );
$pdfform_url = getURL( "rpt_pdfform", 1 );

$pedigree['cellpad'] = 5;
$topmarker = array();
$botmarker = array();
$spouses_for_next_gen = array();
$maxwidth = 0;
$maxheight = 0;
$starttop = array();
$needtop = array();
$numboxes = 0;

$arrdnpath = $rootpath . $endrootpath . $templatepath . "img/ArrowDown.gif";
if (file_exists($arrdnpath)) {
	$downarrow = @GetImageSize($arrdnpath);
	$pedigree['downarroww'] = $downarrow[0];
	$pedigree['downarrowh'] = $downarrow[1];
	$pedigree['downarrow'] = "<img src=\"" . $cms['tngpath'] . $templatepath . "img/ArrowDown.gif\" border=\"0\" width=\"{$pedigree['downarroww']}\" height=\"{$pedigree['downarrowh']}\" alt=\"\" />";
}
else
	$pedigree['downarrow'] = "";

$arrrtpath = $rootpath . $endrootpath . "img/ArrowRight.gif";
if(file_exists($arrrtpath)) {
	$offpageimg = @GetImageSize($arrrtpath);
	$pedigree['offpagelink'] = "<img border=\"0\" src=\"" . $cms['tngpath'] . "img/ArrowRight.gif\" $offpageimg[3] alt=\"{$text['popupnote3']}\" />";
	$pedigree['offpageimgw'] = $offpageimg[0];
	$pedigree['offpageimgh'] = $offpageimg[1];
}
else
	$pedigree['offpagelink'] = "<b>&gt;</b>";

$arrltpath = $rootpath . $endrootpath . "img/ArrowLeft.gif";
if(file_exists($arrltpath)) {
	$leftarrowimg = @GetImageSize($arrltpath);
	$pedigree['leftarrowimgw'] = $leftarrowimg[0];
	$pedigree['leftarrowimgh'] = $leftarrowimg[1];
	$pedigree['leftarrowlink'] = "<img border=\"0\" src=\"" . $cms['tngpath'] . "img/ArrowLeft.gif\" $leftarrowimg[3] align=\"left\" title=\"{$text['popupnote3']}\" alt=\"{$text['popupnote3']}\" style=\"margin-right:5px\"/>";
 	$pedigree['leftindent'] += $pedigree['leftarrowimgw'] + $pedigree['shadowoffset'] + 6;
}
else {
	$pedigree['leftarrowlink'] = "<b>&lt;</b>";
   	$pedigree['leftindent'] += 16 + $pedigree['shadowoffset'];
}


if( $display == "compact" ) {
	$pedigree['inclphotos'] = 0;
	$pedigree['usepopups'] = 0;
	$pedigree['boxHsep'] = 15;
	$pedigree['boxheight'] = 16;
	$pedigree['boxnamesize'] = 8;
	$pedigree['cellpad'] = 0;
	$pedigree['boxwidth'] -= 50;
	$pedigree['boxVsep'] = 5;
	$pedigree['shadowoffset'] = 1;
	$pedigree['spacer'] = "&nbsp;";
	$pedigree['gendalign'] = -2;
	$spouseoffset = 20;
	$pedigree['diff'] = $pedigree['boxheight'] + $pedigree['boxVsep'] + $pedigree['linewidth'];
	$clinkstyle = "3";
	$slinkstyle = "";
}
else {
	$pedigree['boxnamesize'] = 11;
	$pedigree['usepopups'] = 1;
	$pedigree['boxheight'] = $pedigree['puboxheight'];
	$pedigree['boxwidth'] = $pedigree['puboxwidth'];
	$pedigree['boxalign'] = $pedigree['puboxalign'];
	$pedigree['spacer'] = "";
	$pedigree['gendalign'] = -1;
	$spouseoffset = 40;
	$pedigree['diff'] = $pedigree['boxheight'] + $pedigree['boxVsep'] + $pedigree['linewidth'] + $pedigree['downarrowh'];
	$clinkstyle = "";
	$slinkstyle = "3";
	if (file_exists($cms['tngpath'] . "img/Chart.gif")) {
		$chartlinkimg = @GetImageSize($cms['tngpath'] . "img/Chart.gif");
		$pedigree['chartlink'] = "<img src=\"{$cms['tngpath']}img/Chart.gif\" border=\"0\" $chartlinkimg[3] title=\"{$text['popupnote2']}\" alt=\"\" />";
	}
	else
		$pedigree['chartlink'] = "<span class=\"normal\"><b>P</b></span>";
}

$pedigree['baseR'] = hexdec( substr( $pedigree['boxcolor'], 1, 2 ) );
$pedigree['baseG'] = hexdec( substr( $pedigree['boxcolor'], 3, 2 ) );
$pedigree['baseB'] = hexdec( substr( $pedigree['boxcolor'], 5, 2 ) );
if( $pedigree['colorshift'] > 0 ) {
	$extreme = $pedigree['baseR'] < $pedigree['baseG'] ? $pedigree['baseR'] : $pedigree['baseG'];
	$extreme = $extreme < $pedigree['baseB'] ? $extreme : $pedigree['baseB'];
}
elseif( $pedigree['colorshift'] < 0 ) {
	$extreme = $pedigree['baseR'] > $pedigree['baseG'] ? $pedigree['baseR'] : $pedigree['baseG'];
	$extreme = $extreme > $pedigree['baseB'] ? $extreme : $pedigree['baseB'];
}
$pedigree['colorshift'] = round( $pedigree['colorshift'] / 100 * $extreme / 5 );
$pedigree['url'] = getURL( "pedigree", 1 );
//$pedigree[boxcolor] = getColor(1);

function getColor( $shifts ) {
	global $pedigree;

	$shiftval = $shifts * $pedigree['colorshift'];
	$R = $pedigree['baseR'] + $shiftval;
	$G = $pedigree['baseG'] + $shiftval;
	$B = $pedigree['baseB'] + $shiftval;
	if ( $R > 255 ) $R = 255; if ( $R < 0 ) $R = 0;
	if ( $G > 255 ) $G = 255; if ( $G < 0 ) $G = 0;
	if ( $B > 255 ) $B = 255; if ( $B < 0 ) $B = 0;
	$R = str_pad( dechex($R), 2, "0", STR_PAD_LEFT );
	$G = str_pad( dechex($G), 2, "0", STR_PAD_LEFT );
	$B = str_pad( dechex($B), 2, "0", STR_PAD_LEFT );
	return "#$R$G$B";
}

function getParents($personID) {
	global $tree, $pedigree, $display, $descend_url, $generations, $righttree;

	$parentinfo = "";
	$result = getChildParentsFamilyMinimal($tree, $personID);
	while( $parents = tng_fetch_assoc( $result ) ) {
		if( $parents['husband'] ) {
			$presult = getPersonFullPlusDates($tree, $parents['husband']);
			$husband = tng_fetch_assoc( $presult );
			$rights = determineLivingPrivateRights($husband, $righttree);
			$husband['allow_living'] = $rights['living'];
			$husband['allow_private'] = $rights['private'];
			$husband['name'] = getName( $husband );

			if($display == "compact")
				$extra = " " . getGenderIcon("M", $pedigree['gendalign']);
			else
				$extra = "<br/>" . getGenderIcon("M", $pedigree['gendalign']) . " " . justYears($husband);
			$parentinfo .= "<tr><td valign=\"top\"><a href=\"$descend_url" . "personID={$parents['husband']}&amp;tree=$tree&amp;generations=$generations&amp;display=$display\">{$pedigree['leftarrowlink']}<span class=\"normal\">{$husband['name']}</span></a>{$extra}</td></tr>\n";
	  		tng_free_result( $presult );
		}
		if( $parents['wife'] ) {
			$presult = getPersonFullPlusDates($tree, $parents['wife']);
			$wife = tng_fetch_assoc( $presult );
			$rights = determineLivingPrivateRights($wife, $righttree);
			$wife['allow_living'] = $rights['living'];
			$wife['allow_private'] = $rights['private'];
			$wife['name'] = getName( $wife );

			if($display == "compact")
				$extra = " " . getGenderIcon("F", $pedigree['gendalign']);
			else
				$extra = "<br/>" . getGenderIcon("F", $pedigree['gendalign']) . " " . justYears($wife);
			$parentinfo .= "<tr><td valign=\"top\"><a href=\"$descend_url" . "personID={$parents['wife']}&amp;tree=$tree&amp;generations=$generations&amp;display=$display\">{$pedigree['leftarrowlink']}<span class=\"normal\">{$wife['name']}</span></a>{$extra}</td></tr>\n";
	  		tng_free_result( $presult );
		}
	}
	tng_free_result( $result );

	return $parentinfo;
}

function getNewChart($personID) {
	global $tree, $generations, $cms, $text, $descend_url, $display, $kidsflag;
	return $kidsflag ? "<a href=\"$descend_url" . "personID=$personID&amp;tree=$tree&amp;generations=$generations&amp;display=$display\"><img src=\"{$cms['tngpath']}img/dchart.gif\" width=\"10\" height=\"9\" alt=\"{$text['popupnote3']}\" border=\"0\"/></a>" : "";
}

function doBox($level,$person,$spouseflag,$kidsflag) {
	global $pedigree, $topmarker, $botmarker, $spouseoffset, $maxwidth, $maxheight, $personID, $tree, $getperson_url;
	global $generations, $display, $descend_url, $text, $cms, $numboxes, $rounded, $slot;

	$numboxes++;
	if( !$topmarker[$level] )
		setTopMarker($level,0,"initialize, 183");
	$top = $topmarker[$level];
	if( $top > $maxheight ) $maxheight = $top;
	$topmarker[$level] += $pedigree['diff'];
	$left = $pedigree['leftindent'] + ($pedigree['boxwidth'] + $pedigree['boxHsep'] + $spouseoffset) * ($level - 1);
	$farleft = $left + $pedigree['boxwidth'] + $pedigree['boxHsep'] + $spouseoffset;
	if( $spouseflag ) {
		$left += $spouseoffset;
		$bgcolor = getColor(3);
	}
	else {
		$botmarker[$level] = $top;
		$bgcolor = getColor(1);
	}
	if( $farleft > $maxwidth ) $maxwidth = $farleft;

	$boxstr = $mouseover = $mouseout = $hiddenbox = "";
	if( !empty($person['personID']) && $person['personID'] == $personID ) {
		$parentinfo = getParents($personID);
		if( $parentinfo ) {
			//do the arrow
			$adjleft = $left - ($pedigree['leftarrowimgw'] + $pedigree['shadowoffset'] + 6);
			$boxstr .= "<div id=\"leftarrow\" style=\"position:absolute; top:" . ( $top + intval( ($pedigree['boxheight'] - $pedigree['offpageimgh']) / 2) + 1 ) . "px; left:$adjleft" . "px;z-index:5;\">\n";
			$boxstr .= "<a href=\"javascript:goBack();\">{$pedigree['leftarrowlink']}</a></div>\n";
			//set top
			$boxstr .= "<div id=\"popupleft\" class=\"popup\" style=\"position:absolute; visibility:hidden; background-color:{$pedigree['popupcolor']}; top:" . ( $top + $pedigree['borderwidth'] + intval( ($pedigree['boxheight'] - $pedigree['offpageimgh']) / 2) + 1 ) . "px; left:$adjleft" . "px;z-index:8\" onmouseover=\"cancelTimer('left')\" onmouseout=\"setTimer('left')\">\n";
			$boxstr .= "<div>\n<div class=\"tngshadow popinner\">\n<div class=\"pboxpopupdiv\">\n";
			$boxstr .= "<table><tr><td><table border=\"0\" cellspacing=\"0\" cellpadding=\"1\">\n";
			$boxstr .= "<tr><td class=\"normal pboxpopup\"><b>{$text['parents']}</b></td></tr>\n$parentinfo\n</table></td></tr></table>\n</div>\n</div>\n</div>\n</div>\n";
		}
	}

	if( !empty($person['famc']) && $pedigree['popupchartlinks'] && $display != "compact") {
		$mouseover .= "if(jQuery('#ic$slot').length) jQuery('#ic$slot').show();";
		$mouseout .= "if(jQuery('#ic$slot').length) jQuery('#ic$slot').hide();";
		$iconlinks = "<div class=\"floverlr\" id=\"ic$slot\" style=\"left:" . ($pedigree['puboxwidth'] - 35) . "px;top:" . ($pedigree['puboxheight'] - 15) . "px;display:none;background-color:$bgcolor\">";
		$iconlinks .= "<a href=\"{$pedigree['url']}personID={$person['personID']}&amp;tree=$tree&amp;display=standard&amp;generations=" . $pedigree['initpedgens'] . "\" title=\"{$text['popupnote2']}\">{$pedigree['chartlink']}</a>\n";
		$iconlinks .= "</div>\n";
		$slot++;
	}
	else
		$iconactions = $iconlinks = "";

	if( !empty($person) && $display != "compact" && $pedigree['usepopups'] ) {
   		$vitalinfo = getVitalDates( $person );
		if( $vitalinfo ) {
			$mouseover .= "showPopup($numboxes,$top,{$pedigree['boxheight']});";
			$mouseout .= "setTimer($numboxes);";
	   		$hiddenbox = "<div style=\"position: absolute; top:" . ($top + $pedigree['boxheight'] + (2 * $pedigree['borderwidth']) + $pedigree['shadowoffset'] + 1) . "px;left:" . ($left + intval(($pedigree['boxwidth'] - $pedigree['downarroww'])/2) - 1) . "px;z-index:7;\" class=\"fakelink\">";
			$hiddenbox .= "<a href=\"#\" onmouseover=\"showPopup($numboxes,$top," . $pedigree['boxheight'] . ")\">" . $pedigree['downarrow'] . "</a></div>";

			$hiddenbox .= "<div class=\"popup\" id=\"popup$numboxes\" style=\"position:absolute; visibility:hidden; background-color:{$pedigree['popupcolor']}; left:" . ($left - $pedigree['borderwidth'] + round($pedigree['shadowoffset']/2)) . "px;z-index:8\" onmouseover=\"cancelTimer($numboxes)\" onmouseout=\"setTimer($numboxes)\">\n";
			$hiddenbox .= "<div><div class=\"tngshadow popinner\"><div class=\"pboxpopupdiv\">\n<table cellspacing=\"0\" cellpadding=\"1\" border=\"0\" width=\"100%\">\n";
			$hiddenbox .= "$vitalinfo\n</table></div></div></div></div>\n";
		}
	}
	if($mouseover)
		$mouseover = " onmouseover=\"$mouseover\"";
	if($mouseout)
		$mouseout = " onmouseout=\"$mouseout\"";

	$shadow = $pedigree['shadowoffset'] . "px " . $pedigree['shadowoffset'] . "px " . $pedigree['shadowoffset'] . "px " . $pedigree['shadowcolor'];
	$boxstr .= "<div class=\"pedbox $rounded\" id=\"box$numboxes\" style=\"background-color:$bgcolor; top:" . $top . "px; left:" . ($left-$pedigree['borderwidth']) . "px; height:" . $pedigree['boxheight'] . "px; width:{$pedigree['boxwidth']}" . "px; box-shadow:$shadow;border:{$pedigree['borderwidth']}px solid {$pedigree['bordercolor']};\"$mouseover$mouseout>\n";
    $boxstr .= "$iconlinks<table align=\"center\" border=\"0\" cellpadding=\"{$pedigree['cellpad']}\" cellspacing=\"0\" class=\"pedboxtable\"><tr>";

    // implant a picture (maybe)
    if( !empty($person) && $pedigree['inclphotos'] && $pedigree['usepopups']) {
		$photohtouse = $pedigree['boxheight'] - ( $pedigree['cellpad'] * 2 ); // take cellpadding into account
		//$photoinfo = showSmallPhoto( $person['personID'], $person['name'], $person['allow_living'], $photohtouse );
		$photoInfo = getPhotoSrc( $person['personID'], $person['allow_living'] && $person['allow_private'], $person['sex'] );
		if( $photoInfo['ref'] ) {
			$imagestr = "<img src=\"{$photoInfo['ref']}\" border=\"0\" style=\"max-height:{$photohtouse}px;max-width:{$photohtouse}px\" alt=\"\" class=\"smallimg\" />";
			if($photoInfo['link'])
				$imagestr = "<a href=\"{$photoInfo['link']}\">$imagestr</a>";
			$boxstr .= "<td class=\"lefttop\">$imagestr</td>";
		}
	}
	//echo "name=$person[name], top=$top<br>\n";

    // name info
	if(!empty($person['name'])) {
		if($display == "compact")
			$extra = " " . getGenderIcon($person['sex'], $pedigree['gendalign']) . getNewChart($person['personID']);
		else
			$extra = "<br/>" . getGenderIcon($person['sex'], $pedigree['gendalign']) . " " . justYears($person) . getNewChart($person['personID']);

	   	$boxstr .= "<td class=\"pboxname\" align=\"{$pedigree['boxalign']}\"><span style=\"font-size:{$pedigree['boxnamesize']}" . "pt;\">{$pedigree['spacer']}<a href=\"$getperson_url" . "personID={$person['personID']}&amp;tree=$tree" . "\">{$person['name']}</a>{$extra}</span></td></tr></table></div>\n";
	}
	else
	   	$boxstr .= "<td class=\"pboxname\"><span style=\"font-size:{$pedigree['boxnamesize']}" . "pt;\">{$text['unknownlit']}</span></td></tr></table></div>\n";

	$boxstr .= $hiddenbox;

	if( !$spouseflag && $person['personID'] != $personID ) {
		$boxstr .= "<div class=\"boxborder\" style=\"top:" . ($top + intval($pedigree['boxheight']/2) - intval($pedigree['linewidth']/2)) . "px;left:" . ($left - intval($pedigree['boxHsep']/2)) . "px;height:" . $pedigree['linewidth'] . "px;width:" . (intval($pedigree['boxHsep']/2) + 2) . "px;z-index:3;overflow:hidden\"></div>\n";
	}
	if( $spouseflag ) {
		$boxstr .= "<div class=\"boxborder\" style=\"top:" . ($top + intval($pedigree['boxheight']/2) - intval($pedigree['linewidth']/2)) . "px;left:" . ($left - intval($spouseoffset/2)) . "px;height:" . $pedigree['linewidth'] . "px;width:" . (intval($spouseoffset/2) + 2) . "px;z-index:3;overflow:hidden\"></div>\n";
		if( $kidsflag ) {
			if( $level < $generations ) {
		   		$boxstr .= "<div class=\"boxborder\" style=\"top:" . ($top + intval($pedigree['boxheight']/2) - intval($pedigree['linewidth']/2)) . "px;left:" . ($left + $pedigree['boxwidth']) . "px;height:" . $pedigree['linewidth'] . "px;width:" . (intval($pedigree['boxHsep']/2) + 1) . "px;z-index:3;overflow:hidden\"></div>\n";
			}
			else {
				$boxstr .= "<div style=\"position: absolute; top:" . ( $top + $pedigree['borderwidth'] + intval( ($pedigree['boxheight'] - $pedigree['offpageimgh']) / 2) + 1 ) . "px;left:" . ($left + $pedigree['boxwidth'] + $pedigree['borderwidth'] + $pedigree['shadowoffset'] + 3 ) . "px;z-index:5\">\n";
				//$nextperson = $person['personID'] ? $person['personID'] : $spouseflag;
				$boxstr .= "<a href=\"$descend_url" . "personID=$spouseflag&amp;tree=$tree&amp;generations=$generations&amp;display=$display\" title=\"{$text['popupnote3']}\">{$pedigree['offpagelink']}</a></div>\n";
			}
		}
	}

	return $boxstr;
}

function doIndividual($person,$level) {
	global $tree, $generations, $pedigree, $righttree, $chart, $descend_url, $display, $text;
	global $topmarker, $botmarker, $vslots, $vendspouses, $spouseoffset, $needtop, $starttop, $spouses_for_next_gen;

	//look up person
	$result = getPersonFullPlusDates($tree, $person);
	if( $result ) {
		$row = tng_fetch_assoc( $result );
		$rights = determineLivingPrivateRights($row, $righttree);
		$row['allow_living'] = $rights['living'];
		$row['allow_private'] = $rights['private'];
		$row['name'] = getName( $row );
	}
	tng_free_result( $result );

	//get gender-related info
	if( $row['sex'] == "M" ) {
		$self = "husband";
		$spouse = "wife";
		$spouseorder = "husborder";
	}
	else if( $row['sex'] == "F" ){
		$self = "wife";
		$spouse = "husband";
		$spouseorder = "wifeorder";
	}
	else {
		$self = $spouse = $spouseorder = "";
	}

	//look up spouse-families
	if( $spouse )
		$result = getSpouseFamilyData($tree, $self, $person, $spouseorder);
	else
		$result = getSpouseFamilyDataUnion($tree, $person);
	$marrtot = tng_num_rows($result);
	if( $spouse && !$marrtot ) {
		$result = getSpouseFamilyDataUnion($tree, $person);
		$self = $spouse = $spouseorder = "";
	}

	//for each family
	$needperson = 1;
	$spousecount = 0;
   	while( $famrow = tng_fetch_assoc( $result ) ) {
		//get starting offset
		//do box for main spouse (if not already done)
		$spousecount++;
		if( !$spouse ) {
			if( $row['personID'] == $famrow['husband'] ) {
				$self = "husband";
				$spouse = "wife";
				$spouseorder = "husborder";
			} else {
				$self = "wife";
				$spouse = "husband";
				$spouseorder = "wifeorder";
			}
		}
		$originaltop = $topmarker[$level];
		//if( $vslots[$famrow[familyID]] > 2 )
			//$topmarker[$level] += 100 + intval(($pedigree[diff]) * ($vslots[$famrow[familyID]] - $vendspouses[$famrow[familyID]] - 1) / 2);
   		//echo "fam=$famrow[familyID], ve=" .$vendspouses[$famrow[familyID]] . ", vs= " . $vslots[$famrow[familyID]] . "<br />\n";

		//get children

		$result2 = getChildrenMinimal($tree, $famrow['familyID']);
		$numkids = tng_num_rows( $result2 );
		if( $level < $generations ) {
			//if( $famrow[$spouse] )

			if( $numkids ) {
				$needtop[$level + 1] = 1;
				$childleft = $pedigree['leftindent'] + ($pedigree['boxwidth'] + $pedigree['boxHsep'] + $spouseoffset) * $level;
				while( $crow = tng_fetch_assoc( $result2 ) ) {
					//recurse on each child (next level)
					doIndividual( $crow['personID'], $level + 1 );
				}
				if( $numkids > 1 )
					$vheight = $botmarker[$level+1] - $starttop[$level+1];
				elseif( $needperson ) {
					$vheight = $pedigree['diff'] + 1;
				}
				else
					$vheight = 0;
				if( $numkids == 1 && $spousecount < 2 && !$spouses_for_next_gen[$level+1]) {
					//$topmarker[$level + 1] += $pedigree[diff];
					for( $i = $level + 1; $i <= $generations; $i++ )
						setTopMarker($i,$topmarker[$i] + $pedigree['diff'],"lowering previous gens, 348");
				}

				if( $vheight && ($famrow[$spouse] || $numkids > 1 || $marrtot > 1)) {
					$chart .= "<div class=\"boxborder\" style=\"top:" . ($starttop[$level+1] + intval($pedigree['boxheight']/2) - intval($pedigree['linewidth']/2)). "px;left:" . ($childleft - intval($pedigree['boxHsep']/2)) . "px;height:" . $vheight . "px;width:" . $pedigree['linewidth'] . "px;z-index:3\"></div>\n";
				}
	   			tng_free_result( $result2 );
				setTopMarker($level,$starttop[$level+1] + intval($vheight / 2),"increasing, half of box height, 356");
			}
		}

		if( $needperson ) {
			//set "top"
			//take number of "vslots" for this family
			if( $numkids && $level < $generations )
				setTopMarker($level,$topmarker[$level] - intval(($pedigree['diff'])/2),"decreasing, moving down to center,365");
			if( !empty($needtop[$level]) ) {
				$starttop[$level] = $topmarker[$level];
				$needtop[$level] = 0;
			}
			$thistop = $topmarker[$level];
			$chart .= doBox($level,$row,0,0);
			$needperson = 0;
		}
		//echo "familyID = $famrow[familyID], vs=" . $vslots[$famrow[familyID]] . ", ve=" . $vendspouses[$famrow[familyID]] . "<br>";

		//get spouse data (if exists)
		$spouserow = array();
		if( !$spouse )
			$spouse = $famrow['husband'] == $person ? "wife" : "husband";
		if( $famrow[$spouse] ) {
			$spouseresult = getPersonFullPlusDates($tree, $famrow[$spouse]);
			$spouserow = tng_fetch_assoc( $spouseresult );
			$rights = determineLivingPrivateRights($spouserow, $righttree);
			$spouserow['allow_living'] = $rights['living'];
			$spouserow['allow_private'] = $rights['private'];
			$spouserow['name'] = getName( $spouserow );
		}
		else
			$spouserow = array();

		//do box for other spouse
		//lines down from primary spouse
		$vheight = $topmarker[$level] - $thistop - intval($pedigree['boxheight']/2) - intval($pedigree['linewidth']/2);
		$childleft = $pedigree['leftindent'] + ($pedigree['boxwidth'] + $pedigree['boxHsep'] + $spouseoffset) * ($level - 1);

		if($marrtot == 1 && !$famrow[$spouse] && $level == $generations) {
			$top = $topmarker[$level];
			$left = $pedigree['leftindent'] + ($pedigree['boxwidth'] + $pedigree['boxHsep'] + $spouseoffset) * ($level - 1);
			$chart .= "<div style=\"position: absolute; top:" . ( $top - $pedigree['boxHsep'] - $pedigree['borderwidth'] - intval( ($pedigree['boxheight'] - $pedigree['offpageimgh']) / 2) - 1 ) . "px;left:" . ($left + $pedigree['boxwidth'] + $pedigree['borderwidth'] + $pedigree['shadowoffset'] + 3 ) . "px;z-index:5\">\n";
			$chart .= "<a href=\"$descend_url" . "personID=$person&amp;tree=$tree&amp;generations=$generations&amp;display=$display\" title=\"{$text['popupnote3']}\">{$pedigree['offpagelink']}</a></div>\n";
		}

		if($famrow[$spouse] || $marrtot > 1) {
			$chart .= "<div class=\"boxborder\" style=\"top:" . ($thistop + $pedigree['boxheight']) . "px;left:" . ($childleft + intval($spouseoffset/2)) . "px;height:" . $vheight . "px;width:" . $pedigree['linewidth'] . "px;z-index:3\"></div>\n";
		}
		else if($level < $generations) {
			$chart .= "<div class=\"boxborder\" style=\"top:" . ($thistop + $pedigree['boxheight']/2) . "px;left:" . ($childleft + $pedigree['boxwidth']) . "px;height:" . $pedigree['linewidth'] . "px;width:" . ($spouseoffset + $pedigree['boxHsep']/2) . "px;z-index:3\"></div>\n";
		}

		$thistop = $topmarker[$level] - intval($pedigree['boxheight']/2) - intval($pedigree['linewidth']/2);

		if($famrow[$spouse] || $marrtot > 1) {
			$rightbranch = $righttree ? checkbranch($famrow['branch']) : false;
			$rights = determineLivingPrivateRights($famrow, $righttree, $rightbranch);
			$famrow['allow_living'] = $rights['living'];
			$famrow['allow_private'] = $rights['private'];
			if( $famrow[$spouse] ) {
				if( $rights['both'] ) {
					$spouserow['marrdate'] = $famrow['marrdate'];
					$spouserow['marrplace'] = $famrow['marrplace'];
				}
				else
					$spouserow['marrdate'] = $spouserow['marrplace'] = "";
			}
	   		$chart .= doBox($level,$spouserow,$person,$numkids);
	   	}
		else {
			if( !$topmarker[$level] )
				setTopMarker($level,0,"initialize, 183");
			$top = $topmarker[$level];
			if( !isset($maxheight) || $top > $maxheight ) $maxheight = $top;
			$topmarker[$level] += $pedigree['diff'];
		}

		if( $numkids && $level < $generations ) {
			$vkey = $famrow['familyID'] . "-$level";
			setTopMarker($level,$originaltop + ($vslots[$vkey] * $pedigree['diff']),"raising, diff={$pedigree['diff']}, slots=" . $vslots[$vkey] . ", key=$vkey, 401");
		}
		else {
			for( $i = $level + 1; $i <= $generations; $i++ )
				setTopMarker($i,$topmarker[$level],"lowering previous gens, no kids, 405");
		}
	}
	$spouses_for_next_gen[$level] = $spousecount;
	//if no family, get starting offset and do box for person and return
	if( $needperson ) {
		//set top differently
		if( !empty($needtop[$level]) ) {
			$starttop[$level] = $topmarker[$level];
			$needtop[$level] = 0;
		}
		$chart .= doBox($level,$row,0,0);
		for( $i = $level + 1; $i <= $generations; $i++ )
			setTopMarker($i,$topmarker[$level],"lowering all previous gens, 418");
	}
	tng_free_result( $result );
}

function getData( $key, $sex, $level ) {
	global $tree, $generations;
	global $vslots, $vendspouses;

	if( $sex == "M" ) {
		$self = "husband";
		$spouseorder = "husborder";
	}
	elseif( $sex == "F") {
		$self = "wife";
		$spouseorder = "wifeorder";
	}
	else
		$self = $spouseorder = "";

	$gotafamily = 0;
	$stats = array();
	$stats['slots'] = 0;
	$stats['fams'] = 0;
	$stats['es'] = 0; //end spouses

	if($self)
        $result = getSpouseFamilyMinimal($tree, $self, $key, $spouseorder);
	else
        $result = getSpouseFamilyMinimalUnion($tree, $key);
   	$stats['fams'] = tng_num_rows( $result );
	if($self && !$stats['fams']) {
        $result = getSpouseFamilyMinimalUnion($tree, $key);
	   	$stats['fams'] = tng_num_rows( $result );
	}
	if( $result ) {
		while( $row = tng_fetch_assoc( $result ) ) {
			$famslots = 0;
			$fam_es = 0;
			if( !$gotafamily) {
				$spouseslots = 2;
				$gotafamily = 1;
			}
			else
				$spouseslots = 1; //for this spouse only; primary individual not included
			$endspouseslots = 1;

			$result2 = getChildrenMinimalPlusGender($tree, $row['familyID']);
			$numkids = tng_num_rows( $result2 );
			if( $numkids && $level < $generations ) {
				while( $crow = tng_fetch_assoc( $result2 ) ) {
					$kidstats = getData( $crow['personID'], $crow['sex'], $level + 1 );
					$famslots += $kidstats['slots'];
				}
   				$fam_es += $kidstats['es'];
			}

			tng_free_result( $result2 );
			$famslots = $famslots > $spouseslots ? $famslots : $spouseslots;

			$fam_es = $fam_es > $endspouseslots ? $fam_es : $endspouseslots;
			$stats['slots'] += $famslots;
			$vkey = $row['familyID'] . "-$level";
			$vslots[$vkey] = $famslots;
			//echo "key=$vkey, slots=" . $vslots[$vkey] . "<br>";
			$stats['es'] = $fam_es;
			$vendspouses[$vkey] = $stats['es'];
			//echo "fam=$row[familyID], stats = $stats[es], fames=$fames, es=$endspouseslots, slots=$famslots <br>";
		}
	}
	tng_free_result( $result );
	if( !$stats['slots'] ) {
		$stats['slots'] = 1;
		$vkey = $key . "-$level";
		$vslots[$vkey] = 1;
		//echo "key=$vkey, slots=" . $vslots[$vkey] . "<br>";
		$stats['es'] = 0; //do I need this?
		$vendspouses[$vkey] = 0;
	}

	return $stats;
}

function getVitalDates( $row ) {
	global $text;

	$vitalinfo = "";

	if( $row['allow_living'] && $row['allow_private'] ) {
		if( $row['birthdate'] || $row['altbirthdate'] || $row['altbirthplace'] || $row['deathdate'] || $row['burialdate'] || $row['burialplace'] )
			$dataflag = 1;
		else
			$dataflag = 0;

		// get birthdate info
		if ( $row['altbirthdate'] && !$row['birthdate'] ) {
			$bd = $row['altbirthdate'];
			$bp = $row['altbirthplace'];
			$birthabbr = $text['capaltbirthabbr'] . ":";
		}
	  	elseif( $dataflag ) {
			$bd = $row['birthdate'];
			$bp = $row['birthplace'];
			$birthabbr = $text['capbirthabbr'] . ":";
		}
		else {
			$bd = "";
			$bp = "";
			$birthabbr = "";
		}

		// get death/burial date info
		if( $row['burialdate'] && !$row['deathdate'] ) {
			$dd = $row['burialdate'];
			$dp = $row['burialplace'];
			$deathabbr = $text['capburialabbr'] . ":";
		}
		elseif( $dataflag ) {
			$dd = $row['deathdate'] ;
			$dp = $row['deathplace'];
			$deathabbr = $text['capdeathabbr'] . ":";
		}
		else {
			$dd = "";
			$dp = "";
			$deathabbr = "";
		}
	}
	else {
		$bd = $bp = $birthabbr = $dd = $dp = $deathabbr = $md = $mp = $marrabbr = "";
	}
	$marrabbr = $text['capmarrabbr'] . ":";
	if( $bd ) {
		$vitalinfo .= "<tr>\n<td class=\"pboxpopup normal\" align=\"right\" valign=\"top\">$birthabbr</td>\n";
		$vitalinfo .= "<td class=\"pboxpopup normal\" valign=\"top\">" . displayDate( $bd ) . "</td></tr>\n";
		$birthabbr = "&nbsp;";
	}
	if( $bp ) {
		$vitalinfo .= "<tr>\n<td class=\"pboxpopup normal\" align=\"right\" valign=\"top\">$birthabbr</td>\n";
		$vitalinfo .= "<td class=\"pboxpopup normal\" valign=\"top\">$bp</td></tr>\n";
	}
	if( !empty($row['marrdate']) ) {
		$vitalinfo .= "<tr>\n<td class=\"pboxpopup normal\" align=\"right\" valign=\"top\">$marrabbr</td>\n";
		$vitalinfo .= "<td class=\"pboxpopup normal\" valign=\"top\">" . displayDate( $row['marrdate'] ) . "</td></tr>\n";
		$marrabbr = "&nbsp;";
	}
	if( !empty($row['marrplace']) ) {
		$vitalinfo .= "<tr>\n<td class=\"pboxpopup normal\" align=\"right\" valign=\"top\">$marrabbr</td>\n";
		$vitalinfo .= "<td class=\"pboxpopup normal\" valign=\"top\">{$row['marrplace']}</td></tr>\n";
	}
	if( $dd ) {
		$vitalinfo .= "<tr>\n<td class=\"pboxpopup normal\" align=\"right\" valign=\"top\">$deathabbr</td>\n";
		$vitalinfo .= "<td class=\"pboxpopup normal\" valign=\"top\">" . displayDate( $dd ) . "</td></tr>\n";
		$deathabbr = "&nbsp;";
	}
	if( $dp ) {
		$vitalinfo .= "<tr>\n<td class=\"pboxpopup normal\" align=\"right\" valign=\"top\">$deathabbr</td>\n";
		$vitalinfo .= "<td class=\"pboxpopup normal\" valign=\"top\">$dp</td></tr>\n";
	}
	if($vitalinfo)
		$vitalinfo = "<tr>\n<td class=\"pboxpopup normal\" colspan=\"2\"><strong>" . $row['name'] . "</strong></td></tr>\n" . $vitalinfo;
	return $vitalinfo;
}

$level = 1;
$key = $personID;

$result = getPersonFullPlusDates($tree, $personID);
if( $result ) {
	$row = tng_fetch_assoc( $result );
	$righttree = checktree($tree);
	$rightbranch = $righttree ? checkbranch($row['branch']) : false;
	$rights = determineLivingPrivateRights($row, $righttree, $rightbranch);
	$row['allow_living'] = $rights['living'];
	$row['allow_private'] = $rights['private'];
	$row['name'] = getName( $row );
	$logname = $tngconfig['nnpriv'] && $row['private'] ? $admtext['text_private'] : ($nonames && $row['living'] ? $text['living'] : $row['name']);
}

$treeResult = getTreeSimple($tree);
$treerow = tng_fetch_assoc($treeResult);
$disallowgedcreate = $treerow['disallowgedcreate'];
$allowpdf = !$treerow['disallowpdf'] || ($allow_pdf && $rightbranch);
tng_free_result($treeResult);

writelog( "<a href=\"$descend_url" . "personID=$personID&amp;tree=$tree&amp;display=$display\">" . xmlcharacters($text['descendfor'] . " $logname ($personID)") . "</a>" );
preparebookmark( "<a href=\"$descend_url" . "personID=$personID&amp;tree=$tree&amp;display=$display\">{$text['descendfor']} " . $row['name'] . " ($personID)</a>" );

$flags['scripting'] = "<style type=\"text/css\">
.desc {
	margin: 0 0 10px 0;
}

.spouse {
	width: 100%;
}

.shadow {
	background-color: {$pedigree['shadowcolor']};
	position: absolute;
}

.boxborder {
	background-color: {$pedigree['bordercolor']};
}
</style>\n";
$flags['scripting'] .= "<script type=\"text/javascript\">var tnglitbox;</script>\n";
tng_header( $text['descendfor'] . " " . $row['name'], $flags );

$photostr = showSmallPhoto( $personID, $row['name'], $rights['both'], 0, false, $row['sex'] );
echo tng_DrawHeading( $photostr, $row['name'], getYears( $row ) );

if( !$pedigree['maxdesc'] ) $pedigree['maxdesc'] = 12;
if( !$pedigree['initdescgens'] ) $pedigree['initdescgens'] = 4;

for( $i = 0; $i < $generations + 1; $i++ )
	setTopMarker($i,0,"initializing");

$innermenu = $text['generations'] . ": &nbsp;";
$innermenu .= "<select name=\"generations\" class=\"verysmall\" onchange=\"window.location.href='$descend_url" . "personID=$personID&amp;tree=$tree&amp;display=$display&amp;generations=' + this.options[this.selectedIndex].value\">\n";
   for( $i = 1; $i <= $pedigree['maxdesc']; $i++ ) {
       $innermenu .= "<option value=\"$i\"";
       if( $i == $generations ) $innermenu .= " selected=\"selected\"";
       $innermenu .= ">$i</option>\n";
   }
$innermenu .= "</select>&nbsp;&nbsp;&nbsp;\n";
$innermenu .= "<a href=\"$descend_url" . "personID=$personID&amp;tree=$tree&amp;display=standard&amp;generations=$generations\" class=\"lightlink$slinkstyle\">{$text['pedstandard']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
$innermenu .= "<a href=\"$descend_url" . "personID=$personID&amp;tree=$tree&amp;display=compact&amp;generations=$generations\" class=\"lightlink$clinkstyle\">{$text['pedcompact']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
$innermenu .= "<a href=\"$descendvert_url" . "personID=$personID&amp;tree=$tree&amp;&amp;generations=$generations\" class=\"lightlink\">{$text['pedvertical']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
$innermenu .= "<a href=\"$descendtext_url" . "personID=$personID&amp;tree=$tree&amp;generations=$generations\" class=\"lightlink\">{$text['pedtextonly']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
$innermenu .= "<a href=\"$register_url" . "personID=$personID&amp;tree=$tree&amp;generations=$generations\" class=\"lightlink\">{$text['regformat']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
$innermenu .= "<a href=\"$descendtables_url" . "personID=$personID&amp;tree=$tree&amp;generations=$generations\" class=\"lightlink\">{$text['dtformat']}</a>\n";
if($generations <= 12 && $allowpdf)
	$innermenu .= " &nbsp;&nbsp; | &nbsp;&nbsp; <a href=\"#\" class=\"lightlink\" onclick=\"tnglitbox = new LITBox('$pdfform_url" . "pdftype=desc&amp;personID=$personID&amp;tree=$tree&amp;generations=$generations',{width:350,height:350});return false;\">PDF</a>\n";

echo getFORM( "descend", "get", "form1", "form1" );
echo tng_menu( "I", "descend", $personID, $innermenu );
echo "</form>\n";
if( !$tngprint ) {
?>
<span class="normal">
<?php echo $text['scrollnote'];
	if(!empty($pedigree['usepopups_real'])) {
		echo ( $pedigree['downarrow'] ? " <img src=\"" . $cms['tngpath'] . $templatepath . "img/ArrowDown.gif\" width=\"{$pedigree['downarroww']}\" height=\"{$pedigree['downarrowh']}\" alt=\"\" />" : " <a href=\"#\"><b>V</b></a>" ) . $text['popupnote1'];
	}
?>
</span>
<?php
}
$chart = "";
getData($key,$row['sex'],1);
doIndividual( $personID, 1 );

$maxheight += $pedigree['boxheight'] + $pedigree['borderwidth'] + $pedigree['downarroww'];
$maxwidth += $pedigree['boxwidth'] + $pedigree['borderwidth'] + (2 * $pedigree['offpageimgw']) + 6 + $pedigree['leftindent'];

if( !$tngprint ) {
	echo "<div id=\"mag-icons-div\" class=\"mag-icons\"><img src=\"img/zoomin.png\" id=\"zoom-in\" onclick=\"panzoom.zoomIn;\" alt=\"{$text['zoomin']}\"/><img src=\"img/zoomreset.png\" id=\"zoom-reset\" alt=\"{$text['tng_reset']}\"/><img src=\"img/zoomout.png\" id=\"zoom-out\" alt=\"{$text['zoomout']}\"/></div>\n";
}
?>
<div align="left" id="outer" style="position:relative;padding-top:8px;width:100%;height:<?php echo $maxheight > 200 ? $maxheight : 200; ?>px;">
	<div class="panzoom" id="vcontainer" style="overflow:visible">
		<div id="inner" style="position:relative;width:<?php echo $maxwidth; ?>px;height:<?php echo $maxheight > 200 ? $maxheight : 200; ?>px;">
<?php
	echo $chart;
?>
		</div>
	</div>
</div>

<script type="text/javascript">
//<![CDATA[
var timerleft = false;

function goBack() {
	var popupleft = document.getElementById("popupleft");
	popupleft.style.visibility = 'visible';
}

function setTimer(slot) {
	eval( "timer" + slot + "=setTimeout(\"hidePopup('" + slot + "')\",<?php echo $pedigree['popuptimer']; ?>);");
}

function cancelTimer(slot) {
	eval( "clearTimeout(timer" + slot + ");" );
	eval( "timer" + slot + "=false;" );
}

function hidePopup(slot) {
	var ref = document.all ? document.all["popup" + slot] : document.getElementById ? document.getElementById("popup" + slot) : null ;
	if (ref) { ref.style.visibility = "hidden"; }
	eval("timer" + slot + "=false;");
}

jQuery(document).ready(function() {
	jQuery('#inner').draggable();
	$("#inner").on("mousedown touchstart", function(e) {
	    $(this).addClass('grabbing')
	})

	$("#inner").on("mouseup touchend", function(e) {
	    $(this).removeClass('grabbing')
	})
});
//]]>
</script>
<?php
if( $display != "compact" && $pedigree['usepopups']) {
?>
<script type="text/javascript">
//<![CDATA[
var lastpopup = "";
for( var h = 1; h <= <?php echo $numboxes; ?>; h++ ) {
	eval( 'var timer' + h + '=false' );
}
function showPopup( slot, tall, high ){
// hide any other currently visible popups
	if( lastpopup ) {
		cancelTimer(lastpopup);
		hidePopup(lastpopup);
	}
	lastpopup = slot;

// show current
	var ref = jQuery("#popup" + slot);
	var box = jQuery("#box" + slot);

	var vOffset, hOffset, hDisplace;

	if(tall + high < 0)
		vOffset = 0;
	else {
		vOffset = tall + high + 2 * <?php echo $pedigree['borderwidth']; ?>;
		var vDisplace = box.position().top + high + 2 * <?php echo $pedigree['borderwidth']; ?> + ref.height() - jQuery('#outer').height() + 20; //20 is for the scrollbar
		if(vDisplace > 0)
			vOffset -= vDisplace;
	}
	hDisplace = box.position().left + ref.width() - jQuery('#outer').width();
	if(hDisplace > 0) {
		if(vDisplace > 0) {
			ref.offset({left: box.offset().left - ref.width() - <?php echo $pedigree['borderwidth']; ?>});
			if(box.position().top < vOffset)
				vOffset = box.position().top;
		}
		else
			ref.offset({left: box.offset().left - hDisplace});
	}
	else {
		if(vDisplace > 0) {
			hDisplace = box.position().left + box.width() + ref.width() - jQuery('#outer').width();
			if(hDisplace > 0)
				ref.offset({left: box.offset().left - ref.width() - <?php echo $pedigree['borderwidth']; ?>});
			else
				ref.offset({left: box.offset().left + box.width() + (2 * <?php echo $pedigree['borderwidth']; ?>)});
			if(box.position().top < vOffset)
				vOffset = box.position().top;
		}
	}

	ref.css('top',vOffset);
	ref.css('z-index',8);
   	ref.css('visibility','visible');
}
var zoomstep = 0.05;
//]]>
</script>
<?php
}
?>
<script src="js/panzoom.min.js"></script>
<script src="js/tngzoom.js"></script>
<?php
tng_footer( "" );
?>