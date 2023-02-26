<?php
include("begin.php");
$tngconfig['maint'] = "";
include($cms['tngpath'] . "genlib.php");
$textpart = "gedcom";
include($cms['tngpath'] . "getlang.php");
include($cms['tngpath'] . "$mylanguage/text.php");

if(!empty($enttype))
	include($cms['tngpath'] . "checklogin.php");
include($subroot . "logconfig.php");
include($cms['tngpath'] . "tngmaillib.php");

$valid_user_agent = isset($_SERVER["HTTP_USER_AGENT"]) && $_SERVER["HTTP_USER_AGENT"] != "";

if(!empty($_SESSION['tng_email'])) {
	$emailfield = $_SESSION['tng_email'];
	$youremail = $$emailfield;
}
else
	$youremail = "";
$_SESSION['tng_email'] = "";

if(!empty($_SESSION['tng_comments'])) {
	$commentsfield = $_SESSION['tng_comments'];
	$comments = $$commentsfield;
}
else
	$comments = "";
$_SESSION['tng_comments'] = "";

if(!empty($_SESSION['tng_yourname'])) {
	$yournamefield = $_SESSION['tng_yourname'];
	$yourname = $$yournamefield;
}
else
	$yourname = "";
$_SESSION['tng_yourname'] = "";

$tngwebsite = $cms['support'] ? "http://". $_SERVER['HTTP_HOST'] : $tngdomain;

if(preg_match("/\n[[:space:]]*(to|bcc|cc|boundary)[[:space:]]*[:|=].*@/i", $youremail) || preg_match("/[\r|\n][[:space:]]*(to|bcc|cc|boundary)[[:space:]]*[:|=].*@/", $yourname) || !$valid_user_agent )
	die("sorry!");
if(preg_match("/\r/", $youremail) || preg_match("/\n/", $youremail) || preg_match("/\r/", $yourname) || preg_match("/\n/", $yourname) )
	die("sorry!");

$youremail = strtok( $youremail, ",; " );
if( !$youremail || !$comments || !$yourname ) die("sorry!");

if( $addr_exclude ) {
	$bad_addrs = explode(",", $addr_exclude);
	foreach( $bad_addrs as $bad_addr ) {
		if( $bad_addr ) {
			if( strstr( $youremail, trim($bad_addr) ) )
				die("sorry");
		}
	}
}

if( $msg_exclude ) {
	$bad_msgs = explode(",", $msg_exclude);
	foreach( $bad_msgs as $bad_msg ) {
		if( $bad_msg ) {
			if( stristr( $comments, trim($bad_msg) ) )
				die("sorry");
		}
	}
}

$suggest_url = getURL( "suggest", 1 );

if( $enttype == "I" ) {
	$typestr = "person";
	$query = "SELECT firstname, lnprefix, lastname, prefix, suffix, title, sex, nameorder, living, private, branch, $people_table.gedcom, disallowgedcreate, IF(birthdatetr !='0000-00-00',YEAR(birthdatetr),YEAR(altbirthdatetr)) as birth, IF(deathdatetr !='0000-00-00',YEAR(deathdatetr),YEAR(burialdatetr)) as death
		FROM $people_table, $trees_table WHERE personID = \"$ID\" AND $people_table.gedcom = \"$tree\" AND $people_table.gedcom = $trees_table.gedcom";
	$result = tng_query($query);
	$row = tng_fetch_assoc($result);

	$righttree = checktree($tree);
	$rights = determineLivingPrivateRights($row, $righttree);
	$row['allow_living'] = $rights['living'];
	$row['allow_private'] = $rights['private'];

	$name = getName( $row ) . " ($ID)";
	$pagelink = "$tngwebsite/" . getURL("getperson", 1) . "personID=$ID&tree=$tree";
	tng_free_result($result);
}
elseif( $enttype == "F" ) {
	$typestr = "family";
	$query = "SELECT familyID, husband, wife, living, private, marrdate, gedcom, branch FROM $families_table WHERE familyID = \"$ID\" AND gedcom = \"$tree\"";
	$result = tng_query($query);
	$row = tng_fetch_assoc($result);

	$righttree = checktree($tree);
	$rights = determineLivingPrivateRights($row, $righttree);
	$row['allow_living'] = $rights['living'];
	$row['allow_private'] = $rights['private'];

	$name = $text['family'] . ": " . getFamilyName( $row );
	$pagelink = "$tngwebsite/" . getURL("familygroup", 1) . "familyID=$ID&tree=$tree";
	tng_free_result($result);
}
elseif( $enttype == "S" ) {
	$query = "SELECT title FROM $sources_table WHERE sourceID = \"$ID\" AND gedcom = \"$tree\"";
	$result = tng_query($query);
	$row = tng_fetch_assoc($result);
	$name = $text['source'] . ": {$row['title']} ($ID)";
	$pagelink = "$tngwebsite/" . getURL("showsource", 1) . "sourceID=$ID&tree=$tree";
	tng_free_result($result);
}
elseif( $enttype == "R" ) {
	$query = "SELECT reponame FROM $repositories_table WHERE repoID = \"$ID\" AND gedcom = \"$tree\"";
	$result = tng_query($query);
	$row = tng_fetch_assoc($result);
	$name = $text['repository'] . ": {$row['reponame']} ($ID)";
	$pagelink = "$tngwebsite/" . getURL("showrepo", 1) . "repoID=$ID&tree=$tree";
	tng_free_result($result);
}
elseif($enttype == "L") {
	$name = $ID;
	if($tree && !$tngconfig['places1tree'])
    	$treestr = "tree=$tree&amp;";
	else
    	$treestr = "";
	$pagelink = "$tngwebsite/" . getURL( "placesearch", 1 ) . "{$treestr}psearch=" . urlencode($name);
}
if( $enttype ) {
	$subject = $text['proposed'] . ": $name";
	$query = "SELECT treename, email, owner FROM $trees_table WHERE gedcom=\"$tree\"";
	$treeresult = tng_query($query);
	$treerow = tng_fetch_assoc( $treeresult );
	tng_free_result($treeresult);

	$body = $text['proposed'] . ": $name\n{$text['tree']}: {$treerow['treename']}\n{$text['link']}: $pagelink\n\n{$text['description']}: " . stripslashes($comments) . "\n\n$yourname\n$youremail";

	$sendemail = $treerow['email'] ? $treerow['email'] : $emailaddr;
	$owner = $treerow['owner'] ? $treerow['owner'] : ($sitename ? $sitename : $dbowner);
}
else {
	$page = $page ? " ($page)" : "";
	$subject = $text['comments2'] . $page;
	$body = $text['comments2'] . $page . ": " . stripslashes($comments) . "\n\n$yourname\n$youremail";

	$sendemail = $emailaddr;
	$owner = $sitename ? $sitename : $dbowner;
}
if(!empty($currentuser))
  $body .= "\n{$text['user']}: $currentuserdesc ($currentuser)";
$emailtouse = $tngconfig['fromadmin'] == 1 ? $emailaddr : $youremail;

$success = tng_sendmail($yourname, $emailtouse, $owner, $sendemail, $subject, $body, $emailaddr, $youremail);
$message = $success ? "mailsent" : $message = "mailnotsent&sowner=" . urlencode($owner) . "&ssendemail=" . urlencode($sendemail);

header( "Location: $suggest_url" . "enttype=$enttype&ID=$ID&tree=$tree&message=$message" );
?>