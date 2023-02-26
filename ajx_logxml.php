<?php
include("begin.php");
require($subroot . "logconfig.php");
include($cms['tngpath'] . "genlib.php");
include($cms['tngpath'] . "getlang.php");

include($cms['tngpath'] . "checklogin.php");

header("Content-type:text/html; charset=" . $session_charset);
?>
<table class="rounded-table" cellspacing="1">
<?php
$lines = file( $logfile );
foreach ( $lines as $line ) {
	if(strpos($line, "<script") === false) {
		if(empty($tree) || strpos($line,"tree=$tree\"") !== false || strpos($line,"tree=$tree&") !== false || strpos($line,"tree=") === false) {
			if(strpos($line,"<tr>") !== 0)
				echo "<tr><td colspan=\"3\" class=\"databack\">$line</td></tr>\n";
			else
				echo "$line\n";
		}
	}
	else
		echo "<tr><td colspan=\"3\" class=\"databack\">" . htmlspecialchars($line) . "<strong>Please investigate this access</strong></td></tr>\n";
}
?>
</table>