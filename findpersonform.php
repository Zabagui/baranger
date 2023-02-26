<?php
include("begin.php");
include($cms['tngpath'] . "adminlib.php");
$textpart = "findpersonform";
include($cms['tngpath'] . "getlang.php");
include($cms['tngpath'] . "$mylanguage/admintext.php");

include($cms['tngpath'] . "checklogin.php");

if( isset($type) && $type == "map" ) {
	$subtitle = $admtext['enternamepart2'];
}
else {
	$subtitle = $admtext['enternamepart'];
}

if(!empty($mediaID))
	$mediaoption = ",mediaID:'$mediaID'";
else if(!empty($albumID))
	$mediaoption = ",albumID:'$albumID'";
else
	$mediaoption = "";

$bailtext = $mediaoption ? $admtext['finish'] : $admtext['cancel'];
if(!isset($branch))
	$branch = "";

$applyfilter = "applyFilter({form:'findform1',fieldId:'myflastname',myflastname:jQuery('#myflastname').val(),myffirstname:jQuery('#myffirstname').val(),myfpersonID:jQuery('#myfpersonID').val(),type:'I',tree:'$tree',branch:'$branch',destdiv:'findresults'$mediaoption});";

header("Content-type:text/html; charset=" . $session_charset);
?>

<div class="databack ajaxwindow" id="finddiv">
	<form action="" method="post" name="findform1" id="findform1" onsubmit="return <?php echo $applyfilter; ?>">
    <p class="subhead"><strong><?php echo $admtext['findpersonid']; ?></strong><br/>
    <span class="normal">(<?php echo $subtitle; ?>)</span></p>
	<table border="0" cellspacing="0" cellpadding="2" class="normal">
		<tr>
			<td><?php echo $admtext['firstname']; ?></td>
			<td><?php echo $admtext['lastname']; ?></td>
			<td><?php echo $admtext['personid']; ?></td>
		</tr>
		<tr>
			<td><input type="text" name="myffirstname" id="myffirstname" class="shortfield" tabindex="1" onkeyup="filterChanged(event, {form:'findform1',fieldId:'myffirstname',myflastname:jQuery('#myflastname').val(),myffirstname:jQuery('#myffirstname').val(),myfpersonID:jQuery('#myfpersonID').val(),type:'I',tree:'<?php echo $tree; ?>',branch:'<?php echo $branch; ?>',destdiv:'findresults'<?php echo $mediaoption; ?>});"/></td>
			<td><input type="text" name="myflastname" id="myflastname" class="shortfield" tabindex="2" onkeyup="filterChanged(event, {form:'findform1',fieldId:'myflastname',myflastname:jQuery('#myflastname').val(),myffirstname:jQuery('#myffirstname').val(),myfpersonID:jQuery('#myfpersonID').val(),type:'I',tree:'<?php echo $tree; ?>',branch:'<?php echo $branch; ?>',destdiv:'findresults'<?php echo $mediaoption; ?>});"/></td>
			<td><input type="text" name="myfpersonID" id="myfpersonID" tabindex="3" class="veryshortfield" onkeyup="filterChanged(event, {form:'findform1',fieldId:'myfpersonID',myflastname:jQuery('#myflastname').val(),myffirstname:jQuery('#myffirstname').val(),myfpersonID:jQuery('#myfpersonID').val(),type:'I',tree:'<?php echo $tree; ?>',branch:'<?php echo $branch; ?>',destdiv:'findresults'<?php echo $mediaoption; ?>});"/>
				<input type="submit" value="<?php echo $admtext['search']; ?>"/> <input type="button" value="<?php echo $bailtext; ?>" onclick="gotoSection(seclitbox, null);"/></td>
		</tr>
		<tr>
			<td colspan="3">
				<input type="radio" name="filter" value="s" onclick="<?php echo $applyfilter; ?>" /> <?php echo $text['startswith']; ?> &nbsp;&nbsp; <input type="radio" name="filter" value="c" checked="checked" onclick="<?php echo $applyfilter; ?>" /> <?php echo $text['contains']; ?>
			</td>
		</tr>
	</table>
	</form>

	<br/>
	<span class="normal"><strong><?php echo $admtext['searchresults']; ?></strong> (<?php echo $admtext['clicktoselect']; ?>)</span>

    <div id="findresults" style="width:605px;height:365px;overflow:auto"></div>
</div>