<?php
include("begin.php");
include("adminlib.php");
$textpart = "users";
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

$tng_search_users = $_SESSION['tng_search_users'] = 1;
$exptime = 0;

if(!isset($adminonly)) $adminonly = "";
if(!isset($disabledonly)) $disabledonly = "";

if( !empty($newsearch) ) {
	$searchstring = stripslashes(trim($searchstring));
	setcookie("tng_search_users_post[search]", $searchstring, $exptime);
	setcookie("tng_search_users_post[adminonly]", $adminonly, $exptime);
	setcookie("tng_search_users_post[disabledonly]", $disabledonly, $exptime);
	setcookie("tng_search_users_post[tngpage]", 1, $exptime);
	setcookie("tng_search_users_post[offset]", 0, $exptime);
}
else {
	if( empty($searchstring) )
		$searchstring = isset($_COOKIE['tng_search_users_post']['search']) ? stripslashes($_COOKIE['tng_search_users_post']['search']) : "";
	if( empty($adminonly) )
		$adminonly = isset($_COOKIE['tng_search_users_post']['adminonly']) ? $_COOKIE['tng_search_users_post']['adminonly'] : "";
	if( empty($disabledonly) )
		$disabledonly = isset($_COOKIE['tng_search_users_post']['disabledonly']) ? $_COOKIE['tng_search_users_post']['disabledonly'] : "";
	if( !isset($offset) ) {
		$tngpage = isset($_COOKIE['tng_search_users_post']['tngpage']) ? $_COOKIE['tng_search_users_post']['tngpage'] : 1;
		$offset = isset($_COOKIE['tng_search_users_post']['offset']) ? $_COOKIE['tng_search_users_post']['offset'] : 0;
	}
	else {
		setcookie("tng_search_users_post[tngpage]", $tngpage, $exptime);
		setcookie("tng_search_users_post[offset]", $offset, $exptime);
	}
}

if(!empty($order))
	setcookie("tng_search_users_post[order]", $order, $exptime);
else
	$order = isset($_COOKIE['tng_search_users_post']['order']) ? $_COOKIE['tng_search_users_post']['order'] : "desc";

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

$unsort = "un";
$descsort = "descup";
$namesort = "name";
$loginsort = "login";
$descicon = "<img src=\"img/tng_sort_desc.gif\" class=\"sortimg\" alt=\"\" />";
$ascicon = "<img src=\"img/tng_sort_asc.gif\" class=\"sortimg\" alt=\"\" />";

if($order == "un") {
	$orderstr = "username, description";
	$unsort = "<a href=\"admin_users.php?order=unup\" class=\"lightlink\">{$admtext['username']} $descicon</a>";
}
else {
	$unsort = "<a href=\"admin_users.php?order=un\" class=\"lightlink\">{$admtext['username']} $ascicon</a>";
	if($order == "unup")
		$orderstr = "username DESC, description";
}

if($order == "desc") {
	$orderstr = "description";
	$descsort = "<a href=\"admin_users.php?order=descup\" class=\"lightlink\">{$admtext['description']} $descicon</a>";
}
else {
	$descsort = "<a href=\"admin_users.php?order=desc\" class=\"lightlink\">{$admtext['description']} $ascicon</a>";
	if($order == "descup")
		$orderstr = "description DESC";
}

if($order == "name") {
	$orderstr = "realname, description";
	$namesort = "<a href=\"admin_users.php?order=nameup\" class=\"lightlink\">{$admtext['realname']} / {$admtext['email']} $descicon</a>";
}
else {
	$namesort = "<a href=\"admin_users.php?order=name\" class=\"lightlink\">{$admtext['realname']} / {$admtext['email']} $ascicon</a>";
	if($order == "nameup")
		$orderstr = "realname DESC, description DESC";
}

if($order == "login") {
	$orderstr = "lastlogin, description";
	$loginsort = "<a href=\"admin_users.php?order=loginup\" class=\"lightlink\">{$admtext['lastlogin']} $descicon</a>";
}
else {
	$loginsort = "<a href=\"admin_users.php?order=login\" class=\"lightlink\">{$admtext['lastlogin']} $ascicon</a>";
	if($order == "loginup")
		$orderstr = "lastlogin DESC, description";
}


$wherestr = $searchstring ? " AND (username LIKE \"%$searchstring%\" OR description LIKE \"%$searchstring%\" OR realname LIKE \"%$searchstring%\" OR email LIKE \"%$searchstring%\")" : "";
$wherestr .= $adminonly ? " AND allow_add = \"1\" AND allow_edit = \"1\" AND allow_delete = \"1\" AND gedcom = \"\"" : "";
$wherestr .= $disabledonly ? " AND disabled = \"1\"" : "";
$query = "SELECT *, DATE_FORMAT(lastlogin,\"%d %b %Y %H:%i:%s\") as lastloginf FROM $users_table WHERE allow_living != \"-1\" $wherestr 
	ORDER BY $orderstr LIMIT $newoffset" . $maxsearchresults;
$result = tng_query($query);

$numrows = tng_num_rows( $result );
if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
	$query = "SELECT count(userID) as ucount FROM $users_table WHERE allow_living != \"-1\" $wherestr";
	$result2 = tng_query($query);
	$row = tng_fetch_assoc( $result2 );
	$totrows = $row['ucount'];
	tng_free_result($result2);
}
else
	$totrows = $numrows;

$revquery = "SELECT count(userID) as ucount FROM $users_table WHERE allow_living = \"-1\"";
$revresult = tng_query($revquery) or die ($admtext['cannotexecutequery'] . ": $revquery");
$revrow = tng_fetch_assoc( $revresult );
$revstar = $revrow['ucount'] ? " *" : "";
tng_free_result($revresult);

$helplang = findhelp("users_help.php");

tng_adminheader( $admtext['users'], $flags );
?>
<script type="text/javascript">
function confirmDelete(ID) {
	if(confirm('<?php echo $admtext['confuserdelete']; ?>' ))
		deleteIt('user',ID);
	return false;
}
</script>
<script type="text/javascript" src="js/admin.js"></script>
</head>

<?php
	echo tng_adminlayout();

	$usertabs[0] = array(1,"admin_users.php",$admtext['search'],"finduser");
	$usertabs[1] = array($allow_add,"admin_newuser.php",$admtext['addnew'],"adduser");
	$usertabs[2] = array($allow_edit,"admin_reviewusers.php",$admtext['review'] . $revstar,"review");
	$usertabs[3] = array(1,"admin_mailusers.php",$admtext['email'],"mail");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/users_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($usertabs,"finduser",$innermenu);
	echo displayHeadline($admtext['users'], "img/users_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">

	<form action="admin_users.php" name="form1">
	<table class="normal">
		<tr>
			<td><?php echo $admtext['searchfor']; ?>: </td>
			<td><input type="text" name="searchstring" value="<?php echo $searchstring; ?>" class="longfield"></td>
			<td>
				<input type="submit" name="submit" value="<?php echo $admtext['search']; ?>" class="aligntop">
				<input type="submit" name="submit" value="<?php echo $admtext['reset']; ?>" onClick="document.form1.searchstring.value=''; document.form1.adminonly.checked=false; document.form1.disabledonly.checked=false;" class="aligntop">
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="2">
				<input type="checkbox" name="adminonly" value="yes"<?php if( $adminonly == "yes" ) echo " checked"; ?>> <?php echo $admtext['adminonly']; ?> &nbsp;&nbsp;
				<input type="checkbox" name="disabledonly" value="yes"<?php if( $disabledonly == "yes" ) echo " checked"; ?>> <?php echo $admtext['disabledonly']; ?>
			</td>
		</tr>
	</table>

	<input type="hidden" name="finduser" value="1"><input type="hidden" name="newsearch" value="1">
	</form><br />

<?php
	$numrowsplus = $numrows + $offset;
	if( !$numrowsplus ) $offsetplus = 0;
	echo displayListLocation($offsetplus,$numrowsplus,$totrows);
	$pagenav = get_browseitems_nav( $totrows, "admin_users.php?searchstring=$searchstring&amp;offset", $maxsearchresults, 5 );
	echo " &nbsp; <span class=\"adminnav\">$pagenav</span></p>";
?>
	<form action="admin_deleteselected.php" method="post"  name="form2">
<?php
	if( $allow_delete ) {
?>
		<p>
		<input type="button" name="selectall" value="<?php echo $admtext['selectall']; ?>" onClick="toggleAll(1);">
		<input type="button" name="clearall" value="<?php echo $admtext['clearall']; ?>" onClick="toggleAll(0);">
  		<input type="submit" name="xuseraction" value="<?php echo $admtext['deleteselected']; ?>" onClick="return confirm('<?php echo addslashes($admtext['confdeleterecs']); ?>');">
		</p>
<?php
	}
?>

	<table cellpadding="3" cellspacing="1" border="0" class="normal rounded-table">
		<tr>
			<th class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['action']; ?></b>&nbsp;</nobr></span></th>
<?php
	if($allow_delete) {
?>
			<th class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['select']; ?></b>&nbsp;</nobr></span></th>
<?php
	}
?>
			<th class="fieldnameback fieldname nw">&nbsp;<b><?php echo $unsort; ?></b>&nbsp;</th>
			<th class="fieldnameback fieldname nw">&nbsp;<b><?php echo $descsort; ?></b>&nbsp;</th>
			<th class="fieldnameback fieldname nw">&nbsp;<b><?php echo $namesort; ?></b>&nbsp;</th>
			<!--<td class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['admin']; ?></b>&nbsp;</td>-->
			<th class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['tree']; ?></b>&nbsp;</th>
			<th class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['branch']; ?></b>&nbsp;</th>
			<th class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['role']; ?></b>&nbsp;</th>
			<th class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['living']; ?></b>&nbsp;</th>
			<th class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['text_private']; ?></b>&nbsp;</th>
			<!--<td class="fieldnameback fieldname nw">&nbsp;<b>GED</b>&nbsp;</td>-->
			<!--<td class="fieldnameback fieldname nw">&nbsp;<b>PDF</b>&nbsp;</td>-->
			<th class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['lds']; ?></b>&nbsp;</th>
			<th class="fieldnameback fieldname nw">&nbsp;<b><?php echo $loginsort; ?></b>&nbsp;</th>
			<th class="fieldnameback fieldname nw">&nbsp;<b><?php echo $admtext['disabled']; ?></b>&nbsp;</th>
		</tr>
	
<?php
	if( $numrows ) {
		$actionstr = "";
		if( $allow_edit )
			$actionstr .= "<a href=\"admin_edituser.php?userID=xxx\" title=\"{$admtext['edit']}\" class=\"smallicon admin-edit-icon\"></a>";
		if( $allow_delete )
			$actionstr .= "<a href=\"#\" onClick=\"return confirmDelete('xxx');\" title=\"{$admtext['text_delete']}\" class=\"smallicon admin-delete-icon\"></a>";

		while( $row = tng_fetch_assoc($result)) {
			$form_allow_admin = $row['gedcom'] || ( !$row['allow_edit'] && !$row['allow_add'] && !$row['allow_delete'] ) ? "" : $admtext['yes'];
			$form_allow_lds = $row['allow_lds'] ? $admtext['yes'] : "";
			$form_allow_living = $row['allow_living'] > 0 ? $admtext['yes'] : "";
			$form_allow_private = $row['allow_private'] > 0 ? $admtext['yes'] : "";
			$form_allow_ged = $row['allow_ged'] ? $admtext['yes'] : "";
			$form_allow_pdf = $row['allow_pdf'] ? $admtext['yes'] : "";
			$form_disabled = $row['disabled'] ? $admtext['yes'] : "";
			$newactionstr = preg_replace( "/xxx/", $row['userID'], $actionstr );
			echo "<tr id=\"row_{$row['userID']}\"><td class=\"lightback\" valign=\"top\"><div class=\"action-btns2\">$newactionstr</div></td>\n";
			if($allow_delete)
				echo "<td class=\"lightback\" valign=\"top\" align=\"center\"><input type=\"checkbox\" name=\"del{$row['userID']}\" value=\"1\"></td>";
			$editlink = "admin_edituser.php?userID={$row['userID']}";
			$username = $allow_edit ? "<a href=\"$editlink\" title=\"{$admtext['edit']}\">" . $row['username'] . "</a>" : $row['username'];

			echo "<td class=\"lightback\" valign=\"top\" nowrap>&nbsp;$username&nbsp;</td>\n";
			echo "<td class=\"lightback\" valign=\"top\">&nbsp;{$row['description']}&nbsp;</td>\n";
			echo "<td class=\"lightback\" valign=\"top\">&nbsp;" . $row['realname'];
			if($row['realname'] && $row['email']) echo "<br />&nbsp;";
			$rolestr = 'usr' . ($row['role'] ? $row['role'] : 'custom');
			echo "<a href=\"mailto:" . $row['email'] . "\">" . $row['email'] . "</a>&nbsp;</td>\n";
			//echo "<td class=\"lightback\" valign=\"top\" nowrap><span class=\"normal\">&nbsp;$form_allow_admin&nbsp;</span></td>\n";
			echo "<td class=\"lightback nw\" valign=\"top\">&nbsp;{$row['gedcom']}&nbsp;</td>\n";
			echo "<td class=\"lightback nw\" valign=\"top\">&nbsp;{$row['branch']}&nbsp;</td>\n";
			echo "<td class=\"lightback nw\" valign=\"top\">&nbsp;{$admtext[$rolestr]}&nbsp;</td>\n";
			echo "<td class=\"lightback nw\" valign=\"top\">&nbsp;$form_allow_living&nbsp;</td>\n";
			echo "<td class=\"lightback nw\" valign=\"top\">&nbsp;$form_allow_private&nbsp;</td>\n";
			//echo "<td class=\"lightback nw\" valign=\"top\">&nbsp;$form_allow_ged&nbsp;</td>\n";
			//echo "<td class=\"lightback nw\" valign=\"top\">&nbsp;$form_allow_pdf&nbsp;</td>\n";
			echo "<td class=\"lightback nw\" valign=\"top\">&nbsp;$form_allow_lds&nbsp;</td>\n";
			echo "<td class=\"lightback nw\" valign=\"top\">&nbsp;{$row['lastloginf']}&nbsp;</td>\n";
			echo "<td class=\"lightback nw\" valign=\"top\">&nbsp;$form_disabled&nbsp;</td>\n";
			echo "</tr>\n";
		}
?>
	</table>
<?php
		echo displayListLocation($offsetplus,$numrowsplus,$totrows);
		echo " &nbsp; <span class=\"adminnav\">$pagenav</span></p>";
	}
	else
		echo $admtext['norecords'];
  	tng_free_result($result);
?>
	</form>

	</div>
</div>
<?php 
echo tng_adminfooter();
?>