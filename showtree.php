<?php
$textpart = "trees";
include("tng_begin.php");

$showtree_url = getURL( "showtree", 1 );
$statistics_url = getURL( "statistics", 0 );

function showFact( $text, $fact, $numflag = 0 ) {
	echo "<tr>\n";
	echo "<td valign=\"top\" class=\"fieldnameback\" nowrap><span class=\"fieldname\">" . $text . "&nbsp;</span></td>\n";
	echo "<td valign=\"top\" colspan=\"2\" class=\"databack\"";
	echo $numflag ? " align=\"right\"" : "";
	echo ">";
	echo $numflag ? number_format($fact) : $fact;
	echo "&nbsp;</td>\n";
	echo "</tr>\n";
}

$query = "SELECT count(personID) as pcount, $trees_table.gedcom, treename, description, owner, secret, address, email, city, state, zip, country, phone FROM $trees_table LEFT JOIN $people_table on $trees_table.gedcom = $people_table.gedcom WHERE $trees_table.gedcom = \"$tree\" GROUP BY $trees_table.gedcom";
$result = tng_query($query);
$row = tng_fetch_assoc($result);
tng_free_result($result);

writelog( "<a href=\"$showtree_url" . "tree=$tree\">{$text['tree']}: {$row['treename']}</a>" );
preparebookmark( "<a href=\"$showtree_url" . "tree=$tree\">{$text['tree']}: {$row['treename']}</a>" );

tng_header( $text['tree'] . ": " . $row['treename'], $flags );
?>

<h1 class="header"><?php echo $text['tree'] . ": " . $row['treename']; ?></h1><br clear="all" />

	<table border="0" cellspacing="1" cellpadding="4" class="whiteback normal">
<?php
	if( $row['treename'] ) 	showFact( $text['treename'], 		$row['treename'] );
	if( $row['description'] ) showFact( $text['description'], 	$row['description'] );

	showFact( $text['individuals'], $row['pcount'], true );

	$query = "SELECT count(familyID) as fcount FROM $families_table WHERE gedcom = \"{$row['gedcom']}\"";
	$famresult = tng_query($query);
	$famrow = tng_fetch_assoc($famresult);
	tng_free_result($famresult);
	showFact( $text['families'], $famrow['fcount'], true );
	
	$query = "SELECT count(sourceID) as scount FROM $sources_table WHERE gedcom = \"{$row['gedcom']}\"";
	$srcresult = tng_query($query);
	$srcrow = tng_fetch_assoc($srcresult);
	tng_free_result($srcresult);
	showFact( $text['sources'], $srcrow['scount'], true );

	if( !$row['secret'] ) {
		if( $row['owner'] ) showFact( $text['owner'], $row['owner'] );
		if( $row['address'] ) 	showFact( $text['address'], 		$row['address'] );
		if( $row['city'] ) 		showFact( $text['city'], 			$row['city'] );
		if( $row['state'] ) 		showFact( $text['state'], 		$row['state'] );
		if( $row['zip'] ) 		showFact( $text['zip'], 			$row['zip'] );
		if( $row['country'] ) 	showFact( $text['country'], 		$row['country'] );
		if( $row['email'] ) 		showFact( $text['email'], 		"<a href=\"mailto:{$row['email']}\">{$row['email']}</a>" );
		if( $row['phone'] ) 		showFact( $text['phone'], 		$row['phone'] );
	}
?>
	</table>
	<br/>
<?php
	echo "<a href=\"$statistics_url\">{$text['morestats']}</a>\n";
?>
	<br/><br/>

<?php
	tng_footer( "" );
?>