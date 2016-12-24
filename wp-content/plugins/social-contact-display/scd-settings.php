<?php
/*
Plugin Name: Social Contact Display
Plugin URI: http://demo.wp-creative.co.uk/social-contact-display-widget/
Description: Display your contact details and social media pages easily through this simple widget or shortcode. Need WordPress hosting? <a href="http://quickclickhosting.com/cms/wordpress-hosting/">Quick Click Hosting</a> premium WP hosting starts from only 1.95 per month!
Version: 3.0.3
Author: WPCreative (Ian Norris, James White)
License: GPL2+
Author URI: http://www.wp-creative.co.uk
*/


/**
 * Define Constants
 */
define('SCD_SHORTNAME', 'scd');
define('SCD_PAGE_BASENAME', 'scd-settings');

/**
 * Specify Hooks/Filters
 */
add_action( 'admin_menu', 'scd_add_menu' );
add_action( 'admin_init', 'scd_register_settings' );

/**
 * Include the required files
 */
// helper functions
require_once('scd-helper-functions.php');
// page settings sections & fields as well as the contextual help text.
require_once('scd-options.php');
require_once('scd-helper-functions.php');
require_once('scd-widget.php');
require_once('scd-social-interaction-buttons.php');
require_once('scd-googlemap-v3.php');
require_once('scd-business-hours.php');
require_once('scd-custom-css.php');
//Load legacy Simple Social Contact Display widget
require_once('simple-social-contact-display.php');

// Tanslation

function social_contact_display_init() {
  load_plugin_textdomain( 'social-contact-display', false, 'social-contact-display/languages' );
}
add_action('init', 'social_contact_display_init');

// Adding WordPress plugin action links
 
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'ts_add_plugin_action_links' );
function ts_add_plugin_action_links( $links ) {
 
	return array_merge(
		array(
			'faq' => '<a href="' . get_bloginfo( 'wpurl' ) . '/wp-admin/tools.php?page=scd-settings">Settings</a>'
		),
		$links
	);
 
}

add_filter( 'plugin_row_meta', 'ts_plugin_meta_links', 10, 2 );
function ts_plugin_meta_links( $links, $file ) {
 
	$plugin = plugin_basename(__FILE__);
 
	// create link
	if ( $file == $plugin ) {
		return array_merge(
			$links,
			array( '<a href="http://wordpress.org/plugins/social-contact-display/faq/ target="_blank"">FAQ</a>' )
		);
	}
	return $links;
 
}
 
/**
 * Helper function for defining variables for the current page
 *
 * @return array
 */
function scd_get_settings() {
	
	$output = array();
	
	/*PAGES*/
	// get current page
	$page = scd_get_admin_page();
	
	/*TABS*/
	// get current tab
	$tab = scd_get_the_tab();
	
	/*DEFINE VARS*/
	// define variables according to registered admin menu page: scd_add_menu()
	switch ($page) {
	
		case SCD_PAGE_BASENAME:
			$scd_option_name 		= 'scd_options_two';
			$scd_settings_page_title = __( 'SCD Settings','scd_textdomain');
			$scd_page_sections 		= scd_options_two_page_sections();
			$scd_page_fields 		= scd_options_two_page_fields();
			$scd_contextual_help 	= scd_options_two_page_contextual_help();
			$scd_page_tabs 			= scd_options_two_page_tabs();
			
			// define a new option name according to tab
			switch ($tab) {
				// Contact Details
				case 'Contact Details':
					$scd_option_name = $scd_option_name . '_contact_details';
				break;
				
				// Social Media
				case 'social-media':
					$scd_option_name = $scd_option_name . '_social_media';
				break;
				
				// Social Share
				case 'social-share':
					$scd_option_name = $scd_option_name . '_social_share';
				break;
				
				// Google Map
				case 'google-map':
					$scd_option_name = $scd_option_name . '_google_map';
				break;
				
				// Business Hours
				case 'business-hours':
					$scd_option_name = $scd_option_name . '_business_hours';
				break;
			}
		break;
	}
	
	// put together the output array 
	$output['scd_option_name'] 		= $scd_option_name;
	$output['scd_page_title'] 		= $scd_settings_page_title;
	$output['scd_page_tabs']			= $scd_page_tabs;
	$output['scd_page_sections'] 	= $scd_page_sections;
	$output['scd_page_fields'] 		= $scd_page_fields;
	$output['scd_contextual_help'] 	= $scd_contextual_help;
	
return $output;
}

/**
 * Helper function for registering our form field settings
 *
 * @param (array) $args The array of arguments to be used in creating the field
 * @return function call
 */
function scd_create_settings_field( $args = array() ) {
	// default array to overwrite when calling the function
	$defaults = array(
		'id'      => 'default_field', 					// the ID of the setting in our options array, and the ID of the HTML form element
		'title'   => 'Default Field', 					// the label for the HTML form element
		'desc'    => 'This is a default description.', 	// the description displayed under the HTML form element
		'std'     => '', 								// the default value for this setting
		'type'    => 'text', 							// the HTML form element to use
		'section' => 'main_section', 					// the section this setting belongs to ? must match the array key of a section in scd_options_page_sections()
		'choices' => array(), 							// (optional): the values in radio buttons or a drop-down menu
		'class'   => '' 								// the HTML form element class. Is used for validation purposes and may be also use for styling if needed.
	);
	
	// "extract" to be able to use the array keys as variables in our function output below
	extract( wp_parse_args( $args, $defaults ) );
	
	// additional arguments for use in form field output in the function scd_form_field_fn!
	$field_args = array(
		'type'      => $type,
		'id'        => $id,
		'desc'      => $desc,
		'std'       => $std,
		'choices'   => $choices,
		'label_for' => $id,
		'class'     => $class
	);

	add_settings_field( $id, $title, 'scd_form_field_fn', __FILE__, $section, $field_args );

}

/*
 * Register our setting
 */
function scd_register_settings(){
	
	// get the settings sections array
	$settings_output 	= scd_get_settings();
	$scd_option_name = $settings_output['scd_option_name'];
	
	//setting
	// register_setting( $option_group, $option_name, $sanitize_callback );
	register_setting($scd_option_name, $scd_option_name, 'scd_validate_options' );
	
	//sections
	// add_settings_section( $id, $title, $callback, $page );
	if(!empty($settings_output['scd_page_sections'])){
		// call the "add_settings_section" for each!
		foreach ( $settings_output['scd_page_sections'] as $id => $title ) {
			add_settings_section( $id, $title, 'scd_section_fn', __FILE__);
		}
	}
	
	//fields
	if(!empty($settings_output['scd_page_fields'])){
		// call the "add_settings_field" for each!
		foreach ($settings_output['scd_page_fields'] as $option) {
			scd_create_settings_field($option);
		}
	}
}

/*
 * Group scripts (js & css)
 */
function scd_settings_scripts(){
	wp_enqueue_style('scd_settings_css', get_template_directory_uri() . '/lib/css/scd_settings.css');
	wp_enqueue_script( 'scd_settings_js', get_template_directory_uri() . '/lib/js/scd_settings.js', array('jquery'));
}

/*
 * The admin menu pages
 */
function scd_add_menu(){
	
	$settings_output 		= scd_get_settings();
	// collect our contextual help text
	$scd_contextual_help = $settings_output['scd_contextual_help'];
	
	// As a "top level" menu
	// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position ); 
	add_menu_page( __('Social Contact Display'), __('SCD Settings','scd_textdomain'), 'manage_options', SCD_PAGE_BASENAME, 'scd_settings_page_fn');
	
	// page two
	$scd_settings_page_two = add_submenu_page(SCD_PAGE_BASENAME, __('SCD Settings | Widget Options', 'scd_textdomain'), __('Widget Options','scd_textdomain'), 'manage_options', SCD_PAGE_BASENAME, 'scd_settings_page_fn');
		// contextual help
		if ($scd_settings_page_two) {
			add_contextual_help( $scd_settings_page_two, $scd_contextual_help );
		}
		// css & js
		add_action( 'load-'. $scd_settings_page_two, 'scd_settings_scripts' );
}

// ************************************************************************************************************

// Callback functions

/*
 * Descriptions on help for each tab
 */
function  scd_section_fn($desc) {

// get current tab
	$tab = scd_get_the_tab();

	if ($tab == 'google-map'){
	echo "<p>" . __('Shortcode for this section is: [scd_google_map]. For more information on settings, please see <a href="https://developers.google.com/maps/documentation/staticmaps/" target="_blank" >here</a>','scd_textdomain') . "</p>";
	}
	elseif ($tab == 'contact-details') {
		echo "<p>" . __('Widget for this section is: <strong>Social Contact Display</strong><br>Shortcode for this section is: <strong>[scd_social_contact_display]</strong>','scd_textdomain') . "</p>";
		}
	elseif ($tab == 'social-media') {
		echo "<p>" . __('Settings for this section','scd_textdomain') . "</p>";
		}
	elseif ($tab == 'social-share') {
		echo "<p>" . __('Widget for this section is: <strong>Social Interaction Buttons</strong><br>Shortcode for this section is: <strong>[scd_social_share]</strong>','scd_textdomain') . "</p>";
		}
	elseif ($tab =='info') {
		echo "<p>" . __('<a href="http://quickclickhosting.com/wordpress-hosting-uk/" target=_"blank"><img style="float:right;padding-left:10px;" src="http://www.quickclickhosting.com/images/wphosting.jpg"></a><strong>What has changed in Version 2?</strong><br><br>We have added a more advanced set of widgets. The options are entered via the settings page under "SCD Settings". We have kept the original widget but renamed it as "Simple Social Contact Display". This should keep all of your previous options, but you will need to re-add the widget itself.<br><br>Also added is a Google Map option. This is a static map, for now, and coordinates will need to be entered - How to get coordinates.<br><br><strong>What are the shortcodes?</strong><br><br>Contact Details/Social Media - [scd_social_contact_display]<br> Social Sharing - [scd_social_share]<br> Google Map - [scd_google_static_map]<br><br><strong>Which Social Media sites are currently supported?</strong><br><br>Facebook Google+ Twitter LinkedIn YouTube Pinterest Instagram<br><br><strong>I have a suggestion for the plugin, where can I submit it?</strong><br><br>Either via the support tab, or via our site:<br><a href="http://demo.wp-creative.co.uk/social-contact-display-widget/plugin-suggestion/" target="_blank" >WP Creative</a><br>') . "</p>";
		} 
}

/*
 * Form Fields HTML
 * All form field types share the same function!!
 * @return echoes output
 */
function scd_form_field_fn($args = array()) {
	
	extract( $args );
	
	// get the settings sections array
	$settings_output 	= scd_get_settings();
	
	$scd_option_name = $settings_output['scd_option_name'];
	$options 			= get_option($scd_option_name);
	
	// pass the standard value if the option is not yet set in the database
	if ( !isset( $options[$id] ) && 'type' != 'checkbox' ) {
		$options[$id] = $std;
	}
	
	// additional field class. output only if the class is defined in the create_setting arguments
	$field_class = ($class != '') ? ' ' . $class : '';
	
	// switch html display based on the setting type.	
	switch ( $type ) {
		case 'text':
			$options[$id] = stripslashes($options[$id]);
			$options[$id] = esc_attr( $options[$id]);
			echo "<input class='regular-text$field_class' type='text' id='$id' name='" . $scd_option_name . "[$id]' value='$options[$id]' />";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
		break;
		
		case "multi-text":
			foreach($choices as $item) {
				$item = explode("|",$item); // cat_name|cat_slug
				$item[0] = esc_html__($item[0], 'scd_textdomain');
				if (!empty($options[$id])) {
					foreach ($options[$id] as $option_key => $option_val){
						if ($item[1] == $option_key) {
							$value = $option_val;
						}
					}
				} else {
					$value = '';
				}
				echo "<span>$item[0]:</span> <input class='$field_class' type='text' id='$id|$item[1]' name='" . $scd_option_name . "[$id|$item[1]]' value='$value' /><br/>";
			}
			echo ($desc != '') ? "<span class='description'>$desc</span>" : "";
		break;
		
		case 'textarea':
			$options[$id] = stripslashes($options[$id]);
			$options[$id] = esc_html( $options[$id]);
			echo "<textarea class='textarea$field_class' type='text' id='$id' name='" . $scd_option_name . "[$id]' rows='5' cols='30'>$options[$id]</textarea>";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : ""; 		
		break;
		
		case 'select':
			echo "<select id='$id' class='select$field_class' name='" . $scd_option_name . "[$id]'>";
				foreach($choices as $item) {
					$value 	= esc_attr($item, 'scd_textdomain');
					$item 	= esc_html($item, 'scd_textdomain');
					
					$selected = ($options[$id]==$value) ? 'selected="selected"' : '';
					echo "<option value='$value' $selected>$item</option>";
				}
			echo "</select>";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : ""; 
		break;
		
		case 'select2':
			echo "<select id='$id' class='select$field_class' name='" . $scd_option_name . "[$id]'>";
			foreach($choices as $item) {
				
				$item = explode("|",$item);
				$item[0] = esc_html($item[0], 'scd_textdomain');
				
				$selected = ($options[$id]==$item[1]) ? 'selected="selected"' : '';
				echo "<option value='$item[1]' $selected>$item[0]</option>";
			}
			echo "</select>";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
		break;
		
		case 'checkbox':
			echo "<input class='checkbox$field_class' type='checkbox' id='$id' name='" . $scd_option_name . "[$id]' value='1' " . checked( $options[$id], 1, false ) . " />";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
		break;
		
		case "multi-checkbox":
			foreach($choices as $item) {
				
				$item = explode("|",$item);
				$item[0] = esc_html($item[0], 'scd_textdomain');
				
				$checked = '';
				
			    if ( isset($options[$id][$item[1]]) ) {
					if ( $options[$id][$item[1]] == 'true') {
			   			$checked = 'checked="checked"';
					}
				}
				
				echo "<input class='checkbox$field_class' type='checkbox' id='$id|$item[1]' name='" . $scd_option_name . "[$id|$item[1]]' value='1' $checked /> $item[0] <br/>";
			}
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
		break;
	}
}

/*
 * Admin Settings Page HTML
 * 
 * @return echoes output
 */
function scd_settings_page_fn() {
// get the settings sections array
	$settings_output = scd_get_settings();
?>
	<div class="wrap">
		<?php 
		// displays the page title and tabs (if needed)
		scd_settings_page_header(); 
		?>
		
				
		<form action="options.php" method="post">
			<?php 
			// http://codex.wordpress.org/Function_Reference/settings_fields
			settings_fields($settings_output['scd_option_name']); 
			// http://codex.wordpress.org/Function_Reference/do_settings_sections
			do_settings_sections(__FILE__); 
			?>
			<p class="submit">
				<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes','scd_textdomain'); ?>" />
			</p>
			
		</form>
	</div><!-- wrap -->
<?php }

/*
 * Validate input
 * 
 * @return array
 */
function scd_validate_options($input) {
	
	// for enhanced security, create a new empty array
	$valid_input = array();
	
	// collect only the values we expect and fill the new $valid_input array i.e. whitelist our option IDs
	
		// get the settings sections array
		$settings_output = scd_get_settings();
		
		$options = $settings_output['scd_page_fields'];
		
		// run a foreach and switch on option type
		foreach ($options as $option) {
		
			switch ( $option['type'] ) {
				case 'text':
					//switch validation based on the class!
					switch ( $option['class'] ) {
						//for numeric 
						case 'numeric':
							//accept the input only when numeric!
							$input[$option['id']] 		= trim($input[$option['id']]); // trim whitespace
							$valid_input[$option['id']] = (is_numeric($input[$option['id']])) ? $input[$option['id']] : 'Expecting a Numeric value!';
							
							// register error
							if(is_numeric($input[$option['id']]) == FALSE) {
								add_settings_error(
									$option['id'], // setting title
									SCD_SHORTNAME . '_txt_numeric_error', // error ID
									__('Expecting a Numeric value! Please fix.','scd_textdomain'), // error message
									'error' // type of message
								);
							}
						break;
						
						//for multi-numeric values (separated by a comma)
						case 'multinumeric':
							//accept the input only when the numeric values are comma separated
							$input[$option['id']] 		= trim($input[$option['id']]); // trim whitespace
							
							if($input[$option['id']] !=''){
								// /^-?\d+(?:,\s?-?\d+)*$/ matches: -1 | 1 | -12,-23 | 12,23 | -123, -234 | 123, 234  | etc.
								$valid_input[$option['id']] = (preg_match('/^-?\d+(?:,\s?-?\d+)*$/', $input[$option['id']]) == 1) ? $input[$option['id']] : __('Expecting comma separated numeric values','scd_textdomain');
							}else{
								$valid_input[$option['id']] = $input[$option['id']];
							}
							
							// register error
							if($input[$option['id']] !='' && preg_match('/^-?\d+(?:,\s?-?\d+)*$/', $input[$option['id']]) != 1) {
								add_settings_error(
									$option['id'], // setting title
									SCD_SHORTNAME . '_txt_multinumeric_error', // error ID
									__('Expecting comma separated numeric values! Please fix.','scd_textdomain'), // error message
									'error' // type of message
								);
							}
						break;
						
						//for no html
						case 'nohtml':
							//accept the input only after stripping out all html, extra white space etc!
							$input[$option['id']] 		= sanitize_text_field($input[$option['id']]); // need to add slashes still before sending to the database
							$valid_input[$option['id']] = addslashes($input[$option['id']]);
						break;
						
						//for url
						case 'url':
							//accept the input only when the url has been sanited for database usage with esc_url_raw()
							$input[$option['id']] 		= trim($input[$option['id']]); // trim whitespace
							$valid_input[$option['id']] = esc_url_raw($input[$option['id']]);
						break;
						
						//for email
						case 'email':
							//accept the input only after the email has been validated
							$input[$option['id']] 		= trim($input[$option['id']]); // trim whitespace
							if($input[$option['id']] != ''){
								$valid_input[$option['id']] = (is_email($input[$option['id']])!== FALSE) ? $input[$option['id']] : __('Invalid email! Please re-enter!','scd_textdomain');
							}
						break;
						
						// a "cover-all" fall-back when the class argument is not set
						default:
							// accept only a few inline html elements
							$allowed_html = array(
								'a' => array('href' => array (),'title' => array ()),
								'b' => array(),
								'em' => array (), 
								'i' => array (),
								'strong' => array()
							);
							
							$input[$option['id']] 		= trim($input[$option['id']]); // trim whitespace
							$input[$option['id']] 		= force_balance_tags($input[$option['id']]); // find incorrectly nested or missing closing tags and fix markup
							$input[$option['id']] 		= wp_kses( $input[$option['id']], $allowed_html); // need to add slashes still before sending to the database
							$valid_input[$option['id']] = addslashes($input[$option['id']]); 
						break;
					}
				break;
				
				case "multi-text":
					// this will hold the text values as an array of 'key' => 'value'
					unset($textarray);
					
					$text_values = array();
					foreach ($option['choices'] as $k => $v ) {
						// explode the connective
						$pieces = explode("|", $v);
						
						$text_values[] = $pieces[1];
					}
					
					foreach ($text_values as $v ) {		
						
						// Check that the option isn't empty
						if (!empty($input[$option['id'] . '|' . $v])) {
							// If it's not null, make sure it's sanitized, add it to an array
							switch ($option['class']) {
								// different sanitation actions based on the class create you own cases as you need them
								
								//for numeric input
								case 'numeric':
									//accept the input only if is numberic!
									$input[$option['id'] . '|' . $v]= trim($input[$option['id'] . '|' . $v]); // trim whitespace
									$input[$option['id'] . '|' . $v]= (is_numeric($input[$option['id'] . '|' . $v])) ? $input[$option['id'] . '|' . $v] : '';
								break;
								
								// a "cover-all" fall-back when the class argument is not set
								default:
									// strip all html tags and white-space.
									$input[$option['id'] . '|' . $v]= sanitize_text_field($input[$option['id'] . '|' . $v]); // need to add slashes still before sending to the database
									$input[$option['id'] . '|' . $v]= addslashes($input[$option['id'] . '|' . $v]);
								break;
							}
							// pass the sanitized user input to our $textarray array
							$textarray[$v] = $input[$option['id'] . '|' . $v];
						
						} else {
							$textarray[$v] = '';
						}
					}
					// pass the non-empty $textarray to our $valid_input array
					if (!empty($textarray)) {
						$valid_input[$option['id']] = $textarray;
					}
				break;
				
				case 'textarea':
					//switch validation based on the class!
					switch ( $option['class'] ) {
						//for only inline html
						case 'inlinehtml':
							// accept only inline html
							$input[$option['id']] 		= trim($input[$option['id']]); // trim whitespace
							$input[$option['id']] 		= force_balance_tags($input[$option['id']]); // find incorrectly nested or missing closing tags and fix markup
							$input[$option['id']] 		= addslashes($input[$option['id']]); //wp_filter_kses expects content to be escaped!
							$valid_input[$option['id']] = wp_filter_kses($input[$option['id']]); //calls stripslashes then addslashes
						break;
						
						//for no html
						case 'nohtml':
							//accept the input only after stripping out all html, extra white space etc!
							$input[$option['id']] 		= sanitize_text_field($input[$option['id']]); // need to add slashes still before sending to the database
							$valid_input[$option['id']] = addslashes($input[$option['id']]);
						break;
						
						//for allowlinebreaks
						case 'allowlinebreaks':
							//accept the input only after stripping out all html, extra white space etc!
							$input[$option['id']] 		= wp_strip_all_tags($input[$option['id']]); // need to add slashes still before sending to the database
							$valid_input[$option['id']] = addslashes($input[$option['id']]);
						break;
						
						// a "cover-all" fall-back when the class argument is not set
						default:
							// accept only limited html
							//my allowed html
							$allowed_html = array(
								'a' 			=> array('href' => array (),'title' => array ()),
								'b' 			=> array(),
								'blockquote' 	=> array('cite' => array ()),
								'br' 			=> array(),
								'dd' 			=> array(),
								'dl' 			=> array(),
								'dt' 			=> array(),
								'em' 			=> array (), 
								'i' 			=> array (),
								'li' 			=> array(),
								'ol' 			=> array(),
								'p' 			=> array(),
								'q' 			=> array('cite' => array ()),
								'strong' 		=> array(),
								'ul' 			=> array(),
								'h1' 			=> array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
								'h2' 			=> array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
								'h3' 			=> array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
								'h4' 			=> array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
								'h5' 			=> array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
								'h6' 			=> array('align' => array (),'class' => array (),'id' => array (), 'style' => array ())
							);
							
							$input[$option['id']] 		= trim($input[$option['id']]); // trim whitespace
							$input[$option['id']] 		= force_balance_tags($input[$option['id']]); // find incorrectly nested or missing closing tags and fix markup
							$input[$option['id']] 		= wp_kses( $input[$option['id']], $allowed_html); // need to add slashes still before sending to the database
							$valid_input[$option['id']] = addslashes($input[$option['id']]);							
						break;
					}
				break;
				
				case 'select':
					// check to see if the selected value is in our approved array of values!
					$valid_input[$option['id']] = (in_array( $input[$option['id']], $option['choices']) ? $input[$option['id']] : '' );
				break;
				
				case 'select2':
					// process $select_values
						$select_values = array();
						foreach ($option['choices'] as $k => $v) {
							// explode the connective
							$pieces = explode("|", $v);
							
							$select_values[] = $pieces[1];
						}
					// check to see if selected value is in our approved array of values!
					$valid_input[$option['id']] = (in_array( $input[$option['id']], $select_values) ? $input[$option['id']] : '' );
				break;
				
				case 'checkbox':
					// if it's not set, default to null!
					if (!isset($input[$option['id']])) {
						$input[$option['id']] = null;
					}
					// Our checkbox value is either 0 or 1
					$valid_input[$option['id']] = ( $input[$option['id']] == 1 ? 1 : 0 );
				break;
				
				case 'multi-checkbox':
					unset($checkboxarray);
					$check_values = array();
					foreach ($option['choices'] as $k => $v ) {
						// explode the connective
						$pieces = explode("|", $v);
						
						$check_values[] = $pieces[1];
					}
					
					foreach ($check_values as $v ) {		
						
						// Check that the option isn't null
						if (!empty($input[$option['id'] . '|' . $v])) {
							// If it's not null, make sure it's true, add it to an array
							$checkboxarray[$v] = 'true';
						}
						else {
							$checkboxarray[$v] = 'false';
						}
					}
					// Take all the items that were checked, and set them as the main option
					if (!empty($checkboxarray)) {
						$valid_input[$option['id']] = $checkboxarray;
					}
				break;
				
			}
		}
return $valid_input; // return validated input
}

 /**
 * Helper function for creating admin messages
 * src: http://www.wprecipes.com/how-to-show-an-urgent-message-in-the-wordpress-admin-area
 *
 * @param (string) $message The message to echo
 * @param (string) $msgclass The message class
 * @return echoes the message
 */
function scd_show_msg($message, $msgclass = 'info') {
	echo "<div id='message' class='$msgclass'>$message</div>";
}

 /**
 * Callback function for displaying admin messages
 *
 * @return calls scd_show_msg()
 */
function scd_admin_msgs() {
	
	// check for our settings page - need this in conditional further down
	$scd_settings_pg = strpos($_GET['page'], SCD_PAGE_BASENAME);
	// collect setting errors/notices: //http://codex.wordpress.org/Function_Reference/get_settings_errors
	$set_errors = get_settings_errors(); 
	
	//display admin message only for the admin to see, only on our settings page and only when setting errors/notices are returned!	
	if(current_user_can ('manage_options') && $scd_settings_pg !== FALSE && !empty($set_errors)){

		// have our settings succesfully been updated? 
		if($set_errors[0]['code'] == 'settings_updated' && isset($_GET['settings-updated'])){
			scd_show_msg("<p>" . $set_errors[0]['message'] . "</p>", 'updated');
		
		// have errors been found?
		}else{
			// there maybe more than one so run a foreach loop.
			foreach($set_errors as $set_error){
				// set the title attribute to match the error "setting title" - need this in js file
				scd_show_msg("<p class='setting-error-message' title='" . $set_error['setting'] . "'>" . $set_error['message'] . "</p>", 'error');
			}
		}
	}
}

// admin messages hook!
add_action('admin_notices', 'scd_admin_msgs');

?>