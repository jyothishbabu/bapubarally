<?php
   if( $scd_option['scd_url_txt_facebook'] ) {
    echo '<a href="'.$scd_option['scd_url_txt_facebook'].'" target="_blank"><img src="'.$cdn.'vintage/facebook.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $scd_option['scd_vertical_checkbox'] == '1' ) { 
     echo '<br>'; 
   }
  if( $scd_option['scd_url_txt_twitter'] ) {
     echo '<a href="'.$scd_option['scd_url_txt_twitter'].'" target="_blank"><img src="'.$cdn.'vintage/twitter.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $scd_option['scd_vertical_checkbox'] == '1' ) { 
     echo '<br>'; 
   }
   if( $scd_option['scd_url_txt_gplus'] ) {
     echo '<a href="'.$scd_option['scd_url_txt_gplus'].'" target="_blank"><img src="'.$cdn.'vintage/googleplus.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $scd_option['scd_vertical_checkbox'] == '1' ) { 
     echo '<br>'; 
   }
//   if( $linkedin ) {
//     echo '<a href="'.$linkedin.'" target="_blank"><img src="' . plugins_url( 'images/vintage/Linkedin.png' , dirname(__FILE__) ) . '" height="38" width="37" ></a>&nbsp;';
//   }
   // Check if youtube is set
   if( $scd_option['scd_url_txt_youtube'] ) {
     echo '<a href="'.$scd_option['scd_url_txt_youtube'].'" target="_blank"><img src="'.$cdn.'vintage/youtube.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $scd_option['scd_vertical_checkbox'] == '1' ) { 
     echo '<br>'; 
   }
   if( $scd_option['scd_url_txt_pinterest'] ) {
     echo '<a href="'.$scd_option['scd_url_txt_pinterest'].'" target="_blank"><img src="'.$cdn.'vintage/pinterest.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $scd_option['scd_vertical_checkbox'] == '1' ) { 
     echo '<br>'; 
   }
	if( $scd_option['scd_rss_checkbox'] ) {
     echo '<a href="'?><?php bloginfo('rss2_url'); ?><?php echo '" target="_blank"><img src="'.$cdn.'vintage/rss.png" height="38" width="37" ></a>&nbsp;';
   }
?>