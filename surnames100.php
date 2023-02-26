<?php
$textpart = "surnames";
include("tng_begin.php");

$topnum = !empty($topnum) ? preg_replace("/[^0-9]/", '', $topnum) : 100;

$surnames_all_url = getURL( "surnames-all", 1 );
$surnames_url = getURL( "surnames", 1 );
$surnames100_url = getURL( "surnames100", 1 );
$text['top30'] = preg_replace("/xxx/",$topnum,$text['top30']);

$treestr = $tree ? " ({$text['tree']}: $tree)" : "";
$logstring = "<a href=\"$surnames100_url" . "topnum=$topnum&amp;tree=$tree\">" . xmlcharacters($text['surnamelist'] . ": {$text['top']} $topnum$treestr") . "</a>";
writelog($logstring);
preparebookmark($logstring);

tng_header( $text['surnamelist'] . ": {$text['top30']}", $flags );
?>

<h1 class="header"><span class="headericon" id="surnames-hdr-icon"></span><?php echo $text['surnamelist'] . ": {$text['top30']}"; ?></h1><br class="clearleft"/>
<?php
echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'surnames100', 'method' => 'get', 'name' => 'form1', 'id' => 'form1'));

$formstr = getFORM( "surnames100", "get", "", "" );
echo $formstr;
?>
<div class="titlebox">
<?php echo $text['showtop'];?>&nbsp;
<input type="text" name="topnum" value="<?php echo $topnum; ?>" size="4" maxlength="4" /> <?php echo $text['byoccurrence']; ?>&nbsp;
<input type="hidden" name="tree" value="<?php echo $tree; ?>" />
<input type="submit" value="<?php echo $text['go']; ?>" />
</div>
</form>
<br />

<div class="titlebox">
	<p class="subhead"><strong><?php echo "{$text['top30']} ({$text['totalnames']}):"; ?></strong></p>
	<p class="smaller"><?php echo $text['showmatchingsurnames'] . "&nbsp;&nbsp;&nbsp;<a href=\"$surnames_url" . "tree=$tree\">{$text['mainsurnamepage']}</a> &nbsp;|&nbsp; <a href=\"$surnames_all_url" . "tree=$tree\">{$text['showallsurnames']}</a>"; ?></p>
<?php
	include($cms['tngpath'] . "surnamestable.php" );
?>
</div>
<br/>
<?php
tng_footer( "" );
?>