<?php
include("begin.php");
include("adminlib.php");
$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_add ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$helplang = findhelp("collections_help.php");

initMediaTypes();

header("Content-type:text/html; charset=" . $session_charset);
?>

<div class="databack normal" style="margin:10px;border:0px" id="newcollection">
<p class="subhead"><strong><?php echo $admtext['addnewcoll']; ?></strong> |
	<a href="#" onclick="return openHelp('<?php echo $helplang; ?>/collections_help.php');"><?php echo $admtext['help']; ?></a></p>

<form action="admin_addcollection.php" method="post" name="collform" id="collform" onsubmit="return addCollection(this);">
<table border="0" cellpadding="2" class="normal">
	<tr><td><?php echo $admtext['collid']; ?>:</td><td><input type="text" name="collid" class="veryshortfield" onblur="if(!$('exportas').value) $('exportas').value = this.value.toUpperCase();"/></td></tr>
	<tr><td><?php echo $admtext['collexpas']; ?>:</td><td><input type="text" name="exportas" id="exportas" class="veryshortfield" value="PHOTO" /></td></tr>
	<tr><td><?php echo $admtext['colldisplay']; ?>:</td><td><input type="text" name="display" size="30"/></td></tr>
	<tr><td><?php echo $admtext['collpath']; ?>:</td><td><input type="text" name="path" size="50"/></td></tr>
	<tr><td>&nbsp;</td><td><input type="button" value="<?php echo $admtext['makefolder']; ?>" onclick="if(document.collform.path.value){makeFolder('newcoll',document.collform.path.value);}"/> <span id="msg_newcoll"></span></td></tr>
	<tr><td><?php echo $admtext['localpath']; ?>:</td><td><input type="text" name="localpath" size="50" value="<?php if( isset($row['localpath']) ) echo $row['localpath']; ?>"></td></tr>
	<tr><td><?php echo $admtext['collicon']; ?>:</td><td><input type="text" name="icon" size="30" value="img/" /></td></tr>
	<tr><td><?php echo $admtext['collthumb']; ?>:</td><td><input type="text" name="thumb" size="30" value="img/" /></td></tr>
	<tr><td><?php echo $admtext['displayorder']; ?>:</td><td><input type="text" name="ordernum" size="5"/></td></tr>
	<tr><td><?php echo $admtext['colllike']; ?>:</td>
		<td>
			<span class="normal">
			<select name="liketype">
<?php
	foreach( $mediatypes as $mediatype ) {
		if(!$mediatype['type']) {
			$msgID = $mediatype['ID'];
			echo "	<option value=\"$msgID\">" . $mediatype['display'] . "</option>\n";
		}
	}
?>
			</select>
			</span>
		</td>
	</tr>
</table>

<input type="hidden" name="field" value="<?php echo "$field"; ?>">
<input type="submit" value="<?php echo $admtext['save']; ?>">
<input type="button" name="cancel" value="<?php echo $text['cancel']; ?>" onclick="tnglitbox.remove();"> <span id="cerrormsg" style="color:#CC0000;display:none"><?php echo $admtext['cidexists']; ?></span>
</form>
</div>
