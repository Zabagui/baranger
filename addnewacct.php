<?php
$textpart = "login";
include("tng_begin.php");

$deftext = $text;
include($cms['tngpath'] . "$mylanguage/text.php");
include($cms['tngpath'] . "$mylanguage/cust_text.php"); //needed because alltext.php only gets included once

include($subroot . "logconfig.php");
include($cms['tngpath'] . "tngmaillib.php");

$valid_user_agent = isset($_SERVER["HTTP_USER_AGENT"]) && $_SERVER["HTTP_USER_AGENT"] != "";

$emailfield = $_SESSION['tng_email'];
if(!$emailfield) {
	header("location:newacctform.php");
	exit;
}
$email = $$emailfield;
$_SESSION['tng_email'] = "";

if(preg_match("/\n[[:space:]]*(to|bcc|cc|boundary)[[:space:]]*[:|=].*@/i", $email) || !$valid_user_agent )
	die("sorry!");
if(preg_match("/\r/i", $email) || preg_match("/\n/i", $email) || !preg_match("/@/i", $email) )
	die("sorry!");
if(preg_match("/\n[[:space:]]*(to|bcc|cc|boundary)[[:space:]]*[:|=].*@/i", $username) || !$valid_user_agent )
	die("sorry!");
if(preg_match("/\n/i", $username) )
	die("sorry!");

$username = filterString($username);
$password = filterString($password);
$realname = filterString($realname);
$phone = filterString($phone);
$email = filterString($email);
$website = filterString($website);
$address = filterString($address);
$city = filterString($city);
$state = filterString($state);
$zip = filterString($zip);
$country = filterString($country);
$notes = filterString($notes);

$realname = strtok( $realname, ",;" );
if( strpos($email,",") !== false || strpos($email,";") !== false || !$email) die("sorry!");

if( $addr_exclude ) {
	$bad_addrs = explode(",", $addr_exclude);
	foreach( $bad_addrs as $bad_addr ) {
		if( $bad_addr ) {
			if( strstr( $email, trim($bad_addr) ) )
				die("sorry");
		}
	}
}

if( $msg_exclude ) {
	$bad_msgs = explode(",", $msg_exclude);
	foreach( $bad_msgs as $bad_msg ) {
		if( $bad_msg ) {
			if( strstr( $username, trim($bad_msg) ) || strstr( $password, trim($bad_msg) ) || strstr( $realname, trim($bad_msg) ) || strstr( $notes, trim($bad_msg) ) )
				die("sorry");
		}
	}
}

/*
if (get_magic_quotes_gpc() == 0) {
	$username = addslashes($username);
	$password = addslashes($password);
	$realname = addslashes($realname);
	$phone = addslashes($phone);
	$email = addslashes($email);
	$website = addslashes($website);
	$address = addslashes($address);
	$city = addslashes($city);
	$state = addslashes($state);
	$zip = addslashes($zip);
	$country = addslashes($country);
}
*/

$username = trim( $username );
$password = trim( $password );
$realname = trim( $realname );
$email = trim( $email );
$today = date( "Y-m-d H:i:s", time() + ( 3600 * $time_offset ) );
$dt_consented = !empty($tng_user_consent) ? $today : "";

if($tngconfig['autotree']) {
	$query = "SELECT MAX(0+SUBSTRING(gedcom,5)) as oldID FROM $trees_table WHERE gedcom LIKE \"tree%\"";
	$result = tng_query($query);
	if(tng_num_rows($result)) {
		$maxrow = tng_fetch_array( $result );
		$gedcom = "tree" . ($maxrow['oldID'] + 1);
	}
	else
		$gedcom = "tree1";
	tng_free_result($result);

	if($tngconfig['autoapp']) {
		$template = "ssssssssss";
		$query = "INSERT IGNORE INTO $trees_table (gedcom,treename,description,owner,email,address,city,state,country,zip,phone,secret,disallowgedcreate) VALUES (?,?,'',?,?,?,?,?,?,?,?,'0','0')";
		$params = array(&$template,&$gedcom, &$realname, &$realname, &$email, &$address, &$city, &$state, &$country, &$zip, &$phone);
		tng_execute($query,$params);
	}
}
else
	$gedcom = !empty($assignedtree) ? $assignedtree : "";

if( $username && $password && $realname && $email && $fingerprint == "realperson" ) {
	if($tngconfig['autoapp']) {
		$allow_living_val = 0;
		$moreinfo = $deftext['accactive'];
		$org_password = $password;
		$password = PasswordEncode($password);
	}
	else {
		$allow_living_val = -1;
		$moreinfo = $deftext['accinactive'];
	}
	$password_type = PasswordType();
	$template = "sssssssssssssssssss";
	$query = "INSERT INTO $users_table (description,username,password,password_type,realname,phone,email,website,address,city,state,zip,country,languageID,notes,gedcom,role,allow_living,dt_registered,dt_consented) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,'guest',?,?,?)";
	$params = array(&$template,&$realname, &$username, &$password, &$password_type, &$realname, &$phone, &$email, &$website, &$address, &$city, &$state, &$zip, &$country, &$preflang, &$notes, &$gedcom, &$allow_living_val, &$today, &$dt_consented);
	$success = tng_execute_noerror($query,$params);
}
else
	$success = 0;

tng_header( $text['regnewacct'], $flags );

echo "<p class=\"header\">{$text['regnewacct']}</span></p><br />\n";
echo "<span class=\"normal\">\n";
if( $success > 0 ) {
	echo "<p>{$text['success']}</p>";
	if( $emailaddr ) {
		$emailtouse = $tngconfig['fromadmin'] == 1 ? $emailaddr : $email;
		$message = "{$deftext['name']}: $realname\n{$deftext['username']}: $username\n\n{$deftext['emailmsg']} $moreinfo\n\n{$text['administration']}: $tngdomain/admin.php";
		$owner = preg_replace("/,/", "", ($sitename ? $sitename : ($dbowner ? $dbowner : "TNG")));
		tng_sendmail($owner, $emailtouse, $dbowner, $emailaddr, $deftext['emailsubject'], $message, $emailaddr, $email);

		$welcome = "";
		if($tngconfig['autoapp']) {
			//send email to user saying they're ready to go
			//include password if that feature not turned off
			$welcome = $admtext['hello'] . " $realname,\r\n\r\n{$admtext['activated']}";
			if(!$tngconfig['omitpwd'])
				$welcome .= "{$text['password']}: $org_password\r\n";
			$welcome .= "\r\n$dbowner\r\n$tngdomain";
			$subject = $admtext['subjectline'];
		}
		elseif($tngconfig['ackemail']) {
			//send email to user saying that we're working on it
			$welcome = $admtext['hello'] . " $realname,\r\n\r\n{$text['ackmessage']}\r\n$dbowner\r\n$tngdomain";
			$subject = $text['acksubject'];
		}
		if($welcome) {
			tng_sendmail($owner, $emailaddr, $realname, $email, $subject, $welcome, $emailaddr, $emailaddr);
		}
	}
}
else
	echo "<p>{$text['failure']}</p>";
echo "</span>";

tng_footer( "" );
?>