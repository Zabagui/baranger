function validateForm1() {
	var rval = true;
	if( document.form1.place.value.length == 0 ) {
		alert(enterplace);
		rval = false;
	}
	return rval;
}

function validateForm2(form) {
	var rval = false;
	var keepid = "";

	blankMsg();
	for( var i = 0; i < form.keep.length; i++ ) {
		if( form.keep[i].checked ) {
			keepid = form.keep[i].value;
			rval = true;
			break;
		}
	}
	if( !rval )
		alert(enterkeep);
	if(rval) {
		var tree = document.form1.tree ? document.form1.tree.options[document.form1.tree.selectedIndex].value : "";
		var checks = jQuery('input.mc');
		var mergelist = new Array();
		checks.each(function(index,item){
			if(item.checked && item.value != keepid)
				mergelist.push(item.value);
		});
		var keep = form.keep[i].value;
		jQuery('#placespin').show();
		var params = {places:mergelist.join(','),keep:keep,tree:tree};
		jQuery.ajax({
			url: 'admin_mergeplacesajax.php',
			data: params,
			dataType: 'json',
			success: function(vars){
				jQuery('#lat_'+keepid).html(vars.latitude);
				jQuery('#long_'+keepid).html(vars.longitude);
				jQuery.each(mergelist,function(index,item){
					jQuery('#row_'+item).fadeOut(300);
				});
				jQuery('#placespin').hide();
				jQuery('#successmsg1').html(successmsg);
				jQuery('#successmsg2').html(successmsg);
				var lastone = eval('form.mc'+keep);
				lastone.checked = false;
			}
		});
	}

	return false;
}

var delcolor = '#ff9999';
var keepcolor = '#99ff99';
var neutcolor = '#ffffff';
var lastradio;

function blankMsg() {
	jQuery('#successmsg1').html('');
	jQuery('#successmsg2').html('');
}

function handleCheck(id) {
	var check = eval('document.form2.mc'+id+'.checked');
	var newcolor = check ? delcolor : '';

	blankMsg();
	var tds = jQuery('tr#row_'+id+' td');
	var currRadioChecked = jQuery('#r'+id).is(':checked');
	if(!currRadioChecked) {
		jQuery.each(tds,function(index,item){
			item.style.backgroundColor = newcolor;
		});
	}
}

function handleRadio(id) {
	var newcolor, tds, currID;

	blankMsg();
	var trs = jQuery('tr.mergerows');
	jQuery.each(trs,function(index,row){
		newcolor = "";
		currID = parseInt(row.id.substr(4));
		if(id == currID)
			newcolor = keepcolor;
		else {
			currCheck = eval('document.form2.mc'+currID+'.checked');
			if(currCheck)
				newcolor = delcolor;
			else {
				if(currID == lastradio)
					newcolor = neutcolor;
			}
		}
		if(newcolor) {
			tds = jQuery('tr#'+row.id+' td');
			jQuery.each(tds,function(index,item){
				item.style.backgroundColor = newcolor;
			})
		}
	})
	lastradio = id;
}
