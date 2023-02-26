<?php
include("begin.php");
include("adminlib.php");
$textpart = "sources";
//include("getlang.php");
include("$mylanguage/admintext.php");

include($cms['tngpath'] . "checklogin.php");

if($session_charset != "UTF-8") {
	$mytitle = tng_utf8_decode($mytitle);
}

$query = "SELECT sourceID, title FROM $sources_table WHERE gedcom = \"$tree\" AND title LIKE \"%$mytitle%\" ORDER BY title LIMIT 250";
$result = tng_query($query);

header("Content-type:text/html; charset=" . $session_charset);
?>

<div class="databack ajaxwindow" id="findrepodiv">
<table border="0" cellpadding="0">
<tr>
	<td valign="top">
		<span class="subhead"><strong><?php echo $admtext['searchresults']; ?></strong></span><br/>
		<span class="normal">(<?php echo $admtext['clicktoselect']; ?>)</span><br/>
	</td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td>
		<form action=""><input type="button" value="<?php echo $admtext['find']; ?>" onClick="reopenFindSourceForm();"></form>
	</td>
</tr>
</table><br/>
<table border="0" cellspacing="1" cellpadding="3">
	<tr>
		<td class="fieldnameback"><span class="fieldname">&nbsp;<b><?php echo $admtext['sourceid']; ?></b>&nbsp;</span></td>
		<td class="fieldnameback"><span class="fieldname">&nbsp;<b><?php echo $admtext['name']; ?></b>&nbsp;</span></td>
	</tr>
<?php
while( $row = tng_fetch_assoc($result)) {
	$fixedtitle = addslashes($row['title']);
	echo "<tr><td valign=\"top\" class=\"lightback\"><span class=\"normal\"><a href=\"findsource2.php\" onClick=\"return returnTitle('{$row['sourceID']}');\">{$row['sourceID']}</a></span></td><td class=\"lightback\"><span class=\"normal\"><a href=\"findsource2.php\" onClick=\"return returnTitle('{$row['sourceID']}');\">" . truncateIt($row['title'],75) . "</a>&nbsp;</span></td></tr>\n";
}
tng_free_result($result);
?>
</table>
</body>
</html>
