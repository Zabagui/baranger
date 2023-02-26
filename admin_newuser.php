<?php
include("begin.php");
include("adminlib.php");
$textpart = "users";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( $assignedtree || !$allow_add ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$query = "SELECT count(userID) as ucount FROM $users_table";
$result = @tng_query($query);
if( $result )
	$row = tng_fetch_assoc($result);
else
	$row['ucount'] = 0;

$revquery = "SELECT count(userID) as ucount FROM $users_table WHERE allow_living = \"-1\"";
$revresult = tng_query($revquery) or die ($admtext['cannotexecutequery'] . ": $revquery");
$revrow = tng_fetch_assoc( $revresult );
$revstar = $revrow['ucount'] ? " *" : "";
tng_free_result($revresult);

$helplang = findhelp("users_help.php");

tng_adminheader( $admtext['addnewuser'], $flags );
?>
<script type="text/javascript" src="js/selectutils.js"></script>
<script type="text/javascript" src="js/users.js"></script>
<script type="text/javascript">
<?php
	include("branchlibjs.php");
?>

function validateForm(form) {
	var rval = true;
	if( form.description.value.length == 0 ) {
		alert("<?php echo $admtext['enteruserdesc']; ?>");
		form.description.focus();
		rval = false;
	}
	else if( form.username.value.length == 0 ) {
		alert("<?php echo $admtext['enterusername']; ?>");
		form.username.focus();
		rval = false;
	}
	else if( form.password.value.length == 0 ) {
		alert("<?php echo $admtext['enterpassword']; ?>");
		form.password.focus();
		rval = false;
	}
	else if( form.email.value.length == 0 || !checkEmail(form.email.value)) {
		alert(enteremail);
		form.email.focus();
		rval = false;
	}
	else if(form.administrator[1].checked && form.gedcom.selectedIndex < 1) {
		alert("<?php echo $admtext['selecttree']; ?>");
		form.gedcom.focus();
		rval = false;
	}
	return rval;
}	

var orgrealname = "xxx";
var orgusername = "yyy";
var orgpassword = "zzz";
var enteremail = "<?php echo $text['enteremail']; ?>";
</script>
</head>

<?php
	echo tng_adminlayout();

	$usertabs[0] = array(1,"admin_users.php",$admtext['search'],"finduser");
	$usertabs[1] = array($allow_add,"admin_newuser.php",$admtext['addnew'],"adduser");
	$usertabs[2] = array($allow_edit,"admin_reviewusers.php",$admtext['review'] . $revstar,"review");
	$usertabs[3] = array(1,"admin_mailusers.php",$admtext['email'],"mail");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/users_help.php#add');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($usertabs,"adduser",$innermenu);
	echo displayHeadline($admtext['users'] . " &gt;&gt; " . $admtext['addnewuser'],"img/users_icon.gif",$menu,$message);
?>

<div class="admin-main">
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="adm-rounded-table">
<tr>
<td class="tngshadow databack">
	<form action="admin_adduser.php" method="post"  name="form1" onSubmit="return validateForm(this);">
	<table class="normal">
		<tr><td><?php echo $admtext['description']; ?>:</td><td><input type="text" name="description" size="50" maxlength="50"></td></tr>
		<tr><td><?php echo $admtext['username']; ?>:</td>
			<td>
				<input type="text" name="username" size="20" maxlength="100" onblur="checkNewUser(this,null);">
				<span id="checkmsg" class="normal"></span>
			</td>
		</tr>
		<tr><td><?php echo $admtext['password']; ?>:</td><td><input type="text" name="password" size="20" maxlength="100"></td></tr>
		<tr><td><?php echo $admtext['realname']; ?>:</td><td><input type="text" name="realname" size="50" maxlength="50"></td></tr>
		<tr><td><?php echo $admtext['phone']; ?>:</td><td><input type="text" name="phone" size="30" maxlength="30"></td></tr>
		<tr><td><?php echo $admtext['email']; ?>:</td><td><input type="text" name="email" size="50" maxlength="100" onblur="checkIfUnique(this);"> <span id="emailmsg"></span></td></tr>
		<tr><td>&nbsp;</td><td><input type="checkbox" name="no_email" value="1"> <?php echo $admtext['no_email']; ?></td></tr>
		<tr><td><?php echo $admtext['website']; ?>:</td><td><input type="text" name="website" size="50" maxlength="128" value="https://"></td></tr>
		<tr><td><?php echo $admtext['address']; ?>:</td><td><input type="text" name="address" size="50" maxlength="100"></td></tr>
		<tr><td><?php echo $admtext['city']; ?>:</td><td><input type="text" name="city" size="50" maxlength="64"></td></tr>
		<tr><td><?php echo $admtext['stateprov']; ?>:</td><td><input type="text" name="state" size="50" maxlength="64"></td></tr>
		<tr><td><?php echo $admtext['zip']; ?>:</td><td><input type="text" name="zip" size="20" maxlength="10"></td></tr>
		<tr><td><?php echo $admtext['cap_country']; ?>:</td><td><input type="text" name="country" size="50" maxlength="64"></td></tr>
<?php
		$query = "SELECT languageID, display FROM $languages_table ORDER BY display";
		$langresult = tng_query($query);
		$numlangs = tng_num_rows($langresult);
		if($numlangs) {
?>
		<tr>
			<td><?php echo $admtext['preflang']; ?>:</td>
			<td>
				<select name="preflang">
					<option value="0"></option>
<?php
			while( $langrow = tng_fetch_assoc($langresult) ) {
				echo "	<option value=\"{$langrow['languageID']}\">{$langrow['display']}</option>\n";
			}
?>
				</select>
			</td>
		</tr>
<?php
		}
		tng_free_result($langresult);
?>
		<tr><td valign="top"><?php echo $admtext['notes']; ?>:</td><td><textarea cols="50" rows="4" name="notes"></textarea></td></tr>
		<tr>
			<td>
				<?php echo $admtext['tree']; ?> / <?php echo $admtext['personid']; ?>:
			</td>
			<td>
				<select name="mynewgedcom">
				<option value=""></option>
<?php
		$treequery = "SELECT gedcom, treename FROM $trees_table ORDER BY treename";
		$treeresult = tng_query($treequery);

		while( $treerow = tng_fetch_assoc($treeresult) ) {
			echo "	<option value=\"{$treerow['gedcom']}\">{$treerow['treename']}</option>\n";
		}
?>
				</select>
				<input type="text" name="personID" id="personID" size="20" maxlength="22"> &nbsp;<?php echo $admtext['text_or']; ?>&nbsp;
				<a href="#" onclick="return findItem('I','personID','',document.form1.mynewgedcom.options[document.form1.mynewgedcom.selectedIndex].value,'<?php echo $assignedbranch; ?>');" title="<?php echo $admtext['find']; ?>">
					<img src="img/tng_find.gif" title="<?php echo $admtext['find']; ?>" alt="<?php echo $admtext['find']; ?>" class="alignmiddle" width="20" height="20" border="0" vspace="0" hspace="2">
				</a>
			</td>
		</tr>
		<tr><td>&nbsp;</td>
			<td>
				<input type="checkbox" name="disabled" value="1" /> <?php echo $admtext['disabled']; ?></br>
				<input type="checkbox" name="consented" value="1" /> <?php echo $admtext['consented']; ?>
			</td>
		</tr>
	</table>
	<br/><br/>
	
	<div class="normal">
		<table class="normal">
			<tr>
				<td valign="top">
					<p><strong><?php echo $admtext['roles']; ?>:</strong></p>
					
<?php
	if($row['ucount']) {
?>
					<p><input type="radio" name="role" value="guest" checked="checked" onclick="assignRightsFromRole('guest');"/> <?php echo $admtext['usrguest'] . "<br/><em class=\"smaller indent\">{$admtext['usrguestd']} {$admtext['noadmin']}</em>"; ?></p>
					<p><input type="radio" name="role" value="subm" onclick="assignRightsFromRole('subm');"/> <?php echo $admtext['usrsubm'] . "<br/><em class=\"smaller indent\">{$admtext['usrsubmd']} {$admtext['noadmin']}</em>"; ?></p>
					<p><input type="radio" name="role" value="contrib" onclick="assignRightsFromRole('contrib');"/> <?php echo $admtext['usrcontrib'] . "<br/><em class=\"smaller indent\">{$admtext['usrcontribd']}</em>"; ?></p>
					<p><input type="radio" name="role" value="editor" onclick="assignRightsFromRole('editor');"/> <?php echo $admtext['usreditor'] . "<br/><em class=\"smaller indent\">{$admtext['usreditord']}</em>"; ?></p>
					<p><input type="radio" name="role" value="mcontrib" onclick="assignRightsFromRole('mcontrib');"/> <?php echo $admtext['usrmcontrib'] . "<br/><em class=\"smaller indent\">{$admtext['usrmcontribd']}</em>"; ?></p>
					<p><input type="radio" name="role" value="meditor" onclick="assignRightsFromRole('meditor');"/> <?php echo $admtext['usrmeditor'] . "<br/><em class=\"smaller indent\">{$admtext['usrmeditord']}</em>"; ?></p>
					<p><input type="radio" name="role" value="custom" onclick="assignRightsFromRole('custom');"/> <?php echo $admtext['usrcustom']; ?></p>
<?php
	}
?>				
					<p><input type="radio" name="role" value="admin"<?php if( !$row['ucount'] ) echo " checked=\"checked\""; ?> onclick="assignRightsFromRole('admin');"/> <?php echo $admtext['usradmin'] . "<br/><em class=\"smaller indent\">{$admtext['usradmind']}</em>"; ?></p>
				</td>
				<td valign="top">
					<p><strong><?php echo $admtext['rights']; ?></strong></p>

	<p>
	<input type="radio" name="form_allow_add" class="rights" value="1"<?php if( !$row['ucount'] ) echo " checked=\"checked\""; ?> onclick="document.form1.role[6].checked='checked';"/> <?php echo $admtext['allow_add']; ?><br/>
<?php
	if( $row['ucount'] ) {
?>
	<input type="radio" name="form_allow_add" class="rights" value="3" onclick="document.form1.role[6].checked='checked';"/> <?php echo $admtext['allow_media_add']; ?><br/>
	<input type="radio" name="form_allow_add" class="rights" value="0" onclick="document.form1.role[6].checked='checked';" checked="checked"/> <?php echo $admtext['no_add']; ?><br/>
<?php
	}
?>
	</p>
	
	<p>
	<input type="radio" name="form_allow_edit" class="rights" value="1"<?php if( !$row['ucount'] ) echo " checked=\"checked\""; ?> onclick="document.form1.role[6].checked='checked';"/> <?php echo $admtext['allow_edit']; ?><br/>
<?php
	if( $row['ucount'] ) {
?>
	<input type="radio" name="form_allow_edit" class="rights" value="3" onclick="document.form1.role[6].checked='checked';"/> <?php echo $admtext['allow_media_edit']; ?><br/>
	<input type="radio" name="form_allow_edit" class="rights" value="2" onclick="document.form1.role[6].checked='checked';"/> <?php echo $admtext['tentative_edit']; ?><br/>
	<input type="radio" name="form_allow_edit" class="rights" value="0" onclick="document.form1.role[6].checked='checked';" checked="checked"/> <?php echo $admtext['no_edit']; ?><br/>
<?php
	}
?>
	</p>

	<p>
	<input type="radio" name="form_allow_delete" class="rights" value="1"<?php if( !$row['ucount'] ) echo " checked"; ?> onclick="document.form1.role[6].checked='checked';"/> <?php echo $admtext['allow_delete']; ?><br/>
<?php
	if( $row['ucount'] ) {
?>
	<input type="radio" name="form_allow_delete" class="rights" value="3" onclick="document.form1.role[6].checked='checked';"/> <?php echo $admtext['allow_media_delete']; ?><br/>
	<input type="radio" name="form_allow_delete" class="rights" value="0" onclick="document.form1.role[6].checked='checked';" checked="checked"/> <?php echo $admtext['no_delete']; ?><br/>
<?php
	}
?>
	</p>
	
	<br/><hr/><br/>
	<p>
		<input type="checkbox" name="form_allow_living" value="1"<?php if( !$row['ucount'] ) echo " checked"; ?>> <?php echo $admtext['allow_living']; ?><br/>
		<input type="checkbox" name="form_allow_private" value="1"<?php if( !$row['ucount'] ) echo " checked"; ?>> <?php echo $admtext['allow_private']; ?><br/>
		<input type="checkbox" name="form_allow_private_notes" value="1"<?php if( !$row['ucount'] ) echo " checked"; ?>> <?php echo $admtext['allow_private_notes']; ?><br/>
		<input type="checkbox" name="form_allow_ged" value="1"<?php if( !$row['ucount'] ) echo " checked"; ?>> <?php echo $admtext['allow_ged']; ?><br/>
		<input type="checkbox" name="form_allow_pdf" value="1"<?php if( !$row['ucount'] ) echo " checked"; ?>> <?php echo $admtext['allow_pdf']; ?><br/>
		<input type="checkbox" name="form_allow_lds" value="1"<?php if( !$row['ucount'] ) echo " checked"; ?>> <?php echo $admtext['allow_lds']; ?><br/>
		<input type="checkbox" name="form_allow_profile" value="1"<?php if( !$row['ucount'] ) echo " checked"; ?>> <?php echo $admtext['allow_profile']; ?>
	</p>
				</td>
			</tr>
		</table>
		<br/><br/>

<?php
	if( $row['ucount'] ) {
		echo "<strong>{$admtext['accesslimits']}</strong><br/>\n";
?>
		
	<input type="radio" name="administrator" value="1" onclick="handleAdmin('allow');"> <?php echo $admtext['allow_admin']; ?><br/>
	<input type="radio" name="administrator" value="0" checked="checked" onclick="handleAdmin('restrict');"> <?php echo $admtext['limitedrights']; ?><br/>
	<div id="restrictions"><table>
		<tr><td valign="top">
		<span class="normal"><?php echo $admtext['tree']; ?>*:</span></td><td>
			<select name="gedcom" id="treeselect" onChange="var tree=getTree(); if( !tree ) tree = 'none'; <?php echo $swapbranches; ?>">
				<option value=""></option>
<?php
		$treeresult = tng_query($treequery);

		while( $treerow = tng_fetch_assoc($treeresult) ) {
			echo "	<option value=\"{$treerow['gedcom']}\">{$treerow['treename']}</option>\n";
		}
?>
			</select>
			</td>
		</tr>
		<tr><td valign="top"><span class="normal"><?php echo $admtext['branch']; ?>**:</span></td><td><span class="normal">
<?php
		echo "<select name=\"branch\" id=\"branch\">\n";
		echo "	<option value=\"\" selected>{$admtext['allbranches']}</option>\n";
		echo "</select>\n";
?>
		</span></td></tr>
	</table></div>
	<input type="radio" name="administrator" value="2" onclick="handleAdmin('allow_multiple');"> <?php echo $admtext['mult_trees']; ?><br/>
	<div style="margin-left: 30px;display:none" id="multiple">
		<select multiple="yes" name="gedcom_mult[]" id="treeselect2">
<?php
			$treeresult = tng_query($treequery);

			while( $treerow = tng_fetch_assoc($treeresult) ) {
				echo "	<option value=\"{$treerow['gedcom']}\">{$treerow['treename']}</option>\n";
			}
			tng_free_result($treeresult);
?>
		</select>
	</div>
<?php
	}
	else
		echo "<b>{$admtext['firstuser']}</b><input type=\"hidden\" name=\"gedcom\" value=\"\"><input type=\"hidden\" name=\"branch\" value=\"\">";
	if($numlangs <= 1) 
		echo "<input type=\"hidden\" name=\"preflang\" value=\"0\">\n";
?>
	<br/>
	<input type="checkbox" name="notify" value="1" onClick="replaceText();"> <?php echo $admtext['notify']; ?><br/>
	<textarea name="welcome" rows="5" cols="50" style="display:none"><?php echo "{$admtext['hello']} xxx,\r\n\r\n{$admtext['activated']} {$admtext['infois']}:\r\n\r\n{$admtext['username']}: yyy\r\n{$admtext['password']}: zzz\r\n\r\n$dbowner\r\n$tngdomain"; ?></textarea><br/><br/>
	<input type="submit" name="submitx" class="btn" value="<?php echo $admtext['saveback']; ?>">
	<input type="submit" name="submit" accesskey="s" class="btn" value="<?php echo $admtext['savereturn']; ?>">
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="window.location.href='admin_users.php';">
	</form>
	<p>
<?php
	echo "*{$admtext['treemsg']}<br/>\n";
	echo "**{$admtext['branchmsg']}<br/>\n";
?>
	</p>
	</div>
</td>
</tr>

</table>
</div>

<?php
	if( $row['ucount'] ) {
?>
<script type="text/javascript">
	var tree=getTree();
	if( tree ) {
<?php
	echo $swapbranches;
?>
	}
</script>
<?php
}

echo tng_adminfooter();
?>