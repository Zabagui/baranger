<?php 
	global $text, $cms, $subroot, $tmp; 

	$dadlabel = getTemplateMessage('t18_dadside');
	$momlabel = getTemplateMessage('t18_momside');
?>
<body id="bodytop" class="<?php echo pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME); ?> homebody">

<div class="theader">
	<div id="thomemast" class="mast">
		<h1><?php echo getTemplateMessage('t18_maintitle'); ?></h1>
		<span class="tsubtitle"><?php echo getTemplateMessage('t18_headsubtitle'); ?></span>
	</div>
	<div id="tmenu">
		<ul>
<?php
	if($dadlabel) {
?>
			<li>
				<a href="<?php echo $cms['tngpath']; ?>pedigree.php?personID=<?php echo $tmp['t18_dadperson']; ?>&amp;tree=<?php echo $tmp['t18_dadtree']; ?>"><?php echo $dadlabel; ?></a>
			</li>
<?php		
	}
	if($momlabel) {
?>
			<li>
				<a href="<?php echo $cms['tngpath']; ?>pedigree.php?personID=<?php echo $tmp['t18_momperson']; ?>&amp;tree=<?php echo $tmp['t18_momtree']; ?>"><?php echo $momlabel; ?></a>
			</li>
<?php		
	}
	if($tmp['t18_featurelinks'])
		echo showLinks(getTemplateMessage('t18_featurelinks'),false);
?>
		</ul>
	</div>
</div>
<div id="tngcontent">
<!--
-->

<br />
<!-- end of topmenu.php for template 1 -->