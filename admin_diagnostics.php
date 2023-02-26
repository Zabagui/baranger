<?php
//This page written and contributed by Bert Deelman. Thanks, Bert!
include("begin.php");
include($subroot . "logconfig.php");
include($subroot . "importconfig.php");
include("adminlib.php");
$textpart = "setup";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

$file_uploads = (bool) ini_get("file_uploads");
$safe_mode = (bool) ini_get("safe_mode");

error_reporting( E_ERROR | E_PARSE );	//	Disable error reporting for anything but critical errors

$helplang = findhelp("setup_help.php");

$red = "<img src=\"img/tng_close.gif\" width=\"18\" height=\"18\" align=\"left\" align=\"left\">";
$orange = "<img src=\"img/orange.gif\" width=\"18\" height=\"18\" align=\"left\" align=\"left\">";
$green = "<img src=\"img/tng_check.gif\" width=\"18\" height=\"18\" align=\"left\" align=\"left\">";

tng_adminheader( $admtext['diagnostics'], $flags );
?>
</head>

<?php
	echo tng_adminlayout();

	$setuptabs[0] = array(1,"admin_setup.php",$admtext['configuration'],"configuration");
	$setuptabs[1] = array(1,"admin_diagnostics.php",$admtext['diagnostics'],"diagnostics");
	$setuptabs[2] = array(1,"admin_setup.php?sub=tablecreation",$admtext['tablecreation'],"tablecreation");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/setup_help.php#diagnostics');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($setuptabs,"diagnostics",$innermenu);
	echo displayHeadline($admtext['setup'] . " &gt;&gt; " . $admtext['diagnostics'],"img/setup_icon.gif",$menu,"");
?>

<div class="admin-main">
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="rounded-table">
<tr>
  <td class="tngshadow databack" valign="top" colspan="2">
    <em><?php echo $admtext['sysinfo']; ?></em>
  </td>
</tr>
<tr>
  <td class="tngshadow databack" valign="top"><?php echo $admtext['phpver']; ?>:<br><em><?php echo $admtext['phpreq']; ?></em></td>
  <td class="tngshadow databack" valign="top">
<?php 
	$phpver = floatval(phpversion());
	if ($phpver >= 7.0) { 
    	echo "<p>$green&nbsp;"; 
    } 
    else { 
    	echo "<p>$red&nbsp;";
    }		
      echo 'PHP '.phpversion(); 
?>
		<br />
    	<a href="admin_phpinfo.php"><?php echo $admtext['phpinf']; ?></a>
  </td>
</tr>
<tr>
  <td class="tngshadow databack" valign="top"><?php echo $admtext['gdlib']; ?>:<br><em><?php echo $admtext['gdreq']; ?></em></td>
  <td class="tngshadow databack" valign="top">
<?php 
	if (extension_loaded('gd')) {
		if (ImageTypes() & IMG_GIF)
			echo "<p>$green&nbsp;" . $admtext['available'] . "</p>";
		else 
			echo "<p>$orange&nbsp;" . $admtext['availnogif'] . "</p>";
	} 
	else
		echo "<p>$red&nbsp;" . $admtext['notinst'] . "</p>";
?>
	</td>
</tr>
<tr>
  <td class="tngshadow databack" valign="top"><?php echo $admtext['safemode']; ?>:</td>
  <td class="tngshadow databack" valign="top">
<?php 
  	if (!$safe_mode)
		echo "<p>$green&nbsp;" . $admtext['off'] . "</p>";
	else 
		echo "<p>$orange&nbsp;" . $admtext['on'] . "</p>";
?>
	</td>
</tr>
<tr>
  <td class="tngshadow databack" valign="top"><?php echo $admtext['fileuploads']; ?>:<br><em><?php echo $admtext['fureq']; ?></em></td>
  <td class="tngshadow databack" valign="top">
<?php 
	if ($file_uploads)
		echo "<p>$green&nbsp;" . $admtext['perm'] . "</p>";
	else
		echo "<p>$red&nbsp;" . $admtext['notperm'] . "</p>";
?>
	</td>
  </tr>
  <tr>
    <td class="tngshadow databack" valign="top"><?php echo $admtext['sqlver']; ?>:<br><em><?php echo $admtext['sqlreq']; ?></em></td>
    <td class="tngshadow databack" valign="top">
<?php
	$client_info = tng_get_client_info();
	$dbci = floatval(preg_replace("/[^-0-9\.]/","",$client_info));
	if(strpos($client_info,"mysqlnd") === 0 || $dbci >= 5.5)
		echo "<p>$green&nbsp;";
	else {
		if ($dbci >= 5)
			echo "<p>$orange&nbsp;";
		else
			echo "<p>$red&nbsp;";
	}
	echo 'MySQL '.tng_get_client_info() . " " . $admtext['client'] . "</p>";
	$dbsi = floatval(preg_replace("/[^-0-9\.]/","",tng_get_server_info()));
	if ($dbsi >= 5.5)
		echo "<p>$green&nbsp;";
	else {
		if ($dbsi >= 5)
			echo "<p>$orange&nbsp;";
		else
			echo "<p>$red&nbsp;";
	}
	echo 'MySQL '.tng_get_server_info() . " " . $admtext['server'] . "</p>";
?>
	</td>
  </tr>
  <tr>
    <td class="tngshadow databack" valign="top"><?php echo $admtext['wsrvr']; ?>:</td>
    <td class="tngshadow databack" valign="top">
<?php 
	echo "<p>$green&nbsp;";
	echo $_SERVER['SERVER_SOFTWARE'] . "</p>";
?>
	</td>
  </tr>
  <tr>
    <td valign="top" class="tngshadow databack"><?php echo $admtext['fperms']; ?>:<br><em><?php echo $admtext['fpreq']; ?></em></td>
    <td class="tngshadow databack">
<?php
			$myuserid = getmyuid();
			if (phpversion() >= '4.1.0') { $mygroupid = getmygid(); } else { $mygroupid = getmyuid(); }

			if (function_exists('posix_getuid')) {
				$posixmyuserid = posix_getuid();
				$posixuserinfo = posix_getpwuid ($posixmyuserid);
				$posixname = $posixuserinfo['name'];
				$posixmygroupid = $posixuserinfo['gid'];
				$posixgroupinfo = posix_getgrgid ($posixmygroupid);
				$posixgroup = $posixgroupinfo['name'];

				//if ($myuserid != $posixmyuserid) {
				//	echo '<img src="orange.gif" width="12" height="12">&nbsp;';
				//	echo "$admtext['scruser']} $posixname; {$admtext['phpuser']} $myuserid. {$admtext['usrprob']<br />";
				//}
			} else {
				$posixmyuserid = $myuserid;
				$posixname = get_current_user();
				$posixmygroupid = $mygroupid;
				$posixgroup = '';
			}

			if ($myuserid != $posixmyuserid) { $myuserid = $posixmyuserid; }
			if ($mygroupid != $posixmygroupid) { $mygroupid = $posixmygroupid; }

			$text  = '';
			$ftext = '';
			// check files
			if (!(fileReadWrite($myuserid,$mygroupid,$subroot . 'config.php')))
				$text = "<p>$red&nbsp;{$admtext['rofile']} config.php</p>";
			//$uselog = $cms['support']} ? "../../../$logname" : "../$logname";
			$uselog = $logname;
			if (!(fileReadWrite($myuserid,$mygroupid, $uselog ))) {
				$ftext = "<p>$red&nbsp;{$admtext['rofile']} {$admtext['publog']} ($logname)</p>";
			}
			if (!(fileReadWrite($myuserid,$mygroupid,$adminlogfile))) {
				$ftext .= "<p>$red&nbsp;{$admtext['rofile']} {$admtext['admlog']} ($adminlogfile)</p>";
			}
			if (!(fileReadWrite($myuserid,$mygroupid,$subroot . 'importconfig.php'))) {
				$ftext .= "<p>$red&nbsp;{$admtext['rofile']} importconfig.php</p>";
			}
			if (!(fileReadWrite($myuserid,$mygroupid,$subroot . 'logconfig.php'))) {
				$ftext .= "<p>$red&nbsp;{$admtext['rofile']} logconfig.php</p>";
			}
			if (!(fileReadWrite($myuserid,$mygroupid,$subroot . 'pedconfig.php'))) {
				$ftext .= "<p>$red&nbsp;{$admtext['rofile']} pedconfig.php</p>";
			}
			if (!(fileReadWrite($myuserid,$mygroupid,$subroot . 'mapconfig.php'))) {
				$ftext .= "<p>$red&nbsp;{$admtext['rofile']} mapconfig.php</p>";
			}

			// check folders
			if (!(dirExists($photopath))) {
				$ftext .= "<p>$red&nbsp;{$admtext['folderdne']} $photopath</p>";
			}
			else {
				if (!(dirReadWrite($myuserid,$mygroupid,$photopath))) {
					$ftext .= "<p>$orange&nbsp;{$admtext['rofolder']} $photopath ($rootpath$photopath)</p>";
				}
			}
			if (!(dirExists($headstonepath))) {
				$ftext .= "<p>$red&nbsp;{$admtext['folderdne']} $headstonepath</p>";
			}
			else {
				if (!(dirReadWrite($myuserid,$mygroupid,$headstonepath))) {
					$ftext .= "<p>$orange&nbsp;{$admtext['rofolder']} $headstonepath ($rootpath$headstonepath)</p>";
				}
			}
			if (!(dirExists($historypath))) {
				$ftext .= "<p>$orange&nbsp;{$admtext['folderdne']} $historypath ($rootpath$historypath)</p>";
			}
			else {
				if (!(dirReadWrite($myuserid,$mygroupid,$historypath))) {
					$ftext .= "<p>$orange&nbsp;{$admtext['rofolder']} $historypath ($rootpath$historypath)</p>";
				}
			}
			$fullbackuppath = !empty($tngconfig['saveconfig']) ? $subroot . $backuppath : $rootpath . $backuppath;
			if (!(dirExists($fullbackuppath))) {
				$ftext .= "<p>$orange&nbsp;{$admtext['folderdne']} $backuppath ($fullbackuppath)</p>";
			}
			else {
				if (!(dirReadWrite($myuserid,$mygroupid,$fullbackuppath))) {
					$ftext .= "<p>$orange&nbsp;{$admtext['rofolder']} $backuppath ($fullbackuppath)</p>";
				}
			}
			$fullgedpath = !empty($tngimpcfg['saveconfig']) ? $subroot . $gedpath : $rootpath . $gedpath;
			if (!(dirExists($fullgedpath))) {
				$ftext .= "<p>$orange&nbsp;{$admtext['folderdne']} $gedpath ($fullgedpath)</p>";
			}
			else {
				if (!(dirReadWrite($myuserid,$mygroupid,$fullgedpath))) {
					$ftext .= "<p>$orange&nbsp;{$admtext['rofolder']} $gedpath ($fullgedpath)</p>";
				}
			}
			if ($ftext == '')
				$ftext = "<p>$green&nbsp;" . $admtext['keyrw'] . "</p>";
			echo $ftext;

			if ($text == '') {
				echo "<p>$green&nbsp;" . $admtext['cfgrw'] . "</p>";
			}
			echo $text;
?>
	</td>
</tr>
<tr>
  <td colspan="2" class="tngshadow databack">
    <p><img src="img/tng_check.gif" width="18" height="18" align="left">&nbsp;= <?php echo $admtext['acceptable']; ?></p>
    <p><img src="img/orange.gif" width="18" height="18" align="left">&nbsp;= <?php echo $admtext['restricted']; ?></p>
    <p><img src="img/tng_close.gif" width="18" height="18" align="left">&nbsp;= <?php echo $admtext['needchngs']; ?></p>
    <br /><?php echo $admtext['yourbrowser'] . $_SERVER['HTTP_USER_AGENT']; ?></td>
</tr>
</table>
</div>
<?php
function fileReadWrite($myuserid,$mygroupid,$fileref)
{
	$rval = false;
	
	$userid = fileowner($fileref);
	$groupid = filegroup($fileref);
	$perms = readPerms(fileperms($fileref));

	if ($myuserid == $userid) {
		if (substr($perms,2,1) == 'w') {
			$rval = true;
		}
		elseif ($mygroupid == $groupid) {
			if (substr($perms,5,1) == 'w') {
				$rval = true;
			} elseif (substr($perms,8,1) == 'w') {
				$rval = true;
			}
		}
	} elseif ($mygroupid == $groupid) {
		if (substr($perms,5,1) == 'w') {
			$rval = true;
		}
	} elseif (substr($perms,8,1) == 'w') {
		$rval = true;
	}

	return $rval;
} // function fileReadWrite()

function dirExists($dirref)
{
	//global $cms;
	
	$rval = false;
	//$newdirref = $cms['support']} ? '../../../' . $dirref : '../'.$dirref;
	//$newdirref = $dirref;

	if(is_dir($dirref)) { $rval = true; }
	else { $rval = false; }
	return $rval;
}

function dirReadWrite($myuserid,$mygroupid,$dirref)
{
	global $cms;
	
	$rval = false;
	//$newdirref = $cms['support']} ? '../../../' . $dirref : '../'.$dirref;
	//$newdirref = $dirref;

	$userid = fileowner($dirref);
	$groupid = filegroup($dirref);
	$perms = readPerms(fileperms($dirref));

	if ($myuserid == $userid) {
		if (substr($perms,2,1) == 'w') {
			$rval = true;
		}
		elseif ($mygroupid == $groupid) {
			if (substr($perms,5,1) == 'w') {
				$rval = true;
			} elseif (substr($perms,8,1) == 'w') {
				$rval = true;
			}
		}
	} elseif ($mygroupid == $groupid) {
		if (substr($perms,5,1) == 'w') {
			$rval = true;
		}
	} elseif (substr($perms,8,1) == 'w') {
		$rval = true;
	}

	return $rval;
} // function dirReadWrite()

function readPerms($in_Perms)
{
	$sP;

	if ($in_Perms & 0x1000) { $sP = 'p'; }	// FIFO pipe
	elseif ($in_Perms & 0x2000) { $sP = 'c'; }	// Character special
	elseif ($in_Perms & 0x4000) { $sP = 'd'; }	// Directory
	elseif ($in_Perms & 0x6000) { $sP = 'b'; }	// Block special
	elseif ($in_Perms & 0x8000) { $sP = '-'; }	// Regular
	elseif ($in_Perms & 0xA000) { $sP = 'l'; }	// Symbolic Link
	elseif ($in_Perms & 0xC000) { $sP = 's'; }	// Socket
	else { $sP = 'u'; }				// UNKNOWN

	// owner
	$sP .= (($in_Perms & 0x0100) ? 'r' : '-').(($in_Perms & 0x0080) ? 'w' : '-').(($in_Perms & 0x0040) ? (($in_Perms & 0x0800) ? 's' : 'x' ) : (($in_Perms & 0x0800) ? 'S' : '-'));
	// group
	$sP .= (($in_Perms & 0x0020) ? 'r' : '-').(($in_Perms & 0x0010) ? 'w' : '-').(($in_Perms & 0x0008) ? (($in_Perms & 0x0400) ? 's' : 'x' ) : (($in_Perms & 0x0400) ? 'S' : '-'));
	// world
	$sP .= (($in_Perms & 0x0004) ? 'r' : '-').(($in_Perms & 0x0002) ? 'w' : '-').(($in_Perms & 0x0001) ? (($in_Perms & 0x0200) ? 't' : 'x' ) : (($in_Perms & 0x0200) ? 'T' : '-'));
	return $sP;
} // function readPerms()

echo tng_adminfooter();
?>