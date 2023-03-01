<?php

include("osm_settings.php");

if ( empty($row['latitude']) ) {
	$startzoom = $map['stzoom'];
	$startlat = $map['stlat'];
	$startlong = $map['stlong'];
}
else {
	if ( empty($row['zoom']) )
		$startzoom = 13;
	else
		$startzoom = $row['zoom'];
	$startlat = $row['latitude'];
	$startlong = $row['longitude'];
}
if (!$startlat) $startlat = 0;
if (!$startlong) $startlong = 0;
if(!$startzoom || $startzoom < 2) $startzoom = 2;
$foundzoom = $map['foundzoom'] ? $map['foundzoom'] : 13;
//if(!$map['displaytype']) $map['displaytype'] = "TERRAIN";

if(empty($row['placelevel']) ) {
	$placelevel = 1;
}
$mcharsetstr = "&amp;oe=$session_charset";
?>

<script type="text/javascript">
//<![CDATA[

var myOwnCountry = "<?php echo $myOwnCountry; ?>";

var startlat = '<?php echo $startlat; ?>';
var startlong = '<?php echo $startlong; ?>';
var startzoom = parseInt(<?php echo $startzoom; ?>);
var foundzoom = parseInt(<?php echo $foundzoom; ?>);
var placelevel = <?php if ($placelevel > 0) echo $placelevel; else echo "0"; ?>;
//var point = new google.maps.LatLng(startlat, startlong);

var map = null;
var geocoder = null;
var maploaded = false;
var oldpoint = null;
var notfound = "<?php echo $admtext['notfound'] ?>";

var longlati = [];

// Detta är en MM Edit option!
var mapsrc = "<?php echo $mapsrc; ?>";


function loadmap() {

	var srcurl = "";
	var srcatt = "";

<?php include "osmmapswitch.js"; ?>


	var lon = <?php echo $startlong; ?>;
	var lat = <?php echo $startlat; ?>;

if (maploaded) {
	startzoom = map.getView().getZoom();
	longlati = ol.proj.transform(map.getView().getCenter(), 'EPSG:3857', 'EPSG:4326');
	lon = longlati[0];
	lat = longlati[1];
} else {
	startzoom = <?php echo $startzoom; ?>;
}

	document.getElementById("map").innerHTML = "";


	var iconGeometry = new ol.geom.Point(ol.proj.fromLonLat([lon, lat]));

	var scaleLineControl = new ol.control.ScaleLine();
	scaleLineControl.setUnits("<?php echo $scaleunits; ?>");

	placeOSM = new ol.Feature({
		geometry: iconGeometry
	});
	placeStyle = new ol.style.Style({
        	image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
			anchor: [10, 34],
			anchorXUnits: 'pixels',
			anchorYUnits: 'pixels',
			src: 'google_marker.php?image=006.png&text='
		}))
	});
	placeOSM.setStyle(placeStyle);

	var vectorSource = new ol.source.Vector({
		features: [placeOSM]
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
			center: ol.proj.fromLonLat([lon ,lat]),
			zoom: startzoom
		})
	});

	popup = new ol.Overlay.Popup();
	var geocoder = new Geocoder('nominatim', {
		provider: 'osm',
		targetType: 'glass-button',
		lang: 'en',
		placeholder: 'Search for ...',
		limit: <?php echo $geolistitems; ?>,
		keepOpen: <?php if ($geolistopen) echo "true"; else echo "false"; ?>
	});
	map.addControl(geocoder);
	map.addOverlay(popup);

	map.on("moveend", function() {
		var zoom = map.getView().getZoom();
		document.getElementById('zoombox').value = parseInt(zoom + 0.5);
		startzoom = zoom;
	});

	map.on('singleclick', function(evt) {
		var lonlat = ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326');
		document.getElementById('lonbox').value = lonlat[0];
		document.getElementById('latbox').value = lonlat[1];

		map.getView().setCenter(ol.proj.transform([lonlat[0], lonlat[1]], 'EPSG:4326', 'EPSG:3857'));
		map.getView().setZoom(startzoom);
	        iconGeometry.setCoordinates( evt.coordinate );

	});

	geocoder.on('addresschosen', function (evt) {
		window.setTimeout(function () {
			popup.show(evt.coordinate, evt.address.formatted);
			var lonlat = ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326');
<?php if ($geoshowname) { ?>
			document.getElementById('place').value = showAddress(evt.address);
<?php } ?>
			map.getView().setCenter(ol.proj.transform([lonlat[0], lonlat[1]], 'EPSG:4326', 'EPSG:3857'));
			map.getView().setZoom(<?php echo $geozoom; ?>);
			document.getElementById('lonbox').value = lonlat[0];
			document.getElementById('latbox').value = lonlat[1];
		},
		3000);
	});
	document.getElementById('lonbox').value = lon;
	document.getElementById('latbox').value = lat;
        maploaded = true;


 	document.getElementById('osmmapsat').style.padding="4px 4px 4px 4px";
 	document.getElementById('osmmapsat').style.backgroundColor="#dddddd";
	document.getElementById('osmmapsat').innerHTML = "<img src='img/osmmap.gif' alt='' title='Map' style='cursor:pointer; margin-right:2px;' class='rounded4' onclick=\"mapsrc='<?php echo $mapsrc; ?>'; loadmap();\"/><img src='img/osmsatel.gif' alt='' title='Satellite' style='cursor:pointer;' class='rounded4' onclick=\"mapsrc='SAT'; loadmap();\"/>";


}

function showAddress(address) {
	var pname = address.details;
	var name = pname['name'];
<?php if ($geozipcode) { ?>
	var postcode = pname['postcode']; if (postcode == "undefined") postcode = "";
<?php } else { ?>
	var postcode = "";
<?php } ?>
	var city = pname['city']; if (city == "undefined") city = "";
	var state = pname['state']; if (state == "undefined") state = "";
	var country = pname['country']; if (country == "undefined") country = "";
	if (country) { if (myOwnCountry.toUpperCase().indexOf(country.toUpperCase()) > -1) country = ""; else country = ", " + country; }

	var outname = name; if (postcode || city || state) outname += ", ";
	if (postcode) {
		outname += postcode;
		if (city) {
			outname += " " + city;
		}
		if (state) outname += ", ";
	} else {
		if (city) {
			outname += city;
			if (state) outname += ", ";
		}
	}
	outname += state + country;
	return outname;
}

function divbox(box_id) {
	if(jQuery('#place').length) jQuery('#location').val(jQuery('#place').val());
	jQuery('#'+box_id).toggle(300,function(){if(!maploaded) loadmap();});
	return false;
}
//]]>
</script>
