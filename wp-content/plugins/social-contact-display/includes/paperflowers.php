<?php
   if( $scd_option['scd_url_txt_facebook'] ) {
    echo '<a href="'.$scd_option['scd_url_txt_facebook'].'" target="_blank"><img src="'.$cdn.'paperflowers/48/Facebook-icon.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $scd_option['scd_vertical_checkbox'] == '1' ) { 
     echo '<br>'; 
   }
  if( $scd_option['scd_url_txt_twitter'] ) {
     echo '<a href="'.$scd_option['scd_url_txt_twitter'].'" target="_blank"><img src="'.$cdn.'paperflowers/48/Twitter-icon.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $scd_option['scd_vertical_checkbox'] == '1' ) { 
     echo '<br>'; 
   }
   if( $scd_option['scd_url_txt_gplus'] ) {
     echo '<a href="'.$scd_option['scd_url_txt_gplus'].'" target="_blank"><img src="'.$cdn.'paperflowers/48/Google-Plus-icon.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $scd_option['scd_vertical_checkbox'] == '1' ) { 
     echo '<br>'; 
   }
   if( $scd_option['scd_url_txt_tumblr'] ) {
     echo '<a href="'.$scd_option['scd_url_txt_gplus'].'" target="_blank"><img src="'.$cdn.'paperflowers/48/Tumblr-icon.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $scd_option['scd_vertical_checkbox'] == '1' ) { 
     echo '<br>'; 
   }
   if( $scd_option['scd_url_txt_linkedin'] ) {
     echo '<a href="'.$scd_option['scd_url_txt_linkedin'].'" target="_blank"><img src="'.$cdn.'paperflowers/48/Linkedin-icon.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $scd_option['scd_vertical_checkbox'] == '1' ) { 
     echo '<br>'; 
   }
   if( $scd_option['scd_url_txt_youtube'] ) {
     echo '<a href="'.$scd_option['scd_url_txt_youtube'].'" target="_blank"><img src="'.$cdn.'paperflowers/48/YouTube-icon.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $scd_option['scd_vertical_checkbox'] == '1' ) { 
     echo '<br>'; 
   }
   if( $scd_option['scd_url_txt_pinterest'] ) {
     echo '<a href="'.$scd_option['scd_url_txt_pinterest'].'" target="_blank"><img src="'.$cdn.'paperflowers/48/Pinterest-icon.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $scd_option['scd_vertical_checkbox'] == '1' ) { 
     echo '<br>'; 
   }  
   if( $scd_option['scd_url_txt_instagram'] ) {
     echo '<a href="'.$scd_option['scd_url_txt_instagram'].'" target="_blank"><img src="'.$cdn.'paperflowers/48/Instagram-icon.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $scd_option['scd_vertical_checkbox'] == '1' ) { 
     echo '<br>'; 
   }  
   if( $scd_option['scd_rss_checkbox'] ) {
     echo '<a href="'?><?php bloginfo('rss2_url'); ?><?php echo '" target="_blank"><img src="'.$cdn.'paperflowers/48/RSS-icon.png" height="38" width="37" ></a>&nbsp;';
   }
?>