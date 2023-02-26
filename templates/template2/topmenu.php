<?php global $text, $subroot, $tmp; ?>
<body id="bodytop" class="<?php echo pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME); ?> bodytopmenu">

<table border="0" cellspacing="0" cellpadding="0" class="page" width="100%">
	<tr>
		<td>&nbsp;</td>
		<td valign="top">

<?php
	//begin HEADER IMAGE (default: small picture of the girl at the top left)
	//Actual file name has been replaced with t2_headimg variable, configurable from Template Settings. Default name of actual image is "headerphoto.jpg"
	//You can replace the t2_headimg PHP block in the line below with the desired image name if you prefer that to using the Template Settings.
?>
			<img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t2_headimg']; ?>" alt="" class="headerimg" width="70" height="99" />
<?php
	//end HEADER IMAGE
?>

		</td>
		<td align="center" valign="top">
			<table cellspacing="0" cellpadding="0">
				<tr><td align="center"><a href="<?php echo $cms['tngpath']; ?>index.php" class="toptitle">
<?php
	//begin HEADER TITLE IMAGE (default: "Our Family Genealogy Pages")
	//Actual file name has been replaced with t2_headtitleimg variable, configurable from Template Settings. Default name of actual image is "headertitle.gif"
	//You can replace the t2_headtitleimg PHP block in the line below with the desired image name if you prefer that to using the Template Settings.

	if($tmp['t2_titlechoice'] == "text") {
?>
				<em class="toptitle"><?php echo getTemplateMessage('t2_maintitle'); ?></em>
<?php
	}
	else {
?>

				<img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t2_headtitleimg']; ?>" alt="<?php echo $text['ourpages']; ?>" width="312" height="78" class="noimgborder" />
<?php
	}
	//end HEADER TITLE IMAGE
?>

				</a></td></tr>
				<tr>
					<td align="center" valign="bottom">
						<span class="topmenu">
						<br />
						<a href="<?php echo $cms['tngpath']; ?>index.php" class="topmenu"><?php echo $text['mnuheader']; ?></a>
						&nbsp;|&nbsp;
						<a href="<?php echo $cms['tngpath']; ?>whatsnew.php" class="topmenu"><?php echo $text['mnuwhatsnew']; ?></a>
						&nbsp;|&nbsp;
						<a href="<?php echo $cms['tngpath']; ?>browsemedia.php?mediatypeID=photos" class="topmenu"><?php echo $text['mnuphotos']; ?></a>
						&nbsp;|&nbsp;
						<a href="<?php echo $cms['tngpath']; ?>browsemedia.php?mediatypeID=histories" class="topmenu"><?php echo $text['mnuhistories']; ?></a>
						&nbsp;|&nbsp;
						<a href="<?php echo $cms['tngpath']; ?>browsemedia.php?mediatypeID=headstones" class="topmenu"><?php echo $text['mnutombstones']; ?></a>
						&nbsp;|&nbsp;
						<a href="<?php echo $cms['tngpath']; ?>reports.php" class="topmenu"><?php echo $text['mnureports']; ?></a>
						&nbsp;|&nbsp;
						<a href="<?php echo $cms['tngpath']; ?>surnames.php" class="topmenu"><?php echo $text['mnulastnames']; ?></a>
						</span>
					</td>
				</tr>
			</table>
		</td>
		<td valign="top" align="right">
			<form action="search.php" method="get" id="topsearch" style="margin:0px">
			<table cellspacing="0" cellpadding="0">
				<tr>
					<td class="topmenu">
						<span class="headertitle"><?php echo $text['search']; ?></span><br />
						<?php echo $text['firstname']; ?>:<br /><input type="text" name="myfirstname" class="searchbox" size="10" /><br />
						<img src="<?php echo $cms['tngpath']; ?>img/spacer.gif" alt="" width="100%" height="3" /><br />
						<?php echo $text['lastname']; ?>: <br /><input type="text" name="mylastname" size="10" class="searchbox" /><br />
						<input type="hidden" name="mybool" value="AND" />
					</td>
					<td><br /><br /><input type="image" name="imgsubmit" src="<?php echo $cms['tngpath'] . $templatepath; ?>img/button-header.jpg" style="border:none" class="menusubmit" /></td>
				</tr>
			</table>
		</form>
		</td>
	</tr>
	<tr><td colspan="4" class="tabletopedge"></td></tr>

	<tr><td colspan="4" class="tablebkground">
			<table cellspacing="0" cellpadding="10" width="100%">
				<tr>
					<td>
						  <div class="normal">  
<!-- end topmenu.php for template 2 -->