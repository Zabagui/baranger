<?php
include("begin.php");
include("adminlib.php");
$textpart = "notes";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include($cms['tngpath'] . "checklogin.php");

$query = "SELECT $eventtypes_table.eventtypeID, tag, display FROM $events_table 
	LEFT JOIN  $eventtypes_table on $eventtypes_table.eventtypeID = $events_table.eventtypeID 
	WHERE eventID=\"$eventID\"";
$eventtypes = tng_query($query);
$eventtype = tng_fetch_assoc( $eventtypes );

if(!empty($eventtype['display'])) {
	$dispvalues = explode( "|", $eventtype['display'] );
	$numvalues = count( $dispvalues );
	if( $numvalues > 1 ) {
		$displayval = "";
		for( $i = 0; $i < $numvalues; $i += 2 ) {
			$lang = $dispvalues[$i]; 
			if( $mylanguage == $languages_path . $lang ) {
				$eventtypedesc = $dispvalues[$i+1];
				break;
			}
		}
	}
	else
		$eventtypedesc = $eventtype['display'];
}
elseif(!empty($eventtype['tag']))
	$eventtypedesc = $eventtype['tag'];
elseif( $eventID ) {
	$eventtypedesc = $admtext[$eventID];
}
else
	$eventtypedesc = $admtext['general'];
tng_free_result($eventtypes);

$helplang = findhelp("notes_help.php");

header("Content-type:text/html; charset=" . $session_charset);

$wherestr = !$allow_private_notes ? " AND $notelinks_table.secret != \"1\"" : "";
$query = "SELECT $notelinks_table.ID as ID, $xnotes_table.note as note, noteID, secret FROM ($notelinks_table, $xnotes_table)
    WHERE $notelinks_table.xnoteID = $xnotes_table.ID AND $notelinks_table.gedcom = $xnotes_table.gedcom
        AND persfamID=\"$persfamID\" AND $notelinks_table.gedcom =\"$tree\" AND eventID = \"$eventID\" $wherestr ORDER BY ordernum, ID";
$notelinks = tng_query($query);
$notecount = tng_num_rows( $notelinks );
?>

<div class="databack ajaxwindow" id="notelist"<?php if(!$notecount) echo " style=\"display:none\""; ?>>
<form name="form1">
<p class="subhead"><strong><?php echo "{$admtext['notes']}: $eventtypedesc"; ?></strong> |
	<a href="#" onclick="return openHelp('<?php echo $helplang; ?>/notes_help.php');"><?php echo $admtext['help']; ?></a></p>
<p>
<?php if( $allow_add ) { ?>
	<input type="button" value="  <?php echo $admtext['addnew']; ?>  " onclick="document.form2.reset();gotoSection('notelist','addnote');" />&nbsp;
<?php } ?>
	<input type="button" value="  <?php echo $admtext['finish']; ?>  " onclick="tnglitbox.remove();" />
</p>
		<table id="notestbl" class="fieldname normal" cellpadding="3" cellspacing="1" border="0"<?php if(!$notecount) echo " style=\"display:none\""; ?>>
		<tbody id="notestblbody">
		<tr>
			<td class="fieldnameback" width="50"><b><?php echo $admtext['text_sort']; ?></b></td>
			<td class="fieldnameback" width="80"><b><?php echo $admtext['action']; ?></b></td>
			<td class="fieldnameback" width="435"><b><?php echo $admtext['note']; ?></b></td>
		</tr>
		</tbody>
		</table>
	<div id="notes" width="460">
<?php
	if( $notelinks && $notecount ) {

		while ( $note = tng_fetch_assoc( $notelinks ) ) {
			$citquery = "SELECT citationID FROM $citations_table WHERE gedcom = \"$tree\" AND ";
			if($note['noteID'])
				$citquery .= "((persfamID = \"$persfamID\" AND eventID = \"N{$note['ID']}\") OR persfamID = \"{$note['noteID']}\")";
			else
				$citquery .= "persfamID = \"$persfamID\" AND eventID = \"N{$note['ID']}\"";
			$citresult = tng_query($citquery) or die ($text['cannotexecutequery'] . ": $citquery");
			$citesicon = tng_num_rows($citresult) ? "admin-cite-on-icon" : "admin-cite-off-icon";
			tng_free_result($citresult);

			$note['note'] = cleanIt($note['note']);
			if($note['secret'])
				$note['note'] = "[{$admtext['private']}] " . $note['note'];
			$truncated = truncateIt($note['note'],75);
			$actionstr = $allow_edit ? "<a href=\"#\" onclick=\"return editNote({$note['ID']});\" title=\"{$admtext['edit']}\" class=\"smallicon admin-edit-icon\"></a>" : "";
			$actionstr .= $allow_delete ? "<a href=\"#\" onclick=\"return deleteNote({$note['ID']},'$persfamID','$tree','$eventID');\" title=\"{$admtext['text_delete']}\" class=\"smallicon admin-delete-icon\"></a>" : "";
			$actionstr .= "<a href=\"#\" onclick=\"return showCitationsInside('N{$note['ID']}','{$note['noteID']}', '$persfamID');\" title=\"{$admtext['sources']}\" id=\"citesiconN{$note['ID']}\" class=\"smallicon $citesicon\"></a>";
			echo "<div class=\"sortrow\" id=\"notes_{$note['ID']}\">";
			echo "<table class=\"normal\" cellpadding=\"3\" cellspacing=\"1\" border=\"0\">";
			echo "<tr id=\"row_{$note['ID']}\">";
			echo "<td class=\"lightback dragarea\"><img src=\"img/admArrowUp.gif\" alt=\"\"><br/><img src=\"img/admArrowDown.gif\" alt=\"\"></td>";
			echo "<td class=\"lightback\" width=\"80\">$actionstr</td>";
			echo "<td class=\"lightback\" width=\"435\">$truncated</td>";
			echo "</tr></table></div>\n";
		}
		tng_free_result($notelinks);
	}
?>
	</div>
</form>
</div>

<div class="databack ajaxwindow"<?php if($notecount) echo " style=\"display:none\""; ?> id="addnote">
<form action="" name="form2" onSubmit="return addNote(this);">
<div style="float:right;text-align:center">
    <input type="submit" name="submit" class="btn" value="<?php echo $admtext['save']; ?>">
    <p><a href="#" onclick="gotoSection('addnote','notelist');"><?php echo $text['cancel']; ?></a></p>
</div>
<p class="subhead"><strong><?php echo $admtext['addnewnote']; ?></strong> |
	<a href="#" onclick="return openHelp('<?php echo $helplang; ?>/notes_help.php');"><?php echo $admtext['help']; ?></a></p>

<table border="0" cellpadding="2" class="normal">
	<tr><td valign="top"><?php echo $admtext['note']; ?>:</td>
	<td><textarea wrap cols="60" rows="25" name="note" id="newnote"></textarea></td></tr>
<?php
	if($allow_private_notes) {
?>
	<tr><td>&nbsp;</td><td><input type="checkbox" name="private" value="1"> <?php echo $admtext['text_private']; ?></td></tr>
<?php
	}
?>
</table><br/>
<input type="hidden" name="persfamID" value="<?php echo $persfamID; ?>" />
<input type="hidden" name="tree" value="<?php echo $tree; ?>" />
<input type="hidden" name="eventID" value="<?php echo $eventID; ?>" />
</form>
</div>

<div class="databack ajaxwindow" style="display:none;" id="editnote">
</div>

<div style="display:none;" id="citationslist">
</div>