<?php
$textpart = "reports";
include("tng_begin.php");

include($cms['tngpath'] . "functions.php");
if(!isset($csv)) $csv = false;

if(!is_numeric($reportID)) die ("Sorry!");

function processfield( $field ) {
	global $need_families, $cejoins, $evfields, $people_table, $events_table, $familyfields_nonss;

	if( in_array( $field, $familyfields_nonss ) ) {
		$newfield = "if(sex='M',families1." . $field . ",families2." . $field . ")";
		$need_families = 1;
	}
	elseif( substr($field,0,2) == "ss" ) {
		$newfield = "if(sex='M',families1." . substr($field,1) . ",families2." . substr($field,1) . ")";
		$need_families = 1;
	}
	elseif( substr($field,0,2) == "ce" ) {
		$eventtypeID = substr( $field,6 );
		$subtype = substr( $field,3,2 );
		$newfield = "e$eventtypeID.$evfields[$subtype]";
		if( !isset( $cejoins[$eventtypeID] ) )
			$cejoins[$eventtypeID] = "LEFT JOIN $events_table e$eventtypeID ON $people_table.personID = e$eventtypeID.persfamID AND $people_table.gedcom = e$eventtypeID.gedcom AND e$eventtypeID.eventtypeID = \"$eventtypeID\"";
	}
	else
		$newfield = $field;
	return $newfield;
}

$showreport_url = getURL( "showreport", 1 );
$showtree_url = getURL( "showtree", 1 );
$getperson_url = getURL( "getperson", 1 );
$placesearch_url = getURL( "placesearch", 1 );

$ldsfields = array("baptdate","baptplace","confdate","confplace","initdate","initplace","endldate","endlplace","ssealdate","ssealplace","psealdate","psealplace");

$max_browsesearch_pages = 5;
if( !isset($offset) ) $offset = 0;
if( $offset ) {
	$offsetplus = $offset + 1;
	$newoffset = "$offset, ";
}
else {
	$newoffset = "";
	$offsetplus = 1;
	$page = 1;
}
	
$query = "SELECT * FROM $reports_table WHERE reportID = $reportID";
if( !isset($test) ) $test = "";
if(!$test && $assignedtree) $query .= " and active > 0";
$testurl = $test ? "&amp;test=$test" : "";
$result = tng_query($query);
$rrow = tng_fetch_assoc( $result );
if(!tng_num_rows($result) || (!$rrow['active'] && !$allow_admin)) {
	tng_free_result($result);
	header( "Location: thispagedoesnotexist.html" );
	exit;
}
else
	tng_free_result($result);

$displaytext = "";
if( $rrow['sqlselect'] ) {
	$rrow['sqlselect'] = preg_replace("/\r\n/"," ",$rrow['sqlselect']);
	$rrow['sqlselect'] = preg_replace("/\r/"," ",$rrow['sqlselect']);
	$rrow['sqlselect'] = preg_replace("/\n/"," ",$rrow['sqlselect']);
	if( strtoupper( substr( $rrow['sqlselect'],0,7 ) ) == "SELECT " ) {
		$sqlselect = substr( $rrow['sqlselect'],7 );
		$query = $rrow['sqlselect'];
	}
	else {
		$sqlselect = $rrow['sqlselect'];
		$query = "SELECT " . $rrow['sqlselect'];
	}
	$fromat = strpos( strtoupper( $sqlselect ), " FROM " );
	$from = substr($sqlselect, $fromat);
	$sqlselect = substr( $sqlselect, 0, $fromat );
	
	$displayfields = explode( "," , $sqlselect );
	$newds = array();
	$newdsctr = 0;
	$num_displayfields = count($displayfields);
	for( $i = 0; $i < $num_displayfields; $i++ ) {
		$displaymsg = "";
		$tempmsg = $displayfields[$i];
		do {
			$numopen = substr_count($tempmsg,"(");
			$numclosed = substr_count($tempmsg,")");
			if( $numopen != $numclosed && $i < (count( $displayfields ) - 1) ) {
				$i++;
				$tempmsg = $tempmsg . "," . $displayfields[$i];
			}
		} while( $numopen != $numclosed );

		$gotas = strpos( strtoupper($displayfields[$i]), " AS " );
		$gotas = strpos( strtoupper($tempmsg), " AS " );
		if( $gotas )
			$tempmsg = substr( $tempmsg,$gotas+4 );
		else {
			$gotperiod = strpos( $tempmsg, "." );
			if( $gotperiod )
				$tempmsg = substr( $tempmsg,$gotperiod+1 );
		}
		$dfield = $tempmsg = trim( $tempmsg );
		if( $dfield == "personID" ) {
			$dfield = "personid";
			$gotpersonid = true;
		}
		else
			$gotpersonid = false;
		if( !$displaymsg ) $displaymsg = isset($text[$dfield]) ? $text[$dfield] : "";
		if( !$displaymsg ) $displaymsg = isset($text[strtolower($dfield)]) ? $text[strtolower($dfield)] : "";
		if( !$displaymsg ) $displaymsg = $dfield;
		$displaytext .= $csv ? ($displaytext ? ",\"$displaymsg\"" : "\"$displaymsg\"") : "<th class=\"fieldnameback\"><span class=\"fieldname\"><strong>$displaymsg</strong></span></th>\n";

		$newds[$newdsctr] = $tempmsg;
		$newdsctr++;
	}
	$newds[$newdsctr] = "";
	$displayfields = $newds;
	$query = str_replace(";", "", $rrow['sqlselect'] );
}
else {
	if( $tree ) {
		$peopletreestr = "$people_table.gedcom = \"$tree\"";
		//$familytreestr = "if(sex='M',families1.gedcom = \"$tree\",families2.gedcom = \"$tree\")";
		$childrentreestr = "$children_table.gedcom = \"$tree\"";
	}
	else {
		$peopletreestr = "";
		//$familytreestr = "";
		$childrentreestr = "";
	}
	$treestr = $peopletreestr;
	$trees_join = "";
	
	$need_families = 0;
	$need_children = 0;
	
	$subtypes = array();
	$evfields['dt'] = "eventdate";
	$evfields['tr'] = "eventdatetr";
	$evfields['pl'] = "eventplace";
	$evfields['fa'] = "info";
	
	$subtypes['dt'] = $text['date'];
	$subtypes['pl'] = $text['place'];
	$subtypes['fa'] = "";

	$displaytext = "";
	$truedates = array("birthdatetr","altbirthdatetr","deathdatetr","burialdatetr","baptdatetr","confdatetr","initdatetr","endldatetr","ssealdatetr","psealdatetr","marrdatetr","changedate");
	$familyfields = array("marrdate","marrdatetr","marrplace","divdate","divdatetr","divplace","ssealdate","ssealdatetr","ssealplace");
	$familyfields_nonss = array("marrdate","marrdatetr","marrplace","divdate","divdatetr","divplace");
	$cejoins = array();

	$displaystr = "$people_table.living, $people_table.private, lnprefix, prefix, suffix, title, $people_table.branch, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr";
	$displayfields = explode( $lineending, $rrow['display'] );
	$dtreestr = "";
	$num_displayfields = count( $displayfields ) - 1;
	for( $i = 0; $i < $num_displayfields; $i++ ) {
		$dfield = $displayfields[$i];
		$tngprefix = substr( $dfield,0,2 );
		$displaymsg = "";
		
		if( $dfield != "personID" && ( determineLDSRights() || !in_array( $dfield, $ldsfields ) ) ) {
			if( $displaystr ) $displaystr .= ",";
			if( in_array( $dfield, $familyfields_nonss ) ) {
				if( $dfield == "marrdatetr" || $dfield == "divdatetr" || $dfield == "ssealdatetr" )
					$displayfields[$i] = "if(sex='M',DATE_FORMAT(families1." . $dfield . ",'%d %b %Y'),DATE_FORMAT(families2." . $dfield . ",'%d %b %Y'))";
				else
					$displayfields[$i] = "if(sex='M',families1." . $dfield . ",families2." . $dfield . ")";
				$need_families = 1;
			}
			if( $tngprefix == "ss" ) {
				$need_families = 1;
				$displayfields[$i] = "if(sex='M',families1." . substr($dfield,1) . ",families2." . substr($dfield,1) . ")";
			}
			if( $tngprefix == "ps" ) {
				$displayfields[$i] = "$children_table." . substr($dfield,1);
				$need_children = 1;
			}
			if( substr( $dfield, 0, 6 ) == "spouse" ) {
				$need_families = 1;
				$displaystr .= "(if(sex='M',families1.wife,families2.husband)) as spouse";
			}
			elseif( in_array( $dfield, $truedates ) )
				$displaystr .= "DATE_FORMAT($people_table.$dfield,'%d %b %Y') as $dfield" . "_disp";
			elseif( $dfield == "gedcom" ) {
				$trees_join = ", $trees_table";
				if( !$dtreestr ) $dtreestr = " $people_table.gedcom = $trees_table.gedcom";
				$displaystr .= "treename";
				$displayfields[$i] = "treename";
			}
			elseif( $tngprefix == "ce" ) {
				$eventtypeID = substr( $dfield,6 );
				$query = "SELECT display FROM $eventtypes_table WHERE eventtypeID=\"$eventtypeID\"";
				$evresult = tng_query($query);
				$evrow = tng_fetch_assoc( $evresult );
				tng_free_result( $evresult );
	
				$subtype = substr( $dfield,3,2 );
				$displaymsg = getEventDisplay( $evrow['display'] );
				if($subtypes[$subtype])
					$displaymsg .= ": " . $subtypes[$subtype];

				$displaystr .= "e$eventtypeID.$evfields[$subtype] as $evfields[$subtype]$eventtypeID";
				$displayfields[$i] = "$evfields[$subtype]$eventtypeID";
				if( !isset( $cejoins[$eventtypeID] ) )
					$cejoins[$eventtypeID] = "LEFT JOIN $events_table e$eventtypeID ON $people_table.personID = e$eventtypeID.persfamID AND $people_table.gedcom = e$eventtypeID.gedcom AND e$eventtypeID.eventtypeID = \"$eventtypeID\"";
			}
			elseif( $dfield == "lastfirst" )
				$displaystr .= "lastname, firstname";
			elseif( $dfield == "fullname" )
				$displaystr .= "firstname, lastname";
			else
				$displaystr .= $displayfields[$i];
		}
		if( !$displaymsg ) $displaymsg = isset($text[$dfield]) ? $text[$dfield] : "";
		if( !$displaymsg ) $displaymsg = isset($text[strtolower($dfield)]) ? $text[strtolower($dfield)] : "";
		$displaytext .= $csv ? ($displaytext ? ",\"$displaymsg\"" : "\"$displaymsg\"") : "<th class=\"fieldnameback\"><span class=\"fieldname\"><strong>$displaymsg</strong></span></th>\n";
	}
	if( $dtreestr ) {
		if( $treestr ) $treestr .= " AND";
		$treestr .= $dtreestr;
	}
	$displaystr .= ", $people_table.personID, $people_table.gedcom, nameorder";
	
	$criteriastr = "";
	$criteriafields = explode( $lineending, $rrow['criteria'] );
	$mnemonics = array("eq","neq","gt","gte","lt","lte");
	$symbols = array("=","!=",">",">=","<","<=");
	$num_criteriafields = count($criteriafields) - 1;
	for( $i = 0; $i < $num_criteriafields; $i++ ) {
		$table = "";
		$truedate = 0;
		if( $criteriastr ) $criteriastr .= " ";
		if( in_array( $criteriafields[$i], $familyfields ) )
			$need_families = 1;
	
		if( $criteriafields[$i] == "currmonth" )
			$criteriafields[$i] = "\"" . strtoupper( date( "M", time() + ( 3600 * $time_offset ) ) ) . "\"";
		else if( $criteriafields[$i] == "currmonthnum" )
			$criteriafields[$i] = "\"" . date( "m", time() + ( 3600 * $time_offset ) ) . "\"";
		else if( $criteriafields[$i] == "curryear" )
			$criteriafields[$i] = "\"" . date( "Y", time() + ( 3600 * $time_offset ) ) . "\"";
		else if( $criteriafields[$i] == "currday" )
			$criteriafields[$i] = "\"" . date( "d", time() + ( 3600 * $time_offset ) ) . "\"";
		else if( $criteriafields[$i] == "personID" )
			$criteriafields[$i] = "$people_table.personID";
		else if( $criteriafields[$i] == "today" ) {
			// Resolve an SQL error and the fact that this doesn't equal today, but now.
			if($time_offset) {
				if($time_offset > 0)
					$criteriafields[$i] = "SUBSTRING(DATE_ADD(NOW(), INTERVAL " . $time_offset . " HOUR), 1, 10)";
				else
					$criteriafields[$i] = "SUBSTRING(DATE_SUB(NOW(), INTERVAL " . $time_offset . " HOUR), 1, 10)";
			}
			else
				$criteriafields[$i] = "SUBSTRING(NOW(), 1, 10)";
			$truedate = 1;
		}
		else if( in_array($criteriafields[$i],$truedates) ) {
			$truedate = 1;
		}
		else
			$truedate = 0;
			
		switch( $criteriafields[$i] ) {
			case "dayonly":
			case "monthonly":
			case "yearonly":
			case "to_days":
				$criteriastr .= "";
				break;
			case "contains":
			case "starts with":
			case "ends with":
				$criteriastr .= "LIKE";
				break;
			case "living":
				$criteriastr .= "$people_table.living = 1";
				break;
			case "dead":
				$criteriastr .= "$people_table.living != 1";
				break;
			case "private":
				$criteriastr .= "$people_table.private = 1";
				break;
			case "open":
				$criteriastr .= "$people_table.private != 1";
				break;
			default:
				if( in_array( $criteriafields[$i], $familyfields_nonss ) ) {
					$newcriteria = "if(sex='M',families1." . $criteriafields[$i] . ",families2." . $criteriafields[$i] . ")";
					$need_families = 1;
				}
				else {
					if( substr( $criteriafields[$i],0,2 ) == "ce" ) {
						$eventtypeID = substr( $criteriafields[$i],6 );
						$subtype = substr( $criteriafields[$i],3,2 );
						$newcriteria = "e$eventtypeID.$evfields[$subtype]";
						if( !isset( $cejoins[$eventtypeID] ) )
							$cejoins[$eventtypeID] = "LEFT JOIN $events_table e$eventtypeID ON $people_table.personID = e$eventtypeID.persfamID AND $people_table.gedcom = e$eventtypeID.gedcom AND e$eventtypeID.eventtypeID = \"$eventtypeID\"";
					}
					else {
						$newcriteria = $criteriafields[$i];
						if( $newcriteria == "changedate" )
							$newcriteria = "$people_table." . $newcriteria;
						else {
							$position = array_search($newcriteria,$mnemonics);
							if($position !== false)
								$newcriteria = $symbols[$position];
						}
					}
				}
	
				if( $i == 0 ) {
					$criteriafields[$i-1] = $criteriafields[$i];
				}
				switch( $criteriafields[$i-1] ) {
					case "dayonly":
						if( $truedate )
							$criteriastr .= "DAYOFMONTH($newcriteria)";
						else
							$criteriastr .= "LPAD(SUBSTRING_INDEX($newcriteria, ' ', 1),2,'0')";
						break;
					case "monthonly":
						if( $truedate )
							$criteriastr .= "MONTH($newcriteria)";
						else
							$criteriastr .= "substring(SUBSTRING_INDEX($newcriteria, ' ', -2),1,3)";
						break;
					case "yearonly":
						if( $truedate )
							$criteriastr .= "YEAR($newcriteria)";
						else
							$criteriastr .= "LPAD(SUBSTRING_INDEX($newcriteria, ' ', -1),4,'0')";
						break;
					case "to_days":
						if( $truedate )
							$criteriastr .= "TO_DAYS($newcriteria)";
						else
							$criteriastr .= "LPAD(SUBSTRING_INDEX($newcriteria, ' ', -1),4,'0')";
						break;
					case "contains":
						if( substr( $criteriafields[$i], 0, 1 ) == "\"" )
							$newcriteria = substr( $criteriafields[$i], 1, -1 );
						$criteriastr .= "\"%" . $newcriteria . "%\"";
						break;
					case "starts with":
						if( substr( $criteriafields[$i], 0, 1 ) == "\"" )
							$newcriteria = substr( $criteriafields[$i], 1, -1 );
						$criteriastr .= "\"" . $newcriteria . "%\"";
						break;
					case "ends with":
						if( substr( $criteriafields[$i], 0, 1 ) == "\"" )
							$newcriteria = substr( $criteriafields[$i], 1, -1 );
						$criteriastr .= "\"%" . $newcriteria . "\"";
						break;
					default:
						if( substr($criteriafields[$i],0,2) == "ps" ) {
							$criteriastr .= "$children_table." . substr($criteriafields[$i],1);
							$need_children = 1;
						}
						else if( substr($criteriafields[$i],0,2) == "ss" ) {
							$criteriastr .= "if(sex='M',families1." . substr($criteriafields[$i],1) . ",families2." . substr($criteriafields[$i],1) . ")";
							$need_families = 1;
						}
						else if( $criteriafields[$i] == "gedcom" )
							$criteriastr .= "$people_table.$newcriteria";
						else
							$criteriastr .= $newcriteria;
						break;
				}
				break;
		}
	}

	$more = getLivingPrivateRestrictions($people_table, null, null);
	if($more) {
		if($criteriastr)
			$criteriastr = "($criteriastr) AND ";
		$criteriastr .= $more;
	}
	if( $criteriastr )
		$criteriastr = "WHERE ($criteriastr)";

	$orderbystr = "";
	$orderbyfields = explode( $lineending, $rrow['orderby'] );
	$num_orderbyfields = count($orderbyfields) - 1;
	for( $i = 0; $i < $num_orderbyfields; $i++ ) {
		if( $orderbystr ) {
			if( $orderbyfields[$i] == "desc" )
				$orderbystr .= " ";
			else
				$orderbystr .= ",";
		}
		$tngprefix = "";
		if( $orderbyfields[$i] == "dayonly" ) {
			$i++;
			$newfield = processfield( $orderbyfields[$i] );
			if( in_array($orderbyfields[$i],$truedates) )
				$newfield = "DAYOFMONTH($newfield)";
			else
				$newfield = "LPAD(SUBSTRING_INDEX($newfield, ' ', 1),2,'0')";
			$displaystr .= ", $newfield as dayonly$orderbyfields[$i]";
			$orderbystr .= "dayonly$orderbyfields[$i]";
		}
		else if( $orderbyfields[$i] == "monthonly" ) {
			$i++;
			$newfield = processfield( $orderbyfields[$i] );
			if( in_array($orderbyfields[$i],$truedates) )
				$newfield = "MONTH($newfield)";
			else
				$newfield = "SUBSTRING_INDEX($newfield, ' ', 2)";
			$displaystr .= ", $newfield as monthonly$orderbyfields[$i]";
			$orderbystr .= "monthonly$orderbyfields[$i]";
		}
		else if( $orderbyfields[$i] == "yearonly" ) {
			$i++;
			$newfield = processfield( $orderbyfields[$i] );
			if( isset($orderbyfields[$i]) && in_array($orderbyfields[$i],$truedates) )
				$newfield = "YEAR($newfield)";
			else {
				$newfield = "LPAD(SUBSTRING_INDEX($newfield, ' ', -1),4,'0')";
				$orderbyfields[$i] = "";
			}
			$displaystr .= ", $newfield as yearonly{$orderbyfields[$i]}";
			$orderbystr .= "yearonly{$orderbyfields[$i]}";
		}
		else if( $orderbyfields[$i] == "personID" )
			$orderbystr .= "CAST(SUBSTRING($people_table.personID,2) as UNSIGNED)";
		else if( substr($orderbyfields[$i],0,2) == "ps" ) {
			$orderbystr .= "$children_table." . substr($orderbyfields[$i],1);
			$need_children = 1;
		}
		else
			$orderbystr .= processfield( $orderbyfields[$i] );
	}
	if( $orderbystr )
		$orderbystr = "ORDER BY $orderbystr";
	
	if( $need_families ) {
		$families_join = "LEFT JOIN $families_table AS families1 ON ($people_table.gedcom = families1.gedcom AND $people_table.personID = families1.husband ) LEFT JOIN $families_table AS families2 ON ($people_table.gedcom = families2.gedcom AND $people_table.personID = families2.wife ) ";
		//$families_join = "LEFT JOIN $families_table ON ($people_table.personID = $families_table.husband OR $people_table.personID = $families_table.wife) AND $people_table.gedcom = $families_table.gedcom";
		//if( $familytreestr ) $treestr .= " AND $familytreestr";
	}
	else
		$families_join = "";
	if( $need_children ) {
		$children_join = "LEFT JOIN $children_table ON $people_table.personID = $children_table.personID AND $people_table.gedcom = $children_table.gedcom";
		if( $childrentreestr ) $treestr .= " AND $childrentreestr";
	}
	else
		$children_join = "";
	
	if( $treestr )
		$treestr = $criteriastr ? "AND $treestr" : "WHERE $treestr";
		
	$cejoin = "";
	foreach( $cejoins as $join )
		$cejoin .= " $join";

	$query = "SELECT $displaystr FROM ($people_table $trees_join) $families_join $children_join $cejoin $criteriastr $treestr $orderbystr";
}
//echo $query . " LIMIT $newoffset" . $maxsearchresults;
$limitstr = $csv ? "" : " LIMIT $newoffset" . $maxsearchresults;
$result = @tng_query($query . $limitstr );

$treelogstr = $tree ? " ({$text['tree']}: $tree)" : "";
if($rrow['active'] && !$csv) {
	$logstring = "<a href=\"$showreport_url" . "reportID=$reportID&amp;tree=$tree\">" . xmlcharacters($text['report'] . ": {$rrow['reportname']}$treelogstr") . "</a>";
	writelog($logstring);
	preparebookmark($logstring);
}

if($csv) {
	header("Content-type:text/html;charset=" . $session_charset);
	$truncname = str_replace(" ","-",strtolower($rrow['reportname']));
	header("Content-Disposition: attachment; filename={$truncname}.csv\n\n");
}
else {
	tng_header( $rrow['reportname'], $flags );
?>

	<h1 class="header"><span class="headericon" id="reports-hdr-icon"></span><?php echo "{$text['report']}: {$rrow['reportname']}"; ?></h1>
	<p><span class="normal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $text['description'] . ": " . nl2br($rrow['reportdesc']); ?></span></p><br clear="left"/>

	<?php
	if( $test )
		echo "<p class=\"normal\"><strong>SQL:</strong> $query</p>\n";

	if(!$rrow['sqlselect']) {
		$hiddenfields[] = array('name' => 'reportID', 'value' => $reportID);
		echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'showreport', 'method' => 'get', 'name' => 'form1', 'id' => 'form1', 'hidden' => $hiddenfields));
	}
}

if( !$result ) {
?>

<p class="normal"><?php echo "<b>{$text['error']}:</b> {$text['reportsyntax']} (ID: {$rrow['reportID']}) {$text['wasincorrect']} "; ?>
<?php echo "<a href=\"mailto:$emailaddr\">$emailaddr</a>"; ?>.</p>
<p><?php echo $text['query'] . ": $query <br/>{$text['errormessage']}:"; ?>
<?php echo tng_error(); ?></p>

<?php
}
else {
	if(!$csv) {
		$numrows = tng_num_rows( $result );
		if( $numrows == $maxsearchresults || $offsetplus > 1 ) {
			if( $rrow['sqlselect'] ) {
				if( $gotpersonid )
					$query = "SELECT count( $people_table.personID ) as rcount $from";
				else {
					$result2 = tng_query($query);
					$totrows = tng_num_rows( $result2 );
					$query = "";
				}
			}
			else
				$query = "SELECT count($people_table.personID) as rcount FROM ($people_table $trees_join) $families_join $children_join $cejoin $criteriastr $treestr";
			if( $query ) {
				$result2 = tng_query($query);
				$countrow = tng_fetch_assoc($result2);
				$totrows = $countrow['rcount'];
			}
		}
		else
			$totrows = $numrows;

		$numrowsplus = $numrows + $offset;
		if( $totrows ) {
			$csvlink = !isset($tngconfig['allowcsv']) || !$tngconfig['allowcsv'] ? "&nbsp; <a href=\"{$showreport_url}reportID=$reportID&amp;csv=1&amp;tree=$tree\" target=\"_blank\" class=\"snlink\">&raquo; {$text['csv']}</a>" : "";
			echo "<p>{$text['matches']} $offsetplus {$text['to']} $numrowsplus {$text['of']} $totrows{$csvlink}</p>";
		}

		$pagenav = get_browseitems_nav( $totrows, "$showreport_url" . "reportID=$reportID$testurl&amp;offset", $maxsearchresults, $max_browsesearch_pages );
		echo "<p>$pagenav</p>\n";
	}
	if($csv)
		echo $displaytext . $lineending;
	else {
?>

<table cellpadding="3" cellspacing="1" border="0" class="thfixed whiteback">
   	<thead><tr>
		<th class="fieldnameback"><span class="fieldname">#</span></th>
<?php
	//Column headings print here
	echo $displaytext;
?>
	</tr></thead>
<?php
	}
	$rowcount = $offset;
	$treestr = $tngconfig['places1tree'] ? "" : "tree=$tree&amp;";
	//$savetree = $tree;
	while( $row = tng_fetch_assoc($result)) {
		//if(!$savetree && isset($row['gedcom'])) $tree = $row['gedcom'];
		if(!isset($row['sex'])) $row['sex'] = "";
		$rowcount++;

		$rights = determineLivingPrivateRights($row);
		$row['allow_living'] = $rights['living'];
		$row['allow_private'] = $rights['private'];

		if(!$csv) {
			echo "<tr>\n";
			echo "<td class=\"databack\"><span class=\"normal\">$rowcount</span></td>\n";
		}
		$datastr = "";
		$num_displayfields = count($displayfields) - 1;
		for( $i = 0; $i < $num_displayfields; $i++ ) {
			$thisfield = $displayfields[$i];
			if( $thisfield == "lastfirst" )
				$data = $csv ? getNameRev( $row ) : "<a href=\"$getperson_url" . "personID={$row['personID']}&amp;tree={$row['gedcom']}\">" . getNameRev( $row ) . "</a>";
			else if( $thisfield == "fullname" ) {
				$namestr = getName($row);
				$data = $csv ? $namestr : showSmallPhoto( $row['personID'], $namestr, $rights['both'], 0, false, $row['sex'], $row['gedcom'] ) . "<a href=\"$getperson_url" . "personID={$row['personID']}&amp;tree={$row['gedcom']}\">$namestr</a>";
			}
			else if( strtoupper(substr($thisfield,-8)) == strtoupper("personID") )
				$data = $csv ? $row[$thisfield] : "<a href=\"$getperson_url" . "personID=$row[$thisfield]&amp;tree={$row['gedcom']}\">$row[$thisfield]</a>";
			else if( $thisfield == "treename" )
				$data = $csv ? $row['treename'] : "<a href=\"$showtree_url" . "tree={$row['gedcom']}\">{$row['treename']}</a>";
			else if( substr( $thisfield, 0, 6 ) == "spouse" ) {
				$spouseID = $row['spouse'];
				if( $thisfield == "spousename" ) {
					$query = "SELECT lastname, lnprefix, firstname, prefix, suffix, title, nameorder, gedcom, living, private, branch, birthdate, birthdatetr, altbirthdate, altbirthdatetr, deathdate, deathdatetr FROM $people_table WHERE personID = \"{$spouseID}\" AND gedcom = \"{$row['gedcom']}\"";
					$spresult = tng_query($query);
					if( tng_num_rows($spresult) ) {
						$sprow = tng_fetch_assoc($spresult);

						$srights = determineLivingPrivateRights($sprow);
						$sprow['allow_living'] = $srights['living'];
						$sprow['allow_private'] = $srights['private'];

						$data = $csv ? getName( $sprow ) : "<a href=\"$getperson_url" . "personID=$spouseID&amp;tree={$sprow['gedcom']}\">" . getName( $sprow ) . "</a>";
						tng_free_result($spresult);
					}
					else
						$data = "";
				}
				else
					$data = $csv ? $spouseID : "<a href=\"$getperson_url" . "personID=$spouseID&amp;tree={$sprow['gedcom']}\">$spouseID</a>";
			}
			else if( $rights['both'] && ( !in_array( $thisfield, $ldsfields ) || $rights['lds'] ) ) {
				if( strpos( $thisfield, "date" ) ) {
					$tempdate = isset($row[$thisfield]) ? $row[$thisfield] : "";
					if($tempdate)
						$rawdate = $tempdate;
					else {
						$datedisp = $thisfield . "_disp";
						$rawdate = isset($row[$datedisp]) ? $row[$datedisp] : "";
					}
					$data = displayDate( $rawdate );
				}
				else {
					$data = !is_null($row[$thisfield]) ? nl2br( $row[$thisfield] ) : "";
					if( strpos( $thisfield, "place" ) && $data && !$csv )
						$data .=  " <a href=\"$placesearch_url" . "{$treestr}psearch=" . urlencode($data) . "\"><img src=\"{$cms['tngpath']}img/tng_search_small.gif\" class=\"placeimg\" border=\"0\" alt=\"\" width=\"9\" height=\"9\" /></a>";
				}
			}
			else
				$data = "";
			if($csv)
				$data = str_replace("\"","\"\"",$data);
			$datastr .= $csv ? ($datastr ? ",\"$data\"" : "\"$data\"") : "<td class=\"databack\"><span class=\"normal\">$data&nbsp;</span></td>\n";
		}
		echo $datastr . $lineending;

		if(!$csv)
			echo "</tr>\n";
	}
	tng_free_result($result);
	if(!$csv) {
?>
		</table>
		<br/><br/>
<?php
		echo $pagenav;
		echo "<br /><br />\n";
	}
}

if(!$csv)
	tng_footer( "" );
?>