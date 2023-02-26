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
	global $r1row, $r2row, $admtext;
	
	if( $field == "addressID" ) {
		if( $r1row[$field] ) {
			$r1field = "";
			if($r1row['address1']) $r1field .= $r1row['address1'] . "<br/>";
			if($r1row['address2']) $r1field .= $r1row['address2'] . "<br/>";
			if($r1row['city']) $r1field .= $r1row['city'];
			if($r1row['state']) {
				if($r1row['city']) $r1field .= ", ";
				$r1field .= $r1row['state'];
			}
			if($r1row['country']) {
				if($r1row['city'] || $r1row['state']) $r1field .= ", ";
				$r1field .= $r1row['country'];
			}
			if(!$r1field) $r1field = $r1row['addressID'];
		}
		if( isset($r2row[$field]) ) {
			$r2field = "";
			if($r2row['address1']) $r2field .= $r2row['address1'] . "<br/>";
			if($r2row['address2']) $r2field .= $r2row['address2'] . "<br/>";
			if($r2row['city']) $r2field .= $r2row['city'];
			if($r2row['state']) {
				if($r2row['city']) $r2field .= ", ";
				$r2field .= $r2row['state'];
			}
			if($r2row['country']) {
				if($r2row['city'] || $r2row['state']) $r2field .= ", ";
				$r2field .= $r2row['country'];
			}
			if(!$r2field) $r2field = $r2row['addressID'];
		}
	}
	else {
		$r1field = $r1row[$field];
		$r2field = isset($r2row[$field]) ? $r2row[$field] : "";
	}

	if( $r1field || $r2field ) {
		echo "<tr>\n";
		echo "<td valign=\"top\" width=\"15%\" class=\"fieldnameback\" nowrap><span class=\"fieldname\"><strong>$admtext[$textmsg]:</strong></span></td>";
		echo "<td valign=\"top\" width=\"31%\" class=\"lightback\"><span class=\"normal\">$r1field&nbsp;</span></td>";
		if( is_array( $r2row ) ) {
			echo "<td width=\"10\">&nbsp;&nbsp;</td>";
			echo "<td valign=\"top\" width=\"15%\" class=\"fieldnameback\" nowrap><span class=\"fieldname\"><strong>$admtext[$textmsg]:</strong></span></td>";
			echo "<td valign=\"top\" width=\"5\" class=\"lightback\"><span class=\"normal\">";
			if( $boxname ) {
				if( $r2field ) {
					echo "<input type=\"checkbox\" name=\"$boxname\" value=\"$field\"";
					if( $r2row[$field] && !$r1row[$field] ) echo " checked";
					echo ">";
				}
				else
					echo "&nbsp;";
			}
			else
				echo "&nbsp;";
			echo "</span></td>";
			echo "<td valign=\"top\" width=\"31%\" class=\"lightback\"><span class=\"normal\">$r2field&nbsp;</span></td>";
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
	$criteria = "";
	$criteria .= " AND reponame = \"" . addslashes( $row['reponame'] ) . "\"";

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

$r1row = $r2row = "";
if( !empty($repoID1) ) {
	$query = "SELECT reponame, repoID, $repositories_table.addressID as addressID, address1, address2, city, state, zip, country, DATE_FORMAT(changedate,\"%d %b %Y %H:%i:%s\") as changedate FROM $repositories_table LEFT JOIN $address_table on $repositories_table.addressID = $address_table.addressID WHERE repoID = \"$repoID1\" AND $repositories_table.gedcom = \"$tree\"";
	$result = tng_query($query);
	if( $result && tng_num_rows( $result ) ) {
		$r1row = tng_fetch_assoc( $result );
		tng_free_result($result);
	}
	else
		$repoID1 = $repoID2 = "";
}

@set_time_limit(0);
if( isset($mergeaction) && ($mergeaction == $admtext['nextmatch'] || $mergeaction == $admtext['nextdup']) ) {
	if( $mergeaction == $admtext['nextmatch'] ) {
		$wherestr2 = $repoID2 ? " AND repoID > \"$repoID2\"" : "";
		$wherestr2 .= $repoID1 ? " AND repoID > \"$repoID1\"" : "";

		$wherestr = $repoID1 ? "AND repoID > \"$repoID1\"" : "";
		$largechunk = 1000;
		$nextchunk = -1;
		$numrows = 0;
		$still_looking = 1;
		$repoID2 = "";
		
		do {
			$nextone = $nextchunk + 1;
			$nextchunk += $largechunk;
	
			$query = "SELECT * FROM $repositories_table WHERE gedcom = \"$tree\" $wherestr ORDER BY repoID LIMIT $nextone, $largechunk";
			$result = tng_query($query);
			$numrows = tng_num_rows( $result );
			if( $result && $numrows ) {
				while( $still_looking && $row = tng_fetch_assoc( $result ) ) {
					$wherestr2 = addCriteria( $row );

					$query = "SELECT * FROM $repositories_table WHERE repoID > \"{$row['repoID']}\" AND gedcom = \"$tree\" $wherestr2 ORDER BY repoID";
					$result2 = tng_query($query);
					if( $result2 && tng_num_rows( $result2 ) ) {
						//set repoID1, repoID2
						$r1row = $row;
						$repoID1 = $r1row['repoID'];
						$r2row = tng_fetch_assoc( $result2 );
						//echo "found $r2row['title'] $r2row['shorttitle']<br/>\n";
						$repoID2 = $r2row['repoID'];
						tng_free_result( $result2 );
						$still_looking = 0;
					}
				}
				tng_free_result( $result );
			}
		} while ( $numrows && $still_looking );
		if( !$repoID2 ) $repoID1 = $r1row = "";
	}
	else {
		//search with repoID1 for next duplicate
		$wherestr2 = $repoID2 ? " AND repoID > \"$repoID2\"" : "";
		$wherestr2 .= addCriteria( $r1row );

		$query = "SELECT * FROM $repositories_table WHERE repoID != \"{$r1row['repoID']}\" AND gedcom = \"$tree\" $wherestr2 ORDER BY repoID LIMIT 1";
		$result2 = tng_query($query);
		if( $result2 && tng_num_rows( $result2 ) ) {
			$r2row = tng_fetch_assoc( $result2 );
			$repoID2 = $r2row['repoID'];
			tng_free_result( $result2 );
		}
		else
			$repoID2 = "";
	}
}
elseif( !empty($repoID2) ) {
	$query = "SELECT reponame, repoID, $repositories_table.addressID as addressID, address1, address2, city, state, zip, country, DATE_FORMAT(changedate,\"%d %b %Y %H:%i:%s\") as changedate FROM $repositories_table LEFT JOIN $address_table on $repositories_table.addressID = $address_table.addressID WHERE repoID = \"$repoID2\" AND $repositories_table.gedcom = \"$tree\"";
	$result2 = tng_query($query);
	if( $result2 && tng_num_rows( $result2 ) && $repoID1 != $repoID2 ) {
		$r2row = tng_fetch_assoc( $result2 );
		$repoID2 = $r2row['repoID'];
		tng_free_result($result2);
	}
	else {
		$mergeaction = $admtext['comprefresh'];
		$repoID2 = "";
	}
}
if( isset($mergeaction) && $mergeaction == $admtext['merge'] ) {
	$updatestr = "";

	foreach( $_POST as $key=>$value ) {
		$prefix = substr( $key, 0, 2 );
		switch( $prefix ) {
			case "p2":
				$varname = substr( $key, 2 );
				$r1row[$varname] = $r2row[$varname];
				$updatestr .= ", $varname = \"{$r1row[$varname]}\" ";
				doNotes( $repoID1, $repoID2, $varname );
				break;
			case "ev":
				if(strpos($key,"::")) {
					$halves = explode("::",substr($key,5));
					$varname = substr(strstr($halves[0], "_"),1);
					$query = "DELETE from $events_table WHERE persfamID = \"$repoID1\" AND gedcom = \"$tree\" and eventID = \"$varname\"";
					$evresult = tng_query($query);
					$varname = substr(strstr($halves[1], "_"),1);

					$query = "SELECT eventID FROM $events_table WHERE persfamID = \"$repoID2\" AND  gedcom = \"$tree\" and eventID = \"$varname\"";
					$evresult = tng_query($query);
					while( $evrow = tng_fetch_assoc( $evresult ) )
						doNotes( $repoID1, $repoID2, $evrow['eventID'] );
					tng_free_result( $evresult );
				}
				else {
					$varname = substr($key,5);
					doNotes( $repoID1, $repoID2, $varname );
				}

				$query = "UPDATE $events_table set persfamID = \"$repoID1\" WHERE persfamID = \"$repoID2\" AND gedcom = \"$tree\" AND eventID = \"$varname\"";
				$evresult = @tng_query($query);
				break;
		}
	}
	if( $ccombinenotes ) {
		doNotes( $repoID1, $repoID2, "general" );

		//convert all remaining notes and citations
		$query = "UPDATE $notelinks_table set persfamID = \"$repoID1\" WHERE persfamID = \"$repoID2\" AND gedcom = \"$tree\"";
		$noteresult = tng_query($query);
	}
	if( $updatestr ) {
		$updatestr = substr( $updatestr, 2 );
		$query = "UPDATE $repositories_table set $updatestr WHERE repoID = \"$repoID1\" AND gedcom = \"$tree\"";
		$combresult = tng_query($query);
	}

	$query = "DELETE from $repositories_table WHERE repoID = \"$repoID2\" AND gedcom = \"$tree\"";
	$combresult = tng_query($query);

	//delete remaining notes & events for repo 2
	$query = "DELETE from $events_table WHERE persfamID = \"$repoID2\" AND gedcom = \"$tree\"";
	$combresult = tng_query($query);

	$query = "DELETE from $notelinks_table WHERE persfamID = \"$repoID2\" AND gedcom = \"$tree\"";
	$combresult = tng_query($query);

	//point sources for r2 to r1
	$query = "UPDATE $sources_table set repoID = \"$repoID1\" WHERE repoID = \"$repoID2\" AND gedcom = \"$tree\"";
	$combresult = tng_query($query);

	//construct name for default photo 2
	$defaultphoto2 = $tree ? "$rootpath$photopath/$tree.$repoID2.$photosext" : "$rootpath$photopath/$repoID2.$photosext";
	if( $ccombineextras ) {
		$query = "UPDATE $medialinks_table set personID = \"$repoID1\", defphoto = \"\" WHERE personID = \"$repoID2\" AND gedcom = \"$tree\"";
		$mediaresult = @tng_query($query);

		//construct name for default photo 1
		if( file_exists( $defaultphoto2 ) ) {
			$defaultphoto1 = $tree ? "$rootpath$photopath/$tree.$repoID1.$photosext" : "$rootpath$photopath/$repoID1.$photosext";
			if( !file_exists( $defaultphoto1 ) )
				rename( $defaultphoto2, $defaultphoto1 );
			//else
				//unlink( $defaultphoto2 );
		}
	}
	else {
		$query = "DELETE FROM $medialinks_table WHERE personID = \"$repoID2\" AND gedcom = \"$tree\"";
		$mediaresult = tng_query($query);

		//if( file_exists( $defaultphoto2 ) )
			//unlink( $defaultphoto2 );
	}
	$repoID2 = "";
	$r2row = "";
	adminwritelog( $admtext['merge'] . ": $tree/$repoID2 => $repoID1" );
}

$helplang = findhelp("repositories_help.php");

tng_adminheader( $admtext['merge'], $flags );
?>
<script type="text/javascript" src="js/selectutils.js"></script>
<script type="text/javascript">
var tnglitbox;
function validateForm( ) {
	var rval = true;
	
	if( document.form1.repoID1.value == '' || document.form1.repoID2.value == '' || document.form1.repoID1.value == document.form1.repoID2.value )
		rval = false;
	else
		rval = confirm( '<?php echo $admtext['confirmmergerepos']; ?>' );

	return rval;
}

function switchrepositories() {
	var formname = document.form1;
	
	if( formname.repoID1.value && formname.repoID2.value ) {
		var temp = formname.repoID1.value;
		
		formname.repoID1.value = formname.repoID2.value;
		formname.repoID2.value = temp;
		
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

	$repotabs['0'] = array(1,"admin_repositories.php",$admtext['search'],"findrepo");
	$repotabs['1'] = array($allow_add,"admin_newrepo.php",$admtext['addnew'],"addrepo");
	$repotabs['3'] = array($allow_edit && $allow_delete,"admin_mergerepos.php",$admtext['merge'],"merge");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/repositories_help.php#merge');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($repotabs,"merge",$innermenu);
	echo displayHeadline($admtext['repositories'] . " &gt;&gt; " . $admtext['merge'], "img/repos_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">
	<div class="normal"><em><?php echo $admtext['choosemergerepos']; ?></em><br/><br/>
	<form action="admin_mergerepos.php" method="post" name="form1" id="form1" >
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
$mergeclass = !empty($repoID1) && !empty($repoID2) ? "class=\"btn\"" : "class=\"disabled\" disabled";
?>
				</select>
			</td>
		</tr>
		<tr><td></td></tr>
	</table><br/>
	<table class="normal">
		<tr>
			<td><div style="float:left"><?php echo $admtext['repoid']; ?> 1: <input type="text" name="repoID1" id="repoID1" size="10" value="<?php if( isset($repoID1) ) echo $repoID1; ?>"> &nbsp;<?php echo $admtext['text_or']; ?>&nbsp;</div>
			<a href="#" onclick="return findItem('R','repoID1','reponame1',document.form1.tree.options[document.form1.tree.selectedIndex].value);" title="<?php echo $admtext['find']; ?>" class="smallicon admin-find-icon"></a></td>
			<td width="80">&nbsp;</td>
			<td><div style="float:left"><?php echo $admtext['repoid']; ?> 2: <input type="text" name="repoID2" id="repoID2" size="10" value="<?php if( isset($repoID2) ) echo $repoID2; ?>"> &nbsp;<?php echo $admtext['text_or']; ?>&nbsp;</div>
			<a href="#" onclick="return findItem('R','repoID2','reponame2',document.form1.tree.options[document.form1.tree.selectedIndex].value);" title="<?php echo $admtext['find']; ?>" class="smallicon admin-find-icon"></a></td>
		</tr>
	    <tr>
            <td id="reponame1"><?php if(isset($r1row['reponame'])) echo truncateIt($r1row['reponame'],75); ?></td>
            <td width="80"></td>
            <td id="reponame2"><?php if(isset($r2row['reponame'])) echo truncateIt($r2row['reponame'],75); ?></td>
        </tr>
</table><br/>
	<table>
		<tr>
			<td colspan="3"><span class="normal"><strong><?php echo $admtext['otheroptions']; ?></strong></span></td>
		</tr>
		<tr>
			<td>
				<span class="normal">
				<input type="checkbox" name="ccombinenotes" value="yes"<?php if( isset($ccombinenotes) && $ccombinenotes == "yes" ) echo " checked"; ?>> <?php echo $admtext['combinenotesonly']; ?><br/>
				<input type="checkbox" name="ccombineextras" value="yes"<?php if( isset($ccombineextras) && $ccombineextras == "yes" ) echo " checked"; ?>> <?php echo $admtext['combineextras']; ?>
				</span>
			</td>
		</tr>
	</table><br/>
	<input type="submit" class="btn" value="<?php echo $admtext['nextmatch']; ?>" name="mergeaction">
	<input type="submit" class="btn" value="<?php echo $admtext['nextdup']; ?>" name="mergeaction">
	<input type="submit" class="btn" value="<?php echo $admtext['comprefresh']; ?>" name="mergeaction">
	<input type="submit" class="btn" value="<?php echo $admtext['mswitch']; ?>" name="mergeaction" onClick="document.form1.mergeaction.value='<?php echo $admtext['comprefresh']; ?>'; return switchrepositories();">
	<input type="submit" <?php echo $mergeclass; ?> value="<?php echo $admtext['merge']; ?>" name="mergeaction" onClick="return validateForm();">
	<br/><br/>
	<table cellpadding="3" cellspacing="1" border="0"  width="100%" class="normal">
<?php
	if( is_array( $r1row ) ) {
		$eventlist = array();
		echo "<tr>\n";
		echo "<td colspan=\"3\"><strong class=\"subhead\">{$admtext['repo']} 1 | <a href=\"\" onclick=\"window.open('admin_editrepo.php?repoID={$r1row['repoID']}&amp;tree=$tree&amp;cw=1');return false;\">{$admtext['edit']}</a></strong></td>\n";
		if( is_array( $r2row ) ) {
			echo "<td colspan=\"3\"><strong class=\"subhead\">{$admtext['repo']} 2 | <a href=\"\" onclick=\"window.open('admin_editrepo.php?repoID={$r2row['repoID']}&amp;tree=$tree&amp;cw=1');return false;\">{$admtext['edit']}</a></strong></td>\n";

			$query = "SELECT display, eventdate, eventplace, info, $events_table.eventtypeID as eventtypeID, $events_table.eventID as eventID FROM $events_table, $eventtypes_table WHERE persfamID = \"{$r2row['repoID']}\" AND gedcom = \"$tree\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID ORDER BY ordernum";
			$evresult = tng_query($query);
			$eventcount = tng_num_rows( $evresult );
		
			if( $evresult && $eventcount ) {
				while ( $event = tng_fetch_assoc( $evresult ) ) {
					$ekey = $event['eventID'];
					$ename = "event$ekey";
					$r2row[$ename] .= getEvent( $event );
					if($eventlist[$ekey])
						$eventlist[$ekey] .= "::" . "{$event['eventtypeID']}_{$event['eventID']}";
					else
						$eventlist[$ekey] = "{$event['eventtypeID']}_{$event['eventID']}";
				}
				tng_free_result($evresult);
			}
		}
		echo "</tr>\n";
		doRow( "repoID", "repoid", "" );
		doRow( "reponame", "name", "r2reponame" );
		doRow( "addressID", "address", "r2addressID" );
		$query = "SELECT display, eventdate, eventplace, info, $events_table.eventtypeID as eventtypeID, $events_table.eventID as eventID FROM $events_table, $eventtypes_table WHERE persfamID = \"{$r1row['repoID']}\" AND gedcom = \"$tree\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID ORDER BY ordernum";
		$evresult = tng_query($query);
		$eventcount = tng_num_rows( $evresult );

		if( $evresult && $eventcount ) {
			while ( $event = tng_fetch_assoc( $evresult ) ) {
				$ekey = $event['eventID'];
				$ename = "event$ekey";
				$r1row[$ename] .= getEvent( $event );
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
	else echo "<tr><td><span class=\"normal\">{$admtext['nomatches']}</span></td></tr>";
?>
	</table>
<?php
if( !empty($repoID1) || !empty($repoID2) ) {
?>
	<br/>
	<input type="submit" class="btn" value="<?php echo $admtext['nextmatch']; ?>" name="mergeaction">
	<input type="submit" class="btn" value="<?php echo $admtext['nextdup']; ?>" name="mergeaction">
	<input type="submit" class="btn" value="<?php echo $admtext['comprefresh']; ?>" name="mergeaction">
	<input type="submit" class="btn" value="<?php echo $admtext['mswitch']; ?>" name="mergeaction" onClick="document.form1.mergeaction.value='<?php echo $admtext['comprefresh']; ?>'; return switchrepositories();">
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