function startMostWanted() {
	jQuery('#orderpersondivs').sortable({dropOnEmpty:true, tag:'div', connectWith: '#orderphotodivs', update:updatePersonOrder});
	jQuery('#orderphotodivs').sortable({dropOnEmpty:true, tag:'div', connectWith: '#orderpersondivs', update:updatePhotoOrder});
}

function updatePersonOrder(event, ui) {
	updateMostWantedOrder('person');
}

function updatePhotoOrder(event, ui) {
	updateMostWantedOrder('photo');
}

function updateMostWantedOrder(mwtype) {
	if(mwtype == "person")
		var linklist = removePrefixFromArray(jQuery('#orderpersondivs').sortable('toArray'), 'orderpersondivs_');
	else
		var linklist = removePrefixFromArray(jQuery('#orderphotodivs').sortable('toArray'), 'orderphotodivs_');

	var params = {sequence:linklist.join(','),mwtype:mwtype,action:'mworder'};
	jQuery.ajax({
		url: cmstngpath + 'ajx_updateorder.php',
		data: params,
		dataType: 'html'
	});
}

function openMostWanted(mwtype,ID) {
	mwlitbox = new LITBox('admin_editmostwanted.php?mwtype='+mwtype+'&ID='+ID,{width:645,height:540});
	return false;
}

function openMostWantedMediaFind(tree) {
	tnglitbox = new LITBox('admin_findmwmedia.php?tree='+tree,{width:640,height:540});
	return false;
}

function updateMostWanted(form) {
	if( form.title.value.length == 0)
		alert(entertitle);
	else if(form.description.value.length == 0)
		alert(enterdesc);
	else {
		var params = jQuery(form).serialize();
		jQuery.ajax({
			url: 'admin_updatemostwanted.php',
			data: params,
			type: 'post',
			dataType: 'json',
			success: function(vars){
				if(form.ID.value) {
					//if its old, just update existing row and highlight
					jQuery('#title_'+vars.ID).html(vars.title);
					jQuery('#desc_'+vars.ID).html(vars.description);
					//update thumbnail if necessary
					if(vars.thumbpath) {
						jQuery('#img_'+vars.ID).attr('src',vars.thumbpath);
						jQuery('#img_'+vars.ID).css('width',vars.width +'px');
						jQuery('#img_'+vars.ID).css('height',vars.height +'px');
					}
				}
				else {
					//if it's new, then insert row at bottom
					var newcontent = '<div class="sortrow" id="order' + vars.mwtype + 'divs_' + vars.ID + '" style="clear:both" onmouseover="showEditDelete(\'' + vars.ID + '\');" onmouseout="hideEditDelete(\'' + vars.ID + '\');">\n';
					newcontent += '<table width="100%" cellpadding="5" cellspacing="1"><tr id="row_' + vars.ID + '">\n';
					newcontent += '<td class="dragarea normal">\n';
					newcontent += '<img src="img/admArrowUp.gif" alt=""><br/>' + drag + '<br/><img src="img/admArrowDown.gif" alt="">\n';
					newcontent += '</td>\n';
					newcontent += '<td class="lightback" style="width:' + thumbwidth + 'px;text-align:center;">\n';
					if(vars.thumbpath)
						newcontent += '<img src="' + vars.thumbpath + '" border="0" width="' + vars.width + '" height="' + vars.height + '" id="img_' + vars.ID + '" alt="' + vars.description + '" />\n';
					else
						newcontent += "&nbsp;";

					newcontent += '</td>\n';
					newcontent += '<td class="lightback normal">\n';
					if(vars.edit)
				   		newcontent += '<a href="#" onclick="return openMostWanted(\'' + vars.mwtype + '\',\'' + vars.ID + '\');" id="title_' + vars.ID + '">' + vars.title + '</a>\n';
					else
				   		newcontent += '<u id="title_' + vars.ID + '">' + vars.title + '</u>\n';
					newcontent += '<br /><span id="desc_' + vars.ID + '">' + vars.description + '</span><br />\n';
					newcontent += '<div id="del_' + vars.ID + '" class="smaller" style="color:gray;visibility:hidden">\n';
					if(vars.edit) {
				   		newcontent += '<a href="#" onclick="return openMostWanted(\'' + vars.mwtype + '\',\'' + vars.ID + '\');">' + edittext + '</a>\n';
						if(vars.del)
							newcontent += ' | ';
					}
					if(vars.del)
						newcontent += '<a href="#" onclick="return removeFromMostWanted(\'' + vars.mwtype + '\',\'' + vars.ID + '\');">' + deltext + '</a>\n';
					newcontent += '</div>\n</td>\n</tr></table>\n</div>\n';
					jQuery('#order'+vars.mwtype+'divs').html(newcontent + jQuery('#order'+vars.mwtype+'divs').html());
					if(vars.mwtype == 'person')
						jQuery('#orderpersondivs').sortable({dropOnEmpty:true, tag:'div', connectWith: '#orderphotodivs', update:updatePersonOrder});
					else
						jQuery('#orderphotodivs').sortable({dropOnEmpty:true, tag:'div', connectWith: '#orderpersondivs', update:updatePhotoOrder});
				}

				var tds = jQuery('tr#row_'+vars.ID+' td');
				mwlitbox.remove();
				jQuery.each(tds,function(index,item){
					jQuery(item).effect('highlight',{},2000);
				});
			}
		});
	}
	return false;
}

function removeFromMostWanted(type,id) {
	if(confirm(confremmw)) {
		var params = {id:id,action:'remmostwanted'};
		jQuery.ajax({
			url: 'ajx_updateorder.php',
			data: params,
			dataType: 'html',
			success: function(){
				jQuery('#order'+type+'divs_' + id).fadeOut(400, function(){
					jQuery('#order'+type+'divs_' + id).remove();
					if(type == 'person')
						jQuery('#orderpersondivs').sortable({dropOnEmpty:true, tag:'div', connectWith: '#orderphotodivs', update:updatePersonOrder});
					else
						jQuery('#orderphotodivs').sortable({dropOnEmpty:true, tag:'div', connectWith: '#orderpersondivs', update:updatePhotoOrder});
				});
			}
		});
	}
	return false;
}

function showEditDelete(id) {
	if(jQuery('#del_'+id).length)
		jQuery('#del_'+id).css('visibility','visible');
}

function hideEditDelete(id) {
	if(jQuery('#del_'+id).length)
		jQuery('#del_'+id).css('visibility','hidden');
}

function getNewMwMedia(form) {
	var hsstring;
	var searchstring = form.searchstring.value;

	doSpinner(1);
	jQuery('#newmedia').html('');
	var searchtree = form.tree.value;
	var mediatypeID = form.mediatypeID.value;

	var strParams = {searchstring:searchstring, searchtree:searchtree, mediatypeID:mediatypeID};
	jQuery.ajax({
		url: 'admin_add2albumxml.php',
		data: strParams,
		dataType: 'html',
		success: showMedia
	});
}

function getMoreMedia(searchstring, mediatypeID, hsstat, cemeteryID, offset, tree, page, albumID) {
	var params = {
		searchstring: searchstring, 
		mediatypeID: mediatypeID, 
		hsstat: hsstat, 
		cemeteryID: cemeteryID, 
		offset: offset,
		tree: tree,
		page: page,
		albumID: albumID
	};
	jQuery.ajax({
		url: 'admin_add2albumxml.php',
		data: params,
		dataType: 'html',
		success: showMedia
	});
	return false;
}

function showMedia(req) {
	jQuery('#newmedia').html(req);
	jQuery('#spinner1').hide();
}

function doSpinner(id) {
	lastspinner = jQuery('#spinner'+id);
	jQuery('#spinner'+id).show();
}

function selectMedia(mediaID) {
	document.editmostwanted.mediaID.value = mediaID;
	jQuery('#mwthumb').html("&nbsp;");
	jQuery('#mwdetails').html(loading);

	jQuery.ajax({
		url: 'admin_getphotodetails.php',
		data: {mediaID: mediaID},
		dataType: 'html',
		success: function(req){
			jQuery('#mwphoto').html(req);
		}
	});

	tnglitbox.remove();
	return false;
}