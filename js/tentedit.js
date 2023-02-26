function saveTentEdit(form) {
	jQuery('#tspinner').show();
	var params = jQuery(form).serialize();
	jQuery.ajax({
		url: 'ajx_savetentedit.php',
		data: params,
		success: function(req){
			jQuery('#tentedit').hide();
			jQuery('#finished').show();
		}
	});
	return false;
}