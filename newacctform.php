<?php
$textpart = "login";
$ID = "";
include("tng_begin.php");
if(!empty($cms['events'])){include('cmsevents.php'); cms_register();}

$query = "SELECT gedcom, treename FROM $trees_table ORDER BY treename";
$treeresult = tng_query($query);
$numtrees = tng_num_rows( $treeresult );

$query = "SELECT count(userID) as ucount FROM $users_table";
$userresult = tng_query($query);
$row = tng_fetch_assoc( $userresult );
$ucount = $row['ucount'];
tng_free_result($userresult);

$dataprotect_url = getURL( "data_protection_policy", 0 );

$_SESSION['tng_email'] = generatePassword(1);

tng_header( $text['regnewacct'], $flags );
?>
<script type="text/javascript">
function validateForm(form) {
	var rval = true;
	if( form.username.value.length == 0 ) {
		alert("<?php echo $text['enterusername']; ?>");
		rval = false;
	}
	else if( form.password.value.length == 0 ) {
		alert("<?php echo $text['enterpassword']; ?>");
		rval = false;
	}
	else if( form.password2.value.length == 0 ) {
		alert("<?php echo $text['enterpassword2']; ?>");
		rval = false;
	}
	else if( form.password.value != form.password2.value ) {
		alert("<?php echo $text['pwdsmatch']; ?>");
		rval = false;
	}
	else if( form.realname.value.length == 0 ) {
		alert("<?php echo $text['enterrealname']; ?>");
		rval = false;
	}
	else if( form.<?php echo $_SESSION['tng_email']; ?>.value.length == 0 || !checkEmail(form.<?php echo $_SESSION['tng_email']; ?>.value)) {
		alert("<?php echo $text['enteremail']; ?>");
		rval = false;
	}
	else if( form.em2.value.length == 0 ) {
		alert("<?php echo $text['enteremail2']; ?>");
		rval = false;
	}
	else if( form.<?php echo $_SESSION['tng_email']; ?>.value != form.em2.value ) {
		alert("<?php echo $text['emailsmatch']; ?>");
		rval = false;
	}
<?php
if($tngconfig['askconsent']) {
?>
	else if( !form.tng_user_consent.checked ) {
		alert("<?php echo $text['consentreq']; ?>");
		return false;
	}
<?php
}
?>
	return rval;
}	
</script>

<h1 class="header"><img src="<?php echo $cms['tngpath']; ?>img/tng_log2.gif" width="20" height="20" alt="" class="headericon"/>&nbsp;<?php echo $text['regnewacct']; ?></h1><br clear="left"/>
<?php 
echo tng_coreicons();

@include($cms['tngpath'] . "TNG_captcha.php");

if(!$tngconfig['disallowreg']) {
	echo "<p class=\"normal\"><strong>*{$text['required']}</strong></p>\n";
?>
<table border="0" cellpadding="0" cellspacing="2">
<tr>
<td>
<?php
	$onsubmit = $ucount ? "return validateForm(this);" : "alert('{$text['nousers']}');return false;";
	$formstr = getFORM( "addnewacct", "post", "form1", "", $onsubmit );
	echo $formstr;
?>
	<table class="normal">
		<tr><td valign="top"><?php echo $text['username']; ?>*:</td><td><input type="text" name="username" size="50" maxlength="50" /></td></tr>
		<tr><td valign="top"><?php echo $text['password']; ?>*:</td><td><input type="password" name="password" size="50" maxlength="50" /></td></tr>
		<tr><td valign="top"><?php echo $text['pwdagain']; ?>*:</td><td><input type="password" name="password2" size="50" maxlength="50" /></td></tr>
		<tr><td valign="top"><?php echo $text['realname']; ?>*:</td><td><input type="text" name="realname" size="50" maxlength="50" /></td></tr>
		<tr><td valign="top"><?php echo $text['phone']; ?>:</td><td><input type="text" name="phone" size="30" maxlength="30" /></td></tr>
		<tr><td valign="top"><?php echo $text['email']; ?>*:</td><td><input type="text" name="<?php echo $_SESSION['tng_email']; ?>" size="50" maxlength="100" /></td></tr>
		<tr><td valign="top"><?php echo $text['emailagain']; ?>*:</td><td><input type="text" name="em2" size="50" maxlength="100" /></td></tr>
		<tr><td valign="top"><?php echo $text['website']; ?>:</td><td><input type="text" name="website" size="50" maxlength="100" value="https://" /></td></tr>
		<tr><td valign="top"><?php echo $text['address']; ?>:</td><td><input type="text" name="address" size="50" maxlength="100" /></td></tr>
		<tr><td valign="top"><?php echo $text['city']; ?>:</td><td><input type="text" name="city" size="50" maxlength="64" /></td></tr>
		<tr><td valign="top"><?php echo $text['state']; ?>:</td><td><input type="text" name="state" size="50" maxlength="64" /></td></tr>
		<tr><td valign="top"><?php echo $text['zip']; ?>:</td><td><input type="text" name="zip" size="20" maxlength="10" /></td></tr>
		<tr><td valign="top"><?php echo $text['country']; ?>:</td><td><input type="text" name="country" size="50" maxlength="64" /></td></tr>
<?php
		$query = "SELECT languageID, display FROM $languages_table ORDER BY display";
		$langresult = tng_query($query);
		$numlangs = tng_num_rows($langresult);

		if($numlangs > 1) {
?>
		<tr>
			<td><?php echo $admtext['preflang']; ?>:</td>
			<td>
				<select name="preflang">
					<option value=""></option>
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
		<tr><td valign="top"><?php echo $text['acctcomments']; ?>:</td><td><textarea cols="50" rows="4" name="notes"></textarea></td></tr>
	</table>
	<p class="normal">
<?php
	if($tngconfig['askconsent']) {
?>
		<input type="checkbox" name="tng_user_consent" value="1"> 
<?php 
		echo $text['consent']; 
		if($tngconfig['dataprotect']) {
			echo "<br/><a href=\"{$dataprotect_url}\" target=\"_blank\">{$text['dataprotect']}</a>\n";
		}
	}
?>
		<br/><br/>
		<?php echo $text['accmail']; ?>
	</p>
	<br/>
<?php
	if($numlangs <= 1) {
?>
	<input type="hidden" name="preflang" value="">
<?php
	}
?>
	<input type="hidden" name="fingerprint" value="realperson">
	<input type="submit" name="submit" class="btn" id="submitbtn" value="<?php echo $text['submit']; ?>"/></form><br/>
</td>
</tr>

</table>
<?php
}
else
	echo "<p class=\"normal\">{$text['noregs']}</p>\n";

tng_footer( "" );
?>