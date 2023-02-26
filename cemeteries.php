<?php
$textpart = "headstones";
include("tng_begin.php");

$browsemedia_url = getURL( "browsemedia", 1 );
$headstones_url = getURL( "headstones", 1 );
$showmap_url = getURL( "showmap", 1 );
$cemeteries_url = getURL( "cemeteries", 1 );

$query = "SELECT * FROM $cemeteries_table ORDER BY country, state, county, city, cemname";
$cemresult = tng_query($query);
$numcems = $tngconfig['cemrows'] ? $tngconfig['cemrows'] : max(floor(tng_num_rows($cemresult)/2),10);

$treestr = $tree ? " ({$text['tree']}: $tree)" : "";
$wherestr = ($tree) ? "AND $medialinks_table.gedcom = \"$tree\"" : "";

$query = "SELECT $medialinks_table.personID as personID FROM $medialinks_table, $media_table WHERE $media_table.mediaID = $medialinks_table.mediaID AND mediatypeID=\"headstones\" AND cemeteryID = \"\" $wherestr";
$hsresult = tng_query($query);
$numhs = tng_num_rows( $hsresult );
tng_free_result($hsresult);

$logstring = "<a href=\"$cemeteries_url" . "tree=$tree\">{$text['cemeteriesheadstones']}$treestr</a>";
writelog($logstring);
preparebookmark($logstring);

$flags['css'] = "<link href=\"{$cms['tngpath']}css/cemeteries.css?v=" . (filemtime($rootpath."css/cemeteries.css")) . "\" rel=\"stylesheet\" type=\"text/css\" />\n";

tng_header( $text['cemeteriesheadstones'], $flags );
?>

<script type="text/javascript">
var collapsemsg = "<?php echo $text['collapse']; ?>";
var expandmsg = "<?php echo $text['expand']; ?>";

function toggleCemSection(key) {

	var section = jQuery('#'+key);
	if( section.css('display') == 'none' ) {
		jQuery('#'+key).fadeIn(200);

		swap("plusminus" + key,"minus");
	}
	else {
		jQuery('#'+key).fadeOut(200);
		swap("plusminus" + key,"plus");
	}
	return false;
}

plus = new Image;
plus.src = "<?php echo $cms['tngpath'] ?>img/tng_expand.gif";
minus = new Image;
minus.src = "<?php echo $cms['tngpath'] ?>img/tng_collapse.gif";

function swap(x, y) {
	jQuery('#'+x).attr('title',y == "minus" ? collapsemsg : expandmsg);
	document.images[x].src=eval(y+'.src');
}
</script>

<h1 class="header"><span class="headericon" id="cemeteries-hdr-icon"></span><?php echo $text['cemeteriesheadstones']; ?></h1><br clear="all" />
<?php
echo treeDropdown(array('startform' => true, 'endform' => true, 'action' => 'cemeteries', 'method' => 'get', 'name' => 'form1', 'id' => 'form1'));

define ("DUMMYPLACE", "@@@@@@"); // sincerely hope there's not a place called this anywhere in the world
define ("NUMCOLS",2);           //set as number of columns-1
define ("DEFAULT_COLUMN_LENGTH", $numcems);
$numrows = tng_num_rows( $cemresult );
//$colsize =  ($numrows > 300) ? (int)ceil($numrows/4) : DEFAULT_COLUMN_LENGTH;
$colsize = DEFAULT_COLUMN_LENGTH;
$lastcountry = DUMMYPLACE;
$divctr = $linectr = $colctr = $i = 0;

echo "<div id=\"cemwrapper\">\n";
echo "<p>&nbsp;&nbsp;<a href=\"$browsemedia_url" . "mediatypeID=headstones\" class=\"snlink\">&raquo; {$text['showallhsr']}</a></p>\n";
echo "<div id=\"cemcontainer\">\n";
echo "<div id=\"col$colctr\">\n";

$cemetery = tng_fetch_assoc( $cemresult );
$orphan = false;
$hiding = false;
while( $i < $numrows ) {
	if( $cemetery['country'] == $lastcountry ) {
		if($cemetery['state'] == $laststate) {
			if($cemetery['county'] == $lastcounty ) {
				$lastcity = DUMMYPLACE;
				$cityctr = 0;
				while ( ( $i < $numrows ) && ( $cemetery['county'] == $lastcounty) && ( $cemetery['state'] == $laststate) && ( $cemetery['country'] == $lastcountry) ) { // display all cemeteries in the current county
					if($cemetery['city'] != $lastcity) {
						//end last city if $lastcity != dummy
						if($lastcity != DUMMYPLACE)
							echo "</div>\n";

						//start a new city
						$lastcity = $cemetery['city'];
						$divctr++;
						if(!$hiding) $linectr++;
						$divname = "city$divctr";
						if($cemetery['city'] || !$tngconfig['cemblanks']) {
			                	$txt = $cemetery['city'] ? @htmlspecialchars($cemetery['city'], ENT_QUOTES, $session_charset) : $text['nocity'];
							echo "<div class=\"pad3\"><img src=\"" . $cms['tngpath'] . "img/tng_expand.gif\" class=\"expandicon\" title='{$text['expand']}' id='plusminus$divname' onclick=\"return toggleCemSection('$divname');\" alt=\"\" />\n<a href=\"$headstones_url" . "country=" . urlencode($cemetery['country']) . "&amp;state=" . urlencode($cemetery['state']) . "&amp;county=" . urlencode($cemetery['county']). "&amp;city=" . urlencode($cemetery['city']) . "&amp;tree=$tree\">$txt</a></div>\n";
							echo "<div id=\"$divname\" class=\"cemblock\" style=\"display:none;\">\n";
						}
						else
							echo "<div id=\"$divname\">\n";
					}
					$txt = $cemetery['cemname'] ? $cemetery['cemname'] : $text['nocemname'];
					$txt= @htmlspecialchars($txt, ENT_QUOTES, $session_charset);
	   				echo "- <a href=\"$showmap_url" . "cemeteryID={$cemetery['cemeteryID']}&amp;tree=$tree\">$txt</a><br/>\n";
					$cemetery = tng_fetch_assoc( $cemresult );
					$i++;
				}
				if($lastcity != DUMMYPLACE)
					echo "</div>\n";
				echo "</div>\n";					// displayed all cemeteries in the county

			}
			else {							    // display the county
				//if($lastcounty != DUMMYPLACE)
					//echo "</div>\n";
				$divname = "county$divctr";
				$divctr++;
				$lastcounty = $cemetery['county'];
				if($cemetery['county'] || !$tngconfig['cemblanks']) {
					$linectr++;
                	$txt = $cemetery['county'] ? $cemetery['county'] : $text['nocounty'];
					echo "<div class=\"pad3\"><img src=\"" . $cms['tngpath'] . "img/tng_expand.gif\" class=\"expandicon\" title='{$text['expand']}' id='plusminus$divname' onclick=\"return toggleCemSection('$divname');\" alt=\"\" />\n<a href=\"$headstones_url" . "country=" . urlencode($cemetery['country']) . "&amp;state=" . urlencode($cemetery['state']) . "&amp;county=" . urlencode($cemetery['county']). "&amp;tree=$tree\">$txt</a></div>\n";
					echo "<div id=\"$divname\" class=\"cemblock\" style=\"display:none;\">\n";
					$hiding = true;
				}
				else {
					echo "<div id=\"$divname\">\n";
					$hiding = false;
				}
			}
		} else {								// display the State
			if ( ( $colctr < NUMCOLS ) && ( $linectr > $colsize ) && !$orphan ) {	// end of a column
				$linectr = 0;
				$colctr++;
				echo "</div>\n<div id=\"col$colctr\">\n<em>{$cemetery['country']} {$text['cont']}</em>\n";
			}
			$orphan = false;

			$laststate = $cemetery['state'];
			$lastcounty = DUMMYPLACE;
			$hiding = false;
			$txt = $cemetery['state'] ? $cemetery['state'] : $text['nostate'];
			if($cemetery['state'] || !$tngconfig['cemblanks']) {
				$linectr+=2;        //Add extra line to allow for the <br/> at the end
				echo "<br/><strong><a href=\"$headstones_url" . "country=" . urlencode($cemetery['country']) . "&amp;state=" . urlencode($cemetery['state']) . "&amp;tree=$tree\">$txt</a></strong><br/>\n";
			}
			else {
    			$linectr++;
				echo "<br/>\n";
			}
		}
		} else {									// display the Country
	  		if ( ( $colctr < NUMCOLS ) && ( $linectr > $colsize ) ) {	// end of a column
				$linectr = 0;
				$colctr++;
				echo "</div>\n<div id=\"col$colctr\">\n";
        	}
		$lastcountry = $cemetery['country'];
        	$laststate = DUMMYPLACE;
        	$lastcounty = DUMMYPLACE;
			$hiding = false;
		if ( $linectr ) echo "<br/>";
		$linectr++;     //Add extra line to allow for the <br/> at the end
        	$txt = $cemetery['country'] ? @htmlspecialchars($cemetery['country'], ENT_QUOTES, $session_charset) : $text['nocountry'];
		echo "<div class=\"databack cemcountry subhead rounded4\"><strong><a href=\"$headstones_url" . "country=" . urlencode($cemetery['country']) . "&amp;tree=$tree\">$txt</a></strong></div>\n";
		$orphan = true;
	}
}
tng_free_result( $cemresult );

if ( $numhs )
    echo "<br/><div class=\"databack cemcountry subhead rounded4\"><strong><a href=\"$headstones_url" . "&amp;tree=$tree\">{$text['nocemetery']}</a></strong></div>\n";

echo "</div>\n";    //colx
echo "</div>\n";    //container
echo "</div>\n<br clear=\"all\"/>";    //wrapper

tng_footer( "" );

?>
