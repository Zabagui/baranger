<?php
$textpart = "reports";
include("tng_begin.php");

if(!empty($cms['events'])){include('cmsevents.php'); cms_whatsnew();}
include($cms['tngpath'] . "functions.php" );

$getperson_url = getURL( "getperson", 1 );
$showmedia_url = getURL( "showmedia", 1 );
$mostwanted_url = getURL( "mostwanted", 0 );

$logstring = "<a href=\"$mostwanted_url\">" . xmlcharacters($text['mostwanted']) . "</a>";
writelog($logstring);
preparebookmark($logstring);

$wherestr = $tree ? " AND $mostwanted_table.gedcom = \"$tree\"" : "";
$suggest_url = getURL( "suggest", 1 );
$getperson_url = getURL( "getperson", 1 );

$gotImageJpeg = function_exists('imageJpeg');

function showDivs($type) {
	global $wherestr, $text, $people_table, $media_table, $mostwanted_table, $mediatypes_assoc, $mediapath, $cms, $rootpath, $suggest_url, $getperson_url, $thumbmaxw;
	global $gotImageJpeg, $maxmediafilesize, $allow_private;

	$mediatext = "<table class=\"tfixed whiteback\" cellpadding=\"8\" cellspacing=\"2\" width=\"100%\">\n";

	$query = "SELECT $mostwanted_table.ID as mwID, mwtype, thumbpath, abspath, form, usecollfolder, mediatypeID, path, $media_table.description as mtitle,
		$mostwanted_table.personID, $mostwanted_table.gedcom, $mostwanted_table.mediaID, $mostwanted_table.description as mwdesc, $mostwanted_table.title as mwtitle,
		lastname, firstname, lnprefix, suffix, prefix, $people_table.title as title, $people_table.living, $people_table.private, nameorder, branch
		FROM $mostwanted_table
		LEFT JOIN $media_table ON $mostwanted_table.mediaID = $media_table.mediaID
		LEFT JOIN $people_table ON $mostwanted_table.personID = $people_table.personID AND $mostwanted_table.gedcom = $people_table.gedcom
		WHERE mwtype = \"$type\"$wherestr ORDER BY ordernum";
	$result = tng_query($query);

	while( $row = tng_fetch_assoc( $result ) ) {
		$mediatypeID = $row['mediatypeID'];
		$usefolder = $row['usecollfolder'] ? $mediatypes_assoc[$mediatypeID] : $mediapath;
		$row['allow_living'] = 1;
		$row['allow_private'] = !$row['private'] || $allow_private;
		$imgsrc = $row['mediaID'] ? getSmallPhoto($row) : "";

		$mediatext .= "<tr><td class=\"databack normal\">\n";
		if($imgsrc) {
			$href = getMediaHREF($row,0);
			//$mediatext .= "<div class=\"mwimage\">\n<div class=\"media-img\"><div class=\"media-prev\" id=\"prev{$row['mediaID']}\" style=\"display:none;left:$thumbmaxw" . "px\"></div></div>\n";
			$mediatext .= "<div class=\"mwimage\">\n<div class=\"media-img\"><div class=\"media-prev\" id=\"prev{$row['mediaID']}\" style=\"display:none;\"></div></div>\n";
			$mediatext .= "<a href=\"$href\"";
			if( $gotImageJpeg && isPhoto($row) && filesize("$rootpath$usefolder/" . $row['path']) < $maxmediafilesize)
				$mediatext .= " class=\"media-preview\" id=\"img-{$row['mediaID']}-0-" . urlencode("$usefolder/{$row['path']}") . "\"";				
			$mediatext .= ">$imgsrc</a>\n";
			$mediatext .= "</div>\n";
		}
		$mediatext .= "<span class=\"media-title\">{$row['mwtitle']}</span><br /><br />";
		$mediatext .= "<div style=\"margin:0px;\">{$row['mwdesc']}</div>";

		$mediatext .= "<div class=\"mwperson\">\n";
		if($type == "person") {
			if($row['personID']) {
				$mediatext .= "<a href=\"$suggest_url" . "enttype=I&amp;ID={$row['personID']}&amp;tree={$row['gedcom']}\">" . $text['tellus'] . "</a>";

				$rights = determineLivingPrivateRights($row);
				$row['allow_living'] = $rights['living'];
				$row['allow_private'] = $rights['private'];

				$name = getName($row);
				$mediatext .= " &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; " . $text['moreinfo'] . " <a href=\"$getperson_url" . "personID={$row['personID']}&amp;tree={$row['gedcom']}\">$name</a>";
			}
			else
				$mediatext .= "<a href=\"{$suggest_url}page={$text['mostwanted']}:+{$row['mwtitle']}\">" . $text['tellus'] . "</a>";
		}
		if($type == "photo" && $row['mediaID']) {
			$mediatext .= "<a href=\"{$suggest_url}page={$text['mostwanted']}:+{$row['mtitle']}\">" . $text['tellus'] . "</a>";
			$mediatext .= " &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; " . $text['moreinfo'] . " <a href=\"$href\">{$row['mtitle']}</a> &nbsp;&nbsp;&nbsp;";
		}
		$mediatext .= "</div>\n";
		$mediatext .= "</td></tr>\n";
	}
	$numrows = tng_num_rows($result);
	tng_free_result($result);

	$mediatext .= "</table>\n";

	return $mediatext;
}

//$flags = array();
tng_header( $text['mostwanted'], $flags );

$flags['imgprev'] = true;
?>

<h1 class="header"><span class="headericon" id="mw-hdr-icon"></span><?php echo $text['mostwanted']; ?></h1><br clear="left"/>
<?php
echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'mostwanted', 'method' => 'get', 'name' => 'form1', 'id' => 'form1'));

echo "<div class=\"titlebox mwblock\">\n";
echo "<p class=\"subhead\">&nbsp;<strong>" . $text['mysperson'] . "</strong></p>\n";
echo showDivs("person");
echo "</div>\n";

echo "<br />\n";

echo "<div class=\"titlebox mwblock\">\n";
echo "<p class=\"subhead\">&nbsp;<strong>" . $text['mysphoto'] . "</strong></p>\n";
echo showDivs("photo");
echo "</div>\n";

tng_footer($flags);
?>