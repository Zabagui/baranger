<?php
$textpart = "showlog";
include("tng_begin.php");

if( !$allow_admin ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

if(isset($cms['events'])){include('cmsevents.php'); cms_logs();}
require($subroot . "logconfig.php");

if( $maxloglines )
	$loglines = $maxloglines;
else 
	$loglines = "";

$showlog_url = getURL( "showlog", 1 );
$logxml_url  = getURL("ajx_logxml",1);

//$flags[autorefresh] = $autorefresh;
if( isset($autorefresh) )
	$flags['scripting'] = "<script type=\"text/javascript\" src=\"{$cms['tngpath']}js/net.js\"></script>\n";
$owner = $sitename ? $sitename : $dbowner;
tng_header( "$loglines {$text['mostrecentactions']}", $flags );
?>

<h1 class="header"><?php echo "$loglines {$text['mostrecentactions']}"; ?></h1><br clear="all" />
<?php
echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'showlog', 'method' => 'get', 'name' => 'form1', 'id' => 'form1'));
if(isset( $autorefresh ))
	echo "<p class=\"normal\"><a href=\"$showlog_url" . "tree={$tree}\">{$text['refreshoff']}</a></p>\n";
else
	echo "<p class=\"normal\"><a href=\"$showlog_url" . "autorefresh=1&amp;tree={$tree}\">{$text['autorefresh']}</a></p>\n";
?>

<div align="left" class="normal" id="content">
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
</div>

<?php
if(isset( $autorefresh )) {
?>
<script type="text/javascript">
function refreshPage() {
 	var loader1 = new net.ContentLoader('<?php echo $logxml_url . "tree={$tree}"?>',FillPage,null,"POST",'');
	var timer = setTimeout("refreshPage()",30000);
}

function FillPage() {
   	var content = document.getElementById("content");
	content.innerHTML = this.req.responseText;
}

var timer = setTimeout("refreshPage()",30000);
</script>
<?php
}
tng_footer( "" );
?>