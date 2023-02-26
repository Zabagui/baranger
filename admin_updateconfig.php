<?php
include("begin.php");
include("processvars.php");
include("adminlib.php");
$textpart = "setup";
//include("getlang.php");
include("$mylanguage/admintext.php");

if(!count($_POST)) {
	header("Location: admin.php");
	exit;
}

if(!$safety) {
	header( "Location: admin_login.php" );
	exit;
}

if( $link ) {
	$admin_login = 1;
	include("checklogin.php");
	include("version.php");

	if( $assignedtree || !$allow_edit ) {
		$message = $admtext['norights'];
		header( "Location: admin_login.php?message=" . urlencode($message) );
		exit;
	}
}

$sitename = stripslashes($sitename);
$site_desc = stripslashes($site_desc);
$dbowner = stripslashes($dbowner);
$tng_footermsg = stripslashes($tng_footermsg);

$sitename = preg_replace("/\"/","\\\"",$sitename);
$site_desc = preg_replace("/\"/","\\\"",$site_desc);
$dbowner = htmlspecialchars(preg_replace("/\"/","\\\"",$dbowner),ENT_NOQUOTES);
$tng_footermsg = preg_replace("/\"/","\\\"",$tng_footermsg);
if(empty($altbirth)) $altbirth = "CHR,BAPM";

$doctype = addslashes($doctype);

if( !isset($autoapp) ) $autoapp = 0;
if( !isset($autotree) ) $autotree = 0;
if( !isset($ackemail) ) $ackemail = 0;
if( !isset($omitpwd) ) $omitpwd = 1;
if( !isset($maint) ) $maint = "";
if( !isset($saveconfig) ) $saveconfig = "";

require("adminlog.php");

$fp = @fopen( $subroot . "config.php", "w",1 );
if( !$fp ) { die ( $admtext['cannotopen'] . " config.php" ); }

flock( $fp, LOCK_EX );

if($new_database_username)
	$tng_notinstalled = "";

fwrite( $fp, "<?php\n" );
fwrite( $fp, "\$database_host = \"$new_database_host\";\n" );
fwrite( $fp, "\$database_name = \"$new_database_name\";\n" );
fwrite( $fp, "\$database_username = \"$new_database_username\";\n" );
fwrite( $fp, "\$database_password = '$new_database_password';\n" );
fwrite( $fp, "\$database_port = \"$new_database_port\";\n" );
fwrite( $fp, "\$database_socket = \"$new_database_socket\";\n" );
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

//These next 6 tables are obsolete in v6, but are kept here in case anyone is still using them
fwrite( $fp, "\$headstones_table = \"$headstones_table\";\n" );
fwrite( $fp, "\$hslinks_table = \"$hslinks_table\";\n" );
fwrite( $fp, "\$photos_table = \"$photos_table\";\n" );
fwrite( $fp, "\$photolinks_table = \"$photolinks_table\";\n" );
fwrite( $fp, "\$histories_table = \"$histories_table\";\n" );
fwrite( $fp, "\$doclinks_table = \"$doclinks_table\";\n" );

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
if($saved_rootpath != $newrootpath)
	$_SESSION['session_rp'] = $newrootpath;
fwrite( $fp, "\$rootpath = \"$newrootpath\";\n" );
fwrite( $fp, "\$templatenum = \"$templatenum\";\n" );
fwrite( $fp, "\$templateswitching = \"$templateswitching\";\n" );
fwrite( $fp, "\$homepage = \"$homepage\";\n" );
fwrite( $fp, "\$tngdomain = \"$tngdomain\";\n" );
fwrite( $fp, "\$sitename = \"$sitename\";\n" );
fwrite( $fp, "\$site_desc = \"$site_desc\";\n" );
fwrite( $fp, "\$tngconfig['doctype'] = \"$doctype\";\n" );
fwrite( $fp, "\$language = \"$language\";\n" );
fwrite( $fp, "\$charset = \"$charset\";\n" );
fwrite( $fp, "\$norels = \"$norels\";\n" );
fwrite( $fp, "\$maxsearchresults = \"$maxsearchresults\";\n" );
$lineending = addslashes($lineending);
fwrite( $fp, "\$lineendingdisplay = \"$lineending\";\n" );
fwrite( $fp, "\$lineending = \"" . stripslashes($lineending) . "\";\n" );
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
fwrite( $fp, "\$tngconfig['saveconfig'] = \"$saveconfig\";\n" );
fwrite( $fp, "\$showextended = \"$showextended\";\n" );
fwrite( $fp, "\$tngconfig['imgmaxh'] = \"$imgmaxh\";\n" );
fwrite( $fp, "\$tngconfig['imgmaxw'] = \"$imgmaxw\";\n" );
fwrite( $fp, "\$thumbprefix = \"$thumbprefix\";\n" );
fwrite( $fp, "\$thumbsuffix = \"$thumbsuffix\";\n" );
fwrite( $fp, "\$thumbmaxh = \"$thumbmaxh\";\n" );
fwrite( $fp, "\$thumbmaxw = \"$thumbmaxw\";\n" );
fwrite( $fp, "\$tngconfig['usedefthumbs'] = \"$tng_usedefthumbs\";\n" );
fwrite( $fp, "\$tngconfig['maxnoteprev'] = \"$tng_maxnoteprev\";\n" );
fwrite( $fp, "\$tngconfig['ssdisabled'] = \"$tng_ssdisabled\";\n" );
fwrite( $fp, "\$tngconfig['ssrepeat'] = \"$tng_ssrepeat\";\n" );
fwrite( $fp, "\$tngconfig['imgviewer'] = \"$tng_imgviewer\";\n" );
fwrite( $fp, "\$tngconfig['imgvheight'] = \"$tng_imgvheight\";\n" );
fwrite( $fp, "\$tngconfig['hidemedia'] = \"$hidemedia\";\n" );
fwrite( $fp, "\$tngconfig['favicon'] = \"$favicon\";\n" );
fwrite( $fp, "\$customheader = \"$customheader\";\n" );
fwrite( $fp, "\$customfooter = \"$customfooter\";\n" );
fwrite( $fp, "\$custommeta = \"$custommeta\";\n" );
fwrite( $fp, "\$tngconfig['menu'] = \"$tng_menu\";\n" );
fwrite( $fp, "\$tngconfig['istart'] = \"$tng_istart\";\n" );
fwrite( $fp, "\$tngconfig['showhome'] = \"$showhome\";\n" );
fwrite( $fp, "\$tngconfig['showsearch'] = \"$showsearch\";\n" );
fwrite( $fp, "\$tngconfig['searchchoice'] = \"$searchchoice\";\n" );
fwrite( $fp, "\$tngconfig['showlogin'] = \"$showlogin\";\n" );
fwrite( $fp, "\$tngconfig['showshare'] = \"$showshare\";\n" );
fwrite( $fp, "\$tngconfig['showprint'] = \"$showprint\";\n" );
fwrite( $fp, "\$tngconfig['showbmarks'] = \"$showbmarks\";\n" );
fwrite( $fp, "\$tngconfig['hidechr'] = \"$hidechr\";\n" );
fwrite( $fp, "\$tngconfig['altbirth'] = \"$altbirth\";\n" );
fwrite( $fp, "\$tngconfig['hidedna'] = \"$hidedna\";\n" );
fwrite( $fp, "\$tngconfig['password_type'] = \"$password_type\";\n" );
fwrite( $fp, "\$tngconfig['places1tree'] = \"$places1tree\";\n" );
fwrite( $fp, "\$tngconfig['autogeo'] = \"$autogeo\";\n" );

fwrite( $fp, "\$dbowner = \"$dbowner\";\n" );
fwrite( $fp, "\$time_offset = \"$time_offset\";\n" );
fwrite( $fp, "\$tngconfig['edit_timeout'] = \"$edit_timeout\";\n" );
fwrite( $fp, "\$requirelogin = \"$requirelogin\";\n" );
fwrite( $fp, "\$treerestrict = \"$treerestrict\";\n" );
fwrite( $fp, "\$livedefault = \"$livedefault\";\n" );
fwrite( $fp, "\$ldsdefault = \"$ldsdefault\";\n" );
fwrite( $fp, "\$chooselang = \"$chooselang\";\n" );
if(!$chooselang) {
	$session_language = $_SESSION['session_language'] = $language;
	$session_charset = $_SESSION['session_charset'] = $charset;
	setcookie("tnglangfolder", $language, time()+31536000, "/");
	setcookie("tngcharset", $charset, time()+31536000, "/");
}
fwrite( $fp, "\$nonames = \"$nonames\";\n" );
fwrite( $fp, "\$tngconfig['nnpriv'] = \"$nnpriv\";\n" );
fwrite( $fp, "\$notestogether = \"$notestogether\";\n" );
fwrite( $fp, "\$tngconfig['scrollcite'] = \"$scrollcite\";\n" );
fwrite( $fp, "\$nameorder = \"$nameorder\";\n" );
fwrite( $fp, "\$tngconfig['ucsurnames'] = \"$ucsurnames\";\n" );
fwrite( $fp, "\$lnprefixes = \"$lnprefixes\";\n" );
fwrite( $fp, "\$lnpfxnum = \"$lnpfxnum\";\n" );
fwrite( $fp, "\$specpfx = \"" . stripslashes( $specpfx ) . "\";\n" );

fwrite( $fp, "\$tngconfig['cemrows'] = \"$cemrows\";\n" );
fwrite( $fp, "\$tngconfig['cemblanks'] = \"$cemblanks\";\n" );

fwrite( $fp, "\$emailaddr = \"$emailaddr\";\n" );
fwrite( $fp, "\$tngconfig['fromadmin'] = \"$fromadmin\";\n" );
fwrite( $fp, "\$tngconfig['disallowreg'] = \"$disallowreg\";\n" );
fwrite( $fp, "\$tngconfig['revmail'] = \"$revmail\";\n" );
fwrite( $fp, "\$tngconfig['autoapp'] = \"$autoapp\";\n" );
fwrite( $fp, "\$tngconfig['autotree'] = \"$autotree\";\n" );
fwrite( $fp, "\$tngconfig['ackemail'] = \"$ackemail\";\n" );
fwrite( $fp, "\$tngconfig['omitpwd'] = \"$omitpwd\";\n" );
fwrite( $fp, "\$tngconfig['usesmtp'] = \"$usesmtp\";\n" );
fwrite( $fp, "\$tngconfig['mailhost'] = \"$mailhost\";\n" );
fwrite( $fp, "\$tngconfig['mailuser'] = \"$mailuser\";\n" );
fwrite( $fp, "\$tngconfig['mailpass'] = \"$mailpass\";\n" );
fwrite( $fp, "\$tngconfig['mailport'] = \"$mailport\";\n" );
fwrite( $fp, "\$tngconfig['mailenc'] = \"$mailenc\";\n" );

fwrite( $fp, "\$maxgedcom = \"$maxgedcom\";\n" );
fwrite( $fp, "\$change_cutoff = \"$change_cutoff\";\n" );
fwrite( $fp, "\$change_limit = \"$change_limit\";\n" );
fwrite( $fp, "\$tngconfig['preferEuro'] = \"$prefereuro\";\n" );
fwrite( $fp, "\$tngconfig['calstart'] = \"$calstart\";\n" );
fwrite( $fp, "\$tngconfig['pardata'] = \"$pardata\";\n" );
fwrite( $fp, "\$tngconfig['oldids'] = \"$oldids\";\n" );
fwrite( $fp, "\$tngconfig['lastimport'] = \"$lastimport\";\n" );
fwrite( $fp, "\$defaulttree = \"$defaulttree\";\n" );
fwrite( $fp, "\$tngconfig['sortbydate'] = \"$sortbydate\";\n" );
fwrite( $fp, "\$tngconfig['personprefix'] = \"$pprefix\";\n" );
fwrite( $fp, "\$tngconfig['personsuffix'] = \"$psuffix\";\n" );
fwrite( $fp, "\$tngconfig['familyprefix'] = \"$fprefix\";\n" );
fwrite( $fp, "\$tngconfig['familysuffix'] = \"$fsuffix\";\n" );
fwrite( $fp, "\$tngconfig['sourceprefix'] = \"$sprefix\";\n" );
fwrite( $fp, "\$tngconfig['sourcesuffix'] = \"$ssuffix\";\n" );
fwrite( $fp, "\$tngconfig['repoprefix'] = \"$rprefix\";\n" );
fwrite( $fp, "\$tngconfig['reposuffix'] = \"$rsuffix\";\n" );
fwrite( $fp, "\$tngconfig['noteprefix'] = \"$nprefix\";\n" );
fwrite( $fp, "\$tngconfig['notesuffix'] = \"$nsuffix\";\n" );
fwrite( $fp, "\$responsivetables = \"$responsivetables\";\n" );
fwrite( $fp, "\$tabletype = \"$tabletype\";\n" );
fwrite( $fp, "\$enablemodeswitch = \"$enablemodeswitch\";\n" );
fwrite( $fp, "\$enableminimap = \"$enableminimap\";\n" );
fwrite( $fp, "\$tngconfig['hidetasks'] = \"$hidetasks\";\n" );
fwrite( $fp, "\$tngconfig['hidetotals'] = \"$hidetotals\";\n" );
fwrite( $fp, "\$tngconfig['backupdays'] = \"$backupdays\";\n" );
fwrite( $fp, "\$tngconfig['offline'] = \"$tng_offline\";\n" );
//fwrite( $fp, "\$tngconfig['webmatches'] = \"$webmatches\";\n" );
//fwrite( $fp, "\$tngconfig['mhmatchtype'] = \"$mhmatchtype\";\n" );
//fwrite( $fp, "\$tngconfig['mhmatchconf'] = \"$mhmatchconf\";\n" );
fwrite( $fp, "\$tngconfig['cookieapproval'] = \"$tng_cookieapproval\";\n" );
fwrite( $fp, "\$tngconfig['dataprotect'] = \"$tng_dataprotect\";\n" );
fwrite( $fp, "\$tngconfig['askconsent'] = \"$tng_askconsent\";\n" );
fwrite( $fp, "\$tngconfig['livingunchecked'] = \"$tng_livingunchecked\";\n" );
fwrite( $fp, "\$tngconfig['nosuggest'] = \"$tng_nosuggest\";\n" );
fwrite( $fp, "\$tngconfig['allowcsv'] = \"$tng_allowcsv\";\n" );
fwrite( $fp, "\$tngconfig['sitekey'] = \"$rcsitekey\";\n" );
fwrite( $fp, "\$tngconfig['secret'] = \"$rcsecret\";\n" );
fwrite( $fp, "\$tngconfig['mediadel'] = \"$tng_mediadel\";\n" );
fwrite( $fp, "\$tngconfig['mediathumbs'] = \"$tng_mediathumbs\";\n" );
fwrite( $fp, "\$tngconfig['mediatrees'] = \"$tng_mediatrees\";\n" );
fwrite( $fp, "\$tngconfig['footermsg'] = \"$tng_footermsg\";\n" );

fwrite( $fp, "\$maxdnasearchresults = \"$maxdnasearchresults\";\n" );
fwrite( $fp, "\$showtestnumbers = \"$showtestnumbers\";\n" );
fwrite( $fp, "\$autofillancsurnames = \"$autofillancsurnames\";\n" );
fwrite( $fp, "\$numgens = \"$numgens\";\n" );
fwrite( $fp, "\$ancsurnameupper = \"$ancsurnameupper\";\n" );
fwrite( $fp, "\$surnameexcl = \"" . stripslashes( $surnameexcl ) . "\";\n" );
fwrite( $fp, "\$bgmain = \"" . stripslashes( $bgmain ) . "\";\n" );
fwrite( $fp, "\$txtmain = \"" . stripslashes( $txtmain ) . "\";\n" );
fwrite( $fp, "\$bgmode = \"" . stripslashes( $bgmode ) . "\";\n" );
fwrite( $fp, "\$txtmode = \"" . stripslashes( $txtmode ) . "\";\n" );
fwrite( $fp, "\$bgfastmut = \"" . stripslashes( $bgfastmut ) . "\";\n" );
fwrite( $fp, "\$txtfastmut = \"" . stripslashes( $txtfastmut ) . "\";\n" );
fwrite( $fp, "\$bg1_12 = \"" . stripslashes( $bg1_12 ) . "\";\n" );
fwrite( $fp, "\$txt1_12 = \"" . stripslashes( $txt1_12 ) . "\";\n" );
fwrite( $fp, "\$bg13_25 = \"" . stripslashes( $bg13_25 ) . "\";\n" );
fwrite( $fp, "\$txt13_25 = \"" . stripslashes( $txt13_25 ) . "\";\n" );
fwrite( $fp, "\$bg26_37 = \"" . stripslashes( $bg26_37 ) . "\";\n" );
fwrite( $fp, "\$txt26_37 = \"" . stripslashes( $txt26_37 ) . "\";\n" );
fwrite( $fp, "\$bg38_67 = \"" . stripslashes( $bg38_67 ) . "\";\n" );
fwrite( $fp, "\$txt38_67 = \"" . stripslashes( $txt38_67 ) . "\";\n" );
fwrite( $fp, "\$bg111 = \"" . stripslashes( $bg111 ) . "\";\n" );
fwrite( $fp, "\$txt111 = \"" . stripslashes( $txt111 ) . "\";\n" );

fwrite( $fp, "\$tng_notinstalled = \"$tng_notinstalled\";\n" );
fwrite( $fp, "\n" );
fwrite( $fp, "if(!isset(\$cms['auto'])) {\n" );
fwrite( $fp, "    \$cms['support'] = \"$cmssupport\";\n" );
fwrite( $fp, "    \$cms['url'] = \"$cmsurl\";\n" );
fwrite( $fp, "    if(!isset(\$cms['tngpath']))\n" );
fwrite( $fp, "        \$cms['tngpath'] = \"$cmstngpath\";\n" );
fwrite( $fp, "    \$cms['module'] = \"$cmsmodule\";\n" );
fwrite( $fp, "    \$cms['cloaklogin'] = \"$cmscloaklogin\";\n" );
fwrite( $fp, "    \$cms['credits'] = \"$cmscredits\";\n" );
if(empty($adminurl)) $adminurl = "";
fwrite( $fp, "    \$cms['adminurl'] = \"$adminurl\";\n" );
fwrite( $fp, "}\n" );
fwrite( $fp, "\n" );
fwrite( $fp, "@include(\$subroot . \"customconfig.php\");\n" );
fwrite( $fp, "?>" );

flock( $fp, LOCK_UN );
fclose( $fp );

$fp = @fopen( "subroot.php", "w",1 );
if( $fp ) {
	flock( $fp, LOCK_EX );
	fwrite( $fp, "<?php\n" );
	fwrite( $fp, "error_reporting(E_ERROR);\n" );
	fwrite( $fp, "\$tngconfig = array();\n" );
	fwrite( $fp, "\$tngconfig['subroot'] = \"$newsubroot\";\n" );
	fwrite( $fp, "\$subroot = \$tngconfig['subroot'] ? \$tngconfig['subroot'] : \"\";\n" );
	fwrite( $fp, "?>" );
	flock( $fp, LOCK_UN );
	fclose( $fp );
}
adminwritelog( $admtext['modifysettings'] );

$oldsubroot = $newsubroot != $subroot ? "?sr=$subroot" : "";
if( !empty($submitx) ) {
	header( "Location: admin_genconfig.php" );
}
else {
	header( "Location: admin_setup.php$oldsubroot" );
}
?>