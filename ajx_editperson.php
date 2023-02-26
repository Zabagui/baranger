<?php
include("begin.php");
include("adminlib.php");
if(!$personID) die("no args");

$textpart = "people";
//include("getlang.php");
include("$mylanguage/admintext.php");

include($cms['tngpath'] . "checklogin.php");

initMediaTypes();

$personID = ucfirst( $personID );
$query = "SELECT *, DATE_FORMAT(changedate,\"%d %b %Y %H:%i:%s\") as changedate FROM $people_table WHERE personID = \"$personID\" and gedcom = \"$tree\"";
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
$row['endlplace'] = preg_replace("/\"/", "&#34;",$row['endlplace']);

if( (!$allow_edit && (!$allow_add || !$added)) || ( $assignedtree && $assignedtree != $tree ) || !checkbranch( $row['branch'] ) ) {
	$message = $admtext['norights'];
	header( "Location: ajx_login.php?message=" . urlencode($message) );
	exit;
}

$editconflict = determineConflict($row,$people_table);

if ( $row['sex'] == "M" ) {
	$spouse = "wife"; $self = "husband"; $spouseorder = "husborder"; $selfdisplay = $admtext['ashusband'];
}
else if ($row['sex'] == "F" ) {
	$spouse = "husband"; $self = "wife"; $spouseorder = "wifeorder"; $selfdisplay = $admtext['aswife'];
}
else {
	$spouse = ""; $self = ""; $spouseorder = ""; $selfdisplay = $admtext['asspouse'];
}

$righttree = checktree($tree);

$rights = determineLivingPrivateRights($row, $righttree);
$row['allow_living'] = $rights['living'];
$row['allow_private'] = $rights['private'];

$namestr = getName($row);

$query = "SELECT treename FROM $trees_table WHERE gedcom = \"$tree\"";
$result = tng_query($query);
$treerow = tng_fetch_assoc( $result );
tng_free_result($result);

$query = "SELECT DISTINCT eventID as eventID FROM $notelinks_table WHERE persfamID=\"$personID\" AND gedcom =\"$tree\"";
$notelinks = tng_query($query);
$gotnotes = array();
while( $note = tng_fetch_assoc( $notelinks ) ) {
	if( !$note['eventID'] ) $note['eventID'] = "general";
	$gotnotes[$note['eventID']] = "*";
}
tng_free_result($notelinks);

$citquery = "SELECT DISTINCT eventID FROM $citations_table WHERE persfamID = \"$personID\" AND gedcom = \"$tree\"";
$citresult = tng_query($citquery) or die ($text['cannotexecutequery'] . ": $citquery");
$gotcites = array();
while( $cite = tng_fetch_assoc( $citresult ) ) {
	if( !$cite['eventID'] ) $cite['eventID'] = "general";
	$gotcites[$cite['eventID']] = "*";
}
tng_free_result($citresult);

$assocquery = "SELECT count(assocID) as acount FROM $assoc_table WHERE personID = \"$personID\" AND gedcom = \"$tree\"";
$assocresult = tng_query($assocquery) or die ($text['cannotexecutequery'] . ": $assocquery");
$assocrow = tng_fetch_assoc( $assocresult );
$gotassoc = $assocrow['acount'] ? "*" : "";
tng_free_result($assocresult);

$query = "SELECT parenttag FROM $events_table WHERE persfamID=\"$personID\" AND gedcom =\"$tree\"";
$morelinks = tng_query($query);
$gotmore = array();
while( $more = tng_fetch_assoc( $morelinks ) ) {
	$gotmore[$more['parenttag']] = "*";
}

$reltypes = array("adopted","birth","foster","sealing","step","putative");

$photo = showSmallPhoto( $personID, $namestr, 1, 0, false, $row['sex']);
header("Content-type:text/html; charset=" . $session_charset);

include_once("eventlib.php");
?>

<form action="" method="post" name="form2" id="form2" onsubmit="return updatePerson(this, <?php echo $slot; ?>);">
<table width="100%" border="0" cellpadding="10" cellspacing="0">
<tr>
<td class="tngshadow databack">
	<div style="float:right"><input type="submit" name="submit2" accesskey="s" id="bigsave" class="bigsave" value="<?php echo $admtext['save']; ?>"></div>
	<table cellpadding="0" cellspacing="0" class="normal">
		<tr>
			<td valign="top"><div id="thumbholder" style="margin-right:5px;<?php if(!$photo) echo "display:none"; ?>"><?php echo $photo; ?></div></td>
			<td>
				<span class="plainheader"><?php echo "$namestr ($personID)</span><br/>" . getYears($row); ?>
				<div class="topbuffer bottombuffer smallest">
<?php
				if($editconflict)
					echo "<br /><p>{$admtext['editconflict']}</p>";
				else {
					$notesicon = !empty($gotnotes['general']) ? "admin-note-on-icon" : "admin-note-off-icon";
					$citesicon = !empty($gotcites['general']) ? "admin-cite-on-icon" : "admin-cite-off-icon";
					$associcon = $gotassoc ? "admin-asso-on-icon" : "admin-asso-off-icon";
					echo "<a href=\"#\" onclick=\"jQuery('#bigsave').click();\" class=\"smallicon si-plus admin-save-icon\">{$admtext['save']}</a>\n";
					echo "<a href=\"#\" onclick=\"return showNotes('', '$personID');\" id=\"notesicon\" class=\"smallicon si-plus $notesicon\">{$admtext['notes']}</a>\n";
					echo "<a href=\"#\" onclick=\"return showCitations('', '$personID');\" id=\"citesicon\" class=\"smallicon si-plus $citesicon\">{$admtext['sources']}</a>\n";
		 			echo "<a href=\"#\" onclick=\"return showAssociations('$personID','I');\" id=\"associcon\" class=\"smallicon si-plus $associcon\">{$admtext['associations']}</a>\n";
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
				$notesicon = $cms['tngpath'] . "img/" . (!empty($gotnotes['NAME']) ? "tng_anote_on.gif" : "tng_anote.gif");
				$citesicon = $cms['tngpath'] . "img/" . (!empty($gotcites['NAME']) ? "tng_cite_on.gif" : "tng_cite.gif");
				echo "<a href=\"#\" onclick=\"return showNotes('NAME','$personID');\"><img src=\"$notesicon\" title=\"{$admtext['notes']}\" alt=\"{$admtext['notes']}\" $dims id=\"notesiconNAME\" class=\"smallicon\"/></a>\n";
				echo "<a href=\"#\" onclick=\"return showCitations('NAME','$personID');\"><img src=\"$citesicon\" title=\"{$admtext['sources']}\" alt=\"{$admtext['sources']}\" $dims id=\"citesiconNAME\" class=\"smallicon\"/></a>\n";
?>
			</td>
		</tr>
	</table>
	<table class="normal topmarginsmall">
		<tr>
			<td><?php echo $admtext['sex']; ?></td>
			<td><?php echo $admtext['nickname']; ?></td>
			<td><?php echo $admtext['title']; ?></td>
			<td><?php echo $admtext['prefix']; ?></td>
			<td><?php echo $admtext['suffix']; ?></td>
			<td><?php echo $admtext['nameorder']; ?></td>
		</tr>
		<tr>
			<td>
				<select name="sex">
					<option value="U" <?php if( $row['sex'] == "U" ) echo "selected"; ?>><?php echo $admtext['unknown']; ?></option>
					<option value="M" <?php if( $row['sex'] == "M" ) echo "selected"; ?>><?php echo $admtext['male']; ?></option>
					<option value="F" <?php if( $row['sex'] == "F" ) echo "selected"; ?>><?php echo $admtext['female']; ?></option>
				</select>
			</td>
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
	echo showEventRow('birthdate','birthplace','BIRT',$personID);
	if(!$tngconfig['hidechr'])
		echo showEventRow('altbirthdate','altbirthplace','CHR',$personID);
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
	<input type="hidden" name="tree" value="<?php echo $tree; ?>">
	<input type="hidden" name="personID" value="<?php echo "$personID"; ?>">
	<input type="hidden" name="newfamily" value="ajax">
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
	</table>
	</div>
</td>
</tr>
<?php
$query = "SELECT personID, familyID, sealdate, sealplace, frel, mrel FROM $children_table WHERE personID = \"$personID\" AND gedcom = \"$tree\" ORDER BY parentorder";
$parents = tng_query($query);
$parentcount = tng_num_rows( $parents );

if( $parentcount ) {
?>
<tr>
<td class="tngshadow databack">
<?php echo displayToggle("plus2",0,"parents",$admtext['parents'] . " (<span id=\"parentcount\">$parentcount</span>)",""); ?>

	<div id="parents" style="display:none"><br />
<?php
	while ( $parent = tng_fetch_assoc( $parents ) )
	{
		$query = "SELECT personID, lastname, lnprefix, firstname, birthdate, birthplace, altbirthdate, altbirthplace, prefix, suffix, nameorder, $people_table.living, $people_table.private, $people_table.branch FROM ($people_table, $families_table) WHERE $people_table.personID = $families_table.husband AND $families_table.familyID = \"{$parent['familyID']}\" AND $people_table.gedcom = \"$tree\" AND $families_table.gedcom = \"$tree\"";
		$gotfather = tng_query($query);

		echo "<div class=\"sortrow\" id=\"parents_{$parent['familyID']}\" style=\"clear:both\" onmouseover=\"$('unlinkp_{$parent['familyID']}').style.display='';\" onmouseout=\"$('unlinkp_{$parent['familyID']}').style.display='none';\">\n";
		echo "<table width=\"100%\" cellpadding=\"5\" cellspacing=\"1\"><tr>\n";
		if($parentcount > 1) {
			echo "<td class=\"dragarea normal\">";
	   		echo "<img src=\"{$cms['tngpath']}img/admArrowUp.gif\" alt=\"\"><br/>" . $admtext['drag'] . "<br/><img src=\"{$cms['tngpath']}img/admArrowDown.gif\" alt=\"\">\n";
			echo "</td>\n";
		}
		echo "<td class=\"lightback normal\">\n";
		echo "<div id=\"unlinkp_{$parent['familyID']}\" style=\"float:right;display:none\"><a href=\"#\" onclick=\"return unlinkParents('{$parent['familyID']}');\">{$admtext['unlinkindividual']} ($personID) {$admtext['aschild']}</a></div>\n";
		echo "<table class=\"normal\"><tr><td valign=\"top\"><strong>{$admtext['family']}:</strong></td>\n";
		echo "<td valign=\"top\" colspan=\"4\">\n";
		//echo "<a href=\"editfamily.php?familyID=$parent['familyID']&amp;tree=$tree&amp;cw=$cw\">$parent['familyID']</a>\n</td></tr>";
		echo $parent['familyID'] . "\n</td></tr>";
	    	if( $gotfather ) {
			$fathrow =  tng_fetch_assoc( $gotfather );
			$frights = determineLivingPrivateRights($fathrow, $righttree);
			$fathrow['allow_living'] = $frights['living'];
			$fathrow['allow_private'] = $frights['private'];
?>
		<tr>
			<td valign="top"><?php echo $admtext['father']; ?>:</td>
			<td valign="top" colspan="4">
<?php 
			if( $fathrow['personID'] ) {
				//echo "<a href=\"admin_editperson.php?personID=$fathrow['personID']&amp;tree=$tree&amp;cw=$cw\">" . getName( $fathrow ) . " - $fathrow['personID']</a>";
				echo getName( $fathrow ) . " - " . $fathrow['personID']; 
			} 
?>
			</td>
		</tr>
		<tr>
			<td valign="top">&nbsp;&nbsp;<?php echo $admtext['relationship']; ?>:</td>
			<td valign="top" colspan="4">
				<select name="frel<?php echo $parent['familyID']; ?>">
					<option value=""></option>
			<?php  	
				foreach( $reltypes as $reltype ) {
					echo "<option value=\"$reltype\"";
					$lowerrel = strtolower($parent['frel']);
					if( $lowerrel == $reltype || $lowerrel == $admtext[$reltype] ) echo " selected";
					echo ">{$admtext[$reltype]}</option>\n";
				}
			?>
				</select>
			</td>
		</tr>
<?php
			tng_free_result( $gotfather );
		}

		$query = "SELECT personID, lastname, lnprefix, firstname, birthdate, birthplace, altbirthdate, altbirthplace, prefix, suffix, nameorder, $people_table.living, $people_table.private, $people_table.branch FROM ($people_table, $families_table) WHERE $people_table.personID = $families_table.wife AND $families_table.familyID = \"{$parent['familyID']}\" AND $people_table.gedcom = \"$tree\" AND $families_table.gedcom = \"$tree\"";
		$gotmother = tng_query($query);

		if( $gotmother ) {
			$mothrow =  tng_fetch_assoc( $gotmother );
			$mrights = determineLivingPrivateRights($mothrow, $righttree);
			$mothrow['allow_living'] = $mrights['living'];
			$mothrow['allow_private'] = $mrights['private'];?>
		<tr>
			<td valign="top"><span class="normal"><?php echo $admtext['mother']; ?>:</span></td>
			<td valign="top" colspan="4">
<?php
			if( $mothrow['personID'] ) {
				//echo "<a href=\"editperson.php?personID=$mothrow['personID']&amp;tree=$tree&amp;cw=$cw\">" . getName( $mothrow ) . " - $mothrow['personID']</a>";
				echo getName( $mothrow ) . " - " . $mothrow['personID'];
			}
?>
			</td>
		</tr>
		<tr>
			<td valign="top">&nbsp;&nbsp;<?php echo $admtext['relationship']; ?>:</td>
			<td valign="top" colspan="4">
				<select name="mrel<?php echo $parent['familyID']; ?>">
					<option value=""></option>
			<?php
				foreach( $reltypes as $reltype ) {
					echo "<option value=\"$reltype\"";
					$lowerrel = strtolower($parent['frel']);
					if( $lowerrel == $reltype || $lowerrel == $admtext[$reltype] ) echo " selected";
					echo ">{$admtext[$reltype]}</option>\n";
				}
			?>
				</select>
			</td>
		</tr>
<?php
			tng_free_result( $gotmother );
		} 

		$parent['sealplace'] = preg_replace("/\"/", "&#34;",$parent['sealplace']);
		if( $rights['lds'] ) {
			$citquery = "SELECT citationID FROM $citations_table WHERE persfamID = \"$personID" . "::" . "{$parent['familyID']}\" AND gedcom = \"$tree\"";
			$citresult = tng_query($citquery) or die ($text['cannotexecutequery'] . ": $citquery");
			$citesicon = $cms['tngpath'] . "img/" . (tng_num_rows($citresult) ? "tng_cite_on.gif" : "tng_cite.gif");
			tng_free_result($citresult);

			echo "<table><tr><td>&nbsp;</td><td>" . $admtext['date'] . "</td><td>" . $admtext['place'] . "</td><td colspan=\"2\">&nbsp;</td></tr>\n";
			echo "<tr>\n";
			echo "<td valign=\"top\" class=\"nw\" style=\"width:110px\">" . $admtext['SLGC'] . ":</td>\n";
			echo "<td><input type=\"text\" value=\"" . $parent['sealdate'] . "\" name=\"sealpdate" . $parent['familyID'] . "\" onblur=\"checkDate(this);\" maxlength=\"50\" class=\"shortfield\"></td>\n";
			echo "<td><input type=\"text\" value=\"" . $parent['sealplace'] . "\" name=\"sealpplace" . $parent['familyID'] . "\" id=\"sealpplace" . $parent['familyID'] . "\" class=\"longfield\"></td>\n";
			echo "<td><a href=\"#\" onclick=\"return openFindPlaceForm('sealpplace" . $parent['familyID'] . "');\"><img src=\"{$cms['tngpath']}img/tng_find.gif\" title=\"{$admtext['find']}\" alt=\"{$admtext['find']}\" $dims class=\"smallicon\"/></a></td>\n";
			echo "<td><a href=\"#\" onclick=\"return showCitations('SLGC','$personID::" . $parent['familyID']. "');\"><img src=\"$citesicon\" title=\"{$admtext['sources']}\" alt=\"{$admtext['sources']}\" $dims id=\"citesiconSLGC$personID::" . $parent['familyID'] . "\" class=\"smallicon\"/></a></td>\n";
			echo "</tr>\n</table>\n";
		}
		else {
?>
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
}

if( $row['sex'] ) {
	if( $self )
		 $query = "SELECT $spouse, familyID, marrdate FROM $families_table WHERE $families_table.$self = \"$personID\" AND gedcom = \"$tree\" ORDER BY $spouseorder";
	else
		$query = "SELECT husband, wife, familyID, marrdate FROM $families_table WHERE ($families_table.husband = \"$personID\" OR $families_table.wife = \"$personID\") AND gedcom = \"$tree\"";
	$marriages= tng_query($query);
	$marrcount = tng_num_rows( $marriages );

	if( $marrcount ) {
?>
<tr>
<td class="tngshadow databack">
<?php echo displayToggle("plus3",0,"spouses",$admtext['spouses'] . " (<span id=\"marrcount\">$marrcount</span>)",""); ?>

	<div id="spouses" style="display:none"><br />
<?php
	if ( $marriages && tng_num_rows( $marriages ) ) {
		while ( $marriagerow =  tng_fetch_assoc( $marriages ) )
		{
			if( !$spouse ) {
				if( $personID == $marriagerow['husband'] ) {
					$self = "husband"; $spouse = "wife";
				}
				else if( $personID == $marriagerow['wife'] )
					$self = "wife"; $spouse = "husband";
			}
			echo "<div class=\"sortrow\" id=\"spouses_{$marriagerow['familyID']}\" style=\"clear:both\" onmouseover=\"$('unlinks_{$marriagerow['familyID']}').style.display='';\" onmouseout=\"$('unlinks_{$marriagerow['familyID']}').style.display='none';\">\n";
			echo "<table width=\"100%\" cellpadding=\"5\" cellspacing=\"1\"><tr>\n";
			if($marrcount >1) {
				echo "<td class=\"dragarea normal\">";
		   		echo "<img src=\"{$cms['tngpath']}img/admArrowUp.gif\" alt=\"\"><br/>" . $admtext['drag'] . "<br/><img src=\"{$cms['tngpath']}img/admArrowDown.gif\" alt=\"\">\n";
				echo "</td>\n";
			}
			echo "<td class=\"lightback normal\">\n";
			echo "<table class=\"normal\" width=\"100%\"><tr><td valign=\"top\"><strong>{$admtext['family']}:</strong></td>\n";
			echo "<td valign=\"top\" width=\"94%\">\n";
			echo "<div id=\"unlinks_{$marriagerow['familyID']}\" style=\"float:right;display:none\"><a href=\"#\" onclick=\"return unlinkSpouse('{$marriagerow['familyID']}');\">{$admtext['unlinkindividual']} ($personID) {$admtext['asspouse']}</a></div>\n";
			//echo "<a href=\"editfamily.php?familyID=$marriagerow['familyID']&amp;tree=$tree&amp;cw=$cw\">$marriagerow['familyID']</a>\n</td></tr>";
			echo $marriagerow['familyID'] . "\n</td></tr>";
			if( $marriagerow[$spouse] ) {
				$query = "SELECT personID, lastname, lnprefix, firstname, prefix, suffix, nameorder, living, private, branch FROM $people_table WHERE personID = \"{$marriagerow[$spouse]}\" AND gedcom = \"$tree\"";
				$spouseresult= tng_query($query);
				$spouserow =  tng_fetch_assoc( $spouseresult );
				$srights = determineLivingPrivateRights($spouserow, $righttree);
				$spouserow['allow_living'] = $srights['living'];
				$spouserow['allow_private'] = $srights['private'];			}
			else {
				$spouserow = "";
			}
?>
	<tr>
		<td valign="top"><?php echo $admtext['spouse']; ?>:</td>
		<td valign="top">
<?php 
			if( $spouserow['personID'] ) {
				//echo "<a href=\"editperson.php?personID=$spouserow['personID']&amp;tree=$tree&amp;cw=$cw\">" . getName( $spouserow ) . " - $spouserow['personID']</a>"; 
				echo getName( $spouserow ) . " - " . $spouserow['personID']; 
			} 
	?>
		</td>
	</tr>
<?php			if( $marriagerow['marrdate'] || $marriagerow['marrplace'] ) { ?>
	<tr>
		<td valign="top"><span class="normal"><?php echo $admtext['married']; ?>:</span></td>
		<td valign="top"><span class="normal"><?php echo $marriagerow['marrdate']; ?></span></td>
	</tr>
<?php
			}

			$query = "SELECT $people_table.personID as pID, firstname, lnprefix, lastname, haskids, living, private, branch, prefix, suffix, nameorder FROM ($people_table, $children_table) WHERE $people_table.personID = $children_table.personID AND $children_table.familyID = \"{$marriagerow['familyID']}\" AND $people_table.gedcom = \"$tree\" AND $children_table.gedcom = \"$tree\" ORDER BY ordernum";
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
					$ifkids = $child['haskids'] ? "&gt;" : "&nbsp;";
		 			$crights = determineLivingPrivateRights($child, $righttree);
					$child['allow_living'] = $crights['living'];
					$child['allow_private'] = $crights['private'];
					if( $child['firstname'] || $child['lastname'] ) {
						echo "<tr><td>$ifkids</td><td><span class=\"normal\">$kidcount. ";
						if( $crights['both'] ) {
							//if( $rightbranch )
								//echo "<a href=\"admin_editperson.php?personID=$child['pID']&amp;tree=$tree&amp;cw=$cw\">" . getName( $child ) . " - $child['pID']</a>";
							//else
								echo getName( $child ) . " - {$child['pID']}";
						}
						else
							echo $admtext['living'] . " - " . $child['pID'];
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
<?php
	}
}

} //end of the editconflict conditional
?>
</table>
</form>