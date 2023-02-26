<?php
include("begin.php");
include($cms['tngpath'] . "genlib.php");
$textpart = "getperson";
include($cms['tngpath'] . "getlang.php");
include($cms['tngpath'] . "$mylanguage/text.php");

include($cms['tngpath'] . "api_checklogin.php" );
include($cms['tngpath'] . "personlib.php" );
include($cms['tngpath'] . "api_library.php" );
include($cms['tngpath'] . "log.php" );

header("Content-Type: application/json; charset=" . $session_charset);

$query = "SELECT *, DATE_FORMAT(changedate,\"%e %b %Y\") as changedate
	FROM $people_table WHERE personID = \"$personID\" AND gedcom = \"$tree\"";
$result = tng_query($query);
$row = tng_fetch_assoc($result);
if( !tng_num_rows($result) ) {
	tng_free_result($result);
	echo  "{\"error\":\"No one in database with that ID and tree\"}";
	exit;
}
else
	tng_free_result($result);

echo "{\n";

$righttree = checktree($tree);
$rightbranch = checkbranch($row['branch']);
$rights = determineLivingPrivateRights($row, $righttree);
$row['allow_living'] = $rights['living'];
$row['allow_private'] = $rights['private'];

$namestr = getName( $row );

$logname = $tngconfig['nnpriv'] && $row['private'] ? $admtext['text_private'] : ($nonames && $row['living'] ? $text['living'] : $namestr);

writelog( "<a href=\"$getperson_url" . "personID=$personID&amp;tree=$tree\">{$text['indinfofor']} $logname ($personID)</a>" );

$events = array();
echo api_person($row, $fullevents);
	
echo "}";
?>