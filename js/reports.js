function finishValidation( ) {
	var displayfields = jQuery('#displayfields li');
	var criteriafields = jQuery('#finalcriteria li');
	var orderbyfields = jQuery('#finalsort li');
	var displayfield = document.form1.display;
	var criteriafield = document.form1.criteria;
	var orderbyfield = document.form1.orderby;
	
	for( var i = 0; i < displayfields.length; i++ ) {
		displayfield.value = displayfield.value + displayfields[i].firstElementChild.innerHTML + "\r\n";
	}

	for( var j = 0; j < criteriafields.length; j++ ) {

		criteriafield.value = criteriafield.value + criteriafields[j].firstElementChild.innerHTML + "\r\n";
	}
	
	for( var k = 0; k < orderbyfields.length; k++ ) {
		orderbyfield.value = orderbyfield.value + orderbyfields[k].firstElementChild.innerHTML + "\r\n";
	}
}	

function add_to_list(item,listname) {
	var newitem = $(item).clone().prop('ondblclick',"").appendTo($('#'+listname));
   	jQuery('#'+listname+' li').last().dblclick(function(){
   		this.remove();
   	});
}

function AddConstant(source, flag) {
	if( flag || source.value.length ) {
		var newval = flag ? "\"" + source.value + "\"" : source.value;
		var newli = jQuery('<li>' + newval + '<span class="hidden">' + newval + '</span>');
		newli.dblclick(this.remove);
		newli.appendTo($('#finalcriteria'));
	}
}

function handleKey(event, flag) {
    if (event.keyCode == 13) {
        event.preventDefault();
        AddConstant(event.target,flag);
        return false;
    }
    return true;
}

jQuery(document).ready(function() {
	$( "#displayfields" ).sortable({
	    revert: true,
	    update: function(ev) {
	    	jQuery(ev.originalEvent.target).width('');
	    	jQuery(ev.originalEvent.target).prop('ondblclick',"").dblclick(this.remove);
	    }
	});
	$( "#displayavail li" ).draggable({
	    connectToSortable: "#displayfields",
	    helper: "clone",
	    revert: "invalid",
	    width: "none"
	});
	$( "#finalcriteria" ).sortable({
	    revert: true,
	    update: function(ev) {
	    	jQuery(ev.originalEvent.target).width('');
	    	jQuery(ev.originalEvent.target).prop('ondblclick',"").dblclick(this.remove);
	    }
	});
	$( "#availcriteria li" ).draggable({
	    connectToSortable: "#finalcriteria",
	    helper: "clone",
	    revert: "invalid",
	    width: "none"
	});
	$( "#availoperators li" ).draggable({
	    connectToSortable: "#finalcriteria",
	    helper: "clone",
	    revert: "invalid",
	    width: "none"
	});
	$( "#finalsort" ).sortable({
	    revert: true,
	    update: function(ev) {
	    	jQuery(ev.originalEvent.target).width('');
	    	jQuery(ev.originalEvent.target).prop('ondblclick',"").dblclick(this.remove);
	    }
	});
	$( "#availsort li" ).draggable({
	    connectToSortable: "#finalsort",
	    helper: "clone",
	    revert: "invalid",
	    width: "none"
	});
	$( "ul, li" ).disableSelection();	
})
