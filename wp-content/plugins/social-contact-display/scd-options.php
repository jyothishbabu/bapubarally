<?php
/**
 * Define page tabs
 *
 */
function scd_options_two_page_tabs() {
	
	$tabs = array();
	
	$tabs['info'] 	= __('Info', 'scd');
	$tabs['contact-details'] 	= __('Contact Details', 'scd');	
	$tabs['social-media'] 	= __('Social Media', 'scd');	
	$tabs['social-share'] 		= __('Social Sharing', 'scd');
	$tabs['google-map']		= __('Google Map', 'scd');
	$tabs['business-hours']		= __('Business Hours', 'scd');
	
	return $tabs;
}

/**
 * Define our settings sections
 *
 * array key=$id, array value=$title in: add_settings_section( $id, $title, $callback, $page );
 * @return array
 */
function scd_options_two_page_sections() {
	// we change the output based on open tab
	
	// get the current tab
	$tab = scd_get_the_tab();

	// switch sections array according to tab
	switch ($tab) {
		//Info
		case 'info':
			$sections = array();
			$sections['txt_section'] 		= __('Info', 'scd_textdomain');
		break;
		
		//Contact Details
		case 'contact-details':
			$sections = array();
			$sections['txt_section'] 		= __('Contact Details', 'scd_textdomain');
		break;
		
		// Social Media
		case 'social-media':
			$sections = array();
			$sections['socialmedia_section'] 		= __('Social Media Icons', 'scd_textdomain');
		break;
		
		// Social Sharing
        case 'social-share':
			$sections = array();
			$sections['social_interaction_twitter_section'] 	= __('<div id="socialshareadmin">Twitter</div>', 'scd_textdomain');
			$sections['social_interaction_facebook_section'] 	= __('<div id="socialshareadmin">Facebook</div>', 'scd_textdomain');
			$sections['social_interaction_gplus_section'] 	= __('<div id="socialshareadmin">Google+</div>', 'scd_textdomain');
			$sections['social_interaction_pinterest_section'] 	= __('<div id="socialshareadmin">Pinterest</div>', 'scd_textdomain');
		break;
		
		// Google Map
        case 'google-map':
			$sections = array();
			$sections['google_map_section'] 	= __('Static Google Map Image Settings', 'scd_textdomain');
		break;
		
		// Business Hours
        case 'business-hours':
			$sections = array();
			$sections['business_hours_section'] 	= __('Business Hours Settings', 'scd_textdomain');
		break;
	}
	
return $sections;	
} 

/**
 * Define our form fields (options) 
 *
 * @return array
 */
function scd_options_two_page_fields() {

	// get the current tab
	$tab = scd_get_the_tab();
	
	// get global options
	$scd_option = scd_get_global_options();
	
	// setting fields according to tab
	switch ($tab) {
		case 'contact-details':
		//Contact Details Settings	 
	$options[] = array(
		"section" => "txt_section",
		"id"      => SCD_SHORTNAME . "_txt_title",
		"title"   => __( 'Business Title:', 'scd_textdomain' ),
		"desc"    => __( 'A regular text input field. Some inline HTML (&lt;a&gt;, &lt;b&gt;, &lt;em&gt;, &lt;i&gt;, &lt;strong&gt;) is allowed.', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('','scd_textdomain')
	);
	
	$options[] = array(
		"section" => "txt_section",
		"id"      => SCD_SHORTNAME . "_txt_addresslineone",
		"title"   => __( 'Address Line One:', 'scd_textdomain' ),
		"desc"    => __( 'A regular text input field. Some inline HTML (&lt;a&gt;, &lt;b&gt;, &lt;em&gt;, &lt;i&gt;, &lt;strong&gt;) is allowed.', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('','scd_textdomain')
	);
	
	$options[] = array(
		"section" => "txt_section",
		"id"      => SCD_SHORTNAME . "_txt_addresslinetwo",
		"title"   => __( 'Address Line Two:', 'scd_textdomain' ),
		"desc"    => __( 'A regular text input field. Some inline HTML (&lt;a&gt;, &lt;b&gt;, &lt;em&gt;, &lt;i&gt;, &lt;strong&gt;) is allowed.', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('','scd_textdomain')
	);
	
	$options[] = array(
		"section" => "txt_section",
		"id"      => SCD_SHORTNAME . "_txt_city",
		"title"   => __( 'City / Town:', 'scd_textdomain' ),
		"desc"    => __( 'A regular text input field. Some inline HTML (&lt;a&gt;, &lt;b&gt;, &lt;em&gt;, &lt;i&gt;, &lt;strong&gt;) is allowed.', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('','scd_textdomain')
	);
	
	$options[] = array(
		"section" => "txt_section",
		"id"      => SCD_SHORTNAME . "_txt_county",
		"title"   => __( 'County / State:', 'scd_textdomain' ),
		"desc"    => __( 'A regular text input field. Some inline HTML (&lt;a&gt;, &lt;b&gt;, &lt;em&gt;, &lt;i&gt;, &lt;strong&gt;) is allowed.', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('','scd_textdomain')
	);
	
	$options[] = array(
		"section" => "txt_section",
		"id"      => SCD_SHORTNAME . "_txt_pcode",
		"title"   => __( 'Post Code / Zip Code:', 'scd_textdomain' ),
		"desc"    => __( 'A regular text input field. Some inline HTML (&lt;a&gt;, &lt;b&gt;, &lt;em&gt;, &lt;i&gt;, &lt;strong&gt;) is allowed.', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('','scd_textdomain')
	);
	
	$options[] = array(
		"section" => "txt_section",
		"id"      => SCD_SHORTNAME . "_txt_telephone",
		"title"   => __( 'Telephone (Can also add a prefix e.g. Tel:):', 'scd_textdomain' ),
		"desc"    => __( 'A regular text input field. Some inline HTML (&lt;a&gt;, &lt;b&gt;, &lt;em&gt;, &lt;i&gt;, &lt;strong&gt;) is allowed.', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('','scd_textdomain')
	);
	
	$options[] = array(
		"section" => "txt_section",
		"id"      => SCD_SHORTNAME . "_txt_mobile",
		"title"   => __( 'Mobile (Can also add a prefix e.g. Mob:):', 'scd_textdomain' ),
		"desc"    => __( 'A regular text input field. Some inline HTML (&lt;a&gt;, &lt;b&gt;, &lt;em&gt;, &lt;i&gt;, &lt;strong&gt;) is allowed.', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('','scd_textdomain')
	);
	
	$options[] = array(
		"section" => "txt_section",
		"id"      => SCD_SHORTNAME . "_txt_fax",
		"title"   => __( 'Fax (Can also add a prefix e.g. Fax:):', 'scd_textdomain' ),
		"desc"    => __( 'A regular text input field. Some inline HTML (&lt;a&gt;, &lt;b&gt;, &lt;em&gt;, &lt;i&gt;, &lt;strong&gt;) is allowed.', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('','scd_textdomain')
	);
	
	$options[] = array(
		"section" => "txt_section",
		"id"      => SCD_SHORTNAME . "_txt_email",
		"title"   => __( 'Email:', 'scd_textdomain' ),
		"desc"    => __( 'A text input field which can be used for email input.', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => "email@email.com",
//		"class"   => "email"
	);
		break;
	
		case 'social-media':
		//Social Media Settings
	$options[] = array(
		"section" => "socialmedia_section",
		"id"      => SCD_SHORTNAME . "_update_social_media_alt",
		"title"   => __( 'Update Alt Text:', 'scd_textdomain' ),
		"desc"    => __( '', 'scd_textdomain' ),
		"type"    => "checkbox",
		"std"     => "0"
	);	
		
	$options[] = array(
		"section" => "socialmedia_section",
		"id"      => SCD_SHORTNAME . "_txt_socialiconstitle",
		"title"   => __( 'Social Icons Title (e.g. Connect with Us):', 'scd_textdomain' ),
		"desc"    => __( 'A regular text input field. Some inline HTML (&lt;a&gt;, &lt;b&gt;, &lt;em&gt;, &lt;i&gt;, &lt;strong&gt;) is allowed.', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('Get in touch!','scd_textdomain')
	);
	
	$options[] = array(
		"section" => "socialmedia_section",
		"id"      => SCD_SHORTNAME . "_url_txt_facebook",
		"title"   => __( 'Facebook URL:', 'scd_textdomain' ),
		"desc"    => __( 'A text input field which can be used for urls.', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => "http://www.facebook.com",
		"class"   => "url"
	);

	If ($scd_option['scd_update_social_media_alt'] == "1") {
	$options[] = array(
		"section" => "socialmedia_section",
		"id"      => SCD_SHORTNAME . "_alt_facebook",
		"title"   => __( 'Facebook Alt Text:', 'scd_textdomain' ),
		"desc"    => __( 'A text input field', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => "WP Creative - Social Contact Display",
	);
	};
	
	$options[] = array(
		"section" => "socialmedia_section",
		"id"      => SCD_SHORTNAME . "_url_txt_twitter",
		"title"   => __( 'Twitter URL:', 'scd_textdomain' ),
		"desc"    => __( 'A text input field which can be used for urls.', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => "http://www.twitter.com",
		"class"   => "url"
	);
	
	If ($scd_option['scd_update_social_media_alt'] == "1") {
	$options[] = array(
		"section" => "socialmedia_section",
		"id"      => SCD_SHORTNAME . "_alt_twitter",
		"title"   => __( 'Twitter Alt Text:', 'scd_textdomain' ),
		"desc"    => __( 'A text input field', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => "WP Creative - Social Contact Display",
	);
	};
	
	$options[] = array(
		"section" => "socialmedia_section",
		"id"      => SCD_SHORTNAME . "_url_txt_gplus",
		"title"   => __( 'Google Plus URL:', 'scd_textdomain' ),
		"desc"    => __( 'A text input field which can be used for urls.', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => "http://plus.google.com",
		"class"   => "url"
	);
	
	If ($scd_option['scd_update_social_media_alt'] == "1") {
	$options[] = array(
		"section" => "socialmedia_section",
		"id"      => SCD_SHORTNAME . "_alt_gplus",
		"title"   => __( 'Google Plus Alt Text:', 'scd_textdomain' ),
		"desc"    => __( 'A text input field', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => "WP Creative - Social Contact Display",
	);
	};
	
	$options[] = array(
		"section" => "socialmedia_section",
		"id"      => SCD_SHORTNAME . "_url_txt_tumblr",
		"title"   => __( 'Tumblr URL:', 'scd_textdomain' ),
		"desc"    => __( 'A text input field which can be used for urls.', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => "http://www.tumblr.com",
		"class"   => "url"
	);
	
	If ($scd_option['scd_update_social_media_alt'] == "1") {
	$options[] = array(
		"section" => "socialmedia_section",
		"id"      => SCD_SHORTNAME . "_alt_tumblr",
		"title"   => __( 'Tumblr Alt Text:', 'scd_textdomain' ),
		"desc"    => __( 'A text input field', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => "WP Creative - Social Contact Display",
	);
	};
	
	$options[] = array(
		"section" => "socialmedia_section",
		"id"      => SCD_SHORTNAME . "_url_txt_linkedin",
		"title"   => __( 'Linked In URL:', 'scd_textdomain' ),
		"desc"    => __( 'A text input field which can be used for urls.', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => "http://www.linkedin.com",
		"class"   => "url"
	);
	
	If ($scd_option['scd_update_social_media_alt'] == "1") {
	$options[] = array(
		"section" => "socialmedia_section",
		"id"      => SCD_SHORTNAME . "_alt_linkedin",
		"title"   => __( 'Linked In Alt Text:', 'scd_textdomain' ),
		"desc"    => __( 'A text input field', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => "WP Creative - Social Contact Display",
	);
	};
	
	$options[] = array(
		"section" => "socialmedia_section",
		"id"      => SCD_SHORTNAME . "_url_txt_youtube",
		"title"   => __( 'YouTube URL:', 'scd_textdomain' ),
		"desc"    => __( 'A text input field which can be used for urls.', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => "http://www.youtube.com",
		"class"   => "url"
	);
	
	If ($scd_option['scd_update_social_media_alt'] == "1") {
	$options[] = array(
		"section" => "socialmedia_section",
		"id"      => SCD_SHORTNAME . "_alt_youtube",
		"title"   => __( 'YouTube Alt Text:', 'scd_textdomain' ),
		"desc"    => __( 'A text input field', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => "WP Creative - Social Contact Display",
	);
	};
	
	$options[] = array(
		"section" => "socialmedia_section",
		"id"      => SCD_SHORTNAME . "_url_txt_pinterest",
		"title"   => __( 'Pinterest URL:', 'scd_textdomain' ),
		"desc"    => __( 'A text input field which can be used for urls.', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => "http://www.pinterest.com",
		"class"   => "url"
	);
	
	If ($scd_option['scd_update_social_media_alt'] == "1") {
	$options[] = array(
		"section" => "socialmedia_section",
		"id"      => SCD_SHORTNAME . "_alt_pinterest",
		"title"   => __( 'Pinterest Alt Text:', 'scd_textdomain' ),
		"desc"    => __( 'A text input field', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => "WP Creative - Social Contact Display",
	);
	};
	
	$options[] = array(
		"section" => "socialmedia_section",
		"id"      => SCD_SHORTNAME . "_url_txt_instagram",
		"title"   => __( 'Instagram URL:', 'scd_textdomain' ),
		"desc"    => __( 'A text input field which can be used for urls.', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => "http://www.instagram.com",
		"class"   => "url"
	);
	
	If ($scd_option['scd_update_social_media_alt'] == "1") {
	$options[] = array(
		"section" => "socialmedia_section",
		"id"      => SCD_SHORTNAME . "_alt_instagram",
		"title"   => __( 'Instagram Alt Text:', 'scd_textdomain' ),
		"desc"    => __( 'A text input field', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => "WP Creative - Social Contact Display",
	);
	};
	
	$options[] = array(
		"section" => "socialmedia_section",
		"id"      => SCD_SHORTNAME . "_rss_checkbox",
		"title"   => __( 'Include RSS feed icon.', 'scd_textdomain' ),
		"desc"    => __( '', 'scd_textdomain' ),
		"type"    => "checkbox",
		"std"     => 0
	);
	
	$options[] = array(
		"section" => "socialmedia_section",
		"id"      => SCD_SHORTNAME . "_select_input",
		"title"   => __( 'Social Media Icon Set:', 'scd_textdomain' ),
		"desc"    => __( 'Samples can be found <a href="http://demo.wp-creative.co.uk/social-contact-display-widget/social-media-icons/" target="_blank" >on our site</a>', 'scd_textdomain' ),
		"type"    => "select",
		"std"    => "Modern Flat",
		"choices" => array( "Light", "Dark", "Modern Flat", "Cute", "Shaded", "Simple Flat", "Circle", "Vintage", "Retro", "Retro 2", "Retro Circle Pink", "Retro Circle Green", "Retro Circle Grey", "Retro Circle Blue", "Wooden", "CSS and HTML5 set 1", "CSS and HTML5 set 2", "Paper Flowers", "Purple Rimmed", "Social Trucks", "Old Bottle Crowns")
	);
	
	$options[] = array(
		"section" => "socialmedia_section",
		"id"      => SCD_SHORTNAME . "_vertical_checkbox",
		"title"   => __( 'Display Social Media Icons vertically?', 'scd_textdomain' ),
		"desc"    => __( '', 'scd_textdomain' ),
		"type"    => "checkbox",
		"std"     => 0
	);
		break;
		
		// Social Share
		case 'social-share':
			//Social Interaction Settings
	$options[] = array(
		"section" => "social_interaction_twitter_section",
		"id"      => SCD_SHORTNAME . "_twitter_acc",
		"title"   => __( 'Twitter Account:', 'scd_textdomain' ),
		"desc"    => __( 'Enter you Twitter Account (e.g. @HPTOnline)', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => "@HPTOnline",
		"class"   => "text"
	);
	
	$options[] = array(
		"section" => "social_interaction_twitter_section",
		"id"      => SCD_SHORTNAME . "_twitter_sc",
		"title"   => __( 'Show Twitter follower count?', 'scd_textdomain' ),
		"desc"    => __( '', 'scd_textdomain' ),
		"type"    => "checkbox",
		"std"     => 0
	);
	
	$options[] = array(
		"section" => "social_interaction_facebook_section",
		"id"      => SCD_SHORTNAME . "_facebook_button",
		"title"   => __( 'Do you want to include Facebook Like and Share?', 'scd_textdomain' ),
		"desc"    => __( '', 'scd_textdomain' ),
		"type"    => "checkbox",
		"std"     => 0
	);
	
	$options[] = array(
		"section" => "social_interaction_facebook_section",
		"id"      => SCD_SHORTNAME . "_facebook_style",
		"title"   => __( 'Facebook button style:', 'scd_textdomain' ),
		"desc"    => __( '', 'scd_textdomain' ),
		"type"    => "select",
		"std"    => "Standard",
		"choices" => array( "Standard", "Box Count", "Button Count")
	);
	
	$options[] = array(
		"section" => "social_interaction_gplus_section",
		"id"      => SCD_SHORTNAME . "_gplus_button",
		"title"   => __( 'Do you want to include Google +1?', 'scd_textdomain' ),
		"desc"    => __( '', 'scd_textdomain' ),
		"type"    => "checkbox",
		"std"     => 0
	);
	
	$options[] = array(
		"section" => "social_interaction_pinterest_section",
		"id"      => SCD_SHORTNAME . "_pinterest_button",
		"title"   => __( 'Do you want to include Pin It button?', 'scd_textdomain' ),
		"desc"    => __( '', 'scd_textdomain' ),
		"type"    => "checkbox",
		"std"     => 0
	);
	
	$options[] = array(
		"section" => "social_interaction_pinterest_section",
		"id"      => SCD_SHORTNAME . "_pinterest_buttonpinheight",
		"title"   => __( 'Size:', 'scd_textdomain' ),
		"desc"    => __( '', 'scd_textdomain' ),
		"type"    => "select",
		"std"    => "Small",
		"choices" => array( "Small", "Large")
	);
	
//	$options[] = array(
//		"section" => "social_interaction_pinterest_section",
//		"id"      => SCD_SHORTNAME . "_pinterest_buttonpinshape",
//		"title"   => __( 'Shape:', 'scd_textdomain' ),
//		"desc"    => __( '', 'scd_textdomain' ),
//		"type"    => "select",
//		"std"    => "Rectangular",
//		"choices" => array( "Rectangular", "Circle")
//	);
	
//	$options[] = array(
//		"section" => "social_interaction_pinterest_section",
//		"id"      => SCD_SHORTNAME . "_pinterest_buttonpincolor",
//		"title"   => __( 'Colour:', 'scd_textdomain' ),
//		"desc"    => __( '', 'scd_textdomain' ),
//		"type"    => "select",
//		"std"    => "Gray",
//		"choices" => array( "Gray", "Red", "White")
//	);
	
//	$options[] = array(
//		"section" => "social_interaction_pinterest_section",
//		"id"      => SCD_SHORTNAME . "_pinterest_buttonpinlang",
//		"title"   => __( 'Language:', 'scd_textdomain' ),
//		"desc"    => __( '', 'scd_textdomain' ),
//		"type"    => "select",
//		"std"    => "English",
//		"choices" => array( "English", "Japanese")
//	);
	
		break;
		
		case 'google-map':		
		// Google Map Setting
	$options[] = array(
		"section" => "google_map_section",
		"id"      => SCD_SHORTNAME . "_google_map_center",
		"title"   => __( 'Center:', 'scd_textdomain' ),
		"desc"    => __( 'Coordinates separated by a comma. <a href="https://support.google.com/maps/answer/18539?hl=en" target="_blank" >More Info</a> 
		<br><br><strong>New Google Maps</strong><br><br>Open Google Maps > Click a location on the map that isn\'t a marker or a [icon] pin. Clicking a marker or pin won\'t show its coordinates. Under the search box, an info card with coordinates will appear.<br><br><strong>Classic Google Maps</strong> <br><br>Open Google Maps > Right-click a location on the map. Select What\'s here? In the search box at the top of the page, the coordinates will appear.', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('41.88,-87.63','scd_textdomain')
	);
	
	$options[] = array(
		"section" => "google_map_section",
		"id"      => SCD_SHORTNAME . "_google_map_zoom",
		"title"   => __( 'Zoom:', 'scd_textdomain' ),
		"desc"    => __( 'Maps on Google Maps have an integer "zoom level" which defines the resolution of the current view. Zoom levels between 0 (the lowest zoom level, in which the entire world can be seen on one map) to 21+ (down to individual buildings) are possible within the default roadmap maps view.', 'scd_textdomain' ),
		"type"    => "select",
		"std"     => "14",
		"choices" => array( "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20" )
	);
	
	$options[] = array(
		"section" => "google_map_section",
		"id"      => SCD_SHORTNAME . "_google_map_width",
		"title"   => __( 'Width:', 'scd_textdomain' ),
		"desc"    => __( 'Size in pixels', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('170','scd_textdomain')
	);
	
	$options[] = array(
		"section" => "google_map_section",
		"id"      => SCD_SHORTNAME . "_google_map_height",
		"title"   => __( 'Height:', 'scd_textdomain' ),
		"desc"    => __( 'Size in pixels', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('170','scd_textdomain')
	);
	
	$options[] = array(
		"section" => "google_map_section",
		"id"      => SCD_SHORTNAME . "_google_map_sensor",
		"title"   => __( 'Sensor:', 'scd_textdomain' ),
		"desc"    => __( 'Use of the Google Static Maps API requires that you indicate whether your application is using a "sensor" (such as a GPS locator) to determine the user\'s location. This is especially important for mobile devices. Applications must pass a required sensor parameter indicating whether or not your application is using a sensor device.', 'scd_textdomain' ),
		"type"    => "select",
		"std"     => "false",
		"choices" => array( "true", "false" )
	);
	
	$options[] = array(
		"section" => "google_map_section",
		"id"      => SCD_SHORTNAME . "_google_map_maptype",
		"title"   => __( 'Map type:', 'scd_textdomain' ),
		"desc"    => __( '', 'scd_textdomain' ),
		"type"    => "select",
		"std"     => "ROADMAP",
		"choices" => array( "ROADMAP", "SATELLITE", "HYBRID", "TERRAIN" )
	);
		
		break;
		
		case 'business-hours':		
		// Business Hours Setting
	$options[] = array(
		"section" => "business_hours_section",
		"id"      => SCD_SHORTNAME . "_business_hours_title",
		"title"   => __( 'Title:', 'scd_textdomain' ),
		"desc"    => __( 'A regular text input field. Some inline HTML (&lt;a&gt;, &lt;b&gt;, &lt;em&gt;, &lt;i&gt;, &lt;strong&gt;) is allowed.', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('Opening times','scd_textdomain')
	);
	
	$options[] = array(
		"section" => "business_hours_section",
		"id"      => SCD_SHORTNAME . "_business_hours_monday",
		"title"   => __( 'Monday:', 'scd_textdomain' ),
		"desc"    => __( '', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('09:00 - 17:00','scd_textdomain')
	);
	
	$options[] = array(
		"section" => "business_hours_section",
		"id"      => SCD_SHORTNAME . "_business_hours_tuesday",
		"title"   => __( 'Tuesday:', 'scd_textdomain' ),
		"desc"    => __( '', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('09:00 - 17:00','scd_textdomain')
	);
	
	$options[] = array(
		"section" => "business_hours_section",
		"id"      => SCD_SHORTNAME . "_business_hours_wednesday",
		"title"   => __( 'Wednesday:', 'scd_textdomain' ),
		"desc"    => __( '', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('09:00 - 17:00','scd_textdomain')
	);
	
	$options[] = array(
		"section" => "business_hours_section",
		"id"      => SCD_SHORTNAME . "_business_hours_thursday",
		"title"   => __( 'Thursday:', 'scd_textdomain' ),
		"desc"    => __( '', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('09:00 - 17:00','scd_textdomain')
	);
	
	$options[] = array(
		"section" => "business_hours_section",
		"id"      => SCD_SHORTNAME . "_business_hours_friday",
		"title"   => __( 'Friday:', 'scd_textdomain' ),
		"desc"    => __( '', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('09:00 - 17:00','scd_textdomain')
	);
	
	$options[] = array(
		"section" => "business_hours_section",
		"id"      => SCD_SHORTNAME . "_business_hours_saturday",
		"title"   => __( 'Saturday:', 'scd_textdomain' ),
		"desc"    => __( '', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('Closed','scd_textdomain')
	);
	
	$options[] = array(
		"section" => "business_hours_section",
		"id"      => SCD_SHORTNAME . "_business_hours_sunday",
		"title"   => __( 'Sunday:', 'scd_textdomain' ),
		"desc"    => __( '', 'scd_textdomain' ),
		"type"    => "text",
		"std"     => __('Closed','scd_textdomain')
	);
	
		break;
	}
	
	return $options;	
}

/**
 * Contextual Help
 */
function scd_options_two_page_contextual_help() {
	// get the current tab
	$tab = scd_get_the_tab();
	
	$text 	= "<h3>" . __('SCD Settings Page Two - Contextual Help','scd_textdomain') . "</h3>";
	
	// contextual help according to tab
	switch ($tab) {
		// Social Media
		case 'social-media':
			$text 	.= "<p>" . __('Add which fields you require. Non are mandatory.','scd_textdomain') . "</p>";
		break;
		
		// Social Share
		case 'social-share':
			$text 	.= "<p>" . __('Add which fields you require. Non are mandatory.','scd_textdomain') . "</p>";
		break;
	}
	
	// must return text! NOT echo
	return $text;
} ?>