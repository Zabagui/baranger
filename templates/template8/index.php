<?php
$flags['noicons'] = 1;
// PLEASE NOTE: This page only contains the contents of your main page.  If you are trying to make changes
//              to the header, you will need to edit topmenu.php.  If you want to edit the footer, edit
//              footer.php.

tng_header($sitename ? "" : $text['mnuheader'], $flags);
if($sitever == "mobile") {
?>
	<div class="headerrow" style="background-image: url(<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t8_headimg']; ?>);background-position:right">
	<span class="headertext text_white"><?php echo getTemplateMessage('t8_headtitle1'); ?></span><span class="headertext text_tan"><?php echo getTemplateMessage('t8_headtitle2'); ?></span><span class="headertext text_white"><?php echo getTemplateMessage('t8_headtitle3'); ?></span>
	</div>
	<br/>
<?php
}
?>
<table class="home_table">
    <tr>

	<!-- This is the navigation bar on the left.  You can add or remove items as you wish. -->
	<td class="homenav_col">
	    <span class="subhead text_brown"><u><b><?php echo getTemplateMessage('t8_menutitle'); ?></b></u></span><br/>
	    <ul class="homenav">

<!-- "MOM's SIDE" LINK: In the following line, substitute the personID and tree ID of the person where you want the pedigree to start. This can be done
		from the Template Settings, or you can simply replace the t8_momperson and t8_momtree PHP blocks in the line below. Also replace the t8_momside block with the relevant names
		For example, if you want it to point to person I123 in the "smith" tree, change the link to: "pedigree.php?personID=I123&tree=smith", and replace the t8_momside with "(Smith/Jones)"
-->
	    <li><a href="pedigree.php?personID=<?php echo $tmp['t8_momperson']; ?>&amp;tree=<?php echo $tmp['t8_momtree']; ?>"><?php echo getTemplateMessage('t8_momside'); ?><br/>&nbsp;&nbsp;<span class="text_grey"><?php echo getTemplateMessage('t8_momsidenames'); ?></span></a></li>

<!-- "DAD's SIDE" LINK: In the following line, substitute the personID and tree ID of the person where you want the pedigree to start. This can be done
		from the Template Settings, or you can simply replace the t8_dadperson and t8_dadtree PHP blocks in the line below. Also replace the t8_dadside block with the relevant names
		For example, if you want it to point to person I123 in the "smith" tree, change the link to: "pedigree.php?personID=I123&tree=smith", and replace the t8_dadside with "(Johnson/Williams)"
-->
	    <li><a href="pedigree.php?personID=<?php echo $tmp['t8_dadperson']; ?>&amp;tree=<?php echo $tmp['t8_dadtree']; ?>"><?php echo getTemplateMessage('t8_dadside'); ?><br/>&nbsp;&nbsp;<span class="text_grey"><?php echo getTemplateMessage('t8_dadsidenames'); ?></span></a></li>
	    </ul>
	    <br/>
	    <ul class="homenav">
	    <li><a href="whatsnew.php"><?php echo $text['mnuwhatsnew']; ?></a></li>
	    </ul>
	    <br/>
	    <ul class="homenav">
<?php
	foreach( $mediatypes as $mediatype ) {
		if(!$mediatype['disabled']) {
			echo "<li><a href=\"browsemedia.php?mediatypeID={$mediatype['ID']}\">{$mediatype['display']}</a></li>\n";
		}
	}
?>
		<li><a href="browsealbums.php"<?php echo $text['albums']; ?></a></li>
	    <li><a href="cemeteries.php"><?php echo $text['mnucemeteries']; ?></a></li>
	    <li><a href="browsesources.php"><?php echo $text['mnusources']; ?></a></li>
	    <li><a href="reports.php"><?php echo $text['mnureports']; ?></a></li>
	    </ul>
	    <br/>
	    <ul class="homenav">
	    <li><a href="anniversaries.php"><?php echo $text['anniversaries']; ?></a></li>
	    <li><a href="calendar.php"><?php echo $text['calendar']; ?></a></li>
	    <li><a href="places.php"><?php echo $text['places']; ?></a></li>
<?php
    if( !$tngconfig['hidedna'] ) {
?>
    	<li><a href="browse_dna_tests.php"><?php echo $text['dna_tests']; ?></a></li>
<?php
    }
?>
	    <li><a href="statistics.php"><?php echo $text['mnustatistics']; ?></a></li>
	    </ul>
	    <br/>
	    <?php
	    if ($allow_admin)
		echo "<ul class=\"homenav\"><li><a href=\"admin.php\">{$text['mnuadmin']}</a></li></ul><br/>";
	    ?>
	</td>

	<!-- This is the main contents of your home page. -->
	<td class="home_section" id="hs1">
	<span class="header"><?php echo $text['welcome']; ?></span><br/>

<!-- RANDOM PHOTO CODE STARTS HERE -->
<!-- If you don't want to have a random photo displayed, just remove the following line. -->

	<?php include("randomphoto.php"); ?>

<!-- RANDOME PHOTO CODE ENDS HERE -->

<?php
	//begin WELCOME PARAGRAPH (default text: "This is where you can welcome a user to your site.  You might also give them some basic information on navigating and links to any help or FAQ pages you may have.")
	//Configurable from Template Settings. You can also replace the t8_mainpara PHP block below with the desired text if you prefer that to using the Template Settings.
?>

		<?php echo getTemplateMessage('t8_mainpara'); ?>

<?php
	//end WELCOME PARAGRAPH
?>
		<br clear="both"/><br/>
	</td>
	<td class="home_section" id="hs2">
	    <span class="header"><?php echo $text['features']; ?></span><br/>

<!-- ADD "FEATURED SECTIONS" OF YOUR SITE BELOW -->

	<?php echo getTemplateMessage('t8_featurespara'); ?>

<!-- ADD "FEATURED SECTIONS" OF YOUR SITE ABOVE -->

	    <!-- Contact Us section -->
	    <hr/><br/>
	    <span class="header"><?php echo $text['contactus']; ?></span><br/><br/>

<!-- ADD YOUR CONTACT US TEXT BELOW -->

<?php
	$title1 = getTemplateMessage('t8_headtitle1');
	$title2 = getTemplateMessage('t8_headtitle2');
	$title3 = getTemplateMessage('t8_headtitle3');
	$title = $title1 ." " . $title2 ." " . $title3;
	$text['contactus_long'] = str_replace( "suggest.php", "suggest.php?page=" . urlencode($title), $text['contactus_long'] );
	echo $text['contactus_long'];
?>
		<br clear="both"/><br/>

<!-- ADD YOUR CONTACT US TEXT ABOVE -->
	</td>
	<td class="home_section" id="hs3">
	    <div class="latest_news rounded10">
	    <span class="header"><?php echo $text['latestnews']; ?></span><hr/>

<?php
	//begin LATEST NEWS TEXT
	//Configurable from Template Settings. You can also replace the t8_latestnews PHP block below with the desired text if you prefer that to using the Template Settings.
	//Example: "<b>5 Jan 2009</b> - Added a whole new look to my site.<br/><br/>"
?>

		<?php echo getTemplateMessage('t8_latestnews'); ?>

<?php
	//end LATEST NEWS TEXT
?>

	    </div>
	</td>
    </tr>
</table>

<?php
echo tng_footer($flags);
?>