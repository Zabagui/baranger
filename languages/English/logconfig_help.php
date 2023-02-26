<?php
include("../../helplib.php");
echo help_header("Help: Log Settings");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="pedconfig_help.php" class="lightlink">&laquo; Help: Chart Settings</a> &nbsp; | &nbsp;
			<a href="importconfig_help.php" class="lightlink">Help: Import Settings &raquo;</a>
		</p>
		<span class="largeheader">Help: Log Settings</span>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">
		<div id="google_translate_element" style="float:right"></div><script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
		}
		</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

		<span class="optionhead">Log File Name (Public)</span>
		<p>The Log File Name is the file where visitor actions are recorded. You shouldn't have to change this from "genlog.txt".</p>

		<span class="optionhead">Log File Name (Admin)</span>
		<p>The log file where actions in the Admin area are recorded. You shouldn't have to change this from "genlog.txt".</p>

		<p>Note: For added security regarding your log files, check the box labeled "Store in config path" to have TNG keep the log files in that location. You must move the log files to that location yourself prior to saving this value or immediately afterward.</p>

		<span class="optionhead">Max Log Lines (Public)</span>
		<p>Max Log Lines indicates how many actions relating to the public side should be
		retained at any one time. If this number gets too high, you may experience a performance hit.</p>

		<span class="optionhead">Max Log Lines (Admin)</span>
		<p>Indicates how many actions should be retained at any one time in the Admin log file. If this number gets too high, you may experience a performance hit.</p>

		<span class="optionhead">Exclude Host Names</span>
		<p>Before making any log entry, TNG will check this list. If the host of the visitor responsible for the potential log entry
		is on the list, no log entry will be made. Host names should be separated by commas (no spaces) and can consist of entire
		host names, IP addresses, or portions of either. For example, "googlebot" will block "crawler4.googlebot.com".</p>

		<span class="optionhead">Exclude User Names</span>
		<p>Before making any log entry, TNG will check this list as well. If the logged-in user
		is on the list, no log entry will be made. User names should be separated by commas (no spaces).</p>

		<span class="optionhead">Block Suggestions or New User Registrations</span></p>

		<span class="optionhead">Address contains</span>
		<p>Block any incoming suggestion or new user registration where the e-mail address of the sender contains any of the entered words or word segments.
		Separate multiple words with commas.</p>

		<span class="optionhead">Message contains</span>
		<p>Block any incoming suggestion or new user registration where the message body contains any of the entered words or word segments.
		Separate multiple words with commas.</p>
	</td>
</tr>

</table>
</body>
</html>
