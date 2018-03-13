jQuery(document).ready(function() {
    jQuery('.con_embed_code_save').click(function() {
		jQuery('div#loader_img').css("display","block");
		var text_value = jQuery('textarea#con_content_html').val();
		var data = {
            action: 'master_response',
            value: text_value
        };
        jQuery.post(script_call.ajaxurl, data, function(response) {
            if (response) {
				if(response.trim() != "updated"){
				jQuery('#embed_code_err').text("Please enter valid embed code.");
				jQuery('#embed_code_err').css("display", "block");
			  }
				else{
               jQuery('#embed_code_err').css("display", "none");
				}
			 jQuery('div#loader_img').css("display", "none");
                }
            else {
                alert('error');
            }
        });
    });
});