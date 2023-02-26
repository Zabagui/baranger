<?php
$flags['noicons'] = true;
$flags['noheader'] = true;
$flags['nobody'] = true;
$tngconfig['showshare'] = false;
tng_header( $sitename ? "" : $text['ourpages'], $flags );
if(!$cms['support'] && $sitever != "mobile")
	echo "<body id=\"bodytop\" class=\"" . pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME) . " bodyindex\">\n";
$title = getTemplateMessage('t2_maintitle'); 
?>


<script type="text/javascript">
pedigreeoff = new Image(162,24);
pedigreeoff.src = "<?php echo $cms['tngpath'] . $templatepath; ?>img/pedigreeoff.gif";
pedigreeon = new Image(162,24);
pedigreeon.src = "<?php echo $cms['tngpath'] . $templatepath; ?>img/pedigreeon.gif";

photosoff = new Image(193,24);
photosoff.src = "<?php echo $cms['tngpath'] . $templatepath; ?>img/photosoff.gif";
photoson = new Image(193,24);
photoson.src = "<?php echo $cms['tngpath'] . $templatepath; ?>img/photoson.gif";

function swap(x, y)
{
	document.images[x].src=eval(y+'.src');
}
</script>

<div class="center">
<table class="indexpage rounded10" style="padding:0px">
	<tr>
		<td valign="top">
			<div class="databack rounded10">
					<div style="float:left;display:inline">
<?php
	//begin TITLE IMAGE (default: "Our Family Genealogy Pages")
	//Actual file name has been replaced with t1_titleimage variable, configurable from Template Settings. Default name of actual image is "homeheader.gif"
	//You can replace the t1_titleimage PHP block in the line below with the desired image name if you prefer that to using the Template Settings.

	if($tmp['t2_titlechoice'] == "text" || $sitever == "mobile") {
?>
						<div id="titlecontainer">
						<em class="maintitle">

						<?php echo $title; ?>

						</em>
						</div>
<?php
	}
	else {
?>
						<img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t2_titleimage']; ?>" alt="" width="443" height="114" class="noimgborder rounded10" />
<?php
	}
	//end TITLE IMAGE
	$mainpara = getTemplateMessage('t2_mainpara');
?>

						<br />
<?php
	if($mainpara) 
		echo "<div style=\"max-width:600px;padding-left:20px;color:#333\">$mainpara</div><br/>\n";
?>

<!-- PEDIGREE LINK: In the following line, substitute the personID and tree ID of the person where you want the pedigree to start. This can be done
		from the Template Settings, or you can simply replace the t2_pedperson and t2_pedtree PHP blocks in the line below.
		For example, if you want it to point to person I123 in the "smith" tree, change the link to: "pedigree.php?personID=I123&tree=smith"
-->
						<a href="pedigree.php?personID=<?php echo $tmp['t2_pedperson']; ?>&amp;tree=<?php echo $tmp['t2_pedtree']; ?>" class="mainlink smalltitle">&#8226; <?php echo $text['pedigree']; ?></a> 

<!-- PHOTOS & HISTORIES LINK: In the following line, substitute the personID and tree ID of the person where you want the chart to start. This can be done
		from the Template Settings, or you can simply replace the t2_phhistperson and t2_phhisttree PHP blocks in the line below.
		For example, if you want it to point to person I123 in the "smith" tree, change the link to: "extrastree.php?personID=I123&tree=smith"
-->
						<a href="extrastree.php?personID=<?php echo $tmp['t2_phhistperson']; ?>&amp;tree=<?php echo $tmp['t2_phhisttree']; ?>" class="mainlink smalltitle">&#8226; <?php echo $text['photoshistories']; ?></a>

						<div id="linktable">
						<br /><br />
						<table cellspacing="4" cellpadding="0">
							<tr>
								<td rowspan="6">&nbsp;&nbsp;&nbsp;</td>
								<td valign="top">
<?php
									if( $currentuser ) {
										echo "<a href=\"{$cms['tngpath']}logout.php\" class=\"sidelink\">" . strtoupper($text['mnulogout']) . "</a>\n";
									}
									else {
										echo "<a href=\"{$cms['tngpath']}login.php\" class=\"sidelink\">" . strtoupper($text['mnulogon']) . "</a>\n";
									}
?>
								</td><td>&nbsp;&nbsp;</td>
								<td valign="top"><a href="<?php echo $cms['tngpath']; ?>whatsnew.php" class="sidelink"><?php echo $text['mnuwhatsnew']; ?></a></td><td>&nbsp;&nbsp;&nbsp;</td>
								<td valign="top"><a href="<?php echo $cms['tngpath']; ?>statistics.php" class="sidelink"><?php echo $text['mnustatistics']; ?></a></td><td>&nbsp;&nbsp;&nbsp;</td>
								<td valign="top"><a href="<?php echo $cms['tngpath']; ?>anniversaries.php" class="sidelink"><?php echo $text['anniversaries']; ?></a></td><td>&nbsp;&nbsp;&nbsp;</td>
							</tr>
							<tr>
								<td valign="top"><a href="<?php echo $cms['tngpath']; ?>browsemedia.php?mediatypeID=photos" class="sidelink"><?php echo $text['mnuphotos']; ?></a></td><td>&nbsp;&nbsp;&nbsp;</td>
								<td valign="top"><a href="<?php echo $cms['tngpath']; ?>browsemedia.php?mediatypeID=histories" class="sidelink"><?php echo $text['mnuhistories']; ?></a></td><td>&nbsp;&nbsp;&nbsp;</td>
								<td valign="top"><a href="<?php echo $cms['tngpath']; ?>cemeteries.php" class="sidelink"><?php echo $text['mnucemeteries']; ?></a></td><td>&nbsp;&nbsp;&nbsp;</td>
								<td valign="top"><a href="<?php echo $cms['tngpath']; ?>places.php" class="sidelink"><?php echo $text['places']; ?></a></td><td>&nbsp;&nbsp;&nbsp;</td>
							</tr>
							<tr>
								<td valign="top"><a href="<?php echo $cms['tngpath']; ?>browsemedia.php?mediatypeID=documents" class="sidelink"><?php echo $text['documents']; ?></a></td><td>&nbsp;&nbsp;&nbsp;</td>
								<td valign="top"><a href="<?php echo $cms['tngpath']; ?>browsemedia.php" class="sidelink"><?php echo $text['allmedia']; ?></a></td><td>&nbsp;&nbsp;&nbsp;</td>
								<td valign="top"><a href="<?php echo $cms['tngpath']; ?>browsemedia.php?mediatypeID=headstones" class="sidelink"><?php echo $text['mnutombstones']; ?></a></td><td>&nbsp;&nbsp;&nbsp;</td>
								<td valign="top"><a href="<?php echo $cms['tngpath']; ?>browsealbums.php" class="sidelink"><?php echo $text['albums']; ?></a></td><td>&nbsp;&nbsp;&nbsp;</td>
							</tr>
							<tr>
								<td valign="top"><a href="<?php echo $cms['tngpath']; ?>reports.php" class="sidelink"><?php echo $text['mnureports']; ?></a></td><td>&nbsp;&nbsp;&nbsp;</td>
								<td valign="top"><a href="<?php echo $cms['tngpath']; ?>browsesources.php" class="sidelink"><?php echo $text['mnusources']; ?></a></td><td>&nbsp;&nbsp;&nbsp;</td>
								<td valign="top"><a href="<?php echo $cms['tngpath']; ?>bookmarks.php" class="sidelink"><?php echo $text['bookmarks']; ?></a></td><td>&nbsp;&nbsp;&nbsp;</td>
								<td valign="top"><a href="<?php echo $cms['tngpath']; ?>suggest.php?page=<?php echo $title; ?>" class="sidelink"><?php echo $text['contactus']; ?></a></td><td>&nbsp;&nbsp;&nbsp;</td>
							</tr>
							<tr>
								<td valign="top"><a href="<?php echo $cms['tngpath']; ?>mostwanted.php" class="sidelink"><?php echo $text['mostwanted']; ?></a></td><td>&nbsp;&nbsp;&nbsp;</td>
								<td valign="top"><a href="<?php echo $cms['tngpath']; ?>browserepos.php" class="sidelink"><?php echo $text['repositories']; ?></a></td><td>&nbsp;&nbsp;&nbsp;</td>
								<td valign="top"><a href="<?php echo $cms['tngpath']; ?>showlog.php" class="sidelink"><?php if( !empty($allow_admin) ) echo $text['mnushowlog']; ?></a></td><td>&nbsp;&nbsp;&nbsp;</td>
								<td valign="top"><a href="<?php echo $cms['tngpath']; ?>admin.php" class="sidelink"><?php if( !empty($allow_admin) ) echo $text['mnuadmin']; ?></a>&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td>
							</tr>
<?php
	if(!$currentuser && !$tngconfig['disallowreg']) {
?>
							<tr>
								<td valign="top" colspan="4"><a href="<?php echo $cms['tngpath']; ?>newacctform.php" class="sidelink"><?php echo $text['mnuregister']; ?></a></td><td>&nbsp;&nbsp;&nbsp;</td>
							</tr>
<?php
	}
?>
						</table>
						</div><br />

						<form action="search.php" method="get" name="searchform" id="form1">
						<div id="searchblock">
								<div id="searchtitleblock">
									<span class="smalltitle"><?php echo $text['search']; ?></span>
									<table cellspacing="6" cellpadding="0">
										<tr><td align="center"><a href="<?php echo $cms['tngpath']; ?>searchform.php" class="sidelink"><?php echo $text['mnuadvancedsearch']; ?></a></td></tr>
										<tr><td align="center"><a href="<?php echo $cms['tngpath']; ?>surnames.php" class="sidelink"><?php echo $text['mnulastnames']; ?></a></td></tr>
									</table>
								</div>
								<div id="searchformblock">
									<span class="small"><?php echo $text['firstname']; ?>:<br />
									<input type="text" name="myfirstname" class="searchbox" /><br />
									<img src="<?php echo $cms['tngpath']; ?>img/spacer.gif" alt="" width="1" height="4" class="noimgborder" /><br /><?php echo $text['lastname']; ?>:<br />
									<input type="text" name="mylastname" class="searchbox" /><br />
									<input type="hidden" name="mybool" value="AND" />
									</span>
								</div>
								<div id="searcharrowblock"><input type="image" name="imgsubmit" src="<?php echo $cms['tngpath'] . $templatepath; ?>img/button.jpg" class="indexsubmit" style="border:none" alt="" /></div>
						</div>
					  </form>
					</div>
					<div style="display:inline">
<?php
	//begin MAIN IMAGE (default: the large picture of the girl on the right side of the page)
	//Actual file name has been replaced with t2_mainimage variable, configurable from Template Settings. Default name of actual image is "mainphoto.jpg"
	//You can replace the t2_mainimage PHP block in the line below with the desired image name if you prefer that to using the Template Settings.
?>
						<img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t2_mainimage']; ?>" alt="" width="327" style="max-height:460px" class="noimgborder rounded10" id="mainphoto"/><br/><br/>
<?php
	//end MAIN IMAGE
?>
					</div>
					<div style="clear:left"></div>
			</div>
		</td>
	</tr>
</table>
<div class="footer">
<p><a href="changelanguage.php" class="footer"><?php echo $text['mnulanguage']; ?></a></p>

<?php
	$flags['basicfooter'] = true;
	echo tng_footer($flags);
?>
</div> <!-- end footer div -->
</div> <!-- end of center div -->
<script type="text/javascript">
	document.forms.searchform.myfirstname.focus();
</script>

</body>
</html>