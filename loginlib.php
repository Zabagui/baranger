<?php
	if(!empty($p) && !$cms['support'])
		$cms['tngpath'] = urldecode($p);
?>

<h1 class="header"><span class="headericon" id="unlock-hdr-icon"></span><?php echo $text['login']; ?></h1>

<?php
	if(!empty($message)) {
?>
	<font color="#FF0000"><span class="normal"><em><?php echo $text[$message]; ?></em>
	</span></font>
<?php
	}

$formstr = getFORM( "processlogin", "post", "form1", "", "" );
echo $formstr;
?>
<div class="normal">
	<div class="nw" id="loginblock">
		<div class="loginprompt"><?php echo $text['username']; ?>: </div>
		<input type="text" name="tngusername" class="<?php echo $loginfieldclass; ?>" id="tngusername" style="font-size: 16pt; height: auto" /><br/>

		<div class="loginprompt"><?php echo $text['password']; ?>: </div>
		<input type="password" name="tngpassword" class="<?php echo $pwdfieldclass; ?>" id="tngpassword" style="font-size: 16pt; height: auto" />
		<img src="img/pwdon.png" id="pwdicon" class="pwdicon" onclick="togglePwd('tngpassword','pwdicon');"/>

		<div id="resetrow" style="display:none">
			<div class="loginprompt"><?php echo $text['newpassword']; ?>: </div>
			<input type="password" name="newpassword" class="medfield" id="newpassword" style="font-size: 16pt; height: auto" />
			<img src="img/pwdon.png" id="newpwdicon" class="pwdicon" onclick="togglePwd('newpassword','newpwdicon');"/>
			<div class="loginprompt"><?php echo $text['newpassword2']; ?>: </div>
			<input type="password" name="newpassword2" class="medfield" id="newpassword2" style="font-size: 16pt; height: auto" onkeyup="if($('#newpassword').val() == $('#newpassword2').val()) {$('#loginsubmit').prop('disabled',false);} else {$('#loginsubmit').prop('disabled',true);}"/>
			<img src="img/pwdon.png" id="newpwdicon2" class="pwdicon" onclick="togglePwd('newpassword2','newpwdicon2');"/>
		</div>
	</div>
	<div class="login-options">
		<input type="checkbox" name="remember" value="1" /> <?php echo $text['rempass']; ?><br />
		<input type="checkbox" name="resetpass" value="1" onclick="if(this.checked) {$('#resetrow').show(); $('#loginsubmit').prop('disabled',true);} else {$('#resetrow').hide(); $('#loginsubmit').prop('disabled',false);}" /> <?php echo $text['resetpass']; ?>
	</div>
	<div>
		<input type="submit" class="<?php echo $loginbtnclass; ?>" id="loginsubmit" value="<?php echo $text['login']; ?>" />
	</div>
</div>
</form>
<br clear="both"/>
<?php
$sendlogin_url = getURL("sendlogin", 0);
$formstr = getFORM( "", "post", "form2", "", "return sendLogin(this, '$sendlogin_url');" );
echo $formstr;
?>
<div class="normal" id="forgot" style="clear:both">
	<p><?php echo $text['forgot1']; ?></p>
	<input type="text" class="forgotfield" name="email" id="email" placeholder="<?php echo $text['email']; ?>"/> <input type="submit" value="<?php echo $text['go']; ?>" />
	<div id="usnmsg" class="smaller"></div>

	<p><?php echo $text['forgot2']; ?></p>
	<input type="text" class="forgotfield" name="username" id="username" placeholder="<?php echo $text['username']; ?>"/> <input type="submit" value="<?php echo $text['go']; ?>" />
	<div id="pwdmsg" class="smaller"></div>
</div>
<?php
if(!$tngconfig['disallowreg'])
	echo "<p class=\"normal\">{$text['nologin']} <a href=\"{$cms['tngpath']}newacctform.php\">{$text['regnewacct']}</a></p>";
?>
</form>