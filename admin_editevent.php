<?php
include("begin.php");
include("adminlib.php");
$textpart = "events";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include($cms['tngpath'] . "checklogin.php");

$query = "SELECT display, $events_table.eventtypeID as eventtypeID, eventdate, eventplace, tag, age, agency, cause, $events_table.gedcom as gedcom, $events_table.addressID, address1, address2, city, state, zip, country, info, phone, email, www, type FROM ($events_table, $eventtypes_table) 
	LEFT JOIN $address_table on $events_table.addressID = $address_table.addressID 
	WHERE eventID = \"$eventID\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
tng_free_result($result);
$row['eventplace'] = preg_replace("/\"/", "&#34;",$row['eventplace'] ?? '');
$row['info'] = preg_replace("/\"/", "&#34;",$row['info'] ?? '');
$row['age'] = preg_replace("/\"/", "&#34;",$row['age'] ?? '');
$row['agency'] = preg_replace("/\"/", "&#34;",$row['agency'] ?? '');
$row['cause'] = preg_replace("/\"/", "&#34;",$row['cause'] ?? '');
$row['address1'] = preg_replace("/\"/", "&#34;",$row['address1'] ?? '');
$row['address2'] = preg_replace("/\"/", "&#34;",$row['address2'] ?? '');
$row['city'] = preg_replace("/\"/", "&#34;",$row['city'] ?? '');
$row['state'] = preg_replace("/\"/", "&#34;",$row['state'] ?? '');
$row['zip'] = preg_replace("/\"/", "&#34;",$row['zip'] ?? '');
$row['country'] = preg_replace("/\"/", "&#34;",$row['country'] ?? '');

$display = getEventDisplay( $row['display'] );

$helplang = findhelp("events_help.php");

header("Content-type:text/html; charset=" . $session_charset);
?>

<div class="databack ajaxwindow">
<p class="subhead"><strong><?php echo $admtext['modifyevent']; ?></strong> |
	<a href="#" onclick="return openHelp('<?php echo $helplang; ?>/events_help.php');"><?php echo $admtext['help']; ?></a></p>
<form action="" method="post" name="form1" id="form1" onSubmit="return updateEvent(this);">
<table border="0" cellpadding="2" class="normal">
	<tr><td><?php echo $admtext['eventtype']; ?>:</td>
		<td><?php echo "{$row['tag']} $display"; ?></td>
	</tr>
	<tr><td><?php echo $admtext['eventdate']; ?>:</td><td><input type="text" name="eventdate" id="eventdate" value="<?php echo $row['eventdate']; ?>" onBlur="checkDate(this);"> <span class="normal"><?php echo $admtext['dateformat']; ?>:</span></td></tr>
	<tr><td><?php echo $admtext['eventplace']; ?>:</td><td valign="top"><input type="text" name="eventplace" id="eventplace" size="70" value="<?php echo $row['eventplace']; ?>"> &nbsp;<?php echo $admtext['text_or']; ?>&nbsp;
		<a href="#" onclick="return openFindPlaceForm('eventplace');"><img src="img/tng_find.gif" class="alignmiddle" title="<?php echo $admtext['find']; ?>" alt="<?php echo $admtext['find']; ?>" <?php echo $dims; ?> /></a></td></tr>
	<tr><td valign="top"><?php echo $admtext['detail']; ?>:</td><td><textarea name="info" rows="6" cols="70"><?php echo $row['info']; ?></textarea></td></tr>
	<tr><td colspan="2"><strong><?php echo $admtext['dupfor']; ?>:</strong></td></tr>
	<tr>
		<td><?php echo $admtext['id']; ?>:</td>
		<td>
			<table class="normal" cellpadding="0"><tr><td><input type="text" name="dupIDs" id="dupIDs" value="" class="medfield"> &nbsp;<?php echo $admtext['text_or']; ?>&nbsp;</td>
				<td><a href="#" onclick="return findItem('<?php echo $row['type']; ?>','dupIDs','','<?php echo $row['gedcom']; ?>','<?php echo $assignedbranch; ?>');" title="<?php echo $admtext['find']; ?>" class="smallicon admin-find-icon"></a></td></tr>
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
	<tr><td><?php echo $admtext['age']; ?>:</td><td><input type="text" name="age" size="12" maxlength="12" value="<?php echo $row['age']; ?>"></td></tr>
	<tr><td><?php echo $admtext['agency']; ?>:</td><td><input type="text" name="agency" size="40" value="<?php echo $row['agency']; ?>"></td></tr>
	<tr><td><?php echo $admtext['cause']; ?>:</td><td><input type="text" name="cause" size="40" value="<?php echo $row['cause']; ?>"></td></tr>
	<tr><td><?php echo $admtext['address1']; ?>:</td><td><input type="text" name="address1" size="40" value="<?php echo $row['address1']; ?>"></td></tr>
	<tr><td><?php echo $admtext['address2']; ?>:</td><td><input type="text" name="address2" size="40" value="<?php echo $row['address2']; ?>"></td></tr>
	<tr><td><?php echo $admtext['city']; ?>:</td><td><input type="text" name="city" size="40" value="<?php echo $row['city']; ?>"></td></tr>
	<tr><td><?php echo $admtext['stateprov']; ?>:</td><td><input type="text" name="state" size="40" value="<?php echo $row['state']; ?>"></td></tr>
	<tr><td><?php echo $admtext['zip']; ?>:</td><td><input type="text" name="zip" size="20" value="<?php echo $row['zip']; ?>"></td></tr>
	<tr><td><?php echo $admtext['countryaddr']; ?>:</td><td><input type="text" name="country" size="40" value="<?php echo $row['country']; ?>"></td></tr>
	<tr><td><?php echo $admtext['phone']; ?>:</td><td><input type="text" name="phone" size="30" value="<?php echo $row['phone']; ?>"></td></tr>
	<tr><td><?php echo $admtext['email']; ?>:</td><td><input type="text" name="email" size="50" value="<?php echo $row['email']; ?>"></td></tr>
	<tr><td><?php echo $admtext['website']; ?>:</td><td><input type="text" name="www" size="50" value="<?php echo $row['www']; ?>"></td></tr>
</table>
<br />
</div>
<input type="hidden" name="addressID" value="<?php echo $row['addressID']; ?>">
<input type="hidden" name="eventID" value="<?php echo $eventID; ?>">
<input type="hidden" name="tree" value="<?php echo $row['gedcom']; ?>">
<input type="submit" class="btn" name="submit" value="<?php echo $admtext['save']; ?>">
<input type="button" class="btn" name="cancel" value="<?php echo $text['cancel']; ?>" onclick="tnglitbox.remove();">
</form>
<br />
</div>
