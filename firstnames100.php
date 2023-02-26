<?php
$textpart = "surnames";
include("tng_begin.php");

$topnum = isset($topnum) ? preg_replace("/[^0-9]/", '', $topnum) : "100";

$firstnames_all_url = getURL( "firstnames-all", 1 );
$firstnames_url = getURL( "firstnames", 1 );
$firstnames100_url = getURL( "firstnames100", 1 );
$text['top30first'] = preg_replace("/xxx/",$topnum,$text['top30first']);

$treestr = $tree ? " ({$text['tree']}: $tree)" : "";
$logstring = "<a href=\"$firstnames100_url" . "topnum=$topnum&amp;tree=$tree\">" . xmlcharacters($text['firstnamelist'] . ": {$text['top']} $topnum$treestr") . "</a>";
writelog($logstring);
preparebookmark($logstring);

tng_header( $text['firstnamelist'] . ": {$text['top30first']}", $flags );
?>

<h1 class="header"><span class="headericon" id="surnames-hdr-icon"></span><?php echo $text['firstnamelist'] . ": {$text['top30first']}"; ?></h1><br class="clearleft"/>
<?php
echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'firstnames100', 'method' => 'get', 'name' => 'form1', 'id' => 'form1'));

$formstr = getFORM( "firstnames100", "get", "", "" );
echo $formstr;
?>
<div class="titlebox">
<?php echo $text['showtop'];?>&nbsp;
<input type="text" name="topnum" value="<?php echo $topnum; ?>" size="5" maxlength="5" /> <?php echo $text['byoccurrence']; ?>&nbsp;
<input type="submit" value="<?php echo $text['go']; ?>" />
</div>
</form>
<br />

<div class="titlebox">
	<p class="subhead"><strong><?php echo "{$text['top30first']} ({$text['totalnames']}):"; ?></strong></p>
	<p class="smaller"><?php echo $text['showmatchingfirstnames'] . "&nbsp;&nbsp;&nbsp;<a href=\"$firstnames_url" . "tree=$tree\">{$text['mainfirstnamepage']}</a> &nbsp;|&nbsp; <a href=\"$firstnames_all_url" . "tree=$tree\">{$text['showallfirstnames']}</a>"; ?></p>
<?php
	include($cms['tngpath'] . "firstnamestable.php" );
?>
</div>
<br/>
<?php
tng_footer( "" );
?>