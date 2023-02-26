<?php
/* PLEASE NOTE: that while this template was modeled on template 4: 
	* the topmenu.php and footer.php are also used for the Home Page, so 
	* if you want to make changes to the header and left nav area menu, you need to make the changes in topmenu.php
	* and if you want to make a change to the footer section, you need to make the changes in footer.php
	
	In other words the changes will apply to all pages and not just the home page
	
	*/
$cms['tngpath'] = "";
// Check if optional family headings are set in
//	Template database table in Template Settings
	$mydadheading = getTemplateMessage('t20_dadheading');
	$mymomheading = getTemplateMessage('t20_momheading');
	$spdadheading = getTemplateMessage('t20_spdadheading');
	$spmomheading = getTemplateMessage('t20_spmomheading');

include($cms['tngpath'] . "surname_cloud.class.php");
$flags['noicons'] = false;   // Do not generate the TNG Menu bar
$flags['noheader'] = false;  // Do not generate the header and left nav area menu
$flags['nobody'] = false;    // Do not generated the <body> statement
$tngconfig['showshare'] = false;
tng_header( $sitename ? "" : $text['ourpages'], $flags );
?>

<div id="homepage" class="content">

	<!-- Left half of home page follows -->
	<div id="leftsection" class="leftsection"><br /> 

	<div id="randomphoto" class="center"> 
	
<?php
	/* The Photo Option controls how the page photo is displayed, valid options are:
		* static - uses the Template Settings Main Photo image file (default option)
		* random - uses the TNG random photo script and the width, height, and collection variables 
		
		Note that you must specify random in all languages if you want to use a random photo
	*/

	if ($tmp['t20_photoption'] == "random" ) {
	?>
<?php
// Use the random photo with the following width and height parameters
	$rp_maxwidth = $tmp['t20_randomphotowidth'] ;  //  width 350 is needed to allow display in 1024 screen width
	$rp_maxheight = $tmp['t20_randomphotoheight'] ;
	$rp_mediatypeID = $tmp['t20_randomphotomediatypeID'] ;

    include("randomphoto.php");
	?>
<?php
	}
	else {
	?>	
		<img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t20_mainimage']; ?>" alt="" class="bigphoto" style="width:100%" /><br />
		<span class="smaller italic">
		&nbsp;&nbsp;<?php echo getTemplateMessage('t20_photocaption'); ?><br />
		</span>
<?php
	}
	?>
	</div><br/>  <!--end of randomphoto div -->

	<!-- Paternal Family or other heading -->

		<h3><a href="<?php echo $tmp['t20_dadpagelink']; ?>"><span class="blueemphasis"><?php echo getTemplateMessage('t20_dadheading'); ?></span></a></h3>
		<?php echo getTemplateMessage('t20_dadpara'); ?>

	<!-- Maternal Family or other heading -->
<?php
	// heading can be omitted and only the paragraph used
	if($mymomheading) {
?>
		<h3><a href="<?php echo $tmp['t20_mompagelink']; ?>"><span class="blueemphasis"><?php echo getTemplateMessage('t20_momheading'); ?></span></a></h3>
<?php
	}
?>
		<?php echo getTemplateMessage('t20_mompara'); ?>

	<!-- Spouse's Paternal Family or other heading -->

		<h3><a href="<?php echo $tmp['t20_spdadpagelink']; ?>"><span class="blueemphasis"><?php echo getTemplateMessage('t20_spdadheading'); ?></span></a></h3>
		
		<?php echo getTemplateMessage('t20_spdadpara'); ?>

	<!-- Spouse's Maternal Family or other heading -->

<?php
	// heading can be omitted and only the paragraph used
		if($spmomheading) {
?>
		<h3><a href="<?php echo $tmp['t20_spmompagelink']; ?>"><span class="blueemphasis"><?php echo getTemplateMessage('t20_spmomheading'); ?></span></a></h3>
<?php
	}
?>
		<?php echo getTemplateMessage('t20_spmompara'); ?>

	</div>  <!--  end of leftsection of content div -->
	
	<!-- Right half of home page follows -->
	<div id="rightsection" class="rightsection"><br /> 
		<h3 class="blueemphasis"><?php echo getTemplateMessage('t20_storiesheading'); ?></h3>
			<div class="normal">
			<p>
				<a href="<?php echo $tmp['t20_featurelink1']; ?>"><img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t20_featurethumb1']; ?>" alt="feature 1" class="featureimg" /><span class="blueemphasis featurelink"><?php echo getTemplateMessage('t20_featuretitle1'); ?></span></a> 
				<br class="featuretext"><?php echo getTemplateMessage('t20_featurepara1'); ?>
			</p>
			<p>
				<a href="<?php echo $tmp['t20_featurelink2']; ?>"><img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t20_featurethumb2']; ?>" alt="feature 2" class="featureimg" /><span class="blueemphasis featurelink"><?php echo getTemplateMessage('t20_featuretitle2'); ?></span></a>
				<br class="featuretext"><?php echo getTemplateMessage('t20_featurepara2'); ?>
			</p>
			<p>
				<a href="<?php echo $tmp['t20_featurelink3']; ?>"><img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t20_featurethumb3']; ?>" alt="feature 3" class="featureimg" /><span class="blueemphasis featurelink"><?php echo getTemplateMessage('t20_featuretitle3'); ?></span></a>
				<br class="featuretext"><?php echo getTemplateMessage('t20_featurepara3'); ?>
			</p>
			<p>
				<a href="<?php echo $tmp['t20_featurelink4']; ?>"><img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t20_featurethumb4']; ?>" alt="feature 4" class="featureimg" /><span class="blueemphasis featurelink"><?php echo getTemplateMessage('t20_featuretitle4'); ?></span></a>
				<br class="featuretext"><?php echo getTemplateMessage('t20_featurepara4'); ?>
			</p>
			<p>
				<a href="<?php echo $tmp['t20_featurelink5']; ?>"><img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t20_featurethumb5']; ?>" alt="feature 5" class="featureimg" /><span class="blueemphasis featurelink"><?php echo getTemplateMessage('t20_featuretitle5'); ?></span></a>
				<br class="featuretext"><?php echo getTemplateMessage('t20_featurepara5'); ?>
			</p>
			<p>
				<a href="<?php echo $tmp['t20_featurelink6']; ?>"><img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t20_featurethumb6']; ?>" alt="feature 6" class="featureimg" /><span class="blueemphasis featurelink"><?php echo getTemplateMessage('t20_featuretitle6'); ?></span></a>
				<br class="featuretext"><?php echo getTemplateMessage('t20_featurepara6'); ?>
			</p>

	<!-- end of Family Stories 1-6 -->
		</div>  <!-- end of normal div -->
		<div id="contactus" class="normal"><b><?php echo $text['contactus']; ?></b></div>

		<div class="normal">
		<p><img src="<?php echo $cms['tngpath'] . $templatepath; ?>img/email.gif" alt="email image" class="emailimg" /></p><p class="featuretext"><?php echo $text['contactus_long']; ?></p><br />
		</div>
	</div> <!--  end rightsection div -->


</div> <!--  end homepage div -->
	<div style="clear:both">
		<br/>
		<h2 style="text-align: center;"><?php echo getTemplateMessage('t20_topsurnames'); ?></h2>
										<!-- Surname Cloud -->
		<br />
		<div>
			<?php
			$nc = new surname_cloud();
			$nc->display($tmp['t20_nbrsurnames']);
			?>
		</div>
	</div>
<?php
	echo tng_footer($flags);
?>