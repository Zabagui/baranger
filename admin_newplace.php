<?php
include("begin.php");
include($subroot . "mapconfig.php");
$mapkeystr = $map['key'] && $map['key'] != "1" ? "&amp;key=" . $map['key'] . "&amp;callback=initMap" : "";
include("adminlib.php");
$textpart = "findplace";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( !$allow_add ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

if(!$tngconfig['places1tree']) {
	if( $assignedtree ) {
		$wherestr = "WHERE gedcom = \"$assignedtree\"";
		$firsttree = $assignedtree;
	}
	else {
		$wherestr = "";
		$firsttree = isset($_COOKIE['tng_tree']) ? $_COOKIE['tng_tree'] : "";
	}
    $query = "SELECT gedcom, treename FROM $trees_table $wherestr ORDER BY treename";
    $result = tng_query($query);
}

$helplang = findhelp("places_help.php");

tng_adminheader( $admtext['addnewplace'], $flags );

if( $map['key'] && $isConnected)
    echo "<script type=\"text/javascript\" src=\"{$http}://maps.googleapis.com/maps/api/js?language={$text['glang']}$mapkeystr\"></script>\n";
?>
<script> <?php include("niceditmsgs.php"); ?> </script>
<script type="text/javascript" src="js/nicedit.js"></script>
<script type="text/javascript">
//<![CDATA[
bkLib.onDomLoaded(function() {
    new nicEditor({fullPanel: true, maxHeight: 300}).panelInstance('mynotes');
});

function validateForm( ) {
	var rval = true;
	if( document.form1.place.value.length == 0 ) {
		alert("<?php echo $admtext['enterplace']; ?>");
		rval = false;
	}
	return rval;
}	
//]]>
</script>
<?php
	if($map['key'])
		include "googlemaplib2.php";
?>
</head>

<?php
	$onload = $map['key'] && !$map['startoff'] ? " onload=\"divbox('mapcontainer');\"" : "";
	echo tng_adminlayout($onload);

	$placetabs[0] = array(1,"admin_places.php",$admtext['search'],"findplace");
	$placetabs[1] = array($allow_add,"admin_newplace.php",$admtext['addnew'],"addplace");
	$placetabs[2] = array($allow_edit && $allow_delete,"admin_mergeplaces.php",$admtext['merge'],"merge");
	$placetabs[3] = array($allow_edit,"admin_geocodeform.php",$admtext['geocode'],"geo");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/places_help.php#add');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($placetabs,"addplace",$innermenu);
	echo displayHeadline($admtext['places'] . " &gt;&gt; " . $admtext['addnewplace'], "img/places_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">
	<form action="admin_addplace.php" method="post"  name="form1" onSubmit="return validateForm();">
	<table class="normal" width="100%">
<?php
if(!$tngconfig['places1tree']) {
?>
	<tr>
		<td><?php echo $admtext['tree']; ?>:</td>
		<td width="90%">
			<select name="tree">
<?php
while( $row = tng_fetch_assoc($result) ) {
	echo "		<option value=\"{$row['gedcom']}\"";
	if($firsttree == $row['gedcom'])
		echo " selected=\"selected\"";
	echo ">{$row['treename']}</option>\n";
}
tng_free_result($result);
?>
			</select>
		</td>
	</tr>
<?php
}
?>
	<tr><td><?php echo $admtext['place']; ?>:</td><td><input type="text" name="place" id="place" size="70"></td></tr>
<?php
	if(determineLDSRights()) {
?>
	<tr><td>&nbsp;</td><td><input type="checkbox" name="temple" value="1"> <?php echo $admtext['istemple']; ?></td></tr>
<?php
	}
	if( $map['key'] ) {
?>
	<tr>
		<td colspan="2">
		<div style="padding:10px">
<?php
// draw the map here
		include "googlemapdrawthemap.php";
?>
		</div>
		</td>
	</tr>
<?php
	}
?>
	<tr><td><?php echo $admtext['latitude']; ?>:</td><td><input type="text" name="latitude" size="20" id="latbox"></td></tr>
	<tr><td><?php echo $admtext['longitude']; ?>:</td><td><input type="text" name="longitude" size="20" id="lonbox"></td></tr>
	<tr>
		<td><?php echo $admtext['zoom']; ?>:</td>
		<td>
			<input type="text" name="zoom" size="20" id="zoombox">
		</td>
	</tr>
	<tr>
		<td><?php echo $admtext['placelevel']; ?>:</td>
		<td>
			<select name="placelevel">
				<option value=""></option>
				<option value="-1"><?php echo $admtext['donotgeocode']; ?></option>
<?php
				for($i = 1; $i < 7; $i++) {
					echo "<option value=\"$i\">" . $admtext['level' . $i] . "</option>\n";
				}
?>
			</select>
		</td>
	</tr>
	<tr><td valign="top"><?php echo $admtext['notes']; ?>:</td><td><textarea wrap cols="90" rows="5" name="notes" id="mynotes"></textarea></td></tr>
	</table><br/>&nbsp;
	<input type="submit" name="submitx" class="btn" value="<?php echo $admtext['saveback']; ?>">
	<input type="submit" name="submit" accesskey="s" class="btn" value="<?php echo $admtext['savereturn']; ?>">
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="window.location.href='admin_places.php';">
	</div>
</div>
<?php 
echo tng_adminfooter();
?>