<?php
include("../../helplib.php");
echo help_header("Help: General Settings");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="setup_help.php" class="lightlink">&laquo; Help: Setup</a> &nbsp; | &nbsp;
			<a href="pedconfig_help.php" class="lightlink">Help: Chart Settings &raquo;</a>
		</p>
		<span class="largeheader">Help: General Settings</span>
		<p class="smaller menu">
			<a href="#data" class="lightlink">Database</a> &nbsp; | &nbsp;
			<a href="#table" class="lightlink">Tables</a> &nbsp; | &nbsp;
			<a href="#path" class="lightlink">Paths+Folders</a> &nbsp; | &nbsp;
			<a href="#site" class="lightlink">Site</a> &nbsp; | &nbsp;
			<a href="#media" class="lightlink">Media</a> &nbsp; | &nbsp;
			<a href="#lang" class="lightlink">Language</a> &nbsp; | &nbsp;
			<a href="#priv" class="lightlink">Privacy</a> &nbsp; | &nbsp;
			<a href="#name" class="lightlink">Names</a> &nbsp; | &nbsp;
			<a href="#cem" class="lightlink">Cemeteries</a> &nbsp; | &nbsp;
			<a href="#mail" class="lightlink">Mail</a> &nbsp; | &nbsp;
			<a href="#pref" class="lightlink">Prefixes</a> &nbsp; | &nbsp;
			<a href="#mobile" class="lightlink">Mobile</a> &nbsp; | &nbsp;
			<a href="#misc" class="lightlink">Misc</a>
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

		<a name="data"><p class="subheadbold">Database</p></a>

		<span class="optionhead">Database Host, Name, User Name, Password, Port and Socket</span>
		<p>This is the information TNG and PHP will use to connect to your database. Except for the port and socket (rarely used), these fields must be filled in before your database 
		can be accessed. <strong>Notes</strong>: The user name and password mentioned here may be different from
		your regular web site login. If, after entering this information, you continue to see an error message that TNG is not communicating
		with your database, then you know at least one of these values is incorrect. If you don't know the correct information, ask your web 
		hosting provider. The port number or a socket path may be required to be entered as part of the host name (i.e., "localhost:3306" or "localhost:/path/to/socket"). 
		Case is important, so be mindful to type in everything exactly as it was given
		to you. If you are acting as your own webmaster, be sure you have created a database
		and added a user to it (the user must have ALL rights).</p>

		<span class="optionhead">Maintenance Mode</span>
		<p>When TNG is in Maintenance Mode, the data cannot be accessed from the public side of your site. Instead, visitors will see a 
		polite message telling them that you are performing maintenance on the site and they should try again later. You might wish to
		put your site in Maintenance Mode while you are re-importing your data. If you are resequencing your IDs, Maintenance Mode is
		required. If you ever find yourself "stuck" in Maintenance Mode, you can edit your config.php file directly and reset the $tngconfig['maint'] variable
		to 0 or blank.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="table"><p class="subheadbold">Table Names</p></a>

		<span class="optionhead">Table Names</span>
		<p>You shouldn't have to change any of the default names unless you already have one or more tables with one or more of these 
		names. Always make sure all table names are filled in and that all names are unique. Do not change any existing table names.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="path"><p class="subheadbold">Paths and Folders</p></a>

		<span class="optionhead">Root Path</span>
		<p>This is the system path to the folder or directory where your TNG files are located. It is not a web address.
		You must include a trailing slash. When you first open this page, your Root Path should be correct. Do not change it unless you are an advanced user
		or have been instructed to do so. If you blank out the field and save the page, the correct path will appear here the next time you load the page, but you
		will need to save the page again to keep the new path.</p>

		<span class="optionhead">Config Path</span>
		<p>If you would like to put your TNG configuration files in a more secure location outside of the "web root" directory (so they aren't
		accessible from the web), enter that path here. It <strong>must</strong> end with a trailing slash (/). It will likely be the first part of the Root Path.
		For example, if your Root Path is "/home/www/username/public_html/genealogy/", then you might choose "/home/www/username/" as your Config Path.</p>

		<p><strong>IMPORTANT:</strong> Use of this field is
		completely optional and will not affect the operation of your site one way or the other. You should only enter something here
		if you are very familiar with your web site's directory structure. If you do enter a path here, you <strong>must move the following files 
		to the Config Path immediately after saving</strong> and make them writeable (664 or 666 permissions): config.php, customconfig.php, importconfig.php,
		logconfig.php, mapconfig.php, mmconfig.php and pedconfig.php. If you don't, nothing on the site will be operational. If you make a mistake and your site stops working,
		you will need to manually edit your subroot.php file in order to correct the $tngconfig['subroot'] path (setting it back to blank will return your system
		to the way it was before).</p>

		<span class="optionhead">Photo / Document / History / Headstone / Multimedia / Mods / Extensions / GENDEX / Backup Folders</span>
		<p>Please enter folder or directory names for these respective entities. All should have global read+write+execute permissions (755 or 775, although some systems will require 777).
		The Multimedia folder is intended as a "catch all" for any media items that don't fit cleanly into the other categories (e.g., videos and
		audio recordings). The names of these folders can be changed by entering the new names and clicking the corresponding "Rename" buttons. Don't forget to click "Save" when you are done with this page.</p>
		<p>Note: Check the box under the Backup Folder name to have the Backup Folder stored at the Config Path location (see above). You must move the actual folder to the config location yourself outside of TNG.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="site"><p class="subheadbold">Site Design and Definition</p></a>

		<span class="optionhead">Home Page</span>
		<p>All TNG menus include a link to the "Home Page". Enter the address for this link here. By default this is the index.php page in the folder with your other
		TNG files. It must be a relative link ("index.php" or "../otherhomepage.html"), not an absolute link ("https://yoursite.com").</p>

		<span class="optionhead">Genealogy URL</span>
		<p>The web address for your genealogy folder (i.e., "https://mysite.com/genealogy").</p>

		<span class="optionhead">Site Name</span>
		<p>If you enter something here, it will be included in the HTML "Title" tag on every page and will show up at the top of your
		browser window.</p>

		<span class="optionhead">Site Description</span>
		<p>A short description of your site for use on the RSS feed page.</p>

		<span class="optionhead">Doctype Declaration</span>
		<p>This string is placed at the top of every page in the public area to give the user's browser the information it needs
		to render the page correctly. Validation tests run against the pages will use this information to determine what problems
		may exist. If you leave this blank, the default XHTML Transitional doctype will be used.</p>

		<span class="optionhead">Site Owner</span>
		<p>Your name, or your business name. This name will appear on outgoing e-mail messages originating from TNG.</p>

		<span class="optionhead">Custom Header / Footer / Meta</span>
		<p>File names for the page fragments to be used as your TNG page header, footer and HEAD section ("meta"). Files with the default names are supplied.
		To use PHP coding in these files, they must have .php extensions. To make use of TNG's design templates, you must keep these the header and footer named
		topmenu.php and footer.php respectively.</p>

		<span class="optionhead">Custom footer message</span>
		<p>A message or an HTML snippet to be displayed at the bottom of each page.</p>

		<span class="optionhead">Tab Style Sheet</span>
		<p>The file that dictates the style of tabs displayed on many of the public pages. The default style (tngtabs2.css) features gently rounded tabs, but
		an alternate style with slanted tabs (tngtabs1.css) also comes with TNG. To view tabs with this style, enter "tngtabs1.css"
		in this field and click "Save" at the bottom of the page, then look up any individual in the public area. The tngtabs1.css style makes use of two images, "tngtab.png" (inactive
		tabs) and "tngtabactive.png" (active tabs). To change the color of these images, you may use any image editor, or click on the link at the end of this paragraph. On the next page,
		enter <strong>decimal</strong> values for the red, green and blue components of the desired new color, then click Submit. You will then see a new image, which you can save on your site as either
		tngtab.gif or tngtabactive.png. <a href="https://lythgoes.net/genealogy/switchcolor.php">https://lythgoes.net/genealogy/switchcolor.php</a></p>

		<span class="optionhead">Menu Location</span>
		<p>The TNG menu may be located on the top left of every page, just above the individual's name or other page heading, or on the top right of every page, directly across from
		the name or other page heading. The dynamic language selection dropdown will be located in the same section of the screen.</p>

		<span class="optionhead">Show Home / Search / Login/Logout / Share / Print / Add Bookmark Links</span>
		<p>Some of these options (Home/Search/Login) are located at the top left of every page, just under the page heading and above the row of tabs. The others
		(Share/Print/Add Bookmark) are located at the top right, just under the menu bar.
		Each of these options can be turned on or off using these controls.</p>

		<span class="optionhead">Search Link Destination</span>
		<p>The default behavior of the Search link at the top of every page is to open a small window where you can search by entering a name or ID. This is called "Quick Search".
		You may choose instead to have this link go to the Advanced Search page by choosing that option.</p>

		<span class="optionhead">Hide Christening Labels</span>
		<p>This option allows you to hide all mention of the "Christening" event.</p>

		<span class="optionhead">Alternate birth events</span>
		<p>The default alternate birth events are Christening (CHR) and Baptism (BAPM), but you may change that here by adding or substituting your own GEDCOM tags. 
		Users making changes to the data will then be able to select the appropriate event from this list.</p>

		<span class="optionhead">Default Tree</span>
		<p>When more than one tree exists, all pages where a selection is possible (including the search utility
		on your home page) will default to "All Trees". If you instead want to point this to one tree in particular,
		select that tree here. Whenever a user enters a URL without a tree ID (or with a blank tree ID), the request
		will be rerouted to this tree. <strong>NOTE</strong>: If you have only one tree, it is better to leave this field blank.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="media"><p class="subheadbold">Media</p></a>

		<span class="optionhead">Photos Extension</span>
		<p>The file extension assigned to all small pedigree-style photos. Other photos need not have this extension. The .jpg extension is recommended for most photos.</p>

		<span class="optionhead">Show Extended Photo Info</span>
		<p>If this option is checked, any available extended information will be displayed for each photo. This includes the physical file name, the dimensions in pixels, and any
		existing IPTC data.</p>

		<span class="optionhead">Image Max Height and Width</span>
		<p>When these values are set (pixels), images larger than these dimensions will be scaled down (using HTML) when displayed in the public area.</p>

		<span class="optionhead">Thumbnails Prefix</span>
		<p>When generating thumbnails automatically, TNG will prepend this value to the original image file name to create the thumbnail file name. If the file name of the original includes path
		information, the prefix will be included directly before the file name. This prefix can include a folder name (ie, "thumbnails/"). If you
		will be using a folder name as part of the prefix, be sure that this folder exists and has the same permissions as the main Photos folder.</p>

		<span class="optionhead">Thumbnails Suffix</span>
		<p>When generating thumbnails automatically, TNG will append this value to the original image file name to create the thumbnail file name.</p>

		<span class="optionhead">Thumbnail Max Height</span>
		<p>When TNG automatically creates a thumbnail image, the image will be no taller than this (pixels).</p>

		<span class="optionhead">Thumbnail Max Width</span>
		<p>When TNG automatically creates a thumbnail image, the image will be no wider than this (pixels).</p>

		<span class="optionhead">Use default thumbnails</span>
		<p>If a person does not have a default photo and this option is enabled, a generic, gender-specific thumbnail will be used instead on all pages that reference
		this person.</p>

		<span class="optionhead">Max characters in list notes</span>
		<p>If you want notes to be truncated when they are shown on list pages (like on the public Photos, Documents and Histories pages), set this to the maximum
		number of characters that should be displayed. Leave it blank to always show the entire note.</p>

		<span class="optionhead">Enable Slide Show</span>
		<p>Allows a set of photos to be shown automatically in succession from the public area when the "Start Slideshow" link is clicked. Setting
		this option to 'No' hides the link and disables the feature.</p>

		<span class="optionhead">Slide Show Auto Repeat</span>
		<p>Setting this option to 'Yes' allows the slide show to run continuously.</p>

		<span class="optionhead">Enable Image Viewer</span>
		<p>Setting this option to 'Always' shows every image-based media item (.jpg, .gif and .png files) in the image viewer. Setting it to 'Documents only' turns the
		image viewer off for all image-based media that are not 'Documents' or other media types that behave like Documents.</p>

		<span class="optionhead">Image Viewer Height</span>
		<p>Setting this option to 'Always show full image' will ensure that the entire image is viewable by default. Setting it to 'Fixed (640px)' causes images taller than
		640 pixels to be cropped at that height when the image is initially displayed. The viewer controls may still be used to pan around the image or to zoom in or out.</p>

		<span class="optionhead">Hide Personal Media</span>
		<p>If this option is set to "Yes", then media listings on a person's individual page will start in a collapsed state. Instead of seeing thumbnails and descriptions,
		you will see only a total count for each media type. Visitors will still be able to expand each media section, but they will be collapsed again if the page is refreshed.</p>

		<span class="optionhead">Remove physical file on delete</span>
		<p>This option dictates what happens when an individual media record is deleted. If this option is set to "Yes", the associated physical file will also be deleted. 
			If the option is set to "No", only the database record will be removed, leaving the physical file intact. If the option is set to "On request", you will be prompted to 
			indicate whether the associated file should be deleted or not.</p>

		<span class="optionhead">Show photos on one row</span>
		<p>This pertains to thumbnails shown on a person's individual page. When more than one thumbnail is present in any area, this option can be used to display all of the
			thumbnails horizontally in a single row (images will wrap if there are too many for them all to be shown on one row) or in a list, as they always were prior to TNG v12.
			When the thumbnails are displayed horizontally, no captions will be displayed. Media that do not have a thumbnail will still be listed vertically.</p>

		<span class="optionhead">Separate media in tree folders</span>
		<p>By default, all physical media in each collection (ie, Photos, Documents, Histories, etc) are stored in the same physical folder. Enabling this option will cause TNG
			to store media in subfolders of their respective collection folders according to their associated tree IDs (if there is no tree association, the file will remain in the 
			main collection folder). Click the "Convert" button to move affected media into of out of this new folder structure. If the destination tree folders don't exist, they will
			be created.</p>

		<span class="optionhead">Favicon</span>
		<p>A "favicon" is a small icon displayed in the browser's address bar, just to the left of the site URL. TNG includes default icons for both the public
			and admin parts of the program. TNG does not include a utility to help you create these icons, but if
			you have one (or separate ones for both public and admin), upload your icon(s) to the img/public and/or img/admin folders and enter the file name here
			in the settings. Note that if you have separate icons for public and admin, you will need to give them each the same name.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="lang"><p class="subheadbold">Language</p></a>

		<span class="optionhead">Language</span>
		<p>Your default language folder (i.e., 'English'). You may have more than one language available to visitors, but this language will always display first.</p>

		<span class="optionhead">Character Set</span>
		<p>The character set for your default language. If this is left blank, the browser's default character set will be used. The character set for English and other languages using the 26-character
		Roman alphabet is ISO-8859-1.</p>

		<span class="optionhead">Dynamic Language Change</span>
		<p>If you have set up more than one language and want users to be able to select a different language "on the fly",
		select <em>Allow</em>.</p>

		<span class="optionhead">Turn off relationship messages</span>
		<p>This will hide the written relationship explanation at the bottom of the Relationship Chart. This might be useful if the wording of the explanation doesn't always make sense in this language.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="priv"><p class="subheadbold">Privacy</p></a>

		<span class="optionhead">Require Login</span>
		<p>Normally anyone can view your public pages, with a login to see data for living individuals being optional. If, however,
		you want to require everyone to log in before they can see anything beyond the home page, check this box.</p>

		<span class="optionhead">Restrict access to assigned tree</span>
		<p>If Require Login is set to 'Yes', then setting this option to 'Yes' will cause users to only see information associated with their
		assigned trees. All other individuals, families, sources, etc. will be hidden.</p>

		<span class="optionhead">Show LDS Data</span>
		<p>To always show LDS data (where available), select <em>Always</em> (this was the default before). To turn off all LDS
		information and the ability to manually enter LDS data, select <em>Never</em>. To make this switch dependent on
		user permissions, select <i>Depending on user rights</i>. In this case, only logged-in users who have rights
		to see LDS data will see it. It will be hidden from all others.</p>

		<span class="optionhead">Show Living Data</span>
		<p>To always show living data (dates and places for living individuals), select <i>Always</i>. To turn off all living
		information, select <i>Never</i>. To make the display of living data dependent on
		user permissions, select <i>Depending on user rights</i>. In this case, only logged-in users who have rights
		to see living data will see it. It will be hidden from all others.</p>

		<span class="optionhead">Show Names for Living</span>
		<p>To hide the names of individuals marked as Living (no death or burial information, plus a birthdate less than 110 years ago), select <em>No</em>. Names of living
		individuals will be replaced with the word "Living". To show the surname and first initial(s) of living individuals, select <em>Abbreviate first name</em>. To
		always show the names of living individuals for everyone, select <em>Yes</em>.</p>

		<span class="optionhead">Show Names for Private</span>
		<p>To hide the names of individuals marked as Private, select <em>No</em>. Names of private
		individuals will be replaced with the word "Private". To show the surname and first initial(s) of private individuals, select <em>Abbreviate first name</em>. To
		always show the names of private individuals for everyone, select <em>Yes</em>.</p>

		<span class="optionhead">Show cookie approval message</span>
		<p>Site visitors will be shown a small popup in the lower right corner of the screen advising them that the site uses cookies.
			Once the visitor clicks the "I understand" button, the message will disappear, and a cookie will be set to remember
			the action. As long as that cookie persists, the visitor will not see the popup again on subsequent visits.</p>

		<span class="optionhead">Show link to data protection policy</span>
		<p>Site visitors will be shown a link to the site's Data Protection Policy in the footer that appears at the bottom of every page.
			A link will also be shown in the cookie popup (see above) and on pages where the visitor is asked to give consent for private
			information to be stored (new account registration, suggest/contact us). A copy of this policy can be found in most language folders.
			That document is called data_protection_policy.php. If the visitor is using a language that does not include a translation of this 
			policy, the visitor will be shown the English translation.</p>

		<span class="optionhead">Prompt for consent regarding personal info</span>
		<p>Before submitting comments, suggestions or new user registrations, site visitors will be required to check a box indicating they
			consent to the information in the form being recorded. If the box is not checked, the submit button will be disabled. If the
			button is clicked anyway, a popup will advise the visitor that the box must be checked before the form can be submitted.</p>

		<span class="optionhead">Living flag set for new people and families</span>
		<p>When turned on, this option defaults all new individuals and families as living. You may uncheck that designation for each person or family</p>

		<span class="optionhead">Allow CSV downloads for reports</span>
		<p>When users run your reports, allow them to download a comma-delimited file of the results. Such files often make it easier to import the information into a spreadsheet.</p>

		<span class="optionhead">reCAPTCHA</span>
		<p>reCAPTCHA is a free service that protects your site from spam and abuse. It uses advanced risk analysis engine to tell humans and 
			bots apart. Visitors will only need to check a box indicating that they are not a robot. To activate this service, you will need
			a Site Key and a Secret.</p>

		<span class="optionhead">Site Key and Secret</span>
		<p>To get your Site Key and Secret, go to https://www.google.com/recaptcha/admin. If you don't already have a Google account you 
			will need to create one. If you do have a Google account, sign in when prompted, then follow the instructions to create your keys. 
			When prompted for your site address/domain name, do NOT enter the "www" and don't put in a trailing slash. After the keys are
			created, paste them into the fields here.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="name"><p class="subheadbold">Names</p></a>

		<span class="optionhead">Name Order</span>
		<p>Dictates how names will be displayed in most cases (some lists always display the surname first). Choose to display the first name first (Western) or the surname first (Oriental).
		If nothing is selected, names will be displayed "first name first".</p>

		<span class="optionhead">Uppercase All Surnames</span>
		<p>Allows you to dispay all surnames in upper case. If this option is set to "No", then names will appear as they were entered or imported.</p>

		<span class="optionhead">Surname Prefixes</span>
		<p>Governs how surname prefixes (i.e., "de" or "van") are treated. By default, anything imported in the GEDCOM surname field is part of the surname, and this dictates how
		surnames are sorted ("de Kalb" comes before "van Buren"). You can elect to keep surname prefixes as part of the surname, or you can choose to treat them
		as separate entities (thus, "van Buren" would then sort before "de Kalb"). Existing surnames will not be affected unless manually edited or converted with surnameconvert400.php.</p>

		<span class="optionhead">Prefix Detection on Import</span>
		<p>If you have elected to treat surname prefixes as separate entities, this section will provide rules to help the import routine decide what is a prefix. Prefixes are defined as
		portions of the name separated by spaces, but you can choose how many prefixes from each name will be part of TNG's prefix. In other words, if you indicate that
		the "Num. prefixes each (max)" is 1, then only the "van" from "van der Merwe" would be moved to the prefix field. On the other hand, if you set this value to 2 or higher, "van der"
		would be the prefix. You may also indicate one or more specific prefixes that should always be treated as full prefixes. In other words, if you set this value to "van der", then
		"van der" will always be considered a valid prefix, regardless of how high or low you set the previous value. Separate multiple values with commas. To recognize a
		prefix offset by an apostrophe, include the apostrophe in this list. For example: "van,vander,van der,d',a',de,das".</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="cem"><p class="subheadbold">Cemeteries</p></a>

		<span class="optionhead">Max lines per column (approx.)</span>
		<p>If you have a lot of cemeteries defined, this number will tell TNG to split the list and create another column when the
		number is reached.</p>

		<span class="optionhead">Suppress "Unknown" categories</span>
		<p>If you define a cemetery with a missing locality (e.g., no state or no county), TNG will normally create a heading labeled
		"Unknown" to accommodate the empty fields. Choosing this option will cause TNG to leave the "Unknown" headings off.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="mail"><p class="subheadbold">Mail and Registration</p></a>

		<span class="optionhead">Email Address</span>
		<p>Your email address. When visitors request a new user account, an email message will be sent to this address. Submissions from the 
			"Contact Us" page will also be sent to this address. Messages originating from the "Suggest" form will go this address if there is
			no email address associated with the tree corresponding to the page from which the suggestion was sent (otherwise, the message
			will be sent there).</p>

		<span class="optionhead">Send all mail from address above</span>
		<p>When someone sends you a message using TNG, the program attempts to send it as if it came from them so that you
		can easily reply. Some hosting providers do not allow that, however. They will refuse to send email unless the sender's
		email address comes from the same domain as your site. If you find that email from TNG is not being sent, your host
		may be doing this to you. If that's the case, setting this option to Yes cause TNG to send all mail from the 
		TNG administrator's address (entered above on this page). That should correct the problem.</p>

		<span class="optionhead">Allow new user registrations</span>
		<p>Allows you to turn off the option for visitors to request a user account on your site.</p>

		<span class="optionhead">Notify on reviewable submissions</span>
		<p>Setting this option to "Yes" will cause an email message to be sent to the administrator whenever a tentative change is entered by someone
		with "Submitter" rights and is waiting for administrative review.</p>

		<span class="optionhead">Create new tree for user</span>
		<p>If this option is set to Yes, a new tree will automatically be created for each new user registration, and the
		user will be assigned to that tree.</p>

		<span class="optionhead">Auto approve new users</span>
		<p>Normally, all new user registrations require the administrator's approval before the accounts can become active.
		Changing this setting to Yes will automatically activate all new user requests. You will still want to edit
		the account settings to make sure the user has the rights you want them to have.</p>

		<span class="optionhead">Send acknowledgement email</span>
		<p>If this option is set to Yes, an email will be sent to each potential new user, informing them that their request
		has been received and is being processed. Does not apply if new registrations are automaticaly activated.</p>

		<span class="optionhead">Include password in welcome email</span>
		<p>Normally a user's chosen password is included in the "welcome" email informing them that their account is
		now active. If you don't want the password to be included, set this option to No.</p>

		<span class="optionhead">Use SMTP Authentication</span>
		<p>Normally TNG sends email by way of the PHP "mail" function. If you'd rather use the Simple Mail Transfer Protocol (meaning that a login
		must be supplied by the program before the mail can be sent), then set this option to "Yes". More options will then become visible. They are: SMTP host name,
		Mail username, Mail password, Port number and Encryption. Your hosting provider should be able to give you the correct values for these fields.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="pref"><p class="subheadbold">Prefixes and Suffixes</p></a>

		<p>These letters are combined with a number to form IDs for the people, families, sources, repositories and notes in your database. Most genealogy
		programs use the same set of standard prefixes (and no suffixes). If your desktop program uses suffixes or different prefixes instead, enter them here.
		If the proper prefixes or suffixes are not entered, some TNG features may not work correctly.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="mobile"><p class="subheadbold">Mobile</p></a>

		<p>The Mobile section allows you to control how TNG is displayed on smart phones and tablets.</p>

		<span class="optionhead">Enable Responsive Tables</span>
		<p>If this option is set to yes, the Tablesaw jQuery plugin that enables the Responsive Tables will be activated.<br />If set to no, then the Tablesaw jQuery plugin options will be bypassed.</p>
		
		<span class="optionhead">Responsive Table Type</span>
		<p>The Responsive Table Type can be set to
		<ul>
			<li><strong>Toggle</strong>, which is the default, displays data columns based on the screen width and priority assigned.  Rotating the smart phone or tablet screen from portrait to landscape orientation will display additional data columns.</li> 
				
			<li><strong>Stack</strong>, which stacks the table headers to a two column layout with headers on the left when the viewport width is less than 40em (640px).</li>
			
			<li><strong>Swipe</strong>, which allows the user to use the swipe gesture (or use the left and right buttons) to navigate the columns.</li>
		</ul>
		<br />
		<span class="optionhead">Enable Responsive Tables Mode Switcher:</span>
		<p>The Mode Switcher option allows the user to switch between toggle, stack, or swipe table column displays.</p>

		<span class="optionhead">Enable Responsive Tables Mini Map</span>
		<p>Use data-tablesaw-minimap to add a series of small dots to show which columns are currently visible and which are hidden. 
			Only available on swipe and toggle options. </p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="misc"><p class="subheadbold">DNA Tests</p></a>

		<span class="optionhead">Hide all DNA pages and data</span>
		<p>If you're not going to use any of the DNA-related features and would like it removed from all public pages, set this option to Yes. DNA Tests will no longer be accessible from the public menus,
			nor will they be seen on any person's individual page.</p>
		<span class="optionhead">Max Search Results</span>
		<p>The Max Search Results in the DNA Test section controls the number of DNA results that can be displayed independently from the TNG search results for queries from the browse DNA tests.</p><p><strong>Note:</strong> If you are not able to select the DNA test you want to compare because it is on another page, increase this limit so all DNA Tests you want to compare are shown on the same page.</p>
		<span class="optionhead">Show DNA Test Number Publicly</span>
		<p>This option allows you to hide or show the DNA Test Number on the public DNA test pages.</p>
		<span class="optionhead">Autofill Ancestral Surnames</span>
		<p>This option automatically adds the Ancestral surnames in your maternal and paternal direct lines when you save the DNA Test. You may want to limit the numbers of generations to use.</p>
		<span class="optionhead">Uppercase Ancestral Surnames </span>
		<p>This option uses all uppercases for the ancestral surnames if Autofill Ancestral Surnames is set to Yes. It defaults to No to display surnames as entered.</p>
		<span class="optionhead">Generations For Ancestral Surnames</span> 
		<p>Specifies how many generations back to search for the ancestral surnames when using the autofill ancestral surnames option</p>
		<span class="optionhead">Exclude From Ancestral Surnames</span>
		<p>Specifies which surnames not to include when using the autofill ancestral surnames option.</p>
	</td>
</tr>		
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="misc"><p class="subheadbold">Miscellaneous</p></a>

		<span class="optionhead">Max Search Results</span>
		<p>This limits the number of results that can be displayed for any public search query. This should be a relatively small, manageable number in order to maximize
		efficiency and enhance the user experience.</p>

		<span class="optionhead">Individuals Start With</span>
		<p>This indicates which information will be initially viewable when an individual record is displayed. If you
		select "Personal Information Only", then other categories such as Notes, Citations or Photos and Histories will
		be hidden until they or "All" are explicitly selected by the user.</p>

		<span class="optionhead">Show Notes</span>
		<p>Allows you to choose where notes are displayed on the individual page. The options are:</p>

		<ul>
			<li>In Notes Section: Displays all notes in a separate block at the bottom of the page.</li>
			<li>Underneath corresponding events where possible: Event-specific notes are displayed directly underneath the events to which they correspond. General notes are displayed
				at the bottom of the "Personal" section and each "Family" section. If the general notes are long, scroll bars will be provided to prevent the pages from getting too long
				(the max height of the area can be found in genstyle.css, in the "notearea" block).</li>
			<li>Underneath events, except general notes: Same as above, but general notes are always displayed in a separate block at the bottom of the page. No max height is imposed.</li>
		</ul>

		<span class="optionhead">Scroll citations</span>
		<p>Setting this to "Yes" will cause the Sources area at the bottom of each person's individual page to have a maximum height. If any person has enough source citations
		to make the area taller than the maximum height, then the area will be scrollable.</p>

		<span class="optionhead">Server time offset (hours)</span>
		<p>If your server is in a different time zone than you are, enter the difference in hours here. If your time is behind the server time, enter a negative number.</p>

		<span class="optionhead">Edit timeout (minutes)</span>
		<p>The number of minutes a user is allowed to have exclusive edit rights to any individual or family record. During this time, any other user who tries to edit
		the same record will see a message indicating that the record is locked. If the original user is still editing the record when the time is about to elapse, that user
		will see a message warning them to save their changes soon. If the user does not attempt to save before another user succeeds in gaining access to the record, those changes
		will be lost.</p>

		<span class="optionhead">Max Generations, GEDCOM download</span>
		<p>The number of maximum number generations that can be exported in a publicly requested GEDCOM file.</p>

		<span class="optionhead">What's New Days</span>
		<p>The number of days to keep new items on the "What's New" page. To remove this limitation, set the value to zero. Doing that will cause older
		items to remain on the list until bumped off by newer items.</p>

		<span class="optionhead">What's New Limit</span>
		<p>The maximum number of items in each category to display on the "What's New" page.</p>

		<span class="optionhead">Numeric Date Preference</span>
		<p>If you enter a numeric date (e.g., 04/09/2008), this option determines whether to interpret the entry as Month/Day/Year (9 Apr 2008)
		or Day/Month/Year (4 Sep 2008).</p>

		<span class="optionhead">First day of week</span>
		<p>When the Calendar page is displayed, this day will be in the first column from the left.</p>

		<span class="optionhead">Parental data on person page</span>
		<p>Choose which events (if any) to display relating to the family of the individual's parents.</p>

		<span class="optionhead">Line Ending</span>
		<p>This is the character string that will included at the end of each line when exporting a GEDCOM file. It's also
		the string that will define the end of a line when importing. The default is "\r\n", which means "carriage return
		plus line feed". Some programs or operating systems prefer just a carriage return (\r) or a line feed (\n), so
		you may wish to adjust this setting at least temporarily in some cases.</p>

		<span class="optionhead">Encryption type</span>
		<p>Passwords in TNG are encrypted before they are stored in the database. Because of that, you can't simply change or remove your password
		by manually editing the database. The default encryption method is md5, but you may select another method here.</p>

		<span class="optionhead">Assign Place records to Trees</span>
		<p>If this is set to "Yes", then each Place record will be associated with one of your Trees. That means that if you have multiple trees, you could have
		the same place appear multiple times in your Places table because it is associated with more than one tree. If you change this option to "No", you 
		will be given the chance to automatically merge all Places into a single list. If you change this option to "Yes", you will see the option to assign
		a particular Tree to all the Places (since they previously wouldn't have had any assignment).</p>

		<span class="optionhead">Geocode all new places</span>
		<p>If this option is set to "Yes", then all new places entered in Admin/People and Admin/Families will be automatically geocoded (assumes an
		Internet connection).</p>

		<span class="optionhead">Re-use deleted IDs</span>
		<p>If this option is set to "Yes", new People, Families, Sources and Repositories will try to reuse ID numbers that were previously deleted.</p>

		<span class="optionhead">Show last import</span>
		<p>If this option is set to "Yes", the date of the most recent GEDCOM import will be shown on the What's New and Statistics pages when a tree is selected.</p>

		<span class="optionhead">Show 'Important tasks' messages</span>
		<p>Set to "Yes" to allow TNG to show you a list of important tasks at the top of the Admin menu. These will include prompts to back up your data, deal with new user
			registrations, and others. You can still choose to collapse the messages even if you allow them to be displayed here.</p>

		<span class="optionhead">Show record totals on Admin menu</span>
		<p>Allows TNG to show totals for each category on the main Admin menu. For example, if there are 1,000 people in your TNG trees, you will see "1,000" on the right side of the "People" bar.</p>

		<span class="optionhead">Alert if no backup in this many days</span>
		<p>After this many days have elapsed since you last backed up at least one of your tables, TNG will include a reminder message in the "Important Tasks" section at the top. To
			stop seeing these messages, set this value to zero.</p>

		<span class="optionhead">I am using TNG offline</span>
		<p>If "Yes" is selected, TNG will use local instead of online versions of its third-party libraries (ie, jQuery) and will not try
			to access Google Maps.</p>

	</td>
</tr>

</table>
</body>
</html>