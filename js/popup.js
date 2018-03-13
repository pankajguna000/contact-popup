jQuery(document).ready(function() {
// Fade out the save message
jQuery('.con_group').hide();
	jQuery('.con_group:first').fadeIn();
	jQuery('#con_of-nav li:first').addClass('current');
	jQuery('#con_of-nav li a').click(function(evt){
		jQuery('#con_of-nav li').removeClass('current');
		jQuery(this).parent().addClass('current');
		if(jQuery(this).attr("title")=="Embed Code"){
			jQuery(".con_embed_code_save").css("display", "block");
			jQuery(".con_embed_code_save").css("float", "right");
		}
		else{
			jQuery(".con_embed_code_save").css("display", "none");
		}
			var clicked_group = jQuery(this).attr('href');
			jQuery('.con_group').hide();
			jQuery(clicked_group).fadeIn();
			evt.preventDefault();
		});
           					
	
	

    jQuery("div.update_entry").click(function() {
     var heig=window.screen.height;
	 //var heig = jQuery(document).height();
     var h= jQuery("div#update_div").height();
   	 var mid_height =(heig)/2-h ;
	//var mid_height=mid_height+166;
	 
	 /*var wid = jQuery(window).width();
     var mid_width = (wid / 2)- 150;
	 */
        jQuery("div#update_div").css({
            "display": "block",
            "border": "3px solid rgb(202, 202, 202)",
            "width": "350px",
            "position": "fixed",
            "margin-top":mid_height,
            "margin-left":"30%",
"top": "0"
        });
        var post_id = jQuery(this).find('a.edit_entry').attr("entry_id");
        var value = jQuery(this).html();
        var name = jQuery(this).parent().parent().children('td.fgcf_name').html();
        var email = jQuery(this).parent().parent().children('td.fgcf_email').html();
        var message = jQuery(this).parent().parent().children('td.fgcf_message').html();
        jQuery('input#fgcf_form_id').val(post_id);
        jQuery('input#fgcf-form_name').val(name);
        jQuery('input#fgcf-form_email').val(email);
        jQuery('textarea#fgcf-form_message').val(message);
    });
	
	jQuery("div.delete_entry").click(function() {
		var post_id = jQuery(this).attr("entry_id");
		var heig=window.screen.height;
     var h= jQuery("div#update_div").height();
   	  var mid_height =(heig)/2-h ;
	 //var mid_height=mid_height+166;
	 jQuery("div#delete_div").css({
            "display": "block",
            "border": "3px solid rgb(202, 202, 202)",
            "width": "350px",
            "position": "fixed",
            "margin-top":mid_height,
            "margin-left":"30%",
			"top": "0"
        });
	jQuery("#yes_del").click(function(){
		jQuery.ajax({
			type: 'POST',
			url: MyAjax.ajaxurl,
			data: {"action": "delete_data", "post_id": post_id},
			success: function(data){
			window.location.reload(true);
			}
		});
	});
	jQuery("#no_del").click(function(){
	jQuery("div#delete_div").css({"display": "none"});
	});
	});
    jQuery('img#close_popup_img').click(function() {
        jQuery("div#update_div").css({"display": "none"});
		jQuery("div#delete_div").css({"display": "none"});
    });
});