<?php
include("begin.php");
include("adminlib.php");
$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_edit ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$query = "SELECT * FROM $mediatypes_table WHERE mediatypeID = \"$mediatypeID\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
tng_free_result($result);

$exportas = $row['exportas'];
if(!$exportas) {
	$exportas = strtoupper($mediatypeID);
	if(substr($exportas,-1) == "S")
		$exportas = substr($exportas,0,-1);
	if($exportas == "HISTORIE") $exportas = "HISTORY";
}

$helplang = findhelp("collections_help.php");

initMediaTypes();

header("Content-type:text/html; charset=" . $session_charset);
?>

<div class="databack normal" style="margin:10px;border:0px" id="editcollection">
<p class="subhead"><strong><?php echo $admtext['editcoll']; ?></strong> |
	<a href="#" onclick="return openHelp('<?php echo $helplang; ?>/collections_help.php');"><?php echo $admtext['help']; ?></a></p>

<form action="admin_updatecollection.php" method="post" name="collform" id="collform" onsubmit="return updateCollection(this);">
<table border="0" cellpadding="2" class="normal">
	<tr><td><?php echo $admtext['collid']; ?>:</td><td><?php echo $mediatypeID; ?></td></tr>
	<tr><td><?php echo $admtext['collexpas']; ?>:</td><td><input type="text" name="exportas" id="exportas" class="veryshortfield" value="<?php echo $exportas; ?>"/></td></tr>
	<tr><td><?php echo $admtext['colldisplay']; ?>:</td><td><input type="text" name="display" size="30" value="<?php echo $row['display']; ?>"></td></tr>
	<tr><td><?php echo $admtext['collpath']; ?>:</td><td><input type="text" name="path" size="50" value="<?php echo $row['path']; ?>"><input type="hidden" id="newcoll_org" value="<?php echo $row['path']; ?>"/></td></tr>
	<tr><td>&nbsp;</td><td><input type="button" value="<?php echo $admtext['makefolder']; ?>" onclick="if(document.collform.path.value){makeFolder('newcoll',document.collform.path.value);}"> <span id="msg_newcoll"></span></td></tr>
	<tr><td><?php echo $admtext['localpath']; ?>:</td><td><input type="text" name="localpath" size="50" value="<?php echo $row['localpath']; ?>"></td></tr>
	<tr><td><?php echo $admtext['collicon']; ?>:</td><td><input type="text" name="icon" size="30" value="<?php echo $row['icon']; ?>"></td></tr>
	<tr><td><?php echo $admtext['collthumb']; ?>:</td><td><input type="text" name="thumb" size="30" value="<?php echo $row['thumb']; ?>"></td></tr>
	<tr><td><?php echo $admtext['displayorder']; ?>:</td><td><input type="text" name="ordernum" size="5" value="<?php echo $row['ordernum']; ?>"></td></tr>
	<tr><td><?php echo $admtext['colllike']; ?>:</td>
		<td>
			<span class="normal">
			<select name="liketype">
<?php
	foreach( $mediatypes as $mediatype ) {
		if(!$mediatype['type']) {
			$msgID = $mediatype['ID'];
			echo "	<option value=\"$msgID\"";
			if( $msgID == $row['liketype'] ) echo " selected";
			echo ">" . $mediatype['display'] . "</option>\n";
		}
	}
?>
			</select>
			</span>
		</td>
	</tr>
</table>

<input type="hidden" name="collid" size="30" value="<?php echo $mediatypeID; ?>">
<input type="hidden" name="field" value="<?php echo $field; ?>">
<input type="hidden" name="selidx" value="<?php echo $selidx; ?>">
<input type="submit" value="<?php echo $admtext['save']; ?>">
<input type="button" name="cancel" value="<?php echo $text['cancel']; ?>" onclick="tnglitbox.remove();">
</form>
</div>