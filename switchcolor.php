<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Switch Tab Color</title>
<script src="js/popupwindow.js"></script>
<script src="js/anchorposition.js"></script>
<script src="js/colorpicker2.js"></script>
<script type="text/javascript">
var cp = new ColorPicker('window');
</script>
</head>

<body>
<h1>New TNG Tab Color</h1>
<p>Enter the tab color in hex RGB format (for example, #FF0000) in the box below, or click the palette icon to select.</p>
<p>To make the tab colors match the colors used on your TNG web site:</p>
<ol>
	<li>Edit your genstyle.css file (in your main TNG folder).</li>
	<li>Find the "fieldnameback" section and the "background-color" within that section.</li>
	<li>Copy the 6-character string between the "#" and the ";" and paste it in the field below. The tab displayed will be your "active" tab.</li>
	<li>Next, find the "databack" section in genstyle.css, and again notice the "background-color" within that section.</li>
	<li>Copy the 6-character string between the "#" and the ";" and paste it in the field below. The tab displayed will be your "inactive" tab.</li>
</ol>
<form action="switchcolor2.php" name="form1" method="GET">
Color (in hex RGB format): <input type="text" name="rgbcolor" id="rgbcolor" size="8"> <A HREF="#" onClick="cp.select(document.form1.rgbcolor,'pick5');return false;" NAME="pick5" ID="pick5"><img src="img/tng_colorpicker.gif" alt="" width="19" height="17" border="0"></A></td></tr>
</table>
<input type="radio" name="filename" value="tngtabactive.png" checked> Active tab <input type="radio" name="filename" value="tngtab.png"> Inactive tab
<input type="submit" name="choice" value="Display new tab"> <input type="submit" name="choice" value="Save new tab"><br><br>
<p>If you choose "Save new tab", the tab will be saved in your "photos" folder. You must use an FTP program or a
web-based file manager to move the file (tngtab.png or tngtabactive.png) to the "img" folder within your main TNG folder or your template folder.</p>
<p>If you choose "Display new tab, right-click the image and save it as "tngtabactive.png" (active tab) or "tngtab.png" (inactive tab) in the "img" folder within your main TNG folder.</p>
<p>If no image appears, you may not have the GD image library installed on your server.
Try this link instead: <a href="https://lythgoes.net/genealogy/switchcolor.php">https://lythgoes.net/genealogy/switchcolor.php</a>.</p>
</form>
</body>
</html>