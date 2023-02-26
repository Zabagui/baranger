<?php
include("begin.php");
include("adminlib.php");
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");

initMediaTypes();

$usefolder = $usecollfolder ? $mediatypes_assoc[$mediatypeID] : $mediapath;

$trypath = $path;
$trythumb = $thumbpath;

function getBase($path) {
	$fileparts = pathinfo($path);
	$basepath = $fileparts['dirname'] && $fileparts['dirname'] != "." ? $basepath . "/" : "";
	$basepath .= $fileparts['filename'];
	$fileparts['basepath'] = $basepath;
	return $fileparts;
}

$count = 0;
while(file_exists("$rootpath$usefolder/$trypath")) {
	$count++;
	if(!isset($fileparts))
		$fileparts = getBase($path);
	$trypath = $fileparts['basepath'] . $count . "." . $fileparts['extension'];
}

$count = 0;
unset($fileparts);
if($trythumb) {
	while(file_exists("$rootpath$usefolder/$trythumb")) {
		$count++;
		if(!isset($fileparts))
			$fileparts = getBase($thumbpath);
		$trythumb = $fileparts['basepath'] . $count . "." . $fileparts['extension'];
	}
}

header("Content-Type: application/json; charset=" . $session_charset);

echo "{\"path\":" . json_encode($trypath) . ",\"thumbpath\":" . json_encode($trythumb) . "}";
?>
