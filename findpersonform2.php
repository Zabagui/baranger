<?php
include("begin.php");
include("adminlib.php");
$textpart = "findpersonform";
//include("getlang.php");
include("$mylanguage/admintext.php");

include($cms['tngpath'] . "checklogin.php");

if( $type == "map" ) {
	$firstfield = "personID";
	$subtitle = $admtext['enternamepart2'];
}
else {
	$firstfield = "mylastname";
	$subtitle = $admtext['enternamepart'];
}

header("Content-type:text/html; charset=" . $session_charset);
?>

<div class="databack ajaxwindow" id="finddiv">
<p class="subhead"><strong><?php echo $admtext['findpersonid']; ?></strong></p>

<form action="" name="findform1" id="findform1" onsubmit="return openFind(this,'findperson2.php');">
<span class="normal">(<?php echo $subtitle; ?>)</span><br/>

<input type="hidden" name="tree" value="<?php echo $tree; ?>">
<?php if( $formname == "" ) $formname = "form1"; ?>
<input type="hidden" name="formname" value="<?php echo $formname; ?>">
<?php if( $field == "" ) $field = "personID"; ?>
<input type="hidden" name="field" value="<?php echo $field; ?>">
<?php if( $type == "" ) $type = "text"; ?>
<input type="hidden" name="type" value="<?php echo $type; ?>">
<?php
	if( $nameplusid )
		echo "<input type=\"hidden\" name=\"nameplusid\" value=\"$nameplusid\">";
?>
<table border="0" cellspacing="0" cellpadding="2">
			<tr><td><span class="normal"><?php echo $admtext['firstname']; ?>: </span></td><td><input type="text" name="myfirstname" id="myfirstname"></td></tr>
			<tr><td><span class="normal"><?php echo $admtext['lastname']; ?>: </span></td><td><input type="text" name="mylastname" id="mylastname"></td></tr>
			<tr><td><span class="normal"><?php echo $admtext['personid']; ?>: </span></td><td><input type="text" name="personID"></td></tr>
</table><br/>
<input type="submit" value="<?php echo $admtext['search']; ?>"> <img src="img/spinner.gif" id="findspin" style="display:none">
</form>

</div>

<div class="databack" style="display:none;border:0px" id="findresults">
</div>