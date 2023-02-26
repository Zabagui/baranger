<?php
	$tquery = "DELETE from $people_table WHERE gedcom = \"$thisid\"";
	$result = @tng_query($tquery);

	$tquery = "DELETE from $families_table WHERE gedcom = \"$thisid\"";
	$result = @tng_query($tquery);

	$tquery = "DELETE from $children_table WHERE gedcom = \"$thisid\"";
	$result = @tng_query($tquery);

	$tquery = "DELETE from $sources_table WHERE gedcom = \"$thisid\"";
	$result = @tng_query($tquery);

	$tquery = "DELETE from $repositories_table WHERE gedcom = \"$thisid\"";
	$result = @tng_query($tquery);

	$tquery = "DELETE from $events_table WHERE gedcom = \"$thisid\"";
	$result = @tng_query($tquery);

	$tquery = "DELETE from $notelinks_table WHERE gedcom = \"$thisid\"";
	$result = @tng_query($tquery);

	$tquery = "DELETE from $xnotes_table WHERE gedcom = \"$thisid\"";
	$result = @tng_query($tquery);

	$tquery = "DELETE from $citations_table WHERE gedcom = \"$thisid\"";
	$result = @tng_query($tquery);

	$tquery = "DELETE from $places_table WHERE gedcom = \"$thisid\"";
	$result = @tng_query($tquery);

	$tquery = "DELETE from $assoc_table WHERE gedcom = \"$thisid\"";
	$result = @tng_query($tquery);

	$tquery = "DELETE from $address_table WHERE gedcom = \"$thisid\"";
	$result = @tng_query($tquery);

	if( $thisid ) {
		$tquery = "SELECT mediaID from $media_table WHERE gedcom = \"$thisid\"";
		$result = @tng_query($tquery);
		while($row = tng_fetch_assoc($result)) {
			$delquery = "DELETE FROM $albumlinks_table WHERE mediaID=\"{$row['mediaID']}\"";
			$delresult = @tng_query($delquery);
		}
		tng_free_result($result);

		$tquery = "DELETE from $media_table WHERE gedcom = \"$thisid\"";
		$result = @tng_query($tquery);

		$tquery = "DELETE from $medialinks_table WHERE gedcom = \"$thisid\"";
		$result = @tng_query($tquery);
	}

	$tquery = "DELETE from $branches_table WHERE gedcom = \"$thisid\"";
	$result = @tng_query($tquery);

	$tquery = "DELETE from $branchlinks_table WHERE gedcom = \"$thisid\"";
	$result = @tng_query($tquery);

	$tquery = "UPDATE $users_table SET allow_living=\"-1\" WHERE gedcom = \"$thisid\" AND username != \"$currentuser\"";
	$result = @tng_query($tquery);
?>