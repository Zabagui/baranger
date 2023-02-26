<?php
include("begin.php");
include("adminlib.php");
$textpart = "timeline";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");


$tng_search_tlevents = $_SESSION['tng_search_tlevents'];

$query = "SELECT * FROM $tlevents_table WHERE tleventID = \"$tleventID\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
tng_free_result($result);
$row['evdetail'] = preg_replace("/\"/", "&#34;",$row['evdetail']);

$helplang = findhelp("tlevents_help.php");

tng_adminheader( $admtext['modifytlevent'], $flags );
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

	$timelinetabs[0] = array(1,"admin_timelineevents.php",$admtext['search'],"findtlevent");
	$timelinetabs[1] = array($allow_add,"admin_newtlevent.php",$admtext['addnew'],"addtlevent");
	$timelinetabs[2] = array($allow_edit,"#",$admtext['edit'],"edit");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/tlevents_help.php#add');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($timelinetabs,"edit",$innermenu);
	echo displayHeadline($admtext['tlevents'] . " &gt;&gt; " . $admtext['modifytlevent'], "img/tlevents_icon.gif",$menu,"");
?>

<div class="admin-main">
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="adm-rounded-table">
<tr>
<td class="tngshadow databack">
	<form action="admin_updatetlevent.php" method="post" name="form1" id="form1" onSubmit="return validateForm();">
	<table class="normal">
<?php
	function doEventRow($label,$row,$dayname,$monthname,$yearname,$help){
		global $dates;
?>
	<tr>
		<td><span class="normal"><?php echo $label; ?>:</span></td>
		<td>
			<select name="<?php echo $dayname; ?>">
				<option value=""></option>
<?php
	for( $i = 1; $i <= 31; $i++ ) {
		echo "<option value=\"$i\"";
		if( $row[$dayname] == $i ) echo " selected";
		echo ">$i</option>\n";
	}
?>
			</select>
			<select name="<?php echo $monthname; ?>">
				<option value=""></option>
				<option value="1"<?php if( $row[$monthname] == 1 ) echo " selected"; ?>><?php echo $dates['JAN']; ?></option>
				<option value="2"<?php if( $row[$monthname] == 2 ) echo " selected"; ?>><?php echo $dates['FEB']; ?></option>
				<option value="3"<?php if( $row[$monthname] == 3 ) echo " selected"; ?>><?php echo $dates['MAR']; ?></option>
				<option value="4"<?php if( $row[$monthname] == 4 ) echo " selected"; ?>><?php echo $dates['APR']; ?></option>
				<option value="5"<?php if( $row[$monthname] == 5 ) echo " selected"; ?>><?php echo $dates['MAY']; ?></option>
				<option value="6"<?php if( $row[$monthname] == 6 ) echo " selected"; ?>><?php echo $dates['JUN']; ?></option>
				<option value="7"<?php if( $row[$monthname] == 7 ) echo " selected"; ?>><?php echo $dates['JUL']; ?></option>
				<option value="8"<?php if( $row[$monthname] == 8 ) echo " selected"; ?>><?php echo $dates['AUG']; ?></option>
				<option value="9"<?php if( $row[$monthname] == 9 ) echo " selected"; ?>><?php echo $dates['SEP']; ?></option>
				<option value="10"<?php if( $row[$monthname] == 10 ) echo " selected"; ?>><?php echo $dates['OCT']; ?></option>
				<option value="11"<?php if( $row[$monthname] == 11 ) echo " selected"; ?>><?php echo $dates['NOV']; ?></option>
				<option value="12"<?php if( $row[$monthname] == 12 ) echo " selected"; ?>><?php echo $dates['DEC']; ?></option>
			</select>
			<input type="text" name="<?php echo $yearname; ?>" size="4" value="<?php echo $row[$yearname]; ?>"/> <span class="normal"><?php echo $help; ?></span>
		</td>
	</tr>
<?php
	}
	doEventRow($admtext['startdt'],$row,"evday","evmonth","evyear",$admtext['yrreq']);
	doEventRow($admtext['enddt'],$row,"endday","endmonth","endyear","");
?>
	<tr>
        <td><?php echo $admtext['evtitle']; ?>:</td>
        <td><input type="text" name="evtitle" width="100" value="<?php echo $row['evtitle']; ?>" /></td>
    </tr>
	<tr>
        <td valign="top"><span class="normal"><?php echo $admtext['evdetail']; ?>:</span></td>
        <td colspan="2"><textarea cols="80" rows="8" name="evdetail"><?php echo $row['evdetail']; ?></textarea></td>
    </tr>
	</table><br/>&nbsp;
	<input type="hidden" name="tleventID" value="<?php echo $tleventID; ?>">
	<input type="submit" name="saveret" id="saveret" class="btn" accesskey="s" value="<?php echo $admtext['saveback']; ?>" />
	<input type="submit" name="saveret" id="saveret2" class="btn saveret" accesskey="s" value="<?php echo $admtext['saveback']; ?>" />
	<input type="submit" name="savestay" id="savestay" class="btn" value="<?php echo $admtext['savereturn']; ?>" />
	<input type="submit" name="savestay" id="savestay2" class="btn savestay" value="<?php echo $admtext['savereturn']; ?>" />
	</form>
</td>
</tr>

</table>
</div>
<?php 
echo tng_adminfooter();
?>