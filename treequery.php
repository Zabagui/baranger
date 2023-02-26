<?php
	$treequery = "SELECT gedcom, treename FROM $trees_table $wherestr ORDER BY treename";
	$treeresult = tng_query($treequery);
	$numtrees = tng_num_rows($treeresult);
	if($numtrees > 1) {
		echo "<select name=\"tree\" id=\"treequeryselect\">\n";
		if( !$assignedtree )
			echo "	<option value=\"\">{$admtext['alltrees']}</option>\n";
		while( $treerow = tng_fetch_assoc($treeresult) ) {
			echo "	<option value=\"{$treerow['gedcom']}\"";
			if( $treerow['gedcom'] == $tree ) echo " selected";
			echo ">{$treerow['treename']}</option>\n";
		}
		echo "</select>\n";
	}
	else {
		//$treerow = tng_fetch_assoc($treeresult);
		echo "<input type=\"hidden\" name=\"tree\" value=\"$assignedtree\">\n";
	}
	tng_free_result($treeresult);
?>
