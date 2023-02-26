<?php
include("begin.php");
include("adminlib.php");
$textpart = "events";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

$helplang = findhelp("events_help.php");

header("Content-type:text/html; charset=" . $session_charset);
?>

<div class="databack ajaxwindow">
<p class="subhead"><strong><?php echo $admtext['addnewevent']; ?></strong> |
	<a href="#" onclick="return openHelp('<?php echo $helplang; ?>/events_help.php');"><?php echo $admtext['help']; ?></a></p>
<?php
	if(!empty($message)) {
?>
	<span class="normal red"><em><?php echo urldecode($message); ?></em>
	</span>
<?php
	}
?>
<form action="" method="post" name="form1" id="form1" onSubmit="return addEvent(this);" >
<table border="0" cellpadding="2" class="normal">
	<tr><td valign="top"><span class="normal"><?php echo $admtext['eventtype']; ?>:</span></td>
		<td>
			<span class="normal">
			<select name="eventtypeID" id="eventtypeID">
				<option value=""></option>
<?php
	$query = "SELECT * FROM $eventtypes_table WHERE type = \"$prefix\" ORDER BY tag";
	$evresult = tng_query($query);

	$events = array();
	while ( $eventtype = tng_fetch_assoc( $evresult ) ) {
		$display = getEventDisplay( $eventtype['display'] );
		$option = $display . ($eventtype['tag'] != "EVEN" ? " ({$eventtype['tag']})" : "");
		$optionlen = strlen($option);
		$option = substr($option,0,40);
		if($optionlen > strlen($option))
			$option .= "&hellip;";
		$events[$display] = "<option value=\"{$eventtype['eventtypeID']}\">$option</option>\n";
	}
	tng_free_result($evresult);

	ksort($events);
	foreach($events as $event)
		echo $event;
?>
			</select>
			</span>
		</td>
	</tr>
	<tr><td><?php echo $admtext['eventdate']; ?>:</td><td><input type="text" name="eventdate" onBlur="checkDate(this);"> <span class="normal"><?php echo $admtext['dateformat']; ?>:</span></td></tr>
	<tr><td><?php echo $admtext['eventplace']; ?>:</td><td valign="top"><input type="text" name="eventplace" id="eventplace" size="70"> &nbsp;<?php echo $admtext['text_or']; ?>&nbsp;
		<a href="#" onclick="return openFindPlaceForm('eventplace');"><img src="img/tng_find.gif" class="alignmiddle" title="<?php echo $admtext['find']; ?>" alt="<?php echo $admtext['find']; ?>" <?php echo $dims; ?> /></a></td></tr>
	<tr><td valign="top"><?php echo $admtext['detail']; ?>:</td><td><textarea name="info" rows="6" cols="70"></textarea></td></tr>
	<tr><td colspan="2"><strong><?php echo $admtext['dupfor']; ?>:</strong></td></tr>
	<tr>
		<td><?php echo $admtext['id']; ?>:</td>
		<td>
			<table class="normal" cellpadding="0"><tr><td><input type="text" name="dupIDs" id="dupIDs" class="medfield"> &nbsp;<?php echo $admtext['text_or']; ?>&nbsp;</td>
				<td><a href="#" onclick="return findItem('<?php echo $prefix; ?>','dupIDs','','<?php echo $tree; ?>','<?php echo $assignedbranch; ?>');" title="<?php echo $admtext['find']; ?>" class="smallicon admin-find-icon"></a></td></tr>
			</table>
		</td>
	</tr>
	<tr>
		<td></td>
		<td>(<?php echo $admtext['commas']; ?>)</td>
	</tr>
</table>
<?php echo displayToggle("plus9",0,"more",$admtext['more'],""); ?>
<br />
<div id="more" style="display:none">
<table border="0" cellpadding="2" class="normal">
	<tr><td><?php echo $admtext['age']; ?>:</td><td><input type="text" name="age" size="12" maxlength="12"></td></tr>
	<tr><td><?php echo $admtext['agency']; ?>:</td><td><input type="text" name="agency" size="40"></td></tr>
	<tr><td><?php echo $admtext['cause']; ?>:</td><td><input type="text" name="cause" size="40"></td></tr>
	<tr><td><?php echo $admtext['address1']; ?>:</td><td><input type="text" name="address1" size="40"></td></tr>
	<tr><td><?php echo $admtext['address2']; ?>:</td><td><input type="text" name="address2" size="40"></td></tr>
	<tr><td><?php echo $admtext['city']; ?>:</td><td><input type="text" name="city" size="40"></td></tr>
	<tr><td><?php echo $admtext['stateprov']; ?>:</td><td><input type="text" name="state" size="40"></td></tr>
	<tr><td><?php echo $admtext['zip']; ?>:</td><td><input type="text" name="zip" size="20"></td></tr>
	<tr><td><?php echo $admtext['countryaddr']; ?>:</td><td><input type="text" name="country" size="40"></td></tr>
	<tr><td><?php echo $admtext['phone']; ?>:</td><td><input type="text" name="phone" size="30"></td></tr>
	<tr><td><?php echo $admtext['email']; ?>:</td><td><input type="text" name="email" size="50"></td></tr>
	<tr><td><?php echo $admtext['website']; ?>:</td><td><input type="text" name="www" size="50"></td></tr>
</table>
<br />
</div>
<input type="hidden" name="persfamID" value="<?php echo $persfamID; ?>">
<input type="hidden" name="tree" value="<?php echo $tree; ?>">
<input type="submit" class="btn" name="submit" value="<?php echo $admtext['save']; ?>">
<input type="button" class="btn" name="cancel" value="<?php echo $text['cancel']; ?>" onclick="tnglitbox.remove();">
</form>
<br />
</div>
