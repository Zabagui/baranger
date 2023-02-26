<?php
include("../../helplib.php");
echo help_header("Help: Administration");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="modmanager_help.php" class="lightlink">&laquo; Help: Mod Manager</a> &nbsp; | &nbsp;
			<a href="people_help.php" class="lightlink">Help: People &raquo;</a>
		</p>
		<span class="largeheader">Help: Getting Started</span>
		<p class="smaller menu">
			<a href="#gettingstarted" class="lightlink">Getting Started</a> &nbsp; | &nbsp;
			<a href="#notes" class="lightlink">Notes</a> &nbsp; | &nbsp;
			<a href="#otherresources" class="lightlink">Other Resources</a>
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

		<a name="gettingstarted"><p class="subheadbold">Getting Started:</p></a>
		<p>Not sure what to do first? Here are the basics:</p>
		<ol>
				<li><p><strong>Carefully follow the installation instructions in the <a href="../../readme.html" target="_blank">readme.html</a> file.</strong> All of the essential configuration
					can be done directly from that page, but you can also enter all the needed values from <strong>Setup</strong> here on the main Admin menu.</p></li>
				<li><p><strong>Create at least one Tree.</strong> Unless you've got more than one independent GEDCOM file, you probably need only one tree.</p></li>
				<li><p><strong>Create at least one User.</strong> The first user created must be an Administrator (must have all rights and NOT be restricted to any Tree).</p></li>
				<li><p><strong>Import your GEDCOM file, or begin entering your information manually</strong>. If you're entering it by hand, it doesn't matter what you enter first.
					Some like to enter people first and then link them into families, while others like to start with families and add the individuals second. You
					don't have to stick to one strategy.</p></li>
				<li><p><strong>Look at the Post-import Utilities</strong> (under Import/Export) and perform any of those that you think necessary (see the Help
					there for more information).</p></li>
				<li><p><strong>Media.</strong> Once your data has been entered or imported, you can start linking in photos, histories and other media. Have fun!</p></li>
				<li><p><strong>Get a map key.</strong> Google Maps is once again requiring a key. Please go into Setup and then Map Settings, then click the Help link there
					to see instructions on how to get a key and what to do with it. Your maps won't work until that is done.</p></li>
				<li><p><strong>Everything else.</strong> You'll also want to explore the other sections of the Admin menu. Additional help can be found on
					each page.</p></li>
		</ol>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="notes"><p class="subheadbold">Notes:</p></a>
		<ol>
				<li><p>If you notice some options are missing from the Administration menu, it is likely that you are not logged in with full permissions, or that your rights are restricted to a particular tree.
				To make changes to user permissions, log out and log in as an administrator, or edit your database directly using phpMyAdmin or a similar tool.</p></li>
				<li><p>The link to Public Home in the top frame will take you to your home page and will fill your browser window. The Public Home link in the left frame will open your home
				page in the right, main frame, allowing you to navigate around your site and return to the Admin section at any time by clicking on another link in the left frame.</p></li>
		</ol>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="otherresources"><p class="subheadbold">Other Resources:</p></a>
		<ol>
			<li><p>Updates mailing list: <a href="mailto:tngusers@lythgoes.net">tngusers@lythgoes.net</a>. To subscribe, send a message to
				<a href="mailto:tngusers-subscribe@lythgoes.net">tngusers-subscribe@lythgoes.net</a>. This list is used exclusively to inform users of
				software updates and related issues. </p></li>
			<li><p>Users mailing list: <a href="mailto:tngusers2@lythgoes.net">tngusers2@lythgoes.net</a>. To subscribe, send a message to
				  <a href="mailto:tngusers2-subscribe@lythgoes.net">tngusers2-subscribe@lythgoes.net</a>. This list may be used for all discussion among TNG users. </p></li>
			<li><p>Users forum: <a href="https://tng.community" target="_blank">https://tng.community</a>.</p></li>
			<li><p>TNG Wiki: <a href="https://tng.lythgoes.net/wiki" target="_blank">https://tng.lythgoes.net/wiki</a> A MediaWiki site that contains:</p>
				<ul>
				<li><a href="https://tng.lythgoes.net/wiki/index.php?title=Category:Getting_Started" target="_blank">TNG Getting Started Guide</a>. How to customize your site and create user pages.</li>
				<li><a href="https://tng.lythgoes.net/wiki/index.php?title=Category:Visitors" target="_blank">TNG Guest Visitors Guide</a>. How visitors might navigate your site.</li>
				<li><a href="https://tng.lythgoes.net/wiki/index.php?title=Category:Registered_Users" target="_blank">TNG Registered Users Guide</a>. How to use the capabilities of TNG as a Registered User or Administrator.</li>
				<li><a href="https://tng.lythgoes.net/wiki/index.php?title=Category:Administrator" target="_blank">TNG Administrators Guide</a>. Provides information for the administator of a TNG web site.</li>
				<li><a href="https://tng.lythgoes.net/wiki/index.php?title=Category:Programmer" target="_blank">TNG Programmers Guide</a>. Help understanding how TNG works, and for programmers making changes to TNG.</li>
				<li><a href="https://tng.lythgoes.net/wiki/index.php?title=TNG_Glossary" target="_blank">TNG Glossary of Terms</a> Words and phrases used in TNG relating to genealogy, computing and archival organization.</li>
				</ul><br />
			</li>
			<li><p>PHP Reference: <a href="https://php.net" target="_blank">https://php.net</a>.</p></li>
			<li><p>MySQL Reference: <a href="https://mysql.com" target="_blank">https://mysql.com</a>.</p></li>
			<li><p>HTML Reference: <a href="https://htmlhelp.com" target="_blank">https://htmlhelp.com</a>.</p></li>
			<li><p>Contact the author directly: <a href="mailto:darrin@lythgoes.net">darrin@lythgoes.net</a>.</p></li>
			</ol>
		<p>Need research help? Try <a href="https://legacytree.com/tng" target="_blank">LegacyTree Genealogists</a>.</p>
	</td>
</tr>

</table>
</body>
</html>
