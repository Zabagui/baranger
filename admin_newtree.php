<?php
include("begin.php");
include("adminlib.php");
$textpart = "trees";
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

$helplang = findhelp("trees_help.php");

if( !isset($beforeimport) ) $beforeimport = "";
if( !isset($treename) ) $treename = "";
if( !isset($description) ) $description = "";
if( !isset($owner) ) $owner = "";
if( !isset($email) ) $email = "";
if( !isset($address) ) $address = "";
if( !isset($city) ) $city = "";
if( !isset($state) ) $state = "";
if( !isset($zip) ) $zip = "";
if( !isset($country) ) $country = "";
if( !isset($phone) ) $phone = "";
if( !isset($private) ) $private = "";
if( !isset($disallowgedcreate) ) $disallowgedcreate = "";
if( !isset($disallowpdf) ) $disallowpdf = "";

if($beforeimport) {
	header("Content-type:text/html; charset=" . $session_charset);
?>
<div class="databack ajaxwindow" id="newtree">
<p class="subhead"><strong><?php echo $admtext['addnewtree']; ?></strong> |
	<a href="#" onclick="return openHelp('<?php echo $helplang; ?>/trees_help.php#add', 'newwindow', 'height=500,width=700,resizable=yes,scrollbars=yes'); newwindow.focus();"><?php echo $admtext['help']; ?></a></p>
<?php
}
else {
		tng_adminheader( $admtext['addnewtree'], $flags );
?>
<script type="text/javascript">
function validateTreeForm(form) {
	var rval = true;
	if( form.gedcom.value.length == 0 ) {
		alert("<?php echo $admtext['entertreeid']; ?>");
		rval = false;
	}
	else if( !alphaNumericCheck(form.gedcom.value) ) {
		alert("<?php echo $admtext['alphanum']; ?>");
		rval = false;
	}
	else if( form.treename.value.length == 0 ) {
		alert("<?php echo $admtext['entertreename']; ?>");
		rval = false;
	}
	return rval;
}

function alphaNumericCheck(string){
	var regex=/^[0-9A-Za-z_-]+$/; //^['a-zA-z']+$/
	return regex.test(string);
}
</script>
</head>

<?php
	echo tng_adminlayout();

	$allow_add_tree = $assignedtree ? 0 : $allow_add;
	$treetabs[0] = array(1,"admin_trees.php",$admtext['search'],"findtree");
	$treetabs[1] = array($allow_add_tree,"admin_newtree.php",$admtext['addnew'],"addtree");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/trees_help.php#add');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($treetabs,"addtree",$innermenu);
	echo displayHeadline($admtext['trees'] . " &gt;&gt; " . $admtext['addnewtree'],"img/trees_icon.gif",$menu,$message);
}
?>

<?php
	if(!$beforeimport) {
?>
<div class="admin-main">
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="adm-rounded-table">
<?php
	}
	else {
?>
<table border="0" cellpadding="10" cellspacing="2">
<?php
	}
?>
<tr>
<td class="<?php if(!$beforeimport) echo "tngshadow "; ?>databack">
	<form action="admin_addtree.php" method="post"  name="treeform" onsubmit="return validateTreeForm(this);">
	<table class="normal">
		<tr><td><?php echo $admtext['treeid']; ?>:</td><td><input type="text" name="gedcom" size="20" maxlength="20"></td></tr>
		<tr><td><?php echo $admtext['treename']; ?>:</td><td><input type="text" name="treename" size="50" value="<?php echo $treename; ?>"></td></tr>
		<tr><td valign="top"><?php echo $admtext['description']; ?>:</td><td><textarea cols="40" rows="3" name="description"><?php echo $description; ?></textarea></td></tr>
		<tr><td><?php echo $admtext['owner']; ?>:</td><td><input type="text" name="owner" size="50" value="<?php echo $owner; ?>"></td></tr>
		<tr><td><?php echo $admtext['email']; ?>:</td><td><input type="text" name="email" size="50" value="<?php echo $email; ?>"></td></tr>
		<tr><td><?php echo $admtext['address']; ?>:</td><td><input type="text" name="address" size="50" value="<?php echo $address; ?>"></td></tr>
		<tr><td><?php echo $admtext['city']; ?>:</td><td><input type="text" name="city" size="50" value="<?php echo $city; ?>"></td></tr>
		<tr><td><?php echo $admtext['stateprov']; ?>:</td><td><input type="text" name="state" size="50" value="<?php echo $state; ?>"></td></tr>
		<tr><td><?php echo $admtext['zip']; ?>:</td><td><input type="text" name="zip" size="50" value="<?php echo $zip; ?>"></td></tr>
		<tr><td><?php echo $admtext['cap_country']; ?>:</td><td><input type="text" name="country" size="50" value="<?php echo $country; ?>"></td></tr>
		<tr><td><?php echo $admtext['phone']; ?>:</td><td><input type="text" name="phone" size="50" value="<?php echo $phone; ?>"></td></tr>
	</table>
	<span class="normal">
	<input type="checkbox" name="private" value="1"<?php if( $private ) echo " checked=\"checked\""; ?>> <?php echo $admtext['keepprivate']; ?><br/>
	<input type="checkbox" name="disallowgedcreate" value="1"<?php if( $disallowgedcreate ) echo " checked=\"checked\""; ?>> <?php echo $admtext['gedcomextraction']; ?><br/>
	<input type="checkbox" name="disallowpdf" value="1"<?php if( $disallowpdf ) echo " checked=\"checked\""; ?>> <?php echo $admtext['nopdf']; ?>
	<br/><br/></span>
	<input type="hidden" name="beforeimport" value="<?php echo $beforeimport; ?>">
<?php
	if($beforeimport) {
		$close_command = "jQuery('#LB_close').click();";
?>
	<input type="submit" name="submit" accesskey="s" class="btn" value="<?php echo $admtext['save']; ?>">
<?php
	} else {
		$close_command = "window.location.href='admin_trees.php';";
?>
	<input type="submit" name="submitx" class="btn" value="<?php echo $admtext['saveback']; ?>">
	<input type="submit" name="submit" accesskey="s" class="btn" value="<?php echo $admtext['savereturn']; ?>">
<?php
	}
?>
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="<?php echo $close_command; ?>">
	</form>
</td>
</tr>

</table>
</div>
<?php 
	if(!$beforeimport)
		echo tng_adminfooter();
?>