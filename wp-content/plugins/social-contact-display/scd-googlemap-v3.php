<?php

add_action('wp_head', 'scd_google_maps_add_head');

function scd_google_maps_add_head() {

$scd_option = scd_get_global_options(); 
   get_option('scd_options');

  $args = shortcode_atts(array(

    //defaults          
    'center' => '' . $scd_option['scd_google_map_center'] . '',
    'zoom' => '' . $scd_option['scd_google_map_zoom'] . '',
    'width' => '' . $scd_option['scd_google_map_width'] . '',
	'height' => '' . $scd_option['scd_google_map_height'] . '',
    'sensor' => '' . $scd_option['scd_google_map_sensor'] . '',
    'maptype' => '' . $scd_option['scd_google_map_maptype'] . '',
    'markers' => '' . $scd_option['scd_google_map_center'] . ''    
  
  ), $atts );
?>
<!-- Google Maps API -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvjcr3MCiSKGGfDDv4zHiZg0rEb2SL-UM&sensor=<?php echo $scd_option['scd_google_map_sensor']; ?>"></script>
    <script>
var map;
function initialize() {
  var mapOptions = {
    zoom: <?php echo $scd_option['scd_google_map_zoom']; ?>,
    center: new google.maps.LatLng(<?php echo $scd_option['scd_google_map_center']; ?>)
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
      map.setMapTypeId(google.maps.MapTypeId.<?php echo $scd_option['scd_google_map_maptype']; ?>);    
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>

<?php

} 

class scd_google_map_widget extends WP_Widget {

	// constructor
    function scd_google_map_widget() {
        parent::WP_Widget(false, $name = __('SCD Google Map', 'scd_google_map_widget') );
    }	

	// widget form creation
function form($instance) {}



	// display widget
function widget($args) {
   $scd_option = scd_get_global_options(); 
   get_option('scd_options_google_map');
   extract ( $args );
   
   echo $before_widget;
   // Display the widget
   echo '<div class="widget-text wp_widget_plugin_box" style:>';
   
   echo do_shortcode('[scd_google_map]');
						
   echo '</div>';
   echo $after_widget;
}
}	
// register widget
add_action('widgets_init', create_function('', 'return register_widget("scd_google_map_widget");'));

//tell WP about our shortcode
add_shortcode( 'scd_google_map', 'scd_google_map_shortcode' );


//shortcode function
function scd_google_map_shortcode($atts, $content = NULL){
     
	 $scd_option = scd_get_global_options(); 
   get_option('scd_options');

  $args = shortcode_atts(array(

    //defaults          
    'center' => '' . $scd_option['scd_google_map_center'] . '',
    'zoom' => '' . $scd_option['scd_google_map_zoom'] . '',
    'width' => '' . $scd_option['scd_google_map_width'] . '',
	'height' => '' . $scd_option['scd_google_map_height'] . '',
    'sensor' => '' . $scd_option['scd_google_map_sensor'] . '',
    'maptype' => '' . $scd_option['scd_google_map_maptype'] . '',
    'markers' => '' . $scd_option['scd_google_map_center'] . ''    
  
  ), $atts );
	 ?>
	 
	<div id="map-canvas" style="width: <?php echo $scd_option['scd_google_map_width']; ?>px; height: <?php echo $scd_option['scd_google_map_height']; ?>px;"></div>
	<?php
  }

?>