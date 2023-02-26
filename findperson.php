<?php
include("begin.php");
include($cms['tngpath'] . "adminlib.php");
$textpart = "people";
include($cms['tngpath'] . "getlang.php");
include($cms['tngpath'] . "$mylanguage/admintext.php");

include($cms['tngpath'] . "checklogin.php");

if($session_charset != "UTF-8") {
	$myfirstname = tng_utf8_decode($myfirstname);
	$mylastname = tng_utf8_decode($mylastname);
}

$allwhere = "gedcom = \"$tree\"";
if( $personID )
	$allwhere .= " AND personID = \"$personID\"";
if( $myfirstname )
	$allwhere .= " AND firstname LIKE \"%" . trim($myfirstname) . "%\"";
if( $mylastname ) {
	if( $lnprefixes )
		$allwhere .= " AND CONCAT_WS(' ',lnprefix,lastname) LIKE \"%" . trim($mylastname) . "%\"";
	else
		$allwhere .= " AND lastname LIKE \"%" . trim($mylastname) . "%\"";
}

if( $livedefault < 2 && ( !$allow_living_db || $assignedtree ) && $nonames == 1) {
	$allwhere .= " AND ";
	if( $allow_living_db ) {
		if( $assignedbranch )
			$allwhere .= "(living != 1 OR branch LIKE \"%$assignedbranch%\")";
		else
			$allwhere .= "living != 1";
	}
	else
		$allwhere .= "living != 1 AND private != 1";
}

//if( $field == "husband" )
//	$allwhere .= " AND sex = \"M\"";
//else if( $field == "wife" )
//	$allwhere .= " AND sex = \"F\"";
$query = "SELECT personID, lastname, firstname, lnprefix, birthdate, altbirthdate, deathdate, burialdate, prefix, suffix, nameorder, living, private, branch, gedcom FROM $people_table WHERE $allwhere ORDER BY lastname, lnprefix, firstname LIMIT 250";
$result = tng_query($query);

header("Content-type:text/html; charset=" . $session_charset);
?>

<div class="databack ajaxwindow" id="findpersonresdiv">
<table border="0" cellpadding="0">
<tr>
	<td>
		<p class="subhead"><strong><?php echo $admtext['searchresults']; ?></strong></p>
		<span class="normal">(<?php echo $admtext['clicktoselect']; ?>)</span><br/>
	</td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td valign="top">
		<form action="" ><input type="button" value="<?php echo $admtext['find']; ?>" onclick="reopenFindForm()"></form>
	</td>
</tr>
</table><br/>
<table border="0" cellspacing="0" cellpadding="2">
<?php
while( $row = tng_fetch_assoc($result))
{
	$birthdate = $deathdate = "";
	$row['allow_living'] = determineLivingRights($row);
	
	if($row['allow_living']) {
		if ( $row['birthdate'] ) {
			$birthdate = "{$admtext['birthabbr']} {$row['birthdate']}";
		}
		else if ( $row['altbirthdate'] ) {
			$birthdate = "{$admtext['chrabbr']} {$row['altbirthdate']}";
		}
		if ( $row['deathdate'] ) {
			$deathdate = "{$admtext['deathabbr']} {$row['deathdate']}";
		}
		else if ( $row['burialdate'] ) {
			$deathdate = "{$admtext['burialabbr']} {$row['burial']}";
		}
		if( !$birthdate && $deathdate )
			$birthdate = $admtext['nobirthinfo'];
	}
	$name = getName( $row );
	if($fieldtype == "select")
		$namestr = addslashes($name) . "| - {$row['personID']}<br />$birthdate";
	elseif($textchange) {
		$birthdatestr = displayDate($birthdate);
		$namestr = addslashes( preg_replace('/\"/',"&#34;",getName( $row ) . ($birthdatestr ? " (" . displayDate($birthdate) . ")" : "") . " - {$row['personID']}"));
		$nameplusid = $textchange;
	}
	elseif( $nameplusid == 1)
		$namestr = addslashes( "$name");
	elseif( $nameplusid )
		$namestr = addslashes( "$name - {$row['personID']}");
	else
		$namestr = addslashes( "$name");
	$jsnamestr = str_replace("&#34;","&lsquo;",$namestr);
	$jsnamestr = str_replace("\\\"","&lsquo;",$namestr);
	echo "<tr><td valign=\"top\"><span class=\"normal\"><a href=\"#\" onClick=\"return returnName('{$row['personID']}','$jsnamestr','$fieldtype','$nameplusid');\">{$row['personID']}</a></span></td><td><span class=\"normal\"><a href=\"#\" onClick=\"return returnName('{$row['personID']}','$jsnamestr','$fieldtype','$nameplusid');\">$name</a><br/>$birthdate $deathdate</span></td></tr>\n";
}
tng_free_result($result);
?>
</table>
</div>