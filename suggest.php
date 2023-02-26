<?php
$textpart = "gedcom";
include("tng_begin.php");

//$tngconfig['maint'] = "";
if(!empty($cms['events'])){include('cmsevents.php'); cms_contact();}

$_SESSION['tng_email'] = generatePassword(1);
$_SESSION['tng_comments'] = generatePassword(1);
$_SESSION['tng_yourname'] = generatePassword(1);

$flags['scripting'] = "<script type=\"text/javascript\">
function validateForm() {
	if( document.suggest." . $_SESSION['tng_yourname'] . ".value == \"\" ) {
		alert(\"{$text['entername']}\");
		return false;
	}
	var reg = /^([A-Za-z0-9_\-\.+])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,6})$/;
	var address = document.suggest." . $_SESSION['tng_email'] . ".value;
	if(address.length == 0 || reg.test(address) == false){
		alert(\"{$text['enteremail']}\");
		return false;
	}
	else if( document.suggest.em2.value.length == 0 ) {
		alert(\"{$text['enteremail2']}\");
		return false;
	}
	else if( document.suggest.{$_SESSION['tng_email']}.value != document.suggest.em2.value ) {
		alert(\"{$text['emailsmatch']}\");
		return false;
	}
	else if( document.suggest." . $_SESSION['tng_comments'] . ".value == \"\" ) {
		alert(\"{$text['entercomments']}\");
		return false;
	}";
if($tngconfig['askconsent']) {
	$flags['scripting'] .= "
	else if( !document.suggest.tng_user_consent.checked ) {
		alert(\"{$text['consentreq']}\");
		return false;
	}";
}
$flags['scripting'] .= "
	return true;
}
</script>\n";

$righttree = checktree($tree);
$enttype = isset($enttype) ? preg_replace("/[^A-Za-z0-9_\-. ]/", '', $enttype) : "";
$ID = isset($ID) ? preg_replace("/[^A-Za-z0-9_\-. ]/", '', $ID) : "";
$page = isset($page) ? strip_tags( $page ) : "";

if($currentuser) {
	$query = "SELECT email FROM $users_table WHERE username=\"$currentuser\"";
	$result = tng_query($query);
	$row = tng_fetch_assoc($result);
	$preemail = $row['email'];
	tng_free_result($result);
}
else
	$preemail = "";

if( $enttype == "I" ) {
	$typestr = "person";
	$result = getPersonDataPlusDates($tree, $ID);
	$row = tng_fetch_assoc($result);
	tng_free_result($result);
	if( $row ) {
		$rights = determineLivingPrivateRights($row, $righttree);
		$row['allow_living'] = $rights['living'];
		$row['allow_private'] = $rights['private'];
		$name = getName( $row ) .  " ($ID)";
	}

    $treeResult = getTreeSimple($tree);
    $treerow = tng_fetch_assoc($treeResult);
    $disallowgedcreate = $treerow['disallowgedcreate'];
    tng_free_result($treeResult);

	$years = getYears( $row );
}
elseif( $enttype == "F" ) {
	$typestr = "family";
	$result = getFamilyData($tree, $ID);
	$row = tng_fetch_assoc($result);
	tng_free_result($result);

    $hname = $wname = "";
	if( $row ) {
		$rights = determineLivingPrivateRights($row, $righttree);
		$row['allow_living'] = $rights['living'];
		$row['allow_private'] = $rights['private'];

		if( $row['husband'] ) {
	        $result = getPersonSimple($tree, $row['husband']);
	        $prow = tng_fetch_assoc( $result );
	        tng_free_result($result);
			$prights = determineLivingPrivateRights($prow, $righttree);
			$prow['allow_living'] = $prights['living'];
			$prow['allow_private'] = $prights['private'];
	        $hname = getName( $prow );
	    }
	    if( $row['wife'] ) {
	        $result = getPersonSimple($tree, $row['wife']);
	        $prow = tng_fetch_assoc( $result );
	        tng_free_result($result);
			$prights = determineLivingPrivateRights($prow, $righttree);
			$prow['allow_living'] = $prights['living'];
			$prow['allow_private'] = $prights['private'];
	        $wname = getName( $prow );
	    }
	}
    $row['sex'] = '';

    $plus = $hname && $wname ? " + " : "";
    $name = $text['family'] . ": $hname$plus$wname ($ID)";

	$years = $years = !empty($row['marrdate']) && !empty($row['allow_living']) && !empty($row['allow_private']) ? $text['marrabbr'] . " " . displayDate( $row['marrdate'] ) : "";
}
elseif( $enttype == "S" ) {
	$typestr = "source";
	$query = "SELECT title FROM $sources_table WHERE sourceID = \"$ID\" AND gedcom = \"$tree\"";
	$result = tng_query($query);
	$row = tng_fetch_assoc($result);
	tng_free_result($result);
	
	$query = "SELECT count(personID) as ccount FROM $citations_table, $people_table 
		WHERE $citations_table.sourceID = '$ID' AND $citations_table.persfamID = $people_table.personID AND $citations_table.gedcom = $people_table.gedcom
		AND living = '1'";
	$sresult = tng_query($query);
	$srow = tng_fetch_assoc( $sresult );
	$row['living'] = $srow['ccount'] ? 1 : 0;
	$query = "SELECT count(personID) as ccount FROM $citations_table, $people_table
		WHERE $citations_table.sourceID = '$ID' AND $citations_table.persfamID = $people_table.personID AND $citations_table.gedcom = $people_table.gedcom AND private = '1'";
	$sresult = tng_query($query);
	$srow = tng_fetch_assoc( $sresult );
	tng_free_result($sresult);
	$row['private'] = $srow['ccount'] ? 1 : 0;
	$row['sex'] = "";
	if( !isset($row['title']) ) $row['title'] = "";

	$rights = determineLivingPrivateRights($row, $righttree);
	$row['allow_living'] = $rights['living'];
	$row['allow_private'] = $rights['private'];
	
	$name = $text['source'] . ": {$row['title']} ($ID)";
	$years = "";
}
elseif( $enttype == "R" ) {
	$typestr = "repo";
	$query = "SELECT reponame FROM $repositories_table WHERE repoID = \"$ID\" AND gedcom = \"$tree\"";
	$result = tng_query($query);
	$row = tng_fetch_assoc($result);
	tng_free_result($result);

	$row['sex'] = "";
	if( !isset($row['reponame']) ) $row['reponame'] = "";
	$years = "";
	$row['living'] = 0;
	$row['allow_living'] = $row['allow_private'] = 1;

	$name = $text['repository'] . ": {$row['reponame']} ($ID)";
}
elseif( $enttype == "L" ) {
	$typestr = "place";
	$row['sex'] = "";
	$years = "";
	$row['living'] = 0;
	$row['allow_living'] = $row['allow_private'] = 1;
	$name = $ID;
}
else
	$typestr = "";
if( $enttype ) {
		$headline = $text['suggestchange'] . ": $name";
	$comments = $text['comments'];
	tng_header( $headline, $flags );

	$photostr = showSmallPhoto( $ID, $name, $row['allow_living'] && $row['allow_private'], 0, false, $row['sex'] );
	echo tng_DrawHeading( $photostr, $name, $years );

	$innermenu = "&nbsp; \n";
	echo tng_menu( $enttype, "suggest", $ID, $innermenu );
	$buttontext = $text['submitsugg'];
}
else {
	$headline = $text['contactus'];
	$comments = $text['comments2'];
	tng_header( $headline, $flags );
?>

<h1 class="header"><span class="headericon" id="contact-hdr-icon"></span><?php echo $headline; ?></h1><br clear="left"/>
<?php
	$buttontext = $text['sendmsg'];
}

if(!empty($message)) {
	$newmessage = $text[$message];
	if( $message == "mailnotsent" ) {
		$newmessage = preg_replace( "/xxx/", $sowner, $newmessage );
		$newmessage = preg_replace( "/yyy/", $ssendemail, $newmessage );
	}
	echo "<p class=\"normal\"><strong><font color=\"red\">$newmessage</font></strong></p>\n";
}

if( $enttype )
	echo "<span class=\"subhead\"><b>$headline</b></span><br /><br />\n";
?>

<?php
@include($cms['tngpath'] . "TNG_captcha.php");

$formstr = getFORM( "tngsendmail", "post\" onsubmit=\"return validateForm();", "suggest", "suggest" );
echo $formstr;
if($typestr) {
?>
<input type="hidden" name="<?php echo $typestr; ?>ID" value="<?php echo $ID; ?>" />
<?php
}
?>
<table border="0" cellspacing="1" cellpadding="4" class="tfixed whiteback normal" style="width:80%">
<tr><td class="fieldnameback" width="20%"><span class="fieldname"><?php echo $text['yourname']; ?>:&nbsp; </span></td><td class="databack" width="80%"><input type="text" name="<?php echo $_SESSION['tng_yourname']; ?>" class="longfield" /></td></tr>
<tr><td class="fieldnameback"><span class="fieldname"><?php echo $text['email']; ?>:&nbsp; </span></td><td class="databack"><input type="text" name="<?php echo $_SESSION['tng_email']; ?>" class="longfield" value="<?php echo $preemail; ?>" /></td></tr>
<tr><td class="fieldnameback"><span class="fieldname"><?php echo $text['emailagain']; ?>:&nbsp; </span></td><td class="databack"><input type="text" name="em2" class="longfield" value="<?php echo $preemail; ?>" /></td></tr>
<?php
	if($page) {
?>
<tr><td class="fieldnameback"><span class="fieldname"><?php echo $text['subject']; ?>:&nbsp; </span></td><td class="databack"><?php echo stripslashes($page); ?></td></tr>
<?php
	}
?>
<tr>
	<td class="fieldnameback" valign="top"><span class="fieldname"><?php echo $comments; ?>:&nbsp; </span></td>
	<td class="databack">
		<textarea style="width:95%" rows="10" name="<?php echo $_SESSION['tng_comments']; ?>"></textarea>
	</td>
</tr>
</table>
<input type="hidden" name="enttype" value="<?php echo $enttype; ?>" />
<input type="hidden" name="ID" value="<?php echo $ID; ?>" />
<input type="hidden" name="tree" value="<?php echo $tree; ?>" />
<input type="hidden" name="page" value="<?php echo $page; ?>" />
<?php
	if($tngconfig['askconsent']) {
?>
<br/>
<input type="checkbox" name="tng_user_consent" value="1"> 
<?php 
		echo $text['consent']; 
	}
	if($tngconfig['dataprotect']) {
		$dataprotect_url = getURL( "data_protection_policy", 0 );
		echo "<br/><a href=\"{$dataprotect_url}\" target=\"_blank\">{$text['dataprotect']}</a>\n";
	}
?>
<br/><br/>
<input type="submit" class="btn" id="submitbtn" value="<?php echo $buttontext; ?>"/>
</form>
<br />
<?php
	tng_footer( "" );
?>