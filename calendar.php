<?php
/*
 * tngCalendar - An addon calendar for TNG
 * https://tng.community/index.php?showtopic=779
 *
 * @author CJ Niemira <siege (at) siege (dot) org>
 * @copyright 2006,2008
 * @license GPL
 * @version 2.0
 */

$textpart = "search";
include("tng_begin.php");

$getperson_url = getURL( "getperson", 1 );
$familygroup_url = getURL( "familygroup", 1 );
$anniversaries_url = getURL( "anniversaries", 1 );
$calendar_url = getURL( "calendar", 1 );

if( !isset($living) ) $living = "";
if( !isset($hide) ) $hide = "";
if( !isset($tree) ) $tree = "";
if( !isset($m) ) $m = "";
if( !isset($year) ) $year = "";
if( !isset($_GET['m']) ) $_GET['m'] = "";
if( !isset($_GET['y']) ) $_GET['y'] = "";

$logstring = "<a href=\"$calendar_url" . "living=$living&amp;hide=$hide&amp;tree=$tree&amp;m=$m&amp;year=$year\">" . xmlcharacters($text['calendar']) . "</a>";
writelog($logstring);
preparebookmark($logstring);

$ucharset = strtoupper($session_charset);
function substr_unicode($str, $start, $len = null) {
    return join("", array_slice(
        preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY), $start, $len));
}

$flags['css'] = "<link href=\"{$cms['tngpath']}css/calendar.css?v=" . (filemtime($rootpath."css/calendar.css")) . "\" rel=\"stylesheet\" type=\"text/css\" />\n";
$flags['scripting'] = "
<script type=\"text/javascript\">\n
//<![CDATA[\n
function redisplay(key) {\n
	window.location.href = jQuery('#' + key).attr('href');\n
}\n
//]]>\n
</script>\n";

tng_header($text['calendar'], $flags);
?>

<h1 class="header"><span class="headericon" id="calendar-hdr-icon"></span><?php echo $text['calendar']; ?></h1><br clear="left"/>

<?php
include_once($cms['tngpath'] . "calsettings.php");

// Make an array of all the event types
$calAllEvents = array_merge($calIndEvent, $calFamEvent, $calEvent);

// Start by getting the date to display for
$current = getdate(time()+ ( 3600 * $time_offset ));

$thisMonth = ( is_numeric($_GET['m']) && ($_GET['m'] < 13) )
	? sprintf("%02d", $_GET['m'])
	: sprintf("%02d", $current['mon']);

$thisYear = ( is_numeric($_GET['y']) && ($_GET['y'] > 1000) && ($_GET['y'] < 3000) )
	? $_GET['y']
	: $current['year'];

$dateString	= "$thisYear-$thisMonth-01 00:00:00";
$time		= strtotime($dateString);

$startDay	= date('w', $time);

$daysInMonth	= date('t', $time);
$daysOfWeek	= array($text['sunday'], $text['monday'], $text['tuesday'], $text['wednesday'], $text['thursday'], $text['friday'], $text['saturday']);

$thisMonthName	= $dates[strtoupper(date('F', $time))];

$nextMonth	= date('n', strtotime($dateString . " +1 month"));
$nextMonthYear	= $nextMonth == 1 ? $thisYear + 1 : $thisYear;
$nextYear	= $thisYear + 1;

$lastMonth	= date('n', strtotime($dateString . " -1 month"));
$lastMonthYear	= $lastMonth == 12 ? $thisYear - 1 : $thisYear;
$lastYear	= $thisYear - 1;

$showLiving	= $allow_living ? (isset($_GET['living']) ? $_GET['living'] : 2) : 0;
$hideEvents	= isset($_GET['hide']) ? explode(',', $_GET['hide']) : $defaultHide;

$thisTree = $tree;

$events = array();

// Query for individual/person events this month
$select = array(); $where = array();
foreach ($calIndEvent as $key => $val) {
	if (in_array($key, $hideEvents))
		continue;
	$select[] = $key . "date";
	$select[] = $key . "datetr";
	$select[] = $key . "place";
	$where[] = $key . "datetr LIKE '%-$thisMonth-%'";
}

if (! empty($where)) {
$sql = "SELECT personID, gedcom, firstname, nickname, lnprefix, lastname, prefix, suffix, nameorder, title, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, living, branch, private, " . implode (', ', $select) . "
	FROM $people_table
	WHERE (" . implode(' OR ', $where) . ")";

if ($showLiving == '1') {
	$sql .= ' AND living = 1';
} elseif ($showLiving == '0') {
	$sql .= ' AND living = 0';
}

if ($thisTree && $thisTree != '-x--all--x-') {
	$sql .= " AND gedcom = '$thisTree'";
	$righttree = checktree($thisTree);
}
else
	$righttree = -1;

$sql .= " ORDER BY lastname, lnprefix, firstname";

$result = tng_query($sql);
# BREAK
if (!$result) {
	echo "Err 1<br/>$sql<br/>";
	echo tng_error();
	exit;
}


// Make sure data is normalized
if (tng_num_rows($result) > 0) {
	while ($row = tng_fetch_assoc($result)) {

		$rights = determineLivingPrivateRights($row, $righttree);
		$row['allow_living'] = $rights['living'];
		$row['allow_private'] = $rights['private'];
		if(($row['living'] && !$row['allow_living']) || ($row['private'] && !$row['allow_private']))
			continue;
		else {
			$longname = getName($row);
			if($ucharset == "UTF-8") {
				$name = (mb_strlen($longname) > $truncateNameAfter)
					? substr_unicode($longname, 0, $truncateNameAfter) . '...'
					: $longname;
			}
			else {
				$name = (strlen($longname) > $truncateNameAfter)
					? substr($longname, 0, $truncateNameAfter) . '...'
					: $longname;
			}

			foreach ($calIndEvent as $key => $val) {
				if ($val == null)
					continue;

				$field = $key . 'datetr';
				if (isset($row[$field])) {
					$date = substr($row[$field], 5);
					$yearval = substr($row[$key . 'date'], -4);
					$year = is_numeric($yearval) ? " ($yearval)" : "";
					$html = '<img src="' . $cms['tngpath'] . 'img/' . $val . '" class="calIcon" alt="" /><a href="' . $getperson_url . 'personID=' . $row['personID'] . '&amp;tree=' . $row['gedcom'] . '" class="calEvent" title="' . $longname . '">' . $name . '</a>' . $year;

					if(strpos($date,"-00"))
						$html = '<span class="nw">' . $html . '</span>';
					$events[$date][$key][$row['gedcom']][$row['personID']] = $html;
				}
			}
		}
	}
}
}


// Query for family events this month
$select = array(); $where = array();
foreach ($calFamEvent as $key => $val) {
	if (in_array($key, $hideEvents))
		continue;
	$select[] = $families_table . '.' . $key . 'date';
	$select[] = $families_table . '.' . $key . 'datetr';
	$select[] = $families_table . '.' . $key . 'place';
	$where[] = $key . "datetr LIKE '%-$thisMonth-%'";
}

if (! empty($where)) {
$sql = "SELECT familyID, gedcom, husband, wife, living, private, branch, gedcom, " . implode (', ', $select) . "
	FROM $families_table
	WHERE (" . implode(' OR ', $where) . ")";

if ($showLiving == '1') {
	$sql .= ' AND living = 1';
} elseif ($showLiving == '0') {
	$sql .= ' AND living = 0';
}

if ($thisTree && $thisTree != '-x--all--x-')
	$sql .= " AND gedcom = '$thisTree'";

$result = tng_query($sql);
# BREAK
if (!$result) {
	echo "Err 2<br/>";
	echo tng_error();
	exit;
}


// Make sure data is normalized
if (tng_num_rows($result) > 0) {
	while ($row = tng_fetch_assoc($result)) {

		$rights = determineLivingPrivateRights($row, $righttree);
		$row['allow_living'] = $rights['living'];
		$row['allow_private'] = $rights['private'];
		if(($row['living'] && !$row['allow_living'] && $nonames == 1) || ($row['private'] && !$row['allow_private'] && $tngconfig['nnpriv'] == 1))
			continue;
		else {
			$longname = getFamilyName($row);
			if($ucharset == "UTF-8") {
				$name = (mb_strlen($longname) > $truncateNameAfter)
					? substr_unicode($longname, 0, $truncateNameAfter) . '...'
					: $longname;
			}
			else {
				$name = (strlen($longname) > $truncateNameAfter)
					? substr($longname, 0, $truncateNameAfter) . '...'
					: $longname;
			}

			foreach ($calFamEvent as $key => $val) {
				if ($val == null)
					continue;

				$field = $key . 'datetr';
				if (isset($row[$field])) {
					$date = substr($row[$field], 5);
					$yearval = substr($row[$key . 'date'], -4);
					$year = is_numeric($yearval) ? " ($yearval)" : "";
					$html = '<img src="' . $cms['tngpath'] . 'img/' . $val . '" class="calIcon" alt="" /><a href="' . $familygroup_url . 'familyID=' . $row['familyID'] . '&amp;tree=' . $row['gedcom'] . '" class="calEvent" title="' . $longname . '">' . $name . '</a>' . $year;

					if(strpos($date,"-00"))
						$html = '<span class="nw">' . $html . '</span>';
					$events[$date][$key][$row['gedcom']][$row['familyID']] = $html;
				}
			}
		}
	}
}
}


// Query for custom events this month
$where = array();
foreach ($calEvent as $key => $val) {
	if (in_array($key, $hideEvents))
		continue;
	$where[] = "$eventtypes_table.tag = '$key'";
}

if (! empty($where)) {
$sql = "SELECT gedcom, persfamID, tag, display, eventdate, eventdatetr, eventplace
	FROM $events_table, $eventtypes_table
	WHERE (" . implode(' OR ', $where) . ") AND $eventtypes_table.eventtypeID = $events_table.eventtypeID AND eventdatetr LIKE '%-$thisMonth-%'";

if ($thisTree != '-x--all--x-')
	$sql .= " AND gedcom = '$thisTree'";

$result = tng_query($sql);
# BREAK
if (!$result) {
	echo "Err 3<br/>";
	echo tng_error();
	exit;
}


// Make sure the data is normalized
if (tng_num_rows($result) > 0) {
	while ($row = tng_fetch_assoc($result)) {

		// Ugh... who did this happen to?
		$isFam = 0;

		if ($row['persfamID'][0] == 'I') {
			$sql = "SELECT * FROM $people_table WHERE personID = '" . $row['persfamID'] . "'";
			if ($showLiving == '1') {
				$sql .= ' AND living = 1';
			} elseif ($showLiving == '0') {
				$sql .= ' AND living = 0';
			}

			if ($thisTree != '-x--all--x-')
				$sql .= " AND gedcom = '$thisTree'";

			$result2 = tng_query($sql);

			# BREAK
			if (!$result2) {
				echo "Err 4<br/>";
				echo tng_error();
				exit;
			}

			if (tng_num_rows($result2) < 1)
				continue;
			$longname = htmlentities(getName(tng_fetch_assoc($result2)),ENT_QUOTES);

		} elseif ($row['persfamID'][0] == 'F') {
			$sql = "SELECT * FROM $families_table WHERE familyID = '" . $row['persfamID'] . "'";
			if ($showLiving == '1') {
				$sql .= ' AND living = 1';
			} elseif ($showLiving == '0') {
				$sql .= ' AND living = 0';
			}

			if ($thisTree != '-x--all--x-')
				$sql .= " AND gedcom = '$thisTree'";

			$result3 = tng_query($sql);

			# BREAK
			if (!$result3) {
				echo "Err 5<br/>";
				echo tng_error();
				exit;
			}

			if (tng_num_rows($result3) < 1)
				continue;
			$longname = htmlentities(getFamilyName(tng_fetch_assoc($result3)),ENT_QUOTES);
			$isFam = 1;

		} else {
			continue;
		}

		$name = (strlen($longname) > $truncateNameAfter)
			? substr($longname, 0, $truncateNameAfter) . '...'
			: $longname;

		if (isset($row['eventdatetr'])) {
			$tag = $row['tag'];

			if ($isFam) {
				$html = '<img src="' . $cms['tngpath'] . 'img/' . $calEvent[$tag] . '" class="calIcon" alt="" /><a href="' . $familygroup_url . 'familyID=' . $row['persfamID'] . '&amp;tree=' . $row['gedcom'] . '" class="calEvent" title="' . $longname . '">' . $name . '</a>';
			} else {
				$html = '<img src="' . $cms['tngpath'] . 'img/' . $calEvent[$tag] . '" class="calIcon" alt="" /><a href="' . $getperson_url . 'personID=' . $row['persfamID'] . '&amp;tree=' . $row['gedcom'] . '" class="calEvent" title="' . $longname . '">' . $name . '</a>';
			}

			$date = substr($row['eventdatetr'], 5);
			$events[$date][$tag][$row['gedcom']][$row['persfamID']] = $html;
		}
	}
}
}

$args = "?living=$showLiving&amp;hide=" . implode(',', $hideEvents) . "&amp;tree=$thisTree&amp;";

// Write the calendar
echo "<div id=\"calWrapper\">\n";

$hidden = array();
$hidden[] = array('name' => 'm', 'value' => $thisMonth);
$hidden[] = array('name' => 'y', 'value' => $thisYear);
$hidden[] = array('name' => 'living', 'value' => $showLiving);
$hidden[] = array('name' => 'hide', 'value' => implode(',', $hideEvents));
echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'calendar', 'method' => 'get', 'name' => 'treeform', 'id' => 'treeform', 'hidden' => $hidden));

?>

<div id="calHeader">
	<a href="<?php echo $args; ?>m=<?php echo $thisMonth; ?>&amp;y=<?php echo $lastYear; ?>"><img src="<?php echo $cms['tngpath']; ?>img/ArrowLeft.gif" border="0" alt="" /><img src="<?php echo $cms['tngpath']; ?>img/ArrowLeft.gif" border="0" alt="" /></a>
	&nbsp;
	<a href="<?php echo $args; ?>m=<?php echo $lastMonth; ?>&amp;y=<?php echo $lastMonthYear; ?>"><img src="<?php echo $cms['tngpath']; ?>img/ArrowLeft.gif" border="0" alt="" /></a>
	&nbsp;
	<?php echo $thisMonthName; ?> <?php echo $thisYear; ?>
	&nbsp;
	<a href="<?php echo $args; ?>m=<?php echo $nextMonth; ?>&amp;y=<?php echo $nextMonthYear; ?>"><img src="<?php echo $cms['tngpath']; ?>img/ArrowRight.gif" border="0" alt="" /></a>
	&nbsp;
	<a href="<?php echo $args; ?>m=<?php echo $thisMonth; ?>&amp;y=<?php echo $nextYear; ?>"><img src="<?php echo $cms['tngpath']; ?>img/ArrowRight.gif" border="0" alt="" /><img src="<?php echo $cms['tngpath']; ?>img/ArrowRight.gif" border="0" alt="" /></a>
</div>

<?php
	if($allow_living) {
?>
<div style="text-align: right;">
<div style="float: left;">
<?php
	echo "<a href=\"{$anniversaries_url}tngmonth=$m&amp;tngneedresults=1\"><b>&gt;&gt; {$text['anniversaries']}</b></a>";
?>
</div>
<?php
		echo '<b>' . $text['filter'] . ':</b>&nbsp; ';
		$args = "&amp;hide=" . implode(',', $hideEvents) . "&amp;tree=$thisTree&amp;m=$thisMonth&amp;year=$thisYear";
		echo $showLiving == 2 ? '<b>' . $text['all'] . '</b> &nbsp;|&nbsp; ' : '<a href="?living=2' . $args . '">' . $text['all'] . '</a> &nbsp;|&nbsp; ';
		echo $showLiving == 1 ? '<b>' . $text['living'] . '</b> &nbsp;|&nbsp; ' : '<a href="?living=1' . $args . '">' . $text['living'] . '</a> &nbsp;|&nbsp; ';
		echo !$showLiving ? '<b>' . $text['notliving'] . '</b>': '<a href="?living=0' . $args . '">' . $text['notliving'] . '</a>';
?>
</div>
<?php
	}
?>
<table align="center" class="calendar rounded10">
<tr>
<?php
// Weekday name headers
for ($i = $startOfWeek; $i < $startOfWeek + 7; $i++) {
	echo "<th class=\"calDay\">" . $daysOfWeek[($i % 7)] . "</th>\n";
}

echo "</tr><tr>\n";

if ($startOfWeek > $startDay)
	$startOfWeek -= 7;

$dayInWeek = 0;

for ($i = $startOfWeek; $i < ($daysInMonth + $startDay); $i++) {
	$dayInWeek++;
	$dayInMonth = $i - $startDay;

	if ($dayInMonth >= $daysInMonth || $dayInMonth < 0) {
		echo "<td class=\"calSkip\"><div>\n";

	} else {
		$thisDay = $dayInMonth + 1;

		$class = ($thisYear == $current['year'] && $thisMonth == $current['mon'] && $thisDay == $current['mday']) ? 'calToday' : 'calDay';
		echo "<td class=\"$class\">\n";
		echo "<a href=\"{$anniversaries_url}tngdaymonth=$thisDay&amp;tngmonth=$thisMonth&amp;tngneedresults=1\" class=\"calDate\">$thisDay</a><br/>\n<div class=\"calEvents\">\n";

		$thisDate = "$thisMonth-" . sprintf("%02d", $thisDay);
		if (array_key_exists($thisDate, $events)) {
			$j = 0;
			foreach ( array_keys($events[$thisDate]) as $event) {
				if ($j > $truncateDateAfter)
					continue;
				foreach ( array_keys($events[$thisDate][$event]) as $ged ) {
					foreach ( array_keys($events[$thisDate][$event][$ged]) as $id ) {
						if ($j >= $truncateDateAfter) {
							echo "<a href=\"{$anniversaries_url}tngdaymonth=$thisDay&amp;tngmonth=$thisMonth&amp;tngneedresults=1\" class=\"calMore\">" . $text['more'] . "...</a>\n";
							$j++;
							continue 3;
						}

						// Print events
						echo $events[$thisDate][$event][$ged][$id] . "<br/>\n";
						$j++;
					}
				}
			}
		}
	}
	echo "</div>\n</td>\n";

	if (($dayInWeek % 7) == 0) { echo "</tr><tr>\n"; }
}
if (($dayInWeek % 7) != 0) { echo "</tr><tr>\n"; }
?>

<td colspan="7">
<div class="calKey"><?php echo $text['nodayevents']?></div>

<?php
$thisDate = "$thisMonth-00";
if (array_key_exists($thisDate, $events)) {
	foreach ( array_keys($events[$thisDate]) as $event) {
		foreach ( array_keys($events[$thisDate][$event]) as $ged ) {
			foreach ( array_keys($events[$thisDate][$event][$ged]) as $id ) {
				echo $events[$thisDate][$event][$ged][$id] . " &nbsp; \n";
			}
		}
	}
} else {
	echo $text['none'];
}
?>

</td>
</tr></table>

<div id="calLegend" class="rounded10 databack">
<ul class="flat">
<?php
	// make sure the custom text key is set
	$where = array();
	if(count($calEvent)) {
		foreach ($calEvent as $key => $val)
			$where[] = "$eventtypes_table.tag = '$key'";

		$sql = "SELECT tag, display
			FROM $eventtypes_table
			WHERE " . implode(' OR ', $where);
	
		$result = tng_query($sql);
		# BREAK
		if (!$result) {
			echo "Err 6<br/>";
			echo tng_error();
			exit;
		}
	
		if (tng_num_rows($result) > 0)
			while ($row = tng_fetch_assoc($result))
				$text[$row['tag'] . 'date'] = getEventDisplay($row['display']);
	}
	
	foreach ($calAllEvents as $key => $val) {
		if ($val == null || empty($text[$key . 'date']))
			continue;

		if (in_array($key, $hideEvents)) {
			$checkbox = "<input type=\"checkbox\" onclick=\"redisplay('cal_$key');\">";
			$toHide = array_diff($hideEvents, array($key));
		} else {
			$checkbox = "<input type=\"checkbox\" checked onclick=\"redisplay('cal_$key');\">";
			$toHide = $hideEvents;
			$toHide[] = $key;
		}

		$args = "?living=$showLiving&amp;hide=" . implode(',', $toHide) . "&amp;tree=$thisTree&amp;m=$thisMonth&amp;year=$thisYear";
		echo '<li class="flat nw"><a href="' . $args . '" class="nothidden" id="cal_' . $key . '">' . $checkbox . '<img src="' . $cms['tngpath'] . 'img/' . $val . '" class="calIcon" alt="" />' . $text[$key . 'date'] . '</a></li>' . "\n";
	}

?>
</ul>
</div>
</div>

<?php
tng_footer("");
?>