<?php
	$query = "DELETE from $people_table WHERE gedcom = \"$tree\"";
	$result = tng_query($query);

	$query = "DELETE from $families_table WHERE gedcom = \"$tree\"";
	$result = tng_query($query);

	$query = "DELETE from $children_table WHERE gedcom = \"$tree\"";
	$result = tng_query($query);

	$query = "DELETE from $assoc_table WHERE gedcom = \"$tree\"";
	$result = tng_query($query);

	$query = "DELETE from $address_table WHERE gedcom = \"$tree\"";
	$result = tng_query($query);

	$query = "DELETE from $sources_table WHERE gedcom = \"$tree\"";
	$result = tng_query($query);

	$query = "DELETE from $repositories_table WHERE gedcom = \"$tree\"";
	$result = tng_query($query);

	$query = "DELETE from $events_table WHERE gedcom = \"$tree\"";
	$result = tng_query($query);

	$query = "DELETE from $notelinks_table WHERE gedcom = \"$tree\"";
	$result = tng_query($query);

	$query = "DELETE from $xnotes_table WHERE gedcom = \"$tree\"";
	$result = tng_query($query);

	$query = "DELETE from $citations_table WHERE gedcom = \"$tree\"";
	$result = tng_query($query);

	$query = "DELETE from $places_table WHERE gedcom = \"$tree\"";
	$result = tng_query($query);

	if( $tree ) {
		$query = "SELECT mediaID from $media_table WHERE gedcom = \"$tree\"";
		$result = tng_query($query);
		while($row = tng_fetch_assoc($result)) {
			$delquery = "DELETE FROM $albumlinks_table WHERE mediaID=\"{$row['mediaID']}\"";
			$delresult = tng_query($delquery) or die ($admtext['cannotexecutequery'] . ": $delquery");
		}
		tng_free_result($result);

		$query = "DELETE from $media_table WHERE gedcom = \"$tree\"";
		$result = tng_query($query);

		$query = "DELETE from $medialinks_table WHERE gedcom = \"$tree\"";
		$result = tng_query($query);
	}

	if(!isset($branch)) $branch = "";
	$query = "UPDATE $people_table SET branch=\"\" WHERE gedcom=\"$tree\" AND branch = \"$branch\"";
	$result = tng_query($query);

	$query = "UPDATE $families_table SET branch=\"\" WHERE gedcom=\"$tree\" AND branch = \"$branch\"";
	$result = tng_query($query);

	$query = "DELETE from $branchlinks_table WHERE branch = \"$branch\" AND gedcom = \"$tree\"";
	$result = tng_query($query);
?>
