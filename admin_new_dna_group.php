<?php
include("begin.php");
include("adminlib.php");
$textpart = "dna";
include("getlang.php");
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
else
	$wherestr = "";
$orgtree = isset($tree) ? $tree : "";
$treequery = "SELECT gedcom, treename FROM $trees_table $wherestr ORDER BY treename";

$helplang = findhelp("dna_help.php");

tng_adminheader( $admtext['addgroup'], $flags );
?>
<script type="text/javascript" src="js/selectutils.js"></script>
<script type="text/javascript">
//<![CDATA[
function validateForm( ) {
	var rval = true;

	document.form1.dna_group.value = document.form1.dna_group.value.replace(/[^a-zA-Z0-9-_]+/g, "");
	if( document.form1.dna_group.value.length == 0 ) {
		alert("<?php echo $admtext['entergroupid']; ?>");
		rval = false;
	}
	else if( document.form1.description.value.length == 0 ) {
		alert("<?php echo $admtext['entergroupdesc']; ?>");
		rval = false;
	}
	else if(document.form1.test_type.selectedIndex == 0 ) {
		alert("<?php echo $admtext['selecttype']; ?>");
		rval = false;
	}
	return rval;
}
var tree = "";
//]]>
</script>
</head>

<?php
	echo tng_adminlayout();

	$dnatabs[0] = array(1,"admin_dna_groups.php",$admtext['search'],"findtest");
	$dnatabs[1] = array($allow_add,"admin_new_dna_group.php",$admtext['addgroup'],"addgroup");
	$dnatabs[2] = array(1,"admin_dna_tests.php",$admtext['dna_tests'],"findtest");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/dna_help.php#add');\" class=\"lightlink\">{$admtext['help']}</a> ";
	$menu = doMenu($dnatabs,"addgroup",$innermenu);
	echo displayHeadline($admtext['dna_groups'] . " &gt;&gt; " . $admtext['addgroup'],"img/dna_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">
	<form action="admin_add_dna_group.php" method="post" name="form1" onsubmit="return validateForm();">
	<table class="normal">
		<tr>
			<td><?php echo $admtext['tree']; ?>: </td>
			<td>
				<select name="tree" id="tree2">
<?php
	$treeresult = tng_query($treequery) or die ($admtext['cannotexecutequery'] . ": $treequery");
	while( $treerow = tng_fetch_assoc($treeresult) )
		echo "	<option value=\"{$treerow['gedcom']}\">{$treerow['treename']}</option>\n";
	tng_free_result($treeresult);
?>
				</select>
			</td>
		</tr>
		<tr><td valign="top"><?php echo $admtext['groupid']; ?>:</td><td><input type="text" name="dna_group" size="20" maxlength="20"/></td></tr>
		<tr>
			<td><?php echo $admtext['test_type']; ?>: </td>
			<td>
				<select name="test_type">
					<option value="">&nbsp;</option>
					<option value="atDNA"><?php echo $admtext['atdna_test']; ?></option>
					<option value="Y-DNA"><?php echo $admtext['ydna_test']; ?></option>
					<option value="mtDNA"><?php echo $admtext['mtdna_test']; ?></option>
					<option value="X-DNA"><?php echo $admtext['xdna_test']; ?></option>
				</select>
			</td>
		</tr>
		<tr><td valign="top"><?php echo $admtext['description']; ?>:</td><td><input type="text" name="description" size="60"></td></tr>

	</table>
	<br/>
	<input type="submit" name="submit" class="btn" value="<?php echo $admtext['save']; ?>">
	</form>
	</div>
</div>
<?php 
echo tng_adminfooter();
?>