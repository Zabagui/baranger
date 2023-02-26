<?php
include("begin.php");
include("adminlib.php");
$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include($subroot . "importconfig.php");

initMediaTypes();

$img = "";
if( $path == "gedcom" ) {
	$tngpath = !empty($tngimpcfg['saveconfig']) ? $subroot . $gedpath : $gedpath;
	$fulltngpath = !empty($tngimpcfg['saveconfig']) ? $subroot . $gedpath : $rootpath . $gedpath;
}
elseif($path == "media") {
	$tngpath = $mediapath;
	if($tngconfig['mediatrees'] && $assignedtree) {
		$tngpath .= "/" . $assignedtree;
        if(!file_exists($rootpath . $tngpath))
            @mkdir( $rootpath . $tngpath, 0755 );
	}
	$fulltngpath = $rootpath . $tngpath;
}
elseif(!empty($mediatypes_assoc[$path])) {
	$tngpath = $mediatypes_assoc[$path];
	if($tngconfig['mediatrees'] && $assignedtree) {
		$tngpath .= "/" . $assignedtree;
        if(!file_exists($rootpath . $tngpath))
            @mkdir( $rootpath . $tngpath, 0755 );
    }
	$fulltngpath = $rootpath . $tngpath;
}
else {
	$tngpath = "templates/" . $path . "/img";
	$img = "img/";
	//$subdir = "img/" . $subdir;
	$fulltngpath = $rootpath . $tngpath;
}
$pagetotal = 50;

if(!empty($order))
	$_SESSION['tng_file_order'] = $order;
else
	$order = isset($_SESSION['tng_file_order']) ? $_SESSION['tng_file_order'] : "name";

if($order == "nameup") {
	$dispnameorder = "name";
	$namedir = "desc";
}
else {
	$dispnameorder = "nameup";
	$namedir = "asc"; 
}

if($order == "date") {
	$dispdateorder = "dateup";
	$datedir = "asc"; 
}
else {
	$dispdateorder = "date";
	$datedir = "desc"; 
}

if( !isset( $subdir ) ) $subdir = '';
$ImageFileTypes = array("GIF","JPG","PNG");

header("Content-type:text/html; charset=" . $session_charset);

frmFiles();

function frmFiles() {
	global $ImageFileTypes, $subdir, $img, $admtext, $text, $page, $rootpath, $path, $tngpath, $fulltngpath, $pagetotal, $searchstring, $allow_delete, $dims, $tngconfig, $session_charset, $folders, $namedir, $datedir, $order, $cms;
	$columns = 4;
	$datefmt = !empty($tngconfig['preferEuro']) && $tngconfig['preferEuro'] == "true" ? "d/m/Y h:i:s A" : "m/d/Y h:i:s A";
?>

<div class="databack ajaxwindow" id="filepicker">
<p class="subhead"><strong><?php echo $admtext['selectfile']; ?></strong></p>

<?php
	$nCurrentPage = $page ? $page : 0;

	$validpath = false;
	if( file_exists("$fulltngpath/" . stripslashes($subdir)) && is_dir("$fulltngpath/" . stripslashes($subdir)) ) {
		$validpath = true;
	}
	$lRecCount = lCountFiles($validpath);
	$nPages = intval( ( $lRecCount - 0.5 ) / $pagetotal ) + 1;
	$lStartRec = $nCurrentPage * $pagetotal;

	frmFilesHdFt( $columns, $nCurrentPage, $nPages );
?>
<span class="normal">&nbsp;<?php echo "<b>{$admtext['folder']}:</b> $tngpath/" . stripslashes($subdir); ?> 
	&nbsp; | &nbsp; <b><?php echo $admtext['search']; ?>:</b> <input type="text" onkeyup="fpFilterChanged(event, this.value);"></span><br/>
<?php
	if( !$validpath ) {
		// The directory doesn't exist, so let the user know.
		echo "<tr><td><span class=\"normal\" style=\"color:#FF0000\"><em>" . $admtext['cannotopendir'] . " (" . $tngpath . "/" . stripslashes($subdir) . ") " . $admtext['improperpermissions'] . "</em></span></td></tr>";
	}
?>
<table cellpadding="3" cellspacing="1" border="0" width="100%" class="normal">
   <tr class="fieldnameback">
      <td align="left" width="60"><span class="fieldname"><b><?php echo $admtext['action']; ?></b></span></td>
      <td nowrap><span class="fieldname"><b><?php echo "<a href=\"#\" onclick=\"return " . mfpGetUrl(0,'name') . "\" class=\"lightlink\">{$admtext['filename']} <img src=\"{$cms['tngpath']}img/tng_sort_{$namedir}.gif\" width=\"15\" height=\"8\" border=\"0\" alt=\"\" /></a>"; ?></b></span></td>
      <td align="center"><span class="fieldname"><b><?php echo "<a href=\"#\" onclick=\"return " . mfpGetUrl(0,'date') . "\" class=\"lightlink\">{$admtext['date']} <img src=\"{$cms['tngpath']}img/tng_sort_{$datedir}.gif\" width=\"15\" height=\"8\" border=\"0\" alt=\"\" /></a>"; ?></b></span></td>
      <td align="center"><span class="fieldname"><b><?php echo $admtext['size']; ?></b></span></td>
      <td align="center"><span class="fieldname"><b><?php echo $admtext['dimensions']; ?></b></span></td>
   </tr>
<?php
	$nImageNr = 0;
	$nImageShowed = 0;

	$savedir = getcwd();
	if( file_exists("$fulltngpath/" . stripslashes($subdir)) && is_dir("$fulltngpath/" . stripslashes($subdir)) ) {
		chdir("$fulltngpath/" . stripslashes($subdir));
	}
	if( $handle = @opendir('.') ) {
		$fnentries = array();
		$dnentries = array();
		while ($file = readdir( $handle )) {
			if( !$searchstring || strpos(strtoupper($file),strtoupper($searchstring)) === 0 ) {
				if(is_file($file)) {
					if(!$folders) {
						$fnentries[$file] = filemtime($file);
					}
				}
				else {
					$dnentries[$file] = filemtime($file);
				}
			}
		}
		switch($order) {
			case "name":
				natksort($fnentries,false);
				natksort($dnentries,false);
				break;
			case "dateup":
				asort($fnentries);
				asort($dnentries);
				break;
			case "date":
				arsort($fnentries);
				arsort($dnentries);
				break;
			default:
				natksort($fnentries,true);
				natksort($dnentries,true);
				break;
		}
		if($folders)
			$nentries = $dnentries;
		else {
			$dnum = count($dnentries);
			$fnum = count($fnentries);
			if($dnum && $fnum)
				$nentries = $dnentries + $fnentries;
			elseif($dnum)
				$nentries = $dnentries;
			else
				$nentries = $fnentries;
		}
		//$nentries = $folders ? $dnentries : $dnentries + $fnentries;
		foreach( $nentries as $file => $value ) {
			//$file = addslashes($file);
			$filename = $file;
			if( is_file( $filename ) && $filename != "index.html" ) {
				$fileparts = pathinfo( $filename );
				$file_ext = isset($fileparts["extension"]) ? strtoupper( $fileparts["extension"] ) : "";
				if( $nImageNr >= $lStartRec && $nImageShowed < $pagetotal ) {

				echo "<tr id=\"row_$nImageNr\" class=\"filerow\">\n";
				echo "<td align=\"left\" class=\"lightback\"><div class=\"action-btns\">\n";
				echo "<a href=\"javascript:ReturnFile('$img$subdir" . addslashes($file) . "')\" title=\"{$admtext['select']}\" class=\"smallicon admin-edit-icon\"></a>";
				if($allow_delete)
					echo "<a href=\"#\" onclick=\"return deleteIt('file','$nImageNr','$tngpath/$subdir" . addslashes($file) . "');\" title=\"{$admtext['text_delete']}\" class=\"smallicon admin-delete-icon\"></a>";
				echo "<a href=\"javascript:ShowFile('$tngpath/$subdir" . addslashes($file) . "')\" title=\"{$admtext['preview']}\" class=\"smallicon admin-test-icon\"></a>\n";
?>
            </div>
        </td>
		<td class="lightback filecell"><?php echo $file; ?></td>
		<td align="center" class="lightback"><?php echo date($datefmt,$value); ?>&nbsp;</td>
		<td align="center" class="lightback"><?php echo display_size( filesize( $file ) ); ?></td>
<?php
					if(in_array($file_ext,$ImageFileTypes))
						$size = @GetImageSize($filename);
					else
						$size = "";
					if( $size ) {
						$imagesize1 = $size[0];
						$imagesize2 = $size[1];
						$imagesize = "$imagesize1 x $imagesize2";
					}
					else
						$imagesize = "";
?>
		<td align="center" class="lightback"><?php echo $imagesize; ?>&nbsp;</td>
	</tr>
<?php
					$nImageShowed++;
				}
				$nImageNr++;
			}
			elseif( is_dir( $filename ) ) {
				if( $filename != '.' && ($filename != '..' || $subdir != '') && $filename != '@eaDir') {
				//if( ( ( $subdir != '' ) && ( $filename != '.' ) ) || ( ( $subdir == '' ) && ( $filename != '.' ) && ( $filename != '..' ) ) ) {
					if( $nImageNr >= $lStartRec && $nImageShowed < $pagetotal ) {
						if( $filename != '..' )
							$newsubdir = $subdir . $filename . '/';
						else {
							$dirbreakdown = explode( '/', $subdir );
							array_pop( $dirbreakdown ); 
							array_pop( $dirbreakdown );
							$newsubdir = implode( '/', $dirbreakdown ) . '/';
							if( $newsubdir == '/' ) $newsubdir = '';
						} 
?>
	<tr>
		<td align="left" valign="middle" class="lightback">
<?php
						if($folders) {
							echo "<a href=\"javascript:ReturnFile('$img$subdir" . addslashes($file) . "')\" title=\"{$admtext['select']}\">{$admtext['select']}</a> | ";
						}
?>
			<span class="normal"><a href="#" onclick="return moreFilepicker({subdir: '<?php echo addslashes($newsubdir); ?>',path: '<?php echo $path; ?>',folders: '<?php echo $folders; ?>',order: '<?php echo $order; ?>'});"><?php echo $admtext['open']; ?></a></span>
		</td>
		<td valign="top" class="lightback">
			<span class="normal"><?php echo "<b>{$admtext['folder']}:</b> $filename"; ?></span>
		</td>
		<td align="center" class="lightback"><?php echo date($datefmt,filemtime($file)); ?>&nbsp;</td>
		<td align="center" valign="middle" class="lightback">&nbsp;</td>
		<td align="center" valign="middle" class="lightback">&nbsp;</td>
	</tr>
<?php
						$nImageShowed++;
					}
					$nImageNr++;
				}
			}
		}
		closedir( $handle );
	}
	chdir($savedir);

?>
   </table>
<?php
	//frmFilesHdFt( $columns, $nCurrentPage, $nPages );
?>
</div>
<?php
} // function frmFiles()


function lCountFiles($validpath) {
	global $ImageFileTypes, $subdir, $rootpath, $fulltngpath, $searchstring, $folders;
   
	$nFileCount = 0;
	$savedir = getcwd();
	if( $validpath )
		chdir( "$fulltngpath/" . stripslashes($subdir) );
	if( $handle = @opendir('.') ) {
		while( $file = readdir( $handle ) ) {
			if( !$searchstring || strpos($file,$searchstring) === 0 ){
				$filename = $file;
				if( is_file( $filename ) ) {
					if(!$folders) {
						$fileparts = pathinfo( $filename );
						$file_ext = isset($fileparts["extension"]) ? strtoupper( $fileparts["extension"] ) : "";
						$nFileCount++;
					}
				}
				elseif( is_dir( $filename ) )
					if( ( $subdir != '' ) || ( $filename != '..' ) ) $nFileCount++;
			}
		}
		closedir( $handle );
	}
	chdir( $savedir );
	
	return $nFileCount;
} // function lCountFiles()

?>

<?php
function frmFilesHdFt( $colspan, $nCurrentPage, $nPages ) {
	global $text, $subdir, $path;
	
	if($nPages > 1) {
		echo "<div class=\"normal\" style=\"float:right;padding:10px\">\n";

		$nCPage = $nCurrentPage + 1; //current page display
		
		if ($nCurrentPage != 0) { 
			mfpLink($nCurrentPage - 1,$text['text_prev']);
		} 
		mfpLink(0,1,$nCurrentPage == 0);
		
		$firstNear = $nCurrentPage - 4;
		$lastNear = $nCurrentPage + 4;
		
		if($firstNear > 1)
			echo "... ";
	
		for($i = $firstNear > 0 ? $firstNear : 1; $i <= ($lastNear < $nPages - 1 ? $lastNear : $nPages - 2); $i++) {
			mfpLink($i,$i+1,$i == $nCurrentPage);
		}
	
		if($lastNear < $nPages - 2)
			echo "... ";
		
		mfpLink($nPages - 1,$nPages,$nCurrentPage == $nPages-1);
		if( $nCurrentPage + 1 != $nPages ) { 
			mfpLink($nCurrentPage + 1,$text['text_next']);
		}

		if($firstNear > 1 || $lastNear < $nPages - 2) {
			$nextPageStr = "jQuery('#gotopage').prev('.tngpage').val()-1";
			echo "<span class=\"snlink\">\n";
			echo "<input type=\"text\" class=\"tngpage minifield\" placeholder=\"{$text['page']} #\" name=\"tngpage\" onkeyup=\"if(pageEnter(this,event)) {" . mfpGetUrl($nextPageStr) . "}\"/> ";
			echo "<input type=\"button\" id=\"gotopage\" value=\"{$text['go']}\" class=\"minibutton\" onclick=\"" . mfpGetUrl($nextPageStr) . "\"/>\n";
			echo "</span>";
		}
		echo "</div>\n";
	}
}

function mfpLink($pagenum, $label, $active = false) {
	global $subdir, $path;
	
	if(!$active)
		echo "<a href=\"#\" onclick=\"return " . mfpGetUrl($pagenum) . "\" class=\"snlink\">$label</a>\n";
	else
		echo "<span class=\"snlink snlinkact\">$label</span>\n";
}

function mfpGetUrl($pagenum, $col = "") {
	global $subdir, $path, $dispnameorder, $dispdateorder, $order, $folders;
	
	switch($col) {
		case "name":
			$colstr = $dispnameorder;
			break;
		case "date":
			$colstr = $dispdateorder;
			break;
		default:
			$colstr = $order;
			break;
	}
	return "moreFilepicker({subdir: '$subdir',path: '$path',folders: '$folders', page: $pagenum, order: '{$colstr}'});";
}

function display_size( $file_size ) {
	if( $file_size >= 1073741824 )
		$file_size = round( $file_size / 1073741824 * 100 ) / 100 ."g";
    elseif( $file_size >= 1048576 ) 
		$file_size = round( $file_size / 1048576 * 100 ) / 100 ."m";
    elseif( $file_size >= 1024 ) 
		$file_size = round( $file_size / 1024 * 100) / 100 ."k";
    else
		$file_size = $file_size." bytes";
		
	return $file_size;
} // function display_size()

function natksort(&$array,$reverse) {
    $keys = array_keys($array);
    natcasesort($keys);
    if($reverse)
    	$keys = array_reverse($keys);

    $new_array = array();
    foreach ($keys as $k) {
        $new_array[$k] = $array[$k];
    }

    $array = $new_array;
    return true;
}
?>