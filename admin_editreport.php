<?php
include("begin.php");
include("adminlib.php");
$textpart = "reports";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( $assignedtree || !$allow_edit ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$query = "SELECT * FROM $reports_table WHERE reportID = \"$reportID\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
$row['sqlselect'] = preg_replace("/\"/", "&#34;",$row['sqlselect']);

tng_free_result($result);

include("micro_reports.php");

$cetypes = array();
$query = "SELECT eventtypeID, tag, display FROM $eventtypes_table WHERE keep=\"1\" AND type=\"I\" ORDER BY display";
$ceresult = tng_query($query);
while( $cerow = tng_fetch_assoc( $ceresult ) ) {
	if( !in_array( $cerow['tag'], $dontdo ) ) {
		$eventtypeID = $cerow['eventtypeID'];
		$cetypes[$eventtypeID] = $cerow;
	}
}

$helplang = findhelp("reports_help.php");

tng_adminheader( $admtext['modifyreport'], $flags );
?>
<script src="js/selectutils.js"></script>
<script src="js/reports.js"></script>
<script type="text/javascript">
function validateForm( ) {
	var rval = true;
	if( document.form1.reportname.value.length == 0 ) {
		alert("<?php echo $admtext['enterreportname']; ?>");
		rval = false;
	}
	else if( jQuery('#displayfields li').length == 0 && document.form1.sqlselect.value.length == 0 ) {
		alert("<?php echo $admtext['selectdisplayfield']; ?>");
		rval = false;
	}
	if( rval ) finishValidation();
	return rval;
}
</script>	
</head>

<?php
	echo tng_adminlayout();

	$reporttabs[0] = array(1,"admin_reports.php",$admtext['search'],"findreport");
	$reporttabs[1] = array($allow_add,"admin_newreport.php",$admtext['addnew'],"addreport");
	$reporttabs['4'] = array($allow_edit,"#",$admtext['edit'],"edit");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/reports_help.php#edit');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($reporttabs,"edit",$innermenu);
	echo displayHeadline($admtext['reports'] . " &gt;&gt; " . $admtext['modifyreport'], "img/reports_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">
	<form action="admin_updatereport.php" method="post" name="form1" id="form1" onSubmit="return validateForm();">
	<table>
		<tr>
			<td><span class="normal"><?php echo $admtext['reportname']; ?>:</span></td>
			<td>
				<input type="text" name="reportname" size="50" maxlength="80" value="<?php echo $row['reportname']; ?>">
				<input type="hidden" name="reportnameorg" value="<?php echo $row['reportname']; ?>">
			</td>
		</tr>
		<tr><td valign="top"><span class="normal"><?php echo $admtext['description']; ?>:</span></td><td><textarea cols="50" rows="3" name="reportdesc"><?php echo $row['reportdesc']; ?></textarea></td></tr>
		<tr><td valign="top"><span class="normal"><?php echo $admtext['rankpriority']; ?>:</span></td><td><input type="text" name="ranking" size="3" maxlength="3" value="<?php echo $row['ranking']; ?>"></td></tr>
		<tr><td valign="top"><span class="normal"><?php echo $admtext['active']; ?>:</span></td><td><span class="normal"><input type="radio" name="active" value="1" <?php if( $row['active'] ) echo "checked"; ?>> <?php echo $admtext['yes']; ?> &nbsp; <input type="radio" name="active" value="0" <?php if( !$row['active'] ) echo "checked"; ?>> <?php echo $admtext['no']; ?></span></td></tr>
	</table>
	<table>
	<tr><td valign="top" colspan="2">
	<p class="normal"><em><?php echo $admtext['instr']; ?></em></p>
	<p class="subhead"><br/><b><?php echo $admtext['choosedisplay']; ?>:</b></p></td></tr>
	<tr><td valign="top" colspan="2">
			<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top">
						<div class="reportbox">
							<ul id="displayavail" class="reportcol" style="height: 300px">
<?php
							foreach( $dfields as $key=>$value )
								echo "<li ondblclick=\"add_to_list(this,'displayfields');\">{$admtext[$value]}<span class=\"hidden\">$key</span></li>\n";
							//now do custom event types
							foreach( $cetypes as $cerow ) {
								$displaymsg = getEventDisplay( $cerow['display'] );
								echo "<li ondblclick=\"add_to_list(this,'displayfields');\">$displaymsg: {$admtext['rptdate']}<span class=\"hidden\">ce_dt_{$cerow['eventtypeID']}</span></li>\n";
								echo "<li ondblclick=\"add_to_list(this,'displayfields');\">$displaymsg: {$admtext['place']}<span class=\"hidden\">ce_pl_{$cerow['eventtypeID']}</span></li>\n";
								echo "<li ondblclick=\"add_to_list(this,'displayfields');\">$displaymsg: {$admtext['fact']}<span class=\"hidden\">ce_fa_{$cerow['eventtypeID']}</span></li>\n";
							}
?>						
							</ul>
						</div>
					</td>
					<td valign="top">
						<div class="reportbox">
							<ul id="displayfields" class="reportcol" style="height: 300px">
<?php
								$displayfields = explode( $lineending, $row['display'] );
								$num_displayfields = count($displayfields) - 1;
								for( $i = 0; $i < $num_displayfields; $i++ ) {
									$dfield = $displayfields[$i];
									if( $dfield == "lastname, firstname" )
										$dfield = "lastfirst";
									elseif( $dfield == "firstname, lastname" )
										$dfield = "fullname";
									if( isset($dfields[$dfield]) ) {
										$dtext = $dfields[$dfield];
										$displaymsg = $admtext[$dtext];
									}
									elseif( substr( $dfield, 0, 3 ) == "ce_") {
										$eventtypeID = substr( $dfield, 6 );
										$subtype = substr( $dfield, 3, 2 );
										$stdisplay = $subtypes[$subtype];
										$cerow = $cetypes[$eventtypeID];
										$displaymsg = getEventDisplay( $cerow['display'] ) . ": " . $stdisplay;
									}
									
									echo "<li ondblclick=\"$(this).remove();\">$displaymsg<span class=\"hidden\">$dfield</span></li>\n";
								}
?>
							</ul>
						</div>
						<br/>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td valign="top" colspan="2"><p class="subhead"><b><?php echo $admtext['choosecriteria']; ?>:</b></p></td></tr>
	<tr><td valign="top" colspan="2">
			<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top">
						<div class="reportbox">
							<ul id="availcriteria" class="reportcol" style="height: 250px">
<?php
							foreach( $cfields as $key=>$value ) {
								if( $key != "desc" )
									echo "<li ondblclick=\"add_to_list(this,'finalcriteria');\">" . $admtext[$value] . "<span class=\"hidden\">$key</span></li>\n";
							}
							echo "<li ondblclick=\"add_to_list(this,'finalcriteria');\">{$admtext['livingtrue']}<span class=\"hidden\">living</span></li>\n";
							echo "<li ondblclick=\"add_to_list(this,'finalcriteria');\">{$admtext['livingfalse']}<span class=\"hidden\">dead</span></li>\n";
							echo "<li ondblclick=\"add_to_list(this,'finalcriteria');\">{$admtext['privatetrue']}<span class=\"hidden\">private</span></li>\n";
							echo "<li ondblclick=\"add_to_list(this,'finalcriteria');\">{$admtext['privatefalse']}<span class=\"hidden\">open</span></li>\n";

							//now do custom event types, prefix with "ce_"
							foreach( $cetypes as $cerow ) {
								$displaymsg = getEventDisplay( $cerow['display'] );
								echo "<li ondblclick=\"add_to_list(this,'finalcriteria');\">$displaymsg: {$admtext['rptdate']}<span class=\"hidden\">ce_dt_{$cerow['eventtypeID']}</span></li>\n";
								echo "<li ondblclick=\"add_to_list(this,'finalcriteria');\">$displaymsg: {$admtext['rptdatetr']}<span class=\"hidden\">ce_tr_{$cerow['eventtypeID']}</span></li>\n";
								echo "<li ondblclick=\"add_to_list(this,'finalcriteria');\">$displaymsg: {$admtext['place']}<span class=\"hidden\">ce_pl_{$cerow['eventtypeID']}</span></li>\n";
								echo "<li ondblclick=\"add_to_list(this,'finalcriteria');\">$displaymsg: {$admtext['fact']}<span class=\"hidden\">ce_fa_{$cerow['eventtypeID']}</span></li>\n";
							}
?>						
							</ul>
						</div>
					</td>
					<td valign="top" rowspan="4">
						<div class="reportbox">
							<ul id="finalcriteria" class="reportcol" style="height: 610px">
<?php
								$criteriafields = explode( $lineending, $row['criteria'] );
								$mnemonics = array("eq","neq","gt","gte","lt","lte");
								$symbols = array("=","!=",">",">=","<","<=");
								$num_criteriafields = count($criteriafields) - 1;
								for( $i = 0; $i < $num_criteriafields; $i++ ) {
									//$cfield = preg_replace( "'\"'", "", $criteriafields[$i] );
									$cfield = $criteriafields[$i];
									if( isset($cfields[$cfield]) ) {
										$ctext = $cfields[$cfield];
										$displaymsg = $admtext[$ctext];
									}
									elseif( isset($ofields[$cfield]) ) {
										$ctext = $ofields[$cfield];
										$displaymsg = $admtext[$ctext];
									}
									elseif( substr( $cfield, 0, 3 ) == "ce_") {
										$eventtypeID = substr( $cfield, 6 );
										$subtype = substr( $cfield, 3, 2 );
										$stdisplay = $subtypes[$subtype];
										$cerow = $cetypes[$eventtypeID];
										$displaymsg = getEventDisplay( $cerow['display'] ) . ": " . $stdisplay;
									}
									else {
										$position = array_search($cfield,$symbols);
										if($position !== false) {
											$cfield = $mnemonics[$position];
											$displaymsg = $criteriafields[$i];
										}
										else {
											$position = array_search($cfield,$mnemonics);
											if($position !== false)
												$displaymsg = $symbols[$position];
											else
												$displaymsg = $criteriafields[$i];
										}
									}
									echo "<li ondblclick=\"$(this).remove();\">$displaymsg<span class=\"hidden\">$cfield</span></li>\n";
								}
?>
							</ul>
						</div>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<span class="normal indent-tiny"><?php echo $admtext['operators']; ?>:<br/></span>
						<div class="reportbox">
							<ul id="availoperators" class="reportcol" style="height: 200px">
								<li ondblclick="add_to_list(this,'finalcriteria');">=<span class="hidden">eq</span></li>
								<li ondblclick="add_to_list(this,'finalcriteria');">!=<span class="hidden">neq</span></li>
								<li ondblclick="add_to_list(this,'finalcriteria');">&gt;<span class="hidden">gt</span></li>
								<li ondblclick="add_to_list(this,'finalcriteria');">&gt;=<span class="hidden">gte</span></li>
								<li ondblclick="add_to_list(this,'finalcriteria');">&lt;<span class="hidden">lt</span></li>
								<li ondblclick="add_to_list(this,'finalcriteria');">&lt;=<span class="hidden">lte</span></li>
<?php
							foreach( $ofields as $key=>$value )
								echo "<li ondblclick=\"add_to_list(this,'finalcriteria');\">{$admtext[$value]}<span class=\"hidden\">$key</span></li>\n";
	?>						
								<li ondblclick="add_to_list(this,'finalcriteria');">(<span class="hidden">(</span></li>
								<li ondblclick="add_to_list(this,'finalcriteria');">)<span class="hidden">)</span></li>
								<li ondblclick="add_to_list(this,'finalcriteria');">+<span class="hidden">+</span></li>
								<li ondblclick="add_to_list(this,'finalcriteria');">-<span class="hidden">-</span></li>
							</ul>
						</div>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<span class="normal indent-tiny"><?php echo $admtext['constantstring']; ?>:*<br/></span>
						<input type="text" name="constantstring" class="medfield" onkeypress="return handleKey(event, 1);">&nbsp;
						<input type="button" value=">>" style="font-size: 11pt" onclick="AddConstant(document.form1.constantstring,1);"/>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<span class="normal indent-tiny"><?php echo $admtext['constantvalue']; ?>:<br/></span>
						<input type="text" name="constantvalue" class="medfield" onkeypress="return handleKey(event, 0);">&nbsp;
						<input type="button" value=">>" style="font-size: 11pt" onclick="AddConstant(document.form1.constantvalue,0);"/>
					</td>
				</tr>
			</table>
			<span class="normal indent-tiny">*<?php echo $admtext['foremptystring']; ?></span>
		</td>
	</tr>
	<tr><td valign="top" colspan="2"><br /><p class="subhead"><b><?php echo $admtext['choosesort']; ?>:</b></p></td></tr>
	<tr><td valign="top" colspan="2">
			<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top">
						<div class="reportbox">
							<ul id="availsort" class="reportcol" style="height: 250px">
<?php
								foreach( $cfields as $key=>$value )
									echo "<li ondblclick=\"add_to_list(this,'finalsort');\">{$admtext[$value]}<span class=\"hidden\">$key</span></li>\n";
								//now do custom event types, prefix with "ce_"
								foreach( $cetypes as $cerow ) {
									$displaymsg = getEventDisplay( $cerow['display'] );
									echo "<li ondblclick=\"add_to_list(this,'finalsort');\">$displaymsg: {$admtext['rptdate']}<span class=\"hidden\">ce_dt_{$cerow['eventtypeID']}</span></li>\n";
									echo "<li ondblclick=\"add_to_list(this,'finalsort');\">$displaymsg: {$admtext['rptdatetr']}<span class=\"hidden\">ce_tr_{$cerow['eventtypeID']}</span></li>\n";
									echo "<li ondblclick=\"add_to_list(this,'finalsort');\">$displaymsg: {$admtext['place']}<span class=\"hidden\">ce_pl_{$cerow['eventtypeID']}</span></li>\n";
									echo "<li ondblclick=\"add_to_list(this,'finalsort');\">$displaymsg: {$admtext['fact']}<span class=\"hidden\">ce_fa_{$cerow['eventtypeID']}</span></li>\n";
								}
?>
							</ul>
						</div>
					</td>
					<td valign="top">
						<div class="reportbox">
							<ul id="finalsort" class="reportcol" style="height: 250px">
<?php
								$orderbyfields = explode( $lineending, $row['orderby'] );
								$num_orderbyfields = count($orderbyfields) - 1;
								for( $i = 0; $i < $num_orderbyfields; $i++ ) {
									$sfield = $orderbyfields[$i];
									if( isset($cfields[$sfield]) ) {
										$stext = $cfields[$sfield];
										$displaymsg = $admtext[$stext];
									}
									elseif( substr( $sfield, 0, 3 ) == "ce_") {
										$eventtypeID = substr( $sfield, 6 );
										$subtype = substr( $sfield, 3, 2 );
										$stdisplay = $subtypes[$subtype];
										$cerow = $cetypes[$eventtypeID];
										$displaymsg = getEventDisplay( $cerow['display'] ) . ": " . $stdisplay;
									}
									
									echo "<li  ondblclick=\"$(this).remove();\">$displaymsg<span class=\"hidden\">$sfield</span></li>\n";
								}
?>
							</ul>
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td valign="top" colspan="2"><span class="normal"><br/><b><?php echo $admtext['altreport']; ?>:</b><br/></span></td></tr>
	<tr><td valign="top" colspan="2"><textarea cols="100" rows="10" name="sqlselect"><?php echo $row['sqlselect']; ?></textarea></td></tr>
	</table><br/>
	<input type="hidden" name="display" value="">
	<input type="hidden" name="criteria" value="">
	<input type="hidden" name="orderby" value="">
	<input type="hidden" name="reportID" value="<?php echo $reportID; ?>">
	<input type="submit" name="submitx" class="btn" value="<?php echo $admtext['saveback']; ?>">
	<input type="submit" name="submitx" class="btn saveret" value="<?php echo $admtext['saveback']; ?>">
	<input type="submit" name="submit" class="btn" value="<?php echo $admtext['savereturn']; ?>">
	<input type="submit" name="submit" class="btn savestay" value="<?php echo $admtext['savereturn']; ?>">
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="window.location.href='admin_reports.php';">
	&nbsp;&nbsp;
	<input type="checkbox" name="savecopy" value="1"/> <?php echo $admtext['savecopy']; ?>
	</form>
	</div>
</div>
<?php 
echo tng_adminfooter();
?>