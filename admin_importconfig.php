<?php
include("begin.php");
include($subroot . "importconfig.php");
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

if( !$tngimpcfg['maxlivingage'] ) $tngimpcfg['maxlivingage'] = "110";

//for upgrading to 6
if( isset($localphotopathdisplay) && !$locimppath['photos'] ) $locimppath['photos'] = $localphotopathdisplay;
if( isset($localdocpathdisplay) && !$locimppath['histories'] ) $locimppath['histories'] = $localdocpathdisplay;
if( !isset($tngimpcfg['saveconfig']) ) $tngimpcfg['saveconfig'] = "";

$helplang = findhelp("importconfig_help.php");

tng_adminheader( $admtext['modifyimportsettings'], $flags );
?>
<script type="text/javascript" src="js/admin.js"></script>
</head>

<?php
	echo tng_adminlayout();

	$setuptabs[0] = array(1,"admin_setup.php",$admtext['configuration'],"configuration");
	$setuptabs[1] = array(1,"admin_diagnostics.php",$admtext['diagnostics'],"diagnostics");
	$setuptabs[2] = array(1,"admin_setup.php?sub=tablecreation",$admtext['tablecreation'],"tablecreation");
	$setuptabs[3] = array(1,"#",$admtext['importconfigsettings'],"import");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/importconfig_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($setuptabs,"import",$innermenu);
	echo displayHeadline($admtext['setup'] . " &gt;&gt; " . $admtext['configuration'] . " &gt;&gt; " . $admtext['importconfigsettings'],"img/setup_icon.gif",$menu,"");
?>

<div class="admin-main">
	<div class="databack admin-block">
	<form action="admin_updateimportconfig.php" method="post" name="form1" >
	<table class="normal">
		<tr><td><?php echo $admtext['gedpath']; ?>:</td>
			<td><input type="text" value="<?php echo $gedpath; ?>" name="gedpath" size="50"><input type="hidden" id="gedcom_org" value="<?php echo $gedpath; ?>"/>
			<input type="button" value="<?php echo $admtext['text_rename']; ?>" onclick="makeFolder('gedcom',document.form1.gedpath.value);">  <span id="msg_gedcom"></span></td></tr>
		<tr><td></td><td><input type="checkbox" name="saveconfig" value="1" <?php if( $tngimpcfg['saveconfig'] ) { echo "checked"; } ?>> <?php echo $admtext['saveincfg']; ?></td></tr>
		<tr><td><?php echo $admtext['rrnum']; ?>:</td><td><input type="text" value="<?php echo $tngimpcfg['rrnum']; ?>" name="rrnum" size="5"></td></tr>
		<tr><td><?php echo $admtext['progint']; ?>:</td><td><input type="text" value="<?php echo $tngimpcfg['readmsecs']; ?>" name="readmsecs" size="5"></td></tr>
		<tr>
			<td><?php echo $admtext['defimpopt']; ?>:</td>
			<td>
				<select name="defimpopt">
					<option value="1"<?php if( $tngimpcfg['defimpopt'] == 1 ) echo " selected"; ?>><?php echo $admtext['allcurrentdata']; ?></option>
					<option value="0"<?php if( !$tngimpcfg['defimpopt'] ) echo " selected"; ?>><?php echo $admtext['matchingonly']; ?></option>
					<option value="2"<?php if( $tngimpcfg['defimpopt'] == 2 ) echo " selected"; ?>><?php echo $admtext['donotreplace']; ?></option>
					<option value="3"<?php if( $tngimpcfg['defimpopt'] == 3 ) echo " selected"; ?>><?php echo $admtext['appendall']; ?></option>
				</select>
				
			</td>
		</tr>
		<tr>
			<td><?php echo $admtext['blankchangedt']; ?>:</td>
			<td>
				<select name="blankchangedt">
					<option value="0"<?php if( !$tngimpcfg['chdate'] ) echo " selected"; ?>><?php echo $admtext['usetoday']; ?></option>
					<option value="1"<?php if( $tngimpcfg['chdate'] ) echo " selected"; ?>><?php echo $admtext['useblank']; ?></option>
				</select>
				
			</td>
		</tr>
		<tr>
			<td><?php echo $admtext['nobirthdate']; ?>:</td>
			<td>
				<select name="livingreqbirth">
					<option value="0"<?php if( !$tngimpcfg['livingreqbirth'] ) echo " selected"; ?>><?php echo $admtext['persdead']; ?></option>
					<option value="1"<?php if( $tngimpcfg['livingreqbirth'] ) echo " selected"; ?>><?php echo $admtext['persliving']; ?></option>
				</select>
				
			</td>
		</tr>
		<tr><td><?php echo $admtext['nodeathdate']; ?>:</td><td><input type="text" value="<?php echo $tngimpcfg['maxlivingage']; ?>" name="maxlivingage" size="5"></td></tr>
		<tr><td><?php echo $admtext['assumepriv']; ?>:</td><td><input type="text" value="<?php echo $tngimpcfg['maxprivyrs']; ?>" name="maxprivyrs" size="5"></td></tr>
		<tr><td><?php echo $admtext['assumeliving']; ?>:</td><td><input type="text" value="<?php echo $tngimpcfg['maxdecdyrs']; ?>" name="maxdecdyrs" size="5"></td></tr>
		<tr><td><?php echo $admtext['maxmarried']; ?>:</td><td><input type="text" value="<?php echo $tngimpcfg['maxmarriedage']; ?>" name="maxmarriedage" size="5"></td></tr>
		<tr><td><?php echo $admtext['embeddedmedia']; ?>:</td><td><input type="checkbox" name="assignnames" value="yes" <?php if( $assignnames ) { echo "checked"; } ?>> <?php echo $admtext['assignnames']; ?></td></tr>
		<tr><td><?php echo $admtext['localphotopath']; ?>*:</td><td><input type="text" value="<?php echo $locimppath['photos']; ?>" name="localphotopathdisplay" class="verylongfield"></td></tr>
		<tr><td><?php echo $admtext['localdocpath']; ?>*:</td><td><input type="text" value="<?php echo $locimppath['histories']; ?>" name="localhistorypathdisplay" class="verylongfield"></td></tr>
		<tr><td><?php echo $admtext['localdocumentpath']; ?>*:</td><td><input type="text" value="<?php echo $locimppath['documents']; ?>" name="localdocumentpathdisplay" class="verylongfield"></td></tr>
		<tr><td><?php echo $admtext['localhspath']; ?>*:</td><td><input type="text" value="<?php echo $locimppath['headstones']; ?>" name="localhspathdisplay" class="verylongfield"></td></tr>
		<tr><td><?php echo $admtext['localotherpath']; ?>*:</td><td><input type="text" value="<?php echo $locimppath['other']; ?>" name="localotherpathdisplay" class="verylongfield"></td></tr>
		<tr><td><?php echo $admtext['nopathmatch']; ?>:</td><td colspan="4"><input type="radio" name="wholepath" value="1" <?php if( $wholepath ) { echo "checked"; } ?>> <?php echo $admtext['wholepath']; ?> <input type="radio" name="wholepath" value="0" <?php if( !$wholepath ) { echo "checked"; } ?>> <?php echo $admtext['justname']; ?></td></tr>
		<tr><td><?php echo $admtext['privnote']; ?>:</td><td><input type="text" value="<?php echo $tngimpcfg['privnote']; ?>" name="privnote" size="5"></td></tr>
		<tr>
			<td><?php echo $admtext['coerce']; ?>:</td>
			<td>
				<select name="coerce">
					<option value="0"<?php if( !$tngimpcfg['coerce'] ) echo " selected"; ?>><?php echo $admtext['no']; ?></option>
					<option value="1"<?php if( $tngimpcfg['coerce'] ) echo " selected"; ?>><?php echo $admtext['yes']; ?></option>
				</select>
			</td>
		</tr>
	</table><br/>&nbsp;
	<input type="submit" name="submit" class="btn" value="<?php echo $admtext['saveback']; ?>">
	<input type="submit" name="submitx" accesskey="s" class="btn" value="<?php echo $admtext['savereturn']; ?>">
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="window.location.href='admin_setup.php';">
	</form>
	<p class="normal">*<?php echo $admtext['commas']; ?></p>
	</div>
</div>
<?php 
echo tng_adminfooter();
?>