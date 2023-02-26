<?php
include("begin.php");
include("adminlib.php");
$textpart = "people";
//include("getlang.php");
include("$mylanguage/admintext.php");

include($cms['tngpath'] . "checklogin.php");

if( !$allow_add ) {
	$message = $admtext['norights'];
	header( "Location: login.php?message=" . urlencode($message) );
	exit;
}

$query = "SELECT treename FROM $trees_table WHERE gedcom=\"$tree\" ORDER BY treename";
$result = tng_query($query);
$treerow = tng_fetch_assoc($result);
tng_free_result($result);

if( $father ) {
	$query = "SELECT lnprefix, lastname, branch FROM $people_table WHERE gedcom=\"$tree\" AND personID=\"$father\"";
	$result = tng_query($query);
	$row = tng_fetch_assoc( $result );
	tng_free_result( $result );
}
else
	$row['lastname'] = $row['lnprefix'] = "";

header("Content-type:text/html; charset=" . $session_charset);

include_once("eventlib.php");
?>

<form action="" method="post"  name="persform1" id="persform1" onSubmit="return validatePerson(this);">
<table width="100%" border="0" cellpadding="10" cellspacing="0">
<tr class="databack">
<td class="tngbotshadow">
	<div style="float:right"><input type="submit" name="submit2" accesskey="s" class="bigsave" value="<?php echo $admtext['save']; ?>"></div>
	<span class="subhead togglehead"><strong><?php echo $admtext['addnewperson']; ?></strong></span><br/><br/>

	<table class="normal">
	<tr><td valign="top" colspan="2"><span class="normal"><strong><?php echo $admtext['prefixpersonid']; ?></strong></span></td></tr>
	<tr>
		<td><span class="normal"><?php echo $admtext['personid']; ?>:</span></td>
		<td>
			<input type="text" name="personID" id="personID" size="10" onBlur="this.value=this.value.toUpperCase()">
			<input type="button" value="<?php echo $admtext['generate']; ?>" onClick="generateIDajax('person','personID');">
			<input type="button" value="<?php echo $admtext['check']; ?>" onClick="checkIDajax(document.persform1.personID.value,'person','pcheckmsg');">
			<span id="pcheckmsg" class="normal"></span>
		</td>
	</tr>
	</table>
</td>
</tr>
<tr class="databack">
<td class="tngbotshadow">
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
		</tr>
		<tr>
			<td><input type="text" name="firstname" size="30" id="firstname" class="mediumfield"></td>
<?php
	if( $lnprefixes )
		echo "<td><input type=\"text\" name=\"lnprefix\" style=\"width:80px\" value=\"" . $row['lnprefix'] . "\"></td>\n";
?>
			<td><input type="text" name="lastname" size="30" value="<?php echo $row['lastname']; ?>" class="mediumfield"></td>
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
					<option value="U"><?php echo $admtext['unknown']; ?></option>
					<option value="M"<?php if($gender == "M") echo " selected"; ?>><?php echo $admtext['male']; ?></option>
					<option value="F"<?php if($gender == "F") echo " selected"; ?>><?php echo $admtext['female']; ?></option>
				</select>
			</td>
			<td><input type="text" name="nickname" class="veryshortfield"></td>
			<td><input type="text" name="title" class="veryshortfield"></td>
			<td><input type="text" name="prefix" class="veryshortfield"></td>
			<td><input type="text" name="suffix" class="veryshortfield"></td>
			<td>
				<select name="pnameorder">
					<option value="0"><?php echo $admtext['default']; ?></option>
					<option value="1"><?php echo $admtext['western']; ?></option>
					<option value="2"><?php echo $admtext['oriental']; ?></option>
					<option value="3"><?php echo $admtext['lnfirst']; ?></option>
				</select>
			</td>
		</tr>
	</table>

	<table class="normal topbuffer">
		<tr>
			<td class="nw">
				<input type="checkbox" name="living" value="1"<?php if(!$tngconfig['livingunchecked']) { echo " checked=\"checked\""; } ?>> <?php echo $admtext['living']; ?>&nbsp;&nbsp;
				<input type="checkbox" name="private" value="1"> <?php echo $admtext['text_private']; ?>
			</td>
			<td class="spaceonleft"><?php echo $admtext['tree'] . ": " . $treerow['treename']; ?></td>
			<td class="spaceonleft"><?php echo $admtext['branch'] . ": "; ?></td>
			<td style="height:2em">
<?php
	$query = "SELECT branch, description FROM $branches_table WHERE gedcom = \"$tree\" ORDER BY description";
	$branchresult = tng_query($query);
	$numbranches = tng_num_rows($branchresult);
	$branchlist = explode(",", $row['branch'] );

	$descriptions = array();
	$options = "";
	while( $branchrow = tng_fetch_assoc($branchresult) ) {
		$options .= "	<option value=\"{$branchrow['branch']}\">{$branchrow['description']}</option>\n";
	}
	echo "<span id=\"pbranchlist\"></span>";
	if( !$assignedbranch ) {
		if($numbranches > 8)
			$select = "{$admtext['scrollbranch']}<br/>";
		$select .= "<select name=\"branch[]\" id=\"pbranch\" multiple size=\"8\">\n";
		$select .= "	<option value=\"\"";
		if( $row['branch'] == "" ) $select .= " selected";
		$select .= ">{$admtext['nobranch']}</option>\n";

		$select .= "$options</select>\n";
		echo " &nbsp;<span class=\"nw\">(<a href=\"#\" onclick=\"showEdit('pbranchedit'); quitEdit('pbranchedit'); return false;\"><img src=\"{$cms['tngpath']}img/ArrowDown.gif\" border=\"0\" style=\"margin-left:-4px;margin-right:-2px\">" . $admtext['edit'] . "</a> )</span><br />";
?>
		<div id="pbranchedit" class="lightback pad5" style="position:absolute;display:none;" onmouseover="clearTimeout(dtimer);" onmouseout="closeEdit('pbranch','pbranchedit','pbranchlist');">
<?php
		echo $select;
		echo "</div>\n";
	}
	else
		echo "<input type=\"hidden\" name=\"branch\" value=\"$assignedbranch\">";
?>
			</td>
		</tr>
	</table>
	</div>
</td>
</tr>
<tr class="databack">
<td>
	<?php echo displayToggle("plus1",1,"events",$admtext['events'],""); ?>

	<div id="events">
	<p class="smallest topmarginsmall"><?php echo $admtext['datenote']; ?></p>
	<table class="normal">
		<tr><td>&nbsp;</td><td><?php echo $admtext['date']; ?></td><td><?php echo $admtext['place']; ?></td><td colspan="4">&nbsp;</td></tr>
<?php
	echo showEventRow('birthdate','birthplace','BIRT','');
	if(!$tngconfig['hidechr'])
		echo showEventRow('altbirthdate','altbirthplace','CHR','');
	echo showEventRow('deathdate','deathplace','DEAT','');
	echo showEventRow('burialdate','burialplace','BURI','');
	if( $allow_lds ) {
		echo showEventRow('baptdate','baptplace','BAPL','');
		echo showEventRow('confdate','confplace','CONL','');
		echo showEventRow('initdate','initplace','INIT','');
		echo showEventRow('endldate','endlplace','ENDL','');
	}
?>
	</table>
	</div>
</td>
</tr>

</table>
<input type="hidden" name="newperson" value="ajax">
<input type="hidden" name="tree1" value="<?php echo $tree; ?>">
<input type="hidden" name="familyID" value="<?php echo $familyID; ?>">
<input type="hidden" name="type" value="<?php echo $type; ?>">
<?php
	if( !$lnprefixes )
		echo "<input type=\"hidden\" name=\"lnprefix\" value=\"\">";
?>
</form>