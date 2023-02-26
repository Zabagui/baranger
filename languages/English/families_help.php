<?php
include("../../helplib.php");
echo help_header("Help: Families");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="people_help.php" class="lightlink">&laquo; Help: People</a> &nbsp; | &nbsp;
			<a href="sources_help.php" class="lightlink">Help: Sources &raquo;</a>
		</p>
		<span class="largeheader">Help: Families</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Search</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Add New</a> &nbsp; | &nbsp;
			<a href="#edit" class="lightlink">Edit Existing</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Delete</a> &nbsp; | &nbsp;
			<a href="#review" class="lightlink">Review</a>
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
        <p>Locate existing families by searching for all or part of the <strong>Family ID</strong>, <strong>Father's Name</strong> or <strong>Mother's Name</strong>.
		Select a Tree or check "Exact match only" to further narrow your search. Select "Father's Name" to have your search criteria compared against all fathers' names.
		Select "Mother's Name" to have your search criteria compared against all mothers' names. Select "No Name" to search on Family ID.
		Searching with no options selected and no value in the search box will find all people in your database.</p>

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
		<a name="add"><p class="subheadbold">Adding New Families</p></a>
		<p>A <strong>Family</strong> is needed for every relationship between a "Father" and a "Mother" (children may or may not be included). If a person is married multiple times
		or has children with multiple partners, you should create a new Family for each set of spouses or partners.</p>

		<p>To add a new family,	click on the <strong>Add New</strong> tab, then fill out the form. Some information (notes, citations and
		additional events) can be added after saving or locking the record. Take note of the following:</p>

		<span class="optionhead">Tree</span>
		<p>If you have only one Tree, that tree will already be selected. Otherwise, please select the desired tree for the new family.</p>

		<span class="optionhead">Branch (optional)</span><br />
		<p>Assigning a family to a "Branch" limits access to the family's data to users who are also assigned to the same Branch. If at least one Branch has been
		defined and your user account is not assigned to a particular branch, you may elect to assign the new family to one or more of the existing branches. To select
		Branches, click on the "Edit" link to open a box with all Branch options for the selected Tree. Use the Control (Windows) or Command (Mac) key to select
		more than one branch. When you're done making your selection, move your mouse pointer out of the editing box and it will disappear.</p>

		<p><span class="optionhead">Family ID</span><br />
		<p>The Family ID must be unique within the selected Tree and should consist of an upper case <strong>F</strong> followed by a number (no more than 21 digits).
		An available, unique ID will be supplied when the page is first displayed and whenever a different tree is selected, but you may enter your own ID if desired.
		To check if the ID you have entered is unique, click the <strong>Check</strong> button. A message will appear to tell you if the ID is in use or not.
		To generate the next sequential unique ID, click <strong>Generate</strong>. This will locate the highest number in your database and add 1.
		To ensure that the displayed ID is not claimed by another user while you're entering the data, click the <strong>Lock</strong> button.</p>

		<p><strong>NOTE</strong>: If you are using this software in conjunction with a PC/Mac-based genealogy program which also creates IDs for new families,
		it is HIGHLY RECOMMENDED that keep all IDs in sync between the two programs at all times. Failure to do this may result in collisions and may also cause
		your media links to become unusable. If your desktop program creates IDs that do not conform to traditional standards (for example, the
		<strong>F</strong> is at the end, not the beginning), you can change the convention TNG uses in the General Settings.</p>

		<span class="optionhead">Spouses/Partners</span>
		<p>Select existing individuals to be the <strong>Father</strong> or <strong>Mother</strong> in this family by clicking "Find...", or create new individuals by
		clicking "Create". If you choose Create, you will be allowed to enter information for the new person without leaving the current page.
		After an individual is selected or created, the person's name and ID will appear in the
		Father or Mother field (it cannot be edited directly). To remove a spouse from the relationship (does not delete the spouse from the database),
		click the "Remove" button. To edit the spouse's individual record, click the "Edit" button.</p>

		<span class="optionhead">Living</span>
		<p>If one of the spouses is alive, or if you wish to restrict access to this family's data to users who are logged in with rights to see living data,
		check this box.</p>

		<span class="optionhead">Private</span>
		<p>Whether this family is tagged as Living or not, you can still restrict access to this family's data by checking this option. Only
		users with rights to see private data will be able to see information associated with a "private" family.</p>

		<span class="optionhead">Events</span>
		<p>Enter dates and places for the standard events listed (if known). Additional events can be added after the record is saved or locked. Always enter
		dates in the standard genealogical format, DD MMM YYYY (for example, <em>18 Feb 2008</em>). List place information from local to general, separating each locality by a
		comma (for example, <em>Boston, Suffolk, Massachusetts, USA</em>), or select an existing place name by clicking "Find" icon (magnifying glass).
		To limit the number of results found, enter part of the place name before clicking the Find icon. All results will contain what you entered in the place name.</p>

		<p><span class="optionhead">LDS Data (Sealed to Spouse)</span><br />
		This event is associated with an ordinance practiced in The Church of Jesus Christ of Latter-day Saints (the LDS church invented the GEDCOM standard).
		<strong>Note:</strong> If you prefer not to see the LDS fields, go to Setup/General Settings and turn them off there (requires that you logout and back in again).</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="edit"><p class="subheadbold">Editing Existing Families</p></a>
		<p>To make changes to an existing family, use the <a href="#search">Search</a> tab to locate the family, then click on the Edit icon next to that family.</p>

		<span class="optionhead">Notes / Citations / "More"</span>
		<p>Notes and citations may be linked to events or to the family in general by clicking on the associated icons at the top of the page
		or next to each event. "More" information for an event may also be added for an event by clicking on the "Plus" icon. When items exist in any of these
		categories, the corresponding icons will feature a green dot in the upper right corner. For more information on each category, see the Help links that
		become visible when the icons are clicked.</p>

		<span class="optionhead">Other Events</span>
		<p>To add or manage additional events, click on the "Add New" button next to <strong>Other Events</strong>. See the <a href="events_help.php">Help</a> link there for more
		information on adding new events. Once an event has been added, a short summary will be displayed in a table under the "Add New" button. Action buttons for
		each event allow you to edit or delete the event, or add notes or citations. The order in which the events are displayed is determined by date (if applicable),
		and by the event types' assigned priority (when no date is associated). This priority may be changed when editing the event types.

		<p><strong>Note</strong>: Notes, source citations, "Other" events and "More" information for standard events are all saved automatically. Other changes (e.g., to
		standard events) can be saved by clicking on the Save button at the bottom of the page, or by clicking on the Save icon at the top of the page. The Tree and
		Family ID cannot be changed.</p>

		<p><span class="optionhead">Children</span><br />
		<p>Select existing individuals to be children in this family by clicking "Find", or create new children by clicking
		"Create". If you choose Create, you will be allowed to enter information for the new person without leaving the current page.
		After an individual is selected or created, the person's Name, ID and birth date will appear in the Children list. That list cannot be
		edited directly, but you can use the "Remove" link (visible when your mouse pointer is over each child) to remove a child from the list. You can
		also use the "Delete" link to delete the child from the database entirely. You can use the "Delete" button to delete a
		child from the database, or the "Edit" button to modify the child's individual record.</p>

		<span class="optionhead">Sorting Parents or Spouses</span>
        <p>If more than one child exists,
		you may change the order by "dragging" the blocks up and down. To drag, click your mouse on the "Drag" box and hold down the button, then move your mouse up or
		down on the page. Let go of the mouse button when the block appears in the desired location. Sorting changes are saved automatically.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="delete"><p class="subheadbold">Deleting Families</p></a>
		<p>To delete one family, use the <a href="#search">Search</a> tab to locate the individual, then click on the Delete icon next to that family. The row will
		change color and then vanish as the family is deleted (the spouses and children will not be deleted, but the relationship will be disssolved).
		To delete more than one family at a time, check the box in the Select column next to each family to be
		deleted, then click the "Delete Selected" button	at the top of the page.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="review"><p class="subheadbold">Reviewing Tentative Edits</p></a>
        To review tentative edits made by other users, click on the "Review" tab. You will decide whether to keep or delete these proposed changes. Choose to review by tree, by user or both.
		No e-mail message is sent when tentative edits are submitted, but an asterisk (*) will appear on the Review tab if new edits are present.</p>

		<span class="optionhead">Select Event and Action</span><br />
		<p>Locate the line in the table that describes the event you wish to review or delete. You can narrow the list of results by selecting a User (the person
		responsible for the proposed change) and/or the Tree. When the results are displayed, click on one of the possible actions listed at the left of that line. To review and
		possibly incorporate the changes, choose <em>Review</em>. To discard the proposed change, choose <em>Delete</em>.</p>

		<span class="optionhead">Review</span><br />
		<p>On the Review screen, make any additional changes, including any to notes or sources you find necessary, then click "Save and Delete" to
		make the changes permanent and remove the tentative record. You may also choose to remove the tentative record without saving by clicking "Ignore and Delete",
		or you can postpone the decision until later by clicking "Postpone".</p>

	</td>
</tr>

</table>
</body>
</html>
