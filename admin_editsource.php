<?php
include("begin.php");
include("adminlib.php");
$textpart = "sources";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( (!$allow_edit && (!$allow_add || !$added)) || ( $assignedtree && $assignedtree != $tree ) ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$showsource_url = getURL( "showsource", 1 );

initMediaTypes();

$sourceID = ucfirst( $sourceID );

$query = "SELECT treename FROM $trees_table WHERE gedcom = \"$tree\"";
$result = tng_query($query);
$treerow = tng_fetch_assoc( $result );
tng_free_result($result);

$query = "SELECT *, DATE_FORMAT(changedate,\"%d %b %Y %H:%i:%s\") as changedate FROM $sources_table WHERE sourceID = \"$sourceID\" AND gedcom = \"$tree\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
tng_free_result($result);
$row['shorttitle'] = preg_replace("/\"/", "&#34;",$row['shorttitle']);
$row['title'] = preg_replace("/\"/", "&#34;",$row['title']);
$row['author'] = preg_replace("/\"/", "&#34;",$row['author']);
$row['callnum'] = preg_replace("/\"/", "&#34;",$row['callnum']);
$row['publisher'] = preg_replace("/\"/", "&#34;",$row['publisher']);
$row['actualtext'] = preg_replace("/\"/", "&#34;",$row['actualtext']);

$sourcename = $row['title'] ? $row['title'] : $row['shorttitle'];
$row['allow_living'] = 1;

$query = "SELECT DISTINCT eventID as eventID FROM $notelinks_table WHERE persfamID=\"$sourceID\" AND gedcom =\"$tree\"";
$notelinks = tng_query($query);
$gotnotes = array();
while( $note = tng_fetch_assoc( $notelinks ) ) {
	if( !$note['eventID'] ) $note['eventID'] = "general";
	$gotnotes[$note['eventID']] = "*";
}

$helplang = findhelp("sources_help.php");

tng_adminheader( $admtext['modifysource'], $flags );
$photo = showSmallPhoto( $sourceID, $sourcename, 1, 0, "S" );
include_once("eventlib.php");
include_once("eventlib_js.php");
?>
<script type="text/javascript">
<?php if(!empty($ref)) { echo "window.opener.location.reload(false);\n"; } ?>
var persfamID = "<?php echo $sourceID; ?>";
var allow_cites = false;
var allow_notes = true;
</script>
<script type="text/javascript" src="js/selectutils.js"></script>
<script type="text/javascript" src="js/admin.js"></script>
</head>

<?php
	echo tng_adminlayout();

	$sourcetabs[0] = array(1,"admin_sources.php",$admtext['search'],"findsource");
	$sourcetabs[1] = array($allow_add,"admin_newsource.php",$admtext['addnew'],"addsource");
	$sourcetabs[2] = array($allow_edit && $allow_delete,"admin_mergesources.php",$admtext['merge'],"merge");
	$sourcetabs[3] = array($allow_edit,"admin_editsource.php?sourceID=$sourceID&amp;tree=$tree",$admtext['edit'],"edit");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/sources_help.php#edit');\" class=\"lightlink\">{$admtext['help']}</a>";
	$innermenu .= " &nbsp;|&nbsp; <a href=\"$showsource_url" . "sourceID=$sourceID&amp;tree=$tree\" target=\"_blank\" class=\"lightlink\">{$admtext['test']}</a>";
	if( $allow_add && ( !$assignedtree || $assignedtree == $tree ) )
		$innermenu .= " &nbsp;|&nbsp; <a href=\"admin_newmedia.php?personID=$sourceID&amp;tree=$tree&amp;linktype=S\" class=\"lightlink\">{$admtext['addmedia']}</a>";
	$menu = doMenu($sourcetabs,"edit",$innermenu);
	echo displayHeadline($admtext['sources'] . " &gt;&gt; " . $admtext['modifysource'],"img/sources_icon.gif",$menu,$message);
?>

<div class="admin-main">
<form action="admin_updatesource.php" method="post" name="form1" >
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="adm-rounded-table">
<tr>
<td class="tngshadow databack">
	<table cellpadding="0" cellspacing="0" class="normal">
		<tr>
			<td valign="top"><div id="thumbholder" style="margin-right:5px;<?php if(!$photo) echo "display:none"; ?>"><?php echo $photo; ?></div></td>
			<td>
				<span class="plainheader"><?php echo "$sourcename ($sourceID)</span>"; ?>
				<div class="topbuffer bottombuffer smallest">
<?php
				$notesicon = !empty($gotnotes['general']) ? "admin-note-on-icon" : "admin-note-off-icon";
				$return = !empty($cw) ? "saveclose" : "saveret";
				echo "<a href=\"#\" onclick=\"jQuery('#{$return}').click();\" class=\"smallicon si-plus admin-save-icon\">{$admtext['save']}</a>\n";
				echo "<a href=\"#\" onclick=\"return showNotes('', '$sourceID');\" id=\"notesicon\" class=\"smallicon si-plus $notesicon\">{$admtext['notes']}</a>\n";
?>
                <br clear="all" />
				</div>
				<span class="smallest"><?php echo $admtext['lastmodified'] . ": {$row['changedate']} ({$row['changedby']})"; ?></span>
			</td>
		</tr>
	</table>
</td>
</tr>
<tr>
<td class="tngshadow databack">
	<table class="normal" id="events_table">
	<tr><td><?php echo $admtext['tree']; ?>:</td>
		<td>
			<?php echo $treerow['treename']; ?>
			&nbsp;(<a href="#" onclick="return openChangeTree('source','<?php echo $tree; ?>','<?php echo $sourceID; ?>');"><img src="img/ArrowDown.gif" border="0" style="margin-left:-4px;margin-right:-2px"><?php echo $admtext['edit']; ?></a> )
		</td>
	</tr>
	<tr><td><?php echo $admtext['shorttitle']; ?>:</td><td><input type="text" name="shorttitle" size="40" value="<?php echo $row['shorttitle']; ?>"> (<?php echo $admtext['required']; ?>)</td></tr>
	<tr><td><?php echo $admtext['longtitle']; ?>:</td><td><input type="text" name="title" size="50" value="<?php echo $row['title']; ?>"></td></tr>
	<tr><td><?php echo $admtext['author']; ?>:</td><td><input type="text" name="author" size="40" value="<?php echo $row['author']; ?>"></td></tr>
	<tr><td><?php echo $admtext['callnumber']; ?>:</td><td><input type="text" name="callnum" size="20" value="<?php echo $row['callnum']; ?>"></td></tr>
	<tr><td><?php echo $admtext['publisher']; ?>:</td><td><input type="text" name="publisher" size="40" value="<?php echo $row['publisher']; ?>"></td></tr>
	<tr>
		<td><?php echo $admtext['repository']; ?>:</td>
		<td>
			<select name="repoID">
				<option value=""></option>
<?php
$query = "SELECT repoID, reponame, gedcom FROM $repositories_table WHERE gedcom = \"$tree\" ORDER BY reponame";
$reporesult = tng_query($query);

$treequery = "SELECT count(gedcom) as treecount FROM $trees_table";
$treeresult = tng_query($treequery);
$treerow = tng_fetch_assoc($treeresult);
$numtrees = $treerow['treecount'];
tng_free_result($treeresult);

while( $reporow = tng_fetch_assoc($reporesult) ) {
	echo "		<option value=\"{$reporow['repoID']}\"";
	if( $reporow['repoID'] == $row['repoID'] ) echo " selected";
	if( !$assignedtree && $numtrees > 1 )
		echo ">{$reporow['reponame']} ({$admtext['tree']}: {$reporow['gedcom']})</option>\n";
	else
		echo ">{$reporow['reponame']}</option>\n";
}
tng_free_result( $reporesult );
?>
			</div>
		</td>
	</tr>
	<tr><td valign="top"><?php echo $admtext['actualtext']; ?>:</td><td><textarea cols="80" rows="15" name="actualtext"><?php echo $row['actualtext']; ?></textarea></td></tr>
		<tr>
			<td colspan="2">
				<br/>
				<p><strong class="subhead">
<?php 
	echo $admtext['otherevents'] . ": &nbsp;<input type=\"button\" value=\"  {$admtext['addnew']}  \" onclick=\"newEvent('S','$sourceID','$tree');\">\n";
?>
				</strong></p>
			</td>
		</tr>
<?php
		showCustEvents($sourceID);
?>
	</table>
</td>
</tr>
<tr>
<td class="tngshadow databack">
	<p class="normal">
<?php
	if(!empty($cw)) {
?>
	<input type="submit" name="saveclose" id="saveclose" class="btn" accesskey="s" value="<?php echo $admtext['saveback']; ?>" />
	<input type="submit" name="saveclose" id="saveret2" class="btn saveret" accesskey="s" value="<?php echo $admtext['saveback']; ?>" />
<?php
		$close_command = "window.close();";
	} else {
?>
	<input type="submit" name="saveret" id="saveret" class="btn" accesskey="s" value="<?php echo $admtext['saveback']; ?>" />
	<input type="submit" name="saveret" id="saveret2" class="btn saveret" accesskey="s" value="<?php echo $admtext['saveback']; ?>" />
<?php
		$close_command = "window.location.href='admin_sources.php';";
	}
?>
	<input type="submit" name="savestay" id="savestay" class="btn" value="<?php echo $admtext['savereturn']; ?>" />
	<input type="submit" name="savestay" id="savestay2" class="btn savestay" value="<?php echo $admtext['savereturn']; ?>" />
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="<?php echo $close_command; ?>">
	</p>
	<input type="hidden" name="tree" value="<?php echo $tree; ?>">
	<input type="hidden" name="sourceID" value="<?php echo "$sourceID"; ?>">
	<input type="hidden" value="<?php if( isset($cw) ) echo $cw; /*stands for "close window" */ ?>" name="cw">
</td>
</tr>

</table>
</form>
</div>

<?php 
echo tng_adminfooter();
?>