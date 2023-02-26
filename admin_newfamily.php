<?php
include("begin.php");
include("adminlib.php");
$textpart = "families";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( !$allow_add ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

if(!empty($child))
	$newperson = $child;
else if(!empty($husband))
	$newperson = $husband;
else if(!empty($wife))
	$newperson = $wife;
else
	$newperson = "";
	
if( $newperson ) {
	$query = "SELECT personID, firstname, lnprefix, lastname, prefix, suffix, title, nameorder, birthdate, birthdatetr, altbirthdate, altbirthdatetr, living, private, branch, gedcom FROM $people_table WHERE personID = \"$newperson\" AND gedcom = \"$tree\"";
	$result = tng_query($query);
	$newpersonrow = tng_fetch_assoc( $result );

	$righttree = checktree($tree);
	$rightbranch = $righttree ? checkbranch($newpersonrow['branch']) : false;
	$rights = determineLivingPrivateRights($newpersonrow, $righttree, $rightbranch);
	$newpersonrow['allow_living'] = $rights['living'];
	$newpersonrow['allow_private'] = $rights['private'];
	tng_free_result($result);
}
	
if(!empty($husband))
	$husbstr = getName( $newpersonrow ) . " - $husband";
else if(!empty($wife))
	$wifestr = getName( $newpersonrow ) . " - $wife";
if(!isset($husbstr)) $husbstr = $admtext['clickfind'];
if(!isset($wifestr)) $wifestr = $admtext['clickfind'];

if( $assignedtree ) {
	$wherestr = "WHERE gedcom = \"$assignedtree\"";
	$firsttree = $assignedtree;
}
else {
	$wherestr = "";
	$firsttree = !empty($tree) ? $tree : (isset($_COOKIE['tng_tree']) ? $_COOKIE['tng_tree'] : "");
}
$query = "SELECT gedcom, treename FROM $trees_table $wherestr ORDER BY treename";
$result = tng_query($query);

$helplang = findhelp("families_help.php");

$revstar = checkReview("F");

tng_adminheader( $admtext['addnewfamily'], $flags );
if(!isset($tree)) $tree = "";
include_once("eventlib.php");
include_once("eventlib_js.php");
?>
<script type="text/javascript">
<?php if(!empty($stay)) { echo "window.opener.location.reload(false);\n"; } ?>
var persfamID = "";
var allow_cites = false;
var allow_notes = false;

function toggleAll(display) {
	toggleSection('spouses','plus0',display);
	toggleSection('events','plus1',display);
	return false;
}

<?php
if( !$assignedtree && !$assignedbranch )
	include("branchlibjs.php");
else
	$swapbranches = "";
?>
function validateFamily(form) {
	var rval = true;

	form.familyID.value = TrimString( form.familyID.value );
	if( form.familyID.value.length == 0 ) {
		alert("<?php echo $admtext['enterfamilyid']; ?>");
		return false;
	}
	return true;
}

function EditSpouse(field) {
	var tree=getTree(document.form1.tree1);
	if( field.value.length )
		window.open('admin_editperson.php?personID=' + field.value + '&tree=' + tree + '&cw=1');
}

function RemoveSpouse( spouse, spousedisplay ) {
	spouse.value = "";
	spousedisplay.value = "<?php echo $admtext['clickfind']; ?>";
}

var nplitbox;
var activeidbox = null;
var activenamebox = null;
function openCreatePersonForm(idfield,namefield,type,gender) {
	activeidbox = idfield;
	activenamebox = namefield;
	nplitbox = new LITBox(
		'admin_newperson2.php?tree=' + document.form1.tree1.options[document.form1.tree1.selectedIndex].value + '&type='+type + '&familyID=' + persfamID + '&gender=' + gender,
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
		jQuery.ajax({
			url: 'admin_addperson2.php',
			data: params,
			dataType: 'json',
			type: 'post',
			success: function(vars){
				if(vars.error) {
					jQuery('#errormsg').html(vars.error);
					jQuery('#errormsg').show();
				}
				else {
					nplitbox.remove();
					jQuery('#'+activenamebox).val(vars.name + ' - ' + vars.id);
					jQuery('#'+activenamebox).effect('highlight',{},400);
					jQuery('#'+activeidbox).val(vars.id);
				}
			}
		});
	}
	return false
}
</script>
<script type="text/javascript" src="js/admin.js"></script>
</head>

<?php
	echo tng_adminlayout(" onload=\"generateID('family',document.form1.familyID,document.form1.tree1);\"");

	$familytabs[0] = array(1,"admin_families.php",$admtext['search'],"findfamily");
	$familytabs[1] = array($allow_add,"admin_newfamily.php",$admtext['addnew'],"addfamily");
	$familytabs[2] = array($allow_edit,"admin_findreview.php?type=F",$admtext['review'] . $revstar,"review");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/families_help.php#add');\" class=\"lightlink\">{$admtext['help']}</a>";
	$innermenu .= " &nbsp;|&nbsp; <a href=\"#\" class=\"lightlink\" onClick=\"return toggleAll('on');\">{$text['expandall']}</a> &nbsp;|&nbsp; <a href=\"#\" class=\"lightlink\" onClick=\"return toggleAll('off');\">{$text['collapseall']}</a>";
	$menu = doMenu($familytabs,"addfamily",$innermenu);
	echo displayHeadline($admtext['families'] . " &gt;&gt; " . $admtext['addnewfamily'], "img/families_icon.gif",$menu,$message);
?>

<div class="admin-main">
<form action="admin_addfamily.php" method="post" name="form1" onSubmit="return validateFamily(this);" >
<input type="hidden" name="lastperson" value="<?php echo (isset($child) ? $child : ""); ?>">
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="adm-rounded-table">
<tr>
<td class="tngshadow databack">
	<table class="normal">
	<tr>
		<td><span class="normal"><?php echo $admtext['tree']; ?>:</span></td>
		<td>
			<select name="tree1" id="gedcom" onChange="<?php echo $swapbranches; ?> generateID('family',document.form1.familyID,document.form1.tree1);tree=this.options[this.selectedIndex].value;">
<?php
while( $row = tng_fetch_assoc($result) ) {
	echo "		<option value=\"{$row['gedcom']}\"";
	if( $firsttree == $row['gedcom'] ) echo " selected";
	echo ">{$row['treename']}</option>\n";
}
?>
			</select> 
		</td>
	</tr>
	<tr>
		<td><span class="normal"><?php echo $admtext['branch']; ?>:</span></td>
		<td style="height:2em">
<?php
	$query = "SELECT branch, description FROM $branches_table WHERE gedcom = \"$firsttree\" ORDER BY description";
	$branchresult = tng_query($query);
	$numbranches = tng_num_rows($branchresult);

	$descriptions = array();
	$assdesc = "";
	$options = "";
	while( $branchrow = tng_fetch_assoc($branchresult) ) {
		$options .= "	<option value=\"{$branchrow['branch']}\">{$branchrow['description']}</option>\n";
		if($branchrow['branch'] == $assignedbranch) $assdesc = $branchrow['description'];
	}
	echo "<span id=\"branchlist\"></span>";
	if( !$assignedbranch ) {
		$select = $numbranches > 8 ? $admtext['scrollbranch'] . "<br/>" : "";
		$select .= "<select name=\"branch[]\" id=\"branch\" multiple size=\"8\">\n";
		$select .= "	<option value=\"\" selected>{$admtext['nobranch']}</option>\n";

		$select .= "$options</select>\n";
		echo " &nbsp;<span class=\"nw\">(<a href=\"#\" onclick=\"showEdit('branchedit'); quitEdit('branchedit'); return false;\"><img src=\"img/ArrowDown.gif\" border=\"0\" style=\"margin-left:-4px;margin-right:-2px\">" . $admtext['edit'] . "</a> )</span><br />";
?>
		<div id="branchedit" class="lightback pad5" style="position:absolute;display:none;" onmouseover="clearTimeout(dtimer);" onmouseout="closeEdit('branch','branchedit','branchlist');">
<?php
		echo $select;
		echo "</div>\n";
	}
	else
		echo "<input type=\"hidden\" name=\"branch\" value=\"$assignedbranch\">$assdesc ($assignedbranch)";
?>
		</td>
	</tr>
	<tr>
		<td><span class="normal"><?php echo $admtext['familyid']; ?>:</span></td>
		<td>
			<input type="text" name="familyID" value="<?php echo (isset($newID) ? $newID : ""); ?>" size="10" onBlur="this.value=this.value.toUpperCase()">
			<input type="button" value="<?php echo $admtext['generate']; ?>" onClick="generateID('family',document.form1.familyID,document.form1.tree1);">
			<input type="button" name="lock" value="<?php echo $admtext['lockid']; ?>" onClick="document.form1.newfamily[0].checked = true;">
			<input type="button" value="<?php echo $admtext['check']; ?>" onClick="checkID(document.form1.familyID.value,'family','checkmsg',document.form1.tree1);">
			<span id="checkmsg" class="normal"></span>
		</td>
	</tr>
</table>
</td>
</tr>
<tr>
<td class="tngshadow databack">
	<?php echo displayToggle("plus0",1,"spouses",$admtext['spouses'],""); ?>

	<div id="spouses">
	<table class="normal topmarginsmall">
	<tr><td><span class="normal"><?php echo $admtext['husband']; ?>:</span></td><td><input type="text" readonly="readonly" name="husbnameplusid" id="husbnameplusid" size="40" value="<?php echo "$husbstr"; ?>">
		<input type="hidden" name="husband" id="husband" value="<?php echo (isset($husband) ? $husband : ""); ?>">
		<input type="button" value="<?php echo $admtext['find']; ?>" onclick="return findItem('I','husband','husbnameplusid',document.form1.tree1.options[document.form1.tree1.selectedIndex].value,'<?php echo $assignedbranch; ?>');">
		<input type="button" value="<?php echo $admtext['create']; ?>" onclick="return openCreatePersonForm('husband','husbnameplusid','spouse','M');">
		<input type="button" value="  <?php echo $admtext['edit']; ?>  " onclick="EditSpouse(document.form1.husband);">
		<input type="button" value="<?php echo $admtext['remove']; ?>" onclick="RemoveSpouse(document.form1.husband,document.form1.husbnameplusid);">
	</td></tr>
	<tr><td><span class="normal"><?php echo $admtext['wife']; ?>:</span></td><td><input type="text" readonly readonly="readonly" name="wifenameplusid" id="wifenameplusid" size="40" value="<?php echo "$wifestr"; ?>">
		<input type="hidden" name="wife" id="wife" value="<?php echo (isset($wife) ? $wife : ""); ?>">
		<input type="button" value="<?php echo $admtext['find']; ?>" onclick="return findItem('I','wife','wifenameplusid',document.form1.tree1.options[document.form1.tree1.selectedIndex].value,'<?php echo $assignedbranch; ?>');">
		<input type="button" value="<?php echo $admtext['create']; ?>" onclick="return openCreatePersonForm('wife','wifenameplusid','spouse','F');">
		<input type="button" value="  <?php echo $admtext['edit']; ?>  " onclick="EditSpouse(document.form1.wife);">
		<input type="button" value="<?php echo $admtext['remove']; ?>" onclick="RemoveSpouse(document.form1.wife,document.form1.wifenameplusid);">
	</td></tr>
	</table>

	<table class="normal topbuffer">
		<tr>
			<td class="nw">
				<input type="checkbox" name="living" value="1"<?php if(!$tngconfig['livingunchecked']) { echo " checked=\"checked\""; } ?>> <?php echo $admtext['living']; ?>&nbsp;&nbsp;
				<input type="checkbox" name="private" value="1"> <?php echo $admtext['text_private']; ?>
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
<tr>
<td class="tngshadow databack">
	<p class="normal"><strong><?php echo $admtext['fevslater']; ?></strong></p>
	<input type="hidden" value="<?php echo (isset($cw) ? $cw : ""); /*stands for "close window" */ ?>" name="cw">
	<input type="submit" class="btn" name="save" accesskey="s" value="<?php echo $admtext['savecont']; ?>">
	<input type="button" name="cancel" class="btn" value="<?php echo $text['cancel']; ?>" onClick="window.location.href='admin_families.php';">
</td>
</tr>

</table>
</form>
</div>

<script type="text/javascript">
<?php
	echo $swapbranches;
	echo "tree = \"$firsttree\";\n";	
?>
</script>
</body>
</html>