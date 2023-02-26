<?php 
	global $text, $cms, $subroot, $tmp; 

	$dadlabel = getTemplateMessage('t17_dadside');
	$momlabel = getTemplateMessage('t17_momside');
?>
<body id="bodytop" class="<?php echo pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME); ?> homebody">

<div class="theader">
	<div id="thomemast" class="mast">
		<h1><?php echo getTemplateMessage('t17_maintitle'); ?></h1>
		<span class="tsubtitle"><?php echo getTemplateMessage('t17_headsubtitle'); ?></span>
	</div>
	<div id="tmenu">
		<ul>
<?php
	if($dadlabel) {
?>
			<li>
				<a href="<?php echo $cms['tngpath']; ?>pedigree.php?personID=<?php echo $tmp['t17_dadperson']; ?>&amp;tree=<?php echo $tmp['t17_dadtree']; ?>"><?php echo $dadlabel; ?></a>
			</li>
<?php		
	}
	if($momlabel) {
?>
			<li>
				<a href="<?php echo $cms['tngpath']; ?>pedigree.php?personID=<?php echo $tmp['t17_momperson']; ?>&amp;tree=<?php echo $tmp['t17_momtree']; ?>"><?php echo $momlabel; ?></a>
			</li>
<?php		
	}
	if($tmp['t17_featurelinks'])
		echo showLinks($tmp['t17_featurelinks'],false);
?>
		</ul>
	</div>
</div>
<div id="tngcontent">
<!--
-->

<br />
<!-- end of topmenu.php for template 1 -->