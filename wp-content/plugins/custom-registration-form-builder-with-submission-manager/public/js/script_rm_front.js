/**
 * FILE for all the javascript functionality for the front end of the plugin
 */
/* For front end OTP widget */
var rm_ajax_url= rm_ajax.url;
var rm_validation_attr= ['data-rm-valid-username','data-rm-valid-email'];
var rm_js_data;

function rmInitGoogleApi() {
    if (typeof rmInitMap === 'function') {
        var rm_all_maps = document.getElementsByClassName("rm-map-controls-uninitialized");

        var i;
        var curr_id = '';

        for (i = 0; i < rm_all_maps.length; i++) {
            if(jQuery(rm_all_maps[i]).is(':visible')){
            curr_id = rm_all_maps[i].getAttribute("id");
            jQuery(rm_all_maps[i]).removeClass("rm-map-controls-uninitialized");
            rmInitMap(curr_id);
        }
        }
    }
}

function scroll_down_end(element) {

    if (element.scrollTop + element.offsetHeight >= element.scrollHeight)
    {
        var div = jQuery(element).parent().siblings();
        jQuery(div).children().removeAttr('disabled');

    }
    else
    {
    var text_height = jQuery(element).css('font-size').replace('px', '');
        text_height = Math.ceil(parseInt(text_height));
        var field_height = Math.floor(jQuery(element).height());
        var line_per_field = Math.floor(jQuery(element).height() / text_height);
        var text = jQuery(element).val();
        var lines = text.split(/\r|\r\n|\n/);
        var count = text.length;
        
        var count = count / field_height;
        
        var count = Math.floor(count);
        
        lines = lines.length;
       count =count *line_per_field;
        if (lines > count)
            count = lines;
     
        if (count <= line_per_field)
        {
            count = 1;
        }
        
        if ((count * field_height) <= field_height) {

            var div = jQuery(element).parent().siblings();

               jQuery(div).children().removeAttr('disabled');

        }
    }
   
}

var rm_call_otp = function (event,elem,opType) {
   
    if (event.keyCode == 13 || opType=="submit") {

        var otp_key_status = jQuery("." + elem + " #rm_otp_login #rm_otp_enter_otp #rm_otp_kcontact").is(":visible");
        var user_key_status = jQuery("." + elem + " #rm_otp_login #rm_otp_enter_password #rm_otp_kcontact").is(":visible");
        
        var data = {
            'action': 'rm_set_otp',
            'rm_otp_email': jQuery("." + elem + " #rm_otp_econtact").val(),
            'rm_slug': 'rm_front_set_otp'
        };
        if (otp_key_status)
        {
            data.rm_otp_key = jQuery("." + elem + " #rm_otp_enter_otp #rm_otp_kcontact").val();
        }else
            if(user_key_status){
                if(jQuery("." + elem + " #rm_rememberme").is(':checked'))
                    data.rm_remember = 'yes';
                data.rm_username = jQuery("." + elem + " #rm_username").val();
                data.rm_user_key = jQuery("." + elem + " #rm_otp_enter_password #rm_otp_kcontact").val();
            }
            

        jQuery.post(ajaxurl, data, function (response) {
            var responseObj = jQuery.parseJSON(response);
            if (responseObj.error == true) {
                jQuery("." + elem + " #rm_otp_login .rm_f_notifications .rm_f_error").hide().html(responseObj.msg).slideDown('slow');
                jQuery("." + elem + " #rm_otp_login .rm_f_notifications .rm_f_success").hide();
                //jQuery("#rm_otp_login " + responseObj.hide).hide('slow');
            } else {
                jQuery("." + elem + " #rm_otp_login .rm_f_notifications .rm_f_error").hide();
                jQuery("." + elem + " #rm_otp_login .rm_f_notifications .rm_f_success").hide().html(responseObj.msg).slideDown('slow');
                jQuery("." + elem + " #rm_otp_login " + responseObj.show).show('slide',{direction: 'left'},100);
                jQuery("." + elem + " #rm_otp_login " + responseObj.hide).hide('slide',{direction: 'left'},1000);

                if(responseObj.username){
                    jQuery("." + elem + " #rm_username").val(responseObj.username);
                }else
                    jQuery("." + elem + " #rm_username").val('');
                
                if (responseObj.reload) {
                    location.reload();
                }
                
                if (responseObj.redirect) {
                    window.location = responseObj.redirect;
                }
                
            }
        });
    }
};

/*All the functions to be hooked on the front end at document ready*/
jQuery(document).ready(function () {
    if(jQuery('#id_rm_tp_timezone').length > 0)
       jQuery('#id_rm_tp_timezone').val(-new Date().getTimezoneOffset()/60);
    jQuery('.rm_tabbing_container').tabs();
jQuery('.rm_terms_textarea').each(function () {
    var a = jQuery(this).children('textarea');
      if (a.length > 0)
            scroll_down_end(a);
   });
//    jQuery('.rm_terms_textarea').map(function () {
//        var a = jQuery(this).children('textarea');
//        if (a.length > 0)
//            scroll_down_end(a);
//    });
    
    jQuery(".rm_floating_action").click(function(){
       jQuery(".rm_floating_box").toggle('medium');
   });

    jQuery("#rm_f_mail_notification").show('fast', function () {
        jQuery("#rm_f_mail_notification").fadeOut(3000);
    });
    jQuery(document).ajaxStart(function () {
        jQuery("#rm_f_loading").show();
    });
    jQuery(document).ajaxComplete(function () {
        jQuery("#rm_f_loading").hide();
    });
        
 /*----Invocations for HelpText----*/
 /*   jQuery("input, textarea, select").on ({
        focusin: function () {rmHelpTextIn(this);},
        focusout: function () {rmHelpTextOut(this);}
    });*/
    
    jQuery(".rminput").on ({
        click: function () {rmHelpTextIn2(this);},
        mouseleave: function () {rmHelpTextOut2(this);}
    });
    
    jQuery("input, select, textarea").blur(function (){
        jQuery(this).parents(".rminput").siblings(".rmnote").fadeOut('fast');
    });
 
});

//Helptext function 
function rmHelpTextIn2(a) {
    var helpTextNode = jQuery(a).siblings(".rmnote");
    var fieldHeight = jQuery(a).parent().outerHeight();
    var topPos = fieldHeight - 50;
    var id = setInterval(frame, 2);
    helpTextNode.fadeIn(500);
    function frame() {
        if (topPos === fieldHeight) {
            clearInterval(id);
        } else {
            topPos++;
            helpTextNode.css('top', topPos + "px");
            }
        }
    } 

function rmHelpTextOut2(a) {
    jQuery(a).siblings(".rmnote").fadeOut('fast');
}



function setup_payment_method_visibility(payment_method_type,form_id,form_no) {

    switch (payment_method_type)
    {
        case 'paypal':
            jQuery('#rm_stripe_fields_container_'+form_id+'_'+form_no).slideUp();
            break;
        case 'stripe':
            jQuery('#rm_stripe_fields_container_'+form_id+'_'+form_no).slideDown();
            break;
    }
}


/*launches all the functions assigned to an element on click event*/

function performClick(elemId, s_id, f_id) {
    var elem = document.getElementById(elemId);
    if (elem && document.createEvent) {
        var evt = document.createEvent("MouseEvents");
        evt.initEvent("click", true, false);
        elem.dispatchEvent(evt);
    }
}


function rm_append_field(tag, element_id) {
    jQuery('#' + element_id).append("<" + tag + " class='appendable_options'>" + jQuery('#' + element_id).children(tag + ".appendable_options").html() + "</" + tag + ">");
}

function rm_delete_appended_field(element, element_id) {
    if (jQuery(element).parents("#".element_id).children(".appendable_options").length > 1)
        jQuery(element).parent(".appendable_options").remove();
}

var rm_toggleFloatingScreens= function(screen_name){
   jQuery("#" + screen_name).animate({width:'toggle'},300,"linear");
   //jQuery("#" + screen_name).slideToggle('medium');
   jQuery('.rm_floating_screens .rm_hidden').not("#" + screen_name).hide();
}

var rm_closeFloatingScreens= function(screen_name){
   jQuery("#" + screen_name).animate({width:'toggle'},300,"linear",function(){
        jQuery(this).hide();
   });
   //jQuery('.rm_floating_screens .rm_hidden').hide('medium');
}

var rm_empty_tp_entry = function(tpid){
    jQuery("#" + tpid).val('');
}

var rm_user_exists= function(el,url,data,msg){
    var valid;
    jQuery.post(url, data, function(response) {
        elementId= jQuery(el).attr('id');
        if(response=="true"){
              // if(!jQuery("#" + elementId + "-error").length)
            jQuery(el).parent(".rminput").append('<label id="' + elementId + '-error" class="rm-form-field-invalid-msg">' + msg + '</label>');  		 +            jQuery(el).parent(".rminput").append('<label id="' + elementId + '-error" class="rm-form-field-invalid-msg">' + msg + '</label>');  
              jQuery(el).attr(data.attr,0);		              
        }
        else{   
                if(jQuery("#" + elementId + "-error").html()==msg)
                     jQuery("#" + elementId + "-error").remove();
               
                 jQuery(el).attr(data.attr,1); 
            }
     });
}

function load_js_data(){
    var data = {
        'action': 'rm_js_data'
    };

    jQuery.post(rm_ajax_url, data, function (response) {
       rm_js_data= JSON.parse(response);
       initialize_valdation_strings();
    });

}

function initialize_valdation_strings(){
    jQuery.extend(jQuery.validator.messages,rm_js_data.validations); 
}
// Intializing the necessary scripts
jQuery(document).ready(function(){
    load_js_data();
});
