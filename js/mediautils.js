var gsControlName = "";
function FilePicker( sControl, collection, folders ) {
   gsControlName = sControl;

   var origsearch = document.getElementById(sControl + "_org");
   if(origsearch) {
	   var lastsearch = document.getElementById(sControl + "_last");
	   var searchstring = document.getElementById(sControl);
	   var sendstring = searchstring.value;

	   if( searchstring.value ) {
	   	if( searchstring.value == origsearch.value || searchstring.value == lastsearch.value ) {
			sendstring = "";
			lastsearch.value = "";
		}
		else
			lastsearch.value = searchstring.value;
	   }
   }
   else
	   sendstring = "";
   var folderstr = folders ? "&folders=1" : "";
   tnglitbox = new LITBox("admin_filepicker.php?path=" + collection + "&searchstring=" + sendstring + folderstr,{width:850,height:600});
}

function ReturnFile(sFileName) {
	jQuery('#'+gsControlName).val(sFileName);
	if(gsControlName == "path")
		prepopulateThumb();
	tnglitbox.remove();
}

function moreFilepicker(args) {
	jQuery.ajax({
		url: 'admin_filepicker.php',
		data: args,
		dataType: 'html',
		success: function(req) {
			tnglitbox.d4.innerHTML = req;
		}
	});
	return false;
}

function ShowFile(sFileName) {
   window.open(escape(sFileName), "File", "width=400,height=250,status=no,resizable=yes,scrollbars=yes");
}

function confirmDeleteFile(row,filepath) {
	if(confirm(confdeletefile))
		deleteIt('file',row,filepath);
	return false;
}

function setDefault(linkID,tree,entity) {
	var params = {action:'setdef2',tree:tree,entity:entity,media:media};
	jQuery.ajax({
		url: 'ajx_updateorder.php',
		data: params,
		dataType: 'html',
		success: function(req){
			jQuery('#sdef_'+entity).hide();
			jQuery('#defc'+linkID).attr('checked',true);
		}
	})
	return false;
}

function populatePath(source, dest) {
	var lastslash, temp;

	dest.value = "";
	temp = source.value.replace(/\\/g,"/");
	lastslash = temp.lastIndexOf("/") + 1;
	if( lastslash > 0)
		dest.value = source.value.slice(lastslash);
        else
                dest.value = source.value;

	//var imgmap = document.getElementById("imgmaprow");
	var lastperiod = source.value.lastIndexOf(".") + 1
	var ext = source.value.slice(lastperiod);
	ext = ext.toUpperCase();
	if( ext == "JPG" || ext == "GIF" || ext == "PNG" || ext == "JPEG" || ext == "GIFF" ) {
		//imgmap.style.display='';
		document.form1.thumbcreate[1].style.visibility = 'visible';
	}
	else {
		imgmap.style.display='none';
		document.form1.thumbcreate[0].checked = 'true';
		document.form1.thumbcreate[1].style.visibility = 'hidden';
		document.form1.newthumb.style.visibility='visible';
		document.form1.thumbselect.style.visibility='visible';
	}
}

function prepopulateThumb() {
	var path = document.form1.path;
	var lastslash = path.value.lastIndexOf("/") + 1;
	var lastperiod = path.value.lastIndexOf(".");
	var thumbpath = document.form1.thumbpath;

	thumbpath.value = "";
	if( lastslash )
		thumbpath.value = path.value.slice(0, lastslash);
	thumbpath.value = thumbpath.value + thumbprefix;
	if( lastperiod >= 0 )
		thumbpath.value = thumbpath.value + path.value.slice(lastslash,lastperiod) + thumbsuffix + path.value.slice(lastperiod);
	else
		thumbpath.value = thumbpath.value + path.value.slice(lastslash) + thumbsuffix;
}

function switchOnType(mtypeIndex, ext) {
	var mediatypeID = like[mtypeIndex];
	if( mediatypeID == "photos" ) {
	}
	else {
	}
	if( mediatypeID == "headstones" ) {
		jQuery('#maprow').fadeIn(200);
		jQuery('#linktocemrow').fadeIn(200);
		//new Effect.Appear('cemrow',{duration:.2});
		jQuery('#hsplotrow').fadeIn(200);
		jQuery('#hsstatrow').fadeIn(200);
		toggleCemSelect();
	}
	else {
		jQuery('#maprow').fadeOut(200);
		jQuery('#linktocemrow').fadeOut(200);
		//new Effect.Fade('cemrow',{duration:.2});
		jQuery('#hsplotrow').fadeOut(200);
		jQuery('#hsstatrow').fadeOut(200);
	}
	if( mediatypeID == "documents" ) {
	}
	else {
	}
	if( mediatypeID == "recordings" ) {
	}
	else {
	}
	if( mediatypeID == "videos" || ext == "PDF") {
		jQuery('#vidrow1').fadeIn(200);
		jQuery('#vidrow2').fadeIn(200);
	}
	else {
		jQuery('#vidrow1').fadeOut(200);
		jQuery('#vidrow2').fadeOut(200);
	}
	if(mtypeIndex && stmediatypes.indexOf(mtypeIndex) == -1) {
		if(jQuery('#editmediatype').length) jQuery('#editmediatype').show();
		if(jQuery('#delmediatype').length) jQuery('#delmediatype').show();
	}
	else {
		if(jQuery('#editmediatype').length) jQuery('#editmediatype').hide();
		if(jQuery('#delmediatype').length) jQuery('#delmediatype').hide();
	}
}

function toggleMediaURL() {
	var abspath = document.getElementById("abspathrow");
	var path = document.getElementById("pathrow");
	var img = document.getElementById("imgrow");
	var imgmap = document.getElementById("imgmaprow");

	if(document.form1.abspath.checked) {
		abspath.style.display = '';
		path.style.display = 'none';
		img.style.display = 'none';
		if(imgmap) imgmap.style.display='none';
		if(document.form1.thumbcreate) {
			document.form1.thumbcreate[1].checked = 'true';
			document.form1.thumbcreate[0].style.visibility = 'hidden';
		}
		document.form1.newthumb.style.visibility='visible';
		document.form1.thumbselect.style.visibility='visible';
	}
	else {
		abspath.style.display = 'none';
		path.style.display = '';
		img.style.display = '';
		if(imgmap) imgmap.style.display='';
		if(document.form1.thumbcreate)
			document.form1.thumbcreate[0].style.visibility = 'visible';
	}
}

var firstclick = true;
var x1, y1, x2, y2, radius;
var Coordinate_X_InImage;
var Coordinate_Y_InImage;
Coordinate_X_InImage = Coordinate_Y_InImage = 0;

function imageClick(photoID) {
	var shapeobj = document.form1.shape;
    var tree = document.form1.maptree.options[document.form1.maptree.selectedIndex].value;
	var shape;

	//GetCoordinatesInImage();

	if( shapeobj[0].checked )
		shape = shapeobj[0].value;
	else
		shape = shapeobj[1].value;

    if( firstclick ) {
		x1 = Coordinate_X_InImage;
	    y1 = Coordinate_Y_InImage;
		firstclick = false;
	}
	else {
		if( shape == "circle" ) {
			x2 = "";
			y2 = "";
		    radius = Math.ceil(Math.sqrt( Math.pow(Coordinate_X_InImage - x1, 2) + Math.pow(Coordinate_Y_InImage - y1, 2)));
		}
		else {
			x2 = Coordinate_X_InImage;
		    y2 = Coordinate_Y_InImage;
			radius = "";
		}
		findItem('I','imagemap','',tree, assignedbranch);
		firstclick = true;
    }
}

function init(){
	if(document.getElementById('pic')) {
		if(document.addEventListener) {
			document.getElementById('pic').addEventListener("mousedown",GetCoordinatesInImage, false);
		}else if(window.event && document.getElementById) {
			document.getElementById('pic').onmousedown = GetCoordinatesInImage;
		}
	}
}

function GetCoordinatesInImage(evt){
	if(window.event && !window.opera && typeof event.offsetX == "number") {
		// IE 5+
		Coordinate_X_InImage = event.offsetX;
		Coordinate_Y_InImage = event.offsetY;
	} else if(document.addEventListener && evt && typeof evt.pageX == "number"){
		// Mozilla-based browsers
		var Element = evt.target;
		var CalculatedTotalOffsetLeft, CalculatedTotalOffsetTop;
		CalculatedTotalOffsetLeft = CalculatedTotalOffsetTop = 0;
		while (Element.offsetParent) {
			CalculatedTotalOffsetLeft += Element.offsetLeft ;
			CalculatedTotalOffsetTop += Element.offsetTop ;
			Element = Element.offsetParent ;
		}
		Coordinate_X_InImage = evt.pageX - CalculatedTotalOffsetLeft ;
		Coordinate_Y_InImage = evt.pageY - CalculatedTotalOffsetTop ;
	}
}

function getTree(treeobj) {
	if( treeobj.options.length )
		return treeobj.options[treeobj.selectedIndex].value;
	else {
		alert(selectmsg);
		return false;
	}
}
function generateThumbs(form) {
	jQuery('#thumbresults').html("");
	jQuery('#thumbresults').hide();
	var regenerate = form.regenerate.checked ? 1 : "";
	var repath = form.repath.checked ? 1 : "";
	jQuery('#thumbspin').show();
	var params = {regenerate:regenerate,repath:repath};
	jQuery.ajax({
		url: 'admin_generatethumbs.php',
		data: params,
		dataType: 'html',
		success: function(req) {
			jQuery('#thumbresults').html(req);
			jQuery('#thumbresults').fadeIn(400);
			jQuery('#thumbspin').hide();
		}
	});
	return false;
}

function assignDefaults(form) {
	jQuery('#defresults').html("");
	jQuery('#defresults').hide();
	var overwrite = form.overwritedefs.checked ? 1 : "";
	var tree = form.tree.options[form.tree.selectedIndex].value;
	jQuery('#defspin').show();
	var params = {overwritedefs:overwrite,tree:tree};
	jQuery.ajax({
		url: 'admin_defphotos.php',
		data: params,
		dataType: 'html',
		success: function(req) {
			jQuery('#defresults').html(req);
			jQuery('#defresults').fadeIn(400);
			jQuery('#defspin').hide();
		}
	});
	return false;
}

function attemptDelete(entity, entityname) {
	if( entity.options[entity.selectedIndex].value.length == 0 ) {
		alert(nothingtodelete);
	}
	else if( confirm(confdeleteentity + ' ' + entityname + '?' )) {
		params = {entity: entityname, delitem: entity.options[entity.selectedIndex].value};
		jQuery.ajax({
			url: 'admin_deleteentity.php',
			data: params,
			dataType: 'html',
			success: function(req){
				RemovefromDisplay(entity);
				entity.selectedIndex = 0;
			}
		})
	}
}

function addEntity(form) {
	if( form.newitem.value.length == 0 )
		alert(pleaseenter + ' ' + form.entity.value);
	else {
		var params = jQuery(form).serialize();
		jQuery.ajax({
			url: 'admin_addentity.php',
			data: params,
			dataType: 'html',
			success: function(req){
				jQuery('#entitymsg').html(req);
				var entity = form.entity.value == 'state' ? document.form1.state : document.form1.country;
				var i = entity.options.length;
				if(navigator.appName == "Netscape") {
					entity.options[i] = new Option(form.newitem.value,form.newitem.value,false,false)
				}
				else if( navigator.appName == "Microsoft Internet Explorer") {
					entity.add(document.createElement("OPTION"));
					entity.options[i].text=form.newitem.value;
					entity.options[i].value=form.newitem.value;
				}
				entity.selectedIndex = i;
				form.newitem.value = '';
			}
		});
	}
	return false;
}

function addCollection(form) {
	if(form.collid.value == "")
		alert(entercollid);
	else if(form.display.value == "")
		alert(entercolldisplay);
	else if(form.path.value == "")
		alert(entercollpath);
	else if(form.icon.value == "")
		alert(entercollicon);
	else {
		jQuery('#cerrormsg').hide();
		var params = jQuery(form).serialize();
		jQuery.ajax({
			url: 'admin_addcollection.php',
			data: params,
			type: 'POST',
			dataType: 'html',
			success: function(req){
				if(req != "0") {
					var field = document.form1.mediatypeID;
					var i = field.options.length;
					if(navigator.appName == "Netscape") {
						field.options[i] = new Option(form.display.value,req,false,false)
					}
					else if( navigator.appName == "Microsoft Internet Explorer") {
						field.add(document.createElement("OPTION"));
						field.options[i].text=form.display.value;
						field.options[i].value=req;
					}
					field.selectedIndex = i;
					if(allow_edit) jQuery('#editmediatype').show();
					if(allow_delete) jQuery('#delmediatype').show();
					if(!manage) {
						var likeidx = form.liketype.options[form.liketype.selectedIndex].value;
						like[form.collid.value] = likeidx;
						switchOnType(form.collid.value);
					}
					tnglitbox.remove();
				}
				else
					jQuery('#cerrormsg').show();
			}
		});
	}
	return false;
}

function editMediatype(field){
	var mediatypeID = field.options[field.selectedIndex].value;
	var fieldname = field.name;
	tnglitbox = new LITBox('admin_editcollection.php?field='+fieldname+'&mediatypeID='+mediatypeID+'&selidx='+field.selectedIndex,{width:600,height:340});
}

function updateCollection(form) {
	if(form.display.value == "")
		alert(entercolldisplay);
	else if(form.path.value == "")
		alert(entercollpath);
	else if(form.icon.value == "")
		alert(entercollicon);
	else {
		var params = jQuery(form).serialize();
		jQuery.ajax({
			url: 'admin_updatecollection.php',
			data: params,
			type: 'POST',
			dataType: 'html',
			success: function(req){
				var field = eval('document.form1.'+form.field.value);
				field.options[form.selidx.value].text = form.display.value;
				tnglitbox.remove();
				if(!manage) {
					var likeidx = form.liketype.options[form.liketype.selectedIndex].value;
					like[form.collid.value] = likeidx;
					switchOnType(form.collid.value);
				}
			}
		});
	}
	return false;
}

function confirmDeleteMediatype(mediatypeID){
	if(confirm(confmtdelete)) {
		var params = {t: 'mediatype', id: mediatypeID.options[mediatypeID.selectedIndex].value};
		jQuery.ajax({
			url: 'ajx_delete.php',
			data: params,
			dataType: 'html',
			success: function(req){
				if(navigator.appName == "Netscape")
					mediatypeID.options[mediatypeID.selectedIndex] = null;
				else if( navigator.appName == "Microsoft Internet Explorer")
					mediatypeID.options.remove(mediatypeID.selectedIndex);
				mediatypeID.selectedIndex = 0;
				toggleHeadstoneCriteria('');
			}
		});
	}
}

// form startup
function startMediaSort() {
	jQuery('#orderdivs').sortable({
		helper: 'clone',
		axis:'y',
		scroll: false,
		items: '.sortrow',
		update:updateMediaOrder
	});
}

function updateMediaOrder(event,ui) {
	var linklist = removePrefixFromArray(jQuery('#orderdivs').sortable('toArray'), 'orderdivs_');

	jQuery('input.movefields').each(function(index, item) {
		item.value = index + 1;
	});

	var params = {sequence:linklist.join(','),album:album,action:orderaction};
	jQuery.ajax({
		url: cmstngpath + 'ajx_updateorder.php',
		data: params,
		dataType: 'html'
	});
}

function moveItemInList(elname, pos) {
	var el = jQuery('#orderdivs_'+elname);
	var sortrows = jQuery('div.sortrow');
	var current = 1;
	var count = 0;
	var found = false;
	var needAppend = false;
	jQuery.each(sortrows,function(index,item) {
		if(item.id == 'orderdivs_'+elname)
			found = true;
		if(!found)
			current++;
		count++;
	});
	var posnum = parseInt(pos);
	if(current > posnum)
		posnum--;
	else if(posnum >= count) {
		posnum--;
		needAppend = true;
	}
	var targetrow = jQuery(sortrows[posnum]);
	if(el != targetrow) {
		var newnode = el.clone(true);

		var sourcePos = el.offset();
        	var targetPos = targetrow.offset();

		var targetVert = sourcePos.top - targetPos.top;
        	el.animate({ 'top': '-=' + targetVert}, 1000, 'swing', function(){ 
			el.remove();
			if(needAppend)
				jQuery('#orderdivs').append(newnode);
			else
				newnode.insertBefore(targetrow);
			jQuery('#orderdivs').sortable('destroy');
			startMediaSort();
			updateMediaOrder('orderdivs');
        });
	}

	return false;
}

function handleMediaEnter(elname, pos, e) {
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return true;
	if(keycode == 13) {
	    	moveItemInList(elname, pos);
    		return false;
	}
	else
		return true;
}

function removeFromSort(type,link) {
	var params = {type:type,sortlink:link,action:'remsort'};
	jQuery.ajax({
		url: cmstngpath + 'ajx_updateorder.php',
		data: params,
		dataType: 'html',
		success: function(req) {
			item = parseInt(req);
			jQuery('#orderdivs_' + item).fadeOut(400,function(){
				jQuery('#orderdivs_' + item).remove();
			});
		}
	});
	return false;
}

function openFindAny(linktype) {
	var linktypes = new Array('I','F','S','R','L');

	jQuery.each(linktypes,function(index,thistype) {
		if(thistype != linktype && jQuery('#findform'+thistype).css('display') != 'none')
			jQuery('#findform'+thistype).hide();
		}
	);
	if(jQuery('#findform'+linktype).css('display') == 'none')
		jQuery('#findform'+linktype).fadeIn(400);
}

function switchLinktypes(select) {
	if(findopen) {
		openFindAny(select.options[select.selectedIndex].value);
		jQuery('#newlines').html(resheremsg);
		jQuery('#find2').children().each(function(index,item) {
			if(item.type == "text") item.value = "";
		});
	}
}

function resetFindFields(section,fields) {
	jQuery('#newlines').html('');
	var field;
	for(var i=0; i<fields.length; i++) {
		field = eval("document.find2."+fields[i]);
		field.value = '';
	}
	jQuery('#'+section).fadeOut(200);
}

function toggleShow(checkbox) {
	var toggle = checkbox.checked ? 0 : 1;
	var medialinkID = checkbox.name.substr(4);
	var params = {medialinkID:medialinkID,toggle:toggle,action:'show'};
	jQuery.ajax({
		url: cmstngpath + 'ajx_updateorder.php',
		data: params
	});
}

function toggleDefault(checkbox,tree,entityID) {
	var toggle = checkbox.checked ? 1 : 0;
	var medialinkID = checkbox.name.substr(4);
	var params = {medialinkID:medialinkID,tree:tree,entity:entityID,toggle:toggle,action:'setdef3'};
	jQuery.ajax({
		url: cmstngpath + 'ajx_updateorder.php',
		data: params
	});
}

function toggleCemSelect() {
	jQuery('#cemchoice').hide();
	jQuery('#cemselect').show();
	
	return false;
}
