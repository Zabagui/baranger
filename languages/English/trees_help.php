<?php
include("../../helplib.php");
echo help_header("Help: Trees");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="users_help.php" class="lightlink">&laquo; Help: Users</a> &nbsp; | &nbsp;
			<a href="branches_help.php" class="lightlink">Help: Branches &raquo;</a>
		</p>
		<span class="largeheader">Help: Trees</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Search</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Add or Edit</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Delete</a> &nbsp; | &nbsp;
			<a href="#clear" class="lightlink">Clear</a>
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
	    <p>Locate existing Trees by searching for all or part of the <strong>Tree ID, Tree Name, Description</strong> or <strong>Owner</strong>.
		Searching with no value in the search box will find all Trees in your database.</p>

		<p>Your search criteria for this page will be remembered until you click the <strong>Reset</strong> button, which restores all default values and searches again.</p>

		<span class="optionhead">Actions</span>
		<p>The Action buttons next to each search result allow you to edit, delete or clear that Tree.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="add"><p class="subheadbold">Add New / Edit Existing Trees</p></a>
		<p>A <strong>Tree</strong> in TNG is a container for any independent set of family data. TNG allows you to support multiple Trees on your site, but since
		Trees are independent, you cannot link a person in one tree to any person or family in another tree. For that reason, any people that are or could be linked
		together should be kept in the same tree.</p>

		<p><strong>NOTE: You must add a tree before you can enter or import data</strong> for individuals, families, sources or repositories. If you upgraded from a
		previous version that did not support trees, your data will be associated with a default tree that has a blank Tree ID. You may edit the other information
		for this tree, but the Tree ID will remain blank (will work just fine).</p>

		<p>To add a new Tree, click on the <strong>Add New</strong> tab, then fill out the form.
		Take note of the following:</p>

		<span class="optionhead">Tree ID</span>
		<p>A short, unique, one-word identifier for the tree. Do not include non-alphanumeric characters (stick to numbers and letters), and do not use spaces.
		This information will not appear anywhere except in the address line of your browser, so it can be all lowercase. You will not be able to change this later.
		20 character max.</p>

		<span class="optionhead">Tree Name</span>
		<p>A short display name or phrase to identify this tree. This will appear in all tree selection boxes, and will be the name by which visitors know this tree.</p>

		<span class="optionhead">Description:</span>
		<p>A longer description of this tree or the data it contains.</p>

		<span class="optionhead">Owner:</span>
		<p>The person or organization who created or assembled the data in this tree, or the person or organization responsible for maintaining it.</p>

		<span class="optionhead">E-mail:</span>
		<p>The owner's e-mail address. Suggestions pertaining to people in this tree will be sent to this address, if it exists (otherwise, suggestions
		will be sent to the address listed in the General Settings).</p>

		<span class="optionhead">Address/City/State/ZIP/Postal Code/Country/Phone:</span>
		<p>The owner's contact information.</p>

		<span class="optionhead">Keep owner information private</span>
		<p>Check this box to hide the e-mail address and other contact information for this tree's owner (for visitors in the public area).</p>

		<span class="optionhead">Don't allow users to download GEDCOM files</span>
		<p>Check this box to prevent visitors from downloading GEDCOM files from this tree.</p>

		<span class="optionhead">Don't allow users to create PDF files</span>
		<p>Check this box to prevent visitors from creating PDF files from this tree.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="delete"><p class="subheadbold">Deleting Trees</p></a>
		<p>To delete a Tree, use the <a href="#search">Search</a> tab to locate the Tree, then click on the Delete icon next to that Tree record. The row will
		change color and then vanish as the Tree is deleted. <em>All data associated with the Tree (including people, families,
		sources, repositories, media and branches) will all be deleted</em>.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="clear"><p class="subheadbold">Clearing Trees</p>
		To "clear" a tree (delete all data but leave the Tree itself), use the <a href="#search">Search</a> tab to locate the Tree, then click on the Clear icon next to that Tree record.
		<em>All data associated with the tree (including people, families, sources, repositories, media and branches) will all be deleted</em>.</p>

	</td>
</tr>

</table>
</body>
</html>
