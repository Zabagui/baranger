<?php
/*
 * tngCalendar - An addon calendar for TNG
 * http://www.tngforum.us/index.php?showtopic=779
 *
 * @author CJ Niemira <siege (at) siege (dot) org>
 * @copyright 2006,2008
 * @license GPL
 * @version 2.0
 */


/* Make sure we're running under TNG */
if (! isset($tngconfig)) {
        die ("Sorry!");
}


/* We only show one type of seal date */
$text['sealdate'] = $text['ssealdate'];


/* What is the first day of the week? */
$startOfWeek = isset($tngconfig['calstart']) ? $tngconfig['calstart'] : '0';		# 6=Saturday, 0=Sunday, 1=Monday, 2=Tuesday ...


/* How many characters of a name can I display? */
$truncateNameAfter = '28';


/* How many events can I show for a single day? */
$truncateDateAfter = '4';


/* Select which INDIVIDUAL events you'd like to show by setting an icon */
$calIndEvent['birth']		= 'tng_cal_birth.png';
$calIndEvent['death']		= 'tng_cal_death.png';
if(!$tngconfig['hidechr']) {  //don't show these if we're hiding the christening event
	$calIndEvent['altbirth']	= 'tng_cal_altbirth.png';
}
$calIndEvent['burial']		= 'tng_cal_burial.png';
$ldsOK = determineLDSRights();
if($ldsOK) {              //don't show these if the user does not have rights to see LDS data
	$calIndEvent['bapt']		= 'tng_cal_bapt.png';
	$calIndEvent['endl']		= 'tng_cal_endl.png';
}

/* Select which FAMILY events you'd like to show by setting an icon */
//$calFamEvent['div']		= 'tng_cal_div.png';
$calFamEvent['marr']		= 'tng_cal_marr.png';
if($ldsOK) {              //don't show these if the user does not have rights to see LDS data
	$calFamEvent['seal']		= 'tng_cal_seal.png';
}

/* To show CUSTOM events, enter the GEDCOM TAG and set an icon */
$calEvent = array();
//$calEvent['EDUC']		= 'tng_cal_educ.png';
//$calEvent['EMIG']		= 'tng_cal_emig.png';
//$calEvent['ENGA']		= 'tng_cal_enga.png';
//$calEvent['EVEN']		= 'tng_cal_even.png';


/* You can hide certain events by default by entering the keys here */
$defaultHide			= array('altbirth', 'burial', 'bapt', 'endl', 'seal');


/* Make an array of all the event types */
$calAllEvents = array_merge($calIndEvent, $calFamEvent, $calEvent);
?>