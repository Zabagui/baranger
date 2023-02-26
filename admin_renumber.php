<?php
include("begin.php");
include("adminlib.php");
$textpart = "setup";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( !$allow_edit || $assignedtree ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

//can only start if in maintenance mode

$helplang = findhelp("backuprestore_help.php");

tng_adminheader( $admtext['backuprestore'], $flags );
?>
</head>

<?php
	echo tng_adminlayout();

	$utiltabs[0] = array(1,"admin_utilities.php?sub=tables",$admtext['tables'],"tables");
	$utiltabs[1] = array(1,"admin_utilities.php?sub=structure",$admtext['tablestruct'],"structure");
	$utiltabs[2] = array(1,"admin_renumbermenu.php",$admtext['renumber'],"renumber");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/backuprestore_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($utiltabs,"renumber",$innermenu);
	$headline = $admtext['backuprestore'] . " &gt;&gt; " . $admtext['renumber'];
	echo displayHeadline($headline,"img/backuprestore_icon.gif",$menu,$message);
?>
<div class="lightback pad2">
<div class="databack normal pad5">

	<p class="subhead"><strong><?php echo $admtext['renumber']; ?></strong></p>

<?php
$nextnum = isset($start) ? $start : 1;
if(!isset($digits)) $digits = 0;
if(!isset($type)) $type = "person";
$count = 0;

$prefix = $tngconfig[$type.'prefix'];
$suffix = $tngconfig[$type.'suffix'];

//choose to do people, families, sources or repos
if($type == "person") {
	$table = $people_table;
	$id = "personID";
}
elseif($type == "family") {
	$table = $families_table;
	$id = "familyID";
}
elseif($type == "source") {
	$table = $sources_table;
	$id = "sourceID";
}
elseif($type == "repo") {
	$table = $repositories_table;
	$id = "repoID";
}

//get all people after start number, sorted on ID (not including prefix)
if( $prefix ) {
	$prefixlen = strlen( $prefix ) + 1;
	
	$query = "SELECT ID, $id, (0+SUBSTRING($id,$prefixlen)) as num FROM $table WHERE gedcom = \"$tree\" AND (0+SUBSTRING($id,$prefixlen)) >= $nextnum ORDER BY num";
}
else
	$query = "SELECT ID, $id, (0+SUBSTRING_INDEX($id,'$suffix',1)) as num FROM $table WHERE gedcom = \"$tree\" AND (0+SUBSTRING_INDEX($id,'$suffix',1)) >= $nextnum ORDER BY num";

$result = tng_query($query);

//do this only for person type:
if($type == "person") {
	//search media table for all media records with an image map
	$query = "SELECT mediaID, map from $media_table WHERE map != \"\"";
	$result1 = tng_query($query);
    $keys = array();
    $maps = array();
	while( $row = tng_fetch_assoc($result1) ) {
		//put all in an array with mediaID as the key
        $maps[$row['mediaID']] = array("map" => $row['map'], "newmap" => "");
		$pattern = "/personID=(I\d+)&[amp;]*tree=$tree/";
		//loop over all of them and pull out person IDs
		preg_match_all($pattern, $row['map'], $matches, PREG_SET_ORDER);
		//build an index with the personID as the key and the mediaID as the value
        foreach($matches as $match) {
            $fullmatch = $match[0];
            $specmatch = $match[1];
            $key = $specmatch;
            $keys[$key][] = array("mediaID"=>$row['mediaID'], "found" => $fullmatch);
            /* this block used for testing
                if(isset($keys[$key])) {
                    foreach($keys[$key] as $tkey) {
                        $mediaID = $tkey['mediaID'];
                        $map = $maps[$mediaID]['map'];
                        $offset = strpos($map, $tkey['found']);

                        if($offset) {
                            $offset += 9;
                            $oldlen = strlen($key);
                            $newmap = substr_replace($map, "newID", $offset, $oldlen);
                            $maps[$mediaID]['map'] = $maps[$mediaID]['newmap'] = $newmap;
                            echo "newmap = \n$newmap\n";
                        }
                    }
                }
            */
        }
	}
	tng_free_result($result1);
}

while($row = tng_fetch_assoc($result)) {
	if($row['num'] < $nextnum)
		break;
	if($row['num'] >= $nextnum) {
		$newID = $digits ? ($prefix . str_pad( $nextnum, $digits, "0", STR_PAD_LEFT ) . $suffix) : ($prefix . $nextnum . $suffix);

		$query = "SELECT ID from $table WHERE gedcom=\"$tree\" AND $id=\"$newID\"";
		$result1 = tng_query($query);
		if(!tng_num_rows($result1)) {
			//if(tng_num_rows($result1)) die ("Problem: destination ID ($newID) already exists. Operation aborted.");

			//change ID in people to match next #
			$query = "UPDATE $table SET $id=\"$newID\" WHERE ID=\"{$row['ID']}\"";
			$result2 = tng_query($query);

			if($type == "person") {
                $old = $row['personID'];

				$query = "UPDATE $families_table SET husband=\"$newID\" WHERE gedcom=\"$tree\" AND husband=\"$old\"";
				$result2 = tng_query($query);

				$query = "UPDATE $families_table SET wife=\"$newID\" WHERE gedcom=\"$tree\" AND wife=\"$old\"";
				$result2 = tng_query($query);

				$query = "UPDATE $children_table SET personID=\"$newID\" WHERE gedcom=\"$tree\" AND personID=\"$old\"";
				$result2 = tng_query($query);

				$query = "UPDATE $assoc_table SET personID=\"$newID\" WHERE gedcom=\"$tree\" AND personID=\"$old\"";
				$result2 = tng_query($query);

				$query = "UPDATE $assoc_table SET passocID=\"$newID\" WHERE gedcom=\"$tree\" AND passocID=\"$old\"";
				$result2 = tng_query($query);

				$query = "UPDATE $temp_events_table SET personID=\"$newID\" WHERE gedcom=\"$tree\" AND personID=\"$old\"";
				$result2 = tng_query($query);

				$query = "UPDATE $mostwanted_table SET personID=\"$newID\" WHERE gedcom=\"$tree\" AND personID=\"$old\"";
				$result2 = tng_query($query);

				$query = "UPDATE $users_table SET personID=\"$newID\" WHERE mygedcom=\"$tree\" AND personID=\"$old\"";
				$result2 = tng_query($query);

                if(isset($keys[$old])) {
                    foreach($keys[$old] as $key) {
                        $mediaID = $key['mediaID'];
                        $map = $maps[$mediaID]['map'];
                        $offset = strpos($map, $key['found']);

                        if($offset) {
                            $offset += 9; //length of personID=
                            $oldlen = strlen($old);
                            $newmap = substr_replace($map, $newID, $offset, $oldlen);
                            $maps[$mediaID]['map'] = $maps[$mediaID]['newmap'] = $newmap;

                            $query = "UPDATE $media_table SET map=\"" . addslashes($newmap) . "\" WHERE mediaID=\"$mediaID\"";
                            $result2 = tng_query($query);
                        }
                    }
                }
			}

			if($type == "family") {
				$query = "UPDATE $children_table SET familyID=\"$newID\" WHERE gedcom=\"$tree\" AND familyID=\"{$row['familyID']}\"";
				$result2 = tng_query($query);

				$query = "UPDATE $people_table SET famc=\"$newID\" WHERE famc=\"{$row['familyID']}\" AND gedcom = \"$tree\"";
				$result2 = tng_query($query);

				$query = "UPDATE $temp_events_table SET familyID=\"$newID\" WHERE gedcom=\"$tree\" AND familyID=\"{$row['familyID']}\"";
				$result2 = tng_query($query);
			}

			$query = "UPDATE $events_table SET persfamID=\"$newID\" WHERE gedcom=\"$tree\" AND persfamID=\"" . $row[$id] . "\"";
			$result2 = tng_query($query);

			$query = "UPDATE $medialinks_table SET personID=\"$newID\" WHERE gedcom=\"$tree\" AND personID=\"" . $row[$id] . "\"";
			$result2 = tng_query($query);

			if($type == "person" || $type == "family") {
				$query = "UPDATE $branchlinks_table SET persfamID=\"$newID\" WHERE gedcom=\"$tree\" AND persfamID=\"" . $row[$id] . "\"";
				$result2 = tng_query_noerror($query);
				$success = tng_affected_rows();
				if(!$success) {
					$query = "DELETE FROM $branchlinks_table WHERE gedcom=\"$tree\" AND persfamID=\"" . $row[$id] . "\"";
					$result2 = tng_query_noerror($query);
				}
			}

			$query = "UPDATE $album2entities_table SET entityID=\"$newID\" WHERE gedcom=\"$tree\" AND entityID=\"" . $row[$id] . "\"";
			$result2 = tng_query($query);

			if($type == "source") {
				$query = "UPDATE $citations_table SET sourceID=\"$newID\" WHERE gedcom=\"$tree\" AND sourceID=\"" . $row[$id] . "\"";
				$result2 = tng_query($query);
			}
			else {
				$query = "UPDATE $citations_table SET persfamID=\"$newID\" WHERE gedcom=\"$tree\" AND persfamID=\"" . $row[$id] . "\"";
				$result2 = tng_query($query);
			}

			$query = "UPDATE $notelinks_table SET persfamID=\"$newID\" WHERE gedcom=\"$tree\" AND persfamID=\"" . $row[$id] . "\"";
			$result2 = tng_query($query);

			//echo "$row['personID'] -&gt; $newID<br>";
			$count++;
			if( $count % 10 == 0 ) {
				echo "<strong>$count</strong> ";
			}
		}
		tng_free_result($result1);
	}
	$nextnum++;
}
tng_free_result($result);

echo "<p class=\"normal\">{$admtext['finreseq']}: $count {$admtext['recsreseq']}</p>\n";
echo "</div></div>\n";

echo tng_adminfooter();
?>
