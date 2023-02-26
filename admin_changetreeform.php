<?php
include("begin.php");
include("adminlib.php");
$textpart = "trees";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

//permissions
if( $assignedtree || !$allow_edit ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

switch($entity) {
	case "person":
		$IDlabel = $admtext['personid'];
		break;
	//case "place":
	//	maybe later
	//	break;
	case "source":
		$IDlabel = $admtext['sourceid'];
		break;
	case "repo":
		$IDlabel = $admtext['repoid'];
		break;
}
//use passed in type, gedcom & id to get name
//get list of trees, omit current tree from list in dropdown
$treelist = "		<option value=\"\"></option>\n";
$currenttree = "";

$query = "SELECT gedcom, treename FROM $trees_table ORDER BY treename";
$result = tng_query($query);

while( $row = tng_fetch_assoc($result) ) {
	if($row['gedcom'] != $oldtree)
		$treelist .= "		<option value=\"{$row['gedcom']}\">{$row['treename']}</option>\n";
	else
		$currenttree = $row['treename'];
}

header("Content-type:text/html; charset=" . $session_charset);
?>

<div class="databack ajaxwindow" id="changetree">
<p class="subhead"><strong><?php echo $admtext['changetree']; ?></strong>
<form action="admin_changetree.php" name="changetree" id="changetree" onsubmit="return onChangeTree(this);">
<table border="0" cellpadding="2" class="normal">
	<tr>
		<td><?php echo $admtext['currtree']; ?>:</td><td><?php echo $currenttree; ?></td>
	<tr>
		<td><?php echo $admtext['newtree']; ?>:</td>
		<td>
			<select name="newtree" onchange="if(document.changetree.newtree.selectedIndex > 0) generateID('<?php echo $entity; ?>',document.changetree.newID,document.changetree.newtree);">
<?php
			echo $treelist;
?>
			</select> 
		</td>
	</tr>
	<tr>
		<td><?php echo $IDlabel; ?>:</td>
		<td>
			<input type="text" name="newID" id="newID" size="10" onblur="this.value=this.value.toUpperCase()"/>
			<input type="button" value="<?php echo $admtext['generate']; ?>" onclick="if(document.changetree.newtree.selectedIndex > 0) generateID('person',document.changetree.newID,document.changetree.newtree);">
			<input type="button" value="<?php echo $admtext['check']; ?>" onclick="if(document.changetree.newtree.selectedIndex > 0) checkID(document.changetree.newID.value,'person','checkmsg',document.changetree.newtree);">

		</td>
	</tr>
	<tr>
		<td></td><td><input type="radio" name="operation" value="0" checked/> <?php echo $admtext['move']; ?> &nbsp; <input type="radio" name="operation" value="1"/> <?php echo $admtext['copy']; ?></td>
	</tr>
	<tr>
		<td colspan="2"><span id="checkmsg" class="normal"></span></td>
	</tr>
</tr>
</table>
<p><em>
<?php
	echo $admtext['chwarn'];
?>
</em></p>
<input type="hidden" name="entity" value="<?php echo $entity; ?>"/>
<input type="hidden" name="oldtree" value="<?php echo $oldtree; ?>"/>
<input type="hidden" name="entityID" value="<?php echo $entityID; ?>"/>
<input type="submit" name="submit" value="<?php echo $admtext['save']; ?>">
<input type="button" name="cancel" value="<?php echo $text['cancel']; ?>" onclick="tnglitbox.remove();">
</form>
</div>