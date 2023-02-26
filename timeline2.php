<?php
$textpart = "timeline";
include("tng_begin.php");

include($subroot . "pedconfig.php" );
include("timelineconfig.php" );

if( !isset($pedigree['event']) ) $pedigree['event'] = "over";
$timeline = $_SESSION['timeline'];
$tng_message = $_SESSION['tng_message'];
$primaryID = preg_replace("/[^A-Za-z0-9_\-. ]/", '', $primaryID);
if( !is_array( $timeline ) ) {
	header("Location:" . getURL("timeline",1) . "primaryID=$primaryID&tree=$tree");
	exit;
}
//$timeline = array();

$findpersonform_url = getURL( "findpersonform", 1 );
$getperson_url = getURL( "getperson", 1 );

$tlmonths[0] = "";
$tlmonths[1] = $dates['JAN'];
$tlmonths[2] = $dates['FEB'];
$tlmonths[3] = $dates['MAR'];
$tlmonths[4] = $dates['APR'];
$tlmonths[5] = $dates['MAY'];
$tlmonths[6] = $dates['JUN'];
$tlmonths[7] = $dates['JUL'];
$tlmonths[8] = $dates['AUG'];
$tlmonths[9] = $dates['SEP'];
$tlmonths[10] = $dates['OCT'];
$tlmonths[11] = $dates['NOV'];
$tlmonths[12] = $dates['DEC'];

$minwidth = 100;
$maxwidth = 1600;
$lineoffset = 44;  //starting column for vertical gray lines (pixels from left)
if( $chartwidth && is_numeric( $chartwidth ) ) {
	if( $chartwidth < $minwidth )
		$chartwidth = $minwidth;
	elseif( $chartwidth > $maxwidth )
		$chartwidth = $maxwidth;
}
elseif(!empty($_SESSION['timeline_chartwidth']))
	$chartwidth = $_SESSION['timeline_chartwidth'];
elseif($pedigree['tcwidth'])
	$chartwidth = $pedigree['tcwidth'];
else
	$chartwidth = 500;  //chart width in pixels (from first to last gray line)
$checkboxcellwidth = 48;  //width of table cell holding "delete" checkboxes. If bars do not line up with gray lines, adjust this value up or down accordingly
$divisions = 5;  //number of chart segments

$result = getPersonDataPlusDates($tree, $primaryID);
if( $result ) {
	$row = tng_fetch_assoc( $result );
	$righttree = checktree($tree);
	$rightbranch = checkbranch($row['branch']);
	$rights = determineLivingPrivateRights($row, $righttree, $rightbranch);
	$row['allow_living'] = $rights['living'];
	$row['allow_private'] = $rights['private'];
	$namestr = getName( $row );
	$logname = $tngconfig['nnpriv'] && $row['private'] ? $admtext['text_private'] : ($nonames && $row['living'] ? $text['living'] : $namestr);
	tng_free_result($result);
}

$treeResult = getTreeSimple($tree);
$treerow = tng_fetch_assoc($treeResult);
$disallowgedcreate = $treerow['disallowgedcreate'];
tng_free_result($treeResult);

function getEvents($person) {
	global $text, $ratio, $getperson_url, $righttree;
	
	$personID = $person['personID'];
	$tree = $person['tree'];
	$events = array();
	$eventstr = "";
	$leftoffset = 3;
	$maxleft = 0;
	$perswidth = 300;
	$eventwidth = 170;

	//born OR christened
	if( $person['birthdate'] ) {
		$index = $person['birthdatetr'];
		$events[$index]['date'] = displayDate($person['birthdate']);
		$events[$index]['text'] = $text['born'] . ":";
	}
	elseif( $person['altbirthdate'] ) {
		$index = $person['altbirthdatetr'];
		$events[$index]['date'] = displayDate($person['altbirthdate']);
		$events[$index]['text'] = $text['christened'] . ":";
	}
	$events[$index]['year'] = $person['birth'];
	$events[$index]['left'] = $leftoffset;
	if( $events[$index]['left'] + $eventwidth > $maxleft ) $maxleft = $events[$index]['left'] + $eventwidth;
	
	//custom events
	
	//marriages
	//get person's gender
	if( $person['sex'] == "M" ) {
		$self = "husband"; $spouse = "wife"; $spouseorder = "husborder";
	}
	elseif( $person['sex'] == "F" ) {
		$self = "wife"; $spouse = "husband"; $spouseorder = "wifeorder";
	}
	else {
		$self = ""; $spouse = ""; $spouseorder = "";
	}
	//get and loop through all marriages (link to people table on opposite spouse) for this person based on gender
	if( $spouseorder )
		$marriages = getSpouseFamilyDataPlusDates($person['tree'], $self, $personID, $spouseorder);
	else
		$marriages = getSpouseFamilyDataUnionPlusDates($person['tree'], $personID);
	if( !tng_num_rows($marriages) && $spouseorder) {
	    $marriages = getSpouseFamilyDataUnionPlusDates($person['tree'], $personID);
	}

	while ( $marriagerow =  tng_fetch_assoc( $marriages ) ) {
		//do event for marriage date and person (observe living rights)
		if( !$spouseorder )
			$spouse = $marriagerow['husband'] == $personID ? 'wife' : 'husband';
		unset($spouserow);
		if( $marriagerow[$spouse] ) {
			$spouseresult= getPersonSimple($person['tree'], $marriagerow[$spouse]);
			$spouserow =  tng_fetch_assoc( $spouseresult );
			$srights = determineLivingPrivateRights($spouserow, $righttree);
			$spouserow['allow_living'] = $srights['living'];
			$spouserow['allow_private'] = $srights['private'];
			if( $spouserow['firstname'] || $spouserow['lastname'] ) {
				$spousename = getName( $spouserow );
				$spouselink = "<a href=\"$getperson_url" . "personID={$spouserow['personID']}&amp;tree=$tree\">$spousename</a>";
			}
			tng_free_result( $spouseresult );
		}
		else
			$spouselink = "";
		$rightfbranch = checkbranch( $marriagerow['branch'] ) ? 1 : 0;
		$mrights = determineLivingPrivateRights($marriagerow, $righttree, $rightfbranch);
		$marriagerow['allow_living'] = $mrights['living'];
		$marriagerow['allow_private'] = $mrights['private'];

		if( $mrights['both'] ) {
			$index = str_replace("/","-",$marriagerow['marrdatetr']);
			if($index != "0000-00-00") {
				$events[$index]['date'] = displayDate($marriagerow['marrdate']);
				$events[$index]['text'] = $text['married'] . " $spouselink:";
	   			$events[$index]['year'] = $marriagerow['marryear'];
	   			$marriagerow['marryear'] = strtok($marriagerow['marryear'],'/');
				$events[$index]['left'] = intval( $ratio * ($marriagerow['marryear'] - $person['birth'])) + $leftoffset;
				if( $events[$index]['left'] + $perswidth > $maxleft ) $maxleft = $events[$index]['left'] + $perswidth;
			}
		}
		//get all children (link to people) born to this marriage
		//loop through and make event for each
		$children= getChildrenDataPlusDates($person['tree'], $marriagerow['familyID']);

		while ( $child =  tng_fetch_assoc( $children ) ) {
			$crights = determineLivingPrivateRights($child, $righttree);
			$child['allow_living'] = $crights['living'];
			$child['allow_private'] = $crights['private'];
			if( $crights['both'] ) {
				if( $child['firstname'] || $child['lastname'] ) {
					$childname = getName( $child );
					$childlink = "<a href=\"$getperson_url" . "personID={$child['personID']}&amp;tree={$person['tree']}\">$childname</a>";
				}
				else
					$childlink = "";
				if( $child['birthdate'] ) {
					$index = str_replace("/","-",$child['birthdatetr']) . sprintf("%2d",$child['ordernum']);
					$events[$index]['date'] = displayDate($child['birthdate']);
					$events[$index]['text'] = $text['child'] . " $childlink " . $text['birthabbr'];
				}
				elseif( $child['altbirthdate'] ) {
					$index = str_replace("/","-",$child['altbirthdatetr']) . sprintf("%2d",$child['ordernum']);
					$events[$index]['date'] = displayDate($child['altbirthdate']);
					$events[$index]['text'] = $text['child'] . " $childlink " . $text['chrabbr'];
				}
				else
					$index = "";
				if($index) {
	   				$events[$index]['year'] = $child['birth'];
	   				$child['birth'] = strtok($child['birth'],'/');
					$events[$index]['left'] = intval( $ratio * ($child['birth'] - $person['birth'])) + $leftoffset;
					if( $events[$index]['left'] + $perswidth > $maxleft ) $maxleft = $events[$index]['left'] + $perswidth;
				}
			}
		}
		tng_free_result( $children );
	}
	tng_free_result( $marriages );
	
	//died OR buried
	if( $person['deathdate'] || $person['burialdate'] ) {
		if( $person['deathdate'] ) {
			$index = str_replace("/","-",$person['deathdatetr']);
			$events[$index]['date'] = displayDate($person['deathdate']);
			$events[$index]['text'] = $text['died'] . ":";
		}
		elseif( $person['burialdate'] ) {
			$index = $person['burialdatetr'];
			$events[$index]['date'] = displayDate($person['burialdate']);
			$events[$index]['text'] = $text['buried'] . ":";
		}
		else
			$index = "";
		if($index) {
			$events[$index]['year'] = $person['death'];
			$events[$index]['left'] = intval( $ratio * ($person['death'] - $person['birth'])) + $leftoffset;
			if( $events[$index]['left'] + $eventwidth > $maxleft ) $maxleft = $events[$index]['left'] + $eventwidth;
		}
	}

	//loop through and format
	ksort( $events );
	foreach( $events as $event ) {
   		//$eventstr .= "<div style=\"position:relative; top:0px; left:$event['left']px; width:$maxleft" . "px;\">\n";
    		$eventstr .= "<div class=\"tlevent\" style=\"margin-left:{$event['left']}px;\">\n";
		$eventstr .= "<table border=\"0\" cellspacing=\"0\" cellpadding=\"1\"><tr><td class=\"pboxpopup nw\"><span class=\"normal\">&gt; ";
		$eventstr .= "{$event['year']} - {$event['text']} {$event['date']} &nbsp;</span></td></tr></table></div>\n";
	}
	
	return $eventstr;
}

$timeline_url = getURL( "timeline", 1 );
writelog( "<a href=\"$timeline_url" . "primaryID=$primaryID&amp;tree=$tree\">{$text['timeline']} ($logname)</a>" );
preparebookmark( "<a href=\"$timeline_url" . "primaryID=$primaryID&amp;tree=$tree\">{$text['timeline']} ($namestr)</a>" );

$keeparray = array();
$earliest = intval(date('Y'));
$latest = 0;
foreach( $timeline as $timeentry ) {
	parse_str( $timeentry, $output );
	$query = "SELECT firstname, lnprefix, lastname, prefix, suffix, nameorder, title, living, private, branch, gedcom, sex, personID,
		IF(birthdatetr !='0000-00-00',YEAR(birthdatetr),YEAR(altbirthdatetr)) as birth, 
		IF(deathdatetr !='0000-00-00',YEAR(deathdatetr),YEAR(burialdatetr)) as death,
		birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr, burialdate, burialdatetr
		FROM $people_table WHERE personID = \"{$output['timeperson']}\" AND gedcom = \"{$output['timetree']}\"";
	$result2 = tng_query($query);
	if( $result2 ) {
		$row2 = tng_fetch_assoc( $result2 );
		$newtimeentry = array();
		$newtimeentry['personID'] = $output['timeperson'];
		$newtimeentry['tree'] = $output['timetree'];
		$displaydeath = $row2['death'] ? $row2['death'] : "";
		$rights2 = determineLivingPrivateRights($row2, $righttree);
		$row2['allow_living'] = $rights2['living'];
		$row2['allow_private'] = $rights2['private'];
		$namestr2 = getName( $row2 );
		if($rights2['both']) {
			$namestr2 .= " ({$row2['birth']} - $displaydeath)";

			$newtimeentry['birth'] = $row2['birth'];
			if($row2['death']) {
				$newtimeentry['death'] = $row2['death'];
			}
			else {
				$defaultage = intval(date("Y")) - intval($row2['birth']);
				$newtimeentry['death'] = intval($row2['birth']) + ($defaultage < 110 ? $defaultage : 110);
			}

			$newtimeentry['lifespan'] = $newtimeentry['death'] - $newtimeentry['birth'];
			$newtimeentry['birthdate'] = $row2['birthdate'];
			$newtimeentry['birthdatetr'] = $row2['birthdatetr'];
			$newtimeentry['altbirthdate'] = $row2['altbirthdate'];
			$newtimeentry['altbirthdatetr'] = $row2['altbirthdatetr'];
			$newtimeentry['deathdate'] = $row2['deathdate'];
			$newtimeentry['deathdatetr'] = $row2['deathdatetr'];
			$newtimeentry['burialdate'] = $row2['burialdate'];
			$newtimeentry['burialdatetr'] = $row2['burialdatetr'];
			$newtimeentry['sex'] = $row2['sex'];

			if( $newtimeentry['birth'] < $earliest )
				$earliest = $newtimeentry['birth'];
			if( $newtimeentry['death'] > $latest )
				$latest = $newtimeentry['death'];
		}
		$newtimeentry['name'] = "<a href=\"$getperson_url" . "personID={$output['timeperson']}&amp;tree={$output['timetree']}\">$namestr2</a>";
		array_push( $keeparray, $newtimeentry );
		tng_free_result($result2);
	}
}

//get all events that fall in time period
//loop through and use year as index in array
//append if duplicate years
if(!$latest) $latest = 0;
if(!$earliest) $earliest = 0;
$tlquery = "SELECT evday, evmonth, evyear, evtitle, evdetail, endday, endmonth, endyear
	FROM $tlevents_table
	WHERE (evyear * 1 <= $latest * 1 AND endyear * 1 >= $earliest * 1) OR (endyear = \"\" AND (evyear BETWEEN \"$earliest\" AND \"$latest\"))
	ORDER BY evyear * 1, evmonth, evday";
//WHERE (evyear BETWEEN \"$earliest\" AND \"$latest\") OR (endyear BETWEEN \"$earliest\" AND \"$latest\") OR ((evyear <= \"$earliest\") AND (endyear >= \"$latest\"))

$tlresult = tng_query($tlquery) or die ($text['cannotexecutequery'] . ": $tlquery");
$tlevents = array();
$tlevents2 = array();
while( $tlrow = tng_fetch_assoc($tlresult)) {
	$evyear = $tlrow['evyear'];
	if($evyear < $earliest)
		$earliest = $evyear;
	if($tlrow['endyear'] > $latest)
		$latest = $tlrow['endyear'];
	if($tlrow['evday'] == "0") $tlrow['evday'] = "";
	if($tlrow['endday'] == "0") $tlrow['endday'] = "";

	$daymonth = trim($tlrow['evday'] . " " . $tlmonths[$tlrow['evmonth']]);
	$daymonth .= $daymonth ? " " . $evyear : $evyear;

	$enddate = trim($tlrow['endday'] . " " . $tlmonths[$tlrow['endmonth']] . " " . $tlrow['endyear']);
	$enddate = $enddate ? "&mdash;$enddate" : "";

	$newentry = !empty($tlevents[$evyear]) ? $tlevents[$evyear] . "\n - " : " - ";
	if($daymonth || $enddate)
		$newentry .= $daymonth . $enddate . " ";
       if($tlrow['evtitle']) {
           $evtitle = $tlrow['evtitle'];
           $evdetail = $tlrow['evdetail'] ? "<br />" . $tlrow['evdetail'] : "";
       }
       else {
           $evtitle = $tlrow['evdetail'];
           $evdetail = "";
       }
	$tlevents[$evyear] = $newentry . preg_replace("/\"/", "&#34;",$evtitle);
	$newstring = $daymonth || $enddate ? "<li>$daymonth$enddate" . ": $evtitle$evdetail</li>" : "<li>$evtitle$evdetail</li>";
	$tlevents2[$evyear] = !empty($tlevents2[$evyear]) ? $tlevents2[$evyear] . "\n$newstring" : $newstring;
}
tng_free_result( $tlresult );


if( !$latest && !count( $timeline ) ) $latest = $earliest;
$totalspan = $latest - $earliest;
$ratio = $totalspan ? $chartwidth / $totalspan : 0;
$spanheight = 30 + count( $keeparray ) * 29;

$flags['scripting'] = "<script type=\"text/javascript\" src=\"{$cms['tngpath']}js/selectutils.js\"></script>\n";
$personID = $primaryID;

$mpct = !empty($pedigree['mpct']) ? $pedigree['mpct'] : 0;
$ypct = !empty($pedigree['ypct']) ? $pedigree['ypct'] : 100 - $mpct;
$ymult = !empty($pedigree['ymult']) ? $pedigree['ymult'] : 10;
$ypixels = !empty($pedigree['ypixels']) ? $pedigree['ypixels'] : 10;
$mpixels = !empty($pedigree['mpixels']) ? $pedigree['mpixels'] : 50;

if($row['death']) {
	$deathage = intval($row['death']) - intval($row['birth']);
}
else {
	$defaultage = intval(date("Y")) - intval($row['birth']);
	$deathage = $defaultage < 110 ? $defaultage : 110;
}

if($pedigree['simile']) {
	$flags['scripting'] .= "<script type=\"text/javascript\">
		var tlstartdate = \"" . ($row['birth'] + floor($deathage/2)) . "\";
		var xmlfamfile = \"" . getURL("ajx_famtimelinexml",1) . "earliest=$earliest&latest=$latest&primary=$primaryID\";
		var xmleventfile = \"" . getURL("ajx_timelinexml",1) . "earliest=$earliest&latest=$latest\";
		var band1_pct = \"" . $band1_pct . "%\";
		var band1_interval = \"" . $band1_interval . "\";
		var band1_multiple = " . $band1_multiple . ";
		var band2_pct = \"" . $band2_pct . "%\";
		var band2_interval = \"" . $band2_interval . "\";
		var band2_multiple = " . $band2_multiple . ";
		var band3_pct = \"" . $band3_pct . "%\";
		var band3_interval = \"" . $band3_interval . "\";
		var band3_multiple = " . $band3_multiple . ";
		var band4_pct = \"" . $band4_pct . "%\";
		var band4_interval = \"" . $band4_interval . "\";
		var band4_multiple = " . $band4_multiple . ";
		var Timeline_ajax_url = \"" . $cms['tngpath'] ."timeline_2.3.1/timeline_ajax/simile-ajax-api.js\";
	    var Timeline_urlPrefix = \"" . $cms['tngpath'] ."timeline_2.3.1/timeline_js/\";
		var Timeline_parameters = 'bundle=true';
	</script>\n";
	$flags['scripting'] .= "<script type=\"text/javascript\" src=\"" . $cms['tngpath'] ."js/timeline.js\"></script>\n";
	$flags['scripting'] .= "<script type=\"text/javascript\" src=\"" . $cms['tngpath'] ."timeline_2.3.1/timeline_js/timeline-api.js\"></script>\n";
}
$flags['css'] = "<link href=\"{$cms['tngpath']}css/timeline.css?v=" . (filemtime($rootpath."css/timeline.css")) . "\" rel=\"stylesheet\" type=\"text/css\" />\n";
tng_header( $text['timeline'] . ": $namestr", $flags );

$photostr = showSmallPhoto( $primaryID, $namestr, $rights['both'], 0, false, $row['sex'] );
echo tng_DrawHeading( $photostr, $namestr, getYears( $row ) );

echo getFORM( "timeline", "post", "form1", "form1" );

$innermenu = $text['chartwidth'] . ": &nbsp;";
$innermenu .= "<input type=\"text\" name=\"newwidth\" class=\"verysmall\" value=\"$chartwidth\" maxlength=\"4\" size=\"4\" /> &nbsp;&nbsp; ";
$innermenu .= "<a href=\"#\" class=\"lightlink\" onclick=\"document.form1.submit();\">{$text['refresh']}</a>\n";

echo tng_menu( "I", "timeline", $primaryID, $innermenu );

echo "<span class=\"subhead\"><strong>{$text['timeline']}</strong></span><br/><br/>\n";

if($pedigree['simile'])
	echo "<div id=\"tngtimeline\" style=\"height: {$pedigree['tcheight']}px;\"></div>\n";

if( $tng_message ) {
	echo "<p><span class=\"normal\"><strong>$tng_message</strong></span></p>";
	$tng_message = $_SESSION['tng_message'] = "";
}
echo "<div id=\"tngchart\">";

$year = $earliest;
$displayyear = $year;
for( $i = $lineoffset; $i <= ($lineoffset+$chartwidth); $i+=($chartwidth/$divisions) ) {
	$iadj = $i - 12;
	echo "<div class=\"yeardiv normal\" style=\"left:$iadj" . "px;\">";
	if($pedigree['simile'])
		echo "<a href=\"#\" onclick=\"return centerTimeline($displayyear);\">$displayyear</a>";
	else
		echo $displayyear;
	echo "</div>\n";
	echo "<div class=\"vertlines cgray\" style=\"left:$i" . "px;height:$spanheight" . "px\"></div>\n";
	$year += $totalspan * .2;
	$displayyear = intval( $year + .5  );
}

$linklevel = 0;
$highestll = 0;
$linkoffset = 35;
$lastyo = -6;

$counter = 0;
foreach( $tlevents as $key=>$value ) {
	$yearoffset = $lineoffset + ($key - $earliest) * $ratio;
	if( $lastyo + 5 >= $yearoffset ) {
		if( $linklevel == 1 ) {
			$linklevel = 2;
			$linkoffset = 35;
			$highestll = 2;
		}
		else {
			$linklevel = 1;
			$linkoffset = 50;
		}
	}
	else {
		$linklevel = 0;
		$linkoffset = 35;
	}
	$lastyo = $yearoffset;
	$linkpos = $linkoffset + $spanheight;
	$eadj = $yearoffset - 3;
	$counter++;
	echo "<div class=\"vertlines dgray\" style=\"left:$yearoffset" . "px; height:$spanheight". "px\"></div>\n";
	echo "<div class=\"footnote\" style=\"top:$linkpos" . "px;left:$eadj" . "px;\"><a href=\"#events\" title=\"$key:\n$value\">$counter</a></div>\n";
}

$enddiv = "</div>";

echo "<span class=\"normal\"><br/><br/>\n";
if( count( $timeline ) > 1 )
	echo $text['text_delete'];
else
	echo "&nbsp;";
echo "</span>\n";

$top = 20;
$numlines = 0;
foreach( $keeparray as $timeentry ) {
	$numlines++;
	$top += 30;
	$spanleft = $lineoffset + intval($ratio * ( $timeentry['birth'] - $earliest ));
	$spanwidth = intval($ratio * $timeentry['lifespan']);
	echo "<div id=\"cb$numlines\" class=\"tlbar cb\" style=\"top:$top" . "px;width:$spanwidth" . "px;\">\n";
	if( $timeentry['personID'] == $primaryID && $timeentry['tree'] == $tree )
		echo "&nbsp;";
	else
		echo "<input type=\"checkbox\" name=\"{$timeentry['tree']}_{$timeentry['personID']}\" value=\"1\" />\n";
	echo "</div>\n";

	echo "<div id=\"bar$numlines\"  class=\"tlbar\" style=\"top:$top" . "px;left:$spanleft" . "px;width:$spanwidth" . "px;\" onmouse{$pedigree['event']}=\"setTimerShow($numlines,'{$pedigree['event']}');\" onmouseout=\"setTimerHide($numlines)\">\n";
	echo "<table cellspacing=\"0\" cellpadding=\"0\"><tr><td class=\"nw\"><span class=\"normal\">{$timeentry['name']}</span></td></tr><tr><td><div class=\"fieldnameback\" style=\"font-size:0;height:10px;padding:0px;width:$spanwidth" . "px;z-index:3\"></div></td></tr></table>\n";
	echo "</div>\n";

	echo "<div id=\"popup$numlines\" class=\"popup\" style=\"background-color:{$pedigree['popupcolor']}; top:" . ($top + 25) . "px; left:" . ($spanleft - 5) . "px;\" onmouseover=\"cancelTimer($numlines)\" onmouseout=\"setTimerHide($numlines)\">\n";
	echo "<table class=\"popuptable\" cellpadding=\"1\" cellspacing=\"0\"><tr><td>\n";

	$eventinfo = getEvents($timeentry);
	echo "$eventinfo</td></tr></table></div>\n";
	//echo "</div>\n";
}
if( $highestll == 1) echo "<br/><br/>";
elseif( $highestll == 2 ) echo "<br/><br/><br/>";
echo "<table width=\"" . ($chartwidth + $lineoffset + 20) . "\" style=\"height:$top" . "px\"><tr><td>&nbsp;</td></tr></table>";
?>

<br/><br/>
<input type="button" name="lines" class="btn" value="<?php echo $text['togglelines']; ?>" onclick="toggleLines();" />
<input type="button" name="addmore" class="btn" value="<?php echo $text['timelineinstr']; ?>" onclick="toggleAddMore();" />
<input type="submit" class="btn" value="<?php echo $text['refresh']; ?>" />
<div id="addmorediv" style="display:none;">
<?php
	echo "<span class=\"normal\"><br/><br/>";
	$query = "SELECT gedcom, treename FROM $trees_table ORDER BY treename";
	$treeresult = tng_query($query);
	$numrows = tng_num_rows( $treeresult );
	$newtime = time();
	for( $x = 2; $x < 6; $x++ ) {
		echo $text['addperson'] . ": ";
		if( $numrows > 1 ) {
			echo "<select name=\"nexttree$x\">\n";
			while( $treerow = tng_fetch_assoc($treeresult) ) {
				echo "	<option value=\"{$treerow['gedcom']}\"";
				if( $treerow['gedcom'] == $tree ) echo " selected=\"selected\"";
				echo ">{$treerow['treename']}</option>\n";
			}
			echo "</select>\n";
			$treestr = "document.form1.nexttree$x.options[document.form1.nexttree$x.selectedIndex].value";
		}
		else {
			echo "<input type=\"hidden\" name=\"nexttree$x\" value=\"$tree\" />";
			$treestr = "'" . $tree . "'";
		}
		echo "<input type=\"text\" name=\"nextpersonID$x\" id=\"nextpersonID$x\" size=\"10\" />  <input type=\"button\" name=\"find$x\" id=\"find$x\" value=\"{$text['find']}\" onclick=\"findItem('I','nextpersonID$x',null,$treestr);\" /><br/>\n";
		if( $x < 5 )
			$treeresult = tng_query($query);
	}
?>
<input type="hidden" name="tree" value="<?php echo $tree; ?>" />
<input type="hidden" name="primaryID" value="<?php echo $primaryID; ?>" />
<br/>
</span>
</div>
<br/>
</div>
</form><br/>

<?php
	if( $counter ) {
?>
<a name="events" id="events"></a>
<table cellpadding="3" cellspacing="1" border="0" width="100%" class="thfixed whiteback normal">
	<thead>
		<tr>
			<th class="fieldnameback" width="20">&nbsp;</th>
			<th class="fieldnameback fieldname" width="50"><strong>&nbsp;<?php echo $text['date']; ?></strong></th>
			<th class="fieldnameback fieldname"><strong>&nbsp;<?php echo $text['event']; ?></strong></th>
		</tr>
	</thead>
<?php
		$counter = 0;
		foreach( $tlevents2 as $key=>$value ) {
			$counter++;
			echo "<tr>\n";
			echo "<td class=\"databack\" valign=\"top\" align=\"right\"><span class=\"normal\">$counter&nbsp;</span></td>";
			echo "<td class=\"databack\" valign=\"top\"><span class=\"normal\">$key&nbsp;</span></td>";
			echo "<td class=\"databack\" valign=\"top\"><ul class=\"normal\">$value</ul></td>";
			echo "</tr>\n";
		}
?>
</table><br/>
<?php
	}
?>
<script type="text/javascript">
var lastpopup = "";
var tnglitbox;
for( var h = 1; h <= <?php echo $numlines; ?>; h++ ) {
	eval( 'var timer' + h + '=false' );
}

function setTimerHide(slot) {
	eval( "clearTimeout(timer" + slot + ");" );
	eval( "timer" + slot + "=false;" );
	eval( "timer" + slot + "=setTimeout(\"hidePopup('" + slot + "')\",<?php echo $pedigree['popuptimer']; ?>);");
}

function setTimerShow(slot,ev) {
	if(ev == "over")
		eval( "timer" + slot + "=setTimeout(\"showPopup('" + slot + "')\",<?php echo $pedigree['popuptimer']; ?>);");
	else
		showPopup(slot);
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

function showPopup(slot) {
// hide any other currently visible popups
	if( lastpopup ) {
		cancelTimer(lastpopup);
		hidePopup(lastpopup);
	}
	lastpopup = slot;

// show current
	var ref = document.all ? document.all["popup" + slot] : document.getElementById ? document.getElementById("popup" + slot) : null;

	//ref.innerHTML = getPopup(slot);
	if ( ref ) {ref = ref.style;}

	if ( ref.visibility != "show" && ref.visibility != "visible" ) {
		ref.zIndex = 8;
    	ref.visibility = "visible";
	}
}

function toggleAddMore(val) {
	jQuery('#addmorediv').toggle(200);
}

var lines = 1;
function toggleLines() {
	if(lines ) {
		jQuery('div.vertlines').each(function(index,item){
			item.style.visibility = 'hidden';
		});
		lines = 0;
	}
	else {
		jQuery('div.vertlines').each(function(index,item){
			item.style.visibility = 'visible';
		});
		lines = 1;
	}
}

function centerTimeline(year) {
	tl.getBand(0).setCenterVisibleDate(new Date(year, 0, 1));
	return false;
}
</script>

<?php
	//$flags['more'] = "$enddiv\n";
	tng_footer( $flags );
?>