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
			<a href="#modlist" class="lightlink">Mod List</a> &nbsp; | &nbsp;
			<a href="#editor" class="lightlink">Mod Editor</a> &nbsp; | &nbsp;
			<a href="#viewlog" class="lightlink">View Log</a> &nbsp; | &nbsp;
			<a href="#options" class="lightlink">Options</a> &nbsp; | &nbsp;
			<a href="#analyzer" class="lightlink">Analyze TNG Files</a> &nbsp; | &nbsp;
			<a href="#parser" class="lightlink">View Parser Table</a> &nbsp; | &nbsp;
      <a href="#recommended" class="lightlink">Recommended Updates</a> &nbsp; | &nbsp;
			<a href="#credits" class="lightlink">Credits</a>
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

    <p>If you are new to TNG, the Mod Manager is a tool for administrators to install, manage and remove modifications to the TNG software package, either by downloading and installing "Mods" created by others from the TNGWiki, or by creating (and perhaps sharing) them yourself.</p>

    <p>A <b>Mod</b> is a text file using extension .cfg written with a code editor. It contains "directives" telling Mod Manager (MM) how to modify code in targeted files to install it. It can also copy files from an accompanying support folder, or even create new files. -- see the<i><a href="https://tng.lythgoes.net/wiki/index.php/Mod_Manager" target="_blank"> TNGWiki Mod Manager for details</a></i>.</p>

	</td>
</tr>

<tr class="databack">
	<td class="tngshadow">
    <p style="float:right"><a href="#top">Top</a></p>
    <a name="modlist"><p class="subheadbold">Mod List</p></a>

    <p>When selected from the TNG Admin page, Mod Manager (MM) displays a listing of all mods in the site's "mods" directory.  You can rename this directory in the Admin Setup >> General Settings >> Paths and Folders if you like.</p>

    <p>If you have not yet loaded any mods into your site's "mods" directory, the MM listing will be empty. You can download hundreds of mods from the TNGWiki. They come in the form of zip files which you will have to unzip and upload to your site's "mods" folder using an FTP program such as FileZilla or WinSCP that you can get free from the Internet</p>

    <p>Before mods are displayed, Mod Manager checks each one to see if it is already Installed or Okay to Install, and looks for errors that would prevent it from being either <i>Installed</i> or <i>Removed</i>. The result is displayed in the mod listing <i>Status column</i>. Details can be seen by clicking on the arrow icon or status text and then on the <i>Detail button</i>.</p>

    <p>All listed Mods have a color-coded installation status:
      <ul>
        <li>
          <b>Okay to Install</b> (white) -- Modlister has confirmed that all directives in the Mod configuration file can be installed without error.
        </li>
        <li>
          <b>Installed </b> (green) -- all components called for in the Mod configuration file are installed.
        </li>
        <li>
          <b>Partially Installed</b> (orange) -- some of the Mod components are installed and some are not. This can happen if you refresh a TNG file that was part of a Mod installation.
        </li>
        <li>
          <b>Cannot Install</b> (red) -- some of the Mod Configuration file cannot be installed, for example, because the target file is missing.
        </li>
      </ul>
    </p>

    <h3>Filter Bar</h3>

    <p>At the top of the mod listing is a filter bar to limit the display to mods with a selected status, or to <b>All</b> mods or just those you <b>Select</b>. Selecting any filter except <b>All</b> will present a list with a check box for each displayed mod. Checking one or more boxes allows further processing of the selected mod(s).</p>

    <p>For example, if you filter for mods that are <i>Okay to Install</i> and then hit <i>Go</i>, your listing will contain only those mods that are ready to be installed. Using the new check boxes on the filtered list, you can select one, a few or all of them, then hit the Install button and they will batch install.  Note the <i>Select All</i> and <i>Clear All buttons</i> to help with the check boxes.</p>


<p><strong><font color="#990000">Caution:You should only do batch operations if you have a good backup of your website and can quickly restore it if the batch operations renders your site inoperable, which can easily happen if you do not delete previous versions of the mods.</font></strong></p>

  <p><strong>Note: We recommend that you batch Uninstall all your Installed mods and then batch Clean Up any remaining Partially Installed mods before doing a TNG upgrade.</strong></p>

   <p>The <b>Select</b> filter displays all mods and adds checkboxes. Select one or more of them and hit the  <i>Select button</i>. Mod Manager only shows the selected mods. This can be useful for isolating and testing a single mod without displaying or processing the others.</p>

  <p>If you check the <b>Lock</b> box for any filtered listing, it will remain filtered, even after doing page refreshes. The listing will stay locked until you uncheck it or apply a different filter.</p>

    <h3>Mod listing Columns</h3>

    <p>The first three columns are self-explanatory. Depending on the Mod Manager Display settings in the <i>Options tab</i>, you can click on the Mod Name and its Parse Table will be displayed in a new tab. Clicking on the Config File Name will show the contents of the mod's configuration file in a new tab.</p>

    <p>If the <b>Wiki</b> column contains the wiki icon (W), you can click on it to go to the TNGWiki article that contains a description and other information about the mod, as well as a mod download link.</p>

    <p>The fifth column is the <b>Status</b> column. It shows the color-coded installation status of the mod as explained above. Clicking on the status text opens a panel with a description and appropriate controls to manage the mod. If there is a <i>Detail</i> button you can see an itemized list of all actions taken or to be taken to manage the mod. Any errors will be displayed.</p>

    <p>For advanced users, error messages are often accompanied by an E-number. This refers to the line number in the MM file where the error occurred.  E-numbers in the Mod List are all generated by the classes/modlister.class.php file. Near that line number will often appear commentary explaining the nature of the error and suggesting possible fixes.</p>

    <p>If there are no errors, you simply press the appropiate control to Install or Uninstall (remove) a mod.</p>
    <p>Some mods end up partly installed. When you see this status, hit the <i>Clean Up</i> button and MM will remove any installed components. You are usually left with a clean Mod that can be fully installed again.</p>

  <p>If the mod still remains Partially installed after several attemps to clean it up, you should notifiy the mod developer. To notify the developer click on the Wiki icon (W) to go to the TNGWiki page, then click on the <i>Mod Support</i> link. If there is no support link, <a href="#morehelp" >click here</a> for additional help.</p>


    <p>The final column, <i>Files</i>, contains an icon for more information. Hover it and a popup window will tell you all the files that are modified or will be modified by this mod.</p>

    <a name="morehelp"><h3>Finding Additional Help</h3></a>

    <p>If you need more help, either with Mod Manager or with a particular Mod, you can do one of the following:
    <ul>
      <li>For help with <b>Mod Manager</b> bugs or issues
      <ul>
        <li>contact Rick Bisbee <a href="https://bisbeefamily.com/suggest.php?page=Mod Manager Issues" target="_blank">Here</a></li>
        <li>contact Ken Roy: <a href="mailto:ken@royandboucher.com?subject=Mod&nbsp;Manager&nbsp;Help">Here</a></li>
      </ul>
      <li>For Help with a mod</li>
        <ul>
          <li>Contact the mod developer from the TNGWiki page associated with the mod</li>
          <li>Go to the <a href="https://tng.community/index.php?/forums/" target="_blank"> TNG Forum</a> and search for the name of the mod. If you find nothing useful, you can create an account and leave a query for help from other users.</li>
          <li>Use the <b>Email Discussion List</b> and ask your question. <a href="https://tng.lythgoes.net/wiki/index.php/TNG_Discussion_Forums" target="_blank"> Click here to get started</a>.</li>
        </ul>
    </ul>
    </p>

	</td>
</tr>

<tr class="databack">
	<td class="tngshadow">
    <p style="float:right"><a href="#top">Top</a></p>
    <a name="editor"><p class="subheadbold">Mod Editor</p></a>

    <p>The Mod (Parameter) Editor is accessed from the mod listings page.  If an installed mod has editable parameters, you will see it noted in the Mod Listing Status column as -- <i>Installed [Options]</i>. To edit parameters for the mod, open the Status panel and click on the "Edit Options" button. The editable parameters are the mod's user options, for example, to set the color for something.</p>

    <p>The target file's behavior can be controlled by the value of the parameters. For example, a Mod user may be asked to enter the number of days he wishes to keep certain log files.</p>

    <p>There is no limit to the number of parameters a Mod can use.  Each paramter has a default value shown in the Mod Editor description panel on the left. The panel on the right contains a area for changing the parameter value.  There are also two buttons, one to Update the target file with the value in the input box, the other to reset the parameter with the default value.</p>

    <p><b>Whether entering strings or integers, it is not necessary to surround them with quotes</b>.  The Mod Editor will figure that out when updating values.</p>
	</td>
</tr>

<tr class="databack">
	<td class="tngshadow">
    <p style="float:right"><a href="#top">Top</a></p>
    <a name="viewlog"><p class="subheadbold">View Log</p></a>
    <p>Depending on user preferences in the Options tab, errors generated during Mod installation or removal will automatically open the error log so the administrator can see what went wrong.  Otherwise you can open the log to see the details of your operations.</p>

    <p>The log line shows the date and time, the attempted operation, the name and version of the Mod, the result and the functionary (Site Administrator) who performed the operation.
    </p>

    <p>To see the details, click on the log line.  A panel will open. Each directive (starting with a %character) shows a line number in the Mod configuration file where the directive was executed, and the result.
    </p>

    <p>As noted previously, errors are accompanied by an E-number referencing the line number in the TNG Mod Manager file where the error occurred.  If it occurred during an attempted installation, the E-number will refer to the classes/modinstaller.class.php file.  Opening that file to the line number, you will often see nearby commentary explaining the error and suggesting solutions.</p>

    <p>For help with directives and how to use them, please consult the TNGWiki.  You can also click on the <b>Mod Syntax</b> link just below the Mod Manager tabs on most MM screens.</p>

</td>
</tr>
<tr class="databack">
	<td class="tngshadow">
    <p style="float:right"><a href="#top">Top</a></p>
    <a name="options"><p class="subheadbold">Options</p></a>
		<p>The <strong>Options</strong> tab opens a user preference screen dividied into three sections.</p>
</p>In the <b>Mod Manager Log</b> section you can enter preferences concerning the log file. Under the <i>Log File Name</i> you can actually enter a server path to place your log outside the area of the website that can be accessed by a browers.  The default is to put it in the TNG root directory.</p>
    <p><b>Display Settings</b> is where you show or hide the Mod Manager page tabs.</p>
    <p><b>Other</b> lets you decide how to configure Mod Manager's ability to delete mods and their support folders.</p>
    <p>
			<ul>
				<li><strong>Allow Delete Selected on Partially Installed Mods</strong> - enables the <strong>Delete</strong> button on the Partially Installed filtered list screen that allows deleting more than one mod at a time, such as deleting the prior versions of mods that were not deleted before installing the newer versions.  The default is <strong>No</strong>.  We recommend that you only enable this option when you need it to delete multiple mods without having to uninstall the current versions to delete the prior versions of the mod when you forgot to Uninstall and Delete previous versions of the mod before installing a new version and that you normally leave this option set to No and reset the option to No after you deleted previous versions of the mod that show as partially installed.</li>
				<li><strong>Allow Delete of individually Installed Mods</strong> - allows you to turn on the option to display a Delete button next to the Uninstall button for individually installed mods, such as deleting the prior version of a mod that was not deleted before installing the newer version.  We recommend that you only enable this option when you need it to delete a previous version of a mod without having to uninstall the current version in order to delete the prior version and that you normally leave the option set to <strong>No</strong> and reset the option to No after you deleted previous versions of the mod that show as installed..</li>
				<li><strong>Allow Delete support folder when mod is deleted</strong> - some mod configuration files are accompanied by a support folder containing files to be copied, for example, or language support files.  This option allows you to to delete the mod's support folder when deleting the mod.  The default is <strong>No</strong>.  We recommend that you only enable this option if you understand the risk that unintended folders could be deleted. We believe this risk is very small.        </li>
		</ul>
  </p>
    <p>Set the preferences as you like and hit the <i>Save</i> button.</p>
</td>
</tr>
<tr class="databack">
	<td class="tngshadow">
    <p style="float:right"><a href="#top">Top</a></p>
    <a name="analyzer"><p class="subheadbold">Analyze TNG Files</p></a>
		<p>The <strong>Analyze TNG Files</strong> tab is an optional tab that can be enabled in the Options screen.</p>

<p>This is an advanced tool that allows you to select a TNG file and view which mods change or will change that specific TNG file. If a file does not appear in the left-hand list, it means that no mods are targeting it.</p>

<p>When you select a file in the left-hand column, it will be displayed in the right-hand column with the names and status of mods that will affect it. From there you can click the link to "Show modification" and see the actual change it makes to the target file. <i>It is not within the scope of this Help file to discuss Mod configuration directives and how they work</i>.  Please consult the TNGWiki for information.</p>

<p>If you have chosen in the Options tab, Display Settings, "Show actions in Mod Analyzer," you will also see links to allow you to Install, Uninstall or Delete the Mod right from this screen, depending on it's current status.</p>
<p>At the top of the lising you will see a filter bar with selectors for <i>All Mods</i>, <i>Installed Mods Only</i>, or <i>Installed+Partially Installed Mods</i>. Selecting <i>Installed Mods Only</i> and clicking on <i>Submit Query</i> will limit the Files in the left-hand column to those which are affected by currently Installed mods only.</p>

		<p>This tool is helpful not only to find conflicts between two mods but also to know which mods need to be cleaned up and re-installed after replacing the given target file. </p>

    <p>The TNG Wiki provides additional information for the mod developers on <a href="https://tng.lythgoes.net/wiki/index.php?title=Using_the_Mod_Analyzer" target="_blank">Using the Mod Analyzer</a>.</p>

</td>
</tr>

<tr class="databack">
	<td class="tngshadow">
    <p style="float:right"><a href="#top">Top</a></p>
    <a name="parser"><p class="subheadbold">View Parser Table</p></a>
    <p>This tool is designed mainly for debugging Mods. The Parser Table shows how the Mod Manager parsed the Mod config file (.cfg) directives.  It is shown in the form of table, with each row representing a Mod directive.  The data shown in the table is passed to other mod manager scripts for further processing -- installing, removing, and so on. If there is a problem with a Mod, a good place to start is with the parse table to see if all the Mod's directives and arguments are being captured properly.</p>

      <p>You can use this tab to select a mod from a list whose table you want to view, or alternatively you can click on the mod name in the Mod List to view the parse table for that mod, <i>if you've enabled the Show Other Developer Tools option</i>.</p>

      <p>Displaying this tab is optional. To use it select 'Display Settings/Show Other Developer tools' on the options tab.  If the tab option is turned off, the link on the listing page will also be disabled.</p>

      <p><i>It is not within the scope of this Help file to discuss Mod configuration directives and how they work</i>.  Please consult the TNGWiki for information.</p>

    </td>
</tr>

<tr class="databack">
	<td class="tngshadow">
    <p style="float:right"><a href="#top">Top</a></p>
    <a name="recommended"><p class="subheadbold">Recommended Updates</p></a>
		<p>The <strong>Recommended Changes</strong> tab is an optional tab that can be enabled in the Options screen that allows you to update your cust_text.php files if you did not do so as part of the TNG upgrade readme.</p>



<p>Additional information can be found in the <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager" target="_blank">Mod Manager</a> article and in the <a href="https://tng.lythgoes.net/wiki/index.php?title=Category:TNG_Mod_Manager" target="_blank">TNG Mod Manager</a> category of articles on the TNG Wiki.</p>
<p>You can view the <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_Enhancements" target="_blank">Mod Manager</a> article in TNG Wiki to see what enhancements were made in TNG v12.</p>

	</td>
</tr>

<tr class="databack">
  <td class="tngshadow">
    <p style="float:right"><a href="#top">Top</a></p>
    <a name="credits"><p class="subheadbold">Credits</p></a>

      <table style='table-layout:fixed;width:100%'>
        <tr>
          <td style='width:20%;vertical-align:top;'>
            Brian McFadyen
          </td>
          <td style='width:80%'>
            <ul><li>author</li></ul>
          </td>
        </tr>

        <tr>
          <td style='vertical-align:top;'>
            Sean Schwoere
          </td>
          <td>
            <ul>
                <li>integration for Joomla</li>
                <li>better integration to install, remove and manage mods</li>
            </ul>
          </td>
        </tr>

        <tr>
          <td style='vertical-align:top;'>
            Ken Roy
          </td>
          <td>
            <ul>
                <li>development team leader, versions 12 - 14</li>
                <li>created the View Log tab</li>
                <li>created the Options tab</li>
            </ul>
          </td>
        </tr>

        <tr>
          <td style='vertical-align:top;'>
            Rick Bisbee
          </td>
          <td>
            <ul>
                <li>lead programmer, versions 12 - 14</li>
                <li>added batch processing</li>
                <li>added View Parser Table tab</li>
                <li>added Ananlyze TNG Files tab</li>
                <li>refactored TNG code for maintenance, v14</li>
            </ul>
          </td>
        </tr>

        <tr>
          <td style='vertical-align:top;'>
            Jeff Robson
          </td>
          <td>
            <ul>
                <li>beta testing team, version 12</li>
                <li>added the Affected Files tab</li>
                <li>major contributions to the styling</li>
            </ul>
          </td>
        </tr>

        <tr>
          <td style='vertical-align:top;'>
            Robin Richmond
          </td>
          <td>
            <ul>
                <li>beta testing team, version 12</li>
                <li>provided code to break long lines of text with no spaces in them used primarily in the MM Status column</li>
                <li>major contributions to the MM log display</li>
            </ul>
          </td>
        </tr>


        <tr>
          <td style='vertical-align:top;'>
            Michel Kirsh
          </td>
          <td>
            <ul>
                <li>beta testing team, version 14</li>
                <li>major update to Analyze TNG Files</li>
            </ul>
          </td>
        </tr>

        <tr>
          <td style='vertical-align:top;'>
              TNGv14 beta test team
          </td>
          <td>

            <ul>
                <li>Mogens C. Fenger</li>
                <li>William Herndon</li>
                <li>Michel Kirsch</li>
                <li>Ron Krzmarzick</li>
                <li>Roger Moffat</li>
                <li>Jan-Thore Solem</li>
            </ul>
          </td>
        </tr>
      </table>
  </td>
</tr>
</table>
</body>