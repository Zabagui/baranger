<?php
include("../../helplib.php");
echo help_header("Help: People");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="index_help.php" class="lightlink">&laquo; Help: Getting Started</a> &nbsp; | &nbsp;
			<a href="families_help.php" class="lightlink">Help: Families &raquo;</a>
		</p>
		<span class="largeheader">Help: People</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Search</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Add New</a> &nbsp; | &nbsp;
			<a href="#edit" class="lightlink">Edit Existing</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Delete</a> &nbsp; | &nbsp;
			<a href="#review" class="lightlink">Review</a> &nbsp; | &nbsp;
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
        <p>Locate existing individuals by searching for all or part of the <strong>Person ID</strong> or <strong>Name</strong>. Select a Tree or check one of the other options to further narrow your search.
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
		<a name="add"><p class="subheadbold">Adding New People</p></a>
		<p>To add a new person, click on the <strong>Add New</strong> tab, then fill out the form. Some information (notes, citations, associations and
		additional events) can be added after saving or locking the record. Take note of the following:</p>

		<span class="optionhead">Tree</span>
		<p>If you have only one Tree, that tree will already be selected. Otherwise, please select the desired tree for the new individual.</p>

		<span class="optionhead">Branch (optional)</span>
		<p>Assigning a person to a "Branch" limits access to the person's data to users who are also assigned to the same Branch. If at least one Branch has been
		defined and your user account is not assigned to a particular branch, you may elect to assign the new person to one or more of the existing branches. To select
		Branches, click on the "Edit" link to open a box with all Branch options for the selected Tree. Use the Control (Windows) or Command (Mac) key to select
		more than one branch. When you're done making your selection, move your mouse pointer out of the editing box and it will disappear.</p>

		<span class="optionhead">Person ID</span>
		<p>The Person ID must be unique within the selected Tree and should consist of an upper case <strong>I</strong> followed by a number (no more than 21 digits).
		An available, unique ID will be supplied when the page is first displayed and whenever a different tree is selected, but you may enter your own ID if desired.
		To check if the ID you have entered is unique, click the <strong>Check</strong> button. A message will appear to tell you if the ID is in use or not.
		To generate the next sequential unique ID, click <strong>Generate</strong>. This will locate the highest number in your database and add 1.
		To ensure that the displayed ID is not claimed by another user while you're entering the data, click the <strong>Lock</strong> button.</p>

		<p><strong>NOTE</strong>: If you are using this software in conjunction with a PC/Mac-based genealogy program which also creates IDs for new individuals,
		it is HIGHLY RECOMMENDED that you keep all IDs in sync between the two programs at all times. Failure to do this may result in collisions and may also cause
		your media links to become unusable. If your desktop program creates IDs that do not conform to traditional standards (for example, the
		<strong>I</strong> is at the end, not the beginning), you can change the convention TNG uses in the General Settings.</p>

		<span class="optionhead">Name</span>
		<p>Enter the individual's First/Given Name(s) and/or Last/Surname. Middle names should be included with First/Given Name(s). If you have elected to support
		surname prefixes as a separate entity (so the prefixes are ignored during sorting), enter the prefix portion in the box labeled Surname Prefix.
		<strong>Note:</strong> If this box is not visible, go to Setup/General Settings and check the option to use surname prefixes.</p>

		<span class="optionhead">Nickname / Title / Prefix / Suffix / Name Order</span>
		<p>Enter as much of this information as you have available. A <strong>Nickname</strong> is an informal name sometimes associated with the individual.
		A <strong>Title</strong> is used in front of the name (e.g., <em>Sir</em> or <em>Captain</em>) but is not part of the name. A <strong>Prefix</strong> is used in front of the name and is usually considered part of the
		name. A <strong>Suffix</strong> is used after the name (e.g., <em>M.D.</em> or <em>Esquire</em>). Use <strong>Name Order</strong> to change how this name should be displayed.
		You can change the Name Order for all people in your database under Setup/General Settings.</p>

		<span class="optionhead">Gender</span>
		<p>Choose Unknown, Male, Female or Other. If Other is chosen, a new field will appear to the right where you may enter the preferred gender description.</p>

		<span class="optionhead">Living</span>
		<p>If this person is alive, or if you wish to restrict access to this person's data to users who are logged in with rights to see living data,
		check this box.</p>

		<span class="optionhead">Private</span>
		<p>Whether this person is alive or not, you can still restrict access to this person's data by checking this option. Only
		users with rights to see private data will be able to see information associated with a "private" person.</p>

		<span class="optionhead">Events</span>
		<p>Enter dates and places for the standard events listed (if known). Additional events can be added after the record is saved or locked. Always enter
		dates in the standard genealogical format, DD MMM YYYY (for example, <em>18 Feb 2008</em>). List place information from local to general, separating each locality by a
		comma (for example, <em>Boston, Suffolk, Massachusetts, USA</em>), or select an existing place name by clicking "Find" icon (magnifying glass).
		To limit the number of results found, enter part of the place name before clicking the Find icon. All results will contain what you entered in the place name.</p>

		<p>Note on Alternate Birth events: The default alternate birth event type is "Christening". The Christening field may be turned off altogether from Setup/General Settings/Site Design & Definition, but you may also choose there to enter the GEDCOM tag(s) for other alternate birth events. For example, if you enter "CHR,BAPM" as alternate birth event types, the user may choose to designate either Christening or Baptism as the alternate birth event for an individual. The order also indicates which event type is preferred as default.

		<p><span class="optionhead">LDS Data (Baptism, Confirmation, Initiatory, Endowment)</span><br />
		These events are associated with ordinances practiced in The Church of Jesus Christ of Latter-day Saints (the LDS church invented the GEDCOM standard).
		<strong>Note:</strong> If you prefer not to see the LDS fields, go to Setup/General Settings/Privacy and turn them off there (requires that you logout and back in again).</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="edit"><p class="subheadbold">Editing Existing People</p></a>
		<p>To make changes to an existing person, use the <a href="#search">Search</a> tab to locate the individual, then click on the Edit icon next to that individual.</p>

		<span class="optionhead">Notes / Citations / Associations / "More"</span>
		<p>Notes, citations and associations may be linked to events or to the person in general by clicking on the associated icons at the top of the page
		or next to each event. "More" information for an event may also be added for an event by clicking on the "Plus" icon. When items exist in any of these
		categories, the corresponding icons will feature a green dot in the upper right corner. For more information on each category, see the Help links that
		become visible when the icons are clicked.</p>

		<span class="optionhead">Other Events / Attributes</span>
		<p>To add or manage additional events, click on the "Add New" button next to <strong>Other Events / Attributes</strong>. See the <a href="events_help.php">Help</a> link there for more
		information on adding new events or attributes. Once an event or attribute has been added, a short summary will be displayed in a table under the "Add New" button. Action buttons for
		each event allow you to edit or delete the event, or add notes or citations. The order in which the events are displayed is determined by date (if applicable),
		and by the event types' assigned priority (when no date is associated). This priority may be changed when editing the event types.

		<p><strong>Note</strong>: Notes, source citations, associations, "Other" events and "More" information for standard events are all saved automatically. Other changes (e.g., to the Name or
		standard events) can be saved by clicking on the Save button at the bottom of the page, or by clicking on the Save icon at the top of the page. The Tree and
		Person ID cannot be changed.</p>

		<span class="optionhead">Parents</span>
		<p>If the current individual has parents, a <strong>Parents</strong> section will be present under the Events section. It will start out collapsed and will indicate the number
		of parent sets in parentheses. To expand the section and view all sets of parents, click on the word "Parents" or the arrow next to it. Some information, including the nature of the
		relationship between the current individual and each set of parents, may be edited in each block. When your mouse pointer is over a set of parents, an <strong>Unlink</strong>
		option will be visible in the upper right corner. Click that link to unlink the current individual from that set of parents.</p>

		<p>You can add a new set of parents for the current individual by clicking the <strong>Add New</strong> link next to
		the Parents section. At that point you will see a popup message asking if you want to save your changes first ("OK" or "Cancel"). 
		If you choose "OK", then the page will be saved and then you will be taken to a New Family page with the current
		individual listed as a child. If you choose "Cancel", no changes will be saved, but you will still be directed to
		the New Family page with the current individual as a child. You will then have the chance to enter or select the new
		parents and provide details about the new family.</p>
		
		<p>You can also add new parents by selecting the option "Go to new family with current individual as child" at the bottom of 
		the page.</p>
		
		<span class="optionhead">Spouses/Partners</span>
		<p>If the current individual has at least one spouse or partner, a <strong>Spouses/Partners</strong> section will be present under the Parents section. It will start out collapsed and will indicate the number
		of spouses/partners in parentheses. To expand the section and view all spouses or partners, click on the words "Spouses/Parters" or the arrow next to them. When your mouse pointer is over a spouse/partner, an <strong>Unlink</strong>
		option will be visible in the upper right corner. Click that link to unlink the current individual from that spouse or partner.</p>

		<p>You can add a new spouse or partner for the current individual by clicking the <strong>Add New</strong> link next to
		the Spouses section. At that point you will see a popup message asking if you want to save your changes first ("OK" or "Cancel"). 
		If you choose "OK", then the page will be saved and then you will be taken to a New Family page with the current
		individual listed as either the husband or the wife (depending on the gender of the current individual). If you choose 
		"Cancel", no changes will be saved, but you will still be directed to the New Family page with the current individual 
		as a spouse. You will then have the chance to enter or select the new spouse and provide details about the new family.</p>
		
		<p>You can also add new a new spouse by selecting the option "Go to new family with current individual as spouse" at the bottom of 
		the page.</p>
		
		<span class="optionhead">Sorting Parents or Spouses</span>
        	<p>If more than one spouse or set of parents exists,
		you may change the order by "dragging" the blocks up and down. To drag, click your mouse on the "Drag" box and hold down the button, then move your mouse up or
		down on the page. Let go of the mouse button when the block appears in the desired location. Sorting changes are saved automatically.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="delete"><p class="subheadbold">Deleting People</p></a>
		<p>To delete one person, use the <a href="#search">Search</a> tab to locate the individual, then click on the Delete icon next to that individual. The row will
		change color and then vanish as the person is deleted. To delete more than one person at a time, check the box in the Select column next to each person to be
		deleted, then click the "Delete Selected" button at the top of the page.</p>

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
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="merge"><p class="subheadbold">Merging People</p></a>
		To review and merge duplicate records, click on the "Merge" tab. You will decide whether two records are the same or not.</p>

		<span class="optionhead">Find Matches</span><br />
		<p>First, select a tree. You cannot merge individuals from different trees, so only one tree can be selected. After that, you have the option of selecting an individual as
		the starting point for your search (Person 1), or letting TNG find the first match for you. If you'd rather let TNG find all matches, leave the Person ID 1 field blank</p>
		<p>If you selected an individual as Person 1, you may also decide to manually select Person ID 2. If you'd rather let TNG find duplicates for Person 1, leave Person ID 2 blank.</p>

		<span class="optionhead">Match the following fields</span><br />
		<p>These are the criteria TNG will use in determining possible matches. By default, First Name and Last Name are selected, meaning that those fields
		must match in order for two records to be considered a possible match. If you also select Birth Date, Birth Place, Death Date, and/or Death Place, those fields must also match.</p>

		<span class="optionhead">Other Options</span><br />
        <p><em>Ignore Blanks</em> means that blank fields will not be considered. For example, someone with a Last Name but no First Name
		will not match any other records if First Name is among the selected criteria.</p>

        <p><em>Use Soundex</em> means that the MySQL Soundex function will be used when comparing names. In
		this case, "Blakely" could be considered a match for "Blackley".</p>

        <p><em>Combine Notes &amp; Citations</em> means that notes and citations from Person 2 will be added to the notes and citations
		from Person 1 for all merged fields. If this option is not selected and a field from Person 2 is checked, the notes and citations from Person 2 for that field will overwrite those
		for the corresponding field from Person 1.</p>

		<p><em>Combine Photos &amp; Histories</em> means that photos and histories from Person 2 will be kept and added to those already existing for
		Person 1 if the two are merged. If this option is not selected, all photo, history &amp; headstone links for Person 2 will be deleted after the merge.</p>

		<p><span class="optionhead">Warning!</span> Once a merge has taken place, it cannot be undone! <em>Please consider backing up your database tables before
		performing any merge operations</em>, just in case you merge two individuals unintentionally.</p>

		<span class="optionhead">Next Match</span><br />
		<p>Find the next possible match that does not involve Person 1. TNG traverses the list of possible individuals as ordered by Person ID in string format.
		This means that "10" comes after "1" but before "2".</p>

		<span class="optionhead">Next Duplicate</span><br />
		<p>Find the next possible duplicate for Person 1. If this results in no record being displayed for Person 2, it means that a duplicate was not found.</p>

		<span class="optionhead">Compare/Refresh.</span><br />
		<p>Compare Person 1 and Person 2. If that comparison is already displayed, clicking this button will cause the page to refresh.</p>

		<span class="optionhead">Switch</span><br />
		<p>Person 1 becomes Person 2 and vice versa.</p>

		<span class="optionhead">Merge</span><br />
		<p>Person 2 is merged into Person 1. The ID for Person 1 will be retained, as will all other data for Person 1 unless the corresponding box(es) for
		are checked for Person 2. For example, if the box next to Birth Date is checked for Person 2, this data in this field will be copied from Person 2's record to Person 1's record
		during the merge. Corresponding data for Person 1 will then be deleted. Boxes for Person 2 are checked automatically when no corresponding data exists for Person 1. If
		a data field is not displayed for either Person 1 or Person 2, then no data exists in that field for either individual.</p>

		<span class="optionhead">Edit</span><br />
		<p>Edit the individual record for that individual in a new window. If changes are made, you must click Compare/Refresh in order to see the changes
		in on the Merge screen.</p>
	</td>
</tr>

</table>
</body>
</html>