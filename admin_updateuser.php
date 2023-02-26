<?php
include("begin.php");
include("adminlib.php");
$textpart = "users";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

require("adminlog.php");
include("tngmaillib.php");

if( $assignedtree || !$allow_edit ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

if(!empty($gedcom_mult) && is_array($gedcom_mult) && !$gedcom)
	$gedcom = implode(',',$gedcom_mult);
if( !isset($description) ) $description = "";
if( !isset($gedcom) ) $gedcom = "";
if( !isset($branch) ) $branch = "";
if( !isset($notes) ) $notes = "";

$description = addslashes($description);
$username = addslashes($username);
$orguser = addslashes($orguser);
$orgemail = addslashes($orgemail);
$gedcom = addslashes($gedcom);
$branches = addslashes($branch);
$realname = addslashes($realname);
$phone = addslashes($phone);
$email = addslashes($email);
$address = addslashes($address);
$notes = addslashes($notes);
$website = addslashes($website);
$city = addslashes($city);
$state = addslashes($state);
$zip = addslashes($zip);
$country = addslashes($country);

if( ($password != $orgpwd) || $newuser) {
	$password = PasswordEncode($password);
	$password_type = PasswordType();
	$pwd_str = "password=\"$password\",password_type=\"$password_type\",";
}
else
	$pwd_str = "";

if( !$form_allow_add ) $form_allow_add = 0;
if( !$form_allow_delete ) $form_allow_delete = 0;
if( $form_allow_edit == 2 ) {
	$form_tentative_edit = 1;
	$form_allow_edit = 0;
}
else{
	$form_tentative_edit = 0;
}
if( empty($form_allow_ged) ) $form_allow_ged = 0;
if( empty($form_allow_pdf) ) $form_allow_pdf = 0;
if( empty($form_allow_living) ) $form_allow_living = 0;
if( empty($form_allow_private) ) $form_allow_private = 0;
if( empty($form_allow_private_notes) ) $form_allow_private_notes = 0;
if( empty($form_allow_lds) ) $form_allow_lds = 0;
if( empty($form_allow_profile) ) $form_allow_profile = 0;
if( empty($no_email) ) $no_email = 0;
if( empty($disabled) ) $disabled = 0;
if( empty($preflang) ) $preflang = 0;
$today = date( "Y-m-d H:i:s", time() + ( 3600 * $time_offset ) );
$dt_consent = isset($consented) && $consented == 1 ? $today : "";

//if the username has changed, we must look up the new name to see if it exists
//if it exists, "duplicate"
$duplicate = false;
if($username != $orguser) {
	$query = "SELECT username FROM $users_table WHERE LOWER(username) = LOWER(\"$username\")";
	$result = tng_query($query);

	if( $result && tng_num_rows( $result ) )
		$duplicate = true;
}
if(!$duplicate && $email && $email != $orgemail) {
	$query = "SELECT username FROM $users_table WHERE LOWER(email) = LOWER(\"$email\")";
	$result = tng_query($query);

	if( $result && tng_num_rows( $result ) )
		$duplicate = true;
}

if(!$duplicate) {
	$activatedstr = $newuser ? ", dt_activated=\"$today\"" : "";
	$consentedstr = $dt_consent? ", dt_consented=\"$dt_consent\"" : "";
	$query = "UPDATE $users_table SET description=\"$description\",username=\"$username\",{$pwd_str}realname=\"$realname\",phone=\"$phone\",email=\"$email\",website=\"$website\",address=\"$address\",city=\"$city\",state=\"$state\",zip=\"$zip\",country=\"$country\",languageID=\"$preflang\",notes=\"$notes\",gedcom=\"$gedcom\",mygedcom=\"$mynewgedcom\",personID=\"$personID\",role=\"$role\",allow_edit=\"$form_allow_edit\",allow_add=\"$form_allow_add\",tentative_edit=\"$form_tentative_edit\",allow_delete=\"$form_allow_delete\",allow_lds=\"$form_allow_lds\",allow_living=\"$form_allow_living\",allow_private=\"$form_allow_private\",allow_private_notes=\"$form_allow_private_notes\",allow_ged=\"$form_allow_ged\",allow_pdf=\"$form_allow_pdf\",allow_profile=\"$form_allow_profile\",branch=\"$branch\"{$activatedstr}{$consentedstr},no_email=\"$no_email\",disabled=\"$disabled\"
		WHERE userID=\"$userID\"";

	$result = @tng_query($query);

	if( !empty($notify) && $email ) {
		$owner = preg_replace("/,/", "", ($sitename ? $sitename : ($dbowner ? $dbowner : "TNG")));

		$deftext = $admtext;
		if($preflang) {
			$query = "SELECT folder FROM $languages_table WHERE languageID = \"$preflang\"";
			$result = tng_query($query) or die ("Cannot execute query: $query"); //message is hardcoded because we haven't included the text file yet
			$langrow = tng_fetch_assoc($result);
			tng_free_result( $result );

			if($langrow['folder']) {
				$oldtext = $admtext;
				include($cms['tngpath'] . "$languages_path{$langrow['folder']}/admintext.php");
				$deftext = $admtext;
				$admtext = $oldtext;
			}
		}
		tng_sendmail($owner, $emailaddr, $realname, $email, $deftext['subjectline'], stripslashes($welcome), $emailaddr, $emailaddr);
	}

	adminwritelog( "<a href=\"admin_edituser.php?userID=$userID\">{$admtext['modifyuser']}: $userID</a>" );

	$message = $admtext['changestouser'] . " $userID {$admtext['succsaved']}.";
}
else
	$message = $admtext['duplicate'];

if( $newuser ) {
	if($tngconfig['autotree'] && !$tngconfig['autoapp']) {
		$query = "INSERT IGNORE INTO $trees_table (gedcom,treename,description,owner,email,address,city,state,country,zip,phone,secret,disallowgedcreate) VALUES (\"$gedcom\",\"$realname\",\"\",\"$realname\",\"$email\",\"$address\",\"$city\",\"$state\",\"$country\",\"$zip\",\"$phone\",\"0\",\"0\")";
		$result = tng_query($query);
	}
	header( "Location: admin_reviewusers.php?message=" . urlencode($message) );
}
else {
	if( !empty($submitx) ) {
		header( "Location: admin_users.php?message=" . urlencode($message) );
	}
	else {
		header( "Location: admin_edituser.php?userID=$userID" );
	}
}
?>