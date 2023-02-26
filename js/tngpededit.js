var newpersongender = "";
var spouseorder = '';
function editPerson(personID, slot, gender) {
	if(personID) {
		allow_cites = true;
		allow_notes = true;
		newpersongender = gender;
		if(gender == "M")
			spouseorder = "husborder";
		else if(gender == "F")
			spouseorder = "wifeorder";
		persfamID = personID;
		tnglitbox = new LITBox(editperson_url + 'personID=' + personID + '&tree=' + tree + '&slot=' + slot,{width:950,height:750});
		startSortPerson();
	}
	return false;
}

var nplitbox;
var activeidbox = null;
var activenamebox = null;
function newPerson(gender, type, father, familyID) {
	allow_cites = false;
	allow_notes = false;
	newpersongender = gender;
	nplitbox = new LITBox(
		cmstngpath + 'ajx_newperson.php?tree=' + tree + '&gender=' + gender + '&type=' + type + '&father=' + father + '&familyID=' + familyID,
		{
			width:860,
			height:640,
			doneLoading:function(){
				generateIDajax('person','personID');
				jQuery('#firstname').focus();
			}
		}
	);
	return false;
}

function addPerson(form) {
	var params = jQuery(form).serialize();
	var perstype = form.type.value;
	if(perstype == "child") {
		var childcount = parseInt(jQuery('#childcount').html());
		params += '&order=' + (childcount + 1);
	}
	jQuery.ajax({
		url: cmstngpath + 'admin_addperson.php',
		data: params,
		dataType: 'html',
		success: function(req){
			if(req.indexOf('error') >= 0) {
				var vars = eval('('+req+')');
				alert(vars.error);
			}
			else {
				nplitbox.remove();
				if(perstype == "child") {
					jQuery('#childrenlist').append(req);
					jQuery('#child_'+form.personID.value).fadeIn(400);
					jQuery('#childcount').html(childcount + 1);
					startSortFamily();
				}
				else if(perstype == "spouse") {
					updateNameBox(req);
				}
			}
		}
	});
	return false;
}

function updateNameBox(jsonvars) {
	if(newpersongender == "M") {
		activeidbox = "husband";
		activenamebox = "husbnameplusid";
	}
	else if(newpersongender == "F") {
		activeidbox = "wife";
		activenamebox = "wifenameplusid";
	}
	var vars = eval('('+jsonvars+')');
	jQuery('#'+activenamebox).val(vars.name + ' - ' + vars.id);
	jQuery('#'+activenamebox).effect('highlight',{},400);
	jQuery('#'+activeidbox).val(vars.id);
}

function updatePerson(form, slot) {
	checkDate(form.birthdate);
	checkDate(form.altbirthdate);
	checkDate(form.deathdate);
	checkDate(form.burialdate);
	checkDate(form.baptdate);
	checkDate(form.endldate);
	var params = jQuery(form).serialize();
	jQuery.ajax({
		url: cmstngpath + 'admin_updateperson.php',
		data: params,
		dataType: 'html',
		success: function(req){
			var thispers = form.personID.value;
			if(people[thispers].backperson)
				var params = "&backpers1=" + people[thispers].backperson + "&famc1=" + people[people[thispers].backperson].famc;
			else
				var params = "&personID=" + thispers;
			if(slot) {
				var getgens = slot >= slotceiling_minus1 ? 1 : 2;
				fetchData(params,getgens);
			}
			else {
				updateNameBox(req);
			}
			tnglitbox.remove();
		}
	});
	return false;
}

var persfamID;
function editFamily(familyID, slot, lastperson) {
	allow_cites = true;
	allow_notes = true;
	persfamID = familyID;
	tnglitbox = new LITBox(cmstngpath + 'ajx_editfamily.php?familyID=' + familyID + '&tree=' + tree + '&lastperson=' + lastperson + '&slot=' + slot,{width:950,height:600});
	startSortFamily();
	return false;
}

function newFamily(slot, child) {
	allow_cites = false;
	allow_notes = false;
	tnglitbox = new LITBox(
		cmstngpath + 'ajx_newfamily.php?tree=' + tree + '&child=' + child + '&slot=' + slot,
		{
			width:950,
			height:500,
			doneLoading:function(){
				generateIDajax('family','familyID');
			}
		}
	);
	return false;
}

function updateFamily(form, slot, script) {
	var params = jQuery(form).serialize();
	jQuery.ajax({
		url: cmstngpath + script,
		data: params,
		datatype: 'html',
		success: function(req){
			var getgens = 1;
			var startfam = form.familyID.value;

			var scm1 = slotceiling_minus1;
			while(scm1 > slot) {
			     getgens += 1;
			     scm1 /= 2;
			     scm1 = Math.floor(scm1);
			}
			var params = {generations: getgens, tree: tree, display: display, backpers1: form.lastperson.value, famc1: startfam};
			jQuery.ajax({
				url: pedjsonfile,
				data: params,
				dataType: 'html',
				success: function(req){
					addNewPeople(req);
					if(script == "admin_addfamily.php")
						people[form.lastperson.value].famc = startfam;
					else {
						var notfound = true;
						if(families[startfam] && families[startfam].children) {
							for(var i = 0; i < families[startfam].children.length && notfound; i++) {
								if(families[startfam].children[i].childID == form.lastperson.value)
									notfound = false;
							}
						}
						if(notfound)
							people[form.lastperson.value].famc = -1;
					}
					DisplayChart();
				}
			});
			tnglitbox.remove();
		}
	});
	return false;
}

function startSortFamily() {
	Sortable.create('childrenlist',{tag:'div',onUpdate:updateChildrenOrder});
	Position.includeScrollOffsets = true;
}

function startSortPerson() {
	if(jQuery('div#parents div').length > 1)
		jQuery('#parents').sortable({tag:'div', update:updateParentsOrder});
	if(jQuery('div#spouses div').length > 1)
		jQuery('#spouses').sortable({tag:'div', update:updateSpousesOrder});
	//not sure if the following line needs to be converted to jQuery
	//Position.includeScrollOffsets = true;
}

function updateParentsOrder(id) {
	var parentlist = jQuery('#parents').sortable('toArray');

	var params = {sequence:parentlist.join(','),action:'parentorder',personID:persfamID,tree:tree};
	jQuery.ajax({
		url: cmstngpath + 'ajx_updateorder.php',
		data: params,
		dataType: 'html'
	});
}

function updateSpousesOrder(id) {
	var spouselist = jQuery('#spouses').sortable('toArray');

	var params = {sequence:spouselist.join(','),action:'spouseorder',tree:tree,spouseorder:spouseorder};
	jQuery.ajax({
		url: cmstngpath + 'ajx_updateorder.php',
		data: params,
		dataType: 'html'
	});
}

function unlinkSpouse(familyID) {
	if(confirm(confunlink)) {
		var params = {action:'spouseunlink',familyID:familyID,personID:persfamID,tree:tree};
		jQuery.ajax({
			url: cmstngpath + 'ajx_updateorder.php',
			data: params,
			dataType: 'html',
			success: function(req){
				jQuery('#spouses_'+familyID).fadeOut(300, function(){
					jQuery('#spouses_'+familyID).remove();
					jQuery('#marrcount').html(parseInt(jQuery('#marrcount').html()) - 1);
				});
			}
		});
	}
	return false;
}

function unlinkParents(familyID) {
	if(confirm(confunlinkc)) {
		var params = {action:'parentunlink',familyID:familyID,personID:persfamID,tree:tree};
		jQuery.ajax({
			url: cmstngpath + 'ajx_updateorder.php',
			data: params,
			dataType: 'html',
			success: function(req){
				jQuery('#parents_'+familyID).fadeOut(300, function(){
					jQuery('#parents_'+familyID).remove();
					jQuery('#parentcount').html(parseInt(jQuery('#parentcount').html()) - 1);
				});
			}
		});
	}
	return false;
}

function updateChildrenOrder(id) {
	var childlist = jQuery('#childrenlist').sortable('toArray');

	var params = {sequence:childlist.join(','),action:'childorder',familyID:persfamID,tree:tree};
	jQuery.ajax({
		url: cmstngpath + 'ajx_updateorder.php',
		data: params,
		dataType: 'html'
	});
}

function unlinkChild(personID,action) {
	var confmsg = action == "child_delete" ? confdeletepers : confremchild;
	if(confirm(confmsg)) {
		var params = {personID:personID,familyID:persfamID,desc:tree,t:action};
		jQuery.ajax({
			url: cmstngpath + 'ajx_delete.php',
			data: params,
			dataType: 'html',
			success: function(req){
				jQuery('#child_'+personID).fadeOut(300, function(){
					jQuery('#child_'+personID).remove();
					jQuery('#childcount').html(parseInt(jQuery('#childcount').html()) - 1);
				});
			}
		});
	}
	return false
}

function removeSpouse( spouse, spousedisplay ) {
	if(spouse.value) {
		spouse.value = "";
		spousedisplay.value = "";
	}
}

function validateFamily(form,slot) {
	form.familyID.value = TrimString( form.familyID.value );
	if( form.familyID.value.length == 0 ) {
		alert(enterfamilyid);
		return false;
	}
	return updateFamily(form,slot,'admin_addfamily.php');
}

function validatePerson(form) {
	form.personID.value = TrimString( form.personID.value );
	if( form.personID.value.length == 0 ) {
		alert(enterpersonid);
		return false;
	}
	return addPerson(form);
}

function generateIDajax(type,dest) {
	var params = {type:type,tree:tree};
	jQuery.ajax({
		url: cmstngpath + 'admin_generateID.php',
		data: params,
		dataType: 'html',
		success: function(req){
			jQuery('#'+dest).val(req);
		}
	});
}

function checkIDajax(checkID,type,dest) {
	var params = {checkID:checkID,type:type,tree:tree};
	jQuery.ajax({
		url: cmstngpath + 'admin_checkID.php',
		data: params,
		dataType: 'html',
		success: function(req){
			jQuery('#'+dest).html(req);
		}
	});
}