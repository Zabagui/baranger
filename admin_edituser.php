<?php
include("begin.php");
include("adminlib.php");
$textpart = "users";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( $assignedtree || !$allow_edit ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

if(!empty($username) && empty($userID)) {
	$query = "SELECT userID FROM $users_table WHERE username = \"$username\"";
	$result = tng_query($query) or die ("Cannot execute query: $query"); //message is hardcoded because we haven't included the text file yet
	$row = tng_fetch_assoc($result);
	$userID = $row['userID'];
	tng_free_result( $result );
}

$query = "SELECT *, DATE_FORMAT(lastlogin,\"%d %b %Y %H:%i:%s\") as lastlogin, dt_registered, DATE_FORMAT(dt_registered,\"%d %b %Y %H:%i:%s\") as dt_registered_fmt, DATE_FORMAT(dt_activated,\"%d %b %Y %H:%i:%s\") as dt_activated, dt_consented, DATE_FORMAT(dt_consented,\"%d %b %Y %H:%i:%s\") as dt_consented_fmt FROM $users_table WHERE userID = \"$userID\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
tng_free_result($result);
$row['description'] = preg_replace("/\"/", "&#34;",$row['description']);
$row['realname'] = preg_replace("/\"/", "&#34;",$row['realname']);
$row['phone'] = preg_replace("/\"/", "&#34;",$row['phone']);
$row['email'] = preg_replace("/\"/", "&#34;",$row['email']);
$row['website'] = preg_replace("/\"/", "&#34;",$row['website']);
$row['address'] = preg_replace("/\"/", "&#34;",$row['address']);
$row['city'] = preg_replace("/\"/", "&#34;",$row['city']);
$row['state'] = preg_replace("/\"/", "&#34;",$row['state']);
$row['country'] = preg_replace("/\"/", "&#34;",$row['country']);
$row['notes'] = preg_replace("/\"/", "&#34;",$row['notes']);

$deftext = $admtext;
if($row['languageID']) {
	$query = "SELECT folder FROM $languages_table WHERE languageID = \"{$row['languageID']}\"";
	$result = tng_query($query) or die ("Cannot execute query: $query"); //message is hardcoded because we haven't included the text file yet
	$langrow = tng_fetch_assoc($result);
	tng_free_result( $result );
}

$revquery = "SELECT count(userID) as ucount FROM $users_table WHERE allow_living = \"-1\"";
$revresult = tng_query($revquery) or die ($admtext['cannotexecutequery'] . ": $revquery");
$revrow = tng_fetch_assoc( $revresult );
$revstar = $revrow['ucount'] ? " *" : "";
tng_free_result($revresult);

$helplang = findhelp("users_help.php");

tng_adminheader( $admtext['modifyuser'], $flags );
?>
<script type="text/javascript" src="js/selectutils.js"></script>
<script type="text/javascript" src="js/users.js"></script>
<script type="text/javascript">
<?php
	include("branchlibjs.php");
?>

function validateForm( ) {
	var rval = true;
	if( document.form1.username.value.length == 0 ) {
		alert("<?php echo $admtext['enterusername']; ?>");
		document.form1.username.focus();
		rval = false;
	}
	else if( document.form1.password.value.length == 0 ) {
		alert("<?php echo $admtext['enterpassword']; ?>");
		document.form1.password.focus();
		rval = false;
	}
	else if( form.email.value.length == 0 || !checkEmail(form.email.value)) {
		alert(enteremail);
		form.email.focus();
		rval = false;
	}
	else if(document.form1.administrator[1].checked && document.form1.gedcom.selectedIndex < 1) {
		alert("<?php echo $admtext['selecttree']; ?>");
		document.form1.gedcom.focus();
		rval = false;
	}
	return rval;
}

var orgrealname = "<?php echo $row['realname']; ?>";
var orgusername = "<?php echo $row['username']; ?>";
var orgpassword = "<?php echo $row['password']; ?>";
var enteremail = "<?php echo $text['enteremail']; ?>";
</script>
</head>

<?php
	echo tng_adminlayout();

	$usertabs[0] = array(1,"admin_users.php",$admtext['search'],"finduser");
	$usertabs[1] = array($allow_add,"admin_newuser.php",$admtext['addnew'],"adduser");
	$usertabs[2] = array($allow_edit,"admin_reviewusers.php",$admtext['review'] . $revstar,"review");
	$usertabs[3] = array(1,"admin_mailusers.php",$admtext['email'],"mail");
	$usertabs[4] = array(1,"#",$admtext['edit'],"edit");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/users_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($usertabs,"edit",$innermenu);
	echo displayHeadline($admtext['users'] . " &gt;&gt; " . $admtext['modifyuser'], "img/users_icon.gif",$menu,$message);
?>

<div class="admin-main">
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="adm-rounded-table">
<tr>
<td class="tngshadow databack">
	<form action="admin_updateuser.php" method="post" name="form1" onSubmit="return validateForm();">
	<table class="normal">
		<tr><td><?php echo $admtext['description']; ?>:</td><td><input type="text" name="description" size="50" maxlength="50" value="<?php echo $row['description']; ?>"></td></tr>
		<tr><td><?php echo $admtext['username']; ?>:</td>
			<td>
				<input type="text" name="username" size="20" maxlength="100" value="<?php echo $row['username']; ?>">
				<input type="button" value="<?php echo $admtext['check']; ?>" onclick="checkNewUser(document.form1.username,document.form1.orguser);">
				<span id="checkmsg" class="normal"></span>
			</td>
		</tr>
		<tr><td><?php echo $admtext['password']; ?>:</td><td><input type="password" name="password" size="20" maxlength="100" value="<?php echo $row['password']; ?>"></td></tr>
		<tr><td><?php echo $admtext['realname']; ?>:</td><td><input type="text" name="realname" size="50" maxlength="50" value="<?php echo $row['realname']; ?>"></td></tr>
		<tr><td><?php echo $admtext['phone']; ?>:</td><td><input type="text" name="phone" size="30" maxlength="30" value="<?php echo $row['phone']; ?>"></td></tr>
		<tr><td><?php echo $admtext['email']; ?>:</td><td><input type="text" name="email" size="50" maxlength="100" value="<?php echo $row['email']; ?>" onblur="checkIfUnique(this);"> <span id="emailmsg"></span></td></tr>
		<tr><td>&nbsp;</td><td><input type="checkbox" name="no_email" value="1"<?php if( $row['no_email'] ) echo " checked"; ?>> <?php echo $admtext['no_email']; ?></td></tr>
		<tr><td><?php echo $admtext['website']; ?>:</td><td><input type="text" name="website" size="50" maxlength="128" value="<?php echo $row['website']; ?>"></td></tr>
		<tr><td><?php echo $admtext['address']; ?>:</td><td><input type="text" name="address" size="50" maxlength="100" value="<?php echo $row['address']; ?>"></td></tr>
		<tr><td><?php echo $admtext['city']; ?>:</td><td><input type="text" name="city" size="50" maxlength="64" value="<?php echo $row['city']; ?>"></td></tr>
		<tr><td><?php echo $admtext['stateprov']; ?>:</td><td><input type="text" name="state" size="50" maxlength="64" value="<?php echo $row['state']; ?>"></td></tr>
		<tr><td><?php echo $admtext['zip']; ?>:</td><td><input type="text" name="zip" size="20" maxlength="10" value="<?php echo $row['zip']; ?>"></td></tr>
		<tr><td><?php echo $admtext['cap_country']; ?>:</td><td><input type="text" name="country" size="50" maxlength="64" value="<?php echo $row['country']; ?>"></td></tr>
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
				echo "	<option value=\"{$langrow['languageID']}\"";
				if($langrow['languageID'] == $row['languageID']) echo " selected";
				echo ">{$langrow['display']}</option>\n";
			}
?>
				</select>
			</td>
		</tr>
<?php
		}
		tng_free_result($langresult);
?>
		<tr><td valign="top"><?php echo $admtext['notes']; ?>:</td><td><textarea cols="50" rows="4" name="notes"><?php echo $row['notes']; ?></textarea></td></tr>
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
			echo "	<option value=\"{$treerow['gedcom']}\"";
			if($treerow['gedcom'] == $row['mygedcom']) echo " selected=\"selected\"";
			echo ">{$treerow['treename']}</option>\n";
		}
?>
				</select>
				<input type="text" name="personID" id="personID" size="20" maxlength="22" value="<?php echo $row['personID']; ?>"> &nbsp;<?php echo $admtext['text_or']; ?>&nbsp;
				<a href="#" onclick="return findItem('I','personID','',document.form1.mynewgedcom.options[document.form1.mynewgedcom.selectedIndex].value,'<?php echo $assignedbranch; ?>');" title="<?php echo $admtext['find']; ?>">
					<img src="img/tng_find.gif" title="<?php echo $admtext['find']; ?>" alt="<?php echo $admtext['find']; ?>" class="alignmiddle" width="20" height="20" border="0" vspace="0" hspace="2">
				</a>
			</td>
		</tr>
<?php
	if( $row['dt_registered'] ) {
?>
		<tr><td><?php echo $admtext['dtregistered']; ?>:</span></td><td><span class="normal"><?php echo $row['dt_registered_fmt']; ?></span></td></tr>
<?php
	}
?>
		<tr><td><?php echo $admtext['dtactivated']; ?>:</td><td><?php echo $row['dt_activated']; ?></td></tr>
<?php
	if( substr($row['dt_consented'],0,4) != "0000" ) {
?>
		<tr><td><?php echo $admtext['consentdate']; ?>:</span></td><td><span class="normal"><?php echo $row['dt_consented_fmt']; ?></span></td></tr>
<?php
	}
	else {
?>
		<tr><td>&nbsp;</td><td><input type="checkbox" name="consented" value="1" /> <?php echo $admtext['consented']; ?></td></tr>
<?php
	}
?>
		<tr><td><?php echo $admtext['lastlogin']; ?>:</td><td><?php echo $row['lastlogin']; ?></td></tr>
		<tr><td>&nbsp;</td><td><input type="checkbox" name="disabled" value="1"<?php if( $row['disabled'] ) echo " checked"; ?> /> <?php echo $admtext['disabled']; ?></td></tr>
	</table>
	<br/><br/>
	
		<table class="normal">
			<tr>
				<td valign="top">
					<p><strong><?php echo $admtext['roles']; ?>:</strong></p>

					<p><input type="radio" name="role" value="guest"<?php if($row['role'] == "guest") echo " checked=\"checked\""; ?> onclick="assignRightsFromRole('guest');"/> <?php echo $admtext['usrguest'] . "<br/><em class=\"smaller indent\">{$admtext['usrguestd']} {$admtext['noadmin']}</em>"; ?></p>
					<p><input type="radio" name="role" value="subm"<?php if($row['role'] == "subm") echo " checked=\"checked\""; ?> onclick="assignRightsFromRole('subm');"/> <?php echo $admtext['usrsubm'] . "<br/><em class=\"smaller indent\">{$admtext['usrsubmd']} {$admtext['noadmin']}</em>"; ?></p>
					<p><input type="radio" name="role" value="contrib"<?php if($row['role'] == "contrib") echo " checked=\"checked\""; ?> onclick="assignRightsFromRole('contrib');"/> <?php echo $admtext['usrcontrib'] . "<br/><em class=\"smaller indent\">{$admtext['usrcontribd']}</em>"; ?></p>
					<p><input type="radio" name="role" value="editor"<?php if($row['role'] == "editor") echo " checked=\"checked\""; ?> onclick="assignRightsFromRole('editor');"/> <?php echo $admtext['usreditor'] . "<br/><em class=\"smaller indent\">{$admtext['usreditord']}</em>"; ?></p>
					<p><input type="radio" name="role" value="mcontrib"<?php if($row['role'] == "mcontrib") echo " checked=\"checked\""; ?> onclick="assignRightsFromRole('mcontrib');"/> <?php echo $admtext['usrmcontrib'] . "<br/><em class=\"smaller indent\">{$admtext['usrmcontribd']}</em>"; ?></p>
					<p><input type="radio" name="role" value="meditor"<?php if($row['role'] == "meditor") echo " checked=\"checked\""; ?> onclick="assignRightsFromRole('meditor');"/> <?php echo $admtext['usrmeditor'] . "<br/><em class=\"smaller indent\">{$admtext['usrmeditord']}</em>"; ?></p>
					<p><input type="radio" name="role" value="custom"<?php if(!$row['role'] || $row['role'] == "custom") echo " checked=\"checked\""; ?> onclick="assignRightsFromRole('custom');"/> <?php echo $admtext['usrcustom']; ?></p>
					<p><input type="radio" name="role" value="admin"<?php if($row['role'] == "admin") echo " checked=\"checked\""; ?> onclick="assignRightsFromRole('admin');"/> <?php echo $admtext['usradmin'] . "<br/><em class=\"smaller indent\">{$admtext['usradmind']}</em>"; ?></p>
				</td>
				<td valign="top">
					<p><strong><?php echo $admtext['rights']; ?></strong></p>

	<p>
	<input type="radio" name="form_allow_add" class="rights" value="1"<?php if( $row['allow_add'] == 1 ) echo " checked=\"checked\""; ?> onclick="document.form1.role[6].checked='checked';"/> <?php echo $admtext['allow_add']; ?><br/>
	<input type="radio" name="form_allow_add" class="rights" value="3"<?php if( $row['allow_add'] == 3 ) echo " checked=\"checked\""; ?> onclick="document.form1.role[6].checked='checked';"/> <?php echo $admtext['allow_media_add']; ?><br/>
	<input type="radio" name="form_allow_add" class="rights" value="0"<?php if( !$row['allow_add'] ) echo " checked=\"checked\""; ?> onclick="document.form1.role[6].checked='checked';"/> <?php echo $admtext['no_add']; ?><br/>
	</p>
	
	<p>
	<input type="radio" name="form_allow_edit" class="rights" value="1"<?php if( $row['allow_edit'] == 1 ) echo " checked=\"checked\""; ?> onclick="document.form1.role[6].checked='checked';"/> <?php echo $admtext['allow_edit']; ?><br/>
	<input type="radio" name="form_allow_edit" class="rights" value="3"<?php if( $row['allow_edit'] == 3 ) echo " checked=\"checked\""; ?> onclick="document.form1.role[6].checked='checked';"/> <?php echo $admtext['allow_media_edit']; ?><br/>
	<input type="radio" name="form_allow_edit" class="rights" value="2"<?php if( $row['tentative_edit'] ) echo " checked=\"checked\""; ?> onclick="document.form1.role[6].checked='checked';"/> <?php echo $admtext['tentative_edit']; ?><br/>
	<input type="radio" name="form_allow_edit" class="rights" value="0"<?php if( !$row['allow_edit'] && !$row['tentative_edit'] ) echo " checked=\"checked\""; ?> onclick="document.form1.role[6].checked='checked';"/> <?php echo $admtext['no_edit']; ?><br/>
	</p>

	<p>
	<input type="radio" name="form_allow_delete" class="rights" value="1"<?php if( $row['allow_delete'] == 1 ) echo " checked=\"checked\""; ?> onclick="document.form1.role[6].checked='checked';"/> <?php echo $admtext['allow_delete']; ?><br/>
	<input type="radio" name="form_allow_delete" class="rights" value="3"<?php if( $row['allow_delete'] == 3 ) echo " checked=\"checked\""; ?> onclick="document.form1.role[6].checked='checked';"/> <?php echo $admtext['allow_media_delete']; ?><br/>
	<input type="radio" name="form_allow_delete" class="rights" value="0"<?php if( !$row['allow_delete'] ) echo " checked=\"checked\""; ?> onclick="document.form1.role[6].checked='checked';"/> <?php echo $admtext['no_delete']; ?><br/>
	</p>
	
	<br/><hr/><br/>
	<p>
		<input type="checkbox" name="form_allow_living" value="1"<?php if( $row['allow_living'] > 0 ) echo " checked=\"checked\""; ?>> <?php echo $admtext['allow_living']; ?><br/>
		<input type="checkbox" name="form_allow_private" value="1"<?php if( $row['allow_private'] > 0 ) echo " checked=\"checked\""; ?>> <?php echo $admtext['allow_private']; ?><br/>
		<input type="checkbox" name="form_allow_private_notes" value="1"<?php if( $row['allow_private_notes'] > 0 ) echo " checked=\"checked\""; ?>> <?php echo $admtext['allow_private_notes']; ?><br/>
		<input type="checkbox" name="form_allow_ged" value="1"<?php if( $row['allow_ged'] ) echo " checked=\"checked\""; ?>> <?php echo $admtext['allow_ged']; ?><br/>
		<input type="checkbox" name="form_allow_pdf" value="1"<?php if( $row['allow_pdf'] ) echo " checked=\"checked\""; ?>> <?php echo $admtext['allow_pdf']; ?><br/>
		<input type="checkbox" name="form_allow_lds" value="1"<?php if( $row['allow_lds'] ) echo " checked=\"checked\""; ?>> <?php echo $admtext['allow_lds']; ?><br/>
		<input type="checkbox" name="form_allow_profile" value="1"<?php if( $row['allow_profile'] ) echo " checked=\"checked\""; ?>> <?php echo $admtext['allow_profile']; ?>
	</p>
				</td>
			</tr>
		</table>
		<br/><br/>

<?php
	echo "<strong>{$admtext['accesslimits']}</strong><br/>\n";
	$gedcom_mult = explode(',',$row['gedcom']);
	if(count($gedcom_mult) > 1)
		$adminaccess = 2;
	else
		$adminaccess = $row['gedcom'] || $row['branch'] ? 0 : 1;
?>
	<input type="radio" name="administrator" value="1" <?php if( $adminaccess == 1) echo "checked=\"checked\""; ?> onClick="handleAdmin('allow');"> <?php echo $admtext['allow_admin']; ?><br/>
	<input type="radio" name="administrator" value="0" <?php if( !$adminaccess) echo "checked=\"checked\""; ?> onClick="handleAdmin('restrict');"> <?php echo $admtext['limitedrights']; ?><br/>
	<div id="restrictions" <?php if($adminaccess) echo "style='display:none;'"; ?>><table>
		<tr><td valign="top">
		<span class="normal"><?php echo $admtext['tree']; ?>*:</span></td><td><span class="normal">
			<select name="gedcom" id="treeselect" onChange="var tree=getTree(this); if( !tree ) tree = 'none'; <?php echo $swapbranches; ?>">
				<option value=""></option>
<?php
	$treeresult = tng_query($treequery);
	
	while( $treerow = tng_fetch_assoc($treeresult) ) {
		echo "	<option value=\"{$treerow['gedcom']}\"";
		if( $row['gedcom'] == $treerow['gedcom'] ) echo " selected";
		echo ">{$treerow['treename']}</option>\n";
	}
?>
			</select></span>
			</td>
		</tr>
		<tr><td valign="top"><span class="normal"><?php echo $admtext['branch']; ?>**:</span></td><td><span class="normal">
<?php
	$query = "SELECT branch, gedcom, description FROM $branches_table WHERE gedcom = \"{$row['gedcom']}\" ORDER BY description";
	$branchresult = tng_query($query);

	$totbranches = tng_num_rows( $branchresult ) + 1;
	$selectnum = $totbranches < 8 ? $totbranches : 8;

	echo "<select name=\"branch\" id=\"branch\" size=\"$selectnum\">\n";
	echo "	<option value=\"\">{$admtext['allbranches']}</option>\n";
	while( $branch = tng_fetch_assoc( $branchresult ) ) {
		echo  "	<option value=\"{$branch['branch']}\"";
		if( $row['branch'] == $branch['branch'] ) echo " selected";
		echo ">{$branch['description']}</option>\n";
	}
	echo "</select>\n";
?>
		</span></td></tr>
	</table></div>
	<input type="radio" name="administrator" value="2" <?php if( $adminaccess == 2) echo "checked=\"checked\""; ?> onclick="handleAdmin('allow_multiple');"> <?php echo $admtext['mult_trees']; ?><br/>
	<div style="margin-left: 30px<?php if( $adminaccess != 2) echo ";display: none;"; ?>" id="multiple">
		<select multiple="yes" name="gedcom_mult[]" id="treeselect2">
<?php
		$treeresult = tng_query($treequery);

		while( $treerow = tng_fetch_assoc($treeresult) ) {
			echo "	<option value=\"{$treerow['gedcom']}\"";
			if(in_array($treerow['gedcom'],$gedcom_mult)) echo " selected";
			echo ">{$treerow['treename']}</option>\n";
		}
		tng_free_result($treeresult);
?>
		</select>
	</div>
	<br/>
<?php
	if( $row['allow_living'] == -1 ) { //account is inactive
		echo "<input type=\"checkbox\" name=\"notify\" value=\"1\" checked onClick=\"replaceText();\"> {$admtext['notify']}<br/>\n";
		$owner = $sitename ? $sitename : $dbowner;
		echo "<textarea name=\"welcome\" rows=\"5\" cols=\"50\">{$deftext['hello']} {$row['realname']},\r\n\r\n{$deftext['activated']}";
		if(!$tngconfig['omitpwd'])
			echo " {$deftext['infois']}:\r\n\r\n{$deftext['username']}: {$row['username']}\r\n{$deftext['password']}: {$row['password']}\r\n";
		echo "\r\n$owner\r\n$tngdomain</textarea><br/><br/>\n";
	}
	else
		echo "<input type=\"hidden\" name=\"notify\" value=\"0\">\n";
	if(!$numlangs) 
		echo "<input type=\"hidden\" name=\"preflang\" value=\"{$row['languageID']}\">\n";
?>
	<input type="hidden" name="userID" value="<?php echo isset($userID) ? $userID : ""; ?>">
	<input type="hidden" name="newuser" value="<?php echo isset($newuser) ? $newuser : ""; ?>">
    <input type="hidden" name="orguser" value="<?php echo $row['username']; ?>" />
    <input type="hidden" name="orgemail" value="<?php echo $row['email']; ?>" />
	<input type="hidden" name="orgpwd" value="<?php echo $row['password']; ?>">
	<input type="submit" name="submitx" class="btn" value="<?php echo $admtext['saveback']; ?>">
	<input type="submit" name="submitx" class="btn saveret" value="<?php echo $admtext['saveback']; ?>">
	<input type="submit" name="submit" accesskey="s" class="btn" value="<?php echo $admtext['savereturn']; ?>">
	<input type="submit" name="submit" accesskey="s" class="btn savestay" value="<?php echo $admtext['savereturn']; ?>">
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="window.location.href='admin_users.php';">
</form>
	<p style="font-size: 8pt;">
<?php 
	echo "*{$admtext['treemsg']}<br/>\n";
	echo "**{$admtext['branchmsg']}<br/>\n";
?>
	</p>
</td>
</tr>

</table>
</div>
<?php 
echo tng_adminfooter();
?>