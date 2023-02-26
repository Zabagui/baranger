<?php
$flags['noicons'] = true;
$flags['noheader'] = true;
$flags['nobody'] = true;

$flags['scripting'] = "<style>
body {
  background-image: url('{$cms['tngpath']}{$templatepath}img/Bottom_texture.jpg');
  background-repeat: repeat;
  background-attachment: fixed;
  background-position: top left;
}\n";
if($sitever != "mobile") {
$flags['scripting'] .= "div.art-headerobject {
  background-image: url('{$cms['tngpath']}$templatepath{$tmp['t9_headimg']}');
  background-repeat: no-repeat;
  width: 432px;
  height: 150px;
}\n";
}
$flags['scripting'] .= "</style>\n";

tng_header( $sitename ? "" : $text['ourhist'], $flags );
if(!$cms['support'] && $sitever != "mobile")
    echo "<body id=\"bodytop\" class=\"" . pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME) . "\">\n";

$dadlabel = getTemplateMessage('t9_dadside');
$momlabel = getTemplateMessage('t9_momside');
$title = getTemplateMessage('t9_maintitle');
$text['contactus_long'] = str_replace( "suggest.php", "suggest.php?page=" . urlencode($title), $text['contactus_long'] );
?>

<div id="art-main">
    <div class="cleared reset-box"></div>
    <div class="art-sheet">
        <div class="art-sheet-tl"></div>
        <div class="art-sheet-tr"></div>
        <div class="art-sheet-bl"></div>
        <div class="art-sheet-br"></div>
        <div class="art-sheet-tc"></div>
        <div class="art-sheet-bc"></div>
        <div class="art-sheet-cl"></div>
        <div class="art-sheet-cr"></div>
        <div class="art-sheet-cc"></div>
        <div class="art-sheet-body">
            <div class="art-header">
                <div class="art-header-clip">
                <div class="art-header-center">
                    <div class="art-header-jpeg"></div>
                </div>
                </div>
                <div class="art-headerobject"></div>
                <div class="art-logo">
                                 <h1 class="art-logo-name"><a href="<?php echo $homepage; ?>"><?php echo $title; ?></a></h1>
                                                 <h2 class="art-logo-text"><?php echo getTemplateMessage('t9_headsubtitle'); ?></h2>
                                </div>
            </div>
            <div class="cleared reset-box"></div>
<div class="art-nav">
	<div class="art-nav-l"></div>
	<div class="art-nav-r"></div>
<div class="art-nav-outer">
	<ul class="art-hmenu">
<?php
    if($dadlabel) {
?>
		<li>
			<a href="<?php echo $cms['tngpath']; ?>pedigree.php?personID=<?php echo $tmp['t9_dadperson']; ?>&amp;tree=<?php echo $tmp['t9_dadtree']; ?>"><span class="l"></span><span class="t"><?php echo $dadlabel; ?></span></a>
		</li>
<?php       
    }
    if($momlabel) {
?>
		<li>
			<a href="<?php echo $cms['tngpath']; ?>pedigree.php?personID=<?php echo $tmp['t9_momperson']; ?>&amp;tree=<?php echo $tmp['t9_momtree']; ?>"><span class="l"></span><span class="t"><?php echo $momlabel; ?></span></a>
		</li>
<?php       
    }
?>
		<li>
			<a href="<?php echo $cms['tngpath']; ?>suggest.php?page=<?php echo $title; ?>"><span class="l"></span><span class="t"><?php echo $text['contactus']; ?></span></a>
		</li>
	</ul>
</div>
</div>
<div class="cleared reset-box"></div>
<div class="art-content-layout">
                <div class="art-content-layout-row">
                    <div class="art-layout-cell art-sidebar1">
<div class="art-vmenublock">
    <div class="art-vmenublock-tl"></div>
    <div class="art-vmenublock-tr"></div>
    <div class="art-vmenublock-bl"></div>
    <div class="art-vmenublock-br"></div>
    <div class="art-vmenublock-tc"></div>
    <div class="art-vmenublock-bc"></div>
    <div class="art-vmenublock-cl"></div>
    <div class="art-vmenublock-cr"></div>
    <div class="art-vmenublock-cc"></div>
    <div class="art-vmenublock-body">
                <div class="art-vmenublockcontent">
                    <div class="art-vmenublockcontent-body">
<ul class="art-vmenu">
	<li><a href="whatsnew.php"><span class="l"></span><span class="r"></span><span class="t"><?php echo $text['mnuwhatsnew']; ?></span></a></li>
	<li><a href="mostwanted.php"><span class="l"></span><span class="r"></span><span class="t"><?php echo $text['mostwanted']; ?></span></a></li>
<?php
    foreach( $mediatypes as $mediatype ) {
        if(!$mediatype['disabled']) {
            echo "<li><a href=\"browsemedia.php?mediatypeID={$mediatype['ID']}\"><span class=\"l\"></span><span class=\"r\"></span><span class=\"t\">{$mediatype['display']}</span></a></li>\n";
        }
    }
?>
	<li><a href="browsealbums.php"><span class="l"></span><span class="r"></span><span class="t"><?php echo $text['albums']; ?></span></a></li>
	<li><a href="browsemedia.php"><span class="l"></span><span class="r"></span><span class="t"><?php echo $text['allmedia']; ?></span></a></li>
	<li><a href="cemeteries.php"><span class="l"></span><span class="r"></span><span class="t"><?php echo $text['mnucemeteries']; ?></span></a></li>
	<li><a href="places.php"><span class="l"></span><span class="r"></span><span class="t"><?php echo $text['places']; ?></span></a></li>
	<li><a href="browsenotes.php"><span class="l"></span><span class="r"></span><span class="t"><?php echo $text['notes']; ?></span></a></li>
	<li><a href="anniversaries.php"><span class="l"></span><span class="r"></span><span class="t"><?php echo $text['anniversaries']; ?></span></a></li>
    <li><a href="calendar.php"><span class="l"></span><span class="r"></span><span class="t"><?php echo $text['calendar']; ?></span></a></li>
	<li><a href="reports.php"><span class="l"></span><span class="r"></span><span class="t"><?php echo $text['reports']; ?></span></a></li>
	<li><a href="browsesources.php"><span class="l"></span><span class="r"></span><span class="t"><?php echo $text['mnusources']; ?></span></a></li>
	<li><a href="browserepos.php"><span class="l"></span><span class="r"></span><span class="t"><?php echo $text['repositories']; ?></span></a></li>
<?php
    if( !$tngconfig['hidedna'] ) {
?>
    <li><a href="browse_dna_tests.php"><span class="l"></span><span class="r"></span><span class="t"><?php echo $text['dna_tests']; ?></span></a></li>
<?php
    }
?>
	<li><a href="statistics.php"><span class="l"></span><span class="r"></span><span class="t"><?php echo $text['mnustatistics']; ?></span></a></li>
<?php
	if( !empty($allow_admin) ) {
?>
		<li><a href="showlog.php"><span class="l"></span><span class="r"></span><span class="t"><?php echo $text['mnushowlog']; ?></span></a></li>
		<li><a href="admin.php"><span class="l"></span><span class="r"></span><span class="t"><?php echo $text['mnuadmin']; ?></span></a></li>
<?php
	}
?>
	<li><a href="bookmarks.php"><span class="l"></span><span class="r"></span><span class="t"><?php echo $text['bookmarks']; ?></span></a></li>
</ul>

                                		<div class="cleared"></div>
                    </div>
                </div>
		<div class="cleared"></div>
    </div>
</div>

                      <div class="cleared"></div>
                    </div>
                    <div class="art-layout-cell art-content">
<div class="art-post">
    <div class="art-post-body">
<div class="art-post-inner art-article">
                                <h2 class="art-postheader"><?php echo getTemplateMessage('t9_welcome'); ?></h2>
                <div class="cleared"></div>
                                <div class="art-postcontent">

<img src="<?php echo $cms['tngpath'] . $templatepath . $tmp['t9_mainimage']; ?>" alt="" style="float:left;" class="temppreview" />
<?php
	if($chooselang) {
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
	}

	if( $currentuser ) {
	    echo "<p class=\"subhead\"><strong>{$text['welcome']}, $currentuserdesc.</strong> <a href=\"logout.php\">{$text['mnulogout']}</a></p>\n";
	}
	else {
		$loginContent = "";
		if(!$tngconfig['showlogin'] )
			$loginContent = "<a href=\"login.php\">{$text['mnulogon']}</a>";
		if(!$tngconfig['disallowreg']) {
			if($loginContent)
				$loginContent .= " | ";
			$loginContent .= "<a href=\"newacctform.php\">{$text['mnuregister']}</a>";
		}
		if($loginContent)
			echo "<p class=\"subhead\">$loginContent</p>\n";
	}
	echo getTemplateMessage('t9_mainpara');
?>
					<h4><?php echo $text['contactus']; ?></h4>
					<p><img src="<?php echo $cms['tngpath'] . $templatepath; ?>img/email.gif" alt="email image" class="emailimg" /><?php echo $text['contactus_long']; ?></p>
					
                </div>
                <div class="cleared"></div>
                </div>

		<div class="cleared"></div>
    </div>
</div>

                      <div class="cleared"></div>
                    </div>
                    <div class="art-layout-cell art-sidebar2">
<div class="art-block">
    <div class="art-block-tl"></div>
    <div class="art-block-tr"></div>
    <div class="art-block-bl"></div>
    <div class="art-block-br"></div>
    <div class="art-block-tc"></div>
    <div class="art-block-bc"></div>
    <div class="art-block-cl"></div>
    <div class="art-block-cr"></div>
    <div class="art-block-cc"></div>
    <div class="art-block-body">
                <div class="art-blockheader">
                    <div class="l"></div>
                    <div class="r"></div>
                    <h3 class="t"><?php echo $text['search']; ?></h3>
                </div>
                <div class="art-blockcontent">
                    <div class="art-blockcontent-tl"></div>
                    <div class="art-blockcontent-tr"></div>
                    <div class="art-blockcontent-bl"></div>
                    <div class="art-blockcontent-br"></div>
                    <div class="art-blockcontent-tc"></div>
                    <div class="art-blockcontent-bc"></div>
                    <div class="art-blockcontent-cl"></div>
                    <div class="art-blockcontent-cr"></div>
                    <div class="art-blockcontent-cc"></div>
                    <div class="art-blockcontent-body">
                <div>
				  <form method="get" name="searchform" action="search.php">
				  	<label for="myfirstname"><?php echo $text['firstname']; ?></label>
				    <input type="text" value="" name="myfirstname" style="width: 95%;" />
				  	<label for="mylastname"><?php echo $text['lastname']; ?></label>
				    <input type="text" value="" name="mylastname" style="width: 95%;" />
					<input type="hidden" name="mybool" value="AND" />
						<input type="submit" style="margin-top:5px; margin-bottom:5px" value="<?php echo $text['search']; ?>" />
					</form>
					<ul class="home-menus">
						<li><a href="surnames.php"><?php echo $text['surnames']; ?></a></li>
						<li><a href="searchform.php"><?php echo $text['mnuadvancedsearch']; ?></a></li>
					</ul>
</div>
                                		<div class="cleared"></div>
                    </div>
                </div>
		<div class="cleared"></div>
    </div>
</div>
<div class="art-block">
    <div class="art-block-tl"></div>
    <div class="art-block-tr"></div>
    <div class="art-block-bl"></div>
    <div class="art-block-br"></div>
    <div class="art-block-tc"></div>
    <div class="art-block-bc"></div>
    <div class="art-block-cl"></div>
    <div class="art-block-cr"></div>
    <div class="art-block-cc"></div>
    <div class="art-block-body">
                <div class="art-blockheader">
                    <div class="l"></div>
                    <div class="r"></div>
                    <h3 class="t"><?php echo $text['features']; ?></h3>
                </div>
                <div class="art-blockcontent">
                    <div class="art-blockcontent-tl"></div>
                    <div class="art-blockcontent-tr"></div>
                    <div class="art-blockcontent-bl"></div>
                    <div class="art-blockcontent-br"></div>
                    <div class="art-blockcontent-tc"></div>
                    <div class="art-blockcontent-bc"></div>
                    <div class="art-blockcontent-cl"></div>
                    <div class="art-blockcontent-cr"></div>
                    <div class="art-blockcontent-cc"></div>
                    <div class="art-blockcontent-body">
                		<div>
  							<p><?php echo getTemplateMessage('t9_featurepara'); ?></p>
						  <ul class="home-menus">
						<?php
							echo showLinks($tmp['t9_featurelinks'], true);
						?>
						  </ul>
						</div>
                        <div class="cleared"></div>
                    </div>
                </div>
		<div class="cleared"></div>
    </div>
</div>
<div class="art-block">
    <div class="art-block-tl"></div>
    <div class="art-block-tr"></div>
    <div class="art-block-bl"></div>
    <div class="art-block-br"></div>
    <div class="art-block-tc"></div>
    <div class="art-block-bc"></div>
    <div class="art-block-cl"></div>
    <div class="art-block-cr"></div>
    <div class="art-block-cc"></div>
    <div class="art-block-body">
                <div class="art-blockheader">
                    <div class="l"></div>
                    <div class="r"></div>
                    <h3 class="t"><?php echo $text['resources']; ?></h3>
                </div>
                <div class="art-blockcontent">
                    <div class="art-blockcontent-tl"></div>
                    <div class="art-blockcontent-tr"></div>
                    <div class="art-blockcontent-bl"></div>
                    <div class="art-blockcontent-br"></div>
                    <div class="art-blockcontent-tc"></div>
                    <div class="art-blockcontent-bc"></div>
                    <div class="art-blockcontent-cl"></div>
                    <div class="art-blockcontent-cr"></div>
                    <div class="art-blockcontent-cc"></div>
                    <div class="art-blockcontent-body">
	                	<div>
						  <ul class="home-menus">
						<?php
							echo showLinks($tmp['t9_reslinks'], true);
						?>
						  </ul>
						</div>
						<div class="cleared"></div>
                    </div>
                </div>
		<div class="cleared"></div>
    </div>
</div>

                      <div class="cleared"></div>
                    </div>
                </div>
            </div>
            <div class="cleared"></div>
            <div class="art-footer">
                <div class="art-footer-t"></div>
                <div class="art-footer-b"></div>
                <div class="art-footer-body">
                    <div class="art-footer-text">
	                    <a href="tngrss.php" class="art-rss-tag-icon" title="RSS"></a>
<?php
	$flags['basicfooter'] = true;
	echo tng_footer($flags);
?>
							</div>
                    <div class="cleared"></div>
                </div>
            </div>
    		<div class="cleared"></div>
        </div>
    </div>
    <div class="cleared"></div><br /><br />
</div>

</body>
</html>
