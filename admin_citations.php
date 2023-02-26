<?php
include("begin.php");
include("adminlib.php");
$textpart = "sources";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include($cms['tngpath'] . "checklogin.php");

if(!isset($tree)) $tree = "";

$wherestr = "WHERE gedcom = \"$tree\"";

$query = "SELECT $eventtypes_table.eventtypeID, tag, display FROM $events_table
	LEFT JOIN  $eventtypes_table on $eventtypes_table.eventtypeID = $events_table.eventtypeID 
	WHERE eventID=\"$eventID\"";
$eventtypes = tng_query($query);
$eventtype = tng_fetch_assoc( $eventtypes );

if(!empty($eventtype['display'])) {
	$dispvalues = explode( "|", $eventtype['display'] );
	$numvalues = count( $dispvalues );
	if( $numvalues > 1 ) {
		$displayval = "";
		for( $i = 0; $i < $numvalues; $i += 2 ) {
			$lang = $dispvalues[$i]; 
			if( $mylanguage == $languages_path . $lang ) {
				$eventtypedesc = $dispvalues[$i+1];
				break;
			}
		}
	}
	else
		$eventtypedesc = $eventtype['display'];
}
elseif(!empty($eventtype['tag']))
	$eventtypedesc = $eventtype['tag'];
elseif( $eventID ) {
	$eventtypedesc = $admtext[$eventID] ? $admtext[$eventID] : $admtext['notes'];
}
else
	$eventtypedesc = $admtext['general'];
tng_free_result($eventtypes);

$helplang = findhelp("citations_help.php");

header("Content-type:text/html; charset=" . $session_charset);

$xnotestr = isset($noteID) ? " OR persfamID = \"$noteID\"" : "";
$query = "SELECT citationID, $citations_table.sourceID as sourceID, description, title, shorttitle
    FROM $citations_table LEFT JOIN $sources_table on $citations_table.sourceID = $sources_table.sourceID AND $sources_table.gedcom = $citations_table.gedcom
    WHERE $citations_table.gedcom = \"$tree\" AND ((persfamID = \"$persfamID\" AND eventID = \"$eventID\")$xnotestr) ORDER BY ordernum, citationID";
$citresult = tng_query($query);
$citationcount = tng_num_rows( $citresult );
?>

<div class="databack ajaxwindow" id="citations"<?php if(!$citationcount) echo " style=\"display:none\""; ?>>
<form name="citeform">
<p class="subhead"><strong><?php echo $admtext['citations'] . ": $eventtypedesc"; ?></strong> |
	<a href="#" onclick="return openHelp('<?php echo $helplang; ?>/citations_help.php');"><?php echo $admtext['help']; ?></a></p>
<p>
<?php if( $allow_add ) { ?>
	<input type="button" value="  <?php echo $admtext['addnew']; ?>  " onclick="document.citeform2.reset();gotoSection('citations','addcitation');" />&nbsp;
<?php } ?>
	<input type="button" value="  <?php echo $admtext['finish']; ?>  " onclick="if(subpage){gotoSection('citationslist','notelist');subpage=false;}else{tnglitbox.remove();}" />
</p>
		<table id="citationstbl" class="fieldname normal" cellpadding="3" cellspacing="1" border="0"<?php if(!$citationcount) echo " style=\"display:none\""; ?>>
		<tbody id="citationstblbody">
		<tr>
			<td class="fieldnameback" width="50"><b><?php echo $admtext['text_sort']; ?></b></td>
			<td class="fieldnameback" width="70"><b><?php echo $admtext['action']; ?></b></td>
			<td class="fieldnameback" width="445"><b><?php echo $admtext['title2']; ?></b></td>
		</tr>
		</tbody>
		</table>
	<div id="cites" width="460">
<?php
	if( $citresult && $citationcount ) {
		while ( $citation = tng_fetch_assoc( $citresult ) ) {
			$sourcetitle = $citation['title'] ? $citation['title'] : $citation['shorttitle'];
			$citationsrc = $citation['sourceID'] ? "[{$citation['sourceID']}] $sourcetitle" : $citation['description'];
			$citationsrc = cleanIt($citationsrc);
			$truncated = truncateIt($citationsrc,75);
			$actionstr = $allow_edit ? "<a href=\"#\" onclick=\"return editCitation({$citation['citationID']});\" title=\"{$admtext['edit']}\" class=\"smallicon admin-edit-icon\"></a>" : "";
			$actionstr .= $allow_delete ? "<a href=\"#\" onclick=\"return deleteCitation({$citation['citationID']},'$persfamID','$tree','$eventID');\" title=\"{$admtext['text_delete']}\" class=\"smallicon admin-delete-icon\"></a>" : "";
			echo "<div class=\"sortrow\" id=\"citations_{$citation['citationID']}\">";
			echo "<table class=\"normal\" cellpadding=\"3\" cellspacing=\"1\" border=\"0\">";
			echo "<tr id=\"row_{$citation['citationID']}\">";
			echo "<td class=\"dragarea\"><img src=\"img/admArrowUp.gif\" alt=\"\"><br/><img src=\"img/admArrowDown.gif\" alt=\"\"></td>";
			echo "<td class=\"lightback\" width=\"70\">$actionstr</td>";
			echo "<td class=\"lightback\" width=\"445\">$truncated</td>";
			echo "</tr></table></div>\n";
		}
		tng_free_result($citresult);
	}
?>
	</div>
</form>
</div>

<div class="databack ajaxwindow"<?php if($citationcount) echo " style=\"display:none\""; ?> id="addcitation">
<form action="" name="citeform2" onSubmit="return addCitation(this);">
<div style="float:right;text-align:center">
    <input type="submit" name="submit" class="btn" value="<?php echo $admtext['save']; ?>">
    <p><a href="#" onclick="return gotoSection('addcitation','citations');"><?php echo $text['cancel']; ?></a></p>
</div>
<p class="subhead"><strong><?php echo $admtext['addnewcite']; ?></strong> |
	<a href="#" onclick="return openHelp('<?php echo $helplang; ?>/citations_help.php#add', 'newwindow', 'height=500,width=700,resizable=yes,scrollbars=yes'); newwindow.focus();"><?php echo $admtext['help']; ?></a></p>

<table border="0" cellpadding="2" class="normal">
	<tr><td><?php echo $admtext['sourceid']; ?>:</td>
		<td>
            <input type="text" name="sourceID" id="sourceID" size="20" /> &nbsp;<?php echo $admtext['text_or']; ?> &nbsp;
			<input type="button" value="<?php echo $admtext['find']; ?>" onclick="return initFilter('addcitation','findsource','sourceID','sourceTitle');" />
			<input type="button" value="<?php echo $admtext['create']; ?>" onclick="return initNewItem('source', document.newsourceform.sourceID, 'sourceID', 'sourceTitle', 'addcitation','newsource');" />
            <?php
                if(isset($_SESSION['lastcite'])) {
                    $parts = explode("|", $_SESSION['lastcite']);
                    if($parts[0] == $tree) {
                        echo "<input type=\"button\" value=\"{$admtext['copylast']}\" onclick=\"return copylast(document.citeform2,'{$parts[1]}');\">";
                        echo "&nbsp; <img src=\"img/spinner.gif\" id=\"lastspinner\" style=\"vertical-align:-3px; display:none\"/>";
                    }
                }
            ?>
		</td>
	</tr>
	<tr><td></td><td id="sourceTitle"></td></tr>
	<tr><td><?php echo $admtext['page']; ?>:</td><td><input type="text" name="citepage" id="citepage" size="60"/></td></tr>
	<tr><td><?php echo $admtext['reliability']; ?>:</td>
		<td>
			<select name="quay" id="quay">
				<option value=""></option>
				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
			</select> (<?php echo $admtext['relyexplain']; ?>)
		</td>
	</tr>
	<tr><td><?php echo $admtext['citedate']; ?>:</td><td><input type="text" name="citedate" id="citedate" size="60" onBlur="checkDate(this);"/></td></tr>
	<tr><td valign="top"><?php echo $admtext['actualtext']; ?>:</td><td><textarea cols="50" rows="5" name="citetext" id="citetext"></textarea></td></tr>
	<tr><td valign="top"><?php echo $admtext['notes']; ?>:</td><td><textarea cols="50" rows="5" name="citenote" id="citenote"></textarea></td></tr>
<?php
	if($eventID != 'SLGC') {
?>
	<tr><td valign="top"><?php echo $admtext['events']; ?></td>
		<td>
			<select name="events[]" multiple size="8">
<?php
		if(substr($persfamID,0,1) == $tngconfig['personprefix'] || substr($persfamID,-1) == $tngconfig['personsuffix']) {
			$stdevents = ['BIRT','CHR','DEAT','BURI'];
			if(!$ldsdefault)
				array_push($stdevents,'BAPL','CONL','INIT','ENDL');
		}
		elseif(substr($persfamID,0,1) == $tngconfig['familyprefix'] || substr($persfamID,-1) == $tngconfig['familysuffix']) {
			$stdevents = ['MARR','DIV'];
			if(!$ldsdefault)
				array_push($stdevents,'SLGS');
		}
		foreach($stdevents as $event) {
			echo "<option value=\"$event\"";
			if($event == $eventID) echo " selected";
			echo ">{$admtext[$event]}</option>\n";
		}
		$query = "SELECT tag, eventID, display, eventdate FROM ($events_table, $eventtypes_table) 
			WHERE persfamID = \"$persfamID\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID AND gedcom = \"$tree\" AND keep = \"1\" AND parenttag = \"\" 
			ORDER BY ordernum, tag, description";
		$custevents = tng_query($query);
		while ( $custevent = tng_fetch_assoc( $custevents ) )	{
			$displayval = getEventDisplay( $custevent['display'] );
			$eventdate = $custevent['eventdate'] ? " (" . displayDate($custevent['eventdate']) . ")" : "";
			echo "<option value=\"{$custevent['eventID']}\"";
			if($custevent['eventID'] == $eventID) echo " selected";
			echo ">{$displayval}{$eventdate}</option>\n";
		}
		tng_free_result( $custevents );
?>
			</select>
		</td>
	</tr>
<?php
	}
?>
</table><br/>
<input type="hidden" name="persfamID" value="<?php echo $persfamID; ?>" />
<input type="hidden" name="tree" value="<?php echo $tree; ?>" />
<input type="hidden" name="eventID" value="<?php echo $eventID; ?>" />
</form>
</div>

<div class="databack ajaxwindow" style="display:none;" id="editcitation">
</div>

<?php
	$applyfilter = "applyFilter({form:'findsourceform1', fieldId:'mytitle', type:'S', tree:'$tree', destdiv:'sourceresults'});";
?>
<div class="databack ajaxwindow" style="display:none;" id="findsource">
	<form action="" method="post" name="findsourceform1" id="findsourceform1" onsubmit="return <?php echo $applyfilter; ?>">
    <p class="subhead"><strong><?php echo $admtext['findsourceid']; ?></strong><br/>
    <span class="normal">(<?php echo $admtext['entersourcepart']; ?>)</span></p>
	<table border="0" cellspacing="0" cellpadding="2" class="normal">
		<tr>
		   	<td><?php echo $admtext['title2']; ?>: </td>
			<td><input type="text" name="mytitle" id="mytitle" onkeyup="filterChanged(event, {form:'findsourceform1', fieldId:'mytitle', type:'S', tree:'<?php echo $tree; ?>', destdiv:'sourceresults'});"/></td>
			<td><input type="submit" value="<?php echo $admtext['search']; ?>"> <input type="button" value="<?php echo $admtext['cancel']; ?>" onclick="gotoSection('findsource',prevsection);"></td>
		</tr>
		<tr>
			<td colspan="3">
				<input type="radio" name="filter" value="s" onclick="<?php echo $applyfilter; ?>" /> <?php echo $text['startswith']; ?> &nbsp;&nbsp; <input type="radio" name="filter" value="c" checked="checked" onclick="<?php echo $applyfilter; ?>" /> <?php echo $text['contains']; ?>
			</td>
		</tr>
	</table>
	</form>

	<p><strong><?php echo $admtext['searchresults']; ?></strong> (<?php echo $admtext['clicktoselect']; ?>)</p>

    <div id="sourceresults" style="width:605px;height:380px;overflow:auto"></div>
</div>

<div class="databack ajaxwindow" style="display:none;" id="newsource">
	<form action="" method="post" name="newsourceform" id="newsourceform" onsubmit="return saveSource(this);">
    <div style="float:right;text-align:center">
        <input type="submit" name="submit" class="bigsave" accesskey="s" value="<?php echo $admtext['save']; ?>">
        <p><a href="#" onclick="gotoSection('newsource',prevsection);"><?php echo $text['cancel']; ?></a></p>
    </div>
    <p class="subhead"><strong><?php echo $admtext['addnewsource']; ?></strong> |
	<a href="#" onclick="return openHelp('<?php echo $helplang; ?>/sources_help.php#add', 'newwindow', 'height=500,width=700,resizable=yes,scrollbars=yes'); newwindow.focus();"><?php echo $admtext['help']; ?></a></p>
    <span class="normal"><strong><?php echo $admtext['prefixsourceid']; ?></strong></span><br/>
		<table border="0" cellspacing="0" cellpadding="2" class="normal">
			<tr>
				<td><?php echo $admtext['sourceid']; ?>:</td>
				<td>
					<input type="hidden" name="tree1" value="<?php echo $tree; ?>"/>
					<input type="text" name="sourceID" id="sourceIDnew" size="10" onBlur="this.value=this.value.toUpperCase()">
					<input type="button" value="<?php echo $admtext['generate']; ?>" onclick="generateID('source',document.newsourceform.sourceIDnew);">
					<input type="button" value="<?php echo $admtext['check']; ?>" onclick="checkID(document.newsourceform.sourceIDnew.value,'source','checkmsg');">
					<span id="checkmsg" class="normal"></span>
				</td>
			</tr>
<?php include("micro_newsource.php"); ?>
		</table>
        <p class="normal"><strong><?php echo $admtext['sevslater']; ?></strong></p>
	</form>
</div>