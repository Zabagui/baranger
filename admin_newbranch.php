<?php
include("begin.php");
include("adminlib.php");
$textpart = "branches";
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

if( $assignedtree ) {
	$wherestr = "WHERE gedcom = \"$assignedtree\"";
	$tree = $assignedtree;
}
else {
	$wherestr = "";
	$tree = isset($_COOKIE['tng_tree']) ? $_COOKIE['tng_tree'] : "";
}
$orgtree = $tree;
$treequery = "SELECT gedcom, treename FROM $trees_table $wherestr ORDER BY treename";

$helplang = findhelp("branches_help.php");

tng_adminheader( $admtext['addnewbranch'], $flags );
?>
<script type="text/javascript" src="js/selectutils.js"></script>
<script type="text/javascript">
function validateForm( ) {
	var rval = true;

	document.form1.branch.value = document.form1.branch.value.replace(/[^a-zA-Z0-9-_]+/g, "");
	if( document.form1.branch.value.length == 0 ) {
		alert("<?php echo $admtext['enterbranchid']; ?>");
		rval = false;
	}
	else if( document.form1.description.value.length == 0 ) {
		alert("<?php echo $admtext['entertreedesc']; ?>");
		rval = false;
	}
	return rval;
}
var tree = "";
</script>
</head>

<?php
	echo tng_adminlayout();

	$branchtabs[0] = array(1,"admin_branches.php",$admtext['search'],"findbranch");
	$branchtabs[1] = array($allow_add,"admin_newbranch.php",$admtext['addnew'],"addbranch");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/branches_help.php#add');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($branchtabs,"addbranch",$innermenu);
	echo displayHeadline($admtext['branches'] . " &gt;&gt; " . $admtext['addnewbranch'],"img/branches_icon.gif",$menu,$message);
?>

<div class="admin-main">
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="adm-rounded-table">
<tr>
<td class="tngshadow databack">
	<form action="admin_addbranch.php" method="post" name="form1" onsubmit="return validateForm();">
	<table class="normal">
		<tr>
			<td><?php echo $admtext['tree']; ?>: </td>
			<td>
				<select name="tree" id="tree1">
<?php
	$treeresult = tng_query($treequery) or die ($admtext['cannotexecutequery'] . ": $treequery");
	while( $treerow = tng_fetch_assoc($treeresult) ) {
		if( empty($firsttree) ) $firsttree = $treerow['gedcom'];
		echo "		<option value=\"{$treerow['gedcom']}\"";
		if($firsttree == $treerow['gedcom'])
			echo " selected=\"selected\"";
		echo ">{$treerow['treename']}</option>\n";
	}
	tng_free_result($treeresult);
?>
				</select>
			</td>
		</tr>
		<tr><td valign="top"><?php echo $admtext['branchid']; ?>:</td><td><input type="text" name="branch" size="20" maxlength="20"/></td></tr>
		<tr><td valign="top"><?php echo $admtext['description']; ?>:</td><td><input type="text" name="description" size="60"></td></tr>

		<tr><td colspan="2"><div id="startind1"><br/><strong><?php echo $text['startingind']; ?>:</strong></div></td></tr>
		<tr>
			<td><div id="startind2">&nbsp;&nbsp;<?php echo $admtext['personid']; ?>: </div></td>
			<td><table id="startind3" class="normal"><tr><td><input type="text" name="personID" id="personID" size="10"> &nbsp;<?php echo $admtext['text_or']; ?>&nbsp;</td>
				<td><a href="#" onclick="return findItem('I','personID','',getTree(document.getElementById('tree1')),'<?php echo $assignedbranch; ?>');" title="<?php echo $admtext['find']; ?>" class="smallicon admin-find-icon"></a></td>
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
				<input type="checkbox" name="dospouses" checked="checked" value="1"> <?php echo $admtext['inclspouses']; ?></div></td>
		</tr>
	</table>
	<br/>
	<input type="submit" name="submitx" class="btn" value="<?php echo $admtext['saveback']; ?>">
	<input type="submit" name="submit" accesskey="s" class="btn" value="<?php echo $admtext['savereturn']; ?>">
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="window.location.href='admin_branches.php';">
	</form>
</td>
</tr>

</table>
</div>
<?php 
echo tng_adminfooter();
?>