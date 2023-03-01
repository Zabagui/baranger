<?php


$textpartOSM = "heatmap";
global $textpartOSM;


// ***************************
// ***************************
// ***************************
//
// This first part is TNG original code
//
// ***************************
// ***************************
// ***************************


$textpart = "search";
$order = "";
$needMap = true;
include("tng_begin.php");

include("osm_settings.php");

include($cms['tngpath'] . "searchlib.php");
$placesearch_url = getURL( "placesearch", 1 );
$getperson_url = getURL( "getperson", 1 );

$heatmap = $mtype == "h" || !isset($mtype);
$markermap = $mtype == "m" || !isset($mtype);

tng_query_noerror(" SET OPTION SQL_BIG_SELECTS = 1 " );

if($tree) {
	$query = "SELECT treename FROM $trees_table WHERE gedcom = \"$tree\"";
	$treeresult = tng_query($query);
	$treerow = tng_fetch_assoc($treeresult);
	tng_free_result($treeresult);
}

function buildCriteria( $column, $colvar, $qualifyvar, $qualifier, $value, $textstr ) {
	global $allwhere, $lnprefixes, $criteria_limit, $criteria_count;

	if( $qualifier == "exists" || $qualifier == "dnexist" )
		$value = $usevalue = "";
	else {
		$value = urldecode(trim($value));
		$usevalue = addslashes( $value );
	}

	if( $column == "p.lastname" && $lnprefixes )
		$column = "TRIM(CONCAT_WS(' ',p.lnprefix,p.lastname))";
	elseif( $column == "spouse.lastname" )
		$column = "TRIM(CONCAT_WS(' ',spouse.lnprefix,spouse.lastname))";

	$criteria_count++;
	if($criteria_count >= $criteria_limit)
		die("sorry");
	$criteria = "";
	$returnarray = buildColumn( $qualifier, $column, $usevalue );
	$criteria .= $returnarray['criteria'];
	$qualifystr = $returnarray['qualifystr'];

	addtoQuery( $textstr, $colvar, $criteria, $qualifyvar, $qualifier, $qualifystr, $value );
}

@set_time_limit(0);
if(!isset($mybool)) $mybool = "AND";

if($psearch) {
	$query = "SELECT place, placelevel, latitude, longitude, notes FROM $places_table WHERE place LIKE \"%$psearch%\" AND latitude != \"\" AND longitude != \"\"";
	$querystring = $text['text_for'] . " " . $text['place'] . " " . $text['contains'] . " " . $psearch;
	if($tree && !$tngconfig['places1tree']) {
		$query .= " AND gedcom = \"$tree\"";
		$querystring .= " {$text['cap_and']} " . $text['tree'] . " {$text['equals']} {$treerow['treename']}";
	}
	$headline = $text['placelist'] . " | " . $text['heatmap'];
}
elseif($firstchar) {
	$query = "SELECT place, placelevel, latitude, longitude, notes FROM $places_table WHERE place LIKE \"$firstchar%\" AND latitude != \"\" AND longitude != \"\"";
	$querystring = $text['text_for'] . " " . $text['place'] . " " . $text['startswith'] . " " . $firstchar;
	if($tree && !$tngconfig['places1tree']) {
		$query .= " AND gedcom = \"$tree\"";
		$querystring .= " {$text['cap_and']} " . $text['tree'] . " {$text['equals']} {$treerow['treename']}";
	}
	$headline = $text['placelist'] . " | " . $text['heatmap'];
}
elseif($mylastname || $myfirstname || $mypersonid || $mybirthplace || $mybirthyear || $myaltbirthplace || $mydeathplace || $mydeathyear || $myburialplace || $myburialyear || $mygender || $branch) {
	$mylastname = trim(stripslashes($mylastname));
	$myfirstname = trim(stripslashes($myfirstname));
	$mypersonid = trim(stripslashes($mypersonid));
	$mybirthplace = trim(stripslashes($mybirthplace));
	$mybirthyear = trim(stripslashes($mybirthyear));
	$myaltbirthplace = trim(stripslashes($myaltbirthplace));
	$myaltbirthyear = trim(stripslashes($myaltbirthyear));
	$mydeathplace = trim(stripslashes($mydeathplace));
	$mydeathyear = trim(stripslashes($mydeathyear));
	$myburialplace = trim(stripslashes($myburialplace));
	$myburialyear = trim(stripslashes($myburialyear));

	$_SERVER['QUERY_STRING'] = str_replace(array('&amp;', '&'), array('&', '&amp;'), $_SERVER['QUERY_STRING']);
	$currargs = $orderloc > 0 ? substr($_SERVER['QUERY_STRING'],0,$orderloc) : $_SERVER['QUERY_STRING'];
	$mybooltext = $mybool == "AND" ? $text['cap_and'] : $text['cap_or'];

	$querystring = "";
	$allwhere = "";

	if( $mylastname || $lnqualify == "exists" || $lnqualify == "dnexist" )  {
		if( $mylastname == $text['nosurname'] )
			addtoQuery( $text['lastname'], "mylastname", "lastname = \"\"", "lnqualify", $text['equals'], $text['equals'], $mylastname );
		else {
			buildCriteria( "p.lastname", "mylastname", "lnqualify", $lnqualify, $mylastname, $text['lastname'] );
		}
	}
	if( $myfirstname || $fnqualify == "exists" || $fnqualify == "dnexist" ) {
		buildCriteria( "p.firstname", "myfirstname", "fnqualify", $fnqualify, $myfirstname, $text['firstname'] );
	}
	if( $mypersonid ) {
		$mypersonid = strtoupper($mypersonid);
		if($idqualify == "equals" && is_numeric($mypersonid)) $mypersonid = $personprefix . $mypersonid . $personsuffix;
		buildCriteria( "p.personID", "mypersonid", "idqualify", $idqualify, $mypersonid, $text['personid'] );
	}
	if( $mytitle || $tqualify == "exists" || $tqualify == "dnexist" ) {
		buildCriteria( "p.title", "mytitle", "tqualify", $tqualify, $mytitle, $text['title'] );
	}
	if( $myprefix || $pfqualify == "exists" || $pfqualify == "dnexist" ) {
		buildCriteria( "p.prefix", "myprefix", "pfqualify", $pfqualify, $myprefix, $text['prefix'] );
	}
	if( $mysuffix || $sfqualify == "exists" || $sfqualify == "dnexist" ) {
		buildCriteria( "p.suffix", "mysuffix", "sfqualify", $sfqualify, $mysuffix, $text['suffix'] );
	}
	if( $mynickname || $nnqualify == "exists" || $nnqualify == "dnexist" ) {
		buildCriteria( "p.nickname", "mynickname", "nnqualify", $nnqualify, $mynickname, $text['nickname'] );
	}
	if( $mybirthplace || $bpqualify == "exists" || $bpqualify == "dnexist" ) {
		buildCriteria( "p.birthplace", "mybirthplace", "bpqualify", $bpqualify, $mybirthplace, $text['birthplace'] );
	}
	if( $mybirthyear || $byqualify == "exists" || $byqualify == "dnexist" ) {
		buildYearCriteria( "p.birthdatetr", "mybirthyear", "byqualify", "p.altbirthdatetr", $byqualify, $mybirthyear, $text['birthdatetr'] );
	}
	if( $myaltbirthplace || $cpqualify == "exists" || $cpqualify == "dnexist" ) {
		buildCriteria( "p.altbirthplace", "myaltbirthplace", "cpqualify", $cpqualify, $myaltbirthplace, $text['altbirthplace'] );
	}
	if( $myaltbirthyear || $cyqualify == "exists" || $cyqualify == "dnexist" ) {
		buildYearCriteria( "p.altbirthdatetr", "myaltbirthyear", "cyqualify", "", $cyqualify, $myaltbirthyear, $text['altbirthdatetr'] );
	}
	if( $mydeathplace || $dpqualify == "exists" || $dpqualify == "dnexist" ) {
		buildCriteria( "p.deathplace", "mydeathplace", "dpqualify", $dpqualify, $mydeathplace, $text['deathplace'] );
	}
	if( $mydeathyear || $dyqualify == "exists" || $dyqualify == "dnexist" ) {
		buildYearCriteria( "p.deathdatetr", "mydeathyear", "dyqualify", "p.burialdatetr", $dyqualify, $mydeathyear, $text['deathdatetr'] );
	}
	if( $myburialplace || $brpqualify == "exists" || $brpqualify == "dnexist" ) {
		buildCriteria( "p.burialplace", "myburialplace", "brpqualify", $brpqualify, $myburialplace, $text['burialplace'] );
	}
	if( $myburialyear || $bryqualify == "exists" || $bryqualify == "dnexist" ) {
		buildYearCriteria( "p.burialdatetr", "myburialyear", "bryqualify", "", $bryqualify, $myburialyear, $text['burialdatetr'] );
	}
	if( $mygender ) {
		if($mygender == "N") $mygender = "";
		buildCriteria( "p.sex", "mygender", "gequalify", $gequalify, $mygender, $text['gender'] );
	}

	if( $tree ) {
		if( $urlstring )
			$urlstring .= "&amp;";
		$urlstring .= "tree=$tree";

		if( $querystring )
			$querystring .= " {$text['cap_and']} ";

		$querystring .= $text['tree'] . " {$text['equals']} {$treerow['treename']}";

		if( $allwhere ) $allwhere = "($allwhere) AND";
		$allwhere .= " p.gedcom=\"$tree\"";

		if($branch) {
			$urlstring .= "&amp;branch=$branch";
			$querystring .= " {$text['cap_and']} ";

			$query = "SELECT description FROM $branches_table WHERE gedcom = \"$tree\" AND branch = \"$branch\"";
			$branchresult = tng_query($query);
			$branchrow = tng_fetch_assoc($branchresult);
			tng_free_result($branchresult);

			$querystring .= $text['branch'] . " {$text['equals']} {$branchrow['description']}";

			$allwhere .= " AND p.branch like \"%$branch%\"";
		}
	}

	$gotInput = $mytitle || $myprefix || $mysuffix || $mynickname || $mybirthplace || $mydeathplace || $mybirthyear || $mydeathyear || $ecount;
	$more = getLivingPrivateRestrictions("p", $myfirstname, $gotInput);

	if($more) {
		if($allwhere)
			$allwhere = $tree ? "$allwhere AND " : "($allwhere) AND ";
		$allwhere .= $more;
	}

	$on1 = " ON birthplace = place ";
	$on2 = " ON altbirthplace = place ";

	if( $allwhere ) {
		$allwhere = " WHERE " . $allwhere . " AND latitude != \"\" AND longitude != \"\"";
		$querystring = $text['text_for'] . " $querystring";
	}
	else
		$allwhere = " WHERE latitude != \"\" AND longitude != \"\"";

	$query = "SELECT place, placelevel, latitude, longitude";
	if($markermap)
		$query .= ", p.ID, personID, lastname, lnprefix, firstname, living, private, branch, nickname, prefix, suffix, nameorder, title,
			IF(birthplace, birthplace, altbirthplace) as birthp, birthdate, altbirthdate, p.gedcom ";
	$query .= "FROM $people_table AS p INNER JOIN $places_table";

	$query = $query . $on1 . $allwhere . " UNION " . $query . $on2 . $allwhere;
	if($markermap)
		$query .= " ORDER BY lastname, firstname";
	$headline = $text['searchresults'] . " | " . $text['heatmap'];
}
else {
	$query = "SELECT place, placelevel, latitude, longitude, notes FROM $places_table WHERE latitude != \"\" AND longitude != \"\"";
	if($tree && !$tngconfig['places1tree']) {
		$query .= " AND gedcom = \"$tree\"";
		$querystring = $text['text_for'] . " " . $text['tree'] . " {$text['equals']} {$treerow['treename']}";
	}
	$headline = $text['placelist'] . " | " . $text['heatmap'];
	$querystr = "";
}

//echo $query;

$result = tng_query_noerror($query);
$numrows = tng_num_rows( $result );

//pretty much like search, but we're skipping the custom events to begin with
//goal is to end up with a list of places matching the birth places of all the people returned in this search (not just the current page)
//places must have lat & long data and associated person (name)
//we'll then construct a large JS object to feed into the code below

if( $isConnected) {

// ***** The below string is modified for OSM
// The hard-coded style: is it needed? But it's in the example

	$flags['scripting'] .= "<script type=\"text/javascript\" src=\"{$cmd['tngpath']}js/ol.js\"></script>\n<link rel=\"stylesheet\" href=\"css/ol.css\" type=\"text/css\"/>\n";
	$flags['scripting'] .= "<!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
<script src=\"https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL\"></script>
<style>
      #map {
        position: relative;
      }
      #info {
        position: absolute;
        height: 1px;
        width: 1px;
        z-index: 100;
      }
      .tooltip.in {
        opacity: 1;
      }
      .tooltip.top .tooltip-arrow {
        border-top-color: white;
      }
      .tooltip-inner {
        border: 2px solid white;
      }
</style>
";

}
// is connected?

tng_header( $headline, $flags );
?>
<h1 class="header"><span class="headericon" id="search-hdr-icon"></span><?php echo $headline; ?></h1><br clear="left"/>
<?php
$logstring = "<a href=\"" . $_SERVER['REQUEST_URI'] . "\">" . xmlcharacters($headline . " $querystring") . "</a>";
writelog($logstring);
preparebookmark($logstring);

echo "<p class=\"normal\">{$text['places']} $querystring (" . number_format($numrows) . ")</p>";

$uniquePlaces = array();
while( $row = tng_fetch_assoc($result))
{
	$key = $row['latitude'] . "_" . $row['longitude'];
	if(!isset($uniquePlaces[$key])) {
		$item = new stdClass();
		$item->latitude = $row['latitude'];
		$item->longitude = $row['longitude'];
		$item->place = $row['place'];
		$item->placelevel = $row['placelevel'];
		$item->notes = isset($row['notes']) ? $row['notes'] : "";
		$item->people = array();

		$uniquePlaces[$key] = $item;
	}
	if(isset($row['personID'])) {
		$person = new stdClass();
		$rights = determineLivingPrivateRights($row);
		$row['allow_living'] = $rights['living'];
		$row['allow_private'] = $rights['private'];
		//determine rights?
		$person->name = "<a href='{$getperson_url}personID={$row['personID']}&tree={$row['gedcom']}'>" . getName($row) . "</a>";
		if( $rights['both'] ) {
			$person->birthplace = $row['birthp'];
//			$person->birthdate = $row['birthdate'] ? $text['birthabbr'] . " " . displayDate($row['birthdate']) : $text['chrabbr'] . " " . displayDate($row['altbirthdate']);
			$person->birthdate = $row['birthdate'] ? $text['birthabbr'] . " " . displayDate($row['birthdate']) : $person->birthdate = $row['altbirthdate'] ? $text['chrabbr'] . " " . displayDate($row['altbirthdate']) : "";
		}
		$uniquePlaces[$key]->people[] = $person;
	}
}

$index = 0;
$heatOutput = $markerOutput = "";



// ***************************
// ***************************
// ***************************
//
// Above is TNG original code
//
// Below is the OSM mod code
//
// ***************************
// ***************************
// ***************************


// The OSM code reads the array $uniquePlaces[] and creates places (points), markers and clusters from that data.
// As I'm only familar w/ the .kml format, I create such a string to be read by the heatmap- and vector-layers


// The .kml file "sometimes" contains characters that are not accepted.
// So far I've found these:
function cleanInput($inpstr) {
	global $charset;
	$inpstr = str_replace(chr(13).chr(10), " ", $inpstr);
	$inpstr = str_replace(chr(13), "", $inpstr);
	$inpstr = str_replace(chr(10), " ", $inpstr);
	$inpstr = html_entity_decode($inpstr, ENT_COMPAT | ENT_HTML401, $charset);
	$inpstr = str_replace("\"", "'", $inpstr);
	return $inpstr;
}


$outstr = ""; // Will become the .kml string
$idcnt = 0; // Index for building the .kml places ids

$minLat = 500; // To find center and zoom
$maxLat = -500;
$minLong = 500;
$maxLong = -500;


// Search for place?
if ($psearch != "") {
	$searchout = $psearch;
} else {
	$searchout = "Different places";
}

// Build the .kml string


$outstr .= "<?xml version='1.0' encoding='UTF-8'?><kml xmlns='http://earth.google.com/kml/2.0' xmlns:atom='http://www.w3.org/2005/Atom'><Document><name>Heatmap for ".$searchout."</name><atom:author><atom:name>XerxX OpenStreetMap mod</atom:name></atom:author><atom:link href='https://xerxx.se/modSupport/index.php?mod=22'/><Folder><name>".$searchout."</name>";


foreach($uniquePlaces as $place) {

	// Fetch all places' Latidude, Longitude, Name, People and Notes and create the .kml string

	$people = "";
	if($heatmap) {
		foreach($place->people as $person) {
			if($people) $people .= ",";

			if($session_charset != "UTF-8") {
				$person->name = utf8_encode($person->name);
				$birthplace = utf8_encode($person->birthplace);
				$birthdate = utf8_encode($person->birthdate);
			}

			$name = trim($person->name);
			if(!$name) $name = "";

			$birthplace = trim($person->birthplace);
			if(!$birthplace) $birthplace = "";

			$birthdate = trim($person->birthdate);
			if(!$birthdate) $birthdate = "";

			$people .= "***P***";
			if ($birthdate) {
				$people .= "N**L*b*G*".$name."*L**S*b*G* (".$birthdate.")";
			} else {
				$people .= "N**L*b*G*".$name."*L**S*b*G*";
			}
		}
//		$heatOutput .= "new google.maps.LatLng({$place->latitude}, {$place->longitude})";
	}
	if($session_charset != "UTF-8") {
		$thisplace = utf8_encode(trim($place->place));
		$notes = utf8_encode(trim($place->notes));
		$latitude = utf8_encode($place->latitude);
		$longitude = utf8_encode($place->longitude);
	}
	else {
		$thisplace = trim($place->place);
		$notes = trim($place->notes);
	}


	$osmLat = $place->latitude;
	$osmLong = $place->longitude;
	$osmName = "*L*b*G*" . cleanInput($thisplace) . "*L**S*b*G*";
	$osmPLevel = $place->placelevel;
	if ($osmPLevel > 0) $osmName = str_replace("/", "*S*", cleanInput($admtext['level'.$osmPLevel])) . "*L*br *S**G*".$osmName;
	$osmNote = $notes;
	if ($osmNote) {
		$osmNote = str_replace("<", "*L*", $osmNote);
		$osmNote = str_replace(">", "*G*", $osmNote);
		$osmNote = str_replace("/", "*S*", $osmNote);
		$osmNote = str_replace("\"", "*Q*", $osmNote);
		$osmNote = str_replace("'", "*p*", $osmNote);
		$osmNote = str_replace("?", "*F*", $osmNote);
		$osmNote = str_replace("&", "*O*", $osmNote);
		$osmNote = str_replace("a href=", "*A*", $osmNote);
		$osmNote = cleanInput($osmNote);
		// We have to concatenate Notes (actually anything?) to the Name as "note" is not a recognised kml-tag?
		$osmName .= "*L*br *S**G*".$text['notes'].": " .$osmNote;
	}
	if ($people) {
		$people = str_replace("<", "*L*", $people);
		$people = str_replace(">", "*G*", $people);
		$people = str_replace("/", "*S*", $people);
		$people = str_replace("\"", "*Q*", $people);
		$people = str_replace("'", "*p*", $people);
		$people = str_replace("?", "*F*", $people);
		$people = str_replace("&", "*O*", $people);
		$people = str_replace("a href=", "*A*", $people);
		$osmPeople = cleanInput($people);
		$osmName .= "*L*br*S**G*" . $osmPeople;
	}

	$idcnt ++;
	if ($osmLat > $maxLat) $maxLat = $osmLat;
	if ($osmLong > $maxLong) $maxLong = $osmLong;
	if ($osmLat < $minLat) $minLat = $osmLat;
	if ($osmLong < $minLong) $minLong = $osmLong;
	$outstr .= "<Placemark id='pl".$idcnt."'><name>".$osmName."</name><magnitude>6</magnitude><Point><coordinates>".$osmLong.", ".$osmLat."</coordinates></Point></Placemark>";
}
$outstr .= "</Folder></Document></kml>";

// Calculate map distances W - E and N - S
$revertLong = false;
if ($maxLong > 0 && $minLong < 0 && $maxLong - $minLong > 180) { $minLong += 360; $revertLong = true; }
$distLong = abs($maxLong - $minLong);
$distLat = abs($maxLat - $minLat);

// Calculate map center
$centLat = $minLat + (($maxLat - $minLat)/2);
$centLong = $minLong + (($maxLong - $minLong)/2);

// Initiate the map <div> and the JavaScript section
?>

<div style="position:relative; top:0px; left:0px;">
<div id='map' class='map' style='width:100%; height:500px;'></div>
<div id='infodiv' style='position:absolute; top:0px; left:0px; background-color:white; display:none; border:1px solid #ccc; padding:8px; z-index:100;' class='mapballoon normal'></div>
</div>

<script type='text/JavaScript'>

var mapLoaded = false;

// Compute the initial zoom
var scrnWidth = document.getElementById("map").scrollWidth;
var scrnHeight = document.getElementById("map").scrollHeight;

var degWidth = <?php echo $distLong; ?>;
var degHeight = <?php echo $distLat; ?>;

var zoom = 0;

var zoom1 = 1;
if (degWidth > 128) {
	zoom1 = 2;
} else if (degWidth > 64) {
	zoom1 = 3;
} else if (degWidth > 32) {
	zoom1 = 4;
} else if (degWidth > 16) {
	zoom1 = 5;
} else if (degWidth > 8) {
	zoom1 = 6;
} else if (degWidth > 4) {
	zoom1 = 7;
} else if (degWidth > 2) {
	zoom1 = 8;
} else if (degWidth > 1) {
	zoom1 = 9;
} else if (degWidth > 0.5) {
	zoom1 = 10;
} else if (degWidth > 0.25) {
	zoom1 = 11;
} else if (degWidth > 0.125) {
	zoom1 = 12;
} else if (degWidth > 0.0625) {
	zoom1 = 13;
} else if (degWidth > 0.03125) {
	zoom1 = 14;
} else if (degWidth > 0.015625) {
	zoom1 = 15;
} else {
	zoom1 = 16;
}

var zoom2 = 1;
if (degHeight > 64) {
	zoom2 = 1;
} else if (degHeight > 52) {
	zoom2 = 1;
} else if (degHeight > 26) {
	zoom2 = 2;
} else if (degHeight > 13) {
	zoom2 = 3;
} else if (degHeight > 6.5) {
	zoom2 = 4;
} else if (degHeight > 3.25) {
	zoom2 = 5;
} else if (degHeight > 1.625) {
	zoom2 = 6;
} else if (degHeight > 0.8125) {
	zoom2 = 7;
} else if (degHeight > 0.40625) {
	zoom2 = 8;
} else if (degHeight > 0.203125) {
	zoom2 = 9;
} else if (degHeight > 0.1015625) {
	zoom2 = 10;
} else if (degHeight > 0.05078125) {
	zoom2 = 11;
} else if (degHeight > 0.025390625) {
	zoom2 = 12;
} else if (degHeight > 0.0126953125) {
	zoom2 = 13;
} else if (degHeight > 0.00634765625) {
	zoom2 = 14;
} else {
	zoom2 = 15;
}
zoom = zoom2;
if (zoom1 < zoom2) zoom = zoom1;
if (<?php echo $distLat; ?> == 0 && <?php echo $distLong; ?> == 0) zoom = 2;


var kml_string = "<?php echo $outstr; ?>";

var myEvent = ""; // Makes the selected event (click, dblclick etc) readable in my functions
var myZoomflag = false; // Prevents multiple zooms when clicking cluster


// ***************************
// ***************************
// ***************************
//
// Above is OSM mod code
//
// Below is the OpenLayers example code
//
// ***************************
// ***************************
// ***************************


// Detta är en MM Edit option!
	var mapsrc = "<?php echo $mapsrc; ?>";

	var srcurl = "";
	var srcatt = "";

<?php include "osmmapswitch.js"; ?>



// This is the scale/ruler in lower left corner
var scaleLineControl = new ol.control.ScaleLine();
scaleLineControl.setUnits("<?php echo $scaleunits; ?>");

<?php

if ($glowingmap) {

?>

// This is the "glowing" heat layer.
// It took some time but I finally made it... I think ;-)

var heatLayer = new ol.layer.Heatmap({
	source: new ol.source.Vector({
		features: (new ol.format.KML({extractStyles: false})).readFeatures(kml_string, {
			defaultDataProjection: 'EPSG:4326',
			featureProjection:'EPSG:3857'
		})
	}),
	blur: 5,
	radius: 6,
//	gradient: ['#808','#f0f', '#008', '#00f', '#0ff', '#0f0', '#ff0', '#f00', '#fff']
	gradient: ['#808', '#00f', '#f00', '#f00', '#ff0', '#fff']
});

<?php

}

?>

// The code below is only slightly modified from this example:
// https://openlayers.org/en/latest/examples/earthquake-clusters.html

var textFill = new ol.style.Fill({
	color: '#000'
});

var textStroke = new ol.style.Stroke({
	color: 'rgba(0, 0, 0, 0.6)',
	width: 0
});

var invisibleFill = new ol.style.Fill({
	color: 'rgba(255, 255, 255, 0.01)'
});

function createEarthquakeStyle(feature) {
	// 2012_Earthquakes_Mag5.kml stores the magnitude of each earthquake in a
	// standards-violating <magnitude> tag in each Placemark.  We extract it
	// from the Placemark's name instead.

	//var name = feature.get('name');
	// I have a NAME in the name tag.
	var radius = 15; // We have no magnitude so I set the radius here. 15 seems to be a good number..?

	return new ol.style.Style({
		geometry: feature.getGeometry(),
		image: new ol.style.Icon({
			anchor: [0.5, 1],
			src: 'img/osmpin.png'
		})
	});
}

var maxFeatureCount, vector;

function calculateClusterInfo(resolution) {
	maxFeatureCount = 0;
	var features = vector.getSource().getFeatures();
	var feature, radius;
	for (var i = features.length - 1; i >= 0; --i) {
		feature = features[i];
		var originalFeatures = feature.get('features');
		var extent = ol.extent.createEmpty();
		var j, jj;
		for (j = 0, jj = originalFeatures.length; j < jj; ++j) {
			ol.extent.extend(extent, originalFeatures[j].getGeometry().getExtent());
		}
		maxFeatureCount = Math.max(maxFeatureCount, jj);
		radius = 20 + (0.25 * (ol.extent.getWidth(extent) + ol.extent.getHeight(extent)) / resolution);
		// The number 20 was 6 before but the icon didn't cover all points and it looks strange. You click on one and it disappears...
		feature.set('radius', radius);
	}
}

var currentResolution;

function styleFunction(feature, resolution) {
	if (resolution != currentResolution) {
		calculateClusterInfo(resolution);
		currentResolution = resolution;
	}
	var style;
	var size = feature.get('features').length;
	if (size > 1) {
		style = new ol.style.Style({
			image: new ol.style.Circle({
				radius: feature.get('radius'),
				fill: new ol.style.Fill({
					color: [255, 153, 0, Math.min(0.8, 0.4 + (size / maxFeatureCount))]
				})
			}),
			text: new ol.style.Text({
				text: size.toString(),
				fill: textFill,
				stroke: textStroke
			})
		});
	} else {
		var originalFeature = feature.get('features')[0];
		style = createEarthquakeStyle(originalFeature);
	}
	return style;
}

function clickZoomFunction(feature, dummy) {
	if (myEvent.type !== 'singleclick') return;
	if (!myZoomflag) return; // Prevents re-zoom...
	myZoomflag = false;

	var myFeature, name, style;
        var size = feature.get('features').length;
	if (size == 1) {
		myFeature = feature.get('features')[0];
//		id = myFeature.getId();
		name = myFeature.get('name'); // The Name includes the NOTE!
		name = name.replace(/\*A\*/g, "a href=");
		name = name.replace(/\*O\*/g, "&");
		name = name.replace(/\*F\*/g, "?");
		name = name.replace(/\*p\*/g, "'");
		name = name.replace(/\*Q\*/g, "&quot;");
		name = name.replace(/\*S\*/g, "/");
		name = name.replace(/\*G\*/g, "\>");
		name = name.replace(/\*L\*/g, "\<");
		name = name.replace(/\*\*\*P\*\*\*/g, "<br />");
		name = name.replace(/\N\*/g, "");

		d = document.getElementById('infodiv');
		x = myEvent.pixel[1];
		y = myEvent.pixel[0];
		d.innerHTML = "<div style='position:absolute; top:0px; right:0px; z-index:101; font-size:16px; padding:4px; cursor:pointer; line-height:12px' onclick=\"document.getElementById('infodiv').style.display='none';\"><b>x&nbsp;</b></div>" + name;
		d.style.top = x + "px";
		d.style.left = y + "px";
		d.style.display = "block";
		myEvent.preventDefault();
		return;
	}
	zoom = map.getView().getZoom();
	var lonlat = ol.proj.transform(myEvent.coordinate, 'EPSG:3857', 'EPSG:4326');
       	var location = ol.proj.fromLonLat([lonlat[0], lonlat[1]])
        doClickZoom(location, function() {});
}

function doClickZoom(location, done) {
	var parts = 2;
	var called = false;
	var complete = false;
	function callback(complete) {
		--parts;
		if (called) {
			return;
		}
		if (parts === 0 || !complete) {
			called = true;
			done(complete);
		}
	}
	map.getView().animate({
		center: location,
		duration: 500
	});
	map.getView().animate({
		zoom: zoom + 1,
		duration: 500
	}, {
		zoom: zoom + 1,
		duration: 500
	}, callback );
	zoom = map.getView().getZoom();
}

vector = new ol.layer.Vector({
	source: new ol.source.Cluster({
		distance: 40,
		source: new ol.source.Vector({
			features: (new ol.format.KML({extractStyles: false})).readFeatures(kml_string, {
				defaultDataProjection: 'EPSG:4326',
				featureProjection:'EPSG:3857'
			})
		})
	}),
	style: styleFunction
});

/*
var raster = new ol.layer.Tile({
	source: new ol.source.OSM()
});
*/

if (mapsrc == "OSM") {
	var raster = new ol.layer.Tile({
		source: new ol.source.OSM()
	});
} else {
	var raster = new ol.layer.Tile({
		source: new ol.source.XYZ({
			url: srcurl,
			attributions: srcatt
		})
	});
}


var map = new ol.Map({
	controls: ol.control.defaults({
		attributionOptions: {
			collapsible: false
		}
       	}).extend([
		scaleLineControl
	]),
<?php
if ($glowingmap) {
?>
        layers: [raster, heatLayer, vector],
<?php } else { ?>
        layers: [raster, vector],
<?php
}

// "{mouseWheelZoom:false}" added inside () for ol.interactions.defaults

?>
	interactions: ol.interaction.defaults({mouseWheelZoom:<?php echo $mousezoom; ?>}).extend([new ol.interaction.Select({
		condition: function(evt) {
<?php if ($closepopup) { ?>
			document.getElementById('infodiv').style.display = "none";
<?php } ?>
			myEvent = evt; // global - will pass the event to the function
			myZoomflag = true; // global will prevent repeated zooming
			return evt.type === 'singleclick';
		},
		filter: clickZoomFunction
	})]),
	target: 'map',
	view: new ol.View({
		center: ol.proj.fromLonLat([<?php echo $centLong; ?> ,<?php echo $centLat; ?>]),
		zoom: zoom
	})
});


// ***************************
// ***************************
// ***************************
//
// Above is the OpenLayers example code
//
// Below is OSM mod code
//
// ***************************
// ***************************
// ***************************


// The following code was found here:
// https://stackoverflow.com/questions/26022029/how-to-change-the-cursor-on-hover-in-openlayers-3
// It's the only one I found that is actually working with the above examplecode...
// I also added that the default cursor is "grab" and while dragging the map it's "grabbing".

	var cursorHoverStyle = "pointer";
	var target = map.getTarget();

//target returned might be the DOM element or the ID of this element dependeing on how the map was initialized
//either way get a jQuery object for it
	var jTarget = typeof target === "string" ? $("#"+target) : $(target);

	map.on("pointermove", function (event) {
		if (event.dragging) {
			document.getElementById('map').style.cursor = 'grabbing';
			return;
		}
		var mouseCoordInMapPixels = [event.originalEvent.offsetX, event.originalEvent.offsetY];

		//detect feature at mouse coords
		var hit = map.forEachFeatureAtPixel(mouseCoordInMapPixels, function (feature, layer) {
			return true;
		});

		if (hit) {
			jTarget.css("cursor", cursorHoverStyle);
		} else {
			jTarget.css("cursor", "grab");
		}
		event.preventDefault(); // avoid bubbling
	});

</script>

<!-- OSM mod code ends here -->
<!-- OSM mod code ends here -->
<!-- OSM mod code ends here -->

<?php
tng_footer( "" );
?>