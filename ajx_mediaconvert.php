<?php
include("begin.php");
include("adminlib.php");
$textpart = "setup";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include($cms['tngpath'] . "checklogin.php");

if( !$allow_edit ) exit;

initMediaTypes();

require("adminlog.php");

header("Content-type:text/html; charset=" . $session_charset);

$count = 0;

function createFolder($base, $dest) {
    $folders = explode("/",$dest);
    $numfolders = count($folders);
    if($numfolders > 1) {
        for($i = 0; $i < $numfolders - 1; $i++) {
            if(!file_exists($base . $folders[$i]))
                @mkdir( $folders[$i], 0755 );
                //echo "making $base" . $folders[$i] . "<br>\n";
        }
    }
}

foreach($mediatypes_assoc as $type => $path) {
    $query = "SELECT path, abspath, thumbpath, usecollfolder, gedcom from $media_table 
        WHERE mediatypeID = \"$type\" AND gedcom != \"\" AND (path != \"\" OR thumbpath != \"\") 
        ORDER BY gedcom";
    $result = @tng_query($query);
    if($result) {
        while($row = tng_fetch_assoc($result)) {
            $done = 0;
            $usecollfolder = $row['usecollfolder'];
            $usefolder = $usecollfolder ? $path : $mediapath;
            if($action) { 
                //move to tree folders
                $dest = $rootpath . $usefolder . "/" . $row['gedcom']. "/";
                if(!file_exists($dest))
                    @mkdir( $dest, 0755 );
                    //echo "making $dest<br>\n";
                $source = $rootpath . $usefolder . "/";
            }
            else {
                //move from tree folders
                $source = $rootpath . $usefolder . "/" . $row['gedcom']. "/";
                $dest = $rootpath . $usefolder . "/";
            }
            if( $row['abspath'] != "1" && strpos($row['path'],"http") !== 0 && file_exists( $source . $row['path'] ) ) {
                //echo $source . $row['path'] . " => " . $dest . $row['path'] . "<br>\n";
                createFolder($dest, $row['path']);
                rename( $source . $row['path'], $dest . $row['path'] );
                $done = 1;
            }
            if( $row['thumbpath'] && strpos($row['thumbpath'],"http") !== 0 && file_exists( $source . $row['thumbpath'] ) ) {
                //echo $source . $row['thumbpath'] . " => " . $dest . $row['thumbpath'] . "<br>\n";
                createFolder($dest, $row['thumbpath']);
                rename( $source . $row['thumbpath'], $dest . $row['thumbpath'] );
                $done = 1;
            }
            $count += $done;
        }
        tng_free_result($result);
    }
}

$logmsg = preg_replace( "/xxx/", $count, $admtext['mediaexpl'] );

adminwritelog( $logmsg );
echo $logmsg;
?>