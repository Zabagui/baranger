<?php
include("begin.php");
include("adminlib.php");
$textpart = "sources";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

require("adminlog.php");

if( !$allow_edit || !$allow_delete ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

if( $assignedtree )
	$wherestr = "WHERE gedcom = \"$assignedtree\"";
else
	$wherestr = "";

$query = "SELECT gedcom, treename FROM $trees_table $wherestr ORDER BY treename";
$treeresult = tng_query($query);

function doRow( $field, $textmsg, $boxname ) {
	global $s1row, $s2row, $admtext, $repositories_table, $tree;

	$s1field = isset($s1row[$field]) ? $s1row[$field] : "";
	$s2field = isset($s2row[$field]) ? $s2row[$field] : "";

	if( $field == "repoID" ) {
		if( $s1field ) {
			$query = "SELECT reponame FROM $repositories_table WHERE repoID = \"$s1field\" and gedcom = \"$tree\"";
			$result = tng_query($query);
			$reporow = tng_fetch_assoc( $result );
			$s1field = $reporow['reponame'] ? "{$reporow['reponame']} ($s1field)" : $s1field;
			tng_free_result($result);
		}
		if( $s2field ) {
			$query = "SELECT reponame FROM $repositories_table WHERE repoID = \"$s2field\" and gedcom = \"$tree\"";
			$result = tng_query($query);
			$reporow = tng_fetch_assoc( $result );
			$s2field = $reporow['reponame'] ? "{$reporow['reponame']} ($s2field)" : $s2field;
			tng_free_result($result);
		}
	}

	if( $s1field || $s2field ) {
		echo "<tr>\n";
		echo "<td valign=\"top\" width=\"15%\" class=\"fieldnameback\" nowrap><span class=\"fieldname\"><strong>$admtext[$textmsg]:</strong></span></td>";
		echo "<td valign=\"top\" width=\"31%\" class=\"lightback\"><span class=\"normal\">$s1field&nbsp;</span></td>";
		if( is_array( $s2row ) ) {
			echo "<td width=\"10\">&nbsp;&nbsp;</td>";
			echo "<td valign=\"top\" width=\"15%\" class=\"fieldnameback\" nowrap><span class=\"fieldname\"><strong>$admtext[$textmsg]:</strong></span></td>";
			echo "<td valign=\"top\" width=\"5\" class=\"lightback\"><span class=\"normal\">";
			if( $boxname ) {
				if( $s2field ) {
					echo "<input type=\"checkbox\" name=\"$boxname\" value=\"$field\"";
					if( $s2row[$field] && !$s1row[$field] ) echo " checked";
					echo ">";
				}
			}
			else
				echo "&nbsp;";
			echo "</span></td>";
			echo "<td valign=\"top\" width=\"31%\" class=\"lightback\"><span class=\"normal\">$s2field&nbsp;</span></td>";
		}
		else {
			echo "<td width=\"10\">&nbsp;&nbsp;</td>";
			echo "<td valign=\"top\" width=\"15%\" class=\"fieldnameback\" nowrap><span class=\"fieldname\"><strong>$admtext[$textmsg]:</strong></span></td>";
			echo "<td valign=\"top\" width=\"5\" class=\"lightback\"><span class=\"normal\">&nbsp;</span></td>";
			echo "<td valign=\"top\" width=\"31%\" class=\"lightback\"><span class=\"normal\">&nbsp;</span></td>";
		}
		echo "</tr>\n";
	}
}

function getEvent( $event ) {
	global $mylanguage, $languages_path;
	
	$dispvalues = explode( "|", $event['display'] );
	$numvalues = count( $dispvalues );
	if( $numvalues > 1 ) {
		$displayval = "";
		for( $i = 0; $i < $numvalues; $i += 2 ) {
			$lang = $dispvalues[$i];
			if( $mylanguage == $languages_path . $lang ) {
				$displayval = $dispvalues[$i+1];
				break;
			}
		}
	}
	else
		$displayval = $event['display'];
		
	$eventstr = "<strong>$displayval</strong>: ";
	$eventstr2 = $event['eventdate'];
	if( $eventstr2 && $event['eventplace'] )
		$eventstr2 .= ", ";
	$eventstr2 .= $event['eventplace'];
	if( $eventstr2 && $event['info'] )
		$eventstr2 .= ". ";
	$eventstr2 .= $event['info'] . "<br/>\n";
	$eventstr .= $eventstr2;
	
	return $eventstr;
}

function addCriteria( $row ) {
	global $cshorttitle, $clongtitle, $cauthor, $cpublisher, $crepoID, $cactualtext, $cignoreblanks;

	$criteria = "";
	if( $cshorttitle == "yes" ) {
		$criteria .= " AND " . "shorttitle" . " = \"" . addslashes( $row['shorttitle'] ) . "\"";
		$criteria .= $cignoreblanks == "yes" ? " AND shorttitle != \"\"" : "";
	}
	if( $clongtitle == "yes" ) {
		$criteria .= " AND " . "title" . " = \"" . addslashes( $row['title'] ) . "\"";
		$criteria .= $cignoreblanks == "yes" ? " AND title != \"\"" : "";
	}
	if( $cauthor == "yes" ) {
		$criteria .= " AND author = \"" . addslashes( $row['author'] ) . "\"";
		$criteria .= $cignoreblanks == "yes" ? " AND author != \"\"" : "";
	}
	if( $cpublisher == "yes" ) {
		$criteria .= " AND publisher = \"" . addslashes( $row['publisher'] ) . "\"";
		$criteria .= $cignoreblanks == "yes" ? " AND publisher = \"\"" : "";
	}
	if( $crepoID == "yes" ) {
		$criteria .= " AND repoID = \"" . addslashes( $row['repoID'] ) . "\"";
		$criteria .= $cignoreblanks == "yes" ? " AND repoID != \"\"" : "";
	}
	if( $cactualtext == "yes" ) {
		$criteria .= " AND actualtext = \"" . addslashes( $row['actualtext'] ) . "\"";
		$criteria .= $cignoreblanks == "yes" ? " AND actualtext = \"\"" : "";
	}
	
	return $criteria;
}

function doNotes( $persfam1, $persfam2, $varname ) {
	global $ccombinenotes, $admtext, $notelinks_table, $tree;
	
	if( $varname ) {
		if( $varname == "general" )
			$varname = "";
		$wherestr = "AND eventID = \"$varname\"";
	}
	else $wherestr = "";
	
	if( $ccombinenotes != "yes" ) {
		$query = "DELETE from $notelinks_table WHERE persfamID = \"$persfam1\" AND gedcom = \"$tree\" $wherestr";
		$noteresult = tng_query($query);
	}
	$query = "UPDATE $notelinks_table set persfamID = \"$persfam1\" WHERE persfamID = \"$persfam2\" AND gedcom = \"$tree\" $wherestr";
	$noteresult = tng_query($query);
}

$s1row = $s2row = "";
if( !empty($sourceID1) ) {
	$query = "SELECT *, DATE_FORMAT(changedate,\"%d %b %Y %H:%i:%s\") as changedate FROM $sources_table WHERE sourceID = \"$sourceID1\" and gedcom = \"$tree\"";
	$result = tng_query($query);
	if( $result && tng_num_rows( $result ) ) {
		$s1row = tng_fetch_assoc( $result );
		tng_free_result($result);
	}
	else
		$sourceID1 = $sourceID2 = "";
}

@set_time_limit(0);
if( empty($mergeaction) ) {
	$cshorttitle = "yes";
	$clongtitle = "yes";
}
if( isset($mergeaction) && ($mergeaction == $admtext['nextmatch'] || $mergeaction == $admtext['nextdup']) ) {
	if( $mergeaction == $admtext['nextmatch'] ) {
		$wherestr2 = $sourceID2 ? " AND sourceID > \"$sourceID2\"" : "";
		$wherestr2 .= $sourceID1 ? " AND sourceID > \"$sourceID1\"" : "";

		$wherestr = $sourceID1 ? "AND sourceID > \"$sourceID1\"" : "";
		$largechunk = 1000;
		$nextchunk = -1;
		$numrows = 0;
		$still_looking = 1;
		$sourceID2 = "";
		
		do {
			$nextone = $nextchunk + 1;
			$nextchunk += $largechunk;
	
			$query = "SELECT * FROM $sources_table WHERE gedcom = \"$tree\" $wherestr ORDER BY sourceID LIMIT $nextone, $largechunk";
			$result = tng_query($query);
			$numrows = tng_num_rows( $result );
			if( $result && $numrows ) {
				while( $still_looking && $row = tng_fetch_assoc( $result ) ) {
					//echo "compare $row['firstname'] $row['lastname']<br/>\n";
					$wherestr2 = addCriteria( $row );

					$query = "SELECT * FROM $sources_table WHERE sourceID > \"{$row['sourceID']}\" AND gedcom = \"$tree\" $wherestr2 ORDER BY sourceID LIMIT 1";
					//echo "q2: $query<br/>\n";
					$result2 = tng_query($query);
					if( $result2 && tng_num_rows( $result2 ) ) {
						//set sourceID1, sourceID2
						$s1row = $row;
						$sourceID1 = $s1row['sourceID'];
						$s2row = tng_fetch_assoc( $result2 );
						//echo "found $s2row['title'] $s2row['shorttitle']<br/>\n";
						$sourceID2 = $s2row['sourceID'];
						tng_free_result( $result2 );
						$still_looking = 0;
					}
				}
				tng_free_result( $result );
			}
		} while ( $numrows && $still_looking );
		if( !$sourceID2 ) $sourceID1 = $s1row = "";
	}
	else {
		//search with sourceID1 for next duplicate
		$wherestr2 = $sourceID2 ? " AND sourceID > \"$sourceID2\"" : "";
		$wherestr2 .= addCriteria( $s1row );

		$query = "SELECT * FROM $sources_table WHERE sourceID != \"{$s1row['sourceID']}\" AND gedcom = \"$tree\" $wherestr2 ORDER BY sourceID LIMIT 1";
		$result2 = tng_query($query);
		if( $result2 && tng_num_rows( $result2 ) ) {
			$s2row = tng_fetch_assoc( $result2 );
			$sourceID2 = $s2row['sourceID'];
			tng_free_result( $result2 );
		}
		else
			$sourceID2 = "";
	}
}
elseif( !empty($sourceID2) ) {
	$query = "SELECT *, DATE_FORMAT(changedate,\"%d %b %Y %H:%i:%s\") as changedate FROM $sources_table WHERE sourceID = \"$sourceID2\" AND gedcom = \"$tree\"";
	$result2 = tng_query($query);
	if( $result2 && tng_num_rows( $result2 ) && $sourceID1 != $sourceID2 ) {
		$s2row = tng_fetch_assoc( $result2 );
		$sourceID2 = $s2row['sourceID'];
		tng_free_result($result2);
	}
	else {
		$mergeaction = $admtext['comprefresh'];
		$sourceID2 = "";
	}
}
if( isset($mergeaction) && $mergeaction == $admtext['merge'] ) {
	$updatestr = "";

	foreach( $_POST as $key=>$value ) {
		$prefix = substr( $key, 0, 2 );
		switch( $prefix ) {
			case "s2":
				$varname = substr( $key, 2 );
				$s1row[$varname] = $s2row[$varname];
				$updatestr .= ", $varname = \"" . addslashes($s1row[$varname]) . "\" ";
				doNotes( $sourceID1, $sourceID2, $varname );
				break;
			case "ev":
				if(strpos($key,"::")) {
					$halves = explode("::",substr($key,5));
					$varname = substr(strstr($halves[0], "_"),1);
					$query = "DELETE from $events_table WHERE persfamID = \"$sourceID1\" AND gedcom = \"$tree\" and eventID = \"$varname\"";
					$evresult = tng_query($query);
					$varname = substr(strstr($halves[1], "_"),1);

					$query = "SELECT eventID FROM $events_table WHERE persfamID = \"$sourceID2\" AND  gedcom = \"$tree\" and eventID = \"$varname\"";
					$evresult = tng_query($query);
					while( $evrow = tng_fetch_assoc( $evresult ) )
						doNotes( $sourceID1, $sourceID2, $evrow['eventID'] );
					tng_free_result( $evresult );
				}
				else {
					$varname = substr($key,5);
					doNotes( $sourceID1, $sourceID2, $varname );
				}

				$query = "UPDATE $events_table set persfamID = \"$sourceID1\" WHERE persfamID = \"$sourceID2\" AND gedcom = \"$tree\" AND eventID = \"$varname\"";
				$evresult = @tng_query($query);
				break;
		}
	}
	if( $ccombinenotes ) {
		doNotes( $sourceID1, $sourceID2, "general" );

		//convert all remaining notes and citations
		$query = "UPDATE $notelinks_table set persfamID = \"$sourceID1\" WHERE persfamID = \"$sourceID2\" AND gedcom = \"$tree\"";
		$noteresult = tng_query($query);
	}
	if( $updatestr ) {
		$updatestr = substr( $updatestr, 2 );
		$query = "UPDATE $sources_table set $updatestr WHERE sourceID = \"$sourceID1\" AND gedcom = \"$tree\"";
		$combresult = tng_query($query);
	}

	$query = "DELETE from $sources_table WHERE sourceID = \"$sourceID2\" AND gedcom = \"$tree\"";
	$combresult = tng_query($query);

	//delete remaining notes & events for source 2
	$query = "DELETE from $events_table WHERE persfamID = \"$sourceID2\" AND gedcom = \"$tree\"";
	$combresult = tng_query($query);

	$query = "DELETE from $notelinks_table WHERE persfamID = \"$sourceID2\" AND gedcom = \"$tree\"";
	$combresult = tng_query($query);

	//point citations for s2 to s1
	$query = "UPDATE $citations_table set sourceID = \"$sourceID1\" WHERE sourceID = \"$sourceID2\" AND gedcom = \"$tree\"";
	$combresult = tng_query($query);

	//construct name for default photo 2
	$defaultphoto2 = $tree ? "$rootpath$photopath/$tree.$sourceID2.$photosext" : "$rootpath$photopath/$sourceID2.$photosext";
	if( $ccombineextras ) {
		$query = "UPDATE $medialinks_table set personID = \"$sourceID1\", defphoto = \"\" WHERE personID = \"$sourceID2\" AND gedcom = \"$tree\"";
		$mediaresult = @tng_query($query);

		//construct name for default photo 1
		if( file_exists( $defaultphoto2 ) ) {
			$defaultphoto1 = $tree ? "$rootpath$photopath/$tree.$sourceID1.$photosext" : "$rootpath$photopath/$sourceID1.$photosext";
			if( !file_exists( $defaultphoto1 ) )
				rename( $defaultphoto2, $defaultphoto1 );
			else
				unlink( $defaultphoto2 );
		}
	}
	else {
		$query = "DELETE FROM $medialinks_table WHERE personID = \"$sourceID2\" AND gedcom = \"$tree\"";
		$mediaresult = tng_query($query);

		if( file_exists( $defaultphoto2 ) )
			unlink( $defaultphoto2 );
	}
	$sourceID2 = "";
	$s2row = "";
	adminwritelog( $admtext['merge'] . ": $tree/$sourceID2 => $sourceID1" );
}

$helplang = findhelp("sources_help.php");

tng_adminheader( $admtext['merge'], $flags );
?>
<script type="text/javascript" src="js/selectutils.js"></script>
<script type="text/javascript">
var tnglitbox;
function validateForm( ) {
	var rval = true;
	
	if( document.form1.sourceID1.value == '' || document.form1.sourceID2.value == '' || document.form1.sourceID1.value == document.form1.sourceID2.value )
		rval = false;
	else
		rval = confirm( '<?php echo $admtext['confirmmergesources']; ?>' );

	return rval;
}

function switchsources() {
	var formname = document.form1;
	
	if( formname.sourceID1.value && formname.sourceID2.value ) {
		var temp = formname.sourceID1.value;
		
		formname.sourceID1.value = formname.sourceID2.value;
		formname.sourceID2.value = temp;
		
		return true;
	}
	else
		return false;

}
</script>
<script type="text/javascript" src="js/admin.js"></script>
</head>

<?php
	echo tng_adminlayout();

	$sourcetabs[0] = array(1,"admin_sources.php",$admtext['search'],"findsource");
	$sourcetabs[1] = array($allow_add,"admin_newsource.php",$admtext['addnew'],"addsource");
	$sourcetabs[3] = array($allow_edit && $allow_delete,"admin_mergesources.php",$admtext['merge'],"merge");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/sources_help.php#merge');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($sourcetabs,"merge",$innermenu);
	echo displayHeadline($admtext['sources'] . " &gt;&gt; " . $admtext['merge'], "img/sources_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">
	<div class="normal"><em><?php echo $admtext['choosemergesources']; ?></em><br/><br/>
	<form action="admin_mergesources.php" method="post" name="form1" id="form1" >
	<table>
		<tr>
			<td><span class="normal"><?php echo $admtext['tree']; ?>:</span></td>
			<td>
				<select name="tree">
<?php
$trees = "";
while( $treerow = tng_fetch_assoc($treeresult) ) {
	$trees .= "			<option value=\"{$treerow['gedcom']}\"";
	if( !empty($tree) && $treerow['gedcom'] == $tree ) $trees .= " selected";
	$trees .= ">{$treerow['treename']}</option>\n";
}
echo $trees;
$mergeclass = !empty($sourceID1) && !empty($sourceID2) ? "class=\"btn\"" : "class=\"disabled\" disabled";
?>
				</select>	
			</td>
		</tr>
		<tr><td></td></tr>
	</table><br/>
	<table class="normal">
		<tr>
			<td><div style="float:left"><?php echo $admtext['sourceid']; ?> 1: <input type="text" name="sourceID1" id="sourceID1" size="10" value="<?php if( isset($sourceID1) ) echo $sourceID1; ?>"> &nbsp;<?php echo $admtext['text_or']; ?>&nbsp;</div>
			<a href="#" onclick="return findItem('S','sourceID1','sourceTitle1',document.form1.tree.options[document.form1.tree.selectedIndex].value);" title="<?php echo $admtext['find']; ?>" class="smallicon admin-find-icon"></a></td>
			<td width="80">&nbsp;</td>
			<td><div style="float:left"><?php echo $admtext['sourceid']; ?> 2: <input type="text" name="sourceID2" id="sourceID2" size="10" value="<?php if( isset($sourceID2) ) echo $sourceID2; ?>"> &nbsp;<?php echo $admtext['text_or']; ?>&nbsp;</div>
			<a href="#" onclick="return findItem('S','sourceID2','sourceTitle2',document.form1.tree.options[document.form1.tree.selectedIndex].value);" title="<?php echo $admtext['find']; ?>" class="smallicon admin-find-icon"></a></td>
		</tr>
        <tr>
            <td id="sourceTitle1"><?php if(isset($s1row['title'])) echo truncateIt($s1row['title'],100); ?></td>
            <td width="80"></td>
            <td id="sourceTitle2"><?php if(isset($s2row['title'])) echo truncateIt($s2row['title'],100); ?></td>
        </tr>
	</table><br/>
	<table>
		<tr>
			<td colspan="5"><span class="normal"><strong><?php echo $admtext['matchthese']; ?></strong></span></td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td colspan="3"><span class="normal"><strong><?php echo $admtext['otheroptions']; ?></strong></span></td>
		</tr>
		<tr>			
			<td>
				<span class="normal">
				<input type="checkbox" name="cshorttitle" value="yes"<?php if( isset($cshorttitle) && $cshorttitle ) echo " checked"; ?>> <?php echo $admtext['shorttitle']; ?><br/>
				<input type="checkbox" name="clongtitle" value="yes"<?php if( isset($clongtitle) && $clongtitle ) echo " checked"; ?>> <?php echo $admtext['title2']; ?>
				</span>
			</td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td>
				<span class="normal">
				<input type="checkbox" name="cauthor" value="yes"<?php if( isset($cauthor) && $cauthor == "yes" ) echo " checked"; ?>> <?php echo $admtext['author']; ?><br/>
				<input type="checkbox" name="cpublisher" value="yes"<?php if( isset($cpublisher) && $cpublisher == "yes" ) echo " checked"; ?>> <?php echo $admtext['publisher']; ?>
				</span>
			</td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td>
				<span class="normal">
				<input type="checkbox" name="crepoID" value="yes"<?php if( isset($crepoID) && $crepoID == "yes" ) echo " checked"; ?>> <?php echo $admtext['repository']; ?><br/>
				<input type="checkbox" name="cactualtext" value="yes"<?php if( isset($cactualtext) && $cactualtext == "yes" ) echo " checked"; ?>> <?php echo $admtext['actualtext']; ?>
				</span>
			</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>
				<span class="normal">
				<input type="checkbox" name="ccombinenotes" value="yes"<?php if( isset($ccombinenotes) && $ccombinenotes == "yes" ) echo " checked"; ?>> <?php echo $admtext['combinenotesonly']; ?><br/>
				<input type="checkbox" name="ccombineextras" value="yes"<?php if( isset($ccombineextras) && $ccombineextras == "yes" ) echo " checked"; ?>> <?php echo $admtext['combineextras']; ?>
				</span>
			</td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td valign="top">
				<span class="normal">
				<input type="checkbox" name="cignoreblanks" value="yes"<?php if( isset($cignoreblanks) && $cignoreblanks == "yes" ) echo " checked"; ?>> <?php echo $admtext['ignoreblanks']; ?><br/>
				</span>
			</td>
		</tr>
	</table><br/>
	<input type="submit" class="btn" value="<?php echo $admtext['nextmatch']; ?>" name="mergeaction"> 
	<input type="submit" class="btn" value="<?php echo $admtext['nextdup']; ?>" name="mergeaction">
	<input type="submit" class="btn" value="<?php echo $admtext['comprefresh']; ?>" name="mergeaction">
	<input type="submit" class="btn" value="<?php echo $admtext['mswitch']; ?>" name="mergeaction" onClick="document.form1.mergeaction.value='<?php echo $admtext['comprefresh']; ?>'; return switchsources();">
	<input type="submit" <?php echo $mergeclass; ?> value="<?php echo $admtext['merge']; ?>" name="mergeaction" onClick="return validateForm();">
	<br/><br/>
	<table cellpadding="3" cellspacing="1" border="0"  width="100%" class="normal">
<?php
	if( is_array( $s1row ) ) {
		$eventlist = array();
		echo "<tr>\n";
		echo "<td colspan=\"3\"><strong class=\"subhead\">{$admtext['source']} 1 | <a href=\"\" onclick=\"window.open('admin_editsource.php?sourceID={$s1row['sourceID']}&amp;tree=$tree&amp;cw=1');return false;\">{$admtext['edit']}</a></strong></td>\n";
		if( is_array( $s2row ) ) {
			echo "<td colspan=\"3\"><strong class=\"subhead\">{$admtext['source']} 2 | <a href=\"\" onclick=\"window.open('admin_editsource.php?sourceID={$s2row['sourceID']}&amp;tree=$tree&amp;cw=1');return false;\">{$admtext['edit']}</a></strong></td>\n";

			$query = "SELECT display, eventdate, eventplace, info, $events_table.eventtypeID as eventtypeID, $events_table.eventID as eventID FROM $events_table, $eventtypes_table WHERE persfamID = \"{$s2row['sourceID']}\" AND gedcom = \"$tree\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID ORDER BY ordernum";
			$evresult = tng_query($query);
			$eventcount = tng_num_rows( $evresult );
		
			if( $evresult && $eventcount ) {
				while ( $event = tng_fetch_assoc( $evresult ) ) {
					$ekey = $event['eventID'];
					$ename = "event$ekey";
					$s2row[$ename] .= getEvent( $event );
					if($eventlist[$ekey])
						$eventlist[$ekey] .= "::" . "{$event['eventtypeID']}_{$event['eventID']}";
					else
						$eventlist[$ekey] = "{$event['eventtypeID']}_{$event['eventID']}";
				}
				tng_free_result($evresult);
			}
		}
		echo "</tr>\n";
		doRow( "sourceID", "sourceid", "" );
		doRow( "shorttitle", "shorttitle", "s2shorttitle" );
		doRow( "title", "title", "s2title" );
		doRow( "author", "author", "s2author" );
		doRow( "callnum", "callnumber", "s2callnum" );
		doRow( "publisher", "publisher", "s2publisher" );
		doRow( "repoID", "repository", "s2repoID" );
		doRow( "actualtext", "actualtext", "s2actualtext" );
		$query = "SELECT display, eventdate, eventplace, info, $events_table.eventtypeID as eventtypeID, $events_table.eventID as eventID FROM $events_table, $eventtypes_table WHERE persfamID = \"{$s1row['sourceID']}\" AND gedcom = \"$tree\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID ORDER BY ordernum";
		$evresult = tng_query($query);
		$eventcount = tng_num_rows( $evresult );

		if( $evresult && $eventcount ) {
			while ( $event = tng_fetch_assoc( $evresult ) ) {
					$ekey = $event['eventID'];
				$ename = "event$ekey";
				$s1row[$ename] .= getEvent( $event );
				if($eventlist[$ekey])
					$eventlist[$ekey] .= "::" . "{$event['eventtypeID']}_{$event['eventID']}";
				else
					$eventlist[$ekey] = "{$event['eventtypeID']}_{$event['eventID']}";
			}
			tng_free_result($evresult);
		}
		
		foreach( $eventlist as $key => $event ) {
			$ename = "event$key";
			$inputname = "event$key";
			doRow( $ename, "otherevents", $inputname );
		}

	}
	else echo "<tr><td><span class=\"normal\"{$admtext['nomatches']}</span></td></tr>";
?>
	</table>
<?php
if( !empty($sourceID1) || !empty($sourceID2) ) {
?>
	<br/>
	<input type="submit" class="btn" value="<?php echo $admtext['nextmatch']; ?>" name="mergeaction">
	<input type="submit" class="btn" value="<?php echo $admtext['nextdup']; ?>" name="mergeaction">
	<input type="submit" class="btn" value="<?php echo $admtext['comprefresh']; ?>" name="mergeaction">
	<input type="submit" class="btn" value="<?php echo $admtext['mswitch']; ?>" name="mergeaction" onClick="document.form1.mergeaction.value='<?php echo $admtext['comprefresh']; ?>'; return switchsources();">
	<input type="submit" <?php echo $mergeclass; ?> value="<?php echo $admtext['merge']; ?>" name="mergeaction" onClick="return validateForm();">
<?php
}
?>	
	</form>
	</div>
	</div>
</div>
<?php 
echo tng_adminfooter();
?>