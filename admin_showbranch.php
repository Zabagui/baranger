<?php
include("begin.php");
include("adminlib.php");
$textpart = "branches";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( !$allow_edit || ( $assignedtree && $assignedtree != $tree ) ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$query = "SELECT treename FROM $trees_table WHERE gedcom = \"$tree\"";
$result = tng_query($query);
$row = tng_fetch_assoc($result);
tng_free_result( $result );

$query = "SELECT description FROM $branches_table WHERE gedcom = \"$tree\" and branch = \"$branch\"";
$result = tng_query($query);
$brow = tng_fetch_assoc($result);
tng_free_result( $result );

$query = "SELECT personID, firstname, lastname, lnprefix, prefix, suffix, title, branch, gedcom, nameorder, living, private, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr FROM $people_table WHERE gedcom = \"$tree\" and branch LIKE \"%$branch%\" ORDER BY lastname, firstname";
$brresult = tng_query($query);

$helplang = findhelp("branches_help.php");

tng_adminheader( $admtext['labelbranches'], $flags );
?>
</head>

<?php
	echo tng_adminlayout();

	$branchtabs[0] = array(1,"admin_branches.php",$admtext['search'],"findbranch");
	$branchtabs[1] = array($allow_add,"admin_newbranch.php",$admtext['addnew'],"addbranch");
	$branchtabs[2] = array($allow_edit,"#",$admtext['labelbranches'],"label");
	$innermenu = "<a href=\"javascript:newwindow=window.open('../$helplang/branches_help.php#labelbranch');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($branchtabs,"label",$innermenu);
	echo displayHeadline($admtext['branches'] . " &gt;&gt; " . $admtext['labelbranches'],"img/branches_icon.gif",$menu,$message);
?>

<table width="100%" border="0" cellpadding="10" cellspacing="2" class="lightback">
<tr class="databack">
<td class="tngshadow">
	<table border="0" cellpadding="1">
		<tr>
			<td><span class="normal"><strong><?php echo $admtext['tree']; ?>:</strong></span></td>
			<td><span class="normal"><?php echo $row['treename']; ?></span></td>
		</tr>
		<tr>
			<td><span class="normal"><strong><?php echo $admtext['branch']; ?>:</strong></span></td>
			<td><span class="normal"><?php echo $brow['description']; ?></span></td>
		</tr>
		<tr>
			<td colspan="2">
			<span class="normal"><br/>
<?php
	echo "<p class=\"adminnav\"><a href=\"admin_branchmenu.php?tree=$tree&amp;branch=$branch\" class=\"snlink\">{$admtext['labelbranches']}</a></p>\n";
	while( $row = tng_fetch_assoc($brresult)) {
		$rights = determineLivingPrivateRights($row, true, true);
		$row['allow_living'] = $rights['living'];
		$row['allow_private'] = $rights['private'];

		echo "<a href=\"admin_editperson.php?personID={$row['personID']}&amp;tree={$row['gedcom']}&amp;cw=1\" target=\"_blank\">" . getNameRev( $row ) . " ({$row['personID']})</a><br />\n";
	}
	tng_free_result( $brresult );
?>				
			</span>
			</td>
		</tr>
	</table>
	<br/>
</td>
</tr>
</table>
<?php 
echo tng_adminfooter();
?>