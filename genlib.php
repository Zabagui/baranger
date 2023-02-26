<?php
if(isset($_GET['cms']) || isset($_POST['cms'])) die("Sorry!");
include_once($cms['tngpath'] . "pwdlib.php");
include_once($cms['tngpath'] . "globallib.php");
@include_once($cms['tngpath'] . "mediatypes.php");
@include_once($cms['tngpath'] . "tngfiletypes.php");
include_once($cms['tngpath'] . "version.php");
checkMaintenanceMode(0);
if(!empty($needMap)) {
    include($subroot . "mapconfig.php");
	$mapkeystr = $map['key'] && $map['key'] != "1" ? "&amp;key=" . $map['key'] . "&amp;callback=initMap" : "";
    if($map['key'])
        include_once($cms['tngpath'] . "googlemaplib.php");
}
$flags = array();
@include($cms['tngpath'] . "tngrobots.php");

$isConnected = isConnected();

$htmldocs = array("HTML","PHP","HTM");
$http_user_agent = strtolower($_SERVER["HTTP_USER_AGENT"]);
$newbrowser = preg_match("/msie/", $http_user_agent) && preg_match("/mac/", $http_user_agent) ? 0 : 1;
$gotlastpage = false;
$flags['error'] = $error;

if(empty($tree)) $tree = "";
if($requirelogin && $treerestrict && !empty($_SESSION['assignedtree'])) {
	if(!$tree)
		$tree = $_SESSION['assignedtree'];
	elseif($tree != $_SESSION['assignedtree']) {
		header("Location:$homepage");
		exit;
	}
}
$orgtree = $tree;
if( !$tree && $defaulttree ) {
	$tree = $defaulttree;
}
elseif( $tree == "-x--all--x-" )
	$tree = "";


function tng_header( $title, $flags ) {
	global $custommeta, $customheader, $cms, $session_charset, $tngprint, $sitename, $site_desc, $tngconfig, $tngdomain, $responsivetables;
	global $text, $map, $browser, $templatepath, $tng_title, $tng_version, $tng_date, $tng_copyright, $sitever, $templatenum, $tmp, $http, $isConnected;
	global $fbOGimage, $pageURL;

	initMediaTypes();

	//echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\">\n\n";
	//echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n\n";
	header("Content-type:text/html;charset=" . $session_charset);
	echo !empty($tngconfig['doctype']) ? $tngconfig['doctype'] . "\n\n" : "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\">\n\n";
	if( !$cms['support'] )
		echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n";
	else
		echo $cms['credits'];
	//$siteprefix = $sitename ? ($title ? ": " . stripslashes($sitename) : stripslashes($sitename)) : "";
	//$title = preg_replace("/\"/", "",$title);
	$siteprefix = $sitename ? @htmlspecialchars($title ? ": " . $sitename : $sitename, ENT_QUOTES, $session_charset) : "";
	$title = @htmlspecialchars($title, ENT_QUOTES, $session_charset);
	echo "<title>$title$siteprefix</title>\n";
	echo "<meta name=\"Keywords\" content=\"$site_desc\" />\n";
	//echo "<meta name=\"Description\" content=\"" . preg_replace("/\"/", "", $title . $siteprefix) . "\" />\n";
	echo "<meta name=\"Description\" content=\"" . $title . $siteprefix . "\" />\n";

	if($fbOGimage) {
	    echo "<meta property=\"og:title\" content=\"" . $sitename . "\"/>\n";
	    echo "<meta property=\"og:description\" content=\"" . $title . "\"/>\n";
	    echo "<meta property=\"og:url\" content=\"" . $tngdomain . "/" . $pageURL . "\" />\n";
	    echo "<meta property=\"og:type\" content=\"website\"/>\n";
	    echo $fbOGimage."\n";
	}

	if( $session_charset )
		echo "<meta http-equiv=\"Content-type\" content=\"text/html; charset=$session_charset\" />\n";
	if( isset( $flags['norobots'] ) )
		echo $flags['norobots'];
	if( isset( $flags['autorefresh'] ) && $flags['autorefresh'] == 1 )
		echo "<meta http-equiv=\"refresh\" content=\"30\" />\n";
	if($sitever == "mobile" || $sitever == "tablet") {
		echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />\n";
		echo "<meta name=\"apple-mobile-web-app-capable\" content=\"yes\" />\n";
		echo "<meta name=\"mobile-web-app-capable\" content=\"yes\" />\n";
		echo "<meta http-equiv=\"cleartype\" content=\"on\" />\n";

		// Update to add icons for Android and iOS 8+.
		echo "<link rel=\"apple-touch-icon\" sizes=\"57x57\" href=\"{$cms['tngpath']}img/public/apple-icon-57x57.png\" />\n";
		echo "<link rel=\"apple-touch-icon\" sizes=\"60x60\" href=\"{$cms['tngpath']}img/public/apple-icon-60x60.png\" />\n";
		echo "<link rel=\"apple-touch-icon\" sizes=\"72x72\" href=\"{$cms['tngpath']}img/public/apple-icon-72x72.png\" />\n";
		echo "<link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"{$cms['tngpath']}img/public/apple-icon-76x76.png\" />\n";
		echo "<link rel=\"apple-touch-icon\" sizes=\"114x114\" href=\"{$cms['tngpath']}img/public/apple-icon-114x114.png\" />\n";
		echo "<link rel=\"apple-touch-icon\" sizes=\"120x120\" href=\"{$cms['tngpath']}img/public/apple-icon-120x120.png\" />\n";
		echo "<link rel=\"apple-touch-icon\" sizes=\"144x144\" href=\"{$cms['tngpath']}img/public/apple-icon-144x144.png\" />\n";
		echo "<link rel=\"apple-touch-icon\" sizes=\"152x152\" href=\"{$cms['tngpath']}img/public/apple-icon-152x152.png\" />\n";
		echo "<link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"{$cms['tngpath']}img/public/apple-icon-180x180.png\" />\n";
		echo "<link rel=\"icon\" type=\"image/png\" sizes=\"192x192\" href=\"{$cms['tngpath']}img/public/android-icon-192x192.png\" />\n";
		echo "<link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"{$cms['tngpath']}img/public/favicon-32x32.png\" />\n";
		echo "<link rel=\"icon\" type=\"image/png\" sizes=\"96x96\" href=\"{$cms['tngpath']}img/public/favicon-96x96.png\" />\n";
		echo "<link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"{$cms['tngpath']}img/public/favicon-16x16.png\" />\n";
		echo "<link rel=\"manifest\" href=\"img/public/manifest.json\" />\n";
		// Update to add icons for Android and iOS 8 and later.
		echo "<link rel=\"apple-touch-icon-precomposed\" sizes=\"144x144\" href=\"{$cms['tngpath']}img/tng-apple-icon-144.png\" />\n";
		echo "<link rel=\"apple-touch-icon-precomposed\" sizes=\"114x114\" href=\"{$cms['tngpath']}img/tng-apple-icon-114.png\" />\n";
		echo "<link rel=\"apple-touch-icon-precomposed\" sizes=\"72x72\" href=\"{$cms['tngpath']}img/tng-apple-icon-72.png\" />\n";
		echo "<link rel=\"apple-touch-icon-precomposed\" href=\"{$cms['tngpath']}img/tng-apple-icon.png\" />\n";
		echo "<link rel=\"shortcut icon\" href=\"{$cms['tngpath']}img/tng-apple-icon.png\" />\n";
	}
	elseif($tngconfig['favicon']) {
		echo "<link rel=\"shortcut icon\" href=\"{$cms['tngpath']}img/public/{$tngconfig['favicon']}\" />\n";
		// Update to add icons for Windows 8+ and Safari in MacOS El Capitan+.
		echo "<link rel=\"mask-icon\" href=\"{$cms['tngpath']}img/public/safari-pinned-tab.svg\" color=\"#5bbad5\" />\n";
		echo "<meta name=\"msapplication-config\" content=\"{$cms['tngpath']}img/public/browserconfig.xml\" />\n";
		echo "<meta name=\"msapplication-TileColor\" content=\"#ffffff\" />\n";
		echo "<meta name=\"msapplication-TileImage\" content=\"{$cms['tngpath']}img/public/ms-icon-144x144.png\" />\n";
		echo "<meta name=\"theme-color\" content=\"#ffffff\" />\n";
		// Update to add icons for Windows 8+ and Safari in MacOS El Capitan+.
	}

	if(!$tng_version) include_once("version.php");
	if($sitever != "standard" && $responsivetables) 
		echo "<link href=\"{$cms['tngpath']}css/tablesaw.bare.css\" rel=\"stylesheet\" type=\"text/css\" />\n";
	echo "<link href=\"{$cms['tngpath']}css/genstyle.css?v=$tng_version\" rel=\"stylesheet\" type=\"text/css\" />\n";
	if( isset( $flags['css'] ) )
		echo $flags['css'];
	echo "<link href=\"{$cms['tngpath']}{$templatepath}css/tngtabs2.css\" rel=\"stylesheet\" type=\"text/css\" />\n";
	echo "<link href=\"{$cms['tngpath']}{$templatepath}css/templatestyle.css?v=$tng_version\" rel=\"stylesheet\" type=\"text/css\" />\n";
	if($sitever == "mobile") {
		echo "<link href=\"{$cms['tngpath']}css/tngmobile.css?v=$tng_version\" rel=\"stylesheet\" type=\"text/css\" />\n";
		echo "<link href=\"{$cms['tngpath']}{$templatepath}css/tngmobile.css?v=$tng_version\" rel=\"stylesheet\" type=\"text/css\" />\n";
	}
	
	if($isConnected) {
		echo "<script src=\"https://code.jquery.com/jquery-3.4.1.min.js\" type=\"text/javascript\" integrity=\"sha384-vk5WoKIaW/vJyUAd9n/wmopsmNhiy+L2Z+SBxGYnUkunIxVxAv/UtMOhba/xskxh\" crossorigin=\"anonymous\"></script>\n";
		echo "<script src=\"https://code.jquery.com/ui/1.12.1/jquery-ui.min.js\" type=\"text/javascript\" integrity=\"sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=\" crossorigin=\"anonymous\"></script>\n";
	}
	else {
		echo "<script type=\"text/javascript\">// <![CDATA[\nwindow.jQuery || document.write(\"<script src='{$cms['tngpath']}js/jquery-3.4.1.min.js?v=910'>\\x3C/script>\")\n//]]></script>\n";
		echo "<script type=\"text/javascript\">// <![CDATA[\nwindow.jQuery.ui || document.write(\"<script src='{$cms['tngpath']}js/jquery-ui-1.12.1.min.js?v=910'>\\x3C/script>\")\n//]]></script>\n";
	}
	echo "<script type=\"text/javascript\" src=\"{$cms['tngpath']}js/net.js\"></script>\n";

 	if( isset( $flags['scripting'] ) )
		echo $flags['scripting'];
	echo "<link href=\"{$cms['tngpath']}{$templatepath}css/mytngstyle.css?v=$tng_version\" rel=\"stylesheet\" type=\"text/css\" />\n";

	if(!empty($tngconfig['showshare']) && $isConnected && $sitever != "mobile") {
		$w = $http == "https" ? "ws" : "w";
		echo "<script type=\"text/javascript\" src=\"{$http}://{$w}.sharethis.com/button/buttons.js\"></script>\n";
		echo "<script type=\"text/javascript\">stLight.options({publisher: \"be4e16ed-3cf4-460b-aaa4-6ac3d0e3004b\",doNotHash:true,doNotCopy:true,hashAddressBar:false});</script>\n";
	}

	//echo "<script type=\"text/javascript\" src=\"{$http}://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e568cff0f533c7f\"></script>\n";
	if( $tngconfig['menu'] < 2 && !$tngprint && $sitever != "mobile" ) {
		echo "<script type=\"text/javascript\" src=\"{$cms['tngpath']}js/tngmenuhover2.js\"></script>\n";
	}

	if ($sitever != "standard" && $responsivetables) {
		echo "<script type=\"text/javascript\" src=\"{$cms['tngpath']}js/tablesaw.js\"></script>\n";
		echo "<!--[if lt IE 9]>";
		echo "<script type=\"text/javascript\" src=\"{$cms['tngpath']}js/respond.js\"></script>\n";
		echo "<![endif]-->";
	}

	echo "<script type=\"text/javascript\">\n// <![CDATA[\nvar tnglitbox;\nvar share = 0;\nvar closeimg = \"{$cms['tngpath']}img/tng_close.gif\";\n";
	echo "var smallimage_url = '" . getURL("ajx_smallimage",1) . "';\nvar cmstngpath='{$cms['tngpath']}';\nvar loadingmsg = '{$text['loading']}';\n";
	echo "var expand_msg = \"{$text['expand']}\";\nvar collapse_msg = \"{$text['collapse']}\";\n";
	if(isset($flags['error']) && $flags['error']) {
		$login_url = getURL( "ajx_login", 1 );
		echo "jQuery(document).ready(function(){openLogin('{$login_url}p=" . urlencode($cms['tngpath']) . "&message={$flags['error']}');});\n";
	}
	echo "//]]>\n</script>\n";
	//echo "<style type=\"text/css\">.media-prev {background: transparent url({$cms['tngpath']}img/media-prevbg.png) no-repeat 0 0;}\n.person-prev {background: transparent url({$cms['tngpath']}img/person-prevbg.png) no-repeat 0 0;}</style>\n";
	echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"RSS\" href=\"{$cms['tngpath']}tngrss.php\" />\n";

	@include( $custommeta );
	if( $tngprint )
		echo "<link href=\"{$cms['tngpath']}css/tngprint.css\" rel=\"stylesheet\" type=\"text/css\" />\n";
	echo "<!-- $tng_title, v.$tng_version ($tng_date), Written by Darrin Lythgoe, $tng_copyright -->\n";

	$icons = "";
	if($sitever == "mobile") {
		if(!isset($flags['nomobile']) || !$flags['nomobile']) {
			$icons = tng_mobileicons($title);
			$icons .= "<div id=\"mcontent\">\n";
		}
		echo "<style>\n{$tngconfig['mmenustyle']}</style>\n";
	}

	if( !$cms['support'] ) {
		echo "</head>\n";
		if( $sitever != "mobile" && !$tngprint && (!isset($flags['noheader']) || !$flags['noheader']) )
			include( $templatepath . $customheader );
		elseif(!isset($flags['nobody']) || !$flags['nobody'] || $sitever == "mobile") {
			$class = !empty($flags['homeclass']) ? $flags['homeclass'] : "publicbody";
			echo "<body class=\"{$class}\">\n";
			echo "<div class=\"scroll-to-top\"><a href=\"#\"><img src=\"{$cms['tngpath']}img/backtotop.png\" alt=\"\" /></a></div>\n";
		}
	}
	if( $sitever != "mobile" && (!isset($flags['noicons']) || !$flags['noicons']) )
		$icons = tng_icons( $title );
	echo $icons;  //from above

	if(!$cms['support'] && $sitever == "mobile" && !$tngprint && (!isset($flags['noheader']) || !$flags['noheader'])) {
		$ttitle = "t{$templatenum}_maintitle";
		if(isset($tmp[$ttitle]))
			$mtitle = str_replace(array("<br />","<br>")," ", getTemplateMessage($ttitle));
		else {
			$ttitle = "t{$templatenum}_headtitle";
			$i = 1;
			$mtitle = "";
			while(isset($tmp[$ttitle . $i])) {
				$mtitle .= getTemplateMessage($ttitle . $i) . " ";
				$i++;
			}
		}
		if($mtitle)
			echo "<h3 class=\"mmaintitle\">" . $mtitle . "</h3><hr class=\"mtitlehr\"/><br/>\n";
	}
	
	if(!empty($tngconfig['cookieapproval']) && strpos($_SERVER['REQUEST_URI'],"/data_protection_policy.php") === FALSE)
		include($cms['tngpath'] . "cookie_approval.php");

	if($tngconfig['maint'])
		echo "<span class=\"fieldnameback yellow\" style=\"padding:3px\"><strong>{$text['mainton']}</strong></span><br /><br />\n";
}

function tng_footer( $flags ) {
	global $customfooter, $cms, $tngprint, $map, $text, $dbowner, $tngdomain, $sitename, $templatepath, $sitever, $tng_version, $tngconfig;

	$needtherest = true;
	if( $tngprint ) {
		$printfooter = $sitename;
		if($dbowner) {
			if($printfooter) $printfooter .= " - ";
			$suggest_url = getURL( "suggest", 1 );
			if($tngconfig['dataprotect'] && strpos($_SERVER['REQUEST_URI'],"/data_protection_policy.php") === FALSE) {
				$dataprotect_url = getURL( "data_protection_policy", 0 );
				$data_protection_link = " | <a href=\"{$dataprotect_url}\" class=\"footer\" title=\"{$text['dataprotect']}\" target=\"_blank\">{$text['dataprotect']}</a>.\n";
			}
			else
				$data_protection_link = "";
	    	$printfooter .= $text['maintby'] . " <a href=\"$suggest_url\" class=\"footer\" title=\"{$text['contactus']}\">$dbowner</a>.{$data_protection_link}";
		}
		echo "<p class=\"smaller\">" . $printfooter . "<br/>\n$tngdomain</p>";
	}
	else {
		if($sitever == "mobile") {
			echo tng_basicfooter($flags);
			if(!isset($flags['nomobile']) || !$flags['nomobile'])
 				echo "</div>\n";
		}
		else {
			if(isset($flags['basicfooter']) && $flags['basicfooter']) {
				echo tng_basicfooter($flags);
				$needtherest = false;
			}
			else {
				include( $templatepath . $customfooter );
			}
		}
	}
	if($needtherest) {
		if( isset( $flags['more'] ) )
			echo $flags['more'];
		if(!$tngprint)
			echo "<script type=\"text/javascript\" src=\"{$cms['tngpath']}js/litbox.js\"></script>\n";
		if(!empty($map['key']) && !empty($map['pins']))
			tng_map_pins();

		if(!isset($flags['noend']) || !$flags['noend']) include($cms['tngpath'] . "end.php" );
	}
}

function tng_basicfooter($flags) {
	global $text, $cms, $tng_version, $sitever, $http, $tngconfig, $tree, $personID, $flags, $templatepath;

	$footer = "";
	$newsitever = getSiteVersion();
	//echo "ver=$sitever, nsv=$newsitever";
	if($sitever == "mobile" || $newsitever != "standard") {
		$thispage = getScriptName(false);
		$thispage = preg_replace('/\??\&?sitever=(mobile|standard|tablet)/',"",$thispage);
		$con = strpos($thispage, "?") == false ? "?" : "&amp;";

		if($sitever == "mobile") {
			$gotover = $newsitever == "mobile" ? "standard" : $newsitever;
			$message = $text['switchs'];
			if(file_exists($cms['tngpath'] . $templatepath . "mobile_footer.php"))
				include($cms['tngpath'] . $templatepath . "mobile_footer.php");
		}
		else {
			$gotover = "mobile";
			$message = $text['switchm'];
		}
		$footer .= "<p class=\"smaller center\">\n";
		$footer .= "<a href=\"$thispage{$con}sitever=$gotover\" class=\"fieldnameback lightlink2 rounded4\">&nbsp;{$message}&nbsp;</a>\n";
		$footer .= "</p><br/>\n";
	}
	include($cms['tngpath'] . "stdsitecredit.php");
	$footer .= $sitecredit;

	if(isset($flags['imgprev'])) {
?>
		<script type="text/javascript">
		//<![CDATA[
		jQuery(document).ready(function() {
			jQuery('.media-preview img').on('mouseover touchstart',function(e) {
				e.preventDefault();
				var items = this.parentElement.id.match(/img-(\d+)-(\d+)-(.*)/);
				var key = items[2] && items[2] != "0" ? items[1]+"_"+items[2] : items[1];
				if(jQuery('#prev'+key).css('display') == "none")
					showPreview(items[1],items[2],items[3],key,'<?php echo $sitever; ?>');
				else
					closePreview(key);
			});
			jQuery('.media-preview img').on('mouseout',function(e) {
				var items = this.parentElement.id.match(/img-(\d+)-(\d+)-(.*)/);
				var key = items[2] && items[2] != "0" ? items[1]+"_"+items[2] : items[1];
				closePreview(key);
			});
			jQuery(document).on('click touchstart', '.prev-close img', function(e) {
				var items;
				items = this.id.match(/close-(\d+)_(\d+)/);
				if(!items)
					items = this.id.match(/close-(\d+)/);
				var key = items[2] && items[2] != "0" ? items[1]+"_"+items[2] : items[1];
				closePreview(key);
			});
		});
		//]]>
		</script>
<?php
	}

	return $footer;
}

function getSmallPhoto( $medialink ) {
	global $rootpath, $photopath, $documentpath, $headstonepath, $historypath, $mediapath, $mediatypes_assoc, $thumbmaxw, $thumbmaxh;
	global $cms, $mediatypes_thumbs, $sitever, $tnggallery, $tngconfig;

	if(!$thumbmaxh) $thumbmaxh = 100;		// defaults to 100px if not specified
	if(!$thumbmaxw) $thumbmaxw = 80;		// defaults to 80px if not specified

	$mediatypeID = $medialink['mediatypeID'];
	$usefolder = $medialink['usecollfolder'] ? $mediatypes_assoc[$mediatypeID] : $mediapath;
	//determine $usefolder based on mediatypeID and usecollfolder

	$treestr = !empty($tngconfig['mediatrees']) && $medialink['gedcom'] ? $medialink['gedcom'] . "/" : "";
	if((($medialink['allow_living'] && $medialink['allow_private']) || $medialink['alwayson']) && $medialink['thumbpath'] && file_exists("$rootpath$usefolder/$treestr" . $medialink['thumbpath'])) {
		$thumb = $cms['tngpath'] . "$usefolder/$treestr" . str_replace("%2F","/",rawurlencode( $medialink['thumbpath'] ));
		$photoinfo = @GetImageSize( "$rootpath$usefolder/$treestr" . $medialink['thumbpath'] );

		if( $photoinfo[0] <= $thumbmaxw && $photoinfo[1] <= $thumbmaxh ) {
			$photohtouse = $photoinfo[1];
			$photowtouse = $photoinfo[0];
		}
		else {
			if( $photoinfo[0] > $photoinfo[1] ) {
				$photowtouse = $thumbmaxw;
				$photohtouse = intval( $thumbmaxw * $photoinfo[1] / $photoinfo[0] ) ;
			}
			else {
				$photohtouse = $thumbmaxh;
				$photowtouse = intval( $thumbmaxh * $photoinfo[0] / $photoinfo[1] ) ;
			}
		}
		//$dimensions = " width=\"$photowtouse\" height=\"$photohtouse\"";
		$dimensions = " height=\"$photohtouse\"";
		$class = " class=\"thumb\"";
	}
	else {
		$thumb = $cms['tngpath'] . "img/$treestr" . $mediatypes_thumbs[$mediatypeID];
		$dimensions = $class = "";
	}
	if(!isset($medialink['description'])) $medialink['description'] = '';
	$altmsg = $medialink['allow_living'] ? str_replace("\"","'",$medialink['description']) : "";
	$imgsrc = "<img src=\"$thumb\" $dimensions alt=\"$altmsg\" title=\"$altmsg\"$class />";

	return $imgsrc;
}

function tng_DrawHeading($photostr, $namestr, $years) {
	global $tngconfig;
	if( $photostr )
		$outputstr = "<div style=\"float:left; padding-right:5px\">$photostr</div><h1 class=\"header fn\" id=\"nameheader\" style=\"margin-bottom:5px\">$namestr</h1><span class=\"normal\">$years</span>\n";
	else {
		$outputstr = "<h1 class=\"header fn\" id=\"nameheader\" style=\"margin-bottom:5px\">$namestr</h1>";
		if($years)
			$outputstr .= "<span class=\"normal\">$years</span><br />\n";
	}
	$outputstr .= "<br clear=\"all\" /><br />\n";

	return $outputstr;
}

function getSurnameOnly( $row ) {
	global $text, $admtext, $tngconfig;

	$nonames = showNames($row);
	if( $row['allow_living'] || $nonames != 1 ) {
		$namestr = trim( $row['lnprefix'] . " " . $row['lastname'] );
		if($tngconfig['ucsurnames']) $namestr = tng_strtoupper($namestr);
	}
	elseif( $row['private'] )
		$namestr = $admtext['text_private'];
	else
		$namestr = $text['living'];

	return $namestr;
}

function getFirstNameOnly( $row ) {
	global $text, $admtext;

	$nonames = showNames($row);
	if( ($row['allow_living'] && $row['allow_private']) || !$nonames )
		$namestr = strtok( $row['firstname'], " " );
	elseif( $nonames == 2 )
		$namestr = initials( $row['firstname'] );
	elseif( $row['private'] )
		$namestr = $admtext['text_private'];
	else
		$namestr = $text['living'];

	return $namestr;
}

function tng_menu( $enttype, $currpage, $entityID, $innermenu ) {
	global $tree, $text, $disallowgedcreate, $target, $allow_admin, $allow_edit, $currentuser;
	global $rightbranch, $cms, $allow_ged, $emailaddr, $newbrowser, $tngprint, $flags, $sitever, $tngconfig;

	$nexttab = 0;
	if( !$tngprint ) {
		$menu = "<div id=\"tngmenu\">\n";
		$menu .= $newbrowser ? "<ul id=\"tngnav\">\n" : "<div id=\"tabs\">\n";
		$choices = $editstr = "";
		if( $enttype == "I" ) {
			$getperson_url = getURL( "getperson", 1 );
			$pedigree_url = getURL( "pedigree", 1 );
			$descend_url = getURL( "descend", 1 );
			$gedform_url = getURL( "gedform", 1 );
			$relateform_url = getURL( "relateform", 1 );
			$timeline_url = getURL( "timeline", 1 );
			$familychart_url = getURL( "familychart", 1 );

			$choices .= doMenuItem( $nexttab++, $getperson_url . "personID=$entityID&amp;tree=$tree" , "ind", $text['indinfo'], $currpage, "person" );
			$choices .= doMenuItem( $nexttab++, $pedigree_url . "personID=$entityID&amp;tree=$tree" , "ped", $text['ancestors'], $currpage, "pedigree" );
			$choices .= doMenuItem( $nexttab++, $descend_url . "personID=$entityID&amp;tree=$tree" , "desc", $text['descendants'], $currpage, "descend" );
			$choices .= doMenuItem( $nexttab++, $relateform_url . "primaryID=$entityID&amp;tree=$tree" , "rel", $text['relationship'], $currpage, "relate" );
			$choices .= doMenuItem( $nexttab++, $timeline_url . "primaryID=$entityID&amp;tree=$tree" , "time", $text['timeline'], $currpage, "timeline" );
			$choices .= doMenuItem( $nexttab++, $familychart_url . "personID=$entityID&amp;tree=$tree" , "fam", $text['family'], $currpage, "familychart" );
			if( !$disallowgedcreate || ($allow_ged && $rightbranch) )
				$choices .= doMenuItem( $nexttab++, "$gedform_url" . "personID=$entityID&amp;tree=$tree" , "ged", $text['extractgedcom'], $currpage, "gedcom" );
			$editstr = "admin_editperson.php?person";
		}
		elseif( $enttype == "F" ) {
			$familygroup_url = getURL( "familygroup", 1 );
			$familychart_url = getURL( "familychart", 1 );

			$choices .= doMenuItem( $nexttab++, "$familychart_url" . "familyID=$entityID&amp;tree=$tree" , "fam", $text['familychart'], $currpage, "familychart" );
			$choices .= doMenuItem( $nexttab++, "$familygroup_url" . "familyID=$entityID&amp;tree=$tree" , "rel", $text['groupsheet'], $currpage, "family" );
			$editstr = "admin_editfamily.php?family";
		}
		elseif( $enttype == "S" ) {
			$showsource_url = getURL( "showsource", 1 );

			$choices .= doMenuItem( $nexttab++, "$showsource_url" . "sourceID=$entityID&amp;tree=$tree" , "ged", $text['source'], $currpage, "source" );
			$editstr = "admin_editsource.php?source";
		}
		elseif( $enttype == "R" ) {
			$showrepo_url = getURL( "showrepo", 1 );

			$choices .= doMenuItem( $nexttab++, "$showrepo_url" . "repoID=$entityID&amp;tree=$tree" , "ged", $text['repository'], $currpage, "repo" );
			$editstr = "admin_editrepo.php?repo";
		}
		elseif( substr($enttype, 0, 1) == "D" ) {
			switch ($enttype) {
				case "DCAT":
					$compare_url = getURL( "compare_selected_atdna", 1 );
					break;
				case "DCMT":
					$compare_url = getURL( "compare_selected_mtdna", 1 );
					break;
				case "DCY":
					$compare_url = getURL( "compare_selected_ydna", 1 );
					break;
				default:
					$show_url = getURL( "show_dna_test", 1 ) . "testID=" . $entityID;
					$editstr = "admin_edit_dna_test.php?test";
					break;
			}
			if ( empty($_SESSION["ttree"]) ) $_SESSION["ttree"] = "-x--all--x-";
			if ( empty($_SESSION["ttype"]) ) $_SESSION["ttype"] = "";
			if ( empty($_SESSION["tgroup"]) ) $_SESSION["tgroup"] = "";
			if ( empty($_SESSION["tsearch"]) ) $_SESSION["tsearch"] = "";
			$browse_dna_tests_url = getURL( "browse_dna_tests", 1 );
			$browse_all_dna_tests_url = $browse_dna_tests_url . "tree=-x--all--x-&amp;test_type=&amp;test_group=&amp;testsearch=";
			$browse_dna_tests_url = $browse_dna_tests_url . "tree=" . $_SESSION["ttree"] . "&amp;test_type=" . $_SESSION["ttype"] . "&amp;test_group=" . $_SESSION["tgroup"] . "&amp;testsearch=" . $_SESSION["tsearch"];

			$choices .= doMenuItem( $nexttab++, $browse_all_dna_tests_url, "ged", $text['all_dna_tests'], $currpage, "alldna" );
			if( $enttype != "D" || $browse_all_dna_tests_url != $browse_dna_tests_url )
				$choices .= doMenuItem( $nexttab++, $browse_dna_tests_url, "print", $text['dna_tests'], $currpage, "dnatests" );
			$choices .= doMenuItem( $nexttab++, $enttype == "D" ? $show_url : $compare_url, "dna", $enttype == "D" ? $text['dna_test'] : $text['compareselected'], $currpage, $enttype == "D" ? "dna" : "compare" );
		}
		elseif( $enttype == "L" ) {
			$placesearch_url = getURL( "placesearch", 1 );

			$treestr = $tngconfig['places1tree'] ? "" : "&amp;tree=$tree";
			$choices .= doMenuItem( $nexttab++, "$placesearch_url" . "psearch=$entityID$treestr" , "place", $text['place'], $currpage, "place" );
			$editstr = "admin_editplace.php?";
			$entityID = urlencode($entityID);
		}
		if( $allow_edit && $rightbranch && $editstr ) {
			$choices .= doMenuItem( $nexttab, $cms['tngpath'] . "$editstr" . "ID=$entityID&amp;tree=$tree&amp;cw=1\" target=\"blank", "sugg", $text['edit'], $currpage, "" );
		}
		elseif( !$tngconfig['nosuggest'] && $emailaddr && $editstr ) {
			$suggest_url = getURL( "suggest", 1 );
			$choices .= doMenuItem( $nexttab, "$suggest_url" . "enttype=$enttype&amp;ID=$entityID&amp;tree=$tree", "sugg", $text['suggest'], $currpage, "suggest" );
		}
		if($sitever == "mobile") {
			$menu .= "<li>\n<a class=\"here\">\n<select id=\"tngtabselect\" onchange=\"window.location.href=this.options[this.selectedIndex].value\">\n$choices</select>\n</a>\n</li>\n";
		}
		else
			$menu .= $choices;
		$menu .= $newbrowser ? "</ul>\n" : "</div>\n";
		$menu .= "</div>\n";
		$menu .= "<div id=\"pub-innermenu\" class=\"fieldnameback fieldname smaller rounded4\">\n";
		$menu .= $innermenu;
		$menu .= "</div><br/>\n";
	}
	else $menu = "";

	return $menu;
}

//DEPRECATED
function tng_coreicons( ) {
	return "";
}

function tng_smallIcon($options) {
	global $sitever;
	$target = "";
	
	$url = isset($options['url']) ? $options['url'] : "#";
	$onclick = isset($options['onclick']) ? "onclick=\"{$options['onclick']}\"" : "";
	$targetloc = $target ? "target=\"$target\"" : "";
	$class = $sitever == "mobile" ? "mobileicon" : (isset($options['class']) ? $options['class'] : "tngsmallicon");
	$rel = isset($options['rel']) ? "rel=\"{$options['rel']}\"" : "";
	
	if($sitever == "mobile") {
		$begin = "<li>";
		$end = "</li>\n";
	}
	else {
		$begin = " ";
		$end = "\n";
	}
	
	$link = "$begin<a href=\"$url\" $onclick $targetloc $rel title=\"{$options['label']}\" class=\"$class\" id=\"{$options['id']}-smicon\">{$options['label']}</a>$end";
		
	return $link;
}
 
function tng_getLeftIcons() {
	global $tngconfig, $text, $homepage, $currentuser, $allow_profile, $cms, $target, $sitever;
	
    if(!isset($tngconfig['menucount']))
        $tngconfig['menucount'] = 0;

	$left_icons = "";
	if( empty($tngconfig['showhome']) ) {
		$left_icons .= tng_smallIcon(array('url'=>getURL( $homepage, 0, ""), 'label'=>$text['homepage'], 'id'=>"home"));
		$tngconfig['menucount']++;
	}
   	if( empty($tngconfig['showsearch']) ) {
		$params = array('url'=>getURL( "searchform", 0 ), 'label'=>$text['search'], 'id'=>"search");
		if(empty($tngconfig['searchchoice']) && $sitever != "mobile")
			$params['onclick'] = "return openSearch();";
		$left_icons .= tng_smallIcon($params);
		$tngconfig['menucount']++;
	}

	$profilelink = $userparen = "";
	if($currentuser) {
		if($allow_profile && $sitever != "mobile") {
	      	$editprofile_url = getURL( "ajx_editprofile", 1 );
			$profilelink = tng_smallIcon(array('label'=>($sitever == "mobile" ? $text['editprofile'] : "({$text['editprofile']}: $currentuser)"),
				'class'=>"tngsmallicon3", 'id'=>"profile", 
				'onclick'=>"tnglitbox = new LITBox('{$editprofile_url}p=" . urlencode($cms['tngpath']) . "',{width:520,height:560}); return false"));
			$tngconfig['menucount']++;
		}
		else 
			$userparen = " ($currentuser)";
	}
	if( empty($tngconfig['showlogin']) ) {
		if( $currentuser ) {
			if( !$cms['cloaklogin'] || $cms['cloaklogin'] == "both" )
				$left_icons .= tng_smallIcon(array('url'=>getURL( "logout", 1 ) . "session=" . session_name(), 'label'=>$text['logout'] . $userparen, 'id'=>"log"));
		}
		else {
			if( !$cms['cloaklogin'] || $cms['cloaklogin'] == "both" ) {
				$login_url = getURL( "ajx_login", 1 );
				$left_icons .= tng_smallIcon(array('label'=>$text['login'], 'id'=>"log", 'onclick'=>"return openLogin('{$login_url}p=" . urlencode($cms['tngpath']) . "');"));
			}
		}
		$tngconfig['menucount']++;
	}
	$left_icons .= $profilelink;

	return $left_icons;
}

function tng_getRightIcons($showlangselect) {
	global $text, $tngconfig, $cms, $gotlastpage, $sitever, $isConnected;

	$addbookmark_url = getURL( "ajx_addbookmark", 1 );

	$right_icons = "";
	if( !empty($tngconfig['showshare']) && $isConnected && $sitever != "mobile")
		$right_icons .= tng_smallIcon(array('label'=>$text['share'], 'id'=>"share", 'onclick'=>"jQuery('#shareicons').toggle(200); if(!share) { jQuery('#share-smicon').html('{$text['hide']}'); share=1;} else { jQuery('#share-smicon').html('{$text['share']}'); share=0; }; return false;"));

	if( empty($tngconfig['showprint']) && $sitever != "mobile") {
		$print_url = getScriptName();
	 	if(preg_match("/\?/",$print_url))
			$print_url .= "&amp;tngprint=1";
		else
			$print_url .= "?tngprint=1";
		$right_icons .= tng_smallIcon(array('label'=>$text['tngprint'], 'id'=>"print", 'rel'=>"nofollow", 'onclick'=>"newwindow=window.open('$print_url','tngprint','width=850,height=600,status=no,resizable=yes,scrollbars=yes'); newwindow.focus(); return false;"));
	}

	if( empty($tngconfig['showbmarks']) && $gotlastpage ) {
		$right_icons .= tng_smallIcon(array('label'=>$text['bookmark'], 'id'=>"bmk", 'onclick'=>"tnglitbox = new LITBox('{$addbookmark_url}p=" . urlencode($cms['tngpath']) . "',{width:350,height:100}); return false;"));
		$tngconfig['menucount']++;
	}

	if($showlangselect)
		$right_icons .= tng_getLanguageSelect(1);

	return $right_icons;
}

function tng_getFindMenu() {
	global $tngconfig, $time_offset;

	$menu = array();
	$menu[] = tngddrow(getURL( "surnames", 0 ), "surnames-icon", "", "surnames");
	$menu[] = tngddrow(getURL( "firstnames", 0 ), "firstnames-icon", "", "firstnames");
	$menu[] = tngddrow(getURL( "searchform", 0 ), "search-icon", "", "searchnames");
	$menu[] = tngddrow(getURL( "famsearchform", 0 ), "fsearch-icon", "", "searchfams");
	$menu[] = tngddrow(getURL( "searchsite", 0 ), "searchsite-icon", "", "searchsitemenu");
	$menu[] = tngddrow(getURL( "places", 0 ), "places-icon", "", "places");
	$menu[] = tngddrow(getURL( "anniversaries", 0 ), "dates-icon", "", "dates");
	$tngmonth = date("m", time() + ( 3600 * intval($time_offset) ) );
	$menu[] = tngddrow(getURL( "calendar", 1 ) . "m=$tngmonth", "calendar-icon", "", "calendar");
	$menu[] = tngddrow(getURL( "cemeteries", 0 ), "cemeteries-icon", "", "cemeteries");
	$menu[] = tngddrow(getURL( "bookmarks", 0 ), "bookmarks-icon", "", "bookmarks");

	$tngconfig['menucount'] += 10;

	global $findmenulinks;
	if( isset( $findmenulinks ) ) {
		$menu = array_merge($menu,custom_links( $findmenulinks ));
	}

	return $menu;
}

function tng_getMediaMenu() {
	global $mediatypes, $tngconfig;
	
	$menu = array();
	foreach( $mediatypes as $mediatype ) {
		if(!$mediatype['disabled']) {
			$menu[] = tngddrow(getURL( "browsemedia", 1 ) . "mediatypeID=" . $mediatype['ID'], $mediatype['ID'] . "-icon", $mediatype['icon'], $mediatype['display'], true);
			$tngconfig['menucount']++;
		}
	}
	if(!empty($_SESSION['albumcount']))
		$menu[] = tngddrow(getURL( "browsealbums", 0 ), "albums-icon", "", "albums");
	$menu[] = tngddrow(getURL( "browsemedia", 0 ), "media-icon", "", "allmedia");
	$tngconfig['menucount'] += 2;

	global $mediamenulinks;
	if( isset( $mediamenulinks ) ) {
		$menu = array_merge($menu,custom_links( $mediamenulinks ));
	}

	return $menu;
}

function tng_getInfoMenu($title) {
	global $allow_admin, $cms, $tngconfig;
	
	$menu = array();
	$menu[] = tngddrow(getURL( "whatsnew", 0 ), "whatsnew-icon", "", "whatsnew");
	$menu[] = tngddrow(getURL( "mostwanted", 0 ), "mw-icon", "", "mostwanted");
	$menu[] = tngddrow(getURL( "reports", 0 ), "reports-icon", "", "reports");
	$menu[] = tngddrow(getURL( "statistics", 0 ), "stats-icon", "", "databasestatistics");
	$menu[] = tngddrow(getURL( "browsetrees", 0 ), "trees-icon", "", "trees");
	$menu[] = tngddrow(getURL( "browsebranches", 0 ), "branches-icon", "", "branches");
	$menu[] = tngddrow(getURL( "browsenotes", 0 ), "notes-icon", "", "notes");
	$menu[] = tngddrow(getURL( "browsesources", 0 ), "sources-icon", "", "sources");
	$menu[] = tngddrow(getURL( "browserepos", 0 ), "repos-icon", "", "repositories");
	if(empty($tngconfig['hidedna'])) {
		$menu[] = tngddrow(getURL( "browse_dna_tests", 0 ), "dna-icon", "", "dna_tests");
		$tngconfig['menucount']++;
	}
	if( $allow_admin ) {
		$menu[] = tngddrow((!empty($cms['adminurl']) ? $cms['adminurl'] : $cms['tngpath']."admin.php"), "admin-icon", "", "administration");
		$menu[] = tngddrow(getURL( "showlog", 0 ), "unlock-icon", "", "mnushowlog");
		$tngconfig['menucount'] += 2;
	}
	$menu[] = tngddrow(getURL( "suggest", 1 ) . "page=" . urlencode(str_replace("?", "", $title)), "contact-icon", "", "contactus");
	$tngconfig['menucount'] += 10;  //everything except the 2 admin links

	global $infomenulinks;
	if( isset( $infomenulinks ) ) {
		$menu = array_merge($menu,custom_links( $infomenulinks ));
	}

	return $menu;
}

function tng_getLanguageSelect($instance) {
	global $chooselang, $languages_table, $mylanguage, $languages_path;

	$menu = "";
	if( $chooselang ) {
		$query = "SELECT languageID, display, folder FROM $languages_table ORDER BY display";
		$result = tng_query($query);
		$numlangs = tng_num_rows( $result );

		if( $numlangs > 1 ) {
			$menu .= getFORM( "savelanguage2", "get", "tngmenu$instance", "" );
			$menu .= "<select name=\"newlanguage$instance\" id=\"newlanguage$instance\" style=\"font-size:9pt;\" onchange=\"document.tngmenu$instance.submit();\">";

			while( $row = tng_fetch_assoc($result)) {
				$menu .= "<option value=\"{$row['languageID']}\"";
				if( $languages_path . $row['folder'] == $mylanguage )
					$menu .= " selected=\"selected\"";
				$menu .= ">{$row['display']}</option>\n";
			}
			$menu .= "</select>\n";
			$menu .= "<input type=\"hidden\" name=\"instance\" value=\"$instance\" /></form>\n";
		}

		tng_free_result($result);
	}

	return $menu;
}

function tng_getLangMenu($title) {
	global $chooselang, $languages_table, $mylanguage, $languages_path, $text, $tngconfig;

	$menuitems = array();
	$menustr = "";
	if( $chooselang ) {
		$query = "SELECT languageID, display, folder FROM $languages_table ORDER BY display";
		$result = tng_query($query);
		$numlangs = tng_num_rows( $result );

		if( $numlangs > 1 ) {
			while( $row = tng_fetch_assoc($result)) {
				$prefix = $languages_path . $row['folder'] == $mylanguage ? "*" : "";
				$menuitems[] = tngddrow(getURL( "savelanguage2", 1 ) . "newlanguage=" . $row['languageID'], "", "", $prefix . $row['display'], true);
				$tngconfig['menucount']++;
			}
			if(!empty($menuitems)) {
				if(count($menuitems) % 2)
					$menuitems[] = tngddrow("", "", "", "", true);
				if(count($menuitems) > 10) {
					$cols = " style=\"columns:2; -webkit-columns:2; -webkit-column-gap:0px;\"";
					$multicolclass = " mmulticol";
					$left_bottom = count($menuitems)/2 - 1;
					$menuitems[$left_bottom] = str_replace("mobileicon", "mobileicon mmulticollastleft", $menuitems[$left_bottom]);
				}
				else
					$cols = $multicolclass = "";
				$menucontent = implode("",$menuitems);
				$menustr = "<ul id=\"mlangmenu\" class=\"mright{$multicolclass}\"$cols>\n" . $menucontent . "</ul>\n";
			}
		}

		tng_free_result($result);
	}

	return $menustr;
}

function get_menustyle($key,$itemcount) {
	$mmenustyle = "";
	if($itemcount) {
		$moffset = 50 * $itemcount;
		$mmenustyle .= "ul#m" . $key . "menu {-webkit-transform: translate3d(0,-" . $moffset . "px,0);}\n";
		$mmenustyle .= "ul#m" . $key . "menu {transform: translate3d(0,-" . $moffset . "px,0);}\n";
	}
	return $mmenustyle;
}

function tng_mobileicons($title) {
	global $text, $tngconfig, $custommenu, $custmenu, $custommobilemenu, $custommenulinks;
	
	//container, full width, fixed at top
	//get left & right icons, put in single list
	//get menus, link to icons
	//do something with languages
	$menu = "<div id=\"tngheader\">\n";
	$menu .= "<div id=\"mast\">\n";
	$menu .= "<div class=\"mhead\">\n";
	$menu .= "<a href=\"\" id=\"mcore\" onclick=\"return toggleMobileMenu('core');\"></a>\n";

	$tngconfig['mmenustyle'] = "";
	$tngconfig['menucount'] = 0;
	$menu .= "<ul id=\"mcoremenu\">\n";
	$menu .= tng_getLeftIcons();
	$menu .= tng_getRightIcons(false);
	$menu .= "</ul>\n";
	$tngconfig['mmenustyle'] .= get_menustyle("core",$tngconfig['menucount']);

	$menuicons = "<div id=\"mmenus\">\n";
	$menuitems = "";
	
	$tngconfig['menucount'] = 0;
	$finditems = tng_getFindMenu();
	if($tngconfig['menucount']) {
		$cols = $multicolclass = "";
		if(count($finditems) > 10) {
			$cols = " style=\"columns:2; -webkit-columns:2; -webkit-column-gap:0px;\"";
			$multicolclass = " mmulticol";
			if(count($finditems) % 2)
				$finditems[] = tngddrow("", "", "", "", true);
			$left_bottom = count($finditems)/2 - 1;
			$finditems[$left_bottom] = str_replace("mobileicon", "mobileicon mmulticollastleft", $finditems[$left_bottom]);
		}
		$findcontent = implode("",$finditems);
		$menuitems .= "<ul id=\"mfindmenu\" class=\"mright{$multicolclass}\"$cols>\n" . $findcontent . "</ul>\n";
		$menuicons .= "<a href=\"\" class=\"mmenu\" id=\"mmenu-find\" title=\"{$text['find_menu']}\" onclick=\"return toggleMobileMenu('find');\"></a>\n";
		$tngconfig['mmenustyle'] .= get_menustyle("find",$tngconfig['menucount']);
	}

	$tngconfig['menucount'] = 0;
	$mediaitems = tng_getMediaMenu();
	if($tngconfig['menucount']) {
		$cols = $multicolclass = "";
		if(count($mediaitems) > 10) {
			$cols = " style=\"columns:2; -webkit-columns:2; -webkit-column-gap:0px;\"";
			$multicolclass = " mmulticol";
			if(count($mediaitems) % 2)
				$mediaitems[] = tngddrow("", "", "", "", true);
			$left_bottom = count($mediaitems)/2 - 1;
			$mediaitems[$left_bottom] = str_replace("mobileicon", "mobileicon mmulticollastleft", $mediaitems[$left_bottom]);
		}
		$mediacontent = implode("",$mediaitems);
		$menuitems .= "<ul id=\"mmediamenu\" class=\"mright{$multicolclass}\"$cols>\n" . $mediacontent . "</ul>\n";
		$menuicons .= "<a href=\"\" class=\"mmenu\" id=\"mmenu-media\" title=\"{$text['media']}\" onclick=\"return toggleMobileMenu('media');\"></a>\n";
		$tngconfig['mmenustyle'] .= get_menustyle("media",$tngconfig['menucount']);
	}
	
	$tngconfig['menucount'] = 0;
	$infoitems = tng_getInfoMenu($title);
	if($tngconfig['menucount']) {
		$cols = $multicolclass = "";
		if(count($infoitems) > 10) {
			$cols = " style=\"columns:2; -webkit-columns:2; -webkit-column-gap:0px;\"";
			$multicolclass = " mmulticol";
			if(count($infoitems) % 2)
				$infoitems[] = tngddrow("", "", "", "", true);
			$left_bottom = count($infoitems)/2 - 1;
			$infoitems[$left_bottom] = str_replace("mobileicon", "mobileicon mmulticollastleft", $infoitems[$left_bottom]);
		}
		$infocontent = implode("",$infoitems);
		$menuitems .= "<ul id=\"minfomenu\" class=\"mright{$multicolclass}\"$cols>\n" . $infocontent . "</ul>\n";
		$menuicons .= "<a href=\"\" class=\"mmenu\" id=\"mmenu-info\" title=\"{$text['info']}\" onclick=\"return toggleMobileMenu('info');\"></a>\n";
		$tngconfig['mmenustyle'] .= get_menustyle("info",$tngconfig['menucount']);
	}
	
	//hook for custom dropdown options
	$tngconfig['menucount'] = 0;
	if(isset($custmenu['title_text']))
		$mtext = $custmenu['title_text'];
	elseif(isset($custmenu['title_index']))
		$mtext = $text[$custmenu['title_index']];
	else
		$mtext = "";

	if(isset($custommobilemenu))
		eval($custommobilemenu);
	//Rick Bisbee's mod
	elseif(isset($custmenu)) {
		$items = implode("",custom_links( $custommenulinks ));
		$menuitems .= custom_menu( $custmenu, $items, true );
		$cust_title = isset($custmenu['title_text']) ? $custmenu['title_text'] : "";
		$menuicons .= "<a href=\"\" id=\"mmenu-cust\" class=\"mmenu\" title=\"$mtext\" onclick=\"return toggleMobileMenu('cust');\"></a>\n";
		$tngconfig['mmenustyle'] .= get_menustyle("cust",$tngconfig['menucount']);
	}

	$tngconfig['menucount'] = 0;
	$menuitems .= tng_getLangMenu($title);
	if($tngconfig['menucount']) {
		$menuicons .= "<a href=\"\" id=\"mmenu-lang\" class=\"mmenu\" title=\"{$text['language']}\" onclick=\"return toggleMobileMenu('lang');\"></a>\n";
		$tngconfig['mmenustyle'] .= get_menustyle("lang",$tngconfig['menucount']);
	}

	$menuicons .= "</div>\n";
	$menu .= $menuicons . $menuitems . "</div>\n</div>\n</div>\n";

	//return both menu and transform style
	return $menu;
}

function tng_icons( $title = "" ) {
	global $text, $tngconfig, $customshare, $cms, $tngprint, $custommenu, $custmenu, $custommenulinks, $sitever, $chooselang;

	$fullmenu = "";
	if( $tngprint ) {
		$fullmenu .= "<div style=\"float:right\"><b><a href=\"javascript:{document.getElementById('printlink').style.visibility='hidden'; window.print();}\" style=\"text-decoration:underline\" id=\"printlink\">&gt;&gt; {$text['tngprint']} &lt;&lt;</a></b></div>\n";
	}
	else {

		if( $tngconfig['menu'] == 1 ) {
			$iconalign = "float-left";
			//$innerborder = "";
		}
		else {
			$iconalign = " float-right";
			//$innerborder = " style=\"border-right:1px solid #aaaaaa\"";
		}

		$left_icons = tng_getLeftIcons();
		if($left_icons) {
			$iconmargin = $tngconfig['menu'] == 2 && $chooselang ? " style=\"margin-top:2px\"" : "";
			$left_icons = "<div class=\"icons\"$iconmargin>\n{$left_icons}&nbsp;\n</div>\n";
		}

		$right_icons = tng_getRightIcons(true);

		$menu = "";
		if($tngconfig['menu'] < 2) {
			$menu .= "<li><a href=\"#\" class=\"menulink\">{$text['find_menu']}</a>\n";
			$menu .= "<ul>\n";
			$menu .= implode("",tng_getFindMenu());
			$menu .= "</ul>\n";
			$menu .= "</li>\n";

			$menu .= "<li><a href=\"#\" class=\"menulink\">{$text['media']}</a>\n";
			$menu .= "<ul>\n";
			$menu .= implode("",tng_getMediaMenu());
			$menu .= "</ul>\n";
			$menu .= "</li>\n";

			$menu .= "<li><a href=\"#\" class=\"menulink\">{$text['info']}</a>\n";
			$last = !isset($custommenu) ? " class=\"last\"" : "";
			$menu .= "<ul{$last}>\n";
			$menu .= implode("",tng_getInfoMenu($title));
			$menu .= "</ul>\n";
			$menu .= "</li>\n";

			//hook for custom dropdown options
			if(isset($custommenu))
				eval($custommenu);
			//Rick Bisbee's mod
			elseif(isset($custmenu)) {
				$items = implode("",custom_links( $custommenulinks ));
				$menu .= custom_menu( $custmenu, $items );
			}
			$innerstyle = "";
		}
		else
			$innerstyle = " style=\"height:25px\"";

		$outermenu = $rightmenu = "";

		if($menu) {
 			$outermenu .= "<ul class=\"tngdd $iconalign\" id=\"tngdd\">\n";

			if($tngconfig['menu'] != 1)
				$outermenu .= "<li class=\"langmenu stubmenu\"><br/></li>\n";

			$outermenu .= $menu;

			if($tngconfig['menu'] == 1)
				$outermenu .= "<li class=\"langmenu stubmenu-rt\"><br/></li>\n";

			$outermenu .= "</ul>\n";
		}
		if($tngconfig['menu'] != 1)
			$outermenu .= $left_icons;

		if($tngconfig['menu'] == 2 && empty($langmenu)) {
			$outermenu .= "<div class=\"icons-rt in-bar\">\n$right_icons\n</div>\n";
			$shift_str = " shift100left";
		}
		else
			$shift_str = "";

		if($outermenu) {
			$fullmenu .= "<div class=\"menucontainer\">\n";
			$fullmenu .= "<div class=\"innercontainer\"$innerstyle>\n";

			$fullmenu .= $outermenu;

			$fullmenu .= "</div>\n";
			$fullmenu .= "</div>\n";

			if(empty($tngconfig['searchchoice']) && empty($tngconfig['showsearch'])) {
				$searchform_url = getURL( "searchform", 0 );
				$famsearch_url = getURL( "famsearchform", 0 );
				$searchsite_url = getURL( "searchsite", 0 );

				$fullmenu .= '<div id="searchdrop" class="slidedown" style="display:none;">';
				$fullmenu .= "<a href=\"#\" onclick=\"jQuery('#searchdrop').slideUp(200);return false;\" style=\"float:right\"><img src=\"{$cms['tngpath']}img/tng_close.gif\" alt=\"\"/></a>";
				$fullmenu .= "<span class=\"subhead\"><strong>{$text['search']}</strong> | <a href=\"$searchform_url\">{$text['mnuadvancedsearch']}</a> | <a href=\"$famsearch_url\">{$text['searchfams']}</a> | <a href=\"$searchsite_url\">{$text['searchsitemenu']}</a></span><br/><br/>";
				$fullmenu .= getFORM( "search", "get", "", "") . "\n";
				$fullmenu .= "<label for=\"searchfirst\">{$text['firstname']}: </label><input type=\"text\" name=\"myfirstname\" id=\"searchfirst\"/> &nbsp;\n";
				$fullmenu .= "<label for=\"searchlast\">{$text['lastname']}: </label><input type=\"text\" name=\"mylastname\" id=\"searchlast\"/> &nbsp;\n";
				$fullmenu .= "<label for=\"searchid\">{$text['id']}: </label><input type=\"text\" class=\"veryshortfield\" name=\"mypersonid\" id=\"searchid\"/> &nbsp;\n";
				$fullmenu .= "<input type=\"hidden\" name=\"idqualify\" value=\"equals\"/>\n";
				$fullmenu .= "<input type=\"submit\" value=\"{$text['search']}\"/></form></div>";
			}
		}

		if($tngconfig['menu'] == 1)
			$fullmenu .= $left_icons;

		$sharemenu = "";
		if( !empty($tngconfig['showshare']) && $sitever != "mobile" ) {
	        $sharemenu .= "<div id=\"shareicons\" style=\"display:none\">\n";
			$sharemenu .= "<span class='st_facebook_hcount' displayText='Facebook'></span>\n";
			$sharemenu .= "<span class='st_twitter_hcount' displayText='Tweet'></span>\n";
			$sharemenu .= "<span class='st_pinterest_hcount' displayText='Pinterest'></span>\n";
	        if(isset($customshare))
	        	eval($customshare);
			$sharemenu .= "</div>\n";
		}

		if($sharemenu || $right_icons || $tngconfig['menu'] < 2 || !empty($numlangs)) {
			$fullmenu .= "<div class=\"icons-rt$shift_str\">";
			$fullmenu .= $sharemenu;

			if($tngconfig['menu'] < 2 || !empty($numlangs))
				$fullmenu .= $right_icons;

			$fullmenu .= "</div>\n";

			if($tngconfig['menu'] == 1)
				$fullmenu .= "<br style=\"clear:both\" /><br />\n";
		}

		if($menu) {
			$fullmenu .= '<script type="text/javascript">';
			$fullmenu .= 'var tngdd=new tngdd.dd("tngdd");';
			$fullmenu .= 'tngdd.init("tngdd","menuhover");';
			$fullmenu .= "</script>\n";
		}

	}

	return $fullmenu;
}

function tngddrow($link, $id, $thumb, $label, $labelliteral = false) {
	global $cms, $text, $sitever;
	static $id_counter = 1;

	$uselabel = $labelliteral ? $label : $text[$label];
	if($id == "")
		$id = "tng_menu_row_" . $id_counter++;
	if($sitever == "mobile") {
		$ddrow = "<li><a href=\"$link\" class=\"mobileicon\" id=\"$id\" title=\"$uselabel\">$uselabel</a></li>\n";
	}
	else {
		$ddrow = "<li><a href=\"$link\">";
		if($thumb)
			$ddrow .= "<img src=\"{$cms['tngpath']}$thumb\" class=\"menu-icon\" alt=\"\" />";
		else
			$ddrow .= "<span class=\"menu-icon\" id=\"$id\"></span>";
		$ddrow .= " <span class=\"menu-label\">$uselabel</span></a></li>\n";
	}

	return $ddrow;
}

function treeDropdown($forminfo) {
	global $text, $requirelogin, $assignedtree, $trees_table, $time_offset, $treerestrict, $cms, $tree, $numtrees, $tngconfig;

	$ret = "";
	if(!$requirelogin || !$treerestrict || !$assignedtree) {
		$query = "SELECT gedcom, treename, lastimportdate FROM $trees_table ORDER BY treename";
		$treeresult = tng_query($query);
		$numtrees = tng_num_rows($treeresult);
		$foundtree = false;

		if( $numtrees > 1 ) {
			if($forminfo['startform'])
				$ret .= getFORM( $forminfo['action'], $forminfo['method'], $forminfo['name'], $forminfo['id'] );
			$ret .= "<span class=\"normal\">{$text['tree']}: </span>";
			$ret .= treeSelect($treeresult, $forminfo['name']);
			$ret .= "&nbsp; <img src=\"{$cms['tngpath']}img/spinner.gif\" style=\"display:none;\" id=\"treespinner\" alt=\"\" class=\"spinner\"/>\n";
			if(isset($forminfo['hidden']) && is_array($forminfo['hidden'])) {
				foreach($forminfo['hidden'] as $hidden)
					$ret .= "<input type=\"hidden\" name=\"" . $hidden['name'] . "\" value=\"" . $hidden['value'] . "\" />\n";
			}
			//$ret .= "<input type=\"submit\" value=\"$text[go]\" />\n";
			if($forminfo['endform'])
				$ret .= "</form><br/>\n";
			else
				$ret .= "<br/><br/>\n";
			$treeresult = tng_query($query);
			if($tree) {
				$foundtree = true;
				while( $row = tng_fetch_assoc($treeresult) ) {
					if($row['gedcom'] == $tree) break;
				}
			}
		}
		else {
			$foundtree = true;
			$row = tng_fetch_assoc( $treeresult );
		}
		if( !empty($tngconfig['lastimport']) && $foundtree && !empty($forminfo['lastimport'])) {
			$lastimport = $row['lastimportdate'];

			if( $lastimport ) {
				$importtime = strtotime($lastimport);
				if(substr($lastimport,11,8) != "00:00:00")
					$importtime += ($time_offset * 3600);
				$importdate = strlen(date("j", $importtime)) == 1 ? date(" j M Y H:i:s", $importtime) : date("j M Y H:i:s", $importtime);
				echo "<p class=\"normal\">{$text['lastimportdate']}: " . displayDate($importdate) . "</p>";
			}
		}
		tng_free_result($treeresult);
	}
	return $ret;
}

function treeSelect($treeresult, $formname = null, $onchange = null) {
	global $text, $tree;

	$ret = "<select name=\"tree\" id=\"treeselect\"";
	if($formname)
		$ret .= " onchange=\"jQuery('#treespinner').show();document.$formname.submit();\"";
	elseif($onchange)
		$ret .= " onchange=\"$onchange\"";
	$ret .= ">\n";
	$ret .= "<option value=\"-x--all--x-\" ";
	if( !$tree ) $ret .= "selected=\"selected\"";
	$ret .= ">{$text['alltrees']}</option>\n";

	while( $row = tng_fetch_assoc($treeresult) ) {
		$ret .= "<option value=\"{$row['gedcom']}\"";
		if( $tree && $row['gedcom'] == $tree ) $ret .= " selected=\"selected\"";
		$ret .= ">{$row['treename']}</option>\n";
	}
	$ret .= "</select>\n";
	return $ret;
}

function getMediaHREF($row,$mlflag) {
	global $mediatypes_assoc, $mediapath, $htmldocs, $imagetypes, $videotypes, $recordingtypes, $notrunc, $cms;

	$histories_url = getURL( "histories", 1 );
	$showmedia_url = getURL( "showmedia", 1 );

	$uselink = "";

	if( $row['form'] )
		$form = strtoupper($row['form']);
	else {
		preg_match( "/\.(.+)$/", $row['path'], $matches );
		$form = isset($matches[1]) ? strtoupper($matches[1]) : '';
	}
	$thismediatype = $row['mediatypeID'];
	$usefolder = $row['usecollfolder'] ? $mediatypes_assoc[$thismediatype] : $mediapath;


	//if($mlflag != 1) 
	//	$notrunc = 1;  //ok, I'm not sure if this is really needed, so I'm commenting it out
	$other_acceptable_form_types = ["PDF","TXT","DOC","DOCX"];
	if( !$row['abspath'] && (in_array($form,$imagetypes) || in_array($form,$videotypes) || in_array($form,$recordingtypes) || in_array($form,$other_acceptable_form_types) || !$form) ) {
		$uselink = $showmedia_url . "mediaID=" . $row['mediaID'];
		if( $mlflag == 1 && !empty($row['medialinkID']))
			$uselink .= "&amp;medialinkID=" . $row['medialinkID'];
		elseif( $mlflag == 2 && !empty($row['albumlinkID']))
			$uselink .= "&amp;albumlinkID=" . $row['albumlinkID'];
		elseif( $mlflag == 3 && !empty($row['cemeteryID']))
			$uselink .= "&amp;cemeteryID=" . $row['cemeteryID'];
		//$uselink .= $row['all'] ? "&amp;all=1" : "";
	}
	else {
		if($row['abspath'] || substr($row['path'],0,4) == "http" || substr($row['path'],0,1) == "/")
			$uselink = $row['path'];
		elseif( in_array( $form, $htmldocs ) && $cms['support'] )
			$uselink = $histories_url . "inc=" . $row['path'];
		else {
			$url = rawurlencode( $row['path'] );
			$url = str_replace("%2F","/",$url);
			$url = str_replace("%3F","?",$url);
			$url = str_replace("%23","#",$url);
			$url = str_replace("%26","&",$url);
			$url = str_replace("%3D","=",$url);
			$uselink = "$usefolder/$url";
		}
	}
	if(!empty($row['newwindow']))
		$uselink .= "\" target=\"_blank";

	return $uselink;
}

function insertLinks($notes) {
	if($notes) {
		$pos = 0;
		$notepos = array();
		while (($pos = strpos($notes, "http", $pos)) !== FALSE) {
			if( $pos ) $prevchar = substr( $notes, $pos - 1, 1 );
			if( $pos == 0 || ($prevchar != "\"" && $prevchar != "=") )
		    	$notepos[] = $pos++;
			else
				$pos++;
		}
		$posidx = count($notepos);
		while( $posidx > 0 ) {
			$actual = $posidx - 1;
			$pos = $notepos[$actual];
			$firstpart = substr($notes,0,$pos);
			$rest = substr($notes,$pos);
			$linkstr = strtok($rest," <\n\r");
			if( substr( $linkstr, -1 ) == "." ) $linkstr = substr( $linkstr, 0, -1 );
			$lastpart = substr($notes,$pos + strlen($linkstr));
			$notes = $firstpart . "<a href=\"$linkstr\" target=\"_blank\">$linkstr</a>" . $lastpart;
			$posidx--;
		}
	}

	return $notes;
}

function getTemplateMessage($key) {
	global $tmp, $session_language;

	$langkey = $key . "_" . $session_language;

	return isset($tmp[$langkey]) ? $tmp[$langkey] : $tmp[$key];
}

function showLinks($linkList, $newtab = false, $class = null, $inner_html = null) {
	$links = explode("\r",$linkList);
	$finishedList = "";
	if(count($links) == 1)
		$links = explode("\n",$linkList);
	$orgtab = $newtab;
	foreach($links as $link) {
		$newtab = $orgtab;
		$parts = explode(",", $link);
		$len = count($parts);
		if($len == 1) {
			$title = $href = $parts[0];
		}
		elseif($len == 2) {
			$title = trim($parts[0]);
			$href = trim($parts[1]);
		}
		elseif($len == 3) {
			$title = trim($parts[0]);
			$href = trim($parts[1]);
			$newtab = true;
		}
		else {
			$href = trim(array_pop($parts));
			$title = implode("", $parts);
		}
		$target = $newtab ? " target=\"_blank\"" : "";
		$finishedList .= "<li";
		if($class) $finishedList .= " class=\"$class\"";
		if($inner_html)
			$html = preg_replace( "/xxx/", $title, $inner_html );
		else
			$html = $title;
		$finishedList .= "><a href=\"$href\" title=\"$title\"$target>$html</a></li>\n";
	}
	return $finishedList;
}

function showMediaLinks($linkList) {
   global $media_table, $rootpath, $photopath, $documentpath, $headstonepath, $historypath, $mediapath, $mediatypes_assoc, $thumbmaxw, $thumbmaxh, $cms, $mediatypes_thumbs, $sitever;
	$links = explode(",",$linkList);
	$finishedmedList = "";

	foreach($links as $link) {
		$thumbquery = "SELECT * FROM $media_table WHERE mediaID = \"$link\"";
		$thumbresult = tng_query($thumbquery);
		$thumbrow = tng_fetch_assoc( $thumbresult );
		tng_free_result( $thumbresult );
		if( !empty($thumbrow) ) {
			$mediatypeID = $thumbrow['mediatypeID'];
			$usefolder = $thumbrow['usecollfolder'] ? $mediatypes_assoc[$mediatypeID] : $mediapath;
			$thumb = $cms['tngpath'] . "$usefolder/" . str_replace("%2F","/",rawurlencode( $thumbrow['thumbpath'] ));
			$title = !empty($thumbrow['altdescription']) ? $thumbrow['altdescription'] : $thumbrow['description'];
			$imgsrc = "<img src=\"$thumb\" alt=\"$title\" title=\"$title\" class=\"thumb\" />";
			$href = getMediaHREF($thumbrow,0);
			$finishedmedList .= "<br /><a href=\"$href\" title=\"$title\" target=\"_blank\">" . $imgsrc . "</a>&nbsp;<a href=\"$href\" title=\"$title\" target=\"_blank\" style=\"vertical-align:top;\">$title</a><br />";
		}
	}
	return $finishedmedList;
}

function custom_menu( $custmenu, $items, $mobile = false ) {
	global $text;

	if( isset($custmenu['title_text'])) {
		$mtext = $custmenu['title_text'];
	}
	elseif( isset($custmenu['title_index']) ) {
		$mtext = $text[$custmenu['title_index']];
	}
	// Check for deprecated options
	elseif(isset($custmenu['text'])) {
		if( $custmenu['literal'] == true ) {
			$mtext = $custmenu['text'];
		}
		else {
			$mtext = $text[$custmenu['text']];
		}
	}
	else
		$mtext = "Other";

	if($mobile) {
		$menu = "<ul id=\"mcustmenu\" class=\"mright\">\n" . $items . "</ul>\n";
	}
	else {
		$menu = "<li><a href=\"#\" class=\"menulink\">$mtext</a>\n";
		$menu .= "<ul class=\"last\">\n" . $items . "\n</ul>\n";
		$menu .= "</li>\n";
	}

	return $menu;
}

function custom_links( $linkdefs ) {
	global $cms, $text, $allow_admin, $currentuser, $users_table, $tngconfig;

	$menu = array();
	for( $i=0; isset($linkdefs[$i]); $i++ ) {
		if( isset($linkdefs[$i]['admin']) && $linkdefs[$i]['admin']) {
			if( !$allow_admin ) continue;
			$query = "SELECT role FROM $users_table WHERE username='$currentuser'";
			$result = tng_query( $query ) or die( "cannot execute query: $query" );
			$row = tng_fetch_assoc( $result );
			if( $row['role'] != 'admin' ) continue;
		}

		if( isset( $linkdefs[$i]['user'] ) && $linkdefs[$i]['user'] === true && !$currentuser ) continue;
		if( !isset( $linkdefs[$i]['target'] ) ) continue;
//echo "doingx $i<br>";
		$target = $linkdefs[$i]['target'];
		$linkpath = !empty( $linkdefs[$i]['external'] ) ? '' : $cms['tngpath'];

		// add options to target section
		if( !empty( $linkdefs[$i]['tip_text'] ) ){
			$target .= "\" title=\"{$linkdefs[$i]['tip_text']}";
		}
		elseif( isset( $linkdefs[$i]['tip_index'] ) ) {
			$target .= "\" title=\"{$text[$linkdefs[$i]['tip_index']]}";
		}
		if( isset( $linkdefs[$i]['newwin'] ) ) {
			$target .= "\" target=\"_blank";
		}
		// set label for the link
		if( isset( $linkdefs[$i]['label_text'] ) ) {
			$label = $linkdefs[$i]['label_text'];
			$literal = true;
		}
		elseif( isset( $linkdefs[$i]['label_index'] ) ) {
			$label = $linkdefs[$i]['label_index'];
			$literal = false;
		}
		// handle deprecated defs
		elseif( isset( $linkdefs[$i]['text'] ) ) {
			if( $linkdefs[$i]['literal'] ) {
				$literal = true;
				$label = $linkdefs[$i]['text'];
			}
			else {
				$label = $text[$linkdefs[$i]['text']];
				$literal = false;
			}
		}
		if( empty( $linkdefs[$i]['sprite'] ) )
			$linkdefs[$i]['sprite'] = '';
		if( empty( $linkdefs[$i]['icon'] ) )
			$linkdefs[$i]['icon'] = '';
		//echo $linkpath.$target . " " . $linkdefs[$i]['sprite'] . " " . $linkdefs[$i]['icon'] . " " . $label . " " . $literal . "<br>";
		$menu[] = tngddrow(
			$linkpath.$target,
			$linkdefs[$i]['sprite'],
			$linkdefs[$i]['icon'],
			$label,
			$literal
		);
		$tngconfig['menucount']++;
	}

//debugPrint($linkdefs);
	return $menu;
}

function findlangfolder( $file ) {
	global $mylanguage, $language;

	if( file_exists("$mylanguage/$file") )
		$foundlang = "$mylanguage";
	elseif( file_exists("languages/$language/$file") )
		$foundlang = "languages/$language";
	else
		$foundlang = "languages/English";
		
	return $foundlang;
}
?>