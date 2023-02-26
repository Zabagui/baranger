<?php
include("begin.php");
include($subroot . "logconfig.php");
include("adminlib.php");
$textpart = "setup";
//include("getlang.php");
include("$mylanguage/admintext.php");


if( $link ) {
	$admin_login = 1;
	include("checklogin.php");
	include("version.php");

	if( $assignedtree || !$allow_edit ) {
		$message = $admtext['norights'];
		header( "Location: admin_login.php?message=" . urlencode($message) );
		exit;
	}

	$query = "SELECT gedcom, treename FROM $trees_table ORDER BY treename";
	$result = @tng_query($query);
}
else
	$result = false;

$helplang = findhelp("logconfig_help.php");
if( !isset($logsaveconfig) ) $logsaveconfig = "";

tng_adminheader( $admtext['modifylogsettings'], $flags );
?>
</head>

<?php
	echo tng_adminlayout();

	$setuptabs[0] = array(1,"admin_setup.php",$admtext['configuration'],"configuration");
	$setuptabs[1] = array(1,"admin_diagnostics.php",$admtext['diagnostics'],"diagnostics");
	$setuptabs[2] = array(1,"admin_setup.php?sub=tablecreation",$admtext['tablecreation'],"tablecreation");
	$setuptabs[3] = array(1,"#",$admtext['logconfigsettings'],"log");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/logconfig_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($setuptabs,"log",$innermenu);
	echo displayHeadline($admtext['setup'] . " &gt;&gt; " . $admtext['configuration'] . " &gt;&gt; " . $admtext['logconfigsettings'],"img/setup_icon.gif",$menu,"");
?>

<div class="admin-main">
	<div class="databack admin-block">
	<form action="admin_updatelogconfig.php" method="post" name="form1">
	<table class="normal">
		<tr><td><?php echo $admtext['logfilename'] . " " . $admtext['text_public']; ?>:</td><td><input type="text" value="<?php echo $logname; ?>" name="logname" size="20"></td></tr>
		<tr><td><?php echo $admtext['logfilename'] . " " . $admtext['admin']; ?>:</td><td><input type="text" value="<?php echo $adminlogfile; ?>" name="adminlogfile" size="20"></td></tr>
		<tr><td></td><td><input type="checkbox" name="logsaveconfig" value="1" <?php if( $logsaveconfig ) { echo "checked"; } ?>> <?php echo $admtext['saveincfg']; ?></td></tr>
		<tr><td><?php echo $admtext['maxloglines'] . " " . $admtext['text_public']; ?>:</td><td><input type="text" value="<?php echo $maxloglines; ?>" name="maxloglines" size="5"></td></tr>
		<tr><td><?php echo $admtext['maxloglines'] . " " . $admtext['admin']; ?>:</td><td><input type="text" value="<?php echo $adminmaxloglines; ?>" name="adminmaxloglines" size="5"></td></tr>
		<tr><td><?php echo $admtext['badhosts']; ?>*:</td><td><input type="text" value="<?php echo $badhosts; ?>" name="badhosts" size="80"></td></tr>
		<tr><td><?php echo $admtext['exusers']; ?>*:</td><td><input type="text" value="<?php echo $exusers; ?>" name="exusers" size="80"></td></tr>
		<tr><td colspan="2"><br /><?php echo $admtext['blockemail']; ?><br /><br /></td></tr>
		<tr><td><?php echo $admtext['addrcontains']; ?>*:</td><td><input type="text" value="<?php echo $addr_exclude; ?>" name="addr_exclude" size="80"></td></tr>
		<tr><td><?php echo $admtext['msgcontains']; ?>*:</td><td><input type="text" value="<?php echo $msg_exclude; ?>" name="msg_exclude" size="80"></td></tr>
	</table><br/>&nbsp;
	<input type="submit" name="submit" class="btn" value="<?php echo $admtext['saveback']; ?>">
	<input type="submit" name="submitx" accesskey="s" class="btn" value="<?php echo $admtext['savereturn']; ?>">
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="window.location.href='admin_setup.php';">
	</form>
	<p><span class="normal">*<?php echo $admtext['commas']; ?></span></p>
	</div>
</div>
<?php 
echo tng_adminfooter();
?>
