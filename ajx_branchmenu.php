<?php
include("begin.php");
include("adminlib.php");
$textpart = "branches";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_edit || $assignedbranch ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$query = "SELECT action FROM $branches_table WHERE gedcom = \"$tree\" and branch = \"$branch\"";
$result = tng_query($query);
$brow = tng_fetch_assoc($result);
tng_free_result( $result );

header("Content-type:text/html; charset=" . $session_charset);
?>

<div style="margin:10px">
	<span class="subhead"><strong><?php echo $admtext['addlabels']; ?></strong></span><br/>

	<form action="#" method="post" id="form2" name="form2" onsubmit="return addLabels();">
	<table border="0" cellpadding="1" class="normal">
		<tr><td colspan="2"><br/><strong><?php echo $admtext['action']; ?>:</strong></td></tr>
		<tr>
			<td colspan="2">
				&nbsp;&nbsp;<input type="radio" name="branchaction" value="add" checked onClick="toggleAdd();"> <?php echo $admtext['addlabels']; ?><br/>
				&nbsp;&nbsp;<input type="radio" name="branchaction" value="clear" onClick="toggleClear(0);"> <?php echo $admtext['clearlabels']; ?><br/>
				&nbsp;&nbsp;<input type="radio" name="branchaction" value="delete" onClick="toggleClear(1);"> <?php echo $admtext['delpeople']; ?><br/>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div id="allpart" style="display:none">
				&nbsp;&nbsp;<input type="radio" name="set" value="all"> <?php echo $admtext['all']; ?>
				&nbsp;&nbsp;<input type="radio" name="set" value="partial" checked> <?php echo $admtext['partial']; ?>
				</div>
			</td>
		</tr>
		<tr id="overwrite1">
			<td><div><br/><strong><?php echo $admtext['existlabels']; ?>:</strong></div></td>
			<td>
				<div><br/>
					<select name="overwrite" id="overwrite">
					<?php
						$action = $brow['action'] ? $brow['action'] : 2;
					?>
						<option value="2" <?php if($action == 2) echo " selected=\"selected\""; ?>><?php echo $admtext['append']; ?></option>
						<option value="1" <?php if($action == 1) echo " selected=\"selected\""; ?>><?php echo $admtext['overwrite']; ?></option>
						<option value="0" <?php if($action == 0) echo " selected=\"selected\""; ?>"><?php echo $admtext['leave']; ?></option>
					</select>
				</div>
			</td>
		</tr>
		<tr><td colspan="2">
			<br/><input type="submit" id="labelsub" value="<?php echo $admtext['addlabels']; ?>">
			&nbsp; <img src="<?php echo $cms['tngpath']; ?>img/spinner.gif" style="display:none" id="labelspinner" />
		</td></tr>
	</table>

	</form>
	<div class="normal" id="branchresults"></div>
</div>