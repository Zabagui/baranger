<?php
include("begin.php");
include("adminlib.php");
$textpart = "index";
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( !$allow_add || !$allow_edit || !$allow_delete ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

tng_adminheader( $admtext['upgrade'], $flags );
?>
</head>

<?php
	echo tng_adminlayout();

	$setuptabs[0] = array(1,"admin_upgrade.php",$admtext['upgrade'],"upgrade");
	$menu = doMenu($setuptabs,"upgrade","&nbsp;");
	echo displayHeadline($admtext['upgrade'],"img/setup_icon.gif",$menu,"");
?>

<div class="admin-main">
	<table width="100%" border="0" cellpadding="10" cellspacing="2" class="adm-rounded-table">
		<tr>
			<td class="tngshadow databack">
				<span class="plainheader"><?php echo $admtext['need_upgrade']; ?></span>

				<?php
					$missing = true;
					$upgrades = glob("upgrade-*-14x.html");
					if(count($upgrades)) {
						include($upgrades[0]);
						$missing = false;
					}
					$dbupgrades = glob("upgrade_db*-14x.php");
					$dbupgrade = count($dbupgrades) ? $dbupgrades[0] : "";
					echo "<br/><br/>\n";
					if($missing) 
						echo "<p>{$admtext['upgrade_missing']}</p>\n";
					else
						echo "<p><a href=\"admin_deletefile.php?filename={$upgrades[0]}&dbupgrade={$dbupgrade}&upgrade=1\">{$admtext['delete_upgrade']} [{$upgrades[0]}, $dbupgrade]</a></p>\n"
				?>
			</td>
		</tr>
	</table>
</div>

<?php
echo tng_adminfooter();
?>