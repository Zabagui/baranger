<?php
$search_url = getURL( "search", 1 );
?>
	<table class="sntable">
		<tr><td class="sncol">
<?php
$wherestr = $tree ? "WHERE gedcom = \"$tree\"" : "";
$treestr = $orgtree ? "&amp;tree=$tree" : "";

$more = getLivingPrivateRestrictions($people_table, false, false);
if($more) {
	$wherestr .= $wherestr ? " AND " . $more : "WHERE $more";
}

$topnum = $topnum ? $topnum : 100;
$wherestr .= $wherestr ? " AND firstname != \"\"" : "WHERE firstname != \"\"";
$query = "SELECT ucase( SUBSTRING_INDEX( firstname, ' ', 1 ) ) as firstname, SUBSTRING_INDEX( firstname, ' ', 1 ) as lowername, count( ucase( SUBSTRING_INDEX( firstname, ' ', 1 ) ) ) as lncount 
	FROM $people_table $wherestr GROUP BY lowername ORDER by lncount DESC, firstname LIMIT $topnum";

$result = tng_query($query);
$topnum = tng_num_rows($result);
if( $result ) {
	$counter = 1;
	if($sitever == "mobile")
		$numcols = 2;
	elseif(!isset($numcols) || $numcols > 5)
		$numcols = 5;
	$num_in_col = ceil($topnum / $numcols);

	$num_in_col_ctr = 0;
	$nofirstname = urlencode($text['nofirstname']);
	while( $firstname = tng_fetch_assoc( $result ) ) {
		$firstname2 = urlencode( $firstname['firstname'] );
		$name = $firstname['firstname'] ? "<a href=\"$search_url" . "myfirstname=$firstname2&amp;fnqualify=equals&amp;mybool=AND$treestr\">{$firstname['lowername']}</a>" : "<a href=\"$search_url" . "myfirstname=$nofirstname&amp;fnqualify=equals&amp;mybool=AND$treestr\">{$text['nofirstname']}</a>";
		echo "$counter. $name ({$firstname['lncount']})<br/>\n";
		$counter++;
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