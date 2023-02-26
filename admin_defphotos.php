<?php
include("begin.php");
include("adminlib.php");
$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

require("adminlog.php");

if( !$allow_media_edit ) {
	echo $admtext['norights'];
	exit;
}

$query = "SELECT DISTINCT personID FROM $medialinks_table WHERE linktype != 'C' and linktype != '' and gedcom='$tree'";
$result = tng_query($query);

$defsdone = 0;
while( $distinctplink = tng_fetch_assoc($result) ) {
	//must have a thumbnail
	$query2 = "SELECT medialinkID FROM ($medialinks_table, $media_table) WHERE $medialinks_table.mediaID = $media_table.mediaID AND $medialinks_table.gedcom=\"$tree\" AND personID = \"{$distinctplink['personID']}\" AND thumbpath != \"\" ORDER BY ordernum";
	$result2 = tng_query($query2) or die ($admtext['cannotexecutequery'] . ": $query2");

	$defsexist = 0;
	if( !$overwritedefs ) {
		$query3 = "SELECT count(medialinkID) as pcount FROM $medialinks_table WHERE gedcom=\"$tree\" AND personID = \"{$distinctplink['personID']}\" AND defphoto = '1'";
		$result3 = tng_query($query3) or die ($admtext['cannotexecutequery'] . ": $query3");
		$pcountrow = tng_fetch_assoc($result3);
		if( $pcountrow['pcount'] )
			$defsexist = 1;
		else {
			$oldstylephoto = $tree ? "$rootpath$photopath/$tree.{$distinctplink['personID']}.$photosext" : "$rootpath$photopath/{$distinctplink['personID']}.$photosext";
			if( file_exists( $oldstylephoto ) )
				$defsexist = 1;
		}
		tng_free_result( $result3 );
	}
	if( $overwritedefs || !$defsexist ) {
		$count = 0;
		while( $ulink = tng_fetch_assoc($result2) ) {
			if( !$count ) {
				$query4 = "UPDATE $medialinks_table SET defphoto = '1' WHERE medialinkID='{$ulink['medialinkID']}'";
				$result4 = tng_query($query4) or die ($admtext['cannotexecutequery'] . ": $query4");
			}
			else {
				$query4 = "UPDATE $medialinks_table SET defphoto = '0' WHERE medialinkID='{$ulink['medialinkID']}'";
				$result4 = tng_query($query4) or die ($admtext['cannotexecutequery'] . ": $query4");
			}
			$count++;
			$defsdone++;
		}
	}
}
tng_free_result( $result );

adminwritelog( $admtext['assigndefs'] . ": {$admtext['defsassigned']}: $defsdone;" );

echo "<p><strong>{$admtext['defsassigned']}:</strong> $defsdone</p>";
?>
