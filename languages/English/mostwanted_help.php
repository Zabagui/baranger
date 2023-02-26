<?php
include("../../helplib.php");
echo help_header("Help: Most Wanted");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="misc_help.php" class="lightlink">&laquo; Help: Miscellaneous</a> &nbsp; | &nbsp;
			<a href="data_help.php" class="lightlink">Help: Import / Export &raquo;</a>
		</p>
		<span class="largeheader">Help: Most Wanted</span>
		<p class="smaller menu">
			<a href="#add" class="lightlink">Add New</a> &nbsp; | &nbsp;
			<a href="#edit" class="lightlink">Edit Existing</a> &nbsp; | &nbsp;
			<a href="#sort" class="lightlink">Sort</a> &nbsp; | &nbsp;
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

		<a name="add"><p class="subheadbold">Adding New Entries</p></a>
		<p>The <strong>Most Wanted</strong> feature allows you to make a list of critical people or photos you may be having trouble researching.
		The list is divided into two categories, <strong>Elusive People</strong> and <strong>Mystery Photos</strong>. To add a new entry to one of these
		categories, click on the "Add New" button under the appropriate heading, then fill out the form. Take note of the following:</p>

		<span class="optionhead">Title</span>
		<p>Give your entry a title, which may actually be a question. For example, <em>Who is this person?</em> or <em>Who is John Carlisle's father?</em></p>

		<span class="optionhead">Description</span>
		<p>Give your entry a short description as well. This could consist of any current evidence you've gathered, any brick walls you've run into,
		or some specific piece of information you're looking for.</p>

		<span class="optionhead">Tree</span>
		<p>If desired, you can associate this entry with a Tree (optional).</p>

		<span class="optionhead">Person</span>
		<p>If this entry is closely associated with a person, enter the Person ID or click on the magnifying glass icon to look it up. When you find the desired
		individual, click on the "Select" link to return to the Most Wanted form with the selected ID.</p>

		<span class="optionhead">Select Photo</span>
		<p>If this entry is closely associated with a photo, click on the "Select Photo" button to search for that photo from among the photo records
		already in your database. When you find the desired photo, click on the "Select" link to return to the Most Wanted form with the selected photo.</p>

		<p>When you are finished, click the "Save" button to return to the list. Your new entry will be added to the bottom of the category where you added it.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="edit"><p class="subheadbold">Editing Existing Entries</p></a>
		<p>To edit an existing entry, hold your mouse pointer over the entry to be edited. Links for "Edit" and "Delete" should appear for that entry. Click
		the "Edit" link to bring up the form where you can make your changes. All the fields are the same as the ones described above under "Adding New Entries".</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="sort"><p class="subheadbold">Sorting Entries</p></a>
		<p>To change the order of the Most Wanted entries you've created, just drag and drop them to the desired location (click on the "Drag" area, then hold the mouse down
		as you move your pointer to the desired location, then release the mouse button). </p>

		<p><strong>NOTE:</strong> You <strong>can</strong> drag and drop entries from one list to the other (e.g., drag an entry from "Elusive People" to "Mystery Photos").</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="delete"><p class="subheadbold">Deleting Existing Entries</p></a>
		<p>To delete an existing entry, hold your mouse pointer over the entry to be deleted. Links for "Edit" and "Delete" should appear for that entry. Click
		the "Delete" link to remove the entry (you will be asked to confirm your deletion before it is made final).</p>

	</td>
</tr>

</table>
</body>
</html>
