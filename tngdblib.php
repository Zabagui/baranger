<?php
function countChildren($tree, $familyID) {
    global $children_table;

    $query = "SELECT count(ID) as ccount
        FROM $children_table 
        WHERE familyID = \"$familyID\" AND gedcom = \"$tree\"";

    return tng_query($query);
}

//Get the children IDs for a family
function getChildrenMinimal($tree, $familyID) {
    global $children_table;

	$query = "SELECT UPPER(personID) as personID
        FROM $children_table
        WHERE familyID = \"$familyID\" AND gedcom = \"$tree\"
        ORDER BY ordernum";

    return tng_query($query);
}

//Get the family ID for all children in a family except the one specified
function getChildrenMinimalExcept($tree, $familyID, $personID) {
    global $children_table;

	$query = "SELECT UPPER(personID) as personID
        FROM $children_table
        WHERE familyID = \"$familyID\" AND personID != \"$personID\" AND gedcom = \"$tree\"
        ORDER BY ordernum";

    return tng_query($query);
}

//Get the children IDs for a family
function getChildrenMinimalPlusGender($tree, $familyID) {
    global $children_table, $people_table;

	$query = "SELECT $children_table.personID as personID, sex
        FROM ($children_table, $people_table)
        WHERE familyID = \"$familyID\" AND $children_table.personID = $people_table.personID AND $children_table.gedcom = \"$tree\" AND $people_table.gedcom = \"$tree\"
        ORDER BY ordernum";

    return tng_query($query);
}

//Get basic info for children in a family
function getChildrenSimple($tree, $familyID) {
    global $children_table, $people_table;

	$query = "SELECT $people_table.personID as pID, $people_table.personID as personID, $people_table.gedcom as gedcom, firstname, lnprefix, lastname, prefix, suffix, nameorder, living, private, branch
        FROM ($children_table, $people_table)
        WHERE familyID = \"$familyID\" AND $children_table.personID = $people_table.personID AND $children_table.gedcom = \"$tree\" AND $people_table.gedcom = \"$tree\"
        ORDER BY ordernum";

    return tng_query($query);
}

//Get most info for children in a family
function getChildrenData($tree, $familyID) {
    global $children_table, $people_table;

	$query = "SELECT $people_table.personID as personID, $people_table.gedcom as gedcom, firstname, lnprefix, lastname, prefix, suffix, title, nameorder, 
        birthdate, birthdatetr, birthplace, altbirthdate, altbirthdatetr, altbirthplace, deathdate, deathdatetr, deathplace, burialdate, burialdatetr, burialplace, burialtype, 
        haskids, sex, living, private, branch, frel, mrel
        FROM ($people_table, $children_table)
        WHERE familyID = \"$familyID\" AND $people_table.personID = $children_table.personID AND $people_table.gedcom = \"$tree\" AND $children_table.gedcom = \"$tree\"
		ORDER BY ordernum";

    return tng_query($query);
}

//Get most info for children in a family plus dates
function getChildrenDataPlusDates($tree, $familyID) {
    global $children_table, $people_table;

    $query = "SELECT $people_table.personID as personID, $people_table.gedcom as gedcom, firstname, lnprefix, lastname, prefix, suffix, title, nameorder, birthdate, birthdatetr, birthplace, altbirthdate, altbirthdatetr, deathdate, deathdatetr, deathplace, burialdate, sex, living, private, branch, ordernum,
			IF(birthdate!='',YEAR(birthdatetr),YEAR(altbirthdatetr)) as birth, IF(deathdate!='',YEAR(deathdatetr),YEAR(burialdatetr)) as death
		FROM ($children_table, $people_table)
		WHERE familyID = \"$familyID\" AND $children_table.personID = $people_table.personID AND $children_table.gedcom = \"$tree\" AND $people_table.gedcom = \"$tree\"
   		ORDER BY ordernum";

    return tng_query($query);
}

//Get the family ID for a child, sort is configurable
function getChildFamily($tree, $personID, $orderfield) {
    global $children_table;

	$query = "SELECT familyID FROM $children_table
        WHERE personID = \"$personID\" AND gedcom = \"$tree\"
        ORDER BY $orderfield";

    return tng_query($query);
}

//Get parents' family data for a child
function getChildParentsFamily($tree, $personID) {
    global $children_table;

	$query = "SELECT personID, familyID, sealdate, sealdatetr, sealplace, mrel, frel
        FROM $children_table
        WHERE personID = \"$personID\" AND gedcom = \"$tree\"
        ORDER BY parentorder";

    return tng_query($query);
}

//Get husband and wife info for a family using children table
function getChildParentsFamilyData($tree, $personID) {
    global $children_table, $families_table;

    $query = "SELECT husband, wife, marrdate, marrdatetr, marrplace, divdate, divdatetr, divplace, $families_table.familyID as familyID
        FROM ($families_table, $children_table)
        WHERE personID = \"$personID\" AND $children_table.gedcom = \"$tree\" AND $children_table.familyID = $families_table.familyID
        AND $children_table.gedcom = $families_table.gedcom";

    return tng_query($query);
}

//Get husband and wife IDs for a family using children table
function getChildParentsFamilyMinimal($tree, $personID) {
    global $children_table, $families_table;

	$query = "SELECT husband, wife, $families_table.familyID as familyID
        FROM ($families_table, $children_table)
		WHERE personID = \"$personID\" AND $children_table.gedcom = \"$tree\" AND $children_table.familyID = $families_table.familyID
		AND $children_table.gedcom = $families_table.gedcom";

    return tng_query($query);
}

//Get parent for a family
function getParentData($tree, $familyID, $spouse) {
    global $people_table, $families_table;

    $query = "SELECT $people_table.gedcom, personID, lastname, lnprefix, firstname, prefix, suffix, title, nameorder, birthdate, birthdatetr, birthplace, altbirthdate, altbirthdatetr, altbirthplace, deathdate, deathdatetr, deathplace, burialdate, burialdatetr, burialplace, burialtype, marrdate, marrplace,
        $people_table.living, $people_table.private, $people_table.branch, sex
        FROM ($people_table, $families_table)
        WHERE personID = $spouse AND familyID = \"$familyID\" AND $people_table.gedcom = \"$tree\" AND $families_table.gedcom = \"$tree\"";

    return tng_query($query);
}

//Get opposite parent for a family plus dates
function getParentDataCrossPlusDates($tree, $familyID, $spouse1, $spouse1ID, $spouse2) {
    global $people_table, $families_table;

    $query = "SELECT $people_table.gedcom, personID, firstname, lnprefix, lastname, prefix, suffix, title, nameorder, sex, $people_table.living, $people_table.private, $people_table.branch,
            IF(birthdate!='',YEAR(birthdatetr),YEAR(altbirthdatetr)) as birth, IF(deathdate!='',YEAR(deathdatetr),YEAR(burialdatetr)) as death, $people_table.gedcom,
            birthdate, birthdatetr, altbirthdatetr, deathdate, deathdatetr, burialdatetr
		FROM ($families_table, $people_table)
		WHERE $spouse1 = \"$spouse1ID\" AND personID = $spouse2 AND familyID = \"$familyID\" AND $families_table.gedcom = \"$tree\" AND $people_table.gedcom = \"$tree\"";

    return tng_query($query);
}

//Get basic parent data for a family
function getParentSimple($tree, $familyID, $spouse) {
    global $people_table, $families_table;

	$query = "SELECT $people_table.gedcom, personID, lastname, lnprefix, firstname, prefix, suffix, nameorder,
		$people_table.living, $people_table.private, $people_table.branch
		FROM ($people_table, $families_table)
		WHERE personID = $spouse AND familyID = \"$familyID\" AND $families_table.gedcom = \"$tree\" AND $people_table.gedcom = \"$tree\"";

    return tng_query($query);
}

//Get basic parent data for a family plus dates
function getParentSimplePlusDates($tree, $familyID, $spouse) {
    global $people_table, $families_table;

    $query = "SELECT $people_table.gedcom, personID, lastname, lnprefix, firstname, prefix, suffix, nameorder, title, birthdate, birthdatetr, altbirthdate, altbirthdatetr,
		YEAR(birthdatetr) as birthyear, deathdate, YEAR(deathdatetr) as deathyear, burialdate, $people_table.living, $people_table.private, $people_table.branch
		FROM ($people_table, $families_table)
		WHERE personID = $spouse AND familyID = \"$familyID\" AND $families_table.gedcom = \"$tree\" AND $people_table.gedcom = \"$tree\"";

    return tng_query($query);
}

//Get husband and wife IDs for a family
function getFamilyMinimal($tree, $familyID) {
    global $families_table;

	$query = "SELECT UPPER(husband) as husband, UPPER(wife) as wife
        FROM $families_table
        WHERE familyID = \"$familyID\" AND gedcom = \"$tree\"";

    return tng_query($query);
}

//Get husband and wife IDs for a family
function getFamilyData($tree, $familyID) {
    global $families_table;

	$query = "SELECT gedcom, husband, wife, living, private, branch, marrdate, marrdatetr, marrplace, marrtype, divdate, divdatetr, divplace, familyID
        FROM $families_table
        WHERE familyID = \"$familyID\" AND gedcom = \"$tree\"";

    return tng_query($query);
}

//Get family ID, plus spouse ID for a known spouse
function getSpouseFamilyMinimal($tree, $spouse1, $spouse1ID, $spouseorder) {
    global $families_table;

    $query = "SELECT husband, wife, familyID
        FROM $families_table
        WHERE $spouse1 = \"$spouse1ID\" AND gedcom = \"$tree\" ORDER BY $spouseorder";

    return tng_query($query);
}

//Get family data for a known spouse with unknown gender
function getSpouseFamilyMinimalUnion($tree, $spouse1ID) {
    global $families_table;

	$query = "SELECT husband, wife, familyID
        FROM $families_table
        WHERE $families_table.wife = \"$spouse1ID\" AND gedcom = \"$tree\"
        UNION
            SELECT husband, wife, familyID
            FROM $families_table
            WHERE $families_table.husband = \"$spouse1ID\" AND gedcom = \"$tree\"";

    return tng_query($query);
}

//Get family ID, plus spouse ID for a known person, except the one indicated
function getSpouseFamilyMinimalExcept($tree, $spouse1, $spouse1ID, $spouse2, $spouse2ID) {
    global $families_table;

    $query = "SELECT familyID, UPPER(husband) as husband, UPPER(wife) as wife
        FROM $families_table
        WHERE $spouse1 = \"$spouse1ID\" AND $spouse2 != \"$spouse2ID\" AND gedcom = \"$tree\"";

    return tng_query($query);
}

//Get most family data for a known spouse
function getSpouseFamilyData($tree, $spouse1, $spouse1ID, $spouseorder) {
    global $families_table;

    $query = "SELECT gedcom, husband, wife, familyID, marrdate, marrdatetr, marrplace, marrtype, divdate, divdatetr, divplace, living, private, branch
		FROM $families_table
		WHERE $spouse1 = \"$spouse1ID\" AND gedcom = \"$tree\"
		ORDER BY $spouseorder";

    return tng_query($query);
}

//Get most family data for a known spouse with unknown gender
function getSpouseFamilyDataUnion($tree, $spouse1ID) {
    global $families_table;

    $query = "SELECT gedcom, husband, wife, familyID, marrdate, marrdatetr, marrplace, marrtype, divdate, divdatetr, divplace, living, private, branch
        FROM $families_table
        WHERE husband = \"$spouse1ID\" AND gedcom = \"$tree\"
        UNION
            SELECT gedcom, husband, wife, familyID, marrdate, marrdatetr, marrplace, marrtype, divdate, divdatetr, divplace, living, private, branch
            FROM $families_table
            WHERE wife = \"$spouse1ID\" AND gedcom = \"$tree\"";

    return tng_query($query);
}

//Get most family data for a known spouse
function getSpouseFamilyDataPlusDates($tree, $spouse1, $spouse1ID, $spouseorder) {
    global $families_table;

	$query = "SELECT gedcom, husband, wife, familyID, marrdate, marrdatetr, marrplace, marrtype, living, private, branch,
		YEAR(marrdatetr) as marryear, MONTH(marrdatetr) as marrmonth, DAYOFMONTH(marrdatetr) as marrday, marrplace, sealdate, sealplace
		FROM $families_table
		WHERE $spouse1 = \"$spouse1ID\" AND gedcom = \"$tree\"
		ORDER BY $spouseorder";

    return tng_query($query);
}

//Get most family data for a known spouse with unknown gender
function getSpouseFamilyDataUnionPlusDates($tree, $spouse1ID) {
    global $families_table;

	$query = "SELECT gedcom, husband, wife, familyID, marrdate, marrdatetr, marrplace, marrtype, living, private, branch,
			YEAR(marrdatetr) as marryear, MONTH(marrdatetr) as marrmonth, DAYOFMONTH(marrdatetr) as marrday, marrplace, sealdate, sealplace
        FROM $families_table
        WHERE husband = \"$spouse1ID\" AND gedcom = \"$tree\"
        UNION
            SELECT gedcom, husband, wife, familyID, marrdate, marrdatetr, marrplace, marrtype, living, private, branch,
				YEAR(marrdatetr) as marryear, MONTH(marrdatetr) as marrmonth, DAYOFMONTH(marrdatetr) as marrday, marrplace, sealdate, sealplace
            FROM $families_table
            WHERE wife = \"$spouse1ID\" AND gedcom = \"$tree\"";

    return tng_query($query);
}

//Get all family data for a known spouse
function getSpouseFamilyFull($tree, $spouse1, $spouse1ID, $spouseorder) {
    global $families_table;

	$query = "SELECT *, DATE_FORMAT(changedate,\"%e %b %Y\") as changedate
        FROM $families_table
        WHERE $spouse1 = \"$spouse1ID\" AND gedcom = \"$tree\"
        ORDER BY $spouseorder";

    return tng_query($query);
}

//Get all family data for a known spouse with unknown gender
function getSpouseFamilyFullUnion($tree, $spouse1ID) {
    global $families_table;

	$query = "SELECT *, DATE_FORMAT(changedate,\"%e %b %Y\") as changedate, husborder as sporder
        FROM $families_table
        WHERE husband = \"$spouse1ID\" AND gedcom = \"$tree\"
        UNION
            SELECT *, DATE_FORMAT(changedate,\"%e %b %Y\") as changedate, wifeorder as sporder
            FROM $families_table
            WHERE wife = \"$spouse1ID\" AND gedcom = \"$tree\"
        ORDER BY sporder";

    return tng_query($query);
}

//Get basic information for all spouses of a person (spouse1)
function getSpousesSimple($tree, $spouse1, $spouse1ID, $spouse2, $spouseorder) {
    global $families_table, $people_table;

    $query = "SELECT UPPER($spouse2) as $spouse2, familyID, sex
        FROM $families_table
        LEFT JOIN $people_table ON $people_table.personID = $spouse2 AND $people_table.gedcom = \"$tree\"
        WHERE $spouse1 = \"$spouse1ID\" AND $families_table.gedcom = \"$tree\"
        ORDER BY $spouseorder";

    return tng_query($query);
}

//Get most person data
function getPersonData($tree, $personID) {
    global $people_table;

   	$query = "SELECT UPPER(personID) as personID, gedcom, firstname, lnprefix, lastname, prefix, suffix, title, nickname, sex, nameorder, living, private, branch,
            birthdate, birthdatetr, birthplace, altbirthdate, altbirthdatetr, altbirthplace, deathdate, deathdatetr, deathplace, burialdate, burialdatetr, burialplace, burialtype, famc, baptdate, baptplace, confdate, confplace, initdate, initplace, endldate, endlplace
        FROM $people_table
        WHERE personID = \"$personID\" AND gedcom = \"$tree\"";

	return tng_query($query);
}

//Get most person data plus year dates
function getPersonDataPlusDates($tree, $personID) {
    global $people_table;

    $query = "SELECT personID, gedcom, firstname, lnprefix, lastname, prefix, suffix, title, sex, nameorder, living, private, branch,
            birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr, burialdate, burialdatetr, famc,
        IF(birthdatetr !='0000-00-00',YEAR(birthdatetr),YEAR(altbirthdatetr)) as birth,
        IF(deathdatetr !='0000-00-00',YEAR(deathdatetr),YEAR(burialdatetr)) as death
        FROM $people_table
        WHERE personID = \"$personID\" AND gedcom = \"$tree\"";

	return tng_query($query);
}

//Get all person data plus year dates
function getPersonFullPlusDates($tree, $personID) {
    global $people_table;

    $query = "SELECT *, DATE_FORMAT(changedate,\"%e %b %Y\") as changedate,
        IF(birthdatetr !='0000-00-00',YEAR(birthdatetr),YEAR(altbirthdatetr)) as birth,
        IF(deathdatetr !='0000-00-00',YEAR(deathdatetr),YEAR(burialdatetr)) as death
        FROM $people_table WHERE personID = \"$personID\" AND gedcom = \"$tree\"";

	return tng_query($query);
}

//Get a person's gender
function getPersonGender($tree, $personID) {
	global $people_table;

	$query = "SELECT sex FROM $people_table WHERE personID = \"$personID\" AND gedcom = \"$tree\"";

	return tng_query($query);
}

//Get basic person data
function getPersonSimple($tree, $personID) {
	global $people_table;

	$query = "SELECT personID, gedcom, firstname, lnprefix, lastname, prefix, suffix, title, sex, nameorder, living, private, branch, birthdate, birthdatetr, birthplace, altbirthdate, altbirthdatetr, deathdate, deathdatetr, deathplace, burialdate, burialdatetr, burialplace
		FROM $people_table
		WHERE personID = \"$personID\" AND gedcom = \"$tree\"";

	return tng_query($query);
}

//Get basic tree data
function getTreeSimple($tree) {
    global $trees_table;

    $query = "SELECT gedcom, treename, disallowgedcreate, disallowpdf FROM $trees_table WHERE gedcom = \"$tree\"";
    
    return tng_query($query);
}

//Get basic branch descriptions for a tree
function getBranchesSimple($tree, $branch) {
    global $branches_table;

    $query = "SELECT description FROM $branches_table WHERE branch = \"$branch\" and gedcom = \"$tree\"";

    return tng_query($query);
}

//Get associations for a person
function getAssociations($tree, $personID) {
    global $assoc_table;

    $query = "SELECT passocID, relationship, reltype FROM $assoc_table WHERE gedcom = \"$tree\" AND personID = \"$personID\"";

    return tng_query($query);
}

function getPersonEventData($tree, $personID) {
	global $events_table, $eventtypes_table;

	$query = "SELECT eventID, display, eventdate, eventplace, info
		FROM ($events_table, $eventtypes_table)
		WHERE persfamID = \"$personID\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID AND gedcom = \"$tree\" AND keep = \"1\" AND parenttag = \"\"
		ORDER BY ordernum, tag, description, eventdatetr, info, eventID";

	return tng_query($query);
}
?>