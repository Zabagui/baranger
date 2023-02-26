<?php
include("begin.php");
include("adminlib.php");
$textpart = "reports";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

$query = "SELECT thumbpath,	usecollfolder, description, notes, mediatypeID FROM $media_table WHERE mediaID = \"$mediaID\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
tng_free_result($result);

header("Content-type:text/html; charset=" . $session_charset);
?>

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
			echo "<img src=\"$usefolder/" . str_replace("%2F","/",rawurlencode( $row['thumbpath'] )) . "\" border=\"0\" width=\"$photowtouse\" height=\"$photohtouse\" id=\"img_$mediaID\" alt=\"{$row['description']}\" />";
		}
		else {
			echo "&nbsp;";
		}
		$row['notes'] = xmlcharacters($row['notes']);
		$truncated = substr($row['notes'],0,90);
		$truncated = strlen($row['notes']) > 90 ? substr($truncated,0,strrpos($truncated,' ')) . '&hellip;' : $row['notes'];
?>
		</td>
		<td class="lightback normal" id="mwdetails"><?php echo "<u>" . xmlcharacters($row['description']) . "</u><br />" . $truncated; ?>&nbsp;</td>
	</tr>
</table>