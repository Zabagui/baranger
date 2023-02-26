<?php
include("../../helplib.php");
echo help_header("Help: Cemeteries");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="albums_help.php" class="lightlink">&laquo; Help: Albums</a> &nbsp; | &nbsp;
			<a href="places_help.php" class="lightlink">Help: Places &raquo;</a>
		</p>
		<span class="largeheader">Help: Cemeteries</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Search</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Add or Edit</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Delete</a>
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
        <p>Locate existing cemeteries by searching for all or part of the <strong>Cemetery ID, Cemetery Name, City, County, State, Country</strong> or <strong>Map File Name</strong>.
		Searching with no value in the search box will find all cemeteries in your database.</p>

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
		<a name="add"><p class="subheadbold">Add New / Edit Existing Cemeteries</p></a>
		<p>TNG allows you to categorize and display your headstone photos by cemetery. To do that, you must set up a new cemetery record for each location. Cemetery
		records in TNG are not related to place records and there is no GEDCOM convention for cemeteries, so even if your GEDCOM file contains cemetery names in some
		of your burial locations, those names will not cause cemetery records to be created in TNG when your GEDCOM file is imported.</p>

		<p>To add a new cemetery, click on the <strong>Add New</strong> tab, then fill out the form. To make changes to an existing cemetery, use
		the <a href="#search">Search</a> tab to locate the cemetery, then click on the Edit icon next to that line.
		When adding or editing a cemetery, take note of the following:</p>

		<span class="optionhead">Cemetery Name</span>
		<p>Include the full, proper name for the cemetery. For example, the Salt Lake City Cemetery should be entered as <em>Salt Lake City Cemetery</em>, not just <em>Salt
		Lake City</em> or <em>Salt Lake</em>.</p>

		<span class="optionhead">Map Image to Upload</span>
		<p>If you have a map or other photo of this cemetery and it has not yet been uploaded to your web site, click the "Browse" button and locate it on your hard drive.
		If the photo is already in the Headstones folder on your site, leave this field blank and use the "Map File Name within headstones folder" field instead.</p>

		<span class="optionhead">Map File Name within Headstones folder</span>
		<p>If you had previously uploaded your map or photo to the Headstones folder, enter the path and file name as it exists within the Headstones folder on your web site,
		or click on the Select button to locate the file. If you are uploading
		your map or photo now using the previous field, use this box to enter a path and file name for your file after it is uploaded. A suggested path and file name will be prepopulated
		for you.</p>

		<p> <span class="optionhead">NOTE</span>: If you are uploading now, the directory you indicate here
		must already exist and must be writeable. You may be able to use the "Make Folder" button in the General Settings to create the folder if it does not already exist.
		If that fails, use an FTP program or online file manager.</p>

		<span class="optionhead">Associated Place</span>
		<p>To link this cemetery to a place, enter the place name here as it exists in your database, or proceed to fill
		out the City, County/Parish, State/Province/Shire, Country information below and click the <strong>Fill Place</strong>
		button. Clicking that button will take values you've entered for the other fields and use them to populate the
		Associated Place field.</p>

		<p>When a cemetery is associated with a place, information about the cemetery will show on the place page, and a list of
		burials associated with the place will be listed on the cemetery page.</p>

		<span class="optionhead">City, County/Parish, State/Province/Shire, Country</span>
		<p>Enter as much information as you know about the location of this cemetery. The Country is required, but each of the
		other fields is optional.</p>

		<p>For <strong>State/Province/Shire</strong> and <strong>Country</strong>, select an existing entry using the dropdown box. If the desired entry is not present, use the "Add New" button to add it to the list. If an
		entry in the list does not belong there, first select it and then click on the "Delete Selected" button.</p>

		<span class="optionhead">Show/Hide Clickable Map</span>
		<p>Click the "Show/Hide Clickable Map" button to show the Google Map. This feature is only active if you have received a "key" from Google and entered it in your
		TNG Map Settings (see the <a href="mapconfig_help.php">Map Settings Help</a> for more information). Click the button again to hide the map. To have Google Maps search for a location,
		enter that location in the <strong>Geocode Location</strong> field and click the "Search" button. Alternately, you can click and drag on the map to move
		the "pin" until it sits at the desired location. You can also use the Zoom controls to show more detail around the desired area. See the
		<a href="places_googlemap_help.php">Google Maps Help</a> page for more information. Also see the <a href="mapconfig_help.php">Map Settings Help</a>
		for information on default settings for your maps.</p>

		<span class="optionhead">Latitude/Longitude</span>
		<p>Enter the latitude and longitude coordinates of the cemetery or use the Clickable Google Map to set the values (optional, see above).</p>

		<span class="optionhead">Zoom</span>
		<p>Enter the zoom level or adjust the zoom controls on the Google Map above to set the zoom level. This option is only available if you have received a "key"
		from Google and entered it in your TNG Map Settings.</p>

		<span class="optionhead">Notes</span>
		<p>If additional information is needed to describe the cemetery or its location, enter it here (optional).</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="delete"><p class="subheadbold">Deleting Cemeteries</p></a>
		<p>To delete one cemetery, use the <a href="#search">Search</a> tab to locate the cemetery, then click on the Delete icon next to that cemetery record. The row will
		change color and then vanish as the cemetery is deleted. To delete more than one cemetery at a time, check the box in the Select column next to each cemetery to be
		deleted, then click the "Delete Selected" button at the top of the page.</p>

	</td>
</tr>

</table>
</body>
</html>