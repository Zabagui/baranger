<?php
$textpart = "places";
include("tng_begin.php");

$topnum = isset($topnum) ? preg_replace("/[^0-9]/", '', $topnum) : "";

$placesearch_url = getURL( "placesearch", 1 );
$places_oneletter_url = getURL( "places-oneletter", 1 );
$places100_url = getURL( "places100", 1 );

if($tree && !$tngconfig['places1tree']) {
    $treestr = "tree=$tree&amp;";
    $treestr2 = "tree=$tree";
    $places_all_url = getURL( "places-all", 1 );
    $places_url = getURL( "places", 1 );
    $logstring = "<a href=\"$places100_url" . "topnum=$topnum&amp;tree=$tree\">" . xmlcharacters($text['placelist'] . ": {$text['top']} $topnum ({$text['tree']}: $tree)") . "</a>";
	$wherestr = " AND gedcom = \"$tree\"";
}
else {
    $treestr = $treestr2 = "";
    $places_all_url = getURL( "places-all", 0 );
    $places_url = getURL( "places", 0 );
    $logstring = "<a href=\"$places100_url" . "topnum=$topnum\">" . xmlcharacters($text['placelist'] . ": {$text['top']} $topnum") . "</a>";
	$wherestr = "";
}

writelog($logstring);
preparebookmark($logstring);

tng_header( $text['placelist'] . ": {$text['top']} $topnum", $flags );
?>

<h1 class="header"><span class="headericon" id="places-hdr-icon"></span><?php echo $text['placelist'] . ": {$text['top']} $topnum"; ?></h1><br class="clearleft"/>
<?php
if($tree && !$tngconfig['places1tree'])
    echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'places100', 'method' => 'get', 'name' => 'form1', 'id' => 'form1'));

echo getFORM( "places100", "get", "", "" );
?>
<div class="titlebox">
<?php echo $text['showtop'];?>&nbsp;
<input type="text" name="topnum" value="<?php echo $topnum; ?>" size="4" maxlength="4" /> <?php echo $text['byoccurrence']; ?>&nbsp;
<input type="submit" value="<?php echo $text['go']; ?>" />
</div>
</form>
<br />

<?php
echo getFORM( "places-oneletter", "get", "", "" );
?>
<div class="titlebox">
<?php
echo "{$text['placescont']}: <input type=\"text\" name=\"psearch\" />\n";
if($tree && !$tngconfig['places1tree'])
    echo "<input type=\"hidden\" name=\"tree\" value=\"$tree\" />\n";
echo "<input type=\"hidden\" name=\"stretch\" value=\"1\" />\n";
echo "<input type=\"submit\" name=\"pgo\" value=\"{$text['go']}\" />\n";
if( empty($decodedfirstchar) ) $decodedfirstchar = $text['top'] . " $topnum";
?>
	<br /><br /><?php echo "<a href=\"$places_url" . "{$treestr}\">{$text['mainplacepage']}</a> &nbsp;|&nbsp; <a href=\"$places_all_url" . "{$treestr2}\">{$text['showallplaces']}</a>"; ?>
</div>
</form>

<br />
<div class="titlebox">
<div>
	<p class="subhead"><b><?php echo "{$text['placelist']}: $decodedfirstchar, {$text['sortedalpha']} ({$text['numoccurrences']}):"; ?></b></p>
	<p class="smaller"><?php echo $text['showmatchingplaces']; ?></p>
</div>
<table class="sntable">
	<tr><td class="plcol">
<?php
if( !empty($psearch) )
	$wherestr .= " AND trim(substring_index(place,',',-$offset)) = \"$psearch\"";
	
$offset = !empty($offset) ? $offset + 1 : 1;
$offsetplus = $offset + 1;

$topnum = $topnum ? $topnum : 100;
$query = "SELECT distinct trim(substring_index(place,',',-$offset)) as myplace, count(place) as placecount FROM $places_table WHERE trim(substring_index(place,',',-$offset)) != \"\" $wherestr GROUP BY myplace ORDER by placecount DESC, myplace LIMIT $topnum";

$result = tng_query($query);
$topnum = tng_num_rows($result);
if( $result ) {
	$counter = 1;
	if(!isset($numcols)) $numcols = 3;
	$num_in_col = ceil($topnum / $numcols);
	if( $numcols > 3 ) {
		$numcols = 3;
		$num_in_col = ceil($topnum / 3 );
	}

	$num_in_col_ctr = 0;
	while( $place = tng_fetch_assoc( $result ) ) {
		$place2 = urlencode( $place['myplace'] );

		$query = "SELECT count(place) as placecount FROM $places_table WHERE place = \"" . addslashes($place['myplace']) . "\" $wherestr";
		$result2 = tng_query($query);
		$countrow = tng_fetch_assoc($result2);
		$specificcount = $countrow['placecount'];
		tng_free_result($result2);

		$searchlink = $specificcount ? " <a href=\"$placesearch_url" . "{$treestr}psearch=$place2\"><img src=\"{$cms['tngpath']}img/tng_search_small.gif\" class=\"placeimg\" border=\"0\" alt=\"\" width=\"9\" height=\"9\" /></a>" : "";
		if( $place['placecount'] > 1 || !$specificcount) {
			$name = "<a href=\"$places_oneletter_url" . "offset=$offset&amp;{$treestr}psearch=$place2\">{$place['myplace']}</a>";
			echo "$counter. $name ({$place['placecount']}) $searchlink<br/>\n";
		}
		else
			echo "$counter. {$place['myplace']} $searchlink<br/>\n";
		$counter++;
		$num_in_col_ctr++;
		if( $num_in_col_ctr == $num_in_col ) {
			echo "</td>\n<td>&nbsp;&nbsp;</td>\n<td valign=\"top\">";
			$num_in_col_ctr = 0;
		}
	}
	tng_free_result($result);
}
?>
	</td></tr>
</table>
</div>

<br />
<?php
tng_footer( "" );
?>