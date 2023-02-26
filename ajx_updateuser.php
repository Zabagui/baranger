<?php
include("begin.php");
include("adminlib.php");
$textpart = "users";
//include("getlang.php");
include("$mylanguage/admintext.php");

include("checklogin.php");

require("adminlog.php");

if( !$currentuser || $currentuser != $_POST['orguser']) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$username = addslashes($username);
$realname = addslashes($realname);
$phone = addslashes($phone);
$email = addslashes($email);
$address = addslashes($address);
$website = addslashes($website);
$city = addslashes($city);
$state = addslashes($state);
$zip = addslashes($zip);
$country = addslashes($country);

$proceed = true;
//first validate the original login
$query = "SELECT password FROM $users_table WHERE username = \"$currentuser\" AND password = \"$orgpwd\"";
$result = tng_query($query) or die ("{$admtext['cannotexecutequery']}: $query");

if( !$result || tng_num_rows( $result ) == 0 )
	$proceed = false;
tng_free_result($result);

//check to make sure this user doesn't already exist
if( $proceed && $username != $currentuser) {
	$query = "SELECT username FROM $users_table WHERE username = \"$username\"";
	$result = tng_query($query) or die ("{$admtext['cannotexecutequery']}: $query");
	
	if( $result && tng_num_rows( $result ) )
		$proceed = false;
	tng_free_result($result);
}

if($proceed) {
	if( ($password != $orgpwd) || $newuser) {
		$password = PasswordEncode($password);
		$password_type = PasswordType();
		$pwd_str = "password=\"$password\",password_type=\"$password_type\",";
	}
	else
		$pwd_str = "";
	
	$query = "UPDATE $users_table SET username=\"$username\",{$pwd_str}realname=\"$realname\",phone=\"$phone\",email=\"$email\",website=\"$website\",address=\"$address\",city=\"$city\",state=\"$state\",zip=\"$zip\",country=\"$country\",languageID=\"$preflang\" WHERE username=\"$currentuser\"";
	$result = @tng_query($query);
	
	adminwritelog( "{$admtext['modifyuser']}: $currentuser/a>" );
	
	if(tng_affected_rows() != -1 && ($password != $orgpwd || $username != $currentuser)) {
		$_SESSION['currentuser'] = $username;
		$newroot = preg_replace( "/\//", "", $rootpath );
		$newroot = preg_replace( "/ /", "", $newroot );
		$newroot = preg_replace( "/\./", "", $newroot );
		setcookie("tnguser_$newroot", "", time()-31536000, "/");
		setcookie("tngpass_$newroot", "", time()-31536000, "/");
	}
}
else {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

header( "Location: " . $_SESSION['destinationpage8'] );
?>