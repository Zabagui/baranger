<?php
include($cms['tngpath'] . "surname_cloud.class.php");
$flags['noicons'] = true;
$flags['noheader'] = true;
$flags['nobody'] = true;
$flags['homeclass'] = "homebody";
$tngconfig['showshare'] = false;
tng_header( $sitename ? "" : $text['ourhist'], $flags );
if(!$cms['support'] && $sitever != "mobile")
	echo "<body id=\"bodytop\" class=\"" . pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME) . " homebody\">\n";

$dadlabel = getTemplateMessage('t16_dadside');
$momlabel = getTemplateMessage('t16_momside');
$title = getTemplateMessage('t16_maintitle'); 
$whatsnew_url = getURL( "whatsnew", 0 );
$surnames_url = getURL( "surnames", 0 );

$rp_maxwidth = "300";
$rp_maxheight = "300";

$search = "<h3>{$text['search']}</h3>\n";
$search .= "<form action=\"search.php\" method=\"get\">\n";
$search .= "<label class=\"formfield\" for=\"myfirstname\" style=\"padding-top:0\">{$text['mnufirstname']}:</label>\n";
$search .= "<input type=\"text\" name=\"myfirstname\" class=\"formfield\" size=\"14\" />\n";
$search .= "<label class=\"formfield\" for=\"mylastname\">{$text['mnulastname']}: </label>\n";
$search .= "<input type=\"text\" name=\"mylastname\" class=\"formfield\" size=\"14\" /><br />\n";
$search .= "<input type=\"hidden\" name=\"mybool\" value=\"AND\" />\n";
$search .= "<div style=\"float:left; margin-right:10px; margin-bottom:5px\">\n";
$search .= "<input type=\"submit\" name=\"search\" value=\"{$text['mnusearchfornames']}\" class=\"btn\" id=\"searchbtn\"/>\n";
$search .= "</div>\n";
$search .= "<a href=\"searchform.php\">{$text['mnuadvancedsearch']}</a><br />\n";
$search .= "<a href=\"surnames.php\">{$text['mnulastnames']}</a>\n";
$search .= "<br clear=\"all\"/>\n";
$search .= "</form>\n";
?>

<div id="tcontainer">
	<div id="tbackground">
		<div id="tpage">
			<div class="theader">
				<div id="thomemast" class="mast">
					<h1><?php echo $title; ?></h1>
				</div>
				<div id="tmenu">
					<ul>
<?php
	if($dadlabel) {
?>
						<li>
							<a href="<?php echo $cms['tngpath']; ?>pedigree.php?personID=<?php echo $tmp['t16_dadperson']; ?>&amp;tree=<?php echo $tmp['t16_dadtree']; ?>"><?php echo $dadlabel; ?></a>
						</li>
<?php		
	}
	if($momlabel) {
?>
						<li>
							<a href="<?php echo $cms['tngpath']; ?>pedigree.php?personID=<?php echo $tmp['t16_momperson']; ?>&amp;tree=<?php echo $tmp['t16_momtree']; ?>"><?php echo $momlabel; ?></a>
						</li>
<?php		
	}
	echo showLinks($tmp['t16_featurelinks'],false);
?>
					</ul>
				</div>
			</div>
			<div id="tbody">
<?php
	if($sitever != "mobile") {
?>
				<div id="tsidebar">
					<div class="tsidesection">
						<?php echo $search; ?>
					</div>
<!-- RANDOM PHOTO CODE STARTS HERE -->
<!-- If you don't want to have a random photo displayed, just remove this section down to 'RANDOM PHOTO CODE ENDS HERE' -->
					<div class="tsidesection">
						<h3><?php echo $text['featphoto']; ?></h3>
	<?php
		$rp_maxwidth = "100%";
	    include("randomphoto.php");
	?>
					</div>
<!-- RANDOM PHOTO CODE ENDS HERE -->
					<div class="tsidesection">
						<h3><?php echo $admtext['menu']; ?></h3>
						<ul class="vmenu">
							<li><a href="whatsnew.php"><?php echo $text['mnuwhatsnew']; ?></a></li>
							<li><a href="mostwanted.php"><?php echo $text['mostwanted']; ?></a></li>
<?php
    foreach( $mediatypes as $mediatype ) {
        if(!$mediatype['disabled']) {
            echo "<li><a href=\"browsemedia.php?mediatypeID={$mediatype['ID']}\">{$mediatype['display']}</a></li>\n";
        }
    }
?>
							<li><a href="browsealbums.php"><?php echo $text['albums']; ?></a></li>
							<li><a href="browsemedia.php"><?php echo $text['allmedia']; ?></a></li>
							<li><a href="cemeteries.php"><?php echo $text['mnucemeteries']; ?></a></li>
							<li><a href="places.php"><?php echo $text['places']; ?></a></li>
							<li><a href="browsenotes.php"><?php echo $text['notes']; ?></a></li>
							<li><a href="anniversaries.php"><?php echo $text['anniversaries']; ?></a></li>
						    <li><a href="calendar.php"><?php echo $text['calendar']; ?></a></li>
							<li><a href="reports.php"><?php echo $text['reports']; ?></a></li>
							<li><a href="browsesources.php"><?php echo $text['mnusources']; ?></a></li>
							<li><a href="browserepos.php"><?php echo $text['repositories']; ?></a></li>
<?php
    if( !$tngconfig['hidedna'] ) {
?>
    						<li><a href="browse_dna_tests.php"><?php echo $text['dna_tests']; ?></a></li>
<?php
    }
?>
							<li><a href="statistics.php"><?php echo $text['mnustatistics']; ?></a></li>
<?php
	if( !empty($allow_admin) ) {
?>
							<li><a href="showlog.php"><?php echo $text['mnushowlog']; ?></a></li>
							<li><a href="admin.php"><?php echo $text['mnuadmin']; ?></a></li>
<?php
	}
?>
							<li><a href="bookmarks.php"><?php echo $text['bookmarks']; ?></a></li>
						</ul>
					</div>
				</div>
<?php
}
?>
				<div id="thomebody">
					<div class="tblock" id="big-block-1">
						<h2><?php echo getTemplateMessage('t16_welcome'); ?></h2>
						<div class="left-indent mainsection">
<?php
	if($tmp['t16_mainimage']) {
?>
							<div id="mainphoto">
								<img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t16_mainimage']; ?>" alt="" class="temppreview" />
							</div>
<?php
	}
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
		echo "<input type=\"hidden\" name=\"instance\" value=\"3\" /></form><br/>\n";
	}

	tng_free_result($result);

	if( $currentuser ) {
	    echo "<p><strong>{$text['welcome']}, $currentuserdesc.</strong> <a href=\"logout.php\">{$text['mnulogout']}</a></p>\n";
	}
	else {
		$loginContent = "";
		if(!$tngconfig['showlogin'] )
			$loginContent = "<a href=\"login.php\">{$text['mnulogon']}</a>";
		if(!$tngconfig['disallowreg']) {
			if($loginContent)
				$loginContent .= " | ";
			$loginContent .= "<a href=\"newacctform.php\">{$text['mnuregister']}</a>";
		}
		if($loginContent)
			echo "<p>$loginContent</p>\n";
	}
	echo getTemplateMessage('t16_mainpara');
?>
							<h3><?php echo $text['contactus']; ?></h3>
							<p class="contact"><img src="<?php echo $cms['tngpath'] . $templatepath; ?>img/email.gif" alt="email image" class="emailimg" /><?php echo $text['contactus_long']; ?></p>

<?php
	if($sitever == "mobile")
		echo $search;
?>
						</div>
						<div style="clear:both"></div>
					</div>
<?php
	$feature_headline = getTemplateMessage('t16_featuretitle1');
	$feature_text = getTemplateMessage('t16_featurepara1');
	if($feature_headline || $feature_text) {
?>
					<div class="tblock" id="big-block-2">
						<h2><?php echo $feature_headline ?></h2>
						<div class="left-indent mainsection">
							<?php echo $feature_text ?>
						</div>
					</div>
<?php
	}
?>
					<div class="tblock">
						<h2><?php echo $text['whatsnew'] . " | <a href=\"$whatsnew_url\">" . $text['more'] . "</a>"; ?></h2>
<?php
echo $cms['tngpath'];
	include($cms['tngpath'] . "widget_whatsnew.php");
?>
					</div>
					<div class="tblock">
						<h2><?php echo $text['surnames'] . " | <a href=\"$surnames_url\">" . $text['more'] . "</a>"; ?></h2>
						<?php
							$nc = new surname_cloud();
							$nc->display(100);
						?>
					</div>
				</div>
			</div>
			<hr size="1" />
			<div id="tfooter">
<?php
	$flags['basicfooter'] = true;
	echo tng_footer($flags);
?>
			</div>
		</div>
	</div>
</div>

</body>
</html>