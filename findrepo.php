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

$query = "SELECT repoID, reponame FROM $repositories_table WHERE gedcom = \"$tree\" AND reponame LIKE \"%$mytitle%\" ORDER BY reponame LIMIT 250";
$result = tng_query($query);

header("Content-type:text/html; charset=" . $session_charset);
?>

<div class="databack ajaxwindow" id="findreporesdiv">
<table border="0" cellpadding="0">
<tr>
	<td valign="top">
		<span class="subhead"><strong><?php echo $admtext['searchresults']; ?></strong></span><br/>
		<span class="normal">(<?php echo $admtext['clicktoselect']; ?>)</span><br/>
	</td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td>
		<form action=""><input type="button" value="<?php echo $admtext['find']; ?>" onclick="reopenFindRepoForm();"></form>
	</td>
</tr>
</table>
<table border="0" cellspacing="1" cellpadding="3">
	<tr>
		<td class="fieldnameback"><span class="fieldname">&nbsp;<b><?php echo $admtext['repoid']; ?></b>&nbsp;</span></td>
		<td class="fieldnameback"><span class="fieldname">&nbsp;<b><?php echo $admtext['name']; ?></b>&nbsp;</span></td>
	</tr>
<?php
while( $row = tng_fetch_assoc($result)) {
	$fixedtitle = addslashes($row['reponame']);
	echo "<tr><td valign=\"top\" class=\"lightback\"><span class=\"normal\"><a href=\"findrepo.php\" onClick=\"return returnTitle('{$row['repoID']}');\">{$row['repoID']}</a></span></td><td class=\"lightback\"><span class=\"normal\"><a href=\"findrepo.php\" onClick=\"return returnTitle('{$row['repoID']}');\">" . truncateIt($row['reponame'],75) . "</a></span></td></tr>\n";
}
tng_free_result($result);
?>
</table>
</div>
