<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class_rm_services
 *
 * @author CMSHelplive
 */
class RM_Services {

    private $model;
    public $mailchimpService;

    public function __construct($model = null) {
        $this->model = $model;

        if ($this->get_setting('enable_mailchimp') == 'yes')
            $this->mailchimpService = new RM_MailChimp_Service();
    }

    public function get_fields_highest_order($form_id, $form_page_no) {
        $highest_order = 0;
        $z = RM_DBManager::get('FIELDS', array('form_id' => $form_id, 'page_no' => $form_page_no), array('%d', '%d'), 'col', 0, 2, 'field_order', 'field_order', true);

        if ($z && is_array($z) && count($z) > 0) {
            $highest_order = $z[0];
        }

        return $highest_order;
    }

    public function add() {
        return $this->model->insert_into_db();
    }

    public function add_user_form() {

        $form_id = $this->model->insert_into_db();

        $this->add_default_form_fields($form_id, false);

        return $form_id;
    }

    public function update($form_id) {
        return $this->model->update_into_db();
    }

    public function get_all($model_identifier = null, $offset = 0, $limit = 9999999, $column = '*', $sort_by = '', $descending = false) {

        if (!$model_identifier)
            $model_identifier = $this->model->get_identifier();

        $results = RM_DBManager::get_all($model_identifier, $offset, $limit, $column, $sort_by, $descending);

        return $results;
    }

    public function count($model_identifier, $args) {
        return RM_DBManager::count($model_identifier, $args);
    }

    public function get_user($user_id, $field_name) {
        $user = new RM_User($user_id);
        return $user->get($field_name);
    }

    public function get($model_identifier, $where, $data_specifier, $result_type = 'results', $offset = 0, $limit = 15, $column = '*', $sort_by = null, $descending = false) {
        return RM_DBManager::get($model_identifier, $where, $data_specifier, $result_type, $offset, $limit, $column, $sort_by, $descending);
    }

    public function duplicate($unique_ids, $model_identifier = null) {
        if (!$model_identifier) {
            $model_identifier = $this->model->get_identifier();
        }

        $ids = array();

        $model_name = RM_Utilities::get_class_name_for($model_identifier);

        $model = new $model_name;
        if (is_array($unique_ids)) {
            foreach ($unique_ids as $unique_id) {
                $model->load_from_db($unique_id, false);
                $ids[$unique_id] = $model->insert_into_db();
            }
        } elseif ((int) $unique_ids) {
            $model->load_from_db($unique_ids, false);
            $ids[$unique_ids] = $model->insert_into_db();
        } else
            return false;

        return $ids;
    }

    public function remove($unique_ids, $model_identifier = null, $where = null) {
        if (!$model_identifier) {
            $model_identifier = $this->model->get_identifier();
        }

        if (is_array($unique_ids)) {
            foreach ($unique_ids as $unique_id) {
                RM_DBManager::remove_row($model_identifier, $unique_id, $where);
            }
        } elseif ((int) $unique_ids) {
            RM_DBManager::remove_row($model_identifier, $unique_ids, $where);
        } else
            return false;
    }

    public function remove_submissions($unique_ids, $where = null) {
        $model_identifier = 'SUBMISSIONS';

        if (is_array($unique_ids)) {
            foreach ($unique_ids as $unique_id) {
                RM_DBManager::remove_row($model_identifier, $unique_id, $where);
                RM_DBManager::delete_rows('SUBMISSION_FIELDS', array('submission_id' => $unique_id), array('%d'));
            }
        } elseif ((int) $unique_ids) {
            RM_DBManager::remove_row($model_identifier, $unique_ids, $where);
            RM_DBManager::delete_rows('SUBMISSION_FIELDS', array('submission_id' => $unique_ids), array('%d'));
        } else
            return false;
    }

    public function save_options($options) {
        return $this->model->set_values($options);
    }

    public function get_mailchimp_list() {
        $result = $this->mailchimpService->get_list();
        $lists = array(null => RM_UI_Strings::get('OPTION_SELECT_LIST'));
        if (!empty($result)) {
            foreach ($result['lists'] as $key => $list) {
                $lists[$list['id']] = $list['name'];
            }
        }

        return $lists;
    }

    public function get_all_form_fields($form_id) {
        if ((int) $form_id)
            return RM_DBManager::get_fields_by_form_id($form_id);
        else
            return false;
    }

    public function add_default_form_fields($form_id, $is_reg_form) {

        $this->create_default_email_field($form_id);
    }

    public function create_default_password_field($form_id) {

        $field = new RM_Fields;
        $field->set(array('form_id' => $form_id,
            'field_type' => 'Password',
            'field_label' => 'Password',
            'field_placeholder' => 'Password',
            'field_css_class' => 'rm_form_default_fields',
            'field_is_required' => 1,
            'field_show_on_user_page' => 0,
            'field_is_read_only' => 0,
            'field_is_editable' => 0,
            'field_max_length' => 50,
            'is_field_primary' => 1));

        return $field->insert_into_db();
    }

    public function create_default_username_field($form_id) {

        $field = new RM_Fields;
        $field->set(array('form_id' => $form_id,
            'field_type' => 'Textbox',
            'field_label' => 'User Name',
            'field_placeholder' => 'User Name',
            'field_css_class' => 'rm_form_default_fields',
            'field_is_required' => 1,
            'field_show_on_user_page' => 1,
            'field_is_read_only' => 0,
            'field_is_editable' => 0,
            'field_max_length' => 70,
            'is_field_primary' => 1));

        return $field->insert_into_db();
    }

    public function create_default_email_field($form_id) {

        $field = new RM_Fields;
        $field->set(array('form_id' => $form_id,
            'field_type' => 'Email',
            'page_no' => 1,
            'field_label' => 'Email',
            'field_placeholder' => 'Email',
            'field_css_class' => 'rm_form_default_fields',
            'field_is_required' => 1,
            'field_show_on_user_page' => 0,
            'field_is_editable' => 0,
            'field_is_read_only' => 0,
            'is_field_primary' => 1));

        return $field->insert_into_db();
    }

    public function remove_form_fields($form_id) {
        if (is_array($form_id))
            foreach ($form_id as $formId)
                RM_DBManager::delete_form_fields($formId);
        elseif ((int) $form_id)
            RM_DBManager::delete_form_fields($formId);
        else
            throw new InvalidArgumentException("Invalid Form ID '$form_id'.");
    }

    public function get_setting($name) {
        $global_settings = new RM_Options;
        $result = $global_settings->get_value_of($name);
        return $result;
    }

    public function is_form_expired($form) {
        if (!$form->get_form_should_auto_expire()) {
            return false;
        }

        $form_id = $form->form_id;
        $criterian = $form->form_options->form_expired_by;
        $submission_limit = $form->form_options->form_submissions_limit;
        return $this->is_form_expired_core($form_id, $criterian, $submission_limit);
    }

    public function is_form_expired_core($form_id, $criterion, $submission_limit) {
        if ($criterion == "date") {
            if (RM_DBManager::is_expired_by_date($form_id))
                return true;
        }elseif ($criterion == "submissions") {
            if (RM_DBManager::is_expired_by_submissions($form_id, $submission_limit))
                return true;
        }elseif ($criterion == "both") {
            return (RM_DBManager::is_expired_by_date($form_id) || RM_DBManager::is_expired_by_submissions($form_id, $submission_limit));
        }
    }

    //Can pass form as an object of form model or a db row loaded from forms tabel. Set the flag accordingly
    public function get_form_expiry_stats($form, $is_form_object = true) {
        if ($is_form_object) {
            $form_id = $form->get_form_id();
            $form_options = $form->get_form_options();
            $criterian = $form_options->form_expired_by;
            $form_should_auto_expire = $form->get_form_should_auto_expire();
        } else {
            $form_id = $form->form_id;
            $form_options = maybe_unserialize($form->form_options);
            $criterian = $form_options->form_expired_by;
            $form_should_auto_expire = $form->form_should_auto_expire;
        }
        $remaining = (object) array('state' => 'perpetual',
                    'criteria' => 'both',
                    'remaining_days' => 'undefined',
                    'remaining_subs' => 'undefined',
                    'sub_limit' => 0,
                    'date_limit' => 0);
        if (!$form_should_auto_expire) {
            return $remaining;
        }
        if ($criterian == "date") {
            if (RM_DBManager::is_expired_by_date($form_id, $remaining->remaining_days)) {
                $remaining->state = 'expired';
                $remaining->criteria = 'date';
                $remaining->date_limit = $form_options->form_expiry_date;
            } else {
                $remaining->state = 'not_expired';
                $remaining->criteria = 'date';
                $remaining->date_limit = $form_options->form_expiry_date;
            }
            return $remaining;
        } elseif ($criterian == "submissions") {
            if (RM_DBManager::is_expired_by_submissions($form_id, $form_options->form_submissions_limit, $remaining->remaining_subs)) {
                $remaining->state = 'expired';
                $remaining->criteria = 'subs';
                $remaining->sub_limit = $form_options->form_submissions_limit;
            } else {
                $remaining->state = 'not_expired';
                $remaining->criteria = 'subs';
                $remaining->sub_limit = $form_options->form_submissions_limit;
            }
            return $remaining;
        } elseif ($criterian == "both") {
            if (RM_DBManager::is_expired_by_date($form_id, $remaining->remaining_days) || RM_DBManager::is_expired_by_submissions($form_id, $form_options->form_submissions_limit, $remaining->remaining_subs)) {
                $remaining->state = 'expired';
                $remaining->criteria = 'both';
                $remaining->sub_limit = $form_options->form_submissions_limit;
                $remaining->date_limit = $form_options->form_expiry_date;
            } else {
                $remaining->state = 'not_expired';
                $remaining->criteria = 'both';
                $remaining->sub_limit = $form_options->form_submissions_limit;
                $remaining->date_limit = $form_options->form_expiry_date;
            }
            return $remaining;
        }
    }

    public function delete_rows($model_identifier, $where, $where_format = null) {
        return RM_DBManager::delete_rows($model_identifier, $where, $where_format);
    }

    public function duplicate_form_fields($form_id, $ids) {
        if (is_array($form_id))
            foreach ($form_id as $formId) {
                $fields = RM_DBManager::get_fields_by_form_id($formId);
                foreach ($fields as $field)
                    $this->duplicate_field($field->field_id, $ids[$formId]);
            } elseif ((int) $form_id) {
            $fields = RM_DBManager::get_fields_by_form_id($form_id);
            foreach ($fields as $field)
                $this->duplicate_field($field->field_id, $ids[$form_id]);
        } else
            throw new InvalidArgumentException("Invalid Form ID '$form_id'.");
    }

    public function duplicate_field($field_id, $form_id) {
        $model = new RM_Fields;

        $model->load_from_db($field_id, false);
        $model->set_form_id($form_id);
        $model->insert_into_db();
    }

    public function set_field_order($list) {
        RM_DBManager::set_field_order($list);
    }

    public function get_submissions_by_email($user_email, $limit = 9999999, $offset = 0, $sort_by = '', $descending = true) {
        return RM_DBManager::get_submissions_for_user($user_email, $limit, $offset, $sort_by, $descending);
    }

    public function get_payments_by_email($user_email, $limit = 9999999, $offset = 0, $sort_by = '', $descending = true) {


        $submission_ids = $this->get_submissions_by_email($user_email, $limit, $offset, $sort_by, $descending);

        return get_payments_by_submission_id($submission_ids, $limit, $offset, $sort_by, $descending);
    }

    public function get_payments_by_submission_id($submission_ids, $limit = 9999999, $offset = 0, $sort_by = '', $descending = false) {

        if (is_array($submission_ids))
            $fields = RM_DBManager::get_results_for_array('PAYPAL_LOGS', 'submission_id', $submission_ids);
        elseif ((int) $submission_ids)
            $fields = $this->get('PAYPAL_LOGS', array('submission_id' => $submission_ids), array('%d'), 'row', $offset, $limit, '*', $sort_by, $descending);

        if (!$fields)
            return false;

        return $fields;
    }

    public function remove_form_submissions($form_id) {
        if (is_array($form_id))
            foreach ($form_id as $formId)
                RM_DBManager::delete_form_submissions($formId);
        elseif ((int) $form_id)
            RM_DBManager::delete_form_submissions($form_id);
        else
            throw new InvalidArgumentException("Invalid Form ID '$form_id'.");
    }

    public function remove_form_stats($form_id) {
        if (is_array($form_id))
            foreach ($form_id as $formId)
                RM_DBManager::delete_form_stats($formId);
        elseif ((int) $form_id)
            RM_DBManager::delete_form_stats($form_id);
        else
            throw new InvalidArgumentException("Invalid Form ID '$form_id'.");
    }

    public function remove_form_notes($form_id) {
        if (is_array($form_id))
            foreach ($form_id as $formId)
                RM_DBManager::delete_form_notes($formId);
        elseif ((int) $form_id)
            RM_DBManager::delete_form_notes($form_id);
        else
            throw new InvalidArgumentException("Invalid Form ID '$form_id'.");
    }

    public function remove_form_payment_logs($form_id) {
        if (is_array($form_id))
            foreach ($form_id as $formId)
                RM_DBManager::delete_form_payment_logs($formId);
        elseif ((int) $form_id)
            RM_DBManager::delete_form_payment_logs($form_id);
        else
            throw new InvalidArgumentException("Invalid Form ID '$form_id'.");
    }

    public function remove_submission_payment_logs($sub_id) {
        if (is_array($sub_id))
            foreach ($sub_id as $sub_id_)
                RM_DBManager::delete_rows('PAYPAL_LOGS', array('submission_id' => $sub_id_));
        elseif ((int) $sub_id)
            RM_DBManager::delete_rows('PAYPAL_LOGS', array('submission_id' => $sub_id));
        else
            throw new InvalidArgumentException("Invalid Submission ID '$sub_id'.");
    }

    public function remove_submission_notes($sub_id) {
        if (is_array($sub_id))
            foreach ($sub_id as $sub_id_)
                RM_DBManager::delete_rows('NOTES', array('submission_id' => $sub_id_));
        elseif ((int) $sub_id)
            RM_DBManager::delete_rows('NOTES', array('submission_id' => $sub_id));
        else
            throw new InvalidArgumentException("Invalid Submission ID '$sub_id'.");
    }

    public function get_submissions_to_export($form_id, $is_searched = false, $search = null) {

        $export_data = array();
        $is_payment = false;
        $option = new RM_Options;

        if (!(int) $form_id)
            return false;

        $fields = $this->get_all_form_fields($form_id);

        if (!$fields)
            return false;

        $field_ids = array();

        foreach ($fields as $field) {
            if ($field->field_type != 'Price' && $field->field_type != 'HTMLH' && $field->field_type != 'HTMLP') {
                $field_ids[] = $field->field_id;
                $export_data[0][$field->field_id] = $field->field_label;
            }
            $i = 0;
            if ($field->field_type == 'price' && $i == 0) {
                $is_payment = true;
                $export_data[0]['invoice'] = 'Payment Invoice';
                $export_data[0]['txn_id'] = 'Payment TXN Id';
                $export_data[0]['status'] = 'Payment Status';
                $export_data[0]['total_amount'] = 'Paid Amount';
                $export_data[0]['date'] = 'Date of Payment';
                $i++;
            }
        }




        if (!$is_searched && !($search instanceof stdClass)) {
            $submission_ids = $this->get('SUBMISSIONS', array('form_id' => $form_id), array('%d'), 'col', 0, 999999, 'submission_id', null, true);
            if (!$submission_ids)
                return false;
            $submissions = RM_DBManager::get_results_for_array('SUBMISSION_FIELDS', 'field_id', $field_ids);
        }
        else {
            $submission_ids = RM_DBManager::get_results_for_last_col($search->interval, $form_id, $search->id, $search->value);
            if (!$submission_ids)
                return false;
            $submissions = RM_DBManager::get_sub_fields_for_array('SUBMISSION_FIELDS', 'field_id', $field_ids, 'submission_id', $submission_ids);
        }

        foreach ($submission_ids as $s_id) {
            $export_data[$s_id] = array();

            $payment = $this->get('PAYPAL_LOGS', array('submission_id' => $s_id), array('%d'), 'row', 0, 10, '*', null, true);

            foreach ($field_ids as $f_id) {
                $export_data[$s_id][$f_id] = null;
            }

            if ($is_payment) {
                $export_data[$s_id]['invoice'] = isset($payment->invoice) ? : null;
                $export_data[$s_id]['txn_id'] = isset($payment->txn_id) ? : null;
                $export_data[$s_id]['status'] = isset($payment->status) ? : null;
                $export_data[$s_id]['total_amount'] = isset($payment->total_amount) ? $option->get_formatted_amount($payment->total_amount, $payment->currency) : null;
                $export_data[$s_id]['date'] = isset($payment->posted_date) ? RM_Utilities::localize_time($payment->posted_date, get_option('date_format')) : null;
            }
        }

        foreach ($submissions as $submission) {
            $value = maybe_unserialize($submission->value);
            if (is_array($value)) {
                if (isset($value['rm_field_type']) && $value['rm_field_type'] == 'File') {
                    unset($value['rm_field_type']);
                    if (count($value) == 0)
                        $value = null;
                    else {
                        $file = array();
                        foreach ($value as $a)
                            $file[] = wp_get_attachment_url($a);

                        $value = implode(',', $file);
                    }
                } else
                    $value = implode(',', $value);
            }
            if (array_key_exists($submission->submission_id, $export_data))
                $export_data[$submission->submission_id][$submission->field_id] = stripslashes($value);
        }

        return $export_data;
    }

    public function create_csv($data) {

        $csv_name = 'rm_submissions' . time() . mt_rand(10, 1000000);
        $csv_path = get_temp_dir() . $csv_name . '.csv';
        $csv = fopen($csv_path, "w");

        if (!$csv) {
            return false;
        }

        foreach ($data as $a) {
            if (!fputcsv($csv, $a))
                return false;
        }

        fclose($csv);

        return $csv_path;
    }

    public function download_file($file, $unlink = true) {
        if (ob_get_contents()) {
            ob_end_clean();
        }
        if (file_exists($file)) {
            $mime_type = RM_Utilities::mime_content_type($file);
            header('Content-Description: File Transfer');
            header('Content-Type: ' . $mime_type);
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            readfile($file);
            if ($unlink)
                unlink($file);
            exit;
        } else
            return false;

        return true;
    }

    public function manage_form_page($action, $form_id, $page_no = null, $new_page_name = null) {
        $form = new RM_Forms;
        $form->load_from_db($form_id);
        $fopts = $form->get_form_options();
        $form_pages = $fopts->form_pages;

        switch ($action) {
            case 'add_page':
                if ($form_pages == null) {
                    $form_pages = array('Page 1', 'Page 2');
                } else {
                    $total_page = count($form_pages);
                    $new_page_no = $total_page + 1;
                    $form_pages[] = 'Page ' . $new_page_no;
                }
                break;

            case 'delete_page':
                if ($form_pages == null || !$page_no) {
                    return;
                } else {
                    if ($page_no == 1)
                        return; //can't delete first page.
                    if (isset($form_pages[$page_no - 1])) {
                        RM_DBManager::remove_fields_for_page($page_no, $form_id);
                        unset($form_pages[$page_no - 1]);
                    }
                }
                break;

            case 'rename_page':
                if ($form_pages == null || !$page_no || !$new_page_name) {
                    return;
                } else {
                    if (isset($form_pages[$page_no - 1]))
                        $form_pages[$page_no - 1] = $new_page_name;
                }

                break;
        }

        $x = (object) array('form_pages' => $form_pages);
        $form->set_form_options($x);
        $form->update_into_db();
        return count($form_pages);
    }

    public function get_custom_fields($user_email) {

        $field_ids = array();
        $forms = array();
        $custom_fields = array();

        $submissions = $this->get('SUBMISSIONS', array('user_email' => $user_email), array('%s'), 'results', 0, 999999, '*', null, false);

        if (!$submissions)
            return false;

        if (is_array($submissions) || is_object($submissions))
            foreach ($submissions as $submission) {
                if (!in_array($submission, $forms)) {
                    $forms[] = $submission->form_id;
                    $result = $this->get('FIELDS', array('form_id' => $submission->form_id, 'field_show_on_user_page' => 1), array('%s', '%d'), 'results', 0, 999999, '*', null, false);
                    if ($result)
                        $field_ids[$submission->submission_id] = $result;
                }
            }

        foreach ($field_ids as $submission_id => $field) {
            foreach ($field as $f_row) {

                $result = $this->get('SUBMISSION_FIELDS', array('submission_id' => $submission_id, 'field_id' => $f_row->field_id), array('%d', '%d'), 'var', 0, 999999, 'value', null, false);

                if ($result) {
                    $custom_fields[$f_row->field_id] = new stdClass();
                    $custom_fields[$f_row->field_id]->label = $f_row->field_label;
                    $custom_fields[$f_row->field_id]->value = $result;
                    $custom_fields[$f_row->field_id]->type = $f_row->field_type;
                    $custom_fields[$f_row->field_id]->is_editable = $f_row->field_is_editable;
                    $custom_fields[$f_row->field_id]->form_id = $f_row->form_id;
                }
            }
        }

        if (count($custom_fields) == 0)
            return null;

        return $custom_fields;
    }
 public function get_review_event()
    {
          $total_submissions=  RM_DBManager::group_by_total('SUBMISSIONS', 1,'','user_email');
          $total_users= count_users();
          $total_users=$total_users['total_users'];
         
         $message=null;
        if($total_submissions >=10)
            $message= 1;
        if($total_users >=10)
            $message= 2;
        if($total_submissions >=100)
            $message=3;
        if($total_users >=100)
            $message= 4;
        if($total_submissions >=1000)
            $message= 5;
        if($total_users >=1000)
            $message= 6;
        
        return $message;
     
    }
     public function check_event_status($event)
    {
         if($event == null)
             return 'dont_show';
         else
         {
         $options=new RM_Options;
         $opt_event=$options->get_value_of('review_events');
        
         if($opt_event['event']==0 && $opt_event['rating']==0)
             return 'show';
         elseif($opt_event['event']==0 && $opt_event['rating']!=0)
         {
             if($opt_event['rating'] <=3)
                 return 'feedback';
             else
                 return 'remind';
         }
         else
         {
             
         }
         if($event == $opt_event['event'])
         {
             if($opt_event['status']['flag']=='remind')
             {
                $time=date('Y-m-d');
                $datetime1 = new DateTime($time);
                $datetime2 = new DateTime($opt_event['status']['time']);
                $interval = $datetime1->diff($datetime2);
                $days=(int)$interval->format('%a');
                return $days >=7 ?'remind':'dont_show';
             }
             else
                 return 'dont_show';
         }
         elseif($event > $opt_event['event'])
         {
             return 'show';
         }
         else
           return 'show';  
         }
     
    }
  
    public function get_editable_fields($form_id) {
        global $wpdb;
        $table_name = $wpdb->prefix.'rm_fields';
        if ((int) $form_id) {
            $db_fields = $wpdb->get_results("SELECT * FROM `$table_name` WHERE `form_id` = $form_id AND `field_is_editable` = 1 AND `field_type` != 'Price' ORDER BY `field_order`,`field_id`");

            if (!$db_fields || !is_array($db_fields))
                return null;

            $fields = array();
            foreach ($db_fields as $db_field) {
                $fields[$db_field->field_id] = $db_field;
            }
            return $fields;
        }
        return false;
    }

    public function get_latest_submission_for_user($user_email, $form_ids = array()) {
        return RM_DBManager::get_latest_submission_for_user($user_email, $form_ids);
    }
    
    //get the newest submission's id from a group of edited submissions
    public function get_latest_submission_from_group($submission_id){
        return RM_DBManager::get_latest_submission_from_group($submission_id);
    }
    
    //get the oldest submission's id from a group of edited submissions
    public function get_oldest_submission_from_group($submission_id){
        return RM_DBManager::get_oldest_submission_from_group($submission_id);
    }
}
