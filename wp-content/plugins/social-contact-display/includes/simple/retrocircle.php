<?php

   if( $facebook != "http://" ) {
    echo '<a href="'.$facebook.'" target="_blank"><img src="'.$cdn.'retrocircle/pink/48_48/facebook_1.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
  if( $twitter != "http://" ) {
     echo '<a href="'.$twitter.'" target="_blank"><img src="'.$cdn.'retrocircle/pink/48_48/twitter_2.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
   if( $gplus != "http://" ) {
     echo '<a href="'.$gplus.'" target="_blank"><img src="'.$cdn.'retrocircle/pink/48_48/google_plus.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
   if( $tumblr != "http://" ) {
     echo '<a href="'.$tumblr.'" target="_blank"><img src="'.$cdn.'retrocircle/pink/48_48/tumblr.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
   if( $linkedin != "http://" ) {
     echo '<a href="'.$linkedin.'" target="_blank"><img src="'.$cdn.'retrocircle/pink/48_48/linkedin.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
   if( $youtube != "http://" ) {
     echo '<a href="'.$youtube.'" target="_blank"><img src="'.$cdn.'retrocircle/pink/48_48/you_tube.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
   if( $pinterest != "http://" ) {
     echo '<a href="'.$pinterest.'" target="_blank"><img src="'.$cdn.'retrocircle/pink/48_48/pinterest.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
   if( $instagram != "http://" ) {
     echo '<a href="'.$instagram.'" target="_blank"><img src="'.$cdn.'retrocircle/pink/48_48/instagram.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }   
   if( $rssfeed ) {
     echo '<a href="'?><?php bloginfo('rss2_url'); ?><?php echo '" target="_blank"><img src="'.$cdn.'retrocircle/pink/48_48/rss.png" height="38" width="37" ></a>&nbsp;';
   }
?>