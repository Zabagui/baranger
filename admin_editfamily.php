<?php
include("begin.php");
include("adminlib.php");
$textpart = "families";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

$familyID = ucfirst( $familyID );
$query = "SELECT *, DATE_FORMAT(changedate,\"%d %b %Y %H:%i:%s\") as changedate FROM $families_table WHERE familyID = \"$familyID\" AND gedcom = \"$tree\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
tng_free_result($result);
$row['marrplace'] = preg_replace("/\"/", "&#34;",$row['marrplace']);
$row['sealplace'] = preg_replace("/\"/", "&#34;",$row['sealplace']);
$row['divplace'] = preg_replace("/\"/", "&#34;",$row['divplace']);
//$row['notes'] = preg_replace("/\"/", "&#34;",$row['notes']);

if( (!$allow_edit && (!$allow_add || !$added)) || ( $assignedtree && $assignedtree != $tree ) || !checkbranch( $row['branch'] ) ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$editconflict = determineConflict($row,$families_table);
if($tngconfig['edit_timeout'] === "")
	$tngconfig['edit_timeout'] = 15;
$warnsecs = (intval($tngconfig['edit_timeout']) - 2) * 60 * 1000;

function getBirth($row) {
    global $admtext;

    $birthstring = $deathstring = "";
    if( $row['birthdate'] ) {
        $birthstring = "{$admtext['birthabbr']} " . displayDate($row['birthdate']);
    }
    else if( $row['altbirthdate'] ) {
        $birthstring = "{$admtext['chrabbr']} " . displayDate($row['altbirthdate']);
    }
	if( $row['deathdate'] ) {
		$deathstring = $admtext['deathabbr'] . " " . displayDate($row['deathdate']);
	}
	else if( $row['burialdate'] ) {
		$deathstring = $admtext['burialabbr'] . " " . displayDate($row['burialdate']);
	}
	if($birthstring && $deathstring) $deathstring = ", " . $deathstring;
    if($birthstring || $deathstring) $birthstring = " ($birthstring$deathstring)";
    return $birthstring;
}

$familygroup_url = getURL( "familygroup", 1 );

$righttree = checktree($tree);
$rightbranch = $righttree ? checkbranch($row['branch']) : false;
$rights = determineLivingPrivateRights($row, $righttree, $rightbranch);
$row['allow_living'] = $rights['living'];
$row['allow_private'] = $rights['private'];

$namestr = getFamilyName($row) . " ($familyID)";

$query = "SELECT treename FROM $trees_table WHERE gedcom = \"$tree\"";
$result = tng_query($query);
$treerow = tng_fetch_assoc( $result );
tng_free_result($result);

$query = "SELECT DISTINCT eventID as eventID FROM $notelinks_table WHERE persfamID=\"$familyID\" AND gedcom =\"$tree\"";
$notelinks = tng_query($query);
$gotnotes = array();
while( $note = tng_fetch_assoc( $notelinks ) ) {
	if( !$note['eventID'] ) $note['eventID'] = "general";
	$gotnotes[$note['eventID']] = "*";
}

$citquery = "SELECT DISTINCT eventID FROM $citations_table WHERE persfamID = \"$familyID\" AND gedcom = \"$tree\"";
$citresult = tng_query($citquery) or die ($admtext['cannotexecutequery'] . ": $citquery");
$gotcites = array();
while( $cite = tng_fetch_assoc( $citresult ) ) {
	if( !$cite['eventID'] ) $cite['eventID'] = "general";
	$gotcites[$cite['eventID']] = "*";
}

$assocquery = "SELECT count(assocID) as acount FROM $assoc_table WHERE personID = \"$familyID\" AND gedcom = \"$tree\"";
$assocresult = tng_query($assocquery) or die ($admtext['cannotexecutequery'] . ": $assocquery");
$assocrow = tng_fetch_assoc( $assocresult );
$gotassoc = $assocrow['acount'] ? "*" : "";
tng_free_result($assocresult);

$query = "SELECT parenttag FROM $events_table WHERE persfamID=\"$familyID\" AND gedcom =\"$tree\"";
$morelinks = tng_query($query);
$gotmore = array();
while( $more = tng_fetch_assoc( $morelinks ) ) {
	$gotmore[$more['parenttag']] = "*";
}

$query = "SELECT $people_table.personID, $people_table.personID as pID, firstname, lastname, lnprefix, prefix, suffix, title, nameorder, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, burialdate, living, private, branch, $people_table.gedcom FROM $people_table, $children_table WHERE $people_table.personID = $children_table.personID AND $children_table.familyID = \"$familyID\" AND $people_table.gedcom = \"$tree\" AND $children_table.gedcom = \"$tree\" ORDER BY ordernum";
$children= tng_query($query);

$kidcount = tng_num_rows( $children );

$helplang = findhelp("families_help.php");

$revstar = checkReview("F");

tng_adminheader( $admtext['modifyfamily'], $flags );
$photo = showSmallPhoto( $familyID, $namestr, 1, 0, "F" );
include_once("eventlib.php");
include_once("eventlib_js.php");
?>
<script type="text/javascript">
<?php if(!empty($ref)) { echo "window.opener.location.reload(false);\n"; } ?>
var persfamID = "<?php echo $familyID; ?>";
var childcount = <?php echo $kidcount; ?>;
var allow_cites = true;
var allow_notes = true;

function toggleAll(display) {
	toggleSection('spouses','plus0',display);
	toggleSection('events','plus1',display);
	toggleSection('children','plus2',display);
	return false;
}

function startSort() {
	jQuery('#childrenlist').sortable({
		helper: 'clone',
		axis:'y',
		scroll: false,
		items: '.sortrow',
		update:updateChildrenOrder
	});
}

jQuery(document).ready(startSort);

function updateChildrenOrder(id) {
	var childrenlist = removePrefixFromArray(jQuery('#childrenlist').sortable('toArray'), 'child_');

	var params = {sequence:childrenlist.join(','),action:'childorder',familyID:persfamID,tree:tree};
	jQuery.ajax({
		url: cmstngpath + 'ajx_updateorder.php',
		data: params,
		dataType: 'html'
	});
}

function unlinkChild(personID,action) {
	var confmsg = action == "child_delete" ? "<?php echo $admtext['confdeletepers']; ?>" : "<?php echo $admtext['confremchild']; ?>";
	if(confirm(confmsg)) {
		var params = {personID:personID,familyID:persfamID,desc:tree,t:action};
		jQuery.ajax({
			url: 'ajx_delete.php',
			data: params,
			success: function(req){
				jQuery('#child_'+personID).fadeOut(300,function(){
					jQuery('#child_'+personID).remove();
					childcount -= 1;
					jQuery('#childcount').html(childcount);
				});
			}
		});
	}
	return false
}

function EditChild(id) {
	window.open('admin_editperson.php?personID=' + id + '&tree=<?php echo $tree; ?>' + '&cw=1');
}

function EditSpouse(field) {
	if( field.value.length )
		window.open('admin_editperson.php?personID=' + field.value + '&tree=<?php echo $tree; ?>' + '&cw=1');
}

function RemoveSpouse( spouse, spousedisplay ) {
	spouse.value = "";
	spousedisplay.value = "";
}

var nplitbox;
var activeidbox = null;
var activenamebox = null;
function openCreatePersonForm(idfield,namefield,type,gender,father) {
	activeidbox = idfield;
	activenamebox = namefield;
	nplitbox = new LITBox(
		'admin_newperson2.php?tree=' + tree + '&type='+type + '&familyID=' + persfamID + '&father=' + father + '&gender=' + gender,
		{
			width:650,
			height:670,
			doneLoading:function(){
				generateID('person',document.npform.personID,document.form1.tree1);
				jQuery('#firstname').focus();
			}
		}
	);
	return false;
}

function saveNewPerson(form) {
	form.personID.value = TrimString( form.personID.value );
	var personID = form.personID.value;
	if( personID.length == 0 ) {
		alert("<?php echo $admtext['enterpersonid']; ?>");
	}
	else {
		var params = jQuery(form).serialize();
		params += '&order=' + (childcount + 1);
		jQuery.ajax({
			url: 'admin_addperson2.php',
			data: params,
			type: 'post',
			dataType: 'html',
			success: function(req){
				if(req.indexOf('error') >= 0) {
					var vars = eval('('+req+')');
					jQuery('#errormsg').html(vars.error);
					jQuery('#errormsg').show();
				}
				else {
					nplitbox.remove();
					if(form.type.value == "child") {
						jQuery('#childrenlist').append(req);
						jQuery('#child_'+personID).fadeIn(400);
						childcount += 1;
						jQuery('#childcount').html(childcount);
						startSort();
					}
					else if(form.type.value == "spouse") {
						var vars = eval('('+req+')');
						jQuery('#'+activenamebox).val(vars.name + ' - ' + vars.id);
						jQuery('#'+activenamebox).effect('highlight',{},400);
						jQuery('#'+activeidbox).val(vars.id);
					}
				}
			}
		});
	}
	return false
}

function addNewMedia() {
	if(confirm("<?php echo $admtext['savefirst']; ?>")) {
		jQuery('#newmedia').val(1);
		document.form1.submit();
	}
	else
		window.location = 'admin_newmedia.php?personID=<?php echo $familyID; ?>&tree=?php echo $tree; ?>&linktype=F';
	return false;
}

function editWarning() {
	alert("<?php echo $admtext['editwarn']; ?>");
}

<?php
if(!$editconflict && $warnsecs >= 0) {
?>
	setTimeout(editWarning, <?php echo $warnsecs; ?>);
<?php
}
?>
</script>
<script src="js/admin.js"></script>
</head>

<?php
	echo tng_adminlayout();

	$familytabs['0'] = array(1,"admin_families.php",$admtext['search'],"findfamily");
	$familytabs['1'] = array($allow_add,"admin_newfamily.php",$admtext['addnew'],"addfamily");
	$familytabs['2'] = array($allow_edit,"admin_findreview.php?type=F",$admtext['review'] . $revstar,"review");
	$familytabs['3'] = array($allow_edit,"admin_editfamily.php?familyID=$familyID&amp;tree=$tree",$admtext['edit'],"edit");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/families_help.php#edit');\" class=\"lightlink\">{$admtext['help']}</a>";
	$innermenu .= " &nbsp;|&nbsp; <a href=\"#\" class=\"lightlink\" onClick=\"return toggleAll('on');\">{$text['expandall']}</a> &nbsp;|&nbsp; <a href=\"#\" class=\"lightlink\" onClick=\"return toggleAll('off');\">{$text['collapseall']}</a>";
	$innermenu .= " &nbsp;|&nbsp; <a href=\"$familygroup_url" . "familyID=$familyID&amp;tree=$tree\" target=\"_blank\" class=\"lightlink\">{$admtext['test']}</a>";
	if( $allow_add && ( !$assignedtree || $assignedtree == $tree ) )
		$innermenu .= " &nbsp;|&nbsp; <a href=\"#\" onclick=\"return addNewMedia();\" class=\"lightlink\">{$admtext['addmedia']}</a>";
	$menu = doMenu($familytabs,"edit",$innermenu);
	echo displayHeadline($admtext['families'] . " &gt;&gt; " . $admtext['modifyfamily'],"img/families_icon.gif",$menu,$message);
?>

<div class="admin-main">
<form action="admin_updatefamily.php" method="post" name="form1" id="form1">
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="normal adm-rounded-table">
<tr>
<td class="tngshadow databack">
	<table cellpadding="0" cellspacing="0" class="normal">
		<tr>
			<td valign="top"><div id="thumbholder" style="margin-right:5px;<?php if(!$photo) echo "display:none"; ?>"><?php echo $photo; ?></div></td>
			<td>
				<span class="plainheader"><?php echo $namestr; ?></span><br/>
				<div class="topbuffer bottombuffer smallest">
<?php
				if($editconflict) {
					echo "<br /><p>{$admtext['editconflict']}</p>\n";
					echo "<p class=\"normal\"><strong><a href=\"admin_editfamily.php?familyID=$familyID&amp;tree=$tree\" class=\"rounded10 whitebuttonlink tngshadow\">{$admtext['retry']}</a></strong></p>\n";
				}
				else {
					$notesicon = !empty($gotnotes['general']) ? "admin-note-on-icon" : "admin-note-off-icon";
					$citesicon = !empty($gotcites['general']) ? "admin-cite-on-icon" : "admin-cite-off-icon";
					$associcon = $gotassoc ? "admin-asso-on-icon" : "admin-asso-off-icon";
					$return = !empty($cw) ? "saveclose" : "saveret";
					echo "<a href=\"#\" onclick=\"jQuery('#{$return}').click();\" class=\"smallicon si-plus admin-save-icon\">{$admtext['save']}</a>\n";
					echo "<a href=\"#\" onclick=\"return showNotes('', '$familyID');\" id=\"notesicon\" class=\"smallicon si-plus $notesicon\">{$admtext['notes']}</a>\n";
					echo "<a href=\"#\" onclick=\"return showCitations('', '$familyID');\" id=\"citesicon\" class=\"smallicon si-plus $citesicon\">{$admtext['sources']}</a>\n";
		 			echo "<a href=\"#\" onclick=\"return showAssociations('$familyID','F');\" id=\"associcon\" class=\"smallicon si-plus $associcon\">{$admtext['associations']}</a>\n";
				}
?>
                <br /><br />
				</div>
				<span class="smallest"><?php echo $admtext['lastmodified'] . ": {$row['changedate']} ({$row['changedby']})"; ?></span>
			</td>
		</tr>
	</table>
</td>
</tr>
<?php
if(!$editconflict) {
?>
<tr>
<td class="tngshadow databack">
	<?php echo displayToggle("plus0",1,"spouses",$admtext['spouses'],""); ?>

	<div id="spouses">
	<table class="normal topmarginsmall">
<?php
	if( $row['husband'] ) {
		$query = "SELECT personID, lastname, lnprefix, firstname, prefix, suffix, title, nameorder, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, burialdate, living, private, branch, gedcom FROM $people_table WHERE personID = \"{$row['husband']}\" AND gedcom = \"$tree\"";
		$spouseresult= tng_query($query);
		$spouserow =  tng_fetch_assoc( $spouseresult );
		tng_free_result($spouseresult);

		$srights = determineLivingPrivateRights($spouserow);
		$spouserow['allow_living'] = $srights['living'];
		$spouserow['allow_private'] = $srights['private'];

		$husbstr = getName( $spouserow ) . getBirth($spouserow) . " - " . $row['husband'];
		$husbstr = preg_replace("/\"/", "&#34;",$husbstr);
	}
	if(!isset($husbstr)) $husbstr = $admtext['clickfind'];
?>
	<tr><td><span class="normal"><?php echo $admtext['husband']; ?>:</span></td><td><input type="text" readonly="readonly" name="husbnameplusid" id="husbnameplusid" size="50" class="verylongfield" value="<?php echo "$husbstr"; ?>"><input type="hidden" name="husband" id="husband" value="<?php echo $row['husband']; ?>">
		<input type="button" value="<?php echo $admtext['find']; ?>" onclick="return findItem('I','husband','husbnameplusid','<?php echo $tree; ?>','<?php echo $assignedbranch; ?>');">
		<input type="button" value="<?php echo $admtext['create']; ?>" onclick="return openCreatePersonForm('husband','husbnameplusid','spouse','M');">
		<input type="button" value="  <?php echo $admtext['edit']; ?>  " onclick="EditSpouse(document.form1.husband);">
		<input type="button" value="<?php echo $admtext['unlink']; ?>" onclick="RemoveSpouse(document.form1.husband,document.form1.husbnameplusid);">
	</td></tr>
<?php
	if( $row['wife'] ) {
		$query = "SELECT personID, lastname, lnprefix, firstname, prefix, suffix, title, nameorder, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, burialdate, living, private, branch, gedcom FROM $people_table WHERE personID = \"{$row['wife']}\" AND gedcom = \"$tree\"";
		$spouseresult= tng_query($query);
		$spouserow =  tng_fetch_assoc( $spouseresult );
		tng_free_result($spouseresult);

		$srights = determineLivingPrivateRights($spouserow);
		$spouserow['allow_living'] = $srights['living'];
		$spouserow['allow_private'] = $srights['private'];

		$wifestr = getName( $spouserow ) . getBirth($spouserow) . " - " . $row['wife'];
		$wifestr = preg_replace("/\"/", "&#34;",$wifestr);
	}
	else
		$spouserow = "";
	if(!isset($wifestr)) $wifestr = $admtext['clickfind'];
?>
	<tr><td><span class="normal"><?php echo $admtext['wife']; ?>:</span></td><td><input type="text" readonly readonly="readonly" name="wifenameplusid" id="wifenameplusid" size="50" class="verylongfield" value="<?php echo "$wifestr"; ?>"><input type="hidden" name="wife" id="wife" value="<?php echo $row['wife']; ?>">
		<input type="button" value="<?php echo $admtext['find']; ?>" onclick="return findItem('I','wife','wifenameplusid','<?php echo $tree; ?>','<?php echo $assignedbranch; ?>');">
		<input type="button" value="<?php echo $admtext['create']; ?>" onclick="return openCreatePersonForm('wife','wifenameplusid','spouse','F');">
		<input type="button" value="  <?php echo $admtext['edit']; ?>  " onClick="EditSpouse(document.form1.wife);">
		<input type="button" value="<?php echo $admtext['unlink']; ?>" onClick="RemoveSpouse(document.form1.wife,document.form1.wifenameplusid);">
	</td></tr>
	</table>

	<table class="normal topbuffer">
		<tr>
			<td class="nw">
				<input type="checkbox" name="living" value="1"<?php if( $row['living'] ) echo " checked=\"checked\""; ?>> <?php echo $admtext['living']; ?>&nbsp;&nbsp;
				<input type="checkbox" name="private" value="1"<?php if( $row['private'] ) echo " checked=\"checked\""; ?>> <?php echo $admtext['text_private']; ?>
			</td>
			<td class="spaceonleft"><?php echo $admtext['tree'] . ": " . $treerow['treename']; ?></td>
			<td class="spaceonleft"><?php echo $admtext['branch'] . ": "; ?>

<?php
	$query = "SELECT branch, description FROM $branches_table WHERE gedcom = \"$tree\" ORDER BY description";
	$branchresult = tng_query($query);
	$branchlist = explode(",", $row['branch'] );

	$descriptions = array();
	$options = "";
	while( $branchrow = tng_fetch_assoc($branchresult) ) {
		$options .= "	<option value=\"{$branchrow['branch']}\"";
		if( in_array( $branchrow['branch'], $branchlist ) ) {
			$options .= " selected";
			$descriptions[] = $branchrow['description'];
		}
		$options .= ">{$branchrow['description']}</option>\n";
	}
	$desclist = count($descriptions) ? implode(', ',$descriptions) : $admtext['nobranch'];
	echo "<span id=\"branchlist\">$desclist</span>";
	if( !$assignedbranch ) {
		$totbranches = tng_num_rows( $branchresult ) + 1;
		if( $totbranches < 2 ) $totbranches = 2;
		$selectnum = $totbranches < 8 ? $totbranches : 8;
		$select = $totbranches >=8 ? $admtext['scrollbranch'] . "<br/>" : "";
		$select .= "<select name=\"branch[]\" id=\"branch\" multiple size=\"$selectnum\" style=\"overflow:auto\">\n";
		$select .= "	<option value=\"\"";
		if( $row['branch'] == "" ) $select .= " selected";
		$select .= ">{$admtext['nobranch']}</option>\n";

		$select .= "$options</select>\n";
		echo " &nbsp;<span class=\"nw\">(<a href=\"#\" onclick=\"showEdit('branchedit'); quitEdit('branchedit'); return false;\"><img src=\"img/ArrowDown.gif\" border=\"0\" style=\"margin-left:-4px;margin-right:-2px\">" . $admtext['edit'] . "</a> )</span><br />";
?>
		<div id="branchedit" class="lightback pad5" style="position:absolute;display:none;" onmouseover="clearTimeout(dtimer);" onmouseout="closeEdit('branch','branchedit','branchlist');">
<?php
		echo $select;
		echo "</div>\n";
	}
	else
		echo "<input type=\"hidden\" name=\"branch\" value=\"{$row['branch']}\">";
	echo "<input type=\"hidden\" name=\"orgbranch\" value=\"{$row['branch']}\">";
?>
			</td>
		</tr>
	</table>
	</div>
</td>
</tr>
<tr>
<td class="tngshadow databack">
	<?php echo displayToggle("plus1",1,"events",$admtext['events'],""); ?>

	<div id="events">
	<p class="normal topmarginsmall"><?php echo $admtext['datenote']; ?></p>
	<table class="normal" id="events_table">
		<tr><td>&nbsp;</td><td><?php echo $admtext['date']; ?></td><td><?php echo $admtext['place']; ?></td><td colspan="4">&nbsp;</td></tr>
<?php
	echo showEventRow('marrdate','marrplace','MARR',$familyID);
?>
		<tr>
			<td><?php echo $admtext['marriagetype']; ?>:</td>
			<td colspan="6"><input type="text" value="<?php echo $row['marrtype']; ?>" name="marrtype" style="width:494px" maxlength="50"></td>
		</tr>
<?php
	if( $rights['lds'] )
		echo showEventRow('sealdate','sealplace','SLGS',$familyID);
	echo showEventRow('divdate','divplace','DIV',$familyID);
?>
		<tr>
			<td colspan="2">
				<br/>
				<p><strong class="subhead">
<?php 
	echo $admtext['otherevents'] . ": &nbsp;<input type=\"button\" value=\"  {$admtext['addnew']}  \" onclick=\"newEvent('F','$familyID','$tree');\">\n";
?>
				</strong></p>
			</td>
		</tr>
<?php
		showCustEvents($familyID);
?>
	</table>
	</div>
</td>
</tr>
<tr>
<td class="tngshadow databack">
<?php
	echo displayToggle("plus2",1,"children",$admtext['children'] . " (<span id=\"childcount\">$kidcount</span>)","");
?>

	<div id="children" style="padding-top:10px">
		<table id="ordertbl" width="500px" cellpadding="3" cellspacing="1" border="0" class="normal">
			<tr>
				<td class="fieldnameback" style="width:55px"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['text_sort']; ?></b>&nbsp;</nobr></span></td>
				<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['child']; ?></b>&nbsp;</nobr></span></td>
			</tr>
		</table>
		<div id="childrenlist">
<?php
	if( $children && $kidcount ) {
		if($sitever == "standard")
			$hidecode = "class=\"smaller hide-right\"";
		else
			$hidecode = "class=\"smaller\" style=\"float:right\"";
		while ( $child =  tng_fetch_assoc( $children ) )
		{
			$crights = determineLivingPrivateRights($child);
			$child['allow_living'] = $crights['living'];
			$child['allow_private'] = $crights['private'];

			if( $child['firstname'] || $child['lastname'] ) {
				echo "<div class=\"sortrow\" id=\"child_{$child['pID']}\" style=\"width:500px;clear:both\"";
				if($allow_delete && $sitever == "standard")
					echo " onmouseover=\"jQuery('#unlinkc_{$child['pID']}').css('visibility','visible');\" onmouseout=\"jQuery('#unlinkc_{$child['pID']}').css('visibility','hidden');\"";
				echo ">\n";
				echo "<table width=\"100%\" cellpadding=\"5\" cellspacing=\"1\"><tr>\n";
				echo "<td class=\"dragarea normal\">";
		   		echo "<img src=\"img/admArrowUp.gif\" alt=\"\"><br/>" . $admtext['drag'] . "<br/><img src=\"img/admArrowDown.gif\" alt=\"\">\n";
				echo "</td>\n";
				echo "<td class=\"lightback normal childblock\">\n";

				if($allow_delete)
					echo "<div id=\"unlinkc_{$child['pID']}\" $hidecode><a href=\"#\" onclick=\"return unlinkChild('{$child['pID']}','child_unlink');\">{$admtext['unlink']}</a> &nbsp; | &nbsp; <a href=\"#\" onclick=\"return unlinkChild('{$child['pID']}','child_delete');\">{$admtext['text_delete']}</a></div>";
				if( $crights['both'] ) {
					if( $child['birthdate'] ) {
						$birthstring = $admtext['birthabbr'] . " " . displayDate($child['birthdate']);
					}
					else if( $child['altbirthdate'] ) {
						$birthstring = $admtext['chrabbr'] . " " . displayDate($child['altbirthdate']);
					}
					else
						$birthstring = $admtext['nobirthinfo'];
					if( $child['deathdate'] ) {
						$deathstring = $admtext['deathabbr'] . " " . displayDate($child['deathdate']);
					}
					else if( $child['burialdate'] ) {
						$deathstring = $admtext['burialabbr'] . " " . displayDate($child['burialdate']);
					}
					else
						$deathstring = "";
					if($birthstring && $deathstring) $deathstring = ", " . $deathstring;
					echo "<a href=\"#\" onclick=\"EditChild('{$child['pID']}');\">" . getName( $child ) . "</a> - {$child['pID']}<br />$birthstring$deathstring";
				}
				else {
					echo $admtext['living'] . " - " . $child['pID'];
				}
				echo "</div>\n</td>\n</tr>\n</table>\n</div>\n";
			}
		}
		tng_free_result( $children );
	}
?>
		</div>

		<input type="hidden" name="media" id="newmedia" value="" />
		<input type="hidden" name="tree" value="<?php echo $tree; ?>" />
		<p class="normal"><?php echo $admtext['newchildren']; ?>:
		<input type="button" value="<?php echo $admtext['find']; ?>" onclick="return findItem('I','children',null,'<?php echo $tree; ?>','<?php echo $assignedbranch; ?>');" />
		<input type="button" value="<?php echo $admtext['create']; ?>" onclick="return openCreatePersonForm('','','child','',document.form1.husband.value);" />
		<input type="hidden" name="familyID" value="<?php echo "$familyID"; ?>" />
		</p>
	</div>
</td>
</tr>
<tr>
<td class="tngshadow databack">
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
		$close_command = "window.location.href='admin_families.php';";
	}
?>
	<input type="submit" name="savestay" id="savestay" class="btn" value="<?php echo $admtext['savereturn']; ?>" />
	<input type="submit" name="savestay" id="savestay2" class="btn savestay" value="<?php echo $admtext['savereturn']; ?>" />
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="<?php echo $close_command; ?>">

<?php if( !$rights['lds'] ) { ?>
	<input type="hidden" value="<?php echo $row['sealdate']; ?>" name="sealdate">
	<input type="hidden" value="<?php echo $row['sealplace']; ?>" name="sealplace">
<?php } ?>
	<input type="hidden" value="<?php echo (isset($cw) ? $cw : ""); /*stands for "close window" */ ?>" name="cw">
	</span>
</td>
</tr>
<?php
} //end of the editconflict conditional
?>
</table>
</form>
</div>
<?php 
echo tng_adminfooter();
?>