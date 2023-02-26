<?php global $currentuser, $text, $tng_version, $flags;
?>
					</div>  <!-- end of content div -->
				</div>  <!-- end of col1 div -->
			 </div> <!-- end of leftcol -->
		</div> <!-- end of colmask t20leftmenu div -->
	</div> <!-- end of page div -->
				<div class="cleared"></div>

	<div class="footer">
	<br />

<?php
	$flags['basicfooter'] = true;
	echo tng_footer($flags);
?>
	<br />
	</div>
	<script src="<?php echo $cms['tngpath'] . $templatepath; ?>js/ddaccordion.js" type="text/javascript"></script>
	<script src="<?php echo $cms['tngpath'] . $templatepath; ?>js/ddaccordion_init.js" type="text/javascript"></script>
<!-- end of footer.php for template 20 -->