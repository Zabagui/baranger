<?php
include("begin.php");
include("adminlib.php");
$textpart = "templates";
//include("getlang.php");
include("$mylanguage/admintext.php");

$templatespath = "templates";

if( $link ) {
	$admin_login = 1;
	include("checklogin.php");
	include("version.php");

	if( $assignedtree || !$allow_edit ) {
		$message = $admtext['norights'];
		header( "Location: admin_login.php?message=" . urlencode($message) );
		exit;
	}
}

$tmp = array();
$query = "SELECT * FROM $templates_table ORDER BY template, ordernum";
$result = tng_query($query);

while( $row = tng_fetch_assoc( $result ) ) {
	if( is_dir($cms['tngpath'] . "templates/template" . $row['template']) || is_dir($cms['tngpath'] . "templates/" . $row['template'])) {
		$key = "t" . $row['template'] . "_" . $row['keyname'];
		if($row['language'])
			$key .= "_" . $row['language'];
		$tmp[$key] = $row['value'];
	}
}
tng_free_result($result);

$languageArray = array();
$query = "SELECT display, folder FROM $languages_table ORDER BY display";
$result = tng_query($query);
$languageList = tng_num_rows($result) ? "<option value=\"\"></option>\n" : "";
while($row = tng_fetch_assoc($result)) {
	$key = $row['folder'];
	$languageList .= "<option value=\"$key\">{$row['display']}</option>\n";
	$languageArray[$key] = $row['display'];
}
tng_free_result($result);

$treequery = "SELECT gedcom, treename FROM $trees_table ORDER BY treename";
$treeresult = tng_query($treequery) or die ($admtext['cannotexecutequery'] . ": $treequery");
$treenum = 0;
while( $treerow = tng_fetch_assoc($treeresult) ) {
	$treenum++;
	$trees[$treenum] = $treerow['gedcom'];
	$treename[$treenum] = $treerow['treename'];
}
tng_free_result($treeresult);

$helplang = findhelp("templateconfig_help.php");

tng_adminheader( $admtext['modifytemplatesettings'], $flags );
?>
<script type="text/javascript" src="js/admin.js"></script>
<script type="text/javascript" src="js/mediautils.js?v<?php echo $tng_version; ?>"></script>
<script type="text/javascript" src="js/selectutils.js"></script>
<script type="text/javascript">
function switchTemplates(newtemp) {
	if(newtemp) {
		jQuery('#form_templateswitching').val('1');
		jQuery('#topsave').hide();
	}
	jQuery('div.tsection').each(function(index, item){
		item.style.display = item.id == "t"+newtemp ? '' : 'none';
	});
}

function insertCell(row,index,content) {
	var cell = row.insertCell(index);
	cell.innerHTML = content ? content : content + '&nbsp;';
	if(!index) cell.vAlign = "top";
	return cell;
}

function insertLangRow(rowID, type) {
	var language = jQuery('#lang_'+rowID);
	var langVal = language.val();
	if(langVal && !jQuery('#form_' + rowID + '_' + langVal).length) {
		var row = document.getElementById(rowID);
		var langElem = language[0];
		var langDisplay = langElem.options[langElem.selectedIndex].innerHTML;
		var table = row.parentNode;
		var newtr = table.insertRow(row.rowIndex + 1);
		var label = "&nbsp;&nbsp;" + jQuery('#'+rowID+' :first-child').html();
		insertCell(newtr,0,label + "<br/>&nbsp;&nbsp;&nbsp;(" + langDisplay + ")");
		var inputstr = type == "textarea" ? "<textarea name=\"form_" + rowID + "_" + langVal + "\" id=\"form_" + rowID + "_" + langVal + "\" rows=\"3\" cols=\"80\"></textarea>" : "<input type=\"text\" class=\"longfield\" name=\"form_" + rowID + "_" + langVal + "\" id=\"form_" + rowID + "_" + langVal + "\"/>";
		insertCell(newtr,1,inputstr);
		insertCell(newtr,2,"");
	}
	return false;
}

function showUploadBox(key, folder) {
	jQuery('#div_' + key).html("<input type=\"file\" name=\"upload_" + key + "\" onchange=\"populateFileName(this,jQuery('#form_" + key + "'));\"/> <?php echo $admtext['text_or']; ?> <input type=\"button\" value=\"<?php echo $admtext['select']; ?>\" name=\"photoselect_" + key + "\" onclick=\"javascript:FilePicker('form_" + key + "','" + folder + "');\" />");
	jQuery('#div_' + key).toggle();
	return false;
}

function populateFileName(source,dest) {
	var temp = source.value.replace(/\\/g,"/");
	var lastslash = temp.lastIndexOf("/") + 1;
    dest.val(lastslash > 0 ? 'img/' + source.value.slice(lastslash) : 'img/' + source.value);
}

function preview(sFileName) {
    window.open(escape(sFileName), "File", "width=400,height=250,status=no,resizable=yes,scrollbars=yes");
    return false;
}

function getTopValues(flagfield, numfield) {
	topflagfield = document.formtop1.form_templateswitching;
	flagfield.value = topflagfield.options[topflagfield.selectedIndex].value;
	topnumfield = document.formtop2.form_templatenum;
	numfield.value = topnumfield.options[topnumfield.selectedIndex].value;
}

jQuery(document).ready(function() {
	jQuery('#previewbtn').click(function(e) {
		e.preventDefault();
		jQuery('#previewscroll').toggle();
		jQuery('.prevmsg').toggle();
		return false;
	});
	jQuery('.prevdiv').click(function(e) {
		e.preventDefault();
		var id = this.id.substring(4);
		jQuery('#form_templatenum').val(id);
		switchTemplates(id);
		return false;
	});
});
</script>
</head>

<?php
	echo tng_adminlayout();

	$setuptabs[0] = array(1,"admin_setup.php",$admtext['configuration'],"configuration");
	$setuptabs[1] = array(1,"admin_diagnostics.php",$admtext['diagnostics'],"diagnostics");
	$setuptabs[2] = array(1,"admin_setup.php?sub=tablecreation",$admtext['tablecreation'],"tablecreation");
	$setuptabs[3] = array(1,"#",$admtext['templateconfigsettings'],"template");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/templateconfig_help.php');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($setuptabs,"template",$innermenu);
	echo displayHeadline($admtext['setup'] . " &gt;&gt; " . $admtext['configuration'] . " &gt;&gt; " . $admtext['templateconfigsettings'],"img/setup_icon.gif",$menu,"");
?>

<div class="admin-main">
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="adm-rounded-table">
<tr>
<td class="tngshadow databack">
	<form name="formtop1" action="admin_updatetemplateconfig.php" method="post">
		<label for="form_templateswitching"><?php echo $admtext['templateswitching']; ?>:</label>
		<select name="form_templateswitching" id="form_templateswitching" onchange="if(jQuery(this).val() == '0') {jQuery('#form_templatenum').val(''); jQuery('#topsave').show(); switchTemplates('')}">
			<option value="0"<?php if( !$templateswitching ) echo " selected"; ?>><?php echo $admtext['no']; ?></option>
			<option value="1"<?php if( $templateswitching ) echo " selected"; ?>><?php echo $admtext['yes']; ?></option>
		</select>
		<input type="submit" name="submittop" id="topsave" value="<?php echo $admtext['save']; ?>" style="display:none"/>
		<input type="hidden" name="form_templatenum" value=""/>
	</form>
</td>
</tr>
<tr>
<td class="tngshadow databack">
	<form name="formtop2">
		<label for="form_templatenum"><b><?php echo $admtext['template']; ?>:</b></label>
<?php
	chdir( $rootpath . $endrootpath . $templatespath );
    	$totaltemplates = 0;
		$sections = array();
    	$entries = array();
    	$folders = array();
	if( $handle = @opendir('.') ) {
		while( $filename = readdir( $handle ) ) {
			if( is_dir( $filename ) && $filename != "." && $filename != ".." && $filename != '@eaDir' ) {
				$i = substr($filename,0,8) == "template" && is_numeric(substr($filename,8)) ? substr($filename, 8) : $filename;
				$totaltemplates++;
				$sections['t'.$i] = "";
				$entries[] = $i;
				$folders['t'.$i] = $filename;
			}
		}
		closedir( $handle );
	}
	natcasesort( $entries );
	$entries = array_reverse($entries);
?>
		<select name="form_templatenum" id="form_templatenum" onchange="switchTemplates(jQuery(this).val());">
			<option value=""></option>
<?php
    foreach($entries as $entry) {
        echo "<option value=\"$entry\"";
        if($templatenum == $entry)
            echo " selected=\"selected\"";
        $tprefix = is_numeric($entry) ? $admtext['template'] . " " : "";
        echo ">$tprefix$entry</option>\n";
    }
?>
		</select> <button id="previewbtn"><span class="prevmsg"><?php echo $admtext['showprev']; ?></span><span class="prevmsg" style="display:none"><?php echo $admtext['hideprev']; ?></span></button>
	</form>

	<div style="display:none;" id="previewscroll" class="scroller">
		<br/>
		<div style="position:absolute">
<?php
    foreach($entries as $i) {
		$newtemplatepfx = is_numeric($i) ? "template" : "";
		echo "<div class=\"prevdiv\" id=\"prev$i\"><span class=\"prevnum\">$i:</span>";
		if(file_exists("{$rootpath}{$endrootpath}templates/$newtemplatepfx$i/img/preview1sm.jpg"))
			echo "<img src=\"templates/$newtemplatepfx$i/img/preview1sm.jpg\" id=\"preview-$i\" hspace=\"2\" class=\"temppreview\" />";
		if(file_exists("{$rootpath}{$endrootpath}templates/$newtemplatepfx$i/img/preview2sm.jpg"))
			echo "<img src=\"templates/$newtemplatepfx$i/img/preview2sm.jpg\" id=\"preview-$i\" hspace=\"2\" class=\"temppreview\" /> &nbsp;&nbsp;\n";
		echo "</div>\n";
    }
?>
		</div>
	</div>
	
	<br/><br/>
<?php
	$textareas = array('mainpara','searchpara','fhpara','fhlinkshis','fhlinkshers','mwpara','featurepara','respara','featurelinks','reslinks','headtitle','headsubtitle','latestnews','featurepara1','featurepara2','featurepara3','featurepara4','featurepara5','featurepara6','featurepara7','featurepara8','featurepara9','photocaption','newstext','featurespara','textpara1','textpara2','textpara3','photocaptionl','photocaptionr','snipinfoone','snipinfotwo','quote','mompara','dadpara','spmompara','spdadpara','sidebarpara');
	//needtrans: these fields can be duplicated in another language
	$needtrans = array('headline','maintitle','welcome','hisside','herside','headtitle1','headtitle2','headtitle3','momside','dadside','mainpara','featurepara',
		'featurelinks','featurelinktext','searchpara','fhpara','mwpara','respara','headtitle','headsubtitle','latestnews','featuretitle1','featuretitle2','featuretitle3',
		'featuretitle4','featuretitle5','featuretitle6','featuretitle7','featuretitle8','featuretitle9','featurepara1','featurepara2','featurepara3','featurepara4',
		'featurepara5','featurepara6','featurepara7','featurepara8','featurepara9','photocaption','newstext','menutitle','phototitlel','photocaptionl','phototitler',
		'photocaptionr','topsurnames','featurespara','sidebarhead1','sidebarhead2','sidebarhead3','sidebartitle','sidebarsub','sidebarpara','sidebarlinktext',
		'texttitle1','texttitle2','texttitle3','textpara1','textpara2','textpara3','subhead1','subhead2','snipinfoone','snipinfotwo','quote','subhead',
		'ancestors','momheading','mompara','dadheading','dadpara','spmomheading','spmompara','spdadheading','spdadpara','spmomside','spdadside','storiesheading',
		'quotehead','slideheadline','slidetext','slidelinktext','footerheadline','footerlinktext','footerpara','linktext','featuresub','featuretitle','headline',
		'snipheadline','snipname','slidetitle','snipsubhead','sniptitle');
	foreach($tmp as $key=>$value) {
		$parts = explode("_",$key);
		$n = $parts[0];
		$label = $parts[1];
		$label_parts = explode("-",$label);
		if(isset($label_parts[1])) {
			$index = " " . $label_parts[1];
			$label = $label_parts[0];
		}
		else
			$index = "";
		$value = preg_replace("/\"/", "&#34;",$value);
		if( !isset($sections[$n]) ) $sections[$n] = "";
		$sections[$n] .= "<tr id=\"$key\">\n";
		if(in_array($label,$textareas)) {
			$type = "textarea";
			$align = " valign=\"top\"";
		}
		elseif(substr($label, -4) === "tree") {
			$type = "select";
			$align = "";
		}
		else {
			$type = "text";
			$align = "";
		}
		$sections[$n] .= "<td$align>";
		$sections[$n] .= isset($parts[2]) ? "&nbsp;&nbsp;{$admtext[$label]}{$index}:" : ($label != "" ? $admtext[$label] . $index . ":" : $index . ":");
		$langName = isset($parts[2]) && isset($languageArray[$parts[2]]) ? $languageArray[$parts[2]] : (!empty($parts[2]) ? $parts[2] : "");
		$sections[$n] .= $langName ? "<br/>&nbsp;&nbsp;&nbsp;&nbsp;(" . $langName . ")" : "";
		$sections[$n] .= "</td>\n";
		$sections[$n] .= "<td>";
		if($type == "textarea") {
			$sections[$n] .= "<textarea name=\"form_$key\" id=\"form_$key\" rows=\"5\" cols=\"80\">$value</textarea>\n";
		}
		elseif($type == "select") {
			$sections[$n] .=  "<select name=\"form_$key\" id=\"form_$key\">\n";
			for( $j = 1; $j <= $treenum; $j++ ) {
				$sections[$n] .=  "	<option value=\"$trees[$j]\"";
				if($value == $trees[$j]) $sections[$n] .= " selected";
				$sections[$n] .=  ">$treename[$j]</option>\n";
			}
			$sections[$n] .=  "</select>\n";
		}
		elseif($label == "titlechoice") {
			$sections[$n] .= "<input type=\"radio\" name=\"form_$key\" id=\"form_{$key}_image\" value=\"image\"";
			if($value == "image")
				$sections[$n] .= " checked=\"checked\"";
			$sections[$n] .= "> <label for=\"form_{$key}_image\">{$admtext['ttitleimage']}</label> &nbsp;";
			$sections[$n] .= "<input type=\"radio\" name=\"form_$key\" id=\"form_{$key}_text\" value=\"text\"";
			if($value == "text")
				$sections[$n] .= " checked=\"checked\"";
			$sections[$n] .= "> <label for=\"form_{$key}_text\">{$admtext['ttitletext']}</label> &nbsp;";
		}
		else {
			$sections[$n] .= "<input type=\"text\" class=\"longfield\" name=\"form_$key\" id=\"form_$key\" value=\"$value\"/>\n";
			if(strpos($key, "img") !== false || strpos($key, "image") !== false || strpos($key, "thumb") !== false || strpos($key, "photol") !== false || strpos($key, "photor") !== false) {
				$sections[$n] .= " <input type=\"button\" onclick=\"if(jQuery('#form_$key').val()) return preview('templates/{$folders[$n]}/' + jQuery('#form_$key').val());\" value=\"{$admtext['preview']}\" /> <input type=\"button\" onclick=\"return showUploadBox('$key','{$folders[$n]}');\" value=\"{$admtext['change']}\" />\n";
				$safevalue = strpos($value, "&#34;") != false ? substr($value, 0, strpos($value, "&#34;")) : $value;
				$size = @GetImageSize($rootpath . "templates/{$folders[$n]}/$safevalue");
				if( $size ) {
					$imagesize1 = $size[0];
					$imagesize2 = $size[1];
					$sections[$n] .= " &nbsp; $imagesize1 x $imagesize2 px\n";
				}
				$sections[$n] .= "<div id=\"div_$key\" style=\"display:none\"></div>";
			}
			elseif(substr($label, -6) == "person") {
				$treefield = str_replace("person","tree",$key);
				$sections[$n] .= "<a href=\"#\" onclick=\"return findItem('I','form_{$key}','',$('#form_{$treefield}').val(),'');\" title=\"{$admtext['find']}\">\n";
				$sections[$n] .= "<img src=\"img/tng_find.gif\" title=\"{$admtext['find']}\" alt=\"{$admtext['find']}\" class=\"alignmiddle\" width=\"20\" height=\"20\" border=\"0\" vspace=\"0\" hspace=\"2\">\n";
				$sections[$n] .= "</a>\n";
			}
		}
		if($languageList && !isset($parts[2]) && in_array($label,$needtrans)){
			if($type == "textarea")
				$sections[$n] .= "<br />";
			$sections[$n] .= "{$admtext['createcopy']}: \n<select id=\"lang_$key\">\n$languageList\n</select> <input type=\"button\" value=\"{$admtext['go']}\" onclick=\"return insertLangRow('$key','$type');\" />\n";
		}
		$sections[$n] .= "</td>\n</tr>\n";
	}
	//debugPrint($sections);
	foreach($entries as $i) {
		$section = $sections['t'.$i];
		if($section) {
			$dispstr = $templatenum != $i ? " style=\"display:none\"" : "";
			echo "<div$dispstr class=\"tsection\" id=\"t$i\">\n";
			echo "<form action=\"admin_updatetemplateconfig.php\" method=\"post\" name=\"form$i\" ENCTYPE=\"multipart/form-data\" onsubmit=\"getTopValues(this.form_templateswitching,this.form_templatenum);\">\n";
			echo "<table class=\"tstable normal\">\n";
			$newtemplatepfx = is_numeric($i) ? "template" : "";
			$imagetext = "";
			if(file_exists("{$rootpath}templates/$newtemplatepfx$i/img/preview1.jpg"))
				$imagetext .= "<img src=\"templates/$newtemplatepfx$i/img/preview1.jpg\" id=\"preview1\" hspace=\"2\" class=\"temppreview\" /> ";
			if(file_exists("{$rootpath}templates/$newtemplatepfx$i/img/preview2.jpg"))
				$imagetext .= " &nbsp; <img src=\"templates/$newtemplatepfx$i/img/preview2.jpg\" id=\"preview2\" hspace=\"2\" class=\"temppreview\" />\n";
			if($imagetext)
				echo "$imagetext<br />";
			echo "<input type=\"submit\" name=\"submit{$i}\" class=\"btn saveret\" accesskey=\"s\" value=\"{$admtext['saveback']}\">\n";
			echo "<input type=\"submit\" name=\"submitx{$i}\" class=\"btn savestay\" accesskey=\"s\" value=\"{$admtext['savereturn']}\">\n";
			echo "<p><strong>{$admtext['folder']}: templates/" . $folders['t'.$i] . "</strong></p>";
			echo "$section</table><br/>\n";
			echo "<input type=\"submit\" name=\"submit\" class=\"btn\" value=\"{$admtext['saveback']}\">\n";
			echo "<input type=\"submit\" name=\"submitx\" accesskey=\"s\" class=\"btn\" value=\"{$admtext['savereturn']}\">\n";
			echo "<input type=\"button\" name=\"cancel\" class=\"btn\" value=\"{$text['cancel']}\" onClick=\"window.location.href='admin_setup.php';\">\n";
			echo "<input type=\"hidden\" name=\"form_templateswitching\" value=\"\"/>\n";
			echo "<input type=\"hidden\" name=\"form_templatenum\" value=\"\"/>\n";
			echo "</form>\n";
			echo "</div>\n";
		}
	}
?>	
</td>
</tr>

</table>
</form>
</div>
<?php 
echo tng_adminfooter();
?>