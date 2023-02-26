<?php
include("../../helplib.php");
echo help_header("Help: Map Settings");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="importconfig_help.php" class="lightlink">&laquo; Help: Import Settings</a> &nbsp; | &nbsp;
			<a href="templateconfig_help.php" class="lightlink">Help: Template Settings &raquo;</a>
		</p>
		<span class="largeheader">Help: Map Settings</span>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow"><span class="normal">
		<div id="google_translate_element" style="float:right"></div><script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
		}
		</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

		<span class="optionhead">Map Key</span>
		<p>You must get a map <strong>key</strong> from Google in order to use Google Maps on your site. To get a map key, you must also 
			have a Google user ID. If you are already signed up for Google Mail, you can use that user ID, otherwise you will need to create a new 
			Google account. You must also enable billing on your Google account. Once you have an account with billing enabled, you can obtain a key here:
			<a href="https://console.cloud.google.com/" target="_blank">https://console.cloud.google.com/</a>.</p>
		<p>Once you're there, first select your project. From the API library (section Maps) select and enable the following three keys: 
			Maps JavaScript API , Geocoding API, and Places API. Maps JavaScript API is needed to show the google map to your site visitors, 
			with a marker at the various places (place of birth, death, mariage etc). Geocoding API is used in the admin section of your 
			website to associate places with coordinates.
		</p>
		<p>Go to <a href="https://tng.lythgoes.net/wiki/index.php/Google_Maps_-_Getting_Started">https://tng.lythgoes.net/wiki/index.php/Google_Maps_-_Getting_Started</a> for more information.

<ul>
<li>Generate the API key under "APIs &amp; Services (Credentials)", plus add your site address as an "HTTP referrer".</li>
<li>Enable the "Maps Javascript API" under the "Google Maps" menu.</li>
</ul>

		<p>After you receive your key, paste it into the <strong>Map Key</strong> field on the TNG Map Settings page. If later you decide not to use Google Maps,
		simply remove the key from this field and the maps and map-related fields will no longer display. More information on getting started
		with Google Maps can be found on the TNG Wiki: <a href="https://tng.lythgoes.net/wiki/index.php/Google_Maps_-_Getting_Started" target="_blank">https://tng.lythgoes.net/wiki/index.php/Google_Maps_-_Getting_Started</a>.</p>

		<span class="optionhead">Map Type</span>
		<p>Choose which type of map will be displayed first: Terrain, Road Map, Satellite or Hybrid (a satellite image with streets laid out
		on top).</p>

		<span class="optionhead">Starting Latitude, Starting Longitude</span>
		<p>These coordinates determine where the default "center" of the map is for any place that does not yet have any assigned coordinates. The pin
		will start at that location.</p>

		<span class="optionhead">Starting Zoom</span>
		<p>This number indicates how close up or far away new Google Maps in the Admin area should be displayed to begin with. Lower numbers mean that the
		view is farther away, while higher numbers mean the view is closer. Once the zoom is saved for a particular map, it will be saved with that map.</p>

		<span class="optionhead">Location Zoom</span>
		<p>This number indicates how close up or far away a Google Map in the Admin area should be displayed after a location is searched for and located.</p>

		<span class="optionhead">Dimensions, Individual Page</span>
		<p>Enter the dimensions (width must be in pixels with "px" at the end, or as a percentage; height must be in pixels with "px" at the end) for the map
		displayed on each person's individual page.	For example, to make the map be 500 pixels high, set the <strong>Height</strong> to 500px. To make the map reach 80 percent
		of the way across the allotted area, set the <strong>Width</strong> to 80%.</p>

		<span class="optionhead">Dimensions, Headstones Pages</span>
		<p>Enter the dimensions for the maps displayed on all headstone-related pages (width must be in pixels with "px" at the end, or as a percentage;
		height must be in pixels with "px" at the end)</p>

		<span class="optionhead">Dimensions, Admin Pages</span>
		<p>Enter the dimensions for the maps displayed on all Admin pages (width must be in pixels with "px" at the end, or as a percentage; height
		must be in pixels with "px" at the end).</p>

		<span class="optionhead">Hide Admin Maps to Start</span>
		<p>To hide the maps on the Admin pages until the <span class="emphasis">Show/Hide</span> button is clicked, select <span class="choice">Yes</span> here. To
		have the maps displayed by default when the pages are displayed, select <span class="choice">No</span>.</p>

		<span class="optionhead">Hide Public Maps to Start</span>
		<p>To delay loading the map on the individual person pages until the user calls for it, select <span class="choice">Yes</span> here. This will allow
		the page to load more quickly. The map will be loaded as soon as the <span class="emphasis">Show the map</span> button is clicked.  
		If you select <span class="choice">No</span>, then the map on the person page will always load be shown when the page loads.</p>

		<span class="optionhead">Consolidate Duplicate Pins</span>
		<p>If multiple events for an individual occurred at the same location, setting this option to <span class="emphasis">Yes</span> will prevent duplicate pins from being
		created for non-unique place names. Note: Setting this option to <span class="emphasis">No</span> will cause duplicate pins to obstruct each other.</p>

		<span class="optionhead">Place Levels Pins: Labels and Colors</span>
		<p>Each geocode location can be associated with one of six <strong>Place Levels</strong> (e.g., Location, Town/City, County/Shire, etc.). The labels for these
		levels can be found in the "alltext.php" file in each language folder, and you may override them in your "cust_text.php" file (also in each language folder).</p>

		<p>The pin colors are determined by values set in mapconfig.php. If you would like to change the pin colors, go to the TNG downloads page
		and download the full palette of 216 different pin colors, then open your mapconfig.php file in a text editor and enter the number of the
		new pin color next to the corresponding place level variable. Finally, upload the new pin image file(s) to the <span class="emphasis">googlemaps</span> folder on your site.</p>

		</span>
	</td>
</tr>

</table>
</body>
</html>