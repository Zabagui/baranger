<?php
include("begin.php");
include("adminlib.php");
$textpart = "setup";
//include("getlang.php");
include("$mylanguage/admintext.php");

if( $link ) {
	$admin_login = 1;
	include("checklogin.php");
	include("version.php");
}

require("adminlog.php");

if( $assignedtree ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$badtables = "";
$collation = "";
if ( !isset($helplang) ) $helplang = "English";

include("tabledefs.php");

if(!$badtables)
	adminwritelog( $admtext['createtables'] );

tng_adminheader( $admtext['tablecreation'], $flags );
?>
</head>

<?php
	echo tng_adminlayout();

	$setuptabs[0] = array(1,"admin_setup.php",$admtext['configuration'],"configuration");
	$setuptabs[1] = array(1,"admin_setup.php?sub=diagnostics",$admtext['diagnostics'],"diagnostics");
	$setuptabs[2] = array(1,"admin_setup.php?sub=tablecreation",$admtext['tablecreation'],"tablecreation");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/setup_help.php#tables');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($setuptabs,"tablecreation",$innermenu);
	echo displayHeadline($admtext['setup'] . " &gt;&gt; " . $admtext['tablecreation'],"img/setup_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">
<?php 
	if($badtables)
		//echo $admtext['tnotcreated'] . ": $badtables";
		echo "Tables not created: $badtables";
	else
		echo $admtext['tablesuccess'];
?>
</p>
			<p><a href="admin_setup.php"><?php echo $admtext['backtosetup']; ?></a>.</p></span>
	</div>
</div>
<?php 
echo tng_adminfooter();
?>