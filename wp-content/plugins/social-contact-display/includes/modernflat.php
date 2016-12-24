<?php
   if( $scd_option['scd_url_txt_facebook'] ) {
    echo '<div class="scd-facebook"><a href="'.$scd_option['scd_url_txt_facebook'].'" target="_blank" class="social">Facebook</a></div>';
   }
  if( $scd_option['scd_url_txt_twitter'] ) {
     echo '<div class="scd-twitter"><a href="'.$scd_option['scd_url_txt_twitter'].'" target="_blank" class="social">Twitter</a></div>';
   }
   if( $scd_option['scd_url_txt_gplus'] ) {
     echo '<div class="scd-google"><a href="'.$scd_option['scd_url_txt_gplus'].'" target="_blank" class="social">Google +</a></div>';
   }
   if( $scd_option['scd_url_txt_tumblr'] ) {
     echo '<div class="scd-tumblr"><a href="'.$scd_option['scd_url_txt_tumblr'].'" target="_blank" class="social">Tumblr</a></div>';
   }
   if( $scd_option['scd_url_txt_instagram'] ) {
     echo '<div class="scd-instagram"><a href="'.$scd_option['scd_url_txt_instagram'].'" target="_blank" class="social">Instagram</a></div>';
   }   
   if( $scd_option['scd_url_txt_pinterest'] ) {
     echo '<div class="scd-pinterest"><a href="'.$scd_option['scd_url_txt_pinterest'].'" target="_blank" class="social">Pinterest</a></div>';
   }   
   if( $scd_option['scd_url_txt_linkedin'] ) {
     echo '<div class="scd-linkedin"><a href="'.$scd_option['scd_url_txt_linkedin'].'" target="_blank" class="social">LinkedIn</a></div>';
   }
   if( $scd_option['scd_url_txt_youtube'] ) {
     echo '<div class="scd-youtube"><a href="'.$scd_option['scd_url_txt_youtube'].'" target="_blank" class="social">YouTube</a></div>';
   }
   if( $scd_option['scd_rss_checkbox'] ) {
     echo '<div class="scd-rss"><a href="'?><?php bloginfo('rss2_url'); ?><?php echo '" target="_blank" class="social">RSS</a></div>';
   }
?>