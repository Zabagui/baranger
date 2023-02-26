<?php
include("begin.php");
include($cms['tngpath'] . "genlib.php");
include($cms['tngpath'] . "getlang.php");
include($cms['tngpath'] . "$mylanguage/text.php");

include($cms['tngpath'] . "checklogin.php");
?>

<html>
<head>
	<link href="genstyle.css" rel="stylesheet" type="text/css">
	<link href="mytngstyle.css" rel="stylesheet" type="text/css">
</head>
<body>

<h1>Random Photo Block</h1>

<p>This page displays a random photo from your database. You can move this functionality to any other TNG page
by copying the PHP code from this page to your destination.</p>
<br clear="all"/>

<?php
//COPY EVERYTHING IN THIS BLOCK
//Change these vars to affect max width & height of your photo. Aspect ratio will be maintained. Leaving
//these values blank will cause your photo to be displayed actual size.
$maxwidth = "100";
$maxheight = "100";

$showmedia_url = getURL( "showmedia", 1 );

if( $tree )
	$wherestr = " AND ($media_table.gedcom = \"$tree\" || $media_table.gedcom = \"\")";

$query = "SELECT distinct $media_table.mediaID, path, $media_table.description, usecollfolder
	FROM ($media_table, $medialinks_table, $people_table)
	WHERE $media_table.mediaID = $medialinks_table.mediaID $wherestr AND $medialinks_table.gedcom = $people_table.gedcom AND $medialinks_table.personID = $people_table.personID AND mediatypeID = \"photos\" AND (living != \"1\" OR alwayson = \"1\")
	ORDER BY RAND() LIMIT 1";
$result = tng_query($query);
$imgrow = tng_fetch_assoc($result);
tng_free_result( $result );

$usefolder = $imgrow['usecollfolder'] ? $photopath : $mediapath;
$photoinfo = @GetImageSize( "$rootpath$usefolder/" . $imgrow['path'] );
$photowtouse = $photoinfo[0];
$photohtouse = $photoinfo[1];

//these lines do the resizing
if( $maxheight && $photohtouse > $maxheight ) {
	$photowtouse = intval( $maxheight * $photowtouse / $photohtouse ) ;
	$photohtouse = $maxheight;
}
if( $maxwidth && $photowtouse > $maxwidth ) {
	$photohtouse = intval( $maxwidth * $photohtouse / $photowtouse ) ;
	$photowtouse = $maxwidth;
}

//these lines restrict the table width so the caption will not be wider than the photo
if( $maxwidth ) $width = "width=\"$maxwidth\"";
if( $maxheight ) $height = "height=\"$maxheight\"";

echo "<table $width $height>\n";
echo "<tr><td align=\"center\"><a href=\"$showmedia_url" . "mediaID={$imgrow['mediaID']}\"><img src=\"$usefolder/" . str_replace("%2F","/",rawurlencode( $imgrow['path'] )) . "\" border=\"0\" width=\"$photowtouse\" height=\"$photohtouse\" alt=\"{$imgrow['description']}\" title=\"{$imgrow['description']}\"></a></td></tr>\n";
echo "<tr><td align=\"center\"><span class=\"normal\"><a href=\"$showmedia_url" . "mediaID={$imgrow['mediaID']}\">{$imgrow['description']}</a></span></td></tr>";
echo "</table>";
?>

<br clear="all"/>
<p>If you want to use this on a PHP page you created from scratch, you will need to include the PHP block 
at the top of this page as well.</p>

<p>Notes:<br/>
1) To simplify matters here, all photos attached to living individuals have been removed.
No check is done, however, to see if the photo is attached to a source cited for a living individual or
a family flagged as living.<br/>
2) To restrict a photo to certain dimensions, fill in the "maxwidth" and/or "maxheight" variables in the code.
Please note that although this will resize the display dimensions, the file size and bandwidth requirements will
not be affected. If you want to show random thumbnails instead, change each occurence of "path" above to "thumbpath" (lines 31, 40 and 59).</p>

</body>
</html>
