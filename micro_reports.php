<?php
$dontdo = array("ADDR","BIRT","CHR","DEAT","BURI","NAME","NICK","TITL","NSFX","NPFX");

$dfields = array();
$dfields['personID'] = "personid";
$dfields['fullname'] = "fullname";
$dfields['lastfirst'] = "lastfirst";
$dfields['firstname'] = "firstname";
$dfields['lastname'] = "lastname";
$dfields['nickname'] = "nickname";
$dfields['birthdate'] = "birthdate";
$dfields['birthplace'] = "birthplace";
if(!$tngconfig['hidechr']) {
	$dfields['altbirthdate'] = "chrdate";
	$dfields['altbirthplace'] = "chrplace";
}
$dfields['marrdate'] = "marriagedate";
$dfields['marrplace'] = "marriageplace";
$dfields['divdate'] = "divdate";
$dfields['divplace'] = "divplace";
$dfields['spouseid'] = "spouseid";
$dfields['spousename'] = "spousename";
$dfields['deathdate'] = "deathdate";
$dfields['deathplace'] = "deathplace";
$dfields['burialdate'] = "burialdate";
$dfields['burialplace'] = "burialplace";
$dfields['changedate'] = "lastmodified";
$dfields['sex'] = "sex";
$dfields['title'] = "title";
$dfields['prefix'] = "prefix";
$dfields['suffix'] = "suffix";
$dfields['gedcom'] = "tree";
if( $allow_lds ) {
	$dfields['baptdate'] = "ldsbapldate";
	$dfields['baptplace'] = "ldsbaplplace";
	$dfields['confdate'] = "ldsconfdate";
	$dfields['confplace'] = "ldsconfplace";
	$dfields['initdate'] = "ldsinitdate";
	$dfields['initplace'] = "ldsinitplace";
	$dfields['endldate'] = "ldsendldate";
	$dfields['endlplace'] = "ldsendlplace";
	$dfields['ssealdate'] = "ldssealsdate";
	$dfields['ssealplace'] = "ldssealsplace";
	$dfields['psealdate'] = "ldssealpdate";
	$dfields['psealplace'] = "ldssealpplace";
}

$cfields = array();
$cfields['personID'] = "personid";
$cfields['firstname'] = "firstname";
$cfields['lastname'] = "lastname";
$cfields['lnprefix'] = "lnprefix";
$cfields['nickname'] = "nickname";
$cfields['monthonly'] = "monthonlyfrom";
$cfields['yearonly'] = "yearonlyfrom";
$cfields['dayonly'] = "dayonlyfrom";
$cfields['desc'] = "desc";
$cfields['birthdate'] = "birthdate";
$cfields['birthdatetr'] = "birthdatetr";
$cfields['birthplace'] = "birthplace";
if(!$tngconfig['hidechr']) {
	$cfields['altbirthdate'] = "chrdate";
	$cfields['altbirthdatetr'] = "chrdatetr";
	$cfields['altbirthplace'] = "chrplace";
}
$cfields['marrdate'] = "marriagedate";
$cfields['marrdatetr'] = "marriagedatetr";
$cfields['marrplace'] = "marriageplace";
$cfields['divdate'] = "divdate";
$cfields['divdatetr'] = "divdatetr";
$cfields['divplace'] = "divplace";
$cfields['deathdate'] = "deathdate";
$cfields['deathdatetr'] = "deathdatetr";
$cfields['deathplace'] = "deathplace";
$cfields['burialdate'] = "burialdate";
$cfields['burialdatetr'] = "burialdatetr";
$cfields['burialplace'] = "burialplace";
$cfields['changedate'] = "lastmodified";
$cfields['sex'] = "sex";
$cfields['title'] = "title";
$cfields['prefix'] = "prefix";
$cfields['suffix'] = "suffix";
$cfields['gedcom'] = "tree";
if( $allow_lds ) {
	$cfields['baptdate'] = "ldsbapldate";
	$cfields['baptdatetr'] = "ldsbapldatetr";
	$cfields['baptplace'] = "ldsbaplplace";
	$cfields['confdate'] = "ldsconfdate";
	$cfields['confdatetr'] = "ldsconfdatetr";
	$cfields['confplace'] = "ldsconfplace";
	$cfields['initdate'] = "ldsinitdate";
	$cfields['inittdatetr'] = "ldsinitdatetr";
	$cfields['initplace'] = "ldsinitplace";
	$cfields['endldate'] = "ldsendldate";
	$cfields['endldatetr'] = "ldsendldatetr";
	$cfields['endlplace'] = "ldsendlplace";
	$cfields['ssealdate'] = "ldssealsdate";
	$cfields['ssealdatetr'] = "ldssealsdatetr";
	$cfields['ssealplace'] = "ldssealsplace";
	$cfields['psealdate'] = "ldssealpdate";
	$cfields['psealdatetr'] = "ldssealpdatetr";
	$cfields['psealplace'] = "ldssealpplace";
}

$ofields = array();
$ofields['contains'] = "contains";
$ofields['starts with'] = "startswith";
$ofields['ends with'] = "endswith";
$ofields['OR'] = "text_or";
$ofields['AND'] = "text_and";
$ofields['currmonth'] = "currentmonth";
$ofields['currmonthnum'] = "currentmonthnum";
$ofields['curryear'] = "currentyear";
$ofields['currday'] = "currentday";
$ofields['today'] = "today";
$ofields['to_days'] = "convtodays";

$subtypes = array();
$subtypes['dt'] = $admtext['rptdate'];
$subtypes['tr'] = $admtext['rptdatetr'];
$subtypes['pl'] = $admtext['place'];
$subtypes['fa'] = $admtext['fact'];
?>