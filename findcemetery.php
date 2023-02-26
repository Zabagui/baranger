<?php
include("begin.php");
include("adminlib.php");
$textpart = "cemeteries";
//include("getlang.php");
include("$mylanguage/admintext.php");

include($cms['tngpath'] . "checklogin.php");

$tng_search_cemeteries = $_SESSION['tng_search_cemeteries'];
$tng_search_cemeteries_post = $_SESSION['tng_search_cemeteries_post'];
if( $findcemetery ) {
	$tng_search_cemeteries = $_SESSION['tng_search_cemeteries'] = 1;
	$tng_search_cemeteries_post = $_SESSION['tng_search_cemeteries_post'] = $_POST;
}
else if( $tng_search_cemeteries ) {
	foreach( $_SESSION['tng_search_cemeteries_post'] as $key=>$value ) {
		${$key} = $value;
	}
}

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

if( $exactmatch == "yes" ) {
	$frontmod = "=";
}
else {
	$frontmod = "LIKE";
}

$allwhere = "WHERE 1=0";

if( $cemeteryID == "yes" ) {
	$allwhere .= addCriteria( "$cemeteries_table.cemeteryID", $searchstring, $frontmod );
}

if( $maplink == "yes" ) {
	$allwhere .= addCriteria( "maplink", $searchstring, $frontmod );
}

if( $cemname == "yes" ) {
	$allwhere .= addCriteria( "cemname", $searchstring, $frontmod );
}

if( $city == "yes" ) {
	$allwhere .= addCriteria( "city", $searchstring, $frontmod );
}

if( $state == "yes" ) {
	$allwhere .= addCriteria( "state", $searchstring, $frontmod );
}

if( $county == "yes" ) {
	$allwhere .= addCriteria( "county", $searchstring, $frontmod );
}

if( $country == "yes" ) {
	$allwhere .= addCriteria( "country", $searchstring, $frontmod );
}

$query = "SELECT cemeteryID,cemname,city,county,state,country FROM $cemeteries_table $allwhere ORDER BY cemname, city, county, state, country";
$result = tng_query($query);

$numrows = tng_num_rows( $result );

if ( !$numrows ) {
	$message = $admtext['noresults'];
	header( "Location: cemeteries.php?message=" . urlencode($message) );
	exit;
}

$helplang = findhelp("cemeteries_help.html");

tng_adminheader( $admtext['modifycemetery'], "" );
?>
</head>

<?php
	echo tng_adminlayout();
?>
<div class="center">
<table width="100%" border="0" cellpadding="5" class="lightback">
<tr class="fieldnameback">
	<td>
		<img src="cemeteries_icon.gif" width="40" height="40" border="1" align="right">
		<span class="whiteheader"><font size="5"><?php echo $admtext['modifycemetery']; ?></font></span>
	</td>
</tr>
<?php
	if( $message ) {
?>
<tr>
<td>
	<font color="#FF0000"><span class="normal"><em><?php echo urldecode($message); ?></em>
	</span></font>
</td>
</tr>
<?php
	}
?>
<tr class="databack">
<td>
	<span class="subhead"><strong><?php echo $admtext['selectcemaction']; ?></strong>  | <a href="#" onclick="return openHelp('<?php echo $helplang; ?>/cemeteries_help.html#find', 'newwindow', 'height=500,width=600,resizable=yes,scrollbars=yes'); newwindow.focus();"><?php echo $admtext['help']; ?></a></span><br/><br/>
	<span class="normal">
	&nbsp;&nbsp;<img src="img/tng_edit.gif" alt="<?php echo $admtext['edit']; ?>" width="16" height="16" border="0" align="middle"> = <?php echo $admtext['edit']; ?> &nbsp;&nbsp;
	<img src="img/tng_delete.gif" alt="<?php echo $admtext['text_delete']; ?>" width="16" height="16" border="0" align="middle"> = <?php echo $admtext['text_delete']; ?>
	<br/>
<?php
	echo "<p>{$admtext['matches']}: $numrows</p>";
?>
	</span>
	<table cellpadding="3" cellspacing="1" border="0">
		<tr>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['action']; ?></b>&nbsp;</nobr></span></td>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['id']; ?></b>&nbsp;</nobr></span></td>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['cemetery']; ?></b>&nbsp;</nobr></span></td>
			<td class="fieldnameback"><span class="fieldname"><nobr>&nbsp;<b><?php echo $admtext['location']; ?></b>&nbsp;</nobr></span></td>
		</tr>
	
<?php
$rowcount = 0;
$actionstr = "";
if( $allow_edit )
	$actionstr .= "<a href=\"admin_editcemetery.php?cemeteryID=xxx\"><img src=\"tng_edit.gif\" alt=\"{$admtext['edit']}\" width=\"16\" height=\"16\" border=\"0\" vspace=0 hspace=2></a>";
if( $allow_delete )
	$actionstr .= "<a href=\"deletecemetery.php?cemeteryID=xxx\" onClick=\"return confirm('{$admtext['confdeletecem']}' );\"><img src=\"tng_delete.gif\" alt=\"{$admtext['text_delete']}\" width=\"16\" height=\"16\" border=\"0\" vspace=0 hspace=2></a>";

while( $rowcount < $numrows && $row = tng_fetch_assoc($result))
{
	$rowcount++;
	$location = $row['city'];
	if( $row['county'] ) {
		if( $location ) $location .= ", ";
		$location .= $row['county'];
	}
	if( $row['state'] ) {
		if( $location ) $location .= ", ";
		$location .= $row['state'];
	}
	if( $row['country'] ) {
		if( $location ) $location .= ", ";
		$location .= $row['country'];
	}

	$newactionstr = preg_replace( "/xxx/", $row['cemeteryID'], $actionstr );
	echo "<tr><td class=\"lightback\" valign=\"top\"><span class=\"normal\"><nobr>$newactionstr</nobr></span></td><td class=\"lightback\" valign=\"top\"><span class=\"normal\">&nbsp;{$row['cemeteryID']}&nbsp;</span></td><td class=\"lightback\" valign=\"top\"><span class=\"normal\">{$row['cemname']}&nbsp;</span></td><td class=\"lightback\" valign=\"top\"><span class=\"normal\">$location&nbsp;</span></td></tr>\n";
}
tng_free_result($result);

?>
	</table>
</td>
</tr>

</table>
</div>
<?php 
echo tng_adminfooter();
?>
