<?php
include("begin.php");
include("adminlib.php");
$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_edit || !$allow_delete ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

require("adminlog.php");
require("medialib.php");

$count = 0;

initMediaTypes();

$xphaction = stripslashes($xphaction);
if( $xphaction == $admtext['convto'] ) {
	//loop through each one
	foreach( array_keys($_POST) as $key ) {
		if( substr( $key, 0, 2 ) == "ph" ) {
			$count++;
			$mediaID = substr( $key, 2 );
			
			$query = "SELECT mediatypeID, usecollfolder, path, thumbpath, gedcom FROM $media_table WHERE mediaID = \"$mediaID\"";
			$result = tng_query($query);
			$row = tng_fetch_assoc( $result );
			tng_free_result( $result );
			
			//get current media type
			$oldmediatype = $row['mediatypeID'];
			
			if( $oldmediatype != $newmediatype ) {
				//change media type
				$query = "UPDATE $media_table SET mediatypeID = \"$newmediatype\" WHERE mediaID = \"$mediaID\"";
				$result = tng_query($query);
				
				//if usecollfolder then move to new folder
				//else leave in media
				if( $row['usecollfolder'] ) {
					$treestr = $tngconfig['mediatrees'] ? $row['gedcom'] . "/" : "";
					$oldmediapath = $mediatypes_assoc[$oldmediatype];
					$newmediapath = $mediatypes_assoc[$newmediatype];
					if( $row['path'] ) {
						$oldpath = "$rootpath$oldmediapath/" . $row['path'];
						$newpath = "$rootpath$newmediapath/" . $row['path'];
						@rename($oldpath, $newpath);
					}

					if( $row['thumbpath'] ) {
						$oldthumbpath = "$rootpath$oldmediapath/" . $row['thumbpath'];
						$newthumbpath = "$rootpath$newmediapath/" . $row['thumbpath'];
						@rename($oldthumbpath, $newthumbpath);
					}
				}
				//change ordernum in media link
					//add to end of new media type
				//get all people linked to this item where the item has the same *new* mediatype so we can add one
				$query3 = "SELECT medialinkID, personID, eventID, mediatypeID, $medialinks_table.gedcom as gedcom FROM ($medialinks_table, $media_table) 
					WHERE $medialinks_table.mediaID = \"$mediaID\" 
					AND mediatypeID = \"$newmediatype\"
					AND $medialinks_table.mediaID = $media_table.mediaID";
				$result3 = tng_query($query3) or die ($admtext['cannotexecutequery'] . ": $query3");
				while( $row3 = tng_fetch_assoc( $result3 ) ) {
					$query4 = "SELECT count(medialinkID) as count FROM ($media_table, $medialinks_table) 
						WHERE personID = \"{$row3['personID']}\" 
						AND $medialinks_table.gedcom = \"{$row3['gedcom']}\"
						AND mediatypeID = \"$newmediatype\"
						AND $medialinks_table.mediaID = $media_table.mediaID
						AND eventID = \"{$row3['eventID']}\"";
					$result4 = tng_query($query4) or die ($admtext['cannotexecutequery'] . ": $query4");
					if( $result4 ) {
						$row4 = tng_fetch_assoc($result4);
						$newrow = $row4['count'] + 1;
						tng_free_result($result4);
					}
					else
						$newrow = 1;

					$query5 = "UPDATE $medialinks_table SET ordernum = \"$newrow\" WHERE medialinkID = \"{$row3['medialinkID']}\"";
					$result5 = tng_query($query5) or die ($admtext['cannotexecutequery'] . ": $query5");

					//reorder old media type for everything linked to item
					$query6 = "SELECT personID from $people_table WHERE personID = \"{$row3['personID']}\" AND gedcom = \"{$row3['gedcom']}\"";
					reorderMedia( $query6, $row3, $row3['mediatypeID'] );
								
					$query6 = "SELECT familyID as personID from $families_table WHERE familyID = \"{$row3['personID']}\" AND gedcom = \"{$row3['gedcom']}\"";
					reorderMedia( $query6, $row3, $row3['mediatypeID'] );

					$query6 = "SELECT sourceID as personID from $sources_table WHERE sourceID = \"{$row3['personID']}\" AND gedcom = \"{$row3['gedcom']}\"";
					reorderMedia( $query6, $row3, $row3['mediatypeID'] );

					$query6 = "SELECT repoID as personID from $repositories_table WHERE repoID = \"{$row3['personID']}\" AND gedcom = \"{$row3['gedcom']}\"";
					reorderMedia( $query6, $row3, $row3['mediatypeID'] );
				}
				tng_free_result( $result3 );
			}
		}
	}
	if($count) {
		$query = "UPDATE $mediatypes_table SET disabled=\"0\" where mediatypeID=\"$newmediatype\"";
		$result = @tng_query($query);
	}
}
elseif( $xphaction == $admtext['addtoalbum'] ) {
	setcookie("tng_search_media_post[album]", $albumID, 0);
	foreach( array_keys($_POST) as $key ) {
		if( substr( $key, 0, 2 ) == "ph" ) {
			$count++;
			$mediaID = substr( $key, 2 );

			$query = "SELECT count(albumlinkID) as acount FROM $albumlinks_table WHERE albumID = \"$albumID\" AND mediaID = \"$mediaID\"";
			$result = tng_query($query);
			$row = tng_fetch_assoc( $result );
			tng_free_result( $result );

			if( !$row['acount'] ) {
				//get new order number
				$query = "SELECT count(albumlinkID) as acount FROM $albumlinks_table WHERE albumID = \"$albumID\"";
				$result = tng_query($query);
				$row = tng_fetch_assoc( $result );
				tng_free_result( $result );

				$neworder = $row['acount'] ? $row['acount'] + 1 : 1;

				$query = "INSERT INTO $albumlinks_table (albumID, mediaID, ordernum, defphoto) VALUES (\"$albumID\", \"$mediaID\", \"$neworder\", \"0\")";
				$result = tng_query($query);
			}
		}
	}
}
elseif( $xphaction == $admtext['deleteselected'] ) {
	$query = "DELETE FROM $media_table WHERE 1=0";

	foreach( array_keys($_POST) as $key ) {
		if( substr( $key, 0, 2 ) == "ph" ) {
			$count++;
			$mediaID = substr( $key, 2 );
			$query .= " OR mediaID=\"$mediaID\"";

			//removeImages($mediaID);

			$aquery = "DELETE FROM $albumlinks_table WHERE mediaID=\"$mediaID\"";
			$aresult = tng_query($aquery) or die ($admtext['cannotexecutequery'] . ": $aquery");

			resortMedia($mediaID );
		}
	}

	$result = tng_query($query);
}

adminwritelog( $admtext['modifymedia'] . ": " . $admtext['all'] );

if( $count )
	$message = $admtext['changestoallmedia'] . " {$admtext['succsaved']}.";
else
	$message = $admtext['nochanges'];
header( "Location: admin_media.php?message=" . urlencode($message) );
?>