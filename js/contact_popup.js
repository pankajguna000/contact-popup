jQuery(document).ready(function(e) {
	
	jQuery('div.contact_button').css("display", "block");
	var form_position = window.screen.height;
	var h=jQuery(".contact_button").height();
	//var center_align = ((form_position)/2-h)+100;
	//var center_align = (form_position-h)/2;
	var center_align = (form_position/2)-(h/2);
	var form= jQuery(window).height();
		jQuery('div.contact_button').css("top", "40%");
	jQuery('div.contact_button').click(function(){
	var form_position1 = jQuery(window).height();
	var g=jQuery(".contact_top_div").height();
	var new1 = (form_position1-g)/2;
	jQuery(".contact_top_div").css('bottom', new1);
	if(jQuery(".contact_top_div").hasClass("selected"))
	{
		if(jQuery("#contact_form_div").hasClass("inserted"))
	{
jQuery("#data_of_contact").css("display", "block");
	jQuery("#text_sub").css("display", "none");
	jQuery("#cont_name").val('');
    jQuery("#cont_email_id").val('');
    jQuery("#cont_textarea").val('');
	jQuery("#cont_name").css("border-color", "#eeeeee");
	jQuery("#cont_email_id").css("border-color", "#eeeeee");
	jQuery("#cont_textarea").css("border-color", "#eeeeee");
	
	}
	
	jQuery("#cont_name").val('');
    jQuery("#cont_email_id").val('');
    jQuery("#cont_textarea").val('');
	jQuery("#cont_name").css("border-color", "#eeeeee");
	jQuery("#cont_email_id").css("border-color", "#eeeeee");
	jQuery("#cont_textarea").css("border-color", "#eeeeee");
	/*jQuery(".contact_top_div").toggle().animate({
        left: '+=410',
        width: 'toggle',
        easing:'swing'	
    }, 700
    );*/
	jQuery(".contact_top_div").animate({
	width: 'toggle'	
	},700);
	}
	else
{
	jQuery("#cont_name").val('');
    jQuery("#cont_email_id").val('');
    jQuery("#cont_textarea").val('');
	jQuery("#cont_name").css("border-color", "#eeeeee");
	jQuery("#cont_email").css("border-color", "#eeeeee");
	jQuery("#cont_textarea").css("border-color", "#eeeeee");
   /*
jQuery(".contact_top_div").animate({
    left: '+=0',
    width: 'toggle',
    easing:'swing'	
    }, 700
    );*/
	jQuery(".contact_top_div").animate({
	width: 'toggle'	
	},700);
	}
	});
	var flage=true; 
	jQuery("img#anc_close").click(function() {
            //if(flage){
                flage=false;
	/*jQuery(".contact_top_div").addClass("selected");
	jQuery(".contact_top_div").toggle().animate({
    left: '-=410',
    width: 'toggle',
    easing:'swing'
	}, 700,flage=true
    );*/
	jQuery(".contact_top_div").animate({
	width: 'toggle'	
	},500);
//}
});
	
jQuery('#cont_frame_div').css('background-color', '#FFFFFF'); 
jQuery('#cont_frame_div').css('z-index', '99999'); 
jQuery("#cont_submit").click(function(e){
//var h=jQuery("#contact_form_div").height();
	 
var h=jQuery("#contact_form_div").outerHeight(true);

heig=h+6;
var sub_name1 = jQuery("#cont_name").val();
var sub_email1 = jQuery("#cont_email_id").val();
var sub_msg1 =jQuery("#cont_textarea").val();
var count=0;
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
if(sub_email1.match(mailformat))
{jQuery("#cont_email_id").css("border-color", "#eeeeee");
	var sub_email=sub_email1;
}
else{
	count++;
jQuery("#cont_email_id").css("border-color", "#ffacac");
	}
//var namePattern = /^[A-z][A-z\s\.]+[A-z][A-z\s]+$/;
var namePattern = /(.+)/;
if(sub_name1.match(namePattern))
{jQuery("#cont_name").css("border-color", "#eeeeee");
	var sub_name=sub_name1;
}
else
{count++;
jQuery("#cont_name").css("border-color", "#ffacac");
}
if(sub_msg1.length!=0)
{jQuery("#cont_textarea").css("border-color", "#eeeeee");
	var sub_msg=sub_msg1;
}
else
{count++;
jQuery("#cont_textarea").css("border-color", "#ffacac");
}
//alert(count);
if(count==0)
{
jQuery.ajax({
			type: 'POST',
			url: MyAjax.ajaxurl,
			data: {"action":"insert_data", "name": sub_name, "email":sub_email, "msg":sub_msg},
			success: function(data){
			jQuery("#contact_form_div").addClass("inserted");
			jQuery("#text_sub").css("display", "block");
            jQuery("#data_of_contact").css("display", "none");
				
			//jQuery("#cont_email_id").after(jQuery("<div style='color:white; margin-left:45px;'>"+data+"</div>"));
					
			//jQuery("#cont_email_id").css("background-color", "#ffacac");
			}
		});
}

jQuery("#contact_form_div").css("height",heig);
jQuery("#text_sub").css({"color":"black","font-size":"150%", "position":"absolute", "top":"140px", "margin-left":"55px"});
jQuery("#text_sub").css("align", "center");
});
});
