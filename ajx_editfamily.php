<?php
include("begin.php");
include("adminlib.php");
if(!$familyID) die("no args");

$textpart = "families";
//include("getlang.php");
include("$mylanguage/admintext.php");

include($cms['tngpath'] . "checklogin.php");

initMediaTypes();

function getBirth($row) {
    global $admtext;

    $birthdate = "";
    if( $row['birthdate'] ) {
        $birthdate = "{$admtext['birthabbr']} " . displayDate($row['birthdate']);
    }
    else if( $row['altbirthdate'] ) {
        $birthdate = "{$admtext['chrabbr']} " . displayDate($row['altbirthdate']);
    }
    if($birthdate) $birthdate = " ($birthdate)";
    return $birthdate;
}

$familyID = ucfirst( $familyID );
$query = "SELECT *, DATE_FORMAT(changedate,\"%d %b %Y %H:%i:%s\") as changedate FROM $families_table WHERE familyID = \"$familyID\" AND gedcom = \"$tree\"";
$result = tng_query($query);
$row = tng_fetch_assoc( $result );
tng_free_result($result);
$row['marrplace'] = preg_replace("/\"/", "&#34;",$row['marrplace']);
$row['sealplace'] = preg_replace("/\"/", "&#34;",$row['sealplace']);
$row['divplace'] = preg_replace("/\"/", "&#34;",$row['divplace']);
$row['notes'] = preg_replace("/\"/", "&#34;",$row['notes']);

if( (!$allow_edit && (!$allow_add || !$added)) || ( $assignedtree && $assignedtree != $tree ) || !checkbranch( $row['branch'] ) ) {
	$message = $admtext['norights'];
	header( "Location: ajx_login.php?message=" . urlencode($message) );
	exit;
}

$editconflict = determineConflict($row,$families_table);

$familygroup_url = getURL( "familygroup", 1 );

$righttree = checktree($tree);
$rightbranch = $righttree ? checkbranch($row['branch']) : false;
$rights = determineLivingPrivateRights($row, $righttree, $rightbranch);
$row['allow_living'] = $rights['living'];
$row['allow_private'] = $rights['private'];

$namestr = getFamilyName($row);

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
$citresult = tng_query($citquery) or die ($text['cannotexecutequery'] . ": $citquery");
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

$query = "SELECT $people_table.personID as pID, firstname, lastname, lnprefix, prefix, suffix, nameorder, birthdate, altbirthdate, living, private, branch FROM $people_table, $children_table WHERE $people_table.personID = $children_table.personID AND $children_table.familyID = \"$familyID\" AND $people_table.gedcom = \"$tree\" AND $children_table.gedcom = \"$tree\" ORDER BY ordernum";
$children= tng_query($query);

$kidcount = tng_num_rows( $children );

$helplang = findhelp("families_help.php");

$photo = showSmallPhoto( $familyID, $namestr, 1, 0, true );
header("Content-type:text/html; charset=" . $session_charset);

$righttree = checktree($tree);

include_once("eventlib.php");
?>

<form action="" onsubmit="return updateFamily(this,<?php echo $slot; ?>,'admin_updatefamily.php');" method="post" name="famform1" id="famform1">
<table width="100%" border="0" cellpadding="10" cellspacing="0">
<tr>
<td class="tngshadow databack">
	<div style="float:right"><input type="submit" name="submit2" accesskey="s" class="bigsave" value="<?php echo $admtext['save']; ?>"></div>
	<table cellpadding="0" cellspacing="0" class="normal">
		<tr>
			<td valign="top"><div id="thumbholder" style="margin-right:5px;<?php if(!$photo) echo "display:none"; ?>"><?php echo $photo; ?></div></td>
			<td>
				<span class="plainheader"><?php echo $namestr; ?></span><br/>
				<div class="topbuffer bottombuffer smallest">
<?php
				if($editconflict)
					echo "<br /><p>{$admtext['editconflict']}</p>";
				else {
					$notesicon = $gotnotes['general'] ? "admin-note-on-icon" : "admin-note-off-icon";
					$citesicon = $gotcites['general'] ? "admin-cite-on-icon" : "admin-cite-off-icon";
					$associcon = $gotassoc ? "admin-asso-on-icon" : "admin-asso-off-icon";
					echo "<a href=\"#\" onclick=\"document.form1.submit();\" class=\"smallicon si-plus admin-save-icon\">{$admtext['save']}</a>\n";
					echo "<a href=\"#\" onclick=\"return showNotes('', '$familyID');\" class=\"smallicon si-plus $notesicon\">{$admtext['notes']}</a>\n";
					echo "<a href=\"#\" onclick=\"return showCitations('', '$familyID');\" class=\"smallicon si-plus $citesicon\">{$admtext['sources']}</a>\n";
		 			echo "<a href=\"#\" onclick=\"return showAssociations('$familyID','F');\" class=\"smallicon si-plus $associcon\">{$admtext['associations']}</a>\n";
				}
?>
                <br clear="all" />
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
		$query = "SELECT lastname, lnprefix, firstname, prefix, suffix, nameorder, living, private, branch, birthdate, altbirthdate FROM $people_table WHERE personID = \"{$row['husband']}\" AND gedcom = \"$tree\"";
		$spouseresult= tng_query($query);
		$spouserow =  tng_fetch_assoc( $spouseresult );
		tng_free_result($spouseresult);
	}
	if( $row['husband'] ) {
		$hrights = determineLivingPrivateRights($spouserow, $righttree);
		$spouserow['allow_living'] = $hrights['living'];
		$spouserow['allow_private'] = $hrights['private'];
		$husbstr = getName( $spouserow ) . getBirth($spouserow) . " - " . $row['husband'];
	}
	if(!isset($husbstr)) $husbstr = $admtext['clickfind'];
?>
	<tr><td><span class="normal"><?php echo $admtext['husband']; ?>:</span></td><td><input type="text" readonly="readonly" name="husbnameplusid" id="husbnameplusid" size="40" value="<?php echo "$husbstr"; ?>"><input type="hidden" name="husband" id="husband" value="<?php echo $row['husband']; ?>">
		<input type="button" value="<?php echo $admtext['find']; ?>" onclick="return findItem('I','husband','husbnameplusid','<?php echo $tree; ?>','<?php echo $assignedbranch; ?>');">
		<input type="button" value="<?php echo $admtext['addnew']; ?>" onclick="return newPerson('M','spouse');">
		<input type="button" value="  <?php echo $admtext['edit']; ?>  " onclick="editPerson(document.famform1.husband.value,0,'M');">
		<input type="button" value="<?php echo $admtext['remove']; ?>" onclick="removeSpouse(document.famform1.husband,document.famform1.husbnameplusid);">
	</td></tr>
<?php
	if( $row['wife'] ) {
		$query = "SELECT lastname, lnprefix, firstname, prefix, suffix, nameorder, living, private, branch, birthdate, altbirthdate FROM $people_table WHERE personID = \"{$row['wife']}\" AND gedcom = \"$tree\"";
		$spouseresult= tng_query($query);
		$spouserow =  tng_fetch_assoc( $spouseresult );
		tng_free_result($spouseresult);
	}
	else
		$spouserow = "";
	if( $row['wife'] ){
		$wrights = determineLivingPrivateRights($spouserow, $righttree);
		$spouserow['allow_living'] = $wrights['living'];
		$spouserow['allow_private'] = $wrights['private'];
		$wifestr = getName( $spouserow ) . getBirth($spouserow) . " - " . $row['wife'];
	}
	if(!isset($wifestr)) $wifestr = $admtext['clickfind'];
?>
	<tr><td><span class="normal"><?php echo $admtext['wife']; ?>:</span></td><td><input type="text" readonly readonly="readonly" name="wifenameplusid" id="wifenameplusid" size="40" value="<?php echo "$wifestr"; ?>"><input type="hidden" name="wife" id="wife" value="<?php echo $row['wife']; ?>">
		<input type="button" value="<?php echo $admtext['find']; ?>" onclick="return findItem('I','wife','wifenameplusid','<?php echo $tree; ?>','<?php echo $assignedbranch; ?>');">
		<input type="button" value="<?php echo $admtext['create']; ?>" onclick="return newPerson('F','spouse');">
		<input type="button" value="  <?php echo $admtext['edit']; ?>  " onclick="editPerson(document.famform1.wife.value,0,'F');">
		<input type="button" value="<?php echo $admtext['remove']; ?>" onclick="removeSpouse(document.famform1.wife,document.famform1.wifenameplusid);">
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
		$select = $totbranches >=8 ? "{$admtext['scrollbranch']}<br/>" : "";
		$select .= "<select name=\"branch[]\" id=\"branch\" multiple size=\"$selectnum\" style=\"overflow:auto\">\n";
		$select .= "	<option value=\"\"";
		if( $row['branch'] == "" ) $select .= " selected";
		$select .= ">{$admtext['nobranch']}</option>\n";

		$select .= "$options</select>\n";

		echo " &nbsp;<span class=\"nw\">(<a href=\"#\" onclick=\"showEdit('branchedit'); quitEdit('branchedit'); return false;\"><img src=\"{$cms['tngpath']}img/ArrowDown.gif\" border=\"0\" style=\"margin-left:-4px;margin-right:-2px\">" . $admtext['edit'] . "</a> )</span><br />";
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
	<p class="smallest topmarginsmall"><?php echo $admtext['datenote']; ?></p>
	<table class="normal" cellpadding="1" cellspacing="2">
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
<?php echo displayToggle("plus2",1,"children",$admtext['children'] . " (<span id=\"childcount\">$kidcount</span>)",""); ?>

	<div id="children" style="padding-top:10px">
		<table id="ordertbl" width="500px" cellpadding="3" cellspacing="1" border="0">
			<tr>
				<td class="fieldnameback" style="width:55px"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['text_sort']; ?></b>&nbsp;</nobr></span></td>
				<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['child']; ?></b>&nbsp;</nobr></span></td>
			</tr>
		</table>
		<div id="childrenlist">
<?php
	if( $children && $kidcount ) {
		while ( $child =  tng_fetch_assoc( $children ) )
		{
			$crights = determineLivingPrivateRights($child, $righttree);
			$child['allow_living'] = $crights['living'];
			$child['allow_private'] = $crights['private'];
			if( $child['firstname'] || $child['lastname'] ) {
				echo "<div class=\"sortrow\" id=\"child_{$child['pID']}\" style=\"width:500px;clear:both\"";
				if($allow_delete)
					echo " onmouseover=\"$('unlinkc_{$child['pID']}').style.visibility='visible';\" onmouseout=\"$('unlinkc_{$child['pID']}').style.visibility='hidden';\"";
				echo ">\n";
				echo "<table width=\"100%\" cellpadding=\"5\" cellspacing=\"1\"><tr>\n";
				echo "<td class=\"dragarea normal\">";
		   		echo "<img src=\"{$cms['tngpath']}img/admArrowUp.gif\" alt=\"\"><br/>" . $admtext['drag'] . "<br/><img src=\"{$cms['tngpath']}img/admArrowDown.gif\" alt=\"\">\n";
				echo "</td>\n";
				echo "<td class=\"lightback normal childblock\">\n";

				if($allow_delete)
					echo "<div id=\"unlinkc_{$child['pID']}\" class=\"smaller hide-right\"><a href=\"#\" onclick=\"return unlinkChild('{$child['pID']}','child_unlink');\">{$admtext['remove']}</a> &nbsp; | &nbsp; <a href=\"#\" onclick=\"return unlinkChild('{$child['pID']}','child_delete');\">{$admtext['text_delete']}</a></div>";
				if( $crights['both'] ) {
					if( $child['birthdate'] ) {
						$birthstring = $admtext['birthabbr'] . " " . displayDate($child['birthdate']);
					}
					else if( $child['altbirthdate'] ) {
						$birthstring = $admtext['chrabbr'] . " " . displayDate($child['altbirthdate']);
					}
					else
						$birthstring = $admtext['nobirthinfo'];
					//echo $ajax ? getName( $child ) : "<a href=\"admin_editperson.php?personID={$child['pID']}&tree=$tree&cw=1\">" . getName( $child ) . "</a>";
					echo getName($child);
					echo " - {$child['pID']}<br />$birthstring";
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

		<input type="hidden" name="tree" value="<?php echo $tree; ?>">
		<p class="normal"><?php echo $admtext['newchildren']; ?>:
		<input type="button" value="<?php echo $admtext['find']; ?>" onclick="return findItem('I','children',null,'<?php echo $tree; ?>');">
		<input type="button" value="<?php echo $admtext['create']; ?>" onclick="return newPerson('','child',document.famform1.husband.value,'<?php echo "$familyID"; ?>','<?php echo $assignedbranch; ?>');">
		<input type="hidden" name="familyID" value="<?php echo "$familyID"; ?>">
		<input type="hidden" name="lastperson" value="<?php echo "$lastperson"; ?>">
		<input type="hidden" name="newfamily" value="ajax">
<?php if( !$rights['lds'] ) { ?>
		<input type="hidden" value="<?php echo $row['sealdate']; ?>" name="sealdate">
		<input type="hidden" value="<?php echo $row['sealplace']; ?>" name="sealplace">
<?php } ?>
		</p>
	</div>
</td>
</tr>
<?php
} //end of the editconflict conditional
?>
</table>
</form>