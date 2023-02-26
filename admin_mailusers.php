<?php
include("begin.php");
include("adminlib.php");
$textpart = "users";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

$helplang = findhelp("users_help.php");

tng_adminheader( $admtext['emailusers'], $flags );
?>
<script src="js/selectutils.js"></script>
<script type="text/javascript">
<?php
	include("branchlibjs.php");
?>

function validateForm( ) {
	var rval = true;
	if( document.form1.subject.value.length == 0 ) {
		alert("<?php echo $admtext['entersubject']; ?>");
		rval = false;
	}
	else if( document.form1.messagetext.value.length == 0 ) {
		alert("<?php echo $admtext['entermsgtext']; ?>");
		rval = false;
	}
	return rval;
}	
</script>
</head>

<?php
	echo tng_adminlayout();

	$revquery = "SELECT count(userID) as ucount FROM $users_table WHERE allow_living = \"-1\"";
	$revresult = tng_query($revquery) or die ($admtext['cannotexecutequery'] . ": $revquery");
	$revrow = tng_fetch_assoc( $revresult );
	$revstar = $revrow['ucount'] ? " *" : "";
	tng_free_result($revresult);

	$usertabs[0] = array(1,"admin_users.php",$admtext['search'],"finduser");
	$usertabs[1] = array($allow_add,"admin_newuser.php",$admtext['addnew'],"adduser");
	$usertabs[2] = array($allow_edit,"admin_reviewusers.php",$admtext['review'] . $revstar,"review");
	$usertabs[3] = array(1,"admin_mailusers.php",$admtext['email'],"mail");
	$innermenu = "<a href=\"javascript:newwindow=window.open('$helplang/users_help.php#add');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($usertabs,"mail",$innermenu);
	echo displayHeadline($admtext['users'] . " &gt;&gt; " . $admtext['emailmessage'],"img/users_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">
	<form action="admin_sendmailusers.php" method="post"  name="form1" onSubmit="return validateForm();">
	<table class="normal">
		<tr><td valign="top"><?php echo $admtext['subject']; ?>:</td><td><input type="text" name="subject" size="50" maxlength="50"></td></tr>
		<tr><td valign="top"><?php echo $admtext['messagetext']; ?>:</td><td><textarea cols="50" rows="15" name="messagetext"></textarea></td></tr>
		<tr><td valign="top" colspan="2"><br /><strong><?php echo $admtext['selectgroup']; ?></strong></td></tr>
		<tr><td valign="top">
		<?php echo $admtext['tree']; ?>*:</td><td>
			<select name="gedcom" id="gedcom" onChange="var tree=getTree(this); if( !tree ) tree = 'none'; <?php echo $swapbranches; ?>">
				<option value=""></option>
<?php
		$query = "SELECT gedcom, treename FROM $trees_table ORDER BY treename";
		$treeresult = tng_query($query);

		while( $treerow = tng_fetch_assoc($treeresult) ) {
			echo "	<option value=\"{$treerow['gedcom']}\">{$treerow['treename']}</option>\n";
		}
?>
			</select>
			</td>
		</tr>
		<tr><td valign="top"><?php echo $admtext['branch']; ?>**:</span></td><td><span class="normal">
			<select name="branch" id="branch">
				<option value=""></option>
				<option value=""><?php echo $admtext['nobranch']; ?></option>
			</select>
		</td></tr>
		<tr>
			<td colspan="2"><input type="checkbox" name="sendtoadmins" value="1" /> <?php echo $admtext['sendtoadmins']; ?></td>
		</tr>
	</table>
	<br/>
	<input type="submit" name="submit" accesskey="s" class="btn" value="<?php echo $admtext['send']; ?>"></form><br/>
	<p class="normal">
<?php 
	echo "*{$admtext['treemailmsg']}<br/>\n";
	echo "**{$admtext['branchmailmsg']}<br/>\n";
?>
	</p>
	</div>
</div>

<?php 
echo tng_adminfooter();
?>