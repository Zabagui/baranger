<?php
include("begin.php");
include("adminlib.php");
$textpart = "generateID";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include($cms['tngpath'] . "checklogin.php");

function getNewID( $type, $table ) {
	global $tree, $admtext, $tngconfig;

	$prefix = $tngconfig[$type.'prefix'];
	$suffix = $tngconfig[$type.'suffix'];

	if(!isset($tngconfig['oldids']))
		$tngconfig['oldids'] = "";
	if($tngconfig['oldids']) {
		if( $prefix ) {
			$prefixlen = strlen( $prefix ) + 1;
			$query = "SELECT /* admin_generateID.php */ MAX(0+SUBSTRING($type" . "ID,$prefixlen)) as newID FROM $table WHERE gedcom = \"$tree\" AND $type" . "ID LIKE \"$prefix%\"";
		}
		else
			$query = "SELECT /* admin_generateID.php */ MAX(0+SUBSTRING_INDEX($type" . "ID,'$suffix',1)) as newID FROM $table WHERE gedcom = \"$tree\"";

		$result = tng_query($query) or die ($admtext['cannotexecutequery'] . ": $query");
		$maxrow = tng_fetch_array( $result );
		tng_free_result($result);

		$newID = $prefix . str_pad( $maxrow['newID'] + 1, strlen($maxrow['newID']) . $suffix, "0", STR_PAD_LEFT );
	}
	else {
//
// revision: 20200206 by Butch
// 
// removed cookies for saving lastid by user
// new SQL scan index only to provide next gap
//
		$lastid = 1; 		
		$found = false;

		$typestr = $type . "ID";

		if($prefix) {
			$preflen = strlen($prefix);
			$numpart = "CAST(SUBSTRING($typestr," . ($preflen + 1) . ") as SIGNED)";
			$numpart2 = "SUBSTRING($typestr," . ($preflen + 1) . ", 1)";
			// numpart3 restricts the ID's selected to those with the same prefix as current
			$numpart3 = "SUBSTRING($typestr, 1, $preflen) = \"$prefix\"";
			$wherestr = " AND $numpart >= $lastid";
		}

		elseif($suffix) {
			$suflen = strlen($suffix);
			$numpart = "CAST(SUBSTRING($typestr, 1, (length($typestr)- ".$suflen.")) as SIGNED)";
			$numpart2 = "SUBSTRING($typestr, 1, 1)";
			// numpart3 restricts the ID's selected to those with the same suffix as current
			$numpart3 = "SUBSTRING($typestr, -$suflen, $suflen) = \"$suffix\"";
			$wherestr = " AND $numpart >= $lastid";
		}

		else {
			$numpart = $typestr;
			$numpart2 = "1";
			$numpart3 = "1 = 1";
			$wherestr = "";
		}

		// SQL does the work
	
		$query = "SELECT /* admin_generateID.php */ ";
		// format of output
		$query .= "CAST(z.expected AS UNSIGNED) as gap ";
		// remainder of SELECT
		$query .= "FROM (SELECT ";
		$query .= "@rownum:=if (@rownum > 0,@rownum+1,$lastid) AS expected, ";
		$query .= "IF(@rownum=$numpart, 0, @rownum:=$numpart) AS got ";
		$query .= "FROM (SELECT @rownum:=0) AS a ";
		$query .= "Join $table ";
		$query .= "WHERE $numpart3 and $numpart2 != '0' and $numpart >= $lastid and gedcom = \"$tree\" ";
		$query .= "ORDER BY $numpart) AS z ";
		$query .= "WHERE z.got!=0 ";
		$query .= "LIMIT 1";

		$result = tng_query($query);

		if ($result and tng_num_rows($result) > 0) {
			$row = tng_fetch_array($result);
			$lastid = $row['gap'];
		}
		else {
			if (!$result){
				echo "SQL Error ID generation<br>";
				die ("Cannot continue");
			}
			// no gap found so use the last ID number +1
			$query = "Select max($numpart+1) as lastID from $table where $numpart3 and gedcom = \"$tree\"";
			$result = tng_query($query);
			if ($result and tng_num_rows($result) > 0) {
				$row = tng_fetch_array($result);
				$lastid = $row['lastID'];
			}
			// default to the initial value of 1 for empty tables
			if ($lastid == "" or !is_numeric($lastid)) {
				$lastid = 1;
			}
		}
		$newID = $prefix . $lastid . $suffix;

	}

	return $newID;
}

switch( $type ) {
	case "person":
		$newID = getNewID( "person", $people_table );
		break;
	case "family":
		$newID = getNewID( "family", $families_table );
		break;
	case "source":
		$newID = getNewID( "source", $sources_table );
		break;
	case "repo":
		$newID = getNewID( "repo", $repositories_table );
		break;
}
echo $newID;
?>