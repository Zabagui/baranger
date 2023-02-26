<?php 
	global $text, $cms, $subroot, $tmp;

	$dadlabel = getTemplateMessage('t16_dadside');
	$momlabel = getTemplateMessage('t16_momside');
	$title = getTemplateMessage('t16_maintitle'); 
?>
<body id="bodytop" class="<?php echo pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME); ?> homebody">

<?php
	//begin HEADER IMAGE (default: picture of the Henefer, Utah cemetery, plus "Our Family History")
	//Actual file name has been replaced with t1_headimgplustitle variable, configurable from Template Settings. Default name of actual image is "home-title.gif"
	//You can replace the t1_titleimage PHP block in the line below with the desired image name if you prefer that to using the Template Settings.

	//if($tmp['t16_titlechoice'] == "text") {
?>
<div id="tcontainer">
	<div id="tbackground">
		<div id="tpage">
			<div class="theader">
				<div id="tmast" class="mast">
					<h1><?php echo $title; ?></h1>
				</div>
				<div id="tmenu">
					<ul>
<?php
	if($dadlabel) {
?>
						<li>
							<a href="<?php echo $cms['tngpath']; ?>pedigree.php?personID=<?php echo $tmp['t16_dadperson']; ?>&amp;tree=<?php echo $tmp['t16_dadtree']; ?>"><?php echo $dadlabel; ?></a>
						</li>
<?php		
	}
	if($momlabel) {
?>
						<li>
							<a href="<?php echo $cms['tngpath']; ?>pedigree.php?personID=<?php echo $tmp['t16_momperson']; ?>&amp;tree=<?php echo $tmp['t16_momtree']; ?>"><?php echo $momlabel; ?></a>
						</li>
<?php		
	}
	if($tmp['t16_featurelinks'])
		echo showLinks($tmp['t16_featurelinks'],false);
?>
					</ul>
				</div>
			</div>
			<div id="tbody">
				<div id="tmainbody">
<!-- end of topmenu.php for template 1 -->