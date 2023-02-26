<?php
include_once("pwdlib.php");
include_once("globallib.php");
@include_once("mediatypes.php");
@include_once("tngfiletypes.php");
checkMaintenanceMode(1);
if(isset($map['key']) && $map['key'])
	include_once("googlemaplib.php");
$flags = array();

$http_user_agent = strtolower($_SERVER["HTTP_USER_AGENT"]);
$newbrowser = preg_match("/msie/", $http_user_agent) && preg_match("/mac/", $http_user_agent) ? 0 : 1;
$filepickerdims = "width=650,height=600";
$dims = "width=\"20\" height=\"20\"";
if(!isset($message)) $message = "";

$isConnected = isConnected();

function tng_adminheader( $title, $flags ) {
	global $tng_title, $tng_version, $tng_date, $tng_copyright, $session_charset, $sitename, $dates, $cms, $templatepath, $text, $sitever, $tngdomain, $tngconfig, $isConnected;

	header("Content-type:text/html;charset=" . $session_charset);
	if( !empty( $flags['modmgr'] ) )
		echo "<!DOCTYPE html>\n\n";
	else
		echo $tngconfig['doctype'] ? $tngconfig['doctype'] . "\n\n" : "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n\n";
	echo "<!-- $tng_title, v.$tng_version ($tng_date), Written by Darrin Lythgoe, $tng_copyright -->\n";
	echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n";
	$usesitename = $sitename ? stripslashes($sitename) . ": " : "";
	echo "<title>$usesitename" . "TNG Admin ($title)</title>\n";

	if( $session_charset )
		echo "<meta http-equiv=\"Content-type\" content=\"text/html; charset=$session_charset\">\n";
	if($sitever == "mobile") {
		echo "<meta name=\"MobileOptimized\" content=\"320\" />\n";
		echo "<meta name=\"viewport\" width=\"device-width, initial-scale=1\" />\n";
	}

	if(!$tng_version) include_once("version.php");
	echo "<link href=\"{$cms['tngpath']}css/genstyle.css?v=$tng_version\" rel=\"stylesheet\" type=\"text/css\" />\n";
	if( isset($flags['modmgr']) )
		echo "<link href=\"{$cms['tngpath']}css/modmanager.css\" rel=\"stylesheet\" type=\"text/css\">\n";
	if($sitever == "mobile") {
		echo "<link href=\"{$cms['tngpath']}css/tngmobile.css?v=$tng_version\" rel=\"stylesheet\" type=\"text/css\" />\n";
	}
	if( isset( $flags['css'] ) )
		echo $flags['css'];
	echo "<link href=\"{$cms['tngpath']}{$templatepath}css/tngtabs2.css\" rel=\"stylesheet\" type=\"text/css\">\n";
	echo "<link href=\"{$cms['tngpath']}{$templatepath}css/templatestyle.css?v=$tng_version\" rel=\"stylesheet\" type=\"text/css\" />\n";
	echo "<link href=\"{$cms['tngpath']}{$templatepath}css/mytngstyle.css?v=$tng_version\" rel=\"stylesheet\" type=\"text/css\" />\n";
	if($sitever != "mobile" && $sitever != "tablet") {
		echo "<link rel=\"shortcut icon\" href=\"img/admin/{$tngconfig['favicon']}\" />\n";
		// Update to add icons for Windows 8+ and Safari in MacOS El Capitan+.
		echo "<link rel=\"mask-icon\" href=\"img/safari-pinned-tab.svg\" color=\"#5bbad5\" />\n";
		echo "<meta name=\"msapplication-config\" content=\"img/admin/browserconfig.xml\" />\n";
		echo "<meta name=\"msapplication-TileColor\" content=\"#ffffff\" />\n";
		echo "<meta name=\"msapplication-TileImage\" content=\"img/admin/ms-icon-144x144.png\" />\n";
		echo "<meta name=\"theme-color\" content=\"#ffffff\" />\n";
		// Update to add icons for Windows 8+ and Safari in MacOS El Capitan+.
	} else {
		echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />\n";
		echo "<meta name=\"apple-mobile-web-app-capable\" content=\"yes\" />\n";
		echo "<meta name=\"mobile-web-app-capable\" content=\"yes\" />\n";
		echo "<meta http-equiv=\"cleartype\" content=\"on\" />\n";

		// Update to add icons for Android and iOS 8+.
		echo "<link rel=\"apple-touch-icon\" sizes=\"57x57\" href=\"{$cms['tngpath']}img/admin/apple-icon-57x57.png\" />\n";
		echo "<link rel=\"apple-touch-icon\" sizes=\"60x60\" href=\"{$cms['tngpath']}img/admin/apple-icon-60x60.png\" />\n";
		echo "<link rel=\"apple-touch-icon\" sizes=\"72x72\" href=\"{$cms['tngpath']}img/admin/apple-icon-72x72.png\" />\n";
		echo "<link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"{$cms['tngpath']}img/admin/apple-icon-76x76.png\" />\n";
		echo "<link rel=\"apple-touch-icon\" sizes=\"114x114\" href=\"{$cms['tngpath']}img/admin/apple-icon-114x114.png\" />\n";
		echo "<link rel=\"apple-touch-icon\" sizes=\"120x120\" href=\"{$cms['tngpath']}img/admin/apple-icon-120x120.png\" />\n";
		echo "<link rel=\"apple-touch-icon\" sizes=\"144x144\" href=\"{$cms['tngpath']}img/admin/apple-icon-144x144.png\" />\n";
		echo "<link rel=\"apple-touch-icon\" sizes=\"152x152\" href=\"{$cms['tngpath']}img/admin/apple-icon-152x152.png\" />\n";
		echo "<link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"{$cms['tngpath']}img/admin/apple-icon-180x180.png\" />\n";
		echo "<link rel=\"icon\" type=\"image/png\" sizes=\"192x192\" href=\"{$cms['tngpath']}img/admin/android-icon-192x192.png\" />\n";
		echo "<link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"{$cms['tngpath']}img/admin/favicon-32x32.png\" />\n";
		echo "<link rel=\"icon\" type=\"image/png\" sizes=\"96x96\" href=\"{$cms['tngpath']}img/admin/favicon-96x96.png\" />\n";
		echo "<link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"{$cms['tngpath']}img/admin/favicon-16x16.png\" />\n";
		echo "<link rel=\"manifest\" href=\"img/admin/manifest.json\" />\n";
		// Update to add icons for Android and iOS 8 and later.
		echo "<link rel=\"apple-touch-icon-precomposed\" sizes=\"144x144\" href=\"{$cms['tngpath']}img/tng-apple-icon-144.png\" />\n";
		echo "<link rel=\"apple-touch-icon-precomposed\" sizes=\"114x114\" href=\"{$cms['tngpath']}img/tng-apple-icon-114.png\" />\n";
		echo "<link rel=\"apple-touch-icon-precomposed\" sizes=\"72x72\" href=\"{$cms['tngpath']}img/tng-apple-icon-72.png\" />\n";
		echo "<link rel=\"apple-touch-icon-precomposed\" href=\"{$cms['tngpath']}img/tng-apple-icon.png\" />\n";
		echo "<link rel=\"shortcut icon\" href=\"img/tng-apple-icon.png\" />\n";
	}
	echo "<meta name=\"robots\" content=\"noindex,nofollow\">\n";
	include( "adminmeta.php" );
	echo "<script type=\"text/javascript\">\n";
	echo "function toggleAll(flag) {\n";
	echo "for( var i = 0; i < document.form2.elements.length; i++ ) {\n";
	echo "if( document.form2.elements[i].type == \"checkbox\" ) {\n";
	echo "if( flag )\n";
	echo "document.form2.elements[i].checked = true;\n";
	echo "else\n";
	echo "document.form2.elements[i].checked = false;\n";
	echo "}\n}\n}\n";
	//echo "var MONTH_NAMES=new Array('$dates[JANUARY]','$dates[FEBRUARY]','$dates[MARCH]','$dates[APRIL]','$dates[MAY]','$dates[JUNE]','$dates[JULY]','$dates[AUGUST]','$dates[SEPTEMBER]','$dates[OCTOBER]','$dates[NOVEMBER]','$dates[DECEMBER]','$dates[JAN]','$dates[FEB]','$dates[MAR]','$dates[APR]','$dates[MAY]','$dates[JUN]','$dates[JUL]','$dates[AUG]','$dates[SEP]','$dates[OCT]','$dates[NOV]','$dates[DEC]');\n";
	echo "var closeimg = \"img/tng_close.gif\";var cmstngpath='';";
	echo "var loadingmsg = \"{$text['loading']}\";\n";
	echo "</script>\n";
	if($isConnected) {
		echo "<script src=\"https://code.jquery.com/jquery-3.4.1.min.js\" integrity=\"sha384-vk5WoKIaW/vJyUAd9n/wmopsmNhiy+L2Z+SBxGYnUkunIxVxAv/UtMOhba/xskxh\" crossorigin=\"anonymous\"></script>\n";
		echo "<script src=\"https://code.jquery.com/ui/1.12.1/jquery-ui.min.js\" integrity=\"sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=\" crossorigin=\"anonymous\"></script>\n";
	}
	else {
		echo "<script type=\"text/javascript\">// <![CDATA[\nwindow.jQuery || document.write(\"<script src='{$cms['tngpath']}js/jquery-3.4.1.min.js?v=130'>\\x3C/script>\")\n//]]></script>\n";
		echo "<script type=\"text/javascript\">// <![CDATA[\nwindow.jQuery.ui || document.write(\"<script src='{$cms['tngpath']}js/jquery-ui-1.12.1.min.js?v=130'>\\x3C/script>\")\n//]]></script>\n";
	}
	echo "<script type=\"text/javascript\" src=\"{$cms['tngpath']}js/jquery.ui.touch-punch.min.js\"></script>\n";
	echo "<script type=\"text/javascript\" src=\"{$cms['tngpath']}js/net.js\"></script>\n";
	echo "<script type=\"text/javascript\" src=\"{$cms['tngpath']}js/admin.js\"></script>\n";

	echo "<script type=\"text/javascript\" src=\"{$cms['tngpath']}js/litbox.js\"></script>\n";
	initMediaTypes();
}

function tng_corner($side) {
	return "<div class=\"admincorner fl-{$side}\" id=\"corner-{$side}\"><a href=\"https://tngsitebuilding.com\" target=\"_blank\"><img src=\"img/tnglogo.png\" alt=\"The Next Generation of Genealogy Sitebuilding\"></a></div>\n";
}

function tng_adminmasthead() {
	global $tng_title, $tng_version, $currentuser, $allow_admin, $admtext, $text, $homepage, $tngconfig, $cms, $sitever; 

	$helplang = findhelp("index_help.php");

	$output = "<div class=\"admintop\">\n";
	$output .= "<p class=\"admintitle\" style=\"white-space:nowrap\"><strong>$tng_title, v.$tng_version</strong></p>\n";
	$output .= "<span class=\"whitetext normal\" style=\"white-space:nowrap\">\n";
	$output .= "<a href=\"admin.php\" class=\"lightlink\">{$admtext['adminhome']}</a>\n";
	$output .= "&nbsp;|&nbsp; <a href=\"$homepage\" class=\"lightlink\">{$admtext['publichome']}</a>\n";
	if( $allow_admin )
		$output .= "&nbsp;|&nbsp; <a href=\"{$cms['tngpath']}adminshowlog.php\" class=\"lightlink\" target=\"main\">{$admtext['showlog']}</a>\n";
	if($sitever != "mobile") {
		$output .= "&nbsp;|&nbsp; <a href=\"#\" onclick=\"return openHelp('{$helplang}/index_help.php');\" class=\"lightlink\">{$admtext['getstart']}</a>\n";
		if($tngconfig['maint'])
			$output .= "&nbsp;|&nbsp; <strong><span class=\"yellow\">{$text['mainton']}</span></strong>\n";
	}
	$output .= "&nbsp;|&nbsp; <a href=\"logout.php?admin_login=1\" class=\"lightlink\" target=\"_parent\">{$admtext['logout']}&nbsp; (<strong>$currentuser</strong>)</a>\n";
	$output .= "</span>\n";
	$output .= "</div>\n";

	return $output;
}

function tng_adminlayout($args = "", $showmenu = true) {
	global $sitever, $tng_abbrev;

	if($sitever == "mobile") $tng_title = $tng_abbrev;
	//$class_str = $class ? " class=\"$class\"" : "";
	$output = "<body class=\"adminbody\"$args>\n";

	$output .= "<div class=\"topbanner sideback whiteheader\">\n";
	$output .= $sitever == "standard" ? tng_corner('left') : "";
	$output .= $sitever == "standard" ? tng_corner('right') : "";
	$output .= tng_adminmasthead();
	$output .= "</div>\n";

	//left banner
	$output .= "<div>\n";
	$leftoffset = $mainoffset = "";
	if($sitever == "standard") {
		if(isset($_SESSION['tng_menuhidden']) && $_SESSION['tng_menuhidden'] == "on") {
			$leftoffset = " style=\"left:-135px\"";
			$mainoffset = "style=\"padding-left: 26px\"";
		}
		if($showmenu) {
			$output .= "<div id=\"leftmenu\" class=\"leftmenu sideback normal\"$leftoffset>\n";
			include("admin_leftmenu.php");
			$output .= "</div>\n";
		}
	}
	else
		$mainoffset = " style=\"padding-left: 0px;\"";

	$classname = $showmenu ? "mainback" : "homeback";
	$output .= "<div id=\"maincontent\" class=\"$classname\"$mainoffset>\n";

	return $output;
}

function tng_adminfooter() {
	global $tng_title, $tng_version;
	$output = "</div></div>\n";
	$output .= "</body>\n</html>\n";

	return $output;
}

function getNewNumericID( $type, $field, $table ) {
	global $tree, $admtext, $tngconfig;

	$prefix = $tngconfig[$type.'prefix'];
	$suffix = $tngconfig[$type.'suffix'];
	if( $prefix ) {
		$prefixlen = strlen( $prefix ) + 1;
		$query = "SELECT MAX(0+SUBSTRING($field" . "ID,$prefixlen)) as newID FROM $table WHERE gedcom = \"$tree\" AND $field" . "ID LIKE \"$prefix%\"";
	}
	else
		$query = "SELECT MAX(0+SUBSTRING_INDEX($field" . "ID,'$suffix',1)) as newID FROM $table WHERE gedcom = \"$tree\"";

	$result = tng_query($query);
	$maxrow = tng_fetch_array( $result );
	tng_free_result($result);

	$newID = $maxrow['newID'] ? $maxrow['newID'] + 1 : 0;

	return $newID;
}

function findhelp( $helpfile ) {
	global $mylanguage, $language;

	if( file_exists("$mylanguage/$helpfile") )
		$helplang = $mylanguage;        //$mylanguage should already include "languages/"
	elseif( file_exists("languages/$language/$helpfile") )
		$helplang = "languages/$language";
	else
		$helplang = "languages/English";
		
	return $helplang;
}

function doMenu($tabs,$currtab,$innermenu=0) {
	global $newbrowser, $text, $sitever;

	$tabctr = 0;
	$menu = "<div style=\"width:100%;\">\n";
	$menu .= "<div>\n";
  	$menu .= $newbrowser ? "<ul id=\"tngnav\">\n" : "<div id=\"tabs\">\n";

  	$choices = "";
	if( is_array($tabs) ) {
		foreach($tabs as $tab) {
			if( $tab[0] )
				$choices .= doMenuItem( $tabctr++, $tab[1], "", $tab[2], $currtab, $tab[3] );
		}
	}
	if($sitever == "mobile") {
		$menu .= "<li>\n<a class=\"here\">\n<select id=\"tngtabselect\" onchange=\"window.location.href=this.options[this.selectedIndex].value\">\n$choices</select>\n</a>\n</li>\n";
	}
	else
		$menu .= $choices;
	$menu .= $newbrowser ? "</ul>\n" : "</div>\n";
	$menu .= "</div>\n";
	$menu .= "<div id=\"adm-innermenu\" class=\"fieldnameback fieldname smaller\">\n";
	$menu .= $innermenu ? $innermenu : "&nbsp;";
	$menu .= "</div>\n";
	$menu .= "</div>\n";

	return $menu;
}

function checkReview($type) {
	global $people_table, $families_table, $temp_events_table, $assignedbranch, $assignedtree, $admtext, $tree;

	if( $type == "I" ) {
		$revwhere = "$people_table.personID = $temp_events_table.personID AND $people_table.gedcom = $temp_events_table.gedcom AND (type = \"I\" OR type = \"C\")";
		$table = $people_table;
	}
	else {
		$revwhere = "$families_table.familyID = $temp_events_table.familyID AND $families_table.gedcom = $temp_events_table.gedcom AND type = \"F\"";
		$table = $families_table;
	}
	if( $assignedtree )
		$revwhere .= " AND $temp_events_table.gedcom = \"$tree\"";
	if( $assignedbranch )
		$revwhere .= " AND branch LIKE \"%$assignedbranch%\"";
	$revquery = "SELECT count(tempID) as tcount FROM ($table, $temp_events_table) WHERE $revwhere";
	$revresult = tng_query($revquery) or die ($admtext['cannotexecutequery'] . ": $revquery");
	$revrow = tng_fetch_assoc($revresult);
	tng_free_result( $revresult );

	return $revrow['tcount'] ? " *" : "";
}

function deleteNote($noteID, $flag) {
	global $notelinks_table, $xnotes_table, $admtext;

	$query = "SELECT xnoteID FROM $notelinks_table WHERE ID=\"$noteID\"";
	$result = tng_query($query);
	$nrow = tng_fetch_assoc( $result );
	tng_free_result( $result );
	
	$query = "SELECT count(ID) as xcount FROM $notelinks_table WHERE xnoteID=\"{$nrow['xnoteID']}\"";
	$result = tng_query($query);
	$xrow = tng_fetch_assoc( $result );
	tng_free_result( $result );
	
	if( $xrow['xcount'] == 1 ) {
		$query = "DELETE FROM $xnotes_table WHERE ID=\"{$nrow['xnoteID']}\"";
		$result = tng_query($query);
	}
	if( $flag ) {
		$query = "DELETE FROM $notelinks_table WHERE ID=\"$noteID\"";
		$result = tng_query($query);
	}
}

function displayToggle($id,$state,$target,$headline,$subhead,$append="") {
	global $admtext;

	$rval = "<span class=\"subhead\"><a href=\"#\" onclick=\"return toggleSection('$target','$id');\" class=\"togglehead\" style=\"color:black\"><img src=\"img/" . ($state ? "tng_collapse.gif" : "tng_expand.gif") . "\" title=\"{$admtext['toggle']}\" alt=\"{$admtext['toggle']}\" width=\"15\" height=\"15\" border=\"0\" id=\"$id\">";
	$rval .= "<strong class=\"th-indent\">$headline</strong></a> $append</span><br />\n";
	if($subhead)
		$rval .= "<span class=\"normal tsh-indent\"><i>$subhead</i></span><br />\n";

	return $rval;
}

function displayHeadline($headline,$icon,$menu,$message) {
	$rval = "<div class=\"admin-header\">\n<div class=\"pad5\">\n";
	$rval .= "<img src=\"$icon\" title=\"$headline\" alt=\"$headline\" style=\"vertical-align: top; width: 40px; height: 40px; margin-right: 10px;\"><span class=\"plainheader\">$headline</span></div><br />\n";
	if( $message )
		$rval .= "<p class=\"normal red\">&nbsp;<em>" . urldecode(stripslashes($message)) . "</em></p>\n";
	else
		$rval .= "<br />\n";
	$rval .= "$menu\n</div>\n";
	
	return $rval;
}

function displayListLocation($start,$pagetotal,$grandtotal) {
	global $admtext, $text;

	$rval = "<p>{$admtext['matches']}: " . number_format($start) . " {$text['to']} <span class=\"pagetotal\">" . number_format($pagetotal) . "</span> {$text['of']} <span class=\"restotal\">" . number_format($grandtotal) . "</span>";

	return $rval;
}

function showEventRow($datefield,$placefield,$label,$persfamID) {
	global $admtext, $tree, $gotmore, $gotnotes, $gotcites, $row, $dims, $noclass, $currentform, $tngconfig;

	$notesicon = !empty($gotnotes[$label]) ? "admin-note-on-icon" : "admin-note-off-icon";
	$citesicon = !empty($gotcites[$label]) ? "admin-cite-on-icon" : "admin-cite-off-icon";
	$moreicon = !empty($gotmore[$label]) ? "admin-more-on-icon" : "admin-more-off-icon";

	$ldsarray = array("BAPL","CONL","INIT","ENDL","SLGS","SLGC");

	if(!isset($currentform)) $currentform = "document.form1";
	$blurAction = ($label == "DEAT" || $label == "BURI") ? " updateLivingBox($currentform,this);" : "";
	$onblur = $blurAction ? " onblur=\"$blurAction\"" : "";

	if($datefield == "altbirthdate") {
		if($label == "ALTBE") {
			$label = empty($tngconfig['altbirth']) ? "CHR" : explode(',',$tngconfig['altbirth'])[0];
		}
		$altbirthtype = "<input type=\"hidden\" name=\"altbirthtype\" id=\"altbirthtype\" value=\"$label\" />";
		$type_selector = getAltBirthTypes($label);
		$fieldlabel = "<span id=\"altbirthlabel\">" . $admtext[$label] . "</span>";
		$dloglabel = "ALTBE";
	}
	else {
		$altbirthtype = "";
		$type_selector = "";
		$fieldlabel = $admtext[$label];
		$dloglabel = $label;
	}

	$short = $noclass ? " style=\"width:100px\"" : " class=\"shortfield\"";
	$long = $noclass ? " style=\"width:270px\"" : " class=\"longfield\"";
	$tr = "<tr>\n";
	$tr .= "<td>" . $fieldlabel . ":{$type_selector}</td>\n";
	$tr .= "<td><input type=\"text\" value=\"" . (isset($row[$datefield]) ? $row[$datefield] : "") . "\" name=\"$datefield\" onblur=\"checkDate(this);{$blurAction}\" maxlength=\"50\"$short>$altbirthtype</td>\n";
	$tr .= "<td><input type=\"text\" class=\"verylongfield\" value=\"" . (isset($row[$placefield]) ? $row[$placefield] : "") . "\" name=\"$placefield\" {$onblur}id=\"$placefield\"$long></td>\n";
	if(in_array($label,$ldsarray))
		$tr .= "<td><a href=\"#\" onclick=\"return openFindPlaceForm('$placefield', 1);\" title=\"{$admtext['find']}\" class=\"smallicon admin-temp-icon\"></a></td>\n";
	else
		$tr .= "<td><a href=\"#\" onclick=\"return openFindPlaceForm('$placefield');\" title=\"{$admtext['find']}\" class=\"smallicon admin-find-icon\"></a></td>\n";
	if(isset($gotmore))
		$tr .= "<td><a href=\"#\" onclick=\"return showMore('$dloglabel','$persfamID');\" title=\"{$admtext['more']}\" id=\"moreicon$label\" class=\"smallicon $moreicon\"></a></td>\n";
	if(isset($gotnotes))
		$tr .= "<td><a href=\"#\" onclick=\"return showNotes('$dloglabel','$persfamID');\" title=\"{$admtext['notes']}\" id=\"notesicon$label\" class=\"smallicon $notesicon\"></a></td>\n";
	if(isset($gotcites))
		$tr .= "<td><a href=\"#\" onclick=\"return showCitations('$dloglabel','$persfamID');\" title=\"{$admtext['sources']}\" id=\"citesicon$label\" class=\"smallicon $citesicon\"></a></td>\n";
	$tr .= "</tr>\n";
	return $tr;
}

function getAltBirthTypes($currentType) {
	global $tngconfig, $admtext, $options;

	$typestr = " &nbsp;<span class=\"nw\"><a href=\"#\" onclick=\"showEdit('altbirthedit'); quitEdit('altbirthedit'); return false;\"><img src=\"img/ArrowDown.gif\" border=\"0\" style=\"margin-left:-4px;margin-right:-2px\"></a></span>";

	$typestr .= "<div id=\"altbirthedit\" class=\"lightback pad5 rounded4\" style=\"position:absolute;display:none;\" onmouseover=\"clearTimeout(dtimer);\" onmouseout=\"closeEdit('altbirth','altbirthedit','altbirthlist');\">\n";
		$types = empty($tngconfig['altbirth']) ? ['CHR'] : explode(',',$tngconfig['altbirth']);
		$numtypes = count($types);
		$typestr .= "<select name=\"altbirth\" id=\"altbirth\" size=\"{$numtypes}\" onchange=\"changeAltBirthType();\">\n";
		foreach($types as $type) {
			$label = isset($admtext[$type]) ? $admtext[$type] : $type;
			$typestr .= "	<option value=\"$type\"";
			if( $currentType == $type ) $typestr .= " selected";
			$typestr .= ">$label</option>\n";
		}

		$typestr .= "</select>\n";
	$typestr .= "</div>\n";

	return $typestr;
}

function cleanID($id){
	return preg_replace('/[^a-z0-9_-]/','',strtolower($id));
}

function determineConflict($row,$table) {
	global $currentuser, $tngconfig, $admtext;

	$editconflict = false;
	$currenttime = time();
	if($row['edituser'] && $row['edituser'] != $currentuser) {
		if($tngconfig['edit_timeout'] === "")
			$tngconfig['edit_timeout'] = 15;
		$expiretime = $row['edittime'] + (intval($tngconfig['edit_timeout']) * 60);
		//echo "et=$expiretime, ct=$currenttime"; exit;
		if($expiretime > $currenttime)
			$editconflict = true;
	}

	if(!$editconflict && isset($row['ID'])) {
		$query = "UPDATE $table SET edituser = \"$currentuser\", edittime = \"$currenttime\" WHERE ID = \"{$row['ID']}\"";
		$eresult = tng_query($query);
	}

	return $editconflict;
}

function getHasKids($tree, $personID) {
	global $families_table, $children_table;

	$haskids = 0;
	$query = "SELECT familyID FROM $families_table WHERE husband=\"$personID\" AND gedcom=\"$tree\" UNION
		SELECT familyID FROM $families_table WHERE wife=\"$personID\" AND gedcom=\"$tree\"";
	$fresult = @tng_query($query);
	while($famrow = tng_fetch_assoc($fresult)) {
		$query = "SELECT personID FROM $children_table WHERE familyID=\"{$famrow['familyID']}\" AND gedcom=\"$tree\"";
		$cresult = @tng_query($query);
		$ccount = tng_num_rows($cresult);
		tng_free_result($cresult);
		if($ccount) {
			$haskids = 1;
			break;
		}
	}
	tng_free_result($fresult);

	return $haskids;
}
?>