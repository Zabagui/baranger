<?php
include("../../helplib.php");
echo help_header("Help: Users");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="templateconfig_help.php" class="lightlink">&laquo; Help: Template Settings</a> &nbsp; | &nbsp;
			<a href="trees_help.php" class="lightlink">Help: Trees &raquo;</a>
		</p>
		<span class="largeheader">Help: Users</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Search</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Add or Edit</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Delete</a> &nbsp; | &nbsp;
			<a href="#review" class="lightlink">Review</a> &nbsp; | &nbsp;
			<a href="#rights" class="lightlink">Rights</a> &nbsp; | &nbsp;
			<a href="#limits" class="lightlink">Access Limits</a> &nbsp; | &nbsp;
			<a href="#email" class="lightlink">E-mail</a>
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
		<p>Locate existing users by searching for all or part of the <strong>Username, Description, Real Name</strong> or <strong>E-mail</strong>. Check the "Show
		Admin users only" option to further narrow your search.
		Searching with no options selected and no value in the search box will find all users in your database.</p>

		<p>Your search criteria for this page will be remembered until you click the <strong>Reset</strong> button, which restores all default values and searches again.</p>

		<span class="optionhead">Actions</span>
		<p>The Action buttons next to each search result allow you to edit or delete that result. To delete more than one record at a time, click the box in the
		<strong>Select</strong> column for each record to be deleted, then click the "Delete Selected" button at the top of the list. Use the <strong>Select All</strong> or <strong>Clear All</strong>
		buttons to toggle all select boxes at once.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="add"><p class="subheadbold">Adding New Users</p></a>
		<p>Setting up user records for your visitors allows you to give them special rights that they can enjoy only after logging in with their username and password. The
		first user you create should be the administrator (someone who has all rights and is not restricted to any tree, usually yourself). If you don't give yourself (the administrator) 
		adequate rights, you may not be able to get back into the Admin area. If you forget your username, go to the TNG login page and enter the e-mail
		address associated with your user account to have your username e-mailed to you. If you forget your password, enter your e-mail address and username to have a new,
		temporary password sent to you. After logging in with the new password, you can return to Admin/Users and reset the password to something more memorable.</p>
		
		<p>To add a new user, click on the <strong>Add New</strong> tab, then fill out the form. To edit an existing user, click on the Edit icon next to that user. When
		adding or editing a user, take note of the following:</p>

		<span class="optionhead">Description</span>
		<p>Give your user a short description to help you remember who it is. For example, you might enter "Site Administrator" or "Aunt Martha".</p>

		<span class="optionhead">Username</span></span>
		<p>A unique one-word identifier for this user (no two users may have the same username). The user will be required to enter the username when logging in. 20 characters max.</p> 

		<span class="optionhead">Password</span>
		<p>A secret word or string of characters (no spaces) that this user must also enter when logging in. When entered by the user in the appropriate field, the actual
		characters typed will be replaced on the screen by asterisks or some other character for privacy. 20 chars max. The password
		is encrypted in the database and may not be retrieved for viewing by anyone, including this user and Next Generation Software.</p>

		<span class="optionhead">Real Name</span>
		<p>The actual name (if applicable) of the user assigned to this information.</p>

		<span class="optionhead">Phone, E-mail, Web Site, Address, City, State/Province, Zip/Postal Code, Country, Notes</span>
		<p>Optional information pertaining to the user.</p>

		<span class="optionhead">Do not send mass e-mail to this user</span>
		<p>Check this box if you do not want any mass e-mail (see below) to be sent to this user.</p>

		<span class="optionhead">Tree / Person ID</span>
		<p>If this user corresponds to anyone in your database, you may indicate the Tree and Person ID of their individual record
		here. Doing this will allow this user to see living data for their own record even if their record is not included in
		their assigned tree or branch.</p>

		<span class="optionhead">Disabled</span>
		<p>Check this box to prevent this user from logging in without deleting his or her entire account.</p>

		<span class="optionhead">Roles and Rights</span>
		<p>See <a href="#rights">below for details on the roles and rights</a> that may be assigned to users.</p>

		<p><span class="optionhead">Required fields:</span> You must enter a username, a password, and a user description. All the other fields are optional, but it is highly
		recommended that you enter your e-mail address, just in case you forget your username or password at some point.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="delete"><p class="subheadbold">Deleting Users</p></a>
		<p>To delete a user, use the <a href="#search">Search</a> tab to locate the user, then click on the Delete icon next to that user record. The row will
		change color and then vanish as the user is deleted.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="review"><p class="subheadbold">Review</p></a>

		<p>Click on the "Review" tab to manage new user registrations. These user records will not become active until they are edited and saved the first time. Once a record becomes 
		active, it will no longer be displayed on the Review tab. Instead, it will be findable on the "Search" tab.</p>
		
		<p>New user records listed on the Review page can be deleted or edited in the same way regular user records are deleted or edited. When editing a new user
		record, take note of the following:</p>
		
		<span class="optionhead">Notify this user upon account activation</span>
		<p>Check this box to send an e-mail notification to the new user upon activation (when the page is saved). The text of the message appears in the box below
		this option. Changes may be made prior to sending.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="rights"><p class="subheadbold">Roles and Rights</p></a>

		<p>A "Right" is something a user may do when they are logged in. A "Role" is a predefined set of rights, so the
		list of selected rights (on the right side of the page) will change if you select a different role (the "Allow" rights
		at the bottom of the column are not affected by a role selection). You may
		define your own set of rights for a user by selecting "Custom" as the Role. Some roles imply that the user will be
		assigned to a tree, while others imply that the user will not be assigned to any tree. The role you select may
		therefore cause the assigned tree field to become deselected.</p>

		<p>The following rights can be assigned to a user:</p>
		
		<span class="optionhead">Allow to add any new data</span>
		<p>User may enter the Admin area to add new records, including media.</p>

		<span class="optionhead">Allow to add media only</span>
		<p>User may enter the Admin area to add new media, but nothing else.</p>

		<span class="optionhead">No Add rights</span>
		<p>User may not any new data.</p>

		<span class="optionhead">Allow to edit any existing data</span>
		<p>User may enter the Admin area to edit existing records, including media.</p>

		<span class="optionhead">Allow to edit media only</span>
		<p>User may enter the Admin area to edit existing media, but nothing else.</p>

		<span class="optionhead">Allow to submit edits for administrative review</span>
		<p>User may not enter the Admin area for editing purposes. Tentative changes may be made from the public area by clicking on the small
		Edit icon next to eligible events on the Individual and Family Group pages. Changes do not become permanent until approved by the administrator.</p>

		<span class="optionhead">No Edit rights</span>
		<p>User may not make changes to existing records.</p>

		<span class="optionhead">Allow to delete any existing data</span>
		<p>User may enter the Admin area to delete existing records, including media.</p>

		<span class="optionhead">Allow to delete media</span>
		<p>User may enter the Admin area to delete media, but nothing else.</p>

		<span class="optionhead">No Delete rights</span>
		<p>User may not delete any existing records.</p>

		<p>These rights are independent of the selected Role:</p>

        <span class="optionhead">Allow to view information for living individuals</span>
		<p>User may view information for living individuals while in the public area.</p>

        <span class="optionhead">Allow to view information for private individuals</span>
		<p>User may view information for private individuals while in the public area.</p>

        <span class="optionhead">Allow to view private notes</span>
		<p>User may view notes marked as private while in the public area.</p>

	    <span class="optionhead">Allow to download GEDCOMs</span>
		<p>User may use the GEDCOM tab to download a GEDCOM file from the GEDCOM tab in the public area. This overrides the setting for each tree in Admin/Trees.</p>

	    <span class="optionhead">Allow to download PDfs</span>
		<p>User may use the PDF option to create a PDF file from various pages in the public area. This overrides the setting for each tree in Admin/Trees.</p>

		<span class="optionhead">Allow to view LDS information</span>
		<p>User may view LDS information while in the public area.</p>

		<span class="optionhead">Allow to edit user profile</span>
		<p>User may edit their user information (username, password, etc.) from a link in the public area.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">
		
		<p style="float:right"><a href="#top">Top</a></p>
		<a name="limits"><p class="subheadbold">Access Limits</p></a>

		<p>These define the limits of a user's rights. All users (including anonymous visitors) may view information for deceased individuals at any time. No rights or access 
		limits are required.</p>
		
		<span class="optionhead">Allow access to all system settings...</span>
		<p>Check this option to allow the user to access system-wide options, such as the General Settings or Users.</p>

		<span class="optionhead">Restrict to Tree/Branch</span>
		<p>To restrict a user's rights to a particular tree, select that tree here. To restrict rights to a particular branch within the
		selected tree, select that branch here as well. Assigning a user to a branch will not prevent that user from seeing other individuals not in that branch.</p>

		<span class="optionhead">Apply rights to multiple trees</span>
		<p>To restrict a user's rights to more than one tree, select this option and then Ctrl+click or Command+click those trees here. When
			the user logs in for the first time, the first tree in the list will be selected. The user can switch trees using the dropdown in the upper
			right corner of the Admin menu (the dropdown is only visible when an alternate tree selection is available). Subsequent logins from the 
			same browser will result in the most recently used tree being selected to start.
			The user can also switch trees from the public Trees page. A branch selection cannot be made in this mode.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="email"><p class="subheadbold">E-mail</p></a>
		<p>This tab allows you to send e-mail to all users, or all users assigned to a particular tree/branch combination.</p>
		
		<span class="optionhead">Subject</span>
		<p>The subject of your e-mail.</p>

		<span class="optionhead">Text</span>
		<p>The body of your e-mail.</p>

		<span class="optionhead">Tree</span>
		<p>If you want to send this message only to users assigned to a particular tree, select that tree here.</p>

		<span class="optionhead">Branch</span>
		<p>If you want to send this message only to users assigned to a particular branch within the selected tree,
		select that branch here.</p>

	</td>
</tr>

</table>
</body>
</html>