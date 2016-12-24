<?php

   if( $facebook != "http://" && $facebook !="" ) {
    echo '<a href="'.$facebook.'" target="_blank"><img src="'.$cdn.'old-bottle-crowns/facebook.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
  if( $twitter != "http://" && $twitter !="" ) {
     echo '<a href="'.$twitter.'" target="_blank"><img src="'.$cdn.'old-bottle-crowns/twitter.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
   if( $gplus != "http://" && $gplus !="" ) {
     echo '<a href="'.$gplus.'" target="_blank"><img src="'.$cdn.'old-bottle-crowns/google-plus.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
   if( $linkedin != "http://" && $linkedin !="" ) {
     echo '<a href="'.$linkedin.'" target="_blank"><img src="'.$cdn.'old-bottle-crowns/linkedin.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }
   if( $youtube != "http://" && $youtube != "" ) {
     echo '<a href="'.$youtube.'" target="_blank"><img src="'.$cdn.'old-bottle-crowns/youtube.png" height="38" width="37" ></a>&nbsp;';
   }
   if ( $vertical == '1' ) { 
     echo '<br>'; 
   }      
   if( $rssfeed ) {
     echo '<a href="'?><?php bloginfo('rss2_url'); ?><?php echo '" target="_blank"><img src="'.$cdn.'old-bottle-crowns/rss.png" height="38" width="37" ></a>&nbsp;';
   }
?>