<?php
$textpart = "search";
include("tng_begin.php");
if(!empty($cms['events'])){include('cmsevents.php'); cms_search();}

$query = "SELECT gedcom, treename FROM $trees_table ORDER BY treename";
$result = tng_query($query);
$numtrees = tng_num_rows($result);

$saved_cust_events = isset($_COOKIE['tng_search_families_post']['cust_events']) ? explode(",",stripslashes($_COOKIE['tng_search_families_post']['cust_events'])) : [];

if( isset($_SESSION['tng_search_ftree']) ) $tree = $_SESSION['tng_search_ftree'];
$flnqualify = isset($_SESSION['tng_search_flnqualify']) ? $_SESSION['tng_search_flnqualify'] : "";
$myflastname = isset($_SESSION['tng_search_flastname']) ? $_SESSION['tng_search_flastname'] : "";
$ffnqualify = isset($_SESSION['tng_search_ffnqualify']) ? $_SESSION['tng_search_ffnqualify'] : "";
$myffirstname = isset($_SESSION['tng_search_ffirstname']) ? $_SESSION['tng_search_ffirstname'] : "";
$mlnqualify = isset($_SESSION['tng_search_mlnqualify']) ? $_SESSION['tng_search_mlnqualify'] : "";
$mymlastname = isset($_SESSION['tng_search_mlastname']) ? $_SESSION['tng_search_mlastname'] : "";
$mfnqualify = isset($_SESSION['tng_search_mfnqualify']) ? $_SESSION['tng_search_mfnqualify'] : "";
$mymfirstname = isset($_SESSION['tng_search_mfirstname']) ? $_SESSION['tng_search_mfirstname'] : "";
$fidqualify = isset($_SESSION['tng_search_fidqualify']) ? $_SESSION['tng_search_fidqualify'] : "";
$myfamilyid = isset($_SESSION['tng_search_familyid']) ? $_SESSION['tng_search_familyid'] : "";
$mpqualify = isset($_SESSION['tng_search_mpqualify']) ? $_SESSION['tng_search_mpqualify'] : "";
$mymarrplace = isset($_SESSION['tng_search_marrplace']) ? $_SESSION['tng_search_marrplace'] : "";
$myqualify = isset($_SESSION['tng_search_myqualify']) ? $_SESSION['tng_search_myqualify'] : "";
$mymarryear = isset($_SESSION['tng_search_marryear']) ? $_SESSION['tng_search_marryear'] : "";
$dvpqualify = isset($_SESSION['tng_search_dvpqualify']) ? $_SESSION['tng_search_dvpqualify'] : "";
$mydivplace = isset($_SESSION['tng_search_divplace']) ? $_SESSION['tng_search_divplace'] : "";
$dvyqualify = isset($_SESSION['tng_search_dvyqualify']) ? $_SESSION['tng_search_dvyqualify'] : "";
$mydivyear = isset($_SESSION['tng_search_divyear']) ? $_SESSION['tng_search_divyear'] : "";
$mymarrtype = isset($_SESSION['tng_search_marrtype']) ? $_SESSION['tng_search_marrtype'] : "";
$mybool = isset($_SESSION['tng_search_fbool']) ? $_SESSION['tng_search_fbool'] : "";
$nr = isset($_SESSION['tng_nr']) ? $_SESSION['tng_nr'] : $maxsearchresults;

$dontdo = array("MARR","DIV");
$famsearch_url = getURL( "famsearch", 1 );

function displayToggle($id,$state,$target,$headline) {
	global $text;

	$rval = "<a href=\"#\" onclick=\"return toggleSection('$target','$id');\" class=\"togglehead\" style=\"color:black\"><div class=\"subhead\"><img src=\"img/" . ($state ? "tng_collapse.gif" : "tng_expand.gif") . "\" title=\"{$text['clickdisplay']}\" alt=\"{$text['clickdisplay']}\" width=\"15\" height=\"15\" border=\"0\" id=\"$id\">";
	$rval .= "<strong class=\"th-indent\">$headline</strong></div></a>\n";

	return $rval;
}

tng_header( $text['searchfams'], $flags );
?>
<script type="text/javascript">
//<![CDATA[
function resetValues() {
<?php if( (!$requirelogin || !$treerestrict || !$assignedtree) && $numtrees > 1 ) echo "	document.famsearch.tree.selectedIndex = 0;"; ?>
	document.famsearch.reset();

	document.famsearch.flnqualify.selectedIndex = 0;
	document.famsearch.ffnqualify.selectedIndex = 0;
	document.famsearch.mlnqualify.selectedIndex = 0;
	document.famsearch.mfnqualify.selectedIndex = 0;
	document.famsearch.mpqualify.selectedIndex = 0;
	document.famsearch.myqualify.selectedIndex = 0;
	document.famsearch.dvpqualify.selectedIndex = 0;
	document.famsearch.dvyqualify.selectedIndex = 0;
	document.famsearch.mybool.selectedIndex = 0;
	document.famsearch.fidqualify.selectedIndex = 0;

	document.famsearch.myflastname.value = "";
	document.famsearch.myffirstname.value = "";
	document.famsearch.mymlastname.value = "";
	document.famsearch.mymfirstname.value = "";
	document.famsearch.mymarrplace.value = "";
	document.famsearch.mymarryear.value = "";
	document.famsearch.mydivplace.value = "";
	document.famsearch.mydivyear.value = "";
	document.famsearch.myfamilyid.value = "";
	document.famsearch.mymarrtype.value = "";
	$('errormsg').style.display = "none";
}

function toggleEvSection( flag ) {
	if( flag ) {
		jQuery('#otherevents').fadeIn(200);
		jQuery('#contract').show();
		jQuery('#expand').hide();
	}
	else {
		jQuery('#otherevents').fadeOut(200);
		jQuery('#expand').show();
		jQuery('#contract').hide();
	}
	return false;
}

function removeEvCookie( item, eventtypeID, type ) {
	var params = {eventtypeID: eventtypeID, type: type};
	jQuery.ajax({
		url: '<?php echo $cms['tngpath']; ?>ajx_remove_event_cookie.php',
		data: params,
		dataType: 'html',
		success: function(req) {
			$(item).hide();
			toggleSection('evt'+eventtypeID,'arr'+eventtypeID);
		}
	})
}

function makeURL() {
	var URL;
	var thisform = document.famsearch;
	var thisfield;
	var found = 0;

	URL = "mybool=" + thisform.mybool[thisform.mybool.selectedIndex].value;
	URL = URL + "&nr=" + thisform.nr[thisform.nr.selectedIndex].value;
<?php
	if( (!$requirelogin || !$treerestrict|| !$assignedtree) && $numtrees > 1 ) {
?>
	URL = URL + "&tree=" + thisform.tree[thisform.tree.selectedIndex].value;
<?php
	}
	$qualifiers = array("fln","ffn","mln","mfn","fid","mp","my","dvp","dvy","mt");
	$criteria = array("flastname","ffirstname","mlastname","mfirstname","familyid","marrplace","marryear","divplace","divyear","marrtype");

	$qcount = 0;
	$found = 0;
	foreach( $criteria as $criterion ) {
?>
		if( thisform.my<?php echo $criterion; ?>.value != "" || thisform.<?php echo $qualifiers[$qcount]; ?>qualify.value == "exists" || thisform.<?php echo $qualifiers[$qcount]; ?>qualify.value == "dnexist" ) {
			URL = URL + "&my<?php echo $criterion; ?>=" + thisform.my<?php echo $criterion; ?>.value;
			URL = URL + "&<?php echo $qualifiers[$qcount]; ?>qualify=" + thisform.<?php echo $qualifiers[$qcount]; ?>qualify[thisform.<?php echo $qualifiers[$qcount]; ?>qualify.selectedIndex].value;
			found++;
		}
<?php
		$qcount++;
	}

	//get eventtypeIDs from $eventtypes_table
	$query = "SELECT eventtypeID, tag FROM $eventtypes_table WHERE keep=\"1\" AND type=\"F\"";
	$etresult = tng_query($query);
	while( $row = tng_fetch_assoc( $etresult ) ) {
		if( !in_array( $row['tag'], $dontdo ) ) {
?>
		if( thisform.cef<?php echo $row['eventtypeID']; ?>.value != "" || thisform.cfq<?php echo $row['eventtypeID']; ?>.value == "exists" || thisform.cfq<?php echo $row['eventtypeID']; ?>.value == "dnexist" ) {
			URL = URL + "&cef<?php echo $row['eventtypeID']; ?>=" + thisform.cef<?php echo $row['eventtypeID']; ?>.value;
			URL = URL + "&cfq<?php echo $row['eventtypeID']; ?>=" + thisform.cfq<?php echo $row['eventtypeID']; ?>[thisform.cfq<?php echo $row['eventtypeID']; ?>.selectedIndex].value;
		}
		if( thisform.cep<?php echo $row['eventtypeID']; ?>.value != "" || thisform.cpq<?php echo $row['eventtypeID']; ?>.value == "exists" || thisform.cpq<?php echo $row['eventtypeID']; ?>.value == "dnexist" ) {
			URL = URL + "&cep<?php echo $row['eventtypeID']; ?>=" + thisform.cep<?php echo $row['eventtypeID']; ?>.value;
			URL = URL + "&cpq<?php echo $row['eventtypeID']; ?>=" + thisform.cpq<?php echo $row['eventtypeID']; ?>[thisform.cpq<?php echo $row['eventtypeID']; ?>.selectedIndex].value;
		}
		if( thisform.cey<?php echo $row['eventtypeID']; ?>.value != "" || thisform.cyq<?php echo $row['eventtypeID']; ?>.value == "exists" || thisform.cyq<?php echo $row['eventtypeID']; ?>.value == "dnexist" ) {
			URL = URL + "&cey<?php echo $row['eventtypeID']; ?>=" + thisform.cey<?php echo $row['eventtypeID']; ?>.value;
			URL = URL + "&cyq<?php echo $row['eventtypeID']; ?>=" + thisform.cyq<?php echo $row['eventtypeID']; ?>[thisform.cyq<?php echo $row['eventtypeID']; ?>.selectedIndex].value;
		}
<?php
		}
	}
	tng_free_result($etresult);
?>
	window.location.href = "<?php echo $famsearch_url; ?>" + URL;
	
	return false;
}
//]]>
</script>

<h1 class="header"><span class="headericon" id="fsearch-hdr-icon"></span><?php echo $text['searchfams'];?></h1><br clear="all" />
<?php
if(!empty($msg))
	echo "<b id=\"errormsg\" class=\"msgerror subhead\">" . stripslashes(strip_tags($msg)) . "</b>";

echo "<div class=\"titlebox\" style=\"overflow:auto\">\n";
$formstr = getFORM( "famsearch", "", "famsearch", "", "$('searchbtn').className='fieldnamebacksave';return makeURL();" );
echo $formstr;
?>
<div class="searchformbox">
	<table cellspacing="1" cellpadding="4" class="normal rounded-table">
		<?php
			if( (!$requirelogin || !$treerestrict || !$assignedtree) && $numtrees > 1 ) {
		?>
		<tr>
			<td class="fieldnameback fieldname"><?php echo $text['tree'];?>:</td>
			<td class="databack">
				<?php echo treeSelect($result); ?>
			</td>
		</tr>
		<?php
		}
		?>
		<tr><td colspan="2"><strong><?php echo $text['fathername']; ?></strong></td></tr>
		<tr>
			<td class="fieldnameback fieldname"><?php echo $text['firstname'];?>:</td>
			<td class="databack">
				<select name="ffnqualify" class="mediumfield">
		<?php
			$item_array = array( array( $text['contains'], "contains" ), array( $text['equals'], "equals" ), array( $text['startswith'], "startswith" ), array( $text['endswith'], "endswith" ), array( $text['exists'], "exists" ), array( $text['dnexist'], "dnexist" ), array( $text['soundexof'], "soundexof" ) );
			foreach( $item_array as $item ) {
			    echo "<option value=\"$item[1]\"";
			    if( $ffnqualify == $item[1] ) echo " selected=\"selected\"";
			    echo ">$item[0]</option>\n";
			}
		?>
				</select>
				<input type="text" name="myffirstname" class="longfield" value="<?php echo $myffirstname; ?>" />
			</td>
		</tr>
		<tr>
			<td class="fieldnameback fieldname"><?php echo $text['lastname'];?>:</td>
			<td class="databack">
				<select name="flnqualify" class="mediumfield">
		<?php
			$item_array = array( array( $text['contains'], "contains" ), array( $text['equals'], "equals" ), array( $text['startswith'], "startswith" ), array( $text['endswith'], "endswith" ), array( $text['exists'], "exists" ), array( $text['dnexist'], "dnexist" ), array( $text['soundexof'], "soundexof" ), array( $text['metaphoneof'], "metaphoneof" ) );
			foreach( $item_array as $item ) {
			    echo "<option value=\"$item[1]\"";
			    if( $flnqualify == $item[1] ) echo " selected=\"selected\"";
			    echo ">$item[0]</option>\n";
			}
		?>
				</select>
				<input type="text" name="myflastname" class="longfield" value="<?php echo $myflastname; ?>" />
			</td>
		</tr>
		<tr><td colspan="2"><strong><?php echo $text['mothername']; ?></strong></td></tr>
		<tr>
			<td class="fieldnameback fieldname"><?php echo $text['firstname'];?>:</td>
			<td class="databack">
				<select name="mfnqualify" class="mediumfield">
		<?php
			$item_array = array( array( $text['contains'], "contains" ), array( $text['equals'], "equals" ), array( $text['startswith'], "startswith" ), array( $text['endswith'], "endswith" ), array( $text['exists'], "exists" ), array( $text['dnexist'], "dnexist" ), array( $text['soundexof'], "soundexof" ) );
			foreach( $item_array as $item ) {
			    echo "<option value=\"$item[1]\"";
			    if( $mfnqualify == $item[1] ) echo " selected=\"selected\"";
			    echo ">$item[0]</option>\n";
			}
		?>
				</select>
				<input type="text" name="mymfirstname" class="longfield" value="<?php echo $mymfirstname; ?>" />
			</td>
		</tr>
		<tr>
			<td class="fieldnameback fieldname"><?php echo $text['lastname'];?>:</td>
			<td class="databack">
				<select name="mlnqualify" class="mediumfield">
		<?php
			$item_array = array( array( $text['contains'], "contains" ), array( $text['equals'], "equals" ), array( $text['startswith'], "startswith" ), array( $text['endswith'], "endswith" ), array( $text['exists'], "exists" ), array( $text['dnexist'], "dnexist" ), array( $text['soundexof'], "soundexof" ), array( $text['metaphoneof'], "metaphoneof" ) );
			foreach( $item_array as $item ) {
			    echo "<option value=\"$item[1]\"";
			    if( $mlnqualify == $item[1] ) echo " selected=\"selected\"";
			    echo ">$item[0]</option>\n";
			}
		?>
				</select>
				<input type="text" name="mymlastname" class="longfield" value="<?php echo $mymlastname; ?>" />
			</td>
		</tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
			<td class="fieldnameback fieldname"><?php echo $text['familyid'];?>:</td>
			<td class="databack">
				<select name="fidqualify" class="mediumfield">
		<?php
			$item_array = array( array( $text['equals'], "equals" ), array( $text['contains'], "contains" ), array( $text['startswith'], "startswith" ), array( $text['endswith'], "endswith" ) );
			foreach( $item_array as $item ) {
			    echo "<option value=\"$item[1]\"";
			    if( $fidqualify == $item[1] ) echo " selected=\"selected\"";
			    echo ">$item[0]</option>\n";
			}
		?>
				</select>
				<input type="text" name="myfamilyid" class="longfield" value="<?php echo $myfamilyid; ?>" />
			</td>
		</tr>
		<tr>
			<td class="fieldnameback fieldname"><?php echo $text['marrplace'];?>:</td>
			<td class="databack">
				<select name="mpqualify" class="mediumfield">
		<?php
			$item_array = array( array( $text['contains'], "contains" ), array( $text['equals'], "equals" ), array( $text['startswith'], "startswith" ), array( $text['endswith'], "endswith" ), array( $text['exists'], "exists" ), array( $text['dnexist'], "dnexist" ) );
			foreach( $item_array as $item ) {
			    echo "<option value=\"$item[1]\"";
			    if( $mpqualify == $item[1] ) echo " selected=\"selected\"";
			    echo ">$item[0]</option>\n";
			}
		?>
				</select>
				<input type="text" name="mymarrplace" class="longfield" value="<?php echo $mymarrplace; ?>" />
			</td>
		</tr>
		<tr>
			<td class="fieldnameback fieldname"><?php echo $text['marrdatetr'];?>:</td>
			<td class="databack">
				<select name="myqualify" class="mediumfield">
		<?php
			$item2_array = array( array( $text['equals'], "" ), array( $text['plusminus2'], "pm2" ), array( $text['plusminus5'], "pm5" ), array( $text['plusminus10'], "pm10" ), array( $text['lessthan'], "lt" ), array( $text['greaterthan'], "gt" ), array( $text['lessthanequal'], "lte" ), array( $text['greaterthanequal'], "gte" ), array( $text['exists'], "exists" ), array( $text['dnexist'], "dnexist" ) );
			foreach( $item2_array as $item ) {
				echo "<option value=\"$item[1]\"";
				if( $myqualify == $item[1] ) echo " selected=\"selected\"";
				echo ">$item[0]</option>\n";
			}
		?>
				</select>
				<input type="text" name="mymarryear" class="longfield" value="<?php echo $mymarryear; ?>" />
			</td>
		</tr>
		<tr>
			<td class="fieldnameback fieldname"><?php echo $text['divplace'];?>:</td>
			<td class="databack">
				<select name="dvpqualify" class="mediumfield">
		<?php
			$item_array = array( array( $text['contains'], "contains" ), array( $text['equals'], "equals" ), array( $text['startswith'], "startswith" ), array( $text['endswith'], "endswith" ), array( $text['exists'], "exists" ), array( $text['dnexist'], "dnexist" ) );
			foreach( $item_array as $item ) {
			    echo "<option value=\"$item[1]\"";
			    if( $dvpqualify == $item[1] ) echo " selected=\"selected\"";
			    echo ">$item[0]</option>\n";
			}
		?>
				</select>
				<input type="text" name="mydivplace" class="longfield" value="<?php echo $mydivplace; ?>" />
			</td>
		</tr>
		<tr>
			<td class="fieldnameback fieldname"><?php echo $text['divdatetr'];?>:</td>
			<td class="databack">
				<select name="dvyqualify" class="mediumfield">
		<?php
			$item2_array = array( array( $text['equals'], "" ), array( $text['plusminus2'], "pm2" ), array( $text['plusminus5'], "pm5" ), array( $text['plusminus10'], "pm10" ), array( $text['lessthan'], "lt" ), array( $text['greaterthan'], "gt" ), array( $text['lessthanequal'], "lte" ), array( $text['greaterthanequal'], "gte" ), array( $text['exists'], "exists" ), array( $text['dnexist'], "dnexist" ) );
			foreach( $item2_array as $item ) {
				echo "<option value=\"$item[1]\"";
				if( $dvyqualify == $item[1] ) echo " selected=\"selected\"";
				echo ">$item[0]</option>\n";
			}
		?>
				</select>
				<input type="text" name="mydivyear" class="longfield" value="<?php echo $mydivyear; ?>" />
			</td>
		</tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
			<td class="fieldnameback fieldname"><?php echo $text['marrtype'];?>:</td>
			<td class="databack">
				<select name="mtqualify" class="mediumfield">
		<?php
			$item_array = array( array( $text['contains'], "contains" ), array( $text['equals'], "equals" ), array( $text['startswith'], "startswith" ), array( $text['endswith'], "endswith" ), array( $text['exists'], "exists" ), array( $text['dnexist'], "dnexist" ) );
			foreach( $item_array as $item ) {
			    echo "<option value=\"$item[1]\"";
			    if( isset($mtqualify) && $mtqualify == $item[1] ) echo " selected=\"selected\"";
			    echo ">$item[0]</option>\n";
			}
		?>
				</select>
				<input type="text" name="mymarrtype" class="longfield" value="<?php echo $mymarrtype; ?>" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="offset" value="0" />

	<br/>
	<span class="subhead"><strong><?php echo $text['otherevents']; ?></strong></span><br/>
	<ul class="normal">
		<li id="expand" class="othersearch"><a href="#" onclick="return toggleEvSection(1);" class="nounderline"><img src="<?php echo $cms['tngpath']; ?>img/tng_expand.gif" alt="" width="15" height="15" border="0" class="exp-cont" /><?php echo $text['clickdisplay']; ?></a></li>
		<li id="contract" class="othersearch" style="display:none;"><a href="#" onclick="return toggleEvSection(0);" class="nounderline"><img src="<?php echo $cms['tngpath']; ?>img/tng_collapse.gif" alt="" width="15" height="15" border="0" class="exp-cont" /><?php echo $text['clickhide']; ?></a></li>
	</ul>
	<div id="otherevents" style="display:none">
	<?php
		$query = "SELECT eventtypeID, tag, display FROM $eventtypes_table WHERE keep=\"1\" AND type=\"F\" ORDER BY display";
		$result = tng_query($query);
		$eventtypes = array();
		while( $row = tng_fetch_assoc( $result ) ) {
			if( !in_array( $row['tag'], $dontdo ) ) {
				$row['displaymsg'] = getEventDisplay( $row['display'] );
				$displaymsg = strtoupper($row['displaymsg']) . "_" . $row['eventtypeID'];
				$eventtypes[$displaymsg] = $row;
			}
		}
		tng_free_result($result);
		ksort($eventtypes);

		$saved_events_output = $reg_events_output = "";
		foreach($eventtypes as $row) {
			if(in_array($row['eventtypeID'], $saved_cust_events)) {
				$displaystr = "";
				$removestr = "{$text['remove']}";
			}
			else {
				$displaystr = " style=\"display:none\"";
				$removestr = "";
			}
			$out = "<div class=\"databack cust-event-block\">\n";
			$out .= "<div class=\"smallest remove-link\" onclick=\"removeEvCookie(this,'{$row['eventtypeID']}','people');\">$removestr</div>\n";
			$out .= displayToggle("arr{$row['eventtypeID']}",0,"evt{$row['eventtypeID']}",$row['displaymsg']);
			$out .= "<div id=\"evt{$row['eventtypeID']}\"{$displaystr}><br/>\n";
			$out .= "<table>\n";
			$out .= "<tr>\n";
			$out .= "<td style=\"padding-right:25px\"><span class=\"normal\">&nbsp;&nbsp;&nbsp;{$text['fact']}:</span></td>\n";
			$out .= "<td>\n";
			$out .= "<select name=\"cfq{$row['eventtypeID']}\" class=\"mediumfield\">\n";
			foreach( $item_array as $item ) {
			    $out .= "<option value=\"$item[1]\"";
			    $out .= ">$item[0]</option>\n";
			}
			$out .= "</select>\n";
			$out .= "</td>\n";
			$out .= "<td><input type=\"text\" name=\"cef{$row['eventtypeID']}\" class=\"longfield\" value=\"\" /></td>\n";
			$out .= "</tr>\n";

			$out .= "<tr>\n";
			$out .= "<td><span class=\"normal\">&nbsp;&nbsp;&nbsp;{$text['place']}:</span></td>\n";
			$out .= "<td>\n";
			$out .= "<select name=\"cpq{$row['eventtypeID']}\" class=\"mediumfield\">\n";
			foreach( $item_array as $item ) {
			    $out .= "<option value=\"$item[1]\"";
			    $out .= ">$item[0]</option>\n";
			}
			$out .= "</select>\n";
			$out .= "</td>\n";
			$out .= "<td><input type=\"text\" name=\"cep{$row['eventtypeID']}\" class=\"longfield\" value=\"\" /></td>\n";
			$out .= "</tr>\n";

			$out .= "<tr>\n";
			$out .= "<td><span class=\"normal\">&nbsp;&nbsp;&nbsp;{$text['year']}:</span></td>\n";
			$out .= "<td>\n";
			$out .= "<select name=\"cyq{$row['eventtypeID']}\" class=\"mediumfield\">\n";

			$item2_array = array( array( $text['equals'], "" ), array( $text['plusminus2'], "pm2" ), array( $text['plusminus5'], "pm5" ), array( $text['plusminus10'], "pm10" ), array( $text['lessthan'], "lt" ), array( $text['greaterthan'], "gt" ), array( $text['lessthanequal'], "lte" ), array( $text['greaterthanequal'], "gte" ), array( $text['exists'], "exists" ), array( $text['dnexist'], "dnexist" ) );
			foreach( $item2_array as $item ) {
				$out .= "<option value=\"$item[1]\"";
				$out .= ">$item[0]</option>\n";
			}

			$out .= "</select>\n";
			$out .= "</td>\n";
			//eval( "\$cey = \$cey$row[eventtypeID] = \$_SESSION[tng_search_cey$row[eventtypeID]];" );
			$out .= "<td><input type=\"text\" name=\"cey{$row['eventtypeID']}\" class=\"longfield\" value=\"\" /></td>\n";
			$out .= "</tr>\n";
			$out .= "</table>\n";
			$out .= "</div>\n</div>\n";
			if(in_array($row['eventtypeID'], $saved_cust_events))
				$saved_events_output .= $out;
			else
				$reg_events_output .= $out;
	 	}
	 	if(!empty($saved_events_output)) {
		 	echo $saved_events_output . "<br/>";
	 	}
		echo $reg_events_output;
	?>
		<br/>
	</div>
</div>

<div class="searchsidebar">
	<table>
		<tr>
			<td><span class="normal"><?php echo $text['joinwith'];?>:</span></td>
			<td>
				<select name="mybool">
		<?php
			$item3_array = array( array( $text['cap_and'], "AND" ), array( $text['cap_or'], "OR" ) );
			foreach( $item3_array as $item ) {
				echo "<option value=\"$item[1]\"";
				if( $mybool == $item[1] ) echo " selected=\"selected\"";
				echo ">$item[0]</option>\n";
			}
		?>
				</select>
			</td>
		</tr>
		<tr>
			<td><span class="normal"><?php echo $text['numresults'];?>:</span></td>
			<td>
				<select name="nr">
		<?php
			$item3_array = array( array(50,50), array(100,100), array(150,150), array(200,200) );
			foreach( $item3_array as $item ) {
				echo "<option value=\"$item[1]\"";
				if( $nr == $item[1] ) echo " selected=\"selected\"";
				echo ">$item[0]</option>\n";
			}
		?>
				</select>
			</td>
		</tr>
	</table>
	<input type="submit" id="searchbtn" class="btn" value="<?php echo $text['search'];?>" />
	<input type="button" id="resetbtn" class="btn" value="<?php echo $text['tng_reset'];?>" onclick="resetValues();" />
	</p>
	<br /><br />
	<p>
		<a href="<?php echo $cms['tngpath']; ?>searchform.php" class="snlink">&raquo; <?php echo $text['searchnames']; ?></a><br/>
		<a href="<?php echo $cms['tngpath']; ?>searchsite.php" class="snlink">&raquo; <?php echo $text['searchsitemenu']; ?></a>
	</p>
</div>

</form>
<br clear="all"/>
</div>
<?php
tng_footer( "" );
?>