<?php
include("begin.php");
include($cms['tngpath'] . "genlib.php");
$textpart = "showphoto";
include($cms['tngpath'] . "getlang.php");
include($cms['tngpath'] . "$mylanguage/text.php");

include($cms['tngpath'] . "functions.php" );
include($cms['tngpath'] . "personlib.php" );
include($cms['tngpath'] . "checklogin.php");
include($cms['tngpath'] . "showmedialib.php");

$showmedia_url = getURL( "showmedia", 1 );
$getperson_url = getURL( "getperson", 1 );
$familygroup_url = getURL( "familygroup", 1 );
$showsource_url = getURL( "showsource", 1 );
$showrepo_url = getURL( "showrepo", 1 );
$browsemedia_url = getURL( "browsemedia", 1 );
$placesearch_url = getURL( "placesearch", 1 );
$histories_url = getURL( "histories", 1 );

initMediaTypes();

include("showmediaxmllib.php");

if( $page < $totalpages )
	$nextpage = $page + 1;
else
	$nextpage = 1;
$nextmediaID = get_item_id( $result, $nextpage - 1, "mediaID" );
$nextmedialinkID = get_item_id( $result, $nextpage - 1, "medialinkID" );
$nextalbumlinkID = get_item_id( $result, $nextpage - 1, "albumlinkID" );
header("Content-type:text/html; charset=" . $session_charset);
echo "mediaID=$nextmediaID&medialinkID=$nextmedialinkID&albumlinkID=$nextalbumlinkID";

tng_free_result( $result );

echo "<p class=\"adminnav topmargin\">$pagenav</p>";
echo "<p class=\"subhead\"><strong>" . truncateIt($description,100) . "</strong></p>\n";

if( !$private_media && ($noneliving || $imgrow['alwayson']) ) {
	showMediaSource($imgrow, true);
}
else {
?>
    <div class="livingbox rounded10"><?php echo $description; ?></div>
<?php
}
?>