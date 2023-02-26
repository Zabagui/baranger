<?php
include("begin.php");
include($cms['tngpath'] . "genlib.php");
$textpart = "getperson";
include($cms['tngpath'] . "getlang.php");
include($cms['tngpath'] . "$mylanguage/text.php");

include($cms['tngpath'] . "checklogin.php");

if($p && !$cms['support'])
	$cms['tngpath'] = urldecode($p);

$bookmarks_url = getURL("bookmarks", 0);

$newroot = preg_replace( "/\//", "", $rootpath );
$newroot = preg_replace( "/\s*/", "", $newroot );
$newroot = preg_replace( "/\./", "", $newroot );
$ref = "tngbookmarks_$newroot";

$bookmarks = isset($_COOKIE[$ref]) ? explode("|", $_COOKIE[$ref]) : [];
$bookmarkstr = $_SESSION['tnglastpage'];
foreach( $bookmarks as $bookmark ) {
	if( $bookmark && stripslashes($bookmark) != stripslashes($_SESSION['tnglastpage']) )
		$bookmarkstr .= "|" . $bookmark;
}

setcookie($ref, stripslashes($bookmarkstr), time()+31536000, "/");

header("Content-type:text/html; charset=" . $session_charset);
?>

<div class="databack ajaxwindow" id="bkmkdiv">
<span class="subhead"><img src="<?php echo $cms['tngpath']; ?>img/tng_bmk.gif" width="20" height="20" align="left" alt="" vspace="0" />&nbsp;<strong><?php echo $text['bookmarked']; ?></strong></span><br/><br/>
<?php
//$bookmarks = explode(";", $_COOKIE[$ref]);
//foreach( $bookmarks as $bookmark ) {
//	echo "$bookmark<br>\n";
//}
?>
<form >
<input type="button" onclick="tnglitbox.remove();return false;" value="<?php echo $text['closewindow']; ?>" />
<input type="button" onclick="window.location.href='<?php echo $bookmarks_url ?>';" value="<?php echo $text['mngbookmarks']; ?>" />
</form>

</div>