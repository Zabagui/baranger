<?php
$textpart = "pedigree";
include("tng_begin.php");

include($subroot . "pedconfig.php");

$desctracker_url = getURL( "desctracker", 1 );
$getperson_url = getURL( "getperson", 1 );
$register_url = getURL( "register", 1 );
$descend_url = getURL( "descend", 1 );
$descendtext_url = getURL( "descendtext", 1 );
$descendvert_url = getURL( "descendvert", 1 );
$descendtables_url = getURL( "descendtables", 1 );

$righttree = checktree($tree);

function drawBox( $person, $box ) {
	global $tree, $pedigree, $photopath, $photosext, $browser, $childcount, $totkids, $more, $nonames, $text, $rootpath, $cms, $getperson_url, $boxheight, $boxwidth;

	if( $box['lineoutof'] )
		$bgcolor = $pedigree['boxcolor'];
	else if( $box['lineinto'] == 2 )  //spouse
		$bgcolor = getColor( 1 );
	else
		$bgcolor = $pedigree['emptycolor'];
		
	//begin, entire square
	echo "<td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"><tr>";
	
	//box consists of three cells
	//left margin
	drawEmpty( $box['topleft'], $box['middleleft'], $box['bottomleft'] );
	
	//main area
	echo "<td valign=\"top\" align=\"center\">";
	
	//top border
	if( $box['lineinto'] ) {
		if( $box['topleft'] )
			echo "<img src=\"{$cms['tngpath']}img/black.gif\" width=\"{$pedigree['halfwidth']}\" height=\"1\" hspace=\"0\" vspace=\"0\" border=\"0\">";
		else
			echo "<img src=\"{$cms['tngpath']}img/spacer.gif\" width=\"{$pedigree['halfwidth']}\" height=\"1\" hspace=\"0\" vspace=\"0\" border=\"0\">";
		if( $box['lineinto'] == 1 || $box['topleft'] || $box['topright'] )
			echo "<img src=\"{$cms['tngpath']}img/black.gif\" width=\"1\" height=\"1\" hspace=\"0\" vspace=\"0\" border=\"0\">";
		//line break after
		if( $box['topright'] )
			echo "<img src=\"{$cms['tngpath']}img/black.gif\" width=\"{$pedigree['halfwidth']}\" height=\"1\" hspace=\"0\" vspace=\"0\" border=\"0\"><br/>";
		else
			echo "<img src=\"{$cms['tngpath']}img/spacer.gif\" width=\"{$pedigree['halfwidth']}\" height=\"1\" hspace=\"0\" vspace=\"0\" border=\"0\"><br/>";
		if( $box['lineinto'] == 1 )
			echo "<img src=\"{$cms['tngpath']}img/black.gif\" width=\"1\" height=\"20\" hspace=\"0\" vspace=\"0\" border=\"0\">";
		else
			echo "<img src=\"{$cms['tngpath']}img/spacer.gif\" width=\"1\" height=\"20\" hspace=\"0\" vspace=\"0\" border=\"0\">";
	}
	else
		echo "<img src=\"{$cms['tngpath']}img/spacer.gif\" width=\"1\" height=\"21\" hspace=\"0\" vspace=\"0\" border=\"0\">";

	//name section
	//outer table with border
	echo "<div class=\"popup trackerbox\" style=\"width:{$boxwidth}px; height:{$boxheight}px; background-color:$bgcolor; padding: {$pedigree['cellpad']}px; overflow:hidden\">\n";
	
	//inner table
	echo "<table cellpadding=\"0\" cellspacing=\"0\" style=\"margin:0px\">\n<tr><td valign=\"top\">";
	$name = "";
	if( !empty($person['personID']) )
		$name = getName( $person );
	$nameinfo = $name != "" ? "<a href=\"$getperson_url" . "personID={$person['personID']}&amp;tree=$tree\"><span style=\"font-size:11pt\">$name</span></a>" : "";
	if( !empty($person['personID']) && $pedigree['inclphotos'] ) {
		$constoffset = 0;
		$photohtouse = $pedigree['puboxheight'] - $constoffset - ( $pedigree['cellpad'] * 2 ) - 2; // take cellpadding into account
		echo showSmallPhoto( $person['personID'], $name, $person['allow_living'] && $person['allow_private'], $photohtouse, false, $person['sex'] );
	}
	if( !empty($person['allow_living']) && !empty($person['allow_private']) ) {
		if( !empty($person['birth']) || !empty($person['death']) ) {
			if( !$person['birth'] ) $person['birth'] = "";
			if( !$person['death'] ) $person['death'] = "";
			$person['birthdate'] = $person['altbirthdate'] = $person['deathdate'] = $person['burialdate'] = "";
			$person['birthdatetr'] = $person['altbirthdatetr'] = $person['deathdatetr'] = $person['burialdatetr'] = "0000-00-00"; //Don't do age calculation.
			$nameinfo .= "<br/>" . getYears($person);
		}
	}
	echo "</td>\n<td width=\"100%\" align=\"center\" class=\"normal\">$nameinfo";
	//end inner table
	echo "</td>\n</tr></table>\n";
	
	//end outer table with border
	echo "</div>";
	
	//bottom border
	if( $more && $box['lineoutof'] )
		echo "<img src=\"{$cms['tngpath']}img/black.gif\" width=\"1\" height=\"20\" hspace=\"0\" vspace=\"0\" border=\"0\"><br/>";
	else
		echo "<img src=\"{$cms['tngpath']}img/spacer.gif\" width=\"1\" height=\"20\" hspace=\"0\" vspace=\"0\" border=\"0\"><br/>";

	if( $more ) {
		if( $box['bottomleft'] )
			echo "<img src=\"{$cms['tngpath']}img/black.gif\" width=\"{$pedigree['halfwidth']}\" height=\"1\" hspace=\"0\" vspace=\"0\" border=\"0\">";
		else
			echo "<img src=\"{$cms['tngpath']}img/spacer.gif\" width=\"{$pedigree['halfwidth']}\" height=\"1\" hspace=\"0\" vspace=\"0\" border=\"0\">";
		if( $box['bottomleft'] || $box['bottomright'] || $box['lineoutof'] ) 
			echo "<img src=\"{$cms['tngpath']}img/black.gif\" width=\"1\" height=\"1\" hspace=\"0\" vspace=\"0\" border=\"0\">";
		if( $box['bottomright'] )
			echo "<img src=\"{$cms['tngpath']}img/black.gif\" width=\"{$pedigree['halfwidth']}\" height=\"1\" hspace=\"0\" vspace=\"0\" border=\"0\">";
		else
			echo "<img src=\"{$cms['tngpath']}img/spacer.gif\" width=\"{$pedigree['halfwidth']}\" height=\"1\" hspace=\"0\" vspace=\"0\" border=\"0\">";
	}
	
	//end main area
	echo "</td>";
	
	//right margin
	drawEmpty( $box['topright'], $box['middleright'], $box['bottomright'] );

	//end, entire square
	echo "</tr></table></td>";
}

function drawEmpty( $top, $middle, $bottom ) {
	global $pedigree, $more, $cms;

	echo "<td align=\"center\">";
	if( $top ) {
		echo "<img src=\"{$cms['tngpath']}img/black.gif\" width=\"5\" height=\"1\" hspace=\"0\" vspace=\"0\" border=\"0\"><br/>";
		echo "<img src=\"{$cms['tngpath']}img/spacer.gif\" width=\"1\" height=\"20\" hspace=\"0\" vspace=\"0\" border=\"0\">";
	}
	else
		echo "<img src=\"{$cms['tngpath']}img/spacer.gif\" width=\"1\" height=\"21\" hspace=\"0\" vspace=\"0\" border=\"0\">";

	echo "<table width=\"5\" height=\"{$pedigree['puboxheight']}\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td>\n";
	if( $middle )
		echo "<img src=\"{$cms['tngpath']}img/black.gif\" width=\"5\" height=\"1\" hspace=\"0\" vspace=\"0\" border=\"0\">";
	echo "</td></tr></table>";

	if( $bottom && $more ) {
		echo "<img src=\"{$cms['tngpath']}img/spacer.gif\" width=\"1\" height=\"20\" hspace=\"0\" vspace=\"0\" border=\"0\"><br/>";
		echo "<img src=\"{$cms['tngpath']}img/black.gif\" width=\"5\" height=\"1\" hspace=\"0\" vspace=\"0\" border=\"0\">";
	}
	else
		echo "<img src=\"{$cms['tngpath']}img/spacer.gif\" width=\"1\" height=\"21\" hspace=\"0\" vspace=\"0\" border=\"0\">";
	echo "</td>";
}

function doNextPerson( $row, $items, $nextperson, $box ) {
	global $tree, $text, $childcount, $pedigree, $totkids, $more, $righttree;
	
	$nextnextfamily = count($items) ? $items[0] : "";
	if( $row['personID'] == $nextperson && $nextnextfamily ) {
		$result3 = null;
		if( $row['sex'] == "M" )
			$result3 = getParentDataCrossPlusDates($tree, $nextnextfamily, "husband", $row['personID'], "wife");
		else if( $row['sex'] == "F" )
			$result3 = getParentDataCrossPlusDates($tree, $nextnextfamily, "wife", $row['personID'], "husband");
		else {
			$result4 = getSpouseFamilyDataUnion($tree, $nextperson);
			$whichparent = tng_fetch_assoc( $result4 );
			tng_free_result( $result4 );
			if( $whichparent['husband'] == $nextperson ) {
				$result3 = getParentDataCrossPlusDates($tree, $nextnextfamily, "husband", $row['personID'], "wife");
			} else {
				$result3 = getParentDataCrossPlusDates($tree, $nextnextfamily, "wife", $row['personID'], "husband");
			}
		}
		$spouserow = tng_fetch_assoc( $result3 );
		tng_free_result( $result3 );
		if( $spouserow ) {
			$rightbranch = $righttree ? checkbranch($spouserow['branch']) : false;
			$srights = determineLivingPrivateRights($spouserow, $righttree, $rightbranch);
			$spouserow['allow_living'] = $srights['living'];
			$spouserow['allow_private'] = $srights['private'];
		}
		else
			$spouserow = array();
		
		$savechildcount = $childcount;
		$childcount++;
		if( $box['lineinto'] ) {
			$box['topright'] = $childcount == $totkids ? 0 : 1;
			$box['topleft'] = $childcount != $totkids ? 1 : 0;
			//if( ( $box[bottomleft] && !$box[bottomright] ) || $childcount == $totkids ) $box[bottomleft] = 0;
			//if( $childcount == $totkids ) $box[bottomright] = 0;
			//if( !$box[bottomleft] && $box[bottomright] ) $box[bottomleft] = 1;
			$box['bottomright'] = $childcount > $totkids / 2 ? 0 : 1;
			$box['bottomleft'] = $childcount > ($totkids + 1) / 2 ? 0 : 1;
		}	
		else {
			$box['bottomleft'] = $box['bottomright'] = 0;
		}
		$box['lineinto'] = 2;
		$box['lineoutof'] = 0;
		$box['middleleft'] = 1;
		$box['middleright'] = 0;
		//echo "tl=$box[topleft], tr=$box[topright], bl=$box[bottomleft], br=$box[bottomright]";
		$spouserow['birthdatetr'] = $spouserow['altbirthdatetr'] = "0000-00-00"; //this is to suppress the age calculation on the chart
		drawBox( $spouserow, $box );  //yes, that's intentional
	}
}

function getBox( $childcount, $totkids, $thisisit, $gotnext ) {
	global $more;
	
	$box = array();
	
	$box['lineoutof'] = $thisisit;
	$thisside = ( $childcount < ( ( $totkids / 2 ) + .5 ) ) && $gotnext ? 1 : 0;
	$thatside = ( $childcount > ( ( $totkids / 2 ) + .5 ) ) && ( !$gotnext || $box['lineoutof'] ) ? 1 : 0;
	$middle = $childcount == ( $totkids / 2 ) + .5;
	//echo "this=$thisside, that=$thatside, mid=$middle, cc=$childcount, tk=$totkids, gn=$gotnext, ";
	$box['topright'] = ( $childcount == $totkids ) || ( ( $childcount == $totkids - 1 ) && $thisisit && !$thisside && $more ) ? 0 : 1;
	$box['topleft'] = $childcount != 1 ? 1 : 0;
	if( $thisside ) {
		if( $box['lineoutof'] ) {
			$box['bottomright'] = 1;
			$box['bottomleft'] = 0;
		}
		else {
			$box['bottomright'] = 1;
			$box['bottomleft'] = 1;
		}
	}
	elseif( $thatside ) {
		if( $box['lineoutof'] ) {
			$box['bottomright'] = 0;
			$box['bottomleft'] = 1;
		}
		else {
			$box['bottomright'] = 1;
			$box['bottomleft'] = 1;
		}
	}
	elseif( $middle ) {
		$box['bottomright'] = $thisisit || $gotnext ? 0 : 1;
		$box['bottomleft'] = $thisisit || !$gotnext ? 0 : 1;
	}
	$box['lineinto'] = 1;
	
	return $box;
}

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

$boxheight = $pedigree['puboxheight'] + 2;
$boxwidth = $pedigree['puboxwidth'];

$pedigree['colorshift'] = 33;
$pedigree['cellpad'] = 5;
$pedigree['puboxheight'] += 14;

$pedigree['halfwidth'] = floor($pedigree['puboxwidth'] / 2) + 6;
$pedigree['phototree'] = $tree;
if( $tree ) $pedigree['phototree'] .= ".";

$items = explode( ",", $trail );
$personID = $nextperson = array_shift( $items );
if( $nextperson ) {
	$result = getPersonFullPlusDates($tree, $nextperson);
	$row = tng_fetch_assoc( $result );
	tng_free_result( $result );
	$descname = $logname = "";
	if( $row ) {
		$rightbranch = $righttree ? checkbranch($row['branch']) : false;

		$rights = determineLivingPrivateRights($row, $righttree, $rightbranch);
		$row['allow_living'] = $rights['living'];
		$row['allow_private'] = $rights['private'];

		$descname = getName( $row );
		$logname = $tngconfig['nnpriv'] && $row['private'] ? $admtext['text_private'] : ($nonames && $row['living'] ? $text['living'] : $descname);
	}

	$treeResult = getTreeSimple($tree);
	$treerow = tng_fetch_assoc($treeResult);
	$disallowgedcreate = $treerow['disallowgedcreate'];
	tng_free_result($treeResult);

	writelog( "<a href=\"$desctracker_url" . "trail=$trail&amp;tree=$tree\">{$text['descendfor']} $logname ($personID)</a>" );
	preparebookmark( "<a href=\"$desctracker_url" . "trail=$trail&amp;tree=$tree\">{$text['descendfor']} $descname ($personID)</a>" );
} else {
	$descname = "";
	$rights['both'] = 0;
	$row['allow_living'] = 0;
	$row['allow_private'] = 0;
	$row['sex'] = "";
}

	tng_header( $descname, $flags );

	$photostr = showSmallPhoto( $personID, $descname, $rights['both'], 0, false, $row['sex'] );
	echo tng_DrawHeading( $photostr, $descname, getYears( $row ) );
	$row['deathdatetr'] = $row['burialdatetr'] = "0000-00-00"; //this is to suppress the age calculation on the chart

	if( !$pedigree['maxdesc'] ) $pedigree['maxdesc'] = 12;
	if( !$pedigree['initdescgens'] ) $pedigree['initdescgens'] = 8;
	if( empty($generations) )
	    $generations = $pedigree['initdescgens'] > 8 ? 8 : $pedigree['initdescgens'];
	else if( $generations > $pedigree['maxdesc'] )
		$generations = $pedigree['maxdesc'];
	else
		$generations = intval( $generations );

	$innermenu = "<a href=\"$descend_url" . "personID=$personID&amp;tree=$tree&amp;display=standard&amp;generations=$generations\" class=\"lightlink\">{$text['pedstandard']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"$descend_url" . "personID=$personID&amp;tree=$tree&amp;display=compact&amp;generations=$generations\" class=\"lightlink\">{$text['pedcompact']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"$descendvert_url" . "personID=$personID&amp;tree=$tree&amp;&amp;generations=$generations\" class=\"lightlink\">{$text['pedvertical']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"$descendtext_url" . "personID=$personID&amp;tree=$tree&amp;generations=$generations\" class=\"lightlink3\">{$text['pedtextonly']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"$register_url" . "personID=$personID&amp;tree=$tree&amp;generations=$generations\" class=\"lightlink\">{$text['regformat']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
	$innermenu .= "<a href=\"$descendtables_url" . "personID=$personID&amp;tree=$tree&amp;generations=$generations\" class=\"lightlink\">{$text['dtformat']}</a>\n";

	echo getFORM( "descend", "GET", "form1", "form1" );
	echo tng_menu( "I", "descend", $personID, $innermenu );
	echo "</form>\n";
?>
<br clear="left">

<div width="100%" style="overflow:auto">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center">
<?php
$more = count( $items );
if( $nextperson ) {
	echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n<tr>\n";
	$box = array();
	$box['lineinto'] = 0;
	$box['lineoutof'] = 1;
	$box['topleft'] = $box['topright'] = 0;
	$childcount = $totkids = 1;
	$box['bottomright'] = $more ? 1 : 0;
	$box['bottomleft'] = 0;
	$box['middleright'] = 1;
	$box['middleleft'] = 0;
	drawBox( $row, $box );
	doNextPerson( $row, $items, $nextperson, $box );
	echo "</tr>\n</table>\n";
	if( $more )
		echo "<img src=\"{$cms['tngpath']}img/black.gif\" width=\"1\" height=\"20\" hspace=\"0\" vspace=\"0\" border=\"0\"><br/>";
}
while( $more ) {
	$lineinfo = array();
	$linelength = 0;
	$gotnext = 0;
	$nextfamily = array_shift( $items );
	$nextperson = array_shift( $items );
	$more = count( $items );
		
	//get kids
	$result2 = getChildrenDataPlusDates($tree, $nextfamily);
	if( $result2 ) {
		//echo "<img src=\"{$cms['tngpath']}img/black.gif\" width=\"1\" height=\"20\" hspace=\"0\" vspace=\"0\" border=\"0\">";
		echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n<tr>\n";
		$totkids = tng_num_rows( $result2 );
		if( $more ) $totkids++;
		$childcount = 0;
		$linestart = 0;
		$lineend = 0;
		$firsthalf = 0;
		$secondhalf = 0;
		$middle = 0;
		while( $row = tng_fetch_assoc( $result2 ) ) {
			$childcount++;

			$rights = determineLivingPrivateRights($row, $righttree);
			$row['allow_living'] = $rights['living'];
			$row['allow_private'] = $rights['private'];

			if( $row['personID'] == $nextperson ) {
				$gotnext = 1;
				$firsthalf = $childcount < ( $totkids / 2 ) ? 1 : 0;
				$secondhalf = $childcount > ( $totkids / 2 ) ? 1 : 0;
				$thisisit = 1;
				$linestart = 1;
				$lineend = $firsthalf ? 0 : 1;
				$middle = $childcount == ( $totkids / 2 + 0.5) ? 1 : 0;
			}
			else {
				$thisisit = 0;
				$middle = $childcount == ( $totkids / 2 + 0.5) ? 1 : 0;
				$middle = $middle || !($childcount < ( $totkids / 2 ) || $childcount > ( $totkids / 2 )) ? 1 : 0;
				if ($secondhalf || $middle)
					$secondhalf = 1;
				if ($firsthalf && ($middle || $childcount > ( $totkids / 2 )))
					$lineend = 1;
				if (!$linestart && !$lineend && $middle)
					$linestart = 1;
			}

			$row['birthdatetr'] = $row['altbirthdatetr'] = "0000-00-00"; //this is to suppress the age calculation on the chart
			$box = getBox( $childcount, $totkids, $thisisit, $gotnext );
			$box['middleleft'] = 0;
			$box['middleright'] = $thisisit && $more ? 1 : 0;
			
			$box['bottomright'] = $more && ((!$lineend && ($firsthalf || $secondhalf) && !$middle) || ($thisisit && !$firsthalf && !$secondhalf) || (!$thisisit && $secondhalf && !$lineend && ($middle && ($totkids % 2 == 1))) || ($firsthalf && $middle && $lineend && ($totkids % 2 == 0))) ? 1 : 0;
			$box['bottomleft'] = $more && (($linestart && !$lineend && !$thisisit && $firsthalf) || ($firsthalf && $middle) || ($thisisit && $middle && ($totkids % 2 != 1)) || ($secondhalf && $linestart && !$lineend && !$middle) || ($thisisit && $secondhalf && !$middle)) ? 1 : 0;
			//if ($middle) echo "Center: ";
			//echo "tl={$box['topleft']}, tr={$box['topright']}, ml={$box['middleleft']}, mr={$box['middleright']}, bl={$box['bottomleft']}, br={$box['bottomright']}, cc=$childcount, tk=$totkids, gn=$gotnext, tii=$thisisit, m=$more, fn={$row['firstname']}, ln={$row['lastname']}, fh=$firsthalf, sh=$secondhalf, ls=$linestart, le=$lineend<br/>\n";
			drawBox( $row, $box );
			doNextPerson( $row, $items, $nextperson, $box );
		}
		echo "</tr>\n</table>";
	}
	if( $more ) {
		echo "<img src=\"{$cms['tngpath']}img/black.gif\" width=\"1\" height=\"20\" hspace=\"0\" vspace=\"0\" border=\"0\"><br/>";
	}
	tng_free_result( $result2 );
}
?>
		</td>
	</tr>
</table>
</div>
<?php
	tng_footer( "" );
?>