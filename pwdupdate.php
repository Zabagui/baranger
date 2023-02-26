<?php
$textpart = "login";
include("tng_begin.php");

tng_header( $text['resetpass'], $flags );

$resultmsg = $success == 1 ? $text['resetsuccess'] : $text['resetfail'] . $text['failreason'.$success];
?>
<p class="header"><?php echo $text['resetpass']; ?></p><br clear="all" />

<p><?php echo $resultmsg; ?></p>

<a href="<?php echo $dest; ?>"><?php echo $text['continue']; ?></a>

<?php
tng_footer( "" );
?>