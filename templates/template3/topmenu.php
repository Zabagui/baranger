<?php
	global $text, $cms, $subroot, $tmp;
?>
<body id="bodytop" class="<?php echo pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME); ?>">
<table style="width: 100%; border-spacing: 0px; padding: 5px;" class="tableborder rounded10 t3shadow">
	<tr>
		<td class="t3hdr rounded10">
<?php
	//begin HEADER IMAGE (default: small picture of Main Street, Mt. Pleasant, Utah, ca. 1910)
	//Actual file name has been replaced with t3_headimg variable, configurable from Template Settings. Default name of actual image is "headerphoto.jpg"
	//You can replace the t3_headimg PHP block in the line below with the desired image name if you prefer that to using the Template Settings.
?>
			<img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t3_headimg']; ?>" alt="" class="headerphoto" width="186" height="110" />
<?php
	//end HEADER IMAGE
?>
		</td>
		<td class="topmenu rounded10">
<?php
	//begin HEADER TITLE IMAGE (default: "Our Family Genealogy Pages")
	//Actual file name has been replaced with t3_headtitleimg variable, configurable from Template Settings. Default name of actual image is "headertitle.gif"
	//You can replace the t3_headtitleimg PHP block in the line below with the desired image name if you prefer that to using the Template Settings.

	if($tmp['t3_titlechoice'] == "text") {
?>
	<em class="toptitle"><?php echo getTemplateMessage('t3_maintitle'); ?></em><br />
<?php
	}
	else {
?>
			<img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t3_headtitleimg']; ?>" alt="" class="menutitle"  />
<?php
	}
	//end HEADER TITLE IMAGE
?>
			<br />
			<a href="<?php echo $cms['tngpath']; ?>index.php" class="topmenu"><?php echo $text['homepage']; ?></a> |
			<a href="<?php echo $cms['tngpath']; ?>whatsnew.php" class="topmenu"><?php echo $text['mnuwhatsnew']; ?></a> |
			<a href="<?php echo $cms['tngpath']; ?>browsemedia.php?mediatypeID=photos" class="topmenu"><?php echo $text['mnuphotos']; ?></a> |
			<a href="<?php echo $cms['tngpath']; ?>browsemedia.php?mediatypeID=histories" class="topmenu" ><?php echo $text['mnuhistories']; ?></a> |
			<a href="<?php echo $cms['tngpath']; ?>browsesources.php" class="topmenu"><?php echo $text['mnusources']; ?></a> |
			<a href="<?php echo $cms['tngpath']; ?>reports.php" class="topmenu"><?php echo $text['mnureports']; ?></a> |
			<a href="<?php echo $cms['tngpath']; ?>calendar.php" class="topmenu"><?php echo $text['calendar']; ?></a> |
			<a href="<?php echo $cms['tngpath']; ?>cemeteries.php" class="topmenu"><?php echo $text['mnucemeteries']; ?></a> |
			<a href="<?php echo $cms['tngpath']; ?>browsemedia.php?mediatypeID=headstones" class="topmenu"><?php echo $text['mnutombstones']; ?></a> |
			<a href="<?php echo $cms['tngpath']; ?>statistics.php" class="topmenu"><?php echo $text['mnustatistics']; ?></a> |
			<a href="<?php echo $cms['tngpath']; ?>surnames.php" class="topmenu"><?php echo $text['mnulastnames']; ?></a>
		</td>
	</tr>
</table>
<!-- end of topmenu.php for template 3 -->