<?php
include("begin.php");
include("adminlib.php");
$textpart = "setup";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( $assignedtree ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$query = "SELECT gedcom, treename FROM $trees_table ORDER BY treename";
$result = tng_query($query);

$helplang = findhelp("backuprestore_help.php");

tng_adminheader( $admtext['backuprestore'], $flags );
?>
</head>

<?php
	echo tng_adminlayout();

	$utiltabs[0] = array(1,"admin_utilities.php?sub=tables",$admtext['tables'],"tables");
	$utiltabs[1] = array(1,"admin_utilities.php?sub=structure",$admtext['tablestruct'],"structure");
	$utiltabs[2] = array(1,"admin_renumbermenu.php",$admtext['renumber'],"renumber");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/backuprestore_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($utiltabs,"renumber",$innermenu);
	$headline = $admtext['backuprestore'] . " &gt;&gt; " . $admtext['renumber'];
	echo displayHeadline($headline,"img/backuprestore_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">
	<p class="normal"><?php echo $admtext['reseqwarn']; ?></p>

	<p class="subhead"><strong><?php echo $admtext['renumber']; ?></strong></p>
	<form action="admin_renumber.php" method="post" name="form1" >
	<table class="normal rounded-table">
		<tr>
			<td><?php echo $admtext['tree'];?>:</td>
			<td>
				<select name="tree">
<?php
while( $row = tng_fetch_assoc($result) ) {
	echo "	<option value=\"{$row['gedcom']}\">{$row['treename']}</option>\n";
}
?>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo $admtext['idtype'];?>:</td>
			<td>
				<select name="type">
					<option value="person"><?php echo $admtext['people'];?></option>
					<option value="family"><?php echo $admtext['families'];?></option>
					<option value="source"><?php echo $admtext['sources'];?></option>
					<option value="repo"><?php echo $admtext['repositories'];?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo $admtext['mindigits'];?>*:</td>
			<td>
				<select name="digits">
<?php
	for($i = 1; $i <= 20; $i++ )
		echo "<option value=\"$i\">$i</option>\n";
?>
				</select>
			</td>
		</tr>
		<!--<tr>
			<td><?php echo $admtext['useroffset'];?>*:</td>
			<td><input type="text" name="start" value="1" /></td>
		</tr>-->
	</table><br />
	<input type="hidden" name="start" value="1" />
	<input type="submit" class="btn" value="<?php echo $admtext['renumber']; ?>"<?php if(!$tngconfig['maint']) echo " disabled"; ?>>
<?php
	if(!$tngconfig['maint'])
		echo "<span class=\"normal\">{$admtext['needmaint']}</span>";
?>
	<br /><br />
<?php echo "<p class=\"normal\">*{$admtext['niprefix']}</p>\n"; ?>
	</form>
</div>
<?php 
echo tng_adminfooter();
?>