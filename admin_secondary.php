<?php
include("begin.php");
include("adminlib.php");
$textpart = "secondary";
//include("getlang.php");
include("$mylanguage/admintext.php");

include($subroot . "importconfig.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

require("adminlog.php");

$helplang = findhelp("second_help.php");

setcookie("tng_sec_post[tree]", $tree, 0);

tng_adminheader( $admtext['secondary'], $flags );
?>
</head>

<?php
	echo tng_adminlayout();

	$datatabs[0] = array(1,"admin_dataimport.php",$admtext['import'],"import");
	$datatabs[1] = array(1,"admin_export.php",$admtext['export'],"export");
	$datatabs[2] = array(1,"admin_secondmenu.php",$admtext['secondary'],"second");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/second_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($datatabs,"second",$innermenu);
	echo displayHeadline($admtext['datamaint'] . " &gt;&gt; " . $admtext['secondary'] . " &gt;&gt; " . $secaction, "img/data_icon.gif", $menu, (isset($message) ? $message : ""));
?>
<div class="admin-main">
	<div class="databack admin-block">

<?php
@set_time_limit(0);
$wherestr = $wherestr2 = "";
if( $secaction == $admtext['sortchildren'] ) {
	echo "<h2>" . $admtext['sortingchildren'] . "</h2>";
	echo $admtext['families'] . ":<br/>\n";
	$fcount = 0;
	if( $tree != "--all--" ) {
		$wherestr = "WHERE $families_table.gedcom = \"$tree\"";
		$wherestr2 = "AND $children_table.gedcom = \"$tree\"";
	}
	$query = "SELECT familyID, gedcom FROM $families_table $wherestr";
	$result = tng_query($query);
	while( $family = tng_fetch_assoc( $result ) ) {
		$query = "SELECT $children_table.ID as ID, IF(birthdatetr !='0000-00-00',birthdatetr,altbirthdatetr) as birth FROM $children_table, $people_table 
			WHERE $children_table.familyID = \"{$family['familyID']}\" AND $people_table.personID = $children_table.personID AND $people_table.gedcom = $children_table.gedcom $wherestr2
			ORDER BY birth, ordernum";
		$fresult = tng_query($query);
		$order = 0;
		while( $child = tng_fetch_assoc( $fresult ) ) {
			$order++;
			$query = "UPDATE $children_table SET ordernum=\"$order\" WHERE ID=\"{$child['ID']}\"";
			$cresult = tng_query($query);
		}
		$fcount++;
		if( $fcount % 100 == 0 ) {
			echo "<strong>$fcount</strong> ";
		}
		tng_free_result( $fresult );
	}
	tng_free_result( $result );
	echo "<br/><br/>{$admtext['finished']}<br/>";
}
elseif( $secaction == $admtext['sortspouses'] ) {

	echo "<h2>" . $admtext['sortingspouses'] . "</h2>";
	echo $admtext['people'] . ":<br/>\n";
	$fcount = 0;
	if( $tree != "--all--" ) {
		$wherestr = " AND $families_table.gedcom = \"$tree\"";
	}
	//first do husbands
	$query = "SELECT personID, $families_table.gedcom as gedcom FROM $families_table, $people_table WHERE $people_table.personID = $families_table.husband AND $people_table.gedcom = $families_table.gedcom $wherestr";
	$result = tng_query($query);
	while( $husband = tng_fetch_assoc( $result ) ) {
		$query = "SELECT ID FROM $families_table 
			WHERE husband = \"{$husband['personID']}\" AND gedcom = \"{$husband['gedcom']}\"
			ORDER BY marrdatetr, husborder";
		$fresult = tng_query($query);
		$order = 0;
		while( $spouse = tng_fetch_assoc( $fresult ) ) {
			$order++;
			$query = "UPDATE $families_table SET husborder=\"$order\" WHERE ID=\"{$spouse['ID']}\"";
			$cresult = tng_query($query);
		}
		$fcount++;
		if( $fcount % 100 == 0 ) {
			echo "<strong>$fcount</strong> ";
		}
		tng_free_result( $fresult );
	}
	tng_free_result( $result );
	
	//now do wives
	$query = "SELECT personID, $families_table.gedcom as gedcom FROM $families_table, $people_table WHERE $people_table.personID = $families_table.wife AND $people_table.gedcom = $families_table.gedcom $wherestr";
	$result = tng_query($query);
	while( $wife = tng_fetch_assoc( $result ) ) {
		$query = "SELECT ID FROM $families_table 
			WHERE wife = \"{$wife['personID']}\" AND gedcom = \"{$wife['gedcom']}\"
			ORDER BY marrdatetr, wifeorder";
		$fresult = tng_query($query);
		$order = 0;
		while( $spouse = tng_fetch_assoc( $fresult ) ) {
			$order++;
			$query = "UPDATE $families_table SET wifeorder=\"$order\" WHERE ID=\"{$spouse['ID']}\"";
			$cresult = tng_query($query);
		}
		$fcount++;
		if( $fcount % 100 == 0 ) {
			echo "<strong>$fcount</strong> ";
		}
		tng_free_result( $fresult );
	}
	tng_free_result( $result );
	echo "<br/><br/>{$admtext['finished']}<br/>";
}
elseif( $secaction == $admtext['creategendex'] ) {
	//create gendex file
	function getVitals ($person) {
		if( $person['birthdate'] ) {
			$info = $person['birthdate'] . "|" . $person['birthplace'] . "|";
		}
		else {
			$info = $person['altbirthdate'] . "|" . $person['altbirthplace'] . "|";
		}
		if( $person['deathdate'] ) {
			$info .= $person['deathdate'] . "|" . $person['deathplace'] . "|";
		}
		else {
			$info .= $person['burialdate'] . "|" . $person['burialplace'] . "|";
		}
		return $info;
	}
	echo "<h2>" . $admtext['creatinggendex'] . "</h2>";
	if( $tree == "--all--" ) {
		$gendexout = "$rootpath$gendexfile/gendex.txt";
		$gendexURL = "$tngdomain/$gendexfile/gendex.txt";
	}
	else {
		$wherestr = "WHERE gedcom = \"$tree\"";
		$gendexout = $tree ? "$rootpath$gendexfile/$tree.txt" : "$rootpath$gendexfile/blanktree.txt";
		$gendexURL = $tree ? "$tngdomain/$gendexfile/$tree.txt" : "$tngdomain/$gendexfile/blanktree.txt";
	}
	$query = "SELECT personID, firstname, lnprefix, lastname, living, private, birthdate, birthplace, altbirthdate, altbirthplace, deathdate, deathplace, burialdate, burialplace, gedcom FROM $people_table $wherestr ORDER BY lastname, firstname";
	$result = tng_query($query);
	if( $result ) {
		//open file (overwrite any contents)
		$fp2 = @fopen( $gendexout, "w" );
		if( !$fp2 ) { die ( $admtext['cannotopen'] . " $gendexout" ); }

		flock( $fp2, LOCK_EX );
		$tcount = 0;
		while( $person = tng_fetch_assoc( $result ) ) {
			if( !$person['private'] && (!$person['living'] || $nonames != 1) ) {
				$uclast = tng_strtoupper( trim( $person['lnprefix'] . " " . $person['lastname'] ) );
				$person['lastname'] = $uclast;
				$info = $person['living'] ? "||||" : getVitals( $person );
				if( $person['living'] && $nonames == 2 )
					$line = $person['personID'] . "&amp;tree={$person['gedcom']}|$uclast|" . initials( $person['firstname'] ) . " /$uclast/|$info\n";
				else
					$line = $person['personID'] . "&amp;tree={$person['gedcom']}|$uclast|{$person['firstname']} /$uclast/|$info\n";
				if($session_charset == "UTF-8") $line = mb_convert_encoding( $line, 'ISO-8859-1', 'UTF-8' );
				fwrite( $fp2, "$line" );

				$tcount++;
				if( $tcount % 100 == 0 ) {
					echo "<strong>$tcount</strong> ";
				}
			}
		}
		flock( $fp2, LOCK_UN );
		fclose( $fp2 );
	}
	tng_free_result( $result );
?>
	<br><br>
<?php
	echo "<p class=\"normal\">" . $admtext['finishedgendex'] . "<br />\n";
	echo $admtext['filename'] . ": $gendexURL</p>\n";
?>
	<p class="normal"><?php echo $admtext['postgdx']; ?>:<br/>
		<!--&raquo; <a href="https://www.gendexnetwork.org" target="_blank">GenDexNetwork</a><br/>-->
		&raquo; <a href="https://www.familytreeseeker.com" target="_blank">FamilyTreeSeeker.com</a>
	</p>
<?php
}
elseif( $secaction == $admtext['tracklines'] ) {
	echo "<h2>" . $admtext['trackinglines'] . "</h2>";
	echo $admtext['families'] . ":<br/>\n";

	$query = "UPDATE $children_table SET haskids = 0";
	if( $tree != "--all--" )
		$query .= " WHERE gedcom = \"$tree\"";
	$result2 = tng_query($query);

	$fcount = 0;
	if( $tree != "--all--" )
		$wherestr = "AND $families_table.gedcom = \"$tree\"";
	$query = "SELECT distinct ($families_table.familyID), husband, wife, $families_table.gedcom as gedcom FROM ($children_table, $families_table) WHERE $families_table.familyID = $children_table.familyID AND $families_table.gedcom = $children_table.gedcom $wherestr";
	$result = tng_query($query);
	while( $family = tng_fetch_assoc( $result ) ) {
		if( $family['husband'] != "" ) {
			$query = "UPDATE $children_table SET haskids = 1 WHERE personID = \"{$family['husband']}\" AND gedcom = \"{$family['gedcom']}\"";
			$result2 = tng_query($query);
		}
		if( $family['wife'] != "" ) {
			$query = "UPDATE $children_table SET haskids = 1 WHERE personID = \"{$family['wife']}\" AND gedcom = \"{$family['gedcom']}\"";
			$result2 = tng_query($query);
		}
		$fcount++;
		if( $fcount % 100 == 0 ) {
			echo "<strong>$fcount</strong> ";
		}
	}
	tng_free_result( $result );
	echo "<br/><br/>{$admtext['finishedtracking']}<br/>";
}
elseif( $secaction == $admtext['relabelbranches'] ) {
	$fcount = 0;
	echo "<h2>" . $admtext['relabeling'] . "</h2>";
	if( $tree != "--all--" )
		$wherestr = "WHERE gedcom = \"$tree\"";
	$query = "SELECT branch, persfamID, gedcom FROM $branchlinks_table $wherestr";
	$result = tng_query($query);
	while( $branch = tng_fetch_assoc( $result ) ) {
		$success = 0;
		if( substr( $branch['persfamID'], 0, 1 ) != "F" ) {
			$query = "SELECT branch FROM $people_table WHERE personID = \"{$branch['persfamID']}\" AND gedcom = \"{$branch['gedcom']}\"";
			$result2 = tng_query($query);
			if( tng_num_rows( $result2 ) ) {
				$row = tng_fetch_assoc( $result2 );
				$oldbranches = explode( ",", $row['branch'] );
				if( $row['branch'] ) {
					if( in_array( $branch['branch'], $oldbranches ) )
						$label = $row['branch'];
					else
						$label = $row['branch'] . "," . $branch['branch'];
				}
				else
					$label = $branch['branch'];
				$query = "UPDATE $people_table SET branch = \"$label\" WHERE personID = \"{$branch['persfamID']}\" AND gedcom = \"{$branch['gedcom']}\"";
				$result3 = tng_query($query);
				$success = 1;
			}
			tng_free_result( $result2 );
		}
		if( !$success ) {
			$query = "SELECT branch FROM $families_table WHERE familyID = \"{$branch['persfamID']}\" AND gedcom = \"{$branch['gedcom']}\"";
			$result2 = tng_query($query);
			if( tng_num_rows( $result2 ) ) {
				$row = tng_fetch_assoc( $result2 );
				$oldbranches = explode( ",", $row['branch'] );
				if( $row['branch'] ) {
					if( in_array( $branch['branch'], $oldbranches ) )
						$label = $row['branch'];
					else
						$label = $row['branch'] . "," . $branch['branch'];
				}
				else
					$label = $branch['branch'];
				$query = "UPDATE $families_table SET branch = \"$label\" WHERE familyID = \"{$branch['persfamID']}\" AND gedcom = \"{$branch['gedcom']}\"";
				$result3 = tng_query($query);
				$success = 1;
			}
			tng_free_result( $result2 );
		}
		if( $success ) {
			$fcount++;
			if( $fcount % 100 == 0 ) {
				echo "<strong>$fcount</strong> ";
			}
		}
	}
	tng_free_result( $result );
}
elseif( $secaction == $admtext['evalmedia'] ) {
	echo "<h2>" . $admtext['evaluating'] . "...</h2>";
	//loop through each media type
	$query = "SELECT * FROM $mediatypes_table ORDER BY ordernum, display";
	$result = @tng_query($query);

	while($row = tng_fetch_assoc($result)) {
		$query2 = "SELECT count(*) as counter FROM $media_table WHERE mediatypeID = \"{$row['mediatypeID']}\"";
		$result2 = @tng_query($query2);
		$row2 = tng_fetch_assoc($result2);
		$display = $row['display'] ? $row['display'] : $admtext[$row['mediatypeID']];
		echo "$display: " . number_format($row2['counter']);
		if(!$row2['counter']) {
			echo " ... " . $admtext['disabled'];
			$disabled = 1;
		}
		else {
			$disabled = 0;
		}
		$query3 = "UPDATE $mediatypes_table SET disabled=\"$disabled\" where mediatypeID=\"{$row['mediatypeID']}\"";
		$result3 = @tng_query($query3);
		echo "<br/>\n";
		tng_free_result($result2);
	}
	tng_free_result($result);
	echo "<br/><br/>{$admtext['finished']}<br/>";
}
elseif( $secaction == $admtext['refreshliving'] ) {
	echo "<h2>" . $admtext['refreshliving'] . "...</h2>";
	$changedToLiving = $changedToDeceased = $counted = 0;

	if( $tree != "--all--" )
		$wherestr = "WHERE gedcom = \"$tree\"";

	$query = "SELECT ID, birthdate, birthdatetr, altbirthdatetr, deathdate, deathplace, deathdatetr, burialdate, burialplace, burialdatetr, living, personID, gedcom FROM $people_table $wherestr";
	$result = tng_query($query);
	while($row = tng_fetch_assoc($result)) {
		$birth = $row['birthdatetr'] != "0000-00-00" ? $row['birthdatetr'] : $row['altbirthdatetr'];
		$death = $row['deathdatetr'] != "0000-00-00" ? $row['deathdatetr'] : $row['burialdatetr'];

		$living = -1;
		$counted++;

		//if not living
		if(!$row['living']) {
			//if there's no death date
			if(!$row['deathdate'] && !$row['deathplace'] && !$row['burialdate'] && !$row['burialplace'] && $death == "0000-00-00") { //if marked as deceased
				//if there's a birth
				if($birth != "0000-00-00") {
					$birthyear = substr($birth,0,4);
					if( $tngimpcfg['maxlivingage'] && date( "Y" ) - $birthyear < $tngimpcfg['maxlivingage'] )
						$living = 1;
				}
				//no death and no birth
				elseif($tngimpcfg['livingreqbirth'])
					$living = 1;
			}
			//there is a death
			elseif($death != "0000-00-00") {
				$deathyear = substr($death,0,4);
				if($tngimpcfg['maxdecdyrs'] && strtotime( "-{$tngimpcfg['maxdecdyrs']} years" ) < strtotime($death) ) 
					$living = 1;
			}
		}
		else { //marked as living
			//there is a death
			if($death != "0000-00-00") {
				$deathyear = substr($death,0,4);
				if(!$tngimpcfg['maxdecdyrs'] || strtotime( "-{$tngimpcfg['maxdecdyrs']} years" ) >= strtotime($death) )
					$living = 0;
			}
			//no death
			elseif(!$row['deathdate'] && !$row['deathplace'] && !$row['burialdate'] && !$row['burialplace']) {
				if($birth != "0000-00-00") {
					$birthyear = substr($birth,0,4);
					if( !$tngimpcfg['maxlivingage'] || date( "Y" ) - $birthyear >= $tngimpcfg['maxlivingage'] )
						$living = 0;
				}
				//no death and no birth
				elseif(!$tngimpcfg['livingreqbirth'])
					$living = 0;
			}
		}

		if($living >= 0) {
			$query2 = "UPDATE $people_table SET living = \"$living\" WHERE ID = \"{$row['ID']}\"";
			$result2 = tng_query($query2);
			if($living) {
				$changedToLiving++;
				echo "+<a href=\"admin_editperson.php?personID={$row['personID']}&amp;tree={$row['gedcom']}\">{$row['personID']}</a> ";
				//mark the family as living too
				$query2 = "UPDATE $families_table SET living = \"1\" WHERE gedcom = \"{$row['gedcom']}\" AND (husband = \"{$row['personID']}\" OR wife = \"{$row['personID']}\")";
				$result2 = tng_query($query2);
			}
			else {
				$changedToDeceased++;
				echo "-<a href=\"admin_editperson.php?personID={$row['personID']}&amp;tree={$row['gedcom']}\">{$row['personID']}</a> ";
			}
		}
		if($counted % 100 == 0) {
			echo ".";
			if($counted % 1000 == 0)
				echo "I$counted";
		}
	}
	tng_free_result($result);
	echo "<br/><br/>{$admtext['finished']}<br/>$changedToDeceased {$admtext['chtodeceased']} (-), $changedToLiving {$admtext['chtoliving']} (+).";
}
elseif( $secaction == $admtext['makeprivate'] ) {
	echo "<h2>" . $admtext['makeprivate'] . "...</h2>";

	$peopleMadePrivate = 0;
	if($tngimpcfg['maxprivyrs']) {
		$familiesMadePrivate = $counted = 0;

		if( $tree != "--all--" )
			$wherestr = "AND gedcom = \"$tree\"";

		$query = "SELECT ID, personID, gedcom, deathdatetr, burialdatetr, private FROM $people_table WHERE private != \"1\" AND living != \"1\" $wherestr";
		$result = tng_query($query);

		$today = date('Y');

		while($row = tng_fetch_assoc($result)) {
			$death = $row['deathdatetr'] != "0000-00-00" ? $row['deathdatetr'] : $row['burialdatetr'];
			$private = 0;
			$counted++;

			//if death is blank, skip
			if(!$row['private'] && $death != "0000-00-00"  && strtotime( "-{$tngimpcfg['maxprivyrs']} years" ) < strtotime($death)) {
				$query2 = "UPDATE $people_table SET private = \"1\" WHERE ID = \"{$row['ID']}\"";
				$result2 = tng_query($query2);

				$query2 = "UPDATE $families_table SET private = \"1\" WHERE gedcom = \"{$row['gedcom']}\" AND (husband = \"{$row['personID']}\" OR wife = \"{$row['personID']}\")";
				$result2 = tng_query($query2);

				$peopleMadePrivate++;
			}
			if($counted % 100 == 0) {
				echo "I$counted ";
			}
		}
		tng_free_result($result);
	}

	echo "<br/><br/>{$admtext['finished']}<br/>$peopleMadePrivate {$admtext['chtoprivate']}.";
}

adminwritelog( $admtext['secondary'] . ": $secaction" );
?>

<p class="normal">&raquo; <a href="admin_secondmenu.php"><?php echo $admtext['backtosecondary']; ?></a></p>

</div></div>

<?php 
echo tng_adminfooter();
?>