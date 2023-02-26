<?php
include 'tng_begin.php';

if( empty( $_GET['mod'] ) ) {
   echo ' Access denied (',__LINE__,')';
   exit;
}
else {
   $mod = $_GET['mod'];
}

//include  'subroot.php';
//include $subroot.'config.php';

if( pathinfo( $mod, PATHINFO_EXTENSION ) != 'cfg' ) {
   echo "Error: not a mod config file!";
   exit;
}
if( pathinfo( $mod, PATHINFO_DIRNAME ) != $modspath ) {
   echo "Error: file must be in the mods directory!";
   exit;
}

$lines = file($mod);

if( false !== $lines ) {

   echo $tngconfig['doctype'] ? $tngconfig['doctype'] : "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \n\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
   echo "
<title>CFG</title>
<meta http-equiv=\"Content-type\" content=\"text/html; charset=$session_charset\">";

   echo "
<style type='text/css'>
pre {
   white-space: pre-wrap;       /* Since CSS 2.1 */
   white-space: -pre-wrap;      /* Opera 4-6 */
   white-space: -o-pre-wrap;    /* Opera 7 */
   word-wrap: break-word;       /* Internet Explorer 5.5+ */
   padding:0;
   margin:0;
}
div {
   padding:0;
   margin:0;
}
</style>
</head>
<body>";

   $line_nr = 1;
   foreach( $lines as $line ) {
      $line = htmlspecialchars( $line );
      echo "
<div style=\"display:table-row\">
<div style=\"display:table-cell;color:gray;\">";
echo sprintf('%04d', $line_nr),':&nbsp;';
echo '</div>';
echo "<div style=\"display:table-cell\">";
echo "<pre>",$line,"</pre>";
echo "</div>";
echo "</div>";
      $line_nr++;
   }
   exit;
}
else {
   echo "Error: no file/content found!";
   exit;
}
echo "</body>
</html>
";
exit;
?>