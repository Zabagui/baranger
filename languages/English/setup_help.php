<?php
include("../../helplib.php");
echo help_header("Help: Setup");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="second_help.php" class="lightlink">&laquo; Help: Post-Import Utilities</a> &nbsp; | &nbsp;
			<a href="config_help.php" class="lightlink">Help: General Settings &raquo;</a>
		</p>
		<span class="largeheader">Help: Setup</span>
		<p class="smaller menu">
			<a href="#config" class="lightlink">Configuration</a> &nbsp; | &nbsp;
			<a href="#diag" class="lightlink">Diagnostics</a> &nbsp; | &nbsp;
			<a href="#tables" class="lightlink">Table Creation</a>
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

		<a name="config"><p class="subheadbold">Configuration</p></a>
		<p>This page contains access points to various categories of TNG settings. Edit the settings in each category to reflect your web site's file layout, your
		MySQL database,	and other configurable options. Change other settings to affect the display of your various pages.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="diag"><p class="subheadbold">Diagnostics</p></a>

		<span class="optionhead">Run Diagnostics</span>
		<p>This page shows information about your web server setup, including warnings about settings that may interfere with TNG's performance.</p>

		<span class="optionhead">PHP Info Screen</span>
	   	<p>This page shows information about your PHP installation. The display of this information is a function of PHP, not TNG. The page is divided into blocks
		that describe separate areas of the configuration. If you are not able to connect to the MySQL database, check this page and look for a "mysql" block. If
		you do not see it, that means that PHP is not yet communicating with MySQL. That indicates a problem with the PHP setup, not with TNG.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="tables"><p class="subheadbold">Table Creation</p></a>

		<span class="optionhead">Create Tables</span>
		<p>Click on this button <strong>ONLY</strong> when setting up your site for the first time, as this will create the database tables needed to
		hold your data. <strong>Note: If the tables already exist, any and all previous data will be lost!</strong> You may want to perform this operation anyway
		if your data has been corrupted and you can be restored from backups after recreating the tables.</p>

		<span class="optionhead">Collation</span>
		<p>If you're using UTF-8 as your character set, you might need to enter utf8_unicode_ci, utf8_general_ci or similar in this field prior to creating the tables.
		Otherwise, just leave this field blank to accept the default collation.</p>
	</td>
</tr>

</table>
</body>
</html>
