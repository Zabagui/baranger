<?php
global $text, $mediatypes, $currentuser, $cms, $allow_admin, $subroot, $tmp, $target, $tngconfig, $logout_url;
?>
<body id="bodytop" class="<?php echo pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME); ?> publicbody">
	<a name="top"></a>
	<div id="cb-main">
		<header class="cb-header clearfix">		
			<div class="cb-shapes">	
				<h1 class="cb-headline" data-left="25.52%">
					<a href="<?php echo $cms['tngpath']; ?>index.php"><?php echo getTemplateMessage('t12_maintitle'); ?></a>
				</h1>
				<h2 class="cb-slogan" data-left="25.52%"><?php echo getTemplateMessage('t12_headsubtitle'); ?></h2>

				<div class="cb-mainimage"><img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t12_headimg']; ?>" alt="" /></div>
			</div>
			<div class="cb-header-search-box">
				<table>
					<tr>
						<td class="cb-searchtext">
							<table>
								<tr>
									<td class="col1and2">
										<a><span class="cb-searchtext"><?php echo $text['mnufirstname']; ?></span></a>
									</td>
									<td class="col1and2" colspan="2">
										<a><span class="cb-searchtext"><?php echo $text['mnulastname']; ?></span></a>
									</td>
								</tr>
								<tr>
									<form class="cb-search" id="topsearchform" name="topsearchform" method="get" 
										action="<?php echo $cms['tngpath']; ?>search.php">
										<td class="col1and2">
											<input type="hidden" value="AND" name="mybool" />
											<input size="17" name="myfirstname" type="text" id="myfirstname" />
										</td><td class="col1and2">
											<input size="17" name="mylastname" type="text" id="mylastname" />
										</td><td >
											<input class="cb-search-button" type="submit" value="&nbsp;&nbsp;">
										</td>
									</form>
								</tr>
								<script>
									document.topsearchform.myfirstname.focus();
								</script>
								<tr>
									<td id="cb-header-links">
										<a href="<?php echo $cms['tngpath']; ?>searchform.php">[<?php echo $text['mnuadvancedsearch']; ?>]</a>
									</td><td colspan="2" id="cb-header-links">
										<a href="<?php echo $cms['tngpath']; ?>surnames.php">[<?php echo $text['mnulastnames']; ?>]</a>
										<br />
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				
			</div>
		</header>   
		<div class="cb-sheet clearfix">
<?php
		# We use a different class for displaying TNG pages
		if (strpos($_SERVER['SCRIPT_NAME'], 'index.php') === false) {
			echo "<div class=\"cb-tng-area\">";
		}
?>