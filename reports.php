<?php
$textpart = "reports";
include("tng_begin.php");

$showreport_url = getURL( "showreport", 1 );
$reports_url = getURL( "reports", 0 );

$query = "SELECT reportname, reportdesc, reportID FROM $reports_table WHERE active = 1 ORDER BY ranking, reportname";
$result = tng_query($query);
$numrows = tng_num_rows( $result );

$logstring = "<a href=\"$reports_url\">" . xmlcharacters($text['reports']) . "</a>";
writelog($logstring);
preparebookmark($logstring);

tng_header( $text['reports'], $flags );
?>

<h1 class="header"><span class="headericon" id="reports-hdr-icon"></span><?php echo $text['reports']; ?></h1><br clear="left"/>
<?php
if ( !$numrows ) {
	echo $text['noreports'];
}
else {
$header = "";
$headerr = $enableminimap ? " data-tablesaw-minimap" : "";
$headerr .= $enablemodeswitch ? " data-tablesaw-mode-switch" : "";

if($sitever != "standard") {
	if($tabletype == "toggle") $tabletype = "columntoggle";
	$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" width=\"100%\" class=\"tablesaw thfixed whiteback normal\" data-tablesaw-mode=\"$tabletype\"{$headerr}>\n";
} else {
	$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" class=\"thfixed whiteback normal\">";
}
echo $header;
?>
	<thead>
		<tr>
		<th data-tablesaw-priority="persist" class="fieldnameback nbrcol fieldname">&nbsp;#&nbsp;</th>
		<th data-tablesaw-priority="1" class="fieldnameback fieldname">&nbsp;<strong><?php echo $text['reportname']; ?></strong>&nbsp;</th>
		<th data-tablesaw-priority="2" class="fieldnameback fieldname">&nbsp;<?php echo $text['description']; ?>&nbsp;</th>
		</tr>
	</thead>
<?php
$count = 1;
while( $row = tng_fetch_assoc($result)) {
	echo "<tr><td class=\"databack\"><span class=\"normal\">$count.</span></td><td class=\"databack\"><span class=\"normal\">&nbsp;<a href=\"$showreport_url" . "reportID={$row['reportID']}\">{$row['reportname']}</a>&nbsp;</span></td><td class=\"databack\"><span class=\"normal\">{$row['reportdesc']}&nbsp;</span></td></tr>\n";
	$count++;
}
tng_free_result($result);
?>
</table>
<br />

<?php 
}

tng_footer( "" );
?>