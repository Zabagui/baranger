<?php
include("begin.php");
include("adminlib.php");
$textpart = "misc";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

$helplang = findhelp("misc_help.php");

tng_adminheader( $admtext['misc'], $flags );
?>
</head>

<?php
	echo tng_adminlayout();

	$misctabs[0] = array(1,"admin_misc.php",$admtext['menu'],"misc");
	$misctabs[1] = array(1,"admin_whatsnewmsg.php",$admtext['whatsnew'],"whatsnew");
	$misctabs[2] = array(1,"admin_mostwanted.php",$admtext['mostwanted'],"mostwanted");
	$misctabs[3] = array(1,"admin_data_validation.php",$admtext['dataval'],"validation");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/misc_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($misctabs,"misc",$innermenu);
	echo displayHeadline($admtext['misc'], "img/misc_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">
<?php
	if( !$assignedtree ) {
?>
	<p class="subhead"><img src="img/tng_expand.gif" width="15" height="15" border="0"/> <a href="admin_whatsnewmsg.php"><b><?php echo $admtext['whatsnew']; ?></b></a><br/>
	<span class="normal miscmenu"><?php echo $admtext['whatsnewblurb']; ?></span></p>
	<p class="subhead"><img src="img/tng_expand.gif" width="15" height="15" border="0"/> <a href="admin_mostwanted.php"><b><?php echo $admtext['mostwanted']; ?></b></a><br/>
	<span class="normal miscmenu"><?php echo $admtext['mwblurb']; ?></span></p>
<?php
}
?>
	<p class="subhead"><img src="img/tng_expand.gif" width="15" height="15" border="0"/> <a href="admin_data_validation.php"><b><?php echo $admtext['dataval']; ?></b></a><br/>
	<span class="normal miscmenu"><?php echo $admtext['dvblurb']; ?></span></p>
	<br/><br/><br/><br/><br/><br/>
	</div>
</div>
<?php 
echo tng_adminfooter();
?>