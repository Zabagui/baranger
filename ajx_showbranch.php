<?php
include("begin.php");
include("adminlib.php");
$textpart = "branches";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

if( !$allow_edit || ( $assignedtree && $assignedtree != $tree ) ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

header("Content-type:text/html; charset=" . $session_charset);
?>

<div style="margin:10px">
<span class="subhead"><strong><?php echo $admtext['showpeople']; ?></strong></span><br/><br/>
<?php
	$query = "SELECT personID, firstname, lastname, lnprefix, prefix, suffix, title, branch, gedcom, nameorder, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr, living, private FROM $people_table WHERE gedcom = \"$tree\" and branch LIKE \"%$branch%\" ORDER BY lastname, firstname";
	$brresult = tng_query($query);
	$numresults = tng_num_rows($brresult);
	$names = "";
	$counter = $fcounter = 0;

	while( $row = tng_fetch_assoc($brresult)) {
		$rights = determineLivingPrivateRights($row, true, true);
		$row['allow_living'] = $rights['living'];
		$row['allow_private'] = $rights['private'];

		$names .= "<a href=\"admin_editperson.php?personID={$row['personID']}&amp;tree={$row['gedcom']}&amp;cw=1\" target=\"blank\">" . getName( $row ) . " ({$row['personID']})</a><br />\n";
		$counter++;
	}
	tng_free_result( $brresult );

	$query = "SELECT familyID, husband, wife, gedcom, branch, living, private FROM $families_table WHERE gedcom = \"$tree\" AND branch LIKE \"%$branch%\" ORDER BY familyID";
	$brresult = tng_query($query);
	$numfresults = tng_num_rows($brresult);

	if($numresults) $names .= "<br/>\n";
	while( $row = tng_fetch_assoc($brresult)) {
		$rights = determineLivingPrivateRights($row, true, true);
		$row['allow_living'] = $rights['living'];
		$row['allow_private'] = $rights['private'];

		$names .= "<a href=\"admin_editfamily.php?familyID={$row['familyID']}&amp;tree={$row['gedcom']}&amp;cw=1\" target=\"blank\">" . getFamilyName( $row ) . "</a><br />\n";
		$fcounter++;
	}
	tng_free_result( $brresult );

	if(!$names)
		echo "<p>{$admtext['norecords']}</p>";
	else {
		echo "<p class=\"normal\">{$admtext['existlabels']}: $counter {$admtext['people']}, $fcounter {$admtext['families']}.</p>\n";
		echo $names;
	}
?>
</div>
