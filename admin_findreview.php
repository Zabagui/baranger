<?php
include("begin.php");
include("adminlib.php");
$textpart = "review";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = true;
include("checklogin.php");
include("version.php");

if(!isset($tree)) $tree = "";
if(!isset($reviewuser)) $reviewuser = "";

if( $type == "I" ) {
	$tng_search_preview = $_SESSION['tng_search_preview'] = 1;
	if(!empty($newsearch)) {
		$_SESSION['tng_search_preview_post']['tree'] = $tree;
		$_SESSION['tng_search_preview_post']['user'] = $reviewuser;
		$_SESSION['tng_search_preview_post']['page'] = 1;
		$_SESSION['tng_search_preview_post']['offset'] = 0;
	}
	else {
		if( !$tree )
			$tree = isset($_SESSION['tng_search_preview_post']['tree']) ? $_SESSION['tng_search_preview_post']['tree'] : "";
		if( !$reviewuser )
			$reviewuser = isset($_SESSION['tng_search_preview_post']['user']) ? $_SESSION['tng_search_preview_post']['user'] : "";
		if( !isset($offset) ) {
			$page = isset($_SESSION['tng_search_preview_post']['page']) ? $_SESSION['tng_search_preview_post']['page'] : 1;
			$offset = isset($_SESSION['tng_search_preview_post']['offset']) ? $_SESSION['tng_search_preview_post']['offset'] : 0;
		}
		else {
			$page = isset($_SESSION['tng_search_freview_post']['page']) ? $_SESSION['tng_search_freview_post']['page'] : 1;
			$offset = isset($_SESSION['tng_search_freview_post']['offset']) ? $_SESSION['tng_search_freview_post']['offset'] : 0;
		}
	}
	$helplang = findhelp("people_help.php");
}
else { //$type == F
	$tng_search_preview = $_SESSION['tng_search_preview'] = 1;
	if(!empty($newsearch)) {
		$_SESSION['tng_search_freview_post']['tree'] = $tree;
		$_SESSION['tng_search_freview_post']['user'] = $reviewuser;
		$_SESSION['tng_search_freview_post']['page'] = 1;
		$_SESSION['tng_search_freview_post']['offset'] = 0;
	}
	else {
		if( !$tree )
			$tree = isset($_SESSION['tng_search_freview_post']['tree']) ? $_SESSION['tng_search_freview_post']['tree'] : "";
		if( !$reviewuser )
			$reviewuser = isset($_SESSION['tng_search_freview_post']['user']) ? $_SESSION['tng_search_freview_post']['user'] : "";
		if( !isset($offset) ) {
			$page = isset($_SESSION['tng_search_freview_post']['page']) ? $_SESSION['tng_search_freview_post']['page'] : 1;
			$offset = isset($_SESSION['tng_search_freview_post']['offset']) ? $_SESSION['tng_search_freview_post']['offset'] : 0;
		}
		else {
			$_SESSION['tng_search_freview_post']['page'] = $page;
			$_SESSION['tng_search_freview_post']['offset'] = $offset;
		}
	}
	$helplang = findhelp("families_help.php");
}
$orgtree = $tree;

if(!isset($offset)) $offset = 0;
if( $offset ) {
	$offsetplus = $offset + 1;
	$newoffset = "$offset, ";
}
else {
	$offsetplus = 1;
	$newoffset = "";
	$page = 1;
}

if( $assignedtree ) {
	$wherestr = "WHERE gedcom = \"$assignedtree\"";
	$tree = $assignedtree;
}
else
	$wherestr = "";
$treequery = "SELECT gedcom, treename FROM $trees_table $wherestr ORDER BY treename";

$allwhere = "$temp_events_table.gedcom = $trees_table.gedcom";
if( $tree )
	$allwhere .= " AND $temp_events_table.gedcom = \"$tree\"";

if( $assignedbranch )
	$allwhere .= " AND branch LIKE \"%$assignedbranch%\"";
if( $reviewuser != "" )
	$allwhere .= " AND user = \"$reviewuser\"";

if( $type == "I" ) {
	$allwhere .= " AND $people_table.personID = $temp_events_table.personID AND $people_table.gedcom = $temp_events_table.gedcom AND (type = \"I\" OR type = \"C\")";
	$query = "SELECT tempID, $temp_events_table.personID as personID, lastname, firstname, lnprefix, prefix, suffix, nameorder, treename, eventID, DATE_FORMAT(postdate,\"%d %b %Y %H:%i:%s\") as postdate, living, private, $people_table.gedcom, branch
		FROM $people_table, $trees_table, $temp_events_table WHERE $allwhere ORDER BY postdate DESC";
	$returnpage = "people.php";
	$totquery = "SELECT count(tempID) as tcount FROM $people_table, $trees_table, $temp_events_table WHERE $allwhere";
}
elseif( $type == "F" ) {
	$allwhere .= " AND $families_table.familyID = $temp_events_table.familyID AND $families_table.gedcom = $temp_events_table.gedcom AND type = \"F\"";
	$query = "SELECT tempID, $temp_events_table.familyID as familyID, $families_table.gedcom as gedcom, husband, wife, treename, eventID, DATE_FORMAT(postdate,\"%d %b %Y %H:%i:%s\") as postdate
		FROM $families_table, $trees_table, $temp_events_table WHERE $allwhere ORDER BY postdate DESC";
	$returnpage = "families.php";
	$totquery = "SELECT count(tempID) as tcount FROM $families_table, $trees_table, $temp_events_table WHERE $allwhere";
}
$result = tng_query($query);

$numrows = tng_num_rows( $result );
if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
	$result2 = tng_query($totquery) or die ($admtext['cannotexecutequery'] . ": $totquery");
	$row = tng_fetch_assoc( $result2 );
	$totrows = $row['tcount'];
	tng_free_result($result2);
}
else
	$totrows = $numrows;

tng_adminheader( $admtext['review'], $flags );
?>
<script type="text/javascript">
function confirmDelete(ID) {
	if(confirm('<?php echo $admtext['confdeleteevent']; ?>' ))
		deleteIt('tevent',ID);
	return false;
}
</script>
<script type="text/javascript" src="js/admin.js"></script>
</head>

<?php
	echo tng_adminlayout();

	if( $type == "I" ) {
		$icon = "img/people_icon.gif";
		$hmsg = $admtext['people'];
		$peopletabs[0] = array(1,"admin_people.php",$admtext['search'],"findperson");
		$peopletabs[1] = array($allow_add,"admin_newperson.php",$admtext['addnew'],"addperson");
		$peopletabs[2] = array($allow_edit,"admin_findreview.php?type=I",$admtext['review'],"review");
		$peopletabs[3] = array($allow_edit && $allow_delete,"admin_merge.php",$admtext['merge'],"merge");
	}
	else {
		$icon = "img/families_icon.gif";
		$hmsg = $admtext['families'];
		$peopletabs['0'] = array(1,"admin_families.php",$admtext['search'],"findperson");
		$peopletabs['1'] = array($allow_add,"admin_newfamily.php",$admtext['addnew'],"addfamily");
		$peopletabs['2'] = array($allow_edit,"admin_findreview.php?type=F",$admtext['review'],"review");
	}

	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/people_help.php#review');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($peopletabs,"review",$innermenu);
	echo displayHeadline("$hmsg &gt;&gt; {$admtext['review']}",$icon,$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">
	<p class="subhead"><strong><?php echo $admtext['selectevaction']; ?></strong></p>
	<div class="normal">
	<form action="admin_findreview.php" name="form1">
	<table>
		<tr>
			<td><span class="normal"><?php echo $admtext['user'];?>:</span></td>
			<td>
				<select name="reviewuser">
<?php
echo "	<option value=\"\">{$admtext['allusers']}</option>\n";
$query = "SELECT username, description FROM $users_table ORDER BY description";
$userresult = tng_query($query);
while( $userrow = tng_fetch_assoc($userresult) ) {
	echo "	<option value=\"{$userrow['username']}\"";
	if( $userrow['username'] == $reviewuser ) echo " selected";
	echo ">{$userrow['description']}</option>\n";
}
tng_free_result($userresult);
?>
				</select>
			</td>
			<td>&nbsp;</td>
		</tr>
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
				<input type="submit" name="submit" value="<?php echo $admtext['reset']; ?>" onClick="document.form1.reviewuser.value=''; document.form1.tree.selectedIndex=0; document.form1.living.checked=false; document.form1.exactmatch.checked=false;" class="aligntop">
			</td>
		</tr>
	</table>
	<input type="hidden" name="type" value="<?php echo $type; ?>">
	<input type="hidden" name="newsearch" value="1">
	</form><br />

<?php
	$numrowsplus = $numrows + $offset;
	if( !$numrowsplus ) $offsetplus = 0;
	echo "<p>{$admtext['matches']}: $offsetplus {$text['to']} $numrowsplus {$text['of']} $totrows";
	$pagenav = get_browseitems_nav( $totrows, "admin_findreview.php?type=$type&amp;reviewuser=$reviewuser&amp;offset", $maxsearchresults, 5 );
	echo " &nbsp; $pagenav</p>";
?>
	<table cellpadding="3" cellspacing="1" border="0" class="normal rounded-table">
		<tr>
			<td class="fieldnameback fieldname"><nobr>&nbsp;<b><?php echo $admtext['action']; ?></b>&nbsp;</nobr></td>
			<td class="fieldnameback fieldname"><nobr>&nbsp;<b><?php echo $admtext['id']; ?></b>&nbsp;</nobr></td>
			<td class="fieldnameback fieldname"><nobr>&nbsp;<b><?php echo $admtext['name']; ?></b>&nbsp;</nobr></td>
			<td class="fieldnameback fieldname"><nobr>&nbsp;<b><?php echo $admtext['event']; ?></b>&nbsp;</nobr></td>
			<td class="fieldnameback fieldname"><nobr>&nbsp;<b><?php echo $admtext['postdate']; ?></b>&nbsp;</nobr></td>
			<td class="fieldnameback fieldname"><nobr>&nbsp;<b><?php echo $admtext['tree']; ?></b>&nbsp;</nobr></td>
		</tr>
	
<?php
$actionstr = "<a href=\"admin_review.php?tempID=xxx\" title=\"{$admtext['review']}\" class=\"smallicon admin-edit-icon\"></a>";
if( $allow_delete )
	$actionstr .= "<a href=\"#\" onclick=\"return confirmDelete('xxx');\" title=\"{$admtext['text_delete']}\" class=\"smallicon admin-delete-icon\"></a>";

while( $row = tng_fetch_assoc($result))
{
	if( is_numeric( $row['eventID'] ) ) {
		$query = "SELECT display, $eventtypes_table.eventtypeID as eventtypeID, tag FROM $eventtypes_table, $events_table WHERE eventID = {$row['eventID']} AND $eventtypes_table.eventtypeID = $events_table.eventtypeID";
		$evresult = tng_query($query);
		$evrow = tng_fetch_assoc( $evresult );
		
		if( $evrow['display'] ) {
			$dispvalues = explode( "|", $evrow['display'] );
			$numvalues = count( $dispvalues );
			if( $numvalues > 1 ) {
				$displayval = "";
				for( $i = 0; $i < $numvalues; $i += 2 ) {
					$lang = $dispvalues[$i];
					if( $mylanguage == $languages_path . $lang ) {
						$displayval = $dispvalues[$i+1];
						break;
					}
				}
			}
			else
				$displayval = $evrow['display'];
		}
		elseif( $evrow['tag'] )
			$displayval = $eventtype['tag'];
		else {
			$displayval = $admtext[$eventID];
		}
	}
	else {
		$eventID = $row['eventID'];
		$displayval = $admtext[$eventID];
	}
	if( $type == "I" ) {
		$rights = determineLivingPrivateRights($row);
		$row['allow_living'] = $rights['living'];
		$row['allow_private'] = $rights['private'];
		$name = getName($row);
		$persfamID = $row['personID'];
	}
	elseif( $type == "F" ) {
		$hname = $wname = "";
		if( $row['husband'] ) {
			$query = "SELECT firstname, lastname, lnprefix, nameorder, prefix, suffix, living, private, gedcom, branch FROM $people_table WHERE personID = \"{$row['husband']}\" AND gedcom = \"{$row['gedcom']}\"";
			$hresult = tng_query($query);
			$prow = tng_fetch_assoc( $hresult );
			tng_free_result($hresult);
			$prights = determineLivingPrivateRights($prow);
			$prow['allow_living'] = $prights['living'];
			$prow['allow_private'] = $prights['private'];
			$hname = getName( $prow );
		}
		if( $row['wife'] ) {
			$query = "SELECT firstname, lastname, lnprefix, nameorder, prefix, suffix, living, private, gedcom, branch FROM $people_table WHERE personID = \"{$row['wife']}\" AND gedcom = \"{$row['gedcom']}\"";
			$wresult = tng_query($query);
			$prow = tng_fetch_assoc( $wresult );
			tng_free_result($wresult);
			$prights = determineLivingPrivateRights($prow);
			$prow['allow_living'] = $prights['living'];
			$prow['allow_private'] = $prights['private'];
			$wname = getName( $prow );
		}
		$plus = $hname && $wname ? " + " : "";
		$name = "$hname$plus$wname";
		$persfamID = $row['familyID'];
	}
	$newactionstr = preg_replace( "/xxx/", $row['tempID'], $actionstr );
	echo "<tr id=\"row_{$row['tempID']}\"><td class=\"lightback\" valign=\"top\"><span class=\"normal\"><nobr>$newactionstr</nobr></span></td>\n";
	echo "<td class=\"lightback\" valign=\"top\"><span class=\"normal\">&nbsp;$persfamID&nbsp;</span></td>\n";
	echo "<td class=\"lightback\" valign=\"top\"><span class=\"normal\">&nbsp;$name&nbsp;</span></td>\n";
	echo "<td class=\"lightback\" valign=\"top\"><span class=\"normal\">&nbsp;$displayval&nbsp;</span></td>\n";
	echo "<td class=\"lightback\" valign=\"top\"><span class=\"normal\">&nbsp;{$row['postdate']}&nbsp;</span></td>\n";
	echo "<td class=\"lightback\" valign=\"top\"><span class=\"normal\">&nbsp;{$row['treename']}&nbsp;</span></td></tr>\n";
}
tng_free_result($result);

?>
	</table>
<?php
	echo "<p>{$admtext['matches']}: $offsetplus {$text['to']} $numrowsplus {$text['of']} $totrows";
	echo " &nbsp; $pagenav</p>";
?>
	</div>
</div>

<?php 
echo tng_adminfooter();
?>