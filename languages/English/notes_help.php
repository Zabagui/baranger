<?php
include("../../helplib.php");
echo help_header("Help: Notes");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="assoc_help.php" class="lightlink">&laquo; Help: Associations</a> &nbsp; | &nbsp;
			<a href="citations_help.php" class="lightlink">Help: Citations &raquo;</a>
		</p>
		<span class="largeheader">Help: Notes</span>
		<p class="smaller menu">
			<a href="#add" class="lightlink">Add/Edit/Delete</a> &nbsp; | &nbsp;
			<a href="#cite" class="lightlink">Citations</a>
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

		<a name="add"><p class="subheadbold">Adding/Editing/Deleting Notes</p></a>

		<p>To add, edit or delete notes for a person, family, source, repository or event, click on the Notes icon at the top of the screen or next to any event (if notes already exist,
		a green dot will be present on the icon). When the icon is clicked, a small popup will appear showing
		all notes existing for the active entity or event.</p>

		<p>To add a new note, click on the "Add New" button and fill out the form. If the selected entity or event did not have any previous
		notes, you will be sent directly to the "Add New Note" screen.</p>

		<p>To edit or delete an existing note, click on the appropriate icon next to that note.</p>

		<p>While adding or editing a note, please enter your note or make your changes in the large <strong>Note</strong> field and click the "Save" button. Notes are saved at that point, even if other
		information for the active entity is not. You may enter HTML code in the field. PHP and Javascript code will not work.</p>

		<p>To sort notes, click anywhere in the row (not on one of the icons) and drag the note up or down.</p>

		<span class="optionhead">Private</span>
		<p>Check this box to prevent the note from being displayed in the public area. This is independent of any Private tag you may have associated with a person
		or family.</p>


	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="cite"><p class="subheadbold">Adding Source Citations for Notes</p></a>
		<p>To add or edit source citations for a note, first save the note, then click the Citations icon next to that note record in the current list of notes
		For more information on citations, please see <a href="citations_help.php">Help: Citations</a>.</p>

	</td>
</tr>

</table>
</body>
</html>
