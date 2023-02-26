<?php
include("begin.php");
include("adminlib.php");
$textpart = "findplace";
//include("getlang.php");
include("$mylanguage/admintext.php");

include($cms['tngpath'] . "checklogin.php");

if( $del ) {
	$query = "DELETE FROM $places_table WHERE ID=\"$del\"";
	$result = tng_query($query);
}

if($session_charset != "UTF-8")
	$myplace = tng_utf8_decode($myplace);

$allwhere = $tree ? "gedcom = \"$tree\"" : "1=1";
if( $myplace )
	$allwhere .= " AND place LIKE \"%$myplace%\"";
if($temple)
	$allwhere .= " AND temple = 1";
$query = "SELECT ID, place, temple, notes FROM $places_table WHERE $allwhere ORDER BY place LIMIT 250";
$result = tng_query($query);

header("Content-type:text/html; charset=" . $session_charset);
?>

<div class="databack ajaxwindow" id="findplaceresdiv">
<table border="0" cellpadding="0">
<tr>
	<td valign="top">
		<span class="subhead"><strong><?php echo $admtext['searchresults']; ?></strong></span><br/>
		<span class="normal">(<?php echo $admtext['clicktoselect']; ?>)</span><br>
	</td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td>
		<form action=""><input type="button" value="<?php echo $admtext['find']; ?>" onclick="reopenFindForm();"></form>
	</td>
</tr>
</table><br>
<table border="0" cellspacing="0" cellpadding="2">
<?php
while( $row = tng_fetch_assoc($result)) {
	echo "<tr><td valign=\"top\"><span class=\"normal\">";
	$row['place'] = str_replace("'","&#39;", $row['place'] );
	$notes = $row['temple'] && $row['notes'] ? " (" . truncateIt($row['notes'],75) .")" : "";
	echo "<a href=\"findplace.php\" onClick='return returnValue(\"" . addslashes($row['place']) . "\");'>{$row['place']}</a>$notes</span></td></tr>\n";
}
tng_free_result($result);
?>
</table>
</div>
