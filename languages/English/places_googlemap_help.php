<?php
include("../../helplib.php");
echo help_header("Help: Google Maps");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="places_help.php" class="lightlink">&laquo; Help: Places</a> &nbsp; | &nbsp;
			<a href="tlevents_help.php" class="lightlink">Help: Timeline Events &raquo;</a>
		</p>
		<span class="largeheader">Help: Google Maps</span>
		<p class="smaller menu">
			<a href="#show" class="lightlink">Show/Hide</a> &nbsp; | &nbsp;
			<a href="#search" class="lightlink">Search</a> &nbsp; | &nbsp;
			<a href="#controls" class="lightlink">Map Controls</a> &nbsp; | &nbsp;
			<a href="#help" class="lightlink">Help</a>
		</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">
		<div id="google_translate_element" style="float:right"></div><script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
		}
		</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		<p><span class="subheadbold">Show/Hide Clickable Map</span><br /><br />
		Click the "Show/Hide Clickable Map" button to show the Google Map and search for a Geocode
		Location, or to hide the map when finished. The default initial setting is specified in Admin/Setup/Map Settings.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="show"><p class="subheadbold">Search</p></a>
		<p>The Google Map Geocoder interface allows you to locate the latitude and longitude for a place name using the Geocode place input field.
		Streetmap (<a href="https://www.streetmap.co.uk" target="_blank">https://www.streetmap.co.uk</a>) can also be used to look up coordinates.</p>

		<span class="optionhead">Geocode Location</span>
		<p>The Geocode place field contains the TNG place name if the place is already defined in TNG. When adding a new location, the Geocode place will be
		propagated to the TNG place name. The location names are not propagated when adding cemeteries or media. </p>
		<p>For existing TNG place names, you may need to modify the place name in the Geocode place input field.  For example, Google does not like County
		names as part of the place name for U.S. and Scottish locations, nor does it deal with New Zealand provinces. You may want to try place name and
		country only as input. You might also have to enter the country name as it is known in English.</p>
		<span class="optionhead">Place name examples</span>
		<p>The following are examples of how the Geocode place may need to be entered to obtain the correct latitude and longitude:</p>
		<ul>
			<li>1102 Shipwatch Circle, Tampa, Florida</li>
			<li>Klippan 1, 41451 Sweden</li>
			<li>Avenida de Velasquez 126, Malaga</li>
			<li>49 Rue de Tournai, Lille, France</li>
			<li>Ocean Drive, Twin Waters, Queensland, Australia</li>
			<li>Rue de la Wastinne 45, 1301 Wavre, Belgium</li>
			<li>Via Villanova 31, 40050 Bologna villanova, Italy</li>
			<li>Europaboulevard 10, Amsterdam</li>
			<li>Lise-Meitner-Strasse 2, 60486 Frankfurt, Germany</li>
		</ul>

		<p>Some country maps are not available to the geocoder due to nationalistic copyright and licence reasons.
		For these countries, you will need to use the <a href="https://maps.google.com/" target="_blank">Full Google Map Search</a> link.</p>

		<span class="optionhead">Latitude and Longitude</span>
		<p>You need to be very careful about accepting the Latitude and Longitude coordinates that are offered from the map search. You should at least be a
		little bit aware of where a location is and what you're expecting before you accept what is returned from the map search. If the pin pointer on
		the map is not in the location you expected, the latitude and longitude returned may be incorrect.  In which case, you should point and click on
		the Google Map to position to a better location.</p>

		<p>You should also double check the latitude and longitude accepted by using the Test icon on the Place list and then clicking the event pin to
		obtain the external map to validate it is the correct location.</p>
		
		<span class="optionhead">Zoom</span>
		<p>If the location on the map is not at the appropriate and desired zoom, you can use the zoom controls described below to adjust the display of the
		map, especially to eliminate the error message that indicates that Google does not contain a map at this zoom level. The resulting zoom value will be
		saved in your TNG database.</p>

		<span class="optionhead">Place Level</span>
		<p>You can use the place level dropdown to select the granularity level of the place name. Six levels are provided ranging from Address to Country,
		address being the most specific. You can specify overrides for the $admtext for level 1 through 6 contained in the  alltext.php file in your cust_text.php file.
		Levels 2 through 5 tags can be changed to reflect church/hospital/nursing home/cemetery, town/city/commune, county/department, state/province/region, for
		example. Different colored pins will indicate the granularity of the place level on the Individual person's page. The place level indicator does not
		apply to the cemeteries nor the media table.  Pins displayed on the cemeteries table default to level 2 to allow for headstones being at the most
		specific level.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="controls"><p class="subheadbold">Google Map Controls</p></a>

		<span class="optionhead">Point / Click</span>
		<p>To refine the latitude and longitude of a place, click on the Google Map, at the point where you think the place is located. You may also need to
		use the Map, Satellite, or Hybrid button on the Google Map in order to obtain a better latitude and longitude for the TNG place name. </p>

		<span class="optionhead">Drag and Pan</span>
		<p>Since these maps are draggable, you can use your mouse or the directional arrows to pan left, right, up and down to see areas that are hidden
		offscreen. The drag and pan capability means there is no clicking and waiting for graphics to reload each time you want to view the adjacent parts of a map.</p>

		<span class="optionhead">Zoom</span>
		<p>You can use the plus (+) and minus (-) signs or the slider to zoom the map in and out. You may also need to use the direction arrows to position
		the map when zooming in. If you change the zoom level, the zoom value will be saved in the TNG table.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="help"><p class="subheadbold">Google Map Help</p></a>

		<p>You can obtain additional help on the <a href="https://developers.google.com/maps/documentation/javascript/tutorial" target="_blank">Google Maps APIs</a>.</p>
	</td>
</tr>

</table>
</body>
</html>
