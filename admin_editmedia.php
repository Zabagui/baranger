<?php
include("begin.php");
include($subroot . "mapconfig.php");
$mapkeystr = $map['key'] && $map['key'] != "1" ? "&amp;key=" . $map['key'] . "&amp;callback=initMap" : "";
include("adminlib.php");
$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( !$allow_media_edit && (!$allow_media_add || !$added)) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}
$showmedia_url = getURL( "showmedia", 1 );

include("showmedialib.php");

$query = "SET SQL_BIG_SELECTS=1";
$result = tng_query($query);

$query = "SELECT *, DATE_FORMAT(changedate,\"%d %b %Y %H:%i:%s\") as changedate FROM $media_table WHERE mediaID = \"$mediaID\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
$row['description'] = !empty($row['description']) ? preg_replace("/\"/", "&#34;",$row['description']) : "";
$row['notes'] = preg_replace("/\"/", "&#34;",$row['notes']);
$row['datetaken'] = !empty($row['datetaken']) ? preg_replace("/\"/", "&#34;",$row['datetaken']) : "";
$row['placetaken'] = !empty($row['placetaken']) ? preg_replace("/\"/", "&#34;",$row['placetaken']) : "";
$row['owner'] = !empty($row['owner']) ? preg_replace("/\"/", "&#34;",$row['owner']) : "";
if(!empty($row['map'])) {
	$row['map'] = preg_replace("/\"/", "&#34;",$row['map']);
	$row['map'] = preg_replace("/>/", "&gt;",$row['map']);
	$row['map'] = preg_replace("/</", "&lt;",$row['map']);
}
else
	$row['map'] = "";
//$row['bodytext'] = preg_replace("/\"/", "&#34;",$row['bodytext']);
//$row['bodytext'] = preg_replace("/>/", "&gt;",$row['bodytext']);
//$row['bodytext'] = preg_replace("/</", "&lt;",$row['bodytext']);
if($row['usenl'])
	$row['bodytext'] = nl2br($row['bodytext']);
if($row['abspath']) 
	$row['path'] = !empty($row['path']) ? preg_replace("/&/", "&amp;",$row['path']) : "";
tng_free_result($result);

$mediatypeID = $row['mediatypeID'];
$path = isset($path) ? stripslashes($path) : "";
$thumbpath = isset($thumbpath) ? stripslashes($thumbpath) : "";
if( $row['form'] )
	$form = strtoupper($row['form']);
else {
	preg_match( "/\.(.+)$/", $row['path'], $matches );
	$form = isset($matches[1]) ? strtoupper($matches[1]) : "";
}

if( $assignedtree ) {
	$wherestr = "WHERE gedcom = \"$assignedtree\"";
	$tree = $assignedtree;
}
else
	$wherestr = "";
$treequery = "SELECT gedcom, treename FROM $trees_table $wherestr ORDER BY treename";
$treeresult = tng_query($treequery) or die ($admtext['cannotexecutequery'] . ": $treequery");
$treenum = 0;
while( $treerow = tng_fetch_assoc($treeresult) ) {
	$treenum++;
	$trees[$treenum] = $treerow['gedcom'];
	$treename[$treenum] = $treerow['treename'];
}
tng_free_result($treeresult);

$query = "SELECT $medialinks_table.medialinkID as mlinkID, $medialinks_table.personID as personID, $medialinks_table.eventID, people.lastname as lastname, people.lnprefix as lnprefix, people.firstname as firstname, people.prefix as prefix, people.suffix as suffix, people.nameorder as nameorder, people.title, people.birthdate, people.birthdatetr, people.altbirthdate, people.altbirthdatetr, people.deathdate, people.deathdatetr, altdescription, altnotes, $medialinks_table.gedcom as gedcom, people.branch as branch, treename,
	familyID, people.personID as personID2, wifepeople.personID as wpersonID, wifepeople.firstname as wfirstname, wifepeople.lnprefix as wlnprefix, wifepeople.lastname as wlastname, wifepeople.prefix as wprefix, wifepeople.suffix as wsuffix, wifepeople.nameorder as wnameorder, wifepeople.title as wtitle, wifepeople.birthdate as wbirthdate, wifepeople.birthdatetr as wbirthdatetr, wifepeople.altbirthdate as waltbirthdate, wifepeople.altbirthdatetr as waltbirthdatetr, wifepeople.deathdate as wdeathdate, wifepeople.deathdatetr as wdeathdatetr,
	husbpeople.personID as hpersonID, husbpeople.firstname as hfirstname, husbpeople.lnprefix as hlnprefix, husbpeople.lastname as hlastname, husbpeople.prefix as hprefix, husbpeople.suffix as hsuffix, husbpeople.nameorder as hnameorder, husbpeople.title as htitle, husbpeople.birthdate as hbirthdate, husbpeople.birthdatetr as hbirthdatetr, husbpeople.altbirthdate as haltbirthdate, husbpeople.altbirthdatetr as haltbirthdatetr, husbpeople.deathdate as hdeathdate, husbpeople.deathdatetr as hdeathdatetr,
	sources.sourceID, sources.title as sourcetitle, citationID, repositories.repoID as repoID, reponame, defphoto, linktype, dontshow, people.living, people.private, $families_table.living as fliving, $families_table.private as fprivate
	FROM $medialinks_table
	LEFT JOIN $trees_table as trees ON $medialinks_table.gedcom = trees.gedcom
	LEFT JOIN $people_table AS people ON $medialinks_table.personID = people.personID AND $medialinks_table.gedcom = people.gedcom
	LEFT JOIN $families_table ON $medialinks_table.personID = $families_table.familyID AND $medialinks_table.gedcom = $families_table.gedcom
	LEFT JOIN $sources_table AS sources ON $medialinks_table.personID = sources.sourceID AND $medialinks_table.gedcom = sources.gedcom
	LEFT JOIN $citations_table AS citations ON $medialinks_table.personID = citations.citationID AND $medialinks_table.gedcom = citations.gedcom
	LEFT JOIN $repositories_table AS repositories ON $medialinks_table.personID = repositories.repoID AND $medialinks_table.gedcom = repositories.gedcom
	LEFT JOIN $people_table AS husbpeople ON $families_table.husband = husbpeople.personID AND $families_table.gedcom = husbpeople.gedcom
	LEFT JOIN $people_table AS wifepeople ON $families_table.wife = wifepeople.personID AND $families_table.gedcom = wifepeople.gedcom
	WHERE mediaID = \"$mediaID\" ORDER BY $medialinks_table.medialinkID DESC";
$result2 = tng_query($query);
$numlinks = tng_num_rows( $result2 );
//took this out because nicEdit histories wouldn't open with the div turned off
//$startclosed = $numlinks ? 0 : 1;

$helplang = findhelp("media_help.php");

tng_adminheader( $admtext['modifymedia'], $flags );

$standardtypes = array();
$moptions = "";
$likearray = "var like = new Array();\n";
foreach( $mediatypes as $mediatype ) {
	if(!$mediatype['type'])
		$standardtypes[] = "\"" . $mediatype['ID'] . "\"";
	$msgID = $mediatype['ID'];
	$moptions .= "	<option value=\"$msgID\"";
	if($msgID == $mediatypeID) $moptions .= " selected";
	$moptions .= ">" . $mediatype['display'] . "</option>\n";
	$likearray .= "like['$msgID'] = '{$mediatype['liketype']}';\n";
}
$sttypestr = implode(",",$standardtypes);

$treestr = $tngconfig['mediatrees'] ? $row['gedcom'] . "/" : "";
$usefolder = $row['usecollfolder'] ? $mediatypes_assoc[$mediatypeID] : $mediapath;
//$cleanfile = $session_charset == "UTF-8" ? utf8_decode($row['thumbpath']) : $row['thumbpath'];
if( $row['thumbpath'] && file_exists("$rootpath$usefolder/$treestr" . $row['thumbpath'])) {
	$photoinfo = @GetImageSize( "$rootpath$usefolder/$treestr" . $row['thumbpath'] );
	if( $photoinfo[1] < 50 ) {
		$photohtouse = $photoinfo[1];
		$photowtouse = $photoinfo[0];
	}
	else {
		$photohtouse = 50;
		$photowtouse = intval( 50 * $photoinfo[0] / $photoinfo[1] ) ;
	}
	$photo = "<img class=\"adminthumb\" src=\"$usefolder/$treestr" . str_replace("%2F","/",rawurlencode( $row['thumbpath'] )) . "\" width=\"$photowtouse\" height=\"$photohtouse\" style=\"border-color:#000000;margin-right:6px\"></span>\n";
}
else
	$photo = "";


if($row['path'] && ($form == "JPG" || $form == "JPEG" || $form == "GIF" || $form == "PNG" ) ) {
	$size = @GetImageSize( "$rootpath$usefolder/" . $row['path'] );
	$isphoto = TRUE;
}
else {
	$size = "";
	$isphoto = FALSE;
}
if( $map['key'] && $isConnected)
    echo "<script type=\"text/javascript\" src=\"{$http}://maps.googleapis.com/maps/api/js?language={$text['glang']}$mapkeystr\"></script>\n";
?>
<?php
	$onload = $onunload = "";
	if($isphoto && !$row['abspath'])
		$onload = "init();";
	$placeopen = 0;
	if($map['key']) {
		include "googlemaplib2.php";
		if(!$map['startoff']) {
			$onload .= "divbox('mapcontainer');";
			$placeopen = 1;
		}
	}
	if($onload) $onload = "onload=\"$onload\"";
?>
<script>
<?php if(!empty($ref)) { echo "window.opener.location.reload(false);\n"; } ?>
</script>
</head>

<?php
	echo tng_adminlayout();

	$mediatabs[0] = array(1,"admin_media.php",$admtext['search'],"findmedia");
	$mediatabs[1] = array($allow_media_add,"admin_newmedia.php",$admtext['addnew'],"addmedia");
	$mediatabs[2] = array($allow_media_edit,"admin_ordermediaform.php",$admtext['text_sort'],"sortmedia");
	$mediatabs[3] = array($allow_media_edit && !$assignedtree,"admin_thumbnails.php",$admtext['thumbnails'],"thumbs");
	$mediatabs[4] = array($allow_media_add && !$assignedtree,"admin_photoimport.php",$admtext['import'],"import");
	$mediatabs[5] = array($allow_media_add,"admin_mediaupload.php",$admtext['upload'],"upload");
	$mediatabs[6] = array($allow_media_edit,"#",$admtext['edit'],"edit");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/media_help.php#modify');\" class=\"lightlink\">{$admtext['help']}</a> ";
	$innermenu .= "&nbsp;|&nbsp;<a href=\"#\" class=\"lightlink\" onClick=\"return toggleAll('on');\">{$text['expandall']}</a> &nbsp;|&nbsp; <a href=\"#\" class=\"lightlink\" onClick=\"return toggleAll('off');\">{$text['collapseall']}</a>";
	$innermenu .= " &nbsp;|&nbsp; <a href=\"$showmedia_url" . "mediaID=$mediaID\" target=\"_blank\" class=\"lightlink\">{$admtext['test']}</a>";
	$menu = doMenu($mediatabs,"edit",$innermenu);
	echo displayHeadline($admtext['media'] . " &gt;&gt; " . $admtext['modifymedia'],"img/photos_icon.gif",$menu,"");
?>

<div class="admin-main">
<form action="admin_updatemedia.php" method="post" name="form1" id="form1" ENCTYPE="multipart/form-data" onsubmit="return validateForm();" >
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="adm-rounded-table">
<tr>
<td class="tngshadow databack">
	<table cellpadding="0" cellspacing="0" class="normal">
		<tr>
			<td valign="top"><div id="thumbholder" style="margin-right:5px;<?php if(!$photo) echo "display:none"; ?>"><?php echo $photo; ?></div></td>
			<td>
				<span class="plainheader"><?php echo $row['description']; ?></span><br/>
				<?php echo $row['notes']; ?>

				<div class="topbuffer bottombuffer smallest">
<?php
				$return = !empty($cw) ? "saveclose" : "saveret";
				echo "<a href=\"#\" onclick=\"jQuery('#{$return}').click();\" class=\"smallicon si-plus admin-save-icon\">{$admtext['save']}</a>\n";
?>
                 <br /><br />
				</div>

				<span class="smallest"><?php echo $admtext['lastmodified'] . ": " . $row['changedate'] . ($row['changedby'] ? " ({$row['changedby']})" : ""); ?></span>
			</td>
		</tr>
	</table>
</td>
</tr>
<tr>
<td class="tngshadow databack">
	<?php echo displayToggle("plus0",1,"mediafile",$admtext['imagefile'],$admtext['uplsel']); ?>

	<div id="mediafile">
	<br/>
	<table class="normal">
	<tr>
		<td valign="top"><?php echo $admtext['mediatype']; ?>:</td>
		<td>
			<select name="mediatypeID" onchange="switchOnType(this.options[this.selectedIndex].value)">
<?php
	foreach( $mediatypes as $mediatype ) {
		$msgID = $mediatype['ID'];
		echo "	<option value=\"$msgID\"";
		if( $msgID == $mediatypeID ) echo " selected";
		echo ">" . $mediatype['display'] . "</option>\n";
	}
?>
			</select>
<?php
	if(!$assignedtree && $allow_add && $allow_edit && $allow_delete) {
?>
			<input type="button" name="addnewmediatype" value="<?php echo $admtext['addnewcoll']; ?>" class="aligntop" onclick="tnglitbox = new LITBox('admin_newcollection.php?field=mediatypeID',{width:600,height:340});">
			<input type="button" name="editmediatype" id="editmediatype" value="<?php echo $admtext['edit']; ?>" style="vertical-align:top;display:none" onclick="editMediatype(document.form1.mediatypeID);">
			<input type="button" name="delmediatype" id="delmediatype" value="<?php echo $admtext['text_delete']; ?>" style="vertical-align:top;display:none" onclick="confirmDeleteMediatype(document.form1.mediatypeID);">
<?php
	}
?>
		</td>
	</tr>
	<tr><td valign="top" colspan="2"><input type="checkbox" name="abspath" value="1"<?php if( $row['abspath'] ) echo " checked"; ?> onClick="toggleMediaURL();"><span class="normal"> <?php echo $admtext['abspath']; ?></span></td></tr>
	<tr><td colspan="2"><strong><br/><?php echo $admtext['imagefile']; ?></strong></td></tr>
	<tr id="imgrow"><td><?php echo $admtext['imagefiletoupload']; ?>*:</td><td><input type="file" name="newfile" size="60" onChange="populatePath(document.form1.newfile,document.form1.path);prepopulateThumb();"></td></tr>
	<tr id="pathrow">
		<td><?php echo $admtext['pathwithinphotos']; ?>**:</td>
		<td><input type="text" value="<?php if( !$row['abspath'] ) echo $row['path']; ?>" name="path" id="path" size="60" onchange="prepopulateThumb();"><input type="hidden" value="<?php if( !$row['abspath'] ) echo $row['path']; ?>" id="path_org" name="path_org"><input type="hidden" id="path_last" name="path_last"> <input type="button" value="<?php echo "{$admtext['select']}..."; ?>" name="photoselect" onclick="javascript:var folder = document.form1.usecollfolder[0].checked ? document.form1.mediatypeID.options[document.form1.mediatypeID.selectedIndex].value : 'media';FilePicker('path',folder);"></td>
	</tr>
	<tr id="abspathrow" style="display:none"><td><?php echo $admtext['mediaurl']; ?>:</td><td><input type="text" value="<?php if( $row['abspath'] ) echo $row['path']; ?>" name="mediaurl" size="60"></td></tr>

<!-- history section -->
	<tr id="bodytextrow"><td valign="top"><?php echo $admtext['bodytext']; ?>:</td><td><textarea wrap cols="90" rows="11" name="bodytext" id="bodytext"><?php echo $row['bodytext']; ?></textarea></td></tr>

<?php
	if( function_exists( "imageJpeg" ) ) {
?>
	<tr>
		<td valign="top"><strong><br/><?php echo $admtext['thumbnailfile']; ?></strong></td>
		<td valign="top"><br/>
			<input type="radio" name="thumbcreate" value="auto" onClick="document.form1.newthumb.style.visibility='hidden'; document.form1.thumbselect.style.visibility='hidden'; prepopulateThumb(); document.form1.abspath.checked=false;"> <?php echo $admtext['autoimg']; ?> &nbsp;
			<input type="radio" name="thumbcreate" value="specify" checked="checked" onClick="document.form1.newthumb.style.visibility='visible'; document.form1.thumbselect.style.visibility='visible';"> <?php echo $admtext['specifyimg']; ?>
		</td>
	</tr>
<?php
	}
	else {
?>
	<tr><td colspan="2"><strong><br/><?php echo $admtext['thumbnailfile']; ?></strong></td></tr>
<?php
	}
?>
	<tr><td><?php echo $admtext['imagefiletoupload']; ?>*:</td><td><input type="file" name="newthumb" size="60" onChange="populatePath(document.form1.newthumb,document.form1.thumbpath);"></td></tr>
	<tr>
		<td><?php echo $admtext['pathwithinphotos']; ?>**:</td>
		<td><input type="text" value="<?php echo $row['thumbpath']; ?>" name="thumbpath" id="thumbpath" size="60"><input type="hidden" value="<?php if( !$row['abspath'] ) echo $row['thumbpath']; ?>" id="thumbpath_org" name="thumbpath_org"><input type="hidden" id="thumbpath_last" name="thumbpath_last"> <input type="button" value="<?php echo "{$admtext['select']}..."; ?>" name="thumbselect" OnClick="javascript:var folder = document.form1.usecollfolder[0].checked ? document.form1.mediatypeID.options[document.form1.mediatypeID.selectedIndex].value : 'media';FilePicker('thumbpath',folder);"></td>
	</tr>
	<tr>
		<td valign="top"><strong><br/><?php echo $admtext['put_in']; ?></strong></td>
		<td valign="top"><br/>
			<input type="radio" name="usecollfolder" value="1"<?php if( $row['usecollfolder'] ) echo " checked"; ?>> <?php echo $admtext['usecollect']; ?> &nbsp;
			<input type="radio" name="usecollfolder" value="0"<?php if( !$row['usecollfolder'] ) echo " checked"; ?>> <?php echo $admtext['usemedia']; ?>
		</td>
	</tr>
	<tr id="vidrow1"><td><?php echo $admtext['width']; ?>:</td><td><input type="text" name="width" value="<?php echo $row['width']; ?>" size="40"></td></tr>
	<tr id="vidrow2"><td><?php echo $admtext['height']; ?>:</td><td><input type="text" name="height" value="<?php echo $row['height']; ?>" size="40">
		<span class="normal"><?php if($form != "PDF") echo "({$admtext['controller']})"; ?></span>
	</td></tr>
	</table>
	<p class="smaller">
<?php
	echo "*{$admtext['leaveblankphoto']}<br/>\n";
	echo "**{$admtext['requiredphoto']}<br/>\n";
?>
	</p>
	</div>
</td>
</tr>

<tr>
<td class="tngshadow databack">
	<?php echo displayToggle("plus1",1,"details",$admtext['newmediainfo'],$admtext['minfosubt']); ?>

	<div id="details">
	<br/>
	<table class="normal">
	<tr><td valign="top"><?php echo $admtext['title2']; ?>:</td><td><textarea wrap cols="70" rows="3" name="description"><?php echo $row['description']; ?></textarea></td></tr>
	<tr><td valign="top"><?php echo $admtext['description']; ?>:</td><td><textarea wrap cols="70" rows="5" name="notes"><?php echo $row['notes']; ?></textarea></td></tr>
	<tr><td><?php echo $admtext['photoowner']; ?>:</td><td><input type="text" name="owner" value="<?php echo $row['owner']; ?>" size="40"></td></tr>
	<tr><td><?php echo $admtext['datetaken']; ?>:</td><td><input type="text" name="datetaken" value="<?php echo $row['datetaken']; ?>" size="40" onblur="checkDate(this);"></td></tr>
	<tr>
		<td><?php echo $admtext['tree']; ?>: </td>
		<td>
<?php
	if( $assignedtree ) {
		if( $row['gedcom'] ) {
			$treeresult = tng_query($treequery);
			$treerow = tng_fetch_assoc($treeresult);
			echo $treerow['treename'];
			tng_free_result($treeresult);
		}
		else
			echo $admtext['alltrees'];
		echo "<input type=\"hidden\" name=\"tree\" value=\"{$row['gedcom']}\">";
	}
	else {
		echo "<select name=\"tree\" onchange=\"$('#microtree').val($(this).val());\">";
		echo "	<option value=\"\">{$admtext['alltrees']}</option>\n";
		if( $row['gedcom'] ) $tree = $row['gedcom'];

		$treeresult = tng_query($treequery);
		while( $treerow = tng_fetch_assoc($treeresult) ) {
			echo "	<option value=\"{$treerow['gedcom']}\"";
			if( $treerow['gedcom'] == $row['gedcom'] ) echo " selected";
			echo ">{$treerow['treename']}</option>\n";
		}
		tng_free_result($treeresult);
	}
?>
			</select>
		</td>
	</tr>

<!-- headstone section -->
	<tr id="cemrow">
		<td><?php echo $admtext['cemetery']; ?>: </td>
		<td>
			<div id="cemselect">
				<select name="cemeteryID">
					<option value="" selected="selected">&nbsp;</option>
<?php
$query = "SELECT cemname, cemeteryID, city, county, state, country FROM $cemeteries_table ORDER BY cemname, city, county, state, country";
$cemresult = tng_query($query);
while( $cemrow = tng_fetch_assoc($cemresult) ) {
	$cemetery = "{$cemrow['cemname']} - {$cemrow['city']}, {$cemrow['county']}, {$cemrow['state']}, {$cemrow['country']}";
	echo "		<option value=\"{$cemrow['cemeteryID']}\"";
	if( $row['cemeteryID'] == $cemrow['cemeteryID'] ) echo " selected";
	echo ">$cemetery</option>\n";
}
?>
				</select>
			</div>
		</td>
	</tr>
	<tr id="hsplotrow"><td valign="top"><?php echo $admtext['plot']; ?>:</td><td><textarea wrap cols="70" rows="2" name="plot"><?php echo $row['plot']; ?></textarea></td></tr>
	<tr id="hsstatrow">
		<td><?php echo $admtext['status']; ?>:</td>
		<td>
			<select name="status">
				<option value="">&nbsp;</option>
				<option value="notyetlocated"<?php if( $row['status'] == 'notyetlocated' ) echo " selected"; ?>><?php echo $admtext['notyetlocated']; ?></option>
				<option value="located"<?php if( $row['status'] == 'located' ) echo " selected"; ?>><?php echo $admtext['located']; ?></option>
				<option value="unmarked"<?php if( $row['status'] == 'unmarked' ) echo " selected"; ?>><?php echo $admtext['unmarked']; ?></option>
				<option value="missing"<?php if( $row['status'] == 'missing' ) echo " selected"; ?>><?php echo $admtext['missing']; ?></option>
				<option value="moved"<?php if( $row['status'] == 'moved' ) echo " selected"; ?>><?php echo $admtext['moved']; ?></option>
				<option value="cremated"<?php if( $row['status'] == 'cremated' ) echo " selected"; ?>><?php echo $admtext['cremated']; ?></option>
			</select>
		</td>
	</tr>

	<tr><td colspan="2" />&nbsp;</tr>
	<tr><td valign="top" colspan="2"><input type="checkbox" name="alwayson" value="1" id="img_alwayson"<?php if( $row['alwayson'] ) echo " checked"; ?> onchange="if($(this).is(':checked')){$('#img_private').prop('checked',false);}"> <?php echo $admtext['alwayson']; ?></td></tr>
	<tr><td valign="top" colspan="2"><input type="checkbox" name="newwindow" value="1"<?php if( $row['newwindow'] ) echo " checked"; ?>> <?php echo $admtext['newwin']; ?></td></tr>
	<tr><td valign="top" colspan="2"><input type="checkbox" name="private" value="1" id="img_private"<?php if( $row['private'] ) echo " checked"; ?> onchange="if($(this).is(':checked')){$('#img_alwayson').prop('checked',false);}"> <?php echo $admtext['private']; ?></td></tr>

<!-- headstone section -->
	<tr id="linktocemrow"><td colspan="2" valign="top"><input type="checkbox" name="linktocem" value="1"<?php if( $row['linktocem'] ) echo " checked"; ?>> <?php echo $admtext['linktocem']; ?></td></tr>
	<tr id="maprow"><td colspan="2" valign="top"><input type="checkbox" name="showmap" value="1"<?php if( $row['showmap'] ) echo " checked"; ?>> <?php echo $admtext['showmap']; ?></td></tr>
	</table>
	</div>
</td>
</tr>

<tr>
<td class="tngshadow databack">
	<?php echo displayToggle("plus2",1,"links",$admtext['medialinks'] . " (<span id=\"linkcount\">$numlinks</span>)",$admtext['linkssubt']); ?>

	<?php include("micro_medialinks.php"); ?>
</td>
</tr>

<?php
	if( $isphoto && !$row['abspath'] ) {
?>
<tr>
<td class="tngshadow databack">
	<?php echo displayToggle("plus3",0,"imagemapdiv",$admtext['imgtags'],$admtext['mapinstr2']); ?>

	<div id="imagemapdiv" class="normal" style="display:none">
	<br />
	<p style="max-width:700px"><?php echo $admtext['mapinstr3']; ?></p>

	<table border="0" cellspacing="0" cellpadding="2" class="normal">
		<tr>
			<td><?php echo $admtext['tree']; ?>:</td>
			<td>
				<select name="maptree" id="maptree">
			<?php
				$lookfortree = !empty($row['gedcom']) ? $row['gedcom'] : $usetree;
				for( $j = 1; $j <= $treenum; $j++ ) {
					echo "	<option value=\"$trees[$j]\"";
					if($trees[$j] == $lookfortree) echo " selected";
					echo ">$treename[$j]</option>\n";
				}
			?>
				</select>
			</td>
			<td>
				<select name="linktype" id="linktype">
					<option value="I"><?php echo $admtext['person']; ?></option>
					<option value="F"><?php echo $admtext['family']; ?></option>
					<option value="S"><?php echo $admtext['source']; ?></option>
					<option value="R"><?php echo $admtext['repository']; ?></option>
					<option value="C"><?php echo $admtext['citation']; ?></option>
					<option value="L"><?php echo $admtext['place']; ?></option>
				</select>
			</td>
			<td>&nbsp; <?php echo $admtext['text_or']; ?>&nbsp; </td>
			<td><?php echo $admtext['title'] . ": "; ?><input type="text" name="urltitle" id="urltitle"/></td>
			<td><?php echo $admtext['url'] . ": "; ?><input type="text" name="urladdress" id="urladdress" class="longfield" /></td>
		</tr>
	</table><br/>
	<?php
		$width = !empty($size[0]) ? $size[0] : 0;
		$height = !empty($size[1]) ? $size[1] : 0;
		if( $width && $height ) {
			if( $tngconfig['imgmaxw'] && ($width > $tngconfig['imgmaxw']) ) {
				$width = $tngconfig['imgmaxw'];
				$height = intval( $width * $size[1] / $size[0] ) ;
			}
			if( $tngconfig['imgmaxh'] && ($height > $tngconfig['imgmaxh']) ) {
				$height = $tngconfig['imgmaxh'];
				$width = intval( $height * $size[0] / $size[1] ) ;
			}
		}
		$widthstr = "width=\"$width\"";
		$heightstr = "height=\"$height\"";
		echo "{$admtext['imgdim']}: $width {$admtext['pixw']} x $height {$admtext['pixh']}";
		$treestr = $tngconfig['mediatrees'] && $row['gedcom'] ? $row['gedcom'] . "/" : "";
	?>
	<br/>
	<div>
	<div id="imgholder" style="position:relative;overflow:auto;max-width:1250px;max-height:800px">
	<img id="myimg" src="<?php echo "$usefolder/$treestr" . str_replace("%2F","/",rawurlencode( $row['path'] )); ?>" border="0" <?php echo "$widthstr $heightstr"; ?> alt="<?php echo $admtext['circleinstr']; ?>" style="cursor:crosshair;">
<?php
echo getRectangles($mediaID);
?>
	</div>
	<p class="normal"><?php echo $admtext['imgmap']; ?>:
	<br/><textarea cols="80" rows="4" name="imagemap" id="imagemap"><?php echo $row['map']; ?></textarea></p>
	</div>
	</div>
</td>
</tr>
<?php
	} //end abspath condition
?>

<tr>
<td class="tngshadow databack">
	<?php echo displayToggle("plus4",$placeopen,"placeinfo",$admtext['placetaken'],""); ?>

	<div id="placeinfo"<?php if(!$placeopen) echo " style=\"display:none\""; ?>>
	<table class="topbuffer normal" width="100%">
	<tr>
		<td width="150"><?php echo $admtext['placetaken']; ?>:</td>
		<td><input type="text" name="place" id="place" value="<?php echo $row['placetaken']; ?>" size="40" style="float:left"><a href="#" onclick="return openFindPlaceForm('place');" title="<?php echo $admtext['find']; ?>" class="smallicon admin-find-icon dn2px"></a></td>
	</tr>
<?php
	if( $map['key'] ) {
?>
	<tr>
		<td colspan="2">
		<div style="padding:0px 10px 10px 0px">
<?php
// draw the map here
		include "googlemapdrawthemap.php";
?>
		</div>
		</td>
	</tr>
<?php
	}
?>
	<tr><td><?php echo $admtext['latitude']; ?>:</td><td><input type="text" name="latitude" value="<?php echo $row['latitude']; ?>" size="20" id="latbox"></td></tr>
	<tr><td><?php echo $admtext['longitude']; ?>:</td><td><input type="text" name="longitude" value="<?php echo $row['longitude']; ?>" size="20" id="lonbox"></td></tr>
<?php
	if( $map['key'] ) {
?>
	<tr><td><?php echo $admtext['zoom']; ?>:</td><td><input type="text" name="zoom" value="<?php echo $row['zoom']; ?>" size="20" id="zoombox"></td></tr>
<?php
	}
?>
	</table>
	</div>
</td>
</tr>

<tr>
<td class="tngshadow databack">
	<input type="hidden" name="usenl" value="0" />
	<input type="hidden" name="mediatypeID_org" value="<?php echo "$mediatypeID"; ?>" />
	<input type="hidden" name="mediaID" value="<?php echo "$mediaID"; ?>" />
	<input type="hidden" name="mediakey_org" value="<?php echo $row['mediakey']; ?>" />
<?php
	if(!empty($cw)) {
?>
	<input type="hidden" value="<?php echo "$cw"; /*stands for "close window" */ ?>" name="cw" />
	<input type="submit" name="saveclose" id="saveclose" class="btn" accesskey="s" value="<?php echo $admtext['saveback']; ?>" />
	<input type="submit" name="saveclose" id="saveret2" class="btn saveret" accesskey="s" value="<?php echo $admtext['saveback']; ?>" />
<?php
		$close_command = "window.close();";
	} else {
?>
	<input type="hidden" value="" name="cw" />
	<input type="submit" name="saveret" id="saveret" class="btn" accesskey="s" value="<?php echo $admtext['saveback']; ?>" />
	<input type="submit" name="saveret" id="saveret2" class="btn saveret" accesskey="s" value="<?php echo $admtext['saveback']; ?>" />
<?php
		$close_command = "window.location.href='admin_media.php';";
	}
?>
	<input type="submit" name="savestay" id="savestay" class="btn" value="<?php echo $admtext['savereturn']; ?>" />
	<input type="submit" name="savestay" id="savestay2" class="btn savestay" value="<?php echo $admtext['savereturn']; ?>" />
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="<?php echo $close_command; ?>">
</td>
</tr>
</table>
</form>
</div>

<script type="text/javascript">
var tree = "";
var type = "media";
var treename = new Array();
var seclitbox, tnglitbox;
<?php
	echo "var media = \"$mediaID\";\n";
	echo "var thumbprefix = \"$thumbprefix\";\n";
	echo "var thumbsuffix = \"$thumbsuffix\";\n";
	echo "var treemsg = \"{$admtext['tree']}\";\n";
	echo "var personmsg = \"{$admtext['person']}\";\n";
	echo "var idmsg = \"{$admtext['id']}\";\n";
	echo "var familymsg = \"{$admtext['family']}\";\n";
	echo "var sourcemsg = \"{$admtext['source']}\";\n";
	echo "var repositorymsg = \"{$admtext['repository']}\";\n";
	echo "var placemsg = \"{$admtext['place']}\";\n";
	echo "var findmsg = \"{$admtext['find']}\";\n";
	echo "var altdescmsg = \"{$admtext['alttitle']}\";\n";
	echo "var altnotesmsg = \"{$admtext['altdesc']}\";\n";
	echo "var makedefaultmsg = \"{$admtext['makedefault']}\";\n";
	echo "var eventlinkmsg = \"{$admtext['eventlink']}\";\n";
	echo "var eventmsg = \"{$admtext['event']}\";\n";
	echo "var sortmsg = \"{$admtext['text_sort']}\";\n";
	echo "var confdellink = \"{$admtext['confdellink']}\";\n";
	echo "var remove_text = \"{$admtext['removelink']}\";\n";
	echo "var edit_text = \"{$admtext['edit']}\";\n";
	echo "var yesmsg = \"{$admtext['yes']}\";\n";
	echo "var linkcount = $numlinks;\n";
	echo "var manage = 0;\n";
	echo "var assignedbranch = \"$assignedbranch\";\n";
	if($cms['support'])
		echo "var getperson_url = \"{$cms['url']}=getperson.php&\";\n";
	else
		echo "var getperson_url = \"{$cms['tngpath']}getperson.php?\";\n";
	echo $likearray;
?>
var entercollid = "<?php echo $admtext['entercollid']; ?>";
var entercolldisplay = "<?php echo $admtext['entercolldisplay']; ?>";
var entercollipath = "<?php echo $admtext['entercollpath']; ?>";
var entercollicon = "<?php echo $admtext['entercollicon']; ?>";
var confmtdelete = "<?php echo $admtext['confmtdelete']; ?>";
var yestext = "<?php echo $admtext['yes']; ?>";
var stmediatypes = new Array(<?php echo $sttypestr; ?>);
var allow_edit = <?php echo ($allow_edit ? "1" : "0"); ?>;
var allow_delete = <?php echo ($allow_delete ? "1" : "0"); ?>;
var linkmsg = "<?php echo $admtext['enterid']; ?>";
var confdeletefile = "<?php echo $admtext['confdeletefile']; ?>";

function validateForm( ) {
	var rval = true;

	var frm = document.form1;
	if(!frm.notes.value.length && !frm.description.value) {
		alert("<?php echo $admtext['enterphotodesc']; ?>");
		rval = false;
	}
	else if( frm.path.value.length == 0 && frm.mediaurl.value.length == 0 && frm.bodytext.value.length == 0 && frm.mediatypeID.options[frm.mediatypeID.selectedIndex].value != "headstones" ) {
		alert("<?php echo $admtext['enterphotopath']; ?>");
		rval = false;
	}
	else if( frm.thumbpath.value.length > 0 && frm.path.value == frm.thumbpath.value ) {
		alert("<?php echo $admtext['samepaths']; ?>");
		rval = false;
	}
	else {
		frm.path.value = frm.path.value.replace(/\\/g,"/");
		frm.thumbpath.value = frm.thumbpath.value.replace(/\\/g,"/");
	}
	if(rval && frm.newfile.value && frm.path.value != from.path_org.value) {
		rval = false;
		var usecollfolder = frm.usecollfolder[0].checked ? 0 : 1;
		var mediatypeID = frm.mediatypeID.options[frm.mediatypeID.selectedIndex].value;
		var thumbpath = frm.newthumb.value ? frm.thumbpath.value : "";
		var params = {path: frm.path.value, thumbpath: thumbpath, usecollfolder: usecollfolder, mediatypeID: mediatypeID};
		jQuery.ajax({
			url: 'admin_checkfile.php',
			data: params,
			dataType: 'json',
			success: function(vars){
				frm.path.value = vars.path;
				if(vars.thumbpath)
					frm.thumbpath.value = vars.thumbpath;
				document.form1.submit();
			}
		});
	}
	return rval;
}

function toggleAll(display) {
	toggleSection('mediafile','plus0',display);
	toggleSection('details','plus1',display);
	toggleSection('links','plus2',display);
	if(jQuery('#imagemapdiv').length)
		toggleSection('imagemapdiv','plus3',display);
	toggleSection('placeinfo','plus4',display);
	return false;
}
</script>
<script type="text/javascript" src="js/mediautils.js?v<?php echo $tng_version; ?>"></script>
<script type="text/javascript" src="js/mediafind.js?v<?php echo $tng_version; ?>"></script>
<script type="text/javascript" src="js/selectutils.js?v<?php echo $tng_version; ?>"></script>
<script type="text/javascript" src="js/admin.js?v<?php echo $tng_version; ?>"></script>
<script type="text/javascript" src="js/datevalidation.js?v<?php echo $tng_version; ?>"></script>
<script type="text/javascript">
	var preferEuro = <?php echo ($tngconfig['preferEuro'] ? $tngconfig['preferEuro'] : "false"); ?>;
	var preferDateFormat = '<?php (isset($preferDateFormat) ? $preferDateFormat : ""); ?>';
	switchOnType(document.form1.mediatypeID.options[document.form1.mediatypeID.selectedIndex].value, "<?php echo $form; ?>");
	toggleMediaURL();
	var findform = document.form1;
<?php
    include("niceditmsgs.php");
?>
</script>
<script type="text/javascript" src="js/nicedit.js"></script>
<script type="text/javascript">
//<![CDATA[
bkLib.onDomLoaded(function() {
    new nicEditor({fullPanel : true, maxHeight: 300}).panelInstance('bodytext');
<?php
	if($isphoto && !$row['abspath'])
		echo "init();\n";
	if($map['key'] && !$map['startoff']) {
		echo "divbox('mapcontainer');\n";
	}
	if(!empty($added)) {
		echo "toggleSection('mediafile','plus0');\n";
		echo "toggleSection('details','plus1');\n";
	}
?>
});

var box;
var boxmoving = false;
var boxdone = true;
var poschanged = false;
var x1,bx,y1,by;

function saveRectangle(tree, linktype, id, label) {
	var current = jQuery('#mlbox');
	var pos = current.position();
	var imgpos = jQuery('#myimg').position();

	params = {
		action: 'saverect',
		mediaID: '<?php echo $mediaID; ?>',
		tree: tree,
		linktype: linktype,
		label: label,
		id: id,
		top: Math.round(pos.top - imgpos.top),
		left: Math.round(pos.left - imgpos.left),
		height: current.height(),
		width: current.width()
	};
	//console.log('rect top: ' + pos.top + ', rect left: ' + pos.left + ', img top: ' + jQuery('#myimg').position().top + ',img left: ' + jQuery('#myimg').position().left);
	$("#mlbox").attr({ id: 'mlboxtmp' });
	jQuery.ajax({
		url: 'ajx_updateorder.php',
		data: params,
		dataType: 'json',
		type: 'POST',
		success: function(vars){
			//put name in current box
			var overhang = 100 - $("#mlboxtmp").width();
			var stylestr = "";
			if(overhang > 0) {
				side = -1 * Math.round(overhang/2);
				stylestr = "left:" + side + "px;right:" + side + "px;"; 
			}
			else
				stylestr = "";
			$("#mlboxtmp").append('<div class="imagetag" style="top:' + (current.height() + 1) + 'px;' + stylestr + '">'+vars.name+'</div>')
			$("#mlboxtmp").attr({ id: 'box_' + vars.id })
			//if medialink is new, add that to the page here in a future update
		}
	});
}

function updateRectangle(id) {
	var current = jQuery('#'+id);
	var pos = current.position();
	var imgpos = jQuery('#myimg').position();

	params = {
		action: 'updaterect',
		id: id.substring(4),
		top: Math.round(pos.top - imgpos.top),
		left: Math.round(pos.left - imgpos.left),
		height: current.height(),
		width: current.width()
	};
	jQuery.ajax({
		url: 'ajx_updateorder.php',
		data: params,
		dataType: 'json',
		type: 'POST'
	});
}

function deleteRectangle(id) {
	params = {
		action: 'delrect',
		id: id.substring(4)
	};
	jQuery.ajax({
		url: 'ajx_updateorder.php',
		data: params,
		dataType: 'json',
		type: 'POST'
	});
}

function wireUpBox(rbox) {
	rbox.mousedown(function(e) {
		var target = $(e.target);
		if(target.hasClass('imagetag'))
			target = target.parent();
		if(!target.hasClass('delx') && !target.find('.delx').length) {
            if(!target.hasClass('delx'))
                $('.bselected').removeClass('bselected').addClass('bunselected').css('z-index',1);
            $('.delx').remove();
			var delbox = $('<div class="delx">&nbsp;X</div>');
			delbox.click(function(e) {
				//do ajax to delete rectangle
				var deltarget = $(e.target);
				//console.log(deltarget.parent().attr('id'));
				deleteRectangle(deltarget.parent().attr('id'));
				$(e.target).parent().remove();
				e.stopPropagation();
			});
			target.append(delbox);
		}
        target.removeClass('bunselected').addClass('bselected').css('z-index',2);
		bx = e.pageX;
		by = e.pageY;
		boxmoving = true;
		poschanged = false;
		e.stopPropagation();
	});
	rbox.mousemove(function(e) {
		if(boxmoving) {
			//get coords of target
			origLeft = parseInt($(e.target).css('left'),10);
			origTop = parseInt($(e.target).css('top'),10);
			$(e.target).css({
				left:e.pageX - bx + origLeft, //offsets
				top:e.pageY - by + origTop //offsets
			});
			if(bx != e.pageX || by != e.pageY) {
				poschanged = true
				bx = e.pageX;
				by = e.pageY;
			}
		}
	});
	rbox.mouseup(function(e) {
		//if boxmoving, do ajax to save new position
		if(poschanged) {
			updateRectangle(rbox.attr('id'));
			poschanged = false;
		}
		boxmoving = false;
		e.stopPropagation();
	});
	return rbox;
}

$(document).ready(function() {

	$('#myimg').mousedown(function(e) {
		e.preventDefault();
		if(boxdone) {
			$('.bselected').removeClass('bselected').addClass('bunselected');

			box = wireUpBox($('<div id="mlbox" class="mlbox bunselected">').hide());

			$('#imgholder').append(box);

	       		x1 = e.pageX;
				y1 = e.pageY;
			//console.log('x:'+e.pageX+' y:'+e.pageY+' rxp:'+relativeXPosition+' ryp:'+relativeYPosition+' x1:'+x1+' y1:'+y1);

			box.css({
				top: e.pageY-$(e.target).offset().top-1 , //offsets
				left: e.pageX-$(e.target).offset().left-1 //offsets
			}).fadeIn();
			boxdone = false;
		}
	});

	$('#myimg').mousemove(function(e) {
		e.preventDefault();
		if(!boxdone) {
			$("#mlbox").css({
				width:Math.abs(e.pageX - x1 - 1), //offsets
				height:Math.abs(e.pageY - y1 - 1) //offsets
			}).fadeIn();
		}
	});

	$('#myimg').mouseup(function(e) {
		if(x1 != e.pageX || y1 != e.pageY) {
		    var tree = jQuery('#maptree').val();
		    if(jQuery('#urltitle').val()) {
		    	saveRectangle('', 'U', jQuery('#urladdress').val(), jQuery('#urltitle').val());
		    	jQuery('#urltitle').val('');
		    }
		   	else
				findItem(jQuery('#linktype').val(),'imagemap','',tree, assignedbranch);
		}
		else
			box.remove();
		//$("#current").attr({ id: '' });
		boxdone = true;
	});
	$('body').mousedown(function(e) {
		if(!$(e.target).hasClass('delx')) {
			$('.bselected').removeClass('bselected').addClass('bunselected').css('z-index',1);
			$('.delx').remove();
			e.stopPropagation();
		}
	});

	$('.mlbox').each(function() {
		wireUpBox($(this));
	});
});
//]]>
</script>
<?php 
echo tng_adminfooter();
?>