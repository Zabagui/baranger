<?php
include("../../helplib.php");
echo help_header("Help: Places");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="cemeteries_help.php" class="lightlink">&laquo; Help: Cemeteries</a> &nbsp; | &nbsp;
			<a href="places_googlemap_help.php" class="lightlink">Help: Google Maps &raquo;</a>
		</p>
		<span class="largeheader">Help: Places</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Search</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Add or Edit</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Delete</a> &nbsp; | &nbsp;
			<a href="#merge" class="lightlink">Merge</a> &nbsp; | &nbsp;
			<a href="#geo" class="lightlink">Geocode</a>
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

		<a name="search"><p class="subheadbold">Search</p></a>
        <p>Locate existing Places by searching for all or part of the <strong>Place Name</strong>. Select a Tree to limit the results to places assigned to that tree.
		Check "Missing Latitude or Longitude" to show only places that still need geocoding. Check "Find only LDS temple codes" to only show 5-character place names that
		have been flagged as LDS temples. Check the "Exact match only" option
		to further narrow your search. Searching with no options selected and no value in the search box will find all Places in your database.</p>

		<p>Check "No associated events" to only show places that are not associated with any events.</p>

		<p>Your search criteria for this page will be remembered until you click the <strong>Reset</strong> button, which restores all default values and searches again.</p>

		<span class="optionhead">Actions</span>
		<p>The Action buttons next to each search result allow you to edit, delete or preview that result. To delete more than one record at a time, click the box in the
		<strong>Select</strong> column for each record to be deleted, then click the "Delete Selected" button at the top of the list. Use the <strong>Select All</strong> or <strong>Clear All</strong>
		buttons to toggle all select boxes at once.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="add"><p class="subheadbold">Add New / Edit Existing Places</p></a>

		<p>TNG automatically adds a new Place record every time you enter a new place in Admin/People, in Admin/Families, or as part of any Custom Event.
		If you change an existing place on any of those screens and the result is a new, unique place name, then a new Place record will also be created.</p>

		<p>To add a new place, click on the <strong>Add New</strong> tab, then fill out the form. To make changes to an existing Place, use
		the <a href="#search">Search</a> tab to locate the Place, then click on the Edit icon next to that line.
		When adding or editing a Place, take note of the following:</p>

		<span class="optionhead">Tree</span>
		<p>If your General Settings are configured so that Places are assigned to Trees, you will see a Tree selection box here. If that's the case, then select one of your existing trees,
		as each Place must be assigned to a tree. <strong>Note:</strong> The tree assignment may not be changed once a Place
		is created (instead, delete the Place and re-add it under another tree). If you don't want Places to be assigned to Trees, go to Admin/Setup/General Settings/Miscellaneous to
		change that.</p>

		<span class="optionhead">Place</span>
		<p>Enter the name of your Place with the smallest locality first and the largest locality last. All localities should be separated by commas. For example,
		<em>Sandy, Salt Lake, Utah, USA</em>. Do not use ambiguous or little-known abbreviations.</p>

		<span class="optionhead">Show/Hide Clickable Map</span>
		<p>Click the "Show/Hide Clickable Map" button to show the Google Map. This feature is only active if you have received a "key" from Google and entered it in your
		TNG Map Settings (see the <a href="mapconfig_help.php">Map Settings Help</a> for more information). Click the button again to hide the map. To have Google Maps search for a location,
		enter that location in the <strong>Geocode Location</strong> field and click the "Search" button. Alternately, you can click and drag on the map to move
		the "pin" until it sits at the desired location. You can also use the Zoom controls to show more detail around the desired area. See the
		<a href="places_googlemap_help.php">Google Maps Help</a> page for more information. Also see the <a href="mapconfig_help.php">Map Settings Help</a>
		for information on default settings for your maps.</p>

		<span class="optionhead">Latitude/Longitude</span>
		<p>Enter the latitude and longitude coordinates of the Place or use the Clickable Google Map to set the values (optional, see above).</p>

		<span class="optionhead">Zoom</span>
		<p>Enter the zoom level or adjust the zoom controls on the Google Map above to set the zoom level. This option is only available if you have received a "key"
		from Google and entered it in your TNG Map Settings.</p>

		<span class="optionhead">Place Level</span></p>
		<p>Select the Place Level that best describes the granularity level of the location represented by the place name. This can help your visitors know how
		exact you were intending to be with your pin placements. For example, if you want to put a pin in France but you don't care where, you would select
		"Country" for this option to let your visitors know that the exact location of the pin within France does not matter.</p>

		<span class="optionhead">Cemeteries</span>
		<p>To associate one or more cemeteries to the current place, click the <strong>Add New</strong> button here.
		In the small window that opens, choose a cemetery from a list of those you already created in Admin/Cemeteries,
		then click on the Go button. To delete a cemetery already associated with the current place, click the small
		Delete icon next to that cemetery.</p>
		
		<p>When a cemetery is associated with a place, information about the cemetery will show on the place page, and a list of
		burials associated with the place will be listed on the cemetery page.</p>

		<span class="optionhead">Notes</span>
		<p>Enter any notes about this place relevant to your associated data.</p>

		<span class="optionhead">Make changes to place name in existing events</span>
		<p>The checked box (only visible when editing an existing Place) indicates that all event instances where this Place is used will be updated when you
		save the changes.</p>

        <p><strong>NOTE:</strong> Subsequent GEDCOM imports using the "Replace all current data" option will NOT overwrite or remove
		existing Place data if the existing records have information in the Latitude, Longitude or Notes fields, or if any media are attached.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="delete"><p class="subheadbold">Deleting Places</p></a>
		<p>To delete one Place, use the <a href="#search">Search</a> tab to locate the Place, then click on the Delete icon next to that Place record. The row will
		change color and then vanish as the Place is deleted. To delete more than one Place at a time, check the box in the Select column next to each Place to be
		deleted, then click the "Delete Selected" button at the top of the page.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="merge"><p class="subheadbold">Merging Places</p></a>
		To review and merge place names that may be slightly different but refer to the same location, click on the "Merge" tab. You will decide whether two
		records are the same or not.</p>

		<span class="optionhead">Find Merge Candidates</span>
		<p>If your General Settings are configured so that Places are assigned to Trees, you will see a Tree selection box here. If that's the case, then select a tree.
		You cannot merge places from different trees, so only one tree can be selected. After that, enter the search criteria that
		will be common to all potential duplicates. For example, you might enter <em>Salt Lake</em> to find matches for
		<em>Salt Lake</em> and <em>Salt Lake City</em>.</p>
		<p>You must enter something in the first field, but the second field is optional. You might decide to enter something there
		if you're trying to merge two places whose names are not very similar. For example, if you want to merge <em>PA</em> and <em>Pennsylvania</em>, the best approach would be to enter <em>PA</em>
		on one line and part of <em>Pennsylvania</em> on the other. After entering the criteria, click "Continue".</p>

		<span class="optionhead">Select Places to Merge</span>
		<p>Under this heading you will see a list of matches for your search criteria. If any of them refer to the same location,
		check the box labeled "Merge these (delete)" to the left for each one. Each selected row will turn red. Next, click the circle in the column labeled "into this (keep)" for
		the Place name that will replace all of the checked Places. That row will turn green. It doesn't matter if the Place Name to keep is also
		one of those checked under "Merge these (delete)". You will only be able to select one "keep" location per merge, but you
		may select as many matches as you want to merge into that one. When you're ready to merge, click the "Merge Places"
		button at the top or the bottom of the screen. All instances of the deleted Places (in individual and family records) will be replaced by the name you chose
		to keep. <strong>Note:</strong> Notes and Latitude/Longitude information will only be retained for the place you are keeping.</p>

		<p>Please also note that performance degrades as more items are selected to merge. In other words, merging two places goes much faster than merging 20 places.</p>

		<p>To search again without merging, just enter a new value in the "Search for" box at the top of the screen and click "Continue" again.</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="geo"><p class="subheadbold">Geocode</p></a>
		<p>The Geocode tool may be used to find and store latitude and longitude coordinates for Places that do not already have that information.</p>

		<span class="optionhead">Limit</span>
		<p>Depending on how many Places you have that need geocoding, this process may take a long time. Google also limits you to 2,500 places per day, so for
		those reasons, you may wish to limit the number of places you do
		at any one time. The default number is 100. If you find that the first 100 go quickly, you might try increasing that number for the next batch.</p>

		<span class="optionhead">Reset</span>
		<p>Check this box to start again from the beginning of the list of places. Otherwise, geocoding will resume from where the last batch ended.</p>

		<span class="optionhead">If multiple results are found:</span>
		<p>If a place name is ambiguous, Google may return more than one match. The recommended action in this case is to ignore all the returned matches (so that you can
		manually make the correct decision later), but you may also choose to let TNG accept the first given match.</p>
	</td>
</tr>

</table>
</body>
</html>