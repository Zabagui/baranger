<?php
$textpart = "getperson";
include("tng_begin.php");

$deletebookmark_url = getURL( "ajx_deletebookmark", 1 );

$newroot = preg_replace( "/\//", "", $rootpath );
$newroot = preg_replace( "/ /", "", $newroot );
$newroot = preg_replace( "/\./", "", $newroot );
$ref = "tngbookmarks_$newroot";

tng_header( $text['bookmarks'], $flags );
?>
 <!-- DED added alt='' & changed span to div in next line-->
<h1 class="header"><span class="headericon" id="bookmarks-hdr-icon"></span><?php echo $text['bookmarks']; ?></h1><br clear="left"/>
<?php
echo "<p class=\"normal\">" . $text['bkmkvis'] . "</p>";

echo "<ul class=\"normal\">\n";
if (isset($_COOKIE[$ref])) {
    $bcount=0;
    $bookmarks = explode("|", $_COOKIE[$ref]);
    foreach( $bookmarks as $bookmark ) {
    	if(trim($bookmark)) {
	    	echo "<li>" . stripslashes($bookmark) . " | <a href=\"$deletebookmark_url" . "idx=$bcount\">{$text['remove']}</a></li>\n";
		    $bcount++;
	    }
    }
} else {
    echo "<li>0 {$text['bookmarks']}</li>";
}
echo "</ul><br />\n";
tng_footer( "" );
?>
