<?php
include("../../helplib.php");
echo help_header("Help: Events");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="citations_help.php" class="lightlink">&laquo; Help: Citations</a> &nbsp; | &nbsp;
			<a href="more_help.php" class="lightlink">Help: More &raquo;</a>
		</p>
		<span class="largeheader">Help: Events</span>
		<p class="smaller menu">
			<a href="#what" class="lightlink">Standard vs. Custom</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Add New</a> &nbsp; | &nbsp;
			<a href="#edit" class="lightlink">Edit Existing</a> &nbsp; | &nbsp;
			<a href="#del" class="lightlink">Delete</a> &nbsp; | &nbsp;
			<a href="#citations" class="lightlink">Citations</a>
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

		<a name="what"><p class="subheadbold">Standard vs. Custom Events</p></a>
		The more common events, such as Birth, Death, Marriage and a few others, are entered on the main People, Families, Sources and Repositories pages
		and are stored in their respective database tables.	TNG documentation refers to those events as "Standard" events. All other events are called "Custom" events
		and are managed in the <strong>Other Events</strong> sections of the People, Families, Sources and Repositories pages. Those events are stored in a separate
		Events table. This Help topic refers to the management of those <em>Custom</em> events.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="add"><p class="subheadbold">Adding Events</p></a>

		<p>To add a new event, click on the "Add New" button in the Other Events section, then fill out the form. When events already exist, they will
		be displayed in a table in the Other Events section. For an explanation on the available fields, see the next section below.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="edit"><p class="subheadbold">Editing Events</p></a>

		<p>To edit an existing event, click on the Edit icon next to that event in the Other Events section (to edit the data for a "standard" event
		like Birth or Death, simply change the text).</p>

		<p>While adding or editing a note, please take note of the following:</p>

		<span class="optionhead">Event Type</span>
		<p>Select the type of event (you cannot change the event type for an existing event). If the Event Type you want is not in the Event Type selection box,
		first go to Admin/Custom Event Types and set up that Event Type, then return to this screen to select it.</p>

        <span class="optionhead">Event Date</span>
		<p>The actual or approximated date associated with the event.</p>

        <span class="optionhead">Event Place</span>
		<p>The place where the event occurred. Enter the place name or click the Find icon (the magnifying glass) to locate the event as you entered it previously.</p>

        <span class="optionhead">Detail</span>
		<p>Any additional explanation of the event, if necessary. If no date or place is associated with the event, the Detail field should contain some defining information.</p>

        <span class="optionhead">Duplicate for (ID):</span>
		<p>To duplicate this event for one or more other people or families, enter the ID(s) for those people or families here. If more than one ID is entered, separate each pair with a comma. 
			If an ID is unknown, click the "Find" icon to the right of the field to look it up by name. The event will then be duplicated with the "Save" button is clicked. When the Edit Event box
			is re-opened, this field will be blank. Any changes made to the event at that point will <b>not</b> be propagated to the duplicates made earlier.</p>

        <span class="optionhead">More</span><br />
		<p>More less commonly used information can be added for each event by clicking on the "More" heading or the arrow next to it. Doing so will cause these fields
		to appear. The fields can be hidden by again clicking on the heading or arrow. Hiding the fields does not remove any information entered there. Those fields include:</p>

        <p><span class="optionhead">Age</span>: The age of the individual at the time of the event.</p>

        <p><span class="optionhead">Agency</span>: The institution or individual having authority and/or responsibility at the time of the event.</p>

        <p><span class="optionhead">Cause</span>: The cause of the event (most often used with Death).</p>

        <p><span class="optionhead">Address 1/Address 2/City/State/Province/Zip/Postal Code/Country/Phone/E-mail/Web Site</span>: The address and other contact information associated with the event.</p>

        <span class="optionhead">Required fields:</span>
		<p>You must choose an Event Type, and you must enter something in at least one of the following fields: <strong>Event Date</strong>, <strong>Event Place</strong>,
		or <strong>Detail</strong>. All other information is optional.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="del"><p class="subheadbold">Deleting Events</p></a>

		<p>To edit an existing event, click on the Edit icon next to that event in the Other Events section (to edit the data for a "standard" event
		like Birth or Death, simply change the text). The event will be deleted, regardless of whether the surrounding page is saved.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="citations"><p class="subheadbold">Notes and Citations</p>
		To add or edit notes or citations for an event, first save the event, then click the appropriate icon next to that event record in the current list of events.
		For more information on notes, please see <a href="notes_help.php">Help: Notes</a>. 
		For more information on citations, please see <a href="citations_help.php">Help: Citations</a>.</p>

	</td>
</tr>

</table>
</body>
</html>
