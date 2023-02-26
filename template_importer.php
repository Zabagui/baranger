<?php
include("begin.php");
include("adminlib.php");
include("getlang.php");
include("$mylanguage/admintext.php");
tng_db_connect($database_host,$database_name,$database_username,$database_password,$database_port,$database_socket) or exit;
@set_time_limit(0);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Template Importer</title>
	<link href="css/genstyle.css" rel="stylesheet">
</head>

<body style="font-size:12pt;">
<h2>Template Importer</h2>
<?php
include($filename . ".php");
preg_match('/\d+/', $filename, $matches);
$templatenum = $matches[0];
echo "Importing new template settings from $filename into the database (template $templatenum)...";
$query = "DELETE FROM $templates_table WHERE template = \"$templatenum\"";
$result = tng_query($query);

$query = "INSERT IGNORE INTO $templates_table (template,ordernum,keyname,language,value) VALUES ";
$values = "";
$orders = array();
foreach($tmp as $key => $value) {
	$keyparts = explode("_",$key);
	$template = substr($keyparts[0],1);
	if(!isset($orders[$template]))
		$orders[$template] = 1;
	else
		$orders[$template]++;
	$keyname = $keyparts[1];
	$num_keyparts = count($keyparts);
	$language = $num_keyparts > 2 ? $keyparts[$num_keyparts-1] : "";
	if($values) $values .= ", ";
	$values .= "(\"$template\",\"{$orders[$template]}\",\"$keyname\",\"$language\",\"" . addslashes($value) . "\")";
}
$query .= $values;
$result = tng_query($query);
?>
<br/>
Your template variables have been imported.

</body>
</html>