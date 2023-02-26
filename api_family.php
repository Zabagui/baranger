<?php
include("begin.php");
include($cms['tngpath'] . "genlib.php");
$textpart = "familygroup";
include($cms['tngpath'] . "getlang.php");
include($cms['tngpath'] . "$mylanguage/text.php");

include($cms['tngpath'] . "api_checklogin.php" );
include($cms['tngpath'] . "personlib.php" );
include($cms['tngpath'] . "api_library.php" );
include($cms['tngpath'] . "log.php" );

header("Content-Type: application/json; charset=" . $session_charset);

//get family
$query = "SELECT familyID, husband, wife, living, private, marrdate, gedcom, branch FROM $families_table WHERE familyID = \"$familyID\" AND gedcom = \"$tree\"";
$result = tng_query($query);
$famrow = tng_fetch_assoc($result);
if( !tng_num_rows($result) ) {
	tng_free_result($result);
	echo  "{\"error\":\"No one in database with that ID and tree\"}";
	exit;
}
else
	tng_free_result($result);

echo "{\n";

$righttree = checktree($tree);
$rightbranch = checkbranch($famrow['branch']);
$rights = determineLivingPrivateRights($famrow, $righttree, $rightbranch);
$row['allow_living'] = $rights['living'];
$row['allow_private'] = $rights['private'];

$famname = getFamilyName( $famrow );
$namestr = $text['family'] . ": " . $famname;

$logstring = "<a href=\"$familygroup_url" . "familyID=$familyID&amp;tree=$tree\">{$text['familygroupfor']} $famname</a>";
writelog($logstring);

$family = "\"id\":\"{$famrow['familyID']}\",\"tree\":\"{$famrow['gedcom']}\"";
//get husband & spouses
if( $famrow['husband'] ) {
    $query = "SELECT * FROM $people_table WHERE personID = \"{$famrow['husband']}\" AND gedcom = \"$tree\"";
    $result = tng_query($query);
    $husbrow = tng_fetch_assoc($result);

	$hrights = determineLivingPrivateRights($husbrow, $righttree);
	$husbrow['allow_living'] = $hrights['living'];
	$husbrow['allow_private'] = $hrights['private'];

    $events = array();
    $family .= ",\"father\":{" . api_person($husbrow, $fullevents) . "}";
    tng_free_result($result);
}

//get wife & spouses
if( $famrow['wife'] ) {
    $query = "SELECT * FROM $people_table WHERE personID = \"{$famrow['wife']}\" AND gedcom = \"$tree\"";
    $result = tng_query($query);
    $wiferow = tng_fetch_assoc($result);

	$wrights = determineLivingPrivateRights($wiferow, $righttree);
	$wiferow['allow_living'] = $wrights['living'];
	$wiferow['allow_private'] = $wrights['private'];

    $events = array();
    $family .= ",\"mother\":{" . api_person($wiferow, $fullevents) . "}";
    tng_free_result($result);
}

$events = array();
if($rights['both'] ) {
    setMinEvent( array( "date"=>$famrow['marrdate'], "place"=>$famrow['marrplace'], "event"=>"MARR" ), $famrow['marrdatetr'] );
    setMinEvent( array( "date"=>$famrow['divdate'], "place"=>$famrow['divplace'], "event"=>"DIV" ), $famrow['divdatetr'] );

    if( $fullevents && $rights['lds'] ) {
        setMinEvent( array( "date"=>$famrow['sealdate'], "place"=>$famrow['sealplace'], "event"=>"SLGS" ), $famrow['sealdatetr'] );
    }

    if($fullevents)
        doCustomEvents($familyID,"F");
}
$eventstr = processEvents($events);
if($eventstr)
    $family .= "," . $eventstr;

//for each child
$query = "SELECT $people_table.personID as personID, branch, firstname, lnprefix, lastname, prefix, suffix, nameorder, living, private, famc, sex, birthdate, birthplace,
	altbirthdate, altbirthplace, haskids, deathdate, deathplace, burialdate, burialplace, baptdate, baptplace, confdate, confplace, initdate, initplace, endldate, endlplace, sealdate, sealplace
	FROM $people_table, $children_table
	WHERE $people_table.personID = $children_table.personID AND $children_table.familyID = \"{$famrow['familyID']}\" AND $people_table.gedcom = \"$tree\" AND
	$children_table.gedcom = \"$tree\" ORDER BY ordernum";
$children= tng_query($query);

if( $children && tng_num_rows( $children ) ) {
    $childcount = 0;
    $family .= ",\"children\":[";
    while( $childrow = tng_fetch_assoc($children) ) {
        if($childcount)
            $family .= ",";
        $childcount++;

		$crights = determineLivingPrivateRights($childrow, $righttree);
		$childrow['allow_living'] = $crights['living'];
		$childrow['allow_private'] = $crights['private'];

        $events = array();
        $family .= "{" . api_person($childrow, $fullevents) . "}";
    }
    $family .= "]";
}
tng_free_result($children);

echo $family;

echo "}";
?>