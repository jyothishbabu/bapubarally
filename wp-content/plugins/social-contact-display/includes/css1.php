<?php
   if( $scd_option['scd_url_txt_facebook'] ) {
    echo '<div class="hpt-social-facebook"><a href="'.$scd_option['scd_url_txt_facebook'].'" target="_blank" class="social"></a></div>&nbsp;';
   }
  if( $scd_option['scd_url_txt_twitter'] ) {
     echo '<div class="hpt-social-twitter"><a href="'.$scd_option['scd_url_txt_twitter'].'" target="_blank" class="social"></a></div>&nbsp;';
   }
   if( $scd_option['scd_url_txt_gplus'] ) {
     echo '<div class="hpt-social-googleplus"><a href="'.$scd_option['scd_url_txt_gplus'].'" target="_blank" class="social"></a></div>&nbsp;';
   }
   if( $scd_option['scd_url_txt_linkedin'] ) {
     echo '<div class="hpt-social-linkedin"><a href="'.$scd_option['scd_url_txt_linkedin'].'" target="_blank" class="social"></a></div>&nbsp;';
   }
   if( $scd_option['scd_url_txt_youtube'] ) {
     echo '<div class="hpt-social-youtube"><a href="'.$scd_option['scd_url_txt_youtube'].'" target="_blank" class="social"></a></div>&nbsp;';
   }
   if( $scd_option['scd_url_txt_pinterest'] ) {
     echo '<div class="hpt-social-pinterest"><a href="'.$pinterest.'" target="_blank" class="social"></a></div>&nbsp;';
   }   
   if( $$scd_option['scd_rss_checkbox'] ) {
     echo '<div class="hpt-social-rss"><a href="'?><?php bloginfo('rss2_url'); ?><?php echo '" target="_blank" class="social"></a></div>&nbsp;';
   }
?>