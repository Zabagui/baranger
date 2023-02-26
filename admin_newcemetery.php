<?php
include("begin.php");
include($subroot . "mapconfig.php");
$mapkeystr = $map['key'] && $map['key'] != "1" ? "&amp;key=" . $map['key'] . "&amp;callback=initMap" : "";
include("adminlib.php");
$textpart = "cemeteries";
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

$query = "SELECT state FROM $states_table";
$stateresult = tng_query($query);

$query = "SELECT country FROM $countries_table";
$countryresult = tng_query($query);

$helplang = findhelp("cemeteries_help.php");

tng_adminheader( $admtext['addnewcemetery'], $flags );

if( $map['key'] && $isConnected)
    echo "<script type=\"text/javascript\" src=\"{$http}://maps.googleapis.com/maps/api/js?language={$text['glang']}$mapkeystr\"></script>\n";
?>
<script type="text/javascript" src="js/selectutils.js?v<?php echo $tng_version; ?>"></script>
<script type="text/javascript" src="js/mediautils.js?v<?php echo $tng_version; ?>"></script>
<script type="text/javascript" src="js/admin.js?v<?php echo $tng_version; ?>"></script>
<script type="text/javascript">
var nothingtodelete = "<?php echo $admtext['nothingtodelete']; ?>";
var confdeleteentity = "<?php echo $admtext['confdeleteentity']; ?>";
var pleaseenter = "<?php echo $admtext['pleaseenter']; ?>";
var confdeletefile = "<?php echo $admtext['confdeletefile']; ?>";
var tnglitbox;
var tree = "";

function validateForm( ) {
	var rval = true;
	if( document.form1.country.value.length == 0 ) {
		alert("<?php echo $admtext['entercountry']; ?>");
		rval = false;
	}
	else if( document.form1.newfile.value.length > 0 && document.form1.maplink.value.length == 0 ) {
		alert("<?php echo $admtext['entermapfile']; ?>");
		rval = false;
	}
	else
		document.form1.maplink.value = document.form1.maplink.value.replace(/\\/g,"/");
	return rval;
}	

function populatePath(source, dest) {
	var lastslash, temp;
	
	dest.value = "";
	temp = source.value.replace(/\\/g,"/");
	lastslash = temp.lastIndexOf("/") + 1;
	if( lastslash )
		dest.value = source.value.slice(lastslash);
}
</script>
<?php
	if($map['key'])
		include "googlemaplib2.php";
?>
</head>

<?php
	$onload = $map['key'] && !$map['startoff'] ? " onload=\"divbox('mapcontainer');\"" : "";
	echo tng_adminlayout($onload);

	$cemtabs[0] = array(1,"admin_cemeteries.php",$admtext['search'],"findcem");
	$cemtabs[1] = array($allow_add,"admin_newcemetery.php",$admtext['addnew'],"addcemetery");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/cemeteries_help.php#add');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($cemtabs,"addcemetery",$innermenu);
	echo displayHeadline($admtext['cemeteries'] . " &gt;&gt; " . $admtext['addnewcemetery'],"img/cemeteries_icon.gif",$menu,$message);
?>

<div class="admin-main">
<form action="admin_addcemetery.php" method="post" name="form1" id="form1" ENCTYPE="multipart/form-data" onsubmit="return validateForm();">
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="adm-rounded-table">
<tr>
<td class="tngshadow databack">
	<table class="normal" width="100%">
	<tr><td><?php echo $admtext['cemeteryname']; ?>:</td><td width="80%"><input type="text" name="cemname" id="cemname" size="40"></td></tr>
	<tr><td><?php echo $admtext['maptoupload']; ?>*:</td><td><input type="file" name="newfile" size="60" onChange="populatePath(document.form1.newfile,document.form1.maplink);"></td></tr>
	<tr>
		<td><?php echo $admtext['mapfilenamefolder']; ?>**:</td>
		<td><input type="text" name="maplink" id="maplink" size="60"><input type="hidden" id="maplink_org"><input type="hidden" id="maplink_last"> <input type="button" value="<?php echo $admtext['select'] . "..."; ?>" onclick="javascript:FilePicker('maplink','headstones');"></td>
	</tr>
	<tr><td><?php echo $admtext['city']; ?>:</td><td><input type="text" name="city" id="city" size="20"></td></tr>
	<tr><td><?php echo $admtext['countyparish']; ?>:</td><td><input type="text" name="county" id="county" size="20"></td></tr>
	<tr><td><?php echo $admtext['stateprovince']; ?>:</td>
		<td>
			<select name="state" id="state">
				<option value=""></option>
<?php
while( $staterow = tng_fetch_assoc($stateresult) ) {
	echo "	<option value=\"{$staterow['state']}\">{$staterow['state']}</option>\n";
}
?>
			</select>
			<input type="button" name="addnewstate" value="<?php echo $admtext['addnew']; ?>" onclick="tnglitbox = new LITBox('admin_newentity.php?entity=state',{width:350,height:120});$('#newitem').focus();">
			<input type="button" name="deletestate" value="<?php echo $admtext['deleteselected']; ?>" onclick="attemptDelete(document.form1.state,'state');$('newitem').focus();">
		</td>
	</tr>
	<tr><td><span class="normal"><?php echo $admtext['cap_country']; ?>:</span></td>
		<td>
			<select name="country" id="country">
				<option value=""></option>
<?php
while( $countryrow = tng_fetch_assoc($countryresult) ) {
	echo "	<option value=\"{$countryrow['country']}\">{$countryrow['country']}</option>\n";
}
?>
			</select> 
			<input type="button" name="addnewcountry" value="<?php echo $admtext['addnew']; ?>" onclick="tnglitbox = new LITBox('admin_newentity.php?entity=country',{width:350,height:120});$('#newitem').focus();">
			<input type="button" name="deletecountry" value="<?php echo $admtext['deleteselected']; ?>" onclick="attemptDelete(document.form1.country,'country');">
		</td>
	</tr>
	<tr><td><?php echo $admtext['linkplace']; ?>:</td><td><input type="text" name="place" id="place" class="longfield" onblur="fillCemetery(this.value);"> <a href="#" onclick="return openFindPlaceForm('place');"><img src="img/tng_find.gif" title="<?php echo $admtext['find']; ?>" alt="<?php echo $admtext['find']; ?>" width="20" height="20" class="alignmiddle"/></a>
		<input type="button" value="<?php echo $admtext['fillplace']; ?>" onclick="fillPlace(document.form1);"/></td></tr>
	<tr><td>&nbsp;</td><td><input type="checkbox" name="usecoords" value="1" checked="checked"/> <?php echo $admtext['usecemcoords']; ?></td></tr>
<?php
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
<?php
	if( $map['key'] ) {
?>
	<tr><td><?php echo $admtext['zoom']; ?>:</td><td><input type="text" name="zoom" size="20" id="zoombox"></td></tr>
<?php
	}
?>
	<tr><td valign="top"><?php echo $admtext['notes']; ?>:</td><td><textarea wrap cols="60" rows="8" name="notes"></textarea></td></tr>
	</table><br/>&nbsp;
	<input type="submit" name="submitx" class="btn" value="<?php echo $admtext['saveback']; ?>">
	<input type="submit" name="submit" accesskey="s" class="btn" value="<?php echo $admtext['savereturn']; ?>">
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="window.location.href='admin_cemeteries.php';">
	<p class="normal">*<?php echo $admtext['ifmapuploaded']; ?><br/>
	**<?php echo $admtext['requiredmap']; ?></p>
</td>
</tr>
</table>
</form>
</div>
<?php 
echo tng_adminfooter();
?>