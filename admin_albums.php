<?php
include("begin.php");
include("adminlib.php");
$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( !isset($offset) ) $offset = 0;

$tng_search_album = $_SESSION['tng_search_album'] = 1;
if( !empty($newsearch) ) {
	$exptime = 0;
	setcookie("tng_search_album_post[search]", $searchstring, $exptime);
	setcookie("tng_search_album_post[tree]", $tree, $exptime);
	setcookie("tng_search_album_post[tngpage]", 1, $exptime);
	setcookie("tng_search_album_post[offset]", 0, $exptime);
}
else {
	if( empty($searchstring) )
		$searchstring = isset($_COOKIE['tng_search_album_post']['search']) ? stripslashes($_COOKIE['tng_search_album_post']['search']) : "";
	if( empty($tree) )
		$tree = isset($_COOKIE['tng_search_album_post']['tree']) ? $_COOKIE['tng_search_album_post']['tree'] : "";
	if( !isset($offset) ) {
		$tngpage = isset($_COOKIE['tng_search_album_post']['tngpage']) ? $_COOKIE['tng_search_album_post']['tngpage'] : 1;
		$offset = isset($_COOKIE['tng_search_album_post']['offset']) ? $_COOKIE['tng_search_album_post']['offset'] : 0;
	}
	else {
		$exptime = 05;
		if( !isset($tngpage) ) $tngpage = 1;
		setcookie("tng_search_album_post[tngpage]", $tngpage, $exptime);
		setcookie("tng_search_album_post[offset]", $offset, $exptime);
	}
}
$searchstring_noquotes = preg_replace("/\"/", "&#34;",$searchstring);
$searchstring = addslashes($searchstring);

if( $offset ) {
	$offsetplus = $offset + 1;
	$newoffset = "$offset, ";
}
else {
	$offsetplus = 1;
	$newoffset = "";
	$tngpage = 1;
}

if( $assignedtree ) {
	$tree = $assignedtree;
}

$showalbum_url = getURL( "showalbum", 1 );

$wherestr = $searchstring ? "WHERE albumname LIKE \"%$searchstring%\" OR description LIKE \"%$searchstring%\" OR keywords LIKE \"%$searchstring%\"" : "";

if( $assignedtree )
	$wherestr2 = " AND $album2entities_table.gedcom = \"$assignedtree\"";
elseif($tree) 
	$wherestr2 = " AND $album2entities_table.gedcom = \"$tree\"";
else
	$wherestr2 = "";

$query = "SELECT * FROM $albums_table $wherestr ORDER BY albumname LIMIT $newoffset" . $maxsearchresults;
$result = tng_query($query);

$numrows = tng_num_rows( $result );
if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
	$query = "SELECT count(albumID) as acount FROM $albums_table $wherestr";
	$result2 = tng_query($query);
	$row = tng_fetch_assoc( $result2 );
	$totrows = $row['acount'];
	tng_free_result($result2);
}
else
	$totrows = $numrows;

$helplang = findhelp("albums_help.php");

tng_adminheader( $admtext['albums'], $flags );
?>
<script type="text/javascript" src="js/admin.js"></script>
</head>

<?php
	echo tng_adminlayout();

	$albumtabs[0] = array(1,"admin_albums.php",$admtext['search'],"findalbum");
	$albumtabs[1] = array($allow_media_add,"admin_newalbum.php",$admtext['addnew'],"addalbum");
	$albumtabs[2] = array($allow_media_edit,"admin_orderalbumform.php",$admtext['text_sort'],"sortalbums");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/albums_help.php#modify');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($albumtabs,"findalbum",$innermenu);
	echo displayHeadline($admtext['albums'],"img/albums_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">

	<form action="admin_albums.php" name="form1" id="form1">
	<table>
		<tr>
			<td><span class="normal"><?php echo $admtext['searchfor']; ?>: </span></td>
			<td><input type="text" name="searchstring" value="<?php echo $searchstring_noquotes; ?>" class="longfield"></td>
			<td>
				<input type="submit" name="submit" value="<?php echo $admtext['search']; ?>" class="aligntop">
				<input type="submit" name="submit" value="<?php echo $admtext['reset']; ?>" onClick="document.form1.searchstring.value='';" class="aligntop">
			</td>
		</tr>
	</table>

	<input type="hidden" name="findalbum" value="1"><input type="hidden" name="newsearch" value="1">
	</form>

<?php
	$numrowsplus = $numrows + $offset;
	if( !$numrowsplus ) $offsetplus = 0;
	echo displayListLocation($offsetplus,$numrowsplus,$totrows);
	$pagenav = get_browseitems_nav( $totrows, "admin_albums.php?searchstring=$searchstring&amp;offset", $maxsearchresults, 5 );
	echo " &nbsp; <span class=\"adminnav\">$pagenav</span></p>";
?>

	<table cellpadding="3" cellspacing="1" border="0" class="normal rounded-table">
		<tr>
			<td class="fieldnameback fieldname">&nbsp;<b><?php echo $admtext['action']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname">&nbsp;<b><?php echo $admtext['thumb']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname">&nbsp;<b><?php echo $admtext['albumname'] . ", " . $admtext['description']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname">&nbsp;<b><?php echo $admtext['albmedia']; ?></b>&nbsp;</td>
			<td class="fieldnameback fieldname">&nbsp;<b><?php echo $admtext['active']; ?>?</b>&nbsp;</td>
			<td class="fieldnameback fieldname">&nbsp;<b><?php echo $admtext['linkedto']; ?></b>&nbsp;</td>
		</tr>
<?php
	if( $numrows ) {
		$actionstr = "";
		if( $allow_media_edit )
			$actionstr .= "<a href=\"admin_editalbum.php?albumID=xxx\" title=\"{$admtext['edit']}\" class=\"smallicon admin-edit-icon\"></a>";
		if( $allow_media_delete )
			$actionstr .= "<a href=\"#\" onclick=\"if(confirm('{$admtext['confdeletealbum']}' )){deleteIt('album',xxx);} return false;\" title=\"{$admtext['text_delete']}\" class=\"smallicon admin-delete-icon\"></a>";
		$actionstr .= "<a href=\"" . $showalbum_url . "albumID=xxx\" target=\"_blank\" title=\"{$admtext['test']}\" class=\"smallicon admin-test-icon\"></a>";

		while( $row = tng_fetch_assoc($result))
		{
			$newactionstr = preg_replace( "/xxx/", $row['albumID'], $actionstr );
			echo "<tr id=\"row_{$row['albumID']}\"><td class=\"lightback\" valign=\"top\"><div class=\"action-btns\">$newactionstr</div></td>\n";
			echo "<td class=\"lightback normal\" style=\"width:" . ($thumbmaxw+6) . "px;text-align:center;vertical-align:top\">";

			$query2 = "SELECT thumbpath, usecollfolder, mediatypeID FROM ($media_table, $albumlinks_table)
				WHERE albumID = \"{$row['albumID']}\" AND $media_table.mediaID = $albumlinks_table.mediaID AND defphoto=\"1\"";
			$result2 = tng_query($query2) or die ($admtext['cannotexecutequery'] . ": $query2");
			$trow = tng_fetch_assoc( $result2 );
			$tmediatypeID = isset($trow['mediatypeID']) ? $trow['mediatypeID'] : "";
			$tusefolder = !empty($trow['usecollfolder']) ? $mediatypes_assoc[$tmediatypeID] : $mediapath;
			//$trelativepath = substr( $tusefolder, 0, 1 ) != "/" ? $cms['support'] ? "../../../" : "../" : "";
			tng_free_result($result2);

			if( !empty($trow['thumbpath']) && file_exists( "$rootpath$tusefolder/" . $trow['thumbpath'] ) ) {
				$size = @GetImageSize( "$rootpath$tusefolder/" . $trow['thumbpath'] );
				echo "<a href=\"admin_editalbum.php?albumID={$row['albumID']}\"><img src=\"$tusefolder/" . str_replace("%2F","/",rawurlencode( $trow['thumbpath'] )) . "\" class=\"adminthumb\" $size[3] alt=\"{$row['albumname']}\"></a>";
			}
			else
				echo "&nbsp;";
			echo "</td>\n";

            		$query = "SELECT count(albumlinkID) as acount FROM $albumlinks_table WHERE albumID = \"{$row['albumID']}\"";
			$cresult = tng_query($query);
			$crow = tng_fetch_assoc( $cresult );
			$acount = $crow['acount'];
			tng_free_result($cresult);

			$editlink = "admin_editalbum.php?albumID={$row['albumID']}";
			$albumname = $allow_edit ? "<a href=\"$editlink\" title=\"{$admtext['edit']}\">" . $row['albumname'] . "</a>" : "<u>" . $row['albumname'] . "</u>";

			echo "<td class=\"lightback normal\" valign=\"top\">$albumname<br />" . strip_tags($row['description']) . "&nbsp;</td>\n";
			echo "<td class=\"lightback normal\" valign=\"top\" align=\"center\">$acount&nbsp;</td>\n";
			$active = $row['active'] ? $admtext['yes'] : $admtext['no'];
			echo "<td class=\"lightback normal\" valign=\"top\" align=\"center\">$active</td>\n";

			$query = "SELECT people.personID as personID2, people.gedcom as pgedcom, familyID, husband, wife, people.lastname as lastname, people.lnprefix as lnprefix, people.firstname as firstname, people.prefix as prefix, people.suffix as suffix, nameorder, people.title,
				people.living, people.private, people.branch, people.gedcom, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr, $families_table.familyID, $families_table.gedcom as fgedcom, $families_table.branch as fbranch,
				$album2entities_table.entityID as personID, $sources_table.title as stitle, $sources_table.sourceID, $sources_table.gedcom as sgedcom, $repositories_table.repoID, reponame, $repositories_table.gedcom as rgedcom
				FROM $album2entities_table
				LEFT JOIN $people_table AS people ON $album2entities_table.entityID = people.personID AND $album2entities_table.gedcom = people.gedcom
				LEFT JOIN $families_table ON $album2entities_table.entityID = $families_table.familyID AND $album2entities_table.gedcom = $families_table.gedcom
				LEFT JOIN $sources_table ON $album2entities_table.entityID = $sources_table.sourceID AND $album2entities_table.gedcom = $sources_table.gedcom
				LEFT JOIN $repositories_table ON ($album2entities_table.entityID = $repositories_table.repoID AND $album2entities_table.gedcom = $repositories_table.gedcom)
				WHERE albumID = \"{$row['albumID']}\"$wherestr2 ORDER BY lastname, lnprefix, firstname, personID LIMIT 10";
			$presult = tng_query($query);
			$alinktext = "";
			while( $prow = tng_fetch_assoc( $presult ) ){
				if( $prow['personID2'] != NULL ) {
					$rights = determineLivingPrivateRights($prow);
					$prow['allow_living'] = $rights['living'];
					$prow['allow_private'] = $rights['private'];
					$alinktext .= "<li><a href=\"admin_editperson.php?personID={$prow['personID2']}&tree={$prow['pgedcom']}\">" . getName( $prow ) . " ({$prow['personID2']})</a></li>\n";
				}
				elseif( $prow['sourceID'] != NULL ) {
					$sourcetext = $prow['stitle'] ? "{$admtext['source']}: {$prow['stitle']}" : "{$admtext['source']}: {$prow['sourceID']}";
					$alinktext .= "<li><a href=\"admin_editsource.php?sourceID={$prow['sourceID']}&tree={$prow['sgedcom']}\">$sourcetext ({$prow['sourceID']})</a></li>\n";
				}
				elseif( $prow['repoID'] != NULL ) {
					$repotext = $prow['reponame'] ? "{$admtext['repository']}: {$prow['reponame']}" : "{$admtext['repository']}: {$prow['repoID']}";
					$alinktext .= "<li><a href=\"admin_editrepo.php?repoID={$prow['repoID']}&tree={$prow['rgedcom']}\">$repotext ({$prow['repoID']})</a></li>\n";
				}
				elseif( $prow['familyID'] != NULL ) {
					$prow['linktype'] = "F";
					$prow['gedcom'] = $prow['fgedcom'];
					$prow['branch'] = $prow['fbranch'];
					$rights = determineLivingPrivateRights($prow);
					$prow['allow_living'] = $rights['living'];
					$prow['allow_private'] = $rights['private'];
					$alinktext .= "<li><a href=\"admin_editfamily.php?familyID={$prow['familyID']}&tree={$prow['fgedcom']}\">{$admtext['family']}: " . getFamilyName( $prow ) . "</a></li>\n";
				}
				else
					$alinktext .= "<li>{$prow['personID']}</li>";

			}
			$alinktext = $alinktext ? "<ul>\n$alinktext\n</ul>\n" : "&nbsp;";
			echo "<td class=\"lightback normal\" valign=\"top\">$alinktext</td>\n</tr>\n";
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
<?php 
echo tng_adminfooter();
?>