<?php
include("begin.php");
include($subroot . "pedconfig.php");
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

$helplang = findhelp("pedconfig_help.php");

tng_adminheader( $admtext['modifypedsettings'], $flags );
?>
<script src="js/popupwindow.js"></script>
<script src="js/anchorposition.js"></script>
<script src="js/colorpicker2.js"></script>
<script type="text/javascript">
var cp = new ColorPicker('window');

function toggleAll(display) {
	toggleSection('ped','plus0',display);
	toggleSection('desc','plus1',display);
	toggleSection('rel','plus2',display);
	toggleSection('time','plus3',display);
	toggleSection('peddesc','plus4',display);
	return false;
}
</script>
<script type="text/javascript" src="js/admin.js"></script>
</head>

<?php
	echo tng_adminlayout();

	$setuptabs[0] = array(1,"admin_setup.php",$admtext['configuration'],"configuration");
	$setuptabs[1] = array(1,"admin_diagnostics.php",$admtext['diagnostics'],"diagnostics");
	$setuptabs[2] = array(1,"admin_setup.php?sub=tablecreation",$admtext['tablecreation'],"tablecreation");
	$setuptabs[3] = array(1,"#",$admtext['pedconfigsettings'],"ped");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/pedconfig_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$innermenu .= " &nbsp;|&nbsp; <a href=\"#\" class=\"lightlink\" onClick=\"return toggleAll('on');\">{$text['expandall']}</a> &nbsp;|&nbsp; <a href=\"#\" class=\"lightlink\" onClick=\"return toggleAll('off');\">{$text['collapseall']}</a>";
	$menu = doMenu($setuptabs,"ped",$innermenu);
	echo displayHeadline($admtext['setup'] . " &gt;&gt; " . $admtext['configuration'] . " &gt;&gt; " . $admtext['pedconfigsettings'],"img/setup_icon.gif",$menu,"");

	if(!isset($pedigree['vwidth'])) $pedigree['vwidth'] = 100;
	if(!isset($pedigree['vheight'])) $pedigree['vheight'] = 42;
	if(!isset($pedigree['vspacing'])) $pedigree['vspacing'] = 20;
	if(!isset($pedigree['vfontsize'])) $pedigree['vfontsize'] = 7;

	if(!isset($pedigree['maxropt'])) $pedigree['maxropt'] = 99;
	if(!isset($pedigree['maxlopt'])) $pedigree['maxlopt'] = 30;
	if(!isset($pedigree['showtxtopt'])) $pedigree['showtxtopt'] = false;
	if(!isset($pedigree['compactboxopt'])) $pedigree['compactboxopt'] = false;
	if(!isset($pedigree['sortbyopt'])) $pedigree['sortbyopt'] = "length";
	if(!isset($pedigree['maxmopt'])) $pedigree['maxmopt'] = 9;
?>

<div class="admin-main">
<form action="admin_updatepedconfig.php" method="post" name="form1" >
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="adm-rounded-table">
<tr>
<td class="tngshadow databack">
	<?php echo displayToggle("plus0",0,"ped",$admtext['pedchart'],""); ?>

	<div id="ped" style="display:none"><br/>
	<table class="normal">
		<tr>
			<td><?php echo $admtext['usepopups']; ?>:</td>
			<td>
				<select name="usepopups">
					<option value="1"<?php if( $pedigree['usepopups'] == 1 ) echo " selected"; ?>><?php echo $admtext['pedstandard']; ?></option>
					<option value="0"<?php if( !$pedigree['usepopups'] ) echo " selected"; ?>><?php echo $admtext['pedbox']; ?></option>
					<option value="-1"<?php if($pedigree['usepopups'] == -1 ) echo " selected"; ?>><?php echo $admtext['pedtextonly']; ?></option>
					<option value="2"<?php if($pedigree['usepopups'] == 2 ) echo " selected"; ?>><?php echo $admtext['pedcompact']; ?></option>
					<option value="3"<?php if($pedigree['usepopups'] == 3 ) echo " selected"; ?>><?php echo $admtext['ahnentafel']; ?></option>
					<option value="4"<?php if( $pedigree['usepopups'] == 4 ) echo " selected"; ?>><?php echo $admtext['pedvertical']; ?></option>
					<option value="5"<?php if( $pedigree['usepopups'] == 5 ) echo " selected"; ?>><?php echo $text['fanchart']; ?></option>
				</select>
			</td>
		</tr>
		<tr><td><?php echo $admtext['maxpedgens']; ?>:</td><td><input type="text" value="<?php echo $pedigree['maxgen']; ?>" name="maxgen" size="5"></td></tr>
		<tr><td><?php echo $admtext['initgens']; ?>:</td><td colspan="4"><input type="text" value="<?php echo $pedigree['initpedgens']; ?>" name="initpedgens" size="5"></td></tr>
		<tr><td><?php echo $admtext['popupspouses']; ?>:</td><td><input type="radio" name="popupspouses" value="1" <?php if( $pedigree['popupspouses'] ) { echo "checked"; } ?>> <?php echo $admtext['yes']; ?> <input type="radio" name="popupspouses" value="0" <?php if( !$pedigree['popupspouses'] ) { echo "checked"; } ?>> <?php echo $admtext['no']; ?></td></tr>
		<tr><td><?php echo $admtext['popupkids']; ?>:</td><td><input type="radio" name="popupkids" value="1" <?php if( $pedigree['popupkids']) { echo "checked"; } ?>> <?php echo $admtext['yes']; ?> <input type="radio" name="popupkids" value="0" <?php if( !$pedigree['popupkids'] ) { echo "checked"; } ?>> <?php echo $admtext['no']; ?></td></tr>
		<tr><td><?php echo $admtext['popupchartlinks']; ?>:</td><td><input type="radio" name="popupchartlinks" value="1" <?php if( $pedigree['popupchartlinks'] ) { echo "checked"; } ?>> <?php echo $admtext['yes']; ?> <input type="radio" name="popupchartlinks" value="0" <?php if( !$pedigree['popupchartlinks'] ) { echo "checked"; } ?>> <?php echo $admtext['no']; ?></td></tr>
		<tr><td><?php echo $admtext['hideempty']; ?>:</td><td><input type="radio" name="hideempty" value="1" <?php if( $pedigree['hideempty'] ) { echo "checked"; } ?>> <?php echo $admtext['yes']; ?> <input type="radio" name="hideempty" value="0" <?php if( !$pedigree['hideempty'] ) { echo "checked"; } ?>> <?php echo $admtext['no']; ?></td></tr>
		<tr><td><?php echo $admtext['boxwidth']; ?>:</td><td><input type="text" value="<?php echo $pedigree['boxwidth']; ?>" name="boxwidth" size="10"></td></tr>
		<tr><td><?php echo $admtext['boxheight']; ?>:</td><td><input type="text" value="<?php echo $pedigree['boxheight']; ?>" name="boxheight" size="10"></td></tr>
		<tr>
			<td><?php echo $admtext['boxalign']; ?>:</td>
			<td>
				<select name="boxalign">
					<option value="center"<?php if( $pedigree['boxalign'] == "center" ) echo " selected"; ?>><?php echo $admtext['center']; ?></option>
					<option value="left"<?php if( $pedigree['boxalign'] == "left" ) echo " selected"; ?>><?php echo $admtext['left']; ?></option>
					<option value="right"<?php if( $pedigree['boxalign'] == "right" ) echo " selected"; ?>><?php echo $admtext['right']; ?></option>
				</select>
			</td>
		</tr>
   		<tr><td><?php echo $admtext['boxheightshift']; ?>:</td><td><input type="text" value="<?php echo $pedigree['boxheightshift']; ?>" name="boxheightshift" size="10"></td></tr>
	</table>

	<p><strong><?php echo $admtext['vchart']; ?></strong></p>
	<table class="normal">
		<tr><td><?php echo $admtext['vboxwidth']; ?>:</td><td><input type="text" value="<?php echo $pedigree['vwidth']; ?>" name="vwidth" size="5"></td></tr>
		<tr><td><?php echo $admtext['vboxheight']; ?>:</td><td><input type="text" value="<?php echo $pedigree['vheight']; ?>" name="vheight" size="5"></td></tr>
		<tr><td><?php echo $admtext['vspacing']; ?>:</td><td><input type="text" value="<?php echo $pedigree['vspacing']; ?>" name="vspacing" size="5"></td></tr>
		<tr><td><?php echo $admtext['boxnamesize']; ?>:</td><td><input type="text" value="<?php echo $pedigree['vfontsize']; ?>" name="vfontsize" size="5"></td></tr>
	</table>
	</div>

</td>
</tr>

<tr>
<td class="tngshadow databack">
	<?php echo displayToggle("plus1",0,"desc",$admtext['descchart'],""); ?>

	<div id="desc" style="display:none"><br/>
	<table>
		<tr>
			<td><span class="normal"><?php echo $admtext['usepopups']; ?>:</span></td>
			<td>
				<select name="defdesc">
					<option value="2"<?php if( $pedigree['defdesc'] == 2 ) echo " selected"; ?>><?php echo $admtext['pedstandard']; ?></option>
					<option value="0"<?php if( !$pedigree['defdesc'] ) echo " selected"; ?>><?php echo $admtext['pedtextonly']; ?></option>
					<option value="3"<?php if($pedigree['defdesc'] == 3 ) echo " selected"; ?>><?php echo $admtext['pedcompact']; ?></option>
					<option value="4"<?php if( $pedigree['defdesc'] == 4 ) echo " selected"; ?>><?php echo $admtext['pedvertical']; ?></option>
					<option value="1"<?php if( $pedigree['defdesc'] == 1 ) echo " selected"; ?>><?php echo $admtext['regformat']; ?></option>
					<option value="5"<?php if( $pedigree['defdesc'] == 5 ) echo " selected"; ?>><?php echo $admtext['dtformat']; ?></option>
				</select>
			</td>
		</tr>
		<tr><td><span class="normal"><?php echo $admtext['maxpedgens']; ?>:</span></td><td colspan="4"><input type="text" value="<?php echo $pedigree['maxdesc']; ?>" name="maxdesc" size="5"></td></tr>
		<tr><td><span class="normal"><?php echo $admtext['initgens']; ?>:</span></td><td colspan="4"><input type="text" value="<?php echo $pedigree['initdescgens']; ?>" name="initdescgens" size="5"></td></tr>
		<tr>
			<td><span class="normal"><?php echo $admtext['stdesc']; ?>:</span></td>
			<td>
				<select name="stdesc">
					<option value="0"<?php if( !$pedigree['stdesc'] ) echo " selected"; ?>><?php echo $admtext['stexpand']; ?></option>
					<option value="1"<?php if( $pedigree['stdesc'] == 1 ) echo " selected"; ?>><?php echo $admtext['stcollapse']; ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td><span class="normal"><?php echo $admtext['regnotes']; ?>:</span></td>
			<td>
				<select name="regnotes">
					<option value="0"<?php if( !$pedigree['regnotes'] ) echo " selected"; ?>><?php echo $admtext['no']; ?></option>
					<option value="1"<?php if( $pedigree['regnotes'] ) echo " selected"; ?>><?php echo $admtext['yes']; ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td><span class="normal"><?php echo $admtext['regnosp']; ?>:</span></td>
			<td>
				<select name="regnosp">
					<option value="0"<?php if( !$pedigree['regnosp'] ) echo " selected"; ?>><?php echo $admtext['chshow']; ?></option>
					<option value="1"<?php if( $pedigree['regnosp'] ) echo " selected"; ?>><?php echo $admtext['chifsp']; ?></option>
				</select>
			</td>
		</tr>
	</table>
	<p><strong><?php echo $admtext['vchart']; ?></strong></p>
	<table class="normal">
		<tr><td><?php echo $admtext['vboxwidth']; ?>:</td><td><input type="text" value="<?php echo $pedigree['dvwidth']; ?>" name="dvwidth" size="5"></td></tr>
		<tr><td><?php echo $admtext['vboxheight']; ?>:</td><td><input type="text" value="<?php echo $pedigree['dvheight']; ?>" name="dvheight" size="5"></td></tr>
		<tr><td><?php echo $admtext['boxnamesize']; ?>:</td><td><input type="text" value="<?php echo $pedigree['dvfontsize']; ?>" name="dvfontsize" size="5"></td></tr>
	</table>
	</div>
	</div>

</td>
</tr>

<tr>
<td class="tngshadow databack">
	<?php echo displayToggle("plus2",0,"rel",$admtext['relchart'],""); ?>

	<div id="rel" style="display:none"><br/>
	<table>
		<tr><td><span class="normal"><?php echo $admtext['initrels']; ?>:</span></td><td><input type="text" value="<?php echo $pedigree['initrels']; ?>" name="initrels" size="5"></td></tr>
		<tr><td><span class="normal"><?php echo $admtext['maxrels']; ?>:</span></td><td><input type="text" value="<?php echo $pedigree['maxrels']; ?>" name="maxrels" size="5"></td></tr>
		<tr><td><span class="normal"><?php echo $admtext['maxpedgens']; ?>:</span></td><td><input type="text" value="<?php echo $pedigree['maxupgen']; ?>" name="maxupgen" size="5"></td></tr>
	</table>

	<p><strong><?php echo $admtext['conchart']; ?></strong></p>
	<table class="normal">
		<tr><td><?php echo $admtext['maxropt']; ?>:</td><td><input type="text" value="<?php echo $pedigree['maxropt']; ?>" name="maxropt" size="5"></td></tr>
		<tr><td><?php echo $admtext['maxlopt']; ?>:</td><td><input type="text" value="<?php echo $pedigree['maxlopt']; ?>" name="maxlopt" size="5"></td></tr>
		<tr>
			<td><?php echo $admtext['showtxtopt']; ?>:</td>
			<td>
				<select name="showtxtopt">
					<option value="0"<?php if( !$pedigree['showtxtopt'] ) echo " selected"; ?>><?php echo $admtext['no']; ?></option>
					<option value="1"<?php if( $pedigree['showtxtopt'] ) echo " selected"; ?>><?php echo $admtext['yes']; ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo $admtext['compactboxopt']; ?>:</td>
			<td>
				<select name="compactboxopt">
					<option value="0"<?php if( !$pedigree['compactboxopt'] ) echo " selected"; ?>><?php echo $admtext['no']; ?></option>
					<option value="1"<?php if( $pedigree['compactboxopt'] ) echo " selected"; ?>><?php echo $admtext['yes']; ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo $admtext['sortbyopt']; ?>:</td>
			<td>
				<select name="sortbyopt">
					<option value="length"<?php if( $pedigree['sortbyopt'] == "length" ) echo " selected"; ?>><?php echo $text['bylength']; ?></option>
					<option value="marriages"<?php if( $pedigree['sortbyopt'] == "marriages" ) echo " selected"; ?>><?php echo $text['bymarriages']; ?></option>
					<option value="none"<?php if( $pedigree['sortbyopt'] == "none" ) echo " selected"; ?>><?php echo $text['none']; ?></option>
				</select>
			</td>
		</tr>
		<tr><td><?php echo $admtext['anchoridopt']; ?>:</td><td><input type="text" value="<?php echo $pedigree['anchoridopt']; ?>" name="anchoridopt" size="10"></td></tr>
		<tr><td><?php echo $admtext['maxmopt']; ?>:</td><td><input type="text" value="<?php echo $pedigree['maxmopt']; ?>" name="maxmopt" size="5"></td></tr>
	</table>
	</div>

</td>
</tr>

<tr>
<td class="tngshadow databack">
	<?php echo displayToggle("plus3",0,"time",$admtext['timechart'],""); ?>

	<div id="time" style="display:none"><br/>
	<table>
		<tr><td><span class="normal"><?php echo $admtext['tcwidth']; ?>:</span></td><td><input type="text" value="<?php echo $pedigree['tcwidth']; ?>" name="tcwidth" size="5"></td></tr>
		<tr>
			<td><span class="normal"><?php echo $admtext['simile']; ?>:</span></td>
			<td>
				<select name="simile" onchange="new Effect.toggle('simileTable', 'appear',{duration:.2});">
					<option value="0"<?php if( !$pedigree['simile'] ) echo " selected"; ?>><?php echo $admtext['no']; ?></option>
					<option value="1"<?php if( $pedigree['simile'] ) echo " selected"; ?>><?php echo $admtext['yes']; ?></option>
				</select>
			</td>
		</tr>
	</table>
	<table<?php if(!$pedigree['simile']) echo " style=\"display:none\""; ?> id="simileTable">
		<tr><td><span class="normal"><?php echo $admtext['tcheight']; ?>:</span></td><td><input type="text" value="<?php echo $pedigree['tcheight']; ?>" name="tcheight" size="5"></td></tr>
		<tr>
			<td><span class="normal"><?php echo $admtext['inclevs']; ?>:</span></td>
			<td>
				<select name="tcevents">
					<option value="0"<?php if( !$pedigree['tcevents'] ) echo " selected"; ?>><?php echo $admtext['allevs']; ?></option>
					<option value="1"<?php if( $pedigree['tcevents'] ) echo " selected"; ?>><?php echo $admtext['rangeevs']; ?></option>
				</select>
			</td>
		</tr>
	</table>
	</div>

</td>
</tr>

<tr>
<td class="tngshadow databack">
	<?php echo displayToggle("plus4",0,"peddesc",$admtext['pedanddesc'],""); ?>

	<div id="peddesc" style="display:none"><br/>
	<table>
		<tr>
			<td valign="top">
				<table class="normal">
					<tr><td><?php echo $admtext['leftindent']; ?>:</td><td><input type="text" value="<?php echo $pedigree['leftindent']; ?>" name="leftindent" size="10"></td></tr>
					<tr><td><?php echo $admtext['boxnamesize']; ?>:</td><td><input type="text" value="<?php echo $pedigree['boxnamesize']; ?>" name="boxnamesize" size="10"></td></tr>
					<tr><td><?php echo $admtext['boxdatessize']; ?>:</td><td><input type="text" value="<?php echo $pedigree['boxdatessize']; ?>" name="boxdatessize" size="10"></td></tr>
					<tr><td><?php echo $admtext['boxcolor']; ?>:</td><td><input type="text" value="<?php echo $pedigree['boxcolor']; ?>" name="boxcolor" id="boxcolor" size="8"> <A HREF="#" onClick="cp.select(document.form1.boxcolor,'pick1');return false;" NAME="pick1" ID="pick1"><img src="img/tng_colorpicker.gif" alt="" width="19" height="17" border="0"></A></td></tr>
					<tr><td><?php echo $admtext['colorshift']; ?>:</td><td><input type="text" value="<?php echo $pedigree['colorshift']; ?>" name="colorshift" size="10"></td></tr>
					<tr><td><?php echo $admtext['emptycolor']; ?>:</td><td><input type="text" value="<?php echo $pedigree['emptycolor']; ?>" name="emptycolor" id="emptycolor" size="8"> <A HREF="#" onClick="cp.select(document.form1.emptycolor,'pick2');return false;" NAME="pick2" ID="pick2"><img src="img/tng_colorpicker.gif" alt="" width="19" height="17" border="0"></A></td></tr>
					<tr><td><?php echo $admtext['bordercolor']; ?>:</td><td><input type="text" value="<?php echo $pedigree['bordercolor']; ?>" name="bordercolor" id="bordercolor" size="8"> <A HREF="#" onClick="cp.select(document.form1.bordercolor,'pick3');return false;" NAME="pick3" ID="pick3"><img src="img/tng_colorpicker.gif" alt="" width="19" height="17" border="0"></A></td></tr>
					<tr><td><?php echo $admtext['shadowcolor']; ?>:</td><td><input type="text" value="<?php echo $pedigree['shadowcolor']; ?>" name="shadowcolor" id="shadowcolor" size="8"> <A HREF="#" onClick="cp.select(document.form1.shadowcolor,'pick4');return false;" NAME="pick4" ID="pick4"><img src="img/tng_colorpicker.gif" alt="" width="19" height="17" border="0"></A></td></tr>
					<tr><td><?php echo $admtext['shadowoffset']; ?>:</td><td><input type="text" value="<?php echo $pedigree['shadowoffset']; ?>" name="shadowoffset" size="10"></td></tr>
					<tr><td><?php echo $admtext['boxHsep']; ?>:</td><td><input type="text" value="<?php echo $pedigree['boxHsep']; ?>" name="boxHsep" size="10"></td></tr>
					<tr><td><?php echo $admtext['boxVsep']; ?>:</td><td><input type="text" value="<?php echo $pedigree['boxVsep']; ?>" name="boxVsep" size="10"></td></tr>
					<tr>
						<td><?php echo $admtext['defpgsize']; ?>:</td>
						<td>
						    <select name="pagesize"><?php if( !isset($pedigree['pagesize']) ) $pedigree['pagesize'] = ""; ?>
							    <option value="a3"<?php if($pedigree['pagesize'] == "a3") echo " selected=\"selected\""; ?>>A3</option>
							    <option value="a4"<?php if($pedigree['pagesize'] == "a4") echo " selected=\"selected\""; ?>>A4</option>
							    <option value="a5"<?php if($pedigree['pagesize'] == "a5") echo " selected=\"selected\""; ?>>A5</option>
							    <option value="letter"<?php if(!$pedigree['pagesize'] || $pedigree['pagesize'] == "letter") echo " selected=\"selected\""; ?>><?php echo $text['letter']; ?></option>
						        <option value="legal"<?php if($pedigree['pagesize'] == "legal") echo " selected=\"selected\""; ?>><?php echo $text['legal']; ?></option>
						    </select>
						</td>
					</tr>
		        </table>
			</td>
			<td width="20">&nbsp;</td>
			<td valign="top">
				<table>
					<tr><td valign="top"><span class="normal"><?php echo $admtext['linewidth']; ?>:</span></td><td><input type="text" value="<?php echo $pedigree['linewidth']; ?>" name="linewidth" size="10"></td></tr>
					<tr><td valign="top"><span class="normal"><?php echo $admtext['borderwidth']; ?>:</span></td><td><input type="text" value="<?php echo $pedigree['borderwidth']; ?>" name="borderwidth" size="10"></td></tr>
					<tr><td valign="top"><span class="normal"><?php echo $admtext['popupcolor']; ?>:</span></td><td><input type="text" value="<?php echo $pedigree['popupcolor']; ?>" name="popupcolor" id="popupcolor" size="8"> <A HREF="#" onClick="cp.select(document.form1.popupcolor,'pick5');return false;" NAME="pick5" ID="pick5"><img src="img/tng_colorpicker.gif" alt="" width="19" height="17" border="0"></A></td></tr>
					<tr><td valign="top"><span class="normal"><?php echo $admtext['popupinfosize']; ?>:</span></td><td><input type="text" value="<?php echo $pedigree['popupinfosize']; ?>" name="popupinfosize" size="10"></td></tr>
					<tr><td valign="top"><span class="normal"><?php echo $admtext['popuptimer']; ?>:</span></td><td><input type="text" value="<?php echo $pedigree['popuptimer']; ?>" name="popuptimer" size="10"></td></tr>
					<tr><td valign="top"><span class="normal"><?php echo $admtext['puboxwidth']; ?>:</span></td><td><input type="text" value="<?php echo $pedigree['puboxwidth']; ?>" name="puboxwidth" size="10"></td></tr>
					<tr><td valign="top"><span class="normal"><?php echo $admtext['puboxheight']; ?>:</span></td><td><input type="text" value="<?php echo $pedigree['puboxheight']; ?>" name="puboxheight" size="10"></td></tr>
					<tr>
						<td valign="top"><span class="normal"><?php echo $admtext['puboxalign']; ?>:</span></td>
						<td>
							<select name="puboxalign">
								<option value="center"<?php if( $pedigree['puboxalign'] == "center" ) echo " selected"; ?>><?php echo $admtext['center']; ?></option>
								<option value="left"<?php if( $pedigree['puboxalign'] == "left" ) echo " selected"; ?>><?php echo $admtext['left']; ?></option>
								<option value="right"<?php if( $pedigree['puboxalign'] == "right" ) echo " selected"; ?>><?php echo $admtext['right']; ?></option>
							</select>
						</td>
					</tr>
					<tr><td valign="top"><span class="normal"><?php echo $admtext['puboxheightshift']; ?>:</span></td><td><input type="text" value="<?php echo $pedigree['puboxheightshift']; ?>" name="puboxheightshift" size="10"></td></tr>
					<tr><td valign="top"><span class="normal"><?php echo $admtext['inclphotos']; ?>:</span></td><td><span class="normal"><input type="radio" name="inclphotos" value="1" <?php if( $pedigree['inclphotos'] ) { echo "checked"; } ?>> <?php echo $admtext['yes']; ?> <input type="radio" name="inclphotos" value="0" <?php if( !$pedigree['inclphotos'] ) { echo "checked"; } ?>> <?php echo $admtext['no']; ?></span></td></tr>
		        </table>
			</td>
		</tr>
	</table>
	</div>

</td>
</tr>

<tr>
<td class="tngshadow databack">
	<input type="submit" name="submit" class="btn" value="<?php echo $admtext['saveback']; ?>">
	<input type="submit" name="submit" class="btn saveret" value="<?php echo $admtext['saveback']; ?>">
	<input type="submit" name="submitx" accesskey="s" class="btn" value="<?php echo $admtext['savereturn']; ?>">
	<input type="submit" name="submitx" accesskey="s" class="btn savestay" value="<?php echo $admtext['savereturn']; ?>">
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="window.location.href='admin_setup.php';">
</td>
</tr>

</table>
</form>
</div>
<?php 
echo tng_adminfooter();
?>