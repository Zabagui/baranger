<?php
function chkgd2(){
	$testGD = get_extension_funcs( "gd" ); // Grab function list
	if( !$testGD ) { echo "GD not installed."; exit; }
	if( in_array ( "imagegd2", $testGD ) )
		return true;
	else 
		return false; 
}

function get_pdf_dimensions($path, $box="MediaBox") {
    //$box can be set to BleedBox, CropBox or MediaBox 

    $stream = new SplFileObject($path); 

    $result = false;

    while (!$stream->eof()) {
    	$line = $stream->fgets();
        if (preg_match("/".$box."\s*\[\s*[0-9]{1,} [0-9]{1,} ([0-9]{1,}) ([0-9]{1,})\s*\]/", $line, $matches)) {
            $result["width"] = $matches[1];
            $result["height"] = $matches[2]; 
            break;
        }
    }

    $stream = null;

    return $result;
}

function image_createThumb( $src, $dest, $maxWidth, $maxHeight, $quality ) { 
    if( file_exists( $src ) && isset( $dest ) ) {
        $destInfo = pathInfo( $dest );
        $srcInfo = pathInfo( $src );
		//if($session_charset == "UTF-8") $dest = utf8_decode($dest);

       	$isPDF = false;
        if(strtoupper( $srcInfo['extension'] ) == "PDF") {
        	if(extension_loaded('imagick')) {
	        	//get size, set as [0] and [1]
	        	$pdf_dims = get_pdf_dimensions($src);
	        	if($pdf_dims['width'] && $pdf_dims['height']) {
		        	$srcSize[0] = $pdf_dims['width'];
		        	$srcSize[1] = $pdf_dims['height'];
		        	$isPDF = true;
	        	}
	        }
	        if(!$isPDF)
	        	return false;
        }
        else {
        	$isPDF = false;
	        $srcSize = @getImageSize( $src );
	    }

        // image dest size $destSize[0] = width, $destSize[1] = height
		if( $srcSize[1] )
	        $srcRatio  = $srcSize[0] / $srcSize[1]; // width/height ratio
		else
			return false;
		if( !$maxWidth ) $maxWidth = 50;
		if( !$maxHeight ) $maxHeight = 50;
        $destRatio = $maxWidth / $maxHeight; 
        if ($destRatio > $srcRatio) { 
            $destSize[1] = $maxHeight; 
            $destSize[0] = $maxHeight * $srcRatio; 
        } 
        else { 
            $destSize[0] = $maxWidth; 
            $destSize[1] = $maxWidth / $srcRatio; 
        }

        //if it's a PDF do one thing
        //else do what we did before
        if($isPDF) {
			$im = new Imagick($src."[0]"); // 0-first page, 1-second page
			$im->setImageColorspace(255); // prevent image colors from inverting
			$im->setimageformat("jpeg");
			$im->thumbnailimage($destSize[0], $destSize[1]); // width and height
            $dest = substr_replace( $dest, 'jpg', -3 ); 
			$im->writeimage($dest);
			$im->clear();
			$im->destroy();
        }
        else {
	        if( strtoupper( $destInfo['extension'] ) == "GIF")
	            $dest = substr_replace( $dest, 'jpg', -3 ); 
				
	        $gd2 = chkgd2();
			if( $gd2 && function_exists( 'imageCreateTrueColor' ) ) {
		        $destImage = @ImageCreateTrueColor( $destSize[0], $destSize[1] ) or  $destImage = ImageCreate( $destSize[0], $destSize[1] );
				if( strtolower($destInfo['extension']) == "gif" || strtolower($destInfo['extension']) == "png" ) {
					imagecolortransparent($destImage, imagecolorallocatealpha($destImage, 0, 0, 0, 127));
					imagealphablending($destImage, false);
					imagesavealpha($destImage, true);
				}
				if( function_exists( 'imageAntiAlias' ) )
		        	@imageAntiAlias( $destImage, true ); 
			}
			else
		        $destImage = ImageCreate( $destSize[0], $destSize[1] );

	        switch ($srcSize[2]) { 
	            case 1: //GIF 
		            $srcImage = @imageCreateFromGif( $src );
		            break; 
	            case 2: //JPEG 
		            $srcImage = @imageCreateFromJpeg( $src );
		            break; 
	            case 3: //PNG 
		            $srcImage = @imageCreateFromPng( $src );
		            break;
	            default:
		            return false;
		            break;
	        }
			if( !$srcImage ) return false;

	        // resampling 
			if( $gd2 && function_exists( 'imageCopyResampled' ) ) {
		       if( !@imageCopyResampled( $destImage, $srcImage, 0, 0, 0, 0, $destSize[0], $destSize[1], $srcSize[0], $srcSize[1] ) )
		        	imagecopyresized( $destImage, $srcImage, 0, 0, 0, 0, $destSize[0], $destSize[1], $srcSize[0], $srcSize[1] );
			}
			else
	        	imagecopyresized( $destImage, $srcImage, 0, 0, 0, 0, $destSize[0], $destSize[1], $srcSize[0], $srcSize[1] );

	        // generating image 
	        switch( $srcSize[2] ) { 
	            case 1: case 2: 
	            	if($srcSize[2] == 2) {
						//fix photos taken on cameras that have incorrect
						//dimensions
						$destImage = tngImageRotate($src, $destImage);
					}
		            if( !@imageJpeg( $destImage, $dest, $quality ) ) return false;
		            break; 
	            case 3: 
		            if( !@imagePng( $destImage, $dest ) ) return false;
		            break; 
	        } 
        }

        return true; 
    } 
    else
        return false; 
}

function tngImageRotate($src, $destImage) {
	if(function_exists('exif_read_data')) {
        $exif = @exif_read_data($src);
		if($exif !== false) {
			//get the orientation
			$ort = isset($exif['Orientation']) ? $exif['Orientation'] : "";

			//determine what oreientation the image was taken at
			switch($ort) {
				case 2: // horizontal flip
					tngImageFlip($destImage);
					break;
				case 3: // 180 rotate left
					$destImage = imagerotate($destImage, 180, imagecolorallocatealpha($destImage, 0, 0, 0 , 127));
					break;
				case 4: // vertical flip
					tngImageFlip($destImage);
					break;
				case 5: // vertical flip + 90 rotate right
					tngImageFlip($destImage);
					$destImage = imagerotate($destImage, -90, imagecolorallocatealpha($destImage, 0, 0, 0 , 127));
					break;
				case 6: // 90 rotate right
					$destImage = imagerotate($destImage, -90, imagecolorallocatealpha($destImage, 0, 0, 0 , 127));
					break;
				case 7: // horizontal flip + 90 rotate right
					tngImageFlip($destImage);
					$destImage = imagerotate($destImage, -90, imagecolorallocatealpha($destImage, 0, 0, 0 , 127));
					break;
				case 8: // 90 rotate left
					$destImage = imagerotate($destImage, 90, imagecolorallocatealpha($destImage, 0, 0, 0 , 127));
					break;
			}
		}
	}
	return $destImage;
}

function tngImageFlip(&$image, $x = 0, $y = 0, $width = null, $height = null) {
	if ($width  < 1) $width  = imagesx($image);
	if ($height < 1) $height = imagesy($image);

	// Truecolor provides better results, if possible.
	if (function_exists('imageistruecolor') && imageistruecolor($image)) {
		$tmp = imagecreatetruecolor(1, $height);
	}
	else {
		$tmp = imagecreate(1, $height);
	}
	$x2 = $x + $width - 1;
	for ($i = (int)floor(($width - 1) / 2); $i >= 0; $i--) {
		// Backup right stripe.
		imagecopy($tmp, $image, 0, 0, $x2 - $i, $y, 1, $height);

		// Copy left stripe to the right.
		imagecopy($image, $image, $x2 - $i, $y, $x + $i, $y, 1, $height);

		// Copy backuped right stripe to the left.
		imagecopy($image, $tmp, $x + $i,  $y, 0, 0, 1, $height);
	}

	imagedestroy($tmp);

	return true;
}
?>
