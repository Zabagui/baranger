<?php
include("begin.php");
include("adminlib.php");
$textpart = "families";
//include("getlang.php");
include("$mylanguage/admintext.php");

include($cms['tngpath'] . "checklogin.php");

if($session_charset != "UTF-8") {
	$myhusbname = tng_utf8_decode($myhusbname);
	$mywifename = tng_utf8_decode($mywifename);
}

$allwhere = "$families_table.gedcom = \"$tree\"";
$joinon = "";
if( $assignedbranch )
	$allwhere .= " AND $families_table.branch LIKE \"%$assignedbranch%\"";
	
$allwhere2 = "";
	
if( $mywifename ) {
	$terms = explode( ' ',  $mywifename );
	foreach( $terms as $term ) {
		if( $allwhere2 ) $allwhere2 .= " AND ";
		$allwhere2 .= "CONCAT_WS(' ',wifepeople.firstname,TRIM(CONCAT_WS(' ',wifepeople.lnprefix,wifepeople.lastname))) LIKE \"%$term%\"";
	}
}

if( $myhusbname ) {
	$terms = explode( ' ',  $myhusbname );
	foreach( $terms as $term ) {
		if( $allwhere2 ) $allwhere2 .= " AND ";
		$allwhere2 .= "CONCAT_WS(' ',husbpeople.firstname,TRIM(CONCAT_WS(' ',husbpeople.lnprefix,husbpeople.lastname))) LIKE \"%$term%\"";
	}
}
else
	$joinonhusb = "";
	
if( $allwhere2 )
	$allwhere2 = "AND $allwhere2";

$joinonwife = "LEFT JOIN $people_table AS wifepeople ON $families_table.wife = wifepeople.personID AND $families_table.gedcom = wifepeople.gedcom";
$joinonhusb = "LEFT JOIN $people_table AS husbpeople ON $families_table.husband = husbpeople.personID AND $families_table.gedcom = husbpeople.gedcom";
$query = "SELECT familyID, wifepeople.personID as wpersonID, wifepeople.firstname as wfirstname, wifepeople.lnprefix as wlnprefix, wifepeople.lastname as wlastname, wifepeople.suffix as wsuffix, wifepeople.nameorder as wnameorder, wifepeople.living as wliving, wifepeople.private as wprivate, wifepeople.branch as wbranch,
	husbpeople.personID as hpersonID, husbpeople.firstname as hfirstname, husbpeople.lnprefix as hlnprefix, husbpeople.lastname as hlastname, husbpeople.suffix as hsuffix, husbpeople.nameorder as hnameorder, husbpeople.living as hliving, husbpeople.private as hprivate, husbpeople.branch as hbranch FROM $families_table $joinonwife $joinonhusb WHERE $allwhere $allwhere2 ORDER BY hlastname, hlnprefix, hfirstname LIMIT 250";
$result = tng_query($query);

header("Content-type:text/html; charset=" . $session_charset);
?>

<div class="databack ajaxwindow" id="findfamilyresdiv">
<table border="0" cellpadding="0">
<tr>
	<td valign="top">
		<span class="subhead"><strong><?php echo $admtext['searchresults']; ?></strong></span><br/>
		<span class="normal">(<?php echo $admtext['clicktoselect']; ?>)</span><br/>
	</td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td>
		<form action=""><input type="button" value="<?php echo $admtext['find']; ?>" onClick="reopenFindForm();"></form>
	</td>
</tr>
</table><br/>
<table border="0" cellspacing="0" cellpadding="2">
<?php
while( $row = tng_fetch_assoc($result)) {
	$thisfamily = "";
	if( $row['hpersonID'] ) {
		$person['firstname'] = $row['hfirstname'];
		$person['lnprefix'] = $row['hlnprefix'];
		$person['lastname'] = $row['hlastname'];
		$person['suffix'] = $row['hsuffix'];
		$person['nameorder'] = $row['hnameorder'];
		$person['living'] = $row['hliving'];
		$person['private'] = $row['hprivate'];
		$person['branch'] = $row['hbranch'];
		$person['allow_living'] = determineLivingRights($person);
		$thisfamily .= getName( $person );
	}
	if( $row['wpersonID'] ) {
		if( $thisfamily ) $thisfamily .= "<br/>";
		$person['firstname'] = $row['wfirstname'];
		$person['lnprefix'] = $row['wlnprefix'];
		$person['lastname'] = $row['wlastname'];
		$person['suffix'] = $row['wsuffix'];
		$person['nameorder'] = $row['wnameorder'];
		$person['living'] = $row['wliving'];
		$person['private'] = $row['wprivate'];
		$person['branch'] = $row['wbranch'];
		$person['allow_living'] = determineLivingRights($person);
		$thisfamily .= getName( $person );
	}
	echo "<tr><td valign=\"top\"><span class=\"normal\"><a href=\"#\" onClick=\"return returnName('{$row['familyID']}','','text','{$row['familyID']}');\">{$row['familyID']}</a></span></td><td><span class=\"normal\"><a href=\"#\" onclick=\"return returnName('{$row['familyID']}','','text','{$row['familyID']}');\">$thisfamily</a></span></td></tr>\n";
}
tng_free_result($result);
?>
</table>
</div>
