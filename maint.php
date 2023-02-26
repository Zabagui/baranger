<?php
include("begin.php");
$tmp = getTemplateVars($templatenum);
$tngconfig['maint'] = "";
include($cms['tngpath'] . "genlib.php");
$textpart = "language";
include($cms['tngpath'] . "getlang.php");
include($cms['tngpath'] . "$mylanguage/text.php");

$maintenance_mode = true;

tng_header( $text['sitemaint'], $flags );
?>

<h1 class="header"><?php echo $text['sitemaint']; ?></h1><br clear="all" />

<?php 
echo tng_coreicons();

echo "<p class=\"normal\">" . $text['standby'] . "</p><br /><br />";

tng_footer( "" );
?>
