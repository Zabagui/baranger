<?php global $text, $tng_version, $flags; ?>

</td></tr></table></td></tr>
<tr><td class="tablesubheader"><div class="topmenu" style="text-align:center">

<!--EDIT BOTTOM LINK MENU BELOW HERE-->

<a href="<?php echo $cms['tngpath']; ?>index.php" class="lightlink" target="_top"><?php echo $text['mnuheader']; ?></a>&nbsp;|&nbsp;
<a href="<?php echo $cms['tngpath']; ?>whatsnew.php" class="lightlink" target="_top"><?php echo $text['mnuwhatsnew']; ?></a>&nbsp;|&nbsp;
<a href="<?php echo $cms['tngpath']; ?>mostwanted.php" class="lightlink" target="_top"><?php echo $text['mostwanted']; ?></a>&nbsp;|&nbsp;
<a href="<?php echo $cms['tngpath']; ?>surnames.php" class="lightlink" target="_top"><?php echo $text['mnulastnames']; ?></a>&nbsp;|&nbsp;
<a href="<?php echo $cms['tngpath']; ?>browsemedia.php?mediatypeID=photos" class="lightlink" target="_top"><?php echo $text['mnuphotos']; ?></a>&nbsp;|&nbsp;
<a href="<?php echo $cms['tngpath']; ?>browsemedia.php?mediatypeID=histories" class="lightlink" target="_top"><?php echo $text['mnuhistories']; ?></a>&nbsp;|&nbsp;
<a href="<?php echo $cms['tngpath']; ?>browsemedia.php?mediatypeID=documents" class="lightlink" target="_top"><?php echo $text['documents']; ?></a>&nbsp;|&nbsp;
<a href="<?php echo $cms['tngpath']; ?>cemeteries.php" class="lightlink" target="_top"><?php echo $text['mnucemeteries']; ?></a>&nbsp;|&nbsp;
<a href="<?php echo $cms['tngpath']; ?>places.php" class="lightlink" target="_top"><?php echo $text['places']; ?></a>&nbsp;|&nbsp;
<a href="<?php echo $cms['tngpath']; ?>anniversaries.php" class="lightlink" target="_top"><?php echo $text['dates']; ?></a>&nbsp;|&nbsp;
<a href="<?php echo $cms['tngpath']; ?>reports.php" class="lightlink" target="_top"><?php echo $text['mnureports']; ?></a>&nbsp;|&nbsp;
<a href="<?php echo $cms['tngpath']; ?>browsesources.php" class="lightlink" target="_top"><?php echo $text['mnusources']; ?></a>

<!--EDIT BOTTOM LINK MENU ABOVE HERE-->

</div> <!-- end of topmenu div -->
</td></tr>
<tr><td class="tableheader"><img src="<?php echo $cms['tngpath']; ?>img/spacer.gif" width="25" height="25" alt="" /></td></tr></table>
<br />
<div class="footer small">
<?php
	$flags['basicfooter'] = true;
	echo tng_footer($flags);
?>
	<br /><br />
</div> <!-- end of footer div -->
</div> <!-- end of center div -->
<!-- end footer.php for template 5-->