<?php
$flags['noicons'] = 0;
// PLEASE NOTE: This page only contains the contents of your main page.  If you are trying to make changes
//              to the header, you will need to edit topmenu.php.  If you want to edit the footer, edit
//              footer.php.

tng_header($sitename ? "" : $text['mnuheader'], $flags);
if($sitever == "standard") {
?>
		<br clear="all"><br/>
<?php
}
?>
		<div class="content-sidebar-wrap">
			<main class="content">
				<div class="home-top widget-area">
					<section id="featured-article" class="widget featured-content">
						<div class="">
							<h4 class="widget-title"><?php echo getTemplateMessage('t15_subhead1'); ?></h4>
							<article class="post">
							<?php
								if(!empty($tmp['t15_featurelink1'])) {
							?>
								<a href="<?php echo $tmp['t15_featurelink1']; ?>" title="" class="alignnone"><img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t15_mainimage']; ?>" id="mainphoto" class="" alt="main image"></a>
								<header class="entry-header">
									<h2 class="entry-title"><a href="<?php echo $tmp['t15_featurelink1']; ?>"><?php echo getTemplateMessage('t15_featuretitle1'); ?></a></h2>
								</header>
							<?php
								}
								else {
							?>
								<img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t15_mainimage']; ?>" id="mainphoto" class="" alt="main image">
								<header class="entry-header">
									<h2 class="entry-title"><?php echo getTemplateMessage('t15_featuretitle1'); ?></h2>
								</header>
							<?php
								}
							?>
								<div class="entry-content">
									<?php echo getTemplateMessage('t15_featurepara1'); ?>
								</div>
							</article>
						</div>
					</section>
				</div>
				<div class="home-middle widget-area">
					<section class="widget featured-content">
						<div class="">
							<h4 class="widget-title"><?php echo getTemplateMessage('t15_subhead2'); ?></h4>
							<article class="post entry">
								
							<?php
								if(!empty($tmp['t15_featurelink2'])) {
							?>
								<a href="<?php echo $tmp['t15_featurelink2']; ?>" title="" class="alignnone">
								<img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t15_featurethumb2']; ?>" alt="" title="" class="" width="405"></a>
								<header class="entry-header">
									<h2 class="entry-title"><a href="<?php echo $tmp['t15_featurelink2']; ?>"><?php echo getTemplateMessage('t15_featuretitle2'); ?></a></h2>
								</header>
							<?php
								}
								else {
							?>
								<img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t15_featurethumb2']; ?>" alt="" title="" class="" width="405">
								<header class="entry-header">
									<h2 class="entry-title"><?php echo getTemplateMessage('t15_featuretitle2'); ?></h2>
								</header>
							<?php
								}
							?>
								<div class="entry-content">
									<?php echo getTemplateMessage('t15_featurepara2'); ?>
								</div>
							</article>
							<article class="post">
							<?php
								if(!empty($tmp['t15_featurelink3'])) {
							?>
								<a href="<?php echo $tmp['t15_featurelink3']; ?>" title="" class="alignnone">
									<img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t15_featurethumb3']; ?>" alt="" title=""class="" width="405"></a>
								<header class="entry-header">
									<h2 class="entry-title"><a href="<?php echo $tmp['t15_featurelink3']; ?>"><?php echo getTemplateMessage('t15_featuretitle3'); ?></a></h2>
								</header>
							<?php
								}
								else {
							?>
								<img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t15_featurethumb3']; ?>" alt="" title="" class="" width="405">
								<header class="entry-header">
									<h2 class="entry-title"><?php echo getTemplateMessage('t15_featuretitle3'); ?></h2>
								</header>
							<?php
								}
							?>
								<div class="entry-content">
									<?php echo getTemplateMessage('t15_featurepara3'); ?>
								</div>
							</article>
						</div>
					</section>
				</div>
			</main>
			<aside class="sidebar sidebar-primary widget-area">
				<section class="widget featured-content">
					<div class="">
						<h4 class="widget-title"><?php echo getTemplateMessage('t15_sidebarhead1'); ?></h4>
						<article class="post entry">
							<a href="<?php echo $tmp['t15_featurelink4']; ?>" title="" class="alignleft"><img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t15_featurethumb4']; ?>" class="" alt="" height="100" width="100"></a>
							<header class="entry-header">
								<h2 class="entry-title"><a href="<?php echo $tmp['t15_featurelink4']; ?>"><?php echo getTemplateMessage('t15_featuretitle4'); ?></a></h2>
							</header>
							<?php echo getTemplateMessage('t15_featurepara4'); ?>
							<br clear="all">
						</article>
						<article class="post entry">
							<a href="<?php echo $tmp['t15_featurelink5']; ?>" title="" class="alignleft"><img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t15_featurethumb5']; ?>" class="" alt="" height="100" width="100"></a>
							<header class="entry-header">
								<h2 class="entry-title"><a href="<?php echo $tmp['t15_featurelink5']; ?>"><?php echo getTemplateMessage('t15_featuretitle5'); ?></a></h2>
							</header>
							<?php echo getTemplateMessage('t15_featurepara5'); ?>
							<br clear="all">
						</article>
						<article class="post entry">
							<a href="<?php echo $tmp['t15_featurelink6']; ?>" title="" class="alignleft"><img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t15_featurethumb6']; ?>" class="" alt="" height="100" width="100"></a>
							<header class="entry-header">
								<h2 class="entry-title"><a href="<?php echo $tmp['t15_featurelink6']; ?>"><?php echo getTemplateMessage('t15_featuretitle6'); ?></a></h2>
							</header>
							<?php echo getTemplateMessage('t15_featurepara6'); ?>
							<br clear="all">
						</article>
					</div>
				</section>
				<section class="widget widget_text">
					<div class="">
						<h4 class="widget-title"><?php echo getTemplateMessage('t15_sidebarhead2'); ?></h4>
						<div class="">
						<?php
							if(!empty($tmp['t15_featurelink7'])) {
						?>
							<a href="<?php echo $tmp['t15_featurelink7']; ?>" title="" class="alignleft"><img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t15_featurethumb7']; ?>" class="" alt="" height="150" width="150"></a>
						<?php
							}
							else {
						?>
							<img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t15_featurethumb7']; ?>" class="" alt="" height="150" width="150">
						<?php
							}
						?>
							<?php echo getTemplateMessage('t15_featurepara7'); ?>
						</div>
					</div>
				</section>
				<section class="widget widget_text">
					<div class="">
						<h4 class="widget-title"><?php echo getTemplateMessage('t15_sidebarhead3'); ?></h4>
						<?php
							if(!empty($tmp['t15_featurelink8'])) {
						?>
							<a href="<?php echo $tmp['t15_featurelink8']; ?>" title="" class="alignnone"><img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t15_featurethumb8']; ?>" class="" alt="" height="200" width="360"></a>
						<?php
							}
							else {
						?>
							<img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t15_featurethumb8']; ?>" class="" alt="" height="200" width="360">
						<?php
							}
						?>
						<div class="">
							<?php echo getTemplateMessage('t15_featurepara8'); ?>
						</div>
					</div>
				</section>
			</aside>
		</div>
		<br clear="both"/>

<?php
echo tng_footer($flags);
?>

</body>
</html>