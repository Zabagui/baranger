<?php
$textpart = "surnames";
@set_time_limit(0);
include("tng_begin.php");

$search_url = getURL( "search", 1 );
$surnames_url = getURL( "surnames", 1 );
$surnames_all_url = getURL( "surnames-all", 1 );
$surnames_oneletter_url = getURL( "surnames-oneletter", 1 );

$primaryfirstchar = !empty($firstchar) ? mb_substr($firstchar,0,1,$charset) : "";
$decodedfirstchar = stripslashes(urldecode($primaryfirstchar));
//if($charset == "UTF-8") $decodedfirstchar = utf8_encode($decodedfirstchar);

$treestr = $tree ? " ({$text['tree']}: $tree)" : "";
$logstring = "<a href=\"$surnames_oneletter_url" . "firstchar=$primaryfirstchar&amp;tree=$tree\">" . xmlcharacters($text['surnamelist'] . ": {$text['beginswith']} $decodedfirstchar$treestr") . "</a>";
writelog($logstring);
preparebookmark($logstring);

tng_header( $text['surnamelist'] . ": {$text['beginswith']} $decodedfirstchar", $flags );

$wherestr = $tree ? "WHERE gedcom = \"$tree\"" : "";
$treestr = $orgtree ? "&amp;tree=$tree" : "";

$allwhere = getLivingPrivateRestrictions($people_table, false, false);

if( $allwhere ) {
	$wherestr .= $wherestr ? " AND $allwhere" : "WHERE $allwhere";
}

$linkstr = "";
$nosurname = urlencode($text['nosurname']);
$query = "SELECT ucase(left(lastname,1)) as firstchar, ucase( $binary left(lastname,1) ) as binfirstchar, count( ucase( left( lastname,1) ) ) as lncount FROM $people_table $wherestr GROUP BY binfirstchar ORDER by binfirstchar";
$result = tng_query($query);
if( $result ) {
	$initialchar = 1;
	
	while( $surname = tng_fetch_assoc( $result ) ) {
		if( $initialchar != 1 ) { 
			$linkstr .= " ";
		}
		if($session_charset == "UTF-8" && function_exists('mb_substr'))
			$firstchar = mb_substr($surname['firstchar'],0,1,'UTF-8');
		else
			$firstchar = substr($surname['firstchar'],0,1);
		$firstchar = strtoupper($firstchar);
		if( $firstchar == "" )
			$linkstr .= "<a href=\"$search_url" . "mylastname=$nosurname&amp;lnqualify=equals&amp;mybool=AND$treestr\" class=\"snlink\">" . $text['nosurname'] . "</a> ";
		else {
			//$urlfirstchar = urlencode($surname[firstchar]);
			$urlfirstchar = $firstchar;
			//if($charset == "UTF-8") $surname[firstchar] = utf8_encode($surname[firstchar]);
			$countstr = $text['surnamesstarting'] . ": " . $firstchar . " (" . number_format($surname['lncount']) . " " . $text['totalnames'] . ")";
			$linkstr .= "<a href=\"$surnames_oneletter_url" . "firstchar=$urlfirstchar$treestr\" class=\"snlink\" title=\"$countstr\">{$firstchar}</a>";
		}
		$initialchar++;
	}
	tng_free_result($result);
}
?>

<h1 class="header"><span class="headericon" id="surnames-hdr-icon"></span><?php echo $text['surnamelist'] . ": {$text['beginswith']} $decodedfirstchar"; ?></h1><br class="clearleft"/>
<?php
$hiddenfields[] = array('name' => 'firstchar', 'value' => $primaryfirstchar);
echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'surnames-oneletter', 'method' => 'get', 'name' => 'form1', 'id' => 'form1', 'hidden' => $hiddenfields));
?>

<div class="titlebox normal">
	<p class="subhead"><strong><?php echo $text['surnamesstarting']; ?></strong></p>
	<p class="firstchars"><?php echo $linkstr; ?></p>
	<br/><?php echo "<a href=\"$surnames_all_url" . "tree=$tree\">{$text['showallsurnames']}</a> ({$text['sortedalpha']}) &nbsp; | &nbsp; <a href=\"$surnames_url" . "tree=$tree\">{$text['mainsurnamepage']}</a>"; ?>
</div>

<br />
<div class="titlebox">
<div>
	<p class="subhead"><b><?php echo "{$text['allbeginningwith']} $decodedfirstchar, {$text['sortedalpha']} ({$text['totalnames']}):"; ?></b></p>
</div>
<table class="sntable normal">
	<tr><td class="sncol">
<?php
$wherestr = $tree ? "AND gedcom = \"$tree\"" : "";

$surnamestr = $lnprefixes ? "TRIM(CONCAT_WS(' ',lnprefix,lastname) )" : "lastname";
if($tngconfig['ucsurnames'])
	$surnamestr = "ucase($surnamestr)";
$primaryfirstchar = $primaryfirstchar == "\"" ? "\\\"" : $primaryfirstchar;
$query = "SELECT ucase( $binary $surnamestr ) as lastname, $surnamestr as lowername, ucase($binary lastname) as binlast, count( ucase($binary lastname) ) as lncount FROM $people_table WHERE ucase($binary TRIM(lastname)) LIKE \"$primaryfirstchar%\" $wherestr GROUP BY lowername ORDER by binlast";
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
	while( $surname = tng_fetch_assoc( $result ) ) {
		$surname2 = urlencode( $surname['lastname'] );
		$name = $surname['lastname'] ? "<a href=\"$search_url" . "mylastname=$surname2&amp;lnqualify=equals&amp;mybool=AND$treestr\">{$surname['lowername']}</a>" : $text['nosurname'];
		echo "$snnum. $name ({$surname['lncount']})<br/>\n";
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