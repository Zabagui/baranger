<?php
include("begin.php");
include("adminlib.php");
$textpart = "sources";
//include("getlang.php");
include("$mylanguage/admintext.php");

include($cms['tngpath'] . "checklogin.php");

if($mediaID)
	$mediaoption = ",mediaID:'$mediaID'";
else if($albumID)
	$mediaoption = ",albumID:'$albumID'";
else
	$mediaoption = "";

$bailtext = $mediaoption ? $admtext['finish'] : $admtext['cancel'];

$applyfilter = "applyFilter({form:'findrepoform1',fieldId:'mytitle',type:'R',tree:'$tree',destdiv:'reporesults'$mediaoption});";

header("Content-type:text/html; charset=" . $session_charset);
?>

<div class="databack ajaxwindow" id="findrepodiv">
	<form action="" method="post" name="findrepoform1" id="findrepoform1" onsubmit="return <?php echo $applyfilter; ?>">
    <p class="subhead"><strong><?php echo $admtext['findrepoid']; ?></strong><br/>
    <span class="normal">(<?php echo $admtext['enterrepopart']; ?>)</span></p>
	<table border="0" cellspacing="0" cellpadding="2" class="normal">
		<tr>
		   	<td><?php echo $admtext['title2']; ?>: </td>
			<td><input type="text" name="mytitle" id="mytitle" class="longfield" onkeyup="filterChanged(event, {form:'findrepoform1',fieldId:'mytitle',type:'R',tree:'<?php echo $tree; ?>',destdiv:'reporesults'<?php echo $mediaoption; ?>});"/></td>
			<td><input type="submit" value="<?php echo $admtext['search']; ?>"> <input type="button" value="<?php echo $bailtext; ?>" onclick="gotoSection(seclitbox, null);"></td>
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

    <div id="reporesults" style="width:605px;height:385px;overflow:auto"></div>
</div>