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

if( $assignedtree ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}
if( $gedcom ) {
	$recipstr = "gedcom=\"$gedcom\"";
	if( $branch )
		$recipstr = "($recipstr AND branch=\"$branch\")";
	$wherestr = !empty($sendtoadmins) ? " AND ($recipstr OR gedcom=\"\")" : " AND $recipstr";
}

$recipientquery = "SELECT realname, email FROM $users_table WHERE allow_living != \"-1\" AND email != \"\" AND (no_email is NULL or no_email != \"1\") $wherestr";
$result = tng_query($recipientquery) or die ($admtext['cannotexecutequery'] . ": $recipientquery");
$numrows = tng_num_rows( $result );

if ( !$numrows ) {
	$message = $admtext['nousers'];
	header( "Location: admin_users.php?message=" . urlencode($message) );
}
else {
	$subject = stripslashes($subject);
	$body = stripslashes($messagetext);
	$owner = preg_replace("/,/", "", ($sitename ? $sitename : ($dbowner ? $dbowner : "TNG")));

	while( $row = tng_fetch_assoc($result)) {
		$recipient = $row['email'];
		tng_sendmail($owner, $emailaddr, $row['realname'], $recipient, $subject, $body, $emailaddr, $emailaddr);
	}

	adminwritelog( $admtext['sentmailmessage'] );
	$message = $admtext['succmail'] . ".";
}

tng_free_result($result);

header( "Location: admin_mailusers.php?message=" . urlencode($message) );
?>
