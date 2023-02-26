<?php
include("begin.php");
include("adminlib.php");
$textpart = "people";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = true;
include("checklogin.php");
include("version.php");

if(!isset($cw)) $cw = '';
if(!isset($added)) $added = 0;

initMediaTypes();

function initNotesOrCites() {
	$notes = array();
	$notes['general'] = "";
	$notes['NAME'] = "";
	return $notes;
}

$personID = ucfirst( $personID );
$query = "SELECT *, DATE_FORMAT(changedate,\"%d %b %Y %H:%i:%s\") as changedate, IF(birthdate!='',YEAR(birthdatetr),YEAR(altbirthdatetr)) as birth, IF(deathdate!='',YEAR(deathdatetr),YEAR(burialdatetr)) as death FROM $people_table WHERE personID = \"$personID\" and gedcom = \"$tree\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
tng_free_result($result);
$row['firstname'] = preg_replace("/\"/", "&#34;",$row['firstname']);
$row['lastname'] = preg_replace("/\"/", "&#34;",$row['lastname']);
$row['nickname'] = preg_replace("/\"/", "&#34;",$row['nickname']);
$row['suffix'] = preg_replace("/\"/", "&#34;",$row['suffix']);
$row['title'] = preg_replace("/\"/", "&#34;",$row['title']);
$row['birthplace'] = preg_replace("/\"/", "&#34;",$row['birthplace']);
$row['altbirthplace'] = preg_replace("/\"/", "&#34;",$row['altbirthplace']);
$row['deathplace'] = preg_replace("/\"/", "&#34;",$row['deathplace']);
$row['burialplace'] = preg_replace("/\"/", "&#34;",$row['burialplace']);
$row['baptplace'] = preg_replace("/\"/", "&#34;",$row['baptplace']);
$row['confplace'] = preg_replace("/\"/", "&#34;",$row['confplace']);
$row['initplace'] = preg_replace("/\"/", "&#34;",$row['initplace']);
$row['endlplace'] = preg_replace("/\"/", "&#34;",$row['endlplace']);

if( (!$allow_edit && (!$allow_add || !$added)) || ( $assignedtree && $assignedtree != $tree ) || !checkbranch( $row['branch'] ) ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$editconflict = determineConflict($row,$people_table);
if($tngconfig['edit_timeout'] === "")
	$tngconfig['edit_timeout'] = 15;
$warnsecs = (intval($tngconfig['edit_timeout']) - 2) * 60 * 1000;

if ( $row['sex'] == "M" ) {
	$spouse = "wife"; $self = "husband"; $spouseorder = "husborder"; $selfdisplay = $admtext['ashusband']; $childrel = "frel";
}
else if ($row['sex'] == "F" ) {
	$spouse = "husband"; $self = "wife"; $spouseorder = "wifeorder"; $selfdisplay = $admtext['aswife']; $childrel = "mrel";
}
else {
	$spouse = ""; $self = ""; $spouseorder = ""; $selfdisplay = $admtext['asspouse']; $childrel = "";
}

$tng_search_people = isset($_SESSION['tng_search_people']) ? $_SESSION['tng_search_people'] : '';

$getperson_url = getURL( "getperson", 1 );

$righttree = checktree($tree);
$rightbranch = $righttree ? checkbranch($row['branch']) : false;
$rights = determineLivingPrivateRights($row, $righttree, $rightbranch);
$row['allow_living'] = $rights['living'];
$row['allow_private'] = $rights['private'];

$namestr = getName($row);

$query = "SELECT treename FROM $trees_table WHERE gedcom = \"$tree\"";
$result = tng_query($query);
$treerow = tng_fetch_assoc( $result );
tng_free_result($result);

$privstr = $rights['private_notes'] ? "" : "AND secret != \"1\"";
$query = "SELECT DISTINCT eventID as eventID FROM $notelinks_table WHERE persfamID=\"$personID\" AND gedcom =\"$tree\" $privstr";
$notelinks = tng_query($query);
$gotnotes = initNotesOrCites();
while( $note = tng_fetch_assoc( $notelinks ) ) {
	if( !$note['eventID'] ) $note['eventID'] = "general";
	$gotnotes[$note['eventID']] = "*";
}
tng_free_result($notelinks);

$citquery = "SELECT DISTINCT eventID FROM $citations_table WHERE persfamID = \"$personID\" AND gedcom = \"$tree\"";
$citresult = tng_query($citquery) or die ($admtext['cannotexecutequery'] . ": $citquery");
$gotcites = initNotesOrCites();
while( $cite = tng_fetch_assoc( $citresult ) ) {
	if( !$cite['eventID'] ) $cite['eventID'] = "general";
	$gotcites[$cite['eventID']] = "*";
}
tng_free_result($citresult);

$assocquery = "SELECT count(assocID) as acount FROM $assoc_table WHERE personID = \"$personID\" AND gedcom = \"$tree\"";
$assocresult = tng_query($assocquery) or die ($admtext['cannotexecutequery'] . ": $assocquery");
$assocrow = tng_fetch_assoc( $assocresult );
$gotassoc = $assocrow['acount'] ? "*" : "";
tng_free_result($assocresult);

$query = "SELECT parenttag FROM $events_table WHERE persfamID=\"$personID\" AND gedcom =\"$tree\"";
$morelinks = tng_query($query);
$gotmore = array();
while( $more = tng_fetch_assoc( $morelinks ) ) {
	$gotmore[$more['parenttag']] = "*";
}

function parentRow($parent,$spouse,$label) {
	global $people_table, $families_table, $admtext, $tree, $righttree, $cw;

	$pout = "";
	$query = "SELECT personID, lastname, lnprefix, firstname, birthdate, birthdatetr, birthplace, altbirthdate, altbirthdatetr, altbirthplace, deathdate, burialdate, title, nickname, prefix, suffix, nameorder, sex, $people_table.branch, $people_table.gedcom, $people_table.living, $people_table.private FROM $people_table, $families_table WHERE $people_table.personID = $families_table.$spouse AND $families_table.familyID = \"{$parent['familyID']}\" AND $people_table.gedcom = \"$tree\" AND $families_table.gedcom = \"$tree\"";
	$gotparent = tng_query($query);

	if( tng_num_rows($gotparent) ) {
		$prow =  tng_fetch_assoc( $gotparent );
		if($prow['sex'] == "M")
			$label = "father";
		elseif($prow['sex'] == "F")
			$label = "mother";
		//if unknown, it gets what was passed in

		$prights = determineLivingPrivateRights($prow, $righttree);
		$prow['allow_living'] = $prights['living'];
		$prow['allow_private'] = $prights['private'];

		if( $prights['both'] ) {
			$birthstring = $deathstring = $birthinfo = "";
			if( $prow['birthdate'] ) {
				$birthstring = $admtext['birthabbr'] . " " . displayDate($prow['birthdate']);
			}
			else if( $prow['altbirthdate'] ) {
				$birthstring = $admtext['chrabbr'] . " " . displayDate($prow['altbirthdate']);
			}
			if( $prow['deathdate'] ) {
				$deathstring = $admtext['deathabbr'] . " " . displayDate($prow['deathdate']);
			}
			else if( $prow['burialdate'] ) {
				$deathstring = $admtext['burialabbr'] . " " . displayDate($prow['burialdate']);
			}
			if($birthstring && $deathstring) $deathstring = ", " . $deathstring;

			if($birthstring || $deathstring)
				$birthinfo = " ($birthstring$deathstring)";
		}
		else
			$birthinfo = ($prow['private'] ? $admtext['text_private'] : $admtext['living']) . " - " . $prow['personID'];

		$pout = "<tr>\n";
		$pout .= "<td valign=\"top\">" . $admtext[$label] . ":</td>\n";
		$pout .= "<td valign=\"top\" colspan=\"4\">";
		if( $prow['personID'] ) {
			$pout .= "<a href=\"admin_editperson.php?personID={$prow['personID']}&amp;tree=$tree&amp;cw=$cw\">" . getName( $prow ) . " - {$prow['personID']}</a>$birthinfo";
		}
		$pout .= "</td>\n";
		$pout .= "</tr>\n";
		$pout .= "<tr>\n";
		$pout .= "<td valign=\"top\">&nbsp;&nbsp;{$admtext['relationship']}:</td>\n";
		$pout .= "<td valign=\"top\" colspan=\"4\">\n";
		$fieldname = $label == "father" ? "frel" : "mrel";
		$pout .= "<select name=\"$fieldname{$parent['familyID']}\">\n";
		$pout .= "<option value=\"\"></option>\n";

		$reltypes = array("adopted","birth","foster","sealing","step","putative");
		foreach( $reltypes as $reltype ) {
			$pout .= "<option value=\"$reltype\"";
			if( $parent[$fieldname] == $reltype || $parent[$fieldname] == $admtext[$reltype] ) $pout .= " selected";
			$pout .= ">{$admtext[$reltype]}</option>\n";
		}
		$pout .= "</select>\n";
		$pout .= "</td>\n";
		$pout .= "</tr>\n";

		tng_free_result( $gotparent );
	}

	return $pout;
}

$helplang = findhelp("people_help.php");

$revstar = checkReview("I");
$genders = ['M','F','U',''];

tng_adminheader( $admtext['modifyperson'], $flags );
$photo = showSmallPhoto( $personID, $namestr, 1, 0, "I", $row['sex'] );
include_once("eventlib.php");
include_once("eventlib_js.php");
?>
<script type="text/javascript">
<?php if(!empty($ref)) { echo "window.opener.location.reload(false);\n"; } ?>
var persfamID = "<?php echo $personID; ?>";
var allow_cites = true;
var allow_notes = true;

function toggleAll(display) {
	toggleSection('names','plus0',display);
	toggleSection('events','plus1',display);
	toggleSection('parents','plus2',display);
	toggleSection('spouses','plus3',display);
	return false;
}

function startSort() {
	if(jQuery('#parents div.sortrow').length > 1)
		jQuery('#parents').sortable({
			helper: 'clone',
			axis:'y',
			scroll: false,
			items: '.sortrow',
			update:function(event, ui) {
				var parentlist = removePrefixFromArray(jQuery('#parents').sortable('toArray'), 'parents_');

				var params = {sequence:parentlist.join(','),action:'parentorder',personID:persfamID,tree:tree};
				jQuery.ajax({
					url: cmstngpath + 'ajx_updateorder.php',
					data: params,
					dataType: 'html'
				});
			},
			create:function(){
			    jQuery(this).height(jQuery(this).height());
			}
		});
	if(jQuery('#spouses div.sortrow').length > 1)
		jQuery('#spouses').sortable({
			helper: 'clone',
			axis:'y',
			scroll: false,
			items: '.sortrow',
			update:function(event, ui) {
				var spouselist = removePrefixFromArray(jQuery('#spouses').sortable('toArray'), 'spouses_');

				var params = {sequence:spouselist.join(','),action:'spouseorder',tree:tree,spouseorder:'<?php echo $spouseorder; ?>'};
				jQuery.ajax({
					url: cmstngpath + 'ajx_updateorder.php',
					data: params,
					dataType: 'html'
				});
			},
			create:function(){
			    jQuery(this).height(jQuery(this).height());
			}
		});
}

function unlinkSpouse(familyID) {
	if(confirm("<?php echo $admtext['confunlink']; ?>")) {
		var params = {action:'spouseunlink',familyID:familyID,personID:persfamID,tree:tree};
		jQuery.ajax({
			url: 'ajx_updateorder.php',
			data: params,
			dataType: 'html',
			success: function(req){
				jQuery('#spouses_'+familyID).fadeOut(300, function(){
					jQuery('#spouses_'+familyID).remove();
					jQuery('#marrcount').html(parseInt(jQuery('#marrcount').html()) - 1);
				});
			}
		});
	}
	return false;
}

function unlinkChild(familyID) {
	if(confirm("<?php echo $admtext['confunlinkc']; ?>")) {
		var params = {action:'parentunlink',familyID:familyID,personID:persfamID,tree:tree};
		jQuery.ajax({
			url: 'ajx_updateorder.php',
			data: params,
			dataType: 'html',
			success: function(req){
				jQuery('#parents_'+familyID).fadeOut(300,function(){
					jQuery('#parents_'+familyID).remove();
					jQuery('#parentcount').html(parseInt(jQuery('#parentcount').html()) - 1);
				});
			}
		});
	}
	return false;
}

function addNewFamily(submitval) {
	if(confirm("<?php echo $admtext['savefirst']; ?>")) {
		jQuery('#'+submitval).click();
	}
	return false;
}

function addNewMedia() {
	if(confirm("<?php echo $admtext['savefirst']; ?>")) {
		jQuery('#newmedia').val(1);
		document.form1.submit();
	}
	else
		window.location = 'admin_newmedia.php?personID=<?php echo $personID; ?>&tree=<?php echo $tree; ?>&linktype=I';
	return false;
}

function editWarning() {
	alert("<?php echo $admtext['editwarn']; ?>");
}

function onGenderChange(gender) {
	if(gender.value == 'M' || gender.value == 'F' || gender.value == 'U') {
		jQuery('#other_gender').hide();
	} 
	else {
		jQuery('#other_gender').show();
	}

	if(gender.value == 'M' || gender.value == 'F') {
		jQuery('#addnewspouse').show();
	} 
	else {
		jQuery('#addnewspouse').hide();
	}
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
	echo tng_adminlayout(" onload=\"startSort()\"");

	$peopletabs[0] = array(1,"admin_people.php",$admtext['search'],"findperson");
	$peopletabs[1] = array($allow_add,"admin_newperson.php",$admtext['addnew'],"addperson");
	$peopletabs[2] = array($allow_edit,"admin_findreview.php?type=I",$admtext['review'] . $revstar,"review");
	$peopletabs[3] = array($allow_edit && $allow_delete,"admin_merge.php",$admtext['merge'],"merge");
	$peopletabs[4] = array($allow_edit,"admin_editperson.php?personID=$personID&amp;tree=$tree",$admtext['edit'],"edit");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/people_help.php#edit');\" class=\"lightlink\">{$admtext['help']}</a>";
	$innermenu .= " &nbsp;|&nbsp; <a href=\"#\" class=\"lightlink\" onClick=\"return toggleAll('on');\">{$text['expandall']}</a> &nbsp;|&nbsp; <a href=\"#\" class=\"lightlink\" onClick=\"return toggleAll('off');\">{$text['collapseall']}</a>";
	$innermenu .= " &nbsp;|&nbsp; <a href=\"$getperson_url" . "personID=$personID&amp;tree=$tree\" target=\"_blank\" class=\"lightlink\">{$admtext['test']}</a>";
	if( $allow_add && ( !$assignedtree || $assignedtree == $tree ) )
		$innermenu .= " &nbsp;|&nbsp; <a href=\"#\" onclick=\"return addNewMedia();\" class=\"lightlink\">{$admtext['addmedia']}</a>";
	$menu = doMenu($peopletabs,"edit",$innermenu);
	if(!isset($message)) $message = "";
	echo displayHeadline($admtext['people'] . " &gt;&gt; " . $admtext['modifyperson'],"img/people_icon.gif",$menu,$message);
?>

<div class="admin-main">
<form action="admin_updateperson.php" method="post" name="form1" id="form1">
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="normal adm-rounded-table">
<tr>
<td class="tngshadow databack">
	<table cellpadding="0" cellspacing="0" class="normal">
		<tr>
			<td valign="top"><div id="thumbholder" style="margin-right:5px;<?php if(!$photo) echo "display:none"; ?>"><?php echo $photo; ?></div></td>
			<td>
				<span class="plainheader"><?php echo "$namestr ($personID)</span><br/>" . getYears($row); ?></span>
				<div class="topbuffer bottombuffer smallest">
<?php
				if($editconflict) {
					echo "<br /><p>{$admtext['editconflict']}</p>\n";
					echo "<p class=\"normal\"><strong><a href=\"admin_editperson.php?personID=$personID&amp;tree=$tree\" class=\"rounded10 whitebuttonlink tngshadow\">{$admtext['retry']}</a></strong></p>\n";
				}
				else {
					$notesicon = !empty($gotnotes['general']) ? "admin-note-on-icon" : "admin-note-off-icon";
					$citesicon = !empty($gotcites['general']) ? "admin-cite-on-icon" : "admin-cite-off-icon";
					$associcon = $gotassoc ? "admin-asso-on-icon" : "admin-asso-off-icon";
					$return = !empty($cw) ? "saveclose" : "saveret";
					echo "<a href=\"#\" onclick=\"jQuery('#{$return}').click();\" class=\"smallicon si-plus admin-save-icon\">{$admtext['save']}</a>\n";
					echo "<a href=\"#\" onclick=\"return showNotes('', '$personID');\" id=\"notesicon\" class=\"smallicon si-plus $notesicon\">{$admtext['notes']}</a>\n";
					echo "<a href=\"#\" onclick=\"return showCitations('', '$personID');\" id=\"citesicon\" class=\"smallicon si-plus $citesicon\">{$admtext['sources']}</a>\n";
		 			echo "<a href=\"#\" onclick=\"return showAssociations('$personID','I');\" id=\"associcon\" class=\"smallicon si-plus $associcon\">{$admtext['associations']}</a>\n";
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
	<?php echo displayToggle("plus0",1,"names",$admtext['name'],""); ?>

	<div id="names">
	<table class="normal topmarginsmall">
		<tr>
			<td><?php echo $admtext['firstgivennames']; ?></td>
<?php
	if( $lnprefixes )
		echo "<td>{$admtext['lnprefix']}</td>\n";
?>
			<td><?php echo $admtext['lastsurname']; ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><input type="text" value="<?php echo $row['firstname']; ?>" name="firstname" size="35"></td>
<?php
	if( $lnprefixes )
		echo "<td><input type=\"text\" value=\"{$row['lnprefix']}\" name=\"lnprefix\" style=\"width:80px\"></td>\n";
?>
			<td><input type="text" value="<?php echo $row['lastname']; ?>" name="lastname" size="35"></td>
			<td>
<?php
				$notesicon = !empty($gotnotes['NAME']) ? "admin-note-on-icon" : "admin-note-off-icon";
				$citesicon = !empty($gotcites['NAME']) ? "admin-cite-on-icon" : "admin-cite-off-icon";
				echo "<a href=\"#\" onclick=\"return showNotes('NAME', '$personID');\" title=\"{$admtext['notes']}\" id=\"notesiconNAME\" class=\"smallicon $notesicon\"></a>\n";
				echo "<a href=\"#\" onclick=\"return showCitations('NAME', '$personID');\" title=\"{$admtext['sources']}\" id=\"citesiconNAME\" class=\"smallicon $citesicon\"></a>\n";
?>
			</td>
		</tr>
	</table>
	<table class="normal topmarginsmall">
		<tr>
			<td><?php echo $admtext['nickname']; ?></td>
			<td><?php echo $admtext['title']; ?></td>
			<td><?php echo $admtext['prefix']; ?></td>
			<td><?php echo $admtext['suffix']; ?></td>
			<td><?php echo $admtext['nameorder']; ?></td>
		</tr>
		<tr>
			<td><input type="text" value="<?php echo $row['nickname']; ?>" name="nickname" class="veryshortfield"></td>
			<td><input type="text" value="<?php echo $row['title']; ?>" name="title" class="veryshortfield"></td>
			<td><input type="text" value="<?php echo $row['prefix']; ?>" name="prefix" class="veryshortfield"></td>
			<td><input type="text" value="<?php echo $row['suffix']; ?>" name="suffix" class="veryshortfield"></td>
			<td>
				<select name="pnameorder">
					<option value="0"><?php echo $admtext['default']; ?></option>
					<option value="1" <?php if( $row['nameorder'] == "1") echo "selected"; ?>><?php echo $admtext['western']; ?></option>
					<option value="2" <?php if( $row['nameorder'] == "2" ) echo "selected"; ?>><?php echo $admtext['oriental']; ?></option>
					<option value="3" <?php if( $row['nameorder'] == "3" ) echo "selected"; ?>><?php echo $admtext['lnfirst']; ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo $admtext['sex']; ?></td>
			<td colspan="4"></td>
		</tr>
		<tr>
			<td>
				<select name="sex" onchange="onGenderChange(this);">
					<option value="U" <?php if( $row['sex'] == "U" ) echo "selected"; ?>><?php echo $admtext['unknown']; ?></option>
					<option value="M" <?php if( $row['sex'] == "M" ) echo "selected"; ?>><?php echo $admtext['male']; ?></option>
					<option value="F" <?php if( $row['sex'] == "F" ) echo "selected"; ?>><?php echo $admtext['female']; ?></option>
					<option value="" <?php if( !in_array($row['sex'], $genders) ) echo "selected"; ?>><?php echo $text['other']; ?></option>
				</select>
			</td>
			<td colspan="4">
			<?php
				if( !in_array($row['sex'], $genders) ) {
					 echo "<input type=\"text\" name=\"other_gender\" id=\"other_gender\" value=\"{$row['sex']}\" />\n";
				}
				else {
			?>
				<input type="text" name="other_gender" id="other_gender" style="display: none" />
			<?php
				}
			?>
			</td>
		</tr>
	</table>

	<table class="normal topbuffer">
		<tr>
			<td class="nw">
				<input type="checkbox" name="living" value="1"<?php if( $row['living'] ) echo " checked=\"checked\""; ?>> <?php echo $admtext['living']; ?>&nbsp;&nbsp;
				<input type="checkbox" name="private" value="1"<?php if( $row['private'] ) echo " checked=\"checked\""; ?>> <?php echo $admtext['text_private']; ?>
			</td>
			<td class="spaceonleft"><?php echo $admtext['tree'] . ": " . $treerow['treename']; ?>
				&nbsp;(<a href="#" onclick="return openChangeTree('person','<?php echo $tree; ?>','<?php echo $personID; ?>');"><img src="img/ArrowDown.gif" border="0" style="margin-left:-4px;margin-right:-2px"><?php echo $admtext['edit']; ?></a> )
			</td>
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
		<div id="branchedit" class="lightback pad5 rounded4" style="position:absolute;display:none;" onmouseover="clearTimeout(dtimer);" onmouseout="closeEdit('branch','branchedit','branchlist');">
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
	echo showEventRow('birthdate','birthplace','BIRT',$personID);
	if(!$tngconfig['hidechr'])
		echo showEventRow('altbirthdate','altbirthplace',(!empty($row['altbirthtype']) ? $row['altbirthtype'] : "ALTBE"),$personID);
	echo showEventRow('deathdate','deathplace','DEAT',$personID);
	echo showEventRow('burialdate','burialplace','BURI',$personID);
	$checked = $row['burialtype'] == 1 ? " checked=\"checked\"" : "";
	echo "<tr><td></td><td colspan=\"3\"><input type=\"checkbox\" name=\"burialtype\" id=\"burialtype\" value=\"1\"$checked/> <label for=\"burialtype\">{$admtext['cremated']}</label></td></tr>\n";
	if( $rights['lds'] ) {
		echo showEventRow('baptdate','baptplace','BAPL',$personID);
		echo showEventRow('confdate','confplace','CONL',$personID);
		echo showEventRow('initdate','initplace','INIT',$personID);
		echo showEventRow('endldate','endlplace','ENDL',$personID);
	}
?>
		<tr>
			<td colspan="2">
				<br/>
				<p><strong class="subhead">
<?php 
	echo $admtext['otherevents'] . ": &nbsp;<input type=\"button\" value=\"  {$admtext['addnew']}  \" onclick=\"newEvent('I','$personID','$tree');\">\n";
?>
				</strong></p>
			</td>
		</tr>
<?php
		showCustEvents($personID);
?>
	</table>
	</div>
</td>
</tr>
<?php
$query = "SELECT personID, familyID, sealdate, sealplace, frel, mrel FROM $children_table WHERE personID = \"$personID\" AND gedcom = \"$tree\" ORDER BY parentorder";
$parents = tng_query($query);
$parentcount = tng_num_rows( $parents );

?>
<tr>
<td class="tngshadow databack">
<?php
	$newparents = $allow_add && ( !$assignedtree || $assignedtree == $tree ) ? "&nbsp; <input type=\"button\" value=\"  " . $admtext['addnew'] . "  \" onClick=\"return addNewFamily('savepar');\">\n" : "";
	echo displayToggle("plus2",1,"parents",$admtext['parents'] . " (<span id=\"parentcount\">$parentcount</span>)","",$newparents);
?>

	<div id="parents"><br />
<?php
	while ( $parent = tng_fetch_assoc( $parents ) )
	{
		echo "<div class=\"sortrow\" id=\"parents_{$parent['familyID']}\" style=\"clear:both\" onmouseover=\"jQuery('#unlinkp_{$parent['familyID']}').show();\" onmouseout=\"jQuery('#unlinkp_{$parent['familyID']}').hide();\">\n";
		echo "<table width=\"100%\" cellpadding=\"5\" cellspacing=\"1\"><tr>\n";
		if($parentcount > 1) {
			echo "<td class=\"dragarea normal\">";
	   		echo "<img src=\"img/admArrowUp.gif\" alt=\"\"><br/>" . $admtext['drag'] . "<br/><img src=\"img/admArrowDown.gif\" alt=\"\">\n";
			echo "</td>\n";
		}
		echo "<td class=\"lightback normal rounded10\">\n";
		echo "<div id=\"unlinkp_{$parent['familyID']}\" style=\"float:right;display:none\"><a href=\"#\" onclick=\"return unlinkChild('{$parent['familyID']}');\">{$admtext['unlinkindividual']} ($personID) {$admtext['aschild']}</a></div>\n";
		echo "<table class=\"normal\"><tr><td valign=\"top\"><strong>{$admtext['family']}:</strong></td>\n";
		echo "<td valign=\"top\" colspan=\"4\">\n";
		echo "<a href=\"admin_editfamily.php?familyID={$parent['familyID']}&amp;tree=$tree&amp;cw=$cw\">{$parent['familyID']}</a>\n</td></tr>";

		echo parentRow($parent, "husband", "father");
		echo parentRow($parent, "wife", "mother");

		$parent['sealplace'] = preg_replace("/\"/", "&#34;",$parent['sealplace']);
		if( $rights['lds'] ) {
			$citquery = "SELECT citationID FROM $citations_table WHERE persfamID = \"$personID" . "::" . "{$parent['familyID']}\" AND gedcom = \"$tree\"";
			$citresult = tng_query($citquery) or die ($admtext['cannotexecutequery'] . ": $citquery");
			$citesicon = tng_num_rows($citresult) ? "admin-cite-on-icon" : "admin-cite-off-icon";
			tng_free_result($citresult);

			echo "<tr><td>&nbsp;</td><td>" . $admtext['date'] . "</td><td>" . $admtext['place'] . "</td><td colspan=\"2\">&nbsp;</td></tr>\n";
			echo "<tr>\n";
			echo "<td valign=\"top\" class=\"nw\" style=\"width:110px\">" . $admtext['SLGC'] . ":</td>\n";
			echo "<td><input type=\"text\" value=\"" . $parent['sealdate'] . "\" name=\"sealpdate" . $parent['familyID'] . "\" onblur=\"checkDate(this);\" maxlength=\"50\" class=\"shortfield\"></td>\n";
			echo "<td><input type=\"text\" value=\"" . $parent['sealplace'] . "\" name=\"sealpplace" . $parent['familyID'] . "\" id=\"sealpplace" . $parent['familyID'] . "\" class=\"longfield\"></td>\n";
			echo "<td><a href=\"#\" onclick=\"return openFindPlaceForm('sealpplace" . $parent['familyID'] . "',1);\" title=\"{$admtext['find']}\" class=\"smallicon admin-temp-icon\"></a></td>\n";
			echo "<td><a href=\"#\" onclick=\"return showCitations('SLGC','$personID::" . $parent['familyID']. "');\" title=\"{$admtext['sources']}\" id=\"citesiconSLGC{$personID}--" . $parent['familyID'] . "\" class=\"smallicon $citesicon\"></a></td>\n";
			echo "</tr>\n</table>\n";
		}
		else {
?>
		</table>
		<input type="hidden" name="sealpdate<?php echo $parent['familyID']; ?>" value="<?php echo $parent['sealdate']; ?>">
		<input type="hidden" name="sealpplace<?php echo $parent['familyID']; ?>" value="<?php echo $parent['sealplace']; ?>">
<?php
		}
?>
	</td>
	</table>
	</div>
<?php
	}
	tng_free_result($parents);
?>
	</div>
</td>
</tr>
<?php
	$sortclause = $self ? " ORDER BY $spouseorder" : "";
	$query = "SELECT husband, wife, familyID, marrdate FROM $families_table WHERE ($families_table.husband = \"$personID\" OR $families_table.wife = \"$personID\") AND gedcom = \"$tree\"$sortclause";
	$marriages= tng_query($query);
	$marrcount = tng_num_rows( $marriages );

?>
<tr>
<td class="tngshadow databack">
<?php
	$display =  !$row['sex'] || $row['sex'] == "U" ? " style=\"display:none\"" : "";
	$newspouse = $allow_add && ( !$assignedtree || $assignedtree == $tree ) ? "&nbsp; <input type=\"button\"$display id=\"addnewspouse\" value=\"  " . $admtext['addnew'] . "  \" onClick=\"return addNewFamily('savesp');\">\n" : "";
	echo displayToggle("plus3",1,"spouses",$admtext['spouses'] . " (<span id=\"marrcount\">$marrcount</span>)","",$newspouse);
?>

	<div id="spouses"><br />
<?php
	if ( $marriages && tng_num_rows( $marriages ) ) {
		while ( $marriagerow =  tng_fetch_assoc( $marriages ) )
		{
			//if( !$spouse ) {
				if( $personID == $marriagerow['husband'] ) {
					$self = "husband"; $spouse = "wife";
				}
				else if( $personID == $marriagerow['wife'] ) {
					$self = "wife"; $spouse = "husband";
				}
			//}
			echo "<div class=\"sortrow\" id=\"spouses_{$marriagerow['familyID']}\" style=\"clear:both\" onmouseover=\"jQuery('#unlinks_{$marriagerow['familyID']}').show();\" onmouseout=\"jQuery('#unlinks_{$marriagerow['familyID']}').hide();\">\n";
			echo "<table width=\"100%\" cellpadding=\"5\" cellspacing=\"1\"><tr>\n";
			if($marrcount > 1) {
				echo "<td class=\"dragarea normal\">";
		   		echo "<img src=\"img/admArrowUp.gif\" alt=\"\"><br/>" . $admtext['drag'] . "<br/><img src=\"img/admArrowDown.gif\" alt=\"\">\n";
				echo "</td>\n";
			}
			echo "<td class=\"lightback normal rounded10\">\n";
			echo "<table class=\"normal\" width=\"100%\"><tr><td valign=\"top\"><strong>{$admtext['family']}:</strong></td>\n";
			echo "<td valign=\"top\" width=\"94%\">\n";
			echo "<div id=\"unlinks_{$marriagerow['familyID']}\" style=\"float:right;display:none\"><a href=\"#\" onclick=\"return unlinkSpouse('{$marriagerow['familyID']}');\">{$admtext['unlinkindividual']} ($personID) {$admtext['asspouse']}</a></div>\n";
			echo "<a href=\"admin_editfamily.php?familyID={$marriagerow['familyID']}&amp;tree=$tree&amp;cw=$cw\">{$marriagerow['familyID']}</a>\n</td></tr>";
			if( $marriagerow[$spouse] ) {
				$query = "SELECT personID, lastname, lnprefix, firstname, birthdate, birthdatetr, birthplace, altbirthdate, altbirthdatetr, altbirthplace, deathdate, burialdate, title, nickname, prefix, suffix, nameorder, living, private, gedcom, branch FROM $people_table WHERE personID = \"{$marriagerow[$spouse]}\" AND gedcom = \"$tree\"";
				$spouseresult= tng_query($query);
				$spouserow =  tng_fetch_assoc( $spouseresult );

				$srights = determineLivingPrivateRights($spouserow, $righttree);
				$spouserow['allow_living'] = $srights['living'];
				$spouserow['allow_private'] = $srights['private'];

				if( $srights['both'] ) {
					$birthstring = $deathstring = $birthinfo = "";
					if( $spouserow['birthdate'] ) {
						$birthstring = $admtext['birthabbr'] . " " . displayDate($spouserow['birthdate']);
					}
					else if( $spouserow['altbirthdate'] ) {
						$birthstring = $admtext['chrabbr'] . " " . displayDate($spouserow['altbirthdate']);
					}
					if( $spouserow['deathdate'] ) {
						$deathstring = $admtext['deathabbr'] . " " . displayDate($spouserow['deathdate']);
					}
					else if( $spouserow['burialdate'] ) {
						$deathstring = $admtext['burialabbr'] . " " . displayDate($spouserow['burialdate']);
					}
					if($birthstring && $deathstring) $deathstring = ", " . $deathstring;

					if($birthstring || $deathstring)
						$birthinfo = " ($birthstring$deathstring)";
				}
				else
					$birthinfo = ($spouserow['private'] ? $admtext['text_private'] : $admtext['living']) . " - " . $spouserow['personID'];
			}
			else {
				$spouserow = $birthinfo = "";
			}
?>
	<tr>
		<td valign="top"><span class="normal"><?php echo $admtext['spouse']; ?>:</span></td>
		<td valign="top"><span class="normal"><?php if( isset($spouserow['personID']) && $spouserow['personID'] ) {echo "<a href=\"admin_editperson.php?personID={$spouserow['personID']}&amp;tree=$tree&amp;cw=$cw\">" . getName( $spouserow ) . " - {$spouserow['personID']}</a>$birthinfo"; } ?></span></td>
	</tr>
<?php			
			if( !empty($marriagerow['marrdate']) || !empty($marriagerow['marrplace']) ) {
?>
	<tr>
		<td valign="top"><span class="normal"><?php echo $admtext['married']; ?>:</span></td>
		<td valign="top"><span class="normal"><?php echo displayDate($marriagerow['marrdate']); ?></span></td>
	</tr>
<?php
			}

			$query = "SELECT $people_table.personID as pID, $people_table.personID, firstname, lnprefix, lastname, birthdate, birthdatetr, birthplace, altbirthdate, altbirthdatetr, altbirthplace, deathdate, burialdate, haskids, living, private, branch, $people_table.gedcom, title, nickname, prefix, suffix, nameorder, frel, mrel FROM ($people_table, $children_table) WHERE $people_table.personID = $children_table.personID AND $children_table.familyID = \"{$marriagerow['familyID']}\" AND $people_table.gedcom = \"$tree\" AND $children_table.gedcom = \"$tree\" ORDER BY ordernum";
			$children= tng_query($query);

			if( $children && tng_num_rows( $children ) ) {
?>
	<tr>
		<td valign="top"><span class="normal"><?php echo $admtext['children']; ?>:</span></td>
		<td valign="top"><span class="normal">
<?php
				$kidcount = 1;
				echo "<table cellpadding = \"0\" cellspacing = \"0\">\n";
				while ( $child =  tng_fetch_assoc( $children ) )
				{
					$ifkids = $child['haskids'] ? "+" : "&nbsp;";
					$crights = determineLivingPrivateRights($child);
					$child['allow_living'] = $crights['living'];
					$child['allow_private'] = $crights['private'];
					if( $child['firstname'] || $child['lastname'] ) {
						echo "<tr><td>$ifkids</td><td><span class=\"normal\">$kidcount. ";
						if( $crights['both'] ) {
							if( $rightbranch )
								echo "<a href=\"admin_editperson.php?personID={$child['pID']}&amp;tree=$tree&amp;cw=$cw\">" . getName( $child ) . " - {$child['pID']}</a>";
							else
								echo getName( $child ) . " - " . $child['pID'];
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

							if($birthstring || $deathstring)
								echo " ($birthstring$deathstring)";
							if($childrel && $child[$childrel])
								echo " [" . $admtext[$child[$childrel]] . "]";
						}
						else
							echo ($child['private'] ? $admtext['text_private'] : $admtext['living']) . " - " . $child['pID'];
						echo "</span></td></tr>\n";
					}
					$kidcount++;
				}
				echo "</table>\n";
?>		
		</td>
	</tr>
<?php
				tng_free_result( $children );
			}
?>
	</table>
	</td>
	</table>
	</div>
<?php
		}
		tng_free_result($marriages);
	}
?>
	</div>
</td>
</tr>
<tr>
<td class="tngshadow databack">
	<input type="hidden" name="media" id="newmedia" value="" />
	<input type="hidden" name="tree" value="<?php echo $tree; ?>" />
	<input type="hidden" name="added" value="<?php echo $added; ?>" />
	<input type="hidden" name="personID" value="<?php echo "$personID"; ?>" />

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
		$close_command = "window.location.href='admin_people.php';";
	}
?>
	<input type="submit" name="savestay" id="savestay" class="btn" value="<?php echo $admtext['savereturn']; ?>" />
	<input type="submit" name="savestay" id="savestay2" class="btn savestay" value="<?php echo $admtext['savereturn']; ?>" />
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="<?php echo $close_command; ?>">
	&nbsp;
<?php
	if( $allow_add && ( !$assignedtree || $assignedtree == $tree ) ) {
?>
	<input type="submit" name="savepar" id="savepar" class="btn" value="<?php echo $admtext['savenewparent']; ?>" />
<?php
		if( $row['sex'] ) {
?>
	<input type="submit" name="savesp" id="savesp" class="btn" value="<?php echo $admtext['savenewspouse']; ?>" />
<?php
		}
	}
?>

<?php
	if( !$lnprefixes )
		echo "<input type=\"hidden\" name=\"lnprefix\" value=\"{$row['lnprefix']}\">";
	if( !$rights['lds'] ) { ?>
	<input type="hidden" value="<?php echo $row['baptdate']; ?>" name="baptdate">
	<input type="hidden" value="<?php echo $row['baptplace']; ?>" name="baptplace">
	<input type="hidden" value="<?php echo $row['confdate']; ?>" name="confdate">
	<input type="hidden" value="<?php echo $row['confplace']; ?>" name="confplace">
	<input type="hidden" value="<?php echo $row['initdate']; ?>" name="initdate">
	<input type="hidden" value="<?php echo $row['initplace']; ?>" name="initplace">
	<input type="hidden" value="<?php echo $row['endldate']; ?>" name="endldate">
	<input type="hidden" value="<?php echo $row['endlplace']; ?>" name="endlplace">
<?php } ?>
	<input type="hidden" value="<?php echo "$cw"; /*stands for "close window" */ ?>" name="cw">
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