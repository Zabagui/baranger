<?php
include("begin.php");
include("adminlib.php");
$textpart = "templates";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( !$allow_edit ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$query = "SELECT * FROM $templates_table WHERE id = \"$id\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
tng_free_result($result);

$helplang = findhelp("templates_help.php");

tng_adminheader( "Edit Template Message", $flags );
?>
<script type="text/javascript" src="js/admin.js"></script>
</head>

<?php
	echo tng_adminlayout();

	$setuptabs[0] = array(1,"admin_setup.php",$admtext['configuration'],"configuration");
	$setuptabs[1] = array(1,"admin_diagnostics.php",$admtext['diagnostics'],"diagnostics");
	$setuptabs[2] = array(1,"admin_setup.php?sub=tablecreation",$admtext['tablecreation'],"tablecreation");
	$setuptabs[3] = array(1,"#",$admtext['templateconfigsettings'],"template");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/templateconfig_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($setuptabs,"template",$innermenu);
	echo displayHeadline($admtext['setup'] . " &gt;&gt; " . $admtext['configuration'] . " &gt;&gt; " . $admtext['templateconfigsettings'],"img/setup_icon.gif",$menu,"");
?>

<table width="100%" border="0" cellpadding="10" cellspacing="2" class="lightback">
<tr class="databack">
<td class="tngshadow">
	<form action="admin_updatetemplatemsg.php" method="post" name="form1">
	<table class="normal">
	<tr><td>Key Name:</td><td><input type="text" name="keyname" size="50" value="<?php echo $row['keyname']; ?>"></td></tr>
	<tr><td valign="top">Value:</td><td><textarea cols="50" rows="4" name="msgvalue"><?php echo $row['value']; ?></textarea></td></tr>
	<tr><td>Language:</td><td><input type="text" name="tlanguage" size="50" value="<?php echo $row['language']; ?>"></td></tr>
	</table><br/>
	<input type="hidden" name="id" value="<?php echo "$id"; ?>">
	<input type="submit" name="submitx" class="btn" value="<?php echo $admtext['saveback']; ?>">
	<input type="submit" name="submit" accesskey="s" class="btn" value="<?php echo $admtext['savereturn']; ?>">
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="window.location.href='admin_templatemsgs.php';">
</form>
</td>
</tr>

</table>
<?php 
echo tng_adminfooter();
?>