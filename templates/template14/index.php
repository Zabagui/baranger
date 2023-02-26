<?php
$flags['noicons'] = true;
$flags['noheader'] = true;
$flags['nobody'] = true;
$tngconfig['showshare'] = false;

tng_header($sitename ? "" : $text['mnuheader'], $flags);
if(!$cms['support'] && $sitever != "mobile")
	echo "<body id=\"bodytop\" class=\"" . pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME) . "\">\n";

$dadlabel = getTemplateMessage('t14_dadside');
$momlabel = getTemplateMessage('t14_momside');
$title = getTemplateMessage('t14_maintitle');
$text['contactus_long'] = str_replace( "suggest.php", "suggest.php?page=" . urlencode($title), $text['contactus_long'] );
?>

<div id="art-main">
    <div class="cleared reset-box"></div>
	<div class="art-nav">
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
								<div class="art-post-inner art-article">
                                	<div class="art-postcontent">

										<div class="left-indent">
											<h1 class="big-header">
												<?php echo $title; ?>
											</h1>
											<h2 class="subheader"><?php echo getTemplateMessage('t14_headsubtitle'); ?></h2>
											<hr />
										</div>

										<div class="art-block titlebox" id="tsearchbox">
				    						<div class="art-block-body">
				                				<div class="art-blockheader">
				                    				<h2 class="site-head"><?php echo $text['search']; ?></h2>
				                				</div>
												<br/>
				                				<div class="art-blockcontent">
				                    				<div class="art-blockcontent-body">
				                						<div>
															<form method="get" name="searchform" action="search.php">
															  	<label for="myfirstname"><?php echo $text['firstname']; ?></label>
															    <input type="text" value="" name="myfirstname" class="mediumfield" />
															    <br />
															  	<label for="mylastname"><?php echo $text['lastname']; ?></label>
															    <input type="text" value="" name="mylastname" class="mediumfield" />
																<input type="hidden" name="mybool" value="AND" />
																<input type="submit" id="search-submit" value="<?php echo $text['search']; ?>" />
															</form>

															<br />
															<ul class="home-menus">
																<li><a href="surnames.php"><?php echo $text['surnames']; ?></a></li>
																<li><a href="searchform.php"><?php echo $text['mnuadvancedsearch']; ?></a></li>
															</ul>

															<br />
<?php
	if( $currentuser ) {
	    echo "<p><strong>{$text['welcome']}, $currentuserdesc.</strong></p>\n";
		echo "<ul class=\"home-menus\">\n";

		echo "<li><a href=\"logout.php\">{$text['mnulogout']}</a></li>\n";
	}
	else {
		echo "<ul class=\"home-menus\">\n";
		if( empty($tngconfig['showlogin']) )
			echo "<li><a href=\"login.php\">{$text['mnulogon']}</a></li>";
		if(!$tngconfig['disallowreg']) {
?>
			<li><a href="newacctform.php"><?php echo $text['mnuregister']; ?></a></li></p>
<?php
		}
	}

	echo "</ul>\n";
?>
														</div>
				                                		<div class="cleared"></div>
				                    				</div>
				                				</div>
												<div class="cleared"></div>
				    						</div>
										</div>

										<table class="art-article">
											<tbody>
												<tr class="even">
													<td>
														<div class="left-indent">
															<h3><?php echo getTemplateMessage('t14_welcome'); ?></h3>
															<?php echo getTemplateMessage('t14_mainpara'); ?>
														</div>
														<div class="left-indent">
															<h3><?php echo $text['contactus']; ?></h3>
															<p class="contact"><img src="<?php echo $cms['tngpath'] . $templatepath; ?>img/email.gif" alt="email image" class="emailimg" /><?php echo $text['contactus_long']; ?></p>
														</div>
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
													</td>
												</tr>
											</tbody>
										</table>


                					</div>
                					<div class="cleared"></div>
                				</div>

								<div class="cleared"></div>
    						</div>
						</div>

                      	<div class="cleared"></div>
                    </div>
                    <div class="art-layout-cell art-sidebar1" id="sidebar">
                      	<img alt="" class="rounded10" src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t14_mainimage']; ?>" id="mainphoto"/><br/><br/>
						<i><?php echo getTemplateMessage('t14_photocaption'); ?></i>
                    </div>
                </div>
            </div>
            <div class="cleared"></div>
        </div>
    </div>

	<div class="art-sheet" id="otherfeatures">
        <div class="art-sheet-cc"></div>
        <div class="art-sheet-body">
            <div class="art-footer">
                <div class="art-footer-body">
                	<div class="art-footer-text">

						<div id="linkarea">
							<ul class="left-indent">
								<li class="linkcol" id="otherarea" style="width:25%">
									<h2 class="site-head"><?php echo $text['mnufeatures']; ?></h2>
									<hr class="bottomhr"/>
								</li>
								<li class="linkcol" style="width:75%">
										<ul class="fancy_list">
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
								</li>
							</ul>
						</div>
               			<div class="cleared"></div>
                    </div>
                    <div class="cleared"></div>
                </div>
            </div>
        </div>
    </div>

	<div class="art-nav" style="margin-top:0px">
		<div class="art-nav-outer">
			<div class="art-nav-wrapper">
				<div class="art-nav-inner">
					<div class="t tngfooter">
<?php
	$flags['basicfooter'] = true;
	echo tng_footer($flags);
?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="cleared reset-box"></div>
	<br/>

</div>

<script type="text/javascript">
	document.forms.searchform.myfirstname.focus();
</script>

</body>
</html>