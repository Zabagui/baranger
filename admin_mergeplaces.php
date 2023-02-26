<?php
include("begin.php");
include("adminlib.php");
$textpart = "findplace";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( !isset($place) ) $place = "";
if( !isset($place2) ) $place2 = "";

if( empty($tree) )
	$tree = isset($_COOKIE['tng_tree']) ? $_COOKIE['tng_tree'] : "";
if( !empty($place) ) {
	$useplace = addslashes($place);
	setcookie("tng_merge_places_post[place]", $useplace, 0);
	setcookie("tng_tree", $tree, 0);
	if($place2) {
		$useplace2 = addslashes($place2);
		setcookie("tng_merge_places_post[place2]", $useplace2, 0);
	}

    $pwherestr = "place LIKE \"%$useplace%\"";
    if($place2)
        $pwherestr = "($pwherestr OR place LIKE \"%$useplace2%\")";
	$query = "SELECT ID, place, longitude, latitude, gedcom FROM $places_table
		WHERE ";
	if(!$tngconfig['places1tree']) {
		$query .= "gedcom = \"$tree\" AND ";
		$treestr = "&tree=$tree";
	}
	else
		$treestr = "";
	$query .= $pwherestr . " ORDER BY place, gedcom, ID";
	$result = tng_query($query);

	$numrows = tng_num_rows( $result );
	if( !$numrows )
		$message = $admtext['noresults'];
}
else {
	$numrows = 0;
	if( !empty($_COOKIE['tng_merge_search_post']['search']) )
		$place = $_COOKIE['tng_search_places_post']['search'];
	else if( !empty($_COOKIE['tng_merge_places_post']['place']) ) {
		$place = stripslashes($_COOKIE['tng_merge_places_post']['place']);
		$place2 = stripslashes($_COOKIE['tng_merge_places_post']['place2']);
	}
}

$treequery = "SELECT gedcom, treename FROM $trees_table ORDER BY treename";

$helplang = findhelp("places_help.php");

tng_adminheader( $admtext['mergeplaces'], $flags );
?>
<script type="text/javascript" src="js/mergeplaces.js"></script>
<script type="text/javascript">
var enterplace = "<?php echo $admtext['enterplace']; ?>";
var enterkeep = "<?php echo $admtext['enterkeep']; ?>";
var successmsg = "<?php echo $admtext['pmsucc']; ?>";

function resetFields() {
	document.form1.place.value = "";
	document.form1.place2.value = "";
	return false;
}
</script>
</head>

<?php
	echo tng_adminlayout();

	$placetabs[0] = array(1,"admin_places.php",$admtext['search'],"findplace");
	$placetabs[1] = array($allow_add,"admin_newplace.php",$admtext['addnew'],"addplace");
	$placetabs[2] = array($allow_edit && $allow_delete,"admin_mergeplaces.php",$admtext['merge'],"merge");
	$placetabs[3] = array($allow_edit,"admin_geocodeform.php",$admtext['geocode'],"geo");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/places_help.php#merge');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($placetabs,"merge",$innermenu);
	echo displayHeadline($admtext['places'] . " &gt;&gt; " . $admtext['mergeplaces'], "img/places_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">
	<span class="subhead"><strong>1. <?php echo $admtext['findmerge']; ?></strong></span><br/><br/>

	<form action="admin_mergeplaces.php" method="post" name="form1" onSubmit="return validateForm1();">
	<table class="normal">
<?php
	if(!$tngconfig['places1tree']) {
?>
	<tr>
		<td><?php echo $admtext['tree']; ?>:</td>
		<td>
			<select name="tree">
<?php
		$treeresult = tng_query($treequery) or die ($admtext['cannotexecutequery'] . ": $treequery");
		while( $treerow = tng_fetch_assoc($treeresult) ) {
	   		echo "		<option value=\"{$treerow['gedcom']}\"";
			if( $treerow['gedcom'] == $tree ) echo " selected";
			echo ">{$treerow['treename']}</option>\n";
		}
		tng_free_result($treeresult);
?>
			</select>
		</td>
	</tr>
<?php
	}
?>
	<tr>
        <td><?php echo $admtext['searchfor']; ?>:</td>
        <td><input type="text" name="place" size="50" value="<?php echo htmlspecialchars(stripslashes($place)); ?>"></td>
    </tr>
	<tr>
        <td><?php echo $admtext['text_or']; ?>:</td>
        <td><input type="text" name="place2" size="50" value="<?php echo htmlspecialchars(stripslashes($place2)); ?>"></td>
    </tr>
	</table><br/>
	<input type="submit" name="submit" value="<?php echo $admtext['text_continue']; ?>">
	<input type="submit" name="reset" value="<?php echo $admtext['reset']; ?>" onclick="return resetFields()">
	</form>
<?php
	if($place && $numrows) {
?>
	<br /><br />

	<p class="subhead"><strong>2. <?php echo $admtext['selectplacemerge']; ?></strong></p>

	<form action="" method="post" onSubmit="return validateForm2(this);" name="form2" >
    <p><input type="submit" value="<?php echo $admtext['mergeplaces']; ?>"> <img src="img/spinner.gif" id="placespin" style="display:none">
	<span id="successmsg1" class="normal msgapproved"></span></p>
	<table cellpadding="3" cellspacing="1" border="0" class="rounded-table">
		<tr>
			<td class="fieldnameback" valign="bottom" align="center"><span class="fieldname"><b><?php echo $admtext['mcol1']; ?></b></span></td>
			<td class="fieldnameback" valign="bottom" align="center"><span class="fieldname"><b><?php echo $admtext['mcol2']; ?></b></span></td>
			<td class="fieldnameback" valign="bottom"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['place']; ?></b>&nbsp;</nobr></span></td>
			<td class="fieldnameback" valign="bottom" align="center"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['latitude']; ?></b>&nbsp;</nobr></span></td>
			<td class="fieldnameback" valign="bottom" align="center"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['longitude']; ?></b>&nbsp;</nobr></span></td>
		</tr>

<?php
		while( $row = tng_fetch_assoc($result))
		{
			echo "<tr class=\"mergerows\" id=\"row_{$row['ID']}\">\n";
			echo "<td class=\"lightback\" valign=\"top\" align=\"center\"><input type=\"checkbox\" class=\"mc\" name=\"mc{$row['ID']}\" onclick=\"handleCheck({$row['ID']});\" value=\"{$row['ID']}\"></td>\n";
			echo "<td class=\"lightback\" valign=\"top\" align=\"center\"><input type=\"radio\" name=\"keep\" id=\"r{$row['ID']}\" onclick=\"handleRadio({$row['ID']});\" value=\"{$row['ID']}\"></td>\n";
            $display = $row['place'];
            $display = preg_replace("/</", "&lt;", $display);
            $display = preg_replace("/>/", "&gt;", $display);
			echo "<td class=\"lightback\" valign=\"top\"><a href=\"admin_editplace.php?ID={$row['place']}{$treestr}&cw=1\" target=\"blank\">$display</a>&nbsp;</td>\n";
			echo "<td class=\"lightback\" valign=\"top\" id=\"lat_{$row['ID']}\">{$row['latitude']}&nbsp;</td>\n";
			echo "<td class=\"lightback\" valign=\"top\" id=\"long_{$row['ID']}\">{$row['longitude']}&nbsp;</td>\n";
			echo "</tr>\n";
		}
		tng_free_result($result);
?>
	</table><br/>
	<input type="submit" value="<?php echo $admtext['mergeplaces']; ?>">
	<span id="successmsg2" class="normal msgapproved"></span>
	</form>
<?php
	}
?>
	</div>
</div>
<?php 
echo tng_adminfooter();
?>