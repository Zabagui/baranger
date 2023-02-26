<?php
include("begin.php");
include("adminlib.php");
$textpart = "sources";
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
	$firsttree = $assignedtree;
}
else {
	$wherestr = "";
	$firsttree = isset($_COOKIE['tng_tree']) ? $_COOKIE['tng_tree'] : "";
}

$helplang = findhelp("repositories_help.php");

tng_adminheader( $admtext['addnewrepo'], $flags );
?>
<script type="text/javascript" src="js/selectutils.js"></script>
<script type="text/javascript">
function validateForm( ) {
	var rval = true;

	document.form1.repoID.value = TrimString( document.form1.repoID.value );
	if( document.form1.repoID.value.length == 0 ) {
		alert("<?php echo $admtext['enterrepoid']; ?>");
		return false;
	}
	else if( document.form1.reponame.value.length == 0 ) {
		alert("<?php echo $admtext['enterreponame']; ?>");
		return false;
	}
	return rval;
}	

var selecttree = "<?php echo $admtext['selecttree']; ?>";
</script>
</head>

<?php
	echo tng_adminlayout(" onload=\"generateID('repo',document.form1.repoID,document.form1.tree1);\"");

	$repotabs[0] = array(1,"admin_repositories.php",$admtext['search'],"findrepo");
	$repotabs[1] = array($allow_add,"admin_newrepo.php",$admtext['addnew'],"addrepo");
	$repotabs[2] = array($allow_edit && $allow_delete,"admin_mergerepos.php",$admtext['merge'],"merge");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/repositories_help.php#add');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($repotabs,"addrepo",$innermenu);
	echo displayHeadline($admtext['repositories'] . " &gt;&gt; " . $admtext['addnewrepo'],"img/repos_icon.gif",$menu,$message);
?>

<div class="admin-main">
<form action="admin_addrepo.php" method="post"  name="form1" onSubmit="return validateForm();">
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="adm-rounded-table">
<tr>
<td class="tngshadow databack">
	<table>
	<tr>
		<td valign="top"><span class="normal"><?php echo $admtext['tree']; ?>:</span></td>
		<td>
			<select name="tree1" onChange="generateID('repo',document.form1.repoID,document.form1.tree1);">
<?php
$query = "SELECT gedcom, treename FROM $trees_table $wherestr ORDER BY treename";
$result = tng_query($query);
$numtrees = tng_num_rows($result);
while( $row = tng_fetch_assoc($result) ) {
	echo "		<option value=\"{$row['gedcom']}\"";
	if($firsttree == $row['gedcom'])
		echo " selected=\"selected\"";
	echo ">{$row['treename']}</option>\n";
}
tng_free_result( $result );
?>
			</select> 
		</td>
	</tr>
	<tr>
		<td valign="top"><span class="normal"><?php echo $admtext['repoid']; ?>:</span></td>
		<td>
			<input type="text" name="repoID" size="10" onBlur="this.value=this.value.toUpperCase()">
			<input type="button" value="<?php echo $admtext['generate']; ?>" onClick="generateID('repo',document.form1.repoID,document.form1.tree1);">
			<input type="submit" name="submit" value="<?php echo $admtext['lockid']; ?>" onClick="document.form1.newscreen[0].checked = true;">
			<input type="button" value="<?php echo $admtext['check']; ?>" onClick="checkID(document.form1.repoID.value,'repo','checkmsg',document.form1.tree1);">
			<span id="checkmsg" class="normal"></span>
		</td>
	</tr>
	</table>
</td>
</tr>
<tr>
<td class="tngshadow databack">
	<table class="normal">
	<tr><td><?php echo $admtext['name']; ?>:</td><td><span class="normal"><input type="text" name="reponame" size="40"> (<?php echo $admtext['required']; ?>)</span></td></tr>
	<tr><td><?php echo $admtext['address1']; ?>:</td><td><input type="text" name="address1" size="50"></td></tr>
	<tr><td><?php echo $admtext['address2']; ?>:</td><td><input type="text" name="address2" size="50"></td></tr>
	<tr><td><?php echo $admtext['city']; ?>:</td><td><input type="text" name="city" size="50"></td></tr>
	<tr><td><?php echo $admtext['stateprov']; ?>:</td><td><input type="text" name="state" size="50"></td></tr>
	<tr><td><?php echo $admtext['zip']; ?>:</td><td><input type="text" name="zip" size="20"></td></tr>
	<tr><td><?php echo $admtext['countryaddr']; ?>:</td><td><input type="text" name="country" size="50"></td></tr>
	<tr><td><?php echo $admtext['phone']; ?>:</td><td><input type="text" name="phone" size="30" value=""></td></tr>
	<tr><td><?php echo $admtext['email']; ?>:</td><td><input type="text" name="email" size="50" value=""></td></tr>
	<tr><td><?php echo $admtext['website']; ?>:</td><td><input type="text" name="www" size="50" value=""></td></tr>
	</table>
</td>
</tr>
<tr>
<td class="tngshadow databack">
	<p class="normal"><strong><?php echo $admtext['revslater']; ?></strong></p>
	<input type="submit" name="save" class="btn" accesskey="s" value="<?php echo $admtext['savecont']; ?>">
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="window.location.href='admin_repositories.php';">
</td>
</tr>
</table>
</form>
</div>
<?php 
echo tng_adminfooter();
?>