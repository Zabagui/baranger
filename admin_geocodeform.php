<?php
include("begin.php");
include($subroot . "mapconfig.php");
include("adminlib.php");
$textpart = "findplace";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

$helplang = findhelp("places_help.php");

tng_adminheader( $admtext['places'], $flags );
?>
<script type="text/javascript" src="js/admin.js"></script>
</head>

<?php
    echo tng_adminlayout();

	$placetabs[0] = array(1,"admin_places.php",$admtext['search'],"findplace");
	$placetabs[1] = array($allow_add,"admin_newplace.php",$admtext['addnew'],"addplace");
	$placetabs[2] = array($allow_edit && $allow_delete,"admin_mergeplaces.php",$admtext['merge'],"merge");
	$placetabs[3] = array($allow_edit,"admin_geocodeform.php",$admtext['geocode'],"geo");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/places_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($placetabs,"geo",$innermenu);
	echo displayHeadline($admtext['places'] . " &gt;&gt; " . $admtext['geocode'], "img/places_icon.gif",$menu,$message);
?>

<div class="admin-main">
    <div class="databack admin-block">
    <span class="subhead"><strong><?php echo $admtext['geoexpl']; ?></strong></span><br/><br/>

	<form action="admin_geocode.php" method="post" name="form1" >
<?php
    if($tngconfig['places1tree'])
        echo "<input type=\"hidden\" name=\"tree1\" value=\"\" />\n";
?>
    <table class="normal">
<?php
    if(!$tngconfig['places1tree']) {
?>
		<tr>
			<td><?php echo $admtext['tree']; ?>: </td>
			<td>
				<select name="tree1">
<?php
    if( $assignedtree )
        $wherestr = "WHERE gedcom = \"$assignedtree\"";
    else
        $wherestr = "";
    $treequery = "SELECT gedcom, treename FROM $trees_table $wherestr ORDER BY treename";
	$treeresult = tng_query($treequery) or die ($admtext['cannotexecutequery'] . ": $treequery");
	while( $treerow = tng_fetch_assoc($treeresult) ) {
		echo "	<option value=\"{$treerow['gedcom']}\"";
		if( isset($tree) && $treerow['gedcom'] == $tree ) echo " selected";
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
            <td><?php echo $admtext['limit']; ?></td>
            <td>
                <select name="limit">
                    <option value="10">10</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="250">250</option>
                    <option value="500">500</option>
                    <option value="1000">1000</option>
                    <option value="2500">2500</option>
                    <option value="5000">5000</option>
                    <option value="10000">10000</option>
                    <option value=""><?php echo $admtext['nolimit']; ?></option>
                </select>
            </td>
            <td>
                &nbsp; &nbsp; <input type="checkbox" value="1" name="resetignore"> <?php echo $admtext['reset']; ?>
            </td>
        </tr>
    </table>
    <div class="normal">
        <p><?php echo $admtext['multchoice']; ?></p>
        <p>
            <input type="radio" name="multiples" value="0" checked="checked" /> <?php echo $admtext['ignoreall']; ?> &nbsp;&nbsp;
            <input type="radio" name="multiples" value="1" /> <?php echo $admtext['usefirst']; ?>
        </p>
        <input type="submit" accesskey="s" class="btn" value="<?php echo $admtext['geocode']; ?>" />
    </div>
    </form>
    </div>
</div>
<?php 
echo tng_adminfooter();
?>