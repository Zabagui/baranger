<?php
$textpart = "surnames";
@set_time_limit(0);
include("tng_begin.php");

$search_url = getURL( "search", 1 );
$firstnames_url = getURL( "firstnames", 1 );
$firstnames_all_url = getURL( "firstnames-all", 1 );
$firstnames_oneletter_url = getURL( "firstnames-oneletter", 1 );

$primaryfirstchar = !empty($firstchar) ? mb_substr($firstchar,0,1,$charset) : "";
$decodedfirstchar = stripslashes(urldecode($primaryfirstchar));
//if($charset == "UTF-8") $decodedfirstchar = utf8_encode($decodedfirstchar);

$treestr = $tree ? " ({$text['tree']}: $tree)" : "";
$logstring = "<a href=\"$firstnames_oneletter_url" . "firstchar=$primaryfirstchar&amp;tree=$tree\">" . xmlcharacters($text['firstnamelist'] . ": {$text['beginswith']} $decodedfirstchar$treestr") . "</a>";
writelog($logstring);
preparebookmark($logstring);

tng_header( $text['firstnamelist'] . ": {$text['beginswith']} $decodedfirstchar", $flags );
$wherestr = $tree ? "WHERE gedcom = \"$tree\"" : "";
$treestr = $orgtree ? "&amp;tree=$tree" : "";

$allwhere = getLivingPrivateRestrictions($people_table, false, false);

if( $allwhere ) {
	$wherestr .= $wherestr ? " AND $allwhere" : "WHERE $allwhere";
	$wherestr2 .= " AND $allwhere";
}

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
?>

<h1 class="header"><span class="headericon" id="surnames-hdr-icon"></span><?php echo $text['firstnamelist'] . ": {$text['beginswith']} $decodedfirstchar"; ?></h1><br class="clearleft"/>
<?php
$hiddenfields[] = array('name' => 'firstchar', 'value' => $primaryfirstchar);
echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'firstnames-oneletter', 'method' => 'get', 'name' => 'form1', 'id' => 'form1', 'hidden' => $hiddenfields));
?>

<div class="titlebox normal">
	<p class="subhead"><strong><?php echo $text['firstnamesstarting']; ?></strong></p>
	<p class="firstchars"><?php echo $linkstr; ?></p>
	<br/><?php echo "<a href=\"$firstnames_all_url" . "tree=$tree\">{$text['showallfirstnames']}</a> ({$text['sortedalpha']}) &nbsp; | &nbsp; <a href=\"$firstnames_url" . "tree=$tree\">{$text['mainfirstnamepage']}</a>"; ?>
</div>

<br />
<div class="titlebox">
<div>
	<p class="subhead"><b><?php echo "{$text['allfirstbegwith']} $decodedfirstchar, {$text['sortedalpha']} ({$text['totalnames']}):"; ?></b></p>
</div>
<table class="sntable normal">
	<tr><td class="sncol">
<?php
$wherestr = $tree ? "AND gedcom = \"$tree\"" : "";
$treestr = $orgtree ? "&amp;tree=$tree" : "";

$more = getLivingPrivateRestrictions($people_table, false, false);
if($more) {
	$wherestr .= " AND " . $more;
}

$primaryfirstchar = $primaryfirstchar == "\"" ? "\\\"" : $primaryfirstchar;
$query = "SELECT ucase( SUBSTRING_INDEX( firstname, ' ', 1 ) ) as firstname, SUBSTRING_INDEX( firstname, ' ', 1 ) as lowername, ucase($binary firstname) as binlast, count( ucase($binary firstname) ) as lncount FROM $people_table WHERE ucase($binary TRIM(firstname)) LIKE \"$primaryfirstchar%\" $wherestr GROUP BY lowername ORDER by binlast";
$result = tng_query($query);
$topnum = tng_num_rows($result);
if( $result ) {
	$snnum = 1;
	if($sitever == "mobile")
		$numcols = 2;
	elseif(!isset($numcols) || $numcols > 5)
		$numcols = 5;
	$num_in_col = ceil($topnum / $numcols);

	$num_in_col_ctr = 0;
	while( $firstname = tng_fetch_assoc( $result ) ) {
		$firstname2 = urlencode( $firstname['firstname'] );
		$name = $firstname['firstname'] ? "<a href=\"$search_url" . "myfirstname=$firstname2&amp;fnqualify=equals&amp;mybool=AND$treestr\">{$firstname['lowername']}</a>" : $text['nofirstname'];
		echo "$snnum. $name ({$firstname['lncount']})<br/>\n";
		$snnum++;
		$num_in_col_ctr++;
		if( $num_in_col_ctr == $num_in_col ) {
			echo "</td>\n<td class=\"table-dblgutter\">&nbsp;&nbsp;</td>\n<td class=\"sncol\">";
			$num_in_col_ctr = 0;
		}
	}
	tng_free_result($result);
}
?>
	</td></tr>
</table>
</div>
<br/>
<?php
tng_footer( "" );
?>