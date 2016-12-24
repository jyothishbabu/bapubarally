<?php

   if( $facebook != "http://" ) {
    echo '<a href="'.$facebook.'" target="_blank"><img src="'.$cdn.'dark/social-facebook.png" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
  if( $twitter != "http://" ) {
     echo '<a href="'.$twitter.'" target="_blank"><img src="'.$cdn.'dark/social-twitter.png" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
   if( $gplus != "http://" ) {
     echo '<a href="'.$gplus.'" target="_blank"><img src="'.$cdn.'dark/social-googleplus.png" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
   if( $linkedin != "http://" ) {
     echo '<a href="'.$linkedin.'" target="_blank"><img src="'.$cdn.'dark/social-linkedin.png" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
   if( $youtube != "http://" ) {
     echo '<a href="'.$youtube.'" target="_blank"><img src="'.$cdn.'dark/social-youtube.png" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
   if( $pinterest != "http://" ) {
     echo '<a href="'.$pinterest.'" target="_blank"><img src="'.$cdn.'dark/social-pintrest.png" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
   if( $instagram != "http://" ) {
     echo '<a href="'.$instagram.'" target="_blank"><img src="'.$cdn.'dark/social-instagram.png" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }   
	if( $rssfeed ) {
     echo '<a href="'?><?php bloginfo('rss2_url'); ?><?php echo '" target="_blank"><img src="'.$cdn.'dark/social-rss.png" height="38" width="37" ></a>&nbsp;';
   }
?>