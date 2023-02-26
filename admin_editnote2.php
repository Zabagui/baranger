<?php
include("begin.php");
include("adminlib.php");
$textpart = "notes";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

$query = "SELECT $xnotes_table.note as note, secret, $notelinks_table.gedcom as gedcom, $notelinks_table.ID as nID FROM ($notelinks_table, $xnotes_table)
	WHERE $notelinks_table.xnoteID = $xnotes_table.ID AND $notelinks_table.gedcom = $xnotes_table.gedcom AND $xnotes_table.ID = \"$ID\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
tng_free_result($result);

if( !$allow_edit || ( $assignedtree && $assignedtree != $row['gedcom'] ) ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$row['note'] = str_replace("&","&amp;",$row['note']);
$row['note'] = preg_replace("/\"/", "&#34;",$row['note']);

$helplang = findhelp("misc_help.php");

tng_adminheader( $admtext['modifynote'], $flags );
?>
<script type="text/javascript">
function validateForm(form) {
	var rval = true;
	if( form.note.value.length == 0 ) {
		alert("<?php echo $admtext['enternote']; ?>");
		rval = false;
	}
	return rval;
}	
</script>
</head>

<?php
	echo tng_adminlayout();

	$misctabs[0] = array(1,"admin_notelist.php",$admtext['notes'],"notes");
	$misctabs[1] = array($allow_edit,"#",$admtext['edit'],"edit");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/notes2_help.php#add');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($misctabs,"edit",$innermenu);
	echo displayHeadline($admtext['modifynote'],"img/misc_icon.gif",$menu,$message);
?>

<div class="admin-main">
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="adm-rounded-table">
<tr>
<td class="tngshadow databack">
	<form action="admin_updatenote2.php" name="form2" method="post" onSubmit="return validateForm(this);">
	<table border="0" cellpadding="2" class="normal">
		<tr><td valign="top"><?php echo $admtext['note']; ?>:</td>
		<td><textarea wrap cols="80" rows="30" name="note"><?php echo $row['note']; ?></textarea></td></tr>
		<tr><td>&nbsp;</td>
		<td>
	<?php
		echo "<input type=\"checkbox\" name=\"private\" value=\"1\"";
		 if( $row['secret'] ) echo " checked";
		 echo "> " . $admtext['text_private'];
	?>
		</td></tr>
	</table><br/>
	<input type="hidden" name="ID" value="<?php echo $row['nID']; ?>">
	<input type="hidden" name="xID" value="<?php echo $ID; ?>">
	<input type="hidden" name="gedcom" value="<?php echo $row['gedcom']; ?>">
	<input type="submit" name="submitx" class="btn" value="<?php echo $admtext['saveback']; ?>">
	<input type="submit" name="submit" accesskey="s" class="btn" value="<?php echo $admtext['savereturn']; ?>">
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="window.location.href='admin_notelist.php';">
	</form>
</td>
</tr>

</table>
</div>
<?php 
echo tng_adminfooter();
?>