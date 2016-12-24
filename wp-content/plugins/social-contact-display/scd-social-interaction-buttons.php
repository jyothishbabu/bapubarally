<?php

//tell WP about our shortcode
add_shortcode( 'scd_social_share', 'social_interaction_buttons_shortcode' );

function social_interaction_buttons_shortcode(){

$scd_option = scd_get_global_options(); 
   get_option('scd_options');
      
	  if( !empty($args) ) {
	extract( $args );
	}
   
   echo $before_widget;
   // Display the widget
   echo '<div class="widget-text wp_widget_plugin_box" style:>';
   
   // Get $select value
	if( $scd_option['scd_twitter_acc'] ) {
		include_once "includes/twitter-follow.php";
			}	
	if( $scd_option['scd_facebook_button'] ) {
		include_once "includes/facebook-like.php";
			}
	if( $scd_option['scd_gplus_button'] ) {
		include_once "includes/google-plus.php";
			}
	if( $scd_option['scd_pinterest_button'] ) {
		include_once "includes/pinterest.php";
			}	
}

class social_interaction_buttons extends WP_Widget {

	// constructor
    function social_interaction_buttons() {
        parent::WP_Widget(false, $name = __('Social Interaction Buttons', 'social_interaction_buttons') );
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
   
   echo do_shortcode('[scd_social_share]'); 
   						
   echo '</div>';
   echo $after_widget;
}
}	
// register widget
add_action('widgets_init', create_function('', 'return register_widget("social_interaction_buttons");'));

?>