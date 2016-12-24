<?php

//tell WP about our shortcode
add_shortcode( 'scd_business_hours', 'business_hours_shortcode' );

function business_hours_shortcode(){

$scd_option = scd_get_global_options(); 
   get_option('scd_options');
      
	  if( !empty($args) ) {
	extract( $args );
	}
   
   echo $before_widget;
   // Display the widget
   echo '<div class="widget-text wp_widget_plugin_box" style:>';
   // Get values
	if( $scd_option['scd_business_hours_title'] ) {
		echo $scd_option['scd_business_hours_title'];
		echo '<br>';
			}
	if( $scd_option['scd_business_hours_monday'] ) {
		echo 'Monday:&nbsp;&nbsp;';
		echo $scd_option['scd_business_hours_monday'];
		echo '<br>';
			}
	if( $scd_option['scd_business_hours_tuesday'] ) {
		echo 'Tuesday:&nbsp;&nbsp;';
		echo $scd_option['scd_business_hours_tuesday'];
		echo '<br>';
			}
	if( $scd_option['scd_business_hours_wednesday'] ) {
		echo 'Wednesday:&nbsp;&nbsp;';
		echo $scd_option['scd_business_hours_wednesday'];
		echo '<br>';
			}
	if( $scd_option['scd_business_hours_thursday'] ) {
		echo 'Thursday:&nbsp;&nbsp;';
		echo $scd_option['scd_business_hours_thursday'];
		echo '<br>';
			}
	if( $scd_option['scd_business_hours_friday'] ) {
		echo 'Friday:&nbsp;&nbsp;';
		echo $scd_option['scd_business_hours_friday'];
		echo '<br>';
			}
	if( $scd_option['scd_business_hours_saturday'] ) {
		echo 'Saturday:&nbsp;&nbsp;';
		echo $scd_option['scd_business_hours_saturday'];
		echo '<br>';
			}
	if( $scd_option['scd_business_hours_sunday'] ) {
		echo 'Sunday:&nbsp;&nbsp;';
		echo $scd_option['scd_business_hours_sunday'];
		echo '<br>';
			}		
	}

class business_hours extends WP_Widget {

	// constructor
    function business_hours() {
        parent::WP_Widget(false, $name = __('Business Hours', 'business_hours') );
    }

	// widget form creation
function form($instance) {}



	// display widget
function widget($args) {
   $scd_option = scd_get_global_options(); 
   get_option('scd_options');
   extract( $args );
   
   echo $before_widget;
   // Display the widget
   echo '<div class="widget-text wp_widget_plugin_box" style:>';
   
   echo do_shortcode('[scd_business_hours]'); 
   						
   echo '</div>';
   echo $after_widget;
}
}	
// register widget
add_action('widgets_init', create_function('', 'return register_widget("business_hours");'));

?>