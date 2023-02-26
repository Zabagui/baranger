<?php
include("begin.php");
include("adminlib.php");
$textpart = "findplace";
//include("getlang.php");
include("$mylanguage/admintext.php");

include($cms['tngpath'] . "checklogin.php");

if($session_charset != "UTF-8")
	$place = tng_utf8_decode($place);

if(!empty($mediaID))
	$mediaoption = ",mediaID:'$mediaID'";
else if(!empty($albumID))
	$mediaoption = ",albumID:'$albumID'";
else
	$mediaoption = "";

$bailtext = $mediaoption ? $admtext['finish'] : $admtext['cancel'];

$applyfilter = "applyFilter({form:'findform1',fieldId:'myplace', type:'L', tree:'$tree', destdiv:'placeresults', temple:getTempleCheck()$mediaoption});";

header("Content-type:text/html; charset=" . $session_charset);
?>

<div class="databack ajaxwindow" id="finddiv">
	<form action="" method="post" name="findform1" id="findform1" onsubmit="return <?php echo $applyfilter; ?>">
    <p class="subhead"><strong><?php echo $admtext['findplace']; ?></strong><br/>
    <span class="normal">(<?php echo $admtext['enterplacepart']; ?>)</span></p>
	<table border="0" cellspacing="0" cellpadding="2" class="normal">
		<tr>
		   	<td><?php echo $admtext['place']; ?>: </td>
			<td><input type="text" name="myplace" id="myplace" onkeyup="filterChanged(event, {form:'findform1',fieldId:'myplace', type:'L', tree:'<?php echo $tree; ?>', destdiv:'placeresults', temple:getTempleCheck()<?php echo $mediaoption; ?>});"/></td>
			<td><input type="submit" value="<?php echo $admtext['search']; ?>"/> <input type="button" value="<?php echo $bailtext; ?>" onclick="gotoSection(seclitbox, null);"/></td>
		</tr>
		<tr>
			<td colspan="3">
				<input type="radio" name="filter" value="s" onclick="<?php echo $applyfilter; ?>" /> <?php echo $text['startswith']; ?> &nbsp;&nbsp; <input type="radio" name="filter" value="c" checked="checked" onclick="<?php echo $applyfilter; ?>" /> <?php echo $text['contains']; ?>
			</td>
		</tr>
<?php
	if(!empty($temple)) {
?>
    	<tr>
            <td>&nbsp;</td><td colspan="2"><input type="checkbox" value="1" name="temple" id="temple" checked="checked" onclick="lastFilter = ''; applyFilter({form:'findform1', fieldId:'myplace', type:'L', tree:'<?php echo $tree; ?>', destdiv:'placeresults', temple:getTempleCheck()<?php echo $mediaoption; ?>});"/> <?php echo $admtext['findtemples']; ?></td>
    	</tr>
<?php
	}
?>
	</table>
	</form>

	<br/>
	<span class="normal"><strong><?php echo $admtext['searchresults']; ?></strong> (<?php echo $admtext['clicktoselect']; ?>)</span>

    <div id="placeresults" style="width:605px;height:385px;overflow:auto"></div>
</div>