<?php
include("begin.php");
include("adminlib.php");
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = true;
include("checklogin.php");

if( !$allow_delete ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");
require("deletelib.php");

function getID($fields,$table,$id) {
	$query = "SELECT $fields FROM $table WHERE ID = \"$id\"";
	$result = @tng_query($query);
	$row = tng_fetch_assoc( $result );
	tng_free_result( $result );
	return $row;
}

if( !empty($xsrcaction) ) {
	$query = "DELETE FROM $sources_table WHERE 1=0";
	$modmsg = "sources";
	$id = "ID";
	$location = "admin_sources.php";
}
elseif( !empty($xrepoaction) ) {
	$query = "DELETE FROM $repositories_table WHERE 1=0";
	$modmsg = "repositories";
	$id = "ID";
	$location = "admin_repositories.php";
}
elseif( !empty($xperaction) ) {
	$query = "DELETE FROM $people_table WHERE 1=0";
	$modmsg = "people";
	$id = "ID";
	$location = "admin_people.php";
}
elseif( !empty($xfamaction) ) {
	$query = "DELETE FROM $families_table WHERE 1=0";
	$modmsg = "families";
	$id = "ID";
	$location = "admin_families.php";
}
elseif( !empty($xplacaction) ) {
	$query = "DELETE FROM $places_table WHERE 1=0";
	$modmsg = "places";
	$id = "ID";
	$location = "admin_places.php";
}
elseif( !empty($xtimeaction) ) {
	$query = "DELETE FROM $tlevents_table WHERE 1=0";
	$modmsg = "tlevents";
	$id = "tleventID";
	$location = "admin_timelineevents.php";
}
elseif( !empty($xuseraction) ) {
	$query = "DELETE FROM $users_table WHERE 1=0";
	$modmsg = "users";
	$id = "userID";
	$location = "admin_users.php";
}
elseif( !empty($xbranchaction) ) {
	$query = "DELETE FROM $branches_table WHERE 1=0";
	$modmsg = "branches";
	$id = "branch";
	$location = "admin_branches.php";
}
elseif( !empty($xtreeaction) ) {
	$query = "DELETE FROM $trees_table WHERE 1=0";
	$modmsg = "trees";
	$id = "gedcom";
	$location = "admin_trees.php";
}
elseif( !empty($xruseraction) ) {
	$query = "DELETE FROM $users_table WHERE 1=0";
	$modmsg = "users";
	$id = "userID";
	$location = "admin_reviewusers.php";
}
elseif( !empty($xcemaction) ) {
	$query = "DELETE FROM $cemeteries_table WHERE 1=0";
	$modmsg = "cemeteries";
	$id = "cemeteryID";
	$location = "admin_cemeteries.php";
}
elseif( !empty($xnoteaction) ) {
	$query = "DELETE FROM $xnotes_table WHERE 1=0";
	$modmsg = "notes";
	$id = "ID";
	$location = "admin_notelist.php";
}

$modifymsg = $admtext[$modmsg];
$count = 0;
$items = array();
foreach( array_keys($_POST) as $key ) {
	if( substr( $key, 0, 3 ) == "del" ) {
		$count++;
		$thisid = substr( $key, 3 );
		$query .= " OR $id =\"$thisid\"";

		$itemID = "";
		$tree = "";
		if( !empty($xperaction) ) {
			$row = getID("personID, gedcom, branch, sex",$people_table,$thisid);
			$personID = $row['personID'];
			$tree = $row['gedcom'];
			$items[] = $row['gedcom'] . "/" . $row['personID'];

			deletePersonPlus($personID,$tree,$row['sex']);
		}
		elseif( !empty($xfamaction) ) {
			$row = getID("familyID, branch, gedcom",$families_table,$thisid);
			$familyID = $row['familyID'];
			$tree = $row['gedcom'];
			$items[] = $row['gedcom'] . "/" . $row['familyID'];

			$fquery = "DELETE FROM $children_table WHERE familyID=\"$familyID\" AND gedcom = \"$tree\"";
			$result = @tng_query($fquery);

			$pquery = "UPDATE $people_table SET famc=\"\" WHERE gedcom = \"$tree\" AND famc=\"$familyID\"";
			$result = tng_query($pquery);

			updateHasKidsFamily($familyID);

			deleteEvents($familyID,$tree);
			deleteCitations($familyID,$tree);
			deleteNoteLinks($familyID,$tree);
			deleteBranchLinks($familyID,$tree);
			deleteMediaLinks($familyID,$tree);
			deleteAlbumLinks($familyID,$tree);
		}
		elseif( !empty($xsrcaction) ) {
			$row = getID("sourceID, gedcom",$sources_table,$thisid);
			$sourceID = $row['sourceID'];
			$tree = $row['gedcom'];
			$items[] = $row['gedcom'] . "/" . $row['sourceID'];

			$squery = "DELETE FROM $citations_table WHERE sourceID=\"$sourceID\" AND gedcom = \"$tree\"";
			$result = @tng_query($squery);

			deleteEvents($sourceID,$tree);
			deleteCitations($sourceID,$tree);
			deleteNoteLinks($sourceID,$tree);
			deleteMediaLinks($sourceID,$tree);
			deleteAlbumLinks($sourceID,$tree);
		}
		elseif( !empty($xrepoaction) ) {
			$row = getID("repoID, gedcom",$repositories_table,$thisid);
			$repoID = $row['repoID'];
			$tree = $row['gedcom'];
			$items[] = $row['gedcom'] . "/" . $row['repoID'];

			$rquery = "SELECT addressID FROM $repositories_table WHERE repoID=\"$repoID\"";
			$result = @tng_query($rquery);
			$row = tng_fetch_assoc( $result );
			tng_free_result($result);

			$rquery = "DELETE FROM $address_table WHERE addressID=\"{$row['addressID']}\"";
			$result = @tng_query($rquery);

			$rquery = "UPDATE $sources_table SET repoID = \"\" WHERE repoID=\"$repoID\" AND gedcom = \"$tree\"";
			$result = @tng_query($rquery);

			deleteEvents($repoID,$tree);
			deleteNoteLinks($repoID,$tree);
			deleteMediaLinks($repoID,$tree);
			deleteAlbumLinks($repoID,$tree);
		}
		elseif( !empty($xplacaction) ) {
			$row = getID("place, gedcom",$places_table,$thisid);
			$place = $row['place'];
			$tree = $row['gedcom'];
			$items[] = $row['gedcom'] . "/" . $row['place'];

			deleteMediaLinks($place,$tree);
			deleteAlbumLinks($place,$tree);
		}
		elseif( !empty($xtimeaction) ) {
			$query3 = "DELETE FROM $tlevents_table WHERE tleventID = \"$thisid\"";
			$result3 = tng_query($query3) or die ($admtext['cannotexecutequery'] . ": $query3");
			$items[] = $thisid;
		}
		elseif( !empty($xtreeaction) ) {
			include("micro_deletetrees.php");
			$items[] = $thisid;
		}
		elseif( !empty($xuseraction) || !empty($xruseraction) ) {
			$query3 = "SELECT username FROM $users_table WHERE userID = \"$thisid\"";
			$result3 = @tng_query($query3);
			$urow = tng_fetch_assoc( $result3 );
			tng_free_result($result3);

			$query3 = "DELETE FROM $users_table WHERE userID = \"$thisid\"";
			$result3 = tng_query($query3) or die ($admtext['cannotexecutequery'] . ": $query3");
			$items[] = $urow['username'];
		}
		elseif( !empty($xbranchaction) ) {
			$args = explode('&',$thisid);
			$branch = $args[0];
			$tree = $args[1];
			$items[] = $tree . "/" . $branch;
			require("branchlib.php");
		}
		elseif( !empty($xcemaction) ) {
			$query3 = "SELECT cemname FROM $cemeteries_table WHERE cemeteryID = \"$thisid\"";
			$result3 = @tng_query($query3);
			$crow = tng_fetch_assoc( $result3 );
			tng_free_result($result3);
			//if( $crow['maplink'] && file_exists( "$rootpath$headstonepath/$crow[maplink]" ) )
				//unlink( "$rootpath$headstonepath/$crow[maplink]" );
			$items[] = $crow['cemname'];
		}
		elseif( !empty($xnoteaction) ) {
			$nquery = "DELETE FROM $notelinks_table WHERE xnoteID=\"$thisid\"";
			$result = @tng_query($nquery);
			$items[] = $thisid;
		}
	}
}
$result = tng_query($query);

adminwritelog( "{$admtext['deleted']}: " . $modifymsg . " " . implode(', ', $items ));

if( $count )
	$message = $admtext['allitemsdeleted'];
else
	$message = $admtext['nochanges'];
header( "Location: $location" . "?message=" . urlencode($message) );
?>