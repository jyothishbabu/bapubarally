<?php

   if( $facebook != "http://" ) {
    echo '<a href="'.$facebook.'" target="_blank"><img src="'.$cdn.'paperflowers/48/Facebook-icon.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
  if( $twitter != "http://" ) {
     echo '<a href="'.$twitter.'" target="_blank"><img src="'.$cdn.'paperflowers/48/Twitter-icon.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
   if( $gplus != "http://" ) {
     echo '<a href="'.$gplus.'" target="_blank"><img src="'.$cdn.'paperflowers/48/Google-Plus-icon.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
   if( $tumblr != "http://" ) {
     echo '<a href="'.$tumblr.'" target="_blank"><img src="'.$cdn.'paperflowers/48/Tumblr-icon.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
   if( $linkedin != "http://" ) {
     echo '<a href="'.$linkedin.'" target="_blank"><img src="'.$cdn.'paperflowers/48/Linkedin-icon.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
   if( $youtube != "http://" ) {
     echo '<a href="'.$youtube.'" target="_blank"><img src="'.$cdn.'paperflowers/48/YouTube-icon.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
   if( $pinterest != "http://" ) {
     echo '<a href="'.$pinterest.'" target="_blank"><img src="'.$cdn.'paperflowers/48/Pinterest-icon.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }   
   if( $instagram != "http://" ) {
     echo '<a href="'.$instagram.'" target="_blank"><img src="'.$cdn.'paperflowers/48/Instagram-icon.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }   
   if( $rssfeed ) {
     echo '<a href="'?><?php bloginfo('rss2_url'); ?><?php echo '" target="_blank"><img src="'.$cdn.'paperflowers/48/RSS-icon.png" height="38" width="37" ></a>&nbsp;';
   }
?>