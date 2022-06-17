jQuery(document).ready(function(){
    jQuery('#wpm_settings_form .form-table input').each(function (i, item) {
		if(item.type == 'text') {
            //console.log(item.id);
            var item_id = item.id;
            jQuery(this).closest("tr").addClass(item_id);
            jQuery(this).closest("tr").addClass('textbox_tr');
        } else if(item.type == 'checkbox') {
            var item_id = item.id;
			if(item_id == 'wgact_setting_google_user_id') {
				var item_name = item.name;
				item_name = item_name.replace(/\"|\'|\[|\]/g, '_');
				jQuery(this).closest("tr").addClass(item_name);
				jQuery(this).closest("tr").addClass('checkbox_tr');
			} else {
				jQuery(this).closest("tr").addClass(item_id);
				jQuery(this).closest("tr").addClass('checkbox_tr');
			}
        } else if(item.type == 'radio') {
            var item_id = item.id;
            jQuery(this).closest("tr").addClass(item_id);
            jQuery(this).closest("tr").addClass('radio_tr');
        }
    });        
});

jQuery(document).ready(function(){
    jQuery('#wpm_settings_form .form-table .subsection').each(function (i, item) {
        jQuery(this).closest("tr").addClass('cs_section_heading');
    });        
});

jQuery(document).ready(function(){
	if(jQuery(".wtlwp-settings").length){
		jQuery('.wtlwp-settings #user_first_name').closest('tr').css('display', 'none');	
		jQuery('.wtlwp-settings #user_last_name').closest('tr').css('display', 'none');	
		jQuery('.wtlwp-settings #user-role').closest('tr').css('display', 'none');	
		jQuery('.wtlwp-settings #redirect-to').closest('tr').css('display', 'none');	
		jQuery('.wtlwp-settings #locale').closest('tr').css('display', 'none');	
	}
});