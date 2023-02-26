<?php
include("begin.php");
include("adminlib.php");
$textpart = "notes";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include($cms['tngpath'] . "checklogin.php");

$query = "SELECT $xnotes_table.note as note, $xnotes_table.ID as xID, secret, $notelinks_table.gedcom as gedcom, persfamID, eventID FROM $notelinks_table,  $xnotes_table
	WHERE $notelinks_table.xnoteID = $xnotes_table.ID AND $notelinks_table.gedcom = $xnotes_table.gedcom AND $notelinks_table.ID = \"$noteID\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
tng_free_result($result);

if( (!$allow_edit && (!$allow_add || !$added)) || ( $assignedtree && $assignedtree != $row['gedcom'] ) ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$row['note'] = str_replace("&","&amp;",$row['note']);
$row['note'] = preg_replace("/\"/", "&#34;",$row['note']);

$helplang = findhelp("notes_help.php");
header("Content-type:text/html; charset=" . $session_charset);
?>
<form action="" name="form3" onSubmit="return updateNote(this);">
<div style="float:right;text-align:center">
    <input type="submit" name="submit" class="btn" value="<?php echo $admtext['save']; ?>">
    <p><a href="#" onclick="gotoSection('editnote','notelist');"><?php echo $text['cancel']; ?></a></p>
</div>
<p class="subhead"><strong><?php echo $admtext['modifynote']; ?></strong> |
	<a href="#" onclick="return openHelp('<?php echo $helplang; ?>/notes_help.php');"><?php echo $admtext['help']; ?></a></p>

<table border="0" cellpadding="2" class="normal">
	<tr><td valign="top"><?php echo $admtext['note']; ?>:</td>
	<td><textarea wrap cols="60" rows="25" name="note" id="currnote"><?php echo $row['note']; ?></textarea></td></tr>
<?php
	if($allow_private_notes) {
?>
	<tr><td>&nbsp;</td>
	<td>
<?php
	echo "<input type=\"checkbox\" name=\"private\" value=\"1\"";
	 if( $row['secret'] ) echo " checked";
	 echo "> " . $admtext['text_private'];
?>
	</td></tr>
<?php
	}
?>
</table><br/>
<input type="hidden" name="xID" value="<?php echo $row['xID']; ?>">
<input type="hidden" name="ID" value="<?php echo $noteID; ?>">
<input type="hidden" name="tree" value="<?php echo $row['gedcom']; ?>">
<input type="hidden" name="persfamID" value="<?php echo $row['persfamID']; ?>">
<input type="hidden" name="eventID" value="<?php echo $row['eventID']; ?>">
</form>
