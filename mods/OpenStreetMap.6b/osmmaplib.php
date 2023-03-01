<?php


//jmj map mod
	$locations2map = array();
	$l2mCount = 0;
	$map['pins'] = 0;
    if(!$map['displaytype']) $map['displaytype'] = "TERRAIN";

// these two lines used to remove or replace characters that cause problems
// with opening new Google maps
	$banish = array("(", ")", "#", "&", " from ", " to ", " van ", " naar ", " von ", " bis ", " da ", " a ", " de ", " ? ", " vers ", " till ");
	$banreplace = array("[", "]", "", "and", " from%A0", " to%A0", " van%A0", " naar%A0", " von%A0", " bis%A0", " da%A0", " a%A0", " de%A0", "‡%A0", "vers%A0", "till%A0");
    //may not need charset in v3
    //$mcharsetstr = "&amp;oe=$session_charset";

function tng_map_pins() {
	global $locations2map, $l2mCount, $pinplacelevel0, $cms;
	global $map, $defermap, $session_charset, $scaleunits;

	include("osm_settings.php");

	$minLat = 500;
	$maxLat = -500;
	$minLong = 500;
	$maxLong = -500;

	$imgpin = array();
	$pinctr = 0;

	reset($locations2map);
// following line changed in v12.0.0.5a of mod because each() function is deprecated in PHP 7.2
//	while( list($key, $val) = each($locations2map) ) {   // change provided by Michel Kirsh
	foreach($locations2map as $key => $val) {
		$lat = $val['lat'];
		$long = $val['long'];
		$zoom = $val['zoom'] ? $val['zoom'] : 10;
		$pinplacelevel = $val['pinplacelevel'];
		if($lat && $long) {
            if($lat < $minLat) $minLat = $lat;
            if($long < $minLong) $minLong = $long;
            if($lat > $maxLat) $maxLat = $lat;
            if($long > $maxLong) $maxLong = $long;

		}
	}

	$revertLong = false;
	if ($maxLong > 0 && $minLong < 0 && $maxLong - $minLong > 180) { $minLong += 360; $revertLong = true; }

	$centLat = $minLat + (($maxLat - $minLat)/2);
	$centLong = $minLong + (($maxLong - $minLong)/2);

	$distLong = abs($maxLong - $minLong);
	$distLat = abs($maxLat - $minLat);

?>


<script type="text/JavaScript" src="<?php echo $cms['tngpath']; ?>js/ol.js"></script>

<script type="text/javascript">
//<![CDATA[
	//more setup needed here?
    var maploaded = false;
<?php
    if($minLat == 500 ) {
        echo "jQuery('#map').hide();\n";
	}

?>

var myEvent = ""; // Makes the selected event (click, dblclick etc) readable in my functions
var myClickflag = false; // Prevents multiple zooms when clicking cluster

var zoom = 2;

var longlati = [];


// This is an MM Edit option!
var mapsrc = "<?php echo $mapsrc; ?>";


function ShowTheMap() {

	var srcurl = "";
	var srcatt = "";

<?php include "osmmapswitch.js"; ?>

	if (maploaded) {
		zoom = map.getView().getZoom();
		longlati = ol.proj.transform(map.getView().getCenter(), 'EPSG:3857', 'EPSG:4326');
	} else {
		if (<?php echo $distLat; ?> == 0 && <?php echo $distLong; ?> == 0) zoom = <?php echo $zoom; ?>;
		longlati[0] = <?php echo $centLong; ?>;
		longlati[1] = <?php echo $centLat; ?>;
	}

	document.getElementById("map").innerHTML = "";

	// This is the scale in LL corner
	var scaleLineControl = new ol.control.ScaleLine();
	scaleLineControl.setUnits("<?php echo $scaleunits; ?>");

	var contentString, icon;
	var placeOSM = [];
	var placeStyle = [];

<?php
        //do the points
		reset($locations2map);
		$markerNum = 0;
		$usedplaces = array();
		$zoom = 10;
// following line changed in v12.0.0.5a of mod because each() function is deprecated in PHP 7.2
//		while(list($key, $val) = each($locations2map)) {  // change provided by Michel Kirsh
		foreach($locations2map as $key => $val) {
			$lat = $val['lat'];
			$long = $val['long'];
			if ($long < -180) $long += 360;
			if ($long > 180) $long -= 360;

			$htmlcontent = $val['htmlcontent'];
			$osmname = $htmlcontent;
			$pinplacelevel = $val['pinplacelevel'];
			if(!$pinplacelevel) $pinplacelevel = $pinplacelevel0;
			$zoom = $val['zoom'] ? $val['zoom'] : $zoom;
			$uniqueplace = $val['place'] . " " . $lat . $long;

			if($lat && $long && ($map['showallpins'] || !in_array($uniqueplace,$usedplaces))) {
				$usedplaces[] = $uniqueplace;

				$markerNum++;
				echo "\nvar lon = ".$long.";\n";
				echo "var lat = ".$lat.";\n";

				echo "placeOSM[".$markerNum."] = new ol.Feature({
        geometry: new ol.geom.Point(ol.proj.fromLonLat([lon, lat])),
	id: ".$markerNum.",
	name: '".$osmname."'
});
placeStyle[".$markerNum."] = new ol.style.Style({
        image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
		anchor: [10, 34],
		anchorXUnits: 'pixels',
		anchorYUnits: 'pixels',
		src: 'google_marker.php?image=".$pinplacelevel.".png&text=".$markerNum."'
	}))
});";
				echo "
placeOSM[".$markerNum."].setStyle(placeStyle[".$markerNum."]);\n";
	   		}
		}

?>

	var vectorSource = new ol.source.Vector({
		features: [<?php
$i = 1;
echo "placeOSM[".$i."]";

for ($i = 2; $i <= $markerNum; $i++) {
	echo ", placeOSM[".$i."]";
}
?>]
	});

	var vectorLayer = new ol.layer.Vector({
		source: vectorSource
	});



	if (mapsrc == "OSM") {
		var rasterLayer = new ol.layer.Tile({
			source: new ol.source.OSM()
		});
	} else {
		var rasterLayer = new ol.layer.Tile({
			source: new ol.source.XYZ({
				url: srcurl,
				attributions: srcatt
			})
		});
	}

	if (!maploaded) zoom = <?php echo $zoom; ?>;
	if (!maploaded && zoom > <?php echo $geozoom; ?>) zoom = <?php echo $geozoom; ?>;


	// The INTERACTIONS below is the added Mouse-Wheel Zoom

	map = new ol.Map({
		interactions: ol.interaction.defaults({mouseWheelZoom:<?php echo $mousezoom; ?>}),
		controls: ol.control.defaults({
			attributionOptions: {
				collapsible: false
			}
        	}).extend([
			scaleLineControl
		]),
		layers: [rasterLayer, vectorLayer],
		target: document.getElementById('map'),
		view: new ol.View({
			center: ol.proj.fromLonLat([longlati[0], longlati[1]]),
			zoom: zoom
		})
	});


// Below: My question got this reply here
// https://stackoverflow.com/questions/50773076/automatic-zoom-depending-on-extreme-points

	if (!maploaded && <?php echo $markerNum; ?> > 1) {
<?php
		global $textpart;
		if ($textpart == "getperson") {
			if (isset($map['person']) && $map['person'] == "1" && $map['pstartoff'] == "0") {
				echo "map.getView().fit(vectorSource.getExtent(), {padding:[40, 16, 32, 40], maxZoom:".$zoom."} );\n";
			} else {
				echo "map.getView().fit(vectorSource.getExtent(), {padding:[40, 16, 32, 40], maxZoom:".$zoom."} );\n";
			}
		} else {
			echo "map.getView().fit(vectorSource.getExtent(), {padding:[40, 16, 32, 40], maxZoom:".$zoom."} );\n";
		}
?>
	}


	map.on('singleclick', function(event) {
<?php if ($closepopup) { ?>
		document.getElementById('infodiv').style.display = "none";
<?php } ?>
		map.forEachFeatureAtPixel(event.pixel, function(feature,layer) {
			d = document.getElementById('infodiv');
			x = event.pixel[1];
			y = event.pixel[0];
			d.innerHTML = "<div style='position:absolute; top:0px; right:0px; z-index:101; font-size:16px; padding:4px; cursor:pointer; line-height:12px' onclick=\"document.getElementById('infodiv').style.display='none';\"><b>x&nbsp;</b></div>" + feature.get('name');
			d.style.top = x + "px";
			d.style.left = y + "px";
			d.style.display = "block";
			event.preventDefault();
		});
	});


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

        maploaded = true;


 	document.getElementById('osmmapsat').style.padding="4px 4px 4px 4px";
 	document.getElementById('osmmapsat').style.backgroundColor="#dddddd";
	document.getElementById('osmmapsat').innerHTML = "<img src='img/osmmap.gif' alt='' title='Map' style='cursor:pointer; margin-right:2px;' class='rounded4' onclick=\"mapsrc='<?php echo $mapsrc; ?>'; ShowTheMap();\"/><img src='img/osmsatel.gif' alt='' title='Satellite' style='cursor:pointer;' class='rounded4' onclick=\"mapsrc='SAT'; ShowTheMap();\"/>";

}

<?php
	if(!isset($defermap) || !$defermap ) {
		echo "function displayMap() {\n";
		echo "  if (jQuery('#map').length) {\n";
		echo "  ShowTheMap(); \n";
		echo "  }\n";
		echo "}\n";

		if ($textpart == "getperson") {
			if (isset($map['person'])) {
				if ($map['person'] == "1" && $map['pstartoff'] == "0") {
					// Open + Open = Display
					echo "window.onload=displayMap;\n";
				}
				// Otherwise don't display
			} else {
				if ($map['pstartoff'] == "0") {
					// Open = Display
					echo "window.onload=displayMap;\n";
				}
			}
		} else {
			echo "window.onload=displayMap;\n";
		}
	}
?>
//]]>
</script>
<?php
}

function stri_replace($find,$replace,$string) {
	if(!is_array($find)) $find = array($find);
	if(!is_array($replace)) {
    	if(!is_array($find)) $replace = array($replace);
		else {
			// this will duplicate the string into an array the size of $find
			$c = count($find);
			$rString = $replace;
			unset($replace);
			for ($i = 0; $i < $c; $i++) {
				$replace[$i] = $rString;
			}
		}
	}
	foreach($find as $fKey => $fItem) {
		$between = explode(strtolower($fItem),strtolower($string));
		$pos = 0;
		foreach($between as $bKey => $bItem) {
			$between[$bKey] = substr($string,$pos,strlen($bItem));
			$pos += strlen($bItem) + strlen($fItem);
		}
		$string = implode($replace[$fKey],$between);
	}
	return($string);
}
?>
