<?php
include("begin.php");
include("adminlib.php");
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include($cms['tngpath'] . "checklogin.php");

if( !$allow_media_edit && !$allow_media_add && !$allow_media_delete ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$json = false;
initMediaTypes();

function reorderMedia( $query, $plink ) {
	global $admtext, $medialinks_table, $media_table, $type, $album2entities_table;

	$ptree = $plink['gedcom'];
	$eventID = isset($plink['eventID']) ? $plink['eventID'] : "";
	$result3 = tng_query($query);
	while( $personrow = tng_fetch_assoc( $result3 ) ) {
		$counter = 1;
		if($type == "media") {
			$query = "SELECT medialinkID FROM ($medialinks_table, $media_table) WHERE personID = \"{$personrow['personID']}\" AND $medialinks_table.gedcom = \"$ptree\" AND $media_table.mediaID = $medialinks_table.mediaID AND eventID = \"$eventID\" AND mediatypeID = \"{$plink['mediatypeID']}\" ORDER BY ordernum";
			$result4 = tng_query($query);

			while( $medialinkrow = tng_fetch_assoc( $result4 ) ) {
				$query = "UPDATE $medialinks_table SET ordernum = \"$counter\" WHERE medialinkID = \"{$medialinkrow['medialinkID']}\"";
				$result5 = tng_query($query);
				$counter++;
			}
			tng_free_result( $result4 );
		}
		else {
			//do for albums
			$query = "SELECT alinkID FROM $album2entities_table WHERE entityID = \"{$personrow['personID']}\" AND gedcom = \"$ptree\" ORDER BY ordernum";
			$result4 = tng_query($query);

			while( $albumlinkrow = tng_fetch_assoc( $result4 ) ) {
				$query = "UPDATE $album2entities_table SET ordernum = \"$counter\" WHERE alinkID = \"{$albumlinkrow['alinkID']}\"";
				$result5 = tng_query($query);
				$counter++;
			}
			tng_free_result( $result4 );
		}
	}
	tng_free_result( $result3 );
}

function setDefault($tree,$entity,$media,$album) {
	global $albumlinks_table, $medialinks_table, $allow_delete;

	if($album) {
		$query = "UPDATE $albumlinks_table SET defphoto = '' WHERE defphoto = '1' AND albumID = '$album'";
		$result = @tng_query($query);

		$query = "UPDATE $albumlinks_table SET defphoto = '1' WHERE albumID = '$album' AND mediaID = '$media'";
		$result = @tng_query($query);
	}
	else {
		$query = "UPDATE $medialinks_table SET defphoto = '' WHERE defphoto = '1' AND personID = '$entity' AND gedcom = '$tree'";
		$result = @tng_query($query);

		$query = "UPDATE $medialinks_table SET defphoto = '1' WHERE personID = '$entity' AND gedcom = '$tree' AND mediaID = '$media'";
		$result = @tng_query($query);
	}
}

$rval = 1;
switch($action) {
	case "order":
		$links = explode(",",$sequence);
		$count = count($links);
		if($album) {
			for($i = 0; $i < $count; $i++) {
				$order = $i+1;
				$query = "UPDATE $albumlinks_table SET ordernum=\"$order\" WHERE albumlinkID=\"" . $links[$i] . "\"";
				$result = @tng_query($query);
			}
		}
		else {
			for($i = 0; $i < $count; $i++) {
				$order = $i+1;
				$query = "UPDATE $medialinks_table SET ordernum=\"$order\" WHERE medialinkID=\"" . $links[$i] . "\"";
				$result = @tng_query($query);
			}
		}
		break;
	case "alborder":
		$alinks = explode(",",$sequence);
		$count = count($alinks);
		for($i = 0; $i < $count; $i++) {
			$order = $i+1;
			$query = "UPDATE $album2entities_table SET ordernum=\"$order\" WHERE alinkID = \"" . $alinks[$i] . "\"";
			$result = @tng_query($query);
		}
		break;
	case "mworder":
		$links = explode(",",$sequence);
		$count = count($links);
		for($i = 0; $i < $count; $i++) {
			$order = $i+1;
			$query = "UPDATE $mostwanted_table SET ordernum=\"$order\", mwtype=\"$mwtype\" WHERE ID = \"" . $links[$i] . "\"";
			$result = @tng_query($query);
		}
		break;
	case "childorder":
		$clinks = explode(",",$sequence);
		$count = count($clinks);
		for($i = 0; $i < $count; $i++) {
			$order = $i+1;
			$query = "UPDATE $children_table SET ordernum=\"$order\" WHERE familyID = \"$familyID\" AND personID = \"{$clinks[$i]}\" AND gedcom = \"$tree\"";
			$result2 = @tng_query($query);
		}
		break;
	case "parentorder":
		$plinks = explode(",",$sequence);
		$count = count($plinks);
		for($i = 0; $i < $count; $i++) {
			$order = $i+1;
			$query = "UPDATE $children_table SET parentorder=\"$order\" WHERE familyID = \"{$plinks[$i]}\" AND personID = \"$personID\" AND gedcom = \"$tree\"";
			$result2 = @tng_query($query);
		}
		$query = "UPDATE $people_table SET famc=\"{$plinks[0]}\" WHERE personID = \"$personID\" AND gedcom = \"$tree\"";
		$result3 = @tng_query($query);
		break;
	case "spouseorder":
		$slinks = explode(",",$sequence);
		$count = count($slinks);
		for($i = 0; $i < $count; $i++) {
			$order = $i+1;
			$query = "UPDATE $families_table SET $spouseorder=\"$order\" WHERE familyID = \"{$slinks[$i]}\" AND gedcom = \"$tree\"";
			$result2 = @tng_query($query);
		}
		break;
	case "noteorder":
		$nlinks = explode(",",$sequence);
		$count = count($nlinks);
		for($i = 0; $i < $count; $i++) {
			$order = $i+1;
			$query = "UPDATE $notelinks_table SET ordernum=\"$order\" WHERE ID = \"{$nlinks[$i]}\"";
			$result2 = @tng_query($query);
		}
		break;
	case "citeorder":
		$clinks = explode(",",$sequence);
		$count = count($clinks);
		for($i = 0; $i < $count; $i++) {
			$order = $i+1;
			$query = "UPDATE $citations_table SET ordernum=\"$order\" WHERE citationID = \"{$clinks[$i]}\"";
			$result2 = @tng_query($query);
		}
		break;
	case "spouseunlink":
		$query = "SELECT husband, wife FROM $families_table WHERE familyID = \"$familyID\" AND gedcom = \"$tree\"";
		$marriage = tng_query($query);
		$marriagerow = tng_fetch_assoc( $marriage );

		if( $personID == $marriagerow['husband'] ) {
			//$spquery = "SELECT living FROM $people_table WHERE personID = \"$marriagerow[wife]\" AND gedcom = \"$tree\"";
			$delspousestr = "husband = \"\"";
		}
		else if( $personID == $marriagerow['wife'] ) {
			//$spquery = "SELECT living FROM $people_table WHERE personID = \"$marriagerow[husband]\" AND gedcom = \"$tree\"";
			$delspousestr = "wife = \"\"";
		}
		else {
			$spquery = "";
			$delspousestr = "";
		}
		//if( $spquery ) {
			//$spouselive = @tng_query($spquery) or die ($admtext['cannotexecutequery'] . ": $spquery");
			//$spouserow =  tng_fetch_assoc( $spouselive );
			//$spouseliving = $spouserow[living];
		//}
		//else
			//$spouseliving = 0;
		//$familyliving = ($living || $spouseliving) ? 1 : 0;
		if($delspousestr) {
			$query = "UPDATE $families_table SET $delspousestr WHERE familyID = \"$familyID\" AND gedcom = \"$tree\"";
			$spouseresult= @tng_query($query);
		}
		break;
	case "parentunlink":
		$query = "DELETE FROM $children_table WHERE familyID = \"$familyID\" AND personID = \"$personID\" AND gedcom = \"$tree\"";
		$result2 = @tng_query($query);

		$query = "UPDATE $people_table SET famc=\"\" WHERE personID = \"$personID\" AND gedcom = \"$tree\" AND famc=\"$familyID\"";
		$result2 = tng_query($query);
		break;
	case "addchild":
		$haskids = getHasKids($tree, $personID);

   		$query = "INSERT INTO $children_table (familyID,personID,ordernum,gedcom,mrel,frel,haskids,parentorder,sealdate,sealdatetr,sealplace) VALUES (\"$familyID\",\"$personID\",$order,\"$tree\",\"\",\"\",$haskids,0,\"\",\"0000-00-00\",\"\")";
		$result = @tng_query($query);

   		$query = "SELECT husband,wife FROM $families_table WHERE familyID=\"$familyID\" AND gedcom=\"$tree\"";
		$result = @tng_query($query);
		$famrow = tng_fetch_assoc($result);
		if($famrow['husband']) {
			$query = "UPDATE $children_table SET haskids=\"1\" WHERE personID = \"{$famrow['husband']}\" AND gedcom = \"$tree\"";
			$result2 = @tng_query($query);
		}
		if($famrow['wife']) {
			$query = "UPDATE $children_table SET haskids=\"1\" WHERE personID = \"{$famrow['wife']}\" AND gedcom = \"$tree\"";
			$result2 = @tng_query($query);
		}
		tng_free_result($result);

		$query = "UPDATE $people_table SET famc=\"$familyID\" WHERE personID = \"$personID\" AND gedcom = \"$tree\" and famc = \"\"";
		$result = @tng_query($query);

		$rval = "<div class=\"sortrow\" id=\"child_$personID\" style=\"width:500px;clear:both;\"";
		$rval .= " onmouseover=\"jQuery('#unlinkc_$personID').css('visibility','visible');\" onmouseout=\"jQuery('#unlinkc_$personID').css('visibility','hidden');\">\n";
		$rval .= "<table width=\"100%\" cellpadding=\"5\" cellspacing=\"1\"><tr>\n";
		$rval .= "<td class=\"dragarea normal\">";
   		$rval .= "<img src=\"{$cms['tngpath']}img/admArrowUp.gif\" alt=\"\"><br/>" . $admtext['drag'] . "<br/><img src=\"{$cms['tngpath']}img/admArrowDown.gif\" alt=\"\">\n";
		$rval .= "</td>\n";
		$rval .= "<td class=\"lightback normal childblock\">\n";

		$rval .= "<div id=\"unlinkc_$personID\" class=\"smaller hide-right\"><a href=\"#\" onclick=\"return unlinkChild('$personID','child_unlink');\">{$admtext['remove']}</a>";
		if($allow_delete)
			$rval .= " &nbsp; | &nbsp; <a href=\"#\" onclick=\"return unlinkChild('$personID','child_delete');\">{$admtext['text_delete']}</a>";
		$rval .= "</div>";
		$display = str_replace("|","</a>",$display);
		$rval .= "<a href=\"#\" onclick=\"EditChild('$personID');\">$display</div>\n</td>\n</tr>\n</table>\n</div>\n";
		break;
	case "setdef":
		setDefault($tree,$entity,$media,$album);

		$query = "SELECT thumbpath, usecollfolder, mediatypeID FROM $media_table
			WHERE mediaID = \"$media\"";
		$result = @tng_query($query);
		if( $result ) $row = tng_fetch_assoc( $result );
		$thismediatypeID = $row['mediatypeID'];
		$usefolder = $row['usecollfolder'] ? $mediatypes_assoc[$thismediatypeID] : $mediapath;
		tng_free_result($result);

		if( $row['thumbpath'] )
			$photoref = "$usefolder/" . $row['thumbpath'];
		else
			$photoref = $tree ? "$usefolder/$tree.$entity.$photosext" : "$photopath/$entity.$photosext";

		if( file_exists( "$rootpath$photoref" ) ) {
			$photoinfo = @getimagesize( "$rootpath$photoref" );
			if( $photoinfo[1] <= $thumbmaxh ) {
				$photohtouse = $photoinfo[1];
				$photowtouse = $photoinfo[0];
			}
			else {
				$photohtouse = $thumbmaxh;
				$photowtouse = intval( $thumbmaxh * $photoinfo[0] / $photoinfo[1] ) ;
			}
			$rval = "<img src=\"" . str_replace("%2F","/",rawurlencode( $photoref )) . "?" . time() . "\" border=\"1\" alt=\"\" width=\"$photowtouse\" height=\"$photohtouse\" align=\"left\" style=\"margin-right:10px\">";
		}
		break;
	case "setdef2":
		setDefault($tree,$entity,$media,$album);
		break;
	case "setdef3":
		$query = "UPDATE $medialinks_table SET defphoto = '' WHERE defphoto = '1' AND personID = '$entity' AND gedcom = '$tree'";
		$result = @tng_query($query);

		$query = "UPDATE $medialinks_table SET defphoto = '$toggle' WHERE medialinkID=\"$medialinkID\"";
		$result = @tng_query($query);
		break;
	case "deldef":
		//look for old style default, delete if exists
		if($album) {
			$query = "SELECT thumbpath, usecollfolder, mediatypeID, albumlinkID FROM ($media_table, $albumlinks_table)
				WHERE albumID = \"$album\" AND $media_table.mediaID = $albumlinks_table.mediaID AND defphoto = '1'";
		}
		else {
			$query = "SELECT thumbpath, usecollfolder, mediatypeID, medialinkID FROM ($media_table, $medialinks_table)
				WHERE personID = \"$entity\" AND $medialinks_table.gedcom = \"$tree\" AND $media_table.mediaID = $medialinks_table.mediaID AND defphoto = '1'";
		}
		$result = @tng_query($query);
		if( $result ) $row = tng_fetch_assoc( $result );
		
		$thismediatypeID = $row['mediatypeID'];
		$usefolder = $row['usecollfolder'] ? $mediatypes_assoc[$thismediatypeID] : $mediapath;
		@tng_free_result($result);
	
		//$photoref = $tree ? "$usefolder/$tree.$entity.$photosext" : "$photopath/$entity.$photosext";
		//if( file_exists( "$rootpath$photoref" ) ) {
			//@unlink( "$rootpath$photoref" );
		//}
		
		if($album)
			$query = "UPDATE $albumlinks_table SET defphoto = '' WHERE albumlinkID = '{$row['albumlinkID']}'";
		else
			$query = "UPDATE $medialinks_table SET defphoto = '' WHERE medialinkID = '{$row['medialinkID']}'";
		$result = @tng_query($query);
		break;
	case "show":
		$query = "UPDATE $medialinks_table SET dontshow = $toggle WHERE medialinkID=\"$medialinkID\"";
		$result = @tng_query($query);
		break;
	case "remalb":
		$query = "DELETE FROM $albumlinks_table WHERE albumlinkID=\"$albumlink\"";
		$result = @tng_query($query);
		$rval = $media . "&" . $albumlink;
		break;
	case "remmostwanted":
		$query = "DELETE FROM $mostwanted_table WHERE ID=\"$id\"";
		$result = @tng_query($query);
		$rval = $id;
		break;
	case "remsort":
		if($type == "album") {
			$query = "DELETE FROM $album2entities_table WHERE alinkID=\"$sortlink\"";
			$result = @tng_query($query);
		}
		elseif($type == "media") {
			$query = "DELETE FROM $medialinks_table WHERE medialinkID=\"$sortlink\"";
			$result = @tng_query($query);
		}
		$rval = $sortlink;
		break;
	case "addcemlink":
		$query = "UPDATE $cemeteries_table SET place = \"" . urldecode($place) . "\" WHERE cemeteryID = \"$cemeteryID\"";
		$result = @tng_query($query);

		//get cemname, location from cemetery, pass back in json
		$query = "SELECT cemname, city, county, state, country FROM $cemeteries_table WHERE cemeteryID = \"$cemeteryID\"";
		$result = @tng_query($query);
		$cemrow = tng_fetch_assoc($result);
		$location = $cemrow['cemname'];
		if($cemrow['city']) {
			if($location) $location .= ", ";
			$location .= $cemrow['city'];
		}
		if($cemrow['county']) {
			if($location) $location .= ", ";
			$location .= $cemrow['county'];
		}
		if($cemrow['state']) {
			if($location) $location .= ", ";
			$location .= $cemrow['state'];
		}
		if($cemrow['country']) {
			if($location) $location .= ", ";
			$location .= $cemrow['country'];
		}
		$rval = "{\"location\":\"$location\"}";
		tng_free_result($result);
		break;
	case "geocopy":
		$query = "UPDATE $cemeteries_table SET latitude = \"$latitude\", longitude = \"$longitude\", zoom=\"$zoom\" WHERE cemeteryID = \"$cemeteryID\"";
		$result = @tng_query($query);

		$success = $result ? "1" : "0";
		$rval = "{\"result\":\"$success\"}";
		break;
	case "add":
		//add photo to album at end
		$query2 = "SELECT max(ordernum) as maxordernum FROM $albumlinks_table WHERE albumID = \"$album\" GROUP BY albumID";
		$result2 = tng_query($query2) or die ($text['cannotexecutequery'] . ": $query2");
		$row2 = tng_fetch_assoc($result2);
		$count = !empty($row2['maxordernum']) ? $row2['maxordernum'] + 1 : 1;
		tng_free_result($result2);

		if($count == 1)
			$query = "INSERT INTO $albumlinks_table (albumID,mediaID,ordernum,defphoto) VALUES (\"$album\", \"$media\", \"$count\", \"1\")";
		else
			$query = "INSERT INTO $albumlinks_table (albumID,mediaID,ordernum,defphoto) VALUES (\"$album\", \"$media\", \"$count\",\"0\")";
		$result = @tng_query($query);
		$albumlinkID = tng_insert_id();
		$rval = $media . "&" . $albumlinkID;
		break;
	case "dellink":
		if($type == "album")
			$query = "SELECT entityID, gedcom FROM $album2entities_table WHERE alinkID=\"$linkID\"";
		else
			$query = "SELECT personID as entityID, $medialinks_table.gedcom as gedcom, eventID, mediatypeID FROM ($medialinks_table, $media_table) WHERE medialinkID=\"$linkID\" and $medialinks_table.mediaID = $media_table.mediaID";
		$result = @tng_query($query);
		$row = tng_fetch_assoc($result);
		$entityID = $row['entityID'];
		$tree = $row['gedcom'];
		tng_free_result($result);

		if($type == "album")
			$query = "DELETE FROM $album2entities_table WHERE alinkID=\"$linkID\"";
		else
			$query = "DELETE FROM $medialinks_table WHERE medialinkID=\"$linkID\"";
		$result = @tng_query($query);

		$query2 = "SELECT personID from $people_table WHERE personID = \"$entityID\" AND gedcom = \"$tree\"";
		reorderMedia( $query2, $row );

		$query2 = "SELECT familyID as personID from $families_table WHERE familyID = \"$entityID\" AND gedcom = \"$tree\"";
		reorderMedia( $query2, $row );

		$query2 = "SELECT sourceID as personID from $sources_table WHERE sourceID = \"$entityID\" AND gedcom = \"$tree\"";
		reorderMedia( $query2, $row );

		$query2 = "SELECT repoID as personID from $repositories_table WHERE repoID = \"$entityID\" AND gedcom = \"$tree\"";
		reorderMedia( $query2, $row );

		$rval = $linkID . "&" . $entityID;
		break;
	case "updatelink":
		//check if thumb exists before making default? We used to do that
		if($type == "album") {
			$query = "UPDATE $album2entities_table SET eventID = '$eventID' WHERE alinkID = $linkID";
			$result = @tng_query($query);
		}
		else {
			if($session_charset != "UTF-8") {
				$altdescription = tng_utf8_decode($altdescription);
				$altnotes = tng_utf8_decode($altnotes);
			}
			$altdescription = addslashes($altdescription);
			$altnotes = addslashes($altnotes);

			$dontshow = !empty($show) ? "0" : "1";
			$defphoto = !empty($defphoto) ? $defphoto : "";
			$query = "UPDATE $medialinks_table SET defphoto = '$defphoto', altdescription = '$altdescription', altnotes = '$altnotes', eventID = '$eventID', dontshow = $dontshow WHERE medialinkID = $linkID";
			$result = tng_query($query);
	
			if($defphoto) {
				$query = "UPDATE $medialinks_table SET defphoto = '' WHERE personID = '$personID' AND gedcom = '$tree' AND medialinkID != $linkID";
				$result = @tng_query($query);
			}
		}
		break;
	case "addlink":
		$entityID = attachPrefixSuffix($entityID, $linktype);
		
		if($linktype == "L" && $tngconfig['places1tree']) {
			$treestr = $tree = "";
		}
		else
			$treestr = " AND gedcom = \"$tree\"";

		if($type == "album")
			$query = "SELECT count(alinkID) as count FROM $album2entities_table WHERE entityID = \"$entityID\"$treestr";		
		else
			$query = "SELECT count(medialinkID) as count FROM $medialinks_table WHERE personID = \"$entityID\"$treestr";
		$result = @tng_query($query);
		$row = tng_fetch_assoc($result);
		tng_free_result($result);
		$newrow = $row ? $row['count'] + 1 : 1;

		$numrows = 0;
		switch($linktype) {
			case "I":
				$query = "SELECT personID, firstname, lnprefix, lastname, prefix, suffix, title, living, private, nameorder, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr, gedcom, branch FROM $people_table WHERE gedcom = \"$tree\" AND personID = \"$entityID\"";
				$result = @tng_query($query);
				$row = tng_fetch_assoc($result);
				$rights = determineLivingPrivateRights($row);
				$row['allow_living'] = $rights['living'];
				$row['allow_private'] = $rights['private'];
				$name = getName($row);

				$numrows = tng_num_rows($result);
				tng_free_result($result);
				break;
			case "F":
				$joinonwife = "LEFT JOIN $people_table AS wifepeople ON $families_table.wife = wifepeople.personID AND $families_table.gedcom = wifepeople.gedcom";
				$joinonhusb = "LEFT JOIN $people_table AS husbpeople ON $families_table.husband = husbpeople.personID AND $families_table.gedcom = husbpeople.gedcom";
				$query = "SELECT wifepeople.personID as wpersonID, wifepeople.firstname as wfirstname, wifepeople.lnprefix as wlnprefix, wifepeople.lastname as wlastname, wifepeople.prefix as wprefix, wifepeople.suffix as wsuffix, wifepeople.nameorder as wnameorder, wifepeople.title as wtitle, wifepeople.birthdate as wbirthdate, wifepeople.birthdatetr as wbirthdatetr, wifepeople.altbirthdate as waltbirthdate, wifepeople.altbirthdatetr as waltbirthdatetr, wifepeople.deathdate as wdeathdate, wifepeople.deathdatetr as wdeathdatetr, wifepeople.branch as wbranch, wifepeople.gedcom, wifepeople.living as wliving, wifepeople.private as wprivate,
                    husbpeople.personID as hpersonID, husbpeople.firstname as hfirstname, husbpeople.lnprefix as hlnprefix, husbpeople.lastname as hlastname, husbpeople.prefix as hprefix, husbpeople.suffix as hsuffix, husbpeople.nameorder as hnameorder, husbpeople.title as htitle, husbpeople.birthdate as hbirthdate, husbpeople.birthdatetr as hbirthdatetr, husbpeople.altbirthdate as haltbirthdate, husbpeople.altbirthdatetr as haltbirthdatetr, husbpeople.deathdate as hdeathdate, husbpeople.deathdatetr as hdeathdatetr, husbpeople.branch as hbranch, husbpeople.living as hliving, husbpeople.private as hprivate
					FROM $families_table $joinonwife $joinonhusb WHERE $families_table.gedcom = \"$tree\" AND familyID = \"$entityID\"";
				$result = tng_query($query);
				$row = tng_fetch_assoc($result);
				$name = "";

				$person['gedcom'] = $tree;
				if( $row['hpersonID'] ) {
					$person['personID'] = $row['hpersonID'];
					$person['firstname'] = $row['hfirstname'];
					$person['lnprefix'] = $row['hlnprefix'];
					$person['lastname'] = $row['hlastname'];
					$person['prefix'] = $row['hprefix'];
					$person['suffix'] = $row['hsuffix'];
                    $person['title'] = $row['htitle'];
                    $person['birthdate'] = $row['hbirthdate'];
                    $person['birthdatetr'] = $row['hbirthdatetr'];
                    $person['altbirthdate'] = $row['haltbirthdate'];
                    $person['altbirthdatetr'] = $row['haltbirthdatetr'];
                    $person['deathdate'] = $row['hdeathdate'];
                    $person['deathdatetr'] = $row['hdeathdatetr'];
                    $person['gedcom'] = $row['gedcom'];
                    $person['living'] = $row['hliving'];
                    $person['private'] = $row['hprivate'];
					$person['nameorder'] = $row['hnameorder'];
					$person['branch'] = $row['hbranch'];

					$prights = determineLivingPrivateRights($person);
					$person['allow_living'] = $prights['living'];
					$person['allow_private'] = $prights['private'];

					$name .= getName( $person );
				}
				$name .= ", ";
				if( $row['wpersonID'] ) {
					$person['personID'] = $row['wpersonID'];
					$person['firstname'] = $row['wfirstname'];
					$person['lnprefix'] = $row['wlnprefix'];
					$person['lastname'] = $row['wlastname'];
					$person['prefix'] = $row['wprefix'];
					$person['suffix'] = $row['wsuffix'];
                    $person['title'] = $row['wtitle'];
                    $person['birthdate'] = $row['wbirthdate'];
                    $person['birthdatetr'] = $row['wbirthdatetr'];
                    $person['altbirthdate'] = $row['waltbirthdate'];
                    $person['altbirthdatetr'] = $row['waltbirthdatetr'];
                    $person['deathdate'] = $row['wdeathdate'];
                    $person['deathdatetr'] = $row['wdeathdatetr'];
                    $person['gedcom'] = $row['gedcom'];
                    $person['living'] = $row['wliving'];
                    $person['private'] = $row['wprivate'];
					$person['nameorder'] = $row['wnameorder'];
					$person['branch'] = $row['wbranch'];

					$prights = determineLivingPrivateRights($person);
					$person['allow_living'] = $prights['living'];
					$person['allow_private'] = $prights['private'];

					$name .= getName( $person );
				}

				$numrows = tng_num_rows($result);
				tng_free_result($result);
				break;
			case "S":
				$query = "SELECT title FROM $sources_table WHERE gedcom = \"$tree\" AND sourceID = \"$entityID\"";
				$result = tng_query($query);
				$row = tng_fetch_assoc($result);
				$name = $row['title'];
				$truncated = substr($row['title'],0,90);
				$name = strlen($row['title']) > 90 ? substr($truncated,0,strrpos($truncated,' ')) . '&hellip;' : $row['title'];
				$numrows = tng_num_rows($result);
				tng_free_result($result);				
				break;
			case "C":
				$query = "SELECT title FROM $sources_table as s, $citations_table as c WHERE citationID = \"$entityID\" AND c.gedcom = s.gedcom AND c.sourceID = s.sourceID";
				$result = tng_query($query);
				$row = tng_fetch_assoc($result);
				$name = $row['title'];
				$truncated = substr($row['title'],0,90);
				$name = strlen($row['title']) > 90 ? substr($truncated,0,strrpos($truncated,' ')) . '&hellip;' : $row['title'];
				$numrows = tng_num_rows($result);
				tng_free_result($result);				
				break;
			case "R":
				$query = "SELECT reponame FROM $repositories_table WHERE gedcom = \"$tree\" AND repoID = \"$entityID\"";
				$result = tng_query($query);
				$row = tng_fetch_assoc($result);
				$name = $row['reponame'];
				$truncated = substr($row['reponame'],0,90);
				$name = strlen($row['reponame']) > 90 ? substr($truncated,0,strrpos($truncated,' ')) . '&hellip;' : $row['reponame'];
				$numrows = tng_num_rows($result);
				tng_free_result($result);
				break;
			case "L":
				$query = "SELECT place FROM $places_table WHERE place = \"$entityID\"$treestr";
				$result = tng_query($query);
				$numrows = tng_num_rows($result);
				tng_free_result($result);

				$name = stripslashes($entityID);

				if(!$numrows) {
					$query = "INSERT IGNORE INTO $places_table (gedcom,place,placelevel,temple,latitude,longitude,zoom,notes,geoignore) VALUES (\"$tree\",\"$entityID\",\"0\",\"0\",\"\",\"\",\"13\",\"\",\"0\")";
					$result = tng_query($query);
					$numrows = 1;
				}
				break;
		}

		if($numrows) {
			if($type == "album")
				$query = "INSERT IGNORE INTO $album2entities_table (entityID,albumID,ordernum,gedcom,linktype) VALUES (\"$entityID\",\"$albumID\",\"$newrow\",\"$tree\",\"$linktype\")";
			else
				$query = "INSERT IGNORE INTO $medialinks_table (personID,mediaID,ordernum,gedcom,linktype,eventID) VALUES (\"$entityID\",\"$mediaID\",\"$newrow\",\"$tree\",\"$linktype\",\"\")";

			$result = @tng_query($query);
			$success = tng_affected_rows();
			if($success) {
				$linkID = tng_insert_id();
				$rval = $linkID . "|" . $name;
				if( $type != "album" ) {
					$query = "SELECT thumbpath, mediatypeID, usecollfolder FROM $media_table WHERE mediaID = \"$mediaID\"";
					$result = tng_query($query);
					$row = tng_fetch_assoc($result);
					$mediatypeID = $row['mediatypeID'];
					$usefolder = $row['usecollfolder'] ? $mediatypes_assoc[$mediatypeID] : $mediapath;
					$rval .= "|";
					$rval .= $row['thumbpath'] && file_exists( "$rootpath$usefolder/" . $row['thumbpath'] ) ? "1" : "0";
					$rval .= "|" . $row['mediatypeID'];
					tng_free_result($result);
				}
				else
					$rval .= "|0|";
			}
			else
				$rval = 1;  //duplicate
		}
		else
			$rval = 2;  //invalid
		break;
	case "masslink":
		$entityID = tng_utf8_decode($newlink1);
		if($linktype == "L" && $tngconfig['places1tree']) {
			$treestr = $tree = "";
		}
		else
			$treestr = " AND gedcom = \"$tree\"";

		$query = "SELECT count(medialinkID) as count FROM $medialinks_table WHERE personID = \"$entityID\"$treestr";
		$result = @tng_query($query);
		$row = tng_fetch_assoc($result);
		tng_free_result($result);
		$newrow = $row ? $row['count'] + 1 : 1;
			
		$newlinks = 0;
		$mediaIDs = explode(",",$medialist);
		foreach($mediaIDs as $mediaID) {
			$query = "INSERT IGNORE INTO $medialinks_table (personID,mediaID,ordernum,gedcom,linktype,eventID) VALUES (\"$entityID\",\"$mediaID\",\"$newrow\",\"$tree1\",\"$linktype1\",\"$event1\")";
			$result = @tng_query($query);
			if(tng_affected_rows()) {
				$newlinks += 1;
				$newrow += 1;
			}
		}
		$rval = "{$admtext['newlinks']}: " . $newlinks;
		break;
	case "cemlink":
		$newcemlinks = 0;
		$mediaIDs = explode(",",$medialist);
		foreach($mediaIDs as $mediaID) {
			$query = "UPDATE $media_table SET cemeteryID = \"$cemeteryID\" WHERE mediaID = \"$mediaID\"";
			$result = @tng_query($query);
			$newcemlinks += tng_affected_rows();
		}

		$rval = "{$admtext['newcemlinks']}: " . $newcemlinks;
		break;
	case "qmedia":
		if($session_charset != "UTF-8") {
			$title = tng_utf8_decode($title);
			$description = tng_utf8_decode($description);
		}
		$title = addslashes($title);
		$description = addslashes($description);
		$owner = addslashes($owner);
		$datetaken = addslashes($datetaken);

		$query = "UPDATE $media_table SET description = \"$title\", owner = \"$owner\", datetaken = \"$datetaken\", notes = \"$description\" WHERE mediaID = \"$mediaID\"";
		$result = @tng_query($query);
		$rval = 1;
		break;
	case "deldnalink":
		$query = "DELETE FROM $dna_links_table WHERE ID=\"$linkID\"";
		$result = @tng_query($query);

		$rval = $linkID;
		break;
	case "adddnalink":
		$query = "SELECT count(ID) as count FROM $dna_links_table WHERE personID = \"$entityID\" AND gedcom = \"$tree\"";
		$result = @tng_query($query);
		$row = tng_fetch_assoc($result);
		tng_free_result($result);
		$newrow = $row ? $row['count'] + 1 : 1;

		$numrows = 0;
		$query = "SELECT personID, firstname, lnprefix, lastname, prefix, suffix, title, living, private, nameorder, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr, gedcom, branch FROM $people_table WHERE gedcom = \"$tree\" AND personID = \"$entityID\"";
		$result = @tng_query($query);
		$row = tng_fetch_assoc($result);
		$rights = determineLivingPrivateRights($row);
		$row['allow_living'] = $rights['living'];
		$row['allow_private'] = $rights['private'];
		$name = getName($row);

		$numrows = tng_num_rows($result);
		tng_free_result($result);

		if($numrows) {
			$query = "INSERT IGNORE INTO $dna_links_table (personID,gedcom,testID) VALUES (\"$entityID\",\"$tree\",\"$testID\")";

			$result = @tng_query($query);
			$success = tng_affected_rows();
			if($success) {
				$linkID = tng_insert_id();
				$rval = $linkID . "|" . $name;
			}
			else
				$rval = 1;  //duplicate
		}
		else
			$rval = 2;  //invalid
		break;
	case "saverect":
		if(!$id) {
			$nolink = true;
			$id = "label-" . time();
		}
		else
			$nolink = false;
		$query = "INSERT INTO $image_tags_table (mediaID,rtop,rleft,rheight,rwidth,gedcom,linktype,persfamID,label) VALUES (\"$mediaID\",\"$top\",\"$left\",\"$height\",\"$width\",\"$tree\",\"$linktype\",\"$id\",\"$label\")";
		$result = @tng_query($query);
		$rectID = tng_insert_id();

		$query = "SELECT count(medialinkID) as count FROM $medialinks_table WHERE personID = \"$id\" AND gedcom = \"$tree\"";
		$result = @tng_query($query);
		$row = tng_fetch_assoc($result);
		tng_free_result($result);
		$newrow = $row ? $row['count'] + 1 : 1;

		if(!$nolink) {
			$query = "INSERT IGNORE INTO $medialinks_table (personID,mediaID,ordernum,gedcom,linktype,eventID) VALUES (\"$id\",\"$mediaID\",\"$newrow\",\"$tree\",\"$linktype\",\"\")";
			$result = @tng_query($query);

			switch($linktype) {
				case "I":
					$query = "SELECT lastname, lnprefix, firstname, title, prefix, suffix, nameorder, gedcom, branch, living, private, birthdatetr, altbirthdatetr, deathdatetr, personID FROM $people_table WHERE personID = \"{$id}\" AND gedcom = \"$tree\"";
					$result= @tng_query($query) or die ($admtext['cannotexecutequery'] . ": $query");
					$row =  tng_fetch_assoc( $result );

					$righttree = checktree($tree);
					$rightbranch = $righttree ? checkbranch($row['branch']) : false;
					$rights = determineLivingPrivateRights($row, $righttree, $rightbranch);
					$row['allow_living'] = $rights['living'];
					$row['allow_private'] = $rights['private'];

					$label = getName( $row );
					tng_free_result($result);
					break;
				case "F":
					$query = "SELECT husband, wife, gedcom FROM $families_table WHERE familyID = \"$id\" AND gedcom = \"$tree\"";
					$result= @tng_query($query) or die ($admtext['cannotexecutequery'] . ": $query");
					$row =  tng_fetch_assoc( $result );
					$label = getFamilyName( $row );
					tng_free_result($result);
					break;
				case "S":
					$query = "SELECT title FROM $sources_table WHERE sourceID=\"$id\" AND gedcom=\"$tree\"";
					$result= @tng_query($query) or die ($admtext['cannotexecutequery'] . ": $query");
					$row =  tng_fetch_assoc( $result );
					$label = $row['title'] ? $row['title'] : $id;
					tng_free_result($result);
					break;
				case "R":
					$query = "SELECT reponame FROM $repositories_table WHERE repoID=\"$id\" AND gedcom=\"$tree\"";
					$result= @tng_query($query) or die ($admtext['cannotexecutequery'] . ": $query");
					$row =  tng_fetch_assoc( $result );
					$label = $row['reponame'] ? $row['reponame'] : $id;
					tng_free_result($result);
					break;
				case "C":
					$query = "SELECT title, persfamID, c.sourceID, page FROM $citations_table as c, $sources_table as s 
						WHERE citationID = \"$id\" AND c.gedcom = \"$tree\" AND c.gedcom = s.gedcom AND c.sourceID = s.sourceID";
					$result= @tng_query($query) or die ($admtext['cannotexecutequery'] . ": $query");
					$row =  tng_fetch_assoc( $result );
					$label = $row['title'] . " ({$row['persfamID']})";
					tng_free_result($result);
					break;
				case "L":
					$query = "SELECT place FROM $places_table WHERE ID=\"$id\"";
					$result= @tng_query($query) or die ($admtext['cannotexecutequery'] . ": $query");
					$row =  tng_fetch_assoc( $result );
					$label = $row['place'];
					tng_free_result($result);
					break;
			}
		}

		$json = true;
		$rval = "{\"name\":\"$label\", \"id\":\"$rectID\"}";

		//also get name and return that along with rectangle ID
		break;
	case "updaterect":
		$query = "UPDATE $image_tags_table SET rtop=\"$top\",rleft=\"$left\",rheight=\"$height\",rwidth=\"$width\" WHERE ID = \"$id\"";
		$result = @tng_query($query);
		$rval = 1;
		break;
	case "delrect":
		$query = "DELETE FROM $image_tags_table WHERE ID = \"$id\"";
		$result = @tng_query($query);
		$rval = 1;
		break;
}

if($json)
	header("Content-Type: application/json; charset=" . $session_charset);
else
	header("Content-type:text/html; charset=" . $session_charset);

echo $rval;
?>