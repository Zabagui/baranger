<?php
	echo "var branchids = new Array();\n";
	echo "branchids['none'] = new Array(\"\");\n";
	echo "var branchnames = new Array();\n";
	echo "branchnames['none'] = new Array(\"{$admtext['allbranches']}\");\n";
	echo "var nobranchmsg = \"{$admtext['nobranch']}\";\n";
	$swapbranches = "swapBranches(document.form1);\n";
	$dispid = "";
	$dispname = "";
	
	if( !isset($wherestr) ) $wherestr = "";
	$query = "SELECT gedcom, treename FROM $trees_table $wherestr ORDER BY treename";
	$treeresult = tng_query($query);
	while( $treerow = tng_fetch_assoc( $treeresult ) ) {
		$nexttree = addslashes($treerow['gedcom']);
		$dispid .= "branchids['$nexttree'] = new Array(\"\"";
		$dispname .= "branchnames['$nexttree'] = new Array(\"{$admtext['allbranches']}\"";

		$query = "SELECT branch, gedcom, description FROM $branches_table WHERE gedcom = \"$nexttree\" ORDER BY description";
		$branchresult = tng_query($query);

		while( $branchrec = tng_fetch_assoc( $branchresult ) ) {
			$dispid .= ",\"{$branchrec['branch']}\"";
			$dispname .= ",\"" . addslashes(trim($branchrec['description'])) . "\"";
		}
		tng_free_result( $branchresult );
		$dispid .= ");\n";
		$dispname .= ");\n";
	}
	tng_free_result( $treeresult );
	echo $dispid;
	echo $dispname;
?>
function swapBranches(formName) {
	if(jQuery('#treeselect').length)
		treeselect = jQuery('#treeselect');
	else
		treeselect = jQuery('#gedcom');
	var tree = treeselect.val();
	if(tree == "-x--all--x-" || tree == "")
		tree = "none";
	var len = 0;
	formName.branch.options.length = 0;
	if(jQuery('#branchlist').length)
		jQuery('#branchlist').html('');

	for( var i = 0; i < branchids[tree].length; i++ ) {
		var newElem = document.createElement("OPTION");
		len = len + 1;
		if(tree == "none") {
			newElem.text = "";
			newElem.value = "";
			newElem.selected = true;
			formName.branch.options.add(newElem);
			var newElem = document.createElement("OPTION");
			newElem.text = nobranchmsg;
			newElem.value = "";
			formName.branch.options.add(newElem);
		}
		else {
			newElem.text = branchnames[tree][i];
			newElem.value = branchids[tree][i];
			if( !i ) newElem.selected = true;
			formName.branch.options.add(newElem);
		}
	}
	if(len > 1) {
		var newElem = document.createElement("OPTION");
		newElem.text = nobranchmsg;
		newElem.value = "-1";
		formName.branch.options.add(newElem);
	}
}