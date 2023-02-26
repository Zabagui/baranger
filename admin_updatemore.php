<?php
include("begin.php");
include("adminlib.php");
$textpart = "events";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include($cms['tngpath'] . "checklogin.php");

if( !$allow_edit ) {
	exit;
}

require("adminlog.php");

$rval = 0;
if( !isset($info) ) $info = "";

if($session_charset != "UTF-8") {
	$eventplace = tng_utf8_decode($eventplace);
	$info = tng_utf8_decode($info);
	$age = tng_utf8_decode($age);
	$agency = tng_utf8_decode($agency);
	$cause = tng_utf8_decode($cause);
	$address1 = tng_utf8_decode($address1);
	$address2 = tng_utf8_decode($address2);
	$city = tng_utf8_decode($city);
	$state = tng_utf8_decode($state);
	$zip = tng_utf8_decode($zip);
	$country = tng_utf8_decode($country);
	$phone = tng_utf8_decode($phone);
	$email = tng_utf8_decode($email);
	$www = tng_utf8_decode($www);
}

$info = addslashes($info);
$age = addslashes($age);
$agency = addslashes($agency);
$cause = addslashes($cause);
$address1 = addslashes($address1);
$address2 = addslashes($address2);
$city = addslashes($city);
$state = addslashes($state);
$zip = addslashes($zip);
$country = addslashes($country);
$phone = addslashes($phone);
$email = addslashes($email);
$www = addslashes($www);

if( $addressID ) {
	if( $address1 || $address2 || $city || $state || $zip || $country || $phone || $email || $www ) {
		$query = "UPDATE $address_table SET address1=\"$address1\", address2=\"$address2\", city=\"$city\", state=\"$state\", zip=\"$zip\", country=\"$country\", phone=\"$phone\", email=\"$email\", www=\"$www\" WHERE addressID = \"$addressID\"";
		$rval = 1;
	}
	else {
		$query = "DELETE FROM $address_table WHERE addressID = \"$addressID\"";
		$addressID = "";
	}
	$result = tng_query($query);
}
elseif( $address1 || $address2 || $city || $state || $zip || $country || $phone || $email || $www ) {
	$query = "INSERT INTO $address_table (address1, address2, city, state, zip, country, gedcom, phone, email, www)  VALUES(\"$address1\", \"$address2\", \"$city\", \"$state\", \"$zip\", \"$country\", \"$tree\", \"$phone\", \"$email\", \"$www\")";
	$result = tng_query($query);
	$addressID = tng_insert_id();
	$rval = 1;
}

if( $eventID ) {
	//if nothing, then delete the event
	if( $age || $agency || $cause || $addressID || $info ) {
		$query = "UPDATE $events_table SET age=\"$age\", agency=\"$agency\", cause=\"$cause\", addressID=\"$addressID\", info=\"$info\" WHERE eventID=\"$eventID\"";
		$rval = 1;
	}
	else
		$query = "DELETE FROM $events_table WHERE eventID=\"$eventID\"";
	$result = tng_query($query);
	adminwritelog( $admtext['modifyevent'] . ": $eventID" );
}
else {
	$query = "INSERT INTO $events_table (eventtypeID, persfamID, age, agency, cause, addressID, info, gedcom, parenttag, eventdate, eventdatetr, eventplace)  VALUES(0, \"$persfamID\", \"$age\", \"$agency\", \"$cause\", \"$addressID\", \"$info\", \"$tree\", \"$eventtypeID\", \"\", \"0000-00-00\", \"\")";
	$result = tng_query($query);
	adminwritelog( $admtext['addnewevent'] . ": $eventtypeID/$tree/$persfamID" );
	$rval = 1;
}
echo $rval;
?>