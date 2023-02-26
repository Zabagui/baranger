<?php
$flags['noicons'] = 0;
// PLEASE NOTE: This page only contains the contents of your main page.  If you are trying to make changes
//              to the header, you will need to edit topmenu.php.  If you want to edit the footer, edit
//              footer.php. 

tng_header($sitename ? "" : $text['mnuheader'], $flags);
$dadlabel = getTemplateMessage('t19_dadside');
$momlabel = getTemplateMessage('t19_momside');

if($sitever == "standard") {
?>
		
<?php
}
?>
</div>
<div class="topsection">
<!-- Slide Show -->
	   <div id="slider" class="nivoSlider">
		  <img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t19_mainimage-1']; ?>" alt="" title="<h1><?php echo getTemplateMessage('t19_headline-1'); ?></h1><p><?php echo getTemplateMessage('t19_subhead-1'); ?></p>">     
		  <img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t19_mainimage-2']; ?>" alt="" title="<h1><?php echo getTemplateMessage('t19_headline-2'); ?></h1><p><?php echo getTemplateMessage('t19_subhead-2'); ?></p>">
		  <img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t19_mainimage-3']; ?>" alt="" title="<h1><?php echo getTemplateMessage('t19_headline-3'); ?></h1><p><?php echo getTemplateMessage('t19_subhead-3'); ?></p>">
	</div>
</div>
<div class="container">
<!-- Right side content area -->
	<div class="contentRight">
		<h1><?php echo getTemplateMessage('t19_featuretitle1'); ?></h1>
		<p class="dropcap"><?php echo getTemplateMessage('t19_featurepara1'); ?></p>
		<p class="right"><a class="btn-detail" href="<?php echo $tmp['t19_featurelink1']; ?>"><?php echo $text['more']; ?></a></p>
<!-- 2nd text box with image floated right -->
		<h3><?php echo getTemplateMessage('t19_featuretitle2'); ?></h3>
		<p><a href="<?php echo $tmp['t19_featurelinks']; ?>" title="" class=""><img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t19_featurethumb2']; ?>" id="mainphoto" class="img-frame-right" alt="main image"></a><?php echo getTemplateMessage('t19_featurepara2'); ?></p>
		<p class="right"><a class="btn-detail" href="<?php echo $tmp['t19_featurelink2']; ?>"><?php echo $text['more']; ?></a></p>
	</div>
<!-- SidebarLeft content area -->
	<div class="sidebarLeft">
	<div class="callbox1">
		<h4><?php echo $text['search']; ?></h4>
			<form method="get" name="searchform" action="search.php" class="entry-content" id="home-search-box">
				<div style="display:inline-block;">
					<label for="myfirstname"><?php echo $text['firstname']; ?></label><br/>
					<input class="medfield" type="text" value="" name="myfirstname" />
					<br>
					<label for="mylastname"><?php echo $text['lastname']; ?></label><br/>
					<input class="medfield" type="text" value="" name="mylastname" />
					<br>
					<input type="hidden" name="mybool" value="AND" />
				</div>
				<div style="display:inline-block;vertical-align:top;padding:15px">
					<input type="submit" id="search-submit"  value="<?php echo $text['search']; ?>" />
					<ul class="home-menus">
						<li><a href="surnames.php"><?php echo $text['surnames']; ?></a></li>
						<li><a href="searchform.php"><?php echo $text['mnuadvancedsearch']; ?></a></li>
					</ul>
				</div>
					</form>
	</div>		
	<div class="callbox1">
		<h4><?php echo getTemplateMessage('t19_featuretitle3'); ?></h4>
		<p><?php echo getTemplateMessage('t19_featurepara3'); ?></p>
		<p class="right"><a class="btn-detail" href="<?php echo $tmp['t19_featurelink3']; ?>"><?php echo $text['more']; ?></a></p>
		<p></p>
	</div>		
	<div class="callbox1">		
	<h4><?php echo getTemplateMessage('t19_featuretitle4'); ?></h4> 
			<ul class="list1">
			<li><a href="<?php echo $cms['tngpath']; ?>pedigree.php?personID=<?php echo $tmp['t19_dadperson']; ?>&amp;tree=<?php echo $tmp['t19_dadtree']; ?>"><?php echo $dadlabel; ?></a></li>
			<li><a href="<?php echo $cms['tngpath']; ?>pedigree.php?personID=<?php echo $tmp['t19_momperson']; ?>&amp;tree=<?php echo $tmp['t19_momtree']; ?>"><?php echo $momlabel; ?></a></li>
			
				<?php
					//if($tmp['t19_link-1']) {
				?>
				<li><a href="<?php echo $tmp['t19_link-1']; ?>"><?php echo $tmp['t19_texttitle1']; ?></a></li>
				
				<?php
					//if($tmp['t19_link-2']) {
				?>
				<li><a href="<?php echo $tmp['t19_link-2']; ?>"><?php echo $tmp['t19_texttitle2']; ?></a></li>
				
				<?php
					//if($tmp['t19_link-3']) {
				?>
				<li><a href="<?php echo $tmp['t19_link-3']; ?>"><?php echo $tmp['t19_texttitle3']; ?></a></li>			
			</ul>
		<p><?php echo getTemplateMessage('t19_textpara1'); ?></p><br>	
	</div>
		</div>
	<div class="clear"></div>
</div>
	<hr class="noshow">
</div>
<br>
<!-- Parallax block area  -->
	<section class="fancybox">		
	  <h1 class="center"><?php echo getTemplateMessage('t19_headline'); ?></h1>   
	  <h5 class="center"><?php echo getTemplateMessage('t19_subhead1'); ?></h5>
	  <div class="container">
		 <article class="contentBox4a">
		 <h6 class="center"><?php echo getTemplateMessage('t19_sniptitle-1'); ?></h6>
			<figure class="snip2">
			<img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t19_snipimage-1']; ?>" alt="<?php echo getTemplateMessage('t19_snipname-1'); ?>" />
				<figcaption>
			   <h2><?php echo getTemplateMessage('t19_snipname-1'); ?></h2>
			   <h3><?php echo getTemplateMessage('t19_snipinfoone-1'); ?></h3>
			   <p><?php echo getTemplateMessage('t19_snipinfotwo-1'); ?></p>
		   </figcaption>
			   <a href="<?php echo $cms['tngpath']; ?>getperson.php?personID=<?php echo $tmp['t19_snipperson-1']; ?>&amp;tree=<?php echo $tmp['t19_sniptree-1']; ?>"></a>
			</figure>
		 </article>
		 <article class="contentBox4b">
		 <h6 class="center"><?php echo getTemplateMessage('t19_sniptitle-2'); ?></h6>
			<figure class="snip2">
			<img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t19_snipimage-2']; ?>" alt="<?php echo getTemplateMessage('t19_snipname-2'); ?>" />
			   <figcaption>
			   <h2><?php echo getTemplateMessage('t19_snipname-2'); ?></h2>
			   <h3><?php echo getTemplateMessage('t19_snipinfoone-2'); ?></h3>
			   <p><?php echo getTemplateMessage('t19_snipinfotwo-2'); ?></p>
			   </figcaption>
			   <a href="<?php echo $cms['tngpath']; ?>getperson.php?personID=<?php echo $tmp['t19_snipperson-2']; ?>&amp;tree=<?php echo $tmp['t19_sniptree-2']; ?>"></a>
			</figure>
		 </article>
		 <article class="contentBox4c">
		 <h6 class="center"><?php echo getTemplateMessage('t19_sniptitle-3'); ?></h6>
			<figure class="snip2">
			   <img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t19_snipimage-3']; ?>" alt="<?php echo getTemplateMessage('t19_snipname-3'); ?>" />
			   <figcaption>
			   <h2><?php echo getTemplateMessage('t19_snipname-3'); ?></h2>
			   <h3><?php echo getTemplateMessage('t19_snipinfoone-3'); ?></h3>
			   <p><?php echo getTemplateMessage('t19_snipinfotwo-3'); ?></p>
			   </figcaption>
			   <a href="<?php echo $cms['tngpath']; ?>getperson.php?personID=<?php echo $tmp['t19_snipperson-3']; ?>&amp;tree=<?php echo $tmp['t19_sniptree-3']; ?>"></a>
			</figure>
		 </article>
		 <article class="contentBox4d">
		 <h6 class="center"><?php echo getTemplateMessage('t19_sniptitle-4'); ?></h6>
			<figure class="snip2">
			   <img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t19_snipimage-4']; ?>" alt="<?php echo getTemplateMessage('t19_snipname-4'); ?>" />
			   <figcaption>
			   <h2><?php echo getTemplateMessage('t19_snipname-4'); ?></h2>
			   <h3><?php echo getTemplateMessage('t19_snipinfoone-4'); ?></h3>
			   <p><?php echo getTemplateMessage('t19_snipinfotwo-4'); ?></p>
			   </figcaption>
			   <a href="<?php echo $cms['tngpath']; ?>getperson.php?personID=<?php echo $tmp['t19_snipperson-4']; ?>&amp;tree=<?php echo $tmp['t19_sniptree-4']; ?>"></a>
			</figure>
		 </article>
		 <div class="clear"></div>
	</div>
</section>	
<br><br>
<!-- 3 block content area -->
<div class="container">
		<!-- Begin Featuring & Reviews area -->
		 <article class="contentBox3a">
		 	<h6><?php echo getTemplateMessage('t19_featuretitle5'); ?><img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t19_featurethumb5']; ?>" id="bottomphoto1" class="img-round-left" alt="bottom image"></h6>
		 	<p><?php echo getTemplateMessage('t19_featurepara5'); ?></p>
		 	<p class="right"><a class="btn-detail" href="<?php echo $tmp['t19_featurelink5']; ?>"><?php echo $text['more']; ?></a></p>
		 </article>
		
 		<article class="contentBox3b">
		 <h6><?php echo getTemplateMessage('t19_quotehead'); ?></h6>
		 <p class="center"><i><?php echo getTemplateMessage('t19_quotesubhead'); ?></i></p>
	  <ul id="ticker">
		 <li>
			<div class="testimonial">
			   <div class="tcontent center">
				  <!-- Edit quote --><?php echo getTemplateMessage('t19_quote-1'); ?></div>
			   <div class="author">~ <?php echo getTemplateMessage('t19_author-1'); ?></div>
			</div>
		 </li>
		 <li>
			<div class="testimonial">
			   <div class="tcontent center">
				  <!-- Edit quote --><?php echo getTemplateMessage('t19_quote-2'); ?></div>
			   <div class="author">~ <?php echo getTemplateMessage('t19_author-2'); ?></div>
			</div>
		 </li>
		 <li>
			<div class="testimonial">
			   <div class="tcontent center">
				  <!-- Edit quote --><?php echo getTemplateMessage('t19_quote-3'); ?></div>
			   <div class="author">~ <?php echo getTemplateMessage('t19_author-3'); ?></div>
			</div>
		 </li>
		 <li>
			<div class="testimonial">
			   <div class="tcontent center">
				  <!-- Edit quote --><?php echo getTemplateMessage('t19_quote-4'); ?></div>
			   <div class="author">~ <?php echo getTemplateMessage('t19_author-4'); ?></div>
			</div>
		 </li>
		 <li>
			<div class="testimonial">
			   <div class="tcontent center">
				  <!-- Edit quote --><?php echo getTemplateMessage('t19_quote-5'); ?></div>
			   <div class="author">~ <?php echo getTemplateMessage('t19_author-5'); ?></div>
			</div>
		 </li>
	  </ul>
	  </article>
	<!-- closes ticker boxes --> 
		 <article class="contentBox3c">
		 	<h6><?php echo getTemplateMessage('t19_featuretitle6'); ?><img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t19_featurethumb6']; ?>" id="bottomphoto1" class="img-round-left" alt="bottom image"></h6>
		 	<p><?php echo getTemplateMessage('t19_featurepara6'); ?></p>
		 	<p class="right"><a class="btn-detail" href="<?php echo $tmp['t19_featurelink6']; ?>"><?php echo $text['more']; ?></a></p>
		 </article>
		 <div class="clear"></div>
   </div> </div>


		<br clear="both"/>

<?php
echo tng_footer($flags);
?>

