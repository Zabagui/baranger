<?php
include("begin.php");
include("adminlib.php");
$textpart = "photos";
//include("getlang.php");
include("$mylanguage/admintext.php");

$admin_login = 1;
include("checklogin.php");
include("version.php");

if( !$allow_media_edit ) {
	$message = $admtext['norights'];
	header( "Location: admin_login.php?message=" . urlencode($message) );
	exit;
}

if( $assignedtree ) {
	$wherestr = "WHERE gedcom = \"$assignedtree\"";
	$tree = $assignedtree;
}
else
	$wherestr = "";
$treequery = "SELECT gedcom, treename FROM $trees_table $wherestr ORDER BY treename";

$helplang = findhelp("media_help.php");

tng_adminheader( $admtext['sortmedia'], $flags );
?>
<script type="text/javascript" src="js/net.js?v<?php echo $tng_version; ?>"></script>
<script type="text/javascript" src="js/mediafind.js?v<?php echo $tng_version; ?>"></script>
<script type="text/javascript" src="js/mediautils.js?v<?php echo $tng_version; ?>"></script>
<script type="text/javascript" src="js/selectutils.js?v<?php echo $tng_version; ?>"></script>
<script type="text/javascript" src="js/datevalidation.js?v<?php echo $tng_version; ?>"></script>
<script type="text/javascript">
var preferEuro = <?php echo ($tngconfig['preferEuro'] ? $tngconfig['preferEuro'] : "false"); ?>;
var preferDateFormat = '<?php if( isset($preferDateFormat) ) echo $preferDateFormat; ?>';
var findopen;
var album = '';
var media = '';
var type = "media";
//var formname = "find";
var findform = "find";
var resheremsg = '<span class="normal">' + '</span>'; //can't remember what this was supposed to be
var tng_thumbmaxw = <?php echo ($thumbmaxw ? $thumbmaxw : "80"); ?>;
var tng_thumbmaxh = <?php echo ($thumbmaxh ? $thumbmaxh : "80"); ?>;
var links_url = cmstngpath + "ajx_medialinks.php";
var findform;
<?php
	echo "var altdescmsg = \"{$admtext['alttitle']}\";\n";
	echo "var altnotesmsg = \"{$admtext['altdesc']}\";\n";
	echo "var makedefaultmsg = \"{$admtext['makedefault']}\";\n";
	echo "var eventlinkmsg = \"{$admtext['eventlink']}\";\n";
	echo "var eventmsg = \"{$admtext['event']}\";\n";
	echo "var sortmsg = \"{$admtext['text_sort']}\";\n";
	echo "var confdellink = \"{$admtext['confdellink']}\";\n";
	echo "var remove_text = \"{$admtext['removelink']}\";\n";
	echo "var edit_text = \"{$admtext['edit']}\";\n";
	echo "var yesmsg = \"{$admtext['yes']}\";\n";
?>

function enableSave(savebuttonid) {
	jQuery('#q'+savebuttonid).removeAttr('disabled');
	jQuery('#q'+savebuttonid+' span').show();
	jQuery('#ch'+savebuttonid).hide();
}

function validateForm( ) {
	if( document.find.newlink1.value.length == 0 ) {
		alert("<?php echo $admtext['enterid']; ?>");
	}
	else
		linkStuff('linkerform','masslink');
	return false;
}

function validateForm2( ) {
	if( document.find2.cemeteryID.selectedIndex == 0 ) {
		alert("<?php echo $admtext['selectcemetery']; ?>");
	}
	else
		linkStuff('linkerform2','cemlink');
	return false;
}

function getTree(treeobj) {
	if( treeobj.options.length ) 
		return treeobj.options[treeobj.selectedIndex].value;
	else {
		alert("<?php echo $admtext['selecttree']; ?>");
		return false;
	}
}

function confirmDelete(event) {
	if(confirm('<?php echo $admtext['confdeletemedia']; ?>' ))
		return true;
	else {
		event.preventDefault();
		event.stopPropagation();
		return false;
	}
}

var mediafolders = new Array();
<?php
foreach($mediatypes as $mediatype) {
	$ID = $mediatype['ID'];
	echo "mediafolders['$ID'] = '{$mediatypes_assoc[$ID]}';\n";
}
?>

function changeCollection(coll) {
	var mediatype = coll.options[coll.selectedIndex].value;
	jQuery('#folderlabel').html(mediafolders[mediatype]);
	jQuery('#folder').val("");
}

function linkStuff(form_id, action) {
	var medialist = "";

	jQuery('.mediacheck:checked').each(function() {
		medialist += (medialist ? "," + this.id : this.id);
	});
	if(medialist) {
		var linkermsg = jQuery('#linkermsg');
		linkermsg.html('&nbsp;<img src="img/spinner.gif" />');
		
		var params = jQuery('#'+form_id).serialize();
		params += "&medialist=" + medialist + "&action=" + action;
		jQuery.ajax({
			url: cmstngpath + 'ajx_updateorder.php',
			data: params,
			dataType: 'html',
			success: function(req){
				linkermsg.html('<span class="green">' + req + '</span>');
				linkermsg.effect("highlight",{},2500);
			},
			error: function(req) {
				linkermsg.html("An error has occurred. Please try again.");
			}
		});
	}
}
</script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="css/jquery.fileupload-ui-noscript.css"></noscript>
<!-- Shim to make HTML5 elements usable in older Internet Explorer versions -->
<!--[if lt IE 9]><script src="<?php echo $http; ?>://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>

<?php
	echo tng_adminlayout();

	$mediatabs[0] = array(1,"admin_media.php",$admtext['search'],"findmedia");
	$mediatabs[1] = array($allow_media_add,"admin_newmedia.php",$admtext['addnew'],"addmedia");
	$mediatabs[2] = array($allow_media_edit,"admin_ordermediaform.php",$admtext['text_sort'],"sortmedia");
	$mediatabs[3] = array($allow_media_edit && !$assignedtree,"admin_thumbnails.php",$admtext['thumbnails'],"thumbs");
	$mediatabs[4] = array($allow_media_add && !$assignedtree,"admin_photoimport.php",$admtext['import'],"import");
	$mediatabs[5] = array($allow_media_add,"admin_mediaupload.php",$admtext['upload'],"upload");
	$innermenu = "<a href=\"#\" onclick=\"return openHelp('$helplang/media_help.php#upload');\" class=\"lightlink\">{$admtext['help']}</a>";
	$menu = doMenu($mediatabs,"upload",$innermenu);
	echo displayHeadline($admtext['media'] . " &gt;&gt; " . $admtext['upload'],"img/photos_icon.gif",$menu,$message);
?>

<div class="admin-main">
	<div class="databack admin-block">
	<span class="subhead"><strong><?php echo $admtext['mediaupl']; ?></strong></span><br/><br/>

	<form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
	        <!-- Redirect browsers with JavaScript disabled to the origin page -->
				<?php echo $admtext['mediatype']; ?>:
				<select name="mediatypeID" id="mediatypeID" onchange="changeCollection(this);">
<?php
	foreach( $mediatypes as $mediatype ) {
		$msgID = $mediatype['ID'];
		echo "	<option value=\"$msgID\">" . $mediatype['display'] . "</option>\n";
	}
?>
				</select>
				&nbsp;
<?php
	echo $admtext['tree'] . ": ";
	if( $assignedtree ) {
		if( !empty($row['gedcom']) ) {
			$treeresult = tng_query($treequery) or die ($admtext['cannotexecutequery'] . ": $treequery");
			$treerow = tng_fetch_assoc($treeresult);
			echo $treerow['treename'];
			tng_free_result($treeresult);
		}
		else
			echo $admtext['alltrees'];
		echo "<input type=\"hidden\" name=\"tree\" value=\"{$row['gedcom']}\">";
	}
	else {
		echo "<select name=\"tree\">";
		echo "	<option value=\"\">{$admtext['alltrees']}</option>\n";
		if( !empty($row['gedcom']) ) $tree = $row['gedcom'];

		$treeresult = tng_query($treequery) or die ($admtext['cannotexecutequery'] . ": $treequery");
		while( $treerow = tng_fetch_assoc($treeresult) ) {
			echo "	<option value=\"{$treerow['gedcom']}\"";
			if( isset($row['gedcom']) && $treerow['gedcom'] == $row['gedcom'] ) echo " selected";
			echo ">{$treerow['treename']}</option>\n";
		}
		echo "</select>&nbsp;&nbsp;\n";
		tng_free_result($treeresult);
	}
	$mediatypeID = $mediatypes[0]['ID'];
	$folder = $mediatypes_assoc[$mediatypeID];
	echo $admtext['folder'] . ": <span id=\"folderlabel\">$folder</span>/";
?>
			<input type="text" id="folder" name="folder" class="medfield"/> <input type="button" value="<?php echo $admtext['select'] . "..."; ?>" name="folderselect" onclick="FilePicker('folder',jQuery('#mediatypeID').val(),1);">
			<br/><br/>

	        <noscript><input type="hidden" name="redirect" value="{$http}://blueimp.github.com/jQuery-File-Upload/"></noscript>
	        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        	<div class="row fileupload-buttonbar" style="float:left">
	        	<div class="span7">
	                	<!-- The fileinput-button span is used to style the file input field as button -->
		            <span class="btn fileinput-button">
		            	<span><?php echo $admtext['addfiles']; ?></span>
		                <input type="file" name="files[]" multiple>
		            </span>&nbsp;
			        <input type="submit" class="btn start" value="<?php echo $admtext['startupl']; ?>"/>
			        <input type="reset" class="btn cancel" value="<?php echo $admtext['cancelupl']; ?>" >
			        <!--<input type="button" value="<?php echo $admtext['text_delete']; ?>">-->
				</div>
			</div>
	        <!-- The global progress information -->
	        <div class="span5 fileupload-progress fade">
	        	<!-- The global progress bar -->
	            <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
	            	<div class="bar" style="width:0%;"></div>
	            </div>
	            <!-- The extended global progress information -->
	            <div class="progress-extended">&nbsp;</div>
	        </div>
			<br clear="all"/>
	        <!-- The loading indicator is shown during file processing -->
	        <div class="fileupload-loading"></div>
	        <br>
		<div id="uploadarea">
        		<!-- The table listing the files available for upload/download -->
        		<table role="presentation" class="table table-striped normal"><tbody class="files"></tbody></table>
		</div>
	</form>

	<br/>

	<div style="float:left; margin-right: 20px">
		<form action="" method="get" name="find" id="linkerform" onsubmit="return validateForm();">
		<table cellspacing="2" class="normal">
			<tr>
				<td><?php echo $admtext['tree']; ?></td>
				<td><?php echo $admtext['linktype']; ?></td>
				<td colspan="3"><?php echo $admtext['id']; ?></td>
			</tr>
			<tr>
				<td valign="top">
					<select name="tree1">
<?php
		$treeresult = tng_query($treequery) or die ($admtext['cannotexecutequery'] . ": $treequery");
		while( $treerow = tng_fetch_assoc($treeresult) ) {
			echo "	<option value=\"{$treerow['gedcom']}\"";
			if( isset($tree) && $treerow['gedcom'] == $tree ) echo " selected";
			echo ">{$treerow['treename']}</option>\n";
		}
		tng_free_result($treeresult);
?>
					</select>
				</td>
				<td valign="top">
					<select name="linktype1" onchange="toggleEventLink(this.selectedIndex);">
						<option value="I"><?php echo $admtext['person']; ?></option>
						<option value="F"><?php echo $admtext['family']; ?></option>
						<option value="S"><?php echo $admtext['source']; ?></option>
						<option value="R"><?php echo $admtext['repository']; ?></option>
						<option value="L"><?php echo $admtext['place']; ?></option>
					</select>
				</td>
				<td><input type="text" name="newlink1" id="newlink1" value="<?php if( isset($personID) ) echo $personID; ?>" onblur="toggleEventRow(document.find.eventlink1.checked);"></td>
				<td><a href="#" onclick="return findItem(document.find.linktype1.options[document.find.linktype1.selectedIndex].value,'newlink1',null,document.find.tree1.options[document.find.tree1.selectedIndex].value,'<?php echo $assignedbranch; ?>');" title="<?php echo $admtext['find']; ?>" class="smallicon admin-find-icon"></a></td>
				<td>
			    	<input type="button" class="toggle" value="<?php echo $admtext['selectall']; ?>">
					<input type="submit" id="linker" value="<?php echo $admtext['linksel']; ?>">
				</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
				<td colspan="2">
					<span id="eventlink1" class="normal"><input type="checkbox" name="eventlink1" value="1" onclick="return toggleEventRow(this.checked);" /> <?php echo $admtext['eventlink']; ?></span><br />
					<select name="event1" id="eventrow1" style="display:none">
						<option value=""></option>
					</select>
				</td>
				<td class="normal" valign="top">&nbsp;</td>
			</tr>
		</table>
		</form>
	</div>
	<div>
		<form action="" method="get" name="find2" id="linkerform2" onsubmit="return validateForm2();">
		<table cellspacing="2" class="normal">
			<tr>
				<td colspan="3"><?php echo $admtext['cemetery']; ?></td>
			</tr>
			<tr>
				<td valign="top">
					<select name="cemeteryID" id="cemeteryID">
						<option value="" selected="selected"></option>
<?php
$query = "SELECT cemname, cemeteryID, city, county, state, country FROM $cemeteries_table ORDER BY cemname, city, county, state, country";
$cemresult = tng_query($query);
while( $cemrow = tng_fetch_assoc($cemresult) ) {
	$cemetery = "{$cemrow['cemname']} - {$cemrow['city']}, {$cemrow['county']}, {$cemrow['state']}, {$cemrow['country']}";
	echo "		<option value=\"{$cemrow['cemeteryID']}\">$cemetery</option>\n";
}
?>
					</select>
				</td>
				<td>
			    	<input type="button" class="toggle" value="<?php echo $admtext['selectall']; ?>">
					<input type="submit" id="linker2" value="<?php echo $admtext['linksel']; ?>">
				</td>
			</tr>
		</table>
		</form>
	</div>
	<p style="clear:both"><span id="linkermsg"></span>&nbsp;</p>
	</div>
</div>

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="preview"><span class="fade"></span></td>
        <td class="name"><span>{%=file.name%}</span></td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        {% if (file.error) { %}
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else if (o.files.valid && !i) { %}
            <td>
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
            </td>
            <td class="start">{% if (!o.options.autoUpload) { %}
                <button class="btn">
                    <span><?php echo $admtext['start']; ?></span>
                </button>
            {% } %}</td>
        {% } else { %}
            <td colspan="2"></td>
        {% } %}
        <td class="cancel">{% if (!i) { %}
            <button class="btn">
                <span><?php echo $admtext['cancel']; ?></span>
            </button>
        {% } %}</td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        {% if (file.error) { %}
            <td>&nbsp;</td>
            <td class="name"><span>{%=file.name%}</span></td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td class="error"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else { %}
            <td class="preview">{% if (file.thumbnail_url) { %}
                <img src="{%=file.thumbnail_url%}" class="thumb">
            {% } %}</td>
			<td>
				<?php echo $admtext['title2'] . "<hr/>\n" . $admtext['description']; ?><br/><br/>
				<button class="savebutton" id="q{%=file.mediaID%}" disabled="disabled">
					<span style="display:none"><?php echo $admtext['save']; ?></span><img src="img/tng_check.gif" alt="" id="ch{%=file.mediaID%}" />
				</button> &nbsp;
				<span id="spin{%=file.mediaID%}" style="visibility:hidden"><img src="img/spinner.gif" /></span>
			</td>
            <td class="name">
            	<form id="f{%=file.mediaID%}">
            		<input type="text" id="t{%=file.mediaID%}" value="{%=file.name%}" name="title" class="uploadfield" onkeypress="enableSave('{%=file.mediaID%}');" onpaste="enableSave('{%=file.mediaID%}');"/><br/>
            		<textarea id="d{%=file.mediaID%}" name="description" rows="3" class="uploadfield" onkeypress="enableSave('{%=file.mediaID%}');" onpaste="enableSave('{%=file.mediaID%}');"></textarea>
					<input type="hidden" id="mediaID" name="mediaID" value="{%=file.mediaID%}" />
					<table class="uploadmore">
						<tr>
							<td><?php echo $admtext['photoowner']; ?>:</td>
							<td><input type="text" id="o{%=file.mediaID%}" name="owner" value="" size="40" onkeypress="enableSave('{%=file.mediaID%}');" onpaste="enableSave('{%=file.mediaID%}');"></td>
						</tr>
						<tr>
							<td><?php echo $admtext['datetaken']; ?>:</td>
							<td><input type="text" id="k{%=file.mediaID%}" name="datetaken" value="" size="40" onblur="checkDate(this);" onkeypress="enableSave('{%=file.mediaID%}');" onpaste="enableSave('{%=file.mediaID%}');"></td>
						</tr>
					</table>
            	</form>	
            </td>
            <td class="size">
            	<button class="linksbutton" id="l{%=file.mediaID%}">
            		<span class="nw"><?php echo $admtext['medialinks']; ?></span>
            	</button><br/><br/>
            	<span>&nbsp;{%=file.dims%}</span><br/>
            	<span>&nbsp;{%=o.formatFileSize(file.size)%}</span><br/><br/>
				<span>&nbsp;<a href="admin_editmedia.php?mediaID={%=file.mediaID%}" target="_blank"><?php echo $admtext['edit']; ?></a>
            </td>
            <td>&nbsp;</td>
        {% } %}
        <td class="delete">
            <button class="delbutton" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %} onclick="return confirmDelete(event);">
                <span><?php echo $admtext['text_delete']; ?></span>
            </button><br/><br/>
            &nbsp;<?php echo $admtext['select']; ?>: <input type="checkbox" name="delete" value="1" class="mediacheck" id="{%=file.mediaID%}">

        </td>
    </tr>
{% } %}
</script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="js/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="js/tmpl.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="js/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="js/canvas-to-blob.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="js/jquery.fileupload.js"></script>
<!-- The File Upload file processing plugin -->
<script src="js/jquery.fileupload-fp.js"></script>
<!-- The File Upload user interface plugin -->
<script src="js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="js/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
<!--[if gte IE 8]><script src="js/cors/jquery.xdr-transport.js"></script><![endif]-->
<?php 
echo tng_adminfooter();
?>
