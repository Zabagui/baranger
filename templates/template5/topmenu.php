<?php
	global $text, $cms, $subroot, $tmp;
?>
<body id="bodytop" class="<?php echo pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME); ?>">
<div class="center">
<table class="maintable">
	<tr>
		<td class="tableheader"></td>
	</tr>
	<tr>
		<td class="tablesubheader"></td>
	</tr>
	<tr>
		<td>
        <table class="innertable">
          <tr>
            <td>
<?php
	//begin HEADER IMAGE (default: small picture of a couple on the top left). Size is width=100px, height=76px
	//Actual file name has been replaced with t5_headimg variable, configurable from Template Settings. Default name of actual image is "smallphoto.jpg"
	//You can replace the t5_headimg PHP block in the line below with the desired image name if you prefer that to using the Template Settings.
?>
        <img src="<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t5_headimg']; ?>" alt="" class="smallphoto" /></td>
<?php
	//end HEADER IMAGE
?>
            <td class="banner">

<?php
	//begin TITLE TEXT (default: "Our Family History and Ancestry")
	//Actual file name has been replaced with t5_maintitle variable, configurable from Template Settings.
	//You can simply replace the t5_maintitle PHP block below with your title text if you prefer that to using the Template Settings.
?>

<?php echo getTemplateMessage('t5_maintitle'); ?>  <!-- Our Family History and Ancestry -->

<?php
	//end TITLE TEXT
?>
			</td>
          </tr>
        </table>
        </td>
	</tr>
	<tr class="row30">
	
<!-- OPTIONS: The following line can be used to display the Site Name 
			by removing the comment characters and commenting the line
			after the END of OPTIONS -->

<!--    	<td class="sitename"><?php echo "$sitename"; ?></td> -->
<!--		or you could copy the menu between the EDIT lines in footer.php
		and replace the ADD MENU ITEMS HERE in between the following lines --> 
<!--		<td class=topmenu>
		
		    ADD MENU ITEMS HERE to display footer menu items in bar
		    
		    </td>  -->  
<!-- 	  if using either of the above lines, delete or comment out the
				following line END of OPTIONS -->
 	  
	 	  <td>&nbsp;</td>  
	    </tr>	   	
	  <tr><td>
	  		<table style="width: 100%; border-spacing: 0px; padding: 7px; border: 0px;"><tr><td style="border-collapse:separate">
<!-- end topmenu.php for template 5 -->