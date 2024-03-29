<?php
class Element_Radio extends OptionElement {
	protected $_attributes = array("type" => "radio");
	protected $inline;
        
        
        public function jQueryDocumentReady(){
            if(isset($this->_attributes["rm_is_other_option"]) && $this->_attributes["rm_is_other_option"] == 1){
                echo <<<JS
            
                   
                   jQuery("input[name='{$this->_attributes['name']}']").change(function(){
                   var obj_op = jQuery("#{$this->_attributes['id']}_other_section");
                    if(jQuery(this).attr('id')=='{$this->_attributes["id"]}_other')
                    {
                        obj_op.slideDown();
                        obj_op.children("input[type=text]").attr('disabled', false);
                    } 
                    else
                    {
                         obj_op.slideUp();
                         obj_op.children("input[type=text]").attr('disabled', true);
                    }
                  
                 });
                    
                jQuery('#{$this->_attributes["id"]}_other_input').change(function(){
                    jQuery('#{$this->_attributes["id"]}_other').val(jQuery(this).val());
                }) ;     
           
JS;
            }
              
             
        }
	public function render() { 
		$labelClass = 'rmradio';//$this->_attributes["type"];
		if(!empty($this->inline))
			$labelClass .= " inline";

		$count = 0;
                
            echo '<ul class="' .$labelClass. '">';
		foreach($this->options as $value => $text) {
			$value = $this->getOptionValue($value);

			//echo '<label class="', $labelClass . '"> <input id="', $this->_attributes["id"], '-', $count, '"', $this->getAttributes(array("id", "value", "checked")), ' value="', $this->filter($value), '"';
			echo '<li> <input id="', $this->_attributes["id"], '-', $count, '"', $this->getAttributes(array("id", "value", "checked")), ' value="', $this->filter($value), '"';
			if(isset($this->_attributes["value"]) && $this->_attributes["value"] == $value)
				echo ' checked="checked"';
			//echo '/> ', $text, ' </label> ';
			echo '/> ', $text, ' </li> ';
			++$count;
		}
                
                if(isset($this->_attributes["rm_is_other_option"]) && $this->_attributes["rm_is_other_option"] == 1){                        
                   echo '<li>'.
                        '<input id="'.$this->_attributes["id"].'_other" type="radio" value="" name="'.$this->getAttribute("name").'" style="'.$this->getAttribute("style").'">Other</li>'.
                        '<li id="'.$this->_attributes["id"].'_other_section" style="display:none">'.
                        '<input style="'.$this->getAttribute("style").'" type="text" id="'.$this->_attributes["id"].'_other_input" name="'.$this->getAttribute("name").'" disabled>'.
                        '</li>';
                }
            echo '</ul>';
	}
}
