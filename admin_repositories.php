<?php
include("begin.php");
include("adminlib.php");
$textpart = "sources";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

$exptime = 0;
if( !empty($newsearch) ) {
	setcookie("tng_search_repos_post[search]", $searchstring, $exptime);
	setcookie("tng_tree", $tree, $exptime);
	setcookie("tng_search_repos_post[exactmatch]", $exactmatch, $exptime);
	setcookie("tng_search_repos_post[tngpage]", 1, $exptime);
	setcookie("tng_search_repos_post[offset]", 0, $exptime);
}
else {
	if( empty($searchstring) )
		$searchstring = isset($_COOKIE['tng_search_repos_post']['search']) ? stripslashes($_COOKIE['tng_search_repos_post']['search']) : "";
	if( empty($tree) )
		$tree = isset($_COOKIE['tng_tree']) ? $_COOKIE['tng_tree'] : "";
	if( empty($exactmatch) )
		$exactmatch = isset($_COOKIE['tng_search_repos_post']['exactmatch']) ? $_COOKIE['tng_search_repos_post']['exactmatch'] : "";
	if( !isset($offset) ) {
		$tngpage = isset($_COOKIE['tng_search_repos_post']['tngpage']) ? $_COOKIE['tng_search_repos_post']['tngpage'] : 1;
		$offset = isset($_COOKIE['tng_search_repos_post']['offset']) ? $_COOKIE['tng_search_repos_post']['offset'] : 0;
	}
	else {
		if( !isset($tngpage) ) $tngpage = 1;
		setcookie("tng_search_repos_post[tngpage]", $tngpage, $exptime);
		setcookie("tng_search_repos_post[offset]", $offset, $exptime);
	}
}
$searchstring_noquotes = preg_replace("/\"/", "&#34;",$searchstring);
$searchstring = addslashes($searchstring);

if(!empty($order))
	setcookie("tng_search_repos_post[order]", $order, $exptime);
else
	$order = isset($_COOKIE['tng_search_repos_post']['order']) ? $_COOKIE['tng_search_repos_post']['order'] : "title";

if(!isset($offset)) $offset = 0;
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

$uquery = "SELECT count(userID) as ucount FROM $users_table WHERE allow_living != \"-1\"";
$uresult = tng_query($uquery) or die ($admtext['cannotexecutequery'] . ": $uquery");
$urow = tng_fetch_assoc( $uresult );
$numusers = $urow['ucount'];
tng_free_result($uresult);

function addCriteria( $field, $value, $operator ) {
	$criteria = "";

	if( $operator == "=" ) {
		$criteria = " OR $field $operator \"$value\"";
	}
	else {
		$innercriteria = "";
		$terms = explode( ' ',  $value );
		foreach( $terms as $term ) {
			if( $innercriteria ) $innercriteria .= " AND ";
			$innercriteria .= "$field $operator \"%$term%\"";
		}
		if( $innercriteria ) $criteria = " OR ($innercriteria)";
	}

	return $criteria;
}

$showrepo_url = getURL( "showrepo", 1 );
if( $tree )
	$allwhere = "$repositories_table.gedcom = \"$tree\" AND $repositories_table.gedcom = $trees_table.gedcom";
else
	$allwhere = "$repositories_table.gedcom = $trees_table.gedcom";

if( $searchstring ) {
	$allwhere .= " AND (1=0 ";
	if( $exactmatch == "yes" ) {
		$frontmod = "=";
	}
	else {
		$frontmod = "LIKE";
	}

	$allwhere .= addCriteria( "repoID", $searchstring, $frontmod );
	$allwhere .= addCriteria( "reponame", $searchstring, $frontmod );
	$allwhere .= ")";
}

$idsort = "id";
$titlesort = "titleup";
$changesort = "change";
$descicon = "<img src=\"img/tng_sort_desc.gif\" class=\"sortimg\" alt=\"\" />";
$ascicon = "<img src=\"img/tng_sort_asc.gif\" class=\"sortimg\" alt=\"\" />";

if($order == "id") {
	$orderstr = "repoIDnum, reponame";
	$idsort = "<a href=\"admin_repositories.php?order=idup\" class=\"lightlink\">{$admtext['repoid']} $descicon</a>";
}
else {
	$idsort = "<a href=\"admin_repositories.php?order=id\" class=\"lightlink\">{$admtext['repoid']} $ascicon</a>";
	if($order == "idup")
		$orderstr = "repoIDnum DESC, reponame";
}
if($tngconfig['reposuffix']) {
	$len = strlen($tngconfig['reposuffix']);
	$idselect = ", CAST(LEFT(repoID, LENGTH(repoID)-$len) AS UNSIGNED) AS repoIDnum";
}
elseif($tngconfig['repoprefix']) {
	$len = strlen($tngconfig['repoprefix']);
	$idselect = ", CAST(RIGHT(repoID, LENGTH(repoID)-$len) AS UNSIGNED) AS repoIDnum";
}
else
	$idselect = ", CAST(repoID AS UNSIGNED) AS repoIDnum";

if($order == "title") {
	$orderstr = "reponame";
	$titlesort = "<a href=\"admin_repositories.php?order=titleup\" class=\"lightlink\">{$admtext['title2']} $descicon</a>";
}
else {
	$titlesort = "<a href=\"admin_repositories.php?order=title\" class=\"lightlink\">{$admtext['title2']} $ascicon</a>";
	if($order == "titleup")
		$orderstr = "reponame DESC";
}

if($order == "change") {
	$orderstr = "changedate, reponame";
	$changesort = "<a href=\"admin_repositories.php?order=changeup\" class=\"lightlink\">{$admtext['lastmodified']} $descicon</a>";
}
else {
	$changesort = "<a href=\"admin_repositories.php?order=change\" class=\"lightlink\">{$admtext['lastmodified']} $ascicon</a>";
	if($order == "changeup")
		$orderstr = "changedate DESC, reponame";
}

$query = "SELECT ID, repoID{$idselect}, reponame, $repositories_table.gedcom as gedcom, treename, changedby, DATE_FORMAT(changedate,\"%d %b %Y\") as changedatef 
	FROM ($repositories_table, $trees_table) WHERE $allwhere ORDER BY $orderstr LIMIT $newoffset" . $maxsearchresults;
$result = tng_query($query);

$numrows = tng_num_rows( $result );
if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
	$query = "SELECT count(repoID) as rcount FROM ($repositories_table, $trees_table) WHERE $allwhere";
	$result2 = tng_query($query);
	$row = tng_fetch_assoc( $result2 );
	$totrows = $row['rcount'];
	tng_free_result($result2);
}
else
	$totrows = $numrows;

$helplang = findhelp("repositories_help.php");

tng_adminheader( $admtext['repositories'], $flags );
?>
<script type="text/javascript">
function confirmDelete(ID) {
	if(confirm('<?php echo $admtext['confdeleterepo']; ?>' ))
		deleteIt('repository',ID);
	return false;
}
</script>
<script type="text/javascript" src="js/admin.js"></script>
</head>

<?php
	echo tng_adminlayout();

	$repotabs[0] = array(1,"admin_repositories.php",$admtext['search'],"findrepo");
	$repotabs[1] = array($allow_add,"admin_newrepo.php",$admtext['addnew'],"addrepo");
	$repotabs[2] = array($allow_edit && $allow_delete,"admin_mergerepos.php",$admtext['merge'],"merge");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/repositories_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($repotabs,"findrepo",$innermenu);
	echo displayHeadline($admtext['repositories'],"img/repos_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">

	<form action="admin_repositories.php" name="form1" id="form1">
	<table>
		<tr>
			<td><span class="normal"><?php echo $admtext['searchfor']; ?>: </span></td>
			<td>
<?php
	include("treequery.php");
?>
				<input type="text" name="searchstring" value="<?php echo $searchstring_noquotes; ?>" class="longfield">
			</td>
			<td>
				<input type="submit" name="submit" value="<?php echo $admtext['search']; ?>" class="aligntop">
				<input type="submit" name="submit" value="<?php echo $admtext['reset']; ?>" onClick="document.form1.searchstring.value=''; document.form1.tree.selectedIndex=0; document.form1.exactmatch.checked=false;" class="aligntop">
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="2">
				<span class="normal">
				<input type="checkbox" name="exactmatch" value="yes"<?php if( $exactmatch == "yes" ) echo " checked"; ?>> <?php echo $admtext['exactmatch']; ?>
				</span>
			</td>
		</tr>
	</table>

	<input type="hidden" name="findrepo" value="1"><input type="hidden" name="newsearch" value="1">
	</form><br />

<?php
	$numrowsplus = $numrows + $offset;
	if( !$numrowsplus ) $offsetplus = 0;
	echo displayListLocation($offsetplus,$numrowsplus,$totrows);
	$pagenav = get_browseitems_nav( $totrows, "admin_repositories.php?searchstring=$searchstring&amp;exactmatch=$exactmatch&amp;offset", $maxsearchresults, 5 );
	echo " &nbsp; <span class=\"adminnav\">$pagenav</span></p>";
?>
	<form action="admin_deleteselected.php" method="post"  name="form2">
<?php
	if( $allow_delete ) {
?>
		<p>
		<input type="button" name="selectall" value="<?php echo $admtext['selectall']; ?>" onClick="toggleAll(1);">
		<input type="button" name="clearall" value="<?php echo $admtext['clearall']; ?>" onClick="toggleAll(0);">
		<input type="submit" name="xrepoaction" value="<?php echo $admtext['deleteselected']; ?>" onClick="return confirm('<?php echo addslashes($admtext['confdeleterecs']); ?>');">
		</p>
<?php
	}
?>

	<table cellpadding="3" cellspacing="1" border="0" class="normal rounded-table">
		<tr>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['action']; ?></b>&nbsp;</nobr></span></td>
<?php
	if($allow_delete) {
?>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['select']; ?></b>&nbsp;</nobr></span></td>
<?php
	}
?>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $idsort; ?></b>&nbsp;</nobr></span></td>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $titlesort; ?></b>&nbsp;</nobr></span></td>
<?php
	if($numtrees > 1) {
?>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['tree']; ?></b>&nbsp;</nobr></span></td>
<?php
	}
?>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $changesort; ?></b>&nbsp;</nobr></span></td>
		</tr>
<?php
	if( $numrows ) {
		$actionstr = "";
		if( $allow_edit )
			$actionstr .= "<a href=\"admin_editrepo.php?repoID=xxx&amp;tree=yyy\" title=\"{$admtext['edit']}\" class=\"smallicon admin-edit-icon\"></a>";
		if( $allow_delete )
			$actionstr .= "<a href=\"#\" onclick=\"return confirmDelete('zzz');\" title=\"{$admtext['text_delete']}\" class=\"smallicon admin-delete-icon\"></a>";
		$actionstr .= "<a href=\"" . $showrepo_url . "repoID=xxx&amp;tree=yyy\" target=\"_blank\" title=\"{$admtext['test']}\" class=\"smallicon admin-test-icon\"></a>";

		while( $row = tng_fetch_assoc($result))
		{
			$newactionstr = preg_replace( "/xxx/", $row['repoID'], $actionstr );
			$newactionstr = preg_replace( "/yyy/", $row['gedcom'], $newactionstr );
			$newactionstr = preg_replace( "/zzz/", $row['ID'], $newactionstr );
			$editlink = "admin_editrepo.php?repoID={$row['repoID']}&amp;tree={$row['gedcom']}";
			$id = $allow_edit ? "<a href=\"$editlink\" title=\"{$admtext['edit']}\">" . $row['repoID'] . "</a>" : $row['repoID'];

			echo "<tr id=\"row_{$row['ID']}\"><td class=\"lightback\"><div class=\"action-btns\">$newactionstr</div></td>\n";
			if( $allow_delete )
				echo "<td class=\"lightback\" align=\"center\"><input type=\"checkbox\" name=\"del{$row['ID']}\" value=\"1\"></td>";
			echo "<td class=\"lightback\">&nbsp;$id&nbsp;</td>\n";
			echo "<td class=\"lightback\">&nbsp;{$row['reponame']}&nbsp;</td>\n";
			if($numtrees > 1)
				echo "<td class=\"lightback nw\">&nbsp;{$row['treename']}&nbsp;</td>\n";
			$changedby = $numusers > 1 ? "{$row['changedby']}: " : "";
			echo "<td class=\"lightback\">{$changedby}{$row['changedatef']}</td>\n";
			echo "</tr>\n";
		}
?>
	</table>
<?php
		echo displayListLocation($offsetplus,$numrowsplus,$totrows);
		echo " &nbsp; <span class=\"adminnav\">$pagenav</span></p>";
	}
	else
		echo "</table>\n" . $admtext['norecords'];
  	tng_free_result($result);
?>
	</form>

	</div>
</div>
<?php 
echo tng_adminfooter();
?>