<?php
include("begin.php");
$maint = $tngconfig['maint'];
$tngconfig['maint'] = "";
include($subroot . "mapconfig.php");
include("adminlib.php");
$textpart = "index";
//include("getlang.php");
include("$mylanguage/admintext.php");
$admin_login = 2;

include("checklogin.php");
include("version.php");

function adminMenuItem($destination, $label, $number, $message, $icon) {
	global $sitever;

	$menu = "";
	if($sitever == "mobile")
		$iconstr = $msgstr = "";
	else {
		$iconstr = "<img src=\"img/{$icon}_icon.gif\" alt=\"{$label}\" class=\"adminicon\">\n";
		$msgstr = "<div class=\"adminsubmsg\">$message</div>\n";
	}

	$menu .= "<a href=\"$destination\" class=\"lightlink2 admincell fieldnameback\">\n";
	$menu .= $iconstr;
	if($number)
		$menu .= "<div class=\"admintotal\" style=\"float:right\"><strong>" . number_format($number) . "</strong></div>\n";
	$menu .= "<div class=\"adminsubhead\"><strong>$label</strong></div>\n";
	$menu .= $msgstr;
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

if($sitever != "mobile") {
	$genmsg = $mediamsg = "";
	if( $allow_add ) {
		$genmsg .= $admtext['add'] . " | ";
		$mediamsg = $genmsg;
	}
	elseif( $allow_media_add )
		$mediamsg = $admtext['add'] . " | ";
	$genmsg .= $admtext['find2'] . " | ";
	$mediamsg .$admtext['find2'] . " | ";
	$notesmsg = $admtext['find2'] . " | ";
	if( $allow_edit ) {
		$genmsg .= $admtext['edit'] . " | ";
		$mediamsg .= $admtext['edit'] . " | ";
		$notesmsg .= $admtext['edit'] . " | ";
	}
	elseif( $allow_media_edit )
		$mediamsg .= $admtext['edit'] . " | ";
	if( $allow_delete ) {
		$genmsg .= $admtext['text_delete'] . " | ";
		$mediamsg .= $admtext['text_delete'] . " | ";
		$notesmsg .= $admtext['text_delete'] . " | ";
	}
	elseif( $allow_media_delete )
		$mediamsg .= $admtext['text_delete'] . " | ";
	$sourcesmsg = $peoplemsg = $familiesmsg = $treesmsg = $cemeteriesmsg = $timelinemsg = $placesmsg = $genmsg;
	$mediamsg .= $admtext['text_sort'];
	if( $allow_edit ) {
		$peoplemsg .= $admtext['reviewsh'] . " | ";
		$familiesmsg .= $admtext['reviewsh'] . " | ";
	}
	if( $allow_edit && $allow_delete ) {
		$peoplemsg .= $admtext['merge'] . " | ";
		$placesmsg .= $admtext['merge'] . " | ";
		$sourcesmsg .= $admtext['merge'] . " | ";
	}
	$treesmsg = substr( $treesmsg, 0, -3 );
	$peoplemsg = substr( $peoplemsg, 0, -3 );
	$familiesmsg = substr( $familiesmsg, 0, -3 );
	$sourcesmsg = substr( $sourcesmsg, 0, -3 );
	$cemeteriesmsg = substr( $cemeteriesmsg, 0, -3 );
	$placesmsg = substr( $placesmsg, 0, -3 );
	$timelinemsg = substr( $timelinemsg, 0, -3 );
	$notesmsg = substr( $notesmsg, 0, -3 );
}
else
	$sourcesmsg = $peoplemsg = $familiesmsg = $treesmsg = $cemeteriesmsg = $timelinemsg = $placesmsg = $genmsg = $notesmsg = "";

tng_adminheader( $admtext['administration'], "" );
?>
<script type="text/javascript" src="js/admin.js?v<?php echo $tng_version; ?>"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	var tngadminmsg = getCookie('tngadminmsg');
	if(tngadminmsg != "hide" && $('#msgs').length)
		toggleSection('msgs','plus0');
	//php: if no msg, then insert javascript to unset the cookie
});

function toggleMsg(section,img,display) {
	if(jQuery('#'+section).css('display') == "none")
		setCookie('tngadminmsg',"",365);
	else
		setCookie('tngadminmsg',"hide",365);
	toggleSection(section,img,display);

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
	echo tng_adminlayout("mainback");
?>
<table border="0" cellspacing="0" cellpadding="0" class="mainbox">
<?php
	//no users?
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
			$files = glob("$rootpath$backuppath/*.bak");
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

	if(!$tngconfig['hidetasks'] && $messages) {
		$messages = "<ul>\n$messages</ul>\n";
?>
	<tr>
		<td class="admincol" colspan="2">
			<div class="tngmsgarea">
				<a href="#" onclick="return toggleMsg('msgs','plus0');" class="togglehead">
					<img src="img/tng_expand.gif" title="toggle display" alt="toggle display" id="plus0">
					<strong class="th-indent adminsubhead"><?php echo $admtext['tasks']; ?></strong>
				</a>
				<div id="msgs" style="display:none">
					<hr/><?php echo $messages; ?>
				</div>
			</div>
		</td>
	</tr>
<?php
	}
?>
	<tr>
		<td class="admincol">
<?php
	if( $allow_edit || $allow_add || $allow_delete ) {
		echo adminMenuItem("admin_people.php", $admtext['people'], $total_people, $peoplemsg, "people");
		echo adminMenuItem("admin_families.php", $admtext['families'], $total_families, $familiesmsg, "families");
		echo adminMenuItem("admin_sources.php", $admtext['sources'], getTotal($sources_table, 2), $sourcesmsg, "sources");
		echo adminMenuItem("admin_repositories.php", $admtext['repositories'], getTotal($repositories_table, 2), $sourcesmsg, "repos");
	}
	if( $allow_edit || $allow_add || $allow_delete || $allow_media_add || $allow_media_edit || $allow_media_delete ) {
		echo adminMenuItem("admin_media.php", $admtext['media'], getTotal($media_table, 2), $mediamsg, "photos");
		echo adminMenuItem("admin_albums.php", $admtext['albums'], getTotal($albums_table), $mediamsg, "albums");
	}
	if( $allow_edit || $allow_add || $allow_delete ) {
		echo adminMenuItem("admin_cemeteries.php", $admtext['cemeteries'], getTotal($cemeteries_table), $cemeteriesmsg, "cemeteries");
		echo adminMenuItem("admin_places.php", $admtext['places'], getTotal($places_table, (!$assignedtree || $tngconfig['places1tree'] ? "" : 2)), $placesmsg, "places");
		echo adminMenuItem("admin_timelineevents.php", $admtext['tlevents'], getTotal($tlevents_table), $timelinemsg, "tlevents");
	}
	if( $allow_edit || $allow_delete )
		echo adminMenuItem("admin_notelist.php", $admtext['notes'], getTotal($notelinks_table,2), $notesmsg, "notes");
	if( $allow_edit && $allow_add && $allow_delete && !$assignedtree ) {
		echo adminMenuItem("admin_misc.php", $admtext['misc'], "", $admtext['miscitems'], "misc");
	}
	if($sitever != "mobile") {
?>
		</td>
		<td class="admincol">
<?php
	}
	if( $allow_edit && $allow_add && $allow_delete && !$assignedbranch ) {
		echo adminMenuItem("admin_dataimport.php", $admtext['datamaint'], "", $admtext['importgedcom2'], "data");
	}
	if( $allow_edit && $allow_add && $allow_delete && !$assignedtree ) {
		echo adminMenuItem("admin_setup.php", $admtext['setup'], "", $admtext['setupitems'], "setup");
		echo adminMenuItem("admin_users.php", $admtext['users'], $total_users, $admtext['usersitems'], "users");
		echo adminMenuItem("admin_trees.php", $admtext['trees'], $total_trees, $treesmsg, "trees");

		if( !$assignedbranch ) {
			echo adminMenuItem("admin_branches.php", $admtext['branches'], getTotal($branches_table, 2), $treesmsg, "branches");
		}

		echo adminMenuItem("admin_eventtypes.php", $admtext['customeventtypes'], getTotal($eventtypes_table), $admtext['custeventitems'], "customeventtypes");
		echo adminMenuItem("admin_reports.php", $admtext['reports'], getTotal($reports_table), $admtext['reportsitems'], "reports");
		echo adminMenuItem("admin_dna_tests.php", $admtext['dna_tests'], getTotal($dna_tests_table), $admtext['dna_blurb'], "dna");
		echo adminMenuItem("admin_languages.php", $admtext['languages'], getTotal($languages_table), $treesmsg, "languages");
		echo adminMenuItem("admin_utilities.php", $admtext['backuprestore'], "", $admtext['backupitems'], "backuprestore");
		echo adminMenuItem("admin_modhandler.php", $admtext['modmgr'], "", $admtext['mmgritems'], "modmgr");
	}
?>
		</td>
	</tr>
</table>
<?php
	$newsitever = getSiteVersion(true);
	if($sitever == "mobile") {
		echo "<p class=\"smaller\"><a href=\"admin.php?sitever=$newsitever\" class=\"fieldnameback lightlink2\" target=\"_top\">&nbsp;{$text['switchs']}&nbsp;</a></p>\n";
	}
	else if($sitever != $newsitever) {
		echo "<p class=\"smaller\"><a href=\"admin.php?sitever=mobile\" class=\"fieldnameback lightlink2\" target=\"_top\">&nbsp;{$text['switchm']}&nbsp;</a></p>\n\n";
	}

echo tng_adminfooter();
?>