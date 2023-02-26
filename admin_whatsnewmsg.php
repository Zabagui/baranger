<?php
include("begin.php");
include("adminlib.php");
$textpart = "reports";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( $assignedtree ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$file = "$rootpath/whatsnew.txt";

$contents = @file($file);

$whatsnew_url = getURL( "whatsnew", 0 );
$helplang = findhelp("misc_help.php");

tng_adminheader( $admtext['whatsnew'], $flags );
?>
<script type="text/javascript">
//<![CDATA[
<?php
    include("niceditmsgs.php");
?>
//]]>
</script>
</head>

<?php
	echo tng_adminlayout();

	$misctabs[0] = array(1,"admin_misc.php",$admtext['menu'],"misc");
	$misctabs[1] = array(1,"admin_whatsnewmsg.php",$admtext['whatsnew'],"whatsnew");
	$misctabs[2] = array(1,"admin_mostwanted.php",$admtext['mostwanted'],"mostwanted");
	$misctabs[3] = array(1,"admin_data_validation.php",$admtext['dataval'],"validation");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/misc_help.php#add');\" class=\"lightlink\">{$admtext['help']}</a>";
	$innermenu .= " &nbsp;|&nbsp; <a href=\"$whatsnew_url\" target=\"_blank\" class=\"lightlink\">{$admtext['test']}</a>";
	$menu = doMenu($misctabs,"whatsnew",$innermenu);
	echo displayHeadline($admtext['misc'] . " &gt;&gt; " . $admtext['whatsnew'],"img/misc_icon.gif",$menu,"");
?>

<div class="admin-main">
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="adm-rounded-table">
<tr>
<td class="tngshadow databack">
	<form action="admin_savewhatsnewmsg.php" method="post"  name="form1">
	<p class="subhead"><strong><?php echo $admtext['wnmsg']; ?>:</strong></p>
	<p class="normal" id="savedmsg" style="<?php if( !empty($color) ) echo "color:$color;"; else echo "display:none;" ?>"><i><?php if( isset($message) ) echo $message; ?></i></p>
	<textarea cols="100" rows="20" name="whatsnewmsg" id="whatsnewmsg"><?php if(is_array($contents)) {foreach( $contents as $line ) {echo $line;}} ?></textarea><br />
	<input type="submit" name="submitx" class="btn" value="<?php echo $admtext['saveback']; ?>">
	<input type="submit" name="submit" accesskey="s" class="btn" value="<?php echo $admtext['savereturn']; ?>">
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="window.location.href='admin_misc.php';">
	</form>
</td>
</tr>

</table>
</div>
<script type="text/javascript" src="js/nicedit.js"></script>
<script type="text/javascript">
//<![CDATA[
bkLib.onDomLoaded(function() {
    new nicEditor({fullPanel : true, maxHeight: 300}).panelInstance('whatsnewmsg');
});
//]]>
</script>
<?php 
echo tng_adminfooter();
?>