<?php
include("begin.php");
include("adminlib.php");
$textpart = "branches";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( $assignedbranch ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

function getBranchCount($tree, $branch, $table) {
	global $admtext;

	$query = "SELECT count(ID) as count FROM $table WHERE gedcom = \"$tree\" and branch LIKE \"%$branch%\"";
	$result = tng_query($query);
	$row = tng_fetch_assoc($result);
	$count = $row['count'];
	if(!$count) $count = "0";
 	tng_free_result($result);

	return $count;
}

$tng_search_branches = $_SESSION['tng_search_branches'] = 1;
$exptime = 0;
if( !empty($newsearch) ) {
	$searchstring = stripslashes(trim($searchstring));
	setcookie("tng_search_branches_post[search]", $searchstring, $exptime);
	setcookie("tng_tree", $tree, $exptime);
	setcookie("tng_search_branches_post[tngpage]", 1, $exptime);
	setcookie("tng_search_branches_post[offset]", 0, $exptime);
}
else {
	if( empty($searchstring) )
		$searchstring =isset($_COOKIE['tng_search_branches_post']['search']) ?  $_COOKIE['tng_search_branches_post']['search'] : "";
	if( empty($tree) )
		$tree = isset($_COOKIE['tng_tree']) ? $_COOKIE['tng_tree'] : "";
	if( !isset($offset) ) {
		$tngpage = isset($_COOKIE['tng_search_branches_post']['tngpage']) ? $_COOKIE['tng_search_branches_post']['tngpage'] : 1;
		$offset = isset($_COOKIE['tng_search_branches_post']['offset']) ? $_COOKIE['tng_search_branches_post']['offset'] : 0;
	}
	else {
		if( !isset($tngpage) ) $tngpage = 1;
		if( !isset($offset) ) $offset = 0;
		setcookie("tng_search_branches_post[tngpage]", $tngpage, $exptime);
		setcookie("tng_search_branches_post[offset]", $offset, $exptime);
	}
}
$searchstring_noquotes = preg_replace("/\"/", "&#34;",$searchstring);
$searchstring = addslashes($searchstring);

if(!empty($order))
	setcookie("tng_search_branches_post[order]", $order, $exptime);
else
	$order = isset($_COOKIE['tng_search_branches_post']['order']) ? $_COOKIE['tng_search_branches_post']['order'] : "desc";

if( !isset($offset) ) $offset = 0;
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

$idsort = "id";
$descsort = "descup";
$descicon = "<img src=\"img/tng_sort_desc.gif\" class=\"sortimg\" alt=\"\" />";
$ascicon = "<img src=\"img/tng_sort_asc.gif\" class=\"sortimg\" alt=\"\" />";

if($order == "id") {
	$orderstr = "branch, $branches_table.description";
	$idsort = "<a href=\"admin_branches.php?order=idup\" class=\"lightlink\">{$admtext['branchid']} $descicon</a>";
}
else {
	$idsort = "<a href=\"admin_branches.php?order=id\" class=\"lightlink\">{$admtext['branchid']} $ascicon</a>";
	if($order == "idup")
		$orderstr = "branch DESC, $branches_table.description DESC";
}

if($order == "desc") {
	$orderstr = "$branches_table.description";
	$descsort = "<a href=\"admin_branches.php?order=descup\" class=\"lightlink\">{$admtext['description']} $descicon</a>";
}
else {
	$descsort = "<a href=\"admin_branches.php?order=desc\" class=\"lightlink\">{$admtext['description']} $ascicon</a>";
	if($order == "descup")
		$orderstr = "$branches_table.description DESC";
}

$wherestr = $searchstring ? "WHERE (branch LIKE \"%$searchstring%\" OR $branches_table.description LIKE \"%$searchstring%\")" : "";
if( $tree )
	$wherestr .= $wherestr ? " AND $branches_table.gedcom = \"$tree\"" : "WHERE $branches_table.gedcom = \"$tree\"";
$query = "SELECT $branches_table.gedcom as gedcom, branch, $branches_table.description as description, personID, treename 
	FROM $branches_table LEFT JOIN $trees_table ON $trees_table.gedcom = $branches_table.gedcom $wherestr ORDER BY $orderstr LIMIT $newoffset" . $maxsearchresults;
$result = tng_query($query);

$numrows = tng_num_rows( $result );
if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
	$query = "SELECT count(branch) as bcount FROM $branches_table LEFT JOIN $trees_table ON $trees_table.gedcom = $branches_table.gedcom $wherestr";
	$result2 = tng_query($query);
	$row = tng_fetch_assoc( $result2 );
	$totrows = $row['bcount'];
	tng_free_result($result2);
}
else
	$totrows = $numrows;

$helplang = findhelp("branches_help.php");

tng_adminheader( $admtext['branches'], $flags );
?>
<script type="text/javascript">
function confirmDelete(ID,tree) {
	if(confirm('<?php echo $admtext['confbranchdelete']; ?>' ))
		deleteIt('branch',ID,tree);
	return false;
}
</script>
<script type="text/javascript" src="js/admin.js"></script>
</head>

<?php
	echo tng_adminlayout();

	$branchtabs['0'] = array(1,"admin_branches.php",$admtext['search'],"findbranch");
	$branchtabs['1'] = array($allow_add,"admin_newbranch.php",$admtext['addnew'],"addbranch");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/branches_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($branchtabs,"findbranch",$innermenu);
	echo displayHeadline($admtext['branches'],"img/branches_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">

	<form action="admin_branches.php" name="form1" id="form1">
	<table>
		<tr>
			<td><span class="normal"><?php echo $admtext['searchfor']; ?>: </span></td>
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
				<input type="text" name="searchstring" value="<?php echo $searchstring_noquotes; ?>" class="longfield">
			</td>
			<td>
				<input type="submit" name="submit" value="<?php echo $admtext['search']; ?>" class="aligntop">
				<input type="submit" name="submit" value="<?php echo $admtext['reset']; ?>" onClick="document.form1.searchstring.value=''; document.form1.tree.selectedIndex=0;" class="aligntop">
			</td>
		</tr>
	</table>

	<input type="hidden" name="findbranch" value="1"><input type="hidden" name="newsearch" value="1">
	</form><br />

<?php
	$numrowsplus = $numrows + $offset;
	if( !$numrowsplus ) $offsetplus = 0;
	echo displayListLocation($offsetplus,$numrowsplus,$totrows);
	$pagenav = get_browseitems_nav( $totrows, "admin_branches.php?searchstring=$searchstring&amp;offset", $maxsearchresults, 5 );
	echo " &nbsp; <span class=\"adminnav\">$pagenav</span></p>";
?>
	<form action="admin_deleteselected.php" method="post"  name="form2">
<?php
	if( $allow_delete ) {
?>
		<p>
		<input type="button" name="selectall" value="<?php echo $admtext['selectall']; ?>" onClick="toggleAll(1);">
		<input type="button" name="clearall" value="<?php echo $admtext['clearall']; ?>" onClick="toggleAll(0);">
  		<input type="submit" name="xbranchaction" value="<?php echo $admtext['deleteselected']; ?>" onClick="return confirm('<?php echo addslashes($admtext['confdeleterecs']); ?>');">
		</p>
<?php
	}
?>
	<table cellpadding="3" cellspacing="1" border="0" class="normal rounded-table">
		<tr>
			<td class="fieldnameback fieldname nw"><nobr>&nbsp;<b><?php echo $admtext['action']; ?></b>&nbsp;</nobr></td>
<?php
	if($allow_delete) {
?>
			<td class="fieldnameback fieldname nw"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['select']; ?></b>&nbsp;</nobr></span></td>
<?php
	}
?>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $idsort; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $descsort; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['tree']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $text['startingind']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['people']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['families']; ?></b>&nbsp;</td>
		</tr>

<?php
	if( $numrows ) {
		$actionstr = "";
		if( $allow_edit )
			$actionstr .= "<a href=\"admin_editbranch.php?branch=xxx&amp;tree=yyy\" title=\"{$admtext['edit']}\" class=\"smallicon admin-edit-icon\"></a>";
		if( $allow_delete ) {
			if( !$assignedtree )
				$actionstr .= "<a href=\"#\" onClick=\"return confirmDelete('xxx','yyy');\" title=\"{$admtext['text_delete']}\" class=\"smallicon admin-delete-icon\"></a>";
		}

		while( $row = tng_fetch_assoc($result)) {
			$newactionstr = preg_replace( "/xxx/", $row['branch'], $actionstr );
			$newactionstr = preg_replace( "/yyy/", $row['gedcom'], $newactionstr );
			echo "<tr id=\"row_{$row['branch']}\"><td class=\"lightback\"><div class=\"action-btns\" style=\"width:50px\">$newactionstr</div></td>\n";
			if($allow_delete)
				echo "<td class=\"lightback\" align=\"center\"><input type=\"checkbox\" name=\"del{$row['branch']}&amp;{$row['gedcom']}\" value=\"1\"></td>";
			$editlink = "admin_editbranch.php?branch={$row['branch']}&amp;tree={$row['gedcom']}";
			$id = $allow_edit ? "<a href=\"$editlink\" title=\"{$admtext['edit']}\">" . $row['branch'] . "</a>" : $row['branch'];

			echo "<td class=\"lightback\" nowrap>&nbsp;$id&nbsp;</td>\n";
			echo "<td class=\"lightback\">&nbsp;{$row['description']}</td>\n";
			echo "<td class=\"lightback\">&nbsp;{$row['treename']}&nbsp;</td>\n";
			
			$pcount = getBranchCount($row['gedcom'], $row['branch'], $people_table);
			$fcount = getBranchCount($row['gedcom'], $row['branch'], $families_table);

			echo "<td class=\"lightback\">{$row['personID']}&nbsp;</td>\n";
			echo "<td class=\"lightback\" style=\"text-align:right\">$pcount&nbsp;</td>\n";
			echo "<td class=\"lightback\" style=\"text-align:right\">$fcount&nbsp;</td>\n";
			echo "</tr>\n";
		}
		tng_free_result($result);
?>
	</table>
<?php
		echo displayListLocation($offsetplus,$numrowsplus,$totrows);
		echo " &nbsp; <span class=\"adminnav\">$pagenav</span></p>";
	}
	else
		echo $admtext['nobranch'];
?>

	</div>
</div>
<?php 
echo tng_adminfooter();
?>