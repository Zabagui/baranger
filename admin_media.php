<?php
include("begin.php");
include($subroot . "mapconfig.php");
include("adminlib.php");
$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = true;
include("checklogin.php");
include("version.php");
include_once("tngdblib.php");

$maxnoteprev = 350;  //don't use the global value here because we always want to truncate

$query = "SET SQL_BIG_SELECTS=1";
$result = tng_query($query);

if(!empty($newsearch)) {
	$exptime = 0;
	$searchstring = stripslashes(trim($searchstring));
	if( !isset($unlinked) ) $unlinked = "";
	if( !isset($nothumb) ) $nothumb = "";
	setcookie("tng_search_media_post[search]", $searchstring, $exptime);
	setcookie("tng_search_media_post[mediatypeID]", $mediatypeID, $exptime);
	setcookie("tng_search_media_post[fileext]", $fileext, $exptime);
	setcookie("tng_search_media_post[unlinked]", $unlinked, $exptime);
	setcookie("tng_search_media_post[nothumb]", $nothumb, $exptime);
	setcookie("tng_search_media_post[hsstat]", $hsstat, $exptime);
	setcookie("tng_search_media_post[cemeteryID]", $cemeteryID, $exptime);
	setcookie("tng_tree", $tree, $exptime);
	setcookie("tng_search_media_post[tngpage]", 1, $exptime);
	setcookie("tng_search_media_post[offset]", 0, $exptime);
}
else {
	if( empty($searchstring) )
		$searchstring = isset($_COOKIE['tng_search_media_post']['search']) ? stripslashes($_COOKIE['tng_search_media_post']['search']) : "";
	if( empty($mediatypeID) )
		$mediatypeID = isset($_COOKIE['tng_search_media_post']['mediatypeID']) ? $_COOKIE['tng_search_media_post']['mediatypeID'] : "";
	if( empty($fileext) )
		$fileext = isset($_COOKIE['tng_search_media_post']['fileext']) ? $_COOKIE['tng_search_media_post']['fileext'] : "";
	if( empty($unlinked) )
		$unlinked = isset($_COOKIE['tng_search_media_post']['unlinked']) ? $_COOKIE['tng_search_media_post']['unlinked'] : "";
	if( empty($nothumb) )
		$nothumb = isset($_COOKIE['tng_search_media_post']['nothumb']) ? $_COOKIE['tng_search_media_post']['nothumb'] : "";
	if( empty($hsstat) )
		$hsstat = isset($_COOKIE['tng_search_media_post']['hsstat']) ? $_COOKIE['tng_search_media_post']['hsstat'] : "";
	if( empty($cemeteryID) )
		$cemeteryID = isset($_COOKIE['tng_search_media_post']['cemeteryID']) ? $_COOKIE['tng_search_media_post']['cemeteryID'] : "";
	if( empty($tree) )
		$tree = isset($_COOKIE['tng_tree']) ? $_COOKIE['tng_tree'] : "";

	if( !isset($offset) ) {
		$tngpage = isset($_COOKIE['tng_search_media_post']['tngpage']) ? $_COOKIE['tng_search_media_post']['tngpage'] : 1;
		$offset = isset($_COOKIE['tng_search_media_post']['offset']) ? $_COOKIE['tng_search_media_post']['offset'] : 0;
	}
	else {
		$exptime = 0;
		setcookie("tng_search_media_post[tngpage]", $tngpage, $exptime);
		setcookie("tng_search_media_post[offset]", $offset, $exptime);
	}
	$albumID = isset($_COOKIE['tng_search_media_post']['album']) ? $_COOKIE['tng_search_media_post']['album'] : "";
}

if(!empty($order))
	$_SESSION['tng_search_media_order'] = $order;
else
	$order = isset($_SESSION['tng_search_media_order']) ? $_SESSION['tng_search_media_order'] : "title";

if(!isset($offset)) $offset = 0;
if( $offset ) {
	$offsetplus = $offset + 1;
	$newoffset = "$offset, ";
}
else {
	$offsetplus = 1;
	$newoffset = "";
	$tngpage = 1;
}

$wherestr2 = "";
if( $assignedtree ) {
	$wherestr = "WHERE gedcom = \"$assignedtree\"";
	$wherestr2 = " AND $medialinks_table.gedcom = \"$assignedtree\"";
	//$tree = $assignedtree;
}
else {
	$wherestr = "";
	if($tree) $wherestr2 = " AND $medialinks_table.gedcom = \"$tree\"";
}
$orgwherestr = $wherestr;
$orgtree = $tree;

$showmedia_url = getURL( "showmedia", 1 );

$originalstring = preg_replace("/\"/", "&#34;",$searchstring);
$searchstring = addslashes($searchstring);
$wherestr = $searchstring ? "($media_table.mediaID LIKE \"%$searchstring%\" OR description LIKE \"%$searchstring%\" OR path LIKE \"%$searchstring%\" OR notes LIKE \"%$searchstring%\" OR bodytext LIKE \"%$searchstring%\" OR owner LIKE \"%$searchstring%\")" : "";
if( $assignedtree )
	$wherestr .= $wherestr ? " AND ($media_table.gedcom = \"$tree\" || $media_table.gedcom = \"\")" : "($media_table.gedcom = \"$tree\" || $media_table.gedcom = \"\")";
elseif( $tree )
	$wherestr .= $wherestr ? " AND $media_table.gedcom = \"$tree\"" : "$media_table.gedcom = \"$tree\"";
if( $mediatypeID )
	$wherestr .= $wherestr ? " AND mediatypeID = \"$mediatypeID\"" : "mediatypeID = \"$mediatypeID\"";
if( $fileext )
	$wherestr .= $wherestr ? " AND form = \"$fileext\"" : "form = \"$fileext\"";
if( $hsstat != "all" ) {
	if($hsstat)
		$wherestr .= $wherestr ? " AND status = \"$hsstat\"" : "status = \"$hsstat\"";
}
if( $cemeteryID )
	$wherestr .= $wherestr ? " AND cemeteryID = \"$cemeteryID\"" : "cemeteryID = \"$cemeteryID\"";
if( !empty($unlinked) ) {
	$join = "LEFT JOIN $medialinks_table on $media_table.mediaID = $medialinks_table.mediaID";
	$medialinkID = "medialinkID,";
	$wherestr .= $wherestr ? " AND medialinkID is NULL" : "medialinkID is NULL";
}
else {
	$join = "";
	$medialinkID = "";
}
if( $nothumb ) {
	$wherestr .= $wherestr ? " AND thumbpath = \"\"" : "thumbpath = \"\"";
}
if( $wherestr ) $wherestr = "WHERE $wherestr";

$titlesort = "titleup";
$changesort = "change";
$descicon = "<img src=\"img/tng_sort_desc.gif\" class=\"sortimg\" alt=\"\" />";
$ascicon = "<img src=\"img/tng_sort_asc.gif\" class=\"sortimg\" alt=\"\" />";

if($order == "title") {
	$orderstr = "description";
	$titlesort = "<a href=\"admin_media.php?order=titleup\" class=\"lightlink\">{$admtext['title2']}, {$admtext['description']} $descicon</a>";
}
else {
	$titlesort = "<a href=\"admin_media.php?order=title\" class=\"lightlink\">{$admtext['title2']}, {$admtext['description']} $ascicon</a>";
	if($order == "titleup")
		$orderstr = "description DESC";
}

if($order == "change") {
	$orderstr = "changedate, description";
	$changesort = "<a href=\"admin_media.php?order=changeup\" class=\"lightlink\">{$admtext['lastmodified']} $descicon</a>";
}
else {
	$changesort = "<a href=\"admin_media.php?order=change\" class=\"lightlink\">{$admtext['lastmodified']} $ascicon</a>";
	if($order == "changeup")
		$orderstr = "changedate DESC, description";
}

$query = "SELECT $media_table.mediaID as mediaID, $medialinkID description, notes, path, thumbpath, mediatypeID, abspath, mediakey, usecollfolder, $media_table.gedcom, form, changedby, DATE_FORMAT(changedate,\"%d %b %Y\") as changedatef
	FROM $media_table $join $wherestr 
	ORDER BY $orderstr LIMIT $newoffset" . $maxsearchresults;
$result = tng_query($query);

$numrows = tng_num_rows( $result );
if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
	$query = "SELECT count($media_table.mediaID) as mcount FROM $media_table $join $wherestr";
	$result2 = tng_query($query);
	$row = tng_fetch_assoc( $result2 );
	$totrows = $row['mcount'];
	tng_free_result($result2);
}
else
	$totrows = $numrows;

$uquery = "SELECT count(userID) as ucount FROM $users_table WHERE allow_living != \"-1\"";
$uresult = tng_query($uquery) or die ($admtext['cannotexecutequery'] . ": $uquery");
$urow = tng_fetch_assoc( $uresult );
$numusers = $urow['ucount'];
tng_free_result($uresult);

$helplang = findhelp("media_help.php");

tng_adminheader( $admtext['media'], $flags );

$standardtypes = array();
foreach( $mediatypes as $mediatype ) {
	if(!$mediatype['type'])
		$standardtypes[] = "\"" . $mediatype['ID'] . "\"";
}
$sttypestr = implode(",",$standardtypes);
?>
<script type="text/javascript" src="js/mediautils.js"></script>
<script type="text/javascript">
var tnglitbox;
var entercollid = "<?php echo $admtext['entercollid']; ?>";
var entercolldisplay = "<?php echo $admtext['entercolldisplay']; ?>";
var entercollipath = "<?php echo $admtext['entercollpath']; ?>";
var entercollicon = "<?php echo $admtext['entercollicon']; ?>";
var confmtdelete = "<?php echo $admtext['confmtdelete']; ?>";
var stmediatypes = new Array(<?php echo $sttypestr; ?>);
var manage = 1;
var allow_media_edit = <?php echo ($allow_media_edit ? "1" : "0"); ?>;
var allow_media_delete = <?php echo ($allow_media_delete ? "1" : "0"); ?>;
var allow_edit = <?php echo ($allow_edit ? "1" : "0"); ?>;
var allow_delete = <?php echo ($allow_delete ? "1" : "0"); ?>;

function toggleHeadstoneCriteria(mediatypeID) {
	var hsstatus = document.getElementById('hsstatrow');
	var cemrow = document.getElementById('cemrow');
	if( mediatypeID == 'headstones' ) {
		cemrow.style.display='';
		hsstatus.style.display='';
	}
	else {
		cemrow.style.display='none';
		document.form1.cemeteryID.selectedIndex = 0;
		hsstatus.style.display='none';
		document.form1.hsstat.selectedIndex = 0;
		if(mediatypeID && stmediatypes.indexOf(mediatypeID) == -1) {
			if(jQuery('#editmediatype').length) jQuery('#editmediatype').show();
			if(jQuery('#delmediatype').length) jQuery('#delmediatype').show();
		}
		else {
			if(jQuery('#editmediatype').length) jQuery('#editmediatype').hide();
			if(jQuery('#delmediatype').length) jQuery('#delmediatype').hide();
		}
	}
	return false;
}

function resetForm() {
	document.form1.searchstring.value='';
	document.form1.tree.selectedIndex=0;
	document.form1.mediatypeID.selectedIndex=0;
	document.form1.fileext.value = '';
	document.form1.unlinked.checked = false;
	document.form1.nothumb.checked = false;
	document.form1.hsstat.selectedIndex=0;
	document.form1.cemeteryID.selectedIndex=0;
}

function confirmDelete(mediaID) {
	if(confirm('<?php echo $admtext['confdeletemedia']; ?>' )){
		<?php 
		if( $tngconfig['mediadel'] == 2) { 
		?>
			if(confirm('<?php echo $admtext['confdelmediafile']; ?>' ))
				deleteIt('media',mediaID,'',1);
			else
				deleteIt('media',mediaID,'',0);
		<?php 
		}
		else {
		?>
			deleteIt('media',mediaID);
		<?php
		}
		?> 
	}
	return false;
}
</script>
<script type="text/javascript" src="js/admin.js"></script>
</head>

<?php
	echo tng_adminlayout();

	$mediatabs[0] = array(1,"admin_media.php",$admtext['search'],"findmedia");
	$mediatabs[1] = array($allow_media_add,"admin_newmedia.php",$admtext['addnew'],"addmedia");
	$mediatabs[2] = array($allow_media_edit,"admin_ordermediaform.php",$admtext['text_sort'],"sortmedia");
	$mediatabs[3] = array($allow_media_edit && !$assignedtree,"admin_thumbnails.php",$admtext['thumbnails'],"thumbs");
	$mediatabs[4] = array($allow_media_add && !$assignedtree,"admin_photoimport.php",$admtext['import'],"import");
	$mediatabs[5] = array($allow_media_add,"admin_mediaupload.php",$admtext['upload'],"upload");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/media_help.php#modify');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($mediatabs,"findmedia",$innermenu);
	echo displayHeadline($admtext['media'],"img/photos_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">

	<form action="admin_media.php" name="form1" id="form1">
	<table class="normal">
		<tr>
			<td><?php echo $admtext['searchfor']; ?>: </td>
			<td>
<?php
	$newwherestr = $wherestr;
	$wherestr = $orgwherestr;
	include("treequery.php");
	$wherestr = $newwherestr;
?>
				<input type="text" name="searchstring" value="<?php echo $originalstring; ?>" class="longfield">
				<input type="submit" name="submit" value="<?php echo $admtext['search']; ?>" class="aligntop">
				<input type="submit" name="submit" value="<?php echo $admtext['reset']; ?>" onClick="resetForm();" class="aligntop">
			</td>
		</tr>
		<tr>
			<td><?php echo $admtext['fileext']; ?>: </td>
			<td>
				<input type="text" name="fileext" value="<?php echo $fileext; ?>" size="3">
				&nbsp;&nbsp;<input type="checkbox" name="unlinked" value="1"<?php if( !empty($unlinked) ) echo " checked"; ?> /> <?php echo $admtext['unlinked']; ?>
				&nbsp;&nbsp;<input type="checkbox" name="nothumb" value="1"<?php if( $nothumb ) echo " checked"; ?> /> <?php echo $admtext['nothumb']; ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $admtext['mediatype']; ?>: </td>
			<td>
				<select name="mediatypeID" onchange="toggleHeadstoneCriteria(this.options[this.selectedIndex].value)">

<?php
	echo "<option value=\"\">{$admtext['all']}</option>\n";
	foreach( $mediatypes as $mediatype ) {
		$msgID = $mediatype['ID'];
		echo "	<option value=\"$msgID\"";
		if( $msgID == $mediatypeID ) echo " selected=\"selected\"";
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
		<tr id="hsstatrow">
			<td><?php echo $admtext['status']; ?>: </td>
			<td>
				<select name="hsstat">
					<option value="all"<?php if( $hsstat == "all" ) echo " selected=\"selected\""; ?>></option>
					<option value=""<?php if( !$hsstat ) echo " selected=\"selected\""; ?>><?php echo $admtext['nostatus']; ?></option>
					<option value="notyetlocated"<?php if( $hsstat == "notyetlocated" ) echo " selected=\"selected\""; ?>><?php echo $admtext['notyetlocated']; ?></option>
					<option value="located"<?php if( $hsstat == "located" ) echo " selected=\"selected\""; ?>><?php echo $admtext['located']; ?></option>
					<option value="unmarked"<?php if( $hsstat == "unmarked" ) echo " selected=\"selected\""; ?>><?php echo $admtext['unmarked']; ?></option>
					<option value="missing"<?php if( $hsstat == "missing" ) echo " selected=\"selected\""; ?>><?php echo $admtext['missing']; ?></option>
					<option value="moved"<?php if( $hsstat == 'moved' ) echo " selected=\"selected\""; ?>><?php echo $admtext['moved']; ?></option>
					<option value="cremated"<?php if( $hsstat == "cremated" ) echo " selected=\"selected\""; ?>><?php echo $admtext['cremated']; ?></option>
				</select>
			</td>
		</tr>
		<tr id="cemrow">
			<td><?php echo $admtext['cemetery']; ?>: </td>
			<td>
			<select name="cemeteryID">
				<option value="" selected="selected"></option>
<?php
$query = "SELECT cemname, cemeteryID, city, county, state, country FROM $cemeteries_table ORDER BY cemname, city, county, state, country";
$cemresult = tng_query($query);
while( $cemrow = tng_fetch_assoc($cemresult) ) {
	$cemetery = "{$cemrow['cemname']} - {$cemrow['city']}, {$cemrow['county']}, {$cemrow['state']}, {$cemrow['country']}";
	echo "		<option value=\"{$cemrow['cemeteryID']}\"";
	if( $cemeteryID == $cemrow['cemeteryID'] ) echo " selected=\"selected\"";
	echo ">$cemetery</option>\n";
}
?>
			</select>
			</td>
		</tr>
	</table>

	<input type="hidden" name="findmedia" value="1"><input type="hidden" name="newsearch" value="1">
	</form><br />
<?php
	$numrowsplus = $numrows + $offset;
	if( !$numrowsplus ) $offsetplus = 0;
	echo displayListLocation($offsetplus,$numrowsplus,$totrows);
	$pagenav = get_browseitems_nav( $totrows, "admin_media.php?searchstring=$searchstring&amp;mediatypeID=$mediatypeID&amp;fileext=$fileext&amp;hsstat=$hsstat&amp;cemeteryID=$cemeteryID&amp;offset", $maxsearchresults, 5 );
	echo " &nbsp; <span class=\"adminnav\">$pagenav</span></p>";
?>
	<form action="admin_updateselectedmedia.php" method="post"  name="form2">
<?php
	if($allow_media_delete || $allow_media_edit) {
?>
		<p class="nw">
		<input type="button" name="selectall" value="<?php echo $admtext['selectall']; ?>" onClick="toggleAll(1);">
		<input type="button" name="clearall" value="<?php echo $admtext['clearall']; ?>" onClick="toggleAll(0);">&nbsp;&nbsp;
<?php
		if( $allow_media_delete ) {
?>
		<input type="submit" name="xphaction" value="<?php echo $admtext['deleteselected']; ?>" onClick="return confirm('<?php echo addslashes($admtext['confdeleterecs']); ?>');">&nbsp;&nbsp;
<?php
		}
		if( $allow_media_edit ) {
?>
		<input type="submit" name="xphaction" value="<?php echo $admtext['convto']; ?>">
		<select name="newmediatype" class="aligntop">
<?php
			foreach( $mediatypes as $mediatype ) {
				$msgID = $mediatype['ID'];
				if( $msgID != $mediatypeID )
					echo "	<option value=\"$msgID\">" . $mediatype['display'] . "</option>\n";
			}
			echo "</select>&nbsp;&nbsp;\n";

			$albumquery = "SELECT albumID, albumname FROM $albums_table ORDER BY albumname";
			$albumresult = tng_query($albumquery) or die ($admtext['cannotexecutequery'] . ": $albumquery");
			$numalbums = tng_num_rows($albumresult);
			if($numalbums) {
				echo "<input type=\"submit\" name=\"xphaction\" value=\"{$admtext['addtoalbum']}\">\n";
				echo "<select name=\"albumID\" style=\"vertical-align:top\">\n";
				while( $albumrow = tng_fetch_assoc($albumresult) ) {
					echo "	<option value=\"{$albumrow['albumID']}\"";
					if(isset($albumID) && $albumrow['albumID'] == $albumID)
						echo " selected";
					echo ">{$albumrow['albumname']}</option>\n";
				}
				echo "</select>\n";
			}
			tng_free_result($albumresult);
		}
?>
		</p>
<?php
	}
?>
	
	<table class="normal resultstable cell-pad3 rounded-table">
		<tr>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['action']; ?></b>&nbsp;</td>
<?php
	if($allow_edit || $allow_media_edit || $allow_delete || $allow_media_delete) {
?>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['select']; ?></b>&nbsp;</td>
<?php
	}
?>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['thumb']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $titlesort; ?></b>&nbsp;</td>
<?php
	if(!$mediatypeID) {
?>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['mediatype']; ?></b>&nbsp;</td>
<?php
	}
?>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['linkedto']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $changesort; ?></b>&nbsp;</td>
		</tr>
<?php
	if( $numrows ) {
		$actionstr = "";
		if( $allow_media_edit )
			$actionstr .= "<a href=\"admin_editmedia.php?mediaID=xxx\" title=\"{$admtext['edit']}\" class=\"smallicon admin-edit-icon\"></a>";
		if( $allow_media_delete )
			$actionstr .= "<a href=\"#\" onClick=\"return confirmDelete('xxx');\" title=\"{$admtext['text_delete']}\" class=\"smallicon admin-delete-icon\"></a>";
		$actionstr .= "<a href=\"" . $showmedia_url . "mediaID=xxx\" target=\"_blank\" title=\"{$admtext['test']}\" class=\"smallicon admin-test-icon\"></a>";

		$filename = null;
		while( $row = tng_fetch_assoc($result))
		{
			//$cleanfile = $session_charset == "UTF-8" ? utf8_decode($row['thumbpath']) : $row['thumbpath'];
			$mtypeID = $row['mediatypeID'];
			$usefolder = $row['usecollfolder'] ? $mediatypes_assoc[$mtypeID] : $mediapath;
			$newactionstr = preg_replace( "/xxx/", $row['mediaID'], $actionstr );
			echo "<tr id=\"row_{$row['mediaID']}\"><td class=\"lightback aligntop\"><div class=\"action-btns\">$newactionstr</div></td>\n";
			if($allow_edit || $allow_media_edit || $allow_delete || $allow_media_delete)
				echo "<td class=\"lightback aligntop center\"><input type=\"checkbox\" name=\"ph{$row['mediaID']}\" value=\"1\"></td>";
			echo "<td class=\"lightback aligntop center\">";
			$treestr = $tngconfig['mediatrees'] && $row['gedcom'] ? $row['gedcom'] . "/" : "";
			if( $row['thumbpath'] && file_exists("$rootpath$usefolder/$treestr" . $row['thumbpath'])) {
				$photoinfo = @GetImageSize( "$rootpath$usefolder/$treestr" . $row['thumbpath'] );
				if( $photoinfo['1'] < 50 ) {
					$photohtouse = $photoinfo['1'];
					$photowtouse = $photoinfo['0'];
				}
				else {
					$photohtouse = 50;
					$photowtouse = intval( 50 * $photoinfo['0'] / $photoinfo['1'] ) ;
				}
				echo "<img class=\"adminthumb\" src=\"$usefolder/$treestr" . str_replace("%2F","/",rawurlencode( $row['thumbpath'] )) . "\" alt=\"" . htmlspecialchars($row['description']) . "\" width=\"$photowtouse\" height=\"$photohtouse\">\n";
			}
			elseif( $row['form'] == "TXT" )
				echo "<span class=\"normal\">Text</span>\n";
			else
				echo "&nbsp;";
			echo "</td>\n";
			$description = $allow_edit || $allow_media_edit ? "<a href=\"admin_editmedia.php?mediaID={$row['mediaID']}\">{$row['description']}</a>" : $row['description'];

			$filename = $filename != $row['path'] ? "<div class=\"smaller\" style=\"color:gray;padding-top:7px\">&gt; {$row['path']}</div>" : ""; 
			echo "<td class=\"lightback aligntop\">$description<br />" . truncateIt(getXrefNotes($row['notes']),$maxnoteprev) . "$filename</td>\n";
			if( !$mediatypeID ) {
				$label = !empty($text[$mtypeID]) ? $text[$mtypeID] : $mediatypes_display[$mtypeID];
				echo "<td class=\"lightback normal aligntop nw\">&nbsp;" . $label . "&nbsp;</td>\n";
			}

			$query = "SELECT people.personID as personID2, people.gedcom as pgedcom, familyID, husband, wife, people.lastname as lastname, people.lnprefix as lnprefix, people.firstname as firstname, people.prefix as prefix, people.suffix as suffix, nameorder, people.title, people.birthdate, people.birthdatetr, people.altbirthdate, people.altbirthdatetr, people.deathdate, people.deathdatetr, people.living, people.private, people.branch,
				$medialinks_table.personID as personID, $sources_table.title as sourcetitle, $sources_table.sourceID, $sources_table.gedcom as sgedcom, $repositories_table.repoID, reponame, $repositories_table.gedcom as rgedcom, linktype, $families_table.gedcom as gedcom
				FROM $medialinks_table
				LEFT JOIN $people_table AS people ON $medialinks_table.personID = people.personID AND $medialinks_table.gedcom = people.gedcom
				LEFT JOIN $families_table ON $medialinks_table.personID = $families_table.familyID AND $medialinks_table.gedcom = $families_table.gedcom
				LEFT JOIN $sources_table ON $medialinks_table.personID = $sources_table.sourceID AND $medialinks_table.gedcom = $sources_table.gedcom
				LEFT JOIN $repositories_table ON ($medialinks_table.personID = $repositories_table.repoID AND $medialinks_table.gedcom = $repositories_table.gedcom)
				WHERE mediaID = \"{$row['mediaID']}\"$wherestr2 ORDER BY lastname, lnprefix, firstname, personID LIMIT 10";
			$presult = tng_query($query);
			$medialinktext = "";
			$citelinks = array();
			while( $prow = tng_fetch_assoc( $presult ) ){
	 			$prights = determineLivingPrivateRights($prow);
				$prow['allow_living'] = $prights['living'];
				$prow['allow_private'] = $prights['private'];
				if( $prow['personID2'] != NULL ) {
					$medialinktext .= "<li><a href=\"admin_editperson.php?personID={$prow['personID']}&tree={$prow['pgedcom']}\">" . getName( $prow ) . " ({$prow['personID2']})</a></li>\n";
				}
				elseif( $prow['sourceID'] != NULL ) {
					$sourcetext = $prow['sourcetitle'] ? "{$admtext['source']}: {$prow['sourcetitle']}" : "{$admtext['source']}: {$prow['sourceID']}";
					$medialinktext .= "<li><a href=\"admin_editsource.php?sourceID={$prow['personID']}&tree={$prow['sgedcom']}\">$sourcetext ({$prow['sourceID']})</a></li>\n";
				}
				elseif( $prow['repoID'] != NULL ) {
					$repotext = $prow['reponame'] ? "{$admtext['repository']}: {$prow['reponame']}" : "{$admtext['repository']}: {$prow['repoID']}";
					$medialinktext .= "<li><a href=\"admin_editrepo.php?repoID={$prow['personID']}&tree={$prow['rgedcom']}\">$repotext ({$prow['repoID']})</a></li>\n";
				}
				elseif( $prow['familyID'] != NULL )
					$medialinktext .= "<li><a href=\"admin_editfamily.php?familyID={$prow['personID']}&tree={$prow['gedcom']}\">{$admtext['family']}: " . getFamilyName( $prow ) . "</a></li>\n";
				elseif( !$prow['linktype'] || $prow['linktype'] == "C") {
					$query = "SELECT persfamID, sourceID, gedcom from $citations_table WHERE citationID = \"{$prow['personID']}\"";
					$cresult = tng_query($query);
					if($cresult) {
						$crow = tng_fetch_assoc($cresult);
						if($crow) {
							$persfamID = $crow['persfamID'];
							if(!in_array($persfamID, $citelinks)) {
								$medialinktext .= "<li>{$admtext['citation']}: ";
								$citelinks[] = $persfamID;
								if(substr($persfamID,0,1) == $tngconfig['personprefix'] || substr($persfamID,-1) == $tngconfig['personsuffix']) {
									$presult2 = getPersonSimple($crow['gedcom'],$persfamID);
									if($presult2) {
										$cprow = tng_fetch_assoc($presult2);
										$cprights = determineLivingPrivateRights($cprow);
										$cprow['allow_living'] = $cprights['living'];
										$cprow['allow_private'] = $cprights['private'];
										$medialinktext .= "<a href=\"admin_editperson.php?personID={$crow['persfamID']}&tree={$crow['gedcom']}\">" . getName( $cprow ) . " ($persfamID)</a>";
										tng_free_result($presult2);
									}
								}
								elseif(substr($persfamID,0,1) == $tngconfig['familyprefix'] || substr($persfamID,-1) == $tngconfig['familysuffix']) {
									$presult2 = getFamilyData($crow['gedcom'],$persfamID);
									if($presult2) {
										$famrow = tng_fetch_assoc($presult2);
										$familyname = getFamilyName($famrow);
										$medialinktext .= "<a href=\"admin_editfamily.php?familyID={$crow['persfamID']}&tree={$crow['gedcom']}\">{$admtext['family']}: $familyname ($persfamID)</a>";
										tng_free_result($presult2);
									}
								}
								$medialinktext .= "</li>\n";
							}
						}
						tng_free_result($cresult);
					}
				}
				else
					$medialinktext .= "<li>{$prow['personID']}</li>";
				
			}
			$medialinktext = $medialinktext ? "<ul>\n$medialinktext\n</ul>\n" : "&nbsp;";
			echo "<td class=\"lightback normal aligntop nw\">$medialinktext</td>\n";
			$changedby = $numusers > 1 && $row['changedby'] ? "{$row['changedby']}: " : "";
			echo "<td class=\"lightback aligntop\">{$changedby}{$row['changedatef']}</td>\n";

			echo "</tr>\n";
		}
?>
	</table>
<?php
		echo displayListLocation($offsetplus,$numrowsplus,$totrows);
		echo " &nbsp; <span class=\"adminnav\">$pagenav</span></p>";
	}
	else
		echo "</table>\n" . $admtext['norecords'];
  	tng_free_result($result);
?>
	</form>

	</div>
</div>
<script type="text/javascript">
	toggleHeadstoneCriteria('<?php echo $mediatypeID; ?>');
</script>
<?php 
echo tng_adminfooter();
?>