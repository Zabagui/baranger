<?php
include("begin.php");
include("adminlib.php");
$textpart = "language";
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

$query = "SELECT * FROM $languages_table WHERE languageID = \"$languageID\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
tng_free_result($result);

$helplang = findhelp("languages_help.php");

tng_adminheader( $admtext['modifylanguage'], $flags );
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
	$langtabs[2] = array($allow_edit,"#",$admtext['edit'],"edit");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/languages_help.php#add');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($langtabs,"edit",$innermenu);
	echo displayHeadline($admtext['languages'] . " &gt;&gt; " . $admtext['modifylanguage'], "img/languages_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">
	<form action="admin_updatelanguage.php" method="post" name="form1" onSubmit="return validateForm();">
	<table class="normal">
	<tr>
		<td><?php echo $admtext['langfolder']; ?>:</td>
		<td>
			<select name="folder">
<?php
	@chdir($rootpath . $endrootpath . $languages_path);
	if( $handle = @opendir('.') ) {
		$dirs = array();
		while ($filename = readdir( $handle )) {
			if(is_dir($filename) && $filename != '..' && $filename != '.' && $filename != '@eaDir')
				array_push($dirs, $filename);
		}
		natcasesort( $dirs );
		$found_current = 0;
		foreach( $dirs as $dir ) {
			echo "<option value=\"$dir\"";
			if($dir == $row['folder']) {
				echo " selected=\"selected\"";
				$found_current = 1;
			}
			echo ">$dir</option>\n";
		}
		if(!$found_current)
			echo "<option value=\"{$row['folder']}\" selected=\"selected\">{$row['folder']}</option>\n";
		closedir( $handle );
	}
?>
			</select>
		</td>
	</tr>
	<tr><td><?php echo $admtext['langdisplay']; ?>:</td><td><input type="text" name="display" size="50" value="<?php echo $row['display']; ?>"></td></tr>
	<tr><td><?php echo $admtext['charset']; ?>:</td><td><input type="text" name="langcharset" size="30" value="<?php echo $row['charset']; ?>"></td></tr>
	<tr>
		<td><?php echo $admtext['norels']; ?>:</td>
		<td>
			<select name="langnorels">
				<option value=""<?php if( !$row['norels'] ) echo " selected"; ?>><?php echo $admtext['no']; ?></option>
				<option value="1"<?php if( $row['norels'] ) echo " selected"; ?>><?php echo $admtext['yes']; ?></option>
			</select>
		</td>
	</tr>
	</table><br/>
	<input type="hidden" name="languageID" value="<?php echo "$languageID"; ?>">
	<input type="submit" name="submitx" class="btn" value="<?php echo $admtext['saveback']; ?>">
	<input type="submit" name="submit" accesskey="s" class="btn" value="<?php echo $admtext['savereturn']; ?>">
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="window.location.href='admin_languages.php';">
	</form>
	</div>
</div>
<?php 
echo tng_adminfooter();
?>