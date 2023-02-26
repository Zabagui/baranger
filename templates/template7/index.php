<?php
$flags['noicons'] = true;
$flags['noheader'] = true;
$flags['nobody'] = true;
$tngconfig['showshare'] = false;

//default header ($text['ourpages']) is "Our Family Genealogy Pages"
tng_header( $sitename ? "" : $text['ourpages'], $flags );
if(!$cms['support'] && $sitever != "mobile")
	echo "<body id=\"bodytop\" class=\"" . pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME) . "\">\n";
?>

<div>
					<table cellspacing="0" cellpadding="0" id="headertable">
						<tr>
<?php
	//begin TITLE IMAGE (default: "Our Family History")
	//Actual file name has been replaced with t7_titleimg variable, configurable from Template Settings. Default name of actual image is "logo.jpg"
	//You can replace the t7_titleimg PHP block in the line below with the desired image name if you prefer that to using the Template Settings.

	$title = str_replace(array("<br />","<br>")," ", getTemplateMessage('t7_maintitle')); 
	if($tmp['t7_titlechoice'] == "text" || $sitever == "mobile") {
?>
							<td class="logo" style="background:url(<?php echo $cms['tngpath'] . $templatepath; ?>img/logoedge.gif) no-repeat right #DCD5B9;">
								<div style="padding:10px;"><em id="maintitle">

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
							<td class="news"><div><span class="emphasis"><?php echo $text['news'] ; ?>:</span>

<?php
	//begin NEWS TEXT (default text: "This section can be used for brief news announcements")
	//Configurable from Template Settings. You can also replace the t7_newstext PHP block below with the desired text if you prefer that to using the Template Settings.
?>

		<?php echo getTemplateMessage('t7_newstext'); ?>

<?php
	//end NEWS TEXT
?>
								</div>
							</td>
						</tr>
					</table>
			<form action="search.php" method="get" style="margin:0px">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr class="strip">
							<td class="fieldnameback">
								<span class="fieldname">
									&nbsp;<span class="nw"><?php echo $text['mnufirstname']; ?>: <input type="text" name="myfirstname" size="18" /></span>
									&nbsp;<span class="nw"><?php echo $text['mnulastname']; ?>: <input type="text" name="mylastname" size="18"/></span>
									<input type="hidden" name="mybool" value="AND" /><input type="hidden" name="offset" value="0" /><input type="submit" name="search" value="<?php echo $text['mnusearch']; ?>" />
								</span>
							</td>
						</tr>
					</table>
			</form>

		<table border="0" cellspacing="0" cellpadding="0" class="page" width="100%">
			<tr>
				<td class="section">
					
						<table width="193" border="0" cellspacing="0" cellpadding="0" >
							<tr>
								<td class="tableheader"></td>
								<td class="fieldname">
								<?php
	if( $currentuser ) {
		echo "<a href=\"logout.php\" class=\"lightlink\">{$text['mnulogout']}</a><br />\n";
	}
	elseif( empty($tngconfig['showlogin']) ) {
		echo "<a href=\"login.php\" class=\"lightlink\">{$text['mnulogon']}</a><br />\n";
	}
	echo "<a href=\"searchform.php\" class=\"lightlink\">{$text['mnuadvancedsearch']}</a><br />\n";
	echo "<a href=\"surnames.php\" class=\"lightlink\">{$text['mnulastnames']}</a><br />\n";
	echo "<a href=\"whatsnew.php\" class=\"lightlink\">{$text['mnuwhatsnew']}</a><br />\n";
	echo "<a href=\"mostwanted.php\" class=\"lightlink\">{$text['mostwanted']}</a><br />\n";

		foreach( $mediatypes as $mediatype ) {
			if(!$mediatype['disabled']) {
				echo "<a href=\"browsemedia.php?mediatypeID={$mediatype['ID']}\" class=\"lightlink\">{$mediatype['display']}</a><br />\n";
			}
		}

	echo "<a href=\"browsealbums.php\" class=\"lightlink\">{$text['albums']}</a><br />\n";
	echo "<a href=\"browsemedia.php\" class=\"lightlink\">{$text['allmedia']}</a><br />\n";
	echo "<a href=\"cemeteries.php\" class=\"lightlink\">{$text['mnucemeteries']}</a><br />\n";
	echo "<a href=\"places.php\" class=\"lightlink\">{$text['places']}</a><br />\n";
	echo "<a href=\"browsenotes.php\" class=\"lightlink\">{$text['notes']}</a><br />\n";
	echo "<a href=\"anniversaries.php\" class=\"lightlink\">{$text['anniversaries']}</a><br />\n";
	echo "<a href=\"calendar.php\" class=\"lightlink\">{$text['calendar']}</a><br />\n";
	echo "<a href=\"reports.php\" class=\"lightlink\">{$text['mnureports']}</a><br />\n";
	echo "<a href=\"browsesources.php\" class=\"lightlink\">{$text['mnusources']}</a><br />\n";
	echo "<a href=\"browserepos.php\" class=\"lightlink\">{$text['repositories']}</a><br />\n";
	if(!$tngconfig['hidedna'])
		echo "<a href=\"browse_dna_tests.php\" class=\"lightlink\">{$text['dna_tests']}</a><br />\n";
	echo "<a href=\"statistics.php\" class=\"lightlink\">{$text['mnustatistics']}</a><br />\n";
	echo "<a href=\"changelanguage.php\" class=\"lightlink\">{$text['mnulanguage']}</a><br />\n";
	if( !empty($allow_admin) ) {
		echo "<a href=\"showlog.php\" class=\"lightlink\">{$text['mnushowlog']}</a><br />\n";
		echo "<a href=\"admin.php\" class=\"lightlink\">{$text['mnuadmin']}</a><br />\n";
	}
	echo "<a href=\"bookmarks.php\" class=\"lightlink\">{$text['bookmarks']}</a><br />\n";
	echo "<a href=\"suggest.php?page=" . urlencode($title) . "\" class=\"lightlink\">{$text['contactus']}</a><br />\n";
	if(!$currentuser && !$tngconfig['disallowreg'])
		echo "<a href=\"newacctform.php\" class=\"lightlink\">{$text['mnuregister']}</a><br />\n";
?>
</td>
							</tr>
						
					</table>
				</td>
				<td valign="top">
					<table cellspacing="0" cellpadding="0" class="bodytable">
						<tr>
							<td colspan="2"></td>
							</tr>
							<tr>
	<td class="spacercol">&nbsp;&nbsp;&nbsp;</td>
	<td valign="top">
		<table cellspacing="0" cellpadding="0" class="bodytable">
			<tr>
				<td class="maincontent"><br />
<?php
	//begin MAIN IMAGE (default: large picture of Main Street, Mt. Pleasant, Utah, ca. 1915)
	//Actual file name has been replaced with t7_mainimage variable, configurable from Template Settings. Default name of actual image is "bigphoto.jpg"
	//You can replace the t7_mainimage PHP block in the line below with the desired image name if you prefer that to using the Template Settings.
?>
						<img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t7_mainimage']; ?>" alt="" class="bigphoto" /><br />
<?php
	//end MAIN IMAGE
?>
					<span class="smaller">
<?php
	//begin MAIN IMAGE CAPTION
	//Configurable from Template Settings. You can also replace the t7_photocaption PHP block in the line below with the desired text if you prefer that to using the Template Settings.
	//Example:  &nbsp;&nbsp;<i>This is my caption</i><br />
?>
					&nbsp;&nbsp;<i><?php echo getTemplateMessage('t7_photocaption'); ?></i><br />
<?php
	//end MAIN IMAGE CAPTION
?>
					</span>
					<div class="normal">
<?php
	//begin HEADLINE
	//Configurable from Template Settings. You can also replace the t7_headline PHP block in the line below with the desired text if you prefer that to using the Template Settings.
	//Example:  &nbsp;&nbsp;<h3>This is my headline</h3>
?>
					<h3 class="emphasis"><?php echo getTemplateMessage('t7_headline'); ?></h3>
<?php
	//end HEADLINE


	//begin WELCOME PARAGRAPH
	//Configurable from Template Settings. You can also replace the t7_mainpara PHP block in the line below with the desired text if you prefer that to using the Template Settings.
	//Example:  <p>This is my welcome paragraph. If I had more to say, it would be several lines long.</p>
?>
					<?php echo getTemplateMessage('t7_mainpara'); ?>
<?php
	//end WELCOME PARAGRAPH
?>

					</div> <!-- end of normal div -->
				</td>
				<td class="middlecol">&nbsp;&nbsp;&nbsp;</td>
				<td class="rightcontent"><br />
					<table width="200" border="0" cellspacing="0" cellpadding="0">
						<tr>
													<td valign="top"><span class="emphasis"><?php echo $text['latupdates']; ?></span></td>
												</tr>
		<tr>
				<td colspan="4" class="line"></td>		</tr>
												<tr><td><span class="smallest">&nbsp;</span></td></tr>
												<tr><td valign="top">
							<div class="normal">
					<?php
					$tngquery = "SELECT lastname, firstname, changedate, personID, gedcom, living, private, branch, lnprefix, title, suffix, prefix, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr FROM $people_table ORDER BY changedate DESC LIMIT 10";
					$resulttng = tng_query( $tngquery ) or die( $text['cannotexecutequery'] . ": $tngquery" );

					$lastadd = "";
					while( $dbrow = tng_fetch_assoc( $resulttng ) ) {
						$lastadd .= "<a href=\"getperson.php?personID={$dbrow['personID']}&amp;tree={$dbrow['gedcom']}\">";

						$dbrights = determineLivingPrivateRights($dbrow);
						$dbrow['allow_living'] = $dbrights['living'];
						$dbrow['allow_private'] = $dbrights['private'];

						$lastadd .= getNameRev($dbrow);
						$lastadd .= "</a><br />\n";
					}
					tng_free_result($resulttng);
					echo $lastadd
					?>
							
							</div> <!-- end of normal div -->
						</td></tr>
												<tr><td valign="top"><span class="normal">&nbsp;</span></td></tr>
						<tr><td valign="top"><span class="emphasis"><?php echo $text['featphoto']; ?></span></td></tr>
						<tr>
							<td colspan="4" class="line"></td>
							</tr>
						<tr><td><span class="smallest">&nbsp;</span></td></tr>
						<tr><td valign="top">
							<div class="normal">

	<?php
	    include("randomphoto.php"); // randomphoto code removed and replaced with include from userscripts directory Ken Roy
	?>
							
							</div>
						</td></tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
	<td class="spacercol">&nbsp;&nbsp;</td>
</tr>
</table>
	</td>
	</tr>
	</table>

	<hr />
	<div class="footer">
<?php
	$flags['basicfooter'] = true;
	echo tng_footer($flags);
?>
	</div> <!-- end of footer div -->
</div> <!-- end of center div -->

</body>
</html>