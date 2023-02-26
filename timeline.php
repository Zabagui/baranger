<?php
$textpart = "timeline";
include("tng_begin.php");

$timeline = isset($_SESSION['timeline']) ? $_SESSION['timeline'] : "";
if( !is_array( $timeline ) ) $timeline = array();

$tng_message = $_SESSION['tng_message'] = "";
if(!empty($newwidth))
	$_SESSION['timeline_chartwidth'] = $newwidth;

if( $primaryID ) {
	$newentry = "timeperson=$primaryID" . "&timetree=$tree";
	if( !in_array( $newentry, $timeline ) ) {
		array_push( $timeline, $newentry );
		$_SESSION['timeline'] = $timeline;
	}
}
for( $i = 2; $i < 6; $i++ ) {
	$nextpersonID = "nextpersonID$i";
	$nexttree = "nexttree$i";
	if( isset($$nextpersonID) && $$nextpersonID != "" ) {
		$newentry2 = "timeperson=" . strtoupper($$nextpersonID) . "&timetree=" . $$nexttree;
		if( !in_array( $newentry2, $timeline ) ) {
			array_push( $timeline, $newentry2 );
			$_SESSION['timeline'] = $timeline;
		}
	}
}

if( !isset($timetree) ) $timetree = "";
$righttree = checktree($timetree);

$finalarray = array();
foreach( $timeline as $timeentry ) {
	parse_str( $timeentry, $output );
	$todelete = $output['timetree'] . "_" . $output['timeperson'];
	if( empty($$todelete) || $$todelete != "1" ) {
		$result2 = getPersonDataPlusDates($output['timetree'], $output['timeperson']);
		if( $result2 ) {
			$row2 = tng_fetch_assoc( $result2 );
			$rights = determineLivingPrivateRights($row2, $output['timetree']);
			$row2['allow_living'] = $rights['living'];
			$row2['allow_private'] = $rights['private'];
			if( ($row2['living'] && !$rights['living']) || ($row2['private'] && !$rights['private']) )
				$tng_message .= $text['noliving'] . ": " . getName( $row2 ) . " ({$output['timeperson']})<br/>\n";
			elseif( !$row2['birth'] )
				$tng_message .= $text['nobirth'] . ": " . getName( $row2 ) . " ({$output['timeperson']})<br/>\n";
			else
				array_push( $finalarray, $timeentry );
			tng_free_result($result2);
		}
	}
}
$timeline = $_SESSION['timeline'] = $finalarray;
$_SESSION['tng_message'] = $tng_message;

$timeline2_url = getURL( "timeline2", 1 );
if( !isset($newwidth) ) $newwidth = "";
header( "Location: $timeline2_url" . "primaryID=$primaryID&tree=$tree&chartwidth=$newwidth" );
?>
