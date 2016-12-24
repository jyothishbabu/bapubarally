<?php
class Element_Username extends Element_Textbox {
	public function getJSFiles() {

	}
	public function render() {
		
		parent::render();              
	}
        
        
        public function jQueryDocumentReady() {      
          $validation_msg= RM_UI_Strings::get("USERNAME_EXISTS");  
          echo <<<JS
            
                   
                   jQuery("#{$this->_attributes['id']}").change(function(){
                   var validation_msg= '{$validation_msg}';
                   var data = {
                           'action': 'rm_user_exists',
                           'rm_slug': 'rm_user_exists',
                           'username': jQuery(this).val(),
                           'attr': 'data-rm-valid-username'
                   };
                   
                   rm_user_exists(this,rm_ajax_url,data,"{$validation_msg}");
                  
                 });
           
JS;
            
        
        }
       
}
