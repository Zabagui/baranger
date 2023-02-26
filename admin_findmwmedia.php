<?php
include("begin.php");
include("adminlib.php");
$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( $assignedtree ) {
	$wherestr = "WHERE gedcom = \"$assignedtree\"";
	$tree = $assignedtree;
}
else
	$wherestr = "";
$treequery = "SELECT gedcom, treename FROM $trees_table $wherestr ORDER BY treename";
initMediaTypes();
header("Content-type:text/html; charset=" . $session_charset);
?>

<div class="databack ajaxwindow" id="finddiv">
	<span class="subhead"><strong><?php echo $admtext['addmedia']; ?></strong></span><br/>
	<form name="find2"  onsubmit="getNewMwMedia(this,1); return false;">
	<table class="normal">
		<tr>
			<td><?php echo $admtext['searchfor']; ?>: </td>
			<td><input type="text" name="searchstring" value="<?php if( isset($searchstring) ) echo $searchstring; ?>" id="searchstring"></td>
			<td>
				<input type="submit" name="searchbutton" value="<?php echo $admtext['search']; ?>" class="aligntop">
				<span id="spinner1" style="display:none"><img src="img/spinner.gif" /></span>
			</td>
		</tr>
	</table>
	<input type="hidden" name="mediatypeID" value="<?php if( isset($mediatypeID) ) echo $mediatypeID; ?>" />
	<input type="hidden" name="tree" value="<?php echo $tree; ?>" />
	</form>
	<div id="newmedia" style="width:620px;height:430px;overflow:auto"></div><br />

</div>