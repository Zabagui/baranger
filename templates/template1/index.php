<?php
$flags['noicons'] = true;
$flags['noheader'] = true;
$flags['nobody'] = true;
$tngconfig['showshare'] = false;
tng_header( $sitename ? "" : $text['ourhist'], $flags );
if(!$cms['support'] && $sitever != "mobile")
	echo "<body id=\"bodytop\" class=\"" . pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME) . "\">\n";
$title = getTemplateMessage('t1_maintitle'); 
?>


<br />
<div align="center">
<table class="indexpage" cellspacing="10">
	<tr>
		<td colspan="3">

<?php
	//begin MAIN IMAGE (default: picture of the Henefer, Utah cemetery)
	//Actual file name has been replaced with t1_mainimage variable, configurable from Template Settings. Default name of actual image is "home-image.jpg"
	//You can replace the t1_mainimage PHP block in the line below with the desired image name if you prefer that to using the Template Settings.
?>
			<img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t1_mainimage']; ?>" alt="" border="0" align="left" id="mainphoto"/>
<?php
	//end MAIN IMAGE
?>

<?php
	//begin TITLE IMAGE (default: "Our Family History")
	//Actual file name has been replaced with t1_titleimage variable, configurable from Template Settings. Default name of actual image is "home-title.gif"
	//You can replace the t1_titleimage PHP block in the line below with the desired image name if you prefer that to using the Template Settings.

	if($tmp['t1_titlechoice'] == "text" || $sitever == "mobile") {
?>
			<em class="maintitle"><?php echo $title; ?></em>
<?php
	}
	else {
?>
			<img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t1_titleimage']; ?>" alt="" hspace="10" border="0" />
<?php
	}
	//end MAIN IMAGE
?>

<!--
	<em style="font-size:72px; font-family:Verdana,Arial,sans-serif; color:#000099; line-height:72px">

	<?php echo getTemplateMessage('t1_maintitle'); ?>

	</em>
-->

			<br />
		</td>
	</tr>
	<tr>
		<td valign="top" class="normal t1-sidebar">
<?php
	if( $currentuser ) {
		echo "<strong>{$text['welcome']}, $currentuserdesc.</strong><br /><br />\n";
	}
?>
			<h2><?php echo $text['mnusearchfornames']; ?></h2>
			<!-- Do not change the form action or field names! -->
			<form method="get" name="searchform" action="search.php">
			  	<label for="myfirstname"><?php echo $text['firstname']; ?></label><br />
			    <input type="text" value="" name="myfirstname" /><br />
			  	<label for="mylastname"><?php echo $text['lastname']; ?></label><br />
			    <input type="text" value="" name="mylastname" /><br />
				<input type="hidden" name="mybool" value="AND" />
				<input type="submit" id="search-submit" value="<?php echo $text['search']; ?>" />
			</form>
			
			<br/>
<?php 
	if($chooselang) {
		$query = "SELECT languageID, display, folder FROM $languages_table ORDER BY display";
		$result = tng_query($query);
		$numlangs = tng_num_rows( $result );

		if($numlangs > 1) {
			echo getFORM( "savelanguage2", "get", "tngmenu3", "" );
			echo "<select name=\"newlanguage3\" id=\"newlanguage3\" style=\"font-size:11px;\" onchange=\"document.tngmenu3.submit();\">";

			while( $row = tng_fetch_assoc($result)) {
				echo "<option value=\"{$row['languageID']}\"";
				if( $languages_path . $row['folder'] == $mylanguage )
					echo " selected=\"selected\"";
				echo ">{$row['display']}</option>\n";
			}
			echo "</select>\n";
			echo "<input type=\"hidden\" name=\"instance\" value=\"3\" /></form>\n";
		}

		tng_free_result($result);
	}
	$mainpara = getTemplateMessage('t1_mainpara');
?>
		</td>
		<td class="std-only">&nbsp;&nbsp;</td>
		<td valign="top" class="normal std-only">
			<h2><?php echo $text['welcome']; ?></h2>
<?php
	if($mainpara)
		echo "<div style=\"max-width:700px;\">$mainpara</div>\n";
?>
			<h2><?php echo $text['mnufeatures']; ?></h2>
			<table style="font-size:12pt" width="100%">
				<tr>
					<td valign="top" width="30%">
						<ul>
<?php
	if( $currentuser ) {
		echo "<li><a href=\"logout.php\">{$text['mnulogout']}</a></li>\n";
		if( $allow_admin ) {
			echo "<li><a href=\"admin.php\">{$text['mnuadmin']}</a></li>\n";
		}
	}
	else {
		echo "<li><a href=\"login.php\">{$text['mnulogon']}</a></li>\n";
		if(!$tngconfig['disallowreg'])
			echo "<li><a href=\"newacctform.php\">{$text['mnuregister']}</a></li>\n";
	}
	echo "<li><a href=\"surnames.php\">{$text['mnulastnames']}</a></li>\n";
	echo "<li><a href=\"searchform.php\">{$text['mnuadvancedsearch']}</a></li>\n";
	echo "<li><a href=\"famsearchform.php\">{$text['searchfams']}</a></li>\n";
	echo "<li><a href=\"searchsite.php\">{$text['searchsitemenu']}</a></li>\n";
	echo "<li><a href=\"places.php\">{$text['places']}</a></li>\n";
	echo "<li><a href=\"anniversaries.php\">{$text['anniversaries']}</a></li>\n";
	echo "<li><a href=\"calendar.php\">{$text['calendar']}</a></li>\n";
	echo "<li><a href=\"cemeteries.php\">{$text['mnucemeteries']}</a></li>\n";
	echo "<li><a href=\"bookmarks.php\">{$text['bookmarks']}</a></li>\n";
?>
						</ul>
					</td>
					<td width="5%">&nbsp;&nbsp;&nbsp;</td>
					<td valign="top" width="30%">
						<ul>
<?php
	foreach( $mediatypes as $mediatype ) {
		if(!$mediatype['disabled']) {
			echo "<li><a href=\"browsemedia.php?mediatypeID={$mediatype['ID']}\">{$mediatype['display']}</a></li>\n";
		}
	}
	echo "<li><a href=\"browsemedia.php\">{$text['allmedia']}</a></li>\n";
	echo "<li><a href=\"browsealbums.php\">{$text['albums']}</a></li>\n";
?>
						</ul>
					</td>
					<td width="5%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td valign="top" width="30%">
						<ul>
<?php
	echo "<li><a href=\"whatsnew.php\">{$text['mnuwhatsnew']}</a></li>\n";
	echo "<li><a href=\"mostwanted.php\">{$text['mostwanted']}</a></li>\n";
	echo "<li><a href=\"reports.php\">{$text['mnureports']}</a></li>\n";
	echo "<li><a href=\"statistics.php\">{$text['mnustatistics']}</a></li>\n";
	echo "<li><a href=\"browsetrees.php\">{$text['trees']}</a></li>\n";
	echo "<li><a href=\"browsenotes.php\">{$text['notes']}</a></li>\n";
	echo "<li><a href=\"browsesources.php\">{$text['mnusources']}</a></li>\n";
	echo "<li><a href=\"browserepos.php\">{$text['repositories']}</a></li>\n";
	if(!$tngconfig['hidedna'])
		echo "<li><a href=\"browse_dna_tests.php\">{$text['dna_tests']}</a></li>\n";
	if(!empty($allow_admin)) {
		echo "<li><a href=\"showlog.php\">{$text['mnushowlog']}</a></li>\n";
	}
	echo "<li><a href=\"suggest.php?page=" . urlencode($title) . "\">{$text['contactus']}</a></li>\n";
?>
						</ul>
						<br />
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<hr size="1" />
<?php
	$flags['basicfooter'] = true;
	echo tng_footer($flags);
?>
</div>
</body>
</html>