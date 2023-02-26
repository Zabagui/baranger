<?php
include("begin.php");
include("adminlib.php");
$textpart = "secondary";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( $assignedtree ) {
	$wherestr = "WHERE gedcom = \"$assignedtree\"";
	$tree = $assignedtree;
}
else {
	$wherestr = "";
	if( empty($tree) && isset( $_COOKIE['tng_sec_post']['tree']) )
		$tree = $_COOKIE['tng_sec_post']['tree'];
}

$query = "SELECT gedcom, treename FROM $trees_table $wherestr ORDER BY treename";
$result = tng_query($query);

$helplang = findhelp("second_help.php");

tng_adminheader( $admtext['secondary'], $flags );
?>
<script type="text/javascript" src="js/admin.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('.secutil').bind('click',function(e) {
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

	$allow_export = 1;
	if( !$allow_ged && $assignedtree ) {
		$query = "SELECT disallowgedcreate FROM $trees_table WHERE gedcom = \"$assignedtree\"";
		$disresult = tng_query($query);
		$row = tng_fetch_assoc( $disresult );
		if($row['disallowgedcreate'])
			$allow_export = 0;
		tng_free_result($disresult);
	}

	$datatabs[0] = array(1,"admin_dataimport.php",$admtext['import'],"import");
	$datatabs[1] = array($allow_export,"admin_export.php",$admtext['export'],"export");
	$datatabs[2] = array(1,"admin_secondmenu.php",$admtext['secondary'],"second");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/second_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($datatabs,"second",$innermenu);
	echo displayHeadline($admtext['datamaint'] . " &gt;&gt; " . $admtext['secondary'], "img/data_icon.gif", $menu, (isset($message) ? $message : ""));

	$utils = array($admtext['tracklines'],$admtext['sortchildren'],$admtext['sortspouses'],$admtext['relabelbranches'],$admtext['creategendex'],$admtext['evalmedia'],$admtext['refreshliving'],$admtext['makeprivate']);
?>

<div class="admin-main">
	<div class="databack admin-block">
	<form action="admin_secondary.php" method="post" name="form1">
	<span class="normal"><?php echo $admtext['tree'];?>: <select name="tree" id="treequeryselect">
<?php
if( !$assignedtree )
	echo "	<option value=\"--all--\">{$admtext['alltrees']}</option>\n";
while( $row = tng_fetch_assoc($result) ) {
	echo "	<option value=\"{$row['gedcom']}\"";
	if( isset($tree) && $row['gedcom'] == $tree ) echo " selected";
	echo ">{$row['treename']}</option>\n";
}
?>
	</select><br/><br/></span>
	</form>

	<table cellpadding="5" cellspacing="1" border="0" class="normal rounded-table" style="min-width:400px">
		<tr>
			<td class="fieldnameback fieldname" style="width:10px">&nbsp;<b>#</b>&nbsp;</td>
			<td class="fieldnameback fieldname">&nbsp;<b><?php echo $admtext['utility']; ?></b>&nbsp;</td>
		</tr>
<?php
	$i = 1;
	foreach($utils as $util) {
?>
		<tr>
			<td class="lightback" align="right">&nbsp;<?php echo $i; ?></td>
			<td class="lightback">&nbsp;<a href="admin_secondary.php?secaction=<?php echo $util; ?>&amp;tree=<?php echo $assignedtree; ?>" class="secutil"><?php echo $util; ?></a></td>
		</tr>
<?php
		$i++;
	}
?>
	</table>

	<p class="normal"><?php echo $admtext['postgdx']; ?>:<br/>
		<!-- &raquo; <a href="https://gendexnetwork.org" target="_blank">GenDex Network</a><br/> -->
		&raquo; <a href="https://www.familytreeseeker.com" target="_blank">FamilyTreeSeeker.com</a>
	</p>
	</div>
</div>
<?php 
echo tng_adminfooter();
?>
