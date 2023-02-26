<?php
global $tng_version, $flags;

if (strpos($_SERVER['SCRIPT_NAME'], 'index.php') === false) {
	echo "</div>";
}
?>
		<footer class="cb-footer clearfix">
			<div class="cb-content-layout layout-item-0">
				<div class="cb-content-layout-row">
					<div class="cb-layout-cell" style="width: 100%">
						<br/>
							<div class="hg-footertext">
							<?php
								$flags['basicfooter'] = true;
								echo tng_footer($flags);
							?>
							</div>
					</div>
				</div>
			</div>
		</footer>
	</div>  
</div>
