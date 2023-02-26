<?php
include("../../helplib.php");
echo help_header("Help: Branches");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="trees_help.php" class="lightlink">&laquo; Help: Trees</a> &nbsp; | &nbsp;
			<a href="eventtypes_help.php" class="lightlink">Help: Event / Attribute Types &raquo;</a>
		</p>
		<span class="largeheader">Help: Branches</span>
		<p class="smaller menu">
			<a href="#what" class="lightlink">What are they?</a> &nbsp; | &nbsp;
			<a href="#search" class="lightlink">Search</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Add or Edit</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Delete</a> &nbsp; | &nbsp;
			<a href="#label" class="lightlink">Label</a>
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

		<a name="what"><p class="subheadbold">What is a Branch?</p></a>
		<p>A <strong>Branch</strong> is a set of individuals within a tree that all share a common label. This label allows TNG to restrict access to these labeled
		individuals based on user permissions. In other words, users who are assigned to a particular Branch will have their rights restricted
		to the people and families in that Branch. An individual in the database may belong to more than one Branch. Users may only be assigned to
		a single Branch at most, but this restriction can be circumvented by creating a "dummy" Branch whose label is actually a substring of
		more than one other label. For example, a user assigned to the "smith" Branch would have rights to both the "blacksmith" and "smithson" Branches because
		both names contain the word "smith".</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="search"><p class="subheadbold">Search</p></a>
        <p>Locate existing Branches by searching for all or part of the <strong>Branch ID</strong> or <strong>Description</strong>. Select a Tree to further narrow your search.
		Searching with no options selected and no value in the search box will find all Branches in your database.</p>

		<p>Your search criteria for this page will be remembered until you click the <strong>Reset</strong> button, which restores all default values and searches again.</p>

		<span class="optionhead">Actions</span>
		<p>The Action buttons next to each search result allow you to edit, delete or add labels to that Branch. To delete more than one Branch at a time, click the box in the
		<strong>Select</strong> column for each Branch to be deleted, then click the "Delete Selected" button at the top of the list. Use the <strong>Select All</strong> or <strong>Clear All</strong>
		buttons to toggle all select boxes at once.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="add"><p class="subheadbold">Add New / Edit Existing Branches</p></a>
		<p>To add a new Branch, click on the <strong>Add New</strong> tab, then fill out the form.
		Take note of the following:</p>

		<span class="optionhead">Branch ID</span>
		<p>This should be a short, unique, one-word identifier for the Branch. Do not include non-alphanumeric characters (stick to numbers and letters), and do not use spaces.
		This information will not appear anywhere, so it can be all lowercase. 20 character max.</p>

		<span class="optionhead">Description:</span>
		<p>This can be a longer description of this Branch or the data it contains.</p>

		<span class="optionhead">Starting Individual</span>
		<p>Enter or find the ID of the individual with whom your branch begins. All
		partial branches are defined by a starting individual and a number of ancestral or descendant generations from that individual. You can add additional names
		by repeating this process and picking a different "Starting Individual". When you save your branch, only the most recent Starting Individual will be remembered,
		but all labels added previously will not be affected.</p>

		<span class="optionhead">Number of Generations</span>
		<p>Indicate the number of generations back (Ancestors) or forward (Descendants) from the starting individual that you wish to label. When
		labeling ancestors, you can also indicate how many descendant generations to label in from each ancestor.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="delete"><p class="subheadbold">Deleting Branches</p></a>
		<p>To delete a Branch, use the <a href="#search">Search</a> tab to locate the Branch, then click on the Delete icon next to that Branch record. The row will
		change color and then vanish as the Branch is deleted. To delete more than one Branch at a time, check the box in the Select column next to each Branch to be
		deleted, then click the "Delete Selected" button at the top of the page.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="label"><p class="subheadbold">Labeling Branches</p></a>
		<p>To assign a branch label to individuals in your database, click on the <strong>Add labels</strong> button at the bottom of the Edit Branch page,
		then follow the instructions in the window you see next. After selecting options, click the "Add labels" button at the bottom. Options on that page include:</p>

		<span class="optionhead">Action</span>
		<p>Choose whether you'll be adding new labels, clearing existing labels or deleting people with the selected branch label. If you're clearing labels
		or deleting individuals, then you will also choose whether this action will cover your entire tree ("All") or just the records that match the criteria selected ("Partial"). 
		IMPORTANT: If you choose "Delete", the people will also be deleted, not just the branch labels! There is no "undo" option, so you might want to back up
		your tables before you begin.
		</p>

		<span class="optionhead">Existing labels</span>
		<p>Your selection here determines what to do if any of the people you selected
		for labeling already have a branch label. You may elect to leave the existing label(s) untouched, you may
		choose to overwrite what's there, or you can decide to append the new label. If you choose the last option,
		the affected individual(s) will	now belong to multiple branches.</p>

	<span class="optionhead">Show people with this tree/branch (label):</span>
		<p>Click this button to display all individuals who already have
		the selected branch label within the selected tree. From the display, click the Add Labels link
		to return to the previous page, or click on any individual to edit their personal record.</p>
	</td>
</tr>

</table>
</body>
</html>
