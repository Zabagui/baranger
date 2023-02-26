<?php
include("begin.php");
include("adminlib.php");
$textpart = "people";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

$query = "SELECT firstname, lastname, lnprefix, nameorder, prefix, suffix, title, branch, living, private, gedcom FROM $people_table
	WHERE personID=\"$personID\" AND gedcom=\"$tree\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );

$namestr = "";
if($row) {
	$righttree = checktree($tree);
	$rightbranch = $righttree ? checkbranch($row['branch']) : false;
	$rights = determineLivingPrivateRights($row, $righttree, $rightbranch);
	$row['allow_living'] = $rights['living'];
	$row['allow_private'] = $rights['private'];

	$namestr = getName($row);
}

tng_free_result($result);

$helplang = findhelp("assoc_help.php");
$dims = "width=\"20\" height=\"20\" border=\"0\" vspace=\"0\" hspace=\"2\"";

header("Content-type:text/html; charset=" . $session_charset);

$query = "SELECT assocID, passocID, relationship, reltype FROM $assoc_table WHERE personID=\"$personID\" AND gedcom=\"$tree\"";
$assocresult = tng_query($query);
$assoccount = tng_num_rows( $assocresult );
?>

<div class="databack ajaxwindow" id="associations"<?php if(!$assoccount) echo " style=\"display:none\""; ?>>
<form name="assocform">
<p class="subhead"><strong><?php echo $admtext['associations'] . ": $namestr"; ?></strong> |
	<a href="#" onclick="return openHelp('<?php echo $helplang; ?>/assoc_help.php');"><?php echo $admtext['help']; ?></a></p>
<p>
<?php if( $allow_add ) { ?>
	<input type="button" value="  <?php echo $admtext['addnew']; ?>  " onclick="document.newassocform1.reset();assocType='I';gotoSection('associations','addassociation');" />&nbsp;
<?php } ?>
	<input type="button" value="  <?php echo $admtext['finish']; ?>  " onclick="tnglitbox.remove();" />
</p>
		<table id="associationstbl" width="95%" class="normal" cellpadding="3" cellspacing="1" border="0"<?php if(!$assoccount) echo " style=\"display:none\""; ?>>
		<tbody id="associationstblbody">
		<tr>
			<td class="fieldnameback fieldname"><nobr>&nbsp;<b><?php echo $admtext['action']; ?></b>&nbsp;</nobr></td>
			<td class="fieldnameback fieldname" width="85%"><nobr>&nbsp;<b><?php echo $admtext['description']; ?></b>&nbsp;</nobr></td>
		</tr>
<?php
	if( $assocresult && $assoccount ) {
		while ( $assoc = tng_fetch_assoc( $assocresult ) ) {
			//run query for name or family
			$assoc['allow_living'] = 1;
			if($assoc['reltype'] == "I") {
				$query = "SELECT firstname, lastname, lnprefix, nameorder, prefix, suffix, title, birthplace, birthdate, birthdatetr, deathplace, deathdate, altbirthdate, altbirthdatetr, altbirthplace, burialdate, living, private, branch, gedcom FROM $people_table WHERE personID=\"{$assoc['passocID']}\" AND gedcom=\"$tree\"";
				$nameresult = tng_query($query);
				$row = tng_fetch_assoc($nameresult);
				$rights = determineLivingPrivateRights($row);
				$row['allow_living'] = $rights['living'];
				$row['allow_private'] = $rights['private'];
				$assocname = getName($row) . " ({$assoc['passocID']})";
				tng_free_result($nameresult);
			}
			else {
				$query = "SELECT husband, wife, gedcom, familyID, living, private FROM $families_table WHERE familyID=\"{$assoc['passocID']}\" AND gedcom=\"$tree\"";
				$nameresult = tng_query($query);
				$row = tng_fetch_assoc($nameresult);
				$rights = determineLivingPrivateRights($row);
				$row['allow_living'] = $rights['living'];
				$row['allow_private'] = $rights['private'];
				$assocname = getFamilyName($row);
				tng_free_result($nameresult);
			}
			$assocname .= ": " . $assoc['relationship'];
			$assocname = cleanIt($assocname);
			$truncated = truncateIt($assocname,75);
			$actionstr = $allow_edit ? "<a href=\"#\" onclick=\"return editAssociation({$assoc['assocID']}, '{$tree}');\" title=\"{$admtext['edit']}\" class=\"smallicon admin-edit-icon\"></a>" : "";
			$actionstr .= $allow_delete ? "<a href=\"#\" onclick=\"return deleteAssociation({$assoc['assocID']},'$personID','{$assoc['assocID']}','$tree');\" title=\"{$admtext['text_delete']}\" class=\"smallicon admin-delete-icon\"></a>" : "";
			echo "<tr id=\"row_{$assoc['assocID']}\"><td class=\"lightback\">$actionstr</td><td class=\"lightback\">$truncated</td></tr>\n";
		}
		tng_free_result($assocresult);
	}
?>
		</tbody>
		</table>
</form>
</div>

<div class="databack ajaxwindow"<?php if($assoccount) echo " style=\"display:none\""; ?> id="addassociation">
<p class="subhead"><strong><?php echo $admtext['addnewassoc']; ?></strong> |
	<a href="#" onclick="return openHelp('<?php echo $helplang; ?>/assoc_help.php#add', 'newwindow', 'height=500,width=700,resizable=yes,scrollbars=yes'); newwindow.focus();"><?php echo $admtext['help']; ?></a></p>

<form action="" name="newassocform1" onSubmit="return addAssociation(this);">
<table width="95%" border="0" cellpadding="2" class="normal">
	<tr>
		<td colspan="2">
			<input type="radio" name="reltype" value="I" checked="checked" onclick="activateAssocType('I');"/> <?php echo $admtext['person']; ?> &nbsp;&nbsp;
			<input type="radio" name="reltype" value="F" onclick="activateAssocType('F');"/> <?php echo $admtext['family']; ?>
		</td>
	</tr>
	<tr><td><span id="person_label"><?php echo $admtext['personid']; ?></span><span id="family_label" style="display:none"><?php echo $admtext['familyid']; ?></span>:</td>
		<td valign="top"><input type="text" name="passocID" id="passocID"> &nbsp;<?php echo $admtext['text_or']; ?>&nbsp;
		<a href="#" onclick="return findItem(assocType,'passocID',null,'<?php echo $tree; ?>','<?php echo $assignedbranch; ?>');" title="<?php echo $admtext['find']; ?>"><img src="img/tng_find.gif" title="<?php echo $admtext['find']; ?>" alt="<?php echo $admtext['find']; ?>" class="alignmiddle" <?php echo $dims; ?>></a></td>
	</tr>
	<tr><td><?php echo $admtext['relationship']; ?>:</td><td><input type="text" name="relationship" size="60"></td></tr>
	<tr><td colspan="2"><input type="checkbox" name="revassoc" value="1"> <?php echo $admtext['revassoc']; ?>:</td></tr>
</tr>
</table>
<input type="hidden" name="personID" value="<?php echo $personID; ?>" />
<input type="hidden" name="orgreltype" value="<?php echo $orgreltype; ?>" />
<input type="hidden" name="tree" value="<?php echo $tree; ?>" />
<input type="submit" name="submit" class="btn" value="<?php echo $admtext['save']; ?>" />
<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onclick="gotoSection('addassociation','associations');" />
</form>
<br />
</div>

<div class="databack ajaxwindow" style="display:none;" id="editassociation">
</div>