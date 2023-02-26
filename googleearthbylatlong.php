<?php
// RM - this file is from Dan Bodor. It is what makes the Google Earth link on
// getperson.php work to create the file that Google Earth opens to fly to.

//code for making a KML file from long lat inputs m=world n=$place   lon=$lon   lat=$lat
include ('tng_begin.php');
	
$name = $_REQUEST['n'];
$lat = $_REQUEST['lat'];
$lon = $_REQUEST['lon'];
$zoom = $_REQUEST['z'];

//db mod for range calculation from zoom level
if ($zoom > 0)
	$range = pow(1.94,(20 - $zoom))*64*1.4;
else
	$range = 3000;

header('HTTP/1.1 200 OK');
header('Content-Type: application/keyhole');
header('Content-Disposition: inline; filename="' . $name . '.kml"');

$name = stripslashes($name);

// TRANSLATE LATIN FOREIGN LANGUAGE CHARACTERS INTO UNICODE HEX FOR GOOGLE EARTH
// tried to switch encoding in the XML code, but this didn't work for me and I switched it back
// CURRENTLY TAKES CARE OF CROATIAN AND GERMAN SPECIAL CHARACTERS - CAN ADD MORE FROM ONLINE CHARTS
// CAREFUL - SOME EDITING PROGRAMS INCLUDING FRONTPAGE MAY DAMAGE FOLLOWING CODE BY REMOVING THE FOREIGN CHARACTERS - DO NOT CLICK SAVE IF THESE HAVE BEEN REPLACED BY QUESTION MARKS - EDIT IN WORD OR NOTEPAD
	$name = preg_replace("/š/","&#x0161;",$name);
	$name = preg_replace("/Š/","&#x0160;",$name);
	$name = preg_replace("/æ/","&#x0107;",$name);
	$name = preg_replace("/Æ/","&#x0106;",$name);
	$name = preg_replace("/ž/","&#x017E;",$name);
	$name = preg_replace("/Ž/","&#x017D;",$name);
	$name = preg_replace("/è/","&#x010D;",$name);
	$name = preg_replace("/È/","&#x010C;",$name);
	$name = preg_replace("/ð/","&#x0111;",$name);
	$name = preg_replace("/Ð/","&#x0110;",$name);
	$name = preg_replace("/ü/","&#x00FC;",$name);
	$name = preg_replace("/Ü/","&#x00DC;",$name);
	$name = preg_replace("/ö/","&#x00F6;",$name);
	$name = preg_replace("/Ö/","&#x00D6;",$name);
	$name = preg_replace("/ä/","&#x00E4;",$name);
	$name = preg_replace("/Ä/","&#x00C4;",$name);
	$name = preg_replace("/ß/","&#x00DF;",$name);
//Added ISO-8859-2
	$name = preg_replace("/±/","&#x0105;",$name);
	$name = preg_replace("/¡/","&#x0104;",$name);
	$name = preg_replace("/æ/","&#x0107;",$name);
	$name = preg_replace("/Æ/","&#x0106;",$name);
	$name = preg_replace("/ê/","&#x0119;",$name);
	$name = preg_replace("/Ê/","&#x0118;",$name);
	$name = preg_replace("/³/","&#x0142;",$name);
	$name = preg_replace("/£/","&#x0141;",$name);
	$name = preg_replace("/ó/","&#x00F3;",$name);
	$name = preg_replace("/Ó/","&#x00D3;",$name);
	$name = preg_replace("/¶/","&#x015B;",$name);
	$name = preg_replace("/¦/","&#x015A;",$name);
	$name = preg_replace("/¿/","&#x017C;",$name);
	$name = preg_replace("/¯/","&#x017B;",$name);
	$name = preg_replace("/¼/","&#x017A;",$name);
	$name = preg_replace("/¬/","&#x0179;",$name);
	$name = preg_replace("/ñ/","&#x0144;",$name);
	$name = preg_replace("/Ñ/","&#x0143;",$name);

// note - In the KML CODE below, keep in mind that as tilt is increased, viewing distance is inadvertantly increased if range is constant

echo '<?xml version="1.0" encoding="UTF-8"?>'
?>
<kml xmlns="http://earth.google.com/kml/2.0">
<Placemark>
  <description>
	    <![CDATA[This was found by lat/long data stored in your database.]]>
    </description>
	<name><?php echo $name; ?></name>
  <LookAt>
    <longitude><?php echo $lon; ?></longitude>
    <latitude><?php echo $lat; ?></latitude>
    <range><?php echo $range; ?></range>
    <tilt>45</tilt>
    <heading>0</heading>
  </LookAt>
  <visibility>1</visibility>
<Point><coordinates><?php echo $lon.','.$lat; ?></coordinates></Point></Placemark></kml>
