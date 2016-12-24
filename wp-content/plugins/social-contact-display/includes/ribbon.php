<?php
   if( $scd_option['scd_url_txt_facebook'] ) {
    echo '<a href="'.$scd_option['scd_url_txt_facebook'].'" target="_blank"><img src="'.$cdn.'ribbon/48/Facebook.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $scd_option['scd_vertical_checkbox'] == '1' ) { 
     echo '<br>'; 
   }
  if( $scd_option['scd_url_txt_twitter'] ) {
     echo '<a href="'.$scd_option['scd_url_txt_twitter'].'" target="_blank"><img src="'.$cdn.'ribbon/48/Twitter.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $scd_option['scd_vertical_checkbox'] == '1' ) { 
     echo '<br>'; 
   }
   if( $scd_option['scd_url_txt_gplus']) {
     echo '<a href="'.$scd_option['scd_url_txt_gplus'].'" target="_blank"><img src="'.$cdn.'ribbon/48/Googleplus.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $scd_option['scd_vertical_checkbox'] == '1' ) { 
     echo '<br>'; 
   }
   if( $scd_option['scd_url_txt_tumblr']) {
     echo '<a href="'.$scd_option['scd_url_txt_tumblr'].'" target="_blank"><img src="'.$cdn.'ribbon/48/Tumblr.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $scd_option['scd_vertical_checkbox'] == '1' ) { 
     echo '<br>'; 
   }
   if( $scd_option['scd_url_txt_linkedin'] ) {
     echo '<a href="'.$scd_option['scd_url_txt_linkedin'].'" target="_blank"><img src="'.$cdn.'ribbon/48/Linkedin.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $scd_option['scd_vertical_checkbox'] == '1' ) { 
     echo '<br>'; 
   }
   if( $scd_option['scd_url_txt_youtube'] ) {
     echo '<a href="'.$scd_option['scd_url_txt_youtube'].'" target="_blank"><img src="'.$cdn.'ribbon/48/Youtube.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $scd_option['scd_vertical_checkbox'] == '1' ) { 
     echo '<br>'; 
   }
   if( $scd_option['scd_url_txt_pinterest'] ) {
     echo '<a href="'.$scd_option['scd_url_txt_pinterest'].'" target="_blank"><img src="'.$cdn.'ribbon/48/Pinterest.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $scd_option['scd_vertical_checkbox'] == '1' ) { 
     echo '<br>'; 
   }  
//   if( $instagram ) {
//     echo '<a href="'.$instagram.'" target="_blank"><img src="'.$cdn.'ribbon/48/Instagram-icon.png" height="38" width="37" ></a>&nbsp;';
//   }    
	if( $scd_option['scd_rss_checkbox'] ) {
     echo '<a href="'?><?php bloginfo('rss2_url'); ?><?php echo '" target="_blank"><img src="'.$cdn.'ribbon/48/RSS.png" height="38" width="37" ></a>&nbsp;';
   }
?>