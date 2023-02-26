<?php
include("begin.php");
include($cms['tngpath'] . "genlib.php");
$textpart = "imgviewer";
include($cms['tngpath'] . "getlang.php");
include($cms['tngpath'] . "$mylanguage/text.php");

header("Content-type:text/html;charset=" . $session_charset);
echo $tngconfig['doctype'] ? $tngconfig['doctype'] . "\n\n" : "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \n\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n\n";
?>
<html>
<head>
<?php @include $custommeta;
	if( $session_charset )
		echo "<meta http-equiv=\"Content-type\" content=\"text/html; charset=$session_charset\" />\n";
	$title = $_GET['title'];
	$siteprefix = $sitename ? htmlspecialchars($title ? ": " . $sitename : $sitename, ENT_QUOTES, $session_charset) : "";
	$title = htmlspecialchars($title, ENT_QUOTES, $session_charset);
?>
    <link href="<?php echo $cms['tngpath']; ?>css/img_viewer.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo $cms['tngpath']; ?>js/img_viewer.js"></script>
    <title><?php echo $title; ?></title>
</head>

<body onload="calcHeight(window.innerHeight);">
<?php
	include($cms['tngpath'] . "js/img_utils.js");
	echo "<div id=\"loadingdiv2\" style=\"position:static;\">{$text['loading']}</div>\n";
?>

<iframe name="iframe1" id="iframe1" src="<?php echo getURL("img_viewer",1); ?>sa=1&amp;mediaID=<?php echo $_GET['mediaID']; ?>&amp;medialinkID=<?php echo $_GET['medialinkID']; ?>" width="100%" height="1" onLoad="calcHeight(1);" frameborder="0" marginheight="0" marginwidth="0" scrolling="no">
</iframe>
</body>
</html>