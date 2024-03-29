<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$image_path = plugin_dir_url(dirname(dirname(__FILE__))) . 'images/';

?>

<div class="rmagic">

    <!--Dialogue Box Starts-->
    <div class="rmcontent">


        <?php
        $form = new Form("options_autoresponder");
        $form->configure(array(
            "prevent" => array("bootstrap", "jQuery"),
            "action" => ""
        ));

        $form->addElement(new Element_HTML('<div class="rmheader">' . RM_UI_Strings::get('GLOBAL_SETTINGS_EMAIL_NOTIFICATIONS') . '</div>'));

        $form->addElement(new Element_Checkbox(RM_UI_Strings::get('LABEL_USER_NOTIFICATION_FRONT_END'), "buy_pro", array("yes" => ''), array("id" => "id_rm_user_notify_cb", "value" => "no", 'disabled' => 1, "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_ARESP_NOTE_NOTIFS') . "<br><br>" . RM_UI_Strings::get('MSG_BUY_PRO_INLINE'))));

        $form->addElement(new Element_Checkbox(RM_UI_Strings::get('LABEL_NOTIFICATIONS_TO_ADMIN'), "admin_notification", array("yes" => ''),array("id" => "id_rm_admin_notify_cb", "class" => "id_rm_admin_notify_cb" , "value" =>  $data['admin_notification'],  "onclick" => "hide_show(this)" , "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_ARESP_ADMIN_NOTIFS'))));


        $mails = explode(",", $data['admin_email']);
  if ($data['admin_notification'] == 'yes')
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_admin_notify_cb_childfieldsrow">'));
        else
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_admin_notify_cb_childfieldsrow" style="display:none">'));

        $form->addElement(new Element_Emailsortable(RM_UI_Strings::get('LABEL_RECIPIENTS_OPTION') . ":", "resp_emails[]", array("id" => "rm_field_value_file_types", "class" => "rm-static-field rm_field_value rm_options_resp_email", "value" => $mails, "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_ARESP_RESPS'))));

        $form->addElement(new Element_HTML('</div>'));


        $form->addElement(new Element_Checkbox(RM_UI_Strings::get('LABEL_ENABLE_SMTP'), "enable_smtp", array("yes" => ''), array("id" => "id_rm_smtp_enable_cb", "class" => "id_rm_smtp_enable_cb" , "value" =>  $data['enable_smtp'],  "onclick" => "hide_show(this)","longDesc" => RM_UI_Strings::get('HELP_OPTIONS_ARESP_ENABLE_SMTP'))));

     if ($data['enable_smtp'] == 'yes')
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_smtp_enable_cb_childfieldsrow">'));
        else
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_smtp_enable_cb_childfieldsrow" style="display:none">'));

        $form->addElement(new Element_Textbox(RM_UI_Strings::get('LABEL_SMTP_HOST'), "smtp_host", array("id" => "id_rm_smtp_host_tb", "value" => $data['smtp_host'], "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_ARESP_SMTP_HOST'))));
        $form->addElement(new Element_Select(RM_UI_Strings::get('LABEL_SMTP_ENCTYPE'), "smtp_encryption_type", array('enc_none' => RM_UI_Strings::get('LABEL_NONE'), 'enc_tls' => 'TLS', 'enc_ssl' => 'SSL'), array("id" => "id_rm_smtp_enctype_dd", "value" => $data['smtp_encryption_type'], "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_ARESP_SMTP_ENCTYPE'))));
        $form->addElement(new Element_Number(RM_UI_Strings::get('LABEL_SMTP_PORT'), "smtp_port", array("id" => "id_rm_smtp_port_num", "value" => $data['smtp_port'], "min" => 0, "max" => 65535, "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_ARESP_SMTP_PORT'))));
       $form->addElement(new Element_Checkbox(RM_UI_Strings::get('LABEL_SMTP_AUTH'), "smtp_auth", array("yes" => ''), array("id" => "id_rm_smtp_auth_cb", "class" => "id_rm_smtp_auth_cb" , "value" =>  $data['smtp_auth'],  "onclick" => "hide_show(this)","longDesc" => RM_UI_Strings::get('HELP_OPTIONS_ARESP_SMTP_AUTH'))));

       if ($data['smtp_auth'] == 'yes')
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_smtp_auth_cb_childfieldsrow">'));
        else
            $form->addElement(new Element_HTML('<div class="childfieldsrow" id="id_rm_smtp_auth_cb_childfieldsrow" style="display:none">'));
        $form->addElement(new Element_Textbox(RM_UI_Strings::get('LABEL_USERNAME'), "smtp_user_name", array("id" => "id_rm_smtp_username_tb", "value" => $data['smtp_user_name']/* , "longDesc"=>  RM_UI_Strings::get('HELP_OPTIONS_ARESP_FROM_EMAIL') */)));
        $form->addElement(new Element_Password(RM_UI_Strings::get('LABEL_PASSWORD'), "smtp_password", array("id" => "id_rm_smtp_password_tb", "value" => $data['smtp_password']/* , "longDesc"=>  RM_UI_Strings::get('HELP_OPTIONS_ARESP_FROM_EMAIL') */)));
        $form->addElement(new Element_HTML('</div>'));

        $form->addElement(new Element_Email(RM_UI_Strings::get('LABEL_SMTP_TESTMAIL'), "", array("id" => "id_rm_test_email_tb", "longDesc" => RM_UI_Strings::get('LABEL_SMTP_TESTMAIL'))));
        $form->addElement(new Element_HTML('<div class="rmrow rmnoarrow"><div class="rmfield" for="rm_field_value_options_textarea"><label></label></div><div class="rminput"><div class="rm-test-block-container"><div class="rm-test-text" onclick="jQuery.rm_test_smtp_config()">' . RM_UI_Strings::get('LABEL_TEST') . '</div><div id="rm_f_loading" style="display:none"><img class="rm-settings-icon" src="'. $image_path .'rm_f_ajax_loader.gif"></div><div class="rm_response" id="rm_smtp_test_response"></div></div></div></div>'));
        $form->addElement(new Element_HTML('</div>'));


        $form->addElement(new Element_Textbox(RM_UI_Strings::get('LABEL_FROM_EMAIL_DISP_NAME'), "senders_display_name", array("id" => "id_rm_from_tb", "value" => $data['senders_display_name'], "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_ARESP_FROM_DISP_NAME'))));
       $form->addElement(new Element_Email(RM_UI_Strings::get('LABEL_FROM_EMAIL'), "senders_email", array("id" => "id_rm_from_email_tb","pattern"=>"^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$", "value" => $data['senders_email'], "longDesc" => RM_UI_Strings::get('HELP_OPTIONS_ARESP_FROM_EMAIL'), "required" => 1)));
        $form->addElement(new Element_HTMLL('&#8592; &nbsp; Cancel', '?page=rm_options_manage', array('class' => 'cancel')));
        $form->addElement(new Element_Button(RM_UI_Strings::get('LABEL_SAVE')));


        $form->render();
        ?>
    </div>
    <div class="rm-upgrade-note-gold">
        <div class="rm-banner-title">Upgrade and expand the power of<img src="<?php echo RM_IMG_URL.'logo.png'?>"> </div>
        <div class="rm-banner-subtitle">Choose from two powerful extension bundles</div>
        <div class="rm-banner-box"><a href="http://registrationmagic.com/?download_id=317&edd_action=add_to_cart" target="blank"><img src="<?php echo RM_IMG_URL.'silver-logo.png'?>"></a>

        </div>
        <div class="rm-banner-box"><a href="http://registrationmagic.com/?download_id=19544&edd_action=add_to_cart" target="blank"><img src="<?php echo RM_IMG_URL.'gold-logo.png'?>"></a>

        </div>
    </div>
</div>

<?php   