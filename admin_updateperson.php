<?php
include("begin.php");
include("adminlib.php");
$textpart = "people";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

require("adminlog.php");
require("datelib.php");

include("geocodelib.php");

$query = "SELECT branch, edituser, edittime FROM $people_table WHERE personID = \"$personID\" and gedcom = \"$tree\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
tng_free_result($result);

if( (!$allow_edit && (!$allow_add || !$added)) || ( $assignedtree && $assignedtree != $tree ) || !checkbranch( $row['branch'] ) ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$editconflict = determineConflict($row,$people_table);

if(!$editconflict) {
	if(empty($altbirthdate)) $altbirthdate = "";
	if(empty($altbirthplace)) $altbirthplace = "";
	if(empty($altbirthtype)) $altbirthtype = "";

	if(!empty($newfamily) && $newfamily == "ajax" && $session_charset != "UTF-8") {
		$firstname = tng_utf8_decode($firstname);
		$lastname = tng_utf8_decode($lastname);
		$lnprefix = tng_utf8_decode($lnprefix);
		$nickname = tng_utf8_decode($nickname);
		$prefix = tng_utf8_decode($prefix);
		$suffix = tng_utf8_decode($suffix);
		$title = tng_utf8_decode($title);
		$birthplace = tng_utf8_decode($birthplace);
		$altbirthplace = tng_utf8_decode($altbirthplace);
		$deathplace = tng_utf8_decode($deathplace);
		$burialplace = tng_utf8_decode($burialplace);
		$baptplace = tng_utf8_decode($baptplace);
		$confplace = tng_utf8_decode($confplace);
		$initplace = tng_utf8_decode($initplace);
		$endlplace = tng_utf8_decode($endlplace);
	}

	$firstname = addslashes($firstname);
	$lastname = addslashes($lastname);
	$lnprefix = addslashes($lnprefix);
	$nickname = addslashes($nickname);
	$prefix = addslashes($prefix);
	$suffix = addslashes($suffix);
	$title = addslashes($title);
	$birthplace = addslashes($birthplace);
	$altbirthplace = addslashes($altbirthplace);
	$deathplace = addslashes($deathplace);
	$burialplace = addslashes($burialplace);
	$baptplace = addslashes($baptplace);
	$confplace = addslashes($confplace);
	$initplace = addslashes($initplace);
	$endlplace = addslashes($endlplace);

	$birthdatetr = convertDate( $birthdate );
	$altbirthdatetr = convertDate( $altbirthdate );
	$deathdatetr = convertDate( $deathdate );
	$burialdatetr = convertDate( $burialdate );
	$baptdatetr = convertDate( $baptdate );
	$confdatetr = convertDate( $confdate );
	$initdatetr = convertDate( $initdate );
	$endldatetr = convertDate( $endldate );

	$newdate = date ("Y-m-d H:i:s", time() + ( 3600 * $time_offset ) );

	if(!isset($branch))
		$branch = "";
	if(!isset($allbranches)) $allbranches = "";
	if( is_array( $branch ) ) {
		foreach( $branch as $b ) {
			if( $b ) $allbranches = $allbranches ? "$allbranches,$b" : $b;
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
				$query = "DELETE FROM $branchlinks_table WHERE persfamID = \"$personID\" AND gedcom = \"$tree\" AND branch = \"$b\"";
				$result = tng_query($query);
			}
		}
		foreach( $branch as $b ) {
			if( $b && !in_array( $b, $oldbranches ) ) {
				$query = "INSERT IGNORE INTO $branchlinks_table (branch,gedcom,persfamID) VALUES(\"$b\",\"$tree\",\"$personID\")";
				$result = tng_query($query);
			}
		}
	}

	$places = array();
	if( trim($birthplace) && !in_array( $birthplace, $places ) ) array_push( $places, $birthplace );
	if( trim($altbirthplace) && !in_array( $altbirthplace, $places ) ) array_push( $places, $altbirthplace );
	if( trim($deathplace) && !in_array( $deathplace, $places ) ) array_push( $places, $deathplace );
	if( trim($burialplace) && !in_array( $burialplace, $places ) ) array_push( $places, $burialplace );
	if( trim($baptplace) && !in_array( $baptplace, $places ) ) array_push( $places, $baptplace );
	if( trim($confplace) && !in_array( $conftplace, $places ) ) array_push( $places, $confplace );
	if( trim($initplace) && !in_array( $initplace, $places ) ) array_push( $places, $initplace );
	if( trim($endlplace) && !in_array( $endlplace, $places ) ) array_push( $places, $endlplace );
	$placetree = $tngconfig['places1tree'] ? "" : $tree;
	foreach( $places as $place ) {
		$query = "INSERT IGNORE INTO $places_table (gedcom,place,placelevel,zoom,geoignore) VALUES (\"$placetree\",\"$place\",\"0\",\"0\",\"0\")";
		$result = @tng_query( $query ) or die ($admtext['cannotexecutequery'] . ": $query");
	    if($tngconfig['autogeo'] && tng_affected_rows()) {
	        $ID = tng_insert_id();
	        $message = geocode($place, 0, $ID);
	    }
	}

	$query = "SELECT familyID FROM $children_table WHERE personID = \"$personID\" AND gedcom = \"$tree\" ORDER BY parentorder";
	$parents = tng_query($query);

	$famc = "";
	if( $parents && tng_num_rows( $parents ) ) {
		while ( $parent = tng_fetch_assoc( $parents ) ) {
			$sealpdate = ${"sealpdate".$parent['familyID']};
			$sealpplace = ${"sealpplace".$parent['familyID']};
			$sealplace = isset($sealplace) ? addslashes( $sealplace ) : "";
			$sealpdatetr = convertdate( ${"sealpdate".$parent['familyID']} );
			$frel = !empty(${"frel".$parent['familyID']}) ? ${"frel".$parent['familyID']} : "";
			$mrel = !empty(${"mrel".$parent['familyID']}) ? ${"mrel".$parent['familyID']} : "";
			$query = "UPDATE $children_table SET sealdate=\"$sealpdate\", sealdatetr=\"$sealpdatetr\", sealplace=\"$sealpplace\", frel=\"$frel\", mrel=\"$mrel\" WHERE familyID = \"{$parent['familyID']}\" AND personID = \"$personID\" AND gedcom = \"$tree\"";
			$result2 = @tng_query($query);
			if( !$famc )
				$famc = $parent['familyID'];
		}
		tng_free_result($parents);
	}

	$famcstr = $famc ? ", famc = \"$famc\"" : "";
	if( empty($living) ) $living = 0;
	if( empty($private) ) $private = 0;
	if( empty($burialtype) ) $burialtype = 0;
	$meta = metaphone( $lnprefix . $lastname );
	if(!$sex && isset($other_gender)) $sex = $other_gender;
	$query = "UPDATE $people_table SET firstname=\"$firstname\", lnprefix=\"$lnprefix\", lastname=\"$lastname\", nickname=\"$nickname\", prefix=\"$prefix\", suffix=\"$suffix\", title=\"$title\", nameorder=\"$pnameorder\", living=\"$living\", private=\"$private\",
		birthdate=\"$birthdate\", birthdatetr=\"$birthdatetr\", birthplace=\"$birthplace\", sex=\"$sex\", altbirthtype=\"$altbirthtype\", altbirthdate=\"$altbirthdate\", altbirthdatetr=\"$altbirthdatetr\", altbirthplace=\"$altbirthplace\",
		deathdate=\"$deathdate\", deathdatetr=\"$deathdatetr\", deathplace=\"$deathplace\", burialdate=\"$burialdate\", burialdatetr=\"$burialdatetr\", burialplace=\"$burialplace\", burialtype=\"$burialtype\",
		baptdate=\"$baptdate\", baptdatetr=\"$baptdatetr\", baptplace=\"$baptplace\", confdate=\"$confdate\", confdatetr=\"$confdatetr\", confplace=\"$confplace\", initdate=\"$initdate\", initdatetr=\"$initdatetr\", initplace=\"$initplace\", endldate=\"$endldate\", endldatetr=\"$endldatetr\", endlplace=\"$endlplace\", changedate=\"$newdate\",branch=\"$allbranches\",changedby=\"$currentuser\",edituser=\"\",edittime=\"0\",metaphone=\"$meta\" $famcstr WHERE personID=\"$personID\" AND gedcom = \"$tree\"";
	$result = tng_query($query);

	if( $sex == "M" ) {
		$self = "husband"; $spouseorder = "husborder";
	}
	else if ($sex == "F" ) {
		$self = "wife"; $spouseorder = "wifeorder";
	}
	else {
		$self = ""; $spouseorder = "";
	}

	if( $self )
		 $query = "SELECT familyID, husband, wife FROM $families_table WHERE $families_table.$self = \"$personID\" AND gedcom = \"$tree\" ORDER BY $spouseorder";
	else
		$query = "SELECT familyID, husband, wife FROM $families_table WHERE ($families_table.husband = \"$personID\" OR $families_table.wife = \"$personID\") AND gedcom = \"$tree\"";
	$marriages= tng_query($query);

	if ( $marriages && tng_num_rows( $marriages ) ) {
		while ( $marriagerow =  tng_fetch_assoc( $marriages ) ) {
			if( $personID == $marriagerow['husband'] ) {
				$spquery = "SELECT living, private FROM $people_table WHERE personID = \"{$marriagerow['wife']}\" AND gedcom = \"$tree\"";
			}
			else if( $personID == $marriagerow['wife'] ) {
				$spquery = "SELECT living, private FROM $people_table WHERE personID = \"{$marriagerow['husband']}\" AND gedcom = \"$tree\"";
			}
			else
				$spquery = "";
			if( $spquery ) {
				$spouselive = tng_query($spquery) or die ($admtext['cannotexecutequery'] . ": $spquery");
				$spouserow =  tng_fetch_assoc( $spouselive );
				$spouseliving = $spouserow['living'];
				$spouseprivate = $spouserow['private'];
			}
			else
				$spouseliving = $spouseprivate = 0;
			$familyliving = ($living || $spouseliving) ? 1 : 0;
			$familyprivate = ($private || $spouseprivate) ? 1 : 0;
			//branch clause removed in 11.1.1; probably shouldn't have been there
			//$query = "UPDATE $families_table SET living = \"$familyliving\", private = \"$familyprivate\", branch = \"$allbranches\" WHERE familyID = \"{$marriagerow['familyID']}\" AND gedcom = \"$tree\"";
			$query = "UPDATE $families_table SET living = \"$familyliving\", private = \"$familyprivate\" WHERE familyID = \"{$marriagerow['familyID']}\" AND gedcom = \"$tree\"";
			$spouseresult= @tng_query($query);
		}
	}

	adminwritelog( "<a href=\"admin_editperson.php?personID=$personID&amp;tree=$tree\">{$admtext['modifyperson']}: $tree/$personID</a>" );
	$message = $admtext['changestoperson'] . " $personID {$admtext['succsaved']}.";
}
else
	$message = $admtext['notsaved'];

if( isset($media) && $media == "1" )
	header( "Location: admin_newmedia.php?personID=$personID&tree=$tree&linktype=I&cw=$cw&ref=1" );
elseif( isset($_POST['saveret']) )
	header( "Location: admin_people.php?message=" . urlencode($message) );
elseif( isset($_POST['savestay']) )
	header( "Location: admin_editperson.php?personID=$personID&tree=$tree&cw=$cw&ref=1" );
elseif( isset($_POST['savepar']) )
	header( "Location: admin_newfamily.php?child=$personID&tree=$tree&cw=$cw&ref=1" );
elseif( isset($_POST['saveclose']) ) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<script type="text/javascript">
	if(!window.opener.location.href.includes("admin_editfamily") && !window.opener.location.href.includes("admin_newfamily"))
		window.opener.location.reload(false);
	window.open('','_self').close();
	window.location.href = "admin_people.php?message=<?php echo urlencode($message); ?>";
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
elseif( isset($newfamily) && $newfamily == "ajax" ) {
	$row = array(
		'personID' => $personID,
		'firstname' => $firstname,
		'lastname' => $lastname,
		'lnprefix' => $lnprefix,
		'prefix' => $prefix,
		'suffix' => $suffix,
		'title' => $title,
		'nameorder' => $pnameorder,
		'living' => $living,
		'private' => $private,
		'branch' => $allbranches,
		'allow_living' => 1
	);
	$name = $session_charset == "UTF-8" ? getName($row) : mb_convert_encoding(getName($row), 'UTF-8', 'ISO-8859-1');
	echo "{\"id\":\"$personID\",\"name\":\"" . $name . "\"}";
}
else
	header( "Location: admin_newfamily.php?$self=$personID&tree=$tree&cw=$cw" );
?>