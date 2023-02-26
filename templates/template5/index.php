<?php
$flags['noicons'] = true;
$flags['noheader'] = true;
$flags['nobody'] = true;
$tngconfig['showshare'] = false;

//Change the text in quotes below to reflect the title of your site

tng_header( $sitename ? "" : $tmp['t5_maintitle'], $flags );
if(!$cms['support'] && $sitever != "mobile")
	echo "<body id=\"bodytop\" class=\"" . pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME) . "\">\n";
$title = getTemplateMessage('t5_maintitle');
$text['contactus_long'] = str_replace( "suggest.php", "suggest.php?page=" . urlencode($title), $text['contactus_long'] );
?>

<div class="center">
<table class="maintable">
  <tr>
    <td class="row" colspan="4"></td>
  </tr>
  <tr>
    <td class="imagesection">
		</td>
    <td class="spacercol">
		</td>
    <td class="content" colspan="2">

		<table border="0" cellpadding="5" cellspacing="0" width="100%" class="innertable">
      		<tr>
        		<td colspan="2" class="indexheader" >

<?php
	//begin TITLE TEXT (default: "Our Family History and Ancestry")
	//Actual text has been replaced with t5_maintitle variable, configurable from Template Settings.
	//You can simply replace the t5_maintitle PHP block below with your title text if you prefer that to using the Template Settings.
?>

<?php echo $title; ?>  <!-- Our Family History and Ancestry -->

<?php
	//end TITLE TEXT
?>

      				
			  	</td>
		 	</tr>
      		<tr>
        		<td colspan="2" class="boxback">

<!--EDIT MENU LINKS BELOW HERE.  EDITS ABOVE THIS LINE WILL AFFECT THE PAGE DESIGN STRUCTURE-->
					<div id="menubar">
				    <a href="whatsnew.php" class="lightlink2"><?php echo $text['mnuwhatsnew']; ?></a>
<?php
	foreach( $mediatypes as $mediatype ) {
		if(!$mediatype['disabled']) {
			echo "| <a href=\"browsemedia.php?mediatypeID={$mediatype['ID']}\" class=\"lightlink2\">{$mediatype['display']}</a>\n";
		}
	}
?>
                    | <a href="browsealbums.php" class="lightlink2"><?php echo $text['albums']; ?></a>
                    | <a href="browsemedia.php" class="lightlink2"><?php echo $text['allmedia']; ?></a><br />

<!-- SECOND LINE OF LINKS-->

                    <a href="mostwanted.php" class="lightlink2"><?php echo $text['mostwanted']; ?></a>
                    | <a href="reports.php" class="lightlink2"><?php echo $text['mnureports']; ?></a>
                    | <a href="cemeteries.php" class="lightlink2"><?php echo $text['mnucemeteries']; ?></a>
		            | <a href="anniversaries.php" class="lightlink2"><?php echo $text['anniversaries']; ?></a>
		            | <a href="calendar.php" class="lightlink2"><?php echo $text['calendar']; ?></a>
		            | <a href="places.php" class="lightlink2"><?php echo $text['places']; ?></a><br />

<!-- THIRD LINE OF LINKS-->

		            <a href="browsenotes.php" class="lightlink2"><?php echo $text['notes']; ?></a>
		            | <a href="browsesources.php" class="lightlink2"><?php echo $text['mnusources']; ?></a>
		            | <a href="browserepos.php" class="lightlink2"><?php echo $text['repositories']; ?></a>
<?php
    if( !$tngconfig['hidedna'] ) {
?>
		            | <a href="browse_dna_tests.php" class="lightlink2"><?php echo $text['dna_tests']; ?></a>
<?php
	}
?>
	           		| <a href="statistics.php" class="lightlink2"><?php echo $text['mnustatistics']; ?></a>
	           		| <a href="bookmarks.php" class="lightlink2"><?php echo $text['bookmarks']; ?></a>
		            | <a href="suggest.php" class="lightlink2"><?php echo $text['contactus']; ?></a>
<?php
	if( !empty($allow_admin) ) {
		echo "| <a href=\"showlog.php\" class=\"lightlink2\">{$text['mnushowlog']}</a>\n";
		echo "| <a href=\"admin.php\" class=\"lightlink2\">{$text['mnuadmin']}</a>\n";
	}
?>

<!--EDIT MENU LINKS ABOVE HERE.  EDITS BELOW THIS LINE WILL AFFECT THE PAGE DESIGN STRUCTURE-->
					</div>
				</td>
      </tr>
      <tr>
	  	<td>
        <div class="leftcontent">
              <div class="theader">

<!--Welcome message-->

              <h1><?php echo $text['welcome']; ?>!</h1>

<!-- end welcome message -->

              </div>
              <div class="normal">

<?php
	//begin WELCOME PARAGRAPH
	//Configurable from Template Settings. You can also replace the t5_mainpara PHP block in the line below with the desired text if you prefer that to using the Template Settings.
	//Example:  <p>This is my welcome paragraph. If I had more to say, it would be several lines long.</p>
?>
					<?php echo getTemplateMessage('t5_mainpara'); ?>
<?php
	//end WELCOME PARAGRAPH
?>

              <p><?php echo $text['contactus_long']; ?></p>
	  		  <ul>
			  	<?php
					if(!$currentuser) {
						if(!$tngconfig['disallowreg'])
							echo "<li><a href=\"newacctform.php\">{$text['mnuregister']}</a></li>\n";
						echo "<li><a href=\"login.php\">{$text['mnulogon']}</a></li>\n";
					}
					else {
						echo "<li><a href=\"logout.php\">{$text['mnulogout']}</a></li>\n";
					}
					if($chooselang)
						echo "<li><a href=\"changelanguage.php\">{$text['mnulanguage']}</a></li>\n";
				?>
			  </ul>
			  </div>

<!--EDIT PARAGRAPH TEXT ABOVE HERE.  EDITS BELOW THIS LINE WILL AFFECT THE PAGE DESIGN STRUCTURE-->

        </div>
        <div class="rightcontent">
<?php
	//begin MAIN IMAGE (default: medium-sized picture of a couple on the right). Size is width=160px, height=121px
	//Actual file name has been replaced with t5_mainimage variable, configurable from Template Settings. Default name of actual image is "mediumphoto.jpg"
	//You can replace the t5_mainimage PHP block in the line below with the desired image name if you prefer that to using the Template Settings.
?>
              <img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t5_mainimage']; ?>" alt="" class="indexphoto" /><br /><br />
<?php
	//end MAIN IMAGE
?>
              <span class="right" style="margin-right:8px"><?php echo $text['whichbranch']; ?></span>
		</div>
        <div  class="rightcontent">
			<form action="search.php" method="get">
				<table class="indexbox rounded4" id="searchbox">
					<tr>
						<td class="padding"><span class="boxback"><?php echo $text['mnufirstname']; ?>:<br />
							<input type="text" name="myfirstname" class="searchbox" size="14" /></span>
						</td>
					</tr>
					<tr>
						<td class="padding"><span class="boxback"><?php echo $text['mnulastname']; ?>:<br />
							<input type="text" name="mylastname" class="searchbox" size="14" /></span>
						</td>
					</tr>
					<tr>
						<td class="padding"><span class="normal"><input type="hidden" name="mybool" value="AND" />
						<input type="submit" name="search" value="<?php echo $text['mnusearchfornames']; ?>" class="small" /><br /><br />
						<?php
							echo "<a href=\"surnames.php\" class=\"lightlink2\">{$text['mnulastnames']}</a><br />\n";
							echo "<a href=\"searchform.php\" class=\"lightlink2\">{$text['mnuadvancedsearch']}</a>\n";
						?></span>
						</td>	
					</tr>
				</table>
			</form>
		</div>
		</td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="4" class="row12"></td>
  </tr>
</table>
<br />
<div class="footer small">
<?php
	$flags['basicfooter'] = true;
	echo tng_footer($flags);
?>
</div> <!-- end of footer div -->
</div> <!-- end of center div -->

</body>

</html>