<?php
include("begin.php");
include("adminlib.php");
$textpart = "reports";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( $assignedtree || !$allow_add ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");

/*
if (get_magic_quotes_gpc() == 0) {
	$reportname = addslashes($reportname);
	$reportdesc = addslashes($reportdesc);
	$criteria = addslashes($criteria);
	$sqlselect = addslashes($sqlselect);
}
*/

$template = "ssssssss";
$query = "INSERT INTO $reports_table (reportname, reportdesc, ranking, active, display, criteria, orderby, sqlselect) VALUES (?,?,?,?,?,?,?,?)";
$params = array(&$template, &$reportname, &$reportdesc, &$ranking, &$active, &$display, &$criteria, &$orderby, &$sqlselect);
tng_execute($query,$params);
$reportID = tng_insert_id();

adminwritelog( "<a href=\"admin_editreport.php?reportID=$reportID\">{$admtext['addnewreport']}: $reportID $reportname</a>" );

$message = $admtext['report'] . " $reportID {$admtext['succadded']}.";
header( "Location: admin_reports.php?message=" . urlencode($message) );

if( !empty($submitx) ) {
	$message = $admtext['report'] . " $reportID {$admtext['succadded']}.";
	header( "Location: admin_reports.php?message=" . urlencode($message) );
}
else {
	header( "Location: admin_editreport.php?reportID=$reportID" );
}
?>