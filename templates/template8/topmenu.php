<?php
	global $text, $currentuser, $cms, $allow_admin, $subroot, $tmp;
?>
<body id="bodytop" class="<?php echo pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME); ?> templatebody">
<table class="page">
  <tr>
    <td class="mainborder" rowspan="5">
	&nbsp;
    </td>
    <td class="headerrow" style="background: url(<?php echo $cms['tngpath'] . $templatepath; ?><?php echo $tmp['t8_headimg']; ?>) no-repeat;">
	<table class="headertable">
	<tr class="headertextrow">
	    <td>

<!-- ADD THE TITLE AND SUBTITLE OF YOUR WEBPAGE BELOW -->
<!-- You can use the class "text_white" and "text_tan" and "text_grey" to alternate the colors of words -->
<?php
	//begin HEADER TITLE, PARTS 1,2 & 3 (default text: "surname - genealogy - pages")
	//Configurable from Template Settings. You can also replace the t8_headtitle1-3 PHP blocks below with the desired text if you prefer that to using the Template Settings.
?>

<span class="headertext text_white"><?php echo getTemplateMessage('t8_headtitle1'); ?></span><span class="headertext text_tan"><?php echo getTemplateMessage('t8_headtitle2'); ?></span><span class="headertext text_white"><?php echo getTemplateMessage('t8_headtitle3'); ?></span>

<?php
	//end HEADER TITLE, PARTS 1,2 & 3
?>

<br/>

<?php
	//begin HEADER SUBTITLE (default text: "genealogy of the surname family")
	//Configurable from Template Settings. You can also replace the t8_headsubtitle PHP block below with the desired text if you prefer that to using the Template Settings.
?>

<span class="normal text_grey"><?php echo getTemplateMessage('t8_headsubtitle'); ?></span>

<?php
	//end HEADER SUBTITLE
?>

	    </td>
	    <td class="searchtext">
		<form id="topsearchform" name="topsearchform" method="get" action="<?php echo $cms['tngpath']; ?>search.php">
		    <input type="hidden" value="AND" name="mybool" />
		    <span class="subsearch"><?php echo $text['mnufirstname']; ?>:&nbsp;</span><input size="8" name="myfirstname" type="text" id="myfirstname" />  <span class="subsearch"><?php echo $text['mnulastname']; ?>:&nbsp;</span><input size="10" name="mylastname" type="text" id="mylastname" /> <input alt="Submit Search" style="vertical-align: bottom; border:none;" type="image" name="imageField" src="<?php echo $cms['tngpath'] . $templatepath; ?>img/searchbutton.gif"/>
		    <br/>
		    [<a class="subsearch" href="<?php echo $cms['tngpath']; ?>searchform.php"><?php echo $text['mnuadvancedsearch']; ?></a>]&nbsp;&nbsp;[<a class="subsearch" href="<?php echo $cms['tngpath']; ?>surnames.php"><?php echo $text['mnulastnames']; ?></a>]
		</form>
	    </td>
	</tr>
	</table>
    </td>
  </tr>
  <tr class="menurow">
    <td colspan="2">
	<div class="menucol">
<?php
if(!isset($title) || !$title)
    $title = getTemplateMessage('t8_maintitle'); 
echo tng_icons(1, $title);
global $currentuserdesc, $flags;
$flags['noicons'] = 1;

if( $currentuser) {
    echo "<span class=\"logintext\">{$text['welcome']}, $currentuser</span>";
}
else {
    echo "<span class=\"logintext\">{$text['anon']}</span>";
}
?>
	</div>
    </td>
  </tr>
  <tr>

<?php
	# this allows two different classes for the main index page and regular TNG pages
	if (strpos($_SERVER['SCRIPT_NAME'], 'index.php') === false) {
		echo "<td class=\"mainbg\" colspan=\"3\" style=\"border-collapse:separate\">";
	}
	else {
		echo "<td colspan=\"3\" style=\"border-collapse:separate\">";
	}
?>