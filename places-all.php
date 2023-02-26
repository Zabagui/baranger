<?php
$textpart = "places";
include("tng_begin.php");

$placesearch_url = getURL( "placesearch", 1 );
$places_oneletter_url = getURL( "places-oneletter", 1 );

if($tree && !$tngconfig['places1tree']) {
    $treestr = "tree=$tree&amp;";
    $treestr2 = "tree=$tree";
    $treestr3 = "tree=$tree&amp;";
    $places_all_url = getURL( "places-all", 1 );
    $places_url = getURL( "places", 1 );
	$heatmap_url = getURL( "heatmap", 1 );
    $logstring = "<a href=\"$places_all_url" . "$treestr2\">{$text['allplaces']} ({$text['tree']}: $tree)</a>";
	$wherestr = "WHERE gedcom = \"$tree\"";
	$wherestr2 = "AND gedcom = \"$tree\"";
}
else {
    $treestr = $treestr2 = $treestr3 = "";
    $places_all_url = getURL( "places-all", 0 );
    $places_url = getURL( "places", 0 );
	$heatmap_url = getURL( "heatmap", 0 );
    $logstring = "<a href=\"$places_all_url\">{$text['allplaces']}</a>";
	$wherestr = "";
	$wherestr2 = "";
}
writelog($logstring);
preparebookmark($logstring);

tng_header( $text['placelist'] . ": " . $text['allplaces'], $flags );
?>
<a id="top"></a>
<h1 class="header"><span class="headericon" id="places-hdr-icon"></span><?php echo $text['placelist'] . ": " . $text['allplaces']; ?></h1><br class="clearleft"/>
<?php
if(!$tngconfig['places1tree'])
    echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'places-all', 'method' => 'get', 'name' => 'form1', 'id' => 'form1'));

$offset = 1;
	
$linkstr = "";
$query = "SELECT distinct ucase(left(trim(substring_index(place,',',-$offset)),1)) as firstchar FROM $places_table $wherestr GROUP BY firstchar ORDER by firstchar";
$result = tng_query($query);
if( $result ) {
	$initialchar = 1;
	
	while( $place = tng_fetch_assoc( $result ) ) {
		if( $initialchar != 1 ) {
			$linkstr .= " ";
		}
		if( $place['firstchar'] != "" && $place['firstchar'] != "_" ) {
			$linkstr .= "<a href=\"#char$initialchar\" class=\"snlink\">{$place['firstchar']}</a> ";
			$firstchars[$initialchar] = $place['firstchar'];
			$initialchar++;
		}
	}
	tng_free_result($result);
}
?>

<div class="titlebox normal">
	<p class="subhead"><strong><?php echo $text['placesstarting']; ?></strong></p>
	<p class="firstchars"><?php echo $linkstr; ?></p>

<?php
$formstr = getFORM( "places-oneletter", "get", "", "" );
echo $formstr;
?>
<?php
echo "{$text['placescont']}: <input type=\"text\" name=\"psearch\" />\n";
if($tree && !$tngconfig['places1tree'])
    echo "<input type=\"hidden\" name=\"tree\" value=\"$tree\" />\n";
echo "<input type=\"hidden\" name=\"stretch\" value=\"1\" />\n";
echo "<input type=\"submit\" name=\"pgo\" value=\"{$text['go']}\" />\n";
?>
</form>

	<br /><?php echo "<a href=\"$places_url" . "$treestr2\">{$text['mainplacepage']}</a> &nbsp;|&nbsp; <a href=\"$heatmap_url{$treestr2}\">{$text['heatmap']}</a>"; ?>
</div>
<br />

<p class="smaller"><?php echo $text['showmatchingplaces']; ?></p>
<?php
for( $scount = 1; $scount < $initialchar; $scount++ ) {
?>
<div class="titlebox">
<?php
	$urlfirstchar = addslashes($firstchars[$scount]);
	if( $urlfirstchar ) {
		echo "<p class=\"header\"><a id=\"char$scount\"><strong>{$firstchars[$scount]}</strong></a></p>\n";
?>
<table class="sntable">
	<tr><td class="plcol">
<?php
		$query = "SELECT trim(substring_index(place,',',-$offset)) as myplace, count(place) as placecount, gedcom FROM $places_table WHERE trim(substring_index(place,',',-$offset)) LIKE \"$urlfirstchar%\" $wherestr2 GROUP BY myplace ORDER by myplace";
		$result = tng_query($query);
		$topnum = tng_num_rows($result);
		if( $result ) {
			$snnum = 1;
			if(!isset($numcols)) $numcols = 3;
			$num_in_col = ceil($topnum / $numcols);
			if( $numcols > 3 ) {
				$numcols = 3;
				$num_in_col = ceil($topnum / 3 );
			}

			$num_in_col_ctr = 0;
			while( $place = tng_fetch_assoc( $result ) ) {
				$place2 = urlencode( $place['myplace'] );
				$commaOnEnd = false;
				$poffset = !empty($stretch) ? "" : "offset=$offset&amp;";

				$place3 = addslashes($place['myplace']);
				$placetitle = $place['myplace'];

				$query = "SELECT count(place) as placecount FROM $places_table WHERE place = \"$place3\" $wherestr2";
				$result2 = tng_query($query);
				$countrow = tng_fetch_assoc($result2);
				$specificcount = $countrow['placecount'];
				tng_free_result($result2);

				$searchlink = $specificcount ? " <a href=\"$placesearch_url" . "{$treestr3}psearch=$place2\" title=\"{$text['findplaces']}\"><img src=\"{$cms['tngpath']}img/tng_search_small.gif\" class=\"placeimg\" border=\"0\" alt=\"{$text['findplaces']}\" width=\"9\" height=\"9\" /></a>" : "";
				if( $place['placecount'] > 1 || !$commaOnEnd ) {
					$name = "<a href=\"$places_oneletter_url" . $poffset;
					if($tree && !$tngconfig['places1tree']) $name .= "tree={$place['gedcom']}&amp;";
					$name .= "psearch=$place2\">" . str_replace(array("<",">"), array("&lt;","&gt;"), $place['myplace']) . "</a>";
					echo "$snnum. $name ({$place['placecount']})$searchlink<br />\n";
				}
				else
					echo "$snnum. $placetitle$searchlink<br />\n";
				$snnum++;
				$num_in_col_ctr++;
				if( $num_in_col_ctr == $num_in_col ) {
					echo "</td>\n<td>&nbsp;&nbsp;</td>\n<td class=\"plcol\">";
					$num_in_col_ctr = 0;
				}
			}
			tng_free_result($result);
		}
?>
	</td></tr>
</table>
</div>

<br /><p class="normal"><a href="#top"><?php echo $text['backtotop']; ?></a></p><br />
<?php
	}
}

tng_footer( "" );
?>