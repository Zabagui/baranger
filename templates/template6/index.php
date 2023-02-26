<?php
if(!isset($title) || !$title)
    $title = getTemplateMessage('t6_maintitle'); 

// PLEASE NOTE: This page only contains the content of your main page.  If you are trying to make changes
//    to the header, you will need to edit topmenu.php.  If you want to edit the footer, edit footer.php
echo tng_header($sitename ? "" : $text['mnuheader'], $flags);
//if it's  not the mobile site, then this part is handled in the custom header (topmenu.php)
if($sitever == "mobile") {
?>
<table class="page">
  <tr class="row60">
    <td colspan="4" class="headertitle">

<?php
	//begin TITLE TEXT (default: "Our Family History")
	//Actual file name has been replaced with t5_maintitle variable, configurable from Template Settings.
	//You can simply replace the t6_maintitle PHP block below with your title text if you prefer that to using the Template Settings.
?>

<?php echo getTemplateMessage('t6_maintitle'); ?>  <!-- Our Family History -->

<?php
	//end TITLE TEXT
?>

    </td>
  </tr>
  <tr>
    <td class="titlemid">

<?php
	//begin HEADER IMAGE (default: small ancestor collage under title). Size is width=559px, height=60px
	//Actual file name has been replaced with t6_headimg variable, configurable from Template Settings. Default name of actual image is "titlebottom.jpg"
	//You can replace the t6_headimg PHP block in the line below with the desired image name if you prefer that to using the Template Settings.
?>
        <img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t6_headimg']; ?>" width="559" height="60" alt="" />
<?php
	//end HEADER IMAGE
?>

    </td>
  </tr>
  <tr class="tablebkground">
    <td colspan="4" class="padding" style="border-collapse:separate">
<?php
}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
	<td class="section">
	<img src="<?php echo $cms['tngpath'] . $templatepath; ?>img/header_welcome.gif" width="200" height="50" alt="" /><br />
	<span class="normal">

<?php
	//begin WELCOME PARAGRAPH (default text: "This is where you can welcome the user to your site.")
	//Configurable from Template Settings. You can also replace the t6_mainpara PHP block below with the desired text if you prefer that to using the Template Settings.
?>

	   <?php echo getTemplateMessage('t6_mainpara'); ?>

<?php
	//end WELCOME PARAGRAPH
?>

	<br />
	<br />
	<br />
	</span>
	<img src="<?php echo $cms['tngpath'] . $templatepath; ?>img/header_search.gif" width="200" height="50" alt="" /><br />
	<span class="normal">

<?php
	//begin SEARCH PARAGRAPH (default text: "To search the genealogy database, enter a name below. You will find many families!")
	//Configurable from Template Settings. You can also replace the t6_searchpara PHP block below with the desired text if you prefer that to using the Template Settings.
?>

		<?php echo getTemplateMessage('t6_searchpara'); ?>

<?php
	//end SEARCH PARAGRAPH
?>

	</span>
	 <br /><br />
	 <form id="form1" method="get" action="<?php echo $cms['tngpath']; ?>search.php">
	    <div><input type="hidden" value="AND" name="mybool" />
	    <table width="297" border="0" cellspacing="0" cellpadding="0">
	    <tr>
		<td><?php echo $text['firstname']; ?>: </td>
		<td class="searchbox"><input name="myfirstname" type="text" id="myfirstname" /></td>
          
	    </tr>
	    <tr>
		<td class="normal"><?php echo $text['lastname']; ?>: </td>
		<td class="searchbox"><input name="mylastname" type="text" id="mylastname" /></td>
		<td rowspan="2" ><input type="image" name="imageField" src="<?php echo $cms['tngpath'] . $templatepath; ?>img/searchbutton.gif"/></td>
	    </tr>
	    </table>
	</div></form>    <!-- <div added for strict KCR -->
	    <p class="center">[<a href="<?php echo $cms['tngpath']; ?>surnames.php"><?php echo $text['mnulastnames']; ?></a>] [<a href="<?php echo $cms['tngpath']; ?>searchform.php"><?php echo $text['mnuadvancedsearch']; ?></a>]<br />
	    [<a href="https://www.familytreeseeker.com">FamilyTreeSeeker.com</a>]</p>
	</td>
	<td class="section">

<!-- RANDOM PHOTO CODE STARTS HERE -->
<!-- If you don't want to have a random photo displayed, just remove this section down to 'RANDOM PHOTO CODE ENDS HERE' -->

	<img src="<?php echo $cms['tngpath'] . $templatepath; ?>img/header_featphoto.gif" width="200" height="50" alt="" /><br />
<!--	<center> ** removed since there is not a good way to center images -->
	<?php
	    include("randomphoto.php");
	?>
	<p class="center">[<a href="browsemedia.php?mediatypeID=photos"><?php echo $text['viewphotos']; ?></a>]</p>
<!--	</center> ** removed since there is not a good way to center images -->

<!-- RANDOM PHOTO CODE ENDS HERE -->

      <p class="normal"><img src="<?php echo $cms['tngpath'] . $templatepath; ?>img/header_famhist.gif" width="200" height="50" alt="" /><br/>

<?php
	//begin FAMILY HISTORIES PARAGRAPH (default text: "You can use this section to link to some of your more interesting family histories.")
	//Configurable from Template Settings. You can also replace the t6_fhpara PHP block below with the desired text if you prefer that to using the Template Settings.
?>

		<?php echo getTemplateMessage('t6_fhpara'); ?>

<?php
	//end FAMILY HISTORIES PARAGRAPH
?>

	  </p>

      <table width="250" border="0" cellspacing="0" cellpadding="0">
	<tr>

<!-- CHANGE 'His side' AND 'Her size' TO THE TWO BRANCHES YOU WILL LIST HISTORIES FOR BELOW -->

	    <td class="emphasis">

<?php
	//begin "HIS SIDE" LABEL (default text: "His Side")
	//Configurable from Template Settings. You can also replace the t6_hisside PHP block below with the desired text if you prefer that to using the Template Settings.
?>

		<?php echo getTemplateMessage('t6_hisside'); ?>

<?php
	//end "HIS SIDE" LABEL
?>

		</td>
	    <td class="emphasis">

<?php
	//begin "HER SIDE" LABEL (default text: "His Side")
	//Configurable from Template Settings. You can also replace the t6_herside PHP block below with the desired text if you prefer that to using the Template Settings.
?>

		<?php echo getTemplateMessage('t6_herside'); ?>

<?php
	//end "HER SIDE" LABEL
?>

		</td>

<!-- CHANGE 'His side' AND 'Her size' TO THE TWO BRANCHES YOU WILL LIST HISTORIES FOR ABOVE -->

	</tr>
	<tr class="row5">
	    <td colspan="2"></td>
	</tr>

<!-- EDIT LINKS TO PARTICULAR INDIVIDUAL HISTORIES YOU WANT TO LINK TO BELOW -->
<!-- CHANGE tree=yourtreeid to match your tree ID -->
        <tr>
            <td class="normal" valign="top">

<?php
	//begin FAMILY HISTORIES LINKS ("HIS")
	//Configurable from Template Settings. You can also replace the t6_fhlinkshis PHP block below with the desired text if you prefer that to using the Template Settings.
	//Example: <a href="extrastree.php?personID=I1&amp;tree=T0001&amp;showall=1">Person's Name</a><br/>
	//(Replace "I1" with a personID from your database; replace "T0001" with that person's tree ID)
?>

		<?php echo $tmp['t6_fhlinkshis']; ?>

<?php
	//end RESOURCE LINKS
?>

			</td>
            <td class="normal" valign="top">
<?php
	//begin FAMILY HISTORIES LINKS ("HIS")
	//Configurable from Template Settings. You can also replace the t6_fhlinkshis PHP block below with the desired text if you prefer that to using the Template Settings.
	//Example: <a href="extrastree.php?personID=I1&amp;tree=T0001&amp;showall=1">Person's Name</a><br/>
	//(Replace "I1" with a personID from your database; replace "T0001" with that person's tree ID)
?>

		<?php echo $tmp['t6_fhlinkshers']; ?>

<?php
	//end RESOURCE LINKS
?>
			</td>
        </tr>

<!-- EDIT LINKS TO PARTICULAR INDIVIDUAL HISTORIES YOU WANT TO LINK TO ABOVE -->

      </table>
      <p>&nbsp;</p></td>
      <td class="section">
	<p class="normal"><img src="<?php echo $cms['tngpath'] . $templatepath; ?>img/header_mostwanted.gif" width="200" height="50" alt="" /></p>

<?php
	//begin "MOST WANTED" PARAGRAPH (default text: "Use this section to display information about individuals you are actively researching.")
	//Configurable from Template Settings. You can also replace the t6_mwpara PHP block below with the desired text if you prefer that to using the Template Settings.
?>

		<?php echo getTemplateMessage('t6_mwpara'); ?>

<?php
	//end "MOST WANTED" PARAGRAPH
?>


	<p class="center">[<a href="<?php echo $cms['tngpath']; ?>mostwanted.php"><?php echo $text['mostwanted']; ?></a>] </p>
	<p class="normal"><img src="<?php echo $cms['tngpath'] . $templatepath; ?>img/header_resources.gif" width="200" height="50" alt="" /></p>

<?php
	//begin RESOURCES PARAGRAPH (default text: "List resources here that you would like to share with others.")
	//Configurable from Template Settings. You can also replace the t6_respara PHP block below with the desired text if you prefer that to using the Template Settings.
?>

		<?php echo getTemplateMessage('t6_respara'); ?>

<?php
	//end RESOURCES PARAGRAPH
?>


	<div class="normal">

<?php
	//begin RESOURCE LINKS (whatever you want)
	//Configurable from Template Settings. You can also replace the t6_reslinks PHP block below with the desired text if you prefer that to using the Template Settings.
	//Example: <a href="http://lythgoes.net/genealogy/software.php" target="_blank">TNG Software</a><br/>
?>

		<?php echo $tmp['t6_reslinks']; ?>

<?php
	//end RESOURCE LINKS
?>

	</div>
    </td>
  </tr>
</table>

<?php
echo tng_footer('');
?>