<?php

/**
 * Form model for the plugin
 * 
 * @link       http://registration_magic.com
 * @since      1.0.0
 *
 * @package    Registraion_Magic
 * @subpackage Registraion_Magic/admin/models
 */

/**
 * Class which conatains all the model operations of form object
 *
 * class conatains various data related operation for the forms.
 * validation methods for form also included.
 * 
 * @author cmshelplive
 */
class RM_Forms extends RM_Base_Model {

    public $form_id;
    public $form_name;
    public $form_should_send_email;
    public $form_type;
    private $default_form_user_role;
    public $form_user_role;
    public $form_redirect;
    private $form_redirect_to_page;
    private $form_redirect_to_url;
    public $form_should_auto_expire;
    public $created_on;
    public $created_by;
    public $modified_on;
    public $modified_by;
    private $valid_options;
    public $form_options;
    public $errors;
    private $form_builder_id = "rm_form_add";

    public function __construct() {
        $this->initialized = false;
        $this->form_id = NULL;
        $this->errors = array();
        
        $this->valid_options = array('form_is_opt_in_checkbox','mailchimp_relations', 'form_opt_in_text', 'form_should_user_pick', 'form_is_unique_token', 'form_description', 'form_user_field_label', 'form_custom_text', 'form_success_message', 'form_email_subject', 'form_email_content', 'form_submit_btn_label', 'form_submit_btn_color', 'form_submit_btn_bck_color', 'form_expired_by', 'form_submissions_limit', 'form_expiry_date', 'form_message_after_expiry', 'mailchimp_list', 'mailchimp_mapped_email', 'mailchimp_mapped_first_name', 'mailchimp_mapped_last_name', 'should_export_submissions', 'export_submissions_to_url', 'form_pages', 'access_control', 'style_btnfield', 'style_form', 'style_textfield', 'auto_login','cc_relations','cc_list','form_opt_in_text_cc','form_is_opt_in_checkbox_cc','aw_relations','aw_list','form_opt_in_text_aw','form_is_opt_in_checkbox_aw','enable_captcha','enable_mailchimp','enable_ccontact','enable_aweber','display_progress_bar','sub_limit_antispam','placeholder_css','btn_hover_color','field_bg_focus_color','text_focus_color','style_section','style_label', 'post_expiry_action', 'post_expiry_form_id','form_opt_in_default_state');
        $this->form_options = new stdClass;
        foreach ($this->valid_options as $valid_option)
            $this->form_options->$valid_option = null;
    }

    public function get_form_id() {
        return $this->form_id;
    }

    public function get_form_is_unique_token() {
        return $this->form_options->form_is_unique_token;
    }

    public function get_form_name() {
        return $this->form_name;
    }

    public function get_form_should_send_email() {
        return $this->form_should_send_email;
    }

    public function get_form_type() {
        return $this->form_type;
    }

    public function get_form_user_role() {
        return maybe_unserialize($this->form_user_role);
    }

    public function get_form_redirect() {
        return $this->form_redirect;
    }

    public function get_form_redirect_to_page() {
        return $this->form_redirect_to_page;
    }

    public function get_form_should_auto_expire() {
        return $this->form_should_auto_expire;
    }

    public function get_created_on() {
        return $this->created_on;
    }

    public function get_created_by() {
        return $this->created_by;
    }

    public function get_modified_on() {
        return $this->modified_on;
    }

    public function get_modified_by() {
        return $this->modified_by;
    }

    public function get_valid_options() {
        return $this->valid_options;
    }

    public function get_form_options() {
        $options_unserialized = maybe_unserialize($this->form_options);
        return $options_unserialized;
    }

    public function get_errors() {
        return $this->errors;
    }

    public static function get_identifier() {
        return 'FORMS';
    }

    public function set_form_pages($jencoded_val) {
        if ($jencoded_val == null)
            $this->form_options->form_pages = array('Page 1');
        else
            $this->form_options->form_pages = json_decode($jencoded_val);
    }

    public function set_form_id($form_id) {
        $this->form_id = $form_id;
    }

    public function set_form_name($form_name) {
        if ($form_name)
            $this->form_name = $form_name;
        else
            Form::setError($this->form_builder_id, RM_UI_Strings::get('MSG_EXPIRY_DATE_INVALID'));
    }

    public function set_form_type($type) {
        if (!is_int($type)) {
            $type = intval($type);
        }
        if ($type !== 1) {
            $type = 2;
        }
        $this->form_type = $type;
    }

    public function set_form_is_opt_in_checkbox($value) {
        $this->form_options->form_is_opt_in_checkbox = count($value);
    }

    public function set_form_should_send_email($should_send_email) {
        if (is_array($should_send_email)) {
            $should_send_email = count($should_send_email);
        }
        $this->form_should_send_email = $should_send_email;
    }

    public function set_form_user_role($form_user_role) {
        $this->form_user_role = maybe_serialize($form_user_role);
    }

    public function set_form_redirect($form_redirect) {
        $this->form_redirect = $form_redirect;
    }

    public function set_form_redirect_to_page($form_redirect_to_page) {
        $this->form_redirect_to_page = $form_redirect_to_page;
    }

    public function set_form_should_auto_expire($form_should_auto_expire) {
        if (is_array($form_should_auto_expire)) {
            $form_should_auto_expire = count($form_should_auto_expire);
        }
        $this->form_should_auto_expire = $form_should_auto_expire;
    }

    public function set_created_on($created_on) {
        $this->created_on = $created_on;
    }

    public function set_created_by($created_by) {
        $this->created_by = $created_by;
    }

    public function set_modified_on($modified_on) {
        $this->modified_on = $modified_on;
    }

    public function set_modified_by($modified_by) {
        $this->modified_by = $modified_by;
    }

    public function set_form_options($options) {
        $form_options = maybe_unserialize($options);
        $this->form_options = RM_Utilities::merge_object($form_options, $this->form_options);
    }

    public function set_errors($errors) {
        $this->errors = $errors;
    }

    public function set_should_export_submissions($value) {
        $this->form_options->should_export_submissions = count($value);
    }

    public function set(array $request) {
        foreach ($request as $property => $value) {
            $set_property_method = 'set_' . $property;
            if (method_exists($this, $set_property_method)) {
                $this->$set_property_method($value);
            } elseif (in_array($property, $this->valid_options, true)) {
                $this->form_options->$property = $value;
            }
        }

        return $this->initialized = true;
    }

    /*     * **validations**** */

    public function validate_autoresponder($form_builder_id) {
        
        $valid = true;
        if ($this->get_form_should_send_email() == "1") {
            if ($this->form_options->form_email_content == "") {
                Form::setError($form_builder_id, RM_UI_Strings::get('MSG_AUTO_REPLY_CONTENT_INVALID'));
                $valid = false;
            }

            if ($this->form_options->form_email_subject == "") {
                Form::setError($form_builder_id, RM_UI_Strings::get('MSG_AUTO_REPLY_SUBJECT_INVALID'));
                $valid = false;
            }
        }
        return $valid;
    }

    public function validate_post_sub($form_builder_id) {
        $valid = true;
        if ($this->form_redirect == "page" || $this->form_redirect == "url") {

            switch ($this->form_redirect) {
                case "page": if (empty($this->form_redirect_to_page)) {
                        Form::setError($form_builder_id, RM_UI_Strings::get('MSG_REDIRECT_PAGE_INVALID'));
                        $valid = false;
                    }
                    break;
                case "url": if (empty($this->form_redirect_to_url)) {
                        Form::setError($form_builder_id, RM_UI_Strings::get('MSG_REDIRECT_URL_INVALID'));
                        $valid = false;
                    }
                    break;
            }
        }
        return $valid;
    }

    public function validate_limits($form_builder_id) {
        $valid = true;
        /*
         * Validating form expiration configuration
         */
        if ($this->form_should_auto_expire) {
            if (isset($this->form_options->form_expired_by) && !empty($this->form_options->form_expired_by)) {

                switch ($this->form_options->form_expired_by) {

                    case "submissions": if (empty($this->form_options->form_submissions_limit)) {
                            Form::setError($form_builder_id, RM_UI_Strings::get('MSG_EXPIRY_LIMIT_INVALID'));
                            $valid = false;
                        } break;

                    case "date": if (empty($this->form_options->form_expiry_date)) {
                            Form::setError($form_builder_id, RM_UI_Strings::get('MSG_EXPIRY_DATE_INVALID'));
                            $valid = false;
                        }
                        break;
                    case "both": if (empty($this->form_options->form_expiry_date) || empty($this->form_options->form_submissions_limit)) {
                            Form::setError($form_builder_id, RM_UI_Strings::get('MSG_EXPIRY_BOTH_INVALID'));
                            $valid = false;
                        }
                        break;
                }
            } else {
                $valid = false;
                Form::setError($form_builder_id, RM_UI_Strings::get('MSG_EXPIRY_INVALID'));
            }
        }
        return $valid;
    }
    

    public function validate_accounts($form_builder_id) {
        return true;
    }

    /**
     * check if the form data is valid or not
     * 
     * @return  bool  the data is valid or not 
     */
//    public function is_valid() {
//        $this->validate_name();
//        $this->validate_description();
//        $this->validate_type();
//        $this->validate_custom_text();
//        $this->validate_should_send_email();
//
//        return count($this->errors) === 0;
//    }

    public function errors() {
        return $this->errors;
    }

    /*     * **Database Operations*** */

    public function insert_into_db() {
        // echo (date('Y-m-d H:i:s'));die;
        if (!$this->initialized) {
            return false;
        }

        if ($this->form_id) {
            return false;
        }

        /*
         * If automatic role selection is enabled then disable manual options
         */
        if (count($this->form_options->form_should_user_pick) > 0) {
            $this->default_form_user_role = '';
        }


        $data = array(
            'form_name' => $this->form_name,
            'form_type' => $this->form_type,
            'default_user_role' => $this->default_form_user_role,
            'form_user_role' => $this->form_user_role,
            'form_should_send_email' => $this->form_should_send_email,
            'form_redirect' => $this->form_redirect,
            'form_redirect_to_page' => $this->form_redirect_to_page,
            'form_redirect_to_url' => $this->form_redirect_to_url,
            'form_should_auto_expire' => $this->form_should_auto_expire,
            'created_on' => date('Y-m-d H:i:s'),
            'created_by' => get_current_user_id(),
            'form_options' => maybe_serialize($this->form_options),
        );

        $data_specifiers = array(
            '%s',
            '%s',
            '%s',
            '%s',
            '%d',
            '%s',
            '%s',
            '%s',
            '%d',
            '%s',
            '%d',
            '%s'
        );

        $result = RM_DBManager::insert_row('FORMS', $data, $data_specifiers);

        if (!$result) {
            return false;
        }

        $this->form_id = $result;

        return $this->form_id;
    }

    public function update_into_db() {
        if (!$this->initialized) {
            return false;
        }
        if (!$this->form_id) {
            return false;
        }

        /*
         * If automatic role selection is enabled then disable manual options
         */


        if (count($this->form_options->form_should_user_pick) > 0) {
            $this->default_form_user_role = '';
        }
        $data = array(
            'form_name' => $this->form_name,
            'form_type' => $this->form_type,
            'default_user_role' => $this->default_form_user_role,
            'form_user_role' => $this->form_user_role,
            'form_should_send_email' => $this->form_should_send_email,
            'form_redirect' => $this->form_redirect,
            'form_redirect_to_page' => $this->form_redirect_to_page,
            'form_redirect_to_url' => $this->form_redirect_to_url,
            'form_should_auto_expire' => $this->form_should_auto_expire,
            'modified_on' => date('Y-m-d H:i:s'),
            'modified_by' => get_current_user_id(),
            'form_options' => maybe_serialize($this->form_options),
        );



        $data_specifiers = array(
            '%s',
            '%d',
            '%s',
            '%s',
            '%d',
            '%s',
            '%s',
            '%s',
            '%d',
            '%s',
            '%d',
            '%s'
        );

        $result = RM_DBManager::update_row('FORMS', $this->form_id, $data, $data_specifiers);

        if (!$result) {
            return false;
        }


        return true;
    }

    public function update_form_options($form_id, array $data, array $data_specifiers) {

        if (!(int) $form_id)
            return false;

        $i = 0;
        $row_data = array();
        $row_data_spec = array();

        $form_options = new stdClass();

        foreach ($data as $name => $value) {

            if (in_array($name, $this->valid_options))
                $form_options->$name = $value;
            else
            if (property_exists($this, $name)) {
                $row_data[$name] = $value;
                $row_data_spec[] = $data_specifiers[$i];
            }

            $i++;
        }

        $form_options_ex = RM_DBManager::get('FORMS', array('form_id' => $form_id), array('%d'), 'var', 0, 1, 'form_options');

        $form_options_ex = maybe_unserialize($form_options_ex);

        $form_options_ex = RM_Utilities::merge_object($form_options_ex, $this->form_options);

        $form_options = RM_Utilities::merge_object($form_options, $form_options_ex);

        $row_data['form_options'] = maybe_serialize($form_options);

        $row_data_spec[] = '%s';

        var_dump($row_data);

        //$result = RM_DBManager::update_row('FORMS', $form_id, $row_data, $row_data_spec);

        if (!$result) {
            return false;
        }

        return true;
    }

    public function load_from_db($form_id, $should_set_id = true) {

        $result = RM_DBManager::get_row('FORMS', $form_id);

        //var_dump($result); die;
        if (null !== $result) {
            if ($should_set_id)
                $this->form_id = $form_id;
            else
                $this->form_id = null;
            $this->form_name = $result->form_name;
            $this->form_type = $result->form_type;
            $this->default_form_user_role = $result->default_user_role;
            $this->form_user_role = $result->form_user_role;
            $this->form_should_send_email = $result->form_should_send_email;
            $this->form_redirect = $result->form_redirect;
            $this->form_redirect_to_page = $result->form_redirect_to_page;
            $this->form_redirect_to_url = $result->form_redirect_to_url;
            $this->form_should_auto_expire = $result->form_should_auto_expire;
            $this->created_on = $result->created_on;
            $this->created_by = $result->created_by;
            $this->modified_on = $result->modified_on;
            $this->modified_by = $result->modified_by;
            $this->set_form_options($result->form_options);
        } else {
            //die("in_form_model");
            return false;
        }
        $this->initialized = true;
        return true;
    }

    public function remove_from_db() {
        return RM_DBManager::remove_row('FORMS', $this->form_id);
    }

    /**
     * @return mixed
     */
    public function get_default_form_user_role() {
        return $this->default_form_user_role;
    }

    /**
     * @param mixed $default_form_user_role
     */
    public function set_default_form_user_role($default_form_user_role) {
        $this->default_form_user_role = $default_form_user_role;
    }

    /**
     * @return mixed
     */
    public function get_form_redirect_to_url() {
        return $this->form_redirect_to_url;
    }

    /**
     * @param mixed $form_redirect_to_url
     */
    public function set_form_redirect_to_url($form_redirect_to_url) {
        $this->form_redirect_to_url = $form_redirect_to_url;
    }

    /**
     * @return string
     */
    public function getFormBuilderId() {
        return $this->form_builder_id;
    }

    /**
     * @param string $form_builder_id
     */
    public function setFormBuilderId($form_builder_id) {
        $this->form_builder_id = $form_builder_id;
    }

    public function validate_model() {
        $valid = true;

        /*
         * Validating redirecting conditions after submissions
         */
        if ($this->form_redirect == "page" || $this->form_redirect == "url") {

            switch ($this->form_redirect) {
                case "page": if (empty($this->form_redirect_to_page)) {
                        Form::setError($this->form_builder_id, RM_UI_Strings::get('MSG_REDIRECT_PAGE_INVALID'));
                        $valid = false;
                    }
                    break;
                case "url": if (empty($this->form_redirect_to_url)) {
                        Form::setError($this->form_builder_id, RM_UI_Strings::get('MSG_REDIRECT_URL_INVALID'));
                        $valid = false;
                    }
                    break;
            }
        }

        /*
         * Validating form expiration configuration
         */

        if ($this->form_should_auto_expire) {
            if (isset($this->form_options->form_expired_by) && !empty($this->form_options->form_expired_by)) {

                switch ($this->form_options->form_expired_by) {

                    case "submissions": if (empty($this->form_options->form_submissions_limit)) {
                            Form::setError($this->form_builder_id, RM_UI_Strings::get('MSG_EXPIRY_LIMIT_INVALID'));
                            $valid = false;
                        } break;

                    case "date": if (empty($this->form_options->form_expiry_date)) {
                            Form::setError($this->form_builder_id, RM_UI_Strings::get('MSG_EXPIRY_DATE_INVALID'));
                            $valid = false;
                        }
                        break;
                    case "both": if (empty($this->form_options->form_expiry_date) || empty($this->form_options->form_submissions_limit)) {
                            Form::setError($this->form_builder_id, RM_UI_Strings::get('MSG_EXPIRY_BOTH_INVALID'));
                            $valid = false;
                        }
                        break;
                }
            } else {
                $valid = false;
                Form::setError($this->form_builder_id, RM_UI_Strings::get('MSG_EXPIRY_INVALID'));
            }
        }

        if (isset($this->form_type) && $this->form_type == "1") {
            

            
        }



        if ($this->get_form_should_send_email() == "1") {
            if ($this->form_options->form_email_content == "") {
                Form::setError($this->form_builder_id, RM_UI_Strings::get('MSG_AUTO_REPLY_CONTENT_INVALID'));
                $valid = false;
            }

            if ($this->form_options->form_email_subject == "") {
                Form::setError($this->form_builder_id, RM_UI_Strings::get('MSG_AUTO_REPLY_SUBJECT_INVALID'));
                $valid = false;
            }
        }


        /*
         * Validating mailchimp settings
         */
        /*
          if(get_option('rm_option_enable_mailchimp')=="yes" ) {

          if (isset($this->form_options->mailchimp_list) && $this->form_options->mailchimp_list == 0) {
          $valid = false;
          Form::setError($this->form_builder_id, RM_UI_Strings::get('MAILCHIMP_LIST_ERROR'));
          }
          }
         */
        /*
         * Set error flag
         */



        if (!$valid)
            $this->errors = true;

        return $valid;
    }

    /**
     * @return mixed
     */
    public function get_mailchimp_mapped_email() {
        //  $this->mailchimp_mapped_email;
        //var_dump($this->form_options->mailchimp_mapped_email);die;
        return $this->form_options->mailchimp_mapped_email;
    }

    /**
     * @param mixed $mailchimp_mapped_email
     */
    public function set_mailchimp_mapped_email($mailchimp_mapped_email) {
        $this->mailchimp_mapped_email = $mailchimp_mapped_email;
        $this->form_options->mailchimp_mapped_email = $mailchimp_mapped_email;
    }

    /**
     * @return mixed
     */
    public function get_mailchimp_mapped_first_name() {
        //return $this->mailchimp_mapped_first_name;
        return $this->form_options->mailchimp_mapped_first_name;
    }

    /**
     * @param mixed $mailchimp_mapped_first_name
     */
    public function set_mailchimp_mapped_first_name($mailchimp_mapped_first_name) {
        $this->mailchimp_mapped_first_name = $mailchimp_mapped_first_name;
        $this->form_options->mailchimp_mapped_first_name = $mailchimp_mapped_first_name;
    }

    /**
     * @return mixed
     */
    public function get_mailchimp_mapped_last_name() {
        //return $this->mailchimp_mapped_last_name;
        return $this->form_options->mailchimp_mapped_last_name;
    }

    /**
     * @param mixed $mailchimp_mapped_last_name
     */
    public function set_mailchimp_mapped_last_name($mailchimp_mapped_last_name) {
        $this->mailchimp_mapped_last_name = $mailchimp_mapped_last_name;
        $this->form_options->mailchimp_mapped_last_name = $mailchimp_mapped_last_name;
    }

}
