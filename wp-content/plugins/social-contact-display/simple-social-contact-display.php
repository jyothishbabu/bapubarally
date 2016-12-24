<?php
include_once "simple-social-interaction-buttons.php";

class simple_social_contact_display extends WP_Widget {

	// constructor
    function simple_social_contact_display() {
        parent::WP_Widget(false, $name = __('Simple Social Contact Display', 'simple_social_contact_display') );
    }

	// widget form creation
function form($instance) {

// Check values
if( $instance) {
     $title = esc_attr($instance['title']);
     $addresslineone = esc_attr($instance['addresslineone']);
     $addresslinetwo = esc_attr($instance['addresslinetwo']);
	 $city = esc_attr($instance['city']);
	 $county = esc_attr($instance['county']);
	 $pcode = esc_attr($instance['pcode']);
	 $telephone = esc_attr($instance['telephone']);
	 $mobile = esc_attr($instance['mobile']);
	 $fax = esc_attr($instance['fax']);
	 $email = esc_attr($instance['email']);
	 $socialiconstitle = esc_attr($instance['socialiconstitle']);
	 $facebook = esc_attr($instance['facebook']);
	 $twitter = esc_attr($instance['twitter']);
	 $gplus = esc_attr($instance['gplus']);
	 $tumblr = esc_attr($instance['tumblr']);
	 $linkedin = esc_attr($instance['linkedin']);
	 $dribble = esc_attr($instance['dribble']);
	 $youtube = esc_attr($instance['youtube']);
	 $pinterest = esc_attr($instance['pinterest']);
	 $instagram = esc_attr($instance['instagram']);
	 $rssfeed = esc_attr($instance['rssfeed']);
	 $select = esc_attr($instance['select']);
	 $vertical = esc_attr($instance['vertical']);
} else {
     $title = '';
     $addresslineone = '';
     $addresslinetwo = '';
	 $city = '';
	 $county = '';
	 $pcode = '';
	 $telephone = '';
	 $mobile = '';
	 $fax = '';
	 $email = '';
	 $socialiconstitle = '';
	 $facebook = '';
	 $twitter = '';
	 $gplus = '';
	 $tumblr = '';
	 $linkedin = '';
	 $dribble = '';
	 $youtube = '';
	 $pinterest = '';
	 $instagram = '';
	 $rssfeed = '';
	 $select = '';
	 $vertical = '';
}
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Business Title:', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('addresslineone'); ?>"><?php _e('Address Line One:', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('addresslineone'); ?>" name="<?php echo $this->get_field_name('addresslineone'); ?>" type="text" value="<?php echo $addresslineone; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('addresslinetwo'); ?>"><?php _e('Address Line Two:', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('addresslinetwo'); ?>" name="<?php echo $this->get_field_name('addresslinetwo'); ?>" type="text" value="<?php echo $addresslinetwo; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('city'); ?>"><?php _e('City / Town:', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('city'); ?>" name="<?php echo $this->get_field_name('city'); ?>" type="text" value="<?php echo $city; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('county'); ?>"><?php _e('County / State:', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('county'); ?>" name="<?php echo $this->get_field_name('county'); ?>" type="text" value="<?php echo $county; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('pcode'); ?>"><?php _e('Post Code / Zip Code:', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('pcode'); ?>" name="<?php echo $this->get_field_name('pcode'); ?>" type="text" value="<?php echo $pcode; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('telephone'); ?>"><?php _e('Telephone (Can also add a prefix e.g. Tel:):', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('telephone'); ?>" name="<?php echo $this->get_field_name('telephone'); ?>" type="text" value="<?php echo $telephone; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('mobile'); ?>"><?php _e('Mobile (Can also add a prefix e.g. Mob:):', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('mobile'); ?>" name="<?php echo $this->get_field_name('mobile'); ?>" type="text" value="<?php echo $mobile; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('fax'); ?>"><?php _e('Fax (Can also add a prefix e.g. Fax:):', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" type="text" value="<?php echo $fax; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email:', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" />
</p>

<hr>

<p>
<label for="<?php echo $this->get_field_id('socialiconstitle'); ?>"><?php _e('Social Icons Title (e.g. Connect with Us):', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('socialiconstitle'); ?>" name="<?php echo $this->get_field_name('socialiconstitle'); ?>" type="text" value="<?php echo $socialiconstitle; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook URL:', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php if(empty($facebook)) { echo "http://";} else { echo $facebook; } ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter URL:', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php if(empty($twitter)) { echo "http://";} else { echo $twitter; } ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('gplus'); ?>"><?php _e('Google Plus URL:', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('gplus'); ?>" name="<?php echo $this->get_field_name('gplus'); ?>" type="text" value="<?php if(empty($gplus)) { echo "http://";} else { echo $gplus; } ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('tumblr'); ?>"><?php _e('Tumblr URL:', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('tumblr'); ?>" name="<?php echo $this->get_field_name('tumblr'); ?>" type="text" value="<?php if(empty($tumblr)) { echo "http://";} else { echo $tumblr; } ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('Linked In URL:', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php if(empty($linkedin)) { echo "http://";} else { echo $linkedin; } ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e('YouTube URL:', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php if(empty($youtube)) { echo "http://";} else { echo $youtube; } ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('pinterest'); ?>"><?php _e('Pinterest URL:', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" name="<?php echo $this->get_field_name('pinterest'); ?>" type="text" value="<?php if(empty($pinterest)) { echo "http://";} else { echo $pinterest; } ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('instagram'); ?>"><?php _e('Instagram URL:', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" type="text" value="<?php if(empty($instagram)) { echo "http://";} else { echo $instagram; } ?>" />
</p>

<p>
<input id="<?php echo $this->get_field_id('rssfeed'); ?>" name="<?php echo $this->get_field_name('rssfeed'); ?>" type="checkbox" value="1" <?php checked( '1', $rssfeed ); ?> />
<label for="<?php echo $this->get_field_id('rssfeed'); ?>"><?php _e('Include RSS feed', 'wp_widget_plugin'); ?></label>
</p>


<p>
<label for="<?php echo $this->get_field_id('select'); ?>"><?php _e('Select', 'wp_widget_plugin'); ?></label>
<select name="<?php echo $this->get_field_name('select'); ?>" id="<?php echo $this->get_field_id('select'); ?>" class="widefat">
<?php
$options = array('Light', 'Dark', 'Modern Flat', 'Cute', 'Shaded', 'Simple Flat', 'Circle', 'Vintage', 'Retro', 'Retro 2', 'Retro Circle Pink', 'Retro Circle Green', 'Retro Circle Grey', 'Retro Circle Blue', 'Wooden', 'CSS and HTML5 set 1', 'CSS and HTML5 set 2', 'Paper Flowers', 'Ribbon', 'Purple Rimmed', 'Social Trucks', 'Old Bottle Crowns');
foreach ($options as $option) {
echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="select"' : '', '>', $option, '</option>';
}
?>
</select>
<div style="font-size: 10px">Examples can be found <a href="http://demo.wp-creative.co.uk/social-contact-display-widget/social-media-icons/" target="_blank">here</a>
</div> 
</p>
<p>
<input id="<?php echo $this->get_field_id('vertical'); ?>" name="<?php echo $this->get_field_name('vertical'); ?>" type="checkbox" value="1" <?php checked( '1', $vertical ); ?> />
<label for="<?php echo $this->get_field_id('vertical'); ?>"><?php _e('Display Social Media Icons vertically?', 'wp_widget_plugin'); ?></label>
</p>
<p>
<br />
<div align="center">
<a href="http://demo.wp-creative.co.uk/social-contact-display-widget/plugin-suggestion/" target="_blank">Got a suggestion? Get in touch!</a>
</div>
</p>

<?php
}

	// update widget
function update($new_instance, $old_instance) {
      $instance = $old_instance;
      // Fields
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['addresslineone'] = strip_tags($new_instance['addresslineone']);
      $instance['addresslinetwo'] = strip_tags($new_instance['addresslinetwo']);
	  $instance['city'] = strip_tags($new_instance['city']);
	  $instance['county'] = strip_tags($new_instance['county']);
	  $instance['pcode'] = strip_tags($new_instance['pcode']);
	  $instance['telephone'] = strip_tags($new_instance['telephone']);
	  $instance['mobile'] = strip_tags($new_instance['mobile']);
	  $instance['fax'] = strip_tags($new_instance['fax']);
	  $instance['email'] = strip_tags($new_instance['email']);
	  $instance['socialiconstitle'] = strip_tags($new_instance['socialiconstitle']);
	  $instance['facebook'] = strip_tags($new_instance['facebook']);
	  $instance['twitter'] = strip_tags($new_instance['twitter']);
	  $instance['gplus'] = strip_tags($new_instance['gplus']);
	  $instance['tumblr'] = strip_tags($new_instance['tumblr']);
	  $instance['linkedin'] = strip_tags($new_instance['linkedin']);
	  $instance['dribble'] = strip_tags($new_instance['dribble']);
	  $instance['youtube'] = strip_tags($new_instance['youtube']);
	  $instance['pinterest'] = strip_tags($new_instance['pinterest']);
	  $instance['instagram'] = strip_tags($new_instance['instagram']);
	  $instance['rssfeed'] = strip_tags($new_instance['rssfeed']);
	  $instance['select'] = strip_tags($new_instance['select']);
	  $instance['vertical'] = strip_tags($new_instance['vertical']);
	  
	  
     return $instance;
}

	// display widget
function widget($args, $instance) {
   extract( $args );
   // these are the widget options
   $title = $instance['title'];
   $addresslineone = $instance['addresslineone'];
   $addresslinetwo = $instance['addresslinetwo'];
   $city = $instance['city'];
   $county = $instance['county'];
   $pcode = $instance['pcode'];
   $telephone = $instance['telephone'];
   $mobile = $instance['mobile'];
   $fax = $instance['fax'];
   $email = $instance['email'];
   $socialiconstitle = $instance['socialiconstitle'];
   $facebook = $instance['facebook'];
   $twitter = $instance['twitter'];
   $gplus = $instance['gplus'];
   $tumblr = $instance['tumblr'];
   $linkedin = $instance['linkedin'];
   $dribble = $instance['dribble'];
   $youtube = $instance['youtube'];
   $pinterest = $instance['pinterest'];
   $instagram = $instance['instagram'];
   $rssfeed = $instance['rssfeed'];
   $select = $instance['select'];
   $vertical = $instance['vertical'];
   $cdn = "//cdn.wp-creative.co.uk/social-contact-display/images/";

   echo $before_widget;
   // Display the widget
   echo '<div class="widget-text wp_widget_plugin_box" style:>';

   if ( $title ) {
      echo '<strong>' . $title .'</strong></td></tr><br /><br />';
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
 	 if($pcode=="" ) {
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
   if( $email ) {
     echo '<br /><br /><a href="mailto:' . antispambot($email) .'">' . antispambot($email) . '</a><br />';
   }
   if( $socialiconstitle ) {
     echo '<br /><strong>' . $socialiconstitle . '</strong><br /><br />';
   }
   if($socialiconstitle=="" ) {
		echo '<p></p>';
   }
   
   // Get $select value
	if ( $select == 'Light' ) {
		include_once "includes/simple/light.php";
		} 
	elseif ( $select == 'Dark' ) {
		include_once "includes/simple/dark.php";
		}
	elseif ( $select == 'Cute' ) {
		include_once "includes/simple/cute.php";
		}		
	elseif ( $select == 'Shaded' ) {
		include_once "includes/simple/shaded.php";
		}	
	elseif ( $select == 'Simple Flat' ) {
		include_once "includes/simple/simple-flat.php";
		}
	elseif ( $select == 'Circle' ) {
		include_once "includes/simple/circle.php";
		}
	elseif ( $select == 'Vintage' ) {
		include_once "includes/simple/vintage.php";
		}	
	elseif ( $select == 'Wooden' ) {
		include_once "includes/simple/wooden.php";
		}	
	elseif ( $select == 'Modern Flat' ) {
		include_once "includes/simple/modernflat.php";
		}
	elseif ( $select == 'CSS and HTML5 set 1' ) {
		include_once "includes/simple/css1.php";
		}
	elseif ( $select == 'CSS and HTML5 set 2' ) {
		include_once "includes/simple/css2.php";
		}	
	elseif ( $select == 'Retro' ) {
		include_once "includes/simple/retro.php";
		}	
	elseif ( $select == 'Retro 2' ) {
		include_once "includes/simple/retro2.php";
		}	
	elseif ( $select == 'Retro Circle Pink' ) {
		include_once "includes/simple/retrocircle.php";
		}
	elseif ( $select == 'Retro Circle Green' ) {
		include_once "includes/simple/retrocircle-green.php";
		}
	elseif ( $select == 'Retro Circle Grey' ) {
		include_once "includes/simple/retrocircle-grey.php";
		}
	elseif ( $select == 'Retro Circle Blue' ) {
		include_once "includes/simple/retrocircle-blue.php";
		}	
	elseif ( $select == 'Paper Flowers' ) {
		include_once "includes/simple/paperflowers.php";
		}
	elseif ( $select == 'Ribbon' ) {
		include_once "includes/simple/ribbon.php";
		}
	elseif ( $select == 'Purple Rimmed' ) {
		include_once "includes/simple/purplerimmed.php";
		}
	elseif ( $select == 'Social Trucks' ) {
		include_once "includes/simple/trucks.php";
		}
	elseif ( $select == 'Old Bottle Crowns' ) {
		include_once "includes/simple/old-bottle-crowns.php";
		}	
		
   echo '</div>';
   echo $after_widget;
}
}	
// register widget
add_action('widgets_init', create_function('', 'return register_widget("simple_social_contact_display");'));

?>