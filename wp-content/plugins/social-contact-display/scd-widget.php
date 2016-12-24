<?php

//tell WP about our shortcode
add_shortcode( 'scd_social_contact_display', 'social_contact_display_shortcode' );

function social_contact_display_shortcode($atts){

   $scd_option = scd_get_global_options(); 
   get_option('scd_options');
   
   extract(shortcode_atts(array(

    //defaults
	'address' => 'yes', 	
    'title' => '' . $scd_option['scd_txt_title'] . '',
	'addresslineone' => '' . $scd_option['scd_txt_addresslineone'] . '',
	'addresslinetwo' => '' . $scd_option['scd_txt_addresslinetwo'] . '',
	'city' => '' . $scd_option['scd_txt_city'] . '',
	'county' => '' . $scd_option['scd_txt_county'] . '',
	'pcode' => '' . $scd_option['scd_txt_pcode'] . '',
	'telephone' => '' . $scd_option['scd_txt_telephone'] . '',
	'mobile' => '' . $scd_option['scd_txt_mobile'] . '',
	'fax' => '' . $scd_option['scd_txt_fax'] . '',
	'email' => '' . $scd_option['scd_txt_email'] . '',
	'socialiconstitle' => '' . $scd_option['scd_txt_socialiconstitle'] . '',
	'socialmediaicons' => '' . $scd_option['scd_select_input'] . ''
  
  ), $atts ));
  
	$cdn = "//cdn.wp-creative.co.uk/social-contact-display/images/";
  
   if ( $address == 'yes' ) {
   if ( $title ) {
      echo '<strong>' . $title .'</strong><br /><br />';
   }
   if( $addresslineone ) {
      echo ''.$addresslineone.'<br />';
   }
   if( $addresslinetwo ) {
     echo ''.$addresslinetwo.'<br />';
   }
   if( $city ) {
     echo ''.$city.'<br />';
   }
   if( $county ) {
     echo ''.$county.'<br />';
   }
   if( $pcode ) {
     echo ''.$pcode.'<br />';
	 }
 	 if($pcode == "" ) {
		echo '<p></p>';
   }
   if( $telephone ) {
     echo '<br />'.$telephone.'';
   }
   if( $mobile ) {
     echo '<br />'.$mobile.'';
   }
   if( $fax ) {
     echo '<br />'.$fax.'';
   }
   }
   if( $email ) {
     echo '<br /><br /><a href="mailto:' . antispambot($email) .'">' . antispambot($email) . '</a><br />';
   };
   if( $socialiconstitle ) {
     echo '<br /><br /><strong>' . $socialiconstitle . '</strong><br /><br />';
   }
   if($socialiconstitle == "" ) {
		echo '<p></p>';
   }

   // Get $select value
	if ( $socialmediaicons == 'Light' ) {
		include_once "includes/light.php";
		} 
	elseif ( $socialmediaicons == 'Dark' ) {
		include_once "includes/dark.php";
		}
	elseif ( $socialmediaicons == 'Cute' ) {
		include_once "includes/cute.php";
		}		
	elseif ( $socialmediaicons == 'Shaded' ) {
		include_once "includes/shaded.php";
		}	
	elseif ( $socialmediaicons == 'Simple Flat' ) {
		include_once "includes/simple-flat.php";
		}
	elseif ( $socialmediaicons == 'Circle' ) {
		include_once "includes/circle.php";
		}
	elseif ( $socialmediaicons == 'Vintage' ) {
		include_once "includes/vintage.php";
		}	
	elseif ( $socialmediaicons == 'Wooden' ) {
		include_once "includes/wooden.php";
		}	
	elseif ( $socialmediaicons == 'Modern Flat' ) {
		include_once "includes/modernflat.php";
		}
	elseif ( $socialmediaicons == 'CSS and HTML5 set 1' ) {
		include_once "includes/css1.php";
		}
	elseif ( $socialmediaicons == 'CSS and HTML5 set 2' ) {
		include_once "includes/css2.php";
		}	
	elseif ( $socialmediaicons == 'Retro' ) {
		include_once "includes/retro.php";
		}	
	elseif ( $socialmediaicons == 'Retro 2' ) {
		include_once "includes/retro2.php";
		}	
	elseif ( $socialmediaicons == 'Retro Circle Pink' ) {
		include_once "includes/retrocircle.php";
		}
	elseif ( $socialmediaicons == 'Retro Circle Green' ) {
		include_once "includes/retrocircle-green.php";
		}
	elseif ( $socialmediaicons == 'Retro Circle Grey' ) {
		include_once "includes/retrocircle-grey.php";
		}
	elseif ( $socialmediaicons == 'Retro Circle Blue' ) {
		include_once "includes/retrocircle-blue.php";
		}	
	elseif ( $socialmediaicons == 'Paper Flowers' ) {
		include_once "includes/paperflowers.php";
		}
	elseif ( $socialmediaicons == 'Purple Rimmed' ) {
		include_once "includes/purplerimmed.php";
		}	
	elseif ( $socialmediaicons == 'Social Trucks' ) {
		include_once "includes/trucks.php";
		}
	elseif ( $socialmediaicons == 'Old Bottle Crowns' ) {
		include_once "includes/old-bottle-crowns.php";
		}		
}

class social_contact_display extends WP_Widget {

	// constructor
    function social_contact_display() {
        parent::WP_Widget(false, $name = __('Social Contact Display', 'social_contact_display') );
    }

	// widget form creation
function form($instance) {

}

	// display widget
function widget($args) {
extract ( $args );

//Call plugin options
$scd_option = scd_get_global_options(); 
get_option('scd_options');

//Display Widget
   echo $before_widget;
   // Display the widget
   echo '<div class="widget-text wp_widget_plugin_box" style:>';

   echo do_shortcode('[scd_social_contact_display address="yes"]');
   
   echo '</div>';
   echo $after_widget;
}
}	
// register widget
add_action('widgets_init', create_function('', 'return register_widget("social_contact_display");'));

// register style on initialization
add_action('init', 'register_style');

function register_style(){

    wp_register_style( 'social_contact_display', plugins_url('/lib/css/socialcontactdisplay.css', __FILE__));
	wp_register_style( 'entypo', plugins_url('/lib/css/entypo.css', __FILE__));
}

// use the registered style above
add_action('wp_enqueue_scripts', 'enqueue_style');
function enqueue_style(){

    wp_enqueue_style( 'social_contact_display' );
	wp_enqueue_style( 'entypo' );
} 

/** 
 * Collects our theme options 
 * 
 * @return array 
 */  
function scd_get_global_options(){  
      
    $scd_option = array();  
  
    // collect option names as declared in scd_get_settings()  
    $scd_option_names = array (  
        'scd_options_two',   
        'scd_options_two_social_media',   
        'scd_options_two_social_share',
		'scd_options_two_google_map'	
    );  
  
    // loop for get_option  
    foreach ($scd_option_names as $scd_option_name) {  
        if (get_option($scd_option_name)!= FALSE) {  
            $option     = get_option($scd_option_name);  
              
            // now merge in main $scd_option array!  
            $scd_option = array_merge($scd_option, $option);  
        }  
    }     
      
return $scd_option;  
} 

$scd_option = scd_get_global_options();

?>