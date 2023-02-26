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

if( $assignedtree || !$allow_add ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

if( !empty($gedcom_mult) ) {
	$gedcom2 = implode(',',$gedcom_mult);
	if($gedcom2)
		$gedcom = $gedcom2;
}

/*
if (get_magic_quotes_gpc() == 0) {
	$description = addslashes($description);
	$username = addslashes($username);
	$gedcom = addslashes($gedcom);
	$branch = addslashes($branch);
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
}
*/

$orgpwd = $password;
$password = PasswordEncode($password);
$password_type = PasswordType();

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
$dt_consent = !empty($consented) && $consented == 1 ? $today : "";

$duplicate = false;
$emailstr = $email ? " OR LOWER(email) = LOWER(\"$email\")" : "";
$query = "SELECT username FROM $users_table WHERE LOWER(username) = LOWER(\"$username\")$emailstr";
$result = tng_query($query);

if( $result && tng_num_rows( $result ) )
	$duplicate = true;

if(!$duplicate) {
	$template = "sssssssssssssssssssssssssssssssssss";
	$query = "INSERT IGNORE INTO $users_table (description,username,password,password_type,realname,phone,email,website,address,city,state,zip,country,languageID,notes,gedcom,mygedcom,personID,role,allow_edit,allow_add,tentative_edit,allow_delete,allow_lds,allow_living,allow_private,allow_private_notes,allow_ged,allow_pdf,allow_profile,branch,dt_activated,dt_consented,no_email,disabled)
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	$params = array(&$template, &$description,&$username,&$password,&$password_type,&$realname,&$phone,&$email,&$website,&$address,&$city,&$state,&$zip,&$country,&$preflang,&$notes,&$gedcom,&$mynewgedcom,&$personID,&$role,&$form_allow_edit,&$form_allow_add,&$form_tentative_edit,&$form_allow_delete,&$form_allow_lds,&$form_allow_living,&$form_allow_private,&$form_allow_private_notes,&$form_allow_ged,&$form_allow_pdf,&$form_allow_profile,&$branch,&$today,&$dt_consent,&$no_email,&$disabled);
	tng_execute($query,$params);

	if( !empty($notify) && !empty($email) ) {
		$owner = preg_replace("/,/", "", ($sitename ? $sitename : ($dbowner ? $dbowner : "TNG")));

		tng_sendmail($owner, $emailaddr, $realname, $email, $admtext['subjectline'], $welcome, $emailaddr, $emailaddr);
	}

	if( tng_affected_rows() ) {
		$userID = tng_insert_id();
		adminwritelog( "<a href=\"admin_edituser.php?userID=$userID\">{$admtext['addnewuser']}: $username</a>" );
		if($currentuser == "Administrator-No-Users-Yet" ) {
			$_SESSION['currentuser'] = $username;
			$_SESSION['currentuserdesc']= $description;
		}
	}
	else
		$message = $admtext['userfailed'] . ".";
}
else
	$message = $admtext['duplicate'];

if( !empty($submitx) || !empty($message) ) {
	$message = $admtext['user'] . " $username {$admtext['succadded']}.";
	header( "Location: admin_users.php?message=" . urlencode($message) );
}
else {
	header( "Location: admin_edituser.php?userID=$userID" );
}
?>