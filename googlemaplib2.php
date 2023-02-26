<?php
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
if(!$startzoom) $startzoom = 2;
$foundzoom = $map['foundzoom'] ? $map['foundzoom'] : 13;
if(!$map['displaytype']) $map['displaytype'] = "TERRAIN";

if(empty($row['placelevel']) ) {
	$placelevel = 1;
}
$mcharsetstr = "&amp;oe=$session_charset";
?>

<script type="text/javascript">
//<![CDATA[
var startlat = '<?php echo $startlat; ?>';
var startlong = '<?php echo $startlong; ?>';
var startzoom = parseInt(<?php echo $startzoom; ?>);
var foundzoom = parseInt(<?php echo $foundzoom; ?>);
var point = new google.maps.LatLng(startlat, startlong);

var map = null;
var geocoder = null;
var maploaded = false;
var oldpoint = null;

function loadmap() {
    var myOptions = {
        scrollwheel: false,
		scaleControl: true,
	    zoom: startzoom,
        center: point,
        mapTypeId: google.maps.MapTypeId.<?php echo $map['displaytype']; ?>
    };
    map = new google.maps.Map(document.getElementById('map'), myOptions);

    var marker = new google.maps.Marker({position:point, map:map});
    oldpoint = marker;

	geocoder = new google.maps.Geocoder();

    google.maps.event.addListener(map, 'click', function(event) {
        handleNewLocation(event.latLng);
	});

    google.maps.event.addListener(map, 'zoom_changed', getNewZoomLevel);
	if(jQuery('#location').val() && jQuery('#placelevel').val()!='-1'  && jQuery('#latbox').val()=="" && jQuery('#lonbox').val()=="")
		showAddress(jQuery('#location').val());

	maploaded = true;
}

function handleNewLocation(whereClicked) {
    oldpoint.setMap(null);
    var newpoint = whereClicked;
    placeMarker(newpoint);

    map.panTo(newpoint);

    jQuery('#latbox').val(newpoint.lat());
    jQuery('#lonbox').val(newpoint.lng());
    jQuery('#zoombox').val(map.getZoom());
}

function placeMarker(location) {
    oldpoint = new google.maps.Marker({
        position: location,
        map: map
    });
}

function keyHandlerEnter(field,e) {
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return true;
	if(keycode == 13) {
	    showAddress(document.form1.address.value);
    	return false;
	}
	else
		return true;
}

var notfound = "<?php echo $admtext['notfound'] ?>";

function getNewZoomLevel() {
	jQuery('#zoombox').val(map.getZoom());
}

function showAddress(address) {
	if (geocoder) {
		geocoder.geocode({'address':address},
			function(result,status) {
				if(status == "ZERO_RESULTS") {
					alert(address + notfound);
				} 
                else if(status != "OK") {
                    alert(status);
                }
                else {
                    var point = result[0].geometry.location;
                    handleNewLocation(point);
                    map.setZoom(foundzoom);
				}
			}
		);
	}
}

function divbox(box_id) {
	if(jQuery('#place').length) jQuery('#location').val(jQuery('#place').val());
	jQuery('#'+box_id).toggle(300,function(){if(!maploaded) loadmap();});
	return false;
}
//]]>
</script>
