<?php
include("begin.php");
include("adminlib.php");
$textpart = "families";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

require("adminlog.php");
require("datelib.php");

include("geocodelib.php");

$query = "SELECT branch, edituser, edittime FROM $families_table WHERE familyID = \"$familyID\" and gedcom = \"$tree\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
tng_free_result($result);

if( !$allow_edit || ( $assignedtree && $assignedtree != $tree ) || !checkbranch( $row['branch'] ) ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}
if( !isset($newfamily) ) $newfamily = "";

$editconflict = determineConflict($row,$families_table);

if(!$editconflict) {
	if($newfamily == "ajax" && $session_charset != "UTF-8") {
		$marrplace = tng_utf8_decode($marrplace);
		$divplace = tng_utf8_decode($divplace);
		$sealplace = tng_utf8_decode($sealplace);
		$marrtype = tng_utf8_decode($marrtype);
	}

	$marrplace = addslashes($marrplace);
	$divplace = addslashes($divplace);
	$sealplace = addslashes($sealplace);
	$marrtype = addslashes($marrtype);

	$marrdatetr = convertDate( $marrdate );
	$divdatetr = convertDate( $divdate );
	$sealdatetr = convertDate( $sealdate );

	//get living from husband, wife
	$husband = ucfirst(trim($husband));
	if( $husband ) {
		$spquery = "SELECT living FROM $people_table WHERE personID = \"$husband\" AND gedcom = \"$tree\"";
		$spouselive = tng_query($spquery) or die ($admtext['cannotexecutequery'] . ": $spquery");
		$spouserow =  tng_fetch_assoc( $spouselive );
		$husbliving = $spouserow['living'];
	}
	else
		$husbliving = 0;

	$wife = ucfirst(trim($wife));
	if( $wife ) {
		$spquery = "SELECT living FROM $people_table WHERE personID = \"$wife\" AND gedcom = \"$tree\"";
		$spouselive = tng_query($spquery) or die ($admtext['cannotexecutequery'] . ": $spquery");
		$spouserow =  tng_fetch_assoc( $spouselive );
		$wifeliving = $spouserow['living'];
	}
	else
		$wifeliving = 0;
	$familyliving = isset($living) ? $living : 0;
	if( empty($private) ) $private = 0;
	//$familyliving = ($husbliving || $wifeliving) ? 1 : 0;

	$newdate = date ("Y-m-d H:i:s", time() + ( 3600 * $time_offset ) );
	if( !isset($branch) )
		$branch = "";

	if( is_array( $branch ) ) {
		if( !isset($allbranches) ) $allbranches = "";
		foreach( $branch as $b ) {
			if( $b )
				$allbranches = $allbranches ? "$allbranches,$b" : $b;
		}
	}
	else {
		$allbranches = $branch;
		$branch = array($branch);
	}

	if( $allbranches != $orgbranch ) {
		$oldbranches = explode(",", $orgbranch );
		foreach( $oldbranches as $b ) {
			if( $b && !in_array( $b, $branch ) ) {
				$query = "DELETE FROM $branchlinks_table WHERE persfamID = \"$familyID\" AND gedcom = \"$tree\" AND branch = \"$b\"";
				$result = tng_query($query);
			}
		}
		foreach( $branch as $b ) {
			if( $b && !in_array( $b, $oldbranches ) ) {
				$query = "INSERT IGNORE INTO $branchlinks_table (branch,gedcom,persfamID) VALUES(\"$b\",\"$tree\",\"$familyID\")";
				$result = tng_query($query);
			}
		}
	}

	$places = array();
	if( trim($marrplace) && !in_array( $marrplace, $places ) ) array_push( $places, $marrplace );
	if( trim($divplace) && !in_array( $divplace, $places ) ) array_push( $places, $divplace );
	if( trim($sealplace) && !in_array( $sealplace, $places ) ) array_push( $places, $sealplace );
	$placetree = $tngconfig['places1tree'] ? "" : $tree;
	foreach( $places as $place ) {
		$query = "INSERT IGNORE INTO $places_table (gedcom,place,placelevel,zoom,geoignore) VALUES (\"$placetree\",\"$place\",\"0\",\"0\",\"0\")";
		$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
	    if($tngconfig['autogeo'] && tng_affected_rows()) {
	        $ID = tng_insert_id();
	        $message = geocode($place, 0, $ID);
	    }
	}

	$query = "UPDATE $families_table SET husband=\"$husband\",wife=\"$wife\",living=\"$familyliving\",private=\"$private\",marrdate=\"$marrdate\",marrdatetr=\"$marrdatetr\",marrplace=\"$marrplace\",marrtype=\"$marrtype\",divdate=\"$divdate\",divdatetr=\"$divdatetr\",divplace=\"$divplace\",sealdate=\"$sealdate\",sealdatetr=\"$sealdatetr\",sealplace=\"$sealplace\",changedate=\"$newdate\",branch=\"$allbranches\",changedby=\"$currentuser\",edituser=\"\",edittime=\"0\" WHERE familyID=\"$familyID\" AND gedcom = \"$tree\"";
	$result = tng_query($query);

	adminwritelog( "<a href=\"admin_editfamily.php?familyID=$familyID&amp;tree=$tree&amp;cw=$cw\">{$admtext['modifyfamily']}: $tree/$familyID</a>" );
	$message = $admtext['changestofamily'] . " $familyID {$admtext['succsaved']}.";
}
else
	$message = $admtext['notsaved'];

if( $media == "1" )
	header( "Location: admin_newmedia.php?personID=$familyID&tree=$tree&linktype=F&cw=$cw&ref=1" );
elseif( isset($_POST['saveret']) )
	header( "Location: admin_families.php?message=" . urlencode($message) );
elseif( isset($_POST['savestay']) )
	header( "Location: admin_editfamily.php?familyID=$familyID&tree=$tree&cw=$cw&ref=1" );
elseif( isset($_POST['saveclose']) ) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<script type="text/javascript">
	window.opener.location.reload(false);
	window.open('','_self').close();
	window.location.href = "admin_families.php?message=<?php echo urlencode($message); ?>";
</script>
</head>
<body>
<p>A change in your browser's default behavior is preventing this window from closing.</p>
<p>To change this behavior in Firefox, type <i>about:config</i> in the browser address bar and press enter.</p>
<p>Then search for <i>dom.allow_scripts_to_close_windows</i> and change the value of that setting from False to True.</p>
<p>For all other browsers, please close this window or tab.</p>
</body>
</html>
<?php
}
elseif( $newfamily == "ajax" )
	echo 1;
?>