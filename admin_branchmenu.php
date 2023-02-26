<?php
include("begin.php");
include("adminlib.php");
$textpart = "branches";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( !$allow_edit || $assignedbranch ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$query = "SELECT treename FROM $trees_table WHERE gedcom = \"$tree\"";
$result = tng_query($query);
$row = tng_fetch_assoc($result);
tng_free_result( $result );

$query = "SELECT description FROM $branches_table WHERE gedcom = \"$tree\" and branch = \"$branch\"";
$result = tng_query($query);
$brow = tng_fetch_assoc($result);
tng_free_result( $result );

$query = "SELECT count(persfamID) as pcount FROM $branchlinks_table WHERE gedcom = \"$tree\" AND branch = \"$branch\"";
$result = tng_query($query);
$prow = tng_fetch_assoc($result);
$pcount = $prow['pcount'];
tng_free_result($result);

$helplang = findhelp("branches_help.php");

tng_adminheader( $admtext['labelbranches'], $flags );
?>
<script type="text/javascript" src="js/selectutils.js"></script>
<script type="text/javascript">
var tree = "<?php echo $tree; ?>";
function toggleClear(option) {
	jQuery('#overwrite1').fadeOut(300);
	jQuery('#overwrite2').fadeOut(300);
	jQuery('#allpart').fadeIn(300);
	jQuery('#labelsub').val(option ? "<?php echo $admtext['text_delete']; ?>" : "<?php echo $admtext['clearlabels']; ?>");
}

function toggleAdd() {
	jQuery('#overwrite1').fadeIn(300);
	jQuery('#overwrite2').fadeIn(300);
	jQuery('#allpart').fadeOut(300);
	document.form1.set[1].checked = true;
	jQuery('#labelsub').val('<?php echo $admtext['addlabels']; ?>');
	togglePartial();
}

function confirmDelete() {
	return confirm("<?php echo $admtext['confbrdel']; ?>") ? validateForm() : false;
}

function toggleAll() {
	jQuery('#startind1').fadeOut(300);
	jQuery('#startind2').fadeOut(300);
	jQuery('#startind3').fadeOut(300);
	jQuery('#numgens1').fadeOut(300);
	jQuery('#numgens2').fadeOut(300);
	jQuery('#numgens3').fadeOut(300);
	jQuery('#numgens4').fadeOut(300);
	jQuery('#numgens5').fadeOut(300);
}

function togglePartial() {
	jQuery('#startind1').fadeIn(300);
	jQuery('#startind2').fadeIn(300);
	jQuery('#startind3').fadeIn(300);
	jQuery('#numgens1').fadeIn(300);
	jQuery('#numgens2').fadeIn(300);
	jQuery('#numgens3').fadeIn(300);
	jQuery('#numgens4').fadeIn(300);
	jQuery('#numgens5').fadeIn(300);
}

function validateForm() {
	var rval = true;
	var option = true;

	if(jQuery('#labelsub').val() == "<?php echo $admtext['text_delete']; ?>")
		option = confirm("<?php echo $admtext['confbrdel']; ?>");

	if(option) {
		if( document.form1.set[1].checked ) {
			if( document.form1.personID.value.length == 0 ) {
				alert("<?php echo $admtext['enterstartingind']; ?>");
				rval = false;
			}
			else if( isNaN( document.form1.agens.value ) || isNaN( document.form1.dgens.value ) ) {
				alert("<?php echo $admtext['gensnumeric']; ?>");
				rval = false;
			}
		}
		return rval;
	}
	else
		return false;
}
</script>
</head>

<?php
	echo tng_adminlayout();

	$branchtabs[0] = array(1,"admin_branches.php",$admtext['search'],"findbranch");
	$branchtabs[1] = array($allow_add,"admin_newbranch.php",$admtext['addnew'],"addbranch");
	$branchtabs[2] = array($allow_edit,"#",$admtext['labelbranches'],"label");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/branches_help.php#labelbranch');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($branchtabs,"label",$innermenu);
	echo displayHeadline($admtext['branches'] . " &gt;&gt; " . $admtext['labelbranches'],"img/branches_icon.gif",$menu,$message);
?>

<table width="100%" border="0" cellpadding="10" cellspacing="2" class="lightback">
<tr class="databack">
<td class="tngshadow">
	<form action="admin_branchlabels.php" method="post"  id="form1" name="form1" onSubmit="return validateForm();">
	<table border="0" cellpadding="1" class="normal">
		<tr>
			<td><strong><?php echo $admtext['tree']; ?>:</strong></td>
			<td><?php echo $row['treename']; ?><input type="hidden" name="tree" value="<?php echo $tree; ?>"></td>
		</tr>
		<tr>
			<td valign="top"><strong><?php echo $admtext['branch']; ?>:</strong></td>
			<td valign="top"><?php echo $brow['description'] . "<br />({$admtext['people']} + {$admtext['families']} = $pcount*)"; ?><input type="hidden" name="branch" value="<?php echo $branch; ?>"></td>
		</tr>
		<tr><td colspan="2"><br/><strong><?php echo $admtext['action']; ?>:</strong></td></tr>
		<tr>
			<td colspan="2">
				&nbsp;&nbsp;<input type="radio" name="branchaction" value="add" checked onClick="toggleAdd();"> <?php echo $admtext['addlabels']; ?>
				&nbsp;&nbsp;<input type="radio" name="branchaction" value="clear" onClick="toggleClear(0);"> <?php echo $admtext['clearlabels']; ?>
				&nbsp;&nbsp;<input type="radio" name="branchaction" value="delete" onClick="toggleClear(1);"> <?php echo $admtext['delpeople']; ?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div id="allpart" style="display:none">
				&nbsp;&nbsp;<input type="radio" name="set" value="all" onClick="toggleAll();"> <?php echo $admtext['all']; ?>
				&nbsp;&nbsp;<input type="radio" name="set" value="partial" checked onClick="togglePartial();"> <?php echo $admtext['partial']; ?>
				</div>
			</td>
		</tr>
		<tr><td colspan="2"><div id="startind1"><br/><strong><?php echo $text['startingind']; ?>:</strong></div></td></tr>
		<tr>
			<td><div id="startind2">&nbsp;&nbsp;<?php echo $admtext['personid']; ?>: </div></td>
			<td><table id="startind3" class="normal"><tr><td><input type="text" name="personID" id="personID" size="10"> &nbsp;<?php echo $admtext['text_or']; ?>&nbsp;</td>
				<td><a href="#" onclick="return findItem('I','personID','','<?php echo $tree; ?>','<?php echo $assignedbranch; ?>');" title="<?php echo $admtext['find']; ?>" class="smallicon admin-find-icon"></a></td>
			</tr></table></td>
		</tr>
		<tr>
			<td colspan="2"><div id="numgens1"><br/><strong><?php echo $admtext['numgenerations']; ?>:</strong></div></td>
		</tr>
		<tr>
			<td><div id="numgens2">&nbsp;&nbsp;<?php echo $admtext['ancestors']; ?>: </div></td>
			<td><div id="numgens3"><input type="text" name="agens" size="3" maxlength="3" value="0"> &nbsp;&nbsp; <?php echo $admtext['descofanc']; ?>:
				<select name="dagens">
					<option value="0">0</option>
					<option value="1" selected="selected">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
				</div></td>
		</tr>
		<tr>
			<td><div id="numgens4">&nbsp;&nbsp;<?php echo $admtext['descendants']; ?>: </div></td>
			<td><div id="numgens5"><input type="text" name="dgens" size="3" maxlength="3" value="0"> &nbsp;&nbsp; 
				<input type="checkbox" name="dospouses" checked="checked"> <?php echo $admtext['inclspouses']; ?></div></td>
		</tr>
		<tr>
			<td><div id="overwrite1"><br/><strong><?php echo $admtext['existlabels']; ?>:</strong></div></td>
			<td>
				<div id="overwrite2"><br/>
				<select name="overwrite">
					<option value="2" selected="selected"><?php echo $admtext['append']; ?></option>
					<option value="1"><?php echo $admtext['overwrite']; ?></option>
					<option value="0"><?php echo $admtext['leave']; ?></option>
				</select>
				</div>
			</td>
		</tr>
	</table>
	<br/><input type="submit" id="labelsub" value="<?php echo $admtext['addlabels']; ?>"> <input type="button" value="<?php echo $admtext['showpeople']; ?>" onclick="window.location.href='admin_showbranch.php?tree=<?php echo $tree; ?>&amp;branch=<?php echo $branch; ?>';">
	</form>
	<p class="normal">*<?php echo $admtext['branchdiscl']; ?></p>
</td>
</tr>
</table>
<?php 
echo tng_adminfooter();
?>