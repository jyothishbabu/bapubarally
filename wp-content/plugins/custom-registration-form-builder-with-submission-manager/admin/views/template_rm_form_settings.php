<?php
/*
 * This page shows the form settings page
 * It consissts of different icons with the link to specific form settings.
 */

?>

<div class="rmagic">
    <div class="rm-global-settings">
        <div class="rm-settings-title"><?php echo RM_UI_Strings::get('LABEL_FORM_CONF'); ?></div>
        <div class="settings-icon-area">
            <a href="?page=rm_form_sett_general<?php echo $data->get_query_params; ?>"><div class="rm-settings-box">
                <img class="rm-settings-icon" src="<?php echo RM_IMG_URL . 'form-settings.png' ?>">
                <div class="rm-settings-description">

                </div>
                <div class="rm-settings-subtitle"><?php echo RM_UI_Strings::get('LABEL_F_GEN_SETT'); ?></div>
                <span><?php echo RM_UI_Strings::get('LABEL_F_GEN_SETT_DESC'); ?></span>
            </div></a>

            <a href="?page=rm_form_sett_view<?php echo $data->get_query_params; ?>"><div class="rm-settings-box">
                <img class="rm-settings-icon" src="<?php echo RM_IMG_URL . 'form-view.png' ?>">
                <div class="rm-settings-description">

                </div>
                <div class="rm-settings-subtitle"><?php echo RM_UI_Strings::get('LABEL_F_VIEW_SETT'); ?></div>
                <span><?php echo RM_UI_Strings::get('LABEL_F_VIEW_SETT_DESC'); ?></span>
            </div></a>

            <a href="?page=rm_form_sett_accounts<?php echo $data->get_query_params; ?>"><div class="rm-settings-box">
                <img class="rm-settings-icon" src="<?php echo RM_IMG_URL . 'form-accounts.png' ?>">
                <div class="rm-settings-description">

                </div>
                <div class="rm-settings-subtitle"><?php echo RM_UI_Strings::get('LABEL_F_ACC_SETT'); ?></div>
                <span><?php echo RM_UI_Strings::get('LABEL_F_ACC_SETT_DESC'); ?></span>
            </div></a>

            <a href="?page=rm_form_sett_post_sub<?php echo $data->get_query_params; ?>"><div class="rm-settings-box">
                <img class="rm-settings-icon" src="<?php echo RM_IMG_URL . 'post-submission.png' ?>">
                <div class="rm-settings-description">

                </div>
                <div class="rm-settings-subtitle"><?php echo RM_UI_Strings::get('LABEL_F_PST_SUB_SETT'); ?></div>
                <span><?php echo RM_UI_Strings::get('LABEL_F_PST_SUB_SETT_DESC'); ?></span>
            </div></a>

            <a href="?page=rm_form_sett_autoresponder<?php echo $data->get_query_params; ?>"><div class="rm-settings-box">
                <img class="rm-settings-icon" src="<?php echo RM_IMG_URL . 'auto-responder.png' ?>">
                <div class="rm-settings-description">

                </div>
                <div class="rm-settings-subtitle"><?php echo RM_UI_Strings::get('LABEL_F_AUTO_RESP_SETT'); ?></div>
                <span><?php echo RM_UI_Strings::get('LABEL_F_AUTO_RESP_SETT_DESC'); ?></span>
            </div></a>

            <a href="?page=rm_form_sett_limits<?php echo $data->get_query_params; ?>"><div class="rm-settings-box">
                <img class="rm-settings-icon" src="<?php echo RM_IMG_URL . 'form-limits.png' ?>">
                <div class="rm-settings-description">

                </div>
                <div class="rm-settings-subtitle"><?php echo RM_UI_Strings::get('LABEL_F_LIM_SETT'); ?></div>
                <span><?php echo RM_UI_Strings::get('LABEL_F_LIM_SETT_DESC'); ?></span>
            </div></a>

            <a href="?page=rm_form_sett_mailchimp<?php echo $data->get_query_params; ?>">
                <div class="rm-settings-box">
                <img class="rm-settings-icon" src="<?php echo RM_IMG_URL . 'mailchimp.png' ?>">
                <div class="rm-settings-description">

                </div>
                <div class="rm-settings-subtitle"><?php echo RM_UI_Strings::get('LABEL_F_MC_SETT'); ?></div>
                <span><?php echo RM_UI_Strings::get('LABEL_F_MC_SETT_DESC'); ?></span>
            </div></a>
<a href="?page=rm_form_sett_access_control<?php echo $data->get_query_params; ?>">
                <div class="rm-settings-box">
                <img class="rm-settings-icon" src="<?php echo RM_IMG_URL . 'access-control.png' ?>">
                <div class="rm-settings-description">

                </div>
                <div class="rm-settings-subtitle"><?php echo RM_UI_Strings::get('LABEL_F_ACTRL_SETT'); ?></div>
                <span><?php echo RM_UI_Strings::get('LABEL_F_ACTRL_SETT_DESC'); ?></span>
            </div></a>
              <a href="?page=rm_form_sett_aweber<?php echo $data->get_query_params; ?>">
                <div class="rm-settings-box">
                <img class="rm-settings-icon" src="<?php echo RM_IMG_URL . 'logo-aweber.png' ?>">
                <div class="rm-settings-description">

                </div>
                <div class="rm-settings-subtitle"><?php echo RM_UI_Strings::get('LABEL_AWEBER_OPTION'); ?></div>
                <span><?php echo RM_UI_Strings::get('LABEL_F_ACTRL_AW_DESC'); ?></span>
            </div></a>
            <a href="?page=rm_field_manage<?php echo $data->get_query_params; ?>">
                <div class="rm-settings-box">
                <img class="rm-settings-icon" src="<?php echo RM_IMG_URL . 'form-custom-fields.png' ?>">
                <div class="rm-settings-description">

                </div>
                <div class="rm-settings-subtitle"><?php echo RM_UI_Strings::get('LABEL_F_FIELDS'); ?></div>
                <span><?php echo RM_UI_Strings::get('LABEL_F_FIELDS_DESC'); ?></span>
            </div></a>
              <a href="?page=rm_form_sett_ccontact<?php echo $data->get_query_params; ?>">
                <div class="rm-settings-box">
                <img class="rm-settings-icon" src="<?php echo RM_IMG_URL . 'constant-contact.png' ?>">
                <div class="rm-settings-description">

                </div>
                <div class="rm-settings-subtitle"><?php echo RM_UI_Strings::get('LABEL_CONSTANT_CONTACT_OPTION'); ?></div>
                <span><?php echo RM_UI_Strings::get('LABEL_F_ACTRL_CC_DESC'); ?></span>
            </div></a>


        </div>
    </div>


</div>