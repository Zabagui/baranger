<?php
include("begin.php");
include("adminlib.php");
$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");
require("adminlog.php");

if( !$allow_media_add || $assignedtree ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

$totalImported = 0;
function importFrom($tngpath, $orgpath,$needsubdirs) {
	global $rootpath, $media_table, $mediatypeID, $tree, $time_offset, $thumbprefix, $thumbsuffix, $session_charset, $totalImported;
	$subdirs = array();

	if($orgpath) {
		$path = $tngpath . "/" . $orgpath;
		$orgpath .= "/";
	}
	else
		$path = $tngpath;
	@chdir("$rootpath$path") or die("Unable to open $rootpath$path. Please check your Root Path (General Settings).");
	if( $handle = @opendir('.') ) {
		while ($filename = readdir( $handle )) {
			if( is_file( $filename ) ) {
				if(($thumbprefix && strpos($filename, $thumbprefix) !== 0) || ($thumbsuffix && substr($filename,-strlen($thumbsuffix)) != $thumbsuffix)) {
					//$cleanfile = $session_charset == "UTF-8" ? utf8_encode($filename) : $filename;
					echo "Inserting $path/$filename ... ";
					//insert ignore into database
					$fileparts = pathinfo( $filename );
					$form = strtoupper( $fileparts["extension"] );
					$newdate = date ("Y-m-d H:i:s", time() + ( 3600 * $time_offset ) );
					$query = "INSERT IGNORE INTO $media_table (mediatypeID,mediakey,gedcom,path,thumbpath,description,notes,width,height,datetaken,placetaken,owner,changedate,form,alwayson,map,abspath,status,cemeteryID,showmap,linktocem,latitude,longitude,zoom,bodytext,usenl,newwindow,usecollfolder)
						VALUES (\"$mediatypeID\",\"$path/$filename\",\"$tree\",\"$orgpath$filename\",\"\",\"$orgpath$filename\",\"\",\"\",\"\",\"\",\"\",\"\",\"$newdate\",\"$form\",\"0\",\"\",\"0\",\"\",\"\",\"0\",\"0\",\"\",\"\",\"0\",\"\",\"0\",\"0\",\"1\")";
					$result = @tng_query($query);
					$success = tng_affected_rows();
					//$success = 1;
					if($success) {
						echo "success<br/>\n";
						$totalImported++;
					}
					else
						echo "<strong>failed (duplicate)</strong><br/>\n";
				}
			}
			elseif($needsubdirs && is_dir($filename) && $filename != '..' && $filename != '.' && $filename != '@eaDir') {
				// Added to remove Synology @ea type files
				if (fnmatch("@ea*",$filename)){
                	continue; 
                }
				else
					array_push($subdirs,$filename);
			}
		}
		closedir( $handle );
	}
	
	return $subdirs;
}

$helplang = findhelp("data_help.php");
adminwritelog( $admtext['media'] . " &gt;&gt; " . $admtext['import'] . " ($mediatypeID): $tree" );

tng_adminheader( $admtext['phimport'], $flags );

$tngpath = $mediatypes_assoc[$mediatypeID];
?>
</head>

<?php
	echo tng_adminlayout();

	$mediatabs[0] = array(1,"admin_media.php",$admtext['search'],"findmedia");
	$mediatabs[1] = array($allow_media_add,"admin_newmedia.php",$admtext['addnew'],"addmedia");
	$mediatabs[2] = array($allow_media_edit,"admin_ordermediaform.php",$admtext['text_sort'],"sortmedia");
	$mediatabs[3] = array($allow_media_edit && !$assignedtree,"admin_thumbnails.php",$admtext['thumbnails'],"thumbs");
	$mediatabs[4] = array($allow_media_add && !$assignedtree,"admin_photoimport.php",$admtext['import'],"import");
	$mediatabs[5] = array($allow_media_add && !$assignedtree,"admin_mediaupload.php",$admtext['upload'],"upload");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/media_help.php#modify');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($mediatabs,"import",$innermenu);
	echo displayHeadline($admtext['media'] . " &gt;&gt; " . $admtext['import'],"img/photos_icon.gif",$menu,$message);
?>

<table width="100%" border="0" cellpadding="10" cellspacing="2" class="lightback">
<tr class="databack">
<td class="tngshadow normal">
<?php
	$subdirs = importFrom($tngpath,'',1);
	foreach($subdirs as $subdir) {
		chdir("$rootpath$tngpath/$subdir");
		importFrom($tngpath, $subdir,0);
	}
	if($totalImported) {
		$query = "UPDATE $mediatypes_table SET disabled=\"0\" where mediatypeID=\"$mediatypeID\"";
		$result = @tng_query($query);
	}
?>
</td>
</tr>

</table>
<?php 
echo tng_adminfooter();
?>