<?php
include("../../helplib.php");
echo help_header("Help: Data Import");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="mostwanted_help.php" class="lightlink">&laquo; Help: Most Wanted</a> &nbsp; | &nbsp;
			<a href="second_help.php" class="lightlink">Help: Post-Import Utilities &raquo;</a>
		</p>
		<span class="largeheader">Help: Import / Export</span>
		<p class="smaller menu">
			<a href="#import" class="lightlink">GEDCOM Import</a> &nbsp; | &nbsp;
			<a href="#export" class="lightlink">GEDCOM Export</a>
		</p>
	</td>
</tr>
<tr>
	<td class="tngshadow databack">
		<div id="google_translate_element" style="float:right"></div><script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
		}
		</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

		<a name="import"><p class="subheadbold">GEDCOM Import</p></a>
		<p>This page allows you to import all data from a standard GEDCOM file into a particular tree.</p>

		<p><span class="optionhead">Before Importing:</span> Use your desktop genealogy software to create a standard GEDCOM file (5.5 or 7.0 are preferred, but 4.0 will also work). You may choose to exclude
		private information for living individuals, but this is not necessary. It is also not necessary to exclude LDS information, as this can be filtered as well depending on user rights.</p>

		<p>After you've created your GEDCOM file, the next step is to get it to your web site. Please take note of the following items on the page:</p>

		<p><span class="optionhead">Import GEDCOM From your computer</span>
		To upload and import your file to your site without using FTP, click on the "Browse" button and locate the file on your hard drive. The name and path of your file will appear in this field after you select it.
		<strong>NOTE</strong>: If your GEDCOM file is large (> 2Mb), you can try "zipping" it first (TNG will automatically extract the file after it is uploaded). If the resulting file is still large, you might need to check with your hosting provider before you can upload your file this way, as the server may have a maximum size
		limit for files uploaded via a web form. If you receive an error during the import, this is likely the case. Try using FTP to copy your file to the GEDCOM folder instead, then import it from there (see below).</p>

		<span class="optionhead">OR Import GEDCOM From web site (in GEDCOM folder)</span>
		<p>If you used FTP or an online file manager to transfer the GEDCOM or ZIP file to the GEDCOM folder on your site, enter the exact name of your uploaded file here, or click on
		the "Select" button to locate it on your site. It must be in the GEDCOM folder, or the Select button will not find it. <strong>NOTE</strong>: If you see a list
		of files but they are not from your GEDCOM folder, you likely have a path problem. Check your Root Path (Admin/Setup/General Settings) and your GEDCOM path (Admin/Setup/Import Settings).</p>

		<p>Note: If you upload/import a ZIP file and include actual media in the file, TNG will extract the media to the appropriate media folders (eg, "photos" or a subfolder of "photos"). See Admin/Setup/Import Settings for more options related to embedded media.</p>

		<span class="optionhead">Accept data for all new event and attribute types</span>
		<p>Your GEDCOM file might contain events that TNG considers as non-standard events. Normally, new event or attribute types included in a GEDCOM file are entered into the database, but
		the data is set to be ignored. You would need to change the status of such a type to "Accept" in order for events or attributes of that type to be imported (in other words,
		you would need to import your file twice). If you check this option, TNG will automatically set all new event or attribute types to "Accept", and all your events
		will be imported the first time.</p>

		<span class="optionhead">Import Event / Attribute Types Only (no data is added, replaced or appended)</span>
		<p>Checking this option will cause only custom event or attribute types to be imported (see Admin/Event / Attribute Types). All other data is ignored. This is an ideal
		option to select during your initial setup, as it will allow you to see which custom events you have in your gedcom. You can then select which ones
		to accept and which ones to ignore before importing your entire database.</p>

		<span class="optionhead">Destination Tree</span><br />
		<p>Select a Tree to receive the imported data (required). If the tree to receive the data does not yet exist, click on the "Add New Tree" button to create it.
		A small popup box will appear and allow you to enter the information for the new tree.</p>

		<span class="optionhead">Replace all current data</span>
		<p>If you choose this option, all your previous GEDCOM data (people, families, children, sources, repositories, events, notes, associations and citations; not media or anything else)
		will be deleted prior to the import.
		<strong>NOTE</strong>: Links to media will be preserved as long as the people/family/source/repository IDs in your new GEDCOM match the IDs in your existing data.
		Most desktop genealogy programs assign permanent IDs to each person/family/source/repository, but a few do not. If you have linked in any media items, please check
		your new GEDCOM to make sure the IDs match before you import, no matter which of these import options you select. It might also be a good idea to backup your tables before
		performing an import (see Admin/Utilities to perform a backup).</p>

		<span class="optionhead">Replace matching records only</span>
		<p>With this option, new records are added and matching records are replaced (matches are determined by ID only). Old data is not deleted.</p>

		<span class="optionhead">Do not replace any data</span>
		<p>New records are added, but any matches are ignored (not replaced).</p>

		<span class="optionhead">Append all records</span>
		<p>All records are imported, regardless of existing data, but their IDs are recalculated. IDs numbers for the imported records will be added to the first
		available number (or a number you specify) to create the new ID numbers.</p>

		<span class="optionhead">Uppercase all surnames</span>
		<p>Check this box prior to importing if you want all incoming surnames to be converted to upper case. The surnames will be stored in the database this way,
		so the process is not reversable unless you import your GEDCOM file again.</p>

		<span class="optionhead">Do not recalculate Living flag</span>
		<p>If you chose "Replace matching records only" above, you will also see this option. Check this box prior to importing
		if you do not want the Living flag to be recalculated for individuals that were already in the database.</p>

		<span class="optionhead">Replace only if newer</span>
		<p>Matching records will only be replaced if the incoming record is newer than the one in the database. This is based on the "Last Modified" or CHAN
		date associated with the record in the GEDCOM.</p>

		<span class="optionhead">Import media if present</span>
		<p>If your GEDCOM contains links to media, selecting this option will allow TNG to import them and set up the appropriate links.
		You must still copy the physical files associated with these links to the appropriate folders on your site via other means (e.g., FTP). If you do not want to
		import any media links, make sure this box is not checked prior	to performing the import.</p>

		<span class="optionhead">Start IDs at first available number/Start IDs at</span>
		<p>If you chose "Append all records" above, you will also see this option. Check the first option to have
		TNG add the numbers for the incoming IDs to the first available slot in each category (individuals, families, sources, repositories) to create the new IDs.
		Check the second option if you want TNG to create the new IDs by adding the incoming ID numbers to a specific number (same for each category).
		If you choose this option, be careful that no records exist in the indicated range or you will have collisions.</p>

 		<span class="optionhead">Old style import</span>
		<p>Prior to TNG 7, the import did not show a progress bar. Instead, a counter was printed repeatedly to the screen for the number of people and families imported.
		The new number would always be displayed next to the old number, and soon they would be scrolling off the page. The progress bar is cleaner and more intuitive,
		but in some cases the old import actually works better because more information is being displayed on the screen, a little bit at a time. If the new import
		fails for you, you might try checking this option to see if the old import performs any better.</p>

		<p>When you're ready, click on the <strong>Import Data</strong> button to begin the process. You should see a progress bar and a series of counter track the
		individuals, families, sources, notes and places imported (note: only places with associated latitude/longitude data are counted). A final
		message will indicate the import has finished properly.</p>

		<span class="optionhead">"Resume" Feature</span>
		<p>If you do not see the "Finished" message, your server may have killed your import process for running too long.
		If this happens to you, go to the Admin/Setup/Import Settings page
		and check the box next to <strong>Save Import State</strong>. Then return to the Import page and try your import again. If the same condition
		occurs, the import should now be able to restart itself.</p>

	</td>
</tr>
<tr>
	<td class="tngshadow databack">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="export"><p class="subheadbold">GEDCOM Export</p></a>
		<p>This page allows you to export all data from a particular tree to a standard 5.5 GEDCOM file. The file will be available for download in your
		GEDCOM folder (as indicated in the Import Settings) and will be given the name of the tree's Tree ID plus ".ged".</p>

		<span class="optionhead">Branch</span>
		<p>Choose a branch from the list to include only people and families from this branch in the exported GEDCOM file.</p>

		<span class="optionhead">Exclude Living/Exclude Private</span>
		<p>Checking these boxes will completely exclude living or private individuals and families from the exported GEDCOM file.</p>

		<span class="optionhead">Export media links</span>
		<p>Check this option to include information pertaining to all photos, histories and other media linked to individuals, families,
		sources and repositories in the selected tree. This information includes the media file name, description and notes.</p>

		<span class="optionhead">Zip and include media files</span>
		<p>If you check the option to export media links, you also have the option to zip the finished file and include the physical media
		files mentioned in the GEDCOM file by checking this box. Take note that this could make your file extremely large.</p>

		<span class="optionhead">Local paths for Photos/Documents/Headstones/Histories/Recordings/Videos</span>
		<p>To prepend a common path to each media file name (ie, "C:\myphotos\" or "..\genealogy\"), check the "Export media links" box, then enter that
		path in the appropriate field (be sure to include a trailing slash). If these lines are left blank, only the file name and path stored in TNG for each media item
		will be exported in the GEDCOM's "FILE" tag.
		</p>

		<span class="optionhead">"Resume" Feature</span>
		<p>If you do not see the "Finished" message, your data was not completely exported.
		If you do not see any numbers, or if you see numbers but do not see a "Finished" message, your server may have killed your export process for running too long.
		If this happens to you, go to the Admin/Setup/Import Settings page
		and check the box next to <strong>Save Import State</strong>. Then return here and try your export again. If the export fails to run to completion, you will now
		be able to click a "resume" link at the top of the page to resume the export.</p>

		<span class="optionhead">Totals</span>
		<p>When the export finishes, you should see a summary of how many people, families, sources, notes, repositories, media and places were exported. It should
		be noted that only places that have latitude/longitude information or notes will be tallied in the place total.</p>
	</td>
</tr>

</table>
</body>
</html>