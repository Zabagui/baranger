<?php
include("../../helplib.php");
echo help_header("Help: Event / Attribute Types");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="branches_help.php" class="lightlink">&laquo; Help: Branches</a> &nbsp; | &nbsp;
			<a href="reports_help.php" class="lightlink">Help: Reports &raquo;</a>
		</p>
		<span class="largeheader">Help: Event / Attribute Types</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Search</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Add or Edit</a> &nbsp; | &nbsp;
			<a href="#accept" class="lightlink">Accept vs. Ignore</a> &nbsp; | &nbsp;
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
		<p>Locate existing Event or Attribute Types by searching for all or part of the <strong>Tag, Type/Description (for EVEN events)</strong> or <strong>Display</strong>. 
		Select an <strong>Associated with</strong> type or check one of the other options to further narrow your search.
		Searching with no options selected and no value in the search box will find all Event / Attribute Types in your database. Search options include:</p>

		<p><span class="optionhead">Associated with</span><br />
		Choose an option from this dropdown box to limit the search to Event / Attribute Types associated with
		individuals, families, sources or repositories.</p>

		<p><span class="optionhead">Accept/Ignore/All</span><br />
		Select one of these options to limit the search to Event / Attribute Types that are being <strong>accepted</strong> or those
		that are being <strong>ignored</strong>. Choosing <strong>All</strong> will not restrict the search results.</p>

		<p>Your search criteria for this page will be remembered until you click the <strong>Reset</strong> button, which restores all default values and searches again.</p>

		<p><span class="optionhead">Delete/Accept/Ignore/Collapse Selected</span><br />
		Click the checkbox next to one or more event types, then use these buttons to perform the action on all selected event types at once.</p>

		<span class="optionhead">Actions</span>
		<p>The Action buttons next to each search result allow you to edit or delete that result. To delete more than one record at a time, click the box in the
		<strong>Select</strong> column for each record to be deleted, then click the "Delete Selected" button at the top of the list. Use the <strong>Select All</strong> or <strong>Clear All</strong>
		buttons to toggle all select boxes at once.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="add"><p class="subheadbold">Adding or Editing Event / Attribute Types</p></a>

		<p>The more common or "standard" event types, such as Birth, Death, Marriage and a few others, are managed directly on the main People, Families, Sources and Repositories pages.
		All other events and attributes are managed in the <strong>Other Events / Attributes</strong> sections of the People, Families, Sources and Repositories pages. Before you can enter one of these "other"
		events, you must have a record for the associated Event / Attribute Type. TNG automatically sets up Event / Attribute Types for all non-standard events included in
		your GEDCOM file, but you may also set up types by hand.</p>

		<p>To add a new Event / Attribute Type, click on the "Add New" tab, then fill out the form. To make changes to an existing type, use
		the <a href="#search">Search</a> tab to locate the record, then click on the Edit icon next to that line.
		When adding or editing a type, take note of the following:</p>

		<span class="optionhead">Associated with</span>
		<p>Choose an option from this dropdown box to associate this event or attribute type with individuals, families, sources
		or repositories. A single event or attribute type may not be associated with more than one of these options. The
		choice made here will dictate what options show in the Tag dropdown box.</p>

		<span class="optionhead">Select Tag or enter</span>
		<p>This is a 3 or 4 character abbreviation (all uppercase) or mnemonic code.
		Many common non-standard event types are listed in the Tag select box. If you do not see the desired tag here, enter it in the box directly beneath. If you select a tag from the list
		AND enter one in the box, the tag you entered in the box will be accepted and the tag selected from the list will be ignored.</p>

		<span class="optionhead">Type/Description</span>
		<p>This should match the "Type" output by your PC/Mac genealogy program for this event type. NOTE: This field will only be displayed if you
		choose "EVEN" for your tag. For all other tags, this field should be left blank.</p>

		<span class="optionhead">Display</span>
		<p>This will appear in the column to the left of the event data when it is displayed for public viewing. If you have set up multiple languages,
		you will see a section below this field titled "Other Languages". If you click on the plus sign, a separate
		Display box will be presented for each language supported. To have the same label display for every language,
		fill in the Display box above and leave the language-specific display boxes blank.</p>

		<span class="optionhead">Display Order</span>
		<p>Events with associated dates are always sorted chronologically. Those events without dates are sorted within
		that list, in the order they appear in the database. The order of this sublist can be affected by assigning
		a Display Order here. A lower number will cause an event to be sorted higher.</p>

		<span class="optionhead">Event Data</span>
		<p>To accept imported data corresponding to this event or attribute type, select <em>Accept</em>. To reject data corresponding to this type and cause it to not
		be imported, choose <em>Ignore</em>. Once an event of this type is imported, you may still elect not to
		display it by setting this option back to Ignore.</p>

		<span class="optionhead">Collapse Event</span>
		<p>If the information for this event results in more than one row of data on the Individual page, all rows after the first will start off in the collapsed
		position. Visitors can expand the event and view the hidden information by clicking on the downward-facing triangle next to the event label.</p>

		<span class="optionhead">LDS Event</span>
		<p>If this event type should be subject to the same privacy rules that govern other LDS events, choose "Yes" here.</p>

	   	<p><span class="optionhead">Required fields:</span> You must select or enter a GEDCOM tag for your event. If you choose "EVEN" (generic event) for
		your Tag, you must also enter a Type/Description. If you do not choose EVEN as your Tag, you must leave the Type/Description field blank. You must also enter a Display
		string.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="accept"><p class="subheadbold">Accept Selected / Ignore Selected</p></a>
		<p>To flag multiple types as <strong>Accept</strong> or <strong>Ignore</strong> at the same time, check the Select box next to each Event / Attribute Type
		to be updated, then click either the "Accept Selected" or "Ignore Selected" button at the top of the page.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="delete"><p class="subheadbold">Deleting Event / Attribute Types</p></a>
		<p>To delete one Event / Attribute Type, use the <a href="#search">Search</a> tab to locate the item, then click on the Delete icon next to that record. The row will
		change color and then vanish as the Event / Attribute Type is deleted. To delete more than one record at a time, check the box in the Select column next to each record to be
		deleted, then click the "Delete Selected" button at the top of the page.</p>

	</td>
</tr>

</table>
</body>
</html>
