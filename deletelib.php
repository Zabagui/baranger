<?php
function deleteNoteLinks($id,$tree) {
	global $notelinks_table;

	$query = "SELECT ID FROM $notelinks_table WHERE persfamID=\"$id\" AND gedcom = \"$tree\"";
	$nresult = @tng_query($query);
	
	while( $nrow = tng_fetch_assoc( $nresult ) )
	deleteNote($nrow['ID'], 0);
	tng_free_result( $nresult );
	
	$query = "DELETE FROM $notelinks_table WHERE persfamID=\"$id\" AND gedcom = \"$tree\"";
	$result = @tng_query($query);
}

function deleteBranchLinks($id,$tree) {
	global $branchlinks_table;
	
	$query = "DELETE FROM $branchlinks_table WHERE persfamID = \"$id\" AND gedcom = \"$tree\"";
	$result = @tng_query($query);
}

function deleteMediaLinks($id,$tree) {
	global $medialinks_table;
	
	$id = addslashes($id);
	$query = "DELETE FROM $medialinks_table WHERE personID = \"$id\" AND gedcom = \"$tree\"";
	$result = @tng_query($query);
}

function deleteAlbumLinks($id,$tree) {
	global $album2entities_table;
	
	$id = addslashes($id);
	$query = "DELETE FROM $album2entities_table WHERE entityID = \"$id\" AND gedcom = \"$tree\"";
	$result = @tng_query($query);
}

function deleteEvents($id,$tree) {
	global $events_table;
	
	$query = "DELETE FROM $events_table WHERE persfamID=\"$id\" AND gedcom = \"$tree\"";
	$result = @tng_query($query);
}

function deleteCitations($id,$tree) {
	global $citations_table;
	
	$query = "DELETE FROM $citations_table WHERE persfamID=\"$id\" AND gedcom = \"$tree\"";
	$result = @tng_query($query);
}

function deleteChildren($id,$tree) {
	global $children_table;
	
	$query = "DELETE FROM $children_table WHERE familyID=\"$id\" AND gedcom = \"$tree\"";
	$result = @tng_query($query);
}

function deleteAssociations($id,$tree) {
	global $assoc_table;
	
	$query = "DELETE FROM $assoc_table WHERE personID=\"$id\" OR passocID=\"$id\" AND gedcom = \"$tree\"";
	$result = @tng_query($query);
}

function deletePersonPlus($personID,$tree,$gender) {
	global $children_table, $families_table;
	
	$query = "DELETE FROM $children_table WHERE personID=\"$personID\" AND gedcom = \"$tree\"";
	$result = @tng_query($query);

	deleteEvents($personID,$tree);
	deleteCitations($personID,$tree);
	deleteNoteLinks($personID,$tree);
	deleteBranchLinks($personID,$tree);
	deleteAssociations($personID,$tree);

	if( $gender == "M" )
		$query = "SELECT familyID FROM $families_table WHERE husband = \"$personID\" AND gedcom = \"$tree\"";
	else if( $gender == "F" )
		$query = "SELECT familyID FROM $families_table WHERE wife = \"$personID\" AND gedcom = \"$tree\"";
	else
		$query = "SELECT familyID FROM $families_table WHERE gedcom = \"$tree\" AND (husband = \"$personID\" OR wife = \"$personID\")";

	$result = @tng_query($query);
	while($frow = tng_fetch_assoc($result))
		updateHasKidsFamily($frow['familyID']);
	tng_free_result($result);

	$query = "UPDATE $families_table SET husband=\"\", husborder=\"\" WHERE husband=\"$personID\" AND gedcom = \"$tree\"";
	$result = @tng_query($query);

	$query = "UPDATE $families_table SET wife=\"\", wifeorder=\"\" WHERE wife=\"$personID\" AND gedcom = \"$tree\"";
	$result = @tng_query($query);

	deleteMediaLinks($personID,$tree);
	deleteAlbumLinks($personID,$tree);
}

function updateHasKids($spouseID,$spousestr) {
	global $families_table, $children_table, $tree;

	$query = "SELECT familyID FROM $families_table WHERE $spousestr = \"$spouseID\" AND gedcom = \"$tree\"";
	$result = @tng_query($query);
	$numkids = 0;
	while(!$numkids && $row = tng_fetch_assoc( $result )) {
		$query = "SELECT count(ID) as ccount FROM $children_table WHERE familyID = \"{$row['familyID']}\" AND gedcom=\"$tree\"";
		$result2 = @tng_query($query);
		$crow = tng_fetch_assoc( $result2 );
		$numkids = $crow['ccount'];
		tng_free_result($result2);
	}
	tng_free_result( $result );
	if(!$numkids) {
		$query = "UPDATE $children_table SET haskids=\"0\" WHERE personID=\"$spouseID\" AND gedcom=\"$tree\"";
		$result = @tng_query($query);
	}
}

function updateHasKidsFamily($familyID){
	global $families_table, $tree;

	$query = "SELECT husband, wife FROM $families_table WHERE familyID=\"$familyID\" AND gedcom=\"$tree\"";
	$result = @tng_query($query);
	$famrow = tng_fetch_assoc($result);
	tng_free_result($result);
	if(!empty($famrow['husband']))
		updateHasKids($famrow['husband'],'husband');
	if(!empty($famrow['wife']))
		updateHasKids($famrow['wife'],'wife');
}
?>
