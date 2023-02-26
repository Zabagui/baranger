<?php
$textpart = "surnames";
include("tng_begin.php");

$search_url = getURL( "search", 1 );
$firstnames_oneletter_url = getURL( "firstnames-oneletter", 1 );
$firstnames_all_url = getURL( "firstnames-all", 1 );
$firstnames_url = getURL( "firstnames", 1 );

$treestr = $tree ? " ({$text['tree']}: $tree)" : "";
$logstring = "<a href=\"$firstnames_url" . "tree=$tree\">" . xmlcharacters($text['firstnamelist'].$treestr) . "</a>";
writelog($logstring);
preparebookmark($logstring);

tng_header( $text['firstnamelist'], $flags );
?>
<link href="css/c3.css" rel="stylesheet">
<script src="js/d3.min.js"></script>
<script src="js/c3.min.js"></script>

<h1 class="header"><span class="headericon" id="surnames-hdr-icon"></span><?php echo $text['firstnamelist']; ?></h1><br class="clearleft" />
<?php
echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'firstnames', 'method' => 'get', 'name' => 'form1', 'id' => 'form1'));
$linkstr = "";
$linkstr2col1 = "";
$linkstr2col2 = "";
$linkstr3col1 = "";
$linkstr3col2 = "";
$collen = $sitever == "mobile" ? 50 : 25;
$cols = $sitever == "mobile" ? 1 : 2;
$grtotal = 50;
$pietotal = 10;
$nofirstname = urlencode($text['nofirstname']);
$top30text = preg_replace("/xxx/",$grtotal,$text['top30first']);

$wherestr = $tree ? "WHERE gedcom = \"$tree\"" : "";
$treestr = $orgtree ? "&amp;tree=$tree" : "";

$allwhere = getLivingPrivateRestrictions($people_table, false, false);

if( $allwhere ) {
	$wherestr .= $wherestr ? " AND $allwhere" : "WHERE $allwhere";}

$query = "SELECT ucase(left(firstname,1)) as firstchar, ucase( left(firstname,1) ) as binfirstchar, count( ucase( left( firstname,1) ) ) as lncount FROM $people_table $wherestr GROUP BY binfirstchar ORDER by binfirstchar";
$result = tng_query($query);
if( $result ) {
	$initialchar = 1;
	
	while( $firstname = tng_fetch_assoc( $result ) ) {
		if( $initialchar != 1 ) { 
			$linkstr .= " ";
		}
		if($session_charset == "UTF-8" && function_exists('mb_substr'))
			$firstchar = mb_substr($firstname['firstchar'],0,1,'UTF-8');
		else
			$firstchar = substr($firstname['firstchar'],0,1);
		$firstchar = strtoupper($firstchar);
		if( $firstchar == "" )
			$linkstr .= "<a href=\"$search_url" . "myfirstname=$nofirstname&amp;fnqualify=equals&amp;mybool=AND$treestr\" class=\"snlink\">" . $text['nofirstname'] . "</a> ";
		else {
			//$urlfirstchar = urlencode($firstname[firstchar]);
			$urlfirstchar = $firstchar;
			//if($charset == "UTF-8") $firstname[firstchar] = utf8_encode($firstname[firstchar]);
			$countstr = $text['firstnamesstarting'] . ": " . $firstchar . " (" . number_format($firstname['lncount']) . " " . $text['totalnames'] . ")";
			$linkstr .= "<a href=\"$firstnames_oneletter_url" . "firstchar=$urlfirstchar$treestr\" class=\"snlink\" title=\"$countstr\">{$firstchar}</a>";
		}
		$initialchar++;
	}
	tng_free_result($result);
}


$wherestr .= $wherestr ? " AND firstname != \"\"" : "WHERE firstname != \"\"";
$query = "SELECT ucase( SUBSTRING_INDEX( firstname, ' ', 1 ) ) as firstname, SUBSTRING_INDEX( firstname, ' ', 1 ) as lowername, count( ucase( SUBSTRING_INDEX( firstname, ' ', 1 ) ) ) as lncount 
	FROM $people_table $wherestr GROUP BY lowername ORDER by lncount DESC, firstname LIMIT $grtotal";
$result = tng_query($query);
$maxcount = 0;
$names = array();
$counts = array();
if( $result ) {
	$count = 1;
	$col = -1;
	while( $firstname = tng_fetch_assoc( $result ) ) {
		$firstname2 = urlencode($firstname['firstname']);
		if(!$maxcount) $maxcount = $firstname['lncount'];
		$tally = $firstname['lncount'];
		$tally_fmt = number_format($tally);
		$names[$count-1] = $firstname['lowername'];
		$counts[$count-1] = $tally;
		$thiswidth = floor($tally / $maxcount * 100);
		if(($count - 1) % $collen == 0)
			$col++;
		//$chartstr = $col ? "" : "<td width=\"400\"><a href=\"$search_url" . "myfirstname=$firstname2&amp;fnqualify=equals&amp;mybool=AND$treestr\" title=\"{$firstname['lowername']} ($tally_fmt)\"><div style=\"width:{$thiswidth}px;\" class=\"bar rightround\"></div></a></td>";
		$chartstr = $col ? "" : "<td class=\"bar-holder\"><div style=\"width:{$thiswidth}%;\" class=\"bar rightround\" title=\"{$firstname['lowername']} ($tally_fmt)\"><a href=\"$search_url" . "myfirstname=$firstname2&amp;fnqualify=startswith&amp;mybool=AND$treestr\"></a></div></td>";
		if(!isset($linkstr2col[$col])) $linkstr2col[$col] = "";
		$linkstr2col[$col] .= "<tr><td class=\"snlink\">$count.</td><td class=\"nw\"><a href=\"$search_url" . "myfirstname=$firstname2&amp;fnqualify=startswith&amp;mybool=AND$treestr\">{$firstname['lowername']}</a> ($tally_fmt)</td>$chartstr</tr>";
		$count++;
	}
	tng_free_result($result);
}
?>

<div class="titlebox normal">
	<p class="subhead"><strong><?php echo $text['firstnamesstarting']; ?></strong></p>
	<p class="firstchars"><?php echo $linkstr; ?></p>
	<br/><?php echo "<a href=\"$firstnames_all_url" . "tree=$tree\">{$text['showallfirstnames']}</a> ({$text['sortedalpha']})"; ?>
</div>

<br />
<div class="titlebox">
<div style="display:inline-block; margin-right:50px">
<table class="table-top30">
	<tr>
		<td colspan="5">
			<p class="subhead"><strong><?php echo "{$top30text} ({$text['totalnames']}):"; ?></strong></p>
		</td>
	</tr>
	<tr>
<?php
	for($i=0;$i<$cols;$i++){
		if($i)
			echo "<td class=\"table-gutter\">&nbsp;</td>\n";
?>
		<td class="aligntop">
			<table class="normal table-histogram">
<?php
	echo $linkstr2col[$i];
?>
			</table>
		</td>
<?php
	}
?>
	</tr>
	<tr>
		<td colspan="5">
<?php
	$formstr = getFORM( "firstnames100", "get", "", "" );
	echo $formstr;
	echo $text['showtop'];

	$top20text = preg_replace("/xxx/",$pietotal,$text['top30first']);
	$justtop = preg_replace("/xxx/",$pietotal,$text['justtop']);
?>
			<input type="text" name="topnum" value="100" size="5" maxlength="5" /> <?php echo $text['byoccurrence']; ?>  <input type="hidden" name="tree" value="<?php echo $tree; ?>" /><input type="submit" value="<?php echo $text['go']; ?>" /></form>
		</td>
	</tr>

</table>
<br/><br/>
</div>
<div id="charts" style="display:inline-block; width:400px; vertical-align:top;text-align:center">
	<p class="subhead"><strong><?php echo "{$top20text}<br/>{$text['amongall']}"; ?></strong></p>
	<div id="whole_chart"></div>
	<br/><br/><p class="subhead"><strong><?php echo $justtop; ?></strong></p>
	<div id="focus_chart"></div>
</div>
<?php
$query = "SELECT count(*) as total_names FROM $people_table $wherestr";
$result = tng_query($query);
$row = tng_fetch_assoc($result);
$total_names = $row['total_names'];
tng_free_result($result);
?>
<script type="text/javascript">
var whole_chart = c3.generate({
    bindto: '#whole_chart',
    data: {
        columns: [
<?php
	$names_total = 0;
	for($i = 0; $i < $pietotal; $i++) {
		$counter = $i + 1;
		echo "['data{$counter}', {$counts[$i]}],\n";
		$names_total += $counts[$i];
	}
	$counter += 1;
	$remaining = $total_names - $names_total;
	echo "['data{$counter}', $remaining]\n";
?>
        ],
        type : 'pie',
        names: {
<?php
	for($i = 0; $i < $pietotal; $i++) {
		$counter = $i + 1;
		$cfmt = number_format($counts[$i]);
		echo "data{$counter}: \"{$names[$i]} ({$cfmt})\",\n";
	}
	$counter += 1;
	echo "data{$counter}: \"{$text['allothers']} (" . number_format($remaining) . ")\"\n";
?>
        },
        colors: {
             data<?php echo $counter; ?>: '#cccccc'
        }
    }
});
var focus_chart = c3.generate({
    bindto: '#focus_chart',
    data: {
        columns: [
<?php
	$names_total = 0;
	for($i = 0; $i < $pietotal; $i++) {
		$counter = $i + 1;
		echo "['data{$counter}', {$counts[$i]}]";
		if($counter < $grtotal) echo ",";
		echo "\n";
	}
?>
        ],
        type : 'pie',
        names: {
<?php
	for($i = 0; $i < $pietotal; $i++) {
		$counter = $i + 1;
		$cfmt = number_format($counts[$i]);
		echo "data{$counter}: \"{$names[$i]} ({$cfmt})\"";
		if($counter < $grtotal) echo ",";
		echo "\n";
	}
?>
        }
    }
});
</script>

</div>
<br />
<?php
tng_footer( "" );
?>