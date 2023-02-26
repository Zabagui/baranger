<?php
global $admtext, $allow_edit, $allow_delete, $allow_add, $assignedtree, $assignedbranch, $allow_media_add, $allow_media_edit, $allow_media_delete, $tngconfig;

$output .= "<div id=\"adminslidebar\" onclick=\"toggleAdminMenu();\">\n";
$arrow = isset($_SESSION['tng_menuhidden']) && $_SESSION['tng_menuhidden'] == "on" ? "ArrowRight.gif" : "ArrowLeft.gif";
$output .= "<img src=\"img/{$arrow}\" alt=\"\" id=\"dirarrow\"><br/>\n";
$output .= "</div>\n";

$menu = array();
if( $allow_edit || $allow_add || $allow_delete ) {
	$output .= "<strong><a href=\"admin.php\" class=\"lightlink2 leftlink\">{$admtext['administration']}</a></strong>\n";
	$menu[] = "<a href=\"admin_people.php\" class=\"lightlink2 leftlink\">{$admtext['people']}</a>\n";
	$menu[] = "<a href=\"admin_families.php\" class=\"lightlink2 leftlink\">{$admtext['families']}</a>\n";
	$menu[] = "<a href=\"admin_sources.php\" class=\"lightlink2 leftlink\">{$admtext['sources']}</a>\n";
	$menu[] = "<a href=\"admin_repositories.php\" class=\"lightlink2 leftlink\">{$admtext['repositories']}</a>\n";
}
if( $allow_edit || $allow_add || $allow_delete || $allow_media_add || $allow_media_edit || $allow_media_delete ) {
	$menu[] = "<a href=\"admin_media.php\" class=\"lightlink2 leftlink\">{$admtext['media']}</a>\n";
	$menu[] = "<a href=\"admin_albums.php\" class=\"lightlink2 leftlink\">{$admtext['albums']}</a>\n";
}
if( $allow_edit || $allow_add || $allow_delete ) {
	$menu[] = "<a href=\"admin_cemeteries.php\" class=\"lightlink2 leftlink\">{$admtext['cemeteries']}</a>\n";
	$menu[] = "<a href=\"admin_places.php\" class=\"lightlink2 leftlink\">{$admtext['places']}</a>\n";
}
if( $allow_edit && $allow_add && $allow_delete && !$assignedbranch ) {
	$menu[] = "<a href=\"admin_dataimport.php\" class=\"lightlink2 leftlink\">{$admtext['datamaint']}</a>\n";
}
if( $allow_edit && $allow_add && $allow_delete && !$assignedtree ) {
	$menu[] = "<a href=\"admin_trees.php\" class=\"lightlink2 leftlink\">{$admtext['trees']}</a>\n";
	if( !$assignedbranch ) {
		$menu[] = "<a href=\"admin_branches.php\" class=\"lightlink2 leftlink\">{$admtext['branches']}</a>\n";
	}
	$menu[] = "<a href=\"admin_eventtypes.php\" class=\"lightlink2 leftlink\">{$admtext['customeventtypes']}</a>\n";
	if(empty($tngconfig['hidedna']))
		$menu[] = "<a href=\"admin_dna_tests.php\" class=\"lightlink2 leftlink\">{$admtext['dna_tests']}</a>\n";
}

if( $allow_edit || $allow_delete ) {
	$menu[] = "<a href=\"admin_notelist.php\" class=\"lightlink2 leftlink\">{$admtext['notes']}</a>\n";
}
if( $allow_edit || $allow_add || $allow_delete ) {
	$menu[] = "<a href=\"admin_timelineevents.php\" class=\"lightlink2 leftlink\">{$admtext['tlevents']}</a>\n";
}
if( $allow_edit && $allow_add && $allow_delete && !$assignedtree ) {
	$menu[] = "<a href=\"admin_misc.php\" class=\"lightlink2 leftlink\">{$admtext['misc']}</a>\n";
	$menu[] = "<a href=\"admin_setup.php\" class=\"lightlink2 leftlink\">{$admtext['setup']}</a>\n";
	$menu[] = "<a href=\"admin_users.php\" class=\"lightlink2 leftlink\">{$admtext['users']}</a>\n";
	$menu[] = "<a href=\"admin_utilities.php\" class=\"lightlink2 leftlink\">{$admtext['backuprestore']}</a>\n";
	$menu[] = "<a href=\"admin_languages.php\" class=\"lightlink2 leftlink\">{$admtext['languages']}</a>\n";
	$menu[] = "<a href=\"admin_reports.php\" class=\"lightlink2 leftlink\">{$admtext['reports']}</a>\n";
	$menu[] = "<a href=\"admin_modhandler.php\" class=\"lightlink2 leftlink\">{$admtext['modmgr']}</a>\n";
}

$total_items = count($menu);
$one_third = ceil($total_items/3);
for($i = 0; $i < $total_items; $i++) {
	$output .= $menu[$i];
	if($i + 1 == $one_third) {
		$output .= "<hr class=\"admindivider\"/><br/>";
		$one_third += $one_third;
	}
}

$output .= "<br/><br/><br/><br/>";
?>