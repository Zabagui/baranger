<?php
	global $text, $cms, $subroot, $tmp;
?>
<body id="bodytop" class="<?php echo pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME); ?> templatebody">
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
  <tr>
    <td class="headerback">

<?php
if(!isset($title) || !$title)
    $title = getTemplateMessage('t6_maintitle'); 
echo tng_icons(1, $title);
global $currentuser, $currentuserdesc, $flags;
$flags['noicons'] = 1;

if( $currentuser) {
    echo "<span class=\"headertext\">{$text['welcome']}, $currentuserdesc</span>&nbsp;";
    echo "<a href=\"{$cms['tngpath']}logout.php\"><span class=\"headertext-sm\">{$text['mnulogout']}</span></a>";
}
else {
    echo "<span class=\"headertext\">{$text['anon']}</span>&nbsp;";
    echo "<a href=\"{$cms['tngpath']}login.php\"><span class=\"headertext-sm\">{$text['mnulogon']}</span></a>";
}
?>

    </td>
  </tr>
  <tr>
   <td colspan="4" class="gradient">
	&nbsp;
    </td>
  </tr>
  <tr class="tablebkground">
    <td colspan="4" class="padding" style="border-collapse:separate">
<!-- end topmenu template 6 -->