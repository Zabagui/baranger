function startSort() {
	jQuery('#childrenlist').sortable({tag:'div', update:updateChildrenOrder});
	//Position.includeScrollOffsets = true;
}

function updateChildrenOrder(id) {
	var children = jQuery('#childrenlist').sortable('toArray');

	var params = {sequence:children.join(','),action:'childorder',familyID:persfamID,tree:tree};
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
			url: 'ajx_delete.php',
			data: params,
			dataType: 'html',
			success: function(req){
				jQuery('#child_'+personID).fadeOut(300, function(){
					jQuery('#child_'+personID).remove();
					childcount -= 1;
					jQuery('#childcount').html(childcount);
				});
			}
		});
	}
	return false
}

function EditChild(id) {
	window.open('editperson.php?personID=' + id + '&tree=' + tree + '&cw=1','editchild');
}

function EditSpouse(field) {
	if( field.value.length )
		window.open('editperson.php?personID=' + field.value + '&tree=' + tree + '&cw=1','editspouse');
}

function RemoveSpouse( spouse, spousedisplay ) {
	if(spouse.value) {
		spouse.value = "";
		spousedisplay.value = "";
	}
}

var nplitbox;
var activeidbox = null;
var activenamebox = null;
function openCreatePersonForm(idfield,namefield,type,gender,father,persfamID) {
	activeidbox = idfield;
	activenamebox = namefield;
	nplitbox = new LITBox('newperson2.php?tree=' + tree + '&type='+type + '&familyID=' + persfamID + '&father=' + father + '&gender=' + gender,{width:620,height:550});
	generateID('person',document.npform.personID);
	jQuery('#firstname').focus();
	return false;
}

function saveNewPerson(form) {
	form.personID.value = TrimString( form.personID.value );
	var personID = form.personID.value;
	if( personID.length == 0 ) {
		alert("<?php echo $admtext[enterpersonid]; ?>");
	}
	else {
		var params = jQuery.param(form);
		params.order = childcount + 1;
		jQuery.ajax({
			url: 'addperson2.php',
			data: params,
			dataType: 'html',
			success: function(req){
				if(req.indexOf('error') >= 0) {
					var vars = eval('('+req+')');
					jQuery('#errormsg').html(vars.error);
					jQuery('#errormsg').show();
				}
				else {
					nplitbox.remove();
					if(form.type.value == "child") {
						jQuery('#childrenlist').append(req);
						jQuery('#child_'+personID).fadeIn(400);
						childcount += 1;
						jQuery('#childcount').html(childcount);
						startSort();
					}
					else if(form.type.value == "spouse") {
						var vars = eval('('+req+')');
						jQuery('#'+activenamebox).val(vars.name + ' - ' + vars.id);
						jQuery('#'+activenamebox).effect('highlight',{},400);
						jQuery('#'+activeidbox).val(vars.id);
					}
				}
			}
		});
	}
	return false
}