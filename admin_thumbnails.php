<?php
include("begin.php");
include("adminlib.php");
$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( !$allow_media_edit ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$helplang = findhelp("media_help.php");

tng_adminheader( $admtext['sortmedia'], $flags );
?>
<script type="text/javascript" src="js/admin.js"></script>
<script type="text/javascript" src="js/mediautils.js"></script>
<script type="text/javascript">
function toggleAll(display) {
	toggleSection('thumbs','plus1',display);
	toggleSection('defaults','plus2',display);
	return false;
}
</script>
</head>

<?php
	echo tng_adminlayout();

	$mediatabs[0] = array(1,"admin_media.php",$admtext['search'],"findmedia");
	$mediatabs[1] = array($allow_add,"admin_newmedia.php",$admtext['addnew'],"addmedia");
	$mediatabs[2] = array($allow_edit,"admin_ordermediaform.php",$admtext['text_sort'],"sortmedia");
	$mediatabs[3] = array($allow_edit && !$assignedtree,"admin_thumbnails.php",$admtext['thumbnails'],"thumbs");
	$mediatabs[4] = array($allow_media_add,"admin_photoimport.php",$admtext['import'],"import");
	$mediatabs[5] = array($allow_media_add && !$assignedtree,"admin_mediaupload.php",$admtext['upload'],"upload");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/media_help.php#thumbs');\" class=\"lightlink\">{$admtext['help']}</a>";
	$innermenu .= " &nbsp;|&nbsp; <a href=\"#\" class=\"lightlink\" onClick=\"return toggleAll('on');\">{$text['expandall']}</a> &nbsp;|&nbsp; <a href=\"#\" class=\"lightlink\" onClick=\"return toggleAll('off');\">{$text['collapseall']}</a>";
	$menu = doMenu($mediatabs,"thumbs",$innermenu);
	echo displayHeadline($admtext['media'] . " &gt;&gt; " . $admtext['thumbnails'],"img/photos_icon.gif",$menu,$message);
?>

<div class="admin-main">

<table width="100%" border="0" cellpadding="10" cellspacing="2" class="adm-rounded-table">
<?php
if( !$assignedtree ) {
	if( function_exists( 'imageJpeg' ) ) {
?>
<tr>
<td class="tngshadow databack">
	<?php echo displayToggle("plus1",1,"thumbs",$admtext['genthumbs'],$admtext['genthumbsdesc']); ?>

	<div id="thumbs">
	<br/>
	<form action="admin_generatethumbs.php"  method="post" onsubmit="return generateThumbs(this);">
	<input type="checkbox" name="regenerate" value="1"> <?php echo $admtext['regenerate']; ?><br/>
	<input type="checkbox" name="repath" value="1"> <?php echo $admtext['repath']; ?><br/><br/>
	<input type="submit" name="submit" class="btn" value="<?php echo $admtext['generate']; ?>"> <img src="img/spinner.gif" id="thumbspin" style="display:none">
	</span>
	</form>

	<div id="thumbresults" style="display:none">
	</div>

	</div>
</td>
</tr>
<?php
	}
?>

<tr>
<td class="tngshadow databack">
	<?php echo displayToggle("plus2",1,"defaults",$admtext['assigndefs'],$admtext['assigndefsdesc']); ?>

	<div id="defaults">
	<br/>
	<form action="defphotos.php"  method="post" onsubmit="return assignDefaults(this);">
	<input type="checkbox" name="overwritedefs" value="1"> <?php echo $admtext['overwritedefs']; ?><br/><br/>
	<?php echo $admtext['tree']; ?>: <select name="tree">
<?php
	$query = "SELECT gedcom, treename FROM $trees_table ORDER BY treename";
	$result = tng_query($query);
	while( $row = tng_fetch_assoc($result) ) {
		echo "	<option value=\"{$row['gedcom']}\">{$row['treename']}</option>\n";
	}
?>
	</select><br/><br/>
	<input type="submit" name="submit" class="btn" value="<?php echo $admtext['assign']; ?>"> <img src="img/spinner.gif" id="defspin" style="display:none">
	</span>
	</form>

	<div id="defresults" style="display:none">
	</div>

	</div>
</td>
</tr>
<?php
}
?>
</table>
</div>
<?php 
echo tng_adminfooter();
?>