<?php
include("begin.php");
include("adminlib.php");
$textpart = "reports";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

$m = $mostwanted_table;
if($ID) {
	$query = "SELECT $m.title as title, $m.personID as personID, $m.description as description, $m.mediaID as mediaID, $m.gedcom as gedcom, mwtype, thumbpath,
		usecollfolder, $media_table.description as mtitle, $media_table.notes as mdesc, mediatypeID
		FROM $m
		LEFT JOIN $media_table on $m.mediaID = $media_table.mediaID
		LEFT JOIN $people_table on $m.personID = $people_table.personID
		WHERE $m.ID = \"$ID\"";
	$result = tng_query($query);
	$row = tng_fetch_assoc( $result );
	tng_free_result($result);
	$row['title'] = preg_replace("/\"/", "&#34;",$row['title']);
	$row['description'] = preg_replace("/\"/", "&#34;",$row['description']);
}
else {
	$row['title'] = "";
	$row['description'] = "";
	$row['personID'] = "";
	$row['mediaID'] = "";
	$row['gedcom'] = "";
	$row['mwtype'] = "";
	$row['thumbpath'] = "";
	$row['usecollfolder'] = "";
	$row['mtitle'] = "";
	$row['mdesc'] = "";
	$row['mediatypeID'] = "";
}

$helplang = findhelp("mostwanted_help.php");
if($row['mwtype']) $mwtype = $row['mwtype'];
$typemsg = $mwtype == "person" ? $admtext['mysperson'] : $admtext['mysphoto'];

header("Content-type:text/html; charset=" . $session_charset);
?>

<div class="databack ajaxwindow" id="more">
<p class="subhead"><strong><?php echo $admtext['mostwanted'] . ": " . $typemsg; ?></strong> |
	<a href="#" onclick="return openHelp('<?php echo $helplang; ?>/mostwanted_help.php');"><?php echo $admtext['help']; ?></a></p>
<form action="" name="editmostwanted" onsubmit="return updateMostWanted(this);">
<table border="0" cellpadding="2" class="normal">
	<tr><td><?php echo $admtext['title2']; ?>:</td><td><input type="text" name="title" size="60" maxlength="128" value="<?php echo $row['title']; ?>" style="width:500px"></td></tr>
	<tr><td valign="top"><?php echo $admtext['description']; ?>:</td><td><textarea name="description" rows="7" cols="60" style="width:500px"><?php echo $row['description']; ?></textarea></td></tr>
	<tr>
		<td><?php echo $admtext['tree']; ?>:</td>
		<td>
			<select name="mwtree" onchange="tree=this.options[this.selectedIndex].value">
<?php
if( $assignedtree ) {
	$wherestr = "WHERE gedcom = \"$assignedtree\"";
	$firsttree = $assignedtree;
}
else {
	$wherestr = "";
	$firsttree = isset($_COOKIE['tng_tree']) ? $_COOKIE['tng_tree'] : $row['gedcom'];
}
$query = "SELECT gedcom, treename FROM $trees_table $wherestr ORDER BY treename";
$treeresult = tng_query($query);

$trees = "";
while( $treerow = tng_fetch_assoc($treeresult) ) {
	echo "		<option value=\"{$treerow['gedcom']}\"";
	if($firsttree == $treerow['gedcom'])
		echo " selected=\"selected\"";
	echo ">{$treerow['treename']}</option>\n";
}
echo $trees;
tng_free_result($treeresult);
?>
			</select>
		</td>
	</tr>
	<tr><td><?php echo $admtext['person']; ?>:</td>
		<td>
			<table cellpadding="0" cellspacing="0" border="0" class="normal">
				<tr>
					<td>
						<input type="text" name="personID" id="personID" size="22" maxlength="22" value="<?php echo $row['personID']; ?>" class="shortfield"> &nbsp;<?php echo $admtext['text_or']; ?>&nbsp;
					</td>
					<td>
						<a href="#" onclick="return findItem('I','personID','',document.editmostwanted.mwtree.options[document.editmostwanted.mwtree.selectedIndex].value,'<?php echo $assignedbranch; ?>');" title="<?php echo $admtext['find']; ?>" class="smallicon admin-find-icon"></a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br /><input type="button" value="<?php echo $admtext['selphoto']; ?>" onclick="return openMostWantedMediaFind(document.editmostwanted.mwtree.options[document.editmostwanted.mwtree.selectedIndex].value);" />
<div id="mwphoto">
<table width="95%" cellpadding="5" cellspacing="1" style="padding-top:6px">
	<tr>
		<td class="lightback" id="mwthumb" style="width:<?php echo ($thumbmaxw+6); ?>px;height:<?php echo ($thumbmaxh+6); ?>px;text-align:center;">
<?php
		initMediaTypes();
		$lmediatypeID = $row['mediatypeID'];
		$usefolder = $row['usecollfolder'] ? $mediatypes_assoc[$lmediatypeID] : $mediapath;

			if( $row['thumbpath'] && file_exists( "$rootpath$usefolder/" . $row['thumbpath'] ) ) {
			$photoinfo = @GetImageSize( "$rootpath$usefolder/" . $row['thumbpath'] );
			if( $photoinfo[1] < 50 ) {
				$photohtouse = $photoinfo[1];
				$photowtouse = $photoinfo[0];
			}
			else {
				$photohtouse = 50;
				$photowtouse = intval( 50 * $photoinfo[0] / $photoinfo[1] ) ;
			}
			echo "<img src=\"$usefolder/" . str_replace("%2F","/",rawurlencode( $row['thumbpath'] )) . "\" border=\"0\" width=\"$photowtouse\" height=\"$photohtouse\" id=\"img_$ID\" alt=\"{$row['mtitle']}\" />";
		}
		else {
			echo "&nbsp;";
		}
		$row['mdesc'] = xmlcharacters($row['mdesc']);
		$truncated = substr($row['mdesc'],0,90);
		$truncated = strlen($row['mdesc']) > 90 ? substr($truncated,0,strrpos($truncated,' ')) . '&hellip;' : $row['mdesc'];
?>
		</td>
		<td class="lightback normal" id="mwdetails"><?php echo "<u>" . xmlcharacters($row['mtitle']) . "</u><br />" . $truncated; ?>&nbsp;</td>
	</tr>
</table>
</div>
<br />

<input type="hidden" name="ID" value="<?php echo $ID; ?>">
<input type="hidden" name="mediaID" id="mediaID" value="<?php echo $row['mediaID']; ?>">
<input type="hidden" name="orgmediaID" id="orgmediaID" value="<?php echo $row['mediaID']; ?>">
<input type="hidden" name="mwtype" id="mwtype" value="<?php echo $mwtype; ?>">
<input type="submit" name="submit" class="btn" value="<?php echo $admtext['save']; ?>">
</form>

</div>