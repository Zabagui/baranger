<?php
include("begin.php");
include($subroot . "mapconfig.php");
include("adminlib.php");
$textpart = "notes";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

$exptime = 0;

$searchstring_noquotes = isset($searchstring) ? stripslashes(preg_replace("/\"/", "&#34;",$searchstring)) : "";
$searchstring = isset($searchstring) ? addslashes($searchstring) : "";
if(!isset($private)) $private = "";

if( !empty($newsearch) ) {
	setcookie("tng_search_notes_post[search]", $searchstring_noquotes, $exptime);
	setcookie("tng_tree", $tree, $exptime);
	setcookie("tng_search_notes_post[tngpage]", 1, $exptime);
	setcookie("tng_search_notes_post[offset]", 0, $exptime);
	setcookie("tng_search_notes_post[private]", $private, $exptime);
}
else  {
	if( empty($searchstring) ) {
		$searchstring_noquotes = isset($_COOKIE['tng_search_notes_post']['search']) ? $_COOKIE['tng_search_notes_post']['search'] : "";
		$searchstring = preg_replace("/&#34;/", "\\\"", $searchstring_noquotes);
	}
	if( $allow_private_notes && empty($private) )
		$private = isset($_COOKIE['tng_search_notes_post']['private']) ? $_COOKIE['tng_search_notes_post']['private'] : "";
	if( empty($tree) )
		$tree = isset($_COOKIE['tng_tree']) ? $_COOKIE['tng_tree'] : "";
	if( !isset($offset) ) {
		$tngpage = isset($_COOKIE['tng_search_notes_post']['tngpage']) ? $_COOKIE['tng_search_notes_post']['tngpage'] : 1;
		$offset = isset($_COOKIE['tng_search_notes_post']['offset']) ? $_COOKIE['tng_search_notes_post']['offset'] : 0;
	}
	else {
		if( !isset($tngpage) ) $tngpage = 1;
		setcookie("tng_search_notes_post[tngpage]", $tngpage, $exptime);
		setcookie("tng_search_notes_post[offset]", $offset, $exptime);
	}
}

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
	$tree = $assignedtree;
	$wherestr = "WHERE gedcom = \"$assignedtree\"";
}
else
	$wherestr = "";
$treequery = "SELECT gedcom, treename FROM $trees_table $wherestr ORDER BY treename";

$wherestr = "WHERE $xnotes_table.ID = $notelinks_table.xnoteID";

if( $tree )
	$wherestr .= " AND $xnotes_table.gedcom = \"$tree\"";

if($allow_private_notes) {
	if( !isset($private) ) $private = "";
	if( $private == "yes" )
		$wherestr .= " AND $notelinks_table.secret != 0";
}
else
	$wherestr .= " AND $notelinks_table.secret != 1";

if($searchstring) {
	$wherestr .= $wherestr ? " AND" : "WHERE";
	$wherestr .= " ($xnotes_table.note LIKE \"%".$searchstring."%\")";
}

$query = "SELECT $xnotes_table.ID as ID, $xnotes_table.note as note, $notelinks_table.persfamID as personID, $xnotes_table.gedcom as gedcom, secret
	FROM ($xnotes_table, $notelinks_table)" . $wherestr . " ORDER BY note LIMIT $newoffset" . $maxsearchresults;

$result = tng_query($query);

$numrows = tng_num_rows( $result );
if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
	$query = "SELECT count($xnotes_table.ID) as scount FROM ($xnotes_table, $notelinks_table) " . $wherestr;
	$result2 = tng_query($query);
	$row = tng_fetch_assoc( $result2 );
	$totrows = $row['scount'];
	tng_free_result($result2);
}
else
	$totrows = $numrows;

$helplang = findhelp("notes_help.php");

tng_adminheader( $admtext['notes'], $flags );
?>
<script type="text/javascript">
function validateForm( ) {
	var rval = true;
	if( document.form1.searchstring.value.length == 0 ) {
		alert("<?php echo $admtext['entersearchvalue']; ?>");
		rval = false;
	}
	return rval;
}

function confirmDelete(ID) {
	if(confirm('<?php echo $admtext['confdeletenote']; ?>' ))
		deleteIt('note',ID);
	return false;
}

function resetForm() {
	document.form1.searchstring.value='';
	document.form1.tree.selectedIndex=0;
	document.form1.private.value='';
}
</script>
<script type="text/javascript" src="js/admin.js"></script>
</head>

<?php
	echo tng_adminlayout();

	$misctabs[0] = array(1,"admin_notelist.php",$admtext['notes'],"notes");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/notes2_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($misctabs,"notes",$innermenu);
	echo displayHeadline($admtext['notes'],"img/misc_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">

	<form action="admin_notelist.php" name="form1" id="form1">
	<table class="normal">
		<tr>
			<td><?php echo $admtext['searchfor']; ?>: </td>
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
				<input type="submit" name="submit" value="<?php echo $admtext['reset']; ?>" onClick="resetForm();" class="aligntop">
			</td>
		</tr>
<?php
	if($allow_private_notes) {
?>
		<tr>
			<td>&nbsp;</td><td><input type="checkbox" name="private" value="yes"<?php if( $private == "yes" ) echo " checked"; ?>> <?php echo $admtext['text_private']; ?></td>
		</tr>
<?php
	}
?>
		</table>

	<input type="hidden" name="newsearch" value="1">
	</form><br />

<?php
	$numrowsplus = $numrows + $offset;
	if( !$numrowsplus ) $offsetplus = 0;
	echo displayListLocation($offsetplus,$numrowsplus,$totrows);
	$pagenav = get_browseitems_nav( $totrows, "admin_notelist.php?searchstring=$searchstring_noquotes&amp;offset", $maxsearchresults, 5 );
	echo " &nbsp; <span class=\"adminnav\">$pagenav</span></p>";
?>
	<form action="admin_deleteselected.php" method="post"  name="form2">
<?php
	if( $allow_delete ) {
?>
		<p>
		<input type="button" name="selectall" value="<?php echo $admtext['selectall']; ?>" onClick="toggleAll(1);">
		<input type="button" name="clearall" value="<?php echo $admtext['clearall']; ?>" onClick="toggleAll(0);">
  		<input type="submit" name="xnoteaction" value="<?php echo $admtext['deleteselected']; ?>" onClick="return confirm('<?php echo addslashes($admtext['confdeleterecs']); ?>');">
  		</p>
<?php
	}
?>

	<table cellpadding="3" cellspacing="1" border="0" class="normal rounded-table">
		<tr>
			<td class="fieldnameback fieldname"><nobr>&nbsp;<b><?php echo $admtext['action']; ?></b>&nbsp;</nobr></td>
<?php
	if($allow_delete) {
?>
			<td class="fieldnameback fieldname"><nobr>&nbsp;<b><?php echo $admtext['select']; ?></b>&nbsp;</nobr></td>
<?php
	}
?>
			<td class="fieldnameback fieldname"><nobr>&nbsp;<b><?php echo $admtext['note']; ?></b>&nbsp;</nobr></td>
<?php
	if (!$tree) {
?>
			<td class="fieldnameback fieldname"><nobr>&nbsp;<b><?php echo $admtext['tree']; ?></b>&nbsp;</nobr></td>
<?php
	}
?>
			<td class="fieldnameback fieldname"><nobr>&nbsp;<b><?php echo $admtext['linkedto']; ?></b>&nbsp;</nobr></td>
		</tr>
<?php
	if( $numrows ) {
		$actionstr = "";
		if( $allow_edit )
			$actionstr .= "<a href=\"admin_editnote2.php?ID=xxx\" title=\"{$admtext['edit']}\" class=\"smallicon admin-edit-icon\"></a>";
		if( $allow_delete )
			$actionstr .= "<a href=\"#\" onClick=\"return confirmDelete('xxx');\" title=\"{$admtext['text_delete']}\" class=\"smallicon admin-delete-icon\"></a>";

		while( $nrow = tng_fetch_assoc($result))
		{
			$noneliving = $noneprivate = $noneprivatenotes = 1;

			$notelinktext = "";
			$treetext="";
			if(!$tree) {
				$query = "SELECT treename FROM " . $trees_table . " WHERE gedcom = \"{$nrow['gedcom']}\"";
				$result2 = tng_query($query);
				$row2 = tng_fetch_assoc($result2);
				$treetext = "<td valign='top' class='lightback'>".$row2['treename']."</td>";
				tng_free_result($result2);
			}

			if(!$notelinktext) {
				$query = "SELECT * FROM $people_table WHERE personID = \"{$nrow['personID']}\" AND gedcom = \"{$nrow['gedcom']}\"";
				$result2 = tng_query($query);
				if(tng_num_rows($result2) == 1) {
					$row2 = tng_fetch_assoc($result2);
					$note_righttree = checktree($row2['gedcom']);
					$note_rightbranch = $note_righttree ? checkbranch($row2['branch']) : false;
					$nrights = determineLivingPrivateRights($row2, $note_righttree, $note_rightbranch);
					$row2['allow_living']  = $nrights['living'];
					$row2['allow_private'] = $nrights['private'];
					$row2['allow_private_notes'] = $nrights['private_notes'];

					if(!$row2['allow_living']) $noneliving = 0;
					if(!$row2['allow_private']) $noneprivate = 0;
					if(!$row2['allow_private_notes'] && $nrow['secret'] == 1) $noneprivatenotes = 0;

					$notelinktext .= "<li><a href=\"getperson.php?personID={$row2['personID']}&amp;tree={$row2['gedcom']}\" target='_blank'>" . getNameRev($row2) . "</a> ({$row2['personID']})</li>\n";
					tng_free_result($result2);
				}
			}

			if(!$notelinktext) {
				$query = "SELECT * FROM $families_table WHERE familyID = \"{$nrow['personID']}\" AND gedcom = \"{$nrow['gedcom']}\"";
				$result2 = tng_query($query);
				if(tng_num_rows($result2) == 1) {
					$row2 = tng_fetch_assoc($result2);
					$note_righttree = checktree($row2['gedcom']);
					$note_rightbranch = $note_righttree ? checkbranch($row2['branch']) : false;
					$nrights = determineLivingPrivateRights($row2, $note_righttree, $note_rightbranch);
					$row2['allow_living']  = $nrights['living'];
					$row2['allow_private'] = $nrights['private'];
					$row2['allow_private_notes'] = $nrights['private_notes'];

					if(!$row2['allow_living']) $noneliving = 0;
					if(!$row2['allow_private']) $noneprivate = 0;
					if(!$row2['allow_private_notes'] && $nrow['secret'] == 1) $noneprivatenotes = 0;

					$notelinktext .= "<li><a href=\"familygroup.php?familyID={$row2['familyID']}&amp;tree={$nrow['gedcom']}\" target='_blank'>{$admtext['family']}</a> ({$row2['familyID']})</li>\n";
					tng_free_result($result2);
				}
			}

			if(!$notelinktext) {
				$query = "SELECT * FROM $sources_table WHERE sourceID = \"{$nrow['personID']}\" AND gedcom = \"{$nrow['gedcom']}\"";
				$result2 = tng_query($query);
				if(tng_num_rows($result2) == 1) {
					$row2 = tng_fetch_assoc($result2);
					$notelinktext .= "<li><a href=\"showsource.php?sourceID={$row2['sourceID']}&amp;tree={$row2['gedcom']}\" target='_blank'>{$admtext['source']} ({$row2['sourceID']})</a></li>\n";
					tng_free_result($result2);
				}
			}

			if(!$notelinktext) {
				$query = "SELECT * FROM $repositories_table WHERE repoID = \"{$nrow['personID']}\" AND gedcom = \"{$nrow['gedcom']}\"";
				$result2 = tng_query($query);
				if(tng_num_rows($result2) == 1) {
					$row2 = tng_fetch_assoc($result2);
					$notelinktext .= "<li><a href=\"showrepo.php?repoID={$row2['repoID']}&amp;tree={$row2['gedcom']}\" target='_blank'>{$admtext['repository']} ({$row2['repoID']})</a></li>\n";
					tng_free_result($result2);
				}
			}

			if( $noneliving && $noneprivate && $noneprivatenotes ) {
				$newactionstr = preg_replace( "/xxx/", $nrow['ID'], $actionstr );
				echo "<tr id=\"row_{$nrow['ID']}\"><td class=\"lightback\"><div class=\"action-btns2\">$newactionstr</div></td>\n";
				$delcheckbox = $allow_delete ? "<input type=\"checkbox\" name=\"del{$nrow['ID']}\" value=\"1\">" : "";
				$notetext = cleanIt($nrow['note']);
				$notetext = truncateIt($notetext,500);
				if(!$notetext) $notetext = "&nbsp;";
			}
			else {
				echo "<tr id=\"row_{$nrow['ID']}\"><td class=\"lightback\"><div class=\"action-btns2\"></div></td>\n";
				$delcheckbox = "";
				$notetext = $admtext['text_private'];
				if(!$noneprivatenotes || !$noneprivate) {
					$notetext = $notelinktext = $admtext['text_private'];
				}
				elseif(!$noneliving)
					$notetext = $text['living'];
			}
			if($allow_delete)
				echo "<td class=\"lightback\" align=\"center\">$delcheckbox</td>";
			echo "<td valign=\"top\" class=\"lightback\">$notetext</td>\n";
			echo $treetext;
			echo "<td valign=\"top\" nowrap class=\"lightback\">\n<ul>\n$notelinktext\n</ul>\n</td></tr>\n";
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