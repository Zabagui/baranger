<?php
include("begin.php");
include("adminlib.php");
$textpart = "templates";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( $assignedtree ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}


$query = "SELECT * FROM $templates_table WHERE template = \"$templatenum\"";
$result = tng_query($query);

$helplang = findhelp("templateconfig_help.php");

tng_adminheader( $admtext['modifytemplatesettings'], $flags );
?>
<script type="text/javascript">
function confirmDelete(id) {
	if(confirm('Are you sure you want to delete this variable?' ))
		deleteIt('msg',id);
	return false;
}
</script>
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
	<div class="normal">

	<form name="addmsg" action="admin_addtemplatemsg.php" method="post">
		<table cellpadding="3" cellspacing="1" border="0" class="normal">
			<tr>
				<td>Key:</td>
				<td><input type="text" name="keyname" size="20"/></td>
			</tr>
			<tr>
				<td>Value:</td>
				<td><textarea cols="50" rows="4" name="msgvalue"></textarea></td>
			</tr>
			<tr>
				<td>Language:</td>
				<td><input type="text" name="tlanguage" size="20"/></td>
			</tr>
		</table>
		<input type="submit" name="submit" accesskey="s" class="btn" value="<?php echo $admtext['save']; ?>">
	</form>
	<br/>

	<table cellpadding="3" cellspacing="1" border="0" class="normal">
		<tr>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['action']; ?></b>&nbsp;</nobr></span></td>
			<td class="fieldnameback fieldname nw">&nbsp;<b>Key</b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b>Value</b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b>Language</b>&nbsp;</td>
		</tr>
	
<?php
		while( $row = tng_fetch_assoc($result)) {
			$actionstr = "";
			if( $allow_edit )
				$actionstr .= "<a href=\"admin_edittemplatemsg.php?id=xxx\" title=\"{$admtext['edit']}\" class=\"smallicon admin-edit-icon\"></a>";
			if( $allow_delete )
				$actionstr .= "<a href=\"#\" onClick=\"return confirmDelete('xxx');\" title=\"{$admtext['text_delete']}\" class=\"smallicon admin-delete-icon\"></a>";
			$newactionstr = preg_replace( "/xxx/", $row['id'], $actionstr );
			echo "<tr id=\"row_{$row['id']}\"><td class=\"lightback\" valign=\"top\"><div class=\"action-btns2\">$newactionstr</div></td>\n";
			echo "<td class=\"lightback\" valign=\"top\" nowrap>&nbsp;{$row['keyname']}&nbsp;</td>\n";
			echo "<td class=\"lightback\" valign=\"top\">&nbsp;{$row['value']}&nbsp;</td>\n";
			echo "<td class=\"lightback\" valign=\"top\">&nbsp;{$row['language']}&nbsp;</td>\n";
			echo "</tr>\n";
		}
?>
	</table>
<?php
  	tng_free_result($result);
?>

	</div>
</td>
</tr>

</table>
<?php 
echo tng_adminfooter();
?>