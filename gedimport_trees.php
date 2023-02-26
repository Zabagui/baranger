<?php
function ClearData( $tree ) {
	global $people_table, $families_table, $children_table, $sources_table, $events_table, $repositories_table, $trees_table;
	global $notelinks_table, $xnotes_table, $citations_table, $places_table, $address_table, $medialinks_table, $assoc_table, $admtext;

	$clear_files = array(
		$address_table,
		$assoc_table,
		$children_table,
		$citations_table,
		//$events_table,
		$families_table,
		$notelinks_table,
		$people_table,
		$repositories_table,
		$sources_table,
		$xnotes_table
	);

	$query = "SELECT COUNT(*) as trees FROM $trees_table";
	if ( !($result = tng_query($query)) )
		die ($admtext['cannotexecutequery'] . ": $query");

	$row = tng_fetch_assoc( $result );
	$tree_cnt = $row['trees'];

//	print "<br />Database contains $tree_cnt Tree" . ( ( $tree_cnt >= 2 ) ? "s" : "" ) . "<br />";

	for ($i = 0; $i < sizeof($clear_files); $i++) {
		$query = ( ( $tree_cnt >= 2 ) ? "DELETE FROM " : "TRUNCATE " ) . $clear_files[$i];
		$query .= ( ( $tree_cnt >= 2 ) ? " WHERE gedcom = \"$tree\"" : "");

// print "File($i) = $clear_files[$i]<br  />";
// print "Query: " . $query . "<br />";

		if ( !($result = tng_query($query)) )
			die ($admtext['cannotexecutequery'] . ": $query");
	} // End for

	//we won't be able to match media links for custom events, since the custom event IDs will be renumbered, so delete the media links and start again
	//$query = "DELETE from $medialinks_table WHERE gedcom = \"$tree\" AND eventID != '' AND eventID REGEXP ('['0-9']')";
	//$result = tng_query($query);

	//we won't be able to match media links for citations, since the citation IDs will be renumbered, so delete the media links and start again
	//moved the ID to personID, so this can't be used
	$query = "DELETE from $medialinks_table WHERE gedcom = \"$tree\" AND (linktype = '' OR linktype = 'C')";
	$result = tng_query($query);

	$query = "DELETE from $events_table WHERE gedcom = \"$tree\" AND persfamID != \"XXX\"";
	$result = tng_query($query);

	$query = "DELETE from $places_table WHERE gedcom = \"$tree\" AND (latitude is null OR latitude = \"\") AND (longitude is null OR longitude = \"\") AND (notes is null OR notes = \"\")";
	$result = tng_query($query);
}
?>
