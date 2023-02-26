<?php
include("../../helplib.php");
echo help_header("Help: Mod Manager");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="backuprestore_help.php" class="lightlink">&laquo; Help: Utilities</a> &nbsp; | &nbsp;
			<a href="index_help.php" class="lightlink">Help: Getting Started &raquo;</a>
		</p>
		<span class="largeheader">Help: Mod Manager</span>
		<p class="smaller menu">
			<a href="#overview" class="lightlink">Overview</a> &nbsp; | &nbsp;
			<a href="#operation" class="lightlink">Operation</a> &nbsp; | &nbsp;
			<a href="#status" class="lightlink">Status</a> &nbsp; | &nbsp;
			<a href="#syntax" class="lightlink">Mod Syntax</a> &nbsp; | &nbsp;
			<a href="#files" class="lightlink">Config Files</a> &nbsp; | &nbsp;
			<a href="#batch" class="lightlink">Batch Updates</a> &nbsp; | &nbsp;
			<a href="#option" class="lightlink">Options</a>
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

		<a name="overview"><p class="subheadbold">Overview</p></a>

		<p>The TNG Mod Manager, originally developed by Brian McFadyen and updated by Sean Schwoere to work with the Joomla TNG Component, is intended to provide a more integrated way to install, remove and manage modifications to the TNG software package that have been coded to work with this manager. Updates were made in TNG V9 by Bart Degryse and Ken Roy to prevent clean up attempts when the mod cannot be installed.  The Mod Manager is connected into the TNG Administrative page for easy access. The Mod Manager adds the following folders to TNG:
		<ul>
			<li><strong>mods</strong> to contain the Mod configuration files and associated Mod support files</li>
			<li><strong>extensions</strong> to contain some of the mod extensions that are installed by other Mod Manager config files</li>
		</ul></p>
		<p>The <strong>Batch Updates</strong> was added by Rick Bisbee in TNG 10.0.3 to provide the capability to execute the same action against multiple mods. The Description popup was added by Jeff Robison.</p>
		<p>The <strong>Options</strong> was added by Ken Roy in TNG 10.0.3 to allow changing some of the execution behavior of the Mod Manager.</p>
		<p>The <strong>View Log</strong> was added by Ken Roy in TNG 10.0.3 to display the Mod Manager Log which is now split from the Admin Log.  The Mod Manager log was reformated by Rick Bisbee for easier readability of the actions.</p>
<p>Additional information can be found in the <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager" target="_blank">Mod Manager</a> article and in the <a href="https://tng.lythgoes.net/wiki/index.php?title=Category:TNG_Mod_Manager" target="_blank">TNG Mod Manager</a> category of articles on the TNG Wiki.

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="operation"><p class="subheadbold">Operation</p></a>

		<p>The Mod Manager examines the mods folder and reads each <strong>cfg</strong> file that it finds. The <strong>cfg</strong> files are directive files that describe the mod, the files and locations to be modified, and the code that is used in the modification.
		<p>The Mod Manager checks the following:
			<ul>
				<li>ensures the user is logged in
				<li>examines each code location and change
					<ul>
						<li>ensures the location can be found</li>
						<li>ensures the target location is unique</li>
						<li>identifies whether the target location has already been installed</li>
					</ul>
			<li>identifies new files to be created. If the new file already exists, it examines the version level</li>
			</ul></p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="status"><p class="subheadbold">Status</p></a>
			<p>The Mod Manager returns the following status:
			<ul>
			<li><strong>Ok to Install</strong> if the mod is not yet installed and the target locations can be identified, then the <strong>Install</strong> button is displayed</li>
			<li><strong>Installed</strong> if the mod is completely installed, the option to <strong>Remove</strong> the Mod is presented and the option to <strong>Edit</strong> parameters if any exist</li>
			<li><strong>Clean Up</strong> if the mod is partially installed, the <strong>Cleanup</strong> button is provided. A Clean up operation will attempt to remove any inserted code, restore and replaced code, and remove any created or copied files.</li>
			<li><strong>Unable to Install</strong> if the mod <strong>cannot</strong> be installed. This message will be preceded by an other message that provides more details as to why the mod cannot be installed.</li>
			</ul>
		<p>For examples of the Mod Manager Status screens and how to interpret the various statuses, see <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_-_Interpreting_Status" target="_blank">Mod Manager - Interpreting Status</a></p>

</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="syntax"><p class="subheadbold">Mod Syntax</p></a>
			<p>The Mod Manager syntax basically includes:
			<p><strong>Header section</strong> that includes</p>
				<ul><li>Name - the name of the mod, wiki article and file name</li>
				<li>Version - the version of the mod, where the first 3 period places represents the lowest TNG version to which the mod applies</li>
				<li>Description - provides a brief description of the mod, the Mod Developer's name, and a URL link to the TNG Wiki article for the mod.</li>
				</ul>
			</p>
			<p><strong>Target sections</strong> that specify the file that is the target of the change and includes the following directives</p>
			<ul><li>Location - that specifies the code location to be changed</li>
			<li>Action keyword - that specifies whether to replace or insert code before or after the location</li>
			</ul>
			</p>
			<p><strong>New File directives</strong> that create the file when the mod is installed</p>
			<p><strong>Copy File directives</strong> that copy the specified file to the TNG root (%copyfile) or to a subfolder (%copyfile2)</p>
		<p>For detailed information on the Mod Manager Syntax, see <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_Syntax" target="_blank">Mod Manager Syntax</a></p>



	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="files"><p class="subheadbold">Config Files</p></a>

		<span class="optionhead">Installing Mods</span>
		<p>The TNG Wiki provides information on using the <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_-_Installing_Config_Files" target="_blank">Config Files</a> to install the mods.</p>
		
		<span class="optionhead">Interpreting Status</span>
		<p>The TNG Wiki provides information on <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_-_Creating_Config_Files" target="_blank">Interpreting Status</a>.</p>
		
		<span class="optionhead">Config File Syntax</span>
		<p>The TNG Wiki provides information on the <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_-_Config_File_Syntax" target="_blank">Config File Syntax</a>.</p>
		
		<span class="optionhead">Creating Config Files</span>
		<p>The TNG Wiki provides information for the mod developers on the <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_-_Creating_Config_Files" target="_blank">Creating Config Files</a>.</p>
	</td>
</tr>

<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="batch"><p class="subheadbold">Batch Updates</p></a>

		<p>The Batch Updates allows specific actions on multiple mods using the Select Filter.  You must choose from the status filter list and click Go to display the available controls for the specific status selected.  Note that Delete is not available for the Clean Up status, so you will need to use the normal Mod List to delete mods in Clean Up status, such as a prior version of the same mod.
		<p>The Select Filter options are:
			<ul>
				<li><strong>All</strong> - displays all a list of all the .cfg files in the mods folder.  When you select a specific status then Action buttons will become available
				<li><strong>Ok to Install</strong> - displays a list of all the mods that can be</li>
					<ul>
						<li>Installed based on your selections and clicking the <strong>Install</strong> button</li>
						<li>Deleted from your mods folder based on your selections and clicking the <strong>Delete</strong> button</li>
					</ul>
				<li><strong>Installed</strong> - displays a list of all the mods that are currently installed that can be</li>
					<ul>
						<li>Removed based on your selections and clicking the <strong>Remove</strong> button</li>
					</ul>
				<li><strong>Clean Up</strong> - displays a list of all the mods that can be</li>
					<ul>
						<li>Cleaned up based on your selections and clicking the <strong>Clean Up</strong> button</li>
					</ul>
				<li><strong>Unable to Install</strong> - displays a list of all the mods that cannot be installed, either due to Bad Targets or Missing files, that can be</li>
					<ul>
						<li>Deleted from your mods folder based on your selections and clicking the <strong>Delete</strong> button</li>
					</ul>
	</td>
</tr>

<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="options"><p class="subheadbold">Options</p></a>

		<p>The Options allows you to specify some of the Mod Manager behavior for the 
		<p><strong>Affected Files List Options</strong> 
			<ul>
				<li><strong>Show Affected Files List</strong> - allows you to select whether to dislay the Affected Files List in the Mod List tab.  The default is <strong>Yes</strong>.</li>
				<li><strong>Show New Files in List</strong> - displays new files created by the mod.  The default is <strong>Yes</strong>.</li>
				<li><strong>Show Files Copied in List</strong> - displays the files that are copied or copied to by the mod. The default is <strong>Yes</strong>.</li>
				<li><strong>Show List in Column</strong> - displays the Affected Files List in the column selected.  It defaults to the <strong>Config File Name</strong> column.</li>
				<li><strong>Show List as</strong> - allows you to select whether you want the list as a Table or Comma Separated Values.  It defaults to <strong>Table</strong>.</li>
				<li><strong>Show List in Batch Updates</strong> - allows you to select whether you want the list displayed in the More popup in Batch Updates.  It defaults to <strong>Yes</strong>.</li>
			</ul></p>
		<p><strong>Mod Manager Log Options</strong> 
			<ul>
				<li><strong>Log Mod Manager Actions</strong> - allows you to select whether you want to log the Mod Manager confirmation and actions.  The default is <strong>Yes</strong>.</li>
				<li><strong>Log File Name</strong> - allows you to specify the file name to be used for the Mod Manager log.  The default is <strong>modmgrlog.txt</strong>.</li>
				<li><strong>Log Max lines</strong> - allows you to specify how many lines to keep in the log. The default is <strong>2000</strong>.</li>
			</ul></p>
		<p><strong>Other Options</strong> 
			<ul>
				<li><strong>Sort Lists by</strong> - allows you to specify what column to sort the Mod List and Batch Updates.  The default is <strong>Config File Name</strong>.</li>
				<li><strong>Bypass the Confirmations</strong> - allows you to specify whether you want to bypass the Confirmation screen display in the Mod List.  The Confirmation is still written to the log if you select Yes.  The default is <strong>No</strong>.</li>
				<li><strong>Bypass the Action Messages</strong> - allows you to specify whether you want to bypass the Action message screen display in the Mod List.  The Action messages are still written to the log if you select Yes.  The default is <strong>No</strong>.</li>
			</ul></p>
	</td>
</tr>


</table>
</body>
</html>