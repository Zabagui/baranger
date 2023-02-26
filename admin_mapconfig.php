<?php
include("begin.php");
include($subroot . "mapconfig.php");
include("adminlib.php");
$textpart = "setup";
//include("getlang.php");
include("$mylanguage/admintext.php");

if( $link ) {
	$admin_login = 1;
	include("checklogin.php");
	include("version.php");

	if( $assignedtree || !$allow_edit ) {
		$message = $admtext['norights'];
		header( "Location: admin_login.php?message=" . urlencode($message) );
		exit;
	}
}

$helplang = findhelp("mapconfig_help.php");

tng_adminheader( $admtext['modifymapsettings'], $flags );
?>
<script type="text/javascript">
function validateWidth(width) {
	if(width.indexOf('%') >= 0)
		return Math.min(parseInt(width),100) + '%';
	else
		return parseInt(width) + 'px';
}

function validateHeight(height) {
	return parseInt(height) + 'px';
}

function validateLatLong(coord) {
	var keep = "1234567890.-";     // Characters stripped out
	var i;
	var returnString = "";
	for (i = 0; i < coord.length; i++) {  // Search through string and append to unfiltered values to returnString.
		var c = coord.charAt(i);
		if(keep.indexOf(c) != -1)
			returnString += c;
		else
			break;
	}
	return returnString
}
</script>
</head>

<?php
	echo tng_adminlayout();

	$setuptabs[0] = array(1,"admin_setup.php",$admtext['configuration'],"configuration");
	$setuptabs[1] = array(1,"admin_diagnostics.php",$admtext['diagnostics'],"diagnostics");
	$setuptabs[2] = array(1,"admin_setup.php?sub=tablecreation",$admtext['tablecreation'],"tablecreation");
	$setuptabs[3] = array(1,"#",$admtext['mapconfigsettings'],"map");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/mapconfig_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($setuptabs,"map",$innermenu);
	echo displayHeadline($admtext['setup'] . " &gt;&gt; " . $admtext['configuration'] . " &gt;&gt; " . $admtext['mapconfigsettings'],"img/setup_icon.gif",$menu,"");
?>

<div class="admin-main">
	<div class="databack admin-block">
	<form action="admin_updatemapconfig.php" method="post" name="form1">
	<table class="normal">
		<tr>
			<td><?php echo $admtext['mapkey']; ?>:</td>
			<td><input type="text" value="<?php echo $map['key']; ?>" name="mapkey" size="80"></td>
		</tr>
		<tr>
			<td><?php echo $admtext['maptype']; ?>:</td>
			<td>
				<select name="maptype">
					<option value="TERRAIN"<?php if( $map['displaytype'] == "TERRAIN" ) echo " selected"; ?>><?php echo $admtext['mapterrain']; ?></option>
					<option value="ROADMAP"<?php if( $map['displaytype'] == "ROADMAP" ) echo " selected"; ?>><?php echo $admtext['maproadmap']; ?></option>
					<option value="HYBRID"<?php if( $map['displaytype'] == "HYBRID" ) echo " selected"; ?>><?php echo $admtext['maphybrid']; ?></option>
					<option value="SATELLITE"<?php if( $map['displaytype'] == "SATELLITE" ) echo " selected"; ?>><?php echo $admtext['mapsatellite']; ?></option>
				</select>
			</td>
		</tr>
		<tr><td><?php echo $admtext['mapstlat']; ?>:</td><td><input type="text" value="<?php echo $map['stlat']; ?>" name="mapstlat" onblur="this.value = validateLatLong(this.value)"></td></tr>
		<tr><td><?php echo $admtext['mapstlong']; ?>:</td><td><input type="text" value="<?php echo $map['stlong']; ?>" name="mapstlong" onblur="this.value = validateLatLong(this.value)"></td></tr>
		<tr><td><?php echo $admtext['mapstzm']; ?>:</td>
			<td>
				<select name="mapstzoom">
				<?php
					for($i = 0; $i <= 17; $i++) {
						echo "<option value=\"$i\"";
						if( $map['stzoom'] == $i ) echo " selected";
						echo ">$i</option>\n";
					}
				?>
				</select>
			</td>
		</tr>
		<tr><td><?php echo $admtext['mapfoundzm']; ?>:</td>
			<td>
				<select name="mapfoundzoom">
				<?php
					for($i = 0; $i <= 17; $i++) {
						echo "<option value=\"$i\"";
						if( $map['foundzoom'] == $i ) echo " selected";
						echo ">$i</option>\n";
					}
				?>
				</select>
			</td>
		</tr>

		<tr><td valign="top" colspan="2"><br /><?php echo $admtext['mapdimsind']; ?>:</td></tr>
		<tr><td><?php echo $admtext['mapwidth']; ?>:</td><td><input type="text" value="<?php echo $map['indw']; ?>" name="mapindw" onblur="this.value = validateWidth(this.value)"></td></tr>
		<tr><td><?php echo $admtext['mapheight']; ?>:</td><td><input type="text" value="<?php echo $map['indh']; ?>" name="mapindh" onblur="this.value = validateHeight(this.value)"></td></tr>

		<tr><td valign="top" colspan="2"><br /><?php echo $admtext['mapdimshst']; ?>:</td></tr>
		<tr><td><?php echo $admtext['mapwidth']; ?>:</td><td><input type="text" value="<?php echo $map['hstw']; ?>" name="maphstw" onblur="this.value = validateWidth(this.value)"></td></tr>
		<tr><td><?php echo $admtext['mapheight']; ?>:</td><td><input type="text" value="<?php echo $map['hsth']; ?>" name="maphsth" onblur="this.value = validateHeight(this.value)"></td></tr>

		<tr><td valign="top" colspan="2"><br /><?php echo $admtext['mapdimsadm']; ?>:</td></tr>
		<tr><td><?php echo $admtext['mapwidth']; ?>:</td><td><input type="text" value="<?php echo $map['admw']; ?>" name="mapadmw" onblur="this.value = validateWidth(this.value)"></td></tr>
		<tr><td><?php echo $admtext['mapheight']; ?>:</td><td><input type="text" value="<?php echo $map['admh']; ?>" name="mapadmh" onblur="this.value = validateHeight(this.value)"></td></tr>
		<tr><td><?php echo $admtext['startoff']; ?>:</td>
			<td>
				<select name="startoff">
					<option value="1"<?php if( $map['startoff'] ) echo " selected"; ?>><?php echo $admtext['yes']; ?></option>
					<option value="0"<?php if( !$map['startoff'] ) echo " selected"; ?>><?php echo $admtext['no']; ?></option>
				</select>
			</td>
		</tr>
		<tr><td><?php echo $admtext['pstartoff']; ?>:</td>
			<td>
				<select name="pstartoff">
					<option value="1"<?php if( $map['pstartoff'] ) echo " selected"; ?>><?php echo $admtext['yes']; ?></option>
					<option value="0"<?php if( !$map['pstartoff'] ) echo " selected"; ?>><?php echo $admtext['no']; ?></option>
				</select>
			</td>
		</tr>

		<tr><td valign="top" colspan="2"><br /></td></tr>
		<tr><td><?php echo $admtext['conslpins']; ?>:</td>
			<td>
				<select name="showallpins">
					<option value="0"<?php if( !$map['showallpins'] ) echo " selected"; ?>><?php echo $admtext['yes']; ?></option>
					<option value="1"<?php if( $map['showallpins'] ) echo " selected"; ?>><?php echo $admtext['no']; ?></option>
				</select>
			</td>
		</tr>
	</table><br/>
	<input type="hidden" name="pinplacelevel0" value="<?php echo $pinplacelevel0; ?>">
	<input type="hidden" name="pinplacelevel1" value="<?php echo $pinplacelevel1; ?>">
	<input type="hidden" name="pinplacelevel2" value="<?php echo $pinplacelevel2; ?>">
	<input type="hidden" name="pinplacelevel3" value="<?php echo $pinplacelevel3; ?>">
	<input type="hidden" name="pinplacelevel4" value="<?php echo $pinplacelevel4; ?>">
	<input type="hidden" name="pinplacelevel5" value="<?php echo $pinplacelevel5; ?>">
	<input type="hidden" name="pinplacelevel6" value="<?php echo $pinplacelevel6; ?>">
	<input type="submit" name="submit" class="btn" value="<?php echo $admtext['saveback']; ?>">
	<input type="submit" name="submitx" accesskey="s" class="btn" value="<?php echo $admtext['savereturn']; ?>">
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="window.location.href='admin_setup.php';">
	</form>
	</div>
</div>
<?php 
echo tng_adminfooter();
?>
