<?php
include($cms['tngpath'] . "surname_cloud.class.php");
$flags['noicons'] = true;
$flags['noheader'] = true;
$flags['nobody'] = true;
$tngconfig['showshare'] = false;
tng_header( $sitename ? "" : $text['ourhist'], $flags );
if(!$cms['support'] && $sitever != "mobile")
	echo "<body id=\"bodytop\" class=\"" . pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME) . " homebody\">\n";

$dadlabel = getTemplateMessage('t17_dadside');
$momlabel = getTemplateMessage('t17_momside');
$title = getTemplateMessage('t17_maintitle'); 
?>

<style>
body {
	margin: 0px;
	background-color: #272727;
}

#mcontent {
	padding-top: 0px;
}

#big-block-1 {
	background: url('<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t17_mainimage']; ?>');
	background-repeat: no-repeat;
	background-position: center 45%;
	background-size: 100% auto;
	height: 250px;
}
</style>

<div class="theader">
	<div id="thomemast" class="mast">
		<h1><?php echo $title; ?></h1>
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
	echo showLinks($tmp['t17_featurelinks'],false);
?>
		</ul>
	</div>
</div>
<div class="tblock" id="big-block-1">
	<!--
	<div class="quote">
		<h2><?php echo getTemplateMessage('t17_welcome'); ?></h2>
		<p>Some other text goes here. Something about your family. Maybe a few paragraphs. blah blah blah blah.</p>
	</div>
-->
</div>
<div class="tblock-dark" id="big-block-2">
	<div id="linkarea">
		<ul class="left-indent">
			<li class="linkcol">
				<article class="post">
					<header class="entry-header">
						<h2 class="entry-title"><?php echo getTemplateMessage('t17_welcome'); ?></h2></a>
					</header>
					<div class="entry-content">
						<?php echo getTemplateMessage('t17_mainpara'); ?>
					</div>
<?php
	if( $currentuser ) {
	    echo "<p class=\"entry-content\"><strong>{$text['welcome']}, $currentuserdesc.</strong></p>\n";
		echo "<ul class=\"home-menus\">\n";

		echo "<li><a href=\"logout.php\">{$text['mnulogout']}</a></li>\n";
	}
	else {
		echo "<ul class=\"home-menus\">\n";
		echo "<li><a href=\"login.php\">{$text['mnulogon']}</a></li>";
		if(!$tngconfig['disallowreg']) {
?>
			<li><a href="newacctform.php"><?php echo $text['mnuregister']; ?></a></li></p>
<?php
		}
	}

	echo "</ul>\n";
?>
					<br />
				</article>
			</li>
			<li class="linkcol">
				<article class="post">
       				<h2 class="entry-title"><?php echo $text['search']; ?></h2>
					<form method="get" name="searchform" action="search.php" class="entry-content" style="border:1px solid #e2c2a9;padding:10px">
						<div style="display:inline-block;">
						  	<label for="myfirstname"><?php echo $text['firstname']; ?></label><br/>
						    <input type="text" value="" name="myfirstname" />
						    <br /><br />
						  	<label for="mylastname"><?php echo $text['lastname']; ?></label><br/>
						    <input type="text" value="" name="mylastname" />
						    <br/>
							<input type="hidden" name="mybool" value="AND" />
						</div>
						<div style="display:inline-block;vertical-align:top;padding:15px">
							<input type="submit" id="search-submit" class="btn" value="<?php echo $text['search']; ?>" />
							<br /><br />
							<ul class="home-menus">
								<li><a href="surnames.php"><?php echo $text['surnames']; ?></a></li>
								<li><a href="searchform.php"><?php echo $text['mnuadvancedsearch']; ?></a></li>
							</ul>
						</div>
					</form>

<?php
	if($chooselang) {
?>
														<div class="left-indent">
															<br/>
<?php
		$query = "SELECT languageID, display, folder FROM $languages_table ORDER BY display";
		$result = tng_query($query);
		$numlangs = tng_num_rows( $result );

		if($numlangs > 1) {
			echo getFORM( "savelanguage2", "get", "tngmenu3", "" );
			echo "<select name=\"newlanguage3\" id=\"newlanguage3\" style=\"font-size:11px;\" onchange=\"document.tngmenu3.submit();\">";

			while( $row = tng_fetch_assoc($result)) {
				echo "<option value=\"{$row['languageID']}\"";
				if( $languages_path . $row['folder'] == $mylanguage )
					echo " selected=\"selected\"";
				echo ">{$row['display']}</option>\n";
			}
			echo "</select>\n";
			echo "<input type=\"hidden\" name=\"instance\" value=\"3\" /></form>\n";
		}

		tng_free_result($result);
?>
														</div>
<?php
	}
?>

					<div class="left-indent">
						<h3 class="entry-title"><?php echo $text['contactus']; ?></h3>
						<p class="entry-content"><img src="<?php echo $cms['tngpath'] . $templatepath; ?>img/email.gif" alt="email image" class="emailimg" /><?php echo $text['contactus_long']; ?></p>
					</div>
				</article>
			</li>
			<li class="linkcol">
				<article class="post">
					<header class="entry-header">
						<a href="<?php echo $tmp['t17_featurelink1']; ?>" title="" class="alignnone"><h2 class="entry-title"><?php echo getTemplateMessage('t17_featuretitle1'); ?></h2></a>
					</header>
					<div class="entry-content">
						<?php 
							echo getTemplateMessage('t17_featurepara1'); 
							$tl1 = getTemplateMessage('t17_featurelink1');
							if($tl1) {
						?>
							<p><a class="footer-link" href="<?php echo $tl1; ?>"><?php echo $text['more']; ?> ...</a></p>
						<?php
							}
						?>
					</div>
				</article>
			</li>
		</ul>
	</div>
	<div style="clear:left"></div>
</div>
<div class="tblock" id="big-block-3">
	<h2><a href="<?php echo $tmp['t17_featurelink2']; ?>" title=""><?php echo getTemplateMessage('t17_featuretitle2'); ?></a></h2>
	<div class="left-indent mainsection">
		<br/>
		<div class="two-cols"><img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t17_featurethumb2']; ?>" alt="" title="">
		<?php 
			echo getTemplateMessage('t17_featurepara2'); 
			$tl2 = getTemplateMessage('t17_featurelink2');
			if($tl2) {
		?>
			<p><a class="footer-link" href="<?php echo $tl2; ?>"><?php echo $text['more']; ?> ...</a></p>
		<?php
			}
		?>
	</div>
	</div>
	<div style="clear:left"></div>
</div>
<div id="tfooter">
	<div class="other-features">
		<h2><?php echo $text['mnufeatures']; ?></h2>
	</div>
	<div class="linkcol2">
		<ul class="fancy_list newspaper2">
			<li><a href="whatsnew.php"><?php echo $text['mnuwhatsnew']; ?></a></li>
			<li><a href="mostwanted.php"><?php echo $text['mostwanted']; ?></a></li>
			<li><a href="places.php"><?php echo $text['places']; ?></a></li>
			<li><a href="browsenotes.php"><?php echo $text['notes']; ?></a></li>
			<li><a href="anniversaries.php"><?php echo $text['anniversaries']; ?></a></li>
			<li><a href="calendar.php"><?php echo $text['calendar']; ?></a></li>
			<li><a href="reports.php"><?php echo $text['reports']; ?></a></li>
			<li><a href="statistics.php"><?php echo $text['mnustatistics']; ?></a></li>
<?php
	foreach( $mediatypes as $mediatype ) {
		if(!$mediatype['disabled']) {
			echo "<li><a href=\"browsemedia.php?mediatypeID={$mediatype['ID']}\">{$mediatype['display']}</a></li>\n";
		}
	}
?>
			<li><a href="browsemedia.php"><?php echo $text['allmedia']; ?></a></li>
			<li><a href="browsealbums.php"><?php echo $text['albums']; ?></a></li>
			<li><a href="cemeteries.php"><?php echo $text['mnucemeteries']; ?></a></li>
			<li><a href="browsesources.php"><?php echo $text['mnusources']; ?></a></li>
			<li><a href="browserepos.php"><?php echo $text['repositories']; ?></a></li>
<?php
    if( !$tngconfig['hidedna'] ) {
?>
			<li><a href="browse_dna_tests.php"><?php echo $text['dna_tests']; ?></a></li>
<?php
	}
?>
			<li><a href="bookmarks.php"><?php echo $text['bookmarks']; ?></a></li>
<?php
	if( !empty($allow_admin) ) {
?>
			<li><a href="showlog.php"><?php echo $text['mnushowlog']; ?></a></li>
			<li><a href="admin.php"><?php echo $text['mnuadmin']; ?></a></li>
<?php
	}
?>
		</ul>
	</div>
	<div style="clear:left"></div>
</div>
<div id="subfooter">
<?php
	$flags['basicfooter'] = true;
	echo tng_footer($flags);
?>
</div>

</body>
</html>