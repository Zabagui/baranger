String.prototype.trim = function () {
    return this.replace(/^\s*/, "").replace(/\s*$/, "");
}

function deleteIt(type,id,tree,confirm) {
	var tds = jQuery('#row_'+id+' td');
	jQuery.each(tds,function(index,item){
		jQuery(item).effect('highlight',{color:'#ff9999'},1500);
	});
	var params = {t:type,id:id,desc:tree,confirm:confirm};
	jQuery.ajax({
		url: cmstngpath + 'ajx_delete.php',
		data: params,
		dataType: 'html',
		success: function(entity) {
			if(jQuery('#row_'+entity).length) {
				jQuery('#row_'+entity).fadeOut(400);
				var allTotals = jQuery('.restotal');
				jQuery.each(allTotals,function(index,item){
					var total = jQuery(item);
					total.html(numberWithCommas(parseInt(total.html().replace(/,/g,'')) - 1));
				});
				var allPageTotals = jQuery('.pagetotal');
				jQuery.each(allPageTotals,function(index,item){
					var pagetotal = jQuery(item);
					pagetotal.html(numberWithCommas(parseInt(pagetotal.html().replace(/,/g,'')) - 1));
				});
			}	
		}
	});
	return false;
}

function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

function makeFolder(folder,name) {
	jQuery('#msg_'+folder).html('<img src="img/spinner.gif" />');
	var oldfolder = jQuery('#'+folder+'_org').val();
	var params = {type:folder,oldfolder:oldfolder,newfolder:name};
	jQuery.ajax({
		url: cmstngpath + 'admin_makefolder.php',
		data: params,
		dataType: 'html',
		success: function(req){
			jQuery('#msg_'+folder).html(req);
			jQuery('#msg_'+folder).effect('highlight',{},200);
			jQuery('#'+folder+'_org').val(name);
		}
	});

	return false;
}

function makeDefault(photo) {
	var params = {media:photo.value.substr(1),entity:entity,tree:tree,album:album,action:'setdef'};
	jQuery.ajax({
		url: cmstngpath + 'ajx_updateorder.php',
		data:params,
		dataType: 'html',
		success: function(req) {
			jQuery('#removedefault').show();
			if(req != "1") {
				jQuery('#thumbholder').html(req);
				jQuery('#thumbholder').fadeIn(400);
				jQuery('#removedefault').css('visibility','visible');
			}
		}
	});
}

function removeDefault() {
	jQuery('#removedefault').hide();
	jQuery('#thumbholder').fadeOut(400,function(){
		jQuery('#thumbholder').html('');
	});
	for (var i=0; i<document.form1.rthumbs.length; i++)  {
		if (document.form1.rthumbs[i].checked)
			document.form1.rthumbs[i].checked = '';
	}
	var params = {entity:entity,tree:tree,album:album,action:'deldef'};
	jQuery.ajax({
		url: cmstngpath + 'ajx_updateorder.php',
		data: params
	});
	return false;
}

function updateLivingBox(form, field) {
	if(field.value)
		form.living.checked = false;
}

function toggleAdminMenu(arrow) {
	if(jQuery('#leftmenu').position().left == 0) {
		jQuery('#leftmenu').css('overflow','hidden');
		jQuery('#leftmenu').animate({left: '-=135'}, 250, 'swing');
		jQuery('#maincontent').animate({'paddingLeft': '-=135px'}, 250, 'swing');
		jQuery('#dirarrow').attr('src','img/ArrowRight.gif');
		jQuery('#leftmenu a').fadeOut(300);
		jQuery.ajax({url:'ajx_setsessionvar.php',data:{varname:'tng_menuhidden',varvalue:'on'}});
	} else {
		jQuery('#leftmenu').css('overflow','auto');
		jQuery('#maincontent').animate({'paddingLeft': '+=135px'}, 250, 'swing');
		jQuery('#leftmenu').animate({left: '+=135'}, 250, 'swing');
		jQuery('#dirarrow').attr('src','img/ArrowLeft.gif');
		jQuery('#leftmenu a').fadeIn(300);
		jQuery.ajax({url:'ajx_setsessionvar.php',data:{varname:'tng_menuhidden',varvalue:'off'}});
	}
}

