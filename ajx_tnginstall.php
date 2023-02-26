<?php
$fromadmin = 0;
$maint = "";
$cms = array();
if(isset($cms['support']) || isset($cms['tngpath']) || isset($_GET['lang']) || isset($_GET['mylanguage']) || isset($_GET['language']) || isset($_GET['session_language']) || isset($_GET['rootpath'])) die("Sorry!");
$tngconfig = array();
include("processvars.php");
include("subroot.php");
include("tngconnect.php");
include($tngconfig['subroot'] . "config.php");
$subroot = $tngconfig['subroot'] ? $tngconfig['subroot'] : $cms['tngpath'];

if(session_status() !== PHP_SESSION_ACTIVE) session_start();
$session_language = isset($_SESSION['session_language']) ? $_SESSION['session_language'] : "";
$session_charset = isset($_SESSION['session_charset']) ? $_SESSION['session_charset'] : "";

$languages_path = "languages/";
include($cms['tngpath'] . "getlang.php");
$textpart = "install";
include($cms['tngpath'] . "$mylanguage/text.php");

include($cms['tngpath'] . "genlib.php");
include($subroot . "importconfig.php");
$saveconfig = 0;
$saveimportconfig = 0;
$class = "red";
if(!trim($database_port)) $database_port = null;
if(!trim($database_socket)) $database_socket = null;
if($database_username && $database_name)
	$link = tng_connect($database_host, $database_username, $database_password, $database_name, $database_port, $database_socket);
else
	$link = "";
if( $link && tng_select_db($link, $database_name)) {
	include($cms['tngpath'] . "checklogin.php");
	if( ($assignedtree && $assignedtree != "-x-guest-x-") || !$allow_edit ) {
	//echo "at=$assignedtree, ae=$allow_edit";
		$_POST['subroutine'] = "login";
	}
}

function createtables($collation, $table_prefix) {
	global $branches_table,$branchlinks_table,$address_table,$cemeteries_table,$children_table,$citations_table,$countries_table;
	global $events_table,$eventtypes_table,$families_table,$languages_table,$notelinks_table,$media_table,$medialinks_table;
	global $people_table,$places_table,$reports_table,$repositories_table,$saveimport_table,$sources_table,$states_table,$mostwanted_table; //, $mhrequests_table;
	global $temp_events_table,$tlevents_table,$trees_table,$users_table,$xnotes_table,$albums_table,$album2entities_table,$albumlinks_table,$assoc_table,$mediatypes_table;
	global $dna_tests_table, $dna_links_table, $dna_groups_table, $templates_table, $image_tags_table;
	global $cms, $link, $tngconfig;

	$badtables = "";

	include($cms['tngpath'] . "tabledefs.php");

	return $badtables;
}

switch( $_POST['subroutine'] ) {
	case 'perms':
		//set permissions
		$failed = "";
		$success = 0;
		
		$files = array("adminlog.txt",$subroot."config.php",$subroot."mmconfig.php","genlog.txt",$subroot."importconfig.php",$subroot."logconfig.php",$subroot."mapconfig.php",$subroot."pedconfig.php","subroot.php","whatsnew.txt");
		foreach( $files as $file ) {
			if( @chmod( $file, 0666 ) )
				$success++;
			else
				$failed .= $failed ? ", $file" : $file;
		}
		if($failed)
			$failed .= " (666 / rw-rw-rw-)";
		
		$folders = array("photos","histories","documents","headstones","media","gendex","backups","gedcom","mods","extensions","classes");
		$failed2 = "";
		foreach( $folders as $folder ) {
			if( @chmod( $folder, 0755 ) )
				$success++;
			else
				$failed2 .= $failed2 ? ", $folder" : $folder;
		}
		if($failed2)
			$failed2 .= " (755 / rwxr-xr-x)";

		$failed .= $failed2;

		if( $success == count($files) + count($folders) ) {
			$msg = $text['perms'];
			$class = "green";
		}
		else
			$msg = $text['noperms'] . " $failed. " . $text['manual'];

		break;

	case 'folder':
		//create folder
		$foldername = $_POST['foldername'];
		$oldname = $_POST['oldname'];
		$foldertype = $_POST['foldertype'];
		if( file_exists( $foldername ) || @rename( $oldname, $foldername ) ) {
			$msg = $text['folder'] . " $oldname " . $text['renamedto'] . " $foldername";
			$class = "green";
			if( $foldertype == "gedpath" )
				$saveimportconfig = 1;
			else
				$saveconfig = 1;
			$$foldertype = $foldername;
		}
		else
			$msg = $text['folder'] . " $oldname " . $text['norename'];
		break;

	case 'settings':
		//if(!$rootpath) {
		//	$rootpath = dirname(__FILE__) . "/";
		//	if (preg_match("/WIN/i",PHP_OS)) {
		//	    $rootpath = str_replace("\\","/",$rootpath);
		//	}
		//}
		if(!$tngdomain) {
			$server = $_SERVER['SERVER_NAME'];
			if(!$server) $server = $_SERVER['HTTP_HOST'];
			$protocol = 'https://';
			$tngdomain = str_replace("\\","/",$protocol . $server . dirname($_SERVER['REQUEST_URI']));
		}
		//verify settings
		$new_database_host = $_POST['database_host'];
		$new_database_name = $_POST['database_name'];
		$new_database_username = $_POST['database_username'];
		$new_database_password = $_POST['database_password'];
		$new_database_port = $_POST['database_port'];
		$new_database_socket = $_POST['database_socket'];
		if(!trim($new_database_port)) $new_database_port = null;
		if(!trim($new_database_socket)) $new_database_socket = null;
		$link = tng_connect($new_database_host, $new_database_username, $new_database_password, $new_database_name, $new_database_port, $new_database_socket);
		if( $link ) {
			if( tng_select_db($link, $new_database_name) ) {
				$msg = $text['infosaved'];
				$class = "green";
			}
			else {
				$query  = "CREATE DATABASE $new_database_name";
				$result = @tng_query($query);
				if( $result ) {
					if( tng_select_db($link, $new_database_name) ) {
						$msg = $text['newdb'] . " $new_database_name";
						$class = "green";
					}
					else
						$msg = $text['noattach'];
				}
				else
					$msg = $text['nodb'];
			}
		}
		else
			$msg = $text['noconn'] . " Host Name, Database Name, Database Username, Database Password (and possibly the port or socket, if those are required).";

		$database_host = $new_database_host;
		$database_name = $new_database_name;
		$database_username = $new_database_username;
		$database_password = $new_database_password;
		$database_port = $new_database_port;
		$database_socket = $new_database_socket;

		$saveconfig = 1;
		break;
		
	case 'tables':
		//try to create tables
		foreach( $_POST as $key => $value )
			$$key = $value;

		$database_port = !empty($database_port) ? trim($database_port) : null;
		$database_socket = !empty($database_socket) ? trim($database_socket) : null;
		$link = tng_connect($database_host, $database_username, $database_password, $database_name, $database_port, $database_socket);
		if( $link && tng_select_db($link, $database_name)) {
			$badtables = createtables($collation,$table_prefix ?? "");
			if( !$badtables ) {
				$msg = $text['tablescr'];
				$class = "green";
			}
			else
				$msg = $text['notables'] . " $badtables";
		}
		else
			$msg = $text['nocomm'];
		$tng_notinstalled = "";
		$saveconfig = 1;
		break;
		
	case 'user':
		$today = date( "Y-m-d H:i:s", time());
		$password = PasswordEncode($password);
		$password_type = PasswordType();
		$query = "INSERT IGNORE INTO $users_table (description,username,password,password_type,realname,phone,email,website,address,city,state,zip,country,notes,gedcom,personID,role,allow_edit,allow_add,tentative_edit,allow_delete,allow_lds,allow_living,allow_private,allow_private_notes,allow_ged,allow_pdf,allow_profile,branch,dt_activated,no_email) ";
		$query .= "VALUES (\"Administrator\",\"$username\",\"$password\",\"$password_type\",\"$realname\",\"\",\"$email\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"admin\",\"1\",\"1\",\"0\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"\",\"$today\",\"0\")";
		$result = @tng_query($query);

		if( $result ) {
			$msg = $text['user'] . " \"$username\" " . $text['created'];
			$class = "green";
			$_SESSION['currentuser'] = $username;
			$_SESSION['currentuserdesc'] = "Administrator";
			$_SESSION['assignedtree'] = "";
		}
		else
			$msg = $text['nouser'];
		$dbowner = $realname;
		$emailaddr = $email;
		$saveconfig = 1;
		break;
		
	case 'tree':
		//set up first tree
		$query = "INSERT IGNORE INTO $trees_table (gedcom,treename,description,owner,email,address,city,state,country,zip,phone,secret,disallowgedcreate) VALUES (\"$newtreeid\",\"$newtreename\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\",\"\")";
		$result = @tng_query($query);

		if( $result ) {
			$msg = $text['tree'] . " \"$newtreeid\" " . $text['created'];
			$_SESSION['availabletrees'] = $newtreeid;
			$class = "green";
		}
		else
			$msg = $text['notree'];
		break;

	case 'charset':
		//choose character set
		if( !$rootpath ) {
			$calc_rootpath = dirname(__FILE__) . "/";
			if (preg_match("/WIN/i",PHP_OS)) {
			    $calc_rootpath = str_replace("\\","/",$calc_rootpath);
			}
		}
		else
			$calc_rootpath = $rootpath;
		$newroot = preg_replace( "/\//", "", $calc_rootpath );
		$newroot = preg_replace( "/\s*/", "", $newroot );
		$newroot = preg_replace( "/\./", "", $newroot );
		setcookie("tnglang_$newroot", $newlanguage, time()+31536000, "/");
		setcookie("tngchar_$newroot", $newcharset, time()+31536000, "/");
		$session_language = $_SESSION['session_language'] = $newlanguage;
		$session_charset = $_SESSION['session_charset'] = $newcharset;

		$charset = $newcharset;
		$language = $newlanguage;
		$msg = $text['infosaved2'];
		$class = "green";
		$saveconfig = 1;
		break;

	case 'template':
		$flen = 0;
		if(function_exists('file_put_contents')) {
			$settings = @file_get_contents($subroot . "config.php");
			$pattern = '/templatenum = \"(\d*)\"/i';
			$replacement = "templatenum = \"$newtemplate\"";
			$templatesettings = preg_replace($pattern, $replacement, $settings);
			$flen = @file_put_contents($subroot . "config.php", $templatesettings);
			if($flen) {
				$class = "green";
				$msg = $text['infosaved2'] . " ($newtemplate)";
			}
		}
		if(!$flen)
			$msg = "Template selection failed. Please go to Admin/Setup/Template Settings and make your selection there";
		break;

	case 'login';
   		$msg = $text['loginfirst'];
		break;
		
	default:
		//set default message
		$msg = $text['noop'];
		break;
}

if( $saveconfig ) {
	//save config.php values;
	$fp = @fopen( $subroot . "config.php", "w",1 );
	if( !$fp ) { die ( $text['cannotopen'] . " config.php" ); }

	flock( $fp, LOCK_EX );

	fwrite( $fp, "<?php\n" );
	fwrite( $fp, "\$database_host = \"$database_host\";\n" );
	fwrite( $fp, "\$database_name = \"$database_name\";\n" );
	fwrite( $fp, "\$database_username = \"$database_username\";\n" );
	fwrite( $fp, "\$database_password = '$database_password';\n" );
	fwrite( $fp, "\$database_port = \"$database_port\";\n" );
	fwrite( $fp, "\$database_socket = \"$database_socket\";\n" );
	fwrite( $fp, "\$tngconfig['maint'] = \"$maint\";\n" );
	fwrite( $fp, "\n" );
	fwrite( $fp, "\$people_table = \"$people_table\";\n" );
	fwrite( $fp, "\$families_table = \"$families_table\";\n" );
	fwrite( $fp, "\$children_table = \"$children_table\";\n" );
	fwrite( $fp, "\$albums_table = \"$albums_table\";\n" );
	fwrite( $fp, "\$album2entities_table = \"$album2entities_table\";\n" );
	fwrite( $fp, "\$albumlinks_table = \"$albumlinks_table\";\n" );
	fwrite( $fp, "\$media_table = \"$media_table\";\n" );
	fwrite( $fp, "\$medialinks_table = \"$medialinks_table\";\n" );
	fwrite( $fp, "\$mediatypes_table = \"$mediatypes_table\";\n" );
	fwrite( $fp, "\$address_table = \"$address_table\";\n" );
	fwrite( $fp, "\$languages_table = \"$languages_table\";\n" );
	fwrite( $fp, "\$cemeteries_table = \"$cemeteries_table\";\n" );

	//These next 6 tables are obsolete in v6, but are kept here in in order to not throw errors.
	fwrite( $fp, "\$headstones_table = \"\";\n" );
	fwrite( $fp, "\$hslinks_table = \"\";\n" );
	fwrite( $fp, "\$photos_table = \"\";\n" );
	fwrite( $fp, "\$photolinks_table = \"\";\n" );
	fwrite( $fp, "\$histories_table = \"\";\n" );
	fwrite( $fp, "\$doclinks_table = \"\";\n" );

	fwrite( $fp, "\$states_table = \"$states_table\";\n" );
	fwrite( $fp, "\$countries_table = \"$countries_table\";\n" );
	fwrite( $fp, "\$places_table = \"$places_table\";\n" );
	fwrite( $fp, "\$sources_table = \"$sources_table\";\n" );
	fwrite( $fp, "\$image_tags_table = \"$image_tags_table\";\n" );
	fwrite( $fp, "\$repositories_table = \"$repositories_table\";\n" );
	fwrite( $fp, "\$citations_table = \"$citations_table\";\n" );
	fwrite( $fp, "\$events_table = \"$events_table\";\n" );
	fwrite( $fp, "\$eventtypes_table = \"$eventtypes_table\";\n" );
	fwrite( $fp, "\$reports_table = \"$reports_table\";\n" );
	fwrite( $fp, "\$trees_table = \"$trees_table\";\n" );
	fwrite( $fp, "\$notelinks_table = \"$notelinks_table\";\n" );
	fwrite( $fp, "\$xnotes_table = \"$xnotes_table\";\n" );
	fwrite( $fp, "\$saveimport_table = \"$saveimport_table\";\n" );
	fwrite( $fp, "\$users_table = \"$users_table\";\n" );
	fwrite( $fp, "\$temp_events_table = \"$temp_events_table\";\n" );
	fwrite( $fp, "\$tlevents_table = \"$tlevents_table\";\n" );
	fwrite( $fp, "\$branches_table = \"$branches_table\";\n" );
	fwrite( $fp, "\$branchlinks_table = \"$branchlinks_table\";\n" );
	fwrite( $fp, "\$assoc_table = \"$assoc_table\";\n" );
	fwrite( $fp, "\$mostwanted_table = \"$mostwanted_table\";\n" );
	//fwrite( $fp, "\$mhrequests_table = \"$mhrequests_table\";\n" );
	fwrite( $fp, "\$dna_tests_table = \"$dna_tests_table\";\n" );
	fwrite( $fp, "\$dna_links_table = \"$dna_links_table\";\n" );
	fwrite( $fp, "\$dna_groups_table = \"$dna_groups_table\";\n" );
	fwrite( $fp, "\$templates_table = \"$templates_table\";\n" );
	fwrite( $fp, "\n" );
	fwrite( $fp, "\$rootpath = \"$rootpath\";\n" );
	fwrite( $fp, "\$templatenum = \"$templatenum\";\n" );
	fwrite( $fp, "\$templateswitching = \"$templateswitching\";\n" );
	fwrite( $fp, "\$homepage = \"$homepage\";\n" );
	fwrite( $fp, "\$tngdomain = \"$tngdomain\";\n" );
	fwrite( $fp, "\$sitename = \"Our Family History\";\n" );
	fwrite( $fp, "\$site_desc = \"\";\n" );
	fwrite( $fp, "\$tngconfig['doctype'] = \"<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN'>\";\n" );
	fwrite( $fp, "\$language = \"$language\";\n" );
	fwrite( $fp, "\$charset = \"$charset\";\n" );
	fwrite( $fp, "\$norels = \"\";\n" );
	fwrite( $fp, "\$maxsearchresults = \"$maxsearchresults\";\n" );
	fwrite( $fp, "\$lineendingdisplay = \"\\\\r\\\\n\";\n" );
	fwrite( $fp, "\$lineending = \"\\r\\n\";\n" );
	fwrite( $fp, "\$mediapath = \"$mediapath\";\n" );
	fwrite( $fp, "\$headstonepath = \"$headstonepath\";\n" );
	fwrite( $fp, "\$historypath = \"$historypath\";\n" );
	fwrite( $fp, "\$documentpath = \"$documentpath\";\n" );
	fwrite( $fp, "\$photopath = \"$photopath\";\n" );
	fwrite( $fp, "\$photosext = \"$photosext\";\n" );
	fwrite( $fp, "\$modspath = \"$modspath\";\n" );
	fwrite( $fp, "\$extspath = \"$extspath\";\n" );
	fwrite( $fp, "\$gendexfile = \"$gendexfile\";\n" );
	fwrite( $fp, "\$backuppath = \"$backuppath\";\n" );
	fwrite( $fp, "\$tngconfig['saveconfig'] = \"\";\n" );
	fwrite( $fp, "\$showextended = \"$showextended\";\n" );
	fwrite( $fp, "\$tngconfig['imgmaxh'] = \"\";\n" );
	fwrite( $fp, "\$tngconfig['imgmaxw'] = \"\";\n" );
	fwrite( $fp, "\$thumbprefix = \"$thumbprefix\";\n" );
	fwrite( $fp, "\$thumbsuffix = \"$thumbsuffix\";\n" );
	fwrite( $fp, "\$thumbmaxh = \"$thumbmaxh\";\n" );
	fwrite( $fp, "\$thumbmaxw = \"$thumbmaxw\";\n" );
	fwrite( $fp, "\$tngconfig['usedefthumbs'] = \"1\";\n" );
	fwrite( $fp, "\$tngconfig['maxnoteprev'] = \"350\";\n" );
	fwrite( $fp, "\$tngconfig['ssdisabled'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['ssrepeat'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['imgviewer'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['imgvheight'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['hidemedia'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['favicon'] = \"{$tngconfig['favicon']}\";\n" );
	fwrite( $fp, "\$customheader = \"$customheader\";\n" );
	fwrite( $fp, "\$customfooter = \"$customfooter\";\n" );
	fwrite( $fp, "\$custommeta = \"$custommeta\";\n" );
	fwrite( $fp, "\$tngconfig['menu'] = \"{$tngconfig['menu']}\";\n" );
	fwrite( $fp, "\$tngconfig['istart'] = \"{$tngconfig['istart']}\";\n" );
	fwrite( $fp, "\$tngconfig['showhome'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['showsearch'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['searchchoice'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['showlogin'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['showshare'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['showprint'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['showbmarks'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['hidechr'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['altbirth'] = \"{$tngconfig['altbirth']}\";\n" );
	fwrite( $fp, "\$tngconfig['hidedna'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['password_type'] = \"sha256\";\n" );
	fwrite( $fp, "\$tngconfig['places1tree'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['autogeo'] = \"0\";\n" );
	fwrite( $fp, "\$dbowner = \"$dbowner\";\n" );
	fwrite( $fp, "\$time_offset = \"$time_offset\";\n" );
	fwrite( $fp, "\$tngconfig['edit_timeout'] = \"{$tngconfig['edit_timeout']}\";\n" );
	fwrite( $fp, "\$requirelogin = \"$requirelogin\";\n" );
	fwrite( $fp, "\$treerestrict = \"$treerestrict\";\n" );
	fwrite( $fp, "\$livedefault = \"$livedefault\";\n" );
	fwrite( $fp, "\$ldsdefault = \"$ldsdefault\";\n" );
	fwrite( $fp, "\$chooselang = \"$chooselang\";\n" );
	fwrite( $fp, "\$nonames = \"$nonames\";\n" );
	fwrite( $fp, "\$tngconfig['nnpriv'] = \"0\";\n" );
	fwrite( $fp, "\$notestogether = \"$notestogether\";\n" );
	fwrite( $fp, "\$tngconfig['scrollcite'] = \"1\";\n" );
	fwrite( $fp, "\$nameorder = \"$nameorder\";\n" );
	fwrite( $fp, "\$tngconfig['ucsurnames'] = \"0\";\n" );
	fwrite( $fp, "\$lnprefixes = \"$lnprefixes\";\n" );
	fwrite( $fp, "\$lnpfxnum = \"$lnpfxnum\";\n" );
	fwrite( $fp, "\$specpfx = \"$specpfx\";\n" );
	fwrite( $fp, "\$tngconfig['cemrows'] = \"{$tngconfig['cemrows']}\";\n" );
	fwrite( $fp, "\$tngconfig['cemblanks'] = \"0\";\n" );

	fwrite( $fp, "\$emailaddr = \"$emailaddr\";\n" );
	fwrite( $fp, "\$tngconfig['fromadmin'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['disallowreg'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['revmail'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['autoapp'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['autotree'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['ackemail'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['omitpwd'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['usesmtp'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['mailhost'] = \"\";\n" );
	fwrite( $fp, "\$tngconfig['mailuser'] = \"\";\n" );
	fwrite( $fp, "\$tngconfig['mailpass'] = \"\";\n" );
	fwrite( $fp, "\$tngconfig['mailport'] = \"\";\n" );
	fwrite( $fp, "\$tngconfig['mailenc'] = \"\";\n" );
	
	fwrite( $fp, "\$maxgedcom = \"$maxgedcom\";\n" );
	fwrite( $fp, "\$change_cutoff = \"$change_cutoff\";\n" );
	fwrite( $fp, "\$change_limit = \"$change_limit\";\n" );
	fwrite( $fp, "\$tngconfig['preferEuro'] = \"false\";\n" );
	fwrite( $fp, "\$tngconfig['calstart'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['pardata'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['oldids'] = \"\";\n" );
	fwrite( $fp, "\$tngconfig['lastimport'] = \"\";\n" );
	fwrite( $fp, "\$defaulttree = \"$defaulttree\";\n" );
	fwrite( $fp, "\$tngconfig['sortbydate'] = \"{$tngconfig['sortbydate']}\";\n" );
	fwrite( $fp, "\$tngconfig['personprefix'] = \"{$tngconfig['personprefix']}\";\n" );
	fwrite( $fp, "\$tngconfig['personsuffix'] = \"{$tngconfig['personsuffix']}\";\n" );
	fwrite( $fp, "\$tngconfig['familyprefix'] = \"{$tngconfig['familyprefix']}\";\n" );
	fwrite( $fp, "\$tngconfig['familysuffix'] = \"{$tngconfig['familysuffix']}\";\n" );
	fwrite( $fp, "\$tngconfig['sourceprefix'] = \"{$tngconfig['sourceprefix']}\";\n" );
	fwrite( $fp, "\$tngconfig['sourcesuffix'] = \"{$tngconfig['sourcesuffix']}\";\n" );
	fwrite( $fp, "\$tngconfig['repoprefix'] = \"{$tngconfig['repoprefix']}\";\n" );
	fwrite( $fp, "\$tngconfig['reposuffix'] = \"{$tngconfig['reposuffix']}\";\n" );
	fwrite( $fp, "\$tngconfig['noteprefix'] = \"{$tngconfig['noteprefix']}\";\n" );
	fwrite( $fp, "\$tngconfig['notesuffix'] = \"{$tngconfig['notesuffix']}\";\n" );
	fwrite( $fp, "\$responsivetables = \"$responsivetables\";\n" );
	fwrite( $fp, "\$tabletype = \"$tabletype\";\n" );
	fwrite( $fp, "\$enablemodeswitch = \"$enablemodeswitch\";\n" );
	fwrite( $fp, "\$enableminimap = \"$enableminimap\";\n" );
	fwrite( $fp, "\$tngconfig['hidetasks'] = \"{$tngconfig['hidetasks']}\";\n" );
	fwrite( $fp, "\$tngconfig['hidetotals'] = \"{$tngconfig['hidetotals']}\";\n" );
	fwrite( $fp, "\$tngconfig['backupdays'] = \"{$tngconfig['backupdays']}\";\n" );
	fwrite( $fp, "\$tngconfig['offline'] = \"\";\n" );
	//fwrite( $fp, "\$tngconfig['webmatches'] = \"{$tngconfig['webmatches']}\";\n" );
	//fwrite( $fp, "\$tngconfig['mhmatchtype'] = \"{$tngconfig['mhmatchtype']}\";\n" );
	//fwrite( $fp, "\$tngconfig['mhmatchconf'] = \"{$tngconfig['mhmatchconf']}\";\n" );
	fwrite( $fp, "\$tngconfig['cookieapproval'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['dataprotect'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['askconsent'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['livingunchecked'] = \"{$tngconfig['livingunchecked']}\";\n" );
	fwrite( $fp, "\$tngconfig['nosuggest'] = \"{$tngconfig['nosuggest']}\";\n" );
	fwrite( $fp, "\$tngconfig['allowcsv'] = \"{$tngconfig['allowcsv']}\";\n" );
	fwrite( $fp, "\$tngconfig['sitekey'] = \"{$tngconfig['sitekey']}\";\n" );
	fwrite( $fp, "\$tngconfig['secret'] = \"{$tngconfig['secret']}\";\n" );
	fwrite( $fp, "\$tngconfig['mediadel'] = \"{$tngconfig['mediadel']}\";\n" );
	fwrite( $fp, "\$tngconfig['mediathumbs'] = \"{$tngconfig['mediathumbs']}\";\n" );
	fwrite( $fp, "\$tngconfig['mediatrees'] = \"0\";\n" );
	fwrite( $fp, "\$tngconfig['footermsg'] = \"\";\n" );

	fwrite( $fp, "\$maxdnasearchresults = \"50\";\n" );
	fwrite( $fp, "\$showtestnumbers = \"0\";\n" );
	fwrite( $fp, "\$autofillancsurnames = \"0\";\n" );
	fwrite( $fp, "\$numgens = \"3\";\n" );
	fwrite( $fp, "\$ancsurnameupper = \"0\";\n" );
	fwrite( $fp, "\$surnameexcl = \"\";\n" );
	fwrite( $fp, "\$bgmain = \"\";\n" );
	fwrite( $fp, "\$txtmain = \"#FFFFFF\";\n" );
	fwrite( $fp, "\$bgmode = \"#D1EEEE\";\n" );
	fwrite( $fp, "\$txtmode = \"#000000\";\n" );
	fwrite( $fp, "\$bgfastmut = \"#69001A\";\n" );
	fwrite( $fp, "\$txtfastmut = \"#FFFFFF\";\n" );
	fwrite( $fp, "\$bg1_12 = \"#414E68\";\n" );
	fwrite( $fp, "\$txt1_12 = \"#FFFFFF\";\n" );
	fwrite( $fp, "\$bg13_25 = \"#41678A\";\n" );
	fwrite( $fp, "\$txt13_25 = \"#FFFFFF\";\n" );
	fwrite( $fp, "\$bg26_37 = \"#2E8899\";\n" );
	fwrite( $fp, "\$txt26_37 = \"#FFFFFF\";\n" );
	fwrite( $fp, "\$bg38_67 = \"#44A1B8\";\n" );
	fwrite( $fp, "\$txt38_67 = \"#FFFFFF\";\n" );
	fwrite( $fp, "\$bg111 = \"#05B8CC\";\n" );
	fwrite( $fp, "\$txt111 = \"#FFFFFF\";\n" );
	fwrite( $fp, "\$tng_notinstalled = \"$tng_notinstalled\";\n" );
	fwrite( $fp, "\n" );
	fwrite( $fp, "if(!isset(\$cms['auto'])) {\n" );
	fwrite( $fp, "    \$cms['support'] = \"{$cms['support']}\";\n" );
	fwrite( $fp, "    \$cms['url'] = \"{$cms['url']}\";\n" );
	fwrite( $fp, "    if(!isset(\$cms['tngpath']))\n" );
	fwrite( $fp, "        \$cms['tngpath'] = \"{$cms['tngpath']}\";\n" );
	fwrite( $fp, "    \$cms['module'] = \"{$cms['module']}\";\n" );
	fwrite( $fp, "    \$cms['cloaklogin'] = \"{$cms['cloaklogin']}\";\n" );
	fwrite( $fp, "    \$cms['credits'] = \"{$cms['credits']}\";\n" );
	fwrite( $fp, "    \$cms['adminurl'] = \"\";\n" );
	fwrite( $fp, "}\n" );
	fwrite( $fp, "\n" );
	fwrite( $fp, "@include(\$subroot . \"customconfig.php\");\n" );
	fwrite( $fp, "?>" );

	flock( $fp, LOCK_UN );
	fclose( $fp );
}

if( $saveimportconfig ) {
	if ( !isset($localphotopathdisplay) ) $localphotopathdisplay = "";
	if ( !isset($localhistorypathdisplay) ) $localhistorypathdisplay = "";
	if ( !isset($localdocumentpathdisplay) ) $localdocumentpathdisplay = "";
	if ( !isset($localotherpathdisplay) ) $localotherpathdisplay = "";

	$fp = @fopen( $subroot . "importconfig.php", "w",1 );
	if( !$fp ) { die ( $text['cannotopen'] . " importconfig.php" ); }

	flock( $fp, LOCK_EX );

	fwrite( $fp, "<?php\n" );
	fwrite( $fp, "\$gedpath = \"$gedpath\";\n" );
	fwrite( $fp, "\$tngimpcfg['saveconfig'] = \"\";\n" );
	fwrite( $fp, "\$saveimport = \"$saveimport\";\n" );
	fwrite( $fp, "\$tngimpcfg['rrnum'] = \"{$tngimpcfg['rrnum']}\";\n" );
	fwrite( $fp, "\$tngimpcfg['readmsecs'] = \"{$tngimpcfg['readmsecs']}\";\n" );
	fwrite( $fp, "\$assignnames = \"$assignnames\";\n" );
	fwrite( $fp, "\$tngimpcfg['defimpopt'] = \"{$tngimpcfg['defimpopt']}\";\n" );
	fwrite( $fp, "\$tngimpcfg['chdate'] = \"{$tngimpcfg['chdate']}\";\n" );
	fwrite( $fp, "\$tngimpcfg['livingreqbirth'] = \"{$tngimpcfg['livingreqbirth']}\";\n" );
	fwrite( $fp, "\$tngimpcfg['maxlivingage'] = \"{$tngimpcfg['maxlivingage']}\";\n" );
	fwrite( $fp, "\$tngimpcfg['maxprivyrs'] = \"{$tngimpcfg['maxprivyrs']}\";\n" );
	fwrite( $fp, "\$tngimpcfg['maxdecdyrs'] = \"{$tngimpcfg['maxdecdyrs']}\";\n" );
	fwrite( $fp, "\$tngimpcfg['maxmarriedage'] = \"{$tngimpcfg['maxmarriedage']}\";\n" );
	fwrite( $fp, "\$locimppath['photos'] = \"$localphotopathdisplay\";\n" );
	fwrite( $fp, "\$locimppath['histories'] = \"$localhistorypathdisplay\";\n" );
	fwrite( $fp, "\$locimppath['documents'] = \"$localdocumentpathdisplay\";\n" );
	fwrite( $fp, "\$locimppath['headstones'] = \"{$locimppath['headstones']}\";\n" );
	fwrite( $fp, "\$locimppath['other'] = \"$localotherpathdisplay\";\n" );
	fwrite( $fp, "\$wholepath = \"$wholepath\";\n" );
	fwrite( $fp, "\$tngimpcfg['privnote'] = \"{$tngimpcfg['privnote']}\";\n" );
	fwrite( $fp, "\$tngimpcfg['coerce'] = \"{$tngimpcfg['coerce']}\";\n" );
	fwrite( $fp, "?>" );

	flock( $fp, LOCK_UN );
	fclose( $fp );
}

header('Content-Type: application/xml');
echo "<?xml version=\"1.0\"";
if($session_charset)
	echo " encoding=\"$session_charset\"";
echo "?>\n";
echo "<install>\n";
echo "<installElement>\n";
echo "<divName>" . $_POST['targetdiv'] . "</divName>\n";
echo "<colorClass>$class</colorClass>\n";
echo "</installElement>\n";
echo "<message>\n";
echo "<messageText>$msg</messageText>\n";
echo "</message>\n";
echo "</install>\n";
?>