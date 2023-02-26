<?php
$textpart = "connections";
include("tng_begin.php");
$ver = time(); # applied to avoid browser cache  - finally $ver='';
$flags['scripting'] = "<script src=\"js/panzoom.min.js\"></script>\n";
$flags['css'] = "<link href=\"{$cms['tngpath']}css/connections.css?$ver\" type=\"text/css\" rel=\"stylesheet\">\n";

include($subroot."pedconfig.php");
include($cms['tngpath']."pedbox.php" ); # to use photothumb

$flags['scripting'] .= "<style>\n.connectbox { background-color: {$pedigree['boxcolor']}; }\n</style>\n";
$relateform_url = getURL( "relateform", 1 );
$connect_url = getURL( "connections-form", 1 );

tng_header($text['pathscalc'],$flags);

include($cms['tngpath']."connections-lib.php");
include($cms['tngpath']."zoom-lib.php");

// ########### preparing the graph ###########
include("connections-graph.php");
//$numPeople = sizeof($graph);
//$parsemessage = "tree=$tree, numPeople = $numPeople, graf utworzony";
calcDigits($graph);
// ########### graph prepared ###########

// ############# GET data validation and cleaning #####################
if( isset($_GET['maxR']) && is_numeric($_GET['maxR']) )
	$maxR = $_SESSION['maxR'] = $_GET['maxR']; // number
else {
    echo "\n<br>Bad maxRuns parameter"; 
    return;
}
if( isset($_GET['maxL']) && is_numeric($_GET['maxL']) )
	$maxL = $_GET['maxL']; // number; change only via mod option
else {
    echo "\n<br>Bad maxLength parameter";
    return;
}
if( isset($_GET['compactBox']) && ctype_alpha($_GET['compactBox']) && in_array($_GET['compactBox'],['true','false']) )
    $compactBox = $_SESSION['compactBox'] = $_GET['compactBox']==="true"; // bool
else {
    echo "\n<br>Bad compactBox parameter";
    return;
}
if( isset($_GET['showTxt']) && ctype_alpha($_GET['showTxt']) && in_array($_GET['showTxt'],['true','false']) )
    $showTxt = $_SESSION['showTxt'] = $_GET['showTxt']==="true"; // bool
else {
    echo "\n<br>Bad showTxt parameter";
    return;
}
if( isset($_GET['sortpathsby']) && ctype_alpha($_GET['sortpathsby']) && in_array($_GET['sortpathsby'],['length','marriages','none']) )
    $sortpathsby= $_SESSION['sortpathsby'] = $_GET['sortpathsby']; // string
else {
    echo "\n<br>Bad sortpathsby parameter";
    return;
}
$maxM = ( isset($_GET['maxM']) && is_numeric($_GET['maxM']) ) ? $_GET['maxM'] : 9; // number; change only via mod option
$_SESSION['maxM'] = $maxM;
$minheight = $compactBox ? "" : " style='min-height:65px'";

if (!empty($secondpersonID)) {
    if ($error = checkedID($secondpersonID)) {  // assign after check
        errorMessage($error,'badID2');
        return;  // return from connections.php
    }
    else {
    	$relatepersonID = $_SESSION['relatepersonID'] = $secondpersonID;
	    $relatetreeID = $_SESSION['relatetreeID'] = $tree;
    }
}
else
    $secondpersonID = $savedpersonID;

$secondpersonID = strtoupper($secondpersonID);

if (!empty($altprimarypersonID))
    $primarypersonID = $altprimarypersonID;
if ($error = checkedID($primarypersonID)) {
    errorMessage($error,'badID1');
    return;   // return from connections.php !
}
$primaryID = $primarypersonID;
$righttree = checktree($tree);

$result1 = getPersonDataPlusDates($tree,$primarypersonID);
if (tng_num_rows($result1)) {
    $row1 = tng_fetch_assoc($result1);
    $rightbranch = checkbranch($row1['branch']);
    $rights1 = determineLivingPrivateRights($row1,$righttree,$rightbranch);
    $row1['allow_living'] = $rights1['living'];
    $row['allow_living'] = $rights1['living']; ### ! needed to dignature display
    $row1['allow_private'] = $rights1['private'];
    $namestr1 = getName($row1); # constructs fullname according to rights, nameorder, capitalics, etc.
    $logname1 = shortname($row1);
    $gender1 = $row1['sex'];
    $dates1 = $rights1['both'] ? getYears($row1) : "<i>(".$text['living'].")</i>";
    $dates1p  = $rights1['both'] ? "(".getYears($row1).")" : "(".$text['living'].")";
    $treeResult = getTreeSimple($tree);
    $treerow = tng_fetch_assoc($treeResult);
    $disallowgedcreate = $treerow['disallowgedcreate'];
    tng_free_result($treeResult);
}
else
    $error = $primarypersonID;

tng_free_result($result1);

$result2 = getPersonSimple($tree, $secondpersonID);
if( tng_num_rows($result2) ) {
    $row2 = tng_fetch_assoc($result2);
    $rights2 = determineLivingPrivateRights($row2, $righttree);
    $row2['allow_living'] = $rights2['living'];
    $row2['allow_private'] = $rights2['private'];
    $namestr2 = getName($row2);
    $logname2 = shortname($row2);
//    $gender2 = $row2['sex'];
//    $dates2 = $rights2['both'] ? "&nbsp;(".lifeYears($row2).")" : "";
//    $dates2 .= "&nbsp; ID=$secondpersonID";
//    $tooltip2 = $namestr1.$dates2; # text for title attribute
}
else
    $error = $secondpersonID;

tng_free_result($result2);

if ($error) {
    errorMessage($error,'notintree');
    return;
}

# check if both persons are in the tree graph
if (!isset($graph)) die("graph not visible");
if (!array_key_exists($primarypersonID,$graph)) {
    echo "\n<br>Person1 ID $primarypersonID does not match any person in the tree $tree.
        Please return and choose another one.";
    echo " <br> graph look: "; print_r($graph[$primarypersonID]);
    return;
}
if (!array_key_exists($secondpersonID,$graph)) {
    echo "\n<br>Person2 ID $secondpersonID does not match any person in the tree $tree.
        Please return and choose another one.";
    echo " <br> graph look: "; print_r($graph[$secondpersonID]);
    return;
}
// ################ GET data validated ###################

$getperson_url = getURL("getperson", 1);
$connectionsform_url = getURL( "connections-form", 1 );
$connections_url = getURL( "connections", 1 );

$logstr = "<a href=\"$connections_url"."altprimarypersonID=$primaryID&amp;secondpersonID=$secondpersonID";
$logstr .= "&amp;tree=$tree&amp;maxR=$maxR&amp;maxL=$maxL&amp;sortpathsby=$sortpathsby";
$logstr .= "&amp;showTxt=".var_export($showTxt,true)."&amp;compactBox=".var_export($compactBox,true)."\">";
$logstr .= "{$text['pathscalc']}: $logname1 ($primarypersonID) =&gt;$logname2 ($secondpersonID)</a>";
writelog($logstr);
preparebookmark($logstr);

// ############ preparing innermenu ######################
$photostr = showSmallPhoto( $primarypersonID, $namestr1, $rights1['both'], 0, false, $row1['sex'] );
echo tng_DrawHeading( $photostr, $namestr1, getYears($row1) );

$innermenu = $text['maxrshort'] . ": &nbsp;";
$innermenu .= "<input type='number' id='maxR' name='maxR' style='width:9ch; font-size:90%' ";
$innermenu .= "value='$maxR'/>&nbsp;&nbsp;&nbsp;\n";

$innermenu .= "{$text['compactBoxshort']}: &nbsp;"; # Show thumbnails
$innermenu .= "<select name='compactBox' class='verysmall'/>\n";
$innermenu .= "<option value=true ";
if ($compactBox) $innermenu .= " selected='selected' ";
$innermenu .= ">{$admtext['yes']}</option>\n";
$innermenu .= "<option value=false ";
if (!$compactBox) $innermenu .= " selected='selected'";
$innermenu .= ">{$admtext['no']}</option>\n";
$innermenu .= "</select>&nbsp;&nbsp;&nbsp;\n";

$innermenu .= "{$text['showTxtshort']}: &nbsp;"; # Show text path
$innermenu .= "<select name='showTxt' class='verysmall'/>\n";
$innermenu .= "<option value=true ";
if ($showTxt) $innermenu .= " selected='selected' ";
$innermenu .= ">{$admtext['yes']}</option>\n";
$innermenu .= "<option value=false ";
if (!$showTxt) $innermenu .= " selected='selected'";
$innermenu .= ">{$admtext['no']}</option>\n";
$innermenu .= "</select>&nbsp;&nbsp;&nbsp;\n";

$innermenu .= "{$text['sortbyshort']}: &nbsp;";
$innermenu .= "<select name='sortpathsby' class='verysmall'/>\n";
$innermenu .= "<option value='length' ";
if ($sortpathsby==='length') $innermenu .= " selected='selected' ";
$innermenu .= ">{$text['bylength']}</option>\n";
$innermenu .= "<option value='marriages' ";
if ($sortpathsby==='marriages') $innermenu .= " selected='selected'";
$innermenu .= ">{$text['bymarriages']}</option>\n";
$innermenu .= "<option value='none' ";
if ($sortpathsby==='none') $innermenu .= " selected='selected'";
$innermenu .= ">{$text['none']}</option>\n";
$innermenu .= "</select>&nbsp;&nbsp;&nbsp;\n";

$innermenu .= $text['maxm'] . ": &nbsp;";
$innermenu .= "<input type='number' id='maxM' name='maxM' style='width:8ch; font-size:90%' ";
$innermenu .= "value='$maxM'/>&nbsp;&nbsp;&nbsp;\n";

$innermenu .= "<a href='#' class='lightlink' onclick='document.form1.submit();'>{$text['refresh']}</a>";

echo getFORM( "connections2", "get", "form1", "form1");
echo tng_menu( "I", "relate", $primarypersonID, $innermenu );
echo "<input type=\"hidden\" name=\"maxL\" value=\"$maxL\" />\n";
echo "<input type=\"hidden\" name=\"primarypersonID\" value=\"$primarypersonID\" />\n";
echo "<input type=\"hidden\" name=\"savedpersonID\" value=\"$secondpersonID\" />\n";
echo "<input type=\"hidden\" name=\"tree\" value=\"$tree\" />\n";
echo "</form>\n";

if ($error) {
    errorMessage($error,'notvalid');
    return;
}
elseif ($primarypersonID===$secondpersonID) {
    errorMessage($error,'sameperson');
    return;
}

// ############### title and legend #################
echo "<div id='searching'><img src='img/spinner.gif' alt='' /> {$text['searching']} </div>";
// title for results
echo "<span class='subhead'><strong>{$text['connectionsto']} $namestr2</strong></span>";

$pri_icon = "<span style='color:darkblue;'>&#9658;</span>&nbsp;"; #9733 big star, #9679 circle, #9658 right pointer
$fin_icon = "&thinsp;<span style='color:darkblue;'>&#9668;</span>"; #9668 left pointer

// legend for bullets
$legend = ['pri' => 'primary', 'fin'=>'secondary'];
$bul=[]; 
foreach($legend as $w=>$t)
    $bul[$w]=$text[$t];
$bi = preg_replace('/&[^;]+;/','x',implode($bul)); // replace UTF entities with single chars
$bi = preg_replace('/<[^>]+>/','',$bi);   // remove html tags
if (!$tngprint && $bi && strlen($bi)<200) {   // bullet strings not empty, and not too long
    echo "<br/><br/>{$text['scrollnote']} &nbsp; ";
    foreach ($legend as $b=>$l) {
        if($b) {  //to skip if empty
            $trimBL = str_replace(["&nbsp;","&thinsp;"],"",[${$b . "_icon"},$text[$l]]);
            echo "$trimBL[0] = $trimBL[1] &nbsp; ";
        }
    }
    echo " &nbsp; | &nbsp; <a href=\"{$connect_url}primaryID={$primaryID}&tree={$tree}\">{$text['anotherpath']}</a> &nbsp; | &nbsp; <a href=\"{$relateform_url}primaryID={$primaryID}&tree={$tree}\">{$text['simplerel']}</a></p><br/>\n";
}

// ################# finding connection paths #############################
include ("connections-YenBFS.php");

$fromNode = $primarypersonID;
$toNode = $secondpersonID;
$zoomcode = "";

$relTable['M'] = ['p'=>'hfather','c'=>'hson','s'=>'hhusband'];
$relTable['F'] = ['p'=>'hmother', 'c'=>'hdaughter', 's'=>'hwife'];
$bullTable = ['@'=>'pri','p'=>'par','c'=>'chi','s'=>'spo'];

$kShortestPaths = []; # found paths will be saved here

$longestSoFar=0;
$relevant=0;
$skipMarriages=0;
echo "\n<ul id='pathlist' class='pathlist'>"; # finally will be sorted by jquery

// ############ 2 lines below are replaced up to line 300, then added 306-308.
// for ($k=1;$k<=$maxR;$k++) {   // attempt $maxR times to find next path
//   if (!YensNextPath($graph,$fromNode,$toNode,$kShortestPaths,$maxL)) break; # no more paths
$commonAnc='true'; // ################ originally the mod parameter
$skipCommonAnc = $commonAnc == 'true' ? 0 : 3; // 0:findCommon 1:not found 2:found 3:cleaned

#//main loop
$k=-1; # to start loop with 0
while ($k<=$maxR) { // start with 0 for commonAnc and then attempt $maxR times to find next paths
    $k++; // start with 0
//    if ($k==1): $kShortestPaths = []; $relStrings = []; endif; # clean temporary data from common

//    if (microtime(true)-$_SERVER["REQUEST_TIME_FLOAT"] > $maxTime):
//        $maxTimeExceeded = true;
//        break;
//    endif;

    if ($skipCommonAnc==0) { // now is preliminary run
        $skipCommonAnc=1;
        // search if they are related
        $result = findCommonAncestor ($graph, $fromNode,$toNode, ceil($maxL/2));
        if (is_int($result)) { // no common ancestor
            echo preg_replace( "/xxx/", ceil($maxL/2), $text['notrelated'] );
            continue; // run normal search
        }
        elseif (is_string($result)) { // found!
            $skipCommonAnc=2; # 2 means that it was found
            $pathToCommon = constructPath ($fromNode,$toNode, $result);
            $kShortestPaths[$k] = $pathToCommon; // temporarily - it will be removed to not disturb regular nextPath
            echo "{$text['arerelated']}";
        }
    }
    // regular search, not CommonAnc:
    else {
        if ($k==0) $k=1; // start from 1 independent of possible common ancestor search
        if (!YensNextPath($k,$graph,$fromNode,$toNode,$kShortestPaths,$maxL)) {
            break;
        } // no more paths
    }

    $relStr = constructRelString($kShortestPaths[$k],$graph);
    $relStrings[$k] = $relStr;
    $len = strlen($relStr);
    $longestSoFar = max($longestSoFar,$len); // what about possible commonAnc path ?
    if ($skipCommonAnc==2) { // successful commonAnc; thus skip the path if found again in a regular search
        if ($k>0 && $kShortestPaths[$k]==$pathToCommon) {
            continue;
        }
    }
	if (skipPath($k,$relStrings,$kShortestPaths,$graph)) continue;   // go search for the next $k
    if (substr_count($relStr,'s') > $maxM) {
        ++$skipMarriages;
        continue;   // skip path if maxMarriages exceeded (note: does not apply to shortest path!)
    }
  ++$relevant;
  
// preparing path message
	$pathfound = "<span style='font-weight:bold'>{$text['xpath']}{$relevant}:</span> &nbsp;";
	//$pathfound .= str_replace("xxx", $k, $text['xrun']);
	$len=strlen($relStrings[$k]); $mar=substr_count($relStrings[$k],'s');
	$pathfound .= "<span style='color:#999'> {$len} " . ($len == 1 ? $text['xstep'] : $text['xsteps']) . " ";
	$pathfound .= "(" . (($mar===1) ? $text['xmarriage'] : str_replace("xxx", $mar, $text['xmarriages'])) .")";
    $pathfound .= "</span>";
    echo "<li data-len='{$len}' data-mar='{$mar}'>"; # li containing both text and graphics, data needed for sorting
	echo "<p class='normal' style='font-size: 12pt;'>$pathfound</p>";
//	echo "rel.string = $relStrings[$k]";

// preparing parallel lists of thumbs /gender icons /shortnames /fullnames (init with primaryperson data)
    $pathPicts=[]; # list of thumbs - for 2d plot
    $photoPath = getPhotoSrc($primarypersonID,$rights1['both'],$gender1)['ref']; # 'ref' - reference, 'link' - url to thumb
    $pathPicts[] = $compactBox ? "" :
        ($photoPath ? "<img class='thumb' src='$photoPath' alt='thumb'/>" : "<img class='nothumb' src='{$cms['tngpath']}img/spacer.gif'/>");
    $pathNamesShort=[]; # list of shortnames (shorten if option)
//    $dates1 = $rights1['both'] ? lifeYears($row1) : "";
    $pathName1 = $compactBox ? $logname1 : truncateIt($namestr1,60) . "<br/><span class='smallest'>$dates1</span>";
    $pathNamesShort[] = "<a href=\"{$getperson_url}personID=$fromNode&amp;tree=$tree\">$pathName1</a>"; # start person
    $pathNamesFull=[]; # list of fullnames
    $pathNamesFull[] = "<a href=\"{$getperson_url}personID=$fromNode&amp;tree=$tree\">$namestr1</a>"; # start person
    $pathTooltips = []; # full names plus dates to show in tooltip
    $tooltip1 = "$namestr1 $dates1p ID=$fromNode"; # text for title attribute
    $pathTooltips[] = "|".$tooltip1;
// preparing other persons' data
    if ($showTxt) {
        echo "<p class='pathnames'>$pathNamesFull[0]";
        $prevSex = $gender1; # set initially from form data (line ~110)
    }
    for ($ord=0;$ord<$len;$ord++) {
//        $prevID = $kShortestPaths[$k][$ord];
        $persIDx = $kShortestPaths[$k][$ord+1];
// read person data from database - if allowed
        $resultX = getPersonDataPlusDates($tree,$persIDx);
        if(tng_num_rows($resultX)) {
            $rowX = tng_fetch_assoc($resultX);
            $rightsX = determineLivingPrivateRights($rowX,$righttree);
            $rowX['allow_living'] = $rightsX['living'];
            $rowX['allow_private'] = $rightsX['private'];
            $namestrX = getName($rowX);
            $lognameX = shortname($rowX);
            $genderX = $rowX['sex'];
            $datesX = $rightsX['both'] ? getYears($rowX) : "<i>(".$text['living'].")</i>";
            $datesXp = $rightsX['both'] ? "(".getYears($rowX).")" : "(".$text['living'].")";
            $tooltipX = "$namestrX $datesXp ID=$persIDx";   // text for title attribute
        }
        else {
            $error = $persIDx; 
            die($error);
        }
        tng_free_result($resultX);

        $photoPath=getPhotoSrc($persIDx,$rightsX['both'],$genderX)['ref'];
        $pathPicts[] = $compactBox ? "" :
            ($photoPath ? "<img class='thumb' src='$photoPath' alt='thumb'/>" : "<img class='nothumb' src='{$cms['tngpath']}img/spacer.gif'/>");
        $fin = ($persIDx===$secondpersonID) ? $fin_icon : "";
        $pathNameX = $compactBox ? $lognameX : truncateIt($namestrX,60).$fin."<br/><span class='smallest'>$datesX</span>";
        $pathNamesShort[] = "<a href=\"$getperson_url"."personID=$persIDx&amp;tree=$tree\">$pathNameX</a>";
        $pathNamesFull[] = "<a href=\"$getperson_url"."personID=$persIDx&amp;tree=$tree\">$namestrX</a>";
        $pathTooltips[] = "|".$tooltipX; # to be added to cell content and then use | to cut and paste as tooltip
        if ($showTxt) {
            switch($prevSex) {
                case "M":
                    $hisHer = "m";
                    break;
                case "F":
                    $hisHer = "f";
                    break;
                default:
                    $hisHer = "";
                    break;
            }
            $rel = $relStr[$ord];
            $key = $hisHer . $relTable[$genderX][$rel];
            $relation = $text[$key];
            echo " -><i>$relation</i> ";   // eg. his mother
            echo "{$pathNamesFull[$ord+1]}";
            $prevSex = $genderX;
        }
    }
    if ($showTxt) echo "</p>";

// preparing 2d diagram
	// table translating relationships to xy change in 2d diagram
	$pcs2move=['p'=>['x'=>0,'y'=>-1],'c'=>['x'=>0,'y'=>1],'s'=>['x'=>1,'y'=>0]]; # could be set before loop
	//echo "\n<br>$relStr";
	$xMax = substr_count($relStr,'s')+substr_count($relStr,'pc')+1;
	$y = $yMax = $yMin = 0;
	for ($i=0;$i<$len;$i++) {  // calc y range
		if ($relStr[$i]==='p') $yMin = min(--$y,$yMin);
		if ($relStr[$i]==='c') $yMax = max(++$y,$yMax);
	}
	$yMax = $yMax-$yMin+1; # counting y from 0 finally
	$XY = array_fill(0,$xMax,array_fill(0,$yMax,' ')); # init array with spaces
    $connXY = array_fill(0,$xMax,array_fill(0,$yMax,false)); // init connectors' array
	$x=0; $y=-$yMin; #start position
	$XY[$x][$y] = $pathPicts[0]."<div class='ptext'>"."#@".$pathNamesShort[0].$pathTooltips[0]."</div>"; // first person
	for ($i=0;$i<$len;$i++) {  // fill the #XY array
		$x+=$pcs2move[$relStr[$i]]['x'];
		$y+=$pcs2move[$relStr[$i]]['y'];
		    // determine connector type (placed always BELOW the box)
        if ($relStr[$i] === 'p' && ($i == $len-1 || $relStr[$i+1] !== 'c'))
            $connXY[$x][$y] = true;
        elseif ($relStr[$i] === 'c' && ($i == 0 || $relStr[$i-1] !== 'p'))
            $connXY[$x][$y-1] = true;
		if (substr($relStr,$i,2) === "pc") {
            $XY[$x][$y] = 'merge';
            $x++;
        }
		$fin = ($compactBox && $i===$len-1) ? $fin_icon : "";
		$XY[$x][$y]="#".$relStr[$i].$pathPicts[$i+1]."<div class='ptext'>".$pathNamesShort[$i+1].$fin.$pathTooltips[$i+1]."</div>";
	}
	$XYtr = array_map(null, ...$XY); // transposing array - what a clever ... method!

	# push php array to html
	$colspan2 = false;
    $nodownline = true;
	$out = "<table class='paths'>";
	foreach ($XYtr as $y=>$tablerow) { 
		$out .= "<tr>";
		if($xMax>1) {
			foreach($tablerow as $x=>$cell) {
                $celltext = strip_tags($cell);
                //echo "<pre>$celltext</pre>\n";
				if ($cell==='merge') {
                    $colspan2=true; 
                    continue;
                }
				elseif ($cell===' ')
                    $out .= "<td>&nbsp;</td>"."<td/>";
				else {
					if ($colspan2){ // previous cell was 'merge'
                        $cell = str_replace("#p",'',$cell);
                        $c = explode("|",$cell);
						$out .= "<td/>"."<td class='colspan' colspan=3><div class='spantxt connectbox'{$minheight}>";
					    $out .= "$c[0]</div>";
					    $out .= "<div class='slashes'>/ \\</div></td>\n";
						$colspan2 = false;
                    }
					else { // normal case
//////                        $delayed_out = "";
                        if($celltext[1] === 's') {
                            $out .= "<td class='spouse'>=</td>";
                        }
                        else {
                            $out .= "<td>&nbsp;</td>";
//////                            if($celltext[1] === 'p')
//////                                $delayed_out = "<div class='upline'>|</div>";
//////                            elseif($celltext[1] === 'c') {
//////                                if($nodownline)
//////                                    $nodownline = false;
//////                                else
//////                                    $delayed_out = "<div class='downline'>|</div>";
//////                            }
                        }
                        foreach ($bullTable as $b=>$t) {
                            if($celltext[1] === "@")
                                $cell = str_replace("#@",$pri_icon,$cell);
     					    elseif($celltext[1]===$b)
                                $cell = str_replace("#$b","",$cell);
                        }
                        $c = explode("|",$cell);
////// 3 lines below are changed
                        $out .= "<td class='pers connectbox'{$minheight}>$c[0]";
                        if ($connXY[$x][$y]) $out .= "<div class='upline'>|</div>";
                        $out .= "</td>\n";
					}
				}
			}
        }
		else { // pure direct path - 1-dim array
            $tablerowtext = strip_tags($tablerow);
            foreach ($bullTable as $b=>$t) {
                if($tablerowtext[1] === "@")
                     $tablerow = str_replace("#@",$pri_icon,$tablerow);
                elseif($tablerowtext[1]===$b) 
                    $tablerow = str_replace("#$b",'',$tablerow);
            }
            $c = explode("|",$tablerow);
            if($nodownline) {
                $delayed_out = "";
                $nodownline = false;
            }
            else
                $delayed_out = "<div class='downline'>|</div>";
			$out .= "<td class='pers connectbox'{$minheight}>$c[0]{$delayed_out}</td>\n";
		}
		$out .= "<td>&nbsp;</td></tr>";
	}
	$out .= "</table>";

    echo includeZoomIcons($relevant);
    echo "\n<div class='outer'>\n";
    echo "<div class=\"panzoom\" id=\"vcontainer{$relevant}\"><div class ='inner'>\n";
	echo $out;
    echo "</div></div></div>";
    $zoomcode .= includeZoomScript($relevant);
// end of displaying 2d
    echo ($maxR>1) ? "<hr class=\"mtitlehr\"><br />" : "<br />"; # if =1 only shortest searched, no further
    echo "</li>"; # li containing both text and graphics for each $k (to be jquery-sortable)
}   // end of main loop for $maxR runs
echo "</ul>";

// ########## summary message ###############
if($k===1) {   // no paths found
    $nopaths = $text['nopaths'];
    echo "<span style='font-size:larger'>$nopaths</span>\n";
}
else {
    if ($maxR>1) {  // if =1 only shortest was searched, no summary needed
        # summary mesaage
        $newstr1 = str_replace("xxx", $maxL, $text['nopaths1']);
        $newstr2 = str_replace("xxx", $k-1, $text['nopaths2']);
        echo "<p>$newstr1 $newstr2<br/>";   // No more paths shorter than $maxL found in $k runs
        $newstr = str_replace("xxx", $longestSoFar, $text['longestpath']);
        echo "$newstr<br/>\n";   // (the longest path checked was $longestSoFar)
        $newstr = str_replace("xxx", $relevant, $text['relevantpaths']);
        echo "<br/>$newstr"; # Found $relevant relevant paths
        if ($skipMarriages>0) {
            $newstr = str_replace("xxx", $skipMarriages, $text['skipMarr']);
            echo "<br/>$newstr\n";   // ...found but not displayed...
        }
        echo "</p>";
    }
    $targetID = $primarypersonID;
    $otherID = $secondpersonID;
    swapPeople();
}
echo "<br/>";
// #################################
?>

<script type="text/javascript">
//<![CDATA[

if(typeof zoomstep == 'undefined')
    zoomstep = 0.2;

<!-- make the whole box clickable -->
$('.pers, .spantxt').click(function() {
    var url = $('a',this).attr('href');
    window.open(url,'_self');
});

<!-- sort path list by either length or number of marriages -->
$(document).ready(function(){
    let doSort = function (sortby) {
        let $pathList = $('#pathlist');
        let $paths = $('#pathlist li');
        let sortList = Array.prototype.sort.bind($paths); //
        sortList(function (a, b) {
            let sort1 = (sortby==='length') ? 'len' : 'mar';
            let sort2 = (sortby==='marriages') ? 'mar' : 'len';
            if (Number($(a).data(sort1)) < Number($(b).data(sort1))) { return -1; }
            if (Number($(a).data(sort1)) > Number($(b).data(sort1))) { return 1; }
            return Number($(a).data(sort2)) - Number($(b).data(sort2));
        });
        $pathList.append($paths);
    };
<?php if ($sortpathsby!=='none') echo "doSort('".$sortpathsby."');" ; ?>
<?php echo $zoomcode; ?>
});

<!-- hide Spinner (started when connections search starts) -->
jQuery(document).ready(function(){jQuery('#searching').hide();});

//]]>
</script>

<?php
tng_footer($flags);
?>
