<?php
include("begin.php");
include("adminlib.php");
$textpart = "templates";
//include("getlang.php");
include("$mylanguage/admintext.php");

if(!count($_POST)) {
	header("Location: admin.php");
	exit;
}

if( $link ) {
	$admin_login = 1;
	include("checklogin.php");
	include("version.php");

	if( $assignedtree || !$allow_edit ) {
		$message = $admtext['norights'];
		header( "Location: admin_login.php?message=" . urlencode($message) );
		exit;
	}
}

require("adminlog.php");

$gensettings = @file_get_contents($tngconfig['subroot'] . "config.php");
$gensettings = str_replace("\$templatenum = \"$templatenum\"", "\$templatenum = \"$form_templatenum\"", $gensettings);
$gensettings = str_replace("\$templateswitching = \"$templateswitching\"", "\$templateswitching = \"$form_templateswitching\"", $gensettings);

$flen = @file_put_contents($tngconfig['subroot'] . "config.php", $gensettings);

unset($_POST['form_templatenum']);
unset($_POST['form_templateswitching']);
unset($_POST['save']);

foreach($_FILES as $key => $file) {
	$newfile = $file['tmp_name'];
	if( $newfile && $newfile != "none" ) {
		$newkey = substr($key,7);
		$foldername = is_numeric($form_templatenum) ? "template" . $form_templatenum : $form_templatenum;
		$newpath = $rootpath . "templates/$foldername/" . $_POST['form_' . $newkey];

		if( @move_uploaded_file($newfile, $newpath) )
			@chmod( $newpath, 0644 );
	}
}

//$mq = get_magic_quotes_gpc();
$lastkey = "";
$holdarr = array();
$orders = array();

$insert = "INSERT IGNORE INTO $templates_table (template,ordernum,keyname,language,value) VALUES ";
$update = "UPDATE $templates_table SET ";

foreach($_POST as $newkey => $newvalue) {
	$newvalue = addslashes($newvalue);
	//$newvalue = str_replace("\\'","'",$newvalue);
	//$newvalue = str_replace("\n","",$newvalue);
	$key = substr($newkey,5);

	//split key to get number, keyname & language
	$keyparts = explode("_",$key);
	$num_keyparts = count($keyparts);
	$template = substr($keyparts[0],1);
	if(!isset($orders[$template]))
		$orders[$template] = 1;
	else
		$orders[$template]++;

	if($num_keyparts > 1) {
		$keyname = $keyparts[1];	
		$language = $num_keyparts > 2 ? $keyparts[$num_keyparts-1] : "";

		//try insert
		$query = $insert . "(\"$template\", \"{$orders[$template]}\", \"$keyname\", \"$language\", \"$newvalue\")";
		$result = tng_query($query);
		$success = tng_affected_rows();
		//else try update
		if(!$success) {
			$query = $update . "value = \"$newvalue\", ordernum = \"{$orders[$template]}\" WHERE template = \"$template\" AND keyname = \"$keyname\" AND language = \"$language\"";
			$result = tng_query($query);
		}
		//fwrite($fp, "\$tmp['" . $key . "'] = \"$newvalue\";\n");
	}
}

adminwritelog( $admtext['modifytemplatesettings']. " - {$admtext['template']} " . $form_templatenum . " - {$admtext['templateswitching']} = " . $form_templateswitching );

$staying = !empty(${"submitx".$form_templatenum});
if( !empty($submitx) || $staying ) {
	header( "Location: admin_templateconfig.php" );
}
else {
	header( "Location: admin_setup.php" );
}
?>