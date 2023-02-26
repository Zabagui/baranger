<?php
include("begin.php");
include("adminlib.php");
$textpart = "dna";
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( !$allow_delete || ( $assignedtree && $assignedtree != $tree ) ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

function getGroupCount($tree, $group, $table) {
	global $admtext;

	$query = "SELECT count(dna_group) as count FROM $table WHERE gedcom = \"$tree\" and dna_group = \"$group\"";
	$result = tng_query($query);
	$row = tng_fetch_assoc($result);
	$count = $row['count'];
	if(!$count) $count = "0";
 	tng_free_result($result);

	return $count;
}
if( !isset($offset) ) $offset = 0;

$tng_search_groups = $_SESSION['tng_search_groups'] = 1;
if( !empty($newsearch) ) {
	$exptime = 05;
	setcookie("tng_search_groups_post[tree]", $tree, $exptime);
	setcookie("tng_search_groups_post[tngpage]", 1, $exptime);
	setcookie("tng_search_groups_post[offset]", 0, $exptime);
}
else {
	if( empty($tree) )
		$tree = isset($_COOKIE['tng_search_groups_post']['tree']) ? $_COOKIE['tng_search_groups_post']['tree'] : "";
	if( !isset($offset) ) {
		$tngpage = isset($_COOKIE['tng_search_groups_post']['tngpage']) ? $_COOKIE['tng_search_groups_post']['tngpage'] : 1;
		$offset = isset($_COOKIE['tng_search_groups_post']['offset']) ? $_COOKIE['tng_search_groups_post']['offset'] : 0;
	}
	else {
		$exptime = 0;
		if( !isset($tngpage) ) $tngpage = 1;
		setcookie("tng_search_groups_post[tngpage]", $tngpage, $exptime);
		setcookie("tng_search_groups_post[offset]", $offset, $exptime);
	}
}

if( $offset ) {
	$offsetplus = $offset + 1;
	$newoffset = "$offset, ";
}
else {
	$offsetplus = 1;
	$newoffset = "";
	$tngpage = 1;
}

if( $assignedtree ) {
	$wherestr = "WHERE gedcom = \"$assignedtree\"";
	$tree = $assignedtree;
}
else
	$wherestr = "";
$orgtree = $tree;
$treequery = "SELECT gedcom, treename FROM $trees_table $wherestr ORDER BY treename";

$wherestr = "";
if( $tree )
	$wherestr .= "WHERE $dna_groups_table.gedcom = \"$tree\"";
$query = "SELECT $dna_groups_table.gedcom as gedcom, dna_group, $dna_groups_table.description as description, test_type, treename FROM $dna_groups_table LEFT JOIN $trees_table ON $trees_table.gedcom = $dna_groups_table.gedcom $wherestr ORDER BY $dna_groups_table.description LIMIT $newoffset" . $maxsearchresults;
$result = tng_query($query);

$numrows = tng_num_rows( $result );
if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
	$query = "SELECT count(dna_group) as gcount FROM $dna_groups_table LEFT JOIN $trees_table ON $trees_table.gedcom = $dna_groups_table.gedcom $wherestr";
	$result2 = tng_query($query);
	$row = tng_fetch_assoc( $result2 );
	$totrows = $row['gcount'];
	tng_free_result($result2);
}
else
	$totrows = $numrows;

$helplang = findhelp("dna_help.php");

tng_adminheader( $admtext['dna_groups'], $flags );
?>
<script type="text/javascript">
//<![CDATA[
function confirmDelete(ID,tree) {
	if(confirm('<?php echo $admtext['confgroupdelete']; ?>' ))
		deleteIt('dnagroup',ID,tree);
	return false;
}
//]]>
</script>
</head>

<?php
	echo tng_adminlayout();

	$dnatabs['0'] = array(1,"admin_dna_groups.php",$admtext['search'],"findgroup");
	$dnatabs['1'] = array($allow_add,"admin_new_dna_group.php",$admtext['addnew'],"addgroup");
	$dnatabs['2'] = array(1,"admin_dna_tests.php",$admtext['dna_tests'],"findtest");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/dna_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($dnatabs,"findgroup",$innermenu);
	echo displayHeadline($admtext['dna_groups'],"img/dna_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">

	<form action="admin_dna_groups.php" name="form1" id="form1">
	<table>
		<tr>
			<td><span class="normal"><?php echo $admtext['tree']; ?>: </span></td>
			<td>
				<select name="tree">
<?php
	if( !$assignedtree )
		echo "	<option value=\"\">{$admtext['alltrees']}</option>\n";
	$treeresult = tng_query($treequery) or die ($admtext['cannotexecutequery'] . ": $treequery");
	while( $treerow = tng_fetch_assoc($treeresult) ) {
		echo "	<option value=\"{$treerow['gedcom']}\"";
		if( $treerow['gedcom'] == $tree ) echo " selected";
		echo ">{$treerow['treename']}</option>\n";
	}
	tng_free_result($treeresult);
?>
				</select>
			</td>
			<td>
				<input type="submit" name="submit" value="<?php echo $admtext['search']; ?>" class="aligntop">
				<input type="submit" name="submit" value="<?php echo $admtext['reset']; ?>" onClick="document.form1.tree.selectedIndex=0;" class="aligntop">
			</td>
		</tr>
	</table>

	<input type="hidden" name="findgroup" value="1"><input type="hidden" name="newsearch" value="1">
	</form><br />

<?php
	$numrowsplus = $numrows + $offset;
	if( !$numrowsplus ) $offsetplus = 0;
	echo displayListLocation($offsetplus,$numrowsplus,$totrows);
	$pagenav = get_browseitems_nav( $totrows, "admin_dna_groups.php?offset", $maxsearchresults, 5 );
	echo " &nbsp; <span class=\"adminnav\">$pagenav</span></p>";
?>
	<form action="admin_updateselectedgroup.php" method="post"  name="form2">
<?php
	if( $allow_delete ) {
?>
		<p class="nw">
		<input type="button" name="selectall" value="<?php echo $admtext['selectall']; ?>" onClick="toggleAll(1);">
		<input type="button" name="clearall" value="<?php echo $admtext['clearall']; ?>" onClick="toggleAll(0);">
		<input type="submit" name="xdnagroupaction" value="<?php echo $admtext['deleteselected']; ?>" onClick="return confirm('<?php echo addslashes($admtext['confdeleterecs']); ?>');">
		</p>
<?php
	}
?>
	<table cellpadding="3" cellspacing="1" border="0" class="normal rounded-table">
		<tr class="fieldnameback fieldname nw">
			<td><span class="nw">&nbsp;<b><?php echo $admtext['action']; ?></b>&nbsp;</span></td>
<?php
	if($allow_delete) {
?>
			<td><span class="fieldname nw">&nbsp;<b><?php echo $admtext['select']; ?></b>&nbsp;</span></td>
<?php
	}
?>
			<td>&nbsp;<b><?php echo $admtext['groupid']; ?></b>&nbsp;</td>
			<td>&nbsp;<b><?php echo $admtext['description']; ?></b>&nbsp;</td>
			<td>&nbsp;<b><?php echo $admtext['tree']; ?></b>&nbsp;</td>
			<td>&nbsp;<b><?php echo $admtext['test_type']; ?></b>&nbsp;</td>
			<td>&nbsp;<b><?php echo $admtext['dna_tests']; ?></b>&nbsp;</td>
		</tr>

<?php
	if( $numrows ) {
		$actionstr = "";
		if( $allow_edit )
			$actionstr .= "<a href=\"admin_edit_dna_group.php?dna_group=xxx&amp;tree=yyy&amp;test_type=zzz\" title=\"{$admtext['edit']}\" class=\"smallicon admin-edit-icon\"></a>";
		if( $allow_delete ) {
			if( !$assignedtree )
				$actionstr .= "<a href=\"#\" onClick=\"return confirmDelete('xxx','yyy');\" title=\"{$admtext['text_delete']}\" class=\"smallicon admin-delete-icon\"></a>";
		}

		while( $row = tng_fetch_assoc($result)) {
			$newactionstr = preg_replace( "/xxx/", $row['dna_group'], $actionstr );
			$newactionstr = preg_replace( "/yyy/", $row['gedcom'], $newactionstr );
			$newactionstr = preg_replace( "/zzz/", $row['test_type'], $newactionstr );
			echo "<tr id=\"row_{$row['dna_group']}\"><td class=\"lightback\"><div>$newactionstr</div></td>\n";
			if($allow_delete)
				echo "<td class=\"lightback\" align=\"center\"><input type=\"checkbox\" name=\"dna{$row['dna_group']}\" value=\"1\"></td>";
			$editlink = "admin_edit_dna_group.php?dna_group={$row['dna_group']}&amp;tree={$row['gedcom']}";
			$id = $allow_edit ? "<a href=\"$editlink\" title=\"{$admtext['edit']}\">" . $row['dna_group'] . "</a>" : $row['dna_group'];

			echo "<td class=\"lightback nw\">&nbsp;{$row['dna_group']}</td>\n";
			echo "<td class=\"lightback\">&nbsp;{$row['description']}</td>\n";
			echo "<td class=\"lightback\">&nbsp;{$row['treename']}&nbsp;</td>\n";
			echo "<td class=\"lightback\">{$row['test_type']}&nbsp;</td>\n";
			$pcount = getGroupCount($row['gedcom'], $row['dna_group'], $dna_tests_table);
			echo "<td class=\"lightback\" style=\"text-align:right\">$pcount&nbsp;</td>\n";
			echo "</tr>\n";
		}
		tng_free_result($result);
?>
	</table>
	</form>
<?php
		echo displayListLocation($offsetplus,$numrowsplus,$totrows);
		echo " &nbsp; <span class=\"adminnav\">$pagenav</span></p>";
	} else {
?>
	</table>
	</form>
<?php
		echo $admtext['norecords'];
	}
?>

	</div>
</div>
<?php
echo tng_adminfooter();
?>