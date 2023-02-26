<?php
include("begin.php");
include($cms['tngpath'] . "genlib.php");

$tngprint = 1;
include($cms['tngpath'] . "checklogin.php");
include($cms['tngpath'] . "imageutils.php");

header('Content-type: image/jpeg');
$maxsize = 380;

$path = urldecode($path);
$imagename = "$rootpath$path";
$photoinfo = @GetImageSize( $imagename );
switch($photoinfo[2]) {
	case 1: //GIF
		$image = @imageCreateFromGif( $imagename );
		break;
	case 3: //PNG
		$image = @imageCreateFromPng( $imagename );
		break;
	default: //JPEG
		$image = @imageCreateFromJpeg( $imagename );
		break;
}

if( $photoinfo[0] <= $maxsize && $photoinfo[1] <= $maxsize ) {
	$photohtouse = $photoinfo[1];
	$photowtouse = $photoinfo[0];
}
else {
	if( $photoinfo[0] > $photoinfo[1] ) {
		$photowtouse = $maxsize;
		$photohtouse = intval( $maxsize * $photoinfo[1] / $photoinfo[0] ) ;
	}
	else {
		$photohtouse = $maxsize;
		$photowtouse = intval( $maxsize * $photoinfo[0] / $photoinfo[1] ) ;
	}
}

// Resample
$image_resized = @imagecreatetruecolor($photowtouse, $photohtouse);
@imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $photowtouse, $photohtouse, $photoinfo[0], $photoinfo[1]);

$image_resized = tngImageRotate($imagename, $image_resized);
// Display resized image
imagejpeg($image_resized);
?>
