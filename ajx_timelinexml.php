<?php
$textpart = "timeline";
include("tng_begin.php");

include($subroot . "pedconfig.php" );
include($cms['tngpath'] . "datelib.php");

header('Content-Type: application/xml');
echo "<?xml version=\"1.0\"";
if($session_charset)
	echo " encoding=\"$session_charset\"";
echo "?>\n";
echo "<data>\n";

$wherestr = $pedigree['tcevents'] ? "WHERE (evyear BETWEEN \"$earliest\" AND \"$latest\") OR (endyear BETWEEN \"$earliest\" AND \"$latest\")" : "";
$tlquery = "SELECT evday, evmonth, evyear, evtitle, evdetail, endday, endmonth, endyear FROM $tlevents_table $wherestr ORDER BY evyear, evmonth, evday";
$tlresult = tng_query($tlquery) or die ($text['cannotexecutequery'] . ": $tlquery");
$tlevents = array();
$tlevents2 = array();
while( $tlrow = tng_fetch_assoc($tlresult)) {
	if($tlrow['evday'] == "0") $tlrow['evday'] = "1";
	if($tlrow['evmonth'] == "0") $tlrow['evmonth'] = "1";

	$beg_date = date("M d Y", gmmktime(12, 0, 0, $tlrow['evmonth'], $tlrow['evday'], $tlrow['evyear']));
	$beg_date_gmt = $beg_date . " GMT";
	$end_date = "";
	$isduration = "";
	if($tlrow['endyear']) {
	    if($tlrow['endmonth'] == "0") $tlrow['endmonth'] = "12";
    	if($tlrow['endday'] == "0")   $tlrow['endday'] = cal_days_in_month(CAL_GREGORIAN, $tlrow['endmonth'], $tlrow['endyear']); 
		$end_date = date("M d Y", gmmktime(12, 0, 0, $tlrow['endmonth'], $tlrow['endday'], $tlrow['endyear']));
		$end_date_gmt = $end_date . " GMT";
		if($end_date_gmt != $beg_date_gmt)
			$isduration = "isDuration=\"true\"";
	}
	else {
		$end_date_gmt = $beg_date_gmt;
	}
	$date_info = $beg_date;
	if($end_date) $date_info .= " - $end_date";
	if($date_info) $date_info = " ($date_info)";

	$evtitle = $tlrow['evtitle'] ? $tlrow['evtitle'] : $tlrow['evdetail'];
	echo "<event start=\"" . $beg_date_gmt . "\" end=\"" . $end_date_gmt . "\" $isduration icon=\"img/red-circle.png\" title=\" " . htmlspecialchars($evtitle, ENT_QUOTES, $session_charset) . "\">" . htmlspecialchars($tlrow['evdetail'] . $date_info, ENT_QUOTES, $session_charset) . "</event>\n";
}
tng_free_result( $tlresult );

echo "</data>\n";
?>