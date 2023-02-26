<?php
include("begin.php");
include("adminlib.php");
$textpart = "people";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = true;
include("checklogin.php");
include("version.php");

$varlist = array('newsearch','searchstring','tree','living','private','exactmatch','nokids','noparents','nospouse' );
foreach( $varlist as $myvar ) {
   if( !isset( ${$myvar} ) ) {
      ${$myvar} = "";
   }
}

$exptime = 0;
if( $newsearch ) {
	setcookie("tng_search_people_post[search]", $searchstring, $exptime);
	setcookie("tng_search_people_post[tree]", $tree, $exptime);
	setcookie("tng_search_people_post[living]", $living, $exptime);
	setcookie("tng_search_people_post[private]", $private, $exptime);
	setcookie("tng_search_people_post[exactmatch]", $exactmatch, $exptime);
	setcookie("tng_search_people_post[nokids]", $nokids, $exptime);
	setcookie("tng_search_people_post[noparents]", $noparents, $exptime);
	setcookie("tng_search_people_post[nospouse]", $nospouse, $exptime);
	setcookie("tng_search_people_post[tngpage]", 1, $exptime);
	setcookie("tng_search_people_post[offset]", 0, $exptime);
}
else {
	if( !$searchstring && isset( $_COOKIE['tng_search_people_post']['search']) )
		$searchstring = stripslashes($_COOKIE['tng_search_people_post']['search']);
	if( !$tree && isset( $_COOKIE['tng_search_people_post']['tree']) )
		$tree = $_COOKIE['tng_search_people_post']['tree'];
	if( !$living && isset( $_COOKIE['tng_search_people_post']['living']) )
		$living = $_COOKIE['tng_search_people_post']['living'];
	if( !$private && isset( $_COOKIE['tng_search_people_post']['private']) )
		$private = $_COOKIE['tng_search_people_post']['private'];
	if( !$exactmatch && isset( $_COOKIE['tng_search_people_post']['exactmatch']) )
		$exactmatch = $_COOKIE['tng_search_people_post']['exactmatch'];
	if( !$nokids && isset( $_COOKIE['tng_search_people_post']['nokids']) )
		$nokids = $_COOKIE['tng_search_people_post']['nokids'];
	if( !$noparents && isset( $_COOKIE['tng_search_people_post']['noparents']) )
		$noparents = $_COOKIE['tng_search_people_post']['noparents'];
	if( !$nospouse && isset( $_COOKIE['tng_search_people_post']['nospouse']) )
		$nospouse = $_COOKIE['tng_search_people_post']['nospouse'];
	if( !isset($offset) ) {
		$tngpage = isset($_COOKIE['tng_search_people_post']['tngpage']) ? $_COOKIE['tng_search_people_post']['tngpage'] : 1;
		$offset = isset($_COOKIE['tng_search_people_post']['offset']) ? $_COOKIE['tng_search_people_post']['offset'] : 0;
	}
	else {
		setcookie("tng_search_people_post[tngpage]", (isset($tngpage) ? $tngpage : 1), $exptime);
		setcookie("tng_search_people_post[offset]", (isset($offset) ? $offset : 0), $exptime);
	}
}
$searchstring_noquotes = preg_replace("/\"/", "&#34;",$searchstring);
$searchstring = addslashes($searchstring);

if(!empty($order))
	setcookie("tng_search_people_post[order]", $order, $exptime);
else
	$order = isset($_COOKIE['tng_search_people_post']['order']) ? $_COOKIE['tng_search_people_post']['order'] : "name";

if(!isset($offset)) $offset = 0;
if( $offset ) {
	$offsetplus = $offset + 1;
	$newoffset = "$offset, ";
}
else {
	$offsetplus = 1;
	$newoffset = "";
	$tngpage = 1;
}

if( $assignedtree ) {
	$wherestr = "WHERE gedcom = \"$assignedtree\"";
	$tree = $assignedtree;
}
else
	$wherestr = "";
$orgtree = $tree;

$uquery = "SELECT count(userID) as ucount FROM $users_table WHERE allow_living != \"-1\"";
$uresult = tng_query($uquery) or die ($admtext['cannotexecutequery'] . ": $uquery");
$urow = tng_fetch_assoc( $uresult );
$numusers = $urow['ucount'];
tng_free_result($uresult);

function addCriteria( $field, $value, $operator ) {
	$criteria = "";

	if( $operator == "=" ) {
		$criteria = " OR $field $operator \"$value\"";
	}
	else {
		$innercriteria = "";
		$terms = explode( ' ',  $value );
		foreach( $terms as $term ) {
			if( $innercriteria ) $innercriteria .= " AND ";
			$innercriteria .= "$field $operator \"%$term%\"";
		}
		if( $innercriteria ) $criteria = " OR ($innercriteria)";
	}

	return $criteria;
}

$getperson_url = getURL( "getperson", 1 );
if( $tree )
	$allwhere = "$people_table.gedcom = \"$tree\" AND $people_table.gedcom = $trees_table.gedcom ";
else
	$allwhere = "$people_table.gedcom = $trees_table.gedcom ";
if( $assignedbranch )
	$allwhere .= " AND $people_table.branch LIKE \"%$assignedbranch%\"";

if( $searchstring ) {
	$allwhere .= " AND (1=0";
	if( $exactmatch == "yes" ) {
		$frontmod = "=";
	}
	else {
		$frontmod = "LIKE";
	}

	$allwhere .= addCriteria( "$people_table.personID", $searchstring, $frontmod );
	$allwhere .= addCriteria( "CONCAT_WS(' ',TRIM(firstname)" . ($lnprefixes ? ",TRIM(lnprefix)" : "") . ",TRIM(lastname))", $searchstring, $frontmod );
	$allwhere .= ")";
}
if( $living == "yes" )
	$allwhere .= " AND $people_table.living = \"1\"";
if( $private == "yes" )
	$allwhere .= " AND $people_table.private = \"1\"";

if( $noparents ) {
	$noparentjoin = "LEFT JOIN $children_table as noparents ON $people_table.personID = noparents.personID AND $people_table.gedcom = noparents.gedcom";
	$allwhere .= " AND noparents.familyID is NULL";
}
else
	$noparentjoin = "";

if( $nospouse ) {
	$nospousejoin = "LEFT JOIN $families_table as nospousef ON $people_table.personID = nospousef.husband AND $people_table.gedcom = nospousef.gedcom ";
	$nospousejoin .= "LEFT JOIN $families_table as nospousem ON $people_table.personID = nospousem.wife AND $people_table.gedcom = nospousem.gedcom";
	$allwhere .= " AND nospousef.familyID is NULL AND nospousem.familyID is NULL";
}
else
	$nospousejoin = "";

if( $nokids ) {
	$nokidjoin = "LEFT OUTER JOIN $families_table AS familiesH ON $people_table.gedcom=familiesH.gedcom AND $people_table.personID=familiesH.husband ";
	$nokidjoin .= "LEFT OUTER JOIN $families_table AS familiesW ON $people_table.gedcom=familiesW.gedcom AND $people_table.personID=familiesW.wife ";
	$nokidjoin .= "LEFT OUTER JOIN $children_table AS childrenH ON familiesH.gedcom=childrenH.gedcom AND familiesH.familyID=childrenH.familyID ";
	$nokidjoin .= "LEFT OUTER JOIN $children_table AS childrenW ON familiesW.gedcom=childrenW.gedcom AND familiesW.familyID=childrenW.familyID ";
	$nokidhaving = "HAVING ChildrenCount = 0 ";
	$nokidgroup = "GROUP BY $people_table.personID, $people_table.lastname, $people_table.firstname, $people_table.firstname, $people_table.lnprefix, ";
	$nokidgroup .= "$people_table.prefix, $people_table.suffix, $people_table.nameorder, $people_table.birthdate, birthyear, $people_table.birthplace, $people_table.altbirthdate, altbirthyear, ";
	$nokidgroup .= "$people_table.altbirthplace, $people_table.gedcom, $trees_table.treename ";
	$nokidselect = ", SUM((childrenH.familyID is not NULL) + (childrenW.familyID is not NULL)) AS ChildrenCount ";
	$nokidgroup2 = "GROUP BY $people_table.personID, $people_table.lastname, $people_table.firstname, $people_table.firstname, $people_table.lnprefix ";
}
else {
	$nokidjoin = "";
	$nokidhaving = "";
	$nokidgroup = "";
	$nokidselect = "";
}

$idsort = "id";
$birthsort = "birth";
$deathsort = "death";
$namesort = "nameup";
$changesort = "change";
$descicon = "<img src=\"img/tng_sort_desc.gif\" class=\"sortimg\" alt=\"\" />";
$ascicon = "<img src=\"img/tng_sort_asc.gif\" class=\"sortimg\" alt=\"\" />";

if($order == "id") {
	$orderstr = "personIDnum, lastname, lnprefix, firstname";
	$idsort = "<a href=\"admin_people.php?order=idup\" class=\"lightlink\">{$admtext['id']} $descicon</a>";
}
else {
	$idsort = "<a href=\"admin_people.php?order=id\" class=\"lightlink\">{$admtext['id']} $ascicon</a>";
	if($order == "idup")
		$orderstr = "personIDnum DESC, lastname, lnprefix, firstname";
}
if($tngconfig['personsuffix']) {
	$len = strlen($tngconfig['personsuffix']);
	$idselect = ", CAST(LEFT($people_table.personID, LENGTH($people_table.personID)-$len) AS UNSIGNED) AS personIDnum";
}
elseif($tngconfig['personprefix']) {
	$len = strlen($tngconfig['personprefix']);
	$idselect = ", CAST(RIGHT($people_table.personID, LENGTH($people_table.personID)-$len) AS UNSIGNED) AS personIDnum";
}
else
	$idselect = ", CAST($people_table.personID AS UNSIGNED) AS personIDnum";

if($order == "birth") {
	$orderstr = "IF(birthdatetr, birthdatetr, altbirthdatetr), lastname, lnprefix, firstname";
	$birthsort = "<a href=\"admin_people.php?order=birthup\" class=\"lightlink\">{$admtext['birthdate']}, {$admtext['birthplace']} $descicon</a>";
}
else {
	$birthsort = "<a href=\"admin_people.php?order=birth\" class=\"lightlink\">{$admtext['birthdate']}, {$admtext['birthplace']} $ascicon</a>";
	if($order == "birthup")
		$orderstr = "IF(birthdatetr, birthdatetr, altbirthdatetr) DESC, lastname, lnprefix, firstname";
}

if($order == "death") {
	$orderstr = "IF(deathdatetr, deathdatetr, burialdatetr), lastname, lnprefix, firstname";
	$deathsort = "<a href=\"admin_people.php?order=deathup\" class=\"lightlink\">{$admtext['deathdate']}, {$admtext['deathplace']} $descicon</a>";
}
else {
	$deathsort = "<a href=\"admin_people.php?order=death\" class=\"lightlink\">{$admtext['deathdate']}, {$admtext['deathplace']} $ascicon</a>";
	if($order == "deathup")
		$orderstr = "IF(deathdatetr, deathdatetr, burialdatetr) DESC, lastname, lnprefix, firstname";
}

if($order == "name") {
	$orderstr = "lastname, lnprefix, firstname, IF(birthdatetr, birthdatetr, altbirthdatetr)";
	$namesort = "<a href=\"admin_people.php?order=nameup\" class=\"lightlink\">{$admtext['name']} $descicon</a>";
}
else {
	$namesort = "<a href=\"admin_people.php?order=name\" class=\"lightlink\">{$admtext['name']} $ascicon</a>";
	if($order == "nameup")
		$orderstr = "lastname DESC, lnprefix DESC, firstname DESC, IF(birthdatetr, birthdatetr, altbirthdatetr)";
}

if($order == "change") {
	$orderstr = "$people_table.changedate, lastname, lnprefix, firstname";
	$changesort = "<a href=\"admin_people.php?order=changeup\" class=\"lightlink\">{$admtext['lastmodified']} $descicon</a>";
}
else {
	$changesort = "<a href=\"admin_people.php?order=change\" class=\"lightlink\">{$admtext['lastmodified']} $ascicon</a>";
	if($order == "changeup")
		$orderstr = "$people_table.changedate DESC, lastname, lnprefix, firstname";
}

$query = "SET SQL_BIG_SELECTS=1";
$result = tng_query($query);

$query = "SELECT $people_table.ID, $people_table.personID{$idselect}, lastname, firstname, lnprefix, title, prefix, suffix, nameorder, 
	birthdate, birthdatetr, LPAD(SUBSTRING_INDEX(birthdate, ' ', -1),4,'0') as birthyear, birthplace, altbirthdate, altbirthdatetr, LPAD(SUBSTRING_INDEX(altbirthdate, ' ', -1),4,'0') as altbirthyear, altbirthplace, 
	deathdate, deathplace, burialdate, burialplace, $people_table.living, $people_table.private, $people_table.branch, $people_table.gedcom as gedcom, treename, $people_table.changedby, DATE_FORMAT($people_table.changedate,\"%d %b %Y\") as changedatef $nokidselect
	FROM ($people_table, $trees_table) $nokidjoin $noparentjoin $nospousejoin 
	WHERE $allwhere $nokidgroup $nokidhaving ORDER BY $orderstr LIMIT $newoffset" . $maxsearchresults;
$result = tng_query($query);

$numrows = tng_num_rows( $result );
if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
	if($nokids) {
		$query = "SELECT $people_table.ID, $people_table.personID, lastname, firstname, lnprefix $nokidselect
			FROM ($people_table, $trees_table) $nokidjoin $noparentjoin $nospousejoin WHERE $allwhere $nokidgroup2 $nokidhaving";
		$result2 = tng_query($query);
		$totrows = tng_num_rows($result2);
	}
	else {
		$query = "SELECT count($people_table.personID) as pcount FROM ($people_table, $trees_table) $noparentjoin $nospousejoin WHERE $allwhere";
		$result2 = tng_query($query);
		$row = tng_fetch_assoc( $result2 );
		$totrows = $row['pcount'];
	}
	tng_free_result($result2);
}
else
	$totrows = $numrows;

$helplang = findhelp("people_help.php");

$revstar = checkReview("I");

tng_adminheader( $admtext['people'], $flags );
?>
<script type="text/javascript">
function confirmDelete(ID) {
	if(confirm('<?php echo $admtext['confdeletepers']; ?>' ))
		deleteIt('person',ID,'<?php echo $tree; ?>');
	return false;
}

function resetPeople() {
	document.form1.searchstring.value='';
	document.form1.tree.selectedIndex=0;
	document.form1.living.checked=false;
	document.form1.private.checked=false;
	document.form1.exactmatch.checked=false;
	document.form1.nokids.checked=false;
	document.form1.noparents.checked=false;
	document.form1.nospouse.checked=false;
}
</script>
<script type="text/javascript" src="js/admin.js"></script>
</head>

<?php
	echo tng_adminlayout();

	$peopletabs['0'] = array(1,"admin_people.php",$admtext['search'],"findperson");
	$peopletabs['1'] = array($allow_add,"admin_newperson.php",$admtext['addnew'],"addperson");
	$peopletabs['2'] = array($allow_edit,"admin_findreview.php?type=I",$admtext['review'] . $revstar,"review");
	$peopletabs['3'] = array($allow_edit && $allow_delete,"admin_merge.php",$admtext['merge'],"merge");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/people_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($peopletabs,"findperson",$innermenu);
	if( !isset( $message ) ) $message = '';
	echo displayHeadline($admtext['people'],"img/people_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">

	<form action="admin_people.php" name="form1">
	<table>
		<tr>
			<td><span class="normal"><?php echo $admtext['searchfor']; ?>: </span></td>
			<td>
<?php
	include("treequery.php");
?>
				<input type="text" name="searchstring" value="<?php echo $searchstring_noquotes; ?>" class="longfield">
			</td>
			<td>
				<input type="submit" name="submit" value="<?php echo $admtext['search']; ?>" class="aligntop">
				<input type="submit" name="submit" value="<?php echo $admtext['reset']; ?>" onclick="resetPeople();" class="aligntop">
			</td>
		</tr>
		<tr>
			<td>&nbsp;
			</td>
			<td colspan="2">
				<span class="normal">
				<input type="checkbox" name="living" value="yes"<?php if( $living == "yes" ) echo " checked"; ?>> <?php echo $admtext['livingonly']; ?>
				<input type="checkbox" name="private" value="yes"<?php if( $private == "yes" ) echo " checked"; ?>> <?php echo $admtext['privateonly']; ?>
				<input type="checkbox" name="exactmatch" value="yes"<?php if( $exactmatch == "yes" ) echo " checked"; ?>> <?php echo $admtext['exactmatch']; ?>
				<input type="checkbox" name="nokids" value="yes"<?php if( $nokids == "yes" ) echo " checked"; ?>> <?php echo $admtext['nokids']; ?>
				<input type="checkbox" name="noparents" value="yes"<?php if( $noparents == "yes" ) echo " checked"; ?>> <?php echo $admtext['noparents']; ?>
				<input type="checkbox" name="nospouse" value="yes"<?php if( $nospouse == "yes" ) echo " checked"; ?>> <?php echo $admtext['nospouse']; ?>
				</span>
			</td>
		</tr>
	</table>

	<input type="hidden" name="findperson" value="1"><input type="hidden" name="newsearch" value="1">
	</form><br />

<?php
	$numrowsplus = $numrows + $offset;
	if( !$numrowsplus ) $offsetplus = 0;
	echo displayListLocation($offsetplus,$numrowsplus,$totrows);
	$pagenav = get_browseitems_nav( $totrows, "admin_people.php?searchstring=$searchstring&amp;living=$living&amp;private=$private&amp;exactmatch=$exactmatch&amp;offset", $maxsearchresults, 5 );
	echo " &nbsp; <span class=\"adminnav\">$pagenav</span></p>";
?>
	<form action="admin_deleteselected.php" method="post" name="form2">
<?php
	if( $allow_delete ) {
?>
		<p>
		<input type="button" name="selectall" value="<?php echo $admtext['selectall']; ?>" onClick="toggleAll(1);">
		<input type="button" name="clearall" value="<?php echo $admtext['clearall']; ?>" onClick="toggleAll(0);">
  		<input type="submit" name="xperaction" value="<?php echo $admtext['deleteselected']; ?>" onClick="return confirm('<?php echo addslashes($admtext['confdeleterecs']); ?>');">
		</p>
<?php
	}
?>

	<table cellpadding="4" cellspacing="1" border="0" class="normal rounded-table">
		<tr>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['action']; ?></b>&nbsp;</nobr></span></td>
<?php
	if($allow_delete) {
?>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['select']; ?></b>&nbsp;</nobr></span></td>
<?php
	}
?>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $idsort; ?></b>&nbsp;</nobr></span></td>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $namesort; ?></b>&nbsp;</nobr></span></td>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['thumb']; ?></b>&nbsp;</nobr></span></td>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $birthsort; ?></b>&nbsp;</nobr></span></td>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $deathsort; ?></b>&nbsp;</nobr></span></td>
<?php
	if($numtrees > 1) {
?>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['tree']; ?></b>&nbsp;</nobr></span></td>
<?php
	}
?>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $changesort; ?></b>&nbsp;</nobr></span></td>
		</tr>

<?php
	if( $numrows ) {
		$actionstr = "";
		if( $allow_edit )
			$actionstr .= "<a href=\"admin_editperson.php?personID=xxx&amp;tree=yyy\" title=\"{$admtext['edit']}\" class=\"smallicon admin-edit-icon\"></a>";
		if( $allow_delete )
			$actionstr .= "<a href=\"#\" onclick=\"return confirmDelete('zzz');\" title=\"{$admtext['text_delete']}\" class=\"smallicon admin-delete-icon\"></a>";
		$actionstr .= "<a href=\"" . $getperson_url . "personID=xxx&amp;tree=yyy\" target=\"_blank\" title=\"{$admtext['test']}\" class=\"smallicon admin-test-icon\"></a>";

		while( $row = tng_fetch_assoc($result))
		{
			$rights = determineLivingPrivateRights($row);
			$row['allow_living'] = $rights['living'];
			$row['allow_private'] = $rights['private'];
			if ( $row['birthdate'] ) {
				$birthdate = $admtext['birthabbr'] . " " . $row['birthdate'];
				$birthplace = $row['birthplace'];
			}
			else if ( $row['altbirthdate'] ) {
				$birthdate = $admtext['chrabbr'] . " " . $row['altbirthdate'];
				$birthplace = $row['altbirthplace'];
			}
			else {
				$birthdate = "";
				$birthplace = $row['birthplace'] ? $row['birthplace'] : $row['altbirthplace'];
			}
			if ( $row['deathdate'] ) {
				$deathdate = $admtext['deathabbr'] . " " . $row['deathdate'];
				$deathplace = $row['deathplace'];
			}
			else if ( $row['burialdate'] ) {
				$deathdate = $admtext['burialabbr'] . " " . $row['burialdate'];
				$deathplace = $row['burialplace'];
			}
			else {
				$deathdate = "";
				$deathplace = $row['deathplace'] ? $row['deathplace'] : $row['burialplace'];
			}
			$newactionstr = preg_replace( "/xxx/", $row['personID'], $actionstr );
			$newactionstr = preg_replace( "/yyy/", $row['gedcom'], $newactionstr );
			$newactionstr = preg_replace( "/zzz/", $row['ID'], $newactionstr );
			$editlink = "admin_editperson.php?personID={$row['personID']}&amp;tree={$row['gedcom']}";
			if($allow_edit) {
				//$name = "<a href=\"$editlink\">" . getName( $row ) . "</a>";
				$id = "<a href=\"$editlink\" title=\"{$admtext['edit']}\">" . $row['personID'] . "</a>";
			}
			else {
				//$name = getname( $row );
				$id = $row['personID'];
			}
			echo "<tr id=\"row_{$row['ID']}\"><td class=\"lightback\" valign=\"top\"><div class=\"action-btns\">$newactionstr</div></td>\n";
			if($allow_delete)
				echo "<td class=\"lightback\" align=\"center\" valign=\"top\"><input type=\"checkbox\" name=\"del{$row['ID']}\" value=\"1\"></td>";
			echo "<td class=\"lightback\" valign=\"top\">$id</td>\n";
			$namestr = getName($row);
			$photostr = showSmallPhoto( $row['personID'], $namestr, $rights['both'], 40, "I", "", $row['gedcom'] );

			echo "<td class=\"lightback\" valign=\"top\">$namestr</td>\n";
			echo "<td class=\"lightback thumbholder\" align=\"center\" valign=\"top\">$photostr</td>\n";
			echo "<td class=\"lightback\" valign=\"top\">$birthdate<br/>$birthplace</td>\n";
			echo "<td class=\"lightback\" valign=\"top\">$deathdate<br/>$deathplace</td>\n";
			if($numtrees > 1)
				echo "<td class=\"lightback\" valign=\"top\">{$row['treename']}</td>\n";
			$changedby = $numusers > 1 ? "{$row['changedby']}: " : "";
			echo "<td class=\"lightback\" valign=\"top\">{$changedby}{$row['changedatef']}</td>\n";
			echo "</tr>\n";
		}
?>
	</table>
<?php
		echo displayListLocation($offsetplus,$numrowsplus,$totrows);
		echo " &nbsp; <span class=\"adminnav\">$pagenav</span></p>";
	}
	else
		echo "</table>\n" . $admtext['norecords'];
  	tng_free_result($result);
?>
	</form>
	</div>
</div>
<?php 
echo tng_adminfooter();
?>