jQuery(document).ready(function() {
    jQuery('li#goto_fg_advance_form').click(function() {
        jQuery('#iframebox').css({"display": "block"});
        jQuery('div.entries_content').css({"display": "none"});
        jQuery('div.embed_advance_form_div').css({"display": "none"});
    });
    jQuery('li#embed_advance_form').click(function() {
        jQuery('div.embed_advance_form_div').css({"display": "block"});
        jQuery('div.entries_content').css({"display": "none"});
        jQuery('#iframebox').css({"display": "none"});
    });
    jQuery('li#fgcf_contact_form_content').click(function() {
        jQuery('div.entries_content').css({"display": "block"});
        jQuery('#iframebox').css({"display": "none"});
        jQuery('div.embed_advance_form_div').css({"display": "none"});
    });
});