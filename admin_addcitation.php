<?php
include("begin.php");
include("adminlib.php");
$textpart = "sources";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

require("datelib.php");
require("adminlog.php");

if( !$allow_add ) {
	$message = $admtext['norights'];
	exit;
}

if($session_charset != "UTF-8") {
	$citepage = tng_utf8_decode($citepage);
	$citetext = tng_utf8_decode($citetext);
	$citenote = tng_utf8_decode($citenote);
}

/*
if (get_magic_quotes_gpc() == 0) {
	$citedate = addslashes($citedate);
	$citepage = addslashes($citepage);
	$citetext = addslashes($citetext);
	$citenote = addslashes($citenote);
}
*/

$citedatetr = convertDate( $citedate );
$sourceID = strtoupper($sourceID);

$template = "ssssssssss";

$query = "SELECT title FROM $sources_table WHERE sourceID = \"$sourceID\" AND gedcom = \"$tree\"";
$result = tng_query($query);

if ($row = tng_fetch_assoc($result)) {
	header("Content-type:text/html; charset=" . $session_charset);
	$returnvals = "";
	if(!isset($events)) $events = [$eventID];
	foreach($events as $event) {
		$query = "INSERT INTO $citations_table (gedcom, persfamID, eventID, sourceID, page, quay, citedate, citedatetr, citetext, note, description, ordernum)  
			VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?,'', 999)";
		$params = array(&$template,&$tree, &$persfamID, &$event, &$sourceID, &$citepage, &$quay, &$citedate, &$citedatetr, &$citetext, &$citenote);
		tng_execute($query,$params);
		$citationID = tng_insert_id();
		
		$_SESSION['lastcite'] = $tree . "|" . $citationID;
		adminwritelog( $admtext['addnewcite'] . ": $citationID/$tree/$persfamID/$event/$sourceID" );
		
		$citationsrc = "[$sourceID] " . $row['title'];
		$citationsrc = cleanIt($citationsrc);
		$truncated = truncateIt($citationsrc,75);
		if($returnvals) $returnvals .= ",";
		$returnvals .= "{\"id\":\"$citationID\",\"persfamID\":\"$persfamID\",\"tree\":\"$tree\",\"eventID\":\"$event\",\"display\":\"$truncated\",\"allow_edit\":$allow_edit,\"allow_delete\":$allow_delete}";
	}
	echo "[{$returnvals}]";
}
else {
	header("Content-type:text/html; charset=" . $session_charset);
	echo "[{\"display\":\"[$sourceID] - Not a Valid Source - CITATION NOT ADDED!\"}]";
}
tng_free_result($result);
?>