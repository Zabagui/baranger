<?php
	global $text, $currentuser, $cms, $allow_admin, $subroot, $tmp, $homepage;

	$dadlabel = getTemplateMessage('t15_dadside');
	$momlabel = getTemplateMessage('t15_momside');
	$pagetitle = getTemplateMessage('t15_maintitle');
?>
<body id="bodytop" class="<?php echo pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME); ?> home-page content-sidebar tng-nav tng-home">
<div class="scroll-to-top"><a href="#"><img src="<?php echo $cms['tngpath']; ?>img/backtotop.png" alt="" /></a></div>
<div class="site-container">
	<nav class="nav-primary">
		<div class="wrap">
			<div class="responsive-menu-icon"></div>
			<ul class="menu nav-menu menu-primary responsive-menu">
				<li class="first menu-item current-menu-item"><a href="<?php echo $cms['tngpath'] . $homepage; ?>"><?php echo $text['homepage'];?></a></li>
<?php
	if($dadlabel) {
?>
				<li class="menu-item"><a href="<?php echo $cms['tngpath']; ?>pedigree.php?personID=<?php echo $tmp['t15_dadperson']; ?>&amp;tree=<?php echo $tmp['t15_dadtree']; ?>"><?php echo $dadlabel; ?></a></li>
<?php		
	}
	if($momlabel) {
?>
				<li class="menu-item"><a href="<?php echo $cms['tngpath']; ?>pedigree.php?personID=<?php echo $tmp['t15_momperson']; ?>&amp;tree=<?php echo $tmp['t15_momtree']; ?>"><?php echo $momlabel; ?></a></li>
<?php		
	}
	if($tmp['t15_featurelinks'])
		echo showLinks($tmp['t15_featurelinks'],false,"menu-item");
?>
				<li class="search-menu-item">
					<form id="topsearchform" name="topsearchform" method="get" action="<?php echo $cms['tngpath'];?>search.php">
					<?php echo getFORM( "search", "get", "", ""); ?>
						<input type="hidden" value="AND" name="mybool" />
						<?php echo $text['firstname']; ?>:&nbsp;<input size="12" name="myfirstname" type="text" id="myfirstname" /> &nbsp;
						<?php echo $text['lastname']; ?>:&nbsp;<input size="12" name="mylastname" type="text" id="mylastname" /> &nbsp;
						<input type="submit" value="<?php echo $text['search']; ?>"/>
					</form>
				</li>
			</ul>
		</div>
	</nav>
	<header class="site-header">
		<div class="wrap">
			<div class="title-area">
				<h1 class="site-title"><a href="<?php echo $cms['tngpath'] . $homepage; ?>"><?php echo $pagetitle; ?></a></h1>
			</div>
			<aside class="widget-area">
				<section class="widget">
					<div class="widget-wrap">
						<aside class="widget-area">
							<section class="widget">
								<div class="widget-wrap">
									<a href="<?php echo $cms['tngpath'] . $homepage; ?>"><img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t15_titleimg']; ?>" title="" alt=""></a>
								</div>
							</section>
						</aside>
					</div>
				</section>
			</aside>
		</div>
	</header>
	<div class="site-inner">
