<?php
include("begin.php");
include("adminlib.php");
$textpart = "language";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( $assignedtree ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

if( !isset($offset) ) $offset = 0;

$tng_search_langs = $_SESSION['tng_search_langs'] = 1;
if( !empty($newsearch) ) {
	$exptime = 0;
	setcookie("tng_search_langs_post[search]", $searchstring, $exptime);
	setcookie("tng_search_langs_post[tngpage]", 1, $exptime);
	setcookie("tng_search_langs_post[offset]", 0, $exptime);
}
else {
	if( empty($searchstring) )
		$searchstring = isset($_COOKIE['tng_search_langs_post']['search']) ? stripslashes($_COOKIE['tng_search_langs_post']['search']) : "";
	if( !isset($offset) ) {
		$tngpage = isset($_COOKIE['tng_search_langs_post']['tngpage']) ? $_COOKIE['tng_search_langs_post']['tngpage'] : 1;
		$offset = isset($_COOKIE['tng_search_langs_post']['offset']) ? $_COOKIE['tng_search_langs_post']['offset'] : 0;
	}
	else {
		$exptime = 0;
		if( !isset($tngpage) ) $tngpage = 1;
		setcookie("tng_search_langs_post[tngpage]", $tngpage, $exptime);
		setcookie("tng_search_langs_post[offset]", $offset, $exptime);
	}
}

if( $offset ) {
	$offsetplus = $offset + 1;
	$newoffset = "$offset, ";
}
else {
	$offsetplus = 1;
	$newoffset = "";
	$tngpage = 1;
}

$wherestr = $searchstring ? "WHERE display LIKE \"%$searchstring%\" OR folder LIKE \"%$searchstring%\"" : "";
$query = "SELECT languageID, display, folder, charset FROM $languages_table $wherestr ORDER BY display LIMIT $newoffset" . $maxsearchresults;
$result = tng_query($query);

$numrows = tng_num_rows( $result );
if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
	$query = "SELECT count(languageID) as lcount FROM $languages_table $wherestr";
	$result2 = tng_query($query);
	$row = tng_fetch_assoc( $result2 );
	$totrows = $row['lcount'];
	tng_free_result($result2);
}
else
	$totrows = $numrows;

$helplang = findhelp("languages_help.php");

tng_adminheader( $admtext['languages'], $flags );
?>
<script type="text/javascript" src="js/admin.js"></script>
</head>

<?php
	echo tng_adminlayout();

	$langtabs['0'] = array(1,"admin_languages.php",$admtext['search'],"findlang");
	$langtabs['1'] = array($allow_add,"admin_newlanguage.php",$admtext['addnew'],"addlanguage");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/languages_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($langtabs,"findlang",$innermenu);
	echo displayHeadline($admtext['languages'],"img/languages_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">

	<form action="admin_languages.php" name="form1">
	<?php echo $admtext['searchfor']; ?>: <input type="text" name="searchstring" value="<?php echo $searchstring; ?>" class="longfield">
	<input type="hidden" name="findlang" value="1"><input type="hidden" name="newsearch" value="1">
	<input type="submit" name="submit" value="<?php echo $admtext['search']; ?>" class="aligntop">
	<input type="submit" name="submit" value="<?php echo $admtext['reset']; ?>" onClick="document.form1.searchstring.value='';" class="aligntop">
	</form><br />

<?php
	$numrowsplus = $numrows + $offset;
	if( !$numrowsplus ) $offsetplus = 0;
	echo displayListLocation($offsetplus,$numrowsplus,$totrows);
	$pagenav = get_browseitems_nav( $totrows, "languages.php?searchstring=$searchstring&amp;offset", $maxsearchresults, 5 );
	echo " &nbsp; <span class=\"adminnav\">$pagenav</span></p>";
?>

	<table cellpadding="3" cellspacing="1" border="0" class="normal rounded-table">
		<tr>
			<td class="fieldnameback fieldname"><nobr>&nbsp;<b><?php echo $admtext['action']; ?></b>&nbsp;</nobr></td>
			<td class="fieldnameback fieldname"><nobr>&nbsp;<b><?php echo $admtext['display']; ?></b>&nbsp;</nobr></td>
			<td class="fieldnameback fieldname"><nobr>&nbsp;<b><?php echo $admtext['folder']; ?></b>&nbsp;</nobr></td>
			<td class="fieldnameback fieldname"><nobr>&nbsp;<b><?php echo $admtext['charset']; ?></b>&nbsp;</nobr></td>
		</tr>

<?php
	if( $numrows ) {
		$actionstr = "";
		if( $allow_edit )
			$actionstr .= "<a href=\"admin_editlanguage.php?languageID=xxx\" title=\"{$admtext['edit']}\" class=\"smallicon admin-edit-icon\"></a>";
		if( $allow_delete )
			$actionstr .= "<a href=\"#\" onclick=\"if(confirm('{$admtext['conflangdelete']}' )){deleteIt('language',xxx);} return false;\" title=\"{$admtext['text_delete']}\" class=\"smallicon admin-delete-icon\"></a>";
		while( $row = tng_fetch_assoc($result)) {
			$newactionstr = preg_replace( "/xxx/", $row['languageID'], $actionstr );
			echo "<tr id=\"row_{$row['languageID']}\"><td class=\"lightback\"><div class=\"action-btns2\">$newactionstr</div></td>\n";
			echo "<td class=\"lightback\">{$row['display']}&nbsp;</td>\n";
			echo "<td class=\"lightback\">{$row['folder']}&nbsp;</td>\n";
			echo "<td class=\"lightback\">{$row['charset']}&nbsp;</td></tr>\n";
		}
	}
?>
	</table>
<?php
	if($numrows) {
		echo displayListLocation($offsetplus,$numrowsplus,$totrows);
		echo " &nbsp; <span class=\"adminnav\">$pagenav</span></p>";
	}
	else
		echo $admtext['norecords'];
  	tng_free_result($result);
?>

	</div>
</div>
<?php 
echo tng_adminfooter();
?>