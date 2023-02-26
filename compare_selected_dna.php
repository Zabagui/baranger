<?php
$textpart = "dna";
include("tng_begin.php");
include($cms['tngpath'] . "adminlib.php" );
include($cms['tngpath'] . "personlib.php" );

if($tngconfig['hidedna'] && (!$allow_edit || !$allow_add || $assignedtree)) {
	header( "Location: thispagedoesnotexist.html" ); 
	exit;
}
if (!$_SESSION["ttree"]) $_SESSION["ttree"] = "-x--all--x-";
$browse_dna_tests_url = getURL( "browse_dna_tests", 1 ) . "tree=" . $_SESSION["ttree"] . "&amp;testsearch=" . $_SESSION["tsearch"] . "&amp;test_type=" . $_SESSION["ttype"] . "&amp;test_group=" . $_SESSION["tgroup"];

$headline = "{$text['dnatestscompare']}";
$text['dnatestscompare'] .= $_SESSION["tgroup"] ? ": " . $_SESSION["tgroup"] : ": " . $text['allgroups'];

tng_header( $text['dnatestscompare'], $flags );

/**
 * This file is part of the array_column library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Ben Ramsey (http://benramsey.com)
 * @license http://opensource.org/licenses/MIT MIT
 */
if (!function_exists('array_column')) {
    /**
     * Returns the values from a single column of the input array, identified by
     * the $columnKey.
     *
     * Optionally, you may provide an $indexKey to index the values in the returned
     * array by the values from the $indexKey column in the input array.
     *
     * @param array $input A multi-dimensional array (record set) from which to pull
     *                     a column of values.
     * @param mixed $columnKey The column of values to return. This value may be the
     *                         integer key of the column you wish to retrieve, or it
     *                         may be the string key name for an associative array.
     * @param mixed $indexKey (Optional.) The column to use as the index/keys for
     *                        the returned array. This value may be the integer key
     *                        of the column, or it may be the string key name.
     * @return array
     */
    function array_column($input = null, $columnKey = null, $indexKey = null)
    {
        // Using func_get_args() in order to check for proper number of
        // parameters and trigger errors exactly as the built-in array_column()
        // does in PHP 5.5.
        $argc = func_num_args();
        $params = func_get_args();
        if ($argc < 2) {
            trigger_error("array_column() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
            return null;
        }
        if (!is_array($params[0])) {
            trigger_error(
                'array_column() expects parameter 1 to be array, ' . gettype($params[0]) . ' given',
                E_USER_WARNING
            );
            return null;
        }
        if (!is_int($params[1])
            && !is_float($params[1])
            && !is_string($params[1])
            && $params[1] !== null
            && !(is_object($params[1]) && method_exists($params[1], '__toString'))
        ) {
            trigger_error('array_column(): The column key should be either a string or an integer', E_USER_WARNING);
            return false;
        }
        if (isset($params[2])
            && !is_int($params[2])
            && !is_float($params[2])
            && !is_string($params[2])
            && !(is_object($params[2]) && method_exists($params[2], '__toString'))
        ) {
            trigger_error('array_column(): The index key should be either a string or an integer', E_USER_WARNING);
            return false;
        }
        $paramsInput = $params[0];
        $paramsColumnKey = ($params[1] !== null) ? (string) $params[1] : null;
        $paramsIndexKey = null;
        if (isset($params[2])) {
            if (is_float($params[2]) || is_int($params[2])) {
                $paramsIndexKey = (int) $params[2];
            } else {
                $paramsIndexKey = (string) $params[2];
            }
        }
        $resultArray = array();
        foreach ($paramsInput as $row) {
            $key = $value = null;
            $keySet = $valueSet = false;
            if ($paramsIndexKey !== null && array_key_exists($paramsIndexKey, $row)) {
                $keySet = true;
                $key = (string) $row[$paramsIndexKey];
            }
            if ($paramsColumnKey === null) {
                $valueSet = true;
                $value = $row;
            } elseif (is_array($row) && array_key_exists($paramsColumnKey, $row)) {
                $valueSet = true;
                $value = $row[$paramsColumnKey];
            }
            if ($valueSet) {
                if ($keySet) {
                    $resultArray[$key] = $value;
                } else {
                    $resultArray[] = $value;
                }
            }
        }
        return $resultArray;
    }
}

	$comptabs[0] = array(1,$browse_dna_tests_url,$text['dna_tests'],"dnatests");
	$innermenu = "";
	$menu = doMenu($comptabs,"",$innermenu);
	echo displayHeadline($text['dnatestscompare'],"img//dna_icon.gif",$menu,$message);
        $dysv = array("DYS_393","DYS_390","DYS_19","DYS_391","DYS_385","DYS_426","DYS_388","DYS_439","DYS_389I","DYS_392","DYS_389II","DYS_458","DYS_459","DYS_455","DYS_454","DYS_447","DYS_437","DYS_448","DYS_449","DYS_464","DYS_460","Y_GATA_H4","YCAI","YCAII","DYS_456","DYS_607","DYS_576","DYS_570","CDY","DYS_442","DYS_438","DYS_531","DYS_578","DYS_395S1","DYS_590","DYS_537","DYS_641","DYS_472","DYS_406S1","DYS_511","DYS_425","DYS_413","DYS_557","DYS_594","DYS_436","DYS_490","DYS_534","DYS_450","DYS_444","DYS_481","DYS_520","DYS_446","DYS_617","DYS_568","DYS_487","DYS_572","DYS_640","DYS_492","DYS_565","DYS_710","DYS_485","DYS_632","DYS_495","DYS_540","DYS_714","DYS_716","DYS_717","DYS_505","DYS_556","DYS_549","DYS_589","DYS_522","DYS_494","DYS_533","DYS_636","DYS_575","DYS_638","DYS_462","DYS_452","DYS_445","Y_GATA_A10","DYS_463","DYS_441","Y_GGAAT_1B07","DYS_525","DYS_712","DYS_593","DYS_650","DYS_532","DYS_715","DYS_504","DYS_513","DYS_561","DYS_552","DYS_726","DYS_635","DYS_587","DYS_643","DYS_497","DYS_510","DYS_434","DYS_461","DYS_435");

        $fastmut=array("DYS_385","DYS_439","DYS_458","DYS_449","DYS_464","DYS_456","DYS_576","DYS_570","CDY");
        $compound_dys=array("385","459","464","CDY","395S1","413");
        $col_count=array(3,3,5,3,3,3);
        $mainstyle = "background-color:$bgmain; color:$txtmain;";
        $modestyle = "background-color:$bgmode; color:$txtmode;";
?>
<div class="overflowauto">
<table cellpadding="0" cellspacing="1" border="0" width="100%" class="whiteback normal">
	<thead>
		<tr>
<?php if ($allow_edit || $showtestnumbers) { ?>
		<th class="fieldnameback center nw" style="<?php echo $mainstyle;?>">&nbsp;<?php echo $text['test_number']; ?>&nbsp;</th>
<?php } ?>
		<th class="fieldnameback center nw" style="<?php echo $mainstyle;?>">&nbsp;<?php echo $text['takenby']; ?>&nbsp;</th>
		<th class="fieldnameback center nw" style="<?php echo $mainstyle;?>">&nbsp;<?php echo $admtext['mda']; ?>&nbsp;</th>
		<th class="fieldnameback center nw" style="<?php echo $mainstyle;?>">&nbsp;<?php echo $text['haplogroup']; ?>&nbsp;</th>
<?php

$resultsarr = array();
$i = $ii = $iii = '0';

foreach( array_keys($_POST) as $key ) {
     if( substr( $key, 0, 3 ) == "dna" ) {
	$testID = substr( $key, 3 );
        $rquery = "SELECT testID, markers, y_results 
	FROM $dna_tests_table WHERE testID=$testID";
        $rresult = tng_query($rquery);
	$rrow = tng_fetch_assoc( $rresult );
        $resultscsv = str_replace( '-', ',', $rrow['y_results']);
        $resultsarr[$i] = explode( ',', $resultscsv );
        $markercount[$i] = count($resultsarr[$i]);
     if ($markercount[$i] > '12') $ii++;
     if ($markercount[$i] > '25') $iii++;
        $i++;
     }
}
if ($rresult) tng_free_result($rresult);

$mode = array();
$modesarr = array(array());
$displaystr = "";
$j='0';
foreach ($resultsarr as $subKey => $subArray) {
 $l='0';
    foreach ($subArray as $k => $v) {
       $modesarr[$j][$l] = $v;
 $l++;
    }
$j++;
}

$columnCount = max( array_map('count', $modesarr) );
$l = (function_exists('array_column')) ? '-1' : '0';
while ($l <= $columnCount - 1) {
$alvals = array_column($modesarr, $l);
$values = array_count_values($alvals);
if ($values) $mode[$l] = array_search(max($values), $values);
$l++;
}

$j='0';
$jj='0';
$dashcount = $columnCount >= '38' ? '9' : '7';
if ($columnCount <= '25') $dashcount = '6';
if ($columnCount <= '12') $dashcount = '2';
while ($j <= ($columnCount - $dashcount)) {
$title = "";
$class = "";
$style = "";
if( $j >= 0 ) $style = "background-color:$bg1_12; color:$txt1_12;";
if( $j > 10 ) $style = "background-color:$bg13_25; color:$txt13_25;";
if( $j > 19 ) $style = "background-color:$bg26_37; color:$txt26_37;";
if( $j > 30 ) $style = "background-color:$bg38_67; color:$txt38_67;";
if( $j > 58 ) $style = "background-color:$bg111; color:$txt111;";
$jj = 0;
$col_span = 1;
while ($jj <= 5) {
if (strstr($dysv[$j], $compound_dys[$jj]))
$col_span = $col_count[$jj];
$jj ++;
}
if (in_array($dysv[$j], $fastmut)) {
$title = $text['fastmutating'];
$class = "fakelink";
$style = "background-color:$bgfastmut; color:$txtfastmut;";
}
?>
<th colspan=<?php echo $col_span;?> align="left" valign="top" class="<?php echo $class;?>" style="<?php echo $style;?>" title = <?php echo $title;?>>
<div class="dysval">&nbsp;&nbsp;<?php echo $dysv[$j];?></div>
</th>
<?php
$j ++;
};?>
		</tr>
	</thead>
<?php
	echo "<tr>";
$col_span = ($allow_edit || $showtestnumbers) ? 4 : 3;
	echo "<td colspan=$col_span valign=\"top\" class=\"center nw\" style=\"$modestyle\"><strong>{$text['mode_values']}&nbsp;>></strong>&nbsp;</td>";


$i=0;
while ($i <= $columnCount) {
$modestr = $mode[$i];
$col_span = 1;
 if (($i == 4 || $i == 13 || $i == 33 || $i == 39 || $i == 48)) {
$modestr = $mode[$i] . "-" . $mode[$i+1];
$col_span = 3;
$i ++;
}
 if ($i == 21 && $mode[$i] != "") {
$modestr = $mode[$i] . "-" . $mode[$i+1] . "-" . $mode[$i+2] . "-" . $mode[$i+3];
$col_span = 5;
$i = $i+3;
}
        echo "<td colspan=$col_span class=\"center nw\" style=\"$modestyle\">$modestr</td>";
$i ++;
}
	echo "</tr>\n";
foreach( array_keys($_POST) as $key ) {
     if( substr( $key, 0, 3 ) == "dna" ) {
	$testID = substr( $key, 3 );
        $query = "SELECT * 
	FROM $dna_tests_table WHERE testID=$testID";
        $result = tng_query($query);
	$row = tng_fetch_assoc( $result );
	$dna_pers_result = getPersonData($row['gedcom'], $row['personID']);
	$dprow = tng_fetch_assoc($dna_pers_result);
	$dna_righttree = checktree($dprow['gedcom']);
	$dna_rightbranch = $dna_righttree ? checkbranch($dprow['branch']) : false;
	$dprights = determineLivingPrivateRights($dprow, $dna_righttree, $dna_rightbranch);
		$dprow['allow_living'] = $dprights['living'];
		$dprow['allow_private'] = $dprights['private'];
		$dbname = getName( $dprow );
		$person_name = $row['person_name'];
		$dna_namestr = getName($dprow);
		        if ($row['private_dna'] && $allow_edit)
                                $privacy = "&nbsp;(" . $admtext['text_private'] . ")";
                         else
                                $privacy = "";
			if ($dbname) {
				$dna_namestr = $dna_namestr . $privacy;
			} else
				$dna_namestr = $person_name . $privacy;
		if ($row['private_dna'] && !$allow_edit) $dna_namestr = " - " . $admtext['text_private'];
	tng_free_result($dna_pers_result);
	echo "<tr>\n";
       if ($allow_edit || $showtestnumbers)
	echo "<td valign=\"top\" class=\"databack nw\">&nbsp;{$row['test_number']}&nbsp;</td>";
	echo "<td valign=\"top\" class=\"databack nw\">&nbsp;$dna_namestr&nbsp;</td>";
        $anc_namestr = "";
       if($row['MD_ancestorID']) {
	$dna_anc_result = getPersonSimple($row['gedcom'], $row['MD_ancestorID']);
	$ancrow = tng_fetch_assoc($dna_anc_result);
	$dna_righttree = checktree($row['gedcom']);
	$dna_rightbranch = $dna_righttree ? checkbranch($row['branch']) : false;
	$dprights = determineLivingPrivateRights($ancrow, $dna_righttree, $dna_rightbranch);
	$ancrow['allow_living'] = $dprights['living'];
	$ancrow['allow_private'] = $dprights['private'];
	$vitalinfo = getBirthInfo($ancrow);
	$anc_namestr = getName( $ancrow ) . $vitalinfo;

	tng_free_result($dna_anc_result);
}
	echo "<td valign=\"top\" class=\"databack nw\">&nbsp;$anc_namestr</td>";
       if( $row['haplogroup'] ) {
	if( ($row['test_type'] == "Y-DNA" && $row['confirmed'] ) ||  $row['test_type'] == "mtDNA" )
		$row['haplogroup'] = "<span class='confirmed_haplogroup'>" . $row['haplogroup'] . "</span>";
	else
		$row['haplogroup'] = "<span class='predicted_haplogroup'>" . $row['haplogroup'] . "</span>";
	echo "<td valign=\"top\" class=\"databack nw\">&nbsp;{$row['haplogroup']}</td>";
       }
      else
       echo "<td valign=\"top\" class=\"databack nw\">&nbsp;{$row['haplogroup']}</td>";
$resultscsv = str_replace( '-', ',', $row['y_results']);
$yresultsarr = explode( ',', $resultscsv );
$i = '1';
if ($ii && count($yresultsarr) <= "37") {
while ($i <= "30") {
array_push($yresultsarr, " ");
$i ++;
}
}
$i = '1';
if ($iii && count($yresultsarr) <= "67") {
while ($i <= "44") {
array_push($yresultsarr, " ");
$i ++;
}
}
$j = '0';
$displaystr = "";
while ($j <= $columnCount) {
$col_span = 1;
if (($j == 4 || $j == 13 || $j == 21 || $j == 33 || $j == 39 || $j == 48)) {
 if ($yresultsarr[$j] != $mode[$j] && $yresultsarr[$j] != " ")
  $displaystr = "<span class=\"deviationback\">{$yresultsarr[$j]}</span>-";
 else if ($yresultsarr[$j] != " ")
  $displaystr = "<span class=\"blackchars\">{$yresultsarr[$j]}</span>-";
$j ++;
 if ($yresultsarr[$j] != $mode[$j])
  $displaystr .= "<span class=\"deviationback\">{$yresultsarr[$j]}</span>";
 else if ($yresultsarr[$j] == " ") 
  $displaystr .= "<span>&nbsp;&nbsp;&nbsp;</span>";
 else
  $displaystr .= "<span class=\"blackchars\">{$yresultsarr[$j]}</span>";
$col_span = 3;
 if ($j == 22) {
$j ++;
   if ($yresultsarr[$j] != " " && $yresultsarr[$j] != $mode[$j])
    $displaystr .= "-<span class=\"deviationback\">{$yresultsarr[$j]}</span>-";
   else if ($yresultsarr[$j] != " ")
    $displaystr .= "-<span class=\"blackchars\">{$yresultsarr[$j]}</span>-";
$j ++;
   if ($yresultsarr[$j] != $mode[$j])
    $displaystr .= "<span class=\"deviationback\">{$yresultsarr[$j]}</span>";
   else
    $displaystr .= "<span class=\"blackchars\">{$yresultsarr[$j]}</span>";
$col_span = 5;
 }
}
 else
  $displaystr = ($yresultsarr[$j] != $mode[$j]) ? "<span class=\"deviationback\">{$yresultsarr[$j]}</span>" : "<span class=\"blackchars\">{$yresultsarr[$j]}</span>";
  echo "<td colspan=$col_span valign=\"top\" class=\"databack center nw\">$displaystr</td>";
	$j++;
}
	echo "</tr>\n";
     }
}
if ($result) tng_free_result($result);
?>
</table>
</div>
<br />
<?php
tng_footer( "" );
?>
