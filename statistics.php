<?php
// The following page was created by Roger L. Smith (roger@ERC.MsState.Edu), 
// copyright July 2003. Used by permission.
$textpart = "stats";
include("tng_begin.php");

//$cachemode = 0;
//$cachetime = 86400;

$search_url = getURL( "search", 1 );
$surnames_oneletter_url = getURL( "surnames-oneletter", 1 );
$surnames_all_url = getURL( "surnames-all", 1 );
$getperson_url = getURL( "getperson", 1 );
$showtree_url = getURL( "showtree", 1 );
$statistics_url = getURL( "statistics", 1 );

$treestr = $tree ? " ({$text['tree']}: $tree)" : "";
$logstring = "<a href=\"$statistics_url" . "tree=$tree\">" . xmlcharacters($text['databasestatistics'] . $treestr) . "</a>";
writelog($logstring);
preparebookmark($logstring);

tng_header( $text['databasestatistics'], $flags );
?>

<h1 class="header"><span class="headericon" id="stats-hdr-icon"></span><?php echo $text['databasestatistics']; ?></h1><br clear="left"/>
<link href="css/c3.css" rel="stylesheet">
<script src="js/d3.min.js"></script>
<script src="js/c3.min.js"></script>
<div style="display:inline-block">
<?php
echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'statistics', 'method' => 'get', 'name' => 'form1', 'id' => 'form1'));

$header = "";
$headerr = $enableminimap ? " data-tablesaw-minimap" : "";
$headerr .= $enablemodeswitch ? " data-tablesaw-mode-switch" : "";

if($sitever != "standard") {
	if($tabletype == "toggle") $tabletype = "columntoggle";
	$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" style=\"maxwidth: 350px; width:100%\" class=\"tablesaw thfixed whiteback normal\" data-tablesaw-mode=\"$tabletype\"{$headerr}>\n";
} else {
	$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" width=\"500\" class=\"thfixed whiteback normal\">";
}
echo $header;
?>
	<thead>
		<tr>
		<th data-tablesaw-priority="persist" class="fieldnameback fieldname">&nbsp;<?php echo $text['description']; ?>&nbsp;</th>
		<th data-tablesaw-priority="1" class="fieldnameback align-right fieldname" width="30%" align="center">&nbsp;<?php echo $text['quantity']; ?>&nbsp;</th>
		</tr>
	</thead>
<?php
//include('cache-begin.php');

$query = "SELECT lastimportdate, treename, secret FROM $trees_table WHERE gedcom = \"$tree\"";
$result = tng_query($query);
$treerow = tng_fetch_array( $result, 'assoc' );
$lastimportdate = isset($treerow['lastimportdate']) ? $treerow['lastimportdate'] : "";

if( $tree ) {
    $wherestr = "WHERE gedcom = \"$tree\"";
    $wherestr2 = "AND gedcom= \"$tree\"";
}
else {
    $wherestr = "";
    $wherestr2 = "";
}

$query = "SELECT count(id) as pcount FROM $people_table $wherestr";
$result =  tng_query($query);
$row = tng_fetch_assoc( $result );
$totalpeople = $row['pcount'];
tng_free_result($result);

$query = "SELECT count(id) as fcount FROM $families_table $wherestr";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
$totalfamilies = $row['fcount'];
tng_free_result($result);

$query = "SELECT count(DISTINCT ucase(lastname)) as lncount
   FROM $people_table $wherestr";
$result =  tng_query($query);
$row = tng_fetch_array($result);
$uniquesurnames = number_format($row['lncount']);
tng_free_result($result);

$totalmedia = array();
foreach( $mediatypes as $mediatype ) {
	$mediatypeID = $mediatype['ID'];
	if( $tree ) {
		$query = "SELECT count(distinct mediaID) as mcount FROM $media_table
	    WHERE mediatypeID = \"$mediatypeID\" AND (gedcom = \"$tree\" OR gedcom = \"\")";
	}
	else
		$query = "SELECT count(mediaID) as mcount FROM $media_table WHERE mediatypeID = \"$mediatypeID\"";
	$result =  tng_query($query);
	$row = tng_fetch_assoc( $result );
	$totalmedia[$mediatypeID] = $row['mcount'];
	tng_free_result($result);
}

$query = "SELECT count(id) as scount FROM $sources_table $wherestr";
$result =  tng_query($query);
$row = tng_fetch_assoc( $result );
$totalsources = number_format($row['scount']);
tng_free_result($result);

$query = "SELECT count(citationid) as scitcount FROM $citations_table $wherestr";
$result =  tng_query($query);
$row = tng_fetch_assoc( $result );
$totalsourcecitations = number_format($row['scitcount']);
tng_free_result($result);

$query = "SELECT count(id) as pcount FROM $people_table WHERE sex = 'M' $wherestr2";
$result =  tng_query($query);
$row = tng_fetch_assoc( $result );
$males = $row['pcount'];
tng_free_result($result);

$query = "SELECT count(id) as pcount FROM $people_table WHERE sex = 'F' $wherestr2";
$result =  tng_query($query);
$row = tng_fetch_assoc( $result );
$females = $row['pcount'];
tng_free_result($result);

$unknownsex = $totalpeople - $males - $females;

$query = "SELECT count(id) as pcount FROM $people_table WHERE living != 0 $wherestr2";
$result =  tng_query($query);
$row = tng_fetch_assoc( $result );
$living = $row['pcount'];
$numliving = number_format($living);
$numdeceased = $totalpeople - $living;
tng_free_result($result);

$query = "SELECT personID, firstname, lnprefix, lastname, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr, gedcom, living, private, branch
    FROM $people_table 
    WHERE (YEAR(birthdatetr) != '0' OR YEAR(altbirthdatetr) != '0') $wherestr2
    ORDER BY IF(birthdatetr != '0000-00-00',birthdatetr,altbirthdatetr) LIMIT 1";
$result =  tng_query($query);
$firstbirth = tng_fetch_array($result);
$firstbirthpersonid = $firstbirth['personID'];
$firstbirthfirstname = $firstbirth['firstname'];
$firstbirthlnprefix = $firstbirth['lnprefix'];
$firstbirthlastname = $firstbirth['lastname'];
$firstbirthdate = $firstbirth['birthdate'] ? $firstbirth['birthdate'] : $firstbirth['altbirthdate'];
$firstbirthgedcom = $firstbirth['gedcom'];

$rights = determineLivingPrivateRights($firstbirth);
$firstallowed = $rights['both'];

tng_free_result($result);

$query = "SELECT YEAR( deathdatetr ) - YEAR(IF(birthdatetr !='0000-00-00',birthdatetr,altbirthdatetr)) 
	AS yearsold, DAYOFYEAR( deathdatetr ) - DAYOFYEAR(IF(birthdatetr !='0000-00-00',birthdatetr,altbirthdatetr)) AS daysold,
	IF(DAYOFYEAR(deathdatetr) and DAYOFYEAR(IF(birthdatetr !='0000-00-00',birthdatetr,altbirthdatetr)),TO_DAYS(deathdatetr) - TO_DAYS(IF(birthdatetr !='0000-00-00',birthdatetr,altbirthdatetr)),(YEAR(deathdatetr) - YEAR(IF(birthdatetr !='0000-00-00',birthdatetr,altbirthdatetr))) * 365) as totaldays
    FROM $people_table
    WHERE (birthdatetr != '0000-00-00' OR altbirthdatetr != '0000-00-00') AND deathdatetr != '0000-00-00'
		AND (birthdate not like 'AFT%' OR altbirthdate not like 'AFT%') AND deathdate not like 'AFT%'
		AND (birthdate not like 'BEF%' OR altbirthdate not like 'BEF%') AND deathdate not like 'BEF%'
		AND (birthdate not like 'ABT%' OR altbirthdate not like 'ABT%') AND deathdate not like 'ABT%'
		AND (birthdate not like 'BET%' OR altbirthdate not like 'BET%') AND deathdate not like 'BET%'
		AND (birthdate not like 'CAL%' OR altbirthdate not like 'CAL%') AND deathdate not like 'CAL%'
		$wherestr2
    ORDER BY totaldays DESC";
$result =  tng_query($query);
$numpeople = 0;
$avgyears = 0;
$avgdays = 0;
$totyears = 0;
$totdays = 0;

if(!isset($CUTOFF_YEARS))
	$CUTOFF_YEARS = 2; //remove from the stats if less than 2 years old

while( $line = tng_fetch_array($result, 'assoc') )
{
	$yearsold = $line['yearsold'];
	$daysold = $line['daysold'];

	if( $daysold < 0 ) {
		if ($yearsold > 0) {
			$yearsold--;
			$daysold = 365 + $daysold;
		}
	}
	if($yearsold >= $CUTOFF_YEARS) {
		$totyears += $yearsold;
		$numpeople++;
		$totdays += $daysold;
	}
}
$avgyears = $numpeople ? $totyears / $numpeople : 0;

// convert the remainder from $avgyears to days
$avgdays = ($avgyears - floor($avgyears)) * 365;  

// add the number of averge days calculated from $totdays
$avgdays += $numpeople ? $totdays / $numpeople : 0;                 

// if $avgdays is more than a year, we've got to adjust things! 
if ($avgdays > 365) {
    // add the number of additional years $avgdaysgives us
	$avgyears += floor($avgdays/365);  

    //change $avgdays to days left after removing multiple 
    //years' worth of days.
	$avgdays = $avgdays - (floor($avgdays/365) * 365); 
}
$avgyears = floor($avgyears);
$avgdays = floor($avgdays);

tng_free_result($result);

$percentmales = $totalpeople ? round(100 * $males / $totalpeople, 2) : 0;
$percentfemales = $totalpeople ? round(100 * $females / $totalpeople, 2) : 0;
$percentunknownsex = $totalpeople ? round(100 * $unknownsex / $totalpeople, 2) : 0;

$people = $totalpeople;
$totalpeople = number_format($people);
$totalfamilies = number_format($totalfamilies);
$fmt_males = number_format($males);
$fmt_females = number_format($females);
$fmt_unknownsex = number_format($unknownsex);
$fmt_numdeceased = number_format($numdeceased);

echo "<tr><td class=\"databack\"><span class=\"normal\">{$text['totindividuals']}</span></td>\n";
echo "<td class=\"databack\" align=\"right\"><span class=\"normal\">$totalpeople &nbsp;</span></td></tr>\n";

echo "<tr><td class=\"databack\"><span class=\"normal\">{$text['totmales']}</span></td>\n";
echo "<td class=\"databack\" align=\"right\"><span class=\"normal\">$fmt_males ($percentmales%) &nbsp;</span></td></tr>\n";

echo "<tr><td class=\"databack\"><span class=\"normal\">{$text['totfemales']}</span></td>\n";
echo "<td class=\"databack\" align=\"right\"><span class=\"normal\">$fmt_females ($percentfemales%) &nbsp;</span></td></tr>\n";

echo "<tr><td class=\"databack\"><span class=\"normal\">{$text['totunknown']}</span></td>\n";
echo "<td class=\"databack\" align=\"right\"><span class=\"normal\">$fmt_unknownsex ($percentunknownsex%) &nbsp;</span></td></tr>\n";

echo "<tr><td class=\"databack\"><span class=\"normal\">{$text['totliving']}</span></td>\n";
echo "<td class=\"databack\" align=\"right\"><span class=\"normal\">$numliving &nbsp;</span></td></tr>\n";

echo "<tr><td class=\"databack\"><span class=\"normal\">{$text['totfamilies']}</span></td>\n";
echo "<td class=\"databack\" align=\"right\"><span class=\"normal\">$totalfamilies &nbsp;</span></td></tr>\n";

echo "<tr><td class=\"databack\"><span class=\"normal\">{$text['totuniquesn']}</span></td>\n";
echo "<td class=\"databack\" align=\"right\"><span class=\"normal\">$uniquesurnames &nbsp;</span></td></tr>\n";

$media_data = $media_names = array();
$index = 0;
foreach( $mediatypes as $mediatype ) {
	$mediatypeID = $mediatype['ID'];
	$titlestr = !empty($text[$mediatypeID]) ? $text[$mediatypeID] : $mediatypes_display[$mediatypeID];
	echo "<tr><td class=\"databack\"><span class=\"normal\">{$text['total']} $titlestr</span></td>\n";
	echo "<td class=\"databack\" align=\"right\"><span class=\"normal\">" . number_format($totalmedia[$mediatypeID]) . " &nbsp;</span></td></tr>\n";
	array_push($media_data,$totalmedia[$mediatypeID]);
	array_push($media_names,$titlestr);
	if($index < 16) 
		$index++;
	else
		$index = 0;
}

echo "<tr><td class=\"databack\"><span class=\"normal\">{$text['totsources']}</span></td>\n";
echo "<td class=\"databack\" align=\"right\"><span class=\"normal\">$totalsources &nbsp;</span></td></tr>\n";

echo "<tr><td class=\"databack\"><span class=\"normal\">{$text['totalsourcecitations']}</span></td>\n";
echo "<td class=\"databack\" align=\"right\"><span class=\"normal\">$totalsourcecitations &nbsp;</span></td></tr>\n";

echo "<tr><td class=\"databack\"><span class=\"normal\">{$text['avglifespan']}<sup><font size=\"1\">1</font></sup></span></td>\n";
echo "<td class=\"databack\" align=\"right\"><span class=\"normal\">$avgyears {$text['years']}, $avgdays {$text['days']} &nbsp;</span></td></tr>\n";

echo "<tr><td class=\"databack\"><span class=\"normal\">" . $text['earliestbirth'];
if($firstallowed)
	echo " (<a href=\"$getperson_url" . "personID=$firstbirthpersonid&amp;tree=$firstbirthgedcom\">$firstbirthfirstname $firstbirthlnprefix $firstbirthlastname</a>)";
echo "&nbsp;</span></td>\n";
echo "<td class=\"databack\" align=\"right\"><span class=\"normal\">" . displayDate( $firstbirthdate ) . " &nbsp;</span></td></tr>\n";

if( $tngconfig['lastimport'] && $treerow['treename'] && $lastimportdate ) {
	echo "<tr><td class=\"databack\"><span class=\"normal\">" . $text['lastimportdate'] . "</span></td>\n";

	$importtime = strtotime($lastimportdate);
	if(substr($lastimportdate,11,8) != "00:00:00")
		$importtime += ($time_offset * 3600);
	$importdate = date("d M Y H:i:s", $importtime);

	echo "<td class=\"databack\" align=\"right\"><span class=\"normal\">" . displayDate( $importdate ) . " &nbsp;</span></td></tr>\n";
}
?>
</table>
<br />
<?php
echo $header;
?>
	<thead>
		<tr>
		<th data-tablesaw-priority="persist" class="fieldnameback fieldname">&nbsp;<?php echo $text['longestlived']; ?><sup><font size="1">1</font></sup>&nbsp;</th>
		<th data-tablesaw-priority="1" class="fieldnameback align-right fieldname" width="30%" align="center">&nbsp;<?php echo $text['age']; ?>&nbsp;</th>
		</tr>
	</thead>
<?php
$query = "SELECT personID, firstname, lnprefix, lastname, prefix, suffix, nameorder, title, gedcom, living, private, branch, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr,
	YEAR( deathdatetr ) - YEAR( birthdatetr ) AS yearsold, DAYOFYEAR( deathdatetr ) - DAYOFYEAR( birthdatetr ) AS daysold,
	IF(DAYOFYEAR(deathdatetr) and DAYOFYEAR(birthdatetr),TO_DAYS(deathdatetr) - TO_DAYS(birthdatetr),(YEAR(deathdatetr) - YEAR(birthdatetr)) * 365) as totaldays
    FROM $people_table
    WHERE birthdatetr != '0000-00-00' AND deathdatetr != '0000-00-00' $wherestr2
		AND birthdate not like 'AFT%' AND deathdate not like 'AFT%'
		AND birthdate not like 'BEF%' AND deathdate not like 'BEF%'
		AND birthdate not like 'ABT%' AND deathdate not like 'ABT%'
		AND birthdate not like 'BET%' AND deathdate not like 'BET%'
		AND birthdate not like 'CAL%' AND deathdate not like 'CAL%'
    ORDER BY totaldays DESC LIMIT 10";
$result =  tng_query($query);
$numpeople = tng_num_rows($result);

while ($line = tng_fetch_array($result, 'assoc')) 
{
	$personid = $line['personID'];
	$firstname = $line['firstname'];
	$lnprefix = $line['lnprefix'];
	$lastname = $line['lastname'];
	$yearsold = $line['yearsold'];
	$daysold = $line['daysold'];
    $gedcom = $line['gedcom'];

	$rights = determineLivingPrivateRights($line);
	$allowed = $rights['both'];
	$line['allow_living'] = $rights['living'];
	$line['allow_private'] = $rights['private'];

	if( $daysold < 0 ) {
		if ($yearsold > 0) {
			$yearsold--;
			$daysold = 365 + $daysold;
		}
	}
	echo "<tr><td valign=\"top\" class=\"databack\"><span class=\"normal\"><a href=\"$getperson_url" . "personID=$personid&amp;tree=$gedcom\">";
	echo getName($line);
	echo "</a></span></td>\n";
	echo "<td valign=\"top\" class=\"databack\" align=\"right\"><span class=\"normal\">";
	if( $yearsold )
		echo number_format($yearsold) . " " . $text['years'];
	if( $daysold )
		echo " $daysold " . $text['days'];
	echo " &nbsp;</span></td></tr>\n";
}
echo "</table>\n";

echo "<br/><br/>\n";
$width = $sitever == "standard" ? "500px" : "100%";
echo "<table style=\"width:$width\" cellpadding=\"3\" cellspacing=\"1\" border=\"0\" class=\"tfixed whiteback\">\n";
echo "<tr><td  valign=\"top\" class=\"fieldnameback\" style=\"width:10px\"><span class=\"fieldname\"><sup><font size=\"1\">1</font></sup>&nbsp;</span></td>";
echo "<td class=\"databack\"><span class=\"normal\">{$text['agedisclaimer']}</span></td></tr>";
echo "</table>\n";
tng_free_result($result);

if( $tree && !$treerow['secret'] ) {
	echo "<br/>\n";
	echo "<span class=\"normal\"><a href=\"$showtree_url" . "tree=$tree\">{$text['treedetail']}</a></span>\n";
	echo "<br/>\n";
}

echo "<br/>\n";
?>
</div>
<div id="charts" style="display:inline-block; width:400px; vertical-align:top">
	<div id="gender_chart"></div>
	<div id="living_chart"></div>
	<div id="media_chart"></div>
</div>
<script type="text/javascript">
var gender_chart = c3.generate({
    bindto: '#gender_chart',
    data: {
        columns: [
            ['data1', <?php echo $males; ?>],
            ['data2', <?php echo $females; ?>],
            ['data3', <?php echo $unknownsex; ?>]
        ],
        type : 'pie',
        names: {
            data1: "<?php echo $text['totmales'] . " ($fmt_males)"; ?>",
            data2: "<?php echo $text['totfemales'] . " ($fmt_females)"; ?>",
            data3: "<?php echo $text['totunknown'] . " ($fmt_unknownsex)"; ?>"
        },
        colors: {
            data1: '#00aaff',
            data2: '#ff99cc',
            data3: '#009900'
        }
    }
});
var living_chart = c3.generate({
    bindto: '#living_chart',
    data: {
        columns: [
            ['data1', <?php echo $living; ?>],
            ['data2', <?php echo $people - $living; ?>]
        ],
        type : 'pie',
        names: {
            data1: "<?php echo $text['totliving'] . " ($numliving)"; ?>",
            data2: "<?php echo $text['totdeceased'] . " ($fmt_numdeceased)"; ?>"
        },
        colors: {
            data1: '#990000',
            data2: '#000099'
        }
    }
});
var media_chart = c3.generate({
    bindto: '#media_chart',
    data: {
        columns: [
<?php
	$count = 0;
	$tot_media_data = count($media_data);
	$indexed = array();
	foreach($media_data as $data) {
		$indexed[$count] = $data;
		$count++;
		$comma = $count != $tot_media_data ? "," : "";
		echo "['data{$count}', $data]{$comma}\n";
	}
?>
        ],
        type : 'pie',
        names: {
<?php
	$count = 0;
	$tot_media_names = count($media_names);
	foreach($media_names as $name) {
		$total = $indexed[$count];
		$count++;
		$comma = $count != $tot_media_names ? "," : "";
		echo "data{$count}: \"{$name} ({$total})\"{$comma}\n";
	}
?>
        }
    }
});
</script>
<?php
tng_footer( "" );
//include('cache-end.php');
?>