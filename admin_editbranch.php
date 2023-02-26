<?php
include("begin.php");
include("adminlib.php");
$textpart = "branches";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( !$allow_edit || ( $assignedtree && $assignedtree != $tree ) ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$query = "SELECT * FROM $branches_table WHERE gedcom = \"$tree\" AND branch = \"$branch\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
$row['description'] = preg_replace("/\"/", "&#34;",$row['description']);
tng_free_result($result);

$query = "SELECT treename FROM $trees_table where gedcom = \"$tree\"";
$treeresult = tng_query($query);
$treerow = tng_fetch_assoc( $treeresult );
tng_free_result( $treeresult );

$helplang = findhelp("branches_help.php");

tng_adminheader( $admtext['modifybranch'], $flags );
?>
<script type="text/javascript" src="js/selectutils.js"></script>
<script type="text/javascript">
function validateForm( ) {
	var rval = true;
	var form = document.form1;

	if( form1.description.value.length == 0 ) {
		alert("<?php echo $admtext['entertreedesc']; ?>");
		rval = false;
	}
	return rval;
}

var tnglitbox;
function startLabels(form) {
	//pass the form fields as args
	var form = document.form1;

	if( form.personID.value.length == 0 ) {
		alert("<?php echo $admtext['enterstartingind']; ?>");
	}
	else if( isNaN( form.agens.value ) || isNaN( form.dgens.value ) ) {
		alert("<?php echo $admtext['gensnumeric']; ?>");
	}
	else {
		var args = "&personID=" + form.personID.value + "&agens=" + form.agens.value + "&dagens=" + form.dagens.value + "&dgens=" + form.dgens.value + "&dospouses=" + form.dospouses.value;
		tnglitbox = new LITBox('ajx_branchmenu.php?branch=<?php echo $branch; ?>&tree=<?php echo $tree; ?>' + args,{width:420,height:420});
	}
	return false;
}

function showBranchPeople() {
	tnglitbox = new LITBox('ajx_showbranch.php?branch=<?php echo $branch; ?>&tree=<?php echo $tree; ?>',{width:420,height:420});
	return false;
}

var tree = "<?php echo $tree; ?>";
function addLabels() {
	var form1 = document.form1;

	jQuery('#branchresults').html('');
	jQuery('#labelspinner').show();
	params = {
		branchaction: jQuery("input:radio[name ='branchaction']:checked").val(),
		set: jQuery("input:radio[name ='set']:checked").val(),
		overwrite: jQuery('#overwrite').val(),
		personID: form1.personID.value,
		agens: form1.agens.value,
		dagens: jQuery('#dagens').val(),
		dgens: form1.dgens.value,
		dospouses: jQuery('#dospouses').attr('checked') ? true : "",
		tree: '<?php echo $tree; ?>',
		branch: '<?php echo $branch; ?>'
	};
	jQuery.ajax({
		url: 'ajx_labels.php',
		data: params,
		dataType: 'html',
		success: function(req){
			jQuery('#labelspinner').hide();
			jQuery('#branchresults').html(req);
		}
	});
	return false;
}

function toggleClear(option) {
	jQuery('#allpart').fadeIn(300);
	jQuery('#labelsub').val(option ? '<?php echo $admtext['text_delete']; ?>' : '<?php echo $admtext['clearlabels']; ?>');
	jQuery('#overwrite1').fadeOut(300);
}

function toggleAdd() {
	jQuery('#allpart').fadeOut(300);
	document.form2.set[1].checked = true;
	jQuery('#labelsub').val('<?php echo $admtext['addlabels']; ?>');
	jQuery('#overwrite1').fadeIn(300);
}
</script>
</head>

<?php
	echo tng_adminlayout();

	$branchtabs[0] = array(1,"admin_branches.php",$admtext['search'],"findbranch");
	$branchtabs[1] = array($allow_add,"admin_newbranch.php",$admtext['addnew'],"addbranch");
	$branchtabs[2] = array($allow_edit,"#",$admtext['edit'],"edit");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/branches_help.php#add');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($branchtabs,"edit",$innermenu);
	echo displayHeadline($admtext['branches'] . " &gt;&gt; " . $admtext['modifybranch'],"img/branches_icon.gif",$menu,$message);
?>

<div class="admin-main">
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="adm-rounded-table">
<tr>
<td class="tngshadow databack">
	<form action="admin_updatebranch.php" method="post"  name="form1" id="form1" onSubmit="return validateForm();">
	<table class="normal">
		<tr><td valign="top"><?php echo $admtext['tree']; ?>:</td><td><?php echo $treerow['treename']; ?></td></tr>
		<tr><td valign="top"><?php echo $admtext['branchid']; ?>:</td><td><?php echo $branch; ?></td></tr>
		<tr><td valign="top"><?php echo $admtext['description']; ?>:</td><td><input type="text" name="description" size="60" value="<?php echo $row['description']; ?>"></td></tr>

		<tr><td colspan="2"><div id="startind1"><br/><strong><?php echo $text['startingind']; ?>:</strong></div></td></tr>
		<tr>
			<td><div id="startind2">&nbsp;&nbsp;<?php echo $admtext['personid']; ?>: </div></td>
			<td><table id="startind3" class="normal"><tr><td><input type="text" name="personID" id="personID" value="<?php echo $row['personID']; ?>" size="10"> &nbsp;<?php echo $admtext['text_or']; ?>&nbsp;</td>
				<td><a href="#" onclick="return findItem('I','personID','','<?php echo $tree; ?>','<?php echo $assignedbranch; ?>');" title="<?php echo $admtext['find']; ?>" class="smallicon admin-find-icon"></a></td>
			</tr></table></td>
		</tr>
		<tr>
			<td colspan="2"><div id="numgens1"><br/><strong><?php echo $admtext['numgenerations']; ?>:</strong></div></td>
		</tr>
		<tr>
			<td><div id="numgens2">&nbsp;&nbsp;<?php echo $admtext['ancestors']; ?>: </div></td>
			<td><div id="numgens3"><input type="text" name="agens" size="3" maxlength="3" value="<?php echo $row['agens'] ? $row['agens'] : 0; ?>" /> &nbsp;&nbsp; <?php echo $admtext['descofanc']; ?>:
				<select name="dagens" id="dagens">
				<?php
					$dagens = $row['dagens'] != "" ? $row['dagens'] : 1;
					for($i = 0; $i < 6; $i++) {
						echo "<option value=\"$i\"";
						if($i == $dagens) echo " selected=\"selected\"";
						echo ">$i</option>";
					}
				?>
				</select>
				</div></td>
		</tr>
		<tr>
			<td><div id="numgens4">&nbsp;&nbsp;<?php echo $admtext['descendants']; ?>: </div></td>
			<td><div id="numgens5"><input type="text" name="dgens" size="3" maxlength="3" value="<?php echo $row['dgens'] ? $row['dgens'] : 0; ?>" /> &nbsp;&nbsp;
				<input type="checkbox" name="dospouses" id="dospouses"<?php if($row['inclspouses']) echo " checked=\"checked\""; ?> value="1"/> <?php echo $admtext['inclspouses']; ?></div></td>
		</tr>
	</table>
	<span class="normal">
	<br/></span>
	<input type="hidden" name="tree" value="<?php echo $tree; ?>">
	<input type="hidden" name="branch" value="<?php echo $branch; ?>">
	<input type="submit" name="submitx" class="btn" value="<?php echo $admtext['saveback']; ?>">
	<input type="submit" name="submit" accesskey="s" class="btn" value="<?php echo $admtext['savereturn']; ?>">
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="window.location.href='admin_branches.php';">
	&nbsp;
	<input type="button" class="btn" value="<?php echo $admtext['addlabels']; ?>" onclick="return startLabels(document.forms.form1);">
	<input type="button" class="btn" value="<?php echo $admtext['showpeople']; ?>" onclick="return showBranchPeople();">
	</form>
</td>
</tr>

</table>
</div>
<?php 
echo tng_adminfooter();
?>