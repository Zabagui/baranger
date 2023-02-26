<?php
$flags['noicons'] = true;
$flags['noheader'] = true;
$flags['nobody'] = true;
$tngconfig['showshare'] = false;
tng_header( $sitename ? "" : $text['ourhist'], $flags );
if(!$cms['support'] && $sitever != "mobile")
	echo "<body id=\"bodytop\" class=\"" . pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME) . " homebody\">\n";
$title = getTemplateMessage('t3_maintitle');
?>

<div class="center">
<div class="indexpage" style="display: table">
<?php
	//begin TITLE IMAGE (default: "Our Family Genealogy Pages")
	//Actual file name has been replaced with t3_titleimage variable, configurable from Template Settings. Default name of actual image is "title.gif"
	//You can replace the t3_titleimage PHP block in the line below with the desired image name if you prefer that to using the Template Settings.

	if($tmp['t3_titlechoice'] == "text" || $sitever == "mobile") {
?>
			<div style="padding:10px">
			<em class="maintitle">

			<?php echo $title; ?>

			</em>
			</div>
<?php
	}
	else {
?>
			<img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t3_titleimage']; ?>" alt="" class="titleimg" width="630" height="93" />
<?php
	}
	//end TITLE IMAGE
?>
			<div id="tcontainer">
<?php
	//begin MAIN IMAGE (default: large picture of Main Street, Mt. Pleasant, Utah, ca. 1910)
	//Actual file name has been replaced with t3_mainimage variable, configurable from Template Settings. Default name of actual image is "mainstreet.jpg"
	//You can replace the t3_mainimage PHP block in the line below with the desired image name if you prefer that to using the Template Settings.
?>
				<img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t3_mainimage']; ?>" alt="" class="mainimg" />
<?php
	//end MAIN IMAGE
?>
				<div id="searchpane"><br />
					<h2 class="header"><?php echo $text['mnusearchfornames']; ?></h2>
					<!-- Do not change the form action or field names! -->
					<form action="search.php" method="get" id="form1">
						<label for="myfirstname" class="normal"><?php echo $text['mnufirstname']; ?>:</label><br /><input type="text" name="myfirstname" id="myfirstname" size="14" /><br/><br/>
						<label for="mylastname" class="normal"><?php echo $text['mnulastname']; ?>: </label><br /><input type="text" name="mylastname" id="mylastname" size="14" /><br/>
						<input type="hidden" name="mybool" value="AND" /><input type="hidden" name="offset" value="0" />
						<input type="submit" name="search" value="<?php echo $text['mnusearchfornames']; ?>" />
					</form><br/>
					<div class="subheader">
					<a href="<?php echo $cms['tngpath']; ?>searchform.php"><?php echo $text['mnuadvancedsearch']; ?></a><br/>
					<a href="<?php echo $cms['tngpath']; ?>surnames.php"><?php echo $text['mnulastnames']; ?></a><br/><br/>
<?php
	if( $currentuser ) {
		echo "<p><strong>{$text['welcome']}, $currentuserdesc.</strong></p>\n";
	}
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
?>
					</div>
				</div>
			</div>
</div>
<?php
$mainpara = getTemplateMessage('t3_mainpara');
if($mainpara) 
	echo "<br/><div class=\"tcontainer\"><div style=\"display:inline-block;max-width:700px;text-align:left\">$mainpara</div></div>\n";

if($sitever != "mobile") {
?>
<div class="mainmenu">
			<br />
			<a href="<?php echo $cms['tngpath']; ?>whatsnew.php"><?php echo $text['mnuwhatsnew']; ?></a> &nbsp;|&nbsp;
<?php
	foreach( $mediatypes as $mediatype ) {
		if(!$mediatype['disabled']) {
			echo "<a href=\"{$cms['tngpath']}browsemedia.php?mediatypeID={$mediatype['ID']}\">{$mediatype['display']}</a> &nbsp;|&nbsp;\n";
		}
	}
?>
			<a href="<?php echo $cms['tngpath']; ?>browsealbums.php"><?php echo $text['albums']; ?></a> &nbsp;|&nbsp;
			<a href="<?php echo $cms['tngpath']; ?>browsemedia.php"><?php echo $text['allmedia']; ?></a>

			<br />
			<a href="<?php echo $cms['tngpath']; ?>mostwanted.php"><?php echo $text['mostwanted']; ?></a> &nbsp;|&nbsp;
			<a href="<?php echo $cms['tngpath']; ?>cemeteries.php"><?php echo $text['mnucemeteries']; ?></a> &nbsp;|&nbsp;
			<a href="<?php echo $cms['tngpath']; ?>places.php"><?php echo $text['places']; ?></a> &nbsp;|&nbsp;
			<a href="<?php echo $cms['tngpath']; ?>anniversaries.php"><?php echo $text['anniversaries']; ?></a> &nbsp;|&nbsp;
			<a href="<?php echo $cms['tngpath']; ?>calendar.php"><?php echo $text['calendar']; ?></a>

			<br />
			<a href="<?php echo $cms['tngpath']; ?>browsesources.php"><?php echo $text['mnusources']; ?></a> &nbsp;|&nbsp;
			<a href="<?php echo $cms['tngpath']; ?>browserepos.php"><?php echo $text['repositories']; ?></a> &nbsp;|&nbsp;
<?php
    if( !$tngconfig['hidedna'] ) {
?>
			<a href="<?php echo $cms['tngpath']; ?>browse_dna_tests.php"><?php echo $text['dna_tests']; ?></a> &nbsp;|&nbsp;
<?php
	}
?>
			<a href="<?php echo $cms['tngpath']; ?>reports.php"><?php echo $text['mnureports']; ?></a> &nbsp;|&nbsp;
			<a href="<?php echo $cms['tngpath']; ?>browsenotes.php"><?php echo $text['notes']; ?></a> &nbsp;|&nbsp;
			<a href="<?php echo $cms['tngpath']; ?>bookmarks.php"><?php echo $text['bookmarks']; ?></a> &nbsp;|&nbsp;
			<a href="<?php echo $cms['tngpath']; ?>statistics.php"><?php echo $text['mnustatistics']; ?></a>
			<br />
<?php
	if( $currentuser ) {
		echo "<a href=\"{$cms['tngpath']}logout.php\">{$text['mnulogout']}</a> &nbsp;|&nbsp;\n";
	}
	else {
		echo "<a href=\"{$cms['tngpath']}login.php\">{$text['mnulogon']}</a> &nbsp;|&nbsp;\n";
	}

	if( !empty($allow_admin) ) {
		echo "<a href=\"{$cms['tngpath']}showlog.php\">{$text['mnushowlog']}</a> &nbsp;|&nbsp;\n";
		echo "<a href=\"admin.php\">{$text['mnuadmin']}</a> &nbsp;|&nbsp;\n";
	}
	if(!$currentuser && !$tngconfig['disallowreg']) {
?>
			<a href="<?php echo $cms['tngpath']; ?>newacctform.php"><?php echo $text['mnuregister']; ?></a> &nbsp;|&nbsp;
<?php
	}
?>
			<a href="<?php echo $cms['tngpath']; ?>suggest.php?page=<?php echo $title; ?>"><?php echo $text['contactus']; ?></a>
</div>
<?php
}
?>
	<div class="footer" style="text-align: center">
<br /><br />

<?php
	$flags['basicfooter'] = true;
	echo tng_footer($flags);
?>
	</div> <!-- end footer div -->
</div> <!-- end center div -->
<script type="text/javascript">
	document.forms.form1.mylastname.focus();
</script>

</body>
</html>