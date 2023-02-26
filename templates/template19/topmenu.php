<?php
	global $text, $currentuser, $cms, $allow_admin, $subroot, $tmp, $homepage;

	$dadlabel = getTemplateMessage('t19_dadside');
	$momlabel = getTemplateMessage('t19_momside');
	$pagetitle = getTemplateMessage('t19_maintitle');
?>
<body id="bodytop" class="<?php echo pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME); ?> home-page content-sidebar tng-nav tng-home">
<div class="scroll-to-top"><a href="#"><img src="<?php echo $cms['tngpath'] . $templatepath; ?>img/backtotop.png" alt="" /></a></div>

<header>
	<div class="container">
			<p class="brand"><img class="img-left" src="<?php echo $cms['tngpath']  . $templatepath . $tmp['t19_headimg']; ?>" alt="" /><a href="<?php echo $homepage; ?>"><?php echo $pagetitle; ?></a></p>
			<p class="slogan"><?php echo getTemplateMessage('t19_headsubtitle'); ?></p>
	</div>
	<div class="nav-menu">
		<div class="container">
	<?php
			if(!isset($title) || !$title)
			    $title = getTemplateMessage('t19_maintitle'); 
			echo tng_icons(1, $title);
			$flags['noicons'] = 1; 
			?>
		</div>
	</div>
</header>


<div class="container">
