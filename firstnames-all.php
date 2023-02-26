<?php
$textpart = "surnames";
@set_time_limit(0);
include("tng_begin.php");

$search_url = getURL( "search", 1 );
$firstnames_noargs_url = getURL( "firstnames", 0 );
$firstnames_all_url = getURL( "firstnames-all", 1 );

$treestr = $tree ? " ({$text['tree']}: $tree)" : "";
$logstring = "<a href=\"$firstnames_all_url" . "tree=$tree\">{$text['firstnamelist']}: {$text['allfirstnames']}$treestr</a>";
writelog($logstring);
preparebookmark($logstring);

tng_header( "{$text['firstnamelist']} - {$text['allfirstnames']}", $flags );
?>
<a id="top"></a>
<h1 class="header"><span class="headericon" id="surnames-hdr-icon"></span><?php echo $text['firstnamelist']; ?></h1><br class="clearleft"/>
<?php
echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'firstnames-all', 'method' => 'get', 'name' => 'form1', 'id' => 'form1'));

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
$nofirstname = urlencode($text['nofirstname']);
$query = "SELECT ucase(left(firstname,1)) as firstchar, ucase( $binary left(firstname,1) ) as binfirstchar FROM $people_table $wherestr GROUP BY binfirstchar ORDER by binfirstchar";
$result = tng_query($query);
if( $result ) {
	$initialchar = 1;

	while( $firstname = tng_fetch_assoc( $result ) ) {
		if( $initialchar != 1 ) {
			$linkstr .= " ";
		}
		if( $firstname['firstchar'] == "" ) {
			$firstname['firstchar'] = $text['nofirstname'];
			$linkstr .= "<a href=\"$search_url" . "myfirstname=$nofirstname&amp;fnqualify=equals&amp;mybool=AND$treestr\" class=\"snlink\">{$text['nofirstname']}</a> ";
		}
		else if($firstname['firstchar'] != "_") {
			$linkstr .= "<a href=\"#char$initialchar\" class=\"snlink\">{$firstname['firstchar']}</a>";
			$firstchars[$initialchar] = $firstname['firstchar'];
			$initialchar++;
		}
	}
	tng_free_result($result);
}
?>

<div class="titlebox normal">
	<p class="subhead"><strong><?php echo $text['firstnamesstarting']; ?></strong></p>
	<p class="firstchars"><?php echo $linkstr; ?></p>
	<br/><?php echo "<a href=\"$firstnames_noargs_url\">{$text['mainfirstnamepage']}</a>"; ?>
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
$query = "SELECT ucase( SUBSTRING_INDEX( firstname, ' ', 1 ) ) as firstname, SUBSTRING_INDEX( firstname, ' ', 1 ) as lowername, ucase($binary firstname) as binlast, count( ucase($binary firstname) ) as lncount FROM $people_table WHERE ucase($binary TRIM(firstname)) LIKE \"$urlfirstchar%\" $wherestr2 GROUP BY lowername ORDER by binlast";
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
		$name = $firstname['firstname'] ? "<a href=\"$search_url" . "myfirstname=$firstname2&amp;fnqualify=equals&amp;mybool=AND$treestr\">{$firstname['lowername']}</a>" : "<a href=\"search.php?myfirstname=$nofirstname&amp;fnqualify=equals&amp;mybool=AND$treestr\">{$text['nofirstname']}</a>";
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

<br/><p class="normal"><a href="#top"><?php echo $text['backtotop']; ?></a></p><br/>
<?php
}
tng_footer( "" );
?>