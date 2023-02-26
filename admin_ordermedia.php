<?php
include("begin.php");
include("adminlib.php");
$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

require("adminlog.php");

initMediaTypes();

//mediatypeID and linktype should be passed in
$linktype = $linktype1;
$personID = attachPrefixSuffix(ucfirst( $newlink1 ), $linktype);
$eventID = !empty($event1) ? $event1 : "";
$tree = $linktype == "L" && $tngconfig['places1tree'] ? "" : $tree1;

$titlestr = !empty($text[$mediatypeID]) ? $text[$mediatypeID] : $mediatypes_display[$mediatypeID];
$sortstr = preg_replace( "/xxx/", $titlestr, $admtext['sortmedia'] );

switch( $linktype ) {
	case "I":
		$query = "SELECT lastname, lnprefix, firstname, prefix, suffix, nameorder, title, branch, gedcom FROM $people_table WHERE personID=\"$personID\" AND gedcom = \"$tree\"";
		$result2 = tng_query($query);
		$person = tng_fetch_assoc( $result2 );
		$person['allow_living'] = 1;
		$person['allow_private'] = 1;
		$namestr = "$personID: " . getName( $person );
		tng_free_result($result2);
		$test_url = getURL( "getperson", 1 );
		$testID = "personID";
		break;
	case "F":
		$query = "SELECT branch FROM $families_table WHERE familyID=\"$personID\" AND gedcom = \"$tree\"";
		$result2 = tng_query($query);
		$person = tng_fetch_assoc( $result2 );
		$namestr = "{$admtext['family']}: $personID";
		tng_free_result($result2);
		$test_url = getURL( "familygroup", 1 );
		$testID = "familyID";
		break;
	case "S":
		$query = "SELECT title FROM $sources_table WHERE sourceID=\"$personID\" AND gedcom = \"$tree\"";
		$result2 = tng_query($query);
		$person = tng_fetch_assoc( $result2 );
		$namestr = "{$admtext['source']}: $personID";
		if( $person['title'] ) $namestr .= ", " . $person['title'];
		$person['branch'] = "";
		tng_free_result($result2);
		$test_url = getURL( "showsource", 1 );
		$testID = "sourceID";
		break;
	case "R":
		$query = "SELECT reponame FROM $repositories_table WHERE repoID=\"$personID\" AND gedcom = \"$tree\"";
		$result2 = tng_query($query);
		$person = tng_fetch_assoc( $result2 );
		$namestr = "{$admtext['repository']}: $personID";
		if( $person['reponame'] ) $namestr .= ", " . $person['reponame'];
		$person['branch'] = "";
		tng_free_result($result2);
		$test_url = getURL( "showrepo", 1 );
		$testID = "repoID";
		break;
	case "L":
		$namestr = $personID;
		$person['branch'] = "";
		$test_url = getURL( "placesearch", 1 );
		$testID = "psearch";
		break;
}

if( !checkbranch( $person['branch'] ) ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

adminwritelog( "<a href=\"admin_ordermedia.php?personID=$personID&amp;tree=$tree\">$sortstr: $tree/$personID</a>" );

$photo = "";

$query = "SELECT alwayson, thumbpath, $media_table.mediaID as mediaID, usecollfolder, mediatypeID, medialinkID, $media_table.gedcom FROM ($media_table, $medialinks_table)
	WHERE personID = \"$personID\" AND $medialinks_table.gedcom = \"$tree\" AND $media_table.mediaID = $medialinks_table.mediaID AND defphoto = '1'";
$result = tng_query($query);
if( $result ) $row = tng_fetch_assoc( $result );
$thismediatypeID = isset($row['mediatypeID']) ? $row['mediatypeID'] : "";
tng_free_result($result);

$query = "SELECT * FROM ($medialinks_table, $media_table) WHERE $medialinks_table.personID=\"$personID\" AND $medialinks_table.gedcom = \"$tree\" AND $media_table.mediaID = $medialinks_table.mediaID AND eventID = \"$eventID\" AND mediatypeID = \"$mediatypeID\" ORDER BY ordernum";
$result = tng_query($query);

$numrows = tng_num_rows( $result );

if ( !$numrows ) {
	$message = $admtext['noresults'];
	header( "Location: admin_ordermediaform.php?personID=$personID&message=" . urlencode($message) );
	exit;
}

$helplang = findhelp("media_help.php");

tng_adminheader( $sortstr, $flags );

$treestr = $tngconfig['mediatrees'] && $row['gedcom'] ? $row['gedcom'] . "/" : "";
$usefolder = !empty($row['usecollfolder']) ? $mediatypes_assoc[$thismediatypeID] : $mediapath;

if( !empty($row['thumbpath']) )
	$photoref = "$usefolder/$treestr" . $row['thumbpath'];
else {
	$photoref = $tree ? "$usefolder/$tree.$personID.$photosext" : "$photopath/$personID.$photosext";
}

if( file_exists( "$rootpath$photoref" ) ) {
	$photoinfo = @getimagesize( "$rootpath$photoref" );
	if( $photoinfo[1] <= $thumbmaxh ) {
		$photohtouse = $photoinfo[1];
		$photowtouse = $photoinfo[0];
	}
	else {
		$photohtouse = $thumbmaxh;
		$photowtouse = intval( $thumbmaxh * $photoinfo[0] / $photoinfo[1] ) ;
	}
	$photo = "<img src=\"" . str_replace("%2F","/",rawurlencode( $photoref )) . "?" . time() . "\" class=\"adminthumb\" alt=\"\" width=\"$photowtouse\" height=\"$photohtouse\" align=\"left\" style=\"margin-right:10px\">";
}
?>
<script type="text/javascript">
var entity = "<?php echo $personID; ?>";
var tree = "<?php echo $tree; ?>";
var album = "";
var orderaction = "order";
</script>
<script type="text/javascript" src="js/selectutils.js"></script>
<script type="text/javascript" src="js/mediautils.js"></script>
<script type="text/javascript" src="js/admin.js"></script>
</head>

<?php
	echo tng_adminlayout(" onLoad=\"startMediaSort()\"");

	$mediatabs[0] = array(1,"admin_media.php",$admtext['search'],"findmedia");
	$mediatabs[1] = array($allow_media_add,"admin_newmedia.php",$admtext['addnew'],"addmedia");
	$mediatabs[2] = array($allow_media_edit,"admin_ordermediaform.php",$admtext['text_sort'],"sortmedia");
	$mediatabs[3] = array($allow_media_edit && !$assignedtree,"admin_thumbnails.php",$admtext['thumbnails'],"thumbs");
	$mediatabs[4] = array($allow_media_add && !$assignedtree,"admin_photoimport.php",$admtext['import'],"import");
	$mediatabs[5] = array($allow_media_add,"admin_mediaupload.php",$admtext['upload'],"upload");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/media_help.php#sortfor');\" class=\"lightlink\">{$admtext['help']}</a>";
	$innermenu .= " &nbsp;|&nbsp; <a href=\"$test_url" . "$testID=$personID&amp;tree=$tree\" target=\"_blank\" class=\"lightlink\">{$admtext['test']}</a>";
	$menu = doMenu($mediatabs,"sortmedia",$innermenu);
	echo displayHeadline($admtext['media'] . " &gt;&gt; " . $admtext['text_sort'],"img/photos_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">
	<span class="subhead"><?php echo "<div id=\"thumbholder\" style=\"float:left\">$photo</div><strong>$sortstr<br/>$namestr</strong>"; ?></span><br/><br clear="left">
	<?php
		echo "<p class=\"smaller\" id=\"removedefault\"";
		if(!$photo) echo " style=\"display:none\"";
		echo "><a href=\"#\" onclick=\"return removeDefault();\">{$admtext['removedef']}</a></p>\n";
	?>
	<table id="ordertbl" width="100%" cellpadding="3" cellspacing="1" border="0" class="fieldname normal">
		<tr>
			<td class="fieldnameback" style="width:105px">&nbsp;<b><?php echo $admtext['text_sort']; ?></b>&nbsp;</td>
			<td class="fieldnameback" style="width:100px">&nbsp;<b><?php echo $admtext['thumb']; ?></b>&nbsp;</td>
			<td class="fieldnameback">&nbsp;<b><?php echo $admtext['description']; ?></b>&nbsp;</td>
			<td class="fieldnameback" style="width:45px;">&nbsp;<b><?php echo $admtext['show']; ?></b>&nbsp;</td>
			<td class="fieldnameback" style="width:151px">&nbsp;<b><?php echo $admtext['datetaken']; ?></b>&nbsp;</td>
		</tr>
	</table>

<form  name="form1">
<div id="orderdivs">
<?php
	$result = tng_query($query);
	$count = 1;
	while( $row = tng_fetch_assoc( $result ) )
	{
		$treestr = $tngconfig['mediatrees'] && $row['gedcom'] ? $row['gedcom'] . "/" : "";
		$usefolder = $row['usecollfolder'] ? $mediatypes_assoc[$mediatypeID] : $mediapath;
		$truncated = substr($row['notes'],0,90);
		$truncated = strlen($row['notes']) > 90 ? substr($truncated,0,strrpos($truncated,' ')) . '&hellip;' : $row['notes'];
		echo "<div class=\"sortrow\" id=\"orderdivs_{$row['medialinkID']}\" style=\"clear:both;position:relative\" onmouseover=\"jQuery('#md_{$row['medialinkID']}').css('visibility','visible');\" onmouseout=\"jQuery('#md_{$row['medialinkID']}').css('visibility','hidden');\">";
		echo "<table width=\"100%\" cellpadding=\"5\" cellspacing=\"1\"><tr>\n";
		echo "<td class=\"dragarea normal\">";
   		echo "<img src=\"img/admArrowUp.gif\" alt=\"\"><br/>" . $admtext['drag'] . "<br/><img src=\"img/admArrowDown.gif\" alt=\"\">\n";
		echo "</td>\n";

		echo "<td class=\"lightback smaller\" style=\"width:35px;text-align:center\">";
 		echo "<div style=\"padding-bottom:5px\"><a href=\"#\" onclick=\"return moveItemInList('{$row['medialinkID']}',1);\" title=\"{$admtext['movetop']}\"><img src=\"img/admArrowUp.gif\" alt=\"\" border=\"0\"><br/>{$text['top']}</a></div>\n";
 		echo "<input class=\"movefields\" name=\"move{$row['medialinkID']}\" id=\"move{$row['medialinkID']}\" value=\"$count\" onkeypress=\"handleMediaEnter('{$row['medialinkID']}',jQuery('#move{$row['medialinkID']}').val(),event);\" />\n";
 		echo "<a href=\"#\" onclick=\"return moveItemInList('{$row['medialinkID']}',jQuery('#move{$row['medialinkID']}').val());\" title=\"{$admtext['movetop']}\">{$admtext['go']}</a>\n";
		echo "</td>\n";

		echo "<td class=\"lightback\" style=\"width:100px;text-align:center;\">";
		if( $row['thumbpath'] && file_exists( "$rootpath$usefolder/$treestr" . $row['thumbpath'] ) ) {
			$size = @GetImageSize( "$rootpath$usefolder/$treestr" . $row['thumbpath'] );
			echo "<a href=\"admin_editmedia.php?mediaID={$row['mediaID']}\"><img src=\"$usefolder/$treestr" . str_replace("%2F","/",rawurlencode( $row['thumbpath'] )) . "\" class=\"adminthumb\" $size[3] alt=\"{$row['description']}\"></a>";
		}
		elseif( $row['form'] == "TXT" )
			echo "<span class=\"normal\">Text</span>\n";
		else
			echo "&nbsp;";
		echo "</td>\n";
		$checked = $row['defphoto'] ? " checked" : "";
		echo "<td class=\"lightback normal\"><a href=\"admin_editmedia.php?mediaID={$row['mediaID']}\">{$row['description']}</a><br/>$truncated<br/>\n";
		echo "<span id=\"md_{$row['medialinkID']}\" class=\"smaller\" style=\"color:gray;visibility:hidden\">\n";
		echo "<input type=\"radio\" name=\"rthumbs\" value=\"r{$row['mediaID']}\"$checked onclick=\"makeDefault(this);\">{$admtext['makedefault']}\n";
		echo " &nbsp;|&nbsp; ";
		echo "<a href=\"#\" onclick=\"return removeFromSort('media','{$row['medialinkID']}');\">{$admtext['remove']}</a>";
		echo "</span>&nbsp;</td>\n";
		echo "<td class=\"lightback normal\" style=\"width:45px;text-align:center;vertical-align:top\">";
		$checked = $row['dontshow'] ? "" : " checked=\"checked\"";
		echo "<input type=\"checkbox\" name=\"show{$row['medialinkID']}\" onclick=\"toggleShow(this);\" value=\"1\"$checked/>&nbsp;</td>\n";
		echo "<td class=\"lightback normal\" style=\"width:150px;\">{$row['datetaken']}&nbsp;</td>\n";
		echo "</tr></table>";
		echo "</div>\n";
		$count++;
	}
	tng_free_result($result);
?>
</div>
</form>

	</div>
</div>

<?php 
echo tng_adminfooter();
?>