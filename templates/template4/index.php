<?php
$flags['noicons'] = true;
$flags['noheader'] = true;
$flags['nobody'] = true;
$tngconfig['showshare'] = false;
tng_header( $sitename ? "" : $text['ourpages'], $flags );
if(!$cms['support'] && $sitever != "mobile")
	echo "<body id=\"bodytop\" class=\"" . pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME) . " publicback\">\n";
$title1 = getTemplateMessage('t4_headtitle1');
$title2 = getTemplateMessage('t4_headtitle2'); 
$title = "$title1 $title2";
$text['contactus_long'] = str_replace( "suggest.php", "suggest.php?page=" . urlencode($title), $text['contactus_long'] );
?>


<div class="center">
<table class="indexpage">
<tr><td colspan="4" class="line"></td></tr>
<tr>
<?php
	if($sitever != "mobile") {
?>
	<td class="menuback">
		<a href="searchform.php" class="searchimg"><?php echo $text['search']; ?></a>
		<form action="search.php" method="get">
		<table class="menuback">
			<tr><td><span class="fieldname"><?php echo $text['mnufirstname']; ?>:<br /><input type="text" name="myfirstname" class="searchbox" size="14" /></span></td></tr>
			<tr><td><span class="fieldname"><?php echo $text['mnulastname']; ?>: <br /><input type="text" name="mylastname" class="searchbox" size="14" /></span></td></tr>
			<tr><td><input type="hidden" name="mybool" value="AND" /><input type="submit" name="search" value="<?php echo $text['mnusearchfornames']; ?>" class="small" /></td></tr>
		</table>
		</form>
		<table class="menuback">
			<tr>
			<td>
			<div class="fieldname">
				<ul>
				<li><a href="searchform.php" class="lightlink"><?php echo $text['mnuadvancedsearch']; ?></a></li>
				<li><a href="surnames.php" class="lightlink"><?php echo $text['mnulastnames']; ?></a><br /><br /></li>
				</ul>
<?php
		if( $currentuser ) {
	    	echo "<p><span class=\"emphasisyellow\">{$text['welcome']}, $currentuserdesc.</span></p>\n";
			echo "<ul>\n";
			echo "<li><a href=\"logout.php\" class=\"lightlink\">{$text['mnulogout']}</a></li>\n";
		}
		else {
			echo "<ul>\n";
			echo "<li><a href=\"login.php\" class=\"lightlink\">{$text['mnulogon']}</a></li>\n";
		}
		echo "<li><a href=\"whatsnew.php\" class=\"lightlink\">{$text['mnuwhatsnew']}</a></li>\n";
		echo "<li class=\"margin-bottom\"><a href=\"mostwanted.php\" class=\"lightlink\">{$text['mostwanted']}</a></li>\n";

		foreach( $mediatypes as $mediatype ) {
			if(!$mediatype['disabled']) {
				echo "<li><a href=\"browsemedia.php?mediatypeID={$mediatype['ID']}\" class=\"lightlink\">{$mediatype['display']}</a></li>\n";
			}
		}
		echo "<li><a href=\"browsealbums.php\" class=\"lightlink\">{$text['albums']}</a></li>\n";
		echo "<li><a href=\"browsemedia.php\" class=\"lightlink\">{$text['allmedia']}</a></li>\n";

		echo "<li class=\"margin-top\"><a href=\"cemeteries.php\" class=\"lightlink\">{$text['mnucemeteries']}</a></li>\n";
		echo "<li><a href=\"places.php\" class=\"lightlink\">{$text['places']}</a></li>\n";
		echo "<li><a href=\"browsenotes.php\" class=\"lightlink\">{$text['notes']}</a></li>\n";
		echo "<li><a href=\"anniversaries.php\" class=\"lightlink\">{$text['anniversaries']}</a></li>\n";
		echo "<li><a href=\"calendar.php\" class=\"lightlink\">{$text['calendar']}</a></li>\n";
		echo "<li><a href=\"reports.php\" class=\"lightlink\">{$text['mnureports']}</a></li>\n";
		echo "<li><a href=\"browsesources.php\" class=\"lightlink\">{$text['mnusources']}</a></li>\n";
		echo "<li><a href=\"browserepos.php\" class=\"lightlink\">{$text['repositories']}</a></li>\n";
		if(!$tngconfig['hidedna'])
			echo "<li><a href=\"browse_dna_tests.php\" class=\"lightlink\">{$text['dna_tests']}</a></li>\n";
		echo "<li><a href=\"statistics.php\" class=\"lightlink\">{$text['mnustatistics']}</a></li>\n";
		echo "<li><a href=\"changelanguage.php\" class=\"lightlink\">{$text['mnulanguage']}</a></li>\n";
		if( !empty($allow_admin) ) {
			echo "<li><a href=\"showlog.php\" class=\"lightlink\">{$text['mnushowlog']}</a></li>\n";
			echo "<li><a href=\"admin.php\" class=\"lightlink\">{$text['mnuadmin']}</a></li>\n";
		}
		echo "<li><a href=\"bookmarks.php\" class=\"lightlink\">{$text['bookmarks']}</a></li>\n";
		echo "<li><a href=\"suggest.php?page=" . urlencode($title) . "\" class=\"lightlink\">{$text['contactus']}</a></li>\n";
		if(!$currentuser && !$tngconfig['disallowreg'])
			echo "<li><a href=\"newacctform.php\" class=\"lightlink\">{$text['mnuregister']}</a></li>\n";
		echo "</ul><br/>\n";
?>
				</div>
			</td>
			</tr>
		</table>
	</td>
<?php
	}
?>
	<td class="spacercol">&nbsp;&nbsp;&nbsp;</td>
	<td class="content">
<?php
	//begin HEADER IMAGE (default: small picture of a girl at the top right)
	//Actual file name has been replaced with t4_headimg variable, configurable from Template Settings. Default name of actual image is "smallphoto.jpg"
	//You can replace the t4_headimg PHP block in the line below with the desired image name if you prefer that to using the Template Settings.
	if($sitever != "mobile") {
?>
		<img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t4_headimg']; ?>" alt="" class="smallphoto" />
<?php
	}
	//end HEADER IMAGE


	//begin TITLE IMAGE (default: "Our Family Genealogy Pages")
	//Actual file name has been replaced with t4_titleimg variable, configurable from Template Settings. Default name of actual image is "title.gif"
	//You can replace the t4_titleimg PHP block in the line below with the desired image name if you prefer that to using the Template Settings.

	if($tmp['t4_titlechoice'] == "text" || $sitever == "mobile") {
?>
			 	<div><br />

				<span class="titletop"><?php echo $title1; ?></span><br />
				<span class="titlebottom">&nbsp;<?php echo $title2; ?></span>

				</div>
<?php
	}
	else {
?>
					<img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t4_titleimg']; ?>" alt="" class="banner" width="468" height="100" />
<?php
	}
	//end TITLE IMAGE
?>
			<div>
				<div class="leftsection"><br />
<?php
	//begin MAIN IMAGE (default: large picture of Main Street, Mt. Pleasant, Utah, ca. 1915)
	//Actual file name has been replaced with t4_mainimage variable, configurable from Template Settings. Default name of actual image is "bigphoto.jpg"
	//You can replace the t4_mainimage PHP block in the line below with the desired image name if you prefer that to using the Template Settings.
?>
					<img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t4_mainimage']; ?>" alt="" class="bigphoto"/><br />
<?php
	//end MAIN IMAGE
?>
					<span class="smaller">
<?php
	//begin MAIN IMAGE CAPTION
	//Configurable from Template Settings. You can also replace the t4_photocaption PHP block in the line below with the desired text if you prefer that to using the Template Settings.
	//Example:  &nbsp;&nbsp;<i>This is my caption</i><br />
?>
					&nbsp;&nbsp;<i><?php echo getTemplateMessage('t4_photocaption'); ?></i><br />
<?php
	//end MAIN IMAGE CAPTION
?>
					</span>
					<div class="normal">
<?php
	//begin HEADLINE
	//Configurable from Template Settings. You can also replace the t4_headline PHP block in the line below with the desired text if you prefer that to using the Template Settings.
	//Example:  &nbsp;&nbsp;<h3>This is my headline</h3>
?>
					<h3><?php echo getTemplateMessage('t4_headline'); ?></h3>
<?php
	//end HEADLINE


	//begin WELCOME PARAGRAPH
	//Configurable from Template Settings. You can also replace the t4_mainpara PHP block in the line below with the desired text if you prefer that to using the Template Settings.
	//Example:  <p>This is my welcome paragraph. If I had more to say, it would be several lines long.</p>
?>
					<p><?php echo getTemplateMessage('t4_mainpara'); ?></p>
<?php
	//end WELCOME PARAGRAPH
?>
					</div>
				</div>
				<div class="rightsection"><br />
					<table border="0" cellspacing="0" cellpadding="0">
						<tr><td valign="top"><span class="normal"><b><?php echo $text['featarts']; ?></b></span></td></tr>
						<tr><td valign="top" class="line"></td></tr>
						<tr><td valign="top">
							<div class="normal">
<?php
	//begin FEATURES 1-4
	//Configurable from Template Settings. You can also replace the PHP blocks in the code below with the desired elements if you prefer that to using the Template Settings.
	//Example:
	//<a href="histories/feature1.php"><img src="featurethumb1.gif" alt="feature 1" class="featureimg" /></a>
	//<a href="histories/feature1.php"><span class="emphasis">Feature Story 1</span></a> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.<br /><br />
?>
							<p>
								<a href="<?php echo $tmp['t4_featurelink1']; ?>"><img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t4_featurethumb1']; ?>" alt="feature 1" class="featureimg" /></a>
								<a href="<?php echo $tmp['t4_featurelink1']; ?>"><span class="emphasis"><?php echo getTemplateMessage('t4_featuretitle1'); ?></span></a> <?php echo getTemplateMessage('t4_featurepara1'); ?><br clear="left"/>
							</p>
							<p>
								<a href="<?php echo $tmp['t4_featurelink2']; ?>"><img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t4_featurethumb2']; ?>" alt="feature 2" class="featureimg" /></a>
								<a href="<?php echo $tmp['t4_featurelink2']; ?>"><span class="emphasis"><?php echo getTemplateMessage('t4_featuretitle2'); ?></span></a> <?php echo getTemplateMessage('t4_featurepara2'); ?><br clear="left"/>
							</p>
							<p>
								<a href="<?php echo $tmp['t4_featurelink3']; ?>"><img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t4_featurethumb3']; ?>" alt="feature 3" class="featureimg" /></a>
								<a href="<?php echo $tmp['t4_featurelink3']; ?>"><span class="emphasis"><?php echo getTemplateMessage('t4_featuretitle3'); ?></span></a> <?php echo getTemplateMessage('t4_featurepara3'); ?><br clear="left"/>
							</p>
							<p>
								<a href="<?php echo $tmp['t4_featurelink4']; ?>"><img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t4_featurethumb4']; ?>" alt="feature 4" class="featureimg" /></a>
								<a href="<?php echo $tmp['t4_featurelink4']; ?>"><span class="emphasis"><?php echo getTemplateMessage('t4_featuretitle4'); ?></span></a> <?php echo getTemplateMessage('t4_featurepara4'); ?>
							</p>
<?php
	//end FEATURES 1-4
?>
							</div>
						</td></tr>
						<tr><td valign="top"><span class="normal">&nbsp;</span></td></tr>
						<tr><td valign="top"><span class="normal"><b><?php echo $text['contactus']; ?></b></span></td></tr>
						<tr><td valign="top" class="line"></td></tr>
						<tr><td valign="top">
							<div class="normal">
							<p><img src="<?php echo $cms['tngpath'] . $templatepath; ?>img/email.gif" alt="email image" class="emailimg" /><?php echo $text['contactus_long']; ?></p><br />
							</div>
						</td></tr>
					</table>
				</div>
			</div>
	</td>
	<td class="spacercol">&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr><td colspan="4" class="line"></td></tr>
</table><br/>
	<div class="footer">
<?php
	$flags['basicfooter'] = true;
	echo tng_footer($flags);
?>
	</div> <!-- end of footer div -->
</div> <!-- end of center div -->

</body>
</html>