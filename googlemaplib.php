<?php
//jmj map mod
	$locations2map = array();
	$l2mCount = 0;
	$map['pins'] = 0;
    if(!$map['displaytype']) $map['displaytype'] = "TERRAIN";

// these two lines used to remove or replace characters that cause problems
// with opening new Google maps
	$banish = array("(", ")", "#", "&", " from ", " to ", " van ", " naar ", " von ", " bis ", " da ", " a ", " de ", " ? ", " vers ", " till ");
	$banreplace = array("[", "]", "", "and", " from%A0", " to%A0", " van%A0", " naar%A0", " von%A0", " bis%A0", " da%A0", " a%A0", " de%A0", "à%A0", "vers%A0", "till%A0");
    //may not need charset in v3
    //$mcharsetstr = "&amp;oe=$session_charset";

function tng_map_pins() {
	global $locations2map, $l2mCount, $pinplacelevel0, $cms;
	global $map, $defermap, $session_charset;

	$minLat = 500;
	$maxLat = -500;
	$minLong = 500;
	$maxLong = -500;

	reset($locations2map);
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

	$centLat = $minLat + (($maxLat - $minLat)/2);
	$centLong = $minLong + ((abs($minLong) - abs($maxLong))/2);

?>
<script type="text/javascript">
//<![CDATA[
	//more setup needed here?
    var maploaded = false;
<?php
    if($minLat == 500 ) {
        echo "jQuery('#map').hide();\n";
	}
?>
    function ShowTheMap() {
        var myOptions = {
            scrollwheel: false,
			scaleControl: true,
            zoom: <?php echo $zoom; ?>,
            center: new google.maps.LatLng(<?php echo "$centLat,$centLong"; ?>),
            mapTypeId: google.maps.MapTypeId.<?php echo $map['displaytype']; ?>
        };
        var map = new google.maps.Map(document.getElementById('map'), myOptions);

        var bounds = new google.maps.LatLngBounds();
		var contentString, icon;
<?php
        //do the points
		reset($locations2map);
		$markerNum = 0;
		$usedplaces = array();
		$zoom = 10;
		foreach($locations2map as $key => $val) {
			$lat = $val['lat'];
			$long = $val['long'];
			$htmlcontent = $val['htmlcontent'];
			$pinplacelevel = $val['pinplacelevel'];

			if(!$pinplacelevel) $pinplacelevel = $pinplacelevel0;
			$zoom = $val['zoom'] ? $val['zoom'] : $zoom;
			$uniqueplace = isset($val['place']) ? $val['place'] : "" . " " . $lat . $long;

			if($lat && $long && ($map['showallpins'] || !in_array($uniqueplace,$usedplaces))) {
				$usedplaces[] = $uniqueplace;

				$markerNum++;
				echo "   contentString = '$htmlcontent';\n";
				echo "   var point$markerNum = new google.maps.LatLng($lat,$long);\n";
				echo "   var infowindow$markerNum = new google.maps.InfoWindow({content: contentString});\n";
				echo "   icon = \"{$cms['tngpath']}google_marker.php?image={$pinplacelevel}.png&text={$markerNum}\";\n";
				echo "   var marker$markerNum = new google.maps.Marker({position: point$markerNum,map: map,icon:icon,title:\"" . @htmlspecialchars($uniqueplace, ENT_QUOTES, $session_charset) . "\"});\n";
				echo "   google.maps.event.addListener(marker$markerNum, 'click', function() {infowindow$markerNum.open(map,marker$markerNum);});\n";
				echo "   bounds.extend(point$markerNum);\n";
	   		}
		}
		if($markerNum > 1) {
			echo "   map.fitBounds(bounds);\n";
			echo "   if (map.getZoom() > $zoom) { map.setZoom($zoom); }\n";
			echo "   google.maps.event.addListenerOnce(map, 'zoom_changed', function(event) {\n";
			echo "       if (map.getZoom() > $zoom) {\n";
			echo "           map.setZoom($zoom);\n";
			echo "       }\n";
			echo "   });\n";
		}
		else {
			echo "   map.setCenter(bounds.getCenter());\n";
			echo "   map.setZoom($zoom);\n";
		}
?>
        maploaded = true;
    }
<?php
	if(!isset($defermap) || !$defermap) {
		echo "function displayMap() {\n";
		echo "  if (jQuery('#map').length) {\n";
		echo "  ShowTheMap(); \n";
		echo "  }\n";
		echo "}\n";
		echo "window.onload=displayMap;";
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
