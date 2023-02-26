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
include("deletelib.php");

$tree = $tree1;
if( !$allow_add || ( $assignedtree && $assignedtree != $tree ) ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$personID = ucfirst( trim($personID) );
setcookie("tng_tree", $tree, 0);

if(!isset($baptplace)) $baptplace = "";
if(!isset($confplace)) $confplace = "";
if(!isset($initplace)) $initplace = "";
if(!isset($endlplace)) $endlplace = "";
if(!isset($altbirthtype)) $altbirthtype = "";
if(!isset($altbirthdate)) $altbirthdate = "";
if(!isset($altbirthplace)) $altbirthplace = "";
if(!isset($newperson)) $newperson = "";
if(!isset($type)) $type = "";

if($newperson == "ajax" && $session_charset != "UTF-8") {
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
	$confplace = addslashes($confplace);
	$initplace = addslashes($initplace);
	$endlplace = tng_utf8_decode($endlplace);
}

/*
if (get_magic_quotes_gpc() == 0) {
	$firstname = addslashes($firstname);
	$lnprefix = addslashes($lnprefix);
	$lastname = addslashes($lastname);
	$nickname = addslashes($nickname);
	$prefix = addslashes($prefix);
	$suffix = addslashes($suffix);
	$title = addslashes($title);
	$birthplace = addslashes($birthplace);
	$altbirthplace = addslashes($altbirthplace);
	$deathplace = addslashes($deathplace);
	$burialplace = addslashes($burialplace);
	$baptplace = addslashes($baptplace);
	$confplace = tng_utf8_decode($confplace);
	$initplace = tng_utf8_decode($initplace);
	$endlplace = addslashes($endlplace);
}
*/

if(!isset($baptdate)) $baptdate = "";
if(!isset($confdate)) $confdate = "";
if(!isset($initdate)) $initdate = "";
if(!isset($endldate)) $endldate = "";

$birthdatetr = convertDate( $birthdate );
$altbirthdatetr = convertDate( $altbirthdate );
$deathdatetr = convertDate( $deathdate );
$burialdatetr = convertDate( $burialdate );
$baptdatetr = convertDate( $baptdate );
$confdatetr = convertDate( $confdate );
$initdatetr = convertDate( $initdate );
$endldatetr = convertDate( $endldate );

$newdate = date ("Y-m-d H:i:s", time() + ( 3600 * $time_offset ) );

$query = "SELECT personID FROM $people_table WHERE personID = \"$personID\" and gedcom = \"$tree\"";
$result = tng_query($query);

if( $result && tng_num_rows( $result ) ) {
	if($newperson == "ajax")
		echo "error:{$admtext['person']} $personID {$admtext['idexists']}";
	else {
		$message = "{$admtext['person']} $personID {$admtext['idexists']}";
		header( "Location: admin_people.php?message=" . urlencode($message) );
	}
	exit;
}

//delete all notes & citations linked to this person
deleteCitations($personID,$tree);
deleteEvents($personID,$tree);
deleteNoteLinks($personID,$tree);

$places = array();
if( trim($birthplace) && !in_array( $birthplace, $places ) ) array_push( $places, $birthplace );
if( trim($altbirthplace) && !in_array( $altbirthplace, $places ) ) array_push( $places, $altbirthplace );
if( trim($deathplace) && !in_array( $deathplace, $places ) ) array_push( $places, $deathplace );
if( trim($burialplace) && !in_array( $burialplace, $places ) ) array_push( $places, $burialplace );
if( trim($baptplace) && !in_array( $baptplace, $places ) ) array_push( $places, $baptplace );
if( trim($confplace) && !in_array( $confplace, $places ) ) array_push( $places, $confplace );
if( trim($initplace) && !in_array( $initplace, $places ) ) array_push( $places, $initplace );
if( trim($endlplace) && !in_array( $endlplace, $places ) ) array_push( $places, $endlplace );
$placetree = $tngconfig['places1tree'] ? "" : $tree;
$template = "ssss";
foreach( $places as $place ) {
	$temple = strlen($place) == 5 && $place == strtoupper($place) ? 1 : 0;
	$query = "INSERT IGNORE INTO $places_table (gedcom,place,placelevel,zoom,geoignore,temple,changedate,changedby) VALUES (?,?,\"0\",\"0\",\"0\",?,\"$newdate\",?)";
	$params = array(&$template,&$placetree,&$place,&$temple,&$currentuser);
	tng_execute($query,$params);
    if($tngconfig['autogeo'] && tng_affected_rows()) {
        $ID = tng_insert_id();
        $message = geocode($place, 0, $ID);
    }
}

$allbranches = "";
if( is_array( $branch ) ) {
	foreach( $branch as $b ) {
		if( $b ) $allbranches = $allbranches ? "$allbranches,$b" : $b;
	}
}
elseif(!empty($branch))
	$allbranches = $branch;
if( empty($living) ) $living = 0;
if( empty($private) ) $private = 0;
if( empty($burialtype) ) $burialtype = 0;
$meta = metaphone( $lnprefix . $lastname );
if(!$sex && isset($other_gender)) $sex = $other_gender;
$query = "INSERT INTO $people_table (personID,firstname,lnprefix,lastname,nickname,prefix,suffix,title,nameorder,living,private,birthdate,birthdatetr,birthplace,sex,altbirthtype,altbirthdate,altbirthdatetr,
	altbirthplace,deathdate,deathdatetr,deathplace,burialdate,burialdatetr,burialplace,burialtype,baptdate,baptdatetr,baptplace,confdate,confdatetr,confplace,initdate,initdatetr,initplace,
	endldate,endldatetr,endlplace,changedate,gedcom,branch,changedby,famc,metaphone,edituser,edittime)
	VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,\"$newdate\",?,?,?,\"\",?,\"\",\"0\")";
$template = "ssssssssssssssssssssssssssssssssssssssssss";
$params = array(&$template,&$personID,&$firstname,&$lnprefix,&$lastname,&$nickname,&$prefix,&$suffix,&$title,&$pnameorder,&$living,&$private,&$birthdate,&$birthdatetr,
	&$birthplace,&$sex,&$altbirthtype,&$altbirthdate,&$altbirthdatetr,&$altbirthplace,&$deathdate,&$deathdatetr,&$deathplace,&$burialdate,&$burialdatetr,&$burialplace,
	&$burialtype,&$baptdate,&$baptdatetr,&$baptplace,&$confdate,&$confdatetr,&$confplace,&$initdate,&$initdatetr,&$initplace,&$endldate,&$endldatetr,&$endlplace,
	&$tree,&$allbranches,&$currentuser,&$meta);
tng_execute($query,$params);
$ID = tng_insert_id();

$query = "SELECT personID, lastname, firstname, lnprefix, birthdate, altbirthdate, prefix, suffix, nameorder FROM $people_table WHERE ID=\"$ID\"";
$result = tng_query($query);
$row = tng_fetch_assoc($result);
$row['allow_living'] = $row['allow_private'] = 1;
tng_free_result($result);

$branchlist = explode(',',$allbranches);
$template = "sss";
foreach( $branchlist as $b ) {
	$query = "INSERT IGNORE INTO $branchlinks_table (branch,gedcom,persfamID) VALUES(?,?,?)";
	$params = array(&$template, &$b, &$tree, &$personID);
	tng_execute($query,$params);
}

adminwritelog( "<a href=\"admin_editperson.php?personID=$personID&amp;tree=$tree\">{$admtext['addnewperson']}: $tree/$personID</a>" );

if($type == "child") {
	if($familyID) {
		$query = "SELECT personID FROM $children_table WHERE familyID=\"$familyID\" AND gedcom=\"$tree\"";
		$result = @tng_query($query);
		$order = tng_num_rows($result);
		tng_free_result($result);

		$query = "INSERT INTO $children_table (familyID,personID,ordernum,gedcom,frel,mrel,haskids,parentorder,sealdate,sealdatetr,sealplace) VALUES (?,?,?,?,\"\",\"\",0,0,\"\",\"0000-00-00\",\"\")";
		$template = "ssis";
		$params = array(&$template, &$familyID, &$personID, &$order, &$tree);
		tng_execute($query,$params);

		$query = "SELECT husband,wife FROM $families_table WHERE familyID=\"$familyID\" AND gedcom=\"$tree\"";
		$result = @tng_query($query);
		$famrow = tng_fetch_assoc($result);
		$template = "ss";
		if($famrow['husband']) {
			$query = "UPDATE $children_table SET haskids=\"1\" WHERE personID = ? AND gedcom = ?";
			$params = array(&$template,&$famrow['husband'],&$tree);
			tng_execute($query,$params);
		}
		if($famrow['wife']) {
			$query = "UPDATE $children_table SET haskids=\"1\" WHERE personID = ? AND gedcom = ?";
			$params = array(&$template,&$famrow['wife'],&$tree);
			tng_execute($query,$params);
		}
		tng_free_result($result);
	}

	if ( $row['birthdate'] ) {
		$birthdate = $admtext['birthabbr'] . " " . $row['birthdate'];
	}
	else if ( $row['altbirthdate'] ) {
		$birthdate = $admtext['chrabbr'] . " " . $row['altbirthdate'];
	}
	else {
		$birthdate = "";
	}

	$rval = "<div class=\"sortrow\" id=\"child_$personID\" style=\"width:500px;clear:both;display:none\"";
	$rval .= " onmouseover=\"$('unlinkc_$personID').style.visibility='visible';\" onmouseout=\"$('unlinkc_$personID').style.visibility='hidden';\">\n";
	$rval .= "<table width=\"100%\" cellpadding=\"5\" cellspacing=\"1\"><tr>\n";
	$rval .= "<td class=\"dragarea normal\">";
	$rval .= "<img src=\"img/admArrowUp.gif\" alt=\"\"><br/>" . $admtext['drag'] . "<br/><img src=\"img/admArrowDown.gif\" alt=\"\">\n";
	$rval .= "</td>\n";
	$rval .= "<td class=\"lightback normal childblock\">\n";

	$rval .= "<div id=\"unlinkc_$personID\" class=\"smaller hide-right\"><a href=\"#\" onclick=\"return unlinkChild('$personID','child_unlink');\">{$admtext['remove']}</a> &nbsp; | &nbsp; <a href=\"#\" onclick=\"return unlinkChild('$personID','child_delete');\">{$admtext['text_delete']}</a></div>";
	$personlink = getName($row);
	if($newperson != "ajax")
		$personlink = "<a href=\"#\" onclick=\"EditChild('$personID');\">$personlink</a>";
	$rval .= "$personlink - $personID<br />$birthdate</div>\n</td>\n</tr>\n</table>\n</div>\n";
	echo $rval;
}
elseif( $type == "spouse") {
	$name = $session_charset == "UTF-8" ? getName($row) : mb_convert_encoding(getName($row), 'UTF-8', 'ISO-8859-1');
	echo "{\"id\":\"{$row['personID']}\",\"name\":\"" . $name . "\"}";
}
elseif($newperson == "ajax")
	echo 1;
else
	header( "Location: admin_editperson.php?personID=$personID&tree=$tree&added=1" );
?>