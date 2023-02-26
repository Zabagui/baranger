<?php
$textpart = "connections";
include("tng_begin.php");

include($subroot . "pedconfig.php");

$ver = time(); # applied to avoid browser cache  - finally $ver='';
$flags['scripting'] = "<script type=\"text/javascript\" src=\"{$cms['tngpath']}js/selectutils.js\"></script>\n";
$flags['css'] = "<link href=\"{$cms['tngpath']}css/connections.css?$ver\" type=\"text/css\" rel=\"stylesheet\">\n";

tng_header( $text['connections'], $flags );

include("connections-lib.php");

# mod option values (being changed by the mod)
$maxRopt = isset($pedigree['maxropt']) ? $pedigree['maxropt'] : 99;
$maxLopt = isset($pedigree['maxlopt']) ? $pedigree['maxlopt'] : 30;
$showTxtopt = isset($pedigree['showtxtopt']) ? $pedigree['showtxtopt'] : false;
$compactBoxopt = isset($pedigree['compactboxopt']) ? $pedigree['compactboxopt'] : false;
$sortByopt = isset($pedigree['sortbyopt']) ? $pedigree['sortbyopt'] : 'length';
$anchorIDopt = !empty($pedigree['archoridopt']) ? $pedigree['anchoridopt'] : 'empty';
$maxMopt = isset($pedigree['maxmopt']) ? $pedigree['maxmopt'] : 9;

$relateform_url = getURL( "relateform", 1 );
$result = getPersonDataPlusDates($tree,$primaryID);
$row = tng_fetch_assoc( $result );
if( $row ) {
    $righttree = checktree($tree);
    $rightbranch = checkbranch($row['branch']);
    $rights = determineLivingPrivateRights($row, $righttree, $rightbranch);
    $row['allow_living'] = $rights['living'];
    $row['allow_private'] = $rights['private'];
    if( $rights['both'] ) {
        $birthdate = "";
        if ( $row['birthdate'] ) {
            $birthdate = "{$text['birthabbr']} " . displayDate($row['birthdate']);
        }
        else if ( $row['altbirthdate'] ) {
            $birthdate = "{$text['chrabbr']} " . displayDate($row['altbirthdate']);
        }
        if($birthdate) $birthdate = "($birthdate)";
        $namestrplus =  " $birthdate - $primaryID";
    }
    else
        $namestrplus =  " - $primaryID";
    $namestr = getName( $row );

    $treeResult = getTreeSimple($tree);
    $treerow = tng_fetch_assoc($treeResult);
    $disallowgedcreate = $treerow['disallowgedcreate'];
    tng_free_result($treeResult);
    
    tng_free_result($result);
} 
else {
    $namestr = "";
    $rights['both'] = false;
    $row = array(
        "sex" => "",
        "allow_living" => false,
        "allow_private" => false
    );
    $namestrplus = "";
    $namestr2 = "";
}

$personID = preg_replace("/[^A-Za-z0-9_\-. ]/", '', $primaryID);
$photostr = showSmallPhoto ($primaryID,$namestr,$rights['both'],0,false,$row['sex']);
echo tng_DrawHeading ($photostr,$namestr,getYears($row));

$namestr .= $namestrplus;

$innermenu = "&nbsp; \n";

echo tng_menu( "I", "relate", $primaryID, $innermenu );

echo "<span class='normal' id='bkpos'></span><br/>";

if (!empty($_SESSION['relatepersonID'])) {
    $relatepersonID = $_SESSION['relatepersonID'];
    $relatetreeID = $_SESSION['relatetreeID']; # ===$tree ?
}
elseif ($anchorIDopt !== 'empty' && $anchorIDopt!=='') {
    $relatepersonID = $anchorIDopt;
    $relatetreeID = $tree;
}
elseif (!empty($_SESSION['mypersonID']) && $_SESSION['mygedcom']===$tree && $_SESSION['mypersonID']!==$primaryID) {
    $relatepersonID = $_SESSION['mypersonID'];
    $relatetreeID = $tree;
}
else {
    $relatepersonID = $relatetreeID = "";
}

$maxR = isset($_SESSION['maxR']) ? $_SESSION['maxR'] : $maxRopt; // PHP>5.6 maxR = $_SESSION['maxR'] ?? $maxRopt;
$maxM = isset($_SESSION['maxM']) ? $_SESSION['maxM'] : $maxMopt; // PHP>5.6 maxR = $_SESSION['maxR'] ?? $maxRopt;
//$maxL = isset($_SESSION['maxL']) ? $_SESSION['maxL'] : $maxLopt;
$showTxt = isset($_SESSION['showTxt']) ? $_SESSION['showTxt'] : $showTxtopt;
$compactBox = isset($_SESSION['compactBox']) ? $_SESSION['compactBox'] : $compactBoxopt;
//$showGend = isset($_SESSION['showGend']) ? $_SESSION['showGend'] : $showGendopt;
$sortpathsby = isset($_SESSION['sortpathsby']) ? $_SESSION['sortpathsby'] : $sortByopt;
//$loggedOnly = isset($_SESSION['loggedOnly']) ? $_SESSION['loggedOnly'] : $loggedOnlyopt;

$namestr2 = "";
if (!empty($relatepersonID) && $relatetreeID===$tree) {
   $result2 = getPersonDataPlusDates($tree, $relatepersonID);
    if( $result2 ) {
        $row2 = tng_fetch_assoc( $result2 );
        $rights2 = determineLivingPrivateRights($row2, $righttree);
        $row2['allow_living'] = $rights2['living'];
        $row2['allow_private'] = $rights2['private'];
        if( $rights2['both'] ) {
            $birthdate = "";
            if ( $row2['birthdate'] ) {
                $birthdate = "{$text['birthabbr']} " . displayDate($row2['birthdate']);
            }
            else if ( $row2['altbirthdate'] ) {
                $birthdate = "{$text['chrabbr']} " . displayDate($row2['altbirthdate']);
            }
            if($birthdate) $birthdate = "($birthdate)";
            $namestrplus =  " $birthdate - $relatepersonID";
        }
        else
            $namestrplus =  " - $relatepersonID";
        $namestr2 = getName( $row2 ) . $namestrplus;
        tng_free_result($result2);
    }
}

$setmedisabled = ( !empty($_SESSION['mypersonID']) && $_SESSION['mygedcom']===$tree
    && (empty($relatepersonID) || $relatepersonID!==$_SESSION['mypersonID']) ) ? '' : 'disabled';

# preparing bookmarks to use in the form
$bkmlist = "<i>{$text['bkminfo']}</i><ul class='normal'>";
$bcount=0; # to adjust box height if no usable bookmarks
# 1. cookie bookmarks
$rootstr = str_replace(["/"," ","."],"",$rootpath);
$cookiesref = "tngbookmarks_$rootstr";
if (isset($_COOKIE[$cookiesref])) {
    $cookiebookmarks = explode("|", $_COOKIE[$cookiesref]);
    foreach( $cookiebookmarks as $bookmark ) {
        if (strpos($bookmark,"getperson")!==false) {
            $bkclean = strip_tags(str_replace($text['indinfofor'],"",$bookmark));
            $bkID = rtrim(array_slice(explode("(",$bkclean),-1)[0],")");
            if ($bkID!==$primaryID && (empty($relatepersonID) || $bkID!==$relatepersonID)) {
                $bkmlist.= "<li data-bkm='$bkID' class='bkmli'>$bkclean</li>";
                $bcount++;
            }
        }
    }
}
if ($bcount>0)
    $bkmlist .= "</ul>";
else
    $bkmlist = $text['nobookmarks'];

echo getFORM( "connections", "get", "form1", "form1" ); # form header for calling connections.php
?>
<p class="subhead"><strong><?php echo $text['mnuadvancedsearch'] . ": " . $text['findrel2']; ?></strong></p><br/>
<div style="float:left; padding-right: 15px; padding-bottom: 15px">
	<table>
		<tr>
            <td><strong><?php echo $text['person1']; ?> </strong></td>
            <td><div id="name1"><?php echo $namestr; ?></div></td>
		</tr>
		<tr>
            <td><?php echo $text['changeto']; ?></td>
            <td>
                <input type="text" name="altprimarypersonID" id="altprimarypersonID" size="10" />  <input type="button" name="find1" value="<?php echo $text['find']; ?>" onclick="findItem('I','altprimarypersonID','name1','<?php echo $tree; ?>');" />
            </td>
		</tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
            <td><strong><?php echo $text['person2']; ?> </strong></td>
			<td><div id="name2"><?php echo $namestr2; ?></div>
				<input type="hidden" name="savedpersonID" value="<?php echo $relatepersonID; ?>" />
			</td>
		</tr>
		<tr>
            <td><?php echo $text['changeto']; ?></td>
				<td>
                <input type="text" name="secondpersonID" id="secondpersonID" size="10" />  
                <input type="button" name="find2" value="<?php echo $text['find']; ?>" onclick="findItem('I','secondpersonID','name2','<?php echo $tree; ?>');" />
                <nobr>
                    <input type='button' id='setMe' value="<?php echo $text['makeme2nd']?>" <?=$setmedisabled?> />
                    <input type='button' id='getBkm' value="<?php echo $text['usebookmarks']?>" <?=$bcount==0?'disabled':''?> />
                </nobr>
				</td>
		</tr>
	</table>
</div>

<div>
	<table>
		<tr>
			<td><?php echo $text['maxruns']; ?>:</td>
			<td>
				<input type="number" id="maxR" name="maxR" min="1" max="999"
					value="<?=isset($_SESSION['maxR'])?$_SESSION['maxR']:$maxRopt?>" />
			</td>
		</tr>
		<tr>
			<td><?php echo $text['showTxt']; ?>:&nbsp;</td>
			<td>
				<select name="showTxt" id="showTxt">
					<?php
                        echo "<option value=true";
                        if ($showTxt) echo " selected='selected'";
                        echo ">{$admtext['yes']}</option>\n";
                        echo "<option value=false";
                        if (!$showTxt) echo " selected='selected'";
                        echo ">{$admtext['no']}</option>\n";
					?>
				</select>
			</td>
		</tr>
        <tr>
            <td><?php echo $text['compactBox']; ?>:&nbsp;</td>
            <td>
                <select name="compactBox" id="compactBox">
                    <?php
                    echo "<option value=true";
                    if ($compactBox) echo " selected='selected'";
                    echo ">{$admtext['yes']}</option>\n";
                    echo "<option value=false";
                    if (!$compactBox) echo " selected='selected'";
                    echo ">{$admtext['no']}</option>\n";
                    ?>
                </select>
            </td>
        </tr>
		<tr> <!-- how to make the text aligned middle ? -->
            <td><?php echo $text['sortpathsby']; ?>:&nbsp;</td>
            <td>
                <select name="sortpathsby" id="sortpathsby">
                    <?php
                    echo "<option value='length'";
                    if ($sortpathsby==='length') echo " selected='selected'";
                    echo ">{$text['bylength']}</option>\n";
                    echo "<option value='marriages'";
                    if ($sortpathsby==='marriages') echo " selected='selected'";
                    echo ">{$text['bymarriages']}</option>\n";
                    echo "<option value='none'";
                    if ($sortpathsby==='none') echo " selected='selected'";
                    echo ">{$text['none']}</option>\n";
                    ?>
                </select>
            </td>
		</tr>
        <tr>
            <td><?php echo $text['maxmopt']; ?>:</td>
            <td>
                <input type="number" id="maxM" name="maxM" min="0" max="99"
                    value="<?=isset($_SESSION['maxM'])?$_SESSION['maxM']:$maxMopt?>" />
            </td>
        </tr>
	</table>
</div>

<div id='curtain' class='curtain'>
    <div id='box' class='box titlebox'>
        <div class='box-header bar'>
            <?=$text['bkmtitle']?>&nbsp;
            <span id='Xclose' class='close'>&times;</span>
        </div>
        <div id='bookmarks' class='box-body'>
            <?=$bkmlist?>
        </div>
    </div>
</div>
<script type="text/javascript">

$('#getBkm').click(function() {
    let ycorr = (<?=$bcount?> - 3) * 12;
    let ypos = Math.max( ($('#bkpos').offset().top - ycorr), 200);
    let xpos = $('#form1').offset().left;
    $('#box').offset({ top: ypos, left: xpos });
    $('#curtain').show();
    let curtain = document.getElementById('curtain');
    var closeCurtain = function() {
        curhref = window.location.href;
        curtain.style.display = "none";
        location.replace(curhref);
    };
    $('#Xclose').click(closeCurtain); // click X
    curtain.onclick = closeCurtain; // click anywhere outside box
    document.onkeyup = function(evt) {
        // evt = evt || window.event;
        var isEscape = false;
        if ("key" in evt) {isEscape = (evt.key === "Escape" || evt.key === "Esc");}
        // else {isEscape = (evt.keyCode === 27);}
        if (isEscape) {closeCurtain();}
    };
    $(document).on('click','.bkmli',function(){
        let bkm = $(this).data('bkm');
        $("#secondpersonID").val(bkm);
        $("#form1").submit(); // should be placed outside </form> !
    });
});

$("#secondpersonID").on("input", function(){ // check for ANY input change
    let chars = !(!$(this).val()); // or != ""; this.val give false if input is empty (why?)
    disableButtons(chars);
});
$("#setMe").click(function(){
    let me = "<?php echo isset($_SESSION['mypersonID']) ? $_SESSION['mypersonID'] : ""; ?>";
    $("#secondpersonID").val(me);
    $("#form1").submit(); // should be after </form> !
});
function disableButtons(onoff){
    $("#setMe").attr("disabled", onoff);
    $("#getBkm").attr("disabled", onoff);
    let infcolor = onoff ? '#ccc' : '#666';
    $("#name2").css('color',infcolor);
}
</script>
<br style="clear: both"/>
<input type="hidden" name="maxL" id="maxL" value="<?php echo $maxLopt; ?>" />
<input type="hidden" name="primarypersonID" id="primarypersonID" value="<?php echo $primaryID; ?>" />
<input type="hidden" name="tree" value="<?php echo $tree; ?>" />
<input type="submit" value="<?php echo $text['calculate']; ?>" id="calcbtn" class="btn"
    <?php if(empty($relatepersonID)) echo "onclick=\"if(form1.secondpersonID.value.length == 0)
	    {alert('{$text['select2inds']}'); return false;}\""; ?> /> &nbsp; &nbsp; <a href="<?php echo $relateform_url . "primaryID={$primaryID}&tree={$tree}"; ?>" class="subhead"><?php echo $text['simplerel']; ?></a>
</form>
<br/>

<?php
	tng_footer( "" );
?>