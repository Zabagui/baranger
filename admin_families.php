<?php
include("begin.php");
include("adminlib.php");
$textpart = "families";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

$newsearch = isset($newsearch) ? $newsearch : "";
$searchstring = isset($searchstring) ? $searchstring : "";
if(!isset($tree)) $tree = "";
if(!isset($living)) $living = "";
if(!isset($exactmatch)) $exactmatch = "";
if(!isset($spousename)) $spousename = "";
if(!isset($tngpage)) $tngpage = 0;

$exptime = 0;
if( $newsearch ) {
	setcookie("tng_search_families_post[search]", $searchstring, $exptime);
	setcookie("tng_tree", $tree, $exptime);
	setcookie("tng_search_families_post[living]", $living, $exptime);
	setcookie("tng_search_families_post[exactmatch]", $exactmatch, $exptime);
	setcookie("tng_search_families_post[spousename]", $spousename, $exptime);
	setcookie("tng_search_families_post[tngpage]", 1, $exptime);
	setcookie("tng_search_families_post[offset]", 0, $exptime);
}
else {
	if( !$searchstring )
		$searchstring = isset($_COOKIE['tng_search_families_post']['search']) ? stripslashes($_COOKIE['tng_search_families_post']['search']) : "";
	if( !$tree )
		$tree = isset($_COOKIE['tng_tree']) ? $_COOKIE['tng_tree'] : "";
	if( !$living )
		$living = isset($_COOKIE['tng_search_families_post']['living']) ? $_COOKIE['tng_search_families_post']['living'] : "";
	if( !$exactmatch )
		$exactmatch = isset($_COOKIE['tng_search_families_post']['exactmatch']) ? $_COOKIE['tng_search_families_post']['exactmatch'] : "";
	if( !$spousename ) {
		$spousename = isset($_COOKIE['tng_search_families_post']['spousename']) ? $_COOKIE['tng_search_families_post']['spousename'] : "";
		if( !$spousename ) $spousename = "husband";
	}
	if( !isset($offset) ) {
		$tngpage = isset($_COOKIE['tng_search_families_post']['tngpage']) ? $_COOKIE['tng_search_families_post']['tngpage'] : 1;
		$offset = isset($_COOKIE['tng_search_families_post']['offset']) ? $_COOKIE['tng_search_families_post']['offset'] : 0;
	}
	else {
		setcookie("tng_search_families_post[tngpage]", $tngpage, $exptime);
		setcookie("tng_search_families_post[offset]", $offset, $exptime);
	}
}
$searchstring_noquotes = preg_replace("/\"/", "&#34;",$searchstring);
$searchstring = addslashes($searchstring);

if(!empty($order))
	setcookie("tng_search_families_post[order]", $order, $exptime);
else
	$order = isset($_COOKIE['tng_search_families_post']['order']) ? $_COOKIE['tng_search_families_post']['order'] : "fname";

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

$familygroup_url = getURL( "familygroup", 1 );
$allwhere = "$families_table.gedcom = $trees_table.gedcom";
$allwhere2 = "";

if( $searchstring ) {
	$allwhere .= " AND (1=0 ";
	if( $exactmatch == "yes" ) {
		$frontmod = "=";
	}
	else {
		$frontmod = "LIKE";
	}

	$allwhere .= addCriteria( "familyID", $searchstring, $frontmod );
	$allwhere .= addCriteria( "husband", $searchstring, $frontmod );
	$allwhere .= addCriteria( "wife", $searchstring, $frontmod );
	$allwhere .= addCriteria( "CONCAT_WS(' ',TRIM(p1.firstname)" . ($lnprefixes ? ",TRIM(p1.lnprefix)" : "") . ",TRIM(p1.lastname))", $searchstring, $frontmod );
	$allwhere .= ")";
}
if( $spousename == "husband" ) {
	$allwhere2 .= "AND p1.personID = husband ";
	$otherspouse = "wife";
}
elseif( $spousename == "wife" ) {
	$allwhere2 .= "AND p1.personID = wife ";
	$otherspouse = "husband";
}
else
	$otherspouse = "";

$allwhere2 .= "AND p1.gedcom = $trees_table.gedcom";
$allwhere .= " $allwhere2";
if( $tree ) {
	$allwhere .= " AND p1.gedcom = \"$tree\"";
}
else {
	$allwhere .= " AND p1.gedcom = $families_table.gedcom";
}
if( $assignedbranch )
	$allwhere .= " AND $families_table.branch LIKE \"%$assignedbranch%\"";
$people_join = ", $people_table as p1";
$otherfields = ", p1.firstname, p1.lnprefix, p1.lastname, p1.prefix, p1.suffix, p1.title, p1.nameorder";
if($otherspouse)
	$otherfields .= ", p2.firstname as p2firstname, p2.lnprefix as p2lnprefix, p2.lastname as p2lastname, p2.prefix as p2prefix, p2.suffix as p2suffix, p2.title as p2title, p2.nameorder as p2nameorder";
$sortstr = "p1.lastname, p1.lnprefix, p1.firstname,";

if( $tree )
	$allwhere .= " AND $families_table.gedcom = \"$tree\"";
if( $living == "yes" )
	$allwhere .= " AND $families_table.living = \"1\"";

$idsort = "id";
$marrsort = "marr";
$fnamesort = "fnameup";
$mnamesort = "mname";
$changesort = "change";
$descicon = "<img src=\"img/tng_sort_desc.gif\" class=\"sortimg\" alt=\"\" />";
$ascicon = "<img src=\"img/tng_sort_asc.gif\" class=\"sortimg\" alt=\"\" />";

if($order == "id") {
	$orderstr = "familyIDnum, p1.lastname, p1.lnprefix, p1.firstname";
	$idsort = "<a href=\"admin_families.php?order=idup\" class=\"lightlink\">{$admtext['id']} $descicon</a>";
}
else {
	$idsort = "<a href=\"admin_families.php?order=id\" class=\"lightlink\">{$admtext['id']} $ascicon</a>";
	if($order == "idup")
		$orderstr = "familyIDnum DESC, p1.lastname, p1.lnprefix, p1.firstname";
}
if($tngconfig['familysuffix']) {
	$len = strlen($tngconfig['familysuffix']);
	$idselect = ", CAST(LEFT(familyID, LENGTH(familyID)-$len) AS UNSIGNED) AS familyIDnum";
}
elseif($tngconfig['familyprefix']) {
	$len = strlen($tngconfig['familyprefix']);
	$idselect = ", CAST(RIGHT(familyID, LENGTH(familyID)-$len) AS UNSIGNED) AS familyIDnum";
}
else
	$idselect = ", CAST(familyID AS UNSIGNED) AS familyIDnum";

if($order == "fname") {
	$orderstr = "p1.lastname, p1.lnprefix, p1.firstname";
	$fnamesort = "<a href=\"admin_families.php?order=fnameup\" class=\"lightlink\">{$admtext['husbname']} $descicon</a>";
}
else {
	$fnamesort = "<a href=\"admin_families.php?order=fname\" class=\"lightlink\">{$admtext['husbname']} $ascicon</a>";
	if($order == "fnameup")
		$orderstr = "p1.lastname DESC, p1.lnprefix DESC, p1.firstname DESC";
}

if($otherspouse) {
	if($order == "mname") {
		$orderstr = "p2.lastname, p2.lnprefix, p2.firstname";
		$mnamesort = "<a href=\"admin_families.php?order=mnameup\" class=\"lightlink\">{$admtext['wifename']} $descicon</a>";
	}
	else {
		$mnamesort = "<a href=\"admin_families.php?order=mname\" class=\"lightlink\">{$admtext['wifename']} $ascicon</a>";
		if($order == "mnameup")
			$orderstr = "p2.lastname DESC, p2.lnprefix DESC, p2.firstname DESC";
	}
}
else {
	$mnamesort = "";
	$orderstr = "";
}

if($order == "marr") {
	$orderstr = "marrdatetr, p1.lastname, p1.lnprefix, p1.firstname";
	$marrsort = "<a href=\"admin_families.php?order=marrup\" class=\"lightlink\">{$admtext['marrdate']}, {$admtext['marriageplace']} $descicon</a>";
}
else {
	$marrsort = "<a href=\"admin_families.php?order=marr\" class=\"lightlink\">{$admtext['marrdate']}, {$admtext['marriageplace']} $ascicon</a>";
	if($order == "marrup")
		$orderstr = "marrdatetr DESC, p1.lastname, p1.lnprefix, p1.firstname";
}

if($order == "change") {
	$orderstr = "$families_table.changedate, p1.lastname, p1.lnprefix, p1.firstname";
	$changesort = "<a href=\"admin_families.php?order=changeup\" class=\"lightlink\">{$admtext['lastmodified']} $descicon</a>";
}
else {
	$changesort = "<a href=\"admin_families.php?order=change\" class=\"lightlink\">{$admtext['lastmodified']} $ascicon</a>";
	if($order == "changeup")
		$orderstr = "$families_table.changedate DESC, p1.lastname, p1.lnprefix, p1.firstname";
}

$query = "SET SQL_BIG_SELECTS=1";
$result = tng_query($query);

if($otherspouse) {
	$from = "$families_table, $trees_table $people_join";
	$query = "SELECT $families_table.ID as ID, familyID{$idselect}, husband, wife, marrdate, marrplace, $families_table.private, $families_table.living, $families_table.branch, $families_table.gedcom as gedcom, treename, $families_table.changedby, DATE_FORMAT($families_table.changedate,\"%d %b %Y\") as changedatef, $families_table.changedate as changedate $otherfields 
		FROM ($from) 
		LEFT JOIN $people_table as p2 ON p2.gedcom = $trees_table.gedcom AND p2.personID = $otherspouse
		WHERE $allwhere ORDER BY $orderstr LIMIT $newoffset" . $maxsearchresults;
}
else {
	$from = $families_table;
	$treenamestr = "";
	if($searchstring) {
		$allwhere = "1=0" . addCriteria( "familyID", $searchstring, $frontmod );
		if( $tree ) {
			$from .= ", $trees_table";
			$allwhere = "($allwhere) AND $families_table.gedcom = \"$tree\" AND $families_table.gedcom = $trees_table.gedcom";
			$treenamestr = ", treename";
		}
	}
	else
		$allwhere = "husband = \"\" AND wife = \"\"";
	$query = "SELECT $families_table.ID as ID, familyID{$idselect}, husband, wife, marrdate, marrplace, private, living, branch, $families_table.gedcom as gedcom, changedby, DATE_FORMAT(changedate,\"%d %b %Y\") as changedatef, changedate as changedate $treenamestr
		FROM $from WHERE $allwhere ORDER BY familyID LIMIT $newoffset" . $maxsearchresults;
}
$result = tng_query($query);

$numrows = tng_num_rows( $result );
if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
	$query = "SELECT count($families_table.ID) as fcount FROM ($from)";
	if($allwhere) $query .= " WHERE $allwhere";
	$result2 = tng_query($query);
	$row = tng_fetch_assoc( $result2 );
	$totrows = $row['fcount'];
	tng_free_result($result2);
}
else
	$totrows = $numrows;

$helplang = findhelp("families_help.php");

$revstar = checkReview("F");

tng_adminheader( $admtext['families'], $flags );
?>
<script type="text/javascript">
function confirmDelete(ID) {
	if(confirm('<?php echo $admtext['confdeletefam']; ?>' ))
		deleteIt('family',ID,'<?php echo $tree; ?>');
	return false;
}
</script>
<script type="text/javascript" src="js/admin.js"></script>
</head>

<?php
	echo tng_adminlayout();

	$familytabs[0] = array(1,"admin_families.php",$admtext['search'],"findfamily");
	$familytabs[1] = array($allow_add,"admin_newfamily.php",$admtext['addnew'],"addfamily");
	$familytabs[2] = array($allow_edit,"admin_findreview.php?type=F",$admtext['review'] . $revstar,"review");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/families_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($familytabs,"findfamily",$innermenu);
	echo displayHeadline($admtext['families'],"img/families_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">

	<form action="admin_families.php" name="form1" id="form1">
	<table class="normal">
		<tr>
			<td><?php echo $admtext['searchfor']; ?>: </td>
			<td>
<?php
	include("treequery.php");
?>
				<input type="text" name="searchstring" value="<?php echo $searchstring_noquotes; ?>" class="longfield">
			</td>
			<td>
				<input type="submit" name="submit" value="<?php echo $admtext['search']; ?>" class="aligntop">
				<input type="submit" name="submit" value="<?php echo $admtext['reset']; ?>" onClick="document.form1.searchstring.value=''; document.form1.spousename.selectedIndex=0; document.form1.tree.selectedIndex=0; document.form1.exactmatch.checked=false; document.form1.living.checked=false;" class="aligntop">
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="2">
				<select name="spousename">
					<option value="husband"<?php if( $spousename == "husband") echo " selected"; ?>><?php echo $admtext['husbname']; ?></option>
					<option value="wife"<?php if( $spousename == "wife") echo " selected"; ?>><?php echo $admtext['wifename']; ?></option>
					<option value="none"<?php if( $spousename == "none") echo " selected"; ?>><?php echo $admtext['noname']; ?></option>
            	</select>
				<input type="checkbox" name="living" value="yes"<?php if( $living == "yes" ) echo " checked"; ?>> <?php echo $admtext['livingonly']; ?>
				<input type="checkbox" name="exactmatch" value="yes"<?php if( $exactmatch == "yes" ) echo " checked"; ?>> <?php echo $admtext['exactmatch']; ?>
			</td>
		</tr>
	</table>

	<input type="hidden" name="findfamily" value="1"><input type="hidden" name="newsearch" value="1">
	</form><br />

<?php
	$numrowsplus = $numrows + $offset;
	if( !$numrowsplus ) $offsetplus = 0;
	echo displayListLocation($offsetplus,$numrowsplus,$totrows);
	$pagenav = get_browseitems_nav( $totrows, "admin_families.php?searchstring=$searchstring&amp;spousename=$spousename&amp;living=$living&amp;exactmatch=$exactmatch&amp;offset", $maxsearchresults, 5 );
	echo " &nbsp; <span class=\"adminnav\">$pagenav</span></p>";
?>
	<form action="admin_deleteselected.php" method="post" name="form2">
<?php
	if( $allow_delete ) {
?>
		<p>
		<input type="button" name="selectall" value="<?php echo $admtext['selectall']; ?>" onClick="toggleAll(1);">
		<input type="button" name="clearall" value="<?php echo $admtext['clearall']; ?>" onClick="toggleAll(0);">
		<input type="submit" name="xfamaction" value="<?php echo $admtext['deleteselected']; ?>" onClick="return confirm('<?php echo addslashes($admtext['confdeleterecs']); ?>');">
		</p>
<?php
	}
?>

	<table cellpadding="4" cellspacing="1" border="0" class="normal rounded-table">
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
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['husbid']; ?></b>&nbsp;</nobr></span></td>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $fnamesort; ?></b>&nbsp;</nobr></span></td>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['wifeid']; ?></b>&nbsp;</nobr></span></td>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $mnamesort; ?></b>&nbsp;</nobr></span></td>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $marrsort; ?></b>&nbsp;</nobr></span></td>
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
			$actionstr .= "<a href=\"admin_editfamily.php?familyID=xxx&amp;tree=yyy\" title=\"{$admtext['edit']}\" class=\"smallicon admin-edit-icon\"></a>";
		if( $allow_delete )
			$actionstr .= "<a href=\"#\" onClick=\"return confirmDelete('zzz');\" title=\"{$admtext['text_delete']}\" class=\"smallicon admin-delete-icon\"></a>";
		$actionstr .= "<a href=\"" . $familygroup_url . "familyID=xxx&amp;tree=yyy\" target=\"_blank\" title=\"{$admtext['test']}\" class=\"smallicon admin-test-icon\"></a>";

		while( $row = tng_fetch_assoc($result))
		{
			$newactionstr = preg_replace( "/xxx/", $row['familyID'], $actionstr );
			$newactionstr = preg_replace( "/yyy/", $row['gedcom'], $newactionstr );
			$newactionstr = preg_replace( "/zzz/", $row['ID'], $newactionstr );
			$rights = determineLivingPrivateRights($row);
			$row['allow_living'] = $rights['living'];
			$row['allow_private'] = $rights['private'];

			$editlink = "admin_editfamily.php?familyID={$row['familyID']}&amp;tree={$row['gedcom']}";
			$id = $allow_edit ? "<a href=\"$editlink\" title=\"{$admtext['edit']}\">" . $row['familyID'] . "</a>" : $row['familyID'];

			echo "<tr id=\"row_{$row['ID']}\"><td class=\"lightback\" valign=\"top\"><div class=\"action-btns\">$newactionstr</div></td>\n";
			if($allow_delete)
				echo "<td class=\"lightback\" align=\"center\" valign=\"top\"><input type=\"checkbox\" name=\"del{$row['ID']}\" value=\"1\"></td>";
			echo "<td class=\"lightback\" valign=\"top\">$id</td>\n";
			$row2 = $row;
			$row2['firstname'] = !empty($row['p2firstname']) ? $row['p2firstname'] : "";
			$row2['lastname'] = !empty($row['p2lastname']) ? $row['p2lastname'] : "";
			$row2['lnprefix'] = !empty($row['p2lnprefix']) ? $row['p2lnprefix'] : "";
			$row2['prefix'] = !empty($row['p2prefix']) ? $row['p2prefix'] : "";
			$row2['suffix'] = !empty($row['p2suffix']) ? $row['p2suffix'] : "";
			$row2['title'] = !empty($row['p2title']) ? $row['p2title'] : "";
			$row2['nameorder'] = !empty($row['p2nameorder']) ? $row['p2nameorder'] : "";
			$rights = determineLivingPrivateRights($row2);
			$row2['allow_living'] = $rights['living'];
			$row2['allow_private'] = $rights['private'];
			if( $spousename == "husband" ) {
				$husbname = getName($row);
				$wifename = getName($row2);
			}
			else {
				$wifename = getName($row);
				$husbname = getName($row2);
			}
			echo "<td class=\"lightback\" valign=\"top\">{$row['husband']}</td>\n";
			echo "<td class=\"lightback\" valign=\"top\">$husbname</td>\n";
			echo "<td class=\"lightback\" valign=\"top\">{$row['wife']}</td>\n";
			echo "<td class=\"lightback\" valign=\"top\">$wifename</td>\n";
			echo "<td class=\"lightback\" valign=\"top\">{$row['marrdate']}<br/>{$row['marrplace']}</td>\n";
			if($numtrees > 1)
				echo "<td class=\"lightback\" valign=\"top\">" . (!empty($row['treename']) ? $row['treename'] : "") . "</td>\n";
			$changedby = $numusers > 1 ? "{$row['changedby']}: " : "";
			echo "<td class=\"lightback\" valign=\"top\">{$changedby}{$row['changedatef']}</td>\n";
			echo "</tr>\n";
		}
?>
	</table><br/>
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