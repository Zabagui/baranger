<?php
$cms = array();
if(isset($cms['support']) || isset($cms['tngpath']) || isset($_GET['lang']) || isset($_GET['mylanguage']) || isset($_GET['language']) || isset($_GET['session_language']) || isset($_GET['rootpath'])) die("Sorry!");
$tngconfig = array();
include("processvars.php");
include("subroot.php");
include("tngconnect.php");
include($tngconfig['subroot'] . "config.php");
$subroot = $tngconfig['subroot'] ? $tngconfig['subroot'] : $cms['tngpath'];
include($subroot . "importconfig.php");

if(!trim($database_port)) $database_port = null;
if(!trim($database_socket)) $database_socket = null;
$link = ($database_username && $database_name) ? tng_connect($database_host, $database_username, $database_password, $database_name, $database_port, $database_socket) : "";
if( $link && tng_select_db($link, $database_name)) {
	$error = "";
	if( $saveimport ){
		$query = "SELECT filename, icount, fcount, scount, mcount, pcount, ncount, barwidth from $saveimport_table WHERE gedcom = \"$tree\"";
		try {
			$result = tng_query( $query );
			$found = tng_num_rows( $result );
			if( $found ) {
				$row = tng_fetch_assoc($result);
				$json = json_encode($row);
			}
			else
				$json = "{}";
			tng_free_result($result);
		} catch (mysqli_sql_exception $e) {
			$json = "{\"error\": \"Database query failure\"}";
		}
	}
	else
		$json = "{\"error\": \"Save import option not enabled\"}";
}
else
	$json = "{\"error\": \"No database connection\"}";

print_r($json);
?>