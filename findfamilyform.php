<?php
include("begin.php");
include("adminlib.php");
$textpart = "families";
//include("getlang.php");
include("$mylanguage/admintext.php");

include($cms['tngpath'] . "checklogin.php");

if(!empty($mediaID))
	$mediaoption = ",mediaID:'$mediaID'";
else if(!empty($albumID))
	$mediaoption = ",albumID:'$albumID'";
else
	$mediaoption = "";

if(!isset($branch)) $branch = "";
$bailtext = $mediaoption ? $admtext['finish'] : $admtext['cancel'];

$applyfilter = "applyFilter({form:'findform1',fieldId:'myhusbname',myhusbname:jQuery('#myhusbname').val(),mywifename:jQuery('#mywifename').val(),myfamilyID:jQuery('#myfamilyID').val(),type:'F',tree:'$tree',branch:'branch',destdiv:'findresults'$mediaoption});";

header("Content-type:text/html; charset=" . $session_charset);
?>

<div class="databack ajaxwindow" id="finddiv">
	<form action="" method="post" name="findform1" id="findform1" onsubmit="return <?php echo $applyfilter; ?>">
    <p class="subhead"><strong><?php echo $admtext['findfamilyid']; ?></strong><br/>
    <span class="normal">(<?php echo $admtext['enternamepart']; ?>)</span></p>
	<table border="0" cellspacing="0" cellpadding="2" class="normal">
		<tr>
			<td><?php echo $admtext['husbname']; ?></td>
			<td><?php echo $admtext['wifename']; ?></td>
			<td><?php echo $admtext['familyid']; ?></td>
		</tr>
		<tr>
			<td><input type="text" name="myhusbname" id="myhusbname" class="shortfield" onkeyup="filterChanged(event, {form:'findform1',fieldId:'myhusbname',myhusbname:jQuery('#myhusbname').val(),mywifename:jQuery('#mywifename').val(),myfamilyID:jQuery('#myfamilyID').val(),type:'F',tree:'<?php echo $tree; ?>',branch:'<?php echo $branch; ?>',destdiv:'findresults'<?php echo $mediaoption; ?>});"/></td>
			<td><input type="text" name="mywifename" id="mywifename" class="shortfield" onkeyup="filterChanged(event, {form:'findform1',fieldId:'mywifename',myhusbname:jQuery('#myhusbname').val(),mywifename:jQuery('#mywifename').val(),myfamilyID:jQuery('#myfamilyID').val(),type:'F',tree:'<?php echo $tree; ?>',branch:'<?php echo $branch; ?>',destdiv:'findresults'<?php echo $mediaoption; ?>});"/></td>
			<td><input type="text" name="myfamilyID" id="myfamilyID" class="veryshortfield" onkeyup="filterChanged(event, {form:'findform1',fieldId:'myfamilyID',myhusbname:jQuery('#myhusbname').val(),mywifename:jQuery('#mywifename').val(),myfamilyID:jQuery('#myfamilyID').val(),type:'F',tree:'<?php echo $tree; ?>',branch:'<?php echo $branch; ?>',destdiv:'findresults'<?php echo $mediaoption; ?>});"/>
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