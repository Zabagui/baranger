<?php
include("begin.php");
include("adminlib.php");
$textpart = "reports";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

$mostwanted_url = getURL( "mostwanted", 0 );
$helplang = findhelp("mostwanted_help.php");

function showDiv($type) {
	global $thumbmaxw, $admtext, $mostwanted_table, $media_table, $people_table, $mediatypes_assoc, $mediapath, $allow_add, $allow_delete, $allow_edit, $rootpath;

	if($allow_add) {
		echo "<form action=\"\" style=\"margin:0px;padding-bottom:5px\" method=\"post\" name=\"form$type\" id=\"form$type\">\n";
		echo "<input type=\"button\" value=\"" . $admtext['addnew'] . "\" onclick=\"return openMostWanted('$type','');\">\n";
		echo "</form>\n";
	}

	echo "<div id=\"order$type" . "divs\">\n";
	echo "<table id=\"order$type" . "tbl\" width=\"100%\" cellpadding=\"3\" cellspacing=\"1\" border=\"0\" class=\"normal\">\n";
	echo "<tr>\n";
	echo "<td class=\"fieldnameback\" style=\"width:55px\"><span class=\"fieldname\"><nobr>&nbsp;<b>" . $admtext['text_sort'] . "</b>&nbsp;</nobr></span></td>\n";
	echo "<td class=\"fieldnameback\" style=\"width:" . ($thumbmaxw+10) . "px\"><span class=\"fieldname\"><nobr>&nbsp;<b>" . $admtext['thumb'] . "</b>&nbsp;</nobr></span></td>\n";
	echo "<td class=\"fieldnameback\"><span class=\"fieldname\"><nobr>&nbsp;<b>" . $admtext['description'] . "</b>&nbsp;</nobr></span></td>\n";
	echo "</tr>\n";
	echo "</table>\n";


	$query = "SELECT $mostwanted_table.ID as mwID, mwtype, thumbpath, usecollfolder, mediatypeID, $media_table.description as mtitle, $mostwanted_table.description as mwdesc, $mostwanted_table.title as title FROM $mostwanted_table
		LEFT JOIN $media_table ON $mostwanted_table.mediaID = $media_table.mediaID
		LEFT JOIN $people_table ON $mostwanted_table.personID = $people_table.personID AND $mostwanted_table.gedcom = $people_table.gedcom
		WHERE mwtype = \"$type\" ORDER BY ordernum";
	$result = tng_query($query);
	//echo $query;

	while( $lrow = tng_fetch_assoc( $result ) )
	{
		$lmediatypeID = $lrow['mediatypeID'];
		$usefolder = $lrow['usecollfolder'] ? $mediatypes_assoc[$lmediatypeID] : $mediapath;

		$truncated = substr($lrow['mwdesc'],0,90);
		$truncated = strlen($lrow['mwdesc']) > 90 ? substr($truncated,0,strrpos($truncated,' ')) . '&hellip;' : $lrow['mwdesc'];
		echo "<div class=\"sortrow\" id=\"order{$lrow['mwtype']}" . "divs_{$lrow['mwID']}\" style=\"clear:both\" onmouseover=\"showEditDelete('{$lrow['mwID']}');\" onmouseout=\"hideEditDelete('{$lrow['mwID']}');\">";
		echo "<table width=\"100%\" cellpadding=\"5\" cellspacing=\"1\"><tr id=\"row_{$lrow['mwID']}\">\n";
		echo "<td class=\"dragarea normal\">";
   		echo "<img src=\"img/admArrowUp.gif\" alt=\"\"><br/>" . $admtext['drag'] . "<br/><img src=\"img/admArrowDown.gif\" alt=\"\">\n";
		echo "</td>\n";
		echo "<td class=\"lightback\" style=\"width:" . ($thumbmaxw+10) . "px;text-align:center;\">";
		if( $lrow['thumbpath'] && file_exists( "$rootpath$usefolder/" . $lrow['thumbpath'] ) ) {
			$size = @GetImageSize( "$rootpath$usefolder/" . $lrow['thumbpath'] );
			echo "<img src=\"$usefolder/" . str_replace("%2F","/",rawurlencode( $lrow['thumbpath'] )) . "\" class=\"adminthumb\" $size[3]} id=\"img_{$lrow['mwID']}\" alt=\"{$lrow['mtitle']}\" />";
		}
		else {
			echo "&nbsp;";
		}
		echo "</td>\n";
		echo "<td class=\"lightback normal\">";
		if($allow_edit)
			echo "<a href=\"#\" onclick=\"return openMostWanted('{$lrow['mwtype']}','{$lrow['mwID']}');\" id=\"title_{$lrow['mwID']}\">{$lrow['title']}</a>";
		else
			echo "<u id=\"title_{$lrow['mwID']}\">{$lrow['title']}</u>";
		echo "<br /><span id=\"desc_{$lrow['mwID']}\">$truncated</span><br />";
		echo "<div id=\"del_{$lrow['mwID']}\" class=\"smaller\" style=\"color:gray;visibility:hidden\">";
		if($allow_edit) {
			echo "<a href=\"#\" onclick=\"return openMostWanted('{$lrow['mwtype']}','{$lrow['mwID']}');\">{$admtext['edit']}</a>";
			if($allow_delete) echo " | ";
		}
		if($allow_delete) {
			echo "<a href=\"#\" onclick=\"return removeFromMostWanted('{$lrow['mwtype']}','{$lrow['mwID']}');\">{$admtext['text_delete']}</a>";
		}
		echo "</div>";
		echo "</td>\n";
		echo "</tr></table>";
		echo "</div>\n";
	}
	$numrows = tng_num_rows($result);
	tng_free_result($result);
	echo "</div>\n";
}

tng_adminheader( $admtext['mostwanted'], $flags );
?>
<script type="text/javascript" src="js/mostwanted.js"></script>
<script type="text/javascript" src="js/admin.js"></script>
<script type="text/javascript" src="js/selectutils.js"></script>
<script type="text/javascript">
var mwlitbox;
var tnglitbox;
var entertitle = "<?php echo $admtext['entertitle']; ?>";
var enterdesc = "<?php echo $admtext['enterdesc']; ?>";
var drag = "<?php echo $admtext['drag']; ?>";
var thumbwidth = <?php echo ($thumbmaxw+6); ?>;
var edittext = "<?php echo $admtext['edit']; ?>";
var deltext = "<?php echo $admtext['text_delete']; ?>";
var confremmw = "<?php echo $admtext['confremmw']; ?>";
var loading = "<?php echo $text['loading']; ?>";
var tree = "<?php echo $assignedtree; ?>";
</script>
</head>

<?php
	echo tng_adminlayout(" onLoad=\"startMostWanted()\"");

	$misctabs[0] = array(1,"admin_misc.php",$admtext['menu'],"misc");
	$misctabs[1] = array(1,"admin_whatsnewmsg.php",$admtext['whatsnew'],"whatsnew");
	$misctabs[2] = array(1,"admin_mostwanted.php",$admtext['mostwanted'],"mostwanted");
	$misctabs[3] = array(1,"admin_data_validation.php",$admtext['dataval'],"validation");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/mostwanted_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$innermenu .= " &nbsp;|&nbsp; <a href=\"$mostwanted_url\" target=\"_blank\" class=\"lightlink\">{$admtext['test']}</a>";
	$menu = doMenu($misctabs,"mostwanted",$innermenu);
	echo displayHeadline($admtext['misc'] . " &gt;&gt; " . $admtext['mostwanted'],"img/misc_icon.gif",$menu,$message);
?>

<div class="admin-main">
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="adm-rounded-table">
<tr>
<td class="tngshadow databack">
<?php
	echo displayToggle("plus0",1,"personarea",$admtext['mysperson'],"");
	echo "<div id=\"personarea\">\n<br/>\n";
	showDiv('person');
	echo "<br /></div>\n";

	echo "<br />\n";

	echo displayToggle("plus1",1,"photoarea",$admtext['mysphoto'],"");
	echo "<div id=\"photoarea\">\n<br/>\n";
	showDiv('photo');
	echo "</div>\n";
?>
</td>
</tr>

</table>
</div>
<?php 
echo tng_adminfooter();
?>