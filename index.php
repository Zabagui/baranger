<?php
include("tng_begin.php");

//Insert the following lines in your index.php to take advantage of template switching
if($templateswitching && $templatenum) {
	include($cms['tngpath'] . "templates/$templatepfx$templatenum/index.php");
	exit;
}
//end of lines to be inserted for template switching

$flags['noicons'] = true;
$flags['noheader'] = true;
tng_header( $text['mnuheader'], $flags );
?>

<!-- "Home Page" (the text for these messages can be found at near the bottom of text.php -->
<h1><?php echo $text['mnuheader']; ?></h1>

<?php
	if( $currentuser ) {
		echo "<p><strong>{$text['welcome']}, $currentuserdesc.</strong></p>\n";
	}
?>

<h2><?php echo $text['mnusearchfornames']; ?></h2>
<!-- Do not change the form action or field names! -->
<form action="search.php" method="get">
<table border="0" cellspacing="5" cellpadding="0">
	<tr><td><span class="normal"><?php echo $text['mnulastname']; ?>: </span><br/><input type="text" name="mylastname" size="14"></td></tr>
	<tr><td><span class="normal"><?php echo $text['mnufirstname']; ?>:</span><br/><input type="text" name="myfirstname" size="14"></td></tr>
	<tr><td><input type="hidden" name="mybool" value="AND" /><input type="hidden" name="offset" value="0" /><input type="submit" name="search" value="<?php echo $text['mnusearch']; ?>" /></td></tr>
</table>
</form>

<h2><?php echo $text['mnufeatures']; ?></h2>

<ul>
<?php
	if( $currentuser ) {
		//this means you're logged in
		echo "<li><a href=\"logout.php\">{$text['mnulogout']}</a></li>\n";
	}
	else {
		//this means you're logged out
		echo "<li><a href=\"login.php\">{$text['mnulogon']}</a></li>\n";
	}
	echo "<li><a href=\"newacctform.php\">{$text['mnuregister']}</a></li>\n";
	echo "<li><a href=\"searchform.php\">{$text['mnuadvancedsearch']}</a></li>\n";
	echo "<li><a href=\"surnames.php\">{$text['mnulastnames']}</a></li>\n";
	echo "<li><a href=\"bookmarks.php\">{$text['bookmarks']}</a></li>\n";
	echo "<li><a href=\"statistics.php\">{$text['mnustatistics']}</a></li>\n";
	echo "<li><a href=\"browsemedia.php?mediatypeID=photos\">{$text['mnuphotos']}</a></li>\n";
	echo "<li><a href=\"browsemedia.php?mediatypeID=histories\">{$text['mnuhistories']}</a></li>\n";
	echo "<li><a href=\"browsemedia.php?mediatypeID=documents\">{$text['documents']}</a></li>\n";
	echo "<li><a href=\"browsemedia.php?mediatypeID=videos\">{$text['videos']}</a></li>\n";
	echo "<li><a href=\"browsemedia.php?mediatypeID=recordings\">{$text['recordings']}</a></li>\n";
	echo "<li><a href=\"browsealbums.php\">{$text['albums']}</a></li>\n";
	echo "<li><a href=\"browsemedia.php\">{$text['allmedia']}</a></li>\n";
	echo "<li><a href=\"cemeteries.php\">{$text['mnucemeteries']}</a></li>\n";
	echo "<li><a href=\"browsemedia.php?mediatypeID=headstones\">{$text['mnutombstones']}</a></li>\n";
	echo "<li><a href=\"places.php\">{$text['places']}</a></li>\n";
	echo "<li><a href=\"browsenotes.php\">{$text['notes']}</a></li>\n";
	echo "<li><a href=\"anniversaries.php\">{$text['anniversaries']}</a></li>\n";
	echo "<li><a href=\"reports.php\">{$text['mnureports']}</a></li>\n";
	echo "<li><a href=\"browsesources.php\">{$text['mnusources']}</a></li>\n";
	echo "<li><a href=\"browserepos.php\">{$text['repositories']}</a></li>\n";
	echo "<li><a href=\"whatsnew.php\">{$text['mnuwhatsnew']}</a></li>\n";
	echo "<li><a href=\"mostwanted.php\">{$text['mostwanted']}</a></li>\n";
	echo "<li><a href=\"changelanguage.php\">{$text['mnulanguage']}</a></li>\n";
	if( $allow_admin ) {
		echo "<li><a href=\"showlog.php\">{$text['mnushowlog']}</a></li>\n";
		echo "<li><a href=\"admin.php\">{$text['mnuadmin']}</a></li>\n";
	}
	echo "<li><a href=\"suggest.php\">{$text['contactus']}</a></li>\n";
?>
</ul>

<p><strong>Please customize this page!</strong></p> 

</body>
</html>
