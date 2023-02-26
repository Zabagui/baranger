<?php
include $cms['tngpath'].'begin.php';
include $cms['tngpath'].'adminlib.php';
include $cms['tngpath'].$mylanguage.'/admintext.php';

$admin_login = 1;
include $cms['tngpath'].'checklogin.php';

$title="Purge Cache Files";
echo "<br /><html><title>$title</title>
<meta name='robots' content='noindex,nofollow'>
</head>
<body background='../../img/background.gif'>
<form action='cache-delete.php' method='get'>
<table style='width:70%; margin-left:15%; margin-right:15%;'>
<tr><td colspan=3><h2><center>$title</center></h2></td></tr><tr>
";

$count = 0;
echo "<td colspan=3>";
foreach (glob('*cache*.html') as $filename) {
   echo ('<center>Deleting ' . '<strong>' . $filename . '</strong>' . ' size ' . filesize($filename) . ' bytes</center><br />');
   unlink($filename);
   $count++;
}

if ($count > 0) {
    echo '<center><br />' . 'The cache files have been deleted' . '</center><br /><br />';
    }
else {
    echo '<center>No cache files were found' . '<center><br /><br />';
    }
echo "<center><input name='Cancel' value='Return to mod manager' type='button' onclick=\"location.href='admin_modhandler.php'\" ></center>\n";
echo "</td></tr><table></form>\n";
?>