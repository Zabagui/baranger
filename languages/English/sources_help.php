<?php
include("../../helplib.php");
echo help_header("Help: Sources");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="families_help.php" class="lightlink">&laquo; Help: Families</a> &nbsp; | &nbsp;
			<a href="repositories_help.php" class="lightlink">Help: Repositories &raquo;</a>
		</p>
		<span class="largeheader">Help: Sources</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Search</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Add New</a> &nbsp; | &nbsp;
			<a href="#edit" class="lightlink">Edit Existing</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Delete</a> &nbsp; | &nbsp;
			<a href="#merge" class="lightlink">Merge</a>
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
        <p>Locate existing sources by searching for all or part of the <strong>Source ID, Source Title, Author, Call Number</strong> or <strong>Publisher</strong>.
		Select a Tree or check "Exact match only" to further narrow your search.
		Searching with no options selected and no value in the search box will find all sources in your database.</p>

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
		<a name="add"><p class="subheadbold">Adding New Sources</p></a>
		<p>A <strong>Source</strong> is any form of evidence cited to prove or substantiate any part of your data. The same source may be cited multiple times
		for multiple individuals, families or events.</p>

		<p>To add a new source, click on the <strong>Add New</strong> tab, then fill out the form. Some information (notes and
		additional events) can be added after saving or locking the record. Take note of the following:</p>

		<span class="optionhead">Tree</span>
		<p>If you have only one Tree, that tree will already be selected. Otherwise, please select the desired tree for the new source.</p>

		<span class="optionhead">Source ID</span>
		<p>The Source ID must be unique within the selected Tree and should consist of an upper case <strong>S</strong> followed by a number (no more than 21 digits).
		An available, unique ID will be supplied when the page is first displayed and whenever a different tree is selected, but you may enter your own ID if desired.
		To check if the ID you have entered is unique, click the <strong>Check</strong> button. A message will appear to tell you if the ID is in use or not.
		To generate the next sequential unique ID, click <strong>Generate</strong>. This will locate the highest number in your database and add 1.
		To ensure that the displayed ID is not claimed by another user while you're entering the data, click the <strong>Lock</strong> button.</p>

		<p><strong>NOTE</strong>: If you are using this software in conjunction with a PC/Mac-based genealogy program which also creates IDs for new sources,
		it is HIGHLY RECOMMENDED that keep all IDs in sync between the two programs at all times. Failure to do this may result in collisions and may also cause
		your media links to become unusable. If your desktop program creates IDs that do not conform to traditional standards (for example, the
		<strong>S</strong> is at the end, not the beginning), you can change the convention TNG uses in the General Settings.</p>

		<span class="optionhead">Short Title</span>
		<p>An abbreviated title for the source.</p>

		<span class="optionhead">Long Title</span>
		<p>A more formal, longer title for the source.</p>

		<span class="optionhead">Author, Call Number, Publisher</span><br />
		<p>Additional information related to the source (if available).</p>

		<span class="optionhead">Repository</span><br />
		<p>Select the repository where the source resides (if known). If the repository does not yet exist in the database, go to Admin/Repositories and
		add it there, then come back and select it here.</p>

		<span class="optionhead">Actual Text</span><br />
		<p>A quote from or a portion of the source material (optional).</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="edit"><p class="subheadbold">Editing Existing Sources</p></a>
		<p>To make changes to an existing source, use the <a href="#search">Search</a> tab to locate the source, then click on the Edit icon next to that source.</p>

		<span class="optionhead">Notes</span>
		<p>Notes may be linked to events or to the source in general by clicking on the Notes icon at the top of the page
		or next to each event under "Other Events". When notes already exist for an event, the Notes icon will feature a green dot in the upper right corner.
		For more information on Notes, see the <a href="notes_help.php">Help</a> link visible in the Notes area.</p>

		<span class="optionhead">Other Events</span>
		<p>To add or manage additional events, click on the "Add New" button next to <strong>Other Events</strong>. See the <a href="events_help.php">Help</a> link there for more
		information on adding new events. Once an event has been added, a short summary will be displayed in a table under the "Add New" button. Action buttons for
		each event allow you to edit or delete the event, or add notes. The order in which the events are displayed is determined by date (if applicable),
		and by the event types' assigned priority (when no date is associated). This priority may be changed when editing the event types.

		<p><strong>Note</strong>: Notes and changes to "Other" events are all saved automatically. Other changes (e.g., to
		standard events) can be saved by clicking on the Save button at the bottom of the page, or by clicking on the Save icon at the top of the page. The Tree and
		Source ID cannot be changed.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="delete"><p class="subheadbold">Deleting Sources</p></a>
		<p>To delete one source, use the <a href="#search">Search</a> tab to locate the source, then click on the Delete icon next to that source. The row will
		change color and then vanish as the source is deleted (all associated citations will also be deleted).
		To delete more than one source at a time, check the box in the Select column next to each source to be
		deleted, then click the "Delete Selected" button	at the top of the page.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="merge"><p class="subheadbold">Merge</p></a>
		<p>Click on this tab to review and merge sources that may be slightly different but refer to the same material.
		You will decide whether multiple records are the same or not.</p>
		
		<span class="optionhead">Find Matches</span>
		<p>First, select a tree. You cannot merge sources from different trees, so only one tree can be selected. After that, you have the option of selecting
		a source as the starting point for your search (Source ID 1), or letting TNG find the first match for you. If you'd rather let TNG find all matches,
		leave the Source ID 1 field blank.</p>
		
		<p>If you selected a source as Source ID 1, you may also decide to manually select Source ID 2. If you'd rather let TNG find duplicates for Source ID 1,
		leave Source ID 2 blank.</p>

		<span class="optionhead">Match the following fields</span>
		<p>These are the criteria TNG will use in determining possible matches. By default, Short Title and (Long) Title are selected, meaning that those fields
		must match in order for two records to be considered a possible match. If you also select Author, Publisher, Repository, or Actual Text, then those fields
		must also match.</p>

		<span class="optionhead">Other Options</span>
		<p><em>Ignore Blanks</em> means that blank fields will not be considered. For example, a source with a Short Title but no Title
		will not match any other records if Title is among the selected criteria.</p>

        <p><em>Combine Notes</em> means that notes from Source 2 will
		be added to the notes from Source 1 for all merged fields. If this option is not selected and a field from Source 2 is checked, the notes from Source 2
		for that field will overwrite those	for the corresponding field from Source 1.</p>

        <p><em>Combine Media</em> means that media from Source 2
		will be kept and added to the media already existing for Source 1 if the two are merged. If this option is not selected, all media links for Source 2
		will be deleted after the merge.</p>

		<p><strong>Warning!</strong> Once a merge has taken place, it cannot be undone! Please consider backing up your database tables before performing any merge operations, just
		in case you merge two individuals unintentionally.</p>

		<span class="optionhead">Next Match</span>
		<p>Find the next possible match that does not involve Source 1. TNG traverses the list of possible sources as ordered by Source ID in string format.
		This means that "10" comes after "1" but before "2".</p>

		<span class="optionhead">Next Duplicate</span>
		<p>Find the next possible duplicate for Source 1. If this results in no record being displayed for Source 2, it means that a duplicate was not found.</p>
		
		<span class="optionhead">Compare/Refresh</span><br />
		<p>Compare Source 1 and Source 2. If that comparison is already displayed, clicking this button will cause the page to refresh.</p>

		<span class="optionhead">Switch</span><br />
		<p>Source 1 becomes Source 2 and vice versa.</p>
		
		<span class="optionhead">Merge</span><br />
		<p>Source 2 is merged into Source 1. The ID for Source 1 will be retained, as will all other data for Source 1 unless the corresponding box(es)
		for are checked for Source 2. For example, if the box next to Author is checked for Source 2, this data in this field will be copied from Source 2's
		record to Source 1's record during the merge. Corresponding data for Source 1 will then be deleted. Boxes for Source 2 are checked automatically
		when no corresponding data exists for Source 1. If	a data field is not displayed for either Source 1 or Source 2, then no data exists in that field
		for either individual.</p>

		<span class="optionhead">Edit</span><br />
		<p>Edit the record for that source in a new window. If changes are made, you must click "Compare/Refresh" in order to see the changes
		in on the Merge screen.</p>

	</td>
</tr>

</table>
</body>
</html>
