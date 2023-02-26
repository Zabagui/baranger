<?php
include("begin.php");
$maint = $tngconfig['maint'];
include($subroot . "mapconfig.php");
include("adminlib.php");
$textpart = "index";
//include("getlang.php");
include("$mylanguage/admintext.php");
$admin_login = 1;
$menu_count = 0;

include("checklogin.php");

if( !$allow_edit && !$allow_add && !$allow_delete ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

if( $allow_edit && $allow_add && $allow_delete && !$assignedtree ) {
	$upgrades = glob($rootpath . "upgrade-*-14x.html");
	if(count($upgrades)) {
		header("Location: admin_upgrade.php");
		exit;
	}
	if(!$tngconfig['hidetotals']) {
		include 'classes/modvalidator.class.php';
		$oVal = new_modvalidator();
		$mm_data = $oVal->check_status(false);
	}
}

include("version.php");

function adminMenuItem($destination, $label, $number, $icon) {
	global $sitever, $menu_count;

	$menu = "";
	if($sitever == "mobile") {
		$iconstr = $msgstr = "";
		$subheadstr = " adminsubhead-mobile";
	}
	else {
		$iconstr = "<img src=\"img/{$icon}_icon.gif\" alt=\"{$label}\" class=\"adminicon\">\n";
		$subheadstr = "";
		$menu_count++;
	}

	$menu .= "<a href=\"$destination\" class=\"lightlink2 admincell fieldnameback\">\n";
	$menu .= $iconstr;
	if($number !== "") {
		if(is_numeric($number))
			$number = number_format($number);
		$menu .= "<div class=\"admintotal\"><strong>{$number}</strong></div>\n";
	}
	$menu .= "<div class=\"adminsubhead{$subheadstr}\"><strong>$label</strong></div>\n";
	$menu .= "<div style=\"clear:both\"></div>\n";
	$menu .= "</a>\n";

	return $menu;
}

function getTotal($table, $where = "") {
	global $assignedtree, $assignedbranch, $tngconfig;

	$total = "";
	if(!$tngconfig['hidetotals']) {
		if($assignedtree) {
			if($where == 1) {
				$where = "gedcom = \"$assignedtree\"";
				if($assignedbranch)
					$where .= " AND branch LIKE \"%{$assignedbranch}%\"";
			}
			elseif($where == 2)
				$where = "gedcom = \"$assignedtree\"";
		}

		$query = "SELECT count(*) as num FROM $table";
		if($where)
			$query .= " WHERE $where";
		$result = tng_query($query);
		$row = tng_fetch_assoc($result);
		$total = $row['num']; 
	 	tng_free_result($result);
	}

 	return $total;
}

function switcherLink($param, $label) {
	return "<br/><p class=\"smaller msearch-indent\"><a href=\"admin.php?sitever={$param}\" class=\"fieldnameback lightlink2\" target=\"_top\">&nbsp;{$label}&nbsp;</a></p><br/>\n";
}

$admincol = $sitever == "mobile" ? "admincol-mobile" : "admincol";

tng_adminheader( $admtext['administration'], "" );
?>
<script type="text/javascript" src="js/admin.js?v<?php echo $tng_version; ?>"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	var tngadminmsg = getCookie('tngadminmsg');
	var tngadminbanner = getCookie('tngadminbanner');
	if(tngadminbanner == "collapse") {
		jQuery('#banner_toggle').attr('src','img/tng_expand_yellow.gif');
		jQuery('#admin-banner').css('height',"70px");
		jQuery('a.admincell').css('margin',"5px");
		jQuery('a.admincell').css('padding',"8px");
		tngadminmsg = "hide";
		setCookie('tngadminmsg',tngadminmsg,365);
	}
	if(tngadminmsg != "hide" && $('#msgs').length) {
		jQuery('#plus0').attr('src','img/tng_collapse_yellow.gif');
		jQuery('#msgs').toggle(300);
	}
});

function toggleMsg(section,img) {
	if(jQuery('#'+section).css('display') == "none") {
		setCookie('tngadminmsg',"",365);
		if(getCookie('tngadminbanner') == 'collapse')
			toggleBanner();
	}
	else
		setCookie('tngadminmsg',"hide",365);

	jQuery('#'+img).attr('src', jQuery('#'+img).attr('src').indexOf('collapse') > 0 ? 'img/tng_expand_yellow.gif' : 'img/tng_collapse_yellow.gif');
	jQuery('#'+section).toggle(300);

	return false;
}

function toggleBanner() {
	var tngadminbanner = getCookie('tngadminbanner');
	var tngadminmsg = getCookie('tngadminmsg');
	if(tngadminbanner == 'collapse') {
		jQuery('#banner_toggle').attr('src','img/tng_collapse_yellow.gif');
		setCookie('tngadminbanner',"",365);
		jQuery('#admin-banner').animate({ height: "200px" });
		jQuery('a.admincell').animate({ margin: "7px", padding: "10px" });
	}
	else {
		jQuery('#banner_toggle').attr('src','img/tng_expand_yellow.gif');
		setCookie('tngadminbanner',"collapse",365);
		jQuery('#admin-banner').animate({ height: "70px" });
		jQuery('a.admincell').animate({ margin: "5px", padding: "8px" });
		if(tngadminmsg != "hide")
			toggleMsg('msgs','plus0');
	}
	return false;
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}
</script>
</head>

<?php
	$showmenu = false;
	echo tng_adminlayout("", $showmenu);
?>
<div class="mainbox">
<?php
	if($sitever != "mobile") {
		$num_banners = 5;
		$next_banner = rand(1,$num_banners);
?>
		<div id="admin-banner" class="admin-banner">
<?php
		for($i = $num_banners; $i > 0; $i--) {
			echo "<img id=\"admin-banner{$i}\" class=\"admin-banner-img\" src=\"img/admin_banner{$next_banner}.jpg\">\n";
			$next_banner = $next_banner == 5 ? 1 : $next_banner + 1;
		}
		echo "<h1>{$admtext['administration']} <a href=\"#\" onclick=\"return toggleBanner();\" class=\"togglehead\"><img src=\"img/tng_collapse_yellow.gif\" title=\"toggle display\" alt=\"toggle display\" id=\"banner_toggle\" style=\"padding:10px 10px 5px 10px\"></a></h1>\n";
	}
	$messages = "";
	if( $allow_edit || $allow_add || $allow_delete ) {
		$total_users = getTotal($users_table);
		$total_people = getTotal($people_table, 1);
		$total_families = getTotal($families_table, 1);

		if( $allow_edit && $allow_add && $allow_delete && !$assignedtree ) {
			if(!$total_users)
				$messages .= "<li><a href=\"admin_newuser.php\">{$admtext['task_user']}</a></li>\n";

			//no tree?
			$total_trees = getTotal($trees_table);
			if(!$total_trees)
				$messages .= "<li><a href=\"admin_newtree.php\">{$admtext['task_tree']}</a></li>\n";

			//no people? import
			if(!$total_people)
				$messages .= "<li><a href=\"admin_dataimport.php\">{$admtext['importgedcom2']}</a> | <a href=\"admin_newperson.php\">{$admtext['task_people']}</a></li>\n";
			else if(!$total_families)
				$messages .= "<li><a href=\"admin_newfamily.php\">{$admtext['task_families']}</a></li>\n";

			//new users to review?
			$review_users = getTotal($users_table, "allow_living = \"-1\"");
			if($review_users)
				$messages .= "<li><a href=\"admin_reviewusers.php\">{$admtext['task_revusers']} ($review_users)</a></li>\n";

			//people or families to review?
			$review_people = getTotal("$people_table, $temp_events_table", "$people_table.personID = $temp_events_table.personID AND $people_table.gedcom = $temp_events_table.gedcom AND (type = \"I\" OR type = \"C\")");
			if($review_people)
				$messages .= "<li><a href=\"admin_findreview.php?type=I\">{$admtext['task_revind']} ($review_people)</a></li>\n";
			$review_families = getTotal("$families_table, $temp_events_table", "$families_table.familyID = $temp_events_table.familyID AND $families_table.gedcom = $temp_events_table.gedcom AND type = \"F\"");
			if($review_families)
				$messages .= "<li><a href=\"admin_findreview.php?type=F\">{$admtext['task_revfam']} ($review_families)</a></li>\n";

			//last backup more than x days ago?
			$backupmsg = "";
			$fullbackuppath = !empty($tngconfig['saveconfig']) ? $subroot . $backuppath : $rootpath . $backuppath;
			$files = array_merge(glob("$fullbackuppath/*.sql"), glob("$fullbackuppath/*.bak"));
			$daysSince = $tngconfig['backupdays'];
			if(count($files)) {
				//check dates
				usort($files, function($a,$b) {
					if(filemtime($a) == filemtime($b))
						return 0;
					else if(filemtime($a) < filemtime($b))
						return 1;
					else
						return -1;
				});
				$lastBackupTime = filemtime($files[0]);
				if($daysSince != "0") {
					if(!$daysSince) $daysSince = 30;
					if(time() - $lastBackupTime >= 60 * 60 * 24 * $daysSince)
						$backupmsg = preg_replace( "/xxx/", $daysSince, $admtext['lastbackup'] );
				}
			}
			else if($total_people && $daysSince != "0") {
				//no backup ever done
				$backupmsg = $admtext['nobackups'];
			}
			if($backupmsg)
				$messages .= "<li><a href=\"admin_utilities.php\">{$admtext['task_backup']} ($backupmsg)</a></li>\n";

			//need map key?
			if(!$map['key'] || $map['key'] == "1")
				$messages .= "<li><a href=\"admin_mapconfig.php\">{$admtext['task_mapkey']}</a></li>\n";
		}
	}

	$switcher = "";
	if($allow_admin) {
		$trees = explode(',',$_SESSION['availabletrees']);
		if(count($trees) > 1) {
			$query = "";
			foreach($trees as $t) {
				if($query) $query .= " UNION ";
				$query .= "SELECT gedcom, treename FROM $trees_table WHERE gedcom = \"$t\"";
			}
			$query .= " ORDER BY treename";
			$result = tng_query($query);
			$switcher .= "<form action=\"{$cms['tngpath']}switchtree.php\" target=\"_parent\" name=\"newtreeform\" style=\"display:inline-block\">\n";
			$switcher .= "<input type=\"hidden\" name=\"ret\" value=\"admin.php\">\n";
			$switcher .= "<select name=\"newtree\" class=\"normal\" onChange=\"document.newtreeform.submit();\">\n";
			while( $row = tng_fetch_assoc($result)) {
				$switcher .= "<option value=\"{$row['gedcom']}\"";
				if( $assignedtree == $row['gedcom'] )
					$switcher .= " selected";
				$switcher .= ">{$row['treename']}</option>\n";
			}
			$switcher .= "</select>\n</form>\n";
			tng_free_result($result);
		}
	}
	if($chooselang) {
		$query = "SELECT languageID, display, folder FROM $languages_table ORDER BY display";
		$result = @tng_query($query);

		if( $result && tng_num_rows( $result ) ) {
			$switcher .= "<form action=\"{$cms['tngpath']}admin_savelanguage.php\" method=\"GET\" target=\"_parent\" name=\"language\" style=\"display:inline-block\">\n";
			$switcher .= " &nbsp;<select name=\"newlanguage\" class=\"normal\" onChange=\"document.language.submit();\">\n";

			while( $row = tng_fetch_assoc($result)) {
				$switcher .= "<option value=\"{$row['languageID']}\"";
				if( $languages_path . $row['folder'] == $mylanguage )
					$switcher .= " selected";
				$switcher .= ">{$row['display']}</option>\n";
			}
			$switcher .= "</select>\n</form>\n";
			tng_free_result($result);
		}
	}

	if($switcher || (!$tngconfig['hidetasks'] && $messages)) {
		$messages = "<ul>\n$messages</ul>\n";
		$msgarea_class = $sitever != "mobile" ? " tngmsgarea-std" : "";
		$msgarea_style = !$tngconfig['hidetasks'] ? " style=\"min-width:400px\"" : ""; 
?>
			<div class="tngmsgarea<?php echo $msgarea_class; ?>"<?php echo $msgarea_style; ?>>
			<?php
				if(!$tngconfig['hidetasks'] && $messages) {
			?>
				<a href="#" onclick="return toggleMsg('msgs','plus0');" class="togglehead">
					<img src="img/tng_expand_yellow.gif" title="toggle display" alt="toggle display" id="plus0">
					<strong class="th-indent admintasks"><?php echo $admtext['tasks']; ?></strong>
				</a>
			<?php
				if($switcher)
					echo "<div style=\"float:right\">\n$switcher\n</div>\n";
			?>
				<div id="msgs" style="display:none">
					<hr/><?php echo $messages; ?>
				</div>
			<?php
				}
				else
					echo "<div style=\"float:right\">\n$switcher\n</div>\n";
			?>
			</div>
<?php
	}

	$menu = "";
	if( $allow_edit || $allow_add || $allow_delete ) {
		$menu .= adminMenuItem("admin_people.php", $admtext['people'], $total_people, "people");
		$menu .= adminMenuItem("admin_families.php", $admtext['families'], $total_families, "families");
		$menu .= adminMenuItem("admin_sources.php", $admtext['sources'], getTotal($sources_table, 2), "sources");
		$menu .= adminMenuItem("admin_repositories.php", $admtext['repositories'], getTotal($repositories_table, 2), "repos");
	}
	if( $allow_edit || $allow_add || $allow_delete || $allow_media_add || $allow_media_edit || $allow_media_delete ) {
		$menu .= adminMenuItem("admin_media.php", $admtext['media'], getTotal($media_table, 2), "photos");
		$menu .= adminMenuItem("admin_albums.php", $admtext['albums'], getTotal($albums_table), "albums");
	}
	if( $allow_edit || $allow_add || $allow_delete ) {
		$menu .= adminMenuItem("admin_cemeteries.php", $admtext['cemeteries'], getTotal($cemeteries_table), "cemeteries");
		$menu .= adminMenuItem("admin_places.php", $admtext['places'], getTotal($places_table, (!$assignedtree || $tngconfig['places1tree'] ? "" : 2)), "places");
	}
	if( $allow_edit && $allow_add && $allow_delete && !$assignedbranch ) {
		$menu .= adminMenuItem("admin_dataimport.php", $admtext['datamaint'], "", "data");
	}
	if( $allow_edit && $allow_add && $allow_delete && !$assignedtree ) {
		$menu .= adminMenuItem("admin_trees.php", $admtext['trees'], $total_trees, "trees");
		if( !$assignedbranch ) {
			$menu .= adminMenuItem("admin_branches.php", $admtext['branches'], getTotal($branches_table, 2), "branches");
		}
		$menu .= adminMenuItem("admin_eventtypes.php", $admtext['customeventtypes'], getTotal($eventtypes_table), "customeventtypes");
		if(empty($tngconfig['hidedna']))
			$menu .= adminMenuItem("admin_dna_tests.php", $admtext['dna_tests'], getTotal($dna_tests_table), "dna");
	}
	if( $allow_edit || $allow_delete )
		$menu .= adminMenuItem("admin_notelist.php", $admtext['notes'], getTotal($notelinks_table,2), "notes");
	if( $allow_edit || $allow_add || $allow_delete ) {
		$menu .= adminMenuItem("admin_timelineevents.php", $admtext['tlevents'], getTotal($tlevents_table), "tlevents");
	}
	if( $allow_edit && $allow_add && $allow_delete ) {
		$menu .= adminMenuItem("admin_misc.php", $admtext['misc'], "", "misc");
	}
	if( $allow_edit && $allow_add && $allow_delete && !$assignedtree ) {
		$menu .= adminMenuItem("admin_setup.php", $admtext['setup'], "", "setup");
		$menu .= adminMenuItem("admin_utilities.php", $admtext['backuprestore'], "", "backuprestore");
		$menu .= adminMenuItem("admin_users.php", $admtext['users'], $total_users, "users");
		$menu .= adminMenuItem("admin_languages.php", $admtext['languages'], getTotal($languages_table), "languages");
		$menu .= adminMenuItem("admin_reports.php", $admtext['reports'], getTotal($reports_table), "reports");
		if(!$tngconfig['hidetotals']) {
			$mods_installed = $all_mods = 0;
	  		if( !empty( $mm_data ) ) {
	  			foreach( $mm_data as $index => $subkey ) {
	  				if( $subkey['status'] == 1 ) $mods_installed++;
	  				$all_mods++;
	  			}
	  		}
			$mods_count = $all_mods != $mods_installed ? $mods_installed . '/' . $all_mods : $all_mods;
		}
		else
			$mods_count = "";
		$menu .= adminMenuItem("admin_modhandler.php", $admtext['modmgr'], $mods_count, "modmgr");
		//$menu .= adminMenuItem("admin_modhandler.php", $admtext['modmgr'], count(glob("mods/*.cfg")), "modmgr");
	}
	if($menu_count) {
		$rows = ceil($menu_count/3);
		$menu_grid_str = " style=\"grid-template-rows: repeat($rows, auto)\"";
	}
	else
		$menu_grid_str = "";
	if($sitever != "mobile")
		echo "</div>\n"; // end of banner div
?>
			<div class="<?php echo $admincol; ?>"<?php echo $menu_grid_str; ?>>
<?php 
	echo $menu;

	$newsitever = getSiteVersion();
	switch($newsitever) {
		case "standard":
			if($newsitever != $sitever)
				echo switcherLink("standard",$text['switchs']);
			break;
		case "mobile":
			if($newsitever != $sitever)
				echo switcherLink("mobile",$text['switchm']);
			else
				echo switcherLink("standard",$text['switchs']);
			break;
		default: //tablet
			$target = $newsitever != $sitever ? "tablet" : "standard";
			echo switcherLink($target,$text['switchs']);
			echo switcherLink("mobile",$text['switchm']);
			break;
	}
?>
			</div>
		</div>
	</div>
</div>

<?php
echo tng_adminfooter();
?>