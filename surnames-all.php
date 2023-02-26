<?php
$textpart = "surnames";
@set_time_limit(0);
include("tng_begin.php");

$search_url = getURL( "search", 1 );
$surnames_noargs_url = getURL( "surnames", 0 );
$surnames_all_url = getURL( "surnames-all", 1 );

$treestr = $tree ? " ({$text['tree']}: $tree)" : "";
$logstring = "<a href=\"$surnames_all_url" . "tree=$tree\">{$text['surnamelist']}: {$text['allsurnames']}$treestr</a>";
writelog($logstring);
preparebookmark($logstring);

tng_header( "{$text['surnamelist']} - {$text['allsurnames']}", $flags );
?>
<a id="top"></a>
<h1 class="header"><span class="headericon" id="surnames-hdr-icon"></span><?php echo $text['surnamelist']; ?></h1><br class="clearleft"/>
<?php
echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'surnames-all', 'method' => 'get', 'name' => 'form1', 'id' => 'form1'));

if( $tree ) {
	$wherestr = "WHERE gedcom = \"$tree\"";
	$wherestr2 = "AND gedcom = \"$tree\"";
}
else {
	$wherestr = "";
	$wherestr2 = "";
}
$treestr = $orgtree ? "&amp;tree=$tree" : "";

$allwhere = getLivingPrivateRestrictions($people_table, false, false);

if( $allwhere ) {
	$wherestr .= $wherestr ? " AND $allwhere" : "WHERE $allwhere";
	$wherestr2 .= " AND $allwhere";
}

$linkstr = "";
$nosurname = urlencode($text['nosurname']);
$query = "SELECT ucase(left(lastname,1)) as firstchar, ucase( $binary left(lastname,1) ) as binfirstchar FROM $people_table $wherestr GROUP BY binfirstchar ORDER by binfirstchar";
$result = tng_query($query);
if( $result ) {
	$initialchar = 1;

	while( $surname = tng_fetch_assoc( $result ) ) {
		if( $initialchar != 1 ) {
			$linkstr .= " ";
		}
		if( $surname['firstchar'] == "" ) {
			$surname['firstchar'] = $text['nosurname'];
			$linkstr .= "<a href=\"$search_url" . "mylastname=$nosurname&amp;lnqualify=equals&amp;mybool=AND$treestr\" class=\"snlink\">{$text['nosurname']}</a> ";
		}
		else if($surname['firstchar'] != "_") {
			$linkstr .= "<a href=\"#char$initialchar\" class=\"snlink\">{$surname['firstchar']}</a>";
			$firstchars[$initialchar] = $surname['firstchar'];
			$initialchar++;
		}
	}
	tng_free_result($result);
}
?>

<div class="titlebox normal">
	<p class="subhead"><strong><?php echo $text['surnamesstarting']; ?></strong></p>
	<p class="firstchars"><?php echo $linkstr; ?></p>
	<br/><?php echo "<a href=\"$surnames_noargs_url\">{$text['mainsurnamepage']}</a>"; ?>
</div>

<br/>
<?php
for( $scount = 1; $scount < $initialchar; $scount++ ) {
	echo "<a id=\"char$scount\"></a>\n";
	$urlfirstchar = addslashes($firstchars[$scount]);
?>
<div class="titlebox">
<p class="header"><strong><?php echo $firstchars[$scount]; ?></strong></p>
<table class="sntable">
	<tr><td class="sncol">
<?php
$surnamestr = $lnprefixes ? "TRIM(CONCAT_WS(' ',lnprefix,lastname) )" : "lastname";
if($tngconfig['ucsurnames'])
	$surnamestr = "ucase($surnamestr)";
$query = "SELECT ucase( $binary $surnamestr ) as lastname, $surnamestr as lowername, ucase($binary lastname) as binlast, count( ucase($binary lastname) ) as lncount FROM $people_table WHERE ucase($binary TRIM(lastname)) LIKE \"$urlfirstchar%\" $wherestr2 GROUP BY lowername ORDER by binlast";
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
		$name = $surname['lastname'] ? "<a href=\"$search_url" . "mylastname=$surname2&amp;lnqualify=equals&amp;mybool=AND$treestr\">{$surname['lowername']}</a>" : "<a href=\"search.php?mylastname=$nosurname&amp;lnqualify=equals&amp;mybool=AND$treestr\">{$text['nosurname']}</a>";
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

<br/><p class="normal"><a href="#top"><?php echo $text['backtotop']; ?></a></p><br/>
<?php
}
tng_footer( "" );
?>