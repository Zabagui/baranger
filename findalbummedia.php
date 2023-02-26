<?php
include("begin.php");
include("adminlib.php");
$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

include($cms['tngpath'] . "checklogin.php");

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
	<span class="subhead"><strong><?php echo $admtext['addmedia']; ?></strong><br/>
	<form name="find2" onsubmit="getNewMedia(this,1); return false;">
	<table>
		<tr>
			<td><span class="normal"><?php echo $admtext['mediatype']; ?>: </span></td>
			<td><span class="normal"><?php echo $admtext['tree']; ?>: </span></td>
			<td colspan="2"><span class="normal"><?php echo $admtext['searchfor']; ?>: </span></td>
		</tr>
		<tr>
			<td>
				<select name="mediatypeID" onChange="toggleHeadstoneCriteria(document.find2,this.options[this.selectedIndex].value); getNewMedia(document.find2,0);">
					<option value=""><?php echo $admtext['all']; ?></option>
<?php
	foreach( $mediatypes as $mediatype ) {
		$msgID = $mediatype['ID'];
		echo "	<option value=\"$msgID\">" . $mediatype['display'] . "</option>\n";
	}
?>
				</select>
			</td>
			<td>
				<select name="searchtree" onchange="getNewMedia(document.find2,0)">
<?php
  		if( !$assignedtree )
  			echo "	<option value=\"\">{$admtext['alltrees']}</option>\n";
  		$treeresult = tng_query($treequery) or die ($admtext['cannotexecutequery'] . ": $treequery");
  		while( $treerow = tng_fetch_assoc($treeresult) ) {
   			echo "	<option value=\"{$treerow['gedcom']}\"";
			if( isset($tree) && $treerow['gedcom'] == $tree ) echo " selected";
   			echo ">{$treerow['treename']}</option>\n";
   		}
		tng_free_result($treeresult);
?>
				</select>
			</td>
			<td><input type="text" name="searchstring" value="<?php if( isset($searchstring) ) echo $searchstring; ?>" id="searchstring">
			</td>
			<td>
				<input type="submit" name="searchbutton" value="<?php echo $admtext['search']; ?>" class="aligntop">
				<span id="spinner1" style="display:none"><img src="img/spinner.gif" /></span>
			</td>
		</tr>
	</table>
	<table>
		<tr id="hsstatrow" style="display:none">
			<td><span class="normal"><?php echo $admtext['status']; ?>: </span></td>
			<td><span class="normal"><?php echo $admtext['cemetery']; ?>: </span></td>
		</tr>
		<tr id="cemrow" style="display:none">
			<td>
				<select name="hsstat" onchange="getNewMedia(document.find2,0)">
					<option value="">&nbsp;</option>
					<option value="<?php echo $admtext['notyetlocated']; ?>"><?php echo $admtext['notyetlocated']; ?></option>
					<option value="<?php echo $admtext['located']; ?>"><?php echo $admtext['located']; ?></option>
					<option value="<?php echo $admtext['unmarked']; ?>"><?php echo $admtext['unmarked']; ?></option>
					<option value="<?php echo $admtext['missing']; ?>"><?php echo $admtext['missing']; ?></option>
					<option value="<?php echo $admtext['cremated']; ?>"><?php echo $admtext['cremated']; ?></option>
				</select>
			</td>
			<td>
			<select name="cemeteryID" onchange="getNewMedia(document.find2,0)" style="width:380px">
				<option value="" selected="selected"></option>
<?php
$query = "SELECT cemname, cemeteryID, city, county, state, country FROM $cemeteries_table ORDER BY country, state, county, city, cemname";
$cemresult = tng_query($query);
while( $cemrow = tng_fetch_assoc($cemresult) ) {
	$cemetery = "{$cemrow['country']}, {$cemrow['state']}, {$cemrow['county']}, {$cemrow['city']}, {$cemrow['cemname']}";
	echo "		<option value=\"{$cemrow['cemeteryID']}\"";
	if( isset($cemeteryID) && $cemeteryID == $cemrow['cemeteryID'] ) echo " selected";
	echo ">$cemetery</option>\n";
}
?>
			</select>
			</td>
		</tr>
	</table>

	</form>
	<div id="newmedia" style="width:720px;height:430px;overflow:auto"></div><br />

</div>