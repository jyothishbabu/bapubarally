<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class_form_controller
 *
 * @author CMSHelplive
 */
class RM_Form_Controller {

    private $mv_handler;

    function __construct() {
        $this->mv_handler = new RM_Model_View_Handler();
    }

    public function manage($model, $service, $request, $params) {
        if (!isset($request->req['form_name'])) {
            Form::clearErrors('rm_form_quick_add');
        }

        $sort_by = (isset($request->req['rm_sortby'])) ? $request->req['rm_sortby'] : null;
        $descending = (isset($request->req['rm_descending'])) ? false : true;
        $req_page = (isset($request->req['rm_reqpage']) && $request->req['rm_reqpage'] > 0) ? $request->req['rm_reqpage'] : 1;
        $options=new RM_Options;
          $submission_type=$options->get_value_of('submission_on_card');
        
          $items_per_page = 9;
 
         if($sort_by=="form_submissions"){
            // $forms = $service->get_all(null, ($req_page - 1) * $items_per_page, $items_per_page, '*', null, $descending);
             $forms = $service->get_all(null, 0, 999999, '*', null, $descending);
             usort($forms, function(stdClass $a, stdClass $b)
                {
                    $options=new RM_Options;
                    $submission_type=$options->get_value_of('submission_on_card');
                    $form_id='';
                    $afid=(int)$a->form_id;
                    $bfid=(int)$b->form_id;
                    $asub= count(RM_DBManager::get_results_for_last($submission_type,$afid,null,null ,0,999999,'submission_id', false));
                    $bsub= count(RM_DBManager::get_results_for_last($submission_type,$bfid,null,null ,0,999999,'submission_id', false));
                    
                    if ($asub == $bsub)
                        return 0;
                    else
                        return $asub > $bsub? -1:1;
                });
                
           $forms=array_slice($forms,($req_page - 1) * $items_per_page,$items_per_page);
        }
          else

        $forms = $service->get_all(null, ($req_page - 1) * $items_per_page, $items_per_page, '*', $sort_by, $descending);
        $i = 0;
        $data = array();
        if (is_array($forms) || is_object($forms))
            foreach ($forms as $form) {

                $data[$i] = new stdClass;
                $data[$i]->form_id = $form->form_id;
                $data[$i]->form_name = $form->form_name;
                $filter_submissions=array();
                 $filter_submissions = RM_DBManager::get_results_for_last($submission_type, $form->form_id,null,null ,0,99999,'submission_id', true);
                $data[$i]->count = count($filter_submissions);
                 //get only 3 submissions to show
                 $filter_submissions=RM_DBManager::get_results_for_last($submission_type, $form->form_id,null,null ,0,3,'submission_id', true);

                if ($data[$i]->count > 0) {
                     $data[$i]->submissions = $filter_submissions; $j = 0;
                    foreach ($data[$i]->submissions as $submission)
                         $data[$i]->submissions[$j++]->gravatar = get_avatar($submission->user_email);
                }

                $data[$i]->field_count = $service->count(RM_Fields::get_identifier(), array('form_id' => $form->form_id));
                $data[$i]->last_sub = $service->get(RM_Submissions::get_identifier(), array('form_id' => $form->form_id), array('%d'), 'var', 0, 1, 'submitted_on', 'submitted_on', true);
                //$data[$i]->last_sub = date('H',strtotime($this->service->get(RM_Submissions::get_identifier(), array('form_id' => $data_single->form_id), array('%d'), 'var', 0, 1, 'submitted_on', 'submitted_on', true)));
                $data[$i]->expiry_details = $service->get_form_expiry_stats($form, false);
               // echo "<pre>",var_dump( $data[$i]->expiry_details);die;
                $i++;
            }


        $total_forms = $service->count($model->get_identifier(), 1);

        //New object to consolidate data for view.    
        $view_data = new stdClass;
        $view_data->data = $data;
        $view_data->curr_page = $req_page;
        $view_data->total_pages = (int) ($total_forms / $items_per_page) + (($total_forms % $items_per_page) == 0 ? 0 : 1);
        $view_data->rm_slug = $request->req['page'];
        $view_data->sort_by = $sort_by;
        $view_data->descending = $descending;
        $view_data->done_with_review_banner = $service->get_setting('done_with_review_banner') === 'no' ? false : true;
        $view_data->def_form_id = $service->get_setting('default_form_id');

        if (function_exists('is_multisite') && is_multisite())
        {
            $nl_subscribed = get_site_option('rm_option_newsletter_subbed', false);
        }
        else
        {
            $nl_subscribed = get_site_option('rm_option_newsletter_subbed', false);
        }
        
        if(!$nl_subscribed)
        {
            $view_data->newsletter_sub_link = RM_UI_Strings::get('NEWSLETTER_SUB_MSG');
        }
        else
        {
            $view_data->newsletter_sub_link = null;
        }
        $view_data->submission_type=$submission_type;
        $view_data->review_event=$service->get_review_event();
        $view_data->review_message=  RM_UI_Strings::get('REVIEW_MESSAGE_EVENT'.$view_data->review_event);
        $view_data->review_popup_flag=$service->check_event_status($view_data->review_event);
        $view = $this->mv_handler->setView('form_manager');
        $view->render($view_data);
    }

    public function duplicate($model, $service, $request, $params) {
        $selected = isset($request->req['rm_selected']) ? $request->req['rm_selected'] : null;

        $duplicate = json_decode($selected);
        $ids = $service->duplicate($duplicate);
        $service->duplicate_form_fields($duplicate, $ids);
        $this->manage($model, $service, $request, $params);
    }

    public function remove($model, RM_Services $service, $request, $params) {
        $selected = isset($request->req['rm_selected']) ? $request->req['rm_selected'] : null;

        $remove = json_decode($selected);
        $service->remove($remove);
        $service->remove_form_fields($remove);
        $service->remove_form_submissions($remove);
        $service->remove_form_payment_logs($remove);
        $service->remove_form_stats($remove);
        $service->remove_form_notes($remove);
        $this->manage($model, $service, $request, $params);
    }

//    public function add($model, $service, $request, $params) {
//        $valid = $is_checked = false;
//        if ($this->mv_handler->validateForm("rm_form_add")) {
//            $model->set($request->req);
//
//            $valid = $model->validate_model();
//
//            $is_checked = true;
//        }
//        if ($valid) {
//            if (isset($request->req['form_id']))
//                $valid = $service->update($request->req['form_id']);
//            else
//                $service->add_user_form();
//
//            RM_Utilities::redirect(admin_url('/admin.php?page=' . $params['xml_loader']->request_tree->success));
//        } else {
//            $data = new stdClass;
//
//            /*
//             * Loading all fields related this form
//             */
//            $data->all_fields = array("_0" => RM_UI_Strings::get('SELECT_DEFAULT_OPTION'));
//            $data->email_fields = array("_0" => RM_UI_Strings::get('SELECT_DEFAULT_OPTION'));
//            // Edit for request
//            if (isset($request->req['rm_form_id'])) {
//                if (!$is_checked)
//                    $model->load_from_db($request->req['rm_form_id']);
//                $all_field_objects = $service->get_all_form_fields($request->req['rm_form_id']);
//                if (is_array($all_field_objects) || is_object($all_field_objects))
//                    foreach ($all_field_objects as $obj) {
//                        $data->all_fields[$obj->field_type . '_' . $obj->field_id] = $obj->field_label;
//                    }
//
//
//                $data_specifier = array("%s", "%d");
//                $where = array("field_type" => "Email", "form_id" => $request->req['rm_form_id']);
//                $email_fields = RM_DBManager::get(RM_Fields::get_identifier(), $where, $data_specifier, $result_type = 'results', $offset = 0, $limit = 1000, $column = '*', $sort_by = null, $descending = false);
//
//                if (is_array($email_fields) || is_object($email_fields))
//                    foreach ($email_fields as $field) {
//                        $data->email_fields[$field->field_type . '_' . $field->field_id] = $field->field_label;
//                    }
//            }
//
//            $data->model = $model;
//
//            //By default make it registration type
//            if (!isset($request->req['rm_form_id']))
//                $data->model->set_form_type(1);
//
//            $data->roles = RM_Utilities::user_role_dropdown(true);
//            $data->wp_pages = RM_Utilities::wp_pages_dropdown();
//            if ($service->get_setting('enable_mailchimp') == 'yes')
//                $data->mailchimp_list = $service->get_mailchimp_list();
//            else
//                $data->mailchimp_list = array();
//
//            //echo "<pre>",var_dump($data->model);//die;
//            $view = $this->mv_handler->setView("form_gen_sett");
//            $view->render($data);
//        }
//    }

    public function quick_add($model, $service, $request, $params) {
        $valid = false;
        if ($this->mv_handler->validateForm("rm_form_quick_add")) {
            $model->set($request->req);

            $valid = $model->validate_model();
        }
        if ($valid) {
            //By default make it registration type
            $model->set_form_type(1);
            $model->set_default_form_user_role('subscriber');

            if (isset($request->req['form_id']))
                $valid = $service->update($request->req['form_id']);
            else
                $service->add_user_form();
        }

        $this->manage($model, $service, $request, $params);
    }

}
