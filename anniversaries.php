<?php
$textpart = "search";
include("tng_begin.php");

include($cms['tngpath'] . "functions.php");

$tngyear = isset($tngyear) ? preg_replace("/[^0-9]/", "", $tngyear ) : "";
$tngkeywords = isset($tngkeywords) ? preg_replace("/[^A-Za-z0-9]/", "", $tngkeywords ) : "";

$getperson_url = getURL( "getperson", 1 );
$showtree_url = getURL( "showtree", 1 );
$pedigree_url = getURL( "pedigree", 1 );
$placesearch_url = getURL( "placesearch", 1 );
$anniversaries_url = getURL( "anniversaries", 1 );
$anniversaries2_url = getURL( "anniversaries2", 1 );
$calendar_url = getURL( "calendar", 1 );

@set_time_limit(0);

if( empty($tngneedresults) ) {
	//get today's date
	$tngdaymonth = date("d", time() + ( 3600 * $time_offset ) );
	$tngmonth = date("m", time() + ( 3600 * $time_offset ) );
	$tngneedresults = 1;
}
else {
	$tngmonth = isset($tngmonth) ? preg_replace("/[^0-9]/", "", $tngmonth ) : "";
	$tngdaymonth = isset($tngdaymonth) ? preg_replace("/[^0-9]/", "", $tngdaymonth ) : "";
	$tngneedresults = isset($tngneedresults) ? preg_replace("/[^0-9]/", '', $tngneedresults) : "";
}

if ($tree && $tree != '-x--all--x-') {
	$righttree = checktree($tree);
}
else
	$righttree = -1;

$treestr = $tree ? " ({$text['tree']}: $tree)" : "";
if( !isset($tngevent) ) $tngevent = "";
if( !isset($offset) ) $offset = 0;
if( !isset($tngpage) ) $tngpage = "";
$logstring = "<a href=\"$anniversaries_url" . "tngevent=$tngevent&amp;tngdaymonth=$tngdaymonth&amp;tngmonth=$tngmonth&amp;tngyear=$tngyear&amp;tngkeywords=$tngkeywords&amp;tngneedresults=$tngneedresults&amp;offset=$offset&amp;tree=$tree&amp;tngpage=$tngpage\">" . xmlcharacters($text['anniversaries'] . " $treestr") . "</a>";
writelog($logstring);
preparebookmark($logstring);

//compute $allwhere from submitted criteria

$ldsOK = determineLDSRights();

tng_header( $text['anniversaries'], $flags );

if($sitever != "mobile") {
?>
<script type="text/javascript" src="<?php echo $cms['tngpath']; ?>js/search.js"></script>
<script type="text/javascript">
// <![CDATA[
var ajx_perspreview = '<?php echo getURL( "ajx_perspreview", 0 );?>';
//]]>
</script>
<?php		
	}
?>
<script type="text/javascript">
// <![CDATA[
function resetForm() {
	var myform = document.form1;

	myform.tngevent.selectedIndex = 0;
	myform.tngdaymonth.value = "";
	myform.tngmonth.selectedIndex = 0;
	myform.tngyear.value = "";
	myform.tngkeywords.value = "";
}
function validateForm( form ) {
	var rval = true;

	if( form.tngdaymonth.selectedIndex == 0 && form.tngmonth.selectedIndex == 0 && form.tngyear.value.length == 0 && form.tngkeywords.value.length == 0 ) {
		alert("<?php echo $text['enterdate']; ?>");
		rval = false;
	}
	return rval;
}
//]]>
</script>
<h1 class="header"><span class="headericon" id="dates-hdr-icon"></span><?php echo $text['anniversaries']; ?></h1><br clear="left"/>
<?php
$js = "\" onsubmit=\"return validateForm(this);";
echo getFORM( "anniversaries2", "get", "form1", "form1$js" );

echo treeDropdown(array('startform' => false, 'endform' => false, 'name' => 'form1'));
?>
<p class="normal">
<?php
	echo $text['explain'];
?>
</p>
<?php
?>

<div class="annfield normal">
	<label for="tngevent"><?php echo $text['event']; ?>:</label><br/>
	<select name="tngevent" id="tngevent" style="max-width:335px">
<?php
	echo "<option value=\"\">&nbsp;</option>\n";
	echo "<option value=\"birth\"";
	if( $tngevent == "birth" ) echo " selected=\"selected\"";
	echo ">{$text['born']}</option>\n";
	
	echo "<option value=\"altbirth\"";
	if( $tngevent == "altbirth" ) echo " selected=\"selected\"";
	echo ">{$text['christened']}</option>\n";
	
	echo "<option value=\"death\"";
	if( $tngevent == "death" ) echo " selected=\"selected\"";
	echo ">{$text['died']}</option>\n";
	
	echo "<option value=\"burial\"";
	if( $tngevent == "burial" ) echo " selected=\"selected\"";
	echo ">{$text['buried']}</option>\n";
		
	echo "<option value=\"marr\"";
	if( $tngevent == "marr" ) echo " selected=\"selected\"";
	echo ">{$text['married']}</option>\n";
		
	echo "<option value=\"div\"";
	if( $tngevent == "div" ) echo " selected=\"selected\"";
	echo ">{$text['divorced']}</option>\n";
		
	if( $ldsOK ) {
		echo "<option value=\"bapt\"";
		if( $tngevent == "bapt" ) echo " selected=\"selected\"";
		echo ">{$text['baptizedlds']}</option>\n";

		echo "<option value=\"conf\"";
		if( $tngevent == "conf" ) echo " selected=\"selected\"";
		echo ">{$text['conflds']}</option>\n";

		echo "<option value=\"init\"";
		if( $tngevent == "init" ) echo " selected=\"selected\"";
		echo ">{$text['initlds']}</option>\n";

		echo "<option value=\"endl\"";
		if( $tngevent == "endl" ) echo " selected=\"selected\"";
		echo ">{$text['endowedlds']}</option>\n";

		echo "<option value=\"seal\"";
		if( $tngevent == "seal" ) echo " selected=\"selected\"";
		echo ">{$text['sealedslds']}</option>\n";
	}
	
	//loop through custom event types where keep=1, not a standard event
	$query = "SELECT eventtypeID, tag, display FROM $eventtypes_table 
		WHERE keep=\"1\" AND type=\"I\" ORDER BY display";
	$result = tng_query($query);
	$dontdo = array("ADDR","BIRT","CHR","DEAT","BURI","NAME","NICK","TITL","NSFX","DIV","MARR");
	while( $row = tng_fetch_assoc( $result ) ) {
		if( !in_array( $row['tag'], $dontdo ) ) {
			echo "<option value=\"{$row['eventtypeID']}\"";
			if( $tngevent == $row['eventtypeID'] ) echo " selected=\"selected\"";
			echo ">" . getEventDisplay( $row['display'] ) . "</option>\n";
		}
	} 
	tng_free_result($result);
?>
	</select>
</div>
<div class="annfield normal">
	<label for="tngdaymonth"><?php echo $text['day']; ?>:</label><br/>
	<select name="tngdaymonth" id="tngdaymonth">
		<option value="">&nbsp;</option>
<?php
	for( $i = 1; $i <= 31; $i++ ) {
		echo "<option value=\"$i\"";
		if( $i == $tngdaymonth ) echo " selected=\"selected\"";
		echo ">$i</option>\n";
	}
	$tngkeywordsclean = preg_replace("/\"/", "&#34;",stripslashes($tngkeywords));
?>
	</select>
</div>
<div class="annfield normal">
	<label for="tngmonth" class="annlabel"><?php echo $text['month']; ?>:</label><br/>
	<select name="tngmonth" id="tngmonth">
		<option value="">&nbsp;</option>
		<option value="1"<?php if( $tngmonth == 1 ) echo " selected=\"selected\""; ?>><?php echo $dates['JANUARY']; ?></option>
		<option value="2"<?php if( $tngmonth == 2 ) echo " selected=\"selected\""; ?>><?php echo $dates['FEBRUARY']; ?></option>
		<option value="3"<?php if( $tngmonth == 3 ) echo " selected=\"selected\""; ?>><?php echo $dates['MARCH']; ?></option>
		<option value="4"<?php if( $tngmonth == 4 ) echo " selected=\"selected\""; ?>><?php echo $dates['APRIL']; ?></option>
		<option value="5"<?php if( $tngmonth == 5 ) echo " selected=\"selected\""; ?>><?php echo $dates['MAY']; ?></option>
		<option value="6"<?php if( $tngmonth == 6 ) echo " selected=\"selected\""; ?>><?php echo $dates['JUNE']; ?></option>
		<option value="7"<?php if( $tngmonth == 7 ) echo " selected=\"selected\""; ?>><?php echo $dates['JULY']; ?></option>
		<option value="8"<?php if( $tngmonth == 8 ) echo " selected=\"selected\""; ?>><?php echo $dates['AUGUST']; ?></option>
		<option value="9"<?php if( $tngmonth == 9 ) echo " selected=\"selected\""; ?>><?php echo $dates['SEPTEMBER']; ?></option>
		<option value="10"<?php if( $tngmonth == 10 ) echo " selected=\"selected\""; ?>><?php echo $dates['OCTOBER']; ?></option>
		<option value="11"<?php if( $tngmonth == 11 ) echo " selected=\"selected\""; ?>><?php echo $dates['NOVEMBER']; ?></option>
		<option value="12"<?php if( $tngmonth == 12 ) echo " selected=\"selected\""; ?>><?php echo $dates['DECEMBER']; ?></option>
	</select>
</div>
<div class="annfield normal">
	<label for="tngyear"><?php echo $text['year']; ?>:</label><br/>
	<input type="text" name="tngyear" id="tngyear" size="6" maxlength="4" value="<?php echo $tngyear; ?>" />
</div>
<div class="annfield normal">
	<label for="tngkeywords"><?php echo $text['keyword']; ?>:</label><br/>
	<input type="text" name="tngkeywords" id="tngkeywords" size="20" value="<?php echo stripslashes($tngkeywordsclean); ?>" />
</div>
<div class="annfield normal">
	<br/>
	<input type="hidden" name="tngneedresults" value="1" /><input type="submit" value="<?php echo $text['search']; ?>" />
	<input type="button" value="<?php echo $text['tng_reset']; ?>" onclick="resetForm();" />
	| <input type="button" value="<?php echo $text['calendar']; ?>" onclick="window.location.href='<?php echo "{$calendar_url}m=$tngmonth&amp;year=$tngyear&amp;tree=$tree"; ?>';" />
</div>

</form>
<br clear="all"/>
<br />

<?php
if( $tngneedresults ) {
	$successcount = 0;
	if( $tngevent )
		$tngevents = array($tngevent);
	else {
		$tngevents = array("birth","altbirth","death","burial","marr","div");
		if($ldsOK) {
			$ldsevents = array("seal", "endl", "bapt", "conf", "init");
			$tngevents = array_merge($tngevents, $ldsevents);
		}
		$query = "SELECT tag, eventtypeID FROM $eventtypes_table 
			WHERE keep=\"1\" AND type=\"I\" ORDER BY display";
		$result = tng_query($query);
		$dontdo = array("ADDR","BIRT","CHR","DEAT","BURI","NAME","NICK","TITL","NSFX","DIV","MARR");
		while( $row = tng_fetch_assoc( $result ) ) {
			if( !in_array( $row['tag'], $dontdo ) )
				array_push( $tngevents, $row['eventtypeID'] );
		} 
		tng_free_result($result);
	}
	$urlstring = "";
	foreach( $tngevents as $tngevent ) {
		$allwhere = "";

		$eventsjoin = "";
		$eventsfields = "";
		$needfamilies = "";
		$tngsaveevent = $tngevent;
		switch( $tngevent ) {
			case "birth":
				$datetxt = $text['born'];
				break;
			case "altbirth":
				$datetxt = $text['christened'];
				break;
			case "death":
				$datetxt = $text['died'];
				break;
			case "burial":
				$datetxt = $text['buried'];
				break;
			case "marr":
				$datetxt = $text['married'];
				$needfamilies = 1;
				break;
			case "div":
				$datetxt = $text['divorced'];
				$needfamilies = 1;
				break;
			case "seal":
				$datetxt = $text['sealedslds'];
				$needfamilies = 1;
				break;
			case "endl":
				$datetxt = $text['endowedlds'];
				break;
			case "bapt":
				$datetxt = $text['baptizedlds'];
				break;
			case "conf":
				$datetxt = $text['conflds'];
				break;
			case "init":
				$datetxt = $text['initlds'];
				break;
			default:
				//look up display
				$query = "SELECT display FROM $eventtypes_table 
					WHERE eventtypeID=\"$tngevent\" ORDER BY display";
				$evresult = tng_query($query);
				$event = tng_fetch_assoc( $evresult );
				$datetxt = getEventDisplay( $event['display'] );
				tng_free_result( $evresult );
				
				$eventsjoin = ", $events_table";
				$eventsfields = ",info";
				$allwhere .= " AND $people_table.personID = $events_table.persfamID AND $people_table.gedcom = $events_table.gedcom AND eventtypeID = \"$tngevent\"";
				$tngevent = "event";
				break;
		}
		if( $needfamilies ) {
			$familiessortdate = ", " . $tngevent . "datetr";
		}
		else {
			$familiessortdate = "";
		}
		
		$datefield = $tngevent . "date";
		$datefieldtr = $tngevent . "datetr";
		$place = $tngevent . "place";

		if( $tngdaymonth ) {
			$allwhere .= " AND DAYOFMONTH($datefieldtr) = '$tngdaymonth'";
		}
		if( $tngmonth ) {
			$allwhere .= " AND MONTH($datefieldtr) = '$tngmonth'";
		}
		if( $tngyear ) {
			$allwhere .= " AND YEAR($datefieldtr) = '$tngyear'";
		}
		if( $tngkeywords ) {
			$allwhere .= " AND $datefield LIKE '%$tngkeywords%'";
		}
		if( $tngdaymonth || $tngmonth || $tngyear ) {
			$allwhere .= " AND $datefieldtr != '0000-00-00'";
		}

		if( $tree ) {
			if( $urlstring )
				$urlstring .= "&amp;";
			$urlstring .= "tree=$tree";
			
			if( $allwhere ) $allwhere = " AND (1=1 $allwhere)";
			if($needfamilies)
				$allwhere .= " AND $families_table.gedcom=\"$tree\"";
			else
				$allwhere .= " AND $people_table.gedcom=\"$tree\"";
		}
		
		if($needfamilies)
			$more = getLivingPrivateRestrictions($families_table, false, true);
		else
			$more = getLivingPrivateRestrictions($people_table, false, true);
		if($more) {
			$allwhere .= " AND " . $more;
		}

		$max_browsesearch_pages = 5;
		if( $offset ) {
			$offsetplus = $offset + 1;
			$newoffset = "$offset, ";
		}
		else {
			$offset = 0;
			$offsetplus = 1;
			$newoffset = "";
			$tngpage = 1;
		}
		
		if($needfamilies) {
			//run query on families table
			//join with both hperson and wperson to get husband and wife info
			$query = "SELECT $families_table.ID, husb.personID as hpersonID, husb.lastname as hlastname, husb.lnprefix as hlnprefix, husb.firstname as hfirstname,
				husb.living as hliving, husb.private as hprivate, husb.branch as hbranch, husb.prefix as hprefix, husb.suffix as hsuffix, husb.nameorder as hnameorder, husb.title as htitle,
				husb.birthdate as hbirthdate, husb.birthdatetr as hbirthdatetr, husb.altbirthdate as haltbirthdate, husb.altbirthdatetr as haltbirthdatetr, husb.deathdate as hdeathdate, husb.deathdatetr as hdeathdatetr,
				wife.personID as wpersonID, wife.lastname as wlastname, wife.lnprefix as wlnprefix, wife.firstname as wfirstname,
				wife.living as wliving, wife.private as wprivate, wife.branch as wbranch, wife.prefix as wprefix, wife.suffix as wsuffix, wife.nameorder as wnameorder, wife.title as wtitle,
				wife.birthdate as wbirthdate, wife.birthdatetr as wbirthdatetr, wife.altbirthdate as waltbirthdate, wife.altbirthdatetr as waltbirthdatetr, wife.deathdate as wdeathdate, wife.deathdatetr as wdeathdatetr,
				$place, $datefield, $families_table.gedcom, treename, $families_table.living, $families_table.private, $families_table.branch $familiessortdate
				FROM ($families_table, $trees_table)
				LEFT JOIN $people_table AS husb ON $families_table.husband = husb.personID AND $families_table.gedcom = husb.gedcom
				LEFT JOIN $people_table AS wife ON $families_table.wife = wife.personID AND $families_table.gedcom = wife.gedcom
				WHERE $families_table.gedcom = $trees_table.gedcom $allwhere ";
			$query .= " ORDER BY DAY($datefieldtr), MONTH($datefieldtr), YEAR($datefieldtr), hlastname, hfirstname LIMIT $newoffset" . $maxsearchresults;

			//assemble two-row name & person ID values
		}	
		else {
			//run regular query on people table
			$query = "SELECT $people_table.ID, $people_table.personID, lastname, lnprefix, firstname, $people_table.living, $people_table.private, $people_table.branch, prefix, suffix, nameorder, title, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr, $place, $datefield, $people_table.gedcom, treename $familiessortdate $eventsfields
				FROM ($people_table, $trees_table $eventsjoin)
				WHERE $people_table.gedcom = $trees_table.gedcom $allwhere ";
			$query .= " ORDER BY DAY($datefieldtr), MONTH($datefieldtr), YEAR($datefieldtr), lastname, firstname LIMIT $newoffset" . $maxsearchresults;
			//"assemble" one-row name & person ID value
		}	
		//pass assembled values to the table mechanism below


		//echo "debug: $query<br>\n";
		$result = tng_query($query);
		$numrows = tng_num_rows( $result );

		if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
			if( $needfamilies ) {
				$query = "SELECT count(familyID) as pcount
					FROM ($families_table, $trees_table)
					WHERE $families_table.gedcom = $trees_table.gedcom $allwhere";
			} else {
				$query = "SELECT count(personID) as pcount
					FROM ($people_table, $trees_table $eventsjoin)
					WHERE $people_table.gedcom = $trees_table.gedcom $allwhere";
			}
			$result2 = tng_query($query);
			$countrow = tng_fetch_assoc($result2);
			$totrows = $countrow['pcount'];
		}
		else
			$totrows = $numrows;
		
		if ( $numrows ) {
			echo "<div class=\"titlebox\">\n";
			echo "<span class=\"subhead\"><strong>$datetxt</strong></span>";
			$numrowsplus = $numrows + $offset;
			$successcount++;
			
			echo "<p>{$text['matches']} $offsetplus {$text['to']} $numrowsplus {$text['of']} $totrows</p>";
			
			$pagenav = get_browseitems_nav( $totrows, "$anniversaries2_url" . "$urlstring&amp;tngevent=$tngsaveevent&amp;tngdaymonth=$tngdaymonth&amp;tngmonth=$tngmonth&amp;tngyear=$tngyear&amp;tngkeywords=$tngkeywords&amp;tngneedresults=1&amp;offset", $maxsearchresults, $max_browsesearch_pages );
			if($pagenav) echo "<p>$pagenav</p>";

			$header = "";
			$headerr = $enableminimap ? " data-tablesaw-minimap" : "";
			$headerr .= $enablemodeswitch ? " data-tablesaw-mode-switch" : "";

			if($sitever != "standard") {
				if($tabletype == "toggle") $tabletype = "columntoggle";
				$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" width=\"100%\" class=\"tablesaw thfixed whiteback normal\" data-tablesaw-mode=\"$tabletype\"{$headerr}>\n";
			} else {
				$header = "<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" width=\"100%\" class=\"thfixed whiteback normal\">";
			}
			echo $header;
?>
	<thead>
		<tr>
		<th data-tablesaw-priority="persist" class="fieldnameback nbrcol fieldname">&nbsp;#&nbsp;</th>
		<th data-tablesaw-priority="1" class="fieldnameback fieldname">&nbsp;<?php echo $text['lastfirst']; ?>&nbsp;</th>
		<th data-tablesaw-priority="2" class="fieldnameback fieldname" colspan="2">&nbsp;<?php echo $datetxt; ?>&nbsp;</th>
		<th data-tablesaw-priority="4" class="fieldnameback fieldname">&nbsp;<?php echo $text['personid']; ?>&nbsp;</th>
<?php
	if($numtrees > 1) {
?>
		<th data-tablesaw-priority="4" class="fieldnameback fieldname">&nbsp;<?php echo $text['tree']; ?>&nbsp;</th>
<?php
	}
?>
		</tr>
	</thead>

<?php
			$i = $offsetplus;
			$chartlinkimg = @GetImageSize($cms['tngpath'] . "img/Chart.gif");
			$chartlink = "<img src=\"{$cms['tngpath']}img/Chart.gif\" border=\"0\" alt=\"\" $chartlinkimg[3] />";
			$treestr = $tngconfig['places1tree'] ? "" : "tree=$tree&amp;";
			while( $row = tng_fetch_assoc($result))
			{
				echo "<tr>";
				echo "<td class=\"databack\">$i</td>\n";
				$i++;
				echo "<td class=\"databack\">\n";

				$personIDstr = $namestr = $hboth = $wboth = "";
				if($needfamilies) {
					//do husband
					$famrights = determineLivingPrivateRights($row, $righttree);
					if($row['hpersonID']) {
						$row['personID'] = $row['hpersonID'];
						$row['lastname'] = $row['hlastname'];
						$row['lnprefix'] = $row['hlnprefix'];
						$row['firstname'] = $row['hfirstname'];
						$row['living'] = $row['hliving'];
						$row['private'] = $row['hprivate'];
						$row['branch'] = $row['hbranch'];
						$row['prefix'] = $row['hprefix'];
						$row['suffix'] = $row['hsuffix'];
						$row['nameorder'] = $row['hnameorder'];
						$row['title'] = $row['htitle'];
						$row['birthdate'] = $row['hbirthdate'];
						$row['birthdatetr'] = $row['hbirthdatetr'];
						$row['altbirthdate'] = $row['haltbirthdate'];
						$row['altbirthdatetr'] = $row['haltbirthdatetr'];
						$row['deathdate'] = $row['hdeathdate'];
						$row['deathdatetr'] = $row['hdeathdatetr'];
						$row['gedcom'] = $row['gedcom'];
						$rights = determineLivingPrivateRights($row);
						$row['allow_living'] = $rights['living'];
						$row['allow_private'] = $rights['private'];
						$hboth = $rights['both'];
						$name = getNameRev( $row );
						$personIDstr = $row['hpersonID'];

						if($sitever != "mobile")
							$namestr .= "<div class=\"person-img\" id=\"mi{$row['gedcom']}_{$row['personID']}_$tngevent\"><div class=\"person-prev\" id=\"prev{$row['gedcom']}_{$row['personID']}_$tngevent\"></div></div>\n";
						$namestr .= "<a href=\"$pedigree_url" . "personID={$row['personID']}&amp;tree={$row['gedcom']}\">$chartlink</a> <a href=\"$getperson_url" . "personID={$row['personID']}&amp;tree={$row['gedcom']}\" class=\"pers\" id=\"p{$row['personID']}_t{$row['gedcom']}:$tngevent\">$name</a>&nbsp;";
					}

					//now dow wife
					if($row['wpersonID']) {
						$row['personID'] = $row['wpersonID'];
						$row['lastname'] = $row['wlastname'];
						$row['lnprefix'] = $row['wlnprefix'];
						$row['firstname'] = $row['wfirstname'];
						$row['living'] = $row['wliving'];
						$row['private'] = $row['wprivate'];
						$row['branch'] = $row['wbranch'];
						$row['prefix'] = $row['wprefix'];
						$row['suffix'] = $row['wsuffix'];
						$row['nameorder'] = $row['wnameorder'];
						$row['title'] = $row['wtitle'];
						$row['birthdate'] = $row['wbirthdate'];
						$row['birthdatetr'] = $row['wbirthdatetr'];
						$row['altbirthdate'] = $row['waltbirthdate'];
						$row['altbirthdatetr'] = $row['waltbirthdatetr'];
						$row['deathdate'] = $row['wdeathdate'];
						$row['deathdatetr'] = $row['wdeathdatetr'];
						$row['gedcom'] = $row['gedcom'];
						$rights = determineLivingPrivateRights($row);
						$row['allow_living'] = $rights['living'];
						$row['allow_private'] = $rights['private'];
						$wboth = $rights['both'];
						$name = getNameRev( $row );
						if($personIDstr) 
							$personIDstr .= "<br/>";
						$personIDstr .= $row['wpersonID'];

						if($namestr) $namestr .= "<br/>";
						if($sitever != "mobile")
							$namestr .= "<div class=\"person-img\" id=\"mi{$row['gedcom']}_{$row['personID']}_$tngevent\"><div class=\"person-prev\" id=\"prev{$row['gedcom']}_{$row['personID']}_$tngevent\"></div></div>\n";
						$namestr .= "<a href=\"$pedigree_url" . "personID={$row['personID']}&amp;tree={$row['gedcom']}\">$chartlink</a> <a href=\"$getperson_url" . "personID={$row['personID']}&amp;tree={$row['gedcom']}\" class=\"pers\" id=\"p{$row['personID']}_t{$row['gedcom']}:$tngevent\">$name</a>&nbsp;";
					}
					$rights['both'] = $hboth && $wboth && $famrights['both'];
				}
				else {
					$rights = determineLivingPrivateRights($row);
					$row['allow_living'] = $rights['living'];
					$row['allow_private'] = $rights['private'];
					$name = getNameRev( $row );
					$personIDstr = $row['personID'];

					if($sitever != "mobile")
						$namestr .= "<div class=\"person-img\" id=\"mi{$row['gedcom']}_{$row['personID']}_$tngevent\"><div class=\"person-prev\" id=\"prev{$row['gedcom']}_{$row['personID']}_$tngevent\"></div></div>\n";
					$namestr .= "<a href=\"$pedigree_url" . "personID={$row['personID']}&amp;tree={$row['gedcom']}\">$chartlink</a> <a href=\"$getperson_url" . "personID={$row['personID']}&amp;tree={$row['gedcom']}\" class=\"pers\" id=\"p{$row['personID']}_t{$row['gedcom']}:$tngevent\">$name</a>&nbsp;";
				}
				echo $namestr;

				if($rights['both']) {
					$info = isset($row['info']) ? truncateIt($row['info'], 75) : "";
					$placetxt = $row[$place] ? $row[$place] . " <a href=\"$placesearch_url" . "{$treestr}psearch=" . urlencode( $row[$place] ) . "\" title=\"{$text['findplaces']}\"><img src=\"{$cms['tngpath']}img/tng_search_small.gif\" class=\"placeimg\" border=\"0\" alt=\"{$text['findplaces']}\" width=\"9\" height=\"9\" /></a>" : $info;
					$dateval = $row[$datefield];
				}
				else
					$dateval = $placetxt = "";
				echo "</td>\n";

				echo "<td class=\"databack\">&nbsp;" . displayDate($dateval) . "</td><td class=\"databack\">$placetxt&nbsp;</td>";
				echo "<td class=\"databack\">$personIDstr </td>";
				if($numtrees > 1)
					echo "<td class=\"databack\"><a href=\"$showtree_url" . "tree={$row['gedcom']}\">{$row['treename']}</a>&nbsp;</td>";
				echo "</tr>\n";
			}
			tng_free_result($result);
?>
	
	</table>
	
<?php
			if($pagenav) echo "<p>$pagenav</p>";
			echo "</div><br />\n";
		}
	}
	if( !$successcount )
		echo "<p>{$text['noresults']}.</p>";
} //end of $tng_needresults
tng_footer( "" );
?>