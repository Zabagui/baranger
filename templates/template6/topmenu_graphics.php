<?php
	global $text, $cms, $subroot, $tmp;
?>
<body>
<div class="center">
<table class="page">
  <tr class="row60">
    <td colspan="4" class="headertitle">
	<img src="<?php echo $cms['tngpath'] . $templatepath; ?>img/titletop.jpg" alt="" />
    </td>
  </tr>
  <tr>
    <td class="titlemid">
	<img src="<?php echo $cms['tngpath'] . $templatepath; ?>img/titlebottom.jpg" width="559" height="60" alt="" />
    </td>
  </tr>
  <tr>
    <td class="headerback">

<?php
echo tng_icons(1);
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
    <td class="gradient">
	&nbsp;
    </td>
  </tr>
  <tr class="tablebkground">
    <td class="padding">
<!-- end topmenu graphic for template 6 -->