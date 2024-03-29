
<?php
//echo "<pre>",var_dump($data),"</pre>";
?>

<div class="rmagic">
        
<!-----Operationsbar Starts-->
    
    <div class="operationsbar">
        <div class="rmtitle"><?php echo RM_UI_Strings::get('TITLE_INVITES'); ?></div>
        <div class="icons">
        <a href="<?php echo get_admin_url()."admin.php?page=rm_options_autoresponder";?>"><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))) . "images/rm-email-notifications.png"; ?>">
        </a></div>
        <div class="nav">
        <ul>
            <!-- <li><a href="arrow.png">New</a></li> -->
            <li><a href="?page=rm_invitations_manage&rm_queues=true">Active Queues</a></li>
            <li class="rm-form-toggle"><?php echo RM_UI_Strings::get('LABEL_SELECT_RESIPIENTS'); ?>
            	<select id="rm_form_dropdown" name="rm_form_id" onchange="rm_load_page(this, 'invitations_manage')">
<?php
					foreach ($data->forms as $form_id => $form)
					   if($data->current_form_id == $form_id)
					       echo "<option value=$form_id selected>$form</option>";
					   else
					       echo "<option value=$form_id>$form</option>";
?>
	            </select>

            </li>
            </ul>
        </div>
        
        </div>
<!--------Operationsbar Ends-->


<!-------Contentarea Starts-->
<?php
	if($data->queue_view):
		if($data->queue_count > 0):
			foreach($data->queues as $queue):
?>
        <div class="rm-invites">
        <div class="rm-invite-field-row">
        <div class="rm-invite-icon"><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))) . "images/rm-hourglass.png"; ?>"></div>
        <div class="rm-invite-label"><?php echo $data->forms[$queue->form_id];?></div>
        <div class="rm-invite-label"><?php echo RM_UI_Strings::get('LABEL_QUEUE_IN_PROGRESS');?></div>
        <div class="rm-invite-label"><span class="rm-red"><?php echo $queue->offset."/".$queue->total." ".RM_UI_Strings::get('LABEL_SENT');?></span></div>
        <div class="rm-invite-label"><?php echo RM_UI_Strings::get('LABEL_STARTED_ON')." ".$queue->started_on;?></div>    
            </div>
            <!-- <div class="rm-invite-field-row"><?php echo RM_UI_Strings::get('MSG_QUEUE_RUNNING');?></div> -->
        
        </div>
<?php
			endforeach;
		else:
?>
		<div class="rm-invites">
        <div class="rm-invite-field-row">        
            <div class="rmnotice rm-invite-field-row"><?php echo RM_UI_Strings::get('ERROR_INVITE_NO_QUEUE');?></div>        
        </div>
<?php
		endif;

	elseif(isset( $data->no_mail_error) &&  $data->no_mail_error):
?>	
	<div class="rm-invites">
        <div class="rm-invite-field-row">        
            <div class="rmnotice rm-invite-field-row"><?php echo RM_UI_Strings::get('ERROR_INVITE_NO_MAIL');?></div>        
        </div>
<?php
	elseif($data->job->is_job_running):
?>
        <div class="rm-invites">
        <div class="rm-invite-field-row">
        <div class="rm-invite-icon"><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))) . "images/rm-hourglass.png"; ?>"></div>
        <div class="rm-invite-label"><?php echo $data->forms[$data->current_form_id];?></div>
        <div class="rm-invite-label"><?php echo RM_UI_Strings::get('LABEL_QUEUE_IN_PROGRESS');?></div>
        <div class="rm-invite-label"><span class="rm-red"><?php echo $data->job->offset."/".$data->job->total." ".RM_UI_Strings::get('LABEL_SENT');?></span></div>
        <div class="rm-invite-label"><?php echo RM_UI_Strings::get('LABEL_STARTED_ON')." ".$data->job->started_on;?></div>    
            </div>
            <div class="rm-invite-field-row"><?php echo RM_UI_Strings::get('MSG_QUEUE_RUNNING');?></div>
        
        </div>
<?php
	else:

		$form = new Form("invitation_mail_content");

		$form->configure(array(
		            "prevent" => array("bootstrap", "jQuery"),
		            "action" => ""
		        ));


		//$form->addElement(new Element_HTMLL('&#8592; &nbsp; Cancel', '?page=rm_invitations_manage', array('class' => 'cancel')));
		$form->addElement(new Element_Textbox("Subject", "rm_mail_subject", array("required" => 1, "longDesc"=>RM_UI_Strings::get('HELP_OPTIONS_INVITES_SUB'))));
		$form->addElement(new Element_TinyMCEWP("Body","","rm_mail_body", array('editor_class' => 'rm_TinyMCE_mail_body', 'editor_height' => '300px'), array("required"=>1, "longDesc"=>RM_UI_Strings::get('HELP_OPTIONS_INVITES_BODY'))));
		$form->addElement(new Element_Button(RM_UI_Strings::get('LABEL_SEND')));
?>
		
                   <div class="rmnotice rm-invite-field-row"><?php echo sprintf(RM_UI_Strings::get('INFO_USERS_SELECTED_FOR_MAIL'), $data->total_resp);?> <b> <?php echo $data->forms[$data->current_form_id];?></b></div>     
            <div class="rm-invites">
<?php
		$form->render();
?>   
        </div>
        
        <!--
<div class="rm-invites">
    <div class="rm-invite-field-row">
        <div class="rm-invite-label">Subject</div>
        <div class="rm-invite-value"><input type=text class="rm-invite-subject"></div></div>
    
    <div class="rm-invite-field-row">
        <div class="rm-invite-label">Body</div>
    <div class="rm-invite-value"><Textarea></Textarea></div></div>
    
    <div class="rm-buttonarea">
        <div class="cancel">Cancel</div>
        <input type="submit" value="Send">
    
    </div>
    
</div>
-->
<?php
	endif;
?> 
   <div class="rm-upgrade-note-gold">
        <div class="rm-banner-title">Upgrade and expand the power of<img src="<?php echo RM_IMG_URL.'logo.png'?>"> </div>
        <div class="rm-banner-subtitle">Choose from two powerful extension bundles</div>
        <div class="rm-banner-box"><a href="http://registrationmagic.com/?download_id=317&edd_action=add_to_cart" target="blank"><img src="<?php echo RM_IMG_URL.'silver-logo.png'?>"></a>

        </div>
        <div class="rm-banner-box"><a href="http://registrationmagic.com/?download_id=19544&edd_action=add_to_cart" target="blank"><img src="<?php echo RM_IMG_URL.'gold-logo.png'?>"></a>

        </div>
    </div>
    </div>