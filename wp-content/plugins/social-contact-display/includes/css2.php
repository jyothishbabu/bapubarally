<?php
   echo '<br /><br /><ul class="social">';
   if( $scd_option['scd_url_txt_facebook'] ) {
    echo '<li class="facebook"><a href="'.$scd_option['scd_url_txt_facebook'].'" target="_blank" class="entypo-facebook"></a></li>';
   }
  if( $scd_option['scd_url_txt_twitter'] ) {
     echo '<li class="twitter"><a href="'.$scd_option['scd_url_txt_twitter'].'" target="_blank" class="entypo-twitter"></a></li>';
   }
   if( $scd_option['scd_url_txt_gplus'] ) {
     echo '<li class="gplus"><a href="'.$scd_option['scd_url_txt_gplus'].'" target="_blank" class="entypo-gplus"></a></li>';
   }
   if( $scd_option['scd_url_txt_linkedin'] ) {
     echo '<li class="linked-in"><a href="'.$scd_option['scd_url_txt_linkedin'].'" target="_blank" class="entypo-linkedin"></a></li>';
   }
//   if( $youtube ) {
//     echo '<li class="youtube"><a href="'.$youtube.'" target="_blank" class="social"></a></li>';
//   }
   if( $scd_option['scd_url_txt_pinterest'] ) {
     echo '<li class="pinterest"><a href="'.$scd_option['scd_url_txt_pinterest'].'" target="_blank" class="entypo-pinterest"></a></li>';
   }
   echo '</ul>';  
?>