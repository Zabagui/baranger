<?php
include("begin.php");
include($cms['tngpath'] . "genlib.php");
$textpart = "showphoto";
include($cms['tngpath'] . "getlang.php");
include($cms['tngpath'] . "$mylanguage/text.php");

include($cms['tngpath'] . "functions.php" );
include($cms['tngpath'] . "checklogin.php");
include($cms['tngpath'] . "showmedialib.php");

//starting time between slides
//now defined in slideshow.js

header("Content-type:text/html; charset=" . $session_charset);
?>

<div class="databack" id="slideshell">

	<div id="slideshow">
		<div id="loadingdiv" class="rounded10" style="display:none"><?php echo $text['loading']; ?></div>
		<div id="div1" class="slide">
<?php
	initMediaTypes();

	include("showmediaxmllib.php");

	echo "<p class=\"adminnav topmargin\">$pagenav</p>";
	echo "<p class=\"subhead\"><strong>" . truncateIt($description,100) . "</strong></p>\n";

	if( !$private_media && ($noneliving || $imgrow['alwayson']) ) {
		showMediaSource($imgrow, true);
	}
	else {
?>
            <div style="width:400px; height:300px; border:1px solid black"><?php echo $description; ?></div>
<?php
	}
?>
		</div>
		<div id="div0" class="slide" style="display:none"></div>
	</div>
</div>