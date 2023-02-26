<?php
include("begin.php");
include("adminlib.php");
$textpart = "trees";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

$tng_search_trees = $_SESSION['tng_search_trees'] = 1;
if( !empty($newsearch) ) {
	$exptime = 0;
	setcookie("tng_search_trees_post[search]", $searchstring, $exptime);
	setcookie("tng_search_trees_post[tngpage]", 1, $exptime);
	setcookie("tng_search_trees_post[offset]", 0, $exptime);
}
else {
	if( empty($searchstring) )
		$searchstring = isset($_COOKIE['tng_search_trees_post']['search']) ? $_COOKIE['tng_search_trees_post']['search'] : "";
	if( !isset($offset) ) {
		$tngpage = isset($_COOKIE['tng_search_trees_post']['tngpage']) ? $_COOKIE['tng_search_trees_post']['tngpage'] : 1;
		$offset = isset($_COOKIE['tng_search_trees_post']['offset']) ? $_COOKIE['tng_search_trees_post']['offset'] : 0;
	}
	else {
		$exptime = 0;
		setcookie("tng_search_trees_post[tngpage]", $tngpage, $exptime);
		setcookie("tng_search_trees_post[offset]", $offset, $exptime);
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

$wherestr = $searchstring ? "WHERE (gedcom LIKE \"%$searchstring%\" OR treename LIKE \"%$searchstring%\" OR description LIKE \"%$searchstring%\" OR owner LIKE \"%$searchstring%\")" : "";
if( $assignedtree ) {
	$wherestr .= $wherestr ? " AND gedcom = \"$assignedtree\"" : "WHERE gedcom = \"$assignedtree\"";
}

$query = "SELECT gedcom, treename, description, owner, DATE_FORMAT(lastimportdate,\"%d %b %Y %H:%i:%s\") as lastimportdate, importfilename FROM $trees_table $wherestr ORDER BY treename LIMIT $newoffset" . $maxsearchresults;
$result = tng_query($query);

$numrows = tng_num_rows( $result );
if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
	$query = "SELECT count(gedcom) as tcount FROM $trees_table $wherestr";
	$result2 = tng_query($query);
	$row = tng_fetch_assoc( $result2 );
	$totrows = $row['tcount'];
	tng_free_result($result2);
}
else
	$totrows = $numrows;

$helplang = findhelp("trees_help.php");

tng_adminheader( $admtext['trees'], $flags );
?>
<script type="text/javascript" src="js/admin.js"></script>
</head>

<?php
	echo tng_adminlayout();

	$allow_add_tree = $assignedtree ? 0 : $allow_add;
	$treetabs[0] = array(1,"admin_trees.php",$admtext['search'],"findtree");
	$treetabs[1] = array($allow_add_tree,"admin_newtree.php",$admtext['addnew'],"addtree");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/trees_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($treetabs,"findtree",$innermenu);
	echo displayHeadline($admtext['trees'], "img/trees_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">

	<form action="admin_trees.php" name="form1">
	<?php echo $admtext['searchfor']; ?>: <input type="text" name="searchstring" value="<?php echo $searchstring; ?>" class="longfield">
	<input type="hidden" name="findtree" value="1"><input type="hidden" name="newsearch" value="1">
	<input type="submit" name="submit" value="<?php echo $admtext['search']; ?>" class="aligntop">
	<input type="submit" name="submit" value="<?php echo $admtext['reset']; ?>" onClick="document.form1.searchstring.value='';" class="aligntop"></form><br />

<?php
	$numrowsplus = $numrows + $offset;
	if( !$numrowsplus ) $offsetplus = 0;
	echo displayListLocation($offsetplus,$numrowsplus,$totrows);
	$pagenav = get_browseitems_nav( $totrows, "admin_trees.php?searchstring=$searchstring&amp;offset", $maxsearchresults, 5 );
	echo " &nbsp; <span class=\"adminnav\">$pagenav</span></p>";
?>
	<form action="admin_deleteselected.php" method="post" name="form2">
<?php
	if( $allow_delete ) {
?>
		<p>
		<input type="button" name="selectall" value="<?php echo $admtext['selectall']; ?>" onClick="toggleAll(1);">
		<input type="button" name="clearall" value="<?php echo $admtext['clearall']; ?>" onClick="toggleAll(0);">
  		<input type="submit" name="xtreeaction" value="<?php echo $admtext['deleteselected']; ?>" onClick="return confirm('<?php echo addslashes($admtext['confdeleterecs']); ?>');">
		</p>
<?php
	}
?>
	<table cellpadding="3" cellspacing="1" border="0" class="normal rounded-table">
		<tr>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['action']; ?></b>&nbsp;</td>
<?php
	if($allow_delete) {
?>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['select']; ?></b>&nbsp;</td>
<?php
	}
?>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['id']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['treename']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['description']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['people']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['owner']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['lastimport']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['importfilename']; ?></b>&nbsp;</td>
		</tr>

<?php
	if( $numrows ) {
		$actionstr = "";
		if( $allow_edit && !$assignedbranch )
			$actionstr .= "<a href=\"admin_edittree.php?tree=xxx\" title=\"{$admtext['edit']}\" class=\"smallicon admin-edit-icon\"></a>";
		if( $allow_delete && !$assignedbranch ) {
			if( !$assignedtree )
				$actionstr .= "<a href=\"#\" onClick=\"if(confirm('{$admtext['conftreedelete']}' )){deleteIt('tree','xxx');} return false;\" title=\"{$admtext['text_delete']}\" class=\"smallicon admin-delete-icon\"></a>";
			$actionstr .= "<a href=\"admin_cleartree.php?tree=xxx\" onClick=\"return confirm('{$admtext['conftreeclear']}' );\" title=\"{$admtext['clear']}\" class=\"smallicon admin-clear-icon\"></a>";
		}

		while( $row = tng_fetch_assoc($result)) {
			$newactionstr = preg_replace( "/xxx/", $row['gedcom'], $actionstr );
			$editlink = "admin_edittree.php?tree={$row['gedcom']}";
			$gedcom = $allow_edit ? "<a href=\"$editlink\" title=\"{$admtext['edit']}\">" . $row['gedcom'] . "</a>" : $row['gedcom'];

			$query = "SELECT count(personID) as pcount FROM $people_table WHERE gedcom = \"{$row['gedcom']}\"";
			$result2 = tng_query($query);
			$prow = tng_fetch_assoc($result2);
			$pcount = number_format($prow['pcount']);
			tng_free_result($result2);

			echo "<tr id=\"row_{$row['gedcom']}\"><td class=\"lightback\" valign=\"top\"><div class=\"action-btns\">$newactionstr</div></td>\n";
			if($allow_delete)
				echo "<td class=\"lightback\" align=\"center\" valign=\"top\"><input type=\"checkbox\" name=\"del{$row['gedcom']}\" value=\"1\"></td>";
			echo "<td class=\"lightback nw\">&nbsp;$gedcom&nbsp;</td>\n";
			echo "<td class=\"lightback\">&nbsp;{$row['treename']}&nbsp;</td>\n";
			echo "<td class=\"lightback\">&nbsp;{$row['description']}&nbsp;</td>\n";
			echo "<td class=\"lightback nw\" align=\"right\">&nbsp;$pcount&nbsp;</td>\n";
			echo "<td class=\"lightback nw\">&nbsp;{$row['owner']}&nbsp;</td>\n";
			echo "<td class=\"lightback nw\">&nbsp;{$row['lastimportdate']}&nbsp;</td>\n";
			echo "<td class=\"lightback nw\">&nbsp;{$row['importfilename']}&nbsp;</td>\n";
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
		echo $admtext['notrees'];
?>

	</form>
	</div>
</div>
<?php 
echo tng_adminfooter();
?>