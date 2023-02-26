<?php
include("begin.php");
include("adminlib.php");
$textpart = "misc";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

$helplang = findhelp("misc_help.php");

if( $assignedtree ) {
	$wherestr = "WHERE gedcom = \"$assignedtree\"";
	$tree = $assignedtree;
}
else {
	$wherestr = "";
	if( empty($tree) && isset( $_COOKIE['tng_val_post']['tree']) )
		$tree = $_COOKIE['tng_val_post']['tree'];
}

$treequery = "SELECT gedcom, treename FROM $trees_table $wherestr ORDER BY treename";
$treeresult = tng_query($treequery) or die ($admtext['cannotexecutequery'] . ": $treequery");
$treenum = 0;
while( $treerow = tng_fetch_assoc($treeresult) ) {
	$treenum++;
	$trees[$treenum] = $treerow['gedcom'];
	$treename[$treenum] = $treerow['treename'];
}
tng_free_result($treeresult);

tng_adminheader( $admtext['dataval'], $flags );
?>
<script type="text/javascript" src="js/admin.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('.valreport').bind('click',function(e) {
		var linkval = $(this).attr('href');
		var treeid = $('#treequeryselect').val();
		$(this).attr('href',linkval + treeid);
		//window.location.href = linkval + treeid;
		//return false;
	});
});
</script>
</head>

<?php
	echo tng_adminlayout();

	$misctabs[0] = array(1,"admin_misc.php",$admtext['menu'],"misc");
	$misctabs[1] = array(1,"admin_whatsnewmsg.php",$admtext['whatsnew'],"whatsnew");
	$misctabs[2] = array(1,"admin_mostwanted.php",$admtext['mostwanted'],"mostwanted");
	$misctabs[3] = array(1,"admin_data_validation.php",$admtext['dataval'],"validation");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/misc_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($misctabs,"validation",$innermenu);
	echo displayHeadline($admtext['misc'] . " &gt;&gt; " . $admtext['dataval'],"img/misc_icon.gif",$menu,$message);

	$reports = array('wr_gender','unk_gender','marr_young','marr_aft_death','marr_bef_birth','died_bef_birth','parents_younger','children_late','not_living','not_dead');
?>

<div class="admin-main">
	<div class="databack admin-block">
	<p class="subhead"><strong><?php echo $admtext['dataval']; ?></strong></p>

<?php
	if(!$assignedtree) {
?>
	<form action="admin_people.php" name="form1">
	<table>
		<tr>
			<td><span class="normal"><?php echo $admtext['tree']; ?>: </span></td>
			<td>
<?php
	echo "<select name=\"tree\" id=\"treequeryselect\">";
		echo "	<option value=\"\">{$admtext['alltrees']}</option>\n";
	$treeresult = tng_query($treequery) or die ($admtext['cannotexecutequery'] . ": $treequery");
	while( $treerow = tng_fetch_assoc($treeresult) ) {
		echo "	<option value=\"{$treerow['gedcom']}\"";
		if( isset($tree) && $treerow['gedcom'] == $tree ) echo " selected";
		echo ">{$treerow['treename']}</option>\n";
	}
	tng_free_result($treeresult);
?>
			</td>
		</tr>
	</table>
	</form><br />
<?php
	}
?>
	<table cellpadding="5" cellspacing="1" border="0" class="normal rounded-table">
		<tr>
			<td class="fieldnameback fieldname">&nbsp;<b>#</b>&nbsp;</td>
			<td class="fieldnameback fieldname">&nbsp;<b><?php echo $admtext['report']; ?></b>&nbsp;</td>
		</tr>
<?php
	$num_reports = count($reports);
	for($i = 1; $i <= $num_reports; $i++) {
		$this_report = $reports[$i-1];
?>
		<tr>
			<td class="lightback" align="right">&nbsp;<?php echo $i; ?></td>
			<td class="lightback">&nbsp;<a href="admin_valreport.php?report=<?php echo $this_report; ?>&amp;tree=<?php echo $assignedtree; ?>" class="valreport"><?php echo $admtext[$this_report]; ?></a></td>
		</tr>
<?php
	}
?>
	</table>
	</div>
</div>
<?php 
echo tng_adminfooter();
?>