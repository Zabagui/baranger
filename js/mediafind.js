function getPotentialLinks(linktype) {
	var form = document.find2;
	var strParams = {tree: tree, linktype: linktype};

	switch(linktype) {
		case "I":
			strParams.lastname = form.mylastname.value;
			strParams.firstname = form.myfirstname.value;
			break;
		case "F":
			strParams.husbname = form.myhusbname.value;
			strParams.wifename = form.mywifename.value;
			break;
		case "S":
			strParams.title = form.mysourcetitle.value;
			break;
		case "R":
			strParams.title = form.myrepotitle.value;
			break;
		case "L":
			strParams.place = form.myplace.value;
			break;
	}
	if(searchstring) {
		doSpinner('find');

		if(type == "album")
			strParams.albumID = album;
		else
			strParams.mediaID = media;
		jQuery.ajax({
			url: 'admin_medialinksxml.php',
			data: strParams,
			dataType: 'html',
			success: function(req) {
				jQuery('#newlines').html(req);
				lastspinner.hide();
			}
		});
	}
	return false;
}

function doSpinner(id) {
	lastspinner = jQuery('#spinner'+id);
	lastspinner.show();
}

function toggleEventLink(index) {
	var eventlink = document.find.eventlink1;
	var event = document.find.event1;
	var newlink = document.find.newlink1;

	//blank out & deselect Event box
	if(event) {
		event.selectedIndex = 0;
		event.options.length = 0;
	}
	//blank out ID box
	if(index >= 0)
		newlink.value = "";

	//hide/reveal checkbox
	if( index > 3 ) {
		eventlink.style.display = 'none';
        jQuery('#eventlink1').hide();
    }
	else if( index >= 0 ) {
		eventlink.style.display = '';
        jQuery('#eventlink1').show();
    }

	//hide event row and uncheck box
	if(!findform) findform = "form1";
	if(event) {
		toggleEventRow(0);
		var check = document.find.eventlink1;
		check.checked = false;
	}
}

function toggleEventRow(check,entrynum) {
	var eventrow = jQuery('#eventrow1');
	if( check ) {
		var entity = document.find.newlink1;
		if( !entity.value ) return false;
		eventrow.show();
		var tree = document.find.tree1;
		var linktype = document.find.linktype1;
		fetchData(linktype.options[linktype.selectedIndex].value,entity.value,tree.options[tree.selectedIndex].value,entrynum);
	}
	else
		eventrow.hide();
	return true;
}

function fetchData(linktype,persfamID,tree,count) {
	var strParams = "persfamID=" + persfamID + "&tree=" + tree + "&linktype=" + linktype + "&count=" + count;
 	var loader1 = new net.ContentLoader('admin_mediaeventxml.php',fillList,null,"POST",strParams);
}

function createOption(olist,ovalue,otext) {
	if(navigator.appName == "Netscape") {
		olist.options[olist.options.length] = new Option(otext,ovalue,false,false)
	}
	else if( navigator.appName == "Microsoft Internet Explorer") {
		var newElem = document.createElement("OPTION");
		newElem.text = otext;
		newElem.value = ovalue;
		olist.options.add(newElem);
	}
}

function fillList() {
	var xmlDoc = this.req.responseXML.documentElement;
	var xCount = xmlDoc.getElementsByTagName('targetlist');
	var countnode = getTextNodes(xCount[0]);
	var count = countnode['target'].firstChild.nodeValue;

	var xEvent = xmlDoc.getElementsByTagName('event');
	var evnodes, eventID, displayval, info, displaystr, dest;

	//know which list to fill! (dest)
	dest = document.find.event1;

	//blank out list
	dest.options.length = 0;
	createOption(dest,'','');

	for(i=0; i < xEvent.length; i++) {
		evnodes = getTextNodes(xEvent[i]);
		eventID = evnodes['eventID'].firstChild.nodeValue;
		displayval = evnodes['display'].firstChild.nodeValue;
		info = evnodes['info'].firstChild.nodeValue;
		if( info != "-1" )
			displaystr = displayval + ": " + info;
		else
			displaystr = displayval;

		//fill list
		createOption(dest,eventID,displaystr);
	}
}

function getTextNodes(node) {
	var textNodes = new Array();

	for(var i = 0; i < node.childNodes.length; i++ ) {
		if( node.childNodes[i].nodeType == "1" ) {
			textNodes[node.childNodes[i].nodeName] = node.childNodes[i];
		}
	}
	return textNodes;
}

function selectEntity(field,entity) {
	field.value = entity;
	field.focus();
	tnglitbox.remove();
	//document.find.submit();
}

function deleteMedia2EntityLink(linkID) {
	if(confirm(confdellink)) {
		var tds = jQuery('tr#alink_'+linkID+' td');
		jQuery.each(tds,function(index,item){
			jQuery(item).effect('highlight',{color:'#ff9999'},200);
		});
		var params = {linkID:linkID,type:type,action:'dellink'};
		jQuery.ajax({
			url: 'ajx_updateorder.php',
			data: params,
			dataType: 'html',
			success: function(req){
				var pairs = req.split('&');
				var link = parseInt(pairs[0]);
				var entityID = pairs[1];
				jQuery('#alink_'+link).fadeOut(400);
				if(jQuery('#linked_'+entityID).length) {
					jQuery('#linked_'+entityID).hide();
					jQuery('#link_'+entityID).fadeIn(400);
				}
				linkcount = linkcount - 1;
				jQuery('#linkcount').html(linkcount);
			}
		});
	}
	return false;
}

function editMedia2EntityLink(linkID) {
	tnglitbox = new LITBox('admin_editmedialink.php?linkID='+linkID+'&type='+type,{width:500,height:380});
	return false;
}

function updateMedia2EntityLink(form) {
	var params = jQuery(form).serialize() + '&action=updatelink';
	jQuery.ajax({
		url: 'ajx_updateorder.php',
		data: params,
		dataType: 'html',
		success: function(req){
			var eventID = form.eventID;
			var linkID = form.linkID.value;
			jQuery('#event_'+linkID).html(eventID.selectedIndex ? eventID.options[eventID.selectedIndex].text : '&nbsp;');
			if(form.type.value != "album") {
				jQuery('#sort_'+linkID+' [href]').attr('href', function(i,a) {
					return a.replace( /(event1=)[0-9]+/ig, '$1'+eventID.options[eventID.selectedIndex].value );
				});
				jQuery('#alt_'+linkID).html((form.altdescription.value || form.altnotes.value) ? yesmsg : '&nbsp;');
				jQuery('#defc'+linkID).attr('checked',form.defphoto.checked);
				jQuery('#show'+linkID).attr('checked',form.show.checked);
			}
			tnglitbox.remove();
			jQuery('#event_'+linkID).effect('highlight',{},1400);
			if(form.type.value != "album") {
				jQuery('#sort_'+linkID).effect('highlight',{},1400);
				jQuery('#alt_'+linkID).effect('highlight',{},1400);
				jQuery('#def_'+linkID).effect('highlight',{},1400);
				jQuery('#show_'+linkID).effect('highlight',{},1400);
			}
		}
	});
	return false;
}

function addMedia2EntityLink(form, newEntityID, num) {
	if(newEntityID) {
		var entityID = decodeURIComponent(newEntityID);
		//form.newlink1.value = decodeURIComponent(entityID).replace(/\+/g,' ');
	}
	else
		var entityID = form.linktype1.options[form.linktype1.selectedIndex].value == "L" ? form.newlink1.value : form.newlink1.value.toUpperCase();
	if(!entityID)
		alert(linkmsg);
	else {
		var tree = form.tree1.options[form.tree1.selectedIndex].value;
		var linktype = form.linktype1.options[form.linktype1.selectedIndex].value;
		var params = {tree:tree,linktype:linktype,entityID:entityID,type:type,action:'addlink'};
		if(type == "album")
			params.albumID = album;
		else
			params.mediaID = media;
		jQuery.ajax({
			url: 'ajx_updateorder.php',
			data: params,
			dataType: 'html',
			success: function(req){
				if(req == "1") {
					jQuery('#alink_error').html(duplinkmsg);
					jQuery('#alink_error').fadeIn(200);
				}
				else if(req.responseText == "2") {
					jQuery('#alink_error').html(invlinkmsg);
					jQuery('#alink_error').fadeIn(200);
				}
				else {
					jQuery('#alink_error').html('');
					jQuery('#alink_error').fadeOut(200);
			
					var vars = req.split('|');
					var linkID = parseInt(vars[0]);
					var name = decodeURIComponent(vars[1]);
					var hasthumb = parseInt(vars[2]);
					var mediatypeID = vars[3];

					//var linkID = parseInt(req);
					var newrow;
					//if(linktype == "L") entityID = "";
					//var entityID = linktype != "L" ? form.newlink1.value : "";
					var displayID = linktype != "L" ? ' (' + entityID + ')' : "";
					var dims = "width=\"20\" height=\"20\" class=\"smallicon\"";
					var treename = form.tree1.options[form.tree1.selectedIndex].text;
					var treeID = form.tree1.options[form.tree1.selectedIndex].value;
					var linktext = form.linktype1.options[form.linktype1.selectedIndex].text;

					if(jQuery('#linkcount').length) {
						linkcount = linkcount + 1;
						jQuery('#linkcount').html(linkcount);
					}

					var linktable = document.getElementById('linktable');
					//var newtr = linktable.insertRow(linktable.rows.length);
					var newtr = linktable.insertRow(1);
					newtr.id = 'alink_' + linkID;
					newtr.setAttribute('style','display:none');

					var actionbuttons = '<a href="#" title="' + edit_text + '" onclick="return editMedia2EntityLink(' + linkID + ');"><img src="img/tng_aedit.gif" alt="' + edit_text + '" ' + 'class="smallicon admin-edit-icon"/></a>';
					actionbuttons += '<a href="#" title="' + remove_text + '" onclick="return deleteMedia2EntityLink(' + linkID + ');"><img src="img/tng_delete.gif" alt="' + remove_text + '" ' +'class="smallicon admin-delete-icon"/></a>';
					var td0 = insertCell(newtr,0,"lightback normal",actionbuttons);
					td0.setAttribute('align','center');
					insertCell(newtr,1,"lightback normal",linktext);
					var sortlink = type != "album" && linktype != "C" ? ' (<a href="admin_ordermedia.php?tree1=' + treeID + '&amp;linktype1=' + linktype + '&amp;mediatypeID=' + mediatypeID + '&amp;newlink1=' + entityID + '&amp;event1=">' + sortmsg + '</a>)' : '';
					insertCell(newtr,2,"lightback normal",name + displayID + sortlink);
					insertCell(newtr,3,"lightback normal",treename + '&nbsp;');

					var td4 = insertCell(newtr,4,"lightback normal",'&nbsp;')
					td4.id = 'event_'+linkID;

					if(type == "media") {
						var td5 = insertCell(newtr,5,"lightback normal",'&nbsp;')
						td5.id = 'alt_'+linkID;
						//var defphoto = vars[2] == "1" ? yestext : "";
						var makedefmsg = linktype == "C" ? "" : '<input type="checkbox" name="defc'+linkID+'" id="defc'+linkID+'" onclick="toggleDefault(this,\''+tree+'\',\''+entityID+'\');" value="1"/>';
						var td6 = insertCell(newtr,6,"lightback normal",makedefmsg);
						td6.id = 'def_'+linkID;
						td6.setAttribute('align','center');
						var td7 = insertCell(newtr,7,"lightback normal",'<input type="checkbox" name="show'+linkID+'" id="show'+linkID+'" onclick="toggleShow(this);" value="1" checked="checked"/>');
						td7.id = 'show_'+linkID;
						td7.setAttribute('align','center');
					}

					jQuery('#alink_'+linkID).fadeIn(400, function(){
						var tds = jQuery('tr#alink_'+linkID+' td');
						jQuery.each(tds,function(index,item){
							jQuery(item).effect('highlight',{},1200);
						});
					});

					//strip slashes and apostrophes
					var id = linktype == "L" ? num : entityID;
					if(jQuery('#link_'+id).length) {
						jQuery('#link_'+id).hide();
						if(hasthumb == "1" && type == "media")
							jQuery('#sdef_'+entityID).html('<a href="#" onclick="return setDefault(' + linkID + ',\'' + treeID + '\',\'' + entityID + '\');" class="smallest">' + makedefaultmsg + '</a>');
						jQuery('#linked_'+id).fadeIn(400);
					}
					jQuery('#nolinks').hide();
				}
			}
		});
	}
	return false;
}

function newlinkEnter(form,field,e) {
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return true;
	if(keycode == 13)
	    	return addMedia2EntityLink(form);
	else
		return true;
}