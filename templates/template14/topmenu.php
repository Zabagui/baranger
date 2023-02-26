<?php 
	global $text, $cms, $subroot, $tmp; 

	$dadlabel = getTemplateMessage('t14_dadside');
	$momlabel = getTemplateMessage('t14_momside');
?>

<body id="bodytop" class="<?php echo pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME); ?>">
<div id="art-main">
    <div class="cleared reset-box"></div>
	<div class="art-nav">
		<div class="art-nav-l"></div>
		<div class="art-nav-r"></div>
	<div class="art-nav-outer">
	<div class="art-nav-wrapper">
	<div class="art-nav-inner">
		<ul class="art-hmenu">
<?php
	if($dadlabel) {
?>
			<li>
				<a href="<?php echo $cms['tngpath']; ?>pedigree.php?personID=<?php echo $tmp['t14_dadperson']; ?>&amp;tree=<?php echo $tmp['t14_dadtree']; ?>"><span class="l"></span><span class="r"></span><span class="t"><?php echo $dadlabel; ?></span></a>
			</li>
<?php		
	}
	if($momlabel) {
?>
			<li>
				<a href="<?php echo $cms['tngpath']; ?>pedigree.php?personID=<?php echo $tmp['t14_momperson']; ?>&amp;tree=<?php echo $tmp['t14_momtree']; ?>"><span class="l"></span><span class="r"></span><span class="t"><?php echo $momlabel; ?></span></a>
			</li>
<?php		
	}
	if($tmp['t14_featurelinks'])
		echo showLinks($tmp['t14_featurelinks'],false,"","<span class=\"l\"></span><span class=\"r\"></span><span class=\"t\">xxx</span>");
?>
		</ul>
	</div>
	</div>
	</div>
	</div>
	<div class="cleared reset-box"></div>
	<div class="art-sheet">
	        <div class="art-sheet-cc"></div>
	        <div class="art-sheet-body">
	            <div class="art-content-layout">
	                <div class="art-content-layout-row">
	                    <div class="art-layout-cell art-content">
							<div class="art-post">
							    <div class="art-post-body">
									<img alt="" class="rounded4 vignette" height="100" src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t14_headimg3']; ?>" />
									<img alt="" class="rounded4 vignette" height="100" src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t14_headimg2']; ?>" />
									<img alt="" class="rounded4 vignette" height="100" src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t14_headimg']; ?>" />
									<h1 class="site-head"><a href="<?php echo $cms['tngpath']; ?>index.php"><?php echo getTemplateMessage('t14_maintitle'); ?></a></h1>
									<h3 class="subheader"><?php echo getTemplateMessage('t14_headsubtitle'); ?></h3>
