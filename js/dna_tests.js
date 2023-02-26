function deleteDnaLink(linkID) {
	if(confirm(confdellink)) {
		var tds = jQuery('tr#alink_'+linkID+' td');
		jQuery.each(tds,function(index,item){
			jQuery(item).effect('highlight',{color:'#ff9999'},200);
		});
		var params = {linkID:linkID,action:'deldnalink'};
		jQuery.ajax({
			url: 'ajx_updateorder.php',
			data: params,
			dataType: 'html',
			success: function(req){
				jQuery('#alink_'+req).fadeOut(400);
				linkcount = linkcount - 1;
				jQuery('#linkcount').html(linkcount);
			}
		});
	}
	return false;
}

function addDnaLink(form) {
	var entityID = form.newlink1.value.toUpperCase().trim();
	var testID = form.testID.value;

	if(!entityID)
		alert(linkmsg);
	else {
		var tree = form.tree1.options[form.tree1.selectedIndex].value;
		var params = {tree:tree,entityID:entityID,testID:testID,action:'adddnalink'};

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

					var linkID = parseInt(req);
					var newrow;
					var displayID = ' (' + entityID + ')';
					var dims = "width=\"20\" height=\"20\" class=\"smallicon\"";
					var treename = form.tree1.options[form.tree1.selectedIndex].text;
					var treeID = form.tree1.options[form.tree1.selectedIndex].value;

					if(jQuery('#linkcount').length) {
						linkcount = linkcount + 1;
						jQuery('#linkcount').html(linkcount);
					}

					var linktable = document.getElementById('linktable');
					var newtr = linktable.insertRow(1);
					newtr.id = 'alink_' + linkID;
					newtr.setAttribute('style','display:none');

					var actionbuttons = '<a href="#" title="' + remove_text + '" onclick="return deleteDnaLink(' + linkID + ');"><img src="img/tng_delete.gif" alt="' + remove_text + '" ' +'class="smallicon admin-delete-icon"/></a>';
					var td0 = insertCell(newtr,0,"lightback normal",actionbuttons);
					td0.setAttribute('align','center');
					insertCell(newtr,1,"lightback normal",name + displayID);
					insertCell(newtr,2,"lightback normal",treename + '&nbsp;');

					jQuery('#alink_'+linkID).fadeIn(400, function(){
						var tds = jQuery('tr#alink_'+linkID+' td');
						jQuery.each(tds,function(index,item){
							jQuery(item).effect('highlight',{},1200);
						});
					});

					//strip slashes and apostrophes
					if(jQuery('#link_'+entityID).length) {
						jQuery('#link_'+entityID).hide();
						jQuery('#linked_'+ientityID).fadeIn(400);
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
	    	return addDnaLink(form);
	else
		return true;
}