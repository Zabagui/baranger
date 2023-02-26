<?php
switch($_GET['pdftype']) {
    case "ped":
    case "desc":
    	$textpart = "pedigree";
        break;
    case "fam":
    	$textpart = "familygroup";
        break;
    default:
    	$textpart = "getperson";
        break;
}

$tngprint = 1;
include("tng_begin.php");
include($subroot . "pedconfig.php");

if($pdftype == "ped") {
	$dest = "rpt_pedigree";
	$genmax = !$pedigree['maxgen'] || $pedigree['maxgen'] > 6 ? 6 : $pedigree['maxgen'];
	$genmin = 2;
	$allow_blank = 1;
	$allow_cite = 0;
	$hdrFontSizes = array(9, 10, 12, 14);
	$hdrFontDefault = 14;
	$lblFontSizes = array();
	$rptFontSizes = array(8);
	$titleidx = 'pedigreefor';
}
elseif($pdftype == "desc") {
	$dest = "rpt_descend";
	$genmin = 2;
	$genmax = !$pedigree['maxdesc'] || $pedigree['maxdesc'] > 12 ? 12 : $pedigree['maxdesc'];
	$allow_blank = 0;
	$allow_cite = 0;
	$hdrFontSizes = array(9, 10, 12, 14);
	$hdrFontDefault = 14;
	$lblFontSizes = array();
	$rptFontSizes = array(9, 10, 12, 14);
	$rptFontDefault = 10;
	$titleidx = 'descendfor';
}
elseif($pdftype == "fam") {
	$dest = "rpt_fam";
	$genmin = 0;
	$genmax = 0;
	$allow_blank = 1;
	$allow_cite = 1;
	$hdrFontSizes = array(9, 10, 12, 14);
	$hdrFontDefault = 14;
	$lblFontSizes = array(10);
	$rptFontSizes = array(9, 10, 12, 14);
	$rptFontDefault = 10;
	$titleidx = 'familygroupfor';
}
else {
	$dest = "rpt_ind";
	$genmin = 0;	    // no generations option
	$genmax = 0;
	$allow_blank = 1;
	$allow_cite = 1;
	$hdrFontSizes = array(9, 10, 12, 14);
	$hdrFontDefault = 14;
	$lblFontSizes = array(9);
	$rptFontSizes = array(9, 10, 12, 14);
	$rptFontDefault = 10;
	$titleidx = 'indreportfor';
}

function doGenOptions($generations,$first,$last) {
	echo '<select name="genperpage">';
	for($i = $first; $i <= $last; $i++) {
		echo "<option value=\"$i\"";
		if($i == $generations) echo " selected=\"selected\"";
		echo ">$i</option>\n";
	}
	echo '</select>';
}

function doFontOptions($field, $default='helvetica') {
	global $font_list;

	echo "<select name=\"$field\">";
	$fonts = array_keys($font_list);
	sort($fonts);
	foreach($fonts as $font) {
	    echo "<option value=\"$font\"";
	    if ($font == $default)
		print " selected=\"selected\"";
	    echo ">$font_list[$font]</option>";
	}
	echo '</select>';
}

function doFontSizeOptions($field, $options, $default) {
    if (count($options) == 1) {
	echo "<span class=\"normal\">$options[0] pt</span>";
	echo "<input type=\"hidden\" name=\"$field\" value=\"$options[0]\" />";
    }
    else {
	echo "<select name=\"$field\">";
	foreach ($options as $size) {
	    echo "<option value=\"$size\"";
	    if ($default == $size)
		print " selected=\"selected\"";
	    echo ">$size</option>";
	}
	echo '</select> pt';
    }
}

$savetype = $pdftype;
// load the list of available fonts
$font_dir = $rootpath . $endrootpath . 'font';
if (is_dir($font_dir)) {
	if ($session_charset == 'UTF-8') {
	    if ($dh = opendir($font_dir . '/unifont')) {
			while (($fontfamily = readdir($dh)) !== false) {
                //Added @eaDir to ignore Synology files
				if(is_dir("$font_dir/unifont/$fontfamily") && $fontfamily != "." && $fontfamily != ".." && $fontfamily != "@eaDir") {
			    	//$fontkey = strtolower($fontfamily);
					$font_list[$fontfamily] = $fontfamily;
				}
			}
	    }
	}
	else {
	    if ($dh = opendir($font_dir)) {
			while (($fontfamily = readdir($dh)) !== false) {
                //Added @eaDir to ignore Synology files
                if (is_dir("$font_dir/$fontfamily") && $fontfamily != "." && $fontfamily != ".." && $fontfamily != "unifont"  && $fontfamily != "@eaDir") {
			    	$fontkey = $fontfamily;
					$font_list[$fontkey] = ucfirst($fontfamily);
				}
			}
	    }
	}
}
$pdftype = $savetype;

if ($pdftype == "fam") {
    $result = getFamilyData($tree, $familyID);
    $famrow = tng_fetch_assoc($result);
    $titletext = getFamilyName($famrow);
}
else {
    $result = getPersonSimple($tree, $personID);
    if( $result ) {
		$row = tng_fetch_assoc( $result );

		$righttree = checktree($tree);
		$rights = determineLivingPrivateRights($row, $righttree);
		$row['allow_living'] = $rights['living'];
		$row['allow_private'] = $rights['private'];

		$pedname = getName( $row );
		tng_free_result($result);
		$titletext = "$pedname ($personID)";
    }
}

header("Content-type:text/html; charset=" . $session_charset);
?>

<div class="databack ajaxwindow" id="finddiv">
<span class="subhead"><strong><?php echo $text['pdfgen']; ?></strong></span><br/>

<br /><p class="subhead"><span class="normal" style="padding-bottom:3px"><?php echo $text[$titleidx]; ?></span><br /><?php echo $titletext; ?></p>
<?php
if (count($font_list) == 0) {
    echo "ERROR: There are no fonts installed to support character set $session_charset.";
    return;
}
?>

<?php
	echo getFORM( $dest, "post", "pdfform", "pdfform" );
	// determine if we need to draw a generations option
	if($genmin > 0 || $genmax > 0) {
		if($generations < $genmin) $generations = $genmin;
		if($generations > $genmax) $generations = $genmax;
?>
<table id="genselect" cellpadding="0" class="normal">
    <tr>
	<td>
	    <span class="normal"><?php echo $text['generations']; ?>:</span>
	</td>
	<td>
	    <?php echo doGenOptions($generations,$genmin,$genmax); ?>
	</td>
    </tr>
<?php
	if($pdftype == "ped" || $pdftype == "desc") {
?>
    <tr>
	<td class="ws">
	    <span class="normal"><?php echo $text['startnum']; ?>:</span>
	</td>
	<td>
	    <input type="text" name="startnum" value="1" size="4"/>
	</td>
    </tr>
<?php
	}
?>
</table>

<?php
	}

	// draw the blank form checkbox
	if($allow_blank) {
?>
<div  class="pdfblock normal"><input type="checkbox" id="blankform" name="blankform" value="1" /> <?php echo $text['blank']; ?></div>
<?php
	}

	// draw the citations checkbox
	if($allow_cite) {
?>
<div  class="pdfblock normal"><input type="checkbox" id="citesources" name="citesources" value="1" checked="1"/> <?php echo $text['inclsrcs']; ?></div>
<?php
	}
if ($pdftype == "fam")
    echo "<input type=\"hidden\" name=\"familyID\" value=\"$familyID\"/>\n";
else
    echo "<input type=\"hidden\" name=\"personID\" value=\"$personID\"/>\n";
?>
<input type="hidden" name="tree" value="<?php echo $tree; ?>" />

<?php
	// options specific to certain report types
	if($pdftype == "desc") {
?>
<div  class="pdfblock subhead"><a href="#" onClick="return toggleSection('dispopts','dispicon','');"  class="pdftoggle"><img src="<?php echo $cms['tngpath']; ?>img/tng_expand.gif" width="15" height="15" border="0" id="dispicon"/> <?php echo $text['dispopts']; ?></a></div>
<div style="display:none" id="dispopts">
<table id="display" cellpadding="3" class="normal">
    <tr>
	<td>
	    <span class="normal"><?php echo $text['datesloc']; ?>:&nbsp;</span>
	</td>
	<td>
	    <select name="getPlace">
	    <option value="1" selected="selected"><?php echo $text['borchr']; ?></option>
            <option value="2"><?php echo $text['nobd']; ?></option>
            <option value="3"><?php echo $text['bcdb']; ?></option>
	    </select>
	</td>
    </tr>
	<td>
	    <span class="normal"><?php echo $text['numsys']; ?>:&nbsp;</span>
	</td>
	<td>
	    <select name="numbering">
	    <option value="0"><?php echo $text['none']; ?></option>
	    <option value="1" selected="selected"><?php echo $text['gennums']; ?></option>
            <option value="2"><?php echo $text['henrynums']; ?></option>
            <option value="3"><?php echo $text['abovnums']; ?></option>
            <option value="4"><?php echo $text['devnums']; ?></option>
	    </select>
	</td>
    <tr>
</table>
<br />
</div>
<?php
	}
?>

<!-- Font section -->
<div  class="pdfblock subhead"><a href="#" onClick="return toggleSection('font','fonticon','');"  class="pdftoggle"><img src="<?php echo $cms['tngpath']; ?>img/tng_expand.gif" width="15" height="15" border="0" id="fonticon"> <?php echo $text['fonts']; ?></a></div>
<div style="display:none" id="font">
<table cellpadding="3" class="normal">
	<tr>
		<td><?php echo $text['family']; ?></td>
		<td>
	    	<?php doFontOptions('rptFont'); ?>
		</td>
	</tr>
<?php
    // header fonts
    if (count($hdrFontSizes) > 1) {
?>
    <tr>
	<td>
	    <span class="normal"><?php echo $text['header']; ?>:&nbsp;</span>
	</td>
	<td>
	    <?php doFontSizeOptions('hdrFontSize', $hdrFontSizes, $hdrFontDefault); ?>
	</td>
    </tr>
<?php
    }
    
    // label fonts
    if (count($lblFontSizes) > 1) {
?>
    <tr>
	<td>
	    <span class="normal"><?php echo $text['labels']; ?>:&nbsp;</span>
	</td>
	<td>
	    <?php doFontSizeOptions('lblFontSize', $lblFontSizes, $lblFontDefault); ?>
	</td>
    </tr>
<?php
    }

    // data fonts
    if (count($rptFontSizes) > 1) {
?>
    <tr>
	<td>
	    <span class="normal"><?php echo $text['data']; ?>:&nbsp;</span>
	</td>
	<td>
	    <?php doFontSizeOptions('rptFontSize', $rptFontSizes, $rptFontDefault); ?>
	</td>
    </tr>
<?php
	}
	$pagesize = isset($_COOKIE['tng_pagesize']) ? $_COOKIE['tng_pagesize'] : $pedigree['pagesize'];
?>
</table>
<?php
	if(count($hdrFontSizes) == 1)
		echo "<input type=\"hidden\" name=\"hdrFontSize\" value=\"$hdrFontSizes[0]\" />";
	if(count($lblFontSizes) == 1)
		echo "<input type=\"hidden\" name=\"lblFontSize\" value=\"$lblFontSizes[0]\" />";
	if(count($rptFontSizes) == 1)
		echo "<input type=\"hidden\" name=\"rptFontSize\" value=\"$rptFontSizes[0]\" />";
?>
<br />
</div>

<!-- Page setup section -->
<div  class="pdfblock subhead"><a href="#" onClick="return toggleSection('pgsetup','pgicon','');"  class="pdftoggle"><img src="<?php echo $cms['tngpath']; ?>img/tng_expand.gif" width="15" height="15" border="0" id="pgicon"> <?php echo $text['pgsetup']; ?></a></div>
<div style="display:none" id="pgsetup">
<table cellpadding="3" class="normal">
    <tr>
	<td>
	    <span class="normal"><?php echo $text['pgsize']; ?>:&nbsp;</span>
	</td>
	<td>
	    <select name="pagesize">
		    <option value="a3"<?php if($pagesize == "a3") echo "selected=\"selected\""; ?>>A3</option>
		    <option value="a4"<?php if($pagesize == "a4") echo "selected=\"selected\""; ?>>A4</option>
		    <option value="a5"<?php if($pagesize == "a5") echo "selected=\"selected\""; ?>>A5</option>
		    <option value="letter"<?php if(!$pagesize || $pagesize == "letter") echo "selected=\"selected\""; ?>><?php echo $text['letter']; ?></option>
	        <option value="legal"<?php if($pagesize == "legal") echo "selected=\"selected\""; ?>><?php echo $text['legal']; ?></option>
	    </select>
	</td>
    </tr>
    <tr>
	<td>
	    <span class="normal"><?php echo $text['orient']; ?>:&nbsp;</span>
	</td>
	<td>
	    <select name="orient">
	    <option value=p selected><?php echo $text['portrait']; ?></option>
            <option value=l><?php echo $text['landscape']; ?></option>
	    </select>
	</td>
    </tr>
    <tr>
	<td>
	    <span class="normal"><?php echo $text['tmargin']; ?>:&nbsp;</span>
	</td>
	<td>
	    <input type="text" value="0.5" name="topmrg" size="5" />
	</td>
    </tr>
    <tr>
	<td>
	    <span class="normal"><?php echo $text['bmargin']; ?>:&nbsp;</span>
	</td>
	<td>
	    <input type="text" value="0.5" name="botmrg" size="5" />
	</td>
    </tr>
    <tr>
	<td>
	    <span class="normal"><?php echo $text['lmargin']; ?>:&nbsp;</span>
	</td>
	<td>
	    <input type="text" value="0.5" name="lftmrg" size="5" />
	</td>
    </tr>
    <tr>
	<td>
	    <span class="normal"><?php echo $text['rmargin']; ?>:&nbsp;</span>
	</td>
	<td>
	    <input type="text" value="0.5" name="rtmrg" size="5" />
	</td>
    </tr>
</table>
</div>
<br />
<input type="submit" onclick="this.form.target='_blank'" class="btn" value="<?php echo $text['createch']; ?>" />

</form>


</div>