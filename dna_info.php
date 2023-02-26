<?php
// %version:11.0.0.2%
//Created By Add DNA Test Results Mod
require_once("begin.php");
require_once($cms['tngpath'] . "genlib.php");
$textpart = "dna";
require_once($cms['tngpath'] . "getlang.php");
require_once($cms['tngpath'] . "$mylanguage/text.php");

header("Content-type:text/html; charset=" . $session_charset);
?>
<div class="databack ajaxwindow" id="dnainfo">
<span class="subhead"><img src="<?php echo $cms['tngpath']; ?>img/dna_icon.gif" width="20" height="20" align="left" alt="" vspace="0" />&nbsp;<strong><?php echo $text['dna_info_head']; ?></strong></span><br/><br/>

<a><font size="2" color="#000000"><?php echo $text['Ydna_LITbox_info']; ?></font></a>

<br/><br/>
<form >
<input type="button" onclick="tnglitbox.remove();return false;" value="<?php echo $text['closewindow']; ?>" />
</form>
</div>