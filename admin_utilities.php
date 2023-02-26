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

$fullbackuppath = !empty($tngconfig['saveconfig']) ? $subroot . $backuppath : $rootpath . $backuppath;

function getfiletime( $filename ) {
	global $fileflag, $time_offset;
	
	$filemodtime = "";
	if( $fileflag ) {
		$filemod = filemtime( $filename ) + (3600 * $time_offset);
		$filemodtime = date("F j, Y h:i:s A", $filemod);
	}
	return $filemodtime;
}

function getfilesize( $filename ) {
	global $fileflag;
	
	$filesize = "";
	if( $fileflag ) {
		$filesize = ceil( filesize( $filename )/1000 ) . " Kb";
	}
	return $filesize;
}

function doRow( $table_name, $display_name ) {
	global $admtext, $rootpath, $fullbackuppath, $backuppath, $tngconfig, $fileflag, $tngdomain;
	
	$ext = file_exists("$fullbackuppath/$table_name.sql") ? ".sql" : ".bak";
	$filename = "$fullbackuppath/$table_name$ext";
	$download = empty($tngconfig['saveconfig']) ? "$tngdomain/$backuppath/$table_name$ext" : "";
	echo "<tr>\n";
	echo "<td class=\"lightback\"><div class=\"action-btns\" style=\"width:97px\"><a href=\"#\" onclick=\"return startOptimize('$table_name');\" title=\"{$admtext['optimize']}\" class=\"smallicon admin-opt-icon\"></a>";
	echo "<a href=\"#\" onclick=\"return startBackup('$table_name');\" title=\"{$admtext['backup']}\" class=\"smallicon admin-save-icon\"></a>";
	$fileflag = $table_name && file_exists( $filename );
	echo "<a href=\"#\" id=\"rst_$table_name\" onclick=\"if( confirm('{$admtext['surerestore']}') ) {startRestore('$table_name') ;} return false;\" title=\"{$admtext['restore']}\" class=\"smallicon admin-rest-icon\"";
	if(!$fileflag) echo " style=\"visibility:hidden\"";
	echo "></a>";
	echo "<a href=\"$download\" id=\"dl_$table_name\" title=\"{$admtext['download']}\" class=\"smallicon admin-down-icon\"";
	if(!$fileflag || empty($download)) echo " style=\"visibility:hidden\"";
	echo " download></a>";
	echo "</div></td>";
	echo "<td class=\"lightback normal\" align=\"center\"><input type=\"checkbox\" class=\"tablechecks\" name=\"$table_name\" value=\"1\" style=\"margin: 0; padding: 0;\"></td>\n";
	echo "<td class=\"lightback normal\">$display_name &nbsp;</td>\n";
	echo "<td class=\"lightback normal\"><span id=\"time_$table_name\">" . getfiletime( $filename ) . "</span>&nbsp;</td>\n";
	echo "<td class=\"lightback normal\" align=\"right\"><span id=\"size_$table_name\">" . getfilesize( $filename ) . "</span>&nbsp;</td>\n";
	echo "<td class=\"lightback normal\"><span id=\"msg_$table_name\"></span>&nbsp;</td>\n";
	echo "</tr>\n";
}

$helplang = findhelp("backuprestore_help.php");

if( empty($sub) ) $sub = "tables";
if( !isset($message) ) $message = "";
tng_adminheader( $admtext['backuprestore'], $flags );
?>
<script type="text/javascript">
function toggleAll(flag) {
	for( var i = 0; i < document.form1.elements.length; i++ ) {
		if( document.form1.elements[i].type == "checkbox" && document.form1.elements[i].name.substr(0,2) != "do" ) {
			if( flag )
				document.form1.elements[i].checked = true;
			else
				document.form1.elements[i].checked = false;
		}
	}
}

function toggleSQL(el) {
	if(!el.checked) {
		document.getElementById('docreate').checked = false;
		document.getElementById('docreate').disabled = true;
		document.getElementById('dodrop').checked = false;
		document.getElementById('dodrop').disabled = true;
	}
	else {
		document.getElementById('docreate').disabled = false;
		document.getElementById('dodrop').disabled = false;
	}
}

function toggleCreate(el) {
	if(!el.checked) {
		document.getElementById('dodrop').checked = false;
		document.getElementById('dodrop').disabled = true;
	}
	else {
		document.getElementById('dodrop').disabled = false;
	}
}

function startUtility(sel) {
	if(sel.selectedIndex < 1) return false;
	var checks = jQuery('.tablechecks');
	var totalchecked = 0;
	checks.each(function(index,item) {
		if(item.checked) {
			totalchecked = 1;
		}
	});
	if(totalchecked) {
		var selval = sel.options[sel.selectedIndex].value;
		var form = document.form1;
		switch(selval) {
			case "backupall":
				form.action='admin_backup.php';
				form.submit();
				break;
			case "optimizeall":
				form.action='admin_optimize.php';
				form.submit();
				break;
			case "restoreall":
				if(confirm('<?php echo $admtext['surerestore']; ?>')) {
					form.action='admin_restore.php';
					form.submit();
				}
				break;
			case "delete":
				if(confirm('<?php echo $admtext['suredelbk']; ?>')) {
					form.table.value='del';
					form.action='admin_backup.php?table=del';
					form.submit();
				}
				break;
		}
	}
	else {
		alert('<?php echo $admtext['seltable']; ?>');
		sel.selectedIndex = 0;
	}
	return false;
}

function startBackup(table) {
	var dosql = document.getElementById('dosql').checked;
	var docreate = document.getElementById('docreate').checked;
	var dodrop = document.getElementById('dodrop').checked;
	var params = {table:table,dosql:dosql,docreate:docreate,dodrop:dodrop};
	jQuery('#msg_'+table).html('<img src="img/spinner.gif" />');
	jQuery.ajax({
		url: 'admin_backup.php',
		data: params,
		dataType: 'html',
		success: function(req) {
			var pairs = req.split('&');
			var table = pairs[0];
			var timestamp = pairs[1];
			var size = pairs[2];
			var filename = pairs[3];
			var message = pairs[4];
			jQuery('#msg_'+table).html(message);
			jQuery('#msg_'+table).effect('highlight',{},500);
			jQuery('#time_'+table).html(timestamp);
			jQuery('#time_'+table).effect('highlight',{},500);
			jQuery('#size_'+table).html(size);
			jQuery('#size_'+table).effect('highlight',{},500);
			jQuery('#rst_'+table).css('visibility','visible');
			jQuery('#dl_'+table).css('visibility','visible');
			jQuery('#dl_'+table).attr('href', filename);
		}
	});
	return false;
}

function startOptimize(table) {
	var params = {table:table};
	jQuery('#msg_'+table).html('<img src="img/spinner.gif" />');
	jQuery.ajax({
		url: 'admin_optimize.php',
		data: params,
		dataType: 'html',
		success: function(req) {
			var pairs = req.split('&');
			var table = pairs[0];
			var message = pairs[1];
			jQuery('#msg_'+table).html(message);
			jQuery('#msg_'+table).effect('highlight',{},500);
		}
	});
	return false;
}

function startRestore(table) {
	var dodel = document.getElementById('dodel').checked;
	var params = {table:table,dodel:dodel};
	jQuery('#msg_'+table).html('<img src="img/spinner.gif" />');
	jQuery.ajax({
		url: 'admin_restore.php',
		data: params,
		dataType: 'html',
		success: function(req) {
			var pairs = req.split('&');
			var table = pairs[0];
			var message = pairs[1];
			jQuery('#msg_'+table).html(message);
			jQuery('#msg_'+table).effect('highlight',{},500);
		}
	});
	return false;
}
</script>
</head>

<?php
	echo tng_adminlayout();

	$utiltabs['0'] = array(1,"admin_utilities.php?sub=tables",$admtext['tables'],"tables");
	$utiltabs['1'] = array(1,"admin_utilities.php?sub=structure",$admtext['tablestruct'],"structure");
	$utiltabs['2'] = array(1,"admin_renumbermenu.php",$admtext['renumber'],"renumber");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/backuprestore_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($utiltabs,$sub,$innermenu);
	$headline = $sub == "tables" ? $admtext['backuprestore'] . " &gt;&gt; " . $admtext['backuprestoretables'] : $admtext['backuprestore'] . " &gt;&gt; " . $admtext['backupstruct'];
	echo displayHeadline($headline, "img/backuprestore_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">
<?php
	if( $sub == "tables" ) {
?>
	<p class="normal"><i><?php echo $admtext['brinstructions']; ?></i></p>

	<p class="subhead"><strong><?php echo $admtext['backuprestoretables']; ?></strong></p>
	<p class="normal"><?php echo $admtext['backupnote']; ?></p>
	<div class="normal">
	<form action="" name="form1" id="form1" onsubmit="return startUtility(document.form1.withsel);">
		<p>
<?php
	echo "{$admtext['onbackup']}: ";
	echo "<input type=\"checkbox\" name=\"dosql\" value=\"1\" id=\"dosql\" checked onchange=\"toggleSQL(this);\"> {$admtext['dosql']} &nbsp;";
	echo "<input type=\"checkbox\" name=\"docreate\" value=\"1\" id=\"docreate\" checked onchange=\"toggleCreate(this);\"> {$admtext['docreate']} &nbsp;";
	echo "<input type=\"checkbox\" name=\"dodrop\" value=\"1\" id=\"dodrop\" checked> {$admtext['dodrop']}";
	echo " &nbsp; << <a href=\"#\" onclick=\"return openHelp('$helplang/backuprestore_help.php');\">{$admtext['help']}</a>";
?>
		</p>
		<p>
<?php
	echo "{$admtext['onrestore']}: ";
	echo "<input type=\"checkbox\" name=\"dodel\" value=\"1\" id=\"dodel\" checked> {$admtext['dodel']} &nbsp;";
?>
		</p>
		<p>
		<input type="hidden" name="table" value="all">
		<input type="button" name="selectall" value="<?php echo $admtext['selectall']; ?>" onclick="toggleAll(1);">
		<input type="button" name="clearall" value="<?php echo $admtext['clearall']; ?>" onclick="toggleAll(0);">&nbsp;&nbsp;
		<?php echo $admtext['wsel']; ?>
		<select name="withsel">
			<option value=""></option>
			<option value="backupall"><?php echo $admtext['backup']; ?></option>
			<option value="optimizeall"><?php echo $admtext['optimize']; ?></option>
			<option value="restoreall"><?php echo $admtext['restore']; ?></option>
			<option value="delete"><?php echo $admtext['text_delete']; ?></option>
		</select>
		<input type="submit" name="go" value="<?php echo $admtext['go']; ?>">
		</p>

		<table cellpadding="3" cellspacing="1" border="0" class="normal rounded-table">
			<tr>
				<td class="fieldnameback fieldname"><nobr>&nbsp;<b><?php echo $admtext['action']; ?></b>&nbsp;</nobr></td>
				<td class="fieldnameback fieldname"><nobr>&nbsp;<b><?php echo $admtext['select']; ?></b>&nbsp;</nobr></td>
				<td class="fieldnameback fieldname"><nobr>&nbsp;<b><?php echo $admtext['table']; ?></b>&nbsp;</nobr></td>
				<td class="fieldnameback fieldname"><nobr>&nbsp;<b><?php echo $admtext['lastbackup']; ?></b>&nbsp;</nobr></td>
				<td class="fieldnameback fieldname"><nobr>&nbsp;<b><?php echo $admtext['backupfilesize']; ?></b>&nbsp;</nobr></td>
				<td class="fieldnameback fieldname" style="width:200px"><nobr>&nbsp;<b><?php echo $admtext['msg']; ?></b>&nbsp;</nobr></td>
			</tr>
<?php
	doRow( $address_table, $admtext['addresstable'] );
	doRow( $albums_table, $admtext['albums'] );
	doRow( $album2entities_table, $admtext['album2entitiestable'] );
	doRow( $albumlinks_table, $admtext['albumlinkstable'] );
	doRow( $assoc_table, $admtext['associations'] );
	doRow( $branches_table, $admtext['branches'] );
	doRow( $branchlinks_table, $admtext['brlinkstable'] );
	doRow( $cemeteries_table, $admtext['cemeteries'] );
	doRow( $children_table, $admtext['children'] );
	doRow( $countries_table, $admtext['countriestable'] );
	doRow( $dna_groups_table, $admtext['dna_groups'] );
	doRow( $dna_links_table, $admtext['dna_links'] );
	doRow( $dna_tests_table, $admtext['dna_tests'] );
	doRow( $events_table, $admtext['events'] );
	doRow( $eventtypes_table, $admtext['eventtypes'] );
	doRow( $families_table, $admtext['families'] );
	doRow( $image_tags_table, $admtext['imgtags'] );
	doRow( $languages_table, $admtext['languages'] );
	doRow( $media_table, $admtext['mediatable'] );
	doRow( $medialinks_table, $admtext['medialinkstable'] );
	doRow( $mediatypes_table, $admtext['mediatypes'] );
	doRow( $mostwanted_table, $admtext['mostwanted'] );
	doRow( $notelinks_table, $admtext['notelinkstable'] );
	doRow( $xnotes_table, $admtext['notes'] );
	doRow( $people_table, $admtext['people'] );
	doRow( $places_table, $admtext['places'] );
	doRow( $reports_table, $admtext['reports'] );
	doRow( $sources_table, $admtext['sources'] );
	doRow( $repositories_table, $admtext['repositories'] );
	doRow( $citations_table, $admtext['citations'] );
	doRow( $states_table, $admtext['statestable'] );
	doRow( $temp_events_table, $admtext['temptable'] );
	doRow( $templates_table, $admtext['templatestable'] );
	doRow( $tlevents_table, $admtext['tleventstable'] );
	doRow( $trees_table, $admtext['trees'] );
	doRow( $users_table, $admtext['users'] );
?>
		</table>
	</form>

	</div>

<?php
	}
	elseif( $sub == "structure" ) {
?>
	<p class="normal"><i><?php echo $admtext['brinstructions2']; ?></i></p>

	<p class="subhead"><strong><?php echo $admtext['backupstruct']; ?></strong></p>
	<div class="normal">
	<table cellpadding="3" cellspacing="1" border="0" class="normal  rounded-table">
		<tr>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['action']; ?></b>&nbsp;</nobr></span></td>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['lastbackup']; ?></b>&nbsp;</nobr></span></td>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['backupfilesize']; ?></b>&nbsp;</nobr></span></td>
		</tr>
		<tr>
			<td class="lightback"><div class="action-btns"><a href="admin_backup.php?table=struct" title="<?php echo $admtext['backup']; ?>" class="smallicon admin-save-icon"></a>
<?php
	$ext = file_exists("$fullbackuppath/tng_tablestructure.sql") ? ".sql" : ".bak";
	$filename = "$fullbackuppath/tng_tablestructure{$ext}";
	if( $ext == ".sql" || file_exists($filename) ) {
		$fileflag = 1;
?>
		<a href="admin_restore.php?table=struct" onClick="return confirm('<?php echo $admtext['surerestorets']; ?>');" title="<?php echo $admtext['restore']; ?>" class="smallicon admin-rest-icon"></a>
<?php
		if(empty($tngconfig['saveconfig'])) {
?>
		<a href="<?php echo "$tngdomain/$backuppath/tng_tablestructure{$ext}"; ?>" title="<?php echo $admtext['download']; ?>" class="smallicon admin-down-icon"></a>
<?php
		}
	}
	else
		$fileflag = 0;
?>
				</div>
			</td>
<?php
	if( $fileflag ) {
		echo "<td class=\"lightback\"><span class=\"normal\"><nobr>&nbsp;" . getfiletime( "$fullbackuppath/tng_tablestructure{$ext}" ) . "&nbsp;</nobr></span></td>\n";
		echo "<td class=\"lightback\" align=\"right\"><span class=\"normal\"><nobr>&nbsp;" . getfilesize("$fullbackuppath/tng_tablestructure{$ext}") . "&nbsp;</nobr></span></td>\n";
	}
	else {
		echo "<td class=\"lightback\"><span class=\"normal\">&nbsp;</span></td>\n";
		echo "<td class=\"lightback\" align=\"right\"><span class=\"normal\">&nbsp;</span></td>\n";
	}
?>
		</tr>
	</table>

	</div>
<?php
	}
?>
</div>
<?php 
echo tng_adminfooter();
?>