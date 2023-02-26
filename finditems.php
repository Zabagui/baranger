<?php
include("begin.php");
include("adminlib.php");
$textpart = "sources";
//include("getlang.php");
include("$mylanguage/admintext.php");

include("checklogin.php");

if($session_charset != "UTF-8") {
	$criteria = tng_utf8_decode($criteria);
	$myffirstname = tng_utf8_decode($myffirstname);
	$myflastname = tng_utf8_decode($myflastname);
	$myhusbname = tng_utf8_decode($myhusbname);
	$mywifename = tng_utf8_decode($mywifename);
}

$criteria = trim($criteria);
$f = $filter == "c" ? "%" : "";

header("Content-type:text/html; charset=" . $session_charset);

$mediaquery = "";
if(!isset($albumID)) $albumID = "";
if(!isset($mediaID)) $mediaID = "";

if($albumID){
	$mediaquery = "SELECT entityID, gedcom FROM $album2entities_table WHERE gedcom = \"$tree\" AND albumID = \"$albumID\" AND linktype = \"$type\"";
}
else if($mediaID){
	$mediaquery = "SELECT personID as entityID, gedcom FROM $medialinks_table WHERE gedcom = \"$tree\" AND mediaID = \"$mediaID\" AND linktype = \"$type\"";
}

if($mediaquery) {
	$result2 = tng_query($mediaquery) or die ($admtext['cannotexecutequery'] . ": $mediaquery");
	$alreadygot = array();
	while( $row2 = tng_fetch_assoc($result2))
		$alreadygot[] = $row2['entityID'];
	tng_free_result($result2);
}

function showAction($entityID, $num = null) {
	global $alreadygot, $admtext, $albumID, $mediaID, $dims;

	$id = $num ? $num : $entityID;
	$lines = "<td class=\"lightback\">";
	$lines .= "<div id=\"link_$id\" class=\"normal\" style=\"text-align:center;width:50px;";
	if($albumID || $mediaID) {
		$gotit = in_array($entityID,$alreadygot);
		if($gotit)
			$lines .= "display:none";
		$lines .= "\"><a href=\"#\" onclick=\"return addMedia2EntityLink(findform, '" . str_replace("&#39;","\\'",$entityID) . "', '$num');\">" . $admtext['add'] . "</a></div>";
		$lines .= "<div id=\"linked_$id\" style=\"text-align:center;width:50px;";
		if(!$gotit)
			$lines .= "display:none";
		$lines .= "\"><img src=\"img/tng_test.gif\" alt=\"\" $dims /><div id=\"sdef_" . urlencode($entityID) . "\"></div>";
	}
	else {
		$lines .= "\"><a href=\"#\" onclick=\"selectEntity(document.find.newlink1, '$id');\">" . $admtext['select'] . "</a>";
	}
	$lines .= "</div>";
	$lines .= "</td>\n";

	return $lines;
}

$selectline = $mediaID || $albumID ? "<td class=\"fieldnameback fieldname nw\" width=\"50\">&nbsp;<b>" . $admtext['select'] . "</b>&nbsp;</td>\n" : "";

switch($type) {
	case "I":
		$myffirstname = addslashes(trim($myffirstname));
		$myflastname = addslashes(trim($myflastname));
		$myfpersonID = trim($myfpersonID);
		$allwhere = "gedcom = \"$tree\"";
		if($branch)
			$allwhere .= " AND branch LIKE \"%$branch%\"";
		if( $myfpersonID ) {
			$myfpersonID = strtoupper($myfpersonID);
			if($f != "%" && substr($myfpersonID,0,1) != $tngconfig['personprefix'])
				$myfpersonID = $tngconfig['personprefix'] . $myfpersonID;
			$allwhere .= " AND personID LIKE \"$f$myfpersonID%\"";
		}
		if( $myffirstname )
			$allwhere .= " AND firstname LIKE \"$f" . trim($myffirstname) . "%\"";
		if( $myflastname ) {
			if( $lnprefixes )
				$allwhere .= " AND TRIM(CONCAT_WS(' ',lnprefix,lastname)) LIKE \"$f" . trim($myflastname) . "%\"";
			else
				$allwhere .= " AND lastname LIKE \"$f" . trim($myflastname) . "%\"";
		}

		$more = getLivingPrivateRestrictions("", $myffirstname, false);

		if($more) {
			if($allwhere)
				$allwhere = $tree ? "$allwhere AND " : "($allwhere) AND ";
			$allwhere .= $more;
		}

		$query = "SELECT personID, lastname, firstname, lnprefix, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, burialdate, title, prefix, suffix, nameorder, living, private, branch, gedcom FROM $people_table WHERE $allwhere ORDER BY lastname, lnprefix, firstname LIMIT 250";
		$result = tng_query($query);

        if(tng_num_rows($result)) {
            $lines = "<tr>\n";
			$lines .= $selectline;
            $lines .= "<td class=\"fieldnameback fieldname nw\">&nbsp;<b>" . $admtext['personid'] . "</b>&nbsp;</td>\n";
            $lines .= "<td class=\"fieldnameback fieldname nw\">&nbsp;<b>" . $admtext['name'] . "</b>&nbsp;</td>\n";
            $lines .= "<td class=\"fieldnameback fieldname nw\">&nbsp;<b>" . $admtext['birthdate'] . "</b>&nbsp;</td>\n";
            $lines .= "<td class=\"fieldnameback fieldname nw\">&nbsp;<b>" . $admtext['deathdate'] . "</b>&nbsp;</td>\n";
            $lines .= "</tr>\n";

            while( $row = tng_fetch_assoc($result)) {
                $birthdate = $deathdate = "";
			 	$rights = determineLivingPrivateRights($row);
				$row['allow_living'] = $rights['living'];
				$row['allow_private'] = $rights['private'];

                if($rights['both']) {
                    if( $row['birthdate'] ) {
                        $birthdate = "{$admtext['birthabbr']} " . displayDate($row['birthdate']);
                    }
                    else if( $row['altbirthdate'] ) {
                        $birthdate = "{$admtext['chrabbr']} " . displayDate($row['altbirthdate']);
                    }
                    if( $row['deathdate'] ) {
                        $deathdate = "{$admtext['deathabbr']} " . displayDate($row['deathdate']);
                    }
                    else if( $row['burialdate'] ) {
                        $deathdate = "{$admtext['burialabbr']} " . displayDate($row['burialdate']);
                    }
                    if( !$birthdate && $deathdate )
                        $birthdate = $admtext['nobirthinfo'];
                }
                $namestr = getName( $row );
                //$lines .= "<td class=\"lightback\" align=\"center\"><a href=\"#\" onclick=\"return retItem('{$row['personID']}');\" id=\"item_{$row['personID']}\">{$admtext['select']}</a></td>\n";
				$lines .= "<tr id=\"linkrow_{$row['personID']}\">\n";
				if($mediaquery)
					$lines .= showAction($row['personID']);
                $lines .= "<td class=\"lightback\">{$row['personID']}&nbsp;</td>\n";
                $lines .= "<td class=\"lightback\"><a href=\"#\" onclick=\"return retItem('{$row['personID']}','I');\" id=\"item_{$row['personID']}\">$namestr</a>&nbsp;</td>\n";
                $lines .= "<td class=\"lightback\"><span id=\"birth_{$row['personID']}\">$birthdate</span>&nbsp;</td>\n";
                $lines .= "<td class=\"lightback\">$deathdate&nbsp;</td>\n</tr>\n";
            }
        }
		break;
	case "F":
		$myhusbname = trim($myhusbname);
		$mywifename = trim($mywifename);
		$myfamilyID = trim($myfamilyID);
		$allwhere = "$families_table.gedcom = \"$tree\"";
		if($branch)
			$allwhere .= " AND $families_table.branch LIKE \"%$branch%\"";
		if( $myfamilyID ) {
			$myfamilyID = strtoupper($myfamilyID);
			if($f != "%" && substr($myfamilyID,0,1) != $tngconfig['familyprefix'])
				$myfamilyID = $tngconfig['familyprefix'] . $myfamilyID;
			$allwhere .= " AND familyID LIKE \"%$myfamilyID%\"";
		}
		$joinon = "";
		if( $assignedbranch )
			$allwhere .= " AND $families_table.branch LIKE \"%$assignedbranch%\"";

		$allwhere2 = "";

		if( $mywifename ) {
			$terms = explode( ' ',  $mywifename );
			foreach( $terms as $term ) {
				if( $allwhere2 ) $allwhere2 .= " AND ";
				$allwhere2 .= "CONCAT_WS(' ',wifepeople.firstname,TRIM(CONCAT_WS(' ',wifepeople.lnprefix,wifepeople.lastname))) LIKE \"$f$term%\"";
			}
		}

		if( $myhusbname ) {
			$terms = explode( ' ',  $myhusbname );
			foreach( $terms as $term ) {
				if( $allwhere2 ) $allwhere2 .= " AND ";
				$allwhere2 .= "CONCAT_WS(' ',husbpeople.firstname,TRIM(CONCAT_WS(' ',husbpeople.lnprefix,husbpeople.lastname))) LIKE \"$f$term%\"";
			}
		}
		else
			$joinonhusb = "";

		if( $allwhere2 )
			$allwhere2 = "AND $allwhere2";

		$joinonwife = "LEFT JOIN $people_table AS wifepeople ON $families_table.wife = wifepeople.personID AND $families_table.gedcom = wifepeople.gedcom";
		$joinonhusb = "LEFT JOIN $people_table AS husbpeople ON $families_table.husband = husbpeople.personID AND $families_table.gedcom = husbpeople.gedcom";
		//$query = "SELECT familyID, wifepeople.personID as wpersonID, wifepeople.firstname as wfirstname, wifepeople.lnprefix as wlnprefix, wifepeople.lastname as wlastname, wifepeople.suffix as wsuffix, wifepeople.nameorder as wnameorder, wifepeople.living as wliving, wifepeople.private as wprivate, wifepeople.branch as wbranch,
		//	husbpeople.personID as hpersonID, husbpeople.firstname as hfirstname, husbpeople.lnprefix as hlnprefix, husbpeople.lastname as hlastname, husbpeople.suffix as hsuffix, husbpeople.nameorder as hnameorder, husbpeople.living as hliving, husbpeople.private as hprivate, husbpeople.branch as hbranch FROM $families_table $joinonwife $joinonhusb WHERE $allwhere $allwhere2 ORDER BY hlastname, hlnprefix, hfirstname LIMIT 250";
		$query = "SELECT familyID, wifepeople.personID as wpersonID, wifepeople.firstname as wfirstname, wifepeople.lnprefix as wlnprefix, wifepeople.lastname as wlastname, wifepeople.prefix as wprefix, wifepeople.suffix as wsuffix, wifepeople.nameorder as wnameorder, wifepeople.title as wtitle, wifepeople.birthdate as wbirthdate, wifepeople.birthdatetr as wbirthdatetr, wifepeople.altbirthdate as waltbirthdate, wifepeople.altbirthdatetr as waltbirthdatetr, wifepeople.deathdate as wdeathdate, wifepeople.living as wliving, wifepeople.private as wprivate, wifepeople.branch as wbranch, wifepeople.gedcom as wgedcom,
			husbpeople.personID as hpersonID, husbpeople.firstname as hfirstname, husbpeople.lnprefix as hlnprefix, husbpeople.lastname as hlastname, husbpeople.prefix as hprefix, husbpeople.suffix as hsuffix, husbpeople.nameorder as hnameorder, husbpeople.title as htitle, husbpeople.birthdate as hbirthdate, husbpeople.birthdatetr as hbirthdatetr, husbpeople.altbirthdate as haltbirthdate, husbpeople.altbirthdatetr as haltbirthdatetr, husbpeople.deathdate as hdeathdate, husbpeople.living as hliving, husbpeople.private as hprivate, husbpeople.branch as hbranch, husbpeople.gedcom as hgedcom 
			FROM $families_table $joinonwife $joinonhusb WHERE $allwhere $allwhere2 ORDER BY hlastname, hlnprefix, hfirstname LIMIT 250";
		$result = tng_query($query);

        if(tng_num_rows($result)) {
            $lines = "<tr>\n";
			$lines .= $selectline;
            $lines .= "<td class=\"fieldnameback fieldname nw\">&nbsp;<b>" . $admtext['familyid'] . "</b>&nbsp;</td>\n";
            $lines .= "<td class=\"fieldnameback fieldname nw\">&nbsp;<b>" . $admtext['husbname'] . "</b>&nbsp;</td>\n";
            $lines .= "<td class=\"fieldnameback fieldname nw\">&nbsp;<b>" . $admtext['wifename'] . "</b>&nbsp;</td>\n";
            $lines .= "</tr>\n";

            while( $row = tng_fetch_assoc($result)) {
                $thishusb = $thiswife = "";
                if( $row['hpersonID'] ) {
					$person['personID'] = $row['hpersonID'];
					$person['firstname'] = $row['hfirstname'];
					$person['lnprefix'] = $row['hlnprefix'];
					$person['lastname'] = $row['hlastname'];
					$person['prefix'] = $row['hprefix'];
					$person['suffix'] = $row['hsuffix'];
					$person['nameorder'] = $row['hnameorder'];
					$person['title'] = $row['htitle'];
					$person['birthdate'] = $row['hbirthdate'];
					$person['birthdatetr'] = $row['hbirthdatetr'];
					$person['altbirthdate'] = $row['haltbirthdate'];
					$person['altbirthdatetr'] = $row['haltbirthdatetr'];
					$person['deathdate'] = $row['hdeathdate'];
					$person['living'] = $row['hliving'];
					$person['private'] = $row['hprivate'];
					$person['branch'] = $row['hbranch'];
					$person['gedcom'] = $row['hgedcom'];
					$rights = determineLivingPrivateRights($person);
					$person['allow_living'] = $rights['living'];
					$person['allow_private'] = $rights['private'];
					$thishusb = getName( $person );
                }
                if( $row['wpersonID'] ) {
					if(!empty($thisfamily)) $thisfamily .= "<br/>";
					$person['personID'] = $row['wpersonID'];
					$person['firstname'] = $row['wfirstname'];
					$person['lnprefix'] = $row['wlnprefix'];
					$person['lastname'] = $row['wlastname'];
					$person['prefix'] = $row['wprefix'];
					$person['suffix'] = $row['wsuffix'];
					$person['nameorder'] = $row['wnameorder'];
					$person['title'] = $row['wtitle'];
					$person['birthdate'] = $row['wbirthdate'];
					$person['birthdatetr'] = $row['wbirthdatetr'];
					$person['altbirthdate'] = $row['waltbirthdate'];
					$person['altbirthdatetr'] = $row['waltbirthdatetr'];
					$person['deathdate'] = $row['wdeathdate'];
					$person['living'] = $row['wliving'];
					$person['private'] = $row['wprivate'];
					$person['branch'] = $row['wbranch'];
					$person['gedcom'] = $row['wgedcom'];
					$rights = determineLivingPrivateRights($person);
					$person['allow_living'] = $rights['living'];
					$person['allow_private'] = $rights['private'];
					$thiswife = getName( $person );
                }
				$lines .= "<tr id=\"linkrow_{$row['familyID']}\">\n";
				if($mediaquery)
					$lines .= showAction($row['familyID']);
                $lines .= "<td class=\"lightback\">" . $row['familyID'] . "&nbsp;</td>\n";
                $lines .= "<td class=\"lightback\"><a href=\"#\" onclick=\"return retItem('{$row['familyID']}','F');\" id=\"item_{$row['familyID']}\">$thishusb</a>&nbsp;</td>\n";
                $lines .= "<td class=\"lightback\">$thiswife&nbsp;</td></tr>\n";
            }
        }
		break;
	case "S":
		$query = "SELECT sourceID, title, shorttitle FROM $sources_table WHERE gedcom = \"$tree\" AND (title LIKE \"$f$criteria%\" OR shorttitle LIKE \"$f$criteria%\") ORDER BY title LIMIT 250";
		$result = tng_query($query);

        if(tng_num_rows($result)) {
            $lines = "<tr>\n";
			$lines .= $selectline;
            $lines .= "<td class=\"fieldnameback fieldname nw\" style=\"width:100px\">&nbsp;<b>" . $admtext['sourceid'] . "</b>&nbsp;</td>\n";
            $lines .= "<td class=\"fieldnameback fieldname nw\">&nbsp;<b>" . $admtext['title2'] . "</b>&nbsp;</td>\n";
            $lines .= "</tr>\n";

            while( $row = tng_fetch_assoc($result)) {
				$lines .= "<tr id=\"linkrow_{$row['sourceID']}\">\n";
				if($mediaquery)
					$lines .= showAction($row['sourceID']);
                $lines .= "<td class=\"lightback\">" . $row['sourceID'] . "&nbsp;</td>\n";
				$title = $row['title'] ? $row['title'] : $row['shorttitle'];
                $lines .= "<td class=\"lightback\"><a href=\"#\" onclick=\"return retItem('{$row['sourceID']}','S');\" id=\"item_{$row['sourceID']}\">" . truncateIt($title,100) . "</a>&nbsp;</td></tr>\n";
            }
        }
		break;
	case "C":
		//get citations, joined with sources
		//display title, plus cite ID fields
		//return citation ID
		$query = "SELECT citationID, title, shorttitle, persfamID, c.sourceID, eventID, page FROM $citations_table as c, $sources_table as s 
			WHERE c.gedcom = \"$tree\" AND c.gedcom = s.gedcom AND c.sourceID = s.sourceID AND (title LIKE \"$f$criteria%\" OR shorttitle LIKE \"$f$criteria%\") 
			ORDER BY title, shorttitle LIMIT 250";
		$result = tng_query($query);

        if(tng_num_rows($result)) {
            $lines = "<tr>\n";
			$lines .= $selectline;
            $lines .= "<td class=\"fieldnameback fieldname nw\" style=\"width:100px\">&nbsp;<b>" . $admtext['id'] . "</b>&nbsp;</td>\n";
            $lines .= "<td class=\"fieldnameback fieldname nw\">&nbsp;<b>" . $admtext['sourceid'] . "</b>&nbsp;</td>\n";
            $lines .= "<td class=\"fieldnameback fieldname nw\">&nbsp;<b>" . $admtext['title2'] . "</b>&nbsp;</td>\n";
            $lines .= "<td class=\"fieldnameback fieldname nw\">&nbsp;<b>" . $admtext['page'] . "</b>&nbsp;</td>\n";
            $lines .= "<td class=\"fieldnameback fieldname nw\">&nbsp;<b>" . $admtext['personid'] . "/" . $admtext['familyid'] . "</b>&nbsp;</td>\n";
            $lines .= "<td class=\"fieldnameback fieldname nw\">&nbsp;<b>" . $admtext['event'] . "</b>&nbsp;</td>\n";
            $lines .= "</tr>\n";

            while( $row = tng_fetch_assoc($result)) {
				$lines .= "<tr id=\"linkrow_{$row['citationID']}\">\n";
				if($mediaquery)
					$lines .= showAction($row['citationID']);
                $lines .= "<td class=\"lightback\">" . $row['citationID'] . "&nbsp;</td>\n";
				$title = $row['title'] ? $row['title'] : $row['shorttitle'];
	            $lines .= "<td class=\"lightback\">&nbsp;" . $row['sourceID'] . "&nbsp;</td>\n";
                $lines .= "<td class=\"lightback\"><a href=\"#\" onclick=\"return retItem('{$row['citationID']}','C');\" id=\"item_{$row['citationID']}\">" . truncateIt($title,100) . "</a>&nbsp;</td>\n";
	            $lines .= "<td class=\"lightback\">&nbsp;" . $row['page'] . "&nbsp;</td>\n";
	            $lines .= "<td class=\"lightback\">&nbsp;" . $row['persfamID'] . "&nbsp;</td>\n";
	            $lines .= "<td class=\"lightback\">&nbsp;" . $row['eventID'] . "&nbsp;</td>\n";
                $lines .= "</tr>\n";
            }
        }
		break;
    case "R":
        $query = "SELECT repoID, reponame FROM $repositories_table WHERE gedcom = \"$tree\" AND reponame LIKE \"$f$criteria%\" ORDER BY reponame LIMIT 250";
        $result = tng_query($query);

        if(tng_num_rows($result)) {
            $lines = "<tr>\n";
			$lines .= $selectline;
            $lines .= "<td class=\"fieldnameback fieldname nw\" style=\"width:100px\">&nbsp;<b>" . $admtext['repoid'] . "</b>&nbsp;</td>\n";
            $lines .= "<td class=\"fieldnameback fieldname nw\">&nbsp;<b>" . $admtext['title2'] . "</b>&nbsp;</td>\n";
            $lines .= "</tr>\n";

            while( $row = tng_fetch_assoc($result)) {
				$lines .= "<tr id=\"linkrow_{$row['repoID']}\">\n";
				if($mediaquery)
					$lines .= showAction($row['repoID']);
                $lines .= "<td class=\"lightback\">" . $row['repoID'] . "&nbsp;</td>\n";
                $lines .= "<td class=\"lightback\"><a href=\"#\" onclick=\"return retItem('{$row['repoID']}','R');\" id=\"item_{$row['repoID']}\">" . truncateIt($row['reponame'],75) . "</a>&nbsp;</td></tr>\n";
            }
        }
        break;
    case "L":
        $allwhere = $tree && !$tngconfig['places1tree'] ? "gedcom = \"$tree\"" : "1=1";
        if( $criteria )
            $allwhere .= " AND place LIKE \"$f$criteria%\"";
        if(!empty($temple))
            $allwhere .= " AND temple = 1";
        $query = "SELECT ID, place, temple, notes FROM $places_table WHERE $allwhere ORDER BY place LIMIT 250";
        $result = tng_query($query);

        if(tng_num_rows($result)) {
            $lines = "<tr>\n";
			$lines .= $selectline;
            $lines .= "<td class=\"fieldnameback fieldname nw\">&nbsp;<b>" . $admtext['place'] . "</b>&nbsp;</td>\n";
            $lines .= "</tr>\n";

			$num = 1;
            while( $row = tng_fetch_assoc($result)) {
                $row['place'] = preg_replace("/'/","&#39;", $row['place'] );
                $notes = $row['temple'] && $row['notes'] ? " (" . truncateIt($row['notes'],75) .")" : "";
                $place_slashed = addslashes(preg_replace("/[^A-Za-z0-9]/","_",$row['place']));
				$lines .= "<tr id=\"linkrow_{$row['ID']}\">\n";
				if($mediaquery)
					$lines .= showAction($row['place'], $num);
        		$lines .= "<td class=\"lightback\"><a href=\"#\" onclick='return retItem(\"{$row['ID']}\",\"L\",true);' class=\"rplace\" id=\"item_{$row['ID']}\">{$row['place']}</a>$notes&nbsp;</td></tr>\n";
				$num++;
            }
        }
        break;
}

if(tng_num_rows($result))
    echo "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" width=\"585\" class=\"normal\">\n$lines\n</table>\n";
else
    echo $admtext['noresults'];

tng_free_result($result);
?>