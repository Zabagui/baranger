<?php
include($cms['tngpath'] . "surname_cloud.class.php");

$flags['noicons'] = 0;
// PLEASE NOTE: This page only contains the contents of your main page.  If you are trying to make changes
//              to the header, you will need to edit topmenu.php.  If you want to edit the footer, edit
//              footer.php.

tng_header($sitename ? "" : $text['mnuheader'], $flags);
?>
<!-- Slide Show -->
 	<div id="slider" class="nivoSlider">
 				<img alt=""src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t21_slideimg-1']; ?>" title="<h1><?php echo getTemplateMessage('t21_slideheadline-1'); ?></h1><p><?php echo getTemplateMessage('t21_slidetext-1'); ?></p>
 						<p><a class='btn-small' href='<?php echo $tmp['t21_slidelink-1']; ?>'><?php echo getTemplateMessage('t21_slidelinktext-1'); ?></a></p>">

				<img alt=""src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t21_slideimg-2']; ?>" title="<h1><?php echo getTemplateMessage('t21_slideheadline-2'); ?></h1><p><?php echo getTemplateMessage('t21_slidetext-2'); ?></p>
						<p><a class='btn-small' href='<?php echo $tmp['t21_slidelink-2']; ?>'><?php echo getTemplateMessage('t21_slidelinktext-2'); ?></a></p>">

				<img alt=""src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t21_slideimg-3']; ?>" title="<h1><?php echo getTemplateMessage('t21_slideheadline-3'); ?></h1><p><?php echo getTemplateMessage('t21_slidetext-3'); ?></p>
						<p><a class='btn-small' href='<?php echo $tmp['t21_slidelink-3']; ?>'><?php echo getTemplateMessage('t21_slidelinktext-3'); ?></a></p>">	
 	</div>
 	
<!-- Top Paragraph -->
 	<h3><?php echo getTemplateMessage('t21_featuretitle-1'); ?></h3>
 	<p><?php echo getTemplateMessage('t21_featurepara-1'); ?></p>
				<?php
					//if($tmp['t21_featurelink-1]) {
				?>
	<p class="right"><a class="btn-detail" href="<?php echo $tmp['t21_featurelink-1']; ?>"><?php echo getTemplateMessage('t21_featurelinktext-1'); ?></a></p>

<hr class="noshow">
<!-- Content Area on Left Side -->
	<div class="contentLeft">
		<h1><?php echo getTemplateMessage('t21_featuretitle-2'); ?></h1>
		<p><?php echo getTemplateMessage('t21_featurepara-2'); ?></p>
		
		<h4><?php echo getTemplateMessage('t21_featuretitle-3'); ?></h4>
		<p><img class="img-frame-right" src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t21_featurethumb-3']; ?>"><?php echo getTemplateMessage('t21_featurepara-3'); ?></p>
				<?php
					//if($tmp['t21_featurelink-3]) {
				?>
		<p class="right"><a class="btn-detail" href="<?php echo $tmp['t21_featurelink-3']; ?>"><?php echo $text['more']; ?></a></p>

	
		<p>&nbsp;</p> 
	  </div>
<!-- Content Area in Sidebar -->
<div class="sidebarRight">
		<h2><?php echo getTemplateMessage('t21_sidebartitle-1'); ?></h2>

<!-- Random Photo Starts Here -->
<!-- If you don't want to have a random photo displayed, just remove this section down to 'RANDOM PHOTO CODE ENDS HERE' -->
	<?php
		$rp_maxwidth = "90%";
	    include("randomphoto.php");
	?>
<!-- Random Photo Ends Here -->
		
		<h2><?php echo getTemplateMessage('t21_sidebartitle-2'); ?></h2>
		<p><?php echo getTemplateMessage('t21_sidebarpara-2'); ?></p>

<!-- Sidebar Links -->
		<ul class="list4">
			<li><a href="<?php echo $tmp['t21_sidebarlink-1']; ?>"><?php echo getTemplateMessage('t21_sidebarlinktext-1'); ?></a></li>
			<li><a href="<?php echo $tmp['t21_sidebarlink-2']; ?>"><?php echo getTemplateMessage('t21_sidebarlinktext-2'); ?></a></li>
			
							<?php if($tmp['t21_sidebarlink-3']) { ?>			
			<li><a href="<?php echo $tmp['t21_sidebarlink-3']; ?>"><?php echo getTemplateMessage('t21_sidebarlinktext-3'); ?></a></li>
						 	<?php } ?>
					
							<?php if($tmp['t21_sidebarlink-4']) { ?>			
			<li><a href="<?php echo $tmp['t21_sidebarlink-4']; ?>"><?php echo getTemplateMessage('t21_sidebarlinktext-4'); ?></a></li>
						 	<?php } ?>
					
							<?php if($tmp['t21_sidebarlink-5']) { ?>			
			<li><a href="<?php echo $tmp['t21_sidebarlink-5']; ?>"><?php echo getTemplateMessage('t21_sidebarlinktext-5'); ?></a></li>
						 	<?php } ?>
					
		</ul>		
</div>
<div class="clear"></div>

<!-- Begin Postcards -->
	<h3 class="center"><?php echo getTemplateMessage('t21_headline-1'); ?></h3>
       <article class="contentBox4a wow zoomIn">
                       <div class="postcard">
                            <div class="thumbnail">
                                <figure><img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t21_snipimage-1']; ?>"></figure>
                                <div class="caption">
                                    <p class="title2"><?php echo getTemplateMessage('t21_snipname-1'); ?></p>
                                    <p><?php echo getTemplateMessage('t21_snipinfoone-1'); ?></p>
                                    <a href="<?php echo $tmp['t21_sniplink-1']; ?>"><span class="fa fa-play-circle-o"></span></a>
                            </div>
                        </div>
					</div>
	</article>
	<article class="contentBox4b wow zoomIn" data-wow-delay=".4s">
                      <div class="postcard">
                            <div class="thumbnail">
                                <figure><img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t21_snipimage-2']; ?>"></figure>
                                <div class="caption">
                                    <p class="title2"><?php echo getTemplateMessage('t21_snipname-2'); ?></p>
                                    <p><?php echo getTemplateMessage('t21_snipinfoone-2'); ?></p>
                                    <a href="<?php echo $tmp['t21_sniplink-2']; ?>"><span class="fa fa-play-circle-o"></span></a>
                                </div>
                            </div>
                        </div>
	</article>
	<article class="contentBox4c wow zoomIn" data-wow-delay=".6s">
                      <div class="postcard">
                            <div class="thumbnail">
                                <figure><img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t21_snipimage-3']; ?>"></figure>
                                <div class="caption">
                                    <p class="title2"><?php echo getTemplateMessage('t21_snipname-3'); ?></p>
                                    <p><?php echo getTemplateMessage('t21_snipinfoone-3'); ?></p>
                                    <a href="<?php echo $tmp['t21_sniplink-3']; ?>"><span class="fa fa-play-circle-o"></span></a>
                                </div>
                            </div>
                        </div>
	</article>
	<article class="contentBox4d wow zoomIn" data-wow-delay=".8s">
                     <div class="postcard">
                            <div class="thumbnail">
                                <figure><img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t21_snipimage-4']; ?>"></figure>
                                <div class="caption">
                                    <p class="title2"><?php echo getTemplateMessage('t21_snipname-4'); ?></p>
                                    <p><?php echo getTemplateMessage('t21_snipinfoone-4'); ?></p>
                                    <a href="<?php echo $tmp['t21_sniplink-4']; ?>"><span class="fa fa-play-circle-o"></span></a>
                                </div>
                            </div>
                        </div>
	</article>

<div class="clear"></div>
<hr class="fancy">
	<h4><?php echo getTemplateMessage('t21_featuretitle-4'); ?></h4>
	<p><img class="img-frame-left " src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t21_featurethumb-4']; ?>" alt=""/>
		<?php echo getTemplateMessage('t21_featurepara-4'); ?></p>
	
	<?php if($tmp['t21_featurelink-4']) { ?>
		<p class="right"><a class="btn-detail" href="<?php echo $tmp['t21_featurelink-4']; ?>"><?php echo $text['more']; ?></a></p>
			<?php } ?>
<hr class="fancy">

<!-- Surname Cloud Starts Here -->
<!-- If you don't want to have a surname cloud, just remove this section down to 'SURNAME CLOUD CODE ENDS HERE' -->
		<div class="surnamecloud">
			<h3 class="center"><?php echo getTemplateMessage('t21_topsurnames'); ?></h3>	 
			<p><?php echo getTemplateMessage('t21_textpara1'); ?></p>
			 <?php
			$nc = new surname_cloud();
			$nc->display(100);
			?>
		 <br>
		</div>	 
<!-- Surname Clouds Ends Here -->

<?php
echo tng_footer($flags);
?>
