<?php
include("begin.php");
include("adminlib.php");
$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

initMediaTypes();

function get_album_nav( $total, $perpage, $pagenavpages ) {
	global $page, $totalpages, $tree, $text, $orgtree, $albumID, $searchstring, $mediatypeID, $hsstat, $cemeteryID;

	$curpage = 0;
	$pagenav = $prevlink = $firstlink = $lastlink = $nextlink = "";
	if( !$page ) $page = 1;
	if( !$perpage ) $perpage = 50;

	if( $total <= $perpage )
		return "";

	$totalpages = ceil( $total / $perpage );
	if ( $page > $totalpages ) $page = $totalpages;

	if( $page > 1 ) {
		$prevpage = $page-1;
		$navoffset = ( ( $prevpage * $perpage ) - $perpage );
		$prevlink = " <a href=\"#\" onclick=\"return getMoreMedia('$searchstring', '$mediatypeID', '$hsstat', '$cemeteryID', '$navoffset', '$orgtree', '$prevpage', '$albumID');\" title=\"{$text['text_prev']}\">&laquo;{$text['text_prev']}</a> ";
	}
	if ($page<$totalpages) {
		$nextpage = $page+1;
		$navoffset = (($nextpage * $perpage) - $perpage);
		$nextlink = "<a href=\"#\" onclick=\"return getMoreMedia('$searchstring', '$mediatypeID', '$hsstat', '$cemeteryID', '$navoffset', '$orgtree', '$nextpage', '$albumID');\" title=\"{$text['text_next']}\">{$text['text_next']}&raquo;</a>";
	}
	while( $curpage++ < $totalpages ) {
   	$navoffset = ( ($curpage - 1 ) * $perpage );
		if( ( $curpage <= $page - $pagenavpages || $curpage >= $page + $pagenavpages ) && $pagenavpages ) {
			if( $curpage == 1 )
				$firstlink = " <a href=\"#\" onclick=\"return getMoreMedia('$searchstring', '$mediatypeID', '$hsstat', '$cemeteryID', '$navoffset', '$orgtree', '$curpage', '$albumID');\" title=\"{$text['firstpage']}\">&laquo;1</a> ... ";
		    if( $curpage == $totalpages )
				$lastlink = "... <a href=\"#\" onclick=\"return getMoreMedia('$searchstring', '$mediatypeID', '$hsstat', '$cemeteryID', '$navoffset', '$orgtree', '$curpage', '$albumID');\" title=\"{$text['lastpage']}\">$totalpages&raquo;</a>";
		}
		else {
			if( $curpage == $page )
				$pagenav .= " [$curpage] ";
			else
				$pagenav .= " <a href=\"#\" onclick=\"return getMoreMedia('$searchstring', '$mediatypeID', '$hsstat', '$cemeteryID', '$navoffset', '$orgtree', '$curpage', '$albumID');\">$curpage</a> ";
		}
	}
	$pagenav = "<span class=\"normal\">$prevlink $firstlink $pagenav $lastlink $nextlink</span>";

	return $pagenav;
}

$wherestr = $searchstring ? "($media_table.mediaID LIKE \"%$searchstring%\" OR description LIKE \"%$searchstring%\" OR path LIKE \"%$searchstring%\" OR notes LIKE \"%$searchstring%\" OR owner LIKE \"%$searchstring%\" OR bodytext LIKE \"%$searchstring%\")" : "";
if( !empty($searchtree) )
	$wherestr .= $wherestr ? " AND (gedcom = \"\" OR gedcom = \"$searchtree\")" : "(gedcom = \"\" OR gedcom = \"$searchtree\")";
if( $mediatypeID )
	$wherestr .= $wherestr ? " AND mediatypeID = \"$mediatypeID\"" : "mediatypeID = \"$mediatypeID\"";
if( !empty($fileext) )
	$wherestr .= $wherestr ? " AND form = \"$fileext\"" : "form = \"$fileext\"";
if( !empty($hsstat) )
	$wherestr .= $wherestr ? " AND status = \"$hsstat\"" : "status = \"$hsstat\"";
if( !empty($cemeteryID) )
	$wherestr .= $wherestr ? " AND cemeteryID = \"$cemeteryID\"" : "cemeteryID = \"$cemeteryID\"";
if( $wherestr ) $wherestr = "WHERE $wherestr";

if( isset($offset) && $offset != 0 ) {
	$offsetplus = $offset + 1;
	$newoffset = "$offset, ";
}
else {
	$offset = 0;
	$offsetplus = 1;
	$newoffset = "";
	$page = 1;
}

$query = "SELECT $media_table.mediaID as mediaID, description, notes, thumbpath, mediatypeID, usecollfolder, datetaken, $media_table.gedcom FROM $media_table $wherestr ORDER BY description LIMIT $newoffset" . $maxsearchresults;
$result = tng_query($query);

$numrows = tng_num_rows( $result );
if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
	$query = "SELECT count($media_table.mediaID) as mcount FROM $media_table $wherestr";
	$result2 = tng_query($query);
	$row = tng_fetch_assoc( $result2 );
	$totrows = $row['mcount'];
	tng_free_result($result2);
}
else
	$totrows = $numrows;

if( !empty($albumID) ) {
	$query2 = "SELECT mediaID FROM $albumlinks_table WHERE albumID = \"$albumID\"";
	$result2 = tng_query($query2) or die ($admtext['cannotexecutequery'] . ": $query2");
	$alreadygot = array();
	while( $row2 = tng_fetch_assoc($result2))
		$alreadygot[] = $row2['mediaID'];
	tng_free_result($result2);
}
else
	$alreadygot[] = array();

header("Content-type:text/html; charset=" . $session_charset);

$numrowsplus = $numrows + $offset;
if( !$numrowsplus ) $offsetplus = 0;
echo "<p class=\"normal\">{$admtext['matches']}: $offsetplus {$text['to']} $numrowsplus {$text['of']} $totrows";
$pagenav = get_album_nav( $totrows, $maxsearchresults, 5 );
echo " &nbsp; <span class=\"adminnav\">$pagenav</span></p>";
?>
	<table cellpadding="3" cellspacing="1" border="0" width="705" class="normal">
		<tr>
			<td class="fieldnameback" width="50"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['select']; ?></b>&nbsp;</nobr></span></td>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['thumb']; ?></b>&nbsp;</nobr></span></td>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['description']; ?></b>&nbsp;</nobr></span></td>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['date']; ?></b>&nbsp;</nobr></span></td>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['mediatype']; ?></b>&nbsp;</nobr></span></td>
		</tr>
<?php
	while( $row = tng_fetch_assoc($result))
	{
		$mtypeID = $row['mediatypeID'];
		$label = $mediatypes_display[$mtypeID] ? $mediatypes_display[$mtypeID] : $text[$mtypeID];
		$treestr = $tngconfig['mediatrees'] && $row['gedcom'] ? $row['gedcom'] . "/" : "";
		$usefolder = $row['usecollfolder'] ? $mediatypes_assoc[$mtypeID] : $mediapath;
		echo "<tr id=\"addrow_{$row['mediaID']}\"><td class=\"lightback\" align=\"center\">";
		echo "<div id=\"add_{$row['mediaID']}\" class=\"normal\"";
		$gotit = in_array($row['mediaID'],$alreadygot);
		if($gotit)
			echo " style=\"display:none\"";
		if($albumID)
			echo "><a href=\"#\" onclick=\"return addToAlbum('{$row['mediaID']}');\">" . $admtext['add'] . "</a></div>";
		else
			echo "><a href=\"#\" onclick=\"return selectMedia('{$row['mediaID']}');\">" . $admtext['select'] . "</a></div>";
		echo "<div id=\"added_{$row['mediaID']}\"";
		if(!$gotit)
			echo " style=\"display:none\">";
		else
			echo "><img src=\"img/tng_test.gif\" alt=\"\" $dims class=\"smallicon\">";
		echo "</div>";
		echo "&nbsp;</td>";
		echo "<td valign=\"top\" class=\"lightback\" style=\"text-align:center\" id=\"thumbcell_{$row['mediaID']}\">";
		if( $row['thumbpath'] && file_exists("$rootpath$usefolder/$treestr" . $row['thumbpath'])) {
			$size = @GetImageSize( "$rootpath$usefolder/$treestr" . $row['thumbpath'] );
			echo "<a href=\"admin_editmedia.php?mediaID={$row['mediaID']}\" target=\"_blank\"><img class=\"adminthumb\" src=\"$usefolder/$treestr" . str_replace("%2F","/",rawurlencode( $row['thumbpath'] )) . "\" $size[3]></a>\n";
		}
		else
			echo "&nbsp;";
		echo "</td>\n";
		$truncated = substr($row['notes'],0,90);
		$truncated = strlen($row['notes']) > 90 ? substr($truncated,0,strrpos($truncated,' ')) . '&hellip;' : $row['notes'];
		echo "<td class=\"lightback normal\" valign=\"top\" id=\"desc_{$row['mediaID']}\"><a href=\"admin_editmedia.php?mediaID={$row['mediaID']}\">{$row['description']}</a><br/>$truncated &nbsp;</td>";
		echo "<td class=\"lightback normal\" style=\"width:100px;\" valign=\"top\" id=\"date_{$row['mediaID']}\">{$row['datetaken']}&nbsp;</td>\n";
		echo "<td class=\"lightback\" valign=\"top\"><span class=\"normal\" id=\"mtype_{$row['mediaID']}\">" . $label . "&nbsp;</span></td>\n";
		echo "</tr>\n";
	}
?>
	</table>
<?php
	echo "<p class=\"normal\">{$admtext['matches']}: $offsetplus {$text['to']} $numrowsplus {$text['of']} $totrows";
	echo " &nbsp; <span class=\"adminnav\">$pagenav</span></p>";
?>