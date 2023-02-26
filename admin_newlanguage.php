<?php
include("begin.php");
include("adminlib.php");
$textpart = "language";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( !$allow_add ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$helplang = findhelp("languages_help.php");

tng_adminheader( $admtext['addnewlanguage'], $flags );
?>
<script type="text/javascript" src="js/admin.js"></script>
<script type="text/javascript">
function validateForm( ) {
	var rval = true;
	if( document.form1.folder.value.length == 0 ) {
		alert("<?php echo $admtext['enterlangfolder']; ?>");
		rval = false;
	}
	else if( document.form1.display.value.length == 0 ) {
		alert("<?php echo $admtext['enterlangdisplay']; ?>");
		rval = false;
	}
	return rval;
}	
</script>
</head>

<?php
	echo tng_adminlayout();

	$langtabs[0] = array(1,"admin_languages.php",$admtext['search'],"findlang");
	$langtabs[1] = array($allow_add,"admin_newlanguage.php",$admtext['addnew'],"addlanguage");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/languages_help.php#add');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($langtabs,"addlanguage",$innermenu);
	echo displayHeadline($admtext['languages'] . " &gt;&gt; " . $admtext['addnewlanguage'],"img/languages_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">
	<form action="admin_addlanguage.php" method="post" name="form1" onSubmit="return validateForm();">
	<table class="normal">
	<tr>
		<td><?php echo $admtext['langfolder']; ?>:</td>
		<td>
			<select name="folder">
				<option value=""></option>
<?php
	@chdir($rootpath . $endrootpath . $languages_path);
	if( $handle = @opendir('.') ) {
		$dirs = array();
		while ($filename = readdir( $handle )) {
			if(is_dir($filename) && $filename != '..' && $filename != '.' && $filename != '@eaDir')
				array_push($dirs, $filename);
		}
		natcasesort( $dirs );
		foreach( $dirs as $dir ) {
			echo "<option value=\"$dir\">$dir</option>\n";
		}
		closedir( $handle );
	}
?>
			</select>
		</td>
	</tr>
	<tr><td><?php echo $admtext['langdisplay']; ?>:</td><td><input type="text" name="display" size="50"></td></tr>
	<tr><td><?php echo $admtext['charset']; ?>:</td><td><input type="text" name="langcharset" size="30" value="<?php echo $session_charset; ?>"></td></tr>
	<tr>
		<td><?php echo $admtext['norels']; ?>:</td>
		<td>
			<select name="langnorels">
				<option value=""><?php echo $admtext['no']; ?></option>
				<option value="1"><?php echo $admtext['yes']; ?></option>
			</select>
		</td>
	</tr>
	</table><br/>
	<input type="submit" name="submitx" class="btn" value="<?php echo $admtext['saveback']; ?>">
	<input type="submit" name="submit" accesskey="s" class="btn" value="<?php echo $admtext['savereturn']; ?>">
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="window.location.href='admin_languages.php';">
	</form>
	</div>
</div>
<?php 
echo tng_adminfooter();
?>