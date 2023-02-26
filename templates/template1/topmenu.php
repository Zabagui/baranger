<?php global $text, $cms, $subroot, $tmp; ?>
<body id="bodytop" class="<?php echo pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME); ?>">

<?php
	//begin HEADER IMAGE (default: picture of the Henefer, Utah cemetery, plus "Our Family History")
	//Actual file name has been replaced with t1_headimgplustitle variable, configurable from Template Settings. Default name of actual image is "home-title.gif"
	//You can replace the t1_titleimage PHP block in the line below with the desired image name if you prefer that to using the Template Settings.

	if($tmp['t1_titlechoice'] == "text") {
?>
	<div style="float:left; margin-right:10px"><img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t1_headimgplustitle']; ?>" alt="" width="93" height="72" border="0" /></div>
	<div>
		<em><a href="index.php" class="toptitle">

		<?php echo getTemplateMessage('t1_maintitle'); ?>

		</a></em>
	</div>
	<br />
<?php
	}
	else {
?>
	<a href="<?php echo $cms['tngpath']; ?>index.php"><img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t1_headimgplustitle']; ?>" alt="" border="0" /></a>
<?php
	}
	//end HEADER IMAGE
?>

<!--
-->

<br />
<!-- end of topmenu.php for template 1 -->