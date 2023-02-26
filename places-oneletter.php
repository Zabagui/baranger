<?php
$textpart = "places";
include("tng_begin.php");

$placesearch_url = getURL( "placesearch", 1 );
$places_oneletter_url = getURL( "places-oneletter", 1 );
$heatmap_url = getURL( "heatmap", 1 );

$psearch_org = isset($psearch) ? cleanItLite($psearch) : "";
$psearch = isset($psearch) ? cleanIt(trim($psearch)) : "";
if( !isset($firstchar) ) $firstchar = "";
$decodedfirstchar = $firstchar ? stripslashes(urldecode($firstchar)) : stripslashes($psearch);
$heatargs = $psearch ? "psearch=" : "firstchar=";
$heatargs .= $decodedfirstchar;
$stretchstr = isset($stretch) ? "&amp;stretch=$stretch" : "";
$offsetstr = isset($offset) ? "&amp;offset=$offset" : "";

if($tree && !$tngconfig['places1tree']) {
    $treestr = "tree=$tree&amp;";
    $treestr2 = "tree=$tree";
    $treestr3 = "tree=$tree&amp;";
    $places_all_url = getURL( "places-all", 1 );
    $places_url = getURL( "places", 1 );
    $logstring = "<a href=\"$places_oneletter_url" . "firstchar=$firstchar&amp;psearch=$psearch_org&amp;tree=$tree$offsetstr$stretchstr\">{$text['placelist']}: $decodedfirstchar ({$text['tree']}: $tree)</a>";
	$wherestr = " gedcom = \"$tree\"";
	$wherestr2 = " AND gedcom = \"$tree\"";
}
else {
    $treestr = $treestr2 = $treestr3 = "";
    $places_all_url = getURL( "places-all", 0 );
    $places_url = getURL( "places", 0 );
    $logstring = "<a href=\"$places_oneletter_url" . "firstchar=$firstchar&amp;psearch=$psearch_org$offsetstr$stretchstr\">{$text['placelist']}: $decodedfirstchar</a>";
	$wherestr = $wherestr2 = "";
}

$offsetorg = isset($offset) ? $offset : 0;
$offset = !empty($offset) ? $offset + 1 : 1;
$wherestr_one = $wherestr2;

if( $firstchar ) {
	if( $wherestr ) $wherestr .= " AND ";
	$wherestr .= "trim(substring_index(place,',',-$offset)) LIKE \"" . addslashes($firstchar) . "%\"";
}
if( $psearch ) {
	if( $wherestr ) $wherestr .= " AND ";
	$psearchslashed = addslashes($psearch_org);
	$wherestr .= $offsetorg ? "trim(substring_index(place,',',-$offsetorg)) = \"$psearchslashed\"" : "place LIKE \"%$psearch_org%\"";
}

if( $wherestr ) $wherestr = "WHERE $wherestr";

//if doing a locality search, link directly to placesearch
if( !empty($stretch) ) {
	$query = "SELECT distinct place as myplace, place as wholeplace, count( place ) as placecount, gedcom FROM $places_table $wherestr GROUP BY myplace ORDER by myplace";
	$places_oneletter_url = getURL( "placesearch", 1 );
}
else {
	$query = "SELECT distinct trim(substring_index(place,',',-$offset)) as myplace, trim(place) as wholeplace, count(place) as placecount, gedcom FROM $places_table $wherestr GROUP BY myplace ORDER by myplace";
	$places_oneletter_url = getURL( "places-oneletter", 1 );
}

$presult = tng_query($query);
if( tng_num_rows( $presult ) == 1 ) {
	$row = tng_fetch_assoc( $presult );
	if( $row['myplace'] == $psearch )
        header("Location: $placesearch_url" . "{$treestr3}psearch=$psearch&oper=eq");
	else
		$presult = tng_query($query);
}

writelog($logstring);
preparebookmark($logstring);

$displaychar = $decodedfirstchar ? $decodedfirstchar : $text['all'];
tng_header( $text['placelist'] . ": $displaychar", $flags );
?>

<h1 class="header"><span class="headericon" id="places-hdr-icon"></span><?php echo $text['placelist'] . ": $displaychar"; ?></h1><br class="clearleft"/>
<?php

$hiddenfields[] = array('name' => 'firstchar', 'value' => $firstchar);
$hiddenfields[] = array('name' => 'psearch', 'value' => $psearch);
$hiddenfields[] = array('name' => 'offset', 'value' => $offsetorg);
if(!$tngconfig['places1tree'])
    echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'places-oneletter', 'method' => 'get', 'name' => 'form1', 'id' => 'form1', 'hidden' => $hiddenfields));

$linkstr = "";

$query = "SELECT ucase(left(trim(substring_index(place,',',-$offset)),1)) as firstchar, count(ucase(left(trim(substring_index(place,',',-$offset)),1))) as placecount FROM $places_table WHERE trim(substring_index(place,',',-$offset)) != \"\" $wherestr_one GROUP BY firstchar ORDER by firstchar";
$result = tng_query($query);
if( $result ) {
	$initialchar = 1;
	
	while( $place = tng_fetch_assoc( $result ) ) {
		if( $initialchar != 1 ) { 
			$linkstr .= " ";
		}
		if( $place['firstchar'] != "" ) {
			$urlfirstchar = urlencode($place['firstchar']);
			$countstr = $text['placesstarting'] . ": " . $place['firstchar'] . " (" . number_format($place['placecount']) . " " . $text['totalnames'] . ")";
			$linkstr .= "<a href=\"$places_oneletter_url" . "firstchar=$urlfirstchar&amp;{$treestr}offset=$offsetorg&amp;psearch=$psearch_org\" class=\"snlink\" title=\"$countstr\">{$place['firstchar']}</a> ";
		}
		$initialchar++;
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
	<br /><br /><?php echo "<a href=\"$places_url" . "{$treestr2}\">{$text['mainplacepage']}</a> &nbsp;|&nbsp; <a href=\"$places_all_url" . "{$treestr2}\">{$text['showallplaces']}</a>"; ?>
</form>
</div>
<br/>
<div class="titlebox">
<div>
	<p class="subhead"><b>
<?php 
	echo "{$text['placelist']}: $decodedfirstchar, {$text['sortedalpha']}";
	if(isset($_GET['offset']))
		echo " ({$text['numoccurrences']}):"; 
?>
	</b></p>
	<p class="smaller"><?php echo $text['showmatchingplaces']; ?>  <a href="<?php echo $heatmap_url . $treestr . $heatargs; ?>" class="snlink"><?php echo $text['heatmap']; ?></a></p>
</div>
<table class="sntable normal">
	<tr><td class="plcol">
<?php
$topnum = tng_num_rows($presult);
if( $presult ) {
	$snnum = 1;
	if(!isset($numcols)) $numcols = 3;
	$num_in_col = ceil($topnum / $numcols);
	if( $numcols > 3 ) {
		$numcols = 3;
		$num_in_col = ceil($topnum / 3 );
	}

	$num_in_col_ctr = 0;
	while( $place = tng_fetch_assoc( $presult ) ) {
		$olplace = $place2 = urlencode( $place['myplace'] );
		if( $place2 ) {
			$commaOnEnd = false;
			$poffset = !empty($stretch) ? "" : "offset=$offset&amp;";
			if(substr($place['wholeplace'],0,1) == ',' && trim(substr($place['wholeplace'],1)) == $place['myplace']) {
				$place3 = addslashes($place['wholeplace']);
				$commaOnEnd = true;
				$place2 = urlencode($place['wholeplace']);
				$placetitle = $place['wholeplace'];
			}
			else {
				$place3 = addslashes($place['myplace']);
				$placetitle = $place['myplace'];
			}

			$query = "SELECT count(place) as placecount FROM $places_table WHERE place = \"$place3\" $wherestr2";
			$result2 = tng_query($query);
			$countrow = tng_fetch_assoc($result2);
			$specificcount = $countrow['placecount'];
			tng_free_result($result2);

			$searchlink = $specificcount ? " <a href=\"$placesearch_url" . "{$treestr3}psearch=$place2\" title=\"{$text['findplaces']}\"><img src=\"{$cms['tngpath']}img/tng_search_small.gif\" class=\"placeimg\" border=\"0\" alt=\"{$text['findplaces']}\" width=\"9\" height=\"9\" /></a>" : "";
			if( $place['placecount'] > 1 || ($place['myplace'] != $place['wholeplace'] && !$commaOnEnd) ) {
				$name = "<a href=\"$places_oneletter_url" . $poffset;
				if($tree && !$tngconfig['places1tree']) $name .= "tree={$place['gedcom']}&amp;";
				$name .= "psearch=$olplace\">";

				$name .= $place['myplace'];
				//if($session_charset == "UTF-8")
					//$name .= htmlentities(utf8_decode($place['myplace']),ENT_QUOTES); // this line handles UTF8 issues - R?al Charlebois
                    //$name .= $place['myplace']; // Roger removed R?al's coding here - it works with curly single quote now
				//else
					//$name .= htmlentities($place['myplace'],ENT_QUOTES); // this line is not compatible with UTF8 (htmlentities)
				$name .= "</a>";

				echo "$snnum. $name ({$place['placecount']})$searchlink<br/>\n";
			}
			else
				echo "$snnum. $placetitle$searchlink<br/>\n";
			$snnum++;
			$num_in_col_ctr++;
			if( $num_in_col_ctr == $num_in_col ) {
				echo "</td>\n<td class=\"table-dblgutter\">&nbsp;&nbsp;</td>\n<td class=\"plcol\">";
				$num_in_col_ctr = 0;
			}
		}
	}
	tng_free_result($presult);
}
?>
	</td></tr>
</table>
</div>
<br/>
<?php
tng_footer( "" );
?>
