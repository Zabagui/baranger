var searchtimer;
jQuery(document).ready(function(){
	jQuery('a.pers').each(function(index,item) {
		var matches = /p(\w*)_t([a-zA-Z0-9_-]*):*(\w*)/.exec(item.id);
		var personID = matches[1];
		var tree = matches[2];
		var event = matches[3];
		item.onmouseover = function() {searchtimer = setTimeout('showPersonPreview(\'' + personID + '\',\'' + tree + '\',\'' + event + '\')',1000);};
		item.onmouseout = function() {closePersonPreview(personID,tree,event);};
		item.onclick = function() {closePersonPreview(personID,tree,event);};
	});
	jQuery('a.fam').each(function(index,item) {
		var matches = /f(\w*)_t(\w*)/.exec(item.id);
		var familyID = matches[1];
		var tree = matches[2];
		item.onmouseover = function() {searchtimer = setTimeout('showFamilyPreview(\'' + familyID + '\',\'' + tree + '\')',1000);};
		item.onmouseout = function() {closeFamilyPreview(familyID,tree);};
		item.onclick = function() {closeFamilyPreview(familyID,tree);};
	});
});

function showPersonPreview(personID,tree,event) {
	var entitystr = tree+'_'+personID;
	if(event)
		entitystr += "_" + event;
	jQuery('#prev'+entitystr).css('visibility','visible');
	if(!jQuery('#prev'+entitystr).html()) {
		jQuery('#prev'+entitystr).html('<div id="ld'+entitystr+'" class="person-inner"><img src="' + cmstngpath + 'img/spinner.gif" style="border:0px" alt="" /> '+loadingmsg+'</div>');

		var params = {personID:personID,tree:tree};
		jQuery.ajax({
			url: ajx_perspreview,
			data: params,
			dataType: 'html',
			success: function(req){
				jQuery('#ld'+entitystr).html(req);
			}
		});
	}
	return false;
}

function closePersonPreview(personID,tree,event) {
	clearTimeout(searchtimer);
	var entitystr = tree+'_'+personID;
	if(event)
		entitystr += "_" + event;
	//new Effect.Fade('prev'+entitystr,{duration:.01});
	jQuery('#prev'+entitystr).css('visibility','hidden');
}

function showFamilyPreview(familyID,tree) {
	var entitystr = tree + "_" + familyID;
	jQuery('#prev'+entitystr).css('visibility','visible');
	if(!jQuery('#prev'+entitystr).html()) {
		jQuery('#prev'+entitystr).html('<div id="ld'+entitystr+'" class="person-inner"><img src="' + cmstngpath + 'img/spinner.gif" style="border:0px"> '+loadingmsg+'</div>');
		var params = {familyID:familyID,tree:tree};
		jQuery.ajax({
			url: ajx_fampreview,
			data: params,
			dataType: 'html',
			success: function(req){
				jQuery('#ld'+entitystr).html(req);
			}
		});
	}
	return false;
}

function closeFamilyPreview(familyID,tree) {
	clearTimeout(searchtimer);
	var entitystr = tree+'_'+familyID;
	jQuery('#prev'+entitystr).css('visibility','hidden');
}
