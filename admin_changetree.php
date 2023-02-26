<?php
include("begin.php");
include("adminlib.php");
$textpart = "trees";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

//permissions
if( $assignedtree || !$allow_edit ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

switch($entity) {
	case "person":
		$url = "admin_editperson.php?personID=$newID&tree=$newtree";
		
		if($operation == "0") {
			$query = "UPDATE $people_table SET gedcom=\"$newtree\", personID=\"$newID\" WHERE gedcom=\"$oldtree\" AND personID=\"$entityID\"";
			$result = tng_query($query);

			$query = "UPDATE $mostwanted_table SET gedcom=\"$newtree\", personID=\"$newID\" WHERE gedcom=\"$oldtree\" AND personID=\"$entityID\"";
			$result = tng_query($query);

			$query = "UPDATE $temp_events_table SET gedcom=\"$newtree\", personID=\"$newID\" WHERE gedcom=\"$oldtree\" AND personID=\"$entityID\"";
			$result = tng_query($query);

			$query = "UPDATE $users_table SET mygedcom=\"$newtree\", personID=\"$newID\" WHERE mygedcom=\"$oldtree\" AND personID=\"$entityID\"";
			$result = tng_query($query);

			$query = "UPDATE $families_table SET husband=\"\" WHERE gedcom=\"$oldtree\" AND husband=\"$entityID\"";
			$result = tng_query($query);

			$query = "UPDATE $families_table SET wife=\"\" WHERE gedcom=\"$oldtree\" AND wife=\"$entityID\"";
			$result = tng_query($query);

			$query = "DELETE FROM $branchlinks_table WHERE gedcom=\"$oldtree\" AND persfamID=\"$entityID\"";
			$result = tng_query($query);

			$query = "DELETE FROM $citations_table WHERE gedcom=\"$oldtree\" AND persfamID=\"$entityID\"";
			$result = tng_query($query);

			$query = "DELETE FROM $children_table WHERE gedcom=\"$oldtree\" AND personID=\"$entityID\"";
			$result = tng_query($query);

			$query = "DELETE FROM $assoc_table WHERE gedcom=\"$oldtree\" AND (personID=\"$entityID\" OR passocID=\"$entityID\")";
			$result = tng_query($query);
		}
		else {
			$query = "SELECT * FROM $people_table WHERE gedcom=\"$oldtree\" AND personID=\"$entityID\"";
			$result = tng_query($query);
			$row = tng_fetch_assoc($result);
			tng_free_result($result);
			
			$newrow = array();
			foreach($row as $key => $value) {
				$newrow[$key] = addslashes($value);
			}
			$row = $newrow;
			$query = "INSERT INTO $people_table (personID,firstname,lnprefix,lastname,nickname,prefix,suffix,title,nameorder,living,private,birthdate,birthdatetr,birthplace,sex,altbirthtype,altbirthdate,
				altbirthdatetr,altbirthplace,deathdate,deathdatetr,deathplace,burialdate,burialdatetr,burialplace,burialtype,baptdate,baptdatetr,baptplace,confdate,confdatetr,confplace,initdate,initdatetr,
				initplace,endldate,endldatetr,endlplace,changedate,gedcom,branch,changedby,famc,metaphone,edituser,edittime) 
				VALUES(\"$newID\",\"{$row['firstname']}\",\"{$row['lnprefix']}\",\"{$row['lastname']}\",\"{$row['nickname']}\",\"{$row['prefix']}\",\"{$row['suffix']}\",\"{$row['title']}\",\"{$row['nameorder']}\",
					\"{$row['living']}\",\"{$row['private']}\",\"{$row['birthdate']}\",\"{$row['birthdatetr']}\",\"{$row['birthplace']}\",\"{$row['sex']}\",\"{$row['altbirthtype']}\",\"{$row['altbirthdate']}\",
					\"{$row['altbirthdatetr']}\",\"{$row['altbirthplace']}\",\"{$row['deathdate']}\",\"{$row['deathdatetr']}\",\"{$row['deathplace']}\",\"{$row['burialdate']}\",\"{$row['burialdatetr']}\",
					\"{$row['burialplace']}\",\"{$row['burialtype']}\",\"{$row['baptdate']}\",\"{$row['baptdatetr']}\",\"{$row['baptplace']}\",\"{$row['confdate']}\",\"{$row['confdatetr']}\",
					\"{$row['confplace']}\",\"{$row['initdate']}\",\"{$row['initdatetr']}\",\"{$row['initplace']}\",\"{$row['endldate']}\",\"{$row['endldatetr']}\",\"{$row['endlplace']}\",
					\"{$row['changedate']}\",\"$newtree\",\"\",\"$currentuser\",\"{$row['famc']}\",\"{$row['metaphone']}\",\"{$row['edituser']}\",\"{$row['edittime']}\")";
			$result = tng_query($query);
		}

		break;
	case "source":
		$url = "admin_editsource.php?sourceID=$newID&tree=$newtree";

		if($operation == "0") {
			$query = "UPDATE $sources_table SET gedcom=\"$newtree\", sourceID=\"$newID\" WHERE gedcom=\"$oldtree\" AND sourceID=\"$entityID\"";
			$result = tng_query($query);

			$query = "DELETE FROM $citations_table WHERE gedcom=\"$oldtree\" AND persfamID=\"$entityID\"";
			$result = tng_query($query);
		}
		else {
			$query = "SELECT * FROM $sources_table WHERE gedcom=\"$oldtree\" AND sourceID=\"$entityID\"";
			$result = tng_query($query);
			$row = tng_fetch_assoc($result);
			tng_free_result($result);
			$newrow = array();
			foreach($row as $key => $value) {
				$newrow[$key] = addslashes($value);
			}
			$row = $newrow;
			
			$query = "INSERT INTO $sources_table (sourceID,shorttitle,title,author,callnum,publisher,repoID,actualtext,changedate,gedcom,changedby,type,other,comments) 
				VALUES(\"$newID\",\"{$row['shorttitle']}\",\"{$row['title']}\",\"{$row['author']}\",\"{$row['callnum']}\",\"{$row['publisher']}\",\"\",\"{$row['actualtext']}\",\"{$row['changedate']}\",
					\"$newtree\",\"{$row['currentuser']}\",\"{$row['type']}\",\"{$row['other']}\",\"{$row['comments']}\")";
			$result = tng_query($query);
		}

		break;
	case "repo":
		$url = "admin_editrepo.php?repoID=$newID&tree=$newtree";

		if($operation == "0") {
			$query = "UPDATE $repositories_table SET gedcom=\"$newtree\", repoID=\"$newID\" WHERE gedcom=\"$oldtree\" AND repoID=\"$entityID\"";
			$result = tng_query($query);

			$query = "UPDATE $sources_table SET repoID=\"\" WHERE gedcom=\"$oldtree\" AND repoID=\"$entityID\"";
			$result = tng_query($query);
		}
		else {
			$query = "SELECT * FROM $repositories_table WHERE gedcom=\"$oldtree\" AND repoID=\"$entityID\"";
			$result = tng_query($query);
			$row = tng_fetch_assoc($result);
			tng_free_result($result);
			$newrow = array();
			foreach($row as $key => $value) {
				$newrow[$key] = addslashes($value);
			}
			$row = $newrow;

			if($row['addressID']) {
				$query = "SELECT * FROM $address_table WHERE addressID=\"{$row['addressID']}\"";
				$result = tng_query($query);
				$arow = tng_fetch_assoc($result);
				tng_free_result($result);
				$addressID = tng_insert_id();
				$newrow = array();
				foreach($arow as $key => $value) {
					$newrow[$key] = addslashes($value);
				}
				$arow = $newrow;

				$query = "INSERT INTO $address_table (addressID,address1, address2, city, state, zip, country, gedcom, phone, email, www) 
					VALUES(\"$addressID\",\"{$arow['address1']}\",\"{$arow['address2']}\",\"{$arow['city']}\",\"{$arow['state']}\",\"{$arow['zip']}\",\"{$arow['country']}\",\"{$arow['tree']}\",\"{$arow['phone']}\",\"{$arow['email']}\",\"{$arow['www']}\")";
				$result = tng_query($query);
			}
			else
				$addressID = "";
			
			$query = "INSERT INTO $repositories_table (repoID,reponame,addressID,changedate,gedcom,changedby) 
				VALUES(\"$newID\",\"{$row['reponame']}\",\"{$addressID}\",\"{$row['changedate']}\",\"$newtree\",\"{$row['currentuser']}\")";
			$result = tng_query($query);
		}

		break;
}

if($operation == "0") {
	$query = "SELECT addressID FROM $events_table WHERE gedcom=\"$oldtree\" AND persfamID=\"$entityID\" AND addressID!=\"\"";
	$result = tng_query($query);
	while($row = tng_fetch_assoc($result)) {
		$query = "UPDATE $address_table SET gedcom=\"$newtree\" WHERE addressID=\"{$row['addressID']}\"";
		$result2 = tng_query($query);
	}
	tng_free_result($result);

	$query = "UPDATE $events_table SET gedcom=\"$newtree\", persfamID=\"$newID\" WHERE gedcom=\"$oldtree\" AND persfamID=\"$entityID\"";
	$result = tng_query($query);

	$query = "UPDATE $album2entities_table SET gedcom=\"$newtree\", entityID=\"$newID\" WHERE gedcom=\"$oldtree\" AND entityID=\"$entityID\"";
	$result = tng_query($query);

	$query = "UPDATE $medialinks_table SET gedcom=\"$newtree\", personID=\"$newID\" WHERE gedcom=\"$oldtree\" AND personID=\"$entityID\"";
	$result = tng_query($query);

	$query = "SELECT xnoteID FROM $notelinks_table WHERE gedcom=\"$oldtree\" AND persfamID=\"$entityID\" AND xnoteID!=\"\"";
	$result = tng_query($query);
	while($row = tng_fetch_assoc($result)) {
		$query = "UPDATE $xnotes_table SET gedcom=\"$newtree\" WHERE ID=\"{$row['xnoteID']}\"";
		$result2 = tng_query($query);
	}
	tng_free_result($result);

	$query = "UPDATE $notelinks_table SET gedcom=\"$newtree\", persfamID=\"$newID\" WHERE gedcom=\"$oldtree\" AND persfamID=\"$entityID\"";
	$result = tng_query($query);
}
else {
	//insert copies of events, notelinks and notes
}

header( "Location: $url" );
?>