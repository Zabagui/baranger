function toggleHeadstoneCriteria(form,mediatypeID) {
	var hsstatus = jQuery('#hsstatrow');
	var cemrow = jQuery('#cemrow');
	if( mediatypeID == 'headstones' ) {
		jQuery('#newmedia').css('height','380px');
		cemrow.show();
		hsstatus.show();
	}
	else {
		jQuery('#newmedia').css('height','430px');
		cemrow.hide();
		form.cemeteryID.selectedIndex = 0;
		hsstatus.hide();
		form.hsstat.selectedIndex = 0;
	}
	return false;
}

function getNewMedia(form,flag) {
	var hsstring;
	var searchstring = form.searchstring.value;
	if(searchstring) {
		doSpinner(1);
		jQuery('#newmedia').html('');
		var searchtree = form.searchtree.options[form.searchtree.selectedIndex].value;
		var mediatypeID = form.mediatypeID.options[form.mediatypeID.selectedIndex].value;
		var params = {albumID: album, searchstring: searchstring, searchtree: searchtree, mediatypeID: mediatypeID};

		if( mediatypeID == "headstones") {
			var hsstat = form.hsstat.options[form.hsstat.selectedIndex].value;
			var cemeteryID = form.cemeteryID.options[form.cemeteryID.selectedIndex].value;
			params.hsstat = hsstat;
			params.cemeteryID = cemeteryID;
		}

		jQuery.ajax({
			url: 'admin_add2albumxml.php',
			data: params,
			dataType: 'html',
			success: showMedia
		});
	}
	else if(flag)
		alert(searchmsg);
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

function addToAlbum(media) {
	var params = {media:media,album:album,action:'add'};
	jQuery.ajax({
		url: 'ajx_updateorder.php',
		data: params,
		dataType: 'html',
		success: finishAddToAlbum
	});
	return false;
}

function finishAddToAlbum(req) {
	var newrow;
	
	var pairs = req.split('&');
	var media = parseInt(pairs[0]);
	var albumlink = parseInt(pairs[1]);
	
	var newnum = jQuery('.sortrow').length + 1;

	newrow = '<table width="100%" cellpadding="5" cellspacing="1"><tr>\n';
	newrow += '<td class="dragarea normal">';
	newrow += '<img src="img/admArrowUp.gif" alt=""><br/>' + dragmsg + '<br/><img src="img/admArrowDown.gif" alt="">\n';
	newrow += '</td>\n';

	newrow += '<td class="lightback smaller" style="width:35px;text-align:center\">';
	newrow += '<div style=\"padding-bottom:5px\"><a href="#" onclick="return moveItemInList(\'' + albumlink + '\',1);" title="' + movetopmsg + '"><img src="img/admArrowUp.gif" alt="" border="0"><br/>Top</a></div>\n';
 	newrow += '<input style="width:30px" class="movefields" name="move' + albumlink + '" id="move' + albumlink + '" value="' + newnum + '" onkeypress="return handleMediaEnter(\'' + albumlink + '\',jQuery(\'#move' + albumlink + '\').val(),event);" />\n';
 	newrow += '<a href="#" onclick="return moveItemInList(\'' + albumlink + '\',jQuery(\'#move' + albumlink + '\').val());" title="' + movetopmsg + '">Go</a>';
	newrow += '</td>\n';

	newrow += '<td class="lightback" style="width:' + (thumbmaxw+6) + 'px;text-align:center;">' + jQuery('#thumbcell_'+media).html() +  '</td>\n';
	newrow += '<td class="lightback normal">' + jQuery('#desc_'+media).html();
	newrow += '<div id="del_' + albumlink + '" class="smaller" style="color:gray;visibility:hidden">';
	if(jQuery('#thumbcell_'+media).html() != "&nbsp;") {
		newrow += '<input type="radio" name="rthumbs" value="r' + media + '" onclick="makeDefault(this);">' + mkdefaultmsg;
		newrow += ' &nbsp;|&nbsp; ';
	}
	newrow += '<a href="#" onclick="return removeFromAlbum(\'' + media + '\',\'' + albumlink + '\');">' + remove_text + '</a></div></td>\n';
	newrow += '<td class="lightback normal" style="width:150px;" valign="top">' + jQuery('#date_'+media).html() + '</td>';
	newrow += '<td class="lightback normal" style="width:100px;" valign="top">' + jQuery('#mtype_'+media).html() + '</td>\n';
	newrow += '</tr></table>';

	jQuery('#add_'+media).hide();
	if(jQuery('#added_'+media).html() == "")
		jQuery('#added_'+media).html('<img src="img/tng_test.gif" alt="" width="20" height="20" class="smallicon">');
	jQuery('#added_'+media).fadeIn(400);

	var div = document.createElement("div");
	div.id = "orderdivs_"+albumlink;
	div.className = "sortrow";
	div.style.clear = "both";
	div.style.position = "relative";
	div.onmouseover = function(){jQuery('#del_' + albumlink).css('visibility','visible');};
	div.onmouseout = function(){jQuery('#del_' + albumlink).css('visibility','hidden');};
	div.innerHTML = newrow;
	jQuery('#orderdivs').append(div);

	mediacount = mediacount + 1;
	jQuery('#mediacount').html(mediacount);
	jQuery('#nomedia').hide();
	jQuery('#orderdivs').sortable({tag:'div', update:updateMediaOrder});
}

function removeFromAlbum(media,albumlink) {
	if(confirm(confremmedia)) {
		var params = {media:media,albumlink:albumlink,action:'remalb'};
		jQuery.ajax({
			url: 'ajx_updateorder.php',
			data: params,
			dataType: 'html',
			success: function(req) {
				var pairs = req.split('&');
				var media = parseInt(pairs[0]);
				var albumlink = parseInt(pairs[1]);
				jQuery('#orderdivs_' + albumlink).fadeOut(400,function(){
					jQuery('#orderdivs_' + albumlink).remove();
				});
				if(jQuery('#added_'+media).length) {
					jQuery('#added_'+media).hide();
					jQuery('#add_'+media).fadeIn(400);
				}
				mediacount = mediacount - 1;
				jQuery('#mediacount').html(mediacount);
			}
		});
	}
	return false;
}

function openAlbumMediaFind() {
	tnglitbox = new LITBox('findalbummedia.php',{width:800,height:600});
	return false;
}