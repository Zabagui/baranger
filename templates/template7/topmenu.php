<?php
	global $text, $currentuser, $cms, $allow_admin, $subroot, $tmp, $mediatypes;
?>
<body id="bodytop" class="<?php echo pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME); ?>">

<div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="headertitle">
			<tr class="row">
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
<?php
	//begin TITLE IMAGE (default: "Our Family History")
	//Actual file name has been replaced with t7_titleimg variable, configurable from Template Settings. Default name of actual image is "logo.jpg"
	//You can replace the t7_titleimg PHP block in the line below with the desired image name if you prefer that to using the Template Settings.

	if($tmp['t7_titlechoice'] == "text") {
?>
							<td class="logo" style="padding:10px;background:url(<?php echo $cms['tngpath'] . $templatepath; ?>img/logoedge.gif) no-repeat right #DCD5B9;" width="400">
								<div><em id="maintitle">

								<?php echo getTemplateMessage('t7_maintitle'); ?>

								</em></div>
							</td>
<?php
	}
	else {
?>
 							<td class="logo">
								<img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t7_titleimg']; ?>" alt="" />
							</td>
<?php
	}
	//end TITLE IMAGE
?>
							<td class="news"><span class="emphasis"><?php echo $text['news'] ; ?>:</span>

<?php
	//begin NEWS TEXT (default text: "This section can be used for brief news announcements")
	//Configurable from Template Settings. You can also replace the t7_newstext PHP block below with the desired text if you prefer that to using the Template Settings.
?>

		<?php echo getTemplateMessage('t7_newstext'); ?>

<?php
	//end NEWS TEXT
?>

							</td>
						</tr>
					</table>
			<form action="<?php echo $cms['tngpath']; ?>search.php" method="get" style="margin:0px">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">			
						<tr class="strip">
							<td class="fieldnameback">
								<span class="fieldname">
								&nbsp; <?php echo $text['mnufirstname']; ?>: <input type="text" name="myfirstname" size="18" />
								&nbsp;<?php echo $text['mnulastname']; ?>: <input type="text" name="mylastname" size="18" />
								<input type="hidden" name="mybool" value="AND" /><input type="hidden" name="offset" value="0" />
								<input type="submit" name="search" value="<?php echo $text['mnusearch']; ?>" />
								</span>
							</td>
						</tr>
					</table>
			</form>
				</td>
			</tr>
			</table>
		
		<table border="0" cellspacing="0" cellpadding="0" class="page" width="100%">
			<tr>
				<td class="section">
					
				<table width="193" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td class="tableheader"></td>
						<td class="fieldname">
						<?php
	if( $currentuser ) {
		echo "<a href=\"{$cms['tngpath']}logout.php\" class=\"lightlink\">{$text['mnulogout']}</a><br />\n";
	}
	elseif( empty($tngconfig['showlogin']) ) {
		echo "<a href=\"{$cms['tngpath']}login.php\" class=\"lightlink\">{$text['mnulogon']}</a><br />\n";
	}
	echo "<a href=\"{$cms['tngpath']}searchform.php\" class=\"lightlink\">{$text['mnuadvancedsearch']}</a><br />\n";
	echo "<a href=\"{$cms['tngpath']}surnames.php\" class=\"lightlink\">{$text['mnulastnames']}</a><br />\n";
	echo "<a href=\"{$cms['tngpath']}whatsnew.php\" class=\"lightlink\">{$text['mnuwhatsnew']}</a><br />\n";
	echo "<a href=\"{$cms['tngpath']}mostwanted.php\" class=\"lightlink\">{$text['mostwanted']}</a><br />\n";

	foreach( $mediatypes as $mediatype ) {
		if(!$mediatype['disabled']) {
			echo "<li><a href=\"{$cms['tngpath']}browsemedia.php?mediatypeID={$mediatype['ID']}\" class=\"lightlink\">{$mediatype['display']}</a></li>\n";
		}
	}

	echo "<a href=\"{$cms['tngpath']}browsealbums.php\" class=\"lightlink\">{$text['albums']}</a><br />\n";
	echo "<a href=\"{$cms['tngpath']}browsemedia.php\" class=\"lightlink\">{$text['allmedia']}</a><br />\n";
	echo "<a href=\"{$cms['tngpath']}cemeteries.php\" class=\"lightlink\">{$text['mnucemeteries']}</a><br />\n";
	echo "<a href=\"{$cms['tngpath']}places.php\" class=\"lightlink\">{$text['places']}</a><br />\n";
	echo "<a href=\"{$cms['tngpath']}browsenotes.php\" class=\"lightlink\">{$text['notes']}</a><br />\n";
	echo "<a href=\"{$cms['tngpath']}anniversaries.php\" class=\"lightlink\">{$text['anniversaries']}</a><br />\n";
	echo "<a href=\"{$cms['tngpath']}calendar.php\" class=\"lightlink\">{$text['calendar']}</a><br />\n";
	echo "<a href=\"{$cms['tngpath']}reports.php\" class=\"lightlink\">{$text['mnureports']}</a><br />\n";
	echo "<a href=\"{$cms['tngpath']}browsesources.php\" class=\"lightlink\">{$text['mnusources']}</a><br />\n";
	echo "<a href=\"{$cms['tngpath']}browserepos.php\" class=\"lightlink\">{$text['repositories']}</a><br />\n";
	if(!$tngconfig['hidedna'])
		echo "<a href=\"{$cms['tngpath']}browse_dna_tests.php\" class=\"lightlink\">{$text['dna_tests']}</a><br />\n";
	echo "<a href=\"{$cms['tngpath']}statistics.php\" class=\"lightlink\">{$text['mnustatistics']}</a><br />\n";
	echo "<a href=\"{$cms['tngpath']}changelanguage.php\" class=\"lightlink\">{$text['mnulanguage']}</a><br />\n";
	if( $allow_admin ) {
		echo "<a href=\"{$cms['tngpath']}showlog.php\" class=\"lightlink\">{$text['mnushowlog']}</a><br />\n";
		echo "<a href=\"{$cms['tngpath']}admin.php\" class=\"lightlink\">{$text['mnuadmin']}</a><br />\n";
	}
	echo "<a href=\"{$cms['tngpath']}bookmarks.php\" class=\"lightlink\">{$text['bookmarks']}</a><br />\n";
	echo "<a href=\"{$cms['tngpath']}suggest.php?page=$title\" class=\"lightlink\">{$text['contactus']}</a><br />\n";
	if(!$currentuser && !$tngconfig['disallowreg'])
		echo "<a href=\"{$cms['tngpath']}newacctform.php\" class=\"lightlink\">{$text['mnuregister']}</a><br />\n";
?>
</td>
							</tr>
						
					</table>
				</td>
				<td valign="top">
					<table border="0" cellspacing="0" cellpadding="0" width="100%">
						<tr>
							<td colspan="2"><div class="normal"><br />
<!-- end of topmenu.php for template 7 -->