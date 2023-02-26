<?php
include("begin.php");
include("adminlib.php");
$textpart = "timeline";
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

$helplang = findhelp("tlevents_help.php");

tng_adminheader( $admtext['addnewtlevent'], $flags );
?>
<script type="text/javascript">
function validateForm( ) {
	var rval = true;
	if( document.form1.evyear.value.length == 0 ) {
		alert("<?php echo $admtext['enterevyear']; ?>");
		rval = false;
	}
	else if( document.form1.evdetail.value.length == 0 ) {
		alert("<?php echo $admtext['enterevdetail']; ?>");
		rval = false;
	}
	else if( document.form1.endyear.value.length == 0 && (document.form1.endmonth.selectedIndex > 0 || document.form1.endday.selectedIndex > 0)) {
		alert("If you enter a day or month for the ending date, you must also enter an ending year.");
		rval = false;
	}
	else if( (document.form1.evday.selectedIndex > 0 && document.form1.evmonth.selectedIndex <= 0) || (document.form1.endday.selectedIndex > 0 && document.form1.endmonth.selectedIndex <= 0) ) {
		alert("If you select a day, you must also select a month.");
		rval = false;
	}
	else if( document.form1.endyear.value && parseInt(document.form1.endyear.value) < parseInt(document.form1.evyear.value) ) {
		alert("Ending year is less than beginning year.");
		rval = false;
	}
	return rval;
}	
</script>
</head>

<?php
	echo tng_adminlayout();

	$timelinetabs[0] = array(1,"admin_timelineevents.php",$admtext['search'],"findtimeline");
	$timelinetabs[1] = array($allow_add,"admin_newtlevent.php",$admtext['addnew'],"addtlevent");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/tlevents_help.php#add');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($timelinetabs,"addtlevent",$innermenu);
	echo displayHeadline($admtext['tlevents'] . " &gt;&gt; " . $admtext['addnewtlevent'],"img/tlevents_icon.gif",$menu,"");
?>

<div class="admin-main">
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="adm-rounded-table">
<tr>
<td class="tngshadow databack">
	<form action="admin_addtlevent.php" method="post" name="form1" onSubmit="return validateForm();">
	<table class="normal">
<?php
	function doEventRow($label,$dayname,$monthname,$yearname,$help){
		global $dates;
?>
	<tr>
		<td><?php echo $label; ?>:</td>
		<td>
			<select name="<?php echo $dayname; ?>">
				<option value=""></option>
<?php
	for( $i = 1; $i <= 31; $i++ ) {
		echo "<option value=\"$i\">$i</option>\n";
	}
?>
			</select>
			<select name="<?php echo $monthname; ?>">
				<option value=""></option>
				<option value="1"><?php echo $dates['JAN']; ?></option>
				<option value="2"><?php echo $dates['FEB']; ?></option>
				<option value="3"><?php echo $dates['MAR']; ?></option>
				<option value="4"><?php echo $dates['APR']; ?></option>
				<option value="5"><?php echo $dates['MAY']; ?></option>
				<option value="6"><?php echo $dates['JUN']; ?></option>
				<option value="7"><?php echo $dates['JUL']; ?></option>
				<option value="8"><?php echo $dates['AUG']; ?></option>
				<option value="9"><?php echo $dates['SEP']; ?></option>
				<option value="10"><?php echo $dates['OCT']; ?></option>
				<option value="11"><?php echo $dates['NOV']; ?></option>
				<option value="12"><?php echo $dates['DEC']; ?></option>
			</select>
			<input type="text" name="<?php echo $yearname; ?>" size="4"/> <span class="normal"><?php echo $help; ?></span>
		</td>
	</tr>
<?php
	}
	doEventRow($admtext['startdt'],"evday","evmonth","evyear",$admtext['yrreq']);
	doEventRow($admtext['enddt'],"endday","endmonth","endyear","");
?>
	<tr>
        <td><?php echo $admtext['evtitle']; ?>:</td>
        <td><input type="text" name="evtitle" width="100" /></td>
    </tr>
	<tr>
        <td valign="top"><?php echo $admtext['evdetail']; ?>:</td>
        <td><textarea cols="80" rows="8" name="evdetail"></textarea></td>
    </tr>
	</table><br/>&nbsp;
	<input type="submit" name="submit" accesskey="s" class="btn" value="<?php echo $admtext['save']; ?>"></form>
</td>
</tr>

</table>
</div>
<?php 
echo tng_adminfooter();
?>