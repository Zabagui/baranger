<!-- begin footer -->
<?php global $text, $flags, $tng_version; ?>
	</div>
	<div class="footer-widgets">
		<div class="wrap">
			<div class="footer-widgets-1 widget-area">
				<section class="widget widget_text">
					<div class="">
						<h4 class="widget-title-footer"><?php echo getTemplateMessage('t15_texttitle1'); ?></h4>
						<div class="textwidget">
							<?php 
								echo getTemplateMessage('t15_textpara1');
								$tl1 = getTemplateMessage('t15_textlink1');
								if($tl1) {
							?>
								<p><a class="footer-link" href="<?php echo $tl1; ?>"><?php echo $text['more']; ?> ...</a></p>
							<?php
								}
							?>
						</div>
					</div>
				</section>
			</div>
			<div class="footer-widgets-2 widget-area">
				<section class="widget latest-tweets">
					<div class="">
						<h4 class="widget-title-footer"><?php echo getTemplateMessage('t15_texttitle2'); ?></h4>
						<div class="textwidget">
							<?php 
								echo getTemplateMessage('t15_textpara2');
								$tl2 = getTemplateMessage('t15_textlink2');
								if($tl2) {
							?>
								<p><a class="footer-link" href="<?php echo $tl2; ?>"><?php echo $text['more']; ?> ...</a></p>
							<?php
								}
							?>
						</div>
					</div>
				</section>
			</div>
			<div class="footer-widgets-3 widget-area">
				<section class="widget widget_search">
					<div class="">
						<h4 class="widget-title-footer"><?php echo $text['search']; ?></h4>
						<form method="get" class="search-form" action="helpme" role="search" onsubmit="return searchGoogleWebSite('<?php echo $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']); ?>')">
							<input name="s" id="GoogleText" placeholder="<?php echo $text['searchsite']; ?> ..." type="search">
							<input value="<?php echo $text['search']; ?>" type="submit">
						</form>
					</div>
				</section>
				<section class="widget">
					<div class="">
						<h4 class="widget-title-footer"><?php echo getTemplateMessage('t15_texttitle3'); ?></h4>
						<div class="">
							<?php echo getTemplateMessage('t15_textpara3'); ?>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
	<footer class="site-footer" role="contentinfo">
		<div class="wrap">
	    	<br clear="all">
			<?php
				$flags['basicfooter'] = true;
				echo tng_footer($flags);
			?>
		</div>
	</footer>
</div>

<!-- end footer -->