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

$showrepo_url = getURL( "showrepo", 1 );

$repoID = ucfirst( $repoID );

$query = "SELECT treename FROM $trees_table WHERE gedcom = \"$tree\"";
$result = tng_query($query);
$treerow = tng_fetch_assoc( $result );
tng_free_result($result);

$query = "SELECT reponame, changedby, $repositories_table.addressID, address1, address2, city, state, zip, country, phone, email, www, DATE_FORMAT(changedate,\"%d %b %Y %H:%i:%s\") as changedate FROM $repositories_table LEFT JOIN $address_table on $repositories_table.addressID = $address_table.addressID WHERE repoID = \"$repoID\" AND $repositories_table.gedcom = \"$tree\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
tng_free_result($result);
$row['reponame'] = preg_replace("/\"/", "&#34;",$row['reponame']);

$row['allow_living'] = 1;

$query = "SELECT DISTINCT eventID as eventID FROM $notelinks_table WHERE persfamID=\"$repoID\" AND gedcom =\"$tree\"";
$notelinks = tng_query($query);
$gotnotes = array();
while( $note = tng_fetch_assoc( $notelinks ) ) {
	if( !$note['eventID'] ) $note['eventID'] = "general";
	$gotnotes[$note['eventID']] = "*";
}

$helplang = findhelp("repositories_help.php");

tng_adminheader( $admtext['modifyrepo'], $flags );
$photo = showSmallPhoto( $repoID, $row['reponame'], 1, 0, "R" );
include_once("eventlib.php");
include_once("eventlib_js.php");
?>
<script type="text/javascript">
<?php if(!empty($ref)) { echo "window.opener.location.reload(false);\n"; } ?>
var persfamID = "<?php echo $repoID; ?>";
var allow_cites = false;
var allow_notes = true;
</script>
<script type="text/javascript" src="js/admin.js"></script>
</head>

<?php
	echo tng_adminlayout();

	$repotabs[0] = array(1,"admin_repositories.php",$admtext['search'],"findrepo");
	$repotabs[1] = array($allow_add,"admin_newrepo.php",$admtext['addnew'],"addrepo");
	$repotabs[2] = array($allow_edit && $allow_delete,"admin_mergerepos.php",$admtext['merge'],"merge");
	$repotabs[3] = array($allow_edit,"admin_editrepo.php?repoID=$repoID&amp;tree=$tree",$admtext['edit'],"edit");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/repositories_help.php#repoedit');\" class=\"lightlink\">{$admtext['help']}</a>";
	$innermenu .= " &nbsp;|&nbsp; <a href=\"$showrepo_url" . "repoID=$repoID&amp;tree=$tree\" target=\"_blank\" class=\"lightlink\">{$admtext['test']}</a>";
	if( $allow_add && ( !$assignedtree || $assignedtree == $tree ) )
		$innermenu .= " &nbsp;|&nbsp; <a href=\"admin_newmedia.php?personID=$repoID&amp;tree=$tree&amp;linktype=R\" class=\"lightlink\">{$admtext['addmedia']}</a>";
	$menu = doMenu($repotabs,"edit",$innermenu);
	echo displayHeadline($admtext['repositories'] . " &gt;&gt; " . $admtext['modifyrepo'], "img/repos_icon.gif",$menu,$message);
?>

<div class="admin-main">
<form action="admin_updaterepo.php" method="post" name="form1" >
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="adm-rounded-table">
<tr>
<td class="tngshadow databack">
	<table cellpadding="0" cellspacing="0" class="normal">
		<tr>
			<td valign="top"><div id="thumbholder" style="margin-right:5px;<?php if(!$photo) echo "display:none"; ?>"><?php echo $photo; ?></div></td>
			<td>
				<span class="plainheader"><?php echo $row['reponame'] . " ($repoID)</span>"; ?>
				<div class="topbuffer bottombuffer smallest">
<?php
				$notesicon = !empty($gotnotes['general']) ? "admin-note-on-icon" : "admin-note-off-icon";
				$return = !empty($cw) ? "saveclose" : "saveret";
				echo "<a href=\"#\" onclick=\"jQuery('#{$return}').click();\" class=\"smallicon si-plus admin-save-icon\">{$admtext['save']}</a>\n";
				echo "<a href=\"#\" onclick=\"return showNotes('', '$repoID');\" id=\"notesicon\" class=\"smallicon si-plus $notesicon\">{$admtext['notes']}</a>\n";
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
			&nbsp;(<a href="#" onclick="return openChangeTree('source','<?php echo $tree; ?>','<?php if( isset($sourceID) ) echo $sourceID; ?>');"><img src="img/ArrowDown.gif" border="0" style="margin-left:-4px;margin-right:-2px"><?php echo $admtext['edit']; ?></a> )
		</td>
	</tr>
	<tr><td><?php echo $admtext['name']; ?>:</td><td><input type="text" name="reponame" size="40" value="<?php echo $row['reponame']; ?>"> (<?php echo $admtext['required']; ?>)</td></tr>
	<tr><td><?php echo $admtext['address1']; ?>:</td><td><input type="text" name="address1" size="50" value="<?php echo $row['address1']; ?>"></td></tr>
	<tr><td><?php echo $admtext['address2']; ?>:</td><td><input type="text" name="address2" size="50" value="<?php echo $row['address2']; ?>"></td></tr>
	<tr><td><?php echo $admtext['city']; ?>:</td><td><input type="text" name="city" size="50" value="<?php echo $row['city']; ?>"></td></tr>
	<tr><td><?php echo $admtext['stateprov']; ?>:</td><td><input type="text" name="state" size="50" value="<?php echo $row['state']; ?>"></td></tr>
	<tr><td><?php echo $admtext['zip']; ?>:</td><td><input type="text" name="zip" size="20" value="<?php echo $row['zip']; ?>"></td></tr>
	<tr><td><?php echo $admtext['countryaddr']; ?>:</td><td><input type="text" name="country" size="50" value="<?php echo $row['country']; ?>"></td></tr>
	<tr><td><?php echo $admtext['phone']; ?>:</td><td><input type="text" name="phone" size="30" value="<?php echo $row['phone']; ?>"></td></tr>
	<tr><td><?php echo $admtext['email']; ?>:</td><td><input type="text" name="email" size="50" value="<?php echo $row['email']; ?>"></td></tr>
	<tr><td><?php echo $admtext['website']; ?>:</td><td><input type="text" name="www" size="50" value="<?php echo $row['www']; ?>"></td></tr>
		<tr>
			<td colspan="2">
				<br/>
				<p><strong class="subhead">
<?php 
	echo $admtext['otherevents'] . ": &nbsp;<input type=\"button\" value=\"  {$admtext['addnew']}  \" onclick=\"newEvent('R','$repoID','$tree');\">\n";
?>
				</strong></p>
			</td>
		</tr>
<?php
		showCustEvents($repoID);
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
		$close_command = "window.location.href='admin_repositories.php';";
	}
?>
	<input type="submit" name="savestay" id="savestay" class="btn" value="<?php echo $admtext['savereturn']; ?>" />
	<input type="submit" name="savestay" id="savestay2" class="btn savestay" value="<?php echo $admtext['savereturn']; ?>" />
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="<?php echo $close_command; ?>">
	</p>
	<input type="hidden" name="tree" value="<?php echo $tree; ?>">
	<input type="hidden" name="addressID" value="<?php echo $row['addressID']; ?>">
	<input type="hidden" name="repoID" value="<?php echo "$repoID"; ?>">
	<input type="hidden" value="<?php if( isset($cw) ) echo $cw; /*stands for "close window" */ ?>" name="cw">
</td>
</tr>

</table>
</form>
</div>

<?php 
echo tng_adminfooter();
?>