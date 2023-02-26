<?php
include("begin.php");
include("adminlib.php");
$textpart = "families";
//include("getlang.php");
include("$mylanguage/admintext.php");

include($cms['tngpath'] . "checklogin.php");

if( !$allow_add ) {
	$message = $admtext['norights'];
	header( "Location: login.php?message=" . urlencode($message) );
	exit;
}

if( $child )
	$newperson = $child;
else if( $husband )
	$newperson = $husband;
else if( $wife )
	$newperson = $wife;
else
	$newperson = "";

if( $newperson ) {
	$query = "SELECT personID, firstname, lnprefix, lastname, prefix, suffix, nameorder, living, private, branch FROM $people_table WHERE personID = \"$newperson\" AND gedcom = \"$tree\"";
	$result = tng_query($query);
	$newpersonrow = tng_fetch_assoc( $result );
	tng_free_result($result);
}

if( $husband )
	$husbstr = getName( $newpersonrow ) . " - $husband";
else if( $wife )
	$wifestr = getName( $newpersonrow ) . " - $wife";
if(!isset($husbstr)) $husbstr = $admtext['clickfind'];
if(!isset($wifestr)) $wifestr = $admtext['clickfind'];

$query = "SELECT treename FROM $trees_table WHERE gedcom=\"$tree\" ORDER BY treename";
$result = tng_query($query);
$treerow = tng_fetch_assoc($result);
tng_free_result($result);

header("Content-type:text/html; charset=" . $session_charset);

include_once("eventlib.php");
?>

<form action="" method="post" name="famform1" id="famform1" onsubmit="return validateFamily(this,'<?php echo $slot; ?>');">
<input type="hidden" name="lastperson" value="<?php echo $child; ?>">
<table width="100%" border="0" cellpadding="10" cellspacing="0">
<tr class="databack">
<td class="tngbotshadow">
	<div style="float:right"><input type="submit" name="submit2" accesskey="s" class="bigsave" value="<?php echo $admtext['save']; ?>"></div>
	<span class="subhead togglehead"><strong><?php echo $admtext['addnewfamily']; ?></strong></span><br/><br/>

	<table class="normal">
	<tr><td valign="top" colspan="2"><span class="normal"><strong><?php echo $admtext['prefixfamilyid']; ?></strong></span></td></tr>
	<tr>
		<td><span class="normal"><?php echo $admtext['familyid']; ?>:</span></td>
		<td>
			<input type="text" name="familyID" id="familyID" value="<?php echo $newID; ?>" size="10" onblur="this.value=this.value.toUpperCase()">
			<input type="button" value="<?php echo $admtext['generate']; ?>" onClick="generateIDajax('family','familyID');">

			<input type="button" value="<?php echo $admtext['check']; ?>" onClick="checkIDajax(jQuery('#familyID').val(),'family','checkmsg');">
			<span id="checkmsg" class="normal"></span>
		</td>
	</tr>
	</table>
</td>
</tr>
<tr class="databack">
<td class="tngbotshadow">
	<?php echo displayToggle("plus0",1,"spouses",$admtext['spouses'],""); ?>

	<div id="spouses">
	<table class="normal topmarginsmall">
	<tr><td><span class="normal"><?php echo $admtext['husband']; ?>:</span></td><td><input type="text" readonly="readonly" name="husbnameplusid" id="husbnameplusid" size="40" value="<?php echo "$husbstr"; ?>">
		<input type="hidden" name="husband" id="husband" value="<?php echo $husband; ?>">
		<input type="button" value="<?php echo $admtext['find']; ?>" onclick="return findItem('I','husband','husbnameplusid','<?php echo $tree; ?>','<?php echo $assignedbranch; ?>');">
		<input type="button" value="<?php echo $admtext['create']; ?>" onclick="return newPerson('M','spouse');">
		<input type="button" value="  <?php echo $admtext['edit']; ?>  " onclick="editPerson(document.famform1.husband.value,0,'M');">
		<input type="button" value="<?php echo $admtext['remove']; ?>" onclick="removeSpouse(document.famform1.husband,document.famform1.husbnameplusid);">
	</td></tr>
	<tr><td><span class="normal"><?php echo $admtext['wife']; ?>:</span></td><td><input type="text" readonly readonly="readonly" name="wifenameplusid" id="wifenameplusid" size="40" value="<?php echo "$wifestr"; ?>">
		<input type="hidden" name="wife" id="wife" value="<?php echo $wife; ?>">
		<input type="button" value="<?php echo $admtext['find']; ?>" onclick="return findItem('I','wife','wifenameplusid','<?php echo $tree; ?>','<?php echo $assignedbranch; ?>');">
		<input type="button" value="<?php echo $admtext['create']; ?>" onclick="return newPerson('F','spouse');">
		<input type="button" value="  <?php echo $admtext['edit']; ?>  " onclick="editPerson(document.famform1.wife.value,0,'F');">
		<input type="button" value="<?php echo $admtext['remove']; ?>" onclick="removeSpouse(document.famform1.wife,document.famform1.wifenameplusid);">
	</td></tr>
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
	echo "<span id=\"fbranchlist\"></span>";
	if( !$assignedbranch ) {
		if($numbranches > 8)
			$select = "{$admtext['scrollbranch']}<br/>";
		$select .= "<select name=\"branch[]\" id=\"fbranch\" multiple size=\"8\">\n";
		$select .= "	<option value=\"\"";
		if( $row['branch'] == "" ) $select .= " selected";
		$select .= ">{$admtext['nobranch']}</option>\n";

		$select .= "$options</select>\n";
		echo " &nbsp;<span class=\"nw\">(<a href=\"#\" onclick=\"showEdit('fbranchedit'); quitEdit('fbranchedit'); return false;\"><img src=\"{$cms['tngpath']}img/ArrowDown.gif\" border=\"0\" style=\"margin-left:-4px;margin-right:-2px\">" . $admtext['edit'] . "</a> )</span><br />";
?>
		<div id="fbranchedit" class="lightback pad5" style="position:absolute;display:none;" onmouseover="clearTimeout(dtimer);" onmouseout="closeEdit('fbranch','fbranchedit','fbranchlist');">
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
	echo showEventRow('marrdate','marrplace','MARR','');
?>
		<tr>
			<td><?php echo $admtext['marriagetype']; ?>:</td>
			<td colspan="6"><input type="text" value="" name="marrtype" style="width:494px" maxlength="50"></td>
		</tr>
<?php
	if( determineLDSRights() )
		echo showEventRow('sealdate','sealplace','SLGS','');
	echo showEventRow('divdate','divplace','DIV','');
?>
	</table>

	</div>
</td>
</tr>
</table>
<input type="hidden" name="newfamily" value="ajax">
<input type="hidden" name="tree1" value="<?php echo $tree; ?>">
</form>